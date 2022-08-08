<?php

Class ksw_kelompok_db extends CI_Model {
	public function __construct() {
		parent::__construct();
		$this->load->library('dbx');
	}

    // Read data from database to show data in admin page
    public function data() {
				$cari="";

				//if ($this->input->post('iddepartemen')<>""){
					$cari=$cari." WHERE ks.departemen='".$this->input->post('iddepartemen')."' ";
				//}else{
				//	$cari=$cari." WHERE ks.departemen IN (".$this->dbx->sessionjenjangtext().") ";
				//}

      	$sql = "SELECT ks.*
										,(SELECT COUNT(*) FROM kelas WHERE kelompok_siswa=ks.replid) as pakai
										FROM kelompoksiswa ks
										".$cari."
										ORDER BY ks.departemen,ks.kelompok";
				$data['show_table']=$this->dbx->data($sql);
				$data['iddepartemen_opt'] = $this->dbx->opt("SELECT departemen as replid,departemen as nama FROM departemen WHERE aktif=1 AND replid IN (".$this->session->userdata('dept').") ORDER BY urutan",'up');
				return $data;
    }

     //TAMBAH
    public function tambah_db($id='',$data) {
    	$data['id']=$id;
      	$sql="SELECT d.*
      			FROM kelompoksiswa d
      			WHERE d.replid='".$id."'";
        $data['isi'] = $this->dbx->rows($sql);

        if ($data['isi']== NULL ) {
        	unset($data['isi']);
        	$sql="SELECT ".$this->dbx->tablecolumn('kelompoksiswa');
        	$data['isi']=$this->dbx->rows($sql);
        }
        $data['departemen_opt'] = $this->dbx->opt("SELECT departemen as replid, departemen as nama FROM departemen WHERE aktif=1 AND departemen IN (".$this->dbx->sessionjenjangtext().") ORDER BY urutan",'up');
        return $data;
  }
}

?>
