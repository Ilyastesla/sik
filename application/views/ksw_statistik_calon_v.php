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
                        <li><a href="javascript:void(window.open('<?php echo site_url('ksw_statistik_calon/tambah'); ?>'))" ><i class="fa fa-plus-square"></i> Tambah</a></li>

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
    			                  </tr>
                            <tr>
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
      			                  </tr>
                              <tr>
                                <th align="left">
                                  <label class="control-label" for="minlengthfield">Kelompok Siswa</label>
                                  <div class="control-group">
                                    <div class="controls">:
                                        <?php
                                          $arrkelompok_siswa='data-rule-required=false onchange=javascript:this.form.submit();';
                                          echo form_dropdown('kelompok_siswa',$kelompok_siswa_opt,$this->input->post('kelompok_siswa'),$arrkelompok_siswa);
                                        ?>
                                        <?php //echo  <p id="message"></p> ?>
                                    </div>
                                  </div>
                                 </th>
                                <th align="left">
                                    <label class="control-label" for="minlengthfield">Berdasarkan</label>
                                    <div class="control-group">
                                      <div class="controls">:
                                        <?php
                                          $arridfiltercari='data-rule-required=false onchange=javascript:this.form.submit();';
                                          echo form_dropdown('idfiltercari',$idfiltercari_opt,$this->input->post('idfiltercari'),$arridfiltercari);
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
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                          <tr>
                                              <?php
                                              echo "<th width='50' >No</th>";
                                              if ($this->input->post('iddepartemen')<>""){
                                                echo "<th>Jenjang</th>";
                                              }
                                              if ($this->input->post('idtahunajaran')<>""){
                                                echo "<th>Tahun Ajaran</th>";
                                              }
                                              if ($this->input->post('idtingkat')<>""){
                                                echo "<th>Tingkat</th>";
                                              }
                                              /*
                                              if ($this->input->post('iddepartemen')<>""){
                                                echo "<th>Jurusan</th>";
                                              }
                                              */
                                              if ($this->input->post('kelompok_siswa')<>""){
                                                echo "<th>Kelompok Siswa</th>";
                                              }

                                              echo "<th>Variabel</th>";
                                              echo "<th>Jumlah</th>";
                                              ?>
                                          </tr>
                                        </thead>
                                        <tbody>
                                        	<?php
                                        	$CI =& get_instance();$no=1;
                                          $kapasitastotal=0;$kuotatotal=0;$jmlsiswatotal=0;$jmlsiswaabktotal=0;

											foreach((array)$show_table as $row) {
											    echo "<tr>";
											    echo "<td align='center'>".$no++."</td>";
                          if ($this->input->post('iddepartemen')<>""){
                            echo "<td align='center'>".strtoupper($row->departemen)."</td>";
                          }
                          if ($this->input->post('idtahunajaran')<>""){
                            echo "<td align='center'>".strtoupper($row->tahunajaran)."</td>";
                          }
                          if ($this->input->post('idtingkat')<>""){
                            echo "<td align='center'>".($row->tingkattext)."</td>";
                          }
                          /*
                          if ($this->input->post('iddepartemen')<>""){
                            echo "<td align='center'>".($row->jurusantext)."</td>";
                          }
                          */
                          if ($this->input->post('kelompok_siswa')<>""){
                            echo "<td align='center'>".($row->kelompok_siswatext)."</td>";
                          }
                          echo "<td align='center'>".strtoupper($row->filtercari)."</td>";
                          echo "<td align='center'>".($row->jumlah)."</td>";
                          echo "</tr>";
											}
											?>

                                        </tbody>
                                        <tfoot>
                                        </tfoot>
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
