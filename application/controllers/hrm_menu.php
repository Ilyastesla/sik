<?php

session_start(); //we need to start session in order to access it through CI

Class hrm_menu extends CI_Controller {

public function __construct() {
	parent::__construct();

		// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');


		// Load session library
		$this->load->library('session');

		// Load database
		$this->load->model('hrm_menu_db');

		if( $this->session->userdata('logged_in')) {
			if($this->dbx->checkpage($this->session->userdata('role_id'),'hrm_menu')==false){
					redirect('user_authentication');
			}
		}else{
			redirect('user_authentication');;
		}

	}

	public function index()
	{
			$data = $this->hrm_menu_db->data();
			$data['form']='Menu';
			$data['view']='index';
			$data['action']='hrm_menu';
			$this->load->view('hrm_menu_v', $data);
	}


	// TAMBAH
	//-------------------------------------------------------------------------------------------
	public function tambah($id='') {
		$data['form']='Menu';
		$data['form_small']='Tambah Data';
		$data['view']='tambah';
		$data['action']='hrm_menu/tambah_p';
		$data= $this->hrm_menu_db->tambah_x($id,$data);
		$this->load->view('hrm_menu_v',$data);
	}

	public function tambah_p($id='') {
	   $data = array(
				"nama"=> $this->input->post("nama"),
				"modul_id"=> $this->input->post("modul_id"),
				"pages"=> $this->input->post("pages"),
				"keterangan"=> $this->input->post("keterangan"),
				"no_urut"=> $this->input->post("no_urut"),
				"aktif"=> $this->input->post("aktif"),
				"modified_date"=> $this->dbx->cts(),
				"modified_by"=> $this->session->userdata('idpegawai'));
		if ($id<>""){
			$result = $this->dbx->ubahdata('hrm_menu',$data,'replid',$id);
		}else{
			$data = $this->p_c->arraymerge(array('created_date' => $this->dbx->cts()), $data);
			$data = $this->p_c->arraymerge(array('created_by' => $this->session->userdata('idpegawai')), $data);
			$id = $this->dbx->tambahdata('hrm_menu',$data);
			if ($id<>""){$result=TRUE;}
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
		$data['form']='Menu';
		$data['form_small']='Ubah Data';
		$data['view']='tambah';
		$data['action']='hrm_menu/tambah_p/'.$id;
		$data= $this->hrm_menu_db->tambah_x($id,$data);
		$this->load->view('hrm_menu_v',$data);
	}

	public function ubahaktif($id,$aktif=0) {
		$data=array(
				'aktif' =>$aktif
				,"modified_date"=> $this->dbx->cts()
				,"modified_by"=> $this->session->userdata('idpegawai'));
		$result = $this->dbx->ubahdata('hrm_menu',$data,'replid',$id);
		
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

	public function hapus($id) {
		$result = $this->dbx->hapusdata('hrm_menu','replid',$id);
		if ($result == TRUE) {
			?><script>
					window.opener.location.reload();
					window.close();
				</script>
			<?php
		}
	}


}//end of class
?>
