<?php
session_start(); //we need to start session in order to access it through CI
Class reff_user_nilai extends CI_Controller {
	public function __construct() {
	parent::__construct();
		// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');


		// Load session library
		$this->load->library('session');

		// Load database
		$this->load->model('reff_user_nilai_db');

		$this->load->library('p_c');

   if( $this->session->userdata('logged_in')) {
       if($this->dbx->checkpage($this->session->userdata('role_id'),'reff_user_nilai')==false){
          redirect('user_authentication');
       }
		}else{
			redirect('user_authentication');;
		}

	}

	//---------------------------------------------------------------------------------------------------------
	//------------------------------------------------------------------------------------------------- INDEX
	//---------------------------------------------------------------------------------------------------------

	public function index(){
		$data = $this->reff_user_nilai_db->data();
		$data['type']=1;
		$data['form']='Atur Tutor';
		$data['view']='index';
		$this->load->view('reff_user_nilai_v', $data);
	}


	public function ubahuser($id='') {
		$data['form']='Atur Tutor';
		$data['view']='ubahuser';
		$data['action']='reff_user_nilai/ubahuser_p/'.$id;
		$data= $this->reff_user_nilai_db->ubahuser_db($id,$data);
		$this->load->view('reff_user_nilai_v',$data);
	}

	public function viewuser($id='') {
		$data['form']='Atur Tutor';
		$data['view']='ubahuser';
		$data['viewview']=1;
		//$data['pass']=$pass;
		$data['action']='reff_user_nilai/ubahuser_p/'.$id;
		$data= $this->reff_user_nilai_db->ubahuser_db($id,$data);
		$this->load->view('reff_user_nilai_v',$data);
	}

	public function ubahuser_p($id) {
		$data = array(
				'matpel' => $this->p_c->arrdump($this->input->post('matpel'))
				,'kelas' => $this->p_c->arrdump($this->input->post('kelas'))
				,'modified_date' =>$this->dbx->cts()
				,'modified_by' => $this->session->userdata('idpegawai')
				);
		$result = $this->reff_user_nilai_db->ubahuser_p_db($data,$id) ;
		if ($result == TRUE) {
			redirect('reff_user_nilai/viewuser/'.$id);
		} else {
			$data['error']='Errorr...';
			$this->ubahuser($id,$data);
		}
	}

} //end of class
?>
