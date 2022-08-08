<?php

session_start(); //we need to start session in order to access it through CI

Class budget_reff extends CI_Controller {

public function __construct() {
	parent::__construct();

		// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');


		// Load session library
		$this->load->library('session');

		// Load database
		$this->load->model('budget_reff_db');

   if( $this->session->userdata('logged_in')) {
       if($this->dbx->checkpage($this->session->userdata('role_id'),'budget_reff')==false){
          redirect('user_authentication');
       }
		}else{
			redirect('user_authentication');;
		}

	}

	public function index()
	{
			$data['show_table'] = $this->budget_reff_db->data();
			$data['form']='Referensi Budget';
			$data['view']='index';
			$this->load->view('budget_reff_v', $data);
	}


	// TAMBAH
	//-------------------------------------------------------------------------------------------
	public function tambah($id='') {
		$data['form']='Referensi Budget';
		$data['form_small']='Tambah Data';
		$data['view']='tambah';
		$data['action']='budget_reff/tambah_p';
		$data= $this->budget_reff_db->tambah_x($id,$data);
		$this->load->view('budget_reff_v',$data);
	}

	public function tambah_p($id='') {
	    //"penerima"=> $this->input->post("penerima"),
	    //"tanggalpenerima"=> $this->input->post("tanggalpenerima"),
		$data = array(
				"budget_reff"=> $this->input->post("budget_reff"),
				"type"=> $this->input->post("type"),
        "idhead"=> $this->input->post("idhead"),
        "urutan"=> $this->input->post("urutan"),
				"aktif"=> $this->input->post("aktif"),
				"modified_date"=> $this->dbx->cts(),
				"modified_by"=> $this->session->userdata('idpegawai'));
		if ($id<>""){
			$result = $this->dbx->ubahdata('budget_reff',$data,'replid',$id);
		}else{
			$data = $this->p_c->arraymerge(array('created_date' => $this->dbx->cts()), $data);
			$data = $this->p_c->arraymerge(array('created_by' => $this->session->userdata('idpegawai')), $data);
			$id = $this->dbx->tambahdata('budget_reff',$data);
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
		$data['form']='Referensi Budget';
		$data['form_small']='Ubah Data';
		$data['view']='tambah';
		$data['action']='budget_reff/tambah_p/'.$id;
		$data= $this->budget_reff_db->tambah_x($id,$data);
		$this->load->view('budget_reff_v',$data);
	}

	public function hapus($id) {
		$result = $this->dbx->hapusdata('budget_reff','replid',$id);
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
