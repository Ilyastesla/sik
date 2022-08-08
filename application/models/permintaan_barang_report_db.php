<?php

Class permintaan_barang_report_db extends CI_Model {
public function __construct() {
	parent::__construct();
	$this->load->library('dbx');
}
    // Read data from database to show data in admin page
    public function data($filter) {
				$cari="";
				if ($this->session->userdata('iddepartemen')<>""){
					$cari=$cari." AND kk.iddepartemen='".$this->session->userdata('iddepartemen')."' ";
				}
				if ($this->session->userdata('pemohon')<>""){
					$cari=$cari." AND kk.pemohon='".$this->session->userdata('pemohon')."' ";
				}
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
						$cari=$cari." AND kk.status<>4";
				}

      	$sql="SELECT kk.*,c.nama as company,p.nama as pemohon,d.departemen,s.status as statustext,0 as app
									,kr.prioritas as prioritastext
									,DATE_ADD(kk.tanggalpengajuan,INTERVAL kr.periode DAY) as dateline
									,(DATE_ADD(kk.tanggalpengajuan,INTERVAL kr.periode DAY)<=CURRENT_DATE()) as urgent
									,pm.hargatotal,pm.jumlah,CONCAT('[',im.kode,'] ',' ',im.nama) as materialtext,pm.idmaterial,u.unit as idunit,im.stock,v.nama as vendor
									,(SELECT SUM(jml_serah) FROM inventory_penyerahan_barang_mat WHERE pm.idpermintaan_barang=idpermintaanbarang AND idmaterial=pm.idmaterial AND idpermintaan_mat=pm.replid) as total_serah
									,rf.reff_nama as peruntukantext
      			FROM inventory_permintaan_barang kk
      			LEFT JOIN hrm_company c ON kk.idcompany=c.replid
      			LEFT JOIN pegawai p ON kk.pemohon=p.replid
      			LEFT JOIN hrm_departemen d ON kk.iddepartemen=d.replid
      			LEFT JOIN hrm_status s ON kk.status=s.node
						LEFT JOIN reff_prioritas kr ON kr.replid=kk.idprioritas
						LEFT JOIN inventory_permintaan_barang_mat pm ON kk.replid=pm.idpermintaan_barang
        		LEFT JOIN inventory_material im ON pm.idmaterial=im.replid
        		LEFT JOIN inventory_unit u ON pm.idunit=u.replid
						LEFT JOIN inventory_vendor v ON pm.idvendor=v.replid
						LEFT JOIN inventory_reff rf ON pm.idperuntukan=rf.replid
      			 WHERE  kk.idcompany=c.replid ".$cari."
      			ORDER BY kk.tanggalpengajuan,kk.kode_transaksi DESC";
				$data['show_table']=$this->dbx->data($sql);
				$data['idstatus_opt'] = $this->dbx->opt("select node as replid ,status as nama FROM hrm_status ORDER BY nama","up");
				$data['pemohon_opt'] = $this->dbx->opt("select replid,CONCAT(nama,' [',nip,']') as nama from pegawai where aktif=1 ORDER BY nama","up");
        $data['departemen_opt'] = $this->dbx->opt("select replid,departemen as nama from hrm_departemen WHERE aktif=1 ORDER BY departemen",'up');

      	return $data;
    }
}
?>
