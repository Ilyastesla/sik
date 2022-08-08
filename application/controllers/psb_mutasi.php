<?php

session_start(); //we need to start session in order to access it through CI

Class psb_mutasi extends CI_Controller {

public function __construct() {
parent::__construct();

		// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');


		// Load library
		$this->load->library('session');

		// Load database
		$this->load->model('psb_mutasi_db');
		$this->load->model('online_kronologis_db');

   if( $this->session->userdata('logged_in')) {
       if($this->dbx->checkpage($this->session->userdata('role_id'),'psb_mutasi')==false){
          redirect('user_authentication');
       }
		}else{
			redirect('user_authentication');
		}

	}

	public function index($data="")
	{
			$data = $this->psb_mutasi_db->data();
			$data['form']='Mutasi Calon Peserta Didik';
			$data['view']='index';
			$data['action']='psb_mutasi';
			$this->load->view('psb_mutasi_v', $data);
	}

	// UBAH
	//-------------------------------------------------------------------------------------------
	public function ubah($id,$stat='') {
		$data['form']='Mutasi Calon Peserta Didik';
		$data['form_small']='Ubah Data';
		$data['view']='tambah';
		$data['action']='psb_mutasi/tambah_p/'.$id;
		$data= $this->psb_mutasi_db->tambah_db($id,$data);
		$this->load->view('psb_mutasi_v',$data);
	}

	public function tambah_p($id='') {
		$nopendaftaran= $this->online_kronologis_db->nopendaftaran($this->input->post("idunitbisnis"),$this->input->post("idproses"),str_replace('-','',$this->input->post('tanggal_daftar')));
		$data = array(
										"nopendaftaran"=>$nopendaftaran
										,"idtahunajaran"=>$this->input->post("idtahunajaran")
										,"tingkat"=>$this->input->post("tingkat")
										,"jurusan"=>$this->input->post("idjurusan")
										,"idproses"=>$this->input->post("idproses")
										,"idkelompok"=>$this->input->post("idkelompok")
										,"modified_date"=> $this->dbx->cts()
										,"modified_by"=> $this->session->userdata('idpegawai')
								);
		$this->session->set_flashdata($data);
		if ($id<>""){
			$result = $this->dbx->ubahdata('calonsiswa',$data,'replid',$id);
		}

		if (($result == TRUE) and ($id<>"")) {
			$data = $this->p_c->arraymerge(array('nopendaftaranlama' =>$this->input->post("nopendaftaranlama")), $data);
			$data = $this->p_c->arraymerge(array('idcalonsiswa' =>$id), $data);
			$data = $this->p_c->arraymerge(array('iddepartemen' =>$this->input->post("iddepartemen")), $data);
			$data = $this->p_c->arraymerge(array('keterangan' =>$this->input->post("keterangan")), $data);
			$data = $this->p_c->arraymerge(array('created_date' => $this->dbx->cts()), $data);
			$data = $this->p_c->arraymerge(array('created_by' => $this->session->userdata('idpegawai')), $data);
			$this->dbx->tambahdata('calonsiswarevisi',$data) ;

			$dataok = array(
											"idtahunajaran"=>$this->input->post("idtahunajaran")
											,"idunitbisnis"=>$this->input->post("idunitbisnis")
											,"modified_date"=> $this->dbx->cts()
											,"modified_by"=> $this->session->userdata('idpegawai')
									);
			$result = $this->dbx->ubahdata('online_kronologis',$dataok,'idcalon',$id);
		}
		if ($result == TRUE) {
			redirect("general/datacalonsiswa/".$id);
		} else {
			$data['error']="Errorr...";
			$this->ubah($id,$data);
		}
	}
}//end of class
?>
