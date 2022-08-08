<?php

session_start(); //we need to start session in order to access it through CI

Class ksw_kelompok extends CI_Controller {

public function __construct() {
parent::__construct();

		// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');


		// Load library
		$this->load->library('session');

		// Load database
		$this->load->model('ksw_kelompok_db');

		if( $this->session->userdata('logged_in')) {
			if($this->dbx->checkpage($this->session->userdata('role_id'),'ksw_kelompok')==false){
					redirect('user_authentication');
			}
		}else{
			redirect('user_authentication');;
		}

	}

	public function index()
	{
			$data= $this->ksw_kelompok_db->data();
			$data['action']='ksw_kelompok';
			$data['form']='Program Siswa';
			$data['view']='index';
			$this->load->view('ksw_kelompok_v', $data);
	}

	// TAMBAH
	//-------------------------------------------------------------------------------------------
	public function tambah($replid='') {
		$data['form']='Program Siswa';
		$data['form_small']='Tambah Data';
		$data['view']='tambah';
		$data['action']='ksw_kelompok/tambah_p';
		$data= $this->ksw_kelompok_db->tambah_db($replid,$data);
		$this->load->view('ksw_kelompok_v',$data);
	}

	public function tambah_p($replid='') {
		$data = array(
										"kelompok"=>$this->input->post("kelompok")
										,"departemen"=>$this->input->post("departemen")
										,"aktif"=>$this->input->post("aktif")
										,"syarat_interview"=>$this->input->post("syarat_interview")
										,"syarat_asesmen"=>$this->input->post("syarat_asesmen")
										,"syarat_placementtest"=>$this->input->post("syarat_placementtest")
										,"keterangan"=>$this->input->post("keterangan")
										,"no_urut"=>$this->input->post("no_urut")
										,"modified_date"=> $this->dbx->cts()
										,"modified_by"=> $this->session->userdata('idpegawai')
								);

		if ($replid<>""){
			$result = $this->dbx->ubahdata('kelompoksiswa',$data,'replid',$replid);
		}else{
			$data = $this->p_c->arraymerge(array('created_date' => $this->dbx->cts()), $data);
			$data = $this->p_c->arraymerge(array('created_by' => $this->session->userdata('idpegawai')), $data);
			$replid = $this->dbx->tambahdata('kelompoksiswa',$data);
			if ($replid<>""){$result=TRUE;}
		}

		if ($result == TRUE) {
			?><script>
					window.opener.location.reload();
					window.close();
				</script>
			<?php
		} else {
			$data['error']="Errorr...";
			$this->ubah($replid,$data);
		}
	}

	// UBAH
	//-------------------------------------------------------------------------------------------
	public function ubah($replid,$stat='') {
		$data['form']='Program Siswa';
		$data['form_small']='Ubah Data';
		$data['view']='tambah';
		$data['action']='ksw_kelompok/tambah_p/'.$replid;
		$data= $this->ksw_kelompok_db->tambah_db($replid,$data);
		$this->load->view('ksw_kelompok_v',$data);
	}

	// HAPUS
	//-------------------------------------------------------------------------------------------
	public function hapus($replid) {
		$result = $this->ksw_kelompok_db->hapus_pdb($replid) ;
		if ($result == TRUE) {
			?><script>
					window.opener.location.reload();
					window.close();
				</script>
			<?php
		}
	}

	public function ubahaktif($replid,$aktif=0) {
		$data=array(
				'aktif' =>$aktif
				,"modified_date"=> $this->dbx->cts()
				,"modified_by"=> $this->session->userdata('idpegawai'));
		$result = $this->dbx->ubahdata('kelompoksiswa',$data,'replid',$replid);
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
