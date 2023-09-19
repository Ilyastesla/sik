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
	newWindow('../printinventory_penyerahan/'+id, 'cetakinventory_penyerahan','900','800','resizable=1,scrollbars=1,status=0,toolbar=0')
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
                    <ol class="breadcrumb">
                        <li><a href="javascript:void(window.open('<?php echo site_url('inventory_penyerahan/tambah'); ?>'))" ><i class="fa fa-plus-square"></i> Tambah</a></li>

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
                            <label class="control-label" for="minlengthfield">Pemohon</label>
                            <div class="control-group">
                      <div class="controls">:
                              <?php
                                $arrpemohon='data-rule-required=false';
                                echo form_dropdown('pemohon',$pemohon_opt,$this->input->post('pemohon'),$arrpemohon);
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
												<th>No.</th>
                                                <th>No. Permintaan</th>
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
                                        	$CI =& get_instance();$no=1;
											foreach((array)$show_table as $row) {
											    echo "<tr>";
												echo "<td align=''>".$no++."</td>";
											    echo "<td align='center'>";
												echo "<a href=javascript:void(window.open('".site_url('inventory_penyerahan/view/'.$row->replid.'/0')."')) >".$row->kode_transaksi."</a>";
											    echo "</td>";
											    echo "<td align=''>".strtoupper($row->company)."</td>";
											    echo "<td align='center'>".strtoupper($row->pemohon)."</td>";
											    echo "<td align='center'>".strtoupper($row->departemen)."</td>";
											    echo "<td align='center'>".strtoupper($CI->p_c->tgl_indo($row->tanggalpengajuan))."</td>";
											    echo "<td align='center'>".$row->keterangan."</td>";
											    echo "<td align='center'><b>".strtoupper($row->statustext)."</b></td>";
											    echo "<td align='center'>";
													if ($row->status<>"4"){
												    echo "
												    		<a href=javascript:void(window.open('".site_url('inventory_penyerahan/view/'.$row->replid.'/1')."'))>
												    			<button class='btn btn-xs btn-warning'>Penyerahan</button>
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
<!------------------------------------------------------------------------------------------------------------------------------------>
<?php } elseif($view=='material'){ ?>
	<script language="javascript">
	function cetakprint() {
		newWindow('<?php echo site_url("inventory_penyerahan/inventory_penyerahan_print/".$isi->replid.'/'.$idpenyerahan); ?>', 'cetakrapot','900','800','resizable=1,scrollbars=1,status=0,toolbar=0')
	}
	function cetakprintstiker() {
		newWindow('<?php echo site_url("inventory_penyerahan/inventory_penyerahan_stiker_print/".$isi->replid.'/'.$idpenyerahan); ?>', 'cetakrapot','900','800','resizable=1,scrollbars=1,status=0,toolbar=0')
	}
	</script>
	<section class="content-header table-responsive">
	            <h1>
	                <?php echo $form ?>
	                <small><?php echo $form_small ?></small>
	            </h1>
							<ol class="breadcrumb">
								<?php if($idpenyerahan<>""){ ?>
								<li><a href="JavaScript:cetakprint()"><i class="fa fa-file-text"></i>&nbsp;Cetak</a></li>
								<!--<li><a href="JavaScript:cetakexcel()"><i class="fa fa-print"></i>&nbsp;Excel</a></li>-->
								<li><a href="JavaScript:cetakprintstiker()"><i class="fa fa-file-text"></i>&nbsp;Cetak Stiker</a></li>
							<?php } ?>
							</ol>
            </section>
            <section class="content">
            	<?php
	            	$attributes = array('class' => 'form-horizontal form-validate', 'id' => 'form', 'method' => 'POST', 'novalidate'=>'novalidate','onsubmit'=>'return validate()');
			        	echo form_open($action,$attributes);
            	?>
							<table width="100%" border="0" class='form-horizontal form-validate'>
				    		<tr>
				            <th align="left">
				        		<label class="control-label" for="minlengthfield">No. Permintaan</label>
				        		<div class="control-group">
									<div class="controls">:
				                	<?php
														echo "<a href=javascript:void(window.open('".site_url('permintaan_barang/view/'.$isi->idpermintaanbarang)."')) >".$isi->kode_transaksi."</a>";
														//echo strtoupper($isi->kode_transaksi);
													?>
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
				        		<label class="control-label" for="minlengthfield">Pemohon</label>
				        		<div class="control-group">
									<div class="controls">:
									<?php echo  $CI->dbx->getpegawai($isi->pemohon,0,0); ?>
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
									 <label class="control-label" for="minlengthfield">Prioritas</label>
									 <div class="control-group">
								 <div class="controls">:
								 <?php echo strtoupper($isi->prioritastext);?>
								 </div>
									 </div>
									 </th></tr>
									 <tr>
										 <th align="left">
												 <label class="control-label" for="minlengthfield">Tgl. Batas</label>
												 <div class="control-group">
									 <div class="controls">:
									 <?php
										 if ($isi->urgent==1){
											 	echo "<font style='background-color:red;'>&nbsp;";
										 }else{echo "<font>&nbsp;";}
										 echo $CI->p_c->tgl_indo($isi->dateline)."&nbsp;</font>";
									 ?>
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
						<?php if($idpenyerahan<>""){?>
							<tr>
								<td><hr/></td>
							</tr>
							<tr>
										<th align="left">
												<label class="control-label" for="minlengthfield">Kode Penyerahan</label>
												<div class="control-group">
									<div class="controls" valign="top">:
													<?php echo strtoupper($penyerahan_head->kode_transaksi);?>
													<?php //echo  <p id="message"></p> ?>
									</div>
												</div>
										</th></tr>
										<tr>
		 								 <th align="left">
		 										 <label class="control-label" for="minlengthfield">Tgl. Penyerahan</label>
		 										 <div class="control-group">
		 							 <div class="controls">:
		 							 <?php
		 								 echo $CI->p_c->tgl_indo($penyerahan_head->tanggalserah)."&nbsp;";
		 							 ?>
		 							 </div>
		 										 </div>
		 								 </th>
		 							</tr>
									 <tr>
										<th align="left">
											<label class="control-label" for="minlengthfield">Penerima</label>
											<div class="control-group">
												<div class="controls">:
												<?php echo $CI->dbx->getpegawai($penyerahan_head->idpjheadpenyerahan)?>
												</div>
											</div>
										</th></tr>
									 <tr>
										<th align="left">
											<label class="control-label" for="minlengthfield">Staff Gudang</label>
											<div class="control-group">
												<div class="controls">:
												<?php echo $CI->dbx->getpegawai($penyerahan_head->idstaffgudang)?>
												</div>
											</div>
										</th></tr>
										<tr>
										<th align="left">
											<label class="control-label" for="minlengthfield">Manajer Umum</label>
											<div class="control-group">
												<div class="controls">:
												<?php echo $CI->dbx->getpegawai($penyerahan_head->idmanajerumum)?>
												</div>
											</div>
										</th></tr>
						<?php } ?>
				     <tr>
				     	<td align="left">
											<?php if(($edit) and ($idpenyerahan=="") and ($isi->status<>4)){?>
				     					<section class="content-header table-responsive">
			                    <ol class="breadcrumb">
			                        <li><a href="javascript:void(window.open('<?php echo site_url('inventory_penyerahan/tambahpenyerahan/'.$id); ?>'))"><i class="fa fa-plus-square"></i> Tambah Penyerahan</a></li>
			                    </ol>
			                </section>
			                <?php } ?>
											<?php if($idpenyerahan==""){?>
												<hr><h4>Penyerahan Barang :</h4>
				                <table class="table table-bordered table-striped">
												<thead>
														<tr>
																<th width='50'>No.</th>
																<th>No. Transaksi</th>
																<th>Tgl. Transaksi</th>
																<th>Jumlah</th>
																<?php if($edit){?>
																	<th></th>
																<?php } ?>
														<tr>
												</thead>
												<tbody>
													<?php
													$nohs=1;
													foreach((array)$penyerahan_head as $rowheadserah) {
														echo "<tr>";
														echo "<td>".$nohs++."</td>";
														echo "<td><a href=javascript:void(window.open('".site_url('inventory_penyerahan/view/'.$rowheadserah->idpermintaan_barang."/0/".$rowheadserah->replid)."')) >".$rowheadserah->kode_transaksi."</td>";
														echo "<td>".$CI->p_c->tgl_indo($rowheadserah->tanggalserah)."</td>";
														echo "<td>".$rowheadserah->pakaiserah."</td>";
														if($edit){
															echo "<td align='center'>";
															echo "<a href=javascript:void(window.open('".site_url('inventory_penyerahan/tambahpenyerahan/'.$id."/".$rowheadserah->replid)."')) class='btn btn-xs btn-warning fa fa-check-square' ></a>&nbsp;";
															if($rowheadserah->pakaiserah<1){
																echo "<a href=javascript:void(window.open('".site_url('inventory_penyerahan/hapusserahhead/'.$id."/".$rowheadserah->replid)."')) class='btn btn-xs btn-danger fa fa-minus-square' ></a>";
															}
															echo "</td>";
														}
														echo "<tr>";
													}
													?>
													<tr>

													</tr>
												</tbody>
												</table>
											<?php } ?>
				     					<hr><h4>Material :</h4>
			                <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                    	<th width='50'>No.</th>
                                        <th>Material</th>
										<th>Kelompok Barang</th>
										<th>Kelompok Fiskal</th>
										<th>Inventaris</th>
                                        <th>Jumlah</th>
                                        <th>Total Serah</th>
										<?php 
											if ($idpenyerahan==""){ echo "<th>Sisa Serah</th>";}
										?>
                                        
                                        <th>Unit</th>

                                        <!--<th width="50">Kelompok Inventaris</th>-->
                                        <?php if(($edit) and ($idpenyerahan<>"")){ ?>
                                        <th width="50">Penyerahan</th>
                                        <?php }?>


                                    </tr>
                                </thead>
                                <tbody>
                                	<?php
                                	$jml_c=0;$no=1;$stock=0;$nlx="";
                                	if (!empty($material)){
										foreach($material as $row) {
												$sisaserah=0;$total_serah=0;
												$bg=" style='background-color:green'";
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
										    echo "<td align=''><a href=javascript:void(window.open('".site_url('inventory_material/view/'.$row->idmaterial)."')) >".$row->materialtext."</a><br /><b>Stok: ".$stock."</b></td>";
										    echo "<td align='center'>".$row->kelompokbarangtext."</td>";
											echo "<td align='center'>".$row->kodefiskaltext."</td>";
											echo "<td align='center'>".$CI->p_c->cekaktif($row->inventaris)."</td>";
											echo "<td align='center'>".$row->jumlah."</td>";
										    echo "<td align='center'>".$total_serah."</td>";
											if ($idpenyerahan==""){
										    	echo "<td align='center' ".$bg.">".$sisaserah."</td>";
											}
										    echo "<td align='center'>".$row->idunit."</td>";

										    if(($edit) and ($idpenyerahan<>"")){
											    echo "<td>";
												//echo $stock." xx ".$sisaserah;
											    //if (($stock>=$sisaserah) and ($sisaserah>0)){
												if (($stock>0) and ($sisaserah>0)){
													if ($row->inventaris){
														if ($row->idfiskal<>""){
															echo "<a href=".site_url('inventory_penyerahan/penyerahan_material/'.$row->replid.'/'.$idpenyerahan)." class='btn btn-warning'>Penyerahan</a>";
														}else{
															echo "<font color='red'><b>Silahkan isi terlebih dahulu kelompok fiskal pada kelompok barang<br/><br/><a href='".site_url('inventory_kelompok/ubah/'.$row->idkelompok)."' target='_blank'>Disini!</a></b></font>";
														}
													}else{
														echo "<a href=".site_url('inventory_penyerahan/penyerahan_material/'.$row->replid.'/'.$idpenyerahan)." class='btn btn-warning'>Penyerahan</a>";
													}
											    	
											    }else if ($sisaserah==0){
											    	echo "<font color='green'><b>Penyerahan Selesai</b></font>";
											    }else{
												    echo "<font color='red'><b>Stok Habis</b></font>";
											    }
											    echo "</td>";
										    }

										    echo "</tr>";
										    //------------------------------------------------------------------------------------
											if (($total_serah>0)){
											    echo "<tr>";
											    echo "<td align=''>&nbsp;</td>";

											    $noinventaris=$CI->inventory_penyerahan_db->noinventaris_db($row->idpermintaan_barang,$row->idmaterial,$row->replid,$idpenyerahan);
											    echo "<td colspan='9'>";
											    ?>
											    <table class="table table-bordered table-striped">
				                                <thead>
				                                    <tr>
				                                    	<th width='50'>No.</th>
														<th>Kode Penyerahan</th>
				                                    	<th>Tgl. Serah</th>
														<th>Sumber Dana</th>
				                                         <?php if ($row->inventaris) { ?>
				                                        <th>No. Inventaris</th>
				                                        <th>Kelompok Inventaris</th>
				                                        <th>Ruangan</th>
																								<th>No. Pembelian</th>
																								<th>HPP</th>
																							<?php }else{ ?>
																								<th>Jumlah Serah</th>
																								<th>Unit</th>
																							<?php
																								} ?>
				                                        <?php if(($edit) and ($idpenyerahan<>"")){ ?>
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
														echo "<td align='center'>".$rownoinventaris->kodepenyerahan."</td>";
														echo "<td align='center'>".strtoupper($CI->p_c->tgl_indo($rownoinventaris->tanggalserah))."</td>";
														echo "<td align='center'>".$rownoinventaris->sumberdanatext."</td>";
												    if ($row->inventaris) {
												    	echo "<td><a href=javascript:void(window.open('".site_url('inventory_penyerahan/material_stiker_print/'.$rownoinventaris->replid)."')) >".$rownoinventaris->kode_inventaris."</a></td>";
												    	echo "<td>".$rownoinventaris->kelompok_inventaris."</td>";
												    	echo "<td>".$rownoinventaris->ruangan."</td>";
															echo "<td><a href=javascript:void(window.open('".site_url('inventory_pembelian/view/'.$rownoinventaris->idinventory_pembelian)."')) >".$rownoinventaris->kode_pembelian."</a></td>";
															echo "<td>".$CI->p_c->rupiah($rownoinventaris->hpp)."</td>";
												    }else{
															echo "<td align='center'>".$rownoinventaris->jml_serah."</td>";
															echo "<td align='center'>".$rownoinventaris->unit."</td>";
														}
												    if(($edit) and ($idpenyerahan<>"")){
												    echo "<td><a href=javascript:void(window.open('".site_url('inventory_penyerahan/hapusinventaris/'.$rownoinventaris->idpermintaanbarang.'/'.$rownoinventaris->idinventory_penyerahan.'/'.$rownoinventaris->replid.'/'.$rownoinventaris->idmaterial.'/'.($rownoinventaris->jml_serah+$stock))."')) class='btn btn-xs btn-danger fa fa-minus-square' ></a>";
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
							            	<a href="javascript:void(window.open('<?php echo site_url($action) ?>'))" class="btn btn-primary">Simpan</a>
							            </th>
							    </tr>
                            </table>
                    <?php echo form_close();
                        }else{
	                        if ($edit<>1){
							    echo "<a href=javascript:void(window.open('".site_url('inventory_penyerahan/view/'.$isi->replid.'/1')."')) class='btn btn-warning'>
							    			Ubah
							    		</a>  ";
								echo "<a href=javascript:void(window.open('".site_url('inventory_penyerahan')."')) class='btn btn-success'>Kembali</a>";
							 }

                        }
                    ?>
		</section><!-- /.content -->
<!------------------------------------------------------------------------------------------------------------------------------------>
<?php } elseif($view=='penyerahan_material'){ ?>
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
		        		<label class="control-label" for="minlengthfield">No. Permintaan</label>
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
										 <label class="control-label" for="minlengthfield">Kode Penyerahan</label>
										 <div class="control-group">
							 <div class="controls">:
							 <?php echo $isi->kodepenyerahan;?>
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
							<?php echo $CI->p_c->tgl_indo($isi->tanggalserah);?>
							<?php //echo  <p id="message"></p> ?>
							</div>
										</div>
								</th>
						 </tr>
						 <!--
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
						 -->
			         <?php if ($isi->inventaris) { ?>
								 <tr>
										 <th align="left">
												 <label class="control-label" for="minlengthfield">No. Pembelian</label>
												 <div class="control-group">
									 <div class="controls">:
													 <?php
														 $arridinventory_pembelian='data-rule-required=true';
										 echo form_dropdown('idinventory_pembelian',$idinventory_pembelian_opt,$isi->idinventory_pembelian,$arridinventory_pembelian);			                	?>
													 <?php //echo  <p id="message"></p> ?>
									 </div>
												 </div>
										 </th>
									</tr>
									<tr>
		            <th align="left">
		        		<label class="control-label" for="minlengthfield">Departemen</label>
		        		<div class="control-group">
							<div class="controls">:
		                	<?php
								$iddepartemen=$isi->iddepartemen;
								if ($isi->iddepartemenpermintaan){
									$iddepartemen=$isi->iddepartemenpermintaan;
								}
		                		$arriddepartemen='data-rule-required=true';
		                		echo form_dropdown('iddepartemen',$iddepartemen_opt,$iddepartemen,$arriddepartemen);
		                	?>
							</div>
		        		</div>
		            </th></tr>
						 <tr>
		            <th align="left">
		        		<label class="control-label" for="minlengthfield">Penanggung Jawab</label>
		        		<div class="control-group">
							<div class="controls">:
		                	<?php
		                		$arridpj='data-rule-required=true';
		                		echo form_dropdown('idpj',$idpj_opt,$isi->idpj,$arridpj);
		                	?>
							</div>
		        		</div>
		            </th></tr>
					<tr>
			            <th align="left">
	                		<label class="control-label" for="minlengthfield">Sumber Dana</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		$arridsumberdana='data-rule-required=true';
									echo form_dropdown('idsumberdana',$idsumberdana_opt,$isi->idsumberdana,$arridsumberdana);			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th>
			         </tr>

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
			         <?php }else{ ?><input type="hidden" name="idkelompok_inventaris" value=""><?php } ?>
					 <tr>
			            <th align="left">
	                		<label class="control-label" for="minlengthfield">Sumber Dana</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		$arridsumberdana='data-rule-required=true';
									echo form_dropdown('idsumberdana',$idsumberdana_opt,$isi->idsumberdana,$arridsumberdana);			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th>
			         </tr>
			         <tr>
				            <th align="left">
		                		<label class="control-label" for="minlengthfield">Jumlah</label>
		                		<div class="control-group">
									<div class="controls">:
				                	<?php
				                		echo form_input(array('id' => 'jumlah','name'=>'jumlah','value'=>($isi->jumlah-$isi->total_serah),'data-rule-required'=>'true' ,'data-rule-maxlength'=>'8', 'data-rule-minlength'=>'1','data-rule-number'=>'true','placeholder'=>'Masukkan 1-8 Karakter'));
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
							<input type="hidden" name="idinventory_penyerahan" value="<?php echo $idpenyerahan; ?>">
							<input type="hidden" name="tanggalserah" value="<?php echo $CI->p_c->tgl_form($isi->tanggalserah); ?>">
			            	<input type="hidden" name="idpermintaanbarang" value="<?php echo $isi->idpermintaan_barang; ?>">
			            	<input type="hidden" name="idmaterial" value="<?php echo $isi->idmaterial; ?>">
			            	<input type="hidden" name="inventaris" value="<?php echo $isi->inventaris; ?>">
			            	<input type="hidden" name="kodecabang" value="<?php echo $isi->kodecabang; ?>">
			            	<input type="hidden" name="idcompany" value="<?php echo $isi->idcompany; ?>">
							<!--
							<input type="hidden" name="iddepartemen" value="<?php echo $isi->iddepartemen; ?>">
							<input type="hidden" name="kodedepartemen" value="<?php echo $isi->kodedepartemen; ?>">
							-->
			            	<input type="hidden" name="kodefiskal" value="<?php echo $isi->kodefiskal; ?>">
			            	<input type="hidden" name="kodematerial" value="<?php echo $isi->kodematerial; ?>">
			            	<input type="hidden" name="stock" value="<?php echo $isi->stock; ?>">

			            	<button class='btn btn-primary'>Simpan</button>
			            	<a href="javascript:void(window.open('<?php echo site_url('inventory_penyerahan/view/'.$isi->idpermintaan_barang.'/1/'.$idpenyerahan) ?>'))" class="btn btn-success">Batal</a>
			            </th>
				    </tr>
		            </table>
                </table>
            <?php //}
            ?>
		</section><!-- /.content -->
<!------------------------------------------------------------------------------------------------------------------------------------>
<?php } elseif($view=='head_penyerahan_material'){?>
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
		 <tr>
		            <th align="left">
		        		<label class="control-label" for="minlengthfield">Penerima</label>
		        		<div class="control-group">
							<div class="controls">:
		                	<?php
		                		$arridpjheadpenyerahan='data-rule-required=true';
		                		echo form_dropdown('idpjheadpenyerahan',$idpegawai_opt,$isi->idpjheadpenyerahan,$arridpjheadpenyerahan);
		                	?>
							</div>
		        		</div>
		            </th></tr>
		 <tr>
		            <th align="left">
		        		<label class="control-label" for="minlengthfield">Staff Gudang</label>
		        		<div class="control-group">
							<div class="controls">:
		                	<?php
		                		$arridstaffgudang='data-rule-required=true';
		                		echo form_dropdown('idstaffgudang',$idpegawai_opt,$isi->idstaffgudang,$arridstaffgudang);
		                	?>
							</div>
		        		</div>
		            </th></tr>
					<tr>
		            <th align="left">
		        		<label class="control-label" for="minlengthfield">Manajer Umum</label>
		        		<div class="control-group">
							<div class="controls">:
		                	<?php
		                		$arridmanajerumum='data-rule-required=true';
		                		echo form_dropdown('idmanajerumum',$idpegawai_opt,$isi->idmanajerumum,$arridmanajerumum);
		                	?>
							</div>
		        		</div>
		            </th></tr>
		 <tr>
	 <th align="left">
		  <input type="hidden" name="idcompany" value="<?php echo $permintaan->idcompany; ?>">
		 <button class='btn btn-primary'>Simpan</button>
		 <a href="javascript:void(window.open('<?php echo site_url('inventory_penyerahan/view/'.$idpermintaan.'/1') ?>'))" class="btn btn-success">Batal</a>
	 </th>
</tr>
<?php } ?>
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
    </body>
</html>
