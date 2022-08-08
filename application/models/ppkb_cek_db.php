<?php

Class ppkb_cek_db extends CI_Model {
public function __construct() {
parent::__construct();
	$this->load->library('dbx');
}
    // Read data from database to show data in admin page
    public function data() {
    	//LEFT JOIN hrm_datapengeluaran dp ON kk.idpengeluaran=dp.replid
      	$sql="SELECT kk.*
      			,c.nama as company
      			,CONCAT(p.nama,'<br />(',p.nip,')') as pemohon,d.departemen
      			,s.status as statustext 
      			,CONCAT(pg.nama,'<br />(',pg.nip,')') as next_approver
      			FROM hrm_ppkb_cek kk 
      			LEFT JOIN hrm_company c ON kk.idcompany=c.replid
      			LEFT JOIN pegawai p ON kk.pemohon=p.replid
      			LEFT JOIN hrm_departemen d ON kk.iddepartemen=d.replid
      			LEFT JOIN hrm_status s ON kk.status=s.node
      			LEFT JOIN pegawai pg ON pg.replid=kk.next_approver
      			WHERE pemohon='".$this->session->userdata('idpegawai')."'
      			ORDER BY kk.tanggalpengajuan";
      	return $this->dbx->data($sql);
    }
        
     
    //TAMBAH HEADER   
    //-------------------------------------------------------------------------------------------
    public function tambah_x($id='',$data) {
    	$data['id']=$id;
      	$sql="SELECT *
      			FROM hrm_ppkb_cek kk
      			WHERE kk.replid='".$id."'";
        $data['isi'] = $this->dbx->rows($sql);
        
        if ($data['isi']== NULL ) {
        	unset($data['isi']);
        	$sql="SELECT 
        			NULL as replid,
					'-' as kode_transaksi,
					(SELECT idcompany FROM pegawai 
						WHERE replid='".$this->session->userdata('idpegawai')."') as idcompany,
					NULL as idpengeluaran,
					NULL as keperluan,
					'".$this->session->userdata('idpegawai')."' as pemohon,
					(SELECT j.iddepartemen from hrm_pegawai_kontrak p INNER JOIN hrm_jabatan j ON p.idjabatan=j.replid
WHERE p.idpegawai='".$this->session->userdata('idpegawai')."' ORDER BY p.awal_kontrak DESC LIMIT 1) as iddepartemen,
					31 as idkredit,
					NULL as iddebit,
					NULL as penerima,
					CURRENT_DATE() as tanggalpengajuan,
					NULL as tanggalpenerima,
					NULL as jumlah,
					NULL as keterangan,
					NULL as alasan,
					1 as status,
					NULL as created_date,
					NULL as created_by,
					NULL as modified_date,
					NULL as modified_by,
					(SELECT nilai from hrm_setting where setting='KK') as limitkk
					";
        	$data['isi']=$this->dbx->rows($sql);
        }
        
        $data['company_opt'] = $this->dbx->opt("select replid,CONCAT(company_code,' ',nama) as nama from hrm_company WHERE aktif=1 ORDER BY nama",'up');
        $data['pemohon_opt'] = $this->dbx->opt("select replid,nama from pegawai where aktif=1 ORDER BY nama",'up');
        $data['departemen_opt'] = $this->dbx->opt("select replid,departemen as nama from hrm_departemen WHERE aktif=1 ORDER BY departemen",'up');
        return $data;
    }

    public function kode_transaksi($company,$tanggalpengajuan){
	    $kode_transaksi="";
	    
	    $sql="SELECT CONCAT(company_code,'/PC/',(SELECT DATE_FORMAT('".$tanggalpengajuan."','%Y%m')),'/') as kode_transaksi
	    		FROM hrm_company WHERE replid='".$company."'";
	    $query=$this->db->query($sql);
	    $isi=$query->row();
	    if ($query->num_rows() > 0) {
	    	$kode_transaksi=$isi->kode_transaksi;
	    }
	    
	    $sql2="SELECT LPAD(RIGHT(RIGHT(trim(kode_transaksi),11),4)+1,4,'0') as kode_transaksi2 FROM hrm_ppkb_cek WHERE idcompany='".$company."'
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
        $this->db->insert('hrm_ppkb_cek', $data);
        $insert_id = $this->db->insert_id();
        if ($this->db->affected_rows() > 0) {
               $this->db->trans_complete();
               return $insert_id;
        } else {
        	$this->db->trans_complete();
            return false;
        }
     }
    
    //UBAH
  
  	public function ubah($data,$id) {
	  $this->db->where('replid',$id);
	  $this->db->update('hrm_ppkb_cek', $data);
	  if ($this->db->_error_number() == 0) {
		  return true;
	  } else {
		  return false;
      }
    }
    
    
    
    //FOOOTTTTTTT
    //-------------------------------------------------------------------------------------------
    /*
    public function cek_outstanding($id) {
      	$sql="select nilai,(select sum(nilai) from ppkb_cek_termin where ppkb_cek_id=a.replid) as termin from ppkb_cek a WHERE replid='".$id."'";
      	$sisa=$this->dbx->rows($sql);
      	if ($sisa->nilai == $sisa->termin){
	      	$this->db->query("update ppkb_cek set status=2 where replid='".$id."'");
      	}else {
	      	$this->db->query("update ppkb_cek set status=1 where replid='".$id."'");
      	}
    }
    */
    
    //KEPERLUAN 
    //-------------------------------------------------------------------------------------------   
    public function ubahkeperluan_x($id='',$data) {
    	$data['id']=$id;
      	$sql="SELECT *
      			FROM hrm_ppkb_cek_mat km
      			WHERE km.replid='".$id."'";
        $data['isi'] = $this->dbx->rows($sql);
        
        if ($data['isi']== NULL ) {
        	unset($data['isi']);
        	$sql="SELECT 
        			NULL as idmaterial,
					NULL as jumlah,
					NULL as idunit,
					NULL as nilai";
        	$data['isi']=$this->dbx->rows($sql);
        }
       
        $data['mat_opt'] = $this->dbx->opt("SELECT im.replid,CONCAT(im.nama,' [',im.kode,']') as nama FROM inventory_material im ORDER BY im.nama",'up');
        $data['unit_opt'] = $this->dbx->opt("SELECT im.replid,im.unit as nama FROM inventory_unit im ORDER BY im.unit",'up');
    	return $data;
    }
    
    public function tambahkeperluan_db($data) {
    	//echo print_r(array_values($data));die;
    	$this->db->trans_start();
        $this->db->insert('hrm_ppkb_cek_mat', $data);
        $insert_id = $this->db->insert_id();
        if ($this->db->affected_rows() > 0) {
               $this->db->trans_complete();
               return $insert_id;
        } else {
        	$this->db->trans_complete();
            return false;
        }
     }
	public function ubahkeperluan_db($data,$id) {
		//echo var_dump($data);die;
		$this->db->where('replid',$id);
		$this->db->update('hrm_ppkb_cek_mat', $data);
		if ($this->db->_error_number() == 0) {
		  return true;
		} else {
		  return false;
		}
	}
	public function hapuskeperluan_db($id) {
	    // Query to check whether username already exist or not
	    $this->db->where('replid',$id);
	    $this->db->delete('hrm_ppkb_cek_mat');
	    if ($this->db->_error_number() == 0) {
	    	return true;
	    } else {
	        return false;
	    }
    }
    
    //jasa 
    //-------------------------------------------------------------------------------------------   
    public function ubahjasa_x($id='',$data) {
    	$data['id']=$id;
      	$sql="SELECT *
      			FROM hrm_ppkb_cek_jasa km
      			WHERE km.replid='".$id."'";
        $data['isi'] = $this->dbx->rows($sql);
        
        if ($data['isi']== NULL ) {
        	unset($data['isi']);
        	$sql="SELECT 
        			NULL as idjasa,
        			NULL as tgl_periode1,
        			NULL as tgl_periode2,
					NULL as jumlah,
					NULL as idunit,
					NULL as nilai";
        	$data['isi']=$this->dbx->rows($sql);
        }
       
        $data['jasa_opt'] = $this->dbx->opt("SELECT im.replid,CONCAT('[',im.kode_jasa,'] ',' ',im.jasa) as nama FROM inventory_jasa im ORDER BY im.jasa",'up');
        $data['unit_opt'] = $this->dbx->opt("SELECT im.replid,im.unit as nama FROM inventory_unit im ORDER BY im.unit",'up');
    	return $data;
    }
    
    public function tambahjasa_db($data) {
    	//echo print_r(array_values($data));die;
    	$this->db->trans_start();
        $this->db->insert('hrm_ppkb_cek_jasa', $data);
        $insert_id = $this->db->insert_id();
        if ($this->db->affected_rows() > 0) {
               $this->db->trans_complete();
               return $insert_id;
        } else {
        	$this->db->trans_complete();
            return false;
        }
     }
	public function ubahjasa_db($data,$id) {
		//echo var_dump($data);die;
		$this->db->where('replid',$id);
		$this->db->update('hrm_ppkb_cek_jasa', $data);
		if ($this->db->_error_number() == 0) {
		  return true;
		} else {
		  return false;
		}
	}
	public function hapusjasa_db($id) {
	    // Query to check whether username already exist or not
	    $this->db->where('replid',$id);
	    $this->db->delete('hrm_ppkb_cek_jasa');
	    if ($this->db->_error_number() == 0) {
	    	return true;
	    } else {
	        return false;
	    }
    }

    
    //LAIN 
    //-------------------------------------------------------------------------------------------   
    public function ubahlain_x($id='',$data) {
    	$data['id']=$id;
      	$sql="SELECT *
      			FROM hrm_ppkb_cek_lain km
      			WHERE km.replid='".$id."'";
        $data['isi'] = $this->dbx->rows($sql);
        
        if ($data['isi']== NULL ) {
        	unset($data['isi']);
        	$sql="SELECT 
        			NULL as keterangan,
					NULL as jumlah,
					NULL as idunit,
					NULL as nilai";
        	$data['isi']=$this->dbx->rows($sql);
        }
       
        $data['unit_opt'] = $this->dbx->opt("SELECT im.replid,im.unit as nama FROM inventory_unit im ORDER BY im.unit",'up');
    	return $data;
    }
    
    public function tambahlain_db($data) {
    	//echo print_r(array_values($data));die;
    	$this->db->trans_start();
        $this->db->insert('hrm_ppkb_cek_lain', $data);
        $insert_id = $this->db->insert_id();
        if ($this->db->affected_rows() > 0) {
               $this->db->trans_complete();
               return $insert_id;
        } else {
        	$this->db->trans_complete();
            return false;
        }
     }
	public function ubahlain_db($data,$id) {
		//echo var_dump($data);die;
		$this->db->where('replid',$id);
		$this->db->update('hrm_ppkb_cek_lain', $data);
		if ($this->db->_error_number() == 0) {
		  return true;
		} else {
		  return false;
		}
	}
	public function hapuslain_db($id) {
	    // Query to check whether username already exist or not
	    $this->db->where('replid',$id);
	    $this->db->delete('hrm_ppkb_cek_lain');
	    if ($this->db->_error_number() == 0) {
	    	return true;
	    } else {
	        return false;
	    }
    }
    
    //TERMIN 
    //-------------------------------------------------------------------------------------------   
    public function ubahtermin_x($id='',$data) {
    	$data['id']=$id;
      	$sql="SELECT *
      			FROM hrm_ppkb_cek_termin km
      			WHERE km.replid='".$id."'";
        $data['isi'] = $this->dbx->rows($sql);
        
        if ($data['isi']== NULL ) {
        	unset($data['isi']);
        	$sql="SELECT 
        			DATE_ADD(CURRENT_DATE(),INTERVAL 7 DAY) as due_date,
        			NULL as nilai";
        	$data['isi']=$this->dbx->rows($sql);
        }
       
        $data['mat_opt'] = $this->dbx->opt("SELECT im.replid,CONCAT(im.kode,' ',im.nama) as nama FROM inventory_material im ORDER BY im.nama",'up');
    	return $data;
    }
    
    public function tambahtermin_db($data) {
    	//echo print_r(array_values($data));die;
    	$this->db->trans_start();
        $this->db->insert('hrm_ppkb_cek_termin', $data);
        $insert_id = $this->db->insert_id();
        if ($this->db->affected_rows() > 0) {
               $this->db->trans_complete();
               return $insert_id;
        } else {
        	$this->db->trans_complete();
            return false;
        }
     }
	public function ubahtermin_db($data,$id) {
		//echo var_dump($data);die;
		$this->db->where('replid',$id);
		$this->db->update('hrm_ppkb_cek_termin', $data);
		if ($this->db->_error_number() == 0) {
		  return true;
		} else {
		  return false;
		}
	}
	public function hapustermin_db($id) {
	    // Query to check whether username already exist or not
	    $this->db->where('replid',$id);
	    $this->db->delete('hrm_ppkb_cek_termin');
	    if ($this->db->_error_number() == 0) {
	    	return true;
	    } else {
	        return false;
	    }
    }
    
    //HAPUS
    //-------------------------------------------------------------------------------------------
    public function hapus($id) {
        // Query to check whether username already exist or not
        $this->db->where('replid',$id);
        $this->db->delete('hrm_ppkb_cek');
        
        $this->db->where('idppkb_cek',$id);
        $this->db->delete('hrm_ppkb_cek_mat');
        
        $this->db->where('idppkb_cek',$id);
        $this->db->delete('hrm_ppkb_cek_jasa');
        
        $this->db->where('idppkb_cek',$id);
        $this->db->delete('hrm_ppkb_cek_lain');
        
        $this->db->where('idppkb_cek',$id);
        $this->db->delete('hrm_ppkb_cek_termin');
        
        if ($this->db->_error_number() == 0) {
	        return true;
        } else {
            return false;
        }
    }
    
    public function view_db($id='',$data) {
    	$data['id']=$id;
    	//,IF(pelapor<>'',CONCAT(px.nama,' (',px.nip,')'),p.nama)  as pelapor
      	// ,IF(tanggalpelapor<>'0000-00-00 00:00:00',tanggalpelapor,CURRENT_DATE())  as tanggalpelapor 
      	//      			LEFT JOIN pegawai px ON kk.pelapor=px.replid
      	//, dp.nama as idpengeluaran   			
      	//LEFT JOIN hrm_datapengeluaran dp ON kk.idpengeluaran=dp.replid
      	$sql="SELECT kk.*,c.nama as company
      			,CONCAT(p.nama,' (',p.nip,')') as pemohontext
      			,d.departemen,s.status as statustext
      			FROM hrm_ppkb_cek kk 
      			LEFT JOIN hrm_company c ON kk.idcompany=c.replid
      			LEFT JOIN pegawai p ON kk.pemohon=p.replid
      			LEFT JOIN hrm_departemen d ON kk.iddepartemen=d.replid
      			LEFT JOIN hrm_status s ON kk.status=s.node
      			WHERE kk.replid='".$id."'
      			ORDER BY kk.tanggalpengajuan";
      	
        $data['isi'] = $this->dbx->rows($sql);
      
        //------------------------------------------------------------------------------------------------        
        $sql="SELECT pm.*,u.unit as idunit 
        			,IF(pm.keterangan_realisasi<>'',pm.keterangan_realisasi,pm.keterangan)  as keterangan_realisasi
        			,u2.unit as idunit_realisasi
        			,CONCAT(rk.kode,' ',rk.nama) as idkredit 
      				,CONCAT(rd.kode,' ',rd.nama) as iddebit 
      				,CONCAT(rk2.kode,' ',rk2.nama) as idadjustment 
        		FROM hrm_ppkb_cek_lain pm
        		LEFT JOIN inventory_unit u ON pm.idunit=u.replid
        		LEFT JOIN inventory_unit u2 ON pm.idunit_realisasi=u2.replid
        		LEFT JOIN rekakun rk ON rk.replid=pm.idkredit AND rk.kategori='HARTA'
        		LEFT JOIN rekakun rd ON rd.replid=pm.iddebit AND rd.kategori IN ('BIAYA' ,'INVENTARIS')
        		LEFT JOIN rekakun rk2 ON rk2.replid=pm.idadjustment AND rk.kategori='HARTA'
        		WHERE idppkb_cek='".$id."'";
        $data['lain'] = $this->dbx->data($sql);
        
        //------------------------------------------------------------------------------------------------
        
        $sql="SELECT * FROM hrm_ppkb_cek_termin WHERE idppkb_cek='".$id."' ORDER BY due_date";
        $data['termin'] = $this->dbx->data($sql);
        //------------------------------------------------------------------------------------------------
                
        $sql="SELECT u.*,p.nama as penerima FROM hrm_ppkb_cek_uudp u
        		LEFT JOIN pegawai p ON p.replid=u.penerima
        		WHERE u.idppkb_cek='".$id."' ORDER BY u.tanggalpenerima";
        $data['uudp'] = $this->dbx->data($sql);
        
        //APPROVER
        //------------------------------------------------------------------------------------------------
        /*
        $sqlapprover="SELECT p.replid,p.nama 
        				FROM pegawai p 
        				INNER JOIN hrm_jabatan j ON p.idjabatan=j.replid
        				WHERE p.aktif=1 
        					AND p.idcompany='".$data['isi']->idcompany."' 
        					AND j.iddepartemen IN ('".$data['isi']->iddepartemen."')
        					AND p.idjabatan IN (SELECT j.replid FROM hrm_loa l
        										INNER JOIN hrm_jabatan j ON l.idjabatan_grup=j.idjabatan_grup
        										WHERE idmodul='ppkb_cek' AND l.node='".$data['isi']->status."')
        				ORDER BY p.nama";
        */
        $sqlapprover="SELECT CONCAT(pk.replid,',',p.replid) as replid,CONCAT(p.nama,' (',j.jabatan,')') as nama
        				FROM pegawai p 
        				INNER JOIN hrm_pegawai_kontrak pk ON p.replid=pk.idpegawai
        				INNER JOIN hrm_jabatan j ON j.replid=pk.idjabatan
        				WHERE p.replid='".$data['isi']->pemohon."'
        				ORDER BY p.nama";

        $data['approver_opt'] = $this->dbx->opt($sqlapprover);
        $data['pemohon_opt'] = $this->dbx->opt("select replid,nama from pegawai where aktif=1 ORDER BY nama",'up');
        
        //attachment
        $sql2="SELECT * FROM hrm_ppkb_cek_attachment WHERE idppkb_cek='".$id."'";
        $data['attachment'] = $this->dbx->data($sql2);
        return $data;
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
     
     public function tambah_attachment($data) {
    	//echo print_r(array_values($data));die;
    	$this->db->trans_start();
        $this->db->insert('hrm_ppkb_cek_attachment', $data);
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
	    $this->db->delete('hrm_ppkb_cek_attachment');
	    if ($this->db->_error_number() == 0) {
	    	return true;
	    } else {
	        return false;
	    }
    }

}
	
?>