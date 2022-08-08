<?php

session_start(); //we need to start session in order to access it through CI

Class berita extends CI_Controller {

public function __construct() {
	parent::__construct();

		// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');


		// Load session library
		$this->load->library('session');

		// Load database
		$this->load->model('berita_db');

		if( $this->session->userdata('logged_in')) {
			if($this->dbx->checkpage($this->session->userdata('role_id'),'berita')==false){
					redirect('user_authentication');
			}
		}else{
			redirect('user_authentication');;
		}

	}

	public function index()
	{
			$data['show_table'] = $this->berita_db->data();
			$data['form']='Berita';
			$data['view']='index';
			$this->load->view('berita_v', $data);
	}


	// TAMBAH
	//-------------------------------------------------------------------------------------------
	public function tambah($id='') {
		$data['form']='Berita';
		$data['form_small']='Tambah Data';
		$data['view']='tambah';
		$data['action']='berita/tambah_p';
		$data= $this->berita_db->tambah_x($id,$data);
		$this->load->view('berita_v',$data);
	}

	public function tambah_p($id='') {
	   $data = array(
				"subjek"=> $this->input->post("subjek"),
				"tipe"=> $this->input->post("tipe"),
				"isi_berita"=> $this->input->post("isi_berita"),
				"aktif"=> $this->input->post("aktif"),
				"modified_date"=> $this->dbx->cts(),
				"modified_by"=> $this->session->userdata('idpegawai'));
		if ($id<>""){
			$result = $this->berita_db->ubah($data,$id) ;
		}else{
			$data = $this->p_c->arraymerge(array('created_date' => $this->dbx->cts()), $data);
			$data = $this->p_c->arraymerge(array('created_by' => $this->session->userdata('idpegawai')), $data);
			$id = $this->berita_db->tambah($data);
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
		$data['form']='Berita';
		$data['form_small']='Ubah Data';
		$data['view']='tambah';
		$data['action']='berita/tambah_p/'.$id;
		$data= $this->berita_db->tambah_x($id,$data);
		$this->load->view('berita_v',$data);
	}

	// ROLE MAP
	//-------------------------------------------------------------------------------------------
	public function tujuan($id='') {
		$data['form']='Berita';
		$data['form_small']='Tambah Tujuan';
		$data['view']='tujuan';
		$data['action']='berita/tambah_tujuan_p/'.$id;
		$data= $this->berita_db->tambah_tujuan($id,$data);
		$this->load->view('berita_v',$data);
	}

	public function tambah_tujuan_p($id) {
		$idrole=$this->input->post("idrole");
		$result = $this->berita_db->hapus_tujuan_p_db($id);
		if ($result == TRUE) {
			foreach((array)$idrole as $row){
				$data = array(
							"berita_id"=> $id,
							"idrole"=> $row);

				$result=$this->berita_db->tambah_tujuan_p_db($data);
				unset($data);
			}
		}
		if ($result == TRUE) {
			redirect('berita/view/'.$id);
		} else {
			$data['error']='Errorr...';
			$this->ubah($id,$data);
		}
	}

	// VIEW
	//-------------------------------------------------------------------------------------------
	public function view($id) {
		$data['form']='Berita';
		$data['form_small']='View';
		$data['view']='view';
		$data['action']='#';
		$data= $this->berita_db->tambah_tujuan($id,$data);
		$this->load->view('berita_v',$data);
	}

	public function hapus($id) {
		$result = $this->berita_db->hapus_tujuan_p_db($id) ;
		$result = $this->berita_db->hapus_db($id) ;
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
