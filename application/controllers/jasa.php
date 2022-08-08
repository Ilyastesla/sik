<?php

session_start(); //we need to start session in order to access it through CI

Class jasa extends CI_Controller {

public function __construct() {
	parent::__construct();

		// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');


		// Load session library
		$this->load->library('session');

		// Load database
		$this->load->model('jasa_db');

		if( $this->session->userdata('logged_in')) {
			if($this->dbx->checkpage($this->session->userdata('role_id'),'jasa')==false){
					redirect('user_authentication');
			}
		}else{
			redirect('user_authentication');;
		}

	}

	public function index()
	{
			$data['show_table'] = $this->jasa_db->data();
			$data['form']='Jasa';
			$data['view']='index';
			$this->load->view('jasa_v', $data);
	}

	// TAMBAH
	//-------------------------------------------------------------------------------------------
	public function tambah($id='') {
		$data['form']='Jasa';
		$data['form_small']='Tambah Data';
		$data['view']='tambah';
		$data['action']='jasa/tambah_p';
		$data= $this->jasa_db->tambah_x($id,$data);
		$this->load->view('jasa_v',$data);
	}

	public function tambah_p($id='') {
	    //"penerima"=> $this->input->post("penerima"),
	    //"tanggalpenerima"=> $this->input->post("tanggalpenerima"),
		$data = array(
				"jasa"=> $this->input->post("jasa"),
				"idkelompok_jasa"=> $this->input->post("idkelompok_jasa"),
				"aktif"=> $this->input->post("aktif"),
				"modified_date"=> $this->dbx->cts(),
				"modified_by"=> $this->session->userdata('idpegawai'));
		if ($id<>""){
			$result = $this->jasa_db->ubah($data,$id) ;
		}else{
			$kode_jasa= $this->jasa_db->kode_jasa($this->input->post("idkelompok_jasa"));
			$data = $this->p_c->arraymerge(array('kode_jasa' => $kode_jasa), $data);
			$data = $this->p_c->arraymerge(array('created_date' => $this->dbx->cts()), $data);
			$data = $this->p_c->arraymerge(array('created_by' => $this->session->userdata('idpegawai')), $data);
			$id = $this->jasa_db->tambah($data);
			if ($id<>""){$result=TRUE;}
		}

		if ($result == TRUE) {
			redirect('jasa');
		} else {
			$data['error']='Errorr...';
			$this->ubah($id,$data);
		}
	}

	// UBAH
	//-------------------------------------------------------------------------------------------
	public function ubah($id,$stat='') {
		$data['form']='Jasa';
		$data['form_small']='Ubah Data';
		$data['view']='tambah';
		$data['action']='jasa/tambah_p/'.$id;
		$data= $this->jasa_db->tambah_x($id,$data);
		$this->load->view('jasa_v',$data);
	}

	public function hapus($id) {
		$result = $this->jasa_db->hapus_db($id) ;
		if ($result == TRUE) {
			redirect('jasa');
		}
	}


}//end of class
?>
