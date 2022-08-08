<?php

session_start(); //we need to start session in order to access it through CI

Class departemen extends CI_Controller {

public function __construct() {
	parent::__construct();

		// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');


		// Load session library
		$this->load->library('session');

		// Load database
		$this->load->model('departemen_db');

		if( $this->session->userdata('logged_in')) {
			if($this->dbx->checkpage($this->session->userdata('role_id'),'departemen')==false){
					redirect('user_authentication');
			}
		}else{
			redirect('user_authentication');;
		}

	}

	public function index()
	{
			$data = $this->departemen_db->data();
			$data['form']='Departemen';
			$data['view']='index';
			$data['action']='departemen';
			$this->load->view('departemen_v', $data);
	}


	// TAMBAH
	//-------------------------------------------------------------------------------------------
	public function tambah($id='') {
		$data['form']='Departemen';
		$data['form_small']='Tambah Data';
		$data['view']='tambah';
		$data['action']='departemen/tambah_p';
		$data= $this->departemen_db->tambah_x($data,$id);
		$this->load->view('departemen_v',$data);
	}

	public function tambah_p($id='') {
	    //"penerima"=> $this->input->post("penerima"),
	    //"tanggalpenerima"=> $this->input->post("tanggalpenerima"),
			//"kodedepartemen"=> $this->input->post("kodedepartemen"),
		$data = array(
				"idcompany"=> $this->input->post("idcompany"),
				"departemen"=> $this->input->post("departemen"),
				"aktif"=> $this->input->post("aktif"),
				"modified_date"=> $this->dbx->cts(),
				"modified_by"=> $this->session->userdata('idpegawai'));
		if ($id<>""){
			$result = $this->departemen_db->ubah($data,$id) ;
		}else{
			$data = $this->p_c->arraymerge(array('created_date' => $this->dbx->cts()), $data);
			$data = $this->p_c->arraymerge(array('created_by' => $this->session->userdata('idpegawai')), $data);
			$result = $this->departemen_db->tambah($data);
			if ($result<>false){$id=$result;}
		}
		//echo $result;die;
		if ($result == TRUE) {
			?><script>
					window.opener.location.reload();
					window.close();
				</script>
			<?php
		} else {
			$data['error']='Errorr...Cek Kode Departemen, Kemungkinan terdapat Kode Departemen yang sama';
			if ($id<>""){
				$this->ubah($id,$data);
			}else{
				$this->tambah('',$data);
			}
		}
	}

	// UBAH
	//-------------------------------------------------------------------------------------------
	public function ubah($id,$stat='') {
		$data['form']='Departemen';
		$data['form_small']='Ubah Data';
		$data['view']='tambah';
		$data['action']='departemen/tambah_p/'.$id;
		$data= $this->departemen_db->tambah_x($data,$id);
		$this->load->view('departemen_v',$data);
	}

	public function hapus($id) {
		$result = $this->departemen_db->hapus_db($id) ;
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
