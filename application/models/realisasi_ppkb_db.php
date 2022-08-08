<?php

Class realisasi_ppkb_db extends CI_Model {
public function __construct() {
parent::__construct();
	$this->load->library('dbx');
}
    // Read data from database to show data in admin page
    public function data() {
      	$sql="SELECT kk.*,c.nama as company,p.nama as pemohon,d.departemen,s.status as statustext FROM hrm_ppkb kk
      			LEFT JOIN hrm_company c ON kk.idcompany=c.replid
      			LEFT JOIN pegawai p ON kk.pemohon=p.replid
      			LEFT JOIN hrm_datapengeluaran dp ON kk.idpengeluaran=dp.replid
      			LEFT JOIN hrm_departemen d ON kk.iddepartemen=d.replid
      			LEFT JOIN hrm_status s ON kk.status=s.node
      			WHERE kk.status IN (11,4)
      			ORDER BY kk.tanggalpengajuan";
      	return $this->dbx->data($sql);
    }
    public function view_db($id='',$data) {
    	$data['id']=$id;
      	$sql="SELECT kk.*,c.nama as company,CONCAT(p.nama,' (',p.nip,')') as pemohontext,d.departemen,s.status as statustext, dp.nama as idpengeluaran
      				,IF(kk.pelapor<>'',CONCAT(px.nama,' (',px.nip,')'),pemohon)  as pelapor
      				,IF(tanggalpelapor<>'0000-00-00 00:00:00',tanggalpelapor,CURRENT_DATE())  as tanggalpelapor
      			FROM hrm_ppkb kk
      			LEFT JOIN hrm_company c ON kk.idcompany=c.replid
      			LEFT JOIN pegawai p ON kk.pemohon=p.replid
      			LEFT JOIN pegawai px ON kk.pelapor=px.replid
      			LEFT JOIN hrm_datapengeluaran dp ON kk.idpengeluaran=dp.replid
      			LEFT JOIN hrm_departemen d ON kk.iddepartemen=d.replid
      			LEFT JOIN hrm_status s ON kk.status=s.node
      			WHERE kk.replid='".$id."'
      			ORDER BY kk.tanggalpengajuan";
        $data['isi'] = $this->dbx->rows($sql);

        $sql="SELECT pm.*,CONCAT('[',im.kode,'] ',' ',im.nama) as idmaterial,u.unit as idunit
	        		,IF(idmaterial_realisasi<>'',CONCAT('[',im2.kode,'] ',' ',im2.nama),CONCAT('[',im.kode,'] ',' ',im.nama)) as idmaterial_realisasi
	        		,u2.unit as idunit_realisasi
	        		,CONCAT(rk.kode,' ',rk.nama) as idkredit
	        		,CONCAT(rd.kode,' ',rd.nama) as iddebit
        		FROM hrm_ppkb_mat pm
        		INNER JOIN inventory_material im ON pm.idmaterial=im.replid
        		INNER JOIN inventory_unit u ON pm.idunit=u.replid
        		LEFT JOIN inventory_material im2 ON pm.idmaterial_realisasi=im2.replid
        		LEFT JOIN inventory_unit u2 ON pm.idunit_realisasi=u2.replid
        		LEFT JOIN rekakun rk ON rk.replid=pm.idkredit AND rk.kategori='HARTA'
        		LEFT JOIN rekakun rd ON rd.replid=pm.iddebit AND rd.kategori IN ('BIAYA','INVENTARIS')
        		WHERE idppkb='".$id."'";
        $data['keperluan'] = $this->dbx->data($sql);

        $sql="SELECT pm.*,CONCAT('[',im.kode_jasa,'] ',' ',im.jasa) as idjasa,u.unit as idunit
	        		,IF(idjasa_realisasi<>'',CONCAT('[',im2.kode_jasa,'] ',' ',im2.jasa),CONCAT('[',im.kode_jasa,'] ',' ',im.jasa)) as idjasa_realisasi
	        		,u2.unit as idunit_realisasi
	        		,CONCAT(rk.kode,' ',rk.nama) as idkredit
	        		,CONCAT(rd.kode,' ',rd.nama) as iddebit
        		FROM hrm_ppkb_jasa pm
        		INNER JOIN inventory_jasa im ON pm.idjasa=im.replid
        		INNER JOIN inventory_unit u ON pm.idunit=u.replid
        		LEFT JOIN inventory_jasa im2 ON pm.idjasa_realisasi=im2.replid
        		LEFT JOIN inventory_unit u2 ON pm.idunit_realisasi=u2.replid
        		LEFT JOIN rekakun rk ON rk.replid=pm.idkredit AND rk.kategori='HARTA'
        		LEFT JOIN rekakun rd ON rd.replid=pm.iddebit AND rd.kategori IN ('BIAYA','INVENTARIS')
        		WHERE idppkb='".$id."'";
        $data['jasa'] = $this->dbx->data($sql);

			  $sql="SELECT pm.*,u.unit as idunit
        			,IF(pm.keterangan_realisasi<>'',pm.keterangan_realisasi,pm.keterangan)  as keterangan_realisasi
        			,u2.unit as idunit_realisasi
        			,CONCAT(rk.kode,' ',rk.nama) as idkredit
      				,CONCAT(rd.kode,' ',rd.nama) as iddebit
      				,CONCAT(rk2.kode,' ',rk2.nama) as idadjustment
        		FROM hrm_ppkb_lain pm
        		INNER JOIN inventory_unit u ON pm.idunit=u.replid
        		LEFT JOIN inventory_unit u2 ON pm.idunit_realisasi=u2.replid
        		LEFT JOIN rekakun rk ON rk.replid=pm.idkredit AND rk.kategori='HARTA'
        		LEFT JOIN rekakun rd ON rd.replid=pm.iddebit AND rd.kategori IN ('BIAYA','INVENTARIS')
        		LEFT JOIN rekakun rk2 ON rk2.replid=pm.idadjustment AND rk2.kategori='HARTA'
        		WHERE idppkb='".$id."'";
				$data['lain'] = $this->dbx->data($sql);

				if (!empty($data['lain'])){
					$sqllpjlain="SELECT *,CONCAT(rd.kode,' ',rd.nama) as coa
														,CONCAT(rd2.kode,' ',rd2.nama) as idpengeluarantext
														,CONCAT(rd3.kode,' ',rd3.nama) as idsumberdanatext
														,rl.tanggalrealisasi 
									FROM (SELECT SUM(r.jumlah) as nilaitot,r.idkredit,r.iddebit,k.idppkb,u.replid as iduudp,u.idsumberdana
															FROM hrm_kaskecil_realisasi r
															INNER JOIN hrm_kaskecil k ON k.replid=r.idkaskecil
															INNER JOIN hrm_ppkb_uudp u ON k.idppkb=u.idppkb
															GROUP BY r.iddebit) as kk
									LEFT JOIN hrm_ppkb_realisasilain rl ON rl.iduudp=kk.iduudp
									LEFT JOIN rekakun rd ON rd.replid=kk.iddebit
									LEFT JOIN rekakun rd2 ON rd2.replid=kk.idkredit
									LEFT JOIN rekakun rd3 ON rd3.replid=kk.idsumberdana
									WHERE kk.idppkb='".$id."'";
					$data['lpjlain'] = $this->dbx->data($sqllpjlain);
				}

        //------------------------------------------------------------------------------------------------

        $sql="SELECT u.*,p.nama as penerima
							,CONCAT(ra.kode,' ',ra.nama) as idsumberdanatext
						FROM hrm_ppkb_uudp u
        		LEFT JOIN pegawai p ON p.replid=u.penerima
						LEFT JOIN rekakun ra ON ra.replid=u.idsumberdana AND ra.kategori='HARTA'
        		WHERE u.idppkb='".$id."' ORDER BY u.tanggalpenerima";
        $data['uudp'] = $this->dbx->data($sql);

        $data['status_opt'] = $this->dbx->opt("select node as replid ,status as nama FROM hrm_status where replid IN (11,4) ORDER BY nama",'up');

        //attachment
        $sql2="SELECT * FROM hrm_ppkb_attachment WHERE idppkb='".$id."'";
        $data['attachment'] = $this->dbx->data($sql2);

        return $data;
    }

    public function kode_transaksi($company,$tanggalpengajuan){
	    $kode_transaksi="";

	    $sql="SELECT CONCAT(company_code,'/realisasi_ppkb/',(SELECT DATE_FORMAT('".$tanggalpengajuan."','%Y%m')),'/') as kode_transaksi
	    		FROM hrm_company WHERE replid='".$company."'";
	    $query=$this->db->query($sql);
	    $isi=$query->row();
	    if ($query->num_rows() > 0) {
	    	$kode_transaksi=$isi->kode_transaksi;
	    }

	    $sql2="SELECT LPAD(RIGHT(RIGHT(trim(kode_transaksi),11),4)+1,4,'0') as kode_transaksi2 FROM hrm_ppkb_realisasi WHERE idcompany='".$company."'
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


    //KEPERLUAN
    //-------------------------------------------------------------------------------------------
    public function ubahkeperluan_x($id='',$data) {
    	$data['id']=$id;
      	$sql="SELECT *,IF(tanggalrealisasi<>NULL,tanggalrealisasi,CURRENT_DATE()) as tanggalrealisasi
      			FROM hrm_ppkb_mat km
      			WHERE km.replid='".$id."'";
        $data['isi'] = $this->dbx->rows($sql);

        if ($data['isi']->idmaterial_realisasi<> "" ) {
        	unset($data['isi']);
        	$sql="SELECT
	        			idmaterial_realisasi as idmaterial,
						jumlah_realisasi as jumlah,
						idunit_realisasi as idunit,
						nilai_realisasi as nilai
						,idkredit
						,iddebit
						,tanggalrealisasi
						,realisasi_notes
					FROM hrm_ppkb_mat km
					WHERE km.replid='".$id."'";
        	$data['isi']=$this->dbx->rows($sql);
        }

        $data['mat_opt'] = $this->dbx->opt("SELECT im.replid,CONCAT(im.kode,' ',im.nama) as nama FROM inventory_material im ORDER BY im.nama",'up');
        $data['unit_opt'] = $this->dbx->opt("SELECT im.replid,im.unit as nama FROM inventory_unit im ORDER BY im.unit",'up');
    	$data['kredit_opt'] = $this->dbx->opt("SELECT ra.replid,CONCAT(ra.nama,' [',ra.kode,']') as nama FROM rekakun ra where ra.kategori='HARTA' ORDER BY ra.nama",'up');
    	$data['debit_opt'] = $this->dbx->opt("SELECT ra.replid,CONCAT(ra.nama,' [',ra.kode,']') as nama FROM rekakun ra where ra.kategori IN ('BIAYA','INVENTARIS') ORDER BY ra.nama",'up');

    	return $data;
    }

	public function ubahkeperluan_db($data,$id) {
		//echo var_dump($data);die;
		$this->db->where('replid',$id);
		$this->db->update('hrm_ppkb_mat', $data);
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
      	$sql="SELECT *,IF(tanggalrealisasi<>NULL,tanggalrealisasi,CURRENT_DATE()) as tanggalrealisasi
      			FROM hrm_ppkb_jasa km
      			WHERE km.replid='".$id."'";
        $data['isi'] = $this->dbx->rows($sql);

        if ($data['isi']->idjasa_realisasi <> "" ) {
        	unset($data['isi']);
        	$sql="SELECT
	        			idjasa_realisasi as idjasa,
	        			tgl_periode1_realisasi as tgl_periode1,
	        			tgl_periode2_realisasi as tgl_periode2,
						jumlah_realisasi as jumlah,
						idunit_realisasi as idunit,
						nilai_realisasi as nilai
						,idkredit
						,iddebit
						,tanggalrealisasi
						,realisasi_notes
					FROM hrm_ppkb_jasa km
					WHERE km.replid='".$id."'";
        	$data['isi']=$this->dbx->rows($sql);
        }

        $data['jasa_opt'] = $this->dbx->opt("SELECT im.replid,CONCAT('[',im.kode_jasa,'] ',' ',im.jasa) as nama FROM inventory_jasa im ORDER BY im.jasa",'up');
        $data['unit_opt'] = $this->dbx->opt("SELECT im.replid,im.unit as nama FROM inventory_unit im ORDER BY im.unit",'up');
    	$data['kredit_opt'] = $this->dbx->opt("SELECT ra.replid,CONCAT(ra.nama,' [',ra.kode,']') as nama FROM rekakun ra where ra.kategori='HARTA' ORDER BY ra.nama",'up');
    	$data['debit_opt'] = $this->dbx->opt("SELECT ra.replid,CONCAT(ra.nama,' [',ra.kode,']') as nama FROM rekakun ra where ra.kategori IN ('BIAYA','INVENTARIS') ORDER BY ra.nama",'up');

    	return $data;
    }

	public function ubahjasa_db($data,$id) {
		//echo var_dump($data);die;
		$this->db->where('replid',$id);
		$this->db->update('hrm_ppkb_jasa', $data);
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
      	$sql="SELECT *,IF(tanggalrealisasi<>NULL,tanggalrealisasi,CURRENT_DATE()) as tanggalrealisasi
      			FROM hrm_ppkb_realisasilain km
      			WHERE km.replid='".$id."'";
        $data['isi'] = $this->dbx->rows($sql);

        if ($data['isi']->keterangan_realisasi <> "" ) {
        	unset($data['isi']);
        	$sql="SELECT
								'-' as kode_transaksi
								,NULL as iduudp
	        			,0 as nilai
								, CURRENT_DATE() as tanggalrealisasi
								,NULL as idbeban
								,'' as keterangan ";
        	$data['isi']=$this->dbx->rows($sql);
        }

				$data['iduudp_opt'] = $this->dbx->opt("SELECT replid,kode_transaksi FROM hrm_ppkb_uudp u ORDER BY kode_transaksi",'up');
				$data['idbeban_opt'] = $this->dbx->opt("SELECT ra.replid,CONCAT(ra.nama,' [',ra.kode,']') as nama FROM rekakun ra where ra.kategori IN ('BIAYA','INVENTARIS') ORDER BY ra.nama",'up');
				/*
        $data['unit_opt'] = $this->dbx->opt("SELECT im.replid,im.unit as nama FROM inventory_unit im ORDER BY im.unit",'up');
    	$data['kredit_opt'] = $this->dbx->opt("SELECT ra.replid,CONCAT(ra.nama,' [',ra.kode,']') as nama FROM rekakun ra where ra.kategori='HARTA' ORDER BY ra.nama",'up');
        $data['debit_opt'] = $this->dbx->opt("SELECT ra.replid,CONCAT(ra.nama,' [',ra.kode,']') as nama FROM rekakun ra where ra.kategori IN ('BIAYA','INVENTARIS') ORDER BY ra.nama",'up');
				*/
    	return $data;
    }

	public function ubahlain_db($data,$id) {
		//echo var_dump($data);die;
		$this->db->where('replid',$id);
		$this->db->update('hrm_ppkb_lain', $data);
		if ($this->db->_error_number() == 0) {
		  return true;
		} else {
		  return false;
		}
	}

    //-------------------------------------------------------------------------------------------
    public function ubah($data,$id) {
	  $this->db->where('replid',$id);
	  $this->db->update('hrm_ppkb', $data);
	  if ($this->db->_error_number() == 0) {
		  return true;
	  } else {
		  return false;
      }
    }

    public function adjustmentlain($id) {
    	$sql="SELECT SUM(sub_total) as total,idadjustment FROM hrm_ppkb_lain WHERE idppkb='".$id."' GROUP BY idadjustment";
    	$adjustment=$this->dbx->data($sql);
    	if (!empty($adjustment)){
    		foreach($adjustment as $row) {
    			$sql="SELECT nilai FROM rekakun WHERE replid='".$row->idadjustment."'";
    			$adjustment_nilai=$this->dbx->rows($sql);
    			$data=array(
						"nilai"=> (intval($adjustment_nilai->nilai)+intval($row->total))
					);
    			$this->db->where('replid',$row->idadjustment);
    			$this->db->update('rekakun', $data);
    		}
    	}

    	if ($this->db->_error_number() == 0) {
	    	return true;
			} else {
				return false;
			}
    }
}

?>
