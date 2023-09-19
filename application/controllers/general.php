<?php

session_start(); //we need to start session in order to access it through CI

Class general extends CI_Controller {

public function __construct() {
parent::__construct();

		// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');

		// Load library
		$this->load->library('session');
    // Load database
    $this->load->model('general_db');

		if( $this->session->userdata('logged_in')) {
		}else{
			redirect('user_authentication');;
		}

	}

	public function hrm_codeofconduct()
	{
			$data= $this->general_db->hrm_codeofconduct_db();
			$data['form']='Kebijakan Sekolah Kak Seto';
      		$data['form_small']='Lihat';
			$data['view']='index';
			$this->load->view('hrm_codeofconduct_v', $data);
	}
	
	public function manualbook()
	{
			$data= $this->general_db->manualbook_db();
			//echo var_dump($data['show_table']);
			$data['form']='Manual Book';
      		$data['form_small']='Lihat';
			$data['view']='index';
			$this->load->view('manualbook_v', $data);
	}
	
	public function datasiswa($idsiswa)
	{
			$data= $this->general_db->datasiswa_db($idsiswa);
			$data['form']='Data Peserta Didik';
      		$data['form_small']='Lihat';
			$data['view']='index';
			$this->load->view('datasiswa_v', $data);
	}

	public function coverrapor($idsiswa)
	{
			$data= $this->general_db->datasiswa_db($idsiswa);
			$data['form']='Cover Rapor';
			$data['form_small']='Cetak';
			$this->load->view('cover_rapor_v', $data);
	}

	public function datacalonsiswa($idcalonsiswa)
	{
			$data= $this->general_db->datacalonsiswa_db($idcalonsiswa);
			$data['form']='Data Calon Peserta Didik';
      $data['form_small']='Lihat';
			$data['view']='index';
			$this->load->view('datacalonsiswa_v', $data);
	}

	public function datapegawai($idpegawai) {
		$data= $this->general_db->datapegawai($idpegawai);
		$data['form']='Data Pegawai';
      	$data['form_small']='Lihat';
		/*
		$data= $this->pegawai_db->kontakdarurat_db($idpegawai,$data);
		$data= $this->pegawai_db->keluarga_db($idpegawai,$data);
		$data= $this->pegawai_db->perbankan_db($idpegawai,$data);
		$data= $this->pegawai_db->pendidikan_db($idpegawai,$data);
		$data= $this->pegawai_db->pendidikan_nf_db($idpegawai,$data);
		$data= $this->pegawai_db->bahasa_db($idpegawai,$data);
		$data= $this->pegawai_db->komputer_db($idpegawai,$data);
		$data= $this->pegawai_db->skill_db($idpegawai,$data);
		$data= $this->pegawai_db->prestasi_db($idpegawai,$data);
		$data= $this->pegawai_db->organisasi_db($idpegawai,$data);
		$data= $this->pegawai_db->kerja_db($idpegawai,$data);
		$data= $this->pegawai_db->kontrak_db($idpegawai,$data);
		$data= $this->pegawai_db->event_db($idpegawai,$data);
		*/
		$this->load->view('datapegawai_v',$data);
		
	}

}//end of class
?>
