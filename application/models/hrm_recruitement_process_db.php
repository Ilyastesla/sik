<?php

Class hrm_recruitement_process_db extends CI_Model {
	public function __construct() {
	parent::__construct();
		$this->load->library('dbx');
	}

    public function data($id="") {
        $cari="";
        if ($id<>""){
          $cari .= " AND cp.replid='".$id."' ";
        }

				$sql="SELECT cp.*,hrp.status,s.status as statustext,hrp.harapangaji,hrp.tglgabung,hrp.niksementara
              ,(TIMESTAMPDIFF(YEAR, cp.tgllahir, CURDATE())) as umur
              , j.jabatan as jabatantext,pr.reff as tipepekerjaantext,c.nama as companytext
              , hrp.replid as idproses,hrp.idpegawai 
      			FROM pegawai_calon cp
            INNER JOIN hrm_recruitement_progress hrp ON hrp.idcalonpegawai=cp.replid
            INNER JOIN hrm_recruitement_status s ON s.node=hrp.status
            INNER JOIN hrm_recruitement r ON r.replid=hrp.idhrm_recruitement
            INNER JOIN hrm_jabatan j ON j.replid=r.idjabatan
						INNER JOIN pegawai_reff pr ON pr.replid=r.idtipepekerjaan
						INNER JOIN hrm_company c ON c.replid=r.idcompany
            WHERE hrp.status>=6 ".$cari."
      			ORDER BY cp.created_date DESC";
            //echo $sql;die;
            $data['show_table']=$this->dbx->data($sql);
						return $data;
    }

    public function tambah_db($id,$data) {
    		$sql="SELECT *
      			FROM hrm_recruitement_progress
      			WHERE replid='".$id."'";
        $data['isi'] = $this->dbx->rows($sql);

        if ($data['isi']== NULL ) {
					unset($data['isi']);
	        $sql="SELECT ".$this->dbx->tablecolumn('hrm_recruitement_progress');
	        $data['isi']=$this->dbx->rows($sql);
        }
        $data['idtipealasan_opt']=$this->dbx->opt("select replid, reff as nama from pegawai_reff WHERE aktif=1 AND type=13 ORDER BY nama",'up');
        return $data;
    }
    public function niksementara($id) {
      $sql="SELECT c.kodecabang,lpad(month(tglbekerja),2,'0') as bulankerja,year(tglbekerja) as tahunkerja,cp.kelamin
          FROM hrm_recruitement_progress hrp
          INNER JOIN pegawai_calon cp ON hrp.idcalonpegawai=cp.replid
          INNER JOIN hrm_recruitement r ON r.replid=hrp.idhrm_recruitement
          INNER JOIN pegawai_reff pr ON pr.replid=r.idtipepekerjaan
          INNER JOIN hrm_company c ON c.replid=r.idcompany
          WHERE hrp.replid='".$id."'";
      $masterdata= $this->dbx->rows($sql);
      $nik=$masterdata->kodecabang.$masterdata->tahunkerja.$masterdata->bulankerja;
      if(strtoupper($masterdata->kelamin)=='L'){
        $nik.=1;
      }else{
        $nik.=2;
      }
      $sqlnik="SELECT lpad(right(nip,3)+1,3,'0') as isi FROM pegawai WHERE LEFT(nip,6)='".$masterdata->kodecabang.$masterdata->tahunkerja."' order by right(nip,3) DESC LIMIT 1";
      //echo $sqlnik;die;
      $nikurutan=$this->dbx->singlerow($sqlnik);
      if($nikurutan==""){
        $nikurutan="001";
      }
      $nik=$nik.$nikurutan;
      return $nik;
   }

   public function imporpegawai($id) {
     $sql="SELECT *
         FROM hrm_recruitement_progress
         WHERE replid='".$id."'";
     $masterdata= $this->dbx->rows($sql);

     $sqlimpor="INSERT INTO pegawai(nip,nrp,nuptk,nama,panggilan,gelarawal,gelarakhir,tmplahir,tgllahir,agama,telpon,handphone,handphone2,bbm,email
                    ,linkedin,facebook,twitter,website,status_nikah,tgl_nikah,aktif,kelamin,pinpegawai,mulaikerja,status,ketnonaktif
                    ,pensiun,golongan_darah,warganegara,berat_badan,tinggi_badan,anak_ke,jml_saudara,nama_gadis_ibu,pekerjaan_ibu
                    ,nama_ayah,pekerjaan_ayah,kode_pajak,alamat_tinggal,kecamatan,kota,provinsi,negara,kode_pos,tinggal_sejak
                    ,alamat_tinggal2,kecamatan2,kota2,provinsi2,negara2,kode_pos2,telepon,tinggal_sejak2,hobi,warna,barang,ukuran_baju
                    ,ukuran_celana,ukuran_sepatu,motto,tokoh,target,merokok,sakit_ringan,sakit_berat,kondisi_sekarang,sifat_positif
                    ,sifat_negatif,minat,perkembangan_pribadi,daftar_buku,alasan_bekerja,keterangan,ingin_posisi,alasan_jabatan
                    ,harapan_gaji,no_sk,idjabatan,idpegawai_status,idcompany,akhir_kontrak,jam_masuk,jam_keluar,avg_kompetensi
                    ,total_pinjaman,fotodisplay,ttd,niplama,instagram,jml_anak,created_by,created_date)
                SELECT '".$masterdata->niksementara."',nrp,nuptk,nama,panggilan,gelarawal,gelarakhir,tmplahir,tgllahir,agama,telpon,handphone,handphone2,bbm,email
                               ,linkedin,facebook,twitter,website,status_nikah,tgl_nikah,aktif,kelamin,pinpegawai,mulaikerja,status,ketnonaktif
                               ,pensiun,golongan_darah,warganegara,berat_badan,tinggi_badan,anak_ke,jml_saudara,nama_gadis_ibu,pekerjaan_ibu
                               ,nama_ayah,pekerjaan_ayah,kode_pajak,alamat_tinggal,kecamatan,kota,provinsi,negara,kode_pos,tinggal_sejak
                               ,alamat_tinggal2,kecamatan2,kota2,provinsi2,negara2,kode_pos2,telepon,tinggal_sejak2,hobi,warna,barang,ukuran_baju
                               ,ukuran_celana,ukuran_sepatu,motto,tokoh,target,merokok,sakit_ringan,sakit_berat,kondisi_sekarang,sifat_positif
                               ,sifat_negatif,minat,perkembangan_pribadi,daftar_buku,alasan_bekerja,keterangan,ingin_posisi,alasan_jabatan
                               ,harapan_gaji,no_sk,idjabatan,idpegawai_status,idcompany,akhir_kontrak,jam_masuk,jam_keluar,avg_kompetensi
                               ,total_pinjaman,fotodisplay,ttd,niplama,instagram,jml_anak,'".$this->session->userdata('idpegawai')."','".$this->dbx->cts()."'
                FROM pegawai_calon WHERE replid='".$masterdata->idcalonpegawai."'";

		 $this->db->query($sqlimpor);
     $idpegawai = $this->db->insert_id();

		 $sqlimpor="UPDATE hrm_recruitement_progress SET idpegawai='".$idpegawai."' WHERE replid='".$id."'";
		 $result=$this->db->query($sqlimpor);

     $sqlimpor="INSERT INTO pegawai_perbankan (pegawai_id,type,nomor,tgl_pembuatan,berlaku,keterangan,created_date,created_by)
                SELECT ".$idpegawai.",type,nomor,tgl_pembuatan,berlaku,keterangan,'".$this->dbx->cts()."','".$this->session->userdata('idpegawai')."'
                FROM pegawai_perbankan WHERE calonpegawai_id='".$masterdata->idcalonpegawai."'";
     $result=$this->db->query($sqlimpor);

     $sqlimpor="INSERT INTO pegawai_kontak_darurat(pegawai_id,nama,hubungan,alamat,kecamatan,kota,provinsi,kode_pos,negara,telepon,handphone,email,created_date,created_by)
               SELECT ".$idpegawai.",nama,hubungan,alamat,kecamatan,kota,provinsi,kode_pos,negara,telepon,handphone,email,'".$this->dbx->cts()."','".$this->session->userdata('idpegawai')."'
               FROM  pegawai_kontak_darurat WHERE calonpegawai_id='".$masterdata->idcalonpegawai."'";
     $result=$this->db->query($sqlimpor);

     $sqlimpor="INSERT INTO pegawai_keluarga (pegawai_id,nama,jenis_kelamin,hubungan,tempat_lahir,tanggal_lahir,pendidikan_terakhir,pekerjaan,instansi,created_date,created_by)
                SELECT ".$idpegawai.",nama,jenis_kelamin,hubungan,tempat_lahir,tanggal_lahir,pendidikan_terakhir,pekerjaan,instansi,'".$this->dbx->cts()."','".$this->session->userdata('idpegawai')."'
                FROM pegawai_keluarga WHERE calonpegawai_id='".$masterdata->idcalonpegawai."'";
     $result=$this->db->query($sqlimpor);

     $sqlimpor="INSERT INTO pegawai_pendidikan (pegawai_id,jenjang,institusi,fakultas,jurusan,tahun_masuk,tahun_keluar,created_date,created_by)
                 SELECT ".$idpegawai.",jenjang,institusi,fakultas,jurusan,tahun_masuk,tahun_keluar,'".$this->dbx->cts()."','".$this->session->userdata('idpegawai')."'
                 FROM pegawai_pendidikan WHERE calonpegawai_id='".$masterdata->idcalonpegawai."'";
     $result=$this->db->query($sqlimpor);

     $sqlimpor="INSERT INTO pegawai_pendidikan_nf(pegawai_id,institusi,tgl_masuk,tgl_keluar,dibiayai,keterangan,tahun_masuk,tahun_keluar,created_date,created_by)
                SELECT ".$idpegawai.",institusi,tgl_masuk,tgl_keluar,dibiayai,keterangan,tahun_masuk,tahun_keluar,'".$this->dbx->cts()."','".$this->session->userdata('idpegawai')."'
                FROM pegawai_pendidikan_nf WHERE calonpegawai_id='".$masterdata->idcalonpegawai."'";
     $result=$this->db->query($sqlimpor);

     $sqlimpor="INSERT INTO pegawai_bahasa(pegawai_id,bahasa,bicara,menulis,membaca,toefl,created_date,created_by)
               SELECT ".$idpegawai.",bahasa,bicara,menulis,membaca,toefl,'".$this->dbx->cts()."','".$this->session->userdata('idpegawai')."'
               FROM pegawai_bahasa WHERE calonpegawai_id='".$masterdata->idcalonpegawai."'";
     $result=$this->db->query($sqlimpor);

     $sqlimpor="INSERT INTO pegawai_komputer(pegawai_id,komputer,bidang,tingkat,keterangan,created_date,created_by)
                SELECT ".$idpegawai.",komputer,bidang,tingkat,keterangan,'".$this->dbx->cts()."','".$this->session->userdata('idpegawai')."'
                FROM pegawai_komputer WHERE calonpegawai_id='".$masterdata->idcalonpegawai."'";
     $result=$this->db->query($sqlimpor);

     $sqlimpor="INSERT INTO pegawai_skill(pegawai_id,skill,tingkat,created_date,created_by)
                 SELECT ".$idpegawai.",skill,tingkat'".$this->dbx->cts()."','".$this->session->userdata('idpegawai')."'
                 FROM pegawai_skill WHERE calonpegawai_id='".$masterdata->idcalonpegawai."'";
     $result=$this->db->query($sqlimpor);

     $sqlimpor="INSERT INTO pegawai_prestasi(pegawai_id,tahun,prestasi,tingkat,instansi,created_date,created_by)
                 SELECT ".$idpegawai.",tahun,prestasi,tingkat,instansi,'".$this->dbx->cts()."','".$this->session->userdata('idpegawai')."'
                 FROM pegawai_prestasi WHERE calonpegawai_id='".$masterdata->idcalonpegawai."'";
     $result=$this->db->query($sqlimpor);

     $sqlimpor="INSERT INTO pegawai_organisasi(pegawai_id,)
                 SELECT ".$idpegawai.",'".$this->dbx->cts()."','".$this->session->userdata('idpegawai')."'
                 FROM pegawai_organisasi WHERE calonpegawai_id='".$masterdata->idcalonpegawai."'";
     $result=$this->db->query($sqlimpor);

     $sqlimpor="INSERT INTO pegawai_kerja(pegawai_id,instansi,organisasi,jabatan,tanggung_jawab,tgl_masuk,tgl_keluar,tahun_masuk,tahun_keluar,created_date,created_by)
                 SELECT ".$idpegawai.",instansi,organisasi,jabatan,tanggung_jawab,tgl_masuk,tgl_keluar,tahun_masuk,tahun_keluar,'".$this->dbx->cts()."','".$this->session->userdata('idpegawai')."'
                 FROM pegawai_kerja WHERE calonpegawai_id='".$masterdata->idcalonpegawai."'";
     $result=$this->db->query($sqlimpor);
     
     return true;
   }
}

?>
