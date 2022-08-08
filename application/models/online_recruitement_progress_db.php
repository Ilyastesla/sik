<?php
Class online_recruitement_progress_db extends CI_Model {
public function __construct() {
parent::__construct();
	$this->load->library('dbx');
}
    // Read data from database to show data in admin page
    public function data() {
      	$sql="SELECT hr.*,hrp.*,s.status as statustext,hrp.created_date,hrp.status, j.jabatan as jabatantext,pr.reff as tipepekerjaantext
							FROM hrm_recruitement hr
              INNER JOIN hrm_recruitement_progress hrp ON hrp.idhrm_recruitement=hr.replid
              INNER JOIN hrm_recruitement_status s ON s.node=hrp.status
							INNER JOIN hrm_jabatan j ON j.replid=hr.idjabatan
							INNER JOIN pegawai_reff pr ON pr.replid=hr.idtipepekerjaan
              WHERE hrp.idpegawai='".$this->session->userdata('idregistrasi')."'
      			  ORDER BY hr.modified_date";
      	return $this->dbx->data($sql);
    }

		public function tambah_x($data,$idhrm_recruitement) {
				$sqlhead="SELECT r.*,DATE_FORMAT(r.modified_date,'%H:%i') as timex,'berita' as tipetimeline
	                  ,j.jabatan as jabatantext
	                  ,(SELECT 1 FROM hrm_recruitement_progress WHERE idhrm_recruitement=r.replid AND idpegawai='".$this->session->userdata('idregistrasi')."' LIMIT 1 ) as 'pakai'
	    			FROM hrm_recruitement r
	          INNER JOIN hrm_jabatan j ON j.replid=r.idjabatan
	    			WHERE r.replid='".$idhrm_recruitement."'";
				$data['header'] = $this->dbx->rows($sqlhead);

				$sql="SELECT ".$this->dbx->tablecolumn('hrm_recruitement_progress');
				$data['isi']=$this->dbx->rows($sql);
        return $data;
    }
}
?>
