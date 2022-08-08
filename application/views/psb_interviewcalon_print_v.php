<!DOCTYPE html>
<?php
$CI =& get_instance();
/*
if ($word==1){
	header('Content-Type: application/vnd.ms-word'); //IE and Opera
	header('Content-Type: application/x-msword'); // Other browsers
	header('Content-Disposition: attachment; filename=<?php $isi->no_sk ?>.xls');
	header('Expires: 0');
	header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
}
*/
?>
<html>
<title><?php echo $form ?></title>
<link href="<?php echo base_url(); ?>css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<script src="<?php echo base_url(); ?>js/jquery2.min.js"></script>
<script src="<?php echo base_url(); ?>js/bootstrap.min.js" type="text/javascript"></script>

<link href="<?php echo base_url(); ?>css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<script src="<?php echo base_url(); ?>js/morris/morris.min.js" type="text/javascript"></script>
<link href="<?php echo base_url(); ?>js/morris/morris.css" rel="stylesheet" type="text/css" />
<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>

<style>
	body {
    font-family: "Times New Roman";
		Font-size:10pt;
	}
	@page {
		  size: A4;
		  width:210mm;
		  height:297mm;
		  margin-left: 0;
			margin-right: 0;
			margin-top: default;
			margin-bottom: 100px;
		}
	table {
		width: 85% !important;
	}

</style>
<body>
	<center >

	<!--
	<img src="<?php echo base_url(); ?>images/logo_all.png" width="190" />
-->
<?php echo $CI->dbx->getHeader($rowsiswa->departemen); ?>
		<!-- "KAZETO PUTRA PERKASA" <br/> -->
		<b><font size="+1"><?php echo $form; ?></font><br/></b>
<br /><br />
<table width="100%" border="0">
	<tr>
				<td align="left" width="200px"><b>No. Pendaftaran</b></td><td><b>:</b></td><td><?php echo $rowsiswa->nopendaftaran; ?></td>
	</tr>
	<tr>
				<td align="left"><b>Nama Calon Peserta Didik</b></td><td><b>:</b></td><td><?php echo $CI->p_c->jk($rowsiswa->kelamin); ?></td>
	</tr>
	<tr>
				<td align="left"><b>Jenis Kelamin</b></td><td><b>:</b></td><td><?php echo ucwords(strtolower($rowsiswa->nama)); ?></td>
	</tr>
	<tr>
				<td align="left"><b>Umur</b></td><td><b>:</b></td><td><?php echo $rowsiswa->umur; ?> Tahun</td>
	</tr>
	<tr>
				<td align="left"><b>Jenjang</b></td><td><b>:</b></td><td><?php echo $rowsiswa->departemen; ?></td>
	</tr>
	<tr>
				<td align="left"><b>Tingkat</b></td><td><b>:</b></td><td><?php echo $rowsiswa->tingkattext; ?></td>
	</tr>
	<tr>
				<td align="left"><b>Jadwal</b></td><td><b>:</b></td><td><?php echo $CI->p_c->tgl_indo($rowkegiatan->tgl_mulai) ; ?></td>
	</tr>
</table>
<table width="100%" border="0">
<?php
$no=1;
foreach((array)$konseling as $rowkons) {
  $ns=$rowkons->replid;
  if ($rowkons->urutan == 255){
    echo "<tr><th align='left' width='200'>";
    echo $no++.". ".$rowkons->konseling;
		echo "</th>";
		echo "<th align='center'>:</th>";
		echo "<td>";
    if($rowkons->description<>""){
      echo $kelompoksiswa_opt[$rowkons->description];
    }

    echo "</td></tr>";
  }elseif ($rowkons->urutan == 254){
    echo "<tr><th align='left' width='200'>";
    echo $no++.". ".$rowkons->konseling;
		echo "</th>";
		echo "<th align='center'>:</th>";
		echo "<td>";
    if($rowkons->description==1){
      echo " Anak";
    }else if($rowkons->description==0){
      echo " Orangtua dan Anak";
    }
    echo "</td></tr>";
  }elseif (($rowkons->urutan == 253) or ($rowkons->urutan == 252)){
    echo "<tr><th align='left' width='200'>";
    echo $no++.". ".$rowkons->konseling;
		echo "</th>";
		echo "<th align='center'>:</th>";
		echo "<td>";
		echo $rowkons->description;
    echo "</td></tr>";
  }else{
    echo "<tr><th align='left' colspan='3'><br/>";
    echo $no++.". ".$rowkons->konseling;
    if (trim($rowkons->keterangan)<>""){echo "( ".$rowkons->keterangan." )";}
    echo "</th></tr>";
		echo "<tr><td align='justify' colspan='3'>";
    echo $rowkons->description;
    echo "<br/><br/></td></tr>";
  }
}
?>
</table>
<br/><br/>
<table width="100%" border="0">
<tr>
	<td colspan="3" >&nbsp;</td><th align="center" width="250">Tangerang, <?php echo $CI->p_c->tgl_indo($rowsiswa->hariini) ?></th>
</tr>
<tr>
	<td colspan="4" align="right"><br/><br/><br/><br/></td>
</tr>
<tr>
	<td colspan="3" >&nbsp;</td><th align="center" width="200"><?php echo $CI->dbx->getpegawai($rowkegiatan->user,1,0) ?></th>
</tr>
</table>
</center>
</body>
<?php
//if($word<>1) {
?>
	<script language="javascript">
		window.print();
	</script>
<?php //}
?>
</html>
