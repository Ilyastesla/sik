<?php

Class coa_db extends CI_Model {
  public function __construct() {
    parent::__construct();
    $this->load->library('dbx');
  }
    // Read data from database to show data in admin page
    public function data() {

      	 $sql = "SELECT * FROM rekakun ORDER BY kode";
		      return $this->dbx->data($sql);
    }
}

?>
