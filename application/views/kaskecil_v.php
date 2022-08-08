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
	newWindow('../printkaskecil/'+id, 'cetakkaskecil','900','800','resizable=1,scrollbars=1,status=0,toolbar=0')
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
                        <li><a href="javascript:void(window.open('<?php echo site_url('kaskecil/tambah'); ?>'))" ><i class="fa fa-plus-square"></i> Tambah</a></li>

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
                                                <th>No. PPKB</th>
                                                <th>Perusahaan</th>
                                                <th>Pemohon</th>
                                                <th>Departemen</th>
                                                <th>Tgl. Pengajuan</th>
                                                <th>Nilai</th>
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
												    echo "<a href=javascript:void(window.open('".site_url('kaskecil/view/'.$row->replid)."'))>".$row->kode_transaksi."</a>";
											    }else{
												    echo $row->kode_transaksi;
											    }

											    echo "</td>";
											    echo "<td align=''>".strtoupper($row->noppkb)."</td>";
											    echo "<td align=''>".strtoupper($row->company)."</td>";
											    echo "<td align='center'>".strtoupper($row->pemohon)."</td>";
											    echo "<td align='center'>".strtoupper($row->departemen)."</td>";
											    echo "<td align='center'>".strtoupper($CI->p_c->tgl_indo($row->tanggalpengajuan))."</td>";
											    echo "<td align='center'>".strtoupper($CI->p_c->rupiah($row->jumlah))."</td>";
											    echo "<td align='center'><b>".strtoupper($row->statustext)."</b></td>";
											    if(ISSET($history)){
												    echo "<td align='center'>".strtoupper($row->approvertext)."</td>";
											    }

											    echo "<td align='center'>";

											    if (($row->status<=2) and ($row->app<>100)){
											    echo "<a href=javascript:void(window.open('".site_url('kaskecil/ubah/'.$row->replid)."')) class='btn btn-xs btn-warning fa fa-check-square' ></a>&nbsp;&nbsp;";
													echo "<a href=javascript:void(window.open('".site_url('kaskecil/hapus/'.$row->replid)."')) class='btn btn-xs btn-danger fa fa-minus-square' ></a>";
											    }
											    if ($row->app==1){
											    	echo "
											    		<a href=javascript:void(window.open('".site_url('kaskecil/approve_v/'.$row->replid)."'))>
											    			<button class='btn btn-xs btn-warning'>Persetujuan</button>
											    		</a>";
											    }
											    if ($row->app==4){
											    	echo "
											    		<a href=javascript:void(window.open('".site_url('kaskecil/revisi_v/'.$row->replid)."'))>
											    			<button class='btn btn-xs btn-warning'>Revisi</button>
											    		</a>";
											    }
											    if ($row->app==100){
											    	echo "
											    		<a href=javascript:void(window.open('".site_url('kaskecil/history_v/'.$row->replid)."'))>
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
		    	<input type="hidden" id="limitkk" name="limitkk" Value="<?php echo trim($isi->limitkk)?>">
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
		        		<label class="control-label" for="minlengthfield">No. PPKB</label>
		        		<div class="control-group">
							<div class="controls">:
		                	<?php
		                		$arrppkb='data-rule-required=true';
		                		echo form_dropdown('idppkb',$ppkb_opt,$isi->idppkb,$arrppkb);
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
				            	<a href="javascript:void(window.open('<?php echo site_url('kaskecil') ?>'))" class="btn btn-success">Kembali</a>
				            </th>
				    </tr>
		            </table>
		        	<?php
		        	echo form_close();
		        	?>
	    </section>
<!-------------------------------------------------------------------------------------------------------------------------------------->
<?php } elseif($view=='material'){ ?>
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
		        		<label class="control-label" for="minlengthfield">No. PPKB</label>
		        		<div class="control-group">
							<div class="controls">:
		                	<?php
		                		echo $isi->no_ppkb;
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
				     </tr>

				     <tr>
				     	<td>
				     		<section class="content-header" align="right">
		                    <ol class="breadcrumb">
		                        <li><a href="javascript:void(window.open('<?php echo site_url('kaskecil/tambahmaterial/'.$id); ?>'))" ><i class="fa fa-plus-square"></i> Tambah</a></li>
		                    </ol>
		                </section>
					     	<table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th width='50'>No.</th>
                                        <th width="200">Kategori Pengeluaran</th>
                                        <th>Sumber Dana</th>
                                        <th>COA</th>
                                        <th>Keperluan</th>
                                        <th width="150">Nilai</th>
                                        <th width="80">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                	<?php
                                	$CI =& get_instance();
                                	$no=1;$totmat=0;
									foreach((array)$material as $row) {
										$totmat=$totmat+$row->jumlah;
									    echo "<tr align='left'>";
									    echo "<td align='center'>".$no++."</td>";
									    echo "<td>".$row->idpengeluaran."</td>";
									    echo "<td>".$row->idkredit."</td>";
									    echo "<td>".$row->iddebit."</td>";
									    echo "<td>".$row->keperluan."</td>";
									    echo "<td align='right'>".$CI->p_c->rupiah($row->jumlah)."</td>";
									    echo "<td align='center'>";
									    echo "
									    		<a href=javascript:void(window.open('".site_url('kaskecil/tambahmaterial/'.$isi->replid.'/'.$row->replid)."')) class='btn btn-xs btn-warning'>
									    			Ubah
									    		</a>
									    		<a href=javascript:void(window.open('".site_url('kaskecil/hapusmaterial/'.$isi->replid.'/'.$row->replid)."')) class='btn btn-xs btn-danger'>
									    			Hapus
									    		</a>";
									    echo "</td>";
									    echo "</tr>";
									}
									?>
                                </tbody>
                                <tfoot>
                                	<tr>
                                		<td colspan="5" align="right"><b>Total :</b></td>
                                		<td align="right"><b><?php echo $CI->p_c->rupiah($totmat); ?></b></td>
                                		<th>&nbsp;</th>
                                	</tr>
                                </tfoot>
                            </table>
				     	</td>
				     </tr>
					     <th>
						     <hr/>
					     </th>
				     </tr>
				     <tr>
				     	<td>
				     			<?php
										if (!empty($nilaiakun)){
												?><table class="table table-bordered table-striped"><?php
					            	foreach((array)$nilaiakun as $rowakun) {
					            			?>
					            					<tr>
					            						<td width="200"><?php echo $rowakun->idkredit ?></td>
					            						<td width="20">:</td>
					            						<td align="left"><?php echo $CI->p_c->rupiah($rowakun->nilai) ?></td>
					            					</tr>
					            			<?php
					            	}
												foreach((array)$nilaippkb as $rowppkbnilai) {
														$sisa = intval($rowppkbnilai->totnilai)-intval($rowppkbnilai->jmlpakai);
					            			?>
					            					<tr>
					            						<td width="200"><?php echo $rowppkbnilai->kode_transaksi ?></td>
					            						<td width="20">:</td>
					            						<td align="left"><?php echo $CI->p_c->rupiah($rowppkbnilai->totnilai).' | Terpakai : '.$CI->p_c->rupiah($rowppkbnilai->jmlpakai).' | <b> Sisa Dana: '.$CI->p_c->rupiah($sisa).'</b>' ?></td>
					            					</tr>
					            			<?php
					            	}
												?></table><?php
										}
				            	?>
				     	</td>
				     </tr>
				     <tr>
				            <th align="left">
				            	<?php if (($totmat<=$isi->limitkk) and ($totmat>0)) {?>
				            		<input type="hidden" id="totmat" name="totmat" value="<?php echo $totmat;?>">
				            		<button class='btn btn-primary' onclick="return validate()">Simpan</button>
				            	<?php } else {
				            		echo "<font color=red>Transaksi Tidak Boleh ".$CI->p_c->rupiah(0)." atau Lebih Dari ".$CI->p_c->rupiah($isi->limitkk)."</font>&nbsp;&nbsp;";
				            	}
				            	?>
				            	<a href="javascript:void(window.open('<?php echo site_url('kaskecil') ?>'))" class="btn btn-success">Kembali</a>
				            </th>
				    </tr>
		            </table>
		            <?php
		        	echo form_close();
		        	?>
	    </section>
<!-------------------------------------------------------------------------------------------------------------------------------------->
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
			        		<label class="control-label" for="minlengthfield">Kategori Pengeluaran</label>
			        		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		$arrjt='data-rule-required=true';
			                		echo form_dropdown('idpengeluaran',$jt_opt,$isi->idpengeluaran,$arrjt);
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
			                		$arrkredit='data-rule-required=true';
			                		echo form_dropdown('idkredit',$kredit_opt,$isi->idkredit,$arrkredit);
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
			        		</div>
			            </th></tr>
			            <tr>
			            <th align="left">
			        		<label class="control-label" for="minlengthfield">COA</label>
			        		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		$arrdebit='data-rule-required=true';
			                		echo form_dropdown('iddebit',$debit_opt,$isi->iddebit,$arrdebit);
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
					                		echo form_textarea(array('class' => '', 'id' => 'keperluan','name'=>'keperluan','value'=>$isi->keperluan,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'500', 'data-rule-minlength'=>'2' ,'placeholder'=>'Masukkan 2-500 Karakter'));
					                	?>
					                	<?php //echo  <p id="message"></p> ?>
										</div>
			                		</div>
					            </th></tr>
				         <tr>
				            <th align="left">
		                		<label class="control-label" for="minlengthfield">Nilai</label>
		                		<div class="control-group">
									<div class="controls">:
				                	<?php
				                		echo form_input(array('id' => 'jumlah','name'=>'jumlah','value'=>$isi->jumlah,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'6', 'data-rule-minlength'=>'2','data-rule-number'=>'true','placeholder'=>'Masukkan 2-6 Karakter'));
				                	?>
				                	<?php //echo  <p id="message"></p> ?>
									</div>
		                		</div>
				        </th></tr>
				   <tr>
				            <th align="left">
				            	<button class='btn btn-primary' onclick="return validate()">Simpan</button>
				            	<a href="javascript:void(window.open('<?php echo site_url('kaskecil/material/'.$idx) ?>'))" class="btn btn-success">Kembali</a>
				            </th>
				    </tr>
	            </table>
	        	<?php
	        	echo form_close();
	        	?>
	    </section>
<!-------------------------------------------------------------------------------------------------------------------------------------->
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
		        		<label class="control-label" for="minlengthfield">No. Transaksi</label>
		        		<div class="control-group">
							<div class="controls">:
		                	<?php echo strtoupper($isi->kode_transaksi);?>
							</div>
		        		</div>
		            </th></tr>
		            <tr>
		            <th align="left">
		        		<label class="control-label" for="minlengthfield">No. PPKB</label>
		        		<div class="control-group">
							<div class="controls">:
		                	<?php
		                		echo $isi->no_ppkb;
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
				     <?php if($isi->approvebytext){?>
				     <tr>
				            <th align="left">
				            	<hr />
		                		<label class="control-label" for="minlengthfield">Di Periksa Oleh</label>
		                		<div class="control-group">
									<div class="controls" valign="top">:
				                	<?php echo strtoupper($isi->approvebytext);?>
				                	<?php //echo  <p id="message"></p> ?>
									</div>
		                		</div>
				            </th></tr>
				     </tr>
				     <tr>
			            <th align="left">
	                		<label class="control-label" for="minlengthfield">Tgl. Diperiksa</label>
	                		<div class="control-group">
								<div class="controls">:
								<?php echo $CI->p_c->tgl_indo($isi->approve_date);?>
								<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th>
			         </tr>
			         <tr>
				            <th align="left">
		                		<label class="control-label" for="minlengthfield">Keterangan Periksa</label>
		                		<div class="control-group">
									<div class="controls" valign="top">:
				                	<?php echo $isi->keterangan_approval;?>
				                	<?php //echo  <p id="message"></p> ?>
									</div>
		                		</div>
				            </th></tr>
				     </tr>
				     <?php } ?>

				     <?php if($isi->keterangan_revisi){?>
			         <tr>
				            <th align="left">
		                		<label class="control-label" for="minlengthfield">Keterangan Revisi</label>
		                		<div class="control-group">
									<div class="controls" valign="top">:
				                	<?php echo $isi->keterangan_approval;?>
				                	<?php //echo  <p id="message"></p> ?>
									</div>
		                		</div>
				            </th></tr>
				     </tr>
				     <?php } ?>

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
				     </tr>
					     <th>
						     <hr/>
					     </th>
				     </tr>
				     <tr>
				     	<th align="left">PERMINTAAN :
				     	</th>
				     </tr>
				     <tr>
				     	<td>
					     	<table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th width='50'>No.</th>
                                        <th width="200">Kategori Pengeluaran</th>
                                        <th>Sumber Dana</th>
                                        <th>COA</th>
                                        <th>Keperluan</th>
                                        <th width="150">Nilai</th>
                                    </tr>
                                </thead>
                                <tbody>
                                	<?php
                                	$CI =& get_instance();
                                	$no=1;$minta=0;
									foreach((array)$material as $row) {
									    echo "<tr align='left'>";
									    echo "<td align='center'>".$no++."</td>";
									    echo "<td>".$row->idpengeluaran."</td>";
									    echo "<td>".$row->idkredit."</td>";
									    echo "<td>".$row->iddebit."</td>";
									    echo "<td>".$row->keperluan."</td>";
									    echo "<td align='right'>".$CI->p_c->rupiah($row->jumlah)."</td>";
									    echo "</tr>";
									    $minta=$minta+$row->jumlah;
									}
									echo "<tr align='left'>";
									echo "<td align='right' colspan='5'><b>Total :</b></td>";
									echo "<td align='right'><b>".$CI->p_c->rupiah($minta)."</b></td>";
									echo "</tr>";
									?>
                                </tbody>
                                <tfoot>
                                </tfoot>
                            </table>
				     	</td>
				     </tr>
					     <th>
						     <hr/>
					     </th>
				     </tr>
				     <?php if ($isi->penerimatext<>"") { ?>
				     <tr>
			            <th align="left">
			        		<label class="control-label" for="minlengthfield">Penerima</label>
			        		<div class="control-group">
								<div class="controls">:
			                	<?php echo strtoupper($isi->penerimatext);?>
								</div>
			        		</div>
			            </th></tr>
			            <tr>
				            <th align="left">
		                		<label class="control-label" for="minlengthfield">Tgl. Terima</label>
		                		<div class="control-group">
									<div class="controls">:
				                	<?php echo $CI->p_c->tgl_indo($isi->tanggalpenerima);?>
				                	<?php //echo  <p id="message"></p> ?>
									</div>
		                		</div>
				            </th>
				         </tr>
				         <tr>
				            <th align="left">
				            <ol class="breadcrumb">
		                    	<li><a href="JavaScript:cetakterima('<?=$isi->replid?>')"><i class="fa fa-file-text"></i>&nbsp;&nbsp;Cetak</a></li>
		                    </ol>
				            </th>
				         </tr>
				         <tr>
						     <th>
							     <hr/>
						     </th>
					     </tr>
					    <?php }

					    if ((!empty($realisasi)) and ($isi->tanggalrealisasi<>"")){ ?>
						    <tr>
						     	<th align="left">LPJ :
						     	</th>
						     </tr>
						     <tr>
					            <th align="left">
			                		<label class="control-label" for="minlengthfield">Tgl. Realisasi</label>
			                		<div class="control-group">
										<div class="controls">:
					                	<?php echo $CI->p_c->tgl_indo($isi->tanggalrealisasi);?>
					                	<?php //echo  <p id="message"></p> ?>
										</div>
			                		</div>
					            </th>
					         </tr>
						     <tr>
						     	<td>
							     	<table class="table table-bordered table-striped">
		                                <thead>
		                                    <tr>
		                                        <th width='50'>No.</th>
		                                        <th width="200">Kategori Pengeluaran</th>
		                                        <th>Sumber Dana</th>
		                                        <th>COA</th>
		                                        <th>Keperluan</th>
		                                        <th width="150">Nilai</th>
		                                    </tr>
		                                </thead>
		                                <tbody>
		                                	<?php
		                                	$CI =& get_instance();
		                                	$no=1;$real=0;
											foreach((array)$realisasi as $row) {
											    echo "<tr align='left'>";
											    echo "<td align='center'>".$no++."</td>";
											    echo "<td>".$row->idpengeluaran."</td>";
											    echo "<td>".$row->idkredit."</td>";
											    echo "<td>".$row->iddebit."</td>";
											    echo "<td>".$row->keperluan."</td>";
											    echo "<td align='right'>".$CI->p_c->rupiah($row->jumlah)."</td>";
											    echo "</tr>";
											    $real=$real+$row->jumlah;
											}
											$totalsub=$minta-$real;$csstotsub="";
											if ($totalsub<>0){
												$csstotsub=" style='background-color:red;'";
											}
											echo "<tr align='left'>";
											echo "<td align='right' colspan='5'><b>Total :</b></td>";
											echo "<td align='right'><b>".$CI->p_c->rupiah($real)."</b></td></tr>";
											echo "<td align='right' colspan='5'><b>Sisa Dana :</b></td>";
											echo "<td align='right' ".$csstotsub."><b>".$CI->p_c->rupiah($totalsub)."</b></td>";

											?>

		                                </tbody>
		                                <tfoot>
		                                </tfoot>
		                            </table>
						     	</td>
						     </tr>
							     <th>
								     <hr/>
							     </th>
						     </tr>
					    <?php
					    } //REALISASI show?>
<!----------------------------------------------------------------------------------------------------------------------------------->
					    <?php
					    if (($isi->status==3) and (!ISSET($history))){ //ACCEPTED ?>
				            <th align="left">
				        		<label class="control-label" for="minlengthfield">Penerima</label>
				        		<div class="control-group">
									<div class="controls">:
				                	<?php
				                		$arrpemohon='data-rule-required=true';
				                		echo form_dropdown('penerima',$pemohon_opt,$isi->penerima,$arrpemohon);
				                	?>
									</div>
				        		</div>
				            </th></tr>
				            <tr>
					            <th align="left">
			                		<label class="control-label" for="minlengthfield">Tgl. Terima</label>
			                		<div class="control-group">
										<div class="controls">:
					                	<?php
					                		echo form_input(array('class' => '', 'id' => 'dp1','name'=>'tanggalpenerima','value'=>$CI->p_c->tgl_form($isi->tanggalpenerima2),'data-rule-required'=>'false' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'2' ,'placeholder'=>'DD-MM-YYYY','autocomplete'=>'off'));
					                	?>
					                	<?php //echo  <p id="message"></p> ?>
										</div>
			                		</div>
					            </th>
					         </tr>
						    <tr>
						            <td align="left">
						            	<?php
														$na=0;
														if (!empty($nilaiakun)){
																?><table class="table table-bordered table-striped"><?php
									            	foreach((array)$nilaiakun as $rowakun) {
									            			?>
									            					<tr>
									            						<td width="200"><?php echo $rowakun->idkredit ?></td>
									            						<td width="20">:</td>
									            						<td align="left"><?php echo $CI->p_c->rupiah($rowakun->nilai) ?></td>
									            					</tr>
									            			<?php
									            	}
																foreach((array)$nilaippkb as $rowppkbnilai) {
																		$sisa = intval($rowppkbnilai->totnilai)-intval($rowppkbnilai->jmlpakai);
																		if ($sisa>$rowakun->jml){
										            			$na=1;
									            			}
									            			?>
									            					<tr>
									            						<td width="200"><?php echo $rowppkbnilai->kode_transaksi ?></td>
									            						<td width="20">:</td>
									            						<td align="left"><?php echo $CI->p_c->rupiah($rowppkbnilai->totnilai).' | Terpakai : '.$CI->p_c->rupiah($rowppkbnilai->jmlpakai).' | <b> Sisa Dana: '.$CI->p_c->rupiah($sisa).'</b>' ?></td>
									            					</tr>
									            			<?php
									            	}
																?></table><?php
														}
						            	if ($na==1){
						            		echo "<button class='btn btn-primary'>Terima</button> ";
						            	}else{
						            		echo "<font color=red>Rekening Akun Kredit Kurang Dari Nilai Permintaan</font>&nbsp;&nbsp;";
						            	}
						            	if ($isi->status<>14){
						            	echo "<a href=javascript:void(window.open('".site_url('kaskecil/batal/'.$isi->replid)."')) class='btn btn-xs btn-danger'>Batal</a> ";
						            	}
						            	echo "<a href=javascript:void(window.open('".site_url('kaskecil')."')) class='btn btn-success'>Kembali</a>";
						            	?>
						            </td>
						    </tr>
				    <?php } else { // STATUS <>11,<>setelah realisasi ?>
				    <tr>
			            <th align="left">
			            	<?php
			            		 IF (!ISSET($history)){
					            		if ($isi->status==2){
					            			foreach((array)$nilaiakun as $rowakun) {
							            			?>
							            				<table class="table table-bordered table-striped">
							            					<tr>
							            						<td width="150"><?php echo $rowakun->idkredit ?></td>
							            						<td width="20">:</td>
							            						<td align="left"><?php echo $CI->p_c->rupiah($rowakun->nilai) ?></td>
							            					</tr>
							            				</table>

							            			<?php
							            	}
							            	//APPROVER

					            			?>
					            			<label class="control-label" for="minlengthfield">Persetujuan Selanjutnya</label>
							        		<div class="control-group">
												<div class="controls">:
							                	<?php
							                		$arrapprover='data-rule-required=true';
							                		echo form_dropdown('approver',$approver_opt,'',$arrapprover);
							                	?>
												</div>
							        		</div>
							        		<button class='btn btn-xs btn-warning' name="submit" value="3">Rilis</button>
					            			<?php
						            		//echo "<a href=javascript:void(window.open('".site_url('kaskecil/release/'.$isi->replid)."')) class='btn btn-xs btn-warning'>Rilis</a> ";
						            	}
					            		if (($isi->status==5) and (isset($appy))){
					            			$attributes = array('class' => 'form-horizontal form-validate', 'id' => 'form', 'method' => 'POST', 'novalidate'=>'novalidate');
					            			echo form_open($action,$attributes);
					            			?>
					            				<label class="control-label" for="minlengthfield">Keterangan Approval</label>
						                		<div class="control-group">
													<div class="controls" valign="top">&nbsp;&nbsp;
								                	<?php
								                		echo form_textarea(array('class' => '','style'=>'margin: 0px 0px 5px; width: 687px; height: 100px', 'id' => 'keterangan_approval','name'=>'keterangan_approval','value'=>$isi->keterangan_approval,'data-rule-required'=>'false' ,'data-rule-maxlength'=>'500', 'data-rule-minlength'=>'2' ,'placeholder'=>'Masukkan 2-500 Karakter'));
								                	?>
								                	<?php //echo  <p id="message"></p> ?>
													</div>
						                		</div>
					            			<button class='btn btn-xs btn-warning' name="submit" value="3">Setuju</button>
					            			<button class='btn btn-xs btn-danger' name="submit" value="2">Tolak</button>
					            			<?php

						            		//echo "<a href=javascript:void(window.open('".site_url('kaskecil/approve/'.$isi->replid)."')) class='btn btn-xs btn-warning'>Setuju</a> ";
						            		//echo "<a href=javascript:void(window.open('".site_url('kaskecil/tolak/'.$isi->replid)."')) class='btn btn-xs btn-danger'>Tolak</a> ";
						            		echo form_close();
						            	}

						            	if (($isi->status==4) and (isset($rev))){ //REVISI
					            			$attributes = array('class' => 'form-horizontal form-validate', 'id' => 'form', 'method' => 'POST', 'novalidate'=>'novalidate');
					            			echo form_open($action,$attributes);
					            			?>
					            			<label class="control-label" for="minlengthfield">Keterangan Revisi</label>
						                		<div class="control-group">
													<div class="controls" valign="top">&nbsp;&nbsp;
								                	<?php
								                		echo form_textarea(array('class' => '','style'=>'margin: 0px 0px 5px; width: 687px; height: 100px', 'id' => 'keterangan_revisi','name'=>'keterangan_revisi','value'=>$isi->keterangan_revisi,'data-rule-required'=>'false' ,'data-rule-maxlength'=>'500', 'data-rule-minlength'=>'2' ,'placeholder'=>'Masukkan 2-500 Karakter'));
								                	?>
								                	<?php //echo  <p id="message"></p> ?>
													</div>
						                		</div>
					            			<button class='btn btn-xs btn-danger' name="submit" value="11">Revisi</button>
					            			<?php
					            			echo form_close();
						            	}

						            	if ($isi->status==11){ //REALISASI
								            	echo "<a href=javascript:void(window.open('".site_url('kaskecil/realisasi/'.$isi->replid)."')) class='btn btn-xs btn-warning'>LPJ</a> ";
								            	//echo "<a href=javascript:void(window.open('".site_url('kaskecil/hapusterima_p/'.$isi->replid)."')) class='btn btn-xs btn-danger'>Rollback !</a> ";
							           }
							           if ($isi->status==4){ //FINISH
							            		//echo "<a href=javascript:void(window.open('".site_url('kaskecil/hapusrealisasi_p/'.$isi->replid)."')) class='btn btn-xs btn-danger'>Rollback !</a> ";

							            }


					            		if (($isi->status<>14) and ($isi->status<>4) and ($isi->status<>5)){
					            			echo "<a href=javascript:void(window.open('".site_url('kaskecil/batal/'.$isi->replid)."')) class='btn btn-xs btn-danger'>Batal</a> ";
					            		}
					            		if ($isi->status<=2){
						            		echo "<a href=javascript:void(window.open('".site_url('kaskecil/ubah/'.$isi->replid)."')) class='btn btn-xs btn-primary'>Ubah</a> ";
						            		echo "<a href=javascript:void(window.open('".site_url('kaskecil/hapus/'.$isi->replid)."')) class='btn btn-xs btn-danger fa fa-minus-square' ></a> ";
						            	}
				            	}//!ISSET($history)
				            	echo "<a href=javascript:void(window.open('".site_url('kaskecil')."')) class='btn btn-success'>Kembali</a>";
			            	?>
			            </th>
				    </tr>

				    <?php }//status?>
				    </table>
		        	<?php
		        	echo form_close();
		        	?>
	    </section>
<!-------------------------------------------------------------------------------------------------------------------------------------->
<?php } elseif($view=='realisasi'){ ?>
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
		        		<label class="control-label" for="minlengthfield">No. PPKB</label>
		        		<div class="control-group">
							<div class="controls">:
		                	<?php
		                		echo $isi->no_ppkb;
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
				     </tr>
				      <tr>
			            <th align="left">
	                		<label class="control-label" for="minlengthfield">Tgl. Realisasi</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		echo form_input(array('class' => '', 'id' => 'dp1','name'=>'tanggalrealisasi','value'=>$CI->p_c->tgl_form($isi->tanggalrealisasi2),'data-rule-required'=>'true' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'2' ,'placeholder'=>'DD-MM-YYYY','autocomplete'=>'off'));
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th>
			         </tr>
				     <tr>
				     	<td>
					     	<table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th width='50'>No.</th>
                                        <th width="200">Kategori Pengeluaran</th>
                                        <th>Sumber Dana</th>
                                        <th>COA</th>
                                        <th>Keperluan</th>
                                        <th width="150">Nilai</th>
                                        <th width="80">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                	<?php
                                	$CI =& get_instance();
                                	$no=1;$jumlah_realisasi=0;
									foreach((array)$realisasi as $row) {
										$jumlah_realisasi=$jumlah_realisasi+$row->jumlah;
									    echo "<tr align='left'>";
									    echo "<td align='center'>".$no++."</td>";
									    echo "<td>".$row->idpengeluaran."</td>";
									    echo "<td>".$row->idkredit."</td>";
									    echo "<td>".$row->iddebit."</td>";
									    echo "<td>".$row->keperluan."</td>";
									    echo "<td align='right'>".$CI->p_c->rupiah($row->jumlah)."</td>";
									    echo "<td align='center'>";
									    echo "
									    		<a href=javascript:void(window.open('".site_url('kaskecil/tambahrealisasi/'.$isi->replid.'/'.$row->replid)."')) class='btn btn-xs btn-warning'>
									    			Ubah
									    		</a>";
									    //echo "
									    //		<a href=javascript:void(window.open('".site_url('kaskecil/hapusmaterial/'.$isi->replid.'/'.$row->replid)."')) class='btn btn-xs btn-danger'>
									    //			Hapus
									    //		</a>";
									    echo "</td>";
									    echo "</tr>";
									}
									?>
                                </tbody>
                                <tfoot>
                                	<tr>
                                		<td colspan="5" align="right"><b>Total :</b></td>
                                		<td align="right"><b><?php echo $CI->p_c->rupiah($jumlah_realisasi); ?></b></td>
                                		<th>&nbsp;</th>
                                	</tr>
                                </tfoot>
                            </table>
				     	</td>
				     </tr>
					     <th>
						     <hr/>
					     </th>
				     </tr>
				     <tr>
				            <th align="left">
				            	<?php if (($jumlah_realisasi<=$isi->limitkk) and (intval($jumlah_realisasi)>0) and (intval($jumlah_realisasi)<=intval($tot_pengajuan))) {?>
				            		<input type="hidden" id="jumlah_realisasi" name="jumlah_realisasi" value="<?php echo $jumlah_realisasi;?>">
				            		<button class='btn btn-primary' onclick="return validate()">Simpan</button>
				            	<?php } else {
				            		echo "<font color=red>Transaksi Tidak Boleh Lebih Dari".$CI->p_c->rupiah($tot_pengajuan)."</font>&nbsp;&nbsp;";
				            	}
				            	?>
				            	<a href="javascript:void(window.open('<?php echo site_url('kaskecil/view/'.$isi->replid) ?>'))" class="btn btn-success">Kembali</a>
				            </th>
				    </tr>
		            </table>
		            <?php
		        	echo form_close();
		        	?>
	    </section>
<!-------------------------------------------------------------------------------------------------------------------------------------->
<?php } elseif($view=='tambahrealisasi'){ ?>
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
			        		<label class="control-label" for="minlengthfield">Kategori Pengeluaran</label>
			        		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		$arrjt='data-rule-required=true';
			                		echo form_dropdown('idpengeluaran',$jt_opt,$isi->idpengeluaran,$arrjt);
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
			                		$arrkredit='data-rule-required=true';
			                		echo form_dropdown('idkredit',$kredit_opt,$isi->idkredit,$arrkredit);
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
			        		</div>
			            </th></tr>
			            <tr>
			            <th align="left">
			        		<label class="control-label" for="minlengthfield">COA</label>
			        		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		$arrdebit='data-rule-required=true';
			                		echo form_dropdown('iddebit',$debit_opt,$isi->iddebit,$arrdebit);
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
					                		echo form_textarea(array('class' => '', 'id' => 'keperluan','name'=>'keperluan','value'=>$isi->keperluan,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'500', 'data-rule-minlength'=>'2' ,'placeholder'=>'Masukkan 2-500 Karakter'));
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
				                		echo form_input(array('id' => 'jumlah','name'=>'jumlah','value'=>$isi->jumlah,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'6', 'data-rule-minlength'=>'2','data-rule-number'=>'true','placeholder'=>'Masukkan 2-6 Karakter'));
				                	?>
				                	<?php //echo  <p id="message"></p> ?>
									</div>
		                		</div>
				        </th></tr>
				   <tr>
				            <th align="left">
				            	<button class='btn btn-primary' onclick="return validate()">Simpan</button>
				            	<a href="javascript:void(window.open('<?php echo site_url('kaskecil/realisasi/'.$idx) ?>'))" class="btn btn-success">Kembali</a>
				            </th>
				    </tr>
	            </table>
	        	<?php
	        	echo form_close();
	        	?>
	    </section>
<?php } ?>
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
    </body>
</html>
