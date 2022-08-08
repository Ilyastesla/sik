<?php

session_start(); //we need to start session in order to access it through CI

Class inventory_organization extends CI_Controller {

public function __construct() {
	parent::__construct();

		// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');


		// Load session library
		$this->load->library('session');

		// Load database
		$this->load->model('inventory_organization_db');

		if( $this->session->userdata('logged_in')) {
			if($this->dbx->checkpage($this->session->userdata('role_id'),'inventory_organization')==false){
					redirect('user_authentication');
			}
		}else{
			redirect('user_authentication');;
		}

	}

	public function index()
	{
			$data['show_table'] = $this->inventory_organization_db->data();
			$data['form']='Organisasi Perusahaan';
			$data['view']='index';
			$this->load->view('inventory_organization_v', $data);
	}

	// TAMBAH
	//-------------------------------------------------------------------------------------------
	public function tambah($id='') {
		$data['form']='Organisasi Perusahaan';
		$data['form_small']='Tambah Data';
		$data['view']='tambah';
		$data['action']='inventory_organization/tambah_p';
		$data= $this->inventory_organization_db->tambah_x($id,$data);
		$this->load->view('inventory_organization_v',$data);
	}

	public function tambah_p($id='') {
	    //"penerima"=> $this->input->post("penerima"),
	    //"tanggalpenerima"=> $this->input->post("tanggalpenerima"),
		$data = array(
				"organizationcode"=> $this->input->post("organizationcode"),
				"organizationname"=> $this->input->post("organizationname"),
				"aktif"=> $this->input->post("aktif"),
				"modified_date"=> $this->dbx->cts(),
				"modified_by"=> $this->session->userdata('idpegawai'));
		if ($id<>""){
			$result = $this->inventory_organization_db->ubah($data,$id) ;
		}else{
			$data = $this->p_c->arraymerge(array('created_date' => $this->dbx->cts()), $data);
			$data = $this->p_c->arraymerge(array('created_by' => $this->session->userdata('idpegawai')), $data);
			$id = $this->inventory_organization_db->tambah($data);
			if ($id<>""){$result=TRUE;}
		}

		if ($result == TRUE) {
			redirect('inventory_organization');
		} else {
			$data['error']='Errorr...';
			$this->ubah($id,$data);
		}
	}

	// UBAH
	//-------------------------------------------------------------------------------------------
	public function ubah($id,$stat='') {
		$data['form']='Organisasi Perusahaan';
		$data['form_small']='Ubah Data';
		$data['view']='tambah';
		$data['action']='inventory_organization/tambah_p/'.$id;
		$data= $this->inventory_organization_db->tambah_x($id,$data);
		$this->load->view('inventory_organization_v',$data);
	}

	public function hapus($id) {
		$result = $this->inventory_organization_db->hapus_db($id) ;
		if ($result == TRUE) {
			redirect('inventory_organization');
		}
	}


}//end of class
?>
