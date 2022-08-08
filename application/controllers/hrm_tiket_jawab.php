<?php

session_start(); //we need to start session in order to access it through CI

Class hrm_tiket_jawab extends CI_Controller {

public function __construct() {
	parent::__construct();

		// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');


		// Load session library
		$this->load->library('session');

		// Load database
		$this->load->model('hrm_tiket_jawab_db');

		if( $this->session->userdata('logged_in')) {
			if($this->dbx->checkpage($this->session->userdata('role_id'),'hrm_tiket_jawab')==false){
					redirect('user_authentication');
			}
		}else{
			redirect('user_authentication');;
		}

	}

	public function index()
	{
			$data['show_table'] = $this->hrm_tiket_jawab_db->data();
			$data['form']='Tiket Jawab';
			$data['view']='index';
			$this->load->view('hrm_tiket_jawab_v', $data);
	}


	// TAMBAH
	//-------------------------------------------------------------------------------------------
	public function tambah($id='') {
		$data['form']='Tiket Jawab';
		$data['form_small']='Tambah Data';
		$data['view']='tambah';
		$data['action']='hrm_tiket_jawab/tambah_p';
		$data= $this->hrm_tiket_jawab_db->tambah_x($id,$data);
		$this->load->view('hrm_tiket_jawab_v',$data);
	}

	public function tambah_p($id='') {
		$idperihal=$this->input->post("idperihal");
		if(($idperihal=="0") and ($this->input->post("perihallain"))){
			$idperihal=$this->tambah_perihal_p($this->input->post("perihallain"));
		}
	 $data = array(
			 	"subjek"=> $this->input->post("subjek"),
				"idperihal"=> $idperihal,
				"deskripsi"=> $this->input->post("deskripsi"),
				"idprioritas"=> $this->input->post("idprioritas"),
				"idruang"=> $this->input->post("idruang"),
				"aktif"=> $this->input->post("aktif"),
				"pemohon"=> $this->input->post("pemohon"),
				"tanggalpengajuan"=> $this->p_c->tgl_db($this->input->post('tanggalpengajuan')),
				"status"=> "1",
				"modified_date"=> $this->dbx->cts(),
				"modified_by"=> $this->session->userdata('idpegawai'));
		if ($id<>""){
			$result = $this->hrm_tiket_jawab_db->ubah($data,$id) ;
		}else{
			if ($this->input->post("kode_transaksi")<>""){
					$kode_transaksi=$this->input->post("kode_transaksi");
			}else{
				$kode_transaksi= $this->hrm_tiket_jawab_db->kode_transaksi($this->p_c->tgl_db($this->input->post('tanggalpengajuan')));

			}
			$data = $this->p_c->arraymerge(array('kode_transaksi' => $kode_transaksi), $data);
			$data = $this->p_c->arraymerge(array('created_date' => $this->dbx->cts()), $data);
			$data = $this->p_c->arraymerge(array('created_by' => $this->session->userdata('idpegawai')), $data);
			$id = $this->hrm_tiket_jawab_db->tambah($data);
			echo $this->db->last_query();
			die;
			if ($id<>""){$result=TRUE;}
		}

		if ($result == TRUE) {
			//redirect('hrm_tiket_jawab/tujuan/'.$id);
			redirect('hrm_tiket_jawab');
		} else {
			$data['error']='Errorr...';
			$this->ubah($id,$data);
		}
	}


	public function tambah_perihal_p($var) {
		$data = array(
				"perihal"=> $var,
				"aktif"=> 1,
				"type"=>'tiket',
				"created_date"=> $this->dbx->cts(),
				"created_by"=> $this->session->userdata('idpegawai'),
				"modified_date"=> $this->dbx->cts(),
				"modified_by"=> $this->session->userdata('idpegawai')
		);
		return $this->hrm_tiket_jawab_db->tambahperihal($data);
	}

	// UBAH
	//-------------------------------------------------------------------------------------------
	public function ubah($id,$stat='') {
		$data['form']='Tiket Jawab';
		$data['form_small']='Ubah Data';
		$data['view']='tambah';
		$data['action']='hrm_tiket_jawab/tambah_p/'.$id;
		$data= $this->hrm_tiket_jawab_db->tambah_x($id,$data);
		$this->load->view('hrm_tiket_jawab_v',$data);
	}

	// ROLE MAP
	//-------------------------------------------------------------------------------------------
	public function tujuan($id='') {
		$data['form']='Tiket Jawab';
		$data['form_small']='Tambah Tujuan';
		$data['view']='tujuan';
		$data['action']='hrm_tiket_jawab/tambah_tujuan_p/'.$id;
		$data= $this->hrm_tiket_jawab_db->tambah_tujuan($id,$data);
		$this->load->view('hrm_tiket_jawab_v',$data);
	}

	public function tambah_tujuan_p($id) {
		$idrole=$this->input->post("idrole");
		$result = $this->hrm_tiket_jawab_db->hapus_tujuan_p_db($id);
		if ($result == TRUE) {
			foreach((array)$idrole as $row){
				$data = array(
							"hrm_tiket_jawab_id"=> $id,
							"idrole"=> $row);

				$result=$this->hrm_tiket_jawab_db->tambah_tujuan_p_db($data);
				unset($data);
			}
		}
		if ($result == TRUE) {
			redirect('hrm_tiket_jawab/view/'.$id);
		} else {
			$data['error']='Errorr...';
			$this->ubah($id,$data);
		}
	}

	// VIEW
	//-------------------------------------------------------------------------------------------
	public function view($id) {
		$data['form']='Tiket Jawab';
		$data['form_small']='View';
		$data['view']='view';
		$data['action']='#';
		$data= $this->hrm_tiket_jawab_db->tambah_tujuan($id,$data);
		$this->load->view('hrm_tiket_jawab_v',$data);
	}

	public function hapus($id) {
		$result = $this->hrm_tiket_jawab_db->hapus_tujuan_p_db($id) ;
		$result = $this->hrm_tiket_jawab_db->hapus_db($id) ;
		if ($result == TRUE) {
			redirect('hrm_tiket_jawab');
		}
	}



}//end of class
?>
