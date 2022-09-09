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
                        <li><a href="javascript:void(window.open('<?php echo site_url('hrm_codeofconduct/tambah'); ?>'))"><i class="fa fa-plus-square"></i> Tambah</a></li>

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
                                                <th width="50">No.</th>
                                                <th width="200">Subjek</th>
                                                <th width="200">Tipe</th>
                                                <th>Isi hrm_codeofconduct</th>
                                                <th>Tanggal Dibuat</th>
                                                <th>Tanggal Diubah</th>
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
											    echo "<td align='center'>
											    			<a href=javascript:void(window.open('".site_url('hrm_codeofconduct/view/'.$row->replid)."'))>".$row->subjek."</a>
											    	  </td>";
                          echo "<td align='left'>".$row->tipe."</td>";
                          echo "<td align='left'>".$row->isi_hrm_codeofconduct."</td>";
											    echo "<td align='center'>".strtoupper($CI->p_c->tgl_indo($row->created_date))."</td>";
											    echo "<td align='center'>".strtoupper($CI->p_c->tgl_indo($row->modified_date))."</td>";
											    echo "<td align='center'>".$CI->p_c->cekaktif($row->aktif)."</td>";
											    echo "<td align='center'>
											    		<a href=javascript:void(window.open('".site_url('hrm_codeofconduct/ubah/'.$row->replid)."')) class='btn btn-xs btn-warning fa fa-check-square'></a>&nbsp;&nbsp;
											    		<a href=javascript:void(window.open('".site_url('hrm_codeofconduct/hapus/'.$row->replid)."')) class='btn btn-xs btn-danger fa fa-minus-square'></a>
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
			        $attributes = array('class' => 'form-horizontal form-validate', 'id' => 'form', 'method' => 'POST');
		    	echo form_open($action,$attributes);
		    	?>
		    	<table width="100%" border="0">
		    		<tr>
		            <th align="left">
	                		<label class="control-label" for="minlengthfield">Subjek</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		echo form_input(array('class' => '', 'id' => 'subjek','name'=>'subjek','value'=>$isi->subjek,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'2' ,'placeholder'=>'Masukkan 2-100 Karakter'));
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
                                          $arrtipe='data-rule-required=true';
                                          $tipe_opt = array(""=>"Pilih...","main"=>"Main","ppdbonline"=>"PPDB Online","prosedurpendaftaran"=>"Prosedur Pendaftaran");
                                          echo form_dropdown('tipe',$tipe_opt,$isi->tipe,$arrtipe);
                                        ?>
                                        <?php //echo  <p id="message"></p> ?>
                                </div>
                            </div>
                        </th></tr>
			        <tr>
			            <th align="left">
	                		<label class="control-label" for="minlengthfield">Isi hrm_codeofconduct</label>
	                		<div class="control-group">
								<div class="controls">:
			                	</div>
							</div>
			            </th>
			        </tr>
			        <tr>
			        	<th>
                            <div class='box-body pad'>
                                    <textarea id="editor1" name="isi_hrm_codeofconduct" rows="10" cols="80" data-rule-required="true">
                                        <?php echo $isi->isi_hrm_codeofconduct?>
                                    </textarea>
                                    <script type="text/javascript">CKEDITOR.replace('editor1');</script>
                            </div>
                            <?php //echo  <p id="message"></p> ?>
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
				            	<button class="btn btn-primary">Simpan</button>
				            	<a href="javascript:void(window.open('<?php echo site_url('hrm_codeofconduct') ?>'))" class="btn btn-success">Batal</a>
				            </th>
				    </tr>
		            </table>
		        	<?php
		        	echo form_close();
		        	?>
	    </section>
<?php } elseif($view=='tujuan'){ ?>
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
	        		<label class="control-label" for="minlengthfield">Subjek hrm_codeofconduct</label>
	        		<div class="control-group">
						<div class="controls">:
	                	<?php
	                		echo $isi->subjek;
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
	                		echo $CI->p_c->cekaktif($isi->aktif);
	                	?>
						</div>
	        		</div>
	        		<hr />
	            </th></tr>
<!--------------------------------------------------------------------------------------------------------------------------->
	    		<tr>
	            <th align="left">
	        		<label class="control-label" for="minlengthfield">Peran</label>
	        		<div class="control-group">
						<div class="controls">
						<input type="checkbox" onClick="selectallx('idrole','selectall')" id="selectall" class="selectall"/> Pilih Semua <hr/>

	                	<?php
	                		$CI->p_c->checkbox_one('idrole',$idrole_opt)
	                	?>
	                	<?php //echo  <p id="message"></p> ?>
						</div>
	        		</div>
	            </th></tr>
	            </table>
	            <table border="0">
		            <tr align="left">
			            <td><button class='btn btn-primary'>Simpan</button></td>
		            </tr>
	            </table>
            </section>
	        	<?php
	        	echo form_close();
} elseif($view=='view'){ ?>
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
	        		<label class="control-label" for="minlengthfield">Subjek hrm_codeofconduct</label>
	        		<div class="control-group">
						<div class="controls">:
	                	<?php
	                		echo $isi->subjek;
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
	                		echo $CI->p_c->cekaktif($isi->aktif);
	                	?>
						</div>
	        		</div>
	        		<hr />
	            </th><tr>
<!--------------------------------------------------------------------------------------------------------------------------->
	    		<tr>
	            <th align="left">
	        		<label class="control-label" for="minlengthfield">Peran</label>
	        		<div class="control-group">
						<div class="controls">
	                	<?php
	                		$CI->p_c->checkbox_one('idrole',$idrole_opt,'disabled')
	                	?>
	                	<?php //echo  <p id="message"></p> ?>
						</div>
	        		</div>
	            </th></tr>
	            <tr>
		            <td align="left">
		            	<a href='#' onclick='window.close();' class='btn btn-success'>Tutup</a>
		            	<a href="javascript:void(window.open('<?php echo site_url("hrm_codeofconduct/ubah/".$id) ?>'))" class="btn btn-warning">Ubah</a>
		            	<a href="javascript:void(window.open('<?php echo site_url('hrm_codeofconduct/hapus/'.$id) ?>'))" class="btn btn-danger">Hapus</a>
		            </td>
	            </tr>
	            </table>
            </section>
	        	<?php
	        	echo form_close();
 } ?>
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
    </body>
</html>
