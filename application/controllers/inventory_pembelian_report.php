<?php

session_start(); //we need to start session in order to access it through CI

Class inventory_pembelian_report extends CI_Controller {

public function __construct() {
	parent::__construct();

		// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');


		// Load session library
		$this->load->library('session');

		// Load database
		$this->load->model('inventory_pembelian_report_db');

		if( $this->session->userdata('logged_in')) {
			if($this->dbx->checkpage($this->session->userdata('role_id'),'inventory_pembelian_report')==false){
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

			$data = $this->inventory_pembelian_report_db->data($this->input->post('filter'));
			$data['form']='Pembelian Barang';
			$data['view']='index';
			$data['action']='inventory_pembelian_report';
			$this->load->view('inventory_pembelian_report_v', $data);
	}
	// TAMBAH
	//-------------------------------------------------------------------------------------------
	public function tambah($id='') {
		$data['form']='Laporan Pembelian Barang';
		$data['form_small']='Tambah Data';
		$data['view']='tambah';
		$data['action']='inventory_pembelian_report/tambah_p';
		$data= $this->inventory_pembelian_report_db->tambah_x($id,$data);
		$this->load->view('inventory_pembelian_report_v',$data);
	}
}//end of class
?>
