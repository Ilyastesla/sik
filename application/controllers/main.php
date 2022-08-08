<?php

session_start(); //we need to start session in order to access it through CI

Class main extends CI_Controller {

public function __construct() {
parent::__construct();

		// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');


		// Load session library
		$this->load->library('session');

		// Load database
		$this->load->model('main_db');
		
		if( $this->session->userdata('logged_in')) {
		}else{
			redirect('user_authentication');;
		}

	}

	public function index()
	{
		$data = $this->main_db->data();
		$data['type']=1;
		$data['form']='BERANDA';
		$data['form_small']='Berita dan Pemberitahuan';
		$this->load->view('main_v', $data);
	}

	public function menu($pages,$head)
	{

		$pages=str_replace(".", "/", $pages);
		$data = array('head_menu'=>$head);
		$this->session->set_userdata($data);
		redirect(site_url($pages), 'refresh');
	}
} //end of class
?>
