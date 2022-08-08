<?php

session_start(); //we need to start session in order to access it through CI

Class keu_administrasi_calon_rev extends CI_Controller {

public function __construct() {
parent::__construct();

		// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');


		// Load library
		$this->load->library('session');

		// Load database
		$this->load->model('keu_administrasi_calon_db');

		if( $this->session->userdata('logged_in')) {
			if($this->dbx->checkpage($this->session->userdata('role_id'),'keu_administrasi_calon_rev')==false){
					redirect('user_authentication');
			}
		}else{
			redirect('user_authentication');;
		}

	}

	public function index($print="",$excel="")
	{
			$data= $this->keu_administrasi_calon_db->data();
			$data['form']='Administrasi Keuangan CPD Revisi';
			$data['view']='index';
			$data['action']='keu_administrasi_calon_rev';
			$this->load->view('keu_administrasi_calon_rev_v', $data);
	}

	public function set_keucalon($keutype,$idcalon) {
		$keuvalue=0;
		switch ($keutype) {
			case '2':
				$keuvar="keu_assessment";
				break;
			case '3':
				$keuvar="keu_up";
				$keuvalue=1;
				break;
			default:
				$keuvar="keu_form";
				break;
		}
		$thisday=$this->dbx->cts();
		$data=array(
				$keuvar=> $keuvalue
				,"aktif"=> $keuvalue
				,"update_date"=> $thisday
				,"update_by"=> $this->session->userdata('idpegawai')
			);
		$result = $this->dbx->ubahdata('calonsiswa',$data,'replid',$idcalon);
    //echo $this->db->last_query();die;
		$data=array(
				"idcalon"=> $idcalon
				,"administrasitext"=>$keuvar
				,"administrasitype"=>$keuvalue
				,"tgl_aktivasi"=> $thisday
				,"modified_date"=> $thisday
				,"modified_by"=> $this->session->userdata('idpegawai')
				,"created_date"=> $thisday
				,"created_by"=> $this->session->userdata('idpegawai')
			);
		$result = $this->dbx->tambahdata('keu_calon_administrasi',$data);
		if ($result == TRUE) {
			?><script>
					window.opener.location.reload();
					window.close();
				</script>
			<?php
		} else {
			$data['error']='Errorr...';
			redirect('keu_administrasi_calon_rev');
		}
	}
}//end of class
?>
