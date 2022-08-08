<?php

session_start(); //we need to start session in order to access it through CI

Class ksw_mutasi extends CI_Controller {

public function __construct() {
parent::__construct();

		// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');


		// Load library
		$this->load->library('session');

		// Load database
		$this->load->model('ksw_mutasi_db');

		if( $this->session->userdata('logged_in')) {
			if($this->dbx->checkpage($this->session->userdata('role_id'),'ksw_mutasi')==false){
					redirect('user_authentication');
			}
		}else{
			redirect('user_authentication');;
		}

	}

	public function index()
	{
			$data= $this->ksw_mutasi_db->data();
			$data['form']='Mutasi Siswa';
			$data['view']='index';
			$data['action']='ksw_mutasi';
			$data['editdata']=1;
			$this->load->view('ksw_mutasi_v', $data);
	}

	public function tambah($replid) {
		$data['form']='Mutasi Siswa';
		$data['form_small']='Tambah Data';
		$data['view']='tambah';
		$data['action']='ksw_mutasi/tambah_p/'.$replid;
		$data= $this->ksw_mutasi_db->tambah_db($replid,$data);
		$this->load->view('ksw_mutasi_v',$data);
	}

	public function tambah_p($replid) {
    $data = array(
                    "aktif"=>0,
                    "alumni"=>0,
                    "modified_date"=> $this->dbx->cts(),
                    "modified_by"=> $this->session->userdata('idpegawai')
                  );
    $result = $this->dbx->ubahdata('siswa',$data,'replid',$replid);
    $data = array(
                    "nis"=> $this->input->post("nis"),
										"idsiswa"=> $replid,
										"aktif"=>0,
                    "jenismutasi"=> $this->input->post("jenismutasi"),
                    "tglmutasi"=> $this->p_c->tgl_db($this->input->post("tglmutasi")),
                    "keterangan"=> $this->input->post("keterangan"),
                    "modified_date"=> $this->dbx->cts(),
                    "modified_by"=> $this->session->userdata('idpegawai')
                  );
    $result = $this->dbx->tambahdata('mutasisiswa',$data);
		//echo $this->db->last_query();die;

		if ($result == TRUE) {
				?><script>
						window.opener.location.reload();
						window.close();
					</script>
				<?php
		} else {
			redirect("ksw_mutasi/tambah/".$replid);
		}
	}

	public function batalmutasi_p($replid) {
    $data = array(
                    "aktif"=>1,
                    "alumni"=>0,
                    "modified_date"=> $this->dbx->cts(),
                    "modified_by"=> $this->session->userdata('idpegawai')
                  );
    $result = $this->dbx->ubahdata('siswa',$data,'replid',$replid);
    $data = array(
                    "nis"=> $this->input->post("nis"),
										"idsiswa"=> $replid,
										"aktif"=>1,
                    "jenismutasi"=> 11,
                    "tglmutasi"=> $this->dbx->cts(),
                    "modified_date"=> $this->dbx->cts(),
                    "modified_by"=> $this->session->userdata('idpegawai')
                  );
    $result = $this->dbx->tambahdata('mutasisiswa',$data);
		//echo $this->db->last_query();die;

		if ($result == TRUE) {
				?><script>
						window.opener.location.reload();
						window.close();
					</script>
				<?php
		} else {
			redirect("ksw_mutasi/tambah/".$replid);
		}
	}
}//end of class
?>
