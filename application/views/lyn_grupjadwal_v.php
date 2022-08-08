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
<?php $CI =& get_instance();?>

<?php if($view=='index'){ ?>
                <!-- Content Header (Page header) -->
                <section class="content-header table-responsive">
                    <h1>
                        <?php echo $form ?>
                        <small>List Data</small>
                    </h1>

                    <ol class="breadcrumb">
                        <li><a href="javascript:void(window.open('<?php echo site_url('lyn_grupjadwal/tambah'); ?>'))" ><i class="fa fa-plus-square"></i> Tambah</a></li>
                        <!--
                        <li><a href="#"><i class="fa fa-file-text"></i>Cetak</a></li>
                        <li><a href="#"><i class="fa fa-file-excel-o"></i>Excel</a></li>
                        -->
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
                                                <th>Grup Jadwal</th>
                                                <th>Jam Mulai (HH:MM)</th>
                                                <th>Jam Akhir (HH:MM)</th>
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
											    echo "<td align=''>".($row->grupjadwal)."</td>";
                                                echo "<td align=''>".($row->jammulai)."</td>";
                                                echo "<td align=''>".($row->jamselesai)."</td>";
												echo "<td align='center'>";
											    echo "<a href=javascript:void(window.open('".site_url('lyn_grupjadwal/ubahaktif/'.$row->replid.'/'.!($row->aktif))."'))>".$CI->p_c->cekaktif($row->aktif)."</a>";
                          						echo "</td>";
											    echo "<td align='center'>";
                                                echo "<a href=javascript:void(window.open('".site_url('lyn_grupjadwal/ubah/'.$row->replid)."')) class='btn btn-xs btn-warning fa fa-check-square' ></a>&nbsp;";
                                                echo "<a href=javascript:void(window.open('".site_url('lyn_grupjadwal/hapus/'.$row->replid)."')) class='btn btn-xs btn-danger fa fa-minus-square' ></a>&nbsp;";
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
<!-------------------------------------------------------------------------------------------------------------------------------------->
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
	                		<label class="control-label" for="minlengthfield">Grup Jadwal</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		echo form_input(array('class' => '','style'=>'margin: 0px 0px 5px; width: 300px;', 'id' => 'grupjadwal','name'=>'grupjadwal','value'=>$isi->grupjadwal,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'500', 'data-rule-minlength'=>'2' ,'placeholder'=>'Masukkan 5-100 Karakter'));
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th></tr>
                        <tr>
                      <th align="left">
                        		<label class="control-label" for="minlengthfield">Jam Mulai (HH:MM)</label>
                        		<div class="control-group">
                							<div class="controls">:
                		                	<?php
                                        echo $CI->p_c->combotime("jammulai",substr($isi->jammulai,0,2),substr($isi->jammulai,3,2),false);
                		                		//echo form_input(array('class' => '', 'id' => 'jammulai','name'=>'jammulai','value'=>$isi->jammulai,'style'=>'width:100px','data-rule-required'=>'true' ,'data-rule-maxlength'=>'5', 'data-rule-minlength'=>'5' ,'placeholder'=>'HH:MM'));
                		                	?>
                		                	<?php //echo  <p id="message"></p> ?>
                							</div>
                        		</div>
                    </tr>
                    <tr>
          	            <th align="left">
                          		<label class="control-label" for="minlengthfield">Jam Akhir (HH:MM)</label>
                          		<div class="control-group">
                  							<div class="controls">:
                  		                	<?php
                                          echo $CI->p_c->combotime("jamselesai",substr($isi->jamselesai,0,2),substr($isi->jamselesai,3,2),false);
                                          //echo form_input(array('class' => '', 'id' => 'jamakhir','name'=>'jamakhir','value'=>$isi->jamakhir,'style'=>'width:100px','data-rule-required'=>'true' ,'data-rule-maxlength'=>'5', 'data-rule-minlength'=>'5' ,'placeholder'=>'HH:MM'));
                  		                	?>
                  		                	<?php //echo  <p id="message"></p> ?>
                  							</div>
                          		</div>
                      </tr>
            <!--
				    <tr>
				            <th align="left">
		                		<label class="control-label" for="minlengthfield">No. Urut</label>
		                		<div class="control-group">
									<div class="controls">:
				                	<?php
				                		echo form_input(array('id' => 'urutan','name'=>'urutan','value'=>$isi->urutan,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'3', 'data-rule-minlength'=>'1','data-rule-number'=>'true','placeholder'=>'Masukkan 1-3 Karakter'));
				                	?>
				                	<?php //echo  <p id="message"></p> ?>
									</div>
		                		</div>
				        </th></tr>
            -->
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
				            	<a href="javascript:void(window.open('<?php echo site_url('lyn_grupjadwal') ?>'))" class="btn btn-success">Kembali</a>
				            </th>
				    </tr>
		            </table>
		        	<?php
		        	echo form_close();
		        	?>
	    </section>
<!-------------------------------------------------------------------------------------------------------------------------------------->
<?php } ?>
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
    </body>
</html>