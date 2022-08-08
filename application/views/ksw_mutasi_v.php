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
                        <li><a href="javascript:void(window.open('<?php echo site_url('ksw_mutasi/tambah'); ?>'))" ><i class="fa fa-plus-square"></i> Tambah</a></li>

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
                                              echo "<th>NIS</th>";
                                              echo "<th>Kelas</th>";
                                              echo "<th>Nama</th>";
                                              echo "<th>ABK</th>";
                                              echo "<th>Aktif</th>";
                                              //echo "<th>Wali Kelas</th>";
                                              echo "<th>Jenis Mutasi</th>";
                                              echo "<th>Tgl. Mutasi</th>";
                                              echo "<th>Keterangan Mutasi</th>";
                                              echo "<th></th>";
                                              ?>
                                          </tr>
                                        </thead>
                                        <tbody>
                                        	<?php
                                        	$CI =& get_instance();$no=1;
											foreach((array)$show_table as $row) {
											    echo "<tr>";
											    echo "<td align='center'>".$no++."</td>";
                          echo "<td align='center'>";
                          echo "<a href=javascript:void(window.open('".site_url('general/datasiswa/'.$row->replid)."')) >".$row->nis."</a>";
                          echo "</td>";
                          echo "<td align='left'>".strtoupper($row->nama);
                          echo "</td>";
                          echo "<td align='center'>".$row->kelastext."</td>";
                          echo "<td align='center'>".($CI->p_c->cekaktif($row->abk))."</td>";
                          echo "<td align='center'>".$CI->p_c->cekaktif($row->aktif)."</td>";
                          //echo "<td align='center'>".$CI->dbx->getpegawai($row->idwali,0,1)."</td>";
                          echo "<td align='center'>".$row->jenismutasitext."</td>";
                          echo "<td align='center'>".$CI->p_c->tgl_indo($row->tglmutasi)."</td>";
                          echo "<td align='center'>".$row->ketmutasi."</td>";
                          echo "<td align='center'>";
                          if($row->aktif==1){
  											    echo "<a href=javascript:void(window.open('".site_url('ksw_mutasi/tambah/'.$row->replid)."')) class='btn btn-xs btn-warning fa fa-check-square' ></a>&nbsp;&nbsp;";
                          }
                          if($row->aktif<>1){
  											    echo "<a href=javascript:void(window.open('".site_url('ksw_mutasi/batalmutasi_p/'.$row->replid)."')) class='btn btn-danger' >Batal Mutasi</a>&nbsp;&nbsp;";
                          }
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
<?php } elseif($view=='tambah'){ ?>
<section class="content-header table-responsive">
    <h1>
        <?php echo $form ?>
        <small><?php echo $form_small ?></small>
    </h1>
</section>
<section class="content">
  <?php
    $attributes = array('class' => 'form-horizontal form-validate', 'id' => 'form', 'method' => 'POST', 'novalidate'=>'novalidate','onsubmit'=>'return validate()');
    echo form_open($action,$attributes);
?>
<div style="overflow-x:auto;">
<table width="100%" border="0">
  <tr><td width="50%" valign="top">  <!-- kolom 1-->
    <table border="0">
       <tr>
         <th align="left">
              <h4>Data Peserta Didik</h4>
         </th></tr>
         <tr>
            <th align="left">
                <label class="control-label" for="minlengthfield">NIS</label>
                <div class="control-group">
                    <div class="controls">:
                            <?php
                              echo $isi->nis;
                            ?>
                    </div>
                </div>
        </th></tr>
          <tr>
              <th align="left">
                    <label class="control-label" for="minlengthfield">Nama</label>
                    <div class="control-group">
              <div class="controls">:
                      <?php
                         echo $isi->nama;
                      ?>

              </div>
                    </div>
                </th></tr>
                <tr>
                    <th align="left">
                          <label class="control-label" for="minlengthfield">Tahun Pelajaran</label>
                          <div class="control-group">
                    <div class="controls">:
                            <?php
                               echo $isi->tahunajarantext;
                            ?>

                    </div>
                          </div>
                      </th></tr>
                <tr>
                    <th align="left">
                          <label class="control-label" for="minlengthfield">Kelas</label>
                          <div class="control-group">
                    <div class="controls">:
                            <?php
                               echo $isi->kelastext;
                            ?>

                    </div>
                          </div>
                      </th></tr>
                      <tr>
                      <th align="left">
                          <label class="control-label" for="minlengthfield">Tanggal Mutasi</label>
                          <div class="control-group">
                    <div class="controls">:
                            <?php
                              echo form_input(array('class' => '', 'id' => 'dp2','name'=>'tglmutasi','value'=>$CI->p_c->tgl_form($isi->tglmutasi),'data-rule-required'=>'true' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'2' ,'placeholder'=>'DD-MM-YYYY','autocomplete'=>'off'));
                            ?>
                            <?php //echo  <p id="message"></p> ?>
                    </div>
                          </div>
                      </th></tr>
                      <tr>
                        <th align="left">
                        <label class="control-label" for="minlengthfield">Jenis Mutasi</label>
                        <div class="control-group">
                      <div class="controls">:
                        <?php
                          $arrjenismutasi="id='jenismutasi' data-rule-required='true' ";
                          echo form_dropdown('jenismutasi',$jenismutasi_opt,'',$arrjenismutasi);
                        ?>
                              <?php //echo  <p id="message"></p> ?>
                      </div>
                        </div>
                        </th></tr>
                        <tr>
            				            <th align="left">
            		                		<label class="control-label" for="minlengthfield">Keterangan</label>
            		                		<div class="control-group">
            									<div class="controls" valign="top">&nbsp;&nbsp;
            				                	<?php
            				                		echo form_textarea(array('class' => '', 'id' => 'keterangan','name'=>'keterangan','value'=>'','data-rule-required'=>'true' ,'data-rule-maxlength'=>'500', 'data-rule-minlength'=>'20' ,'placeholder'=>'Masukkan 20-500 Karakter'));
            				                	?>
            				                	<?php //echo  <p id="message"></p> ?>
            									</div>
            		                		</div>
            				            </th></tr>
      </table>
</div>
      <br/>
    <table>
      <tr>
              <th align="left">
                <input type="hidden" name="nis" value="<?php echo $isi->nis ?>">
                <button class='btn btn-primary' onclick="return validate()">Simpan</button>
                <?php
                  echo "<a href='JavaScript:window.close()' class='btn btn-success'>Kembali</a>";
                ?>
              </th>
      </tr>
    </table>
    <?php
    echo form_close();
    ?>
</section>
<!-------------------------------------------------------------------------------------------------------------------------------------->
<?php } ?>
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
    </body>
</html>
