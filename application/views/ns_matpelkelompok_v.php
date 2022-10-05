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
                        <li><a href="javascript:void(window.open('<?php echo site_url('ns_matpelkelompok/tambah'); ?>'))" ><i class="fa fa-plus-square"></i> Tambah</a></li>
                        <!--
                        <li><a href="#"><i class="fa fa-file-text"></i>Cetak</a></li>
                        <li><a href="#"><i class="fa fa-file-excel-o"></i>Excel</a></li>
                        -->
                    </ol>
                </section>


                <!-- Main content -->
                <section class="content-header table-responsive">
                <?php
  			             $attributes = array('class' => 'form-horizontal form-validate', 'id' => 'form', 'method' => 'POST', 'novalidate'=>'novalidate','onsubmit'=>'return validate()');
  		    	         echo form_open($action,$attributes);
  		    		?>
                    	<table width="100%" border="0">
    	                    <tr>
            						       <th align="left">
      				                		<label class="control-label" for="minlengthfield">Jenjang</label>
      				                		<div class="control-group">
              											<div class="controls">:
          						                	<?php
          						                		$arriddepartemen='data-rule-required=false onchange=javascript:this.form.submit();';
          						                		echo form_dropdown('iddepartemen',$iddepartemen_opt,$this->input->post('iddepartemen'),$arriddepartemen);
          						                	?>
          						                	<?php //echo  <p id="message"></p> ?>
              											</div>
            				              </div>
            						         </th>
    			                  </tr>
    		                </table>
  		            <?php
  			            echo form_close();
  		            ?>
                </section>
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-body table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th width='50'>No.</th>
                                                <th>Jenjang</th>
                                                <th>Kelompok Mata Pelajaran</th>
                                                <th>Keterangan</th>
                                                <th width="80">No. Urut</th>
                                                <!--
                                                <th width="80">Persentase (%)</th> -->
                                                <th>Detail Rapor</th>
                                                <th>Group Aktif</th>
												<th>Sembunyikan Nilai</th>
												<th>Tgl. Buat</th>
                                                <th>aktif</th>
                                                <th width="80">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        	<?php
                                        	$CI =& get_instance();$no=1;
											foreach((array)$show_table as $row) {
											    echo "<tr>";
											    echo "<td align='center'>".$no++."</td>";
                          echo "<td align=''>".($row->iddepartemen)."</td>";
											    echo "<td align=''>".($row->matpelkelompok)."</td>";
											    echo "<td align='center'>".($row->keterangan)."</td>";
											    echo "<td align='center'>".$row->no_urut."</td>";
                          //echo "<td align='center'>".$row->persentase."</td>";
											    echo "<td align='center'>".($CI->p_c->cekaktif($row->detail))."</td>";
                          echo "<td align='center'>".($CI->p_c->cekaktif($row->groupon))."</td>";
						  echo "<td align='center'>".$CI->p_c->cekaktif($row->sembunyinilai)."</td>";
											    echo "<td align='center'>".$CI->p_c->cekaktif($row->aktif)."</td>";
												echo "<td align='center'>".($row->created_date)."</td>";
											    echo "<td align='center'>";
                          //if ($row->pakai<1){
											      echo "<a href=javascript:void(window.open('".site_url('ns_matpelkelompok/ubah/'.$row->replid)."')) class='btn btn-xs btn-warning fa fa-check-square' ></a>&nbsp;&nbsp;";
                            echo "<a href=javascript:void(window.open('".site_url('ns_matpelkelompok/hapus/'.$row->replid)."')) class='btn btn-xs btn-danger fa fa-minus-square' ></a>";
                          //}
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
	                		<label class="control-label" for="minlengthfield">Kelompok Mata Pelajaran</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		echo form_input(array('class' => '','style'=>'margin: 0px 0px 5px; width: 687px;', 'id' => 'matpelkelompok','name'=>'matpelkelompok','value'=>$isi->matpelkelompok,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'500', 'data-rule-minlength'=>'2' ,'placeholder'=>'Masukkan 5-100 Karakter'));
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th></tr>
                  <tr>
                    <th align="left">
                    <label class="control-label" for="minlengthfield">Jenjang</label>
                    <div class="control-group">
                  <div class="controls">:
                          <?php
                            $arriddepartemen='data-rule-required=true';
                            echo form_dropdown('iddepartemen',$iddepartemen_opt,$isi->iddepartemen,$arriddepartemen);
                          ?>
                          <?php //echo  <p id="message"></p> ?>
                  </div>
                    </div>
                    </th></tr>
		    		<tr>
				            <th align="left">
		                		<label class="control-label" for="minlengthfield">Keterangan</label>
		                		<div class="control-group">
									<div class="controls" valign="top">&nbsp;&nbsp;
				                	<?php
				                		echo form_textarea(array('class' => '', 'id' => 'keterangan','name'=>'keterangan','value'=>$isi->keterangan,'data-rule-required'=>'false' ,'data-rule-maxlength'=>'500', 'data-rule-minlength'=>'2' ,'placeholder'=>'Masukkan 2-500 Karakter'));
				                	?>
				                	<?php //echo  <p id="message"></p> ?>
									</div>
		                		</div>
				            </th></tr>
				    <tr>
            <!--
				    <tr>
				            <th align="left">
		                		<label class="control-label" for="minlengthfield">Persentase</label>
		                		<div class="control-group">
									<div class="controls">:
				                	<?php
				                		echo form_input(array('id' => 'persentase','name'=>'persentase','value'=>$isi->persentase,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'3', 'data-rule-minlength'=>'1','data-rule-number'=>'true','placeholder'=>'Masukkan 1-3 Karakter'));
				                	?>
				                	<?php //echo  <p id="message"></p> ?>
									</div>
		                		</div>
				        </th></tr>
            -->
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
		        		<label class="control-label" for="minlengthfield">Tampilkan Detail</label>
		        		<div class="control-group">
							<div class="controls">:
		                	<?php
		                		echo form_checkbox('detail', '1', $isi->detail);
		                	?>
		                	<?php //echo  <p id="message"></p> ?>
							</div>
		        		</div>
		            </th></tr>
                <tr>
    				    <th align="left">
    		        		<label class="control-label" for="minlengthfield">Group Aktif</label>
    		        		<div class="control-group">
    							<div class="controls">:
    		                	<?php
    		                		echo form_checkbox('groupon', '1', $isi->groupon);
    		                	?>
    		                	<?php //echo  <p id="message"></p> ?>
    							</div>
    		        		</div>
    		            </th></tr>
				    
						<tr>
		            <th align="left">
		        		<label class="control-label" for="minlengthfield">Sembunyikan Nilai</label>
		        		<div class="control-group">
							<div class="controls">:
		                	<?php
		                		echo form_checkbox('sembunyinilai', '1', $isi->sembunyinilai);
		                	?>
		                	<?php //echo  <p id="message"></p> ?>
							</div>
		        		</div>
		            </th></tr>	<tr>
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
				            	<a href="javascript:void(window.open('<?php echo site_url('ns_matpelkelompok') ?>'))" class="btn btn-success">Kembali</a>
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
