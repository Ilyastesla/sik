<?php

Class psb_kelulusan_db extends CI_Model {
	public function __construct() {
		parent::__construct();
		$this->load->library('dbx');
	}

    // Read data from database to show data in admin page
    public function data() {
				$cari="";

			if ($this->input->post('filter')<>""){
        if ($this->input->post('nama')<>""){
          $cari=$cari." AND c.nama LIKE '%".$this->input->post('nama')."%'";
        }

        if (($this->input->post('periode1')<>"") AND ($this->input->post('periode2')=="")){
					$cari=" AND c.tanggal_daftar >= '".$this->p_c->tgl_db($this->input->post('periode1'))."' ";
				}
				if (($this->input->post('periode1')=="") AND ($this->input->post('periode2')<>"")){
					$cari=" AND c.tanggal_daftar <= '".$this->p_c->tgl_db($this->input->post('periode2'))."' ";
				}
				if (($this->input->post('periode1')<>"") AND ($this->input->post('periode2')<>"")){
					$cari=" AND c.tanggal_daftar BETWEEN '".$this->p_c->tgl_db($this->input->post('periode1'))."' AND '".$this->p_c->tgl_db($this->input->post('periode2'))."' ";
				}
				if (($this->input->post('periode1')=="") AND ($this->input->post('periode2')=="")){
					//$cari=$cari." AND keg.aktif=1 ";
				}

      }else{
				//AND MONTH(CURRENT_DATE())=MONTH(c.tanggal_daftar)
        // $cari=$cari." AND (keg.aktif=1 OR (YEAR(CURRENT_DATE())=YEAR(c.tanggal_daftar) )) ";
      }
      	$sql = "SELECT c.*,kcs.kelompok as kelompokcalontext,pps.proses as prosestext,pps.departemen
                          ,t.tingkat as tingkattext, kls.kelas as kelastext,ks.kondisi as kondisitext
                          ,kcs.lamaproses,DATEDIFF(CURRENT_DATE(),c.tanggal_daftar) as lama
                      FROM calonsiswa c
                			LEFT JOIN  prosespenerimaansiswa pps ON c.idproses = pps.replid
                			LEFT JOIN  kelompokcalonsiswa kcs ON kcs.idproses = pps.replid AND c.idkelompok = kcs.replid
                			LEFT JOIN  tingkat t ON c.tingkat=t.replid
                			LEFT JOIN  kondisisiswa ks ON ks.replid=c.kondisi
                			LEFT JOIN  kelas kls ON c.calon_kelas = kls.replid
                			LEFT JOIN  tahunajaran ta ON kls.idtahunajaran = ta.replid
                      WHERE c.aktif=1 AND (c.replidsiswa is NULL OR c.replidsiswa='')
											".$cari."
											ORDER BY tanggal_daftar ASC";
				$data['show_table']=$this->dbx->data($sql);
				//die;
				return $data;
		}

     //TAMBAH
    public function tambah_db($data,$idcalon) {
			$data["rowsiswa"]=$this->dbx->rows("SELECT * FROM calonsiswa WHERE replid='".$idcalon."'");
			$sql="SELECT *
					FROM siswa_pernyataan
					WHERE siswa_id='".$idcalon."'";
			$data['isi'] = $this->dbx->rows($sql);

			if ($data['isi']== NULL ) {
				unset($data['isi']);
				$sql="SELECT ".$this->dbx->tablecolumn('siswa_pernyataan').",CURRENT_DATE() as tanggal";
				//echo $sql;die;
				$data['isi']=$this->dbx->rows($sql);
			}

			$sqlkelas="SELECT k.replid,k.kelas as nama
									FROM kelas k
									INNER JOIN tahunajaran ta ON ta.replid=k.idtahunajaran
									WHERE ta.aktif AND k.aktif=1 AND k.idtingkat='".$data['rowsiswa']->tingkat."'  ORDER BY k.kelas";
			$data['kelas_id_opt'] = $this->dbx->opt($sqlkelas,'up');
			return $data;
  }
}

?>
