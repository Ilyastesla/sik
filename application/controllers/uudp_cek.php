<?php

session_start(); //we need to start session in order to access it through CI

Class uudp_cek extends CI_Controller {

public function __construct() {
	parent::__construct();

		// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');


		// Load session library
		$this->load->library('session');

		// Load database
		$this->load->model('uudp_cek_db');

   if( $this->session->userdata('logged_in')) {
       if($this->dbx->checkpage($this->session->userdata('role_id'),'uudp_cek')==false){
          redirect('user_authentication');
       }
		}else{
			redirect('user_authentication');
		}
	}

	public function index()
	{
		$data['show_table'] = $this->uudp_cek_db->data();
		$data['form']='Uang Untuk Dipertanggungjawabkan';
		$data['view']='index';
		$this->load->view('uudp_cek_v', $data);
	}

	//VIEW
	//-------------------------------------------------------------------------------------------

	public function view($id,$stat='') {
		$data['form']='uudp_cek Kas Besar';
		$data['form_small']='Persetujuan';
		$data['view']='bayar';
		$data['view2']=1;
		$data['action']='uudp_cek/approve_p/'.$id;
		$data['idx']=$id;
		$data= $this->uudp_cek_db->view_db($id,$data);
		$this->load->view('uudp_cek_v',$data);
	}

	//uudp_cek
	//-------------------------------------------------------------------------------------------
	public function bayar($id,$stat='') {
		$data['form']='uudp_cek Kas Besar';
		$data['form_small']='Pembayaran';
		$data['view']='bayar';
		$data['view2']=0;
		$data['action']='uudp_cek/bayar_p/'.$id;
		$data['idx']=$id;
		$data= $this->uudp_cek_db->view_db($id,$data);
		$this->load->view('uudp_cek_v',$data);
	}

	public function tambahbayar($idcompany,$id,$idx="",$data="") {
		$data['form']='Uang Untuk Dipertanggungjawabkan';
		$data['form_small']='Tambah uudp_cek';
		$data['view']='tambahbayar';
		$data['action']="uudp_cek/tambahbayar_p/".$idcompany."/".$id."/".$idx;
		$data= $this->uudp_cek_db->tambahbayar($id,$idx,$data);
		$this->load->view('uudp_cek_v',$data);
	}

	//TAMBAH BAYAR
	//-------------------------------------------------------------------------------------------
	public function tambahbayar_p($idcompany,$id="",$idx="") {
		$data = array(
				"idppkb_cek"=> $id,
				"penerima"=> $this->input->post('penerima'),
				"idcompany"=> $idcompany,
				"tanggalpenerima"=> $this->p_c->tgl_db($this->input->post('tanggalpenerima')),
				"nilai"=> $this->input->post('nilai'),
				"modified_date"=> $this->dbx->cts(),
				"modified_by"=> $this->session->userdata('idpegawai'));
		if ($idx<>""){
			$result = $this->uudp_cek_db->ubahbayar_db($data,$idx) ;
		}else{
			$kode_transaksi= $this->uudp_cek_db->kode_transaksi($idcompany,$this->p_c->tgl_db($this->input->post('tanggalpenerima')),$id);
			$data = $this->p_c->arraymerge(array('kode_transaksi' => $kode_transaksi), $data);
			$data = $this->p_c->arraymerge(array('created_date' => $this->dbx->cts()), $data);
			$data = $this->p_c->arraymerge(array('created_by' => $this->session->userdata('idpegawai')), $data);

			$idx = $this->uudp_cek_db->tambahbayar_p($data);

			if ($idx<>""){$result=TRUE;}
		}

		if ($result == TRUE) {
			redirect('uudp_cek/bayar/'.$id);
		} else {
			$data['error']='Errorr...';
			$this->tambahbayar($idcompany,$id,$idx,$data);
		}
	}
	//HAPUS
	//-------------------------------------------------------------------------------------------
	public function hapusbayar($id,$idx) {
		$result = $this->uudp_cek_db->hapusbayar_db($idx) ;
		if ($result == TRUE) {
			redirect('/uudp_cek/bayar/'.$id);
		}
	}


	//TERMIN
	//-------------------------------------------------------------------------------------------
	public function bayar_p($id='') {
		if ($this->input->post("sisa_uudp_cek")==0){
			$status=11;
		}else{
			$status=12;
		}
	  	$data = array(
				"status"=> $status,
				"modified_date"=> $this->dbx->cts(),
				"modified_by"=> $this->session->userdata('idpegawai'));

		$result = $this->uudp_cek_db->ubah($data,$id) ;
		if ($result == TRUE) {
			redirect('uudp_cek/view/'.$id);
		} else {
			$data['error']='Errorr...';
			redirect('/uudp_cek/bayar/'.$id);
		}
	}

	public function printuudp_cek($id,$iduudp_cek) {
		$data['form']='uudp_cek Kas Besar';
		$data['form_small']='Uang Untuk Dipertanggungjawabkan Kas Besar';
		$data['view']='view';
		$data['iduudp_cek']=$iduudp_cek;
		$data['action']='uudp_cek/terima_p/'.$id;
		$data= $this->uudp_cek_db->view_db($id,$data);
		$this->load->view('uudp_cek_print_v',$data);
	}

}//end of class
?>
