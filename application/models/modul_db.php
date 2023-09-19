<?php

Class modul_db extends CI_Model {
public function __construct() {
parent::__construct();
	$this->load->library('dbx');
}
    // Read data from database to show data in admin page
    public function data() {
      	$sql="SELECT * FROM hrm_modul ORDER BY no_urut";
      	return $this->dbx->data($sql);
    }


    //TAMBAH
    //-------------------------------------------------------------------------------------------
    public function tambah_x($id='',$data) {
    	$data['id']=$id;
      	$sql="SELECT *
      			FROM hrm_modul kk
      			WHERE kk.replid='".$id."'";
        $data['isi'] = $this->dbx->rows($sql);

        if ($data['isi']== NULL ) {
			unset($data['isi']);
	        $sql="SELECT ".$this->dbx->tablecolumn('hrm_modul').",1 as aktif";
	        $data['isi']=$this->dbx->rows($sql);
        }
        return $data;
    }
}
?>
