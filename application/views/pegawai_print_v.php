<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http//www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php 
$CI =& get_instance();
if ($excel==1){
	header('Content-Type: application/vnd.ms-excel'); //IE and Opera  
	header('Content-Type: application/x-msexcel'); // Other browsers  
	header('Content-Disposition: attachment; filename=pegawai.xls');
	header('Expires: 0');  
	header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
}
?>
<html xmlns="http//www.w3.org/1999/xhtml">
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

</head>
<body>
<table border="0" cellpadding="10" cellspacing="5" width="100%" align="center">
	<tr>
		<td align="left" valign="top" colspan="2">
	
	&nbsp;<table border="0" cellpadding="0" cellspacing="0" width="100%">	
	
	<tr>		
		<td valign="top" align='center'>
			<img src="<?php echo base_url(); ?>images/logokpp.png" height="60">
			</td>		
	</tr>		
	<tr>
		<th><div align="center"><h4>DATA PEGAWAI PT.KAZETO PUTRA PERKASA</h4></div></th>
	</tr>
</table>

<center>
	<table style="border-collapse:collapse;width:90%;" border="1">
		<thead>
		<tr>
			<th>No.</th>
			<th>Perusahaan</th>
			<th>NIK</th>
			<th>Nama</th>
			<th>Alamat</th>
			<th>Umur</th>
			
															<!--
			<th>Jabatan</th>
			
			<th>Awal Kontrak</th>
															-->
															<th>Akhir Kontrak</th>
															<th>Sisa Kontrak (Hari)</th>
															<!--
			<th>AVG Kompetensi</th>
			-->
			<th>Aktif</th>
			<th>Aktif System</th>
		</tr>
		</thead>
		
		<tbody>
			<?php
			$CI =& get_instance();
			$nip="";$no=1;
			foreach((array)$show_table as $row) {
				if ($row->sisakontrak<=31){
					$bg="style='background-color:red;'";
				}else if($row->sisakontrak<=60){
					$bg="style='background-color:blue;'";
				}else{
					$bg="";
				} 
				echo "<tr>";
echo "<td align='center'>".$no++."</td>";
echo "<td align='center'>".strtoupper($row->companytext)."</td>";
				 echo "<td align='center'>".$row->nip."</td>";

				echo "<td align=''>".($row->nama)
						."<br/>(".strtoupper($row->panggilan).")</td>";
				echo "<td align='center'>".strtoupper($row->alamat_tinggal)
					  ."<br/>Telp. ".strtoupper($row->telpon)
					  ."<br/>HP. ".strtoupper($row->handphone)
					   ."<br/>Email. ".$row->email
					   ."</td>";
				echo "<td align='center'>".strtoupper($row->umur)."</td>";

					/*
				echo "<td align='center'>".strtoupper($row->idjabatan)
							."<hr>(".strtoupper($row->iddepartemen).")"
							."<hr>(".strtoupper($row->idpegawai_status).")"
							."</td>";
				
				echo "<td align='center'>".strtoupper($CI->p_c->tgl_indo($row->awal_kontrak))."</td>";
					*/
					echo "<td align='center'>".strtoupper($CI->p_c->tgl_indo($row->akhir_kontrak))."</td>";
					echo "<td align='center' ".$bg.">".strtoupper($row->sisakontrak)."</td>";
					//echo "<td align='center'>".$row->avg_kompetensi."</td>";
				echo "<td align='center'>".$CI->p_c->cekaktif($row->aktif)."</td>";
				if ($row->replidlogin<>""){
					echo "<td align='center'>";
					echo ($CI->p_c->cekaktif($row->loginaktif));
					echo "</td>";
				}else{
					echo "<td align='center' style='background-color:red;'>";
					echo "TIDAK ADA";
					echo "</td>";
				}
				echo "</tr>";
			}
			die;
			?>
		</tbody>
		<tfoot>
		</tfoot>
	</table>
</center>
</body>
<script language="javascript">
	window.print();
</script>
</html>