<?php

session_start(); //we need to start session in order to access it through CI

Class ksw_penempatan_mutasi extends CI_Controller {

public function __construct() {
parent::__construct();

		// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');


		// Load library
		$this->load->library('session');

		// Load database
		$this->load->model('ksw_penempatan_mutasi_db');

		if( $this->session->userdata('logged_in')) {
			if($this->dbx->checkpage($this->session->userdata('role_id'),'ksw_penempatan_mutasi')==false){
					redirect('user_authentication');
			}
		}else{
			redirect('user_authentication');;
		}

	}

	public function index()
	{
			$data= $this->ksw_penempatan_mutasi_db->data();
			$data['form']='Penempatan Pesdik Mutasi';
			$data['view']='index';
			$data['action']='ksw_penempatan_mutasi';
			$this->load->view('ksw_penempatan_mutasi_v', $data);
	}

	// TAMBAH
	//-------------------------------------------------------------------------------------------
	public function proses($idsiswa) {
		$data['form']='Penempatan Pesdik Mutasi';
		$data['form_small']='Tambah Data';
		$data['view']='proses';
		$data['action']='ksw_penempatan_mutasi/tambah_p/'.$idsiswa;
		$data= $this->ksw_penempatan_mutasi_db->tambah_db($idsiswa,$data);
		$this->load->view('ksw_penempatan_mutasi_v',$data);
	}

	public function tambah_p($idsiswa) {
		$tanggal_masuk=$this->p_c->tgl_db($this->input->post("tanggal_masuk"));
		$nisbaru=$this->dbx->carinis($tanggal_masuk,$this->input->post("kodecabang"),$this->input->post("tingkattext"));
		$datasiswa=$this->dbx->rows("SELECT * FROM siswa WHERE replid='".$idsiswa."'");
		//echo var_dump($datasiswa);
		if($datasiswa<>''){
			$data = array(
				"nisn"=> $datasiswa->nisn,
				"nama"=> $datasiswa->nama,
				"panggilan"=> $datasiswa->panggilan,
				"idangkatan"=> $datasiswa->idangkatan,
				"suku"=> $datasiswa->suku,
				"agama"=> $datasiswa->agama,
				"status"=> $datasiswa->status,
				"kondisi"=> $datasiswa->kondisi,
				"kelamin"=> $datasiswa->kelamin,
				"tmplahir"=> $datasiswa->tmplahir,
				"tgllahir"=> $datasiswa->tgllahir,
				"warga"=> $datasiswa->warga,
				"anakke"=> $datasiswa->anakke,
				"jsaudara"=> $datasiswa->jsaudara,
				"bahasa"=> $datasiswa->bahasa,
				"berat"=> $datasiswa->berat,
				"tinggi"=> $datasiswa->tinggi,
				"darah"=> $datasiswa->darah,
				"foto"=> $datasiswa->foto,
				"alamatsiswa"=> $datasiswa->alamatsiswa,
				"kodepossiswa"=> $datasiswa->kodepossiswa,
				"telponsiswa"=> $datasiswa->telponsiswa,
				"hpsiswa"=> $datasiswa->hpsiswa,
				"emailsiswa"=> $datasiswa->emailsiswa,
				"kesehatan"=> $datasiswa->kesehatan,
				"asalsekolah"=> $datasiswa->asalsekolah,
				"ketsekolah"=> $datasiswa->ketsekolah,
				"namaayah"=> $datasiswa->namaayah,
				"namaibu"=> $datasiswa->namaibu,
				"almayah"=> $datasiswa->almayah,
				"almibu"=> $datasiswa->almibu,
				"pendidikanayah"=> $datasiswa->pendidikanayah,
				"pendidikanibu"=> $datasiswa->pendidikanibu,
				"pekerjaanayah"=> $datasiswa->pekerjaanayah,
				"pekerjaanibu"=> $datasiswa->pekerjaanibu,
				"wali"=> $datasiswa->wali,
				"penghasilanayah"=> $datasiswa->penghasilanayah,
				"penghasilanibu"=> $datasiswa->penghasilanibu,
				"emailayah"=> $datasiswa->emailayah,
				"alamatsurat"=> $datasiswa->alamatsurat,
				"keterangan"=> $datasiswa->keterangan,
				"frompsb"=> $datasiswa->frompsb,
				"ketpsb"=> $datasiswa->ketpsb,
				"statusmutasi"=> $datasiswa->statusmutasi,
				"alumni"=> $datasiswa->alumni,
				"pinsiswa"=> $datasiswa->pinsiswa,
				"pinortu"=> $datasiswa->pinortu,
				"pinortuibu"=> $datasiswa->pinortuibu,
				"emailibu"=> $datasiswa->emailibu,
				"info1"=> $datasiswa->info1,
				"info2"=> $datasiswa->info2,
				"info3"=> $datasiswa->info3,
				"ts"=> $datasiswa->ts,
				"token"=> $datasiswa->token,
				"issync"=> $datasiswa->issync,
				"region"=> $datasiswa->region,
				"kota"=> $datasiswa->kota,
				"provinsi"=> $datasiswa->provinsi,
				"negara"=> $datasiswa->negara,
				"pinbbm"=> $datasiswa->pinbbm,
				"tingkat"=> $datasiswa->tingkat,
				"jurusan"=> $datasiswa->jurusan,
				"tingkat_asal"=> $datasiswa->tingkat_asal,
				"jurusan_asal"=> $datasiswa->jurusan_asal,
				"t_ijazah"=> $datasiswa->t_ijazah,
				"ijazah"=> $datasiswa->ijazah,
				"t_skh"=> $datasiswa->t_skh,
				"skh"=> $datasiswa->skh,
				"t_lhb"=> $datasiswa->t_lhb,
				"lhb"=> $datasiswa->lhb,
				"abk"=> $datasiswa->abk,
				"instansiayah"=> $datasiswa->instansiayah,
				"instansiibu"=> $datasiswa->instansiibu,
				"tel_ayah"=> $datasiswa->tel_ayah,
				"tel_ibu"=> $datasiswa->tel_ibu,
				"hp_ayah"=> $datasiswa->hp_ayah,
				"hp_ibu"=> $datasiswa->hp_ibu,
				"bbm_ayah"=> $datasiswa->bbm_ayah,
				"bbm_ibu"=> $datasiswa->bbm_ibu,
				"pendidikanwali"=> $datasiswa->pendidikanwali,
				"pekerjaanwali"=> $datasiswa->pekerjaanwali,
				"instansiwali"=> $datasiswa->instansiwali,
				"penghasilanwali"=> $datasiswa->penghasilanwali,
				"hpwali"=> $datasiswa->hpwali,
				"emailwali"=> $datasiswa->emailwali,
				"tel_wali"=> $datasiswa->tel_wali,
				"hp_wali"=> $datasiswa->hp_wali,
				"bbm_wali"=> $datasiswa->bbm_wali,
				"alamat_wali"=> $datasiswa->alamat_wali,
				"info_media"=> $datasiswa->info_media,
				"pj"=> $datasiswa->pj,
				"update_by"=> $datasiswa->update_by,
				"update_date"=> $datasiswa->update_date,
				"alamat_ibu"=> $datasiswa->alamat_ibu,
				"kota_ibu"=> $datasiswa->kota_ibu,
				"provinsi_ibu"=> $datasiswa->provinsi_ibu,
				"negara_ibu"=> $datasiswa->negara_ibu,
				"kodepos_ibu"=> $datasiswa->kodepos_ibu,
				"alamat_ayah"=> $datasiswa->alamat_ayah,
				"kota_ayah"=> $datasiswa->kota_ayah,
				"provinsi_ayah"=> $datasiswa->provinsi_ayah,
				"negara_ayah"=> $datasiswa->negara_ayah,
				"kodepos_ayah"=> $datasiswa->kodepos_ayah,
				"kota_wali"=> $datasiswa->kota_wali,
				"provinsi_wali"=> $datasiswa->provinsi_wali,
				"negara_wali"=> $datasiswa->negara_wali,
				"kodepos_wali"=> $datasiswa->kodepos_wali,
				"agama_ibu"=> $datasiswa->agama_ibu,
				"agama_ayah"=> $datasiswa->agama_ayah,
				"agama_wali"=> $datasiswa->agama_wali,
				"negara_asal"=> $datasiswa->negara_asal,
				"semester_awal"=> $datasiswa->semester_awal,
				"nis_sk"=> $datasiswa->nis_sk,
				"statanak"=> $datasiswa->statanak,
				"pja"=> $datasiswa->pja,
				"remedialperilaku"=> $datasiswa->remedialperilaku,
				"kelasstatus"=> $datasiswa->kelasstatus,
				"administrasisiswa"=> $datasiswa->administrasisiswa,
				"tgl_berlaku"=> $datasiswa->tgl_berlaku,
				"tgl_berlaku2"=> $datasiswa->tgl_berlaku2,
				"regionalstatus"=> $datasiswa->regionalstatus,
				"nomorpeserta"=> $datasiswa->nomorpeserta,
				"tahunlahirayah"=> $datasiswa->tahunlahirayah,
				"tahunlahiribu"=> $datasiswa->tahunlahiribu,
				"sekolahjenjang"=> $datasiswa->sekolahjenjang,
				"kecamatan"=> $datasiswa->kecamatan,
				"tahunlahirwali"=> $datasiswa->tahunlahirwali,
				"jaraktempuh"=> $datasiswa->jaraktempuh,
				"waktutempuh"=> $datasiswa->waktutempuh,
				"alattransportasi"=> $datasiswa->alattransportasi,
				"kps"=> $datasiswa->kps,
				"piplayak"=> $datasiswa->piplayak,
				"kip"=> $datasiswa->kip,
				"nik_ayah"=> $datasiswa->nik_ayah,
				"nik_ibu"=> $datasiswa->nik_ibu,
				"nik_wali"=> $datasiswa->nik_wali,
				"nik_siswa"=> $datasiswa->nik_siswa,
				"peringatan"=> $datasiswa->peringatan,
				"tgl_kadaluarsa"=> $datasiswa->tgl_kadaluarsa,
				"keu_tutorvisit"=> $datasiswa->keu_tutorvisit,
				"jenjangasal"=> $datasiswa->jenjangasal,
				"jenjangakhir"=> $datasiswa->jenjangakhir,
				"no_kps"=> $datasiswa->no_kps,
				"no_kip"=> $datasiswa->no_kip,
				"wali_opt"=> $datasiswa->wali_opt,
				"kecamatantext"=> $datasiswa->kecamatantext,
				"kecamatantext_ayah"=> $datasiswa->kecamatantext_ayah,
				"kecamatantext_ibu"=> $datasiswa->kecamatantext_ibu,
				"kecamatantext_wali"=> $datasiswa->kecamatantext_wali,
				"instansiayahtext"=> $datasiswa->instansiayahtext,
				"instansiibutext"=> $datasiswa->instansiibutext,
				"instansiwalitext"=> $datasiswa->instansiwalitext,
				"idtempattinggal"=> $datasiswa->idtempattinggal,
				"fotosiswa"=> $datasiswa->fotosiswa,
				"replidcalon"=> $datasiswa->replidcalon,
				
				"aktif"=>1,
				"tgl_masuk"=> $tanggal_masuk,
				"tahunmasuk"=> substr($tanggal_masuk,0,4),
				"idkelas"=> $this->input->post('idkelas'),
				"nis"=> $nisbaru,
				"created_by"=> $this->session->userdata('idpegawai'),
				"created_date"=> $this->dbx->cts(),
				"modified_date"=> $this->dbx->cts(),
				"modified_by"=> $this->session->userdata('idpegawai')
			  );
			$idsiswabaru = $this->dbx->tambahdata('siswa',$data);

			if ($idsiswabaru<>"") {
				$dataubah = array(
					"replidmutasi"=> $idsiswabaru,
					"modified_date"=> $this->dbx->cts(),
					"modified_by"=> $this->session->userdata('idpegawai')	
				);
				$result = $this->dbx->ubahdata('siswa',$dataubah,'replid',$idsiswa);
			}
		}else{
			$result=False;
		}

		if ($result == TRUE) {
			?><script>
					window.opener.location.reload();
					window.close();
				</script>
			<?php
		} else {
			redirect("ksw_penempatan_mutasi/tambah/".$replid);
		}


		die;

	}
}//end of class
?>
