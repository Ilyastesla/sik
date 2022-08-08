<?php

Class inventory_pengembalian_db extends CI_Model {
public function __construct() {
parent::__construct();
	$this->load->library('dbx');
}
    // Read data from database to show data in admin page
    public function data() {
      	$sql="SELECT kk.*,p.nama as pemohon,s.status as statustext
      			,c.nama as company,c.kodecabang
      			,d.departemen,d.kodedepartemen
      			FROM inventory_peminjaman kk
      			LEFT JOIN hrm_company c ON kk.idcompany=c.replid
      			LEFT JOIN pegawai p ON kk.pemohon=p.replid
      			LEFT JOIN hrm_departemen d ON kk.iddepartemen=d.replid
      			LEFT JOIN hrm_status s ON kk.status=s.node
      			WHERE kk.status>=2
      			ORDER BY kk.tanggalpengajuan";
      	return $this->dbx->data($sql);
    }

    //VIEW
    //-------------------------------------------------------------------------------------------

    public function view_db($id='',$data) {
    	$data['id']=$id;
    	//,IF(penerima<>'',CONCAT(px.nama,' (',px.nip,')'),p.nama)  as penerimatext
    	//,(SELECT tanggalserah FROM inventory_pengembalian_barang WHERE idpermintaanbarang=kk.replid ORDER BY tanggalserah DESC LIMIT 1) as tanggalserah

      	$sql="SELECT kk.*,c.nama as company,CONCAT(p.nama,' (',p.nip,')') as pemohontext,d.departemen,s.status as statustext
      				,c.phone,c.fax,c.website,c.email,c.street,c.zip
	      			,c.nama as company,c.kodecabang
	      			,d.departemen,d.kodedepartemen
      			FROM inventory_peminjaman kk
      			LEFT JOIN hrm_company c ON kk.idcompany=c.replid
      			LEFT JOIN pegawai p ON kk.pemohon=p.replid
      			LEFT JOIN hrm_departemen d ON kk.iddepartemen=d.replid
      			LEFT JOIN hrm_status s ON kk.status=s.node
      			WHERE kk.replid='".$id."'
      			ORDER BY kk.tanggalpengajuan";
        $data['isi'] = $this->dbx->rows($sql);

        $sql="SELECT pm.*,CONCAT('[',im.kode,'] ',' ',im.nama) as materialtext,u.unit as idunit,im.stock,im.atk
        			,(SELECT SUM(jml_serah) FROM inventory_pengembalian_barang WHERE pm.idpermintaan_barang=idpermintaanbarang AND idmaterial=pm.idmaterial) as total_serah
        		FROM inventory_pengembalian_mat pm
        		LEFT JOIN inventory_material im ON pm.idmaterial=im.replid
        		LEFT JOIN inventory_unit u ON pm.idunit=u.replid
        		WHERE idpermintaan_barang='".$id."'";
        $data['material'] = $this->dbx->data($sql);

        return $data;
    }

    public function penyerahan_material($id,$idmat,$data=""){
	    $sql="SELECT pm.*
	    			,CONCAT('[',im.kode,'] ',' ',im.nama) as materialtext,u.unit as idunit,im.stock,im.atk
        			,kk.kode_transaksi,kk.tanggalpengajuan,CURRENT_DATE() as tanggalserah
        			,c.kodecabang,d.kodedepartemen,f.kode as kodefiskal,im.kode as kodematerial
        			,pb.jml_serah,pb.idkelompok_inventaris,pb.idruang
        		FROM inventory_pengembalian_mat pm
        		INNER JOIN inventory_pengembalian kk ON kk.replid=pm.idpermintaan_barang
        		LEFT JOIN hrm_company c ON kk.idcompany=c.replid
        		LEFT JOIN hrm_departemen d ON kk.iddepartemen=d.replid
        		LEFT JOIN inventory_material im ON pm.idmaterial=im.replid
        		LEFT JOIN inventory_fiskal f ON f.replid=im.idfiskal
        		LEFT JOIN inventory_unit u ON pm.idunit=u.replid
        		LEFT JOIN inventory_pengembalian_barang pb ON pm.idpermintaan_barang=pb.idpermintaanbarang AND pb.idmaterial=pm.idmaterial
        		WHERE pm.idpermintaan_barang='".$id."' AND pm.idmaterial='".$idmat."' ";
        //echo $sql;die;
        $data['isi'] = $this->dbx->rows($sql);
        $data['kelompok_inventaris_opt'] = $this->dbx->opt("SELECT replid,reff_nama as nama FROM inventory_reff WHERE grup='inventaris' ORDER BY reff_nama",'up');
        $data['ruang_opt'] = $this->dbx->opt("SELECT replid, nama FROM inventory_ruang ORDER BY nama",'up');
        $data['unit_opt'] = $this->dbx->opt("SELECT im.replid,im.unit as nama FROM inventory_unit im ORDER BY im.unit",'up');

        return $data;

    }
    public function hapus_db($id) {
	    // Query to check whether username already exist or not
	    $this->db->where('replid',$id);
	    $this->db->delete('inventory_pengembalian');
	    if ($this->db->_error_number() == 0) {
	    	return true;
	    } else {
	        return false;
	    }
    }


    public function kode_inventaris($tahun,$kode){
	    $sql2="SELECT LPAD(RIGHT(RIGHT(trim(kode_inventaris),31),4)+1,4,'0') as kode_transaksi2 FROM inventory_pengembalian_barang where year(tanggalserah)='".$tahun."'
ORDER BY RIGHT(RIGHT(trim(kode_inventaris),31),4) DESC LIMIT 1";
	   $query2=$this->db->query($sql2);
	    $isi2=$query2->row();
	    if ($query2->num_rows() > 0) {
	    	$kode_inventaris=$kode.'.'.$isi2->kode_transaksi2;
	    }else{
		    $kode_inventaris=$kode.'.'."0001";
	    }
	    return $kode_inventaris;
    }


    public function tambah_inventaris_db($data) {
    	//echo print_r(array_values($data));die;
    	$this->db->trans_start();
        $this->db->insert('inventory_pengembalian_barang', $data);
        $insert_id = $this->db->insert_id();
        if ($this->db->affected_rows() > 0) {
               $this->db->trans_complete();
               return true;
        } else {
        	$this->db->trans_complete();
            return false;
        }
     }

     public function hapus_inventaris_db($id) {
	    // Query to check whether username already exist or not
	    $this->db->where('replid',$id);
	    $this->db->delete('inventory_pengembalian_barang');
	    if ($this->db->_error_number() == 0) {
	    	return true;
	    } else {
	        return false;
	    }
    }

    public function noinventaris_db($id,$idmat){
	    $sql="SELECT pb.*,u.unit,ki.reff_nama as kelompok_inventaris
	    		FROM inventory_peminjaman pb
	    		LEFT JOIN inventory_reff ki ON pb.idkelompok_inventaris=ki.replid AND ki.grup='inventaris'
	    		LEFT JOIN inventory_unit u ON pb.idunit=u.replid
	    		WHERE pb.idpermintaanbarang='".$id."' AND pb.idmaterial='".$idmat."' ORDER BY pb.kode_inventaris";
        //echo $sql;die;
        $rowpdv=$this->dbx->data($sql);
		return $rowpdv;

    }

    public function ubahstatuspermintaan($id) {
    	$sql=("SELECT SUM(jumlah) as jml_minta FROM inventory_pengembalian_mat WHERE idpermintaan_barang='".$id."'");
    	$rowminta=$this->dbx->rows($sql);
    	$sql2=("SELECT SUM(jml_serah) as jml_serah FROM inventory_pengembalian_barang WHERE idpermintaanbarang='".$id."'");
    	$rowserah=$this->dbx->rows($sql2);

    	if ($rowminta->jml_minta<>$rowserah->jml_serah){
	    	$status=14;
    	}else{
	    	$status=4;
    	}
    	$data = array(
				"status"=> $status,
				"modified_date"=> $this->dbx->cts(),
				"modified_by"=> $this->session->userdata('idpegawai'));
		//echo var_dump($data);die;
		$this->db->where('replid',$id);
		$this->db->update('inventory_pengembalian', $data);
		if ($this->db->_error_number() == 0) {
		  return true;
		} else {
		  return false;
		}
	}

	public function ambilstock($idmat,$stock) {
		$data = array(
				"stock"=> $stock,
				);
		$this->db->where('replid',$idmat);
		$this->db->update('inventory_material', $data);
		if ($this->db->_error_number() == 0) {
		  return true;
		} else {
		  return false;
		}
	}



}
?>
