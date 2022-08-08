<?php

Class inventory_pembelian_report_db extends CI_Model {
public function __construct() {
	parent::__construct();
	$this->load->library('dbx');
}
    // Read data from database to show data in admin page
    public function data($filter) {
			$cari="";
			if ($this->session->userdata('idstatus')<>""){
				$cari=$cari." AND ipb.status='".$this->session->userdata('idstatus')."' ";
			}
			if (($this->session->userdata('periode1')<>"") AND ($this->session->userdata('periode2')=="")){
				$cari=$cari." AND ipb.tanggalpembelian >= '".$this->p_c->tgl_db($this->session->userdata('periode1'))."' ";
			}
			if (($this->session->userdata('periode1')=="") AND ($this->session->userdata('periode2')<>"")){
				$cari=$cari." AND ipb.tanggalpembelian <= '".$this->p_c->tgl_db($this->session->userdata('periode2'))."' ";
			}
			if (($this->session->userdata('periode1')<>"") AND ($this->session->userdata('periode2')<>"")){
				$cari=$cari." AND ipb.tanggalpembelian BETWEEN '".$this->p_c->tgl_db($this->session->userdata('periode1'))."' AND '".$this->p_c->tgl_db($this->session->userdata('periode2'))."' ";
			}
			if ($filter<>1){
					$cari=$cari." AND DATE_FORMAT(ipb.tanggalpembelian,'%Y-%d')=DATE_FORMAT(CURRENT_DATE(),'%Y-%d')";
			}
      	$sql="SELECT ipb.*,c.nama as company,v.nama as vendortext,s.status as statustext
						,(SELECT COUNT(*) FROM inventory_pembelian_mat WHERE idinventory_pembelian=ipb.replid) as jmlmat
						,(SELECT COUNT(*) FROM inventory_penyerahan_barang_mat WHERE idinventory_pembelian=ipb.replid) as jmlserah
						,pm.*,CONCAT('[',im.kode,'] ',' ',im.nama) as materialtext,pm.idmaterial,u.unit as unittext,im.stock
								 ,0 as total_serah
      			FROM inventory_pembelian ipb
      			LEFT JOIN hrm_company c ON ipb.idcompany=c.replid
      			LEFT JOIN inventory_vendor v ON ipb.idvendor=v.replid
      			LEFT JOIN hrm_status s ON ipb.status=s.node 
						LEFT JOIN inventory_pembelian_mat pm ON ipb.replid=pm.idinventory_pembelian
        		LEFT JOIN inventory_material im ON pm.idmaterial=im.replid
        		LEFT JOIN inventory_unit u ON pm.idunit=u.replid
      			 WHERE ipb.idcompany=c.replid ".$cari."
      			ORDER BY ipb.tanggalpembelian DESC";
				$data['show_table']=$this->dbx->data($sql);
				$data['idstatus_opt'] = $this->dbx->opt("select node as replid ,status as nama FROM hrm_status ORDER BY nama","up");
				return $data;
    }
}
?>
