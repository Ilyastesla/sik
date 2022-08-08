<?php

Class group_pinjaman_db extends CI_Model {
public function __construct() {
parent::__construct();
	$this->load->library('dbx');
}
    // Read data from database to show data in admin page
    public function data() {
      	$sql="SELECT gp.*,j.jabatan as idjabatan,jp.jenis_pinjaman as idjenis_pinjaman
      			FROM hrm_group_pinjaman gp 
      			LEFT JOIN hrm_jabatan j ON j.replid=gp.idjabatan
      			LEFT JOIN hrm_jenis_pinjaman jp ON jp.replid=gp.idjenis_pinjaman
      			ORDER BY group_pinjaman";
      	return $this->dbx->data($sql);
    }
        
     
    //TAMBAH
    //-------------------------------------------------------------------------------------------
    public function tambah_x($id='',$data) {
    	$data['id']=$id;
      	$sql="SELECT *
      			FROM hrm_group_pinjaman kk
      			WHERE kk.replid='".$id."'";
        $data['isi'] = $this->dbx->rows($sql);
        
        if ($data['isi']== NULL ) {
        	unset($data['isi']);
        	$sql="SELECT 
					NULL as group_pinjaman,
					,NULL as idjabatan
					,NULL as idjenis_pinjaman
					1 as aktif,
					NULL as created_date,
					NULL as created_by,
					NULL as modified_date,
					NULL as modified_by";
        	$data['isi']=$this->dbx->rows($sql);
        }
        
        $data['jabatan_opt'] = $this->dbx->opt("select replid,jabatan as nama from hrm_jabatan ORDER BY jabatan",'up');
        $data['jenis_pinjaman_opt'] = $this->dbx->opt("select replid,jenis_pinjaman as nama from hrm_jenis_pinjaman ORDER BY jenis_pinjaman",'up');
        return $data;
    }

    public function tambah($data) {
    	//echo print_r(array_values($data));die;
    	$this->db->trans_start();
        $this->db->insert('hrm_group_pinjaman', $data);
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
		$this->db->update('hrm_group_pinjaman', $data);
		if ($this->db->_error_number() == 0) {
		  return true;
		} else {
		  return false;
		}
	}
	
	public function hapus_db($id) {
	    // Query to check whether username already exist or not
	    $this->db->where('replid',$id);
	    $this->db->delete('hrm_group_pinjaman');
	    if ($this->db->_error_number() == 0) {
	    	return true;
	    } else {
	        return false;
	    }
    }
}
?>