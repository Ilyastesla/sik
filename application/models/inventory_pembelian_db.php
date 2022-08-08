<?php

Class inventory_pembelian_db extends CI_Model {
public function __construct() {
	parent::__construct();
	$this->load->library('dbx');
}
    // Read data from database to show data in admin page
    public function data() {
		$cari="";
		if ($this->input->post('idstatus')<>""){
			$cari=$cari." AND ibb.status='".$this->input->post('idstatus')."' ";
		}
		
		if (($this->input->post('periode1')<>"") AND ($this->input->post('periode2')=="")){
			$cari=$cari." AND ibb.tanggalpembelian >= '".$this->p_c->tgl_db($this->input->post('periode1'))."' ";
		}
		if (($this->input->post('periode1')=="") AND ($this->input->post('periode2')<>"")){
			$cari=$cari." AND ibb.tanggalpembelian <= '".$this->p_c->tgl_db($this->input->post('periode2'))."' ";
		}
		if (($this->input->post('periode1')<>"") AND ($this->input->post('periode2')<>"")){
			$cari=$cari." AND ibb.tanggalpembelian BETWEEN '".$this->p_c->tgl_db($this->input->post('periode1'))."' AND '".$this->p_c->tgl_db($this->input->userdata('periode2'))."' ";
		}

		if($cari==""){
			$cari=$cari." AND DATE_FORMAT(ibb.tanggalpembelian,'%Y-%d')=DATE_FORMAT(CURRENT_DATE(),'%Y-%d')";
		}

		$cari=$cari." AND ibb.idcompany='".$this->input->post('idcompany')."' ";
		
		

      	$sql="SELECT ibb.*,c.nama as company,v.nama as vendortext,s.status as statustext
						,(SELECT COUNT(*) FROM inventory_pembelian_mat WHERE idinventory_pembelian=ibb.replid) as jmlmat
						,(SELECT COUNT(*) FROM inventory_penyerahan_barang_mat WHERE idinventory_pembelian=ibb.replid) as jmlserah
						,ipb.kode_transaksi as kode_permintaan,ipb.kode_ppkb
      			FROM inventory_pembelian ibb
						LEFT JOIN inventory_permintaan_barang ipb ON ibb.idpermintaan_barang=ipb.replid
      			LEFT JOIN hrm_company c ON ibb.idcompany=c.replid
      			LEFT JOIN inventory_vendor v ON ibb.idvendor=v.replid
      			LEFT JOIN hrm_status s ON ibb.status=s.node
      			WHERE ibb.idcompany=c.replid ".$cari."
      			ORDER BY ibb.tanggalpembelian DESC";
		//echo $sql;die;
		$data['show_table']=$this->dbx->data($sql);

		$data['idstatus_opt'] = $this->dbx->opt("select node as replid ,status as nama FROM hrm_status ORDER BY nama","up");
		$companyrow=$this->session->userdata('idcompany');
		$sqlcompany="SELECT replid,nama as nama
								FROM hrm_company
								WHERE replid IN (".$companyrow.") AND aktif=1
								ORDER BY nama";
		$data['idcompany_opt'] = $this->dbx->opt($sqlcompany,'up');
		return $data;
    }


    //TAMBAH
    //-------------------------------------------------------------------------------------------
    public function tambah_x($id='',$data) {
    	$data['id']=$id;
      	$sql="SELECT *
      			FROM inventory_pembelian ipb
      			WHERE ipb.replid='".$id."'";
        $data['isi'] = $this->dbx->rows($sql);

		if ($data['isi']== NULL ) {
        	unset($data['isi']);
			$sql="SELECT ".$this->dbx->tablecolumn('inventory_pembelian').",'-' as kode_transaksi,0 as idpermintaan_barang, CURRENT_DATE() as tanggalpembelian,1 as status";
        	$data['isi']=$this->dbx->rows($sql);
        }

				//echo $data['isi']->idpermintaan_barang;
		$data['idpermintaan_barang_opt'] = $this->dbx->opt("SELECT replid,CONCAT(tanggalpengajuan,' | ', kode_transaksi) as nama
																												FROM inventory_permintaan_barang
																												WHERE idcompany='".$data['isi']->idcompany."' AND (replid='".$data['isi']->idpermintaan_barang."' OR status IN (2,'OP')) ORDER BY nama",'up');
																												//WHERE (replid='".$data['isi']->idpermintaan_barang."' OR (status<>4 AND replid NOT IN (SELECT idpermintaan_barang FROM inventory_pembelian))) ORDER BY nama",'up');
		$data['company_opt'] = $this->dbx->opt("select replid,CONCAT(company_code,' ',nama) as nama from hrm_company WHERE aktif=1 ORDER BY nama",'up');
        $data['idvendor_opt'] = $this->dbx->opt("select replid, nama from inventory_vendor ORDER BY nama",'up');
        return $data;
    }

	public function kode_transaksi($company,$tanggalpengajuan){
	    $kode_transaksi="";

	    //$sql="SELECT CONCAT(company_code,'/UMM/PB/',(SELECT DATE_FORMAT('".$tanggalpengajuan."','%Y%m')),'/') as kode_transaksi
	    //		FROM hrm_company WHERE replid='".$company."'";

			// XXX/PTKPP-upb/MM/YYYY
			$sql="SELECT CONCAT('/',company_code,'-UBB/') as company_code
								,DATE_FORMAT('".$tanggalpengajuan."','%Y') as yearx
								,DATE_FORMAT('".$tanggalpengajuan."','%m') as monthx
	    		FROM hrm_company WHERE replid='".$company."'";
			//echo $sql;die;
	    $query=$this->db->query($sql);
	    $isi=$query->row();
	    if ($query->num_rows() > 0) {
	    	$kode_transaksi=$isi->company_code.$this->p_c->romawi($isi->monthx).'/'.$isi->yearx;
	    }


	  $sql2="SELECT LPAD(LEFT(TRIM(kode_transaksi),3)+1,3,'0') as kode_transaksi2 FROM inventory_pembelian
							WHERE idcompany='".$company."' AND tanggalpembelian='".$tanggalpengajuan."' ORDER BY kode_transaksi2 LIMIT 1";
		//echo $sql2;die;
		 $query2=$this->db->query($sql2);
	    $isi2=$query2->row();
	    if ($query2->num_rows() > 0) {
	    	$kode_transaksi=$isi2->kode_transaksi2.$kode_transaksi;
	    }elseif ($kode_transaksi<>""){
		    $kode_transaksi="001".$kode_transaksi;
	    }
	    return $kode_transaksi;

    }

    public function tambah($data) {
    	//echo print_r(array_values($data));die;
    	$this->db->trans_start();
        $this->db->insert('inventory_pembelian', $data);
        $insert_id = $this->db->insert_id();
        if ($this->db->affected_rows() > 0) {
               $this->db->trans_complete();
               return $insert_id;
        } else {
        	$this->db->trans_complete();
            return false;
        }
     }

	public function ubah($data,$id) {
		//echo var_dump($data);die;
		$this->db->where('replid',$id);
		$this->db->update('inventory_pembelian', $data);
		if ($this->db->_error_number() == 0) {
		  return true;
		} else {
		  return false;
		}
	}


    //MATERIAL
    //-------------------------------------------------------------------------------------------
    public function ubahmaterial_x($data,$id='') {
    	$sql="SELECT km.*,im.nama as materialtext
      			FROM inventory_pembelian_mat km
      			LEFT JOIN inventory_material im ON km.idmaterial=im.replid
      			WHERE km.replid='".$id."'";
        $data['isi'] = $this->dbx->rows($sql);
				//echo $data['isi']->materialtext;die;

        if ($data['isi']== NULL ) {
        	unset($data['isi']);
        	$sql="SELECT
        			NULL as idmaterial,
					NULL as jumlah,
					0 as harga,
					0 as hargatambahan,
					0 as hargatotal,
					NULL as idunit,
					NULL as materialtext,
					NULL as idvendor,
					NULL as keterangan,
					NULL as nilai";
        	$data['isi']=$this->dbx->rows($sql);
        }

        $data['mat_opt'] = $this->dbx->opt("SELECT mat.* FROM
											(
											SELECT im.replid,CONCAT(im.nama,' [',im.kode,']') as nama FROM inventory_material im
											UNION
											SELECT replid,nama_paket as nama FROM inventory_paket_material
											) mat
											ORDER BY mat.nama",'up');
        $data['unit_opt'] = $this->dbx->opt("SELECT im.replid,im.unit as nama FROM inventory_unit im ORDER BY im.unit",'up');
		$data['idvendor_opt'] = $this->dbx->opt("SELECT replid, nama FROM inventory_vendor ORDER BY nama",'up');
    	return $data;
    }

    public function tambahmaterial_db($data) {
    	//echo print_r(array_values($data));die;
    	$this->db->trans_start();
        $this->db->insert('inventory_pembelian_mat', $data);
        $insert_id = $this->db->insert_id();
        if ($this->db->affected_rows() > 0) {
               $this->db->trans_complete();
               return $insert_id;
        } else {
        	$this->db->trans_complete();
            return false;
        }
     }
	public function ubahmaterial_db($data,$id) {
		//echo var_dump($data);die;
		$this->db->where('replid',$id);
		$this->db->update('inventory_pembelian_mat', $data);
		if ($this->db->_error_number() == 0) {
		  return true;
		} else {
		  return false;
		}
	}
	public function hapusmaterial_db($id) {
	    // Query to check whether username already exist or not
	    $this->db->where('replid',$id);
	    $this->db->delete('inventory_pembelian_mat');
	    if ($this->db->_error_number() == 0) {
	    	return true;
	    } else {
	        return false;
	    }
    }

    //VIEW
    //-------------------------------------------------------------------------------------------

    public function view_db($id='',$data) {
    	$data['id']=$id;
    	//,IF(penerima<>'',CONCAT(px.nama,' (',px.nip,')'),p.nama)  as penerimatext
      	$sql="SELECT ibb.*,c.nama as company,v.nama as vendortext,s.status as statustext
									,s.status as statustext
									,c.phone,c.fax,c.website,c.email,c.street,c.zip
									,(SELECT COUNT(*) FROM inventory_pembelian_mat WHERE idinventory_pembelian=ibb.replid) as jmlmat
									,(SELECT COUNT(*) FROM inventory_penyerahan_barang_mat WHERE idinventory_pembelian=ibb.replid) as jmlserah
									,ipb.kode_transaksi as kode_permintaan,ipb.kode_ppkb,CURRENT_DATE() as tglprint
			      			FROM inventory_pembelian ibb
									LEFT JOIN inventory_permintaan_barang ipb ON ibb.idpermintaan_barang=ipb.replid
			      			LEFT JOIN hrm_company c ON ibb.idcompany=c.replid
			      			LEFT JOIN inventory_vendor v ON ibb.idvendor=v.replid
			      			LEFT JOIN hrm_status s ON ibb.status=s.node
      			WHERE ibb.replid='".$id."'
      			ORDER BY ibb.tanggalpembelian";
        $data['isi'] = $this->dbx->rows($sql);

				$sql="SELECT pm.*,CONCAT('[',im.kode,'] ',' ',im.nama) as materialtext,pm.idmaterial,u.unit as idunit,im.stock,v.nama as vendor
									,(SELECT SUM(jml_serah) FROM inventory_penyerahan_barang_mat WHERE pm.idpermintaan_barang=idpermintaanbarang AND idmaterial=pm.idmaterial AND idpermintaan_mat=pm.replid) as total_serah
									,rf.reff_nama as peruntukantext
        		FROM inventory_permintaan_barang pb
				INNER JOIN inventory_permintaan_barang_mat pm ON pb.replid=pm.idpermintaan_barang
        		LEFT JOIN inventory_material im ON pm.idmaterial=im.replid
        		LEFT JOIN inventory_unit u ON pm.idunit=u.replid
						LEFT JOIN inventory_vendor v ON pm.idvendor=v.replid
						LEFT JOIN inventory_reff rf ON pm.idperuntukan=rf.replid
						WHERE idpermintaan_barang='".$data['isi']->idpermintaan_barang."'
						ORDER BY tanggalpengajuan,kode_transaksi";
				//WHERE pb.status=2
				//echo $sql;die;
        $data['materialpermintaan'] = $this->dbx->data($sql);

				$sql="SELECT pm.*,CONCAT('[',im.kode,'] ',' ',im.nama) as materialtext,pm.idmaterial,u.unit as unittext,im.stock
							,0 as total_serah
        		FROM inventory_pembelian_mat pm
        		LEFT JOIN inventory_material im ON pm.idmaterial=im.replid
        		LEFT JOIN inventory_unit u ON pm.idunit=u.replid
        		WHERE pm.idinventory_pembelian='".$id."'";
				//echo $sql;die;
        $data['material'] = $this->dbx->data($sql);
        return $data;
    }

    public function hapusmaterial2_db($id) {
	    // Query to check whether username already exist or not
	    $this->db->where('idinventory_pembelian',$id);
	    $this->db->delete('inventory_pembelian_mat');
	    if ($this->db->_error_number() == 0) {
	    	return true;
	    } else {
	        return false;
	    }
    }
    public function hapus_db($id) {
	    // Query to check whether username already exist or not
	    $this->db->where('replid',$id);
	    $this->db->delete('inventory_pembelian');
	    if ($this->db->_error_number() == 0) {
	    	return true;
	    } else {
	        return false;
	    }
    }

}
?>
