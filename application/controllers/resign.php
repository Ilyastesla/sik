<?php

session_start(); //we need to start session in order to access it through CI

Class resign extends CI_Controller {

public function __construct() {
	parent::__construct();

		// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');


		// Load session library
		$this->load->library('session');

		// Load database
		$this->load->model('resign_db');

   if( $this->session->userdata('logged_in')) {
       if($this->dbx->checkpage($this->session->userdata('role_id'),'resign')==false){
          redirect('user_authentication');
       }
		}else{
			redirect('user_authentication');;
		}

	}

	public function index()
	{
			$data['show_table'] = $this->resign_db->data();
			$data['form']='Pemutusan Kontrak Pegawai';
			$data['view']='index';
			$this->load->view('resign_v', $data);
	}


	// TAMBAH
	//-------------------------------------------------------------------------------------------
	public function tambah($id='') {
		$data['form']='Pemutusan Kontrak Pegawai';
		$data['form_small']='Tambah Data';
		$data['view']='tambah';
		$data['action']='resign/tambah_p';
		$data= $this->resign_db->tambah_x($id,$data);
		$this->load->view('resign_v',$data);
	}
	public function tambah_p($id='') {
		//,"memutuskan"=>$this->input->post("memutuskan")
		$data = array(
				"no_sk"=>$this->input->post("no_sk")
				,"idpegawai"=>$this->input->post("idpegawai")
				,"idcompany"=>$this->input->post("idcompany")
				,"idtype_resign"=>$this->input->post("idtype_resign")
				,"tgl_resign"=>$this->p_c->tgl_db($this->input->post("tgl_resign"))
				,"keterangan"=>$this->input->post("keterangan")
				,"modified_date"=> $this->dbx->cts()
				,"modified_by"=> $this->session->userdata('nip'));
		if ($id<>""){
			$result = $this->resign_db->ubah($data,$id) ;
		}else{
			//$no_sk= $this->resign_db->no_sk($this->input->post("idcompany"),$this->p_c->tgl_db($this->input->post('tanggalpengajuan')));
			//$no_sk=>$this->input->post("no_sk");
			//$data = $this->p_c->arraymerge(array('no_sk' => $no_sk), $data);
			$data = $this->p_c->arraymerge(array('created_date' => $this->dbx->cts()), $data);
			$data = $this->p_c->arraymerge(array('created_by' => $this->session->userdata('nip')), $data);
			$id = $this->resign_db->tambah($data);
			if ($id<>""){$result=TRUE;}
		}

		if ($result == TRUE) {
			redirect('resign/kompetensi/'.$id);
		} else {
			$data['error']='Errorr...';
			$this->ubah($id,$data);
		}
	}

	// UBAH
	//-------------------------------------------------------------------------------------------
	public function ubah($id,$stat='') {
		$data['form']='Pemutusan Kontrak Pegawai';
		$data['form_small']='Ubah Data';
		$data['view']='tambah';
		$data['action']='resign/tambah_p/'.$id;
		$data= $this->resign_db->tambah_x($id,$data);
		$this->load->view('resign_v',$data);
	}

	// KOMPETENSI
	//-------------------------------------------------------------------------------------------
	public function kompetensi($id,$stat='') {
		$data['form']='Pemutusan Kontrak Pegawai';
		$data['form_small']='Kompetensi';
		$data['view']='view';
		$data['view2']='0';
		$data['action']='resign/ubahstatus_p/'.$id;
		$data['id']=$id;
		$data= $this->resign_db->view_db($id,$data);
		$this->resign_db->tambahkompetensi($id,$data['isi']->idjabatan);
		$data= $this->resign_db->view_db($id,$data);
		$this->load->view('resign_v',$data);
	}
	public function tambahkompetensi($id,$idx="",$data="",$stat="") {
		$data['form']='Pemutusan Kontrak Pegawai';
		$data['form_small']='Kompetensi';
		$data['view']='tambahkompetensi';
		$data['action']='resign/tambahkompetensi_p/'.$id.'/'.$idx;
		$data['idx']=$id;
		$data= $this->resign_db->ubahkompetensi_x($idx,$data);
		$this->load->view('resign_v',$data);
	}


	public function tambahkompetensi_p($id,$idx='') {
		$data = array(
				"skor"=>$this->input->post("skor")
				,"modified_date"=> $this->dbx->cts()
				,"modified_by"=> $this->session->userdata('nip'));
		if ($idx<>""){
			$result = $this->resign_db->ubahkompetensi_db($data,$idx) ;
		}else{
			$idx = $this->resign_db->tambahkompetensi_db($data);
			if ($idx<>""){$result=TRUE;}
		}
		if ($result == TRUE) {
			redirect('resign/kompetensi/'.$id);
		} else {
			$data['error']='Errorr...';
			$this->ubahkompetensi($id,$idx,$data);
		}
	}

	public function hapuskompetensi($id,$idx="") {
		$result = $this->resign_db->hapuskompetensi_db($idx) ;
		if ($result == TRUE) {
			redirect('resign/kompetensi/'.$id);
		}
	}

	public function ubahstatus_p($id,$stat='') {
		$data = array(
				"avg_kompetensi"=> $this->input->post("avg_kompetensi"),
				"modified_date"=> $this->dbx->cts(),
				"modified_by"=> $this->session->userdata('nip'));
		$result = $this->resign_db->ubah($data,$id) ;

		//perubahan status
		$result=$this->resign_db->last_stat($id,$this->input->post("idpegawai"),$this->input->post("idjabatan"));

		if ($result == TRUE) {
			redirect('resign/view/'.$id);
		} else {
			$data['error']='Errorr...';
			$this->kompetensi($id,$data);
		}
	}


	public function hapus($id) {
		$result = $this->resign_db->hapus_db($id) ;
		if ($result == TRUE) {
			redirect('resign');
		}
	}

	public function view($id,$stat='') {
		$data['form']='Pemutusan Kontrak Pegawai';
		$data['form_small']='Lihat';
		$data['view']='view';
		$data['view2']='1';
		$data['action']='resign/terima_p/'.$id;
		$data= $this->resign_db->view_db($id,$data);
		$this->load->view('resign_v',$data);
	}


}//end of class
?>
