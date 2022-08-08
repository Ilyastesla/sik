<?php

Class inventory_vendor_db extends CI_Model {
public function __construct() {
parent::__construct();
	$this->load->library('dbx');
}
    // Read data from database to show data in admin page
    public function data() {
      	$sql="SELECT v.*,o.organizationcode,n.negara FROM inventory_vendor v
									LEFT JOIN inventory_organization o ON v.idorganization=o.replid
									LEFT JOIN negara n ON n.replid=v.country
									ORDER BY nama";
      	return $this->dbx->data($sql);
    }


    //TAMBAH
    //-------------------------------------------------------------------------------------------
    public function tambah_x($id='',$data) {
    	$data['id']=$id;
      	$sql="SELECT *
      			FROM inventory_vendor kk
      			WHERE kk.replid='".$id."'";
        $data['isi'] = $this->dbx->rows($sql);

        if ($data['isi']== NULL ) {
        	unset($data['isi']);
        	$sql="SELECT
					NULL as replid,
					NULL as idorganization,
					NULL as nama,
					NULL as is_corporate,
					NULL as street,
					NULL as city,
					NULL as zip,
					NULL as country,
					NULL as phone,
					NULL as mobile,
					NULL as website,
					NULL as fax,
					NULL as email,
					NULL as contactperson,
					NULL as npwp,
					NULL as notes,
					NULL as aktif,
					NULL as created_by,
					NULL as created_date,
					NULL as modified_by,
					NULL as modified_date";
        	$data['isi']=$this->dbx->rows($sql);
        }
				$data['country_opt'] = $this->dbx->opt("select replid,negara as nama from negara",'up');
				$data['idorganization_opt'] = $this->dbx->opt("select replid,organizationcode as nama from inventory_organization",'up');
        return $data;
    }

    public function tambah($data) {
    	//echo print_r(array_values($data));die;
    	$this->db->trans_start();
        $this->db->insert('inventory_vendor', $data);
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
		$this->db->update('inventory_vendor', $data);
		if ($this->db->_error_number() == 0) {
		  return true;
		} else {
		  return false;
		}
	}

	public function hapus_db($id) {
	    // Query to check whether username already exist or not
	    $this->db->where('replid',$id);
	    $this->db->delete('inventory_vendor');
	    if ($this->db->_error_number() == 0) {
	    	return true;
	    } else {
	        return false;
	    }
    }

		public function view_db($id,$data) {
      	$sql="SELECT v.*,o.organizationcode,n.negara FROM inventory_vendor v
									LEFT JOIN inventory_organization o ON v.idorganization=o.replid
									LEFT JOIN negara n ON n.replid=v.country
									WHERE v.replid='".$id."'
									ORDER BY nama";
      	$data['isi']=$this->dbx->rows($sql);
		
		$sql="SELECT CONCAT('[',im.kode,'] ',' ',im.nama) as materialtext,pm.idmaterial,u.unit as unittext,SUM(pm.jumlah) as jumlah
				FROM inventory_pembelian pb
				INNER JOIN inventory_pembelian_mat pm ON pb.replid=pm.idinventory_pembelian 
				LEFT JOIN inventory_material im ON pm.idmaterial=im.replid
				LEFT JOIN inventory_unit u ON pm.idunit=u.replid
				WHERE pb.idvendor='".$id."'
				GROUP BY im.replid
				";
			//echo $sql;die;
		$data['material'] = $this->dbx->data($sql);
		return $data;
    }

}
?>
