<?php

session_start(); //we need to start session in order to access it through CI

Class psb_kronologis extends CI_Controller {

public function __construct() {
parent::__construct();

		// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');


		// Load library
		$this->load->library('session');

		// Load database
		$this->load->model('psb_kronologis_db');

   if( $this->session->userdata('logged_in')) {
       if($this->dbx->checkpage($this->session->userdata('role_id'),'psb_kronologis')==false){
          redirect('user_authentication');
       }
		}else{
			redirect('user_authentication');;
		}

	}

	public function index($data="")
	{
			$data = $this->psb_kronologis_db->data();
			$data['form']='Kronologis Calon Peserta Didik';
			$data['view']='index';
			$data['action']='psb_kronologis';
			$this->load->view('psb_kronologis_v', $data);
	}


	// Tambah
	//-------------------------------------------------------------------------------------------
	public function tambah($id="") {
		$data['form']='Kronologis Calon Peserta Didik';
		if($id<>""){
			$data['form_small']='Tambah Data';
		}else{
			$data['form_small']='Ubah Data';
		}
		$data['view']='tambah';
		$data['action']='psb_kronologis/tambah_p/'.$id;
		$data= $this->psb_kronologis_db->tambah_db($id,$data);
		$this->load->view('psb_kronologis_v',$data);
	}

	public function tambah_p($id='') {
		$data = array(
										"tgl_masuk"=> $this->p_c->tgl_db($this->input->post('tgl_masuk'))
										,"ortu"=>$this->input->post("ortu")
										,"namaortu"=>$this->input->post("namaortu")
										,"penerimainformasi"=>$this->input->post("penerimainformasi")
										,"tahunlahirortu"=>$this->input->post("tahunlahirortu")
										,"teleponortu"=>$this->input->post("teleponortu")
										,"handphoneortu"=>$this->input->post("handphoneortu")
										,"whatsapportu"=>$this->input->post("whatsapportu")
										,"emailortu"=>$this->input->post("emailortu")
										,"jenis_kelamin"=>$this->input->post("jenis_kelamin")
										,"tmplahir"=>$this->input->post("tmplahir")
										,"tgllahir"=> $this->p_c->tgl_db($this->input->post('tgllahir'))
										,"negara"=>$this->input->post("negara")
										,"propinsi"=>$this->input->post("propinsi")
										,"kota"=>$this->input->post("kota")
										,"kecamatan"=>$this->input->post("kecamatan")
										,"asalsekolah"=>$this->input->post("asalsekolah")
										,"tingkat_asal"=>$this->input->post("tingkat_asal")
										,"jurusan_asal"=>$this->input->post("jurusan_asal")
										,"jenjang"=>$this->input->post("jenjang")
										,"tingkat"=>$this->input->post("tingkat")
										,"jurusan"=>$this->input->post("jurusan")
										,"modified_date"=> $this->dbx->cts()
										,"modified_by"=> $this->session->userdata('idpegawai')
								);
		$this->session->set_flashdata($data);
		if ($id<>""){
			$result = $this->dbx->ubahdata('siswa_kronologis',$data,'replid',$id);
		}else{
			if ($this->input->post("kode_transaksi")<>""){
					$kode_transaksi=$this->input->post("kode_transaksi");
			}else{
				$kode_transaksi= $this->hrm_event_db->kode_transaksi($this->p_c->tgl_db($this->input->post('tanggalpelaksanaan')));
			}

			$data = $this->p_c->arraymerge(array('kode_transaksi' => $kode_transaksi), $data);
			$data = $this->p_c->arraymerge(array('created_date' => $this->dbx->cts()), $data);
			$data = $this->p_c->arraymerge(array('created_by' => $this->session->userdata('idpegawai')), $data);
			$id = $this->dbx->tambahdata('siswa_kronologis',$data,'replid',$id);
			if ($id<>""){$result=TRUE;}
		}
		//echo $this->db->last_query();die;

		if ($result == TRUE) {
			?><script>
					window.opener.location.reload();
					window.close();
				</script>
			<?php
			//redirect("psb_kronologis");
		} else {
			$data['error']="Errorr...";
			$this->tambah($id,$data);
		}
	}



	// HAPUS
	//-------------------------------------------------------------------------------------------
	public function hapus($id) {
		$result = $this->dbx->hapusdata('siswa_kronologis','replid',$id) ;
		if ($result == TRUE) {
			redirect('psb_kronologis');
		}
	}

	public function ubahaktif($id,$aktif=0) {
		$data=array(
				'aktif' =>$aktif
				,"modified_date"=> $this->dbx->cts()
				,"modified_by"=> $this->session->userdata('idpegawai'));
		$result = $this->psb_kronologis_db->ubah_pdb($data,$id);
		if ($result == TRUE) {
			redirect('psb_kronologis');
		} else {
			$data['error']='Errorr...';
			$this->ubah($id,$data);
		}
	}

	public function view($replid) {
		$data['form']='Kronologis Calon Peserta Didik';
		$data['form_small']='Ubah Data';
		$data['view']='view';
		$data['action']='psb_kronologis/tambah_p/'.$replid;
		$data= $this->psb_kronologis_db->view_db($replid,$data);
		$this->load->view('psb_kronologis_v',$data);
	}
}//end of class
?>
