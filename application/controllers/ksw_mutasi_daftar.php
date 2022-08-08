<?php

session_start(); //we need to start session in order to access it through CI

Class ksw_mutasi_daftar extends CI_Controller {

public function __construct() {
parent::__construct();

		// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');


		// Load library
		$this->load->library('session');

		// Load database
		$this->load->model('ksw_mutasi_daftar_db');

		if( $this->session->userdata('logged_in')) {
			if($this->dbx->checkpage($this->session->userdata('role_id'),'ksw_mutasi_daftar')==false){
					redirect('user_authentication');
			}
		}else{
			redirect('user_authentication');;
		}

	}

	public function index()
	{
			$data= $this->ksw_mutasi_daftar_db->data();
			$data['form']='Daftar Mutasi';
			$data['view']='index';
			$data['action']='ksw_mutasi_daftar';
			$data['actionsave']='ksw_mutasi_daftar/tambah_p';
			$this->load->view('ksw_mutasi_daftar_v', $data);
	}

	public function tambah_p() {
			$idsiswarow=$this->input->post("idsiswa");
			foreach ($idsiswarow as $idsiswa) {
					$data = array(
									 				"aktif"=>0,
													"alumni"=>1,
									 				"modified_date"=> $this->dbx->cts(),
									 				"modified_by"=> $this->session->userdata('idpegawai')
												);
					$result = $this->dbx->ubahdata('siswa',$data,'nis',$idsiswa);

					$data = array(
													"nis"=> $idsiswa,
													"idkelas"=> $this->input->post("idkelas"),
													"idkelastujuan"=>$this->input->post("idkelas"),
													"mulai"=>$this->dbx->cts(),
													"kondisi"=> $this->input->post("kondisi".$idsiswa),
													"kondisitujuan"=> $this->input->post("kondisi".$idsiswa),
													"region"=> $this->input->post("region".$idsiswa),
													"regiontujuan"=> $this->input->post("region".$idsiswa),
													"aktif"=>1,
													"keterangan"=>"Lulus",
                          "modified_date"=> $this->dbx->cts(),
									 				"modified_by"=> $this->session->userdata('idpegawai')
												);
					$result = $this->dbx->tambahdata('riwayatkelassiswa',$data);

          $data = array(
													"nis"=> $idsiswa,
													"klsakhir"=> $this->input->post("idkelas"),
													"tgllulus"=> $this->p_c->tgl_db($this->input->post("idkelas")),
													"mulai"=>$this->dbx->cts(),
													"keterangan"=>"Lulus",
                          "modified_date"=> $this->dbx->cts(),
									 				"modified_by"=> $this->session->userdata('idpegawai')
												);
					$result = $this->dbx->tambahdata('alumni',$data);
					//echo $this->db->last_query();die;
			}
			?><script>
					window.opener.location.reload();
					window.close();
				</script>
			<?php
	}


	public function hapus($replid) {
		$riwayatdata=$this->dbx->rows("SELECT * FROM riwayatkelassiswa WHERE replid='".$replid."'");
		$data = array(
                    "aktif"=>1,
                    "alumni"=>0,
										"modified_date"=> $this->dbx->cts(),
										"modified_by"=> $this->session->userdata('idpegawai')
									);
		$result = $this->dbx->ubahdata('siswa',$data,'nis',$riwayatdata->nis);

    $result = $this->dbx->hapusdata('alumni','nis',$riwayatdata->nis) ;
    $result = $this->dbx->hapusdata('riwayatkelassiswa','replid',$replid) ;
		if ($result == TRUE) {
			?><script>
					window.opener.location.reload();
					window.close();
				</script>
			<?php
		}
	}
}//end of class
?>
