<?php

session_start(); //we need to start session in order to access it through CI

Class hrm_recruitement_data extends CI_Controller {

	public function __construct() {
	parent::__construct();

		// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');


		// Load session library
		$this->load->library('session');

		// Load database
		$this->load->model('hrm_recruitement_data_db');
		$this->load->model('fotodisplay_db');

   if( $this->session->userdata('logged_in')) {
       if($this->dbx->checkpage($this->session->userdata('role_id'),'hrm_recruitement_data')==false){
          redirect('user_authentication');
       }
		}else{
			redirect('user_authentication');;
		}

	}

	public function index($aktif="1")
	{
		$data['show_table'] = $this->hrm_recruitement_data_db->data($aktif);
		$data['form']='Pegawai Calon';
		$this->load->view('hrm_recruitement_data_v', $data);
	}

  public function view($id,$ubah="") {
    $data['form']='Pegawai Calon';
		$data= $this->hrm_recruitement_data_db->view($id,$data);
		$data= $this->hrm_recruitement_data_db->kontakdarurat_db($id,$data);
		$data= $this->hrm_recruitement_data_db->keluarga_db($id,$data);
		$data= $this->hrm_recruitement_data_db->perbankan_db($id,$data);
		$data= $this->hrm_recruitement_data_db->pendidikan_db($id,$data);
		$data= $this->hrm_recruitement_data_db->pendidikan_nf_db($id,$data);
		$data= $this->hrm_recruitement_data_db->bahasa_db($id,$data);
		$data= $this->hrm_recruitement_data_db->komputer_db($id,$data);
		$data= $this->hrm_recruitement_data_db->skill_db($id,$data);
		$data= $this->hrm_recruitement_data_db->prestasi_db($id,$data);
		$data= $this->hrm_recruitement_data_db->organisasi_db($id,$data);
		$data= $this->hrm_recruitement_data_db->kerja_db($id,$data);
		$this->load->view('pegawai_calon_v',$data);
	}
} //end of class
?>
