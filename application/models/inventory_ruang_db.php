<?php

Class inventory_ruang_db extends CI_Model {
public function __construct() {
parent::__construct();
	$this->load->library('dbx');
}
    // Read data from database to show data in admin page
    public function data() {
      $sql = "SELECT k.*,k2.nama as parent
                    ,(SELECT COUNT(*) FROM inventory_penyerahan_barang_mat WHERE idruang=k.replid) as pakai 
                FROM inventory_ruang k
                LEFT JOIN inventory_ruang k2 ON k.parent=k2.replid
                ORDER BY k.nama
            ";
      	$data['show_table']= $this->dbx->data($sql);
        return $data;
    }


    //TAMBAH
    //-------------------------------------------------------------------------------------------
    public function tambah_x($id='',$data) {
    	$data['id']=$id;
      	$sql="SELECT *
      			FROM inventory_ruang kk
      			WHERE kk.replid='".$id."'";
        $data['isi'] = $this->dbx->rows($sql);

        if ($data['isi']== NULL ) {
					unset($data['isi']);
        	$sql="SELECT ".$this->dbx->tablecolumn('inventory_ruang').",1 as aktif";
					$data['isi']=$this->dbx->rows($sql);
        }
        $data['parent_opt'] = $this->dbx->opt("SELECT replid,nama FROM inventory_ruang",'up');
        return $data;
    }
}
?>
