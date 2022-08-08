<?php

session_start(); //we need to start session in order to access it through CI

Class pegawai extends CI_Controller {

	public function __construct() {
	parent::__construct();

		// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');


		// Load session library
		$this->load->library('session');

		// Load database
		$this->load->model('pegawai_db');
		$this->load->model('fotodisplay_db');

   if( $this->session->userdata('logged_in')) {
       if($this->dbx->checkpage($this->session->userdata('role_id'),'pegawai')==false){
          redirect('user_authentication');
       }
		}else{
			redirect('user_authentication');;
		}

	}

	public function index()
	{
		$data= $this->pegawai_db->data();
		$data['action']='pegawai';
		$data['form']='Data Pegawai';
		$data['view']='index';
		$this->load->view('pegawai_v', $data);
	}

	public function printpegawai($excel)
	{
		$data= $this->pegawai_db->data();
		$data['form']='Pegawai';
		$data['form_small']='Cetak';
		$data['excel']=$excel;
		$this->load->view('pegawai_print_v', $data);
	}


	public function tambah($id='',$stat='') {
		$data['view']='datadiri';
		$data['action']='pegawai/ubah_p';
		$data= $this->pegawai_db->tambah_x($id,$data);
		$this->load->view('pegawai_add',$data);
	}
	public function ubah($id,$stat='') {
		$data['view']='datadiri';
		$data['action']='pegawai/ubah_p/'.$id;
		$data= $this->pegawai_db->tambah_x($id,$data);
		$this->load->view('pegawai_add',$data);
	}
	public function ubah_p($id='') {
		$data = array(
				'idcompany' => $this->input->post('idcompany'),
				'nuptk' => $this->input->post('nuptk'),
				'nrp' => $this->input->post('nrp'),
				'gelarawal' => $this->input->post('gelarawal'),
				'nama' => $this->input->post('nama'),
				'gelarakhir' => $this->input->post('gelarakhir'),
				'panggilan' => $this->input->post('panggilan'),
				'kelamin' => $this->input->post('kelamin'),
				'warganegara' => $this->input->post('warganegara'),
				'tmplahir' => $this->input->post('tmplahir'),
				'tgllahir' => $this->p_c->tgl_db($this->input->post('tgllahir')),
				'golongan_darah' => $this->input->post('golongan_darah'),
				'agama' => $this->input->post('agama'),

				'status_nikah' => $this->input->post('status_nikah'),
				'tgl_nikah' => $this->p_c->tgl_db($this->input->post('tgl_nikah')),
				'anak_ke' => $this->input->post('anak_ke'),
				'jml_saudara' => $this->input->post('jml_saudara'),
				'nama_gadis_ibu' => $this->input->post('nama_gadis_ibu'),
				'nama_ayah' => $this->input->post('nama_ayah'),
				'pekerjaan_ayah' => $this->input->post('pekerjaan_ayah'),
				'pekerjaan_ibu' => $this->input->post('pekerjaan_ibu'),
				'jml_anak' => $this->input->post('jml_anak'),
				'kode_pajak' => $this->input->post('kode_pajak'),
				'keterangan' => $this->input->post('keterangan')
				,'modified_date' =>$this->dbx->cts()
				,'modified_by' => $this->session->userdata('idpegawai')
				);
		if ($this->input->post('nip')<>""){
			$data = $this->p_c->arraymerge(array('nip' => trim($this->input->post('nip'))), $data);
		}
		if ($id<>""){
			$result = $this->pegawai_db->ubah($data,$id) ;
		}else{
			$result=false;
			$id = $this->pegawai_db->tambah($data) ;
			if ($id<>""){$result=true;}
		}

		if ($result == true) {
			redirect('/pegawai/ubahkontak/'.$id);
		} else {
			$data['error']='Errorr...';
			$this->ubah($id,$data);
		}
	}

	public function ubahaktif_p($id,$aktif,$nip) {
		if($aktif==1){
			$data = array('aktif'=>'0');
			$result = $this->pegawai_db->diactivelogin($data,$nip) ;

		}else{
			$data = array('aktif'=>'1');
			$result = $this->pegawai_db->diactivelogin($data,$nip) ;
		}

		$result = $this->pegawai_db->ubah($data,$id) ;
		redirect('/pegawai');
	}
	//---------------------------------------------------------------------------------------------------------
	//------------------------------------------------------------------------------------------------- KONTAK
	//---------------------------------------------------------------------------------------------------------


	public function ubahkontak($id,$stat='') {
		$data['view']='kontak';
		$data['action']='pegawai/ubahkontak_p/'.$id;
		$data= $this->pegawai_db->tambah_x($id,$data);
		$this->load->view('pegawai_add',$data);
	}

	public function ubahkontak_p($id) {
		$data = array(
				'alamat_tinggal2' => $this->input->post('alamat_tinggal2'),
				'kecamatan2' => $this->input->post('kecamatan2'),
				'kota2' => $this->input->post('kota2'),
				'provinsi2' => $this->input->post('provinsi2'),
				'negara2' => $this->input->post('negara2'),
				'kode_pos2' => $this->input->post('kode_pos2'),
				'alamat_tinggal' => $this->input->post('alamat_tinggal'),
				'kecamatan' => $this->input->post('kecamatan'),
				'kota' => $this->input->post('kota'),
				'provinsi' => $this->input->post('provinsi'),
				'negara' => $this->input->post('negara'),
				'kode_pos' => $this->input->post('kode_pos'),
				'telepon' => $this->input->post('telepon'),
				'handphone' => $this->input->post('handphone'),
				'handphone2' => $this->input->post('handphone2'),
				'Email' => $this->input->post('email'),
				'bbm' => $this->input->post('bbm'),
				'linkedin' => $this->input->post('linkedin'),
				'instagram' => $this->input->post('instagram'),
				'facebook' => $this->input->post('facebook'),
				'twitter' => $this->input->post('twitter'),
				'website' => $this->input->post('website'),
				'tinggal_sejak' => $this->p_c->tgl_db($this->input->post('tinggal_sejak')),
				'tinggal_sejak2' => $this->p_c->tgl_db($this->input->post('tinggal_sejak2'))
				,'modified_date' =>$this->dbx->cts()
				,'modified_by' => $this->session->userdata('idpegawai')
				);
		$result = $this->pegawai_db->ubah($data,$id) ;
		if ($result == TRUE) {
			redirect('/pegawai/ubahperbankan/'.$id);
		} else {
			$data['error']='Errorr...';
			$this->ubahkontak($id,$data);
		}
	}

	//---------------------------------------------------------------------------------------------------------
	//------------------------------------------------------------------------------------------ PERBANKAN
	//---------------------------------------------------------------------------------------------------------
	public function ubahperbankan($id) {
		$data['view']='perbankan';
		$data['action']='pegawai/ubahperbankan_p/'.$id;
		$data= $this->pegawai_db->tambah_x($id,$data);
		$data= $this->pegawai_db->perbankan_db($id,$data);
		$this->load->view('pegawai_add',$data);
	}
	public function tambahperbankan($id_pegawai,$idx='') {
		$data['view']='tambah_perbankan';
		$data['action']='pegawai/tambahperbankan_p/'.$id_pegawai.'/'.$idx;
		$data['id_pegawai']=$id_pegawai;
		$data= $this->pegawai_db->tambah_x($id_pegawai,$data);
		$data= $this->pegawai_db->tambah_perbankan($id_pegawai,$idx,$data);
		$this->load->view('pegawai_add',$data);
	}
	public function tambahperbankan_p($id_pegawai,$idx='') {
		$data = array(
				'pegawai_id' => $id_pegawai,
				'type' => $this->input->post('type'),
				'nomor' => $this->input->post('nomor'),
				'tgl_pembuatan' => $this->p_c->tgl_db($this->input->post('tgl_pembuatan')),
				'berlaku' => $this->p_c->tgl_db($this->input->post('berlaku')),
				'keterangan' => $this->input->post('keterangan')
				,'modified_date' =>$this->dbx->cts()
				,'modified_by' => $this->session->userdata('idpegawai')
				);
		if ($idx<>""){
			$result = $this->pegawai_db->ubah_perbankan_db($data,$idx);
		}else{
			$data = $this->p_c->arraymerge(array('created_date' => $this->dbx->cts()), $data);
			$data = $this->p_c->arraymerge(array('created_by' => $this->session->userdata('idpegawai')), $data);
			$result = $this->pegawai_db->tambah_perbankan_db($data);
		}

		if ($result == TRUE) {
			//redirect('/pegawai/ubahperbankan/'.$id_pegawai);
			?><script>
					window.opener.location.reload();
					window.close();
				</script>
			<?php
		} else {
			$data['error']='Errorr...';
			redirect('/pegawai/ubahperbankan/'.$id_pegawai);
		}
	}
	public function hapusperbankan($id_pegawai,$idx) {
		$result = $this->pegawai_db->hapusperbankan_db($id_pegawai,$idx) ;
		if ($result == TRUE) {
			//redirect('/pegawai/ubahperbankan/'.$id_pegawai);
			?><script>
					window.opener.location.reload();
					window.close();
				</script>
			<?php
		}
	}
	//---------------------------------------------------------------------------------------------------------
	//------------------------------------------------------------------------------------------ KONTAK DARURAT
	//---------------------------------------------------------------------------------------------------------

	public function ubahkontakdarurat($id) {
		$data['view']='kontak_darurat';
		$data['action']='pegawai/ubahdarurat_p/'.$id;
		$data= $this->pegawai_db->tambah_x($id,$data);
		$data= $this->pegawai_db->kontakdarurat_db($id,$data);
		$this->load->view('pegawai_add',$data);
	}

	public function tambahkontakdarurat($id_pegawai,$idx='') {
		$data['view']='tambah_kontak_darurat';
		$data['action']='pegawai/tambahdarurat_p/'.$id_pegawai.'/'.$idx;
		$data['id_pegawai']=$id_pegawai;
		$data= $this->pegawai_db->tambah_x($id_pegawai,$data);
		$data= $this->pegawai_db->tambah_kontak_darurat($id_pegawai,$idx,$data);
		$this->load->view('pegawai_add',$data);
	}

	public function tambahdarurat_p($id_pegawai,$idx='') {
		$data = array(
				'pegawai_id' => $id_pegawai,
				'nama' => $this->input->post('nama'),
				'alamat' => $this->input->post('alamat'),
				'kecamatan' => $this->input->post('kecamatan'),
				'kota' => $this->input->post('kota'),
				'provinsi' => $this->input->post('provinsi'),
				'kode_pos' => $this->input->post('kode_pos'),
				'negara' => $this->input->post('negara'),
				'telepon' => $this->input->post('telepon'),
				'handphone' => $this->input->post('handphone'),
				'email' => $this->input->post('email'),
				'hubungan'=> $this->input->post('hubungan')
				,'created_date' =>$this->dbx->cts()
				,'created_by' => $this->session->userdata('idpegawai')
				,'modified_date' =>$this->dbx->cts()
				,'modified_by' => $this->session->userdata('idpegawai')
				);
		if ($idx<>""){
			$result = $this->pegawai_db->ubah_kontak_darurat_db($data,$idx);
		}else{
			$result = $this->pegawai_db->tambah_kontak_darurat_db($data);
		}

		if ($result == TRUE) {
			//redirect('/pegawai/ubahkontakdarurat/'.$id_pegawai);
			?><script>
					window.opener.location.reload();
					window.close();
				</script>
			<?php
		} else {
			$data['error']='Errorr...';
			redirect('/pegawai/ubahkontakdarurat/'.$id_pegawai);
		}
	}

	public function hapuskontakdarurat($id_pegawai,$idx) {
		$result = $this->pegawai_db->hapuskontakdarurat_db($id_pegawai,$idx) ;
		if ($result == TRUE) {
			//redirect('/pegawai/ubahkontakdarurat/'.$id_pegawai);
			?><script>
					window.opener.location.reload();
					window.close();
				</script>
			<?php
		}
	}

	//---------------------------------------------------------------------------------------------------------
	//------------------------------------------------------------------------------------------ UBAH KELUARGA
	//---------------------------------------------------------------------------------------------------------

	public function ubahkeluarga($id) {
		$data['view']='keluarga';
		$data['action']='pegawai/ubahdarurat_p/'.$id;
		$data= $this->pegawai_db->tambah_x($id,$data);
		$data= $this->pegawai_db->keluarga_db($id,$data);
		$this->load->view('pegawai_add',$data);
	}

	public function tambahkeluarga($id_pegawai,$idx='') {
		$data['view']='tambah_keluarga';
		$data['action']='pegawai/tambahkeluarga_p/'.$id_pegawai.'/'.$idx;
		$data['id_pegawai']=$id_pegawai;
		$data= $this->pegawai_db->tambah_x($id_pegawai,$data);
		$data= $this->pegawai_db->tambah_keluarga_db($id_pegawai,$idx,$data);
		$this->load->view('pegawai_add',$data);
	}

	public function tambahkeluarga_p($id_pegawai,$idx='') {
		$data = array(
				'pegawai_id' => $id_pegawai,
				'nama' => $this->input->post('nama'),
				'hubungan' => $this->input->post('hubungan'),
				'jenis_kelamin' => $this->input->post('jenis_kelamin'),
				'tempat_lahir' => $this->input->post('tempat_lahir'),
				'tanggal_lahir' =>$this->p_c->tgl_db($this->input->post('tanggal_lahir')),
				'pendidikan_terakhir' => $this->input->post('pendidikan_terakhir'),
				'pekerjaan' => $this->input->post('pekerjaan'),
				'instansi' => $this->input->post('instansi')
				,'created_date' =>$this->dbx->cts()
				,'created_by' => $this->session->userdata('idpegawai')
				,'modified_date' =>$this->dbx->cts()
				,'modified_by' => $this->session->userdata('idpegawai')
				);


		if ($idx<>""){
			$result = $this->pegawai_db->ubah_keluarga_p_db($data,$idx);
		}else{
			$result = $this->pegawai_db->tambah_keluarga_p_db($data);
		}

		if ($result == TRUE) {
			//redirect('/pegawai/ubahkeluarga/'.$id_pegawai);
			?><script>
					window.opener.location.reload();
					window.close();
				</script>
			<?php
		} else {
			$data['error']='Errorr...';
			redirect('/pegawai/ubahkeluarga/'.$id_pegawai);
		}
	}

	public function hapuskeluarga($id_pegawai,$idx) {
		$result = $this->pegawai_db->hapuskeluarga_p_db($id_pegawai,$idx) ;
		if ($result == TRUE) {
			//redirect('/pegawai/ubahkeluarga/'.$id_pegawai);
			?><script>
					window.opener.location.reload();
					window.close();
				</script>
			<?php
		}
	}

	//---------------------------------------------------------------------------------------------------------
	//-------------------------------------------------------------------------------------------- KEPRIBADIAN
	//---------------------------------------------------------------------------------------------------------


	public function ubahkepribadian($id,$stat='') {
		$data['view']='kepribadian';
		$data['action']='pegawai/ubahkepribadian_p/'.$id;
		$data= $this->pegawai_db->tambah_x($id,$data);
		$this->load->view('pegawai_add',$data);
	}

	public function ubahkepribadian_p($id) {
		//,'perkembangan_pribadi' => $this->input->post('perkembangan_pribadi')
		$data = array(
				'berat_badan' => $this->input->post('berat_badan')
				,'tinggi_badan' => $this->input->post('tinggi_badan')
				,'hobi' => $this->input->post('hobi')
				,'warna' => $this->input->post('warna')
				,'barang' => $this->input->post('barang')
				,'ukuran_celana' => $this->input->post('ukuran_celana')
				,'ukuran_baju' => $this->input->post('ukuran_baju')
				,'ukuran_sepatu' => $this->input->post('ukuran_sepatu')
				,'motto' => $this->input->post('motto')
				,'tokoh' => $this->input->post('tokoh')
				,'target' => $this->input->post('target')
				,'merokok' => $this->input->post('merokok')
				,'sakit_ringan' => $this->input->post('sakit_ringan')
				,'sakit_berat' => $this->input->post('sakit_berat')
				,'kondisi_sekarang' => $this->input->post('kondisi_sekarang')
				,'sifat_positif' => $this->input->post('sifat_positif')
				,'sifat_negatif' => $this->input->post('sifat_negatif')
				,'minat' => $this->input->post('minat')
				,'daftar_buku' => $this->input->post('daftar_buku')
				,'alasan_bekerja' => $this->input->post('alasan_bekerja')
				,'modified_date' =>$this->dbx->cts()
				,'modified_by' => $this->session->userdata('idpegawai')
				);
		$result = $this->pegawai_db->ubah($data,$id) ;
		if ($result == TRUE) {
			redirect('/pegawai/ubahpendidikan/'.$id);
		} else {
			$data['error']='Errorr...';
			$this->ubahkepribadian($id,$data);
		}
	}

	//---------------------------------------------------------------------------------------------------------
	//-------------------------------------------------------------------------------------------- PENDIDIKAN
	//---------------------------------------------------------------------------------------------------------

	public function ubahpendidikan($id,$stat='') {
		$data['view']='pendidikan';
		$data['action']='pegawai/ubahpendidikan_p/'.$id;
		$data= $this->pegawai_db->tambah_x($id,$data);
		$data= $this->pegawai_db->pendidikan_db($id,$data);
		$this->load->view('pegawai_add',$data);
	}
	public function tambahpendidikan($id_pegawai,$idx='') {
		$data['view']='tambah_pendidikan';
		$data['action']='pegawai/tambahpendidikan_p/'.$id_pegawai.'/'.$idx;
		$data['id_pegawai']=$id_pegawai;
		$data= $this->pegawai_db->tambah_x($id_pegawai,$data);
		$data= $this->pegawai_db->tambah_pendidikan_db($id_pegawai,$idx,$data);
		$this->load->view('pegawai_add',$data);
	}
	public function tambahpendidikan_p($id_pegawai,$idx='') {
		$data = array(
				'pegawai_id' => $id_pegawai
				,'jenjang' => $this->input->post('jenjang')
				,'institusi' => $this->input->post('institusi')
				,'fakultas' => $this->input->post('fakultas')
				,'jurusan' => $this->input->post('jurusan')
				,'tahun_masuk' => $this->input->post('tahun_masuk')
				,'tahun_keluar' => $this->input->post('tahun_keluar')
				,'modified_date' =>$this->dbx->cts()
				,'modified_by' => $this->session->userdata('idpegawai')
				);


		if ($idx<>""){
			$result = $this->pegawai_db->ubah_pendidikan_p_db($data,$idx);
		}else{
			$data = $this->p_c->arraymerge(array('created_date' => $this->dbx->cts()), $data);
			$data = $this->p_c->arraymerge(array('created_by' => $this->session->userdata('idpegawai')), $data);
			$result = $this->pegawai_db->tambah_pendidikan_p_db($data);
		}

		if ($result == TRUE) {
			//redirect('/pegawai/ubahpendidikan/'.$id_pegawai);
			?><script>
					window.opener.location.reload();
					window.close();
				</script>
			<?php
		} else {
			$data['error']='Errorr...';
			redirect('/pegawai/ubahpendidikan/'.$id_pegawai);
		}
	}
	public function hapuspendidikan($id_pegawai,$idx) {
		$result = $this->pegawai_db->hapuspendidikan_p_db($id_pegawai,$idx) ;
		if ($result == TRUE) {
			//redirect('/pegawai/ubahpendidikan/'.$id_pegawai);
			?><script>
					window.opener.location.reload();
					window.close();
				</script>
			<?php
		}
	}

	//---------------------------------------------------------------------------------------------------------
	//----------------------------------------------------------------------------------- PENDIDIKAN NON FORMAL
	//---------------------------------------------------------------------------------------------------------

	public function ubahpendidikan_nf($id,$stat='') {
		$data['view']='pendidikan_nf';
		$data['action']='pegawai/ubahpendidikan_nf_p/'.$id;
		$data= $this->pegawai_db->tambah_x($id,$data);
		$data= $this->pegawai_db->pendidikan_nf_db($id,$data);
		$this->load->view('pegawai_add',$data);
	}
	public function tambahpendidikan_nf($id_pegawai,$idx='') {
		$data['view']='tambah_pendidikan_nf';
		$data['action']='pegawai/tambahpendidikan_nf_p/'.$id_pegawai.'/'.$idx;
		$data['id_pegawai']=$id_pegawai;
		$data= $this->pegawai_db->tambah_x($id_pegawai,$data);
		$data= $this->pegawai_db->tambah_pendidikan_nf_db($id_pegawai,$idx,$data);
		$this->load->view('pegawai_add',$data);
	}
	public function tambahpendidikan_nf_p($id_pegawai,$idx='') {
		$data = array(
				'pegawai_id' => $id_pegawai
				,'institusi' => $this->input->post('institusi')
				,'tgl_masuk' => $this->p_c->tgl_db($this->input->post('tgl_masuk'))
				,'tgl_keluar' => $this->p_c->tgl_db($this->input->post('tgl_keluar'))
				,'keterangan' => $this->input->post('keterangan')
				,'dibiayai' => $this->input->post('dibiayai')
				,'tahun_masuk' => $this->input->post('tahun_masuk')
				,'tahun_keluar' => $this->input->post('tahun_keluar')
				,'modified_date' =>$this->dbx->cts()
				,'modified_by' => $this->session->userdata('idpegawai')
				);


		if ($idx<>""){
			$result = $this->pegawai_db->ubah_pendidikan_nf_p_db($data,$idx);
		}else{
			$data = $this->p_c->arraymerge(array('created_date' => $this->dbx->cts()), $data);
			$data = $this->p_c->arraymerge(array('created_by' => $this->session->userdata('idpegawai')), $data);
			$result = $this->pegawai_db->tambah_pendidikan_nf_p_db($data);
		}

		if ($result == TRUE) {
			//redirect('/pegawai/ubahpendidikan_nf/'.$id_pegawai);
			?><script>
					window.opener.location.reload();
					window.close();
				</script>
			<?php
		} else {
			$data['error']='Errorr...';
			redirect('/pegawai/ubahpendidikan_nf/'.$id_pegawai);
		}
	}
	public function hapuspendidikan_nf($id_pegawai,$idx) {
		$result = $this->pegawai_db->hapuspendidikan_nf_p_db($id_pegawai,$idx) ;
		if ($result == TRUE) {
			//redirect('/pegawai/ubahpendidikan_nf/'.$id_pegawai);
			?><script>
					window.opener.location.reload();
					window.close();
				</script>
			<?php
		}
	}

	//---------------------------------------------------------------------------------------------------------
	//-------------------------------------------------------------------------------------------------- BAHASA
	//---------------------------------------------------------------------------------------------------------

	public function ubahbahasa($id,$stat='') {
		$data['view']='bahasa';
		$data['action']='pegawai/ubahbahasa_p/'.$id;
		$data= $this->pegawai_db->tambah_x($id,$data);
		$data= $this->pegawai_db->bahasa_db($id,$data);
		$this->load->view('pegawai_add',$data);
	}
	public function tambahbahasa($id_pegawai,$idx='') {
		$data['view']='tambah_bahasa';
		$data['action']='pegawai/tambahbahasa_p/'.$id_pegawai.'/'.$idx;
		$data['id_pegawai']=$id_pegawai;
		$data= $this->pegawai_db->tambah_x($id_pegawai,$data);
		$data= $this->pegawai_db->tambah_bahasa_db($id_pegawai,$idx,$data);
		$this->load->view('pegawai_add',$data);
	}
	public function tambahbahasa_p($id_pegawai,$idx='') {
		$data = array(
				'pegawai_id' => $id_pegawai
				,'bahasa' => $this->input->post('bahasa')
				,'bicara' => $this->input->post('bicara')
				,'menulis' => $this->input->post('menulis')
				,'membaca' => $this->input->post('membaca')
				,'toefl' => $this->input->post('toefl')
				,'modified_date' =>$this->dbx->cts()
				,'modified_by' => $this->session->userdata('idpegawai')
				);


		if ($idx<>""){
			$result = $this->pegawai_db->ubah_bahasa_p_db($data,$idx);
		}else{
			$data = $this->p_c->arraymerge(array('created_date' => $this->dbx->cts()), $data);
			$data = $this->p_c->arraymerge(array('created_by' => $this->session->userdata('idpegawai')), $data);
			$result = $this->pegawai_db->tambah_bahasa_p_db($data);
		}

		if ($result == TRUE) {
			//redirect('/pegawai/ubahbahasa/'.$id_pegawai);
			?><script>
					window.opener.location.reload();
					window.close();
				</script>
			<?php
		} else {
			$data['error']='Errorr...';
			redirect('/pegawai/ubahbahasa/'.$id_pegawai);
		}
	}
	public function hapusbahasa($id_pegawai,$idx) {
		$result = $this->pegawai_db->hapusbahasa_p_db($id_pegawai,$idx) ;
		if ($result == TRUE) {
			//redirect('/pegawai/ubahbahasa/'.$id_pegawai);
			?><script>
					window.opener.location.reload();
					window.close();
				</script>
			<?php
		}
	}
	//---------------------------------------------------------------------------------------------------------
	//------------------------------------------------------------------------------------------------ KOMPUTER
	//---------------------------------------------------------------------------------------------------------

	public function ubahkomputer($id,$stat='') {
		$data['view']='komputer';
		$data['action']='pegawai/ubahkomputer_p/'.$id;
		$data= $this->pegawai_db->tambah_x($id,$data);
		$data= $this->pegawai_db->komputer_db($id,$data);
		$this->load->view('pegawai_add',$data);
	}
	public function tambahkomputer($id_pegawai,$idx='') {
		$data['view']='tambah_komputer';
		$data['action']='pegawai/tambahkomputer_p/'.$id_pegawai.'/'.$idx;
		$data['id_pegawai']=$id_pegawai;
		$data= $this->pegawai_db->tambah_x($id_pegawai,$data);
		$data= $this->pegawai_db->tambah_komputer_db($id_pegawai,$idx,$data);
		$this->load->view('pegawai_add',$data);
	}
	public function tambahkomputer_p($id_pegawai,$idx='') {
		$data = array(
				'pegawai_id' => $id_pegawai
				,'komputer' => $this->input->post('komputer')
				,'bidang' => $this->input->post('bidang')
				,'tingkat' => $this->input->post('tingkat')
				,'keterangan' => $this->input->post('keterangan')
				,'modified_date' =>$this->dbx->cts()
				,'modified_by' => $this->session->userdata('idpegawai')
				);


		if ($idx<>""){
			$result = $this->pegawai_db->ubah_komputer_p_db($data,$idx);
		}else{
			$data = $this->p_c->arraymerge(array('created_date' => $this->dbx->cts()), $data);
			$data = $this->p_c->arraymerge(array('created_by' => $this->session->userdata('idpegawai')), $data);
			$result = $this->pegawai_db->tambah_komputer_p_db($data);
		}

		if ($result == TRUE) {
			//redirect('/pegawai/ubahkomputer/'.$id_pegawai);
			?><script>
					window.opener.location.reload();
					window.close();
				</script>
			<?php
		} else {
			$data['error']='Errorr...';
			redirect('/pegawai/ubahkomputer/'.$id_pegawai);
		}
	}
	public function hapuskomputer($id_pegawai,$idx) {
		$result = $this->pegawai_db->hapuskomputer_p_db($id_pegawai,$idx) ;
		if ($result == TRUE) {
			//redirect('/pegawai/ubahkomputer/'.$id_pegawai);
			?><script>
					window.opener.location.reload();
					window.close();
				</script>
			<?php
		}
	}

	//---------------------------------------------------------------------------------------------------------
	//---------------------------------------------------------------------------------------- KEAHLIAN LAINNYA
	//---------------------------------------------------------------------------------------------------------

	public function ubahskill($id,$stat='') {
		$data['view']='skill';
		$data['action']='pegawai/ubahskill_p/'.$id;
		$data= $this->pegawai_db->tambah_x($id,$data);
		$data= $this->pegawai_db->skill_db($id,$data);
		$this->load->view('pegawai_add',$data);
	}
	public function tambahskill($id_pegawai,$idx='') {
		$data['view']='tambah_skill';
		$data['action']='pegawai/tambahskill_p/'.$id_pegawai.'/'.$idx;
		$data['id_pegawai']=$id_pegawai;
		$data= $this->pegawai_db->tambah_x($id_pegawai,$data);
		$data= $this->pegawai_db->tambah_skill_db($id_pegawai,$idx,$data);
		$this->load->view('pegawai_add',$data);
	}
	public function tambahskill_p($id_pegawai,$idx='') {
		$data = array(
				'pegawai_id' => $id_pegawai
				,'skill' => $this->input->post('skill')
				,'tingkat' => $this->input->post('tingkat')
				,'modified_date' =>$this->dbx->cts()
				,'modified_by' => $this->session->userdata('idpegawai')
				);


		if ($idx<>""){
			$result = $this->pegawai_db->ubah_skill_p_db($data,$idx);
		}else{
			$data = $this->p_c->arraymerge(array('created_date' => $this->dbx->cts()), $data);
			$data = $this->p_c->arraymerge(array('created_by' => $this->session->userdata('idpegawai')), $data);
			$result = $this->pegawai_db->tambah_skill_p_db($data);
		}

		if ($result == TRUE) {
			//redirect('/pegawai/ubahskill/'.$id_pegawai);
			?><script>
					window.opener.location.reload();
					window.close();
				</script>
			<?php
		} else {
			$data['error']='Errorr...';
			redirect('/pegawai/ubahskill/'.$id_pegawai);
		}
	}
	public function hapusskill($id_pegawai,$idx) {
		$result = $this->pegawai_db->hapusskill_p_db($id_pegawai,$idx) ;
		if ($result == TRUE) {
			//redirect('/pegawai/ubahskill/'.$id_pegawai);
			?><script>
					window.opener.location.reload();
					window.close();
				</script>
			<?php
		}
	}
	//---------------------------------------------------------------------------------------------------------
	//------------------------------------------------------------------------------------------------ PRESTASI
	//---------------------------------------------------------------------------------------------------------

	public function ubahprestasi($id,$stat='') {
		$data['view']='prestasi';
		$data['action']='pegawai/ubahprestasi_p/'.$id;
		$data= $this->pegawai_db->tambah_x($id,$data);
		$data= $this->pegawai_db->prestasi_db($id,$data);
		$this->load->view('pegawai_add',$data);
	}
	public function tambahprestasi($id_pegawai,$idx='') {
		$data['view']='tambah_prestasi';
		$data['action']='pegawai/tambahprestasi_p/'.$id_pegawai.'/'.$idx;
		$data['id_pegawai']=$id_pegawai;
		$data= $this->pegawai_db->tambah_x($id_pegawai,$data);
		$data= $this->pegawai_db->tambah_prestasi_db($id_pegawai,$idx,$data);
		$this->load->view('pegawai_add',$data);
	}

	public function tambahprestasi_p($id_pegawai,$idx='') {
		$data = array(
				'pegawai_id' => $id_pegawai
				,'tahun' => $this->input->post('tahun')
				,'prestasi' => $this->input->post('prestasi')
				,'tingkat' => $this->input->post('tingkat')
				,'instansi' => $this->input->post('instansi')
				,'modified_date' =>$this->dbx->cts()
				,'modified_by' => $this->session->userdata('idpegawai')
				);


		if ($idx<>""){
			$result = $this->pegawai_db->ubah_prestasi_p_db($data,$idx);
		}else{
			$data = $this->p_c->arraymerge(array('created_date' => $this->dbx->cts()), $data);
			$data = $this->p_c->arraymerge(array('created_by' => $this->session->userdata('idpegawai')), $data);
			$result = $this->pegawai_db->tambah_prestasi_p_db($data);
		}

		if ($result == TRUE) {
			//redirect('/pegawai/ubahprestasi/'.$id_pegawai);
			?><script>
					window.opener.location.reload();
					window.close();
				</script>
			<?php
		} else {
			$data['error']='Errorr...';
			redirect('/pegawai/ubahprestasi/'.$id_pegawai);
		}
	}
	public function hapusprestasi($id_pegawai,$idx) {
		$result = $this->pegawai_db->hapusprestasi_p_db($id_pegawai,$idx) ;
		if ($result == TRUE) {
			//redirect('/pegawai/ubahprestasi/'.$id_pegawai);
			?><script>
					window.opener.location.reload();
					window.close();
				</script>
			<?php
		}
	}
	//---------------------------------------------------------------------------------------------------------
	//---------------------------------------------------------------------------------------------- ORGANISASI
	//---------------------------------------------------------------------------------------------------------

	public function ubahorganisasi($id,$stat='') {
		$data['view']='organisasi';
		$data['action']='pegawai/ubahorganisasi_p/'.$id;
		$data= $this->pegawai_db->tambah_x($id,$data);
		$data= $this->pegawai_db->organisasi_db($id,$data);
		$this->load->view('pegawai_add',$data);
	}
	public function tambahorganisasi($id_pegawai,$idx='') {
		$data['view']='tambah_organisasi';
		$data['action']='pegawai/tambahorganisasi_p/'.$id_pegawai.'/'.$idx;
		$data['id_pegawai']=$id_pegawai;
		$data= $this->pegawai_db->tambah_x($id_pegawai,$data);
		$data= $this->pegawai_db->tambah_organisasi_db($id_pegawai,$idx,$data);
		$this->load->view('pegawai_add',$data);
	}

	public function tambahorganisasi_p($id_pegawai,$idx='') {
		$data = array(
				'pegawai_id' => $id_pegawai
				,'instansi' => $this->input->post('instansi')
				,'organisasi' => $this->input->post('organisasi')
				,'jabatan' => $this->input->post('jabatan')
				,'tanggung_jawab' => $this->input->post('tanggung_jawab')
				,'tgl_masuk' => $this->p_c->tgl_db($this->input->post('tgl_masuk'))
				,'tgl_keluar' => $this->p_c->tgl_db($this->input->post('tgl_keluar'))
				,'tahun_masuk' => $this->input->post('tahun_masuk')
				,'tahun_keluar' => $this->input->post('tahun_keluar')
				,'modified_date' =>$this->dbx->cts()
				,'modified_by' => $this->session->userdata('idpegawai')
				);


		if ($idx<>""){
			$result = $this->pegawai_db->ubah_organisasi_p_db($data,$idx);
		}else{
			$data = $this->p_c->arraymerge(array('created_date' => $this->dbx->cts()), $data);
			$data = $this->p_c->arraymerge(array('created_by' => $this->session->userdata('idpegawai')), $data);
			$result = $this->pegawai_db->tambah_organisasi_p_db($data);
		}

		if ($result == TRUE) {
			//redirect('/pegawai/ubahorganisasi/'.$id_pegawai);
			?><script>
					window.opener.location.reload();
					window.close();
				</script>
			<?php
		} else {
			$data['error']='Errorr...';
			redirect('/pegawai/ubahorganisasi/'.$id_pegawai);
		}
	}
	public function hapusorganisasi($id_pegawai,$idx) {
		$result = $this->pegawai_db->hapusorganisasi_p_db($id_pegawai,$idx) ;
		if ($result == TRUE) {
			//redirect('/pegawai/ubahorganisasi/'.$id_pegawai);
			?><script>
					window.opener.location.reload();
					window.close();
				</script>
			<?php
		}
	}

	//---------------------------------------------------------------------------------------------------------
	//--------------------------------------------------------------------------------------- PENGALAMAN KERJA
	//---------------------------------------------------------------------------------------------------------

	public function ubahkerja($id,$stat='') {
		$data['view']='kerja';
		$data['action']='pegawai/ubahkerja_p/'.$id;
		$data= $this->pegawai_db->tambah_x($id,$data);
		$data= $this->pegawai_db->kerja_db($id,$data);
		$this->load->view('pegawai_add',$data);
	}
	public function tambahkerja($id_pegawai,$idx='') {
		$data['view']='tambah_kerja';
		$data['action']='pegawai/tambahkerja_p/'.$id_pegawai.'/'.$idx;
		$data['id_pegawai']=$id_pegawai;
		$data= $this->pegawai_db->tambah_x($id_pegawai,$data);
		$data= $this->pegawai_db->tambah_kerja_db($id_pegawai,$idx,$data);
		$this->load->view('pegawai_add',$data);
	}

	public function tambahkerja_p($id_pegawai,$idx='') {
		$data = array(
				'pegawai_id' => $id_pegawai
				,'tgl_masuk' => $this->p_c->tgl_db($this->input->post('tgl_masuk'))
				,'tgl_keluar' => $this->p_c->tgl_db($this->input->post('tgl_keluar'))
				,'instansi' => $this->input->post('instansi')
				,'bidang_usaha' => $this->input->post('bidang_usaha')
				,'jabatan' => $this->input->post('jabatan')
				,'alamat' => $this->input->post('alamat')
				,'keterangan' => $this->input->post('keterangan')
				,'tahun_masuk' => $this->input->post('tahun_masuk')
				,'tahun_keluar' => $this->input->post('tahun_keluar')
				,'gaji' => $this->input->post('gaji')
				,'alasankeluar' => $this->input->post('alasankeluar')
				,'modified_date' =>$this->dbx->cts()
				,'modified_by' => $this->session->userdata('idpegawai')
				);


		if ($idx<>""){
			$result = $this->pegawai_db->ubah_kerja_p_db($data,$idx);
		}else{
			$data = $this->p_c->arraymerge(array('created_date' => $this->dbx->cts()), $data);
			$data = $this->p_c->arraymerge(array('created_by' => $this->session->userdata('idpegawai')), $data);
			$result = $this->pegawai_db->tambah_kerja_p_db($data);
		}

		if ($result == TRUE) {
			//redirect('/pegawai/ubahkerja/'.$id_pegawai);
			?><script>
					window.opener.location.reload();
					window.close();
				</script>
			<?php
		} else {
			$data['error']='Errorr...';
			redirect('/pegawai/ubahkerja/'.$id_pegawai);
		}
	}
	public function hapuskerja($id_pegawai,$idx) {
		$result = $this->pegawai_db->hapuskerja_p_db($id_pegawai,$idx) ;
		if ($result == TRUE) {
			//redirect('/pegawai/ubahkerja/'.$id_pegawai);
			?><script>
					window.opener.location.reload();
					window.close();
				</script>
			<?php
		}
	}

	public function fotodisplay($nip="")
	{
			$data['form']='Foto Display';
			$data['form_small']='Ubah Data';
			$data['view']='index';
			$data['action']='pegawai/upload_it/';
			if ($nip<>""){
				$data['nip']=$nip;
			}else{
				$data['nip']=$this->session->userdata('idpegawai');
			}
			$data= $this->fotodisplay_db->index($data);
			$this->load->view('fotodisplay_v', $data);
	}
	//ATTACHMENT
	function upload_it($file) {
		//load the helper
		$this->load->helper('form');
		$nip=$this->input->post('nip');
		$idpegawai=$this->input->post('idpegawai');
		//Configure
		//set the path where the files uploaded will be copied. NOTE if using linux, set the folder to permission 777
		$config['upload_path'] = "uploads/fotodisplay";
		if ($file<>""){
			$path="uploads/fotodisplay/".$file;
			delete_files($path);
			unlink($path);
		}

		// set the filter image types
		$config['allowed_types'] = 'gif|jpg|png';
		$config['encrypt_name'] = TRUE;

		//load the upload library
		$this->load->library('upload', $config);
		$this->upload->initialize($config);

		$this->upload->set_allowed_types('*');

		$data['upload_data'] = '';

		//if not successful, set the error message
		if (!$this->upload->do_upload()) {
			$data = array('msg' => $this->upload->display_errors());
			echo $this->upload->display_errors();
			$result = $this->fotodisplay_db->ubah($data2,$nip) ;
			redirect('fotodisplay');
			die;
		} else { //else, set the success message
			$data = array('msg' => "Upload success!");
			$data['upload_data'] = $this->upload->data();
			$file=$this->upload->data();
			$data2= array(
						//"file"=>$_FILES['userfile']['name'],
						"fotodisplay"=>$file['file_name']
					);
			$result = $this->fotodisplay_db->ubah($data2,$nip) ;
		}

		redirect('pegawai/view/'.$idpegawai);
	}
} //end of class
?>
