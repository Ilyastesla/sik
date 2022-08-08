<?php

session_start(); //we need to start session in order to access it through CI

Class inventory_list_inventaris extends CI_Controller {

public function __construct() {
	parent::__construct();

		// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');


		// Load session library
		$this->load->library('session');

		// Load database
		$this->load->model('inventory_list_inventaris_db');

		if( $this->session->userdata('logged_in')) {
			if($this->dbx->checkpage($this->session->userdata('role_id'),'inventory_list_inventaris')==false){
					redirect('user_authentication');
			}
		}else{
			redirect('user_authentication');;
		}

	}

	public function index()
	{
			$data= $this->inventory_list_inventaris_db->data();
			$data['form']="Daftar Inventaris";
			$data['view']='index';
			$data['action']='inventory_list_inventaris';
			$this->load->view('inventory_list_inventaris_v', $data);
	}


	public function printlistinventaris($excel="")
	{	
		$data= $this->inventory_list_inventaris_db->data();
		$data['form']='List Inventaris';
		$data['excel']=$excel;
		$this->load->view('inventory_list_inventaris_print_v',$data);
	}
}//end of class
?>
