<?php

Class hrm_event_theme_db extends CI_Model {
public function __construct() {
parent::__construct();
	$this->load->library('dbx');
}
    // Read data from database to show data in admin page
    public function data() {
      	$sql="SELECT * FROM hrm_event_theme ORDER BY tema";
      	return $this->dbx->data($sql);
    }


    //TAMBAH
    //-------------------------------------------------------------------------------------------
    public function tambah_x($id='',$data) {
    	$data['id']=$id;
      	$sql="SELECT *
      			FROM hrm_event_theme kk
      			WHERE kk.replid='".$id."'";
        $data['isi'] = $this->dbx->rows($sql);

        if ($data['isi']== NULL ) {
        	unset($data['isi']);
        	$sql="SELECT
					NULL as tema,
					NULL as kkm,
					1 as aktif,
					NULL as created_date,
					NULL as created_by,
					NULL as modified_date,
					NULL as modified_by";
        	$data['isi']=$this->dbx->rows($sql);
        }

				//,"pelaksana"=>"pelaksana"
				$type_arr= array(""=>"Pilih...","peserta"=>"peserta","pemateri"=>"pemateri");
				$data['type_opt'] = $type_arr;

				$typedata_arr= array(""=>"Pilih...","combobox"=>"combobox","textarea"=>"textarea");
				$data['typedata_opt'] = $typedata_arr;
        return $data;
    }

    public function tambah($data) {
    	//echo print_r(array_values($data));die;
    	$this->db->trans_start();
        $this->db->insert('hrm_event_theme', $data);
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
		$this->db->update('hrm_event_theme', $data);
		if ($this->db->_error_number() == 0) {
		  return true;
		} else {
		  return false;
		}
	}

	public function hapus_db($id) {
	    // Query to check whether username already exist or not
	    $this->db->where('replid',$id);
	    $this->db->delete('hrm_event_theme');

			$this->db->where('idhrm_event_theme',$idx);
			$this->db->delete('hrm_event_test');

			$this->db->where('idhrm_event_theme',$idx);
			$this->db->delete('hrm_event_test_jawaban');

	    if ($this->db->_error_number() == 0) {
	    	return true;
	    } else {
	        return false;
	    }
    }

	public function view_db($id,$data) {
			$sql="SELECT * FROM hrm_event_theme
						WHERE replid='".$id."'";
		 $data['isi'] = $this->dbx->rows($sql);
		 $sqltest="SELECT t.*, j.*,t.idhrm_event_theme,t.replid as idhrm_event_test, j.replid as idhrm_event_test_jawaban
		 						FROM hrm_event_test t
								LEFT JOIN hrm_event_test_jawaban j ON t.replid=j.idhrm_event_test
		 					  WHERE t.idhrm_event_theme='".$id."' ORDER BY no_urut,j.jawaban ";
		//echo $sqltest;die;
		 $data['hrm_event_test'] = $this->dbx->data($sqltest);
		 return $data;
	}

	public function tambahtest_db($data,$idtheme,$idtest) {
		$where="";
		if(($idtest<>"") or ($idtest<>0)){
			$where="AND te.replid='".$idtest."'";
		}
		$sql="SELECT te.*,t.tema
						FROM hrm_event_theme  t
						INNER JOIN hrm_event_test te ON t.replid=te.idhrm_event_theme
						WHERE t.replid='".$idtheme."' ".$where;
		 //echo $sql;die;
		 $data['isi'] = $this->dbx->rows($sql);
		 return $data;
	}

	public function tambahtest_pdb($data) {
		//echo print_r(array_values($data));die;
		$this->db->trans_start();
			$this->db->insert('hrm_event_test', $data);
			$insert_id = $this->db->insert_id();
			if ($this->db->affected_rows() > 0) {
						 $this->db->trans_complete();
						 return $insert_id;
			} else {
				$this->db->trans_complete();
					return false;
			}
	 }

	 public function ubahtest_pdb($data,$idtest) {
	 	//echo var_dump($data);die;
	 	$this->db->where('replid',$idtest);
	 	$this->db->update('hrm_event_test', $data);
		//echo $this->db->last_query();die;
	 	if ($this->db->_error_number() == 0) {
	 		return true;
	 	} else {
	 		return false;
	 	}
	 }

	 public function hapustest_db($idx) {
		// Query to check whether username already exist or not
		$this->db->where('replid',$idx);
		$this->db->delete('hrm_event_test');

		$this->db->where('idhrm_event_test',$idx);
		$this->db->delete('hrm_event_test_jawaban');
		if ($this->db->_error_number() == 0) {
			return true;
		} else {
				return false;
		}
	}

	public function tambahjawaban_db($data,$idtheme,$idtest,$id) {
		$where="";
		//if(($id<>"") or ($id<>0)){
			$where="AND j.replid='".$id."'";
		//}
		$sql="SELECT j.*,te.test,t.tema,te.idhrm_event_theme,te.replid as idhrm_event_test
						FROM hrm_event_test te
						INNER JOIN hrm_event_theme t ON t.replid=te.idhrm_event_theme
						LEFT JOIN hrm_event_test_jawaban j ON t.replid=j.idhrm_event_theme AND te.replid=j.idhrm_event_test ".$where."
						WHERE t.replid='".$idtheme."' AND te.replid='".$idtest."' ";
		 //echo $sql;die;
		 $data['isi'] = $this->dbx->rows($sql);
		 return $data;
	}

	public function tambahjawaban_pdb($data) {
		//echo print_r(array_values($data));die;
		$this->db->trans_start();
			$this->db->insert('hrm_event_test_jawaban', $data);
			$insert_id = $this->db->insert_id();
			if ($this->db->affected_rows() > 0) {
						 $this->db->trans_complete();
						 return $insert_id;
			} else {
				$this->db->trans_complete();
					return false;
			}
	 }

public function ubahjawaban_pdb($data,$id) {
	//echo var_dump($data);die;
	$this->db->where('replid',$id);
	$this->db->update('hrm_event_test_jawaban', $data);
	if ($this->db->_error_number() == 0) {
		return true;
	} else {
		return false;
	}
}

public function hapusjawaban_db($id) {
		// Query to check whether username already exist or not
		$this->db->where('replid',$id);
		$this->db->delete('hrm_event_test_jawaban');

		if ($this->db->_error_number() == 0) {
			return true;
		} else {
				return false;
		}
	}
}
?>
