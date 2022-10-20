<?php
Class general_db extends CI_Model {
public function __construct() {
parent::__construct();
	$this->load->library('dbx');
}
    // Read data FROM database to show data in admin page
    public function datasiswa_db($idsiswa){
        $sql=  " SELECT c.*,cs.replid as replidcalon,cs.nopendaftaran,ss.status, ks.kondisi as kondisi,
            DAY(c.tgllahir) AS tanggal, MONTH(c.tgllahir) AS bulan, YEAR(c.tgllahir) AS tahun, ax.alamat_surat
            ,(SELECT agama FROM agama WHERE replid=c.agama) as agama
            ,(SELECT kota FROM kota WHERE replid=c.kota) as kota
            ,(SELECT propinsi FROM propinsi WHERE replid=c.provinsi) as provinsitext
            ,(SELECT negara FROM negara WHERE replid=c.negara) as negara
            ,(SELECT agama FROM agama WHERE replid=c.agama_ayah) as agama_ayah
            ,(SELECT agama FROM agama WHERE replid=c.agama_ibu) as agama_ibu
            ,(SELECT agama FROM agama WHERE replid=c.agama_wali) as agama_wali
            ,(SELECT kota FROM kota WHERE replid=c.kota_ayah) as kota_ayah
            ,(SELECT propinsi FROM propinsi WHERE replid=c.provinsi_ayah) as provinsi_ayahtext
            ,(SELECT negara FROM negara WHERE replid=c.negara_ayah) as negara_ayah
            ,(SELECT kota FROM kota WHERE replid=c.kota_ibu) as kota_ibu
            ,(SELECT propinsi FROM propinsi WHERE replid=c.provinsi_ibu) as provinsi_ibutext
            ,(SELECT negara FROM negara WHERE replid=c.negara_ibu) as negara_ibu
            ,(SELECT kota FROM kota WHERE replid=c.kota_wali) as kota_wali
            ,(SELECT propinsi FROM propinsi WHERE replid=c.provinsi_wali) as provinsi_walitext
            ,(SELECT negara FROM negara WHERE replid=c.negara_wali) as negara_wali
            ,(SELECT pendidikan FROM tingkatpendidikan WHERE replid=c.pendidikanayah) as pendidikanayah, (SELECT pendidikan FROM tingkatpendidikan WHERE replid=c.pendidikanibu) as pendidikanibu
            ,(SELECT pekerjaan FROM jenispekerjaan WHERE replid=c.pekerjaanayah) as pekerjaanayah,(SELECT pekerjaan FROM jenispekerjaan WHERE replid=c.pekerjaanibu) as pekerjaanibu
            ,(SELECT instansi FROM instansi WHERE replid=c.instansiayah) as instansiayah,(SELECT instansi FROM instansi WHERE replid=c.instansiibu) as instansiibu
            ,(SELECT penghasilan FROM penghasilan WHERE replid=c.penghasilanayah) as penghasilanayah
            ,(SELECT penghasilan FROM penghasilan WHERE replid=c.penghasilanibu) as penghasilanibu
            ,(SELECT pendidikan FROM tingkatpendidikan WHERE replid=c.pendidikanwali) as pendidikanwali
            ,(SELECT pekerjaan FROM jenispekerjaan WHERE replid=c.pekerjaanwali) as pekerjaanwali
            ,(SELECT instansi FROM instansi WHERE replid=c.instansiwali) as instansiwali
            ,(SELECT penghasilan FROM penghasilan WHERE replid=c.penghasilanwali) as penghasilanwali
            ,r.region,j.jurusan,ja.jurusan as jurusan_asal,pjx.penanggung_jawab as pj,pjy.penanggung_jawab as pja
            ,ta.departemen, ta.tahunajaran, k.kelas, t.tingkat as tingkattext,t3.tingkat as tingkatcover
            ,akt.angkatan
            ,(SELECT CONCAT(k.kelas,' [',ta.tahunajaran,']') FROM kelas k
                INNER JOIN tahunajaran ta ON k.idtahunajaran=ta.replid
                WHERE k.replid=c.kelasstatus
              ) as kelasstatus
              ,(IF (CURRENT_DATE() BETWEEN tgl_berlaku AND tgl_berlaku2, 1,0)) as periode_as
              , DATE_FORMAT(c.tgl_berlaku, '%d %M %Y') as tgl_berlaku
              , DATE_FORMAT(c.tgl_berlaku2, '%d %M %Y') as tgl_berlaku2
              ,c.administrasisiswa
              ,c. sekolahjenjang,t2.tingkat as tingkat_asaltext
			  ,com.nama as companytext,com.city as citytext,com.cap as captext,com.logo as logotext,ta.idkepsek,com.formal
            FROM siswa c
				LEFT JOIN calonsiswa cs ON cs.replidsiswa=c.replid
              LEFT JOIN kondisisiswa ks on ks.replid = c.kondisi
              LEFT JOIN statussiswa ss on ss.replid = c.status
              LEFT JOIN jurusan j ON j.replid=c.jurusan
              LEFT JOIN regional r ON r.replid=c.region
              LEFT JOIN alamat_surat ax ON ax.replid=c.alamatsurat
              LEFT JOIN penanggung_jawab pjx ON pjx.replid=c.pj
              LEFT JOIN penanggung_jawab pjy ON pjy.replid=c.pja
              LEFT JOIN jurusan_asal ja ON ja.replid=c.jurusan_asal
              LEFT JOIN kelas k ON k.replid = c.idkelas
              LEFT JOIN tahunajaran ta ON k.idtahunajaran = ta.replid
			  LEFT JOIN hrm_company com ON com.replid=ta.idcompany
              LEFT JOIN tingkat t ON k.idtingkat = t.replid
			  LEFT JOIN tingkat t3 ON c.tingkat = t3.replid 
			  LEFT JOIN tingkat t2 ON t2.replid=c.tingkat_asal
              LEFT JOIN angkatan akt ON akt.replid=c.idangkatan
            WHERE c.replid='".$idsiswa."'";
		//echo $sql;die;
        $data['isi']= $this->dbx->rows($sql);

				if($data['isi']->info_media<>""){
					$sqlmedia="SELECT media,replid FROM media WHERE replid IN (".$data['isi']->info_media.") ORDER BY media";
        	$data['media']=$this->dbx->data($sqlmedia);
				}else{
					$data['media']=NULL;
				}

				$sqlriwayat="SELECT rks.*
														,ks.kondisi as kondisitext,r.region as regiontext, k.kelas
														,kst.kondisi as kondisitujuantext,rt.region as regiontujuantext,kt.kelas as kelastujuantext
											FROM riwayatkelassiswa rks
											LEFT JOIN kelas k ON k.replid=rks.idkelas
											LEFT JOIN kelas kt ON kt.replid=rks.idkelastujuan
											LEFT JOIN kondisisiswa ks ON ks.replid=rks.kondisi
											LEFT JOIN regional r ON r.replid=rks.region
											LEFT JOIN kondisisiswa kst ON kst.replid=rks.kondisitujuan
											LEFT JOIN regional rt ON rt.replid=rks.regiontujuan
											WHERE rks.nis='".$data['isi']->nis."' ORDER BY mulai DESC";
				$data['riwayat']=$this->dbx->data($sqlriwayat);

				$sqlmutasi="SELECT ms.*,jm.jenismutasi as jenismutasitext
										FROM mutasisiswa ms
										LEFT JOIN jenismutasi jm ON jm.replid=ms.jenismutasi
										WHERE ms.idsiswa='".$idsiswa."' ORDER BY ms.tglmutasi";
				$data['riwayatmutasi']=$this->dbx->data($sqlmutasi);


        return $data;
    }


		public function datacalonsiswa_db($idcalonsiswa){
			$sql ="SELECT c.*, s.nis
							,ss.status, ks.kondisi as kondisi,
				DAY(c.tgllahir) AS tanggal, MONTH(c.tgllahir) AS bulan, YEAR(c.tgllahir) AS tahun, ax.alamat_surat, p.proses, p.departemen,
				p.kodeawalan, k.kelompok
				,(SELECT agama FROM agama WHERE replid=c.agama) as agama
				,(SELECT tingkat FROM tingkat WHERE replid=c.tingkat) as tingkattext
				,(SELECT kota FROM kota WHERE replid=c.kota) as kota
				,(SELECT propinsi FROM propinsi WHERE replid=c.provinsi) as provinsitext
				,(SELECT negara FROM negara WHERE replid=c.negara) as negara
				,(SELECT agama FROM agama WHERE replid=c.agama_ayah) as agama_ayah
				,(SELECT agama FROM agama WHERE replid=c.agama_ibu) as agama_ibu
				,(SELECT agama FROM agama WHERE replid=c.agama_wali) as agama_wali
				,(SELECT kota FROM kota WHERE replid=c.kota_ayah) as kota_ayah
				,(SELECT propinsi FROM propinsi WHERE replid=c.provinsi_ayah) as provinsi_ayahtext
				,(SELECT negara FROM negara WHERE replid=c.negara_ayah) as negara_ayah
				,(SELECT kota FROM kota WHERE replid=c.kota_ibu) as kota_ibu
				,(SELECT propinsi FROM propinsi WHERE replid=c.provinsi_ibu) as provinsi_ibutext
				,(SELECT negara FROM negara WHERE replid=c.negara_ibu) as negara_ibu
				,(SELECT kota FROM kota WHERE replid=c.kota_wali) as kota_wali
				,(SELECT propinsi FROM propinsi WHERE replid=c.provinsi_wali) as provinsi_walitext
				,(SELECT negara FROM negara WHERE replid=c.negara_wali) as negara_wali
				,(SELECT pendidikan FROM tingkatpendidikan WHERE replid=c.pendidikanayah) as pendidikanayah, (SELECT pendidikan FROM tingkatpendidikan WHERE replid=c.pendidikanibu) as pendidikanibu
				,(SELECT pekerjaan FROM jenispekerjaan WHERE replid=c.pekerjaanayah) as pekerjaanayah,(SELECT pekerjaan FROM jenispekerjaan WHERE replid=c.pekerjaanibu) as pekerjaanibu
				,(SELECT instansi FROM instansi WHERE replid=c.instansiayah) as instansiayah,(SELECT instansi FROM instansi WHERE replid=c.instansiibu) as instansiibu
				,(SELECT penghasilan FROM penghasilan WHERE replid=c.penghasilanayah) as penghasilanayah
				,(SELECT penghasilan FROM penghasilan WHERE replid=c.penghasilanibu) as penghasilanibu
				,(SELECT pendidikan FROM tingkatpendidikan WHERE replid=c.pendidikanwali) as pendidikanwali
				,(SELECT pekerjaan FROM jenispekerjaan WHERE replid=c.pekerjaanwali) as pekerjaanwali
				,(SELECT instansi FROM instansi WHERE replid=c.instansiwali) as instansiwali
				,(SELECT penghasilan FROM penghasilan WHERE replid=c.penghasilanwali) as penghasilanwali
				,(SELECT CONCAT(k.kelas,' [',ta.tahunajaran,']') FROM kelas k
						INNER JOIN tahunajaran ta ON k.idtahunajaran=ta.replid
						WHERE k.replid=c.calon_kelas
					) as calon_kelas
					,(SELECT CONCAT(k.kelas,' [',ta.tahunajaran,']') FROM kelas k
							INNER JOIN tahunajaran ta ON k.idtahunajaran=ta.replid
							WHERE k.replid=c.kelasstatus
						) as calon_kelas_status
				,r.region,ja.jurusan as jurusan_asal,pjx.penanggung_jawab as pj,pjy.penanggung_jawab as pja
				,c.sekolahjenjang
				,ta.tahunajaran as tahunajarantext,j.jurusan as jurusantext,tt.nama as tempattinggaltext
				,t2.tingkat as tingkat_asaltext
				,com.nama as companytext,com.logo as logotext
				FROM calonsiswa c
					LEFT JOIN siswa s ON s.replid=c.replidsiswa
					LEFT JOIN kondisisiswa ks on ks.replid = c.kondisi
					LEFT JOIN statussiswa ss on ss.replid = c.status
					LEFT JOIN kelompokcalonsiswa k on k.replid = c.idkelompok
					LEFT JOIN prosespenerimaansiswa p on p.replid = c.idproses and p.replid = k.idproses
					LEFT JOIN jurusan j ON j.replid=c.jurusan
					LEFT JOIN regional r ON r.replid=c.region
					LEFT JOIN alamat_surat ax ON ax.replid=c.alamatsurat
					LEFT JOIN penanggung_jawab pjx ON pjx.replid=c.pj
					LEFT JOIN penanggung_jawab pjy ON pjy.replid=c.pja
					LEFT JOIN jurusan_asal ja ON ja.replid=c.jurusan_asal
					LEFT JOIN tahunajaran ta ON ta.replid=c.idtahunajaran
					LEFT JOIN tempattinggal tt ON tt.replid=c.idtempattinggal
					LEFT JOIN tingkat t2 ON t2.replid=c.tingkat_asal
					LEFT JOIN tahunajaran t ON c.idtahunajaran = t.replid
					LEFT JOIN hrm_company com ON com.replid=t.idcompany
				WHERE c.replid='".$idcalonsiswa."'";
				//echo $sql;die;
				$data['isi']= $this->dbx->rows($sql);

				if($data['isi']->info_media<>""){
					$sqlmedia="SELECT media,replid FROM media WHERE replid IN (".$data['isi']->info_media.") ORDER BY media";
        	$data['media']=$this->dbx->data($sqlmedia);
				}else{
					$data['media']=NULL;
				}

				If (substr($data['isi']->nis_sk ,0,3)=="PSB"){
					$sqlsaudara="SELECT s.nama,k.kelompok,p.departemen,p.proses FROM calonsiswa s
							INNER JOIN kelompokcalonsiswa k ON s.idkelompok =k.replid
							INNER JOIN prosespenerimaansiswa p ON s.idproses=p.replid
							WHERE s.nopendaftaran='".$data['isi']->nis_sk."'";
				}else{
					$sqlsaudara="SELECT s.nama,k.kelas
								FROM siswa s
								INNER JOIN kelas k ON s.idkelas =k.replid
								WHERE s.nis='".$data['isi']->nis_sk ."'";
				}
				$data['saudara']=$this->dbx->rows($sqlsaudara);

				$sql="SELECT *
      			FROM calonsiswa_form_ortu
      			WHERE replidcalonsiswa='".$idcalonsiswa."'";
        $data['formortu'] = $this->dbx->rows($sql);

				if ($data['formortu']== NULL ) {
        	unset($data['formortu']);
        	$sql="SELECT ".$this->dbx->tablecolumn('calonsiswa_form_ortu');
        	$data['formortu']=$this->dbx->rows($sql);
        }


				$sqlkronologis = "SELECT ok.*,n.negara as negaratext,p.propinsi as propinsitext,k.kota as kotatext,kec.kecamatan as kecamatantext
												,t.tingkat as tingkatasaltext,t2.tingkat as tingkattext
												,j.jurusan as jurusanasaltext
												,j2.jurusan as jurusantext
												,kc.kelompok as kelompokcalontext
												,c.nama as unitbisnistext
												,v.reff_kronologis_sub as votingtext
												, CONCAT(TIMESTAMPDIFF( YEAR, ok.tanggallahir, now() ),' Tahun, ',TIMESTAMPDIFF( MONTH, ok.tanggallahir, now() ) % 12,' Bulan') as umur
												,ta.tahunajaran as tahunajarantext,pps.proses as prosestext,kcs.kelompok as kelompoktext,ks.kondisi as kondisisiswatext,r.region as regiontext
												,s.status as statustext,cs.nopendaftaran, cs.tanggal_daftar,cs.verifikasi
										FROM online_kronologis ok
										LEFT JOIN negara n ON n.replid=ok.negara
										LEFT JOIN propinsi p ON p.replid=ok.propinsi
										LEFT JOIN kota k ON k.replid=ok.kota
										LEFT JOIN kecamatan kec ON kec.replid=ok.kecamatan
										LEFT JOIN tingkat t ON t.replid=ok.idtingkatasal
										LEFT JOIN tingkat t2 ON t2.replid=ok.idtingkat
										LEFT JOIN jurusan j ON j.replid=ok.idjurusanasal
										LEFT JOIN jurusan j2 ON j2.replid=ok.idjurusan
										LEFT JOIN kelompoksiswa kc ON kc.replid=ok.idkelompokcalon
										LEFT JOIN hrm_company c ON c.replid=ok.idunitbisnis
										LEFT JOIN online_kronologis_reff v ON v.replid=ok.voting AND v.head='voting'
										LEFT JOIN tahunajaran ta ON ta.replid=ok.idtahunajaran
										LEFT JOIN prosespenerimaansiswa pps ON pps.replid=ok.idproses
										LEFT JOIN kelompokcalonsiswa kcs ON kcs.replid=ok.idkelompok
										LEFT JOIN kondisisiswa ks ON ks.replid=ok.idkondisi
										LEFT JOIN regional r ON r.replid=ok.idregion
										LEFT JOIN hrm_status s ON s.node=ok.status
										LEFT JOIN calonsiswa cs ON cs.replid=ok.idcalon
										WHERE ok.idcalon='".$idcalonsiswa."'";
					//echo $sqlkronologis;die;
					$data['kronologis'] = $this->dbx->rows($sqlkronologis);
					$sqlmedia="SELECT CONCAT('[',okr.reff_kronologis,'] ',okr.reff_kronologis_sub) as var FROM online_kronologis_reff okr
																									INNER JOIN online_kronologis_media okm ON okm.idmedia=okr.replid
																									WHERE okr.head='Media'
																												AND okm.idkronologis='".$data['isi']->replid."'
																									ORDER BY reff_kronologis,reff_kronologis_sub";
					$data['media_opt']=$this->dbx->rowscsv($sqlmedia);

					$data['alasan_opt']=$this->dbx->rowscsv("SELECT okr.reff_kronologis_sub as var FROM online_kronologis_reff okr
																									INNER JOIN online_kronologis_alasan oka ON oka.idalasan=okr.replid
																									WHERE okr.head='Alasan'
																												AND oka.idkronologis='".$data['isi']->replid."'
																									ORDER BY reff_kronologis,reff_kronologis_sub");

				$sql="SELECT s.syarat as dokumentipetext,s.replid as iddokumentipe,cs.*
							FROM syarat s
							LEFT JOIN psb_calonsiswa_attachment cs ON s.replid=cs.iddokumentipe
							WHERE cs.idcalonsiswa='".$idcalonsiswa."'
              ORDER BY s.urutan,s.syarat ";
      	$data['persyaratan']=$this->dbx->data($sql);

				$sqljadwal="SELECT k.*,kr.reff as kegiatantext
										FROM kegiatan k
										INNER JOIN kegiatan_reff kr ON kr.replid=k.keg_id
										WHERE k.siswa_id='".$idcalonsiswa."' ORDER BY tgl_mulai";
				$data['jadwalppdb'] = $this->dbx->data($sqljadwal);

				$sqlcalonsiswa_riwayat="SELECT csr.*,sr.nama as alasantext
																FROM calonsiswa_riwayat csr
																LEFT JOIN siswa_reff sr ON sr.replid=csr.idalasan
																WHERE csr.idcalon='".$idcalonsiswa."' ORDER BY created_date";
				$data['calonsiswa_riwayat'] = $this->dbx->data($sqlcalonsiswa_riwayat);

				$sql="SELECT replid,kelompok as nama FROM kelompoksiswa WHERE departemen='".$data["isi"]->departemen."'";
				$data['kelompoksiswa_opt'] = $this->dbx->opt($sql);
				$data['kelompoksiswa_opt'] = $this->p_c->arraymerge($data['kelompoksiswa_opt'],array('0' => "Assessment"));

				$sql="SELECT k.*,sk.description,keg.tgl_mulai,keg.idpegawai,keg.replid as keg_id,keg.idpegawai
							FROM konseling k
							LEFT JOIN siswa_konseling sk ON sk.konseling_id=k.replid
							INNER JOIN kegiatan keg ON keg.replid=sk.replidkeg
							WHERE keg.keg_id=9 AND keg.siswa_id='".$idcalonsiswa."'
							ORDER BY keg.replid, k.urutan";
        $data['konseling'] = $this->dbx->data($sql);

				//laporan Asesmen
				$rd="";
				$sqlform ="SELECT of.judul,reference_form,so.description
        		FROM observasi_form of
        		LEFT JOIN  siswa_observasi so ON so.observasi_id=of.reference_form
        		WHERE
								of.replid='4'
								AND so.replidkeg=(SELECT replid FROM kegiatan WHERE keg_id=10 AND siswa_id='".$idcalonsiswa."'  ORDER BY tgl_mulai LIMIT 1)
						";
				$data["rowform"]=$this->dbx->rows($sqlform);
				if($data["rowform"]<>NULL){
					if ($data["rowform"]->description<>""){
						$rd=" AND o.referencedata='".$data["rowform"]->description."' ";
					}
				}

				$sql="SELECT o.*,so.description
							FROM observasi o
							LEFT JOIN siswa_observasi so ON so.observasi_id=o.replid
							WHERE o.publicdata=1 AND so.replidkeg=(SELECT replid FROM kegiatan WHERE keg_id=10 AND siswa_id='".$idcalonsiswa."'  ORDER BY tgl_mulai LIMIT 1)
								".$rd."
							ORDER BY o.urutan";
				//echo $sql;die;
				$data['observasi'] = $this->dbx->data($sql);

				return $data;
		}

	//---------------------------------------------------------------------------------------------------------
	//---------------------------------------------------------------------------------------------- PEGAWAI
	//---------------------------------------------------------------------------------------------------------
	public function datapegawai($idpegawai) {
      	$sql="SELECT p.*,(TIMESTAMPDIFF(YEAR, tgllahir, CURDATE())) as umur,a.agama,n.negara as warganegara
      			,n2.negara as negara,n3.negara as negara2
      			,pr.reff as status_nikah
      			,jp.pekerjaan as pekerjaan_ibu,jp2.pekerjaan as pekerjaan_ayah
      			,pr2.reff as kode_pajak
      			,pr3.reff as ukuran_baju
				,l.aktif as aktiflogin,l.idcompany as logincompany,l.role_id,l.departemen as logindept
      			FROM pegawai p
      			LEFT JOIN agama a ON p.agama=a.replid
      			LEFT JOIN negara n ON p.warganegara=n.replid
      			LEFT JOIN negara n2 ON p.negara=n2.replid
      			LEFT JOIN negara n3 ON p.negara2=n3.replid
      			LEFT JOIN pegawai_reff pr ON pr.replid=p.status_nikah AND pr.type=3
      			LEFT JOIN jenispekerjaan jp ON jp.replid=p.pekerjaan_ibu
      			LEFT JOIN jenispekerjaan jp2 ON jp2.replid=p.pekerjaan_ayah
      			LEFT JOIN pegawai_reff pr2 ON pr2.replid=p.kode_pajak AND pr2.type=4
      			LEFT JOIN pegawai_reff pr3 ON pr3.replid=p.ukuran_baju AND pr3.type=5
				LEFT JOIN login l ON l.login=p.nip
      			WHERE p.replid='".$idpegawai."'";
        $data['isi'] = $this->dbx->rows($sql);
		$sql="SELECT pp.*,pr.reff as type FROM pegawai_perbankan pp
    			LEFT JOIN pegawai_reff pr ON pr.replid=pp.type AND pr.type=2
    			WHERE pegawai_id='".$idpegawai."'";
    	$data['perbankan']=$this->dbx->data($sql);
		$sql="SELECT pkd.*,pr.reff as hubungan,n.negara as negara FROM pegawai_kontak_darurat  pkd
    			LEFT JOIN pegawai_reff pr ON pkd.hubungan=pr.replid
    			LEFT JOIN negara n ON pkd.negara=n.replid
    			WHERE pegawai_id='".$idpegawai."' AND pr.type=1";
    	$data['kontakdarurat']=$this->dbx->data($sql);
		$sql="SELECT k.*,pr.reff as hubungan,tp.pendidikan as pendidikan_terakhir,jp.pekerjaan,i.instansi
    			,(TIMESTAMPDIFF(YEAR, k.tanggal_lahir, CURDATE())) as umur
    			FROM pegawai_keluarga k
    			LEFT JOIN pegawai_reff pr ON k.hubungan=pr.replid AND pr.type=1
    			LEFT JOIN tingkatpendidikan tp ON tp.replid=k.pendidikan_terakhir
    			LEFT JOIN jenispekerjaan jp ON jp.replid=k.pekerjaan
    			LEFT JOIN instansi i ON i.replid=k.instansi
    			WHERE pegawai_id='".$idpegawai."' ORDER BY k.tanggal_lahir ASC";
    	$data['keluarga']=$this->dbx->data($sql);
		$sql="SELECT k.*,tp.pendidikan as jenjang
    	    	FROM pegawai_pendidikan k
    			LEFT JOIN tingkatpendidikan tp ON tp.replid=k.jenjang
    			WHERE pegawai_id='".$idpegawai."' ORDER BY k.tahun_keluar ASC";
    	$data['pendidikan']=$this->dbx->data($sql);
		$sql="SELECT k.*
    	    	FROM pegawai_pendidikan_nf k
    			WHERE pegawai_id='".$idpegawai."'";
    	$data['pendidikan_nf']=$this->dbx->data($sql);
		$sql="SELECT k.*,pr1.reff as bicara,pr2.reff as menulis,pr3.reff as membaca
    	    	FROM pegawai_bahasa k
    	    	LEFT JOIN pegawai_reff pr1 ON k.bicara=pr1.replid AND pr1.type=6
    	    	LEFT JOIN pegawai_reff pr2 ON k.menulis=pr2.replid AND pr2.type=6
    	    	LEFT JOIN pegawai_reff pr3 ON k.membaca=pr3.replid AND pr3.type=6
    			WHERE pegawai_id='".$idpegawai."'";
    	$data['bahasa']=$this->dbx->data($sql);
		$sql="SELECT k.*,pr1.reff as bidang,pr2.reff as tingkat
    	    	FROM pegawai_komputer k
    	    	LEFT JOIN pegawai_reff pr1 ON k.bidang=pr1.replid AND pr1.type=7
    	    	LEFT JOIN pegawai_reff pr2 ON k.tingkat=pr2.replid AND pr2.type=6
    			WHERE pegawai_id='".$idpegawai."'";
    	$data['komputer']=$this->dbx->data($sql);
		$sql="SELECT k.*,pr2.reff as tingkat
    	    	FROM pegawai_skill k
    	    	LEFT JOIN pegawai_reff pr2 ON k.tingkat=pr2.replid AND pr2.type=6
    			WHERE pegawai_id='".$idpegawai."'";
    	$data['skill']=$this->dbx->data($sql);
		$sql="SELECT k.*,pr2.reff as tingkat
    	    	FROM pegawai_prestasi k
    	    	LEFT JOIN pegawai_reff pr2 ON k.tingkat=pr2.replid AND pr2.type=8
    			WHERE pegawai_id='".$idpegawai."' ORDER BY tahun ASC";
    	$data['prestasi']=$this->dbx->data($sql);
		$sql="SELECT k.*
    	    	FROM pegawai_organisasi k
    			WHERE pegawai_id='".$idpegawai."' ORDER BY tgl_keluar ASC";
    	$data['organisasi']=$this->dbx->data($sql);
		$sql="SELECT k.*
    	    	FROM pegawai_kerja k
    			WHERE pegawai_id='".$idpegawai."' ORDER BY tgl_keluar ASC";
    	$data['kerja']=$this->dbx->data($sql);
		$sql="SELECT kk.*,c.nama as idcompany,p.nama as idpegawai,d.departemen as iddepartemen,sp.nama as idpegawai_status
      			,tp.pegawai_tipe_pengangkatan as idpegawai_tipe_pengangkatan
      			,j.jabatan as idjabatan
      			FROM hrm_pegawai_kontrak kk
      			LEFT JOIN hrm_company c ON kk.idcompany=c.replid
      			LEFT JOIN pegawai p ON kk.idpegawai=p.replid
      			LEFT JOIN hrm_pegawai_tipe_pengangkatan tp ON tp.replid=kk.idpegawai_tipe_pengangkatan
      			LEFT JOIN hrm_jabatan j ON j.replid=kk.idjabatan
      			LEFT JOIN hrm_departemen d ON j.iddepartemen=d.replid
      			LEFT JOIN hrm_reff sp ON sp.replid=kk.idpegawai_status
      			WHERE kk.idpegawai='".$idpegawai."'
      			ORDER BY kk.tanggal_pembuatan";
      	$data['kontrak']=$this->dbx->data($sql);

      	$sql="SELECT kk.*,c.nama as idcompany,p.nama as idpegawai,d.departemen as iddepartemen,sp.nama as idpegawai_status
      			,j.jabatan as idjabatan
      			FROM hrm_pegawai_jabatan kk
      			LEFT JOIN hrm_company c ON kk.idcompany=c.replid
      			LEFT JOIN pegawai p ON kk.idpegawai=p.replid
      			LEFT JOIN hrm_jabatan j ON j.replid=kk.idjabatan
      			LEFT JOIN hrm_departemen d ON j.iddepartemen=d.replid
      			LEFT JOIN hrm_reff sp ON sp.replid=kk.idpegawai_status
      			WHERE kk.idpegawai='".$idpegawai."'
      			ORDER BY kk.akhir_kontrak ASC";
      	$data['jabatan']=$this->dbx->data($sql);
		$sql="SELECT ep.*,e.kode_transaksi,e.tanggalpelaksanaan,pr.perihal as perihaltext,s.status as statustext
								,(e.tanggalpelaksanaan=CURRENT_DATE()) as harievent
								,DATEDIFF(e.tanggalpelaksanaan,CURRENT_DATE()) as sisahari
								,et.tema as tematext,et.kkm
								,DATE_FORMAT(e.jammulai,'%H:%i') as jammulai
								,DATE_FORMAT(e.jamakhir,'%H:%i') as jamakhir

      			FROM hrm_event_peserta ep
						INNER JOIN hrm_event e ON e.replid=ep.idhrm_event
						LEFT JOIN hrm_event_theme et ON et.replid=e.idhrm_event_theme
						LEFT JOIN reff_perihal pr ON pr.replid=e.idperihal
						LEFT JOIN hrm_status s ON e.status=s.node
      			WHERE ep.idpegawai='".$idpegawai."'
      			ORDER BY e.tanggalpelaksanaan";
      	$data['event']=$this->dbx->data($sql);
		
    	return $data;
    }

}
