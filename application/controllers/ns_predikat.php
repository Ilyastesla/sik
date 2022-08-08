<?php

session_start(); //we need to start session in order to access it through CI

Class ns_predikat extends CI_Controller {

public function __construct() {
parent::__construct();

		// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');


		// Load session library
		$this->load->library('session');

		// Load database
		$this->load->model('ns_predikat_db');

   if( $this->session->userdata('logged_in')) {
       if($this->dbx->checkpage($this->session->userdata('role_id'),'ns_predikat')==false){
          redirect('user_authentication');
       }
		}else{
			redirect('user_authentication');;
		}

	}

	public function index()
	{
			$data = $this->ns_predikat_db->data();
			$data['form']='Predikat';
			$data['view']='index';
			$data['action']='ns_predikat';
			$this->load->view('ns_predikat_v', $data);
	}

	// TAMBAH
	//-------------------------------------------------------------------------------------------
	public function tambah($id='') {
		$data['form']='Predikat';
		$data['form_small']='Tambah Data';
		$data['view']='tambah';
		$data['action']='ns_predikat/tambah_p';
		$data= $this->ns_predikat_db->tambah_db($id,$data);
		$this->load->view('ns_predikat_v',$data);
	}

	public function tambah_p($id='') {
		$data = array(
				'iddepartemen' => $this->input->post('iddepartemen'),
				'predikat' => $this->input->post('predikat'),
				'dari' => $this->input->post('dari'),
				'sampai' => $this->input->post('sampai'),
				'aktif' => $this->input->post('aktif'),
				'deskripsi' => $this->input->post('deskripsi'),
				'predikattipe' => $this->input->post('predikattipe'),
				"modified_date"=> $this->dbx->cts(),
				"modified_by"=> $this->session->userdata('idpegawai'));

		if ($id<>""){
			$result = $this->ns_predikat_db->ubah_pdb($data,$id) ;
		}else{
			$data = $this->p_c->arraymerge(array('created_date' => $this->dbx->cts()), $data);
			$data = $this->p_c->arraymerge(array('created_by' => $this->session->userdata('idpegawai')), $data);
			$id = $this->ns_predikat_db->tambah_pdb($data) ;
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
		$data['form']='Predikat';
		$data['form_small']='Ubah Data';
		$data['view']='tambah';
		$data['action']='ns_predikat/tambah_p/'.$id;
		$data= $this->ns_predikat_db->tambah_db($id,$data);
		$this->load->view('ns_predikat_v',$data);
	}

	//Hapus
	public function hapus($id) {
		$result = $this->ns_predikat_db->hapus_pdb($id) ;
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
