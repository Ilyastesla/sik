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
                        <li><a href="javascript:void(window.open('<?php echo site_url('reff_kota/tambah'); ?>'))" ><i class="fa fa-plus-square"></i> Tambah</a></li>
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
																	<label class="control-label" for="minlengthfield">Negara</label>
																	<div class="control-group">
																		<div class="controls">:
																				<?php
																					$arridnegara='data-rule-required=false onchange=javascript:this.form.submit();';
																					echo form_dropdown('idnegara',$idnegara_opt,$this->input->post('idnegara'),$arridnegara);
																				?>
																				<?php //echo  <p id="message"></p> ?>
																		</div>
																	</div>
																 </th>
													  </tr>
                            <tr>
															 <th align="left">
																	<label class="control-label" for="minlengthfield">Provinsi</label>
																	<div class="control-group">
																		<div class="controls">:
																				<?php
																					$arridpropinsi='data-rule-required=false onchange=javascript:this.form.submit();';
																					echo form_dropdown('idpropinsi',$idpropinsi_opt,$this->input->post('idpropinsi'),$arridpropinsi);
																				?>
																				<?php //echo  <p id="message"></p> ?>
																		</div>
																	</div>
																 </th>
													  </tr>
														<tr>
																	<th align="left">
																			<label class="control-label" for="minlengthfield">Aktif</label>
																			<div class="control-group">
																				<div class="controls">:
																					<?php
																						$arraktif='data-rule-required=false onchange=javascript:this.form.submit();';
																						$aktifpick=$this->input->post('aktif');
																						if($aktifpick==""){
																							$aktifpick=1;
																						}
																						echo form_dropdown('aktif',$aktif_opt,$aktifpick,$arraktif);
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
                                                <th width='50'>No.</th>
                                                <th>Kota</th>
                                                <th>Propinsi</th>
                                                <th>Negara</th>
                                                <!-- <th width="80">No. Urut</th>-->
                                                <th>Aktif</th>
                                                <th width="80">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        	<?php
                                        	$CI =& get_instance();$no=1;
											foreach((array)$show_table as $row) {
											    echo "<tr>";
											    echo "<td align='center'>".$no++."</td>";
											    echo "<td align=''>".strtoupper($row->kota)."</td>";
                          echo "<td align=''>".strtoupper($row->propinsi)."</td>";
                          echo "<td align=''>".strtoupper($row->negara)."</td>";
											    //echo "<td align='center'>".$row->urutan."</td>";
                          echo "<td align='center'>";
                          echo "<a href=javascript:void(window.open('".site_url('reff_kota/ubahaktif/'.$row->replid.'/'.!($row->aktif))."'))>".$CI->p_c->cekaktif($row->aktif)."</a>";
                          //$CI->p_c->cekaktif($row->aktif).
                          echo "</td>";
                          echo "<td align='center'>";
                          //if ($row->pakai<1){
											                 echo "<a href=javascript:void(window.open('".site_url('reff_kota/ubah/'.$row->replid)."')) class='btn btn-xs btn-warning fa fa-check-square' ></a>&nbsp;";
                          //}
                          if ($row->pakai<1){
											                 echo "<a href=javascript:void(window.open('".site_url('reff_kota/hapus/'.$row->replid)."')) class='btn btn-xs btn-danger fa fa-minus-square' ></a>";
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
  <script type="text/javascript">
    $(function(){
      $.ajaxSetup({
        type:"POST",
        url: "<?php echo site_url('combobox/ambil_data') ?>",
        cache: false,
      });

      $("#idnegara").change(function(){
          var value=$(this).val();
          $.ajax({
            data:{modul:'idpropinsi',id:value},
            success: function(respond){
              $("#idpropinsi").html(respond);
            }
          });
      });
    });
  </script>
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
                    <label class="control-label" for="minlengthfield">Negara</label>
                    <div class="control-group">
                  <div class="controls">:
                          <?php
                            $arridnegara="id='idnegara' data-rule-required='true'";
                            echo form_dropdown('idnegara',$idnegara_opt,$isi->id_negara,$arridnegara);
                          ?>
                          <?php //echo  <p id="message"></p> ?>
                  </div>
                    </div>
                    </th></tr>
                    <tr>
                      <th align="left">
                      <label class="control-label" for="minlengthfield">Propinsi</label>
                      <div class="control-group">
                    <div class="controls">:
                            <?php
                              $arridpropinsi="id='idpropinsi' data-rule-required='true'";
                              echo form_dropdown('idpropinsi',$idpropinsi_opt,$isi->id_propinsi,$arridpropinsi);
                            ?>
                            <?php //echo  <p id="message"></p> ?>
                    </div>
                      </div>
                      </th></tr>
                    <tr>
        		            <th align="left">
        	                		<label class="control-label" for="minlengthfield">Kota</label>
        	                		<div class="control-group">
        								<div class="controls">:
        			                	<?php
        			                		echo form_input(array('class' => '','style'=>'margin: 0px 0px 5px; width: 300px;', 'id' => 'kota','name'=>'kota','value'=>$isi->kota,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'500', 'data-rule-minlength'=>'2' ,'placeholder'=>'Masukkan 5-100 Karakter'));
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
				            	<a href="javascript:void(window.open('<?php echo site_url('reff_kota') ?>'))" class="btn btn-success">Kembali</a>
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
