<?php

session_start(); //we need to start session in order to access it through CI

Class reff_identitas extends CI_Controller {

public function __construct() {
parent::__construct();

		// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');


		// Load session library
		$this->load->library('session');

		// Load database
		$this->load->model('reff_identitas_db');

   if( $this->session->userdata('logged_in')) {
       if($this->dbx->checkpage($this->session->userdata('role_id'),'reff_identitas')==false){
          redirect('user_authentication');
       }
		}else{
			redirect('user_authentication');;
		}

	}

	public function index()
	{
			$data['show_table'] = $this->reff_identitas_db->data();
			$data['form']='Identitas';
			$data['view']='index';
			$this->load->view('reff_identitas_v', $data);
	}
	// TAMBAH
	//-------------------------------------------------------------------------------------------
	public function tambah($id='') {
		$data['form']='Identitas';
		$data['form_small']='Tambah Data';
		$data['view']='tambah';
		$data['action']='reff_identitas/tambah_p';
		$data= $this->reff_identitas_db->tambah_db($id,$data);
		$this->load->view('reff_identitas_v',$data);
	}

	public function tambah_p() {
		$data = array(
				"departemen"=>$this->input->post("departemen"),
				"nama"=>$this->input->post("nama"),
				"situs"=>$this->input->post("situs"),
				"email"=>$this->input->post("email"),
				"alamat1"=>$this->input->post("alamat1"),
				"alamat2"=>$this->input->post("alamat2"),
				"alamat3"=>$this->input->post("alamat3"),
				"alamat4"=>$this->input->post("alamat4"),
				"telp1"=>$this->input->post("telp1"),
				"telp2"=>$this->input->post("telp2"),
				"telp3"=>$this->input->post("telp3"),
				"telp4"=>$this->input->post("telp4"),
				"fax1"=>$this->input->post("fax1"),
				"fax2"=>$this->input->post("fax2"),
				"keterangan"=>$this->input->post("keterangan"),
				"status"=>$this->input->post("status"),
				"perpustakaan"=>$this->input->post("perpustakaan"),
				"kode_cabang"=>$this->input->post("kode_cabang"),
				"modified_date"=> $this->dbx->cts(),
				"modified_by"=> $this->session->userdata('idpegawai'));
		if ($this->input->post("replid")<>""){
			$data = $this->p_c->arraymerge(array('created_date' => $this->dbx->cts()), $data);
			$data = $this->p_c->arraymerge(array('created_by' => $this->session->userdata('idpegawai')), $data);
			$result = $this->reff_identitas_db->ubah($data,$this->input->post("replid")) ;
		}else{
			$id = $this->reff_identitas_db->tambah_pdb($data) ;
			if ($id<>""){$result=TRUE;}
		}

		if ($result == TRUE) {
			redirect("reff_identitas");
		} else {
			$data['error']="Errorr...";
			$this->ubah($id,$data);
		}
	}

	// UBAH
	//-------------------------------------------------------------------------------------------
	public function ubah($id) {
		$data['form']='Identitas';
		$data['form_small']='Ubah Data';
		$data['view']='tambah';
		$data['action']='reff_identitas/tambah_p/'.$id;
		$data= $this->reff_identitas_db->tambah_db($id,$data);
		$this->load->view('reff_identitas_v',$data);
	}

	// HAPUS
	//-------------------------------------------------------------------------------------------
	public function hapus($id) {
		$result = $this->reff_identitas_db->hapus_db($id) ;
		if ($result == TRUE) {
			redirect('reff_identitas');
		}
	}
}//end of class
?>
