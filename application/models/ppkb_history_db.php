<?php

Class ppkb_history_db extends CI_Model {
public function __construct() {
parent::__construct();
	$this->load->library('dbx');
}
    // Read data from database to show data in admin page
    public function data() {
      	$sql="SELECT kk.*,c.nama as company
      			,CONCAT(p.nama,'<br />(',p.nip,')') as pemohon
      			,d.departemen,s.status as statustext 
      			,CONCAT(pg.nama,'<br />(',pg.nip,')') as next_approver
      			FROM hrm_ppkb kk 
      			LEFT JOIN hrm_company c ON kk.idcompany=c.replid
      			LEFT JOIN pegawai p ON kk.pemohon=p.replid
      			LEFT JOIN hrm_datapengeluaran dp ON kk.idpengeluaran=dp.replid
      			LEFT JOIN hrm_departemen d ON kk.iddepartemen=d.replid
      			LEFT JOIN hrm_status s ON kk.status=s.node
      			LEFT JOIN pegawai pg ON pg.replid=kk.next_approver
      			WHERE kk.replid IN (SELECT DISTINCT (lh.idsumber) FROM hrm_loa_history lh WHERE lh.idmodul='PPKB' AND lh.idapprover='".$this->session->userdata('idpegawai')."')
      			ORDER BY kk.tanggalpengajuan DESC";
      	//echo $sql;die;
      	return $this->dbx->data($sql);
    }
}
	
?>