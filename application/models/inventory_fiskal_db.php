<?php

Class inventory_fiskal_db extends CI_Model {
public function __construct() {
parent::__construct();
	$this->load->library('dbx');
}
    // Read data from database to show data in admin page
    public function data() {
        $sql = "SELECT * FROM inventory_fiskal ORDER BY nama";
      	$data['show_table']= $this->dbx->data($sql);
        return $data;
    }


    //TAMBAH
    //-------------------------------------------------------------------------------------------
    public function tambah_x($id='',$data) {
    	$data['id']=$id;
      	$sql="SELECT *
      			FROM inventory_fiskal kk
      			WHERE kk.replid='".$id."'";
        $data['isi'] = $this->dbx->rows($sql);

        if ($data['isi']== NULL ) {
					unset($data['isi']);
        	$sql="SELECT ".$this->dbx->tablecolumn('inventory_fiskal').",1 as aktif";
					$data['isi']=$this->dbx->rows($sql);
        }
        $data['parent_opt'] = $this->dbx->opt("SELECT replid,nama FROM inventory_fiskal",'up');
        return $data;
    }
}
?>
