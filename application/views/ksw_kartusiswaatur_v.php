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
                        <li><a href="javascript:void(window.open('<?php echo site_url('ksw_kartusiswaatur/tambah'); ?>'))" ><i class="fa fa-plus-square"></i> Tambah</a></li>
                        <!--
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
                                              echo "<th>Jenjang</th>";
                                              echo "<th>Judul Kartu</th>";
                                              echo "<th>Tgl Mulai</th>";
                                              echo "<th>Nomor peserta</th>";
                                              echo "<th>NISN</th>";
                                              echo "<th>NIS Sistem</th>";
                                              echo "<th>Kelas Sistem</th>";
                                              echo "<th>Program Sistem</th>";
                                              echo "<th>TTL Sistem</th>";
                                              echo "<th>Foto Sistem</th>";
                                              echo "<th>Logo Depdikbud</th>";
                                              echo "<th>TTD Sistem</th>";
                                              echo "<th>Keterangan</th>";
                                              echo "<th>Status</th>";
                                              echo "<th width='100'>Aksi</th>";
                                              ?>
                                          </tr>
                                        </thead>
                                        <tbody>
                                        	<?php
                                        	$CI =& get_instance();$no=1;
											foreach((array)$show_table as $row) {
											    echo "<tr>";
											    echo "<td align='center'>".$no++."</td>";
                          echo "<td align='center'>".strtoupper($row->departemen)."</td>";
                          echo "<td align='center'>".$row->tryout."</td>";
                          echo "<td align='center'>".$CI->p_c->tgl_indo($row->tanggal)."</td>";
                          echo "<td align='center'>".$CI->p_c->cekaktif($row->nomorpeserta)."</td>";
                          echo "<td align='center'>".$CI->p_c->cekaktif($row->nisn)."</td>";
                          echo "<td align='center'>".$CI->p_c->cekaktif($row->nissistem)."</td>";
                          echo "<td align='center'>".$CI->p_c->cekaktif($row->kelassistem)."</td>";
                          echo "<td align='center'>".$CI->p_c->cekaktif($row->programsistem)."</td>";
                          echo "<td align='center'>".$CI->p_c->cekaktif($row->ttlsistem)."</td>";
                          echo "<td align='center'>".$CI->p_c->cekaktif($row->fotosistem)."</td>";
                          echo "<td align='center'>".$CI->p_c->cekaktif($row->logodepdikbud)."</td>";
                          echo "<td align='center'>".$CI->p_c->cekaktif($row->ttdsistem)."</td>";
                          echo "<td align='center'>".$row->keterangan."</td>";
                          echo "<td align='center'>".$CI->p_c->cekaktif($row->aktif)."</td>";
											    echo "<td align='center'>";
                          //echo "<a href=javascript:void(window.open('".site_url('ksw_kartusiswaatur/view/'.$row->replid)."')) class='btn btn-xs btn-info fa fa-circle-o' ></a>&nbsp;";
                          echo "<a href=javascript:void(window.open('".site_url('ksw_kartusiswaatur/ubah/'.$row->replid)."')) class='btn btn-xs btn-warning fa fa-check-square' ></a>&nbsp;";
                          echo "<a href=javascript:void(window.open('".site_url('ksw_kartusiswaatur/hapus/'.$row->replid)."')) class='btn btn-xs btn-danger fa fa-minus-square' ></a> ";
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
		    	<table width="100%" border="0">
            <tr>
              <th align="left">
              <label class="control-label" for="minlengthfield">Jenjang</label>
              <div class="control-group">
            <div class="controls">:
              <?php
                $arrdepartemen="id='departemen' data-rule-required='true' ";
                echo form_dropdown('departemen',$departemen_opt,$isi->departemen,$arrdepartemen);
              ?>
                    <?php //echo  <p id="message"></p> ?>
            </div>
              </div>
              </th></tr>
		    		<tr>
		            <th align="left">
	                		<label class="control-label" for="minlengthfield">Judul Kartu</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		 echo form_input(array('class' => '','style'=>'margin: 0px 0px 5px; width: 687px;', 'id' => 'tryout','name'=>'tryout','value'=>$isi->tryout,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'500', 'data-rule-minlength'=>'1' ,'placeholder'=>'Masukkan 1-100 Karakter'));
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th></tr>
                  <tr>
      		            <th align="left">
      	                		<label class="control-label" for="minlengthfield">Tanggal Mulai</label>
      	                		<div class="control-group">
      								<div class="controls">:
      			                	<?php
      			                		 echo form_input(array('class' => '', 'id' => 'dp2','name'=>'tanggal','value'=>$CI->p_c->tgl_form($isi->tanggal),'data-rule-required'=>'true' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'2' ,'placeholder'=>'DD-MM-YYYY','autocomplete'=>'off'));
      			                	?>
      			                	<?php //echo  <p id="message"></p> ?>
      								</div>
      	                		</div>
      			            </th></tr>

              <tr>
  		            <th align="left">
  		        		<label class="control-label" for="minlengthfield">Nomor peserta</label>
  		        		<div class="control-group">
  							<div class="controls">:
  		                	<?php
  		                		echo form_checkbox('nomorpeserta', '1', $isi->nomorpeserta);
  		                	?>
  		                	<?php //echo  <p id="message"></p> ?>
  							</div>
  		        		</div>
  		            </th></tr>
            <tr>
		            <th align="left">
		        		<label class="control-label" for="minlengthfield">NISN</label>
		        		<div class="control-group">
							<div class="controls">:
		                	<?php
		                		echo form_checkbox('nisn', '1', $isi->nisn);
		                	?>
		                	<?php //echo  <p id="message"></p> ?>
							</div>
		        		</div>
		            </th></tr>
                  <tr>
                      <th align="left">
                      <label class="control-label" for="minlengthfield">NIS Sistem</label>
                      <div class="control-group">
                    <div class="controls">:
                            <?php
                              echo form_checkbox('nissistem', '1', $isi->nissistem);
                            ?>
                            <?php //echo  <p id="message"></p> ?>
                    </div>
                      </div>
                      </th></tr>
                <tr>
                    <th align="left">
                    <label class="control-label" for="minlengthfield">Kelas Sistem</label>
                    <div class="control-group">
                  <div class="controls">:
                          <?php
                            echo form_checkbox('kelassistem', '1', $isi->kelassistem);
                          ?>
                          <?php //echo  <p id="message"></p> ?>
                  </div>
                    </div>
                    </th></tr>
              <tr>
                  <th align="left">
                  <label class="control-label" for="minlengthfield">Program Sistem</label>
                  <div class="control-group">
                <div class="controls">:
                        <?php
                          echo form_checkbox('programsistem', '1', $isi->programsistem);
                        ?>
                        <?php //echo  <p id="message"></p> ?>
                </div>
                  </div>
                  </th></tr>
            <tr>
                <th align="left">
                <label class="control-label" for="minlengthfield">TTL Sistem</label>
                <div class="control-group">
              <div class="controls">:
                      <?php
                        echo form_checkbox('ttlsistem', '1', $isi->ttlsistem);
                      ?>
                      <?php //echo  <p id="message"></p> ?>
              </div>
                </div>
                </th></tr>
          <tr>
              <th align="left">
              <label class="control-label" for="minlengthfield">Foto Sistem</label>
              <div class="control-group">
            <div class="controls">:
                    <?php
                      echo form_checkbox('fotosistem', '1', $isi->fotosistem);
                    ?>
                    <?php //echo  <p id="message"></p> ?>
            </div>
              </div>
              </th></tr>
        <tr>
            <th align="left">
            <label class="control-label" for="minlengthfield">Logo Depdikbud</label>
            <div class="control-group">
          <div class="controls">:
                  <?php
                    echo form_checkbox('logodepdikbud', '1', $isi->logodepdikbud);
                  ?>
                  <?php //echo  <p id="message"></p> ?>
          </div>
            </div>
            </th></tr>
      <tr>
          <th align="left">
          <label class="control-label" for="minlengthfield">TTD Sistem</label>
          <div class="control-group">
        <div class="controls">:
                <?php
                  echo form_checkbox('ttdsistem', '1', $isi->ttdsistem);
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
				                		echo form_textarea(array('class' => '', 'id' => 'keterangan','name'=>'keterangan','value'=>$isi->keterangan,'data-rule-required'=>'false' ,'data-rule-maxlength'=>'500', 'data-rule-minlength'=>'2' ,'placeholder'=>'Masukkan 2-500 Karakter'));
				                	?>
				                	<?php //echo  <p id="message"></p> ?>
									</div>
		                		</div>
				            </th></tr>
				    <tr>
		            <th align="left">
		        		<label class="control-label" for="minlengthfield">Aktif</label>
		        		<div class="control-group">
							<div class="controls">:
		                	<?php
		                		echo form_checkbox('aktif', '1', $isi->aktif);
		                	?>
		                	<?php //echo  <p id="message"></p> ?>
							</div>
		        		</div>
		            </th></tr>
				    <tr>
				            <th align="left">
				            	<button class='btn btn-primary' onclick="return validate()">Simpan</button>
				            	<a href="javascript:void(window.open('<?php echo site_url("ksw_kartusiswaatur") ?>'))" class="btn btn-success">Kembali</a>
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
