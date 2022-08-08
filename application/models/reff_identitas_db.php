<?php

Class reff_identitas_db extends CI_Model {
	public function __construct() {
		parent::__construct();
		$this->load->library('dbx');
	}

    // Read data from database to show data in admin page
    public function data() {
      	$sql="SELECT i.*,d.departemen,d.replid
							FROM departemen d
							LEFT JOIN identitas i ON d.departemen = i.departemen
							ORDER BY d.urutan";
				return $this->dbx->data($sql);
    }

     //TAMBAH
    public function tambah_db($id='',$data) {
    		$data['id']=$id;
      	$sql="SELECT i.*,d.departemen
							FROM departemen d
							LEFT JOIN identitas i ON d.departemen = i.departemen
      				WHERE d.replid='".$id."'";
        $data['isi'] = $this->dbx->rows($sql);
        $data['pegawai_opt'] = $this->dbx->opt("SELECT nip as replid, nama FROM pegawai WHERE aktif=1 ORDER BY nama",'up');
        return $data;
  }


   public function tambah_pdb($data) {
    	//echo print_r(array_values($data));die;
    	$this->db->trans_start();
        $this->db->insert('identitas', $data);
        $insert_id = $this->db->insert_id();
        if ($this->db->affected_rows() > 0) {
               $this->db->trans_complete();
               return $insert_id;
        } else {
        	$this->db->trans_complete();
            return false;
        }
     }

     public function ubah($data,$id) {
        $this->db->where('replid',$id);
        $this->db->update('identitas', $data);
        if ($this->db->_error_number() == 0) {
            return true;
        } else {
            return false;
        }
    }

    public function hapus_db($id) {
        $this->db->where('replid',$id);
        $this->db->delete('identitas');
        if ($this->db->_error_number() == 0) {
	        return true;
        } else {
            return false;
        }
    }
}

?>
