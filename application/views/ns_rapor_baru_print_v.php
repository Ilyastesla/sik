<!DOCTYPE html>
<?php
$CI =& get_instance();
if ($excel==1){
	header('Content-Type: application/vnd.ms-excel'); //IE and Opera
	header('Content-Type: application/x-msexcel'); // Other browsers
	header('Content-Disposition: attachment; filename=rapot_'.$isi->siswa.'|'.$isi->nis.'.xls');
	header('Expires: 0');
	header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
}else { ?>
	<script language="javascript">
		window.print();
	</script>
<?php } ?>

<html>
<title><?php echo $form ?></title>
<!--
.lpd {
	font-family:'Source Sans Pro', sans-serif;
	font-size:7pt;
	width: 85% !important;
}
-->
<style>
	table,p {
		font-family:'Source Sans Pro', sans-serif;
		font-size:<?php echo $isi->besarfont?>pt;
		width: 85% !important;
		border-color: black;
	}
	.tablecontent {
		border-collapse:collapse;
		width:95% !important;
		border:1px solid;
		border-color: black !important;
	}
	.tablecontent td,th{
		border:1px solid;
		padding:7px;
		border-color: black !important;
	}
	.tablecontentdetail {
		border-collapse:collapse;
		border:1px solid;
		width:85% !important;
	}
	.tablecontentdetail td,th{
		border:1px solid;
		padding:7px;
		border-color: black !important;
	}
	#divheader{
		font-family:'Source Sans Pro', sans-serif;
		text-align:left;
		width: 85% !important;
	}
	#divcontent{
		font-family:'Source Sans Pro', sans-serif;
		font-size:<?php echo $isi->besarfont?>pt;
		text-align:left;
		padding-left: 30px;
		width: 85% !important;
		margin-bottom: 10mm;
	}
	#divcontent2{
		font-family:'Source Sans Pro', sans-serif;
		font-size:<?php echo $isi->besarfont?>pt;
		text-align:left;
		padding-left: 30px;
		width: 85% !important;
		margin-bottom: 10mm;
	}

	font{
		font-family:'Source Sans Pro', sans-serif;
		font-size:<?php echo $isi->besarfont?>pt;
	}

	.divketeranganhead{
		font-family: 'Source Sans Pro', sans-serif;
    	font-size: 8.5pt;
		width:85%;
		display: block;
		word-wrap:normal;
		text-align:left;
		margin-top:15mm;
	}
	.divketerangan{
		display: inline-block;
		width:19% !important;
		vertical-align:top;
		padding:2px;
		font-weight:bold;
	}
	.divketerangan_content{
		display: inline-block;
		width:26% !important;
		vertical-align:top;
		padding:2px;
	}
	.divketerangan_mid{
		display: inline-block;
		width:2% !important;
		vertical-align:top;
		padding:2px;
		font-weight:bold;
	}

	

	@page {
		  size: A4;
		  width:210mm;
		  height:297mm;
	}

	@media print {
		table,tr{
			page-break-inside:always !important;
			page-break-after: auto;
		}
		thead { display:table-header-group }
    tfoot { display:table-footer-group }

		#breaktable{
			page-break-before:always !important;
			margin-top: 35mm;

		}

		.breaktable{
			page-break-inside:auto !important;
			display: table-row;
		}

		.page-break { display: block; margin: 200mm 0 0 0; }
		#divcontent{
			page-break-after: always;
		}
		.nonakademik{
			page-break-after: always;
		}
}
</style>
<?php if($digital){?>
<div id="sample" style="position: fixed;margin:0 auto;width:96%;height:97%;border: 10px solid black;opacity:1;display: block;z-index:-3;">
</div>
<div id="sample" style="position: fixed;margin:0 auto;top:400px;color: grey;font-size: 40pt !important;text-align: center;width:100%;height:150px;border: 0px solid grey;opacity:0.5;display: block;">
	<center>
		<?php
		if($isi->departemen=="PENSUS"){
			echo "DOKUMEN SEMENTARA";
		}
		?>
  </center>
</div>
<?php } ?>

<center >
	<?php
 if (($isi->kopsurat==1) OR ($digital==1)){
	 echo "";
 }else{
	 if (($isi->tipe=='Murni') or ($isi->tipe=='SKL')){
		 ?>
 			<style>
 				body {
 					 margin-top: 35mm;
 					}
 			</style>
 	 <?php
	 }else{
	 	?>
			<style>
				#tableheader {
					 margin-top: 35mm;
					}
			</style>
	 <?php
  }
}
	?>

<?php
	switch ($isi->departemen) {
		case 'SD': $paket='A';
			break;
	case 'SMP': $paket='B';
		break;
		case 'SMA': $paket='C';
			break;
		default:
			$paket='';
			break;
	}
	$headerrapot="<div class='divheader'>";
	if ($isi->tipe<>'SKL'){
		$headerrapot=$headerrapot. "<div class='divketeranganhead'>";
		$headerrapot=$headerrapot. "<div class='divketerangan'>Alamat Satuan Pendidikan</div><div class='divketerangan_mid'>:</div><div class='divketerangan_content'>".$isi->alamatrapor."</div>";
		if($isi->kelastexton==1){
			$headerrapot=$headerrapot. "<div class='divketerangan'>Kelas</div><div class='divketerangan_mid'>:</div><div class='divketerangan_content'>".$isi->kelastext."</div>";
		}else{
			$headerrapot=$headerrapot. "<div class='divketerangan'>Tingkatan/Setara Kelas</div><div class='divketerangan_mid'>:</div><div class='divketerangan_content'>".$isi->kesetaraantext.'/'.$CI->p_c->romawi($isi->tingkattext)."</div>";
		}
		//$headerrapot=$headerrapot. "<div class='divketerangan'>Fase/Setara Kelas</div><div class='divketerangan_mid'>:</div><div class='divketerangan_content'>".$isi->fasetext.'/'.$CI->p_c->romawi($isi->tingkattext)."</div>";
		if($isi->jurusanon==1){
			$headerrapot=$headerrapot. "<div class='divketerangan'>Jurusan</div><div class='divketerangan_mid'>:</div><div class='divketerangan_content'>".ucwords(strtolower($isi->jurusantext))."</div>";
		}
		$headerrapot=$headerrapot. "<div class='divketerangan'>Nama Peserta Didik</div><div class='divketerangan_mid'>:</div><div class='divketerangan_content'>".ucwords(strtolower($isi->siswa))."</div>";
		
		if($isi->paketkompetension=="1"){
			$headerrapot=$headerrapot. "<div class='divketerangan'>Paket Kompetensi</div><div class='divketerangan_mid'>:</div><div class='divketerangan_content'>".ucwords(strtolower($isi->paketkompetensitext))."</div>";
		}else{
			$headerrapot=$headerrapot. "<div class='divketerangan'>Semester</div><div class='divketerangan_mid'>:</div><div class='divketerangan_content'>".ucwords(strtolower($isi->periode))."</div>";
		}
		if($isi->nisn<>''){$nistext=$isi->nis."/".$isi->nisn;}else{$nistext=$isi->nis."/".'-';}
		$headerrapot=$headerrapot. "<div class='divketerangan'>Nomor Induk/NISN</div><div class='divketerangan_mid'>:</div><div class='divketerangan_content'>".$nistext."</div>";
		
		if($isi->tahunajaranrapot<>''){
			$tahunajarantext=$isi->tahunajaranrapot;
		}else{
			$tahunajarantext=$isi->tahunajaran;
		}
		$headerrapot=$headerrapot. "<div class='divketerangan'>Tahun Pelajaran</div><div class='divketerangan_mid'>:</div><div class='divketerangan_content'>".ucwords(strtolower($tahunajarantext))."</div>";
		if($isi->programon=='1'){
			$headerrapot=$headerrapot. "<div class='divketerangan'>Program</div><div class='divketerangan_mid'>:</div><div class='divketerangan_content'>".ucwords(strtolower($isi->kelompoksiswa))."</div>";
		}
		$headerrapot=$headerrapot. "</div>";
		//echo $headerrapot."<br/>";
	}
?>
</div>
<body>
<section id="content">
	
<?php 
	if (($isi->kopsurat==1) OR ($digital==1)){
		echo "<center><img src='".base_url()."images/".$isi->logotext."' width='190' style='margin-top:15mm'/></center>";
	}

	if ($isi->tipe=='SKL'){
		//$headerrapot= $headerrapot."<b>".$isi->companytext."</b>";
		$headerrapot= $headerrapot."<br/><b>Ujian Pendidikan Kesetaraan Paket ".$paket." (Setara ".$isi->departemen.")"."</b>";
		if($isi->jurusantext<>""){
			$headerrapot= $headerrapot. "<br/><b>Program Studi ".ucwords(strtolower($isi->jurusantext))."</b>";
		}
		$headerrapot= $headerrapot."<br/><b>Tahun Pelajaran ".$isi->tahunajaran."</b>";
		$headerrapot= $headerrapot."<br/><b>Nomor: ".$isi->nomordokumen."</b>";
		//$headerrapot= $headerrapot."<br/><br/>";
	}else{
		echo "<h1 style='margin-bottom:-10mm'>".ucwords(strtolower($isi->rapottipe))."</b>";
		if ($isi->tipe=='Murni'){
			if($isi->paketkompetension=="1"){
				echo "<br/>Paket Kompetensi ".ucwords(strtolower($isi->paketkompetensitext));
			}else{
				echo "<br/>Semester ".ucwords(strtolower($isi->periode));
			}
		}
		echo "<br/>".ucwords(strtolower($isi->companytext));
		echo "</h1>";
	}

	echo $headerrapot;
	
		
		//$headerrapot= $headerrapot."<b>". " MODUL ".$isi->idmodultipe."</b>";		
	
	if($isi->tipe=='Grafik'){
?>
		<script src="<?php echo base_url(); ?>js/jquery2.min.js"></script>
		<script src="https://code.highcharts.com/highcharts.js"></script>
		<script src="https://code.highcharts.com/modules/exporting.js"></script>
		<?php
		// ----------------------------------------------------------------------------------------------------------------------------------
		// ----------------------------------------------------------------------------------------------------------------------------------
			
			$judul="";$judultext="";$x=0;
			foreach((array)$kelompok as $rn) {
				if (isset($tglkeg[$rn->pengembangandirivariabel])){
  				$tglkeg[$rn->pengembangandirivariabel]=$tglkeg[$rn->pengembangandirivariabel].",'".$CI->p_c->getBulan($rn->bulankegiatan)."'";
  			}else{
  				$tglkeg[$rn->pengembangandirivariabel]="'','".$CI->p_c->getBulan($rn->bulankegiatan)."'";
  			}

				if (isset($nilaikeg[$rn->pengembangandirivariabel])){
					$nilaikeg[$rn->pengembangandirivariabel]=$nilaikeg[$rn->pengembangandirivariabel].",".CEIL($rn->nilaigrafik);
				}else{
					$nilaikeg[$rn->pengembangandirivariabel]=CEIL($rn->nilaigrafik);
				}

				if ($judul<>$rn->pengembangandirivariabel){
					if ($judultext<>""){
						$judultext=$judultext.'||'.$rn->pengembangandirivariabel;
					}else{
						$judultext=$rn->pengembangandirivariabel;
					}
				}
				$judul=$rn->pengembangandirivariabel;
			}
			if ($judultext<>""){
					$judultextgraph=explode("||",$judultext);
					$judultextgraphcount=count($judultextgraph);
			}
			//echo var_dump($tglkeg);
			?>
			<div id="divheader">
			<!--<b><i>Homeschooler</b></i> -->
			<p align='justify'><font size="+1">Selama proses pembelajaran, kami mengamati perkembangan perilaku Peserta Didik.
				Aspek yang menjadi pengamatan kami meliputi <?php echo $judultextgraphcount ?> hal,  yaitu:
					<?php
					$nographx=1;
					foreach((array)$judultextgraph as $graph) {
						if (($nographx>0) and ($nographx<$judultextgraphcount)){
							if ($nographx>1){echo ", ";}
						}else{
							echo ", dan ";
						}

						echo $graph;
						$nographx++;
					}
					?>. Berikut hasil pengamatan kami selama periode belajar Peserta Didik.
						</font></p>
			</div>
			<?php
			if ($judultext<>""){
					echo "<table style='border-collapse:collapse;border-color:black;' border='0'>";
					echo "<tr>";
					foreach((array)$judultextgraph as $graph) {
						if ((($x%6)==0) and ($x<>0)){
						    	echo "</table>";
						    	echo "<table style='border-collapse:collapse;border-color:black;' border='0' id='breaktable'>";
						    	echo "<tr>";

						}
						echo "<td align='left'>";
									echo "<table style='border:0 !important;width:100%;border-collapse:initial !important; '>";
										echo "<tr>";
										echo "<td align='left' height='*' width='50%'>";
										//echo $tglkeg[$graph];
									?>

									<script type="text/javascript">
										$(function () {
												Highcharts.chart('container<?php echo $graph; ?>', {
														chart: {
																type: 'line'
														},
														exporting: {
													    enabled: false
													  },
														credits: {
																enabled: false
														},
														title: {
																text: '<?php echo ucwords(strtolower($graph)); ?>'
														},
														xAxis: {
															showLastLabel: true,
															labels: {
																			rotation: -30,
																			step:1,
																			style: {
																					color: '#525151',
																					font: '8px Helvetica'
																			},
																			formatter: function () {
																					return this.value;
																			}
																	},
															type: "linear",
																categories: [<?php echo $tglkeg[$graph]; ?>],
																min: 0
														},
														yAxis: {
															min: 0,
																max: 100,
																tickInterval: 20,
																title: {
																		text: 'Nilai'
																}
														},
														plotOptions: {
																line: {
																		dataLabels: {
																				enabled: false
																		},
																		enableMouseTracking: false
																}
														},
														series: [{
																name: 'Nilai Peserta Didik/Bulan',
																data: [<?php echo $nilaikeg[$graph]; ?>],
																pointStart: 1
														}]
												});
										});
									</script>
									<div id="container<?php echo $graph; ?>" style="margin:0;width:300px; height:220px;border-collapse:collapse;border-color:black;border:1px solid black;align:left;"></div>
									<?php
										echo "</td>";
										echo "</tr>";
									echo "</table>";
								echo "</td>";

								if (($x%2)==1){
									echo "</tr>";
									echo "<tr>";
								}
								$x++;
					}

					echo "</table>";

					echo "<div id='divheader'><p align='left'>Deskripsi:</p>";
					echo "<table class='tablecontent'>";
					echo "<tr>";
					echo "<th width='30'>No.</th>";
					echo "<th>Aspek yang harus dinilai</th>";
					echo "<th>Nilai</th>";
					echo "<th>Predikat</th>";
					echo "<th>Deskripsi</th>";
					echo "</tr>";
					//echo var_dump($judultextgraph);
					$noas=1;
					foreach((array)$judultextgraph as $graphpredikat) {
						$nilaix=0;$nilaiy=0;$xn=0;
						if (isset($nilaikeg[$graphpredikat])){
							$nilaix=explode(",",$nilaikeg[$graphpredikat]);
							foreach((array)$nilaix as $ngraph) {
								$nilaiy=$nilaiy+$ngraph;
								$xn++;
							}

						}

						echo "<tr>";
						echo "<td width='20' align='center'>".$noas++."</td>";
						echo "<td width='150'>".ucwords(strtolower($graphpredikat))."</td>";
						if (($nilaiy<>0) or ($xn<>0)){
								echo "<td width='20'>".ceil($nilaiy/$xn)."</td>";
								echo "<td width='20'>".strtoupper($CI->dbx->ns_predikat_graph(ceil($nilaiy/$xn),$graphpredikat))."</td>";
								echo "<td>".$CI->dbx->ns_predikat_text_graph(ceil($nilaiy/$xn),$graphpredikat)."</td>";
						}else{
							echo "<td width='20'>0</td>";
							echo "<td width='20'>0</td>";
							echo "<td width='20'>0</td>";
						}
						echo "</tr>";
					}
					echo "</table></div><br/>";
			} //judultextgraph
	}else if ($isi->tipe=='Murni'){
	// Murni
	// ----------------------------------------------------------------------------------------------------------------------------------
	// ----------------------------------------------------------------------------------------------------------------------------------
			$matkel="";$matpel="";$pengembangandirivariabel="";$jml_kel=0;
			$csx=3+$isi->kkmon+$isi->predikaton+$isi->kalimatraporon;
			$cspdv=1+$isi->predikaton;
			$arraympk=array(); //$arraypdv=array();
			$cskel=array();
			foreach((array)$kelompok as $rowkelompok) {
				if ($matkel<>$rowkelompok->matpelkelompok){
					$arraypsv[$rowkelompok->matpelkelompok]=array();
					$arraypdv[$rowkelompok->matpelkelompok][$rowkelompok->prosessubvariabel]=array();
					array_push($arraympk,$rowkelompok->matpelkelompok);
					$cskel[$rowkelompok->matpelkelompok]=0;
				}

				if (!in_array($rowkelompok->prosessubvariabel,$arraypsv[$rowkelompok->matpelkelompok])){
					array_push($arraypsv[$rowkelompok->matpelkelompok],$rowkelompok->prosessubvariabel);
					$arraypdv[$rowkelompok->matpelkelompok][$rowkelompok->prosessubvariabel]=array();
				}
				if (!in_array($rowkelompok->pengembangandirivariabel,$arraypdv[$rowkelompok->matpelkelompok][$rowkelompok->prosessubvariabel])){
					array_push($arraypdv[$rowkelompok->matpelkelompok][$rowkelompok->prosessubvariabel],$rowkelompok->pengembangandirivariabel);
					$cskel[$rowkelompok->matpelkelompok]++;
				}

				$matkel=$rowkelompok->matpelkelompok;
			}
			//echo var_dump($arraympk);die;
			$matkel="";$totalmatpel=0;
			foreach((array)$arraympk as $rowmpk) {
				$nilaimp=0;
				if ($matkel<>$rowmpk){
							$no=1;
							$matkelcs=($cskel[$rowmpk]*(1+$isi->predikaton))+3+$isi->kkmon+$isi->kalimatraporon;
							if ($jml_kel<>1){
								echo "</table><br/>";
							}
							echo "<table class='table tablecontentdetail'>";
							echo "<tr>";
							echo "<td align='' colspan='".$matkelcs."'><b>".ucwords(strtolower($rowmpk))."</b></td>";
							echo "</tr>";
							echo "<tr>";
							echo "<th width='30' rowspan='2' align='center'>No.</th>";
							echo "<th width='*' rowspan='2'>Mata Pelajaran</th>";
							if($isi->skkon==1){
              					echo "<th width='30' rowspan='2' align='center'>SKK</th>";
							}
							if($isi->kkmon==1){
								echo "<th width='30' rowspan='2' align='center'>KKM</th>";
							}
							$countallpdv=0;
							foreach((array)$arraypsv[$rowmpk] as $rowpsv) {
								//foreach((array)$arraypdv[$rowmpk][$rowpsv] as $rowpdv) {
									//width='".(30*(((1+$isi->predikaton+$isi->kalimatraporon)*COUNT($arraypdv[$rowmpk][$rowpsv]))))."'
								echo "<th colspan='".((1+$isi->predikaton+$isi->kalimatraporon)*COUNT($arraypdv[$rowmpk][$rowpsv]))."' align='center'>".$rowpsv."</th>";
								//}
								$countallpdv += COUNT($arraypdv[$rowmpk][$rowpsv]);

							}
							echo "</tr>";
							echo "<tr>";
							//echo $countallpdv;
							$widthcol=300/($countallpdv*(1+$isi->kalimatraporon+$isi->predikaton));
							//echo $widthcol;
							foreach((array)$arraypsv[$rowmpk] as $rowpsv) {
								foreach((array)$arraypdv[$rowmpk][$rowpsv] as $rowpdv) {
									echo "<th width='".$widthcol."'>".$rowpdv."</th>";
									if($isi->kalimatraporon==1){echo "<th width='".$widthcol."'>Huruf</th>";}
									if($isi->predikaton){
											echo "<th width='".$widthcol."' align='center'>Predikat</th>";
									}
								}
							}
							echo "</tr>";

							foreach((array)$kelompok as $rowkelompok) {
								if($rowmpk==$rowkelompok->matpelkelompok){
									if($no<2){
										echo "</tr>";
									}
									if ($matpel<>$rowkelompok->matpel){
										$totalmatpel++;
										echo "<tr>";
										echo "<td align='center'>".$no++."</td>";
										echo "<td align='left'>".$rowkelompok->matpel;
										if($rowkelompok->matpelexternal){
											echo "&nbsp;".$isi->external;
										}
										if($isi->skkon==1){
											echo "<td align='center'>".$rowkelompok->jumlahskk."</td>";
										}
										if($isi->kkmon==1){echo "<td align='center'>".$rowkelompok->kkm."</td>";}
										echo "<td align='center'>".CEIL($rowkelompok->nilaiasli)."</td>";
										if($isi->kalimatraporon==1){
											echo "<td align='left'>".ucwords(strtolower($CI->p_c->kalimatrapor(CEIL($rowkelompok->nilaiasli),0))) ."</td>";
										}
										if($isi->predikaton==1){
												echo "<td align='center'>".strtoupper($CI->dbx->ns_predikat($isi->departemen,CEIL($rowkelompok->nilaiasli),$rowkelompok->idpredikattipe))."</td>";
										}
									}else{
										echo "<td align='center'>".CEIL($rowkelompok->nilaiasli)."</td>";
										if($isi->predikaton==1){
												echo "<td align='center'>".strtoupper($CI->dbx->ns_predikat($isi->departemen,CEIL($rowkelompok->nilaiasli),$rowkelompok->idpredikattipe))."</td>";
										}
									}
								}
								$matpel=$rowkelompok->matpel;
							}
					}
					$matkel=$rowmpk;
			} //foreach((array)$kelompok as $rowkelompok) {
				?>

						</tbody>
						<tfoot>
						</tfoot>
				</table>
				<?php
				if ($totalmatpel>10){
					echo "<table border='0' id='breaktable'>";
				}else{
					echo "<table border='0'>";
				}
				//
				if($isi->sikap==1){
				?>
					<tr><td>
						<h4>Sikap Spiritual</h4>
						<table class='table tablecontentdetail' style="width:100% !important">
		          <tr>
		            <td valign="center" align="center" width="100"><h2><?php echo $isi->predikatspiritualtext?></h2></td>
		            <td valign="top">
		                <?php
		                    if($isi->descspiritualtext<>""){
		                      echo $isi->descspiritualtext."<br/><br/>";
		                    }
		                    echo $isi->spiritualtext;
		                ?>
		            </td>
		          </tr>
		          </table>
					</td></tr>
					<tr><td>
						<h4>Sikap Sosial</h4>
						<table class='table tablecontentdetail' style="width:100% !important">
	          <tr>
	            <td valign="center" align="center" width="100"><h2><?php echo $isi->predikatsosialtext?></h2></td>
	            <td valign="top">
	                <?php
	                    if($isi->descsosialtext<>""){
	                      echo $isi->descspiritualtext."<br/><br/>";
	                    }
	                    echo $isi->sosialtext
	                ?>
	            </td>
	          </tr>
			  <?php } ?>
	        </table><br/>
				</td></tr>
				 </table>
        <?php if($isi->keterangan<>"") { ?>
				<!--
				<br/>
		        <table class='table tablecontentdetail'>
		        	<tr>
		            	<td align="left"><b>Komentar Wali Kelas:</b></td>
		            </tr>
		            <tr>
		            	<td align="left">
			            	<br/><?php echo $isi->keterangan; ?>&nbsp;<br/><br/>
		            	</td>
		            </tr>

		        </table><br/>
			-->
		<?php
      } // keterangan
}else if ($isi->tipe=='SKL'){
	$matkel="";$matpel="";$pengembangandirivariabel="";$jml_kel=0;
	$csx=3+$isi->kkmon+$isi->predikaton+$isi->kalimatraporon;
	$cspdv=1+$isi->predikaton;
	$arraympk=array(); //$arraypdv=array();
	$cskel=array();
	$nilaiavgmatpel=array();
	$nilaiavgsubvar=array();
	$nilaiavgsubvarraporrapor=array();
	$jmlmatpel=0;
	$jmlkosong= array();
	$prosessubvariabel=array();
	foreach((array)$kelompok as $rowkelompok) {
		if ($matkel<>$rowkelompok->matpelkelompok){
			$arraypsv[$rowkelompok->matpelkelompok]=array();
			$arraypdv[$rowkelompok->matpelkelompok][$rowkelompok->prosessubvariabel]=array();
			array_push($arraympk,$rowkelompok->matpelkelompok);
			$cskel[$rowkelompok->matpelkelompok]=0;
		}

		if (!in_array($rowkelompok->prosessubvariabel,$prosessubvariabel)){ // all psv
			array_push($prosessubvariabel,$rowkelompok->prosessubvariabel);
		}

		if (!in_array($rowkelompok->prosessubvariabel,$arraypsv[$rowkelompok->matpelkelompok])){  // psv per kelompok
			array_push($arraypsv[$rowkelompok->matpelkelompok],$rowkelompok->prosessubvariabel);
			$arraypdv[$rowkelompok->matpelkelompok][$rowkelompok->prosessubvariabel]=array();
		}
		if (ISSET($nilaiavgmatpel[$rowkelompok->matpel][$rowkelompok->prosessubvariabel])){
				$nilaiavgmatpel[$rowkelompok->matpel][$rowkelompok->prosessubvariabel]=$nilaiavgmatpel[$rowkelompok->matpel][$rowkelompok->prosessubvariabel]+$rowkelompok->nilaiasli;
		}else{
			$nilaiavgmatpel[$rowkelompok->matpel][$rowkelompok->prosessubvariabel]=$rowkelompok->nilaiasli;
		}
		if (ISSET($nilaiavgsubvar[$rowkelompok->prosessubvariabel])){
				$nilaiavgsubvar[$rowkelompok->prosessubvariabel]=$nilaiavgsubvar[$rowkelompok->prosessubvariabel]+$rowkelompok->nilaiasli;
		}else{
				$nilaiavgsubvar[$rowkelompok->prosessubvariabel]=$rowkelompok->nilaiasli;
		}

		if (ISSET($jmlkosong[$rowkelompok->prosessubvariabel])){
				$jmlkosong[$rowkelompok->prosessubvariabel]=$jmlkosong[$rowkelompok->prosessubvariabel];
		}else{
				$jmlkosong[$rowkelompok->prosessubvariabel]=0;
		}

		if($rowkelompok->nilaiasli<1){
			$jmlkosong[$rowkelompok->prosessubvariabel]=$jmlkosong[$rowkelompok->prosessubvariabel]+1;
		}


		if (ISSET($nilaiavgsubvarrapor[$rowkelompok->prosessubvariabel])){
				$nilaiavgsubvarrapor[$rowkelompok->prosessubvariabel]=$nilaiavgsubvarrapor[$rowkelompok->prosessubvariabel]+(($rowkelompok->persentasemurnisv/100)*$rowkelompok->nilaiasli);
		}else{
				$nilaiavgsubvarrapor[$rowkelompok->prosessubvariabel]=(($rowkelompok->persentasemurnisv/100)*$rowkelompok->nilaiasli);
		}

		if ($matpel<>$rowkelompok->matpel){
			$jmlmatpel++;
		}



		$matkel=$rowkelompok->matpelkelompok;
		$matpel=$rowkelompok->matpel;
	}
	
	?>
			<p align='justify'>
				Ketua PKBM Kak Seto Program "<i>Homeschooling</i>" Pusat menerangkan dengan sesungguhnya bahwa:
			</p>
		<table border="0">
							<tr>
	            	<td align="left" width="150">Nama Peserta Didik</td><td width="20">:</td><td><b><?php echo ucwords(strtoupper($isi->siswa)); ?></b></td>
	            </tr>
							<tr>
	            	<td align="left">Tempat, Tanggal Lahir</td><td>:</td><td><b><?php echo ucwords(strtolower($isi->tmplahir)).', '.$CI->p_c->tgl_indo($isi->tgllahir) ; ?></b></td>
	            </tr>
	            <tr>
	            	<td align="left">NISN</td><td>:</td><td><b><?php echo $isi->nisn; ?></b></td>
	            </tr>
							<tr>
	            	<td align="left">Nomor Peserta</td><td>:</td><td><b><?php echo $isi->nomorpeserta; ?></b></td>
	            </tr>
	            <tr>
	            	<td align="left">Satuan Pendidikan Asal</td><td>:</td><td><b><?php echo "PKBM Kak Seto"; ?></b></td>
	            </tr>
			</table>
			<!--
			<p align='justify'>
				Adalah peserta Ujian Sekolah Berstandar Nasional (USBN) dan Ujian Nasional Berbasis Komputer (UNBK) Paket <?php echo $paket; ?> PKBM Kak Seto Tahun Pelajaran <?php echo $isi->tahunajaran; ?>
				dan berdasarkan kriteria kelulusan peserta didik pada Satuan Pendidikan Paket <?php echo $paket; ?> PKBM Kak Seto dinyatakan:
			</p>
			-->
			<p align='justify'>
				Adalah peserta Ujian Pendidikan Kesetaraan Paket <?php echo $paket; ?> PKBM Kak Seto Tahun Pelajaran <?php echo $isi->tahunajaran; ?>
				dan berdasarkan kriteria kelulusan peserta didik pada Satuan Pendidikan Paket <?php echo $paket; ?> PKBM Kak Seto dinyatakan:
			</p>
			<p align='center'>
				<?php
				$nilaiakhir=0;
				foreach((array)$nilaiavgsubvarrapor as $rownilaiavgsubvarrapor) {
					$nilaiakhir=$nilaiakhir+($rownilaiavgsubvarrapor/$jmlmatpel);
				}
				if ($nilaiakhir>=$isi->batasnilai){
					echo "<h4>L U L U S</h4>";
				}else{
					echo "<h4>T I D A K  L U L U S</h4>";
				}
				?>
			</p>
			<p align='justify'>Dengan Daftar Nilai sebagai berikut:</p>
			<?php
			$jml_kel=1;
			//harus dihilangkan untuk header perulangan
			//----------------------------------------
			$no=1;
			echo "<table style='border-collapse:collapse' border='1' class='lpd' cellpadding='3'>";
			$matkel="";
			foreach((array)$arraympk as $rowmpk) {
				$nilaimp=0;
				//if ($matkel<>$rowmpk){
							//$no=1;
							if ($no==1){ //agar header tidak berulang
									$matkelcs=COUNT($arraypsv)+2+$isi->kkmon;
									if ($jml_kel<>1){
										//echo "</table><br/>";
									}
									//echo "<table style='border-collapse:collapse' border='1' class='lpd' cellpadding='3'>";
									echo "<tr>";
									//echo "<td align='' colspan='".$matkelcs."'><b>".strtoupper($rowmpk)."</b></td>";
									echo "</tr>";
									echo "<tr>";
									echo "<th width='50' rowspan='2'>No.</th>";
									echo "<th width='270' rowspan='2'>Mata Pelajaran</th>";
									if($isi->kkmon==1){
											echo "<th width='65' rowspan='2'>KKM</th>";
									}
									foreach((array)$arraypsv[$rowmpk] as $rowpsv) {
										echo "<th width='270' >".$rowpsv."</th>";
									}
									echo "</tr>";
									echo "<tr>";
									foreach((array)$arraypsv[$rowmpk] as $rowpsv) {
										foreach((array)$arraypdv[$rowmpk][$rowpsv] as $rowpdv) {
											echo "<th width='270'>".$rowpdv."</th>";
										}
									}
									echo "</tr>";
							}

							foreach((array)$kelompok as $rowkelompok) {
								if($rowmpk==$rowkelompok->matpelkelompok){
									if($no<2){
										echo "</tr>";
									}
									if ($matpel<>$rowkelompok->matpel){
										echo "<tr>";
										echo "<td align='center'>".$no++."</td>";
										echo "<td align='left'>".ucwords(strtolower($rowkelompok->matpel));
										//echo var_dump($nilaiavgmatpel[$rowkelompok->matpel]);
										if($rowkelompok->matpelexternal){
											echo "&nbsp;".$isi->external;
										}
										echo "</td>";
										if($isi->kkmon==1){echo "<td align='center'>".strtoupper($rowkelompok->kkm)."</td>";}
										foreach((array)$nilaiavgmatpel[$rowkelompok->matpel] as $rownilai) {
											if($rownilai>0){
													echo "<td align='center'>".number_format($rownilai,1)."</td>";
											}else{
													echo "<td align='center' bgcolor='grey'>-</td>";
											}

										}

									}

									/*else{
										if($prosessubvariabel<>$rowkelompok->prosessubvariabel){
											echo "<td align='center'>".$rowkelompok->nilai."</td>";
										}

									}
									*/
								}
								$matpel=$rowkelompok->matpel;
								//$prosessubvariabel=$rowkelompok->prosessubvariabel;
							}
					//}
					$matkel=$rowmpk;$jml_kel++;
			} //foreach((array)$kelompok as $rowkelompok) {
			echo "<tr>";
			echo "<td align='right' colspan='2'><b>Rata Rata&nbsp;</b></td>";
			/*
			foreach((array)$nilaiavgsubvar as $rownilaisubvar) {
				echo "<td align='center'>".number_format(($rownilaisubvar/$jmlmatpel),1)."</td>";
			}
			*/
			foreach((array)$prosessubvariabel as $idpsv) {
				$matpelkosong=0;
				if (($jmlmatpel-$jmlkosong[$idpsv])==0){
					$matpelkosong=$jmlmatpel;
				}else{
					$matpelkosong=$jmlmatpel-$jmlkosong[$idpsv];
				}
				echo "<td align='center'>".number_format(($nilaiavgsubvar[$idpsv]/$matpelkosong),1)."</td>";
			}
			echo "</tr>";
			?>


					</tbody>
					<tfoot>
					</tfoot>
			</table>
			<p align='justify'>
				<!--
				Surat Keterangan ini bersifat sementara dan dapat digunakan sebagai pengganti Ijazah dan Surat Hasil Ujian Nasional (SHUN) sampai diterbitkan dokumen Ijazah dan SHUN aslinya.
			-->
			Surat Keterangan ini bersifat sementara dan dapat digunakan sebagai pengganti Ijazah sampai diterbitkan dokumen Ijazah aslinya.
			</p>
<?php
} else if($isi->tipe=='LPD'){
?>
				<table border=0 width="100%">
				<tr>
						<td><b>A. Pengetahuan</b></td>
				</tr>
				<tr>
						<td style="padding-left:30px">
									<?php
									$matkel="";$jml_kel=0;
									$idmatpel="";
									$nilaimp13=array();
									$matpelgroup=array();

									//HITUNG

									foreach((array)$kelompok as $pengetahuan) {
											if (isset($nilaimp13[$pengetahuan->idmatpel][$pengetahuan->idmodultipe])){
												$nilaimp13[$pengetahuan->idmatpel][$pengetahuan->idmodultipe]=$nilaimp13[$pengetahuan->idmatpel][$pengetahuan->idmodultipe]+$pengetahuan->nilai;
											}else{
												$nilaimp13[$pengetahuan->idmatpel][$pengetahuan->idmodultipe]=$pengetahuan->nilai;
											}

											if (isset($nilaimp13group[$pengetahuan->idgroup][$pengetahuan->idmodultipe])){
												$nilaimp13group[$pengetahuan->idgroup][$pengetahuan->idmodultipe]=$nilaimp13group[$pengetahuan->idgroup][$pengetahuan->idmodultipe]+$pengetahuan->nilai;
											}else{
												$nilaimp13group[$pengetahuan->idgroup][$pengetahuan->idmodultipe]=$pengetahuan->nilai;
											}
											$matpelgroup[$pengetahuan->idgroup][$pengetahuan->idmatpel]=$pengetahuan->matpel;
									}
									//echo var_dump($nilaimp13[92]);
									//echo var_dump($kelompok);
									//TAMPIL
									$idmodultipe="";$no=1;$grouptext="";
									$csx=4+$isi->kkmon+$isi->predikaton;
									foreach((array)$kelompok as $pengetahuan) {
										$nilaimp=0;$jml_kel++;
										//$nilaimp=$CI->ns_rapor_baru_db->hitnilai_db($isi->idkelas,$isi->idsiswa,$pengetahuan->idmatpel,$isi->idtahunajaran,$isi->departemen,$isi->idregion,$isi->idrapottipe,$isi->nilaimurni,$isi->idperiode,$pengetahuan->idmatpelkelompok);
										//echo var_dump($nilaimp);die;
										if ($matkel<>$pengetahuan->matpelkelompok){
											 //$no=1;
												if ($jml_kel<=1){
													?>
													<table class='table tablecontent'>
																<thead>
																	<?php
																		echo "<tr>";
																		echo "<th width='25' align='center'>No.</th>";
																		echo "<th width='200'>Grup</th>";
																		echo "<th>Mata Pelajaran</th>";
																		if($isi->kkmon==1){
																				echo "<th width='60' rowspan='2'>KKM</th>";
																		}
																		echo "<th width='120'>Nilai</th>";
																		if($isi->predikaton==1){
																			echo "<th align='center'>Predikat</th>";
																		}
																		echo "</tr>";
																		echo "<tr>";
																		echo "<th align='left' colspan='".$csx."'>".ucwords(strtolower($pengetahuan->matpelkelompok))."</th>";
																		echo "</tr>";
																	?>
																</thead>
																<tbody>
													<?php
													} else {
														echo "<tr>";
																	echo "<td align='' colspan='".$csx."'><b>".ucwords(strtolower($pengetahuan->matpelkelompok))."</b></td>";
																	echo "</tr>";

													}//if $jml_kel
											}


										if($idmatpel<>$pengetahuan->idmatpel){
													echo "<tr>";
													echo "<td align='center'>".$no++."</td>";
													echo "<td align='left'>".ucwords(strtolower($pengetahuan->grouptext))."</td>";
													echo "<td align='left'>".$pengetahuan->matpel;
													if($pengetahuan->matpelexternal){
														echo "&nbsp;".$isi->external;
													}
													echo "</td>";
													if($isi->kkmon==1){echo "<td align='center'>".strtoupper($pengetahuan->kkm)."</td>";}
													$nilaimp13_tot = array_filter($nilaimp13[$pengetahuan->idmatpel]);
													if(array_sum($nilaimp13_tot)<1){
														$average=0;
													}else{
														$average = array_sum($nilaimp13_tot)/count($nilaimp13_tot);
													}
													echo "<th align='center'>".CEIL($average)."</th>";
													if($isi->predikaton==1){
														echo "<th align='center'>".strtoupper($CI->dbx->ns_predikat($isi->departemen,CEIL($average),$pengetahuan->idpredikattipe))."</th>";
													}
											}
											$matkel=$pengetahuan->matpelkelompok;
											$idmatpel=$pengetahuan->idmatpel;
											$idmodultipe=$pengetahuan->idmodultipe;
											$grouptext=$pengetahuan->grouptext;
									} //foreach((array)$kelompok as $pengetahuan) {
										?>

											</tbody>
									</table>
								</td>
						</tr>
						<tr>
								<td><b>B. Keterampilan</b></td>
						</tr>
						<tr>
								<td style="padding-left:30px">
									<?php
									$matkel="";$jml_kel=0;
									$$csx=4+$isi->kkmon+$isi->predikaton;
									$idmatpel="";
									$nilaimp13=array();
									$matpelgroup=array();

									//HITUNG

									foreach((array)$kelompok2 as $keterampilan) {
											if (isset($nilaimp13[$keterampilan->idmatpel][$keterampilan->idmodultipe])){
												$nilaimp13[$keterampilan->idmatpel][$keterampilan->idmodultipe]=$nilaimp13[$keterampilan->idmatpel][$keterampilan->idmodultipe]+$keterampilan->nilai;
											}else{
												$nilaimp13[$keterampilan->idmatpel][$keterampilan->idmodultipe]=$keterampilan->nilai;
											}

											if (isset($nilaimp13group[$keterampilan->idgroup][$keterampilan->idmodultipe])){
												$nilaimp13group[$keterampilan->idgroup][$keterampilan->idmodultipe]=$nilaimp13group[$keterampilan->idgroup][$keterampilan->idmodultipe]+$keterampilan->nilai;
											}else{
												$nilaimp13group[$keterampilan->idgroup][$keterampilan->idmodultipe]=$keterampilan->nilai;
											}

											$matpelgroup[$keterampilan->idgroup][$keterampilan->idmatpel]=$keterampilan->matpel;
									}

									//TAMPIL
									$idmodultipe="";$no=1;$grouptext="";
									foreach((array)$kelompok2 as $keterampilan) {
										$nilaimp=0;$jml_kel++;
										//$nilaimp=$CI->ns_rapor_baru_db->hitnilai_db($isi->idkelas,$isi->idsiswa,$keterampilan->idmatpel,$isi->idtahunajaran,$isi->departemen,$isi->idregion,$isi->idrapottipe,$isi->nilaimurni,$isi->idperiode,$keterampilan->idmatpelkelompok);
										//echo var_dump($nilaimp);die;
										if ($matkel<>$keterampilan->matpelkelompok){
											 //$no=1;
												if ($jml_kel<=1){
													?>
													<table class='table tablecontent'>
																<thead>
																	<?php
																		echo "<tr>";
																		echo "<th width='25' align='center'>No.</th>";
																		echo "<th width='200'>Grup</th>";
																		echo "<th>Mata Pelajaran</th>";
																		if($isi->kkmon==1){
																				echo "<th width='60' rowspan='2'>KKM</th>";
																		}
																		echo "<th width='120'>Nilai</th>";
																		if($isi->predikaton==1){
																			echo "<th align='center'>Predikat</th>";
																		}
																		echo "</tr>";
																		echo "<tr>";
																		echo "<td align='' colspan='".$csx."'><b>".ucwords(strtolower($keterampilan->matpelkelompok))."</b></td>";
																		echo "</tr>";
																	?>
																</thead>
																<tbody>
													<?php
													} else {
														echo "<tr>";
																	echo "<td align='' colspan='".$csx."'><b>".ucwords(strtolower($keterampilan->matpelkelompok))."</b></td>";
																	echo "</tr>";

													}//if $jml_kel
											}


											if($idmatpel<>$keterampilan->idmatpel){
												echo "<tr>";
												echo "<td align='center'>".$no++."</td>";
												echo "<td align='left'>".ucwords(strtolower($keterampilan->grouptext))."</td>";
												echo "<td align='left'>".$keterampilan->matpel;
												if($keterampilan->matpelexternal){
													echo "&nbsp;".$isi->external;
												}
												echo "</a>";
												echo "</td>";
												if($isi->kkmon==1){echo "<td align='center'>".strtoupper($keterampilan->kkm)."</td>";}

												$nilaimp13_tot = array_filter($nilaimp13[$keterampilan->idmatpel]);
												if(array_sum($nilaimp13_tot)<1){
														$average=0;
												}else{
														$average = array_sum($nilaimp13_tot)/count($nilaimp13_tot);
												}
												echo "<th align='center'>".CEIL($average)."</th>";
												if($isi->predikaton==1){
													echo "<th align='center'>".strtoupper($CI->dbx->ns_predikat($isi->departemen,CEIL($average),$keterampilan->idpredikattipe))."</th>";
												}
											} //$idmatpel<>$keterampilan->idmatpel


											$matkel=$keterampilan->matpelkelompok;
											$idmatpel=$keterampilan->idmatpel;
											$idmodultipe=$keterampilan->idmodultipe;
											$grouptext=$keterampilan->grouptext;
									} //foreach((array)$kelompok as $keterampilan) {
										?>

													</tbody>
											</table>
										</td>
								</tr>
							</table>
<?php
}else if($isi->tipe=='Reguler'){ //lpd //RAPORT REGULER
				// RAPOR UTAMA
				// ----------------------------------------------------------------------------------------------------------------------------------
				// ----------------------------------------------------------------------------------------------------------------------------------
						$header_count="A";
						?>
							<div id="divheader">
								<font><b><?php echo $header_count++ ?>. Sikap</b></font>
							</div>
							<div id="divcontent">
										1. Sikap Spiritual
										<table class='table tablecontent'>
											<tr>
												<th width="100">Predikat</th>
												<th>Deskripsi</th>
											</tr>
											<tr>
												<td valign="center" align="center" height="100px"><font style="font-size:14pt !important;"><h1><?php echo $isi->predikatspiritualtext?></h1></font></td>
												<td valign="center">
														<?php
																if($isi->descspiritualtext<>""){
																	echo $isi->descspiritualtext."<br/><br/>";
																}
																echo $isi->spiritualtext;
														?>
												</td>
											</tr>
										</table><br/>
											2. Sikap Sosial
											<table class='table tablecontent'>
											<tr>
													<th width="100">Predikat</th>
													<th>Deskripsi</th>
											</tr>
											<tr>
												<td valign="center" align="center" width="100" height="100px"><font style="font-size:14pt !important;"><h1><?php echo $isi->predikatsosialtext?></h1></font></td>
												<td valign="center">
														<?php
																if($isi->descsosialtext<>""){
																	echo $isi->descspiritualtext."<br/><br/>";
																}
																echo $isi->sosialtext
														?>
												</td>
											</tr>
										</table>
							</div>


							<?php
							if($isi->satutabel==1){
								$csx=2+$isi->skkon+$isi->kkmon+$isi->kalimatraporon+(2*COUNT($arrmodultipe))+$isi->matpeldeskripsion;
								if($isi->predikaton==1){
									$csx=$csx+(2*COUNT($arrmodultipe));
								}
							}else{
								$csx=2+$isi->skkon+$isi->kkmon+$isi->kalimatraporon+COUNT($arrmodultipe)+$isi->matpeldeskripsion;
								if($isi->predikaton==1){
									$csx=$csx+COUNT($arrmodultipe);
								}
							}


							//HITUNG PENGETAHUAN
							$nilaimp13=array();
							$nilaimp13group=array();
							$matpelgroup=array();
							//ceknilai
							foreach((array)$kelompok as $pengetahuan) {
									if (isset($nilaimp13[$pengetahuan->idmatpel][$pengetahuan->idmodultipe])){
										$nilaimp13[$pengetahuan->idmatpel][$pengetahuan->idmodultipe]=$nilaimp13[$pengetahuan->idmatpel][$pengetahuan->idmodultipe]+$pengetahuan->nilai;
									}else{
										$nilaimp13[$pengetahuan->idmatpel][$pengetahuan->idmodultipe]=$pengetahuan->nilai;
									}

									if (isset($nilaimp13group[$pengetahuan->idgroup][$pengetahuan->idmatpel][$pengetahuan->idmodultipe])){
										$nilaimp13group[$pengetahuan->idgroup][$pengetahuan->idmatpel][$pengetahuan->idmodultipe]=$nilaimp13group[$pengetahuan->idgroup][$pengetahuan->idmatpel][$pengetahuan->idmodultipe]+$pengetahuan->nilai;
									}else{
										$nilaimp13group[$pengetahuan->idgroup][$pengetahuan->idmatpel][$pengetahuan->idmodultipe]=$pengetahuan->nilai;
									}

									$matpelgroup[$pengetahuan->idgroup][$pengetahuan->idmatpel]=$pengetahuan->matpel;
							}

							//HITUNG KETERAMPILAN
							$keterampilanmp13=array();
							$keterampilanmp13group=array();
							$matpelgroupketerampilan=array();
							foreach((array)$kelompok2 as $keterampilan) {
									if (isset($keterampilanmp13[$keterampilan->idmatpel][$keterampilan->idmodultipe])){
										$keterampilanmp13[$keterampilan->idmatpel][$keterampilan->idmodultipe]=$keterampilanmp13[$keterampilan->idmatpel][$keterampilan->idmodultipe]+$keterampilan->nilai;
									}else{
										$keterampilanmp13[$keterampilan->idmatpel][$keterampilan->idmodultipe]=$keterampilan->nilai;
									}

									if (isset($keterampilanmp13group[$keterampilan->idgroup][$keterampilan->idmatpel][$keterampilan->idmodultipe])){
										$keterampilanmp13group[$keterampilan->idgroup][$keterampilan->idmatpel][$keterampilan->idmodultipe]=$keterampilanmp13group[$keterampilan->idgroup][$keterampilan->idmatpel][$keterampilan->idmodultipe]+$keterampilan->nilai;
									}else{
										$keterampilanmp13group[$keterampilan->idgroup][$keterampilan->idmatpel][$keterampilan->idmodultipe]=$keterampilan->nilai;
									}

									$matpelgroupketerampilan[$keterampilan->idgroup][$keterampilan->idmatpel]=$keterampilan->matpel;
							}

							//HITUNG NON AKADEMIK
							$nonakademikmp13=array();
							$nonakademikmp13group=array();
							$matpelgroupnonakademik=array();
							foreach((array)$nonakademikdata as $nonakademik) {
									if (isset($nonakademikmp13[$nonakademik->idmatpel][$nonakademik->idmodultipe])){
										$nonakademikmp13[$nonakademik->idmatpel][$nonakademik->idmodultipe]=$nonakademikmp13[$nonakademik->idmatpel][$nonakademik->idmodultipe]+$nonakademik->nilai;
									}else{
										$nonakademikmp13[$nonakademik->idmatpel][$nonakademik->idmodultipe]=$nonakademik->nilai;
									}

									if (isset($nonakademikmp13group[$nonakademik->idgroup][$nonakademik->idmodultipe])){
										$nonakademikmp13group[$nonakademik->idgroup][$nonakademik->idmodultipe]=$nonakademikmp13group[$nonakademik->idgroup][$nonakademik->idmodultipe]+$nonakademik->nilai;
									}else{
										$nonakademikmp13group[$nonakademik->idgroup][$nonakademik->idmodultipe]=$nonakademik->nilai;
									}

									$matpelgroupnonakademik[$nonakademik->idgroup][$nonakademik->idmatpel]=$nonakademik->matpel;
							}

							//echo var_dump($keterampilanmp13);die;
							if($isi->satutabel<>1){
								if($excel<>1){
									echo $headerrapot."<br/>";
								}
							?>

							<div id="divheader">
								<font><b><?php echo $header_count++ ?>. Pengetahuan</b></font>
							</div>
							<div id="divcontent">
												<?php
												//TAMPIL
												$matkel="";$idmodultipe="";$no=1;$grouptext="";$jml_kel=0;$idmatpel="";$colspanmodul=0;$rowspanmodul="";
												//$modular=$isi->modular;
												foreach((array)$kelompok as $pengetahuan) {
													$nilaimp=0;$jml_kel++;
													//$nilaimp=$CI->ns_rapor_baru_db->hitnilai_db($isi->idkelas,$isi->idsiswa,$pengetahuan->idmatpel,$isi->idtahunajaran,$isi->departemen,$isi->idregion,$isi->idrapottipe,$isi->nilaimurni,$isi->idperiode,$pengetahuan->idmatpelkelompok);
													//echo var_dump($nilaimp);die;
													if($modular>0){$colspanmodul=COUNT($arrmodultipe);$rowspanmodul=" rowspan='2' ";}
													if ($matkel<>$pengetahuan->matpelkelompok){
														 //$no=1;
															if ($jml_kel<=1){
																echo "<table class='table tablecontent'>";
																echo "<thead>";
																					echo "<tr>";
																					echo "<th width='25' '".$rowspanmodul."' align='center'>No.</th>";
																					echo "<th '".$rowspanmodul."'>Mata Pelajaran</th>";
																					if($isi->skkon==1){
																						echo "<th width='25' '".$rowspanmodul."' align='center'>SKK</th>";
																					}
																					if($isi->kkmon==1){
																							echo "<th width='25' '".$rowspanmodul."' align='center'>KKM</th>";
																					}
																					echo "<th colspan=".($colspanmodul)." align='center'>Nilai</th>";
																					if($isi->predikaton==1){
																						echo "<th colspan=".($colspanmodul)." align='center'>Predikat</th>";
																					}
																					if($isi->matpeldeskripsion){
																						echo "<th width='25' '".$rowspanmodul."' align='center'>Deskripsi</th>";
																					}
																					echo "</tr>";
																					if($modular>0){
																							echo "<tr>";
																							foreach((array)$arrmodultipe as $rowmodultipe) {
																								echo "<th align='center' width='45px'>Modul ".$rowmodultipe->idmodultipe."</th>";
																							}
																							if($isi->predikaton==1){
																								foreach((array)$arrmodultipe as $rowmodultipe) {
																									echo "<th align='center' width='45px'>Modul ".$rowmodultipe->idmodultipe."</th>";
																								}
																							}
																							echo "</tr>";
																					}
																					echo "<tr>";
																					echo "<td align='' colspan='".$csx."'><b>".ucwords(strtolower($pengetahuan->matpelkelompok))."</b></td>";
																					echo "</tr>";
																				echo "</thead>";
																} else {
																	echo "<tr>";
																				echo "<td align='' colspan='".$csx."'><b>".ucwords(strtolower($pengetahuan->matpelkelompok))."</b></td>";
																				echo "</tr>";

																}//if $jml_kel
														}


														if($pengetahuan->groupon<>"1"){
																		if($idmatpel<>$pengetahuan->idmatpel){
																			echo "<tr>";
																			echo "<td align='center'>".$no++."</td>";
																			echo "<td align='left'>".$pengetahuan->matpel;
																			if($pengetahuan->matpelexternal){
																				echo "&nbsp;".$isi->external;
																			}
																			echo "</td>";
																			if($isi->skkon==1){
																				echo "<td align='center'>".strtoupper($pengetahuan->jumlahskk)."</td>";
																			}
																			if($isi->kkmon==1){echo "<td align='center'>".strtoupper($pengetahuan->kkm)."</td>";}

																			if(($pengetahuan->detail<>1) OR ($modular<>1)){
																						$nilaimp13_tot = array_filter($nilaimp13[$pengetahuan->idmatpel]);
																						if(array_sum($nilaimp13_tot)<1){
																							$average=0;
																						}else{
																							$average = array_sum($nilaimp13_tot)/count($nilaimp13_tot);
																						}
																						echo "<th colspan=".($colspanmodul)." align='center'>".CEIL($average)."</th>";
																			}else{
																				foreach((array)$arrmodultipe as $rowmodultipe) {
																					if (isset($nilaimp13[$pengetahuan->idmatpel][$rowmodultipe->idmodultipe])){
																							echo "<th width='*' align='center'>".CEIL($nilaimp13[$pengetahuan->idmatpel][$rowmodultipe->idmodultipe])."</th>";
																					}else{
																						echo "<th width='*' align='center' align='center'>-</th>";
																					}
																				}
																			}

																	if(($pengetahuan->detail<>1) OR ($modular<>1)){
																			echo "<th colspan=".($colspanmodul)." align='center'>".strtoupper($CI->dbx->ns_predikat($isi->departemen,CEIL($average),$pengetahuan->idpredikattipe))."</th>";
																	}else{
																		foreach((array)$arrmodultipe as $rowmodultipe) {
																			if (isset($nilaimp13[$pengetahuan->idmatpel][$rowmodultipe->idmodultipe])){
																					echo "<th width='*' align='center'>".strtoupper($CI->dbx->ns_predikat($isi->departemen,CEIL($nilaimp13[$pengetahuan->idmatpel][$rowmodultipe->idmodultipe]),$pengetahuan->idpredikattipe))."</th>";
																			}else{
																				echo "<th width='*' align='center'>-</th>";
																			}
																		}
																	}
																	if($isi->matpeldeskripsion){
																		echo "<td width='200'  align='justify'><font align='justify' style='width:100% !important'>".$pengetahuan->matpeldeskripsitext."</font></td>";
																	}
																} //$idmatpel<>$pengetahuan->idmatpel
														}else{ //$pengetahuan->group<>"1"
															$average=0;
															if($grouptext<>$pengetahuan->grouptext){
																echo "<tr>";
																echo "<td align='center'>".$no++."</td>";
																echo "<td align='left'>".$pengetahuan->grouptext;
																echo "</td>";
																if($isi->skkon==1){
																	echo "<td align='center'>".strtoupper($pengetahuan->jumlahskk)."</td>";
																}
																if($isi->kkmon==1){echo "<td align='center'>".strtoupper($pengetahuan->kkm)."</td>";}
																if(($pengetahuan->detail<>1) OR ($modular<>1)){
																	$nilaimp13_tot = array_filter($nilaimp13group[$pengetahuan->idgroup]);
																	foreach ((array)$nilaimp13_tot as $vararray) {
																		$average += array_sum($vararray)/COUNT($vararray);
																	}
																	$average = $average/COUNT($matpelgroup[$pengetahuan->idgroup]);
																	echo "<th colspan=".($colspanmodul)." align='center'>".CEIL($average)."</th>";
																}else{
																	foreach((array)$arrmodultipe as $rowmodultipe) {
																		if (isset($nilaimp13group[$pengetahuan->idgroup][$rowmodultipe->idmodultipe])){
																				echo "<th width='*' align='center'>".CEIL($nilaimp13group[$pengetahuan->idgroup][$rowmodultipe->idmodultipe])."</th>";
																		}else{
																			echo "<th width='*' align='center'>-</th>";
																		}
																	}
																}

																//predikat
																if(($pengetahuan->detail<>1) OR ($modular<>1)){
																		echo "<th colspan=".($colspanmodul)." align='center'>".strtoupper($CI->dbx->ns_predikat($isi->departemen,CEIL($average),$pengetahuan->idpredikattipe))."</th>";
																}else{
																	foreach((array)$arrmodultipe as $rowmodultipe) {
																		if (isset($nilaimp13group[$pengetahuan->idgroup][$rowmodultipe->idmodultipe])){
																				echo "<th width='*' align='center'>".strtoupper($CI->dbx->ns_predikat($isi->departemen,CEIL($nilaimp13group[$pengetahuan->idgroup][$rowmodultipe->idmodultipe]),$pengetahuan->idpredikattipe))."</th>";
																		}else{
																			echo "<th width='*' align='center'>-</th>";
																		}
																	}
																}
																if($isi->matpeldeskripsion){
																	echo "<td width='200'  align='justify'><font align='justify' style='width:100% !important'>".$pengetahuan->matpeldeskripsitext."</font></td>";
																}
															}
														} //$pengetahuan->group<>"1"

														$matkel=$pengetahuan->matpelkelompok;
														$idmatpel=$pengetahuan->idmatpel;
														$idmodultipe=$pengetahuan->idmodultipe;
														$grouptext=$pengetahuan->grouptext;
												} //foreach((array)$kelompok as $pengetahuan) {
													?>

														</tbody>
												</table>
									</div>
									<!-- KETERAMPILAN -->
									<?php
									if ($kelompok2<>NULL){
										if($excel<>1){
											echo $headerrapot."<br/>";
										}
										
									?>
									<div id="divheader">
										<font><b><?php echo $header_count++ ?>. Keterampilan</b></font>
									</div>
									<div id="divcontent">
											<td style="padding-left:30px">
												<?php
												//TAMPIL Keterampilan
												$matkel="";$idmodultipe="";$no=1;$grouptext="";$jml_kel=0;$idmatpel="";
												foreach((array)$kelompok2 as $keterampilan) {
													$nilaimp=0;$jml_kel++;
													//$nilaimp=$CI->ns_rapor_baru_db->hitnilai_db($isi->idkelas,$isi->idsiswa,$keterampilan->idmatpel,$isi->idtahunajaran,$isi->departemen,$isi->idregion,$isi->idrapottipe,$isi->nilaimurni,$isi->idperiode,$keterampilan->idmatpelkelompok);
													//echo var_dump($nilaimp);die;
													if($modular>0){$colspanmodul=COUNT($arrmodultipe);$rowspanmodul=" rowspan='2' ";}
													if ($matkel<>$keterampilan->matpelkelompok){
														 //$no=1;
															if ($jml_kel<=1){
																echo "<table class='table tablecontent'>";
																echo "<thead>";

																					echo "<tr>";
																					echo "<th width='25' '".$rowspanmodul."' align='center'>No.</th>";
																					echo "<th '".$rowspanmodul."'>Mata Pelajaran</th>";
																					if($isi->skkon==1){
																						echo "<th width='25' '".$rowspanmodul."' align='center'>SKK</th>";
																					}
																					if($isi->kkmon==1){
																							echo "<th width='25' '".$rowspanmodul."' align='center'>KKM</th>";
																					}
																					echo "<th colspan=".($colspanmodul)." align='center'>Nilai</th>";
																					if($isi->predikaton==1){
																						echo "<th colspan=".($colspanmodul)." align='center'>Predikat</th>";
																					}
																					if($isi->matpeldeskripsion){
																						echo "<th width='25' '".$rowspanmodul."' align='center'>Deskripsi</th>";
																					}
																					echo "</tr>";
																					if($modular>0){
																						echo "<tr>";
																						foreach((array)$arrmodultipe as $rowmodultipe) {
																							echo "<th align='center' width='45px'>Modul ".$rowmodultipe->idmodultipe."</th>";
																						}
																						if($isi->predikaton==1){
																							foreach((array)$arrmodultipe as $rowmodultipe) {
																								echo "<th align='center' width='45px'>Modul ".$rowmodultipe->idmodultipe."</th>";
																							}
																						}
																						echo "</tr>";
																					}
																					echo "<tr>";
																					echo "<td align='' colspan='".$csx."'><b>".ucwords(strtolower($keterampilan->matpelkelompok))."</b></td>";
																					echo "</tr>";
																				?>
																			</thead>
																			<tbody>
																<?php
																} else {
																	echo "<tr>";
																				echo "<td align='' colspan='".$csx."'><b>".ucwords(strtolower($keterampilan->matpelkelompok))."</b></td>";
																				echo "</tr>";

																}//if $jml_kel
														}


														if($keterampilan->groupon<>"1"){
																if($idmatpel<>$keterampilan->idmatpel){
																	echo "<tr>";
																	echo "<td align='center'>".$no++."</td>";
																	echo "<td align='left'>".$keterampilan->matpel;
																	if($keterampilan->matpelexternal){
																		echo "&nbsp;".$isi->external;
																	}
																	echo "</td>";
																	if($isi->skkon==1){
																		echo "<td align='center'>".strtoupper($keterampilan->jumlahskk)."</td>";
																	}
																	if($isi->kkmon==1){echo "<td align='center'>".strtoupper($keterampilan->kkm)."</td>";}

																	if(($keterampilan->detail<>1) OR ($modular<>1)){
																		$keterampilanmp13_tot = array_filter($keterampilanmp13[$keterampilan->idmatpel]);
																		if(array_sum($keterampilanmp13_tot)<1){
																				$average=0;
																		}else{
																				$average = array_sum($keterampilanmp13_tot)/count($keterampilanmp13_tot);
																		}
																		echo "<th colspan=".($colspanmodul)." align='center'>".CEIL($average)."</th>";
																	}else{
																		foreach((array)$arrmodultipe as $rowmodultipe) {
																			if (isset($keterampilanmp13[$keterampilan->idmatpel][$rowmodultipe->idmodultipe])){
																					echo "<th width='*' align='center'>".CEIL($keterampilanmp13[$keterampilan->idmatpel][$rowmodultipe->idmodultipe])."</th>";
																			}else{
																				echo "<th width='*' align='center'>-</th>";
																			}
																		}
																	}

																	if(($keterampilan->detail<>1) OR ($modular<>1)){
																			echo "<th colspan=".($colspanmodul)." align='center'>".strtoupper($CI->dbx->ns_predikat($isi->departemen,CEIL($average),$keterampilan->idpredikattipe))."</th>";
																	}else{
																		foreach((array)$arrmodultipe as $rowmodultipe) {
																			if (isset($keterampilanmp13[$keterampilan->idmatpel][$rowmodultipe->idmodultipe])){
																					echo "<th width='*' align='center'>".strtoupper($CI->dbx->ns_predikat($isi->departemen,CEIL($keterampilanmp13[$keterampilan->idmatpel][$rowmodultipe->idmodultipe]),$keterampilan->idpredikattipe))."</th>";
																			}else{
																				echo "<th width='*' align='center'>-</th>";
																			}
																		}
																	}
																} //$idmatpel<>$keterampilan->idmatpel
														}else{ //$keterampilan->group<>"1"
															$average=0;
															if($grouptext<>$keterampilan->grouptext){
																echo "<tr>";
																echo "<td align='center'>".$no++."</td>";
																echo "<td align='left'>".$keterampilan->grouptext;
																echo "</td>";
																if($isi->skkon==1){
																		echo "<td align='center'>".strtoupper($keterampilan->jumlahskk)."</td>";
																}
																if($isi->kkmon==1){echo "<td align='center'>".strtoupper($keterampilan->kkm)."</td>";}

																if(($keterampilan->detail<>1) OR ($modular<>1)){
																	//echo var_dump($keterampilanmp13group)."<br/>";
																	$keterampilanmp13_tot = array_filter($keterampilanmp13group[$keterampilan->idgroup]);
																	foreach ((array)$keterampilanmp13_tot as $vararray) {

																		$average += array_sum($vararray)/COUNT($vararray);
																	}
																	$average = $average/COUNT($matpelgroup[$keterampilan->idgroup]);
																	echo "<th colspan=".($colspanmodul)." align='center'>".CEIL($average)."</th>";
																}else{
																	foreach((array)$arrmodultipe as $rowmodultipe) {
																		if (isset($keterampilanmp13group[$keterampilan->idgroup][$rowmodultipe->idmodultipe])){
																				echo "<th width='*' align='center'>".CEIL($keterampilanmp13group[$keterampilan->idgroup][$rowmodultipe->idmodultipe])."</th>";
																		}else{
																			echo "<th width='*' align='center'>-</th>";
																		}
																	}
																}

																if(($keterampilan->detail<>1) OR ($modular<>1)){
																		echo "<th colspan=".($colspanmodul)." align='center'>".strtoupper($CI->dbx->ns_predikat($isi->departemen,CEIL($average),$keterampilan->idpredikattipe))."</th>";
																}else{
																	foreach((array)$arrmodultipe as $rowmodultipe) {
																		if (isset($keterampilanmp13group[$keterampilan->idgroup][$rowmodultipe->idmodultipe])){
																				echo "<th width='*' align='center'>".strtoupper($CI->dbx->ns_predikat($isi->departemen,CEIL($keterampilanmp13group[$keterampilan->idgroup][$rowmodultipe->idmodultipe]),$keterampilan->idpredikattipe))."</th>";
																		}else{
																			echo "<th width='*' align='center'>-</th>";
																		}
																	}
																}
															}
														} //$keterampilan->group<>"1"

														$matkel=$keterampilan->matpelkelompok;
														$idmatpel=$keterampilan->idmatpel;
														$idmodultipe=$keterampilan->idmodultipe;
														$grouptext=$keterampilan->grouptext;
												} //foreach((array)$kelompok as $keterampilan) {
													?>

																</tbody>
														</table>
										</div>
										<?php }?>
										<!-- KETERAMPILAN -->
<!-------------------------------------------------------------------------------------------------------------------------------->
<!-------------------------------------------------------------------------------------------------------------------------------->

<?php
}else{
echo $headerrapot."<br/>"; ?>
<div id="divheader">
	<font><b><?php echo $header_count++ ?>. Pengetahuan Dan Keterampilan</b></font>
</div>
<div id="divcontent">
					<?php
					//TAMPIL
					$matkel="";$idmodultipe="";$no=1;$grouptext="";$jml_kel=0;$idmatpel="";$colspanmodul=0;$rowspanmodul="";
					$modular=$isi->modular;
					foreach((array)$kelompok as $pengetahuan) {
						$nilaimp=0;$jml_kel++;
						//$nilaimp=$CI->ns_rapor_baru_db->hitnilai_db($isi->idkelas,$isi->idsiswa,$pengetahuan->idmatpel,$isi->idtahunajaran,$isi->departemen,$isi->idregion,$isi->idrapottipe,$isi->nilaimurni,$isi->idperiode,$pengetahuan->idmatpelkelompok);
						//echo var_dump($nilaimp);die;
						if($modular==1){$colspanmodul=COUNT($arrmodultipe);$rowspanmodul=" rowspan='3' ";}else{$rowspanmodul=" rowspan='2' ";}
						if ($matkel<>$pengetahuan->matpelkelompok){
							 //$no=1;
								if ($jml_kel<=1){
									echo "<table class='table tablecontent breaktablepk'>";
									echo "<thead>";
														echo "<tr>";
														echo "<th width='25' '".$rowspanmodul."' align='center'>No.</th>";
														echo "<th '".$rowspanmodul."'>Mata Pelajaran</th>";
														if($isi->skkon==1){
															echo "<th width='25' '".$rowspanmodul."' align='center'>SKK</th>";
														}
														if($isi->kkmon==1){
																echo "<th width='25' '".$rowspanmodul."' align='center'>KKM</th>";
														}
														$colspansatutabel=(1+$isi->predikaton);
														if($modular==1){
															$colspansatutabel=$colspansatutabel*($colspanmodul);
														}
														echo "<th colspan=".$colspansatutabel." align='center'>Pengetahuan</th>";
														echo "<th colspan=".$colspansatutabel." align='center'>Keterampilan</th>";
														if($isi->matpeldeskripsion){
															echo "<th width='25' '".$rowspanmodul."' align='center'>Deskripsi</th>";
														}
														echo "</tr>";
														echo "<tr>";
														echo "<th colspan=".($colspanmodul)." align='center'>Nilai</th>";
														if($isi->predikaton==1){
															echo "<th colspan=".($colspanmodul)." align='center'>Predikat</th>";
														}
														echo "<th colspan=".($colspanmodul)." align='center'>Nilai</th>";
														if($isi->predikaton==1){
															echo "<th colspan=".($colspanmodul)." align='center'>Predikat</th>";
														}
														echo "</tr>";
														if($modular==1){
																echo "<tr>";
																foreach((array)$arrmodultipe as $rowmodultipe) {
																	echo "<th align='center' width='45px'>Modul ".$rowmodultipe->idmodultipe."</th>";
																}
																if($isi->predikaton==1){
																	foreach((array)$arrmodultipe as $rowmodultipe) {
																		echo "<th align='center' width='45px'>Modul ".$rowmodultipe->idmodultipe."</th>";
																	}
																}
																foreach((array)$arrmodultipe as $rowmodultipe) {
																	echo "<th align='center' width='45px'>Modul ".$rowmodultipe->idmodultipe."</th>";
																}
																if($isi->predikaton==1){
																	foreach((array)$arrmodultipe as $rowmodultipe) {
																		echo "<th align='center' width='45px'>Modul ".$rowmodultipe->idmodultipe."</th>";
																	}
																}
																echo "</tr>";
														}
														echo "</thead>";
														echo "<tr>";
														echo "<td align='' colspan='".$csx."'><b>".$pengetahuan->matpelkelompok."</b></td>";
														echo "</tr>";

									} else {
										echo "<tr>";
													echo "<td align='' colspan='".$csx."'><b>".($pengetahuan->matpelkelompok)."</b></td>";
													echo "</tr>";

									}//if $jml_kel
							}

							//isi
							//**************************************************************************************************************
							if($pengetahuan->groupon<>"1"){
											if($idmatpel<>$pengetahuan->idmatpel){
												echo "<tr class='breaktable'>";
												echo "<td align='center'>".$no++."</td>";
												echo "<td align='left'>".$pengetahuan->matpel;
												if($pengetahuan->matpelexternal){
													echo "&nbsp;".$isi->external;
												}
												echo "</td>";
												if($isi->skkon==1){
													echo "<td align='center'>".strtoupper($pengetahuan->jumlahskk)."</td>";
												}
												if($isi->kkmon==1){echo "<td align='center'>".strtoupper($pengetahuan->kkm)."</td>";}

												if(($pengetahuan->detail<>1) OR ($modular<>1)){
															$nilaimp13_tot = array_filter($nilaimp13[$pengetahuan->idmatpel]);
															if(array_sum($nilaimp13_tot)<1){
																$average=0;
															}else{
																$average = array_sum($nilaimp13_tot)/count($nilaimp13_tot);
															}
															echo "<th colspan=".($colspanmodul)." align='center'>".CEIL($average)."</th>";
															if($isi->predikaton==1){
																	echo "<th colspan=".($colspanmodul)." align='center'>".strtoupper($CI->dbx->ns_predikat($isi->departemen,CEIL($average),$pengetahuan->idpredikattipe))."</th>";
															}

															//KETERAMPILAN
															$keterampilanmp13_tot = array_filter($keterampilanmp13[$pengetahuan->idmatpel]);
															if(array_sum($keterampilanmp13_tot)<1){
																$averageketerampilan=0;
															}else{
																$averageketerampilan = array_sum($keterampilanmp13_tot)/count($keterampilanmp13_tot);
															}
															echo "<th colspan=".($colspanmodul)." align='center'>".CEIL($averageketerampilan)."</th>";
															if($isi->predikaton==1){
																	echo "<th colspan=".($colspanmodul)." align='center'>".strtoupper($CI->dbx->ns_predikat($isi->departemen,CEIL($averageketerampilan),$pengetahuan->idpredikattipe))."</th>";
															}
															if($isi->matpeldeskripsion){
																echo "<td width='200'  align='justify'><font align='justify' style='width:100% !important'>".$pengetahuan->matpeldeskripsitext."</font></td>";
															}
												}else{ //MODULAR
													foreach((array)$arrmodultipe as $rowmodultipe) {
														if (isset($nilaimp13[$pengetahuan->idmatpel][$rowmodultipe->idmodultipe])){
																echo "<th width='*' align='center'>".CEIL($nilaimp13[$pengetahuan->idmatpel][$rowmodultipe->idmodultipe])."</th>";
														}else{
															echo "<th width='*' align='center' align='center'>-</th>";
														}
													}
													if($isi->predikaton==1){
																foreach((array)$arrmodultipe as $rowmodultipe) {
																	if (isset($nilaimp13[$pengetahuan->idmatpel][$rowmodultipe->idmodultipe])){
																			echo "<th width='*' align='center'>".strtoupper($CI->dbx->ns_predikat($isi->departemen,CEIL($nilaimp13[$pengetahuan->idmatpel][$rowmodultipe->idmodultipe]),$pengetahuan->idpredikattipe))."</th>";
																	}else{
																		echo "<th width='*' align='center'>-</th>";
																	}
															}
													}
													foreach((array)$arrmodultipe as $rowmodultipe) {
														if (isset($nilaimp13[$keterampilan->idmatpel][$rowmodultipe->idmodultipe])){
																echo "<th width='*' align='center'>".CEIL($nilaimp13[$keterampilan->idmatpel][$rowmodultipe->idmodultipe])."</th>";
														}else{
															echo "<th width='*' align='center' align='center'>-</th>";
														}
													}
													if($isi->predikaton==1){
																foreach((array)$arrmodultipe as $rowmodultipe) {
																	if (isset($nilaimp13[$keterampilan->idmatpel][$rowmodultipe->idmodultipe])){
																			echo "<th width='*' align='center'>".strtoupper($CI->dbx->ns_predikat($isi->departemen,CEIL($nilaimp13[$keterampilan->idmatpel][$rowmodultipe->idmodultipe]),$keterampilan->idpredikattipe))."</th>";
																	}else{
																		echo "<th width='*' align='center'>-</th>";
																	}
															}
													}
													if($isi->matpeldeskripsion){
														echo "<td width='200' align='justify'><font align='justify' style='width:100% !important'>".$pengetahuan->matpeldeskripsitext."</font></td>";
													}
											} //MODULAR
									} //$idmatpel<>$pengetahuan->idmatpel
							}else{ //$pengetahuan->group<>"1"
								if($grouptext<>$pengetahuan->grouptext){
									echo "<tr class='breaktable'>";
									echo "<td align='center'>".$no++."</td>";
									echo "<td align='left'>".$pengetahuan->grouptext;
									echo "</td>";
									if($isi->skkon==1){
										echo "<td align='center'>".strtoupper($pengetahuan->jumlahskk)."</td>";
									}
									if($isi->kkmon==1){echo "<td align='center'>".strtoupper($pengetahuan->kkm)."</td>";}

									if(($pengetahuan->detail<>1) OR ($modular<>1)){
										$nilaimp13_tot = array_filter($nilaimp13group[$pengetahuan->idgroup]);
										if(array_sum($nilaimp13_tot)<1){
												$average=0;
										}else{
											$average = array_sum($nilaimp13_tot)/(COUNT($nilaimp13_tot)*COUNT($matpelgroup[$pengetahuan->idgroup]));
										}

										echo "<th colspan=".($colspanmodul)." align='center'>".CEIL($average)."</th>";
									}else{
										foreach((array)$arrmodultipe as $rowmodultipe) {
											if (isset($nilaimp13group[$pengetahuan->idgroup][$rowmodultipe->idmodultipe])){
													echo "<th width='*' align='center'>".CEIL($nilaimp13group[$pengetahuan->idgroup][$rowmodultipe->idmodultipe])."</th>";
											}else{
												echo "<th width='*' align='center'>-</th>";
											}
										}
									}

									if(($pengetahuan->detail<>1) OR ($modular<>1)){
											echo "<th colspan=".($colspanmodul)." align='center'>".strtoupper($CI->dbx->ns_predikat($isi->departemen,CEIL($average),$pengetahuan->idpredikattipe))."</th>";
									}else{
										foreach((array)$arrmodultipe as $rowmodultipe) {
											if (isset($nilaimp13group[$pengetahuan->idgroup][$rowmodultipe->idmodultipe])){
													echo "<th width='*' align='center'>".strtoupper($CI->dbx->ns_predikat($isi->departemen,CEIL($nilaimp13group[$pengetahuan->idgroup][$rowmodultipe->idmodultipe]),$pengetahuan->idpredikattipe))."</th>";
											}else{
												echo "<th width='*' align='center'>-</th>";
											}
										}
									}
								}
							} //$pengetahuan->group<>"1"

							$matkel=$pengetahuan->matpelkelompok;
							$idmatpel=$pengetahuan->idmatpel;
							$idmodultipe=$pengetahuan->idmodultipe;
							$grouptext=$pengetahuan->grouptext;
					} //foreach((array)$kelompok as $pengetahuan) {
						?>

							</tbody>
					</table>
		</div>
<?php } //$isi->satutabel ?>
<!-------------------------------------------------------------------------------------------------------------------------------->
<!-------------------------------------------------------------------------------------------------------------------------------->
<?php if($isi->nonakademikon) {
	?>
											<?php
											if($excel<>1){
												echo $headerrapot."<br/>";
											}
											?>
											<div id="divheader">
												<font><b><?php echo $header_count++ ?>. Non Akademik</b></font>
											</div>
											<div id="divcontent">
														<?php
														//TAMPIL Keterampilan
														$matkel="";$idmodultipe="";$no=1;$grouptext="";$jml_kel=0;$idmatpel="";$jmlmatpel=0;
														foreach((array)$nonakademikdata as $nonakademik) {
															$nilaimp=0;$jml_kel++;
															//$nilaimp=$CI->ns_rapor_baru_db->hitnilai_db($isi->idkelas,$isi->idsiswa,$nonakademik->idmatpel,$isi->idtahunajaran,$isi->departemen,$isi->idregion,$isi->idrapottipe,$isi->nilaimurni,$isi->idperiode,$nonakademik->idmatpelkelompok);
															//echo var_dump($nilaimp);die;
															if($modular>0){$colspanmodul=$arrmodultipe;$rowspanmodul=" rowspan='2' ";}
															if ($matkel<>$nonakademik->matpelkelompok){
																 //$no=1;
																	if (($jml_kel<=1)){
																		echo "<table class='table tablecontent nonakademik'>";
																		echo "<thead>";
																							echo "<tr>";
																							echo "<th width='25' '".$rowspanmodul."' align='center'>No.</th>";
																							echo "<th '".$rowspanmodul."'>Mata Pelajaran</th>";
																							echo "<th colspan='2' align='center'>Capaian</th>";
																							if($isi->matpeldeskripsion){
																								echo "<th width='25' '".$rowspanmodul."' align='center'>Deskripsi</th>";
																							}
																							echo "</tr>";
																							echo "<tr>";
																							echo "<th align='center'>Nilai</th>";
																							if($isi->predikaton==1){
																								echo "<th align='center'>Predikat</th>";
																							}
																							echo "</tr></thead>";
																							echo "<tbody>";
																							echo "<tr>";
																							echo "<td align='' colspan='".$csx."'><b>".ucwords(strtolower($nonakademik->matpelkelompok))."</b></td>";
																							echo "</tr>";
																						?>
																		<?php
																		} else {
																			if(($jmlmatpel%10==0) and ($jmlmatpel>0) and ($idmatpel<>$nonakademik->idmatpel)){
																				echo "</table><br/><br/><br/>";
																				//echo $nonakademik->matpel;
																				if($excel<>1){
																					echo $headerrapot."<br/>";
																				}
																				echo "<table class='table tablecontent nonakademik'>";
																				echo "<thead>";
																									echo "<tr>";
																									echo "<th width='25' '".$rowspanmodul."' align='center'>No.</th>";
																									echo "<th '".$rowspanmodul."'>Mata Pelajaran</th>";
																									echo "<th colspan='2' align='center'>Capaian</th>";
																									if($isi->matpeldeskripsion){
																										echo "<th width='25' '".$rowspanmodul."' align='center'>Deskripsi</th>";
																									}
																									echo "</tr>";
																									echo "<tr>";
																									echo "<th align='center'>Nilai</th>";
																									if($isi->predikaton==1){
																										echo "<th align='center'>Predikat</th>";
																									}
																									echo "</tr></thead>";
																									echo "<tr>";
																									echo "<td align='' colspan='".$csx."'><b>".ucwords(strtolower($nonakademik->matpelkelompok))."</b></td>";
																									echo "</tr>";
																			}else{
																				echo "<tr>";
																							echo "<td align='' colspan='".$csx."'><b>".ucwords(strtolower($nonakademik->matpelkelompok))."</b></td>";
																							echo "</tr>";
																			}
																		}//if $jml_kel
																}else{ //($matkel<>$nonakademik->matpelkelompok)
																	if(($jmlmatpel%10==0) and ($jmlmatpel>0) and ($idmatpel<>$nonakademik->idmatpel)){
																		echo "</table><br/><br/><br/>";
																		//echo $nonakademik->matpel;
																		if($excel<>1){
																			echo $headerrapot."<br/>";
																		}
																		echo "<table class='table tablecontent nonakademik'>";
																		echo "<thead>";
																							echo "<tr>";
																							echo "<th width='25' '".$rowspanmodul."' align='center'>No.</th>";
																							echo "<th '".$rowspanmodul."'>Mata Pelajaran</th>";
																							echo "<th colspan='2' align='center'>Capaian</th>";
																							if($isi->matpeldeskripsion){
																								echo "<th width='25' '".$rowspanmodul."' align='center'>Deskripsi</th>";
																							}
																							echo "</tr>";
																							echo "<tr>";
																							echo "<th align='center'>Nilai</th>";
																							if($isi->predikaton==1){
																								echo "<th align='center'>Predikat</th>";
																							}
																							echo "</tr></thead>";
																	}
																} //($matkel<>$nonakademik->matpelkelompok)


																		if($idmatpel<>$nonakademik->idmatpel){
																			$jmlmatpel++;
																			echo "<tr>";
																			echo "<td align='center'>".$no++."</td>";
																			echo "<td align='left'>".$nonakademik->matpel;
																			if($nonakademik->matpelexternal){
																				echo "&nbsp;".$isi->external;
																			}
																			echo "</td>";
																				$nonakademikmp13_tot = array_filter($nonakademikmp13[$nonakademik->idmatpel]);
																				if(array_sum($nonakademikmp13_tot)<1){
																						$average=0;
																				}else{
																						$average = array_sum($nonakademikmp13_tot)/count($nonakademikmp13_tot);
																				}
																				echo "<th colspan=".($colspanmodul)." align='center'>";
																					if($nonakademik->sembunyinilai<>1){echo CEIL($average);}else{echo '';}
																				echo "</th>";
																				echo "<th colspan=".($colspanmodul)." align='center'>".strtoupper($CI->dbx->ns_predikat($isi->departemen,CEIL($average),$nonakademik->idpredikattipe))."</th>";
																				if($isi->matpeldeskripsion){
																					echo "<td width='200'  align='justify'><font align='justify' style='width:100% !important'>".$nonakademik->matpeldeskripsitext."</font></td>";
																				}
																		} //$idmatpel<>$nonakademik->idmatpel

																$matkel=$nonakademik->matpelkelompok;
																$idmatpel=$nonakademik->idmatpel;
																$idmodultipe=$nonakademik->idmodultipe;
																$grouptext=$nonakademik->grouptext;

														} //foreach((array)$kelompok as $nonakademik) {
															?>

																		</tbody>
																</table>
													</div>
	<?php
	if($excel<>1){
		echo $headerrapot."<br/>";
	}
} else { // $isi->nonakademikon
		?>
											<?php echo $headerrapot."<br/>"; ?>
											<div id="divheader">
												<font><b><?php echo $header_count++ ?>. Ekstra Kurikuler</b></font>
											</div>
											<div id="divcontent2">
														<?php
																$no=1;
																echo "<table class='table tablecontent'>";
																echo "<tr>";
																echo "<th width='25' align='center'>No.</th>";
																echo "<th width='35%' align='center'>Kegiatan Ekstrakurikuler</th>";
																echo "<th align='center'>Predikat</th>";
																echo "<th width='35%' align='center'>Deskripsi</th>";
																echo "</tr>";
																$noekstrakurikuler=1;
																	foreach((array)$ekstrakurikulerrapot as $rowekstrakurikuler) {
																	echo "<tr>";
																	echo "<td>".$noekstrakurikuler++."</td>";
																	echo "<td>".$rowekstrakurikuler->kegiatanekstrakurikuler."</td>";
																	echo "<td align='center'>".$rowekstrakurikuler->predikatekstrakurikuler."</td>";
																	echo "<td>".$rowekstrakurikuler->deskripsiekstrakurikuler."</td>";
																	echo "</tr>";
																	}
																echo "</table>";
														?>
											</div>
<?php } // $isi->nonakademikon
?>
											<?php if ($isi->prestasi=="1"){ ?>
											<div id="divheader">
												<font><b><?php echo $header_count++ ?>. Kegiatan</b></font>
											</div>
											<div id="divcontent2">
												<table class='table tablecontent'>
													<tr>
															<?php
															echo "<th width='50'>No.</th>";
															echo "<th width='30%'>Jenis Kegiatan</th>";
															echo "<th>Prestasi</th>";
															?>
													</tr>
													<?php
													$noprestasi=1;
													foreach((array)$prestasirapot as $rowprestasi) {
														echo "<tr>";
														echo "<td>".$noprestasi++."</td>";
														echo "<td>".$rowprestasi->jeniskegiatan."</td>";
														echo "<td>".$rowprestasi->prestasi."</td>";
														echo "</tr>";
													}
													echo "<tr>";
													echo "<td>&nbsp;</td>";
													echo "<td>&nbsp;</td>";
													echo "<td>&nbsp;</td>";
													echo "</tr>";
													?>
												</table>
										</div>
										<?php } ?>
												<?php if ($isi->fisik=="1"){ ?>
												<div id="divheader">
													<font><b><?php echo $header_count++ ?>. Tinggi dan Berat Badan</b></font>
												</div>
												<div id="divcontent2">
													<table class='table tablecontent'>
													 <tr>
															 <?php
															 echo "<th>Aspek Fisik</th>";
															 echo "<th width='20%'>Keterangan</th>";
															 ?>
													 </tr>
													 <?php
														 echo "<tr>";
														 echo "<td>Tinggi Badan</td>";
														 echo "<td align='left'>".$isi->tinggi." Cm</td>";
														 echo "</tr>";
														 echo "<tr>";
														 echo "<td>Berat Badan</td>";
														 echo "<td align='left'>".$isi->berat." Kg</td>";
														 echo "</tr>";
													 ?>
												 </table>
												</div>
												<?php } ?>
												<?php if ($isi->kesehatan=="1"){ ?>
												<div id="divheader">
													<font><b><?php echo $header_count++ ?>. Kondisi Kesehatan</b></font>
												</div>
												<div id="divcontent2">
														<table class='table tablecontent'>
															<tr>
																	<?php
																	echo "<th>Aspek Fisik</th>";
																	echo "<th width='20%'>Keterangan</th>";
																	?>
															</tr>
															<?php
																echo "<tr>";
																echo "<td>Pendengaran</td>";
																echo "<td>".$isi->pendengaran."</td>";
																echo "</tr>";
																echo "<tr>";
																echo "<td>Penglihatan</td>";
																echo "<td>".$isi->penglihatan."</td>";
																echo "</tr>";
																echo "<tr>";
																echo "<td>Gigi</td>";
																echo "<td>".$isi->gigi."</td>";
																echo "</tr>";

															?>
														</table>
												</div>
												<?php } ?>
												<?php if ($isi->absensi=="1"){ ?>

												<div id="divheader">
													<font><b><?php echo $header_count++ ?>. Ketidakhadiran</b></font>
												</div>
												<div id="divcontent2">
													<table class='table tablecontent'>
													 <tr>
															 <?php
															 echo "<th>Ketidakhadiran</th>";
															 echo "<th width='20%'  align='center'>Jumlah</th>";
															 ?>
													 </tr>
													 <?php
														 echo "<tr>";
														 echo "<td>Sakit</td>";
														 echo "<td align='left'>";
														 if($hadirdata->sakit<>""){echo $hadirdata->sakit;}else{echo "0";}
														 echo " Hari</td>";
														 echo "</tr>";
														 echo "<tr>";
														 echo "<td>Izin</td>";
														 echo "<td align='left'>";
														 if($hadirdata->izin<>""){echo $hadirdata->izin;}else{echo "0";}
														 echo " Hari</td>";
														 echo "</tr>";
														 echo "<tr>";
														 echo "<td>Tanpa Keterangan</td>";
														 echo "<td align='left'>";
														 if($hadirdata->alpha<>""){echo $hadirdata->alpha;}else{echo "0";}
														 echo " Hari</td>";
														 echo "</tr>";
													 ?>
												 </table>
												</div>
												<?php
												echo "<div id='divcontent'></div>";
												if($excel<>1){
													echo $headerrapot."<br/>";
												}
											} ?>
												<?php if ($isi->catatan_wk=="1"){ ?>
												<div id="divheader">
													<font><b><?php echo $header_count++ ?>. Catatan Wali Kelas</b></font>
												</div>
												<div id="divcontent2">
																<table class='table tablecontent'>
																<tr>
																	<td valign="top" height="70px">
																			<?php
																					echo $isi->keterangan;
																			?>
																	</td>
																</tr>
															</table>
														</div>
													<?php } ?>
														<div id="divheader">
															<font><b><?php echo $header_count++ ?>. Tanggapan Orang Tua/Wali</b></font>
														</div>
														<div id="divcontent2">
																<table class='table tablecontent'>
																<tr>
																	<td valign="top" height="70px"> &nbsp;
																	</td>
																</tr>
															</table>
														</div>
								</table><br/>
	<?php
	}
	if (($isi->catatan_wk==1) AND ($isi->tipe<>'Reguler')){?>
    <table class='table tablecontentdetail'>
        <tr><td align='left'><b>Catatan Wali Kelas</b></td></tr>
        <tr><td><?php echo $isi->keterangan ?></td></tr>
    </table>

  <?php }
	if (($isi->absensi==1) AND ($isi->tipe<>'Reguler')){
		echo "<br/>";
		echo "<table class='table tablecontentdetail'>";
		echo "<tr>";
		echo "<th>Ketidakhadiran</th>";
		echo "<th width='20%'  align='center'>Jumlah</th>";
		echo "</tr>";
			echo "<tr>";
			 echo "<td>Sakit</td>";
			 echo "<td align='left'>";
			 if($hadirdata->sakit<>""){echo $hadirdata->sakit;}else{echo "0";}
			 echo " Hari</td>";
			 echo "</tr>";
			 echo "<tr>";
			 echo "<td>Izin</td>";
			 echo "<td align='left'>";
			 if($hadirdata->izin<>""){echo $hadirdata->izin;}else{echo "0";}
			 echo " Hari</td>";
			 echo "</tr>";
			 echo "<tr>";
			 echo "<td>Tanpa Keterangan</td>";
			 echo "<td align='left'>";
			 if($hadirdata->alpha<>""){echo $hadirdata->alpha;}else{echo "0";}
			 echo " Hari</td>";
			 echo "</tr>";
	 echo "</table>";
	 	} 
	        	$cs=2+$isi->konseloron+$isi->psikologon;
						$width=100/(3+$isi->konseloron+$isi->psikologon)."%";
	        	$cs2="colspan='".$cs."'";
	        	$align="right";
	        	$titik='...................................';

        ?>
        <table>
					<?php if($isi->tipe<>'SKL'){ ?>
								  <tr>
										<td align="center" width="<?php echo $width; ?>"><b>Mengetahui,</b></td>
										<td align="<?php echo $align;?>" <?php echo $cs2; ?>><b><?php echo $isi->citytext; ?>, <?php echo $CI->p_c->tgl_indo($isi->tanggalkegiatan); ?></b></td>
									</tr>
				        	<tr>
				            	<td align="center" width="<?php echo $width; ?>"><b>Orangtua/Wali Peserta Didik</b></td>
				            	<?php
											//and ($isi->departemen=="PENSUS")
											if ($isi->konseloron==1){ //grafik ?>
				            		<td align="center" width="<?php echo $width; ?>"><b>Konselor</b></td>
				            	<?php } ?>
											<?php if ($isi->psikologon==1){ ?>
				            		<td align="center" width="<?php echo $width; ?>"><b>Psikolog</b></td>
				            	<?php } ?>
				            	<td align="center" width="<?php echo $width; ?>"><b>Wali Kelas</b></td>
											<?php
											if ($isi->formal<>1){
												if ($isi->namajenjang==1){
													echo "<td align='center' width=".$width."><b>Kepala ".$isi->departemenpanjang."</b></td>";
												}else if ($isi->jenjangkode==1){
													echo "<td align='center' width=".$width."><b>Kepala Akademik Paket ".strtoupper($paket)."</b></td>";
												}
											}else{
												echo "<td align='center' width=".$width."><b>Kepala Sekolah";
												if ($isi->namajenjang==1){
													echo $isi->departemenpanjang;
												}else if ($isi->jenjangkode==1){
													echo $isi->jenjangkode.$isi->departemen;
												}
												echo "</b></td>";
											}
											?>

				            </tr>
				            <tr>
				            	<td align="center" height="80px"></td>
				            	<?php if ($isi->konseloron==1){ ?>
				            	<td align="center">
												<?php
				            			if (($digital==1) AND ($CI->dbx->getpegawaittd($isi->idkonselor,0,0)<>"")){
					            			//echo "<img src='".base_url()."uploads/ttd/".$CI->dbx->getpegawaittd($isi->idwali,1,0)."' width='150' />";
														echo "<img src='".base_url()."uploads/ttd/".$CI->dbx->getpegawaittd($isi->idkonselor,0,0)."' width='150' />";
														echo "&nbsp;";
					            		}
					            	?>
											</td>
				            	<?php } ?>
											<?php if ($isi->psikologon==1){ //grafik ?>
												<td align="center">
													<?php
					            			if (($digital==1) AND ($CI->dbx->getpegawaittd($isi->idpsikolog,0,0)<>"")){
						            			//echo "<img src='".base_url()."uploads/ttd/".$CI->dbx->getpegawaittd($isi->idwali,1,0)."' width='150' />";
															echo "<img src='".base_url()."uploads/ttd/".$CI->dbx->getpegawaittd($isi->idpsikolog,0,0)."' width='150' />";
															echo "&nbsp;";
						            		}
						            	?>
												</td>
					            	<?php } ?>
				            	<td align="center">
												<?php
				            			if (($digital==1) AND ($CI->dbx->getpegawaittd($isi->idwali,0,0)<>"")){
					            			//echo "<img src='".base_url()."uploads/ttd/".$CI->dbx->getpegawaittd($isi->idwali,1,0)."' width='150' />";
														echo "<img src='".base_url()."uploads/ttd/".$CI->dbx->getpegawaittd($isi->idwali,0,0)."' width='150' />";
														echo "&nbsp;";
					            		}
					            	?>
											</td>

				            		<?php
				            			if ($digital==1){ //grafik
														echo "<td align='center' valign='middle' background='".base_url()."images/".$isi->captext."' style='background-size:90px;background-repeat: no-repeat;background-position: left;'>";
														if(($CI->dbx->getpegawaittd($isi->idkepsek,0,0)<>"")){
															echo "<img src='".base_url()."uploads/ttd/".$CI->dbx->getpegawaittd($isi->idkepsek,0,0)."' width='150' />";
														}
														echo "&nbsp;</td>";
					            		}else{
														echo "<td align='center' valign='middle'>";
														echo "&nbsp;</td>";
													}
					            	?>

				            </tr>
				            <tr>
				            	<td align="center"><b>(<?php echo $titik; ?>)</b></td>
				            	<?php if ($isi->konseloron==1){ ?>
				            	<td align="center"><b><?php echo $CI->dbx->getpegawai($isi->idkonselor,0,0); ?></b></td>
										<?php }
										if ($isi->psikologon==1){ ?>
				            	<td align="center"><b><?php echo $CI->dbx->getpegawai($isi->idpsikolog,0,0); ?></b></td>
										<?php } ?>
				            	<td align="center"><b><?php echo $CI->dbx->getpegawai($isi->idwali,0,0); ?></b></td>
				            	<td align="center"><b><?php echo $CI->dbx->getpegawai($isi->idkepsek,0,0); ?></b></td>
				            </tr>
							<?php }else{?>
									<tr>
										<td align="center" colspan="2">&nbsp;</td>
										<td align="left" width="250"><b><?php echo $isi->citytext; ?>, <?php echo $CI->p_c->tgl_indo($isi->tanggalkegiatan); ?></b></td>
									</tr>
									<tr>
										<td align="right" rowspan='3'>
												<table class='table tablecontentdetail' style="width:90px !important;height:132px !important;">
													<tr>
															<td valign='center' align='center'>
																	Pas Foto 4x6
															</td>
													</tr>
												</table>
										</td>
										<td align="left" width="50px" rowspan="3">&nbsp;</td>
										<td align="left" ><b>Ketua PKBM Kak Seto</b></td>
									</tr>
									<tr>
										<td align="center" height="80px">&nbsp;</td>
									</tr>
									<tr>
										<!-- <td align="left"><b>Dimas Ramdani Triputra, S.E., M.M</b></td> -->
										<td align="left"><b>Sri Kurnia Nuraeni, S.Pd., M.M</b></td>
										
									</tr>
							<?php } ?>
        </table>
		<?php 
		if ($isi->idnaikkelas<>"99"){ ?>
			<br/>
			<div style="width:85% !important;">
				<table class='tablecontentdetail' style='width:100% !important;padding:0 !important;'>
					<tr>
						<td valign="top" align="left" height="70px">
						<b>Keputusan:</b><br/>
						
						Berdasarkan hasil yang dicapai pada semester 1 dan 2<br/>maka peserta didik ditetapkan :<br/><br/>

						<?php 
							switch ($isi->idnaikkelas) {
							case '1':
								echo "Naik Ke Kelas: ".$CI->p_c->romawi($isi->idnaiktingkattext)."<br/>";
								echo "<strike>Tidak Naik Kelas</strike>";
								break;
							case '2':
								echo "<strike>Naik Ke Kelas</strike><br/>";
								echo "Tidak Naik Dikelas: ".$CI->p_c->romawi($isi->idnaiktingkattext)."";
								break;
							default:
								echo "&nbsp;";
								break;
							}
						echo "<br/><br/>";
						echo $isi->citytext." ".$CI->p_c->tgl_indo($isi->tanggalkegiatan); 
						echo "<br/>";
						echo "Kepala Sekolah.";
						echo "<br/>";
						if ($digital==1){ //grafik
							if(($CI->dbx->getpegawaittd($isi->idkepsek,0,0)<>"")){
								echo "<img src='".base_url()."uploads/ttd/".$CI->dbx->getpegawaittd($isi->idkepsek,0,0)."' height='50px' /><br/>";
							}
						}else{
							echo "<div style='height:50px'>&nbsp;</div>";
						}
						//echo "<div style='text-align:left;width:150px'><hr style='border:1px solid;border-color:black;'/></div>";
						//echo "NIP. ".$isi->nip;
						echo $CI->dbx->getpegawai($isi->idkepsek,0,0);
						?>
						</td>
					</tr>
				</table>
			</div>
		<?php } ?>
		</center>
	</section>
</body>
</html>
