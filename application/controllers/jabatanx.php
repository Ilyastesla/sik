<?php

session_start(); //we need to start session in order to access it through CI

Class jabatan extends CI_Controller {

public function __construct() {
parent::__construct();

	// Load form helper library
	$this->load->helper('form');

	// Load form validation library
	$this->load->library('form_validation');


	// Load session library
	$this->load->library('session');

	// Load database
	$this->load->model('jabatan_db');

	if( $this->session->userdata('logged_in')) {
		if($this->dbx->checkpage($this->session->userdata('role_id'),'jabatan')==false){
				redirect('user_authentication');
		}
	}else{
		redirect('user_authentication');;
	}
}

public function index()
{
	$data['show_table'] = $this->jabatan_db->data();
	$data['form']='Struktur Organisasi';
	$this->load->view('jabatan', $data);
}//end of class
?>
