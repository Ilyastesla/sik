<?php

session_start(); //we need to start session in order to access it through CI

Class ns_kurikulum extends CI_Controller {

public function __construct() {
parent::__construct();

		// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');


		// Load session library
		$this->load->library('session');

		// Load database
		$this->load->model('ns_kurikulum_db');

   if( $this->session->userdata('logged_in')) {
       if($this->dbx->checkpage($this->session->userdata('role_id'),'ns_kurikulum')==false){
          redirect('user_authentication');
       }
		}else{
			redirect('user_authentication');;
		}

	}

	public function index()
	{
			$data['show_table'] = $this->ns_kurikulum_db->data();
			$data['form']='Kurikulum';
			$data['view']='index';
			$this->load->view('ns_kurikulum_v', $data);
	}

	// TAMBAH
	//-------------------------------------------------------------------------------------------
	public function tambah($id='') {
		$data['form']='Kurikulum';
		$data['form_small']='Tambah Data';
		$data['view']='tambah';
		$data['action']='ns_kurikulum/tambah_p/'.$id;
		$data= $this->ns_kurikulum_db->tambah_db($id,$data);
		$this->load->view('ns_kurikulum_v',$data);
	}

	public function tambah_p($id='') {
		$data = array(
				'kurikulum' => $this->input->post('kurikulum'),
				'kurikulumkode' => $this->input->post('kurikulumkode'),
				'aktif' => $this->input->post('aktif'),
				"modified_date"=> $this->dbx->cts(),
				"modified_by"=> $this->session->userdata('idpegawai'));

		if ($id<>""){
            $result = $this->dbx->ubahdata('ns_kurikulum',$data,'replid',$id);
		}else{
			$data = $this->p_c->arraymerge(array('created_date' => $this->dbx->cts()), $data);
			$data = $this->p_c->arraymerge(array('created_by' => $this->session->userdata('idpegawai')), $data);
			$id = $this->dbx->tambahdata('ns_kurikulum',$data);
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

	//Hapus
	public function hapus($id) {
		$result = $this->dbx->hapusdata('ns_kurikulum','replid',$id);
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
