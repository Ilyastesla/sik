<?php

session_start(); //we need to start session in order to access it through CI

Class ns_rekapnilai extends CI_Controller {

public function __construct() {
parent::__construct();

		// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');


		// Load session library
		$this->load->library('session');

		// Load database
		$this->load->model('ns_rekapnilai_db');

   if( $this->session->userdata('logged_in')) {
       if($this->dbx->checkpage($this->session->userdata('role_id'),'ns_rekapnilai')==false){
          redirect('user_authentication');
       }
		}else{
			redirect('user_authentication');;
		}

	}

	public function index()
	{
			$data= $this->ns_rekapnilai_db->index_table();
			$data['form']='Rekapitulasi Nilai Siswa';
			$data['view']='index';
			$data['action']='ns_rekapnilai';
			$this->load->view('ns_rekapnilai_v', $data);
	}
}
?>
