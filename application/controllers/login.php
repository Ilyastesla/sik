<?php

session_start(); //we need to start session in order to access it through CI

Class login extends CI_Controller {

public function __construct() {
parent::__construct();
	// Load database
	$this->load->model('login_db');

}

public function index()
{
	if( $this->session->userdata('logged_in')) {
		redirect("pegawai");
	}else{

	}
	//$data = $this->login_db->data();
	$data['form']='E-Recruitement PT.KPP';
	$data['form_small']='Login';
	$data['action']='login/user_login_process';
	$capthca=$this->p_c->create_captcha_p();
	$data['captcha']=$capthca['image'];
	$this->session->set_userdata('captchalogin',$capthca['word']);
	$this->load->view('login_v', $data);
}

// Check for user login process
public function user_login_process() {
	//echo $this->session->userdata('captchalogin').'    '.$this->input->post('captchaword');die;
	$captchatext=$this->session->userdata('captchalogin');
	//$captchatext='HSKS2020';
	$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
	$username=preg_replace("/[^a-zA-Z0-9]/","",$this->input->post('username'));
	$ip=$this->input->ip_address();
	//echo $this->session->userdata('captchalogin')<>$this->input->post('captchaword');die;
	if($captchatext<>$this->input->post('captchaword')) {
		$this->session->sess_destroy('captchalogin');
		$data_history=array(
				"username"=> $username
				,"action"=>'Salah Captcha'
				,"ip"=>$ip
				,"date"=>$this->dbx->cts()
				,"application"=>$this->config->item('app_name')
		);
		$this->login_db->tambahhistory_db($data_history);
		$this->session->set_flashdata("errorlogin","Kesalahan Pada Pengisian Captcha");
		redirect('login');
	}else{
					//$this->session->sess_destroy('captchalogin');
					if ($this->form_validation->run() == FALSE) {
						$data_history=array(
								"username"=> $username
								,"action"=>'Percobaan Hack'
								,"ip"=>$ip
								,"date"=>$this->dbx->cts()
								,"application"=>$this->config->item('app_name')
						);
						$this->login_db->tambahhistory_db($data_history);
						$this->session->set_flashdata("errorlogin","Percobaan Hack");
						redirect('login');
					} else {
							$result = $this->login_db->read_user_information($username);
							if($result != false){
									$data_history=array(
										"username"=> $username
										,"action"=>'Login'
										,"ip"=>$ip
										,"date"=>$this->dbx->cts()
										,"application"=>$this->config->item('app_name')
									);
									$this->login_db->tambahhistory_db($data_history);

									$data = array(
							    	'logged_in'=>1,
							        'noktp' =>trim($result->noktp),
							        'nama' =>$result->nama,
							        'panggilan' =>$result->panggilan,
							        'idregistrasi' =>$result->replid,
							        'fotodisplay' =>$result->fotodisplay
							        );
							     $this->session->set_userdata($data);
									 //echo $this->session->userdata('logged_in');die;
								    redirect('/main');die;
						}else{ //if($result != false){
							$data_history=array(
									"username"=> $username
									,"action"=>'Password/Username Error'
									,"ip"=>$ip
									,"date"=>$this->dbx->cts()
									,"application"=>$this->config->item('app_name')
							);
							$this->login_db->tambahhistory_db($data_history);
							$this->session->set_flashdata("errorlogin","Nama Pengguna atau Kata Sandi Salah");
						    redirect('login');
						}
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
	$this->login_db->tambahhistory_db($data_history);
	// Removing session data
	$datalogin=array(
		"online"=>0
	);
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
	$data['message_display'] = 'Successfully Logout';
	redirect("login");
}

}

?>
