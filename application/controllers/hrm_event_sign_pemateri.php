<?php

session_start(); //we need to start session in order to access it through CI

Class hrm_event_sign_pemateri extends CI_Controller {

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

	}

	public function nilaievent_p($ubah,$tipe,$id) {
		$data['form']='Rundown Pelatihan';
		$data['form_small']='View';
		$data['view']='nilaievent';
		$data['view2']='nilaievent';
		$data['ubah']=$ubah;
		$data['action']='hrm_event_sign_pemateri/simpanevaluasipeserta_p/'.$tipe.'/'.$id;
		$data= $this->hrm_event_sign_db->view_db($id,$tipe,$data);

		$this->load->view('hrm_event_sign_pemateri_v',$data);
	}



	public function simpanevaluasipeserta_p($tipe,$id){
		$rowpemateri=$this->dbx->rows("SELECT idpemateri FROM hrm_event_pemateri WHERE no_register='".$this->input->post("no_register")."'");
		$idpemateri=$rowpemateri->idpemateri;
		$this->hrm_event_sign_db->hapusskorpeserta_db($id,$idpemateri,$tipe);
		$idhrm_event_evaluation=preg_split("/[\s,]+/", $this->input->post("idhrm_event_evaluation"));

		foreach((array)$idhrm_event_evaluation as $rowid) {
			$data = array(
					"tipe" => $tipe,
					"idhrm_event" => $id,
					"idhrm_event_evaluation" => $rowid,
					"idpegawai" => $idpemateri,
					"skor" =>$this->input->post('skor'.$rowid),
					"deskripsinilai" =>$this->input->post('deskripsinilai'.$rowid),
					"created_date"=> $this->dbx->cts(),
					"modified_date"=> $this->dbx->cts()
				);
				$result = $this->hrm_event_sign_db->simpanskorpeserta_db($data);
		}

		if ($result == TRUE) {
			redirect('hrm_event_sign_pemateri/finish_p/1');
		} else {
			redirect('hrm_event_sign_pemateri/finish_p/0');
		}
	}

	public function finish_p($stat) {
		$data['form']='Rundown Pelatihan';
		$data['form_small']='View';
		$data['view']='finish';
		$data['stat']=$stat;
		$this->load->view('hrm_event_sign_pemateri_v',$data);
	}
}//end of class
?>
