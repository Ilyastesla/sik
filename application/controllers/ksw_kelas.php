<?php

session_start(); //we need to start session in order to access it through CI

Class ksw_kelas extends CI_Controller {

public function __construct() {
parent::__construct();

		// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');


		// Load library
		$this->load->library('session');

		// Load database
		$this->load->model('ksw_kelas_db');

		if( $this->session->userdata('logged_in')) {
			if($this->dbx->checkpage($this->session->userdata('role_id'),'ksw_kelas')==false){
					redirect('user_authentication');
			}
		}else{
			redirect('user_authentication');;
		}

	}

	public function index()
	{
			$data= $this->ksw_kelas_db->data();
			$data['action']='ksw_kelas';
			$data['form']='Kelas';
			$data['view']='index';
			$this->load->view('ksw_kelas_v', $data);
	}

	// TAMBAH
	//-------------------------------------------------------------------------------------------
	public function tambah($id='') {
		$data['form']='Kelas';
		$data['form_small']='Tambah Data';
		$data['view']='tambah';
		$data['action']='ksw_kelas/tambah_p';
		$data= $this->ksw_kelas_db->tambah_db($id,$data);
		$this->load->view('ksw_kelas_v',$data);
	}

	public function tambah_p($id='') {
		$data = array(
										"kelas" => $this->input->post("kelas"),
										"idtahunajaran" => $this->input->post("idtahunajaran"),
										"kapasitas" => $this->input->post("kapasitas"),
										"idwali" => $this->input->post("idwali"),
										"aktif" => $this->input->post("aktif"),
										"keterangan" => $this->input->post("keterangan"),
										"idtingkat" => $this->input->post("idtingkat"),
										"kelompok_siswa" => $this->input->post("kelompok_siswa"),
										"jurusan" => $this->input->post("jurusan"),
										"kurikulumkode" => $this->input->post("kurikulumkode"),
										"modified_date" => $this->dbx->cts(),
										"modified_by" => $this->session->userdata('idpegawai'),
								);

		if ($id<>""){
			$result = $this->dbx->ubahdata('kelas',$data,'replid',$id) ;
		}else{
			$data = $this->p_c->arraymerge(array('created_date' => $this->dbx->cts()), $data);
			$data = $this->p_c->arraymerge(array('created_by' => $this->session->userdata('idpegawai')), $data);
			$id = $this->dbx->tambahdata('kelas',$data) ;
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

	// VIEW
	//-------------------------------------------------------------------------------------------
	public function view($replid) {
		$data['form']='Kelas';
		$data['form_small']='Lihat Data';
		$data['view']='view';
		$data= $this->ksw_kelas_db->view_db($replid,$data);
		$this->load->view('ksw_kelas_v',$data);
	}

	// UBAH
	//-------------------------------------------------------------------------------------------
	public function ubah($id,$stat='') {
		$data['form']='Kelas';
		$data['form_small']='Ubah Data';
		$data['view']='tambah';
		$data['action']='ksw_kelas/tambah_p/'.$id;
		$data= $this->ksw_kelas_db->tambah_db($id,$data);
		$this->load->view('ksw_kelas_v',$data);
	}

	// HAPUS
	//-------------------------------------------------------------------------------------------
	public function hapus($id) {
		$result = $this->dbx->hapusdata('kelas','replid',$id) ;
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
		$result = $this->dbx->ubahdata('kelas',$data,'replid',$id) ;
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
