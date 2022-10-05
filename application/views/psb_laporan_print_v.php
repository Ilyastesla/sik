<?php 
$this->load->view('headerprint_v');

$CI =& get_instance();
if ($excel==1){
	header('Content-Type: application/vnd.ms-excel'); //IE and Opera
	header('Content-Type: application/x-msexcel'); // Other browsers
	header('Content-Disposition: attachment; filename=beritaacara.xls');
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
    <?php $CI->dbx->getkopsuratcompany($this->input->post('idcompany'),$excel); ?>
    <center>
    <b><h3><u><?php echo $form ?></u></h3><br/><br/></b>
    </center>
    <table class="tablecontent tablecontent_">
                                        	<?php
                                        	$CI =& get_instance();$no=1;$tahuntp="";$tahuntf="";$tahunts="";
                                          $arraytp=array();$arraytf=array();$arrayts=array();
                                          $groupby="monthly";
                                          if($this->input->post('groupby')<>""){
                                              $groupby=$this->input->post('groupby');
                                          }

                                          if($groupby=="daily"){
                                            foreach((array)$totalpengunjung as $rowtp) {
                                              if($tahuntp<>$rowtp->tanggal){
                                                array_push($arraytp,$rowtp->tanggal);
                                                $arraytp[$rowtp->tanggal]=array();
                                              }
                                              $arraytp[$rowtp->tanggal]=$rowtp->jumlah;
                                              $tahuntp=$rowtp->tanggal;
                                            }

                                            foreach((array)$totalformulir as $rowtf) {
                                              if($tahuntf<>$rowtf->tanggal){
                                                array_push($arraytf,$rowtf->tanggal);
                                                $arraytf[$rowtf->tanggal]=array();
                                              }
                                              $arraytf[$rowtf->tanggal]=$rowtf->jumlah;
                                              $tahuntf=$rowtf->tanggal;
                                            }

                                            foreach((array)$totalsiswabaru as $rowts) {
                                              if($tahunts<>$rowts->tanggal){
                                                array_push($arrayts,$rowts->tanggal);
                                                $arrayts[$rowts->tanggal]=array();
                                              }
                                              $arrayts[$rowts->tanggal]=$rowts->jumlah;
                                              $tahunts=$rowts->tanggal;
                                            }
                                          }else{
                                            foreach((array)$totalpengunjung as $rowtp) {
                                              if($tahuntp<>$rowtp->tahun){
                                                array_push($arraytp,$rowtp->tahun);
                                                $arraytp[$rowtp->tahun]=array();
                                              }
                                              if (!in_array($rowtp->bulan,$arraytp[$rowtp->tahun])){
                                                array_push($arraytp[$rowtp->tahun],$rowtp->bulan);
                                                $arraytp[$rowtp->tahun][$rowtp->bulan]=array();
                                              }
                                              $arraytp[$rowtp->tahun][$rowtp->bulan]=$rowtp->jumlah;
                                              $tahuntp=$rowtp->tahun;
                                            }

                                            foreach((array)$totalformulir as $rowtf) {
                                              if($tahuntf<>$rowtf->tahun){
                                                array_push($arraytf,$rowtf->tahun);
                                                $arraytf[$rowtf->tahun]=array();
                                              }
                                              if (!in_array($rowtf->bulan,$arraytf[$rowtf->tahun])){
                                                array_push($arraytf[$rowtf->tahun],$rowtf->bulan);
                                                $arraytf[$rowtf->tahun][$rowtf->bulan]=array();
                                              }
                                              $arraytf[$rowtf->tahun][$rowtf->bulan]=$rowtf->jumlah;
                                              $tahuntf=$rowtf->tahun;
                                            }

                                            foreach((array)$totalsiswabaru as $rowts) {
                                              if($tahunts<>$rowts->tahun){
                                                array_push($arrayts,$rowts->tahun);
                                                $arrayts[$rowts->tahun]=array();
                                              }
                                              if (!in_array($rowts->bulan,$arrayts[$rowts->tahun])){
                                                array_push($arrayts[$rowts->tahun],$rowts->bulan);
                                                $arrayts[$rowts->tahun][$rowts->bulan]=array();
                                              }
                                              $arrayts[$rowts->tahun][$rowts->bulan]=$rowts->jumlah;
                                              $tahunts=$rowts->tahun;
                                            }
                                          }
                                          echo "<thead><tr>";
                                          echo "<th width='150'>Periode</th>";
                                          echo "<th>Total Pengunjung</th>";
                                          echo "<th>Jml Pembelian Formulir</th>";
                                          echo "<th>Jml PD</th>";
                                          echo "<th>Rasio</th>";
                                          echo "</tr></thead>";

                                          $tp_tot=0;$tf_tot=0;$ts_tot=0;
                    											foreach((array)$ok_year as $rowyear) {
                                              $ts_bulan=0;$tf_bulan=0;$tp_bulan=0;
                                              if($groupby=="daily"){
                                                echo "<tr>";
                                                echo "<td align=''><b>".$CI->p_c->tgl_indo($rowyear->tanggal)."</b></td>";
                                                echo "<td align='center'>";
                                                if (ISSET($arraytp[$rowyear->tanggal])){
                                                  echo $arraytp[$rowyear->tanggal];
                                                  $tp_tot+=$arraytp[$rowyear->tanggal];
                                                  $tp_bulan=$arraytp[$rowyear->tanggal];
                                                }else{echo "0";}
                                                echo "</td>";
                                                echo "<td align='center'>";
                                                if (ISSET($arraytf[$rowyear->tanggal])){
                                                  echo $arraytf[$rowyear->tanggal];
                                                  $tf_tot+=$arraytf[$rowyear->tanggal];
                                                  $tf_bulan=$arraytf[$rowyear->tanggal];
                                                }else{echo "0";}
                                                echo "</td>";
                                                echo "<td align='center'>";
                                                if (ISSET($arrayts[$rowyear->tanggal])){
                                                  echo $arrayts[$rowyear->tanggal];
                                                  $ts_tot+=$arrayts[$rowyear->tanggal];
                                                  $ts_bulan=$arrayts[$rowyear->tanggal];
                                                }else{echo "0";}
                                                echo "</td>";
                                                echo "<td align='center'>"; //rasio
                                                if (($tp_bulan<>0) and ($ts_bulan<>0)){
                                                  echo CEIL(($ts_bulan/$tp_bulan)*100)."%";
                                                }else{echo "0";}
                                                echo "</td>";
                                                echo "</tr>";

                                              }else{ // group by daily
                                                for ($monthx=1; $monthx <= 12; $monthx++) {
                                                  $tp_bulan=0;$ts_bulan=0;
                                                  echo "<tr>";
                                                  echo "<td align=''><b>".$rowyear->tahun."-".$CI->p_c->getBulan($monthx)."</b></td>";
                                                  echo "<td align='center'>";
                                                  if (ISSET($arraytp[$rowyear->tahun][$monthx])){
                                                    echo $arraytp[$rowyear->tahun][$monthx];
                                                    $tp_tot+=$arraytp[$rowyear->tahun][$monthx];
                                                    $tp_bulan=$arraytp[$rowyear->tahun][$monthx];
                                                  }else{echo "0";}
                                                  echo "</td>";
                                                  echo "<td align='center'>";
                                                  if (ISSET($arraytf[$rowyear->tahun][$monthx])){
                                                    echo $arraytf[$rowyear->tahun][$monthx];
                                                    $tf_tot+=$arraytf[$rowyear->tahun][$monthx];
                                                  }else{echo "0";$tp_bulan=0;}
                                                  echo "</td>";
                                                  echo "<td align='center'>";
                                                  if (ISSET($arrayts[$rowyear->tahun][$monthx])){
                                                    echo $arrayts[$rowyear->tahun][$monthx];
                                                    $ts_tot+=$arrayts[$rowyear->tahun][$monthx];
                                                    $ts_bulan=$arrayts[$rowyear->tahun][$monthx];
                                                  }else{echo "0";$ts_bulan=0;}
                                                  echo "</td>";
                                                  echo "<td align='center'>"; //rasio
                                                  if (($tp_bulan<>0) and ($ts_bulan<>0)){
                                                    echo CEIL(($ts_bulan/$tp_bulan)*100)."%";
                                                  }else{echo "0";}
                                                  echo "</td>";
                                                  echo "</tr>";
                                                }
                                              } // group by
                    											}
                                          echo "<tr>";
                                          echo "<td align='center'><b>&nbsp;</b></td>";
                                          echo "<td align='center'><b>".$tp_tot."</b></td>";
                                          echo "<td align='center'><b>".$tf_tot."</b></td>";
                                          echo "<td align='center'><b>".$ts_tot."</b></td>";
                                          echo "<td align='center'><b>&nbsp;</b></td>";
                                          echo "</tr>";
                    											?>
                                    </table>
</body>
</html>