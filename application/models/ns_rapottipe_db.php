<?php

Class ns_rapottipe_db extends CI_Model {
	public function __construct() {
		parent::__construct();
		$this->load->library('dbx');
	}

    // Read data from database to show data in admin page
    public function data() {
				$cari="";$departemencari="";
				if ($this->input->post('iddepartemen')<>""){
					$cari=$cari." AND rt.iddepartemen='".$this->input->post('iddepartemen')."' ";
					$departemencari=" AND rt.iddepartemen='".$this->input->post('iddepartemen')."' ";
				}

				if ($this->input->post('iddepartemen')<>""){
					$cari=$cari." AND rt.tipe='".$this->input->post('idrapottipe')."' ";
				}

				if ($this->input->post('k13')<>""){
					$cari=$cari." AND rt.k13='".$this->input->post('k13')."' ";
				}
				if ($this->input->post('idcompany')<>""){
					$cari=$cari." AND rt.replid IN (SELECT idvariabel FROM ns_reff_company WHERE idcompany='".$this->input->post('idcompany')."' AND tipe='ns_rapottipe' ) ";
				}


      	$sql="SELECT rt.*,CONCAT(rt.rapottipe,' ',rt.keterangan) as rapottipe
										,(SELECT COUNT(r.replid) FROM ns_rapot r
										INNER JOIN tahunajaran ta ON r.idtahunajaran=ta.replid
										WHERE rt.replid=r.idrapottipe AND ta.aktif<>1) as pakai
								FROM ns_rapottipe rt
								WHERE rt.iddepartemen IN (SELECT departemen FROM departemen WHERE replid IN (".$this->session->userdata('dept')."))
								".$cari."
								ORDER BY rapottipe";
				//echo $sql;die;
      	$data['show_table']=$this->dbx->data($sql);

				$sqldept="SELECT departemen as replid,departemen as nama FROM departemen  WHERE replid IN (".$this->session->userdata('dept').") ORDER BY urutan";
				$data['iddepartemen_opt']=$this->dbx->opt($sqldept,'up');

				$data['idrapottipe_opt'] = array(''=>'Pilih..','Reguler'=>'Reguler','Grafik'=>'Grafik','LPD'=>'LPD','Evaluasi'=>'Evaluasi','SKL'=>'SKL',"Murni"=>"Murni");
				$data['idcompany_opt'] = $this->dbx->opt("SELECT replid,nama as nama FROM hrm_company ORDER BY nama",'up');
				return $data;
    }

     //TAMBAH
    public function tambah_db($id='',$data) {
    	$data['id']=$id;
      	$sql="SELECT rt.*
      			FROM ns_rapottipe rt
      			WHERE rt.replid='".$id."'";
        $data['isi'] = $this->dbx->rows($sql);

				if ($data['isi']== NULL ) {
					unset($data['isi']);
					$sql="SELECT ".$this->dbx->tablecolumn('ns_rapottipe').",1 as aktif ";
        	$data['isi']=$this->dbx->rows($sql);
        }
				$data['iddepartemen_opt'] = $this->dbx->opt("SELECT departemen as replid,departemen as nama FROM departemen WHERE aktif=1 AND replid IN (".$this->session->userdata('dept').") ORDER BY urutan",'up');
				$data['tipe_opt']=array(''=>'Pilih..','Reguler'=>'Reguler','Grafik'=>'Grafik','LPD'=>'LPD','Evaluasi'=>'Evaluasi','SKL'=>'SKL',"Murni"=>"Murni");
				$data['idcompany_opt'] = $this->dbx->data("SELECT replid,nama as nama FROM hrm_company ORDER BY nama",'up');
				$data['idreff_company_opt'] = $this->dbx->rowscsv("SELECT idcompany as var FROM ns_reff_company WHERE idvariabel='".$data['isi']->replid."' AND tipe='ns_rapottipe'",'up');
				//echo $data['idreff_company_opt'];die;
				return $data;
  }


   public function tambah_pdb($data) {
    	//echo print_r(array_values($data));die;
    	$this->db->trans_start();
        $this->db->insert('ns_rapottipe', $data);
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
        $this->db->update('ns_rapottipe', $data);
        if ($this->db->_error_number() == 0) {
            return true;
        } else {
            return false;
        }
    }

    public function hapus_pdb($id) {
        // Query to check whether username already exist or not
        $this->db->where('replid',$id);
        $this->db->delete('ns_rapottipe');
        if ($this->db->_error_number() == 0) {
	        return true;
        } else {
            return false;
        }
    }
}

?>
