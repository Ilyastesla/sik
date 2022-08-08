<?php

session_start(); //we need to start session in order to access it through CI

Class ns_rapotmapping extends CI_Controller {

public function __construct() {
parent::__construct();

		// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');


		// Load session library
		$this->load->library('session');

		// Load database
		$this->load->model('ns_rapotmapping_db');

   if( $this->session->userdata('logged_in')) {
       if($this->dbx->checkpage($this->session->userdata('role_id'),'ns_rapotmapping')==false){
          redirect('user_authentication');
       }
		}else{
			redirect('user_authentication');;
		}

	}

	public function index()
	{
			if ($this->input->post('reset')==1){
				$data = array(
							'idrapottipe'=>''
							,'idmatpelkelompok'=>''
							,'idregion'=>''
						);
						$this->session->unset_userdata($data);
			}else{
					$data = array(
									'idrapottipe'=>$this->input->post('idrapottipe'),
									'idmatpelkelompok'=>$this->input->post('idmatpelkelompok'),
									'idregion'=>$this->input->post('idregion')
								);
						 $this->session->set_userdata($data);
			}
			$data = $this->ns_rapotmapping_db->data();
			$data['form']='Laporan Pembelajaran Mapping';
			$data['view']='index';
			$data['action']='ns_rapotmapping';
			$this->load->view('ns_rapotmapping_v', $data);
	}

	// TAMBAH
	//-------------------------------------------------------------------------------------------
	public function tambah() {
		$data['form']='Laporan Pembelajaran Mapping';
		$data['form_small']='Tambah Data';
		$data['view']='tambah';
		$data['edit']='0';
		$data['action']='ns_rapotmapping/tambah_p';
		$data= $this->ns_rapotmapping_db->tambah_db(" ",$data);
		$this->load->view('ns_rapotmapping_v',$data);
	}

	public function tambah_p($id='') {
		//'iddepartemen' => $this->input->post('iddepartemen'),
		$data = array(
				'idregion' => $this->input->post('idregion'),
				'idmatpelkelompok' => $this->input->post('idmatpelkelompok'),
				'idrapottipe' => $this->input->post('idrapottipe'),
				'nonreguler' => $this->input->post('nonreguler'),
				'persentase' => $this->input->post('persentase'),
				"modified_date"=> $this->dbx->cts(),
				"modified_by"=> $this->session->userdata('idpegawai'));

		if ($id<>""){
			$result = $this->ns_rapotmapping_db->ubah_pdb($data,$id) ;
		}else{
			$data = $this->p_c->arraymerge(array('created_date' => $this->dbx->cts()), $data);
			$data = $this->p_c->arraymerge(array('created_by' => $this->session->userdata('idpegawai')), $data);
			$id = $this->ns_rapotmapping_db->tambah_pdb($data) ;
			if ($id<>""){$result=TRUE;}
		}

		if ($result == TRUE) {
			redirect('ns_rapotmapping/mapping/'.$id.'/1');
		} else {
			$data['error']='Errorr...';
			$this->ubah($id,$data);
		}
	}

	// UBAH
	//-------------------------------------------------------------------------------------------
	public function ubah($id) {
		$data['form']='Laporan Pembelajaran Mapping';
		$data['form_small']='Ubah Data';
		$data['view']='tambah';
		$data['edit']='1';
		$data['action']='ns_rapotmapping/tambah_p/'.$id;
		$data= $this->ns_rapotmapping_db->tambah_db($id,$data);
		$this->load->view('ns_rapotmapping_v',$data);
	}

	// rapotmapping
	//-------------------------------------------------------------------------------------------
	public function mapping($id,$edit="") {
		$data['form']='Laporan Pembelajaran Mapping';
		$data['form_small']='mapping';
		$data['view']='rapotmapping';
		$data['edit']=$edit;
		$data['action']='ns_rapotmapping/tambahmapping_p/'.$id;
		$data= $this->ns_rapotmapping_db->mapping_db($id,$data);
		$this->load->view('ns_rapotmapping_v',$data);
	}

	public function tambahmapping_p($id){
		$this->ns_rapotmapping_db->hapusrapotmappingvariabel_db($id);
		$rsv=preg_split("/[\s,]+/", $this->input->post("rsv"));
		foreach((array)$rsv as $rowrsv) {
			$data = array(
					"idrapotmapping" => $id,
					"idprosessubvariabel" => $rowrsv,
					"nilai" => $this->input->post('rsv'.$rowrsv),
					"modified_date"=> $this->dbx->cts(),
					"modified_by"=> $this->session->userdata('idpegawai'));
			$data = $this->p_c->arraymerge(array('created_date' => $this->dbx->cts()), $data);
			$data = $this->p_c->arraymerge(array('created_by' => $this->session->userdata('idpegawai')), $data);
			$result = $this->ns_rapotmapping_db->tambahrapotmappingvariabel_db($data) ;
		} // for rs

		if ($result == TRUE) {
			redirect('ns_rapotmapping/mappingpengembangandiri/'.$id.'/1');
		} else {
			$data['error']='Errorr...';
			$this->mapping($id,$data);
		}
	}

	public function hapusnilai($id) {
		$result = $this->ns_rapotmapping_db->hapusnilai_pdb($id) ;
		if ($result == TRUE) {
			redirect('ns_rapotmapping/penilaian/'.$id.'/1');
		}
	}


	// rapot mappingpengembangandiri
	//-------------------------------------------------------------------------------------------
	public function mappingpengembangandiri($id,$edit="") {
		$data['form']='Laporan Pembelajaran Mapping';
		$data['form_small']='Pengembangan Diri';
		$data['view']='rapotpengembangandiri';
		$data['edit']=$edit;
		$data['action']='ns_rapotmapping/tambahmappingpengembangandiri_p/'.$id;
		$data= $this->ns_rapotmapping_db->mapping_db($id,$data);
		$this->load->view('ns_rapotmapping_v',$data);
	}

	public function tambahmappingpengembangandiri_p($id){
		$this->ns_rapotmapping_db->hapusrapotmappingpengembangandiri_db($id);
		$rpd=preg_split("/[\s,]+/", $this->input->post("rpd"));
		foreach((array)$rpd as $rowrpd) {
			$data = array(
					"idrapotmapping" => $id,
					"idpengembangandirivariabel" => $rowrpd,
					"nilai" => $this->input->post('rpd'.$rowrpd),
					"modified_date"=> $this->dbx->cts(),
					"modified_by"=> $this->session->userdata('idpegawai'));
			$data = $this->p_c->arraymerge(array('created_date' => $this->dbx->cts()), $data);
			$data = $this->p_c->arraymerge(array('created_by' => $this->session->userdata('idpegawai')), $data);
			$result = $this->ns_rapotmapping_db->tambahrapotmappingpengembangandiri_db($data) ;
		} // for rs

		if ($result == TRUE) {
			redirect('ns_rapotmapping/view/'.$id.'/1');
		} else {
			$data['error']='Errorr...';
			$this->mappingpengembangandiri($id,$data);
		}
	}

	public function hapusmappingpengembangandiri($id) {
		$result = $this->ns_rapotmapping_db->hapusnilai_pdb($id) ;
		if ($result == TRUE) {
			redirect('ns_rapotmapping/penilaian/'.$id.'/1');
		}
	}


	// view
	//-------------------------------------------------------------------------------------------
	public function view($id) {
		$data['form']='Laporan Pembelajaran Mapping';
		$data['form_small']='Pengembangan Diri';
		$data['view']='view';
		$data= $this->ns_rapotmapping_db->view_db($id,$data);
		$this->load->view('ns_rapotmapping_v',$data);
	}

	//Hapus
	//-------------------------------------------------------------------------------------------
	public function hapus($id) {
		$result = $this->ns_rapotmapping_db->hapusrapotmappingvariabel_db($id) ;
		$result = $this->ns_rapotmapping_db->hapusrapotmappingpengembangandiri_db($id) ;
		$result = $this->ns_rapotmapping_db->hapus_pdb($id) ;
		if ($result == TRUE) {
			redirect('ns_rapotmapping');
		}
	}

}//end of class
?>
