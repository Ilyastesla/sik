<?php

session_start(); //we need to start session in order to access it through CI

Class hrm_codeofconduct extends CI_Controller {

public function __construct() {
	parent::__construct();

		// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');


		// Load session library
		$this->load->library('session');

		// Load database
		$this->load->model('hrm_codeofconduct_db');

		if (!$this->session->userdata('logged_in')) {
			redirect('user_authentication');;
		}

	}

	public function index()
	{
			$data['show_table'] = $this->hrm_codeofconduct_db->data();
			$data['form']='Kebijakan Perusahaan';
			$data['view']='index';
			$this->load->view('hrm_codeofconduct_v', $data);
	}


	// TAMBAH
	//-------------------------------------------------------------------------------------------
	public function tambah($id='') {
		$data['form']='Kebijakan Perusahaan';
		$data['form_small']='Tambah Data';
		$data['view']='tambah';
		$data['action']='hrm_codeofconduct/tambah_p';
		$data= $this->hrm_codeofconduct_db->tambah_x($id,$data);
		$this->load->view('hrm_codeofconduct_v',$data);
	}

	public function tambah_p($id='') {
	   $data = array(
				"subjek"=> $this->input->post("subjek"),
				"tipe"=> $this->input->post("tipe"),
				"isi_hrm_codeofconduct"=> $this->input->post("isi_hrm_codeofconduct"),
				"aktif"=> $this->input->post("aktif"),
				"modified_date"=> $this->dbx->cts(),
				"modified_by"=> $this->session->userdata('idpegawai'));
		if ($id<>""){
			$result = $this->hrm_codeofconduct_db->ubah($data,$id) ;
		}else{
			$data = $this->p_c->arraymerge(array('created_date' => $this->dbx->cts()), $data);
			$data = $this->p_c->arraymerge(array('created_by' => $this->session->userdata('idpegawai')), $data);
			$id = $this->hrm_codeofconduct_db->tambah($data);
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
		$data['form']='Kebijakan Perusahaan';
		$data['form_small']='Ubah Data';
		$data['view']='tambah';
		$data['action']='hrm_codeofconduct/tambah_p/'.$id;
		$data= $this->hrm_codeofconduct_db->tambah_x($id,$data);
		$this->load->view('hrm_codeofconduct_v',$data);
	}

	// ROLE MAP
	//-------------------------------------------------------------------------------------------
	public function tujuan($id='') {
		$data['form']='Kebijakan Perusahaan';
		$data['form_small']='Tambah Tujuan';
		$data['view']='tujuan';
		$data['action']='hrm_codeofconduct/tambah_tujuan_p/'.$id;
		$data= $this->hrm_codeofconduct_db->tambah_tujuan($id,$data);
		$this->load->view('hrm_codeofconduct_v',$data);
	}

	public function tambah_tujuan_p($id) {
		$idrole=$this->input->post("idrole");
		$result = $this->hrm_codeofconduct_db->hapus_tujuan_p_db($id);
		if ($result == TRUE) {
			foreach((array)$idrole as $row){
				$data = array(
							"hrm_codeofconduct_id"=> $id,
							"idrole"=> $row);

				$result=$this->hrm_codeofconduct_db->tambah_tujuan_p_db($data);
				unset($data);
			}
		}
		if ($result == TRUE) {
			redirect('hrm_codeofconduct/view/'.$id);
		} else {
			$data['error']='Errorr...';
			$this->ubah($id,$data);
		}
	}

	// VIEW
	//-------------------------------------------------------------------------------------------
	public function view($id) {
		$data['form']='Kebijakan Perusahaan';
		$data['form_small']='View';
		$data['view']='view';
		$data['action']='#';
		$data= $this->hrm_codeofconduct_db->tambah_tujuan($id,$data);
		$this->load->view('hrm_codeofconduct_v',$data);
	}

	public function hapus($id) {
		$result = $this->hrm_codeofconduct_db->hapus_tujuan_p_db($id) ;
		$result = $this->hrm_codeofconduct_db->hapus_db($id) ;
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
