<?php

Class siswa_db extends CI_Model {
	public function __construct() {
		parent::__construct();
		$this->load->library('dbx');
	}

    // Read data from database to show data in admin page
    public function index_table() {
			$cari="";
	    $cari=$cari." AND k.idtahunajaran= '".$this->input->post('idtahunajaran')."' ";
	    $cari=$cari." AND s.idkelas='".$this->input->post('idkelas')."' ";

				// LEFT JOIN tahunajaran t ON t.replid = k.idtahunajaran
				$sql = "SELECT nis,nama,asalsekolah,tmplahir,tgllahir,s.aktif,DAY(tgllahir),MONTH(tgllahir)
						,YEAR(tgllahir),s.replid,s.statusmutasi,s.alumni,s.nisn,s.abk,ks.kondisi as kondisi_nm
						,(select replid from calonsiswa where replidsiswa=s.replid) replidcalon
						,(DATEDIFF (current_date(),s.tgl_masuk)) as jml_hari
						,(SELECT 1 FROM besarjtt WHERE nis=s.nis AND DATEDIFF(tgl_batas,CURRENT_DATE())<=30 AND lunas<>1 LIMIT 1) as keuangan
						,(SELECT 1 FROM besarjttcalon WHERE idcalon=replidcalon AND DATEDIFF(tgl_batas,CURRENT_DATE())<=30 AND lunas<>1 LIMIT 1) as keuangan2
						,akt.angkatan,r.region,s.remedialperilaku
						,(IF (CURRENT_DATE() BETWEEN tgl_berlaku AND tgl_berlaku2, 1,0)) as periode_as
						, DATE_FORMAT(s.tgl_berlaku, '%d %M %Y') as tgl_berlaku
						, DATE_FORMAT(s.tgl_berlaku2, '%d %M %Y') as tgl_berlaku2
						,administrasisiswa
						FROM siswa s
						LEFT JOIN kondisisiswa ks ON ks.replid=s.kondisi
						LEFT JOIN kelas k ON s.idkelas = k.replid
						LEFT JOIN angkatan akt ON akt.replid=s.idangkatan
						LEFT JOIN regional r ON r.replid=s.region
						"
						."WHERE s.alumni=0 ".$cari." ORDER BY s.nama ";
				// echo $sql;die;
				$data['show_table']=$this->dbx->data($sql);

				$departemencari="";
				if ($this->input->post('idtahunajaran')<>""){
						$dc=$this->dbx->rows("SELECT departemen FROM tahunajaran WHERE replid='".$this->input->post('idtahunajaran')."'");
						$idtahunajaranfil=$this->input->post('idtahunajaran');
				}else{
					$dc=$this->dbx->rows("SELECT replid,departemen FROM tahunajaran WHERE departemen IN (SELECT departemen FROM departemen  WHERE replid IN (".$this->session->userdata('dept').")) ORDER BY aktif DESC ,CONCAT('[',departemen,'] ',tahunajaran) DESC LIMIT 1");
					$idtahunajaranfil=$dc->replid;
				}
				$departemencari=" AND iddepartemen='".$dc->departemen."'";

        //Tahun Ajaran
        //---------------------------------------------------------------------------------------------
        $data['idtahunajaran_opt'] = $this->dbx->opt("SELECT replid,CONCAT('[',departemen,'] ',tahunajaran) as nama FROM tahunajaran WHERE departemen IN (SELECT departemen FROM departemen  WHERE replid IN (".$this->session->userdata('dept').")) ORDER BY aktif DESC ,nama DESC ",'up',"1");

        //KELAS
        //-----------------------------------------------------------------------------------------------
				//AND replid IN (".$this->session->userdata('kelas').")
				$data['idkelas_opt'] = $this->dbx->opt("SELECT k.replid,CONCAT(t.tingkat,' - ',k.kelas) as nama FROM kelas k INNER JOIN tingkat t ON k.idtingkat=t.replid
        												WHERE k.aktif=1 AND k.idtahunajaran='".$idtahunajaranfil."' AND k.replid IN (".$this->session->userdata('kelas').")
        												ORDER BY t.tingkat,k.kelas",'up');
        return $data;
    }
}

?>
