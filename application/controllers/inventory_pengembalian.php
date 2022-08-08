<?php

session_start(); //we need to start session in order to access it through CI

Class inventory_pengembalian extends CI_Controller {

public function __construct() {
	parent::__construct();

		// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');


		// Load session library
		$this->load->library('session');

		// Load database
		$this->load->model('inventory_pengembalian_db');

		if( $this->session->userdata('logged_in')) {
			if($this->dbx->checkpage($this->session->userdata('role_id'),'inventory_pengembalian')==false){
					redirect('user_authentication');
			}
		}else{
			redirect('user_authentication');;
		}

	}

	public function index()
	{
			$data['show_table'] = $this->inventory_pengembalian_db->data();
			$data['form']='Pengembalian Barang';
			$data['view']='index';
			$this->load->view('inventory_pengembalian_v', $data);
	}


	// VIEW
	//-------------------------------------------------------------------------------------------

	public function view($id,$edit="") {
		$data['form']='Pengembalian Barang';
		$data['form_small']='Lihat';
		$data['view']='material';
		$data['edit']=$edit;
		$data= $this->inventory_pengembalian_db->view_db($id,$data);
		$data['action']='inventory_pengembalian/serah_p/'.$id;
		$this->load->view('inventory_pengembalian_v',$data);
	}

	// PENYERAHAN MATERIAL
	//-------------------------------------------------------------------------------------------

	public function penyerahan_material($id,$idmat) {
		$data['form']='Pengembalian Barang';
		$data['form_small']='';
		$data['view']='penyerahan_material';
		$data['id']=$id;
		$data= $this->inventory_pengembalian_db->penyerahan_material($id,$idmat,$data);
		$data['action']='inventory_pengembalian/serah_p/'.$id.'/'.$idmat;
		$this->load->view('inventory_pengembalian_v',$data);
	}

	// SERAH
	//-------------------------------------------------------------------------------------------
	public function serah_p($id,$idmat){
		$kodecabang=$this->input->post("kodecabang");
		$kodedepartemen=$this->input->post("kodedepartemen");
		$idkelompok_inventaris=$this->input->post("idkelompok_inventaris");
		$kodematerial=$this->input->post("kodematerial");

		$kodefiskal=$this->input->post("kodefiskal");
		$jumlah=$this->input->post("jumlah");
		$tanggalserah=$this->p_c->tgl_db($this->input->post('tanggalserah'));
		$idruang=$this->input->post("idruang");
		$idunit=$this->input->post("idunit");
		$sisastock=$this->input->post("stock")-$jumlah;
		echo $this->input->post("atk");
		if (!$atk){
			for ($i = 1; $i <= $jumlah; $i++) {
				$kode_depan=$kodedepartemen.'.'.$kodedepartemen.'.'.$idkelompok_inventaris.'.'.$kodefiskal.'.'.str_replace('-','',$tanggalserah).'.'.$kodematerial;
				$kode_inventaris=$this->inventory_pengembalian_db->kode_inventaris(substr($tanggalserah,0,4),$kode_depan);
				$data = array(
					"kode_inventaris"=> $kode_inventaris,
					"idpermintaanbarang"=> $id,
					"idmaterial"=> $idmat,
					"tanggalserah"=> $tanggalserah,
					"jml_serah"=> 1,
					"idunit"=> $this->input->post("idunit"),
					"idkelompok_inventaris"=> $idkelompok_inventaris,
					"idruang"=> $idruang,
					"idunit"=> $idunit,
					"created_date"=> $this->dbx->cts(),
					"created_by"=> $this->session->userdata('idpegawai'),
					"modified_date"=> $this->dbx->cts(),
					"modified_by"=> $this->session->userdata('idpegawai')
					);
				$result=$this->inventory_pengembalian_db->tambah_inventaris_db($data);

			}
		}else{
			$data = array(
					"idpermintaanbarang"=> $id,
					"idmaterial"=> $idmat,
					"tanggalserah"=> $tanggalserah,
					"jml_serah"=> $jumlah,
					"idunit"=> $this->input->post("idunit"),
					"idkelompok_inventaris"=> $idkelompok_inventaris,
					"idruang"=> $idruang,
					"idunit"=> $idunit,
					"created_date"=> $this->dbx->cts(),
					"created_by"=> $this->session->userdata('idpegawai'),
					"modified_date"=> $this->dbx->cts(),
					"modified_by"=> $this->session->userdata('idpegawai')
					);
			$result=$this->inventory_pengembalian_db->tambah_inventaris_db($data);

		}
		if ($result == TRUE) {
			//$this->ubahstatus_p($id);
			$this->inventory_pengembalian_db->ubahstatuspermintaan($id);
			$this->inventory_pengembalian_db->ambilstock($idmat,$sisastock);
			redirect('inventory_pengembalian/view/'.$id.'/1');
		} else {
			$data['error']='Errorr...';
			redirect('inventory_pengembalian/view/'.$id.'/1');
		}
	}

	public function hapusinventaris($id,$idinventaris,$idmat,$sisastock) {
		$result = $this->inventory_pengembalian_db->hapus_inventaris_db($idinventaris) ;
		if ($result == TRUE) {
			$this->inventory_pengembalian_db->ambilstock($idmat,$sisastock);
			$this->inventory_pengembalian_db->ubahstatuspermintaan($id);
			redirect('inventory_pengembalian/view/'.$id.'/1');
		}
	}
}//end of class
?>
