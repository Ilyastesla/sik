<?php

Class ksw_siswa_db extends CI_Model {
	public function __construct() {
		parent::__construct();
		$this->load->library('dbx');
	}

    // Read data from database to show data in admin page
    public function data() {
			$cari="";
			$cari=$cari." AND t.idcompany='".$this->input->post('idcompany')."' ";
			//if ($this->input->post('idkelas')<>""){
				$cari=$cari." AND k.idtahunajaran='".$this->input->post('idtahunajaran')."' ";
			//}

			if ($this->input->post('idtingkat')<>""){
				$cari=$cari." AND k.idtingkat='".$this->input->post('idtingkat')."' ";
			}

			if ($this->input->post('idkelas')<>""){
				$cari=$cari." AND s.idkelas='".$this->input->post('idkelas')."' ";
			}

				$sql = "SELECT s.*,DAY(s.tgllahir),MONTH(s.tgllahir)
								,YEAR(s.tgllahir),ks.kondisi as kondisi_nm
								,cs.replid as replidcalon
								,(DATEDIFF (current_date(),s.tgl_masuk)) as jml_hari
								,(SELECT 1 FROM besarjtt WHERE nis=s.nis AND DATEDIFF(tgl_batas,CURRENT_DATE())<=30 AND lunas<>1 LIMIT 1) as keuangan
								,(SELECT 1 FROM besarjttcalon WHERE idcalon=cs.replid AND DATEDIFF(tgl_batas,CURRENT_DATE())<=30 AND lunas<>1 LIMIT 1) as keuangan2
								,akt.angkatan,r.region,s.remedialperilaku
								, DATE_FORMAT(s.tgl_berlaku, '%d %M %Y') as tgl_berlaku
								, DATE_FORMAT(s.tgl_berlaku2, '%d %M %Y') as tgl_berlaku2
								,(IF (CURRENT_DATE() BETWEEN tgl_berlaku AND tgl_berlaku2, 1,0)) as periode_as
								,administrasisiswa,kls.idwali,kls.kelas as kelastext,t.tahunajaran as tahunajarantext,kels.kelompok as kelompoksiswatext
								,t.idkepsek,com.logo as logotext,sm.semester, ag.agama as agamatext
								,kt.kota as kotatext,prov.propinsi as propinsitext, neg.negara as negaratext
								FROM siswa s
								LEFT JOIN kondisisiswa ks ON ks.replid=s.kondisi
								LEFT JOIN kelas k ON s.idkelas = k.replid
								LEFT JOIN kelompoksiswa kels ON kels.replid=k.kelompok_siswa
								LEFT JOIN tahunajaran t ON t.replid = k.idtahunajaran
								LEFT JOIN hrm_company com ON com.replid=t.idcompany
								LEFT JOIN angkatan akt ON akt.replid=s.idangkatan
								LEFT JOIN regional r ON r.replid=s.region
								LEFT JOIN calonsiswa cs ON cs.replid=s.replidcalon
								LEFT JOIN kelas kls ON kls.replid=s.idkelas
								LEFT JOIN semester sm ON sm.departemen=t.departemen AND sm.aktif=1
								LEFT JOIN agama ag ON ag.replid=s.agama 
								LEFT JOIN kota kt ON kt.replid=s.kota
								LEFT JOIN propinsi prov ON prov.replid=s.provinsi 
								LEFT JOIN negara neg ON neg.replid=s.negara 
								WHERE s.alumni=0 AND s.aktif=1 ".$cari."
								ORDER BY k.idtingkat,k.kelas, s.nama ";
			 //echo $sql;die;
			 //die;
				$data['show_table']=$this->dbx->data($sql);


			$data['iddepartemen_opt'] = $this->dbx->opt("SELECT departemen as replid,departemen as nama FROM departemen WHERE aktif=1 AND replid IN (".$this->session->userdata('dept').") ORDER BY urutan",'up');
			$data['idtahunajaran_opt'] = $this->dbx->opt("SELECT replid,CONCAT('[',departemen,'] ',tahunajaran) as nama FROM tahunajaran WHERE idcompany='".$this->input->post('idcompany')."' AND departemen='".$this->input->post('iddepartemen')."' ORDER BY aktif DESC ,nama DESC ",'up');
			$data['idtingkat_opt'] = $this->dbx->opt("SELECT replid,tingkat as nama FROM tingkat
																								WHERE aktif=1 AND departemen='".$this->input->post('iddepartemen')."' ORDER BY CAST(tingkat AS SIGNED) ASC",'up');
			$data['idkelas_opt'] = $this->dbx->opt("SELECT k.replid,k.kelas as nama FROM kelas k
																									INNER JOIN tingkat t ON k.idtingkat=t.replid
																									INNER JOIN tahunajaran ta ON ta.replid = k.idtahunajaran
																									WHERE k.aktif=1 AND t.departemen='".$this->input->post('iddepartemen')."'
																										AND k.idtahunajaran='".$this->input->post('idtahunajaran')."'
																										AND k.idtingkat='".$this->input->post('idtingkat')."'
																										AND ta.idcompany='".$this->input->post('idcompany')."'
																										
																									ORDER BY nama",'up');
			$companyrow=$this->session->userdata('idcompany');
			$sqlcompany="SELECT replid,nama as nama
									FROM hrm_company
									WHERE replid IN (".$companyrow.") AND aktif=1
									ORDER BY nama";
			$data['idcompany_opt'] = $this->dbx->opt($sqlcompany,'up');
			return $data;
    }

		//TAMBAH
	 public function tambah_db($id='',$data) {
			 $sql="SELECT s.*,HOUR(s.waktutempuh) as waktutempuhjam,MINUTE(s.waktutempuh) as waktutempuhmenit
					 FROM siswa s
					 WHERE s.replid='".$id."'";
			 $data['isi'] = $this->dbx->rows($sql);

			 if ($data['isi']== NULL ) {
				 unset($data['isi']);
				 $sql="SELECT ".$this->dbx->tablecolumn('siswa');
				 $data['isi']=$this->dbx->rows($sql);
			 }

			 $data['agama_opt'] = $this->dbx->opt("SELECT replid,agama as nama FROM agama ORDER BY agama",'none');
			 $data['type_negara_opt'] = $this->dbx->opt("SELECT replid,negara as nama FROM negara ORDER BY negara",'up');
			 $data['type_provinsi_opt'] = $this->dbx->opt("SELECT replid,propinsi as nama FROM propinsi WHERE id_negara='".$data['isi']->negara."' ORDER BY propinsi ",'up');
			 $data['type_kota_opt'] = $this->dbx->opt("SELECT replid,kota as nama FROM kota WHERE aktif=1 AND id_propinsi='".$data['isi']->provinsi."' ORDER BY kota",'up');
			 if($data['isi']->negara<>1){
				$data['type_kota_opt']=$this->p_c->arraymerge($data['type_kota_opt'],array('lainlain' => 'Lain Lain'));
			 }
			 
			 $data['type_kecamatan_opt'] = $this->dbx->opt("SELECT replid,kecamatan as nama FROM kecamatan WHERE id_kota='".$data['isi']->kota."' ORDER BY kecamatan",'up');

			 $data['jenjangasal_opt'] = array(""=>"Pilih...","TK"=>"TK","SD"=>"SD","SMP"=>"SMP","SMA"=>"SMA");
			 $data['tingkat_asal_opt'] = $this->dbx->opt("SELECT replid,tingkat as nama  FROM tingkat WHERE aktif=1 AND departemen='".$data['isi']->jenjangasal."' ORDER BY CAST(tingkat AS SIGNED)",'up');

			 $data['pendidikan_opt'] = $this->dbx->opt("SELECT replid,pendidikan as nama FROM tingkatpendidikan ORDER BY pendidikan",'none');
			 $data['pekerjaan_opt'] = $this->dbx->opt("SELECT replid,pekerjaan as nama FROM jenispekerjaan WHERE aktif=1 ORDER BY pekerjaan",'none');
			 $data['instansi_opt'] = $this->dbx->opt("SELECT replid,instansi as nama FROM instansi ORDER BY instansi",'none');
			 $data['penghasilan_opt'] = $this->dbx->opt("SELECT replid,penghasilan as nama FROM penghasilan ORDER BY penghasilan",'none');

			 $data['type_negara_ayah_opt'] = $this->dbx->opt("SELECT replid,negara as nama FROM negara",'up');
			 $data['type_provinsi_ayah_opt'] = $this->dbx->opt("SELECT replid,propinsi as nama FROM propinsi WHERE id_negara='".$data['isi']->negara_ayah."' ",'up');
			 $data['type_kota_ayah_opt'] = $this->dbx->opt("SELECT replid,kota as nama FROM kota WHERE aktif=1 AND id_propinsi='".$data['isi']->provinsi_ayah."' ",'up');
			 if($data['isi']->negara_ayah<>1){
				$data['type_kota_ayah_opt']=$this->p_c->arraymerge($data['type_kota_ayah_opt'],array('lainlain' => 'Lain Lain'));
			 }
			 $data['type_kecamatan_ayah_opt'] = $this->dbx->opt("SELECT replid,kecamatan as nama FROM kecamatan WHERE id_kota='".$data['isi']->kota_ayah."' ",'up');

			 $data['type_negara_ibu_opt'] = $this->dbx->opt("SELECT replid,negara as nama FROM negara",'up');
			 $data['type_provinsi_ibu_opt'] = $this->dbx->opt("SELECT replid,propinsi as nama FROM propinsi WHERE id_negara='".$data['isi']->negara_ibu."' ",'up');
			 $data['type_kota_ibu_opt'] = $this->dbx->opt("SELECT replid,kota as nama FROM kota WHERE aktif=1 AND id_propinsi='".$data['isi']->provinsi_ibu."' ",'up');
			 if($data['isi']->negara_ibu<>1){
				$data['type_kota_ibu_opt']=$this->p_c->arraymerge($data['type_kota_ibu_opt'],array('lainlain' => 'Lain Lain'));
			 }
			 $data['type_kecamatan_ibu_opt'] = $this->dbx->opt("SELECT replid,kecamatan as nama FROM kecamatan WHERE id_kota='".$data['isi']->kota_ibu."' ",'up');

			 $data['type_negara_wali_opt'] = $this->dbx->opt("SELECT replid,negara as nama FROM negara",'up');
			 $data['type_provinsi_wali_opt'] = $this->dbx->opt("SELECT replid,propinsi as nama FROM propinsi WHERE id_negara='".$data['isi']->negara_wali."' ",'up');
			 $data['type_kota_wali_opt'] = $this->dbx->opt("SELECT replid,kota as nama FROM kota WHERE aktif=1 AND id_propinsi='".$data['isi']->provinsi_wali."' ",'up');
			 if($data['isi']->negara_wali<>1){
				$data['type_kota_wali_opt']=$this->p_c->arraymerge($data['type_kota_wali_opt'],array('lainlain' => 'Lain Lain'));
			 }
			 $data['type_kecamatan_wali_opt'] = $this->dbx->opt("SELECT replid,kecamatan as nama FROM kecamatan WHERE id_kota='".$data['isi']->kota_wali."' ",'up');

			 $data['alamatsurat_opt'] = $this->dbx->opt("SELECT replid,alamat_surat as nama FROM alamat_surat ORDER BY alamat_surat",'none');
			 $data['penanggung_jawab_opt'] = $this->dbx->opt("SELECT replid,penanggung_jawab as nama FROM penanggung_jawab ORDER BY penanggung_jawab",'none');
			 $data['info_media_opt'] = $this->dbx->data("SELECT replid,media as nama FROM media ORDER BY media",'none');

			 return $data;
 }

	public function cetakkartudb($idkelas,$idsiswa="") {
		$idsiswafil="";
		if($idsiswa<>""){
			$idsiswafil=" AND s.replid='".$idsiswa."' ";
		}

		$sql = "SELECT s.*,k.kelas as kelastext,ks.kelompok as kelompoksiswatext,ta.tahunajaran as tahunajarantext
								,sm.semester,p.nip,p.nama as namakepsek,p.gelarawal,p.gelarakhir,p.ttd
	 						 ,d.keterangan as depttext,d.departemen
	 						 ,CONCAT(s.tmplahir,', ',DATE_FORMAT(s.tgllahir,'%d-%m-%Y')) as ttl
							 ,ta.idkepsek,com.logo as logotext,com.city,com.cap as capcompany
	 						 FROM siswa s
	 						 INNER JOIN kelas k ON s.idkelas=k.replid
	 						 INNER JOIN tingkat t ON k.idtingkat=t.replid
	 						 INNER JOIN tahunajaran ta ON k.idtahunajaran=ta.replid
							 INNER JOIN hrm_company com ON com.replid=ta.idcompany
	 						 INNER JOIN kelompoksiswa ks ON k.kelompok_siswa=ks.replid
	 						 INNER JOIN departemen d ON t.departemen=d.departemen
	 						 INNER JOIN pegawai p ON p.replid=ta.idkepsek
	 						 LEFT JOIN semester sm ON sm.departemen=t.departemen AND sm.aktif=1
	 						 WHERE s.aktif=1 AND s.idkelas='".$idkelas."' ".$idsiswafil." ORDER BY s.nama ";
		//echo $sql;die;
		$data['show_table']=$this->dbx->data($sql);
		$sqltryout="SELECT * FROM tryout WHERE aktif=1
								AND departemen=(SELECT ta.departemen FROM kelas k
 	 						 			INNER JOIN tahunajaran ta ON k.idtahunajaran=ta.replid
										WHERE k.replid='".$idkelas."'
									)
								LIMIT 1";
		$data['settingtryout']=$this->dbx->rows($sqltryout);
		return $data;
	}


}

?>
