<?php

Class salary_db extends CI_Model {
public function __construct() {
parent::__construct();
	$this->load->library('dbx');
	
}
    // Read data from database to show data in admin page
    public function salary_table($data) {
      	$sql = "SELECT p.*,j.jabatan FROM pegawai p
      			LEFT JOIN jabatan j ON p.idjabatan = j.replid 
      			WHERE p.aktif=1 ORDER BY p.nama";
      	$data['data_table']=$this->dbx->data($sql);
		return $data;
    }
    
    public function ubahsalary_db($id,$data) {
    	$sql="SELECT p.*,j.jabatan FROM pegawai p
    			LEFT JOIN jabatan j ON p.idjabatan = j.replid 
    			WHERE p.replid='".$id."'";
    	$data['isi']=$this->dbx->rows($sql);
        
        $sql="SELECT sa.*,a.nama as allowance,sr.type 
        		FROM pegawai_salary_allowance sa 
        		LEFT JOIN pegawai_allowance a ON sa.allowance_id=a.replid
        		LEFT JOIN pegawai_salary_reff sr ON sr.replid=sa.type_id
    			WHERE sa.pegawai_id='".$id."' ORDER BY sr.type ASC";
    	//echo $sql;die;
    	$data['allowance']=$this->dbx->data($sql);

        $sql="SELECT sa.*,a.nama as deduction,sr.type
         		FROM pegawai_salary_deduction sa 
        		LEFT JOIN pegawai_deduction a ON sa.deduction_id=a.replid
    			LEFT JOIN pegawai_salary_reff sr ON sr.replid=sa.type_id
    			WHERE sa.pegawai_id='".$id."' ORDER BY sr.type ASC";
    	//echo $sql;die;
    	$data['deduction']=$this->dbx->data($sql);
    	return $data;
    }
    
    //---------------------------------------------------------------------------------------------------------
	//------------------------------------------------------------------------------------------ ALLOWANCE
	//---------------------------------------------------------------------------------------------------------
	
	// Read data from database to show data in admin page
    public function allowance_table($data) {
      	$sql = "SELECT * FROM pegawai_allowance
      			ORDER BY nama
      			";
		$data['data_table']=$this->dbx->data($sql);
		return $data;
    }
	
	public function ubahallowance_db($id_pegawai,$data) {
    	$sql="SELECT * FROM pegawai_allowance WHERE replid='".$id_pegawai."'";
    	$data['isi']=$this->dbx->rows($sql);
    	
    	if ($data['isi']== NULL ) {
        	unset($data['isi']);
        	$sql="SELECT NULL as 'replid',NULL as 'nama', NULL as 'keterangan','1' as 'aktif',NULL as 'nilai',NULL as 'effective_date'";
        	$data['isi']=$this->dbx->rows($sql);
        }
    	return $data;
    }
    public function ubahallowance_p_db($data,$idx) {
		$this->db->where('replid',$idx);
		$this->db->update('pegawai_allowance', $data);
		if ($this->db->_error_number() == 0) {
			return true;
		} else {
			return false;
		}
	 }
	 public function tambahallowance_p_db($data) {
    	$this->db->trans_start();
        $this->db->insert('pegawai_allowance', $data);
        if ($this->db->affected_rows() > 0) {
               $this->db->trans_complete();
               return true;
                
        } else {
        	$this->db->trans_complete();
            return false;
        }
     }
    
    public function hapusallowance_p_db($id) {
        $this->db->where('replid',$id);
        $this->db->delete('pegawai_allowance');
        if ($this->db->_error_number() == 0) {
        	return true;
        } else {
            return false;
        }
    }
    
    //---------------------------------------------------------------------------------------------------------
	//------------------------------------------------------------------------------------------ DEDUCTION
	//---------------------------------------------------------------------------------------------------------
	
	// Read data from database to show data in admin page
    public function deduction_table($data) {
      	$sql = "SELECT * FROM pegawai_deduction
      			ORDER BY nama
      			";
		$data['data_table']=$this->dbx->data($sql);
		return $data;
    }
	
	public function ubahdeduction_db($id_pegawai,$data) {
    	$sql="SELECT * FROM pegawai_deduction WHERE replid='".$id_pegawai."'";
    	$data['isi']=$this->dbx->rows($sql);
    	
    	if ($data['isi']== NULL ) {
        	unset($data['isi']);
        	$sql="SELECT NULL as 'replid',NULL as 'nama', NULL as 'keterangan','1' as 'aktif',NULL as 'nilai',NULL as 'effective_date'";
        	$data['isi']=$this->dbx->rows($sql);
        }
    	return $data;
    }
    public function ubahdeduction_p_db($data,$idx) {
		$this->db->where('replid',$idx);
		$this->db->update('pegawai_deduction', $data);
		if ($this->db->_error_number() == 0) {
			return true;
		} else {
			return false;
		}
	 }
	 public function tambahdeduction_p_db($data) {
    	$this->db->trans_start();
        $this->db->insert('pegawai_deduction', $data);
        if ($this->db->affected_rows() > 0) {
               $this->db->trans_complete();
               return true;
                
        } else {
        	$this->db->trans_complete();
            return false;
        }
     }
    
    public function hapusdeduction_p_db($id) {
        $this->db->where('replid',$id);
        $this->db->delete('pegawai_deduction');
        if ($this->db->_error_number() == 0) {
        	return true;
        } else {
            return false;
        }
    }
    
    //---------------------------------------------------------------------------------------------------------
	//----------------------------------------------------------------------------------------- PEGAWAI ALLOWANCE
	//---------------------------------------------------------------------------------------------------------
	
	public function ubahuserallowance_db($id_pegawai,$iduserallowance,$data) {
    	$sql="SELECT * FROM pegawai_salary_allowance WHERE replid='".$iduserallowance."'";
    	$data['isi']=$this->dbx->rows($sql);
    	
    	if ($data['isi']== NULL ) {
        	unset($data['isi']);
        	$sql="SELECT NULL as 'pegawai_id',NULL as 'allowance_id', NULL as 'effective_date',NULL as 'nilai',NULL as 'type_id'";
        	$data['isi']=$this->dbx->rows($sql);
        }
        $data['allowance_opt'] = $this->dbx->opt("SELECT replid,nama FROM pegawai_allowance WHERE replid NOT IN (select allowance_id from pegawai_salary_allowance where pegawai_id='".$id_pegawai."') ORDER BY nama",'up');
    	$data['type_opt'] = $this->dbx->opt("SELECT replid,type as nama FROM pegawai_salary_reff ORDER BY type",'up');
    	return $data;
    }
    
    public function ubahuserallowance_p_db($data,$idx) {
		$this->db->where('replid',$idx);
		$this->db->update('pegawai_salary_allowance', $data);
		if ($this->db->_error_number() == 0) {
			return true;
		} else {
			return false;
		}
	 }
	 public function tambahuserallowance_p_db($data) {
    	$this->db->trans_start();
        $this->db->insert('pegawai_salary_allowance', $data);
        if ($this->db->affected_rows() > 0) {
               $this->db->trans_complete();
               return true;
                
        } else {
        	$this->db->trans_complete();
            return false;
        }
     }
    
    public function hapususerallowance_p_db($id) {
        $this->db->where('replid',$id);
        $this->db->delete('pegawai_salary_allowance');
        if ($this->db->_error_number() == 0) {
        	return true;
        } else {
            return false;
        }
    }
    
    //---------------------------------------------------------------------------------------------------------
	//----------------------------------------------------------------------------------------- PEGAWAI DEDUCTION
	//---------------------------------------------------------------------------------------------------------
	
	public function ubahuserdeduction_db($id_pegawai,$iduserdeduction,$data) {
    	$sql="SELECT * FROM pegawai_salary_deduction WHERE replid='".$iduserdeduction."'";
    	$data['isi']=$this->dbx->rows($sql);
    	
    	if ($data['isi']== NULL ) {
        	unset($data['isi']);
        	$sql="SELECT NULL as 'pegawai_id',NULL as 'deduction_id', NULL as 'effective_date',NULL as 'nilai',NULL as 'type_id'";
        	$data['isi']=$this->dbx->rows($sql);
        }
        $data['deduction_opt'] = $this->dbx->opt("SELECT replid,nama FROM pegawai_deduction WHERE replid NOT IN (select deduction_id from pegawai_salary_deduction where pegawai_id='".$id_pegawai."') ORDER BY nama",'up');
        $data['type_opt'] = $this->dbx->opt("SELECT replid,type as nama FROM pegawai_salary_reff ORDER BY type",'up');
    	return $data;
    }
    
    public function ubahuserdeduction_p_db($data,$idx) {
		$this->db->where('replid',$idx);
		$this->db->update('pegawai_salary_deduction', $data);
		if ($this->db->_error_number() == 0) {
			return true;
		} else {
			return false;
		}
	 }
	 public function tambahuserdeduction_p_db($data) {
    	$this->db->trans_start();
        $this->db->insert('pegawai_salary_deduction', $data);
        if ($this->db->affected_rows() > 0) {
               $this->db->trans_complete();
               return true;
                
        } else {
        	$this->db->trans_complete();
            return false;
        }
     }
    
    public function hapususerdeduction_p_db($id) {
        $this->db->where('replid',$id);
        $this->db->delete('pegawai_salary_deduction');
        if ($this->db->_error_number() == 0) {
        	return true;
        } else {
            return false;
        }
    }
        
}	
?>