<?php

session_start(); //we need to start session in order to access it through CI

Class registrasi extends CI_Controller {

	public function __construct() {
	parent::__construct();

		// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');


		// Load session library
		$this->load->library('session');

		// Load database
		$this->load->model('registrasi_db');
		$this->load->model('fotodisplay_db');

	}


	public function index() {
		$data['stat']="Data";
		$data['form']='Registrasi E-Recruitment PT.KPP';
		$data['view']='datadiri';
		$data['action']='registrasi/ubah_p/'.$this->session->userdata('idregistrasi');
		$data= $this->registrasi_db->tambah_x($this->session->userdata('idregistrasi'),$data);
		$this->load->view('registrasi_v',$data);
	}
	public function ubah($stat='') {
		$data['stat']="Data";
		$data['form']='Ubah Data Profil';
		$data['view']='datadiri';
		$data['action']='registrasi/ubah_p/';
		$data= $this->registrasi_db->tambah_x($this->session->userdata('idregistrasi'),$data);
		$this->load->view('registrasi_v',$data);
	}
	public function ubah_p() {
		$data = array(
				'noktp' => $this->input->post('noktp'),
				'gelarawal' => $this->input->post('gelarawal'),
				'nama' => $this->input->post('nama'),
				'gelarakhir' => $this->input->post('gelarakhir'),
				'kelamin' => $this->input->post('kelamin'),
				'tmplahir' => $this->input->post('tmplahir'),
				'tgllahir' => $this->p_c->tgl_db($this->input->post('tgllahir')),

				'telpon' => $this->input->post('telpon'),
				'telepon' => $this->input->post('telepon'),
				'handphone' => $this->input->post('handphone'),
				'handphone2' => $this->input->post('handphone2'),
				'email' => $this->input->post('email'),
				'linkedin' => $this->input->post('linkedin'),
				'instagram' => $this->input->post('instagram'),

				'alamat_tinggal' => $this->input->post('alamat_tinggal'),
				'kota' => $this->input->post('kota'),
				'provinsi' => $this->input->post('provinsi'),
				'negara' => $this->input->post('negara'),
				'kecamatan' => $this->input->post('kecamatan'),
				'kode_pos' => $this->input->post('kode_pos'),
				'tinggal_sejak' => $this->p_c->tgl_db($this->input->post('tinggal_sejak')),
				'sifat_positif' => $this->input->post('sifat_positif'),
				'sifat_negatif' => $this->input->post('sifat_negatif'),
				'created_date' =>$this->dbx->cts()
				,'modified_date' =>$this->dbx->cts()
				);

		if ($this->session->userdata('idregistrasi')<>""){
			$result = $this->dbx->ubahdata('pegawai_calon',$data,'replid',$this->session->userdata('idregistrasi')) ;
		}else{
			$result=false;
			$id = $this->dbx->tambahdata('pegawai_calon',$data) ;
			$data = array(
					'logged_in'=>1,
					'noktp' =>trim($this->input->post('noktp')),
					'nama' =>$this->input->post('nama'),
					'panggilan' =>$this->input->post('nama'),
					'idregistrasi' =>$id
					);
			 $this->session->set_userdata($data);
			if ($id<>""){$result=true;}
		}

		if ($result == true) {
			redirect('/registrasi/ubahpendidikan/');
		} else {
			$data['error']='Errorr...';
			$this->ubah($this->session->userdata('idregistrasi'),$data);
		}
	}

	//---------------------------------------------------------------------------------------------------------
	//-------------------------------------------------------------------------------------------- PENDIDIKAN
	//---------------------------------------------------------------------------------------------------------

	public function ubahpendidikan() {
		$id_registrasi=$this->session->userdata('idregistrasi');
		$data['form']='Registrasi E-Recruitment PT.KPP';
		$data['view']='pendidikan';
		$data['action']='registrasi/ubahpendidikan_p/'.$id_registrasi;
		$data= $this->registrasi_db->tambah_x($id_registrasi,$data);
		$data= $this->registrasi_db->pendidikan_db($id_registrasi,$data);
		$this->load->view('registrasi_v',$data);
	}
	public function tambahpendidikan($idx='') {
		$id_registrasi=$this->session->userdata('idregistrasi');
		$data['form']='Registrasi E-Recruitment PT.KPP';
		$data['view']='tambah_pendidikan';
		$data['action']='registrasi/tambahpendidikan_p/'.$idx;
		$data['id_pegawai']=$id_registrasi;
		$data= $this->registrasi_db->tambah_x($id_registrasi,$data);
		$data= $this->registrasi_db->tambah_pendidikan_db($id_registrasi,$idx,$data);
		$this->load->view('registrasi_v',$data);
	}
	public function tambahpendidikan_p($idx='') {
		$id_registrasi=$this->session->userdata('idregistrasi');
		$data = array(
				'calonpegawai_id' => $id_registrasi
				,'jenjang' => $this->input->post('jenjang')
				,'institusi' => $this->input->post('institusi')
				,'fakultas' => $this->input->post('fakultas')
				,'jurusan' => $this->input->post('jurusan')
				,'tahun_masuk' => $this->input->post('tahun_masuk')
				,'tahun_keluar' => $this->input->post('tahun_keluar')
				,'modified_date' =>$this->dbx->cts()
				,'modified_by' => $this->session->userdata('idregistrasi')
				);


		if ($idx<>""){
			$result = $this->registrasi_db->ubah_pendidikan_p_db($data,$idx);
		}else{
			$data = $this->p_c->arraymerge(array('created_date' => $this->dbx->cts()), $data);
			$data = $this->p_c->arraymerge(array('created_by' => $this->session->userdata('idregistrasi')), $data);
			$result = $this->registrasi_db->tambah_pendidikan_p_db($data);
		}
		//echo $this->db->last_query();die;
		if ($result == TRUE) {
			redirect('/registrasi/ubahpendidikan/'.$id_registrasi);
		} else {
			$data['error']='Errorr...';
			redirect('/registrasi/ubahpendidikan/'.$id_registrasi);
		}
	}
	public function hapuspendidikan($idx) {
		$id_registrasi=$this->session->userdata('idregistrasi');
		$result = $this->registrasi_db->hapuspendidikan_p_db($id_registrasi,$idx) ;
		if ($result == TRUE) {
			redirect('/registrasi/ubahpendidikan/'.$id_registrasi);
		}
	}

	//---------------------------------------------------------------------------------------------------------
	//----------------------------------------------------------------------------------- PENDIDIKAN NON FORMAL
	//---------------------------------------------------------------------------------------------------------

	public function ubahpendidikan_nf($stat='') {
		$id_registrasi=$this->session->userdata('idregistrasi');
		$data['form']='Registrasi E-Recruitment PT.KPP';
		$data['view']='pendidikan_nf';
		$data['action']='registrasi/ubahpendidikan_nf_p/'.$id_registrasi;
		$data= $this->registrasi_db->tambah_x($id_registrasi,$data);
		$data= $this->registrasi_db->pendidikan_nf_db($id_registrasi,$data);
		$this->load->view('registrasi_v',$data);
	}
	public function tambahpendidikan_nf($idx='') {
		$id_registrasi=$this->session->userdata('idregistrasi');
		$data['form']='Registrasi E-Recruitment PT.KPP';
		$data['view']='tambah_pendidikan_nf';
		$data['action']='registrasi/tambahpendidikan_nf_p/'.$idx;
		$data['id_registrasi']=$id_registrasi;
		$data= $this->registrasi_db->tambah_x($id_registrasi,$data);
		$data= $this->registrasi_db->tambah_pendidikan_nf_db($id_registrasi,$idx,$data);
		$this->load->view('registrasi_v',$data);
	}
	public function tambahpendidikan_nf_p($idx='') {
		$id_registrasi=$this->session->userdata('idregistrasi');
		//,'tgl_masuk' => $this->p_c->tgl_db($this->input->post('tgl_masuk'))
		//,'tgl_keluar' => $this->p_c->tgl_db($this->input->post('tgl_keluar'))

		$data = array(
				'calonpegawai_id' => $id_registrasi
				,'institusi' => $this->input->post('institusi')
				,'keterangan' => $this->input->post('keterangan')
				,'tahun_masuk' => $this->input->post('tahun_masuk')
				,'tahun_keluar' => $this->input->post('tahun_keluar')
				,'dibiayai' => $this->input->post('dibiayai')
				,'modified_date' =>$this->dbx->cts()
				,'modified_by' => $this->session->userdata('idregistrasi')
				);


		if ($idx<>""){
			$result = $this->registrasi_db->ubah_pendidikan_nf_p_db($data,$idx);
		}else{
			$data = $this->p_c->arraymerge(array('created_date' => $this->dbx->cts()), $data);
			$data = $this->p_c->arraymerge(array('created_by' => $this->session->userdata('idregistrasi')), $data);
			$result = $this->registrasi_db->tambah_pendidikan_nf_p_db($data);
		}
		if ($result == TRUE) {
			redirect('/registrasi/ubahpendidikan_nf/'.$id_registrasi);
		} else {
			$data['error']='Errorr...';
			redirect('/registrasi/ubahpendidikan_nf/'.$id_registrasi);
		}
	}
	public function hapuspendidikan_nf($idx) {
		$id_registrasi=$this->session->userdata('idregistrasi');
		$result = $this->registrasi_db->hapuspendidikan_nf_p_db($id_registrasi,$idx) ;
		if ($result == TRUE) {
			redirect('/registrasi/ubahpendidikan_nf/'.$id_registrasi);
		}
	}
	//---------------------------------------------------------------------------------------------------------
	//-------------------------------------------------------------------------------------------------- BAHASA
	//---------------------------------------------------------------------------------------------------------

	public function ubahbahasa($stat='') {
		$id_registrasi=$this->session->userdata('idregistrasi');
		$data['form']='Registrasi E-Recruitment PT.KPP';
		$data['view']='bahasa';
		$data['action']='registrasi/ubahbahasa_p/'.$id_registrasi;
		$data= $this->registrasi_db->tambah_x($id_registrasi,$data);
		$data= $this->registrasi_db->bahasa_db($id_registrasi,$data);
		$this->load->view('registrasi_v',$data);
	}
	public function tambahbahasa($idx='') {
		$id_registrasi=$this->session->userdata('idregistrasi');
		$data['form']='Registrasi E-Recruitment PT.KPP';
		$data['view']='tambah_bahasa';
		$data['action']='registrasi/tambahbahasa_p/'.$idx;
		$data= $this->registrasi_db->tambah_x($id_registrasi,$data);
		$data= $this->registrasi_db->tambah_bahasa_db($id_registrasi,$idx,$data);
		$this->load->view('registrasi_v',$data);
	}
	public function tambahbahasa_p($idx='') {
		$id_registrasi=$this->session->userdata('idregistrasi');
		$data = array(
				'calonpegawai_id' => $id_registrasi
				,'bahasa' => $this->input->post('bahasa')
				,'bicara' => $this->input->post('bicara')
				,'menulis' => $this->input->post('menulis')
				,'membaca' => $this->input->post('membaca')
				,'toefl' => $this->input->post('toefl')
				,'modified_date' =>$this->dbx->cts()
				,'modified_by' => $this->session->userdata('idregistrasi')
				);


		if ($idx<>""){
			$result = $this->registrasi_db->ubah_bahasa_p_db($data,$idx);
		}else{
			$data = $this->p_c->arraymerge(array('created_date' => $this->dbx->cts()), $data);
			$data = $this->p_c->arraymerge(array('created_by' => $this->session->userdata('idregistrasi')), $data);
			$result = $this->registrasi_db->tambah_bahasa_p_db($data);
		}

		if ($result == TRUE) {
			redirect('/registrasi/ubahbahasa/'.$id_registrasi);
		} else {
			$data['error']='Errorr...';
			redirect('/registrasi/ubahbahasa/'.$id_registrasi);
		}
	}
	public function hapusbahasa($idx) {
		$id_registrasi=$this->session->userdata('idregistrasi');
		$result = $this->registrasi_db->hapusbahasa_p_db($id_registrasi,$idx) ;
		if ($result == TRUE) {
			redirect('/registrasi/ubahbahasa/'.$id_registrasi);
		}
	}
	//---------------------------------------------------------------------------------------------------------
	//------------------------------------------------------------------------------------------------ KOMPUTER
	//---------------------------------------------------------------------------------------------------------

	public function ubahkomputer($stat='') {
		$id_registrasi=$this->session->userdata('idregistrasi');
		$data['form']='Registrasi E-Recruitment PT.KPP';
		$data['view']='komputer';
		$data['action']='registrasi/ubahkomputer_p/'.$id_registrasi;
		$data= $this->registrasi_db->tambah_x($id_registrasi,$data);
		$data= $this->registrasi_db->komputer_db($id_registrasi,$data);
		$this->load->view('registrasi_v',$data);
	}
	public function tambahkomputer($idx='') {
		$id_registrasi=$this->session->userdata('idregistrasi');
		$data['form']='Registrasi E-Recruitment PT.KPP';
		$data['view']='tambah_komputer';
		$data['action']='registrasi/tambahkomputer_p/'.$idx;
		$data= $this->registrasi_db->tambah_x($id_registrasi,$data);
		$data= $this->registrasi_db->tambah_komputer_db($id_registrasi,$idx,$data);
		$this->load->view('registrasi_v',$data);
	}
	public function tambahkomputer_p($idx='') {
		$id_registrasi=$this->session->userdata('idregistrasi');
		$data = array(
				'calonpegawai_id' => $id_registrasi
				,'komputer' => $this->input->post('komputer')
				,'bidang' => $this->input->post('bidang')
				,'tingkat' => $this->input->post('tingkat')
				,'keterangan' => $this->input->post('keterangan')
				,'modified_date' =>$this->dbx->cts()
				,'modified_by' => $this->session->userdata('idregistrasi')
				);


		if ($idx<>""){
			$result = $this->registrasi_db->ubah_komputer_p_db($data,$idx);
		}else{
			$data = $this->p_c->arraymerge(array('created_date' => $this->dbx->cts()), $data);
			$data = $this->p_c->arraymerge(array('created_by' => $this->session->userdata('idregistrasi')), $data);
			$result = $this->registrasi_db->tambah_komputer_p_db($data);
		}

		if ($result == TRUE) {
			redirect('/registrasi/ubahkomputer/'.$id_registrasi);
		} else {
			$data['error']='Errorr...';
			redirect('/registrasi/ubahkomputer/'.$id_registrasi);
		}
	}
	public function hapuskomputer($idx) {
		$id_registrasi=$this->session->userdata('idregistrasi');
		$data['form']='Registrasi E-Recruitment PT.KPP';

		$result = $this->registrasi_db->hapuskomputer_p_db($id_registrasi,$idx) ;
		if ($result == TRUE) {
			redirect('/registrasi/ubahkomputer/'.$id_registrasi);
		}
	}

	//---------------------------------------------------------------------------------------------------------
	//--------------------------------------------------------------------------------------- PENGALAMAN KERJA
	//---------------------------------------------------------------------------------------------------------

	public function ubahkerja($stat='') {
		$id_registrasi=$this->session->userdata('idregistrasi');
		$data['form']='Registrasi E-Recruitment PT.KPP';
		$data['view']='kerja';
		$data['action']='registrasi/ubahkerja_p/'.$id_registrasi;
		$data= $this->registrasi_db->tambah_x($id_registrasi,$data);
		$data= $this->registrasi_db->kerja_db($id_registrasi,$data);
		$this->load->view('registrasi_v',$data);
	}
	public function tambahkerja($idx='') {
		$id_registrasi=$this->session->userdata('idregistrasi');
		$data['form']='Registrasi E-Recruitment PT.KPP';
		$data['view']='tambah_kerja';
		$data['action']='registrasi/tambahkerja_p/'.$idx;
		$data['id_pegawai']=$id_registrasi;
		$data= $this->registrasi_db->tambah_x($id_registrasi,$data);
		$data= $this->registrasi_db->tambah_kerja_db($id_registrasi,$idx,$data);
		$this->load->view('registrasi_v',$data);
	}

	public function tambahkerja_p($idx='') {
		$id_registrasi=$this->session->userdata('idregistrasi');
		//				,'tgl_masuk' => $this->p_c->tgl_db($this->input->post('tgl_masuk'))
		//				,'tgl_keluar' => $this->p_c->tgl_db($this->input->post('tgl_keluar'))

		$data = array(
				'calonpegawai_id' => $id_registrasi
				,'tahun_masuk' => $this->input->post('tahun_masuk')
				,'tahun_keluar' => $this->input->post('tahun_keluar')
				,'instansi' => $this->input->post('instansi')
				,'bidang_usaha' => $this->input->post('bidang_usaha')
				,'jabatan' => $this->input->post('jabatan')
				,'alamat' => $this->input->post('alamat')
				,'keterangan' => $this->input->post('keterangan')
				,'modified_date' =>$this->dbx->cts()
				,'modified_by' => $this->session->userdata('idregistrasi')
				);


		if ($idx<>""){
			$result = $this->registrasi_db->ubah_kerja_p_db($data,$idx);
		}else{
			$data = $this->p_c->arraymerge(array('created_date' => $this->dbx->cts()), $data);
			$data = $this->p_c->arraymerge(array('created_by' => $this->session->userdata('idregistrasi')), $data);
			$result = $this->registrasi_db->tambah_kerja_p_db($data);
		}

		if ($result == TRUE) {
			redirect('/registrasi/ubahkerja/'.$id_registrasi);
		} else {
			$data['error']='Errorr...';
			redirect('/registrasi/ubahkerja/'.$id_registrasi);
		}
	}
	public function hapuskerja($idx) {
		$id_registrasi=$this->session->userdata('idregistrasi');
		$result = $this->registrasi_db->hapuskerja_p_db($id_registrasi,$idx) ;
		if ($result == TRUE) {
			redirect('/registrasi/ubahkerja/'.$id_registrasi);
		}
	}
} //end of class
?>
