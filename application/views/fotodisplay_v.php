<!DOCTYPE html>
<html>
<script type="text/javascript">
	function validate(){
		var userfile = document.getElementById('userfile').value;
		if (userfile==""){
			alert ("Pilih File Atau Foto Terlebih Dahulu");
			return false;
		}
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
	                <small><?php echo $form_small ?></small>
	            </h1>
            </section>
            <section class="content">
		    	<table width="100%" border="0">
		    		<tr align="center">
			    		<td>
			    			<?php
                            if ($isi->fotodisplay<>""){
                        	?>
                            	<img src="<?php echo base_url(); ?>uploads/fotodisplay/<?php echo $isi->fotodisplay ?>" style="width:50%;" />
                            <?php }else{?>
                            	<img src="<?php echo base_url(); ?>images/blankfotodisplay.png" style="width:50%;" />
                            <?php } ?>
				    		<br/><hr/>
			    		</td>
		    		</tr>
			         <tr>
				            <th align="left">
				            Disarankan Upload Foto Dengan Dimensi (1:1) atau Kotak.
				            	<?php
				        	 $attributes = array('class' => 'form-horizontal form-validate', 'id' => 'form', 'method' => 'POST', 'novalidate'=>'novalidate','onsubmit'=>'return validate()');
				        	 echo form_open_multipart($action.$isi->fotodisplay,$attributes);
				        	?>
				        	<div align="left">
									<input type="hidden" name="nip" size="20" id="nip" value="<?php echo $nip ?>"/>
									<input type="hidden" name="idpegawai" size="20" id="idpegawai" value="<?php echo $isi->idpegawai ?>"/>
									<input type="file" name="userfile" size="20" id="userfile"/><br/>
				        	<input type="submit" value="upload" class='btn btn-xs btn-warning' onclick="return validate()"/>
									<a href="javascript:void(window.open('<?php echo site_url('general/datapegawai/'.$isi->idpegawai) ?>'))" class="btn btn-primary">Profil Pegawai</a>
				        	</div>
				        	<?php echo form_close(); ?>
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
