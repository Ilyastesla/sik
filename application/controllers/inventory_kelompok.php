<?php

session_start(); //we need to start session in order to access it through CI

Class inventory_kelompok extends CI_Controller {

public function __construct() {
	parent::__construct();

		// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');


		// Load session library
		$this->load->library('session');

		// Load database
		$this->load->model('inventory_kelompok_db');

   if( $this->session->userdata('logged_in')) {
       if($this->dbx->checkpage($this->session->userdata('role_id'),'inventory_kelompok')==false){
          redirect('user_authentication');
       }
		}else{
			redirect('user_authentication');;
		}

	}

	public function index()
	{
			$data= $this->inventory_kelompok_db->data();
			$data['form']='Kelompok Barang';
			$data['view']='index';
			$this->load->view('inventory_kelompok_v', $data);
	}

	// TAMBAH
	//-------------------------------------------------------------------------------------------
	public function tambah($id='') {
		$data['form']='Kelompok Barang';
		$data['form_small']='Tambah Data';
		$data['view']='tambah';
		$data['action']='inventory_kelompok/tambah_p';
		$data= $this->inventory_kelompok_db->tambah_x($id,$data);
		$this->load->view('inventory_kelompok_v',$data);
	}

	public function tambah_p($id='') {
	    //"penerima"=> $this->input->post("penerima"),
	    //"tanggalpenerima"=> $this->input->post("tanggalpenerima"),
      $data = array(
        'nama' => $this->input->post('nama')
        ,'keterangan' => $this->input->post('keterangan')
        ,'parent' => $this->input->post('parent')
        ,'idfiskal' => $this->input->post('idfiskal')
        ,'aktif' => $this->input->post('aktif')
        ,'modified_date' =>$this->dbx->cts()
        ,'modified_by' => $this->session->userdata('idpegawai')
  				);
		if ($id<>""){
			$result = $this->dbx->ubahdata('inventory_kelompok',$data,'replid',$id);
		}else{
			$data = $this->p_c->arraymerge(array('created_date' => $this->dbx->cts()), $data);
			$data = $this->p_c->arraymerge(array('created_by' => $this->session->userdata('idpegawai')), $data);
			$id = $this->dbx->tambahdata('inventory_kelompok',$data) ;
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
		$data['form']='Kelompok Barang';
		$data['form_small']='Ubah Data';
		$data['view']='tambah';
		$data['action']='inventory_kelompok/tambah_p/'.$id;
		$data= $this->inventory_kelompok_db->tambah_x($id,$data);
		$this->load->view('inventory_kelompok_v',$data);
	}

	public function hapus($id) {
		$result = $this->dbx->hapusdata('inventory_kelompok','replid',$id) ;
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
