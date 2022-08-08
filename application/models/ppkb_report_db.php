<?php

Class ppkb_report_db extends CI_Model {
public function __construct() {
parent::__construct();
	$this->load->library('dbx');
}
    // Read data from database to show data in admin page
    public function data() {
    	//echo $this->input->post("idcompany");die;
    	$cari="";
    	$printvalue=$this->input->post("printvalue");
    	$filter=$this->input->post("filter");
    	
    	$kode_transaksi=$this->input->post("kode_transaksi");
    	if ($kode_transaksi<>""){
    		if($cari<>""){
	    		$cari=$cari." AND ";
	    	}
	    	$cari=$cari." kk.kode_transaksi LIKE '%".$kode_transaksi."%'";
    	}
    	
    	$idcompany=$this->input->post("idcompany");
    	if ($idcompany<>""){
    		if($cari<>""){
	    	$cari=$cari." AND ";
	    	}
	    	$cari=$cari." kk.idcompany='".$idcompany."'";
    	}
    	
    	$pemohon=$this->input->post("pemohon");
    	if ($pemohon<>""){
    		if($cari<>""){
	    	$cari=$cari." AND ";
	    	}
	    	$cari=$cari." kk.pemohon='".$pemohon."'";
    	}
    	$iddepartemen=$this->input->post("iddepartemen");
    	if ($iddepartemen<>""){
    		if($cari<>""){
	    	$cari=$cari." AND ";
	    	}
	    	$cari=$cari." kk.iddepartemen='".$iddepartemen."'";
    	}
    	
    	
    	$tanggalpengajuan=$this->p_c->tgl_db($this->input->post("tanggalpengajuan"));
    	$tanggalpengajuan2=$this->p_c->tgl_db($this->input->post("tanggalpengajuan2"));
    	if (($tanggalpengajuan<>"") and ($tanggalpengajuan2=="")){
    		if($cari<>""){
	    		$cari=$cari." AND ";
	    	}
	    	$cari=$cari." kk.tanggalpengajuan >= '".$tanggalpengajuan."'";
    	}
    	
    	if (($tanggalpengajuan=="") and ($tanggalpengajuan2<>"")){
    		if($cari<>""){
	    	$cari=$cari." AND ";
	    	}
	    	$cari=$cari." kk.tanggalpengajuan<='".$tanggalpengajuan2."'";
    	}
    	if (($tanggalpengajuan<>"") and ($tanggalpengajuan2<>"")){
    		if($cari<>""){
	    	$cari=$cari." AND ";
	    	}
	    	$cari=$cari." kk.tanggalpengajuan BETWEEN '".$tanggalpengajuan."' AND '".$tanggalpengajuan2."'";
    	}
    	
    	$idkredit=$this->input->post("idkredit");
    	if ($idkredit<>""){
    		if($cari<>""){
	    	$cari=$cari." AND ";
	    	}
	    	$cari=$cari." km.idkredit='".$idkredit."'";
    	}
    	$iddebit=$this->input->post("iddebit");
    	if ($iddebit<>""){
    		if($cari<>""){
	    	$cari=$cari." AND ";
	    	}
	    	$cari=$cari." km.iddebit='".$iddebit."'";
    	}
    	$status=$this->input->post("status");
    	if ($status<>""){
    		if($cari<>""){
	    	$cari=$cari." AND ";
	    	}
	    	$cari=$cari." kk.status='".$status."'";
    	}
    	
    	if($cari<>""){
	    	$cari="WHERE ".$cari;
    	}
    	
    	//URUTAN
    	$urutxx=" ORDER BY ";
    	$berdasarkan=$this->input->post("berdasarkan");
    	if ($berdasarkan<>""){
       		$urutxx=$urutxx.$berdasarkan." ";
       	}else{
	    	$urutxx=$urutxx." kk.kode_transaksi ";
    	}
    	
    	$urutan=$this->input->post("urutan");
    	if ($urutan<>""){
       		$urutxx=$urutxx.$urutan;
       	}else{
	    	$urutxx=$urutxx." ASC";
    	}
    	
    	
    	
    	if(($filter<>"") or ($printvalue==1)){
	      	$sqltemp="CREATE TEMPORARY TABLE keperluan_tb
	      				SELECT kep.* FROM (
							SELECT idppkb,CONCAT('[',im.kode,'] ',' ',im.nama) as keperluantext,jumlah,idunit,nilai,sub_total,CONCAT('[',im.kode,'] ',' ',im.nama) as realisasitext,jumlah_realisasi,idunit_realisasi,nilai_realisasi,sub_total_realisasi,idkredit,iddebit
							,tanggalrealisasi
							,'MATERIAL' as jenis
							FROM hrm_ppkb_mat pm
							INNER JOIN inventory_material im ON pm.idmaterial=im.replid
							LEFT JOIN inventory_material im2 ON pm.idmaterial_realisasi=im2.replid
							
							UNION
							
							SELECT idppkb,CONCAT('[',ij.kode_jasa,'] ',' ',ij.jasa) as keperluantext,jumlah,idunit,nilai,sub_total,CONCAT('[',ij.kode_jasa,'] ',' ',ij.jasa) as realisasitext,jumlah_realisasi,idunit_realisasi,nilai_realisasi,sub_total_realisasi,idkredit,iddebit
							,tanggalrealisasi
							,'JASA' as jenis
							FROM hrm_ppkb_jasa pj
							INNER JOIN inventory_jasa ij ON pj.idjasa=ij.replid
							LEFT JOIN inventory_jasa ij2 ON pj.idjasa_realisasi=ij2.replid
							
							UNION 
							
							SELECT idppkb,keterangan as keperluantext,jumlah,idunit,nilai,sub_total,keterangan_realisasi as realisasitext,jumlah_realisasi,idunit_realisasi,nilai_realisasi,sub_total_realisasi,idkredit,iddebit
							,tanggalrealisasi
							,'LAIN-LAIN' as jenis
							FROM hrm_ppkb_lain pl
							) as kep
	      				";
	      	$this->db->query($sqltemp);
	      	
	      	$sql="SELECT kk.*,c.nama as company,CONCAT(p.nama,' (',p.nip,')') as pemohontext,d.departemen,s.status as statustext
      				,CONCAT(px.nama,' (',px.nip,')')  as pelapor
      				,kk.tanggalpelapor
      				,ktb.keperluantext,ktb.jumlah,ktb.nilai,ktb.sub_total,ktb.jenis
      				,ktb.realisasitext,ktb.jumlah_realisasi,ktb.nilai_realisasi,ktb.sub_total_realisasi
      				,u.unit as idunit
      				,u2.unit as idunit_realisasi
      				,CONCAT(rk.kode,' ',rk.nama) as idkredit 
      				,CONCAT(rd.kode,' ',rd.nama) as iddebit
      				,ktb.tanggalrealisasi
      				,(select SUM(nilai) from hrm_ppkb_uudp WHERE idppkb=kk.replid) as uudp
      				,kk.jumlah as total
      			FROM hrm_ppkb kk 
      			INNER JOIN keperluan_tb ktb ON kk.replid=ktb.idppkb
      			LEFT JOIN inventory_unit u ON ktb.idunit=u.replid
        		LEFT JOIN inventory_unit u2 ON ktb.idunit_realisasi=u2.replid
        		LEFT JOIN rekakun rk ON rk.replid=ktb.idkredit AND rk.kategori='HARTA'
        		LEFT JOIN rekakun rd ON rd.replid=ktb.iddebit AND rd.kategori='BIAYA' 
        		LEFT JOIN hrm_company c ON kk.idcompany=c.replid
      			LEFT JOIN pegawai p ON kk.pemohon=p.replid
      			LEFT JOIN pegawai px ON kk.pelapor=px.replid
      			LEFT JOIN hrm_departemen d ON kk.iddepartemen=d.replid
      			LEFT JOIN hrm_status s ON kk.status=s.node
	      			".$cari.$urutxx;
	      	//echo $sql;		
	      	$data['show_table']=$this->dbx->data($sql);
	      	$sql_drop="DROP TEMPORARY TABLE keperluan_tb;";
	      	$this->db->query($sql_drop);
	      	
      	}else{
	      	$data['show_table']=NULL;
      	}
      	
      	$data['filterx']=array('kode_transaksi'=>$kode_transaksi,'tanggalpengajuan'=>$this->input->post("tanggalpengajuan"),'tanggalpengajuan2'=>$this->input->post("tanggalpengajuan2"));
      	
      	if ($printvalue<>1){
	      	$sqlfilter="SELECT '".$kode_transaksi."' as kode_transaksi
	      						,'".$idcompany."' as idcompany
	      						,'".$pemohon."' as pemohon
	      						,'".$iddepartemen."' as iddepartemen
	      						,'".$this->input->post("tanggalpengajuan")."' as tanggalpengajuan
	      						,'".$this->input->post("tanggalpengajuan2")."' as tanggalpengajuan2
	      						,'".$idkredit."' as idkredit
	      						,'".$iddebit."' as iddebit
	      						,'".$status."' as status
	      						,'".$berdasarkan."' as berdasarkan
	      						,'".$urutan."' as urutan";
	      	$data['status_opt'] = $this->dbx->opt("select node as replid ,status as nama FROM hrm_status ORDER BY nama",'up');
	      	$data['company_opt'] = $this->dbx->opt("select replid,CONCAT(company_code,' ',nama) as nama from hrm_company WHERE aktif=1 ORDER BY nama",'up');
	        $data['pemohon_opt'] = $this->dbx->opt("select replid,nama from pegawai where aktif=1 ORDER BY nama",'up');
	        $data['departemen_opt'] = $this->dbx->opt("select replid,departemen as nama from hrm_departemen WHERE aktif=1 ORDER BY departemen",'up');
	         $data['jt_opt'] = $this->dbx->opt("select replid,nama from hrm_datapengeluaran ORDER BY nama",'up');
	        $data['kredit_opt'] = $this->dbx->opt("SELECT ra.replid,CONCAT(ra.kode,' ',ra.nama) as nama FROM rekakun ra where ra.kategori='HARTA' ORDER BY ra.nama",'up');
	        $data['debit_opt'] = $this->dbx->opt("SELECT ra.replid,CONCAT(ra.kode,' ',ra.nama) as nama FROM rekakun ra where ra.kategori='BIAYA' ORDER BY ra.nama",'up');
      	
      	}else{
	      	$sqlfilter="SELECT '".$kode_transaksi."' as kode_transaksi
      						,(select CONCAT(company_code,' ',nama) FROM hrm_company where replid='".$idcompany."') as idcompany
      						,(select CONCAT('[',nip,'] ',nama) from pegawai where replid='".$pemohon."') as pemohon
      						,(select departemen as nama from hrm_departemen WHERE replid='".$iddepartemen."') as iddepartemen
      						,'".$this->input->post("tanggalpengajuan")."' as tanggalpengajuan
      						,'".$this->input->post("tanggalpengajuan2")."' as tanggalpengajuan2
      						,(select nama from hrm_datapengeluaran where replid='".$idpengeluaran."') as idpengeluaran
      						,(SELECT CONCAT(ra.kode,' ',ra.nama) FROM rekakun ra where ra.kategori='HARTA' and replid='".$idkredit."') as idkredit
      						,(SELECT CONCAT(ra.kode,' ',ra.nama) FROM rekakun ra where ra.kategori='HARTA' and replid='".$iddebit."') as iddebit
      						,(SELECT status FROM hrm_status WHERE replid='".$status."') as status";
      	}
      	$data['filterx']=$this->dbx->rows($sqlfilter);
        return $data;

    }
}
?>