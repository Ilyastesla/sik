<?php

session_start(); //we need to start session in order to access it through CI

Class hrm_recruitement extends CI_Controller {

public function __construct() {
	parent::__construct();

		// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');


		// Load session library
		$this->load->library('session');

		// Load database
		$this->load->model('hrm_recruitement_db');

		if( $this->session->userdata('logged_in')) {
			if($this->dbx->checkpage($this->session->userdata('role_id'),'hrm_recruitement')==false){
					redirect('user_authentication');
			}
		}else{
			redirect('user_authentication');;
		}

	}

	public function index()
	{
			$data['show_table'] = $this->hrm_recruitement_db->data();
			$data['form']='Lowongan Pekerjaan';
			$data['view']='index';
			$this->load->view('hrm_recruitement_v', $data);
	}


	// TAMBAH
	//-------------------------------------------------------------------------------------------
	public function tambah($id='') {
		$data['form']='Lowongan Pekerjaan';
		$data['form_small']='Tambah Data';
		$data['view']='tambah';
		$data['action']='hrm_recruitement/tambah_p';
		$data= $this->hrm_recruitement_db->tambah_x($id,$data);
		$this->load->view('hrm_recruitement_v',$data);
	}

	public function tambah_p($id='') {
	   $data = array(
			 "idjabatan"=> $this->input->post("idjabatan"),
			 "idtipepekerjaan"=> $this->input->post("idtipepekerjaan"),
			 "idlevel"=> $this->input->post("idlevel"),
			 "idcompany"=> $this->input->post("idcompany"),
				"keterangan"=> $this->input->post("keterangan"),
				"isi"=> $this->input->post("isi"),
				"aktif"=> $this->input->post("aktif"),
				"modified_date"=> $this->dbx->cts(),
				"modified_by"=> $this->session->userdata('idpegawai'));
		if ($id<>""){
			$result = $this->dbx->ubahdata("hrm_recruitement",$data,"replid",$id) ;
		}else{
			$data = $this->p_c->arraymerge(array('created_date' => $this->dbx->cts()), $data);
			$data = $this->p_c->arraymerge(array('created_by' => $this->session->userdata('idpegawai')), $data);
			$id = $this->dbx->tambahdata("hrm_recruitement",$data);
			if ($id<>""){$result=TRUE;}
		}

		if ($result == TRUE) {
			redirect('hrm_recruitement');
		} else {
			$data['error']='Errorr...';
			$this->ubah($id,$data);
		}
	}

	// UBAH
	//-------------------------------------------------------------------------------------------
	public function ubah($id,$stat='') {
		$data['form']='Lowongan Pekerjaan';
		$data['form_small']='Ubah Data';
		$data['view']='tambah';
		$data['action']='hrm_recruitement/tambah_p/'.$id;
		$data= $this->hrm_recruitement_db->tambah_x($id,$data);
		$this->load->view('hrm_recruitement_v',$data);
	}

	// VIEW
	//-------------------------------------------------------------------------------------------
	public function view($id) {
		$data['form']='Lowongan Pekerjaan';
		$data['form_small']='View';
		$data['view']='view';
		$data['action']='#';
		$data= $this->hrm_recruitement_db->view_db($id,$data);
		$this->load->view('hrm_recruitement_v',$data);
	}

	public function hapus($id) {
		$result = $this->dbx->hapusdata("hrm_recruitement","replid",$id) ;
		if ($result == TRUE) {
			?><script>
					window.opener.location.reload();
					window.close();
				</script>
			<?php
		}
	}

	public function publish($id) {
		$result = $this->dbx->ubahstatus("hrm_recruitement","replid",$id,"publish",1) ;
		if ($result == TRUE) {
			redirect('hrm_recruitement/view/'.$id);
		}
	}


	public function ubahstatuspeserta($status,$id) {
	   $data = array(
				"status"=> $status,
				"modified_date"=> $this->dbx->cts(),
				"modified_by"=> $this->session->userdata('idpegawai'));
		$result = $this->dbx->ubahdata('hrm_recruitement_progress',$data,'replid',$id) ;
		if ($result == TRUE) {
			?><script>
					window.opener.location.reload();
					window.close();
				</script>
			<?php
		} else {
			?><script>
					window.opener.location.reload();
					window.close();
				</script>
			<?php
		}
	}


}//end of class
?>
