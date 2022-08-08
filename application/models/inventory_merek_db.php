<?php

Class inventory_merek_db extends CI_Model {
public function __construct() {
parent::__construct();
	$this->load->library('dbx');
}
    // Read data from database to show data in admin page
    public function data() {
      $sql = "SELECT * FROM inventory_merek
          ORDER BY nama
          ";
      	$data['show_table']= $this->dbx->data($sql);
        return $data;
    }


    //TAMBAH
    //-------------------------------------------------------------------------------------------
    public function tambah_x($id='',$data) {
    	$data['id']=$id;
      	$sql="SELECT *
      			FROM inventory_merek kk
      			WHERE kk.replid='".$id."'";
        $data['isi'] = $this->dbx->rows($sql);

        if ($data['isi']== NULL ) {
					unset($data['isi']);
        	$sql="SELECT ".$this->dbx->tablecolumn('inventory_merek').",1 as aktif";
					$data['isi']=$this->dbx->rows($sql);
        }
        return $data;
    }
}
?>
