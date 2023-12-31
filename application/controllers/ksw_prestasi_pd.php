<?php

session_start(); //we need to start session in order to access it through CI

Class ksw_prestasi_pd extends CI_Controller {

public function __construct() {
parent::__construct();

		// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');


		// Load library
		$this->load->library('session');

		// Load database
		$this->load->model('ksw_prestasi_pd_db');

		if( $this->session->userdata('logged_in')) {
			if($this->dbx->checkpage($this->session->userdata('role_id'),'ksw_prestasi_pd')==false){
					redirect('user_authentication');
			}
		}else{
			redirect('user_authentication');;
		}

	}

	public function index()
	{
			$data= $this->ksw_prestasi_pd_db->data("ksw_prestasi_pd");
			$data['form']='Laporan Minat Bakat Peserta Didik';
			$data['view']='index';
			$data['action']='ksw_prestasi_pd';
			$data['tambah']=1;
            $this->load->view('ksw_prestasi_pd_v', $data);
	}

    // TAMBAH
	//-------------------------------------------------------------------------------------------
	public function tambah($id="") {
		$data['form']='Laporan Minat Bakat Peserta Didik';
		$data['form_small']='Tambah Data';
		$data['view']='tambah';
		$data['action']='ksw_prestasi_pd/tambah_p/'.$id;
		$data= $this->ksw_prestasi_pd_db->tambah_db($data,$id);
		$this->load->view('ksw_prestasi_pd_v',$data);
	}

    public function tambah_p($id='') {
		$idkelas=$this->dbx->singlerow("SELECT idkelas as isi FROM siswa WHERE replid='".$this->input->post('idsiswa')."'");
		//,'idmasalah' => $this->input->post('idmasalah')
        $data = array(
                "modified_date"=> $this->dbx->cts(),
                "modified_by"=> $this->session->userdata('idpegawai')
				,'idcompany' => $this->input->post('idcompany')
				,'iddepartemen' => $this->input->post('iddepartemen')
                ,'idkelas' => $idkelas
                ,'idsiswa' => $this->input->post('idsiswa')
                ,"tanggallaporan"=> $this->p_c->tgl_db($this->input->post('tanggallaporan'))
                ,'idjenislaporan' => $this->input->post('idjenislaporan')
                ,'idtempat' => $this->input->post('idtempat')
                ,'idprioritas' => $this->input->post('idprioritas')
                ,'latarbelakang' => str_replace('&nbsp;', ' ', $this->input->post('latarbelakang'))
                ,'status'=>1
                );
        
		if ($id<>""){
			$result = $this->dbx->ubahdata('ksw_prestasi_pd',$data,'replid',$id) ;
		}else{
			$data = $this->p_c->arraymerge(array('created_date' => $this->dbx->cts()), $data);
			$data = $this->p_c->arraymerge(array('created_by' => $this->session->userdata('idpegawai')), $data);
			$id = $this->dbx->tambahdata('ksw_prestasi_pd',$data);
			if ($id<>""){$result=TRUE;}
		}
		if ($result == TRUE) {
			redirect('ksw_prestasi_pd/view/'.$id);
		} else {
            $data['error']='Errorr...';
			redirect('ns_rapor_baru/tambah/'.$id);
		}
	}

    public function view($id) {
		$data['form']='Laporan Minat Bakat Peserta Didik';
		$data['form_small']='Tambah Data';
		$data['view']='view';
        $data['action']='ksw_prestasi_pd';
		$data= $this->ksw_prestasi_pd_db->view_db($data,$id);
		$this->load->view('ksw_prestasi_pd_v',$data);
	}
}//end of class
?>
