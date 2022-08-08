<?php

session_start(); //we need to start session in order to access it through CI

Class ksw_kartusiswaatur extends CI_Controller {

public function __construct() {
parent::__construct();

		// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');


		// Load library
		$this->load->library('session');

		// Load database
		$this->load->model('ksw_kartusiswaatur_db');

		if( $this->session->userdata('logged_in')) {
			if($this->dbx->checkpage($this->session->userdata('role_id'),'ksw_kartusiswaatur')==false){
					redirect('user_authentication');
			}
		}else{
			redirect('user_authentication');;
		}

	}

	public function index()
	{
			$data= $this->ksw_kartusiswaatur_db->data();
			$data['action']='ksw_kartusiswaatur';
			$data['form']='Atur Cetak Kartu';
			$data['view']='index';
			$this->load->view('ksw_kartusiswaatur_v', $data);
	}

	// TAMBAH
	//-------------------------------------------------------------------------------------------
	public function tambah($id='') {
		$data['form']='Atur Cetak Kartu';
		$data['form_small']='Tambah Data';
		$data['view']='tambah';
		$data['action']='ksw_kartusiswaatur/tambah_p';
		$data= $this->ksw_kartusiswaatur_db->tambah_db($id,$data);
		$this->load->view('ksw_kartusiswaatur_v',$data);
	}

	public function tambah_p($id='') {
		$data = array(
										"departemen" => $this->input->post("departemen"),
										"tryout" => $this->input->post("tryout"),
										"tanggal" => $this->p_c->tgl_db($this->input->post("tanggal")),
										"nomorpeserta" => $this->input->post("nomorpeserta"),
										"nisn" => $this->input->post("nisn"),
										"nissistem" => $this->input->post("nissistem"),
										"kelassistem" => $this->input->post("kelassistem"),
										"programsistem" => $this->input->post("programsistem"),
										"ttlsistem" => $this->input->post("ttlsistem"),
                    "fotosistem" => $this->input->post("fotosistem"),
                    "logodepdikbud" => $this->input->post("logodepdikbud"),
                    "ttdsistem" => $this->input->post("ttdsistem"),
                    "keterangan" => $this->input->post("keterangan"),
                    "aktif" => $this->input->post("aktif"),
										"modified_date" => $this->dbx->cts(),
										"modified_by" => $this->session->userdata('idpegawai'),
								);

		if ($id<>""){
			$result = $this->dbx->ubahdata('tryout',$data,'replid',$id) ;
		}else{
			$data = $this->p_c->arraymerge(array('created_date' => $this->dbx->cts()), $data);
			$data = $this->p_c->arraymerge(array('created_by' => $this->session->userdata('idpegawai')), $data);
			$id = $this->dbx->tambahdata('tryout',$data) ;
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
		$data['form']='Atur Cetak Kartu';
		$data['form_small']='Lihat Data';
		$data['view']='view';
		$data= $this->ksw_kartusiswaatur_db->view_db($replid,$data);
		$this->load->view('ksw_kartusiswaatur_v',$data);
	}

	// UBAH
	//-------------------------------------------------------------------------------------------
	public function ubah($id,$stat='') {
		$data['form']='Atur Cetak Kartu';
		$data['form_small']='Ubah Data';
		$data['view']='tambah';
		$data['action']='ksw_kartusiswaatur/tambah_p/'.$id;
		$data= $this->ksw_kartusiswaatur_db->tambah_db($id,$data);
		$this->load->view('ksw_kartusiswaatur_v',$data);
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
		$result = $this->ksw_kartusiswaatur_db->ubah_pdb($data,$id);
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
