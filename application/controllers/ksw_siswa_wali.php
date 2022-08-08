<?php

session_start(); //we need to start session in order to access it through CI

Class ksw_siswa_wali extends CI_Controller {

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
			if($this->dbx->checkpage($this->session->userdata('role_id'),'ksw_siswa_wali')==false){
					redirect('user_authentication');
			}
		}else{
			redirect('user_authentication');;
		}

	}

	public function index()
	{
		$data= $this->ksw_siswa_db->data();
		$data['idtahunajaran_opt']=array();
		$data['idtahunajaran_opt'] = $this->dbx->opt("SELECT replid,CONCAT('[',departemen,'] ',tahunajaran) as nama FROM tahunajaran WHERE idcompany='".$this->input->post('idcompany')."' AND departemen='".$this->input->post('iddepartemen')."' AND aktif=1 ORDER BY aktif DESC ,nama DESC ",'up');
		$sessionkelas="";
				/*
				if ($this->session->userdata('kelas')<>""){
			$sessionkelas=" AND k.replid IN (".$this->session->userdata('kelas').") ";
		}else{
			$sessionkelas=" AND k.replid=0 ";
		}
			*/
		$data['idkelas_opt']=array();
		$data['idkelas_opt'] = $this->dbx->opt("SELECT k.replid,k.kelas as nama 
													FROM kelas k
													INNER JOIN tahunajaran ta ON ta.replid=k.idtahunajaran 
													WHERE k.aktif=1
													AND ta.idcompany='".$this->input->post('idcompany')."'
													AND ta.replid='".$this->input->post('idtahunajaran')."'
													AND k.idtingkat='".$this->input->post('idtingkat')."'
													".$sessionkelas."
													ORDER BY nama",'up');
		
			$data['form']='Data Siswa';
			$data['view']='index';
			$data['action']='ksw_siswa_wali';
			$this->load->view('ksw_siswa_v', $data);
	}

}//end of class
?>
