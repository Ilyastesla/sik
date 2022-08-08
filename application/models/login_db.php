<?php

Class login_db extends CI_Model {
	public function __construct() {
	parent::__construct();
		$this->load->library('dbx');
	}

    // Read data from database to show data in admin page
    public function read_user_information($username) {
      	$sql = "SELECT * FROM pegawai_calon p
								WHERE p.noktp = '".$username."' LIMIT 1";
				//echo $sql;die;
				$query=$this->dbx->rows($sql);
        if ($query<>null) {
            return $query;
        } else {
            return false;
        }
    }

    public function tambahhistory_db($data) {
    	//echo print_r(array_values($data));die;
    	$this->db->trans_start();
        $this->db->insert('history_user', $data);
        $insert_id = $this->db->insert_id();
        if ($this->db->affected_rows() > 0) {
               $this->db->trans_complete();
               return $insert_id;
        } else {
        	$this->db->trans_complete();
            return false;
        }
     }
}

?>
