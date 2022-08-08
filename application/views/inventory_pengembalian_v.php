<!DOCTYPE html>
<html>
<script language="javascript">

function validate() {
	var jumlah=parseInt(document.getElementById("jumlah").value);
	var limitkk=parseInt(document.getElementById("limitkk").value);
	if (jumlah>=limitkk){
		alert ("Nilai tidak boleh lebih dari Rp."+limitkk);
		return false;
	}
}
function cetakterima(id) {
	newWindow('../printinventory_pengembalian/'+id, 'cetakinventory_pengembalian','900','800','resizable=1,scrollbars=1,status=0,toolbar=0')
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
                        <li><a href="javascript:void(window.open('<?php echo site_url('inventory_pengembalian/tambah'); ?>'))" ><i class="fa fa-plus-square"></i> Tambah</a></li>

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
                                                <th width="80">Aksi</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                        	<?php
                                        	$CI =& get_instance();
											foreach((array)$show_table as $row) {
											    echo "<tr>";
											    echo "<td align='center'>";
												echo "<a href=javascript:void(window.open('".site_url('inventory_pengembalian/view/'.$row->replid)."'))>".$row->kode_transaksi."</a>";
											    echo "</td>";
											    echo "<td align=''>".strtoupper($row->company)."</td>";
											    echo "<td align='center'>".strtoupper($row->pemohon)."</td>";
											    echo "<td align='center'>".strtoupper($row->departemen)."</td>";
											    echo "<td align='center'>".strtoupper($CI->p_c->tgl_indo($row->tanggalpengajuan))."</td>";
											    echo "<td align='center'>".$row->keterangan."</td>";
											    echo "<td align='center'><b>".strtoupper($row->statustext)."</b></td>";
											    echo "<td align='center'>";
											    echo "
											    		<a href=javascript:void(window.open('".site_url('inventory_pengembalian/view/'.$row->replid.'/1')."'))>
											    			<button class='btn btn-xs btn-warning'>Penyerahan</button>
											    		</a>";
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
<!------------------------------------------------------------------------------------------------------------------------------------>
<?php } elseif($view=='material'){ ?>
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
			                <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                    	<th width='50'>No.</th>
                                        <th>Material</th>
                                        <th>Jumlah</th>
                                        <th>Total Serah</th>
                                        <th>Sisa Serah</th>
                                        <th>Unit</th>
                                        <!--
                                        <th width="50">Kelompok Inventaris</th>
                                        -->
                                        <?php if($edit){ ?>
                                        <th width="50">Penyerahan</th>
                                        <?php }?>

                                    </tr>
                                </thead>
                                <tbody>
                                	<?php
                                	$jml_c=0;$no=1;$stock=0;$nlx="";
                                	if (!empty($material)){
										foreach($material as $row) {
											$sisaserah=0;
											$bg=" style='background-color:green'";
											$total_serah=0;
											if ($row->stock<>""){
			                                	$stock=$row->stock;
		                                	}
		                                	$sisaserah=$row->jumlah-$row->total_serah;
		                                	if ($row->total_serah<>""){
		                                		$total_serah=$row->total_serah;
		                                	}
		                                	if ($sisaserah>0){
			                                	$bg=" style='background-color:red'";
		                                	}
		                                	if($nlx<>""){$nlx=$nlx.',';}
										    echo "<tr>";
										    echo "<td align='center'>".$no++."</td>";
										    echo "<td align=''>".$row->materialtext."<br /><b>Stok: ".$stock."</b></td>";
										    echo "<td align='center'>".$row->jumlah."</td>";
										    echo "<td align='center'>".$total_serah."</td>";
										    echo "<td align='center' ".$bg.">".$sisaserah."</td>";
										    echo "<td align='center'>".$row->idunit."</td>";
										    if($edit){
											    echo "<td>";
											    if (($stock>=$row->jumlah) and ($sisaserah>0)){
											    	echo "<a href=".site_url('inventory_pengembalian/penyerahan_material/'.$row->idpermintaan_barang."/".$row->idmaterial)." class='btn btn-xs btn-warning'>Penyerahan</a>";
											    }else if ($sisaserah<=0){
											    	echo "<font color='green'><b>Penyerahan Selesai</b></font>";
											    }else{
												    echo "<font color='red'><b>Stok Habis</b></font>";
											    }
											    echo "</td>";
										    }
										    echo "</tr>";
										    //------------------------------------------------------------------------------------
										    if ($total_serah>0){
											    echo "<tr>";
											    echo "<td align=''>&nbsp;</td>";

											    $noinventaris=$CI->inventory_pengembalian_db->noinventaris_db($row->idpermintaan_barang,$row->idmaterial);
											    echo "<td colspan='6'>";
											    ?>
											    <table class="table table-bordered table-striped">
				                                <thead>
				                                    <tr>
				                                    	<th width='50'>No.</th>
				                                    	<th>Tgl. Serah</th>
				                                         <?php if (!$row->atk) { ?>
				                                        <th>No. Inventaris</th>
				                                        <th>Kelompok Inventaris</th>
				                                        <?php } ?>
				                                        <th>Jumlah Serah</th>
				                                        <th>Unit</th>
				                                        <?php if($edit){ ?>
				                                        <th>Aksi</th>
				                                        <?php } ?>
				                                    </tr>
				                                </thead>
				                                <tbody>

											    <?php
											    $no2=1;
											    foreach((array)$noinventaris as $rownoinventaris) {
												    echo "<tr>";
												    echo "<td>".$no2++."</td>";
												    echo "<td align='center'>".strtoupper($CI->p_c->tgl_indo($rownoinventaris->tanggalserah))."</td>";
												    if (!$row->atk) {
												    	echo "<td>".$rownoinventaris->kode_inventaris."</td>";
												    	echo "<td>".$rownoinventaris->kelompok_inventaris."</td>";
												    }
												    echo "<td align='center'>".$rownoinventaris->jml_serah."</td>";
												    echo "<td align='center'>".$rownoinventaris->unit."</td>";
												    if($edit){
												    echo "<td><a href=javascript:void(window.open('".site_url('inventory_pengembalian/hapusinventaris/'.$rownoinventaris->idpermintaanbarang.'/'.$rownoinventaris->replid).'/'.$rownoinventaris->idmaterial.'/'.($rownoinventaris->jml_serah+$stock)."'))  class='btn btn-xs btn-danger fa fa-minus-square' ></a>";
												    }
											    }
											    echo "</table>";
											    echo "</td>";
											    echo "</tr>";

											}// $total_serah=0
										    $nlx=$nlx.$row->idmaterial;
										}
									}
									?>
                                </tbody>
                                <tfoot>
                                </tfoot>
                            </table>
                            <?php if ($edit){ ?>
                            <table>
	                            <tr>
							            <th align="left">
							            	<!--
							            	<input type="text" name="kodecabang" value="<?php echo $isi->kodecabang; ?>">kodecabang
							            	<input type="text" name="kodedepartemen" value="<?php echo $isi->kodedepartemen; ?>">kodedepartemen
							            	-->
							            	<input type="hidden" name="nlx" value="<?php echo $nlx; ?>">
							            	<!--
							            	<button class='btn btn-primary'>Simpan</button>
							            	-->
							            	<a href="javascript:void(window.open('<?php echo site_url('inventory_pengembalian') ?>'))" class="btn btn-primary">Ok</a>
							            </th>
							    </tr>
                            </table>
                    <?php echo form_close();
                        }else{
	                        if ($edit<>1){
							    echo "<a href=javascript:void(window.open('".site_url('inventory_pengembalian/view/'.$isi->replid.'/1')."')) class='btn btn-xs btn-warning fa fa-check-square' ></a>&nbsp;&nbsp;";
								echo "<a href=javascript:void(window.open('".site_url('inventory_pengembalian')."')) class='btn btn-success'>Kembali</a>";
							 }

                        }
                    ?>
		</section><!-- /.content -->
<!------------------------------------------------------------------------------------------------------------------------------------>
<?php } elseif($view=='penyerahan_material'){?>
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
		        		<label class="control-label" for="minlengthfield">Material</label>
		        		<div class="control-group">
							<div class="controls">:
							<?php echo strtoupper($isi->materialtext);?>
							</div>
		        		</div>
		            </th></tr>
		            <tr>
		            <th align="left">
		        		<label class="control-label" for="minlengthfield">Stok</label>
		        		<div class="control-group">
							<div class="controls">:
							<?php echo strtoupper($isi->stock);?>
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
	                		<label class="control-label" for="minlengthfield">Tgl. Penyerahan</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		echo form_input(array('class' => '', 'id' => 'dp1','name'=>'tanggalserah','value'=>$CI->p_c->tgl_form($isi->tanggalserah),'data-rule-required'=>'false' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'2' ,'placeholder'=>'DD-MM-YYYY','autocomplete'=>'off'));
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th>
			         </tr>
			         <?php if (!$isi->atk) { ?>
				     <tr>
			            <th align="left">
	                		<label class="control-label" for="minlengthfield">Kelompok Inventaris</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		$arridkelompok_inventaris='data-rule-required=true';
									echo form_dropdown('idkelompok_inventaris',$kelompok_inventaris_opt,$isi->idkelompok_inventaris,$arridkelompok_inventaris);			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th>
			         </tr>
			         <tr>
			            <th align="left">
	                		<label class="control-label" for="minlengthfield">Ruangan</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		$arridruang='data-rule-required=true';
									echo form_dropdown('idruang',$ruang_opt,$isi->idruang,$arridruang);			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th>
			         </tr>
			         <?php }else{ ?><input type="text" name="idkelompok_inventaris" value=""><?php } ?>
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
                </tbody>
                <tfoot>
                </tfoot>
            </table>
            <?php
            //if ($edit==1){
	        ?>
                <table>
                    <tr>
			            <th align="left">
			            	<input type="hidden" name="atk" value="<?php echo $isi->atk; ?>">
			            	<input type="hidden" name="kodecabang" value="<?php echo $isi->kodecabang; ?>">
			            	<input type="hidden" name="kodedepartemen" value="<?php echo $isi->kodedepartemen; ?>">
			            	<input type="hidden" name="kodefiskal" value="<?php echo $isi->kodefiskal; ?>">
			            	<input type="hidden" name="kodematerial" value="<?php echo $isi->kodematerial; ?>">
			            	<input type="hidden" name="stock" value="<?php echo $isi->stock; ?>">

			            	<button class='btn btn-primary'>Simpan</button>
			            	<a href="javascript:void(window.open('<?php echo site_url('inventory_pengembalian/view/'.$id.'/1') ?>'))" class="btn btn-success">Batal</a>
			            </th>
				    </tr>
		            </table>
                </table>
            <?php //}
            ?>
		</section><!-- /.content -->

<?php } ?>
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
    </body>
</html>
