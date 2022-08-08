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
                        <li><a href="javascript:void(window.open('<?php echo site_url('ksw_kenaikan/tambah'); ?>'))" ><i class="fa fa-plus-square"></i> Tambah</a></li>

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
                                  <label class="control-label" for="minlengthfield">Tahun Pelajaran Tujuan</label>
                                  <div class="control-group">
                                    <div class="controls">:
                                      <?php
                                        $arridtahunajarantujuan='data-rule-required=false onchange=javascript:this.form.submit();';
                                        echo form_dropdown('idtahunajarantujuan',$idtahunajarantujuan_opt,$this->input->post('idtahunajarantujuan'),$arridtahunajarantujuan);
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
          				                		<label class="control-label" for="minlengthfield">Tingkat Tujuan</label>
          				                		<div class="control-group">
                  											<div class="controls">:
              						                	<?php
              						                		$arridtingkattujuan='data-rule-required=false onchange=javascript:this.form.submit();';
              						                		echo form_dropdown('idtingkattujuan',$idtingkattujuan_opt,$this->input->post('idtingkattujuan'),$arridtingkattujuan);
              						                	?>
              						                	<?php //echo  <p id="message"></p> ?>
                  											</div>
                				              </div>
                						         </th>
      			                  </tr>
                            <tr>
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
                              <th align="left">
                                <label class="control-label" for="minlengthfield">Kelas Tujuan</label>
                                <div class="control-group">
                                  <div class="controls">:
                                      <?php
                                        $arridkelastujuan='data-rule-required=true onchange=javascript:this.form.submit();';
                                        echo form_dropdown('idkelastujuan',$idkelastujuan_opt,$this->input->post('idkelastujuan'),$arridkelastujuan);
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
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                          <tr>
                                              <?php
                                              echo "<th>NIS</th>";
                                              echo "<th>Nama</th>";
                                              echo "<th>Status Program</th>";
                                              echo "<th>Regional</th>";
                                              //echo "<th>ABK</th>";
                                              //echo "<th>Remedial<br/>Perilaku</th>";
                                              echo "<th>Aktif</th>";
                                              echo "<th>Tipe Peringatan</th>";
                                              ?><td width="50" align='center'><input type="checkbox" onClick="selectallx('idsiswa','selectall')" id="selectall" class="selectall"/></td><?php
                                              echo "<th>Region Tujuan</th>";
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
                          if ($row->jml_hari<=14){
                            echo ' <b><font color="red">(baru)</font></b>';
                          }
                          //if (($row->jml_hari>=180) and ($row->konseling_desc==1)){
                          //  echo ' <b><font color="red">(Harus Interview)</font></b>';
                          //}
                          echo "</td>";
                          echo "<td align='center'>".strtoupper($row->kondisi_nm)."</td>";
                          echo "<td align='center'>".strtoupper($row->region)."</td>";
                          //echo "<td align='center'>".($CI->p_c->cekaktif($row->abk))."</td>";
                          //echo "<td align='center'>".($CI->p_c->cekaktif($row->remedialperilaku))."</td>";
                          echo "<td align='center'>".$CI->p_c->cekaktif($row->aktif)."</td>";
                          echo "<td align='center'>";
                          echo $CI->p_c->cekperingatan($row->peringatan);
                          echo "</td>";
                          echo "<td align='center'>";
                          $datacb = array(
                                    'name'        => 'idsiswa[]',
                                    'id'          => 'idsiswa',
                                    'value'       => $row->idsiswa,
                                    'checked'     => ''
                                  );
                          echo form_checkbox($datacb);
                          echo "<input type='hidden' name='kondisi".$row->idsiswa."' value='".$row->kondisi."'>";
                          echo "<input type='hidden' name='region".$row->idsiswa."' value='".$row->idregion."'>";
                          echo "<input type='hidden' name='nis".$row->idsiswa."' value='".$row->nis."'>";
                          echo "</td>";
                          echo "<td align='center'>";
                          $arridregiontujuan='data-rule-required=true';
                          echo form_dropdown('idregiontujuan'.$row->idsiswa,$idregiontujuan_opt,$row->idregion,$arridregiontujuan);
                          echo "</td>";
											    echo "</tr>";
											}
											?>

                                        </tbody>
                                        <tfoot>
                                        </tfoot>
                                    </table>
                                    <br/><table>
                                    <tr>
                     				            <th align="left">
                                          <input type='hidden' name='idkelas' value='<?php echo $this->input->post('idkelas') ?>'>
                                          <input type='hidden' name='idkelastujuan' value='<?php echo $this->input->post('idkelastujuan') ?>'>
                     				            	<?php
                                          if($this->input->post('idkelastujuan')<>""){
                                              echo "<button class='btn btn-primary'>Simpan</button>";
                                          }else{
                                              echo "<h4>Silahkan Pilih Kelas Tujuan Terlebih Dahulu!</h4>";
                                          }
                                          ?>
                     				            </th>
                     				       </tr>
                                 </table>
                                 <?php
                 			            echo form_close();
                 		            ?>
                                </div><!-- /.box-body -->



                                <div class="box-body table-responsive">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                          <tr>
                                              <?php
                                              echo "<th>NIS</th>";
                                              echo "<th>Nama</th>";
                                              echo "<th>Status Program</th>";
                                              echo "<th>Regional</th>";
                                              echo "<th>Keterangan</th>";
                                              echo "<th>Aktif</th>";
                                              echo "<th>&nbsp;</th>";
                                              ?>
                                          </tr>
                                        </thead>
                                        <tbody>
                                        	<?php
                                        	$CI =& get_instance();$no=1;
											foreach((array)$riwayat as $row) {
											    echo "<tr>";
                          echo "<td align='center'>";
                          echo "<a href=javascript:void(window.open('".site_url('general/datasiswa/'.$row->idsiswa)."')) >".$row->nis."</a>";
                          echo "</td>";
                          echo "<td align='center'>".strtoupper($row->nama);
                          echo "</td>";
                          echo "<td align='center'>".strtoupper($row->kondisi_nm)."</td>";
                          echo "<td align='center'>".strtoupper($row->region)."</td>";
                          echo "<td align='center'>".($row->keterangan)."</td>";
                          echo "<td align='center'>".$CI->p_c->cekaktif($row->aktif)."</td>";
                          echo "<td align='center'>";
                          echo "<a href=javascript:void(window.open('".site_url('ksw_kenaikan/hapus/'.$row->replid)."')) class='btn btn-danger' >Hapus</a>";
                          echo "</td>";
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
