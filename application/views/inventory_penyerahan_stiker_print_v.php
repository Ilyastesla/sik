<!DOCTYPE html>
<?php
$CI =& get_instance();
?>
<html>
<title><?php echo $form ?></title>
<style>
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
		font-family:'Source Sans Pro', sans-serif;
		font-size:8pt;
	}
	tr{ page-break-inside:avoid; page-break-after:auto }
	font{
		font-family:'Source Sans Pro', sans-serif;
		font-size:11pt;
	}
</style>
<body>
	<center >
						<table border="0" cellpadding="10" cellspacing="5" width="100%" align="left">
								<tr>
										<td align="left" valign="top">
													<?php
													echo "<table border=0; cellpadding='4'>";
													if (!empty($material)){
													$no=1;
													foreach($material as $row) {
															$noinventaris=$CI->inventory_penyerahan_db->noinventaris_db($row->idpermintaan_barang,$row->idmaterial,$row->replid);
															foreach((array)$noinventaris as $rownoinventaris) {
																//echo $no."---".($no % 2)."<br/>";
																if(($no % 2)<>0){
																	echo "<tr>";
																}
																echo "<td align='center'>";
																//echo $no."---".($no % 2)."<br/>";
																echo "<table style='border-collapse:collapse;border-color:black;' border='1' width='350'>";
																echo "<tr><td align='center' rowspan='6' width='75'><img src='".base_url()."images/logokpp.png' height='35'></td></tr>";
																echo "<tr><th align='left' width='75'>No. Inventaris</th><td>&nbsp;&nbsp;".$rownoinventaris->kode_inventaris."</td><tr>";
																echo "<tr><th align='left'>Material</th><td>&nbsp;&nbsp;".strtoupper($row->materialtext)."</td></tr>";
																echo "<tr><th align='left'>Perusahaan</th><td>&nbsp;&nbsp;".strtoupper($isi->company)."</td></tr>";
																echo "<tr><th align='left'>Departemen</th><td>&nbsp;&nbsp;".strtoupper($isi->departemen)."</td></tr>";
																$no++;
																//echo "<tr><td align='center' colspan='2'></td></tr>";
																echo "</table>";
																echo "</td>";
																if(($no % 2)==0){
																	//echo "</tr>";
																}
															}

													} //for
												} // if
												echo "</table>";
												?>
										</td>
						</tr>
						</table>
        </center>
        </section>
</body>
<!--
	<script language="javascript">
		window.print();
	</script>
-->
</html>
