<?php

session_start(); //we need to start session in order to access it through CI

Class salary extends CI_Controller {

public function __construct() {
	parent::__construct();

		// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');


		// Load session library
		$this->load->library('session');

		// Load database
		$this->load->model('salary_db');

		$this->load->library('p_c');

   if( $this->session->userdata('logged_in')) {
       if($this->dbx->checkpage($this->session->userdata('role_id'),'salary')==false){
          redirect('user_authentication');
       }
		}else{
			redirect('user_authentication');;
		}

	}

	//---------------------------------------------------------------------------------------------------------
	//------------------------------------------------------------------------------------------------- ALLOWANCE
	//---------------------------------------------------------------------------------------------------------

	public function allowance(){
		$data['type']=1;
		$data['form']='Tunjangan';
		$data['view']='allowance';
		$data= $this->salary_db->allowance_table($data);
		$this->load->view('salary_v', $data);
	}

	public function ubahallowance($id='') {
		$data['form']='Tunjangan';
		$data['view']='ubahallowance';
		$data['action']='salary/ubahallowance_p/'.$id;
		$data= $this->salary_db->ubahallowance_db($id,$data);
		$this->load->view('salary_v',$data);
	}



	public function ubahallowance_p($id='') {
		$data = array(
				'nama' => $this->input->post('nama')
				,'keterangan' => $this->input->post('keterangan')
				,'aktif' => $this->input->post('aktif')
				,'modified_date' =>$this->dbx->cts()
				,'modified_by' => $this->session->userdata('idpegawai')
				);
		if ($id<>""){
			$result = $this->salary_db->ubahallowance_p_db($data,$id) ;
		}else{
			$data = $this->p_c->arraymerge(array('created_date' => $this->dbx->cts()), $data);
			$data = $this->p_c->arraymerge(array('created_by' => $this->session->userdata('idpegawai')), $data);
			$result = $this->salary_db->tambahallowance_p_db($data);
		}

		if ($result == TRUE) {
			redirect('salary/allowance');
		} else {
			$data['error']='Errorr...';
			$this->ubahallowance($id,$data);
		}
	}

	public function hapusallowance_p($id) {
		$result = $this->salary_db->hapusallowance_p_db($id) ;
		if ($result == TRUE) {
			redirect('salary/allowance');
		}
	}

	//---------------------------------------------------------------------------------------------------------
	//------------------------------------------------------------------------------------------------- DEDUCTION
	//---------------------------------------------------------------------------------------------------------

	public function deduction(){
		$data['type']=1;
		$data['form']='Potongan';
		$data['view']='deduction';
		$data= $this->salary_db->deduction_table($data);
		$this->load->view('salary_v', $data);
	}

	public function ubahdeduction($id='') {
		$data['form']='Potongan';
		$data['view']='ubahdeduction';
		$data['action']='salary/ubahdeduction_p/'.$id;
		$data= $this->salary_db->ubahdeduction_db($id,$data);
		$this->load->view('salary_v',$data);
	}



	public function ubahdeduction_p($id='') {
		$data = array(
				'nama' => $this->input->post('nama')
				,'keterangan' => $this->input->post('keterangan')
				,'aktif' => $this->input->post('aktif')
				,'modified_date' =>$this->dbx->cts()
				,'modified_by' => $this->session->userdata('idpegawai')
				);
		if ($id<>""){
			$result = $this->salary_db->ubahdeduction_p_db($data,$id) ;
		}else{
			$data = $this->p_c->arraymerge(array('created_date' => $this->dbx->cts()), $data);
			$data = $this->p_c->arraymerge(array('created_by' => $this->session->userdata('idpegawai')), $data);
			$result = $this->salary_db->tambahdeduction_p_db($data);
		}

		if ($result == TRUE) {
			redirect('salary/deduction');
		} else {
			$data['error']='Errorr...';
			$this->ubahdeduction($id,$data);
		}
	}

	public function hapusdeduction_p($id) {
		$result = $this->salary_db->hapusdeduction_p_db($id) ;
		if ($result == TRUE) {
			redirect('salary/deduction');
		}
	}

	//---------------------------------------------------------------------------------------------------------
	//------------------------------------------------------------------------------------------------- SALARY
	//---------------------------------------------------------------------------------------------------------

	public function index(){
		$data['form']='Gaji';
		$data['view']='index';
		$data= $this->salary_db->salary_table($data);
		$this->load->view('salary_v', $data);
	}

	public function ubahsalary($id='') {
		$data['form']='Gaji';
		$data['view']='ubahsalary';
		$data['action']='salary/ubahsalary_p/'.$id;
		$data= $this->salary_db->ubahsalary_db($id,$data);
		$this->load->view('salary_v',$data);
	}

	//---------------------------------------------------------------------------------------------------------
	//---------------------------------------------------------------------------------------- ALLOWANCE PEGAWAI
	//---------------------------------------------------------------------------------------------------------

	public function ubah_user_allowance($id='',$iduserallowance='') {
		$data['form']='Pendapatan Pegawai';
		$data['view']='ubahuserallowance';
		$data['id']=$id;
		$data['action']='salary/ubahuserallowance_p/'.$id.'/'.$iduserallowance;
		$data= $this->salary_db->ubahuserallowance_db($id,$iduserallowance,$data);
		$this->load->view('salary_v',$data);
	}

	public function ubahuserallowance_p($id_pegawai,$id='') {
		$data = array(
				'pegawai_id' => $id_pegawai
				,'type_id' => $this->input->post('type_id')
				,'allowance_id' => $this->input->post('allowance_id')
				,'effective_date' => $this->p_c->tgl_db($this->input->post('effective_date'))
				,'nilai' => $this->input->post('nilai')
				,'modified_date' =>$this->dbx->cts()
				,'modified_by' => $this->session->userdata('idpegawai')
				);
		if ($id<>""){
			$result = $this->salary_db->ubahuserallowance_p_db($data,$id) ;
		}else{
			$data = $this->p_c->arraymerge(array('created_date' => $this->dbx->cts()), $data);
			$data = $this->p_c->arraymerge(array('created_by' => $this->session->userdata('idpegawai')), $data);
			$result = $this->salary_db->tambahuserallowance_p_db($data);
		}

		if ($result == TRUE) {
			redirect('salary/ubahsalary/'.$id_pegawai);
		} else {
			$data['error']='Errorr...';
			$this->ubahdeduction($id,$data);
		}
	}

	public function hapususerallowance_p($id_pegawai,$id) {
		$result = $this->salary_db->hapususerallowance_p_db($id) ;
		if ($result == TRUE) {
			redirect('salary/ubahsalary/'.$id_pegawai);
		}
	}
	//---------------------------------------------------------------------------------------------------------
	//---------------------------------------------------------------------------------------- DEDUCTION PEGAWAI
	//---------------------------------------------------------------------------------------------------------

	public function ubah_user_deduction($id='',$iduserdeduction='') {
		$data['form']='Pendapatan Pegawai';
		$data['view']='ubahuserdeduction';
		$data['id']=$id;
		$data['action']='salary/ubahuserdeduction_p/'.$id.'/'.$iduserdeduction;
		$data= $this->salary_db->ubahuserdeduction_db($id,$iduserdeduction,$data);
		$this->load->view('salary_v',$data);
	}

	public function ubahuserdeduction_p($id_pegawai,$id='') {
		$data = array(
				'pegawai_id' => $id_pegawai
				,'type_id' => $this->input->post('type_id')
				,'deduction_id' => $this->input->post('deduction_id')
				,'effective_date' => $this->p_c->tgl_db($this->input->post('effective_date'))
				,'nilai' => $this->input->post('nilai')
				,'modified_date' =>$this->dbx->cts()
				,'modified_by' => $this->session->userdata('idpegawai')
				);
		if ($id<>""){
			$result = $this->salary_db->ubahuserdeduction_p_db($data,$id) ;
		}else{
			$data = $this->p_c->arraymerge(array('created_date' => $this->dbx->cts()), $data);
			$data = $this->p_c->arraymerge(array('created_by' => $this->session->userdata('idpegawai')), $data);
			$result = $this->salary_db->tambahuserdeduction_p_db($data);
		}

		if ($result == TRUE) {
			redirect('salary/ubahsalary/'.$id_pegawai);
		} else {
			$data['error']='Errorr...';
			$this->ubahdeduction($id,$data);
		}
	}

	public function hapususerdeduction_p($id_pegawai,$id) {
		$result = $this->salary_db->hapususerdeduction_p_db($id) ;
		if ($result == TRUE) {
			redirect('salary/ubahsalary/'.$id_pegawai);
		}
	}
}//end of class
?>
