<?php

session_start(); //we need to start session in order to access it through CI

Class ksw_siswa extends CI_Controller {

public function __construct() {
parent::__construct();

		// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');


		// Load library
		$this->load->library('session');

		// Load database
		$this->load->model('ksw_siswa_db');

		if( $this->session->userdata('logged_in')) {
			if($this->dbx->checkpage($this->session->userdata('role_id'),'ksw_siswa')==false){
					redirect('user_authentication');
			}
		}else{
			redirect('user_authentication');;
		}

	}

	public function index()
	{
			$data= $this->ksw_siswa_db->data();
			$data['form']='Pendataan Siswa';
			$data['view']='index';
			$data['action']='ksw_siswa';
			$data['editdata']=1;
			$this->load->view('ksw_siswa_v', $data);
	}

	public function tambah($replid,$indeks='') {
		$data['form']='Pendataan Siswa';
		$data['form_small']='Tambah Data';
		$data['view']='tambah';
		$data['action']='ksw_siswa/tambah_p/'.$replid;
		if($indeks==""){
				$data['indeks']=1;
		}else{
			$data['indeks']=$indeks;
		}
		$data= $this->ksw_siswa_db->tambah_db($replid,$data);
		$this->load->view('ksw_siswa_v',$data);
	}

	public function tambah_p($replid) {
		$result=false;
		$indeks=$this->input->post('indeks');
		if ($indeks=="1"){
			//,"kecamatan"=>$this->input->post("kecamatan")
			$idkota=$this->input->post("kota");
			if($this->input->post("kota")=="lainlain"){
				$data = array(
					'created_by' => $this->session->userdata('idpegawai')
					,'created_date' => $this->dbx->cts()
					,'modified_by' => $this->session->userdata('idpegawai')
					,"modified_date"=> $this->dbx->cts()
					,"kota" => $this->input->post("kotatext")
					,"aktif"=>1
					,"id_propinsi" => $this->input->post("provinsi")
				);
				if($this->input->post("kotatext")<>""){
					$idkota = $this->dbx->tambahdata('kota',$data);
				}
				
			}
			$data = array(
											"nik_siswa"=>$this->input->post("nik_siswa")
											,"nisn"=>$this->input->post("nisn")
											,"nomorpeserta"=>$this->input->post("nomorpeserta")
											,"nama"=>$this->input->post("nama")
											,"panggilan"=>$this->input->post("panggilan")
											,"kelamin"=>$this->input->post("kelamin")
											,"tmplahir"=>$this->input->post("tmplahir")
											,"tgllahir"=> $this->p_c->tgl_db($this->input->post('tgllahir'))
											,"agama"=>$this->input->post("agama")
											,"warga"=>$this->input->post("warga")
											,"anakke"=>$this->input->post("anakke")
											,"jsaudara"=>$this->input->post("jsaudara")
											,"statanak"=>$this->input->post("statanak")
											,"bahasa"=>$this->input->post("bahasa")
											,"negara"=>$this->input->post("negara")
											,"provinsi"=>$this->input->post("provinsi")
											,"kota"=>$idkota
											,"kecamatantext"=>$this->input->post("kecamatantext")
											,"alamatsiswa"=>$this->input->post("alamatsiswa")
											,"kodepossiswa"=>$this->input->post("kodepossiswa")
											,"telponsiswa"=>$this->input->post("telponsiswa")
											,"hpsiswa"=>$this->input->post("hpsiswa")
											,"pinbbm"=>$this->input->post("pinbbm")
											,"emailsiswa"=>$this->input->post("emailsiswa")
											,"darah"=>$this->input->post("darah")
											,"tinggi"=>$this->input->post("tinggi")
											,"berat"=>$this->input->post("berat")
											,"jenjangasal"=>$this->input->post("jenjangasal")
											,"asalsekolah"=>$this->input->post("asalsekolah")
											,"tingkat_asal"=>$this->input->post("tingkat_asal")
											,"jenjangakhir"=>$this->input->post("jenjangakhir")
											,"sekolahjenjang"=>$this->input->post("sekolahjenjang")
											,"t_ijazah"=>$this->input->post("t_ijazah")
											,"ijazah"=>$this->input->post("ijazah")
											,"t_skh"=>$this->input->post("t_skh")
											,"skh"=>$this->input->post("skh")
											,"t_lhb"=>$this->input->post("t_lhb")
											,"jaraktempuh"=>$this->input->post("jaraktempuh")
											,"waktutempuh"=>$this->input->post("waktutempuhjam").':'.$this->input->post("waktutempuhmenit").':00'
											,"kps"=>$this->input->post("kps")
											,"no_kps"=>$this->input->post("no_kps")
											,"piplayak"=>$this->input->post("piplayak")
											,"kip"=>$this->input->post("kip")
											,"no_kip"=>$this->input->post("no_kip")
											,"almayah"=>$this->input->post("almayah")
											,"almibu"=>$this->input->post("almibu")
											,"wali_opt"=>$this->input->post("wali_opt")
											,"instansiayahtext"=>$this->input->post("instansiayahtext")
											,"instansiibutext"=>$this->input->post("instansiibutext")
											,"instansiwalitext"=>$this->input->post("instansiwalitext")
											,"modified_date"=> $this->dbx->cts()
									);
									if($_FILES['fileidentitas']['name']<>""){
										$this->load->helper('form');
										$config['upload_path'] = 'uploads/fotosiswa';
										$config['allowed_types'] = 'jpg|jpeg|png|bmp';
										$config['max_size']    = '3072';
										$config['encrypt_name'] = TRUE;
										$this->load->library('upload', $config);
										$this->upload->initialize($config);
										//$this->upload->set_allowed_types('*');
										$this->upload->do_upload('fileidentitas');
										if (!$this->upload->do_upload('fileidentitas')) {
											//echo $this->upload->display_errors();die;
											$this->session->set_flashdata("errorlogin","Gagal Upload Foto, ".$this->upload->display_errors());
											redirect("ksw_siswa/tambah/".$replid."/".($indeks));die;
										}else{
											$file=$this->upload->data();
											//"fileidentitas"=>$_FILES['fileidentitas']['name'],
											$data = $this->p_c->arraymerge(array(
												"fotosiswa"=>$file['file_name'],
											), $data);
										}
								}
		}else if ($indeks=="2"){
			//,"instansiayah"=>$this->input->post("instansiayah")
			//,"instansiibu"=>$this->input->post("instansiibu")
			//,"instansiwali"=>$this->input->post("instansiwali")
			
			$idkotaayah=$this->input->post("kota_ayah");
			if($this->input->post("kota_ayah")=="lainlain"){
				$data = array(
					'created_by' => $this->session->userdata('idpegawai')
					,'created_date' => $this->dbx->cts()
					,'modified_by' => $this->session->userdata('idpegawai')
					,"modified_date"=> $this->dbx->cts()
					,"kota" => $this->input->post("kota_ayahtext")
					,"aktif"=>1
					,"id_propinsi" => $this->input->post("provinsi_ayah")
				);
				if($this->input->post("kota_ayahtext")<>""){
					$idkotaayah = $this->dbx->tambahdata('kota',$data);
				}
				
			}
			//echo $this->db->last_query();die;

			$idkotaibu=$this->input->post("kota_ibu");
			if($this->input->post("kota_ibu")=="lainlain"){
				$data = array(
					'created_by' => $this->session->userdata('idpegawai')
					,'created_date' => $this->dbx->cts()
					,'modified_by' => $this->session->userdata('idpegawai')
					,"modified_date"=> $this->dbx->cts()
					,"kota" => $this->input->post("kota_ibutext")
					,"aktif"=>1
					,"id_propinsi" => $this->input->post("provinsi_ibu")
				);
				if($this->input->post("kota_ibutext")<>""){
					$idkotaibu = $this->dbx->tambahdata('kota',$data);
				}
				
			}
			
			$idkotawali=$this->input->post("kota_wali");
			if($this->input->post("kota_wali")=="lainlain"){
				$data = array(
					'created_by' => $this->session->userdata('idpegawai')
					,'created_date' => $this->dbx->cts()
					,'modified_by' => $this->session->userdata('idpegawai')
					,"modified_date"=> $this->dbx->cts()
					,"kota" => $this->input->post("kota_walitext")
					,"aktif"=>1
					,"id_propinsi" => $this->input->post("provinsi_wali")
				);
				if($this->input->post("kota_walitext")<>""){
					$idkotawali = $this->dbx->tambahdata('kota',$data);
				}
				
			}

			$data = array(
											"namaayah"=>$this->input->post("namaayah")
											,"nik_ayah"=>$this->input->post("nik_ayah")
											,"tahunlahirayah"=>$this->input->post("tahunlahirayah")
											,"agama_ayah"=>$this->input->post("agama_ayah")
											,"pendidikanayah"=>$this->input->post("pendidikanayah")
											,"pekerjaanayah"=>$this->input->post("pekerjaanayah")
											,"penghasilanayah"=>$this->input->post("penghasilanayah")
											,"negara_ayah"=>$this->input->post("negara_ayah")
											,"provinsi_ayah"=>$this->input->post("provinsi_ayah")
											,"kota_ayah"=>$idkotaayah
											,"alamat_ayah"=>$this->input->post("alamat_ayah")
											,"kodepos_ayah"=>$this->input->post("kodepos_ayah")
											,"tel_ayah"=>$this->input->post("tel_ayah")
											,"hp_ayah"=>$this->input->post("hp_ayah")
											,"bbm_ayah"=>$this->input->post("bbm_ayah")
											,"emailayah"=>$this->input->post("emailayah")
											,"namaibu"=>$this->input->post("namaibu")
											,"almibu"=>$this->input->post("almibu")
											,"nik_ibu"=>$this->input->post("nik_ibu")
											,"tahunlahiribu"=>$this->input->post("tahunlahiribu")
											,"agama_ibu"=>$this->input->post("agama_ibu")
											,"pendidikanibu"=>$this->input->post("pendidikanibu")
											,"pekerjaanibu"=>$this->input->post("pekerjaanibu")
											,"penghasilanibu"=>$this->input->post("penghasilanibu")
											,"negara_ibu"=>$this->input->post("negara_ibu")
											,"provinsi_ibu"=>$this->input->post("provinsi_ibu")
											,"kota_ibu"=>$idkotaibu
											,"alamat_ibu"=>$this->input->post("alamat_ibu")
											,"kodepos_ibu"=>$this->input->post("kodepos_ibu")
											,"tel_ibu"=>$this->input->post("tel_ibu")
											,"hp_ibu"=>$this->input->post("hp_ibu")
											,"bbm_ibu"=>$this->input->post("bbm_ibu")
											,"emailibu"=>$this->input->post("emailibu")

											,"wali"=>$this->input->post("wali")
											,"nik_wali"=>$this->input->post("nik_wali")
											,"tahunlahirwali"=>$this->input->post("tahunlahirwali")
											,"agama_wali"=>$this->input->post("agama_wali")
											,"pendidikanwali"=>$this->input->post("pendidikanwali")
											,"pekerjaanwali"=>$this->input->post("pekerjaanwali")
											,"penghasilanwali"=>$this->input->post("penghasilanwali")
											,"negara_wali"=>$this->input->post("negara_wali")
											,"provinsi_wali"=>$this->input->post("provinsi_wali")
											,"kota_wali"=>$idkotawali
											,"alamat_wali"=>$this->input->post("alamat_wali")
											,"kodepos_wali"=>$this->input->post("kodepos_wali")
											,"tel_wali"=>$this->input->post("tel_wali")
											,"hp_wali"=>$this->input->post("hp_wali")
											,"bbm_wali"=>$this->input->post("bbm_wali")
											,"emailwali"=>$this->input->post("emailwali")

											,"alamatsurat"=>$this->input->post("alamatsurat")
											,"info_media"=>$this->p_c->arrdump($this->input->post("info_media"),",")
											,"pj"=>$this->input->post("pj")
											,"pja"=>$this->input->post("pja")

											,"modified_date"=> $this->dbx->cts()
									);
		}
		
		
		if($data<>""){
				$result = $this->dbx->ubahdata('siswa',$data,'replid',$replid);
		}


		//echo $this->db->last_query();die;

		if ($result == TRUE) {
			if ($indeks<2){
					redirect("ksw_siswa/tambah/".$replid."/".($indeks+1));
			}else{
				?><script>
						window.opener.location.reload();
						window.close();
					</script>
				<?php
			}
		} else {
			redirect("ksw_siswa/tambah/".$replid."/".$indeks);
		}
	}

	public function cetakkartu($idkelas,$idsiswa="")
	{
			$data= $this->ksw_siswa_db->cetakkartudb($idkelas,$idsiswa);
			$data['form']='Cetak Kartu';
			$data['form_small']='Cetak';
			$data['view']='index';
			$data['action']='ksw_siswa';
			$data['editdata']=1;
			$this->load->view('cetak_kartu_v', $data);
	}
	public function printthis($excel)
	{
			//echo $this->input->post('idtingkat');die;
			$data= $this->ksw_siswa_db->data();
			$data['form']='Pendataan Siswa';
			$data['form_small']='Cetak';
			$data['view']='index';
			$data['excel']=$excel;
			$this->load->view('ksw_siswa_print_v', $data);
	}

	public function cadangkandata() {
		$this->dbx->cadangkansiswa();
		redirect("ksw_siswa");
	}
}//end of class
?>
