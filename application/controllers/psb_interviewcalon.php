<?php

session_start(); //we need to start session in order to access it through CI

Class psb_interviewcalon extends CI_Controller {

public function __construct() {
parent::__construct();

		// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');


		// Load library
		$this->load->library('session');

		// Load database
		$this->load->model('psb_interviewcalon_db');

   if( $this->session->userdata('logged_in')) {
       if($this->dbx->checkpage($this->session->userdata('role_id'),'psb_interviewcalon')==false){
          redirect('user_authentication');
       }
		}else{
			redirect('user_authentication');;
		}

	}

	public function index()
	{
			$data = $this->psb_interviewcalon_db->data();
			$data['form']='Interview Calon Peserta Didik';
			$data['view']='index';
			$data['action']='psb_interviewcalon';
			$this->load->view('psb_interviewcalon_v', $data);
	}

	// TAMBAH
	//-------------------------------------------------------------------------------------------
  public function tambah($idcalon,$replidkeg) {
		$data['form']='Interview Calon Peserta Didik';
		$data['form_small']='Ubah Data';
		$data['idcalon']=$idcalon;
		$data['view']='tambah';
		$data['action']='psb_interviewcalon/tambah_p/'.$idcalon."/".$replidkeg;
		$data= $this->psb_interviewcalon_db->tambah_db($data,$idcalon,$replidkeg);
		$this->load->view('psb_interviewcalon_v',$data);
	}

	public function view($idcalon,$replidkeg) {
		$data['form']='Interview Calon Peserta Didik';
		$data['form_small']='Ubah Data';
		$data['idcalon']=$idcalon;
		$data['view']='view';
		$data['printvar']=$idcalon."/".$replidkeg;
		$data['action']='psb_interviewcalon/tambah_p/'.$idcalon."/".$replidkeg;
		$data= $this->psb_interviewcalon_db->tambah_db($data,$idcalon,$replidkeg);
		$this->load->view('psb_interviewcalon_v',$data);
	}

	public function printthis($idcalon,$replidkeg) {
		$data['form']='LAPORAN HASIL INTERVIEW Calon Peserta Didik';
		$data['form_small']='Ubah Data';
		$data['idcalon']=$idcalon;
		$data['view']='view';
		$data['printvar']=$idcalon."/".$replidkeg;
		$data['action']='psb_interviewcalon/tambah_p/'.$idcalon."/".$replidkeg;
		$data= $this->psb_interviewcalon_db->tambah_db($data,$idcalon,$replidkeg);
		$this->load->view('psb_interviewcalon_print_v',$data);
	}

	public function tambah_p($idcalon,$replidkeg) {
		$resulthapus=$this->dbx->hapusdata("siswa_konseling","replidkeg",$replidkeg);
		if ($resulthapus){
			$sqlkons="SELECT * FROM konseling ";
			$konseling=$this->dbx->data($sqlkons);
			foreach((array)$konseling as $rowkons) {
				$data = array(
												"replidkeg"=>$replidkeg
												,"siswa_id"=>$idcalon
												,"konseling_id"=>$rowkons->replid
												,"description"=>$this->input->post("description".$rowkons->replid)
		                    ,"modified_date"=> $this->dbx->cts()
												,"modified_by"=> $this->session->userdata('idpegawai')
												,"created_date"=> $this->dbx->cts()
												,"created_by"=> $this->session->userdata('idpegawai')
										);
				$result=$this->dbx->tambahdata('siswa_konseling',$data) ;
				if ($rowkons->urutan == 255){
					if ($this->input->post("description".$rowkons->replid) == '0'){
						$this->db->query("update calonsiswa set abk=1 where replid='".$idcalon."'");
					}else{
						$this->db->query("update calonsiswa set abk=0 where replid='".$idcalon."'");
					}
				}
			}
		}

		$result=$this->dbx->ubahdata('kegiatan',array("aktif"=>0),"replid",$replidkeg) ;
		if ($result == TRUE) {
      ?><script>
					window.opener.location.reload();
					window.close();
				</script>
			<?php
		} else {
			$data['error']="Errorr...";
			redirect('psb_interviewcalon/'.$idcalon.'/'.$replidkeg);
		}
	}
}//end of class
?>
