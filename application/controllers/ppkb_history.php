<?php

session_start(); //we need to start session in order to access it through CI

Class ppkb_history extends CI_Controller {

public function __construct() {
	parent::__construct();

		// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');


		// Load session library
		$this->load->library('session');

		// Load database
		$this->load->model('ppkb_history_db');

   if( $this->session->userdata('logged_in')) {
       if($this->dbx->checkpage($this->session->userdata('role_id'),'ppkb_history')==false){
          redirect('user_authentication');
       }
		}else{
			redirect('user_authentication');
		}
	}

	public function index()
	{
		$data['show_table'] = $this->ppkb_history_db->data();
		$data['form']='Pengajuan Pengeluaran Kas Besar';
		$data['view']='index';
		$this->load->view('ppkb_history_v', $data);
	}

}//end of class
?>
