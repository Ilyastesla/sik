<?php

Class departemen_db extends CI_Model {
public function __construct() {
parent::__construct();
	$this->load->library('dbx');
}
    // Read data from database to show data in admin page
    public function data() {
				$cari="";
				if ($this->input->post('idcompany')<>""){
		    	$cari=$cari." AND d.idcompany='".$this->input->post('idcompany')."' ";
	    	}
      	$sql="SELECT d.*,c.nama as companytext
							FROM hrm_departemen d
							LEFT JOIN hrm_company c ON d.idcompany=c.replid
							WHERE d.idcompany=c.replid ".$cari."
							ORDER BY departemen";
				$data['show_table']=$this->dbx->data($sql);

				$data['idcompany_opt'] = $this->dbx->opt("SELECT replid, nama FROM hrm_company WHERE aktif=1 ORDER BY nama","up");
				return $data;
    }


    //TAMBAH
    //-------------------------------------------------------------------------------------------
    public function tambah_x($data,$id='') {
      	$sql="SELECT *
      			FROM hrm_departemen kk
      			WHERE kk.replid='".$id."'";
        $data['isi'] = $this->dbx->rows($sql);

        if ($data['isi']== NULL ) {
        	unset($data['isi']);
					$sql="SELECT ".$this->dbx->tablecolumn('hrm_departemen')." ,1 as aktif";
        	$data['isi']=$this->dbx->rows($sql);
        }

				$data['idcompany_opt'] = $this->dbx->opt("select replid,CONCAT(company_code,' ',nama) as nama from hrm_company WHERE aktif=1 ORDER BY nama",'up');
        return $data;
    }

    public function tambah($data) {
    	//echo print_r(array_values($data));die;
    	$this->db->trans_start();
        $this->db->insert('hrm_departemen', $data);
        if($this->db->_error_message()<>""){
	        return false;
        }else{
	        $insert_id = $this->db->insert_id();
		    if ($this->db->affected_rows() > 0) {
		           $this->db->trans_complete();
		           return $insert_id;
		    } else {
		    	$this->db->trans_complete();
		        return false;
		    }
        }
     }

	public function ubah($data,$id) {
		//echo var_dump($data);die;
		$this->db->where('replid',$id);
		$this->db->update('hrm_departemen', $data);
		if ($this->db->_error_number() == 0) {
		  return true;
		} else {
		  return false;
		}
	}

	public function hapus_db($id) {
	    // Query to check whether username already exist or not
	    $this->db->where('replid',$id);
	    $this->db->delete('hrm_departemen');
	    if ($this->db->_error_number() == 0) {
	    	return true;
	    } else {
	        return false;
	    }
    }
}
?>
