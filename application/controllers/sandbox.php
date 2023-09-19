<?php 
Class sandbox extends CI_Controller {

	public function __construct() {
		parent::__construct();
				// Load database
				// Load form helper library
		$this->load->helper('form');
		// Load form validation library
		$this->load->library('form_validation');
		$this->load->model('sandbox_db');
			
	}
	
	public function index() {
		$data = $this->sandbox_db->loaddata(3);
		$data['form']='Departemen';
		$data['view']='index';
		$data['action']='sandbox';
		
		$this->load->view('aaaasandbox_v',$data);
		/*
		$data=array();
		//$this->load->view('sandbox_v',$data);
		$data = $this->departemen_db->data();
		
		
		$data['action']='sandbox';
		$this->load->view('aaaasandbox_v',$data);
		*/
	}

}
?>
