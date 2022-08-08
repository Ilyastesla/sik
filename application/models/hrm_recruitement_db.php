<?php
Class hrm_recruitement_db extends CI_Model {
public function __construct() {
parent::__construct();
	$this->load->library('dbx');
}
    // Read data from database to show data in admin page
    public function data() {
      	$sql="SELECT r.*, j.jabatan as jabatantext,pr.reff as tipepekerjaantext,c.nama as companytext,pr2.reff as leveltext
								,(SELECT COUNT(replid) FROM hrm_recruitement_progress WHERE idhrm_recruitement=r.replid) as 'pakai'
						FROM hrm_recruitement r
						INNER JOIN hrm_jabatan j ON j.replid=r.idjabatan
						INNER JOIN pegawai_reff pr ON pr.replid=r.idtipepekerjaan
						LEFT JOIN pegawai_reff pr2 ON pr2.replid=r.idlevel
						INNER JOIN hrm_company c ON c.replid=r.idcompany
      			ORDER BY r.modified_date";
						//WHERE r.created_by='".$this->session->userdata('idpegawai')."'
      	return $this->dbx->data($sql);
    }


    //TAMBAH
    //-------------------------------------------------------------------------------------------
    public function tambah_x($id='',$data) {
    	$data['id']=$id;
      	$sql="SELECT *
      			FROM hrm_recruitement
      			WHERE replid='".$id."'";
        $data['isi'] = $this->dbx->rows($sql);

        if ($data['isi']== NULL ) {
        	unset($data['isi']);
					$sql="SELECT ".$this->dbx->tablecolumn('hrm_recruitement').",1 as aktif ";
        	$data['isi']=$this->dbx->rows($sql);
        }

				$data['idjabatan_opt'] = $this->dbx->opt("SELECT replid,jabatan as nama FROM hrm_jabatan WHERE aktif=1 ORDER BY jabatan",'none');
				$data['idtipepekerjaan_opt'] = $this->dbx->opt("SELECT replid,reff as nama FROM pegawai_reff WHERE aktif=1 AND type=12 ORDER BY reff",'none');
				$data['idcompany_opt'] = $this->dbx->opt("select replid,CONCAT(company_code,' ',nama) as nama from hrm_company WHERE aktif=1 ORDER BY nama",'up');
				$data['idlevel_opt'] = $this->dbx->opt("SELECT replid,reff as nama FROM pegawai_reff WHERE aktif=1 AND type=14 ORDER BY reff",'none');
        return $data;
    }

  public function view_db($id='',$data) {
      $sql="SELECT r.*, j.jabatan as jabatantext,pr.reff as tipepekerjaantext,c.nama as companytext,pr2.reff as leveltext
						,(SELECT COUNT(replid) FROM hrm_recruitement_progress WHERE idhrm_recruitement=r.replid) as 'pakai'
          FROM hrm_recruitement r
					INNER JOIN hrm_jabatan j ON j.replid=r.idjabatan
					INNER JOIN pegawai_reff pr ON pr.replid=r.idtipepekerjaan
					LEFT JOIN pegawai_reff pr2 ON pr2.replid=r.idlevel
					INNER JOIN hrm_company c ON c.replid=r.idcompany
          WHERE r.replid='".$id."'";
      $data['isi'] = $this->dbx->rows($sql);
			$sqlcalonpegawai="SELECT p.*,hrp.*,s.status as statustext
															,(TIMESTAMPDIFF(YEAR, p.tgllahir, CURDATE())) as umur,p.kelamin
												FROM hrm_recruitement_progress hrp
					              INNER JOIN hrm_recruitement_status s ON s.node=hrp.status
												INNER JOIN pegawai_calon p ON hrp.idcalonpegawai=p.replid
					              WHERE hrp.idhrm_recruitement='".$id."'
					      			  ORDER BY p.nama";
			//echo $sqlcalonpegawai;die;
			$data['calonpegawai'] = $this->dbx->data($sqlcalonpegawai);
			return $data;
  }
}
?>
