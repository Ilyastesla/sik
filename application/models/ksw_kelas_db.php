<?php

Class ksw_kelas_db extends CI_Model {
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
			if ($this->input->post('kurikulumkode')<>""){
				$cari=$cari." AND k.kurikulumkode='".$this->input->post('kurikulumkode')."' ";
			}
				$sql = "SELECT k.*,t.tahunajaran,t.departemen,j.jurusan as jurusantext, CONCAT('[',ks.departemen,'] ',ks.kelompok) as kelompok_siswatext
											,(SELECT COUNT(*) FROM siswa s WHERE s.idkelas=k.replid AND s.aktif=1) as jmlsiswa
											,(SELECT COUNT(*) FROM siswa s WHERE s.idkelas=k.replid AND s.aktif=1 AND s.abk=1) as jmlsiswaabk
											,CONCAT(kr.kurikulumkode,' - ',kr.kurikulum) as kurikulumtext
								FROM kelas k
								LEFT JOIN tahunajaran t ON k.idtahunajaran=t.replid
								LEFT JOIN tingkat tkt ON tkt.replid=k.idtingkat
								LEFT JOIN jurusan j ON j.replid=k.jurusan
								LEFT JOIN kelompoksiswa ks ON ks.replid=k.kelompok_siswa
								LEFT JOIN ns_kurikulum kr ON kr.kurikulumkode=k.kurikulumkode
								WHERE t.departemen IN (".$this->dbx->sessionjenjangtext().") ".$cari."
								ORDER BY t.departemen ASC,t.tahunajaran DESC,CAST(tkt.tingkat AS SIGNED) ASC, k.kelas ASC";
				//echo $sql;die;
				$data['show_table']=$this->dbx->data($sql);

			//die;
			$data['iddepartemen_opt'] = $this->dbx->opt("SELECT departemen as replid,departemen as nama FROM departemen WHERE aktif=1 AND replid IN (".$this->session->userdata('dept').") ORDER BY urutan",'up');
			$data['idtahunajaran_opt'] = $this->dbx->opt("SELECT replid,CONCAT('[',departemen,'] ',tahunajaran) as nama FROM tahunajaran WHERE idcompany='".$this->input->post('idcompany')."' AND departemen='".$this->input->post('iddepartemen')."' ORDER BY aktif DESC ,nama DESC ",'up');
			$data['idtingkat_opt'] = $this->dbx->opt("SELECT replid,tingkat as nama FROM tingkat WHERE aktif=1 AND departemen='".$this->input->post('iddepartemen')."' ORDER BY CAST(tingkat AS SIGNED) ASC",'up');
			$data['kelompok_siswa_opt'] = $this->dbx->opt("SELECT replid,CONCAT('[',departemen,'] ',kelompok, ' (',kodekelompok,') ') as nama FROM kelompoksiswa ks WHERE ks.departemen='".$this->input->post('iddepartemen')."' AND ks.aktif=1 ORDER BY ks.departemen,ks.kelompok",'up');
			$data['kurikulumkode_opt'] = $this->dbx->opt("SELECT kurikulumkode as replid,CONCAT(kurikulumkode,' - ',kurikulum) as nama FROM ns_kurikulum WHERE aktif=1 ORDER BY kurikulumkode DESC",'up');
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
      	$sql="SELECT k.*,t.departemen as iddepartemen,t.idcompany
      			FROM kelas k
				LEFT JOIN tahunajaran t ON k.idtahunajaran=t.replid
      			WHERE k.replid='".$id."'";
        $data['isi'] = $this->dbx->rows($sql);
        if ($data['isi']== NULL ) {
					unset($data['isi']);
					$sql="SELECT ".$this->dbx->tablecolumn('kelas').",null as iddepartemen,1 as aktif,0 as idcompany";
        	$data['isi']=$this->dbx->rows($sql);
        }

		$data['iddepartemen_opt'] = $this->dbx->opt("SELECT departemen as replid,departemen as nama FROM departemen WHERE aktif=1 AND replid IN (".$this->session->userdata('dept').") ORDER BY urutan",'up');
		$data['idtahunajaran_opt'] = $this->dbx->opt("SELECT replid,CONCAT('[',departemen,'] ',tahunajaran) as nama FROM tahunajaran WHERE idcompany='".$data['isi']->idcompany."' AND departemen='".$data['isi']->iddepartemen."' ORDER BY aktif DESC ,nama DESC ",'up');
		$data['idtingkat_opt'] = $this->dbx->opt("SELECT replid,CONCAT('[',departemen,'] ',tingkat)  as nama FROM tingkat WHERE departemen='".$data['isi']->iddepartemen."' ORDER BY CAST(tingkat AS SIGNED) ASC",'up');
		$data['idwali_opt'] = $this->dbx->opt("SELECT replid,(CONCAT(nama,' [',nip,']')) as nama FROM pegawai WHERE aktif=1 ORDER BY nama ASC",'up');
		$data['kelompok_siswa_opt'] = $this->dbx->opt("SELECT replid,CONCAT('[',departemen,'] ',kelompok, ' (',kodekelompok,')') as nama FROM kelompoksiswa ks WHERE ks.departemen IN (".$this->dbx->sessionjenjangtext().") AND ks.aktif=1 ORDER BY ks.departemen,ks.kelompok",'none');
		$data['jurusan_opt'] = $this->dbx->opt("SELECT replid,jurusan as nama FROM jurusan WHERE aktif=1 AND departemen='".$data['isi']->iddepartemen."' ORDER BY jurusan",'up');
		$data['kurikulumkode_opt'] = $this->dbx->opt("SELECT kurikulumkode as replid,CONCAT(kurikulumkode,' - ',kurikulum) as nama FROM ns_kurikulum WHERE aktif=1 ORDER BY kurikulumkode DESC",'up');
		$companyrow=$this->session->userdata('idcompany');
		$sqlcompany="SELECT replid,nama as nama
								FROM hrm_company
								WHERE replid IN (".$companyrow.") AND aktif=1
								ORDER BY nama";
		$data['idcompany_opt'] = $this->dbx->opt($sqlcompany,'up');
        return $data;
  }

	public function view_db($replid,$data){
		$sql = "SELECT t.tahunajaran as tahunajarantext, k.*,t.tahunajaran,t.departemen,j.jurusan as jurusantext, CONCAT('[',ks.departemen,'] ',ks.kelompok) as kelompok_siswatext
									,(SELECT COUNT(*) FROM siswa s WHERE s.idkelas=k.replid AND s.aktif=1) as jmlsiswa
									,tkt.tingkat as tingkattext
						FROM kelas k
						LEFT JOIN tahunajaran t ON k.idtahunajaran=t.replid
						LEFT JOIN tingkat tkt ON tkt.replid=k.idtingkat
						LEFT JOIN jurusan j ON j.replid=k.jurusan
						LEFT JOIN kelompoksiswa ks ON ks.replid=k.kelompok_siswa
						WHERE k.replid='".$replid."'
						ORDER BY t.departemen ASC,t.tahunajaran DESC,CAST(tkt.tingkat AS SIGNED) ASC, k.kelas ASC";
		//echo $sql;die;
		$data['isi']=$this->dbx->rows($sql);

		$sql="SELECT * FROM siswa WHERE idkelas='".$replid."' ORDER BY nama";
		$data['datasiswa']=$this->dbx->data($sql);
		return $data;
	}
}

?>
