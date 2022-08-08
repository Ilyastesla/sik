<?php

session_start(); //we need to start session in order to access it through CI

Class ns_predikatgraph extends CI_Controller {

public function __construct() {
parent::__construct();

		// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');


		// Load session library
		$this->load->library('session');

		// Load database
		$this->load->model('ns_predikatgraph_db');

	  if( $this->session->userdata('logged_in')) {
       if($this->dbx->checkpage($this->session->userdata('role_id'),'ns_predikatgraph')==false){
          redirect('user_authentication');
       }
		}else{
			redirect('user_authentication');;
		}

	}

	public function index()
	{
			$data['show_table'] = $this->ns_predikatgraph_db->data();
			$data['form']='Predikat Untuk Rapor Grafik';
			$data['view']='index';
			$this->load->view('ns_predikatgraph_v', $data);
	}


	// TAMBAH
	//-------------------------------------------------------------------------------------------
	public function tambah($id='') {
		$data['form']='Predikat Untuk Rapor Gra';
		$data['form_small']='Tambah Data';
		$data['edit']=0;
		$data['view']='tambah';
		$data['action']='ns_predikatgraph/tambah_p';
		$data= $this->ns_predikatgraph_db->tambah_db($id,$data);
		$this->load->view('ns_predikatgraph_v',$data);
	}

	public function tambah_p($id='') {
		$data = array(
				'idpengembangandiri' => $this->input->post('idpengembangandiri'),
				'predikatgraph' => $this->input->post('predikat'),
				'dari' => $this->input->post('dari'),
				'sampai' => $this->input->post('sampai'),
				'aktif' => $this->input->post('aktif'),
				'deskripsi' => $this->input->post('deskripsi'),
				"modified_date"=> $this->dbx->cts(),
				"modified_by"=> $this->session->userdata('idpegawai'));
		if ($id<>""){
			$result = $this->ns_predikatgraph_db->ubah_pdb($data,$id) ;
		}else{
			$data = $this->p_c->arraymerge(array('created_date' => $this->dbx->cts()), $data);
			$data = $this->p_c->arraymerge(array('created_by' => $this->session->userdata('idpegawai')), $data);
			$id = $this->ns_predikatgraph_db->tambah_pdb($data) ;
			if ($id<>""){$result=TRUE;}
		}

		if ($result == TRUE) {
			redirect('ns_predikatgraph');
		} else {
			$data['error']='Errorr...';
			$this->ubah($id);
		}
	}
	// UBAH
	//-------------------------------------------------------------------------------------------
	public function ubah($id) {
		$data['form']='Predikat Untuk Rapor Gra';
		$data['form_small']='Ubah Data';
		$data['view']='tambah';
		$data['edit']=1;
		$data['action']='ns_predikatgraph/tambah_p/'.$id;
		$data= $this->ns_predikatgraph_db->tambah_db($id,$data);
		$this->load->view('ns_predikatgraph_v',$data);
	}

	//Hapus
	public function hapus($id) {
		$result = $this->ns_predikatgraph_db->hapus_pdb($id) ;
		if ($result == TRUE) {
			redirect('ns_predikatgraph');
		}
	}

}//end of class
?>
