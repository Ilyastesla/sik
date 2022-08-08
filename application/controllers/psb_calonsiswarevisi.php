<?php

session_start(); //we need to start session in order to access it through CI

Class psb_calonsiswarevisi extends CI_Controller {

public function __construct() {
parent::__construct();

		// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');


		// Load library
		$this->load->library('session');

		// Load database
		$this->load->model('psb_calonsiswarevisi_db');

   if( $this->session->userdata('logged_in')) {
       if($this->dbx->checkpage($this->session->userdata('role_id'),'psb_calonsiswarevisi')==false){
          redirect('user_authentication');
       }
		}else{
			redirect('user_authentication');;
		}

	}

	public function index($data="")
	{
			$data = $this->psb_calonsiswarevisi_db->data();
			$data['form']='Revisi Calon Peserta Didik';
			$data['view']='index';
			$data['action']='psb_calonsiswarevisi';
			$this->load->view('psb_calonsiswarevisi_v', $data);
	}

	// UBAH
	//-------------------------------------------------------------------------------------------
	public function ubah($id,$stat='') {
		$data['form']='Revisi Calon Peserta Didik';
		$data['form_small']='Ubah Data';
		$data['view']='tambah';
		$data['action']='psb_calonsiswarevisi/tambah_p/'.$id;
		$data= $this->psb_calonsiswarevisi_db->tambah_db($id,$data);
		$this->load->view('psb_calonsiswarevisi_v',$data);
	}

	public function tambah_p($id='') {
		$data = array(
										"idtahunajaran"=>$this->input->post("idtahunajaran")
										,"idproses"=>$this->input->post("idproses")
										,"idkelompok"=>$this->input->post("idkelompok")
										,"tingkat"=>$this->input->post("tingkat")
										,"region"=>$this->input->post("region")
										,"kondisi"=>$this->input->post("kondisi")
										,"abk"=>$this->input->post("abk")
										,"jurusan"=>$this->input->post("idjurusan")
										,"tanggal_daftar"=>$this->p_c->tgl_db($this->input->post("tanggal_daftar"))
										,"modified_date"=> $this->dbx->cts()
										,"modified_by"=> $this->session->userdata('idpegawai')
								);
		$this->session->set_flashdata($data);
		if ($id<>""){
			$result = $this->dbx->ubahdata('calonsiswa',$data,'replid',$id);
		}

		if (($result == TRUE) and ($id<>"")) {
			$data = $this->p_c->arraymerge(array('idcalonsiswa' =>$id), $data);
			$data = $this->p_c->arraymerge(array('iddepartemen' =>$this->input->post("iddepartemen")), $data);
			$data = $this->p_c->arraymerge(array('keterangan' =>$this->input->post("keterangan")), $data);
			$data = $this->p_c->arraymerge(array('created_date' => $this->dbx->cts()), $data);
			$data = $this->p_c->arraymerge(array('created_by' => $this->session->userdata('idpegawai')), $data);
			$this->dbx->tambahdata('calonsiswarevisi',$data) ;
		}
		if ($result == TRUE) {
			?><script>
					window.opener.location.reload();
					window.close();
				</script>
			<?php
			//redirect("psb_calonsiswarevisi");
		} else {
			$data['error']="Errorr...";
			$this->ubah($id,$data);
		}
	}



	// HAPUS
	//-------------------------------------------------------------------------------------------
	public function hapus($id) {
		$result = $this->dbx->hapusdata('calonsiswa','replid',$id) ;
		if ($result == TRUE) {
			?><script>
					window.opener.location.reload();
					window.close();
				</script>
			<?php
		}
	}

	public function ubahaktif($id) {
		$data['form']='Revisi Calon Peserta Didik';
		$data['form_small']='Ubah Data';
		$data['view']='ubahaktif';
		$data['action']='psb_calonsiswarevisi/ubahaktif_p/'.$id;
		$data= $this->psb_calonsiswarevisi_db->tambah_db($id,$data);
		$this->load->view('psb_calonsiswarevisi_v',$data);
	}

	public function ubahaktif_p($id) {
		$data=array(
				'aktif' =>$this->input->post("aktif")
				,"modified_date"=> $this->dbx->cts()
				,"modified_by"=> $this->session->userdata('idpegawai'));
		$result = $this->dbx->ubahdata('calonsiswa',$data,'replid',$id);

		$data=array(
				'idcalon' =>$id
				,'aktif' =>$this->input->post("aktif")
				,'idalasan' =>$this->input->post("idalasan")
				,'keterangan' =>$this->input->post("keterangan")
				,"created_date"=> $this->dbx->cts()
				,"created_by"=> $this->session->userdata('idpegawai')
				,"modified_date"=> $this->dbx->cts()
				,"modified_by"=> $this->session->userdata('idpegawai'));
		$result = $this->dbx->tambahdata('calonsiswa_riwayat',$data);

		if ($result == TRUE) {
			?><script>
					window.opener.location.reload();
					window.close();
				</script>
			<?php
		} else {
			$data['error']='Errorr...';
			$this->ubah($id,$data);
		}
	}

	public function view($replid) {
		$data['form']='Revisi Calon Peserta Didik';
		$data['form_small']='Ubah Data';
		$data['view']='view';
		$data['action']='psb_calonsiswarevisi/tambah_p/'.$replid;
		$data= $this->psb_calonsiswarevisi_db->view_db($replid,$data);
		$this->load->view('psb_calonsiswarevisi_v',$data);
	}
}//end of class
?>
