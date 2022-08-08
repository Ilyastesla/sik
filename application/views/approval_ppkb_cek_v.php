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
											    			<a href=javascript:void(window.open('".site_url('approval_ppkb_cek/view/'.$row->replid)."'))>".$row->kode_transaksi."</a>
											    	  </td>";
											    echo "<td align=''>".strtoupper($row->company)."</td>";
											    echo "<td align='center'>".strtoupper($row->pemohon)."</td>";
											    echo "<td align='center'>".strtoupper($row->departemen)."</td>";
											    echo "<td align='center'>".strtoupper($CI->p_c->tgl_indo($row->tanggalpengajuan))."</td>";
											     echo "<td align='center'>".strtoupper($CI->p_c->rupiah($row->jumlah))."</td>";
											    echo "<td align='center'><b>".strtoupper($row->statustext)."</b></td>";
											    echo "<td align='center'>";
											    echo "
											    		<a href=javascript:void(window.open('".site_url('approval_ppkb_cek/view/'.$row->replid)."'))>
											    			<button class='btn btn-primary'>Persetujuan</button>
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
<!------------------------------------------------------------------------------------------------------------------------------------->
<?php } elseif($view=='view'){
		$jml_c=0;$jml_jasa=0;$jml_lain=0;$total_keperluan=0;
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
				     		<?php if (!empty($keperluan)){ ?>
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
                                	$no=1;
                                	if (!empty($keperluan)){
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
                                        <th>Perkiraan Harga Satuan</th>
                                        <th>Sub Total</th>
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
										    echo "<td align='right'>".$CI->p_c->rupiah($rowjasa->nilai)."</td>";
										    echo "<td align='right'>".$CI->p_c->rupiah($rowjasa->sub_total)."</td>";
										    echo "</tr>";
										}
									}
									?>
									<tr><th colspan="5"></th>
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
                                	$no=1;
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
										}
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
                                	if (!empty($termin)){
										foreach($termin as $row) {
											$jml_c2=$jml_c2+$row->nilai;
										    echo "<tr>";
										    echo "<td align='center'>".$no++."</td>";
										    echo "<td align='center'>".$CI->p_c->tgl_indo($row->due_date)."</td>";
										    echo "<td align='right'>".$CI->p_c->rupiah($row->nilai)."</td>";
										    echo "</tr>";
										}
									}
									$sisa_termin=$total_keperluan-$jml_c2;
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
									    echo "<td align='left'><a href='".base_url()."uploads/ppkb_cek/".$row2->newfile."'>".$row2->file."</td>";
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
							            <?php
							            if ($isi->next_approver==$this->session->userdata('idpegawai')){
							            	if (($isi->status<>2) and ($isi->status<>1) and ($isi->status<>'R') and (count($approver_opt)>1)){?>
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
							        			<button class='btn btn-primary'>Persetujuan</button>
							        			<?php
								        			echo "<a href=javascript:void(window.open('".site_url('approval_ppkb_cek/reject/'.$isi->replid.'/'.$isi->status)."')) class='btn btn-xs btn-danger'>Tolak</a> ";
								        	}

								       }//next_approver ?>
							            	<a href="javascript:void(window.open('<?php echo site_url('approval_ppkb_cek') ?>'))" class="btn btn-success">Batal</a>
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
