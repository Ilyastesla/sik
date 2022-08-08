<?php

session_start(); //we need to start session in order to access it through CI

Class jabatan_grup extends CI_Controller {

public function __construct() {
	parent::__construct();

		// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');


		// Load session library
		$this->load->library('session');

		// Load database
		$this->load->model('jabatan_grup_db');

		if( $this->session->userdata('logged_in')) {
			if($this->dbx->checkpage($this->session->userdata('role_id'),'jabatan_grup')==false){
					redirect('user_authentication');
			}
		}else{
			redirect('user_authentication');;
		}

	}

	public function index()
	{
			$data['show_table'] = $this->jabatan_grup_db->data();
			$data['form']='Grup Jabatan';
			$data['view']='index';
			$this->load->view('jabatan_grup_v', $data);
	}

	// TAMBAH
	//-------------------------------------------------------------------------------------------
	public function tambah($id='') {
		$data['form']='Grup Jabatan';
		$data['form_small']='Tambah Data';
		$data['view']='tambah';
		$data['action']='jabatan_grup/tambah_p';
		$data= $this->jabatan_grup_db->tambah_x($id,$data);
		$this->load->view('jabatan_grup_v',$data);
	}

	public function tambah_p($id='') {
	    //"penerima"=> $this->input->post("penerima"),
	    //"tanggalpenerima"=> $this->input->post("tanggalpenerima"),
		$data = array(
				"jabatan_grup"=> $this->input->post("jabatan_grup"),
				"aktif"=> $this->input->post("aktif"),
				"modified_date"=> $this->dbx->cts(),
				"modified_by"=> $this->session->userdata('idpegawai'));
		if ($id<>""){
			$result = $this->jabatan_grup_db->ubah($data,$id) ;
		}else{
			$data = $this->p_c->arraymerge(array('created_date' => $this->dbx->cts()), $data);
			$data = $this->p_c->arraymerge(array('created_by' => $this->session->userdata('idpegawai')), $data);
			$id = $this->jabatan_grup_db->tambah($data);
			if ($id<>""){$result=TRUE;}
		}

		if ($result == TRUE) {
			redirect('jabatan_grup');
		} else {
			$data['error']='Errorr...';
			$this->ubah($id,$data);
		}
	}

	// UBAH
	//-------------------------------------------------------------------------------------------
	public function ubah($id,$stat='') {
		$data['form']='Grup Jabatan';
		$data['form_small']='Ubah Data';
		$data['view']='tambah';
		$data['action']='jabatan_grup/tambah_p/'.$id;
		$data= $this->jabatan_grup_db->tambah_x($id,$data);
		$this->load->view('jabatan_grup_v',$data);
	}

	public function hapus($id) {
		$result = $this->jabatan_grup_db->hapus_db($id) ;
		if ($result == TRUE) {
			redirect('jabatan_grup');
		}
	}


}//end of class
?>
