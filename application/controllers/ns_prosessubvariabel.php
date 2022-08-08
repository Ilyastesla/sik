<?php

session_start(); //we need to start session in order to access it through CI

Class ns_prosessubvariabel extends CI_Controller {

public function __construct() {
parent::__construct();

		// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');


		// Load session library
		$this->load->library('session');

		// Load database
		$this->load->model('ns_prosessubvariabel_db');

   if( $this->session->userdata('logged_in')) {
       if($this->dbx->checkpage($this->session->userdata('role_id'),'ns_prosessubvariabel')==false){
          redirect('user_authentication');
       }
		}else{
			redirect('user_authentication');;
		}

	}

	public function index()
	{
			$data['show_table'] = $this->ns_prosessubvariabel_db->data();
			$data['form']='Sub Variabel Proses Siswa';
			$data['view']='index';
			$this->load->view('ns_prosessubvariabel_v', $data);
	}

	// TAMBAH
	//-------------------------------------------------------------------------------------------
	public function tambah($id='') {
		$data['form']='Sub Variabel Proses Siswa';
		$data['form_small']='Tambah Data';
		$data['view']='tambah';
		$data['action']='ns_prosessubvariabel/tambah_p';
		$data= $this->ns_prosessubvariabel_db->tambah_db($id,$data);
		$this->load->view('ns_prosessubvariabel_v',$data);
	}

	public function tambah_p($id='') {
		$data = array(
				'prosessubvariabel' => $this->input->post('prosessubvariabel'),
				'idprosesvariabel' => $this->input->post('idprosesvariabel'),
				'no_urut' => $this->input->post('no_urut'),
				'keterangan' => $this->input->post('keterangan'),
				'persentasemurnisv' => $this->input->post('persentasemurnisv'),
				'aktif' => $this->input->post('aktif'),
				"modified_date"=> $this->dbx->cts(),
				"modified_by"=> $this->session->userdata('idpegawai'));

		if ($id<>""){
			$result = $this->ns_prosessubvariabel_db->ubah_pdb($data,$id) ;
		}else{
			$data = $this->p_c->arraymerge(array('created_date' => $this->dbx->cts()), $data);
			$data = $this->p_c->arraymerge(array('created_by' => $this->session->userdata('idpegawai')), $data);
			$id = $this->ns_prosessubvariabel_db->tambah_pdb($data) ;
			if ($id<>""){$result=TRUE;}
		}

		if ($result == TRUE) {
			redirect('ns_prosessubvariabel');
		} else {
			$data['error']='Errorr...';
			$this->ubah($id,$data);
		}
	}

	// UBAH
	//-------------------------------------------------------------------------------------------
	public function ubah($id,$stat='') {
		$data['form']='Sub Variabel Proses Siswa';
		$data['form_small']='Ubah Data';
		$data['view']='tambah';
		$data['action']='ns_prosessubvariabel/tambah_p/'.$id;
		$data= $this->ns_prosessubvariabel_db->tambah_db($id,$data);
		$this->load->view('ns_prosessubvariabel_v',$data);
	}

	//Hapus
	public function hapus($id) {
		$result = $this->ns_prosessubvariabel_db->hapus_pdb($id) ;
		if ($result == TRUE) {
			redirect('ns_prosessubvariabel');
		}
	}

}//end of class
?>
