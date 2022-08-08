<?php

session_start(); //we need to start session in order to access it through CI

Class ksw_penempatan extends CI_Controller {

public function __construct() {
parent::__construct();

		// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');


		// Load library
		$this->load->library('session');

		// Load database
		$this->load->model('ksw_penempatan_db');

   if( $this->session->userdata('logged_in')) {
       if($this->dbx->checkpage($this->session->userdata('role_id'),'ksw_penempatan')==false){
          redirect('user_authentication');
       }
		}else{
			redirect('user_authentication');;
		}

	}

	public function index()
	{
			$data = $this->ksw_penempatan_db->data();
			$data['form']='Penempatan Peserta Didik';
			$data['view']='index';
			$data['action']='ksw_penempatan';
			$this->load->view('ksw_penempatan_v', $data);
	}

	public function import($idcalon) {
    $result = $this->ksw_penempatan_db->import($idcalon);
		if ($result == TRUE) {
			?><script>
					window.opener.location.reload();
					window.close();
				</script>
			<?php
		} else {
			echo "ERROR!!!!";
		}
	}

	public function hapussiswa($idcalon) {
    $result = $this->ksw_penempatan_db->hapussiswa_db($idcalon);
		if ($result == TRUE) {
			?><script>
					window.opener.location.reload();
					window.close();
				</script>
			<?php
		} else {
			echo "ERROR!!!!";
		}
	}
}//end of class
?>
