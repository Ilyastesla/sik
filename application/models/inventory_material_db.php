<?php

Class inventory_material_db extends CI_Model {
public function __construct() {
parent::__construct();
	$this->load->library('dbx');
}
    // Read data from database to show data in admin page
    public function data() {
      $sql = "SELECT mt.*,mt.nama,k.nama as kelompok,mr.nama as merek,mf.nama as fiskal,ir.reff_nama as kelompok_inventaris
                  ,CONCAT(mf.nama,' [',mf.kode,']') as kodefiskaltext
,(SELECT COUNT(replid) FROM inventory_permintaan_barang_mat WHERE idmaterial=mt.replid) as pakai
          FROM inventory_material mt
          LEFT JOIN inventory_kelompok k ON mt.idkelompok=k.replid
          LEFT JOIN inventory_merek mr ON mt.idmerek=mr.replid
          LEFT JOIN inventory_fiskal mf ON mf.replid=k.idfiskal
          LEFT JOIN inventory_reff ir ON ir.replid=mt.idkelompok_inventaris AND ir.grup='inventaris'
          ORDER BY nama
          ";
      	$data['show_table']= $this->dbx->data($sql);
        return $data;
    }


    //TAMBAH
    //-------------------------------------------------------------------------------------------
    public function tambah_x($id='',$data) {
    	$data['id']=$id;
      $sql="SELECT mt.*,mr.nama as merektext FROM inventory_material mt
          LEFT JOIN inventory_merek mr ON mt.idmerek=mr.replid
          WHERE mt.replid='".$id."'";
        $data['isi'] = $this->dbx->rows($sql);

        if ($data['isi']== NULL ) {
					unset($data['isi']);
        	$sql="SELECT ".$this->dbx->tablecolumn('inventory_material').",1 as aktif,NULL as merektext";
					$data['isi']=$this->dbx->rows($sql);
        }
        $data['kelompok_opt'] = $this->dbx->opt("SELECT replid,nama FROM inventory_kelompok ORDER BY nama",'up');
        $data['kelompok_inventaris_opt'] = $this->dbx->opt("SELECT replid,reff_nama as nama FROM inventory_reff WHERE grup='inventaris' ORDER BY reff_nama",'up');
        $data['merek_opt'] = $this->dbx->opt("SELECT replid,nama FROM inventory_merek ORDER BY nama",'up');
        return $data;
    }

    public function view_db($id,$data) {
      	$sql = "SELECT mt.*,k.nama as kelompok,mr.nama as merek,CONCAT(mf.nama,' [',mf.kode,']') as kodefiskaltext,ir.reff_nama as kelompok_inventaris
											,(SELECT COUNT(replid) FROM inventory_permintaan_barang_mat WHERE idmaterial=mt.replid) as pakai
			      			FROM inventory_material mt
			      			LEFT JOIN inventory_kelompok k ON mt.idkelompok=k.replid
			      			LEFT JOIN inventory_merek mr ON mt.idmerek=mr.replid
			      			LEFT JOIN inventory_fiskal mf ON mf.replid=k.idfiskal
			      			LEFT JOIN inventory_reff ir ON ir.replid=mt.idkelompok_inventaris AND ir.grup='inventaris'
			      			WHERE mt.replid='".$id."'";
		$data['isi']=$this->dbx->rows($sql);

		$sqlbeli="SELECT ip.*,ipm.jumlah,u.unit as unittext,v.nama as vendortext,s.status as statustext
							FROM inventory_pembelian ip
							INNER JOIN inventory_pembelian_mat ipm ON ipm.idinventory_pembelian=ip.replid
							LEFT JOIN inventory_unit u ON ipm.idunit=u.replid
							LEFT JOIN inventory_vendor v ON ip.idvendor=v.replid
							LEFT JOIN hrm_status s ON ip.status=s.node
							WHERE ipm.idmaterial='".$id."'
							ORDER BY ip.tanggalpembelian DESC";
		$data['datapembelian']=$this->dbx->data($sqlbeli);
		return $data;
    }
}
?>
