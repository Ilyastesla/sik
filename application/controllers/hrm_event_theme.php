<?php

session_start(); //we need to start session in order to access it through CI

Class hrm_event_theme extends CI_Controller {

public function __construct() {
	parent::__construct();

		// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');


		// Load session library
		$this->load->library('session');

		// Load database
		$this->load->model('hrm_event_theme_db');

		if( $this->session->userdata('logged_in')) {
			if($this->dbx->checkpage($this->session->userdata('role_id'),'hrm_event_theme')==false){
					redirect('user_authentication');
			}
		}else{
			redirect('user_authentication');;
		}

	}

	public function index()
	{
			$data['show_table'] = $this->hrm_event_theme_db->data();
			$data['form']='Tema Pelatihan';
			$data['view']='index';
			$this->load->view('hrm_event_theme_v', $data);
	}


	// TAMBAH
	//-------------------------------------------------------------------------------------------
	public function tambah($id='') {
		$data['form']='Tema Pelatihan';
		$data['form_small']='Tambah Data';
		$data['view']='tambah';
		$data['action']='hrm_event_theme/tambah_p';
		$data= $this->hrm_event_theme_db->tambah_x($id,$data);
		$this->load->view('hrm_event_theme_v',$data);
	}

	public function tambah_p($id='') {
		$data = array(
				"tema"=> $this->input->post("tema"),
				"kkm"=> $this->input->post("kkm"),
				"aktif"=> $this->input->post("aktif"),
				"modified_date"=> $this->dbx->cts(),
				"modified_by"=> $this->session->userdata('idpegawai'));
		if ($id<>""){
			$result = $this->hrm_event_theme_db->ubah($data,$id) ;
		}else{
			$data = $this->p_c->arraymerge(array('created_date' => $this->dbx->cts()), $data);
			$data = $this->p_c->arraymerge(array('created_by' => $this->session->userdata('idpegawai')), $data);
			$id = $this->hrm_event_theme_db->tambah($data);
			if ($id<>""){$result=TRUE;}
		}

		if ($result == TRUE) {
			redirect('hrm_event_theme/view/1/'.$id);
		} else {
			$data['error']='Errorr...';
			$this->ubah($id,$data);
		}
	}

	// UBAH
	//-------------------------------------------------------------------------------------------
	public function ubah($id,$stat='') {
		$data['form']='Tema Pelatihan';
		$data['form_small']='Ubah Data';
		$data['view']='tambah';
		$data['action']='hrm_event_theme/tambah_p/'.$id;
		$data= $this->hrm_event_theme_db->tambah_x($id,$data);
		$this->load->view('hrm_event_theme_v',$data);
	}

	public function hapus($id) {
		$result = $this->hrm_event_theme_db->hapus_db($id) ;
		if ($result == TRUE) {
			redirect('hrm_event_theme');
		}
	}

	// VIEW
	//-------------------------------------------------------------------------------------------
	public function view($ubah,$id) {
		$data['form']='Tema Pelatihan';
		$data['form_small']='View';
		$data['view']='view';
		$data['ubah']=$ubah;
		$data['action']='hrm_event_theme/finish/'.$id;
		$data['action_1']='hrm_event_theme/tambahtest_p/'.$id;
		$data= $this->hrm_event_theme_db->view_db($id,$data);
		$this->load->view('hrm_event_theme_v',$data);
	}

	// TEST
	//-------------------------------------------------------------------------------------------
	public function tambahtest($ubah,$idtheme,$idtest="") {
		$data['form']='Tema Pelatihan';
		$data['form_small']='View';
		$data['view']='tambahtest';
		$data['ubah']=$ubah;
		$data['action']='hrm_event_theme/tambahtest_p/'.$idtheme.'/'.$idtest;
		$data= $this->hrm_event_theme_db->tambahtest_db($data,$idtheme,$idtest);
		$this->load->view('hrm_event_theme_v',$data);
	}

	public function tambahtest_p($id,$idtest="") {
		$data = array(
				"idhrm_event_theme"=>$id,
				"test"=> $this->input->post("test"),
				"pg"=> $this->input->post("pg"),
				"no_urut"=> $this->input->post("no_urut"),
				"modified_date"=> $this->dbx->cts(),
				"modified_by"=> $this->session->userdata('idpegawai'));
		//echo var_dump($data);die;
		if ($idtest<>""){
			$result = $this->hrm_event_theme_db->ubahtest_pdb($data,$idtest) ;
		}else{
			$data = $this->p_c->arraymerge(array('created_date' => $this->dbx->cts()), $data);
			$data = $this->p_c->arraymerge(array('created_by' => $this->session->userdata('idpegawai')), $data);
			$idtest = $this->hrm_event_theme_db->tambahtest_pdb($data);
			if ($idtest<>""){$result=TRUE;}
		}

		if ($result == TRUE) {
			redirect('hrm_event_theme/view/1/'.$id);
		} else {
			$data['error']='Errorr...';
			redirect('hrm_event_theme/view/1/'.$id);
		}
	}

	public function hapustest_p($id,$idtest) {
		$result = $this->hrm_event_theme_db->hapustest_db($idtest) ;
		if ($result == TRUE) {
			redirect('hrm_event_theme/view/1/'.$id);
		}
	}
	// JAWABAN
	//-------------------------------------------------------------------------------------------
	public function tambahjawaban($ubah,$idtheme,$idtest,$id="") {
		$data['form']='Tema Pelatihan';
		$data['form_small']='View';
		$data['view']='tambahjawaban';
		$data['ubah']=$ubah;
		$data['action']='hrm_event_theme/tambahjawaban_p/'.$idtheme.'/'.$idtest.'/'.$id;
		$data= $this->hrm_event_theme_db->tambahjawaban_db($data,$idtheme,$idtest,$id);
		$this->load->view('hrm_event_theme_v',$data);
	}

	public function tambahjawaban_p($idtheme,$idtest,$id="") {
		$data = array(
				"idhrm_event_theme"=>$idtheme,
				"idhrm_event_test"=>$idtest,
				"jawaban"=> $this->input->post("jawaban"),
				"keterangan"=> $this->input->post("keterangan"),
				"benar"=> $this->input->post("benar"),
				"modified_date"=> $this->dbx->cts(),
				"modified_by"=> $this->session->userdata('idpegawai'));
		if ($id<>""){
			$result = $this->hrm_event_theme_db->ubahjawaban_pdb($data,$id) ;
		}else{
			$data = $this->p_c->arraymerge(array('created_date' => $this->dbx->cts()), $data);
			$data = $this->p_c->arraymerge(array('created_by' => $this->session->userdata('idpegawai')), $data);
			$idx = $this->hrm_event_theme_db->tambahjawaban_pdb($data);
			if ($idx<>""){$result=TRUE;}
		}

		if ($result == TRUE) {
			redirect('hrm_event_theme/view/1/'.$idtheme);
		} else {
			$data['error']='Errorr...';
			$this->ubah($id,$data);
		}
	}

	public function hapusjawaban_p($idhrm_event_theme,$id) {
		$result = $this->hrm_event_theme_db->hapusjawaban_db($id) ;
		if ($result == TRUE) {
			redirect('hrm_event_theme/view/1/'.$idhrm_event_theme);
		}
	}

}//end of class
?>
