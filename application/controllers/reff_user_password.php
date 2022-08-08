<?php
session_start(); //we need to start session in order to access it through CI
Class reff_user_password extends CI_Controller {
	public function __construct() {
	parent::__construct();
		// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');


		// Load session library
		$this->load->library('session');

		// Load database
		$this->load->model('reff_user_password_db');

		$this->load->library('p_c');

   if( $this->session->userdata('logged_in')) {
       if($this->dbx->checkpage($this->session->userdata('role_id'),'reff_user_password')==false){

  		 		redirect('user_authentication');
		 	 }
		}else{
			redirect('user_authentication');;
		}

	}

	public function index($sukses="") {
		$data['form']='Pengguna Password';
		$data['view']='index';
		$data['action']='reff_user_password/ganti_password_p/';
		$data= $this->reff_user_password_db->ganti_password_db($data);
		$this->load->view('reff_user_password_v',$data);
	}

	public function ganti_password_p() {
		$result = $this->reff_user_password_db->read_user_information();
		if (($result != false) and ($this->input->post('password')==$this->input->post('password2'))){
			$data2 = array(
				'password' => md5($this->input->post('password'))
				,'modified_date' =>$this->dbx->cts()
				,'modified_by' => $this->session->userdata('idpegawai')
				);
			$result = $this->reff_user_password_db->ubahpassword_p_db($data2);
			if ($result != false){
				$this->session->set_flashdata('notif', 'Password Anda Berhasil Diubah');
        $this->session->set_flashdata('notiftype', 'success');
        $this->session->set_flashdata('notificon', 'check');
			}else{
        $this->session->set_flashdata('notif', 'Password Anda Salah');
        $this->session->set_flashdata('notiftype', 'danger');
        $this->session->set_flashdata('notificon', 'ban');
			}
		}else{
      $this->session->set_flashdata('notif', 'Password Anda Salah');
      $this->session->set_flashdata('notiftype', 'danger');
      $this->session->set_flashdata('notificon', 'ban');
		}
    redirect('reff_user_password');
	}
} //end of class
?>
