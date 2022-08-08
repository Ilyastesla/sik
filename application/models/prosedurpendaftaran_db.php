<?php

Class prosedurpendaftaran_db extends CI_Model {

  public function __construct() {
    parent::__construct();
    $this->load->library('dbx');
  }

  public function data() {

    	$sql = "SELECT b.*,DATE_FORMAT(b.modified_date,'%H:%i') as timex,'berita' as tipetimeline
    			FROM hrm_berita b
    			WHERE b.aktif=1 And tipe='prosedurpendaftaran'
    			ORDER BY b.modified_date DESC
          LIMIT 20
    			";
      $data['show_table']=$this->dbx->data($sql);
      return $data;
  }
}

?>
