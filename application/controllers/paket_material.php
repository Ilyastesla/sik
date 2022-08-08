<?php

session_start(); //we need to start session in order to access it through CI

Class paket_material extends CI_Controller {

public function __construct() {
	parent::__construct();

		// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');


		// Load session library
		$this->load->library('session');

		// Load database
		$this->load->model('paket_material_db');

   if( $this->session->userdata('logged_in')) {
       if($this->dbx->checkpage($this->session->userdata('role_id'),'paket_material')==false){
          redirect('user_authentication');
       }
		}else{
			redirect('user_authentication');;
		}

	}

	public function index()
	{
			$data['show_table'] = $this->paket_material_db->data();
			$data['form']='Paket Material';
			$data['view']='index';
			$this->load->view('paket_material_v', $data);
	}


	// TAMBAH
	//-------------------------------------------------------------------------------------------
	public function tambah($id='') {
		$data['form']='Paket Material';
		$data['form_small']='Tambah Data';
		$data['view']='tambah';
		$data['action']='paket_material/tambah_p';
		$data= $this->paket_material_db->tambah_x($id,$data);
		$this->load->view('paket_material_v',$data);
	}
	public function tambah_p($id='') {
		$data = array(
				"nama_paket"=> $this->input->post("nama_paket"),
				"keterangan"=> $this->input->post("keterangan"),
				"modified_date"=> $this->dbx->cts(),
				"modified_by"=> $this->session->userdata('idpegawai'));
		if ($id<>""){
			$result = $this->paket_material_db->ubah($data,$id) ;
		}else{
			$data = $this->p_c->arraymerge(array('created_date' => $this->dbx->cts()), $data);
			$data = $this->p_c->arraymerge(array('created_by' => $this->session->userdata('idpegawai')), $data);
			$id = $this->paket_material_db->tambah($data);
			if ($id<>""){$result=TRUE;}
		}

		if ($result == TRUE) {
			redirect('paket_material/material/'.$id);
			//redirect('paket_material/view/'.$id);
		} else {
			$data['error']='Errorr...';
			$this->ubah($id,$data);
		}
	}

	// UBAH
	//-------------------------------------------------------------------------------------------
	public function ubah($id,$stat='') {
		$data['form']='Paket Material';
		$data['form_small']='Ubah Data';
		$data['view']='tambah';
		$data['action']='paket_material/tambah_p/'.$id;
		$data= $this->paket_material_db->tambah_x($id,$data);
		$this->load->view('paket_material_v',$data);
	}

	//MATERIAL
	//-------------------------------------------------------------------------------------------

	public function material($id,$stat='') {
		$data['form']='Paket Material';
		$data['form_small']='Material';
		$data['view']='material';
		$data['action']='paket_material/ubahstatus_p/'.$id;
		$data['id']=$id;
		$data= $this->paket_material_db->view_db($id,$data);
		$this->load->view('paket_material_v',$data);
	}

	public function tambahmaterial($id,$idx="",$data="",$stat="") {
		$data['form']='Paket Material';
		$data['form_small']='Material';
		$data['view']='tambahmaterial';
		$data['action']='paket_material/tambahmaterial_p/'.$id.'/'.$idx;
		$data['idx']=$id;
		$data= $this->paket_material_db->ubahmaterial_x($idx,$data);
		$this->load->view('paket_material_v',$data);
	}


	public function tambahmaterial_p($id,$idx='') {

		$data = array(
				"idpaket_material"=>$id,
				"idmaterial"=> $this->input->post("idmaterial"),
				"jumlah"=> $this->input->post("jumlah"),
				"idunit"=> $this->input->post("idunit")
				);
		if ($idx<>""){
			$result = $this->paket_material_db->ubahmaterial_db($data,$idx) ;
		}else{
			$idx = $this->paket_material_db->tambahmaterial_db($data);
			if ($idx<>""){$result=TRUE;}
		}
		if ($result == TRUE) {
			redirect('paket_material/material/'.$id);
		} else {
			$data['error']='Errorr...';
			$this->ubahmaterial($id,$idx,$data);
		}
	}

	public function hapusmaterial($id,$idx="") {
		$result = $this->paket_material_db->hapusmaterial_db($idx) ;
		if ($result == TRUE) {
			redirect('paket_material/material/'.$id);
		}
	}

	// VIEW
	//-------------------------------------------------------------------------------------------

	public function view($id,$stat='') {
		$data['form']='Paket Material';
		$data['form_small']='Lihat';
		$data['view']='material';
		$data['viewview']='0';
		$data= $this->paket_material_db->view_db($id,$data);
		/*
		if ($data['isi']->status==2){
			$data['action']='paket_material/release/'.$id;
		}else{
			$data['action']='paket_material/terima_p/'.$id;
		}
		*/
		$this->load->view('paket_material_v',$data);
	}




	// LOA
	//-------------------------------------------------------------------------------------------
	public function ubahstatus_p($id,$stat='') {
		/*
		$data = array(
				"status"=> "2",
				"jumlah"=> $this->input->post("totmat"),
				"modified_date"=> $this->dbx->cts(),
				"modified_by"=> $this->session->userdata('idpegawai'));
		$result = $this->paket_material_db->ubah($data,$id) ;
		if ($result == TRUE) {
		*/
			redirect('paket_material/view/'.$id);
		/*
		} else {
			$data['error']='Errorr...';
			$this->material($id,$data);
		}
		*/
	}


	public function terima_p($id='') {
		//debit akun di kurangi
		$this->paket_material_db->adjustment($id,1);
	  	$data = array(
				"penerima"=> $this->input->post("penerima"),
				"tanggalpenerima"=> $this->p_c->tgl_db($this->input->post('tanggalpenerima')),
				"status"=> "11",
				"modified_date"=> $this->dbx->cts(),
				"modified_by"=> $this->session->userdata('idpegawai'));

		$result = $this->paket_material_db->ubah($data,$id) ;
		if ($result == TRUE) {
			redirect('paket_material/view/'.$id);
		} else {
			$data['error']='Errorr...';
			$this->ubah($id,$data);
		}
	}


	public function hapus($id) {
		$this->paket_material_db->adjust_realisasi($id,0);
		$this->paket_material_db->hapus_data_realisasi($id);
		$result = $this->paket_material_db->hapusmaterial2_db($id) ;
		$result = $this->paket_material_db->hapus_db($id) ;
		if ($result == TRUE) {
			redirect('paket_material');
		}
	}



	public function hapusterima_p($id='') {
		$this->paket_material_db->adjustment($id,0);
		$this->paket_material_db->hapus_data_realisasi($id);
	  	$data = array(
				"penerima"=> "",
				"tanggalpenerima"=> "0000-00-00 00:00:00",
				"status"=> "2",
				"modified_date"=> $this->dbx->cts(),
				"modified_by"=> $this->session->userdata('idpegawai'));

		$result = $this->paket_material_db->ubah($data,$id) ;
		if ($result == TRUE) {
			redirect('paket_material/view/'.$id);
		} else {
			$data['error']='Errorr...';
			$this->ubah($id,$data);
		}
	}

	public function realisasi($id,$stat='') {
		$data['form']='Paket Material';
		$data['form_small']='Laporan Pertanggungjawaban Paket Material';
		$data['view']='realisasi';
		$data['action']='paket_material/realisasi_p/'.$id;
		$data['id']=$id;
		$this->paket_material_db->tambahrealisasi($id);
		$data= $this->paket_material_db->view_db($id,$data);
		$this->load->view('paket_material_v',$data);
	}


	public function tambahrealisasi($id,$idx="",$data="",$stat="") {
		$data['form']='Paket Material';
		$data['form_small']='Laporan Pertanggungjawaban Paket Material';
		$data['view']='tambahrealisasi';
		$data['action']='paket_material/tambahrealisasi_p/'.$id.'/'.$idx;
		$data['idx']=$id;
		$data= $this->paket_material_db->ubahrealisasi($idx,$data);
		$this->load->view('paket_material_v',$data);
	}

	public function tambahrealisasi_p($id,$idx='') {
		$data = array(
				"idpaket_material"=>$id,
				"idpengeluaran"=> $this->input->post("idpengeluaran"),
				"keperluan"=> $this->input->post("keperluan"),
				"idkredit"=> $this->input->post("idkredit"),
				"iddebit"=> $this->input->post("iddebit"),
				"jumlah"=> $this->input->post("jumlah"));

		$result = $this->paket_material_db->ubahrealisasi_db($data,$idx) ;

		if ($result == TRUE) {
			redirect('paket_material/realisasi/'.$id);
		} else {
			$data['error']='Errorr...';
			$this->tambahrealisasi($id,$idx,$data);
		}
	}

	public function realisasi_p($id='') {
		$this->paket_material_db->adjust_realisasi($id,1);
	  	$data = array(
				"tanggalrealisasi"=> $this->p_c->tgl_db($this->input->post('tanggalrealisasi')),
				"status"=> "4",
				"jumlah_realisasi"=> $this->input->post("jumlah_realisasi"),
				"modified_date"=> $this->dbx->cts(),
				"modified_by"=> $this->session->userdata('idpegawai'));

		$result = $this->paket_material_db->ubah($data,$id) ;
		if ($result == TRUE) {
			redirect('paket_material/view/'.$id);
		} else {
			$data['error']='Errorr...';
			$this->ubah($id,$data);
		}
	}

	public function hapusrealisasi_p($id='') {
		$this->paket_material_db->adjust_realisasi($id,0);
		$this->paket_material_db->hapus_data_realisasi($id);
	  	$data = array(
				"tanggalrealisasi"=> "0000-00-00 00:00:00",
				"status"=> "11",
				"jumlah_realisasi"=>NULL,
				"modified_date"=> $this->dbx->cts(),
				"modified_by"=> $this->session->userdata('idpegawai'));

		$result = $this->paket_material_db->ubah($data,$id) ;
		if ($result == TRUE) {
			redirect('paket_material/view/'.$id);
		} else {
			$data['error']='Errorr...';
			$this->ubah($id,$data);
		}
	}

	public function batal($id) {
		$this->paket_material_db->adjust_realisasi($id,0);
		$this->paket_material_db->hapus_data_realisasi($id);
		$data = array(
				"status"=> "14",
				"modified_date"=> $this->dbx->cts(),
				"modified_by"=> $this->session->userdata('idpegawai'));
		$result = $this->paket_material_db->ubah($data,$id) ;
		if ($result == TRUE) {
			redirect('paket_material/view/'.$id);
		} else {
			$data['error']='Errorr...';
			$this->ubah($id,$data);
		}

	}



	//approval Paket Material
	public function approval()
	{
			$data['show_table']= $this->paket_material_db->approval_db();
			$data['form']='Paket Material';
			$data['view']='index';
			$this->load->view('paket_material_v', $data);
	}

	public function approve_v($id,$stat='') {
		$data['form']='Paket Material';
		$data['form_small']='Approve';
		$data['view']='view';
		$data['appy']='1';
		$data['action']='paket_material/approve/'.$id;
		$data= $this->paket_material_db->view_db($id,$data);
		$this->load->view('paket_material_v',$data);
	}

	public function release($id) {
		$data = array(
				"status"=> "5",
				"approver"=>$this->input->post("approver"),
				"modified_date"=> $this->dbx->cts(),
				"modified_by"=> $this->session->userdata('idpegawai'));
		$result = $this->paket_material_db->ubah($data,$id) ;
		if ($result == TRUE) {
			redirect('paket_material');
		} else {
			$data['error']='Errorr...';
			$this->ubah($id,$data);
		}

	}

	public function approve($id) {
		$data = array(
				"keterangan_approval"=> $this->input->post("keterangan_approval"),
				"status"=> $this->input->post("submit"),
				"approve_by"=>$this->session->userdata('idpegawai'),
				"approve_date"=> $this->dbx->cts(),
				"modified_date"=> $this->dbx->cts(),
				"modified_by"=> $this->session->userdata('idpegawai'));
		$result = $this->paket_material_db->ubah($data,$id) ;
		if ($result == TRUE) {
			redirect('paket_material/approval');
		} else {
			$data['error']='Errorr...';
			$this->ubah($id,$data);
		}

	}

	public function printpaket_material($id,$stat='') {
		$data['form']='UUDP Paket Material';
		$data['form_small']='Uang Untuk Dipertanggungjawabkan Paket Material';
		$data['view']='view';
		$data['action']='paket_material/terima_p/'.$id;
		$data= $this->paket_material_db->view_db($id,$data);
		$this->load->view('paket_material_print_v',$data);
	}

	//approval Paket Material
	public function revisi()
	{
			$data['show_table']= $this->paket_material_db->revisi_db();
			$data['form']='Paket Material';
			$data['view']='index';
			$this->load->view('paket_material_v', $data);
	}

	public function revisi_v($id,$stat='') {
		$data['form']='Paket Material';
		$data['form_small']='Revisi';
		$data['view']='view';
		$data['rev']='1';
		$data['action']='paket_material/revisi_p/'.$id;
		$data= $this->paket_material_db->view_db($id,$data);
		$this->load->view('paket_material_v',$data);
	}

	public function revisi_p($id) {
		$data = array(
				"status"=> $this->input->post("submit"),
				"modified_date"=> $this->dbx->cts(),
				"modified_by"=> $this->session->userdata('idpegawai'));
		$result = $this->paket_material_db->ubah($data,$id) ;
		if ($result == TRUE) {
			redirect('paket_material/approval');
		} else {
			$data['error']='Errorr...';
			$this->ubah($id,$data);
		}

	}

	//approval Paket Material
	public function history()
	{
			$data['show_table']= $this->paket_material_db->history_db();
			$data['form']='Paket Material';
			$data['view']='index';
			$data['history']='1';
			$this->load->view('paket_material_v', $data);
	}

	public function history_v($id,$stat='') {
		$data['form']='Paket Material';
		$data['form_small']='Revisi';
		$data['view']='view';
		$data['history']='1';
		$data['action']='paket_material/revisi_p/'.$id;
		$data= $this->paket_material_db->view_db($id,$data);
		$this->load->view('paket_material_v',$data);
	}


}//end of class
?>
