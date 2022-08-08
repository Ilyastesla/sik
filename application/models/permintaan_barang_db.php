<?php

Class permintaan_barang_db extends CI_Model {
public function __construct() {
	parent::__construct();
	$this->load->library('dbx');
}
    // Read data from database to show data in admin page
    public function data() {
		$cari="";
		$cari=$cari." AND kk.idcompany='".$this->input->post('idcompany')."' ";
		
		if ($this->input->post('idstatus')<>""){
			$cari=$cari." AND kk.status='".$this->input->post('idstatus')."' ";
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

      	$sql="SELECT kk.*,c.nama as company,p.nama as pemohon,d.departemen,s.status as statustext,0 as app
									,kr.prioritas as prioritastext,kr.color
									,DATE_ADD(kk.tanggalpengajuan,INTERVAL kr.periode DAY) as dateline
									,(DATE_ADD(kk.tanggalpengajuan,INTERVAL kr.periode DAY)<=CURRENT_DATE()) as urgent,kr.periode
      			FROM inventory_permintaan_barang kk
      			LEFT JOIN hrm_company c ON kk.idcompany=c.replid
      			LEFT JOIN pegawai p ON kk.pemohon=p.replid
      			LEFT JOIN hrm_departemen d ON kk.iddepartemen=d.replid
      			LEFT JOIN hrm_status s ON kk.status=s.node
						LEFT JOIN reff_prioritas kr ON kr.replid=kk.idprioritas
      			 WHERE  kk.idcompany=c.replid   ".$cari."
      			ORDER BY kk.tanggalpengajuan DESC";
				//AND kk.pemohon='".$this->session->userdata('idpegawai')."'
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
      	$sql="SELECT *,(SELECT nilai from hrm_setting where setting='KK') as limitkk
      			FROM inventory_permintaan_barang kk
      			WHERE kk.replid='".$id."'";
        $data['isi'] = $this->dbx->rows($sql);

        if ($data['isi']== NULL ) {
        	unset($data['isi']);
			$sql="SELECT ".$this->dbx->tablecolumn('inventory_permintaan_barang').",(SELECT idcompany FROM pegawai
						WHERE replid='".$this->input->post('idpegawai')."') as idcompany, CURRENT_DATE() as tanggalpengajuan,1 as status";
        	$data['isi']=$this->dbx->rows($sql);
        }

        $companyrow=$this->session->userdata('idcompany');
		$sqlcompany="SELECT replid,nama as nama
								FROM hrm_company
								WHERE replid IN (".$companyrow.") AND aktif=1
								ORDER BY nama";
		$data['company_opt'] = $this->dbx->opt($sqlcompany,'up');
		$data['idprioritas_opt'] = $this->dbx->opt("select replid,prioritas as nama from reff_prioritas WHERE aktif=1 ORDER BY no_urut",'up');
        $data['pemohon_opt'] = $this->dbx->opt("select replid,CONCAT(nama,' [',nip,']') as nama from pegawai where aktif=1 ORDER BY nama","up");
        $data['departemen_opt'] = $this->dbx->opt("select replid,departemen as nama from hrm_departemen WHERE aktif=1 AND idcompany='".$data['isi']->idcompany."' ORDER BY departemen",'up');
        return $data;
    }

    public function kode_transaksi($nourut,$company,$tanggalpengajuan){
	    $kode_transaksi="";

	    //$sql="SELECT CONCAT(company_code,'/UMM/PB/',(SELECT DATE_FORMAT('".$tanggalpengajuan."','%Y%m')),'/') as kode_transaksi
	    //		FROM hrm_company WHERE replid='".$company."'";

			// XXX/PTKPP-upb/MM/YYYY
			$sql="SELECT CONCAT('/',company_code,'-UPB/') as company_code
								,DATE_FORMAT('".$tanggalpengajuan."','%Y') as yearx
								,DATE_FORMAT('".$tanggalpengajuan."','%m') as monthx
	    		FROM hrm_company WHERE replid='".$company."'";
			//echo $sql;die;
	    $query=$this->db->query($sql);
	    $isi=$query->row();
	    if ($query->num_rows() > 0) {
	    	$kode_transaksi=$isi->company_code.$this->p_c->romawi($isi->monthx).'/'.$isi->yearx;
	    }

		if($nourut<>""){
			$kode_transaksi=$nourut.$kode_transaksi;

			$sqlcari="SELECT 1 as isi FROM inventory_permintaan_barang
					WHERE idcompany='".$company."' AND tanggalpengajuan='".$tanggalpengajuan."' AND kode_transaksi='".$kode_transaksi."'";
			$querycari=$this->dbx->singlerow($sqlcari);
			if ($querycari<>NULL){
				$kode_transaksi=NULL;
			}
		}else{
			//$sql2="SELECT LPAD(RIGHT(RIGHT(trim(kode_transaksi),11),4)+1,4,'0') as kode_transaksi2 FROM inventory_permintaan_barang WHERE idcompany='".$company."'
 			//and LEFT(RIGHT(trim(kode_transaksi),11),6)=DATE_FORMAT('".$tanggalpengajuan."','%Y%m') ORDER BY kode_transaksi2 DESC LIMIT 1";
			$sql2="SELECT LPAD(LEFT(TRIM(kode_transaksi),3)+1,3,'0') as kode_transaksi2 FROM inventory_permintaan_barang
			 		WHERE idcompany='".$company."' AND tanggalpengajuan='".$tanggalpengajuan."' ORDER BY kode_transaksi2 LIMIT 1";
			$query2=$this->db->query($sql2);
			$isi2=$query2->row();
			if ($query2->num_rows() > 0) {
				$kode_transaksi=$isi2->kode_transaksi2.$kode_transaksi;
			}elseif ($kode_transaksi<>""){
				$kode_transaksi="001".$kode_transaksi;
			}

		}
	    return $kode_transaksi;

    }

    public function tambah($data) {
    	//echo print_r(array_values($data));die;
    	$this->db->trans_start();
        $this->db->insert('inventory_permintaan_barang', $data);
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
		$this->db->update('inventory_permintaan_barang', $data);
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
      			FROM inventory_permintaan_barang_mat km
      			LEFT JOIN inventory_material im ON km.idmaterial=im.replid
      			WHERE km.replid='".$id."'";

        $data['isi'] = $this->dbx->rows($sql);
		if ($data['isi']== NULL ) {
        	unset($data['isi']);
					$sql="SELECT ".$this->dbx->tablecolumn('inventory_permintaan_barang_mat').",'' as materialtext";
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
		$data['idperuntukan_opt'] = $this->dbx->opt("select replid,reff_nama as nama from inventory_reff WHERE aktif=1 AND grup='permintaanbarang' ORDER BY nama",'up');

		return $data;
    }

    public function tambahmaterial_db($data) {
    	//echo print_r(array_values($data));die;
    	$this->db->trans_start();
        $this->db->insert('inventory_permintaan_barang_mat', $data);
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
		$this->db->update('inventory_permintaan_barang_mat', $data);
		if ($this->db->_error_number() == 0) {
		  return true;
		} else {
		  return false;
		}
	}
	public function hapusmaterial_db($id) {
	    // Query to check whether username already exist or not
	    $this->db->where('replid',$id);
	    $this->db->delete('inventory_permintaan_barang_mat');
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
      	$sql="SELECT kk.*,c.nama as company,CONCAT(p.nama,' (',p.nip,')') as pemohontext,d.departemen
      				,s.status as statustext
      				,c.phone,c.fax,c.website,c.email,c.street,c.zip
							,prioritas as prioritastext
							,DATE_ADD(kk.tanggalpengajuan,INTERVAL kr.periode DAY) as dateline
							,(DATE_ADD(kk.tanggalpengajuan,INTERVAL kr.periode DAY)<=CURRENT_DATE()) as urgent
							,CURRENT_DATE() as tglprint
      			FROM inventory_permintaan_barang kk
      			LEFT JOIN hrm_company c ON kk.idcompany=c.replid
      			LEFT JOIN pegawai p ON kk.pemohon=p.replid
      			LEFT JOIN hrm_departemen d ON kk.iddepartemen=d.replid
      			LEFT JOIN hrm_status s ON kk.status=s.node
						LEFT JOIN reff_prioritas kr ON kr.replid=kk.idprioritas
      			WHERE kk.replid='".$id."'
      			ORDER BY kk.tanggalpengajuan";
        $data['isi'] = $this->dbx->rows($sql);

        $sql="SELECT pm.*,CONCAT('[',im.kode,'] ',' ',im.nama) as materialtext,pm.idmaterial,u.unit as idunit,im.stock,v.nama as vendor
									,(SELECT SUM(jml_serah) FROM inventory_penyerahan_barang_mat WHERE pm.idpermintaan_barang=idpermintaanbarang AND idmaterial=pm.idmaterial AND idpermintaan_mat=pm.replid) as total_serah
									,rf.reff_nama as peruntukantext
        		FROM inventory_permintaan_barang_mat pm
        		LEFT JOIN inventory_material im ON pm.idmaterial=im.replid
        		LEFT JOIN inventory_unit u ON pm.idunit=u.replid
						LEFT JOIN inventory_vendor v ON pm.idvendor=v.replid
						LEFT JOIN inventory_reff rf ON pm.idperuntukan=rf.replid
        		WHERE idpermintaan_barang='".$id."'";
				//echo $sql;die;
        $data['material'] = $this->dbx->data($sql);
        return $data;
    }

    public function hapusmaterial2_db($id) {
	    // Query to check whether username already exist or not
	    $this->db->where('idpermintaan_barang',$id);
	    $this->db->delete('inventory_permintaan_barang_mat');
	    if ($this->db->_error_number() == 0) {
	    	return true;
	    } else {
	        return false;
	    }
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

}
?>
