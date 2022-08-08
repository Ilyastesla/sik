<?php

Class psb_skl_db extends CI_Model {
	public function __construct() {
		parent::__construct();
		$this->load->library('dbx');
	}

    // Read data from database to show data in admin page
    public function data() {
		$cari="";$cari2="";

		switch ($this->input->post('status')) {
			case 'selesai':
				$cari2=$cari2." AND c.replidsiswa IS NOT NULL ";
				break;
			case 'revkelas':
				$cari2=$cari2." AND c.calon_kelas IS NOT NULL AND c.replidsiswa IS NULL ";
				break;
			case 'setkelas':
				$cari2=$cari2." AND c.calon_kelas IS NULL ";
				break;
			default:
				$cari2=$cari2." AND c.replidsiswa IS NULL ";
				break;
		}
		
		if ($this->input->post('nama')<>""){
			$cari=$cari." AND ".$this->input->post('jeniscari')." like '%".$this->input->post('nama')."%' ";
		}

		

		if ($this->input->post('idtahunajaran')<>""){
			//AND c.tahunmasuk='".$this->input->post('tahunmasuk')."'
			$cari=$cari." AND c.idtahunajaran='".$this->input->post('idtahunajaran')."'";
			
			if ($this->input->post('idproses')<>""){
				$cari=$cari." AND c.idproses='".$this->input->post('idproses')."'";
			}

			if ($this->input->post('idkelompok')<>""){
				$cari=$cari." AND c.idkelompok='".$this->input->post('idkelompok')."'";
			}
			
		}
		
		if ($this->input->post('departemen')<>""){
			$cari=$cari." AND ta2.departemen='".$this->input->post('departemen')."' ";
		}
		
		if($cari==""){
			$cari=" AND pps.departemen IN (
					SELECT departemen FROM departemen 
					WHERE aktif=1 AND replid IN (".$this->session->userdata('dept').")
					) 
					AND c.aktif=1 AND ta2.aktifdaftar=1 AND (c.replidsiswa is null OR c.replidsiswa<1) ";
	
		}
		

		$cari=$cari." AND ta2.idcompany='".$this->input->post('idcompany')."' ";
		

      	$sql = "SELECT c.*,kcs.kelompok as kelompokcalontext,pps.proses as prosestext,pps.departemen
                          ,t.tingkat as tingkattext, CONCAT(ta.tahunajaran,' | ', kls.kelas) as kelastext,ks.kondisi as kondisitext
                          ,kcs.lamaproses,DATEDIFF(CURRENT_DATE(),c.tanggal_daftar) as lama
						,kps.kelompok as kelompoksiswatext,kps.syarat_interview,kps.syarat_asesmen,kps.syarat_placementtest,kps.replid as idkelompoksiswa
                FROM calonsiswa c
				INNER JOIN online_kronologis ok ON ok.idcalon=c.replid
				LEFT JOIN  prosespenerimaansiswa pps ON c.idproses = pps.replid
                LEFT JOIN  kelompokcalonsiswa kcs ON kcs.idproses = pps.replid AND c.idkelompok = kcs.replid
				LEFT JOIN  kelompoksiswa kps ON kps.replid=kcs.kelompok_siswa
				LEFT JOIN  tingkat t ON c.tingkat=t.replid
				LEFT JOIN  kondisisiswa ks ON ks.replid=c.kondisi
				LEFT JOIN  kelas kls ON c.calon_kelas = kls.replid
				LEFT JOIN tahunajaran ta ON kls.idtahunajaran = ta.replid
				LEFT JOIN tahunajaran ta2 ON c.idtahunajaran = ta2.replid
				WHERE c.replid is not null "
					.$cari.$cari2
				."ORDER BY tanggal_daftar ";
		//echo $sql;die;
		$data['show_table']=$this->dbx->data($sql);
		$data['iddepartemen_opt'] = $this->dbx->opt("SELECT departemen as replid,departemen as nama FROM departemen WHERE aktif=1 AND replid IN (".$this->session->userdata('dept').") ORDER BY urutan",'up');
//$data['tahunmasuk_opt'] = $this->dbx->opt("SELECT DISTINCT tahunmasuk as replid, tahunmasuk as nama FROM calonsiswa ORDER BY tahunmasuk DESC",'up');
		$data['idtahunajaran_opt'] = $this->dbx->opt("SELECT replid, tahunajaran as nama FROM tahunajaran WHERE idcompany='".$this->input->post('idcompany')."' AND departemen='".$this->input->post('iddepartemen')."' ORDER BY tahunajaran DESC",'up');
		$data['idproses_opt'] = $this->dbx->opt("SELECT replid,proses as nama FROM prosespenerimaansiswa WHERE departemen='".$this->input->post('iddepartemen')."' ORDER BY info1",'up');
		$data['idkelompok_opt'] = $this->dbx->opt("SELECT replid,kelompok as nama FROM kelompokcalonsiswa WHERE aktif=1 AND idproses='".$this->input->post('idproses')."' ORDER BY kelompok",'up');
		$data['jeniscari_opt'] = array("ok.namacalon"=>"Nama CPD","ok.nopendaftaran"=>"No. PPDB");
		$data['status_opt'] = array(""=>"Pilih..","setkelas"=>"Set Kelas","revkelas"=>"Revisi Kelas","selesai"=>"Selesai");
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
      	$sql="SELECT *
      			FROM calonsiswa
      			WHERE replid='".$id."'";
        $data['isi'] = $this->dbx->rows($sql);

        if ($data['isi']== NULL ) {
        	unset($data['isi']);
        	$sql="SELECT ".$this->dbx->tablecolumn('calonsiswa').",'".$id."' as replid ";
        	$data['isi']=$this->dbx->rows($sql);
        }

		$sqlkelas="SELECT k.replid, CONCAT(ta.tahunajaran,' | ', k.kelas,' [Kuota: ',k.kapasitas,', Terisi: ',(SELECT COUNT(*) FROM siswa WHERE idkelas=k.replid AND aktif=1),']') as nama
					FROM kelas k
					LEFT JOIN tahunajaran ta ON ta.replid=k.idtahunajaran
					WHERE k.idtahunajaran='".$data['isi']->idtahunajaran."' AND k.idtingkat='".$data['isi']->tingkat."'
								AND k.kapasitas<>(SELECT COUNT(*) FROM siswa WHERE idkelas=k.replid AND aktif=1)
					ORDER BY ta.tahunajaran,k.kelas";
				//echo $sqlkelas;die;
        $data['idkelas_opt'] = $this->dbx->opt($sqlkelas,'none');
				return $data;
  }
}

?>
