<?php

Class inventory_kelompok_db extends CI_Model {
public function __construct() {
parent::__construct();
	$this->load->library('dbx');
}
    // Read data from database to show data in admin page
    public function data() {
      $sql = "SELECT k.*,k2.nama as parent
                , (SELECT COUNT(replid) FROM inventory_material WHERE idkelompok=k.replid) as jmlmat
                ,f.nama as fiskaltext
              FROM inventory_kelompok k
              LEFT JOIN inventory_kelompok k2 ON k.parent=k2.replid
              LEFT JOIN inventory_fiskal f ON f.replid=k.idfiskal
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
      			FROM inventory_kelompok kk
      			WHERE kk.replid='".$id."'";
        $data['isi'] = $this->dbx->rows($sql);

        if ($data['isi']== NULL ) {
					unset($data['isi']);
        	$sql="SELECT ".$this->dbx->tablecolumn('inventory_kelompok').",1 as aktif";
					$data['isi']=$this->dbx->rows($sql);
        }
        $data['parent_opt'] = $this->dbx->opt("SELECT replid,nama FROM inventory_kelompok ORDER BY nama",'up');
  			$data['fiskal_opt'] = $this->dbx->opt("SELECT replid,nama FROM inventory_fiskal ORDER BY nama",'up');
        return $data;
    }
}
?>
