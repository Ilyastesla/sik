<?php

session_start(); //we need to start session in order to access it through CI

Class ksw_tidak_naik extends CI_Controller {

public function __construct() {
parent::__construct();

		// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');


		// Load library
		$this->load->library('session');

		// Load database
		$this->load->model('ksw_tidak_naik_db');

		if( $this->session->userdata('logged_in')) {
			if($this->dbx->checkpage($this->session->userdata('role_id'),'ksw_tidak_naik')==false){
					redirect('user_authentication');
			}
		}else{
			redirect('user_authentication');;
		}

	}

	public function index()
	{
			$data= $this->ksw_tidak_naik_db->data();
			$data['form']='Tidak Naik Kelas';
			$data['view']='index';
			$data['action']='ksw_tidak_naik';
			$data['actionsave']='ksw_tidak_naik/tambah_p';
			$this->load->view('ksw_tidak_naik_v', $data);
	}

	public function tambah_p() {
			$idsiswarow=$this->input->post("idsiswa");
			foreach ($idsiswarow as $idsiswa) {
					$data = array(
									 				"idkelas"=> $this->input->post("idkelastujuan"),
													"kondisi"=> 39,
													"region"=> $this->input->post("idregiontujuan".$idsiswa),
									 				"modified_date"=> $this->dbx->cts(),
									 				"modified_by"=> $this->session->userdata('idpegawai')
												);
					$result = $this->dbx->ubahdata('siswa',$data,'replid',$idsiswa);
					$data = array(
													"nis"=> $this->input->post("nis".$idsiswa),
													"idkelas"=> $this->input->post("idkelas"),
													"idkelastujuan"=> $this->input->post("idkelastujuan"),
													"mulai"=>$this->dbx->cts(),
													"kondisi"=> $this->input->post("kondisi".$idsiswa),
													"kondisitujuan"=> 39,
													"region"=> $this->input->post("region".$idsiswa),
													"regiontujuan"=> $this->input->post("idregiontujuan".$idsiswa),
													"aktif"=>1,
													"keterangan"=>"Tidak Naik Kelas",
													"modified_date"=> $this->dbx->cts(),
									 				"modified_by"=> $this->session->userdata('idpegawai')
												);
					$result = $this->dbx->tambahdata('riwayatkelassiswa',$data);
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
										"idkelas"=> $riwayatdata->idkelas,
										"kondisi"=> $riwayatdata->kondisi,
										"region"=> $riwayatdata->region,
										"modified_date"=> $this->dbx->cts(),
										"modified_by"=> $this->session->userdata('idpegawai')
									);
		$result = $this->dbx->ubahdata('siswa',$data,'nis',$riwayatdata->nis);

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
