<?php

Class reff_jenjang_db extends CI_Model {
	public function __construct() {
		parent::__construct();
		$this->load->library('dbx');
	}

    // Read data from database to show data in admin page
    public function data() {
      	$sql="SELECT d.*
									,(SELECT COUNT(*) FROM tingkat WHERE departemen=d.departemen) as pakai
							FROM departemen d
							ORDER BY d.urutan";
				return $this->dbx->data($sql);
    }

     //TAMBAH
    public function tambah_db($id='',$data) {
    	$data['id']=$id;
      	$sql="SELECT d.*,(SELECT COUNT(*) FROM tingkat WHERE departemen=d.departemen) as pakai
      			FROM departemen d
      			WHERE d.replid='".$id."'";
        $data['isi'] = $this->dbx->rows($sql);

        if ($data['isi']== NULL ) {
        	unset($data['isi']);
        	$sql="SELECT
												0 as pakai,
												NULL as replid,
												NULL as departemen,
												NULL as nipkepsek,
												NULL as urutan,
												NULL as keterangan,
												NULL as aktif,
												NULL as info1,
												NULL as info2,
												NULL as info3,
												NULL as ts,
												NULL as token,
												NULL as issync,
												NULL as nipkonselor,
												NULL as nippsikolog";
        	$data['isi']=$this->dbx->rows($sql);
        }

        $data['pegawai_opt'] = $this->dbx->opt("SELECT nip as replid, nama FROM pegawai WHERE aktif=1 ORDER BY nama",'up');
        return $data;
  }


   public function tambah_pdb($data) {
    	//echo print_r(array_values($data));die;
    	$this->db->trans_start();
        $this->db->insert('departemen', $data);
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
        $this->db->update('departemen', $data);
        if ($this->db->_error_number() == 0) {
            return true;
        } else {
            return false;
        }
    }

    public function hapus_db($id) {
        $this->db->where('replid',$id);
        $this->db->delete('departemen');
        if ($this->db->_error_number() == 0) {
	        return true;
        } else {
            return false;
        }
    }
}

?>
