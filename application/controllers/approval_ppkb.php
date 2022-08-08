<?php

session_start(); //we need to start session in order to access it through CI

Class approval_ppkb extends CI_Controller {

public function __construct() {
	parent::__construct();

		// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');


		// Load session library
		$this->load->library('session');

		// Load database
		$this->load->model('approval_ppkb_db');

		if( $this->session->userdata('logged_in')) {
			if($this->dbx->checkpage($this->session->userdata('role_id'),'approval_ppkb')==false){
					redirect('user_authentication');
			}
		}else{
			redirect('user_authentication');
		}
	}

	public function index()
	{
		$data['show_table'] = $this->approval_ppkb_db->data();
		$data['form']='Persetujuan PPKB';
		$data['view']='index';
		$this->load->view('approval_ppkb_v', $data);
	}

	//VIEW
	//-------------------------------------------------------------------------------------------

	public function view($id,$stat='') {
		$data['form']='Pengajuan Pengeluaran Kas Besar';
		$data['form_small']='Persetujuan';
		$data['view']='view';
		$data['action']='approval_ppkb/approve_p/'.$id;
		$data['idx']=$id;
		$data= $this->approval_ppkb_db->view_db($id,$data);
		$this->load->view('approval_ppkb_v',$data);
	}

	//APPROVE
	//-------------------------------------------------------------------------------------------
	public function approve_p($id='') {
		$next_node=$this->dbx->next_node($this->input->post("status"),"ppkb");
	  	$data2 = array(
				"idapprover"=> $this->input->post("approver"),
				"idsumber"=> $id,
				"idmodul"=> "PPKB",
				"node"=> $this->input->post("status"),
				"next_node"=> $next_node,
				"modified_date"=> $this->dbx->cts(),
				"modified_by"=> $this->session->userdata('idpegawai'));

		$result = $this->approval_ppkb_db->loa_history($data2) ;

	  	$data = array(
				"approver"=> $this->session->userdata('idpegawai'),
				"next_approver"=> $this->input->post("approver"),
				"status"=> $next_node,
				"modified_date"=> $this->dbx->cts(),
				"modified_by"=> $this->session->userdata('idpegawai'));

		$result = $this->approval_ppkb_db->ubah($data,$id) ;
		if ($result == TRUE) {
			redirect('approval_ppkb/view/'.$id);
		} else {
			$data['error']='Errorr...';
			$this->ubah($id,$data);
		}
	}


	//REJECT
	//-------------------------------------------------------------------------------------------
	public function reject($id='',$statusx) {
		$next_node='R';
	  	$data2 = array(
				"idapprover"=> $this->session->userdata('idpegawai'),
				"idsumber"=> $id,
				"idmodul"=> "PPKB",
				"node"=> $statusx,
				"next_node"=> $next_node,
				"modified_date"=> $this->dbx->cts(),
				"modified_by"=> $this->session->userdata('idpegawai'));

		$result = $this->approval_ppkb_db->loa_history($data2) ;

	  	$data = array(
				"approver"=> $this->session->userdata('idpegawai'),
				"status"=> $next_node,
				"modified_date"=> $this->dbx->cts(),
				"modified_by"=> $this->session->userdata('idpegawai'));

		$result = $this->approval_ppkb_db->ubah($data,$id);
		if ($result == TRUE) {
			redirect('approval_ppkb/view/'.$id);
		} else {
			$data['error']='Errorr...';
			$this->ubah($id,$data);
		}
	}
	//HAPUS
	//-------------------------------------------------------------------------------------------
	public function hapus($id) {
		$result = $this->approval_ppkb_db->hapus($id) ;
		if ($result == TRUE) {
			redirect('/approval_ppkb');
		}
	}


}//end of class
?>
