<?php

session_start(); //we need to start session in order to access it through CI

Class keu_administrasi_calon extends CI_Controller {

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
			if($this->dbx->checkpage($this->session->userdata('role_id'),'keu_administrasi_calon')==false){
					redirect('user_authentication');
			}
		}else{
			redirect('user_authentication');;
		}

	}

	public function index($print="",$excel="")
	{
			$data['form']='Administrasi Keuangan Calon Peserta Didik';
			$data['view']='index';
			$data['action']='keu_administrasi_calon';
			$data['excel']=$excel;
			$data['hanyapusat']=0;
			$data= $this->keu_administrasi_calon_db->data($data);
			
			$data['hariini']=$this->dbx->singlerow("SELECT CURRENT_DATE() as isi");
			if($print<>"1"){
				$this->load->view('keu_administrasi_calon_v', $data);
			}else{
				$this->load->view('keu_administrasi_calon_print_v', $data);
			}

	}

	public function set_keucalon($keutype,$idcalon) {
		$keuvalue=1;
		switch ($keutype) {
			case '2':
				$keuvar="keu_assessment";
				break;
			case '3':
				$keuvar="keu_up";
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
		$sqltoken="UPDATE calonsiswa SET tokenonline='".$this->dbx->randomchar(8,1)."' WHERE (tokenonline='' OR tokenonline is NULL) AND replid='".$idcalon."'";
		//$result=$this->db->query($sqltoken);
		//echo $sqltoken;die;
		//echo $this->db->last_query();die;
		if ($result == TRUE) {
			//redirect('keu_administrasi_calon');
			?><script>
					window.opener.location.reload();
					window.close();
				</script>
			<?php
		} else {
			$data['error']='Errorr...';
			redirect('keu_administrasi_calon');
		}
	}
}//end of class
?>
