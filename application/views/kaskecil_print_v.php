<!DOCTYPE html>
<?php
$CI =& get_instance();
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
		    		<td valign="top" align="left" width="60%"><font style="font-size:24px"><b><?php echo $form ?></b></font>
		    		<?php echo "<br/>".$form_small."<br/><br/>" ?>
		    			<table  border="0">
				    		<tr>
					            <td align="left" width="100">No. Transaksi</td>
					            <td width="20">:</td>
					            <td align="left"><?php echo strtoupper($isi->kode_transaksi);?></td>
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
                            <th width="30">No.</th>
                            <th width="100">Kategori Pengeluaran</th>
                            <!--
                            <th>Sumber Dana</th>
                            -->
                            <th width="200">COA</th>
                            <th>Keperluan</th>
                            <th width="100">Nilai</th>
                            <th width="100">LPJ</th>
                        </tr>
                    </thead>
                    <tbody>
                    	<?php
                    	$CI =& get_instance();
                    	$no=1;$minta=0;
						foreach((array)$material as $row) {
						    echo "<tr align='left'>";
						    echo "<td align='center' valign='top'>".$no++."</td>";
						    echo "<td valign='top'>".$row->idpengeluaran."</td>";
						    //echo "<td>".$row->idkredit."</td>";
						    echo "<td valign='top'>".$row->iddebit."</td>";
						    echo "<td valign='top'>".$row->keperluan."</td>";
						    echo "<td align='right' valign='top'>".$CI->p_c->rupiah($row->jumlah)."</td>";
						    echo "<td align='right' valign='top'>&nbsp;</td>";
						    echo "</tr>";
						    $minta=$minta+$row->jumlah;
						}
						echo "<tr align='left'>";
						echo "<td align='right' colspan='4'><b>Total :</b></td>";
						echo "<td align='right'><b>".$CI->p_c->rupiah($minta)."</b></td>";
						echo "<td align='right'><b>&nbsp;</b></td>";
						echo "</tr>";
						echo "<tr align='left'>";
						echo "<td align='right' colspan='4'><b>Selisih :</b></td>";
						echo "<td align='right' colspan='2'></td>";
						echo "</tr>";
						?>
                    </tbody>
                    <tfoot>
                    </tfoot>
                </table>
            <br/>
            <table style="font-size:12px;" border="0" width="100%">
            	<?php
            		//echo $CI->p_c->kalimatuang($minta);

            	?>
             	<tr>
		            <td align="left" colspan="2"><br/><b>Total Selisih Terbilang : ........................................................................................................................................................................................................................<i></i></b></td>
		         </tr>

			     <tr>
		            <td align="left" width="60%"><b><br/>Tangerang Selatan, <?php echo $CI->p_c->tgl_indo($isi->tanggalpenerima);?></b></td>
		            <td align="left" width="40%"><b><br/>Tangerang Selatan,.......................................................</b></td>
		         </tr>
            </table>
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
		         	<td align="center"><?php echo strtoupper($isi->approvebytext);?></td>
		         	<td align="center"><?php echo strtoupper($isi->petugastext);?></td>
		         	<td align="center"><?php echo strtoupper($isi->penerimatext);?></td>
		         	<td align="center"><?php echo strtoupper($isi->penerimatext);?></td>
		         	<td align="center"><?php echo strtoupper($isi->petugastext);?></td>
		         </tr>
		</table>
    </body>
<script language="javascript">
	window.print();
</script>
</html>
