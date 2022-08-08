<?php

session_start(); //we need to start session in order to access it through CI

Class psb_kelulusan extends CI_Controller {

public function __construct() {
parent::__construct();

		// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');


		// Load library
		$this->load->library('session');

		// Load database
		$this->load->model('psb_kelulusan_db');

   if( $this->session->userdata('logged_in')) {
       if($this->dbx->checkpage($this->session->userdata('role_id'),'psb_kelulusan')==false){
          redirect('user_authentication');
       }
		}else{
			redirect('user_authentication');;
		}

	}

	public function index()
	{
			$data = $this->psb_kelulusan_db->data();
			$data['form']='Pernyataan Kelulusan';
			$data['view']='index';
			$data['action']='psb_kelulusan';
			$this->load->view('psb_kelulusan_v', $data);
	}

	// TAMBAH
	//-------------------------------------------------------------------------------------------
  public function tambah($idcalon) {
		$data['form']='Pernyataan Kelulusan';
		$data['form_small']='Ubah Data';
		$data['view']='tambah';
		$data['idcalon']=$idcalon;
		$data['action']='psb_kelulusan/tambah_p/'.$idcalon;
		$data= $this->psb_kelulusan_db->tambah_db($data,$idcalon);
		$this->load->view('psb_kelulusan_v',$data);
	}

}//end of class
?>
