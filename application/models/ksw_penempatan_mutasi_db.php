<?php

Class ksw_penempatan_mutasi_db extends CI_Model {
	public function __construct() {
		parent::__construct();
		$this->load->library('dbx');
	}

    // Read data from database to show data in admin page
    public function data() {
			$cari="";
			$cari=$cari." AND ta.departemen='".$this->input->post('iddepartemen')."' ";
			if ($this->input->post('idtahunajaran')<>""){
				//$cari=$cari." AND ta.replid='".$this->input->post('idtahunajaran')."' ";
			}

			if ($this->input->post('nama')<>""){
				//$cari=$cari." s.nama like '%".$this->session->userdata('nama')."%' ";
				$cari=$cari." AND ".$this->input->post('jeniscari')." like '%".$this->input->post('nama')."%' ";

			}
				//AND t.replid='$tahunajaran'
				//AND tkt.replid='$tingkat'
				//AND t.departemen='$departemen'

			$sql = "SELECT s.*,DAY(s.tgllahir),MONTH(s.tgllahir)
								,YEAR(s.tgllahir)
								,s.replidcalon
								,(DATEDIFF (current_date(),s.tgl_masuk)) as jml_hari
								,akt.angkatan,r.region,s.remedialperilaku,k.kelas,ta.tahunajaran
								,ta.departemen, com.nama as companytext 
								,s2.nis as nisbaru 
								FROM siswa s
								INNER JOIN (SELECT * FROM mutasisiswa AS t1
											INNER JOIN
											(
											SELECT MAX(modified_date) AS maxDate
											FROM mutasisiswa
											GROUP BY idsiswa
											) AS t2  ON t1.modified_date = t2.maxDate 
											GROUP BY t1.idsiswa) ms  ON ms.idsiswa=s.replid 
								INNER JOIN kelas k ON s.idkelas = k.replid
								INNER JOIN tahunajaran ta ON ta.replid = k.idtahunajaran
								INNER JOIN hrm_company com ON com.replid=ta.idcompany 
								LEFT JOIN angkatan akt ON akt.replid=s.idangkatan
								LEFT JOIN regional r ON r.replid=s.region
								LEFT JOIN siswa s2 ON s2.replid=s.replidmutasi 
								WHERE ms.idcompany='".$this->input->post('idcompany')."' ".$cari."
								ORDER BY s.nama ";
			//echo $sql;
			$data['show_table']=$this->dbx->data($sql);
			
			$data['iddepartemen_opt'] = $this->dbx->opt("SELECT departemen as replid,departemen as nama FROM departemen WHERE aktif=1 AND replid IN (".$this->session->userdata('dept').") ORDER BY urutan",'up');
			$data['jeniscari_opt'] = array("s.nama"=>"Nama Siswa","s.nis"=>"NIS","s.namaayah"=>"Nama Ayah Siswa","s.namaibu"=>"Nama Ibu Siswa","s.wali"=>"Nama Wali Siswa");
			$data['idtahunajaran_opt'] = $this->dbx->opt("SELECT replid,CONCAT('[',departemen,'] ',tahunajaran) as nama FROM tahunajaran WHERE idcompany='".$this->input->post('idcompany')."' AND departemen='".$this->input->post('iddepartemen')."' ORDER BY aktif DESC ,nama DESC ",'up');
			$companyrow=$this->session->userdata('idcompany');
			$sqlcompany="SELECT replid,nama as nama
									FROM hrm_company
									WHERE replid IN (".$companyrow.") AND aktif=1
									ORDER BY nama";
			$data['idcompany_opt'] = $this->dbx->opt($sqlcompany,'up');
			return $data;
    }
	 //TAMBAH
	 public function tambah_db($idsiswa,$data) {
    	$sql="SELECT s.*, ms.idcompany,k.idtahunajaran,ta.departemen as iddepartemen,ms.tglmutasi,k.idtingkat ,'' as tanggal_masuk,'' as calon_kelas, k.kelas as kelassebelemnyatext
				,CONCAT(com2.kodecabang,d.urutan) as kodecabang,lpad(right(t.tingkat,4),2,'0') as tingkattext
				
      			FROM siswa s
				  INNER JOIN (SELECT * FROM mutasisiswa AS t1
					INNER JOIN
					(
					SELECT MAX(modified_date) AS maxDate
					FROM mutasisiswa
					GROUP BY idsiswa
					) AS t2  ON t1.modified_date = t2.maxDate 
					GROUP BY t1.idsiswa) ms  ON ms.idsiswa=s.replid 
				INNER JOIN kelas k ON s.idkelas = k.replid
				INNER JOIN  tingkat t ON t.replid=k.idtingkat
				INNER JOIN tahunajaran ta ON ta.replid = k.idtahunajaran
				INNER JOIN departemen d ON d.departemen=ta.departemen
				INNER JOIN hrm_company com ON com.replid=ta.idcompany 
				INNER JOIN hrm_company com2 ON com2.replid=ms.idcompany 
      			WHERE s.replid='".$idsiswa."'";
		//echo $sql;
        $data['isi'] = $this->dbx->rows($sql);

		$sqlta="SELECT replid,CONCAT('[',departemen,'] ',tahunajaran) as nama FROM tahunajaran WHERE idcompany='".$data['isi']->idcompany."' AND departemen='".$data['isi']->iddepartemen."' AND aktif=1 AND aktifdaftar=1 ORDER BY nama DESC";
		//echo $sqlta;
		$data['idtahunajaran_opt'] = $this->dbx->opt($sqlta,'up');
		//k.idtahunajaran='".$data['isi']->idtahunajaran."' AND 
		$sqlkelas="SELECT k.replid, CONCAT(ta.tahunajaran,' | ', k.kelas,' [Kuota: ',k.kapasitas,', Terisi: ',(SELECT COUNT(*) FROM siswa WHERE idkelas=k.replid AND aktif=1),']') as nama
					FROM kelas k
					LEFT JOIN tahunajaran ta ON ta.replid=k.idtahunajaran
					WHERE k.idtahunajaran<1 AND k.idtingkat='".$data['isi']->idtingkat."'
					AND k.kapasitas<>(SELECT COUNT(*) FROM siswa WHERE idkelas=k.replid AND aktif=1)
					ORDER BY ta.tahunajaran,k.kelas";
				//echo $sqlkelas;die;
		 $data['idkelas_opt'] = $this->dbx->opt($sqlkelas,'none');
				return $data;
  }
}

?>
