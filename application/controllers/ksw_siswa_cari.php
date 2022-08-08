<?php

session_start(); //we need to start session in order to access it through CI

Class ksw_siswa_cari extends CI_Controller {

public function __construct() {
parent::__construct();

		// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');


		// Load library
		$this->load->library('session');

		// Load database
		$this->load->model('ksw_siswa_cari_db');

		if( $this->session->userdata('logged_in')) {
			if($this->dbx->checkpage($this->session->userdata('role_id'),'ksw_siswa_cari')==false){
					redirect('user_authentication');
			}
		}else{
			redirect('user_authentication');;
		}

	}

	public function index()
	{
			$data= $this->ksw_siswa_cari_db->data();
			$data['form']='Cari Siswa';
			$data['view']='index';
			$data['action']='ksw_siswa_cari';
			$this->load->view('ksw_siswa_cari_v', $data);
	}
}//end of class
?>
