<?php

session_start(); //we need to start session in order to access it through CI

Class jabatan extends CI_Controller {

public function __construct() {
	parent::__construct();

		// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');


		// Load session library
		$this->load->library('session');

		// Load database
		$this->load->model('jabatan_db');

		if( $this->session->userdata('logged_in')) {
			if($this->dbx->checkpage($this->session->userdata('role_id'),'jabatan')==false){
					redirect('user_authentication');
			}
		}else{
			redirect('user_authentication');;
		}

	}

	public function index()
	{
			$data['show_table'] = $this->jabatan_db->data();
			$data['form']='Jabatan';
			$data['view']='index';
			$this->load->view('jabatan_v', $data);
	}

	// TAMBAH
	//-------------------------------------------------------------------------------------------
	public function tambah($id='') {
		$data['form']='Jabatan';
		$data['form_small']='Tambah Data';
		$data['view']='tambah';
		$data['action']='jabatan/tambah_p';
		$data= $this->jabatan_db->tambah_x($id,$data);
		$this->load->view('jabatan_v',$data);
	}

	public function tambah_p($id='') {
	    //"penerima"=> $this->input->post("penerima"),
	    //"tanggalpenerima"=> $this->input->post("tanggalpenerima"),
		$data = array(
				"jabatan"=> $this->input->post("jabatan"),
				"idjabatan_grup"=> $this->input->post("idjabatan_grup"),
				"idkepala_jabatan"=> $this->input->post("idkepala_jabatan"),
				"iddepartemen"=> $this->input->post("iddepartemen"),
				"aktif"=> $this->input->post("aktif"),
				"modified_date"=> $this->dbx->cts(),
				"modified_by"=> $this->session->userdata('idpegawai'));
		if ($id<>""){
			$result = $this->jabatan_db->ubah($data,$id) ;
		}else{
			$data = $this->p_c->arraymerge(array('created_date' => $this->dbx->cts()), $data);
			$data = $this->p_c->arraymerge(array('created_by' => $this->session->userdata('idpegawai')), $data);
			$id = $this->jabatan_db->tambah($data);
			if ($id<>""){$result=TRUE;}
		}

		if ($result == TRUE) {
			redirect('jabatan/kompetensi/'.$id);
		} else {
			$data['error']='Errorr...';
			$this->ubah($id,$data);
		}
	}

	// UBAH
	//-------------------------------------------------------------------------------------------
	public function ubah($id,$stat='') {
		$data['form']='Jabatan';
		$data['form_small']='Ubah Data';
		$data['view']='tambah';
		$data['action']='jabatan/tambah_p/'.$id;
		$data= $this->jabatan_db->tambah_x($id,$data);
		$this->load->view('jabatan_v',$data);
	}

	public function hapus($id) {
		$result = $this->jabatan_db->hapus_db($id) ;
		if ($result == TRUE) {
			redirect('jabatan');
		}
	}

	// KOMPETENSI
	//-------------------------------------------------------------------------------------------
	public function kompetensi($id) {
		$data['form']='Jabatan';
		$data['form_small']='Kompetensi';
		$data['view']='view';
		$data['view2']='0';
		$data['action']='jabatan/ubahstatus_p/'.$id;
		$data['id']=$id;

		$this->jabatan_db->tambahkompetensi($id);

		$data= $this->jabatan_db->view_db($id,$data);
		$this->load->view('jabatan_v',$data);
	}
	public function tambahkompetensi($id) {
		$data['form']='Jabatan';
		$data['form_small']='Kompetensi';
		$data['view']='tambahkompetensi';
		$data['action']='jabatan/tambahkompetensi_p/'.$id;
		$data['idx']=$id;
		$data= $this->jabatan_db->ubahkompetensi_x($id,$data);
		$this->load->view('jabatan_v',$data);
	}


	public function tambahkompetensi_p($id) {
		$allkompetensi=$this->input->post("allkompetensi");
		if ($allkompetensi<>""){
			$allkompetensi_arr = explode(",", $allkompetensi);
			foreach((array)$allkompetensi_arr as $replid){
				if ($this->input->post("idkompetensi".$replid)==1){
					$data = array(
						"idjabatan"=>$id
						,"idkompetensi"=>$replid
						,"modified_date"=> $this->dbx->cts()
						,"modified_by"=> $this->session->userdata('idpegawai')
					);
					$idx = $this->jabatan_db->tambahjabatankompetensi_db($data);
					if ($idx<>""){$result=TRUE;}
				}//if
			}//foreach
		}else{
			redirect('jabatan/kompetensi/'.$id);
			die;
		} //if ($allkompetensi

		if ($result == TRUE) {
			redirect('jabatan/kompetensi/'.$id);
		} else {
			$data['error']='Errorr...';
			$this->ubahkompetensi($id,$idx,$data);
		}
	}

	public function hapuskompetensi($id,$idx="") {
		$result = $this->jabatan_db->hapuskompetensi_db($idx) ;
		if ($result == TRUE) {
			redirect('jabatan/kompetensi/'.$id);
		}
	}



}//end of class
?>
