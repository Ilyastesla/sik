<?php

session_start(); //we need to start session in order to access it through CI

Class leave extends CI_Controller {

public function __construct() {
	parent::__construct();

		// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');


		// Load session library
		$this->load->library('session');

		// Load database
		$this->load->model('leave_db');

		$this->load->library('p_c');

		if( $this->session->userdata('logged_in')) {
			if($this->dbx->checkpage($this->session->userdata('role_id'),'leave')==false){
					redirect('user_authentication');
			}
		}else{
			redirect('user_authentication');;
		}
	}
	//---------------------------------------------------------------------------------------------------------
	//----------------------------------------------------------------------------------------------- LEAVE
	//---------------------------------------------------------------------------------------------------------

	public function index(){
		$data['type']=1;
		$data['form']='Izin';
		$data['view']='index';
		$data= $this->leave_db->leave_table($data);
		$this->load->view('leave_v', $data);
	}

	public function ubahleave($id='') {
		$data['form']='Tipe Izin';
		$data['view']='ubah_leave';
		$data['action']='leave/ubahleave_p/'.$id;
		$data= $this->leave_db->ubahleave_db($id,$data);
		$this->load->view('leave_v',$data);
	}


	public function ubahleave_p($id='') {
		$jadwal=explode("-", $this->input->post('jadwal'));
		$begin_date=$this->dbx->date_string($jadwal[0]);
		$end_date=$this->dbx->date_string($jadwal[1]);
		//echo $this->dbx->cts();die;

		$data = array(
				'pegawai_id' => $this->input->post('pegawai_id')
				,'leave_type_id' => $this->input->post('leave_type_id')
				,'begin_date' => $begin_date
				,'end_date' => $end_date
				,'keterangan' => $this->input->post('keterangan')
				,'aktif' => $this->input->post('aktif')
				,'modified_date' =>$this->dbx->cts()
				,'modified_by' => $this->session->userdata('idpegawai')
				);
		if ($id<>""){
			$data = $this->p_c->arraymerge(array('approved' => '62'), $data);
			$result = $this->leave_db->ubahleave_p_db($data,$id) ;
		}else{
			$data = $this->p_c->arraymerge(array('approved' => '59'), $data);
			$data = $this->p_c->arraymerge(array('created_date' => $this->dbx->cts()), $data);
			$data = $this->p_c->arraymerge(array('created_by' => $this->session->userdata('idpegawai')), $data);
			$result = $this->leave_db->tambahleave_p_db($data);
		}

		if ($result == TRUE) {
			redirect('leave/leave');
		} else {
			$data['error']='Errorr...';
			$this->ubahleave($id,$data);
		}
	}

	public function hapusleave_p($id) {
		$result = $this->leave_db->hapusleave_p_db($id) ;
		if ($result == TRUE) {
			redirect('leave/leave');
		}
	}

	//---------------------------------------------------------------------------------------------------------
	//---------------------------------------------------------------------------------------------- LEAVE TYPE
	//---------------------------------------------------------------------------------------------------------

	public function leave_type(){
		$data['type']=1;
		$data['form']='Tipe Izin';
		$data['view']='leave_type';
		$data= $this->leave_db->leave_type_table($data);
		$this->load->view('leave_v', $data);
	}

	public function ubahleavetype($id='') {
		$data['form']='Tipe Izin';
		$data['view']='ubah_leave_type';
		$data['action']='leave/ubahleavetype_p/'.$id;
		$data= $this->leave_db->ubahleavetype_db($id,$data);
		$this->load->view('leave_v',$data);
	}


	public function ubahleavetype_p($id='') {
		$data = array(
				'reff' => $this->input->post('reff')
				,'aktif' => $this->input->post('aktif')
				,'type' => '9'
				);
		if ($id<>""){
			$result = $this->leave_db->ubahleavetype_p_db($data,$id) ;
		}else{
			$result = $this->leave_db->tambahleavetype_p_db($data);
		}

		if ($result == TRUE) {
			redirect('leave/leave_type');
		} else {
			$data['error']='Errorr...';
			$this->ubahleavetype($id,$data);
		}
	}

	public function hapusleavetype_p($id) {
		$result = $this->leave_db->hapusleavetype_p_db($id) ;
		if ($result == TRUE) {
			redirect('leave/leave_type');
		}
	}
}//end of class
?>
