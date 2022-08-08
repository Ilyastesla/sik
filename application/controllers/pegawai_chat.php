<?php

session_start(); //we need to start session in order to access it through CI

Class pegawai_chat extends CI_Controller {

public function __construct() {
	parent::__construct();

		// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');


		// Load session library
		$this->load->library('session');

		// Load database
		$this->load->model('pegawai_chat_db');

   if( $this->session->userdata('logged_in')) {
       if($this->dbx->checkpage($this->session->userdata('role_id'),'pegawai_chat')==false){
          redirect('user_authentication');
       }
		}else{
			redirect('user_authentication');;
		}

	}

	public function index()
	{
			$data['show_table'] = $this->pegawai_chat_db->data();
			$data['form']='Percakapan';
			$data['view']='index';
			$this->load->view('pegawai_chat_v', $data);
	}

	public function view($from,$to) {
		$data['form']='Percakapan';
		$data['form_small']='Lihat';
		$data['view']='view';
		$data['action']='pegawai_chat';
		$data= $this->pegawai_chat_db->view_db($from,$to,$data);
		$this->load->view('pegawai_chat_v',$data);
	}


}//end of class
?>
