<?php

Class ns_predikat_db extends CI_Model {
	public function __construct() {
		parent::__construct();
		$this->load->library('dbx');
	}

    // Read data from database to show data in admin page
    public function data() {
				$cari="";
				if($this->input->post('iddepartemen')<>""){
					$cari=$cari." AND iddepartemen= '".$this->input->post('iddepartemen')."'";
				}else{
					$cari=$cari." AND iddepartemen IN (".$this->dbx->sessionjenjangtext($this->session->userdata('dept')).") ";
				}

				if($this->input->post('predikattipe')<>""){
					$cari=$cari." AND predikattipe= '".$this->input->post('predikattipe')."'";
				}

      	$sql="SELECT * FROM ns_predikat
							WHERE replid IS NOT NULL
							".$cari."
							ORDER BY predikat";
      	$data['show_table']=$this->dbx->data($sql);
				$data['iddepartemen_opt'] = $this->dbx->opt("SELECT departemen as replid,departemen as nama FROM departemen WHERE replid IN (".$this->session->userdata('dept').") ORDER BY urutan",'up');
				$data['predikattipe_opt'] = $this->dbx->opt("SELECT DISTINCT predikattipe as replid,predikattipe as nama FROM ns_predikat ORDER BY predikattipe",'up');
				return $data;
	  }

     //TAMBAH
    public function tambah_db($id='',$data) {
    	$data['id']=$id;
      	$sql="SELECT *
      			FROM ns_predikat
      			WHERE replid='".$id."'";
        $data['isi'] = $this->dbx->rows($sql);

        if ($data['isi']== NULL ) {
        	unset($data['isi']);
					unset($data['isi']);
					$sql="SELECT ".$this->dbx->tablecolumn('ns_predikat').",1 as predikattipe,1 as aktif ";
        	$data['isi']=$this->dbx->rows($sql);
        }
				$data['iddepartemen_opt'] = $this->dbx->opt("SELECT departemen as replid,departemen as nama FROM departemen WHERE replid IN (".$this->session->userdata('dept').") ORDER BY urutan",'up');
      	return $data;
  }


   public function tambah_pdb($data) {
    	//echo print_r(array_values($data));die;
    	$this->db->trans_start();
        $this->db->insert('ns_predikat', $data);
        $insert_id = $this->db->insert_id();
        if ($this->db->affected_rows() > 0) {
               $this->db->trans_complete();
               return $insert_id;
        } else {
        	$this->db->trans_complete();
            return false;
        }
     }

     public function ubah_pdb($data,$id) {
        $this->db->where('replid',$id);
        $this->db->update('ns_predikat', $data);
        if ($this->db->_error_number() == 0) {
            return true;
        } else {
            return false;
        }
    }

    public function hapus_pdb($id) {
        // Query to check whether username already exist or not
        $this->db->where('replid',$id);
        $this->db->delete('ns_predikat');
        if ($this->db->_error_number() == 0) {
	        return true;
        } else {
            return false;
        }
    }
}

?>
