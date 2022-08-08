<?php

Class kaskecil_db extends CI_Model {
public function __construct() {
parent::__construct();
	$this->load->library('dbx');
}
    // Read data from database to show data in admin page
    public function data() {
      	$sql="SELECT kk.*,c.nama as company,p.nama as pemohon,d.departemen,s.status as statustext,0 as app
      			,pk.kode_transaksi as noppkb
      			FROM hrm_kaskecil kk
      			LEFT JOIN hrm_company c ON kk.idcompany=c.replid
      			LEFT JOIN pegawai p ON kk.pemohon=p.replid
      			LEFT JOIN hrm_datapengeluaran dp ON kk.idpengeluaran=dp.replid
      			LEFT JOIN hrm_departemen d ON kk.iddepartemen=d.replid
      			LEFT JOIN hrm_status s ON kk.status=s.node
      			LEFT JOIN hrm_ppkb pk ON pk.replid=kk.idppkb
      			WHERE kk.status<>5
      			ORDER BY kk.tanggalpengajuan";
      	return $this->dbx->data($sql);
    }


    //TAMBAH
    //-------------------------------------------------------------------------------------------
    public function tambah_x($id='',$data) {
    	$data['id']=$id;
      	$sql="SELECT *,(SELECT nilai from hrm_setting where setting='KK') as limitkk
      			FROM hrm_kaskecil kk
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
					NULL as pemohon,
					NULL as iddepartemen,
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
					NULL as idppkb,
					(SELECT nilai from hrm_setting where setting='KK') as limitkk
					";
        	$data['isi']=$this->dbx->rows($sql);
        }

        $data['company_opt'] = $this->dbx->opt("select replid,CONCAT(company_code,' ',nama) as nama from hrm_company WHERE aktif=1 ORDER BY nama",'up');
        $data['pemohon_opt'] = $this->dbx->opt("select replid,nama from pegawai where aktif=1 ORDER BY nama",'up');
        $data['departemen_opt'] = $this->dbx->opt("select replid,departemen as nama from hrm_departemen WHERE aktif=1 ORDER BY departemen",'up');
        $data['ppkb_opt'] = $this->dbx->opt("SELECT pk.replid,pk.kode_transaksi as nama FROM hrm_ppkb_lain r
        									INNER JOIN hrm_ppkb pk ON r.idppkb=pk.replid
        									WHERE pk.closed<>1 AND pk.status IN (11,12) AND pk.idadjustment=31 ORDER BY kode_transaksi",'up');
        return $data;
    }

    public function kode_transaksi($company,$tanggalpengajuan){
	    $kode_transaksi="";

	    $sql="SELECT CONCAT(company_code,'/KK/',(SELECT DATE_FORMAT('".$tanggalpengajuan."','%Y%m')),'/') as kode_transaksi
	    		FROM hrm_company WHERE replid='".$company."'";
	    $query=$this->db->query($sql);
	    $isi=$query->row();
	    if ($query->num_rows() > 0) {
	    	$kode_transaksi=$isi->kode_transaksi;
	    }


	    $sql2="SELECT LPAD(RIGHT(RIGHT(trim(kode_transaksi),11),4)+1,4,'0') as kode_transaksi2 FROM hrm_kaskecil WHERE idcompany='".$company."'
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
        $this->db->insert('hrm_kaskecil', $data);
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
		$this->db->update('hrm_kaskecil', $data);
		if ($this->db->_error_number() == 0) {
		  return true;
		} else {
		  return false;
		}
	}
	public function hapus_db($id) {
	    // Query to check whether username already exist or not
	    $this->db->where('replid',$id);
	    $this->db->delete('hrm_kaskecil');
	    if ($this->db->_error_number() == 0) {
	    	return true;
	    } else {
	        return false;
	    }
    }

    public function ubahmaterial_x($idx='',$data) {
    		$id=$data['id'];
      	$sql="SELECT *
      			FROM hrm_kaskecil_mat km
      			WHERE km.replid='".$idx."'";
        $data['isi'] = $this->dbx->rows($sql);

        if ($data['isi']== NULL ) {
        	unset($data['isi']);
        	$sql="SELECT
        			NULL as replid,
					NULL as idkaskecil,
					NULL as idpengeluaran,
					NULL as keperluan,
					31 as idkredit,
					NULL as iddebit,
					NULL as jumlah";
        	$data['isi']=$this->dbx->rows($sql);
        }
        $data['jt_opt'] = $this->dbx->opt("select replid,nama from hrm_datapengeluaran ORDER BY nama",'up');
        $data['kredit_opt'] = $this->dbx->opt("SELECT ra.replid,CONCAT(ra.nama,' [',ra.kode,']') as nama FROM rekakun ra where replid IN (select idadjustment from hrm_ppkb where replid IN (select idppkb from hrm_kaskecil where replid='".$id."')) ORDER BY ra.nama",'up');
        $data['debit_opt'] = $this->dbx->opt("SELECT ra.replid,CONCAT(ra.nama,' [',ra.kode,']') as nama FROM rekakun ra where ra.kategori='BIAYA' ORDER BY ra.nama",'up');
    	return $data;
    }

    public function tambahmaterial_db($data) {
    	//echo print_r(array_values($data));die;
    	$this->db->trans_start();
        $this->db->insert('hrm_kaskecil_mat', $data);
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
		$this->db->update('hrm_kaskecil_mat', $data);
		if ($this->db->_error_number() == 0) {
		  return true;
		} else {
		  return false;
		}
	}
	public function hapusmaterial_db($id) {
	    // Query to check whether username already exist or not
	    $this->db->where('replid',$id);
	    $this->db->delete('hrm_kaskecil_mat');
	    if ($this->db->_error_number() == 0) {
	    	return true;
	    } else {
	        return false;
	    }
    }
    public function hapusmaterial2_db($id) {
	    // Query to check whether username already exist or not
	    $this->db->where('idkaskecil',$id);
	    $this->db->delete('hrm_kaskecil_mat');
	    if ($this->db->_error_number() == 0) {
	    	return true;
	    } else {
	        return false;
	    }
    }


    public function view_db($id='',$data) {
    	$data['id']=$id;
    	//,IF(penerima<>'',CONCAT(px.nama,' (',px.nip,')'),p.nama)  as penerimatext
      	$sql="SELECT kk.*,c.nama as company,CONCAT(p.nama,' (',p.nip,')') as pemohontext,d.departemen,s.status as statustext, dp.nama as idpengeluaran
      				,CONCAT(rk.kode,' ',rk.nama) as idkredit
      				,CONCAT(rd.kode,' ',rd.nama) as iddebit
      				,CONCAT(px.nama,' (',px.nip,')') as penerimatext
      				,CONCAT(px2.nama,' (',px2.nip,')') as approvebytext
      				,CONCAT(px3.nama,' (',px3.nip,')') as petugastext
      				,IF(kk.penerima<>'',kk.penerima,kk.pemohon)  as penerima
      				,IF(kk.tanggalpenerima<>'0000-00-00 00:00:00',kk.tanggalpenerima,CURRENT_DATE())  as tanggalpenerima2
      				,(SELECT nilai from hrm_setting where setting='KK') as limitkk
      				,IF(kk.tanggalrealisasi<>'0000-00-00 00:00:00',kk.tanggalrealisasi,CURRENT_DATE())  as tanggalrealisasi2
      				,c.phone,c.fax,c.website,c.email,c.street,c.zip
      				,pk.kode_transaksi as no_ppkb,pk.idadjustment
      			FROM hrm_kaskecil kk
      			LEFT JOIN hrm_company c ON kk.idcompany=c.replid
      			LEFT JOIN pegawai p ON kk.pemohon=p.replid
      			LEFT JOIN pegawai px ON kk.penerima=px.replid
      			LEFT JOIN pegawai px2 ON kk.approve_by=px2.replid
      			LEFT JOIN pegawai px3 ON kk.modified_by=px3.nip
      			LEFT JOIN hrm_datapengeluaran dp ON kk.idpengeluaran=dp.replid
      			LEFT JOIN hrm_departemen d ON kk.iddepartemen=d.replid
      			LEFT JOIN hrm_status s ON kk.status=s.node
      			LEFT JOIN rekakun rk ON rk.replid=kk.idkredit AND rk.kategori='HARTA'
      			LEFT JOIN rekakun rd ON rd.replid=kk.iddebit AND rd.kategori='BIAYA'
      			LEFT JOIN hrm_ppkb pk ON pk.replid=kk.idppkb
      			WHERE kk.replid='".$id."'
      			ORDER BY kk.tanggalpengajuan";
        $data['isi'] = $this->dbx->rows($sql);

        $sql2="	SELECT km.*
        			,dp.nama as idpengeluaran
        			,CONCAT(rk.kode,' ',rk.nama) as idkredit
      				,CONCAT(rd.kode,' ',rd.nama) as iddebit
      			FROM hrm_kaskecil_mat km
      			LEFT JOIN hrm_datapengeluaran dp ON km.idpengeluaran=dp.replid
      			LEFT JOIN rekakun rk ON rk.replid=km.idkredit AND rk.kategori='HARTA'
      			LEFT JOIN rekakun rd ON rd.replid=km.iddebit AND rd.kategori='BIAYA'
      			WHERE km.idkaskecil='".$id."'
      			";
        $data['material']=$this->dbx->data($sql2);


        $sql3="	SELECT km.*
        			,dp.nama as idpengeluaran
        			,CONCAT(rk.kode,' ',rk.nama) as idkredit
      				,CONCAT(rd.kode,' ',rd.nama) as iddebit
      			FROM hrm_kaskecil_realisasi km
      			LEFT JOIN hrm_datapengeluaran dp ON km.idpengeluaran=dp.replid
      			LEFT JOIN rekakun rk ON rk.replid=km.idkredit AND rk.kategori='HARTA'
      			LEFT JOIN rekakun rd ON rd.replid=km.iddebit AND rd.kategori='BIAYA'
      			WHERE km.idkaskecil='".$id."'
      			";
        $data['realisasi']=$this->dbx->data($sql3);

        $sql4="SELECT SUM(jumlah) as jml FROM hrm_kaskecil_mat WHERE idkaskecil='".$id."'";
      	$query=$this->db->query($sql4);
        $row = $query->row();
        $data['tot_pengajuan']=$row->jml;

        // having rk.nilai<=jml
        $sqlakun="select SUM(jumlah) as jml,idkredit,rk.nilai,CONCAT(rk.kode,' ',rk.nama) as idkredit from hrm_kaskecil_mat kkm
					INNER JOIN rekakun rk ON kkm.idkredit=rk.replid
					where idkaskecil='".$id."' group by idkredit";
        $data['nilaiakun']=$this->dbx->data($sqlakun);

				$sqlppkbnilai="SELECT SUM(nilai) as totnilai,p.kode_transaksi
												,(select SUM(rk.jumlah)
													FROM hrm_kaskecil_realisasi rk
													INNER JOIN hrm_kaskecil k ON rk.idkaskecil=k.replid
													WHERE k.idppkb=u.idppkb) as jmlpakai
										 FROM hrm_ppkb_uudp u
										INNER JOIN hrm_ppkb p ON u.idppkb=p.replid
										where p.replid='".$data['isi']->idppkb."'";
				$data['nilaippkb']=$this->dbx->data($sqlppkbnilai);

        $data['pemohon_opt'] = $this->dbx->opt("select replid,nama from pegawai where aktif=1 ORDER BY nama",'up');
				$sqlapprover="SELECT p.replid,p.nama from pegawai p
 													INNER JOIN hrm_pegawai_jabatan pj ON p.replid=pj.idpegawai
        											INNER JOIN hrm_jabatan j ON pj.idjabatan=j.replid
        											WHERE p.aktif=1 AND j.idjabatan_grup='6' AND j.iddepartemen='".$data['isi']->iddepartemen."' ORDER BY p.nama";
				//echo $sqlapprover;die;
        $data['approver_opt'] = $this->dbx->opt($sqlapprover,'up');
        return $data;
    }

    public function tambahrealisasi($id) {
    	$sql="SELECT *
      			FROM hrm_kaskecil_realisasi km
      			WHERE km.idkaskecil='".$id."'";
        $realisasidb = $this->dbx->rows($sql);
        if ($realisasidb== NULL ) {
        	$sql2="INSERT INTO hrm_kaskecil_realisasi (idkaskecil,idpengeluaran,keperluan,idkredit,iddebit,jumlah,idmat)
		        	SELECT idkaskecil,idpengeluaran,keperluan,idkredit,iddebit,jumlah,replid
		      		FROM hrm_kaskecil_mat km
		      		WHERE km.idkaskecil='".$id."'";
		    $this->db->query($sql2);
        }
    	return true;
    }
 	public function ubahrealisasi($id='',$data) {
    	$data['id']=$id;
      	$sql="SELECT *
      			FROM hrm_kaskecil_realisasi km
      			WHERE km.replid='".$id."'";
        $data['isi'] = $this->dbx->rows($sql);
        if ($data['isi']== NULL ) {
        	unset($data['isi']);
        	$sql="SELECT
        			NULL as replid,
					NULL as idkaskecil,
					NULL as idpengeluaran,
					NULL as keperluan,
					31 as idkredit,
					NULL as iddebit,
					NULL as jumlah";
        	$data['isi']=$this->dbx->rows($sql);
        }
        $data['jt_opt'] = $this->dbx->opt("select replid,nama from hrm_datapengeluaran ORDER BY nama",'up');
        $data['kredit_opt'] = $this->dbx->opt("SELECT ra.replid,CONCAT(ra.nama,' [',ra.kode,']') as nama FROM rekakun ra where ra.kategori='HARTA' ORDER BY ra.nama",'up');
        $data['debit_opt'] = $this->dbx->opt("SELECT ra.replid,CONCAT(ra.nama,' [',ra.kode,']') as nama FROM rekakun ra where ra.kategori='BIAYA' ORDER BY ra.nama",'up');
    	return $data;
    }

    public function ubahrealisasi_db($data,$id) {
		//echo var_dump($data);die;
		$this->db->where('replid',$id);
		$this->db->update('hrm_kaskecil_realisasi', $data);
		if ($this->db->_error_number() == 0) {
		  return true;
		} else {
		  return false;
		}
	}

	public function adjustment($id,$add) {
    	$sql="SELECT SUM(jumlah) as total,idkredit FROM hrm_kaskecil_mat WHERE idkaskecil='".$id."' GROUP BY idkredit";
    	$adjustment=$this->dbx->data($sql);
    	if (!empty($adjustment)){
    		foreach($adjustment as $row) {
    			$sql="SELECT nilai FROM rekakun WHERE replid='".$row->idkredit."'";
    			$adjustment_nilai=$this->dbx->rows($sql);
    			if($add==1){
	    			$data=array(
							"nilai"=> (intval($adjustment_nilai->nilai)-intval($row->total))
						);
				}else{
					$data=array(
						"nilai"=> (intval($adjustment_nilai->nilai)+intval($row->total))
					);
				}
    			$this->db->where('replid',$row->idkredit);
    			$this->db->update('rekakun', $data);
    		}
    	}

    	if ($this->db->_error_number() == 0) {
	    	return true;
		} else {
			return false;
		}
    }
    public function adjust_realisasi($id,$add) {
    	$sql="SELECT SUM(jumlah) as total,idkredit
    			,(SELECT SUM(jumlah) as total FROM hrm_kaskecil_realisasi WHERE idkaskecil='".$id."' AND idkredit=kk.idkredit GROUP BY idkredit) as realisasi
    			FROM hrm_kaskecil_mat kk WHERE idkaskecil='".$id."' GROUP BY idkredit";
    	$adjustment=$this->dbx->data($sql);
    	if (!empty($adjustment)){
    		foreach($adjustment as $row) {
    			$sql="SELECT nilai FROM rekakun WHERE replid='".$row->idkredit."'";
    			$adjustment_nilai=$this->dbx->rows($sql);
    			if($add==1){
	    			$data=array(
							"nilai"=> (intval($adjustment_nilai->nilai)+(intval($row->total)-intval($row->realisasi)))
						);
				}else{
					$data=array(
							"nilai"=> (intval($adjustment_nilai->nilai)-(intval($row->total)-intval($row->realisasi)))
						);
				}
    			$this->db->where('replid',$row->idkredit);
    			$this->db->update('rekakun', $data);
    		}
    	}

    	if ($this->db->_error_number() == 0) {
	    	return true;
		} else {
			return false;
		}
    }
    public function hapus_data_realisasi($id) {
	    // Query to check whether username already exist or not
	    $this->db->where('idkaskecil',$id);
	    $this->db->delete('hrm_kaskecil_realisasi');
	    if ($this->db->_error_number() == 0) {
	    	return true;
	    } else {
	        return false;
	    }
    }

    //APPROVAL KAS KECIL
    public function approval_db() {
      	$sql="SELECT kk.*,c.nama as company,p.nama as pemohon,d.departemen,s.status as statustext,1 as app
      			,pk.kode_transaksi as noppkb
      			FROM hrm_kaskecil kk
      			LEFT JOIN hrm_company c ON kk.idcompany=c.replid
      			LEFT JOIN pegawai p ON kk.pemohon=p.replid
      			LEFT JOIN hrm_datapengeluaran dp ON kk.idpengeluaran=dp.replid
      			LEFT JOIN hrm_departemen d ON kk.iddepartemen=d.replid
      			LEFT JOIN hrm_status s ON kk.status=s.node
      			LEFT JOIN hrm_ppkb pk ON pk.replid=kk.idppkb
      			WHERE kk.status=5
      					AND kk.approver='".$this->session->userdata('idpegawai')."'
      			ORDER BY kk.tanggalpengajuan";
      	return $this->dbx->data($sql);
    }

    //APPROVAL KAS KECIL
    public function revisi_db() {
      	$sql="SELECT kk.*,c.nama as company,p.nama as pemohon,d.departemen,s.status as statustext,4 as app
      			,pk.kode_transaksi as noppkb
      			FROM hrm_kaskecil kk
      			LEFT JOIN hrm_company c ON kk.idcompany=c.replid
      			LEFT JOIN pegawai p ON kk.pemohon=p.replid
      			LEFT JOIN hrm_datapengeluaran dp ON kk.idpengeluaran=dp.replid
      			LEFT JOIN hrm_departemen d ON kk.iddepartemen=d.replid
      			LEFT JOIN hrm_status s ON kk.status=s.node
      			LEFT JOIN hrm_ppkb pk ON pk.replid=kk.idppkb
      			WHERE kk.status=4
      			ORDER BY kk.tanggalpengajuan";
      	return $this->dbx->data($sql);
    }

    //APPROVAL KAS KECIL
    public function history_db() {
      	$sql="SELECT kk.*,c.nama as company,p.nama as pemohon,d.departemen,s.status as statustext,100 as app
      			,p2.nama as approvertext
      			,pk.kode_transaksi as noppkb
      			FROM hrm_kaskecil kk
      			LEFT JOIN hrm_company c ON kk.idcompany=c.replid
      			LEFT JOIN pegawai p ON kk.pemohon=p.replid
      			LEFT JOIN pegawai p2 ON kk.approver=p2.replid
      			LEFT JOIN hrm_datapengeluaran dp ON kk.idpengeluaran=dp.replid
      			LEFT JOIN hrm_departemen d ON kk.iddepartemen=d.replid
      			LEFT JOIN hrm_status s ON kk.status=s.node
      			LEFT JOIN hrm_ppkb pk ON pk.replid=kk.idppkb
      			ORDER BY kk.tanggalpengajuan";
      	return $this->dbx->data($sql);
    }
}
?>
