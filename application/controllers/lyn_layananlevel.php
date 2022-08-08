<?php

session_start(); //we need to start session in order to access it through CI

Class lyn_layananlevel extends CI_Controller {

public function __construct() {
parent::__construct();

		// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');


		// Load session library
		$this->load->library('session');

		// Load database
		$this->load->model('lyn_layananlevel_db');

   if( $this->session->userdata('logged_in')) {
       if($this->dbx->checkpage($this->session->userdata('role_id'),'lyn_layananlevel')==false){
          redirect('user_authentication');
       }
		}else{
			redirect('user_authentication');;
		}

	}

	public function index()
	{
			$data['show_table'] = $this->lyn_layananlevel_db->data();
			$data['form']='Level Layanan';
			$data['view']='index';
			$this->load->view('lyn_layananlevel_v', $data);
	}

	// TAMBAH
	//-------------------------------------------------------------------------------------------
	public function tambah($id='') {
		$data['form']='Level Layanan';
		$data['form_small']='Tambah Data';
		$data['view']='tambah';
		$data['action']='lyn_layananlevel/tambah_p';
		$data= $this->lyn_layananlevel_db->tambah_db($id,$data);
		$this->load->view('lyn_layananlevel_v',$data);
	}

	public function tambah_p($id='') {
		//'persentase' => $this->input->post('persentase'),
		$data = array(
				'idlayanan' => $this->input->post('idlayanan')
				,'layananlevel' => $this->input->post('layananlevel')
				,'aktif' => $this->input->post('aktif')
				,'keterangan' => $this->input->post('keterangan')
				,'modified_date' => $this->dbx->cts()
                ,'modified_by' => $this->session->userdata('idpegawai')
			);

		if ($id<>""){
			$result = $this->dbx->ubahdata('lyn_layananlevel',$data,'replid',$id);
		}else{
			$data = $this->p_c->arraymerge(array('created_date' => $this->dbx->cts()), $data);
			$data = $this->p_c->arraymerge(array('created_by' => $this->session->userdata('idpegawai')), $data);
			$id = $this->dbx->tambahdata('lyn_layananlevel',$data);
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
		$data['form']='Level Layanan';
		$data['form_small']='Ubah Data';
		$data['view']='tambah';
		$data['action']='lyn_layananlevel/tambah_p/'.$id;
		$data= $this->lyn_layananlevel_db->tambah_db($id,$data);
		$this->load->view('lyn_layananlevel_v',$data);
	}

	//Hapus
	public function hapus($id) {
		$result = $this->dbx->hapusdata('lyn_layananlevel','replid',$id);
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
				$result = $this->dbx->ubahdata('lyn_layananlevel',$data,'replid',$id);
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
