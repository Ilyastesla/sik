<?php

session_start(); //we need to start session in order to access it through CI

Class inventory_fiskal extends CI_Controller {

public function __construct() {
	parent::__construct();

		// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');


		// Load session library
		$this->load->library('session');

		// Load database
		$this->load->model('inventory_fiskal_db');

   if( $this->session->userdata('logged_in')) {
       if($this->dbx->checkpage($this->session->userdata('role_id'),'inventory_fiskal')==false){
          redirect('user_authentication');
       }
		}else{
			redirect('user_authentication');;
		}

	}

	public function index()
	{
			$data= $this->inventory_fiskal_db->data();
			$data['form']='Kelompok Fiskal';
			$data['view']='index';
			$this->load->view('inventory_fiskal_v', $data);
	}

	// TAMBAH
	//-------------------------------------------------------------------------------------------
	public function tambah($id='') {
		$data['form']='Kelompok Fiskal';
		$data['form_small']='Tambah Data';
		$data['view']='tambah';
		$data['action']='inventory_fiskal/tambah_p';
		$data= $this->inventory_fiskal_db->tambah_x($id,$data);
		$this->load->view('inventory_fiskal_v',$data);
	}

	public function tambah_p($id='') {
    $data = array(
        'kode' => $this->input->post('kode')
        ,'nama' => $this->input->post('nama')
        ,'keterangan' => $this->input->post('keterangan')
        ,'aktif' => $this->input->post('aktif')
        ,'modified_date' =>$this->dbx->cts()
        ,'modified_by' => $this->session->userdata('idpegawai')
        );
		if ($id<>""){
			$result = $this->dbx->ubahdata('inventory_fiskal',$data,'replid',$id);
		}else{
			$data = $this->p_c->arraymerge(array('created_date' => $this->dbx->cts()), $data);
			$data = $this->p_c->arraymerge(array('created_by' => $this->session->userdata('idpegawai')), $data);
			$id = $this->dbx->tambahdata('inventory_fiskal',$data) ;
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
		$data['form']='Kelompok Fiskal';
		$data['form_small']='Ubah Data';
		$data['view']='tambah';
		$data['action']='inventory_fiskal/tambah_p/'.$id;
		$data= $this->inventory_fiskal_db->tambah_x($id,$data);
		$this->load->view('inventory_fiskal_v',$data);
	}

	public function hapus($id) {
		$result = $this->dbx->hapusdata('inventory_fiskal','replid',$id) ;
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
