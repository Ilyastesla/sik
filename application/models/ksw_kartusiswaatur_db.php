<?php

Class ksw_kartusiswaatur_db extends CI_Model {
	public function __construct() {
		parent::__construct();
		$this->load->library('dbx');
	}

    // Read data from database to show data in admin page
    public function data() {
			$cari="";

			//if ($this->input->post('iddepartemen')<>""){
				$cari=$cari." AND tox.departemen='".$this->input->post('iddepartemen')."' ";
			//}
				$sql = "SELECT *
								FROM tryout tox
								WHERE tox.departemen IN (".$this->dbx->sessionjenjangtext().") ".$cari."
								ORDER BY tox.departemen ASC";
				//echo $sql;die;
				$data['show_table']=$this->dbx->data($sql);

			//die;
			$data['iddepartemen_opt'] = $this->dbx->opt("SELECT departemen as replid,departemen as nama FROM departemen WHERE aktif=1 AND replid IN (".$this->session->userdata('dept').") ORDER BY urutan",'up');
			return $data;
    }

     //TAMBAH
    public function tambah_db($id='',$data) {
      	$sql="SELECT *
      			FROM tryout tox
      			WHERE tox.replid='".$id."'";
        $data['isi'] = $this->dbx->rows($sql);

        if ($data['isi']== NULL ) {
					unset($data['isi']);
					$sql="SELECT ".$this->dbx->tablecolumn('tryout').",null as iddepartemen,1 as aktif ";
        	$data['isi']=$this->dbx->rows($sql);
        }

				$data['departemen_opt'] = $this->dbx->opt("SELECT departemen as replid,departemen as nama FROM departemen WHERE aktif=1 AND replid IN (".$this->session->userdata('dept').") ORDER BY urutan",'up');
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
