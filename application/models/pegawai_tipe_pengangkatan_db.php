<?php

Class pegawai_tipe_pengangkatan_db extends CI_Model {
public function __construct() {
parent::__construct();
	$this->load->library('dbx');
}
    // Read data from database to show data in admin page
    public function data() {
      	$sql="SELECT * FROM hrm_pegawai_tipe_pengangkatan ORDER BY pegawai_tipe_pengangkatan";
      	return $this->dbx->data($sql);
    }
        
     
    //TAMBAH
    //-------------------------------------------------------------------------------------------
    public function tambah_x($id='',$data) {
    	$data['id']=$id;
      	$sql="SELECT *
      			FROM hrm_pegawai_tipe_pengangkatan kk
      			WHERE kk.replid='".$id."'";
        $data['isi'] = $this->dbx->rows($sql);
        
        if ($data['isi']== NULL ) {
        	unset($data['isi']);
        	$sql="SELECT 
        			NULL as kode_tipe_pengangkatan,
					NULL as pegawai_tipe_pengangkatan,
					1 as aktif,
					NULL as created_date,
					NULL as created_by,
					NULL as modified_date,
					NULL as modified_by";
        	$data['isi']=$this->dbx->rows($sql);
        }
        return $data;
    }

    public function tambah($data) {
    	//echo print_r(array_values($data));die;
    	$this->db->trans_start();
        $this->db->insert('hrm_pegawai_tipe_pengangkatan', $data);
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
		//echo var_dump($data);die;
		$this->db->where('replid',$id);
		$this->db->update('hrm_pegawai_tipe_pengangkatan', $data);
		if ($this->db->_error_number() == 0) {
		  return true;
		} else {
		  return false;
		}
	}
	
	public function hapus_db($id) {
	    // Query to check whether username already exist or not
	    $this->db->where('replid',$id);
	    $this->db->delete('hrm_pegawai_tipe_pengangkatan');
	    if ($this->db->_error_number() == 0) {
	    	return true;
	    } else {
	        return false;
	    }
    }
}
?>