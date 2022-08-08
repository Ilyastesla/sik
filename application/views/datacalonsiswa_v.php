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
	<table width="85%" border="0">
	<tr>
		<th colspan="3"><div align="center"><h3>DATA CALON PESERTA DIDIK <?php echo strtoupper($isi->companytext)?></h3></div><br /></th>
	</tr>
	<tr>
	   	<th width="200" >Nama Lengkap</th>
	    <th>
			:&nbsp; <?php echo strtoupper($isi->nama) ?>
		</th>
			<th rowspan="6" align="right">&nbsp;
	        <!--
	        <img src="../library/gambar.php?replid=<?php echo $isi->replid ?>&table=siswa" />
	        -->
	    </th>
	</tr>
	<tr height="20">
		<th>No. Pendaftaran</th>
		<th>
			:&nbsp;&nbsp; <?php echo strtoupper($isi->nopendaftaran )?>
		</th>
	</tr>
	<tr>
		<th width="20%">Jenjang </th>
		<th width="*">:&nbsp;&nbsp;<?php echo $isi->departemen ?></th>
		<th rowspan="6" align="right">
				<!--
		<img src="../library/gambar.php?replid=<?php echo $replid?>&table=calonsiswa" />
				-->
		</th>
		</th>
	</tr>
	<tr>
		<th>Tahun Masuk</th>
		<th>:&nbsp;&nbsp;<?php echo $isi->tahunmasuk ?></th>
		</tr>
		<tr>
			<th>Tahun Pelajaran</th>
			<th>:&nbsp;&nbsp;<?php echo $isi->tahunajarantext ?></th>
			</tr>
		<tr>
		<th width="20%">Proses Penerimaan </th>
		<th width="*">:&nbsp;&nbsp;<?php echo $isi->proses ?></th>
	</tr>

	<tr>
	    <th align="left">
	      Jenjang Terakhir/Aktif</th>
	    <th align="left">:&nbsp;
	      <?php echo $isi->departemen ?>
	    </th>
	</tr>
	<tr>
		<th>Kelompok Calon Peserta Didik</th>
		<th>:&nbsp;&nbsp;<?php echo $isi->kelompok ?></th>
		</tr>
		<tr>
			<th>Tingkatan Yang Dituju</th>
			<th>:&nbsp;&nbsp;<?php echo $isi->tingkattext ?></th>
			</tr>
			<tr>
				<th>Jurusan</th>
				<th>:&nbsp;&nbsp;<?php echo $isi->jurusantext ?></th>
				</tr>
		<tr>
			<th>Regional</th>
			<th>:&nbsp;&nbsp;<?php echo $isi->region ?></th>
			</tr>
		<tr>
		<th>Tanggal Daftar</th>
		<th>:&nbsp;&nbsp;<?php echo $CI->p_c->tgl_indo($isi->tanggal_daftar) ?></th>
		</tr>
		<tr>
		<th>Anak Berkebutuhan Khusus</th>
		<th>:&nbsp;&nbsp;<?php echo $CI->p_c->cekaktif($isi->abk) ?></th>
		</tr>
		<tr>
		<th>Remedial Perilaku</th>
		<th>:&nbsp;&nbsp;<?php echo $CI->p_c->cekaktif($isi->remedialperilaku) ?></th>
		</tr>
		<tr height="20">
			<th>NIS</th>
			<th>
				:&nbsp;<?php echo "<a href=javascript:void(window.open('".site_url('general/datasiswa/'.$isi->replidsiswa)."'))>".$isi->nis."</a>";?>
			</th>
		</tr>
	<tr>
		<th>Aktif</th>
		<th>:&nbsp;&nbsp;<?php echo $CI->p_c->cekaktif($isi->aktif) ?></th>
		<!--
		<th width="250" align="right" valign="bottom">&nbsp;

	      <input type="hidden" name="replid" id="replid" value="<?php echo $isi->replid ?>" />
	      <a href="#" onclick="cetak('<?php echo $isi->replid ?>')"><img src="../images/ico/print.png" border="0"/>&nbsp;Cetak</a>&nbsp;&nbsp;
	      <a href="#" onclick="window.close();"><img src="../images/ico/exit.png" width="16" height="16" border="0" />&nbsp;Tutup</a></div>
	    </th>
			-->
		</tr>
	<tr>
		<th align="left">Petugas</th>
		<th>:
			<?php
			echo $CI->dbx->getpegawai($isi->created_by,0,1);
			echo " Pada ".$CI->p_c->tgl_indo($isi->created_date);
				
			?>
		</th>
	</tr>
	</table>
	<br/>

<div class="nav-tabs-custom" style="width:85% !important;">
								<ul class="nav nav-tabs">
										<li class="active"><a href="#tab_1" data-toggle="tab"><b>Data Diri</b></a></li>
										<li><a href="#tab_2" data-toggle="tab"><b>Kronologis</b></a></li>
										<li><a href="#tab_3" data-toggle="tab"><b>Formulir Data Orangtua</a></b></li>
										<li><a href="#tab_4" data-toggle="tab"><b>Persyaratan</a></b></li>
										<li><a href="#tab_5" data-toggle="tab"><b>Riwayat</a></b></li>
										<li><a href="#tab_6" data-toggle="tab"><b>Hasil Interview</a></b></li>
										<?php
											if($isi->keu_assessment=='1'){
													echo "<li><a href='#tab_7' data-toggle='tab'><b>Hasil Asesmen</a></b></li>";
											}
										?>

								</ul>
								<div class="tab-content">
										<div class="tab-pane active" id="tab_1"><br/>
											<table border="0"  id="table" width="100%" cellpadding="0" style="border-collapse:collapse" cellspacing="0">
												<tr>
													<td valign="top" width="48%">
														<table border="1" cellpadding="0" style="border-collapse:collapse" cellspacing="0" width="100%" >
														  <tr  height="30">
															<td colspan="2" bgcolor="#CCCCCC"><strong>A. KETERANGAN PRIBADI</strong></td>
														  </tr>
														  <tr height="20">
															<td>NISN</td>
															<td>
															  &nbsp;<?php echo $isi->nisn ?></td>
															</tr>
															<tr height="20">
															<td>NIK</td>
															<td>
															  &nbsp; <?php echo strtoupper($isi->nik_siswa )?></td>
														  </tr>
														  <tr height="20">
															<td>Nama Lengkap</td>
															<td>
															  &nbsp; <?php echo strtoupper($isi->nama )?></td>
														  </tr>
														  <tr height="20">
															<td>Nama Panggilan</td>
															<td>
															  &nbsp;<?php echo strtolower($isi->panggilan )?></td>
															</tr>
														  <tr height="20">
															<td>Jenis Kelamin</td>
															<td>&nbsp;<?php echo $CI->p_c->jk($isi->kelamin) ?></td>
															</tr>
														  <tr height="20">
															<td>Tempat Lahir</td>
															<td>
															  &nbsp;<?php echo $isi->tmplahir ?></td>
															</tr>
														  <tr height="20">
															<td>Tanggal Lahir</td>
															<td>
															  &nbsp;<?php echo $CI->p_c->tgl_indo($isi->tgllahir ) ?></td>
															</tr>
															<tr height="20">
															<td >Agama</td>
															<td>
															  &nbsp;<?php echo $isi->agama ?></td>
															</tr>
															<tr height="20">
																<td>Kewarganegaraan</td>
																<td>
																  &nbsp;<?php echo $isi->warga ?>
																  <?php if ($isi->warga =='WNA'){echo " [".$isi->negara_asal ."]";}?>
																  </td>
																</tr>
														<tr height="20">
															<td>Anak ke</td>
															<td>
															  &nbsp;<?php echo $isi->anakke ?></td>
															</tr>
															<tr height="20">
															<td>Dari</td>
															<td>
																&nbsp;<?php echo $isi->jsaudara ?> bersaudara</td>
															</tr>
														<tr height="20">
															<td>Status Anak</td>
															<td>
															  &nbsp;<?php echo $isi->statanak ?></td>
														</tr>
														<tr height="20">
															<td>Bahasa sehari-hari</td>
															<td>
															  &nbsp;<?php echo $isi->bahasa ?></td>
															</tr>
														<!--
														<tr height="20">
															<td >Suku</td>
															<td>
															  &nbsp;<?php echo $isi->suku ?></td>
															</tr>
														-->
														  <tr>
															<td colspan="2">&nbsp;</td>
															</tr>
														  <tr  height="30">
															<td colspan="2" bgcolor="#CCCCCC"><strong>B. KETERANGAN TEMPAT TINGGAL</strong></td>
														  </tr>
														  <tr height="20">
															<td valign="top">Alamat</td>
															<td>
															  &nbsp;<?php echo $isi->alamatsiswa ."&nbsp; ".$isi->kecamatantext."<br/>&nbsp;".$isi->kota ." ".$isi->kodepossiswa ." <br />&nbsp;".$isi->provinsi ."<br />&nbsp;".$isi->negara ?></td>
														  </tr>
														  <tr height="20">
																<td>Jarak Tempuh Ke Sekolah</td>
																<td colspan="2">
																	&nbsp;<?php echo $isi->jaraktempuh ?> KM</td>
															</tr>
															<tr height="20">
																<td>Waktu Tempuh Ke Sekolah</td>
																<td colspan="2">
																	&nbsp;<?php echo $isi->waktutempuh ?></td>
															</tr>
															<tr height="20">
															<td>Tempat Tinggal</td>
															<td>
															  &nbsp;<?php echo $isi->tempattinggaltext ?></td>
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
															<td>No. Whatsapp</td>
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
															<td colspan="2" bgcolor="#CCCCCC"><strong>C. RIWAYAT KESEHATAN</strong></td>
														  </tr>
															<tr height="20">
															<td >Golongan Darah</td>
															<td>
															  &nbsp;<?php echo $isi->darah ?></td>
														  </tr>
															<tr height="20">
															<td>Tinggi Badan</td>
															<td>
															  &nbsp;<?php echo $isi->tinggi ?></td>
														  </tr>
														  <tr height="20">
															<td >Berat Badan</td>
															<td>
															  &nbsp;<?php echo $isi->berat ?></td>
														  </tr>

														  <tr height="20">
															<td >Anak Berkebutuhan Khusus</td>
															<td>
															  &nbsp;<?php echo $CI->p_c->cekaktif($isi->abk) ?></td>
														  </tr>
															<tr height="20">
											             <td >Remedial Perilaku</td>
											             <td>
											               &nbsp;<?php echo $CI->p_c->cekaktif($isi->remedialperilaku) ?></td>
											           </tr>
														  <tr >
															<td colspan="2">&nbsp;</td>
														  </tr>
															<tr  height="30">
															<td colspan="2" bgcolor="#CCCCCC"><strong>D. KETERANGAN SEKOLAH SEBELUMNYA</strong></td>
														  </tr>
															<tr height="20">
															<td >Asal Jenjang</td>
															<td>
															  &nbsp;<?php echo $isi->sekolahjenjang ?></td>
														  </tr>
														  <tr height="20">
															<td >Asal Sekolah</td>
															<td>
															  &nbsp;<?php echo $isi->asalsekolah ?></td>
														  </tr>
														  <tr height="20">
															<td >Asal Tingkat</td>
															<td>
															  &nbsp;<?php echo $isi->tingkat_asaltext ?></td>
														  </tr>
															<!--
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
														  <tr>
															<td colspan="2">&nbsp;</td>
														   </tr>
														 -->
														 <tr height="20">
														 <td >Jenjang Sebelumnya</td>
														 <td>
															 &nbsp;<?php echo $isi->jenjangakhir ?></td>
														 </tr>
														 <tr height="20">
														 <td >Asal Sekolah</td>
														 <td>
															 &nbsp;<?php echo $isi->sekolahjenjang ?></td>
														 </tr>
														  <tr  height="30">
															<td colspan="2" bgcolor="#CCCCCC"><strong>E.TINGKATAN YANG DITUJU </strong></td>
														  </tr>
														  <tr height="20">
															<td>Tingkat</td>
															<td>
															  &nbsp;<?php echo $isi->tingkattext ?></td>
															</tr>
														<tr height="20">
															<td>Jurusan</td>
															<td>
															  &nbsp;<?php echo $isi->jurusantext ?></td>
															</tr>
														<!--
														<tr height="20">
															<td>Program</td>
															<td>
															  &nbsp;<?php echo $isi->status ?></td>
															</tr>
														-->
														<tr height="20">
															<td>Regional</td>
															<td>
															  &nbsp;<?php echo $isi->region ?></td>
															</tr>
														  <tr height="20">
															<td>Status</td>
															<td>
															  &nbsp;<?php echo $isi->kondisi ?></td>
															</tr>
															<tr height="20">
															<td valign="top">Semester Awal</td>
															<td><?php echo $isi->semester_awal ?></td>
														  </tr>
															<tr height="20">
															<td >Calon Kelas</td>
															<td> &nbsp;<?php echo $isi->calon_kelas ?></td>
														  </tr>
															<tr height="20">
															<td >Calon Kelas Status</td>
															<td> &nbsp;<?php echo $isi->calon_kelas_status ?></td>
														  </tr>

															<tr>
															<td colspan="2">&nbsp;</td>
														   </tr>
														</table>
													</td>
													<td width="4%">&nbsp;</td>
													<td valign="top" width="48%">
														<table border="1" cellpadding="0" style="border-collapse:collapse" cellspacing="0" width="100%">
														  <tr  height="30">
															<td colspan="5" align="left" bgcolor="#CCCCCC"><strong>F. KETERANGAN ORANG TUA</strong></td>
														  </tr>
														  <tr height="20">
															<td align="center"><strong>Orang Tua</strong></td>
															<td width="30%" align="center"><strong>Ayah</strong></td>
															<td align="center"><strong>Ibu</strong></td>
														  </tr>
															<tr height="20">
															 <td>NIK</td>
															 <td>
																 &nbsp;<?php echo $isi->nik_ayah ?></td>
															 <td colspan="2">&nbsp;<?php echo $isi->nik_ibu ?></td>
															 </tr>
														  <tr height="20">
															<td >Nama</td>
															<td >
															  &nbsp; <?php echo strtoupper($isi->namaayah )?>
																<?
														if ($isi->almayah ==1)
														echo "&nbsp;(alm)";
														?></td>
															<td colspan="2">&nbsp; <?php echo strtoupper($isi->namaibu )?>
																<?
														if ($isi->almibu ==1)
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
															<td >Nama Instansi</td>
															<td >
															  &nbsp;<?php echo $isi->instansiayahtext ?></td>
															<td colspan="2">&nbsp;<?php echo $isi->instansiibutext ?></td>
														  </tr>
														  <tr height="20">
															<td >Penghasilan</td>
															<td >
															  &nbsp;<?php echo $isi->penghasilanayah ; ?></td>
															<td colspan="2">&nbsp;<?php echo $isi->penghasilanibu ; ?></td>
														  </tr>
															<tr >
														 <td height="20" valign="top">Alamat</td>
														 <td >
															 &nbsp;<?php echo $isi->alamat_ayah ."&nbsp; ".$isi->kecamatantext_ayah."<br/>&nbsp;".$isi->kota_ayah ." ".$isi->kodepos_ayah ." <br />&nbsp;".$isi->provinsi_ayah ."<br />&nbsp;".$isi->negara_ayah ?></td>
														 <td colspan="2">&nbsp;<?php echo $isi->alamat_ibu ."&nbsp; ".$isi->kecamatantext_ibu."<br/>&nbsp;".$isi->kota_ibu ." ".$isi->kodepos_ibu ." <br />&nbsp;".$isi->provinsi_ibu ."<br />&nbsp;".$isi->negara_ibu ?></td></td>
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
														 <td >No. Whatsapp Orang Tua</td>
														 <td >
															 &nbsp;<?php echo $isi->bbm_ayah ?></td>
														 <td colspan="2">&nbsp;<?php echo $isi->bbm_ibu ?></td>
														 </tr>
														 <?php if($isi->wali_opt==1){ ?>
														  <tr height="20">
															<td >Email Orang Tua</td>
															<td >
															  &nbsp;<?php echo $isi->emailayah ?></td>
															<td colspan="2">&nbsp;<?php echo $isi->emailibu ?></td>
														  </tr>
														   <tr height="20">
															<td align="center" colspan="3"><strong>Wali Peserta Didik</strong></td>
															</tr>
														  <tr height="20">
															<td >Nama Wali</td>
															<td colspan="3">
															  &nbsp; <?php echo strtoupper($isi->wali )?></td>
														  </tr>
															<tr height="20">
															<td >Tahun Lahir</td>
															<td colspan="3">
															  &nbsp; <?php echo strtoupper($isi->tahunlahirwali )?></td>
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
															<td >Nama Instansi</td>
															<td colspan="3">
															  &nbsp;<?php echo $isi->instansiwalitext ?></td>
														  </tr>
														   <tr height="20">
															<td >Penghasilan</td>
															<td colspan="3">
															  &nbsp;<?php echo $isi->penghasilanwali ?></td>
														  </tr>
															<tr height="20">
 															<td valign="top">Alamat</td>
 															<td colspan="3">
 															  &nbsp;<?php echo $isi->alamat_wali ."&nbsp; ".$isi->kecamatantext_wali."<br/>&nbsp;".$isi->kota_wali ." ".$isi->kodepos_wali ." <br />&nbsp;".$isi->provinsi_wali ."<br />&nbsp;".$isi->negara_wali ?>
 															</td>
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
														 <td >No. Whatsapp</td>
														 <td colspan="3">
															 &nbsp;<?php echo $isi->bbm_wali ?></td>
														 </tr>
															<tr height="20">
															<td >Email </td>
															<td colspan="3">
															  &nbsp;<?php echo $isi->emailwali ?></td>
														  </tr>
														  <tr height="20">
																<td colspan="5" >&nbsp;</td>
															</tr>
														<?php } ?>
														  <tr height="30" >
															<td colspan="6" align="left" bgcolor="#CCCCCC"><strong>G. KETERANGAN LAINNYA</strong></td>
															</tr>
														  <tr height="20">
															<td>Alamat Surat</td>
															<td colspan="2">
															  &nbsp;<?php echo $isi->alamat_surat ?></td>
														  </tr>
														  <tr height="20">
															<td>Info Administrasi dan Akademik</td>
															<td colspan="2">
															  &nbsp;
																<?
																		$mediatext="";
																		foreach((array)$media as $rowmedia) {
																				if ($media<>""){$mediatext=$mediatext.',';}
																				$mediatext=$rowmedia->media;
																		}
																		echo $mediatext;
																 ?>
														  </tr>
														  <tr height="20">
															<td >Penanggung Jawab Akademik</td>
															<td colspan="2"> &nbsp;<?php echo $isi->pj ?></td>
														  </tr>
														  <tr height="20">
															<td >Penanggung Jawab Administrasi</td>
															<td colspan="2"> &nbsp;<?php echo $isi->pja ?></td>
														  </tr>
															<!--
														  <tr height="20">
															<td >Keterangan</td>
															<td colspan="2"> &nbsp;<?php echo $isi->keterangan ?></td>
														  </tr>
														  <tr height="20">
															<td >NIS Sementara</td>
															<td colspan="2"> &nbsp;<?php echo $isi->nissementara ?></td>
														  </tr>
														-->
															<tr height="20">
																<td colspan="5" >&nbsp;</td>
															</tr>
															<?php
															if ($isi->nis_sk<>""){
																if (substr($isi->nis_sk ,0,3)=="PSB"){ ?>
																		<tr height="30" >
																		  <td bgcolor="#CCCCCC"><strong>H.</strong></td>
																		  <td colspan="6" align="left" bgcolor="#CCCCCC"><strong>SAUDARA KANDUNG</strong></td>
																		  </tr>
																		  <tr height="20">
																		  <td rowspan="4"></td>
																		  <td >Nama </td>
																		  <td colspan="2"> &nbsp;<?php echo $saudara->nama ?></td>
																		 </tr>
																		  <tr>
																		  <td>Departemen </td>
																		  <td colspan="2"> &nbsp;<?php echo $saudara->departemen ?></td>
																		  </tr>
																		  <tr>
																		  <td>Proses</td>
																		  <td colspan="2"> &nbsp;<?php echo $saudara->proses ?></td>
																		  </tr>
																		  <tr>
																		  <td>Program</td>
																		  <td colspan="2"> &nbsp;<?php echo $saudara->kelompok ?></td>
																		  </tr>
															<?php }else{ ?>
																		  <tr height="30" >
																		  <td bgcolor="#CCCCCC"><strong>H.</strong></td>
																		  <td colspan="6" align="left" bgcolor="#CCCCCC"><strong>SAUDARA KANDUNG</strong></td>
																		  </tr>
																		  <tr height="20">
																		  <td rowspan="3"></td>
																		  <td >Nama </td>
																		  <td colspan="2"> &nbsp;<?php echo $saudara->nama?></td>
																		 </tr>
																		  <tr>
																		  <td>Kelas </td>
																		  <td colspan="2"> &nbsp;<?php echo $saudara->kelas ?></td>
																		  </tr>
															  <?php } ?>
															  <tr height="20">
															  <td colspan="6" >&nbsp;</td>
															  </tr>
															<?php }?>
														</table>
													</td>
												</tr>
												</table>
										</div>
										<div class="tab-pane" id="tab_2"><br/>  <!-- Kronologis -->
											<table border="0" cellpadding="0" style="border-collapse:collapse" cellspacing="0" width="100%" class="form-horizontal form-validate">
						            <tr>
						              <th align="left"><h4>Data Orang Tua/Wali</h4>
						              </th>
						            </tr>
						            <tr>
													<th align="left">
																<label class="control-label" for="minlengthfield">Nama Orang Tua/Wali</label>
																<div class="control-group">
																		<div class="controls">:
																	<?php
																			echo $kronologis->namaortu." (".$kronologis->ortu.")";
																	?>
																	</div>
																</div>
														</tr>
						                <!--
						                 <tr>
										            <th align="left">
								                		<label class="control-label" for="minlengthfield">No. KTP</label>
								                		<div class="control-group">
						          									<div class="controls">:
						          				                	<?php
						                                      echo "<a href=javascript:void(window.open('".site_url('../../formalonline/uploads/onlinekronologis/'.$kronologis->fileencrypt)."'))>$kronologis->noidentitas</a>";
						          				                	?>
						          				                	<?php //echo  <p id="message"></p> ?>
						          									</div>
								                		</div>
										        </th></tr>
						                 </th></tr>
						                   <tr>
						                       <th align="left">
						                           <label class="control-label" for="minlengthfield">Tahun Lahir Orang Tua/Wali</label>
						                           <div class="control-group">
						                     <div class="controls">:
						                             <?php
						                               echo $kronologis->tahunlahirortu;
						                             ?>
						                             <?php //echo  <p id="message"></p> ?>
						                     </div>
						                           </div>
						                   </th></tr>
						              <tr>
						              <th align="left">
						                  <label class="control-label" for="minlengthfield">No. Telepon</label>
						                  <div class="control-group">
						            <div class="controls">:
						                    <?php
						                      echo $kronologis->teleponortu;
						                    ?>
						                    <?php //echo  <p id="message"></p> ?>
						            </div>
						                  </div>
						              </th></tr>
						            -->
						              <tr>
						              <th align="left">
						                  <label class="control-label" for="minlengthfield">No. Handphone</label>
						                  <div class="control-group">
						            <div class="controls">:
						                    <?php
						                      echo $kronologis->handphoneortu;
						                    ?>
						                    <?php //echo  <p id="message"></p> ?>
						            </div>
						                  </div>
						              </th></tr>
						              <tr>
						              <th align="left">
						                  <label class="control-label" for="minlengthfield">No. Whatsapp</label>
						                  <div class="control-group">
						            <div class="controls">:
						                    <?php
						                      echo $kronologis->whatsapportu;
						                    ?>
						                    <?php //echo  <p id="message"></p> ?>
						            </div>
						                  </div>
						              </th></tr>
						             <tr>
						             <th align="left">
						                 <label class="control-label" for="minlengthfield">Email Orang Tua/Wali</label>
						                 <div class="control-group">
						           <div class="controls">:
						                   <?php
						                     echo $kronologis->emailortu;
						                   ?>
						                   <?php //echo  <p id="message"></p> ?>
						           </div>
						                 </div>
						             </th></tr>
						             <tr>
						               <th align="left">
						                    <h4>Data Peserta Didik</h4>
						               </th></tr>
						             <tr>
						                <tr>
						    		            <th align="left">
						    	                		<label class="control-label" for="minlengthfield">Nama Peserta Didik</label>
						    	                		<div class="control-group">
						    								<div class="controls">:
						    			                	<?php
						    			                		 echo $kronologis->namacalon;
						    			                	?>
						    			                	<?php //echo  <p id="message"></p> ?>
						    								</div>
						    	                		</div>
						    			            </th></tr>
						                <tr>
						                <th align="left">
						                    <label class="control-label" for="minlengthfield">Jenis Kelamin</label>
						                    <div class="control-group">
						                        <div class="controls">:
						                                <?php
						                                  echo $this->p_c->jk($kronologis->jeniskelamin);
						                                ?>
						                                <?php //echo  <p id="message"></p> ?>
						                        </div>
						                    </div>
						                </th></tr>
						                <!--
						                <tr>
						    		            <th align="left">
						    	                		<label class="control-label" for="minlengthfield">Tempat Lahir</label>
						    	                		<div class="control-group">
						    								<div class="controls">:
						    			                	<?php
						    			                		 echo $kronologis->tempatlahir;
						    			                	?>
						    			                	<?php //echo  <p id="message"></p> ?>
						    								</div>
						    	                		</div>
						    			            </th>
						                </tr>
						              -->
						                <tr>
						                <th align="left">
						                    <label class="control-label" for="minlengthfield">Tanggal Lahir</label>
						                    <div class="control-group">
						              <div class="controls">:
						                      <?php
						                        echo $CI->p_c->tgl_indo($kronologis->tanggallahir);
						                      ?>
						                      <?php //echo  <p id="message"></p> ?>
						              </div>
						                    </div>
						                </th></tr>
						                <tr>
						    		            <th align="left">
						    	                		<label class="control-label" for="minlengthfield">Umur</label>
						    	                		<div class="control-group">
						    								<div class="controls">:
						    			                	<?php
						    			                		 echo $kronologis->umur;
						    			                	?>
						    			                	<?php //echo  <p id="message"></p> ?>
						    								</div>
						    	                		</div>
						    			            </th>
						                </tr>
						                <tr>
						                <td align="left" >
						                    <label class="control-label" style='width:100% !important;'>
						                    Apakah calon peserta didik terindikasi "Anak Berkebutuhan Khusus"?
						                    <?php
								                		echo $CI->p_c->cekaktif($kronologis->abk);
								                	?>
						                    </label>
						                </td></tr>
						                <tr>
						                <td align="left" >
						                    <label class="control-label" style='width:100% !important;'>
						                    Apakah calon peserta didik pernah melakukan pemeriksaan psikologis dari psikolog atau psikiater?
						                    <?php
								                		echo $CI->p_c->cekaktif($kronologis->pemeriksaan_psikolog);
								                	?>
						                    </label>
						                </td></tr>
						                <!--
						                <tr>
						                <th align="left">
						                    <label class="control-label" for="minlengthfield">Negara</label>
						                    <div class="control-group">
						              <div class="controls">:
						                      <?php
						                        echo $kronologis->negaratext
						                      ?>
						                      <?php //echo  <p id="message"></p> ?>
						              </div>
						                    </div>
						                </th></tr>
						                <tr>
						                  <th align="left">
						                      <label class="control-label" for="minlengthfield">Provinsi</label>
						                      <div class="control-group">
						                <div class="controls">:
						                        <?php
						                          echo $kronologis->propinsitext
						                        ?>
						                        <?php //echo  <p id="message"></p> ?>
						                </div>
						                      </div>
						                  </th></tr>
						                  <tr>
						                  <th align="left">
						                      <label class="control-label" for="minlengthfield">Kota</label>
						                      <div class="control-group">
						                <div class="controls">:
						                        <?php
						                        echo $kronologis->kotatext
						                        ?>
						                        <?php //echo  <p id="message"></p> ?>
						                </div>
						                      </div>
						                  </th></tr>
						                  <tr>
						                  <th align="left">
						                      <label class="control-label" for="minlengthfield">Kecamatan</label>
						                      <div class="control-group">
						                <div class="controls">:
						                        <?php
						                        echo $kronologis->kecamatantext;
						                        ?>
						                        <?php //echo  <p id="message"></p> ?>
						                </div>
						                      </div>
						                  </th></tr>
						                  <tr>
						                    <th align="left">
						                      <hr/>
						                      <h4>Pendidikan Terakhir</h4>
						                    </th></tr>
						                  <tr>
						                    <th align="left">
						                    <label class="control-label" for="minlengthfield">Asal Jenjang</label>
						                    <div class="control-group">
						                  <div class="controls">:
						                    <?php
						                      echo $kronologis->jenjangasal;
						                    ?>
						                          <?php //echo  <p id="message"></p> ?>
						                  </div>
						                    </div>
						                    </th></tr>
						                    <tr>
						    		            <th align="left">
						    	                		<label class="control-label" for="minlengthfield">Asal Sekolah</label>
						    	                		<div class="control-group">
						    								<div class="controls">:
						    			                	<?php
						    			                		 echo $kronologis->asalsekolah;
						    			                	?>
						    			                	<?php //echo  <p id="message"></p> ?>
						    								</div>
						    	                		</div>
						    			            </th></tr>
						                      <tr>
						                          <th align="left">
						                                <label class="control-label" for="minlengthfield">Asal Tingkat</label>
						                                <div class="control-group">
						                          <div class="controls">:
						                              <?php
						                                echo $kronologis->tingkatasaltext;
						                              ?>
						                                  <?php //echo  <p id="message"></p> ?>
						                          </div>
						                                </div>
						                            </th></tr>
						                <tr>
						    		            <th align="left">
						    	                		<label class="control-label" for="minlengthfield">Asal Jurusan</label>
						    	                		<div class="control-group">
						    								<div class="controls">:
						                            <?php
						                              echo $kronologis->jurusanasaltext;
						                            ?>
						    			                	<?php //echo  <p id="message"></p> ?>
						    								</div>
						    	                		</div>
						    			            </th></tr>
						                    -->
						                      <tr>
						                        <th align="left">
						                          <hr/>
						                          <h4>Jenjang Yang Dituju</h4>
						                        </th></tr>
						                      <tr>
						                      <tr>
						                      <th align="left">
						                        <label class="control-label" for="minlengthfield">Lokasi Sekolah</label>
						                        <div class="control-group">
						                          <div class="controls">:
						                          <?php
						                          echo $kronologis->unitbisnistext;
						                          ?>
						                          </div>
						                        </div>
						                      </th></tr>
						                      <tr>
						                      <th align="left">
						                        <label class="control-label" for="minlengthfield">Jenjang</label>
						                        <div class="control-group">
						                          <div class="controls">:
						                          <?php
						                          echo $kronologis->jenjang;
						                          ?>
						                          </div>
						                        </div>
						                      </th></tr>
						                      <tr>
						                          <th align="left">
						                                <label class="control-label" for="minlengthfield">Tingkat</label>
						                                <div class="control-group">
						                          <div class="controls">:
						                              <?php
						                                echo $kronologis->tingkattext;
						                              ?>
						                                  <?php //echo  <p id="message"></p> ?>
						                          </div>
						                                </div>
						                            </th></tr>
						                      <tr>
						                      <th align="left">
						                            <label class="control-label" for="minlengthfield">Jurusan</label>
						                            <div class="control-group">
						                      <div class="controls">:
						                              <?php
						                                echo $kronologis->jurusantext;
						                              ?>
						                              <?php //echo  <p id="message"></p> ?>
						                      </div>
						                            </div>
						                        </th></tr>
						                        <tr>
						                          <th align="left">
						                                <label class="control-label" for="minlengthfield">Program Yang Dipilih</label>
						                                <div class="control-group">
						                          <div class="controls">:
						                              <?php
						                                echo $kronologis->kelompokcalontext;
						                              ?>
						                                  <?php //echo  <p id="message"></p> ?>
						                          </div>
						                                </div>
						                  </th></tr>
						                    <tr>
						        		            <td align="left">
						        	                		<hr/><label>1. Bagaimana Pengalaman Bapak/Ibu dalam pengisian registrasi Online <b>Homeschooling Kak Seto</b>?</b>?</label>
						                               <b>(<?php echo $kronologis->votingtext ?>)</b>
						        			           </td>
						                    </tr>
						                    <tr>
						        		            <td align="left">
						        	                		<label>2. Apa yang membuat anda tertarik dengan <b>Homeschooling Kak Seto</b>?</b>?</label>
						                              <b>(<?php echo $alasan_opt ?>)</b>
						        			           </td>
						                    </tr>
						                  <tr>
						      		            <td align="left">
						      	                		<label>3. Informasi <b>Homeschooling Kak Seto</b> diperoleh dari?</label>
						                            <b>(<?php echo $media_opt ?>)</b>
						      			           </td>
						                  </tr>
															<tr>
						                  <th align="left">
						                    <hr/>
						                    <h4>Saran PSB</h4>
						                  </th></tr>
						                  <tr>
						                    <th align="left">
						                          <label class="control-label" for="minlengthfield">Tahun Pelajaran</label>
						                          <div class="control-group">
						                    <div class="controls">:
						                        <?php
						                            echo $kronologis->tahunajarantext;
						                        ?>
						                    </div>
						                          </div>
						                      </th></tr>
								    		<tr>
								            <th align="left">
							                		<label class="control-label" for="minlengthfield">Proses</label>
							                		<div class="control-group">
														<div class="controls">:
						                    <?php
						                      echo $kronologis->prosestext;
						                    ?>
									                	<?php //echo  <p id="message"></p> ?>
														</div>
							                		</div>
									            </th></tr>
						          <tr>
						              <th align="left">
						                    <label class="control-label" for="minlengthfield">Program</label>
						                    <div class="control-group">
						              <div class="controls">:
						                  <?php
						                    echo $kronologis->kelompoktext;
						                  ?>
						              </div>
						                    </div>
						                </th></tr>
						          <tr>
						              <th align="left">
						                    <label class="control-label" for="minlengthfield">Status Program</label>
						                    <div class="control-group">
						              <div class="controls">:

						                  <?php
						                  echo $kronologis->kondisisiswatext;
						                  ?>
						                      <?php //echo  <p id="message"></p> ?>
						              </div>
						                    </div>
						                </th></tr>
						          <tr>
						            <th align="left">
						                  <label class="control-label" for="minlengthfield">Regional</label>
						                  <div class="control-group">
						            <div class="controls">:
						                <?php
						                	echo $kronologis->regiontext;
						                ?>
						                    <?php //echo  <p id="message"></p> ?>
						            </div>
						                  </div>
						              </th></tr>
						              <tr>
						              <th align="left">
						              <label class="control-label" for="minlengthfield">Anak Berkebutuhan Khusus</label>
						              <div class="control-group">
						            <div class="controls">:
						                    <?php
						                      echo $CI->p_c->cekaktif($kronologis->abk);
						                    ?>
						            </div>
						              </div>
						              </th></tr>
													<tr>
						              <th align="left">
						              <label class="control-label" for="minlengthfield">Remedial Perilaku</label>
						              <div class="control-group">
						            <div class="controls">:
						                    <?php
						                      echo $CI->p_c->cekaktif($kronologis->remedialperilaku);
						                    ?>
						            </div>
						              </div>
						              </th></tr>
						              <tr>
						              <th align="left">
						                  <label class="control-label" for="minlengthfield">Tanggal Daftar</label>
						                  <div class="control-group">
						            <div class="controls">:
						              <?php
						                echo $CI->p_c->tgl_indo($kronologis->tanggaldaftar);
						                ?>
						            </div>
						                  </div>
						              </th></tr>
									  <tr>
						            <th align="left">
						                  <label class="control-label" for="minlengthfield">Keterangan</label>
						                  <div class="control-group">
						            <div class="controls">:
						                <?php
						                	echo $kronologis->keterangan;
						                ?>
						                    <?php //echo  <p id="message"></p> ?>
						            </div>
						                  </div>
						              </th></tr>
															<tr>
						                    <th align="left">
						                          <hr/>
						                          <label class="control-label" for="minlengthfield">Diproses Oleh</label>
						                          <div class="control-group">
						                    <div class="controls">:
						                        <?php echo $CI->dbx->getpegawai($kronologis->proses_by,0,1) ?>
						                    </div>
						                          </div>
						            </th></tr>
								            </table>
										</div>
										<div class="tab-pane" id="tab_3"><br/>  <!-- Formulir Data Orangtua -->
											<?php $no=1; ?>
											<table border="0" cellpadding="0" style="border-collapse:collapse" cellspacing="0" width="100%" class="form-horizontal form-validate">
				                    <tr>
				                        <th align="left">
				                              <label><b><?=$no++.'. '?>Apa alasan Bapak/Ibu memilih atau memindahkan anak Anda ke “Homeschooling” Kak Seto?</b></label>
				                        </th></tr>
				                    <tr>
				                      <th>
				                                    <?php
				                                      echo $formortu->alasan;
				                                    ?>
				                      </th></tr>
				                      <tr>
				                          <th align="left">
				                                <label><b><hr/><?=$no++.'. '?>Bagaimana Bapak/Ibu menggambarkan perilaku/karakteristik anak Anda pada saat di rumah atau saat melakukan kegiatan sehari-hari?</b></label>
				                          </th></tr>
				                      <tr>
				                        <th>
				                                      <?php
				                                        echo $formortu->gambarananak;
				                                      ?>
				                        </th></tr>
				                        <tr>
				                            <th align="left">
				                                  <label><b><hr/><?=$no++.'. '?>Apa hambatan/permasalahan yang pernah dialami oleh anak (baik secara sosial maupun akademik)?</b></label>
				                            </th></tr>
				                        <tr>
				                          <th>
																			<?php
																									echo $formortu->hambatananak;
				                                        ?>
				                          </th></tr>
				                          <tr>
				                              <th align="left">
				                                    <label><b><hr/><?=$no++.'. '?>Bagaimana hubungan anak anda dengan keluarga?</b></label>
				                              </th></tr>
				                              <tr>
				                                  <th align="left">
				                                        <label>Ceritakan sebuah pengalaman dimana anak Anda berinteraksi dengan saudaranya!</label>
				                                  </th></tr>

				                          <tr>
				                            <th>
																				<?php
																										echo $formortu->pengalamananak;
				                                          ?>
				                            </th></tr>
				                            <tr>
				                                <th align="left">
				                                      <label>Bagaimana hubungan anak anda dengan saudara-saudaranya?</label>
				                                </th></tr>

				                        <tr>
				                          <th>
				                                        <?php
																									echo $formortu->hubungansaudara;
				                                        ?>
				                          </th></tr>
				                          <tr>
				                              <th align="left">
				                                    <label><b><?=$no++.'. '?>Bagaimana pola asuh yang Anda terapkan?</b></label>
				                              </th></tr>
				                              <tr>
				                                  <th align="left">
				                                        <label>Ceritakan sebuah pengalaman dimana anak Anda dihadapkan pada sebuah aturan yang mengikat! </label>
				                                  </th></tr>

				                          <tr>
				                            <th>				                                          <?php
																										echo $formortu->peraturananak;
				                                          ?>
				                            </th></tr>
				                            <tr>
				                                <th align="left">
				                                      <label>Apa yang saat itu Anda lakukan?</label>
				                                </th></tr>

				                        <tr>
				                          <th>
				                                        <?php
																									echo $formortu->peranortu;
				                                        ?>
				                          </th></tr>
				                          <tr>
				                              <th align="left">
				                                    <label>Bagaimana respon dari anak Anda?</label>
				                              </th></tr>

				                          <tr>
				                          <th>
				                                      <?php
																								echo $formortu->responanak;
				                                      ?>
				                          </th></tr>
				                          <tr>
				                              <th align="left">
				                                    <label><b><hr/><?=$no++.'. '?>Bagaimana harapan Bapak/Ibu inginkan dari peran seorang tutor? </b></label>
				                              </th></tr>

				                          <tr>
				                          <th>
				                                      <?php
																								echo $formortu->harapanortu_tutor;
				                                      ?>
				                          </th></tr>
				                          <tr>
				                              <th align="left">
				                                    <label><b><hr/><?=$no++.'. '?>Bagaimana harapan Bapak/Ibu terhadap anak selama menempuh pendidikan di “Homeschooling” Kak Seto? </b></label>
				                              </th></tr>

				                          <tr>
				                          <th>
				                                      <?php
																								echo $formortu->harapanortu_pendidikan;
				                                      ?>
				                          </th></tr>

				                          <tr>
				                              <th align="left">
				                                    <label><h3>Psikologis Anak</h3></label>
				                              </th></tr>

				                          <tr>

				                          <tr>
				                              <th align="left">
				                                    <label><b><?=$no++.'. '?>Apakah anak Anda pernah mengikuti pemeriksaan psikologis?
				                                    </b></label>
																						 <?php echo  $CI->p_c->cekaktif($formortu->psikologisanak1)?>
				                              </th></tr>
				                        <tr>
				                            <th align="left">
				                                  <label><b><?=$no++.'. '?>Apakah anak Anda pernah mengalami masalah psikologis? (Contoh: kecemasan, spektrum autisme, dll)
				                                  </b></label>
																					<?php echo  $CI->p_c->cekaktif($formortu->psikologisanak2)?>
				                            </th></tr>
				                      <tr>
				                          <th align="left">
				                                <label><b><?=$no++.'. '?>Apakah anak Anda (pernah) mempunyai masalah terkait atensi/kemampuan konsentrasi/tidak bisa duduk tenang?
				                                </b></label>
																				<?php echo  $CI->p_c->cekaktif($formortu->psikologisanak3)?>
				                          </th></tr>
				                    <tr>
				                        <th align="left">
				                              <label><b><?=$no++.'. '?>Apakah anak Anda memiliki masalah dalam perkembangan? (Contoh: masalah tumbuh kembang anak)
				                              </b></label>
																			<?php echo  $CI->p_c->cekaktif($formortu->psikologisanak4)?>
				                        </th></tr>
				                  <tr>
				                      <th align="left">
				                            <label><b><?=$no++.'. '?>Apakah anak Anda pernah/memiliki masalah kesehatan fisik?
				                            </b></label>
																		<?php echo  $CI->p_c->cekaktif($formortu->psikologisanak5)?>
				                      </th></tr>
				                  <tr>
				                      <th align="left">
				                            <label><b><?=$no++.'. '?>Apakah anak Anda memiliki keterbatasan fisik? (Contoh: penglihatan, pendengaran, dll)
				                            </b></label>
																		<?php echo  $CI->p_c->cekaktif($formortu->psikologisanak6)?>
				                      </th></tr>
				                  <tr>
				                      <th align="left">
				                            <label><b><?=$no++.'. '?>Apakah anak Anda menggunakan alat bantu indra? (Contoh: kacamata, alat bantu dengar, dll)
				                            </b></label>
																		<?php echo  $CI->p_c->cekaktif($formortu->psikologisanak7)?>
				                      </th></tr>
				                <tr>
				                    <th align="left">
				                          <label><b><?=$no++.'. '?>Jika anak Anda dalam masa pengobatan, mohon isi kolom berikut ini:
				                          </b></label>
																	<?php echo  $CI->p_c->cekaktif($formortu->psikologisanak8)?>
				                    </th></tr>
				              </table>
									  </div>
										<div class="tab-pane" id="tab_4"><br/>  <!-- Formulir Data Orangtua -->
											<table border="1" cellpadding="0" style="border-collapse:collapse" cellspacing="0" width="100%" >
												<thead>
													<tr>
															<th width="30px">No.</th>
															<th width="150px">Dokumen Tipe</th>
															<th>Nama File</th>
													</tr>
												</thead>
												<tbody>
															<?php
															$CI =& get_instance();$no=1;
															$url=str_replace('sik','ereg',base_url());
															foreach((array)$persyaratan as $rowattachment) {
																	echo "<tr>";
																	echo "<td>".$no++."</td>";
																	echo "<td>".$rowattachment->dokumentipetext."</td>";
																	echo "<td align='left'><a href='".$url."uploads/calonsiswa/".$rowattachment->newfile."' target='_blank'>".$rowattachment->file."</td>";
																	echo "</tr>";
															}
															?>
												</tbody>
												<tfoot>
												</tfoot>
											</table>
										</div>
										<div class="tab-pane" id="tab_5"><br/>  <!-- Jadwal -->
											<H3>Riwayat Jadwal Proses PPDB<H3>
											<table border="1" cellpadding="0" style="border-collapse:collapse" cellspacing="0" width="100%" >
											<?php
											echo "<tr>";
											echo "<th>No.</th>";
											echo "<th>Tanggal Mulai</th>";
											echo "<th>Tanggal Akhir</th>";
											echo "<th>Kegiatan</th>";
											echo "<th>Petugas</th>";
											echo "</tr>";
											$CI =& get_instance();$no=1;
											foreach((array)$jadwalppdb as $rowkeg) {
													echo "<tr>";
													echo "<td>".$no++."</td>";
													echo "<td>".$CI->p_c->tgl_indo($rowkeg->tgl_mulai)."</td>";
													echo "<td>".$CI->p_c->tgl_indo($rowkeg->tgl_akhir)."</td>";
													echo "<td>".$rowkeg->kegiatantext."</td>";
													echo "<td>".$CI->dbx->getpegawai($rowkeg->idpegawai,0,1)."</td>";
													echo "</tr>";
											}
											?>
										</table>
										<hr/>
										<H3>Riwayat Aktivasi CPD<H3>
										<table border="1" cellpadding="0" style="border-collapse:collapse" cellspacing="0" width="100%" >
										<?php
										echo "<tr>";
										echo "<th>No.</th>";
										echo "<th>Aktif</th>";
										echo "<th>Tanggal Akhir</th>";
										echo "<th>Kegiatan</th>";
										echo "<th>Petugas</th>";
										echo "<th>Tanggal</th>";
										echo "</tr>";
										$CI =& get_instance();$no=1;
										foreach((array)$calonsiswa_riwayat as $rowcsr) {
												echo "<tr>";
												echo "<td>".$no++."</td>";
												echo "<td>".$CI->p_c->cekaktif($rowcsr->aktif)."</td>";
												echo "<td>".$rowcsr->alasantext."</td>";
												echo "<td>".$rowcsr->keterangan."</td>";
												echo "<td>".$CI->dbx->getpegawai($rowcsr->created_by,0,1)."</td>";
												echo "<td>".$CI->p_c->tgl_indo($rowcsr->created_date)."</td>";
												echo "</tr>";
										}
										?>
									</table>
										</div>
										<div class="tab-pane" id="tab_6"><br/>  <!-- interview -->
											<table border="0" cellpadding="0" style="border-collapse:collapse" cellspacing="0" width="100%"  class="form-horizontal form-validate">
						          <?php
						            $no=1;$keg_id="";
						            foreach((array)$konseling as $rowkons) {
						              	$ns=$rowkons->replid;
														if($keg_id<>$rowkons->keg_id){
															echo "<tr>";
							                echo "<th align='left'>";
															echo "Petugas : ".$CI->dbx->getpegawai($rowkons->idpegawai,0,1);
															echo "<br/>Tanggal : ".$CI->p_c->tgl_indo($rowkeg->tgl_mulai);
															echo "<hr/></th></tr>";
														}
							              if ($rowkons->urutan == 255){
							                echo "<tr>";
							                echo "<th align='left'>";
							                echo "<label class='control-label' for='minlengthfield'>".$no++.". ".$rowkons->konseling."</label>";
							                if($rowkons->description<>""){
							                  echo $kelompoksiswa_opt[$rowkons->description];
							                }
							                echo "<hr/></th></tr>";
							              }elseif ($rowkons->urutan == 254){
							                echo "<tr>";
							                echo "<th align='left'>";
							                echo "<label class='control-label' for='minlengthfield'>".$no++.". ".$rowkons->konseling."</label>";
							                if($rowkons->description==1){
							                  echo " Anak";
															}else if($rowkons->description==2){
							                  echo " Placement Test";
															}else if($rowkons->description==0){
							                  echo " Orangtua dan Anak";
							                }
							                echo "<hr/></th></tr>";
							              }elseif (($rowkons->urutan == 253) or ($rowkons->urutan == 252) or ($rowkons->urutan == 251) or ($rowkons->urutan == 250)){
							                echo "<tr>";
							                echo "<th align='left'>";
							                echo "<label class='control-label' for='minlengthfield'>".$no++.". ".$rowkons->konseling."</label>";
							                echo $rowkons->description;
							                echo "<hr/></th></tr>";
							              }else{
							                echo "<tr>";
							                echo "<th align='left'>";
							                echo "<label>".$no++.". ".$rowkons->konseling;
							                if (trim($rowkons->keterangan)<>""){echo "<br/>( ".$rowkons->keterangan." )";}
							                echo "</label>";
							                echo "</th></tr>";
							                echo "<tr>";
							                echo "<th align='left'>";
							                echo "<p>".$rowkons->description."</p>";
							                echo "<hr/></th></tr>";
							              }
														$keg_id=$rowkons->keg_id;
						            }

						          ?>
						        </table>
										</div>
										<div class="tab-pane" id="tab_7"><br/>  <!-- hasil Asesmen -->
											<table border="0" cellpadding="0" style="border-collapse:collapse" cellspacing="0" width="100%"  class="form-horizontal form-validate">
											<?php
											$no5=0;
					            foreach((array)$observasi as $rowobs) {
					              $ns=$rowobs->replid;
					              if($rowobs->tipe_form<>"5"){
					                if($rowobs->tipe_form<>1){
					                  echo "<tr>";
					                  echo "<td align='left'>";
					                  echo "<label class='control-label' for='minlengthfield'><b>".$no++.". ".$rowobs->observasi."</b></label>";
					                  echo "<div class='control-group'>";
					                  echo "<div class='control'> ";
					                  //echo $rowobs->tipe_form;
					                }else{
					                  echo "<tr>";
					                  echo "<th align='left'>";
					                  echo "<label><b>".$no++.". ".$rowobs->observasi;
					                  if (trim($rowobs->keterangan)<>""){echo "<br/>( ".$rowobs->keterangan." )";}
					                  echo "</b></label>";

					                  echo "</th></tr>";
					                  echo "<tr>";
					                  echo "<td align='left'>";
					                  echo "<div class='control-group'>";
					                  echo "<div class='control'>";
					                }

					                if ($rowobs->tipe_form == 2){
					                  $sql_comboobservasi="SELECT replid,data as nama FROM observasi_data WHERE data_combo='".$rowobs->data_combo."' ORDER BY replid";
					                  $comboobservasi_opt = $CI->dbx->opt($sql_comboobservasi);
					                  if($rowobs->description<>""){
					                    echo $comboobservasi_opt[$rowobs->description];
					                  }
					                }elseif ($rowobs->tipe_form == 3){
					                  echo $rowobs->description;
					                }else{
					                  echo "<p align='justify'>";
					                  echo $rowobs->description;
					                  echo "</p>";
					                }
					                echo "</div></div></td></tr>";
					              }
					            } //tipe_dorm 5
					          ?>
					        </table>
										</div>
								</div> <!-- tab-content -->
	</div><!-- nav-tabs-custom -->
	<br/>
	<br/>
	<br/>
</center>
</body>
</html>
