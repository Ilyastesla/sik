<?php

session_start(); //we need to start session in order to access it through CI

Class ppkb_closing extends CI_Controller {

public function __construct() {
	parent::__construct();

		// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');


		// Load session library
		$this->load->library('session');

		// Load database
		$this->load->model('ppkb_closing_db');

   if( $this->session->userdata('logged_in')) {
       if($this->dbx->checkpage($this->session->userdata('role_id'),'ppkb_closing')==false){
          redirect('user_authentication');
       }
		}else{
			redirect('user_authentication');;
		}

	}

	public function index()
	{
			$data['show_table'] = $this->ppkb_closing_db->data();
			$data['form']='Penutupan Kas Kecil';
			$data['view']='index';
			$this->load->view('ppkb_closing_v', $data);
	}


	public function view($id) {
		$data['form']='Penutupan Kas Kecil';
		$data['form_small']='Lihat';
		$data['view']='view';
		$data= $this->ppkb_closing_db->view_db($id,$data);
		$data['action']='ppkb_closing/ubahstatus_p/'.$id;
		$this->load->view('ppkb_closing_v',$data);
	}

	public function ubahstatus_p($id,$stat='') {
		$data = array(
				"closed"=> "1",
				"jumlah_kaskecil"=> $this->input->post("jumlah_realisasi"),
				"modified_date"=> $this->dbx->cts(),
				"modified_by"=> $this->session->userdata('idpegawai'));
		$result = $this->ppkb_closing_db->ubah($data,$id) ;
		if ($result == TRUE) {
			redirect('ppkb_closing/view/'.$id);
		} else {
			$data['error']='Errorr...';
			$this->material($id,$data);
		}
	}
}//end of class
?>
