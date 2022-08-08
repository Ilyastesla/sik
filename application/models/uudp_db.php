<?php

Class uudp_db extends CI_Model {
public function __construct() {
parent::__construct();
	$this->load->library('dbx');
}
    // Read data from database to show data in admin page
    public function data() {
      	$sql="SELECT kk.*,c.nama as company,p.nama as pemohon,d.departemen,s.status as statustext
							,CONCAT(rk2.kode,' ',rk2.nama) as idadjustment
						FROM hrm_ppkb kk
      			LEFT JOIN hrm_company c ON kk.idcompany=c.replid
      			LEFT JOIN pegawai p ON kk.pemohon=p.replid
      			LEFT JOIN hrm_datapengeluaran dp ON kk.idpengeluaran=dp.replid
      			LEFT JOIN hrm_departemen d ON kk.iddepartemen=d.replid
      			LEFT JOIN hrm_status s ON kk.status=s.node
						LEFT JOIN rekakun rk2 ON rk2.replid=kk.idadjustment AND rk2.kategori='HARTA'
      			WHERE kk.status IN (11,12,3)
      			ORDER BY kk.tanggalpengajuan";
      	return $this->dbx->data($sql);
    }
    public function view_db($id='',$data) {
    	$data['id']=$id;
      	$sql="SELECT kk.*,c.nama as company
      				,CONCAT(p.nama,' (',p.nip,')') as pemohontext
      				,px3.nama as petugastext
      				,d.departemen,s.status as statustext, dp.nama as idpengeluaran
      				,IF(penerima<>'',CONCAT(px.nama,' (',px.nip,')'),pemohon)  as penerima
      				,IF(tanggalpenerima<>'0000-00-00 00:00:00',tanggalpenerima,CURRENT_DATE())  as tanggalpenerima
      				,c.phone,c.fax,c.website,c.email,c.street,c.zip
							,CONCAT(rk2.kode,' ',rk2.nama) as idadjustmenttext
      			FROM hrm_ppkb kk
      			LEFT JOIN hrm_company c ON kk.idcompany=c.replid
      			LEFT JOIN pegawai p ON kk.pemohon=p.replid
      			LEFT JOIN pegawai px ON kk.penerima=px.replid
      			LEFT JOIN pegawai px3 ON kk.modified_by=px3.nip
      			LEFT JOIN hrm_datapengeluaran dp ON kk.idpengeluaran=dp.replid
      			LEFT JOIN hrm_departemen d ON kk.iddepartemen=d.replid
      			LEFT JOIN hrm_status s ON kk.status=s.node
						LEFT JOIN rekakun rk2 ON rk2.replid=kk.idadjustment AND rk2.kategori='HARTA'
      			WHERE kk.replid='".$id."'
      			ORDER BY kk.tanggalpengajuan";
        $data['isi'] = $this->dbx->rows($sql);

        $sql="SELECT pm.*,CONCAT('[',im.kode,'] ',' ',im.nama) as idmaterial,u.unit as idunit FROM hrm_ppkb_mat pm
        		INNER JOIN inventory_material im ON pm.idmaterial=im.replid
        		INNER JOIN inventory_unit u ON pm.idunit=u.replid
        		WHERE idppkb='".$id."'";
        $data['keperluan'] = $this->dbx->data($sql);

        $sql="SELECT pm.*,CONCAT('[',im.kode_jasa,'] ',' ',im.jasa) as idjasa,u.unit as idunit FROM hrm_ppkb_jasa pm
        		INNER JOIN inventory_jasa im ON pm.idjasa=im.replid
        		INNER JOIN inventory_unit u ON pm.idunit=u.replid
        		WHERE idppkb='".$id."'";
        $data['jasa'] = $this->dbx->data($sql);

        $sql="SELECT pm.*,u.unit as idunit
							FROM hrm_ppkb_lain pm
        		INNER JOIN inventory_unit u ON pm.idunit=u.replid
        		WHERE idppkb='".$id."'";
        $data['lain'] = $this->dbx->data($sql);

        $sql="SELECT * FROM hrm_ppkb_termin WHERE idppkb='".$id."' ORDER BY due_date";
        $data['termin'] = $this->dbx->data($sql);

        $iduupx="";
        if (isset($data['iduudp'])){
	        $iduupx=" AND u.replid='".$data['iduudp']."'";
        }

        $sql="SELECT u.*,p.nama as penerima, (SELECT SUM(u.nilai) FROM hrm_ppkb_uudp u WHERE u.idppkb='".$id."' ".$iduupx." )as total
							,CONCAT(ra.kode,' ',ra.nama) as idsumberdanatext
						FROM hrm_ppkb_uudp u
        		LEFT JOIN pegawai p ON p.replid=u.penerima
						LEFT JOIN rekakun ra ON ra.replid=u.idsumberdana AND ra.kategori='HARTA'
        		WHERE u.idppkb='".$id."' ".$iduupx." ORDER BY u.tanggalpenerima";
        $data['uudp'] = $this->dbx->data($sql);


        $sql="SELECT p.replid,p.nama from pegawai p
				INNER JOIN hrm_pegawai_jabatan pj ON p.replid=pj.idpegawai
				INNER JOIN hrm_jabatan j ON pj.idjabatan=j.replid
				WHERE p.aktif=1 AND j.idjabatan_grup='6' AND j.iddepartemen='".$data['isi']->iddepartemen."' ORDER BY p.nama LIMIT 1";
		//echo $sql;
		$queryx = $this->db->query($sql);
		$rows=$queryx->row();
		if (isset($rows->nama)){
			$data['approve_by_text'] = $rows->nama;
		}else{
			$data['approve_by_text'] = "";
		}


        return $data;
    }

   public function tambahbayar($id,$idx='',$data) {
    	$data['id']=$id;
      	$sql="SELECT u.*,pk.idadjustment
      			FROM hrm_ppkb_uudp u
						INNER JOIN hrm_ppkb pk ON u.idppkb=pk.replid
      			WHERE u.replid='".$idx."'";
      	//echo $sql;die;
        $data['isi'] = $this->dbx->rows($sql);

        if ($data['isi']== NULL ) {
        	unset($data['isi']);
        	$sql="SELECT
        			(SELECT jumlah FROM hrm_ppkb  WHERE replid='".$id."') as nilaix,
					(SELECT SUM(nilai) FROM hrm_ppkb_uudp WHERE idppkb='".$id."') as nilaiy
					";
			//echo $sql;die;
        	$data['isi2']=$this->dbx->rows($sql);
        	$sisanilai=intval($data['isi2']->nilaix)-intval($data['isi2']->nilaiy);

        	$sql="SELECT
							pemohon as penerima
							,idadjustment
        			,'-' as kode_transaksi
					,CURRENT_DATE() as tanggalpenerima
					,".$sisanilai." as nilai
					,' ' as idsumberdana
					FROM hrm_ppkb WHERE replid='".$id."'";
        	$data['isi']=$this->dbx->rows($sql);
        }
        $data['penerima_opt'] = $this->dbx->opt("select replid,nama from pegawai where aktif=1 ORDER BY nama",'up');
				$data['idsumberdana_opt'] = $this->dbx->opt("SELECT ra.replid,CONCAT(ra.nama,' [',ra.kode,']') as nama FROM rekakun ra where ra.kategori='HARTA' ORDER BY ra.nama",'up');
        return $data;
    }

    public function kode_transaksi($company,$tanggalpengajuan,$idppkb){
	    $kode_transaksi="";
	    /*
	    $sql="SELECT CONCAT(company_code,'/UUDP/',(SELECT DATE_FORMAT('".$tanggalpengajuan."','%Y%m')),'/') as kode_transaksi
	    		FROM hrm_company WHERE replid='".$company."'";
	    $query=$this->db->query($sql);
	    $isi=$query->row();
	    if ($query->num_rows() > 0) {
	    	$kode_transaksi=$isi->kode_transaksi;
	    }

	    $sql2="SELECT LPAD(RIGHT(RIGHT(trim(kode_transaksi),11),4)+1,4,'0') as kode_transaksi2 FROM hrm_ppkb_uudp WHERE idcompany='".$company."'
 and LEFT(RIGHT(trim(kode_transaksi),11),6)=DATE_FORMAT('".$tanggalpengajuan."','%Y%m') ORDER BY kode_transaksi2 DESC LIMIT 1";
	   $query2=$this->db->query($sql2);
	    $isi2=$query2->row();
	    if ($query2->num_rows() > 0) {
	    	$kode_transaksi=$kode_transaksi.$isi2->kode_transaksi2;
	    }elseif ($kode_transaksi<>""){
		    $kode_transaksi=$kode_transaksi."0001";
	    }

	    */

	    $sql="SELECT p.kode_transaksi,LPAD(RIGHT(trim(up.kode_transaksi),4)+1,4,'0') as kode_uudp FROM hrm_ppkb p
				LEFT JOIN hrm_ppkb_uudp up ON up.idppkb=p.replid
				WHERE p. replid='".$idppkb."' ORDER BY kode_uudp DESC";
	    $query=$this->db->query($sql);
	    $isi=$query->row();
	    if ($query->num_rows() > 0) {
	    	$kode_transaksi=$isi->kode_transaksi;
	    	if($isi->kode_uudp<>""){
		    	$kode_transaksi=$kode_transaksi."/".$isi->kode_uudp;
	    	}else{
		    	$kode_transaksi=$kode_transaksi."/0001";
	    	}

	    }
	    return $kode_transaksi;

    }

    public function tambahbayar_p($data) {
    	//echo print_r(array_values($data));die;
    	$this->db->trans_start();
        $this->db->insert('hrm_ppkb_uudp', $data);
        $insert_id = $this->db->insert_id();
        if ($this->db->affected_rows() > 0) {
               $this->db->trans_complete();
               return $insert_id;
        } else {
        	$this->db->trans_complete();
            return false;
        }
     }

    public function ubahbayar_db($data,$idx) {
		//echo var_dump($data);die;
		$this->db->where('replid',$idx);
		$this->db->update('hrm_ppkb_uudp', $data);
		if ($this->db->_error_number() == 0) {
		  return true;
		} else {
		  return false;
		}
	}

    public function hapusbayar_db($idx) {
	    // Query to check whether username already exist or not
	    $this->db->where('replid',$idx);
	    $this->db->delete('hrm_ppkb_uudp');
	    if ($this->db->_error_number() == 0) {
	    	return true;
	    } else {
	        return false;
	    }
    }

    public function ubah($data,$id) {
	  $this->db->where('replid',$id);
	  $this->db->update('hrm_ppkb', $data);
	  if ($this->db->_error_number() == 0) {
		  return true;
	  } else {
		  return false;
      }
    }

		public function adjustmentakun($id,$idadjustment) {
			//hitung sumberdana dulu harusnya
			$total_adjustment=0;
			$sql="SELECT SUM(nilai) as totaluudp FROM hrm_ppkb_uudp WHERE idppkb='".$id."'";
			$total_adjustment=$this->dbx->rows($sql);

			$sql="SELECT nilai FROM rekakun WHERE replid='".$idadjustment."'";
			$nilaiakun=$this->dbx->rows($sql);
			$data=array(
				"nilai"=> (intval($total_adjustment->totaluudp)+intval($nilaiakun->nilai))
			);
			$this->db->where('replid',$row->idadjustment);
			$this->db->update('rekakun', $data);

			if ($this->db->_error_number() == 0) {
				return true;
			} else {
				return false;
			}
		}
}

?>
