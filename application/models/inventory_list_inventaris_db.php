<?php
Class inventory_list_inventaris_db extends CI_Model {
public function __construct() {
parent::__construct();
	$this->load->library('dbx');
}
    // Read data from database to show data in admin page
    public function data() {
				$cari="";

				$cari=$cari." AND pb.idcompany='".$this->input->post('idcompany')."' ";

				if ($this->input->post('idkelompok')<>""){
					$cari=$cari." AND m.idkelompok='".$this->input->post('idkelompok')."' ";
				}

				if ($this->input->post('idfiskal')<>""){
					$cari=$cari." AND m.idfiskal='".$this->input->post('idfiskal')."' ";
				}

				if ($this->input->post('idkelompok_inventaris')<>""){
					$cari=$cari." AND pb.idkelompok_inventaris='".$this->input->post('idkelompok_inventaris')."' ";
				}

				if ($this->input->post('idkondisi')<>""){
					$cari=$cari." AND pb.idkondisi='".$this->input->post('idkondisi')."' ";
				}

				if ($this->input->post('idruang')<>""){
					$cari=$cari." AND pb.idruang='".$this->input->post('idruang')."' ";
				}

				if (($this->input->post('periode1')<>"") AND ($this->input->post('periode2')=="")){
					$cari=$cari." AND pb.tanggalserah >= '".$this->p_c->tgl_db($this->input->post('periode1'))."' ";
				}
				if (($this->input->post('periode1')=="") AND ($this->input->post('periode2')<>"")){
					$cari=$cari." AND pb.tanggalserah <= '".$this->p_c->tgl_db($this->input->post('periode2'))."' ";
				}
				if (($this->input->post('periode1')<>"") AND ($this->input->post('periode2')<>"")){
					$cari=$cari." AND pb.tanggalserah BETWEEN '".$this->p_c->tgl_db($this->input->post('periode1'))."' AND '".$this->p_c->tgl_db($this->input->post('periode2'))."' ";
				}

				
					$sql="SELECT pm.kode_transaksi ,pb.*,m.nama,mr.nama as merek,u.unit,ki.reff_nama as kelompok_inventaris
	      	 			,k.nama as kelompokbarang,ir.nama as ruangan,f.nama as fiskaltext
								,ki2.reff_nama as kondisi, 0 as hargabeli, m.replid as idmaterial,pm.pemohon as idpemohon
								, c.nama as companytext,d.departemen as departementext
					FROM inventory_penyerahan_barang_mat pb
					LEFT JOIN inventory_ruang ir ON pb.idruang=ir.replid
					LEFT JOIN inventory_permintaan_barang pm ON pm.replid=pb.idpermintaanbarang
					LEFT JOIN inventory_material m ON pb.idmaterial=m.replid
					LEFT JOIN inventory_fiskal f ON m.idfiskal=f.replid
					LEFT JOIN inventory_kelompok k ON m.idkelompok=k.replid
					LEFT JOIN inventory_merek mr ON m.idmerek=mr.replid
					LEFT JOIN inventory_reff ki ON pb.idkelompok_inventaris=ki.replid AND ki.grup='inventaris'
					LEFT JOIN inventory_reff ki2 ON pb.idkondisi=ki2.replid AND ki2.grup='kondisibarang'
					LEFT JOIN inventory_unit u ON pb.idunit=u.replid
					LEFT JOIN hrm_company c ON pb.idcompany=c.replid
					LEFT JOIN hrm_departemen d ON pb.iddepartemen=d.replid
					WHERE m.inventaris=1 ".$cari."
					ORDER BY pb.kode_inventaris";
					$data['show_table']=$this->dbx->data($sql);


				$data['fiskal_opt'] = $this->dbx->opt("SELECT replid,nama FROM inventory_fiskal ORDER BY nama",'up');
				$data['kelompok_opt'] = $this->dbx->opt("SELECT replid,nama FROM inventory_kelompok ORDER BY nama",'up');
        $data['idkelompok_inventaris_opt'] = $this->dbx->opt("SELECT replid,reff_nama as nama FROM inventory_reff WHERE grup='inventaris' ORDER BY reff_nama",'up');
				$data['idkondisi_opt'] = $this->dbx->opt("SELECT replid,reff_nama as nama FROM inventory_reff WHERE grup='kondisibarang' ORDER BY reff_nama",'up');
				$data['idruang_opt'] = $this->dbx->opt("SELECT replid, nama FROM inventory_ruang ORDER BY nama",'up');
				$companyrow=$this->session->userdata('idcompany');
		$sqlcompany="SELECT replid,nama as nama
								FROM hrm_company
								WHERE replid IN (".$companyrow.") AND aktif=1
								ORDER BY nama";
		$data['idcompany_opt'] = $this->dbx->opt($sqlcompany,'up');
      	return $data;
    }
}
?>
