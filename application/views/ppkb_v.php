<!DOCTYPE html>
<html>
<script language="javascript">
function cetakuudp(id,iduudp) {
	newWindow('../../../uudp/printuudp/'+id+'/'+iduudp, 'cetakuudp','900','800','resizable=1,scrollbars=1,status=0,toolbar=0')
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
                    <ol class="breadcrumb">
                        <li><a href="javascript:void(window.open('<?php echo site_url('ppkb/tambah'); ?>'))" ><i class="fa fa-plus-square"></i> Tambah</a></li>
                        <!--
                        <li><a href="#"><i class="fa fa-file-text"></i>Cetak</a></li>
                        <li><a href="#"><i class="fa fa-file-excel-o"></i>Excel</a></li>
                        -->
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
																								<th>Rek. Adjusment</th>
                                                <th>Tgl. Pengajuan</th>
                                                <th>Jumlah</th>
                                                <th>Status</th>
                                                <th width="80">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        	<?php
                                        	$CI =& get_instance();
											foreach((array)$show_table as $row) {
											    echo "<tr>";
											    echo "<td align='center'>
											    			<a href=javascript:void(window.open('".site_url('ppkb/view/'.$row->replid)."'))>".$row->kode_transaksi."</a>
											    	  </td>";
											    echo "<td align=''>".strtoupper($row->company)."</td>";
											    echo "<td align='center'>".strtoupper($row->pemohon)."</td>";
											    echo "<td align='center'>".strtoupper($row->departemen)."</td>";
													echo "<td align='center'>".strtoupper($row->idadjustment)."</td>";
											    echo "<td align='center'>".strtoupper($CI->p_c->tgl_indo($row->tanggalpengajuan))."</td>";
											    echo "<td align='center'>".strtoupper($CI->p_c->rupiah($row->jumlah))."</td>";
											    echo "<td align='center'><b>".strtoupper($row->statustext)."</b></td>";
											    echo "<td align='center'>";

											    if (($row->status==2) or ($row->status==1) or ($row->status=='R')){
											    echo "<a href=javascript:void(window.open('".site_url('ppkb/ubah/'.$row->replid)."')) class='btn btn-xs btn-warning fa fa-check-square' ></a>&nbsp;&nbsp;";
													echo "<a href=javascript:void(window.open('".site_url('ppkb/hapus/'.$row->replid)."')) class='btn btn-xs btn-danger fa fa-minus-square' ></a>";
											    }//else{
									        	 //echo $row->next_approver;
								        		//}
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
								<label class="control-label" for="minlengthfield">Rek. Adjusment</label>
								<div class="control-group">
									<div class="controls">:
													<?php
														$arridadjustment='data-rule-required=false';
														echo form_dropdown('idadjustment',$idadjustment_opt,$isi->idadjustment,$arridadjustment);
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
				            	<a href="javascript:void(window.open('<?php echo site_url('ppkb') ?>'))" class="btn btn-success">Batal</a>
				            </th>
				    </tr>
		            </table>
		        	<?php
		        	echo form_close();
		        	?>
	    </section>
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
			        		<label class="control-label" for="minlengthfield">Rek. Adjustment</label>
			        		<div class="control-group">
										<div class="controls">:
										<?php echo strtoupper($isi->idadjustmenttext);?>
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
				     		<hr><h4>Keperluan :</h4>
								<?php
								$jml_c=0;$jml_jasa=0;$jml_lain=0;
								if ($isi->idadjustment==0){
								?>
				     		<section class="content-header" align="right">
			                    <ol class="breadcrumb">
			                        <li><a href="javascript:void(window.open('<?php echo site_url('ppkb/tambahkeperluan/'.$id); ?>'))" ><i class="fa fa-plus-square"></i> Tambah</a></li>
			                    </ol>
			                </section>
			                <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                    	<th width='50'>No.</th>
                                        <th>Material</th>
                                        <th>Jumlah</th>
                                        <th>Unit</th>
                                        <th>Perkiraan Harga Satuan</th>
                                        <th>Sub Total</th>
                                        <th width="80">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                	<?php
                                	$no=1;
                                	if (!empty($keperluan)){
										foreach($keperluan as $row) {
											$jml_c=$jml_c+$row->sub_total;
										    echo "<tr>";
										    echo "<td align='center'>".$no++."</td>";
										    echo "<td align=''>".$row->idmaterial."<br />Stok: ".$row->stock."</td>";
										    echo "<td align='center'>".$row->jumlah."</td>";
										    echo "<td align='center'>".$row->idunit."</td>";
										    echo "<td align='right'>".$CI->p_c->rupiah($row->nilai)."</td>";
										    echo "<td align='right'>".$CI->p_c->rupiah($row->sub_total)."</td>";
										    echo "<td align='center'>";
										    echo "
										    		<a href=javascript:void(window.open('".site_url('ppkb/tambahkeperluan/'.$isi->replid.'/'.$row->replid)."')) class='btn btn-xs btn-warning'>
										    			Ubah
										    		</a>
										    		<a href=javascript:void(window.open('".site_url('ppkb/hapuskeperluan/'.$isi->replid.'/'.$row->replid)."')) class='btn btn-xs btn-danger'>
										    			Hapus
										    		</a>";
										    echo "</td>";
										    echo "</tr>";
										}
									}
									?>
									<tr><th colspan="5"></th>
										<td align="right"><b><?php echo $CI->p_c->rupiah($jml_c)?></b></td>
										<td>&nbsp;</td>
									</tr>
                                </tbody>
                                <tfoot>
                                </tfoot>
                            </table>
				     		<section class="content-header" align="right">
			                    <ol class="breadcrumb">
			                        <li><a href="javascript:void(window.open('<?php echo site_url('ppkb/tambahjasa/'.$id); ?>'))" ><i class="fa fa-plus-square"></i> Tambah</a></li>
			                    </ol>
			                </section>
			                <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                    	<th width='50'>No.</th>
                                        <th>Jasa</th>
                                        <th>Periode</th>
                                        <th>Jumlah</th>
                                        <th>Unit</th>
                                        <th>Perkiraan Harga Satuan</th>
                                        <th>Sub Total</th>
                                        <th width="80">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                	<?php
                                	$no=1;
                                	if (!empty($jasa)){
										foreach($jasa as $rowjasa) {
											$jml_jasa=$jml_jasa+$rowjasa->sub_total;
										    echo "<tr>";
										    echo "<td align='center'>".$no++."</td>";
										    echo "<td align=''>".$rowjasa->idjasa."</td>";
										    echo "<td align=''>".$CI->p_c->tgl_indo($rowjasa->tgl_periode1)." s/d ".$CI->p_c->tgl_indo($rowjasa->tgl_periode2)."</td>";
										    echo "<td align='center'>".$rowjasa->jumlah."</td>";
										    echo "<td align='center'>".$rowjasa->idunit."</td>";
										    echo "<td align='right'>".$CI->p_c->rupiah($rowjasa->nilai)."</td>";
										    echo "<td align='right'>".$CI->p_c->rupiah($rowjasa->sub_total)."</td>";
										    echo "<td align='center'>";
										    echo "
										    		<a href=javascript:void(window.open('".site_url('ppkb/tambahjasa/'.$isi->replid.'/'.$rowjasa->replid)."')) class='btn btn-xs btn-warning'>
										    			Ubah
										    		</a>
										    		<a href=javascript:void(window.open('".site_url('ppkb/hapusjasa/'.$isi->replid.'/'.$rowjasa->replid)."')) class='btn btn-xs btn-danger'>
										    			Hapus
										    		</a>";
										    echo "</td>";
										    echo "</tr>";
										}
									}
									?>
									<tr><th colspan="6"></th>
										<td align="right"><b><?php echo $CI->p_c->rupiah($jml_jasa)?></b></td>
										<td>&nbsp;</td>
									</tr>
                                </tbody>
                                <tfoot>
                                </tfoot>
                            </table>
								<?php } else { ?>
										<?php if (empty($lain)){ ?>
										<section class="content-header" align="right">
			                    <ol class="breadcrumb">
			                        <li><a href="javascript:void(window.open('<?php echo site_url('ppkb/tambahlain/'.$id); ?>'))" ><i class="fa fa-plus-square"></i> Tambah</a></li>
			                    </ol>
			                </section>
											<?php } ?>
			                <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                    	<th width='50'>No.</th>
                                        <th>Keterangan</th>
                                        <th>Jumlah</th>
                                        <th>Unit</th>
                                        <th>Perkiraan Harga Satuan</th>
                                        <th>Sub Total</th>
                                        <th width="80">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                	<?php
                                	$jml_lain=0;$no=1;
                                	if (!empty($lain)){
										foreach($lain as $rowlain) {
											$jml_lain=$jml_lain+$rowlain->sub_total;
										    echo "<tr>";
										    echo "<td align='center'>".$no++."</td>";
										    echo "<td align=''>".$rowlain->keterangan."</td>";
										    echo "<td align='center'>".$rowlain->jumlah."</td>";
										    echo "<td align='center'>".$rowlain->idunit."</td>";
										    echo "<td align='right'>".$CI->p_c->rupiah($rowlain->nilai)."</td>";
										    echo "<td align='right'>".$CI->p_c->rupiah($rowlain->sub_total)."</td>";
										    echo "<td align='center'>";
										    echo "
										    		<a href=javascript:void(window.open('".site_url('ppkb/tambahlain/'.$isi->replid.'/'.$rowlain->replid)."')) class='btn btn-xs btn-warning'>
										    			Ubah
										    		</a>
										    		<a href=javascript:void(window.open('".site_url('ppkb/hapuslain/'.$isi->replid.'/'.$rowlain->replid)."')) class='btn btn-xs btn-danger'>
										    			Hapus
										    		</a>";
										    echo "</td>";
										    echo "</tr>";
										}
									}
									?>
									<tr><th colspan="5"></th>
										<td align="right"><b><?php echo $CI->p_c->rupiah($jml_lain)?></b></td>
										<td>&nbsp;</td>
									</tr>
                                </tbody>
                                <tfoot>
                                </tfoot>
                            </table>
									<?php }
									$total_keperluan=$jml_lain+$jml_jasa+$jml_c;
									?>
                            <table width="100%" border="1" class="table table-bordered table-striped">
	                            <td width="80%" align="right"><b>Total Keperluan :</b>&nbsp;&nbsp;</td>
	                            <td align="right"><b><?php echo $CI->p_c->rupiah($total_keperluan); ?></b></td>

                            </table>


                            <hr><h4>Termin Pembayaran :</h4>
				     		<section class="content-header" align="right">
			                    <ol class="breadcrumb">
			                        <li><a href="javascript:void(window.open('<?php echo site_url('ppkb/tambahtermin/'.$id); ?>'))" ><i class="fa fa-plus-square"></i> Tambah</a></li>
			                    </ol>
			                </section>
             				<table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Tahapan</th>
                                        <th>Jatuh Tempo</th>
                                        <th>Nilai</th>
                                        <th width="200px">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                	<?php
                                	$jml_c2=0;$no=1;
                                	if (!empty($termin)){
										foreach($termin as $row) {
											$jml_c2=$jml_c2+$row->nilai;
										    echo "<tr>";
										    echo "<td align='center'>".$no++."</td>";
										    echo "<td align='center'>".$CI->p_c->tgl_indo($row->due_date)."</td>";
										    echo "<td align='right'>".$CI->p_c->rupiah($row->nilai)."</td>";
										    echo "<td align='center'>";
										    echo "
										    		<a href=javascript:void(window.open('".site_url('ppkb/tambahtermin/'.$isi->replid.'/'.$row->replid)."')) class='btn btn-xs btn-warning'>
										    			Ubah
										    		</a>
										    		<a href=javascript:void(window.open('".site_url('ppkb/hapustermin/'.$isi->replid.'/'.$row->replid)."')) class='btn btn-xs btn-danger'>
										    			Hapus
										    		</a>";
										    echo "</td>";
										    echo "</tr>";
										}
									}
									$sisa_termin=$total_keperluan-$jml_c2;
									?>
									<tr><td colspan="2" align="right"><b>Total Termin :</b>&nbsp;&nbsp;</td>
										<td align="right"><b><?php echo $CI->p_c->rupiah($jml_c2)?></b></td>
										<td>&nbsp;</td>
									</tr>
									<tr><td colspan="2" align="right"><b>Sisa Keperluan :</b>&nbsp;&nbsp;</td>
										<td align="right"><b><?php echo $CI->p_c->rupiah($sisa_termin)?></b></td>
										<td>&nbsp;</td>
									</tr>
                                </tbody>
                                <tfoot>
                                </tfoot>
                            </table>

                            <hr><h4>Attachment :</h4>
                            <?php
				        	 $attributes = array('class' => 'form-horizontal form-validate', 'id' => 'form', 'method' => 'POST', 'novalidate'=>'novalidate');
				        	 echo form_open_multipart('ppkb/upload_it/'.$id,$attributes);
				        	?>
				        	<div align="left">
				        	<input type="file" name="userfile" size="20" /><br/>
				        	<input type="submit" value="upload" class='btn btn-xs btn-primary'/>
				        	</div>
				        	<?php echo form_close(); ?>
				        	<hr/><br/>
				        	<table class="table table-bordered table-striped">
			                    <thead>
			                        <tr>
			                            <th width="30px">No.</th>
			                            <th>Nama File</th>
			                            <th width="80">Aksi</th>
			                        </tr>
			                    </thead>
			                    <tbody>
			                    	<?php
			                    	$CI =& get_instance();$no=1;
									foreach((array)$attachment as $row2) {
									    echo "<tr>";
									    echo "<td>".$no++."</td>";
									    echo "<td align='left'><a href='".base_url()."uploads/ppkb/".$row2->newfile."'>".$row2->file."</td>";
									    echo "<td>";
									    echo "<a href=javascript:void(window.open('".site_url('ppkb/hapus_attachment/'.$row2->replid.'/'.$row2->newfile).'/'.$id."')) class='btn btn-danger' id='btnOpenDialog'>Hapus</a>";
									    echo "</td>";
									    echo "</tr>";
									}
									?>

			                    </tbody>
			                    <tfoot>
			                    </tfoot>
		                    </table>
                            <?php
						        $attributes = array('class' => 'form-horizontal form-validate', 'id' => 'form', 'method' => 'POST', 'novalidate'=>'novalidate');
					    	echo form_open($action,$attributes);
					    	?>
                            <table>
	                            <tr>
							            <th align="left">
							            	<?php if ($sisa_termin==0){?>
							            	<input type="hidden" name="total_keperluan" value="<?php echo $total_keperluan?>">
							            	<button class='btn btn-primary' onclick="return validate()">Simpan</button>
							            	<?php } else {
								            	echo "<font color=red>Sesuaikan Termin Dengan Nilai Pengajuan</font>&nbsp;&nbsp;";
							            	}?>
							            	<a href="javascript:void(window.open('<?php echo site_url('ppkb') ?>'))" class="btn btn-success">Batal</a>
							            </th>
							    </tr>
					            </table>
                            </table>
                            <?php echo form_close(); ?>
		</section><!-- /.content -->
<!------------------------------------------------------------------------------------------------------------------------------------->
<?php } elseif($view=='tambahkeperluan'){ ?>
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
			        		<label class="control-label" for="minlengthfield">Material</label>
			        		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		$arrmat='data-rule-required=true';
			                		echo form_dropdown('idmaterial',$mat_opt,$isi->idmaterial,$arrmat);
			                	?>
			                	 &nbsp;&nbsp; <a href="javascript:void(window.open('<?php echo site_url('inventory/ubahmaterial'); ?>'))"><i class="fa fa-plus-square"></i> Tambah</a>
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
		                		<label class="control-label" for="minlengthfield">Perkiraan Harga Satuan</label>
		                		<div class="control-group">
									<div class="controls">:
				                	<?php
				                		echo form_input(array('id' => 'nilai','name'=>'nilai','value'=>$isi->nilai,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'10', 'data-rule-minlength'=>'1','data-rule-number'=>'true','placeholder'=>'Masukkan 1-10 Karakter'));
				                	?>
				                	<?php //echo  <p id="message"></p> ?>
									</div>
		                		</div>
				        </th></tr>
				        <tr>
				            <th align="left">
				            	<button class='btn btn-primary' onclick="return validate()">Simpan</button>
				            	<a href="javascript:void(window.open('<?php echo site_url('ppkb/material/'.$idx) ?>'))" class="btn btn-success">Batal</a>
				            </th>
				    </tr>
	            </table>
	        	<?php
	        	echo form_close();
	        	?>
	    </section>
<!------------------------------------------------------------------------------------------------------------------------------------->
<?php } elseif($view=='tambahjasa'){ ?>
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
			        		<label class="control-label" for="minlengthfield">Jasa</label>
			        		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		$arrjasa='data-rule-required=true';
			                		echo form_dropdown('idjasa',$jasa_opt,$isi->idjasa,$arrjasa);
			                	?>
			                	&nbsp;&nbsp; <a href="javascript:void(window.open('<?php echo site_url('jasa/tambah'); ?>'))"><i class="fa fa-plus-square"></i> Tambah</a>
								</div>
			        		</div>
			            </th></tr>
			            <tr>
			            <th align="left">
	                		<label class="control-label" for="minlengthfield">Periode</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		echo form_input(array('class' => '', 'id' => 'dp1','name'=>'tgl_periode1','value'=>$CI->p_c->tgl_form($isi->tgl_periode1),'data-rule-required'=>'false' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'2' ,'placeholder'=>'DD-MM-YYYY','autocomplete'=>'off'));
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th>
			         </tr>
			         <tr>
			            <th align="left">
	                		<label class="control-label" for="minlengthfield">Sampai Dengan</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		echo form_input(array('class' => '', 'id' => 'dp2','name'=>'tgl_periode2','value'=>$CI->p_c->tgl_form($isi->tgl_periode2),'data-rule-required'=>'false' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'2' ,'placeholder'=>'DD-MM-YYYY','autocomplete'=>'off'));
			                	?>
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
		                		<label class="control-label" for="minlengthfield">Perkiraan Harga Satuan</label>
		                		<div class="control-group">
									<div class="controls">:
				                	<?php
				                		echo form_input(array('id' => 'nilai','name'=>'nilai','value'=>$isi->nilai,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'10', 'data-rule-minlength'=>'1','data-rule-number'=>'true','placeholder'=>'Masukkan 1-10 Karakter'));
				                	?>
				                	<?php //echo  <p id="message"></p> ?>
									</div>
		                		</div>
				        </th></tr>
				        <tr>
				            <th align="left">
				            	<button class='btn btn-primary' onclick="return validate()">Simpan</button>
				            	<a href="javascript:void(window.open('<?php echo site_url('ppkb/material/'.$idx) ?>'))" class="btn btn-success">Batal</a>
				            </th>
				    </tr>
	            </table>
	        	<?php
	        	echo form_close();
	        	?>
	    </section>
<!------------------------------------------------------------------------------------------------------------------------------------->
<?php } elseif($view=='tambahlain'){ ?>
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
		                		<label class="control-label" for="minlengthfield">Keterangan</label>
		                		<div class="control-group">
									<div class="controls" valign="top">&nbsp;&nbsp;
				                	<?php
				                		echo form_textarea(array('class' => '', 'id' => 'keterangan','name'=>'keterangan','value'=>$isi->keterangan,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'500', 'data-rule-minlength'=>'2' ,'placeholder'=>'Masukkan 2-500 Karakter'));
				                	?>
				                	<?php //echo  <p id="message"></p> ?>
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
		                		<label class="control-label" for="minlengthfield">Perkiraan Harga Satuan</label>
		                		<div class="control-group">
									<div class="controls">:
				                	<?php
				                		echo form_input(array('id' => 'nilai','name'=>'nilai','value'=>$isi->nilai,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'10', 'data-rule-minlength'=>'1','data-rule-number'=>'true','placeholder'=>'Masukkan 1-10 Karakter'));
				                	?>
				                	<?php //echo  <p id="message"></p> ?>
									</div>
		                		</div>
				        </th></tr>
				        <tr>
				            <th align="left">
				            	<button class='btn btn-primary' onclick="return validate()">Simpan</button>
				            	<a href="javascript:void(window.open('<?php echo site_url('ppkb/material/'.$idx) ?>'))" class="btn btn-success">Batal</a>
				            </th>
				    </tr>
	            </table>
	        	<?php
	        	echo form_close();
	        	?>
	    </section>
<!------------------------------------------------------------------------------------------------------------------------------------->
<?php } elseif($view=='tambahtermin'){ ?>
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
	                		<label class="control-label" for="minlengthfield">Jatuh Tempo</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		echo form_input(array('class' => '', 'id' => 'dp1','name'=>'due_date','value'=>$CI->p_c->tgl_form($isi->due_date),'data-rule-required'=>'false' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'2' ,'placeholder'=>'DD-MM-YYYY','autocomplete'=>'off'));
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th>
			         </tr>
				        <tr>
				            <th align="left">
		                		<label class="control-label" for="minlengthfield">Nilai</label>
		                		<div class="control-group">
									<div class="controls">:
				                	<?php
				                		echo form_input(array('id' => 'nilai','name'=>'nilai','value'=>$isi->nilai,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'10', 'data-rule-minlength'=>'1','data-rule-number'=>'true','placeholder'=>'Masukkan 1-10 Karakter'));
				                	?>
				                	<?php //echo  <p id="message"></p> ?>
									</div>
		                		</div>
				        </th></tr>
				        <tr>
				            <th align="left">
				            	<button class='btn btn-primary' onclick="return validate()">Simpan</button>
				            	<a href="javascript:void(window.open('<?php echo site_url('ppkb/material/'.$id) ?>'))" class="btn btn-success">Batal</a>
				            </th>
				    </tr>
	            </table>
	        	<?php
	        	echo form_close();
	        	?>
	    </section>
<!------------------------------------------------------------------------------------------------------------------------------------->
<?php } elseif($view=='view'){
	$total_keperluan=0;$jml_lain=0;$jml_jasa=0;$jml_c=0;$sisa_termin=0;$jml_uudp=0;
	$jml_c2=0;$sisa_uudp=0;$jml_c_realisasi=0;$jml_jasa_realisasi=0;$jml_lain_realisasi=0;
	$total_realisasi=0;$sisa_keperluan=0;
?>
		<section class="content-header table-responsive">
	            <h1>
	                <?php echo $form ?>
	                <small><?php echo $form_small ?></small>
	            </h1>
            </section>
            <section class="content">
		        <?php
			        $attributes = array('class' => 'form-horizontal form-validate', 'id' => 'form', 'method' => 'POST', 'novalidate'=>'novalidate');
		    	echo form_open($action,$attributes);
		    	?>
		    	<table width="100%" border="0">
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
			        		<label class="control-label" for="minlengthfield">Rek. Adjustment</label>
			        		<div class="control-group">
										<div class="controls">:
										<?php echo strtoupper($isi->idadjustmenttext);?>
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
				     		<hr><h4>Keperluan :</h4>
				     		<?php
				     		if (!empty($keperluan)){ ?>
			                <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                    	<th width='50'>No.</th>
                                        <th>Material</th>
                                        <th>Jumlah</th>
                                        <th>Unit</th>
                                        <th>Perkiraan Harga Satuan</th>
                                        <th>Sub Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                	<?php
                                	$jml_c=0;$no=1;
									foreach($keperluan as $row) {
										$jml_c=$jml_c+$row->sub_total;
									    echo "<tr>";
									    echo "<td align='center'>".$no++."</td>";
									    echo "<td align=''>".$row->idmaterial."</td>";
									    echo "<td align='center'>".$row->jumlah."</td>";
									    echo "<td align='center'>".$row->idunit."</td>";
									    echo "<td align='right'>".$CI->p_c->rupiah($row->nilai)."</td>";
									    echo "<td align='right'>".$CI->p_c->rupiah($row->sub_total)."</td>";
									    echo "</tr>";
									}
									?>
									<tr><th colspan="5"></th>
										<td align="right"><b><?php echo $CI->p_c->rupiah($jml_c)?></b></td>
									</tr>
                                </tbody>
                                <tfoot>
                                </tfoot>
                            </table>
                            <?php }
	                        if (!empty($jasa)){
                            ?>
			                <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                    	<th width='50'>No.</th>
                                        <th>Jasa</th>
                                        <th>Periode</th>
                                        <th>Jumlah</th>
                                        <th>Unit</th>
                                        <th>Perkiraan Harga Satuan</th>
                                        <th>Sub Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                	<?php
                                	$jml_jasa=0;$no=1;
									foreach($jasa as $rowjasa) {
										$jml_jasa=$jml_jasa+$rowjasa->sub_total;
									    echo "<tr>";
									    echo "<td align='center'>".$no++."</td>";
									    echo "<td align=''>".$rowjasa->idjasa."</td>";
									    echo "<td align=''>".$CI->p_c->tgl_indo($rowjasa->tgl_periode1)." s/d ".$CI->p_c->tgl_indo($rowjasa->tgl_periode2)."</td>";
									    echo "<td align='center'>".$rowjasa->jumlah."</td>";
									    echo "<td align='center'>".$rowjasa->idunit."</td>";
									    echo "<td align='right'>".$CI->p_c->rupiah($rowjasa->nilai)."</td>";
									    echo "<td align='right'>".$CI->p_c->rupiah($rowjasa->sub_total)."</td>";
									    echo "</tr>";
									}
									?>
									<tr><th colspan="6"></th>
										<td align="right"><b><?php echo $CI->p_c->rupiah($jml_jasa)?></b></td>
									</tr>
                                </tbody>
                                <tfoot>
                                </tfoot>
                            </table>
                            <?php }
	                        if (!empty($lain)){
                            ?>
			                <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                    	<th width='50'>No.</th>
                                        <th>Keterangan</th>
                                        <th>Jumlah</th>
                                        <th>Unit</th>
                                        <th>Perkiraan Harga Satuan</th>
                                        <th>Sub Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                	<?php
                                	$jml_lain=0;$no=1;
									foreach($lain as $rowlain) {
										$jml_lain=$jml_lain+$rowlain->sub_total;
									    echo "<tr>";
									    echo "<td align='center'>".$no++."</td>";
									    echo "<td align=''>".$rowlain->keterangan."</td>";
									    echo "<td align='center'>".$rowlain->jumlah."</td>";
									    echo "<td align='center'>".$rowlain->idunit."</td>";
									    echo "<td align='right'>".$CI->p_c->rupiah($rowlain->nilai)."</td>";
									    echo "<td align='right'>".$CI->p_c->rupiah($rowlain->sub_total)."</td>";
									}
									?>
									<tr><th colspan="5"></th>
										<td align="right"><b><?php echo $CI->p_c->rupiah($jml_lain)?></b></td>
									</tr>
                                </tbody>
                                <tfoot>
                                </tfoot>
                            </table>
                            <?php }
                            $total_keperluan=$jml_lain+$jml_jasa+$jml_c;
                            ?>
                            <table width="100%" border="1" class="table table-bordered table-striped">
	                            <td width="80%" align="right"><b>Total Keperluan :</b>&nbsp;&nbsp;</td>
	                            <td align="right"><b><?php echo $CI->p_c->rupiah($total_keperluan); ?></b></td>

                            </table>
                            <?php
	                        if (!empty($termin)){
                            ?>
                            <hr><h4>Termin Pembayaran :</h4>
				     		<table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Tahapan</th>
                                        <th>Jatuh Tempo</th>
                                        <th>Nilai</th>
                                    </tr>
                                </thead>
                                <tbody>
                                	<?php
                                	$jml_c2=0;$no=1;
									foreach($termin as $row) {
										$jml_c2=$jml_c2+$row->nilai;
									    echo "<tr>";
									    echo "<td align='center'>".$no++."</td>";
									    echo "<td align='center'>".$CI->p_c->tgl_indo($row->due_date)."</td>";
									    echo "<td align='right'>".$CI->p_c->rupiah($row->nilai)."</td>";
									    echo "</tr>";
									}
									?>
									<tr><td colspan="2" align="right"><b>Total Termin :</b>&nbsp;&nbsp;</td>
										<td align="right"><b><?php echo $CI->p_c->rupiah($jml_c2)?></b></td>
									</tr>
									<tr><td colspan="2" align="right"><b>Sisa Keperluan :</b>&nbsp;&nbsp;</td>
										<td align="right"><b><?php echo $CI->p_c->rupiah($sisa_termin)?></b></td>
									</tr>
                                </tbody>
                                <tfoot>
                                </tfoot>
                            </table>
                            <?php
	                        }
	                        $sisa_termin=$total_keperluan-$jml_c2;
                            ?>
                            <!------------------------------------------------------------------------------------------------------------------------------------->
                            <?php
                            if (!empty($uudp)){?>
                            <hr><h4>UUDP :</h4>
             				<table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Tahapan</th>
                                        <th>Kode Transaksi</th>
                                        <th>Penerima</th>
                                        <th>Tanggal Terima</th>
                                        <th>Nilai</th>
                                        <th width="200px">Print</th>
                                    </tr>
                                </thead>
                                <tbody>
                                	<?php
                                	$no=1;
                                	if (!empty($uudp)){
										foreach($uudp as $rowuudp) {
											$jml_uudp=$jml_uudp+$rowuudp->nilai;
										    echo "<tr>";
										    echo "<td align='center'>".$no++."</td>";
										    echo "<td align=''>".$rowuudp->kode_transaksi."</td>";
										    echo "<td align=''>".$rowuudp->penerima."</td>";
										    echo "<td align='center'>".$CI->p_c->tgl_indo($rowuudp->tanggalpenerima)."</td>";
										    echo "<td align='right'>".$CI->p_c->rupiah($rowuudp->nilai)."</td>";
										    echo "<td align='center'>";
											   ?><a href="JavaScript:cetakuudp('<?=$rowuudp->idppkb?>','<?=$rowuudp->replid?>')" class="fa fa-file-text">&nbsp;&nbsp;Cetak</a><?php
											echo "</td>";
										    echo "</tr>";
										}
									}
									?>
									<tr><td colspan="4" align="right"><b>Total UUDP :</b>&nbsp;&nbsp;</td>
										<td align="right"><b><?php echo $CI->p_c->rupiah($jml_uudp)?></b></td>
										<td></td>
									</tr>
									<tr><td colspan="4" align="right"><b>Sisa Termin :</b>&nbsp;&nbsp;</td>
										<td align="right"><b><?php echo $CI->p_c->rupiah($sisa_uudp)?></b></td>
										<td></td>
									</tr>
                                </tbody>
                                <tfoot>
                                </tfoot>
                            </table>
                            <?php }

	                        $sisa_uudp=$jml_c2-$jml_uudp;
                            ?>
<!------------------------------------------------------------------------------------------------------------------------------------->
                            <?php if ($isi->status==4){?>
                            <hr><h4>LPJ :</h4>
                            <?php if (!empty($keperluan)){ ?>
			                <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                    	<th width='50'>No.</th>
                                        <th>Material</th>
                                        <th>Jumlah</th>
                                        <th>Unit</th>
                                        <th>Sumber Dana</th>
                                        <th>COA</th>
                                        <th>Tgl. Realisasi</th>
                                        <th>Ket. Realisasi</th>
                                        <th>Perkiraan Harga Satuan</th>
                                        <th>Sub Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                	<?php
                                	$no=1;
									foreach($keperluan as $row) {
										$jml_c_realisasi=$jml_c_realisasi+$row->sub_total_realisasi;
									    echo "<tr>";
									    echo "<td align='center'>".$no++."</td>";
									    echo "<td align=''>".$row->idmaterial_realisasi."</td>";
									    echo "<td align='center'>".$row->jumlah_realisasi."</td>";
									    echo "<td align='center'>".$row->idunit_realisasi."</td>";
									    echo "<td align='center'>".$row->idkredit."</td>";
									    echo "<td align='center'>".$row->iddebit."</td>";
									    echo "<td align='center'>".$CI->p_c->tgl_indo($row->tanggalrealisasi)."</td>";
									    echo "<td align='center'>".$rowlain->realisasi_notes."</td>";
									    echo "<td align='right'>".$CI->p_c->rupiah($row->nilai_realisasi)."</td>";
									    echo "<td align='right'>".$CI->p_c->rupiah($row->sub_total_realisasi)."</td>";
									    echo "</tr>";
									}
									?>
									<tr><th colspan="9"></th>
										<td align="right"><b><?php echo $CI->p_c->rupiah($jml_c_realisasi)?></b></td>
									</tr>
                                </tbody>
                                <tfoot>
                                </tfoot>
                            </table>
                            <?php }
                            if (!empty($jasa)){ ?>
			                <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                    	<th width='50'>No.</th>
                                        <th>Jasa</th>
                                        <th>Periode</th>
                                        <th>Jumlah</th>
                                        <th>Unit</th>
                                        <th>Sumber Dana</th>
                                        <th>COA</th>
                                        <th>Tgl. Realisasi</th>
                                        <th>Ket. Realisasi</th>
                                        <th>Perkiraan Harga Satuan</th>
                                        <th>Sub Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                	<?php
                                	$no=1;
									foreach($jasa as $rowjasa) {
										$jml_jasa_realisasi=$jml_jasa_realisasi+$rowjasa->sub_total_realisasi;
									    echo "<tr>";
									    echo "<td align='center'>".$no++."</td>";
									    echo "<td align=''>".$rowjasa->idjasa_realisasi."</td>";
									    echo "<td align=''>".$CI->p_c->tgl_indo($rowjasa->tgl_periode1_realisasi)." s/d ".$CI->p_c->tgl_indo($rowjasa->tgl_periode2_realisasi)."</td>";
									    echo "<td align='center'>".$rowjasa->jumlah_realisasi."</td>";
									    echo "<td align='center'>".$rowjasa->idunit_realisasi."</td>";
									    echo "<td align='center'>".$rowjasa->idkredit."</td>";
									    echo "<td align='center'>".$rowjasa->iddebit."</td>";
									    echo "<td align='center'>".$CI->p_c->tgl_indo($rowjasa->tanggalrealisasi)."</td>";
									    echo "<td align='center'>".$rowlain->realisasi_notes."</td>";
									    echo "<td align='right'>".$CI->p_c->rupiah($rowjasa->nilai_realisasi)."</td>";
									    echo "<td align='right'>".$CI->p_c->rupiah($rowjasa->sub_total_realisasi)."</td>";
									    echo "</tr>";
									}
									?>
									<tr><th colspan="10"></th>
										<td align="right"><b><?php echo $CI->p_c->rupiah($jml_jasa_realisasi)?></b></td>
									</tr>
                                </tbody>
                                <tfoot>
                                </tfoot>
                            </table>
                            <?php }
                            if (!empty($lain)){ ?>
			                <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                    	<th width='50'>No.</th>
                                        <th>Keterangan</th>
                                        <th>Jumlah</th>
                                        <th>Unit</th>
                                        <th>Sumber Dana</th>
                                        <th>COA</th>
                                        <th>Rek. Adjusment</th>
                                        <th>Tgl. Realisasi</th>
                                        <th>Ket. Realisasi</th>
                                        <th>Perkiraan Harga Satuan</th>
                                        <th>Sub Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                	<?php
                                	$no=1;
									foreach($lain as $rowlain) {
										$jml_lain_realisasi=$jml_lain_realisasi+$rowlain->sub_total_realisasi;
									    echo "<tr>";
									    echo "<td align='center'>".$no++."</td>";
									    echo "<td align=''>".$rowlain->keterangan_realisasi."</td>";
									    echo "<td align='center'>".$rowlain->jumlah_realisasi."</td>";
									    echo "<td align='center'>".$rowlain->idunit_realisasi."</td>";
									    echo "<td align='center'>".$rowlain->idkredit."</td>";
									    echo "<td align='center'>".$rowlain->iddebit."</td>";
									    echo "<td align='center'>".$rowlain->idadjustment."</td>";
									    echo "<td align='center'>".$CI->p_c->tgl_indo($rowlain->tanggalrealisasi)."</td>";
									    echo "<td align='center'>".$rowlain->realisasi_notes."</td>";
									    echo "<td align='right'>".$CI->p_c->rupiah($rowlain->nilai_realisasi)."</td>";
									    echo "<td align='right'>".$CI->p_c->rupiah($rowlain->sub_total_realisasi)."</td>";
									}
									?>
									<tr><th colspan="10"></th>
										<td align="right"><b><?php echo $CI->p_c->rupiah($jml_lain_realisasi)?></b></td>
									</tr>
                                </tbody>
                                <tfoot>
                                </tfoot>
                            </table>
                            <?php }
	                            $total_realisasi=$jml_lain_realisasi+$jml_jasa_realisasi+$jml_c_realisasi;
								$sisa_keperluan=$total_keperluan-$total_realisasi;
                            ?>
                            <table width="100%" border="1" class="table table-bordered table-striped">
                            	<tr>
		                            <td width="86%" align="right"><b>Total Realisasi :</b>&nbsp;&nbsp;</td>
		                            <td align="right"><b><?php echo $CI->p_c->rupiah($total_realisasi); ?></b></td>
                            	</tr>
                            	<tr>
                            		<td align="right"><b>Total Keperluan :</b>&nbsp;&nbsp;</td>
                            		<td align="right"><b><?php echo $CI->p_c->rupiah($total_keperluan); ?></b></td>
                            	</tr>
                            	<tr>
                            		<td align="right"><b>Sisa Keperluan :</b>&nbsp;&nbsp;</td>
                            		<td align="right"><b><?php echo $CI->p_c->rupiah($sisa_keperluan); ?></b></td>
                            	</tr>
                            </table>
                            <?php } //if status ?>
<!------------------------------------------------------------------------------------------------------------------------------------->
                            <hr><h4>Attachment :</h4>
				        	<table class="table table-bordered table-striped">
			                    <thead>
			                        <tr>
			                            <th width="30px">No.</th>
			                            <th>Nama File</th>
			                        </tr>
			                    </thead>
			                    <tbody>
			                    	<?php
			                    	$CI =& get_instance();$no=1;
									foreach((array)$attachment as $row2) {
									    echo "<tr>";
									    echo "<td>".$no++."</td>";
									    echo "<td align='left'><a href='".base_url()."uploads/ppkb/".$row2->newfile."'>".$row2->file."</td>";
									    echo "</tr>";
									}
									?>

			                    </tbody>
			                    <tfoot>
			                    </tfoot>
		                    </table>

                            <table>
	                            <tr>
							            <th align="left">
							            	<?php if (($isi->status==2) or ($isi->status=='R') and (count($approver_opt)>1)){?>
							            	<input type="hidden" name="status" value="<?php echo $isi->status?>">
							            	<label class="control-label" for="minlengthfield">Persetujuan Selanjutnya</label>
							        		<div class="control-group">
												<div class="controls">:
							                	<?php
							                		$arrapprover='data-rule-required=true';
							                		echo form_dropdown('approver',$approver_opt,'',$arrapprover);
							                	?>
												</div>
							        		</div>
							        		<button class='btn btn-primary'>Proses</button>
							            	<?php }?>
							            	<a href="javascript:void(window.open('<?php echo site_url($batal) ?>'))" class="btn btn-success">Kembali</a>
							            </th>
							    </tr>
					            </table>
                            </table>
		</section><!-- /.content -->
<!------------------------------------------------------------------------------------------------------------------------------------->
<?php } ?>
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
    </body>
</html>
