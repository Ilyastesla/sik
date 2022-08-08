<?php

session_start(); //we need to start session in order to access it through CI

Class inventory_ruang extends CI_Controller {

public function __construct() {
	parent::__construct();

		// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');


		// Load session library
		$this->load->library('session');

		// Load database
		$this->load->model('inventory_ruang_db');

   if( $this->session->userdata('logged_in')) {
       if($this->dbx->checkpage($this->session->userdata('role_id'),'inventory_ruang')==false){
          redirect('user_authentication');
       }
		}else{
			redirect('user_authentication');;
		}

	}

	public function index()
	{
			$data= $this->inventory_ruang_db->data();
			$data['form']='Ruangan';
			$data['view']='index';
			$this->load->view('inventory_ruang_v', $data);
	}

	// TAMBAH
	//-------------------------------------------------------------------------------------------
	public function tambah($id='') {
		$data['form']='Ruangan';
		$data['form_small']='Tambah Data';
		$data['view']='tambah';
		$data['action']='inventory_ruang/tambah_p/'.$id;
		$data= $this->inventory_ruang_db->tambah_x($id,$data);
		$this->load->view('inventory_ruang_v',$data);
	}

	public function tambah_p($id='') {
	    //"penerima"=> $this->input->post("penerima"),
	    //"tanggalpenerima"=> $this->input->post("tanggalpenerima"),
      $data = array(
  				'nama' => $this->input->post('nama')
  				,'keterangan' => $this->input->post('keterangan')
  				,'parent' => $this->input->post('parent')
  				,'aktif' => $this->input->post('aktif')
  				,'modified_date' =>$this->dbx->cts()
  				,'modified_by' => $this->session->userdata('idpegawai')
  				);
		if ($id<>""){
			$result = $this->dbx->ubahdata('inventory_ruang',$data,'replid',$id);
		}else{
			$data = $this->p_c->arraymerge(array('created_date' => $this->dbx->cts()), $data);
			$data = $this->p_c->arraymerge(array('created_by' => $this->session->userdata('idpegawai')), $data);
			$id = $this->dbx->tambahdata('inventory_ruang',$data) ;
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
		$data['form']='Ruangan';
		$data['form_small']='Ubah Data';
		$data['view']='tambah';
		$data['action']='inventory_ruang/tambah_p/'.$id;
		$data= $this->inventory_ruang_db->tambah_x($id,$data);
		$this->load->view('inventory_ruang_v',$data);
	}

	public function hapus($id) {
		$result = $this->dbx->hapusdata('inventory_ruang','replid',$id) ;
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
