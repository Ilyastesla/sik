<!DOCTYPE html>
<?php
$CI =& get_instance();
if ($excel==1){
	header('Content-Type: application/vnd.ms-excel'); //IE and Opera
	header('Content-Type: application/x-msexcel'); // Other browsers
	header('Content-Disposition: attachment; filename=rapot.xls');
	header('Expires: 0');
	header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
}
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
<style>
	table,p {
		font-family:'Source Sans Pro', sans-serif;
		font-size:<?php echo $isi->besarfont?>pt;
		width: 85% !important;
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

	@page {
		  size: A4;
		  width:210mm;
		  height:297mm;
			margin: 25mm;
	}
	@page:right{
	    content: counter(page);
	}

	@media print {
		table,tr{
			page-break-inside:always !important;
			page-break-after: auto;
		}
		#breaktable{
			page-break-before:always !important;
			margin-top: 35mm;
		}
	 #divcontent{
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
	 if ($isi->tipe=='Murni'){
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
	if (($isi->kopsurat==1) OR ($digital==1)){
		$headerrapot.= "<br/><br/><img src='".base_url()."images/".$isi->logotext."' width='190' /><br/><br/>";
	}
	if ($isi->tipe=='Murni'){
		$headerrapot= $headerrapot."<b>".strtoupper($isi->rapottipe)."</b>";
		//$headerrapot= $headerrapot."<b>". " MODUL ".$isi->idmodultipe."</b>";
		if($isi->paketkompetension=="1"){
				$headerrapot= $headerrapot."<b>". "<br/>PAKET KOMPETENSI ".$isi->paketkompetensitext."</b>";
		}else{
			$headerrapot= $headerrapot."<b>". "<br/>SEMESTER ".strtoupper($isi->periode)."</b>";
		}
		//$headerrapot= $headerrapot."<b>".'<br/>"<i>HOMESCHOOLING</i> KAK SETO"<br/><br/>'."</b>";
		$headerrapot= $headerrapot."<b>".'<br/>'.$isi->companytext.'<br/><br/>'."</b>";
	}

	$headerrapot=$headerrapot."<table border='0' id='tableheader'>";
	/*
	$headerrapot=$headerrapot."<tr>
			<td align='left' valign='top'><b>Nama Satuan Pendidikan</b></td><td valign='top'><b>:</b></td><td width='24%' valign='top'><b>PKBM Kak Seto</b></td>
			<td align='left' colspan='3' valign='top'><b>Paket ".$paket." Setara ".$isi->departemen."</b></td>
	</tr>";
	*/
	$headerrapot=$headerrapot."<tr>
			<!-- <td align='left' width='20%' valign='top'><b>Alamat Satuan Pendidikan</b></td><td valign='top'><b>:</b></td><td width='28%'>Jln. Taman Makam Bahagia ABRI No. 3A Parigi Lama, Bintaro Sektor 9, Tangerang Selatan 15400 Indonesia</td> -->
			<td align='left' width='20%' valign='top' rowspan='2'><b>Alamat Satuan Pendidikan</b></td><td valign='top' rowspan='2'><b>:</b></td><td width='28%' rowspan='2'>Perigi Lama, Pondok Aren, <br/>Tangerang Selatan.</td>";
	if($isi->kelastexton==1){
		$headerrapot=$headerrapot."<td align='left' width='20%' valign='top'><b>Kelas</b></td><td valign='top'><b>:</b></td><td width='28%' valign='top'>".$isi->kelastext."</td>";
	}else{
		$headerrapot=$headerrapot."<td align='left' width='20%' valign='top'><b>Tingkatan/Setara Kelas</b></td><td valign='top'><b>:</b></td><td width='28%' valign='top'>".$isi->kesetaraantext.'/'.$CI->p_c->romawi($isi->tingkattext)."</td>";
	}
	$headerrapot=$headerrapot."</tr>";


	$headerrapot=$headerrapot."<tr>";
	if($isi->jurusan==1){
		$headerrapot=$headerrapot."<td align='left' valign='top'><b>Jurusan</b></td><td valign='top'><b>:</b></td><td valign='top'><b>".ucwords(strtolower($isi->jurusan))."</b></td>";
	}else{
		$headerrapot=$headerrapot."<td colspan='3'></td>";
	}
	$headerrapot=$headerrapot."</tr>";
	$headerrapot=$headerrapot."<tr>
					<td align='left' valign='top'><b>Nama Peserta Didik</b></td><td valign='top'><b>:</b></td><td valign='top'><b>".ucwords(strtolower($isi->siswa))."</b></td>";
if($isi->paketkompetension=="1"){
					$headerrapot=$headerrapot."<td align='left' valign='top'><b>Paket Kompetensi</b></td><td valign='top'><b>:</b></td><td valign='top'>".$isi->paketkompetensitext."</td>";
}else{
	$headerrapot=$headerrapot."<td align='left' valign='top'><b>Semester</b></td><td valign='top'><b>:</b></td><td valign='top'>".$isi->periode."</td>";
}
					$headerrapot=$headerrapot."</tr>";
	$headerrapot=$headerrapot."<tr>
			<td align='left' valign='top'><b>Nomor Induk/NISN</b></td><td valign='top'><b>:</b></td><td valign='top'>".$isi->nis."/";
			if($isi->nisn<>''){$headerrapot=$headerrapot.$isi->nisn;}else{$headerrapot=$headerrapot.'-';}
			$headerrapot=$headerrapot."</td>
			<td align='left'><b>Tahun Pelajaran</b></td><td valign='top'><b>:</b></td>
			<td>";
			if($isi->tahunajaranrapot<>''){
				$headerrapot=$headerrapot.$isi->tahunajaranrapot;
			}else{
				$headerrapot=$headerrapot.$isi->tahunajaran;
			}
			$headerrapot=$headerrapot."</td></tr>";
		if($isi->program=='1'){
		$headerrapot=$headerrapot."<tr>
			<td align='left' valign='top'><b>Program</b></td><td valign='top'><b>:</b></td><td valign='top'>".$isi->kelompoksiswa."</td>
			</tr>";
		}
	$headerrapot=$headerrapot."</table></div>";
	//echo $headerrapot."<br/>";
?>
</div>
<body>
<section id="content">
	<?php if($isi->tipe=='Grafik'){
		?>
		<script src="<?php echo base_url(); ?>js/jquery2.min.js"></script>
		<script src="https://code.highcharts.com/highcharts.js"></script>
		<script src="https://code.highcharts.com/modules/exporting.js"></script>
		<?php
		// ----------------------------------------------------------------------------------------------------------------------------------
		// ----------------------------------------------------------------------------------------------------------------------------------
			echo $headerrapot;
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
			<p align='justify'><font size="+1">Selama proses pembelajaran, kami mengamati perkembangan perilaku Siswa/Siswi.
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
					?>. Berikut hasil pengamatan kami selama periode belajar Siswa/Siswi.
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
																text: '<?php echo $graph; ?>'
														},
														xAxis: {
															showLastLabel: true,
															labels: {
																			rotation: 0,
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
																name: 'Nilai Siswa/Bulan',
																data: [<?php echo $nilaikeg[$graph]; ?>],
																pointStart: 1
														}]
												});
										});
									</script>
									<div id="container<?php echo $graph; ?>" style="margin:0;width:300px; height:200px;border-collapse:collapse;border-color:black;border:1px solid black;align:left;"></div>
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
						echo "<td width='150'>".$graphpredikat."</td>";
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
	}else if($isi->tipe=='Murni'){
	// Murni
	// ----------------------------------------------------------------------------------------------------------------------------------
	// ----------------------------------------------------------------------------------------------------------------------------------
			echo $headerrapot;
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
							echo "<td align='' colspan='".$matkelcs."'><b>".strtoupper($rowmpk)."</b></td>";
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
              foreach((array)$arraypsv[$rowmpk] as $rowpsv) {
                //foreach((array)$arraypdv[$rowmpk][$rowpsv] as $rowpdv) {
                  echo "<th width='".(30*(((1+$isi->predikaton+$isi->kalimatraporon)*COUNT($arraypdv[$rowmpk][$rowpsv]))))."' colspan='".((1+$isi->predikaton+$isi->kalimatraporon)*COUNT($arraypdv[$rowmpk][$rowpsv]))."' align='center'>".$rowpsv."</th>";
                //}
              }
							echo "</tr>";
							echo "<tr>";
							foreach((array)$arraypsv[$rowmpk] as $rowpsv) {
								foreach((array)$arraypdv[$rowmpk][$rowpsv] as $rowpdv) {
									echo "<th width='30'>".$rowpdv."</th>";
									if($isi->kalimatraporon==1){echo "<th width='160'>Huruf</th>";}
									if($isi->predikaton){
											echo "<th width='30' align='center'>Predikat</th>";
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
												echo "<td align='center'>".strtoupper($CI->dbx->ns_predikat($isi->departemen,CEIL($rowkelompok->nilaiasli),$isi->predikattipe))."</td>";
										}
									}else{
										echo "<td align='center'>".CEIL($rowkelompok->nilaiasli)."</td>";
										if($isi->predikaton==1){
												echo "<td align='center'>".strtoupper($CI->dbx->ns_predikat($isi->departemen,CEIL($rowkelompok->nilaiasli),$isi->predikattipe))."</td>";
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
				<?
				if ($totalmatpel>10){
					echo "<table border='0' id='breaktable'>";
				}else{
					echo "<table border='0'>";
				}
				//
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
} else if($isi->tipe=='LPD'){
		echo $headerrapot;
		echo "<h1>".$isi->rapottipe."</h1>";
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

											if (isset($nilaimp13[$pengetahuan->idgroup][$pengetahuan->idmodultipe])){
												$nilaimp13[$pengetahuan->idgroup][$pengetahuan->idmodultipe]=$nilaimp13[$pengetahuan->idgroup][$pengetahuan->idmodultipe]+$pengetahuan->nilai;
											}else{
												$nilaimp13[$pengetahuan->idgroup][$pengetahuan->idmodultipe]=$pengetahuan->nilai;
											}

											$matpelgroup[$pengetahuan->idgroup][$pengetahuan->idmatpel]=$pengetahuan->matpel;
									}

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
																		echo "<td align='' colspan='".$csx."'><b>".ucfirst(strtolower($pengetahuan->matpelkelompok))."</b></td>";
																		echo "</tr>";
																	?>
																</thead>
																<tbody>
													<?php
													} else {
														echo "<tr>";
																	echo "<td align='' colspan='".$csx."'><b>".ucfirst(strtolower($pengetahuan->matpelkelompok))."</b></td>";
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
														echo "<th align='center'>".strtoupper($CI->dbx->ns_predikat($isi->departemen,CEIL($average),$isi->predikattipe))."</th>";
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
																		echo "<td align='' colspan='".$csx."'><b>".ucfirst(strtolower($pengetahuan->matpelkelompok))."</b></td>";
																		echo "</tr>";
																	?>
																</thead>
																<tbody>
													<?php
													} else {
														echo "<tr>";
																	echo "<td align='' colspan='".$csx."'><b>".ucfirst(strtolower($keterampilan->matpelkelompok))."</b></td>";
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
													echo "<th align='center'>".strtoupper($CI->dbx->ns_predikat($isi->departemen,CEIL($average),$isi->predikattipe))."</th>";
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
						echo $headerrapot;$header_count="A";
						echo "<h1>".$isi->rapottipe."</h1>";
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

							//HITUNG KETERAMPILAN
							$keterampilanmp13=array();
							$keterampilanmp13group=array();
							$matpelgroup=array();
							foreach((array)$kelompok2 as $keterampilan) {
									if (isset($keterampilanmp13[$keterampilan->idmatpel][$keterampilan->idmodultipe])){
										$keterampilanmp13[$keterampilan->idmatpel][$keterampilan->idmodultipe]=$keterampilanmp13[$keterampilan->idmatpel][$keterampilan->idmodultipe]+$keterampilan->nilai;
									}else{
										$keterampilanmp13[$keterampilan->idmatpel][$keterampilan->idmodultipe]=$keterampilan->nilai;
									}

									if (isset($keterampilanmp13group[$keterampilan->idgroup][$keterampilan->idmodultipe])){
										$keterampilanmp13group[$keterampilan->idgroup][$keterampilan->idmodultipe]=$keterampilanmp13group[$keterampilan->idgroup][$keterampilan->idmodultipe]+$keterampilan->nilai;
									}else{
										$keterampilanmp13group[$keterampilan->idgroup][$keterampilan->idmodultipe]=$keterampilan->nilai;
									}

									$matpelgroup[$keterampilan->idgroup][$keterampilan->idmatpel]=$keterampilan->matpel;
							}

							//HITUNG NON AKADEMIK
							$nonakademikmp13=array();
							$nonakademikmp13group=array();
							$matpelgroup=array();
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

									$matpelgroup[$nonakademik->idgroup][$nonakademik->idmatpel]=$nonakademik->matpel;
							}

							//echo var_dump($keterampilanmp13);die;
							if($isi->satutabel<>1){
							?>

							<?php echo $headerrapot."<br/>"; ?>
							<div id="divheader">
								<font><b><?php echo $header_count++ ?>. Pengetahuan</b></font>
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
													if($modular>0){$colspanmodul=$arrmodultipe;$rowspanmodul=" rowspan='2' ";}
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
																					echo "<th colspan=".COUNT($colspanmodul)." align='center'>Nilai</th>";
																					if($isi->predikaton==1){
																						echo "<th colspan=".COUNT($colspanmodul)." align='center'>Predikat</th>";
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
																					echo "<td align='' colspan='".$csx."'><b>".ucfirst(strtolower($pengetahuan->matpelkelompok))."</b></td>";
																					echo "</tr>";
																				echo "</thead>";
																} else {
																	echo "<tr>";
																				echo "<td align='' colspan='".$csx."'><b>".ucfirst(strtolower($pengetahuan->matpelkelompok))."</b></td>";
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
																						echo "<th colspan=".COUNT($colspanmodul)." align='center'>".CEIL($average)."</th>";
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
																			echo "<th colspan=".COUNT($colspanmodul)." align='center'>".strtoupper($CI->dbx->ns_predikat($isi->departemen,CEIL($average),$isi->predikattipe))."</th>";
																	}else{
																		foreach((array)$arrmodultipe as $rowmodultipe) {
																			if (isset($nilaimp13[$pengetahuan->idmatpel][$rowmodultipe->idmodultipe])){
																					echo "<th width='*' align='center'>".strtoupper($CI->dbx->ns_predikat($isi->departemen,CEIL($nilaimp13[$pengetahuan->idmatpel][$rowmodultipe->idmodultipe]),$isi->predikattipe))."</th>";
																			}else{
																				echo "<th width='*' align='center'>-</th>";
																			}
																		}
																	}
																} //$idmatpel<>$pengetahuan->idmatpel
														}else{ //$pengetahuan->group<>"1"
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
																	//echo var_dump($nilaimp13group[$pengetahuan->idgroup]);die;
																	$nilaimp13_tot = array_filter($nilaimp13group[$pengetahuan->idgroup]);
																	if(array_sum($nilaimp13_tot)<1){
																			$average=0;
																	}else{
																		$average = array_sum($nilaimp13_tot)/(COUNT($nilaimp13_tot)*COUNT($matpelgroup[$pengetahuan->idgroup]));
																	}

																	echo "<th colspan=".COUNT($colspanmodul)." align='center'>".CEIL($average)."</th>";
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
																		echo "<th colspan=".COUNT($colspanmodul)." align='center'>".strtoupper($CI->dbx->ns_predikat($isi->departemen,CEIL($average),$isi->predikattipe))."</th>";
																}else{
																	foreach((array)$arrmodultipe as $rowmodultipe) {
																		if (isset($nilaimp13group[$pengetahuan->idgroup][$rowmodultipe->idmodultipe])){
																				echo "<th width='*' align='center'>".strtoupper($CI->dbx->ns_predikat($isi->departemen,CEIL($nilaimp13group[$pengetahuan->idgroup][$rowmodultipe->idmodultipe]),$isi->predikattipe))."</th>";
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
									<?php echo $headerrapot."<br/>"; ?>
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
													if($modular>0){$colspanmodul=$arrmodultipe;$rowspanmodul=" rowspan='2' ";}
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
																					echo "<th colspan=".COUNT($colspanmodul)." align='center'>Nilai</th>";
																					if($isi->predikaton==1){
																						echo "<th colspan=".COUNT($colspanmodul)." align='center'>Predikat</th>";
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
																					echo "<td align='' colspan='".$csx."'><b>".ucfirst(strtolower($keterampilan->matpelkelompok))."</b></td>";
																					echo "</tr>";
																				?>
																			</thead>
																			<tbody>
																<?php
																} else {
																	echo "<tr>";
																				echo "<td align='' colspan='".$csx."'><b>".ucfirst(strtolower($keterampilan->matpelkelompok))."</b></td>";
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
																		echo "<th colspan=".COUNT($colspanmodul)." align='center'>".CEIL($average)."</th>";
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
																			echo "<th colspan=".COUNT($colspanmodul)." align='center'>".strtoupper($CI->dbx->ns_predikat($isi->departemen,CEIL($average),$isi->predikattipe))."</th>";
																	}else{
																		foreach((array)$arrmodultipe as $rowmodultipe) {
																			if (isset($keterampilanmp13[$keterampilan->idmatpel][$rowmodultipe->idmodultipe])){
																					echo "<th width='*' align='center'>".strtoupper($CI->dbx->ns_predikat($isi->departemen,CEIL($keterampilanmp13[$keterampilan->idmatpel][$rowmodultipe->idmodultipe]),$isi->predikattipe))."</th>";
																			}else{
																				echo "<th width='*' align='center'>-</th>";
																			}
																		}
																	}
																} //$idmatpel<>$keterampilan->idmatpel
														}else{ //$keterampilan->group<>"1"
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
																	$keterampilanmp13_tot = array_filter($keterampilanmp13group[$keterampilan->idgroup]);
																	$average = array_sum($keterampilanmp13_tot)/(COUNT($keterampilanmp13_tot)*COUNT($matpelgroup[$keterampilan->idgroup]));
																	echo "<th colspan=".COUNT($colspanmodul)." align='center'>".CEIL($average)."</th>";
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
																		echo "<th colspan=".COUNT($colspanmodul)." align='center'>".strtoupper($CI->dbx->ns_predikat($isi->departemen,CEIL($average),$isi->predikattipe))."</th>";
																}else{
																	foreach((array)$arrmodultipe as $rowmodultipe) {
																		if (isset($keterampilanmp13group[$keterampilan->idgroup][$rowmodultipe->idmodultipe])){
																				echo "<th width='*' align='center'>".strtoupper($CI->dbx->ns_predikat($isi->departemen,CEIL($keterampilanmp13group[$keterampilan->idgroup][$rowmodultipe->idmodultipe]),$isi->predikattipe))."</th>";
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
						if($modular==1){$colspanmodul=$arrmodultipe;$rowspanmodul=" rowspan='3' ";}else{$rowspanmodul=" rowspan='2' ";}
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
														$colspansatutabel=(1+$isi->predikaton);
														if($modular==1){
															$colspansatutabel=$colspansatutabel*COUNT($colspanmodul);
														}
														echo "<th colspan=".$colspansatutabel." align='center'>Pengetahuan</th>";
														echo "<th colspan=".$colspansatutabel." align='center'>Keterampilan</th>";
														if($isi->matpeldeskripsion){
															echo "<th width='25' '".$rowspanmodul."' align='center'>Deskripsi</th>";
														}
														echo "</tr>";
														echo "<tr>";
														echo "<th colspan=".COUNT($colspanmodul)." align='center'>Nilai</th>";
														if($isi->predikaton==1){
															echo "<th colspan=".COUNT($colspanmodul)." align='center'>Predikat</th>";
														}
														echo "<th colspan=".COUNT($colspanmodul)." align='center'>Nilai</th>";
														if($isi->predikaton==1){
															echo "<th colspan=".COUNT($colspanmodul)." align='center'>Predikat</th>";
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
														echo "<tr>";
														echo "<td align='' colspan='".$csx."'><b>".$pengetahuan->matpelkelompok."</b></td>";
														echo "</tr>";
													echo "</thead>";
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
															echo "<th colspan=".COUNT($colspanmodul)." align='center'>".CEIL($average)."</th>";
															if($isi->predikaton==1){
																	echo "<th colspan=".COUNT($colspanmodul)." align='center'>".strtoupper($CI->dbx->ns_predikat($isi->departemen,CEIL($average),$isi->predikattipe))."</th>";
															}

															//KETERAMPILAN
															$keterampilanmp13_tot = array_filter($keterampilanmp13[$pengetahuan->idmatpel]);
															if(array_sum($keterampilanmp13_tot)<1){
																$averageketerampilan=0;
															}else{
																$averageketerampilan = array_sum($keterampilanmp13_tot)/count($keterampilanmp13_tot);
															}
															echo "<th colspan=".COUNT($colspanmodul)." align='center'>".CEIL($averageketerampilan)."</th>";
															if($isi->predikaton==1){
																	echo "<th colspan=".COUNT($colspanmodul)." align='center'>".strtoupper($CI->dbx->ns_predikat($isi->departemen,CEIL($averageketerampilan),$isi->predikattipe))."</th>";
															}
															if($isi->matpeldeskripsion){
																echo "<td width='150'  align='left'>".$pengetahuan->matpeldeskripsitext."</td>";
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
																			echo "<th width='*' align='center'>".strtoupper($CI->dbx->ns_predikat($isi->departemen,CEIL($nilaimp13[$pengetahuan->idmatpel][$rowmodultipe->idmodultipe]),$isi->predikattipe))."</th>";
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
																			echo "<th width='*' align='center'>".strtoupper($CI->dbx->ns_predikat($isi->departemen,CEIL($nilaimp13[$keterampilan->idmatpel][$rowmodultipe->idmodultipe]),$isi->predikattipe))."</th>";
																	}else{
																		echo "<th width='*' align='center'>-</th>";
																	}
															}
													}
													if($isi->matpeldeskripsion){
														echo "<td width='150'  align='left'>".$pengetahuan->matpeldeskripsitext."</td>";
													}
											} //MODULAR
									} //$idmatpel<>$pengetahuan->idmatpel
							}else{ //$pengetahuan->group<>"1"
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
										if(array_sum($nilaimp13_tot)<1){
												$average=0;
										}else{
											$average = array_sum($nilaimp13_tot)/(COUNT($nilaimp13_tot)*COUNT($matpelgroup[$pengetahuan->idgroup]));
										}

										echo "<th colspan=".COUNT($colspanmodul)." align='center'>".CEIL($average)."</th>";
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
											echo "<th colspan=".COUNT($colspanmodul)." align='center'>".strtoupper($CI->dbx->ns_predikat($isi->departemen,CEIL($average),$isi->predikattipe))."</th>";
									}else{
										foreach((array)$arrmodultipe as $rowmodultipe) {
											if (isset($nilaimp13group[$pengetahuan->idgroup][$rowmodultipe->idmodultipe])){
													echo "<th width='*' align='center'>".strtoupper($CI->dbx->ns_predikat($isi->departemen,CEIL($nilaimp13group[$pengetahuan->idgroup][$rowmodultipe->idmodultipe]),$isi->predikattipe))."</th>";
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
<?php if($isi->nonakademikon) {?>
											<?php echo $headerrapot."<br/>"; ?>
											<div id="divheader">
												<font><b><?php echo $header_count++ ?>. Non Akademik</b></font>
											</div>
											<div id="divcontent">
													<td style="padding-left:30px">
														<?php
														//TAMPIL Keterampilan
														$matkel="";$idmodultipe="";$no=1;$grouptext="";$jml_kel=0;$idmatpel="";
														foreach((array)$nonakademikdata as $nonakademik) {
															$nilaimp=0;$jml_kel++;
															//$nilaimp=$CI->ns_rapor_baru_db->hitnilai_db($isi->idkelas,$isi->idsiswa,$nonakademik->idmatpel,$isi->idtahunajaran,$isi->departemen,$isi->idregion,$isi->idrapottipe,$isi->nilaimurni,$isi->idperiode,$nonakademik->idmatpelkelompok);
															//echo var_dump($nilaimp);die;
															if($modular>0){$colspanmodul=$arrmodultipe;$rowspanmodul=" rowspan='2' ";}
															if ($matkel<>$nonakademik->matpelkelompok){
																 //$no=1;
																	if ($jml_kel<=1){
																		echo "<table class='table tablecontent'>";
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
																							echo "</tr>";
																							echo "<tr>";
																							echo "<td align='' colspan='".$csx."'><b>".ucfirst(strtolower($nonakademik->matpelkelompok))."</b></td>";
																							echo "</tr>";
																						?>
																					</thead>
																					<tbody>
																		<?php
																		} else {
																			echo "<tr>";
																						echo "<td align='' colspan='".$csx."'><b>".ucfirst(strtolower($nonakademik->matpelkelompok))."</b></td>";
																						echo "</tr>";

																		}//if $jml_kel
																}


																		if($idmatpel<>$nonakademik->idmatpel){
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
																				echo "<th colspan=".COUNT($colspanmodul)." align='center'>".CEIL($average)."</th>";
																				echo "<th colspan=".COUNT($colspanmodul)." align='center'>".strtoupper($CI->dbx->ns_predikat($isi->departemen,CEIL($average),$isi->predikattipe))."</th>";
																				if($isi->matpeldeskripsion){
																					echo "<td width='150'  align='left'>".$nonakademik->matpeldeskripsitext."</td>";
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
	echo $headerrapot."<br/>";
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
																echo "<tr>";
																echo "<td>".$no++."</td>";
																echo "<td></td>";
																echo "<td></td>";
																echo "<td></td>";
																echo "</tr>";
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
														 echo "<td align='center'>".$isi->tinggi." Cm</td>";
														 echo "</tr>";
														 echo "<tr>";
														 echo "<td>Berat Badan</td>";
														 echo "<td align='center'>".$isi->berat." Kg</td>";
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
														 echo "<td align='center'>".$hadirdata->sakit." Hari</td>";
														 echo "</tr>";
														 echo "<tr>";
														 echo "<td>Izin</td>";
														 echo "<td align='center'>".$hadirdata->izin." Hari</td>";
														 echo "</tr>";
														 echo "<tr>";
														 echo "<td>Tanpa Keterangan</td>";
														 echo "<td align='center'>".$hadirdata->alpha." Hari</td>";
														 echo "</tr>";
													 ?>
												 </table>
												</div>
												<?php
												echo "<div id='divcontent'></div>";
												echo $headerrapot."<br/>";
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
	if (($isi->absensi==1) AND ($isi->tipe<>'Reguler')){ ?>
		<br/>
		<table class='table tablecontentdetail'>
		    <tr><th colspan="3" align='left'>Ketidakhadiran</th></tr>
		    <tr><th width="100px">Sakit</th><th width="30px">:</th><td align="left"><?php echo $hadirdata->sakit ?> Hari</td></tr>
		    <tr><th>Izin</th><th>:</th><td align="left"><?php echo $hadirdata->izin ?> Hari</td></tr>
		    <tr><th>Tanpa Keterangan</th><th>:</th><td align="left"><?php echo $hadirdata->alpha ?> Hari</td></tr>
		</table>
	<?php } ?>
        <?php
	        if ($isi->grafik==1){ //grafik
	        	$width="25%";
	        	$cs="4";
	        	$cs2="colspan='3'";
	        	$align="right";
	        	$titik='...................................';
	        }else if ($isi->psikologon==1){ //grafik
 	        	$width="25%";
 	        	$cs="4";
 	        	$cs2="colspan='3'";
 	        	$align="right";
 	        	$titik='...................................';
 	        }else{
		        $width="33%";
		        $cs="3";
		        $cs2=" colspan='2' ";
		        $align="right";
		        $titik='.........................................';
	        }
        ?>
        <table>
					<?php if($isi->tipe<>'SKL'){ ?>
								  <tr>
										<td align="center" width="<?php echo $width; ?>"><b>Mengetahui,</b></td>
										<td align="<?php echo $align;?>" <?php echo $cs2; ?>><b><?php echo $isi->citytext; ?>, <?php echo $CI->p_c->tgl_indo($isi->tanggalkegiatan); ?></b></td>
									</tr>
				        	<tr>
				            	<td align="center" width="<?php echo $width; ?>"><b>Orangtua/Wali Siswa</b></td>
				            	<?php
											//and ($isi->departemen=="PENSUS")
											if (($isi->grafik==1)){ //grafik ?>
				            		<td align="center" width="<?php echo $width; ?>"><b>Konselor</b></td>
				            	<?php } ?>
											<?php if ($isi->psikologon==1){ //grafik ?>
				            		<td align="center" width="<?php echo $width; ?>"><b>Koordinator Psikolog</b></td>
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
				            	<?php if ($isi->grafik==1){ //grafik ?>
				            	<td align="center">
												<?php
				            			if (($digital) AND ($CI->dbx->getpegawaittd($isi->idkonselor,0,0)<>"")){
					            			//echo "<img src='".base_url()."uploads/ttd/".$CI->dbx->getpegawaittd($isi->idwali,1,0)."' width='150' />";
														echo "<img src='".base_url()."uploads/ttd/".$CI->dbx->getpegawaittd($isi->idkonselor,0,0)."' width='150' />";
														echo "&nbsp;";
					            		}
					            	?>
											</td>
				            	<?php } ?>
				            	<td align="center">
												<?php
				            			if (($digital) AND ($CI->dbx->getpegawaittd($isi->idwali,0,0)<>"")){
					            			//echo "<img src='".base_url()."uploads/ttd/".$CI->dbx->getpegawaittd($isi->idwali,1,0)."' width='150' />";
														echo "<img src='".base_url()."uploads/ttd/".$CI->dbx->getpegawaittd($isi->idwali,0,0)."' width='150' />";
														echo "&nbsp;";
					            		}
					            	?>
											</td>

				            		<?php
				            			if ($digital){ //grafik
														echo "<td align='center' valign='middle' background='".base_url()."images/".$isi->captext."' style='background-size:130px;background-repeat: no-repeat;background-position: left;'>";
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
				            	<?php if ($isi->grafik==1){ //grafik ?>
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
										<td align="left" width="250"><b>Tangerang Selatan, <?php echo $CI->p_c->tgl_indo($isi->tanggalkegiatan); ?></b></td>
									</tr>
									<tr>
										<td align="right" rowspan='3'>
												<table class='table tablecontent'>
													<tr>
															<td height='100px' width='50px' valign='center' align='center'>
																	Pas Foto
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
										<td align="left"><b>Dimas Ramdani Triputra, S.E., M.M</b></td>
									</tr>
							<?}?>
        </table>
        </center>
</section>
</body>
<!--
<?php
if($excel<>1) { ?>
	<script language="javascript">
		window.print();
	</script>
<?php } ?>
</html>
