<?php 
	Class sandbox extends CI_Controller {

		public function __construct() {
		parent::__construct();
				// Load database
				// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');
			}
		
			public function index() {
				$this->load->model('departemen_db');
				$data="";
				//$this->load->view('sandbox_v',$data);
				$data = $this->departemen_db->data();
			$data['form']='Departemen';
			$data['view']='index';
			$data['action']='sandbox';
				$this->load->view('aaaasandbox_v',$data);
			}
		}
?>
