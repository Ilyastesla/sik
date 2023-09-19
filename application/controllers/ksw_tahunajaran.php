<?php

session_start(); //we need to start session in order to access it through CI

Class ksw_tahunajaran extends CI_Controller {

public function __construct() {
parent::__construct();

		// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');


		// Load library
		$this->load->library('session');

		// Load database
		$this->load->model('ksw_tahunajaran_db');

		if( $this->session->userdata('logged_in')) {
			if($this->dbx->checkpage($this->session->userdata('role_id'),'ksw_tahunajaran')==false){
					redirect('user_authentication');
			}
		}else{
			redirect('user_authentication');;
		}

	}

	public function index()
	{
			$data= $this->ksw_tahunajaran_db->data();
			$data['action']='ksw_tahunajaran';
			$data['form']='Tahun Pelajaran';
			$data['view']='index';
			$this->load->view('ksw_tahunajaran_v', $data);
	}

	// TAMBAH
	//-------------------------------------------------------------------------------------------
	public function tambah($id='') {
		$data['form']='Tahun Pelajaran';
		$data['form_small']='Tambah/Ubah Data';
		$data['view']='tambah';
		$data['action']='ksw_tahunajaran/tambah_p/'.$id;
		$data= $this->ksw_tahunajaran_db->tambah_db($id,$data);
		$this->load->view('ksw_tahunajaran_v',$data);
	}

	public function tambah_p($id='') {
		//,"aktif"=>$this->input->post("aktif")
		$data = array(
										"tahunajaran"=>$this->input->post("tahunajaran")
										,'idcompany' => $this->input->post('idcompany')
										,"idkepsek"=>$this->input->post("idkepsek")
										,"idkonselor"=>$this->input->post("idkonselor")
										,"idpsikolog"=>$this->input->post("idpsikolog")
										,"departemen"=>$this->input->post("departemen")
										,"tglmulai"=> $this->p_c->tgl_db($this->input->post('tglmulai'))
										,"tglakhir"=> $this->p_c->tgl_db($this->input->post('tglakhir'))
										,"keterangan"=>$this->input->post("keterangan")
										,"aktifdaftar"=>$this->input->post("aktifdaftar")
										,"modified_date"=> $this->dbx->cts()
										,"modified_by"=> $this->session->userdata('idpegawai')
								);

		if ($id<>""){
			$result = $this->dbx->ubahdata('tahunajaran',$data,'replid',$id) ;
		}else{
			$data = $this->p_c->arraymerge(array('aktif' => 1), $data);
			$data = $this->p_c->arraymerge(array('created_date' => $this->dbx->cts()), $data);
			$data = $this->p_c->arraymerge(array('created_by' => $this->session->userdata('idpegawai')), $data);
			$id = $this->dbx->tambahdata('tahunajaran',$data) ;
			if ($id<>""){$result=TRUE;
					$result=$this->ksw_tahunajaran_db->activate_pdb($this->input->post("departemen"),$id);
			}
		}

		if ($result == TRUE) {
			?><script>
					window.opener.location.reload();
					window.close();
				</script>
			<?php
		} else {
			$data['error']="Errorr...";
			$this->ubah($id,$data);
		}
	}

	// HAPUS
	//-------------------------------------------------------------------------------------------
	public function hapus($id) {
		$result = $this->dbx->hapusdata('tahunajaran','replid',$id)  ;
		//echo $this->db->last_query();die;
		if ($result == TRUE) {
			?><script>
					window.opener.location.reload();
					window.close();
				</script>
			<?php
		}
	}

	public function ubahaktif($id,$dept,$aktif=0) {
		$data=array(
				'aktif' =>$aktif
				,"modified_date"=> $this->dbx->cts()
				,"modified_by"=> $this->session->userdata('idpegawai'));
		$result = $this->dbx->ubahdata('tahunajaran',$data,'replid',$id);
		if ($result == TRUE) {
			$result=$this->ksw_tahunajaran_db->activate_pdb($dept,$id);
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

	public function ubahaktifdaftar($id,$aktif=0) {
		$data=array(
				'aktifdaftar' =>$aktif
				,"modified_date"=> $this->dbx->cts()
				,"modified_by"=> $this->session->userdata('idpegawai'));
		$result = $this->dbx->ubahdata('tahunajaran',$data,'replid',$id);
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
}//end of class
?>
