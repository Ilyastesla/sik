<?php

session_start(); //we need to start session in order to access it through CI

Class psb_antrian extends CI_Controller {

public function __construct() {
parent::__construct();

		// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');


		// Load library
		$this->load->library('session');

		// Load database
		$this->load->model('psb_antrian_db');

   if( $this->session->userdata('logged_in')) {
       if($this->dbx->checkpage($this->session->userdata('role_id'),'psb_antrian')==false){
          redirect('user_authentication');
       }
		}else{
			redirect('user_authentication');;
		}

	}

	public function index()
	{
			$data['show_table'] = $this->psb_antrian_db->data();
			$data['form']='Antrian';
			$data['view']='index';
			$this->load->view('psb_antrian_v', $data);
	}

	// TAMBAH
	//-------------------------------------------------------------------------------------------
	public function tambah($id='') {
		$data['form']='Antrian';
		$data['form_small']='Tambah Data';
		$data['view']='tambah';
		$data['action']='psb_antrian/tambah_p';
		$data= $this->psb_antrian_db->tambah_db($id,$data);
		$this->load->view('psb_antrian_v',$data);
	}

	public function tambah_p($id='') {
		$data = array(
										"tingkat"=>$this->input->post("tingkat")
										,"departemen"=>$this->input->post("departemen")
										,"aktif"=>$this->input->post("aktif")
										,"keterangan"=>$this->input->post("keterangan")
										,"urutan"=>$this->input->post("urutan")
										,"modified_date"=> $this->dbx->cts()
										,"modified_by"=> $this->session->userdata('idpegawai')
								);

		if ($id<>""){
			$result = $this->psb_antrian_db->ubah_pdb($data,$id) ;
		}else{
			$data = $this->p_c->arraymerge(array('created_date' => $this->dbx->cts()), $data);
			$data = $this->p_c->arraymerge(array('created_by' => $this->session->userdata('idpegawai')), $data);
			$id = $this->psb_antrian_db->tambah_pdb($data) ;
			if ($id<>""){$result=TRUE;}
		}

		if ($result == TRUE) {
			redirect("psb_antrian");
		} else {
			$data['error']="Errorr...";
			$this->ubah($id,$data);
		}
	}

	// UBAH
	//-------------------------------------------------------------------------------------------
	public function ubah($id,$stat='') {
		$data['form']='Antrian';
		$data['form_small']='Ubah Data';
		$data['view']='tambah';
		$data['action']='psb_antrian/tambah_p/'.$id;
		$data= $this->psb_antrian_db->tambah_db($id,$data);
		$this->load->view('psb_antrian_v',$data);
	}

	// HAPUS
	//-------------------------------------------------------------------------------------------
	public function hapus($id) {
		$result = $this->psb_antrian_db->hapus_pdb($id) ;
		if ($result == TRUE) {
			redirect('psb_antrian');
		}
	}

	public function ubahaktif($id,$aktif=0) {
		$data=array(
				'aktif' =>$aktif
				,"modified_date"=> $this->dbx->cts()
				,"modified_by"=> $this->session->userdata('idpegawai'));
		$result = $this->psb_antrian_db->ubah_pdb($data,$id);
		if ($result == TRUE) {
			redirect('psb_antrian');
		} else {
			$data['error']='Errorr...';
			$this->ubah($id,$data);
		}
	}
}//end of class
?>
