<?php

Class inventory_peminjaman_db extends CI_Model {
public function __construct() {
	parent::__construct();
	$this->load->library('dbx');
}
    // Read data from database to show data in admin page
    public function data() {
      	$sql="SELECT kk.*,c.nama as company,p.nama as pemohon,d.departemen,s.status as statustext,0 as app
      			FROM inventory_peminjaman kk
      			LEFT JOIN hrm_company c ON kk.idcompany=c.replid
      			LEFT JOIN pegawai p ON kk.pemohon=p.replid
      			LEFT JOIN hrm_departemen d ON kk.iddepartemen=d.replid
      			LEFT JOIN hrm_status s ON kk.status=s.node
      			 WHERE kk.created_by='".$this->session->userdata('idpegawai')."'
      			ORDER BY kk.tanggalpengajuan";
      	return $this->dbx->data($sql);
    }


    //TAMBAH
    //-------------------------------------------------------------------------------------------
    public function tambah_x($id='',$data) {
    	$data['id']=$id;
      	$sql="SELECT *,(SELECT nilai from hrm_setting where setting='KK') as limitkk
      			FROM inventory_peminjaman kk
      			WHERE kk.replid='".$id."'";
        $data['isi'] = $this->dbx->rows($sql);

        if ($data['isi']== NULL ) {
        	unset($data['isi']);
        	$sql="SELECT
        			NULL as replid,
					'-' as kode_transaksi,
					(SELECT idcompany FROM pegawai
						WHERE replid='".$this->session->userdata('idpegawai')."') as idcompany,
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

        $data['company_opt'] = $this->dbx->opt("select replid,CONCAT(company_code,' ',nama) as nama from hrm_company WHERE aktif=1 ORDER BY nama",'up');
        //$data['pemohon_opt'] = $this->dbx->opt("select replid,nama from pegawai where aktif=1 ORDER BY nama");
        $data['departemen_opt'] = $this->dbx->opt("select replid,departemen as nama from hrm_departemen WHERE aktif=1 ORDER BY departemen",'up');
        return $data;
    }

    public function kode_transaksi($company,$tanggalpengajuan){
	    $kode_transaksi="";

	    $sql="SELECT CONCAT(company_code,'/UMM/PB/',(SELECT DATE_FORMAT('".$tanggalpengajuan."','%Y%m')),'/') as kode_transaksi
	    		FROM hrm_company WHERE replid='".$company."'";
	    $query=$this->db->query($sql);
	    $isi=$query->row();
	    if ($query->num_rows() > 0) {
	    	$kode_transaksi=$isi->kode_transaksi;
	    }


	    $sql2="SELECT LPAD(RIGHT(RIGHT(trim(kode_transaksi),11),4)+1,4,'0') as kode_transaksi2 FROM inventory_peminjaman WHERE idcompany='".$company."'
 and LEFT(RIGHT(trim(kode_transaksi),11),6)=DATE_FORMAT('".$tanggalpengajuan."','%Y%m') ORDER BY kode_transaksi2 DESC LIMIT 1";
	   $query2=$this->db->query($sql2);
	    $isi2=$query2->row();
	    if ($query2->num_rows() > 0) {
	    	$kode_transaksi=$kode_transaksi.$isi2->kode_transaksi2;
	    }elseif ($kode_transaksi<>""){
		    $kode_transaksi=$kode_transaksi."0001";
	    }
	    return $kode_transaksi;

    }

    public function tambah($data) {
    	//echo print_r(array_values($data));die;
    	$this->db->trans_start();
        $this->db->insert('inventory_peminjaman', $data);
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
		$this->db->update('inventory_peminjaman', $data);
		if ($this->db->_error_number() == 0) {
		  return true;
		} else {
		  return false;
		}
	}


    //MATERIAL
    //-------------------------------------------------------------------------------------------
    public function ubahmaterial_x($id='',$data) {
    	$data['id']=$id;
      	$sql="SELECT km.*,im.nama as materialtext
      			FROM inventory_peminjaman_mat km
      			LEFT JOIN inventory_material im ON km.idmaterial=im.replid
      			WHERE km.replid='".$id."'";
        $data['isi'] = $this->dbx->rows($sql);

        if ($data['isi']== NULL ) {
        	unset($data['isi']);
        	$sql="SELECT
        			NULL as idmaterial,
					NULL as jumlah,
					NULL as idunit,
					NULL as materialtext,
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
    	return $data;
    }

    public function tambahmaterial_db($data) {
    	//echo print_r(array_values($data));die;
    	$this->db->trans_start();
        $this->db->insert('inventory_peminjaman_mat', $data);
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
		$this->db->update('inventory_peminjaman_mat', $data);
		if ($this->db->_error_number() == 0) {
		  return true;
		} else {
		  return false;
		}
	}
	public function hapusmaterial_db($id) {
	    // Query to check whether username already exist or not
	    $this->db->where('replid',$id);
	    $this->db->delete('inventory_peminjaman_mat');
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
      			FROM inventory_peminjaman kk
      			LEFT JOIN hrm_company c ON kk.idcompany=c.replid
      			LEFT JOIN pegawai p ON kk.pemohon=p.replid
      			LEFT JOIN hrm_departemen d ON kk.iddepartemen=d.replid
      			LEFT JOIN hrm_status s ON kk.status=s.node
      			WHERE kk.replid='".$id."'
      			ORDER BY kk.tanggalpengajuan";
        $data['isi'] = $this->dbx->rows($sql);

        $sql="SELECT pm.*,CONCAT('[',im.kode,'] ',' ',im.nama) as idmaterial,u.unit as idunit,im.stock
        		FROM inventory_peminjaman_mat pm
        		LEFT JOIN inventory_material im ON pm.idmaterial=im.replid
        		LEFT JOIN inventory_unit u ON pm.idunit=u.replid
        		WHERE idinventory_peminjaman='".$id."'";

        $data['material'] = $this->dbx->data($sql);
        return $data;
    }

    public function hapusmaterial2_db($id) {
	    // Query to check whether username already exist or not
	    $this->db->where('idinventory_peminjaman',$id);
	    $this->db->delete('inventory_peminjaman_mat');
	    if ($this->db->_error_number() == 0) {
	    	return true;
	    } else {
	        return false;
	    }
    }
    public function hapus_db($id) {
	    // Query to check whether username already exist or not
	    $this->db->where('replid',$id);
	    $this->db->delete('inventory_peminjaman');
	    if ($this->db->_error_number() == 0) {
	    	return true;
	    } else {
	        return false;
	    }
    }

}
?>
