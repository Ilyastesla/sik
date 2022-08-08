<?php

session_start(); //we need to start session in order to access it through CI

Class kp_konseling extends CI_Controller {

public function __construct() {
parent::__construct();

		// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');


		// Load library
		$this->load->library('session');

		// Load database
		$this->load->model('kp_konseling_db');

		if( $this->session->userdata('logged_in')) {
			if($this->dbx->checkpage($this->session->userdata('role_id'),'kp_konseling')==false){
					redirect('user_authentication');
			}
		}else{
			redirect('user_authentication');;
		}

	}

	public function index($print="",$excel="")
	{
			$data= $this->kp_konseling_db->data();
			$data['form']='Layanan Konseling';
			$data['view']='index';
			$data['action']='kp_konseling';
			$data['tambah']=0;
            $this->load->view('kp_konseling_v', $data);
	}

    // TAMBAH
	//-------------------------------------------------------------------------------------------
	public function tambah2($id,$idx='') {
		$data['form']='Layanan Konseling';
		$data['form_small']='Tambah Data';
		$data['view']='tambah2';
        $data['action']='kp_konseling/tambah_p/'.$id.'/'.$idx;
		$data= $this->kp_konseling_db->view_db($data,$id,$idx);
		$this->load->view('kp_konseling_v',$data);
	}

    public function tambah_p($id,$idx='') {
		
		$data = array(
			"modified_date"=> $this->dbx->cts()
			,"modified_by"=> $this->session->userdata('idpegawai')
			,"idkonseling"=>$id
			,"fase"=>1
			,"tanggalkonseling"=> $this->p_c->tgl_db($this->input->post('tanggalkonseling'))
			,"hasilkonseling" => $this->input->post("hasilkonseling")
			,"rencanatindaklanjut" => $this->input->post("rencanatindaklanjut")
			,"tanggalakhirtindakan"=> $this->p_c->tgl_db($this->input->post('tanggalakhirtindakan'))
		);

        
		if ($idx<>""){
			$result = $this->dbx->ubahdata('kp_konselingreport',$data,'replid',$idx) ;
		}else{
			$data = $this->p_c->arraymerge(array('created_date' => $this->dbx->cts()), $data);
			$data = $this->p_c->arraymerge(array('created_by' => $this->session->userdata('idpegawai')), $data);
			$idx = $this->dbx->tambahdata('kp_konselingreport',$data);
			if ($idx<>""){$result=TRUE;}
		}
		if ($result == TRUE) {
			$data = array(
				"modified_date"=> $this->dbx->cts()
				,"modified_by"=> $this->session->userdata('idpegawai')
				,"status"=>2
			);
			$result = $this->dbx->ubahdata('kp_konseling',$data,'replid',$id);
			redirect('kp_konseling/view/'.$id);
		} else {
			$data['error']='Errorr...';
			redirect('ns_rapor_baru/tambah/'.$id);
		}
	}

	public function view($id) {
		$data['form']='Laporan Kejadian';
		$data['form_small']='Tambah Data';
		$data['view']='view';
        $data['action']='kp_konseling';
		$data= $this->kp_konseling_db->view_db($data,$id);
		$this->load->view('kp_konseling_v',$data);
	}

	public function tambaheva($id,$idx) {
		$data['form']='Layanan Konseling';
		$data['form_small']='Tambah Data';
		$data['view']='tambaheva';
        $data['action']='kp_konseling/tambaheva_p/'.$id.'/'.$idx;
		$data= $this->kp_konseling_db->view_db($data,$id,$idx);
		$this->load->view('kp_konseling_v',$data);
	}

	public function tambaheva_p($id,$idx) {
		
		$data = array(
			"modified_date"=> $this->dbx->cts()
			,"modified_by"=> $this->session->userdata('idpegawai')
			,"fase"=>2
			,"evaluasitindakan" => $this->input->post("evaluasitindakan")
			,"idkategorievaluasi" => $this->input->post("idkategorievaluasi")
			,"tutup" => $this->input->post("tutup")
						
		);
		$result = $this->dbx->ubahdata('kp_konselingreport',$data,'replid',$idx) ;
		if ($result == TRUE) {
			if($this->input->post("tutup")){
				$data = array(
					"modified_date"=> $this->dbx->cts()
					,"modified_by"=> $this->session->userdata('idpegawai')
					,"status"=>4
				);
				$result = $this->dbx->ubahdata('kp_konseling',$data,'replid',$id);
			}
			
			redirect('kp_konseling/view/'.$id);
		} else {
			$data['error']='Errorr...';
			redirect('ns_rapor_baru/tambah/'.$id);
		}
	}
}//end of class
?>
