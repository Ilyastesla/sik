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
											    			<a href=javascript:void(window.open('".site_url('approval_pinjaman/view/'.$row->replid)."'))>".$row->kode_transaksi."</a>
											    	  </td>";
											    echo "<td align=''>".strtoupper($row->company)."</td>";
											    echo "<td align='center'>".strtoupper($row->pemohon)."</td>";
											    echo "<td align='center'>".strtoupper($row->departemen)."</td>";
											    echo "<td align='center'>".strtoupper($CI->p_c->tgl_indo($row->tanggalpengajuan))."</td>";
											     echo "<td align='center'>".strtoupper($CI->p_c->rupiah($row->jumlah))."</td>";
											    echo "<td align='center'><b>".strtoupper($row->statustext)."</b></td>";
											    echo "<td align='center'>";
											    echo "
											    		<a href=javascript:void(window.open('".site_url('approval_pinjaman/view/'.$row->replid)."'))>
											    			<button class='btn btn-primary'>Terima</button>
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
<?php } elseif($view=='view'){ ?>
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
		        		<label class="control-label" for="minlengthfield">Jabatan</label>
		        		<div class="control-group">
							<div class="controls">:
							<?php echo strtoupper($isi->idjabatan);?>
							</div>
		        		</div>
		            </th></tr>
		            <tr>
		            <th align="left">
		        		<label class="control-label" for="minlengthfield">Grup Pinjaman</label>
		        		<div class="control-group">
							<div class="controls">:
							<?php echo strtoupper($isi->idgroup);?>
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
	                		<label class="control-label" for="minlengthfield">Jumlah</label>
	                		<div class="control-group">
								<div class="controls">:
								 <?php echo $CI->p_c->rupiah($isi->jumlah);?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			        </th></tr>
		            <tr>
				            <th align="left">
		                		<label class="control-label" for="minlengthfield">Keperluan</label>
		                		<div class="control-group">
									<div class="controls" valign="top">:
				                	<?php echo $isi->keperluan;?>
				                	<?php //echo  <p id="message"></p> ?>
									</div>
		                		</div>
				            </th></tr>
				    <tr>
			            <th align="left">
	                		<label class="control-label" for="minlengthfield">Cicilan</label>
	                		<div class="control-group">
								<div class="controls">:
								 <?php echo $CI->p_c->rupiah($isi->cicilan);?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			        </th></tr>
				    <tr>
			            <th align="left">
	                		<label class="control-label" for="minlengthfield">Tgl. Cicilan</label>
	                		<div class="control-group">
								<div class="controls">:
								<?php echo $CI->p_c->tgl_indo($isi->tglcicilan);?>
								<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th>
			         </tr>
				    <tr>
				            <th align="left">
		                		<label class="control-label" for="minlengthfield">Jenis Jaminan</label>
		                		<div class="control-group">
									<div class="controls" valign="top">:
				                	<?php echo strtoupper($isi->idjenis_jaminantext);?>
				                	<?php //echo  <p id="message"></p> ?>
									</div>
		                		</div>
				            </th></tr>
				    <tr>
				            <th align="left">
		                		<label class="control-label" for="minlengthfield">Keterangan Jaminan</label>
		                		<div class="control-group">
									<div class="controls" valign="top">:
				                	<?php echo $isi->keterangan_jaminan;?>
				                	<?php //echo  <p id="message"></p> ?>
									</div>
		                		</div>
				            </th></tr>

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
					     <th>
						     <hr/>
					     </th>
				     </tr>
				    <tr>
				            <th align="left">
		                		<label class="control-label" for="minlengthfield">Prakiraan Cicilan</label>
		                		<div class="control-group">
									<div class="controls" valign="top">:
				                	<?php echo round($isi->jumlah/$isi->cicilan);?> Bulan
				                	<?php //echo  <p id="message"></p> ?>
									</div>
		                		</div>
				            </th></tr>

				    <tr>
				    <tr>
				            <th align="left">
		                		<label class="control-label" for="minlengthfield">Selesai Cicilan</label>
		                		<div class="control-group">
									<div class="controls" valign="top">:
				                	<?php
				                	$tambah="+".round($isi->jumlah/$isi->cicilan)." month";
					                echo $CI->p_c->tgl_indo(date('Y-m-d',strtotime($isi->tglcicilan.$tambah)));?>
				                	<?php //echo  <p id="message"></p> ?>
									</div>
		                		</div>
				            </th></tr>

				    <tr>
				    <tr>
					     <th>
						     <hr/>
					     </th>
				     </tr>
				     <tr>
				     	<td>
					     	<table class="table table-bordered table-striped">
			                    <thead>
			                        <tr>
			                            <th width='50'>No.</th>
			                            <th>Nama File</th>
			                        </tr>
			                    </thead>
			                    <tbody>
			                    	<?php
			                    	$CI =& get_instance();$no=1;
									foreach((array)$attachment as $row2) {
									    echo "<tr>";
									    echo "<td width='30'>".$no++."</td>";
									    echo "<td align='left'><a href='".base_url()."uploads/pinjaman/".$row2->newfile."'>".$row2->file."</td>";
									    echo "</tr>";
									}
									?>

			                    </tbody>
			                    <tfoot>
			                    </tfoot>
			                </table>
				     	</td>
				     </tr>
				     <?php
	                $attributes = array('class' => 'form-horizontal form-validate', 'id' => 'form', 'method' => 'POST', 'novalidate'=>'novalidate');
	                echo form_open($action,$attributes);
	                ?>
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
					        			echo "<a href=javascript:void(window.open('".site_url('approval_pinjaman/reject/'.$isi->replid.'/'.$isi->status)."')) class='btn btn-xs btn-danger'>Tolak</a> ";
					        	}

					       }//next_approver ?>
				            	<a href="javascript:void(window.open('<?php echo site_url('approval_pinjaman') ?>'))" class="btn btn-success">Batal</a>
				            </th>
				    </tr>
				    <?php echo form_close(); ?>
				    </table>
		</section><!-- /.content -->
<!------------------------------------------------------------------------------------------------------------------------------------->
<?php } ?>
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
    </body>
</html>
