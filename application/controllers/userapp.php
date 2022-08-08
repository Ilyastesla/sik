<?php

session_start(); //we need to start session in order to access it through CI
Class userapp extends CI_Controller {
	public function __construct() {
	parent::__construct();

		// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');


		// Load session library
		$this->load->library('session');

		// Load database
		$this->load->model('user_db');

		$this->load->library('p_c');

   if( $this->session->userdata('logged_in')) {
       if($this->dbx->checkpage($this->session->userdata('role_id'),'userapp')==false){
          redirect('user_authentication');
       }
		}else{
			redirect('user_authentication');;
		}

	}

	//---------------------------------------------------------------------------------------------------------
	//------------------------------------------------------------------------------------------------- INDEX
	//---------------------------------------------------------------------------------------------------------

	public function user_hrm(){
		$data['type']=1;
		$data['form']='Pengguna';
		$data['view']='index';
		$data= $this->user_db->user_table($data);
		$this->load->view('user_v', $data);
	}


	public function ubahuser($id='') {
		$data['form']='Pengguna';
		$data['view']='ubahuser';
		$data['action']='userapp/ubahuser_p/'.$id;
		$data= $this->user_db->ubahuser_db($id,$data);
		$this->load->view('user_v',$data);
	}

	public function viewuser($id='') {
		$data['form']='Pengguna';
		$data['view']='ubahuser';
		$data['viewview']=1;
		//$data['pass']=$pass;
		$data['action']='userapp/ubahuser_p/'.$id;
		$data= $this->user_db->ubahuser_db($id,$data);
		$this->load->view('user_v',$data);
	}

	public function printsdk($id) {
		$data['form']='PRINT SDK';
		$data= $this->user_db->ubahuser_db($id,$data);
		$this->load->view('user_print_sdk_v',$data);
		$datapass = array( 'passtext'=>"");
		$this->session->unset_userdata($datapass);
	}


	public function ubahuser_p($id='') {
		$data = array(
				'role_id' => $this->p_c->arrdump($this->input->post('role'))
				,'departemen' => $this->p_c->arrdump($this->input->post('departemen'))
				,'kelas' => $this->p_c->arrdump($this->input->post('kelas'))
				,'matpel' => $this->p_c->arrdump($this->input->post('matpel'))
				,'keterangan' => $this->input->post('keterangan')
				,'aktif' => $this->input->post('aktif')
				,'modified_date' =>$this->dbx->cts()
				,'modified_by' => $this->session->userdata('nip')
				);
		if ($id<>""){
			if ($this->input->post('reset')==1){
				$pass = $this->dbx->randomchar(10);
				$datapass = array( 'passtext'=>$pass);
				$this->session->set_userdata($datapass);
				$data = $this->p_c->arraymerge(array('password' => md5($pass)), $data);
			}
			$result = $this->user_db->ubahuser_p_db($data,$id) ;
		}else{
			//if ($this->input->post('password')<>$this->input->post('password2')){
			//	redirect('userapp/ubahuser');die;
			//}else{
				$pass = $this->dbx->randomchar(10);
				$datapass = array( 'passtext'=>$pass);
				$this->session->set_userdata($datapass);

				$data = $this->p_c->arraymerge(array('password' => md5($pass)), $data);
				$data = $this->p_c->arraymerge(array('login' => $this->input->post('nip')), $data);
				$data = $this->p_c->arraymerge(array('created_date' => $this->dbx->cts()), $data);
				$data = $this->p_c->arraymerge(array('created_by' => $this->session->userdata('nip')), $data);
				$id = $this->user_db->tambahuser_p_db($data);
				if ($id<>""){$result=TRUE;}
			//}
		}

		if ($result == TRUE) {
			redirect('userapp/viewuser/'.$id);
		} else {
			$data['error']='Errorr...';
			$this->ubahuser($id,$data);
		}
	}

	public function ganti_password($id='') {
		$id=$this->session->userdata('id_pegawai');
		$data['form']='Pengguna';
		$data['view']='ganti_password';
		$data['action']='userapp/ganti_password_p/'.$id;
		$data= $this->user_db->ganti_password_db($id,$data);
		$this->load->view('user_v',$data);
	}

	public function ganti_password_p($id='') {
		$id=$this->session->userdata('id_pegawai');
		$passwordlama=$this->input->post('passwordlama');
		$password=$this->input->post('password');
		$password2=$this->input->post('password2');
		$nip=$this->input->post('nip');
		$sess_array = array(
				'username' => $id,
				'password' => $passwordlama
				);
		$result = $this->user_db->read_user_information($sess_array);
		if (($result != false) and ($password==$password2)){
			$data2 = array(
				'password' => md5($this->input->post('password'))
				,'modified_date' =>$this->dbx->cts()
				,'modified_by' => $this->session->userdata('nip')
				);
			$result = $this->user_db->ubahpassword_p_db($data2,$nip) ;
			$data['success']='Password Anda Berhasil Diubah';
			$this->ganti_password($id,$data);
		}else{
			$data['error']='Password Anda Salah';
			$this->ganti_password($id,$data);
		}
	}

	public function hapususer_p($id) {
		$result = $this->user_db->hapususer_p_db($id) ;
		if ($result == TRUE) {
			redirect('userapp/user_hrm');
		}
	}
} //end of class
?>
