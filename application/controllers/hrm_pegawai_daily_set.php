<?php

session_start(); //we need to start session in order to access it through CI

Class hrm_pegawai_daily_set extends CI_Controller {

public function __construct() {
	parent::__construct();

		// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');


		// Load session library
		$this->load->library('session');

		// Load database
		$this->load->model('hrm_pegawai_daily_set_db');

		if( $this->session->userdata('logged_in')) {
			if($this->dbx->checkpage($this->session->userdata('role_id'),'hrm_pegawai_daily_set')==false){
					redirect('user_authentication');
			}
		}else{
			redirect('user_authentication');;
		}

	}

	public function index()
	{
			$data = $this->hrm_pegawai_daily_set_db->data();
			$data['form']='Set Rutinitas';
			$data['view']='index';
			$data['action']='hrm_pegawai_daily_set';
			$this->load->view('hrm_pegawai_daily_set_v', $data);
	}


	// TAMBAH
	//-------------------------------------------------------------------------------------------
	public function tambah($id='') {
		$data['form']='Set Rutinitas';
		$data['form_small']='Tambah Data';
		$data['view']='tambah';
		$data['action']='hrm_pegawai_daily_set/tambah_p';
		$data= $this->hrm_pegawai_daily_set_db->tambah_x($id,$data);
		$this->load->view('hrm_pegawai_daily_set_v',$data);
	}

	public function tambah_p($id='') {
			$sqldurasi="SELECT TIMEDIFF('".$this->input->post("jamakhirhour").":".$this->input->post("jamakhirminute").":00','".$this->input->post("jammulaihour").":".$this->input->post("jammulaiminute").":00') as isi";
			$durasi=$this->dbx->singlerow($sqldurasi);
			if (($this->input->post("durasihour")<>'00') or ($this->input->post("durasitime")<>'00')){
				$durasi=$this->input->post("durasihour").':'.$this->input->post("durasiminute").':00';
			}
		$data = array(
				"idpegawai"=> $this->session->userdata('idpegawai'),
				"idkegiatantipe"=> $this->input->post("idkegiatantipe"),
				"kegiatan"=> $this->input->post("kegiatan"),
				"deskripsi"=> $this->input->post("deskripsi"),
				"aktif"=> $this->input->post("aktif"),
				"idprojektask"=> $this->input->post("idprojektask"),
				"jammulai"=> $this->input->post("jammulaihour").':'.$this->input->post("jammulaiminute").':00',
				"jamakhir"=> $this->input->post("jamakhirhour").':'.$this->input->post("jamakhirminute").':00',
				"durasi"=> $durasi,
				"modified_date"=> $this->dbx->cts(),
				"modified_by"=> $this->session->userdata('idpegawai'));
		if ($id<>""){
      $result = $this->dbx->ubahdata('hrm_pegawai_daily_set',$data,'replid',$id);
		}else{
			$data = $this->p_c->arraymerge(array('created_date' => $this->dbx->cts()), $data);
			$data = $this->p_c->arraymerge(array('created_by' => $this->session->userdata('idpegawai')), $data);
			$id=$this->dbx->tambahdata('hrm_pegawai_daily_set',$data);
      //echo $this->db->last_query();die;
			if ($id<>""){$result=TRUE;}
		}

		if ($result == TRUE) {
			redirect('hrm_pegawai_daily_set');
		} else {
			$data['error']='Errorr...';
			$this->ubah($id,$data);
		}
	}

	// UBAH
	//-------------------------------------------------------------------------------------------
	public function ubah($id,$stat='') {
		$data['form']='Set Rutinitas';
		$data['form_small']='Ubah Data';
		$data['view']='tambah';
		$data['action']='hrm_pegawai_daily_set/tambah_p/'.$id;
		$data= $this->hrm_pegawai_daily_set_db->tambah_x($id,$data);
		$this->load->view('hrm_pegawai_daily_set_v',$data);
	}

  // HAPUS
	//-------------------------------------------------------------------------------------------
	public function hapus($id) {
		$result = $this->dbx->hapusdata('hrm_pegawai_daily_set','replid',$id) ;
		if ($result == TRUE) {
			redirect('hrm_pegawai_daily_set');
		}
	}

	public function ubahaktif($id,$aktif) {
		$data=array(
				'aktif' =>$aktif);
		$result = $this->hrm_pegawai_daily_set_db->ubah_pdb($data,$id);
		if ($result == TRUE) {
			redirect('hrm_pegawai_daily_set');
		} else {
			$data['error']='Errorr...';
			$this->ubah($id,$data);
		}
	}


}//end of class
?>
