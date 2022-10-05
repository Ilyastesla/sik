<?php

session_start(); //we need to start session in order to access it through CI

Class psb_laporan extends CI_Controller {

public function __construct() {
parent::__construct();

		// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');


		// Load library
		$this->load->library('session');

		// Load database
		$this->load->model('psb_laporan_db');

   if( $this->session->userdata('logged_in')) {
       if($this->dbx->checkpage($this->session->userdata('role_id'),'psb_laporan')==false){
          redirect('user_authentication');
       }
		}else{
			redirect('user_authentication');;
		}

	}

	public function index()
	{
			$data = $this->psb_laporan_db->data();
			$data['form']='Laporan Data Calon Peserta Didik';
			$data['view']='index';
			$data['action']='psb_laporan';
			$this->load->view('psb_laporan_v', $data);
	}

	public function printthis($excel="") {
		$data= $this->psb_laporan_db->data();
		$data['form']='Laporan Data Calon Peserta Didik';
		$data['form_small']='Cetak';
		$data['excel']=$excel;
		$this->load->view('psb_laporan_print_v',$data);
	}
}//end of class
?>
