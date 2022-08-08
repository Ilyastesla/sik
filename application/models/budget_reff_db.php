<?php

Class budget_reff_db extends CI_Model {
public function __construct() {
parent::__construct();
	$this->load->library('dbx');
}
    // Read data from database to show data in admin page
    public function data() {
      	$sql="SELECT br.*,(SELECT budget_reff FROM budget_reff br2 WHERE br2.replid=br.idhead) as headtext
              FROM budget_reff br
              ORDER BY type,br.budget_reff";
      	return $this->dbx->data($sql);
    }


    //TAMBAH
    //-------------------------------------------------------------------------------------------
    public function tambah_x($id='',$data) {
    	$data['id']=$id;
      	$sql="SELECT *
      			FROM budget_reff kk
      			WHERE kk.replid='".$id."'";
        $data['isi'] = $this->dbx->rows($sql);

        if ($data['isi']== NULL ) {
        	unset($data['isi']);
					$sql="SELECT ".$this->dbx->tablecolumn('budget_reff')." ,1 as aktif";
        	$data['isi']=$this->dbx->rows($sql);
        }
				$type_arr= array(""=>"Pilih...","jenis_pendapatan"=>"jenis_pendapatan","jenis_biaya"=>"jenis_biaya");
        $data['idhead_opt'] = $this->dbx->opt("SELECT replid,budget_reff as nama FROM budget_reff WHERE type='jenis_pendapatan' AND aktif=1 ORDER BY budget_reff",'up');
				$data['type_opt'] = $type_arr;
        return $data;
    }
}
?>
