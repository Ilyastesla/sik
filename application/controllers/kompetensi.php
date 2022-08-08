<?php

session_start(); //we need to start session in order to access it through CI

Class kompetensi extends CI_Controller {

public function __construct() {
	parent::__construct();

		// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');


		// Load session library
		$this->load->library('session');

		// Load database
		$this->load->model('kompetensi_db');

		if( $this->session->userdata('logged_in')) {
			if($this->dbx->checkpage($this->session->userdata('role_id'),'kompetensi')==false){
					redirect('user_authentication');
			}
		}else{
			redirect('user_authentication');;
		}

	}

	public function index()
	{
			$data['show_table'] = $this->kompetensi_db->data();
			$data['form']='Kompetensi';
			$data['view']='index';
			$this->load->view('kompetensi_v', $data);
	}


	// TAMBAH
	//-------------------------------------------------------------------------------------------
	public function tambah($id='') {
		$data['form']='Kompetensi';
		$data['form_small']='Tambah Data';
		$data['view']='tambah';
		$data['action']='kompetensi/tambah_p';
		$data= $this->kompetensi_db->tambah_x($id,$data);
		$this->load->view('kompetensi_v',$data);
	}

	public function tambah_p($id='') {
	    //"penerima"=> $this->input->post("penerima"),
	    //"tanggalpenerima"=> $this->input->post("tanggalpenerima"),
		$data = array(
				"kompetensi"=> $this->input->post("kompetensi"),
				"max_skor"=> $this->input->post("max_skor"),
				"no_urut"=> $this->input->post("no_urut"),
				"umum"=> $this->input->post("umum"),
				"aktif"=> $this->input->post("aktif"),
				"modified_date"=> $this->dbx->cts(),
				"modified_by"=> $this->session->userdata('idpegawai'));
		if ($id<>""){
			$result = $this->kompetensi_db->ubah($data,$id) ;
		}else{
			$data = $this->p_c->arraymerge(array('created_date' => $this->dbx->cts()), $data);
			$data = $this->p_c->arraymerge(array('created_by' => $this->session->userdata('idpegawai')), $data);
			$id = $this->kompetensi_db->tambah($data);
			if ($id<>""){$result=TRUE;}
		}

		if ($result == TRUE) {
			redirect('kompetensi');
		} else {
			$data['error']='Errorr...';
			$this->ubah($id,$data);
		}
	}

	// UBAH
	//-------------------------------------------------------------------------------------------
	public function ubah($id,$stat='') {
		$data['form']='Kompetensi';
		$data['form_small']='Ubah Data';
		$data['view']='tambah';
		$data['action']='kompetensi/tambah_p/'.$id;
		$data= $this->kompetensi_db->tambah_x($id,$data);
		$this->load->view('kompetensi_v',$data);
	}

	public function hapus($id) {
		$result = $this->kompetensi_db->hapus_db($id) ;
		if ($result == TRUE) {
			redirect('kompetensi');
		}
	}


}//end of class
?>
