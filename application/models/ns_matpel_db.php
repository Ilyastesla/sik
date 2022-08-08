<?php

Class ns_matpel_db extends CI_Model {
	public function __construct() {
		parent::__construct();
		$this->load->library('dbx');
	}

    // Read data from database to show data in admin page
    public function data() {
			//echo $this->session->userdata('dept');die;
			$cari="";
			if($this->input->post('iddepartemen')<>""){
				$cari=$cari." AND pv.iddepartemen= '".$this->input->post('iddepartemen')."'";
			}else{
				$cari=$cari." AND pv.iddepartemen IN (".$this->dbx->sessionjenjangtext($this->session->userdata('dept')).") ";
			}

			if($this->input->post('idmatpelkelompok')<>""){
				$cari=$cari." AND pv.idmatpelkelompokraport= '".$this->input->post('idmatpelkelompok')."'";
			}

			if($this->input->post('idmatpelkelompokraport13')<>""){
				$cari=$cari." AND pv.idmatpelkelompokraport13= '".$this->input->post('idmatpelkelompokraport13')."'";
			}
			if ($this->input->post('idcompany')<>""){
				$cari=$cari." AND pv.replid IN (SELECT idvariabel FROM ns_reff_company WHERE idcompany='".$this->input->post('idcompany')."' AND tipe='ns_matpel' ) ";
			}

      	$sql="SELECT pv.*,CONCAT(ps.matpelkelompok,' ',ps.keterangan) as matpelkelompok
									,CONCAT(ps2.matpelkelompok,' ',ps2.keterangan) as matpelkelompok2
									,CONCAT(ps13.matpelkelompok,' ',ps13.keterangan) as matpelkelompok13
											,CONCAT(ps3.matpelkelompok,' ',ps3.keterangan) as matpelkelompokpersentase
											,CONCAT(ps4.matpelkelompok,' ',ps4.keterangan) as grouptext
															,(SELECT COUNT(pj.replid) FROM ns_pembelajaranjadwal pj
																			INNER JOIN tahunajaran ta ON pj.idtahunajaran=ta.replid
																			WHERE pv.replid=pj.idmatpel AND ta.aktif<>1) as pakai
      			FROM ns_matpel pv
      			LEFT JOIN ns_matpelkelompok ps ON ps.replid=pv.idmatpelkelompok
      			LEFT JOIN ns_matpelkelompok ps2 ON ps2.replid=pv.idmatpelkelompokraport
						LEFT JOIN ns_matpelkelompok ps13 ON ps13.replid=pv.idmatpelkelompokraport13
      			LEFT JOIN ns_matpelkelompok ps3 ON ps3.replid=pv.idmatpelkelompokpersentase
						LEFT JOIN ns_matpelkelompok ps4 ON ps4.replid=pv.idgroup
						WHERE pv.replid IS NOT NULL
						".$cari."
      			ORDER BY ps2.matpelkelompok,pv.no_urut";
				//echo $sql;
				$data['show_table']=$this->dbx->data($sql);
				$data['iddepartemen_opt'] = $this->dbx->opt("SELECT departemen as replid,departemen as nama FROM departemen WHERE aktif=1 AND replid IN (".$this->session->userdata('dept').") ORDER BY urutan",'up');
				$data['idmatpelkelompok_opt'] = $this->dbx->opt("SELECT replid,CONCAT('[',iddepartemen,']',' ',matpelkelompok,' ',keterangan) as nama FROM ns_matpelkelompok WHERE aktif=1 AND iddepartemen='".$this->input->post('iddepartemen')."' ORDER BY nama",'up');
				//die;
				$data['idcompany_opt'] = $this->dbx->opt("SELECT replid,nama as nama FROM hrm_company ORDER BY nama",'up');
        return $data;
    }

     //TAMBAH
    public function tambah_db($id='',$data) {
    	$data['id']=$id;
      	$sql="SELECT *
      			FROM ns_matpel
      			WHERE replid='".$id."'";
        $data['isi'] = $this->dbx->rows($sql);

        if ($data['isi']== NULL ) {
					unset($data['isi']);
					$sql="SELECT ".$this->dbx->tablecolumn('ns_matpel').",1 as hitungnilai,1 as aktif ";
        	$data['isi']=$this->dbx->rows($sql);
        }
        $data['iddepartemen_opt'] = $this->dbx->opt("SELECT departemen as replid,departemen as nama FROM departemen WHERE aktif=1 AND replid IN (".$this->session->userdata('dept').") ORDER BY urutan",'up');
        $data['idmatpelkelompok_opt'] = $this->dbx->opt("SELECT replid,CONCAT('[',iddepartemen,']',' ',matpelkelompok,' ',keterangan) as nama FROM ns_matpelkelompok WHERE aktif=1 AND iddepartemen='".$data['isi']->iddepartemen."' ORDER BY nama",'up');
        $data['idmatpelkelompokraport_opt'] = $this->dbx->opt("SELECT replid,CONCAT('[',iddepartemen,']',' ',matpelkelompok,' ',keterangan) as nama FROM ns_matpelkelompok  WHERE aktif=1 AND iddepartemen='".$data['isi']->iddepartemen."' ORDER BY nama",'up');
        $data['idmatpelkelompokpersentase_opt'] = $this->dbx->opt("SELECT replid,CONCAT('[',iddepartemen,']',' ',matpelkelompok,' ',keterangan) as nama FROM ns_matpelkelompok WHERE aktif=1 AND iddepartemen='".$data['isi']->iddepartemen."' ORDER BY nama",'up');
        return $data;
  }


   public function tambah_pdb($data) {
    	//echo print_r(array_values($data));die;
    	$this->db->trans_start();
        $this->db->insert('ns_matpel', $data);
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
        $this->db->update('ns_matpel', $data);
        if ($this->db->_error_number() == 0) {
            return true;
        } else {
            return false;
        }
    }


    public function view_db($id,$data) {
      	$sql="SELECT pv.*,CONCAT(ps.matpelkelompok,' ',ps.keterangan) as matpelkelompok
									,CONCAT(ps2.matpelkelompok,' ',ps2.keterangan) as matpelkelompok2
									,CONCAT(ps13.matpelkelompok,' ',ps13.keterangan) as matpelkelompok13
											,CONCAT(ps3.matpelkelompok,' ',ps3.keterangan) as matpelkelompokpersentase
											,CONCAT(ps4.matpelkelompok,' ',ps4.keterangan) as grouptext
									,(SELECT COUNT(pj.replid) FROM ns_pembelajaranjadwal pj
													INNER JOIN tahunajaran ta ON pj.idtahunajaran=ta.replid
													WHERE pv.replid=pj.idmatpel AND ta.aktif<>1) as pakai
      			FROM ns_matpel pv
      			LEFT JOIN ns_matpelkelompok ps ON ps.replid=pv.idmatpelkelompok
      			LEFT JOIN ns_matpelkelompok ps2 ON ps2.replid=pv.idmatpelkelompokraport
						LEFT JOIN ns_matpelkelompok ps13 ON ps13.replid=pv.idmatpelkelompokraport13
      			LEFT JOIN ns_matpelkelompok ps3 ON ps3.replid=pv.idmatpelkelompokpersentase
						LEFT JOIN ns_matpelkelompok ps4 ON ps4.replid=pv.idgroup
      			WHERE pv.replid='".$id."'";
      	$data['isi'] = $this->dbx->rows($sql);


      	//"SELECT t.replid,t.keterangan as nama,(SELECT 1 FROM ns_matpeltingkat WHERE idmatpel='".$id."' AND idtingkat=t.replid) as 'checked' FROM tingkat t WHERE t.departemen='".$data['isi']->iddepartemen."'"
      	$sql="SELECT DISTINCT concat(k.idtingkat,',',k.jurusan) as replid,IF(k.jurusan<>''
	      				,CONCAT(t.keterangan,' - ',j.jurusan),t.keterangan) as nama
	      				,(SELECT 1 FROM ns_matpeltingkat WHERE idmatpel='".$id."' AND idtingkat=k.idtingkat AND idjurusan=k.jurusan) as 'checked'
								FROM kelas k
								INNER JOIN tahunajaran ta ON ta.replid= k.idtahunajaran
								INNER JOIN tingkat t ON t.replid=k.idtingkat
								LEFT JOIN jurusan j ON j.replid=k.jurusan
								WHERE ta.aktif=1 AND k.aktif=1 AND ta.departemen='".$data['isi']->iddepartemen."' 
								GROUP BY k.idtingkat,k.jurusan ORDER BY t.departemen,t.tingkat,j.jurusan";
		//echo $sql;die;
		//AND ta.idcompany='".$this->session->userdata('idcompany')."'

      	$data['idtingkat_opt'] = $this->dbx->data($sql);

				$data['idcompany_opt'] = $this->dbx->data("SELECT replid,nama as nama FROM hrm_company ORDER BY nama",'up');
				$data['idreff_company_opt'] = $this->dbx->rowscsv("SELECT idcompany as var FROM ns_reff_company WHERE idvariabel='".$data['isi']->replid."' AND tipe='ns_matpel'",'up');

      	return $data;
    }

    public function tambahtingkat_db($data) {
    	//echo print_r(array_values($data));die;
    	$this->db->trans_start();
        $this->db->insert('ns_matpeltingkat', $data);
        $insert_id = $this->db->insert_id();
        if ($this->db->affected_rows() > 0) {
               $this->db->trans_complete();
               return true;
        } else {
        	$this->db->trans_complete();
            return false;
        }
     }

    public function hapustingkat_db($id) {
	    $this->db->where('idmatpel',$id);
	    $this->db->delete('ns_matpeltingkat');
	    if ($this->db->_error_number() == 0) {
	    	return true;
	    } else {
	        return false;
	    }
    }

    public function hapus_db($id) {
        // Query to check whether username already exist or not
        $this->db->where('replid',$id);
        $this->db->delete('ns_matpel');
        if ($this->db->_error_number() == 0) {
	        return true;
        } else {
            return false;
        }
    }
}

?>
