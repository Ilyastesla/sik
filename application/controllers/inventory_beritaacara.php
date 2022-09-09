<?php

session_start(); //we need to start session in order to access it through CI

Class inventory_beritaacara extends CI_Controller {

public function __construct() {
	parent::__construct();

		// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');


		// Load session library
		$this->load->library('session');

		// Load database
		$this->load->model('inventory_beritaacara_db');

		if( $this->session->userdata('logged_in')) {
			if($this->dbx->checkpage($this->session->userdata('role_id'),'inventory_beritaacara')==false){
					redirect('user_authentication');
			}
		}else{
			redirect('user_authentication');;
		}

	}

	public function index()
	{
			$data = $this->inventory_beritaacara_db->data();
			$data['form']='Berita Acara';
			$data['view']='index';
			$data['action']='inventory_beritaacara';
			$this->load->view('inventory_beritaacara_v', $data);
	}


	// TAMBAH
	//-------------------------------------------------------------------------------------------
	public function tambah($id='') {
		$data['form']='Berita Acara';
		$data['form_small']='Tambah Data';
		$data['view']='tambah';
		$data['action']='inventory_beritaacara/tambah_p';
		$data= $this->inventory_beritaacara_db->tambah_x($id,$data);
		$this->load->view('inventory_beritaacara_v',$data);
	}

	public function tambah_p($id='') {
		$data = array(
				"idcompany"=> $this->input->post("idcompany"),
				"tanggaltransaksi"=> $this->p_c->tgl_db($this->input->post('tanggaltransaksi')),
				"keterangan"=> $this->input->post("keterangan"),
				"idstaffgudang"=> $this->input->post("idstaffgudang"),
				"idmanajerumum"=> $this->input->post("idmanajerumum"),
				"modified_date"=> $this->dbx->cts(),
				"modified_by"=> $this->session->userdata('idpegawai'));
		if ($id<>""){
			$result = $this->dbx->ubahdata('inventory_beritaacara',$data,'replid',$id) ;
		}else{
			$kode_transaksi= $this->inventory_beritaacara_db->kode_transaksi($this->input->post("idcompany"),$this->p_c->tgl_db($this->input->post('tanggaltransaksi')));
			$data = $this->p_c->arraymerge(array('kode_transaksi' => $kode_transaksi), $data);
			$data = $this->p_c->arraymerge(array('created_date' => $this->dbx->cts()), $data);
			$data = $this->p_c->arraymerge(array('created_by' => $this->session->userdata('idpegawai')), $data);
			$id = $this->dbx->tambahdata('inventory_beritaacara',$data);

			if ($id<>""){$result=TRUE;}
		}
		//echo $this->db->last_query();die;
		if ($result == TRUE) {
			redirect('inventory_beritaacara/material/'.$id);
			//redirect('inventory_beritaacara/view/'.$id);
		} else {
			$data['error']='Errorr...';
			$this->ubah($id,$data);
		}
	}

	// UBAH
	//-------------------------------------------------------------------------------------------
	public function ubah($id,$stat='') {
		$data['form']='Berita Acara';
		$data['form_small']='Ubah Data';
		$data['view']='tambah';
		$data['action']='inventory_beritaacara/tambah_p/'.$id;
		$data= $this->inventory_beritaacara_db->tambah_x($id,$data);
		$this->load->view('inventory_beritaacara_v',$data);
	}

	//MATERIAL
	//-------------------------------------------------------------------------------------------

	public function material($id,$stat='') {
		$data['form']='Berita Acara';
		$data['form_small']='Material';
		$data['view']='material';
		$data['action']='inventory_beritaacara/ubahstatus_p/'.$id;
		$data['id']=$id;
		$data= $this->inventory_beritaacara_db->view_db($id,$data);
		$this->load->view('inventory_beritaacara_v',$data);
	}

	public function tambahmaterial($idberita_acara,$id="") {
		$data['form']='Berita Acara';
		$data['form_small']='Material';
		$data['view']='tambahmaterial';
		$data['action']='inventory_beritaacara/tambahmaterial_p/'.$idberita_acara.'/'.$id;
		$data['idberita_acara']=$idberita_acara;
		$data= $this->inventory_beritaacara_db->ubahmaterial_x($data,$idberita_acara,$id);
		$this->load->view('inventory_beritaacara_v',$data);
	}


	public function tambahmaterial_p($idberita_acara,$id='') {
    $data = array(
				"idinventory_beritaacara"=>$idberita_acara,
				"idinventory_penyerahan_barang"=> $this->input->post("idinventory_penyerahan_barang"),
				"iddepartemen"=> $this->input->post("iddepartemen"),
				"idpj"=> $this->input->post("idpj"),
				"idruang"=> $this->input->post("idruang"),
				"idkondisi"=> $this->input->post("idkondisi"),
				"iddepartemen_lama"=> $this->input->post("iddepartemen_lama"),
				"idpj_lama"=> $this->input->post("idpj_lama"),
				"idruang_lama"=> $this->input->post("idruang_lama"),
				"idkondisi_lama"=> $this->input->post("idkondisi_lama"),
				"modified_date"=> $this->dbx->cts(),
				"modified_by"=> $this->session->userdata('idpegawai')
      );

		if ($id<>""){
			$result = $this->dbx->ubahdata('inventory_beritaacara_mat',$data,'replid',$id) ;
		}else{
      $data = $this->p_c->arraymerge(array('created_date' => $this->dbx->cts()), $data);
			$data = $this->p_c->arraymerge(array('created_by' => $this->session->userdata('idpegawai')), $data);

			$id = $this->dbx->tambahdata('inventory_beritaacara_mat',$data);
			if ($id<>""){$result=TRUE;}
		}

		if ($result == true) {
      ?><script>
					window.opener.location.reload();
					window.close();
				</script>
			<?php
		} else {
			$data['error']='Errorr...';

			$this->ubahmaterial($idberita_acara,$id,$data);
		}
	}

	public function hapusmaterial($id) {
		$result = $this->dbx->hapusdata('inventory_beritaacara_mat','replid',$id) ;
		if ($result == TRUE) {
      ?><script>
					window.opener.location.reload();
					window.close();
				</script>
			<?php
		}
	}

	// LOA
	//-------------------------------------------------------------------------------------------
	public function ubahstatus_p($id) {
		$result = $this->inventory_beritaacara_db->ubahinventaris($id) ;
		if ($result == TRUE) {
      ?><script>
					window.opener.location.reload();
					window.close();
				</script>
			<?php
		} else {
			$data['error']='Errorr...';
			$this->material($id,$data);
		}
	}


	// VIEW
	//-------------------------------------------------------------------------------------------

	public function view($id,$stat='') {
		$data['form']='Berita Acara';
		$data['form_small']='Lihat';
		$data['view']='material';
		$data['viewview']='0';
    	$data['action']='#';
		$data= $this->inventory_beritaacara_db->view_db($id,$data);
		$this->load->view('inventory_beritaacara_v',$data);
	}

	public function hapus($id) {
		$result = $this->dbx->hapusdata('inventory_beritaacara_mat','idinventory_beritaacara',$id) ;
		$result = $this->dbx->hapusdata('inventory_beritaacara','replid',$id) ;
		if ($result == TRUE) {
      		?><script>
					window.opener.location.reload();
					window.close();
				</script>
			<?php
		}
	}

	public function printthis($id,$excel="") {
		$data['form']='BERITA ACARA INVENTARIS';
		$data['form_small']='Cetak';
		$data['excel']=$excel;
		$data= $this->inventory_beritaacara_db->view_db($id,$data);
		$this->load->view('inventory_beritaacara_print_v',$data);
	}

}//end of class
?>
