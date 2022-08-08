<?php

session_start(); //we need to start session in order to access it through CI

Class hrm_pegawai_projek_task extends CI_Controller {

public function __construct() {
	parent::__construct();

		// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');


		// Load session library
		$this->load->library('session');

		// Load database
		$this->load->model('hrm_pegawai_projek_task_db');

		if( $this->session->userdata('logged_in')) {
			if($this->dbx->checkpage($this->session->userdata('role_id'),'hrm_pegawai_projek_task')==false){
					redirect('user_authentication');
			}
		}else{
			redirect('user_authentication');;
		}

	}

	public function index()
	{
			$data = $this->hrm_pegawai_projek_task_db->data();
			$data['form']='Projek Tugas Pegawai';
			$data['view']='index';
			$data['action']='hrm_pegawai_projek_task';
			$this->load->view('hrm_pegawai_projek_task_v', $data);
	}


	// TAMBAH
	//-------------------------------------------------------------------------------------------
	public function tambah($id='') {
		$data['form']='Projek Tugas Pegawai';
		$data['form_small']='Tambah Data';
		$data['view']='tambah';
		$data['action']='hrm_pegawai_projek_task/tambah_p';
		$data= $this->hrm_pegawai_projek_task_db->tambah_x($id,$data);
		$this->load->view('hrm_pegawai_projek_task_v',$data);
	}

	public function tambah_p($id='') {
		/*
			"tanggalmulai"=> $this->p_c->tgl_db($this->input->post('tanggalmulai')),
			"tanggalakhir"=> $this->p_c->tgl_db($this->input->post('tanggalakhir')),
			'idrole' => $this->p_c->arrdump($this->input->post('idrole')),
			*/
			$data = array(
				"tahun"=> $this->input->post("tahun"),
				"idprojek"=> $this->input->post("idprojek"),
				"projektask"=> $this->input->post("projektask"),
				"tujuan"=> $this->input->post("tujuan"),
				"indikatorkpi"=> $this->input->post("indikatorkpi"),
				"frekuensi"=> $this->input->post("frekuensi"),
				"biaya"=> $this->input->post("biaya"),
				"mitra"=> $this->input->post("mitra"),
				"idpj"=> $this->input->post("idpj"),
				"persenpj"=> $this->input->post("persenpj"),
				"idmonev"=> $this->input->post("idmonev"),
				"persenmonev"=> $this->input->post("persenmonev"),
				"persenpelaksana"=> $this->input->post("persenpelaksana"),
				"aktif"=> 1,
				"external"=> $this->input->post("external"),
				"modified_date"=> $this->dbx->cts(),
				"modified_by"=> $this->session->userdata('idpegawai'));
		if ($id<>""){
			$result = $this->dbx->ubahdata('hrm_pegawai_projek_task',$data,'replid',$id) ;
		}else{
			$data = $this->p_c->arraymerge(array('created_date' => $this->dbx->cts()), $data);
			$data = $this->p_c->arraymerge(array('created_by' => $this->session->userdata('idpegawai')), $data);
			$id = $this->dbx->tambahdata('hrm_pegawai_projek_task',$data);
			if ($id<>""){$result=TRUE;}
		}

		//$result = $this->hrm_pegawai_projek_task_db->importpeserta_db($id,$this->p_c->arrdump($this->input->post('idrole')));
		$idminggu=$this->input->post("idminggu");
		$this->dbx->hapusdata('hrm_pegawai_projek_task_jadwal','idprojek_task',$id);
		foreach ((array)$idminggu as $rowminggu) {
			$rowfordb=explode('.',$rowminggu);
			$data = array(
				"idprojek_task"=>$id,
				"bulan"=>$rowfordb[0],
				"minggu"=>$rowfordb[1]
		  );
			$result = $this->dbx->tambahdata('hrm_pegawai_projek_task_jadwal',$data);
	 }
			// code...

		if ($result == TRUE) {
			if ($this->input->post("external")<>1){
					redirect('hrm_pegawai_projek_task/peserta/'.$id);
			}else{
				redirect('hrm_pegawai_projek_task/view/1/'.$id);
			}

		} else {
			$data['error']='Errorr...';
			$this->ubah($id,$data);
		}
	}

	// UBAH
	//-------------------------------------------------------------------------------------------
	public function ubah($id,$stat='') {
		$data['form']='Projek Tugas Pegawai';
		$data['form_small']='Ubah Data';
		$data['view']='tambah';
		$data['action']='hrm_pegawai_projek_task/tambah_p/'.$id;
		$data= $this->hrm_pegawai_projek_task_db->tambah_x($id,$data);
		$this->load->view('hrm_pegawai_projek_task_v',$data);
	}

	public function peserta($id) {
		$data['form']='Projek Tugas Pegawai';
		$data['form_small']='Tambah Data Pegawai';
		$data['view']='peserta';
		$data['action']='hrm_pegawai_projek_task/tambahpeserta_p/'.$id;
		$data= $this->hrm_pegawai_projek_task_db->tambah_x($id,$data);
		$this->load->view('hrm_pegawai_projek_task_v',$data);
	}

	public function tambahpeserta_p($id) {
		$idpegawai=$this->input->post("idpegawai");
		$this->dbx->hapusdata('hrm_pegawai_projek_task_peserta','idprojek_task',$id);
		foreach ((array)$idpegawai as $rowpegawai) {
			$data = array(
				"idhrm_pegawai_projek_task"=>$id,
				"idpegawai"=>$rowpegawai
			);
			$result = $this->dbx->tambahdata('hrm_pegawai_projek_task_peserta',$data);
	 }

	 if ($result == TRUE) {
			redirect('hrm_pegawai_projek_task/view/1/'.$id);
	 } else {
		 $data['error']='Errorr...';
		 $this->ubah($id,$data);
	 }
 }

	public function ubahwajib_p($id,$idx,$wajib=0) {
		$data = array(
			"wajib"=> $wajib,
			"modified_date"=> $this->dbx->cts(),
			"modified_by"=> $this->session->userdata('idpegawai'));
		$result = $this->hrm_pegawai_projek_task_db->ubahwajib_db($data,$id,$idx) ;
		if ($result == TRUE) {
			redirect('hrm_pegawai_projek_task/view/1/'.$id);
		}
	}

	public function hrmeventpesertahapus($id,$idx) {
		$result = $this->hrm_pegawai_projek_task_db->hrmeventpesertahapus_db($id,$idx) ;
		if ($result == TRUE) {
			redirect('hrm_pegawai_projek_task/view/1/'.$id);
		}
	}

	public function hapus($id) {
		$result = $this->hrm_pegawai_projek_task_db->hapus_db($id) ;
		if ($result == TRUE) {
			redirect('hrm_pegawai_projek_task');
		}
	}

	public function ubahaktif($id,$aktif) {
		$data=array(
				'aktif' =>$aktif);
		$result = $this->hrm_pegawai_projek_task_db->ubah_pdb($data,$id);
		if ($result == TRUE) {
			redirect('hrm_pegawai_projek_task');
		} else {
			$data['error']='Errorr...';
			$this->ubah($id,$data);
		}
	}


	public function view($ubah,$id) {
		$data['form']='Projek Tugas Pegawai';
		$data['form_small']='View';
		$data['view']='view';
		$data['ubah']=$ubah;
		$data['action']='hrm_pegawai_projek_task/finish/'.$id;
		$data= $this->hrm_pegawai_projek_task_db->view_db($id,$data);
		$this->load->view('hrm_pegawai_projek_task_v',$data);
	}

}//end of class
?>
