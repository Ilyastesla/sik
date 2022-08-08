<?php

session_start(); //we need to start session in order to access it through CI

Class psb_kuotakelas extends CI_Controller {

public function __construct() {
parent::__construct();

		// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');


		// Load library
		$this->load->library('session');

		// Load database
		$this->load->model('psb_kuotakelas_db');

		if( $this->session->userdata('logged_in')) {
			if($this->dbx->checkpage($this->session->userdata('role_id'),'psb_kuotakelas')==false){
					redirect('user_authentication');
			}
		}else{
			redirect('user_authentication');;
		}

	}

	public function index()
	{
			$data= $this->psb_kuotakelas_db->data();
			$data['action']='psb_kuotakelas';
			$data['form']='Kuota Kelas';
			$data['view']='index';
			$this->load->view('psb_kuotakelas_v', $data);
	}
}//end of class
?>
