<!DOCTYPE html>
<?php
$CI =& get_instance();
/*
if ($excel==1){
	header('Content-Type: application/vnd.ms-excel'); //IE and Opera
	header('Content-Type: application/x-msexcel'); // Other browsers
	header('Content-Disposition: attachment; filename=rapot.xls');
	header('Expires: 0');
	header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
}
*/
?>
<html>
<title><?php echo $form ?></title>
<!--
.lpd {
	font-family:'Source Sans Pro', sans-serif;
	font-size:7pt;
	width: 85% !important;
}
-->
<link href="<?php echo base_url(); ?>css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<style>
	@page {
		  size: A4;
		  width:297mm;
		  height:210mm;
		  margin-left: 0;
			margin-right: 0;
			margin-top: default;
			margin-bottom: 100px;
		}
	table{
		font-family:'Source Sans Pro', sans-serif;
		font-size:10pt;
		width: 90% !important;
	}

	font{
		font-family:'Source Sans Pro', sans-serif;
		font-size:10pt;
	}
	@media print {
        .breaktable {
        	page-break-inside:avoid !important;
		    	page-break-after: auto;
		  	}
     }
</style>
<body>
	<center >
	<img src="<?php echo base_url(); ?>images/logo_all.png" width="190" />
	<h2><?php echo $form ?> <?php echo $form_small ?> <?php
		echo $CI->p_c->tgl_indo($isi->tanggalkegiatan);
	?></h3>
	<table width="100%" border="0">
			<tr>
				<th align="left">Tipe Proses
			</td><td>:</td><td>
							<?php
								echo $isi->prosestipe;
							?>
						</th>
						<th align="left">Mata Pelajaran</td><td>:</td><td>
									<?php
										echo $isi->matpel;
									?>
							</th>
					</tr>
				<tr>
				<th align="left">Tahun Pelajaran
			</td><td>:</td><td>
							<?php
								echo $isi->tahunajaran;
							?>
				</th>
				<th align="left">Kelas</td><td>:</td><td>
							<?php
								echo $isi->kelas;
							?>
				</th>
			</tr>
				<tr>
					<th align="left">Semester</td><td>:</td><td>
								<?php
									echo $isi->periode;
								?>
					</th>
				<th align="left">Tema</td><td>:</td><td>
							<?php
								echo $isi->keterangan;
							?>
					</th>
			</tr>
				</table>
		<table>
			<tr>
				<td align="left"><hr/><b>Legend Keterangan: D=Terdaftar, A= Alpha, S=Sakit, I= Izin, TP=Tugas Pengganti</b></td>
			</tr>
			<?php
			echo "<tr><td>";
			$no=1;
			echo "<b>Legend Nilai: ";
			foreach((array)$pengembangandirivariabel as $rowpdv) {
				echo $no++.". ".ucwords(strtolower($rowpdv->pengembangandirivariabel))."&nbsp;&nbsp;&nbsp;";
			}
			echo "</b></td></tr>";
			?>
		</table><br/>
		<table style="border-collapse:collapse" border="1" cellpadding="2">
			<tr>
				<th width="30" align="center">No.</th>
				<th width="80" align="center">NIS</th>
				<th>Nama</th>
				<th width="80">TTD</th>
				<!--
				<th width="30">D</th>
				<th width="30">A</th>
				<th width="30">S</th>
				<th width="30">I</th>
				<th width="30">TP</th>
			-->
				<?php
					$pdv="";$no=1;
					foreach((array)$pengembangandirivariabel as $rowpdv) {
						if($pdv<>""){$pdv=$pdv.',';}
						echo "<td width='30' align='center'><b>".$no++."</b></td>";
						//echo "<th>".ucwords(strtolower($rowpdv->pengembangandirivariabel))."</th>";
						$pdv=$pdv.$rowpdv->replid;
					}
				?>
		 </tr>
		 <?php
			 $rs="";$no=1;
			 foreach((array)$siswa as $rowsiswa) {
				 if($isi->nonreguler<>1){
					 $idregionsiswa=$rowsiswa->siswaregion;
				 }else{
					 $idregionsiswa=$rowsiswa->regionalstatus;
				 }

				 if ($rowsiswa->region<>""){
						$idregionpdn=$rowsiswa->region;
				 }else{
						$idregionpdn=$idregionsiswa;
				 }

				echo "<tr align='center'>";
				echo "<td height='60'>".$no++."</td>";
				echo "<td>".$rowsiswa->nis."</td>";
				echo "<td align='left'>".$rowsiswa->nama."</b>";
				//echo "<br/>Regional: ".$rowsiswa->regiontext." <br/> Tgl. Msk : ".$CI->p_c->tgl_indo($rowsiswa->tgl_masuk);

				echo "</td>";
				echo "<td>&nbsp;</td>";
				/*
				echo "<td>&nbsp;</td>";
				echo "<td>&nbsp;</td>";
				echo "<td>&nbsp;</td>";
				echo "<td>&nbsp;</td>";
				*/
					$pdv="";
					foreach((array)$pengembangandirivariabel as $rowpdv) {
						echo "<td>&nbsp;</td>";
					}
				echo "</tr>";
			 }
			 echo "</table>"
			 ?>
			 <br/><br/>
			 <table border="0" class='breaktable'>
			 <tr>
				 	 <td width="65%">&nbsp;</td>
					 <td align="center"><b>Tangerang Selatan, <?php echo $CI->p_c->tgl_indo($isi->tanggalkegiatan); ?></b></td>
				 </tr>
				 <tr>
					  <td></td>
					 	<td height="80px">&nbsp;</td>
				 </tr>
				 <tr align="right">
					 	<td></td>
					 	<td align="center"><?php echo " Oleh ".$CI->dbx->getpegawai($isi->created_by,0,0); ?></td>
				 </tr>
			 </table>
        </center>
        </section>
</body>

<script language="javascript">
	window.print();
</script>
</html>
