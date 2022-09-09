<?php
Class hrm_codeofconduct_db extends CI_Model {
public function __construct() {
parent::__construct();
	$this->load->library('dbx');
}
    // Read data from database to show data in admin page
    public function data() {
      	$sql="SELECT * FROM hrm_codeofconduct
      			WHERE created_by='".$this->session->userdata('idpegawai')."'
      			ORDER BY modified_date";
      	return $this->dbx->data($sql);
    }


    //TAMBAH
    //-------------------------------------------------------------------------------------------
    public function tambah_x($id='',$data) {
    	$data['id']=$id;
      	$sql="SELECT *
      			FROM hrm_codeofconduct kk
      			WHERE kk.replid='".$id."'";
        $data['isi'] = $this->dbx->rows($sql);

				if ($data['isi']== NULL ) {
        	unset($data['isi']);
	        $sql="SELECT ".$this->dbx->tablecolumn('hrm_codeofconduct').",1 as aktif,CURRENT_DATE() as tanggal";
					//echo $sql;die;
        	$data['isi']=$this->dbx->rows($sql);
        }

				return $data;
    }

    public function tambah($data) {
    	//echo print_r(array_values($data));die;
    	$this->db->trans_start();
        $this->db->insert('hrm_codeofconduct', $data);
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
		$this->db->update('hrm_codeofconduct', $data);
		if ($this->db->_error_number() == 0) {
		  return true;
		} else {
		  return false;
		}
	}

    //hrm_codeofconduct MAP
    //-------------------------------------------------------------------------------------------
    public function tambah_tujuan($id='',$data) {
    	$data['id']=$id;
      	$sql="SELECT *
      			FROM hrm_codeofconduct kk
      			WHERE kk.replid='".$id."'";

        $data['isi'] = $this->dbx->rows($sql);
        $data['idrole_opt'] = $this->dbx->data("SELECT j.replid,j.role as nama
        											,(SELECT '1' FROM hrm_codeofconduct_tujuan WHERE hrm_codeofconduct_id='".$id."' AND idrole=j.replid) as checked
        											FROM role j
													WHERE j.aktif=1
													ORDER BY j.role");
        return $data;
    }


    public function hapus_tujuan_p_db($id) {
	    $this->db->where('hrm_codeofconduct_id',$id);
	    $this->db->delete('hrm_codeofconduct_tujuan');
	    if ($this->db->_error_number() == 0) {
	    	return true;
	    } else {
	        return false;
	    }
    }

    public function tambah_tujuan_p_db($data) {
    	//echo print_r(array_values($data));die;
    	$this->db->trans_start();
        $this->db->insert('hrm_codeofconduct_tujuan', $data);
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
	    $this->db->delete('hrm_codeofconduct');
	    if ($this->db->_error_number() == 0) {
	    	return true;
	    } else {
	        return false;
	    }
    }


}
?>
