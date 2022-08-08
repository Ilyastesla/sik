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

                <!-- Main content -->
                <section class="content">
	                	<section class="content-header" align="right">
		                    <ol class="breadcrumb">
		                        <li><a href="javascript:void(window.open('<?php echo site_url('userapp/ubahuser'); ?>'))" ><i class="fa fa-plus-square"></i> Tambah</a></li>
		                    </ol>
		                </section>

	                	<table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>NIP</th>
                                    <th>Nama</th>
                                    <th>Peran</th>
                                    <th>Jenjang</th>
                                    <th>Status Pegawai</th>
                                    <th>Aktif</th>
                                    <th>Aksi</th>
                                </tr>

                            </thead>
                            <tbody>
                            	<?php
                            	$CI =& get_instance();
								foreach((array)$data_table as $rowx) {
								    echo "<tr>";

								    	echo "<td align='center'><a href=javascript:void(window.open('".site_url('userapp/viewuser/'.$rowx->replid)."'))>".$rowx->nip."</a></td>";
								    	echo "<td align='center'>".strtoupper($rowx->nama)."</td>";
								    	echo "<td align='center'>".$CI->dbx->role_show($rowx->role_id,1)."</td>";
								    	echo "<td align='center'>".strtoupper($CI->dbx->departemen_show($rowx->departemen))."</td>";
								    	echo "<td align='center'>".($CI->p_c->cekaktif($rowx->status_pegawai))."</td>";
								    	echo "<td align='center'>".($CI->p_c->cekaktif($rowx->aktif))."</td>";
									    echo "<td align='center' width='150'>";
										echo '<a href='.site_url('userapp/ubahuser/'.$rowx->replid).' class="btn btn-warning">Ubah</a>';
									    echo '&nbsp;&nbsp;<a href='.site_url('userapp/hapususer_p/'.$rowx->replid).'  class="btn btn-danger">Hapus</a>';
									    echo "</td>";
								    echo "</tr>";
								}
								?>
                            </tbody>
                            <tfoot>
                            </tfoot>
	                	</table>
	                	<?php
		}elseif($view=='ubahuser'){?>
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
	    		<?php if (($isi->nip<>"") or (isset($viewview))) {?>
	    		<tr>
	            <th align="left">
	        		<label class="control-label" for="minlengthfield">NIP</label>
	        		<div class="control-group">
						<div class="controls">:
	                	<?php
	                		echo "<a href=javascript:void(window.open('".site_url('general/datapegawai/'.$isi->replid)."'))>".$isi->nip."</a>";
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
	            <?php } else {?>
	           	 	<tr>
			            <th align="left">
	                		<label class="control-label" for="minlengthfield">Pegawai</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		$arrnip='data-rule-required=true';
			                		echo form_dropdown('nip',$nip_opt,$isi->nip,$arrnip);
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th></tr>
			         <!--
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
			            -->
	            <?php } ?>
	    		<tr>
	            <th align="left">
	        		<label class="control-label" for="minlengthfield">Peran</label>
	        		<div class="control-group">
						<div class="controls">
	                	<?php
							if (!isset($viewview)){
		                		?>
		                		<input type="checkbox" onClick="selectallx('role','selectall')" id="selectall" class="selectall"/> Pilih Semua <hr/>
		                		<?php
		                		$CI->p_c->checkbox_more('role',$role_opt,$isi->role_id,$ro);
	                		}else{
		                		echo ": ".$CI->dbx->role_show($isi->role_id,1);
	                		}

	                	?>
	                	<?php //echo  <p id="message"></p> ?>
						</div>
	        		</div>
	            </th></tr>

	            <tr>
	            <th align="left">
	        		<label class="control-label" for="minlengthfield">Jenjang</label>
	        		<div class="control-group">
						<div class="controls">
						<?php
							if (!isset($viewview)){
		                		?>
		                		<input type="checkbox" onClick="selectallx('departemen','selectall2')" id="selectall2" class="selectall2"/> Pilih Semua <hr/>
		                		<?php
	                		}

	                		$CI->p_c->checkbox_more('departemen',$departemen_opt,$isi->departemen,$ro)
	                	?>
	                	<?php //echo  <p id="message"></p> ?>
						</div>
	        		</div>
	            </th></tr>
	            <tr>
	            <th align="left">
	        		<label class="control-label" for="minlengthfield">Kelas</label>
	        		<div class="control-group">
						<div class="controls">
						<?php
	                		if (!isset($viewview)){
		                		?>
		                		<input type="checkbox" onClick="selectallx('kelas','selectall3')" id="selectall3" class="selectall3"/> Pilih Semua <hr/>
		                		<?php
	                		}
	                		$CI->p_c->checkbox_more('kelas',$kelas_opt,$isi->kelas,$ro)
	                	?>
	                	<?php //echo  <p id="message"></p> ?>
						</div>
	        		</div>
	            </th></tr>
	            <tr>
	            <th align="left">
	        		<label class="control-label" for="minlengthfield">Mata Pelajaran</label>
	        		<div class="control-group">
							<div class="controls">
              	<?php
              		if (!isset($viewview)){
                		?>
                		<input type="checkbox" onClick="selectallx('matpel','selectall4')" id="selectall4" class="selectall4"/> Pilih Semua <hr/>
                		<?php
              		}
              		$CI->p_c->checkbox_more('matpel',$matpel_opt,$isi->matpel,$ro)
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
			                		if (isset($viewview)) {
			                			echo $isi->keterangan;
			                		}else{
				                		echo form_textarea(array('class' => '', 'id' => 'keterangan','name'=>'keterangan','value'=>$isi->keterangan,'data-rule-required'=>'false' ,'data-rule-maxlength'=>'500', 'data-rule-minlength'=>'2' ,'placeholder'=>'Masukkan 2-500 Karakter'));
			                		}
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
	                		if (isset($viewview)) {
	                			echo $CI->p_c->cekaktif($isi->aktif);
	                		}else{
				            	echo form_checkbox('aktif', '1', $isi->aktif);
				            }
	                	?>
	                	<?php //echo  <p id="message"></p> ?>
						</div>
	        		</div>
	            </th></tr>
	            <?php if (($isi->nip<>"") and (!isset($viewview))) {?>
	            <tr>
	            <th align="left">
	        		<label class="control-label" for="minlengthfield">Kembalikan Kata Sandi</label>
	        		<div class="control-group">
						<div class="controls">:
	                	<?php
	                		echo form_checkbox('reset', '1',0);
	                	?>
	                	<?php //echo  <p id="message"></p> ?>
						</div>
	        		</div>
	            </th></tr>
	            <?php }?>
	            </table>
	            <table width="100%">
                    <tr>
				            <th align="left">
				            	 <?php
				            	 if (!isset($viewview)) {
					            	 if (isset($isi->replid)){ ?>
						           		<input type="hidden" name="nip" value="<?php echo $isi->nip ?>">

					            	 <?php } ?>
						        	<button class='btn btn-primary'>Simpan</button>
						        	<?php if (isset($isi->replid)){ ?>
						        		<a href="javascript:void(window.open('<?php echo site_url('userapp/viewuser/'.$isi->replid) ?>'))" class="btn btn-success">Kembali</a>
					        	<?php
					        		}
					        	} else {
						        ?>
						        <ol class="breadcrumb">
			                    	<li><a href="JavaScript:printsdk('<?php echo $isi->replid?>')"><i class="fa fa-file-text"></i>&nbsp;&nbsp;Cetak SDK</a></li>
			                    </ol>
				            	<a href="javascript:void(window.open('<?php echo site_url('userapp/ubahuser/'.$isi->replid) ?>'))" class="btn btn-warning">Ubah</a>
				            	<a href="javascript:void(window.open('<?php echo site_url('userapp/user_hrm') ?>'))" class="btn btn-success">Kembali</a>
					        	<?php } ?>
				            </th>
				    </tr>
		        </table>
	            <?php
	        	echo form_close();
	      ?>
	    </section><!-- /.content -->
	    <?php } elseif($view=='ganti_password'){?>
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
	    	<?php if (isset($error)) { ?>
	    	<div class="alert alert-warning alert-dismissable" align="left">
                <i class="fa fa-warning"></i>
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <b>Alert!</b> <?php echo $error ?>.
            </div>
            <?php } ?>

	    	<?php if (isset($success)) { ?>
	    	<div class="alert alert-success alert-dismissable">
                <i class="fa fa-check"></i>
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <b>Alert!</b> <?php echo $success ?>..
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
