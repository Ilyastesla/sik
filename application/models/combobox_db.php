<?php

Class combobox_db extends CI_Model
{

function __construct(){
	parent::__construct();
		$this->load->library('dbx');
		

	}

	function idpropinsi($variabel){
		$idprosestext="<option selected='selected' value=''>Pilih...</pilih>";
		$idprosesdata= $this->dbx->data("SELECT replid,propinsi as nama FROM propinsi WHERE id_negara='".$variabel."' ORDER BY propinsi");
		foreach((array)$idprosesdata as $data) {
			$idprosestext.= "<option value='".$data->replid."'>".strtoupper($data->nama)."</option>";
		}
		return $idprosestext;
	}

	function idkota($idnegara,$idpropinsi){
		$idprosestext="<option selected='selected' value=''>Pilih...</pilih>";
		$idprosesdata= $this->dbx->data("SELECT replid,kota as nama FROM kota WHERE id_propinsi='".$idpropinsi."' ORDER BY kota");
		foreach((array)$idprosesdata as $data) {
			$idprosestext.= "<option value='".$data->replid."'>".strtoupper($data->nama)."</option>";
		}
		//echo $idpropinsi;
		if (($idnegara<>1) AND ($idpropinsi<>0)){
			$idprosestext.="<option value='lainlain'>Lain Lain</pilih>";
		}
		return $idprosestext;
	}

	function idkecamatan($variabel){
		$idprosestext="<option selected='selected' value=''>Pilih...</pilih>";
		$idprosesdata= $this->dbx->data("SELECT replid,kecamatan as nama FROM kecamatan WHERE id_kota='".$variabel."' ORDER BY kecamatan");
		foreach((array)$idprosesdata as $data) {
			$idprosestext.= "<option value='".$data->replid."'>".strtoupper($data->nama)."</option>";
		}
		return $idprosestext;
	}

	function idproses($variabel){
		$idprosestext="<option selected='selected' value=''>Pilih...</pilih>";
		$idprosesdata= $this->dbx->data("SELECT replid, CONCAT('[',departemen,'] ',proses)  as nama  FROM prosespenerimaansiswa WHERE departemen='".$variabel."' ORDER BY proses");
		foreach((array)$idprosesdata as $data) {
			$idprosestext.= "<option value='".$data->replid."'>".$data->nama."</option>";
		}
		return $idprosestext;
	}

	function idkelompok($variabel){
		$idprosestext="<option selected='selected' value=''>Pilih...</pilih>";
		$idprosesdata= $this->dbx->data("SELECT replid, kelompok as nama FROM kelompokcalonsiswa WHERE idproses='".$variabel."' AND aktif=1 ORDER BY kelompok");
		foreach((array)$idprosesdata as $data) {
			$idprosestext.= "<option value='".$data->replid."'>".$data->nama."</option>";
		}
		return $idprosestext;
	}

	function kelompok_siswa($variabel){
		$kelompok_siswatext="<option selected='selected' value=''>Pilih...</pilih>";
		$kelompok_siswadata= $this->dbx->data("SELECT replid, CONCAT('[',departemen,'] ',kelompok) as nama FROM kelompoksiswa WHERE departemen='".$variabel."' AND aktif=1 ORDER BY kelompok");
		foreach((array)$kelompok_siswadata as $data) {
			$kelompok_siswatext.= "<option value='".$data->replid."'>".$data->nama."</option>";
		}
		return $kelompok_siswatext;
	}

	function idtahunajaran($variabel){

		$idtahunajarantext="<option selected='selected' value=''>Pilih...</pilih>";
		$idtahunajarandata= $this->dbx->data("SELECT replid,CONCAT('[',departemen,'] ',tahunajaran) as nama FROM tahunajaran WHERE idcompany='".$this->session->userdata('idcompany')."' AND departemen='".$variabel."' ORDER BY aktif DESC ,nama DESC");
		foreach((array)$idtahunajarandata as $data) {
			$idtahunajarantext.= "<option value='".$data->replid."'>".$data->nama."</option>";
		}
		return $idtahunajarantext;
	}

	function idtahunajaranaktif($variabel){

		$idtahunajarantext="<option selected='selected' value=''>Pilih...</pilih>";
		$idtahunajarandata= $this->dbx->data("SELECT replid,CONCAT('[',departemen,'] ',tahunajaran) as nama FROM tahunajaran WHERE idcompany='".$this->session->userdata('idcompany')."' AND departemen='".$variabel."' AND aktif=1 ORDER BY aktif DESC ,nama DESC");
		foreach((array)$idtahunajarandata as $data) {
			$idtahunajarantext.= "<option value='".$data->replid."'>".$data->nama."</option>";
		}
		return $idtahunajarantext;
	}

	function idtahunajaranall($variabel,$idcompany){
		$idsiswatext="<option selected='selected' value=''>Pilih...</pilih>";
		$sql="SELECT replid,CONCAT('[',departemen,'] ',tahunajaran) as nama
					FROM tahunajaran
					WHERE idcompany='".$idcompany."' AND  departemen='".$variabel."' 
					ORDER BY aktif DESC ,nama DESC ";
		$idsiswadata= $this->dbx->data($sql);
		foreach((array)$idsiswadata as $data) {
			$idsiswatext.= "<option value='".$data->replid."'>".$data->nama."</option>";
		}
		return $idsiswatext;
	}

	function idtahunajarancompany($variabel,$idcompany){

		$idtahunajarantext="<option selected='selected' value=''>Pilih...</pilih>";
		$sql="SELECT replid,CONCAT('[',departemen,'] ',tahunajaran) as nama FROM tahunajaran WHERE idcompany='".$idcompany."' AND departemen='".$variabel."' AND aktif=1 ORDER BY aktif DESC ,nama DESC";
		//echo $sql;
		$idtahunajarandata= $this->dbx->data($sql);
		foreach((array)$idtahunajarandata as $data) {
			$idtahunajarantext.= "<option value='".$data->replid."'>".$data->nama."</option>";
		}
		return $idtahunajarantext;
	}

	function idtingkat($variabel){

		$idtingkattext="<option selected='selected' value=''>Pilih...</pilih>";
		$idtingkatdata= $this->dbx->data("SELECT replid,CONCAT('[',departemen,'] ',tingkat)  as nama FROM tingkat WHERE departemen='".$variabel."' ORDER BY CAST(tingkat AS SIGNED) ASC");
		foreach((array)$idtingkatdata as $data) {
			$idtingkattext.= "<option value='".$data->replid."'>".$data->nama."</option>";
		}
		return $idtingkattext;
	}

	function idjurusan($variabel){
		$idprosestext="<option selected='selected' value=''>Pilih...</pilih>";
		$sqljur="SELECT  j.replid,j.jurusan as nama
								FROM jurusan j
								WHERE j.departemen='".$variabel."'
								ORDER BY j.jurusan ";
		//echo $sqljur;
		$idprosesdata= $this->dbx->data($sqljur);
		foreach((array)$idprosesdata as $data) {
			$idprosestext.= "<option value='".$data->replid."'>".strtoupper($data->nama)."</option>";
		}
		return $idprosestext;
	}

	function idkelas($variabel){

		$idkelastext="<option selected='selected' value=''>Pilih...</pilih>";
		$sql="SELECT replid,kelas as nama FROM kelas
														WHERE aktif=1 AND
														idtahunajaran='".$variabel."'
														ORDER BY idtingkat,kelas ";

		//AND replid IN (".$this->session->userdata('kelas').")

		$idkelasdata= $this->dbx->data($sql);
		foreach((array)$idkelasdata as $data) {
			$idkelastext.= "<option value='".$data->replid."'>".$data->nama."</option>";
		}
		return $idkelastext;
	}

	function idprosestipe($variabel,$idcompany){

		$idprosestipetext="<option selected='selected' value=''>Pilih...</pilih>";
		$sql="SELECT pt.replid,CONCAT('[',pt.iddepartemen,'] ',pt.prosestipe,' ',pt.keterangan, ' (',IF(pt.aktif=1,'A','T'),')') as nama
									FROM ns_prosestipe pt
									INNER JOIN ns_reff_company rc ON rc.idvariabel=pt.replid
									WHERE rc.tipe='ns_prosestipe' AND rc.idcompany='".$idcompany."' AND pt.aktif=1 AND pt.iddepartemen IN (SELECT departemen FROM tahunajaran  WHERE replid='".$variabel."')
									ORDER BY pt.aktif DESC,nama ASC ";
		$idprosestipedata= $this->dbx->data($sql);
		foreach((array)$idprosestipedata as $data) {
			$idprosestipetext.= "<option value='".$data->replid."'>".$data->nama."</option>";
		}
		return $idprosestipetext;
	}

	function idmatpel($variabel,$idcompany){

		$idmatpeltext="<option selected='selected' value=''>Pilih...</pilih>";
		//$sql="SELECT replid,CONCAT('[',iddepartemen,'] ',matpel) as nama
		$sql="SELECT mp.replid,CONCAT(mp.matpel,' ',mp.keterangan,' [',mpk.matpelkelompok,' ',mpk.keterangan,']') as nama
												FROM ns_matpel mp
												INNER JOIN ns_reff_company rc ON rc.idvariabel=mp.replid
												LEFT JOIN ns_matpelkelompok mpk ON mpk.replid=mp.idmatpelkelompokraport13
												WHERE rc.tipe='ns_matpel' AND rc.idcompany='".$idcompany."' AND mp.aktif=1 AND (mp.replid IN (
													SELECT idmatpel FROM ns_matpeltingkat mt
													INNER JOIN kelas k ON mt.idtingkat=k.idtingkat AND k.jurusan=mt.idjurusan
													WHERE k.replid='".$variabel."' AND k.aktif=1
												))
												ORDER BY mp.iddepartemen, mp.matpel";
		//AND replid IN (".$this->session->userdata('matpel').")

		$idmatpeldata= $this->dbx->data($sql);
		foreach((array)$idmatpeldata as $data) {
			$idmatpeltext.= "<option value='".$data->replid."'>".$data->nama."</option>";
		}
		return $idmatpeltext;
	}

	function idrapottipediv($variabel,$idcompany){
		$idrapottipetext="";
		$sql="SELECT rt.replid,CONCAT('[',rt.iddepartemen,'] ',rt.rapottipe,' ',rt.keterangan, ' (',IF(rt.aktif=1,'A','T'),')') as nama,0 as checked
					FROM ns_rapottipe rt
					INNER JOIN ns_reff_company rc ON rc.idvariabel=rt.replid
					WHERE rc.tipe='ns_rapottipe' AND rc.idcompany='".$idcompany."'
					AND rt.aktif=1 AND rt.iddepartemen IN (SELECT departemen FROM tahunajaran  WHERE replid='".$variabel."') ORDER BY rt.iddepartemen,rt.rapottipe";
		//echo $sql;
		$idrapottipedata= $this->dbx->data($sql);
		foreach((array)$idrapottipedata as $data) {
			$idrapottipetext.= "<input type='checkbox' name='idrapottipe[]' value='".$data->replid."' id='idrapottipe'>&nbsp".$data->nama."<br/>";
		}
		return $idrapottipetext;
	}

	function idrapottipe($variabel){
		$idrapottipetext="<option selected='selected' value=''>Pilih...</pilih>";
		$sql="SELECT rt.replid,CONCAT('[',rt.iddepartemen,'] ',rt.rapottipe,' ',rt.keterangan, ' (',IF(rt.aktif=1,'A','T'),')') as nama,0 as checked
					FROM ns_rapottipe rt
					WHERE k13<>1 AND aktif=1 AND iddepartemen IN (SELECT departemen FROM tahunajaran  WHERE replid='".$variabel."')
								AND rt.replid IN (SELECT idvariabel FROM ns_reff_company WHERE idcompany='".$this->session->userdata('idcompany')."' AND tipe='ns_rapottipe' )
					ORDER BY rt.iddepartemen,rt.rapottipe";
		$idrapottipedata= $this->dbx->data($sql);
		foreach((array)$idrapottipedata as $data) {
			$idrapottipetext.= "<option value='".$data->replid."'>".$data->nama."</option>";
		}
		return $idrapottipetext;
	}

	function idrapottipe13($variabel,$idcompany){
		$idrapottipe13text="<option selected='selected' value=''>Pilih...</pilih>";
		$sql="SELECT rt.replid,CONCAT('[',rt.iddepartemen,'] ',rt.rapottipe,' ',rt.keterangan, ' (',IF(rt.aktif=1,'A','T'),')') as nama,0 as checked
					FROM ns_rapottipe rt
					WHERE k13=1 AND aktif=1
					AND iddepartemen='".$variabel."'
					AND replid IN (SELECT idvariabel FROM ns_reff_company WHERE idcompany='".$idcompany."' AND tipe='ns_rapottipe' )
					ORDER BY rt.iddepartemen,rt.rapottipe";
		$idrapottipe13data= $this->dbx->data($sql);
		foreach((array)$idrapottipe13data as $data) {
			$idrapottipe13text.= "<option value='".$data->replid."'>".$data->nama."</option>";
		}
		return $idrapottipe13text;
	}

	function idsiswa($variabel){
		$idsiswatext="<option selected='selected' value=''>Pilih...</pilih>";
		$sql="SELECT replid,CONCAT(nama,' [ ',nis,' ]') as nama FROM siswa WHERE  (idkelas='".$variabel."' OR kelasstatus='".$variabel."' ) AND aktif=1 ORDER bY nama ";
		//echo $sql;
		$idsiswadata= $this->dbx->data($sql);
		foreach((array)$idsiswadata as $data) {
			$idsiswatext.= "<option value='".$data->replid."'>".$data->nama."</option>";
		}
		return $idsiswatext;
	}
	function idsiswacompany($idcompany,$iddepartemen){
		$idsiswatext="<option selected='selected' value=''>Pilih...</pilih>";
		$sql="SELECT s.replid,CONCAT(s.nama,' [ ',nis,' ]') as nama FROM siswa s
				INNER JOIN kelas k ON k.replid=s.idkelas
				INNER JOIN tahunajaran ta ON ta.replid=k.idtahunajaran
				WHERE ta.idcompany='".$idcompany."' AND ta.departemen='".$iddepartemen."' 
						AND s.aktif=1    
				ORDER BY s.nama";
		//echo $sql;
		$idsiswadata= $this->dbx->data($sql);
		foreach((array)$idsiswadata as $data) {
			$idsiswatext.= "<option value='".$data->replid."'>".strtoupper($data->nama)."</option>";
		}
		return $idsiswatext;
	}

	

	function iddepartemen($variabel){
		$idprosestext="<option selected='selected' value=''>Pilih...</pilih>";
		$idprosesdata= $this->dbx->data("SELECT replid,departemen as nama FROM hrm_departemen WHERE idcompany='".$variabel."' ORDER BY departemen");
		foreach((array)$idprosesdata as $data) {
			$idprosestext.= "<option value='".$data->replid."'>".strtoupper($data->nama)."</option>";
		}
		return $idprosestext;
	}

	function idpredikatspiritual($variabel){
		$idprosestext="<option selected='selected' value=''>Pilih...</pilih>";
		$idprosesdata= $this->dbx->data("SELECT replid,predikat as nama FROM ns_predikat WHERE predikattipe='4' AND iddepartemen=".$variabel."' ORDER BY nama");
		foreach((array)$idprosesdata as $data) {
			$idprosestext.= "<option value='".$data->replid."'>".strtoupper($data->nama)."</option>";
		}
		return $idprosestext;
	}

	function idpredikatsosial($variabel){
		$idprosestext="<option selected='selected' value=''>Pilih...</pilih>";
		$idprosesdata= $this->dbx->data("SELECT replid,predikat as nama FROM ns_predikat WHERE predikattipe='5' AND iddepartemen='".$variabel."' ORDER BY nama");
		foreach((array)$idprosesdata as $data) {
			$idprosestext.= "<option value='".$data->replid."'>".strtoupper($data->nama)."</option>";
		}
		return $idprosestext;
	}

	function notifkronologisdb(){
		$notifkronologistext="";
		$companyrow=$this->session->userdata('idcompany');
		$sqlcompany="SELECT replid
							FROM hrm_company
							WHERE replid IN (".$companyrow.") AND aktif=1
							ORDER BY nama";

		$sqlnotif="SELECT replid,namacalon 
					FROM online_kronologis 
					WHERE status=1 AND idunitbisnis IN (".$sqlcompany.") 
							AND YEAR(created_date)=YEAR(CURRENT_DATE()) ORDER BY created_date ASC";
		$notifkronologisdata= $this->dbx->data($sqlnotif);
		foreach((array)$notifkronologisdata as $data) {
			$notifkronologistext.="<li><a href='".site_url('online_kronologis/viewkronologis/'.$data->replid)."'><i class='fa fa-user'></i>".$data->namacalon."</a></li>";
		}
		return $notifkronologistext;
	}

	function notifkronologiscountdb(){
		$companyrow=$this->session->userdata('idcompany');
		$sqlcompany="SELECT replid
							FROM hrm_company
							WHERE replid IN (".$companyrow.") AND aktif=1
							ORDER BY nama";
		$count= $this->dbx->singlerow("SELECT COUNT(replid) as isi FROM online_kronologis WHERE status=1 AND idunitbisnis IN (".$sqlcompany.") AND YEAR(created_date)=YEAR(CURRENT_DATE()) ORDER BY created_date ASC");
		return $count;
	}

	function idmatpelkelompok($variabel){
		$idprosestext="<option selected='selected' value=''>Pilih...</pilih>";
		$sqlidmatpelkelompok="SELECT replid,CONCAT('[',iddepartemen,']',' ',matpelkelompok,' ',keterangan) as nama FROM ns_matpelkelompok WHERE aktif=1 AND iddepartemen='".$variabel."' ORDER BY nama";
		$idprosesdata= $this->dbx->data($sqlidmatpelkelompok);
		foreach((array)$idprosesdata as $data) {
			$idprosestext.= "<option value='".$data->replid."'>".strtoupper($data->nama)."</option>";
		}
		return $idprosestext;
	}
	

	//calonsiswa
	function iddepartemenmutasi($variabel){
		$jenjangtext="<option selected='selected' value=''>Pilih...</pilih>";
		$sqlkelompok="SELECT DISTINCT ta.departemen as replid,ta.departemen as nama
									FROM kelas k
									INNER JOIN tahunajaran ta ON ta.replid=k.idtahunajaran
									INNER JOIN departemen d ON d.departemen=ta.departemen
									WHERE k.aktif=1 AND ta.aktifdaftar=1 AND ta.idcompany='".$variabel."'
									ORDER BY d.urutan ";
		$jenjangdata= $this->dbx->data($sqlkelompok);
		foreach((array)$jenjangdata as $data) {
			$jenjangtext.= "<option value='".$data->replid."'>".strtoupper($data->nama)."</option>";
		}
		return $jenjangtext;
	}

	function idtahunajaranmutasi($variabel,$idunitbisnis){
		$sql="SELECT replid,CONCAT('[',departemen,'] ',tahunajaran) as nama FROM tahunajaran WHERE  aktifdaftar=1 AND departemen='".$variabel."' AND idcompany='".$idunitbisnis."' ORDER BY aktif DESC ,nama DESC";
		$idtahunajarantext="<option selected='selected' value=''>Pilih...</pilih>";
		$idtahunajarandata= $this->dbx->data($sql);
		foreach((array)$idtahunajarandata as $data) {
			$idtahunajarantext.= "<option value='".$data->replid."'>".$data->nama."</option>";
		}
		return $idtahunajarantext;
	}

	function idtingkatmutasi($variabel){
		$idtingkattext="<option selected='selected' value=''>Pilih...</pilih>";
		$sql="SELECT DISTINCT t.replid,t.tingkat as nama
								FROM tingkat t
								INNER JOIN kelas k ON k.idtingkat=t.replid
								WHERE t.aktif=1 AND k.aktif=1 AND k.idtahunajaran='".$variabel."'
								ORDER BY CAST(t.tingkat AS SIGNED)";
		//echo $sql;
		$idtingkatdata= $this->dbx->data($sql);
		foreach((array)$idtingkatdata as $data) {
			$idtingkattext.= "<option value='".$data->replid."'>".$data->nama."</option>";
		}
		return $idtingkattext;
	}

	function idjurusanmutasi($variabel,$idtahunajaran){
		$idprosestext="<option selected='selected' value=''>Pilih...</pilih>";
		$sqljur="SELECT DISTINCT j.replid,j.jurusan as nama
								FROM jurusan j
								INNER JOIN kelas k ON j.replid=k.jurusan
								INNER JOIN tahunajaran ta ON ta.replid=k.idtahunajaran
								WHERE k.aktif=1 AND k.idtingkat='".$variabel."' AND k.idtahunajaran='".$idtahunajaran."'
								ORDER BY j.jurusan ";
		//echo $sqljur;
		$idprosesdata= $this->dbx->data($sqljur);
		foreach((array)$idprosesdata as $data) {
			$idprosestext.= "<option value='".$data->replid."'>".strtoupper($data->nama)."</option>";
		}
		return $idprosestext;
	}

	function idkelompokmutasi($variabel,$idproses="",$idtahunajaran=""){
		$idprosestext="<option selected='selected' value=''>Pilih...</pilih>";
		$sqlkelompok="SELECT DISTINCT kcs.replid,kcs.kelompok AS nama
									FROM
										kelas k
									INNER JOIN kelompoksiswa ks ON ks.replid=k.kelompok_siswa
									INNER JOIN kelompokcalonsiswa kcs ON kcs.kelompok_siswa=ks.replid
									WHERE k.aktif=1 AND kcs.idproses='".$idproses."' AND k.idtingkat='".$variabel."' AND k.idtahunajaran='".$idtahunajaran."' ORDER BY ks.kelompok ";
		//echo $sqlkelompok;
		$idprosesdata= $this->dbx->data($sqlkelompok);
		foreach((array)$idprosesdata as $data) {
			$idprosestext.= "<option value='".$data->replid."'>".$data->nama."</option>";
		}
		return $idprosestext;
	}

	function idlayanan($variabel){
		$sql="SELECT replid,layanan as nama FROM lyn_layanan WHERE idjenislayanan='".$variabel."' AND aktif=1 ORDER BY layanan";
		$text="<option selected='selected' value=''>Pilih...</pilih>";
		$idlayanandata= $this->dbx->data($sql);
		foreach((array)$idlayanandata as $data) {
			$text.= "<option value='".$data->replid."'>".$data->nama."</option>";
		}
		return $text;
	}

	/*
	function idpegawai($variabel){
		$cari="";
		if($variabel=="11"){
				$cari .= " AND LEFT(nip,2) IN (11,22,77)";
		}else if($variabel=="12"){
				$cari .= " AND LEFT(nip,2) IN (12,23)";
		}else{
			$cari .= " AND LEFT(nip,2)='".$variabel."' ";
		}
		$sqlproses="SELECT CONCAT(replid,'|',nip) as replid,CONCAT(nama,' [',nip,']') as nama
											FROM pegawai
											WHERE aktif=1
											AND replid NOT IN (SELECT idpegawai FROM login)
											".$cari."
											ORDER BY nama";
		//echo $sqlproses;
		$idprosestext="<option selected='selected' value=''>Pilih...</pilih>";
		$idprosesdata= $this->dbx->data($sqlproses);
		foreach((array)$idprosesdata as $data) {
			$idprosestext.= "<option value='".$data->replid."'>".strtoupper($data->nama)."</option>";
		}
		return $idprosestext;
	}
	*/

	function idpegawai($variabel){
		$sql="SELECT replid,CONCAT(nama,' [',nip,']') as nama FROM pegawai WHERE aktif=1 AND idcompany='".$variabel."' ORDER BY nama";
		$text="<option selected='selected' value=''>Pilih...</pilih>";
		$idpegawaidata= $this->dbx->data($sql);
		foreach((array)$idpegawaidata as $data) {
			$text.= "<option value='".$data->replid."'>".$data->nama."</option>";
		}
		return $text;
	}

	function idpegawaiuser($variabel){
		$sql="SELECT CONCAT(replid,'|',nip) as replid,CONCAT(nama,' [',nip,']') as nama 
				FROM pegawai 
				WHERE aktif=1 AND idcompany='".$variabel."' AND replid NOT IN (SELECT idpegawai FROM login) ORDER BY nama";
		$text="<option selected='selected' value=''>Pilih...</pilih>";
		$idpegawaidata= $this->dbx->data($sql);
		foreach((array)$idpegawaidata as $data) {
			$text.= "<option value='".$data->replid."'>".$data->nama."</option>";
		}
		return $text;
	}

	function idpermintaan_barang($variabel,$idpermintaan_barang){
		$sql="SELECT replid,CONCAT(tanggalpengajuan,' | ', kode_transaksi) as nama
				FROM inventory_permintaan_barang
				WHERE idcompany='".$variabel."' AND (replid='".$idpermintaan_barang."' OR status IN (2,'OP')) ORDER BY nama";
		$text="<option selected='selected' value=''>Pilih...</pilih>";
		$idpermintaan_barangdata= $this->dbx->data($sql);
		foreach((array)$idpermintaan_barangdata as $data) {
			$text.= "<option value='".$data->replid."'>".$data->nama."</option>";
		}
		return $text;
	}
}
