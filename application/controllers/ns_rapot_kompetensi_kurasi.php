<?php

session_start(); //we need to start session in order to access it through CI

Class ns_rapot_kompetensi_kurasi extends CI_Controller {

public function __construct() {
parent::__construct();

		// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');


		// Load library
		$this->load->library('session');

		// Load database
		$this->load->model('ns_rapot_kompetensi_db');

		if( $this->session->userdata('logged_in')) {
			if($this->dbx->checkpage($this->session->userdata('role_id'),'ns_rapot_kompetensi')==false){
					redirect('user_authentication');
			}
		}else{
			redirect('user_authentication');;
		}

	}

	public function index()
	{
            $data['action']='ns_rapot_kompetensi_kurasi';
			$data= $this->ns_rapot_kompetensi_db->data($data);
			$data['form']='Kurasi Kompetensi';
			$data['view']='index';
			$this->load->view('ns_rapot_kompetensi_v', $data);
	}

	public function tambah($id='') {
		$data['form']='Kompetensi';
		$data['form_small']='Tambah Data';
		$data['view']='tambah';
		$data['link']='ns_rapot_kompetensi_kurasi';
		$data['action']='ns_rapot_kompetensi_kurasi/tambah_p/'.$id;
		$data= $this->ns_rapot_kompetensi_db->tambah_db($id,$data);
		$this->load->view('ns_rapot_kompetensi_v',$data);
	}
	
	public function tambah_p($id='') {
		$kompetensitext=$this->input->post("kompetensitext");
		//"idcompany" => $this->input->post("idcompany"),
				
		foreach((array)$kompetensitext as $rowkompetensitext) {
			unset($data);
			if($rowkompetensitext<>""){
				$data = array(
					"idtahunajaran" => $this->input->post("idtahunajaran"),
					"idtingkat" => $this->input->post("idtingkat"),
					"idmatpel" => $this->input->post("idmatpel"),
					"idperiode" => $this->input->post("idperiode"),
					"kompetensitext" => $rowkompetensitext,
					"aktif" => 1,
					"modified_date" => $this->dbx->cts(),
					"modified_by" => $this->session->userdata('idpegawai')
					);
				if ($id<>""){
					$result = $this->dbx->ubahdata('ns_rapot_kompetensi',$data,'replid',$id) ;
				}else{
					$data = $this->p_c->arraymerge(array('created_date' => $this->dbx->cts()), $data);
					$data = $this->p_c->arraymerge(array('created_by' => $this->session->userdata('idpegawai')), $data);
					$id_insert = $this->dbx->tambahdata('ns_rapot_kompetensi',$data) ;
					if ($id_insert<>""){$result=TRUE;}
				}
			}
			//echo $this->db->last_query();
		}
		
		//die;
		
        //echo $this->db->last_query();die;
		if ($result == TRUE) {
			?><script>
					window.opener.location.reload();
					window.close();
				</script>
			<?php
		} else {
			$data['error']="Errorr...";
			redirect('/ns_rapot_kompetensi_kurasi/tambah/'.$id);
		}
	}

}//end of class
?>