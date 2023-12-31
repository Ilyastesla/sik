<?php

session_start(); //we need to start session in order to access it through CI

Class reff_kecamatan extends CI_Controller {

public function __construct() {
parent::__construct();

		// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');


		// Load session library
		$this->load->library('session');

		// Load database
		$this->load->model('reff_kecamatan_db');

   if( $this->session->userdata('logged_in')) {
       if($this->dbx->checkpage($this->session->userdata('role_id'),'reff_kecamatan')==false){
          redirect('user_authentication');
       }
		}else{
			redirect('user_authentication');;
		}

	}

	public function index()
	{
			$data['show_table'] = $this->reff_kecamatan_db->data();
			$data['form']='Kecamatan';
			$data['view']='index';
			$this->load->view('reff_kecamatan_v', $data);
	}

	// TAMBAH
	//-------------------------------------------------------------------------------------------
	public function tambah($id='') {
		$data['form']='Kecamatan';
		$data['form_small']='Tambah Data';
		$data['view']='tambah';
		$data['action']='reff_kecamatan/tambah_p';
		$data= $this->reff_kecamatan_db->tambah_db($id,$data);
		$this->load->view('reff_kecamatan_v',$data);
	}

	public function tambah_p($id='') {
		//'persentase' => $this->input->post('persentase'),
		$data = array(
			"kecamatan" => $this->input->post("kecamatan"),
			"id_kota" => $this->input->post("idkota"));

		if ($id<>""){
			$result = $this->dbx->ubahdata('kecamatan',$data,'replid',$id);
		}else{
			// $data = $this->p_c->arraymerge(array('created_date' => $this->dbx->cts()), $data);
			// $data = $this->p_c->arraymerge(array('created_by' => $this->session->userdata('idpegawai')), $data);
			$id = $this->dbx->tambahdata('kecamatan',$data);
			if ($id<>""){$result=TRUE;}
		}

		if ($result == TRUE) {
			redirect('reff_kecamatan');
		} else {
			$data['error']='Errorr...';
			$this->ubah($id,$data);
		}
	}

	// UBAH
	//-------------------------------------------------------------------------------------------
	public function ubah($id,$stat='') {
		$data['form']='Kecamatan';
		$data['form_small']='Ubah Data';
		$data['view']='tambah';
		$data['action']='reff_kecamatan/tambah_p/'.$id;
		$data= $this->reff_kecamatan_db->tambah_db($id,$data);
		$this->load->view('reff_kecamatan_v',$data);
	}

	//Hapus
	public function hapus($id) {
		$result = $this->dbx->hapusdata('kecamatan','replid',$id);
		if ($result == TRUE) {
			redirect('reff_kecamatan');
		}
	}

}//end of class
?>
