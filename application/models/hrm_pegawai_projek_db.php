<?php

Class hrm_pegawai_projek_db extends CI_Model {
public function __construct() {
parent::__construct();
	$this->load->library('dbx');
}
    // Read data from database to show data in admin page
		public function data() {
				$cari="";
				if ($this->input->post('idcompany')<>""){
		    	$cari=$cari." AND d.idcompany='".$this->input->post('idcompany')."' ";
	    	}
				//if ($this->input->post('iddepartemen')<>""){
		    	$cari=$cari." AND pp.iddepartemen='".$this->input->post('iddepartemen')."' ";
	    	//}
      	$sql="SELECT pp.*,c.nama as companytext, d.departemen as departementext
							FROM hrm_pegawai_projek pp
							INNER JOIN hrm_departemen d ON d.replid=pp.iddepartemen
							INNER JOIN hrm_company c ON c.replid=d.idcompany
							WHERE d.replid=pp.iddepartemen ".$cari."
							ORDER BY c.nama,d.departemen,pp.projek
							";
				//echo $sql;die;
				$data['show_table']=$this->dbx->data($sql);
				$data['idcompany_opt'] = $this->dbx->opt("SELECT replid, nama FROM hrm_company WHERE aktif=1 ORDER BY nama","up");
				$data['iddepartemen_opt'] = $this->dbx->opt("SELECT replid, departemen as nama FROM hrm_departemen WHERE aktif=1 AND idcompany='".$this->input->post('idcompany')."' ORDER BY departemen","up");

				return $data;
		}

    //TAMBAH
    //-------------------------------------------------------------------------------------------
    public function tambah_x($id='',$data) {
    	$data['id']=$id;
      	$sql="SELECT *
      			FROM hrm_pegawai_projek kk
      			WHERE kk.replid='".$id."'";
        $data['isi'] = $this->dbx->rows($sql);

				if ($data['isi']== NULL ) {
	        unset($data['isi']);
	        $sql="SELECT ".$this->dbx->tablecolumn('hrm_pegawai_projek').",CURRENT_DATE() as tanggalmulai,
								CURRENT_DATE() as tanggalakhir,1 as aktif";
	        $data['isi']=$this->dbx->rows($sql);
	      }

				$data['idcompany_opt'] = $this->dbx->opt("select replid, nama FROM hrm_company WHERE aktif=1 ORDER BY nama","up");
				$data['iddepartemen_opt'] = $this->dbx->opt("SELECT replid, departemen as nama FROM hrm_departemen WHERE aktif=1 AND idcompany='".$data['isi']->idcompany."' ORDER BY departemen","up");
        return $data;
    }

	public function hapus_db($id) {
	    // Query to check whether username already exist or not
	    $this->db->where('replid',$id);
	    $this->db->delete('hrm_pegawai_projek');

	    $this->db->where('idhrm_pegawai_projek',$id);
	    $this->db->delete('hrm_jabatan_hrm_pegawai_projek');


	    if ($this->db->_error_number() == 0) {
	    	return true;
	    } else {
	        return false;
	    }
    }

	 public function view_db($id,$data) {
			$sql="SELECT pp.*,c.nama as companytext, d.departemen as departementext
						FROM hrm_pegawai_projek pp
						INNER JOIN hrm_departemen d ON d.replid=pp.iddepartemen
						INNER JOIN hrm_company c ON c.replid=d.idcompany
						WHERE pp.replid=".$id ;
			 $data['isi']=$this->dbx->rows($sql);
			 return $data;
	}
}
?>
