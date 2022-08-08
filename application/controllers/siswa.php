<?php

session_start(); //we need to start session in order to access it through CI

Class siswa extends CI_Controller {

public function __construct() {
parent::__construct();

		// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');


		// Load session library
		$this->load->library('session');

		// Load database
		$this->load->model('siswa_db');

   if( $this->session->userdata('logged_in')) {
       if($this->dbx->checkpage($this->session->userdata('role_id'),'siswa')==false){
          redirect('user_authentication');
       }
		}else{
			redirect('user_authentication');;
		}

	}

	public function index()
	{
			$data= $this->siswa_db->index_table();
			$data['form']='Data Siswa';
			$data['view']='index';
			$data['action']='siswa';
			$this->load->view('siswa_v', $data);
	}

}//end of class
?>
