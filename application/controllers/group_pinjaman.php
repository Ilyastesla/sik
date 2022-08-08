<?php

session_start(); //we need to start session in order to access it through CI

Class group_pinjaman extends CI_Controller {

public function __construct() {
	parent::__construct();

		// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');


		// Load session library
		$this->load->library('session');

		// Load database
		$this->load->model('group_pinjaman_db');

		if( $this->session->userdata('logged_in')) {
			if($this->dbx->checkpage($this->session->userdata('role_id'),'group_pinjaman')==false){
					redirect('user_authentication');
			}
		}else{
			redirect('user_authentication');;
		}

	}

	public function index()
	{
			$data['show_table'] = $this->group_pinjaman_db->data();
			$data['form']='Grup Pinjaman';
			$data['view']='index';
			$this->load->view('group_pinjaman_v', $data);
	}


	// TAMBAH
	//-------------------------------------------------------------------------------------------
	public function tambah($id='') {
		$data['form']='Grup Pinjaman';
		$data['form_small']='Tambah Data';
		$data['view']='tambah';
		$data['action']='group_pinjaman/tambah_p';
		$data= $this->group_pinjaman_db->tambah_x($id,$data);
		$this->load->view('group_pinjaman_v',$data);
	}

	public function tambah_p($id='') {
	    //"penerima"=> $this->input->post("penerima"),
	    //"tanggalpenerima"=> $this->input->post("tanggalpenerima"),
		$data = array(
				"group_pinjaman"=> $this->input->post("group_pinjaman"),
				"idjabatan"=> $this->input->post("idjabatan"),
				"idjenis_pinjaman"=> $this->input->post("idjenis_pinjaman"),
				"limit_pinjaman"=> $this->input->post("limit_pinjaman"),
				"aktif"=> $this->input->post("aktif"),
				"modified_date"=> $this->dbx->cts(),
				"modified_by"=> $this->session->userdata('idpegawai'));
		if ($id<>""){
			$result = $this->group_pinjaman_db->ubah($data,$id) ;
		}else{
			$data = $this->p_c->arraymerge(array('created_date' => $this->dbx->cts()), $data);
			$data = $this->p_c->arraymerge(array('created_by' => $this->session->userdata('idpegawai')), $data);
			$id = $this->group_pinjaman_db->tambah($data);
			if ($id<>""){$result=TRUE;}
		}

		if ($result == TRUE) {
			redirect('group_pinjaman');
		} else {
			$data['error']='Errorr...';
			$this->ubah($id,$data);
		}
	}

	// UBAH
	//-------------------------------------------------------------------------------------------
	public function ubah($id,$stat='') {
		$data['form']='Grup Pinjaman';
		$data['form_small']='Ubah Data';
		$data['view']='tambah';
		$data['action']='group_pinjaman/tambah_p/'.$id;
		$data= $this->group_pinjaman_db->tambah_x($id,$data);
		$this->load->view('group_pinjaman_v',$data);
	}

	public function hapus($id) {
		$result = $this->group_pinjaman_db->hapus_db($id) ;
		if ($result == TRUE) {
			redirect('group_pinjaman');
		}
	}


}//end of class
?>
