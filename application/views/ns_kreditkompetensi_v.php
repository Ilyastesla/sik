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
                        <li><a href="javascript:void(window.open('<?php echo site_url('ns_kreditkompetensi/tambah'); ?>'))" ><i class="fa fa-plus-square"></i> Tambah</a></li>
                        <!--
                        <li><a href="#"><i class="fa fa-file-text"></i>Cetak</a></li>
                        <li><a href="#"><i class="fa fa-file-excel-o"></i>Excel</a></li>
                        -->
                    </ol>
                </section>

                <section class="content-header table-responsive">
                <?php
  			             $attributes = array('class' => 'form-horizontal form-validate', 'id' => 'form', 'method' => 'POST', 'novalidate'=>'novalidate','onsubmit'=>'return validate()');
  		    	echo form_open($action,$attributes);
  		    		?>
                    	<table width="100%" border="0">
    	                    <tr>
            						       <th align="left">
      				                		<label class="control-label" for="minlengthfield">Tingkat</label>
      				                		<div class="control-group">
              											<div class="controls">:
          						                	<?php
          						                		$arridtingkat='data-rule-required=false  onchange=javascript:this.form.submit();';
          						                		echo form_dropdown('idtingkat',$idtingkat_opt,$this->input->post('idtingkat'),$arridtingkat);
          						                	?>
          						                	<?php //echo  <p id="message"></p> ?>
              											</div>
            				              </div>
                                </th>
                                <th align="left">
                                   <label class="control-label" for="minlengthfield">Periode</label>
                                   <div class="control-group">
                                     <div class="controls">:
                                         <?php
                                           $arridperiode='data-rule-required=false  onchange=javascript:this.form.submit();';
                                           echo form_dropdown('idperiode',$idperiode_opt,$this->input->post('idperiode'),$arridperiode);
                                         ?>
                                         <?php //echo  <p id="message"></p> ?>
                                     </div>
                                   </div>
                                </th>
    			                  </tr>
                            <!--
          			            <tr>
          				            <th align="left" colspan="4">
          				            	<button class='btn btn-primary' name='filter' value="1">Filter</button>
          				            	<?php echo "<a href='".site_url($action)."' class='btn btn-danger'>Bersihkan</a>&nbsp;&nbsp;";?>
          				            </th>
          				         </tr>
                         -->
    		                </table>
  		            <?php
  			            echo form_close();
  		            ?>
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
                                                <th>Jenjang</th>
                                                <th>Mata Pelajaran</th>
                                                <th>Tingkat</th>
                                                <th>Periode</th>
                                                <th>Jumlah SKK</th>
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
                          echo "<td align='center'>".strtoupper($row->iddepartemen)."</td>";
                          echo "<td align='left'>".strtoupper($row->matpeltext)."</td>";
                          echo "<td align=''>".strtoupper($row->tingkattext)."</td>";
                          echo "<td align=''>".strtoupper($row->periodetext)."</td>";
                          echo "<td align=''>".strtoupper($row->jumlahskk)."</td>";
                          echo "<td align='center'>";
                          echo "<a href=javascript:void(window.open('".site_url('ns_kreditkompetensi/ubahaktif/'.$row->replid.'/'.!($row->aktif))."')) >".$CI->p_c->cekaktif($row->aktif)."</a>";
                          //$CI->p_c->cekaktif($row->aktif).
                          echo "</td>";
											    echo "<td align='center'>";
											    		echo "<a href=javascript:void(window.open('".site_url('ns_kreditkompetensi/tambah/'.$row->replid)."')) class='btn btn-xs btn-warning fa fa-check-square' ></a>&nbsp;&nbsp;";
											    		echo "<a href=javascript:void(window.open('".site_url('ns_kreditkompetensi/hapus/'.$row->replid)."')) class='btn btn-xs btn-danger fa fa-minus-square' ></a> ";
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
                        <label class="control-label" for="minlengthfield">Mata Pelajaran</label>
                        <div class="control-group">
                  <div class="controls">:
                    <?php
                      $arridmatpel='data-rule-required=true';
                      echo form_dropdown('idmatpel',$idmatpel_opt,$isi->idmatpel,$arridmatpel);
                    ?>
                          <?php //echo  <p id="message"></p> ?>
                  </div>
                        </div>
                </th></tr>
            <tr>
              <th align="left">
              <label class="control-label" for="minlengthfield">Tingkat</label>
              <div class="control-group">
            <div class="controls">:
              <?php
                $arridtingkat='data-rule-required=true';
                echo form_dropdown('idtingkat',$idtingkat_opt,$isi->idtingkat,$arridtingkat);
              ?>
                    <?php //echo  <p id="message"></p> ?>
            </div>
              </div>
              </th></tr>
              <tr>
                <th align="left">
                <label class="control-label" for="minlengthfield">Periode</label>
                <div class="control-group">
              <div class="controls">:
                <?php
                  $arridperiode='data-rule-required=true';
                  echo form_dropdown('idperiode',$idperiode_opt,$isi->idperiode,$arridperiode);
                ?>

                      <?php //echo  <p id="message"></p> ?>
              </div>
                </div>
                </th></tr>
				    <tr>
				            <th align="left">
		                		<label class="control-label" for="minlengthfield">Jumlah SKK</label>
		                		<div class="control-group">
									<div class="controls">:
				                	<?php
				                		echo form_input(array('id' => 'jumlahskk','name'=>'jumlahskk','value'=>$isi->jumlahskk,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'3', 'data-rule-minlength'=>'1','data-rule-number'=>'true','placeholder'=>'Masukkan 1-3 Karakter'));
				                	?>
				                	<?php //echo  <p id="message"></p> ?>
									</div>
		                		</div>
				        </th></tr>
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
				            	<a href="javascript:void(window.open('<?php echo site_url("ns_kreditkompetensi") ?>'))" class="btn btn-success">Kembali</a>
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
