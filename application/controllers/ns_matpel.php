<?php

session_start(); //we need to start session in order to access it through CI

Class ns_matpel extends CI_Controller {

public function __construct() {
parent::__construct();

		// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');


		// Load session library
		$this->load->library('session');

		// Load database
		$this->load->model('ns_matpel_db');

		if( $this->session->userdata('logged_in')) {
		}else{
			redirect('user_authentication');;
		}

	}

	public function index()
	{
			$data= $this->ns_matpel_db->data();
			$data['form']='Mata Pelajaran';
			$data['view']='index';
			$data['action']='ns_matpel';
			$this->load->view('ns_matpel_v', $data);
	}


	// TAMBAH
	//-------------------------------------------------------------------------------------------
	public function tambah($id='') {
		$data['form']='Mata Pelajaran';
		$data['form_small']='Tambah Data';
		$data['view']='tambah';
		$data['action']='ns_matpel/tambah_p';
		$data= $this->ns_matpel_db->tambah_db($id,$data);
		$this->load->view('ns_matpel_v',$data);
	}

	public function tambah_p($id='') {
		$data = array(
				'matpel' => $this->input->post('matpel'),
				'iddepartemen' => $this->input->post('iddepartemen'),
				'idmatpelkelompok' => $this->input->post('idmatpelkelompok'),
				'idmatpelkelompokraport' => $this->input->post('idmatpelkelompokraport'),
				'idmatpelkelompokraport13' => $this->input->post('idmatpelkelompokraport13'),
				'idmatpelkelompokpersentase' => $this->input->post('idmatpelkelompokpersentase'),
				'idgroup' => $this->input->post('idgroup'),
				'keterangan' => $this->input->post('keterangan'),
				'kkm' => $this->input->post('kkm'),
				'idpredikattipe' => $this->input->post('idpredikattipe'),
				'no_urut' => $this->input->post('no_urut'),
				'aktif' => $this->input->post('aktif'),
				'external' => $this->input->post('external'),
				'absensi' => $this->input->post('absensi'),
				'hitungnilai' => $this->input->post('hitungnilai'),
				"modified_date"=> $this->dbx->cts(),
				"modified_by"=> $this->session->userdata('idpegawai'));

		if ($id<>""){
			$result = $this->ns_matpel_db->ubah_pdb($data,$id) ;
		}else{
			$data = $this->p_c->arraymerge(array('created_date' => $this->dbx->cts()), $data);
			$data = $this->p_c->arraymerge(array('created_by' => $this->session->userdata('idpegawai')), $data);
			$id = $this->ns_matpel_db->tambah_pdb($data) ;

			if ($id<>""){$result=TRUE;}
		}

		if ($result == TRUE) {
			redirect("ns_matpel/tingkat/".$id."/1");
		} else {
			$data['error']="Errorr...";
			$this->ubah($id,$data);
		}
	}

	// UBAH
	//-------------------------------------------------------------------------------------------
	public function ubah($id,$stat='') {
		$data['form']='Mata Pelajaran';
		$data['form_small']='Ubah Data';
		$data['view']='tambah';
		$data['action']='ns_matpel/tambah_p/'.$id;
		$data= $this->ns_matpel_db->tambah_db($id,$data);
		$this->load->view('ns_matpel_v',$data);
	}

	// Tingkat
	//-------------------------------------------------------------------------------------------
	public function tingkat($id,$edit="") {
		$data['form']='Mata Pelajaran';
		$data['form_small']='Tingkat Siswa';
		$data['view']='tingkat';
		$data['edit']=$edit;
		$data['action']='ns_matpel/tambahtingkat_p/'.$id;
		$data= $this->ns_matpel_db->view_db($id,$data);
		$this->load->view('ns_matpel_v',$data);
	}

	public function tambahtingkat_p($id) {

		$idtingkat=$this->input->post("idtingkat");
		$result = $this->ns_matpel_db->hapustingkat_db($id);
		if ($result == TRUE) {
			foreach((array)$idtingkat as $row){
				$idtingkatvar=preg_split("/[\s,]+/", $row);
				$data = array(
							"idmatpel"=> $id
							,"idtingkat"=> $idtingkatvar[0]
							,"idjurusan"=> $idtingkatvar[1]
							);
				$result=$this->ns_matpel_db->tambahtingkat_db($data);
				unset($idtingkatvar);
				unset($data);
			}
		}

		$result = $this->db->query("DELETE FROM ns_reff_company WHERE tipe='ns_matpel' AND idvariabel='".$id."'");
		foreach((array)$this->input->post('idcompany') as $rowcompany) {
				$datacompany = array(
					'tipe'=>'ns_matpel',
					'idvariabel'=>$id,
					'idcompany' => $rowcompany,
					'created_date' => $this->dbx->cts(),
					'created_by' => $this->session->userdata('idpegawai'),
					"modified_date"=> $this->dbx->cts(),
					"modified_by"=> $this->session->userdata('idpegawai')
				);
				$result=$this->dbx->tambahdata('ns_reff_company',$datacompany) ;
		}
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
	public function hapus($id) {
		$result = $this->ns_matpel_db->hapustingkat_db($id);
		$result = $this->ns_matpel_db->hapus_db($id) ;
		if ($result == TRUE) {
			?><script>
			    window.opener.location.reload();
			    window.close();
			  </script>
			<?php
		}
	}

	public function ubahaktif($id,$aktif) {
		$data=array(
				'aktif' =>$aktif);
		$result = $this->ns_matpel_db->ubah_pdb($data,$id);
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

}//end of class
?>
