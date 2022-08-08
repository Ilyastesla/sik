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
                <!-- Content Header (Page header) -->
<?php $CI =& get_instance();?>
<?php if($view=='index'){ ?>
                <section class="content-header table-responsive">
                    <h1>
                        <?php echo $form ?>
                        <small>List Data</small>
                    </h1>
                    <!--
                        <li><a href="#"><i class="fa fa-file-text"></i>Cetak</a></li>
                        <li><a href="#"><i class="fa fa-file-excel-o"></i>Excel</a></li>
                        -->
                    <ol class="breadcrumb">
                        <li><a href="javascript:void(window.open('<?php echo site_url('inventory_opname/tambah'); ?>'))" ><i class="fa fa-plus-square"></i> Tambah</a></li>

                    </ol>
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
                                                <th>No. Transaksi</th>
                                                <th>Perusahaan</th>
                                                <th>Tgl. Transaksi</th>
                                                <th>Keterangan</th>
                                                <th width="80">Aksi</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                        	<?php
                                        	$CI =& get_instance();
											foreach((array)$show_table as $row) {
											    echo "<tr>";
											    echo "<td align='center'>";
												  echo "<a href=javascript:void(window.open('".site_url('inventory_opname/view/'.$row->replid)."')>".$row->kode_transaksi."</a>";
											    echo "</td>";
											    echo "<td align=''>".strtoupper($row->company)."</td>";
											    echo "<td align='center'>".strtoupper($CI->p_c->tgl_indo($row->tanggaltransaksi))."</td>";
											    echo "<td align='center'>".$row->keterangan."</td>";
											    echo "<td align='center'>";
													if(trim($row->created_by)==$this->session->userdata('idpegawai')){
														echo "<a href=javascript:void(window.open('".site_url('inventory_opname/ubah/'.$row->replid)."')) class='btn btn-xs btn-warning fa fa-check-square' ></a>&nbsp;&nbsp;";
                            echo "<a href=javascript:void(window.open('".site_url('inventory_opname/hapus/'.$row->replid)."')) class='btn btn-xs btn-danger fa fa-minus-square' ></a>";
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
		        		<label class="control-label" for="minlengthfield">No. Transaksi</label>
		        		<div class="control-group">
							<div class="controls">:
		                	<?php
		                		echo $isi->kode_transaksi;
		                	?>
							</div>
		        		</div>
		            </th></tr>
		            <tr>
		            <th align="left">
		        		<label class="control-label" for="minlengthfield">Perusahaan</label>
		        		<div class="control-group">
							<div class="controls">:
		                	<?php
		                		$arrcompany='data-rule-required=true';
		                		echo form_dropdown('idcompany',$company_opt,$isi->idcompany,$arrcompany);
		                	?>
							</div>
		        		</div>
		            </th></tr>
		            <tr>
			            <th align="left">
	                		<label class="control-label" for="minlengthfield">Tgl. Transaksi</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		echo form_input(array('class' => '', 'id' => 'dp1','name'=>'tanggaltransaksi','value'=>$CI->p_c->tgl_form($isi->tanggaltransaksi),'data-rule-required'=>'false' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'2' ,'placeholder'=>'DD-MM-YYYY','autocomplete'=>'off'));
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th>
			         </tr>
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
				            	<button class='btn btn-primary' onclick="return validate()">Simpan</button>
				            	<a href="javascript:void(window.open('<?php echo site_url('inventory_opname') ?>'))" class="btn btn-success">Kembali</a>
				            </th>
				    </tr>
		            </table>
		        	<?php
		        	echo form_close();
		        	?>
	    </section>
<!------------------------------------------------------------------------------------------------------------------------------------>
<?php } elseif($view=='material'){ ?>
		<section class="content-header table-responsive">
	            <h1>
	                <?php echo $form ?>
	                <small><?php echo $form_small ?></small>
	            </h1>
              <ol class="breadcrumb">
                  <li><a href="javascript:void(window.open('<?php echo site_url('inventory_opname/tambah'); ?>'))" ><i class="fa fa-plus-square"></i> Tambah</a></li>
              </ol>
            </section>
            <section class="content">
		    	<table width="100%" border="0" class='form-horizontal form-validate'>
		    		<tr>
		            <th align="left">
		        		<label class="control-label" for="minlengthfield">No. Transaksi</label>
		        		<div class="control-group">
							<div class="controls">:
		                	<?php echo strtoupper($isi->kode_transaksi);?>
							</div>
		        		</div>
		            </th></tr>
		            <tr>
		            <th align="left">
		        		<label class="control-label" for="minlengthfield">Perusahaan</label>
		        		<div class="control-group">
							<div class="controls">:
							<?php echo strtoupper($isi->company);?>
							</div>
		        		</div>
		            </th></tr>
		            <tr>
			            <th align="left">
	                		<label class="control-label" for="minlengthfield">Tgl. Transaksi</label>
	                		<div class="control-group">
								<div class="controls">:
								<?php echo $CI->p_c->tgl_indo($isi->tanggaltransaksi);?>
								<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th>
			         </tr>
				    <tr>
				            <th align="left">
		                		<label class="control-label" for="minlengthfield">Keterangan</label>
		                		<div class="control-group">
									<div class="controls" valign="top">:
				                	<?php echo $isi->keterangan;?>
				                	<?php //echo  <p id="message"></p> ?>
									</div>
		                		</div>
				            </th></tr>
				     <tr>
				     	<td align="left">
				     		<hr><h4>Material :</h4>
				     		<?php if(!isset($viewview)){?>
				     		<section class="content-header table-responsive">
			                    <ol class="breadcrumb">
			                        <li><a href="javascript:void(window.open('<?php echo site_url('inventory_opname/tambahmaterial/'.$id); ?>'))" ><i class="fa fa-plus-square"></i> Tambah</a></li>
			                    </ol>
			                </section>
			                <?php } ?>
			                <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                    	<th width='50'>No.</th>
                                        <th>Material</th>
																				<?php if(isset($viewview)){ ?>
																				<th>Jumlah Asal</th>
																				<?php } ?>
																				<th>Jumlah Stok</th>
                                        <th>Unit</th>
                                        <?php if(!isset($viewview)){?>
                                        <th width="80">Aksi</th>
                                        <?php } ?>
                                    </tr>
                                </thead>
                                <tbody>
                                	<?php
                                	$jml_c=0;$no=1;$stock=0;
                                	if (!empty($material)){
										foreach($material as $row) {
											if ($row->stock<>""){
			                                	$stock=$row->stock;
		                                	}
										    echo "<tr>";
										    echo "<td align='center'>".$no++."</td>";
										    echo "<td align=''><a href=javascript:void(window.open('".site_url('inventory/viewmaterial/'.$row->idmaterial)."'))>".$row->materialtext."</a></td>";
												if(isset($viewview)){
													echo "<td align='center'>".$row->jumlahdb."</td>";
												}
												echo "<td align='center'>".$row->jumlahreal."</td>";
										    echo "<td align='center'>".$row->idunit."</td>";
										    if(!isset($viewview)){
										    echo "<td align='center'>";
										    echo "
										    		<a href=javascript:void(window.open('".site_url('inventory_opname/tambahmaterial/'.$isi->replid.'/'.$row->replid)."')) class='btn btn-xs btn-warning'>
										    			Ubah
										    		</a>
										    		<a href=javascript:void(window.open('".site_url('inventory_opname/hapusmaterial/'.$isi->replid.'/'.$row->replid)."')) class='btn btn-xs btn-danger'>
										    			Hapus
										    		</a>";
										    echo "</td>";
										    }
										    echo "</tr>";
										}
									}
									?>
                                </tbody>
                                <tfoot>
                                </tfoot>
                            </table>
                  </td>
               </tr>
			</table>
			<table>
                <tr>
		            <td align="left">
		            	<?php
			                if (!isset($viewview)){
									        	$attributes = array('class' => 'form-horizontal form-validate', 'id' => 'form', 'method' => 'POST', 'novalidate'=>'novalidate','onsubmit'=>'return validate()');
									        	echo form_open($action,$attributes);
									        	if (!empty($material)){ ?>
									            	<button class='btn btn-primary'>Simpan</button>
									            <?php
									            } else {
										            echo "<font color=red>Tambahkan Material Terlebih Dahulu</font>&nbsp;&nbsp;";
									            }
	                      }else{
								    				echo "
															    		<a href=javascript:void(window.open('".site_url('inventory_opname/ubah/'.$isi->replid)."')) class='btn btn-warning'>Ubah</a>&nbsp;&nbsp;
															    		<a href=javascript:void(window.open('".site_url('inventory_opname/hapus/'.$isi->replid)."')) class='btn btn-danger' id='btnOpenDialog'>Hapus</a>";

	                        }
	                    ?>
		                <a href="javascript:void(window.open('<?php echo site_url('inventory_opname/') ?>'))" class="btn btn-success">Kembali</a>
		                <?php echo form_close(); ?>
		            </td>
			    </tr>
            </table>
		</section><!-- /.content -->
<!------------------------------------------------------------------------------------------------------------------------------------->
<?php } elseif($view=='tambahmaterial'){ ?>
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
			            	<script type='text/javascript'>
						        var site = "<?php echo site_url();?>";
						        $(function(){
						        	$('.autocomplete').keyup(function(e) {
						        		$('#idmaterial').val('0');
						        	});
						            $('.autocomplete').autocomplete({
						                // serviceUrl berisi URL ke controller/fungsi yang menangani request kita
						                serviceUrl: site+'/autocomplete/search/inventory_material/inventaris/0',
						                // fungsi ini akan dijalankan ketika user memilih salah satu hasil request
						                onSelect: function (suggestion) {
						                    $('#idmaterial').val(''+suggestion.replid); // membuat id 'v_nim' untuk ditampilkan
						                }
						            });
						        });
						        function validate() {
									var idmaterial=parseInt(document.getElementById("idmaterial").value);
									if (idmaterial==0){
										alert ("Pilih Material Terlebih Dahulu");
										return false;
									}
								}
						    </script>
			        		<label class="control-label" for="minlengthfield">Material</label>
			        		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		//$arrmat='data-rule-required=true';
			                		//echo form_dropdown('idmaterial',$mat_opt,$isi->idmaterial,$arrmat);

			                	?>
			                	<input type="search" class='autocomplete' id="autocomplete1" name="nama_material" data-rule-required=true data-rule-maxlength=200 data-rule-minlength=2 placeholder="Masukkan 2-200 Karakter" value="<?php echo $isi->materialtext ?>"/>
			                	<input type="hidden" name="idmaterial" id="idmaterial" data-rule-required=true data-rule-minlength=2 value="<?php echo $isi->idmaterial ?>" >
								</div>
			        		</div>
			            </th></tr>
				        <tr>
				            <th align="left">
		                		<label class="control-label" for="minlengthfield">Jumlah Stok</label>
		                		<div class="control-group">
									<div class="controls">:
				                	<?php
				                		echo form_input(array('id' => 'jumlahreal','name'=>'jumlahreal','value'=>$isi->jumlahreal,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'8', 'data-rule-minlength'=>'1','data-rule-number'=>'true','placeholder'=>'Masukkan 1-8 Karakter'));
				                	?>
				                	<?php //echo  <p id="message"></p> ?>
									</div>
		                		</div>
				        </th></tr>
				        <tr>
			            <th align="left">
			        		<label class="control-label" for="minlengthfield">Unit</label>
			        		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		$arrunit='data-rule-required=true';
			                		echo form_dropdown('idunit',$unit_opt,$isi->idunit,$arrunit);
			                	?>
								</div>
			        		</div>
			            </th></tr>

				        <tr>
				            <th align="left">
				            	<button class='btn btn-primary' onclick="return validate()">Simpan</button>
				            	<a href="javascript:void(window.open('<?php echo site_url('inventory_opname/material/'.$idx) ?>'))" class="btn btn-success">Batal</a>
				            </th>
				    </tr>
	            </table>
	        	<?php
	        	echo form_close();
	        	?>
	    </section>
<!------------------------------------------------------------------------------------------------------------------------------------->

<?php } ?>
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
    </body>
</html>
