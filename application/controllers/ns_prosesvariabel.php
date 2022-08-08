<?php

session_start(); //we need to start session in order to access it through CI

Class ns_prosesvariabel extends CI_Controller {

public function __construct() {
parent::__construct();

		// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');


		// Load session library
		$this->load->library('session');

		// Load database
		$this->load->model('ns_prosesvariabel_db');

		if( $this->session->userdata('logged_in')) {
			if($this->dbx->checkpage($this->session->userdata('role_id'),'ns_prosesvariabel')==false){
					redirect('user_authentication');
			}
		}else{
			redirect('user_authentication');;
		}

	}

	public function index()
	{
			$data= $this->ns_prosesvariabel_db->data();
			$data['action']='ns_prosesvariabel';
			$data['form']='Variabel Proses Siswa';
			$data['view']='index';
			$this->load->view('ns_prosesvariabel_v', $data);
	}

	// TAMBAH
	//-------------------------------------------------------------------------------------------
	public function tambah($id='') {
		$data['form']='Variabel Proses Siswa';
		$data['form_small']='Tambah Data';
		$data['view']='tambah';
		$data['action']='ns_prosesvariabel/tambah_p';
		$data= $this->ns_prosesvariabel_db->tambah_db($id,$data);
		$this->load->view('ns_prosesvariabel_v',$data);
	}

	public function tambah_p($id='') {
		$data = array(
				'prosesvariabel' => $this->input->post('prosesvariabel'),
				'idprosestipe' => $this->input->post('idprosestipe'),
				'no_urut' => $this->input->post('no_urut'),
				'keterangan' => $this->input->post('keterangan'),
				'aktif' => $this->input->post('aktif'),
				"modified_date"=> $this->dbx->cts(),
				"modified_by"=> $this->session->userdata('idpegawai'));

		if ($id<>""){
			$result = $this->ns_prosesvariabel_db->ubah_pdb($data,$id) ;
		}else{
			$data = $this->p_c->arraymerge(array('created_date' => $this->dbx->cts()), $data);
			$data = $this->p_c->arraymerge(array('created_by' => $this->session->userdata('idpegawai')), $data);
			$id = $this->ns_prosesvariabel_db->tambah_pdb($data) ;
			if ($id<>""){$result=TRUE;}
		}

		if ($result == TRUE) {
			redirect('ns_prosesvariabel');
		} else {
			$data['error']='Errorr...';
			$this->ubah($id,$data);
		}
	}

	// UBAH
	//-------------------------------------------------------------------------------------------
	public function ubah($id,$stat='') {
		$data['form']='Variabel Proses Siswa';
		$data['form_small']='Ubah Data';
		$data['view']='tambah';
		$data['action']='ns_prosesvariabel/tambah_p/'.$id;
		$data= $this->ns_prosesvariabel_db->tambah_db($id,$data);
		$this->load->view('ns_prosesvariabel_v',$data);
	}

	//Hapus
	public function hapus($id) {
		$result = $this->ns_prosesvariabel_db->hapus_pdb($id) ;
		if ($result == TRUE) {
			redirect('ns_prosesvariabel');
		}
	}

}//end of class
?>
