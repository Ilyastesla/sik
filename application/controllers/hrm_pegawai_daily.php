<?php

session_start(); //we need to start session in order to access it through CI

Class hrm_pegawai_daily extends CI_Controller {

public function __construct() {
	parent::__construct();

		// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');


		// Load session library
		$this->load->library('session');

		// Load database
		$this->load->model('hrm_pegawai_daily_db');

		if( $this->session->userdata('logged_in')) {
			if($this->dbx->checkpage($this->session->userdata('role_id'),'hrm_pegawai_daily')==false){
					redirect('user_authentication');
			}
		}else{
			redirect('user_authentication');
		}

	}

	public function index()
	{
			$data = $this->hrm_pegawai_daily_db->data();
			$data['form']='Aktivitas Saya';
			$data['view']='index';
			$data['action']='hrm_pegawai_daily';
			$this->load->view('hrm_pegawai_daily_v', $data);
	}


	// TAMBAH
	//-------------------------------------------------------------------------------------------
	public function tambah($id='') {
		$data['form']='Aktivitas Saya';
		$data['form_small']='Tambah Data';
		$data['view']='tambah';
		$data['action']='hrm_pegawai_daily/tambah_p';
		$data= $this->hrm_pegawai_daily_db->tambah_x($id,$data);
		$this->load->view('hrm_pegawai_daily_v',$data);
	}

	// UBAH
	//-------------------------------------------------------------------------------------------
	public function ubah($id,$stat='') {
		$data['form']='Aktivitas Saya';
		$data['form_small']='Ubah Data';
		$data['view']='tambah';
		$data['action']='hrm_pegawai_daily/tambah_p/'.$id;
		$data= $this->hrm_pegawai_daily_db->tambah_x($id,$data);
		$this->load->view('hrm_pegawai_daily_v',$data);
	}
	public function tambah_p($id='') {
	    //"penerima"=> $this->input->post("penerima"),
	    //"tanggalpenerima"=> $this->input->post("tanggalpenerima"),
			$sqldurasi="SELECT TIMEDIFF('".$this->input->post("jamakhirhour").":".$this->input->post("jamakhirminute").":00','".$this->input->post("jammulaihour").":".$this->input->post("jammulaiminute").":00') as isi";
			$durasi=$this->dbx->singlerow($sqldurasi);
			if (($this->input->post("durasihour")<>'00') or ($this->input->post("durasitime")<>'00')){
				$durasi=$this->input->post("durasihour").':'.$this->input->post("durasiminute").':00';
			}
		//echo $this->input->post("idkegiatantipe");
		//die;
		$data = array(
				"idpegawai"=> $this->session->userdata('idpegawai'),
				"idkegiatantipe"=> $this->input->post("idkegiatantipe"),
				"kegiatan"=> $this->input->post("kegiatan"),
				"deskripsi"=> $this->input->post("deskripsi"),
				"selesai"=> $this->input->post("selesai"),
				"aktif"=> $this->input->post("aktif"),
				"bantuan"=> $this->input->post("bantuan"),
				"idprojektask"=> $this->input->post("idprojektask"),
				"tanggal"=> $this->p_c->tgl_db($this->input->post('tanggal')),
				"jammulai"=> $this->input->post("jammulaihour").':'.$this->input->post("jammulaiminute").':00',
				"jamakhir"=> $this->input->post("jamakhirhour").':'.$this->input->post("jamakhirminute").':00',
				"durasi"=> $durasi,
				"modified_date"=> $this->dbx->cts(),
				"modified_by"=> $this->session->userdata('idpegawai'));
		if ($id<>""){
			$result = $this->dbx->ubahdata('hrm_pegawai_daily',$data,'replid',$id);
		}else{
			$data = $this->p_c->arraymerge(array('created_date' => $this->dbx->cts()), $data);
			$data = $this->p_c->arraymerge(array('created_by' => $this->session->userdata('idpegawai')), $data);
			$id=$this->dbx->tambahdata('hrm_pegawai_daily',$data);
			if ($id<>""){$result=TRUE;}
		}

		if ($result == TRUE) {
			redirect('hrm_pegawai_daily');
		} else {
			$data['error']='Errorr...';
			$this->ubah($id,$data);
		}
	}



	public function hapus($id) {
		$result = $this->dbx->hapusdata('hrm_pegawai_daily','replid',$id) ;
		//echo $this->db->last_query();die;
		if ($result == TRUE) {
			redirect('hrm_pegawai_daily');
		}
	}

	public function copydaily($id) {
		$result = $this->hrm_pegawai_daily_db->copydaily_db($id) ;
		if ($result<>0) {
			//redirect('hrm_pegawai_daily/ubah/'.$result);
			redirect('hrm_pegawai_daily');
		}
	}
}//end of class
?>
