<?php
Class lyn_jenislayanan_db extends CI_Model {
	public function __construct() {
		parent::__construct();
		$this->load->library('dbx');
	}

    // Read data from database to show data in admin page
    public function data() {
      	$sql="SELECT *,(SELECT COUNT(*) FROM lyn_layanan WHERE idjenislayanan=lyn.replid) as pakai FROM lyn_jenislayanan lyn ORDER BY jenislayanan";
				return $this->dbx->data($sql);
    }

     //TAMBAH
    public function tambah_db($id='',$data) {
    	$data['id']=$id;
      	$sql="SELECT *
      			FROM lyn_jenislayanan
      			WHERE replid='".$id."'";
        $data['isi'] = $this->dbx->rows($sql);

        if ($data['isi']== NULL ) {
			unset($data['isi']);
	        $sql="SELECT ".$this->dbx->tablecolumn('lyn_jenislayanan');
	        $data['isi']=$this->dbx->rows($sql);
        }
		return $data;
  }
}

?>
