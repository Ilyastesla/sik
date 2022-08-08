<?php

session_start(); //we need to start session in order to access it through CI

Class pegawai_exit_letter extends CI_Controller {

public function __construct() {
	parent::__construct();

		// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');


		// Load session library
		$this->load->library('session');

		// Load database
		$this->load->model('pegawai_exit_db');

   if( $this->session->userdata('logged_in')) {
       if($this->dbx->checkpage($this->session->userdata('role_id'),'pegawai_exit_letter')==false){
          redirect('user_authentication');
       }
		}else{
			redirect('user_authentication');;
		}
	}

	public function index()
	{
			//$data['show_table'] = $this->pegawai_exit_db->data();
			$data['form']='Exit Interview Cetak Surat';
			$data['view']='pegawai_exit_letter';
			$data['action']='pegawai_exit_letter';
      $data= $this->pegawai_exit_db->data($data);
			$this->load->view('pegawai_exit_v', $data);
	}

  // TAMBAH
	//-------------------------------------------------------------------------------------------
	public function tambahletter($id) {
		$data['form']='Exit Interview Cetak Surat';
		$data['form_small']='Ubah Data';
		$data['view']='tambahletter';
		$data['action']='pegawai_exit_letter/tambahletter_p/'.$id;
		$data= $this->pegawai_exit_db->tambah_db($id,$data);
		$this->load->view('pegawai_exit_v',$data);
	}

  public function tambahletter_p($id) {
    if ($this->input->post("selesai")<>"1"){
      $status=2;
    }else{
      $result = $this->ubahstatuspegawai_p($this->input->post("idpegawai"),0) ;
  		$result = $this->ubahstatuslogin_p($this->input->post("idpegawai"),0) ;
      $status=4;
    }

		$data = array(
                    "no_sk" => $this->input->post("no_sk")
                    ,"tanggal_bekerja"=>$this->p_c->tgl_db($this->input->post("tanggal_bekerja"))
                    ,"tanggal_surat"=>$this->p_c->tgl_db($this->input->post("tanggal_surat"))
                    ,"status" => $status
                    ,"modified_date"=> $this->dbx->cts()
                    ,"modified_by"=> $this->session->userdata('idpegawai')
                );
		$result = $this->dbx->ubahdata('hrm_pegawai_exit',$data,'replid',$id) ;


    if ($result == TRUE) {
      redirect('pegawai_exit_letter/view/'.$id);
		} else {
			$data['error']='Errorr...';
			$this->tambahletter($id,$data);
		}
	}

  public function view($id,$stat='') {
		$data['form']='Exit Interview';
		$data['form_small']='Lihat';
		$data['view']='view';
    $data['print']='1';
		$data['action']='pegawai_exit/terima_p/'.$id;
		$data= $this->pegawai_exit_db->view_db($id,$data);
		$this->load->view('pegawai_exit_v',$data);
	}

  public function printpegawai_exit($id,$word)
  {
    $data['form']='Pegawai Exit';
    $data['form_small']='Print';
    $data['word']=$word;
    $data= $this->pegawai_exit_db->view_db($id,$data);
    $this->load->view('pegawai_exit_print_v',$data);
  }

	public function ubahstatuspegawai_p($id,$stat) {
		$data = array(
				"aktif"=> $stat,
				"modified_date"=> $this->dbx->cts(),
				"modified_by"=> $this->session->userdata('idpegawai'));
		$result = $this->dbx->ubahdata('pegawai',$data,'replid',$id);
		return $result;
	}

	public function ubahstatuslogin_p($id,$stat) {
		$data = array(
				"aktif"=> $stat,
				"modified_date"=> $this->dbx->cts(),
				"modified_by"=> $this->session->userdata('idpegawai'));
		$result = $this->dbx->ubahdata('login',$data,'idpegawai',$id);
		return $result;
	}

}//end of class
?>
