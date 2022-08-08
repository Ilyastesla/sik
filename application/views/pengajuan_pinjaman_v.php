<!DOCTYPE html>
<html>
<script language="javascript">

function validate() {
	var jumlah=parseInt(document.getElementById("jumlah").value);
	var cicilan=parseInt(document.getElementById("cicilan").value);
	if (cicilan>=jumlah){
		alert ("Jumlah cicilan tidak boleh lebih dari Rp."+jumlah);
		return false;
	}
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
                        <li><a href="javascript:void(window.open('<?php echo site_url('pengajuan_pinjaman/tambah'); ?>'))" ><i class="fa fa-plus-square"></i> Tambah</a></li>
									</div>
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
											    			<a href=javascript:void(window.open('".site_url('pengajuan_pinjaman/view/'.$row->replid)."'))>".$row->kode_transaksi."</a>
											    	  </td>";
											    echo "<td align=''>".strtoupper($row->company)."</td>";
											    echo "<td align='center'>".strtoupper($row->pemohon)."</td>";
											    echo "<td align='center'>".strtoupper($row->departemen)."</td>";
											    echo "<td align='center'>".strtoupper($CI->p_c->tgl_indo($row->tanggalpengajuan))."</td>";
											     echo "<td align='center'>".strtoupper($CI->p_c->rupiah($row->jumlah))."</td>";
											    echo "<td align='center'><b>".strtoupper($row->statustext)."</b></td>";
											    echo "<td align='center'>";
											    if ($row->status<=1){
											    echo "<a href=javascript:void(window.open('".site_url('pengajuan_pinjaman/ubah/'.$row->replid)."')) class='btn btn-xs btn-warning fa fa-check-square' ></a>&nbsp;&nbsp;";
													echo "<a href=javascript:void(window.open('".site_url('pengajuan_pinjaman/hapus/'.$row->replid)."')) class='btn btn-xs btn-danger fa fa-minus-square' ></a>";
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
		    	<input type="hidden" id="limitkk" name="limitkk" Value="<?php echo trim($isi->limitkk)?>">
		    	<?php
	                	if (isset($error)){
                	?>
                	<div class="alert alert-danger alert-dismissable" align="left">
                                        <i class="fa fa-ban"></i>
                                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                        <b>Peringatan!</b> <?php echo $error; ?>.
                    </div>
	                <?php
	                }
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
		            <th align="left">
		        		<label class="control-label" for="minlengthfield">Jenis Pinjaman</label>
		        		<div class="control-group">
							<div class="controls">:
		                	<?php
		                		$arrjenis_pinjaman='data-rule-required=true';
		                		echo form_dropdown('idjenis_pinjaman',$jenis_pinjaman_opt,$isi->idjenis_pinjaman,$arrjenis_pinjaman);
		                	?>
							</div>
		        		</div>
		            </th></tr>
		            <tr>
			            <th align="left">
	                		<label class="control-label" for="minlengthfield">Tgl. Pengajuan</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		echo form_input(array('class' => '', 'id' => 'dp2','name'=>'tanggalpengajuan','value'=>$CI->p_c->tgl_form($isi->tanggalpengajuan),'data-rule-required'=>'true' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'2' ,'placeholder'=>'DD-MM-YYYY','autocomplete'=>'off'));
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
			                		echo form_input(array('id' => 'jumlah','name'=>'jumlah','value'=>$isi->jumlah,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'10', 'data-rule-minlength'=>'2','data-rule-number'=>'true','placeholder'=>'Masukkan 2-10 Karakter'));
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			        </th></tr>
			        <tr>
				            <th align="left">
		                		<label class="control-label" for="minlengthfield">Keperluan</label>
		                		<div class="control-group">
									<div class="controls" valign="top">&nbsp;&nbsp;
				                	<?php
				                		echo form_textarea(array('class' => '', 'id' => 'keperluan','name'=>'keperluan','value'=>$isi->keperluan,'data-rule-required'=>'false' ,'data-rule-maxlength'=>'500', 'data-rule-minlength'=>'2' ,'placeholder'=>'Masukkan 2-500 Karakter'));
				                	?>
				                	<?php //echo  <p id="message"></p> ?>
									</div>
		                		</div>
				            </th></tr>
			        <tr>
			            <th align="left">
	                		<label class="control-label" for="minlengthfield">Cicilan</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		echo form_input(array('id' => 'cicilan','name'=>'cicilan','value'=>$isi->cicilan,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'10', 'data-rule-minlength'=>'2','data-rule-number'=>'true','placeholder'=>'Masukkan 2-10 Karakter'));
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			        </th></tr>
			        <tr>
			            <th align="left">
	                		<label class="control-label" for="minlengthfield">Tgl. Cicilan</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		echo form_input(array('class' => '', 'id' => 'dp1','name'=>'tglcicilan','value'=>$CI->p_c->tgl_form($isi->tglcicilan),'data-rule-required'=>'true' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'2' ,'placeholder'=>'DD-MM-YYYY','autocomplete'=>'off'));
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th>
			         </tr>
			        <tr>
		            <th align="left">
		        		<label class="control-label" for="minlengthfield">Jenis Jaminan</label>
		        		<div class="control-group">
							<div class="controls">:
		                	<?php
		                		$arrjenis_jaminan='data-rule-required=true';
		                		echo form_dropdown('idjenis_jaminan',$jenis_jaminan_opt,$isi->idjenis_jaminan,$arrjenis_jaminan);
		                	?>
							</div>
		        		</div>
		            </th></tr>
		            <tr>
				            <th align="left">
		                		<label class="control-label" for="minlengthfield">Keterangan Jaminan</label>
		                		<div class="control-group">
									<div class="controls" valign="top">&nbsp;&nbsp;
				                	<?php
				                		echo form_textarea(array('class' => '', 'id' => 'keterangan_jaminan','name'=>'keterangan_jaminan','value'=>$isi->keterangan_jaminan,'data-rule-required'=>'false' ,'data-rule-maxlength'=>'500', 'data-rule-minlength'=>'2' ,'placeholder'=>'Masukkan 2-500 Karakter'));
				                	?>
				                	<?php //echo  <p id="message"></p> ?>
									</div>
		                		</div>
				            </th></tr>
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
				            	<input type="hidden" name="jumlah_lama" value="<?php echo $isi->jumlah ?>">
				            	<button class='btn btn-primary' onclick="return validate()">Simpan</button>
				            	<a href="javascript:void(window.open('<?php echo site_url('pengajuan_pinjaman') ?>'))" class="btn btn-success">Batal</a>
				            </th>
				    </tr>
		            </table>
		        	<?php
		        	echo form_close();
		        	?>
	    </section>
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
				    </table>
		        	<?php
		        	if (($isi->status==1) or ($isi->status=='R') and (count($approver_opt)>1)){
		        	 $attributes = array('class' => 'form-horizontal form-validate', 'id' => 'form', 'method' => 'POST', 'novalidate'=>'novalidate');
		        	 echo form_open_multipart('pengajuan_pinjaman/upload_it/'.$id,$attributes);
		        	?>
		        	<div align="left">
		        	<input type="file" name="userfile" size="20" /><br/>
		        	<input type="submit" value="upload" class='btn btn-xs btn-primary'/>
		        	</div>
		        	<?php echo form_close(); ?>
		        	<hr/><br/>
		        	<?php } ?>
		        	<table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th width="30px">No.</th>
                            <th>Nama File</th>
                            <?php if (($isi->status==1) or ($isi->status=='R') and (count($approver_opt)>1)){?>
                            <th width="80">Aksi</th>
                            <?php } ?>
                        </tr>
                    </thead>
                    <tbody>
                    	<?php
                    	$CI =& get_instance();$no=1;
						foreach((array)$attachment as $row2) {
						    echo "<tr>";
						    echo "<td>".$no++."</td>";
						    echo "<td align='left'><a href='".base_url()."uploads/pinjaman/".$row2->newfile."'>".$row2->file."</td>";
						    if (($isi->status==1) or ($isi->status=='R') and (count($approver_opt)>1)){
						    echo "<td>";
						    echo "<a href=javascript:void(window.open('".site_url('pengajuan_pinjaman/hapus_attachment/'.$row2->replid.'/'.$row2->newfile).'/'.$id."')) class='btn btn-danger' id='btnOpenDialog'>Hapus
						    	  </a>";
						    echo "</td>";
						    }
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
                <hr/>
                <table width="100%" border="0">
		        		<tr>
				            <th align="left">
				            	<?php if (($isi->status==1) or ($isi->status=='R') and (count($approver_opt)>1)){?>
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
				            	<?php
				            	echo "<a href=javascript:void(window.open('".site_url('pengajuan_pinjaman/ubah/'.$isi->replid)."')) class='btn btn-xs btn-warning fa fa-check-square' ></a>&nbsp;&nbsp;";
				            	echo "<a href=javascript:void(window.open('".site_url('pengajuan_pinjaman/hapus/'.$isi->replid)."')) class='btn btn-xs btn-danger fa fa-minus-square' ></a> ";

				            	}?>
				            	<a href="javascript:void(window.open('<?php echo site_url('ppkb') ?>'))" class="btn btn-success">Batal</a>
				            </th>
				        </tr>
				<?php echo form_close(); ?>
                </table>





	    </section>
<?php } ?>
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
    </body>
</html>
