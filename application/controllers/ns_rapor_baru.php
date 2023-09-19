<?php

session_start(); //we need to start session in order to access it through CI

Class ns_rapor_baru extends CI_Controller {

public function __construct() {
parent::__construct();

		// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');


		// Load session library
		$this->load->library('session');

		// Load database
		$this->load->model('ns_rapor_baru_db');

   if( $this->session->userdata('logged_in')) {
       if($this->dbx->checkpage($this->session->userdata('role_id'),'ns_rapor_baru')==false){
          redirect('user_authentication');
       }
		}else{
			redirect('user_authentication');
		}

	}

	public function index()
	{
			$data= $this->ns_rapor_baru_db->data();
			$data['form']='Laporan Pembelajaran Sekolah Kak Seto';
			$data['view']='index';
			$data['action']='ns_rapor_baru';
			$this->load->view('ns_rapor_baru_v', $data);
	}

	// TAMBAH
	//-------------------------------------------------------------------------------------------
	public function tambah($id="") {
		$data['form']='Laporan Pembelajaran Sekolah Kak Seto';
		$data['form_small']='Tambah Data';
		$data['view']='tambah';
		$data['indeks']='1';
		$data['action']='ns_rapor_baru/tambah_p/'.$data['indeks']."/".$id;
		$data= $this->ns_rapor_baru_db->tambah_db($data,$id);
		$this->load->view('ns_rapor_baru_v',$data);
	}

	public function tambah2($id="") {
		$data['form']='Laporan Pembelajaran Sekolah Kak Seto';
		$data['form_small']='Tambah Data';
		$data['view']='tambah';
		$data['indeks']='2';
		$data['action']='ns_rapor_baru/tambah_p/'.$data['indeks']."/".$id;
		$data['actionprestasi']='ns_rapor_baru/tambahprestasi/'.$id;
		$data['actionekstrakurikuler']='ns_rapor_baru/tambahekstrakurikuler/'.$id;
		$data= $this->ns_rapor_baru_db->tambah_db($data,$id);
		$this->load->view('ns_rapor_baru_v',$data);
	}

	public function tambah_p($indeks,$id='') {
		//"idmodultipe" => $this->input->post("idmodultipe"),
		$matpeldesc=$this->input->post('matpeldesc');
		if($indeks=="1"){
			$data = array(
					'idtahunajaran' => $this->input->post('idtahunajaran'),
					"idperiode" => $this->input->post("idperiode"),
					'idkelas' => $this->input->post('idkelas'),
					'idregion' => $this->input->post('idregion'),
					'idsiswa' => $this->input->post('idsiswa'),
					'idrapottipe' => $this->input->post('idrapottipe'),
					"tanggalkegiatan"=> $this->p_c->tgl_db($this->input->post('tanggalkegiatan')),
					"modified_date"=> $this->dbx->cts(),
					"modified_by"=> $this->session->userdata('idpegawai'));
		}else if($indeks=="2"){
			$data = array(
				'idtahunajaranrapot'=>$this->input->post('idtahunajaranrapot'),
					'external'=>$this->input->post('external'),
					'nomordokumen'=>$this->input->post('nomordokumen'),
					'tampilna' => $this->input->post('tampilna'),
					'idnaikkelas' => $this->input->post('idnaikkelas'),
					'idnaiktingkat' => $this->input->post('idnaiktingkat'),
					'keterangan' => $this->input->post('keterangan'),
					'idpredikatspiritual' => $this->input->post('idpredikatspiritual'),
					'spiritualtext' => $this->input->post('spiritualtext'),
					'idpredikatsosial' => $this->input->post('idpredikatsosial'),
					'sosialtext' => $this->input->post('sosialtext'),
					'tinggi' => $this->input->post('tinggi'),
					'berat' => $this->input->post('berat'),
					'pendengaran' => $this->input->post('pendengaran'),
					'penglihatan' => $this->input->post('penglihatan'),
					'gigi' => $this->input->post('gigi'),
					"modified_date"=> $this->dbx->cts(),
					"modified_by"=> $this->session->userdata('idpegawai'));
		}
		if ($id<>""){
			$result = $this->dbx->ubahdata('ns_rapot',$data,'replid',$id) ;
		}else{
			$data = $this->p_c->arraymerge(array('created_date' => $this->dbx->cts()), $data);
			$data = $this->p_c->arraymerge(array('created_by' => $this->session->userdata('idpegawai')), $data);
			$id = $this->dbx->tambahdata('ns_rapot',$data);

			if ($id<>""){$result=TRUE;}
		}

		if($matpeldesc<>NULL){
			foreach((array)$matpeldesc as $key => $value) {
				$datamatpeldesc = array(
						'idrapot' => $id,
						'idmatpel' => $key,
						'matpeldeskripsi' => $value,
						"created_date"=> $this->dbx->cts(),
						"created_by"=> $this->session->userdata('idpegawai'),
						"modified_date"=> $this->dbx->cts(),
						"modified_by"=> $this->session->userdata('idpegawai'));
					$this->db->query("DELETE FROM ns_rapotmatpeldeskripsi WHERE idrapot='".$id."' AND idmatpel='".$key."'");
					$result=$this->dbx->tambahdata('ns_rapotmatpeldeskripsi',$datamatpeldesc);
			}
		}
		if ($result == TRUE) {
			if($indeks=="1"){
				redirect('ns_rapor_baru/tambah2/'.$id);
			}else if($indeks=="2"){
				redirect('ns_rapor_baru/rapot/'.$id);
			}
		} else {
			$data['error']='Errorr...';
			redirect('ns_rapor_baru/tambah/'.$id);
		}
	}

	public function tambahprestasi($id) {
		$data = array(
				'idrapot' => $id,
				'jeniskegiatan' => $this->input->post('jeniskegiatan'),
				'prestasi' => $this->input->post('prestasi'),
				"created_date"=> $this->dbx->cts(),
				"created_by"=> $this->session->userdata('idpegawai'),
				"modified_date"=> $this->dbx->cts(),
				"modified_by"=> $this->session->userdata('idpegawai'));
			$idp = $this->dbx->tambahdata('ns_rapotprestasi',$data);
			if ($idp<>""){$result=TRUE;}
			redirect('ns_rapor_baru/tambah2/'.$id);
	}
	public function hapusprestasi($idprestasi){
		$result = $this->dbx->hapusdata('ns_rapotprestasi','replid',$idprestasi);
		?><script>
				window.opener.location.reload();
				window.close();
			</script>
		<?php
	}

	public function tambahekstrakurikuler($id) {
		$data = array(
				'idrapot' => $id,
				'kegiatanekstrakurikuler' => $this->input->post('kegiatanekstrakurikuler'),
				'predikatekstrakurikuler' => $this->input->post('predikatekstrakurikuler'),
				'deskripsiekstrakurikuler' => $this->input->post('deskripsiekstrakurikuler'),
				"created_date"=> $this->dbx->cts(),
				"created_by"=> $this->session->userdata('idpegawai'),
				"modified_date"=> $this->dbx->cts(),
				"modified_by"=> $this->session->userdata('idpegawai'));
			$idp = $this->dbx->tambahdata('ns_rapotekstrakurikuler',$data);
			if ($idp<>""){$result=TRUE;}
			redirect('ns_rapor_baru/tambah2/'.$id);
	}
	public function hapusekstrakurikuler($idekstrakurikuler){
		$result = $this->dbx->hapusdata('ns_rapotekstrakurikuler','replid',$idekstrakurikuler);
		?><script>
				window.opener.location.reload();
				window.close();
			</script>
		<?php
	}
	
	// Rapot
	//-------------------------------------------------------------------------------------------
	public function rapot($id) {
		$data['form']='Laporan Pembelajaran Sekolah Kak Seto';
		$data['form_small']='Rapor';
		$data['view']='rapot';
		$data['printrapot']='0';
		$data['id']=$id;
		$data['action']='ns_rapor_baru/tambahnilai_p/'.$id;
		$data= $this->ns_rapor_baru_db->view_db($id,$data);
		$this->load->view('ns_rapor_baru_v',$data);
	}

	// DETAIL Rapot MATPEL
	//-------------------------------------------------------------------------------------------
	public function ns_rapor_baru_detailmatpel($id,$idmatpel="") {
		$data['form']='Laporan Pembelajaran Sekolah Kak Seto';
		$data['form_small']='Rapor Detail Per Mata Pelajaran';
		$data['action']='ns_rapor_baru/tambahnilai_p/'.$id;
		$data['id']=$id;
		$data= $this->ns_rapor_baru_db->view_detailmatpel_db($id,$idmatpel,$data);
		$this->load->view('ns_rapot_detailmatpel_v',$data);
	}

	public function tambahnilai_p($id){
		$this->ns_rapor_baru_db->hapusnilai_pdb($id);

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
				//	$result = $this->ns_rapor_baru_db->ubah_pdb($data,$id) ;
				//}else{
					$data = $this->p_c->arraymerge(array('created_date' => $this->dbx->cts()), $data);
					$data = $this->p_c->arraymerge(array('created_by' => $this->session->userdata('idpegawai')), $data);
					$result = $this->ns_rapor_baru_db->tambahnilai_pdb($data) ;
				//}
			} // for rs
		} //for rdv

		if ($result == TRUE) {
			redirect('ns_rapor_baru');
		} else {
			$data['error']='Errorr...';
			$this->ubah($id,$data);
		}
	}

	public function hapusnilai($id) {
		$result = $this->ns_rapor_baru_db->hapusnilai_pdb($id) ;
		if ($result == TRUE) {
			redirect('ns_rapor_baru/penilaian/'.$id.'/1');
		}
	}

	//Hapus
	//-------------------------------------------------------------------------------------------
	public function hapus($id) {
		// $result = $this->ns_rapor_baru_db->hapusnilai_pdb($id) ;
		//$result = $this->ns_rapor_baru_db->hapus_rapot($id) ;
		/*
		if ($result == TRUE) {
			redirect('ns_rapor_baru');
		}
		*/
		$datahapus=array(
			"deletethis"=>1,
			"modified_date"=> $this->dbx->cts(),
			"modified_by"=> $this->session->userdata('idpegawai')
		);
		$result = $this->dbx->ubahdata('ns_rapot',$datahapus,'replid',$id) ;
		if ($result == TRUE) {
		?><script>
				window.opener.location.reload();
				window.close();
			</script>
		<?php
		}
	}

	//Hapus
	//-------------------------------------------------------------------------------------------
	public function hapustotal($id) {
		//$result = $this->dbx->hapusdata($table,$row,$id) ;
		$result = $this->dbx->hapusdata('ns_rapotprestasi',idrapot,$id) ;
		$result = $this->dbx->hapusdata('ns_rapotmatpeldeskripsi',idrapot,$id) ;
		$result = $this->dbx->hapusdata('ns_rapotekstrakurikuler',idrapot,$id) ;
		$result = $this->dbx->hapusdata('ns_rapot',replid,$id) ;
		if ($result == TRUE) {
			redirect('ns_rapor_baru');
		}
	}

	public function printrapot($id,$excel="")
	{
		$data['form']='Laporan Pembelajaran Sekolah Kak Seto';
		$data['form_small']='Rapot';
		$data['view']='rapot';
		$data['printrapot']='1';
		$data['excel']=$excel;
		$data['digital']=0;
		$data['modular']=1;
		$data= $this->ns_rapor_baru_db->view_db($id,$data);
		$this->load->view('ns_rapor_baru_print_v',$data);
	}

	public function digitalrapot($id)
	{
		$data['form']='Laporan Pembelajaran Sekolah Kak Seto';
		$data['form_small']='Rapot';
		$data['view']='rapot';
		$data['printrapot']='1';
		$data['excel']=0;
		$data['digital']=1;
		$data['modular']=1;
		$data= $this->ns_rapor_baru_db->view_db($id,$data);
		$this->load->view('ns_rapor_baru_print_v',$data);
	}

	public function printrapotavg($id,$excel="")
	{
		$data['form']='Laporan Pembelajaran Sekolah Kak Seto';
		$data['form_small']='Rapot';
		$data['view']='rapot';
		$data['excel']=$excel;
		$data['printrapot']='1';
		$data['digital']=0;
		$data['modular']=0;
		$data= $this->ns_rapor_baru_db->view_db($id,$data);
		$this->load->view('ns_rapor_baru_print_v',$data);
	}

	public function digitalrapotavg($id)
	{
		$data['form']='Laporan Pembelajaran Sekolah Kak Seto';
		$data['form_small']='Rapot';
		$data['view']='rapot';
		$data['printrapot']='1';
		$data['excel']=0;
		$data['digital']=1;
		$data['modular']=0;
		$data= $this->ns_rapor_baru_db->view_db($id,$data);
		$this->load->view('ns_rapor_baru_print_v',$data);
	}

	public function duplikasi($replid) {
		$sqlrapor="SELECT * FROM ns_rapot WHERE replid='".$replid."'";
		$datarapor=$this->dbx->rows($sqlrapor);
		$data = array(
				'idtahunajaran' => $datarapor->idtahunajaran,
				'idperiode' => $datarapor->idperiode,
				'idkelas' => $datarapor->idkelas,
				'idregion' => $datarapor->idregion,
				'idsiswa' => $datarapor->idsiswa,
				'idrapottipe' => $datarapor->idrapottipe,
				'tanggalkegiatan' => $datarapor->tanggalkegiatan,
				'tampilna' => $datarapor->tampilna,
				'idnaikkelas' => $datarapor->idnaikkelas,
				'nomordokumen' => $datarapor->nomordokumen,
				"modified_date"=> $this->dbx->cts(),
				"modified_by"=> $this->session->userdata('idpegawai'),
				"created_date"=> $this->dbx->cts(),
				"created_by"=> $this->session->userdata('idpegawai')
			);
			$replidnew = $this->dbx->tambahdata('ns_rapot',$data) ;
			if ($replidnew<>""){$result=TRUE;}

		if ($result == TRUE) {
			redirect('ns_rapor_baru/tambah/'.$replidnew);
		}
	}

}//end of class
?>
