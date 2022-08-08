<?php

Class psb_proses_db extends CI_Model {
	public function __construct() {
		parent::__construct();
		$this->load->library('dbx');
	}

    // Read data from database to show data in admin page
    public function data() {
			$cari="";

			//if ($this->input->post('iddepartemen')<>""){
				$cari=$cari." WHERE pps.departemen='".$this->input->post('iddepartemen')."' ";
			//}

      	$sql = "SELECT pps.*
									,(SELECT COUNT(c.replid) AS jumlah FROM calonsiswa c WHERE c.idproses = pps.replid AND c.aktif = 1) as jumlah
									FROM prosespenerimaansiswa pps
									".$cari."
									ORDER BY pps.departemen,pps.info1";
				$data['show_table']=$this->dbx->data($sql);
				$data['iddepartemen_opt'] = $this->dbx->opt("SELECT departemen as replid,departemen as nama FROM departemen WHERE replid IN (".$this->session->userdata('dept').") ORDER BY urutan",'up');
				return $data;
		}

     //TAMBAH
    public function tambah_db($id='',$data) {
    	$data['id']=$id;
      	$sql="SELECT d.*
      			FROM prosespenerimaansiswa d
      			WHERE d.replid='".$id."'";
        $data['isi'] = $this->dbx->rows($sql);

        if ($data['isi']== NULL ) {
        	unset($data['isi']);
					$sql="SELECT ".$this->dbx->tablecolumn('prosespenerimaansiswa').",1 as aktif";
					//echo $sql;die;
        	$data['isi']=$this->dbx->rows($sql);
					//echo var_dump($data['isi']);die;
        }
        $data['departemen_opt'] = $this->dbx->opt("SELECT departemen as replid, departemen as nama FROM departemen WHERE aktif=1 AND departemen IN (".$this->dbx->sessionjenjangtext().") ORDER BY urutan",'up');
        return $data;
  }
}

?>
