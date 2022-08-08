<?php
session_start(); //we need to start session in order to access it through CI
Class reff_user extends CI_Controller {
	public function __construct() {
	parent::__construct();
		// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');


		// Load session library
		$this->load->library('session');

		// Load database
		$this->load->model('reff_user_db');

		$this->load->library('p_c');

   if( $this->session->userdata('logged_in')) {
       if($this->dbx->checkpage($this->session->userdata('role_id'),'reff_user')==false){
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
		$data= $this->reff_user_db->data();
		$data['action']='reff_user';
		$data['type']=1;
		$data['form']='Pengguna';
		$data['view']='index';
		$this->load->view('reff_user_v', $data);
	}


	public function ubahuser($id='') {
		$data['form']='Pengguna';
		$data['view']='ubahuser';
		$data['action']='reff_user/ubahuser_p/'.$id;
		$data= $this->reff_user_db->ubahuser_db($id,$data);
		$this->load->view('reff_user_v',$data);
	}

	public function ubahuser_p($id='') {
		//,'keterangan' => $this->input->post('keterangan')
		//,'kelas' => $this->p_c->arrdump($this->input->post('kelas'))
		//,'matpel' => $this->p_c->arrdump($this->input->post('matpel'))
		$idpegawaidb=0;$nipdb="";
		if($this->input->post('nip')<>""){
				$iddb=explode('|',$this->input->post('nip'));
				$idpegawaidb=$iddb[0];
				$nipdb=$iddb[1];
		}
		
		$data = array(
				'login' => $nipdb
				,'idcompany' => $this->p_c->arrdump($this->input->post('idcompany'))
				,'role_id' => $this->p_c->arrdump($this->input->post('role'))
				,'departemen' => $this->p_c->arrdump($this->input->post('departemen'))
				,'aktif' => $this->input->post('aktif')
				,'modified_date' =>$this->dbx->cts()
				,'modified_by' => $this->session->userdata('idpegawai')
				);
		if ($id<>""){
			if ($this->input->post('reset')==1){
				$pass = $this->dbx->randomchar(10);
				$datapass = array( 'passtext'=>$pass);
				$this->session->set_userdata($datapass);
				$data = $this->p_c->arraymerge(array('password' => md5($pass)), $data);
			}
			$result = $this->dbx->ubahdata('login',$data,'replid',$id) ;
		}else{
			//if ($this->input->post('password')<>$this->input->post('password2')){
			//	redirect('reff_user/ubahuser');die;
			//}else{
				$pass = $this->dbx->randomchar(10);
				$datapass = array( 'passtext'=>$pass);
				$this->session->set_userdata($datapass);

				//$data = $this->p_c->arraymerge(array('login' => $this->input->post('nip')), $data);
				$data = $this->p_c->arraymerge(array('idpegawai' => $idpegawaidb), $data);
				$data = $this->p_c->arraymerge(array('password' => md5($pass)), $data);
				$data = $this->p_c->arraymerge(array('created_date' => $this->dbx->cts()), $data);
				$data = $this->p_c->arraymerge(array('created_by' => $this->session->userdata('idpegawai')), $data);
				$id = $this->dbx->tambahdata('login',$data);
				if ($id<>""){$result=TRUE;}
			//}
		}


		if ($result == TRUE) {
			if ($this->input->post('reset')<>1){
				?><script>
						window.opener.location.reload();
						window.close();
					</script>
				<?php
			}else{
					redirect('reff_user/viewuser/'.$id);
			}
		} else {
			$data['error']='Errorr...';
			$this->ubahuser($id,$data);
		}
	}

	public function viewuser($id='') {
		$data['form']='Pengguna';
		$data['view']='ubahuser';
		$data['viewview']=1;
		//$data['pass']=$pass;
		$data['action']='reff_user/ubahuser_p/'.$id;
		$data= $this->reff_user_db->ubahuser_db($id,$data);
		$this->load->view('reff_user_v',$data);
	}

	public function printsdk($id) {
		$data['form']='PRINT SDK';
		$data= $this->reff_user_db->ubahuser_db($id,$data);
		$this->load->view('user_print_sdk_v',$data);
		$datapass = array( 'passtext'=>"");
		$this->session->unset_userdata($datapass);
	}

	public function hapususer_p($id) {
		$result = $this->reff_user_db->hapususer_p_db($id) ;
		if ($result == TRUE) {
			?><script>
					window.opener.location.reload();
					window.close();
				</script>
			<?php
		}
	}

} //end of class
?>
