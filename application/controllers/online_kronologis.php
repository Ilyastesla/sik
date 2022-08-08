<?php

session_start(); //we need to start session in order to access it through CI

Class online_kronologis extends CI_Controller {

public function __construct() {
parent::__construct();

		// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');


		// Load library
		$this->load->library('session');

		// Load database
		$this->load->model('online_kronologis_db');

   if( $this->session->userdata('logged_in')) {
       if($this->dbx->checkpage($this->session->userdata('role_id'),'online_kronologis')==false){
          redirect('user_authentication');
       }
		}else{
			redirect('user_authentication');;
		}

	}

	public function index($data="")
	{
			$data = $this->online_kronologis_db->data();
			$data['form']='Online Kronologis CPD';
			$data['view']='index';
			$data['action']='online_kronologis';
			$this->load->view('online_kronologis_v', $data);
	}


	// Tambah
	//-------------------------------------------------------------------------------------------
	public function saranpsb($replid="") {
		$data['form']='Online Kronologis CPD';
		if($replid<>""){
			$data['form_small']='Tambah Data';
		}else{
			$data['form_small']='Ubah Data';
		}
		$data['view']='tambah';
		$data['edit']=1;
		$data['action']='online_kronologis/tambah_p/'.$replid;
		$data= $this->online_kronologis_db->tambah_db($replid,$data);
		$this->load->view('online_kronologis_v',$data);
	}

	public function tambah_p($replid) {
		$datakronologis=$this->dbx->rows("SELECT * FROM online_kronologis WHERE replid='".$replid."'");

		$nopendaftaran= $this->online_kronologis_db->nopendaftaran($datakronologis->idunitbisnis,$this->input->post("idproses"),str_replace('-','',$this->input->post('tanggaldaftar')));
		//,"jenjangasal"=>$datakronologis->jenjangasal

		$ortu="ibu";
		if($datakronologis->ortu<>""){
				$ortu=strtolower($datakronologis->ortu);
		}
		$data = array(
										"idtahunajaran"=>$this->input->post("idtahunajaran")
										,"tahunmasuk"=>substr($this->input->post('tanggaldaftar'),-4)
										,"nopendaftaran"=>$nopendaftaran
										,"nik_".$ortu=>$datakronologis->noidentitas
										,"tahunlahir".$ortu=>$datakronologis->tahunlahirortu
										,"tel_".$ortu=>$datakronologis->teleponortu
										,"hp_".$ortu=>$datakronologis->handphoneortu
										,"email".$ortu=>$datakronologis->emailortu
										,"bbm_".$ortu=>$datakronologis->whatsapportu
										,"nama"=>$datakronologis->namacalon
										,"kelamin"=>$datakronologis->jeniskelamin
										,"tmplahir"=>$datakronologis->tempatlahir
										,"tgllahir"=>$datakronologis->tanggallahir
										,"negara"=>$datakronologis->negara
										,"provinsi"=>$datakronologis->propinsi
										,"kota"=>$datakronologis->kota
										,"kecamatan"=>$datakronologis->kecamatan
										,"jenjangasal"=>$datakronologis->jenjangasal
										,"asalsekolah"=>$datakronologis->asalsekolah
										,"tingkat_asal"=>$datakronologis->idtingkatasal
										,"jurusan_asal"=>$datakronologis->idjurusanasal
										,"tingkat"=>$datakronologis->idtingkat
										,"jurusan"=>$datakronologis->idjurusan
										,"idproses"=>$this->input->post("idproses")
										,"idkelompok"=>$this->input->post("idkelompok")
										,"kondisi"=>$this->input->post("idkondisi")
										,"region"=>$this->input->post("idregion")
										,"abk"=>$this->input->post("abk")
										,"remedialperilaku"=>$this->input->post("remedialperilaku")
										,"aktif"=>0
										,"tanggal_daftar"=> $this->p_c->tgl_db($this->input->post('tanggaldaftar'))
										,"created_date"=>$this->dbx->cts()
										,"created_by"=>$this->session->userdata('idpegawai')
										,"modified_date"=>$this->dbx->cts()
										,"modified_by"=>$this->session->userdata('idpegawai')
								);
		if($ortu<>"wali"){
				$data = $this->p_c->arraymerge(array("nama".$ortu=>$datakronologis->namaortu), $data);
		}else{
				$data = $this->p_c->arraymerge(array("wali"=>$datakronologis->namaortu), $data);
		}
		$idcalon = $this->dbx->tambahdata('calonsiswa',$data);
		//echo $this->db->last_query();die;
		if ($idcalon<>""){
			$result=TRUE;
			foreach((array)$this->input->post("iddokumentipe") as $iddokumentipe) {
					$result=$this->db->query("DELETE FROM psb_calonsiswa_attachment WHERE idcalonsiswa='".$idcalon."' AND iddokumentipe='".$iddokumentipe."'");
					$result=$this->dbx->tambahdata('psb_calonsiswa_attachment',array("idcalonsiswa"=>$idcalon,"iddokumentipe"=>$iddokumentipe));
			}

		}

		$data = array(
                    "idtahunajaran"=>$this->input->post("idtahunajaran")
                    ,"idproses"=>$this->input->post("idproses")
                    ,"idkelompok"=>$this->input->post("idkelompok")
                    ,"idkondisi"=>$this->input->post("idkondisi")
                    ,"idregion"=>$this->input->post("idregion")
                    ,"abk"=>$this->input->post("abk")
					,"remedialperilaku"=>$this->input->post("remedialperilaku")
					,"keterangan"=>$this->input->post("keterangan")
					
                    ,"tanggaldaftar"=> $this->p_c->tgl_db($this->input->post('tanggaldaftar'))
										,"status"=>'3'
										,"idcalon"=>$idcalon
										,"modified_date"=> $this->dbx->cts()
										,"proses_by"=> $this->session->userdata('idpegawai')
								);
		$result = $this->dbx->ubahdata('online_kronologis',$data,'replid',$replid);



		if ($result == TRUE) {
			?>
				<!--
				<script>
					window.opener.location.reload();
					window.close();
				</script>
			-->
			<?php
			redirect("online_kronologis/viewkronologis/".$replid);
		} else {
			$data['error']="Errorr...";
			$this->tambah($replid,$data);
		}
	}

	public function ubahstatus($status,$replid) {
		$data=array(
				'status' =>$status
				,"modified_date"=> $this->dbx->cts()
				,"proses_by"=> $this->session->userdata('idpegawai'));
		$result = $this->dbx->ubahdata('online_kronologis',$data,'replid',$replid);
		//echo $this->db->last_query();die;
    ?><script>
        window.opener.location.reload();
        window.close();
      </script>
    <?php
	}

	public function viewkronologis($replid) {
		$data['form']='Online Kronologis CPD';
		$data['form_small']='Lihat Data';
		$data['view']='tambah';
		$data['edit']=0;
		$data['action']='online_kronologis/tambah_p/'.$replid;
		//$data= $this->online_kronologis_db->viewkronologis_db($replid,$data);
		$data= $this->online_kronologis_db->tambah_db($replid,$data);
		$this->load->view('online_kronologis_v',$data);
	}

	public function verifikasicpd($replid) {
		$data=array(
				'verifikasi' =>1
				,"modified_date"=> $this->dbx->cts()
				,"modified_by"=> $this->session->userdata('idpegawai'));
		$result = $this->dbx->ubahdata('calonsiswa',$data,'replid',$replid);
		//echo $this->db->last_query();die;
    ?><script>
        window.opener.location.reload();
        window.close();
      </script>
    <?php
	}
}//end of class
?>
