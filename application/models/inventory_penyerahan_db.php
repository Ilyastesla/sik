<?php

Class inventory_penyerahan_db extends CI_Model {
public function __construct() {
parent::__construct();
	$this->load->library('dbx');
}
    // Read data from database to show data in admin page
    public function data() {
			$cari="";
			$cari=$cari." AND kk.idcompany='".$this->input->post('idcompany')."' ";
			if ($this->input->post('pemohon')<>""){
				$cari=$cari." AND kk.pemohon='".$this->input->post('pemohon')."' ";
			}

			if ($this->input->post('idstatus')<>""){
				$cari=$cari." AND kk.status='".$this->input->post('idstatus')."' ";
			}else{
				$cari=$cari." AND kk.status>=2 ";

			}

			if (($this->input->post('periode1')<>"") AND ($this->input->post('periode2')=="")){
				$cari=$cari." AND kk.tanggalpengajuan >= '".$this->p_c->tgl_db($this->input->post('periode1'))."' ";
			}
			if (($this->input->post('periode1')=="") AND ($this->input->post('periode2')<>"")){
				$cari=$cari." AND kk.tanggalpengajuan <= '".$this->p_c->tgl_db($this->input->post('periode2'))."' ";
			}
			if (($this->input->post('periode1')<>"") AND ($this->input->post('periode2')<>"")){
				$cari=$cari." AND kk.tanggalpengajuan BETWEEN '".$this->p_c->tgl_db($this->input->post('periode1'))."' AND '".$this->p_c->tgl_db($this->input->post('periode2'))."' ";
			}
			if ($this->input->post('filter')<>1){
					$cari=$cari." AND kk.status<>4";
			}

			//if ($filter<>1){
			//	$data['show_table']=NULL;
			//}else{
      	$sql=" SELECT kk.*,c.nama as company,p.nama as pemohon,d.departemen,s.status as statustext,0 as app
									,kr.prioritas as prioritastext
									,DATE_ADD(kk.tanggalpengajuan,INTERVAL kr.periode DAY) as dateline
									,(DATE_ADD(kk.tanggalpengajuan,INTERVAL kr.periode DAY)<=CURRENT_DATE()) as urgent
      			FROM inventory_permintaan_barang kk
      			LEFT JOIN hrm_company c ON kk.idcompany=c.replid
      			LEFT JOIN pegawai p ON kk.pemohon=p.replid
      			LEFT JOIN hrm_departemen d ON kk.iddepartemen=d.replid
      			LEFT JOIN hrm_status s ON kk.status=s.node
						LEFT JOIN reff_prioritas kr ON kr.replid=kk.idprioritas
      			WHERE kk.status=s.node ".$cari."
      			ORDER BY dateline DESC ";
						//echo $sql;die;
      	$data['show_table']=$this->dbx->data($sql);
			//}
		$data['pemohon_opt'] = $this->dbx->opt("select replid,CONCAT(nama,' [',nip,']') as nama from pegawai where aktif=1 ORDER BY nama","up");
		$data['idstatus_opt'] = $this->dbx->opt("select node as replid,status as nama FROM hrm_status WHERE node in ('OP','2','4')ORDER BY nama","up");
		$companyrow=$this->session->userdata('idcompany');
		$sqlcompany="SELECT replid,nama as nama
								FROM hrm_company
								WHERE replid IN (".$companyrow.") AND aktif=1
								ORDER BY nama";
		$data['idcompany_opt'] = $this->dbx->opt($sqlcompany,'up');
		return $data;
    }

    //VIEW
    //-------------------------------------------------------------------------------------------

    public function view_db($id,$data,$idpenyerahan="") {
    	$data['id']=$id;
    	//,IF(penerima<>'',CONCAT(px.nama,' (',px.nip,')'),p.nama)  as penerimatext
    	//,(SELECT tanggalserah FROM inventory_penyerahan_barang_mat WHERE idpermintaanbarang=kk.replid ORDER BY tanggalserah DESC LIMIT 1) as tanggalserah

      	$sql="SELECT kk.*,kk.replid as idpermintaanbarang,c.nama as company,d.departemen
      				,s.status as statustext
      				,c.phone,c.fax,c.website,c.email,c.street,c.zip
							,prioritas as prioritastext
							,DATE_ADD(kk.tanggalpengajuan,INTERVAL kr.periode DAY) as dateline
							,(DATE_ADD(kk.tanggalpengajuan,INTERVAL kr.periode DAY)<=CURRENT_DATE()) as urgent
							,CURRENT_DATE() as tglprint,c.city as citycompanytext
      			FROM inventory_permintaan_barang kk
      			LEFT JOIN hrm_company c ON kk.idcompany=c.replid
      			LEFT JOIN pegawai p ON kk.pemohon=p.replid
      			LEFT JOIN hrm_departemen d ON kk.iddepartemen=d.replid
      			LEFT JOIN hrm_status s ON kk.status=s.node
				LEFT JOIN reff_prioritas kr ON kr.replid=kk.idprioritas
      			WHERE kk.replid='".$id."'
      			ORDER BY kk.tanggalpengajuan";
				//echo $sql;die;
        $data['isi'] = $this->dbx->rows($sql);

				$penyerahanfilter="";
				if(($idpenyerahan<>"") and ($data['edit']<>1)){
						$penyerahanfilter=" AND pm.idmaterial IN (SELECT idmaterial FROM inventory_penyerahan_barang_mat pb WHERE pb.idinventory_penyerahan='".$idpenyerahan."' AND  pb.idpermintaanbarang='".$id."') ";
				}

		$fil_idinventory_penyerahan="";
		if($idpenyerahan<>""){
			$fil_idinventory_penyerahan=" AND idinventory_penyerahan='".$idpenyerahan."'";
		}
        $sql="SELECT pm.*,CONCAT('[',im.kode,'] ',' ',im.nama) as materialtext,pm.idmaterial,u.unit as idunit,im.stock,im.inventaris,CONCAT(mf.nama,' [',mf.kode,']') as kodefiskaltext,k.idfiskal,im.idkelompok,k.nama as kelompokbarangtext
        			,(SELECT SUM(jml_serah) FROM inventory_penyerahan_barang_mat WHERE pm.idpermintaan_barang=idpermintaanbarang AND idmaterial=pm.idmaterial AND idpermintaan_mat=pm.replid ".$fil_idinventory_penyerahan.") as total_serah
        		FROM inventory_permintaan_barang_mat pm
        		LEFT JOIN inventory_material im ON pm.idmaterial=im.replid
        		LEFT JOIN inventory_unit u ON pm.idunit=u.replid
				LEFT JOIN inventory_kelompok k ON k.replid=im.idkelompok
				LEFT JOIN inventory_fiskal mf ON mf.replid=k.idfiskal
        		WHERE idpermintaan_barang='".$id."' ".$penyerahanfilter;
				//echo $sql;die;
        $data['material'] = $this->dbx->data($sql);

				$sql="SELECT pyb.*,(SELECT SUM(jml_serah) FROM inventory_penyerahan_barang_mat WHERE idinventory_penyerahan=pyb.replid) as pakaiserah 
						FROM inventory_penyerahan_barang pyb WHERE pyb.idpermintaan_barang='".$id."' ";
				if($idpenyerahan<>""){
					$sql=$sql." AND replid='".$idpenyerahan."'";
					$data['penyerahan_head'] = $this->dbx->rows($sql);
				}else{
					$data['penyerahan_head'] = $this->dbx->data($sql);
				}
        return $data;
    }


	public function material_stiker_print_db($data,$idinventaris) {
        $sql="SELECT pm.*,CONCAT('[',im.kode,'] ',' ',im.nama) as materialtext, c.nama as companytext,d.departemen as departementext
		,k.nama as kelompokbarangtext,c.logo 
        		FROM inventory_penyerahan_barang_mat pm
        		LEFT JOIN inventory_material im ON pm.idmaterial=im.replid
				LEFT JOIN inventory_kelompok k ON k.replid=im.idkelompok
				LEFT JOIN hrm_company c ON pm.idcompany=c.replid
				LEFT JOIN hrm_departemen d ON pm.iddepartemen=d.replid
        		WHERE pm.replid='".$idinventaris."' ";
				//echo $sql;die;
        $data['material'] = $this->dbx->data($sql);
        return $data;
    }

		public function tambah_x($id='',$data) {
				$data['id']=$id;
					$sql="SELECT *,(SELECT nilai from hrm_setting where setting='KK') as limitkk
							FROM inventory_permintaan_barang kk
							WHERE kk.replid='".$id."'";
					$data['isi'] = $this->dbx->rows($sql);

					if ($data['isi']== NULL ) {
						unset($data['isi']);
						$sql="SELECT
								NULL as replid,
						'-' as kode_transaksi,
						(SELECT idcompany FROM pegawai
							WHERE replid='".$this->input->post('idpegawai')."') as idcompany,
						NULL as pemohon,
						NULL as iddepartemen,
						NULL as penerima,
						CURRENT_DATE() as tanggalpengajuan,
						NULL as keterangan,
						1 as status,
						NULL as created_date,
						NULL as created_by,
						NULL as modified_date,
						NULL as modified_by
						";
						$data['isi']=$this->dbx->rows($sql);
					}
					return $data;
		}

	public function head_penyerahan_material($idpermintaan,$idpenyerahan,$data) {
		$sqlminta="SELECT * FROM inventory_permintaan_barang WHERE replid='".$idpermintaan."'";
		$data['permintaan']=$this->dbx->rows($sqlminta);

		$sql="SELECT *
				FROM inventory_penyerahan_barang ipb
				WHERE ipb.replid='".$idpenyerahan."'";
		$data['isi'] = $this->dbx->rows($sql);

		if ($data['isi']== NULL ) {
			unset($data['isi']);
			$sql="SELECT ".$this->dbx->tablecolumn('inventory_penyerahan_barang').",'".$idpermintaan."' as idpermintaan_barang,CURRENT_DATE() as tanggalserah,1 as status";
			//echo $sql;die;
			$data['isi']=$this->dbx->rows($sql);
			
		}

		if($data['permintaan']->idcompany<>14){
			$sqlpeg="select replid,CONCAT(nama,' [',nip,']') as nama FROM pegawai WHERE aktif=1 AND idcompany='".$data['permintaan']->idcompany."' ORDER BY nama";
		}else{
			$sqlpeg="select replid,CONCAT(nama,' [',nip,']') as nama FROM pegawai WHERE aktif=1 ORDER BY nama";
		}

		$data['idpegawai_opt'] = $this->dbx->opt($sqlpeg,"up");
		return $data;
	}



    public function penyerahan_material($data,$idpermintaan_mat,$idpenyerahan){
			//,CURRENT_DATE() as tanggalserah
	    $sql="SELECT pm.*
	    			,CONCAT('[',im.kode,'] ',' ',im.nama) as materialtext,u.unit as idunit,im.stock,im.inventaris
        			,kk.kode_transaksi,kk.tanggalpengajuan
        			,c.kodecabang,d.kodedepartemen,f.kode as kodefiskal,im.kode as kodematerial
        			,pb.jml_serah,pb.idkelompok_inventaris,pb.idruang
        			,pm.idpermintaan_barang, pm.idmaterial, pb.idinventory_pembelian
					,pyb.tanggalserah, pyb.kode_transaksi as kodepenyerahan,kk.iddepartemen as iddepartemenpermintaan,pb.idpj,kk.idcompany
					,(SELECT SUM(jml_serah) FROM inventory_penyerahan_barang_mat WHERE pm.idpermintaan_barang=idpermintaanbarang AND idmaterial=pm.idmaterial AND idpermintaan_mat=pm.replid) as total_serah
					,pb.iddepartemen
        		FROM
						inventory_permintaan_barang_mat pm
        		INNER JOIN inventory_permintaan_barang kk ON kk.replid=pm.idpermintaan_barang
        		LEFT JOIN hrm_company c ON kk.idcompany=c.replid
        		LEFT JOIN hrm_departemen d ON kk.iddepartemen=d.replid
        		LEFT JOIN inventory_material im ON pm.idmaterial=im.replid
				LEFT JOIN inventory_kelompok k ON k.replid=im.idkelompok
        		LEFT JOIN inventory_fiskal f ON f.replid=k.idfiskal
        		LEFT JOIN inventory_unit u ON pm.idunit=u.replid
				LEFT JOIN inventory_penyerahan_barang pyb ON pyb.idpermintaan_barang=pm.idpermintaan_barang
				LEFT JOIN inventory_penyerahan_barang_mat pb ON pm.idpermintaan_barang=pb.idpermintaanbarang AND pb.idmaterial=pm.idmaterial
        		WHERE pyb.replid='".$idpenyerahan."' AND pm.replid='".$idpermintaan_mat."' ";
        //echo $sql;die;
        $data['isi'] = $this->dbx->rows($sql);
		
		if($data['isi']->idcompany<>14){
			$sqlpeg="select replid,CONCAT(nama,' [',nip,']') as nama FROM pegawai WHERE aktif=1 AND idcompany='".$data['isi']->idcompany."' ORDER BY nama";
		}else{
			$sqlpeg="select replid,CONCAT(nama,' [',nip,']') as nama FROM pegawai WHERE aktif=1 ORDER BY nama";
		}
		$data['idpj_opt'] = $this->dbx->opt($sqlpeg,"up");


        $data['kelompok_inventaris_opt'] = $this->dbx->opt("SELECT replid,reff_nama as nama FROM inventory_reff WHERE grup='inventaris' ORDER BY reff_nama",'up');
        $data['ruang_opt'] = $this->dbx->opt("SELECT replid, nama FROM inventory_ruang ORDER BY nama",'up');
        $data['unit_opt'] = $this->dbx->opt("SELECT im.replid,im.unit as nama FROM inventory_unit im ORDER BY im.unit",'up');
		$data['idinventory_pembelian_opt'] = $this->dbx->opt("SELECT a.replid,a.kode_transaksi as nama
																FROM inventory_pembelian a
																INNER JOIN inventory_pembelian_mat b ON a.replid=b.idinventory_pembelian
																WHERE b.idmaterial='".$data['isi']->idmaterial."' AND a.status<>4
																ORDER BY nama",'up');
		
		$data['iddepartemen_opt'] = $this->dbx->opt("select replid,departemen as nama FROM hrm_departemen WHERE aktif=1 AND idcompany='".$data['isi']->idcompany."' ORDER BY departemen",'up');
        return $data;

    }
    public function hapus_db($id) {
	    // Query to check whether username already exist or not
	    $this->db->where('replid',$id);
	    $this->db->delete('inventory_permintaan_barang');
	    if ($this->db->_error_number() == 0) {
	    	return true;
	    } else {
	        return false;
	    }
    }


    public function kode_inventaris($tahun,$kode){
	    //$sql2="SELECT LPAD(RIGHT(RIGHT(trim(kode_inventaris),31),4)+1,4,'0') as kode_transaksi2 FROM inventory_penyerahan_barang_mat where year(tanggalserah)='".$tahun."' ORDER BY RIGHT(RIGHT(trim(kode_inventaris),31),4) DESC LIMIT 1";
		$sql2="SELECT LPAD(RIGHT(TRIM(kode_inventaris), 4)+1,4,'0') as kode_transaksi2 FROM inventory_penyerahan_barang_mat where year(tanggalserah)='".$tahun."' ORDER BY RIGHT(trim(kode_inventaris),4) DESC LIMIT 1";
		//echo $sql2;die;
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
        $this->db->insert('inventory_penyerahan_barang_mat', $data);
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
	    $this->db->delete('inventory_penyerahan_barang_mat');
	    if ($this->db->_error_number() == 0) {
	    	return true;
	    } else {
	        return false;
	    }
    }

    public function noinventaris_db($id,$idmat,$idpermintaan_mat,$idinventory_penyerahan=''){
		$fil_idinventory_penyerahan="";
		if($idinventory_penyerahan<>""){
			$fil_idinventory_penyerahan=" AND idinventory_penyerahan='".$idinventory_penyerahan."'";
		}
	    $sql="SELECT pb.*,u.unit,ki.reff_nama as kelompok_inventaris
	    			,ir.nama as ruangan,ipb.kode_transaksi as kode_pembelian
						,pyb.kode_transaksi as kodepenyerahan,d.departemen as departementext,c.logo , c.nama as companytext,k.nama as kelompokbarangtext
	    		FROM inventory_penyerahan_barang_mat pb
				LEFT JOIN inventory_material im ON pb.idmaterial=im.replid
        		LEFT JOIN inventory_kelompok k ON k.replid=im.idkelompok
	    		LEFT JOIN inventory_reff ki ON pb.idkelompok_inventaris=ki.replid AND ki.grup='inventaris'
	    		LEFT JOIN inventory_unit u ON pb.idunit=u.replid
	    		LEFT JOIN inventory_ruang ir ON pb.idruang=ir.replid
				LEFT JOIN inventory_pembelian ipb ON pb.idinventory_pembelian=ipb.replid
				LEFT JOIN inventory_penyerahan_barang pyb ON pyb.replid=pb.idinventory_penyerahan
				LEFT JOIN hrm_company c ON pb.idcompany=c.replid
				LEFT JOIN hrm_departemen d ON pb.iddepartemen=d.replid
	    		WHERE pb.idpermintaanbarang='".$id."' AND pb.idmaterial='".$idmat."' AND idpermintaan_mat='".$idpermintaan_mat."' ".$fil_idinventory_penyerahan."
	    		ORDER BY pb.kode_inventaris";
        //echo $sql."<br/>";//die;
        $rowpdv=$this->dbx->data($sql);
		return $rowpdv;

    }

    public function ubahstatuspermintaan($id) {
    	$sql=("SELECT SUM(jumlah) as jml_minta FROM inventory_permintaan_barang_mat WHERE idpermintaan_barang='".$id."'");
    	$rowminta=$this->dbx->rows($sql);
    	$sql2=("SELECT SUM(jml_serah) as jml_serah FROM inventory_penyerahan_barang_mat WHERE idpermintaanbarang='".$id."'");
    	$rowserah=$this->dbx->rows($sql2);

    	if (($rowserah->jml_serah=="") or ($rowserah->jml_serah==0)){
					$status=2;
			}else if ($rowminta->jml_minta<>$rowserah->jml_serah){
	    	$status='OP';
    	}else{
	    	$status=4;
    	}

    	$data = array(
				"status"=> $status,
				"modified_date"=> $this->dbx->cts(),
				"modified_by"=> $this->input->post('idpegawai'));
		//echo var_dump($data);die;
		$this->db->where('replid',$id);
		$this->db->update('inventory_permintaan_barang', $data);
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

	public function kode_transaksi($company,$tanggalserah){
		$kode_transaksi="";

		$sql="SELECT CONCAT(company_code,'/UMM/PSB/',(SELECT DATE_FORMAT('".$tanggalserah."','%Y%m')),'/') as kode_transaksi
				FROM hrm_company WHERE replid='".$company."'";
		$query=$this->db->query($sql);
		$isi=$query->row();
		if ($query->num_rows() > 0) {
			$kode_transaksi=$isi->kode_transaksi;
		}

		$sql2="SELECT LPAD(RIGHT(RIGHT(trim(kode_transaksi),11),4)+1,4,'0') as kode_transaksi2 FROM inventory_penyerahan_barang WHERE idcompany='".$company."'
and LEFT(RIGHT(trim(kode_transaksi),11),6)=DATE_FORMAT('".$tanggalserah."','%Y%m') ORDER BY kode_transaksi2 DESC LIMIT 1";
		$query2=$this->db->query($sql2);
		$isi2=$query2->row();
		if ($query2->num_rows() > 0) {
			$kode_transaksi=$kode_transaksi.$isi2->kode_transaksi2;
		}elseif ($kode_transaksi<>""){
			$kode_transaksi=$kode_transaksi."0001";
		}
		return $kode_transaksi;

	}

	public function tambahheadpenyerahan_pdb($data) {
		//echo print_r(array_values($data));die;
		$this->db->trans_start();
			$this->db->insert('inventory_penyerahan_barang', $data);
			$insert_id = $this->db->insert_id();
			if ($this->db->affected_rows() > 0) {
						 $this->db->trans_complete();
						 return $insert_id;
			} else {
				$this->db->trans_complete();
					return false;
			}
	 }

	 public function ubahheadpenyerahan_pdb($data,$id) {
		 //echo var_dump($data);die;
 		$this->db->where('replid',$id);
 		$this->db->update('inventory_penyerahan_barang', $data);
 		if ($this->db->_error_number() == 0) {
 		  return true;
 		} else {
 		  return false;
 		}
	}

	public function hapusserahhead_db($id) {
		// Query to check whether username already exist or not
		$this->db->where('replid',$id);
		$this->db->delete('inventory_penyerahan_barang');
		if ($this->db->_error_number() == 0) {
			return true;
		} else {
				return false;
		}
	}
}
?>
