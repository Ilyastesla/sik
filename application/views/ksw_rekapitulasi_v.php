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
  <script language="javascript">
  function submitform() {
    document.getElementById("form").setAttribute("action", "<?php echo $action; ?>");
    document.getElementById("form").setAttribute("target", "");
    
  }

  function cetakprint() {
    document.getElementById("form").setAttribute("action", "<?php echo $action."/printthis" ?>");
    document.getElementById("form").setAttribute("target", "_blank");
    document.getElementById("form").submit();
  }
  function cetakexcel() {

    document.getElementById("form").setAttribute("action", "<?php echo $action."/printthis/1" ?>");
    document.getElementById("form").setAttribute("target", "_blank");
    document.getElementById("form").submit();
  }
  </script>
                <!-- Content Header (Page header) -->
                <section class="content-header table-responsive">
                    <h1>
                        <?php echo $form ?>
                        <small>List Data</small>
                    </h1>

                    <ol class="breadcrumb">
                            <!-- <li><a href="javascript:void(window.open('<?php echo site_url('keu_administrasi/tambah'); ?>'))" ><i class="fa fa-plus-square"></i> Tambah</a></li> -->
                            <li><a href="JavaScript:cetakprint()"><i class="fa fa-file-text"></i>&nbsp;Cetak</a></li>
                            <li><a href="JavaScript:cetakexcel()"><i class="fa fa-print"></i>&nbsp;Excel</a></li>
                    </ol>
                </section>
                <section class="content-header table-responsive">
                <?php
  			             $attributes = array('class' => 'form-horizontal form-validate', 'id' => 'form', 'method' => 'POST', 'novalidate'=>'novalidate','onsubmit'=>'JavaScript:submitform()');
                     echo form_open($action,$attributes);
  		    		?>
                    	<table width="100%" border="0">
    	                    <tr>
                              <th align="left">
                                 <label class="control-label" for="minlengthfield">Lokasi Sekolah</label>
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
                              <!--
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
-->
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
                                     <label class="control-label" for="minlengthfield">Regional</label>
                                     <div class="control-group">
                                       <div class="controls">:
                                           <?php
                                             $arridregional='data-rule-required=false onchange=javascript:this.form.submit();';
                                             echo form_dropdown('idregional',$idregional_opt,$this->input->post('idregional'),$arridregional);
                                           ?>
                                           <?php //echo  <p id="message"></p> ?>
                                       </div>
                                     </div>
                                    </th>
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
                                    
                              </tr>
                              <tr>
                                <th align="left">
                                     <label class="control-label" for="minlengthfield">Dari Cadangan</label>
                                     <div class="control-group">
                                       <div class="controls">:
                                           <?php
                                             $arrsiswa_backup='data-rule-required=false onchange=javascript:this.form.submit();';
                                             echo form_dropdown('siswa_backup',$siswa_backup_opt,$this->input->post('siswa_backup'),$arrsiswa_backup);
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
                                    <!--<table id="example1" class="table table-bordered table-striped">-->
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                          <tr>
                                              <?php
                                              echo "<th width='50' >No</th>";
                                              echo "<th>Tahun Ajaran</th>";
                                              echo "<th>Jenjang</th>";
                                              echo "<th>Tingkat</th>";
                                              echo "<th>Jurusan</th>";
                                              echo "<th>Regional</th>";
                                              echo "<th>Kelompok Siswa</th>";
                                              echo "<th>Kapasitas</th>";
                                              echo "<th>Jml PD</th>";
                                              echo "<th>Jml PD ABK</th>";
                                              echo "<th>Kuota</th>";
                                              ?>
                                          </tr>
                                        </thead>
                                        <tbody>
                                        	<?php
                                        	$CI =& get_instance();$no=1;
                                          $kapasitastotal=0;$kuotatotal=0;$jmlsiswatotal=0;$jmlsiswaabktotal=0;

											foreach((array)$show_table as $row) {
                          $kuota=$row->totkapasitas-$row->jmlsiswa;
                          $kuotatotal+=$kuota;
                          $kapasitastotal+=$row->totkapasitas;
                          $jmlsiswatotal+=$row->jmlsiswa;
                          $jmlsiswaabktotal+=$row->jmlsiswaabk;
											    echo "<tr>";
											    echo "<td align='center'>".$no++."</td>";
                          echo "<td align='center'>".strtoupper($row->tahunajaran)."</td>";
                          echo "<td align='center'>".strtoupper($row->departemen)."</td>";
                          echo "<td align='center'>".($row->tingkattext)."</td>";
                          echo "<td align='center'>".($row->jurusantext)."</td>";
                          echo "<td align='center'>".($row->regionaltext)."</td>";
                          echo "<td align='center'>".($row->kelompok_siswatext)."</td>";
                          echo "<td align='center'>".($row->totkapasitas)."</td>";
                          echo "<td align='center'>".($row->jmlsiswa)."</td>";
                          echo "<td align='center'>".($row->jmlsiswaabk)."</td>";
                          echo "<td align='center'>".$kuota."</td>";
                          echo "</tr>";
											}
                      echo "<tr>";
                      echo "<td colspan=7>&nbsp;</td>";
                      echo "<td align='center'>".$kapasitastotal."</td>";
                      echo "<td align='center'>".$jmlsiswatotal."</td>";
                      echo "<td align='center'>".$jmlsiswaabktotal."</td>";
                      echo "<td align='center'>".$kuotatotal."</td>";
                      echo "</tr>";
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
