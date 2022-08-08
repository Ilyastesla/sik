<?php

session_start(); //we need to start session in order to access it through CI

Class hrm_pegawai_attachment extends CI_Controller {

public function __construct() {
	parent::__construct();

		// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');


		// Load session library
		$this->load->library('session');

		// Load database
		$this->load->model('hrm_pegawai_attachment_db');

    if( $this->session->userdata('logged_in')) {
    }else{
      redirect('main');;
    }

	}

	public function index()
	{
			$data['show_table'] = $this->hrm_pegawai_attachment_db->data();
			$data['form']='Dokumen';
			$data['view']='index';
			$this->load->view('hrm_pegawai_attachment_v', $data);
	}

	public function tambah($id='') {
		$data['form']='Dokumen';
		$data['form_small']='Tambah Data';
		$data['view']='tambah';
		$data= $this->hrm_pegawai_attachment_db->tambahattachment_db($data);
		$data['action']='hrm_pegawai_attachment/tambahattachment_p/';
		$this->load->view('hrm_pegawai_attachment_v',$data);
	}

	function tambahattachment_p() {
		$this->load->helper('form');

		$config['upload_path'] = 'uploads/pegawai';
		$config['allowed_types'] = 'gif|jpg|png|docs|pdf|doc|xls|xl';
		$config['encrypt_name'] = TRUE;

		$this->load->library('upload', $config);
		$this->upload->initialize($config);
		$this->upload->set_allowed_types('*');
		$data['upload_data'] = '';

		if (!$this->upload->do_upload()) {
			$data = array('msg' => $this->upload->display_errors());
			echo $this->upload->display_errors();
			die;
		} else { //else, set the success message
			$data = array('msg' => "Upload success!");
			$data['upload_data'] = $this->upload->data();
			$file=$this->upload->data();
			$data2= array(
						"idpegawai_calon"=>$this->session->userdata('idregistrasi'),
						"file"=>$_FILES['userfile']['name'],
						"newfile"=>$file['file_name'],
						"iddokumentipe"=> $this->input->post("iddokumentipe"),
						'created_date' => $this->dbx->cts(),
						'created_by' => $this->session->userdata('idpegawai')
					);
			$result = $this->dbx->tambahdata('hrm_pegawai_calon_attachment',$data2) ;
		}
		redirect('hrm_pegawai_attachment');
	}

	public function hapusattachment_p($id,$file) {
		$path="uploads/pegawai/".$file;

		$this->load->helper("file");
		delete_files($path);
		unlink($path);

		$result = $this->dbx->hapusdata('hrm_pegawai_calon_attachment','replid',$id);

		redirect('hrm_pegawai_attachment');
	}
}//end of class
?>
