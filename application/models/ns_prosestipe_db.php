<?php

Class ns_prosestipe_db extends CI_Model {
	public function __construct() {
		parent::__construct();
		$this->load->library('dbx');
	}

    public function data() {
				$cari="";
				if ($this->input->post('iddepartemen')<>""){
					$cari=$cari." AND pt.iddepartemen='".$this->input->post('iddepartemen')."' ";
				}
				if ($this->input->post('aktif')<>""){
					$cari=$cari." AND pt.aktif='".$this->input->post('aktif')."' ";
				}
				if ($this->input->post('katakunci')<>""){
					$cari=$cari." AND (pt.prosestipe LIKE '%".$this->input->post('katakunci')."%' OR pt.keterangan LIKE '%".$this->input->post('katakunci')."%') ";
				}
				
				if ($this->input->post('idcompany')<>""){
					$cari=$cari." AND pt.replid IN (SELECT idvariabel FROM ns_reff_company WHERE idcompany='".$this->input->post('idcompany')."' AND tipe='ns_prosestipe' ) ";
				}
				if ($this->input->post('kurikulumkode')<>""){
					$cari=$cari." AND pt.kurikulumkode='".$this->input->post('kurikulumkode')."' ";
				}

      	$sql="SELECT pt.*
											,(SELECT COUNT(*) FROM ns_prosesvariabel WHERE idprosestipe=pt.replid) as pakai
											,CONCAT(kr.kurikulumkode,' - ',kr.kurikulum) as kurikulumtext
				 				FROM ns_prosestipe pt
								 LEFT JOIN ns_kurikulum kr ON kr.kurikulumkode=pt.kurikulumkode
								WHERE pt.replid<>0
								".$cari."
								ORDER BY pt.no_urut";
				//echo $sql;die;
				$data['show_table']=$this->dbx->data($sql);
				$data['iddepartemen_opt'] = $this->dbx->opt("SELECT departemen as replid,departemen as nama FROM departemen WHERE aktif=1 AND replid IN (".$this->session->userdata('dept').") ORDER BY urutan",'up');
				$data['idcompany_opt'] = $this->dbx->opt("SELECT replid,nama as nama FROM hrm_company ORDER BY nama",'up');
				$data['aktif_opt'] =array('1'=>'Aktif','2'=>'Tidak Aktif','3'=>'Semuanya');
				$data['kurikulumkode_opt'] = $this->dbx->opt("SELECT kurikulumkode as replid,CONCAT(kurikulumkode,' - ',kurikulum) as nama FROM ns_kurikulum WHERE aktif=1 ORDER BY kurikulumkode DESC",'up');
				return $data;
    }

     //TAMBAH
    public function tambah_db($id='',$data) {
    	$data['id']=$id;
      	$sql="SELECT *
      			FROM ns_prosestipe
      			WHERE replid='".$id."'";
        $data['isi'] = $this->dbx->rows($sql);

        if ($data['isi']== NULL ) {
        	unset($data['isi']);
	        $sql="SELECT ".$this->dbx->tablecolumn('ns_prosestipe').",1 as aktif";
	        $data['isi']=$this->dbx->rows($sql);
        }

				$data['iddepartemen_opt'] = $this->dbx->opt("SELECT departemen as replid,departemen as nama FROM departemen WHERE aktif=1 AND replid IN (".$this->session->userdata('dept').") ORDER BY urutan",'up');
				$data['idcompany_opt'] = $this->dbx->data("SELECT replid,nama as nama FROM hrm_company ORDER BY nama",'up');
				$data['idreff_company_opt'] = $this->dbx->rowscsv("SELECT idcompany as var FROM ns_reff_company WHERE idvariabel='".$data['isi']->replid."' AND tipe='ns_prosestipe'",'up');
				$data['kurikulumkode_opt'] = $this->dbx->opt("SELECT kurikulumkode as replid,CONCAT(kurikulumkode,' - ',kurikulum) as nama FROM ns_kurikulum ORDER BY kurikulumkode DESC",'up');
				$sqlrapot="SELECT rt.replid,CONCAT('[',rt.iddepartemen,'] ',rt.rapottipe,' ',rt.keterangan, ' (',IF(rt.aktif=1,'A','T'),')') as nama,(SELECT 1 FROM ns_prosestiperapottipe WHERE idprosestipe='".$data["isi"]->replid."' AND idrapottipe=rt.replid) as checked
							FROM ns_rapottipe rt
							WHERE rt.iddepartemen='".$data["isi"]->iddepartemen."' AND rt.kurikulumkode='".$data["isi"]->kurikulumkode."' 
							ORDER BY rt.iddepartemen,rt.rapottipe";
        $data['idrapottipe_opt'] = $this->dbx->data($sqlrapot);
        return $data;
  }


   public function tambah_pdb($data) {
    	//echo print_r(array_values($data));die;
    	$this->db->trans_start();
        $this->db->insert('ns_prosestipe', $data);
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
        $this->db->update('ns_prosestipe', $data);
        if ($this->db->_error_number() == 0) {
            return true;
        } else {
            return false;
        }
    }

    public function hapus_pdb($id) {
        // Query to check whether username already exist or not
        $this->db->where('replid',$id);
        $this->db->delete('ns_prosestipe');
        if ($this->db->_error_number() == 0) {
	        return true;
        } else {
            return false;
        }
    }
}

?>
