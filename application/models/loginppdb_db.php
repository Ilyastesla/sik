<?php

Class loginppdb_db extends CI_Model {
	public function __construct() {
	parent::__construct();
		$this->load->library('dbx');
	}

    // Read data using  username and password
    public function loginppdb($username,$token) {

        $sql = "SELECT * "
				."FROM calonsiswa cs "
				."WHERE cs.aktif=1 AND cs.nopendaftaran = '".$username."' AND cs.tokenonline = '".$token."'  ";
		$query=$this->db->query($sql);
        if ($query->num_rows() == 1) {
            return true;
        } else {
            return false;
        }
    }

    // Read data from database to show data in admin page
    public function read_user_information($username,$token) {
      	$sql = "SELECT * FROM calonsiswa cs
								WHERE cs.nopendaftaran = '".$username."' AND cs.tokenonline = '".$token."'";
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

		 public function read_kelas($username) {
			 //AND idtahunajaran IN (select replid from tahunajaran where aktif=1)
			 $sql = "select replid from kelas where nipwali='".$username."'";
			 $query=$this->dbx->data($sql);
       if ($query<>null) {
           return $query;
       } else {
           return false;
       }
		 }

		public function ubahonline($data,$loginppdb) {
		 	  $this->db->where('loginppdb',$loginppdb);
		 	  $this->db->update('loginppdb', $data);
		 	  if ($this->db->_error_number() == 0) {
		 		  return true;
		 	  } else {
		 		  return false;
		    }
     }
}

?>
