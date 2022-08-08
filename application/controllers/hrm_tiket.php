<?php

session_start(); //we need to start session in order to access it through CI

Class hrm_tiket extends CI_Controller {

public function __construct() {
	parent::__construct();

		// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');


		// Load session library
		$this->load->library('session');

		// Load database
		$this->load->model('hrm_tiket_db');

		if( $this->session->userdata('logged_in')) {
			if($this->dbx->checkpage($this->session->userdata('role_id'),'hrm_tiket')==false){
					redirect('user_authentication');
			}
		}else{
			redirect('user_authentication');;
		}

	}

	public function index()
	{
			$data = $this->hrm_tiket_db->data();
			$data['form']='Tiket';
			$data['view']='index';
			$data['action']='hrm_tiket';
			$this->load->view('hrm_tiket_v', $data);
	}


	// TAMBAH
	//-------------------------------------------------------------------------------------------
	public function tambah($id='') {
		$data['form']='Tiket';
		$data['form_small']='Tambah Data';
		$data['view']='tambah';
		$data['action']='hrm_tiket/tambah_p';
		$data= $this->hrm_tiket_db->tambah_x($id,$data);
		$this->load->view('hrm_tiket_v',$data);
	}

	public function tambah_p($id='') {
		$idperihal=$this->input->post("idperihal");
		if(($idperihal=="0") and ($this->input->post("perihallain"))){
			$idperihal=$this->tambah_perihal_p($this->input->post("perihallain"));
		}
		//"tanggal"=> $this->p_c->tgl_db($this->input->post('tanggal')),
		//"aktif"=> $this->input->post("aktif"),
	 $data = array(
			 	"subjek"=> $this->input->post("subjek"),
				"idperihal"=> $idperihal,
				"deskripsi"=> $this->input->post("deskripsi"),
				"idprioritas"=> $this->input->post("idprioritas"),
				"idruang"=> $this->input->post("idruang"),
				"aktif"=> 1,
				"idtujuan"=>$this->input->post("idtujuan"),
				"tanggal"=> $this->dbx->cts(),
				"idstatus"=> "1",
				"modified_date"=> $this->dbx->cts(),
				"modified_by"=> $this->session->userdata('idpegawai'));
		if ($id<>""){
			$result = $this->dbx->ubahdata("hrm_tiket",$data,"replid",$id) ;
		}else{
			if ($this->input->post("kode_transaksi")<>""){
					$kode_transaksi=$this->input->post("kode_transaksi");
			}else{
				$kode_transaksi= $this->hrm_tiket_db->kode_transaksi();

			}
			//echo $this->db->last_query();die;*
			$data = $this->p_c->arraymerge(array('kode_transaksi' => $kode_transaksi), $data);
			$data = $this->p_c->arraymerge(array('created_date' => $this->dbx->cts()), $data);
			$data = $this->p_c->arraymerge(array('created_by' => $this->session->userdata('idpegawai')), $data);
			$id = $this->dbx->tambahdata("hrm_tiket",$data);
			if ($id<>""){$result=TRUE;}
		}
		//echo $this->db->last_query();die;
		/*
		if ($id<>""){
			$result=$this->dbx->hapusdata('hrm_tiket_tujuan','idtiket',$id);
			foreach ($this->input->post("idpegawai") as $key) {
				$datadbx = array(
		 			 	"idtiket"=> $id,
						"idpegawai"=> $key
					);
				$result=$this->dbx->tambahdata('hrm_tiket_tujuan',$datadbx);
			}
		}
	  */

		if ($result == TRUE) {
			//redirect('hrm_tiket/tujuan/'.$id);
			redirect('hrm_tiket/view/'.$id);
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
		return $this->hrm_tiket_db->tambahperihal($data);
	}

	// UBAH
	//-------------------------------------------------------------------------------------------
	public function ubah($id,$stat='') {
		$data['form']='Tiket';
		$data['form_small']='Ubah Data';
		$data['view']='tambah';
		$data['action']='hrm_tiket/tambah_p/'.$id;
		$data= $this->hrm_tiket_db->tambah_x($id,$data);
		$this->load->view('hrm_tiket_v',$data);
	}

	// ROLE MAP
	//-------------------------------------------------------------------------------------------
	public function tujuan($id='') {
		$data['form']='Tiket';
		$data['form_small']='Tambah Tujuan';
		$data['view']='tujuan';
		$data['action']='hrm_tiket/tambah_tujuan_p/'.$id;
		$data= $this->hrm_tiket_db->tambah_tujuan($id,$data);
		$this->load->view('hrm_tiket_v',$data);
	}

	public function tambah_tujuan_p($id) {
		$idrole=$this->input->post("idrole");
		$result = $this->hrm_tiket_db->hapus_tujuan_p_db($id);
		if ($result == TRUE) {
			foreach((array)$idrole as $row){
				$data = array(
							"hrm_tiket_id"=> $id,
							"idrole"=> $row);

				$result=$this->hrm_tiket_db->tambah_tujuan_p_db($data);
				unset($data);
			}
		}
		if ($result == TRUE) {
			redirect('hrm_tiket/view/'.$id);
		} else {
			$data['error']='Errorr...';
			$this->ubah($id,$data);
		}
	}

	// VIEW
	//-------------------------------------------------------------------------------------------
	public function view($id) {
		$data['form']='Tiket';
		$data['form_small']='View';
		$data['view']='view';
		$data['jawab']=0;
		$data['action']='#';
		$data= $this->hrm_tiket_db->view_db($id,$data);
		$this->load->view('hrm_tiket_v',$data);
	}

	// VIEW
	//-------------------------------------------------------------------------------------------
	public function jawab($id) {
		$data['form']='Tiket';
		$data['form_small']='View';
		$data['view']='view';
		$data['jawab']=1;
		$data['action']='hrm_tiket/jawab_p/'.$id;
		$data= $this->hrm_tiket_db->view_db($id,$data);
		$this->load->view('hrm_tiket_v',$data);
	}

	public function jawab_p($idtiket,$id='') {
	 if($this->input->post("idstatus")<>""){
		 $statusdb=$this->input->post("idstatus");
	 }else{
		 $statusdb=$this->input->post("statuson");
	 }
	 $data = array(
		 		"idtiket"=> $idtiket,
			 	"jawaban"=> $this->input->post("jawaban"),
				"idstatus"=> $statusdb,
				"modified_date"=> $this->dbx->cts(),
				"modified_by"=> $this->session->userdata('idpegawai'));
		if ($id<>""){
			$result = $this->dbx->ubahdata("hrm_tiket_jawab",$data,"replid",$id) ;
		}else{
			if($this->input->post("idserahtugas")<>""){
				$data = $this->p_c->arraymerge(array('idserahtugas' => $this->input->post("idserahtugas")), $data);
				$result = $this->dbx->ubahdata("hrm_tiket",array("idtujuan"=> $this->input->post("idserahtugas"),"modified_date"=> $this->dbx->cts(),"modified_by"=> $this->session->userdata('idpegawai')),"replid",$idtiket) ;
			}
			$data = $this->p_c->arraymerge(array('created_date' => $this->dbx->cts()), $data);
			$data = $this->p_c->arraymerge(array('created_by' => $this->session->userdata('idpegawai')), $data);
			$id = $this->dbx->tambahdata("hrm_tiket_jawab",$data);
			if ($id<>""){$result=TRUE;}
		}

		$result = $this->dbx->ubahdata("hrm_tiket",array("idstatus"=> $statusdb,"modified_date"=> $this->dbx->cts(),"modified_by"=> $this->session->userdata('idpegawai')),"replid",$idtiket) ;

		//echo $this->db->last_query();die;
		if ($result == TRUE) {
			//redirect('hrm_tiket/tujuan/'.$id);
			redirect('hrm_tiket/jawab/'.$idtiket);
		} else {
			redirect('hrm_tiket/jawab/'.$idtiket);
		}
	}

	public function hapus($id) {
		//$result = $this->hrm_tiket_db->hapus_tujuan_p_db($id) ;
		$result = $result = $this->dbx->hapusdata("hrm_tiket","replid",$id) ;
		$result = $result = $this->dbx->hapusdata("hrm_tiket_jawab","idtiket",$id) ;
		if ($result == TRUE) {
			redirect('hrm_tiket');
		}
	}



}//end of class
?>
