<?php

session_start(); //we need to start session in order to access it through CI

Class reff_jenjang extends CI_Controller {

public function __construct() {
parent::__construct();

		// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');


		// Load session library
		$this->load->library('session');

		// Load database
		$this->load->model('reff_jenjang_db');

   if( $this->session->userdata('logged_in')) {
       if($this->dbx->checkpage($this->session->userdata('role_id'),'reff_jenjang')==false){
          redirect('user_authentication');
       }
		}else{
			redirect('user_authentication');;
		}

	}

	public function index()
	{
			$data['show_table'] = $this->reff_jenjang_db->data();
			$data['form']='Jenjang';
			$data['view']='index';
			$this->load->view('reff_jenjang_v', $data);
	}
	// TAMBAH
	//-------------------------------------------------------------------------------------------
	public function tambah($id='') {
		$data['form']='Jenjang';
		$data['form_small']='Tambah Data';
		$data['view']='tambah';
		$data['action']='reff_jenjang/tambah_p';
		$data= $this->reff_jenjang_db->tambah_db($id,$data);
		$this->load->view('reff_jenjang_v',$data);
	}

	public function tambah_p($id='') {
		$data = array(
								"departemen"=>$this->input->post("departemen"),
								"urutan"=>$this->input->post("urutan"),
								"keterangan"=>$this->input->post("keterangan"),
								"aktif"=>$this->input->post("aktif"),
								"modified_date"=> $this->dbx->cts(),
								"modified_by"=> $this->session->userdata('idpegawai'));

		if ($id<>""){
			$result = $this->reff_jenjang_db->ubah_pdb($data,$id) ;
		}else{
			$data = $this->p_c->arraymerge(array('created_date' => $this->dbx->cts()), $data);
			$data = $this->p_c->arraymerge(array('created_by' => $this->session->userdata('idpegawai')), $data);
			$id = $this->reff_jenjang_db->tambah_pdb($data) ;

			if ($id<>""){$result=TRUE;}
		}

		if ($result == TRUE) {
			redirect("reff_jenjang");
		} else {
			$data['error']="Errorr...";
			$this->ubah($id,$data);
		}
	}

	// UBAH
	//-------------------------------------------------------------------------------------------
	public function ubah($id,$stat='') {
		$data['form']='Jenjang';
		$data['form_small']='Ubah Data';
		$data['view']='tambah';
		$data['action']='reff_jenjang/tambah_p/'.$id;
		$data= $this->reff_jenjang_db->tambah_db($id,$data);
		$this->load->view('reff_jenjang_v',$data);
	}

	// HAPUS
	//-------------------------------------------------------------------------------------------
	public function hapus($id) {
		$result = $this->reff_jenjang_db->hapus_db($id) ;
		if ($result == TRUE) {
			redirect('reff_jenjang');
		}
	}
}//end of class
?>
