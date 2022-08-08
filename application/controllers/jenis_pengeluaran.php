<?php

session_start(); //we need to start session in order to access it through CI

Class jenis_pengeluaran extends CI_Controller {

public function __construct() {
parent::__construct();

	// Load form helper library
	$this->load->helper('form');

	// Load form validation library
	$this->load->library('form_validation');


	// Load session library
	$this->load->library('session');

	// Load database
	$this->load->model('jenis_pengeluaran_db');

	if( $this->session->userdata('logged_in')) {
		if($this->dbx->checkpage($this->session->userdata('role_id'),'jenis_pengeluaran')==false){
				redirect('user_authentication');
		}
	}else{
		redirect('user_authentication');;
	}
}


public function index()
{
	$data['show_table'] = $this->jenis_pengeluaran_db->data();
	$data['form']='Jenis Pengeluaran';
	$this->load->view('jenis_pengeluaran', $data);
}

// TAMBAH
public function tambah($data='') {
	$data= $this->jenis_pengeluaran_db->input_add($data);
	$this->load->view('jenis_pengeluaran_add',$data);
}
public function tambah_p() {
	$data = array(
			'nama' => $this->input->post('nama'),
			'keterangan' => $this->input->post('keterangan'),
			'aktif' => $this->input->post('aktif')
			);

	$result = $this->jenis_pengeluaran_db->insert($data) ;
	if ($result == TRUE) {
		redirect('/jenis_pengeluaran');
	} else {
		$data['error']='Error...';
		$this->tambah($data);

	}
}

//UBAH
public function ubah($id) {
	$data= $this->jenis_pengeluaran_db->input_edit($id,$data);
	$this->load->view('jenis_pengeluaran_add',$data);
}

public function ubah_p($id) {
	$data = array(
			'nama' => $this->input->post('nama'),
			'keterangan' => $this->input->post('keterangan'),
			'aktif' => $this->input->post('aktif')
			);

	$result = $this->jenis_pengeluaran_db->ubah($data,$id) ;
	if ($result == TRUE) {
		redirect('/jenis_pengeluaran');
	} else {
		$data['error']='Error...';
		$this->ubah($id,$data);
	}
}


//Hapus
public function hapus($id) {
	$result = $this->jenis_pengeluaran_db->hapus($id) ;
	if ($result == TRUE) {
		redirect('/jenis_pengeluaran');
	}
}

}//end of class
?>
