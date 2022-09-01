<?php

Class ns_pengembangandirivariabel_db extends CI_Model {
	public function __construct() {
		parent::__construct();
		$this->load->library('dbx');
	}

    // Read data from database to show data in admin page
    public function data() {
		$cari="";
		if($this->input->post('iddepartemen')<>""){
			$cari=$cari." AND pt.iddepartemen= '".$this->input->post('iddepartemen')."'";
		}else{
			$cari=$cari." AND pt.iddepartemen IN (".$this->dbx->sessionjenjangtext($this->session->userdata('dept')).") ";
		}

		if($this->input->post('idprosestipe')<>""){
			$cari=$cari." AND pt.replid= '".$this->input->post('idprosestipe')."'";
		}

		if($this->input->post('idprosesvariabel')<>""){
			$cari=$cari." AND pv.replid= '".$this->input->post('idprosesvariabel')."'";
		}

		if($this->input->post('idprosessubvariabel')<>""){
			$cari=$cari." AND ps.replid= '".$this->input->post('idprosessubvariabel')."'";
		}

		if ($this->input->post('idcompany')<>""){
			$cari=$cari." AND pt.replid IN (SELECT idvariabel FROM ns_reff_company WHERE idcompany='".$this->input->post('idcompany')."' AND tipe='ns_prosestipe' ) ";
		}

      	$sql="SELECT pdv.*,ps.prosessubvariabel,pv.prosesvariabel,pt.prosestipe,pt.iddepartemen
									,(SELECT COUNT(*) FROM ns_pembelajaranjadwal WHERE idprosestipe=pt.replid LIMIT 1) as pakai
      			FROM ns_pengembangandirivariabel pdv
      			LEFT JOIN ns_prosessubvariabel ps ON ps.replid=pdv.idprosessubvariabel
				LEFT JOIN ns_prosesvariabel pv ON pv.replid=ps.idprosesvariabel
				LEFT JOIN ns_prosestipe pt ON pt.replid=pv.idprosestipe
				WHERE pdv.replid IS NOT NULL 
				".$cari."
      			ORDER BY pv.no_urut";
				//echo $sql;die;
		$data['show_table']=$this->dbx->data($sql);
		$data['iddepartemen_opt'] = $this->dbx->opt("SELECT departemen as replid,departemen as nama FROM departemen WHERE replid IN (".$this->session->userdata('dept').") ORDER BY urutan",'up');

		$data['idcompany_opt'] = $this->dbx->opt("SELECT replid,nama as nama FROM hrm_company ORDER BY nama",'up');

		$sqlproses="SELECT replid,CONCAT(prosestipe,' ',keterangan, ' (',IF(aktif=1,'A','T'),')') as nama
								FROM ns_prosestipe
								WHERE iddepartemen='".$this->input->post('iddepartemen')."'
									AND replid IN (SELECT idvariabel FROM ns_reff_company WHERE idcompany='".$this->input->post('idcompany')."' AND tipe='ns_prosestipe' )
								ORDER BY aktif DESC,nama ASC ";
		$data['idprosestipe_opt'] = $this->dbx->opt($sqlproses,"up");

		$data['idprosesvariabel_opt'] = $this->dbx->opt("SELECT replid,CONCAT(prosesvariabel, ' (',IF(aktif=1,'A','T'),')') as nama FROM ns_prosesvariabel WHERE idprosestipe='".$this->input->post('idprosestipe')."' ORDER BY nama",'up');
		$data['idprosessubvariabel_opt'] = $this->dbx->opt("SELECT replid,CONCAT(prosessubvariabel, ' (',IF(aktif=1,'A','T'),')') as nama FROM ns_prosessubvariabel WHERE idprosesvariabel='".$this->input->post('idprosesvariabel')."' ORDER BY nama",'up');

      	return $data;
    }

     //TAMBAH
    public function tambah_db($id='',$data) {
    	$data['id']=$id;
      	$sql="SELECT *
      			FROM ns_pengembangandirivariabel
      			WHERE replid='".$id."'";
        $data['isi'] = $this->dbx->rows($sql);

        if ($data['isi']== NULL ) {
        	unset($data['isi']);
        	$sql="SELECT
        			NULL as replid,
					NULL as pengembangandirivariabel,
					NULL as idprosessubvariabel,
					NULL as no_urut,
					0 as persentasemurni,
					1 as aktif,
					NULL as keterangan,
					NULL as created_date,
					NULL as created_by,
					NULL as modified_date,
					NULL as modified_by
					";
        	$data['isi']=$this->dbx->rows($sql);
        }

				$sqlidprosessubvariabel="SELECT psv.replid,CONCAT(psv.prosessubvariabel,' (',pt.iddepartemen,')')  as nama FROM ns_prosessubvariabel psv
																									LEFT JOIN ns_prosesvariabel pv ON pv.replid=psv.idprosesvariabel
																									LEFT JOIN ns_prosestipe pt ON pt.replid=pv.idprosestipe
																									WHERE pt.aktif=1 AND pv.aktif=1 AND psv.aktif=1 AND pt.iddepartemen IN (SELECT departemen FROM departemen WHERE replid IN (".$this->session->userdata('dept').")) ORDER BY pt.iddepartemen,psv.prosessubvariabel";
        $data['idprosessubvariabel_opt'] = $this->dbx->opt($sqlidprosessubvariabel,'up');
        return $data;
  }


   public function tambah_pdb($data) {
    	//echo print_r(array_values($data));die;
    	$this->db->trans_start();
        $this->db->insert('ns_pengembangandirivariabel', $data);
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
        $this->db->update('ns_pengembangandirivariabel', $data);
        if ($this->db->_error_number() == 0) {
            return true;
        } else {
            return false;
        }
    }

    public function hapus_pdb($id) {
        // Query to check whether username already exist or not
        $this->db->where('replid',$id);
        $this->db->delete('ns_pengembangandirivariabel');
        if ($this->db->_error_number() == 0) {
	        return true;
        } else {
            return false;
        }
    }
}

?>
