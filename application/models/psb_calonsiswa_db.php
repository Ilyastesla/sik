<?php

Class psb_calonsiswa_db extends CI_Model {
	public function __construct() {
		parent::__construct();
		$this->load->library('dbx');
	}

    // Read data from database to show data in admin page
    public function data() {
		$cari="";

		if (($this->input->post('periode1')<>"") AND ($this->input->post('periode2')=="")){
			$cari=$cari." AND ok.created_date >= '".$this->p_c->tgl_db($this->input->post('periode1'))."' ";
		}
		if (($this->input->post('periode1')=="") AND ($this->input->post('periode2')<>"")){
			$cari=$cari." AND ok.created_date <= '".$this->p_c->tgl_db($this->input->post('periode2'))."' ";
		}
		if (($this->input->post('periode1')<>"") AND ($this->input->post('periode2')<>"")){
			$cari=$cari." AND ok.created_date BETWEEN '".$this->p_c->tgl_db($this->input->post('periode1'))."' AND '".$this->p_c->tgl_db($this->input->post('periode2'))."' ";
		}

		if($cari==""){
			if ($this->input->post('idtahunajaran')==""){
				//$cari=$cari." AND YEAR(ok.created_date)=YEAR(CURRENT_DATE()) ";
				$cari=$cari."  AND ta.aktifdaftar=1 ";
			}
		}

		if ($this->input->post('iddepartemen')<>""){
				//AND c.tahunmasuk='".$this->input->post('tahunmasuk')."'
				$cari=$cari." AND pps.departemen='".$this->input->post('iddepartemen')."' ";
		}
		if ($this->input->post('idtahunajaran')<>""){
			$cari=$cari." AND ta.replid='".$this->input->post('idtahunajaran')."'";
		}

		if ($this->input->post('idjurusan')<>""){
			$cari=$cari." AND j.replid='".$this->input->post('idjurusan')."'";
		}

		if ($this->input->post('idproses')<>""){
			$cari=$cari." AND c.idproses='".$this->input->post('idproses')."'";
		}
		if ($this->input->post('idkelompok')<>""){
			$cari=$cari." AND c.idkelompok='".$this->input->post('idkelompok')."'";
		}

		if ($this->input->post('abk')<>""){
			$cari=$cari." AND c.abk='".$this->input->post('abk')."'";
		}

		if ($this->input->post('keu_up')<>""){
			$cari=$cari." AND c.keu_up='".$this->input->post('keu_up')."'";
		}

		if ($this->input->post('aktif')<>""){
			$cari=$cari." AND c.aktif='".$this->input->post('aktif')."'";
		}

		if ($this->input->post('lulus')<>""){
			$cari=$cari." AND c.lulus='".$this->input->post('lulus')."'";
		}

		if ($this->input->post('selesai')<>""){
			$cari=$cari." AND c.replidsiswa is not null ";
		}

		if ($this->input->post('dalamproses')<>""){
			$cari=$cari." AND c.replidsiswa is null ";
		}

		$cari=$cari." AND ta.idcompany='".$this->input->post('idcompany')."'";

      	$sql = "SELECT c.*
													,kcs.kelompok as kelompokcalontext,pps.proses as prosestext,pps.departemen
                        ,t.tingkat as tingkattext,ks.kondisi as kondisitext
                        ,kcs.lamaproses,DATEDIFF(CURRENT_DATE(),c.tanggal_daftar) as lama,s.nis
						,ok.replid as idkronologis,ok.namacalon,ok.created_by as tanggalposting
						,ta.tahunajaran as tahunajarantext,j.jurusan as jurusantext
						,k.kelas as calonkelastext	
                FROM calonsiswa c
				INNER JOIN online_kronologis ok ON ok.idcalon=c.replid
				LEFT JOIN  prosespenerimaansiswa pps ON c.idproses = pps.replid
                LEFT JOIN  kelompokcalonsiswa kcs ON kcs.idproses = pps.replid AND c.idkelompok = kcs.replid
                LEFT JOIN  tingkat t ON c.tingkat=t.replid
                LEFT JOIN  kondisisiswa ks ON ks.replid=c.kondisi
                LEFT JOIN tahunajaran ta ON ta.replid=c.idtahunajaran
				LEFT JOIN siswa s ON s.replid=c.replidsiswa
				LEFT JOIN jurusan j ON j.replid=c.jurusan
				LEFT JOIN kelas k ON k.replid=c.calon_kelas 
				WHERE c.replid is not null 
									".$cari."
									ORDER BY ok.created_date ";
				//echo $sql;
				//echo $sql;die;
		$data['show_table']=$this->dbx->data($sql);
		$data['iddepartemen_opt'] = $this->dbx->opt("SELECT departemen as replid,departemen as nama FROM departemen WHERE aktif=1 AND replid IN (".$this->session->userdata('dept').") ORDER BY urutan",'up');
		//$data['tahunmasuk_opt'] = $this->dbx->opt("SELECT DISTINCT tahunmasuk as replid, tahunmasuk as nama FROM calonsiswa ORDER BY tahunmasuk DESC",'up');
		$data['idtahunajaran_opt'] = $this->dbx->opt("SELECT replid, tahunajaran as nama FROM tahunajaran WHERE idcompany='".$this->input->post('idcompany')."' AND departemen='".$this->input->post('iddepartemen')."' ORDER BY tahunajaran DESC",'up');
		$data['idproses_opt'] = $this->dbx->opt("SELECT replid,proses as nama FROM prosespenerimaansiswa WHERE departemen='".$this->input->post('iddepartemen')."' ORDER BY proses",'up');
		$data['idjurusan_opt'] = $this->dbx->opt("SELECT replid,jurusan as nama FROM jurusan WHERE departemen='".$this->input->post('iddepartemen')."' ORDER BY jurusan",'up');
        $data['idkelompok_opt'] = $this->dbx->opt("SELECT replid,kelompok as nama FROM kelompokcalonsiswa WHERE aktif=1 AND idproses='".$this->input->post('idproses')."' ORDER BY kelompok",'up');
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
