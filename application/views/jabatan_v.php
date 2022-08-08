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
                        <li><a href="javascript:void(window.open('<?php echo site_url('jabatan/tambah'); ?>'))" ><i class="fa fa-plus-square"></i> Tambah</a></li>

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
                                                <th width="80">No.</th>
                                                <th>Jabatan</th>
                                                <th>Grup Jabatan</th>
                                                <th>Atasan Langsung</th>
                                                <th>Departemen</th>
                                                <th>Aktif</th>
                                                <th width="80">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        	<?php
                                        	$CI =& get_instance();
                                        	$no=1;
											foreach((array)$show_table as $row) {
											    echo "<tr>";
											    echo "<td align='center'>".$no++."</td>";
											    echo "<td align='center'>".strtoupper($row->jabatan)."</td>";
											    echo "<td align='center'>".strtoupper($row->idjabatan_grup)."</td>";
											    echo "<td align='center'>".strtoupper($row->idkepala_jabatan)."</td>";
											    echo "<td align='center'>".strtoupper($row->iddepartemen)."</td>";
											    echo "<td align='center'>".$CI->p_c->cekaktif($row->aktif)."</td>";
											    echo "<td align='center'>";
													echo "<a href=javascript:void(window.open('".site_url('jabatan/ubah/'.$row->replid)."')) class='btn btn-xs btn-warning fa fa-check-square' ></a>&nbsp;&nbsp;";
													echo "<a href=javascript:void(window.open('".site_url('jabatan/hapus/'.$row->replid)."')) class='btn btn-xs btn-danger fa fa-minus-square' ></a>";
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
	                		<label class="control-label" for="minlengthfield">Jabatan</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		echo form_input(array('class' => '', 'id' => 'jabatan','name'=>'jabatan','value'=>$isi->jabatan,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'2' ,'placeholder'=>'Masukkan 2-100 Karakter'));
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th></tr>
			        <tr>
		            <th align="left">
		        		<label class="control-label" for="minlengthfield">Grup Jabatan</label>
		        		<div class="control-group">
							<div class="controls">:
		                	<?php
		                		$arrjabatan_grup='data-rule-required=true';
		                		echo form_dropdown('idjabatan_grup',$jabatan_grup_opt,$isi->idjabatan_grup,$arrjabatan_grup);
		                	?>
							</div>
		        		</div>
		            </th></tr>
		            <tr>
		            <th align="left">
		        		<label class="control-label" for="minlengthfield">Atasan Langsung</label>
		        		<div class="control-group">
							<div class="controls">:
		                	<?php
		                		$arridkepala_jabatan='data-rule-required=false';
		                		echo form_dropdown('idkepala_jabatan',$idkepala_jabatan_opt,$isi->idkepala_jabatan,$arridkepala_jabatan);
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
		                		$arrdepartemen='data-rule-required=false';
		                		echo form_dropdown('iddepartemen',$departemen_opt,$isi->iddepartemen,$arrdepartemen);
		                	?>
							</div>
		        		</div>
		            </th></tr>
			        <tr>
		            <th align="left">
		        		<label class="control-label" for="minlengthfield">Aktif</label>
		        		<div class="control-group">
							<div class="controls">:
		                	<?php
		                		echo form_checkbox('aktif', '1', $isi->aktif);
		                	?>
		                	<?php //echo  <p id="message"></p> ?>
							</div>
		        		</div>
		            </th></tr>
			         <tr>
				            <th align="left">
				            	<button class='btn btn-primary' onclick="return validate()">Simpan</button>
				            	<a href="javascript:void(window.open('<?php echo site_url('jabatan') ?>'))" class="btn btn-success">Batal</a>
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
		        <?php
			        $attributes = array('class' => 'form-horizontal form-validate', 'id' => 'form', 'method' => 'POST', 'novalidate'=>'novalidate');
		    	echo form_open($action,$attributes);
		    	?>
		    	<table width="100%" border="0">
		    		<tr>
		            <th align="left">
	                		<label class="control-label" for="minlengthfield">Jabatan</label>
	                		<div class="control-group">
								<div class="controls">:
								<?php echo strtoupper($isi->jabatan);?>
								</div>
	                		</div>
			            </th></tr>
			        <tr>
		            <th align="left">
		        		<label class="control-label" for="minlengthfield">Grup Jabatan</label>
		        		<div class="control-group">
							<div class="controls">:
								<?php echo strtoupper($isi->idjabatan_grup);?>
							</div>
		        		</div>
		            </th></tr>
		            <tr>
		            <th align="left">
		        		<label class="control-label" for="minlengthfield">Kepala Jabatan</label>
		        		<div class="control-group">
							<div class="controls">:
								<?php echo strtoupper($isi->idkepala_jabatan);?>
							</div>
		        		</div>
		            </th></tr>
		            <tr>
		            <th align="left">
		        		<label class="control-label" for="minlengthfield">Departemen</label>
		        		<div class="control-group">
							<div class="controls">:
								<?php echo strtoupper($isi->iddepartemen);?>
							</div>
		        		</div>
		            </th></tr>
			        <tr>
		            <th align="left">
		        		<label class="control-label" for="minlengthfield">Aktif</label>
		        		<div class="control-group">
							<div class="controls">:
								<?php echo ($CI->p_c->cekaktif($isi->aktif));?>
							</div>
		        		</div>
		            </th></tr>
				     <tr>
				     	<td>
				     		<section class="content-header" align="right">
		                    <ol class="breadcrumb">
		                        <li><a href="javascript:void(window.open('<?php echo site_url('jabatan/tambahkompetensi/'.$id); ?>'))" ><i class="fa fa-plus-square"></i> Tambah</a></li>
		                    </ol>
				     		</section>
		                    <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th width="50">No.</th>
                                        <th>Kompetensi</th>
                                        <th width="100">Max. Skor</th>
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
									    echo "<tr align='left'>";
									    echo "<td align='center'>".$no++."</td>";
									    echo "<td>".strtoupper($row->idkompetensi)."</td>";
									    echo "<td align='center'>".$row->max_skor."</td>";
									    if ($view2<>1){
										    echo "<td align='center'>";
										    if ($row->umum<>1){
										    	echo "<a href=javascript:void(window.open('".site_url("jabatan/hapuskompetensi/".$id."/".$row->replid)."')) class='btn btn-xs btn-danger fa fa-minus-square' ></a>";
										    }
										    echo "</td>";
									    }
									    echo "</tr>";
									}
									?>
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
				            	<?php
				            	if ($view2<>1){
					            	//echo "<button class='btn btn-primary'>Simpan</button>&nbsp;&nbsp;";
					            	echo "<a href=javascript:void(window.open('".site_url('jabatan')."')) class='btn btn-success'>Selesai</a>";
					            }else{
						         	//echo "<a href=javascript:void(window.open('".site_url('kontrak/ubah/'.$isi->replid)."') class='btn btn-xs btn-warning'>&nbsp;&nbsp;Ubah&nbsp;&nbsp;</a> ";
						         	echo "<a href=javascript:void(window.open('".site_url('jabatan')."')) class='btn btn-success'>Kembali</a>";
					            }
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
		    	<table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th width="50">&nbsp;</th>
                        <th>Kompetensi</th>
                    </tr>
                </thead>
                <tbody>
                	<?php
                	$CI =& get_instance();$skor=0;$avg=0;
                	$no=1;$allkompetensi="";
					foreach((array)$isi as $row) {
						$check="";
						if ($no>1){$allkompetensi=$allkompetensi.",";}
						$allkompetensi=$allkompetensi.$row->replid;

						if ($row->idkompetensi<>""){
							$check="checked=checked";
						}
					    echo "<tr align='left'>";
					    echo "<td align='center'><input type='checkbox' name='idkompetensi".$row->replid."' value=1 ".$check."></td>";
					    echo "<td>".strtoupper($row->kompetensi)."</td>";
					    echo "</tr>";
					    $no++;
					}
					?>

					<tr>
				            <th align="left" colspan="2">
				            	<input type="hidden" name="allkompetensi" value="<?php echo $allkompetensi; ?>">
				            	<?php
					            	echo "<button class='btn btn-primary'>Simpan</button>&nbsp;&nbsp;";
					            	echo "<a href=javascript:void(window.open('".site_url('jabatan/kompetensi/'.$id)."')) class='btn btn-success'>Kembali</a>";
				            	?>
				            </th>
				    </tr>
                </tbody>
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
