<!DOCTYPE html>
<?php
	$ro="";
	if (isset($viewview)){
		$ro="'disabled'";
	}

?>
<html>
<script language="javascript">
function printsdk(id) {
	newWindow('../printsdk/'+id, 'printsdk','900','800','resizable=1,scrollbars=1,status=0,toolbar=0')
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
                <?php

                $CI =& get_instance();
if($view=='index'){?>
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
	    	<?php if ($this->session->flashdata('notif')<>"") { ?>
	    	<div class="alert alert-<?php echo $this->session->flashdata('notiftype') ?> alert-dismissable" align="left">
                <i class="fa fa-<?php echo $this->session->flashdata('notificon') ?>"></i>
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <b>Perhatian!</b> <?php echo $this->session->flashdata('notif') ?>..
            </div>
        <?php } ?>
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
	                		<label class="control-label" for="minlengthfield">Kata Sandi Lama</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		echo form_password(array('class' => '', 'id' => 'passwordlama','name'=>'passwordlama','data-rule-required'=>'true' ,'data-rule-maxlength'=>'500', 'data-rule-minlength'=>'6' ,'placeholder'=>'Masukkan 6-500 Karakter','size'=>'15'));
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th></tr>
	            <tr>
			            <th align="left">
	                		<label class="control-label" for="minlengthfield">Kata Sandi</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		echo form_password(array('class' => '', 'id' => 'password','name'=>'password','data-rule-required'=>'true' ,'data-rule-maxlength'=>'500', 'data-rule-minlength'=>'6' ,'placeholder'=>'Masukkan 6-500 Karakter','size'=>'15'));
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th></tr>
			            <tr>
			            <th align="left">
	                		<label class="control-label" for="minlengthfield">Konfirmasi Kata Sandi</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		echo form_password(array('class' => '', 'id' => 'password2','name'=>'password2','data-rule-required'=>'true' ,'data-rule-maxlength'=>'500', 'data-rule-minlength'=>'6' ,'placeholder'=>'Masukkan 6-500 Karakter','size'=>'15'));
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th></tr>
			            <tr>
				            <td align="left">
					            <input type="hidden" name="nip" value="<?php echo $isi->nip; ?>">
					            <button class='btn btn-primary'>Simpan</button>
				            </td>
			            </tr>
	            </table>
	        	<?php
	        	echo form_close();
	      ?>
	    </section><!-- /.content -->
<?php }?>
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
    </body>
</html>
