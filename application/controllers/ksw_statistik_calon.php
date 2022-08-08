<?php

session_start(); //we need to start session in order to access it through CI

Class ksw_statistik_calon extends CI_Controller {

public function __construct() {
parent::__construct();

		// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');


		// Load library
		$this->load->library('session');

		// Load database
		$this->load->model('ksw_statistik_calon_db');

		if( $this->session->userdata('logged_in')) {
			if($this->dbx->checkpage($this->session->userdata('role_id'),'ksw_statistik_calon')==false){
					redirect('user_authentication');
			}
		}else{
			redirect('user_authentication');;
		}

	}

	public function index()
	{
			$data= $this->ksw_statistik_calon_db->data();
			$data['action']='ksw_statistik_calon';
			$data['form']='Statistik Calon Peserta Didik';
			$data['view']='index';
			$this->load->view('ksw_statistik_calon_v', $data);
	}
}//end of class
?>
