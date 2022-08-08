<?php

session_start(); //we need to start session in order to access it through CI

Class kaskecil extends CI_Controller {

public function __construct() {
	parent::__construct();

		// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');


		// Load session library
		$this->load->library('session');

		// Load database
		$this->load->model('kaskecil_db');

		if( $this->session->userdata('logged_in')) {
			if($this->dbx->checkpage($this->session->userdata('role_id'),'kaskecil')==false){
					redirect('user_authentication');
			}
		}else{
			redirect('user_authentication');;
		}

	}

	public function index()
	{
			$data['show_table'] = $this->kaskecil_db->data();
			$data['form']='Kas Kecil';
			$data['view']='index';
			$this->load->view('kaskecil_v', $data);
	}


	// TAMBAH
	//-------------------------------------------------------------------------------------------
	public function tambah($id='') {
		$data['form']='Kas Kecil';
		$data['form_small']='Tambah Data';
		$data['view']='tambah';
		$data['action']='kaskecil/tambah_p';
		$data= $this->kaskecil_db->tambah_x($id,$data);
		$this->load->view('kaskecil_v',$data);
	}
	public function tambah_p($id='') {
		$data = array(
				"idcompany"=> $this->input->post("idcompany"),
				"pemohon"=> $this->input->post("pemohon"),
				"iddepartemen"=> $this->input->post("iddepartemen"),
				"tanggalpengajuan"=> $this->p_c->tgl_db($this->input->post('tanggalpengajuan')),
				"keterangan"=> $this->input->post("keterangan"),
				"alasan"=> $this->input->post("alasan"),
				"status"=> "1",
				"idppkb"=> $this->input->post("idppkb"),
				"modified_date"=> $this->dbx->cts(),
				"modified_by"=> $this->session->userdata('idpegawai'));
		if ($id<>""){
			$result = $this->kaskecil_db->ubah($data,$id) ;
		}else{
			$kode_transaksi= $this->kaskecil_db->kode_transaksi($this->input->post("idcompany"),$this->p_c->tgl_db($this->input->post('tanggalpengajuan')));
			$data = $this->p_c->arraymerge(array('kode_transaksi' => $kode_transaksi), $data);
			$data = $this->p_c->arraymerge(array('created_date' => $this->dbx->cts()), $data);
			$data = $this->p_c->arraymerge(array('created_by' => $this->session->userdata('idpegawai')), $data);
			$id = $this->kaskecil_db->tambah($data);

			if ($id<>""){$result=TRUE;}
		}

		if ($result == TRUE) {
			redirect('kaskecil/material/'.$id);
			//redirect('kaskecil/view/'.$id);
		} else {
			$data['error']='Errorr...';
			$this->ubah($id,$data);
		}
	}

	// UBAH
	//-------------------------------------------------------------------------------------------
	public function ubah($id,$stat='') {
		$data['form']='Kas Kecil';
		$data['form_small']='Ubah Data';
		$data['view']='tambah';
		$data['action']='kaskecil/tambah_p/'.$id;
		$data= $this->kaskecil_db->tambah_x($id,$data);
		$this->load->view('kaskecil_v',$data);
	}

	public function material($id,$stat='') {
		$data['form']='Kas Kecil';
		$data['form_small']='Material';
		$data['view']='material';
		$data['action']='kaskecil/ubahstatus_p/'.$id;
		$data['id']=$id;
		$data= $this->kaskecil_db->view_db($id,$data);
		$this->load->view('kaskecil_v',$data);
	}
	public function tambahmaterial($id,$idx="",$data="",$stat="") {
		$data['form']='Kas Kecil';
		$data['form_small']='Material';
		$data['view']='tambahmaterial';
		$data['action']='kaskecil/tambahmaterial_p/'.$id.'/'.$idx;
		$data['id']=$id;
		$data['idx']=$idx;
		$data= $this->kaskecil_db->ubahmaterial_x($idx,$data);
		$this->load->view('kaskecil_v',$data);
	}


	public function tambahmaterial_p($id,$idx='') {
		$data = array(
				"idkaskecil"=>$id,
				"idpengeluaran"=> $this->input->post("idpengeluaran"),
				"keperluan"=> $this->input->post("keperluan"),
				"idkredit"=> $this->input->post("idkredit"),
				"iddebit"=> $this->input->post("iddebit"),
				"jumlah"=> $this->input->post("jumlah"));
		if ($idx<>""){
			$result = $this->kaskecil_db->ubahmaterial_db($data,$idx) ;
		}else{
			$idx = $this->kaskecil_db->tambahmaterial_db($data);
			if ($idx<>""){$result=TRUE;}
		}
		if ($result == TRUE) {
			redirect('kaskecil/material/'.$id);
		} else {
			$data['error']='Errorr...';
			$this->ubahmaterial($id,$idx,$data);
		}
	}

	public function hapusmaterial($id,$idx="") {
		$result = $this->kaskecil_db->hapusmaterial_db($idx) ;
		if ($result == TRUE) {
			redirect('kaskecil/material/'.$id);
		}
	}

	public function ubahstatus_p($id,$stat='') {
		$data = array(
				"status"=> "2",
				"jumlah"=> $this->input->post("totmat"),
				"modified_date"=> $this->dbx->cts(),
				"modified_by"=> $this->session->userdata('idpegawai'));
		$result = $this->kaskecil_db->ubah($data,$id) ;
		if ($result == TRUE) {
			redirect('kaskecil/view/'.$id);
		} else {
			$data['error']='Errorr...';
			$this->material($id,$data);
		}
	}


	public function hapus($id) {
		$this->kaskecil_db->adjust_realisasi($id,0);
		$this->kaskecil_db->hapus_data_realisasi($id);
		$result = $this->kaskecil_db->hapusmaterial2_db($id) ;
		$result = $this->kaskecil_db->hapus_db($id) ;
		if ($result == TRUE) {
			redirect('kaskecil');
		}
	}

	public function view($id,$stat='') {
		$data['form']='Kas Kecil';
		$data['form_small']='Lihat';
		$data['view']='view';
		$data= $this->kaskecil_db->view_db($id,$data);
		if ($data['isi']->status==2){
			$data['action']='kaskecil/release/'.$id;
		}else{
			$data['action']='kaskecil/terima_p/'.$id;
		}
		$this->load->view('kaskecil_v',$data);
	}
	public function terima_p($id='') {
		//debit akun di kurangi
		$this->kaskecil_db->adjustment($id,1);
	  	$data = array(
				"penerima"=> $this->input->post("penerima"),
				"tanggalpenerima"=> $this->p_c->tgl_db($this->input->post('tanggalpenerima')),
				"status"=> "11",
				"modified_date"=> $this->dbx->cts(),
				"modified_by"=> $this->session->userdata('idpegawai'));

		$result = $this->kaskecil_db->ubah($data,$id) ;
		if ($result == TRUE) {
			redirect('kaskecil/view/'.$id);
		} else {
			$data['error']='Errorr...';
			$this->ubah($id,$data);
		}
	}
	public function hapusterima_p($id='') {
		$this->kaskecil_db->adjustment($id,0);
		$this->kaskecil_db->hapus_data_realisasi($id);
	  	$data = array(
				"penerima"=> "",
				"tanggalpenerima"=> "0000-00-00 00:00:00",
				"status"=> "2",
				"modified_date"=> $this->dbx->cts(),
				"modified_by"=> $this->session->userdata('idpegawai'));

		$result = $this->kaskecil_db->ubah($data,$id) ;
		if ($result == TRUE) {
			redirect('kaskecil/view/'.$id);
		} else {
			$data['error']='Errorr...';
			$this->ubah($id,$data);
		}
	}

	public function realisasi($id,$stat='') {
		$data['form']='Kas Kecil';
		$data['form_small']='Laporan Pertanggungjawaban Kas Kecil';
		$data['view']='realisasi';
		$data['action']='kaskecil/realisasi_p/'.$id;
		$data['id']=$id;
		$this->kaskecil_db->tambahrealisasi($id);
		$data= $this->kaskecil_db->view_db($id,$data);
		$this->load->view('kaskecil_v',$data);
	}


	public function tambahrealisasi($id,$idx="",$data="",$stat="") {
		$data['form']='Kas Kecil';
		$data['form_small']='Laporan Pertanggungjawaban Kas Kecil';
		$data['view']='tambahrealisasi';
		$data['action']='kaskecil/tambahrealisasi_p/'.$id.'/'.$idx;
		$data['idx']=$id;
		$data= $this->kaskecil_db->ubahrealisasi($idx,$data);
		$this->load->view('kaskecil_v',$data);
	}

	public function tambahrealisasi_p($id,$idx='') {
		$data = array(
				"idkaskecil"=>$id,
				"idpengeluaran"=> $this->input->post("idpengeluaran"),
				"keperluan"=> $this->input->post("keperluan"),
				"idkredit"=> $this->input->post("idkredit"),
				"iddebit"=> $this->input->post("iddebit"),
				"jumlah"=> $this->input->post("jumlah"));

		$result = $this->kaskecil_db->ubahrealisasi_db($data,$idx) ;

		if ($result == TRUE) {
			redirect('kaskecil/realisasi/'.$id);
		} else {
			$data['error']='Errorr...';
			$this->tambahrealisasi($id,$idx,$data);
		}
	}

	public function realisasi_p($id='') {
		$this->kaskecil_db->adjust_realisasi($id,1);
	  	$data = array(
				"tanggalrealisasi"=> $this->p_c->tgl_db($this->input->post('tanggalrealisasi')),
				"status"=> "4",
				"jumlah_realisasi"=> $this->input->post("jumlah_realisasi"),
				"modified_date"=> $this->dbx->cts(),
				"modified_by"=> $this->session->userdata('idpegawai'));

		$result = $this->kaskecil_db->ubah($data,$id) ;
		if ($result == TRUE) {
			redirect('kaskecil/view/'.$id);
		} else {
			$data['error']='Errorr...';
			$this->ubah($id,$data);
		}
	}

	public function hapusrealisasi_p($id='') {
		$this->kaskecil_db->adjust_realisasi($id,0);
		$this->kaskecil_db->hapus_data_realisasi($id);
	  	$data = array(
				"tanggalrealisasi"=> "0000-00-00 00:00:00",
				"status"=> "11",
				"jumlah_realisasi"=>NULL,
				"modified_date"=> $this->dbx->cts(),
				"modified_by"=> $this->session->userdata('idpegawai'));

		$result = $this->kaskecil_db->ubah($data,$id) ;
		if ($result == TRUE) {
			redirect('kaskecil/view/'.$id);
		} else {
			$data['error']='Errorr...';
			$this->ubah($id,$data);
		}
	}

	public function batal($id) {
		$this->kaskecil_db->adjust_realisasi($id,0);
		$this->kaskecil_db->hapus_data_realisasi($id);
		$data = array(
				"status"=> "14",
				"modified_date"=> $this->dbx->cts(),
				"modified_by"=> $this->session->userdata('idpegawai'));
		$result = $this->kaskecil_db->ubah($data,$id) ;
		if ($result == TRUE) {
			redirect('kaskecil/view/'.$id);
		} else {
			$data['error']='Errorr...';
			$this->ubah($id,$data);
		}

	}



	//approval kas kecil
	public function approval()
	{
			$data['show_table']= $this->kaskecil_db->approval_db();
			$data['form']='Kas Kecil';
			$data['view']='index';
			$this->load->view('kaskecil_v', $data);
	}

	public function approve_v($id,$stat='') {
		$data['form']='Kas Kecil';
		$data['form_small']='Approve';
		$data['view']='view';
		$data['appy']='1';
		$data['action']='kaskecil/approve/'.$id;
		$data= $this->kaskecil_db->view_db($id,$data);
		$this->load->view('kaskecil_v',$data);
	}

	public function release($id) {
		$data = array(
				"status"=> "5",
				"approver"=>$this->input->post("approver"),
				"modified_date"=> $this->dbx->cts(),
				"modified_by"=> $this->session->userdata('idpegawai'));
		$result = $this->kaskecil_db->ubah($data,$id) ;
		if ($result == TRUE) {
			redirect('kaskecil');
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
		$result = $this->kaskecil_db->ubah($data,$id) ;
		if ($result == TRUE) {
			redirect('kaskecil/approval');
		} else {
			$data['error']='Errorr...';
			$this->ubah($id,$data);
		}

	}

	public function printkaskecil($id,$stat='') {
		$data['form']='UUDP Kas Kecil';
		$data['form_small']='Uang Untuk Dipertanggungjawabkan Kas Kecil';
		$data['view']='view';
		$data['action']='kaskecil/terima_p/'.$id;
		$data= $this->kaskecil_db->view_db($id,$data);
		$this->load->view('kaskecil_print_v',$data);
	}

	//approval kas kecil
	public function revisi()
	{
			$data['show_table']= $this->kaskecil_db->revisi_db();
			$data['form']='Kas Kecil';
			$data['view']='index';
			$this->load->view('kaskecil_v', $data);
	}

	public function revisi_v($id,$stat='') {
		$data['form']='Kas Kecil';
		$data['form_small']='Revisi';
		$data['view']='view';
		$data['rev']='1';
		$data['action']='kaskecil/revisi_p/'.$id;
		$data= $this->kaskecil_db->view_db($id,$data);
		$this->load->view('kaskecil_v',$data);
	}

	public function revisi_p($id) {
		$data = array(
				"status"=> $this->input->post("submit"),
				"modified_date"=> $this->dbx->cts(),
				"modified_by"=> $this->session->userdata('idpegawai'));
		$result = $this->kaskecil_db->ubah($data,$id) ;
		if ($result == TRUE) {
			redirect('kaskecil/approval');
		} else {
			$data['error']='Errorr...';
			$this->ubah($id,$data);
		}

	}

	//approval kas kecil
	public function history()
	{
			$data['show_table']= $this->kaskecil_db->history_db();
			$data['form']='Kas Kecil';
			$data['view']='index';
			$data['history']='1';
			$this->load->view('kaskecil_v', $data);
	}

	public function history_v($id,$stat='') {
		$data['form']='Kas Kecil';
		$data['form_small']='Revisi';
		$data['view']='view';
		$data['history']='1';
		$data['action']='kaskecil/revisi_p/'.$id;
		$data= $this->kaskecil_db->view_db($id,$data);
		$this->load->view('kaskecil_v',$data);
	}


}//end of class
?>
