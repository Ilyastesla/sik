<!DOCTYPE html>
<html>
<script language="javascript">
function cetakterima(id) {
	newWindow('../inventory_pembelian_print/'+id, 'cetakinventory_pembelian','900','800','resizable=1,scrollbars=1,status=0,toolbar=0')
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
                        <li><a href="javascript:void(window.open('<?php echo site_url('inventory_pembelian/tambah'); ?>'))" ><i class="fa fa-plus-square"></i> Tambah</a></li>

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
            </tr>
	                    <tr>
                        <th align="left">
                            <label class="control-label" for="minlengthfield">Status</label>
                            <div class="control-group">
                      <div class="controls">:
                              <?php
                                $arridstatus='data-rule-required=false';
                                echo form_dropdown('idstatus',$idstatus_opt,$this->input->post('idstatus'),$arridstatus);
                              ?>
                              <?php //echo  <p id="message"></p> ?>
                      </div>
                            </div>
                        </th>
                        <th align="left">
                            <label class="control-label" for="minlengthfield">Periode</label>
                            <div class="control-group">
                      <div class="controls">:
                              <?php
                              echo form_input(array('class' => '', 'id' => 'dp1','name'=>'periode1','value'=>$this->input->post('periode1'),'data-rule-required'=>'false' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'2' ,'placeholder'=>'DD-MM-YYYY','autocomplete'=>'off'));
                              echo form_input(array('class' => '', 'id' => 'dp2','name'=>'periode2','value'=>$this->input->post('periode2'),'data-rule-required'=>'false' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'2' ,'placeholder'=>'DD-MM-YYYY','autocomplete'=>'off'));
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
                                                <th>No. Pembelian</th>
																								<th>No. PPKB</th>
                                                <th>Perusahaan</th>
																								<th>Vendor</th>
                                                <th>Tgl. Pembelian</th>
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
												  echo "<a href=javascript:void(window.open('".site_url('inventory_pembelian/view/'.$row->replid)."')) >".$row->kode_transaksi."</a>";
													echo "</td>";
													echo "<td align=''>".$row->kode_ppkb."</td>";
													echo "<td align=''>".strtoupper($row->company)."</td>";
													echo "<td align='center'><a href=javascript:void(window.open('".site_url('inventory_vendor/view/'.$row->idvendor)."'))  >".strtoupper($row->vendortext)."</a></td>";
											    echo "<td align='center'>".strtoupper($CI->p_c->tgl_indo($row->tanggalpembelian))."</td>";
													echo "<td align='center'>".$row->keterangan."</td>";
											    echo "<td align='center'><b>".strtoupper($row->statustext)."</b></td>";
											    if(ISSET($history)){
												    echo "<td align='center'>".strtoupper($row->approvertext)."</td>";
											    }
											    echo "<td align='center'>";

											    if ($row->status<=2){
															if ($row->jmlserah<1){
																echo "<a href=javascript:void(window.open('".site_url('inventory_pembelian/ubah/'.$row->replid)."')) class='btn btn-xs btn-warning fa fa-check-square' ></a>&nbsp;";
															}
															if ($row->jmlmat<1){
																echo "<a href=javascript:void(window.open('".site_url('inventory_pembelian/hapus/'.$row->replid)."')) class='btn btn-xs btn-danger fa fa-minus-square' ></a>";
															}
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

    $("#idcompany").change(function(){
      var value=$(this).val();
        $.ajax({
          data:{modul:'idpermintaan_barang',id:value,idpermintaan_barang:<?=$isi->idpermintaan_barang?>},
          success: function(respond){
            $("#idpermintaan_barang").html(respond);
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
		        		<label class="control-label" for="minlengthfield">No. Pembelian</label>
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
		                		$arrcompany='data-rule-required="true" id="idcompany" ';
		                		echo form_dropdown('idcompany',$company_opt,$isi->idcompany,$arrcompany);
		                	?>
							</div>
		        		</div>
		            </th></tr>
								<tr>
		            <th align="left">
		        		<label class="control-label" for="minlengthfield">No. Permintaan</label>
		        		<div class="control-group">
							<div class="controls">:
		                	<?php
		                		$arridpermintaan_barang='data-rule-required="false" id="idpermintaan_barang" ';
		                		echo form_dropdown('idpermintaan_barang',$idpermintaan_barang_opt,$isi->idpermintaan_barang,$arridpermintaan_barang);
		                	?>
		                	<?php //echo  <p id="message"></p> ?>
							</div>
		        		</div>
		            </th></tr>
		            
		            <tr>
		            <th align="left">
		        		<label class="control-label" for="minlengthfield">vendor</label>
		        		<div class="control-group">
							<div class="controls">:
		                	<?php
		                		$arrvendor='data-rule-required=true';
		                		echo form_dropdown('idvendor',$idvendor_opt,$isi->idvendor,$arrvendor);
		                	?>
		                	<?php //echo  <p id="message"></p> ?>
							</div>
		        		</div>
		            </th></tr>
		            <tr>
			            <th align="left">
	                		<label class="control-label" for="minlengthfield">Tgl. Pembelian</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		echo form_input(array('class' => '', 'id' => 'dp1','name'=>'tanggalpembelian','value'=>$CI->p_c->tgl_form($isi->tanggalpembelian),'data-rule-required'=>'false' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'2' ,'placeholder'=>'DD-MM-YYYY','autocomplete'=>'off'));
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
				            	<a href="javascript:window.close()" class="btn btn-success">Kembali</a>
				            </th>
				    </tr>
		            </table>
		        	<?php
		        	echo form_close();
		        	?>
	    </section>
<!------------------------------------------------------------------------------------------------------------------------------------>
<?php } elseif($view=='material'){ ?>
	<script language="javascript">
	function cetakprint() {
		newWindow('<?php echo site_url("inventory_pembelian/inventory_pembelian_print/".$isi->replid."/0")?>', 'inventory_pembelian','900','800','resizable=1,scrollbars=1,status=0,toolbar=0')
	}
	</script>
		<section class="content-header table-responsive">
	            <h1>
	                <?php echo $form ?>
	                <small><?php echo $form_small ?></small>
	            </h1>
							<ol class="breadcrumb">
									<li><a href="javascript:void(window.open('<?php echo site_url('inventory_pembelian/tambah'); ?>'))" ><i class="fa fa-plus-square"></i> Tambah</a></li>
									<li><a href="JavaScript:cetakprint()"><i class="fa fa-file-text"></i>&nbsp;Cetak</a></li>
							</ol>
            </section>
            <section class="content">
		    	<table width="100%" border="0" class='form-horizontal form-validate'>
		    		<tr>
		            <th align="left">
		        		<label class="control-label" for="minlengthfield">No. Pembelian</label>
		        		<div class="control-group">
							<div class="controls">:
		                	<?php echo strtoupper($isi->kode_transaksi);?>
							</div>
		        		</div>
		            </th></tr>
								<?php if($isi->kode_permintaan<>""){?>
								<tr>
				            <th align="left">
				        		<label class="control-label" for="minlengthfield">No. Permintaan</label>
				        		<div class="control-group">
									<div class="controls">:
				                	<?php echo strtoupper($isi->kode_permintaan);?>
									</div>
				        		</div>
				            </th></tr>
								<?php } ?>
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
		        		<label class="control-label" for="minlengthfield">Vendor</label>
		        		<div class="control-group">
							<div class="controls">:
							<?php echo "<a href=javascript:void(window.open('".site_url('inventory_vendor/view/'.$isi->idvendor)."')) >".strtoupper($isi->vendortext)."</a>";?>
		                	<?php //echo  <p id="message"></p> ?>
							</div>
		        		</div>
		            </th></tr>

		            <tr>
			            <th align="left">
	                		<label class="control-label" for="minlengthfield">Tgl. Pembelian</label>
	                		<div class="control-group">
								<div class="controls">:
								<?php echo $CI->p_c->tgl_indo($isi->tanggalpembelian);?>
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
						<?php if($isi->kode_permintaan<>""){?>
				     <tr>
				     	<td align="left">
								<hr><h4>Material Yang Diminta:</h4>
				     		<table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                    	<th width='50'>No.</th>
																				<th>Peruntukan</th>
                                        <th>Material</th>
                                        <th>Jumlah</th>
                                        <th>Unit</th>
																				<th>Harga Perkiraan<br>(+pajak)</th>
																				<th>Harga Total</th>
																				<th>Vendor</th>

																				<th>Keterangan</th>
																				<th>Total Serah</th>
                                        <th>Sisa Serah</th>
                                    </tr>
                                </thead>
                                <tbody>
                                	<?php
                                	$jml_c=0;$no=1;$stock=0;
                                	if (!empty($materialpermintaan)){
										foreach($materialpermintaan as $row) {
											if ($row->stock<>""){
			                                	$stock=$row->stock;
		                                	}
											$sisaserah=0;$total_serah=0;
												$bg="green";
                      	$sisaserah=$row->jumlah-$row->total_serah;
                      	if ($row->total_serah<>""){
                      		$total_serah=$row->total_serah;
                      	}
                      	if ($sisaserah>0){
                        	$bg="red";
                      	}
										    echo "<tr>";
										    echo "<td align='center'>".$no++."</td>";
												echo "<td align='center'>".$row->peruntukantext."</td>";
										    //echo "<td align=''><a href=javascript:void(window.open('".site_url('inventory/viewmaterial/'.$row->idmaterial)."')) >".$row->materialtext."</a><br /><b>Stok: ".$stock."</b></td>";
												echo "<td align=''>".$row->materialtext."<br /><b>Stok: ".$stock."</b></td>";
										    echo "<td align='center'>".$row->jumlah."</td>";
										    echo "<td align='center'>".$row->idunit."</td>";
												echo "<td align='center'>".$CI->p_c->rupiah($row->harga)."</td>";
												echo "<td align='center'>".$CI->p_c->rupiah($row->hargatotal)."</td>";
												//echo "<td align='center'><a href=javascript:void(window.open('".site_url('inventory_vendor/view/'.$row->idvendor)."'))  >".strtoupper($row->vendor)."</a></td>";
												echo "<td align='center'>".strtoupper($row->vendor)."</td>";
												echo "<td align='center'>".$row->peruntukan."</td>";
												echo "<td align='center'>".$total_serah."</td>";
										    echo "<td align='center' ".$bg.">";
												echo $CI->p_c->bgcolortext($sisaserah,$bg);
												if ($sisaserah>0){
													echo "&nbsp;&nbsp;<a href=javascript:void(window.open('".site_url('inventory_pembelian/tambahmaterialpermintaan/'.$id.'/'.$row->idmaterial)."')) ><i class='fa fa-plus-square'></i></a>";
												}
												echo "</td>";
												echo "</tr>";
										}
									}
									?>
                                </tbody>
                                <tfoot>
                                </tfoot>
                            </table>
							<?php } ?>
							<hr><h4>Material:</h4>
			     		<?php
							if(!$viewview){
									if($isi->kode_permintaan==""){?>
			     		<section class="content-header table-responsive">
                  <ol class="breadcrumb">
                      <li><a href="javascript:void(window.open('<?php echo site_url('inventory_pembelian/tambahmaterial/'.$id); ?>'))" ><i class="fa fa-plus-square"></i> Tambah</a></li>
                  </ol>
              </section>
						-
              <?php
							}
						}
						?>

			                <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                    	<th width='50'>No.</th>
                                        <th>Material</th>
                                        <th>Jumlah</th>
                                        <th>Unit</th>
																				<th>Harga<br>(+pajak)</th>
																				<th>Harga Tambahan</th>
																				<th>Harga Total</th>
																				<th>keterangan</th>
																				<?php if(!$viewview){?>
                                        <th width="80">Aksi</th>
                                        <?php } ?>
                                    </tr>
                                </thead>
                                <tbody>
                                	<?php
                                	$jml_c=0;$no=1;$stock=0;
                                	if (!empty($material)){
										foreach($material as $row) {
												//<br /><b>Stok: ".$stock."</b>
										    echo "<tr>";
										    echo "<td align='center'>".$no++."</td>";
										    echo "<td align=''><a href=javascript:void(window.open('".site_url('inventory_material/view/'.$row->idmaterial)."')) >".$row->materialtext."</a></td>";
										    echo "<td align='center'>".$row->jumlah."</td>";
										    echo "<td align='center'>".$row->unittext."</td>";
												echo "<td align='center'>".$CI->p_c->rupiah($row->harga)."</td>";
												echo "<td align='center'>".$CI->p_c->rupiah($row->hargatambahan)."</td>";
												echo "<td align='center'>".$CI->p_c->rupiah(($row->hargatotal))."</td>";
												echo "<td align='center'>".$row->keterangan."</td>";
												if(!$viewview){
										    echo "<td align='center'>";
										    echo "<a href=javascript:void(window.open('".site_url('inventory_pembelian/tambahmaterial/'.$isi->replid.'/'.$row->replid)."')) class='btn btn-xs btn-warning  fa fa-check-square' ></a>&nbsp;&nbsp;";
												echo "<a href=javascript:void(window.open('".site_url('inventory_pembelian/hapusmaterial/'.$isi->replid.'/'.$row->replid.'/'.$row->idmaterial.'/'.$row->jumlah.'/'.$row->idunit)."')) class='btn btn-xs btn-danger  fa fa-minus-square'></a>";
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
			                if (!$viewview){
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
															if ($isi->jmlserah<1){
								    						echo "<a href=javascript:void(window.open('".site_url('inventory_pembelian/ubah/'.$isi->replid)."')) class='btn btn-warning'>Ubah</a>&nbsp;&nbsp;";
															}
															if($isi->jmlmat<1){
																	echo "<a href=javascript:void(window.open('".site_url('inventory_pembelian/hapus/'.$isi->replid)."')) class='btn btn-danger' id='btnOpenDialog'>Hapus</a>";
															}

								  					}

	                        }
	                    ?>
		                <a href="javascript:window.close()" class="btn btn-success">Kembali</a>
		                <?php echo form_close(); ?>
		            </td>
			    </tr>
            </table>
		</section><!-- /.content -->
<!------------------------------------------------------------------------------------------------------------------------------------->
<?php } elseif($view=='tambahmaterial'){ ?>
	<script language="javascript">
		function hitungharga()
		{
			var jumlah = Number(document.getElementById("jumlah").value);
			var harga = Number(document.getElementById("harga").value);
			var hargatambahan = Number(document.getElementById("hargatambahan").value);
			var hargatotal = Number(document.getElementById("hargatotal").value);

			document.getElementById("hargatotal").value = (jumlah*harga)+hargatambahan;
		}

		function hitungharga2()
		{
			var jumlah = Number(document.getElementById("jumlah").value);
			var harga = Number(document.getElementById("harga").value);
			var hargatambahan = Number(document.getElementById("hargatambahan").value);
			var hargatotal = Number(document.getElementById("hargatotal").value);

			document.getElementById("harga").value = (hargatotal-hargatambahan)/jumlah;
		}
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
			                	<input type="search" class='autocomplete' id="autocomplete1" name="nama_material" data-rule-required=true data-rule-maxlength=200 data-rule-minlength=2 placeholder="Masukkan 2-200 Karakter" value='<?php echo $isi->materialtext ?>'/>
			                	<input type="hidden" name="idmaterial" id="idmaterial" data-rule-required=true data-rule-minlength=2 value="<?php echo $isi->idmaterial ?>" >
												<!--inventory/ubahmaterial-->
			                	 &nbsp;&nbsp; <a href="javascript:void(window.open('<?php echo site_url('inventory_pembelian/tambahmaterialnew/'.$idx.'/'); ?>'))" ><i class="fa fa-plus-square"></i> Tambah</a>
								</div>
			        		</div>
			            </th></tr>
				        <tr>
				            <th align="left">
		                		<label class="control-label" for="minlengthfield">Jumlah</label>
		                		<div class="control-group">
									<div class="controls">:
													<input type="hidden" name="jumlah_old" value="<?php echo $isi->jumlah ?>">
				                	<?php
				                		echo form_input(array('id' => 'jumlah','name'=>'jumlah','value'=>$isi->jumlah,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'8', 'data-rule-minlength'=>'1','data-rule-number'=>'true','placeholder'=>'Masukkan 1-8 Karakter','onchange'=>'hitungharga();'));
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
		                      <label class="control-label" for="minlengthfield">Harga</label>
		                      <div class="control-group">
		                    <div class="controls">:
		                            <?php
		                              echo form_input(array('id' => 'harga','name'=>'harga','value'=>$isi->harga,'data-rule-required'=>'false' ,'data-rule-maxlength'=>'15', 'data-rule-minlength'=>'1','data-rule-number'=>'true','placeholder'=>'Masukkan 1-15 Karakter','onchange'=>'hitungharga();'));
		                            ?>
																* Harga sudah termasuk pajak
		                            <?php //echo  <p id="message"></p> ?>
		                    </div>
		                      </div>
		              </th>
		          </tr>
							<tr>
								<th align="left">
												<label class="control-label" for="minlengthfield">Harga Tambahan</label>
												<div class="control-group">
											<div class="controls">:
															<?php
																echo form_input(array('id' => 'hargatambahan','name'=>'hargatambahan','value'=>$isi->hargatambahan,'data-rule-required'=>'false' ,'data-rule-maxlength'=>'15', 'data-rule-minlength'=>'1','data-rule-number'=>'true','placeholder'=>'Masukkan 1-15 Karakter','onchange'=>'hitungharga();'));
															?>
															<?php //echo  <p id="message"></p> ?>
											</div>
												</div>
								</th>
						</tr>
							<tr>
	              <th align="left">
	                      <label class="control-label" for="minlengthfield">Harga Total</label>
	                      <div class="control-group">
	                    <div class="controls">:
	                            <?php
	                              echo form_input(array('id' => 'hargatotal','name'=>'hargatotal','value'=>$isi->hargatotal,'data-rule-required'=>'false' ,'data-rule-maxlength'=>'15', 'data-rule-minlength'=>'1','data-rule-number'=>'true','placeholder'=>'Masukkan 1-15 Karakter','onchange'=>'hitungharga2();'));
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
				            	<a href="closetab();" class="btn btn-success">Kembali</a>
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
