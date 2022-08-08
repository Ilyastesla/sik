<?php

Class psb_calonsiswarevisi_db extends CI_Model {
	public function __construct() {
		parent::__construct();
		$this->load->library('dbx');
	}

    // Read data from database to show data in admin page
    public function data() {
				$cari="";
			//	echo $this->session->flashdata('idproses');die;
			//if ($this->input->post('idproses')<>""){
			/*
			$cari=$cari." 	AND pps.departemen='".$this->input->post('iddepartemen')."'
													AND c.tahunmasuk='".$this->input->post('tahunmasuk')."'
													AND c.idproses='".$this->input->post('idproses')."'
													AND c.idkelompok='".$this->input->post('idkelompok')."' ";
		*/
		//}
			//}
			//if ($this->input->post('nama')<>""){
				//$cari=$cari." s.nama like '%".$this->session->userdata('nama')."%' ";
				$cari=$cari." AND ".$this->input->post('jeniscari')." like '%".$this->input->post('nama')."%' ";

			//}
		$cari=$cari." AND ta.idcompany='".$this->input->post('idcompany')."'";
      	$sql = "SELECT c.*,kcs.kelompok as kelompokcalontext,pps.proses as prosestext,pps.departemen
                          ,t.tingkat as tingkattext, kls.kelas as kelastext,ks.kondisi as kondisitext
                          ,kcs.lamaproses,DATEDIFF(CURRENT_DATE(),c.tanggal_daftar) as lama
													,r.region as regiontext
													,(SELECT COUNT(replid) FROM kegiatan WHERE siswa_id=c.replid) as jmlproses
													,j.jurusan as jurusantext
                      FROM calonsiswa c
							INNER JOIN online_kronologis ok ON ok.idcalon=c.replid
							INNER JOIN tahunajaran ta ON ta.replid=c.idtahunajaran 
                			LEFT JOIN prosespenerimaansiswa pps ON c.idproses = pps.replid
                			LEFT JOIN kelompokcalonsiswa kcs ON kcs.idproses = pps.replid AND c.idkelompok = kcs.replid
                			LEFT JOIN tingkat t ON c.tingkat=t.replid
                			LEFT JOIN kondisisiswa ks ON ks.replid=c.kondisi
                			LEFT JOIN kelas kls ON c.calon_kelas = kls.replid
											LEFT JOIN regional r ON r.replid=c.region
											LEFT JOIN jurusan j ON j.replid=c.jurusan
											WHERE c.replidsiswa is null
									".$cari."
									ORDER BY c.nama ";
				//echo $sql;die;
				if ($this->input->post('nama')<>""){
					$data['show_table']=$this->dbx->data($sql);
				}else{
					$data['show_table']=NULL;
				}
		$data['iddepartemen_opt'] = $this->dbx->opt("SELECT departemen as replid,departemen as nama FROM departemen WHERE aktif=1 AND replid IN (".$this->session->userdata('dept').") ORDER BY urutan",'up');
        $data['tahunmasuk_opt'] = $this->dbx->opt("SELECT DISTINCT tahunmasuk as replid, tahunmasuk as nama FROM calonsiswa ORDER BY tahunmasuk DESC",'up');
		$data['idproses_opt'] = $this->dbx->opt("SELECT replid,proses as nama FROM prosespenerimaansiswa WHERE departemen='".$this->input->post('iddepartemen')."' ORDER BY proses",'up');
        $data['idkelompok_opt'] = $this->dbx->opt("SELECT replid,kelompok as nama FROM kelompokcalonsiswa WHERE aktif=1 AND idproses='".$this->input->post('idproses')."' ORDER BY kelompok",'up');
		$data['jeniscari_opt'] = array("c.nama"=>"Nama CPD","c.namaayah"=>"Nama Ayah CPD","c.namaibu"=>"Nama Ibu CPD","c.wali"=>"Nama Wali CPD");
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
    	$data['id']=$id;
      	$sql="SELECT cs.*,pps.departemen,ta.idcompany
      			FROM calonsiswa cs
				LEFT JOIN tahunajaran ta ON ta.replid=cs.idtahunajaran
				LEFT JOIN prosespenerimaansiswa pps ON cs.idproses=pps.replid
      			WHERE cs.replid='".$id."'";
        $data['isi'] = $this->dbx->rows($sql);

        if ($data['isi']== NULL ) {
        	unset($data['isi']);
        	$sql="SELECT ".$this->dbx->tablecolumn('kelompokcalonsiswa').",NULL as departemen,1 as aktif";
        	$data['isi']=$this->dbx->rows($sql);
        }
				//$data['idunitbisnis_opt']=$this->dbx->opt("SELECT replid, nama FROM hrm_company WHERE ppdb=1 ORDER BY nama",'up');
				$data['iddepartemen_opt'] = $this->dbx->opt("SELECT departemen as replid, departemen as nama FROM departemen WHERE aktif=1 AND replid IN (".$this->session->userdata('dept').") ORDER BY urutan",'up');
				$data['idtahunajaran_opt'] = $this->dbx->opt("SELECT replid,CONCAT('[',departemen,'] ',tahunajaran) as nama FROM tahunajaran WHERE idcompany='".$data['isi']->idcompany."' AND departemen='".$data['isi']->departemen."' AND aktifdaftar=1 ORDER BY tahunajaran",'up');
				$data['idproses_opt'] = $this->dbx->opt("SELECT replid,CONCAT('[',departemen,'] ',proses)  as nama FROM prosespenerimaansiswa WHERE departemen='".$data['isi']->departemen."' ORDER BY info1",'up');
				$data['idkelompok_opt'] = $this->dbx->opt("SELECT replid,kelompok as nama FROM kelompokcalonsiswa WHERE aktif=1 AND idproses='".$data['isi']->idproses."' ORDER BY kelompok",'up');
				$data['tingkat_opt'] = $this->dbx->opt("SELECT replid,CONCAT('[',departemen,'] ',tingkat)  as nama  FROM tingkat WHERE aktif=1 AND departemen='".$data['isi']->departemen."' ORDER BY CAST(tingkat AS SIGNED)",'up');
				$data['region_opt'] = $this->dbx->opt("SELECT replid,region as nama FROM regional ORDER BY region",'up');
				$data['kondisi_opt'] = $this->dbx->opt("SELECT replid,kondisi as nama FROM kondisisiswa ORDER BY kondisi",'up');
				$data['idalasan_opt'] = $this->dbx->opt("SELECT replid,nama as nama FROM siswa_reff WHERE aktif=1 AND type='aktivasicpd' ORDER BY nama",'up');
				$data['idjurusan_opt'] = $this->dbx->opt("SELECT replid,jurusan as nama FROM jurusan WHERE departemen='".$data['isi']->departemen."' ORDER BY jurusan",'up');

        return $data;
  }

	public function view_db($replid,$data) {
		$sql = "SELECT c.*
										FROM calonsiswa c
								WHERE c.replid='".$replid."'
								ORDER BY c.nama ";
			$data['isi'] = $this->dbx->rows($sql);

			$sql="SELECT csr.*,kcs.kelompok as kelompokcalontext,pps.proses as prosestext,pps.departemen as departementext
												,t.tingkat as tingkattext,ks.kondisi as kondisitext
												,r.region as regiontext
					FROM calonsiswariwayat csr
					LEFT JOIN prosespenerimaansiswa pps ON csr.idproses = pps.replid
					LEFT JOIN kelompokcalonsiswa kcs ON kcs.idproses = pps.replid AND csr.idkelompok = kcs.replid
					LEFT JOIN tingkat t ON csr.tingkat=t.replid
					LEFT JOIN kondisisiswa ks ON ks.replid=csr.kondisi
					LEFT JOIN regional r ON r.replid=csr.region
					WHERE csr.idcalonsiswa='".$replid."'
					ORDER BY csr.modified_date DESC
					";
			//echo $sql;die;
			$data['calonhistory'] = $this->dbx->data($sql);

			return $data;
	}
}

?>
