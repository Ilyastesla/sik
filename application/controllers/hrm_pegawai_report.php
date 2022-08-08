<?php

session_start(); //we need to start session in order to access it through CI

Class hrm_pegawai_report extends CI_Controller {

public function __construct() {
	parent::__construct();

		// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');


		// Load session library
		$this->load->library('session');

		// Load database
		$this->load->model('hrm_pegawai_report_db');

		if( $this->session->userdata('logged_in')) {
			if($this->dbx->checkpage($this->session->userdata('role_id'),'hrm_pegawai_report')==false){
					redirect('user_authentication');
			}
		}else{
			redirect('user_authentication');;
		}

	}

	public function index()
	{
			$data = $this->hrm_pegawai_report_db->data();
			$data['form']='Laporan Divisi';
			$data['view']='index';
			$data['action']='hrm_pegawai_report';
			$this->load->view('hrm_pegawai_report_v', $data);
	}
	public function showdailypegawai($idpegawai,$tanggal)
	{
			$data = $this->hrm_pegawai_report_db->showdailypegawai_db($idpegawai,$tanggal);
			$data['form']='Laporan '.$this->dbx->getpegawai($idpegawai,0,1);
			$data['view']='showdailypegawai';
			$data['action']='hrm_pegawai_report';
			$this->load->view('hrm_pegawai_report_v', $data);
	}
}//end of class
?>
