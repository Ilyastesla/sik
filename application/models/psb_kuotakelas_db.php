<?php

Class psb_kuotakelas_db extends CI_Model {
	public function __construct() {
		parent::__construct();
		$this->load->library('dbx');
	}

    // Read data from database to show data in admin page
    public function data() {
			$cari="";

			//if ($this->input->post('iddepartemen')<>""){
				$cari=$cari." AND t.departemen='".$this->input->post('iddepartemen')."' ";
			//}
			//if ($this->input->post('idtahunajaran')<>""){
				$cari=$cari." AND t.replid='".$this->input->post('idtahunajaran')."' ";
			//}
			/*
			else{
				$cari=$cari." AND t.aktif=1 ";
			}*/

			if ($this->input->post('idtingkat')<>""){
				$cari=$cari." AND tkt.replid='".$this->input->post('idtingkat')."' ";
			}

			if ($this->input->post('kelompok_siswa')<>""){
				$cari=$cari." AND k.kelompok_siswa='".$this->input->post('kelompok_siswa')."' ";
			}
				$sql = "SELECT
                	t.tahunajaran,t.departemen
                	,tkt.tingkat as tingkattext
                	,j.jurusan AS jurusantext
                	,ks.kelompok AS kelompok_siswatext
                	,SUM(k.kapasitas) as totkapasitas
                	,SUM((SELECT COUNT(*) FROM siswa s WHERE s.idkelas=k.replid AND s.aktif=1)) as jmlsiswa
                  ,SUM((SELECT COUNT(*) FROM siswa s WHERE s.idkelas=k.replid AND s.aktif=1 AND s.abk=1)) as jmlsiswaabk
              FROM kelas k
              INNER JOIN tahunajaran t ON k.idtahunajaran = t.replid
              INNER JOIN tingkat tkt ON tkt.replid = k.idtingkat
              INNER JOIN kelompoksiswa ks ON ks.replid = k.kelompok_siswa
              LEFT JOIN jurusan j ON j.replid = k.jurusan
              WHERE
              	k.replid <> 0
                ".$cari."
              GROUP BY t.replid,tkt.replid,j.replid,ks.replid
              ORDER BY
              	t.departemen ASC,t.tahunajaran DESC,CAST(tkt.tingkat AS SIGNED) ASC";
				//echo $sql;die;
				$data['show_table']=$this->dbx->data($sql);

			//die;
			$data['iddepartemen_opt'] = $this->dbx->opt("SELECT departemen as replid,departemen as nama FROM departemen WHERE replid IN (".$this->session->userdata('dept').") ORDER BY urutan",'up');
			$data['idtahunajaran_opt'] = $this->dbx->opt("SELECT replid,CONCAT('[',departemen,'] ',tahunajaran) as nama FROM tahunajaran WHERE idcompany='".$this->session->userdata('idcompany')."' AND departemen='".$this->input->post('iddepartemen')."' ORDER BY aktif DESC ,nama DESC ",'up');
			$data['idtingkat_opt'] = $this->dbx->opt("SELECT replid,tingkat as nama FROM tingkat
																								WHERE aktif=1 AND departemen='".$this->input->post('iddepartemen')."' ORDER BY CAST(tingkat AS SIGNED) ASC",'up');
			$data['kelompok_siswa_opt'] = $this->dbx->opt("SELECT replid,CONCAT('[',departemen,'] ',kelompok) as nama FROM kelompoksiswa ks WHERE ks.departemen='".$this->input->post('iddepartemen')."' AND ks.aktif=1 ORDER BY ks.departemen,ks.kelompok",'up');
			return $data;
    }
}

?>
