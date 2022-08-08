<?php

session_start(); //we need to start session in order to access it through CI

Class hrm_pegawai_projek extends CI_Controller {

public function __construct() {
	parent::__construct();

		// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');


		// Load session library
		$this->load->library('session');

		// Load database
		$this->load->model('hrm_pegawai_projek_db');

		if( $this->session->userdata('logged_in')) {
			if($this->dbx->checkpage($this->session->userdata('role_id'),'hrm_pegawai_projek')==false){
					redirect('user_authentication');
			}
		}else{
			redirect('user_authentication');;
		}

	}

	public function index()
	{
			$data = $this->hrm_pegawai_projek_db->data();
			$data['form']='Projek Pegawai';
			$data['view']='index';
			$data['action']='hrm_pegawai_projek';
			$this->load->view('hrm_pegawai_projek_v', $data);
	}


	// TAMBAH
	//-------------------------------------------------------------------------------------------
	public function tambah($id='') {
		$data['form']='Projek Pegawai';
		$data['form_small']='Tambah Data';
		$data['view']='tambah';
		$data['action']='hrm_pegawai_projek/tambah_p';
		$data= $this->hrm_pegawai_projek_db->tambah_x($id,$data);
		$this->load->view('hrm_pegawai_projek_v',$data);
	}

	// UBAH
	//-------------------------------------------------------------------------------------------
	public function ubah($id,$stat='') {
		$data['form']='Projek Pegawai';
		$data['form_small']='Ubah Data';
		$data['view']='tambah';
		$data['action']='hrm_pegawai_projek/tambah_p/'.$id;
		$data= $this->hrm_pegawai_projek_db->tambah_x($id,$data);
		$this->load->view('hrm_pegawai_projek_v',$data);
	}

	public function tambah_p($id='') {
		//'idrole' => $this->p_c->arrdump($this->input->post('idrole')),
		$data = array(
				"projek"=> $this->input->post("projek"),
				"iddepartemen"=> $this->input->post("iddepartemen"),
				"aktif"=> 1,
				"modified_date"=> $this->dbx->cts(),
				"modified_by"=> $this->session->userdata('idpegawai'));
		if ($id<>""){
			$result = $this->dbx->ubahdata('hrm_pegawai_projek',$data,'replid',$id);
		}else{
			$data = $this->p_c->arraymerge(array('created_date' => $this->dbx->cts()), $data);
			$data = $this->p_c->arraymerge(array('created_by' => $this->session->userdata('idpegawai')), $data);
			$id=$this->dbx->tambahdata('hrm_pegawai_projek',$data);
			if ($id<>""){$result=TRUE;}
		}

		if ($result == TRUE) {
			redirect('hrm_pegawai_projek');
		} else {
			$data['error']='Errorr...';
			$this->ubah($id,$data);
		}
	}

	public function ubahaktif($id,$aktif) {
		$data=array(
				'aktif' =>$aktif,
				"modified_date"=> $this->dbx->cts(),
				"modified_by"=> $this->session->userdata('idpegawai')
		);
		$result = $this->dbx->ubahdata('hrm_pegawai_projek',$data,'replid',$id);
		if ($result == TRUE) {
			redirect('hrm_pegawai_projek');
		} else {
			$data['error']='Errorr...';
			$this->ubah($id,$data);
		}
	}

	public function view($id) {
		$data['form']='Projek Pegawai';
		$data['form_small']='View';
		$data['view']='view';
		$data= $this->hrm_pegawai_projek_db->view_db($id,$data);
		$this->load->view('hrm_pegawai_projek_v',$data);
	}

}//end of class
?>
