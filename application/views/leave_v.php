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
		                        <li><a href="javascript:void(window.open('<?php echo site_url('leave/ubahleave'); ?>'))" ><i class="fa fa-plus-square"></i> Tambah</a></li>
		                    </ol>
		                </section>

	                	<table id="example1" class="table table-bordered table-striped">
	                        <thead>
	                            <tr>
	                                <th>Nama Pegawai</th>
	                                <th>Tipe Izin</th>
	                                <th>Tanggal Mulai</th>
	                                <th>Tanggal Akhir</th>
	                                <th>Disetujui</th>
	                                <th>aktif</th>
	                                <th>Aksi</th>
	                            </tr>

	                        </thead>
	                        <tbody>
	                        	<?php
	                        	$CI =& get_instance();
								foreach((array)$data_table as $rowx) {
								    echo "<tr>";
								    	echo "<td align='center'>".strtoupper($rowx->nama)."</td>";
								    	echo "<td align='center'>".strtoupper($rowx->leave_type_id)."</td>";
								    	echo "<td align='center'>".strtoupper($CI->p_c->tgl_jam($rowx->begin_date))."</td>";
								    	echo "<td align='center'>".strtoupper($CI->p_c->tgl_jam($rowx->end_date))."</td>";
								    	echo "<td align='center'>".strtoupper($rowx->approved)."</td>";
								    	echo "<td align='center'>".($CI->p_c->cekaktif($rowx->aktif))."</td>";
									    echo "<td align='center' width='150'>";
										echo '<a href='.site_url('leave/ubahleave/'.$rowx->replid).' class="btn btn-warning">Ubah</a>';
									    echo '&nbsp;&nbsp;<a href='.site_url('leave/hapusleave_p/'.$rowx->replid).'  class="btn btn-danger">Hapus</a>';
									    echo "</td>";
								    echo "</tr>";
								}
								?>
	                        </tbody>
	                        <tfoot>
	                        </tfoot>
	                	</table>
		            </section>
		        <?php } elseif($view=='ubah_leave'){?>
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
	                		<label class="control-label" for="minlengthfield">Pegawai</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		$arrpeg='data-rule-required=true';
			                		echo form_dropdown('pegawai_id',$pegawai_opt,$isi->pegawai_id,$arrpeg);
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th></tr>
			            <tr>
			            <th align="left">
	                		<label class="control-label" for="minlengthfield">Tipe Izin</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		$arrlt='data-rule-required=true';
			                		echo form_dropdown('leave_type_id',$leave_type_opt,$isi->leave_type_id,$arrlt);
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th></tr>
			            <tr>
			            <th align="left">
	                		<label class="control-label" for="minlengthfield">Jadwal</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		echo form_input(array('class' => '', 'id' => 'reservationtime','name'=>'jadwal','value'=>$isi->jadwal,'style'=>'width:50%','data-rule-required'=>'false' ,'data-rule-maxlength'=>'200', 'data-rule-minlength'=>'2','data-rule-number'=>'false' ,'placeholder'=>'Masukkan 2-10 Karakter'));
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
			        <?php } if($view=='leave_type'){?>
	                <section class="content-header table-responsive">
	                    <h1>
	                        <?php echo $form ?>
	                     </h1>
	                </section>

	                <!-- Main content -->
	                <section class="content">
	                	<section class="content-header" align="right">
		                    <ol class="breadcrumb">
		                        <li><a href="javascript:void(window.open('<?php echo site_url('leave/ubahleavetype'); ?>'))" ><i class="fa fa-plus-square"></i> Tambah</a></li>
		                    </ol>
		                </section>

	                	<table id="example1" class="table table-bordered table-striped">
	                        <thead>
	                            <tr>
	                                <th>Nama</th>
	                                <th>aktif</th>
	                                <th>Aksi</th>
	                            </tr>

	                        </thead>
	                        <tbody>
	                        	<?php
	                        	$CI =& get_instance();
								foreach((array)$data_table as $rowx) {
								    echo "<tr>";
								    	echo "<td align='center'>".$rowx->reff."</td>";
								    	echo "<td align='center'>".$CI->p_c->cekaktif($rowx->aktif)."</td>";
									    echo "<td align='center' width='150'>";
										echo '<a href='.site_url('leave/ubahleavetype/'.$rowx->replid).' class="btn btn-warning">Ubah</a>';
									    echo '&nbsp;&nbsp;<a href='.site_url('leave/hapusleavetype_p/'.$rowx->replid).'  class="btn btn-danger">Hapus</a>';
									    echo "</td>";
								    echo "</tr>";
								}
								?>
	                        </tbody>
	                        <tfoot>
	                        </tfoot>
	                	</table>
		            </section>
                <?php } ?>
           </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
    </body>
</html>
