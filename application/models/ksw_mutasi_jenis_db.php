<?php

Class ksw_mutasi_jenis_db extends CI_Model {
public function __construct() {
parent::__construct();
	$this->load->library('dbx');
}
    // Read data from database to show data in admin page
    public function data() {
      	$sql="SELECT jm.*,(SELECT COUNT(replid) FROM mutasisiswa WHERE jenismutasi=jm.replid) as pakai 
          FROM jenismutasi jm ORDER BY jm.jenismutasi";
      	$data['show_table'] =$this->dbx->data($sql);
				return $data;
    }


    //TAMBAH
    //-------------------------------------------------------------------------------------------
    public function tambah_x($id='',$data) {
    	$data['id']=$id;
      	$sql="SELECT *
      			FROM jenismutasi kk
      			WHERE kk.replid='".$id."'";
        $data['isi'] = $this->dbx->rows($sql);

        if ($data['isi']== NULL ) {
					unset($data['isi']);
        	$sql="SELECT ".$this->dbx->tablecolumn('jenismutasi').",1 as aktif";
					$data['isi']=$this->dbx->rows($sql);
        }
        return $data;
    }
}
?>
