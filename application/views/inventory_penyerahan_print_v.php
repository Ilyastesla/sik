<?php 
$this->load->view('headerprint_v');

$CI =& get_instance();
if ($excel==1){
	header('Content-Type: application/vnd.ms-excel'); //IE and Opera
	header('Content-Type: application/x-msexcel'); // Other browsers
	header('Content-Disposition: attachment; filename=penyerahanbarang.xls');
	header('Expires: 0');
	header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
}else{
    ?>
	<script language="javascript">
		window.print();
	</script>
    <?php
}
?>
<style>
    h3,h4 {
        line-height: 0px !important;
    }
</style>
<body>
	<center >
  <?php $CI->dbx->getkopsuratcompany($isi->idcompany,$excel); ?>
  <center>
    <b><h3><u><?php echo $form ?></u></h3>Nomor: <?php echo $isi->kode_transaksi ?><br/><br/></b>
    
    
  <table class="tablecontent">
      <tr>
          <th align="left">No. Permintaan</th><th align="left">: <?php echo strtoupper($isi->kode_transaksi); ?></th>
          <th align="left">Tgl. Permintaan</th><th align="left">: <?php echo $CI->p_c->tgl_indo($isi->created_date); ?></th>
      </tr>
      <tr>
          <th align="left">Pemohon</th><th align="left">: <?php echo $CI->dbx->getpegawai($isi->pemohon,0,1); ?></th>
          <th align="left">Tgl. Kebutuhan</th><th align="left">: <?php echo $CI->p_c->tgl_indo($isi->tanggalpengajuan); ?></th>
      </tr>
			<tr>
          <th align="left" width="20%">No. Penyerahan</th><th align="left" width="30%">: <?php echo $penyerahan_head->kode_transaksi; ?></th>
					<th align="left" width="20%">Tgl. Penyerahan</th><th align="left" width="30%">: <?php echo $CI->p_c->tgl_indo($penyerahan_head->tanggalserah); ?></th>
      </tr>
      <tr>
          <th align="left" width="20%">Penerima</th><th align="left" width="30%">: <?php echo $CI->dbx->getpegawai($penyerahan_head->idpjheadpenyerahan,0,1); ?></th>
					<!--<th align="left" width="20%">Tgl. Penyerahan</th><th align="left" width="30%">: <?php echo $CI->p_c->tgl_indo($penyerahan_head->tanggalserah); ?></th>-->
      </tr>
			<!--
      <tr>
          <th align="left">Departemen</th><th align="left">: <?php echo strtoupper($isi->departemen); ?></th>
      </tr>
  -->
    </table>
    <br/>
    <table class="tablecontent tablecontent_">
      <thead>
          <tr>
          <th width='50'>No.</th>
                                        <th>Material</th>
										<th>Kelompok Barang</th>
										<th>Kelompok Fiskal</th>
                                        <th>Total Serah</th>
                                        <th>Unit</th>
          </tr>
      </thead>
      <tbody>
                                	<?php
                                	$jml_c=0;$no=1;$stock=0;$nlx="";
                                	if (!empty($material)){
										foreach($material as $row) {
												$sisaserah=0;$total_serah=0;
												$sisaserah=$row->jumlah-$row->total_serah;
                      	if ($row->total_serah<>""){
                      		$total_serah=$row->total_serah;
                      	}
                      	if($nlx<>""){$nlx=$nlx.',';}
										    echo "<tr>";
										    echo "<td align='center'>".$no++."</td>";
										    echo "<td align=''>".$row->materialtext."</b></td>";
										    echo "<td align='center'>".$row->kelompokbarangtext."</td>";
											echo "<td align='center'>".$row->kodefiskaltext."</td>";
											  echo "<td align='center'>".$total_serah."</td>";
										    echo "<td align='center'>".$row->idunit."</td>";

										    echo "</tr>";
										    //------------------------------------------------------------------------------------
										    if ($total_serah>0){
											    echo "<tr>";
											    echo "<td align=''>&nbsp;</td>";

											    $noinventaris=$CI->inventory_penyerahan_db->noinventaris_db($row->idpermintaan_barang,$row->idmaterial,$row->replid,$idpenyerahan);
											    echo "<td colspan='9'>";
											    ?>
											    <table class="tablecontent tablecontent_">
				                                <thead>
				                                    <tr>
				                                    	<th width='50'>No.</th>
														<th>Sumber Dana</th>
														                     <?php if ($row->inventaris) { ?>
				                                        <th>No. Inventaris</th>
				                                        <th>Kelompok Inventaris</th>
				                                        <th>Ruangan</th>
																							<?php }else{ ?>
																								<th>Jumlah Serah</th>
																								<th>Unit</th>
																							<?php
																								} ?>
				                                        
				                                    </tr>
				                                </thead>
				                                <tbody>

											    <?php
											    $no2=1;
											    foreach((array)$noinventaris as $rownoinventaris) {
												    echo "<tr>";
												    echo "<td>".$no2++."</td>";
													echo "<td align='center'>".$rownoinventaris->sumberdanatext."</td>";
												    if ($row->inventaris) {
												    	echo "<td>".$rownoinventaris->kode_inventaris."</td>";
												    	echo "<td>".$rownoinventaris->kelompok_inventaris."</td>";
												    	echo "<td>".$rownoinventaris->ruangan."</td>";
												    }else{
															echo "<td align='center'>".$rownoinventaris->jml_serah."</td>";
															echo "<td align='center'>".$rownoinventaris->unit."</td>";
														}
											    }
											    echo "</table>";
											    echo "</td>";
											    echo "</tr>";

											}// $total_serah=0
										    $nlx=$nlx.$row->idmaterial;
										}
									}
									?>
                                </tbody>
    </table>
    <br/>
    <table class="tablecontent">
            <tr><td align='right' colspan=2><?php echo $isi->citycompanytext.', '.$CI->p_c->tgl_indo($isi->tglprint) ?></td></tr>
            <tr align='center'><td width="50%">Penerima</td><td>Yang Menyerahkan</td></tr>
            <tr><td  height='80px'></td><td></td></tr>
            <tr align='center'><td><b><?php echo $CI->dbx->getpegawai($penyerahan_head->idpjheadpenyerahan)?></b><hr/>Staff <?php echo ucwords(strtolower($isi->company)) ?></td><td><b><?php echo $CI->dbx->getpegawai($penyerahan_head->idstaffgudang)?></b><hr/>Staff Pengadaan dan Gudang</td></tr>
        </table>
   </center>
</body>
<? die; ?>
<?php if($excel<>1) { ?>
	<script language="javascript">
		window.print();
	</script>
<?php } ?>
</html>
