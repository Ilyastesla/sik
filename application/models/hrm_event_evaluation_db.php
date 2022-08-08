<?php

Class hrm_event_evaluation_db extends CI_Model {
public function __construct() {
parent::__construct();
	$this->load->library('dbx');
}
    // Read data from database to show data in admin page
    public function data() {
      	$sql="SELECT * FROM hrm_event_evaluation ORDER BY no_urut";
      	return $this->dbx->data($sql);
    }


    //TAMBAH
    //-------------------------------------------------------------------------------------------
    public function tambah_x($id='',$data) {
    	$data['id']=$id;
      	$sql="SELECT *
      			FROM hrm_event_evaluation kk
      			WHERE kk.replid='".$id."'";
        $data['isi'] = $this->dbx->rows($sql);

        if ($data['isi']== NULL ) {
        	unset($data['isi']);
        	$sql="SELECT
					NULL as head,
					NULL as hrm_event_evaluation,
					0 as max_skor,
					NULL as target_skor,
					(SELECT (MAX(no_urut))+1 FROM hrm_event_evaluation) as no_urut,
					NULL as umum,
					1 as aktif,
					NULL as type,
					NULL as typedata,
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
        $this->db->insert('hrm_event_evaluation', $data);
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
		$this->db->update('hrm_event_evaluation', $data);
		if ($this->db->_error_number() == 0) {
		  return true;
		} else {
		  return false;
		}
	}

	public function hapus_db($id) {
	    // Query to check whether username already exist or not
	    $this->db->where('replid',$id);
	    $this->db->delete('hrm_event_evaluation');

	    if ($this->db->_error_number() == 0) {
	    	return true;
	    } else {
	        return false;
	    }
    }
}
?>
