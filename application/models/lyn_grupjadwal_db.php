<?php
Class lyn_grupjadwal_db extends CI_Model {
	public function __construct() {
		parent::__construct();
		$this->load->library('dbx');
	}

    // Read data from database to show data in admin page
    public function data() {
      	$sql="SELECT *
                FROM lyn_grupjadwal lyn ORDER BY grupjadwal";
		return $this->dbx->data($sql);
    }

     //TAMBAH
    public function tambah_db($id='',$data) {
    	$data['id']=$id;
      	$sql="SELECT *
      			FROM lyn_grupjadwal
      			WHERE replid='".$id."'";
        $data['isi'] = $this->dbx->rows($sql);

        if ($data['isi']== NULL ) {
			unset($data['isi']);
	        $sql="SELECT ".$this->dbx->tablecolumn('lyn_grupjadwal');
	        $data['isi']=$this->dbx->rows($sql);
        }
		return $data;
  }
}

?>
