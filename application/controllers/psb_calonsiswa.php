<?php

session_start(); //we need to start session in order to access it through CI

Class psb_calonsiswa extends CI_Controller {

public function __construct() {
parent::__construct();

		// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');


		// Load library
		$this->load->library('session');

		// Load database
		$this->load->model('psb_calonsiswa_db');

   if( $this->session->userdata('logged_in')) {
       if($this->dbx->checkpage($this->session->userdata('role_id'),'psb_calonsiswa')==false){
          redirect('user_authentication');
       }
		}else{
			redirect('user_authentication');;
		}

	}

	public function index()
	{
			$data = $this->psb_calonsiswa_db->data();
			$data['form']='Data Calon Peserta Didik';
			$data['view']='index';
			$data['action']='psb_calonsiswa';
			$this->load->view('psb_calonsiswa_v', $data);
	}

	// TAMBAH
	//-------------------------------------------------------------------------------------------
	public function tambah($id='') {
		$data['form']='Data Calon Peserta Didik';
		$data['form_small']='Tambah Data';
		$data['view']='tambah';
		$data['action']='psb_calonsiswa/tambah_p';
		$data= $this->psb_calonsiswa_db->tambah_db($id,$data);
		$this->load->view('psb_calonsiswa_v',$data);
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
			$result = $this->dbx->ubahdata('kelompokcalonsiswa',$data,'replid',$id);
		}else{
			$data = $this->p_c->arraymerge(array('created_date' => $this->dbx->cts()), $data);
			$data = $this->p_c->arraymerge(array('created_by' => $this->session->userdata('idpegawai')), $data);
			$id = $this->dbx->tambahdata('kelompokcalonsiswa',$data) ;
			if ($id<>""){$result=TRUE;}
		}

		if ($result == TRUE) {
			redirect("psb_calonsiswa");
		} else {
			$data['error']="Errorr...";
			$this->ubah($id,$data);
		}
	}

	// UBAH
	//-------------------------------------------------------------------------------------------
	public function ubah($id,$stat='') {
		$data['form']='Data Calon Peserta Didik';
		$data['form_small']='Ubah Data';
		$data['view']='tambah';
		$data['action']='psb_calonsiswa/tambah_p/'.$id;
		$data= $this->psb_calonsiswa_db->tambah_db($id,$data);
		$this->load->view('psb_calonsiswa_v',$data);
	}

	// HAPUS
	//-------------------------------------------------------------------------------------------
	public function hapus($id) {
		$result = $this->dbx->hapusdata('kelompokcalonsiswa','replid',$id) ;
		if ($result == TRUE) {
			redirect('psb_calonsiswa');
		}
	}

	public function ubahaktif($id,$aktif=0) {
		$data=array(
				'aktif' =>$aktif
				,"modified_date"=> $this->dbx->cts()
				,"modified_by"=> $this->session->userdata('idpegawai'));
		$result = $this->dbx->ubahdata('calonsiswa',$data,'replid',$id);
		if ($result == TRUE) {
			?><script>
					window.opener.location.reload();
					window.close();
				</script>
			<?php
		} else {
			echo "ERROR!!";
		}
	}

	public function printthis($excel)
	{
			//echo $this->input->post('idtingkat');die;
			$data= $this->psb_calonsiswa_db->data();
			$data['form']='Data Calon Peserta Didik';
			$data['form_small']='Cetak';
			$data['view']='index';
			$data['excel']=$excel;
			$this->load->view('psb_calonsiswa_print_v', $data);
	}
}//end of class
?>
