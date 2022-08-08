<?php

session_start(); //we need to start session in order to access it through CI

Class ksw_mutasi_jenis extends CI_Controller {

public function __construct() {
	parent::__construct();

		// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');


		// Load session library
		$this->load->library('session');

		// Load database
		$this->load->model('ksw_mutasi_jenis_db');

   if( $this->session->userdata('logged_in')) {
       if($this->dbx->checkpage($this->session->userdata('role_id'),'ksw_mutasi_jenis')==false){
          redirect('user_authentication');
       }
		}else{
			redirect('user_authentication');;
		}

	}

	public function index()
	{
			$data= $this->ksw_mutasi_jenis_db->data();
			$data['form']='Jenis Mutasi';
			$data['view']='index';
			$this->load->view('ksw_mutasi_jenis_v', $data);
	}

	// TAMBAH
	//-------------------------------------------------------------------------------------------
	public function tambah($id='') {
		$data['form']='Jenis Mutasi';
		$data['form_small']='Tambah Data';
		$data['view']='tambah';
		$data['action']='ksw_mutasi_jenis/tambah_p';
		$data= $this->ksw_mutasi_jenis_db->tambah_x($id,$data);
		$this->load->view('ksw_mutasi_jenis_v',$data);
	}

	public function tambah_p($id='') {
	    //"penerima"=> $this->input->post("penerima"),
	    //"tanggalpenerima"=> $this->input->post("tanggalpenerima"),
		$data = array(
				"jenismutasi"=> $this->input->post("jenismutasi"),
				"aktif"=> $this->input->post("aktif"),
				"modified_date"=> $this->dbx->cts(),
				"modified_by"=> $this->session->userdata('idpegawai'));
		if ($id<>""){
			$result = $this->dbx->ubahdata('jenismutasi',$data,'replid',$id);
		}else{
			$data = $this->p_c->arraymerge(array('created_date' => $this->dbx->cts()), $data);
			$data = $this->p_c->arraymerge(array('created_by' => $this->session->userdata('idpegawai')), $data);
			$id = $this->dbx->tambahdata('jenismutasi',$data) ;
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
		$data['form']='Jenis Mutasi';
		$data['form_small']='Ubah Data';
		$data['view']='tambah';
		$data['action']='ksw_mutasi_jenis/tambah_p/'.$id;
		$data= $this->ksw_mutasi_jenis_db->tambah_x($id,$data);
		$this->load->view('ksw_mutasi_jenis_v',$data);
	}

	public function hapus($id) {
		$result = $this->dbx->hapusdata('jenismutasi','replid',$id) ;
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
		$result = $this->dbx->ubahdata('jenismutasi',$data,'replid',$id);
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
