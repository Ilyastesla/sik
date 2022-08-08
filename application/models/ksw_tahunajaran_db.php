<?php

Class ksw_tahunajaran_db extends CI_Model {
	public function __construct() {
		parent::__construct();
		$this->load->library('dbx');
	}

    // Read data from database to show data in admin page
    public function data() {
				$cari="";

				//if ($this->input->post('iddepartemen')<>""){
					$cari=$cari." AND ta.departemen='".$this->input->post('iddepartemen')."' ";
				//}else{
				//	$cari=$cari." WHERE ta.departemen IN (".$this->dbx->sessionjenjangtext().") ";
				//}

      	$sql = "SELECT c.nama as companytext,ta.*,(SELECT 1 FROM kelas WHERE idtahunajaran=ta.replid LIMIT 1) as pakai
								FROM tahunajaran ta
								INNER JOIN hrm_company c ON c.replid=ta.idcompany
								WHERE ta.idcompany='".$this->input->post('idcompany')."' ".$cari."
								ORDER BY ta.aktif DESC, tahunajaran DESC,departemen ASC";
		$data['show_table']=$this->dbx->data($sql);
		$data['iddepartemen_opt'] = $this->dbx->opt("SELECT departemen as replid,departemen as nama FROM departemen WHERE aktif=1 AND replid IN (".$this->session->userdata('dept').") ORDER BY urutan",'up');
		$companyrow=$this->session->userdata('idcompany');
		$sqlcompany="SELECT replid,nama as nama
								FROM hrm_company
								WHERE replid IN (".$companyrow.") AND aktif=1
								ORDER BY nama";
		$data['idcompany_opt'] = $this->dbx->opt($sqlcompany,'up');
		return $data;
    }

     //TAMBAH
    public function tambah_db($id='',$data) {
    	$data['id']=$id;
      	$sql="SELECT d.*
      			FROM tahunajaran d
      			WHERE d.replid='".$id."'";
        $data['isi'] = $this->dbx->rows($sql);

        if ($data['isi']== NULL ) {
					unset($data['isi']);
					$sql="SELECT ".$this->dbx->tablecolumn('tahunajaran').",1 as aktif ";
        	$data['isi']=$this->dbx->rows($sql);
        }
        $data['departemen_opt'] = $this->dbx->opt("SELECT departemen as replid, departemen as nama FROM departemen WHERE aktif=1 AND departemen IN (".$this->dbx->sessionjenjangtext().") ORDER BY urutan",'up');
		$data['pegawai_opt'] = $this->dbx->opt("SELECT replid, CONCAT(nama,' [',nip,']') as nama FROM pegawai WHERE aktif=1 ORDER BY nama",'up');
		$companyrow=$this->session->userdata('idcompany');
		$sqlcompany="SELECT replid,nama as nama
								FROM hrm_company
								WHERE replid IN (".$companyrow.") AND aktif=1
								ORDER BY nama";
		$data['idcompany_opt'] = $this->dbx->opt($sqlcompany,'up');
		return $data;
  }

		public function activate_pdb($dept,$id) {
			$idcompany=$this->dbx->singlerow("SELECT idcompany as isi FROM tahunajaran WHERE replid='".$id."'");
			//echo $idcompany;die;
			$sql="UPDATE tahunajaran SET aktif=0 WHERE idcompany='".$idcompany."' AND departemen='".$dept."' AND replid<>'".$id."'";
			//echo $sql;die;
			 $this->db->query($sql);
			 if ($this->db->_error_number() == 0) {
					 return true;
			 } else {
					 return false;
			 }
		}
}

?>
