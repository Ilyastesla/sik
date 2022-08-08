<?php

session_start(); //we need to start session in order to access it through CI

Class hrm_event_rekap extends CI_Controller {

public function __construct() {
	parent::__construct();

		// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');


		// Load session library
		$this->load->library('session');

		// Load database
		$this->load->model('hrm_event_db');

		if( $this->session->userdata('logged_in')) {
			if($this->dbx->checkpage($this->session->userdata('role_id'),'hrm_event_rekap')==false){
					redirect('user_authentication');
			}
		}else{
			redirect('user_authentication');;
		}
	}

  public function index()
	{
			$data['form']='Rekapitulasi Pelatihan';
			$data['view']='index';
			$data['action']='hrm_event/rekap';
			$data['ubah']=3;
			$data = $this->hrm_event_db->data($data);
			$this->load->view('hrm_event_v', $data);
	}
}
