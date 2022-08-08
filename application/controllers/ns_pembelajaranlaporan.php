<?php

session_start(); //we need to start session in order to access it through CI

Class ns_pembelajaranlaporan extends CI_Controller {

public function __construct() {
parent::__construct();

		// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');


		// Load session library
		$this->load->library('session');

		// Load database
		$this->load->model('ns_pembelajaranlaporan_db');

   if( $this->session->userdata('logged_in')) {
       if($this->dbx->checkpage($this->session->userdata('role_id'),'ns_pembelajaranlaporan')==false){
          redirect('user_authentication');
       }
		}else{
			redirect('user_authentication');;
		}

	}

	public function index()
	{
			$data['show_table'] = $this->ns_pembelajaranlaporan_db->data();
			$data['form']='Jadwal Pembelajaran';
			$data['view']='index';
			$this->load->view('ns_pembelajaranlaporan_v', $data);
	}

	// TAMBAH
	//-------------------------------------------------------------------------------------------
	public function tambah($idprosestipe="",$idmatpel="",$idtahunajaran="",$idkelas="",$keterangan="",$tanggalkegiatan="") {
		$data['idprosestipe2']=$idprosestipe;
		$data['idmatpel2']=$idmatpel;
		$data['idtahunajaran2']=$idtahunajaran;
		$data['idkelas2']=$idkelas;
		$data['keterangan2']=$keterangan;
		$data['tanggalkegiatan2']=$this->p_c->tgl_db($tanggalkegiatan);
		$data['form']='Jadwal Pembelajaran';
		$data['form_small']='Tambah Data';
		$data['view']='tambah';
		$data['edit']='0';
		$data['action']='ns_pembelajaranlaporan/tambah_p';
		$data= $this->ns_pembelajaranlaporan_db->tambah_db(" ",$data);
		$this->load->view('ns_pembelajaranlaporan_v',$data);
	}

	public function tambah_p($id='') {
		$data = array(
				'idprosestipe' => $this->input->post('idprosestipe'),
				'idmatpel' => $this->input->post('idmatpel'),
				'idtahunajaran' => $this->input->post('idtahunajaran'),
				'idkelas' => $this->input->post('idkelas'),
				'keterangan' => $this->input->post('keterangan'),
				'aktif' => $this->input->post('aktif'),
				"tanggalkegiatan"=> $this->p_c->tgl_db($this->input->post('tanggalkegiatan')),
				"modified_date"=> $this->dbx->cts(),
				"modified_by"=> $this->session->userdata('idpegawai'));

		if ($id<>""){
			$result = $this->ns_pembelajaranlaporan_db->ubah_pdb($data,$id) ;
		}else{
			$data = $this->p_c->arraymerge(array('created_date' => $this->dbx->cts()), $data);
			$data = $this->p_c->arraymerge(array('created_by' => $this->session->userdata('idpegawai')), $data);
			$id = $this->ns_pembelajaranlaporan_db->tambah_pdb($data) ;
			if ($id<>""){$result=TRUE;}
		}

		if ($result == TRUE) {
			redirect('ns_pembelajaranlaporan');
		} else {
			$data['error']='Errorr...';
			$this->ubah($id,$data);
		}
	}

	// UBAH
	//-------------------------------------------------------------------------------------------
	public function ubah($id,$idprosestipe="",$idmatpel="",$idtahunajaran="",$idkelas="",$keterangan="",$tanggalkegiatan="") {
		$data['idprosestipe2']=$idprosestipe;
		$data['idmatpel2']=$idmatpel;
		$data['idtahunajaran2']=$idtahunajaran;
		$data['idkelas2']=$idkelas;
		$data['keterangan2']=$keterangan;
		$data['tanggalkegiatan2']=$this->p_c->tgl_db($tanggalkegiatan);
		$data['form']='Jadwal Pembelajaran';
		$data['form_small']='Ubah Data';
		$data['view']='tambah';
		$data['edit']='1';
		$data['action']='ns_pembelajaranlaporan/tambah_p/'.$id;
		$data= $this->ns_pembelajaranlaporan_db->tambah_db($id,$data);
		$this->load->view('ns_pembelajaranlaporan_v',$data);
	}

	// PENILAIAN
	//-------------------------------------------------------------------------------------------
	public function penilaian($id,$edit) {
		$data['form']='Jadwal Pembelajaran';
		$data['form_small']='Penilaian';
		$data['view']='penilaian';
		$data['edit']=$edit;
		$data['action']='ns_pembelajaranlaporan/tambahnilai_p/'.$id;
		$data= $this->ns_pembelajaranlaporan_db->view_db($id,$data);
		$this->load->view('ns_pembelajaranlaporan_v',$data);
	}

	public function tambahnilai_p($id){
		$this->ns_pembelajaranlaporan_db->hapusnilai_pdb($id);

		$rs=preg_split("/[\s,]+/", $this->input->post("rs"));
		$pdv=preg_split("/[\s,]+/", $this->input->post("pdv"));
		//"idkelas" => $this->input->post("idkelas"),
		foreach((array)$pdv as $rowpdv) {
			foreach((array)$rs as $rowrs) {
				$data = array(
						"idpembelajaranlaporan" => $id,
						"idsiswa" => $rowrs,
						"idpengembangandirivariabel" => $rowpdv,
						"nilai" => $this->input->post($rowpdv.'/'.$rowrs),
						"modified_date"=> $this->dbx->cts(),
						"modified_by"=> $this->session->userdata('idpegawai'));

				//if ($id<>""){
				//	$result = $this->ns_pembelajaranlaporan_db->ubah_pdb($data,$id) ;
				//}else{
					$data = $this->p_c->arraymerge(array('created_date' => $this->dbx->cts()), $data);
					$data = $this->p_c->arraymerge(array('created_by' => $this->session->userdata('idpegawai')), $data);
					$result = $this->ns_pembelajaranlaporan_db->tambahnilai_pdb($data) ;
				//}
			} // for rs
		} //for rdv

		if ($result == TRUE) {
			redirect('ns_pembelajaranlaporan');
		} else {
			$data['error']='Errorr...';
			$this->ubah($id,$data);
		}
	}

	public function hapusnilai($id) {
		$result = $this->ns_pembelajaranlaporan_db->hapusnilai_pdb($id) ;
		if ($result == TRUE) {
			redirect('ns_pembelajaranlaporan/penilaian/'.$id.'/1');
		}
	}

	//Hapus
	//-------------------------------------------------------------------------------------------
	public function hapus($id) {
		$result = $this->ns_pembelajaranlaporan_db->hapusnilai_pdb($id) ;
		$result = $this->ns_pembelajaranlaporan_db->hapus_pdb($id) ;
		if ($result == TRUE) {
			redirect('ns_pembelajaranlaporan');
		}
	}

}//end of class
?>
