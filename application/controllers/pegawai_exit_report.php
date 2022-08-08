<?php

session_start(); //we need to start session in order to access it through CI

Class pegawai_exit_report extends CI_Controller {

public function __construct() {
	parent::__construct();

		// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');


		// Load session library
		$this->load->library('session');

		// Load database
		$this->load->model('pegawai_exit_db');

   if( $this->session->userdata('logged_in')) {
       if($this->dbx->checkpage($this->session->userdata('role_id'),'pegawai_exit_report')==false){
          redirect('user_authentication');
       }
		}else{
			redirect('user_authentication');;
		}
	}

	public function index()
	{
		//$data['show_table'] = $this->pegawai_exit_db->data();
		$data['form']='Laporan Exit Interview';
		$data['view']='pegawai_exit_report';
		$data['action']='pegawai_exit_report';
      	$data= $this->pegawai_exit_db->data($data);
		$this->load->view('pegawai_exit_v', $data);
	}
}//end of class
?>
