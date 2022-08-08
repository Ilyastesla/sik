<?php

Class ns_prosestipe_db extends CI_Model {
	public function __construct() {
		parent::__construct();
		$this->load->library('dbx');
	}

    public function data() {
				$cari="";
				if ($this->input->post('iddepartemen')<>""){
					$cari=$cari." AND pt.iddepartemen='".$this->input->post('iddepartemen')."' ";
				}
				if ($this->input->post('idcompany')<>""){
					$cari=$cari." AND pt.replid IN (SELECT idvariabel FROM ns_reff_company WHERE idcompany='".$this->input->post('idcompany')."' AND tipe='ns_prosestipe' ) ";
				}

      	$sql="SELECT pt.*
											,(SELECT COUNT(*) FROM ns_prosesvariabel WHERE idprosestipe=pt.replid) as pakai
				 				FROM ns_prosestipe pt
								WHERE pt.replid<>0
								".$cari."
								ORDER BY pt.no_urut";
				//echo $sql;die;
				$data['show_table']=$this->dbx->data($sql);
				$data['iddepartemen_opt'] = $this->dbx->opt("SELECT departemen as replid,departemen as nama FROM departemen WHERE aktif=1 AND replid IN (".$this->session->userdata('dept').") ORDER BY urutan",'up');
				$data['idcompany_opt'] = $this->dbx->opt("SELECT replid,nama as nama FROM hrm_company ORDER BY nama",'up');
      	return $data;
    }

     //TAMBAH
    public function tambah_db($id='',$data) {
    	$data['id']=$id;
      	$sql="SELECT *
      			FROM ns_prosestipe
      			WHERE replid='".$id."'";
        $data['isi'] = $this->dbx->rows($sql);

        if ($data['isi']== NULL ) {
        	unset($data['isi']);
        	$sql="SELECT
        			NULL as replid,
					NULL as prosestipe,
					NULL as iddepartemen,
					0 as nilaiwali,
					1 as aktif,
					NULL as no_urut,
					NULL as keterangan,
					NULL as created_date,
					NULL as created_by,
					NULL as modified_date,
					NULL as modified_by
					";
        	$data['isi']=$this->dbx->rows($sql);
        }

				$data['iddepartemen_opt'] = $this->dbx->opt("SELECT departemen as replid,departemen as nama FROM departemen WHERE aktif=1 AND replid IN (".$this->session->userdata('dept').") ORDER BY urutan",'up');
				$data['idcompany_opt'] = $this->dbx->data("SELECT replid,nama as nama FROM hrm_company ORDER BY nama",'up');
				$data['idreff_company_opt'] = $this->dbx->rowscsv("SELECT idcompany as var FROM ns_reff_company WHERE idvariabel='".$data['isi']->replid."' AND tipe='ns_prosestipe'",'up');

        return $data;
  }


   public function tambah_pdb($data) {
    	//echo print_r(array_values($data));die;
    	$this->db->trans_start();
        $this->db->insert('ns_prosestipe', $data);
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
        $this->db->update('ns_prosestipe', $data);
        if ($this->db->_error_number() == 0) {
            return true;
        } else {
            return false;
        }
    }

    public function hapus_pdb($id) {
        // Query to check whether username already exist or not
        $this->db->where('replid',$id);
        $this->db->delete('ns_prosestipe');
        if ($this->db->_error_number() == 0) {
	        return true;
        } else {
            return false;
        }
    }
}

?>
