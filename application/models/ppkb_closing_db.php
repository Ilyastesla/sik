<?php

Class ppkb_closing_db extends CI_Model {
public function __construct() {
parent::__construct();
	$this->load->library('dbx');
}
    // Read data from database to show data in admin page
    public function data() {
      	$sql="SELECT pk.*
      				,c.nama as company
	      			,CONCAT(p.nama,'<br />(',p.nip,')') as pemohon
	      			,d.departemen
	      			,(SELECT SUM(jumlah) FROM `hrm_kaskecil` WHERE idppkb=r.idppkb) as jml_kk
	      			,(SELECT SUM(jumlah_realisasi) FROM `hrm_kaskecil` WHERE idppkb=r.idppkb) as real_kk
      			FROM hrm_ppkb_lain r
				INNER JOIN hrm_ppkb pk ON r.idppkb=pk.replid
				LEFT JOIN hrm_company c ON pk.idcompany=c.replid
      			LEFT JOIN pegawai p ON pk.pemohon=p.replid
      			LEFT JOIN hrm_datapengeluaran dp ON pk.idpengeluaran=dp.replid
      			LEFT JOIN hrm_departemen d ON pk.iddepartemen=d.replid
				WHERE pk.status=4 AND r.idadjustment=31 ORDER BY kode_transaksi";
      	return $this->dbx->data($sql);
    }

    public function view_db($id='',$data) {
    	$data['id']=$id;
    	//,IF(penerima<>'',CONCAT(px.nama,' (',px.nip,')'),p.nama)  as penerimatext
      	$sql="SELECT *
      				,c.nama as company
	      			,CONCAT(p.nama,' (',p.nip,')') as pemohontext
	      			,d.departemen
	      			,(SELECT SUM(jumlah) FROM `hrm_kaskecil` WHERE idppkb=r.idppkb) as jml_kk
	      			,(SELECT SUM(jumlah_realisasi) FROM `hrm_kaskecil` WHERE idppkb=r.idppkb) as real_kk
      			FROM hrm_ppkb_lain r
				INNER JOIN hrm_ppkb pk ON r.idppkb=pk.replid
				LEFT JOIN hrm_company c ON pk.idcompany=c.replid
      			LEFT JOIN pegawai p ON pk.pemohon=p.replid
      			LEFT JOIN hrm_datapengeluaran dp ON pk.idpengeluaran=dp.replid
      			LEFT JOIN hrm_departemen d ON pk.iddepartemen=d.replid
				WHERE pk.status=4 AND r.idadjustment=31
      				AND r.idppkb='".$id."'";
        $data['isi'] = $this->dbx->rows($sql);

        $sql2="	SELECT kk.*,c.nama as company,p.nama as pemohon,d.departemen,s.status as statustext,0 as app
      			,pk.kode_transaksi as noppkb
      			FROM hrm_kaskecil kk
      			LEFT JOIN hrm_company c ON kk.idcompany=c.replid
      			LEFT JOIN pegawai p ON kk.pemohon=p.replid
      			LEFT JOIN hrm_datapengeluaran dp ON kk.idpengeluaran=dp.replid
      			LEFT JOIN hrm_departemen d ON kk.iddepartemen=d.replid
      			LEFT JOIN hrm_status s ON kk.status=s.node
      			LEFT JOIN hrm_ppkb pk ON pk.replid=kk.idppkb
      			WHERE kk.idppkb='".$id."'
      			ORDER BY kk.tanggalpengajuan
      			";
        $data['datakaskecil']=$this->dbx->data($sql2);

        return $data;
    }

    public function ubah($data,$id) {
		//echo var_dump($data);die;
		$this->db->where('replid',$id);
		$this->db->update('hrm_ppkb', $data);
		if ($this->db->_error_number() == 0) {
		  return true;
		} else {
		  return false;
		}
	}

}
?>
