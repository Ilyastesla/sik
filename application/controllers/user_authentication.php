<?php

session_start(); //we need to start session in order to access it through CI

Class user_authentication extends CI_Controller {

public function __construct() {
	parent::__construct();
	if($this->config->item("maintenance")<>1){
			// Load form helper library
			$this->load->helper('form');

			// Load form validation library
			$this->load->library('form_validation');

			// Load session library
			$this->load->library('session');

			// Load database
			$this->load->model('user_authentication_db');
		}

	}

public function index()
{
	$data=NULL;
	if($this->config->item("maintenance")=="1"){
		redirect('/main/maintenance');
	}else{
		$data['idcompany_opt'] = $this->dbx->opt("SELECT replid,nama as nama FROM hrm_company WHERE aktif=1 ORDER BY kodecabang",'up',1);
		$data['form']='Masuk';
		$data['action']='user_authentication/user_login_process';
		if( $this->session->userdata('logged_in') ) redirect('/main');
		else $this->load->view('user_authentication_v',$data);
	}
}

// Check for user login process
public function user_login_process() {
	$ip=$this->input->ip_address();
	$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
	$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
	$username=preg_replace("/[^a-zA-Z0-9]/","",$this->input->post('username'));
	//echo $this->form_validation->run();
	//die;
	if ($this->form_validation->run() == FALSE) {
		$data_history=array(
				"username"=> $username
				,"action"=>'Percobaan Hack'
				,"ip"=>$ip
				,"date"=>$this->dbx->cts()
				,"application"=>$this->config->item('app_name')
		);
		$this->user_authentication_db->tambahhistory_db($data_history);
		$this->session->set_flashdata("error_message","Percobaan Hack");
		redirect('user_authentication');
	} else {
		$data = array(
		    'username' => $username,
		    'password' => $this->input->post('password')
		    );

		//DATABASE
		//$result = $this->user_authentication_db->login($data);
		//if($result == TRUE){
			$sess_array = array(
				'username' => $username,
				'password' => $this->input->post('password')
				);
			$result = $this->user_authentication_db->read_user_information($sess_array);
			//echo $result;die;
			if($result != false){
				if ($result->status_pegawai<>1){
					$this->session->set_flashdata("error_message","Pegawai Tidak Aktif");
					redirect('user_authentication');
				}else if ($result->aktif<>1){
					$this->session->set_flashdata("error_message","Nama Pengguna Tidak Aktif");
					redirect('user_authentication');
				}else{
						//harusnya cek kontrak disini
						//cek terdaftar di perusahaan apa
						/*
						$resultcompany = $this->user_authentication_db->readcompany($this->input->post('idcompany'),$result->idcompany);
						if($resultcompany == FALSE){
							$data_history=array(
									"username"=> $username
									,"action"=>'Tidak terdaftar di perusahaan yang dipilih'
									,"ip"=>$ip
									,"date"=>$this->dbx->cts()
									,"application"=>$this->config->item('app_name')
							);
							$this->user_authentication_db->tambahhistory_db($data_history);
							$this->session->set_flashdata("error_message","Tidak terdaftar di perusahaan yang dipilih");
							redirect('user_authentication');
						}else{
							*/
							$data_history=array(
								"username"=> $username
								,"action"=>'Login'
								,"ip"=>$ip
								,"date"=>$this->dbx->cts()
								,"application"=>$this->config->item('app_name')
							);
							$this->user_authentication_db->tambahhistory_db($data_history);

							$datalogin=array(
								"online"=>1
							);
							$this->user_authentication_db->ubahonline($datalogin,$username) ;


							$session_kelas=$result->kelas;
							//$session_kelas="";

							$resultkelas = $this->user_authentication_db->read_kelas($username);
							if (!$resultkelas==false){
								foreach((array)$resultkelas as $rowkelas) {
										if ($session_kelas<>""){
											$session_kelas=$session_kelas.",".$rowkelas->replid;
										}else{
											$session_kelas=$rowkelas->replid;
										}
								}
							}

							if ($session_kelas==""){
									$session_kelas='NULL';
							}

							$dept='NULL';
							if($result->departemen<>""){
								$dept=$result->departemen;
							}

							$matpel='NULL';
							if($result->matpel<>""){
								$matpel=$result->matpel;
							}

							$role_id='NULL';
							if($result->role_id<>""){
								$role_id=$result->role_id;
							}


							//echo $session_kelas;die;
							//'idcompany' =>$resultcompany->replid,
							//'companytext'=>$resultcompany->nama,
							
							$data = array(
					    		'logged_in'=>1,
								'nip' =>trim($result->nip),
								'nama' =>$result->nama,
								'panggilan' =>$result->panggilan,
								'idcompany' =>$result->idcompany,
								'role_id' =>$role_id,
								'role' =>$result->role,
								'dept' =>$dept,
								'matpel' =>$matpel,
								'kelas' =>$session_kelas,
								'idpegawai' =>$result->id_pegawai,
								'fotodisplay' =>$result->fotodisplay
					        );

					     // Add user data in session
					     $this->session->set_userdata($data);
					     //$this->load->view('admin_page');
						    redirect('/main');
						//} //$resultcompany
			 } //$result->status_pegawai
			//}
		}else{
			$data_history=array(
					"username"=> $username
					,"action"=>'Password/Username Error'
					,"ip"=>$ip
					,"date"=>$this->dbx->cts()
					,"application"=>$this->config->item('app_name')

			);
			$this->user_authentication_db->tambahhistory_db($data_history);
			$this->session->set_flashdata("error_message","Nama Pengguna atau Kata Sandi Salah");
			redirect('user_authentication');
		}
	}
}


// Logout from admin page
public function logout() {
	$ip=$this->input->ip_address();
    $data_history=array(
				"username"=> $this->session->userdata('nip')
				,"action"=>'Logout'
				,"ip"=>$ip
				,"date"=>$this->dbx->cts()
				,"application"=>$this->config->item('app_name')

			);
	$this->user_authentication_db->tambahhistory_db($data_history);
	// Removing session data
	$datalogin=array(
		"online"=>0
	);
	$this->user_authentication_db->ubahonline($datalogin,$this->session->userdata('nip')) ;
	/*
	$data = array(
		    	'logged_in'=>'',
		        'nip' =>'',
		        'nama' =>'',
		        'role_id' =>'',
		        'role' =>'',
		        'dept' =>'',
		        'kelas' =>'',
		        'matpel' =>'',
		        'idpegawai' =>''
		        ,'idrapottipe' =>''
		        ,'idprosestipe' =>''
		        ,'idtahunajaran'=>''
		        ,'idkelas'=>''
		        ,'idregion'=>''
		        ,'idmatpel'=>''
		        ,'idperiode'=>''
		        ,'created_by'=>''
		        );
	$this->session->unset_userdata($data);
	*/
	$this->session->sess_destroy();
	$this->session->set_flashdata("error_message","Berhasil Keluar, Sesi Terhapus");
	redirect('user_authentication');
	//$this->load->view('user_authentication_v', $data);
}

}

?>
