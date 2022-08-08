<?php

session_start(); //we need to start session in order to access it through CI

Class loa extends CI_Controller {

public function __construct() {
	parent::__construct();

		// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');


		// Load session library
		$this->load->library('session');

		// Load database
		$this->load->model('loa_db');

		if( $this->session->userdata('logged_in')) {
			if($this->dbx->checkpage($this->session->userdata('role_id'),'loa')==false){
					redirect('user_authentication');
			}
		}else{
			redirect('user_authentication');;
		}

	}

	public function index()
	{
			$data['show_table'] = $this->loa_db->data();
			$data['form']='Line Of Approval';
			$data['view']='index';
			$this->load->view('loa_v', $data);
	}

	// TAMBAH
	//-------------------------------------------------------------------------------------------
	public function tambah($id='') {
		$data['form']='Line Of Approval';
		$data['form_small']='Tambah Data';
		$data['view']='tambah';
		$data['action']='loa/tambah_p';
		$data= $this->loa_db->tambah_x($id,$data);
		$this->load->view('loa_v',$data);
	}

	public function tambah_p($id='') {
	    //"penerima"=> $this->input->post("penerima"),
	    //"tanggalpenerima"=> $this->input->post("tanggalpenerima"),
		$data = array(
				"idmodul"=> $this->input->post("idmodul"),
				"idjabatan_grup"=> $this->input->post("idjabatan_grup"),
				"iddepartemen"=> $this->input->post("iddepartemen"),
				"node"=> $this->input->post("node"),
				"next_node"=> $this->input->post("next_node"),
				"default_node"=> $this->input->post("default_node"),
				"aktif"=> $this->input->post("aktif"),
				"modified_date"=> $this->dbx->cts(),
				"modified_by"=> $this->session->userdata('idpegawai'));
		if ($id<>""){
			$result = $this->dbx->ubahdata('hrm_loa',$data,'replid',$id);
		}else{
			$data = $this->p_c->arraymerge(array('created_date' => $this->dbx->cts()), $data);
			$data = $this->p_c->arraymerge(array('created_by' => $this->session->userdata('idpegawai')), $data);
			$id = $this->dbx->tambahdata('hrm_loa',$data);
			if ($id<>""){$result=TRUE;}
		}

		if ($result == TRUE) {
			redirect('loa');
		} else {
			$data['error']='Errorr...';
			$this->ubah($id,$data);
		}
	}

	// UBAH
	//-------------------------------------------------------------------------------------------
	public function ubah($id,$stat='') {
		$data['form']='Line Of Approval';
		$data['form_small']='Ubah Data';
		$data['view']='tambah';
		$data['action']='loa/tambah_p/'.$id;
		$data= $this->loa_db->tambah_x($id,$data);
		$this->load->view('loa_v',$data);
	}

	public function hapus($id) {
		$result = $this->dbx->hapusdata('hrm_loa','replid',$id);
		if ($result == TRUE) {
			redirect('loa');
		}
	}


}//end of class
?>
