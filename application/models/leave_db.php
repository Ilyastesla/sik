<?php
Class leave_db extends CI_Model {
public function __construct() {
parent::__construct();
	$this->load->library('dbx');
	
}
	//---------------------------------------------------------------------------------------------------------
	//---------------------------------------------------------------------------------------------- LEAVE
	//---------------------------------------------------------------------------------------------------------
	
    public function leave_table($data) {
      	$sql = "SELECT l.*,p.nama,r.reff as leave_type_id, r2.reff as approved FROM pegawai_leave l
      			LEFT JOIN pegawai p ON l.pegawai_id=p.replid
      			LEFT JOIN pegawai_reff r ON l.leave_type_id=r.replid AND r.type=9
      			LEFT JOIN pegawai_reff r2 ON l.approved=r2.replid AND r2.type=10
      			ORDER BY begin_date";
      	$data['data_table']=$this->dbx->data($sql);
		return $data;
    }
    
    public function ubahleave_db($idx,$data) {
    	$sql="SELECT *,CONCAT(DATE_FORMAT(begin_date,'%m/%d/%Y %h:%i %p'),' - ',DATE_FORMAT(end_date,'%m/%d/%Y %h:%i %p')) as jadwal FROM pegawai_leave WHERE replid='".$idx."'";
    	$data['isi']=$this->dbx->rows($sql);
    	
    	if ($data['isi']== NULL ) {
        	unset($data['isi']);
        	$sql="SELECT NULL as 'replid',NULL as 'pegawai_id',NULL as 'leave_type_id'
        	,NULL as 'begin_date'
        	,NULL as 'end_date'
        	,NULL as 'keterangan'
        	,'1' as 'aktif'";
        	$data['isi']=$this->dbx->rows($sql);
        }
        $data['pegawai_opt'] = $this->dbx->opt("select replid,nama from pegawai 
    										WHERE aktif=1
    										ORDER BY nama",'up');
    	$data['leave_type_opt'] = $this->dbx->opt("select replid,reff as nama from pegawai_reff WHERE type=9
    										ORDER BY reff",'up');

    	return $data;
    }
    public function ubahleave_p_db($data,$idx) {
		$this->db->where('replid',$idx);
		$this->db->update('pegawai_leave', $data);
		if ($this->db->_error_number() == 0) {
			return true;
		} else {
			return false;
		}
	 }
	 public function tambahleave_p_db($data) {
    	$this->db->trans_start();
        $this->db->insert('pegawai_leave', $data);
        if ($this->db->affected_rows() > 0) {
               $this->db->trans_complete();
               return true;
                
        } else {
        	$this->db->trans_complete();
            return false;
        }
     }
    
    public function hapusleave_p_db($id) {
        $this->db->where('replid',$id);
        $this->db->delete('pegawai_leave');
        if ($this->db->_error_number() == 0) {
        	return true;
        } else {
            return false;
        }
    } 
    //---------------------------------------------------------------------------------------------------------
	//---------------------------------------------------------------------------------------------- LEAVE TYPE
	//---------------------------------------------------------------------------------------------------------
	
    public function leave_type_table($data) {
      	$sql = "SELECT * FROM pegawai_reff Where type=9 ORDER BY reff";
      	$data['data_table']=$this->dbx->data($sql);
		return $data;
    }
    
    public function ubahleavetype_db($idx,$data) {
    	$sql="SELECT * FROM pegawai_reff WHERE type=9 and replid='".$idx."'";
    	$data['isi']=$this->dbx->rows($sql);
    	
    	if ($data['isi']== NULL ) {
        	unset($data['isi']);
        	$sql="SELECT NULL as 'replid',NULL as 'reff', '1' as 'aktif'";
        	$data['isi']=$this->dbx->rows($sql);
        }
    	return $data;
    }
    public function ubahleavetype_p_db($data,$idx) {
		$this->db->where('replid',$idx);
		$this->db->update('pegawai_reff', $data);
		if ($this->db->_error_number() == 0) {
			return true;
		} else {
			return false;
		}
	 }
	 public function tambahleavetype_p_db($data) {
    	$this->db->trans_start();
        $this->db->insert('pegawai_reff', $data);
        if ($this->db->affected_rows() > 0) {
               $this->db->trans_complete();
               return true;
                
        } else {
        	$this->db->trans_complete();
            return false;
        }
     }
    
    public function hapusleavetype_p_db($id) {
        $this->db->where('replid',$id);
        $this->db->delete('pegawai_reff');
        if ($this->db->_error_number() == 0) {
        	return true;
        } else {
            return false;
        }
    }      
}	
?>