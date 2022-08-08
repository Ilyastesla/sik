<?php

session_start(); //we need to start session in order to access it through CI

Class lyn_sektor extends CI_Controller {

public function __construct() {
parent::__construct();

		// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');


		// Load session library
		$this->load->library('session');

		// Load database
		$this->load->model('lyn_sektor_db');

   if( $this->session->userdata('logged_in')) {
       if($this->dbx->checkpage($this->session->userdata('role_id'),'lyn_sektor')==false){
          redirect('user_authentication');
       }
		}else{
			redirect('user_authentication');;
		}

	}

	public function index()
	{
			$data['show_table'] = $this->lyn_sektor_db->data();
			$data['form']='Sektor';
			$data['view']='index';
			$this->load->view('lyn_sektor_v', $data);
	}

	// TAMBAH
	//-------------------------------------------------------------------------------------------
	public function tambah($id='') {
		$data['form']='Sektor';
		$data['form_small']='Tambah Data';
		$data['view']='tambah';
		$data['action']='lyn_sektor/tambah_p';
		$data= $this->lyn_sektor_db->tambah_db($id,$data);
		$this->load->view('lyn_sektor_v',$data);
	}

	public function tambah_p($id='') {
		//"urutan" => $this->input->post("urutan"));
		$data = array(
				"sektor" => $this->input->post("sektor")
                ,"keterangan" => $this->input->post("keterangan")
				,'aktif' => $this->input->post('aktif')
                ,'modified_date' => $this->dbx->cts()
                ,'modified_by' => $this->session->userdata('idpegawai')
                );


		if ($id<>""){
			$result = $this->dbx->ubahdata('lyn_sektor',$data,'replid',$id);
		}else{
			$data = $this->p_c->arraymerge(array('created_date' => $this->dbx->cts()), $data);
			$data = $this->p_c->arraymerge(array('created_by' => $this->session->userdata('idpegawai')), $data);
			$id = $this->dbx->tambahdata('lyn_sektor',$data);
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
		$data['form']='Sektor';
		$data['form_small']='Ubah Data';
		$data['view']='tambah';
		$data['action']='lyn_sektor/tambah_p/'.$id;
		$data= $this->lyn_sektor_db->tambah_db($id,$data);
		$this->load->view('lyn_sektor_v',$data);
	}

	//Hapus
	public function hapus($id) {
		$result = $this->dbx->hapusdata('lyn_sektor','replid',$id);
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
				,'modified_date' => $this->dbx->cts()
                ,'modified_by' => $this->session->userdata('idpegawai'));
				$result = $this->dbx->ubahdata('lyn_sektor',$data,'replid',$id);
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
