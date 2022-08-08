<?php

session_start(); //we need to start session in order to access it through CI

Class online_recruitement_progress extends CI_Controller {

public function __construct() {
	parent::__construct();

		// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');


		// Load session library
		$this->load->library('session');

		// Load database
		$this->load->model('online_recruitement_progress_db');

    if( $this->session->userdata('logged_in')) {
    }else{
      redirect('main');;
    }

	}

	public function index()
	{
			$data['show_table'] = $this->online_recruitement_progress_db->data();
			$data['form']='Progres Lowongan';
			$data['view']='index';
			$this->load->view('online_recruitement_progress_v', $data);
	}

	public function tambah($idhrm_recruitement)
	{
			$data['form']='Lamar Pekerjaan';
			$data['form_small']='Tambah';
			$data['view']='tambah';
			$data['action']='online_recruitement_progress/tambah_p/'.$idhrm_recruitement;
			$data= $this->online_recruitement_progress_db->tambah_x($data,$idhrm_recruitement);
			$this->load->view('online_recruitement_progress_v',$data);
	}

	public function tambah_p($idhrm_recruitement) {
	   $data = array(
			 	"harapangaji"=> $this->input->post('harapangaji'),
				"tglgabung"=> $this->p_c->tgl_db($this->input->post('tglgabung')),
				"idhrm_recruitement"=> $idhrm_recruitement,
				"idpegawai"=> $this->session->userdata('idregistrasi'),
				"status"=> 1,
				"modified_date"=> $this->dbx->cts(),
				"modified_by"=> $this->session->userdata('idregistrasi'));
			$data = $this->p_c->arraymerge(array('created_date' => $this->dbx->cts()), $data);
			$data = $this->p_c->arraymerge(array('created_by' => $this->session->userdata('idregistrasi')), $data);
			$id = $this->dbx->tambahdata('hrm_recruitement_progress',$data);
			if ($id<>""){$result=TRUE;}

		if ($result == TRUE) {
			redirect('online_recruitement_progress');
		} else {
			$data['error']='Errorr...';
			$this->ubah($id,$data);
		}
	}


	public function hapus($id) {
		$result = $this->dbx->hapusdata('hrm_recruitement_progress','replid',$id) ;
		if ($result == TRUE) {
			redirect('online_recruitement_progress');
		}
	}



}//end of class
?>
