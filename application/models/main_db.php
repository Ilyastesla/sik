<?php

Class main_db extends CI_Model {

  public function __construct() {
    parent::__construct();
    $this->load->library('dbx');
  }

  public function data() {
      $companyrow=$this->session->userdata('idcompany');
	$sqlcompany="SELECT replid
                        FROM hrm_company
                        WHERE replid IN (".$companyrow.") AND aktif=1
                        ORDER BY nama";

    	$sql = "SELECT b.*,DATE_FORMAT(b.modified_date,'%H:%i') as timex,'berita' as tipetimeline
    					,p.nama,p.nip
    			FROM hrm_berita b
    			INNER JOIN hrm_berita_tujuan bt ON b.replid=bt.berita_id
    			INNER JOIN pegawai p ON b.created_by=p.replid
    			WHERE b.aktif=1 AND bt.idrole IN (
            '".$this->session->userdata('role_id')."'
    			)
    			ORDER BY b.modified_date DESC
          LIMIT 20
    			";
      $data['show_table']=$this->dbx->data($sql);

      $sql="SELECT kk.*,c.nama as idcompany,p.nama as idpegawai,d.departemen as iddepartemen,sp.nama as idpegawai_status
          ,j.jabatan as jabatantext
          ,DATEDIFF(kk.akhir_kontrak,CURRENT_DATE()) as sisahari
          FROM hrm_pegawai_jabatan kk
          LEFT JOIN hrm_company c ON kk.idcompany=c.replid
          LEFT JOIN pegawai p ON kk.idpegawai=p.replid
          LEFT JOIN hrm_jabatan j ON j.replid=kk.idjabatan
          LEFT JOIN hrm_departemen d ON j.iddepartemen=d.replid
          LEFT JOIN hrm_reff sp ON sp.replid=kk.idpegawai_status
          WHERE kk.idpegawai='". $this->session->userdata('idpegawai')."'
          ORDER BY kk.akhir_kontrak ASC";
      $data['jabatan']=$this->dbx->data($sql);
      /*
      $sql="SELECT COUNT(replid) as isi
            FROM siswa_kronologis
            WHERE YEAR(tgl_masuk)=YEAR(CURRENT_DATE())";
      $data['jumlahtamu']=$this->dbx->singlerow($sql);
      

      //YEAR(cs.tanggal_daftar)=YEAR(CURRENT_DATE()) AND
      $sql="SELECT COUNT(cs.replid) as isi
            FROM calonsiswa cs
            INNER JOIN online_kronologis ok ON ok.idcalon=cs.replid
            WHERE  ok.idunitbisnis IN (".$sqlcompany.")
                  AND YEAR (ok.created_date) = YEAR (CURRENT_DATE())
                  AND cs.aktif=1 AND cs.replidsiswa is NULL ";
      $data['jumlahcs']=$this->dbx->singlerow($sql);
      */
      $sql="SELECT COUNT(cs.replid) as isi
              FROM calonsiswa cs
              INNER JOIN online_kronologis ok ON ok.idcalon=cs.replid
              WHERE  ok.idunitbisnis IN (".$sqlcompany.")
                    AND YEAR (ok.created_date) = YEAR (CURRENT_DATE())
                    AND cs.aktif=1
              AND cs.replidsiswa is not null ";
      $data['jumlahsiswabaru']=$this->dbx->singlerow($sql);
      
      $sql="SELECT COUNT(s.replid) as isi
            FROM siswa s
            INNER JOIN kelas k ON k.replid=s.idkelas
            INNER JOIN tahunajaran ta ON ta.replid=k.idtahunajaran
            WHERE ta.idcompany IN (".$sqlcompany.") 
                  AND s.aktif=1 AND YEAR(tglmulai)=YEAR(CURRENT_DATE()) ";
      $data['jumlahsiswa']=$this->dbx->singlerow($sql);
      
      /*
      $sql="SELECT COUNT(replid) as isi
            FROM pegawai
            WHERE aktif=1 ";
      $data['jumlahpegawai']=$this->dbx->singlerow($sql);
      */

      //WHERE MONTH(p.tgllahir)=MONTH(current_date) AND p.aktif=1
      $sql="SELECT p.*
            FROM pegawai p
            WHERE p.tgllahir=current_date() AND p.aktif=1
            ORDER BY day(p.tgllahir) ASC";
      //echo $sql;die;
      $data['pegawaiultah']=$this->dbx->data($sql);
      //echo $sql;die;
      
      $sql="SELECT p.*,c.nama as companytext,current_date() as now 
            FROM pegawai p
            INNER JOIN hrm_company c ON c.replid=p.idcompany
            WHERE RIGHT(LEFT(p.nip,8),6)=CONCAT(year(current_date),lpad(right(month(current_date),2),2,'0')) AND p.aktif=1
            ORDER BY companytext,p.nama ASC";
      //echo $sql;die;
      $data['pegawaibaru']=$this->dbx->data($sql);

      return $data;
  }
}

?>
