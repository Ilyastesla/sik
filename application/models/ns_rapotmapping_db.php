<?php
Class ns_rapotmapping_db extends CI_Model {
	public function __construct() {
		parent::__construct();
		$this->load->library('dbx');
	}

    // Read data from database to show data in admin page
    public function data() {
			$cari="";
			//if ($this->input->post('iddepartemen')<>""){
				$cari=$cari." AND pv.iddepartemen='".$this->input->post('iddepartemen')."' ";
			//}

			if ($this->session->userdata('idregion')<>""){
				$cari=$cari." AND pv.idregion='".$this->session->userdata('idregion')."' ";
			}
			if ($this->session->userdata('idmatpelkelompok')<>""){
				$cari=$cari." AND pv.idmatpelkelompok='".$this->session->userdata('idmatpelkelompok')."' ";
			}
			if ($this->session->userdata('idrapottipe')<>""){
				$cari=$cari." AND pv.idrapottipe='".$this->session->userdata('idrapottipe')."' ";
			}
			//WHERE pv.iddepartemen IN (SELECT departemen FROM departemen WHERE replid IN (".$this->session->userdata('dept')."))
      	$sql="SELECT pv.*, rt.iddepartemen,r.region,CONCAT(rt.rapottipe,' ',rt.keterangan) as rapottipe,CONCAT('[',mk.iddepartemen,'] ',mk.matpelkelompok) as matpelkelompok,rt.aktif
										,(SELECT COUNT(r.replid) FROM ns_rapot r
										INNER JOIN tahunajaran ta ON r.idtahunajaran=ta.replid
										WHERE rt.replid=r.idrapottipe AND ta.aktif<>1) as pakai
      			FROM ns_rapotmapping pv
      			LEFT JOIN regional r ON r.replid=pv.idregion
      			LEFT JOIN ns_rapottipe rt ON rt.replid=pv.idrapottipe
      			LEFT JOIN ns_matpelkelompok mk ON mk.replid=pv.idmatpelkelompok
						WHERE rt.iddepartemen IN (SELECT departemen FROM departemen WHERE replid IN (".$this->session->userdata('dept')."))
						 ".$cari."
						ORDER BY rt.iddepartemen,rt.rapottipe,mk.matpelkelompok,r.region,rt.aktif";
      	$data['show_table']=$this->dbx->data($sql);

				$data['iddepartemen_opt'] = $this->dbx->opt("SELECT departemen as replid,departemen as nama FROM departemen WHERE aktif=1 AND replid IN (".$this->session->userdata('dept').") ORDER BY urutan",'up');
				$data['idregion_opt'] = $this->dbx->opt("SELECT replid,region as nama FROM regional ORDER BY nama",'up');
        $data['idmatpelkelompok_opt'] = $this->dbx->opt("SELECT replid,CONCAT('[',iddepartemen,'] ',matpelkelompok) as nama FROM ns_matpelkelompok WHERE aktif=1 AND iddepartemen='".$this->input->post('iddepartemen')."' ORDER BY nama",'up');
        $data['idrapottipe_opt'] = $this->dbx->opt("SELECT replid,CONCAT('[',iddepartemen,'] ',rapottipe,' ',keterangan, ' (',IF(aktif=1,'A','T'),')') as nama FROM ns_rapottipe WHERE iddepartemen='".$this->input->post('iddepartemen')."' ORDER BY nama ",'up');
      	return $data;
    }

     //TAMBAH
    public function tambah_db($id='',$data) {
    	$data['id']=$id;
      	$sql="SELECT *
      			FROM ns_rapotmapping
      			WHERE replid='".$id."'";
        $data['isi'] = $this->dbx->rows($sql);

        if ($data['isi']== NULL ) {
        	unset($data['isi']);
        	$sql="SELECT
		        	NULL as replid,
        			NULL as iddepartemen,
					NULL as idregion,
					NULL as idrapottipe,
					NULL as idmatpelkelompok,
					0 as persentase,
					0 as nonreguler,
					NULL as created_date,
					NULL as created_by,
					NULL as modified_date,
					NULL as modified_by
					";
        	$data['isi']=$this->dbx->rows($sql);
        }

        $data['iddepartemen_opt'] = $this->dbx->opt("SELECT departemen as replid,departemen as nama FROM departemen WHERE replid IN (".$this->session->userdata('dept').")  ORDER BY urutan",'up');
        $data['idregion_opt'] = $this->dbx->opt("SELECT replid,region as nama FROM regional ORDER BY nama",'up');
        $data['idmatpelkelompok_opt'] = $this->dbx->opt("SELECT replid,CONCAT('[',iddepartemen,'] ',matpelkelompok) as nama FROM ns_matpelkelompok WHERE aktif=1 AND iddepartemen IN (SELECT departemen FROM departemen WHERE replid IN (".$this->session->userdata('dept').")) ORDER BY nama",'up');
        $data['idrapottipe_opt'] = $this->dbx->opt("SELECT replid,CONCAT('[',iddepartemen,'] ',rapottipe,' ',keterangan) as nama FROM ns_rapottipe WHERE aktif=1 AND iddepartemen IN (SELECT departemen FROM departemen WHERE replid IN (".$this->session->userdata('dept')."))ORDER BY nama ",'up');
        return $data;
  }


   public function tambah_pdb($data) {
    	//echo print_r(array_values($data));die;
    	$this->db->trans_start();
        $this->db->insert('ns_rapotmapping', $data);
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
        $this->db->update('ns_rapotmapping', $data);
        if ($this->db->_error_number() == 0) {
            return true;
        } else {
            return false;
        }
    }


	public function mapping_db($id,$data) {
				$sql="SELECT pv.*, rt.iddepartemen,r.region,CONCAT(rt.rapottipe,' ',rt.keterangan) as rapottipe,mk.matpelkelompok,rt.aktif
      			FROM ns_rapotmapping pv
      			LEFT JOIN regional r ON r.replid=pv.idregion
      			LEFT JOIN ns_rapottipe rt ON rt.replid=pv.idrapottipe
      			LEFT JOIN ns_matpelkelompok mk ON mk.replid=pv.idmatpelkelompok
      			WHERE pv.replid='".$id."'";
      	$data['isi'] = $this->dbx->rows($sql);

				//AND t.iddepartemen IN (SELECT departemen FROM departemen WHERE replid IN (".$this->session->userdata('dept')."))
      	$sql="SELECT psv.*
      			,(SELECT nilai FROM ns_rapotmappingvariabel WHERE idrapotmapping='".$id."' AND idprosessubvariabel=psv.replid) as nilai
      			,v.prosesvariabel,t.prosestipe
      			FROM ns_prosessubvariabel psv
				INNER JOIN ns_prosesvariabel v ON psv.idprosesvariabel=v.replid
				INNER JOIN ns_prosestipe t ON v.idprosestipe=t.replid
						WHERE t.aktif=1 AND v.aktif=1 AND psv.aktif=1
									AND t.iddepartemen='".$data['isi']->iddepartemen."'
      			ORDER BY psv.no_urut";
      	$data['subvariabelproses']=$this->dbx->data($sql);

      	$sql="SELECT pdv.*
      			,(SELECT nilai FROM ns_rapotmappingpengembangandiri WHERE idrapotmapping='".$id."' AND idpengembangandirivariabel=pdv.replid) as nilai
      			,v.prosesvariabel,t.prosestipe
      			,psv.replid as idpsv,psv.prosessubvariabel
      			FROM ns_pengembangandirivariabel pdv
      			INNER JOIN ns_prosessubvariabel psv ON psv.replid=pdv.idprosessubvariabel
      			INNER JOIN ns_rapotmappingvariabel rmv ON psv.replid=rmv.idprosessubvariabel
      			INNER JOIN ns_prosesvariabel v ON psv.idprosesvariabel=v.replid
						INNER JOIN ns_prosestipe t ON v.idprosestipe=t.replid
      			WHERE t.aktif=1 AND v.aktif=1 AND psv.aktif=1 AND rmv.idrapotmapping='".$id."' AND rmv.nilai>0
									AND t.iddepartemen IN (SELECT departemen FROM departemen WHERE replid IN (".$this->session->userdata('dept')."))
									";
      	$data['pengembangandiri']=$this->dbx->data($sql);
      	return $data;
    }

    public function view_db($id,$data) {
      	$sql="SELECT pv.*, rt.iddepartemen,r.region,CONCAT(rt.rapottipe,' ',rt.keterangan) as rapottipe,mk.matpelkelompok,rt.aktif
										,(SELECT COUNT(rpt.replid) FROM ns_rapot rpt
										INNER JOIN tahunajaran ta ON rpt.idtahunajaran=ta.replid
										WHERE rt.replid=rpt.idrapottipe AND ta.aktif<>1) as pakai
      			FROM ns_rapotmapping pv
      			LEFT JOIN regional r ON r.replid=pv.idregion
      			LEFT JOIN ns_rapottipe rt ON rt.replid=pv.idrapottipe
      			LEFT JOIN ns_matpelkelompok mk ON mk.replid=pv.idmatpelkelompok
      			WHERE pv.replid='".$id."'";
      	$data['isi'] = $this->dbx->rows($sql);

      	$sql="SELECT psv.*
      			,rmv.nilai
      			,v.prosesvariabel,t.prosestipe
      			FROM ns_rapotmappingvariabel rmv
      			INNER JOIN ns_prosessubvariabel psv ON psv.replid=rmv.idprosessubvariabel
				INNER JOIN ns_prosesvariabel v ON psv.idprosesvariabel=v.replid
				INNER JOIN ns_prosestipe t ON v.idprosestipe=t.replid
				WHERE rmv.nilai<>0 AND idrapotmapping='".$id."'
      			ORDER BY psv.no_urut";
      	$data['subvariabelproses']=$this->dbx->data($sql);

       	return $data;
    }

    public function pengembangandirivariabelshow_db($replid,$idrapotmapping){
    	$sql="SELECT pdv.*
      			,(SELECT nilai FROM ns_rapotmappingpengembangandiri WHERE idrapotmapping='".$idrapotmapping."' AND idpengembangandirivariabel=pdv.replid) as nilai
      			FROM ns_pengembangandirivariabel pdv
      			INNER JOIN ns_prosessubvariabel psv ON psv.replid=pdv.idprosessubvariabel
      			INNER JOIN ns_rapotmappingvariabel rmv ON psv.replid=rmv.idprosessubvariabel
      			WHERE pdv.idprosessubvariabel='".$replid."' AND rmv.idrapotmapping='".$idrapotmapping."'";
        //echo $sql;
    	$rowpd=$this->dbx->data($sql);
    	return $rowpd;
    }


    // rapotmapping
	//-------------------------------------------------------------------------------------------
    public function tambahrapotmappingvariabel_db($data) {
    	//echo print_r(array_values($data));die;
    	$this->db->trans_start();
        $this->db->insert('ns_rapotmappingvariabel', $data);
        $insert_id = $this->db->insert_id();
        if ($this->db->affected_rows() > 0) {
               $this->db->trans_complete();
               return $insert_id;
        } else {
        	$this->db->trans_complete();
            return false;
        }
     }

    public function hapusrapotmappingvariabel_db($id) {
        // Query to check whether username already exist or not
        $this->db->where('idrapotmapping',$id);
        $this->db->delete('ns_rapotmappingvariabel');
        if ($this->db->_error_number() == 0) {
	        return true;
        } else {
            return false;
        }
    }

    // pengembangan DIri
	//-------------------------------------------------------------------------------------------

    public function tambahrapotmappingpengembangandiri_db($data) {
    	//echo print_r(array_values($data));die;
    	$this->db->trans_start();
        $this->db->insert('ns_rapotmappingpengembangandiri', $data);
        $insert_id = $this->db->insert_id();
        if ($this->db->affected_rows() > 0) {
               $this->db->trans_complete();
               return $insert_id;
        } else {
        	$this->db->trans_complete();
            return false;
        }
     }

    public function hapusrapotmappingpengembangandiri_db($id) {
        // Query to check whether username already exist or not
        $this->db->where('idrapotmapping',$id);
        $this->db->delete('ns_rapotmappingpengembangandiri');
        if ($this->db->_error_number() == 0) {
	        return true;
        } else {
            return false;
        }
    }

    // HAPUS ALL
    //-------------------------------------------------------------------------------------------
    public function hapus_pdb($id) {
        // Query to check whether username already exist or not
        $this->db->where('replid',$id);
        $this->db->delete('ns_rapotmapping');
        if ($this->db->_error_number() == 0) {
	        return true;
        } else {
            return false;
        }
    }
}

?>
