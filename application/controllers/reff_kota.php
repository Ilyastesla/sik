<?php

session_start(); //we need to start session in order to access it through CI

Class reff_kota extends CI_Controller {

public function __construct() {
parent::__construct();

		// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');


		// Load session library
		$this->load->library('session');

		// Load database
		$this->load->model('reff_kota_db');

   if( $this->session->userdata('logged_in')) {
       if($this->dbx->checkpage($this->session->userdata('role_id'),'reff_kota')==false){
          redirect('user_authentication');
       }
		}else{
			redirect('user_authentication');;
		}

	}

	public function index()
	{
			$data = $this->reff_kota_db->data();
			$data['form']='Kota';
			$data['view']='index';
			$data['action']='reff_kota';
			$this->load->view('reff_kota_v', $data);
	}

	// TAMBAH
	//-------------------------------------------------------------------------------------------
	public function tambah($id='') {
		$data['form']='Kota';
		$data['form_small']='Tambah Data';
		$data['view']='tambah';
		$data['action']='reff_kota/tambah_p';
		$data= $this->reff_kota_db->tambah_db($id,$data);
		$this->load->view('reff_kota_v',$data);
	}

	public function tambah_p($id='') {
		//'persentase' => $this->input->post('persentase'),
		$data = array(
			"kota" => $this->input->post("kota")
			,"aktif"=>$this->input->post("aktif")
			,"id_propinsi" => $this->input->post("idpropinsi"));

		if ($id<>""){
			$result = $this->dbx->ubahdata('kota',$data,'replid',$id);
		}else{
			// $data = $this->p_c->arraymerge(array('created_date' => $this->dbx->cts()), $data);
			// $data = $this->p_c->arraymerge(array('created_by' => $this->session->userdata('idpegawai')), $data);
			$id = $this->dbx->tambahdata('kota',$data);
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
		$data['form']='Kota';
		$data['form_small']='Ubah Data';
		$data['view']='tambah';
		$data['action']='reff_kota/tambah_p/'.$id;
		$data= $this->reff_kota_db->tambah_db($id,$data);
		$this->load->view('reff_kota_v',$data);
	}

	//Hapus
	public function hapus($id) {
		$result = $this->dbx->hapusdata('kota','replid',$id);
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
