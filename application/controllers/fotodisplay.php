<?php

session_start(); //we need to start session in order to access it through CI

Class fotodisplay extends CI_Controller {

public function __construct() {
	parent::__construct();

		// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');


		// Load session library
		$this->load->library('session');

		// Load database
		$this->load->model('fotodisplay_db');

		if( $this->session->userdata('logged_in')) {
			
		}else{
			redirect('user_authentication');;
		}

	}

	public function index()
	{
			$data['form']='Foto Display';
			$data['form_small']='Ubah Data';
			$data['view']='index';
			$data['action']='fotodisplay/upload_it/';
			$data= $this->fotodisplay_db->index($data);
			$this->load->view('fotodisplay_v', $data);
	}

	//ATTACHMENT
	function upload_it($file) {
		//load the helper
		$this->load->helper('form');

		//Configure
		//set the path where the files uploaded will be copied. NOTE if using linux, set the folder to permission 777
		$config['upload_path'] = "uploads/fotodisplay";
		if ($file<>""){
			$path="uploads/fotodisplay/".$file;
			delete_files($path);
			unlink($path);
		}

		// set the filter image types
		$config['allowed_types'] = 'gif|jpg|png';
		$config['encrypt_name'] = TRUE;

		//load the upload library
		$this->load->library('upload', $config);
		$this->upload->initialize($config);

		$this->upload->set_allowed_types('*');

		$data['upload_data'] = '';

		//if not successful, set the error message
		if (!$this->upload->do_upload()) {
			$data = array('msg' => $this->upload->display_errors());
			echo $this->upload->display_errors();
			$result = $this->fotodisplay_db->ubah($data2,$this->session->userdata('idpegawai')) ;
			redirect('fotodisplay');
			die;
		} else { //else, set the success message
			$data = array('msg' => "Upload success!");
			$data['upload_data'] = $this->upload->data();
			$file=$this->upload->data();
			$data2= array(
						//"file"=>$_FILES['userfile']['name'],
						"fotodisplay"=>$file['file_name']
					);
			$result = $this->fotodisplay_db->ubah($data2,$this->session->userdata('idpegawai')) ;
		}

		redirect('fotodisplay');
	}

}//end of class
?>
