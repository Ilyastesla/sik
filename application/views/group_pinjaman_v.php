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
                        <li><a href="javascript:void(window.open('<?php echo site_url('group_pinjaman/tambah'); ?>'))"><i class="fa fa-plus-square"></i> Tambah</a></li>

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
                                                <th>Grup Pinjaman</th>
                                                <th>Jabatan</th>
                                                <th>Jenis Pinjaman</th>
                                                <th>Limit Pinjaman</th>
                                                <th>Aktif</th>
                                                <th width="80">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        	<?php
                                        	$CI =& get_instance();$no=1;
											foreach((array)$show_table as $row) {
											    echo "<tr>";
											    echo "<td align='center'>".$no++."</td>";
											    echo "<td align='center'>".strtoupper($row->group_pinjaman)."</td>";
											    echo "<td align='center'>".strtoupper($row->idjabatan)."</td>";
											    echo "<td align='center'>".strtoupper($row->idjenis_pinjaman)."</td>";
											    echo "<td align='center'>".$CI->p_c->rupiah($row->limit_pinjaman)."</td>";
											    echo "<td align='center'>".$CI->p_c->cekaktif($row->aktif)."</td>";
											    echo "<td align='center'>
											    		<a href=javascript:void(window.open('".site_url('group_pinjaman/ubah/'.$row->replid)."')) class='btn btn-xs btn-warning fa fa-check-square'></a>&nbsp;
											    		<a href=javascript:void(window.open('".site_url('group_pinjaman/hapus/'.$row->replid)."')) class='btn btn-xs btn-danger' >Hapus</a>
											    		</td>";
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
	                		<label class="control-label" for="minlengthfield">Grup Pinjaman</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		echo form_input(array('class' => '', 'id' => 'group_pinjaman','name'=>'group_pinjaman','value'=>$isi->group_pinjaman,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'2' ,'placeholder'=>'Masukkan 2-100 Karakter'));
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th></tr>
			        <th align="left">
		        		<label class="control-label" for="minlengthfield">Jabatan</label>
		        		<div class="control-group">
							<div class="controls">:
		                	<?php
		                		$arrjabatan='data-rule-required=true';
		                		echo form_dropdown('idjabatan',$jabatan_opt,$isi->idjabatan,$arrjabatan);
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
		                		<label class="control-label" for="minlengthfield">Limit Pinjaman</label>
		                		<div class="control-group">
									<div class="controls">:
				                	<?php
				                		echo form_input(array('id' => 'limit_pinjaman','name'=>'limit_pinjaman','value'=>$isi->limit_pinjaman,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'10', 'data-rule-minlength'=>'2','data-rule-number'=>'true','placeholder'=>'Masukkan 2-10 Karakter'));
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
			         <tr>
				            <th align="left">
				            	<button class='btn btn-primary' onclick="return validate()">Simpan</button>
				            	<a href="javascript:void(window.open('<?php echo site_url('group_pinjaman') ?>'))" class="btn btn-success">Batal</a>
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
