<!DOCTYPE html>
<?php
	$ro="";
	if (isset($viewview)){
		$ro="'disabled'";
	}

?>
<html>
<script language="javascript">
function printsdk(id) {
	newWindow('../printsdk/'+id, 'printsdk','900','800','resizable=1,scrollbars=1,status=0,toolbar=0')
}
</script>
    <?php $this->load->view('header') ?>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas">
            <?php $this->load->view('menu') ?>
            </aside>
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <?php

                $CI =& get_instance();
                if($view=='index'){?>
									<section class="content-header table-responsive">
	                    <h1>
	                        <?php echo $form ?>
	                        <small>List Data</small>
	                    </h1>

											<ol class="breadcrumb">
													<li><a href="javascript:void(window.open('<?php echo site_url('reff_user/ubahuser'); ?>'))" ><i class="fa fa-plus-square"></i> Tambah</a></li>
											</ol>
	                </section>
                <!-- Main content -->
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
																					$arridcompany='data-rule-required=false onchange=javascript:this.form.submit();';
																					echo form_dropdown('idcompany',$idcompany_opt,$this->input->post('idcompany'),$arridcompany);
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
                <section class="content">
	                	<table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
																		<th width='230px'>Unit Bisnis</th>
                                    <th>NIP</th>
                                    <th>Nama</th>
                                    <th>Peran</th>
                                    <th>Jenjang</th>
                                    <th>Status Pegawai</th>
                                    <th>Aktif</th>
                                    <th>Aksi</th>
                                </tr>

                            </thead>
                            <tbody>
                            	<?php
                            	$CI =& get_instance();
								foreach((array)$show_table as $row) {
								    echo "<tr>";
											echo "<td align='left'>".str_replace(',','<br/>',$CI->dbx->company_show($row->idcompany,1))."</td>";
											echo "<td align='center'><a href=javascript:void(window.open('".site_url('reff_user/viewuser/'.$row->replid)."')) >".$row->nip."</a></td>";
								    	echo "<td align='center'>".strtoupper($row->nama)."</td>";
								    	echo "<td align='left'>".str_replace(',','<br/>',$CI->dbx->role_show($row->role_id,1,0))."</td>";
								    	echo "<td align='left'>".strtoupper(str_replace(',','<br/>',$CI->dbx->departemen_show($row->departemen)))."</td>";
								    	echo "<td align='center'>".($CI->p_c->cekaktif($row->status_pegawai))."</td>";
								    	echo "<td align='center'>".$CI->p_c->cekaktif($row->aktif)."</td>";
									    echo "<td align='center' width='150'>";
											echo "<a href=javascript:void(window.open('".site_url('reff_user/ubahuser/'.$row->replid)."')) class='btn btn-xs btn-warning fa fa-check-square' ></a>&nbsp;&nbsp;";
									    echo "<a href=javascript:void(window.open('".site_url('reff_user/hapususer_p/'.$row->replid)."'))  class='btn btn-xs btn-danger fa fa-minus-square' ></a>";
									    echo "</td>";
								    echo "</tr>";
								}
								?>
                            </tbody>
                            <tfoot>
                            </tfoot>
	                	</table>
	                	<?php
		}elseif($view=='ubahuser'){?>
			<script type="text/javascript">
	      $(function(){
	        $.ajaxSetup({
	          type:"POST",
	          url: "<?php echo site_url('combobox/ambil_data') ?>",
	          cache: false,
	        });

	        $("#idcompanypegawai").change(function(){
	            var value=$(this).val();
	            $.ajax({
	              data:{modul:'idpegawaiuser',id:value},
	              success: function(respond){
	                $("#nip").html(respond);
	              }
	            });
	        });
	      });
	    </script>

	    	<section class="content-header table-responsive">
	            <h1>
	                <?php echo $form ?>
	             </h1>

							 <ol class="breadcrumb">
									 <li><a href="javascript:void(window.open('<?php echo site_url('reff_user/ubahuser'); ?>'))" ><i class="fa fa-plus-square"></i> Tambah</a></li>
							 </ol>
	        </section>
	        <section class="content">
	        <?php
		        $attributes = array('class' => 'form-horizontal form-validate', 'id' => 'form', 'method' => 'POST', 'novalidate'=>'novalidate');
	    	echo form_open($action,$attributes);
	    	?>
	    	<table width="100%" border="0">
	    		<?php if (($isi->nip<>"") or (isset($viewview))) {?>
	    		<tr>
	            <th align="left">
	        		<label class="control-label" for="minlengthfield">NIP</label>
	        		<div class="control-group">
						<div class="controls">:
	                	<?php
	                		echo "<a href=javascript:void(window.open('".site_url('general/datapegawai/'.$isi->iduser)."'))>".$isi->nip."</a>";
	                	?>
						</div>
	        		</div>
	            </th></tr>

	            <tr>
	            <th align="left">
	        		<label class="control-label" for="minlengthfield">Pegawai</label>
	        		<div class="control-group">
						<div class="controls">:
	                	<?php
	                		echo $isi->nama;
	                	?>
						</div>
	        		</div>
	            </th></tr>
	            <?php } else {?>
								<tr>
				            <th align="left">
				        		<label class="control-label" for="minlengthfield">Unit Bisnis Asli</label>
				        		<div class="control-group">
									<div class="controls">:
										<?php
											$arridcompanypegawai='data-rule-required=false id="idcompanypegawai"';
											echo form_dropdown('idcompanypegawai',$idcompanypegawai_opt,$this->input->post('idcompanypegawai'),$arridcompanypegawai);
										?>
									</div>
				        		</div>
				            </th></tr>
	           	 	<tr>
			            <th align="left">
	                		<label class="control-label" for="minlengthfield">Pegawai</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		$arrnip='data-rule-required=true id="nip"';
			                		echo form_dropdown('nip',$nip_opt,$isi->nip,$arrnip);
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th></tr>
			         <!--
			         <tr>
			            <th align="left">
	                		<label class="control-label" for="minlengthfield">Kata Sandi</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		echo form_password(array('class' => '', 'id' => 'password','name'=>'password','data-rule-required'=>'true' ,'data-rule-maxlength'=>'500', 'data-rule-minlength'=>'6' ,'placeholder'=>'Masukkan 6-500 Karakter','size'=>'15'));
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th></tr>
			            <tr>
			            <th align="left">
	                		<label class="control-label" for="minlengthfield">Konfirmasi Kata Sandi</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		echo form_password(array('class' => '', 'id' => 'password2','name'=>'password2','data-rule-required'=>'true' ,'data-rule-maxlength'=>'500', 'data-rule-minlength'=>'6' ,'placeholder'=>'Masukkan 6-500 Karakter','size'=>'15'));
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th></tr>
			            -->
	            <?php } ?>
							<tr>
									<th align="left">
										<hr/>
									<label class="control-label" for="minlengthfield">Unit Bisnis Peran</label>
									<div class="control-group">
								<div class="controls">
												<?php
												if (!isset($viewview)){
													$CI->p_c->checkbox_more('idcompany',$idcompany_opt,$isi->idcompany,$ro);
												}else{
													echo ": ".$CI->dbx->company_show($isi->idcompany,1);
		                		}
												?>
								</div>
									</div>
									<hr/>
									</th>
						</tr>
	    			<tr>
	            <th align="left">
	        		<label class="control-label" for="minlengthfield">Peran</label>
	        		<div class="control-group">
						<div class="controls">
	                	<?php
							if (!isset($viewview)){
		                		?>
		                		<!-- <input type="checkbox" onClick="selectallx('role','selectall')" id="selectall" class="selectall"/> Pilih Semua <hr/> -->
		                		<?php
		                		$CI->p_c->checkbox_more('role',$role_opt,$isi->role_id,$ro);
	                		}else{
		                		echo ": ".$CI->dbx->role_show($isi->role_id,1);
	                		}

	                	?>
	                	<?php //echo  <p id="message"></p> ?>
						</div>
	        		</div>
							<hr/>
	            </th></tr>

	            <tr>
	            <th align="left">
	        		<label class="control-label" for="minlengthfield">Jenjang</label>
	        		<div class="control-group">
						<div class="controls">
						<?php
							if (!isset($viewview)){
		                		?>
		                		<input type="checkbox" onClick="selectallx('departemen','selectall2')" id="selectall2" class="selectall2"/> Pilih Semua <hr/>
		                		<?php
	                		}

	                		$CI->p_c->checkbox_more('departemen',$departemen_opt,$isi->departemen,$ro)
	                	?>
	                	<?php //echo  <p id="message"></p> ?>
						</div>
	        		</div>
	            </th></tr>
              <!--
	            <tr>
	            <th align="left">
	        		<label class="control-label" for="minlengthfield">Kelas</label>
	        		<div class="control-group">
						<div class="controls">
						<?php
	                		if (!isset($viewview)){
		                		?>
		                		<input type="checkbox" onClick="selectallx('kelas','selectall3')" id="selectall3" class="selectall3"/> Pilih Semua <hr/>
		                		<?php
	                		}
	                		$CI->p_c->checkbox_more('kelas',$kelas_opt,$isi->kelas,$ro)
	                	?>
	                	<?php //echo  <p id="message"></p> ?>
						</div>
	        		</div>
	            </th></tr>
	            <tr>
	            <th align="left">
	        		<label class="control-label" for="minlengthfield">Mata Pelajaran</label>
	        		<div class="control-group">
						<div class="controls">
	                	<?php

	                		if (!isset($viewview)){
		                		?>
		                		<input type="checkbox" onClick="selectallx('matpel','selectall4')" id="selectall4" class="selectall4"/> Pilih Semua <hr/>
		                		<?php
	                		}
	                		$CI->p_c->checkbox_more('matpel',$matpel_opt,$isi->matpel,$ro)
	                	?>
	                	<?php //echo  <p id="message"></p> ?>
						</div>
	        		</div>
	            </th></tr>
	            <tr>
			            <th align="left">
	                		<label class="control-label" for="minlengthfield">Keterangan</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		if (isset($viewview)) {
			                			echo $isi->keterangan;
			                		}else{
				                		echo form_textarea(array('class' => '', 'id' => 'keterangan','name'=>'keterangan','value'=>$isi->keterangan,'data-rule-required'=>'false' ,'data-rule-maxlength'=>'500', 'data-rule-minlength'=>'2' ,'placeholder'=>'Masukkan 2-500 Karakter'));
			                		}
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th></tr>
								-->

	             <tr>
	            <th align="left">
								<hr/>
	        		<label class="control-label" for="minlengthfield">Aktif</label>
	        		<div class="control-group">
						<div class="controls">:
	                	<?php
	                		if (isset($viewview)) {
	                			echo $CI->p_c->cekaktif($isi->aktif);
	                		}else{
				            	echo form_checkbox('aktif', '1', $isi->aktif);
				            }
	                	?>
	                	<?php //echo  <p id="message"></p> ?>
						</div>
	        		</div>
	            </th></tr>
	            <?php if (($isi->nip<>"") and (!isset($viewview))) {?>
	            <tr>
	            <th align="left">
	        		<label class="control-label" for="minlengthfield">Kembalikan Kata Sandi</label>
	        		<div class="control-group">
						<div class="controls">:
	                	<?php
	                		echo form_checkbox('reset', '1',0);
	                	?>
	                	<?php //echo  <p id="message"></p> ?>
						</div>
	        		</div>
	            </th></tr>
	            <?php }?>
	            </table>
	            <table width="100%">
                    <tr>
				            <th align="left">
				            	 <?php
				            	 if (!isset($viewview)) {
					            	 if (isset($isi->replid)){ ?>
						           		<input type="hidden" name="nip" value="<?php echo $isi->idnip ?>">

					            	 <?php } ?>
						        	<button class='btn btn-primary'>Simpan</button>
						        	<?php if (isset($isi->replid)){ ?>
						        		<a href="javascript:void(window.open('<?php echo site_url('reff_user/viewuser/'.$isi->replid) ?>'))" class="btn btn-success">Kembali</a>
					        	<?php
					        		}
					        	} else {
						        ?>
						        <ol class="breadcrumb">
			                    	<li><a href="JavaScript:printsdk('<?php echo $isi->replid?>')"><i class="fa fa-file-text"></i>&nbsp;&nbsp;Cetak SDK</a></li>
			                    </ol>
				            	<a href="javascript:void(window.open('<?php echo site_url('reff_user/ubahuser/'.$isi->replid) ?>'))" class="btn btn-warning">Ubah</a>
				            	<a href="javascript:window.close();" class="btn btn-success">Kembali</a>
					        	<?php } ?>
				            </th>
				    </tr>
		        </table>
	            <?php
	        	echo form_close();
	      ?>
	    </section><!-- /.content -->
                <?php }?>
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
    </body>
</html>
