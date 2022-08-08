<?php

session_start(); //we need to start session in order to access it through CI

Class reff_propinsi extends CI_Controller {

public function __construct() {
parent::__construct();

		// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');


		// Load session library
		$this->load->library('session');

		// Load database
		$this->load->model('reff_propinsi_db');

   if( $this->session->userdata('logged_in')) {
       if($this->dbx->checkpage($this->session->userdata('role_id'),'reff_propinsi')==false){
          redirect('user_authentication');
       }
		}else{
			redirect('user_authentication');;
		}

	}

	public function index()
	{
			$data['show_table'] = $this->reff_propinsi_db->data();
			$data['form']='Propinsi';
			$data['view']='index';
			$this->load->view('reff_propinsi_v', $data);
	}

	// TAMBAH
	//-------------------------------------------------------------------------------------------
	public function tambah($id='') {
		$data['form']='Propinsi';
		$data['form_small']='Tambah Data';
		$data['view']='tambah';
		$data['action']='reff_propinsi/tambah_p';
		$data= $this->reff_propinsi_db->tambah_db($id,$data);
		$this->load->view('reff_propinsi_v',$data);
	}

	public function tambah_p($id='') {
		//'persentase' => $this->input->post('persentase'),
		$data = array(
				'id_negara' => $this->input->post('id_negara'),
				'propinsi' => $this->input->post('propinsi'));

		if ($id<>""){
			$result = $this->dbx->ubahdata('propinsi',$data,'replid',$id);
		}else{
			//$data = $this->p_c->arraymerge(array('created_date' => $this->dbx->cts()), $data);
			//$data = $this->p_c->arraymerge(array('created_by' => $this->session->userdata('idpegawai')), $data);
			$id = $this->dbx->tambahdata('propinsi',$data);
			if ($id<>""){$result=TRUE;}
		}

		if ($result == TRUE) {
			redirect('reff_propinsi');
		} else {
			$data['error']='Errorr...';
			$this->ubah($id,$data);
		}
	}

	// UBAH
	//-------------------------------------------------------------------------------------------
	public function ubah($id,$stat='') {
		$data['form']='Propinsi';
		$data['form_small']='Ubah Data';
		$data['view']='tambah';
		$data['action']='reff_propinsi/tambah_p/'.$id;
		$data= $this->reff_propinsi_db->tambah_db($id,$data);
		$this->load->view('reff_propinsi_v',$data);
	}

	//Hapus
	public function hapus($id) {
		$result = $this->dbx->hapusdata('propinsi','replid',$id);
		if ($result == TRUE) {
			redirect('reff_propinsi');
		}
	}

}//end of class
?>
