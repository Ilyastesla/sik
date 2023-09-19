<?php $CI =& get_instance();?>
<html>
<head>
<title><?php echo $form.' ['.$form_small. ']' ?></title>
<link rel="shortcut icon" href="<?php echo base_url(); ?>images/appicon.png" type="image/x-icon">
<link href="<?php echo base_url(); ?>css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<script src="<?php echo base_url(); ?>js/jquery2.min.js"></script>
<script src="<?php echo base_url(); ?>js/bootstrap.min.js" type="text/javascript"></script>

<link href="<?php echo base_url(); ?>css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<script src="<?php echo base_url(); ?>js/morris/morris.min.js" type="text/javascript"></script>
<link href="<?php echo base_url(); ?>js/morris/morris.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>css/AdminLTE.css" rel="stylesheet" type="text/css" />

<style>
	table{
		font-size: 9pt !important;
	}
	th,td {
		padding:3px !important;
	}
</style>

<script language="javascript" src="../script/tables.js"></script>
<script language="javascript" src="../script/tools.js"></script>
</head>

<body>
<center>
	<br/><img src="<?php echo base_url()."images/".$isi->logotext ?>" height="70px"><hr>
<table width='85%' border=0>
<tr height="50">
	<th colspan="3"><div align="center"><h3>DATA PESERTA DIDIK <?php echo strtoupper($isi->companytext)?></h3></div><br /></th>
</tr>
<tr>
   	<th width="200" >Nama Lengkap</th>
    <th>:&nbsp;<?php echo strtoupper($isi->nama) ?>
	</th>
		<td rowspan="11" align="right" valign='top'>&nbsp;
        <!--
        <img src="../library/gambar.php?replid=<?php echo $isi->replid ?>&table=siswa" />
        -->
				<img src="<?php echo base_url().'uploads/fotosiswa/'.$isi->fotosiswa; ?>" width='200px'/>
    </td>
</tr>
<tr height="20">
	<th>No. Pendaftaran</th>
	<th>
		:&nbsp;<?php echo "<a href=javascript:void(window.open('".site_url('general/datacalonsiswa/'.$isi->replidcalon)."'))>".$isi->nopendaftaran."</a>";?>
	</th>
</tr>
<tr>
	<th>NIS Terakhir/Aktif</th>
    <th>:&nbsp;<?php echo $isi->nis ?></th>
</tr>
<tr>
  <th>N I S N</th>
  <th>:&nbsp;<?php echo $isi->nisn ?></th>
  </tr>
	<tr>
		<th>Nomor Peserta</th>
	    <th>:&nbsp;<?php echo $isi->nomorpeserta ?></th>
	</tr>
	<tr>
	    <th align="left">
	      Jenjang Terakhir/Aktif</th>
	    <th align="left">:&nbsp;<?php echo $isi->departemen ?>
	    </th>
	</tr>
	<tr>
	    <th align="left">Tahun Pelajaran Terakhir/Aktif</th>
	    <th align="left">:&nbsp;<?php echo $isi->tahunajaran ?>
	    </th>
		<!--
		<th width="250" align="right" valign="bottom">&nbsp;

	      <input type="hidden" name="replid" id="replid" value="<?php echo $isi->replid ?>" />
	      <a href="#" onclick="cetak('<?php echo $isi->replid ?>')"><img src="../images/ico/print.png" border="0"/>&nbsp;Cetak</a>&nbsp;&nbsp;
	      <a href="#" onclick="window.close();"><img src="../images/ico/exit.png" width="16" height="16" border="0" />&nbsp;Tutup</a></div>
	    </th>
			-->
	</tr>
<tr>
    <th align="left">Kelas Terakhir/Aktif</th>
    <th align="left">:&nbsp;<?php echo $isi->tingkattext." - ".$isi->kelastext ?> ( <?php echo $isi->region ?> )
</tr>
<!--
<tr>
    <th align="left">Angkatan</th>
    <th align="left">:&nbsp;<?php echo $isi->angkatan  ?>

</tr>
-->
<tr>
    <th align="left">Status Program</th>
    <th align="left">:&nbsp;<?php echo $isi->kondisi  ?>

</tr>
<?php 
//if($isi->kelasstatus<>"") { 
?>
<tr>
    <th align="left">Kelas Status</th>
    <th align="left">:&nbsp;<?php echo $isi->kelasstatus  ?>

</tr>
<?php 
//}  
?>
<tr>
    <th align="left">Tanggal Masuk</th>
    <th align="left">:&nbsp;<?php echo $CI->p_c->tgl_indo($isi->tgl_masuk)  ?>

</tr>
<tr>
	<th>ABK</th>
	<th>:&nbsp;&nbsp;<?php echo $CI->p_c->cekaktif($isi->abk) ?></th>
</tr>
<tr>
	<th>Remedial Perilaku</th>
	<th>:&nbsp;&nbsp;<?php echo $CI->p_c->cekaktif($isi->remedialperilaku) ?></th>
</tr>
<tr>
	<th>Tutor Visit</th>
	<th>:&nbsp;&nbsp;<?php echo $CI->p_c->cekaktif($isi->keu_tutorvisit) ?></th>
</tr>
	<tr>
		<th>Aktif</th>
		<th>:&nbsp;<?php echo $CI->p_c->cekaktif($isi->aktif)?></th>
    </tr>
	<tr>
		<th align="left">Ditempatkan Oleh</th>
		<th>:
			<?php
			echo $CI->dbx->getpegawai($isi->created_by,0,1);
			echo " Pada ".$CI->p_c->tgl_indo($isi->created_date);
				
			?>
		</th>
	</tr>
	<tr>
		<th align="left">Diubah Oleh</th>
		<th>:
			<?php
			echo $CI->dbx->getpegawai($isi->modified_by,0,1);
			echo " Pada ".$CI->p_c->tgl_indo($isi->modified_date);
				
			?>
		</th>
	</tr>
</table>
<br /><br />
<!--
<font size="2" face="Verdana, Arial, Helvetica, sans-serif" style="background-color:#ffcc66">&nbsp;</font>&nbsp;<font size="2" face="Verdana, Arial, Helvetica, sans-serif" color="Gray">KETERANGAN</font>
<div style="border-bottom:1px dashed #666666; border-width:thinl; margin-bottom:5px; margin-top:3px;"></div>
<div id="tabs">
<ul>
<li><a href="#tabs-1">Data Lengkap Calon Peserta Didik</a></li>
<li><a href="#tabs-2">Persyaratan</a></li>
<li><a href="#tabs-8">Kronologis</a></li>
<li><a href="#tabs-3">Hasil Interview</a></li>
<li><a href="#tabs-4">Resume Assessment</a></li>
<li><a href="#tabs-5">Hasil Trial Class</a></li>
<li><a href="#tabs-6">Minat Bakat dan Prestasi</a></li>
<li><a href="#tabs-7">Lain Lain</a></li>
</ul>
-->
<div class="nav-tabs-custom" style="width:85% !important;">
								<ul class="nav nav-tabs">
										<li class="active"><a href="#tab_1" data-toggle="tab"><b>Data Diri</b></a></li>
										<li><a href="#tab_2" data-toggle="tab"><b>Riwayat Kelas</a></b></li>
										<li><a href="#tab_3" data-toggle="tab"><b>Riwayat Rapor</a></b></li>
										<li><a href="#tab_4" data-toggle="tab"><b>Riwayat Konseling</a></b></li>
										<li><a href="#tab_5" data-toggle="tab"><b>Riwayat Mutasi</a></b></li>
										<li><a href="#tab_6" data-toggle="tab"><b>Lain Lain</a></b></li>
								</ul>
								<div class="tab-content">
									<div class="tab-pane active" id="tab_1"><br/>
										<table border="0"  id="table" width="100%" cellpadding="0" style="border-collapse:collapse" cellspacing="0">
											<tr>
											<td valign="top" width="48%">
											<table border="1" cellpadding="0" style="border-collapse:collapse" cellspacing="0" width="100%" >
															<tr  height="30">
																<td colspan="2" align="left" bgcolor="#CCCCCC">&nbsp;KETERANGAN PRIBADI</td>
															</tr>
													<!--
															<tr height="20">
																<td rowspan="13" width="4%">&nbsp;</td>
																<td>NISN</td>
																<td colspan="2">
																	&nbsp;<?php echo $isi->nisn ?></td>
																</tr>
													-->
													<tr height="20">
											<td>NIK</td>
														<td>
															&nbsp;<?php echo strtoupper($isi->nik_siswa) ?></td>
													</tr>
															<tr height="20">
													<td>Nama Lengkap</td>
																<td>
																	&nbsp;<?php echo strtoupper($isi->nama) ?></td>
															</tr>
															<tr height="20">
																<td>Nama Panggilan</td>
																<td>
																	&nbsp;<?php echo strtolower($isi->panggilan) ?></td>
																</tr>
															<tr height="20">
																<td>Jenis Kelamin</td>
																<td>&nbsp;<?php if ($isi->kelamin=="l")
														echo "Laki-laki";
													if ($isi->kelamin=="p")
														echo "Perempuan";
												 ?></td>
																</tr>
															<tr height="20">
																<td>Tempat Lahir</td>
																<td>
																	&nbsp;<?php echo $isi->tmplahir ?></td>
																</tr>
															<tr height="20">
																<td>Tanggal Lahir</td>
																<td>
																	&nbsp;<?php echo $CI->p_c->tgl_indo($isi->tgllahir)  ?></td>
																</tr>
												<tr height="20">
																<td>Anak ke</td>
																<td>
																	&nbsp;<?php echo $isi->anakke ?></td>
																</tr>
														<tr height="20">
																<td>Status Anak</td>
																<td>
																	&nbsp;<?php echo $isi->statanak ?></td>
														</tr>
															<tr height="20">
																<td>Dari</td>
																<td>
																	&nbsp;<?php echo $isi->jsaudara ?> bersaudara</td>
																</tr>
															<tr height="20">
																<td >Agama</td>
																<td>
																	&nbsp;<?php echo $isi->agama ?></td>
																</tr>
												<tr height="20">
																<td >Suku</td>
																<td>
																	&nbsp;<?php echo $isi->suku ?></td>
																</tr>
												<tr height="20">
																<td>Kewarganegaraan</td>
																<td>
																	&nbsp;<?php echo $isi->warga ?>
														<?php if ($isi->warga=='WNA'){echo " [".$isi->negara_asal."]";} ?>
														</td>
																</tr>
												<tr height="20">
																<td>Bahasa sehari-hari</td>
																<td>
																	&nbsp;<?php echo $isi->bahasa ?></td>
																</tr>
															<tr>
																<td colspan="3">&nbsp;</td>
																</tr>
															<tr  height="30">
																<td colspan="2" align="left" bgcolor="#CCCCCC">&nbsp;KETERANGAN TEMPAT TINGGAL</td>
															</tr>
															<tr height="20">
																<td valign="top">Alamat</td>
																<td valign="top" align="left">
																	<?php
																	$provtext="";
																	if($isi->provinsitext<>"Luar Negeri"){
																		$provtext=" ".$isi->provinsitext;
																	} 
																	echo ucwords(strtoupper($isi->alamatsiswa))."&nbsp;". ucwords(strtoupper($isi->kota))." ".ucwords(strtoupper($isi->kodepossiswa)).ucwords(strtoupper($provtext))." ".ucwords(strtoupper($isi->negara))
																	?></td>
																</tr>
															<tr height="20">
																<td>Jarak Tempuh Ke Sekolah</td>
																<td>
																	&nbsp;<?php echo $isi->jaraktempuh ?> KM</td>
															</tr>
															<tr height="20">
																<td>Waktu Tempuh Ke Sekolah</td>
																<td>
																	&nbsp;<?php echo $isi->waktutempuh ?></td>
															</tr>
															<tr height="20">
																<td>Telepon</td>
																<td>
																	&nbsp;<?php echo $isi->telponsiswa ?></td>
															</tr>
															<tr height="20">
																<td>Handphone</td>
																<td>
																	&nbsp;<?php echo $isi->hpsiswa ?></td>
															</tr>
													<tr height="20">
																<td>Whatsapp</td>
																<td>
																	&nbsp;<?php echo $isi->pinbbm ?></td>
															</tr>
															<tr height="20">
																<td>Email</td>
																<td>
																	&nbsp;<?php echo $isi->emailsiswa ?></td>
															</tr>
													<tr>
													<td colspan="2">&nbsp;</td>
																</tr>
												 <tr  height="30">
													<td colspan="2" align="left" bgcolor="#CCCCCC">&nbsp;KETERANGAN KESEHATAN</td>
															</tr>
															<tr height="20">
																<td >Berat Badan</td>
																<td>
																	&nbsp;<?php echo $isi->berat ?></td>
															</tr>
															<tr height="20">
																<td>Tinggi Badan</td>
																<td>
																	&nbsp;<?php echo $isi->tinggi ?></td>
															</tr>
															<tr height="20">
																<td >Golongan Darah</td>
																<td>
																	&nbsp;<?php echo $isi->darah ?></td>
															</tr>
													 <tr height="20">
																<td >Anak Berkebutuhan Khusus</td>
																<td>
																	&nbsp;<?php if ($isi->abk<>'1') {echo "Tidak";}else{echo "Ya";} ?></td>
															</tr>
															<tr height="20">
																	 <td >Remedial Perilaku</td>
																	 <td>
																		 &nbsp;<?php if ($isi->remedialperilaku<>'1') {echo "Tidak";}else{echo "Ya";} ?></td>
																 </tr>
															<tr >
															<td colspan="2">&nbsp;</td>
															</tr>
												<tr  height="30">
													<td colspan="2" align="left" bgcolor="#CCCCCC">&nbsp;KETERANGAN PENDIDIKAN SEBELUMNYA</td>
															</tr>
															<tr height="20">
																<td >Jenjang Sebelumnya</td>
																<td colspan="2">
																	&nbsp;<?php echo $isi->sekolahjenjang ?></td>
															</tr>
													<tr height="20">
																<td >Asal Sekolah</td>
																<td>
																	&nbsp;<?php echo $isi->asalsekolah ?></td>
															</tr>
													<tr height="20">
																<td >Asal Tingkat Kelas</td>
																<td>
																	&nbsp;<?php echo $isi->tingkat_asal ?></td>
															</tr>
													<tr height="20">
																<td >Asal Jurusan</td>
																<td>
																	&nbsp;<?php echo $isi->jurusan_asal ?></td>
															</tr>
															<tr height="20">
																<td >Keterangan</td>
																<td>
																	&nbsp;<?php echo $isi->ketsekolah ?></td>
															</tr>
													<tr height="20">
																<td valign="top">Ijazah</td>
																<td>
																	&nbsp;thn : <?php echo $isi->t_ijazah ?><br />
														&nbsp;No. : <?php echo $isi->ijazah ?></td>
															</tr>
													<tr height="20">
																<td valign="top">Surat Keterangan Hasil UN</td>
																<td>
																	&nbsp;thn : <?php echo $isi->t_skh ?><br />
														&nbsp;No. : <?php echo $isi->skh ?></td>
															</tr>
													<tr height="20">
																<td valign="top">Thn. Laporan Hasil Belajar</td>
																<td>
																	&nbsp;thn : <?php echo $isi->t_lhb ?></td>
															</tr>
													<tr height="20">
																<td valign="top">Semester Awal</td>
																<td><?php echo $isi->semester_awal ?></td>
															</tr>
													<tr>
																<td colspan="2">&nbsp;</td>
															</tr>
													 <!--
													<tr  height="30">
													<td colspan="4" align="left" bgcolor="#CCCCCC">&nbsp;TINGKATAN YANG DITUJU </td>
															</tr>
													<td rowspan="6"></td>
													<tr height="20">
																<td>Tingkat</td>
																<td>
																	&nbsp;<?php echo $isi->tingkat ?></td>
																</tr>
												<tr height="20">
																<td>Jurusan</td>
																<td>
																	&nbsp;<?php echo $isi->jurusan ?></td>
																</tr>
												<!--
												<tr height="20">
																<td>Program</td>
																<td>
																	&nbsp;<?php echo $isi->status ?></td>
																</tr>

												<?php if ($kelompok<>1){ ?>
												<tr height="20">
																<td>Regional</td>
																<td>
																	&nbsp;<?php echo $isi->region ?></td>
																</tr>
												<?php } ?>
															<tr height="20">
																<td>Status</td>
																<td>
																	&nbsp;<?php echo $isi->kondisi ?></td>
																</tr>
													<tr>
																<td colspan="3">&nbsp;</td>
															 </tr>
													-->
														</table>
												</td>
												<td width="20px">&nbsp;</td>
												<td valign="top" width="50%">
														<table border="1" cellpadding="0" style="border-collapse:collapse" cellspacing="0" width="100%" >

													<tr  height="30">
																<td colspan="4" align="left" bgcolor="#CCCCCC">&nbsp;KETERANGAN ORANG TUA</td>
															</tr>
															<tr height="20">
																<td rowspan="28" width="4%"></td>
																<td align="center">Orang Tua</td>
																<td width="30%" align="center">Ayah</td>
																<td align="center">Ibu</td>
															</tr>
															<tr height="20">
																<td >NIK</td>
																<td >
																	&nbsp;<?php echo strtoupper($isi->nik_ayah) ?>
																</td>
																<td colspan="2">&nbsp;<?php echo strtoupper($isi->nik_ibu) ?>
																</td>
															</tr>
															<tr height="20">
																<td >Nama</td>
																<td >
																	&nbsp;<?php echo strtoupper($isi->namaayah) ?>
																		<?php
												if ($isi->almayah==1)
												echo "&nbsp;(alm)";
												 ?></td>
																<td colspan="2">&nbsp;<?php echo strtoupper($isi->namaibu) ?>
																		<?php 
												if ($isi->almibu==1)
												echo "&nbsp;(alm)";
														 ?></td>
															</tr>
															<tr height="20">
															 <td>Tahun Lahir</td>
															 <td>
																 &nbsp;<?php echo $isi->tahunlahirayah ?></td>
															 <td colspan="2">&nbsp;<?php echo $isi->tahunlahiribu ?></td>
															 </tr>
													 <tr height="20">
																<td>Agama</td>
																<td>
																	&nbsp;<?php echo $isi->agama_ayah ?></td>
																<td colspan="2">&nbsp;<?php echo $isi->agama_ibu ?></td>
															</tr>
															<tr height="20">
																<td >Pendidikan</td>
																<td >
																	&nbsp;<?php echo $isi->pendidikanayah ?></td>
																<td colspan="2">&nbsp;<?php echo $isi->pendidikanibu ?></td>
															</tr>
															<tr height="20">
																<td >Pekerjaan</td>
																<td >
																	&nbsp;<?php echo $isi->pekerjaanayah ?></td>
																<td colspan="2">&nbsp;<?php echo $isi->pekerjaanibu ?></td>
															</tr>
													<tr height="20">
																<td >Instansi</td>
																<td >
																	&nbsp;<?php echo $isi->instansiayahtext ?></td>
																<td colspan="2">&nbsp;<?php echo $isi->instansiibutext ?></td>
															</tr>
															<tr height="20">
																<td >Penghasilan</td>
																<td >
																	&nbsp;<?php echo $isi->penghasilanayah;  ?></td>
																<td colspan="2">&nbsp;<?php echo $isi->penghasilanibu;  ?></td>
															</tr>
															<tr height="20">
																<td >Email Orang Tua</td>
																<td >
																	&nbsp;<?php echo $isi->emailayah ?></td>
																<td colspan="2">&nbsp;<?php echo $isi->emailibu ?></td>
															</tr>
													<tr height="20">
																<td >Telp. Orang Tua</td>
																<td >
																	&nbsp;<?php echo $isi->tel_ayah ?></td>
																<td colspan="2">&nbsp;<?php echo $isi->tel_ibu ?></td>
															</tr>
													<tr height="20">
																<td >Handphone Orang Tua</td>
																<td >
																	&nbsp;<?php echo $isi->hp_ayah ?></td>
																<td colspan="2">&nbsp;<?php echo $isi->hp_ibu ?></td>
															</tr>
													<tr height="20">
																<td >Pin BBM Orang Tua</td>
																<td >
																	&nbsp;<?php echo $isi->bbm_ayah ?></td>
																<td colspan="2">&nbsp;<?php echo $isi->bbm_ibu ?></td>
															</tr>
													 <tr >
																<td height="20" valign="top">Alamat</td>
																<td >
																<?php 
																		$provayahtext="";
																		if($isi->provinsi_ayahtext<>"Luar Negeri"){
																			$provayahtext=" ".$isi->provinsi_ayahtext;
																		} 
																		echo ucwords(strtoupper($isi->alamat_ayah))."&nbsp;".ucwords(strtoupper($isi->kota_ayah))." ".$isi->kodepos_ayah.ucwords(strtoupper($provayahtext))."&nbsp;".ucwords(strtoupper($isi->negara_ayah))
																	?>
																</td>
																<td colspan="2">&nbsp;
																<?php 
																	$provibutext="";
																	if($isi->provinsi_ibutext<>"Luar Negeri"){
																		$provibutext=" ".$isi->provinsi_ibutext;
																	} 
																	echo ucwords(strtoupper($isi->alamat_ibu))."&nbsp;".ucwords(strtoupper($isi->kota_ibu))." ".ucwords(strtoupper($isi->kodepos_ibu)).ucwords(strtoupper($provibutext))."&nbsp;".ucwords(strtoupper($isi->negara_ibu))
																?>
																</td>
															</tr>
													 <tr height="20">
																<td align="center" colspan="3">Wali Peserta Didik</td>
													</tr>
														<tr height="20">
															<td >NIK</td>
															<td colspan="3">
																&nbsp;<?php echo strtoupper($isi->nik_wali) ?></td>
														</tr>
															<tr height="20">
																<td >Nama Wali</td>
																<td colspan="3">
																	&nbsp;<?php echo strtoupper($isi->wali) ?></td>
															</tr>
															<tr height="20">
															<td >Nama Wali</td>
															<td colspan="3">
																&nbsp;<?php echo strtoupper($isi->wali) ?></td>
															</tr>
													<tr height="20">
																<td>Agama</td>
																<td colspan="3">
																	&nbsp;<?php echo $isi->agama_wali ?></td>
															</tr>
													 <tr height="20">
																<td >Pendidikan</td>
																<td colspan="3">
																	&nbsp;<?php echo $isi->pendidikanwali ?></td>
															</tr>
													 <tr height="20">
																<td >Pekerjaan</td>
																<td colspan="3">
																	&nbsp;<?php echo $isi->pekerjaanwali ?></td>
															</tr>
													 <tr height="20">
																<td >Instansi</td>
																<td colspan="3">
																	&nbsp;<?php echo $isi->instansiwalitext ?></td>
															</tr>
													 <tr height="20">
																<td >Penghasilan</td>
																<td colspan="3">
																	&nbsp;<?php echo $isi->penghasilanwali ?></td>
															</tr> <tr height="20">
																<td >Email </td>
																<td colspan="3">
																	&nbsp;<?php echo $isi->emailwali ?></td>
															</tr>
													 <tr height="20">
																<td >Telpon</td>
																<td colspan="3">
																	&nbsp;<?php echo $isi->tel_wali ?></td>
															</tr> <tr height="20">
																<td >Handphone</td>
																<td colspan="3">
																	&nbsp;<?php echo $isi->hp_wali ?></td>
															</tr>
													 <tr height="20">
																<td >Pin BBM</td>
																<td colspan="3">
																	&nbsp;<?php echo $isi->bbm_wali ?></td>
															</tr>
														 <tr height="20">
																<td valign="top">Alamat</td>
																<td colspan="3">
																	&nbsp;
																	<?php
																		$provwalitext="";
																		if($isi->provinsi_walitext<>"Luar Negeri"){
																			$provwalitext=" ".$isi->provinsi_walitext;
																		}  
																		echo ucwords(strtoupper($isi->alamat_wali))."&nbsp;".ucwords(strtoupper($isi->kota_wali))." ".ucwords(strtoupper($isi->kodepos_wali)).ucwords(strtoupper($provwalitext))."&nbsp;".ucwords(strtoupper($isi->negara_wali))
																	?>
																	</td>
															</tr>
															<tr height="20">
																<td colspan="6" >&nbsp;</td>
																</tr>
															<tr height="30" >
													<td colspan="4" align="left" bgcolor="#CCCCCC">&nbsp;KETERANGAN LAINNYA</td>
																</tr>
															<tr height="20">
													<td rowspan="8"></td>
																<td>Alamat Surat</td>
																<td colspan="2">
																	&nbsp;<?php echo $isi->alamat_surat ?></td>
															</tr>
													<tr height="20">
																<td>Info Administrasi dan Akademik</td>
																<td colspan="2">
																	&nbsp;
																	<?php
																			$mediatext="";
																			foreach((array)$media as $rowmedia) {
																					if ($media<>""){$mediatext=$mediatext.',';}
																					$mediatext=$rowmedia->media;
																			}
																			echo $mediatext;
																	 ?>
													</td>
															</tr>
													 <tr height="20">
																<td >Penanggung Jawab Akademik</td>
																<td colspan="2"> &nbsp;<?php echo $isi->pj ?></td>
															</tr>
													<tr height="20">
																<td >Penanggung Jawab Administrasi</td>
																<td colspan="2"> &nbsp;<?php echo $isi->pja ?></td>
															</tr>
															<tr height="20">
																<td >Keterangan</td>
																<td colspan="2"> &nbsp;<?php echo $isi->keterangan ?></td>
															</tr>
													<tr height="20">
																<td >Tanggal Masuk</td>
																<td colspan="2"> &nbsp;<?php echo $CI->p_c->tgl_indo($isi->tgl_masuk) ?></td>
													</tr>
													<tr height="20">
														<td colspan="5" >&nbsp;</td>
														</tr>
												<?php
													//if (trim($isi->nis_sk)<>""){
														//$sql="SELECT s.nama,k.kelas FROM siswa s inner join kelas k ON s.idkelas =k.replid WHERE s.nis='".$isi->nis_sk."'";
														//$result=QueryDB($sql);
														//$row_sk = mysql_fetch_array($result);
												 ?>
												 <!--
												<tr height="30" >
																<td bgcolor="#CCCCCC">H.</td>
																<td colspan="6" align="left" bgcolor="#CCCCCC">SAUDARA KANDUNG</td>
																</tr>
													<tr height="20">
													<td rowspan="3"></td>
																<td >Nama </td>
																<td colspan="2"> &nbsp;<?php echo $row_sk[0] ?></td>
															</tr>
													<tr>
													<td>Kelas </td>
																<td colspan="2"> &nbsp;<?php echo $row_sk[1] ?></td>
															</tr>
													<tr height="20">
																<td colspan="5" >&nbsp;</td>
																</tr>
																-->
																<?php
																//}
																?>
														</table>


													</td>
												</tr>
											</table>
									</div>
										<div class="tab-pane" id="tab_2"><br/>
											<table border="1" cellpadding="0" style="border-collapse:collapse" cellspacing="0" width="100%" >
													<thead>
														<tr>
																<?php
																echo "<th>Tanggal</th>";
																echo "<th>Kelas</th>";
																echo "<th>Status</th>";
																echo "<th>Regional</th>";
																echo "<th>Kelas Tujuan</th>";
																echo "<th>Status Tujuan</th>";
																echo "<th>Regional Tujuan</th>";
																echo "<th>Keterangan</th>";
																?>
														</tr>
													</thead>
													<tbody>
														<?php
														$CI =& get_instance();$no=1;
															foreach((array)$riwayat as $row) {
																	echo "<tr>";
																	echo "<td align='center'>".$CI->p_c->tgl_indo($row->mulai)."</td>";
																	echo "<td align='center'>".strtoupper($row->kelas)."</td>";
																	echo "<td align='center'>".strtoupper($row->kondisitext)."</td>";
																	echo "<td align='center'>".strtoupper($row->regiontext)."</td>";
																	echo "<td align='center'>".strtoupper($row->kelastujuantext)."</td>";
																	echo "<td align='center'>".strtoupper($row->kondisitujuantext)."</td>";
																	echo "<td align='center'>".strtoupper($row->regiontujuantext)."</td>";
																	echo "<td align='center'>".($row->keterangan)."</td>";
																	echo "</tr>";
															}
															?>

													</tbody>
													<tfoot>
													</tfoot>
											</table>
										</div>
										<div class="tab-pane" id="tab_3"><br/>
											<table border="1" cellpadding="0" style="border-collapse:collapse" cellspacing="0" width="100%" >
												<thead>
												<tr>
													<th width='50'>No.</th>
													<th>Tahun Pelajaran</th>
													<th>Semester</th>
													<th>Jenjang</th>
													<th>Kelas</th>
													<th>Tipe Rapor</th>
													<th>Tgl. Rapor</th>
												</tr>
												</thead>
												<tbody>
												<?php
                                        	$no=1;
											foreach((array)$riwayatrapor as $rowrapor) {
												$urlx="ns_rapor_baru";
												if($rowrapor->k13<>1){
													$urlx="ns_rapot";
												}
											    echo "<tr>";
											    echo "<td align='center'>".$no++."</td>";
											    echo "<td align='center'>".strtoupper($rowrapor->tahunajaran)."</td>";
											    echo "<td align='center'>".strtoupper($rowrapor->periode)."</td>";
											    echo "<td align='center'>".strtoupper($rowrapor->departemen)."</td>";
											    echo "<td align='center'>".strtoupper($rowrapor->kelas)."</td>";
											    echo "<td align='center'>".strtoupper($rowrapor->rapottipe)."</td>";
											    echo "<td align='center'>".strtoupper($CI->p_c->tgl_indo($rowrapor->tanggalkegiatan))."</td>";
											    echo "<td align='center' width='*'>";
                         
                          						echo "<a href='".site_url($urlx.'/rapot/'.$rowrapor->replid)."' target='blank_'><i class='fa fa-file-text'></i>&nbsp;Lihat</a></li> ";
                          echo "</td>";
											    echo "</tr>";
											}
											?>
												</tbody>
											</table>
										</div>
										<div class="tab-pane" id="tab_4"><br/>
										<table border="1" cellpadding="0" style="border-collapse:collapse" cellspacing="0" width="100%" >
										<thead>
										<tr>
                                              <?php
                                                echo "<th width='50'>No</th>";
                                                echo "<th>Tahun Ajaran</th>";
                                                echo "<th>Kelas</th>";
                                                echo "<th>Pembuat Laporan</th>";
                                                echo "<th width='100px'>Tgl. Laporan</th>";
                                                echo "<th>Prioritas</th>";
												echo "<th>Latar Belakang</th>";
                                                echo "<th>Status</th>";
                                                
                                              ?>
                                          </tr>
								
								</thead>
								<tbody>
								<?php
                                        	$CI =& get_instance();$no=1;
											foreach((array)$riwayatkonseling as $rowkonseling) {
											    echo "<tr>";
											    echo "<td align='center'>".$no++."</td>";
                                                
                                                echo "<td align='center'>".strtoupper($rowkonseling->tahunajarantext);
                                                echo "<td align='center'>".strtoupper($rowkonseling->kelastext)."<br/>[".$rowkonseling->namawalitext."]</td>";
                                                echo "<td align='center'>".($rowkonseling->createdbytext)."</td>";
                                                echo "<td align='center'>".$CI->p_c->tgl_indo($rowkonseling->tanggallaporan)."</td>";
                                                echo "<td align='center'>".($rowkonseling->prioritastext)."</td>";
												echo "<td align='left'>".($rowkonseling->latarbelakang)."</td>";
                                                echo "<td align='center'>".($rowkonseling->statustext)."</td>";
                                                
                                                echo "</tr>";
											}
											?>

													</tbody>
													<tfoot>
													</tfoot>
												</table>
										</div>
										<div class="tab-pane" id="tab_5"><br/>
											<table border="1" cellpadding="0" style="border-collapse:collapse" cellspacing="0" width="100%" >
													<thead>
														<tr>
																<?php
																echo "<th>Tanggal Mutasi</th>";
																echo "<th>Jenis Mutasi</th>";
																echo "<th>Unit Sekolah</th>";
																//echo "<th>Aktif</th>";
																echo "<th>Keterangan</th>";
																?>
														</tr>
													</thead>
													<tbody>
														<?php
														$CI =& get_instance();$no=1;
															foreach((array)$riwayatmutasi as $rowmutasi) {
																	echo "<tr>";
																	echo "<td align='center'>".$CI->p_c->tgl_indo($rowmutasi->tglmutasi)."</td>";
																	echo "<td align='center'>".strtoupper($rowmutasi->jenismutasitext)."</td>";
																	echo "<td align='center'>".strtoupper($rowmutasi->companytext)."</td>";
																	//echo "<td align='center'>".$CI->p_c->cekaktif($rowmutasi->aktif)."</td>";
																	echo "<td align='center'>".strtoupper($rowmutasi->keterangan)."</td>";
																	echo "</tr>";
															}
															?>

													</tbody>
													<tfoot>
													</tfoot>
											</table>
										</div>
										<div class="tab-pane" id="tab_6"><br/>
											<table border="1" cellpadding="0" style="border-collapse:collapse" cellspacing="0" width="100%" >
													<thead>
														<tr>
																<?php
																echo "<th width='50px'>No.</th>";
																echo "<th>&nbsp;</th>";
																?>
														</tr>
													</thead>
													<tbody>
														<?php
														$nolainlain=1;
														echo "<tr><th>".$nolainlain++."</th><th><a href=javascript:void(window.open('".site_url('general/coverrapor/'.$isi->replid)."'))>Cover Rapor</a></th></tr>";
														echo "<tr><th>".$nolainlain++."</th><th><a href=javascript:void(window.open('".site_url('ksw_siswa/cetakkartu/'.$isi->idkelas.'/'.$isi->replid)."'))>Cetak Kartu</a></th></tr>";
														?>
													</tbody>
													<tfoot>
													</tfoot>
											</table>
										</div>

								</div>
</div>

</center>
</body>
</html>
