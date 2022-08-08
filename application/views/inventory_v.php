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
                if($view=='kelompok'){?>

                <section class="content-header table-responsive">
                    <h1>
                        <?php echo $form ?>
                     </h1>
                     <ol class="breadcrumb">
		                 <li><a href="javascript:void(window.open('<?php echo site_url('inventory/ubahinventory'); ?>'))" ><i class="fa fa-plus-square"></i> Tambah</a></li>
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
                                	<th width='50'>No.</th>
                                    <th>Kode</th>
                                    <th>Nama</th>
                                    <th>Parent</th>
                                    <th>Kelompok Fiskal</th>
                                    <th>Keterangan</th>
                                    <th>Aktif</th>
                                    <th>Aksi</th>
                                </tr>

                            </thead>
                            <tbody>
                            	<?php
                            	$CI =& get_instance();$no=1;
								foreach((array)$data_table as $rowx) {
								    echo "<tr>";
								    	echo "<td align='center'>".$no++."</td>";
								    	echo "<td align='center'>".strtoupper($rowx->kode)."</td>";
								    	echo "<td align='center'>".strtoupper($rowx->nama)."</td>";
                      echo "<td align='center'>".strtoupper($rowx->parent)."</td>";
                      echo "<td align='center'>".strtoupper($rowx->fiskaltext)."</td>";
								    	echo "<td align='center'>".strtoupper($rowx->keterangan)."</td>";
								    	echo "<td align='center'>".($CI->p_c->cekaktif($rowx->aktif))."</td>";
									    echo "<td align='center' width='150'>";
										  echo '<a href='.site_url('inventory/ubahinventory/'.$rowx->replid).' class="btn btn-warning">Ubah</a>';
                      if ($rowx->jmlmat<=0){
                          echo '&nbsp;&nbsp;<a href='.site_url('inventory/hapusinventory_p/'.$rowx->replid).'  class="btn btn-danger">Hapus</a>';
                      }
									    echo "</td>";
								    echo "</tr>";
								}
								?>
                            </tbody>
                            <tfoot>
                            </tfoot>
	                	</table>
	                	<?php
		}elseif($view=='ubahinventory'){?>
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
	    		<?php if ($isi->replid<>"") {?>
	    		<tr>
	            <th align="left">
	        		<label class="control-label" for="minlengthfield">Kode</label>
	        		<div class="control-group">
						<div class="controls">:
	                	<?php
	                		echo $isi->kode;
	                	?>
						</div>
	        		</div>
	            </th></tr>
	            <?php }
              /*
              else { ?>
	           	 	<tr>
			            <th align="left">
	                		<label class="control-label" for="minlengthfield">Kode</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		echo form_input(array('class' => '', 'id' => 'kode','name'=>'kode','value'=>$isi->kode,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'3', 'data-rule-minlength'=>'3' ,'placeholder'=>'Masukkan 3 Karakter','size'=>'15'));
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th></tr>
	            <?php
              } */
              ?>
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
                             <label class="control-label" for="minlengthfield">Kelompok Fiskal</label>
                             <div class="control-group">
                       <div class="controls">:
                               <?php
                                 $arrfiskal='data-rule-required=false';
                                 echo form_dropdown('idfiskal',$fiskal_opt,$isi->idfiskal,$arrfiskal);
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
			    <tr>
			            <th align="left">
	                		<label class="control-label" for="minlengthfield">Parent</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		$arrparent='data-rule-required=false';
			                		echo form_dropdown('parent',$parent_opt,$isi->parent,$arrparent);
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
	            <table>
	                <tr>
			            <td align="left">
			            	<button class='btn btn-primary'>Simpan</button>
			                <!-- <a href="javascript:void(window.open('<?php echo site_url('inventory/kelompok') ?>'))" class="btn btn-success">Kembali</a> -->
                      <a href="<?php echo $_SERVER['HTTP_REFERER'] ?>" class="btn btn-success">Kembali</a>
			            </td>
				    </tr>
	            </table>

	        	<?php
	        	echo form_close();?>
	    </section><!-- /.content -->
                <?php } ?>
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
    </body>
</html>
