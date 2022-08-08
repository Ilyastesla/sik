<?php

session_start(); //we need to start session in order to access it through CI

Class ksw_jurusan extends CI_Controller {

public function __construct() {
parent::__construct();

		// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');


		// Load library
		$this->load->library('session');

		// Load database
		$this->load->model('ksw_jurusan_db');

		if( $this->session->userdata('logged_in')) {
			if($this->dbx->checkpage($this->session->userdata('role_id'),'ksw_jurusan')==false){
					redirect('user_authentication');
			}
		}else{
			redirect('user_authentication');;
		}

	}

	public function index()
	{
			$data= $this->ksw_jurusan_db->data();
			$data['action']='ksw_jurusan';
			$data['form']='Jurusan';
			$data['view']='index';
			$this->load->view('ksw_jurusan_v', $data);
	}

	// TAMBAH
	//-------------------------------------------------------------------------------------------
	public function tambah($id='') {
		$data['form']='Jurusan';
		$data['form_small']='Tambah/Ubah Data';
		$data['view']='tambah';
		$data['action']='ksw_jurusan/tambah_p/'.$id;
		$data= $this->ksw_jurusan_db->tambah_db($data,$id);
		$this->load->view('ksw_jurusan_v',$data);
	}

	public function tambah_p($id='') {
		$data = array(
										"jurusan"=>$this->input->post("jurusan")
										,"departemen"=>$this->input->post("departemen")
										,"aktif"=>$this->input->post("aktif")
										,"urutan"=>$this->input->post("urutan")
										,"modified_date"=> $this->dbx->cts()
										,"modified_by"=> $this->session->userdata('idpegawai')
								);

		if ($id<>""){
			$result = $this->dbx->ubahdata('jurusan',$data,'replid',$id) ;
		}else{
			$data = $this->p_c->arraymerge(array('created_date' => $this->dbx->cts()), $data);
			$data = $this->p_c->arraymerge(array('created_by' => $this->session->userdata('idpegawai')), $data);
			$id = $this->dbx->tambahdata('jurusan',$data) ;
			if ($id<>""){$result=TRUE;}
		}

		if ($result == TRUE) {
      ?><script>
					window.opener.location.reload();
					window.close();
				</script>
			<?php
		} else {
			$data['error']="Errorr...";
			$this->ubah($id,$data);
		}
	}

	// HAPUS
	//-------------------------------------------------------------------------------------------
	public function hapus($id) {
		$result = $this->dbx->hapusdata('jurusan','replid',$id)  ;
		if ($result == TRUE) {
      ?><script>
					window.opener.location.reload();
					window.close();
				</script>
			<?php
		}
	}

	public function ubahaktif($id,$aktif=0) {
		$data=array(
				'aktif' =>$aktif
				,"modified_date"=> $this->dbx->cts()
				,"modified_by"=> $this->session->userdata('idpegawai'));
		$result = $this->dbx->ubahdata('jurusan',$data,'replid',$id) ;
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
