<?php

session_start(); //we need to start session in order to access it through CI

Class ksw_siswa_all extends CI_Controller {

public function __construct() {
parent::__construct();

		// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');


		// Load library
		$this->load->library('session');

		// Load database
		$this->load->model('ksw_siswa_db');

		if( $this->session->userdata('logged_in')) {
			if($this->dbx->checkpage($this->session->userdata('role_id'),'ksw_siswa_all')==false){
					redirect('user_authentication');
			}
		}else{
			redirect('user_authentication');;
		}

	}

	public function index()
	{
		$data= $this->ksw_siswa_db->data();
		$data['idcompany_opt']=array();
		$sqlcompany="SELECT com.replid,com.nama as nama
									FROM hrm_company com
									INNER JOIN tahunajaran ta ON ta.idcompany=com.replid 
									WHERE com.aktif=1 AND ta.aktif=1 
									ORDER BY com.nama";
		$data['idcompany_opt'] = $this->dbx->opt($sqlcompany,'up');
		
		
			$data['form']='Data Siswa';
			$data['view']='index';
			$data['action']='ksw_siswa_all';
			$this->load->view('ksw_siswa_v', $data);
	}

}//end of class
?>
