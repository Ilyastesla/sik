<?php

session_start(); //we need to start session in order to access it through CI

Class psb_assessment_report extends CI_Controller {

public function __construct() {
parent::__construct();

		// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');


		// Load library
		$this->load->library('session');

		// Load database
		$this->load->model('psb_assessment_db');

   if( $this->session->userdata('logged_in')) {
       if($this->dbx->checkpage($this->session->userdata('role_id'),'psb_assessment_report')==false){
          redirect('user_authentication');
       }
		}else{
			redirect('user_authentication');;
		}

	}

	public function index()
	{
			$data = $this->psb_assessment_db->data(1);
			$data['form']='Laporan Asesmen Calon Peserta Didik';
			$data['view']='index';
      $data['report']=1;
			$data['action']='psb_assessment_report';
			$this->load->view('psb_assessment_v', $data);
	}

	public function view($tipedata,$idcalon,$replidkeg) {
		$data['form']='Laporan Asesmen Calon Peserta Didik';
		$data['form_small']='Ubah Data';
		$data['view']='view';
    $data['report']=1;
		$data['idcalon']=$idcalon;
		$data['tipedata']=$tipedata;
		$data['printvar']=$idcalon."/".$replidkeg;
		$data['action']='psb_assessment_report/tambah_p/'.$tipedata.'/'.$idcalon."/".$replidkeg;
		$data= $this->psb_assessment_db->tambah_db($tipedata,$data,$idcalon,$replidkeg);
		$this->load->view('psb_assessment_v',$data);
	}
}//end of class
?>
