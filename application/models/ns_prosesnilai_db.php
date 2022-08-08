<?php

Class ns_prosesnilai_db extends CI_Model {
	public function __construct() {
		parent::__construct();
		$this->load->library('dbx');
	}

    // Read data from database to show data in admin page
    public function data() {

      	$sql="SELECT pv.*,ps.region,d.periode,kmp.kelompokmatpel
      			FROM ns_prosesnilai pv
      			LEFT JOIN ns_periode d ON d.replid=pv.idperiode
      			LEFT JOIN regional ps ON ps.replid=pv.idregional
      			LEFT JOIN ns_kelompokmatpel kmp ON kmp.replid=pv.idkelompokmatpel
      			ORDER BY pv.prosesnilai";
      	return $this->dbx->data($sql);
    }

     //TAMBAH
    public function tambah_db($id='',$data) {
    	$data['id']=$id;
      	$sql="SELECT *
      			FROM ns_prosesnilai
      			WHERE replid='".$id."'";
        $data['isi'] = $this->dbx->rows($sql);

        if ($data['isi']== NULL ) {
        	unset($data['isi']);
        	$sql="SELECT
        			NULL as replid,
					NULL as prosesnilai,
					NULL as idperiode,
					NULL as idregional,
					NULL as idkelompokmatpel,
					1 as aktif,
					NULL as keterangan,
					NULL as created_date,
					NULL as created_by,
					NULL as modified_date,
					NULL as modified_by
					";
        	$data['isi']=$this->dbx->rows($sql);
        }
        $data['idperiode_opt'] = $this->dbx->opt("SELECT replid,periode as nama FROM ns_periode ORDER BY nama",'up');
        $data['idregional_opt'] = $this->dbx->opt("SELECT replid,region as nama FROM regional ORDER BY nama",'up');
        $data['idkelompokmatpel_opt'] = $this->dbx->opt("SELECT replid,kelompokmatpel as nama FROM ns_kelompokmatpel ORDER BY nama",'up');
        return $data;
  }


   public function tambah_pdb($data) {
    	//echo print_r(array_values($data));die;
    	$this->db->trans_start();
        $this->db->insert('ns_prosesnilai', $data);
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
        $this->db->update('ns_prosesnilai', $data);
        if ($this->db->_error_number() == 0) {
            return true;
        } else {
            return false;
        }
    }

    public function hapus_pdb($id) {
        // Query to check whether username already exist or not
        $this->db->where('replid',$id);
        $this->db->delete('ns_prosesnilai');
        if ($this->db->_error_number() == 0) {
	        return true;
        } else {
            return false;
        }
    }

    //ROLE MAP
    //-------------------------------------------------------------------------------------------
    public function tambah_map_variabel_db($id='',$data) {
    	$data['id']=$id;
      	$sql="SELECT pv.*,ps.region,d.periode,kmp.kelompokmatpel
      			FROM ns_prosesnilai pv
      			LEFT JOIN ns_periode d ON d.replid=pv.idperiode
      			LEFT JOIN regional ps ON ps.replid=pv.idregional
      			LEFT JOIN ns_kelompokmatpel kmp ON kmp.replid=pv.idkelompokmatpel
      			WHERE pv.replid='".$id."'";

        $data['isi'] = $this->dbx->rows($sql);
        $data['variabel_opt'] = $this->dbx->data("SELECT mn.replid,CONCAT ('[',m.nama,'] ',mn.nama) as nama
        											,(SELECT '1' FROM hrm_role_map WHERE role_id='".$id."' AND submenu_id=mn.replid) as checked
        											FROM hrm_menu mn
													INNER JOIN hrm_modul m ON mn.modul_id=m.replid
													WHERE mn.aktif=1
													ORDER BY m.nama,mn.nama
													",'up');
        return $data;
    }

}


?>
