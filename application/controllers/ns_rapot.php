<?php

session_start(); //we need to start session in order to access it through CI

Class ns_rapot extends CI_Controller {

public function __construct() {
parent::__construct();

		// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');


		// Load session library
		$this->load->library('session');

		// Load database
		$this->load->model('ns_rapot_db');

   if( $this->session->userdata('logged_in')) {
       if($this->dbx->checkpage($this->session->userdata('role_id'),'ns_rapot')==false){
          redirect('user_authentication');
       }
		}else{
			redirect('user_authentication');
		}

	}

	public function index()
	{

			$data= $this->ns_rapot_db->data();
			$data['form']='Laporan Pembelajaran';
			$data['view']='index';
			$data['action']='ns_rapot';
			$this->load->view('ns_rapot_v', $data);
	}

	// TAMBAH
	//-------------------------------------------------------------------------------------------
	public function tambah($idtahunajaran="",$idperiode="",$idkelas="",$idregion="",$idsiswa="",$tanggalkegiatan="") {
		$data['idtahunajaran2']=$idtahunajaran;
		$data['idkelas2']=$idkelas;
		$data['idperiode2']=$idperiode;
		$data['idregion2']=$idregion;
		$data['idsiswa2']=$idsiswa;
		$data['tanggalkegiatan2']=$this->p_c->tgl_db($tanggalkegiatan);
		$data['form']='Laporan Pembelajaran';
		$data['form_small']='Tambah Data';
		$data['view']='tambah';
		$data['edit']='0';
		$data['action']='ns_rapot/tambah_p';
		$data= $this->ns_rapot_db->tambah_db(" ",$data);
		$this->load->view('ns_rapot_v',$data);
	}

	public function tambah_p($id='') {
		$data = array(
				'idtahunajaran' => $this->input->post('idtahunajaran'),
				"idperiode" => $this->input->post("idperiode"),
				'idkelas' => $this->input->post('idkelas'),
				'idregion' => $this->input->post('idregion'),
				'idsiswa' => $this->input->post('idsiswa'),
				'idrapottipe' => $this->input->post('idrapottipe'),
				'keterangan' => $this->input->post('keterangan'),
				"tanggalkegiatan"=> $this->p_c->tgl_db($this->input->post('tanggalkegiatan')),
				'idtahunajaranrapot'=>$this->input->post('idtahunajaranrapot'),
				'external'=>$this->input->post('external'),
				'nomordokumen'=>$this->input->post('nomordokumen'),
				'tampilna' => $this->input->post('tampilna'),
				"modified_date"=> $this->dbx->cts(),
				"modified_by"=> $this->session->userdata('idpegawai'));

		if ($id<>""){
			$result = $this->ns_rapot_db->ubah_pdb($data,$id) ;
		}else{
			$data = $this->p_c->arraymerge(array('created_date' => $this->dbx->cts()), $data);
			$data = $this->p_c->arraymerge(array('created_by' => $this->session->userdata('idpegawai')), $data);
			$id = $this->ns_rapot_db->tambah_pdb($data) ;

			if ($id<>""){$result=TRUE;}
		}

		if ($result == TRUE) {
			redirect('ns_rapot/rapot/'.$id.'/1');
		} else {
			$data['error']='Errorr...';
			$this->ubah($id,$data);
		}
	}

	// UBAH
	//-------------------------------------------------------------------------------------------
	public function ubah($id,$idtahunajaran="",$idperiode="",$idkelas="",$idregion="",$idsiswa="",$tanggalkegiatan="") {
		$data['idtahunajaran2']=$idtahunajaran;
		$data['idkelas2']=$idkelas;
		$data['idperiode2']=$idperiode;
		$data['idregion2']=$idregion;
		$data['idsiswa2']=$idsiswa;
		$data['tanggalkegiatan2']=$this->p_c->tgl_db($tanggalkegiatan);
		$data['form']='Laporan Pembelajaran';
		$data['form_small']='Ubah Data';
		$data['view']='tambah';
		$data['edit']='1';
		$data['action']='ns_rapot/tambah_p/'.$id;
		$data= $this->ns_rapot_db->tambah_db($id,$data);
		$this->load->view('ns_rapot_v',$data);
	}

	// Rapot
	//-------------------------------------------------------------------------------------------
	public function rapot($id,$edit="") {
		$data['form']='Laporan Pembelajaran';
		$data['form_small']='Rapor';
		$data['view']='rapot';
		$data['edit']=$edit;
		$data['id']=$id;
		$data['action']='ns_rapot/tambahnilai_p/'.$id;
		$data= $this->ns_rapot_db->view_db($id,$data);
		$this->load->view('ns_rapot_v',$data);
	}

	// DETAIL Rapot MATPEL
	//-------------------------------------------------------------------------------------------
	public function ns_rapot_detailmatpel($id,$idmatpel) {
		$data['form']='Laporan Pembelajaran';
		$data['form_small']='Rapor Detail Per Mata Pelajaran';
		$data['action']='ns_rapot/tambahnilai_p/'.$id;
		$data['id']=$id;
		$data= $this->ns_rapot_db->view_detailmatpel_db($id,$idmatpel,$data);
		$this->load->view('ns_rapot_detailmatpel_v',$data);
	}

	public function tambahnilai_p($id){
		$this->ns_rapot_db->hapusnilai_pdb($id);

		$rs=preg_split("/[\s,]+/", $this->input->post("rs"));
		$pdv=preg_split("/[\s,]+/", $this->input->post("pdv"));
		//"idkelas" => $this->input->post("idkelas"),
		foreach((array)$pdv as $rowpdv) {
			foreach((array)$rs as $rowrs) {
				$data = array(
						"idrapot" => $id,
						"idsiswa" => $rowrs,
						"idpengembangandirivariabel" => $rowpdv,
						"nilai" => $this->input->post($rowpdv.'/'.$rowrs),
						"modified_date"=> $this->dbx->cts(),
						"modified_by"=> $this->session->userdata('idpegawai'));

				//if ($id<>""){
				//	$result = $this->ns_rapot_db->ubah_pdb($data,$id) ;
				//}else{
					$data = $this->p_c->arraymerge(array('created_date' => $this->dbx->cts()), $data);
					$data = $this->p_c->arraymerge(array('created_by' => $this->session->userdata('idpegawai')), $data);
					$result = $this->ns_rapot_db->tambahnilai_pdb($data) ;
				//}
			} // for rs
		} //for rdv

		if ($result == TRUE) {
			redirect('ns_rapot');
		} else {
			$data['error']='Errorr...';
			$this->ubah($id,$data);
		}
	}

	public function hapusnilai($id) {
		$result = $this->ns_rapot_db->hapusnilai_pdb($id) ;
		if ($result == TRUE) {
			redirect('ns_rapot/penilaian/'.$id.'/1');
		}
	}

	//Hapus
	//-------------------------------------------------------------------------------------------
	public function hapus($id) {
		// $result = $this->ns_rapot_db->hapusnilai_pdb($id) ;
		$result = $this->ns_rapot_db->hapus_rapot($id) ;
		/*
		if ($result == TRUE) {
			redirect('ns_rapot');
		}
		*/
		?><script>
				window.opener.location.reload();
				window.close();
			</script>
		<?php
	}

	public function printrapot($id,$excel)
	{
		$data['form']='Laporan Pembelajaran';
		$data['form_small']='Rapot';
		$data['view']='rapot';
		$data['excel']=$excel;
		$data['digital']=0;
		$data= $this->ns_rapot_db->view_db($id,$data);
		$this->load->view('ns_rapot_print_v',$data);
	}

	public function digitalrapot($id)
	{
		$data['form']='Laporan Pembelajaran';
		$data['form_small']='Rapot';
		$data['view']='rapot';
		$data['excel']=0;
		$data['digital']=1;
		$data= $this->ns_rapot_db->view_db($id,$data);
		$this->load->view('ns_rapot_print_v',$data);
	}

}//end of class
?>
