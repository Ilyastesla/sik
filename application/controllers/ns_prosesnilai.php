<?php

session_start(); //we need to start session in order to access it through CI

Class ns_prosesnilai extends CI_Controller {

public function __construct() {
parent::__construct();

		// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');


		// Load session library
		$this->load->library('session');

		// Load database
		$this->load->model('ns_prosesnilai_db');

		if( $this->session->userdata('logged_in')) {
			  if($this->dbx->checkpage($this->session->userdata('role_id'),'ns_prosesnilai')==false){
			      redirect('user_authentication');
			  }
		}else{
			redirect('user_authentication');;
		}

	}

	public function index()
	{
			$data['show_table'] = $this->ns_prosesnilai_db->data();
			$data['form']='Proses Penilaian Siswa';
			$data['view']='index';
			$this->load->view('ns_prosesnilai_v', $data);
	}

	// TAMBAH
	//-------------------------------------------------------------------------------------------
	public function tambah($id='') {
		$data['form']='Proses Penilaian Siswa';
		$data['form_small']='Tambah Data';
		$data['view']='tambah';
		$data['action']='ns_prosesnilai/tambah_p';
		$data= $this->ns_prosesnilai_db->tambah_db($id,$data);
		$this->load->view('ns_prosesnilai_v',$data);
	}

	public function tambah_p($id='') {
		$data = array(
				'prosesnilai' => $this->input->post('prosesnilai'),
				'idperiode' => $this->input->post('idperiode'),
				'idregional' => $this->input->post('idregional'),
				'idkelompokmatpel' => $this->input->post('idkelompokmatpel'),
				'keterangan' => $this->input->post('keterangan'),
				'aktif' => $this->input->post('aktif'),
				"modified_date"=> $this->dbx->cts(),
				"modified_by"=> $this->session->userdata('idpegawai'));

		if ($id<>""){
			$result = $this->ns_prosesnilai_db->ubah_pdb($data,$id) ;
		}else{
			$data = $this->p_c->arraymerge(array('created_date' => $this->dbx->cts()), $data);
			$data = $this->p_c->arraymerge(array('created_by' => $this->session->userdata('idpegawai')), $data);
			$id = $this->ns_prosesnilai_db->tambah_pdb($data) ;
			if ($id<>""){$result=TRUE;}
		}

		if ($result == TRUE) {
			redirect('ns_prosesnilai/mapvariabelproses/'.$id);
		} else {
			$data['error']='Errorr...';
			$this->ubah($id,$data);
		}
	}

	// UBAH
	//-------------------------------------------------------------------------------------------
	public function ubah($id,$stat='') {
		$data['form']='Proses Penilaian Siswa';
		$data['form_small']='Ubah Data';
		$data['view']='tambah';
		$data['action']='ns_prosesnilai/tambah_p/'.$id;
		$data= $this->ns_prosesnilai_db->tambah_db($id,$data);
		$this->load->view('ns_prosesnilai_v',$data);
	}


	// MAP VARIABEL PROSES
	//-------------------------------------------------------------------------------------------
	public function mapvariabelproses($id='') {
		$data['form']='Proses Penilaian Siswa';
		$data['form_small']='Map Variabel Proses';
		$data['view']='map_variabel_proses';
		$data['action']='ns_prosesnilai/tambah_mapvariabelproses_p/'.$id;
		$data= $this->ns_prosesnilai_db->tambah_map_variabel_db($id,$data);
		$this->load->view('ns_prosesnilai_v',$data);
	}

	public function tambah_mapvariabelproses_p($id) {
		$sub_menu=$this->input->post("sub_menu");
		$result = $this->ns_prosesnilai_db->hapus_role_map_sip_db($id);
		if ($result == TRUE) {
			foreach((array)$sub_menu as $row){
				$data = array(
							"role_id"=> $id,
							"submenu_id"=> $row);

				$result=$this->ns_prosesnilai_db->tambah_role_map_sip($data);
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

	//Hapus
	public function hapus($id) {
		$result = $this->ns_prosesnilai_db->hapus_pdb($id) ;
		if ($result == TRUE) {
			redirect('ns_prosesnilai');
		}
	}

}//end of class
?>
