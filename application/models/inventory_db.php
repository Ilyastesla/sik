<?php

Class inventory_db extends CI_Model {
	public function __construct() {
	parent::__construct();
		$this->load->library('dbx');
	}

    //---------------------------------------------------------------------------------------------------------
	//------------------------------------------------------------------------------------------ KELOMPOK
	//---------------------------------------------------------------------------------------------------------

	// Read data from database to show data in admin page
    public function inventory_table($data) {
      	$sql = "SELECT k.*,k2.nama as parent
									, (SELECT COUNT(replid) FROM inventory_material WHERE idkelompok=k.replid) as jmlmat
									,f.nama as fiskaltext
								FROM inventory_kelompok k
		      			LEFT JOIN inventory_kelompok k2 ON k.parent=k2.replid
								LEFT JOIN inventory_fiskal f ON f.replid=k.idfiskal
		      			ORDER BY k.nama
		      			";
				$data['data_table']=$this->dbx->data($sql);
				return $data;
    }

	public function ubahinventory_db($id_inventory,$data) {
    	$sql="SELECT * FROM inventory_kelompok WHERE replid='".$id_inventory."'";
    	$data['isi']=$this->dbx->rows($sql);

    	if ($data['isi']== NULL ) {
        	unset($data['isi']);
        	$sql="SELECT NULL as 'replid', NULL as 'kode',NULL as 'nama',NULL as 'idfiskal', NULL as 'keterangan',NULL as 'parent','1' as 'aktif'";
        	$data['isi']=$this->dbx->rows($sql);
        }

    	$data['parent_opt'] = $this->dbx->opt("SELECT replid,nama FROM inventory_kelompok ORDER BY nama",'up');
			$data['fiskal_opt'] = $this->dbx->opt("SELECT replid,nama FROM inventory_fiskal ORDER BY nama",'up');
    	return $data;
    }
    public function ubahinventory_p_db($data,$idx) {
		$this->db->where('replid',$idx);
		$this->db->update('inventory_kelompok', $data);
		if ($this->db->_error_number() == 0) {
			return true;
		} else {
			return false;
		}
	 }
	 public function tambahinventory_p_db($data) {
    	$this->db->trans_start();
        $this->db->insert('inventory_kelompok', $data);
        if ($this->db->affected_rows() > 0) {
               $this->db->trans_complete();
               return true;

        } else {
        	$this->db->trans_complete();
            return false;
        }
     }

    public function hapusinventory_p_db($id) {
        $this->db->where('replid',$id);
        $this->db->delete('inventory_kelompok');
        if ($this->db->_error_number() == 0) {
        	return true;
        } else {
            return false;
        }
    }
    //---------------------------------------------------------------------------------------------------------
	//------------------------------------------------------------------------------------------ MATERIAL
	//---------------------------------------------------------------------------------------------------------

	// Read data from database to show data in admin page
    public function material_table($data) {
      	$sql = "SELECT mt.*,CONCAT(mr.nama,' ',mt.nama)as nama,k.nama as kelompok,mr.nama as merek,mf.nama as fiskal,ir.reff_nama as kelompok_inventaris
										,(SELECT COUNT(replid) FROM inventory_permintaan_barang_mat WHERE idmaterial=mt.replid) as pakai
      			FROM inventory_material mt
      			LEFT JOIN inventory_kelompok k ON mt.idkelompok=k.replid
      			LEFT JOIN inventory_merek mr ON mt.idmerek=mr.replid
      			LEFT JOIN inventory_fiskal mf ON mt.idfiskal=mf.replid
      			LEFT JOIN inventory_reff ir ON ir.replid=mt.idkelompok_inventaris AND ir.grup='inventaris'
      			ORDER BY nama
      			";
		$data['data_table']=$this->dbx->data($sql);
		return $data;
    }

	public function ubahmaterial_db($id_inventory,$data) {
    	$sql="SELECT mt.*,mr.nama as merektext FROM inventory_material mt
    			LEFT JOIN inventory_merek mr ON mt.idmerek=mr.replid
    			WHERE mt.replid='".$id_inventory."'";
    	$data['isi']=$this->dbx->rows($sql);

    	if ($data['isi']== NULL ) {
        	unset($data['isi']);
        	$sql="SELECT NULL as 'replid',NULL as 'kode',NULL as 'nama',
	        		NULL as 'idkelompok',
	        		NULL as 'idkelompok_inventaris',
	        		NULL as 'idmerek',
	        		NULL as 'idfiskal',
	        		NULL as 'spesifikasi',
	        		NULL as 'inventaris',
	        		NULL as 'merektext',
							0 as 'stock_min',
	        		'1' as 'aktif'";
        	$data['isi']=$this->dbx->rows($sql);
        }
        $data['kelompok_opt'] = $this->dbx->opt("SELECT replid,nama FROM inventory_kelompok ORDER BY nama",'up');
        $data['kelompok_inventaris_opt'] = $this->dbx->opt("SELECT replid,reff_nama as nama FROM inventory_reff WHERE grup='inventaris' ORDER BY reff_nama",'up');
        $data['merek_opt'] = $this->dbx->opt("SELECT replid,nama FROM inventory_merek ORDER BY nama",'up');
        //$data['fiskal_opt'] = $this->dbx->opt("SELECT replid,nama FROM inventory_fiskal ORDER BY nama",'up');
    	return $data;
    }

    public function ubahmaterial_p_db($data,$idx) {
		$this->db->where('replid',$idx);
		$this->db->update('inventory_material', $data);
		if ($this->db->_error_number() == 0) {
			return true;
		} else {
			return false;
		}
	 }

	 public function tambahmaterial_p_db($data) {
    	$this->db->trans_start();
        $this->db->insert('inventory_material', $data);
				$insert_id = $this->db->insert_id();
        if ($this->db->affected_rows() > 0) {
               $this->db->trans_complete();
               return $insert_id;

        } else {
        		$this->db->trans_complete();
            return false;
        }
     }

		 public function tambahmaterialpermintaan_p_db($data) {
    		$this->db->trans_start();
        $this->db->insert('inventory_permintaan_barang_mat', $data);
				$insert_id = $this->db->insert_id();
        if ($this->db->affected_rows() > 0) {
               $this->db->trans_complete();
               return $insert_id;

        } else {
        		$this->db->trans_complete();
            return false;
        }
     }

    public function hapusmaterial_p_db($id) {
        $this->db->where('replid',$id);
        $this->db->delete('inventory_material');
        if ($this->db->_error_number() == 0) {
        	return true;
        } else {
            return false;
        }
    }

    public function viewmaterial_db($id,$data) {
      	$sql = "SELECT mt.*,k.nama as kelompok,mr.nama as merek,mf.nama as fiskal,ir.reff_nama as kelompok_inventaris
      			FROM inventory_material mt
      			LEFT JOIN inventory_kelompok k ON mt.idkelompok=k.replid
      			LEFT JOIN inventory_merek mr ON mt.idmerek=mr.replid
      			LEFT JOIN inventory_fiskal mf ON mt.idfiskal=mf.replid
      			LEFT JOIN inventory_reff ir ON ir.replid=mt.idkelompok_inventaris AND ir.grup='inventaris'
      			WHERE mt.replid='".$id."'";
		$data['isi']=$this->dbx->rows($sql);
		return $data;
    }
}

?>
