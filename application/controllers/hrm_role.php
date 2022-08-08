<?php

session_start(); //we need to start session in order to access it through CI

Class hrm_role extends CI_Controller {

public function __construct() {
	parent::__construct();

		// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');


		// Load session library
		$this->load->library('session');

		// Load database
		$this->load->model('hrm_role_db');

		if( $this->session->userdata('logged_in')) {
			if($this->dbx->checkpage($this->session->userdata('role_id'),'hrm_role')==false){
					redirect('user_authentication');
			}
		}else{
			redirect('user_authentication');;
		}

	}

	public function index()
	{
			$data['show_table'] = $this->hrm_role_db->data();
			$data['form']='Peran';
			$data['view']='index';
			$this->load->view('hrm_role_v', $data);
	}


	// TAMBAH
	//-------------------------------------------------------------------------------------------
	public function tambah($id='') {
		$data['form']='Peran';
		$data['form_small']='Tambah Data';
		$data['view']='tambah';
		$data['action']='hrm_role/tambah_p';
		$data= $this->hrm_role_db->tambah_x($id,$data);
		$this->load->view('hrm_role_v',$data);
	}

	public function tambah_p($id='') {
	   $data = array(
				"role"=> $this->input->post("role"),
				"idatasan"=> $this->input->post("idatasan"),
				"keterangan"=> $this->input->post("keterangan"),
				"aktif"=> $this->input->post("aktif"));
		if ($id<>""){
			$result = $this->hrm_role_db->ubah($data,$id) ;
		}else{
			$id = $this->hrm_role_db->tambah($data);
			if ($id<>""){$result=TRUE;}
		}

		if ($result == TRUE) {
			redirect('hrm_role/role_map/'.$id);
		} else {
			$data['error']='Errorr...';
			$this->ubah($id,$data);
		}
	}

	// UBAH
	//-------------------------------------------------------------------------------------------
	public function ubah($id,$stat="") {
		$stat="adfadf";
		$data['form']='Peran';
		$data['form_small']='Ubah Data';
		$data['view']='tambah';
		$data['action']='hrm_role/tambah_p/'.$id;
		$data= $this->hrm_role_db->tambah_x($id,$data);
		$this->load->view('hrm_role_v',$data);

	}

	// ROLE MAP
	//-------------------------------------------------------------------------------------------
	public function role_map($id='') {
		$data['form']='Peran';
		$data['form_small']='Role Map';
		$data['view']='role_map';
		$data['action']='hrm_role/tambah_map_p/'.$id;
		$data= $this->hrm_role_db->tambah_map($id,$data);
		$this->load->view('hrm_role_v',$data);
	}

	public function tambah_map_p($id) {
		$sub_menu=$this->input->post("sub_menu");
		$result = $this->hrm_role_db->hapus_role_map_db($id);
		if ($result == TRUE) {
			foreach((array)$sub_menu as $row){
				$data = array(
							"role_id"=> $id,
							"submenu_id"=> $row);

				$result=$this->hrm_role_db->tambah_role_map($data);
				unset($data);
			}
		}
		if ($result == TRUE) {
			redirect('hrm_role/role_map_sip/'.$id);
		} else {
			$data['error']='Errorr...';
			$this->ubah($id,$data);
		}
	}
	// ROLE MAP SIP
	//-------------------------------------------------------------------------------------------
	public function role_map_sip($id='') {
		$data['form']='Peran';
		$data['form_small']='Role Map SIP';
		$data['view']='role_map_sip';
		$data['action']='hrm_role/tambah_map_sip_p/'.$id;
		$data= $this->hrm_role_db->tambah_map_sip($id,$data);
		$this->load->view('hrm_role_v',$data);
	}

	public function tambah_map_sip_p($id) {
		$sub_menu=$this->input->post("sub_menu");
		$result = $this->hrm_role_db->hapus_role_map_sip_db($id);
		if ($result == TRUE) {
			foreach((array)$sub_menu as $row){
				$data = array(
							"role_id"=> $id,
							"submenu_id"=> $row);

				$result=$this->hrm_role_db->tambah_role_map_sip($data);
				unset($data);
			}
		}
		if ($result == TRUE) {
			redirect('hrm_role/view/'.$id);
		} else {
			$data['error']='Errorr...';
			$this->ubah($id,$data);
		}
	}


	// VIEW
	//-------------------------------------------------------------------------------------------
	public function view($id) {
		$data['form']='Peran';
		$data['form_small']='View';
		$data['view']='view';
		$data['action']='#';
		$data= $this->hrm_role_db->tambah_map($id,$data);
		$data= $this->hrm_role_db->tambah_map_sip($id,$data);
		$this->load->view('hrm_role_v',$data);
	}

	public function hapus($id) {
		$result = $this->hrm_role_db->hapus_role_map_db($id) ;
		$result = $this->hrm_role_db->hapus_db($id) ;
		if ($result == TRUE) {
			redirect('Role');
		}
	}



}//end of class
?>
