<?php

session_start(); //we need to start session in order to access it through CI

Class pegawai_cari extends CI_Controller {

public function __construct() {
parent::__construct();

		// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');


		// Load library
		$this->load->library('session');

		// Load database
		$this->load->model('pegawai_cari_db');

		if( $this->session->userdata('logged_in')) {
			if($this->dbx->checkpage($this->session->userdata('role_id'),'pegawai_cari')==false){
					redirect('user_authentication');
			}
		}else{
			redirect('user_authentication');;
		}

	}

	public function index()
	{
			$data= $this->pegawai_cari_db->data();
			$data['form']='Cari Pegawai';
			$data['view']='index';
			$data['action']='pegawai_cari';
			$this->load->view('pegawai_cari_v', $data);
	}
}//end of class
?>
