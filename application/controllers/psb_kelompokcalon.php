<?php

session_start(); //we need to start session in order to access it through CI

Class psb_kelompokcalon extends CI_Controller {

public function __construct() {
parent::__construct();

		// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');


		// Load library
		$this->load->library('session');

		// Load database
		$this->load->model('psb_kelompokcalon_db');

   if( $this->session->userdata('logged_in')) {
       if($this->dbx->checkpage($this->session->userdata('role_id'),'psb_kelompokcalon')==false){
          redirect('user_authentication');
       }
		}else{
			redirect('user_authentication');;
		}

	}

	public function index()
	{
			$data = $this->psb_kelompokcalon_db->data();
			$data['form']='Program Calon Peserta Didik';
			$data['view']='index';
			$data['action']='psb_kelompokcalon';
			$this->load->view('psb_kelompokcalon_v', $data);
	}

	// TAMBAH
	//-------------------------------------------------------------------------------------------
	public function tambah($id='') {
		$data['form']='Program Calon Peserta Didik';
		$data['form_small']='Tambah Data';
		$data['view']='tambah';
		$data['action']='psb_kelompokcalon/tambah_p';
		$data= $this->psb_kelompokcalon_db->tambah_db($id,$data);
		$this->load->view('psb_kelompokcalon_v',$data);
	}

	public function tambah_p($id='') {
		$data = array(
										"kelompok"=>$this->input->post("kelompok")
										,"idproses"=>$this->input->post("idproses")
										,"kelompok_siswa"=>$this->input->post("kelompok_siswa")
										,"kapasitas"=>$this->input->post("kapasitas")
										,"keterangan"=>$this->input->post("keterangan")
										,"lamaproses"=>$this->input->post("lamaproses")
										,"aktif"=>$this->input->post("aktif")
										,"modified_date"=> $this->dbx->cts()
										,"modified_by"=> $this->session->userdata('idpegawai')
								);

		if ($id<>""){
			$result = $this->dbx->ubahdata('kelompokcalonsiswa',$data,'replid',$replid);
		}else{
			$data = $this->p_c->arraymerge(array('created_date' => $this->dbx->cts()), $data);
			$data = $this->p_c->arraymerge(array('created_by' => $this->session->userdata('idpegawai')), $data);
			$id = $this->dbx->tambahdata('kelompokcalonsiswa',$data) ;
			if ($id<>""){$result=TRUE;}
		}

		if ($result == TRUE) {
			?><script>
					window.opener.location.reload();
					window.close();
				</script>
			<?php
		} else {
			$data['error']="Errorr...";
			$this->ubah($id,$data);
		}
	}

	// UBAH
	//-------------------------------------------------------------------------------------------
	public function ubah($id,$stat='') {
		$data['form']='Program Calon Peserta Didik';
		$data['form_small']='Ubah Data';
		$data['view']='tambah';
		$data['action']='psb_kelompokcalon/tambah_p/'.$id;
		$data= $this->psb_kelompokcalon_db->tambah_db($id,$data);
		$this->load->view('psb_kelompokcalon_v',$data);
	}

	// HAPUS
	//-------------------------------------------------------------------------------------------
	public function hapus($id) {
		$result = $this->dbx->hapusdata('kelompokcalonsiswa','replid',$id) ;
		if ($result == TRUE) {
			redirect('psb_kelompokcalon');
		}
	}

	public function ubahaktif($replid,$aktif=0) {
		$data=array(
				'aktif' =>$aktif
				,"modified_date"=> $this->dbx->cts()
				,"modified_by"=> $this->session->userdata('idpegawai'));
		$result = $this->dbx->ubahdata('kelompokcalonsiswa',$data,'replid',$replid);
		//echo $this->db->last_query();die;
		if ($result == TRUE) {
			?><script>
					window.opener.location.reload();
					window.close();
				</script>
			<?php
		} else {
			$data['error']='Errorr...';
			$this->ubah($replid,$data);
		}
	}
}//end of class
?>
