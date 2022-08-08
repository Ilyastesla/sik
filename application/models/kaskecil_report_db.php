<?php

Class kaskecil_report_db extends CI_Model {
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


    	$idpengeluaran=$this->input->post("idpengeluaran");
    	if ($idpengeluaran<>""){
    		if($cari<>""){
	    	$cari=$cari." AND ";
	    	}
	    	$cari=$cari." km.idpengeluaran='".$idpengeluaran."'";
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
	      	$sql="SELECT kk.*,c.nama as company,d.departemen,s.status as statustext
	      			,CONCAT(p.nama,' (',p.nip,')') as pemohontext
	      			,px2.nama as approvebytext
	      			,CONCAT(px.nama,' (',px.nip,')') as penerimatext
	      			,dp.nama as idpengeluaran
        			,CONCAT(rk.kode,' ',rk.nama) as idkredit
      				,CONCAT(rd.kode,' ',rd.nama) as iddebit
      				,km.jumlah as jumlahmat,km.keperluan
      				,kr.jumlah as realisasi
      				,pk.kode_transaksi as noppkb
	      			FROM hrm_kaskecil kk
	      			LEFT JOIN hrm_company c ON kk.idcompany=c.replid
	      			LEFT JOIN pegawai p ON kk.pemohon=p.replid
	      			LEFT JOIN pegawai px ON kk.penerima=px.replid
	      			LEFT JOIN pegawai px2 ON kk.approve_by=px2.replid
	      			LEFT JOIN hrm_departemen d ON kk.iddepartemen=d.replid
	      			LEFT JOIN hrm_status s ON kk.status=s.node
	      			LEFT JOIN hrm_kaskecil_mat km ON kk.replid=km.idkaskecil
	      			LEFT JOIN hrm_kaskecil_realisasi kr ON km.replid=kr.idmat
	      			LEFT JOIN hrm_datapengeluaran dp ON km.idpengeluaran=dp.replid
	      			LEFT JOIN rekakun rk ON rk.replid=km.idkredit AND rk.kategori='HARTA'
	      			LEFT JOIN rekakun rd ON rd.replid=km.iddebit AND rd.kategori='BIAYA'
	      			LEFT JOIN hrm_ppkb pk ON pk.replid=kk.idppkb
	      			".$cari.$urutxx;
	      	//echo $sql;
	      	$data['show_table']=$this->dbx->data($sql);
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
	      						,'".$idpengeluaran."' as idpengeluaran
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
