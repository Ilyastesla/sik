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
                    <!--
                    <ol class="breadcrumb">
                        <li><a href="javascript:void(window.open('<?php echo site_url('ksw_alumni_daftar/tambah'); ?>'))" ><i class="fa fa-plus-square"></i> Tambah</a></li>

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
      				                		<label class="control-label" for="minlengthfield">Jenjang</label>
      				                		<div class="control-group">
              											<div class="controls">:
          						                	<?php
          						                		$arriddepartemen='data-rule-required=false onchange=javascript:this.form.submit();';
          						                		echo form_dropdown('iddepartemen',$iddepartemen_opt,$this->input->post('iddepartemen'),$arriddepartemen);
          						                	?>
          						                	<?php //echo  <p id="message"></p> ?>
              											</div>
            				              </div>
            						         </th>
                                 <th align="left">
                                     <label class="control-label" for="minlengthfield">Tahun Pelajaran</label>
                                     <div class="control-group">
                                       <div class="controls">:
                                         <?php
                                           $arridtahunajaran='data-rule-required=false onchange=javascript:this.form.submit();';
                                           echo form_dropdown('idtahunajaran',$idtahunajaran_opt,$this->input->post('idtahunajaran'),$arridtahunajaran);
                                         ?>
                                         <?php //echo  <p id="message"></p> ?>
                                       </div>
                                     </div>
                                 </th>
    			                  </tr>
                            <tr>
              						       <th align="left">
        				                		<label class="control-label" for="minlengthfield">Tingkat</label>
        				                		<div class="control-group">
                											<div class="controls">:
            						                	<?php
            						                		$arridtingkat='data-rule-required=false onchange=javascript:this.form.submit();';
            						                		echo form_dropdown('idtingkat',$idtingkat_opt,$this->input->post('idtingkat'),$arridtingkat);
            						                	?>
            						                	<?php //echo  <p id="message"></p> ?>
                											</div>
              				              </div>
              						         </th>
                                   <th align="left">
                                     <label class="control-label" for="minlengthfield">Kelas</label>
                                     <div class="control-group">
                                       <div class="controls">:
                                           <?php
                                             $arridkelas='data-rule-required=true onchange=javascript:this.form.submit();';
                                             echo form_dropdown('idkelas',$idkelas_opt,$this->input->post('idkelas'),$arridkelas);
                                           ?>
                                           <?php //echo  <p id="message"></p> ?>
                                       </div>
                                     </div>
                                   </th>
      			                  </tr>
                            <!--
          			            <tr>
          				            <th align="left" colspan="4">
          				            	<button class='btn btn-primary' name='filter' value="1">Filter</button>
          				            	<?php echo "<a href='".site_url($action)."' class='btn btn-danger'>Bersihkan</a>&nbsp;&nbsp;";?>
          				            </th>
          				         </tr>
                         -->
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
                                  <?php
                    			             $attributes = array('class' => 'form-horizontal form-validate', 'id' => 'form', 'method' => 'POST', 'novalidate'=>'novalidate','onsubmit'=>'return validate()','target'=>'_blank');
                    		    	echo form_open($actionsave,$attributes);
                    		    		?>
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                          <tr>
                                              <?php
                                              echo "<th>NIS</th>";
                                              echo "<th>Nama</th>";
                                              echo "<th>Status Program</th>";
                                              echo "<th>Regional</th>";
                                              echo "<th>Tanggal Mutasi</th>";
                                              echo "<th>Jenis Mutasi</th>";
                                              echo "<th width='200px'>Keterangan</th>";
                                              ?>
                                          </tr>
                                        </thead>
                                        <tbody>
                                        	<?php
                                        	$CI =& get_instance();$no=1;
											foreach((array)$show_table as $row) {
											    echo "<tr>";
                          echo "<td align='center'>";
                          echo "<a href=javascript:void(window.open('".site_url('general/datasiswa/'.$row->replid)."')) >".$row->nis."</a>";
                          echo "</td>";
                          echo "<td align='center'>".strtoupper($row->nama);
                          echo "</td>";
                          echo "<td align='center'>".($row->kondisi_nm)."</td>";
                          echo "<td align='center'>".($row->region)."</td>";
                          echo "<td align='center'>".$CI->p_c->tgl_indo($row->tglmutasi)."</td>";
                          echo "<td align='center'>".($row->jenismutasi)."</td>";
                          echo "<td align='center'>".($row->keteranganmutasi)."</td>";
											    echo "</tr>";
											}
											?>

                                        </tbody>
                                        <tfoot>
                                        </tfoot>
                                    </table>
                                 <?php
                 			            echo form_close();
                 		            ?>
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
