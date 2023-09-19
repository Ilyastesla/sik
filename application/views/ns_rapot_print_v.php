<!DOCTYPE html>
<?php
$CI =& get_instance();
if ($excel==1){
	header('Content-Type: application/vnd.ms-excel'); //IE and Opera
	header('Content-Type: application/x-msexcel'); // Other browsers
	header('Content-Disposition: attachment; filename=rapot_'.$isi->siswa.'|'.$isi->nis.'.xls');
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
	#sample{
		position: fixed;
		display: inline-block;
		width:94vw;
		height:96vh;
		border: 10px solid black;
		opacity:1;
		z-index:-9999;
		align:center;
		left: 2vw;
		top: 1vh;
	}

	#sementara{
		position: fixed;margin:0 auto;top:400px;color: grey;font-size: 40pt !important;text-align: center;width:100%;height:150px;border: 0px solid grey;opacity:0.5;display: block;
	}
</style>
<?php
	//echo "<br/><br/>";//2019
if ($digital==1){?>
<div id="sample">&nbsp;</div>
<div id="sementara">
	<center>
		<?php
		if($isi->departemen=="PENSUS"){
			echo "DOKUMEN SEMENTARA";
		}
		?>
  </center>
</div>
<?php } ?>
<style>
	@page {
		  size: A4;
			/*
		  width:210mm;
		  height:297mm;
		  margin-left: 0;
			margin-right: 0;

			margin-top: default;
			margin-bottom: 100px;
			*/
		}
	table,p {
		font-family:'Source Sans Pro', sans-serif;
		font-size:<?php echo $isi->besarfont?>pt;
		width: 85% !important;
		border-color: black;
	}
	font{
		font-family:'Source Sans Pro', sans-serif;
		font-size:<?php echo $isi->besarfont?>pt;
	}
	#pagebreak{
		height: 2.5cm;
	}
	@media print {
				.lpd thead {display: table-header-group;}
				.lpd {
					page-break-inside:avoid !important;
					page-break-after: auto;
				}
				#breaktable{
					margin-top: 25mm;
					page-break-before: always !important;
				}
				#pagebreak{
					page-break-before: always !important;
				}
     }
</style>
<body>
	<center >
	<?php
		//echo "<br/><br/>";//2019
	if (($isi->kopsurat==1) OR ($digital==1)){
		echo "<br/>";
		if ($digital==1){ 
			echo "<div style='margin-top:10px'>&nbsp;</div>";
		}
		echo "<img src='".base_url()."images/".$isi->logotext."' width='190' /><br/>";
		
			//$CI->dbx->getHeader("SMA");
	}else{?>
		<style>
			body {
				 margin-top: 10mm;
				}
		</style>
		<br/>
		<br/>
		<br/>
		<br/>
	<?php } ?>
	<b>
	<!--
	LAPORAN HASIL BELAJAR SISWA <br/>
	-->
	<?php echo strtoupper($isi->rapottipe);
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
	?>
	<br/>
	<?php if($isi->tipe<>'SKL'){
			echo 	'"<i>HOMESCHOOLING</i> KAK SETO" <br/>';
			if ($isi->namajenjang==1){
				echo strtoupper($isi->departemenpanjang);
			}else{
				echo strtoupper($isi->departemen);
			}
		}else{
			//echo "UJIAN SEKOLAH BERSTANDAR NASIONAL PAKET ".$paket." (SETARA ".$isi->departemen.")"."<br/>";
			echo "UJIAN PAKET KESETARAAN PAKET ".$paket." (SETARA ".$isi->departemen.")"."<br/>";
			if($isi->jurusan<>""){
					echo "PROGRAM STUDI ".$isi->jurusan."<br/>";
			}
			echo "TAHUN PELAJARAN ".$isi->tahunajaran."<br/>";
			echo "Nomor: ".$isi->nomordokumen."<br/>";
		}
	?>
	</b>
	<br/><br/>
	<?php if($isi->tipe<>'SKL'){
		?>
		<table border="0">
				<tr>
	            	<td align="left"><b>Nama Siswa</b></td><td><b>:</b></td><td><?php echo ucwords(strtolower($isi->siswa)); ?></td>
	            	<td align="left"><b>Tahun Pelajaran</b></td><td><b>:</b></td>
								<td><?php
														if($isi->tahunajaranrapot<>""){echo $isi->tahunajaranrapot;}else{echo $isi->tahunajaran;} ?>
								</td>
	            </tr>
	            <tr>
	            	<td align="left"><b>NISN</b></td><td><b>:</b></td><td><?php if($isi->nisn<>""){echo $isi->nisn;}else{echo "-";} ?></td>
	            	<!--
	            	<td align="left"><b>Tipe Rapor</b></td><td><b>:</b></td><td><?php echo ucwords(strtolower($isi->rapottipe)); ?></td>
	            	-->
	            	<td align="left"><b>Semester</b></td><td><b>:</b></td><td><?php echo ucwords(strtolower($isi->periode)); ?></td>
	            </tr>
	            <tr>
	            	<td align="left"><b>Nomor Induk</b></td><td><b>:</b></td><td><?php echo $isi->nis; ?></td>
	            	<td align="left"><b>Program</b></td><td><b>:</b></td><td><?php echo $isi->kelompoksiswa; ?></td>
	            </tr>
	            <tr>
	            	<td align="left"><b>Kelas</b></td><td><b>:</b></td><td><?php echo $isi->kelas; ?></td>

	            </tr>
	            <tr>
	            	<td align="left"><b>Regional</b></td><td><b>:</td><td><?php echo $isi->region; ?></td>
	            </tr>
			</table>
				<br/>
	<?php } ?>
		<?php
		//echo $isi->tipe;
		if($isi->tipe=='Evaluasi'){
			$matkel="";$jml_kel=0;
			$csx=7-$isi->kkmon-$isi->predikaton;
			?>
			<table style="border-collapse:collapse" border="1" cellpadding="2" class='lpd' >
			  <tr>
			    <th rowspan="2">No.</th>
			    <th rowspan="2">Aspek/Materi</th>
			    <th colspan="<?php echo count($predikat); ?>">Penilaian</th>
			  </tr>
			  <tr>
			      <?php
			        foreach((array)$predikat as $rowpredikat) {
			          echo "<th width='100px'>".$rowpredikat->predikat."</th>";
			        }
			      ?>
			  </tr>
			<?php
			foreach((array)$kelompok as $rowkelompok) {
			  $nilaimp=0;$jml_kel++;
			  $nilaimp=$CI->ns_rapot_db->hitnilai_db($isi->idkelas,$isi->idsiswa,$rowkelompok->replid,$isi->idtahunajaran,$isi->departemen,$isi->idregion,$isi->idrapottipe,$isi->nilaimurni,$isi->idperiode,$rowkelompok->idmatpelkelompok);
			  if ($matkel<>$rowkelompok->matpelkelompok){
			    $no=1;

			    echo "<tr>";
			    //".(count($nilaimp)+5)."
			    echo "<td align='' colspan='6'><b>".strtoupper($rowkelompok->matpelkelompok)."</b></td>";
			    echo "</tr>";
			  } //if ($matkel<>$rowkelompok->matpelkelompok){
			  echo "<tr>";
			  echo "<td align='' colspan='6'><b>".strtoupper($rowkelompok->matpel);
				if($rowkelompok->matpelexternal){
					echo "&nbsp;".$isi->external;
				}
				echo "</b></td>";
			  echo "</tr>";
			  $no_pd=1;
			  foreach((array)$nilaimp as $rn) {
			    $predikattext=$CI->dbx->ns_predikat($isi->departemen,$rn->nilaitot,$isi->predikattipe);
			    echo "<tr>";
			    echo "<td align='center'>".$no_pd++."</td>";
			    echo "<td>".$rn->pengembangandirivariabel."</td>";
			    foreach((array)$predikat as $rowpredikat) {
			        if($rn->nilaitot=="0"){
			          echo "<td align='center'>-</td>";
			        }else if (trim($rowpredikat->predikat)==trim($predikattext)){
			            echo "<td align='center'><b>&#10004;</b></td>";
			        }else {
			          echo "<td align='center'>-</td>";
			        }

			    }
			    echo "</tr>";
			  }

			    //ISINYA BRAY
			  $matkel=$rowkelompok->matpelkelompok;
			} //foreach((array)$kelompok as $rowkelompok) {
			echo "</table>";
			  ?>

			      </tbody>
			      <tfoot>
			      </tfoot>
			  </table>
			<?
		} else if($isi->tipe=='Grafik'){
	// ----------------------------------------------------------------------------------------------------------------------------------
	// ----------------------------------------------------------------------------------------------------------------------------------

		$nilaimp=$CI->ns_rapot_db->grafiknilai_db($isi->idkelas,$isi->idsiswa,$isi->idtahunajaran,$isi->idregion,$isi->idrapottipe,$isi->nilaimurni,$isi->idperiode);
		$judultext="";$tglkeg="";$nilaikeg="";
		$judul="";$x=0;

		foreach((array)$nilaimp as $rn) {
			if (isset($tglkeg[$rn->pengembangandirivariabel])){
				$tglkeg[$rn->pengembangandirivariabel]=$tglkeg[$rn->pengembangandirivariabel].",'".$rn->tanggalkegiatan."'";
			}else{
				$tglkeg[$rn->pengembangandirivariabel]="'','".$rn->tanggalkegiatan."'";
			}

			if (isset($nilaikeg[$rn->pengembangandirivariabel])){
				$nilaikeg[$rn->pengembangandirivariabel]=$nilaikeg[$rn->pengembangandirivariabel].",".$rn->nilai;
			}else{
				$nilaikeg[$rn->pengembangandirivariabel]=$rn->nilai;
			}

			if ($judul<>$rn->replid){
				if ($judultext<>""){
					$judultext=$judultext.'||'.$rn->pengembangandirivariabel;
				}else{
					$judultext=$rn->pengembangandirivariabel;
				}
		    }
	    	$judul=$rn->replid;
    	}

			$judultextgraph=explode("||",$judultext);
			$judultextgraphcount=count($judultextgraph);
		?>
		<div style="width:85%">
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
		echo "<table style='border-collapse:collapse;border-color:black;' border='0'>";
		echo "<tr>";
		foreach((array)$judultextgraph as $graph) {
			if ((($x%6)==0) and ($x<>0)){
			    	echo "</table>";
					if ($digital==1){ 
						echo "<div style='padding-top:50px;page-break-before: always !important;'>&nbsp;</div>";
					}
			    	echo "<table style='border-collapse:collapse;border-color:black;' border='0' >";
			    	echo "<tr>";

			}
			echo "<td align='left' height='200px' width='300px'>";
				echo "<table style='border:0 !important;width:100%;border-collapse:initial !important; '>";
				echo "<tr>";
				echo "<td align='left' height='*' width='50%'>";
						?>
						<script src="<?php echo base_url(); ?>js/jquery2.min.js"></script>
						<script src="https://code.highcharts.com/highcharts.js"></script>
						<script src="https://code.highcharts.com/modules/exporting.js"></script>

						<script type="text/javascript">
							$(function () {
							    Highcharts.chart('container<?php echo $graph; ?>', {
							        exporting: {
									         enabled: false
									},
							        chart: {
							            type: 'line'
							        },
							        credits: {
							            enabled: false
							        },
							        title: {
							            text: '<?php echo $graph; ?>',
							            style: {
					                            font: '14px Helvetica'
					                        }

							        },
							        xAxis: {
							        	showLastLabel: true,
							        	labels: {
										            rotation: -90,
										            step:1,
										            style: {
										                color: '#525151',
										                font: '7px Helvetica'
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
							                text: null,
							                style: {
					                            font: '10px Helvetica'
					                        }
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
							        	showInLegend: false,
							            name: 'Nilai Siswa/ Tanggal',
							            style: {
					                            font: '10px Helvetica'
					                    },
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
		echo "<div style='width:85%;'><p align='left'><font>
				Deskripsi:</font></p></div>";
			echo "<table style='border-collapse:collapse;border-color:black;' border='1'>";
			echo "<tr align='center'>";
			echo "<th width='50'>No.</th>";
			echo "<th width='*'>Aspek yang dinilai</th>";
			echo "<th width='50'>Nilai</th>";
			echo "<th width='50'>Predikat</th>";
			echo "<th>Deskripsi</th>";
			echo "</tr>";
			$noas=1;
			foreach((array)$judultextgraph as $graph) {
				$nilaix=0;$nilaiy=0;$xn=0;
				if (isset($nilaikeg[$graph])){
					$nilaix=explode(",",$nilaikeg[$graph]);
					foreach((array)$nilaix as $ngraph) {
						$nilaiy=$nilaiy+$ngraph;
						$xn++;
					}

				}
				echo "<tr>";
				echo "<td width='20' align='center'>".$noas++."</td>";
				echo "<td width='150' align='left'>".$graph."</td>";
				echo "<td width='20' align='center'>".ceil($nilaiy/$xn)."</td>";
				echo "<td width='20' align='left'>".strtoupper($CI->dbx->ns_predikat_graph(ceil($nilaiy/$xn),$graph))."</td>";
				echo "<td>".$CI->dbx->ns_predikat_text_graph(ceil($nilaiy/$xn),$graph)."</td>";
				echo "</tr>";
			}
		echo "<table>";
	}else if ($isi->tipe=='LPD'){ //grafik
	// ----------------------------------------------------------------------------------------------------------------------------------
	// ----------------------------------------------------------------------------------------------------------------------------------

		$nilaimp=$CI->ns_rapot_db->lpdnilai_db($isi->idkelas,$isi->idsiswa,$isi->idtahunajaran,$isi->idregion,$isi->idrapottipe,$isi->nilaimurni,$isi->idperiode);
				$nprosestipe="";$npjreplid="";$nrlpd="";$pjreplid="";
				foreach((array)$nilaimp as $lpdx) {
					if (isset($nprosestipe[$lpdx->idprosestipe.$lpdx->matpelkelompok])){
						$nprosestipe[$lpdx->idprosestipe.$lpdx->matpelkelompok]=$nprosestipe[$lpdx->idprosestipe.$lpdx->matpelkelompok]+1;
					}else{
						$nprosestipe[$lpdx->idprosestipe.$lpdx->matpelkelompok]=1;
					}

					if (isset($npjreplid[$lpdx->pjreplid])){
						$npjreplid[$lpdx->pjreplid]=$npjreplid[$lpdx->pjreplid]+1;
					}else{
						$npjreplid[$lpdx->pjreplid]=1;
					}

					if($lpdx->pjreplid<>$pjreplid){
						$nrlpd[$lpdx->pjreplid]=$lpdx->nilai;
					}else{
						$nrlpd[$lpdx->pjreplid]=$nrlpd[$lpdx->pjreplid]+$lpdx->nilai;
					}

					$pjreplid=$lpdx->pjreplid;
				}

				$nolpd=1;$idprosestipelpdx="";$pjreplid="";$nolpd2=1;$rs=0;$nolpd3=0;
				//$rs2=0;
				$matkel="";

				//echo "</table>";
				//echo "<br/>";
				echo "<table style='border-collapse:collapse' border='1' class='lpd' cellpadding='3'>";
				if ($isi->jumlahdata<1){
						$batas=34;
				}else{
						$batas=$isi->jumlahdata;
				}
				$halaman=0;
				foreach((array)$nilaimp as $lpdrow) {
					/*
					if ($nolpd2==43){ //halaman 2
						echo "</table>";
						//echo "<br/><br/><br/><br/><br/><br/><br/><br/>";
						echo "<table style='border-collapse:collapse' border='1' class='lpd'>";
						if($lpdrow->idprosestipe<>$idprosestipelpdx){
							$rs=$rs;
						}else{
							$rs=$rs-$nolpd3+1;
						}
						$idprosestipelpdx="";
						$rs2=6;
					}else if (($nolpd2>43) and (($nolpd2 % 87)==0)){ //halaman 3
						echo "</table>";
						echo "<table style='border-collapse:collapse' border='1' class='lpd'>";
						if($lpdrow->idprosestipe<>$idprosestipelpdx){
							$rs=$rs;
						}else{
							$rs=$rs-$nolpd3+1;
						}
						$idprosestipelpdx="";
						$rs2=6;
					}else{ //halaman 1
								if ((($rs2+$rs)-43)>0){
										$rs=$rs-(($rs2+$rs)-42);
								}else{
										$rs=$rs;
								}
					}
					*/

					if ($nolpd2%$batas==0){
						$nolpd2=0;
						echo "</td></tr></table><br/>";
						if ($digital==1){ //grafik
							echo "<div id='pagebreak'>&nbsp;</div>";
						}
						echo "<table style='border-collapse:collapse;page-break-before:always !important;margin-top:25mm' border='1' class='lpd' cellpadding='3'>";
						$halaman++;
						if(($halaman<>0) and ($halaman<=1)){
							$batas=$batas+10;
						}
					}
					if (($matkel<>$lpdrow->matpelkelompok) or ($nolpd2%$batas==0)){
                echo "<tr>";
                echo "<td align='' colspan='6'><b>".strtoupper($lpdrow->matpelkelompok)."</b></td>";
                echo "</tr>";
              ?>
              <tr>
                <!--<th width='50'>No.</th>-->
                <th>Jenis Kegiatan</th>
                <th>Tema</th>
                <th>Indikator</th>
                <th>Nilai</th>
                <th>Nilai Rata Rata</th>
                <th>Predikat</th>
                <!-- <th>Deskripsi</th> -->
              </tr>
            <?php
          }//if $jml_kel
					if(($lpdrow->idprosestipe<>$idprosestipelpdx) AND ($nolpd2%$batas<>0) ){
							$rs=$nprosestipe[$lpdrow->idprosestipe.$lpdrow->matpelkelompok];
					}else{
							if(($lpdrow->idprosestipe<>$idprosestipelpdx) OR ($matkel<>$lpdrow->matpelkelompok)){
								$rs=$nprosestipe[$lpdrow->idprosestipe.$lpdrow->matpelkelompok];
							}else{
								//$rs=$nprosestipe[$lpdrow->idprosestipe.$lpdrow->matpelkelompok]-$nolpd3+1;
							}
					}
					//if(($lpdrow->idprosestipe<>$idprosestipelpdx) or ($nolpd2%$batas==0)){
					if(($lpdrow->idprosestipe<>$idprosestipelpdx) OR ($matkel<>$lpdrow->matpelkelompok) OR ($nolpd2%$batas==0)){
						$nolpd3=1;
						echo "<tr>";
						//ucwords(strtolower())
						// echo "<td valign='middle' width='20' rowspan='".($nprosestipe[$lpdrow->idprosestipe]+1)."'>".$nolpd++."</td>";
						echo "<td align='center' valign='middle' rowspan='".($rs+1)."' width='90px'>".$lpdrow->prosestipe."</td>";
						echo "</tr>";
						//$rs2=$rs2+$rs;
					}
					//echo "<tr>";
					if($lpdrow->pjreplid<>$pjreplid){
						$cstema=$npjreplid[$lpdrow->pjreplid];
					}
					if(($lpdrow->pjreplid<>$pjreplid) or ($nolpd2%$batas==0)){
	            if($lpdrow->keterangan<>""){
								//ucwords(strtolower())
	              $keterangantext=$lpdrow->matpel.'<br> Tema: '.$lpdrow->keterangan;
	            }else{
	              $keterangantext=$lpdrow->matpel;
	            }
							echo "<td valign='middle' rowspan='".$cstema."'>".$keterangantext."&nbsp;</td>"; //tema
					}
					//ucwords(strtolower())
					echo "<td width='100px'>".ucwords(strtolower($lpdrow->pengembangandirivariabel))."</td>"; //indikator
					echo "<td align='center' width='50px'>".ceil($lpdrow->nilai)."</td>";
					//
					if(($lpdrow->pjreplid<>$pjreplid) or ($nolpd2%$batas==0)){
						$nrlpdx=ceil($nrlpd[$lpdrow->pjreplid]/$npjreplid[$lpdrow->pjreplid]);
						echo "<td valign='middle' align='center' height='30px' rowspan='".$cstema."' width='50px'>".$nrlpdx."</td>";
						echo "<td valign='middle' align='left' rowspan='".$cstema."' width='50px'>&nbsp;".strtoupper($CI->dbx->ns_predikat($isi->departemen,$nrlpdx,$isi->predikattipe))."</td>";
						// echo "<td valign='middle' align='left' rowspan='".($npjreplid[$lpdrow->pjreplid])."'>".$CI->dbx->ns_predikat_text_lpd($isi->departemen,$nrlpdx,$isi->predikattipe)."</td>";
					}
					echo "</tr>";
					$idprosestipelpdx=$lpdrow->idprosestipe;
					$pjreplid=$lpdrow->pjreplid;
					$matkel=$lpdrow->matpelkelompok;
					$nolpd2++;
					$nolpd3++;
					$rs=$rs-1;
					$cstema=$cstema-1;
				}

			?>
		</table>
	<? }else if($isi->tipe=='SKL'){
	// SKL
	// ----------------------------------------------------------------------------------------------------------------------------------
	// ----------------------------------------------------------------------------------------------------------------------------------
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
						$nilaiavgmatpel[$rowkelompok->matpel][$rowkelompok->prosessubvariabel]=$nilaiavgmatpel[$rowkelompok->matpel][$rowkelompok->prosessubvariabel]+$rowkelompok->nilai;
				}else{
					$nilaiavgmatpel[$rowkelompok->matpel][$rowkelompok->prosessubvariabel]=$rowkelompok->nilai;
				}
				if (ISSET($nilaiavgsubvar[$rowkelompok->prosessubvariabel])){
						$nilaiavgsubvar[$rowkelompok->prosessubvariabel]=$nilaiavgsubvar[$rowkelompok->prosessubvariabel]+$rowkelompok->nilai;
				}else{
						$nilaiavgsubvar[$rowkelompok->prosessubvariabel]=$rowkelompok->nilai;
				}

				if (ISSET($jmlkosong[$rowkelompok->prosessubvariabel])){
						$jmlkosong[$rowkelompok->prosessubvariabel]=$jmlkosong[$rowkelompok->prosessubvariabel];
				}else{
						$jmlkosong[$rowkelompok->prosessubvariabel]=0;
				}

				if($rowkelompok->nilai<1){
					$jmlkosong[$rowkelompok->prosessubvariabel]=$jmlkosong[$rowkelompok->prosessubvariabel]+1;
				}


				if (ISSET($nilaiavgsubvarrapor[$rowkelompok->prosessubvariabel])){
						$nilaiavgsubvarrapor[$rowkelompok->prosessubvariabel]=$nilaiavgsubvarrapor[$rowkelompok->prosessubvariabel]+(($rowkelompok->persentasemurnisv/100)*$rowkelompok->nilai);
				}else{
						$nilaiavgsubvarrapor[$rowkelompok->prosessubvariabel]=(($rowkelompok->persentasemurnisv/100)*$rowkelompok->nilai);
				}

				if ($matpel<>$rowkelompok->matpel){
					$jmlmatpel++;
				}



				$matkel=$rowkelompok->matpelkelompok;
				$matpel=$rowkelompok->matpel;
			}
			//echo var_dump($prosessubvariabel);die;
			?>
			<p align='justify'>
				Ketua PKBM Kak Seto Program "<i>Homeschooling</i>" Pusat menerangkan dengan sesungguhnya bahwa:
			</p>
		<table border="0">
							<tr>
	            	<td align="left" width="150">Nama Siswa</td><td width="20">:</td><td><b><?php echo ucwords(strtoupper($isi->siswa)); ?></b></td>
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
				Adalah peserta Ujian Paket Kesetaraan Paket <?php echo $paket; ?> PKBM Kak Seto Tahun Pelajaran <?php echo $isi->tahunajaran; ?>
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
			//----------------------------------------
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
	<?php }else if($isi->tipe=='Murni'){
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
			$matkel="";
			foreach((array)$arraympk as $rowmpk) {
				$nilaimp=0;
				if ($matkel<>$rowmpk){
							$no=1;
							$matkelcs=($cskel[$rowmpk]*(1+$isi->predikaton))+2+$isi->kkmon+$isi->kalimatraporon;
							if ($jml_kel<>1){
								echo "</table><br/>";
							}
							echo "<table style='border-collapse:collapse' border='1'  cellpadding='5'>";
							echo "<tr>";
							echo "<td align='' colspan='".$matkelcs."'><b>".strtoupper($rowmpk)."</b></td>";
							echo "</tr>";
							echo "<tr>";
							echo "<th width='50' rowspan='2'>No.</th>";
							echo "<th width='*' rowspan='2'>Mata Pelajaran</th>";
							if($isi->kkmon==1){
									echo "<th width='65' rowspan='2'>KKM</th>";
							}
							foreach((array)$arraypsv[$rowmpk] as $rowpsv) {
								foreach((array)$arraypdv[$rowmpk][$rowpsv] as $rowpdv) {
									echo "<th colspan='".(1+$isi->predikaton+$isi->kalimatraporon)."'>".$rowpdv."</th>";
								}
							}
							echo "</tr>";
							echo "<tr>";
							foreach((array)$arraypsv[$rowmpk] as $rowpsv) {
								foreach((array)$arraypdv[$rowmpk][$rowpsv] as $rowpdv) {
									echo "<th width='55'>Angka</th>";
									if($isi->kalimatraporon==1){echo "<th width='160'>Huruf</th>";}
									if($isi->predikaton){
											echo "<th width='55'>Predikat</th>";
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
										echo "<tr>";
										echo "<td align='center'>".$no++."</td>";
										echo "<td align='left'>".ucwords(strtolower($rowkelompok->matpel));
										if($rowkelompok->matpelexternal){
											echo "&nbsp;".$isi->external;
										}
										if($isi->kkmon==1){echo "<td align='center'>".strtoupper($rowkelompok->kkm)."</td>";}
										echo "<td align='center'>".ROUND($rowkelompok->nilaiasli)."</td>";
										if($isi->kalimatraporon==1){
											echo "<td align='left'>".ucwords(strtolower($CI->p_c->kalimatrapor(ROUND($rowkelompok->nilaiasli),0))) ."</td>";
										}
										if($isi->predikaton==1){
												echo "<td align='center'>".strtoupper($CI->dbx->ns_predikat($isi->departemen,$rowkelompok->nilaiasli,$isi->predikattipe))."</td>";
										}
									}else{
										echo "<td align='center'>".ROUND($rowkelompok->nilaiasli)."</td>";
										if($isi->predikaton==1){
												echo "<td align='center'>".strtoupper($CI->dbx->ns_predikat($isi->departemen,$rowkelompok->nilaiasli,$isi->predikattipe))."</td>";
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
				<br/>
		        <table style="border-collapse:collapse;border-color:black;" border="1"  cellpadding="5">
		        	<tr>
		            	<td align="left"><b>Komentar Wali Kelas:</b></td>
		            </tr>
		            <tr>
		            	<td align="left">
			            	<br/><?php echo $isi->keterangan; ?>&nbsp;<br/><br/>
		            	</td>
		            </tr>
		        </table>
		<?php
	}else{ //lpd
	// ----------------------------------------------------------------------------------------------------------------------------------
	// ----------------------------------------------------------------------------------------------------------------------------------

					$matkel="";$jml_kel=0;$idmatpelkelompokpersentase="";$idmkp=array();$idmkp_grup=array();$idmkp_persen=array();
					$csx=3+$isi->kkmon+$isi->predikaton+$isi->kalimatraporon;
        	foreach((array)$kelompok as $rowkelompok) {
        			$nilaimp=0;$jml_kel++;
			    		$nilaimp=$CI->ns_rapot_db->hitnilai_db($isi->idkelas,$isi->idsiswa,$rowkelompok->replid,$isi->idtahunajaran,$isi->departemen,$isi->idregion,$isi->idrapottipe,$isi->nilaimurni,$isi->idperiode,$rowkelompok->idmatpelkelompok);

        	if ($matkel<>$rowkelompok->matpelkelompok){
						          $no=1;
											if(($isi->nilaimurni<>1)){
														if ($jml_kel<=1){
														?>
														<table style="border-collapse:collapse" border="1" cellpadding="5">
											            <thead>
											            	<?php
												            	echo "<tr>";
											            		echo "<td align='' colspan='".$csx."'><b>".strtoupper($rowkelompok->matpelkelompok)."</b></td>";
											            		echo "</tr>";
											            	?>
											                <tr>
											                    <th width="50">No.</th>
											                    <th>Mata Pelajaran</th>
																					<?php if($isi->kkmon==1){
																						 echo "<th width='60'>KKM</th>";
																					}?>
											                    <th width="60">Angka</th>
																				<?php
																						if($isi->kalimatraporon==1){echo "<th width='160'>Huruf</th>";}
																						if($isi->predikaton==1){
																					 echo "<th width='60'>Predikat</th>";
																				}?>
											                </tr>
											            </thead>
											            <tbody>
														<?php
														} else {
															echo "<tr>";
											            	echo "<td align='' colspan='".$csx."'><b>".strtoupper($rowkelompok->matpelkelompok)."</b></td>";
											            	echo "</tr>";

														}//if $jml_kel
											}else{
															if ($jml_kel<>1){
																echo "</table><br/>";
															}
												      echo "<table style='border-collapse:collapse' border='1'  cellpadding='5'>";
												      echo "<tr>";
									            echo "<td align='' colspan='".(count($nilaimp)+5)."'><b>".strtoupper($rowkelompok->matpelkelompok)."</b></td>";
									            echo "</tr>";
															echo "<tr>";
															echo "<th rowspan=2 width='50'>No.</th>";
									            echo "<th rowspan=2 width='270'>Mata Pelajaran</th>";
									            if($isi->kkmon==1){echo "<th rowspan=2 width='65'>KKM</th>";}
								              $cs=count($nilaimp);
															$cspdv=1+$isi->predikaton+$isi->kalimatraporon;
								              if ($rowkelompok->detail==1){
								                	foreach((array)$nilaimp as $rn) {
								                		echo "<th colspan='".($cspdv)."'>".$rn->pengembangandirivariabel."</th>";
								                	}
								                  echo "</tr>";
								                  echo "<tr>";
								                	for ($i = 1; $i <= $cs; $i++) {
								                		// width='".(260/($cs*2))."'
								                		echo "<th>Angka</th>";
																		if($isi->kalimatraporon==1){echo "<th width='160'>Huruf</th>";}
								                		if($isi->predikaton==1){echo "<th width='65'>Predikat</th>";}
								                	}
								                	echo "</tr>";
								              }else{
								              	//for ($i = 1; $i <= $cs; $i++) {
								              		echo "<th colspan='".($cspdv)."'>Tugas</th>";
								              	//}
								                echo "<th rowspan=2 width='65'>Nilai Akhir</th>";
																if($isi->predikaton==1){ echo "<th rowspan=2 width='65'>Predikat</th>";}
								                echo "</tr>";
								                echo "<tr>";
								                for ($i = 1; $i <= $cs; $i++) {
																	echo "<th align='center'>".$CI->p_c->romawi($i)."</th>";
																}
								                echo "</tr>";
								              }
								            }//if (($isi->nilaimurni==1) and ($rowkelompok->detail==1)){
						        } //detail

					        	echo "<tr>";
								    echo "<td align='center'>".$no++."</td>";
								    echo "<td align='left'>".$rowkelompok->matpel;
										if($rowkelompok->matpelexternal){
											echo "&nbsp;".$isi->external;
										}
										echo "</td>";
								    if($isi->kkmon==1){echo "<td align='center'>".strtoupper($rowkelompok->kkm)."</td>";}
										$nilaiall=0;$avgall=0;
								    if($isi->nilaimurni<>1){
								    	$na=ceil($nilaimp);

								    	//ngitung rata2
											if ($idmatpelkelompokpersentase<>$rowkelompok->idmatpelkelompokpersentase){
													if ($idmkp<>""){
														array_push($idmkp,$rowkelompok->idmatpelkelompokpersentase);
													}else{
														$idmkp=array($rowkelompok->idmatpelkelompokpersentase);
													}
													//$avgklmp=$nklmpk;
													$idmkp_persen[$rowkelompok->idmatpelkelompokpersentase]=$rowkelompok->persentase;
									    }
											//echo $idmkp_persen[$rowkelompok->idmatpelkelompokpersentase].'-';


											//echo $idmkp_grup[$rowkelompok->idmatpelkelompokpersentase]."<br/>";die;
									    if (isset($idmkp_grup[$rowkelompok->idmatpelkelompokpersentase])){
												array_push($idmkp_grup[$rowkelompok->idmatpelkelompokpersentase],$na);
									    }else{
										    $idmkp_grup[$rowkelompok->idmatpelkelompokpersentase]=array($na);
											}


									    //echo $nokx.'--'.$avgklmp.'--'.$nklmpk.'--'.$idmatpelkelompokpersentase."<br/>";

					            echo "<td align='center'>".$na."</td>";
											if($isi->kalimatraporon==1){
												echo "<td align='left'>".ucwords(strtolower($CI->p_c->kalimatrapor($na,0))) ."</td>";
											}
											if($isi->predikaton==1){echo "<td align='left'>".strtoupper($CI->dbx->ns_predikat($isi->departemen,$na,$isi->predikattipe))."</td>";}
								    	$idmatpelkelompokpersentase=$rowkelompok->idmatpelkelompokpersentase;
											//$avgall=$avgall+$na;

			    }else{
				    	if(count($nilaimp)==0){
					    	echo "<td align='center'>0</td>";
				    	}
				    	foreach((array)$nilaimp as $rn) {
						    		$na=ceil($rn->nilaitot);
						    		if($rowkelompok->detail==1){
							    		//$na=number_format($na, 2, ',', '');
							    		echo "<td align='center'>".$na."</td>";
											if($isi->kalimatraporon==1){
												echo "<td align='left'>".ucwords(strtolower($CI->p_c->kalimatrapor($na,0))) ."</td>";
											}
								    	if($isi->predikaton==1){	echo "<td align='center'>".strtoupper($CI->dbx->ns_predikat($isi->departemen,$na,$isi->predikattipe))."</td>";
										}
					    	}else{
						    	echo "<td align='center'>".$na."</td>";
					    	}
					    	$avgall=$avgall+$na;
				    	}

							if ($avgall<>0){
								$avgall=ceil($avgall/$cs);
							}

				    	if ($rowkelompok->detail<>1){
				    		echo "<td align='center'>".$avgall."</td>";
				    		echo "<td align='center'>".strtoupper($CI->dbx->ns_predikat($isi->departemen,$avgall,$isi->predikattipe))."</td>";
					    }
			    }
			    $matkel=$rowkelompok->matpelkelompok;
			    echo "</tr>";
      }
			?>

        </tbody>
        <tfoot>
        	<?php
        		if($isi->nilaimurni<>1){
							$avgklmp=0;$nklmpk=0;$avgall=0;
							//echo var_dump($idmkp);
        			foreach((array)$idmkp as $rowjmkp) {
        				$avgklmp=0;
								if ($idmkp_persen[$rowjmkp]<>0){
	        				$nklmpk=($idmkp_persen[$rowjmkp]/100)*(array_sum($idmkp_grup[$rowjmkp])/count($idmkp_grup[$rowjmkp]));
        				}else{
									$nklmpk=0;
								}
								$avgall=$avgall+$nklmpk;
        			}

        			$avgall=ceil($avgall);
						if ($isi->tampilna==1){
			        echo "<tr>";
			        //echo "<td>&nbsp;</td>";
					    echo "<td colspan='3' align='left'><b>Nilai Akhir Laporan Hasil Belajar Siswa</b></td>";
					    echo "<td align='center'><b>".$avgall."</b></td>";
							if($isi->kalimatraporon==1){
								echo "<td align='left'><b>".ucwords(strtolower($CI->p_c->kalimatrapor($avgall,0))) ."</b></td>";
							}
					    echo "<td align='left'><b>".strtoupper($CI->dbx->ns_predikat($isi->departemen,$avgall,$isi->predikattipe))."</b></td>";
					    echo "</tr>";
						}
				}
        	?>
        </tfoot>
    </table>
    <br/>
        <table style="border-collapse:collapse;border-color:black;" border="1"  cellpadding="5">
        	<tr>
            	<td align="left"><b>Komentar Wali Kelas:</b></td>
            </tr>
            <tr>
            	<td align="left">
	            	<br/><?php echo $isi->keterangan; ?>&nbsp;<br/><br/>
            	</td>
            </tr>
        </table>
    <?php
	}
	if ($isi->absensi==1){ ?>
		<br/>
		<table style='border-collapse:collapse' border='1'  cellpadding='5'>
		    <tr><th colspan="3">Absensi</th></tr>
		    <tr><th width="100">Sakit</th><th width="30">:</th><td><?php echo $hadirdata->sakit ?> Hari</td></tr>
		    <tr><th>Izin</th><th>:</th><td><?php echo $hadirdata->izin ?> Hari</td></tr>
		    <tr><th>Alpha</th><th>:</th><td><?php echo $hadirdata->alpha ?> Hari</td></tr>
		</table>
	<?php } ?>
        <br/>
        <?php
		//$digital=1;
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
			$digital=1;
        ?>
        <table border="0" class='breaktable'>
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
											if ($isi->namajenjang==1){
												echo "<td align='center' width=".$width."><b>Kepala ".$isi->departemenpanjang."</b></td>";
											}else{
												echo "<td align='center' width=".$width."><b>Kepala Akademik ".strtoupper($isi->departemen)."</b></td>";
											}
											?>

				            </tr>
				            <tr>
				            	<td align="center" height="80px"></td>
				            	<?php if ($isi->grafik==1){ //grafik ?>
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
				            		<td align="center">&nbsp;</td>
				            	<?php } ?>
				            	<td align="center">
												<?php
													if (($digital==1) AND ($CI->dbx->getpegawaittd($isi->idwali,0,0)<>"")){ //grafik
														echo "<img src='".base_url()."uploads/ttd/".$CI->dbx->getpegawaittd($isi->idwali,0,0)."' width='150' />";
													}
												?>
											</td>
											<?php
												if ($digital==1){ //grafik
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
												<table style="border-collapse:collapse;border-color:black;width:100px !important;padding-right:50px;" border="1">
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
										<td align="left"><b>Sri Kurnia Nuraeni, S.Pd., M.M.</b></td>
									</tr>
							<?php }?>
        </table>
        </center>
        </section>
</body>
<?php if($excel<>1) { ?>
	<script language="javascript">
		window.print();
	</script>
<?php } ?>
</html>
