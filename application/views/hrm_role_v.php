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
                        <li><a href="javascript:void(window.open('<?php echo site_url('hrm_role/tambah'); ?>'))" ><i class="fa fa-plus-square"></i> Tambah</a></li>

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
                                                <th>Peran</th>
                                                <th>Atasan Langsung</th>
                                                <th>Keterangan</th>
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
											    			<a href=javascript:void(window.open('".site_url('hrm_role/view/'.$row->replid)."')) >".strtoupper($row->role)."</a>
											    	  </td>";
                          echo "<td align='center'>".($row->roletext)."</td>";
                          echo "<td align='center'>".strtoupper($row->keterangan)."</td>";
											    echo "<td align='center'>".$CI->p_c->cekaktif($row->aktif)."</td>";
											    echo "<td align='center'>";
                          echo "<a href=javascript:void(window.open('".site_url('hrm_role/ubah/'.$row->replid)."')) class='btn btn-xs btn-warning fa fa-check-square' ></a>&nbsp;&nbsp;";
                          echo "<a href=javascript:void(window.open('".site_url('hrm_role/hapus/'.$row->replid)."')) class='btn btn-xs btn-danger fa fa-minus-square' ></a>";
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
	                		<label class="control-label" for="minlengthfield">Peran</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		echo form_input(array('class' => '', 'id' => 'role','name'=>'role','value'=>$isi->role,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'2' ,'placeholder'=>'Masukkan 2-100 Karakter'));
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th></tr>
              <tr>
                <th align="left">
                <label class="control-label" for="minlengthfield">Atasan Langsung</label>
                <div class="control-group">
                    <div class="controls">:
                      <?php
                        $arridatasan='data-rule-required=false';
                        echo form_dropdown('idatasan',$idatasan_opt,$isi->idatasan,$arridatasan);
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
			         <tr>
				            <th align="left">
				            	<button class='btn btn-primary' onclick="return validate()">Simpan</button>
				            	<a href="javascript:void(window.open('<?php echo site_url('hrm_role') ?>'))" class="btn btn-success">Batal</a>
				            </th>
				    </tr>
		            </table>
		        	<?php
		        	echo form_close();
		        	?>
	    </section>
<?php } elseif($view=='role_map'){ ?>
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
	        		<label class="control-label" for="minlengthfield">Peran</label>
	        		<div class="control-group">
						<div class="controls">:
	                	<?php
	                		echo $isi->role;
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
	            </th></tr>
	            <tr>
	            <th align="left">
	        		<label class="control-label" for="minlengthfield">Keterangan</label>
	        		<div class="control-group">
						<div class="controls">:
	                	<?php
	                		echo $isi->keterangan;
	                	?>
						</div>
	        		</div>
	        		<hr />
	            </th></tr>
<!--------------------------------------------------------------------------------------------------------------------------->
	    		<tr>
	            <th align="left">
	        		<label class="control-label" for="minlengthfield">Sub Menu</label>
	        		<div class="control-group">
	        			<div class="controls">
	                	<input type="checkbox" onClick="selectallx('sub_menu','selectall')" id="selectall" class="selectall"/> Pilih Semua <hr/>
	                	<?php
	                		$CI->p_c->checkbox_one('sub_menu',$sub_menu_opt)
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
}elseif($view=='role_map_sip'){ ?>
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
	        		<label class="control-label" for="minlengthfield">Peran</label>
	        		<div class="control-group">
						<div class="controls">:
	                	<?php
	                		echo $isi->role;
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
	            </th></tr>
	            <tr>
	            <th align="left">
	        		<label class="control-label" for="minlengthfield">Keterangan</label>
	        		<div class="control-group">
						<div class="controls">:
	                	<?php
	                		echo $isi->keterangan;
	                	?>
						</div>
	        		</div>
	        		<hr />
	            </th></tr>
<!--------------------------------------------------------------------------------------------------------------------------->
	    		<tr>
	            <th align="left">
	        		<label class="control-label" for="minlengthfield">Sub Menu SIP</label>
	        		<div class="control-group">
						<div class="controls">
						<input type="checkbox" onClick="selectallx('sub_menu','selectall')" id="selectall" class="selectall"/> Pilih Semua <hr/>
	                	<?php
	                		$CI->p_c->checkbox_one('sub_menu',$sub_menu_sip_opt)
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
	        		<label class="control-label" for="minlengthfield">Peran</label>
	        		<div class="control-group">
						<div class="controls">:
	                	<?php
	                		echo $isi->role;
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
	            </th></tr>
	            <tr>
	            <th align="left">
	        		<label class="control-label" for="minlengthfield">Keterangan</label>
	        		<div class="control-group">
						<div class="controls">:
	                	<?php
	                		echo $isi->keterangan;
	                	?>
						</div>
	        		</div>
	        		<hr />
	            </th></tr>
<!--------------------------------------------------------------------------------------------------------------------------->
	    		<tr>
	            <th align="left">
	        		<label class="control-label" for="minlengthfield">Sub Menu</label>
	        		<div class="control-group">
						<div class="controls">
	                	<?php
	                		$CI->p_c->checkbox_one('sub_menu',$sub_menu_opt,'disabled')
	                	?>
	                	<?php //echo  <p id="message"></p> ?>
						</div>
	        		</div>
	            </th></tr>

	            <tr>
	            <th align="left">
	        		<label class="control-label" for="minlengthfield">Sub Menu SIP</label>
	        		<div class="control-group">
						<div class="controls">
	                	<?php
	                		$CI->p_c->checkbox_one('sub_menu',$sub_menu_sip_opt,'disabled')
	                	?>
	                	<?php //echo  <p id="message"></p> ?>
						</div>
	        		</div>
	            </th></tr>

	            <tr>
		            <td align="left">
		            	<a href="javascript:void(window.open('<?php echo site_url("hrm_role/ubah/".$id) ?>'))" class="btn btn-warning">Ubah</a>
			            <a href="javascript:void(window.open('<?php echo site_url("hrm_role") ?>'))" class="btn btn-success">Kembali</a>
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
