<?php

Class ns_kurikulum_db extends CI_Model {
	public function __construct() {
		parent::__construct();
		$this->load->library('dbx');
	}

    // Read data from database to show data in admin page
    public function data() {

      	$sql="SELECT * FROM ns_kurikulum ORDER BY kurikulum";
      	return $this->dbx->data($sql);
    }

     //TAMBAH
     public function tambah_db($id='',$data) {
    	$sql="SELECT *
      			FROM ns_kurikulum kk
      			WHERE kk.replid='".$id."'";
        $data['isi'] = $this->dbx->rows($sql);

        if ($data['isi']== NULL ) {
					unset($data['isi']);
	        $sql="SELECT ".$this->dbx->tablecolumn('ns_kurikulum').",1 as aktif";
	        $data['isi']=$this->dbx->rows($sql);
        }
        return $data;
    }


   public function tambah_pdb($data) {
    	//echo print_r(array_values($data));die;
    	$this->db->trans_start();
        $this->db->insert('ns_kurikulum', $data);
        $insert_id = $this->db->insert_id();
        if ($this->db->affected_rows() > 0) {
               $this->db->trans_complete();
               return $insert_id;
        } else {
        	$this->db->trans_complete();
            return false;
        }
     }

     public function ubah_pdb($data,$id) {
        $this->db->where('replid',$id);
        $this->db->update('ns_kurikulum', $data);
        if ($this->db->_error_number() == 0) {
            return true;
        } else {
            return false;
        }
    }

    public function hapus_pdb($id) {
        // Query to check whether username already exist or not
        $this->db->where('replid',$id);
        $this->db->delete('ns_kurikulum');
        if ($this->db->_error_number() == 0) {
	        return true;
        } else {
            return false;
        }
    }
}

?>
