<?php

Class psb_interviewcalon_db extends CI_Model {
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
						$cari=" AND keg.tgl_mulai >= '".$this->p_c->tgl_db($this->input->post('periode1'))."' ";
					}
					if (($this->input->post('periode1')=="") AND ($this->input->post('periode2')<>"")){
						$cari=" AND keg.tgl_mulai <= '".$this->p_c->tgl_db($this->input->post('periode2'))."' ";
					}
					if (($this->input->post('periode1')<>"") AND ($this->input->post('periode2')<>"")){
						$cari=" AND keg.tgl_mulai BETWEEN '".$this->p_c->tgl_db($this->input->post('periode1'))."' AND '".$this->p_c->tgl_db($this->input->post('periode2'))."' ";
					}

					if (($this->input->post('periode1')=="") AND ($this->input->post('periode2')=="")){
						//$cari=$cari." AND keg.aktif=1 ";
					}

		}else{
					//AND MONTH(CURRENT_DATE())=MONTH(keg.tgl_mulai)
			$cari=$cari." AND (keg.aktif=1 OR (YEAR(CURRENT_DATE())=YEAR(keg.tgl_mulai) )) ";
		}
		$cari=$cari." AND ta.idcompany='".$this->input->post('idcompany')."'";

      	$sql = "SELECT c.*,kcs.kelompok as kelompokcalontext,pps.proses as prosestext,pps.departemen
                          ,t.tingkat as tingkattext, kls.kelas as kelastext,ks.kondisi as kondisitext
                          ,kcs.lamaproses,DATEDIFF(CURRENT_DATE(),c.tanggal_daftar) as lama
													,keg.replid as replidkeg,keg.tgl_mulai, keg.aktif as kegaktif
				FROM calonsiswa c
				INNER JOIN tahunajaran ta ON c.idtahunajaran = ta.replid
				LEFT JOIN  prosespenerimaansiswa pps ON c.idproses = pps.replid
				LEFT JOIN  kelompokcalonsiswa kcs ON kcs.idproses = pps.replid AND c.idkelompok = kcs.replid
				LEFT JOIN  tingkat t ON c.tingkat=t.replid
				LEFT JOIN  kondisisiswa ks ON ks.replid=c.kondisi
				LEFT JOIN  kelas kls ON c.calon_kelas = kls.replid
				INNER JOIN kegiatan keg ON keg.siswa_id=c.replid
				WHERE c.aktif=1 AND keg.keg_id='9' AND keg.idpegawai='".$this->session->userdata('idpegawai')."'
							".$cari."
							ORDER BY keg.aktif DESC, c.nama ASC";
		//echo $sql;die;
		$data['show_table']=$this->dbx->data($sql);
//die;
		$companyrow=$this->session->userdata('idcompany');
		$sqlcompany="SELECT replid,nama as nama
								FROM hrm_company
								WHERE replid IN (".$companyrow.") AND aktif=1
								ORDER BY nama";
		$data['idcompany_opt'] = $this->dbx->opt($sqlcompany,'up');
		return $data;
		}

     //TAMBAH
    public function tambah_db($data,$idcalon,$replidkeg) {
				$sql="SELECT * FROM kegiatan WHERE replid='".$replidkeg."'";
				$data["rowkegiatan"]=$this->dbx->rows($sql);
				$data["rowsiswa"]=$this->dbx->getcalonsiswa($idcalon,1);

        $sql="SELECT *
									,(select description from siswa_konseling where k.replid=konseling_id and replidkeg='".$replidkeg."' ORDER BY created_date DESC limit 1) as description
							FROM konseling k ORDER BY k.urutan";
        $data['konseling'] = $this->dbx->data($sql);

				$sql="SELECT replid,kelompok as nama FROM kelompoksiswa WHERE aktif=1 AND departemen='".$data["rowsiswa"]->departemen."'";
				$data['kelompoksiswa_opt'] = $this->dbx->opt($sql);
				$data['kelompoksiswa_opt'] = $this->p_c->arraymerge($data['kelompoksiswa_opt'],array('0' => "Assessment"));
				//die;
				return $data;
  }
}

?>
