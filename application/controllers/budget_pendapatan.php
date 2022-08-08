<?php

session_start(); //we need to start session in order to access it through CI

Class budget_pendapatan extends CI_Controller {

public function __construct() {
	parent::__construct();

		// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');


		// Load session library
		$this->load->library('session');

		// Load database
		$this->load->model('budget_pendapatan_db');

   if( $this->session->userdata('logged_in')) {
       if($this->dbx->checkpage($this->session->userdata('role_id'),'budget_pendapatan')==false){
          redirect('user_authentication');
       }
		}else{
			redirect('user_authentication');;
		}

	}

	public function index()
	{
			$data['show_table'] = $this->budget_pendapatan_db->data();
			$data['form']='Budget Pendapatan';
			$data['view']='index';
			$this->load->view('budget_pendapatan_v', $data);
	}


	// TAMBAH
	//-------------------------------------------------------------------------------------------
	public function tambah($id='') {
		$data['form']='Budget Pendapatan';
		$data['form_small']='Tambah Data';
		$data['view']='tambah';
		$data['action']='budget_pendapatan/tambah_p';
		$data= $this->budget_pendapatan_db->tambah_x($id,$data);
		$this->load->view('budget_pendapatan_v',$data);
	}

	public function tambah_p($id='') {
	    //"penerima"=> $this->input->post("penerima"),
	    //"tanggalpenerima"=> $this->input->post("tanggalpenerima"),
		$data = array(
				"budget_pendapatan"=> $this->input->post("budget_pendapatan"),
				"type"=> $this->input->post("type"),
        "idhead"=> $this->input->post("idhead"),
        "urutan"=> $this->input->post("urutan"),
				"aktif"=> $this->input->post("aktif"),
				"modified_date"=> $this->dbx->cts(),
				"modified_by"=> $this->session->userdata('idpegawai'));
		if ($id<>""){
			$result = $this->dbx->ubahdata('budget_pendapatan',$data,'replid',$id);
		}else{
			$data = $this->p_c->arraymerge(array('created_date' => $this->dbx->cts()), $data);
			$data = $this->p_c->arraymerge(array('created_by' => $this->session->userdata('idpegawai')), $data);
			$id = $this->dbx->tambahdata('budget_pendapatan',$data);
			if ($id<>""){$result=TRUE;}
		}

		if ($result == TRUE) {
      ?><script>
					window.opener.location.reload();
					window.close();
				</script>
			<?php
		} else {
			$data['error']='Errorr...';
			$this->ubah($id,$data);
		}
	}

	// UBAH
	//-------------------------------------------------------------------------------------------
	public function ubah($id,$stat='') {
		$data['form']='Budget Pendapatan';
		$data['form_small']='Ubah Data';
		$data['view']='tambah';
		$data['action']='budget_pendapatan/tambah_p/'.$id;
		$data= $this->budget_pendapatan_db->tambah_x($id,$data);
		$this->load->view('budget_pendapatan_v',$data);
	}

	public function hapus($id) {
		$result = $this->dbx->hapusdata('budget_pendapatan','replid',$id);
		if ($result == TRUE) {
      ?><script>
					window.opener.location.reload();
					window.close();
				</script>
			<?php
		}
	}


}//end of class
?>
