<?php

Class ksw_mutasi_db extends CI_Model {
	public function __construct() {
		parent::__construct();
		$this->load->library('dbx');
	}

    // Read data from database to show data in admin page
    public function data() {
			$cari="";

			$cari="";
			$cari=$cari." AND ta.idcompany='".$this->input->post('idcompany')."' ";
      		$cari=$cari." AND k.idtahunajaran='".$this->input->post('idtahunajaran')."' ";
			if ($this->input->post('idtingkat')<>""){
				$cari=$cari." AND k.idtingkat='".$this->input->post('idtingkat')."' ";
			}
			if ($this->input->post('idkelas')<>""){
				$cari=$cari." AND s.idkelas='".$this->input->post('idkelas')."' ";
			}

				$sql = "SELECT s.*
							,k.kelas as kelastext,jm.jenismutasi as jenismutasitext
							,ms.tglmutasi,ms.keterangan as ketmutasi 
						FROM siswa s
						LEFT JOIN kelas k ON s.idkelas = k.replid
						LEFT JOIN tahunajaran ta ON ta.replid = k.idtahunajaran
						LEFT JOIN (SELECT * FROM mutasisiswa AS t1
					INNER JOIN
					(
					SELECT MAX(modified_date) AS maxDate
					FROM mutasisiswa
					GROUP BY idsiswa
					) AS t2  ON t1.modified_date = t2.maxDate 
					GROUP BY t1.idsiswa) ms  ON ms.idsiswa=s.replid 
						LEFT JOIN jenismutasi jm ON jm.replid=ms.jenismutasi 
						WHERE s.idkelas = k.replid  ".$cari."
						ORDER BY s.nama ";
			 //echo $sql;die;
			$data['show_table']=$this->dbx->data($sql);

			
			$data['iddepartemen_opt'] = $this->dbx->opt("SELECT departemen as replid,departemen as nama FROM departemen WHERE aktif=1 AND replid IN (".$this->session->userdata('dept').") ORDER BY urutan",'up');
			$data['idtahunajaran_opt'] = $this->dbx->opt("SELECT replid,CONCAT('[',departemen,'] ',tahunajaran) as nama FROM tahunajaran WHERE idcompany='".$this->input->post('idcompany')."' AND departemen='".$this->input->post('iddepartemen')."' ORDER BY aktif DESC ,nama DESC ",'up');
			$data['idtingkat_opt'] = $this->dbx->opt("SELECT replid,tingkat as nama FROM tingkat
																								WHERE aktif=1 AND departemen='".$this->input->post('iddepartemen')."' ORDER BY CAST(tingkat AS SIGNED) ASC",'up');
			$data['idkelas_opt'] = $this->dbx->opt("SELECT k.replid,k.kelas as nama FROM kelas k
																									INNER JOIN tingkat t ON k.idtingkat=t.replid
																									WHERE k.aktif=1 AND t.departemen='".$this->input->post('iddepartemen')."'
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

		//TAMBAH
	 public function tambah_db($id='',$data) {
			 $sql="SELECT ms.*,s.nama,s.nis,k.kelas as kelastext, ta.tahunajaran as tahunajarantext, ta.idcompany
					 FROM siswa s
           LEFT JOIN kelas k ON k.replid=s.idkelas
           LEFT JOIN tahunajaran ta ON ta.replid=k.idtahunajaran
           LEFT JOIN mutasisiswa ms ON ms.nis=s.nis
					 WHERE s.replid='".$id."'";
			 $data['isi'] = $this->dbx->rows($sql);

       	$data['jenismutasi_opt'] = $this->dbx->opt("SELECT replid as replid,jenismutasi as nama FROM jenismutasi WHERE aktif=1 ORDER BY jenismutasi");
		$sqlcompany="SELECT replid,nama as nama FROM hrm_company
		   			WHERE aktif=1 AND ppdb=1 AND replid<>'".$data['isi']->idcompany."'
		   			ORDER BY nama";
		$data['idcompany_opt'] = $this->dbx->opt($sqlcompany,'up');
			 return $data;
 }
}

?>
