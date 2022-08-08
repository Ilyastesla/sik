<?php

Class ns_predikatgraph_db extends CI_Model {
	public function __construct() {
		parent::__construct();
		$this->load->library('dbx');
	}

    // Read data from database to show data in admin page
    public function data() {
      	$sql="SELECT pg.*,pdv.pengembangandirivariabel,pt.prosestipe,pt.iddepartemen
										FROM ns_predikatgraph pg
										INNER JOIN ns_pengembangandirivariabel pdv ON pdv.replid=pg.idpengembangandiri
										INNER JOIN ns_prosessubvariabel ps ON ps.replid=pdv.idprosessubvariabel
										INNER JOIN ns_prosesvariabel pv ON pv.replid=ps.idprosesvariabel
										INNER JOIN ns_prosestipe pt ON pt.replid=pv.idprosestipe
										WHERE pt.aktif=1 AND pv.aktif=1 AND ps.aktif=1
															 AND pt.iddepartemen IN (SELECT departemen FROM departemen WHERE replid IN (".$this->session->userdata('dept')."))
										ORDER BY pt.iddepartemen,pt.prosestipe,pdv.pengembangandirivariabel,pg.predikatgraph";
      	return $this->dbx->data($sql);
    }

     //TAMBAH
    public function tambah_db($id='',$data) {
    	$data['id']=$id;
      	$sql="SELECT pg.*,pdv.replid as idpengembangandiri,pt.replid as idprosestipe,ps.replid as idprosessubvariabel,pv.replid as idprosesvariabel
      			FROM ns_predikatgraph pg
						INNER JOIN ns_pengembangandirivariabel pdv ON pdv.replid=pg.idpengembangandiri
						INNER JOIN ns_prosessubvariabel ps ON ps.replid=pdv.idprosessubvariabel
						INNER JOIN ns_prosesvariabel pv ON pv.replid=ps.idprosesvariabel
						INNER JOIN ns_prosestipe pt ON pt.replid=pv.idprosestipe
      			WHERE pg.replid='".$id."'";
        $data['isi'] = $this->dbx->rows($sql);

        if ($data['isi']== NULL ) {
        	unset($data['isi']);
        	$sql="SELECT
					NULL as idprosestipe,
					NULL as idprosesvariabel,
					NULL as idprosessubvariabel,
					NULL as idpengembangandiri,
        	NULL as replid,
					NULL as predikatgraph,
					NULL as dari,
					NULL as sampai,
					1 as aktif,
					NULL as deskripsi,
					NULL as created_date,
					NULL as created_by,
					NULL as modified_date,
					NULL as modified_by
					";
        	$data['isi']=$this->dbx->rows($sql);
        }
				$data['idprosestipe_opt'] = $this->dbx->opt("SELECT replid,CONCAT('[',iddepartemen,'] ',prosestipe, ' (',IF(aktif=1,'A','T'),')') as nama FROM ns_prosestipe WHERE aktif=1 AND iddepartemen IN (SELECT departemen FROM departemen  WHERE replid IN (".$this->session->userdata('dept').")) ORDER BY aktif DESC,nama ASC ",'up');

				if (urldecode($this->uri->segment(4))<>""){$idprosestipe=urldecode($this->uri->segment(4));}else{$idprosestipe=$data["isi"]->idprosestipe;}
				$data['idprosesvariabel_opt'] = $this->dbx->opt("SELECT replid,prosesvariabel as nama FROM ns_prosesvariabel WHERE aktif=1 AND idprosestipe='".$idprosestipe."' ORDER BY prosesvariabel",'up');

				if (urldecode($this->uri->segment(5))<>""){$idprosesvariabel=urldecode($this->uri->segment(5));}else{$idprosesvariabel=$data["isi"]->idprosesvariabel;}
				$data['idprosessubvariabel_opt'] = $this->dbx->opt("SELECT replid,prosessubvariabel as nama FROM ns_prosessubvariabel WHERE aktif=1 AND idprosesvariabel='".$idprosesvariabel."' ORDER BY prosessubvariabel",'up');

				if (urldecode($this->uri->segment(5))){$idprosessubvariabel=urldecode($this->uri->segment(6));}else{$idprosessubvariabel=$data["isi"]->idprosessubvariabel;}
				$data['idpengembangandiri_opt'] = $this->dbx->opt("SELECT replid,pengembangandirivariabel as nama FROM ns_pengembangandirivariabel WHERE aktif=1 AND idprosessubvariabel='".$idprosessubvariabel."' ORDER BY pengembangandirivariabel",'up');
        return $data;
  }


   public function tambah_pdb($data) {
    	//echo print_r(array_values($data));die;
    	$this->db->trans_start();
        $this->db->insert('ns_predikatgraph', $data);
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
        $this->db->update('ns_predikatgraph', $data);
        if ($this->db->_error_number() == 0) {
            return true;
        } else {
            return false;
        }
    }

    public function hapus_pdb($id) {
        // Query to check whether username already exist or not
        $this->db->where('replid',$id);
        $this->db->delete('ns_predikatgraph');
        if ($this->db->_error_number() == 0) {
	        return true;
        } else {
            return false;
        }
    }
}

?>
