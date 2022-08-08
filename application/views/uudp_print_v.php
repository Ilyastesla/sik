<!DOCTYPE html>
<?php
$CI =& get_instance();

if (!empty($uudp)){
	foreach($uudp as $rowuudp) {
	   $kode_transaksi=$rowuudp->kode_transaksi;
	   $tanggalpenerima=$rowuudp->tanggalpenerima;
	   $nilaiuudp=$rowuudp->nilai;
	   $penerima=$rowuudp->penerima;
	   $totaluudp=$rowuudp->total;
	}
}
?>
<html>
<title><?php echo $form.' ['.$form_small.']'?></title>
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
		    		<!--<td width="*">&nbsp;</td>-->
		    		<td valign="top" align="left" width="60%">
		    			<font style="font-size:24px"><b><?php echo $form ?></b></font>
		    			<?php echo "<br/>".$form_small."<br/><br/>" ?>
		    			<table  border="0">
				    		<tr>
					            <td align="left" width="100">No. PPKB</td>
					            <td width="20">:</td>
					            <td align="left"><?php echo strtoupper($isi->kode_transaksi);?></td>
				            </tr>
				            <tr>
					            <td align="left" width="100">No. UUDP</td>
					            <td width="20">:</td>
					            <td align="left"><?php echo strtoupper($kode_transaksi);?></td>
				            </tr>
				            <tr>
					            <td align="left">Pemohon</td>
					            <td>:</td>
					            <td align="left"><?php echo strtoupper($isi->pemohontext);?></td>
				            </tr>
				            <tr>
					            <td align="left">Departemen</td>
					            <td>:</td>
					            <td align="left"><?php echo strtoupper($isi->departemen);?></td>
				            </tr>
				            <tr>
					            <td align="left">Tgl. Pengajuan</td>
					            <td>:</td>
					            <td align="left"><?php echo $CI->p_c->tgl_indo($isi->tanggalpengajuan);?></td>
				            </tr>
				            <tr>
					            <td align="left">Tgl. Terima</td>
					            <td>:</td>
					            <td align="left"><?php echo $CI->p_c->tgl_indo($tanggalpenerima);?></td>
				            </tr>
		    			</table>
		    		</td>
		    		<td width="*" valign="top">
			    		<table  border="0">
					    	<tr>
					    		<td><h3><?php echo strtoupper($isi->company);?></h3></td>
					    	</tr>
					    	<tr>
					    		<td><?php echo $isi->street.' '.$isi->zip;?></td>
					    	</tr>
					    	<tr>
					    		<td>No. Telp. <?php echo strtoupper($isi->phone);?></td>
					    	</tr>
					    	<tr>
					    		<td>Fax. <?php echo strtoupper($isi->fax);?></td>
					    	</tr>
					    	<tr>
					    		<td>Email. <?php echo $isi->email;?></td>
					    	</tr>
					    	<tr>
					    		<td><?php echo $isi->website;?></td>
					    	</tr>
					    </table>
		    		</td>
		    	</tr>
		    	</table>
                <table style="border-collapse:collapse" border="1">
                    <thead>
                    	<tr bgcolor="#f3f4f5">
	                    	<td colspan="9">Keperluan :</td>
                    	</tr>
                        <tr bgcolor="#f3f4f5">
                        	<th width="30">No.</th>
                        	<th width="120">Jenis</th>
                            <th width="400">Keperluan</th>
                            <th width="30">Jumlah</th>
                            <th width="90">Unit</th>
                            <th width="190">Perkiraan Harga Satuan</th>
                            <th width="190">Sub Total</th>
                            <th>LPJ</th>
                        </tr>
                    </thead>
                    <tbody>
                    	<?php
                    	$no=1;$jml_c=0;$jml_jasa=0;$jml_lain=0;$jkeperluan=0;
                    	if (!empty($keperluan)){
	                    	if (!empty($keperluan)){
								foreach($keperluan as $row) {
									$jml_c=$jml_c+$row->sub_total;
								    echo "<tr>";
								    echo "<td align='center'>".$no++."</td>";
								    echo "<td align=''>Material</td>";
								    echo "<td align=''>".$row->idmaterial."</td>";
								    echo "<td align='center'>".$row->jumlah."</td>";
								    echo "<td align='center'>".$row->idunit."</td>";
								    echo "<td align='right'>".$CI->p_c->rupiah($row->nilai)."</td>";
								    echo "<td align='right'>".$CI->p_c->rupiah($row->sub_total)."</td>";
								    echo "<td align='right'>&nbsp;</td>";
								    echo "</tr>";
								}
							}
						}
						if (!empty($jasa)){
							foreach($jasa as $rowjasa) {
								$jml_jasa=$jml_jasa+$rowjasa->sub_total;
							    echo "<tr>";
							    echo "<td align='center'>".$no++."</td>";
							    echo "<td align=''>Jasa</td>";
							    echo "<td align=''>".$rowjasa->idjasa."</td>";
							    echo "<td align=''>".$CI->p_c->tgl_indo($rowjasa->tgl_periode1)." s/d ".$CI->p_c->tgl_indo($rowjasa->tgl_periode2)."</td>";
							    echo "<td align='center'>".$rowjasa->jumlah."</td>";
							    echo "<td align='right'>".$CI->p_c->rupiah($rowjasa->nilai)."</td>";
							    echo "<td align='right'>".$CI->p_c->rupiah($rowjasa->sub_total)."</td>";
							    echo "<td align='right'>&nbsp;</td>";
							    echo "</tr>";
							}
						}
                    	if (!empty($lain)){
							foreach($lain as $rowlain) {
								$jml_lain=$jml_lain+$rowlain->sub_total;
							    echo "<tr>";
							    echo "<td align='center'>".$no++."</td>";
							    echo "<td align=''>Rekening Adjustment</td>";
							    echo "<td align=''>".$rowlain->keterangan." <b>[".$isi->idadjustmenttext."]</b>"."</td>";
							    echo "<td align='center'>".$rowlain->jumlah."</td>";
							    echo "<td align='center'>".$rowlain->idunit."</td>";
							    echo "<td align='right'>".$CI->p_c->rupiah($rowlain->nilai)."</td>";
							    echo "<td align='right'>".$CI->p_c->rupiah($rowlain->sub_total)."</td>";
							    echo "<td align='right'>&nbsp;</td>";
							}
						}
						$jkeperluan=$jml_c+$jml_lain+$jml_jasa;
						?>
						<tr><th colspan="6" align="right">Total Pengajuan :</th>
							<td align="right"><b><?php echo $CI->p_c->rupiah($jkeperluan)?></b></td>
							<td align="right"><b>&nbsp;</b></td>
						</tr>
						<tr><th colspan="6" align="right">Selisih :</th>
							<td align="right" colspan="2"><b></b></td>
						</tr>
                    </tbody>
                    <tfoot>
                    </tfoot>
                </table>
                <table style="font-size:12px;" border="0" width="100%">
	            	<?php
	            		//echo $CI->p_c->kalimatuang($minta);

	            	?>
	            	<tr>
			            <td align="left" colspan="2"><br/><b>Jumlah Dana Diterima : <?php echo $CI->p_c->rupiah($nilaiuudp) ?><i>(<?php echo $CI->p_c->kalimatuang($nilaiuudp) ?>.)</i></b></td>
			        </tr>
			        <tr>
			            <td align="left" colspan="2"><br/><b>Akumulasi Dana Diterima : <?php echo $CI->p_c->rupiah($totaluudp) ?><i>(<?php echo $CI->p_c->kalimatuang($totaluudp) ?>.)</i></b></td>
			        </tr>
			        <tr>
			            <td align="left" colspan="2"><br/><b>Sisa Dana Yang Belum Diterima: <?php echo $CI->p_c->rupiah($jkeperluan-$totaluudp) ?><i>(<?php echo $CI->p_c->kalimatuang($jkeperluan-$totaluudp) ?>.)</i></b></td>
			        </tr>
	             	<tr>
			            <td align="left" colspan="2"><br/><b>Total Selisih Terbilang : ........................................................................................................................................................................................................................<i></i></b></td>
			         </tr>


				     <tr>
			            <td align="left" width="60%"><b><br/>Tangerang Selatan, <?php echo $CI->p_c->tgl_indo($isi->tanggalpenerima);?></b></td>
			            <td align="left" width="40%"><b><br/>Tangerang Selatan,.......................................................</b></td>
			         </tr>
	            </table>
	            <!--
		    	<br/>
	     		<table style="border-collapse:collapse" border="1">
                    <thead>
                    	<tr bgcolor="#f3f4f5">
				            <td align="left" colspan="3">Termin Pembayaran :</td>
				         </tr>
                        <tr bgcolor="#f3f4f5">
                            <th>Tahapan</th>
                            <th>Jatuh Tempo</th>
                            <th>Nilai</th>
                        </tr>
                    </thead>
                    <tbody>
                    	<?php
                    	$jml_c2=0;$no=1;
                    	if (!empty($termin)){
							foreach($termin as $row) {
								$jml_c2=$jml_c2+$row->nilai;
							    echo "<tr>";
							    echo "<td align='center'>".$no++."</td>";
							    echo "<td align='center'>".$CI->p_c->tgl_indo($row->due_date)."</td>";
							    echo "<td align='right'>".$CI->p_c->rupiah($row->nilai)."</td>";
							    echo "</tr>";
							}
						}
						?>
						<tr bgcolor="#f3f4f5"><td colspan="2" align="right"><b>Total Termin :</b>&nbsp;&nbsp;</td>
							<td align="right"><b><?php echo $CI->p_c->rupiah($jml_c2)?></b></td>
						</tr>
                    </tbody>
                    <tfoot>
                    </tfoot>
                </table>
                <!--
                <br>
				<table style="border-collapse:collapse" border="1">
                    <thead>
                    	<tr bgcolor="#f3f4f5">
				            <td align="left" colspan="4">UUDP :</td>
				         </tr>
                        <tr bgcolor="#f3f4f5">
                            <th>Tahapan</th>
                            <th>Kode Transaksi</th>
                            <th>Tanggal Terima</th>
                            <th>Nilai</th>
                        </tr>
                    </thead>
                    <tbody>
                    	<?php
                    	$jml_uudp=0;$no=1;$penerima="";
                    	if (!empty($uudp)){
							foreach($uudp as $rowuudp) {
								$jml_uudp=$jml_uudp+$rowuudp->nilai;
							    echo "<tr>";
							    echo "<td align='center'>".$no++."</td>";
							    echo "<td align='center'>".$rowuudp->kode_transaksi."</td>";
							    echo "<td align='center'>".$CI->p_c->tgl_indo($rowuudp->tanggalpenerima)."</td>";
							    echo "<td align='right'>".$CI->p_c->rupiah($rowuudp->nilai)."</td>";
							    echo "</tr>";
							    $penerima=$rowuudp->penerima;
							}
						}
						$sisa_uudp=$jml_c2-$jml_uudp;
						?>
						<tr><td colspan="3" align="right"><b>Total UUDP :</b>&nbsp;&nbsp;</td>
							<td align="right"><b><?php echo $CI->p_c->rupiah($jml_uudp)?></b></td>
						</tr>
						<tr><td colspan="3" align="right"><b>Sisa Termin :</b>&nbsp;&nbsp;</td>
							<td align="right"><b><?php echo $CI->p_c->rupiah($sisa_uudp)?></b></td>
						</tr>
						<tr bgcolor="#f3f4f5">
				            <td align="left" colspan="4"><b>Total UUDP Terbilang : <i><?php echo $CI->p_c->kalimatuang($jml_uudp);?>.</i></b></td>
				         </tr>
                    </tbody>
                    <tfoot>
                    </tfoot>
                </table>
            -->
	           <br/>
			   <table style="border-collapse:collapse;font-size:12px;" border="1">
			         <tr>
			            <td align="center" colspan="3"><b>Pengajuan</b></td>
			            <td align="center" colspan="2"><b>LPJ</b></td>
			         </tr>
				     <tr>
				     	<td align="center" width="20%"><b>Di Setujui Oleh</b></td>
			            <td align="center" width="20%"><b>Petugas</b></td>
			            <td align="center" width="20%"><b>Penerima</b></td>
			            <td align="center" width="20%"><b>Penanggung Jawab</b></td>
			            <td align="center" width="20%"><b>Verifikasi</b></td>
			         </tr>
			         <tr>
			            <td align="center" height="70">&nbsp;</td>
			            <td align="center" height="70">&nbsp;</td>
			            <td align="center" height="70">&nbsp;</td>
			            <td align="center" height="70">&nbsp;</td>
			            <td align="center" height="70">&nbsp;</td>
			         </tr>
			         <tr>
			         	<td align="center"><?php echo strtoupper($approve_by_text);?></td>
			         	<td align="center"><?php echo strtoupper($isi->petugastext);?></td>
			         	<td align="center"><?php echo strtoupper($penerima);?></td>
			         	<td align="center"><?php echo strtoupper($penerima);?></td>
			         	<td align="center"><?php echo strtoupper($isi->petugastext);?></td>
			         </tr>
			</table>
    </body>

<script language="javascript">
	window.print();
</script>
</html>
