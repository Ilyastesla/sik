<?php

session_start(); //we need to start session in order to access it through CI

Class inventory_penyerahan extends CI_Controller {

public function __construct() {
	parent::__construct();

		// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');


		// Load session library
		$this->load->library('session');

		// Load database
		$this->load->model('inventory_penyerahan_db');

		if( $this->session->userdata('logged_in')) {
			if($this->dbx->checkpage($this->session->userdata('role_id'),'inventory_penyerahan')==false){
					redirect('user_authentication');
			}
		}else{
			redirect('user_authentication');;
		}

	}

	public function index()
	{
			$data = $this->inventory_penyerahan_db->data();
			$data['form']='Penyerahan Barang';
			$data['view']='index';
			$data['action']='inventory_penyerahan';
			$this->load->view('inventory_penyerahan_v', $data);
	}


	// TAMBAH
	//-------------------------------------------------------------------------------------------
	public function tambah($id='') {
		$data['form']='Header Penyerahan Barang';
		$data['form_small']='Tambah Data';
		$data['view']='tambahheader';
		$data['action']='penyerahan_barang/tambah_p';
		$data= $this->penyerahan_barang_db->tambah_x($id,$data);
		$this->load->view('penyerahan_barang_v',$data);
	}

	// VIEW
	//-------------------------------------------------------------------------------------------

	public function view($id,$edit="",$idpenyerahan="") {
		$data['form']='Penyerahan Barang';
		$data['form_small']='Lihat';
		$data['view']='material';
		$data['edit']=$edit;
		$data['idpenyerahan']=$idpenyerahan;
		$data= $this->inventory_penyerahan_db->view_db($id,$data,$idpenyerahan);
		if($idpenyerahan<>""){
				//$data['action']='inventory_penyerahan/view/'.$id."/1";
				$data['action']='inventory_penyerahan/ubahstatus_p/'.$id;
		}else{
				$data['action']='inventory_penyerahan/ubahstatus_p/'.$id;
		}
		$this->load->view('inventory_penyerahan_v',$data);
	}


	// PENYERAHAN MATERIAL
	//-------------------------------------------------------------------------------------------

	public function penyerahan_material($idpermintaan_mat,$idpenyerahan) {
		$data['form']='Penyerahan Barang';
		$data['form_small']='';
		$data['view']='penyerahan_material';
		$data['idpermintaan_mat']=$idpermintaan_mat;
		$data['idpenyerahan']=$idpenyerahan;
		$data= $this->inventory_penyerahan_db->penyerahan_material($data,$idpermintaan_mat,$idpenyerahan);
		$data['action']='inventory_penyerahan/serah_p/'.$idpermintaan_mat.'/'.$idpenyerahan;
		$this->load->view('inventory_penyerahan_v',$data);
	}

	// SERAH
	//-------------------------------------------------------------------------------------------
	public function serah_p($idpermintaan_mat,$idpenyerahan){
		
		$id=$this->input->post("idpermintaanbarang");
		$idmat=$this->input->post("idmaterial");
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

		$inventaris=$this->input->post("inventaris");

		if ($inventaris){
			for ($i = 1; $i <= $jumlah; $i++) {
				$rows_pembelian = $this->dbx->rows("SELECT * FROM inventory_pembelian a INNER JOIN inventory_pembelian_mat b ON a.replid=b.idinventory_pembelian WHERE b.idmaterial='".$idmat."' AND a.replid='".$this->input->post("idinventory_pembelian")."'");
				$tanggalpembelian=$rows_pembelian->tanggalpembelian;
				//$kode_depan=$kodecabang.'.'.$kodedepartemen.'.'.$idkelompok_inventaris.'.'.$kodefiskal.'.'.str_replace('-','',$tanggalpembelian).'.'.$kodematerial;
				$kode_depan=$kodecabang.'.'.$idkelompok_inventaris.'.'.$kodefiskal.'.'.str_replace('-','',$tanggalpembelian).'.'.$kodematerial;
				$kode_inventaris=$this->inventory_penyerahan_db->kode_inventaris(substr($tanggalserah,0,4),$kode_depan);
				$data = array(
					"idinventory_penyerahan"=> $this->input->post('idinventory_penyerahan'),
					"kode_inventaris"=> $kode_inventaris,
					"idpermintaan_mat"=>$idpermintaan_mat,
					"idpermintaanbarang"=> $id,
					"idmaterial"=> $idmat,
					"tanggalserah"=> $tanggalserah,
					"jml_serah"=> 1,
					"idkondisi"=> 3,
					"idinventory_pembelian"=> $this->input->post("idinventory_pembelian"),
					"hpp"=>( $rows_pembelian->hargatotal/ $rows_pembelian->jumlah),
					"idunit"=> $this->input->post("idunit"),
					"idkelompok_inventaris"=> $idkelompok_inventaris,
					"idruang"=> $idruang,
					"idunit"=> $idunit,
					"idcompany"=> $this->input->post('idcompany'),
					"iddepartemen"=> $this->input->post('iddepartemen'),
					"idpj"=> $this->input->post('idpj'),
					"created_date"=> $this->dbx->cts(),
					"created_by"=> $this->session->userdata('idpegawai'),
					"modified_date"=> $this->dbx->cts(),
					"modified_by"=> $this->session->userdata('idpegawai')
					);
				$result=$this->inventory_penyerahan_db->tambah_inventaris_db($data);
			}
		}else{
			$data = array(
					"idinventory_penyerahan"=> $this->input->post('idinventory_penyerahan'),
					"idpermintaan_mat"=>$idpermintaan_mat,
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
			$result=$this->inventory_penyerahan_db->tambah_inventaris_db($data);

		}
		if ($result == TRUE) {
			//$this->ubahstatus_p($id);
			$this->inventory_penyerahan_db->ubahstatuspermintaan($id);
			$this->inventory_penyerahan_db->ambilstock($idmat,$sisastock);
			redirect('inventory_penyerahan/view/'.$id.'/1/'.$idpenyerahan);
		} else {
			$data['error']='Errorr...';
			redirect('inventory_penyerahan/view/'.$id.'/1/'.$idpenyerahan);
		}
	}

	public function hapusinventaris($id,$idpenyerahan,$idinventaris,$idmat,$sisastock) {
		$result = $this->inventory_penyerahan_db->hapus_inventaris_db($idinventaris) ;
		if ($result == TRUE) {
			$this->inventory_penyerahan_db->ambilstock($idmat,$sisastock);
			$this->inventory_penyerahan_db->ubahstatuspermintaan($id);
			redirect('inventory_penyerahan/view/'.$id.'/1/'.$idpenyerahan);
		}
	}

	public function inventory_penyerahan_print($id,$idpenyerahan,$excel='') {
		$data['form']='Penyerahan Barang';
		$data['form_small']='Lihat';
		$data['edit']=0;
		$data['excel']=$excel;
		$data= $this->inventory_penyerahan_db->view_db($id,$data,$idpenyerahan);
		$this->load->view('inventory_penyerahan_print_v',$data);
	}

	public function inventory_penyerahan_stiker_print($id,$idpenyerahan) {
		$data['form']='Penyerahan Barang';
		$data['form_small']='Lihat';
		$data['edit']=0;
		$data= $this->inventory_penyerahan_db->view_db($id,$data,$idpenyerahan);
		$this->load->view('inventory_penyerahan_stiker_print_v',$data);
	}

	public function material_stiker_print($idinventaris) {
		$data['form']='Penyerahan Barang';
		$data['form_small']='Lihat';
		$data['edit']=0;
		$data= $this->inventory_penyerahan_db->material_stiker_print_db($data,$idinventaris);
		$this->load->view('material_stiker_print_v',$data);
	}

	public function ubahstatus_p($id) {
			$this->inventory_penyerahan_db->ubahstatuspermintaan($id);
			redirect('inventory_penyerahan/view/'.$id.'/0');
	}

	public function tambahpenyerahan($idpermintaan,$idpenyerahan="") {
		$data['form']='Penyerahan Barang';
		$data['form_small']='';
		$data['idpermintaan']=$idpermintaan;
		$data['view']='head_penyerahan_material';
		$data['action']='inventory_penyerahan/tambahheadpenyerahan_p/'.$idpermintaan.'/'.$idpenyerahan;
		$data= $this->inventory_penyerahan_db->head_penyerahan_material($idpermintaan,$idpenyerahan,$data);
		$this->load->view('inventory_penyerahan_v',$data);
		//$idpenyerahan="";
		//redirect('inventory_penyerahan/view/'.$id.'/1/'.$idpenyerahan);
	}

	public function tambahheadpenyerahan_p($idpermintaan,$idpenyerahan=""){
			//"pemohon"=> $this->session->userdata('idpegawai'),
			$data = array(
					"tanggalserah"=> $this->p_c->tgl_db($this->input->post('tanggalserah')),
					"idpjheadpenyerahan"=> $this->input->post("idpjheadpenyerahan"),
					"idstaffgudang"=> $this->input->post("idstaffgudang"),
					"idmanajerumum"=> $this->input->post("idmanajerumum"),
					"status"=> "1",
					"idpermintaan_barang"=> $idpermintaan,
					"idcompany"=> $this->input->post('idcompany'),
					"modified_date"=> $this->dbx->cts(),
					"modified_by"=> $this->session->userdata('idpegawai'));
			if ($idpenyerahan<>""){
				$result = $this->inventory_penyerahan_db->ubahheadpenyerahan_pdb($data,$idpenyerahan) ;
			}else{
				$kode_transaksi= $this->inventory_penyerahan_db->kode_transaksi($this->input->post("idcompany"),$this->p_c->tgl_db($this->input->post('tanggalserah')));
				$data = $this->p_c->arraymerge(array('kode_transaksi' => $kode_transaksi), $data);
				$data = $this->p_c->arraymerge(array('created_date' => $this->dbx->cts()), $data);
				$data = $this->p_c->arraymerge(array('created_by' => $this->session->userdata('idpegawai')), $data);
				$idpenyerahan = $this->inventory_penyerahan_db->tambahheadpenyerahan_pdb($data);
				if ($idpenyerahan<>""){$result=TRUE;}
			}

			if ($result == TRUE) {
				redirect('inventory_penyerahan/view/'.$idpermintaan.'/1/'.$idpenyerahan);
				//redirect('permintaan_barang/view/'.$id);
			} else {
				$data['error']='Errorr...';
				$this->tambahpenyerahan($idpermintaan,$idpenyerahan,$data);
			}
		}

		public function hapusserahhead($idpenerimaan,$id) {
			$result = $this->inventory_penyerahan_db->hapusserahhead_db($id) ;
			if ($result == TRUE) {
				redirect('inventory_penyerahan/view/'.$idpenerimaan.'/1');
			}
		}
}//end of class
?>
