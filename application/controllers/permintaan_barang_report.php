<?php

session_start(); //we need to start session in order to access it through CI

Class permintaan_barang_report extends CI_Controller {

public function __construct() {
	parent::__construct();

		// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');


		// Load session library
		$this->load->library('session');

		// Load database
		$this->load->model('permintaan_barang_report_db');

   if( $this->session->userdata('logged_in')) {
       if($this->dbx->checkpage($this->session->userdata('role_id'),'permintaan_barang_report')==false){
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
							'iddepartemen'=>''
							,'pemohon'=>''
							,'idstatus'=>''
							,'periode1'=>''
							,'periode2'=>''
						);
						$this->session->unset_userdata($data);
			}else{
				$data = array(
									'iddepartemen'=>$this->input->post('iddepartemen'),
									'pemohon'=>$this->input->post('pemohon'),
									'idstatus'=>$this->input->post('idstatus'),
									'periode1'=>$this->input->post('periode1'),
									'periode2'=>$this->input->post('periode2')
								);
				$this->session->set_userdata($data);
			}
			$data = $this->permintaan_barang_report_db->data($this->input->post('filter'));
			$data['form']='Laporan Permintaan Barang';
			$data['view']='index';
			$data['action']='permintaan_barang_report';
			$this->load->view('permintaan_barang_report_v', $data);
	}
}//end of class
?>
