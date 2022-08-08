<?php

Class psb_penjadwalan_db extends CI_Model {
	public function __construct() {
		parent::__construct();
		$this->load->library('dbx');
	}

    // Read data from database to show data in admin page
    public function data() {
		$cari="";
		
		
		if ($this->input->post('nama')<>""){
			$cari=$cari." AND c.nama LIKE '%".$this->input->post('nama')."%'";
		}else{
			if ($this->input->post('iddepartemen')<>""){
				//AND c.tahunmasuk='".$this->input->post('tahunmasuk')."'
				$cari=$cari." AND pps.departemen='".$this->input->post('iddepartemen')."'
											AND c.idtahunajaran='".$this->input->post('idtahunajaran')."'";
				if ($this->input->post('idproses')<>""){
					$cari=$cari." AND c.idproses='".$this->input->post('idproses')."'";
				}
				if ($this->input->post('idkelompok')<>""){
					$cari=$cari." AND c.idkelompok='".$this->input->post('idkelompok')."'";
				}
			}else{
				$cari=" AND YEAR(c.tanggal_daftar)=YEAR(CURRENT_DATE()) ";
			}
			//AND MONTH(c.tanggal_daftar)=MONTH(CURRENT_DATE())
      	}
		
		$cari=$cari." AND ta.idcompany='".$this->input->post('idcompany')."'";

      	$sql = "SELECT c.*,kcs.kelompok as kelompokcalontext,pps.proses as prosestext,pps.departemen
                          ,t.tingkat as tingkattext, kls.kelas as kelastext,ks.kondisi as kondisitext
                          ,kcs.lamaproses,DATEDIFF(CURRENT_DATE(),c.tanggal_daftar) as lama
                      FROM calonsiswa c
											LEFT JOIN online_kronologis ok ON ok.idcalon=c.replid
											INNER JOIN tahunajaran ta ON ok.idtahunajaran = ta.replid
                			LEFT JOIN  prosespenerimaansiswa pps ON c.idproses = pps.replid
                			LEFT JOIN  kelompokcalonsiswa kcs ON kcs.idproses = pps.replid AND c.idkelompok = kcs.replid
                			LEFT JOIN  tingkat t ON c.tingkat=t.replid
                			LEFT JOIN  kondisisiswa ks ON ks.replid=c.kondisi
                			LEFT JOIN  kelas kls ON c.calon_kelas = kls.replid
                      WHERE c.aktif=1 
									".$cari."
									ORDER BY c.nama ";
		//echo $sql;die;
		$data['show_table']=$this->dbx->data($sql);
		$data['iddepartemen_opt'] = $this->dbx->opt("SELECT departemen as replid,departemen as nama FROM departemen WHERE replid IN (".$this->session->userdata('dept').") ORDER BY urutan",'up');
//$data['tahunmasuk_opt'] = $this->dbx->opt("SELECT DISTINCT tahunmasuk as replid, tahunmasuk as nama FROM calonsiswa ORDER BY tahunmasuk DESC",'up');
		$data['idtahunajaran_opt'] = $this->dbx->opt("SELECT replid, tahunajaran as nama FROM tahunajaran WHERE idcompany='".$this->input->post('idcompany')."' AND departemen='".$this->input->post('iddepartemen')."' ORDER BY tahunajaran DESC",'up');
		$data['idproses_opt'] = $this->dbx->opt("SELECT replid,proses as nama FROM prosespenerimaansiswa WHERE departemen='".$this->input->post('iddepartemen')."' ORDER BY proses",'up');
		$data['idkelompok_opt'] = $this->dbx->opt("SELECT replid,kelompok as nama FROM kelompokcalonsiswa WHERE aktif=1 AND idproses='".$this->input->post('idproses')."' ORDER BY kelompok",'up');
        $sqlpsb="SELECT replid,reff as nama FROM kegiatan_reff
                      						WHERE type='3' AND replid in (SELECT jr.kegiatan_reff_id FROM jadwal_reff jr
                      						INNER JOIN kelompokcalonsiswa kcs ON kcs.kelompok_siswa = jr.kelompok_id where kcs.replid='".$this->input->post('idkelompok')."')
                      						ORDER BY urutan";
        $data['keg_id_opt'] =$this->dbx->opt($sqlpsb);
        //die;
		$companyrow=$this->session->userdata('idcompany');
		$sqlcompany="SELECT replid,nama as nama
								FROM hrm_company
								WHERE replid IN (".$companyrow.") AND aktif=1
								ORDER BY nama";
		$data['idcompany_opt'] = $this->dbx->opt($sqlcompany,'up');
		return $data;
	}

     //TAMBAH
    public function tambah_db($data,$idcalon,$replid='') {
		$idcompany = $this->dbx->singlerow("SELECT ta.idcompany as isi FROM calonsiswa cs INNER JOIN tahunajaran ta ON ta.replid=cs.idtahunajaran WHERE cs.replid='".$idcalon."'");
      	  $sql="SELECT *,TIME_FORMAT(tgl_mulai,'%H:%i') as jammulai
                      ,TIME_FORMAT(tgl_mulai,'%H:%i') as jamakhir
            FROM kegiatan
      			WHERE replid='".$replid."'";
        $data['isi'] = $this->dbx->rows($sql);

        if ($data['isi']== NULL ) {
        	unset($data['isi']);
        	$sql="SELECT ".$this->dbx->tablecolumn('kegiatan')
                  .",CURRENT_DATE() as tgl_mulai
                  ,DATE_ADD(CURRENT_DATE(), INTERVAL 14 DAY) as tgl_akhir
                  ,'09:00' as jammulai
                  ,'12:00' as jamakhir
                ";
          //echo $sql;die;
        	$data['isi']=$this->dbx->rows($sql);
        }

        $data['idpegawai_opt']=NULL;
				/*
        if ($data['keg_id']==9){
          $sql="SELECT l.login as replid,p.nama as nama FROM login l INNER JOIN pegawai p ON l.login=p.nip INNER JOIN role r ON r.replid=l.role_id INNER JOIN role_map rm ON r.replid=rm.role_id
                WHERE rm.submenu_id=17 AND p.aktif=1 AND l.aktif=1 ORDER BY p.nama";
          $data['idpegawai_opt'] = $this->dbx->opt($sql,'up');
        }else if($data['keg_id']==10){
          $sql="SELECT l.login as replid,p.nama FROM login l INNER JOIN pegawai p ON l.login=p.nip INNER JOIN role r ON r.replid=l.role_id INNER JOIN role_map rm ON r.replid=rm.role_id
                WHERE rm.submenu_id=19 AND p.aktif=1 AND l.aktif=1 ORDER BY p.nama";
          $data['idpegawai_opt'] = $this->dbx->opt($sql,'up');
        }
				*/
				if ($data['keg_id']==9){
					$sql="SELECT p.replid as replid,p.nama FROM pegawai p INNER JOIN tahunajaran ta ON ta.idkonselor=p.replid WHERE  ta.idcompany='".$idcompany."' AND ta.aktifdaftar=1 ";
					$data['idpegawai_opt'] = $this->dbx->opt($sql,'up');
				}else if($data['keg_id']==10){
					$sql="SELECT p.replid as replid,p.nama FROM pegawai p INNER JOIN tahunajaran ta ON ta.idpsikolog=p.replid WHERE  ta.idcompany='".$idcompany."' AND ta.aktifdaftar=1 ";
					$data['idpegawai_opt'] = $this->dbx->opt($sql,'up');
				}
				//echo $sql;die;
        $sql="SELECT k.replid, k.kelas as nama FROM kelas k
              INNER JOIN tahunajaran ta ON ta.replid=k.idtahunajaran
              INNER JOIN calonsiswa cs ON cs.tingkat=k.idtingkat
              WHERE ta.aktif=1 AND cs.replid='".$data['siswa_id']."'
                    AND k.kapasitas>((SELECT COUNT(*) FROM siswa WHERE idkelas=k.replid)+(SELECT COUNT(*) FROM kegiatan WHERE aktif=1 AND kelas_id=k.replid))";
        //echo $sql;die;
        $data['kelas_id_opt'] = $this->dbx->opt($sql,'up');

				return $data;
  }
}

?>
