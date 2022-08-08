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
                        <li><a href="javascript:void(window.open('<?php echo site_url('hrm_event_evaluation/tambah'); ?>'))"><i class="fa fa-plus-square"></i> Tambah</a></li>

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
                                                <th>Tipe</th>
                                                <!--<th>Tipe Data</th>-->
                                                <th>Head</th>
                                                <th>Evaluasi Pelatihan</th>
                                                <th>Skor Maksimal</th>
                                                <th>Skor Target</th>
                                                <th>No. Urut</th>
                                                <th>Umum</th>
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
                          echo "<td align='center'>".strtoupper($row->type)."</td>";
                          //echo "<td align='center'>".strtoupper($row->typedata)."</td>";
                          echo "<td align='center'>".strtoupper($row->head)."</td>";
                          echo "<td align='center'>".strtoupper($row->hrm_event_evaluation)."</td>";
											    echo "<td align='center'>".strtoupper($row->max_skor)."</td>";
                          echo "<td align='center'>".strtoupper($row->target_skor)."</td>";
											    echo "<td align='center'>".strtoupper($row->no_urut)."</td>";
											    echo "<td align='center'>".($CI->p_c->cekaktif($row->umum))."</td>";
											    echo "<td align='center'>".$CI->p_c->cekaktif($row->aktif)."</td>";
											    echo "<td align='center'>";
                          echo "<a href=javascript:void(window.open('".site_url('hrm_event_evaluation/ubah/'.$row->replid)."')) class='btn btn-xs btn-warning fa fa-check-square'></a>&nbsp;&nbsp;";
                          echo "<a href=javascript:void(window.open('".site_url('hrm_event_evaluation/hapus/'.$row->replid)."')) class='btn btn-xs btn-danger fa fa-minus-square'></a>";
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
            <label class="control-label" for="minlengthfield">Tipe</label>
            <div class="control-group">
          <div class="controls">:
                  <?php
                    $arrtype='data-rule-required=true';
                    echo form_dropdown('type',$type_opt,$isi->type,$arrtype);
                  ?>
          </div>
            </div>
            </th></tr>
            <!--
            <tr>
            <th align="left">
            <label class="control-label" for="minlengthfield">Tipe Data</label>
            <div class="control-group">
          <div class="controls">:
                  <?php
                    $arrtypedata='data-rule-required=true';
                    echo form_dropdown('typedata',$typedata_opt,$isi->typedata,$arrtypedata);
                  ?>
          </div>
            </div>
            </th></tr>
          -->
            <tr>
		            <th align="left">
	                		<label class="control-label" for="minlengthfield">Head</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		echo form_input(array('class' => '', 'id' => 'head','name'=>'head','value'=>$isi->head,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'2' ,'placeholder'=>'Masukkan 2-100 Karakter'));
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th></tr>
			        <tr>
		    		<tr>
		            <th align="left">
	                		<label class="control-label" for="minlengthfield">Evaluasi Pelatihan</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		echo form_input(array('class' => '', 'id' => 'hrm_event_evaluation','name'=>'hrm_event_evaluation','value'=>$isi->hrm_event_evaluation,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'2' ,'placeholder'=>'Masukkan 2-100 Karakter'));
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th></tr>
			        <tr>
			        <tr>
				            <th align="left">
		                		<label class="control-label" for="minlengthfield">Skor Maksimal</label>
		                		<div class="control-group">
									<div class="controls">:
				                	<?php
				                		echo form_input(array('id' => 'max_skor','name'=>'max_skor','value'=>$isi->max_skor,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'3', 'data-rule-minlength'=>'1','data-rule-number'=>'true','placeholder'=>'Masukkan 1-3 Karakter'));
				                	?> [Isi 0 Untuk penilaian deskriptif]
				                	<?php //echo  <p id="message"></p> ?>
									</div>
		                		</div>
				        </th></tr>
                <tr>
                      <th align="left">
                          <label class="control-label" for="minlengthfield">Skor Target</label>
                          <div class="control-group">
                    <div class="controls">:
                            <?php
                              echo form_input(array('id' => 'target_skor','name'=>'target_skor','value'=>$isi->target_skor,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'3', 'data-rule-minlength'=>'1','data-rule-number'=>'true','placeholder'=>'Masukkan 1-3 Karakter'));
                            ?>
                            <?php //echo  <p id="message"></p> ?>
                    </div>
                          </div>
                  </th></tr>
				    <tr>
				            <th align="left">
		                		<label class="control-label" for="minlengthfield">No. Urut</label>
		                		<div class="control-group">
									<div class="controls">:
				                	<?php
				                		echo form_input(array('id' => 'no_urut','name'=>'no_urut','value'=>$isi->no_urut,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'3', 'data-rule-minlength'=>'1','data-rule-number'=>'true','placeholder'=>'Masukkan 1-3 Karakter'));
				                	?>
				                	<?php //echo  <p id="message"></p> ?>
									</div>
		                		</div>
				        </th></tr>
				    <tr>
		            <th align="left">
		        		<label class="control-label" for="minlengthfield">Umum</label>
		        		<div class="control-group">
							<div class="controls">:
		                	<?php
		                		echo form_checkbox('umum', '1', $isi->umum);
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
				            	<a href="javascript:void(window.open('<?php echo site_url('hrm_event_evaluation') ?>'))" class="btn btn-success">Batal</a>
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
