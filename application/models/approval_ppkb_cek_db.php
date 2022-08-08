<?php
Class approval_ppkb_cek_db extends CI_Model {
public function __construct() {
parent::__construct();
	$this->load->library('dbx');
}
    // Read data from database to show data in admin page
    public function data() {
      	$sql="SELECT kk.*,c.nama as company
      			,CONCAT(p.nama,'<br />(',p.nip,')') as pemohon
      			,d.departemen,s.status as statustext
      			FROM hrm_ppkb_cek kk
      			LEFT JOIN hrm_company c ON kk.idcompany=c.replid
      			LEFT JOIN pegawai p ON kk.pemohon=p.replid
      			LEFT JOIN hrm_departemen d ON kk.iddepartemen=d.replid
      			LEFT JOIN hrm_status s ON kk.status=s.node
      			WHERE next_approver='".$this->session->userdata('idpegawai')."' AND kk.status NOT IN (1,2,3,4,11,12)
      			ORDER BY kk.tanggalpengajuan";
      	//echo $sql;die;
      	return $this->dbx->data($sql);
    }
    public function view_db($id='',$data) {
    	$data['id']=$id;
			$sql="SELECT kk.*,c.nama as company
					,CONCAT(p.nama,' (',p.nip,')') as pemohontext
					,d.departemen,s.status as statustext
					FROM hrm_ppkb_cek kk
					LEFT JOIN hrm_company c ON kk.idcompany=c.replid
					LEFT JOIN pegawai p ON kk.pemohon=p.replid
					LEFT JOIN hrm_departemen d ON kk.iddepartemen=d.replid
					LEFT JOIN hrm_status s ON kk.status=s.node
					WHERE kk.replid='".$id."'
					ORDER BY kk.tanggalpengajuan";
        $data['isi'] = $this->dbx->rows($sql);
      	/*
        $sql="SELECT pm.*,CONCAT('[',im.kode,'] ',' ',im.nama) as idmaterial,u.unit as idunit FROM hrm_ppkb_cek_mat pm
        		INNER JOIN inventory_material im ON pm.idmaterial=im.replid
        		INNER JOIN inventory_unit u ON pm.idunit=u.replid
        		WHERE idppkb_cek='".$id."'";
        $data['keperluan'] = $this->dbx->data($sql);

        $sql="SELECT pm.*,CONCAT('[',im.kode_jasa,'] ',' ',im.jasa) as idjasa,u.unit as idunit FROM hrm_ppkb_cek_jasa pm
        		INNER JOIN inventory_jasa im ON pm.idjasa=im.replid
        		INNER JOIN inventory_unit u ON pm.idunit=u.replid
        		WHERE idppkb_cek='".$id."'";
        $data['jasa'] = $this->dbx->data($sql);
        */
        $sql="SELECT pm.*,u.unit as idunit FROM hrm_ppkb_cek_lain pm
        		INNER JOIN inventory_unit u ON pm.idunit=u.replid
        		WHERE idppkb_cek='".$id."'";
        $data['lain'] = $this->dbx->data($sql);

        $sql="SELECT * FROM hrm_ppkb_cek_termin WHERE idppkb_cek='".$id."' ORDER BY due_date";
        $data['termin'] = $this->dbx->data($sql);

        $next_node=$this->dbx->next_node($data['isi']->status,"ppkb_cek");
        //AND j.iddepartemen IN ('".$data['isi']->iddepartemen."')
        $sqlapprover="SELECT DISTINCT p.replid,CONCAT(p.nama,' (',jx.jabatan,')') as nama
        				FROM pegawai p
        				INNER JOIN hrm_pegawai_jabatan pj ON pj.idpegawai=p.replid
        				INNER JOIN hrm_jabatan jx ON pj.idjabatan=jx.replid
        				WHERE p.aktif=1
        					AND pj.idcompany='".$data['isi']->idcompany."'
        					AND pj.idjabatan IN (SELECT j.replid FROM hrm_loa l
        										INNER JOIN hrm_jabatan j ON l.idjabatan_grup=j.idjabatan_grup
        										WHERE idmodul='ppkb_cek' AND l.node='".$next_node."'
        										AND IF(l.iddepartemen<>'',j.iddepartemen=l.iddepartemen,l.iddepartemen=0)
														AND IF(l.idjabatan<>'',j.replid=l.idjabatan,l.idjabatan=0 OR l.idjabatan IS NULL)
        										)
        				ORDER BY nama";
        //echo $sqlapprover;die;
        $data['approver_opt'] = $this->dbx->opt($sqlapprover,'up');

        //attachment
        $sql2="SELECT * FROM hrm_ppkb_cek_attachment WHERE idppkb_cek='".$id."'";
        $data['attachment'] = $this->dbx->data($sql2);

        return $data;
    }

    public function ubah($data,$id) {
	  $this->db->where('replid',$id);
	  $this->db->update('hrm_ppkb_cek', $data);
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
