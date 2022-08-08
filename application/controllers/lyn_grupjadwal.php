<?php

session_start(); //we need to start session in order to access it through CI

Class lyn_grupjadwal extends CI_Controller {

public function __construct() {
parent::__construct();

		// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');


		// Load session library
		$this->load->library('session');

		// Load database
		$this->load->model('lyn_grupjadwal_db');

   if( $this->session->userdata('logged_in')) {
       if($this->dbx->checkpage($this->session->userdata('role_id'),'lyn_grupjadwal')==false){
          redirect('user_authentication');
       }
		}else{
			redirect('user_authentication');;
		}

	}

	public function index()
	{
			$data['show_table'] = $this->lyn_grupjadwal_db->data();
			$data['form']='Grup Jadwal';
			$data['view']='index';
			$this->load->view('lyn_grupjadwal_v', $data);
	}

	// TAMBAH
	//-------------------------------------------------------------------------------------------
	public function tambah($id='') {
		$data['form']='Grup Jadwal';
		$data['form_small']='Tambah Data';
		$data['view']='tambah';
		$data['action']='lyn_grupjadwal/tambah_p';
		$data= $this->lyn_grupjadwal_db->tambah_db($id,$data);
		$this->load->view('lyn_grupjadwal_v',$data);
	}

	public function tambah_p($id='') {
		$data = array(
				"grupjadwal" => $this->input->post("grupjadwal")
                ,"jammulai" => $this->input->post('jammulaihour').":".$this->input->post('jammulaiminute').":00"
                ,"jamselesai" => $this->input->post('jamselesaihour').":".$this->input->post('jamselesaiminute').":00"
				,'aktif' => $this->input->post('aktif')
				,'modified_date' => $this->dbx->cts()
                ,'modified_by' => $this->session->userdata('idpegawai')
				);


		if ($id<>""){
			$result = $this->dbx->ubahdata('lyn_grupjadwal',$data,'replid',$id);
		}else{
			$data = $this->p_c->arraymerge(array('created_date' => $this->dbx->cts()), $data);
			$data = $this->p_c->arraymerge(array('created_by' => $this->session->userdata('idpegawai')), $data);
			$id = $this->dbx->tambahdata('lyn_grupjadwal',$data);
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
		$data['form']='Grup Jadwal';
		$data['form_small']='Ubah Data';
		$data['view']='tambah';
		$data['action']='lyn_grupjadwal/tambah_p/'.$id;
		$data= $this->lyn_grupjadwal_db->tambah_db($id,$data);
		$this->load->view('lyn_grupjadwal_v',$data);
	}

	//Hapus
	public function hapus($id) {
		$result = $this->dbx->hapusdata('lyn_grupjadwal','replid',$id);
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
				$result = $this->dbx->ubahdata('lyn_grupjadwal',$data,'replid',$id);
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
