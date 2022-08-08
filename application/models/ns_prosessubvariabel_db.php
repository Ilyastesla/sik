<?php

Class ns_prosessubvariabel_db extends CI_Model {
	public function __construct() {
		parent::__construct();
		$this->load->library('dbx');
	}

    // Read data from database to show data in admin page
    public function data() {
      	$sql="SELECT psv.*,pv.prosesvariabel,pt.prosestipe,pt.iddepartemen
										,(SELECT COUNT(replid) FROM ns_pengembangandirivariabel WHERE idprosessubvariabel=psv.replid) as pakai
      			FROM ns_prosessubvariabel psv
      			LEFT JOIN ns_prosesvariabel pv ON pv.replid=psv.idprosesvariabel
						LEFT JOIN ns_prosestipe pt ON pt.replid=pv.idprosestipe
						WHERE pt.aktif=1 AND pv.aktif=1 AND pt.iddepartemen IN (SELECT departemen FROM departemen WHERE replid IN (".$this->session->userdata('dept')."))
      			ORDER BY psv.no_urut";
      	return $this->dbx->data($sql);
    }

     //TAMBAH
    public function tambah_db($id='',$data) {
    	$data['id']=$id;
      	$sql="SELECT *
      			FROM ns_prosessubvariabel
      			WHERE replid='".$id."'";
        $data['isi'] = $this->dbx->rows($sql);

        if ($data['isi']== NULL ) {
        	unset($data['isi']);
        	$sql="SELECT
        			NULL as replid,
					NULL as prosessubvariabel,
					NULL as idprosesvariabel,
					NULL as persentasemurnisv,
					NULL as no_urut,
					1 as aktif,
					NULL as keterangan,
					NULL as created_date,
					NULL as created_by,
					NULL as modified_date,
					NULL as modified_by
					";
        	$data['isi']=$this->dbx->rows($sql);
        }
        $data['idprosesvariabel_opt'] = $this->dbx->opt("SELECT pv.replid,CONCAT(pv.prosesvariabel,' (',pt.iddepartemen,')') as nama FROM ns_prosesvariabel pv INNER JOIN ns_prosestipe pt ON pv.idprosestipe=pt.replid WHERE pt.aktif=1 AND pv.aktif=1 AND pt.iddepartemen IN (SELECT departemen FROM departemen WHERE replid IN (".$this->session->userdata('dept').")) ORDER BY pt.iddepartemen,pv.prosesvariabel",'up');
        return $data;
  }


   public function tambah_pdb($data) {
    	//echo print_r(array_values($data));die;
    	$this->db->trans_start();
        $this->db->insert('ns_prosessubvariabel', $data);
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
        $this->db->update('ns_prosessubvariabel', $data);
        if ($this->db->_error_number() == 0) {
            return true;
        } else {
            return false;
        }
    }

    public function hapus_pdb($id) {
        // Query to check whether username already exist or not
        $this->db->where('replid',$id);
        $this->db->delete('ns_prosessubvariabel');
        if ($this->db->_error_number() == 0) {
	        return true;
        } else {
            return false;
        }
    }
}

?>
