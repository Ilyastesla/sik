<?php

Class pengajuan_pinjaman_db extends CI_Model {
public function __construct() {
parent::__construct();
	$this->load->library('dbx');
}
    // Read data from database to show data in admin page
    public function data() {
      	$sql="SELECT kk.*,c.nama as company,p.nama as pemohon,d.departemen,s.status as statustext FROM hrm_pengajuan_pinjaman kk 
      			LEFT JOIN hrm_company c ON kk.idcompany=c.replid
      			LEFT JOIN pegawai p ON kk.pemohon=p.replid
      			LEFT JOIN hrm_group_pinjaman dp ON kk.idgroup=dp.replid
      			LEFT JOIN hrm_departemen d ON kk.iddepartemen=d.replid
      			LEFT JOIN hrm_status s ON kk.status=s.node
      			ORDER BY kk.tanggalpengajuan";
      	return $this->dbx->data($sql);
    }
        
     
    //TAMBAH
    //-------------------------------------------------------------------------------------------
    public function tambah_x($id='',$data) {
    	$data['id']=$id;
      	$sql="SELECT *,(SELECT nilai from hrm_setting where setting='KK') as limitkk
      			FROM hrm_pengajuan_pinjaman kk
      			WHERE kk.replid='".$id."'";
        $data['isi'] = $this->dbx->rows($sql);
        
        if ($data['isi']== NULL ) {
        	unset($data['isi']);
        	$sql="SELECT 
        			NULL as replid,
					NULL as kode_transaksi,
					NULL as idcompany,
					NULL as idgroup,
					NULL as keperluan,
					NULL as pemohon,
					NULL as iddepartemen,
					31 as idkredit,
					NULL as iddebit,
					NULL as penerima,
					CURRENT_DATE() as tanggalpengajuan,
					NULL as tanggalpenerima,
					NULL as jumlah,
					NULL as cicilan,
					NULL as tglcicilan,
					NULL as idjenis_jaminan,
					NULL as keterangan_jaminan,
					NULL as keterangan,
					NULL as alasan,
					1 as status,
					NULL as created_date,
					NULL as created_by,
					NULL as modified_date,
					NULL as modified_by,
					";
        	$data['isi']=$this->dbx->rows($sql);
        }
        
        $data['company_opt'] = $this->dbx->opt("select replid,CONCAT(company_code,' ',nama) as nama from hrm_company WHERE aktif=1 ORDER BY nama",'up');
        $data['group_pinjaman_opt'] = $this->dbx->opt("select replid,group_pinjaman as nama from hrm_group_pinjaman ORDER BY group_pinjaman",'up');
        $data['jenis_jaminan_opt'] = $this->dbx->opt("select replid,jenis_jaminan as nama from hrm_jenis_jaminan ORDER BY jenis_jaminan",'up');
        $data['pemohon_opt'] = $this->dbx->opt("select replid,nama from pegawai where aktif=1 ORDER BY nama",'up');
        $data['departemen_opt'] = $this->dbx->opt("select replid,departemen as nama from hrm_departemen WHERE aktif=1 ORDER BY departemen",'up');
        $data['jenis_pinjaman_opt'] = $this->dbx->opt("select replid,jenis_pinjaman as nama from hrm_jenis_pinjaman ORDER BY jenis_pinjaman",'up');
        //$data['kredit_opt'] = $this->dbx->opt("SELECT ra.replid,CONCAT(ra.kode,' ',ra.nama) as nama FROM rekakun ra where ra.kategori='HARTA' ORDER BY ra.nama",'up');
        //$data['debit_opt'] = $this->dbx->opt("SELECT ra.replid,CONCAT(ra.kode,' ',ra.nama) as nama FROM rekakun ra where ra.kategori='BIAYA' ORDER BY ra.nama",'up');

        return $data;
    }
    
    public function kode_transaksi($company,$tanggalpengajuan){
	    $kode_transaksi="";
	    
	    $sql="SELECT CONCAT(company_code,'/PP/',(SELECT DATE_FORMAT('".$tanggalpengajuan."','%Y%m')),'/') as kode_transaksi
	    		FROM hrm_company WHERE replid='".$company."'";
	    $query=$this->db->query($sql);
	    $isi=$query->row();
	    if ($query->num_rows() > 0) {
	    	$kode_transaksi=$isi->kode_transaksi;
	    }
	    
	    $sql2="SELECT LPAD(RIGHT(RIGHT(trim(kode_transaksi),11),4)+1,4,'0') as kode_transaksi2 FROM hrm_pengajuan_pinjaman WHERE idcompany='".$company."'
 and LEFT(RIGHT(trim(kode_transaksi),11),6)=DATE_FORMAT('".$tanggalpengajuan."','%Y%m')";  
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
        $this->db->insert('hrm_pengajuan_pinjaman', $data);
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
		$this->db->update('hrm_pengajuan_pinjaman', $data);
		if ($this->db->_error_number() == 0) {
		  return true;
		} else {
		  return false;
		}
	}
	public function hapus_db($id) {
	    // Query to check whether username already exist or not
	    $this->db->where('replid',$id);
	    $this->db->delete('hrm_pengajuan_pinjaman');
	    if ($this->db->_error_number() == 0) {
	    	return true;
	    } else {
	        return false;
	    }
    }
    
    public function view_db($id='',$data) {
    	$data['id']=$id;
      	$sql="SELECT kk.*,c.nama as company,CONCAT(p.nama,' (',p.nip,')') as pemohontext,s.status as statustext
      				,jj.jenis_jaminan as idjenis_jaminantext
      				,d.departemen
      				,dp.group_pinjaman as idgroup
      				,jx.jabatan as idjabatan
      			FROM hrm_pengajuan_pinjaman kk 
      			LEFT JOIN hrm_company c ON kk.idcompany=c.replid
      			LEFT JOIN pegawai p ON kk.pemohon=p.replid
      			LEFT JOIN hrm_departemen d ON kk.iddepartemen=d.replid
      			LEFT JOIN hrm_status s ON kk.status=s.node
      			LEFT JOIN hrm_group_pinjaman dp ON kk.idgroup=dp.replid
      			LEFT JOIN hrm_jabatan jx ON kk.idjabatan=jx.replid
      			LEFT JOIN hrm_jenis_jaminan jj ON kk.idjenis_jaminan=jj.replid
      			WHERE kk.replid='".$id."'
      			ORDER BY kk.tanggalpengajuan";
        $data['isi'] = $this->dbx->rows($sql);
        
        $sql2="SELECT * FROM hrm_pengajuan_pinjaman_attachment WHERE idpengajuan_pinjaman='".$id."'";
        $data['attachment'] = $this->dbx->data($sql2);
        
        
        //------------------------------------------------------------------------------------------------
        $sqlapprover="SELECT CONCAT(pk.replid,',',p.replid) as replid,CONCAT(p.nama,' (',j.jabatan,')') as nama
        				FROM pegawai p 
        				INNER JOIN hrm_pegawai_kontrak pk ON p.replid=pk.idpegawai
        				INNER JOIN hrm_jabatan j ON j.replid=pk.idjabatan
        				WHERE p.replid='".$data['isi']->pemohon."'
        				ORDER BY p.nama";
        //echo $sqlapprover;die;
        $data['approver_opt'] = $this->dbx->opt($sqlapprover,'up');
        return $data;
    }
    
    public function tambah_attachment($data) {
    	//echo print_r(array_values($data));die;
    	$this->db->trans_start();
        $this->db->insert('hrm_pengajuan_pinjaman_attachment', $data);
        $insert_id = $this->db->insert_id();
        if ($this->db->affected_rows() > 0) {
               $this->db->trans_complete();
               return $insert_id;
        } else {
        	$this->db->trans_complete();
            return false;
        }
     }
     public function hapus_attachment_db($id) {
	    // Query to check whether username already exist or not
	    $this->db->where('replid',$id);
	    $this->db->delete('hrm_pengajuan_pinjaman_attachment');
	    if ($this->db->_error_number() == 0) {
	    	return true;
	    } else {
	        return false;
	    }
    }
   	public function pegawai($id,$idjenis_pinjaman) {
   	   $sql="SELECT p.*,j.iddepartemen,gp.limit_pinjaman FROM pegawai p
   	   			INNER JOIN hrm_jabatan j ON p.idjabatan=j.replid
   	   			LEFT JOIN hrm_group_pinjaman gp ON gp.idjabatan=j.replid AND gp.idjenis_pinjaman='".$idjenis_pinjaman."'
   	   			WHERE p.replid='".$id."'";
	   $pegawai=$this->dbx->rows($sql);
	   return $pegawai;
	} 
	
	public function loa_history($data) {
    	//echo print_r(array_values($data));die;
    	$this->db->trans_start();
        $this->db->insert('hrm_loa_history', $data);
        $insert_id = $this->db->insert_id();
        if ($this->db->affected_rows() > 0) {
               $this->db->trans_complete();
               return $insert_id;
        } else {
        	$this->db->trans_complete();
            return false;
        }
     }
    
     
}
?>