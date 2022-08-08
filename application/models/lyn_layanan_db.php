<?php

Class lyn_layanan_db extends CI_Model {
	public function __construct() {
		parent::__construct();
		$this->load->library('dbx');
	}

    // Read data from database to show data in admin page
    public function data() {
      	$sql="SELECT p.*,n.jenislayanan as jenislayanantext 
							FROM lyn_layanan p
							LEFT JOIN lyn_jenislayanan n ON n.replid=p.idjenislayanan
							ORDER BY p.layanan";
      	return $this->dbx->data($sql);
    }

     //TAMBAH
    public function tambah_db($id='',$data) {
    	$data['id']=$id;
      	$sql="SELECT *
      			FROM lyn_layanan
      			WHERE replid='".$id."'";
        $data['isi'] = $this->dbx->rows($sql);

        if ($data['isi']== NULL ) {
					unset($data['isi']);
	        $sql="SELECT ".$this->dbx->tablecolumn('lyn_layanan');
	        $data['isi']=$this->dbx->rows($sql);
        }
				$data['idjenislayanan_opt'] = $this->dbx->opt("SELECT replid,jenislayanan as nama FROM lyn_jenislayanan ORDER BY jenislayanan",'up');
        return $data;
  }
}

?>
