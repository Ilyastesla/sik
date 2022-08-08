<?php
Class hrm_role_db extends CI_Model {
public function __construct() {
parent::__construct();
	$this->load->library('dbx');
}
    // Read data from database to show data in admin page
    public function data() {
      	$sql="SELECT r.*,r2.role as roletext FROM role r
							LEFT JOIN role r2 ON r2.idatasan=r.replid
				WHERE r.hide<>1 
      			ORDER BY role";
      	return $this->dbx->data($sql);
    }


    //TAMBAH
    //-------------------------------------------------------------------------------------------
    public function tambah_x($id='',$data) {
    	$data['id']=$id;
      	$sql="SELECT *
      			FROM role kk
      			WHERE kk.replid='".$id."'";
        $data['isi'] = $this->dbx->rows($sql);

				if ($data['isi']== NULL ) {
					unset($data['isi']);
					$sql="SELECT ".$this->dbx->tablecolumn('role').",1 as aktif ";
        	$data['isi']=$this->dbx->rows($sql);
        }
				$data['idatasan_opt'] = $this->dbx->opt("SELECT replid, role as nama FROM role WHERE aktif=1 ORDER BY role",'up');
        return $data;
    }

    public function tambah($data) {
    	//echo print_r(array_values($data));die;
    	$this->db->trans_start();
        $this->db->insert('role', $data);
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
		$this->db->update('role', $data);
		if ($this->db->_error_number() == 0) {
		  return true;
		} else {
		  return false;
		}
	}

    //ROLE MAP
    //-------------------------------------------------------------------------------------------
    public function tambah_map($id='',$data) {
    	$data['id']=$id;
      	$sql="SELECT *
      			FROM role kk
      			WHERE kk.replid='".$id."'";

        $data['isi'] = $this->dbx->rows($sql);

        if ($data['isi']== NULL ) {
        	unset($data['isi']);
        	$sql="SELECT
					NULL as role,
					NULL as keterangan,
					1 as aktif,
					NULL as created_date,
					NULL as created_by,
					NULL as modified_date,
					NULL as modified_by";
        	$data['isi']=$this->dbx->rows($sql);
        }
        $data['sub_menu_opt'] = $this->dbx->data("SELECT mn.replid,CONCAT ('[',m.nama,'] ',mn.nama) as nama
        											,(SELECT '1' FROM hrm_role_map WHERE role_id='".$id."' AND submenu_id=mn.replid) as checked
        											FROM hrm_menu mn
													INNER JOIN hrm_modul m ON mn.modul_id=m.replid
													WHERE mn.aktif=1 AND m.aktif=1
													ORDER BY m.nama,mn.nama
													",'up');
        return $data;
    }


    public function hapus_role_map_db($id) {
	    $this->db->where('role_id',$id);
	    $this->db->delete('hrm_role_map');
	    if ($this->db->_error_number() == 0) {
	    	return true;
	    } else {
	        return false;
	    }
    }

    public function tambah_role_map($data) {
    	//echo print_r(array_values($data));die;
    	$this->db->trans_start();
        $this->db->insert('hrm_role_map', $data);
        $insert_id = $this->db->insert_id();
        if ($this->db->affected_rows() > 0) {
               $this->db->trans_complete();
               return true;
        } else {
        	$this->db->trans_complete();
            return false;
        }
     }

    //ROLE MAP SIP
    //-------------------------------------------------------------------------------------------
    public function tambah_map_sip($id='',$data) {
    	$data['id']=$id;
      	$sql="SELECT *
      			FROM role kk
      			WHERE kk.replid='".$id."'";

        $data['isi'] = $this->dbx->rows($sql);

        if ($data['isi']== NULL ) {
        	unset($data['isi']);
        	$sql="SELECT
					NULL as role,
					NULL as keterangan,
					1 as aktif,
					NULL as created_date,
					NULL as created_by,
					NULL as modified_date,
					NULL as modified_by";
        	$data['isi']=$this->dbx->rows($sql);
        }
        //,(SELECT '1' FROM role_map WHERE role_id='".$id."' AND submenu_id=mn.replid) as checked
        $data['sub_menu_sip_opt'] = $this->dbx->data("select sm.replid,CONCAT ('[',REPLACE(m.nama,'<br/>',' '),'] ','[',REPLACE(rm.nama,'<br/>',' '),'] ',REPLACE(sm.nama,'<br/>',' ')) as nama
        											,(SELECT '1' FROM role_map WHERE role_id='".$id."' AND submenu_id=sm.replid) as checked
													FROM reff_submenu sm
													INNER JOIN reff_menu rm ON sm.menu_id=rm.replid
													INNER JOIN reff_modul m ON rm.modul_id=m.replid
													WHERE sm.aktif=1 AND rm.aktif=1 AND m.aktif=1
													ORDER BY m.nama,rm.nama,sm.nama
													",'up');
        return $data;
    }


    public function hapus_role_map_sip_db($id) {
	    $this->db->where('role_id',$id);
	    $this->db->delete('role_map');
	    if ($this->db->_error_number() == 0) {
	    	return true;
	    } else {
	        return false;
	    }
    }

    public function tambah_role_map_sip($data) {
    	//echo print_r(array_values($data));die;
    	$this->db->trans_start();
        $this->db->insert('role_map', $data);
        $insert_id = $this->db->insert_id();
        if ($this->db->affected_rows() > 0) {
               $this->db->trans_complete();
               return true;
        } else {
        	$this->db->trans_complete();
            return false;
        }
     }

    public function hapus_db($id) {
	    // Query to check whether username already exist or not
	    $this->db->where('replid',$id);
	    $this->db->delete('role');
	    if ($this->db->_error_number() == 0) {
	    	return true;
	    } else {
	        return false;
	    }
    }


}
?>
