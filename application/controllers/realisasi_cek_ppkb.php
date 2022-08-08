<?php

session_start(); //we need to start session in order to access it through CI

Class realisasi_ppkb extends CI_Controller {

public function __construct() {
	parent::__construct();

		// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');


		// Load session library
		$this->load->library('session');

		// Load database
		$this->load->model('realisasi_ppkb_db');

   if( $this->session->userdata('logged_in')) {
       if($this->dbx->checkpage($this->session->userdata('role_id'),'realisasi_ppkb')==false){
          redirect('user_authentication');
       }
		}else{
			redirect('user_authentication');
		}
	}

	public function index()
	{
		$data['show_table'] = $this->realisasi_ppkb_db->data();
		$data['form']='Laporan Pertanggungjawaban PPKB';
		$data['view']='index';
		$this->load->view('realisasi_ppkb_v', $data);
	}

	//VIEW
	//-------------------------------------------------------------------------------------------

	public function view($id,$stat='') {
		$data['form']='Laporan Pertanggungjawaban PPKB';
		$data['form_small']='Persetujuan';
		$data['view']='bayar';
		$data['view2']=1;
		$data['action']='realisasi_ppkb/approve_p/'.$id;
		$data['idx']=$id;
		$data= $this->realisasi_ppkb_db->view_db($id,$data);
		$this->load->view('realisasi_ppkb_v',$data);
	}

	//realisasi_ppkb
	//-------------------------------------------------------------------------------------------
	public function bayar($id,$stat='') {
		$data['form']='Laporan Pertanggungjawaban PPKB';
		$data['form_small']='Ubah';
		$data['view']='bayar';
		$data['view2']=0;
		$data['action']='realisasi_ppkb/bayar_p/'.$id;
		$data['idx']=$id;
		$data= $this->realisasi_ppkb_db->view_db($id,$data);
		$this->load->view('realisasi_ppkb_v',$data);
	}

	//KEPERLUAN
	//-------------------------------------------------------------------------------------------
	public function tambahkeperluan($id,$idx="",$data="",$stat="") {
		$data['form']='Pengajuan Pengeluaran Kas Besar';
		$data['form_small']='Keperluan';
		$data['view']='tambahkeperluan';
		$data['action']='realisasi_ppkb/tambahkeperluan_p/'.$id.'/'.$idx;
		$data['idx']=$id;
		$data= $this->realisasi_ppkb_db->ubahkeperluan_x($idx,$data);
		$this->load->view('realisasi_ppkb_v',$data);
	}

	public function tambahkeperluan_p($id,$idx='') {

		$data = array(
				"idppkb"=>$id,
				"idmaterial_realisasi"=> $this->input->post("idmaterial"),
				"jumlah_realisasi"=> $this->input->post("jumlah"),
				"idunit_realisasi"=> $this->input->post("idunit"),
				"nilai_realisasi"=> $this->input->post("nilai"),
				"idkredit"=> $this->input->post("idkredit"),
				"iddebit"=> $this->input->post("iddebit"),
				"tanggalrealisasi"=> $this->p_c->tgl_db($this->input->post('tanggalrealisasi')),
				"sub_total_realisasi"=> (floatval($this->input->post("jumlah"))*floatval( $this->input->post("nilai")))
				,"realisasi_notes"=> $this->input->post("realisasi_notes")
				);
		if ($idx<>""){
			$result = $this->realisasi_ppkb_db->ubahkeperluan_db($data,$idx) ;
		}else{
			$idx = $this->realisasi_ppkb_db->tambahkeperluan_db($data);
			if ($idx<>""){$result=TRUE;}
		}
		if ($result == TRUE) {
			redirect('realisasi_ppkb/bayar/'.$id);
		} else {
			$data['error']='Errorr...';
			$this->ubahkeperluan($id,$idx,$data);
		}
	}

	//JASA
	//-------------------------------------------------------------------------------------------
	public function tambahjasa($id,$idx="",$data="",$stat="") {
		$data['form']='Pengajuan Pengeluaran Kas Besar';
		$data['form_small']='jasa';
		$data['view']='tambahjasa';
		$data['action']='realisasi_ppkb/tambahjasa_p/'.$id.'/'.$idx;
		$data['idx']=$id;
		$data= $this->realisasi_ppkb_db->ubahjasa_x($idx,$data);
		$this->load->view('realisasi_ppkb_v',$data);
	}

	public function tambahjasa_p($id,$idx='') {

		$data = array(
				"idppkb"=>$id,
				"idjasa_realisasi"=> $this->input->post("idjasa"),
				"jumlah_realisasi"=> $this->input->post("jumlah"),
				"tgl_periode1_realisasi"=> $this->p_c->tgl_db($this->input->post('tgl_periode1')),
				"tgl_periode2_realisasi"=> $this->p_c->tgl_db($this->input->post('tgl_periode2')),
				"idunit_realisasi"=> $this->input->post("idunit"),
				"nilai_realisasi"=> $this->input->post("nilai"),
				"idkredit"=> $this->input->post("idkredit"),
				"iddebit"=> $this->input->post("iddebit"),
				"tanggalrealisasi"=> $this->p_c->tgl_db($this->input->post('tanggalrealisasi')),
				"sub_total_realisasi"=> (floatval($this->input->post("jumlah"))*floatval( $this->input->post("nilai")))
				,"realisasi_notes"=> $this->input->post("realisasi_notes")
				);
		if ($idx<>""){
			$result = $this->realisasi_ppkb_db->ubahjasa_db($data,$idx) ;
		}else{
			$idx = $this->realisasi_ppkb_db->tambahjasa_db($data);
			if ($idx<>""){$result=TRUE;}
		}
		if ($result == TRUE) {
			redirect('realisasi_ppkb/bayar/'.$id);
		} else {
			$data['error']='Errorr...';
			$this->ubahjasa($id,$idx,$data);
		}
	}

	//LAIN
	//-------------------------------------------------------------------------------------------
	public function tambahlain($id,$idx="",$data="",$stat="") {
		$data['form']='Pengajuan Pengeluaran Kas Besar';
		$data['form_small']='lain';
		$data['view']='tambahlain';
		$data['action']='realisasi_ppkb/tambahlain_p/'.$id.'/'.$idx;
		$data['idx']=$id;
		$data= $this->realisasi_ppkb_db->ubahlain_x($idx,$data);
		$this->load->view('realisasi_ppkb_v',$data);
	}

	public function tambahlain_p($id,$idx='') {

		$data = array(
				"idppkb"=>$id,
				"keterangan_realisasi"=> $this->input->post("keterangan"),
				"jumlah_realisasi"=> $this->input->post("jumlah"),
				"idunit_realisasi"=> $this->input->post("idunit"),
				"nilai_realisasi"=> $this->input->post("nilai"),
				"idkredit"=> $this->input->post("idkredit"),
				"iddebit"=> $this->input->post("iddebit"),
				"idadjustment"=> $this->input->post("idadjustment"),
				"tanggalrealisasi"=> $this->p_c->tgl_db($this->input->post('tanggalrealisasi')),
				"sub_total_realisasi"=> (floatval($this->input->post("jumlah"))*floatval( $this->input->post("nilai")))
				,"realisasi_notes"=> $this->input->post("realisasi_notes")
				);
		if ($idx<>""){
			$result = $this->realisasi_ppkb_db->ubahlain_db($data,$idx) ;
		}else{
			$idx = $this->realisasi_ppkb_db->tambahlain_db($data);
			if ($idx<>""){$result=TRUE;}
		}
		if ($result == TRUE) {
			redirect('realisasi_ppkb/bayar/'.$id);
		} else {
			$data['error']='Errorr...';
			$this->ubahlain($id,$idx,$data);
		}
	}

	//REALISASI
	//-------------------------------------------------------------------------------------------
	public function bayar_p($id='') {
		if ($this->input->post("status")==4){
			$this->realisasi_ppkb_db->adjustmentlain($id);
		}
	  	$data = array(
				"status"=> $this->input->post("status"),
				"total_realisasi"=> $this->input->post("total_realisasi"),
				"modified_date"=> $this->dbx->cts(),
				"modified_by"=> $this->session->userdata('idpegawai'));

		$result = $this->realisasi_ppkb_db->ubah($data,$id) ;
		if ($result == TRUE) {
			redirect('realisasi_ppkb/view/'.$id);
		} else {
			$data['error']='Errorr...';
			redirect('/realisasi_ppkb/bayar/'.$id);
		}
	}

}//end of class
?>
