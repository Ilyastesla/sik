<?php

session_start(); //we need to start session in order to access it through CI

Class hrm_company extends CI_Controller {

public function __construct() {
	parent::__construct();

		// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');


		// Load session library
		$this->load->library('session');

		// Load database
		$this->load->model('hrm_company_db');

		if( $this->session->userdata('logged_in')) {
			if($this->dbx->checkpage($this->session->userdata('role_id'),'hrm_company')==false){
					redirect('user_authentication');
			}
		}else{
			redirect('user_authentication');;
		}

	}

	public function index()
	{
			$data['show_table'] = $this->hrm_company_db->data();
			$data['form']='Perusahaan';
			$data['view']='index';
			$this->load->view('hrm_company_v', $data);
	}


	// TAMBAH
	//-------------------------------------------------------------------------------------------
	public function tambah($id='') {
		$data['form']='Perusahaan';
		$data['form_small']='Tambah Data';
		$data['view']='tambah';
		$data['action']='hrm_company/tambah_p';
		$data= $this->hrm_company_db->tambah_x($id,$data);
		$this->load->view('hrm_company_v',$data);
	}

	public function tambah_p($id='') {
	   $data = array(
				"nama"=> $this->input->post("nama"),
				"modul_id"=> $this->input->post("modul_id"),
				"pages"=> $this->input->post("pages"),
				"keterangan"=> $this->input->post("keterangan"),
				"no_urut"=> $this->input->post("no_urut"),
				"aktif"=> $this->input->post("aktif"),
				"ppdb"=> $this->input->post("ppdb")
			);
		if ($id<>""){
			$result = $this->dbx->ubah('hrm_company',$data,'replid',$id) ;
		}else{
			$id = $this->dbx->tambah('hrm_company',$data);
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
		$data['form']='Perusahaan';
		$data['form_small']='Ubah Data';
		$data['view']='tambah';
		$data['action']='hrm_company/tambah_p/'.$id;
		$data= $this->hrm_company_db->tambah_x($id,$data);
		$this->load->view('hrm_company_v',$data);
	}

	public function hapus($id) {
		$result = $this->dbx->hapusdata('hrm_company','replid',$id) ;
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
