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
                        <li><a href="javascript:void(window.open('<?php echo site_url('ns_prosestipe/tambah'); ?>'))" ><i class="fa fa-plus-square"></i> Tambah</a></li>
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
                                 <th align="left">
        				                		<label class="control-label" for="minlengthfield">Lokasi Sekolah</label>
        				                		<div class="control-group">
                											<div class="controls">:
            						                	<?php
                                          $arridcompany="data-rule-required=false id=idcompany onchange='javascript:this.form.submit();'";
                                          echo form_dropdown('idcompany',$idcompany_opt,$this->input->post('idcompany'),$arridcompany);
                                        ?>
                											</div>
              				              </div>
              						         </th>
											   
    			                  </tr>
								  <tr>
                                  <th align="left">
                                    <label class="control-label" for="minlengthfield">Status</label>
                                    <div class="control-group">
                                      <div class="controls">:
                                          <?php
                                            $arraktif='data-rule-required=false onchange=javascript:this.form.submit();';
                                            echo form_dropdown('aktif',$aktif_opt,$this->input->post('aktif'),$arraktif);
                                          ?>
                                          <?php //echo  <p id="message"></p> ?>
                                      </div>
                                    </div>
                                   </th>
								   <th align="left">
      				                		<label class="control-label" for="minlengthfield">Kata Kunci</label>
      				                		<div class="control-group">
              											<div class="controls">:
          						                	<?php
                                               		echo form_input(array('class' => '','style'=>'margin: 0px 0px 5px; width: 300px;', 'id' => 'katakunci','name'=>'katakunci','value'=>$this->input->post('katakunci'),'data-rule-required'=>'false' ,'data-rule-maxlength'=>'500', 'data-rule-minlength'=>'3' ,'placeholder'=>'Masukkan 1-100 Karakter'));
          						                	?>
          						                	<?php //echo  <p id="message"></p> ?>
              											</div>
            				              </div>
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
                                                echo "<th width='50'>No.</th>";
                                                echo "<th>Tipe Proses</th>";
                                                echo "<th>Jenjang</th>";
                                                echo "<th>Keterangan</th>";
                                                echo "<th width='80'>No. Urut</th>";
                                                echo "<th>Penilaian WK</th>";
                                                echo "<th>Lokasi Sekolah</th>";
                                                echo "<th>aktif</th>";
                                                echo "<th width='80'>Aksi</th>";
                                                ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        	<?php
                                        	$CI =& get_instance();$no=1;
											foreach((array)$show_table as $row) {
											    echo "<tr>";
											    echo "<td align='center'>".$no++."</td>";
											    echo "<td align=''>".strtoupper($row->prosestipe)."</td>";
                          echo "<td align=''>".strtoupper($row->iddepartemen)."</td>";
											    echo "<td align='center'>".strtoupper($row->keterangan)."</td>";
											    echo "<td align='center'>".$row->no_urut."</td>";
                          echo "<td align='center'>";
											    echo "<a href=javascript:void(window.open('".site_url('ns_prosestipe/ubahnilaiwali/'.$row->replid.'/'.!($row->nilaiwali))."'))>".($CI->p_c->cekaktif($row->nilaiwali))."</a>";
                          echo "</td>";
                          echo "<td align='center'>".$CI->dbx->variabel_company('ns_prosestipe',$row->replid)."</td>";
                          echo "<td align='center'>";
											    echo "<a href=javascript:void(window.open('".site_url('ns_prosestipe/ubahaktif/'.$row->replid.'/'.!($row->aktif))."'))>".$CI->p_c->cekaktif($row->aktif)."</a>";
                          echo "</td>";
											    echo "<td align='center'>";
                          //if ($row->pakai<1){
											                 echo "<a href=javascript:void(window.open('".site_url('ns_prosestipe/ubah/'.$row->replid)."')) class='btn btn-xs btn-warning fa fa-check-square' ></a>&nbsp;&nbsp;";
                          //}
                          if ($row->pakai<1){
                                      echo "<a href=javascript:void(window.open('".site_url('ns_prosestipe/hapus/'.$row->replid)."')) class='btn btn-xs btn-danger fa fa-minus-square' ></a>";
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
		    	<table width="100%" border="0">
		    		<tr>
		            <th align="left">
	                		<label class="control-label" for="minlengthfield">Tipe Proses</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		echo form_input(array('class' => '','style'=>'margin: 0px 0px 5px; width: 687px;', 'id' => 'prosestipe','name'=>'prosestipe','value'=>$isi->prosestipe,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'500', 'data-rule-minlength'=>'2' ,'placeholder'=>'Masukkan 5-100 Karakter'));
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th></tr>
                  <tr>
                    <th align="left">
                    <label class="control-label" for="minlengthfield">Jenjang</label>
                    <div class="control-group">
                  <div class="controls">:
                          <?php
                            $arriddepartemen='data-rule-required=true';
                            echo form_dropdown('iddepartemen',$iddepartemen_opt,$isi->iddepartemen,$arriddepartemen);
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
					<tr>
				            <th align="left">
		                		<label class="control-label" for="minlengthfield">No. Urut</label>
		                		<div class="control-group">
									<div class="controls">:
				                	<?php
				                		echo form_input(array('id' => 'no_urut','name'=>'no_urut','value'=>$isi->no_urut,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'3', 'data-rule-minlength'=>'1','data-rule-number'=>'true','placeholder'=>'Masukkan 1-3 Karakter'));
				                	?>
				                	<?php //echo  <p id="message"></p> ?>
									</div>
		                		</div>
				        </th></tr>
                <tr>
		            <th align="left">
		        		<label class="control-label" for="minlengthfield">Penilaian WK</label>
		        		<div class="control-group">
							<div class="controls">:
		                	<?php
		                		echo form_checkbox('nilaiwali', '1', $isi->nilaiwali);
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
                      <hr/>
                    <label class="control-label" for="minlengthfield">Lokasi Sekolah</label>
                    <div class="control-group">
                  <div class="controls">
                          <?php
                          $CI->p_c->checkbox_more('idcompany',$idcompany_opt,$idreff_company_opt,0);
                          ?>
                  </div>
                    </div>
                    <hr/>
                    </th>
              </tr>
				    <tr>
				            <th align="left">
				            	<button class='btn btn-primary' onclick="return validate()">Simpan</button>
				            	<a href="javascript:void(window.open('<?php echo site_url('ns_prosestipe') ?>'))" class="btn btn-success">Kembali</a>
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
