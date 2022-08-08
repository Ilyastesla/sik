<?php

Class ksw_penempatan_db extends CI_Model {
	public function __construct() {
		parent::__construct();
		$this->load->library('dbx');
	}

    // Read data from database to show data in admin page
    public function data() {
				$cari="";$carita="";
			//AND c.tahunmasuk='".$this->input->post('tahunmasuk')."'
			if ($this->input->post('iddepartemen')<>""){
				$cari=$cari." AND pps.departemen='".$this->input->post('iddepartemen')."'";
			}
			if ($this->input->post('idtahunajaran')<>""){
				$cari=$cari." AND kls.idtahunajaran='".$this->input->post('idtahunajaran')."'";
			}else{
				$cari=$cari." AND ta.aktif=1 ";
			}

			if ($this->input->post('idproses')<>""){
				$cari=$cari." AND c.idproses='".$this->input->post('idproses')."'";
			}
			if ($this->input->post('idkelompok')<>""){
				$cari=$cari." AND c.idkelompok='".$this->input->post('idkelompok')."'";
			}
		
		$cari=$cari." AND ta.idcompany='".$this->input->post('idcompany')."' ";
      	$sql = "SELECT c.*,kcs.kelompok as kelompokcalontext,pps.proses as prosestext,pps.departemen
                          ,t.tingkat as tingkattext,  kls.kelas as kelastext ,ks.kondisi as kondisitext
                          ,kcs.lamaproses,DATEDIFF(CURRENT_DATE(),c.tanggal_daftar) as lama
                          ,s.nis,ta.tahunajaran as tahunajarantext
                      FROM calonsiswa c
											INNER JOIN online_kronologis ok ON ok.idcalon=c.replid
											LEFT JOIN  prosespenerimaansiswa pps ON c.idproses = pps.replid
                			LEFT JOIN  kelompokcalonsiswa kcs ON kcs.idproses = pps.replid AND c.idkelompok = kcs.replid
                			LEFT JOIN  tingkat t ON c.tingkat=t.replid
                			LEFT JOIN  kondisisiswa ks ON ks.replid=c.kondisi
                			LEFT JOIN  kelas kls ON c.calon_kelas = kls.replid
											LEFT JOIN  tahunajaran ta ON kls.idtahunajaran = ta.replid
                      LEFT JOIN siswa s ON s.replid=c.replidsiswa
                      WHERE c.lulus=1 AND c.tanggal_masuk IS NOT NULL AND c.aktif=1 
											 AND c.calon_kelas IS NOT NULL
									".$cari."
									ORDER BY c.nama ";
				//echo $sql;die;
				$data['show_table']=$this->dbx->data($sql);
				$data['iddepartemen_opt'] = $this->dbx->opt("SELECT departemen as replid,departemen as nama FROM departemen WHERE aktif=1 AND replid IN (".$this->session->userdata('dept').") ORDER BY urutan",'up');
        //$data['tahunmasuk_opt'] = $this->dbx->opt("SELECT DISTINCT tahunmasuk as replid, tahunmasuk as nama FROM calonsiswa ORDER BY tahunmasuk DESC",'up');
				$data['idtahunajaran_opt'] = $this->dbx->opt("SELECT replid, tahunajaran as nama FROM tahunajaran WHERE idcompany='".$this->input->post('idcompany')."' AND departemen='".$this->input->post('iddepartemen')."' ORDER BY tahunajaran DESC",'up');
				$data['idproses_opt'] = $this->dbx->opt("SELECT replid,proses as nama FROM prosespenerimaansiswa WHERE departemen='".$this->input->post('iddepartemen')."' ORDER BY info1",'up');
        $data['idkelompok_opt'] = $this->dbx->opt("SELECT replid,kelompok as nama FROM kelompokcalonsiswa WHERE aktif=1 AND idproses='".$this->input->post('idproses')."' ORDER BY kelompok",'up');
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
    	$data['id']=$id;
      	$sql="SELECT *
      			FROM calonsiswa
      			WHERE replid='".$id."'";
        $data['isi'] = $this->dbx->rows($sql);

        if ($data['isi']== NULL ) {
        	unset($data['isi']);
        	$sql="SELECT ".$this->dbx->tablecolumn('calonsiswa').",'".$id."' as replid ";
        	$data['isi']=$this->dbx->rows($sql);
        }
        $data['idkelas_opt'] = $this->dbx->opt("SELECT replid, kelas as nama FROM kelas WHERE idtahunajaran='".$data['isi']->idtahunajaran."' AND idtingkat='".$data['isi']->tingkat."'ORDER BY kelas",'up');
				return $data;
  }

  public function import($idcalon){
    $datacs=$this->dbx->getcalonsiswa($idcalon,1);
		if (ISSET($datacs)){
	    $tahunmasuk=substr($datacs->tanggal_masuk,2,2);
	    $nis=$datacs->kodecabang.$tahunmasuk.$datacs->tingkatnis;
			//$sqlnis="SELECT lpad(right(nissementara,3)+1,3,'0') as isi FROM calonsiswa WHERE LEFT(nissementara,5)='".$datacs->kode_cabang.$tahunmasuk."' order by right(nissementara,3) DESC LIMIT 1";
			$sqlnis="SELECT lpad(right(nis,3)+1,3,'0') as isi FROM siswa WHERE LEFT(nis,5)='".$datacs->kodecabang.$tahunmasuk."' order by right(nis,3) DESC LIMIT 1";
			//echo $sqlnis;die;
			$nisurutan=$this->dbx->singlerow($sqlnis);
	    if($nisurutan==""){
	      $nisurutan="001";
	    }
	    $nis=$nis.$nisurutan;
	    //echo $nis;die;

	    $sql="INSERT INTO siswa(
	                nis,nisn,nama,panggilan,aktif,tahunmasuk,suku,agama,status,kondisi,kelamin,tmplahir,tgllahir,warga,anakke,jsaudara,bahasa,berat,tinggi,darah,foto,alamatsiswa
	                ,kodepossiswa,telponsiswa,hpsiswa,emailsiswa,kesehatan,asalsekolah,ketsekolah,namaayah,namaibu,almayah,almibu,pendidikanayah,pendidikanibu,pekerjaanayah,pekerjaanibu
	                ,wali,penghasilanayah,penghasilanibu,emailayah,alamatsurat,keterangan,emailibu,region,kota,provinsi,negara,pinbbm,tingkat,jurusan,tingkat_asal,jurusan_asal,t_ijazah
	                ,ijazah,t_skh,skh,t_lhb,lhb,abk,instansiayah,instansiibu,tel_ayah,tel_ibu,hp_ayah,hp_ibu,bbm_ayah,bbm_ibu,pendidikanwali,pekerjaanwali,instansiwali,penghasilanwali,hpwali
	                ,emailwali,tel_wali,hp_wali,bbm_wali,alamat_wali,info_media,pj,alamat_ibu,kota_ibu,provinsi_ibu,negara_ibu,kodepos_ibu,alamat_ayah,kota_ayah,provinsi_ayah,negara_ayah
	                ,kodepos_ayah,kota_wali,provinsi_wali,negara_wali,kodepos_wali,agama_ibu,agama_ayah,agama_wali,negara_asal,semester_awal,nis_sk,statanak,pja,remedialperilaku,kelasstatus
	                ,regionalstatus,tahunlahirayah,tahunlahiribu,sekolahjenjang,kecamatan,tahunlahirwali,jaraktempuh,waktutempuh,alattransportasi,kps,piplayak,kip,nik_ayah,nik_ibu,nik_wali,nik_siswa
									,idkelas
	                ,info1
	                ,info2
	                ,info3
	                ,ts
	                ,token
	                ,issync
	                ,created_by
	                ,created_date
	                ,modified_date
	                ,modified_by
									,no_kps,no_kip,jenjangasal,jenjangakhir,wali_opt,kecamatantext,kecamatantext_ayah,kecamatantext_ibu,kecamatantext_wali
									,instansiayahtext,instansiibutext,instansiwalitext,idtempattinggal
									,tgl_masuk
	              )
	            SELECT '".$nis."',nisn,nama,panggilan,aktif,tahunmasuk,suku,agama,status,kondisi,kelamin,tmplahir,tgllahir,warga,anakke,jsaudara,bahasa,berat,tinggi,darah,foto,alamatsiswa
	                    ,kodepossiswa,telponsiswa,hpsiswa,emailsiswa,kesehatan,asalsekolah,ketsekolah,namaayah,namaibu,almayah,almibu,pendidikanayah,pendidikanibu,pekerjaanayah,pekerjaanibu
	                    ,wali,penghasilanayah,penghasilanibu,emailayah,alamatsurat,keterangan,emailibu,region,kota,provinsi,negara,pinbbm,tingkat,jurusan,tingkat_asal,jurusan_asal,t_ijazah
	                    ,ijazah,t_skh,skh,t_lhb,lhb,abk,instansiayah,instansiibu,tel_ayah,tel_ibu,hp_ayah,hp_ibu,bbm_ayah,bbm_ibu,pendidikanwali,pekerjaanwali,instansiwali,penghasilanwali,hpwali
	                    ,emailwali,tel_wali,hp_wali,bbm_wali,alamat_wali,info_media,pj,alamat_ibu,kota_ibu,provinsi_ibu,negara_ibu,kodepos_ibu,alamat_ayah,kota_ayah,provinsi_ayah,negara_ayah
	                    ,kodepos_ayah,kota_wali,provinsi_wali,negara_wali,kodepos_wali,agama_ibu,agama_ayah,agama_wali,negara_asal,semester_awal,nis_sk,statanak,pja,remedialperilaku,kelasstatus
	                    ,regionalstatus,tahunlahirayah,tahunlahiribu,sekolahjenjang,kecamatan,tahunlahirwali,jaraktempuh,waktutempuh,alattransportasi,kps,piplayak,kip,nik_ayah,nik_ibu,nik_wali,nik_siswa
											,calon_kelas
											,info1
	                    ,info2
	                    ,info3
	                    ,ts
	                    ,token
	                    ,issync
	            ,'".$this->session->userdata('idpegawai')."'
	            ,'".$this->dbx->cts()."'
	            ,'".$this->dbx->cts()."'
	            ,'".$this->session->userdata('idpegawai')."'
							,no_kps,no_kip,jenjangasal,jenjangakhir,wali_opt,kecamatantext,kecamatantext_ayah,kecamatantext_ibu,kecamatantext_wali
							,instansiayahtext,instansiibutext,instansiwalitext,idtempattinggal
							,tanggal_masuk
	            FROM calonsiswa
	            WHERE replid='".$idcalon."'
	        ";
	        //echo $sql;die;
	        $this->db->query($sql);
	        $insert_id = $this->db->insert_id();
	        if ($this->db->affected_rows() > 0) {
	               $this->db->trans_complete();
	               $this->db->query("UPDATE calonsiswa SET replidsiswa='".$insert_id."',nissementara='".$nis."' WHERE replid='".$idcalon."'");
								 $this->db->query("UPDATE online_kronologis SET status=4 WHERE idcalon='".$idcalon."'");
		 						 return $insert_id;
		 			} else {
		 				$this->db->trans_complete();
		 					return false;
		 			}
			}else{ //isset
				return false;
			}
  }

	public function hapussiswa_db($idcalon){
    $datacs=$this->dbx->getcalonsiswa($idcalon,1);
		//echo $datacs->replidsiswa;die;
		if (ISSET($datacs)){
				 $result=$this->db->query("DELETE FROM siswa WHERE replid='".$datacs->replidsiswa."'");
				 $result=$this->db->query("UPDATE calonsiswa SET replidsiswa=NULL,nissementara=NULL WHERE replid='".$idcalon."'");
				 $result=$this->db->query("UPDATE online_kronologis SET status=3 WHERE idcalon='".$idcalon."'");
				 return $result;
			}else{ //isset
				return false;
			}
  }
}

?>
