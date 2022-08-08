<?php

Class inventory_terima_db extends CI_Model {
public function __construct() {
	parent::__construct();
	$this->load->library('dbx');
}
    // Read data from database to show data in admin page
    public function data($filter) {
			$cari="";
			if ($this->session->userdata('idstatus')<>""){
				$cari=$cari." AND kk.status='".$this->session->userdata('idstatus')."' ";
			}

			if (($this->session->userdata('periode1')<>"") AND ($this->session->userdata('periode2')=="")){
				$cari=$cari." AND kk.tanggalpengajuan >= '".$this->p_c->tgl_db($this->session->userdata('periode1'))."' ";
			}
			if (($this->session->userdata('periode1')=="") AND ($this->session->userdata('periode2')<>"")){
				$cari=$cari." AND kk.tanggalpengajuan <= '".$this->p_c->tgl_db($this->session->userdata('periode2'))."' ";
			}
			if (($this->session->userdata('periode1')<>"") AND ($this->session->userdata('periode2')<>"")){
				$cari=$cari." AND kk.tanggalpengajuan BETWEEN '".$this->p_c->tgl_db($this->session->userdata('periode1'))."' AND '".$this->p_c->tgl_db($this->session->userdata('periode2'))."' ";
			}
			if ($filter<>1){
					//$cari=$cari." AND kk.status<>4";
			}
			//kk.created_by='".$this->session->userdata('idpegawai')."'
			$sql="SELECT kk.*,kk.replid as idinventory_permintaan,c.nama as company,p.nama as pemohon,d.departemen,s.status as statustext,0 as app
								,kr.prioritas as prioritastext
								,DATE_ADD(kk.tanggalpengajuan,INTERVAL kr.periode DAY) as dateline
								,(DATE_ADD(kk.tanggalpengajuan,INTERVAL kr.periode DAY)<=CURRENT_DATE()) as urgent
								,ipb.* ,CONCAT('[',im.kode,'] ',' ',im.nama) as materialtext,u.unit as idunit
					FROM inventory_permintaan_barang kk
					LEFT JOIN hrm_company c ON kk.idcompany=c.replid
					LEFT JOIN pegawai p ON kk.pemohon=p.replid
					LEFT JOIN hrm_departemen d ON kk.iddepartemen=d.replid
					LEFT JOIN hrm_status s ON kk.status=s.replid
					LEFT JOIN reff_prioritas kr ON kr.replid=kk.idprioritas
					INNER JOIN inventory_penyerahan_barang_mat ipb ON kk.replid=ipb.idpermintaanbarang
					LEFT JOIN inventory_material im ON ipb.idmaterial=im.replid
					LEFT JOIN inventory_unit u ON ipb.idunit=u.replid
					 WHERE kk.idcompany=c.replid ".$cari."
					ORDER BY kk.tanggalpengajuan DESC";
			$data['show_table']=$this->dbx->data($sql);
			$data['idstatus_opt'] = $this->dbx->opt("select node as replid ,status as nama FROM hrm_status ORDER BY nama","up");
			return $data;
    }
}
?>
