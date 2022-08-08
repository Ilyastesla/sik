<?php

Class Login_Database extends CI_Model {
	public function __construct() {
	parent::__construct();
		$this->load->library('dbx');
	}
    // Insert registration data in database
    public function registration_insert($data) {

        // Query to check whether username already exist or not
        $condition = "user_name =" . "'" . $data['user_name'] . "'";
        $this->db->select('*');
        $this->db->from('user_login');
        $this->db->where($condition);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() == 0) {

            // Query to insert data in database
            $this->db->insert('user_login', $data);
            if ($this->db->affected_rows() > 0) {
                return true;
            }
        } else {
            return false;
        }
    }

    // Read data using  username and password
    public function login($data) {

        $sql = "SELECT * "
				."FROM login l "
				."WHERE l.aktif=1 and l.login = '".$data['username']."'  "
				."AND l.password='".md5($data['password'])."'";
		$query=$this->db->query($sql);
        if ($query->num_rows() == 1) {
            return true;
        } else {
            return false;
        }
    }

    // Read data from database to show data in admin page
    public function read_user_information($sess_array) {

      	$sql = "select p.nip,p.nama,r.role,p.panggilan,p.replid as id_pegawai,p.fotodisplay, p.aktif as status_pegawai, l.*
      			FROM login l "
      			."inner join pegawai p ON l.login=p.nip "
      			."LEFT join role r ON l.role_id=r.replid "
				."WHERE l.login = '".$sess_array['username']."'  "
				."AND l.password='".md5($sess_array['password'])."'";
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
			 $sql = "SELECT k.replid
			 					FROM kelas k
								INNER JOIN pegawai p ON p.replid=k.idwali
			 					WHERE p.nip='".$username."'";
			 $query=$this->dbx->data($sql);
       if ($query<>null) {
           return $query;
       } else {
           return false;
       }
		 }

		public function ubahonline($data,$login) {
		 	  $this->db->where('login',$login);
		 	  $this->db->update('login', $data);
		 	  if ($this->db->_error_number() == 0) {
		 		  return true;
		 	  } else {
		 		  return false;
		    }
     }

}

?>
