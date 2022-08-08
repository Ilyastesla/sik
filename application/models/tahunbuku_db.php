<?php

Class tahunbuku_db extends CI_Model {

    // Read data from database to show data in admin page
    public function tahunbuku_data() {

      	$sql = "SELECT * FROM tahunbuku ORDER BY aktif DESC";
		return $this->dbx->data($sql);
}

?>
