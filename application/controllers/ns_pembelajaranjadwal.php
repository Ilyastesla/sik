<?php

session_start(); //we need to start session in order to access it through CI

Class ns_pembelajaranjadwal extends CI_Controller {

public function __construct() {
parent::__construct();

		// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');


		// Load session library
		$this->load->library('session');

		// Load database
		$this->load->model('ns_pembelajaranjadwal_db');

   if( $this->session->userdata('logged_in')) {
       if($this->dbx->checkpage($this->session->userdata('role_id'),'ns_pembelajaranjadwal')==false){
          redirect('user_authentication');
       }
		}else{
			redirect('user_authentication');;
		}

	}

	public function index()
	{
			$data= $this->ns_pembelajaranjadwal_db->index_table();
			$data['form']='Jadwal Pembelajaran';
			$data['view']='index';
			$data['action']='ns_pembelajaranjadwal';
			$this->load->view('ns_pembelajaranjadwal_v', $data);
	}

	// TAMBAH
	//-------------------------------------------------------------------------------------------
	public function tambah() {
		$data['form']='Jadwal Pembelajaran';
		$data['form_small']='Tambah Data';
		$data['view']='tambah';
		$data['edit']='0';
		$data['action']='ns_pembelajaranjadwal/tambah_p';
		$data= $this->ns_pembelajaranjadwal_db->tambah_db(" ",$data);
		$this->load->view('ns_pembelajaranjadwal_v',$data);
	}

	public function tambah_p($id='') {
		$data = array(
				'idprosestipe' => $this->input->post('idprosestipe'),
				'idmatpel' => $this->input->post('idmatpel'),
				'idtahunajaran' => $this->input->post('idtahunajaran'),
				'idkelas' => $this->input->post('idkelas'),
				'idmodultipe' => $this->input->post('idmodultipe'),
				'idregion' => $this->input->post('idregion'),
				'keterangan' => $this->input->post('keterangan'),
				'nonreguler' => $this->input->post('nonreguler'),
				'aktif' => $this->input->post('aktif'),
				'raports' => $this->input->post('raports'),
				"idperiode" => $this->input->post("idperiode"),
				"tanggalkegiatan"=> $this->p_c->tgl_db($this->input->post('tanggalkegiatan')),
				"modified_date"=> $this->dbx->cts(),
				"modified_by"=> $this->session->userdata('idpegawai'));

		if ($id<>""){
			$result = $this->ns_pembelajaranjadwal_db->ubah_pdb($data,$id) ;
		}else{
			$data = $this->p_c->arraymerge(array('created_date' => $this->dbx->cts()), $data);
			$data = $this->p_c->arraymerge(array('created_by' => $this->session->userdata('idpegawai')), $data);
			$id = $this->ns_pembelajaranjadwal_db->tambah_pdb($data) ;
			if ($id<>""){$result=TRUE;}
		}


		if($id<>""){
			/*
			$idrapottipe=$this->input->post("idrapottipe");
			$result = $this->ns_pembelajaranjadwal_db->hapusrapottipe_db($id);
			if ($result == TRUE) {
				foreach((array)$idrapottipe as $row){
					$datarapottipe = array(
								"idpembelajaranjadwal"=> $id
								,"idrapottipe"=> $row
								);
					$result=$this->ns_pembelajaranjadwal_db->tambahrapottipe_db($datarapottipe);
					unset($idrapottipevar);
					unset($datarapottipe);
				}
			}
			*/

		}

		if ($result == TRUE) {
			redirect('ns_pembelajaranjadwal/penilaian/'.$id.'/1');
		} else {
			$data['error']='Errorr...';
			$this->ubah($id,$data);
		}
	}

	// UBAH
	//-------------------------------------------------------------------------------------------
	public function ubah($id,$idprosestipe="",$idmatpel="",$idtahunajaran="",$idkelas="",$tanggalkegiatan="",$idregion="",$keterangan="") 	{
		$data['idprosestipe2']=$idprosestipe;
		$data['idmatpel2']=$idmatpel;
		$data['idtahunajaran2']=$idtahunajaran;
		$data['idkelas2']=$idkelas;
		$data['tanggalkegiatan2']=$this->p_c->tgl_db($tanggalkegiatan);
		$data['idregion2']=$idregion;
		$data['keterangan2']=$keterangan;

		$data['form']='Jadwal Pembelajaran';
		$data['form_small']='Ubah Data';
		$data['view']='tambah';
		$data['edit']='1';
		$data['action']='ns_pembelajaranjadwal/tambah_p/'.$id;
		$data= $this->ns_pembelajaranjadwal_db->tambah_db($id,$data);
		$this->load->view('ns_pembelajaranjadwal_v',$data);
	}

	// PENILAIAN
	//-------------------------------------------------------------------------------------------
	public function penilaian($id,$edit="") {
		$data['form']='Jadwal Pembelajaran';
		$data['form_small']='Penilaian';
		$data['view']='penilaian';
		$data['edit']=$edit;
		$data['action']='ns_pembelajaranjadwal/tambahnilai_p/'.$id;
		$data= $this->ns_pembelajaranjadwal_db->view_db($id,$data);
		$this->load->view('ns_pembelajaranjadwal_v',$data);
	}

	public function tambahnilai_p($id){
		$datahead = array("modified_date"=> $this->dbx->cts(),
													"modified_by"=> $this->session->userdata('idpegawai'));
		$resulthead = $this->ns_pembelajaranjadwal_db->ubah_pdb($datahead,$id) ;

		$this->ns_pembelajaranjadwal_db->hapusnilai_pdb($id);
		$rs=preg_split("/[\s,]+/", $this->input->post("rs"));
		$pdv=preg_split("/[\s,]+/", $this->input->post("pdv"));
		
		//"idkelas" => $this->input->post("idkelas"),
		foreach((array)$pdv as $rowpdv) {
			foreach((array)$rs as $rowrs) {
				//echo $rowrs.' - '.$this->input->post('jml'.$rowpdv.'/'.$rowrs).'<br/>';
				$data = array(
						"idpembelajaranjadwal" => $id,
						"idsiswa" => $rowrs,
						"idregion" => $this->input->post('idregion'.$rowrs),
						"terdaftar" =>$this->input->post('terdaftar'.$rowrs),
						"alpha" =>$this->input->post('alpha'.$rowrs),
						"sakit" =>$this->input->post('sakit'.$rowrs),
						"izin" =>$this->input->post('izin'.$rowrs),
						"tugas" =>$this->input->post('tugas'.$rowrs),
						"idpengembangandirivariabel" => $rowpdv,
						"nilai" => $this->input->post('jml'.$rowpdv.'/'.$rowrs),
						"modified_date"=> $this->dbx->cts(),
						"modified_by"=> $this->session->userdata('idpegawai'));

				//if ($id<>""){
				//	$result = $this->ns_pembelajaranjadwal_db->ubah_pdb($data,$id) ;
				//}else{
					$data = $this->p_c->arraymerge(array('created_date' => $this->dbx->cts()), $data);
					$data = $this->p_c->arraymerge(array('created_by' => $this->session->userdata('idpegawai')), $data);
					$result = $this->ns_pembelajaranjadwal_db->tambahnilai_pdb($data);
				//}
			} // for rs
		} //for rdv
		$datapj=array(
						"jumlahpd"=>count($rs),
						"modified_date"=> $this->dbx->cts(),
						"modified_by"=> $this->session->userdata('idpegawai')
					);
		$result = $this->dbx->ubahdata('ns_pembelajaranjadwal',$datapj,'replid',$id) ;

		//echo $result;die;
		if ($result == TRUE) {
			redirect('ns_pembelajaranjadwal/penilaian/'.$id.'/0');
		} else {
			$data['error']='Errorr...';
			$this->ubah($id,$data);
		}
	}

	public function hapusnilai($id) {
		$result = $this->ns_pembelajaranjadwal_db->hapusnilai_pdb($id) ;
		if ($result == TRUE) {
			redirect('ns_pembelajaranjadwal/penilaian/'.$id.'/0');
		}
	}

	public function refreshsiswa($id,$idkelas) {
		$result = $this->ns_pembelajaranjadwal_db->refreshsiswa_pdb($id,$idkelas) ;
		if ($result == TRUE) {
			redirect('ns_pembelajaranjadwal/penilaian/'.$id.'/1');
		}
	}

	//Hapus
	//-------------------------------------------------------------------------------------------
	public function hapus($id) {
		//$result = $this->ns_pembelajaranjadwal_db->hapusrapottipe_db($id);
		//$result = $this->ns_pembelajaranjadwal_db->hapusnilai_pdb($id) ;
		//$result = $this->ns_pembelajaranjadwal_db->hapus_pdb($id) ;
		$datahapus=array(
			"deletethis"=>1,
			"modified_date"=> $this->dbx->cts(),
			"modified_by"=> $this->session->userdata('idpegawai')
		);
		$result = $this->dbx->ubahdata('ns_pembelajaranjadwal',$datahapus,'replid',$id) ;
		if ($result == TRUE) {
			?><script>
					window.opener.location.reload();
					window.close();
				</script>
			<?php
		}
	}

	public function hapustotal($id) {
		//$result = $this->dbx->hapusdata($table,$row,$id) ;
		$result = $this->dbx->hapusdata('ns_pengembangandirinilai',idrapot,$id) ;
		$result = $this->dbx->hapusdata('ns_pembelajaranjadwalrapottipe',idrapot,$id) ;
		$result = $this->dbx->hapusdata('ns_pembelajaranjadwal',replid,$id) ;
		if ($result == TRUE) {
			redirect('ns_pembelajaranjadwal');
		}
	}

	public function printabsensi($id)
	{
		$data['form']='Presensi';
		$data['form_small']='Jadwal Pembelajaran';
		//$data['excel']=$excel;
		$data['edit']='0';
		$data= $this->ns_pembelajaranjadwal_db->absensi_db($id,$data);
		$this->load->view('ns_pembelajaranjadwal_print_v',$data);
	}

	public function duplikasi($replid) {
		$sqljadwal="SELECT * FROM ns_pembelajaranjadwal WHERE replid='".$replid."'";
		$datajadwal=$this->dbx->rows($sqljadwal);
		//'idmatpel' => $datajadwal->idmatpel,
		$data = array(
				'idprosestipe' => $datajadwal->idprosestipe,
				'idtahunajaran' => $datajadwal->idtahunajaran,
				'idkelas' => $datajadwal->idkelas,
				'idmodultipe' => $datajadwal->idmodultipe,
				'idregion' => $datajadwal->idregion,
				'keterangan' => $datajadwal->keterangan,
				'nonreguler' => $datajadwal->nonreguler,
				'aktif' => 1,
				"idperiode" => $datajadwal->idperiode,
				"tanggalkegiatan"=> $datajadwal->tanggalkegiatan,
				"modified_date"=> $this->dbx->cts(),
				"modified_by"=> $this->session->userdata('idpegawai'),
				"created_date"=> $this->dbx->cts(),
				"created_by"=> $this->session->userdata('idpegawai')
			);
			$replidnew = $this->dbx->tambahdata('ns_pembelajaranjadwal',$data) ;
			if ($replidnew<>""){$result=TRUE;}

		if ($result == TRUE) {
			redirect('ns_pembelajaranjadwal/ubah/'.$replidnew);
		}
	}


}//end of class
?>
