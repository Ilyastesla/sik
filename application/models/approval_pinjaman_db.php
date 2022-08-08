<?php

Class approval_pinjaman_db extends CI_Model {
public function __construct() {
parent::__construct();
	$this->load->library('dbx');
}
    // Read data from database to show data in admin page
    public function data() {
      	$sql="SELECT kk.*,c.nama as company,CONCAT(p.nama,'<br/>(',p.nip,')') as pemohon,d.departemen,s.status as statustext FROM hrm_pengajuan_pinjaman kk
      			LEFT JOIN hrm_company c ON kk.idcompany=c.replid
      			LEFT JOIN pegawai p ON kk.pemohon=p.replid
      			LEFT JOIN hrm_group_pinjaman dp ON kk.idgroup=dp.replid
      			LEFT JOIN hrm_departemen d ON kk.iddepartemen=d.replid
      			LEFT JOIN hrm_status s ON kk.status=s.node
      			WHERE next_approver='".$this->session->userdata('idpegawai')."' AND kk.status NOT IN (1,2,3,4,11,12)
      			ORDER BY kk.tanggalpengajuan";
      	return $this->dbx->data($sql);
    }
    public function view_db($id='',$data) {
    	$data['id']=$id;
      	$sql="SELECT kk.*,c.nama as company,CONCAT(p.nama,' (',p.nip,')') pemohontext,s.status as statustext
      				,jj.jenis_jaminan as idjenis_jaminantext
      				,d.departemen
      				,dp.group_pinjaman as idgroup
      				,jx.jabatan as idjabatan
      			FROM hrm_pengajuan_pinjaman kk
      			LEFT JOIN hrm_company c ON kk.idcompany=c.replid
      			LEFT JOIN pegawai p ON kk.pemohon=p.replid
      			LEFT JOIN hrm_departemen d ON kk.iddepartemen=d.replid
      			LEFT JOIN hrm_status s ON kk.status=s.node
      			LEFT JOIN hrm_group_pinjaman dp ON kk.idgroup=dp.replid
      			LEFT JOIN hrm_jabatan jx ON kk.idjabatan=jx.replid
      			LEFT JOIN hrm_jenis_jaminan jj ON kk.idjenis_jaminan=jj.replid
      			WHERE kk.replid='".$id."'
      			ORDER BY kk.tanggalpengajuan";
        $data['isi'] = $this->dbx->rows($sql);

        $sql2="SELECT * FROM hrm_pengajuan_pinjaman_attachment WHERE idpengajuan_pinjaman='".$id."'";
        $data['attachment'] = $this->dbx->data($sql2);

        $next_node=$this->dbx->next_node($data['isi']->status,"pengajuan_pinjaman");
        $sqlapprover="SELECT DISTINCT p.replid,p.nama
        				FROM pegawai p
        				INNER JOIN hrm_pegawai_jabatan pj ON pj.idpegawai=p.replid
        				WHERE pj.aktif=1
        					AND pj.idcompany='".$data['isi']->idcompany."'
        					AND pj.idjabatan IN (SELECT j.replid FROM hrm_loa l
        										INNER JOIN hrm_jabatan j ON l.idjabatan_grup=j.idjabatan_grup
        										WHERE idmodul='pengajuan_pinjaman' AND l.node='".$next_node."')
        				ORDER BY p.nama";
        //echo $sqlapprover;die;
        $data['approver_opt'] = $this->dbx->opt($sqlapprover,'up');

        return $data;
    }

    public function ubah($data,$id) {
	  $this->db->where('replid',$id);
	  $this->db->update('hrm_pengajuan_pinjaman', $data);
	  if ($this->db->_error_number() == 0) {
		  return true;
	  } else {
		  return false;
      }
    }

    public function loa_history($data) {
    	//echo print_r(array_values($data));die;
    	$this->db->trans_start();
        $this->db->insert('hrm_loa_history', $data);
        $insert_id = $this->db->insert_id();
        if ($this->db->affected_rows() > 0) {
               $this->db->trans_complete();
               return $insert_id;
        } else {
        	$this->db->trans_complete();
            return false;
        }
     }


}

?>
