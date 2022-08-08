<?php

session_start(); //we need to start session in order to access it through CI

Class jenis_jaminan extends CI_Controller {

public function __construct() {
	parent::__construct();

		// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');


		// Load session library
		$this->load->library('session');

		// Load database
		$this->load->model('jenis_jaminan_db');

		if( $this->session->userdata('logged_in')) {
			if($this->dbx->checkpage($this->session->userdata('role_id'),'jenis_jaminan')==false){
					redirect('user_authentication');
			}
		}else{
			redirect('user_authentication');;
		}

	}

	public function index()
	{
			$data['show_table'] = $this->jenis_jaminan_db->data();
			$data['form']='Jenis Jaminan';
			$data['view']='index';
			$this->load->view('jenis_jaminan_v', $data);
	}

	// TAMBAH
	//-------------------------------------------------------------------------------------------
	public function tambah($id='') {
		$data['form']='Jenis Jaminan';
		$data['form_small']='Tambah Data';
		$data['view']='tambah';
		$data['action']='jenis_jaminan/tambah_p';
		$data= $this->jenis_jaminan_db->tambah_x($id,$data);
		$this->load->view('jenis_jaminan_v',$data);
	}

	public function tambah_p($id='') {
	    //"penerima"=> $this->input->post("penerima"),
	    //"tanggalpenerima"=> $this->input->post("tanggalpenerima"),
		$data = array(
				"jenis_jaminan"=> $this->input->post("jenis_jaminan"),
				"aktif"=> $this->input->post("aktif"),
				"modified_date"=> $this->dbx->cts(),
				"modified_by"=> $this->session->userdata('idpegawai'));
		if ($id<>""){
			$result = $this->jenis_jaminan_db->ubah($data,$id) ;
		}else{
			$data = $this->p_c->arraymerge(array('created_date' => $this->dbx->cts()), $data);
			$data = $this->p_c->arraymerge(array('created_by' => $this->session->userdata('idpegawai')), $data);
			$id = $this->jenis_jaminan_db->tambah($data);
			if ($id<>""){$result=TRUE;}
		}

		if ($result == TRUE) {
			redirect('jenis_jaminan');
		} else {
			$data['error']='Errorr...';
			$this->ubah($id,$data);
		}
	}

	// UBAH
	//-------------------------------------------------------------------------------------------
	public function ubah($id,$stat='') {
		$data['form']='Jenis Jaminan';
		$data['form_small']='Ubah Data';
		$data['view']='tambah';
		$data['action']='jenis_jaminan/tambah_p/'.$id;
		$data= $this->jenis_jaminan_db->tambah_x($id,$data);
		$this->load->view('jenis_jaminan_v',$data);
	}

	public function hapus($id) {
		$result = $this->jenis_jaminan_db->hapus_db($id) ;
		if ($result == TRUE) {
			redirect('jenis_jaminan');
		}
	}


}//end of class
?>
