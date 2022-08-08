<?php

Class user_db extends CI_Model {
	public function __construct() {
	parent::__construct();
		$this->load->library('dbx');
	}

    // Read data from database to show data in admin page
    public function user_table($data) {
      	$sql = "select p.nama,p.nip,p.aktif as status_pegawai,l.*
      			FROM login l
      			INNER JOIN pegawai p ON l.login=p.nip
      			";
		$data['data_table']=$this->dbx->data($sql);
		return $data;
    }

    //---------------------------------------------------------------------------------------------------------
	//------------------------------------------------------------------------------------------ INDEX
	//---------------------------------------------------------------------------------------------------------
	public function ubahuser_db($id_user,$data) {
    	$sql="select l.*,p.nama,p.nip FROM login l
      			INNER JOIN pegawai p ON l.login=p.nip
      			WHERE l.replid='".$id_user."'";
    	$data['isi']=$this->dbx->rows($sql);
			$sqlpeg="SELECT * FROM pegawai WHERE nip='".$this->session->userdata('nip')."'";
			$data['isipeg']=$this->dbx->rows($sqlpeg);

    	if ($data['isi']== NULL ) {
        	unset($data['isi']);
        	$sql="SELECT NULL as 'nama',NULL as 'nip', NULL as 'role_id',NULL as 'departemen',NULL as 'kelas','1' as 'aktif',NULL as 'keterangan'";
        	$data['isi']=$this->dbx->rows($sql);
        }

    	$data['nip_opt'] = $this->dbx->opt("SELECT nip as replid,nama as nama FROM pegawai
    										WHERE aktif=1
    										AND nip NOT IN (SELECT login FROM login)
    										ORDER BY nama",'up');

    	$data['role_opt'] = $this->dbx->data("SELECT replid,role as nama FROM role WHERE aktif=1 ORDER BY role ",'up');
    	$data['departemen_opt'] = $this->dbx->data("SELECT replid,departemen as nama FROM departemen WHERE aktif=1 ORDER BY urutan",'up');
    	$data['matpel_opt'] = $this->dbx->data("SELECT replid,CONCAT('[',iddepartemen,'] ',matpel) as nama FROM ns_matpel WHERE aktif=1 ORDER BY iddepartemen,matpel",'up');
    	$data['kelas_opt'] = $this->dbx->data("SELECT k.replid,CONCAT(t.tingkat,' - ',k.kelas) as nama FROM kelas k
																																INNER JOIN tahunajaran ta ON k.idtahunajaran=ta.replid
																																INNER JOIN tingkat t ON k.idtingkat=t.replid
																																WHERE ta.aktif=1 ORDER BY CONVERT(SUBSTRING_INDEX(t.tingkat,'-',-1),UNSIGNED INTEGER),k.kelas",'up');
    	return $data;
    }

    public function ubahuser_p_db($data,$idx) {
		$this->db->where('replid',$idx);
		$this->db->update('login', $data);
		if ($this->db->_error_number() == 0) {
			return true;
		} else {
			return false;
		}
	 }

	 public function tambahuser_p_db($data) {
    	$this->db->trans_start();
        $this->db->insert('login', $data);
        $insert_id = $this->db->insert_id();
        if ($this->db->affected_rows() > 0) {
               $this->db->trans_complete();
               return $insert_id;
        } else {
        	$this->db->trans_complete();
            return false;
        }
     }

    public function ganti_password_db($id_user,$data) {
    	$sql="select * FROM pegawai
      			WHERE replid='".$id_user."'";
    	$data['isi']=$this->dbx->rows($sql);
    	return $data;
    }

    public function read_user_information($sess_array) {

      	$sql = "select 1
      			FROM login l "
      			."inner join pegawai p ON l.login=p.nip "
				."WHERE p.replid = '".$sess_array['username']."'  "
				."AND l.password='".md5($sess_array['password'])."'";
		//echo $sql;
		$query=$this->db->query($sql);

        if ($query->num_rows() == 1) {
            //return $query->result();
            return true;
        } else {
            return false;
        }
    }

    public function ubahpassword_p_db($data,$nip) {
		$this->db->where('login',$nip);
		$this->db->update('login', $data);
		if ($this->db->_error_number() == 0) {
			return true;
		} else {
			return false;
		}
	 }


    public function hapususer_p_db($id) {
        $this->db->where('replid',$id);
        $this->db->delete('login');
        if ($this->db->_error_number() == 0) {
        	return true;
        } else {
            return false;
        }
    }
}

?>
