<!DOCTYPE html>
<html>
<script language="javascript">
function cetakterima(id) {
	newWindow('../printpermintaan_barang/'+id, 'cetakpermintaan_barang','900','800','resizable=1,scrollbars=1,status=0,toolbar=0')
}
</script>

    <?php $this->load->view('header'); ?>
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
                        <li><a href="javascript:void(window.open('<?php echo site_url('permintaan_barang/tambah'); ?>'))" ><i class="fa fa-plus-square"></i> Tambah</a></li>

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
                              echo form_input(array('class' => '', 'id' => 'dp1','name'=>'periode1','value'=>$this->input->post('periode1'),'data-rule-required'=>'false' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'2' ,'placeholder'=>'DD-MM-YYYY','autocomplete'=>'off'))."&nbsp;";
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
																								<?php
																								echo "<th>No. Permintaan</th>";
																								//echo "<th>No. PPKB</th>";
																								echo "<th>Perusahaan</th>";
																								echo "<th>Departemen</th>";
																								echo "<th>Pemohon</th>";
																								echo "<th>Tgl. Permintaan</th>";
																								echo "<th>Tgl. Batas</th>";
																								echo "<th>Prioritas</th>";
																								echo "<th>Alasan Pengajuan</th>";
																								echo "<th>Status</th>";
																								if(ISSET($history)){
																									echo "<th width='*'>Persetujuan Selanjutnya</th>";
																								}
																								echo "<th width='80'>Aksi</th>";
																								?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        	<?php
                                        	$CI =& get_instance();
											foreach((array)$show_table as $row) {
											    echo "<tr>";
											    echo "<td align='center'>";
											    if ($row->app==0){
												    echo "<a href=javascript:void(window.open('".site_url('permintaan_barang/view/'.$row->replid)."')) >".$row->kode_transaksi."</a>";
											    }else{
												    echo $row->kode_transaksi;
											    }

											    echo "</td>";
													//echo "<td align=''>".$row->kode_ppkb."</td>";
											    echo "<td align=''>".strtoupper($row->company)."</td>";
													echo "<td align='center'>".strtoupper($row->departemen)."</td>";
											    echo "<td align='center'>".strtoupper($row->pemohon)."</td>";
											    echo "<td align='center'>".($CI->p_c->tgl_indo($row->tanggalpengajuan))."</td>";
													echo "<td align='center'>".($CI->dbx->tanggalbatas($row->tanggalpengajuan,$row->periode,$row->status))."</td>";
													echo "<td align='center'>".$CI->p_c->bgcolortext($row->prioritastext,$row->color)."</td>";
													echo "<td align='center'>".$row->keterangan."</td>";
											    echo "<td align='center'><b>".strtoupper($row->statustext)."</b></td>";
											    if(ISSET($history)){
												    echo "<td align='center'>".strtoupper($row->approvertext)."</td>";
											    }
											    echo "<td align='center'>";

											    if (($row->status<=2) and ($row->app<>100)){
											    echo "<a href=javascript:void(window.open('".site_url('permintaan_barang/tambah/'.$row->replid)."')) class='btn btn-xs btn-warning fa fa-check-square' ></a>&nbsp;&nbsp;";
													echo "<a href=javascript:void(window.open('".site_url('permintaan_barang/hapus/'.$row->replid)."')) class='btn btn-xs btn-danger fa fa-minus-square' >&nbsp;&nbsp;</a>";
											    }
											    if ($row->app==1){
											    	echo "<a href=javascript:void(window.open('".site_url('permintaan_barang/approve_v/'.$row->replid)."')) class='btn btn-xs btn-warning'>Persetujuan</a>&nbsp;&nbsp;";
											    }
											    if ($row->app==4){
											    	echo "<a href=javascript:void(window.open('".site_url('permintaan_barang/revisi_v/'.$row->replid)."')) class='btn btn-xs btn-warning'>Revisi</a>&nbsp;&nbsp;";
											    }
											    if ($row->app==100){
											    	echo "<a href=javascript:void(window.open('".site_url('permintaan_barang/history_v/'.$row->replid)."')) class='btn btn-xs btn-primary'>Lihat</a>&nbsp;&nbsp;";
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
            data:{modul:'iddepartemen',id:value},
            success: function(respond){
              $("#iddepartemen").html(respond);
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
				<?php if ($this->session->flashdata('errorinput')<>"") { ?>
					<div class="alert alert-danger alert-dismissable" align="left">
							<i class="fa fa-ban"></i>
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
							<b>ERROR!</b> <?php echo $this->session->flashdata('errorinput') ?>
						</div>
				<?php } ?>
		    		
		            <tr>
		            <th align="left">
		        		<label class="control-label" for="minlengthfield">Unit Bisnis</label>
		        		<div class="control-group">
										<div class="controls">:
					                	<?php
					                		$arrcompany='data-rule-required=true id="idcompany"';
					                		echo form_dropdown('idcompany',$company_opt,$isi->idcompany,$arrcompany);
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
		                		$arrdepartemen='data-rule-required=true id="iddepartemen"';
		                		echo form_dropdown('iddepartemen',$departemen_opt,$isi->iddepartemen,$arrdepartemen);
		                	?>
		                	<?php //echo  <p id="message"></p> ?>
							</div>
		        		</div>
		            </th></tr>
					<tr>
		            <th align="left">
		        		<label class="control-label" for="minlengthfield">No. Permintaan</label>
		        		<div class="control-group">
							<div class="controls">:
		                	<?php
		                		//echo $isi->kode_transaksi;
		                	?>
											<?php
												echo form_input(array('class' => '', 'id' => 'kode_transaksi','name'=>'kode_transaksi','value'=>$isi->kode_transaksi,'data-rule-required'=>'false' ,'data-rule-maxlength'=>'3', 'data-rule-minlength'=>'3' ,'data-rule-number'=>'true','placeholder'=>'Masukkan 3 Karakter'));
											?>
											<?php //echo  <p id="message"></p> ?>
											<br/><font color='red'>*Jika Kosong Nomor Urut Akan Dibuat Oleh Sistem</font>
							</div>
		        		</div>
		            </th></tr>
					<!--

								<tr>
				            <th align="left">
				        		<label class="control-label" for="minlengthfield">No. PPKB</label>
				        		<div class="control-group">
									<div class="controls">:
				                	<?php
														echo form_input(array('class' => '', 'id' => 'kode_ppkb','name'=>'kode_ppkb','value'=>$isi->kode_ppkb,'data-rule-required'=>'false' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'2' ,'placeholder'=>'Masukkan 2-100 Karakter'));
													?>
													<?php //echo  <p id="message"></p> ?>
									</div>
				        		</div>
				            </th></tr>
								-->
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
	                		<label class="control-label" for="minlengthfield">Tgl. Permintaan</label>
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
							 <label class="control-label" for="minlengthfield">Prioritas</label>
							 <div class="control-group">
						 <div class="controls">:
										 <?php
											 $arridprioritas='data-rule-required=true';
											 echo form_dropdown('idprioritas',$idprioritas_opt,$isi->idprioritas,$arridprioritas);
										 ?>
						 </div>
							 </div>
							 </th></tr>
				    <tr>
				            <th align="left">
		                		<label class="control-label" for="minlengthfield">Alasan Pengajuan</label>
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
				            	<a href="<?php echo $_SERVER['HTTP_REFERER'] ?>" class="btn btn-success">Kembali</a>
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
		newWindow('<?php echo site_url("permintaan_barang/printpermintaan/".$isi->replid."/0")?>', 'cetakpermintaan','900','800','resizable=1,scrollbars=1,status=0,toolbar=0')
	}
	</script>
		<section class="content-header table-responsive">
	            <h1>
	                <?php echo $form ?>
	                <small><?php echo $form_small ?></small>
	            </h1>
							<ol class="breadcrumb">
											<li><a href="javascript:void(window.open('<?php echo site_url('permintaan_barang/tambah'); ?>'))" ><i class="fa fa-plus-square"></i> Tambah</a></li>
				              <li><a href="JavaScript:cetakprint()"><i class="fa fa-file-text"></i>&nbsp;Cetak</a></li>
				      </ol>
            </section>
            <section class="content">
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
						<?php if($isi->kode_ppkb<>""){?>
						<!--
						<tr>
								<th align="left">
								<label class="control-label" for="minlengthfield">No. PPKB</label>
								<div class="control-group">
							<div class="controls">:
											<?php echo strtoupper($isi->kode_ppkb);?>
							</div>
								</div>
								</th></tr>
							-->
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
							<?php echo strtoupper($isi->pemohontext);?>
							</div>
		        		</div>
		            </th></tr>
		            <tr>
			            <th align="left">
	                		<label class="control-label" for="minlengthfield">Tgl. Permintaan</label>
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
									 	echo $CI->p_c->bgcolortext($CI->p_c->tgl_indo($isi->dateline),'red');
								 }else{
								 		echo $CI->p_c->tgl_indo($isi->dateline)."&nbsp;</font>";
								}
							 ?>
							 </div>
										 </div>
								 </th>
							</tr>
				    <tr>
				            <th align="left">
		                		<label class="control-label" for="minlengthfield">Alasan Pengajuan</label>
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
										 <th align="left">
												 <label class="control-label" for="minlengthfield">Petugas</label>
												 <div class="control-group">
									 <div class="control-group">
										 <div class="controls">:
														 <?php
															 echo $CI->p_c->tgl_indo($isi->created_date);
															 echo " Oleh ".$CI->dbx->getpegawai($isi->created_by,0,1);
														 ?>
														 <?php //echo  <p id="message"></p> ?>
										 </div>
									 </div>
												 </div>
										 </th>
									</tr>
							 <tr>
										 <th align="left">
												 <label class="control-label" for="minlengthfield">Tgl. Revisi</label>
												 <div class="control-group">
									 <div class="control-group">
										 <div class="controls">:
														 <?php
															 echo $CI->p_c->tgl_indo($isi->modified_date);
															 echo " Oleh ".$CI->dbx->getpegawai($isi->modified_by,0,1);
														 ?>
														 <?php //echo  <p id="message"></p> ?>
										 </div>
									 </div>
												 </div>
										 </th>
									</tr>
				     <tr>
				     	<td align="left">
				     		<hr><h4>Material :</h4>
				     		<?php if(!$viewview){?>
				     					<section class="content-header table-responsive">
			                    <ol class="breadcrumb">
			                        <li><a href="javascript:void(window.open('<?php echo site_url('permintaan_barang/tambahmaterial/'.$id); ?>'))" ><i class="fa fa-plus-square"></i> Tambah</a></li>
			                    </ol>
			                </section>
			                <?php } ?>
			                <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
																				<?php
																				echo "<th width='50'>No.</th>";
																				echo "<th>Peruntukan</th>";
																				echo "<th>Material</th>";
																				echo "<th>Jumlah</th>";
																				echo "<th>Unit</th>";
																				echo "<th>Harga Perkiraan<br>(+pajak)</th>";
																				echo "<th>Harga Total</th>";
																				//echo "<th>Vendor</th>";
																				echo "<th>Keterangan</th>";
																				if($viewview){
																					echo "<th>Total Serah</th>";
																					echo "<th>Sisa Serah</th>";
																				}
																				if(!$viewview){
																					echo "<th width='80'>Aksi</th>";
																				}
																				?>
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
											$sisaserah=0;$total_serah=0;
												$bg=" style='background-color:green'";
                      	$sisaserah=$row->jumlah-$row->total_serah;
                      	if ($row->total_serah<>""){
                      		$total_serah=$row->total_serah;
                      	}
                      	if ($sisaserah>0){
                        	$bg=" style='background-color:red'";
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
												//echo "<td align='center'>".strtoupper($row->vendor)."</td>";
												echo "<td align='center'>".$row->peruntukan."</td>";
												if($viewview){
												echo "<td align='center'>".$total_serah."</td>";
										    echo "<td align='center' ".$bg.">".$sisaserah."</td>";
												}
												if(!$viewview){
										    echo "<td align='center'>";
										    echo "<a href=javascript:void(window.open('".site_url('permintaan_barang/tambahmaterial/'.$isi->replid.'/'.$row->replid)."')) class='btn btn-xs btn-warning fa fa-check-square' ></a>&nbsp;&nbsp;";
												echo "<a href=javascript:void(window.open('".site_url('permintaan_barang/hapusmaterial/'.$isi->replid.'/'.$row->replid)."')) class='btn btn-xs btn-danger fa fa-minus-square' ></a>";
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
								    echo "<a href=javascript:void(window.open('".site_url('permintaan_barang/tambah/'.$isi->replid)."')) class='btn btn-warning'>Ubah</a>&nbsp;&nbsp;";
										echo "<a href=javascript:void(window.open('".site_url('permintaan_barang/hapus/'.$isi->replid)."')) class='btn btn-danger' id='btnOpenDialog'>Hapus</a>&nbsp;&nbsp;";
								  }

	                        }

											if (ISSET($_SERVER['HTTP_REFERER'])){
													echo "<a href='".$_SERVER['HTTP_REFERER']."' class='btn btn-success'>Kembali</a>&nbsp;&nbsp;";
											}else{
													echo "<a href=javascript:void(window.open('".site_url('permintaan_barang')."')) class='btn btn-success'>Kembali</a>&nbsp;&nbsp;";
											}
	                    ?>

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
			var jumlah = document.getElementById("jumlah").value;
			var harga = document.getElementById("harga").value;
			var hargatotal = document.getElementById("hargatotal").value;

			document.getElementById("hargatotal").value = jumlah*harga;
		}

		function hitungharga2()
		{
			var jumlah = document.getElementById("jumlah").value;
			var harga = document.getElementById("harga").value;
			var hargatotal = document.getElementById("hargatotal").value;

			document.getElementById("harga").value = hargatotal/jumlah;
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
													if($isi->idmaterial<>""){
														echo $isi->materialtext;
														 echo "<input type='hidden' name='idmaterial' value='".$isi->idmaterial ."'>";
											 }else{
												 ?>
												 <input type="search" class='autocomplete' id="autocomplete1" name="nama_material" data-rule-required=true data-rule-maxlength=200 data-rule-minlength=2 placeholder="Masukkan 2-200 Karakter" value="<?php echo $isi->materialtext ?>"/>
												 <input type="hidden" name="idmaterial" id="idmaterial" data-rule-required=true data-rule-minlength=2 value="<?php echo $isi->idmaterial ?>" >
												 <!--inventory/ubahmaterial
													&nbsp;&nbsp; <a href="javascript:void(window.open('<?php echo site_url('permintaan_barang/tambahmaterialnew/'.$idx.'/'); ?>'))"><i class="fa fa-plus-square"></i> Tambah</a>
													-->
													<?php

											 }
												 ?>
								</div>
			        		</div>
			            </th></tr>
				        <tr>
				            <th align="left">
		                		<label class="control-label" for="minlengthfield">Jumlah</label>
		                		<div class="control-group">
									<div class="controls">:
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
		                      <label class="control-label" for="minlengthfield">Harga Perkiraan</label>
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
									<!--
									<tr>
				            <th align="left">
				        		<label class="control-label" for="minlengthfield">Vendor</label>
				        		<div class="control-group">
									<div class="controls">:
				                	<?php
				                		$arridvendor='data-rule-required=false';
				                		echo form_dropdown('idvendor',$idvendor_opt,$isi->idvendor,$arridvendor);
				                	?>
									</div>
				        		</div>
				            </th></tr>
									-->
										<tr>
					            <th align="left">
					        		<label class="control-label" for="minlengthfield">Peruntukan</label>
					        		<div class="control-group">
										<div class="controls">:
					                	<?php
					                		$arridperuntukan='data-rule-required=true';
					                		echo form_dropdown('idperuntukan',$idperuntukan_opt,$isi->idperuntukan,$arridperuntukan);
					                	?>
										</div>
					        		</div>
					            </th></tr>
										<tr>
								            <th align="left">
						                		<label class="control-label" for="minlengthfield">Keterangan</label>
						                		<div class="control-group">
													<div class="controls" valign="top">&nbsp;&nbsp;
								                	<?php
								                		echo form_textarea(array('class' => '', 'id' => 'peruntukan','name'=>'peruntukan','value'=>$isi->peruntukan,'data-rule-required'=>'false' ,'data-rule-maxlength'=>'500', 'data-rule-minlength'=>'2' ,'placeholder'=>'Masukkan 2-500 Karakter'));
								                	?>
								                	<?php //echo  <p id="message"></p> ?>
													</div>
						                		</div>
								            </th></tr>
				        <tr>
				            <th align="left">
				            	<button class='btn btn-primary' onclick="return validate()">Simpan</button>
				            	<a href="<?php echo $_SERVER['HTTP_REFERER'] ?>" class="btn btn-success">Kembali</a>
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
