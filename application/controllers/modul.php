<?php

session_start(); //we need to start session in order to access it through CI

Class modul extends CI_Controller {

public function __construct() {
	parent::__construct();

		// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');


		// Load session library
		$this->load->library('session');

		// Load database
		$this->load->model('modul_db');

		if( $this->session->userdata('logged_in')) {
			if($this->dbx->checkpage($this->session->userdata('role_id'),'modul')==false){
					redirect('user_authentication');
			}
		}else{
			redirect('user_authentication');;
		}

	}

	public function index()
	{
			$data['show_table'] = $this->modul_db->data();
			$data['form']='Modul';
			$data['view']='index';
			$this->load->view('modul_v', $data);
	}

	// TAMBAH
	//-------------------------------------------------------------------------------------------
	public function tambah($id='') {
		$data['form']='Modul';
		$data['form_small']='Tambah Data';
		$data['view']='tambah';
		$data['action']='modul/tambah_p';
		$data= $this->modul_db->tambah_x($id,$data);
		$this->load->view('modul_v',$data);
	}

	public function tambah_p($id='') {
	    //"keterangan"=> $this->input->post("keterangan"),
		$data = array(
				"nama"=> $this->input->post("modul"),
				"pages"=> $this->input->post("pages"),
				"icon"=> $this->input->post("icon"),
				"no_urut"=> $this->input->post("no_urut"),
				"aktif"=> $this->input->post("aktif"),
				"modified_date"=> $this->dbx->cts(),
				"modified_by"=> $this->session->userdata('idpegawai'));
		if ($id<>""){
			$data = $this->p_c->arraymerge(array('created_date' => $this->dbx->cts()), $data);
			$data = $this->p_c->arraymerge(array('created_by' => $this->session->userdata('idpegawai')), $data);
			$result = $this->dbx->ubahdata('hrm_modul',$data,'replid',$id);
		}else{
			$id = $this->dbx->tambahdata('hrm_modul',$data);
			if ($id<>""){$result=TRUE;}
		}

		if ($result == TRUE) {
			redirect('modul');
		} else {
			$data['error']='Errorr...';
			$this->ubah($id,$data);
		}
	}

	// UBAH
	//-------------------------------------------------------------------------------------------
	public function ubah($id,$stat='') {
		$data['form']='Modul';
		$data['form_small']='Ubah Data';
		$data['view']='tambah';
		$data['action']='modul/tambah_p/'.$id;
		$data= $this->modul_db->tambah_x($id,$data);
		$this->load->view('modul_v',$data);
	}

	public function hapus($id) {
		$result = $this->dbx->hapusdata('hrm_modul','replid',$id);
		if ($result == TRUE) {
			?><script>
			    window.opener.location.reload();
			    window.close();
			  </script>
			<?php
		}
	}

	public function ubahaktif($id,$aktif) {
		$data=array(
				'aktif' =>$aktif);
		$result = $this->dbx->ubahdata('hrm_modul',$data,'replid',$id);
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


}//end of class
?>
