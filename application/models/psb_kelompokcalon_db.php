<?php

Class psb_kelompokcalon_db extends CI_Model {
	public function __construct() {
		parent::__construct();
		$this->load->library('dbx');
	}

    // Read data from database to show data in admin page
    public function data() {
				$cari="";

			//if ($this->input->post('idproses')<>""){
				$cari=$cari." WHERE pps.departemen='".$this->input->post('iddepartemen')."' ";
				
			//}
			if ($this->input->post('idproses')<>""){
				$cari=$cari." AND kcs.idproses='".$this->input->post('idproses')."' ";
			}

			if ($this->input->post('kelompok_siswa')<>""){
				$cari=$cari." AND kcs.kelompok_siswa='".$this->input->post('kelompok_siswa')."' ";
			}

      	$sql = "SELECT kcs.*,ks.kelompok as kelompoksiswatext,pps.proses as prosestext,pps.departemen
										,(SELECT COUNT(*) FROM calonsiswa WHERE idkelompok=kcs.replid AND aktif = 1) as jumlah
									FROM kelompokcalonsiswa kcs
									LEFT JOIN kelompoksiswa ks  ON kcs.kelompok_siswa=ks.replid
									LEFT JOIN prosespenerimaansiswa pps ON kcs.idproses=pps.replid
									".$cari."
									ORDER BY pps.departemen,kcs.kelompok";
				//echo $sql;
				$data['show_table']=$this->dbx->data($sql);
				$data['kelompok_siswa_opt'] = $this->dbx->opt("SELECT replid,CONCAT('[',departemen,'] ',kelompok) as nama FROM kelompoksiswa ks WHERE ks.departemen='".$this->input->post('iddepartemen')."' AND ks.aktif=1 ORDER BY ks.departemen,ks.kelompok",'up');
				$data['iddepartemen_opt'] = $this->dbx->opt("SELECT departemen as replid,departemen as nama FROM departemen WHERE aktif=1 AND replid IN (".$this->session->userdata('dept').") ORDER BY urutan",'up');
				$data['idproses_opt'] = $this->dbx->opt("SELECT replid,proses as nama FROM prosespenerimaansiswa WHERE departemen='".$this->input->post('iddepartemen')."' ORDER BY departemen",'up');
				return $data;
		}

     //TAMBAH
    public function tambah_db($id='',$data) {
    	$data['id']=$id;
      	$sql="SELECT kcs.*,pps.departemen
      			FROM kelompokcalonsiswa kcs
						LEFT JOIN prosespenerimaansiswa pps ON kcs.idproses=pps.replid
      			WHERE kcs.replid='".$id."'";
        $data['isi'] = $this->dbx->rows($sql);

        if ($data['isi']== NULL ) {
        	unset($data['isi']);
        	$sql="SELECT ".$this->dbx->tablecolumn('kelompokcalonsiswa').",NULL as departemen,1 as aktif";
        	$data['isi']=$this->dbx->rows($sql);
        }
        $data['iddepartemen_opt'] = $this->dbx->opt("SELECT departemen as replid, departemen as nama FROM departemen WHERE aktif=1 AND departemen IN (".$this->dbx->sessionjenjangtext().") ORDER BY urutan",'up');
				$data['idproses_opt'] = $this->dbx->opt("SELECT replid, proses as nama FROM prosespenerimaansiswa WHERE departemen='".$data['isi']->departemen."' ORDER BY proses",'up');
				$data['kelompok_siswa_opt'] = $this->dbx->opt("SELECT replid, kelompok as nama FROM kelompoksiswa WHERE departemen='".$data['isi']->departemen."' ORDER BY kelompok",'up');
        return $data;
  }
}

?>
