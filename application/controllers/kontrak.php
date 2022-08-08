<?php

session_start(); //we need to start session in order to access it through CI

Class kontrak extends CI_Controller {

public function __construct() {
	parent::__construct();

		// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');


		// Load session library
		$this->load->library('session');

		// Load database
		$this->load->model('kontrak_db');

		if( $this->session->userdata('logged_in')) {
			if($this->dbx->checkpage($this->session->userdata('role_id'),'kontrak')==false){
					redirect('user_authentication');
			}
		}else{
			redirect('user_authentication');;
		}

	}

	public function index()
	{
			$data= $this->kontrak_db->data();
			//$data['show_table'] = $this->kontrak_db->data();
			$data['form']='Pengangkatan Pegawai';
			$data['view']='index';
			$data['action']='kontrak';
			$this->load->view('kontrak_v', $data);
	}

	// TAMBAH
	//-------------------------------------------------------------------------------------------
	public function tambah($id='') {
		$data['form']='Pengangkatan Pegawai';
		$data['form_small']='Tambah Data';
		$data['view']='tambah';
		$data['action']='kontrak/tambah_p';
		$data= $this->kontrak_db->tambah_x($id,$data);
		$this->load->view('kontrak_v',$data);
	}
	public function tambah_p($id='') {
		//,"memutuskan"=>$this->input->post("memutuskan")
		$data = array(
				"no_sk"=>$this->input->post("no_sk")
				,"idpegawai"=>$this->input->post("idpegawai")
				,"idcompany"=>$this->input->post("idcompany")
				,"idpegawai_tipe_pengangkatan"=>$this->input->post("idpegawai_tipe_pengangkatan")
				,"idjabatan"=>$this->input->post("idjabatan")
				,"idpegawai_status"=>$this->input->post("idpegawai_status")
				,"awal_kontrak"=>$this->p_c->tgl_db($this->input->post("awal_kontrak"))
				,"akhir_kontrak"=>$this->p_c->tgl_db($this->input->post("akhir_kontrak"))
				,"menimbang"=>$this->input->post("menimbang")
				,"mengingat"=>$this->input->post("mengingat")
				,"memperhatikan"=>$this->input->post("memperhatikan")
				,"keterangan"=>$this->input->post("keterangan")
				,"avg_kompetensi"=>$this->input->post("avg_kompetensi")
				,"tanggal_pembuatan"=>$this->p_c->tgl_db($this->input->post("tanggal_pembuatan"))
				,"jam_masuk"=>$this->input->post("jam_masuk")
				,"jam_keluar"=>$this->input->post("jam_keluar")
				,"modified_date"=> $this->dbx->cts()
				,"modified_by"=> $this->session->userdata('idpegawai'));
		if ($id<>""){
			$result = $this->kontrak_db->ubah($data,$id) ;
		}else{
			//$no_sk= $this->kontrak_db->no_sk($this->input->post("idcompany"),$this->p_c->tgl_db($this->input->post('tanggalpengajuan')));
			//$no_sk=>$this->input->post("no_sk");
			//$data = $this->p_c->arraymerge(array('no_sk' => $no_sk), $data);
			$data = $this->p_c->arraymerge(array('created_date' => $this->dbx->cts()), $data);
			$data = $this->p_c->arraymerge(array('created_by' => $this->session->userdata('idpegawai')), $data);
			$id = $this->kontrak_db->tambah($data);
			if ($id<>""){$result=TRUE;}
		}

		if ($result == TRUE) {
			redirect('kontrak/kompetensi/'.$id);
		} else {
			$data['error']='Errorr...';
			$this->ubah($id,$data);
		}
	}

	// UBAH
	//-------------------------------------------------------------------------------------------
	public function ubah($id,$stat='') {
		$data['form']='Pengangkatan Pegawai';
		$data['form_small']='Ubah Data';
		$data['view']='tambah';
		$data['action']='kontrak/tambah_p/'.$id;
		$data= $this->kontrak_db->tambah_x($id,$data);
		$this->load->view('kontrak_v',$data);
	}

	// KOMPETENSI
	//-------------------------------------------------------------------------------------------
	public function kompetensi($id,$stat='') {
		$data['form']='Pengangkatan Pegawai';
		$data['form_small']='Kompetensi';
		$data['view']='view';
		$data['view2']='0';
		$data['action']='kontrak/ubahstatus_p/'.$id;
		$data['id']=$id;
		$data= $this->kontrak_db->view_db($id,$data);
		$this->kontrak_db->tambahkompetensi($id,$data['isi']->idjabatan);
		$data= $this->kontrak_db->view_db($id,$data);
		$this->load->view('kontrak_v',$data);
	}
	public function tambahkompetensi($id,$idx="",$data="",$stat="") {
		$data['form']='Pengangkatan Pegawai';
		$data['form_small']='Kompetensi';
		$data['view']='tambahkompetensi';
		$data['action']='kontrak/tambahkompetensi_p/'.$id.'/'.$idx;
		$data['idx']=$id;
		$data= $this->kontrak_db->ubahkompetensi_x($idx,$data);
		$this->load->view('kontrak_v',$data);
	}


	public function tambahkompetensi_p($id,$idx='') {
		$data = array(
				"skor"=>$this->input->post("skor")
				,"modified_date"=> $this->dbx->cts()
				,"modified_by"=> $this->session->userdata('idpegawai'));
		if ($idx<>""){
			$result = $this->kontrak_db->ubahkompetensi_db($data,$idx) ;
		}else{
			$idx = $this->kontrak_db->tambahkompetensi_db($data);
			if ($idx<>""){$result=TRUE;}
		}
		if ($result == TRUE) {
			redirect('kontrak/kompetensi/'.$id);
		} else {
			$data['error']='Errorr...';
			$this->ubahkompetensi($id,$idx,$data);
		}
	}

	public function hapuskompetensi($id,$idx="") {
		$result = $this->kontrak_db->hapuskompetensi_db($idx) ;
		if ($result == TRUE) {
			redirect('kontrak/kompetensi/'.$id);
		}
	}

	public function ubahstatus_p($id,$stat='') {
		$data = array(
				"aktif"=> $this->input->post("aktif"),
				"avg_kompetensi"=> $this->input->post("avg_kompetensi"),
				"modified_date"=> $this->dbx->cts(),
				"modified_by"=> $this->session->userdata('idpegawai'));
		$result = $this->kontrak_db->ubah($data,$id) ;

		//perubahan status
		$result=$this->kontrak_db->last_stat($id,$this->input->post("idpegawai"),$this->input->post("idjabatan"));

		if ($result == TRUE) {
			redirect('kontrak/view/'.$id);
		} else {
			$data['error']='Errorr...';
			$this->kompetensi($id,$data);
		}
	}


	public function hapus($id) {
		$result = $this->kontrak_db->hapus_db($id) ;
		if ($result == TRUE) {
			redirect('kontrak');
		}
	}

	public function view($id,$stat='') {
		$data['form']='Pengangkatan Pegawai';
		$data['form_small']='Lihat';
		$data['view']='view';
		$data['view2']='1';
		$data['action']='kontrak/terima_p/'.$id;
		$data= $this->kontrak_db->view_db($id,$data);
		$this->load->view('kontrak_v',$data);
	}


}//end of class
?>
