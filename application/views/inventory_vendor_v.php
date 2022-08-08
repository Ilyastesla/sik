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
                        <li><a href="javascript:void(window.open('<?php echo site_url('inventory_vendor/tambah'); ?>'))" ><i class="fa fa-plus-square"></i> Tambah</a></li>

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
                                                <th>Kode Organisasi</th>
                                                <th>Nama</th>
                                                <th><i>Contact Person</i></th>
                                                <th>Kota</th>
                                                <th>Alamat</th>
                                                <th>No. Telp</th>
                                                <th>Handphone</th>
                                                <th>Aktif</th>
                                                <th width="80">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        	<?php
                                        	$CI =& get_instance();$no=1;
											foreach((array)$show_table as $row) {
											    echo "<tr>";
											    echo "<td align=''>".strtoupper($no++)."</td>";
                          echo "<td align='center'>".strtoupper($row->organizationcode)."</td>";
											    echo "<td align='center'><a href=javascript:void(window.open('".site_url('inventory_vendor/view/'.$row->replid)."'))>".strtoupper($row->nama)."&nbsp;</a></td>";
                          echo "<td align='center'>".strtoupper($row->contactperson)."</td>";
                          echo "<td align='center'>".strtoupper($row->city)."</td>";
                          echo "<td align='center'>".strtoupper($row->street)."</td>";
                          echo "<td align='center'>".strtoupper($row->phone)."</td>";
                          echo "<td align='center'>".strtoupper($row->mobile)."</td>";
											    echo "<td align='center'>".$CI->p_c->cekaktif($row->aktif)."</td>";
											    echo "<td align='center'>";
                          echo "<a href=javascript:void(window.open('".site_url('inventory_vendor/ubah/'.$row->replid)."')) class='btn btn-xs btn-warning fa fa-check-square' ></a>&nbsp;&nbsp;";
                          echo "<a href=javascript:void(window.open('".site_url('inventory_vendor/hapus/'.$row->replid)."')) class='btn btn-xs btn-danger fa fa-minus-square' ></a>";
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
                    <label class="control-label" for="minlengthfield">Kode Organisasi</label>
                    <div class="control-group">
                    <div class="controls">:
                            <?php
                              $arridorganization='data-rule-required=true';
                              echo form_dropdown('idorganization',$idorganization_opt,$isi->idorganization,$arridorganization);
                            ?>
                            <?php //echo  <p id="message"></p> ?>
                    </div>
                    </div>
                </th>
            </tr>
		    		<tr>
		            <th align="left">
	                		<label class="control-label" for="minlengthfield">Nama</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		echo form_input(array('class' => '', 'id' => 'nama','name'=>'nama','value'=>$isi->nama,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'255', 'data-rule-minlength'=>'2' ,'placeholder'=>'Masukkan 2-255 Karakter'));
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th>
            </tr>
            <tr>
		            <th align="left">
	                		<label class="control-label" for="minlengthfield"><i>Contact Person</i></label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		echo form_input(array('class' => '', 'id' => 'contactperson','name'=>'contactperson','value'=>$isi->contactperson,'data-rule-required'=>'false' ,'data-rule-maxlength'=>'255', 'data-rule-minlength'=>'2' ,'placeholder'=>'Masukkan 2-255 Karakter'));
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th>
            </tr>
            <tr>
		            <th align="left">
	                		<label class="control-label" for="minlengthfield">Alamat</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		echo form_input(array('class' => '', 'id' => 'street','name'=>'street','value'=>$isi->street,'data-rule-required'=>'false' ,'data-rule-maxlength'=>'255', 'data-rule-minlength'=>'2' ,'placeholder'=>'Masukkan 2-255 Karakter'));
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th>
            </tr>
            <tr>
		            <th align="left">
	                		<label class="control-label" for="minlengthfield">Kota</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		echo form_input(array('class' => '', 'id' => 'city','name'=>'city','value'=>$isi->city,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'255', 'data-rule-minlength'=>'2' ,'placeholder'=>'Masukkan 2-255 Karakter'));
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th>
            </tr>
            <tr>
              <th align="left">
                      <label class="control-label" for="minlengthfield">Kode Pos</label>
                      <div class="control-group">
                    <div class="controls">:
                            <?php
                              echo form_input(array('id' => 'zip','name'=>'zip','value'=>$isi->zip,'data-rule-required'=>'false' ,'data-rule-maxlength'=>'15', 'data-rule-minlength'=>'1','data-rule-number'=>'true','placeholder'=>'Masukkan 1-15 Karakter'));
                            ?>
                            <?php //echo  <p id="message"></p> ?>
                    </div>
                      </div>
              </th>
          </tr>
            <tr>
                <th align="left">
                    <label class="control-label" for="minlengthfield">Negara</label>
                    <div class="control-group">
                    <div class="controls">:
                            <?php
                              $arrcountry='data-rule-required=true';
                              echo form_dropdown('country',$country_opt,$isi->country,$arrcountry);
                            ?>
                            <?php //echo  <p id="message"></p> ?>
                    </div>
                    </div>
                </th>
            </tr>
            <tr>
              <th align="left">
                      <label class="control-label" for="minlengthfield">No. Telp</label>
                      <div class="control-group">
                    <div class="controls">:
                            <?php
                              echo form_input(array('id' => 'phone','name'=>'phone','value'=>$isi->phone,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'15', 'data-rule-minlength'=>'1','data-rule-number'=>'true','placeholder'=>'Masukkan 1-15 Karakter'));
                            ?>
                            <?php //echo  <p id="message"></p> ?>
                    </div>
                      </div>
              </th>
          </tr>
          <tr>
            <th align="left">
                    <label class="control-label" for="minlengthfield">Handphone</label>
                    <div class="control-group">
                  <div class="controls">:
                          <?php
                            echo form_input(array('id' => 'mobile','name'=>'mobile','value'=>$isi->mobile,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'15', 'data-rule-minlength'=>'1','data-rule-number'=>'true','placeholder'=>'Masukkan 1-15 Karakter'));
                          ?>
                          <?php //echo  <p id="message"></p> ?>
                  </div>
                    </div>
            </th>
        </tr>
        <tr>
          <th align="left">
                  <label class="control-label" for="minlengthfield">Fax</label>
                  <div class="control-group">
                <div class="controls">:
                        <?php
                          echo form_input(array('id' => 'fax','name'=>'fax','value'=>$isi->fax,'data-rule-required'=>'false' ,'data-rule-maxlength'=>'15', 'data-rule-minlength'=>'1','data-rule-number'=>'true','placeholder'=>'Masukkan 1-15 Karakter'));
                        ?>
                        <?php //echo  <p id="message"></p> ?>
                </div>
                  </div>
          </th>
      </tr>
      <tr>
      <th align="left">
          <label class="control-label" for="minlengthfield">Email</label>
          <div class="control-group">
    <div class="controls">:
            <?php
              echo form_input(array('class' => '', 'id' => 'email','name'=>'email','value'=>$isi->email,'data-rule-required'=>'false' ,'data-rule-maxlength'=>'200', 'data-rule-minlength'=>'2','data-rule-email'=>'true' ,'placeholder'=>'Masukkan 2-100 Karakter'));
            ?>
            <?php //echo  <p id="message"></p> ?>
    </div>
          </div>
      </th></tr>
      <tr>
      <th align="left">
          <label class="control-label" for="minlengthfield">Website</label>
          <div class="control-group">
    <div class="controls">:
            <?php
              echo form_input(array('class' => '', 'id' => 'website','name'=>'website','value'=>$isi->website,'data-rule-required'=>'false' ,'data-rule-maxlength'=>'200', 'data-rule-minlength'=>'2','placeholder'=>'Masukkan 2-200 Karakter'));
            ?>
            <?php //echo  <p id="message"></p> ?>
    </div>
          </div>
      </th></tr>

            <tr>
  		            <th align="left">
  		        		<label class="control-label" for="minlengthfield">Korporasi</label>
  		        		<div class="control-group">
    							<div class="controls">:
    		                	<?php
    		                		echo form_checkbox('is_corporate', '1', $isi->is_corporate);
    		                	?>
    		                	<?php //echo  <p id="message"></p> ?>
    							</div>
  		        		</div>
  		            </th>
              </tr>
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
				            	<a href="javascript:void(window.open('<?php echo site_url('inventory_vendor') ?>'))" class="btn btn-success">Batal</a>
				            </th>
				    </tr>
		            </table>
		        	<?php
		        	echo form_close();
		        	?>
	    </section>
    <?php } elseif($view=='view'){ ?>
    		    <section class="content-header table-responsive">
    	            <h1>
    	                <?php echo $form ?>
    	                <small><?php echo $form_small ?></small>
    	            </h1>
                  <ol class="breadcrumb">
                      <li><a href="javascript:void(window.open('<?php echo site_url('inventory_vendor/tambah'); ?>'))" ><i class="fa fa-plus-square"></i> Tambah</a></li>
                  </ol>
                </section>
                <section class="content">
    		        <?php
    			        $attributes = array('class' => 'form-horizontal form-validate', 'id' => 'form', 'method' => 'POST', 'novalidate'=>'novalidate','onsubmit'=>'return validate()');
    		    	echo form_open($action,$attributes);
    		    	?>
    		    	<table width="100%" border="0">
                <tr>
                    <th align="left">
                        <label class="control-label" for="minlengthfield">Kode Organisasi</label>
                        <div class="control-group">
                        <div class="controls">:
                                <?php
                                  echo strtoupper($isi->organizationcode);
                                ?>
                                <?php //echo  <p id="message"></p> ?>
                        </div>
                        </div>
                    </th>
                </tr>
    		    		<tr>
    		            <th align="left">
    	                		<label class="control-label" for="minlengthfield">Nama</label>
    	                		<div class="control-group">
    								<div class="controls">:
                            <?php
                              echo strtoupper($isi->nama);
                            ?>
    			                	<?php //echo  <p id="message"></p> ?>
    								</div>
    	                		</div>
    			            </th>
                </tr>
                <tr>
    		            <th align="left">
    	                		<label class="control-label" for="minlengthfield"><i>Contact Person</i></label>
    	                		<div class="control-group">
    								<div class="controls">:
    			                	<?php
                              echo strtoupper($isi->contactperson);
    			                	?>
    			                	<?php //echo  <p id="message"></p> ?>
    								</div>
    	                		</div>
    			            </th>
                </tr>
                <tr>
    		            <th align="left">
    	                		<label class="control-label" for="minlengthfield">Alamat</label>
    	                		<div class="control-group">
    								<div class="controls">:
    			                	<?php
                              echo $isi->street;
    			                	?>
    			                	<?php //echo  <p id="message"></p> ?>
    								</div>
    	                		</div>
    			            </th>
                </tr>
                <tr>
    		            <th align="left">
    	                		<label class="control-label" for="minlengthfield">Kota</label>
    	                		<div class="control-group">
    								<div class="controls">:
    			                	<?php
                              echo $isi->city;
    			                	?>
    			                	<?php //echo  <p id="message"></p> ?>
    								</div>
    	                		</div>
    			            </th>
                </tr>
                <tr>
                  <th align="left">
                          <label class="control-label" for="minlengthfield">Kode Pos</label>
                          <div class="control-group">
                        <div class="controls">:
                                <?php
                                  echo $isi->zip;
                                ?>
                                <?php //echo  <p id="message"></p> ?>
                        </div>
                          </div>
                  </th>
              </tr>
                <tr>
                    <th align="left">
                        <label class="control-label" for="minlengthfield">Negara</label>
                        <div class="control-group">
                        <div class="controls">:
                                <?php
                                  echo $isi->negara;
                                ?>
                                <?php //echo  <p id="message"></p> ?>
                        </div>
                        </div>
                    </th>
                </tr>
                <tr>
                  <th align="left">
                          <label class="control-label" for="minlengthfield">No. Telp</label>
                          <div class="control-group">
                        <div class="controls">:
                                <?php
                                  echo strtoupper($isi->phone);
                                ?>
                                <?php //echo  <p id="message"></p> ?>
                        </div>
                          </div>
                  </th>
              </tr>
              <tr>
                <th align="left">
                        <label class="control-label" for="minlengthfield">Handphone</label>
                        <div class="control-group">
                      <div class="controls">:
                              <?php
                                echo strtoupper($isi->mobile);
                              ?>
                              <?php //echo  <p id="message"></p> ?>
                      </div>
                        </div>
                </th>
            </tr>
            <tr>
              <th align="left">
                      <label class="control-label" for="minlengthfield">Fax</label>
                      <div class="control-group">
                    <div class="controls">:
                            <?php
                              echo strtoupper($isi->fax);
                            ?>
                            <?php //echo  <p id="message"></p> ?>
                    </div>
                      </div>
              </th>
          </tr>
          <tr>
          <th align="left">
              <label class="control-label" for="minlengthfield">Email</label>
              <div class="control-group">
        <div class="controls">:
                <?php
                  echo $isi->email;
                ?>
                <?php //echo  <p id="message"></p> ?>
        </div>
              </div>
          </th></tr>
          <tr>
          <th align="left">
              <label class="control-label" for="minlengthfield">Website</label>
              <div class="control-group">
        <div class="controls">:
                <?php
                  echo $isi->website;
                ?>
                <?php //echo  <p id="message"></p> ?>
        </div>
              </div>
          </th></tr>

                <tr>
      		            <th align="left">
      		        		<label class="control-label" for="minlengthfield">Korporasi</label>
      		        		<div class="control-group">
        							<div class="controls">:
        		                	<?php
                                echo ($CI->p_c->cekaktif($isi->is_corporate))
        		                	?>
        		                	<?php //echo  <p id="message"></p> ?>
        							</div>
      		        		</div>
      		            </th>
                  </tr>
    			        <tr>
    		            <th align="left">
    		        		<label class="control-label" for="minlengthfield">Aktif</label>
    		        		<div class="control-group">
    							<div class="controls">:
    		                	<?php
                            echo ($CI->p_c->cekaktif($isi->aktif))
    		                	?>
    		                	<?php //echo  <p id="message"></p> ?>
    							</div>
    		        		</div>
    		            </th></tr>
                    </table>
                    <table class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <?php
                            echo "<th>No.</th>";
                            echo "<th>Material</th>";
                            echo "<th>Jumlah</th>";
                            echo "<th>Unit</th>";

                          ?>
                        </tr>
                      </thead>
                      <tbody>
                          <?php
                          $no=1;
                          foreach((array)$material as $rowmat) {
                            echo "<tr>";
                            echo "<td>".$no++."</td>";
                            echo "<td align='left'>".$rowmat->materialtext;
                            echo "&nbsp;&nbsp;<a href=javascript:void(window.open('".site_url('inventory_material/view/'.$rowmat->idmaterial)."')) class='btn btn-xs btn-info fa fa-circle-o' ></a>&nbsp;";
                            echo "</td>";
										        echo "<td align='center'>".$rowmat->jumlah."</td>";
										        echo "<td align='center'>".$rowmat->unittext."</td>";
                            echo "</tr>";
                          }
                          ?>
                      </tbody>
                    </table>
                  <table>
    			         <tr>
    				            <th align="left">
                          <a href="javascript:void(window.open('<?php echo site_url('inventory_vendor/ubah/'.$isi->replid) ?>'))" class='btn btn-warning' >Ubah</a>&nbsp;
    				            	<a href="javascript:void(window.open('<?php echo site_url('inventory_vendor') ?>'))" class="btn btn-success">Batal</a>
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
