<?php

session_start(); //we need to start session in order to access it through CI

Class kelompok_jasa extends CI_Controller {

public function __construct() {
	parent::__construct();

		// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');


		// Load session library
		$this->load->library('session');

		// Load database
		$this->load->model('kelompok_jasa_db');

		if( $this->session->userdata('logged_in')) {
			if($this->dbx->checkpage($this->session->userdata('role_id'),'kelompok_jasa')==false){
					redirect('user_authentication');
			}
		}else{
			redirect('user_authentication');;
		}

	}

	public function index()
	{
			$data['show_table'] = $this->kelompok_jasa_db->data();
			$data['form']='Kelompok Jasa';
			$data['view']='index';
			$this->load->view('kelompok_jasa_v', $data);
	}


	// TAMBAH
	//-------------------------------------------------------------------------------------------
	public function tambah($id='') {
		$data['form']='Kelompok Jasa';
		$data['form_small']='Tambah Data';
		$data['view']='tambah';
		$data['action']='kelompok_jasa/tambah_p';
		$data= $this->kelompok_jasa_db->tambah_x($id,$data);
		$this->load->view('kelompok_jasa_v',$data);
	}

	public function tambah_p($id='') {
	    //"penerima"=> $this->input->post("penerima"),
	    //"tanggalpenerima"=> $this->input->post("tanggalpenerima"),
		$data = array(
				"kode_kelompok_jasa"=> $this->input->post("kode_kelompok_jasa"),
				"kelompok_jasa"=> $this->input->post("kelompok_jasa"),
				"aktif"=> $this->input->post("aktif"),
				"modified_date"=> $this->dbx->cts(),
				"modified_by"=> $this->session->userdata('idpegawai'));
		if ($id<>""){
			$result = $this->kelompok_jasa_db->ubah($data,$id) ;
		}else{
			$data = $this->p_c->arraymerge(array('created_date' => $this->dbx->cts()), $data);
			$data = $this->p_c->arraymerge(array('created_by' => $this->session->userdata('idpegawai')), $data);
			$id = $this->kelompok_jasa_db->tambah($data);
			if ($id<>""){$result=TRUE;}
		}

		if ($result == TRUE) {
			redirect('kelompok_jasa');
		} else {
			$data['error']='Errorr...';
			$this->ubah($id,$data);
		}
	}

	// UBAH
	//-------------------------------------------------------------------------------------------
	public function ubah($id,$stat='') {
		$data['form']='Kelompok Jasa';
		$data['form_small']='Ubah Data';
		$data['view']='tambah';
		$data['action']='kelompok_jasa/tambah_p/'.$id;
		$data= $this->kelompok_jasa_db->tambah_x($id,$data);
		$this->load->view('kelompok_jasa_v',$data);
	}

	public function hapus($id) {
		$result = $this->kelompok_jasa_db->hapus_db($id) ;
		if ($result == TRUE) {
			redirect('kelompok_jasa');
		}
	}


}//end of class
?>
