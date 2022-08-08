<?php

session_start(); //we need to start session in order to access it through CI

Class inventory_pembelian extends CI_Controller {

public function __construct() {
	parent::__construct();

		// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');


		// Load session library
		$this->load->library('session');

		// Load database
		$this->load->model('inventory_pembelian_db');

		if( $this->session->userdata('logged_in')) {
			if($this->dbx->checkpage($this->session->userdata('role_id'),'inventory_pembelian')==false){
					redirect('user_authentication');
			}
		}else{
			redirect('user_authentication');;
		}

	}

	public function index()
	{
		$data = $this->inventory_pembelian_db->data();
		$data['form']='Pembelian Barang';
		$data['view']='index';
		$data['action']='inventory_pembelian';
		$this->load->view('inventory_pembelian_v', $data);
	}

	// TAMBAH
	//-------------------------------------------------------------------------------------------
	public function tambah($id='') {
		$data['form']='Pembelian Barang';
		$data['form_small']='Tambah Data';
		$data['view']='tambah';
		$data['action']='inventory_pembelian/tambah_p';
		$data= $this->inventory_pembelian_db->tambah_x($id,$data);
		$this->load->view('inventory_pembelian_v',$data);
	}

	public function tambah_p($id='') {
		//"pemohon"=> $this->session->userdata('idpegawai'),
		$data = array(
				"idpermintaan_barang"=> $this->input->post("idpermintaan_barang"),
				"idcompany"=> $this->input->post("idcompany"),
				"idvendor"=> $this->input->post("idvendor"),
				"tanggalpembelian"=> $this->p_c->tgl_db($this->input->post('tanggalpembelian')),
				"keterangan"=> $this->input->post("keterangan"),
				"status"=> "1",
				"modified_date"=> $this->dbx->cts(),
				"modified_by"=> $this->session->userdata('idpegawai'));
		if ($id<>""){
			$result = $this->inventory_pembelian_db->ubah($data,$id) ;
		}else{
			$kode_transaksi= $this->inventory_pembelian_db->kode_transaksi($this->input->post("idcompany"),$this->p_c->tgl_db($this->input->post('tanggalpembelian')));
			$data = $this->p_c->arraymerge(array('kode_transaksi' => $kode_transaksi), $data);
			$data = $this->p_c->arraymerge(array('created_date' => $this->dbx->cts()), $data);
			$data = $this->p_c->arraymerge(array('created_by' => $this->session->userdata('idpegawai')), $data);
			$id = $this->inventory_pembelian_db->tambah($data);

			if ($id<>""){$result=TRUE;}
		}

		if ($result == TRUE) {
			redirect('inventory_pembelian/material/'.$id);
			//redirect('inventory_pembelian/view/'.$id);
		} else {
			$data['error']='Errorr...';
			$this->ubah($id,$data);
		}
	}

	// UBAH
	//-------------------------------------------------------------------------------------------
	public function ubah($id,$stat='') {
		$data['form']='Pembelian Barang';
		$data['form_small']='Ubah Data';
		$data['view']='tambah';
		$data['action']='inventory_pembelian/tambah_p/'.$id;
		$data= $this->inventory_pembelian_db->tambah_x($id,$data);
		$this->load->view('inventory_pembelian_v',$data);
	}

	//MATERIAL
	//-------------------------------------------------------------------------------------------

	public function material($id,$stat='') {
		$data['form']='Pembelian Barang';
		$data['form_small']='Material';
		$data['view']='material';
		$data['action']='inventory_pembelian/ubahstatus_p/'.$id;
		$data['id']=$id;
		$data['viewview']='0';
		$data= $this->inventory_pembelian_db->view_db($id,$data);
		$this->load->view('inventory_pembelian_v',$data);
	}

	public function tambahmaterial($id,$idx="") {
		$data['form']='Pembelian Barang';
		$data['form_small']='Material';
		$data['view']='tambahmaterial';
		$data['action']='inventory_pembelian/tambahmaterial_p/'.$id.'/'.$idx;
		$data['idx']=$id;
		$data= $this->inventory_pembelian_db->ubahmaterial_x($data,$idx);
		$this->load->view('inventory_pembelian_v',$data);
	}


	public function tambahmaterial_p($idpembelian,$idx='') {
		$data = array(
				"idinventory_pembelian"=>$idpembelian,
				"idmaterial"=> $this->input->post("idmaterial"),
				"jumlah"=> $this->input->post("jumlah"),
				"idunit"=> $this->input->post("idunit"),
				"harga"=> $this->input->post("harga"),
				"hargatambahan"=> $this->input->post("hargatambahan"),
				"hargatotal"=> $this->input->post("hargatotal"),
				"keterangan"=> $this->input->post("keterangan"),
				);
		if ($idx<>""){
			$result = $this->inventory_pembelian_db->ubahmaterial_db($data,$idx) ;
		}else{
			$idx = $this->inventory_pembelian_db->tambahmaterial_db($data);
			if ($idx<>""){$result=TRUE;}
		}
		if ($result == TRUE) {
			$resultstock=$this->dbx->updatestock($this->input->post("idmaterial"),($this->input->post("jumlah")-$this->input->post("jumlah_old")),$this->input->post("idunit"),1);
			if ($resultstock == TRUE) {
				redirect('inventory_pembelian/material/'.$idpembelian);
			} else {
				$data['error']='Errorr...';
				$this->material($idpembelian,$data);
			}
		} else {
			$data['error']='Errorr...';
			$this->ubahmaterial($idpembelian,$idx,$data);
		}
	}

	public function tambahmaterialpermintaan($idpembelian,$idmaterial) {
		$data = array(
				"idinventory_pembelian"=>$idpembelian,
				"idmaterial"=> $idmaterial,
				"jumlah"=> 0
				);
		$id = $this->dbx->tambahdata('inventory_pembelian_mat',$data);
		echo $this->db->last_query();
		if ($id<>""){$result=TRUE;}else{$result=false;}

		if ($result == TRUE) {
				redirect('inventory_pembelian/tambahmaterial/'.$idpembelian.'/'.$id);
		} else {
			$data['error']='Errorr...';
			redirect('inventory_pembelian/material/'.$idpermintaan);
		}
	}

	public function hapusmaterial($id,$idx,$idmaterial,$jumlah,$idunit) {
		$resultstock=$this->dbx->updatestock($idmaterial,$jumlah,$idunit,0);
		if ($resultstock == TRUE) {
			$result = $this->inventory_pembelian_db->hapusmaterial_db($idx) ;
			if ($result == TRUE) {
				redirect('inventory_pembelian/material/'.$id);
			}
		} else {
			$data['error']='Errorr...';
			$this->material($id,$data);
		}

	}

	// LOA
	//-------------------------------------------------------------------------------------------
	public function ubahstatus_p($id,$stat='') {
		$data = array(
				"status"=> "2",
				"modified_date"=> $this->dbx->cts(),
				"modified_by"=> $this->session->userdata('idpegawai'));
		$result = $this->inventory_pembelian_db->ubah($data,$id) ;
		if ($result == TRUE) {
			redirect('inventory_pembelian/view/'.$id);
		} else {
			$data['error']='Errorr...';
			$this->material($id,$data);
		}
	}


	// VIEW
	//-------------------------------------------------------------------------------------------

	public function view($id,$stat='') {
		$data['form']='Pembelian Barang';
		$data['form_small']='Lihat';
		$data['view']='material';
		$data['viewview']='1';
		$data= $this->inventory_pembelian_db->view_db($id,$data);
		if ($data['isi']->status==2){
			$data['action']='inventory_pembelian/release/'.$id;
		}else{
			$data['action']='inventory_pembelian/terima_p/'.$id;
		}
		$this->load->view('inventory_pembelian_v',$data);
	}

	public function hapus($id) {
		$result = $this->inventory_pembelian_db->hapusmaterial2_db($id) ;
		$result = $this->inventory_pembelian_db->hapus_db($id) ;
		if ($result == TRUE) {
			redirect('inventory_pembelian');
		}
	}

	public function inventory_pembelian_print($id) {
		$data['form']='Purchase Order';
		$data['form_small']='';
		$data= $this->inventory_pembelian_db->view_db($id,$data);
		$this->load->view('inventory_pembelian_print_v',$data);
	}

	public function tambahmaterialnew($idx){
		$data = array('last_page'=>"inventory_pembelian/tambahmaterial",
									"last_id"=>$idx);
		$this->session->set_userdata($data);
		redirect('inventory/ubahmaterial');
	}
}//end of class
?>
