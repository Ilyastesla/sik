<?php

session_start(); //we need to start session in order to access it through CI
Class inventory extends CI_Controller {
	public function __construct() {
	parent::__construct();

		// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');


		// Load session library
		$this->load->library('session');

		// Load database
		$this->load->model('inventory_db');

		$this->load->library('p_c');

		if( $this->session->userdata('logged_in')) {
			if($this->dbx->checkpage($this->session->userdata('role_id'),'inventory')==false){
					redirect('user_authentication');
			}
		}else{
			redirect('user_authentication');;
		}
	}

	//---------------------------------------------------------------------------------------------------------
	//------------------------------------------------------------------------------------------------- KELOMPOK
	//---------------------------------------------------------------------------------------------------------

	public function kelompok(){
		$data['type']=1;
		$data['form']='Kelompok Barang';
		$data['view']='kelompok';
		$data= $this->inventory_db->inventory_table($data);
		$this->load->view('inventory_v', $data);
	}

	public function ubahinventory($id='') {
		$data['form']='Kelompok Barang';
		$data['view']='ubahinventory';
		$data['action']='inventory/ubahinventory_p/'.$id;
		$data= $this->inventory_db->ubahinventory_db($id,$data);
		$this->load->view('inventory_v',$data);
	}



	public function ubahinventory_p($id='') {
		$data = array(
				'nama' => $this->input->post('nama')
				,'keterangan' => $this->input->post('keterangan')
				,'parent' => $this->input->post('parent')
				,'idfiskal' => $this->input->post('idfiskal')
				,'aktif' => $this->input->post('aktif')
				,'modified_date' =>$this->dbx->cts()
				,'modified_by' => $this->session->userdata('idpegawai')
				);
		if ($id<>""){

			$result = $this->inventory_db->ubahinventory_p_db($data,$id) ;
		}else{
			$data = $this->p_c->arraymerge(array('created_date' => $this->dbx->cts()), $data);
			$data = $this->p_c->arraymerge(array('created_by' => $this->session->userdata('idpegawai')), $data);

			$kodekelompok=$this->dbx->kodekelompok();
			$data = $this->p_c->arraymerge(array('kode' => $kodekelompok), $data);
			$result = $this->inventory_db->tambahinventory_p_db($data);
		}

		if ($result == TRUE) {
			redirect('inventory/kelompok');
		} else {
			$data['error']='Errorr...';
			$this->ubahinventory($id,$data);
		}
	}

	public function hapusinventory_p($id) {
		$result = $this->inventory_db->hapusinventory_p_db($id) ;
		if ($result == TRUE) {
			redirect('inventory/kelompok');
		}
	}
} //end of class
?>
