<?php

Class keu_administrasi_calon_db extends CI_Model {
	public function __construct() {
		parent::__construct();
		$this->load->library('dbx');
	}

    // Read data from database to show data in admin page
    public function data($data) {
			$cari="";$cari2="";

			if (($this->input->post('periode1')<>"") AND ($this->input->post('periode2')=="")){
				$cari2=$cari2." AND c.tanggal_daftar >= '".$this->p_c->tgl_db($this->input->post('periode1'))."' ";
			}
			if (($this->input->post('periode1')=="") AND ($this->input->post('periode2')<>"")){
				$cari2=$cari2." AND c.tanggal_daftar <= '".$this->p_c->tgl_db($this->input->post('periode2'))."' ";
			}
			if (($this->input->post('periode1')<>"") AND ($this->input->post('periode2')<>"")){
				$cari2=$cari2." AND c.tanggal_daftar BETWEEN '".$this->p_c->tgl_db($this->input->post('periode1'))."' AND '".$this->p_c->tgl_db($this->input->post('periode2'))."' ";
			}
			if ($this->input->post('nama')<>""){
				$cari2=$cari2." AND c.nama like '%".$this->input->post('nama')."%' ";
			}
			
			if ($data['hanyapusat']<>2){
				$cari=$cari." AND k.kelompok_siswa='".$this->input->post('idprogramsiswa')."' ";
			}
			

			//if ($cari2==""){
				//$cari=$cari." AND MONTH(c.tanggal_daftar)=MONTH(CURRENT_DATE()) AND YEAR(c.tanggal_daftar)=YEAR(CURRENT_DATE()) ";
				if ($this->input->post('idkelompok')<>""){
					$cari=$cari." AND c.idkelompok='".$this->input->post('idprogram')."' ";
				}

				if ($this->input->post('idproses')<>""){
					$cari=$cari." AND c.idproses='".$this->input->post('idproses')."' ";
				}
				if ($this->input->post('idtahunajaran')<>""){
					$cari=$cari." AND c.idtahunajaran='".$this->input->post('idtahunajaran')."' ";
				}else{
					$cari=$cari." AND ta.departemen='".$this->input->post('iddepartemen')."' ";
					$cari=$cari." AND ta.aktifdaftar='1' ";
				}
			//}

			//if ($cari==""){
				

				//$cari=$cari." AND MONTH(c.tanggal_daftar)=MONTH(CURRENT_DATE()) AND YEAR(c.tanggal_daftar)=YEAR(CURRENT_DATE()) ";
			//}

			$cari=$cari." AND ta.idcompany='".$this->input->post('idcompany')."' ";
			//}

			$order=" ORDER BY c.nama ";

			
			$sql = "SELECT c.*,p.proses,k.kelompok,t.tingkat,r.region,ks.kondisi as kondisi_nm,CURRENT_DATE() as hariini
								FROM calonsiswa c
								INNER JOIN online_kronologis ok ON ok.idcalon=c.replid
								LEFT JOIN tahunajaran ta ON ta.replid=c.idtahunajaran
								LEFT OUTER JOIN prosespenerimaansiswa p ON c.idproses = p.replid
								LEFT OUTER JOIN kelompokcalonsiswa k ON k.idproses = p.replid AND c.idkelompok = k.replid
								LEFT OUTER JOIN tingkat t ON c.tingkat=t.replid
								LEFT OUTER JOIN kondisisiswa ks ON ks.replid=c.kondisi
								LEFT OUTER JOIN regional r ON r.replid=c.region
								WHERE c.replid IS NOT NULL ".$cari." ".$cari2." ".$order;
			  //echo $sql;die;
				$data['show_table']=$this->dbx->data($sql);

			$data['iddepartemen_opt'] = $this->dbx->opt("SELECT departemen as replid,departemen as nama FROM departemen WHERE aktif=1 AND replid IN (".$this->session->userdata('dept').") ORDER BY urutan",'up');
			//$data['tahunmasuk_opt'] = $this->dbx->opt("SELECT DISTINCT tahunmasuk as replid,tahunmasuk as nama FROM calonsiswa ORDER BY tahunmasuk DESC",'up');
			$data['idproses_opt'] = $this->dbx->opt("SELECT replid,proses as nama FROM prosespenerimaansiswa WHERE departemen='".$this->input->post('iddepartemen')."' ORDER BY aktif DESC","up");
			
			//$data['idprogram_opt'] = $this->dbx->opt("SELECT replid,kelompok as nama FROM kelompokcalonsiswa WHERE idproses='".$this->input->post('idproses')."' AND aktif=1 ORDER BY kelompok DESC","up");

			$data['idprogramsiswa_opt'] = $this->dbx->opt("SELECT replid,kelompok as nama FROM kelompoksiswa WHERE departemen='".$this->input->post('iddepartemen')."' AND aktif=1 AND hanyapusat='".$data['hanyapusat']."' ORDER BY kelompok DESC","up");
			$data['idtahunajaran_opt'] = $this->dbx->opt("SELECT replid,CONCAT('[',departemen,'] ',tahunajaran) as nama FROM tahunajaran WHERE idcompany='".$this->input->post('idcompany')."' AND departemen='".$this->input->post('iddepartemen')."' ORDER BY aktif DESC ,nama DESC ",'up');
			$companyrow="";
			if ($data['hanyapusat']<>1){
				$companyrow=" AND replid IN (".$this->session->userdata('idcompany').")";
			}
			$sqlcompany="SELECT replid,nama as nama
									FROM hrm_company
									WHERE aktif=1 ".$companyrow."
									ORDER BY nama";
			$data['idcompany_opt'] = $this->dbx->opt($sqlcompany,'up');
			return $data;
    }
}

?>
