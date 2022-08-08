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
                <?php

                $CI =& get_instance();
                if($view=='index'){?>

                <section class="content-header table-responsive">
                    <h1>
                        <?php echo $form ?>
                     </h1>
                </section>

                <!-- Main content -->
                <section class="content">
	                	<section class="content-header" align="right">
		                    <ol class="breadcrumb">
		                        <li><a href="javascript:void(window.open('<?php echo site_url('salary/ubahsalary'); ?>'))" ><i class="fa fa-plus-square"></i> Tambah</a></li>
		                    </ol>
		                </section>

	                	<table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>NIP</th>
                                    <th>Nama</th>
                                    <th>Jabatan</th>
                                    <!-- <th>Aktif</th> -->
                                    <th>Aksi</th>
                                </tr>

                            </thead>
                            <tbody>
                            	<?php
                            	$CI =& get_instance();
								foreach((array)$data_table as $rowx) {
								    echo "<tr>";
								    	echo "<td align='center'>".strtoupper($rowx->nip)."</td>";
								    	echo "<td align='center'>".strtoupper($rowx->nama)."</td>";
								    	echo "<td align='center'>".strtoupper($rowx->jabatan)."</td>";
								    	//echo "<td align='center'>".($CI->p_c->cekaktif($rowx->aktif))."</td>";
									    echo "<td align='center' width='150'>";
										echo '<a href='.site_url('salary/ubahsalary/'.$rowx->replid).' class="btn btn-warning">Ubah</a>';
									    echo '&nbsp;&nbsp;<a href='.site_url('salary/hapussalary_p/'.$rowx->replid).'  class="btn btn-danger">Hapus</a>';
									    echo "</td>";
								    echo "</tr>";
								}
								?>
                            </tbody>
                            <tfoot>
                            </tfoot>
	                	</table>
                <?php } if($view=='allowance'){ ?>
                <section class="content-header table-responsive">
                    <h1>
                        <?php echo $form ?>
                     </h1>
                    <ol class="breadcrumb">
                        <li><a href="javascript:void(window.open('<?php echo site_url('salary/ubahallowance'); ?>'))" ><i class="fa fa-plus-square"></i> Tambah</a></li>                        <!--
                        <li><a href="#"><i class="fa fa-file-text"></i>Cetak</a></li>
                        <li><a href="#"><i class="fa fa-file-excel-o"></i>Excel</a></li>
                        -->
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
	                	<table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Nilai</th>
                                    <th>Tanggal Efektif</th>
                                    <th>Keterangan</th>
                                    <th>Aktif</th>
                                    <th>Aksi</th>
                                </tr>

                            </thead>
                            <tbody>
                            	<?php
                            	$CI =& get_instance();
								foreach((array)$data_table as $rowx) {
								    echo "<tr>";
								    	echo "<td align='center'>".$rowx->nama."</td>";
								    	echo "<td align='right'>Rp. ".$rowx->nilai."</td>";
								    	echo "<td align='center'>".$CI->p_c->tgl_indo($rowx->effective_date)."</td>";
								    	echo "<td align='center'>".$rowx->keterangan."</td>";
								    	echo "<td align='center'>".$CI->p_c->cekaktif($rowx->aktif)."</td>";
									    echo "<td align='center' width='150'>";
										echo '<a href='.site_url('salary/ubahallowance/'.$rowx->replid).' class="btn btn-warning">Ubah</a>';
									    echo '&nbsp;&nbsp;<a href='.site_url('salary/hapusallowance_p/'.$rowx->replid).'  class="btn btn-danger">Hapus</a>';
									    echo "</td>";
								    echo "</tr>";
								}

                ?>
                            </tbody>
                            <tfoot>
                            </tfoot>
	                	</table>
	                	<?php
               } elseif($view=='ubahallowance'){?>
	    	<section class="content-header table-responsive">
	            <h1>
	                <?php echo $form ?>
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
	                		<label class="control-label" for="minlengthfield">Nama</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		echo form_input(array('class' => '', 'id' => 'nama','name'=>'nama','value'=>$isi->nama,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'200', 'data-rule-minlength'=>'2' ,'placeholder'=>'Masukkan 2-200 Karakter','size'=>'15'));
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
			                		echo form_input(array('class' => '', 'id' => 'nilai','name'=>'nilai','value'=>$isi->nilai,'data-rule-required'=>'false' ,'data-rule-maxlength'=>'200', 'data-rule-minlength'=>'2','data-rule-number'=>'true' ,'placeholder'=>'Masukkan 2-10 Karakter'));
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th></tr>
			            <tr>
			            <th align="left">
	                		<label class="control-label" for="minlengthfield">Tanggal Efektif</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		echo form_input(array('class' => '', 'id' => 'dp2','name'=>'effective_date','value'=>$CI->p_c->tgl_form($isi->effective_date),'data-rule-required'=>'false' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'2' ,'placeholder'=>'DD-MM-YYYY','autocomplete'=>'off'));
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th></tr>

			            <tr>
			            <th align="left">
	                		<label class="control-label" for="minlengthfield">Keterangan</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		echo form_textarea(array('class' => '', 'id' => 'keterangan','name'=>'keterangan','value'=>$isi->keterangan,'data-rule-required'=>'false' ,'data-rule-maxlength'=>'500', 'data-rule-minlength'=>'2' ,'placeholder'=>'Masukkan 2-500 Karakter','size'=>'15'));
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
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
	            </table>
	        	<button class='btn btn-primary'>Simpan</button>
	        	<?php
	        	echo form_close();?>
	    </section><!-- /.content -->
	           	<?php } if($view=='deduction'){?>
                <section class="content-header table-responsive">
                    <h1>
                        <?php echo $form ?>
                     </h1>
                     <ol class="breadcrumb">
                        <li><a href="javascript:void(window.open('<?php echo site_url('salary/ubahdeduction'); ?>'))" ><i class="fa fa-plus-square"></i> Tambah</a></li>
                        <!--
                        <li><a href="#"><i class="fa fa-file-text"></i>Cetak</a></li>
                        <li><a href="#"><i class="fa fa-file-excel-o"></i>Excel</a></li>
                        -->
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
	                	<table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Nilai</th>
                                    <th>Tanggal Efektif</th>
                                    <th>Keterangan</th>
                                    <th>Aktif</th>
                                    <th>Aksi</th>
                                </tr>

                            </thead>
                            <tbody>
                            	<?php
                            	$CI =& get_instance();
								foreach((array)$data_table as $rowx) {
								    echo "<tr>";
								    	echo "<td align='center'>".$rowx->nama."</td>";
								    	echo "<td align='right'>Rp. ".$rowx->nilai."</td>";
								    	echo "<td align='center'>".$CI->p_c->tgl_indo($rowx->effective_date)."</td>";
								    	echo "<td align='center'>".$rowx->keterangan."</td>";
								    	echo "<td align='center'>".$CI->p_c->cekaktif($rowx->aktif)."</td>";
									    echo "<td align='center' width='150'>";
										echo '<a href='.site_url('salary/ubahdeduction/'.$rowx->replid).' class="btn btn-warning">Ubah</a>';
									    echo '&nbsp;&nbsp;<a href='.site_url('salary/hapusdeduction_p/'.$rowx->replid).'  class="btn btn-danger">Hapus</a>';
									    echo "</td>";
								    echo "</tr>";
								}

                ?>
                            </tbody>
                            <tfoot>
                            </tfoot>
	                	</table>
	                	<?php
               } elseif($view=='ubahdeduction'){?>
	    	<section class="content-header table-responsive">
	            <h1>
	                <?php echo $form ?>
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
	                		<label class="control-label" for="minlengthfield">Nama</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		echo form_input(array('class' => '', 'id' => 'nama','name'=>'nama','value'=>$isi->nama,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'200', 'data-rule-minlength'=>'2' ,'placeholder'=>'Masukkan 2-200 Karakter','size'=>'15'));
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
			                		echo form_input(array('class' => '', 'id' => 'nilai','name'=>'nilai','value'=>$isi->nilai,'data-rule-required'=>'false' ,'data-rule-maxlength'=>'200', 'data-rule-minlength'=>'2','data-rule-number'=>'true' ,'placeholder'=>'Masukkan 2-10 Karakter'));
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th></tr>
			            <tr>
			            <th align="left">
	                		<label class="control-label" for="minlengthfield">Tanggal Efektif</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		echo form_input(array('class' => '', 'id' => 'dp2','name'=>'effective_date','value'=>$CI->p_c->tgl_form($isi->effective_date),'data-rule-required'=>'false' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'2' ,'placeholder'=>'DD-MM-YYYY','autocomplete'=>'off'));
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th></tr>

			            <tr>
			            <th align="left">
	                		<label class="control-label" for="minlengthfield">Keterangan</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		echo form_textarea(array('class' => '', 'id' => 'keterangan','name'=>'keterangan','value'=>$isi->keterangan,'data-rule-required'=>'false' ,'data-rule-maxlength'=>'500', 'data-rule-minlength'=>'2' ,'placeholder'=>'Masukkan 2-500 Karakter','size'=>'15'));
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
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
	            </table>
	        	<button class='btn btn-primary'>Simpan</button>
	        	<?php
	        	echo form_close();?>
	    </section><!-- /.content -->
	          <?php 	}elseif($view=='ubahsalary'){?>
	    	<section class="content-header table-responsive">
	            <h1>
	                <?php echo $form ?>
	             </h1>
	        </section>
	        <section class="content form-horizontal form-validate">
	    	<table width="100%" border="0">
	    		<tr>
	            <th align="left">
	        		<label class="control-label" for="minlengthfield">NIP</label>
	        		<div class="control-group">
						<div class="controls">:
	                	<?php
	                		echo $isi->nip;
	                	?>
						</div>
	        		</div>
	            </th></tr>
	            <tr>
	            <th align="left">
	        		<label class="control-label" for="minlengthfield">Nama</label>
	        		<div class="control-group">
						<div class="controls">:
	                	<?php
	                		echo $isi->nama;
	                	?>
						</div>
	        		</div>
	            </th></tr>
	    		<tr>
	            <th align="left">
	        		<label class="control-label" for="minlengthfield">Jabatan</label>
	        		<div class="control-group">
						<div class="controls">:
	                	<?php
	                		echo $isi->jabatan;
	                	?>
	                	<?php //echo  <p id="message"></p> ?>
						</div>
	        		</div>
	            </th></tr>
	            </table>
	            <br/>
	            <section class="content-header" align="right">
                    <ol class="breadcrumb">
                        <li><a href="javascript:void(window.open('<?php echo site_url('salary/ubah_user_allowance/'.$isi->replid); ?>'))"><i class="fa fa-plus-square"></i> Tambah Pendapatan</a></li>
                    </ol>
                </section>
	           <h4>Pendapatan</h4> <hr>
            	<table class="table table-bordered table-striped">
                <thead>
                    <tr>
                    	<th width='50'>No.</th>
                        <th>Nama Pendapatan</th>
                        <th>Tipe</th>
                        <th>Tanggal Efektif</th>
                        <th>Nilai</th>
                        <th width="80">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                	<?php
                	$jml_c=0;$no=1;
                	if (!empty($allowance)){
						foreach($allowance as $rowa) {
							$jml_c=$jml_c+$rowa->nilai;
						    echo "<tr>";
						    echo "<td align='center'>".$no++."</td>";
						    echo "<td align=''>".$rowa->allowance."</td>";
						    echo "<td align=''>".$rowa->type."</td>";
						    echo "<td align='center'>".$CI->p_c->tgl_indo($rowa->effective_date)."</td>";
						    echo "<td align='right'>".$CI->p_c->rupiah($rowa->nilai)."</td>";
						    echo "<td align='center'>";
                echo "<a href=javascript:void(window.open('".site_url('salary/ubah_user_allowance/'.$rowa->pegawai_id.'/'.$rowa->replid)."')) class='btn btn-xs btn-warning fa fa-check-square' ></a>&nbsp;&nbsp;";
                echo "<a href=javascript:void(window.open('".site_url('salary/hapususerallowance_p/'.$rowa->pegawai_id.'/'.$rowa->replid)."')) class='btn btn-danger' id='btnOpenDialog'>Hapus</a>";
                echo "</td>";
						    echo "</tr>";
						}
					}
					?>
						<!--
						<tr><th colspan="4"></th>
							<td align="right"><b><?php echo $CI->p_c->rupiah($jml_c)?></b></td>
						<th>&nbsp;</th>
						-->
					</tr>
                </tbody>
                <tfoot>
                </tfoot>
            </table>
            <br/>
	        <section class="content-header" align="right">
                    <ol class="breadcrumb">
                        <li><a href="javascript:void(window.open('<?php echo site_url('salary/ubah_user_deduction/'.$isi->replid); ?>'))"><i class="fa fa-plus-square"></i> Tambah Potongan</a></li>
                    </ol>
                </section>
	           <h4>Potongan</h4> <hr>
            	<table class="table table-bordered table-striped">
                <thead>
                    <tr>
                    	<th width='50'>No.</th>
                        <th>Nama Potongan</th>
                        <th>Tipe</th>
                        <th>Tanggal Efektif</th>
                        <th>Nilai</th>
                        <th width="80">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                	<?php
                	$jml_c=0;$no=1;
                	if (!empty($deduction)){
						foreach($deduction as $rowb) {
							$jml_c=$jml_c+$rowb->nilai;
						    echo "<tr>";
						    echo "<td align='center'>".$no++."</td>";
						    echo "<td align=''>".$rowb->deduction."</td>";
						    echo "<td align=''>".$rowb->type."</td>";
						    echo "<td align='center'>".$CI->p_c->tgl_indo($rowb->effective_date)."</td>";
						    echo "<td align='right'>".$CI->p_c->rupiah($rowb->nilai)."</td>";
						    echo "<td align='center'>
						    		<a href=javascript:void(window.open('".site_url('salary/ubah_user_deduction/'.$rowb->pegawai_id.'/'.$rowb->replid)."')) class='btn btn-xs btn-warning fa fa-check-square' ></a>&nbsp;&nbsp;";
						    		<a href=javascript:void(window.open('".site_url('salary/hapususerdeduction_p/'.$rowb->pegawai_id.'/'.$rowb->replid)."')) class='btn btn-xs btn-danger fa fa-minus-square' ></a>
						    		</td>";
						    echo "</tr>";
						}
					}
					?>
					<!--
					<tr><th colspan="4"></th>
						<td align="right"><b><?php echo $CI->p_c->rupiah($jml_c)?></b></td>
						<th>&nbsp;</th>
					</tr>
					-->
                </tbody>
                <tfoot>
                </tfoot>
            </table>
            </section><!-- /.content -->
	           	<?php }elseif($view=='ubahuserallowance'){ ?>
	           	<section class="content-header table-responsive">
	            <h1>
	                <?php echo $form ?>
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
                		<label class="control-label" for="minlengthfield">Nama Pendapatan</label>
                		<div class="control-group">
							<div class="controls">:
		                	<?php
		                		$arrallowance='data-rule-required=true';
		                		echo form_dropdown('allowance_id',$allowance_opt,$isi->allowance_id,$arrallowance);
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
		                		echo form_input(array('class' => '', 'id' => 'nilai','name'=>'nilai','value'=>$isi->nilai,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'11', 'data-rule-minlength'=>'1','data-rule-number'=>'true','placeholder'=>'Masukkan 0-11 Angka'));
		                	?>
		                	<?php //echo  <p id="message"></p> ?>
							</div>
                		</div>
		            </th></tr>
		        <tr>
		            <th align="left">
                		<label class="control-label" for="minlengthfield">Tipe</label>
                		<div class="control-group">
							<div class="controls">:
		                	<?php
		                		$arrtype='data-rule-required=true';
		                		echo form_dropdown('type_id',$type_opt,$isi->type_id,$arrtype);
		                	?>
		                	<?php //echo  <p id="message"></p> ?>
							</div>
                		</div>
		            </th></tr>
		        <tr>
		            <th align="left">
                		<label class="control-label" for="minlengthfield">Tgl. Efektif</label>
                		<div class="control-group">
							<div class="controls">:
		                	<?php
		                		echo form_input(array('class' => '', 'id' => 'dp1','name'=>'effective_date','value'=>$CI->p_c->tgl_form($isi->effective_date),'data-rule-required'=>'true' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'2' ,'placeholder'=>'DD-MM-YYYY','autocomplete'=>'off'));
		                	?>
		                	<?php //echo  <p id="message"></p> ?>
							</div>
                		</div>
		            </th></tr>
	        </table>
	        	<button class='btn btn-primary'>Simpan</button>
	        	<a href="javascript:void(window.open('<?php echo site_url('salary/ubahsalary/'.$id) ?>'))" class="btn btn-success">Batal</a>
	        	<?php
	        	echo form_close();?>
	    </section><!-- /.content -->
	           	<?php }elseif($view=='ubahuserdeduction'){ ?>
	           	<section class="content-header table-responsive">
	            <h1>
	                <?php echo $form ?>
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
                		<label class="control-label" for="minlengthfield">Nama Potongan</label>
                		<div class="control-group">
							<div class="controls">:
		                	<?php
		                		$arrdeduction='data-rule-required=true';
		                		echo form_dropdown('deduction_id',$deduction_opt,$isi->deduction_id,$arrdeduction);
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
		                		echo form_input(array('class' => '', 'id' => 'nilai','name'=>'nilai','value'=>$isi->nilai,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'11', 'data-rule-minlength'=>'1','data-rule-number'=>'true','placeholder'=>'Masukkan 0-11 Angka'));
		                	?>
		                	<?php //echo  <p id="message"></p> ?>
							</div>
                		</div>
		            </th></tr>
		            <tr>
		            <th align="left">
                		<label class="control-label" for="minlengthfield">Tipe</label>
                		<div class="control-group">
							<div class="controls">:
		                	<?php
		                		$arrtype='data-rule-required=true';
		                		echo form_dropdown('type_id',$type_opt,$isi->type_id,$arrtype);
		                	?>
		                	<?php //echo  <p id="message"></p> ?>
							</div>
                		</div>
		            </th></tr>
		        <tr>
		            <th align="left">
                		<label class="control-label" for="minlengthfield">Tgl. Efektif</label>
                		<div class="control-group">
							<div class="controls">:
		                	<?php
		                		echo form_input(array('class' => '', 'id' => 'dp1','name'=>'effective_date','value'=>$CI->p_c->tgl_form($isi->effective_date),'data-rule-required'=>'true' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'2' ,'placeholder'=>'DD-MM-YYYY','autocomplete'=>'off'));
		                	?>
		                	<?php //echo  <p id="message"></p> ?>
							</div>
                		</div>
		            </th></tr>
	        </table>
	        	<button class='btn btn-primary'>Simpan</button>
	        	<a href="javascript:void(window.open('<?php echo site_url('salary/ubahsalary/'.$id) ?>'))" class="btn btn-success">Batal</a>
	        	<?php
	        	echo form_close();?>
	    </section><!-- /.content -->
	           	<?php } ?>
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
    </body>
</html>
