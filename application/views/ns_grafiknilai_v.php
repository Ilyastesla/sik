<!DOCTYPE html>
<html>
<script language="javascript">
function cetakabsensi(id) {
	newWindow('../../printabsensi/'+id, 'cetakabsensi','900','800','resizable=1,scrollbars=1,status=0,toolbar=0')
}
</script>
    <?php $this->load->view('header') ?>
		<script src="<?php echo base_url(); ?>js/jquery2.min.js"></script>
		<script src="<?php echo base_url(); ?>js/morris/morris.min.js" type="text/javascript"></script>
		<link href="<?php echo base_url(); ?>js/morris/morris.css" rel="stylesheet" type="text/css" />
		<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>

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
                    <!--
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-file-text"></i>Cetak</a></li>
                        <li><a href="#"><i class="fa fa-file-excel-o"></i>Excel</a></li>
                    </ol>
                  -->
                </section>
                <section class="content-header table-responsive">
                	<?php
			        $attributes = array('class' => 'form-horizontal form-validate', 'id' => 'form', 'method' => 'POST', 'novalidate'=>'novalidate','onsubmit'=>'return validate()');
		    	echo form_open($action,$attributes);
		    		?>
                	<table width="100%" border="0">
			            <tr>
                    <td align="left" width="150">Jenjang</td>
                    <td align="left">
                        <div class="control-group">
                             <?php
                               $arriddepartemen='data-rule-required=false  onchange=javascript:this.form.submit();';
                               echo form_dropdown('iddepartemen',$iddepartemen_opt,$this->input->post('iddepartemen'),$arriddepartemen);
                             ?>
                             <?php //echo  <p id="message"></p> ?>
                         </div>
                      </td>
                     <td align="left" width="150">Tahun Pelajaran</td>
                    <td align="left">
											<div class="control-group">
                      <?php
                          $arridtahunajaran="data-rule-required=false id=idtahunajaran onchange='javascript:this.form.submit();' ";
                          echo form_dropdown('idtahunajaran',$idtahunajaran_opt,$this->input->post('idtahunajaran'),$arridtahunajaran);
                        ?>
											</div>
                    </td>
			            </tr>
			            <tr>
                    <td align="left" width="150">Kelas</td>
                   <td align="left">
										 <div class="control-group">
                     <?php
                           $arridkelas="data-rule-required=false id=idkelas";
                           echo form_dropdown('idkelas',$idkelas_opt,$this->input->post('idkelas') ,$arridkelas);
                       ?>
										 </div>
                   </td>
                   <td align="left" width="150">Semester</td>
                   <td align="left">
                     <div class="control-group">
                     <?php
                         $arridperiode="data-rule-required=false id=idperiode";
                         echo form_dropdown('idperiode',$idperiode_opt,$this->input->post('idperiode'),$arridperiode);
                       ?>
                     </div>
                   </td>
			            </tr>
                  <tr>
                    <td align="left" width="150">Tipe Proses</td>
                    <td align="left">
                      <div class="control-group">
                      <?php
                            $arridprosestipe="data-rule-required=true id='idprosestipe' onchange='javascript:this.form.submit();' ";
                            echo form_dropdown('idprosestipe',$idprosestipe_opt,$this->input->post('idprosestipe') ,$arridprosestipe);
                        ?>
                      </div>
                    </td>
                    <td align="left" width="150">Pengembangan Diri</td>
                    <td align="left">
                      <div class="control-group">
                      <?php
                            $arridpengembangandirivariabel="data-rule-required=true id='idpengembangandirivariabel'";
                            echo form_dropdown('idpengembangandirivariabel',$idpengembangandirivariabel_opt,$this->input->post('idpengembangandirivariabel') ,$arridpengembangandirivariabel);
                        ?>
                      </div>
                    </td>
              </tr>
			            <tr>
                    <td align="left" width="150">Mata Pelajaran</td>
                    <td align="left">
											<div class="control-group">
                      <?php
                        $arridmatpel="data-rule-required=false id=idmatpel";
                        echo form_dropdown('idmatpel',$idmatpel_opt,$this->input->post('idmatpel'),$arridmatpel);
                      ?>
										</div>
                    </td>
                    <!--
                    <td align="left" width="150">Periode</td>
                    <td align="left">
                          <?php
                            echo form_input(array('class' => '', 'id' => 'dp1','name'=>'periode1','value'=>$this->input->post('periode1'),'data-rule-required'=>'false' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'2' ,'placeholder'=>'DD-MM-YYYY','autocomplete'=>'off'));
                            echo "&nbsp;".form_input(array('class' => '', 'id' => 'dp2','name'=>'periode2','value'=>$this->input->post('periode2'),'data-rule-required'=>'false' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'2' ,'placeholder'=>'DD-MM-YYYY','autocomplete'=>'off'));
                            ?>
                            <?php //echo  <p id="message"></p> ?>
                      </td>
                    -->
							    </tr>
			            <tr>
				            <th align="left" colspan="4">
				            	<button class='btn btn-primary' name='filter' value="1">Filter</button>
				            	<?php echo "<a href='".site_url($action)."' class='btn btn-danger'>Bersihkan</a>&nbsp;&nbsp;";?>
				            </th>";
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
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <?php
                                                echo "<th width='50'>No.</th>";
                                                //echo "<th>Petugas</th>";
                                                echo "<th>Mata Pelajaran</th>";
																								echo "<th>Kode Grafik</th>";
                                                //echo "<th>Tema</th>";
                                                // echo "<th>Departemen</th>";
                                                //echo "<th>Kelas</th>";
                                                echo "<th>Tahun Pelajaran</th>";
                                                if($this->input->post('idperiode')<>""){
                                                  echo "<th>Semester</th>";
                                                }
                                                /*
                                                echo "<th>Tgl. Kegiatan</th>";
                                                echo "<th>Nama Siswa</th>";
                                                echo "<th width='30'>D</th>";
                                                echo "<th width='30'>A</th>";
                                                echo "<th width='30'>S</th>";
                                                echo "<th width='30'>I</th>";
                                                echo "<th width='30'>TP</th>";
                                                */
                                                //echo "<th>Tipe Proses</th>";
                                                echo "<th>Pengembangan Diri</th>";
                                                echo "<th>Nilai Rata Rata</th>";
                                                ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        	<?php
                                        	$no=1;$graphdata="";$noarray="";
																					$idtahunajaran="";$idmatpel="";
																					$matpelarray="";$matpelno=0;
											foreach((array)$show_table as $row) {
													if(is_array($idtahunajaran)){
														if(!in_array($row->tahunajaran,$idtahunajaran)){
															array_push($idtahunajaran,$row->tahunajaran);
														}
													}else{
														$idtahunajaran=array($row->tahunajaran);
													}
													if($idmatpel<>$row->idmatpel){
														if(is_array($matpelarray)){
															if(!in_array($row->matpel,$matpelarray)){
																array_push($matpelarray,$row->matpel);
															}
														}else{
															$matpelarray=array($row->matpel);
														}
														if ($graphdata<>""){
															$graphdata=$graphdata."},";
														}
														$graphdata=$graphdata."{y: '".strtoupper($CI->p_c->toalfabet($matpelno++))."', '".$row->tahunajaran."': ".$row->nilai;
													}else{
															$graphdata=$graphdata.", '".$row->tahunajaran."':". $row->nilai;
													}
											    echo "<tr>";
											    echo "<td align='center'>".$no++."</td>";
											    // echo "<td align=''>".strtoupper($CI->dbx->getpegawai($row->created_by,0,1))."</td>";
											    echo "<td align=''>".strtoupper($row->matpel)."</td>";
													echo "<td align=''>";
													echo strtoupper($CI->p_c->toalfabet($matpelno-1));
													echo "</td>";
											    //echo "<td align=''>".strtoupper($row->keterangan)."</td>";
											    // echo "<td align=''>".strtoupper($row->iddepartemen)."</td>";
											    //echo "<td align='center'>".strtoupper($row->kelas)."</td>";
											    //echo "<td align='center'>".strtoupper($row->region)."</td>";
											    echo "<td align='center'>".strtoupper($row->tahunajaran)."</td>";
                          if($this->input->post('idperiode')<>""){
											       echo "<td align='center'>".strtoupper($row->periode)."</td>";
                          }
                          /*
											    echo "<td align='center'>".strtoupper($CI->p_c->tgl_indo($row->tanggalkegiatan))."</td>";
                          echo "<td align='center'>".strtoupper($row->namasiswa)."</td>";
                          echo "<td align='center'>".$CI->p_c->cekaktif($row->terdaftar)."</td>";
                          echo "<td align='center'>".$CI->p_c->cekaktif($row->sakit)."</td>";
                          echo "<td align='center'>".$CI->p_c->cekaktif($row->izin)."</td>";
                          echo "<td align='center'>".$CI->p_c->cekaktif($row->alpha)."</td>";
                          echo "<td align='center'>".$CI->p_c->cekaktif($row->tugas)."</td>";
                          */
                          //echo "<td align=''><a href=javascript:void(window.open('".site_url('ns_pembelajaranjadwal/penilaian/'.$row->idpembelajaranjadwal)."/0')) >".strtoupper($row->prosestipe)."</a></td>";
                          echo "<td align='center'>".strtoupper($row->pengembangandirivariabel)."</td>";
                          echo "<td align='center'>".$row->nilai."</td>";
                          echo "</tr>";

													//$graphdata=$graphdata."{y: '".strtoupper($row->matpel)."', a: ".$row->nilai.", b: 40,c:20},";
													//$idtahunajaran=$row->idtahunajaran;
													$idmatpel=$row->idmatpel;
													//$noarray=$noarray.$no.',';
											}
											$graphdata=$graphdata."},";
											//echo var_dump($idtahunajaran)."asdf";
											//echo $graphdata;
											?>

                                        </tbody>
                                        <tfoot>
                                        </tfoot>
                                    </table>
																		<br/><br/>
																		<table style="border-collapse:collapse" border="1" cellpadding="2" width="100%">
														          <tr>
														              <td>
														                <div>
														                    <div class="chart" align="center" id="peserta" style="height: 400;"></div>
														                </div><!-- /.box-body -->

														              </td>
														          </tr>
														        </table><br/><br/>
																		<script type="text/javascript">
																			$(function() {
														              "use strict";

														              // AREA CHART
														              var bar = new Morris.Bar({
														                  element: 'peserta',
														                  resize: true,
														                  data: [
														                      <?php echo $graphdata; ?>
														                  ],
														                  barColors: ['#f39c12'],
														                  xkey: 'y',
																							ykeys: [<?php foreach((array)$idtahunajaran as $rowita) { echo "'".$rowita."',"; }?>],
														                  labels: [<?php foreach((array)$idtahunajaran as $rowita) { echo "'".$rowita."',"; }?>],
																							xLabelAngle: '0',
																							gridTextSize: 12,

														                  hideHover: 'false'
														              });
														          });
														      </script>


                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>
              </section><!-- /.content -->
<!-------------------------------------------------------------------------------------------------------------------------------------->
<?php } elseif($view=='tambah'){ ?>

<?php } ?>
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
    </body>
</html>
