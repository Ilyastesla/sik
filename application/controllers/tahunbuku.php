<?php

session_start(); //we need to start session in order to access it through CI

Class tahunbuku extends CI_Controller {

public function __construct() {
parent::__construct();

	// Load form helper library
	$this->load->helper('form');

	// Load form validation library
	$this->load->library('form_validation');

	// Load session library
	$this->load->library('session');

	// Load database
	$this->load->model('tahunbuku_db');
	if( $this->session->userdata('logged_in')) {
			if($this->dbx->checkpage($this->session->userdata('role_id'),'tahunbuku')==false){
				 redirect('user_authentication');
			}
	 }else{
		 redirect('user_authentication');;
	 }

}

public function index()
{
	$data['show_table'] = $this->tahunbuku_db->tahunbuku_data();
	$data['type']=1;
	$data['form']='Tahun Buku';
	$this->load->view('tahunbuku', $data);
}

public function cekaktif($data){
	if ($data != false) {
		return 'Ya';
	} else {
		return 'Tidak';
	}
}

} //end of class
?>
