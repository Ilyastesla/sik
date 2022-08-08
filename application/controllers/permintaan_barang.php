<?php

session_start(); //we need to start session in order to access it through CI

Class permintaan_barang extends CI_Controller {

public function __construct() {
	parent::__construct();

		// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');


		// Load session library
		$this->load->library('session');

		// Load database
		$this->load->model('permintaan_barang_db');

   if( $this->session->userdata('logged_in')) {
       if($this->dbx->checkpage($this->session->userdata('role_id'),'permintaan_barang')==false){
          redirect('user_authentication');
       }
		}else{
			redirect('user_authentication');;
		}

	}

	public function index()
	{
			$data = $this->permintaan_barang_db->data();
			$data['form']='Permintaan Barang';
			$data['view']='index';
			$data['action']='permintaan_barang';
			$this->load->view('permintaan_barang_v', $data);
	}
	// TAMBAH
	//-------------------------------------------------------------------------------------------
	public function tambah($id='') {
		$data['form']='Permintaan Barang';
		$data['form_small']='Tambah Data';
		$data['view']='tambah';
		$data['action']='permintaan_barang/tambah_p/'.$id;
		$data= $this->permintaan_barang_db->tambah_x($id,$data);
		$this->load->view('permintaan_barang_v',$data);
	}

	public function tambah_p($id='') {
		//"pemohon"=> $this->session->userdata('idpegawai'),
		//"pemohon"=> $this->input->post("pemohon"),
		$data = array(
				"kode_ppkb"=> $this->input->post("kode_ppkb"),
				"idcompany"=> $this->input->post("idcompany"),
				"pemohon"=> $this->session->userdata('idpegawai'),
				"iddepartemen"=> $this->input->post("iddepartemen"),
				"tanggalpengajuan"=> $this->p_c->tgl_db($this->input->post('tanggalpengajuan')),
				"keterangan"=> $this->input->post("keterangan"),
				"idprioritas"=> $this->input->post("idprioritas"),
				"status"=> "1",
				"modified_date"=> $this->dbx->cts(),
				"modified_by"=> $this->session->userdata('idpegawai'));
		if ($id<>""){
			$result = $this->permintaan_barang_db->ubah($data,$id) ;
		}else{
			//if ($this->input->post("kode_transaksi")<>""){
			//		$kode_transaksi=$this->input->post("kode_transaksi");
			//}else{
				$kode_transaksi= $this->permintaan_barang_db->kode_transaksi($this->input->post("kode_transaksi"),$this->input->post("idcompany"),$this->p_c->tgl_db($this->input->post('tanggalpengajuan')));

			//}
			if ($kode_transaksi<>NULL){
				$data = $this->p_c->arraymerge(array('kode_transaksi' => $kode_transaksi), $data);
				$data = $this->p_c->arraymerge(array('created_date' => $this->dbx->cts()), $data);
				$data = $this->p_c->arraymerge(array('created_by' => $this->session->userdata('idpegawai')), $data);
				//echo var_dump($data);die;
				//echo $kode_transaksi;die;
				$id = $this->permintaan_barang_db->tambah($data);

				if ($id<>""){$result=TRUE;}
			}else{
				$this->session->set_flashdata("errorinput","Data tidak tersimpan, No. Permintaan sudah tersedia dalam Database.");
				$result=FALSE;
			}
		}
		if (($id<>"") and ($result <> TRUE)){
			$this->session->set_flashdata("errorinput","Data tidak tersimpan.");
		}
		if ($result == TRUE) {
			redirect('permintaan_barang/material/'.$id);
			//redirect('permintaan_barang/view/'.$id);
		} else {
			
			//if($id<>""){
				redirect('permintaan_barang/tambah/'.$id);
			//}
			//$data['error']='Errorr...';
			//$this->ubah($id,$data);
		}
	}

	
	//MATERIAL
	//-------------------------------------------------------------------------------------------

	public function material($id) {
		$data['form']='Permintaan Barang';
		$data['form_small']='Material';
		$data['view']='material';
		$data['action']='permintaan_barang/ubahstatus_p/'.$id;
		$data['viewview']='0';
		$data= $this->permintaan_barang_db->view_db($id,$data);
		$this->load->view('permintaan_barang_v',$data);
	}

	public function tambahmaterial($id,$idx='') {
		$data['form']='Permintaan Barang';
		$data['form_small']='Material';
		$data['view']='tambahmaterial';
		$data['action']='permintaan_barang/tambahmaterial_p/'.$id.'/'.$idx;
		$data= $this->permintaan_barang_db->ubahmaterial_x($data,$idx);
		$this->load->view('permintaan_barang_v',$data);
	}


	public function tambahmaterial_p($id,$idx='') {
		//"idvendor"=> $this->input->post("idvendor"),
		$data = array(
				"idpermintaan_barang"=>$id,
				"idmaterial"=> $this->input->post("idmaterial"),
				"jumlah"=> $this->input->post("jumlah"),
				"idunit"=> $this->input->post("idunit"),
				"harga"=> $this->input->post("harga"),
				"hargatotal"=> $this->input->post("hargatotal"),
				"idperuntukan"=> $this->input->post("idperuntukan"),
				"peruntukan"=> $this->input->post("peruntukan"),
				);
		if ($idx<>""){
			$result = $this->permintaan_barang_db->ubahmaterial_db($data,$idx) ;
		}else{
			$idx = $this->permintaan_barang_db->tambahmaterial_db($data);
			if ($idx<>""){$result=TRUE;}
		}
		if ($result == TRUE) {
			?><script>
					window.opener.location.reload();
					window.close();
				</script>
			<?php
		} else {
			$data['error']='Errorr...';
			$this->ubahmaterial($id,$idx,$data);
		}
	}

	public function hapusmaterial($id,$idx="") {
		$result = $this->permintaan_barang_db->hapusmaterial_db($idx) ;
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
	public function ubahstatus_p($id,$stat='') {
		$data = array(
				"status"=> "2",
				"modified_date"=> $this->dbx->cts(),
				"modified_by"=> $this->session->userdata('idpegawai'));
		$result = $this->permintaan_barang_db->ubah($data,$id) ;
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
		$data['form']='Permintaan Barang';
		$data['form_small']='Lihat';
		$data['view']='material';
		$data['viewview']='1';
		$data= $this->permintaan_barang_db->view_db($id,$data);
		if ($data['isi']->status==2){
			$data['action']='permintaan_barang/release/'.$id;
		}else{
			$data['action']='permintaan_barang/terima_p/'.$id;
		}
		$this->load->view('permintaan_barang_v',$data);
	}

	public function printpermintaan($id) {
		$data['form']='Permintaan Barang';
		$data['form_small']='Lihat';
		$data['view']='material';
		$data['viewview']='1';
		$data= $this->permintaan_barang_db->view_db($id,$data);
		$this->load->view('permintaan_barang_print_v',$data);
	}

	public function hapus($id) {
		$result = $this->permintaan_barang_db->hapusmaterial2_db($id) ;
		$result = $this->permintaan_barang_db->hapus_db($id) ;
		if ($result == TRUE) {
			redirect('permintaan_barang');
		}
	}

	public function printpermintaan_barang($id,$stat='') {
		$data['form']='UUDP Permintaan Barang';
		$data['form_small']='Uang Untuk Dipertanggungjawabkan Permintaan Barang';
		$data['view']='view';
		$data['action']='permintaan_barang/terima_p/'.$id;
		$data= $this->permintaan_barang_db->view_db($id,$data);
		$this->load->view('permintaan_barang_print_v',$data);
	}

	public function tambahmaterialnew($idx){
		redirect('inventory/ubahmaterial/'.$idx);
	}
}//end of class
?>
