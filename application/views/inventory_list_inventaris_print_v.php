<!DOCTYPE html>
<?php
$CI =& get_instance();
if ($excel==1){
	header('Content-Type: application/vnd.ms-excel'); //IE and Opera
	header('Content-Type: application/x-msexcel'); // Other browsers
	header('Content-Disposition: attachment; filename=kaskecil.xls');
	header('Expires: 0');
	header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
}
?>
<html>
<title><?php echo $form ?></title>
<style>
	table {
		font-family:'Source Sans Pro', sans-serif;
		font-size:12px;
		width: 100% !important;
	}
</style>
<body>
	<table border="0">
		<tr>
			<th colspan="17" align="center"><img src="<?php echo base_url(); ?>images/logo_all.png" width="190" /><br/><h1><?php echo $form ?></h1></th>
		</tr>
	</table>
		<?php
			$style="";
			if ($excel<>1){
				$style="style='border-collapse:collapse;'";
			}

		?>
		<table <?php echo $style ?> border="1">
		<?php
				                                    echo "<tr bgcolor='#f3f4f5'>";
				                                    	echo "<th width='50'>No.</th>";
                                                        echo "<th>No. Inventaris</th>";
				                                    	echo "<th>Nama Material</th>";
                                                        echo "<th>No. Permintaan</th>";
                                                        echo "<th>Unit Bisnis</th>";
                                                        echo "<th>Departemen</th>";
				                                    	echo "<th>Kelompok Fiskal</th>";
                                                        echo "<th>Ruangan</th>";
				                                        echo "<th>Kelompok Inventaris</th>";
                                                        echo "<th>Kondisi</th>";
                                                        echo "<th>Hargabeli</th>";
                                                    echo "</tr>";
                                                    $no2=1;
											    foreach((array)$show_table as $row) {
												    echo "<tr>";
												    echo "<td align='center'>".$no2++."</td>";
												    
                                                    echo "<td>".$row->kode_inventaris;
                                                    echo "<br/>Tgl. Serah: ".$CI->p_c->tgl_indo($row->tanggalserah);
                                                    echo "<br/>Pemohon: ".$CI->dbx->getpegawai($row->idpemohon,0,1);
                                                    echo "</td>";
                                                    echo "<td>";
                                                    echo strtoupper("[".$row->merek."] ".$row->nama);
                                                    echo "<br/>Kel. Barang: ".$row->kelompokbarang;
                                                    echo "</td>";
                                                    echo "<td>";
												    echo $row->kode_transaksi;
												    echo "</td>";
                                                    echo "<td>".$row->companytext."</td>";
                                                    echo "<td>".$row->departementext."</td>";
                                                    //echo "<td>".$row->kode_inventaris."</td>";
												    
                                                    echo "<td>".strtoupper($row->fiskaltext)."</td>";
                                                    echo "<td>".strtoupper($row->ruangan)."</td>";
											    	echo "<td>".$row->kelompok_inventaris."</td>";
                                                    echo "<td>".$row->kondisi."</td>";
                                                    echo "<td>".$CI->p_c->rupiah($row->hpp)."</td>";
												    echo "</tr>";
												}
											    echo "</table>";
											    ?>
</body>
<?php if($excel<>1) { ?>
<script language="javascript">
	window.print();
</script>
<?php } ?>
</html>
