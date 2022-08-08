<!DOCTYPE html>
<html>
    <?php $this->load->view('header') ?>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas">
            <?php $this->load->view('menu') ?>
            </aside>
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
<?php $CI =& get_instance();?>

<?php if($view=='index'){ ?>
                <!-- Content Header (Page header) -->
                <section class="content-header table-responsive">
                    <h1>
                        <?php echo $form ?>
                        <small>List Data</small>
                    </h1>

                    <ol class="breadcrumb">
                      <!--
                        <li><a href="javascript:void(window.open('<?php echo site_url('psb_laporan/tambah'); ?>'))" ><i class="fa fa-plus-square"></i> Tambah</a></li>
                        <li><a href="#"><i class="fa fa-file-text"></i>Cetak</a></li>
                        <li><a href="#"><i class="fa fa-file-excel-o"></i>Excel</a></li>
                        -->
                    </ol>
                </section>

                <section class="content-header table-responsive">
                <?php
  			             $attributes = array('class' => 'form-horizontal form-validate', 'id' => 'form', 'method' => 'POST', 'novalidate'=>'novalidate','onsubmit'=>'return validate()');
  		    	echo form_open($action,$attributes);
  		    		?>
                    	<table width="100%" border="0">
                      <tr>
                              <th align="left">
                                 <label class="control-label" for="minlengthfield">Unit Bisnis</label>
                                 <div class="control-group">
                                   <div class="controls">:
                                       <?php
                                       $arridcompany="data-rule-required=true id=idcompany onchange='javascript:this.form.submit();'";
                                       echo form_dropdown('idcompany',$idcompany_opt,$this->input->post('idcompany'),$arridcompany);
                                       ?>
                                       <?php //echo  <p id="message"></p> ?>
                                   </div>
                                 </div>
                                </th>
    			                  </tr>
                        <tr>
                                <th align="left">
                                    <label class="control-label" for="minlengthfield">Periode</label>
                                    <div class="control-group">
                                        <div class="controls">:
                                                <?php
                                                echo form_input(array('class' => '', 'id' => 'dp1','name'=>'periode1','value'=>$this->input->post('periode1'),'data-rule-required'=>'false' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'2' ,'placeholder'=>'DD-MM-YYYY','autocomplete'=>'off','style'=>'width:110px;'));
                                                echo "&nbsp;".form_input(array('class' => '', 'id' => 'dp2','name'=>'periode2','value'=>$this->input->post('periode2'),'data-rule-required'=>'false' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'2' ,'placeholder'=>'DD-MM-YYYY','autocomplete'=>'off','style'=>'width:110px;'));
                                                ?>
                                                <?php //echo  <p id="message"></p> ?>
                                        </div>
                                    </div>
                                </th>
                                <th align="left">
       				                		<label class="control-label" for="minlengthfield">Group Dengan</label>
       				                		<div class="control-group">
               											<div class="controls">:
           						                	<?php
                                          $groupby_opt=array("monthly"=>"Bulan","daily"=>"Hari");
           						                		$arrgroupby='data-rule-required=false  onchange=javascript:this.form.submit();';
           						                		echo form_dropdown('groupby',$groupby_opt,$this->input->post('groupby'),$arrgroupby);
           						                	?>
           						                	<?php //echo  <p id="message"></p> ?>
               											</div>
             				              </div>
             						         </th>
      			              </tr>
          			            <tr>
          				            <th align="left" colspan="4">
          				            	<button class='btn btn-primary' name='filter' value="1">Filter</button>
          				            	<?php echo "<a href='".site_url($action)."' class='btn btn-danger'>Bersihkan</a>&nbsp;&nbsp;";?>
          				            </th>
          				         </tr>
    		                </table>
  		            <?php
  			            echo form_close();
  		            ?>
                </section>
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-body table-responsive">
                                  <!--id="example1" -->
                                    <table class="table table-bordered table-striped">
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
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>
              </section><!-- /.content -->
<!-------------------------------------------------------------------------------------------------------------------------------------->
<?php } ?>
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
    </body>
</html>
