<?php $CI =& get_instance();?>
<html>
<head>
<title><?php echo $form.' ['.$form_small. ']' ?></title>
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
	<table width="100%">
	<tr height="50">
		<td colspan="3"><div align="center"><font size="4"><strong>IDENTITAS PESERTA DIDIK</strong></font></div><br /></td>
	</tr>
	<!--
	<tr>
	    <th width="26%" align="left" scope="row">
	      <strong>Departemen Terakhir/Aktif</strong></th>
	    <td align="left"><?php echo ucwords(strtoupper("<strong>:&nbsp;".$isi->departemen))?>
	    </strong></td>
	</tr>
	<tr>
	    <th align="left" scope="row"><strong>Tahun Ajaran Terakhir/Aktif</strong></th>
	    <td align="left"><?php echo ucwords(strtoupper("<strong>:&nbsp;".$isi->tahunajaran))?>
	    </strong></td>
	</tr>
	<tr>
	    <th align="left" scope="row"><strong>Kelas Terakhir/Aktif</strong></th>
	    <td align="left"><?php echo ucwords(strtoupper("<strong>:&nbsp;".$isi->tingkat." - ".$isi->kelas))?>
	    </strong></td>
	</tr>
	<tr>
		<td><strong>NIS Terakhir/Aktif</strong></td>
	    <td><strong>:&nbsp;
			<?php echo $isi->nis?></strong></td>
		<td width="50%" rowspan="2" align="right" valign="bottom">
	      <input type="hidden" name="replid" id="replid" value="<?php echo $replid?>" />
	      <a href="#" onclick="cetak('<?php echo $replid?>')"><img src="../images/ico/print.png" border="0"/>&nbsp;Cetak</a>&nbsp;&nbsp;
	      <a href="#" onclick="window.close();"><img src="../images/ico/exit.png" width="16" height="16" border="0" />&nbsp;Tutup</a></div>	</td>
	</tr>
	<tr>
	  <td><strong>N I S N</strong></td>
	  <td>:&nbsp;<?php echo $isi->nisn?></td>
	  </tr>
	 -->
	</table>
	<?php $n=1;?>
	<table border="0"  id="table" width="100%" cellpadding="0" style="border-collapse:collapse;" cellspacing="0">
	<tr>
		<td valign="top" align="right" height="15"><?php echo $n++;?>.</td>
		<td valign="top" width="40">&nbsp;</td>
		<td valign="top" align="left" width="180" valign="top"><?php echo ucwords(strtoupper("Nama Peserta Didik"))?></td>
		<td valign="top" align="center" width="40" valign="top">:</td>
		<td valign="top" align="left"><?php echo ucwords(strtoupper("<b>".$isi->nama."</b>"))?></td>
	</tr>
	<tr>
		<td valign="top" align="right" height="15"><?php echo $n++;?>.</td>
		<td valign="top">&nbsp;</td>
		<td valign="top" align="left"><?php echo ucwords(strtoupper("NISN"))?></td>
		<td valign="top" align="center">:</td>
		<td valign="top" align="left"><?php echo ucwords(strtoupper($isi->nisn))?></td>
	</tr>
	<tr>
		<td valign="top" align="right" height="15"><?php echo $n++;?>.</td>
		<td valign="top">&nbsp;</td>
		<td valign="top" align="left"><?php echo ucwords(strtoupper("Nomor Induk"))?></td>
		<td valign="top" align="center">:</td>
		<td valign="top" align="left"><?php echo ucwords(strtoupper($isi->nis))?></td>
	</tr>
	<tr>
		<td valign="top" align="right" height="15"><?php echo $n++;?>.</td>
		<td valign="top">&nbsp;</td>
		<td valign="top" align="left"><?php echo ucwords(strtoupper("Tempat dan Tanggal Lahir"))?></td>
		<td valign="top" align="center">:</td>
		<td valign="top" align="left"><?php echo ucwords(strtoupper($isi->tmplahir))?>&nbsp;<?php echo ucwords(strtoupper($CI->p_c->tgl_indo($isi->tgllahir)))?></td>
	</tr>
	<tr>
		<td valign="top" align="right" height="15"><?php echo $n++;?>.</td>
		<td valign="top">&nbsp;</td>
		<td valign="top" align="left"><?php echo ucwords(strtoupper("Jenis Kelamin"))?></td>
		<td valign="top" align="center">:</td>
		<td valign="top" align="left"><?php if  ($isi->kelamin=="l"){echo ucwords(strtoupper("Laki-laki"));}else if ($isi->kelamin=="p"){echo ucwords(strtoupper("Perempuan"));}?></td>
	</tr>
	<tr>
		<td valign="top" align="right" height="15"><?php echo $n++;?>.</td>
		<td valign="top">&nbsp;</td>
		<td valign="top" align="left"><?php echo ucwords(strtoupper("Agama"))?></td>
		<td valign="top" align="center">:</td>
		<td valign="top" align="left"><?php echo ucwords(strtoupper($isi->agama))?></td>
	</tr>
	<tr>
		<td valign="top" align="right" height="15"><?php echo $n++;?>.</td>
		<td valign="top">&nbsp;</td>
		<td valign="top" align="left"><?php echo ucwords(strtoupper("Anak ke"))?></td>
		<td valign="top" align="center">:</td>
		<td valign="top" align="left"><?php echo ucwords(strtoupper($isi->anakke))?></td>
	</tr>
	<!--
	<tr>
		<td valign="top" align="right" height="15"><? // php echo $n++; ?>.</td>
		<td valign="top">&nbsp;</td>
		<td valign="top" align="left"><?php echo ucwords(strtoupper("Status Dalam Keluarga"))?></td>
		<td valign="top" align="center">:</td>
		<td valign="top" align="left"><?php echo ucwords(strtoupper($isi->statanak))?></td>
	</tr>
	-->
	<tr>
		<td valign="top" align="right" height="15"><?php echo $n++;?>.</td>
		<td valign="top">&nbsp;</td>
		<td valign="top" align="left"><?php echo ucwords(strtoupper("Alamat Peserta Didik"))?></td>
		<td valign="top" align="center">:</td>
		<td valign="top" align="left">
			<?php
			$provtext="";
			if($isi->provinsitext<>"Luar Negeri"){
				$provtext=" ".$isi->provinsitext;
			} 
			echo ucwords(strtoupper($isi->alamatsiswa))."&nbsp;". ucwords(strtoupper($isi->kota))." ".ucwords(strtoupper($isi->kodepossiswa)).ucwords(strtoupper($provtext))." ".ucwords(strtoupper($isi->negara))
			?></td>
	</tr>
	<!--
	<tr>
		<td valign="top" align="right" height="15">&nbsp</td>
		<td valign="top">&nbsp;</td>
		<td valign="top" align="left"><?php echo ucwords(strtoupper("Telepon"))?></td>
		<td valign="top" align="center">:</td>
		<td valign="top" align="left"><? echo $isi->telponsiswa;if (($isi->telponsiswa<>"")and ($isi->hpsiswa<>"")){echo " / ";}$isi->hpsiswa;?></td>
	</tr>
	-->
	<tr>
		<td valign="top" align="right" height="15"><?php echo $n++;?>.</td>
		<td valign="top">&nbsp;</td>
		<td valign="top" align="left" colspan="3"><?php echo ucwords(strtoupper("Diterima dalam Program Paket"))?> <?php if  ($isi->departemen=="SD"){echo "A";} else if ($isi->departemen=="SMP"){echo "B";} else if ($isi->departemen=="SMA"){echo "C";} ?> <?php echo ucwords(strtoupper("di Lembaga Ini"))?></td>
		</tr>
	<tr>
		<td valign="top" align="right" height="15">&nbsp;</td>
		<td valign="top">&nbsp;</td>
		<td valign="top" align="left"><?php echo ucwords(strtoupper("Ditingkat"))?></td>
		<td valign="top" align="center">:</td>
		<td valign="top" align="left"><?php echo ucwords(strtoupper($isi->tingkatcover))?></td>
	</tr>
	<tr>
		<td valign="top" align="right" height="15">&nbsp;</td>
		<td valign="top">&nbsp;</td>
		<td valign="top" align="left"><?php echo ucwords(strtoupper("Pada Tanggal"))?></td>
		<td valign="top" align="center">:</td>
		<td valign="top" align="left"><?php echo ucwords(strtoupper($CI->p_c->tgl_indo($isi->tgl_masuk))) ?></td>
	</tr>
	<!--
	<tr>
		<td valign="top" align="right" height="15">&nbsp;</td>
		<td valign="top">&nbsp;</td>
		<td valign="top" align="left"><?php echo ucwords(strtoupper("Semester"))?></td>
		<td valign="top" align="center">:</td>
		<td valign="top" align="left"><?php echo ucwords(strtoupper($isi->proses))?></td>
	</tr>
	-->
	<tr>
		<td valign="top" align="right" height="15"><?php echo $n++;?>.</td>
		<td valign="top">&nbsp;</td>
		<td valign="top" align="left"><?php echo ucwords(strtoupper("Pendidikan Asal"))?></td>
		<td valign="top" align="center"></td>
		<td valign="top" align="left"></td>
	</tr>
	<tr>
		<td valign="top" align="right" height="15">&nbsp;</td>
		<td valign="top">&nbsp;</td>
		<td valign="top" align="left"><?php echo ucwords(strtoupper("Nama Lembaga"))?></td>
		<td valign="top" align="center">:</td>
		<td valign="top" align="left"><?php echo ucwords(strtoupper($isi->asalsekolah)) ?></td>
	</tr>
	<!--
	<tr>
		<td valign="top" align="right" height="15">&nbsp;</td>
		<td valign="top">&nbsp;</td>
		<td valign="top" align="left"><?php echo ucwords(strtoupper("Alamat"))?></td>
		<td valign="top" align="center">:</td>
		<td valign="top" align="left"><?php echo ucwords(strtoupper(""));?></td>
	</tr>
	-->
	<?php if ($isi->departemen<>"SD"){ ?>
	<tr>
		<td valign="top" align="right" height="15"><?php echo $n++;?>.</td>
		<td valign="top">&nbsp;</td>
		<td valign="top" align="left"><?php echo ucwords(strtoupper("Ijazah"))?></td>
		<td valign="top" align="center" colspan="2	"></td>
	</tr>
	<tr>
		<td valign="top" align="right" height="15">&nbsp;</td>
		<td valign="top">&nbsp;</td>
		<td valign="top" align="left"><?php echo ucwords(strtoupper("Tahun"))?></td>
		<td valign="top" align="center">:</td>
		<td valign="top" align="left"><?php echo ucwords(strtoupper($isi->t_ijazah))?></td>
	</tr>
	<tr>
		<td valign="top" align="right" height="15">&nbsp;</td>
		<td valign="top">&nbsp;</td>
		<td valign="top" align="left"><?php echo ucwords(strtoupper("Nomor"))?></td>
		<td valign="top" align="center">:</td>
		<td valign="top" align="left"><?php echo ucwords(strtoupper($isi->ijazah))?></td>
	</tr>
	<tr>
		<td valign="top" align="right" height="15"><?php echo $n++;?>.</td>
		<td valign="top">&nbsp;</td>
		<td valign="top" align="left"><?php echo ucwords(strtoupper("Surat Keterangan Hasil Ujian Nasional (SKHUN)"))?></td>
		<td valign="top" align="center"></td>
		<td valign="top" align="left"></td>
	</tr>
	<tr>
		<td valign="top" align="right" height="15">&nbsp;</td>
		<td valign="top">&nbsp;</td>
		<td valign="top" align="left"><?php echo ucwords(strtoupper("Tahun"))?></td>
		<td valign="top" align="center">:</td>
		<td valign="top" align="left"><?php echo ucwords(strtoupper($isi->t_skh))?></td>
	</tr>
	<tr>
		<td valign="top" align="right" height="15">&nbsp;</td>
		<td valign="top">&nbsp;</td>
		<td valign="top" align="left"><?php echo ucwords(strtoupper("Nomor"))?></td>
		<td valign="top" align="center">:</td>
		<td valign="top" align="left"><?php echo ucwords(strtoupper($isi->skh))?></td>
	</tr>
	<?php } ?>
	<!--
	<tr>
		<td valign="top" align="right" height="15"><?//php echo $n++;?>.</td>
		<td valign="top">&nbsp;</td>
		<td valign="top" align="left"><?php echo ucwords(strtoupper("Laporan Hasil Belajar"))?></td>
		<td valign="top" align="center"></td>
		<td valign="top" align="left"></td>
	</tr>
	<tr>
		<td valign="top" align="right" height="15">&nbsp;</td>
		<td valign="top">&nbsp;</td>
		<td valign="top" align="left"><?php echo ucwords(strtoupper("Tahun"))?></td>
		<td valign="top" align="center">:</td>
		<td valign="top" align="left"><?php echo ucwords(strtoupper($isi->t_lhb))?></td>
	</tr>
	<tr>
		<td valign="top" align="right" height="15">&nbsp;</td>
		<td valign="top">&nbsp;</td>
		<td valign="top" align="left"><?php echo ucwords(strtoupper("Nomor"))?></td>
		<td valign="top" align="center">:</td>
		<td valign="top" align="left"><?php echo ucwords(strtoupper($isi->lhb))?></td>
	</tr>
	-->
	<tr>
		<td valign="top" align="right" height="15"><?php echo $n++;?>.</td>
		<td valign="top">&nbsp;</td>
		<td valign="top" align="left"><?php echo ucwords(strtoupper("Orang Tua"))?></td>
		<td valign="top" align="center"></td>
		<td valign="top" align="left"></td>
	</tr>
	<tr>
		<td valign="top" align="right" height="15">&nbsp;</td>
		<td valign="top">&nbsp;</td>
		<td valign="top" align="left"><?php echo ucwords(strtoupper("Ayah"))?></td>
		<td valign="top" align="center">:</td>
		<td valign="top" align="left"><?php echo ucwords(strtoupper($isi->namaayah))?></td>
	</tr>
	<tr>
		<td valign="top" align="right" height="15">&nbsp;</td>
		<td valign="top">&nbsp;</td>
		<td valign="top" align="left"><?php echo ucwords(strtoupper("Ibu"))?></td>
		<td valign="top" align="center">:</td>
		<td valign="top" align="left"><?php echo ucwords(strtoupper($isi->namaibu))?></td>
	</tr>
	<tr>
		<td valign="top" align="right" height="15"><?php echo $n++;?>.</td>
		<td valign="top">&nbsp;</td>
		<td valign="top" align="left"><?php echo ucwords(strtoupper("Alamat Orang Tua"))?></td>
		<td valign="top" align="center"></td>
		<td valign="top" align="left"></td>
	</tr>
	<tr>
		<td valign="top" align="right" height="15">&nbsp;</td>
		<td valign="top">&nbsp;</td>
		<td valign="top" align="left"><?php echo ucwords(strtoupper("Ayah"))?></td>
		<td valign="top" align="center">:</td>
		<td valign="top" align="left">
			<?php 
				$provayahtext="";
				if($isi->provinsi_ayahtext<>"Luar Negeri"){
					$provayahtext=" ".$isi->provinsi_ayahtext;
				} 
				echo ucwords(strtoupper($isi->alamat_ayah))."&nbsp;".ucwords(strtoupper($isi->kota_ayah))." ".$isi->kodepos_ayah.ucwords(strtoupper($provayahtext))."&nbsp;".ucwords(strtoupper($isi->negara_ayah))
			?></td>
	</tr>
	<tr>
		<td valign="top" align="right" height="15">&nbsp;</td>
		<td valign="top">&nbsp;</td>
		<td valign="top" align="left"><?php echo ucwords(strtoupper("Ibu"))?></td>
		<td valign="top" align="center">:</td>
		<td valign="top" align="left">
			<?php 
				$provibutext="";
				if($isi->provinsi_ibutext<>"Luar Negeri"){
					$provibutext=" ".$isi->provinsi_ibutext;
				} 
				echo ucwords(strtoupper($isi->alamat_ibu))."&nbsp;".ucwords(strtoupper($isi->kota_ibu))." ".ucwords(strtoupper($isi->kodepos_ibu)).ucwords(strtoupper($provibutext))."&nbsp;".ucwords(strtoupper($isi->negara_ibu))
			?></td>
	</tr>
	<tr>
		<td valign="top" align="right" height="15"><?php echo $n++;?>.</td>
		<td valign="top">&nbsp;</td>
		<td valign="top" align="left"><?php echo ucwords(strtoupper("Telepon Orang Tua"))?></td>
		<td valign="top" align="center"></td>
		<td valign="top" align="left"></td>
	</tr>
	<tr>
		<td valign="top" align="right" height="15">&nbsp;</td>
		<td valign="top">&nbsp;</td>
		<td valign="top" align="left"><?php echo ucwords(strtoupper("Ayah"))?></td>
		<td valign="top" align="center">:</td>
		<td valign="top" align="left"><?php echo $isi->tel_ayah;if (($isi->tel_ayah<>"") and (trim($isi->hp_ayah<>""))){echo " / ";} echo $isi->hp_ayah;?></td>
	</tr>
	<tr>
		<td valign="top" align="right" height="15">&nbsp;</td>
		<td valign="top">&nbsp;</td>
		<td valign="top" align="left"><?php echo ucwords(strtoupper("Ibu"))?></td>
		<td valign="top" align="center">:</td>
		<td valign="top" align="left"><?php echo $isi->tel_ibu;if (($isi->tel_ibu<>"")and ($isi->hp_ibu<>"")){echo " / ";} echo $isi->hp_ibu;?></td>
	</tr>
	<tr>
		<td valign="top" align="right" height="15"><?php echo $n++;?>.</td>
		<td valign="top">&nbsp;</td>
		<td valign="top" align="left"><?php echo ucwords(strtoupper("Pekerjaan Orang Tua"))?></td>
		<td valign="top" align="center"></td>
		<td valign="top" align="left"></td>
	</tr>
	<tr>
		<td valign="top" align="right" height="15">&nbsp;</td>
		<td valign="top">&nbsp;</td>
		<td valign="top" align="left"><?php echo ucwords(strtoupper("Ayah"))?></td>
		<td valign="top" align="center">:</td>
		<td valign="top" align="left"><?php echo ucwords(strtoupper($isi->pekerjaanayah))?></td>
	</tr>
	<tr>
		<td valign="top" align="right" height="15">&nbsp;</td>
		<td valign="top">&nbsp;</td>
		<td valign="top" align="left"><?php echo ucwords(strtoupper("Ibu"))?></td>
		<td valign="top" align="center">:</td>
		<td valign="top" align="left"><?php echo ucwords(strtoupper($isi->pekerjaanibu))?></td>
	</tr>
	<tr>
		<td valign="top" align="right" height="15"><?php echo $n++;?>.</td>
		<td valign="top">&nbsp;</td>
		<td valign="top" align="left"><?php echo ucwords(strtoupper("Wali"))?></td>
		<td valign="top" align="center">:</td>
		<td valign="top" align="left"><?php echo ucwords(strtoupper($isi->wali))?></td>
	</tr>
	<tr>
		<td valign="top" align="right" height="15"><?php echo $n++;?>.</td>
		<td valign="top">&nbsp;</td>
		<td valign="top" align="left"><?php echo ucwords(strtoupper("Alamat Wali"))?></td>
		<td valign="top" align="center">:</td>
		<td valign="top" align="left">
			<?php
				$provwalitext="";
				if($isi->provinsi_walitext<>"Luar Negeri"){
					$provwalitext=" ".$isi->provinsi_walitext;
				}  
				echo ucwords(strtoupper($isi->alamat_wali))."&nbsp;".ucwords(strtoupper($isi->kota_wali))." ".ucwords(strtoupper($isi->kodepos_wali)).ucwords(strtoupper($provwalitext))."&nbsp;".ucwords(strtoupper($isi->negara_wali))
			?></td>
	</tr>
	<tr>
		<td valign="top" align="right" height="15">&nbsp;</td>
		<td valign="top">&nbsp;</td>
		<td valign="top" align="left"><?php echo ucwords(strtoupper("Telepon"))?></td>
		<td valign="top" align="center">:</td>
		<td valign="top" align="left"><?php echo $isi->tel_wali;if (($isi->tel_wali<>"")and ($isi->hp_wali<>"")){echo " / ";} echo $isi->hp_wali;?></td>
	</tr>
	<tr>
		<td valign="top" align="right" height="15"><?php echo $n++;?>.</td>
		<td valign="top">&nbsp;</td>
		<td valign="top" align="left"><?php echo ucwords(strtoupper("Pekerjaan Wali"))?></td>
		<td valign="top" align="center">:</td>
		<td valign="top" align="left"><?php echo ucwords(strtoupper($isi->pekerjaanwali))?></td>
	</tr>
</table>
	<br/><br/>
	<table width="100%" border="0">
		<tr align="center">
			<td rowspan='4'>
				<?php
				echo "<table width='150px' height='200px' border=1 style='border-collapse:collapse'><tr>";
				echo "<td><img src='' />&nbsp;</td>";
				echo "</tr></table>";
				?>
			</td>
			<td rowspan='4' width='200px'>&nbsp;</td>
			<td width='300px'><?php echo $isi->citytext; ?>, <?php echo $CI->p_c->tgl_indo($isi->tgl_masuk) ?>
				<br/><?php echo ucwords(strtolower("Kepala Akademik"))?> <?php echo strtoupper($isi->departemen)?>
			</td>
		</tr>
		<tr>
			<th height="110px"><?php //echo "<img src='http://192.168.33.99:8719/sihsks/uploads/ttd/".$isi->ttd."' height='60px' />" ?>&nbsp;</th>
		</tr>
		<tr align="center">
			<td><?php echo $CI->dbx->getpegawai($isi->idkepsek,0,0); ?></td>
		<tr>
	</table>

</center>
<script language="javascript">
	window.print();
</script>
</body>
</html>
