<?php

session_start(); //we need to start session in order to access it through CI

Class lyn_staff extends CI_Controller {

public function __construct() {
parent::__construct();

		// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');


		// Load session library
		$this->load->library('session');

		// Load database
		$this->load->model('lyn_staff_db');

   if( $this->session->userdata('logged_in')) {
       if($this->dbx->checkpage($this->session->userdata('role_id'),'lyn_staff')==false){
          redirect('user_authentication');
       }
		}else{
			redirect('user_authentication');;
		}

	}

	public function index()
	{
			$data['show_table'] = $this->lyn_staff_db->data();
			$data['form']='Staf KSLC';
			$data['view']='index';
			$this->load->view('lyn_staff_v', $data);
	}

	// TAMBAH
	//-------------------------------------------------------------------------------------------
	public function tambah($id) {
		$data['form']='Staf KSLC';
		$data['form_small']='Tambah Data';
		$data['view']='tambah';
		$data['action']='lyn_staff/tambah_p/'.$id;
		$data= $this->lyn_staff_db->tambah_db($id,$data);
		$this->load->view('lyn_staff_v',$data);
	}

	public function tambah_p($id) {
		$result = $this->db->query("DELETE FROM lyn_pegawai_layanan WHERE idpegawai='".$id."'");
		$result = $this->db->query("DELETE FROM lyn_pegawai_grupjadwal WHERE idpegawai='".$id."'");
		$result = $this->db->query("DELETE FROM lyn_pegawai_sektor WHERE idpegawai='".$id."'");

		foreach((array)$this->input->post('idlayanan') as $rowlayanan) {
			$datalayanan = array(
				'idpegawai'=>$id,
				'idlayanan' => $rowlayanan,
				'created_date' => $this->dbx->cts(),
				'created_by' => $this->session->userdata('idpegawai')
			);
			$result=$this->dbx->tambahdata('lyn_pegawai_layanan',$datalayanan) ;
		}
		
		foreach((array)$this->input->post('idgrupjadwal') as $rowgrupjadwal) {
			$datagrupjadwal = array(
				'idpegawai'=>$id,
				'idgrupjadwal' => $rowgrupjadwal,
				'created_date' => $this->dbx->cts(),
				'created_by' => $this->session->userdata('idpegawai')
			);
			$result=$this->dbx->tambahdata('lyn_pegawai_grupjadwal',$datagrupjadwal) ;
		}
		foreach((array)$this->input->post('idsektor') as $rowsektor) {
			$datasektor = array(
				'idpegawai'=>$id,
				'idsektor' => $rowsektor,
				'created_date' => $this->dbx->cts(),
				'created_by' => $this->session->userdata('idpegawai')
			);
			$result=$this->dbx->tambahdata('lyn_pegawai_sektor',$datasektor) ;
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
		$data['form']='Staf KSLC';
		$data['form_small']='Ubah Data';
		$data['view']='tambah';
		$data['action']='lyn_staff/tambah_p/'.$id;
		$data= $this->lyn_staff_db->tambah_db($id,$data);
		$this->load->view('lyn_staff_v',$data);
	}
}//end of class
?>
