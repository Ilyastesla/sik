<?php

session_start(); //we need to start session in order to access it through CI

Class ksw_beritaacaradokumen extends CI_Controller {

public function __construct() {
parent::__construct();

		// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');


		// Load library
		$this->load->library('session');

		// Load database
		$this->load->model('ksw_beritaacaradokumen_db');

   if( $this->session->userdata('logged_in')) {
       if($this->dbx->checkpage($this->session->userdata('role_id'),'ksw_beritaacaradokumen')==false){
          redirect('user_authentication');
       }
		}else{
			redirect('user_authentication');;
		}

	}

	public function index()
	{
			$data = $this->ksw_beritaacaradokumen_db->data();
			$data['form']='Berita Acara Dokumen PD';
			$data['view']='index';
			$data['action']='ksw_beritaacaradokumen';
			$this->load->view('ksw_beritaacaradokumen_v', $data);
	}
}//end of class
?>
