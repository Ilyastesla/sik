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
		width: 70% !important;
	}

</style>
<body>
	<center >

	<!--
	<img src="<?php echo base_url(); ?>images/logo_all.png" width="190" />
-->
	<br/>	<br/>	<br/>	<br/>	<br/>	<br/><br/>
		<!-- "KAZETO PUTRA PERKASA" <br/> -->
		<b><font size="+1"><u>SURAT REFERENSI</u></font><br/></b>
	<?php echo 'Nomor: '.$isi->no_sk; ?>
<br /><br />
<table border="0">
	<tr>
		<td>
			<p>Yang bertanda tangan di bawah ini, menerangkan bahwa:</p>
				<center>
				<table border="0" width="80%">
					<tr height="24">
						<td>Nama</td><td>:</td><td align="left"><b><?php echo $CI->dbx->getpegawai($isi->idpegawai) ?></b></td>
					</tr>
					<tr height="24">
						<td>NIK</td><td>:</td><td align="left"><b><?php echo $isi->nip?></b></td>
					</tr>
					<tr height="24">
						<td>Jabatan</td><td>:</td align="left"><td><b><?php echo $isi->jabatantext?></b></td>
					</tr>
				</table>
			</center>
			<br/>
			<p align="justify">adalah benar karyawan <b>PT. KAZETO PUTRA PERKASA</b>, yang ditugaskan sejak tanggal <?php echo $CI->p_c->tgl_indo($isi->tanggal_bekerja) ?>
				dan yang bersangkutan telah mengundurkan diri pada <?php echo $CI->p_c->tgl_indo($isi->tanggal_keluar) ?> atas keinginannya sendiri.</p>
			<p align="justify">Selama bekerja di <b>PT. KAZETO PUTRA PERKASA</b> yang bersangkutan menunjukkan kinerja yang baik.</p>
			<p align="justify">Demikian surat keterangan ini dibuat, agar dapat dipergunakan sebagaimana mestinya. Atas perhatian dan kerjasamanya kami ucapkan terima kasih.</p>
				<br /><table border="0">
					<tr>
						<td align="left">Tangerang Selatan, <?php echo $CI->p_c->tgl_indo($isi->tanggal_surat) ?></td>
					</tr>
					<tr>
						<td align="left"><b>PT. KAZETO PUTRA PERKASA</b></td>
					</tr>
					<tr>
						<td height="80">&nbsp;</td>
					</tr>
					<tr>
						<td align="left"><b><u><?php echo "Dimas Ramdani Triputra, S.E., M.M., M.I.Kom." ?></u></b><br/> Manajer SDM</td>
					</tr>
				</table>
		</td>
	</tr>
</table>
</center>
</body>
<?php if($word<>1) { ?>
	<script language="javascript">
		window.print();
	</script>
<?php } ?>
</html>
