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
			<th colspan="17" align="center"><h1><?php echo $form ?></h1></th>
		</tr>
		<tr>
			<td colspan="17" align="left"><h3>:: Filter</h3></th>
		</tr>
		<?php
			$kode_transaksi=$filterx->kode_transaksi;
	    	if ($kode_transaksi<>""){
	    		echo "<tr>";
	    		echo "<td width='*' align='left' colspan='2'>No. Transaksi</td><td colspan='16' width='85%'>: ".$kode_transaksi."</td>";
	    		echo "</tr>";
	    	}
	    	
	    	$idcompany=$filterx->idcompany;
	    	if ($idcompany<>""){
	    		echo "<tr>";
	    		echo "<td width='*' align='left' colspan='2'>Perusahaan</td><td colspan='16' width='85%'>: ".$idcompany."</td>";
	    		echo "</tr>";
	    	}
	    	
	    	$pemohon=$filterx->pemohon;
	    	if ($pemohon<>""){
	    		echo "<tr>";
	    		echo "<td width='*' align='left' colspan='2'>Pemohon</td><td colspan='16' width='85%'>: ".$pemohon."</td>";
	    		echo "</tr>";
	    	}
	    	
	    	$iddepartemen=$filterx->iddepartemen;
	    	if ($iddepartemen<>""){
	    		echo "<tr>";
	    		echo "<td width='*' align='left' colspan='2'>Pemohon</td><td colspan='16' width='85%'>: ".$iddepartemen."</td>";
	    		echo "</tr>";
	    	}
	    	
	    	
	    	$tanggalpengajuan=$this->p_c->tgl_db($this->input->post("tanggalpengajuan"));
	    	$tanggalpengajuan2=$this->p_c->tgl_db($this->input->post("tanggalpengajuan2"));
    	
	    	if ($tanggalpengajuan<>""){
	    		echo "<tr>";
	    		echo "<td width='*' align='left' colspan='2'>Tgl. Pengajuan Dari</td><td colspan='16' width='85%'>: ".strtoupper($CI->p_c->tgl_indo($tanggalpengajuan))."</td>";
	    		echo "</tr>";
	    	}
	    	
	    	if ($tanggalpengajuan2<>""){
	    		echo "<tr>";
	    		echo "<td width='*' align='left' colspan='2'>Tgl. Pengajuan S/D</td><td colspan='16' width='85%'>: ".strtoupper($CI->p_c->tgl_indo($tanggalpengajuan2))."</td>";
	    		echo "</tr>";
	    	}
	    	
	    	
	    	$idpengeluaran=$filterx->idpengeluaran;
	    	if ($idpengeluaran<>""){
	    		echo "<tr>";
	    		echo "<td width='*' align='left' colspan='2'>Kategori Pengeluaran</td><td colspan='16' width='85%'>: ".$idpengeluaran."</td>";
	    		echo "</tr>";
	    	}
	    	$idkredit=$filterx->idkredit;
	    	if ($idkredit<>""){
	    		echo "<tr>";
	    		echo "<td width='*' align='left' colspan='2'>Sumber Dana</td><td colspan='16' width='85%'>: ".$idkredit."</td>";
	    		echo "</tr>";
	    	}
	    	$iddebit=$filterx->iddebit;
	    	if ($iddebit<>""){
	    		echo "<tr>";
	    		echo "<td width='*' align='left' colspan='2'>COA</td><td colspan='16' width='85%'>: ".$iddebit."</td>";
	    		echo "</tr>";
	    	}
			
			$status=$filterx->status;
	    	if ($status<>""){
	    		echo "<tr>";
	    		echo "<td width='*' align='left' colspan='2'>Status</td><td colspan='16' width='85%'>: ".$status."</td>";
	    		echo "</tr>";
	    	}
			
		?>
		</table>
		<?php 
			$style="";
			if ($excel<>1){
				$style="style='border-collapse:collapse;'";
			}
			
		?>
		<table <?php echo $style ?> border="1">
                <tr bgcolor="#f3f4f5">
                    <th rowspan="2">No.</th>
                    <th rowspan="2">No. Transaksi</th>
                    <th rowspan="2">Perusahaan</th>
                    <th rowspan="2">Departemen</th>
                    <th rowspan="2">Pemohon</th>
                    <th rowspan="2" width="*">Dana Yang Belum Diterima</th>
                    <th rowspan="2" width="*">Status</th>
                    
                    <td colspan="4" align="center"><b>Keperluan</b></td>
                    <td colspan="6" align="center"><b>LPJ</b></td>
                    <!--
                    <th width="*">Tgl. Realisasi</th>
                    <th width="150">LPJ</th>
                    -->
                </tr>
                <tr bgcolor="#f3f4f5">
                	<th>Keperluan</th>
                    <th>Jenis</th>
                    <th width="*">Jumlah</th>
                    <!--
                    <th width="*">Nilai</th>
                    -->
                    <th width="*">Sub Total</th>
                    <th>Tanggal</th>
                	<th>Keperluan</th>
                	<th>Sumber Dana</th>
                    <th>COA</th>
                    <th width="*">Jumlah</th>
                    <!--
                    <th width="*">Nilai</th>
                    -->
                    <th width="*">Sub Total</th>
                </tr>
            	<?php
                	$CI =& get_instance();$no=1;$jmltot=0;$jmlreal=0;$replidkk='';$replidkk2='';
					foreach((array)$show_table as $row) {
						$replidkk=$row->replid;
					    echo "<tr>";
					    if ($replidkk<>$replidkk2){
						    echo "<td align=''>".strtoupper($no++)."</td>";
						    echo "<td align='center'>".$row->kode_transaksi."</td>";
						    echo "<td align=''>".strtoupper($row->company)."</td>";
						    echo "<td align=''>".strtoupper($row->departemen)."</td>";
						    echo "<td align='center'>".strtoupper($row->pemohontext)."<br/>".strtoupper($CI->p_c->tgl_indo($row->tanggalpengajuan))."</td>";
						    echo "<td align='right'>".$CI->p_c->rupiah($row->total-$row->uudp)."</td>";
						    echo "<td align='center'><b>".strtoupper($row->statustext)."</b></td>";
						}else{
						   echo "<td align='' colspan='7'>&nbsp;</td>"; 
					    }
					    echo "<td>".strtoupper($row->keperluantext)."</td>";
					    echo "<td>".strtoupper($row->jenis)."</td>";
					    echo "<td align='center'>".$row->jumlah." ".strtoupper($row->idunit)."</td>";
					    //echo "<td align='right'>".$CI->p_c->rupiah($row->nilai)."</td>";
					    echo "<td align='right'>".$CI->p_c->rupiah($row->sub_total)."</td>";
					    
					    
					    echo "<td>".strtoupper($CI->p_c->tgl_indo($row->tanggalrealisasi))."</td>";
					    echo "<td>".strtoupper($row->realisasitext)."</td>";
					    echo "<td>".strtoupper($row->idkredit)."</td>";
					    echo "<td>".strtoupper($row->iddebit)."</td>";
					    echo "<td align='center'>".$row->jumlah_realisasi." ".strtoupper($row->idunit_realisasi)."</td>";
					    //echo "<td align='right'>".$CI->p_c->rupiah($row->nilai_realisasi)."</td>";
					    echo "<td align='right'>".$CI->p_c->rupiah($row->sub_total_realisasi)."</td>";
					    echo "</tr>";
					    $jmltot=$jmltot+$row->sub_total;
						$jmlreal=$jmlreal+$row->sub_total_realisasi;
						$replidkk2=$row->replid;
					}
					echo "<tr>";
					echo "<th style='text-align:right;' colspan='10'>JUMLAH :</th>";
					echo "<th style='text-align:right;'>".strtoupper($CI->p_c->rupiah($jmltot))."</th>";
					echo "<th style='text-align:right;' colspan='5'>&nbsp;</th>";
					echo "<th style='text-align:right;'>".strtoupper($CI->p_c->rupiah($jmlreal))."</th>";
					echo "</tr>";
					echo "<tr>";
					echo "<th style='text-align:right;' colspan='10'>BELUM REALISASI :</th>";
					echo "<th style='text-align:right;' colspan=7>".strtoupper($CI->p_c->rupiah($jmltot-$jmlreal))."</th>";
					echo "</tr>";
			?>
        </table>
		    <!--
		    <table border="0"  style="font-size:12px;">
			     <tr>
		            <td align="center" width="50%"><b>Penerima</b></td>
		            <td align="center" width="50%"><b>Di Setujui Oleh</b></td>
		         </tr>
		         <tr>
		            <td align="center" height="70">&nbsp;</td>
		            <td align="center" height="70">&nbsp;</td>
		         </tr>
		         <tr>
		         	<td align="center"><?php echo strtoupper($isi->penerimatext);?></td>
		         	<td align="center"><?php echo strtoupper($isi->approvebytext);?></td>
		         </tr>
		</table>
		-->
</body>
<?php if($excel<>1) { ?>
<script language="javascript">
	window.print();
</script>
<?php } ?>
</html>
