<?php

Class ns_pembelajaranlaporan_db extends CI_Model {
	public function __construct() {
		parent::__construct();
		$this->load->library('dbx');
	}

    // Read data from database to show data in admin page
    public function data() {
      	$sql="SELECT pv.*,ps.prosestipe,mp.matpel,mp.iddepartemen,ta.tahunajaran,k.kelas
      				,(SELECT COUNT(*) FROM ns_pengembangandirinilai WHERE idpembelajaranjadwal=pv.replid) as nilaipd
      			FROM ns_pembelajaranjadwal pv
      			LEFT JOIN ns_prosestipe ps ON ps.replid=pv.idprosestipe
      			LEFT JOIN ns_matpel mp ON mp.replid=pv.idmatpel
      			LEFT JOIN tahunajaran ta ON ta.replid=pv.idtahunajaran
      			LEFT JOIN kelas k ON k.replid=pv.idkelas
      			WHERE mp.replid IN (".$this->session->userdata('matpel').")
      			ORDER BY pv.tanggalkegiatan";
      	return $this->dbx->data($sql);
    }

     //TAMBAH
    public function tambah_db($id='',$data) {
    	$data['id']=$id;
      	$sql="SELECT *
      			FROM ns_pembelajaranjadwal
      			WHERE replid='".$id."'";
        $data['isi'] = $this->dbx->rows($sql);

        if ($data['isi']== NULL ) {
        	unset($data['isi']);
        	$sql="SELECT
        			NULL as replid,
					NULL as idprosestipe,
					NULL as idmatpel,
					current_date() as tanggalkegiatan,
					NULL as idtahunajaran,
					NULL as idkelas,
					1 as aktif,
					NULL as keterangan,
					NULL as created_date,
					NULL as created_by,
					NULL as modified_date,
					NULL as modified_by
					";
        	$data['isi']=$this->dbx->rows($sql);
        }

        if($data['idmatpel2']<>""){$idmatpel2=$data['idmatpel2'];}else{$idmatpel2=$data['isi']->idmatpel;}
        if($data['idtahunajaran2']<>""){$idtahunajaran2=$data['idtahunajaran2'];}else{$idtahunajaran2=$data['isi']->idtahunajaran;}

        $data['idprosestipe_opt'] = $this->dbx->opt("SELECT replid,prosestipe as nama FROM ns_prosestipe ORDER BY nama",'up');
        $data['idmatpel_opt'] = $this->dbx->opt("SELECT replid,CONCAT('[',iddepartemen,'] ',matpel) as nama FROM ns_matpel WHERE replid IN (".$this->session->userdata('matpel').") ORDER BY iddepartemen, matpel",'up');

        $data['idtahunajaran_opt'] = $this->dbx->opt("SELECT replid,CONCAT('[',departemen,'] ',tahunajaran) as nama FROM tahunajaran WHERE aktif=1 and idcompany='".$this->session->userdata('idcompany')."' AND departemen IN (SELECT iddepartemen FROM ns_matpel WHERE replid='".$idmatpel2."') ORDER BY aktif DESC ,nama DESC  ",'up');
        $data['idkelas_opt'] = $this->dbx->opt("SELECT replid,kelas as nama FROM kelas
        												WHERE idtahunajaran='".$idtahunajaran2."' AND replid IN (".$this->session->userdata('kelas').")
        												ORDER BY idtingkat",'up');
        return $data;
  }


   public function tambah_pdb($data) {
    	//echo print_r(array_values($data));die;
    	$this->db->trans_start();
        $this->db->insert('ns_pembelajaranjadwal', $data);
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
        $this->db->update('ns_pembelajaranjadwal', $data);
        if ($this->db->_error_number() == 0) {
            return true;
        } else {
            return false;
        }
    }


    // PENILAIAN
	//-------------------------------------------------------------------------------------------
	public function view_db($id,$data) {
      	$sql="SELECT pv.*,ps.prosestipe,mp.matpel,mp.iddepartemen,ta.tahunajaran,k.kelas
      			FROM ns_pembelajaranjadwal pv
      			LEFT JOIN ns_prosestipe ps ON ps.replid=pv.idprosestipe
      			LEFT JOIN ns_matpel mp ON mp.replid=pv.idmatpel
      			LEFT JOIN tahunajaran ta ON ta.replid=pv.idtahunajaran
      			LEFT JOIN kelas k ON k.replid=pv.idkelas
      			WHERE pv.replid='".$id."'";
      	$data['isi'] = $this->dbx->rows($sql);

      	$sql2="SELECT * FROM siswa WHERE idkelas='".$data['isi']->idkelas."' AND aktif=1 ";
      	$data['siswa']=$this->dbx->data($sql2);

      	$sql3="SELECT pdv.* FROM ns_pengembangandirivariabel pdv
				INNER JOIN ns_prosessubvariabel psv ON psv.replid=pdv.idprosessubvariabel AND psv.aktif=1
				INNER JOIN ns_prosesvariabel pv ON pv.replid=psv.idprosesvariabel AND pv.aktif=1
				INNER JOIN ns_prosestipe pt ON pt.replid=pv.idprosestipe AND pt.aktif=1
				WHERE pdv.aktif=1
				AND pt.replid='".$data['isi']->idprosestipe."' ORDER BY pdv.no_urut";
      	$data['pengembangandirivariabel']=$this->dbx->data($sql3);
      	return $data;
    }


    public function tambahnilai_pdb($data) {
    	//echo print_r(array_values($data));die;
    	$this->db->trans_start();
        $this->db->insert('ns_pengembangandirinilai', $data);
        $insert_id = $this->db->insert_id();
        if ($this->db->affected_rows() > 0) {
               $this->db->trans_complete();
               return true;
        } else {
        	$this->db->trans_complete();
            return false;
        }
     }

    public function hapusnilai_pdb($id) {
        // Query to check whether username already exist or not
        $this->db->where('idpembelajaranjadwal',$id);
        $this->db->delete('ns_pengembangandirinilai');
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
        $this->db->delete('ns_pembelajaranjadwal');
        if ($this->db->_error_number() == 0) {
	        return true;
        } else {
            return false;
        }
    }
}

?>
