<?php

session_start(); //we need to start session in order to access it through CI

Class pos extends CI_Controller {

public function __construct() {
	parent::__construct();

		// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');


		// Load session library
		$this->load->library('session');

		// Load database
		$this->load->model('pos_db');

   if( $this->session->userdata('logged_in')) {
       if($this->dbx->checkpage($this->session->userdata('role_id'),'pos')==false){
          redirect('user_authentication');
       }
		}else{
			redirect('user_authentication');;
		}

	}

	public function index()
	{
		$printvalue=$this->input->post("printvalue");
		$excel=$this->input->post("excel");
		$data = $this->pos_db->data();
		$data['form']='Laporan Kas Kecil';
		$data['view']='index';
		$data['action']='pos/index';
		$data['excel']='0';
		if($excel==1){
			$data['excel']='1';
		}
		if($printvalue==1){
			$this->load->view('pos_print_v', $data);
		}else{
			$this->load->view('pos_v', $data);
		}

	}
}//end of class
?>
