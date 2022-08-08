<?php

Class ns_prosesvariabel_db extends CI_Model {
	public function __construct() {
		parent::__construct();
		$this->load->library('dbx');
	}

    // Read data from database to show data in admin page
    public function data() {
			$cari="";
			if ($this->input->post('iddepartemen')<>""){
				$cari=$cari." AND pt.iddepartemen='".$this->input->post('iddepartemen')."' ";
			}

			$sql="SELECT pv.*,pt.prosestipe,pt.iddepartemen
									,(SELECT COUNT(replid) FROM ns_prosessubvariabel WHERE idprosesvariabel=pv.replid) as pakai
      			FROM ns_prosesvariabel pv
      			LEFT JOIN ns_prosestipe pt ON pt.replid=pv.idprosestipe
						WHERE pt.aktif=1 ".$cari."
      			ORDER BY pv.no_urut";
      	$data['show_table']=$this->dbx->data($sql);
				$data['iddepartemen_opt'] = $this->dbx->opt("SELECT departemen as replid,departemen as nama FROM departemen WHERE aktif=1 AND replid IN (".$this->session->userdata('dept').") ORDER BY urutan",'up');
				return $data;
    }

     //TAMBAH
    public function tambah_db($id='',$data) {
    	$data['id']=$id;
      	$sql="SELECT *
      			FROM ns_prosesvariabel
      			WHERE replid='".$id."'";
        $data['isi'] = $this->dbx->rows($sql);

        if ($data['isi']== NULL ) {
        	unset($data['isi']);
        	$sql="SELECT
        			NULL as replid,
					NULL as prosesvariabel,
					NULL as idprosestipe,
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
        $data['idprosestipe_opt'] = $this->dbx->opt("SELECT replid,CONCAT(prosestipe,' (',iddepartemen,')') as nama FROM ns_prosestipe WHERE aktif=1 AND iddepartemen IN (SELECT departemen FROM departemen WHERE replid IN (".$this->session->userdata('dept').")) ORDER BY iddepartemen,prosestipe",'up');
        return $data;
  }


   public function tambah_pdb($data) {
    	//echo print_r(array_values($data));die;
    	$this->db->trans_start();
        $this->db->insert('ns_prosesvariabel', $data);
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
        $this->db->update('ns_prosesvariabel', $data);
        if ($this->db->_error_number() == 0) {
            return true;
        } else {
            return false;
        }
    }

    public function hapus_pdb($id) {
        // Query to check whether username already exist or not
        $this->db->where('replid',$id);
        $this->db->delete('ns_prosesvariabel');
        if ($this->db->_error_number() == 0) {
	        return true;
        } else {
            return false;
        }
    }
}

?>
