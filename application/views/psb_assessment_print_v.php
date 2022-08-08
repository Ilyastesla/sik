<!DOCTYPE html>
<?php
$CI =& get_instance();
if ($word==1){
	header('Content-Type: application/vnd.ms-word'); //IE and Opera
	header('Content-Type: application/x-msword'); // Other browsers
	header('Content-Disposition: attachment; filename=<?php $isi->no_sk ?>.xls');
	header('Expires: 0');
	header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
}
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
		Font-size:12pt;
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
	 <?php echo "<br/><br/><img src='".base_url()."images/logo_all.png' width='190' /><br/><br/>"; ?>
		<!-- "KAZETO PUTRA PERKASA" <br/> -->
		<b><font size="+1"><u>LAPORAN <?php echo strtoupper($rowform->judul)?></u></font><br/></b>
<br /><br />
<div class="form-horizontal form-validate">
<?php
echo $CI->dbx->getcalonsiswa($idcalon);
?>
</div>
<br/>
<table border="0">
<?php
$no=1;
if($tipedata==4){
  if(isset($observasidata5)){
	echo "<tr>";
	echo "<td align='left'>";
		echo "<table style='border-collapse:collapse;border-color:black;' border='1'>";
		echo "<tr>";
		echo "<th rowspan='2'>NO.</th>";
		echo "<th rowspan='2'>ASPEK PSIKOLOGIS</th>";
		echo "<th colspan='".COUNT($observasidata5)."'>KLASIFIKASI</th>";
		echo "</tr>";
		echo "<tr>";
		foreach((array)$observasidata5 as $obsdata) {
			echo "<th align='center'>".$obsdata->data."</th>";
		}
		echo "</tr>";
		foreach((array)$observasi5 as $rows5) {
			echo "<tr>";
			echo "<td>".$no++."</td>";
			echo "<td>".$rows5->observasi."</td>";
			foreach((array)$observasidata5 as $obsdata) {
				echo "<th align='center'>";
				if ($obsdata->replid==$rows5->description){
					echo "X";
				}
				//echo $obsdata->replid."-".$rows5->description;
				echo "</th>";
			}
			//echo "<td align='center'>X</td>";
			echo "<tr>";
		}

		echo "</table>";
	echo "</td></tr>";
}
}
//$no=1;
$no5=0;
foreach((array)$observasi as $rowobs) {
	$ns=$rowobs->replid;
	if($rowobs->tipe_form<>"5"){
		if($rowobs->tipe_form<>1){
			echo "<tr>";
			echo "<td align='left'>";
			echo "<label class='control-label' for='minlengthfield'><b>".$no++.". ".$rowobs->observasi."</b></label>";
			echo "<div class='control-group'>";
			echo "<div class='control'>: ";
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
<table border="0">
  <tr>
    <th>&nbsp;</th>
    <th colspan="2" align="right" colspan="2"><p align='right'>Tangerang Selatan, <?php echo $CI->p_c->tgl_indo($rowkegiatan->tgl_mulai) ?>&nbsp;&nbsp;&nbsp;&nbsp;</p></th>
  </tr>
  <tr align="center">

    <th>Orangtua/ Wali Siswa</th>
    <th width="35%">&nbsp;</th>
    <th>Psikolog</th>
  <tr>
  <tr>
    <td align="right"><br/><br/><br/><br/><br/></td>
    <th>&nbsp;</th>
    <th>&nbsp;</th>
  </tr>
  <tr align="center">
    <th>(_____________________)</th>
    <th>&nbsp;</th>
    <th><?php echo $CI->dbx->getpegawai($rowkegiatan->idpegawai,0,0) //.",S.Pd.,M.Si" ?></th>
  <tr>
</table>
</center>
</body>
<?php if($word<>1) { ?>
	<script language="javascript">
		window.print();
	</script>
<?php } ?>
</html>
