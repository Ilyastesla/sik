<?php

session_start(); //we need to start session in order to access it through CI

Class psb_proses extends CI_Controller {

public function __construct() {
parent::__construct();

		// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');


		// Load library
		$this->load->library('session');

		// Load database
		$this->load->model('psb_proses_db');

   if( $this->session->userdata('logged_in')) {
       if($this->dbx->checkpage($this->session->userdata('role_id'),'psb_proses')==false){
          redirect('user_authentication');
       }
		}else{
			redirect('user_authentication');;
		}

	}

	public function index()
	{
			$data = $this->psb_proses_db->data();
			$data['form']='Proses Penerimaan Siswa';
			$data['view']='index';
			$data['action']='psb_proses';
			$this->load->view('psb_proses_v', $data);
	}

	// TAMBAH
	//-------------------------------------------------------------------------------------------
	public function tambah($id='') {
		$data['form']='Proses Penerimaan Siswa';
		$data['form_small']='Tambah Data';
		$data['view']='tambah';
		$data['action']='psb_proses/tambah_p';
		$data= $this->psb_proses_db->tambah_db($id,$data);
		$this->load->view('psb_proses_v',$data);
	}

	public function tambah_p($id='') {
		$data = array(
										"departemen"=>$this->input->post("departemen")
										,"proses"=>$this->input->post("proses")
										,"kodeawalan"=>$this->input->post("kodeawalan")
										,"periode"=>$this->input->post("periode")
										,"keterangan"=>$this->input->post("keterangan")
										,"info1"=>$this->input->post("info1")
										,"aktif"=>$this->input->post("aktif")
										,"modified_date"=> $this->dbx->cts()
										,"modified_by"=> $this->session->userdata('idpegawai')
								);

		if ($id<>""){
			$result = $this->dbx->ubahdata('prosespenerimaansiswa',$data,'replid',$id);
		}else{
			$data = $this->p_c->arraymerge(array('created_date' => $this->dbx->cts()), $data);
			$data = $this->p_c->arraymerge(array('created_by' => $this->session->userdata('idpegawai')), $data);
			$id = $this->dbx->tambahdata('prosespenerimaansiswa',$data) ;
			if ($id<>""){$result=TRUE;}
		}
		//echo $this->db->last_query();die;
		if ($result == TRUE) {
			redirect("psb_proses");
		} else {
			$data['error']="Errorr...";
			$this->ubah($id,$data);
		}
	}

	// UBAH
	//-------------------------------------------------------------------------------------------
	public function ubah($id,$stat='') {
		$data['form']='Proses Penerimaan Siswa';
		$data['form_small']='Ubah Data';
		$data['view']='tambah';
		$data['action']='psb_proses/tambah_p/'.$id;
		$data= $this->psb_proses_db->tambah_db($id,$data);
		$this->load->view('psb_proses_v',$data);
	}

	// HAPUS
	//-------------------------------------------------------------------------------------------
	public function hapus($id) {
		$result = $this->dbx->hapusdata('prosespenerimaansiswa','replid',$id) ;
		if ($result == TRUE) {
			redirect('psb_proses');
		}
	}

	public function ubahaktif($id,$aktif=0) {
		$data=array(
				'aktif' =>$aktif
				,"modified_date"=> $this->dbx->cts()
				,"modified_by"=> $this->session->userdata('idpegawai'));
		$result = $this->psb_proses_db->ubah_pdb($data,$id);
		if ($result == TRUE) {
			redirect('psb_proses');
		} else {
			$data['error']='Errorr...';
			$this->ubah($id,$data);
		}
	}
}//end of class
?>
