<?php

session_start(); //we need to start session in order to access it through CI

Class psb_caricalonsiswa extends CI_Controller {

public function __construct() {
parent::__construct();

		// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');


		// Load library
		$this->load->library('session');

		// Load database
		$this->load->model('psb_caricalonsiswa_db');

   if( $this->session->userdata('logged_in')) {
       if($this->dbx->checkpage($this->session->userdata('role_id'),'psb_caricalonsiswa')==false){
          redirect('user_authentication');
       }
		}else{
			redirect('user_authentication');;
		}

	}

	public function index()
	{
			$data= $this->psb_caricalonsiswa_db->data();
			$data['form']='Cari Calon Peserta Didik';
			$data['view']='index';
			$data['action']='psb_caricalonsiswa';
			$this->load->view('psb_caricalonsiswa_v', $data);
	}
}//end of class
?>
