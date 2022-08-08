<?php

session_start(); //we need to start session in order to access it through CI

Class ksw_tingkat extends CI_Controller {

public function __construct() {
parent::__construct();

		// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');


		// Load library
		$this->load->library('session');

		// Load database
		$this->load->model('ksw_tingkat_db');

		if( $this->session->userdata('logged_in')) {
			if($this->dbx->checkpage($this->session->userdata('role_id'),'ksw_tingkat')==false){
					redirect('user_authentication');
			}
		}else{
			redirect('user_authentication');;
		}

	}

	public function index()
	{
			$data= $this->ksw_tingkat_db->data();
			$data['action']='ksw_tingkat';
			$data['form']='Tingkat';
			$data['view']='index';
			$this->load->view('ksw_tingkat_v', $data);
	}

	// TAMBAH
	//-------------------------------------------------------------------------------------------
	public function tambah($id='') {
		$data['form']='Tingkat';
		$data['form_small']='Tambah Data';
		$data['view']='tambah';
		$data['action']='ksw_tingkat/tambah_p';
		$data= $this->ksw_tingkat_db->tambah_db($id,$data);
		$this->load->view('ksw_tingkat_v',$data);
	}

	public function tambah_p($id='') {
		$data = array(
										"tingkat"=>$this->input->post("tingkat")
										,"idkesetaraan"=>$this->input->post("idkesetaraan")
										,"departemen"=>$this->input->post("departemen")
										,"aktif"=>$this->input->post("aktif")
										,"keterangan"=>$this->input->post("keterangan")
										,"urutan"=>$this->input->post("urutan")
										,"modified_date"=> $this->dbx->cts()
										,"modified_by"=> $this->session->userdata('idpegawai')
								);

		if ($id<>""){
			$result = $this->ksw_tingkat_db->ubah_pdb($data,$id) ;
		}else{
			$data = $this->p_c->arraymerge(array('created_date' => $this->dbx->cts()), $data);
			$data = $this->p_c->arraymerge(array('created_by' => $this->session->userdata('idpegawai')), $data);
			$id = $this->ksw_tingkat_db->tambah_pdb($data) ;
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

	// UBAH
	//-------------------------------------------------------------------------------------------
	public function ubah($id,$stat='') {
		$data['form']='Tingkat';
		$data['form_small']='Ubah Data';
		$data['view']='tambah';
		$data['action']='ksw_tingkat/tambah_p/'.$id;
		$data= $this->ksw_tingkat_db->tambah_db($id,$data);
		$this->load->view('ksw_tingkat_v',$data);
	}

	// HAPUS
	//-------------------------------------------------------------------------------------------
	public function hapus($id) {
		$result = $this->ksw_tingkat_db->hapus_pdb($id) ;
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
		$result = $this->ksw_tingkat_db->ubah_pdb($data,$id);
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
