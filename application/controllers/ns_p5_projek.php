<?php

session_start(); //we need to start session in order to access it through CI

Class ns_p5_projek extends CI_Controller {

public function __construct() {
parent::__construct();

		// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');


		// Load session library
		$this->load->library('session');

		// Load database
		$this->load->model('ns_p5_projek_db');

		if( $this->session->userdata('logged_in')) {
			if($this->dbx->checkpage($this->session->userdata('role_id'),'ns_p5_projek')==false){
					redirect('user_authentication');
			}
		}else{
			redirect('user_authentication');;
		}

	}

	public function index()
	{
			$data= $this->ns_p5_projek_db->data();
			$data['action']='ns_p5_projek';
			$data['form']='Projek P5';
			$data['view']='index';
			$this->load->view('ns_p5_projek_v', $data);
	}

	// TAMBAH
	//-------------------------------------------------------------------------------------------
	public function tambah($id='') {
		$data['form']='Projek P5';
		$data['form_small']='Tambah Data';
		$data['view']='tambah';
		$data['action']='ns_p5_projek/tambah_p';
		$data= $this->ns_p5_projek_db->tambah_db($id,$data);
		$this->load->view('ns_p5_projek_v',$data);
	}

	public function tambah_p($id='') {
		$data = array(
				'idcompany' => $this->input->post('idcompany'),
				'projektext' => $this->input->post('projektext'),
				'idprojektipe' => $this->input->post('idprojektipe'),
				'idtema' => $this->input->post('idtema'),
				'fase' => $this->input->post('fase'),
				'keterangan' => $this->input->post('keterangan'),
				'nourut' => $this->input->post('nourut'),
				'aktif' => $this->input->post('aktif'),
				"modified_date"=> $this->dbx->cts(),
				"modified_by"=> $this->session->userdata('idpegawai'));

		if ($id<>""){
			$result = $this->dbx->ubahdata('ns_p5_projek',$data,'replid',$id);
        }else{
                $data = $this->p_c->arraymerge(array('created_date' => $this->dbx->cts()), $data);
                $data = $this->p_c->arraymerge(array('created_by' => $this->session->userdata('idpegawai')), $data);
                $id = $this->dbx->tambahdata('ns_p5_projek',$data);;
                if ($id<>""){$result=TRUE;}else{$result=false;}
        }
        //echo $this->db->last_query();die;
		if ($result == TRUE) {
			redirect('ns_p5_projek/capaian/'.$id);
		} else {
			$data['error']='Errorr...';
			$this->ubah($id,$data);
		}
	}

	// UBAH
	//-------------------------------------------------------------------------------------------
	public function ubah($id,$stat='') {
		$data['form']='Projek P5';
		$data['form_small']='Ubah Data';
		$data['view']='tambah';
		$data['action']='ns_p5_projek/tambah_p/'.$id;
		$data= $this->ns_p5_projek_db->tambah_db($id,$data);
		$this->load->view('ns_p5_projek_v',$data);
	}

    // CAPAIAN
	//-------------------------------------------------------------------------------------------
	public function capaian($idprojek) {
		$data['form']='Projek P5';
		$data['form_small']='Capaian';
		$data['view']='capaian';
		$data['stat']='ubah';
		$data['actionsave']='ns_p5_projek/tambah_capaian_p/'.$idprojek;
		$data= $this->ns_p5_projek_db->view_db($idprojek,$data);
		$this->load->view('ns_p5_projek_v',$data);
	}

    public function tambah_capaian_p($idprojek) {
		$result = $this->dbx->hapusdata('ns_p5_projek_capaian','idprojek',$idprojek);
        $idcapaianrow=$this->input->post("idcapaian");
        foreach ($idcapaianrow as $idcapaian) {
                $data = array(
                                "idprojek"=> $idprojek,
								"idcapaian"=> $idcapaian,
                                "created_date"=> $this->dbx->cts(),
                                "created_by"=> $this->session->userdata('idpegawai'),
								"modified_date"=> $this->dbx->cts(),
                                "modified_by"=> $this->session->userdata('idpegawai')
                );
                $result = $this->dbx->tambahdata('ns_p5_projek_capaian',$data);
                //echo $this->db->last_query();die;
                //echo $idcapaian."<br/>";
        }
        //die;
        if ($result == TRUE) {
			redirect('ns_p5_projek/view/'.$idprojek);
		} else {
			redirect('ns_p5_projek/capaian/'.$idprojek);
		}
	}

	public function view($idprojek) {
		$data['form']='Projek P5';
		$data['form_small']='Capaian';
		$data['view']='capaian';
		$data['stat']='view';
		$data['actionsave']='ns_p5_projek/tambah_capaian_p/'.$idprojek;
		$data= $this->ns_p5_projek_db->view_db($idprojek,$data);
		$this->load->view('ns_p5_projek_v',$data);
	}

	public function ubahaktif($id,$aktif=0) {
		$data=array(
				'aktif' =>$aktif
				,"modified_date"=> $this->dbx->cts()
				,"modified_by"=> $this->session->userdata('idpegawai'));
		$result = $this->dbx->ubahdata('ns_p5_projek',$data,'replid',$id) ;
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

	//Hapus
	public function hapus($idprojek) {
		$result = $this->dbx->hapusdata('ns_p5_projek_capaian','idprojek',$idprojek);
		if ($result == TRUE) {
			$result = $this->dbx->hapusdata('ns_p5_projek','replid',$idprojek);
		}
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
