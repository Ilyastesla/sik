<?php

session_start(); //we need to start session in order to access it through CI

Class ns_matpelkelompok extends CI_Controller {

public function __construct() {
parent::__construct();

		// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');


		// Load session library
		$this->load->library('session');

		// Load database
		$this->load->model('ns_matpelkelompok_db');

		if( $this->session->userdata('logged_in')) {
		  if($this->dbx->checkpage($this->session->userdata('role_id'),'ns_matpelkelompok')==false){
		      redirect('user_authentication');
		  }
		}else{
			redirect('user_authentication');;
		}

	}

	public function index()
	{
			$data = $this->ns_matpelkelompok_db->data();
			$data['form']='Kelompok Mata Pelajaran';
			$data['view']='index';
			$data['action']='ns_matpelkelompok';
			$this->load->view('ns_matpelkelompok_v', $data);
	}

	// TAMBAH
	//-------------------------------------------------------------------------------------------
	public function tambah($id='') {
		$data['form']='Kelompok Mata Pelajaran';
		$data['form_small']='Tambah Data';
		$data['view']='tambah';
		$data['action']='ns_matpelkelompok/tambah_p';
		$data= $this->ns_matpelkelompok_db->tambah_db($id,$data);
		$this->load->view('ns_matpelkelompok_v',$data);
	}

	public function tambah_p($id='') {
		//'persentase' => $this->input->post('persentase'),
		$data = array(
				'matpelkelompok' => $this->input->post('matpelkelompok'),
				'iddepartemen' => $this->input->post('iddepartemen'),
				'keterangan' => $this->input->post('keterangan'),
				'no_urut' => $this->input->post('no_urut'),
				'detail' => $this->input->post('detail'),
				'groupon' => $this->input->post('groupon'),
				'aktif' => $this->input->post('aktif'),
				"modified_date"=> $this->dbx->cts(),
				"modified_by"=> $this->session->userdata('idpegawai'));

		if ($id<>""){
			$result = $this->ns_matpelkelompok_db->ubah_pdb($data,$id) ;
		}else{
			$data = $this->p_c->arraymerge(array('created_date' => $this->dbx->cts()), $data);
			$data = $this->p_c->arraymerge(array('created_by' => $this->session->userdata('idpegawai')), $data);
			$id = $this->ns_matpelkelompok_db->tambah_pdb($data) ;
			if ($id<>""){$result=TRUE;}
		}

		if ($result == TRUE) {
			?><script>
					window.opener.location.reload();
					window.close();
				</script>
			<?php
		} else {
			$data['error']='Errorr...';
			$this->ubah($id,$data);
		}
	}

	// UBAH
	//-------------------------------------------------------------------------------------------
	public function ubah($id,$stat='') {
		$data['form']='Kelompok Mata Pelajaran';
		$data['form_small']='Ubah Data';
		$data['view']='tambah';
		$data['action']='ns_matpelkelompok/tambah_p/'.$id;
		$data= $this->ns_matpelkelompok_db->tambah_db($id,$data);
		$this->load->view('ns_matpelkelompok_v',$data);
	}

	//Hapus
	public function hapus($id) {
		$result = $this->ns_matpelkelompok_db->hapus_pdb($id) ;
		if ($result == TRUE) {
			?><script>
					window.opener.location.reload();
					window.close();
				</script>
			<?php
		}
	}

}//end of class
?>
