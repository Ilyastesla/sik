<?php

Class online_kronologis_db extends CI_Model {
	public function __construct() {
		parent::__construct();
		$this->load->library('dbx');
	}

    // Read data from database to show data in admin page
    public function data() {
			$cari="";
			//	echo $this->session->flashdata('idproses');die;
      if (($this->input->post('periode1')<>"") AND ($this->input->post('periode2')=="")){
        $cari=$cari." AND ok.created_date >= '".$this->p_c->tgl_db($this->input->post('periode1'))."' ";
      }
      if (($this->input->post('periode1')=="") AND ($this->input->post('periode2')<>"")){
        $cari=$cari." AND ok.created_date <= '".$this->p_c->tgl_db($this->input->post('periode2'))."' ";
      }
      if (($this->input->post('periode1')<>"") AND ($this->input->post('periode2')<>"")){
        $cari=$cari." AND ok.created_date BETWEEN '".$this->p_c->tgl_db($this->input->post('periode1'))."' AND '".$this->p_c->tgl_db($this->input->post('periode2'))."' ";
      }

      if(($cari=="") AND ($this->input->post('nama')=="")){
        //$cari=$cari." AND YEAR(ok.created_date)=YEAR(CURRENT_DATE())";
				$cari=$cari." AND ta.aktifdaftar=1 ";
      }

      if ($this->input->post('iddepartemen')<>""){
        $cari=$cari." AND ok.jenjang='".$this->input->post('iddepartemen')."' ";
      }

      if ($this->input->post('idproses')<>""){
        //$cari=$cari." AND ks.idproses='".$this->input->post('idproses')."' ";
      }

      if ($this->input->post('idkelompok')<>""){
        //$cari=$cari." AND ks.idkelompok='".$this->input->post('idkelompok')."' ";
      }

			if ($this->input->post('status')<>""){
        $cari=$cari." AND ok.status='".$this->input->post('status')."' ";
      }

			if ($this->input->post('nama')<>""){
				//$cari=$cari." s.nama like '%".$this->session->userdata('nama')."%' ";
				$cari=$cari." AND ".$this->input->post('jeniscari')." like '%".$this->input->post('nama')."%' ";

			}
        /*
        WHERE p.replid=ok.proses_by
          ".$cari."
        */
		$cari=$cari." AND ok.idunitbisnis='".$this->input->post('idcompany')."' ";

      	$sql = "SELECT ok.*,s.status as statustext,cs.nopendaftaran
											, CONCAT(TIMESTAMPDIFF( YEAR, ok.tanggallahir, now() ),' Tahun, ',TIMESTAMPDIFF( MONTH, ok.tanggallahir, now() ) % 12,' Bulan') as umur
											,c.nama as companytext
											,cs.tanggal_daftar,cs.verifikasi
											,ta.tahunajaran as tahunajarantext
      			FROM online_kronologis ok
                LEFT JOIN hrm_status s ON s.node=ok.status
				LEFT JOIN tahunajaran ta ON ta.replid=ok.idtahunajaran
				LEFT JOIN calonsiswa cs ON cs.replid=ok.idcalon
				INNER JOIN hrm_company c ON c.replid=ok.idunitbisnis
				WHERE ok.replid IS NOT NULL 
							".$cari."
				ORDER BY ok.created_date DESC";
		$data['show_table']=$this->dbx->data($sql);
				//echo $sql;
		$data['iddepartemen_opt'] = $this->dbx->opt("SELECT departemen as replid,departemen as nama FROM departemen WHERE aktif=1 AND replid IN (".$this->session->userdata('dept').") ORDER BY urutan",'up');
        $data['tahunmasuk_opt'] = $this->dbx->opt("SELECT DISTINCT tahunmasuk as replid, tahunmasuk as nama FROM calonsiswa ORDER BY tahunmasuk DESC",'up');
		$data['idproses_opt'] = $this->dbx->opt("SELECT replid,proses as nama FROM prosespenerimaansiswa WHERE departemen='".$this->input->post('iddepartemen')."' ORDER BY proses",'up');
        $data['idkelompok_opt'] = $this->dbx->opt("SELECT replid,kelompok as nama FROM kelompokcalonsiswa WHERE aktif=1 AND idproses='".$this->input->post('idproses')."' ORDER BY kelompok",'up');
		$data['jeniscari_opt'] = array("ok.namacalon"=>"Nama CPD","ok.namaortu"=>"Nama Orangtua/Wali CPD","ok.emailortu"=>"Email Orangtua");
		$data['status_opt'] = $this->dbx->opt("SELECT node as replid,status as nama FROM hrm_status WHERE NODE IN (1,3,4,'CC') ORDER BY status",'up');
		$companyrow=$this->session->userdata('idcompany');
		$sqlcompany="SELECT replid,nama as nama
								FROM hrm_company
								WHERE replid IN (".$companyrow.") AND aktif=1
								ORDER BY nama";
		$data['idcompany_opt'] = $this->dbx->opt($sqlcompany,'up');
		return $data;
	}

     //TAMBAH
    public function tambah_db($id='',$data) {
        $sql="SELECT ok.*,n.negara as negaratext,p.propinsi as propinsitext,k.kota as kotatext,kec.kecamatan as kecamatantext
												,t.tingkat as tingkatasaltext,t2.tingkat as tingkattext
												,j.jurusan as jurusanasaltext
												,j2.jurusan as jurusantext
												,kc.kelompok as kelompokcalontext
												,c.nama as unitbisnistext
												,v.reff_kronologis_sub as votingtext
												, CONCAT(TIMESTAMPDIFF( YEAR, ok.tanggallahir, now() ),' Tahun, ',TIMESTAMPDIFF( MONTH, ok.tanggallahir, now() ) % 12,' Bulan') as umur
												,ta.tahunajaran as tahunajarantext,pps.proses as prosestext,kcs.kelompok as kelompoktext,ks.kondisi as kondisisiswatext,r.region as regiontext
												,s.status as statustext,cs.nopendaftaran, cs.tanggal_daftar,cs.verifikasi, CURRENT_DATE() as hariini
										FROM online_kronologis ok
										LEFT JOIN negara n ON n.replid=ok.negara
										LEFT JOIN propinsi p ON p.replid=ok.propinsi
										LEFT JOIN kota k ON k.replid=ok.kota
										LEFT JOIN kecamatan kec ON kec.replid=ok.kecamatan
										LEFT JOIN tingkat t ON t.replid=ok.idtingkatasal
										LEFT JOIN tingkat t2 ON t2.replid=ok.idtingkat
										LEFT JOIN jurusan j ON j.replid=ok.idjurusanasal
										LEFT JOIN jurusan j2 ON j2.replid=ok.idjurusan
										LEFT JOIN kelompoksiswa kc ON kc.replid=ok.idkelompokcalon
										LEFT JOIN hrm_company c ON c.replid=ok.idunitbisnis
										LEFT JOIN online_kronologis_reff v ON v.replid=ok.voting AND v.head='voting'
										LEFT JOIN tahunajaran ta ON ta.replid=ok.idtahunajaran
										LEFT JOIN prosespenerimaansiswa pps ON pps.replid=ok.idproses
										LEFT JOIN kelompokcalonsiswa kcs ON kcs.replid=ok.idkelompok
										LEFT JOIN kondisisiswa ks ON ks.replid=ok.idkondisi
										LEFT JOIN regional r ON r.replid=ok.idregion
										LEFT JOIN hrm_status s ON s.node=ok.status
										LEFT JOIN calonsiswa cs ON cs.replid=ok.idcalon
            WHERE ok.replid='".$id."'";
				//echo $sql;die;
        $data['isi'] = $this->dbx->rows($sql);

        if ($data['isi']== NULL ) {
        	unset($data['isi']);
        	$sql="SELECT ".$this->dbx->tablecolumn('online_kronologis').",CURRENT_DATE as tgl_masuk,NULL as departemen,1 as aktif,YEAR(CURRENT_DATE()) as tahunmasuk,NULL as statustext,NULL as nopendaftaran,NULL as tanggal_daftar";
        	$data['isi']=$this->dbx->rows($sql);
        }
		$data['idtahunajaran_opt'] = $this->dbx->opt("SELECT replid,tahunajaran as nama FROM tahunajaran WHERE idcompany='".$data['isi']->idunitbisnis."' AND departemen='".$data['isi']->jenjang."' AND aktifdaftar=1 ORDER BY tahunajaran",'up');
		$data['jenjang_opt'] = $this->dbx->opt("SELECT departemen as replid, departemen as nama FROM departemen WHERE aktif=1 AND replid IN (".$this->session->userdata('dept').") ORDER BY urutan",'up');
		$data['idproses_opt'] = $this->dbx->opt("SELECT replid,CONCAT('[',departemen,'] ',proses)  as nama FROM prosespenerimaansiswa WHERE departemen='".$data['isi']->jenjang."' ORDER BY info1",'up');
		$data['idkelompok_opt'] = $this->dbx->opt("SELECT replid,kelompok as nama FROM kelompokcalonsiswa WHERE aktif=1 AND idproses='".$data['isi']->idproses."' ORDER BY kelompok",'up');
		$data['tingkat_opt'] = $this->dbx->opt("SELECT replid,tingkat as nama  FROM tingkat WHERE aktif=1 AND departemen='".$data['isi']->jenjang."' ORDER BY CAST(tingkat AS SIGNED)",'up');
		$data['idregion_opt'] = $this->dbx->opt("SELECT replid,region as nama FROM regional ORDER BY region",'up');
		$data['idkondisi_opt'] = $this->dbx->opt("SELECT replid,kondisi as nama FROM kondisisiswa WHERE aktif=1 ORDER BY kondisi",'up');
		$data['jurusan_opt'] = $this->dbx->opt("SELECT replid,jurusan as nama FROM jurusan ORDER BY jurusan",'up');
		

		$sqlsyarat="SELECT s.replid, s.syarat as nama
					FROM syarat s
					WHERE	s.aktif=1 AND s.allcpd<>1
					ORDER BY s.urutan,s.syarat";
		$data['iddokumentipe_opt'] = $this->dbx->data($sqlsyarat,'up');
		$data['iddokumenttipe']=$this->dbx->data("SELECT replid as isi FROM psb_calonsiswa_attachment WHERE idcalonsiswa='".$data['isi']->idcalon."'");

		$data['alasan_opt']=$this->dbx->rowscsv("SELECT okr.reff_kronologis_sub as var FROM online_kronologis_reff okr
																						INNER JOIN online_kronologis_alasan oka ON oka.idalasan=okr.replid
																						WHERE okr.head='Alasan'
																									AND oka.idkronologis='".$data['isi']->replid."'
																						ORDER BY reff_kronologis,reff_kronologis_sub");
		$sqlmedia="SELECT CONCAT('[',okr.reff_kronologis,'] ',okr.reff_kronologis_sub) as var FROM online_kronologis_reff okr
																						INNER JOIN online_kronologis_media okm ON okm.idmedia=okr.replid
																						WHERE okr.head='Media'
																									AND okm.idkronologis='".$data['isi']->replid."'
																						ORDER BY reff_kronologis,reff_kronologis_sub";
		$data['media_opt']=$this->dbx->rowscsv($sqlmedia);
		return $data;
  }

	public function nopendaftaran($idunitbisnis,$idproses,$tanggaldaftar){
	 $sqlcompany="SELECT kodecabang as isi FROM hrm_company WHERE replid='".$idunitbisnis."'";
	 $company=$this->dbx->singlerow($sqlcompany);

	 $sql="SELECT pps.kodeawalan,pps.periode
	 			 FROM prosespenerimaansiswa pps
				 WHERE pps.replid='".$idproses."'";
	 $querykcs=$this->db->query($sql);
 	 $isikcs=$querykcs->row();

	 $nopendaftaran="";$kodeawalan="";

	 $year=substr($tanggaldaftar,-4);
	 $month=substr($tanggaldaftar,2,2);
	 $kodeawalan=$isikcs->kodeawalan.$company;
	 $nopendaftaran= $kodeawalan.$isikcs->periode.$year.$month;

	 $sql = "SELECT lpad(right(nopendaftaran,4)+1,4,'0') as nourut
	 				 FROM calonsiswa
	 				 WHERE tahunmasuk='".$year."' AND LEFT(nopendaftaran,".strlen($kodeawalan).")='".$kodeawalan."' ORDER BY RIGHT(nopendaftaran,4) desc limit 1";
	 //echo $sql;die;
	 $query=$this->db->query($sql);
	 $isi=$query->row();
	 if ($query->num_rows() > 0) {
		 $nopendaftaran=$nopendaftaran.$isi->nourut;
	 }else{
		 $nopendaftaran=$nopendaftaran."0001";
	 }
	 return $nopendaftaran;
	}
}

?>
