<?php
Class hrm_pegawai_attachment_db extends CI_Model {
public function __construct() {
parent::__construct();
	$this->load->library('dbx');
}
    // Read data from database to show data in admin page
    public function data() {
      	$sql="SELECT pr.reff as dokumentipetext,pr.replid as iddokumentipe,pa.*
							FROM pegawai_reff pr
							LEFT JOIN hrm_pegawai_calon_attachment pa ON pr.replid=pa.iddokumentipe AND pa.idpegawai_calon='".$this->session->userdata('idregistrasi')."'
							WHERE pr.aktif=1 AND pr.type=11
              ORDER BY pa.modified_date";
      	return $this->dbx->data($sql);
    }

		public function tambahattachment_db($data) {
  		$data['iddokumentipe_opt'] = $this->dbx->opt("SELECT replid, reff as nama FROM pegawai_reff WHERE type=11 AND replid NOT IN (SELECT iddokumentipe FROM hrm_pegawai_calon_attachment WHERE idpegawai_calon='".$this->session->userdata('idregistrasi')."') ORDER BY reff",'up');
  		return $data;
  	}

	 public function hapusattachment_db($id) {
		// Query to check whether username already exist or not
		$this->db->where('replid',$id);
		$this->db->delete('hrm_pegawai_calon_attachment');
		if ($this->db->_error_number() == 0) {
			return true;
		} else {
				return false;
		}
	}

}
?>
