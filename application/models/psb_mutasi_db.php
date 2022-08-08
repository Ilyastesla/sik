<?php

Class psb_mutasi_db extends CI_Model {
	public function __construct() {
		parent::__construct();
		$this->load->library('dbx');
	}

    // Read data from database to show data in admin page
    public function data() {
		$cari="";
		$cari=$cari." AND ".$this->input->post('jeniscari')." like '%".$this->input->post('nama')."%' ";
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
      	$sql="SELECT cs.*,pps.departemen,ta.idcompany as idunitbisnis,c.nama as unitbisnistext
      			FROM calonsiswa cs
						LEFT JOIN tahunajaran ta ON ta.replid=cs.idtahunajaran
						INNER JOIN prosespenerimaansiswa pps ON cs.idproses=pps.replid
						INNER JOIN hrm_company c ON c.replid=ta.idcompany
      			WHERE cs.replid='".$id."'";
        $data['isi'] = $this->dbx->rows($sql);

        if ($data['isi']== NULL ) {
        	unset($data['isi']);
        	$sql="SELECT ".$this->dbx->tablecolumn('kelompokcalonsiswa').",NULL as departemen,1 as aktif";
        	$data['isi']=$this->dbx->rows($sql);
        }
				$data['idunitbisnis_opt']=$this->dbx->opt("SELECT replid, nama FROM hrm_company WHERE ppdb=1 AND replid<>'".$data['isi']->idunitbisnis."'ORDER BY nama",'up');
				$data['iddepartemen_opt'] = $this->dbx->opt("SELECT departemen as replid, departemen as nama FROM departemen WHERE aktif=1 AND replid='-1' ORDER BY urutan",'up');
				$data['idtahunajaran_opt'] = $this->dbx->opt("SELECT replid,CONCAT('[',departemen,'] ',tahunajaran) as nama FROM tahunajaran WHERE idcompany='-1' ORDER BY tahunajaran",'up');
				$data['idproses_opt'] = $this->dbx->opt("SELECT replid,CONCAT('[',departemen,'] ',proses)  as nama FROM prosespenerimaansiswa WHERE departemen='-1' ORDER BY info1",'up');
				$data['idkelompok_opt'] = $this->dbx->opt("SELECT replid,kelompok as nama FROM kelompokcalonsiswa WHERE aktif=1 AND idproses='-1' ORDER BY kelompok",'up');
				$data['tingkat_opt'] = $this->dbx->opt("SELECT replid,CONCAT('[',departemen,'] ',tingkat)  as nama  FROM tingkat WHERE aktif=1 AND departemen='-1' ORDER BY CAST(tingkat AS SIGNED)",'up');
				$data['region_opt'] = $this->dbx->opt("SELECT replid,region as nama FROM regional ORDER BY region",'up');
				$data['kondisi_opt'] = $this->dbx->opt("SELECT replid,kondisi as nama FROM kondisisiswa ORDER BY kondisi",'up');
				$data['idalasan_opt'] = $this->dbx->opt("SELECT replid,nama as nama FROM siswa_reff WHERE aktif=1 AND type='aktivasicpd' ORDER BY nama",'up');
				$data['idjurusan_opt'] = $this->dbx->opt("SELECT replid,jurusan as nama FROM jurusan WHERE departemen='-1' ORDER BY jurusan",'up');

        return $data;
  }
}

?>
