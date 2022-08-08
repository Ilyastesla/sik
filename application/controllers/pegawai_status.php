<?php

session_start(); //we need to start session in order to access it through CI

Class pegawai_status extends CI_Controller {

public function __construct() {
	parent::__construct();

		// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');


		// Load session library
		$this->load->library('session');

		// Load database
		$this->load->model('pegawai_status_db');

   if( $this->session->userdata('logged_in')) {
       if($this->dbx->checkpage($this->session->userdata('role_id'),'pegawai_status')==false){
          redirect('user_authentication');
       }
		}else{
			redirect('user_authentication');;
		}

	}

	public function index()
	{
			$data['show_table'] = $this->pegawai_status_db->data();
			$data['form']='Referensi SDM';
			$data['view']='index';
			$this->load->view('pegawai_status_v', $data);
	}


	// TAMBAH
	//-------------------------------------------------------------------------------------------
	public function tambah($id='') {
		$data['form']='Referensi SDM';
		$data['form_small']='Tambah Data';
		$data['view']='tambah';
		$data['action']='pegawai_status/tambah_p';
		$data= $this->pegawai_status_db->tambah_x($id,$data);
		$this->load->view('pegawai_status_v',$data);
	}

	public function tambah_p($id='') {
	    //"penerima"=> $this->input->post("penerima"),
	    //"tanggalpenerima"=> $this->input->post("tanggalpenerima"),
		$data = array(
				"nama"=> $this->input->post("nama"),
				"type"=> $this->input->post("type"),
				"aktif"=> $this->input->post("aktif"),
				"modified_date"=> $this->dbx->cts(),
				"modified_by"=> $this->session->userdata('idpegawai'));
		if ($id<>""){
			$result = $this->pegawai_status_db->ubah($data,$id) ;
		}else{
			$data = $this->p_c->arraymerge(array('created_date' => $this->dbx->cts()), $data);
			$data = $this->p_c->arraymerge(array('created_by' => $this->session->userdata('idpegawai')), $data);
			$id = $this->pegawai_status_db->tambah($data);
			if ($id<>""){$result=TRUE;}
		}

		if ($result == TRUE) {
			redirect('pegawai_status');
		} else {
			$data['error']='Errorr...';
			$this->ubah($id,$data);
		}
	}

	// UBAH
	//-------------------------------------------------------------------------------------------
	public function ubah($id,$stat='') {
		$data['form']='Referensi SDM';
		$data['form_small']='Ubah Data';
		$data['view']='tambah';
		$data['action']='pegawai_status/tambah_p/'.$id;
		$data= $this->pegawai_status_db->tambah_x($id,$data);
		$this->load->view('pegawai_status_v',$data);
	}

	public function hapus($id) {
		$result = $this->pegawai_status_db->hapus_db($id) ;
		if ($result == TRUE) {
			redirect('pegawai_status');
		}
	}


}//end of class
?>
