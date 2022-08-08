<?php

Class jabatan_db extends CI_Model {
public function __construct() {
parent::__construct();
	$this->load->library('dbx');
}
    // Read data from database to show data in admin page
    public function data() {
      	$sql="SELECT j.*, jg.jabatan_grup as idjabatan_grup, j2.jabatan as idkepala_jabatan,d.departemen as iddepartemen
      			FROM hrm_jabatan j
      			LEFT JOIN hrm_jabatan_grup jg ON j.idjabatan_grup=jg.replid
      			LEFT JOIN hrm_jabatan j2 ON j.idkepala_jabatan=j2.replid
      			LEFT JOIN hrm_departemen d ON j.iddepartemen=d.replid
      			ORDER BY jabatan";
      	return $this->dbx->data($sql);
    }


    //TAMBAH
    //-------------------------------------------------------------------------------------------
    public function tambah_x($id='',$data) {
    	$data['id']=$id;
      	$sql="SELECT *
      			FROM hrm_jabatan kk
      			WHERE kk.replid='".$id."'";
        $data['isi'] = $this->dbx->rows($sql);

        if ($data['isi']== NULL ) {
        	unset($data['isi']);
        	$sql="SELECT
					NULL as jabatan,
					NULL as idjabatan_grup,
					NULL as idkepala_jabatan,
					NULL as iddepartemen,
					1 as aktif,
					NULL as created_date,
					NULL as created_by,
					NULL as modified_date,
					NULL as modified_by";
        	$data['isi']=$this->dbx->rows($sql);
        }
        $data['jabatan_grup_opt']=$this->dbx->opt("select replid,jabatan_grup as nama from hrm_jabatan_grup ORDER BY nama",'up');
        $data['departemen_opt']=$this->dbx->opt("select replid,departemen as nama from hrm_departemen ORDER BY nama",'up');
        $data['idkepala_jabatan_opt']=$this->dbx->opt("select replid,jabatan as nama from hrm_jabatan WHERE replid<>'".$id."'ORDER BY nama",'up');
        $data['grup_pinjaman_opt']=$this->dbx->opt("select replid,group_pinjaman as nama from hrm_group_pinjaman ORDER BY group_pinjaman",'up');
        return $data;
    }

    public function tambah($data) {
    	//echo print_r(array_values($data));die;
    	$this->db->trans_start();
        $this->db->insert('hrm_jabatan', $data);
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
		$this->db->update('hrm_jabatan', $data);
		if ($this->db->_error_number() == 0) {
		  return true;
		} else {
		  return false;
		}
	}

	public function hapus_db($id) {
	    // Query to check whether username already exist or not
	    $this->db->where('replid',$id);
	    $this->db->delete('hrm_jabatan');

	    $this->db->where('idjabatan',$id);
	    $this->db->delete('hrm_jabatan_kompetensi');

	    if ($this->db->_error_number() == 0) {
	    	return true;
	    } else {
	        return false;
	    }
    }

    public function tambahkompetensi($id) {
    	$sql2="DELETE FROM hrm_jabatan_kompetensi WHERE idjabatan='".$id."' AND idkompetensi NOT IN (SELECT replid FROM hrm_kompetensi)";
	    $this->db->query($sql2);

    	$sql="	INSERT INTO hrm_jabatan_kompetensi(idjabatan,idkompetensi,created_date,created_by)
    			SELECT '".$id."',replid,CURRENT_DATE(),'".$this->session->userdata('idpegawai')."'
    			FROM hrm_kompetensi
    			WHERE replid NOT IN (select idkompetensi FROM hrm_jabatan_kompetensi where idjabatan='".$id."') AND umum=1";
	    $this->db->query($sql);

    	if ($this->db->_error_number() == 0) {
	    	return true;
	    } else {
	        return false;
	    }
    }

    public function view_db($id='',$data) {
    	$data['id']=$id;
      	$sql="SELECT j.*, jg.jabatan_grup as idjabatan_grup, j2.jabatan as idkepala_jabatan,d.departemen as iddepartemen
      			FROM hrm_jabatan j
      			LEFT JOIN hrm_jabatan_grup jg ON j.idjabatan_grup=jg.replid
      			LEFT JOIN hrm_jabatan j2 ON j.idkepala_jabatan=j2.replid
      			LEFT JOIN hrm_departemen d ON j.iddepartemen=d.replid
      			WHERE j.replid='".$id."'";
        $data['isi'] = $this->dbx->rows($sql);
        $sql2="	SELECT pk.*,k.kompetensi as idkompetensi,k.max_skor,umum
        		FROM hrm_jabatan_kompetensi pk
        		INNER JOIN hrm_kompetensi k ON k.replid=pk.idkompetensi
      			WHERE pk.idjabatan='".$id."'
      			";
        $data['kompetensi']=$this->dbx->data($sql2);
        return $data;
    }

    public function ubahkompetensi_x($id,$data){
	    $data['id']=$id;
      	/*
      	$sql="SELECT *
      			FROM hrm_kompetensi k
      			WHERE replid NOT IN (select idkompetensi from hrm_jabatan_kompetensi WHERE idjabatan='".$id."')
      			ORDER BY kompetensi
      			";
      	*/
      	$sql="SELECT *,(select idkompetensi from hrm_jabatan_kompetensi WHERE idjabatan='".$id."' AND idkompetensi=k.replid) as idkompetensi
      			FROM hrm_kompetensi k
      			WHERE umum<>1
      			ORDER BY no_urut
      			";
        $data['isi'] = $this->dbx->data($sql);
        return $data;
    }

    public function tambahjabatankompetensi_db($data) {
    	//echo print_r(array_values($data));die;
    	$this->db->trans_start();
        $this->db->insert('hrm_jabatan_kompetensi', $data);
        $insert_id = $this->db->insert_id();
        if ($this->db->affected_rows() > 0) {
               $this->db->trans_complete();
               return $insert_id;
        } else {
        	$this->db->trans_complete();
            return false;
        }
     }

     public function hapuskompetensi_db($id) {
	    // Query to check whether username already exist or not
	    $this->db->where('replid',$id);
	    $this->db->delete('hrm_jabatan_kompetensi');

	    if ($this->db->_error_number() == 0) {
	    	return true;
	    } else {
	        return false;
	    }
    }
}
?>
