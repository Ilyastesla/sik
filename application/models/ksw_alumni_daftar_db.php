<?php

Class ksw_alumni_daftar_db extends CI_Model {
	public function __construct() {
		parent::__construct();
		$this->load->library('dbx');
	}

    // Read data from database to show data in admin page
    public function data() {
		$cari="";
		$cari=$cari." AND ta.idcompany='".$this->input->post('idcompany')."' ";
      	$cari=$cari." AND k.idtahunajaran='".$this->input->post('idtahunajaran')."' ";
		if ($this->input->post('idkelas')<>""){
			$cari=$cari." AND s.idkelas='".$this->input->post('idkelas')."' ";
		}

		//,(select replid from calonsiswa where replidsiswa=s.replid) replidcalon
		$sql = "SELECT s.*,DAY(s.tgllahir),MONTH(s.tgllahir)
						,YEAR(s.tgllahir),ks.kondisi as kondisi_nm
						,(DATEDIFF (current_date(),s.tgl_masuk)) as jml_hari
						,akt.angkatan,r.region,s.remedialperilaku
						, DATE_FORMAT(s.tgl_berlaku, '%d %M %Y') as tgl_berlaku
						, DATE_FORMAT(s.tgl_berlaku2, '%d %M %Y') as tgl_berlaku2
						,(IF (CURRENT_DATE() BETWEEN tgl_berlaku AND tgl_berlaku2, 1,0)) as periode_as
						,administrasisiswa, r.replid as idregion
						,a.tgllulus
				FROM siswa s
				INNER JOIN alumni a ON a.nis=s.nis
				LEFT JOIN kondisisiswa ks ON ks.replid=s.kondisi
				LEFT JOIN kelas k ON s.idkelas = k.replid
				LEFT JOIN tahunajaran ta ON ta.replid = k.idtahunajaran
				LEFT JOIN angkatan akt ON akt.replid=s.idangkatan
				LEFT JOIN regional r ON r.replid=s.region
				WHERE s.alumni=1 AND s.aktif=0 ".$cari."
				ORDER BY s.nama ";
		//echo $sql;die;
		$data['show_table']=$this->dbx->data($sql);
		$data['hariini']=$this->dbx->cts();

		$sqlriwayat="SELECT rks.*,s.nama,ks.kondisi as kondisi_nm,r.region,s.replid as idsiswa
									FROM riwayatkelassiswa rks
									INNER JOIN siswa s ON s.nis=rks.nis
									LEFT JOIN kondisisiswa ks ON ks.replid=rks.kondisitujuan
									LEFT JOIN regional r ON r.replid=rks.regiontujuan
									WHERE s.alumni=1 AND rks.idkelastujuan='".$this->input->post('idkelas')."'";
		$data['riwayat']=$this->dbx->data($sqlriwayat);


		$data['iddepartemen_opt'] = $this->dbx->opt("SELECT departemen as replid,departemen as nama FROM departemen WHERE aktif=1 AND replid IN (".$this->session->userdata('dept').") ORDER BY urutan",'up');
		$data['idtahunajaran_opt'] = $this->dbx->opt("SELECT replid,CONCAT('[',departemen,'] ',tahunajaran) as nama FROM tahunajaran WHERE idcompany='".$this->input->post('idcompany')."' AND departemen='".$this->input->post('iddepartemen')."' ORDER BY aktif DESC ,nama DESC ",'up');

		$data['idtingkat_opt'] = $this->dbx->opt("SELECT replid,tingkat as nama FROM tingkat
																							WHERE aktif=1 AND departemen='".$this->input->post('iddepartemen')."' ORDER BY urutan DESC LIMIT 1",'up');

		$data['idkelas_opt'] = $this->dbx->opt("SELECT k.replid,k.kelas as nama FROM kelas k
																								INNER JOIN tingkat t ON k.idtingkat=t.replid
																								WHERE k.aktif=1
																									AND k.idtahunajaran='".$this->input->post('idtahunajaran')."'
																									AND k.idtingkat='".$this->input->post('idtingkat')."'
																								ORDER BY nama",'up');
		$companyrow=$this->session->userdata('idcompany');
		$sqlcompany="SELECT replid,nama as nama
								FROM hrm_company
								WHERE replid IN (".$companyrow.") AND aktif=1
								ORDER BY nama";
		$data['idcompany_opt'] = $this->dbx->opt($sqlcompany,'up');
		return $data;
    }
}

?>
