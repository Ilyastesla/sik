<!DOCTYPE html>
<html>
<script language="javascript">
function cetakterima(id) {
	newWindow('../printinventory_peminjaman/'+id, 'cetakinventory_peminjaman','900','800','resizable=1,scrollbars=1,status=0,toolbar=0')
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
                        <li><a href="javascript:void(window.open('<?php echo site_url('inventory_peminjaman/tambah'); ?>'))" ><i class="fa fa-plus-square"></i> Tambah</a></li>

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
                                                <th>Pemohon</th>
                                                <th>Departemen</th>
                                                <th>Tgl. Pengajuan</th>
                                                <th>Keterangan</th>
                                                <th>Status</th>
                                                <?php if(ISSET($history)){ ?>
                                                <th width="*">Persetujuan Selanjutnya</th>
                                                <?php } ?>
                                                <th width="80">Aksi</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                        	<?php
                                        	$CI =& get_instance();
											foreach((array)$show_table as $row) {
											    echo "<tr>";
											    echo "<td align='center'>";
											    if ($row->app==0){
												    echo "<a href=javascript:void(window.open('".site_url('inventory_peminjaman/view/'.$row->replid)."'))>".$row->kode_transaksi."</a>";
											    }else{
												    echo $row->kode_transaksi;
											    }

											    echo "</td>";
											    echo "<td align=''>".strtoupper($row->company)."</td>";
											    echo "<td align='center'>".strtoupper($row->pemohon)."</td>";
											    echo "<td align='center'>".strtoupper($row->departemen)."</td>";
											    echo "<td align='center'>".strtoupper($CI->p_c->tgl_indo($row->tanggalpengajuan))."</td>";
											    echo "<td align='center'>".$row->keterangan."</td>";
											    echo "<td align='center'><b>".strtoupper($row->statustext)."</b></td>";
											    if(ISSET($history)){
												    echo "<td align='center'>".strtoupper($row->approvertext)."</td>";
											    }

											    echo "<td align='center'>";

											    if (($row->status<=2) and ($row->app<>100)){
											    echo "
											    		<a href=javascript:void(window.open('".site_url('inventory_peminjaman/ubah/'.$row->replid)."')) class='btn btn-warning'>Ubah
											    		</a>
											    		<a href=javascript:void(window.open('".site_url('inventory_peminjaman/hapus/'.$row->replid)."')) class='btn btn-xs btn-danger'>Hapus
											    		</a>";
											    }
											    if ($row->app==1){
											    	echo "
											    		<a href=javascript:void(window.open('".site_url('inventory_peminjaman/approve_v/'.$row->replid)."'))>
											    			<button class='btn btn-xs btn-warning'>Persetujuan</button>
											    		</a>";
											    }
											    if ($row->app==4){
											    	echo "
											    		<a href=javascript:void(window.open('".site_url('inventory_peminjaman/revisi_v/'.$row->replid)."'))>
											    			<button class='btn btn-xs btn-warning'>Revisi</button>
											    		</a>";
											    }
											    if ($row->app==100){
											    	echo "
											    		<a href=javascript:void(window.open('".site_url('inventory_peminjaman/history_v/'.$row->replid)."'))>
											    			<button class='btn btn-primary'>Lihat</button>
											    		</a>";
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
		            <!--
		            <tr>
		            <th align="left">
		        		<label class="control-label" for="minlengthfield">Pemohon</label>
		        		<div class="control-group">
							<div class="controls">:
		                	<?php
		                		$arrpemohon='data-rule-required=true';
		                		echo form_dropdown('pemohon',$pemohon_opt,$isi->pemohon,$arrpemohon);
		                	?>
							</div>
		        		</div>
		            </th></tr>
		            -->
		            <tr>
		            <th align="left">
		        		<label class="control-label" for="minlengthfield">Departemen</label>
		        		<div class="control-group">
							<div class="controls">:
		                	<?php
		                		$arrdepartemen='data-rule-required=true';
		                		echo form_dropdown('iddepartemen',$departemen_opt,$isi->iddepartemen,$arrdepartemen);
		                	?>
		                	<?php //echo  <p id="message"></p> ?>
							</div>
		        		</div>
		            </th></tr>
		            <tr>
			            <th align="left">
	                		<label class="control-label" for="minlengthfield">Tgl. Pengajuan</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		echo form_input(array('class' => '', 'id' => 'dp1','name'=>'tanggalpengajuan','value'=>$CI->p_c->tgl_form($isi->tanggalpengajuan),'data-rule-required'=>'false' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'2' ,'placeholder'=>'DD-MM-YYYY','autocomplete'=>'off'));
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
				            	<a href="javascript:void(window.open('<?php echo site_url('inventory_peminjaman') ?>'))" class="btn btn-success">Kembali</a>
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
		        		<label class="control-label" for="minlengthfield">Pemohon</label>
		        		<div class="control-group">
							<div class="controls">:
							<?php echo strtoupper($isi->pemohontext);?>
							</div>
		        		</div>
		            </th></tr>
		            <tr>
		            <th align="left">
		        		<label class="control-label" for="minlengthfield">Departemen</label>
		        		<div class="control-group">
							<div class="controls">:
							<?php echo strtoupper($isi->departemen);?>
		                	<?php //echo  <p id="message"></p> ?>
							</div>
		        		</div>
		            </th></tr>
		            <tr>
			            <th align="left">
	                		<label class="control-label" for="minlengthfield">Tgl. Pengajuan</label>
	                		<div class="control-group">
								<div class="controls">:
								<?php echo $CI->p_c->tgl_indo($isi->tanggalpengajuan);?>
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
				     <tr>
				            <th align="left">
		                		<label class="control-label" for="minlengthfield">Status</label>
		                		<div class="control-group">
									<div class="controls" valign="top">:
				                	<?php echo strtoupper($isi->statustext);?>
				                	<?php //echo  <p id="message"></p> ?>
									</div>
		                		</div>
				            </th></tr>
				     <tr>
				     <tr>
				     	<td align="left">
				     		<hr><h4>Material :</h4>
				     		<?php if(!isset($viewview)){?>
				     		<section class="content-header table-responsive">
			                    <ol class="breadcrumb">
			                        <li><a href="javascript:void(window.open('<?php echo site_url('inventory_peminjaman/tambahmaterial/'.$id); ?>'))" ><i class="fa fa-plus-square"></i> Tambah</a></li>
			                    </ol>
			                </section>
			                <?php } ?>
			                <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                    	<th width='50'>No.</th>
                                        <th>Material</th>
                                        <th>Jumlah</th>
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
										    echo "<td align=''>".$row->idmaterial."<br /><b>Stok: ".$stock."</b></td>";
										    echo "<td align='center'>".$row->jumlah."</td>";
										    echo "<td align='center'>".$row->idunit."</td>";
										    if(!isset($viewview)){
										    echo "<td align='center'>";
										    echo "
										    		<a href=javascript:void(window.open('".site_url('inventory_peminjaman/tambahmaterial/'.$isi->replid.'/'.$row->replid)."')) class='btn btn-xs btn-warning'>
										    			Ubah
										    		</a>
										    		<a href=javascript:void(window.open('".site_url('inventory_peminjaman/hapusmaterial/'.$isi->replid.'/'.$row->replid)."')) class='btn btn-xs btn-danger'>
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
		                        if ($isi->status<=2){
								    echo "<a href=javascript:void(window.open('".site_url('inventory_peminjaman/ubah/'.$isi->replid)."')) class='btn btn-warning'>Ubah</a>&nbsp;&nbsp;";
										echo "<a href=javascript:void(window.open('".site_url('inventory_peminjaman/hapus/'.$isi->replid)."')) class='btn btn-danger' id='btnOpenDialog'>Hapus</a>";
								  }

	                        }
	                    ?>
		                <a href="javascript:void(window.open('<?php echo site_url('inventory_peminjaman/') ?>'))" class="btn btn-success">Kembali</a>
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
						                serviceUrl: site+'/autocomplete/search/inventory_material',
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
			                	 &nbsp;&nbsp; <a href="javascript:void(window.open('<?php echo site_url('inventory/ubahmaterial/'); ?>'))"><i class="fa fa-plus-square"></i> Tambah</a>
								</div>
			        		</div>
			            </th></tr>
				        <tr>
				            <th align="left">
		                		<label class="control-label" for="minlengthfield">Jumlah</label>
		                		<div class="control-group">
									<div class="controls">:
				                	<?php
				                		echo form_input(array('id' => 'jumlah','name'=>'jumlah','value'=>$isi->jumlah,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'8', 'data-rule-minlength'=>'1','data-rule-number'=>'true','placeholder'=>'Masukkan 1-8 Karakter'));
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
				            	<a href="javascript:void(window.open('<?php echo site_url('inventory_peminjaman/material/'.$idx) ?>'))" class="btn btn-success">Batal</a>
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
