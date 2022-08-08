<?php

session_start(); //we need to start session in order to access it through CI

Class psb_assessment extends CI_Controller {

public function __construct() {
parent::__construct();

		// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');


		// Load library
		$this->load->library('session');

		// Load database
		$this->load->model('psb_assessment_db');

   if( $this->session->userdata('logged_in')) {
       if($this->dbx->checkpage($this->session->userdata('role_id'),'psb_assessment')==false){
          redirect('user_authentication');
       }
		}else{
			redirect('user_authentication');;
		}

	}

	public function index()
	{
			$data = $this->psb_assessment_db->data();
			$data['form']='Asesmen Calon Peserta Didik';
			$data['view']='index';
			$data['report']=0;
			$data['action']='psb_assessment';
			$this->load->view('psb_assessment_v', $data);
	}

	// TAMBAH
	//-------------------------------------------------------------------------------------------
  public function tambah($tipedata,$idcalon,$replidkeg) {
		$data['form']='Asesmen Calon Peserta Didik';
		$data['form_small']='Ubah Data';
		$data['view']='tambah';
		$data['idcalon']=$idcalon;
		$data['action']='psb_assessment/tambah_p/'.$tipedata.'/'.$idcalon."/".$replidkeg;
		$data= $this->psb_assessment_db->tambah_db($tipedata,$data,$idcalon,$replidkeg);
		$this->load->view('psb_assessment_v',$data);
	}

	public function view($tipedata,$idcalon,$replidkeg) {
		$data['form']='Asesmen Calon Peserta Didik';
		$data['form_small']='Ubah Data';
		$data['view']='view';
		$data['report']=0;
		$data['idcalon']=$idcalon;
		$data['tipedata']=$tipedata;
		$data['printvar']=$tipedata."/".$idcalon."/".$replidkeg;
		$data['action']='psb_assessment/tambah_p/'.$tipedata.'/'.$idcalon."/".$replidkeg;
		$data= $this->psb_assessment_db->tambah_db($tipedata,$data,$idcalon,$replidkeg);
		$this->load->view('psb_assessment_v',$data);
	}

	public function printthis($tipedata,$idcalon,$replidkeg) {
		$data['form']='LAPORAN HASIL INTERVIEW Calon Peserta Didik';
		$data['form_small']='Ubah Data';
		$data['view']='view';
		$data['tipedata']=$tipedata;
		$data['word']=0;
		$data['idcalon']=$idcalon;
		$data['action']='psb_assessment/tambah_p/'.$tipedata.'/'.$idcalon."/".$replidkeg;
		$data= $this->psb_assessment_db->tambah_db($tipedata,$data,$idcalon,$replidkeg);
		$this->load->view('psb_assessment_print_v',$data);
	}

	public function tambah_p($tipedata,$idcalon,$replidkeg) {
		$sqldelete="DELETE FROM siswa_observasi WHERE siswa_id='".$idcalon."' AND replidkeg='".$replidkeg."'
								AND observasi_id IN (SELECT k.replid FROM observasi k WHERE k.tipe_data='".$tipedata."' AND aktif=1)";
		$resulthapus=$this->db->query($sqldelete);
		if ($resulthapus){
			$rd="";
			if($this->input->post('referencedata')<>""){
				$rd=" AND referencedata='".$this->input->post('referencedata')."' ";
			}

			$sqlobs="SELECT * FROM observasi WHERE tipe_data='".$tipedata."' ".$rd." AND aktif=1 ";
			$observasi=$this->dbx->data($sqlobs);

			foreach((array)$observasi as $rowobs) {
				$data = array(
												"replidkeg"=>$replidkeg
												,"siswa_id"=>$idcalon
												,"observasi_id"=>$rowobs->replid
												,"description"=>$this->input->post("description".$rowobs->replid)
		                    ,"modified_date"=> $this->dbx->cts()
												,"modified_by"=> $this->session->userdata('idpegawai')
												,"created_date"=> $this->dbx->cts()
												,"created_by"=> $this->session->userdata('idpegawai')
										);
				$result=$this->dbx->tambahdata('siswa_observasi',$data) ;
				if($rowobs->updatetable<>""){
					$updsqlvar=$this->dbx->singlerow("SELECT data_updatetable as isi FROM observasi_data WHERE replid='".$this->input->post("description".$rowobs->replid)."'");
					$updsqlexe= $rowobs->updatetable.$updsqlvar." WHERE replid='".$idcalon."' ";
					$result2=$this->db->query($updsqlexe);
				}
				
				//
				//echo $result."--".$this->db->last_query();
			}
		}
		//die;
		$result=$this->dbx->ubahdata('kegiatan',array("aktif"=>0),"replid",$replidkeg) ;
		//echo $result."--".$this->db->last_query();die;
		if ($result == TRUE) {
      ?><script>
					window.opener.location.reload();
					window.close();
				</script>
			<?php
		} else {
			$data['error']="Errorr...";
			redirect('psb_assessment/'.$idcalon.'/'.$replidkeg);
		}
	}
}//end of class
?>
