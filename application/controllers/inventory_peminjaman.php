<?php

session_start(); //we need to start session in order to access it through CI

Class inventory_peminjaman extends CI_Controller {

public function __construct() {
	parent::__construct();

		// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');


		// Load session library
		$this->load->library('session');

		// Load database
		$this->load->model('inventory_peminjaman_db');

		if( $this->session->userdata('logged_in')) {
			if($this->dbx->checkpage($this->session->userdata('role_id'),'inventory_peminjaman')==false){
					redirect('user_authentication');
			}
		}else{
			redirect('user_authentication');;
		}

	}

	public function index()
	{
			$data['show_table'] = $this->inventory_peminjaman_db->data();
			$data['form']='Peminjaman Barang';
			$data['view']='index';
			$this->load->view('inventory_peminjaman_v', $data);
	}


	// TAMBAH
	//-------------------------------------------------------------------------------------------
	public function tambah($id='') {
		$data['form']='Peminjaman Barang';
		$data['form_small']='Tambah Data';
		$data['view']='tambah';
		$data['action']='inventory_peminjaman/tambah_p';
		$data= $this->inventory_peminjaman_db->tambah_x($id,$data);
		$this->load->view('inventory_peminjaman_v',$data);
	}
	public function tambah_p($id='') {
		$data = array(
				"idcompany"=> $this->input->post("idcompany"),
				"pemohon"=> $this->session->userdata('idpegawai'),
				"iddepartemen"=> $this->input->post("iddepartemen"),
				"tanggalpengajuan"=> $this->p_c->tgl_db($this->input->post('tanggalpengajuan')),
				"keterangan"=> $this->input->post("keterangan"),
				"status"=> "1",
				"modified_date"=> $this->dbx->cts(),
				"modified_by"=> $this->session->userdata('idpegawai'));
		if ($id<>""){
			$result = $this->inventory_peminjaman_db->ubah($data,$id) ;
		}else{
			$kode_transaksi= $this->inventory_peminjaman_db->kode_transaksi($this->input->post("idcompany"),$this->p_c->tgl_db($this->input->post('tanggalpengajuan')));
			$data = $this->p_c->arraymerge(array('kode_transaksi' => $kode_transaksi), $data);
			$data = $this->p_c->arraymerge(array('created_date' => $this->dbx->cts()), $data);
			$data = $this->p_c->arraymerge(array('created_by' => $this->session->userdata('idpegawai')), $data);
			$id = $this->inventory_peminjaman_db->tambah($data);

			if ($id<>""){$result=TRUE;}
		}

		if ($result == TRUE) {
			redirect('inventory_peminjaman/material/'.$id);
			//redirect('inventory_peminjaman/view/'.$id);
		} else {
			$data['error']='Errorr...';
			$this->ubah($id,$data);
		}
	}

	// UBAH
	//-------------------------------------------------------------------------------------------
	public function ubah($id,$stat='') {
		$data['form']='Peminjaman Barang';
		$data['form_small']='Ubah Data';
		$data['view']='tambah';
		$data['action']='inventory_peminjaman/tambah_p/'.$id;
		$data= $this->inventory_peminjaman_db->tambah_x($id,$data);
		$this->load->view('inventory_peminjaman_v',$data);
	}

	//MATERIAL
	//-------------------------------------------------------------------------------------------

	public function material($id,$stat='') {
		$data['form']='Peminjaman Barang';
		$data['form_small']='Material';
		$data['view']='material';
		$data['action']='inventory_peminjaman/ubahstatus_p/'.$id;
		$data['id']=$id;
		$data= $this->inventory_peminjaman_db->view_db($id,$data);
		$this->load->view('inventory_peminjaman_v',$data);
	}

	public function tambahmaterial($id,$idx="",$data="",$stat="") {
		$data['form']='Peminjaman Barang';
		$data['form_small']='Material';
		$data['view']='tambahmaterial';
		$data['action']='inventory_peminjaman/tambahmaterial_p/'.$id.'/'.$idx;
		$data['idx']=$id;
		$data= $this->inventory_peminjaman_db->ubahmaterial_x($idx,$data);
		$this->load->view('inventory_peminjaman_v',$data);
	}


	public function tambahmaterial_p($id,$idx='') {

		$data = array(
				"idinventory_peminjaman"=>$id,
				"idmaterial"=> $this->input->post("idmaterial"),
				"jumlah"=> $this->input->post("jumlah"),
				"idunit"=> $this->input->post("idunit"),
				);
		if ($idx<>""){
			$result = $this->inventory_peminjaman_db->ubahmaterial_db($data,$idx) ;
		}else{
			$idx = $this->inventory_peminjaman_db->tambahmaterial_db($data);
			if ($idx<>""){$result=TRUE;}
		}
		if ($result == TRUE) {
			redirect('inventory_peminjaman/material/'.$id);
		} else {
			$data['error']='Errorr...';
			$this->ubahmaterial($id,$idx,$data);
		}
	}

	public function hapusmaterial($id,$idx="") {
		$result = $this->inventory_peminjaman_db->hapusmaterial_db($idx) ;
		if ($result == TRUE) {
			redirect('inventory_peminjaman/material/'.$id);
		}
	}

	// LOA
	//-------------------------------------------------------------------------------------------
	public function ubahstatus_p($id,$stat='') {
		$data = array(
				"status"=> "2",
				"modified_date"=> $this->dbx->cts(),
				"modified_by"=> $this->session->userdata('idpegawai'));
		$result = $this->inventory_peminjaman_db->ubah($data,$id) ;
		if ($result == TRUE) {
			redirect('inventory_peminjaman/view/'.$id);
		} else {
			$data['error']='Errorr...';
			$this->material($id,$data);
		}
	}


	// VIEW
	//-------------------------------------------------------------------------------------------

	public function view($id,$stat='') {
		$data['form']='Peminjaman Barang';
		$data['form_small']='Lihat';
		$data['view']='material';
		$data['viewview']='0';
		$data= $this->inventory_peminjaman_db->view_db($id,$data);
		if ($data['isi']->status==2){
			$data['action']='inventory_peminjaman/release/'.$id;
		}else{
			$data['action']='inventory_peminjaman/terima_p/'.$id;
		}
		$this->load->view('inventory_peminjaman_v',$data);
	}

	public function hapus($id) {
		$result = $this->inventory_peminjaman_db->hapusmaterial2_db($id) ;
		$result = $this->inventory_peminjaman_db->hapus_db($id) ;
		if ($result == TRUE) {
			redirect('inventory_peminjaman');
		}
	}

	public function printinventory_peminjaman($id,$stat='') {
		$data['form']='UUDP Peminjaman Barang';
		$data['form_small']='Uang Untuk Dipertanggungjawabkan Peminjaman Barang';
		$data['view']='view';
		$data['action']='inventory_peminjaman/terima_p/'.$id;
		$data= $this->inventory_peminjaman_db->view_db($id,$data);
		$this->load->view('inventory_peminjaman_print_v',$data);
	}
}//end of class
?>
