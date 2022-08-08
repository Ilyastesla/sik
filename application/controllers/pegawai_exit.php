<?php

session_start(); //we need to start session in order to access it through CI

Class pegawai_exit extends CI_Controller {

public function __construct() {
	parent::__construct();

		// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');


		// Load session library
		$this->load->library('session');

		// Load database
		$this->load->model('pegawai_exit_db');

   if( $this->session->userdata('logged_in')) {
       if($this->dbx->checkpage($this->session->userdata('role_id'),'pegawai_exit')==false){
          redirect('user_authentication');
       }
		}else{
			redirect('user_authentication');;
		}

	}

	public function index()
	{
			//$data['show_table'] = $this->pegawai_exit_db->data();
			$data['form']='Exit Interview';
			$data['view']='index';
			$data['action']='pegawai_exit';
			$data= $this->pegawai_exit_db->data($data);
			$this->load->view('pegawai_exit_v', $data);
	}

	// TAMBAH
	//-------------------------------------------------------------------------------------------
	public function tambah($id='') {
		$data['form']='Exit Interview';
		if($id<>""){
			$data['form_small']='Tambah Data';
		}else{
			$data['form_small']='Ubah Data';
		}
		$data['view']='tambah';
		$data['action']='pegawai_exit/tambah_p/'.$id;
		$data= $this->pegawai_exit_db->tambah_db($id,$data);
		$this->load->view('pegawai_exit_v',$data);
	}

	public function tambah_p($id='') {
		if ($this->input->post("batal")<>"1"){
			if ($this->input->post("selesai")<>"1"){
		      $status=1;
		    }else{
		      //$result = $this->ubahstatuspegawai_p($this->input->post("idpegawai"),0) ;
		  		//$result = $this->ubahstatuslogin_p($this->input->post("idpegawai"),0) ;
		      $status=2;
		    }
		}else{
			$status="CC";
		}
		$idalasan=$this->input->post("idalasan");
		if(($this->input->post("idalasan")=="lain") and ($this->input->post("idalasan_lainnya")<>"")){
			$data = array(
									"type" => "pegawai_exit"
									,"nama" => $this->input->post("idalasan_lainnya")
									,"aktif" => 1
									,"modified_date"=> $this->dbx->cts()
									,"modified_by"=> $this->session->userdata('idpegawai')
									,"created_date"=> $this->dbx->cts()
									,"created_by"=> $this->session->userdata('idpegawai')
								);
			$idalasan = $this->dbx->tambahdata('hrm_reff',$data);
		}

		$data = array(
								"idjabatan" => $this->input->post("idjabatan")
								,"idalasan" => $idalasan
								,"tanggal_keluar"=>$this->p_c->tgl_db($this->input->post("tanggal_keluar"))
								,"keterangan"=>$this->input->post("keterangan")
								,"status" => $status
								,"modified_date"=> $this->dbx->cts()
								,"modified_by"=> $this->session->userdata('idpegawai'));
		if ($id<>""){
			$result = $this->dbx->ubahdata('hrm_pegawai_exit',$data,'replid',$id) ;
		}else{
			$data = $this->p_c->arraymerge(array('idpegawai' => $this->input->post("idpegawai")), $data);
			$data = $this->p_c->arraymerge(array('created_date' => $this->dbx->cts()), $data);
			$data = $this->p_c->arraymerge(array('created_by' => $this->session->userdata('idpegawai')), $data);
			$id = $this->dbx->tambahdata('hrm_pegawai_exit',$data);;
			if ($id<>""){$result=TRUE;}else{$result=false;}
		}

		if ($result == TRUE) {
			redirect('pegawai_exit/view/'.$id);
		} else {
			$data['error']='Errorr...';
			$this->tambah($id,$data);
		}
	}

	public function hapus($id,$idpegawai) {
		$result = $this->pegawai_exit_db->hapus_db($id) ;
		if ($result == TRUE) {
			redirect('pegawai_exit');
		} else {
				$data['error']='Errorr...';
				$this->ubah($id,$data);
		}
	}

	public function view($id,$stat='') {
		$data['form']='Exit Interview';
		$data['form_small']='Lihat';
		$data['view']='view';
		$data['print']='0';
		$data['action']='pegawai_exit/terima_p/'.$id;
		$data= $this->pegawai_exit_db->view_db($id,$data);
		$this->load->view('pegawai_exit_v',$data);
	}

}//end of class
?>
