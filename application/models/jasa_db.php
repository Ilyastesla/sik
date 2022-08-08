<?php

Class jasa_db extends CI_Model {
public function __construct() {
parent::__construct();
	$this->load->library('dbx');
}
    // Read data from database to show data in admin page
    public function data() {
      	$sql="SELECT *,CONCAT('[',kode_kelompok_jasa,'] ',' ',kelompok_jasa) as idkelompok_jasa FROM inventory_jasa j
      			INNER JOIN inventory_kelompok_jasa kj ON kj.replid=j.idkelompok_jasa ORDER BY jasa";
      	return $this->dbx->data($sql);
    }


    //TAMBAH
    //-------------------------------------------------------------------------------------------
    public function tambah_x($id='',$data) {
    	$data['id']=$id;
      	$sql="SELECT *
      			FROM inventory_jasa kk
      			WHERE kk.replid='".$id."'";
        $data['isi'] = $this->dbx->rows($sql);

        if ($data['isi']== NULL ) {
        	unset($data['isi']);
        	$sql="SELECT
        			'-' as kode_jasa,
					NULL as jasa,
					NULL as idkelompok_jasa,
					1 as aktif,
					NULL as created_date,
					NULL as created_by,
					NULL as modified_date,
					NULL as modified_by";
        	$data['isi']=$this->dbx->rows($sql);
        }
        $data['kelompok_jasa_opt'] = $this->dbx->opt("select replid,CONCAT('[',kode_kelompok_jasa,'] ',' ',kelompok_jasa) as nama from inventory_kelompok_jasa ORDER BY kelompok_jasa",'up');
        return $data;
    }

    public function kode_jasa($idkelompok_jasa){
	    $kode_jasa="";

	    $sql="SELECT kode_kelompok_jasa FROM inventory_kelompok_jasa
	    		WHERE replid='".$idkelompok_jasa."'";
	    $query=$this->db->query($sql);
	    $isi=$query->row();
	    if ($query->num_rows() > 0) {
	    	$kode_jasa=$isi->kode_kelompok_jasa;
	    }

	    $sql2="SELECT LPAD(RIGHT(trim(kode_jasa),4)+1,4,'0') as kode_jasa FROM inventory_jasa ORDER BY kode_jasa DESC LIMIT 1";
	    $query2=$this->db->query($sql2);
	    $isi2=$query2->row();
	    if ($query2->num_rows() > 0) {
	    	$kode_jasa=$kode_jasa.$isi2->kode_jasa;
	    }elseif ($kode_jasa<>""){
		    $kode_jasa=$kode_jasa."0001";
	    }
	    return $kode_jasa;

    }


    public function tambah($data) {
    	//echo print_r(array_values($data));die;
    	$this->db->trans_start();
        $this->db->insert('inventory_jasa', $data);
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
		$this->db->update('inventory_jasa', $data);
		if ($this->db->_error_number() == 0) {
		  return true;
		} else {
		  return false;
		}
	}

	public function hapus_db($id) {
	    // Query to check whether username already exist or not
	    $this->db->where('replid',$id);
	    $this->db->delete('inventory_jasa');
	    if ($this->db->_error_number() == 0) {
	    	return true;
	    } else {
	        return false;
	    }
    }
}
?>
