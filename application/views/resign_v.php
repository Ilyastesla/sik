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
                        <li><a href="javascript:void(window.open('<?php echo site_url('resign/tambah'); ?>'))" ><i class="fa fa-plus-square"></i> Tambah</a></li>

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
                                                <th width='50'>No.</th>
                                                <th>Pegawai</th>
                                                <th>Tipe Resign</th>
                                                <th>Jabatan</th>
                                                <th>Tgl. Resign</th>
                                                <th>Keterangan</th>
                                                <th width="80">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        	<?php
                                        	$CI =& get_instance();$no=1;
											foreach((array)$show_table as $row) {
											    echo "<tr>";
											    echo "<td align='center'>".$no++."</td>";
											    echo "<td align='center'>
											    			<a href=javascript:void(window.open('".site_url('resign/view/'.$row->replid)."'))>".$row->no_sk."</a>
											    	  </td>";
											    echo "<td align='center'>".strtoupper($row->idpegawai)."</td>";
											    echo "<td align='center'>".strtoupper($row->idtype_resign)
											    			."<hr>(".strtoupper($row->idcompany).")"
											    			."</td>";
											     echo "<td align='center'>".strtoupper($row->idjabatan)
											    			."<hr>(".strtoupper($row->iddepartemen).")"
											    			."<hr>(".strtoupper($row->idpegawai_status).")"
											    			."</td>";
											    echo "<td align='center'>".strtoupper($CI->p_c->tgl_indo($row->awal_resign))."</td>";
											    echo "<td align='center'>".strtoupper($CI->p_c->tgl_indo($row->akhir_resign))."</td>";
											    echo "<td align='center'>".$row->avg_kompetensi."</td>";
											    echo "<td align='center'>".strtoupper($CI->p_c->tgl_indo($row->tanggal_pembuatan))."</td>";
											    echo "<td align='center'>";
											    echo "<a href=javascript:void(window.open('".site_url('resign/ubah/'.$row->replid)."')) class='btn btn-xs btn-warning fa fa-check-square' ></a>&nbsp;&nbsp;";
                          echo "<a href=javascript:void(window.open('".site_url('resign/hapus/'.$row->replid)."')) class='btn btn-xs btn-danger fa fa-minus-square' ></a>";
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
		    		<!--
		    		<tr>
		            <th align="left">
		        		<label class="control-label" for="minlengthfield">No. SK</label>
		        		<div class="control-group">
							<div class="controls">:
		                	<?php
		                		echo $isi->no_sk;
		                	?>
							</div>
		        		</div>
		            </th></tr>
		            -->
		            <tr>
		            <th align="left">
	                		<label class="control-label" for="minlengthfield">No. SK</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		echo form_input(array('class' => '','style'=>'margin: 0px 0px 5px; width: 687px;', 'id' => 'no_sk','name'=>'no_sk','value'=>$isi->no_sk,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'2' ,'placeholder'=>'Masukkan 2-100 Karakter'));
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
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
		                		echo form_dropdown('idcompany',$idcompany_opt,$isi->idcompany,$arrcompany);
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
		                		$arridpegawai='data-rule-required=true';
		                		echo form_dropdown('idpegawai',$idpegawai_opt,$isi->idpegawai,$arridpegawai);
		                	?>
							</div>
		        		</div>
		            </th></tr>
		            <tr>
		            <th align="left">
		        		<label class="control-label" for="minlengthfield">Tipe Resign</label>
		        		<div class="control-group">
							<div class="controls">:
		                	<?php
		                		$arridtype_resign='data-rule-required=true';
		                		echo form_dropdown('idtype_resign',$idtype_resign_opt,$isi->idtype_resign,$arridtype_resign);
		                	?>
							</div>
		        		</div>
		            </th></tr>
			         <tr>
			            <th align="left">
	                		<label class="control-label" for="minlengthfield">Tanggal Resign</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		echo form_input(array('class' => '', 'id' => 'dp1','name'=>'tgl_resign','value'=>$CI->p_c->tgl_form($isi->tgl_resign),'data-rule-required'=>'true' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'2' ,'placeholder'=>'DD-MM-YYYY','autocomplete'=>'off'));
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
				                		echo form_textarea(array('class' => '','style'=>'margin: 0px 0px 5px; width: 687px; height: 221px', 'id' => 'keterangan','name'=>'keterangan','value'=>$isi->keterangan,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'500', 'data-rule-minlength'=>'2' ,'placeholder'=>'Masukkan 2-500 Karakter'));
				                	?>
				                	<?php //echo  <p id="message"></p> ?>
									</div>
		                		</div>
				            </th></tr>
				    <tr>
				            <th align="left">
				            	<button class='btn btn-primary' onclick="return validate()">Simpan</button>
				            	<a href="javascript:void(window.open('<?php echo site_url('resign') ?>'))" class="btn btn-success">Batal</a>
				            </th>
				    </tr>
		            </table>
		        	<?php
		        	echo form_close();
		        	?>
	    </section>
<!------------------------------------------------------------------------------------------------------------------------------------->
<?php } elseif($view=='view'){ ?>
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
	                		<label class="control-label" for="minlengthfield">No. SK</label>
	                		<div class="control-group">
								<div class="controls">:
								<?php echo strtoupper($isi->no_sk);?>
								</div>
	                		</div>
			            </th></tr>
			        <tr>
		            <tr>
		            <th align="left">
		        		<label class="control-label" for="minlengthfield">Perusahaan</label>
		        		<div class="control-group">
							<div class="controls">:
							<?php echo strtoupper($isi->idcompany);?>
							</div>
		        		</div>
		            </th></tr>

		            <tr>
		            <th align="left">
		        		<label class="control-label" for="minlengthfield">NIK</label>
		        		<div class="control-group">
							<div class="controls">:
							<a href="javascript:void(window.open('<?php echo site_url('general/datapegawai/'.$isi->replidkaryawan) ?> '))"><?php echo strtoupper($isi->nip);?></a>
							</div>
		        		</div>
		            </th></tr>

		            <tr>
		            <th align="left">
		        		<label class="control-label" for="minlengthfield">Pegawai</label>
		        		<div class="control-group">
							<div class="controls">:
							<a href="javascript:void(window.open('<?php echo site_url('general/datapegawai/'.$isi->replidkaryawan) ?>')) "><?php echo strtoupper($isi->idpegawaitext);?></a>
							</div>
		        		</div>
		            </th></tr>
		            <tr>
		            <th align="left">
		        		<label class="control-label" for="minlengthfield">Tipe Resign</label>
		        		<div class="control-group">
							<div class="controls">:
							<?php echo strtoupper($isi->idtype_resign);?>
							</div>
		        		</div>
		            </th></tr>
		            <tr>
		            <th align="left">
		        		<label class="control-label" for="minlengthfield">Jabatan</label>
		        		<div class="control-group">
							<div class="controls">:
							<?php echo strtoupper($isi->idjabatan_text);?>
							</div>
		        		</div>
		            </th></tr>
		            <tr>
		            <th align="left">
		        		<label class="control-label" for="minlengthfield">Status Pegawai</label>
		        		<div class="control-group">
							<div class="controls">:
							<?php echo strtoupper($isi->idpegawai_status);?>
							</div>
		        		</div>
		            </th></tr>
			         <tr>
			            <th align="left">
	                		<label class="control-label" for="minlengthfield">Awal resign</label>
	                		<div class="control-group">
								<div class="controls">:
								<?php echo strtoupper($CI->p_c->tgl_indo($isi->awal_resign));?>
								</div>
	                		</div>
			            </th>
			         </tr>
				    <tr>
				            <th align="left">
		                		<label class="control-label" for="minlengthfield">Akhir resign</label>
		                		<div class="control-group">
									<div class="controls" valign="top">:
									<?php echo strtoupper($CI->p_c->tgl_indo($isi->akhir_resign));?>
									</div>
		                		</div>
				            </th></tr>
				    <tr>
			            <th align="left">
	                		<label class="control-label" for="minlengthfield">Jam Masuk</label>
	                		<div class="control-group">
								<div class="controls">:
								<?php echo strtoupper($isi->jam_masuk);?>
								</div>
	                		</div>
			            </th>
			         </tr>
			         <tr>
			            <th align="left">
	                		<label class="control-label" for="minlengthfield">Jam Keluar</label>
	                		<div class="control-group">
								<div class="controls">:
								<?php echo strtoupper($isi->jam_keluar);?>
								</div>
	                		</div>
			            </th>
			         </tr>
				    <tr>
			            <th align="left">
	                		<label class="control-label" for="minlengthfield">Tgl. Pembuatan</label>
	                		<div class="control-group">
								<div class="controls">:
								<?php echo strtoupper($CI->p_c->tgl_indo($isi->tanggal_pembuatan));?>
								</div>
	                		</div>
			            </th>
			         </tr>
			         <tr>
				            <th align="left">
		                		<label class="control-label" for="minlengthfield">Keterangan</label>
		                		<div class="control-group">
									<div class="controls" valign="top">&nbsp;&nbsp;
									<?php echo strtoupper($isi->Keterangan);?>
									</div>
		                		</div>
				            </th></tr>
				     <tr>
				            <th align="left">
		                		<label class="control-label" for="minlengthfield">Mengingat</label>
		                		<div class="control-group">
									<div class="controls" valign="top">&nbsp;&nbsp;
									<?php echo strtoupper($isi->mengingat);?>
									</div>
		                		</div>
				            </th></tr>
				     <tr>
				            <th align="left">
		                		<label class="control-label" for="minlengthfield">Memperhatikan</label>
		                		<div class="control-group">
									<div class="controls" valign="top">&nbsp;&nbsp;
									<?php echo strtoupper($isi->memperhatikan);?>
									</div>
		                		</div>
				            </th></tr>
				     <!--
				     <tr>
				            <th align="left">
		                		<label class="control-label" for="minlengthfield">Memutuskan</label>
		                		<div class="control-group">
									<div class="controls" valign="top">&nbsp;&nbsp;
									<?php echo strtoupper($isi->memutuskan);?>
									</div>
		                		</div>
				            </th></tr>
				    -->
				    <tr>
				            <th align="left">
		                		<label class="control-label" for="minlengthfield">Keterangan</label>
		                		<div class="control-group">
									<div class="controls" valign="top">&nbsp;&nbsp;
									<?php echo strtoupper($isi->keterangan);?>
									</div>
		                		</div>
				            </th></tr>
					     <th>
						     <hr/>
					     </th>
				     </tr>
				     <tr>
				     	<th align="left">Kompetensi :
				     	</th>
				     </tr>
				     <tr>
				     	<td>
					     	<table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th width="50">No.</th>
                                        <th>Kompetensi</th>
                                        <th width="100">Max. Skor</th>
                                        <th width="100">Skor</th>
                                        <?php if ($view2<>1){ ?>
                                        <th width="80">Aksi</th>
                                        <?php } ?>
                                    </tr>
                                </thead>
                                <tbody>
                                	<?php
                                	$CI =& get_instance();$skor=0;$avg=0;
                                	$no=1;
									foreach((array)$kompetensi as $row) {
										$skor=$skor+$row->skor;
									    echo "<tr align='left'>";
									    echo "<td align='center'>".$no++."</td>";
									    echo "<td>".strtoupper($row->idkompetensi)."</td>";
									    echo "<td align='center'>".$row->max_skor."</td>";
									    echo "<td align='center'><b>".$row->skor."</b></td>";
									    if ($view2<>1){
									    echo "<td align='center'>";
									    echo "
									    		<a href=javascript:void(window.open('".site_url('resign/tambahkompetensi/'.$isi->replid.'/'.$row->replid)."')) class='btn btn-xs btn-warning'>
									    			Ubah
									    		</a>";
									    echo "</td>";
									    }
									    echo "</tr>";
									}
									if ($skor<>0){$avg=$skor/($no-1);}
									?>
									<tr>
										<td colspan="3">&nbsp;</td>
										<td align="center"><b><?php echo round($avg,2); ?></b></td>
										<?php if ($view2<>1){ ?>
										<td>&nbsp;</td>
										<?php } ?>
									</tr>
                                </tbody>
                                <tfoot>
                                </tfoot>
                            </table>
				     	</td>
				     <tr>
					     <th>
						     <hr/>
					     </th>
				     </tr>
				    <tr>
				            <th align="left">
				            	<input type="hidden" name="idjabatan" value="<?php echo $isi->idjabatan ?>">
				            	<input type="hidden" name="avg_kompetensi" value="<?php echo $avg ?>">
				            	<input type="hidden" name="idpegawai" value="<?php echo $isi->idpegawai ?>">
				            	<?php
				            	if ($view2<>1){
					            	echo "<button class='btn btn-primary'>Simpan</button>&nbsp;&nbsp;";
					            }else{
						         	echo "<a href=javascript:void(window.open('".site_url('resign/ubah/'.$isi->replid)."')) class='btn btn-xs btn-warning'>&nbsp;&nbsp;Ubah&nbsp;&nbsp;</a> ";
					            }
				            	echo "<a href=javascript:void(window.open('".site_url('resign')."')) class='btn btn-success'>Kembali</a>";
				            	?>
				            </th>
				    </tr>
				    </table>
		        	<?php
		        	echo form_close();
		        	?>
	    </section>
<!-------------------------------------------------------------------------------------------------------------------------------------->
<?php } elseif($view=='tambahkompetensi'){ ?>
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
	                		<label class="control-label" for="minlengthfield">Kompetensi</label>
	                		<div class="control-group">
								<div class="controls">:
								<?php echo strtoupper($isi->idkompetensi);?>
								</div>
	                		</div>
			            </th></tr>
		            <tr>
		            <tr>
		            <th align="left">
	                		<label class="control-label" for="minlengthfield">Max. Skor</label>
	                		<div class="control-group">
								<div class="controls">:
								<?php echo strtoupper($isi->max_skor);?>
								</div>
	                		</div>
			            </th></tr>
		            <th align="left">
	                		<label class="control-label" for="minlengthfield">Skor</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		echo form_input(array('class' => '', 'id' => 'skor','name'=>'skor','value'=>$isi->skor,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'10', 'data-rule-minlength'=>'1','data-rule-number'=>'true','placeholder'=>'Masukkan 1-10 Karakter'));
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th></tr>
			            <tr>
				            <th align="left">
				            	<button class='btn btn-primary' onclick="return validate()">Simpan</button>
				            	<a href="javascript:void(window.open('<?php echo site_url('resign') ?>'))" class="btn btn-success">Batal</a>
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
