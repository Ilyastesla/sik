<?php

session_start(); //we need to start session in order to access it through CI

Class inventory_vendor extends CI_Controller {

public function __construct() {
	parent::__construct();

		// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');


		// Load session library
		$this->load->library('session');

		// Load database
		$this->load->model('inventory_vendor_db');

		if( $this->session->userdata('logged_in')) {
			if($this->dbx->checkpage($this->session->userdata('role_id'),'inventory_vendor')==false){
					redirect('user_authentication');
			}
		}else{
			redirect('user_authentication');;
		}

	}

	public function index()
	{
			$data['show_table'] = $this->inventory_vendor_db->data();
			$data['form']='Data Vendor';
			$data['view']='index';
			$this->load->view('inventory_vendor_v', $data);
	}


	// TAMBAH
	//-------------------------------------------------------------------------------------------
	public function tambah($id='') {
		$data['form']='Data Vendor';
		$data['form_small']='Tambah Data';
		$data['view']='tambah';
		$data['action']='inventory_vendor/tambah_p';
		$data= $this->inventory_vendor_db->tambah_x($id,$data);
		$this->load->view('inventory_vendor_v',$data);
	}

	public function tambah_p($id='') {
	    //"penerima"=> $this->input->post("penerima"),
	    //"tanggalpenerima"=> $this->input->post("tanggalpenerima"),
		$data = array(
			"idorganization"=>$this->input->post("idorganization"),
			"contactperson"=>$this->input->post("contactperson"),
			"nama"=>$this->input->post("nama"),
			"street"=>$this->input->post("street"),
			"city"=>$this->input->post("city"),
			"zip"=>$this->input->post("zip"),
			"country"=>$this->input->post("country"),
			"phone"=>$this->input->post("phone"),
			"mobile"=>$this->input->post("mobile"),
			"website"=>$this->input->post("website"),
			"fax"=>$this->input->post("fax"),
			"email"=>$this->input->post("email"),
			"npwp"=>$this->input->post("npwp"),
			"notes"=>$this->input->post("notes"),
			"is_corporate"=>$this->input->post("is_corporate"),
			"aktif"=>$this->input->post("aktif"),
			"modified_date"=> $this->dbx->cts(),
			"modified_by"=> $this->session->userdata('idpegawai'));
		if ($id<>""){
			$result = $this->inventory_vendor_db->ubah($data,$id) ;
		}else{
			$data = $this->p_c->arraymerge(array('created_date' => $this->dbx->cts()), $data);
			$data = $this->p_c->arraymerge(array('created_by' => $this->session->userdata('idpegawai')), $data);
			$id = $this->inventory_vendor_db->tambah($data);
			if ($id<>""){$result=TRUE;}
		}

		if ($result == TRUE) {
			redirect('inventory_vendor');
		} else {
			$data['error']='Errorr...';
			$this->ubah($id,$data);
		}
	}

	// UBAH
	//-------------------------------------------------------------------------------------------
	public function ubah($id,$stat='') {
		$data['form']='Data Vendor';
		$data['form_small']='Ubah Data';
		$data['view']='tambah';
		$data['action']='inventory_vendor/tambah_p/'.$id;
		$data= $this->inventory_vendor_db->tambah_x($id,$data);
		$this->load->view('inventory_vendor_v',$data);
	}

	public function hapus($id) {
		$result = $this->inventory_vendor_db->hapus_db($id) ;
		if ($result == TRUE) {
			redirect('vendor');
		}
	}

	public function view($id) {
		$data['form']='Material Barang';
		$data['form_small']='Lihat Data';
		$data['view']='view';
		$data['action']='inventory_vendor/ubah/'.$id;
		$data= $this->inventory_vendor_db->view_db($id,$data);
		$this->load->view('inventory_vendor_v',$data);
	}

}//end of class
?>
