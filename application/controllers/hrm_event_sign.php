<?php

session_start(); //we need to start session in order to access it through CI

Class hrm_event_sign extends CI_Controller {

public function __construct() {
	parent::__construct();

		// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');


		// Load session library
		$this->load->library('session');

		// Load database
		$this->load->model('hrm_event_sign_db');
		$this->load->model('hrm_event_db');

		if( $this->session->userdata('logged_in')) {
			if($this->dbx->checkpage($this->session->userdata('role_id'),'hrm_event_sign')==false){
					redirect('user_authentication');
			}
		}else{
			redirect('user_authentication');;
		}

	}

	public function index()
	{
			$data['show_table'] = $this->hrm_event_sign_db->data();
			$data['form']='Proses Pelatihan';
			$data['view']='index';
			$this->load->view('hrm_event_sign_v', $data);
	}

	public function hadir_v($idhrm_event) {
		$data['form']='Proses Pelatihan';
		$data['form_small']='Presensi';
		$data['view']='Presensi';
		$data['action']='hrm_event_sign/hadir_p/'.$idhrm_event;
		$data['ubah']=1;
		$data= $this->hrm_event_db->view_db($idhrm_event,$data);
		$this->load->view('hrm_event_sign_v', $data);
	}
	public function hadir_p($idhrm_event) {
		$sesi=trim($this->input->post("sesiaktif"));
		$crypt=trim($this->input->post("crypt"));
		$kodeabsen=md5(trim($this->input->post("kodeabsen")));
		//die;
		if($crypt==$kodeabsen){
			 $data = array(
						"hadir"=> 1,
						"konfirmasi"=> 1,
						"tanggalhadir".$sesi=> $this->dbx->cts(),
						"modified_date"=> $this->dbx->cts(),
						"modified_by"=> $this->session->userdata('idpegawai'));
				$result = $this->hrm_event_sign_db->ubahhadir_db($data,$idhrm_event,$this->session->userdata('idpegawai')) ;

				//die;
				if ($result == TRUE) {
					redirect('hrm_event/view/2/'.$idhrm_event);
					//redirect('hrm_event');
				} else {
					$data['error']='Errorr...';
					redirect('hrm_event_sign');
				}
		}else{
			$this->session->set_flashdata("errortoken","Kode Token Salah");
			redirect('hrm_event_sign/hadir_v/'.$idhrm_event);
		}
	}

	public function konfirmasi_p($idhrm_event,$idpegawai,$konfirmasi=0) {
	 $data = array(
				"konfirmasi"=> $konfirmasi,
				"modified_date"=> $this->dbx->cts(),
				"modified_by"=> $this->session->userdata('idpegawai'));
		$result = $this->hrm_event_sign_db->ubahkonfirmasi_db($data,$idhrm_event,$idpegawai) ;
		if ($result == TRUE) {
			redirect('hrm_event_sign');
			//redirect('hrm_event');
		} else {
			$data['error']='Errorr...';
			redirect('hrm_event_sign');
		}
	}

	public function testpeserta_p($ubah,$tipe,$id) {
		$data['form']='Quiz Pelatihan';
		$data['form_small']='View';
		$data['view']='nilaievent';
		if ($tipe=="pretest"){
			$data['view2']='pretest';
			$data['action']='hrm_event_sign/simpantest_p/pretest/'.$id;
		}else if ($tipe=="posttest") {
			$data['view2']='posttest';
			$data['action']='hrm_event_sign/simpantest_p/posttest/'.$id;
		}
		$data['ubah']=$ubah;
		$data= $this->hrm_event_sign_db->view_db($id,$tipe,$data);

		$this->load->view('hrm_event_sign_v',$data);
	}


	public function simpantest_p($tipe,$id){
		if ($tipe=="pretest"){
			$this->hrm_event_sign_db->hapuspretest_db($id,$this->session->userdata('idpegawai'));
		}

		$idhrm_event_test=preg_split("/[\s,]+/", $this->input->post("idhrm_event_test"));
		//echo var_dump($idhrm_event_test);die;
		foreach((array)$idhrm_event_test as $rowtest) {
			$data = array(
					"idhrm_event" => $id,
					"idhrm_event_test" => $rowtest,
					"idpegawai"=> $this->session->userdata('idpegawai'),
					"modified_date"=> $this->dbx->cts(),
					"modified_by"=> $this->session->userdata('idpegawai')
				);
				if ($tipe=="pretest"){
						$data = $this->p_c->arraymerge(array('pretest' => $this->input->post('radio'.$rowtest)), $data);
						$data = $this->p_c->arraymerge(array('created_date' => $this->dbx->cts()), $data);
						$data = $this->p_c->arraymerge(array('created_by' => $this->session->userdata('idpegawai')), $data);
						$result = $this->hrm_event_sign_db->simpanpretest_db($data);
				}else if ($tipe=="posttest"){
						$data = $this->p_c->arraymerge(array('posttest' => $this->input->post('radio'.$rowtest)), $data);
						$result = $this->hrm_event_sign_db->ubahpretest_db($data,$id,$rowtest);
				}
		}
		$result=$this->hrm_event_sign_db->updatetestpeserta_db($tipe,$id,count($idhrm_event_test));
		//die;
		if ($result == TRUE) {
			redirect('hrm_event_sign');
			//redirect('hrm_event');
		} else {
			$data['error']='Errorr...';
			redirect('hrm_event_sign');
		}

	}

	public function nilaievent_p($ubah,$tipe,$id) {
		$data['form']='Penilaian Pelatihan';
		$data['form_small']='View';
		$data['view']='nilaievent';
		$data['view2']='nilaievent';
		$data['ubah']=$ubah;
		$data['action']='hrm_event_sign/simpanevaluasipeserta_p/'.$tipe.'/'.$id;
		$data= $this->hrm_event_sign_db->view_db($id,$tipe,$data);

		$this->load->view('hrm_event_sign_v',$data);
	}



	public function simpanevaluasipeserta_p($tipe,$id){
		$this->hrm_event_sign_db->hapusskorpeserta_db($id,$this->session->userdata('idpegawai'),$tipe);
		$idhrm_event_evaluation=preg_split("/[\s,]+/", $this->input->post("idhrm_event_evaluation"));
		foreach((array)$idhrm_event_evaluation as $rowid) {
			$data = array(
					"tipe" => $tipe,
					"idhrm_event" => $id,
					"idhrm_event_evaluation" => $rowid,
					"idpegawai" => $this->session->userdata('idpegawai'),
					"skor" =>$this->input->post('skor'.$rowid),
					"deskripsinilai" =>$this->input->post('deskripsinilai'.$rowid),
					"created_date"=> $this->dbx->cts(),
					"created_by"=> $this->session->userdata('idpegawai'),
					"modified_date"=> $this->dbx->cts(),
					"modified_by"=> $this->session->userdata('idpegawai')
				);
				$result = $this->hrm_event_sign_db->simpanskorpeserta_db($data);
		}

		if ($result == TRUE) {
			redirect('hrm_event_sign');
			//redirect('hrm_event');
		} else {
			$data['error']='Errorr...';
			redirect('hrm_event_sign');
		}

	}
}//end of class
?>
