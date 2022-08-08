<?php

session_start(); //we need to start session in order to access it through CI

Class inventory_terima extends CI_Controller {

public function __construct() {
	parent::__construct();

		// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');


		// Load session library
		$this->load->library('session');

		// Load database
		$this->load->model('inventory_terima_db');

		if( $this->session->userdata('logged_in')) {
			if($this->dbx->checkpage($this->session->userdata('role_id'),'inventory_terima')==false){
					redirect('user_authentication');
			}
		}else{
			redirect('user_authentication');;
		}

	}

	public function index()
	{
			if ($this->input->post('reset')==1){
				$data = array(
							'idstatus'=>''
							,'periode1'=>''
							,'periode2'=>''
						);
						$this->session->unset_userdata($data);
			}else{
				$data = array(
									'idstatus'=>$this->input->post('idstatus'),
									'periode1'=>$this->input->post('periode1'),
									'periode2'=>$this->input->post('periode2')
								);
				$this->session->set_userdata($data);
			}

			$data = $this->inventory_terima_db->data($this->input->post('filter'));
			$data['form']='Terima Barang';
			$data['view']='index';
			$data['action']='inventory_terima';
			$this->load->view('inventory_terima_v', $data);
	}
}//end of class
?>
