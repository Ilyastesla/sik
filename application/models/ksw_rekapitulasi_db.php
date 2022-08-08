<?php

Class ksw_rekapitulasi_db extends CI_Model {
	public function __construct() {
		parent::__construct();
		$this->load->library('dbx');
	}

    // Read data from database to show data in admin page
    public function data() {
			$cari="";$cari2="";
			$cari=$cari." AND t.idcompany='".$this->input->post('idcompany')."' ";

			if ($this->input->post('iddepartemen')<>""){
				$cari=$cari." AND t.departemen='".$this->input->post('iddepartemen')."' ";
			}
			if ($this->input->post('idtahunajaran')<>""){
				$cari=$cari." AND t.replid='".$this->input->post('idtahunajaran')."' ";
			}else{
				$cari=$cari." AND t.aktif=1 ";
			}

			if ($this->input->post('idtingkat')<>""){
				$cari=$cari." AND tkt.replid='".$this->input->post('idtingkat')."' ";
			}

			if ($this->input->post('kelompok_siswa')<>""){
				$cari=$cari." AND k.kelompok_siswa='".$this->input->post('kelompok_siswa')."' ";
			}

			if ($this->input->post('idregional')<>""){
				$cari2=$cari2." AND s.region='".$this->input->post('idregional')."' ";
			}

				$sql = "SELECT
                	t.tahunajaran,t.departemen
                	,tkt.tingkat as tingkattext
                	,j.jurusan AS jurusantext
                	,ks.kelompok AS kelompok_siswatext
                	,SUM(k.kapasitas) as totkapasitas
                	,SUM((SELECT COUNT(*) FROM siswa s WHERE s.idkelas=k.replid AND s.aktif=1 ".$cari2.")) as jmlsiswa
                  ,SUM((SELECT COUNT(*) FROM siswa s WHERE s.idkelas=k.replid AND s.aktif=1 AND s.abk=1 ".$cari2." )) as jmlsiswaabk
				  ,(SELECT region FROM regional WHERE replid='".$this->input->post('idregional')."') as regionaltext
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

			//echo $sql;die;
			$companyrow=$this->session->userdata('idcompany');
			$sqlcompany="SELECT replid,nama as nama
									FROM hrm_company
									WHERE replid IN (".$companyrow.") AND aktif=1
									ORDER BY nama";
			$data['idcompany_opt'] = $this->dbx->opt($sqlcompany,'up');
			$data['iddepartemen_opt'] = $this->dbx->opt("SELECT departemen as replid,departemen as nama FROM departemen WHERE aktif=1 AND replid IN (".$this->session->userdata('dept').") ORDER BY urutan",'up');
			$data['idtahunajaran_opt'] = $this->dbx->opt("SELECT replid,CONCAT('[',departemen,'] ',tahunajaran) as nama FROM tahunajaran WHERE idcompany='".$this->input->post('idcompany')."' AND departemen='".$this->input->post('iddepartemen')."' ORDER BY aktif DESC ,nama DESC ",'up');
			$data['idtingkat_opt'] = $this->dbx->opt("SELECT replid,tingkat as nama FROM tingkat
													  WHERE aktif=1 AND departemen='".$this->input->post('iddepartemen')."' ORDER BY CAST(tingkat AS SIGNED) ASC",'up');
			$data['kelompok_siswa_opt'] = $this->dbx->opt("SELECT replid,CONCAT('[',departemen,'] ',kelompok) as nama FROM kelompoksiswa ks WHERE ks.departemen='".$this->input->post('iddepartemen')."' AND ks.aktif=1 ORDER BY ks.departemen,ks.kelompok",'up');
			$data['idregional_opt'] = $this->dbx->opt("SELECT replid,region as nama FROM regional ks ORDER BY nama",'up');
			return $data;
    }
}

?>
