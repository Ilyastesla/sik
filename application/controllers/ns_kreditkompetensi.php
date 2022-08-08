<?php

session_start(); //we need to start session in order to access it through CI

Class ns_kreditkompetensi extends CI_Controller {

public function __construct() {
parent::__construct();

		// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');


		// Load library
		$this->load->library('session');

		// Load database
		$this->load->model('ns_kreditkompetensi_db');

		if( $this->session->userdata('logged_in')) {
			if($this->dbx->checkpage($this->session->userdata('role_id'),'ns_kreditkompetensi')==false){
					redirect('user_authentication');
			}
		}else{
			redirect('user_authentication');;
		}

	}

	public function index()
	{
			$data= $this->ns_kreditkompetensi_db->data();
			$data['action']='ns_kreditkompetensi';
			$data['form']='Kredit Kompetensi';
			$data['view']='index';
			$this->load->view('ns_kreditkompetensi_v', $data);
	}

	// TAMBAH
	//-------------------------------------------------------------------------------------------
	public function tambah($id='') {
		$data['form']='Kredit Kompetensi';
		$data['form_small']='Tambah/Ubah Data';
		$data['view']='tambah';
		$data['action']='ns_kreditkompetensi/tambah_p/'.$id;
		$data= $this->ns_kreditkompetensi_db->tambah_db($data,$id);
		$this->load->view('ns_kreditkompetensi_v',$data);
	}

	public function tambah_p($id='') {
		$data = array(
										"idmatpel"=>$this->input->post("idmatpel")
										,"idtingkat"=>$this->input->post("idtingkat")
										,"idperiode"=>$this->input->post("idperiode")
										,"jumlahskk"=>$this->input->post("jumlahskk")
										,"aktif"=>1
										,"modified_date"=> $this->dbx->cts()
										,"modified_by"=> $this->session->userdata('idpegawai')
								);

		if ($id<>""){
			$result = $this->dbx->ubahdata('ns_kreditkompetensi',$data,'replid',$id) ;
		}else{
			$data = $this->p_c->arraymerge(array('created_date' => $this->dbx->cts()), $data);
			$data = $this->p_c->arraymerge(array('created_by' => $this->session->userdata('idpegawai')), $data);
			$id = $this->dbx->tambahdata('ns_kreditkompetensi',$data) ;
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

	// HAPUS
	//-------------------------------------------------------------------------------------------
	public function hapus($id) {
		$result = $this->dbx->hapusdata('ns_kreditkompetensi','replid',$id)  ;
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
		$result = $this->dbx->ubahdata('ns_kreditkompetensi',$data,'replid',$id) ;
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
