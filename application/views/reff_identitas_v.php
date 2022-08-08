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
                                                <th>Logo</th>
                                                <th>Header</th>
                                                <th>Kode Cabang</th>
                                                <th width="80">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        	<?php
                                        	$CI =& get_instance();$no=1;
											foreach((array)$show_table as $row) {
											    echo "<tr>";
											    echo "<td align='center'>".$no++."</td>";
											    echo "<td align=''>".strtoupper($row->departemen)."</td>";
                          echo "<td align=''>";
                          $CI->dbx->blobimage("identitas",$row->departemen);
                          echo "</td>";
											    echo "<td align=''>";
                          if ($row->nama != "") {
                    		  ?>
                    	        	<font size="6"><strong><?php echo $row->nama ?></strong></font><br />
                    	        	<font size="2"><strong>
                    	    	<?php
                            if ($row->alamat2 <> "" && $row->alamat1 <> "")
                    	            	echo "Lokasi 1: ";
                    			  	if ($row->alamat1 != "")
                    					echo $row->alamat1;
                    				if ($row->telp1 != "" || $row->telp2 != "")
                    					echo "<br>Telp. ";
                    				if ($row->telp1 != "" )
                    					echo $row->telp1;
                    				if ($row->telp1 != "" && $row->telp2 != "")
                    						echo ", ";
                    				if ($row->telp2 != "" )
                    					echo $row->telp2;
                    				if ($row->fax1 != "" )
                    					echo "&nbsp;&nbsp;Fax. ".$row->fax1."&nbsp;&nbsp;";

                    				if ($row->alamat2 <> "" && $row->alamat1 <> "") {
                    					echo "<br>";
                    	            	echo "Lokasi 2: ";
                    					echo $row->alamat2;

                    					if ($row->telp3 != "" || $row->telp4 != "")
                    						echo "<br>Telp. ";
                    					if ($row->telp3 != "" )
                    						echo $row->telp3;
                    					if ($row->telp3 != "" && $row->telp4 != "")
                    						echo ", ";
                    					if ($row->telp4 != "" )
                    						echo $row->telp4;
                    					if ($row->fax2 != "" )
                    						echo "&nbsp;&nbsp;Fax. ".$row->fax2;
                    				}
                    				if ($row->situs != "" || $row->email != "")
                    					echo "<br>";
                    				if ($row->situs != "" )
                    					echo "Website: ".$row->situs."&nbsp;&nbsp;";
                    				if ($row->email != "" )
                    					echo "Email: ".$row->email;
                          }
                          echo "</strong></font></td>";
                          echo "<td align='center'>".strtoupper($row->kode_cabang)."</td>";
                          echo "<td align='center'>";
											    echo "<a href=javascript:void(window.open('".site_url('reff_identitas/ubah/'.$row->replid)."')) class='btn btn-xs btn-warning fa fa-check-square' ></a>&nbsp;&nbsp;";
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
	                		<label class="control-label" for="minlengthfield">Jenjang</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		echo $isi->departemen;
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
                        <input type="hidden" name="replid" value="<?php echo $isi->replid ?>">
                        <input type="hidden" name="departemen" value="<?php echo $isi->departemen ?>">
								</div>
	                		</div>
			            </th></tr>
            <tr>
				            <th align="left">
		                		<label class="control-label" for="minlengthfield">Nama</label>
		                		<div class="control-group">
									<div class="controls">:
				                	<?php
				                		echo form_input(array('id' => 'nama','name'=>'nama','value'=>$isi->nama,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'200', 'data-rule-minlength'=>'1','data-rule-number'=>'false','placeholder'=>'Masukkan 1-200 Karakter','style'=>'width:650px;'));
				                	?>
				                	<?php //echo  <p id="message"></p> ?>
									</div>
		                		</div>
				        </th></tr>
                <tr>
    				            <th align="left">
    		                		<label class="control-label" for="minlengthfield">Kode Cabang</label>
    		                		<div class="control-group">
    									<div class="controls">:
    				                	<?php
    				                		echo form_input(array('id' => 'kode_cabang','name'=>'kode_cabang','value'=>$isi->kode_cabang,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'2', 'data-rule-minlength'=>'2','data-rule-number'=>'false','placeholder'=>'Masukkan 2 Karakter'));
    				                	?>
    				                	<?php //echo  <p id="message"></p> ?>
    									</div>
    		                		</div>
    				        </th></tr>
              <tr><td align="left"><h4>Lokasi 1<h4><hr/></td></tr>
              <tr>
  				            <th align="left">
  		                		<label class="control-label" for="minlengthfield">Alamat</label>
  		                		<div class="control-group">
  									<div class="controls">:
                          <?php
                            echo form_textarea(array('class' => '', 'id' => 'alamat1','name'=>'alamat1','value'=>$isi->alamat1,'data-rule-required'=>'false' ,'data-rule-maxlength'=>'500', 'data-rule-minlength'=>'2' ,'placeholder'=>'Masukkan 2-500 Karakter'));
                          ?>
  				                	<?php //echo  <p id="message"></p> ?>
  									</div>
  		                		</div>
  				        </th></tr>
                  <tr>
      				            <th align="left">
      		                		<label class="control-label" for="minlengthfield">No. Telp1.</label>
      		                		<div class="control-group">
      									<div class="controls">:
      				                	<?php
      				                		echo form_input(array('id' => 'telp1','name'=>'telp1','value'=>$isi->telp1,'data-rule-required'=>'false' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'1','data-rule-number'=>'false'));
      				                	?>
      				                	<?php //echo  <p id="message"></p> ?>
      									</div>
      		                		</div>
      				        </th></tr>
                      <tr>
                              <th align="left">
                                  <label class="control-label" for="minlengthfield">No. Telp2.</label>
                                  <div class="control-group">
                            <div class="controls">:
                                    <?php
                                      echo form_input(array('id' => 'telp2','name'=>'telp2','value'=>$isi->telp2,'data-rule-required'=>'false' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'1','data-rule-number'=>'false'));
                                    ?>
                                    <?php //echo  <p id="message"></p> ?>
                            </div>
                                  </div>
                          </th></tr>
                          <tr>
                                  <th align="left">
                                      <label class="control-label" for="minlengthfield">No. Fax.</label>
                                      <div class="control-group">
                                <div class="controls">:
                                        <?php
                                          echo form_input(array('id' => 'fax1','name'=>'fax1','value'=>$isi->fax1,'data-rule-required'=>'false' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'1','data-rule-number'=>'false'));
                                        ?>
                                        <?php //echo  <p id="message"></p> ?>
                                </div>
                                      </div>
                              </th></tr>
                      <tr><td align="left"><h4>Lokasi 2<h4><hr/></td></tr>
                      <tr>
          				            <th align="left">
          		                		<label class="control-label" for="minlengthfield">Alamat</label>
          		                		<div class="control-group">
          									<div class="controls">:
                                  <?php
                                    echo form_textarea(array('class' => '', 'id' => 'alamat2','name'=>'alamat2','value'=>$isi->alamat2,'data-rule-required'=>'false' ,'data-rule-maxlength'=>'500', 'data-rule-minlength'=>'2' ,'placeholder'=>'Masukkan 2-500 Karakter'));
                                  ?>
          				                	<?php //echo  <p id="message"></p> ?>
          									</div>
          		                		</div>
          				        </th></tr>
                          <tr>
              				            <th align="left">
              		                		<label class="control-label" for="minlengthfield">No. Telp1.</label>
              		                		<div class="control-group">
              									<div class="controls">:
              				                	<?php
              				                		echo form_input(array('id' => 'telp3','name'=>'telp3','value'=>$isi->telp3,'data-rule-required'=>'false' ,'data-rule-maxlength'=>'3', 'data-rule-minlength'=>'1','data-rule-number'=>'false'));
              				                	?>
              				                	<?php //echo  <p id="message"></p> ?>
              									</div>
              		                		</div>
              				        </th></tr>
                              <tr>
                                      <th align="left">
                                          <label class="control-label" for="minlengthfield">No. Telp2.</label>
                                          <div class="control-group">
                                    <div class="controls">:
                                            <?php
                                              echo form_input(array('id' => 'telp4','name'=>'telp4','value'=>$isi->telp4,'data-rule-required'=>'false' ,'data-rule-maxlength'=>'3', 'data-rule-minlength'=>'1','data-rule-number'=>'false'));
                                            ?>
                                            <?php //echo  <p id="message"></p> ?>
                                    </div>
                                          </div>
                                  </th></tr>
                                  <tr>
                                          <th align="left">
                                              <label class="control-label" for="minlengthfield">No. Fax.</label>
                                              <div class="control-group">
                                        <div class="controls">:
                                                <?php
                                                  echo form_input(array('id' => 'fax2','name'=>'fax2','value'=>$isi->fax2,'data-rule-required'=>'false' ,'data-rule-maxlength'=>'3', 'data-rule-minlength'=>'1','data-rule-number'=>'false'));
                                                ?>
                                                <?php //echo  <p id="message"></p> ?>
                                        </div>
                                              </div>
                                      </th></tr>
                  <tr><td align="left"><h4>Situs Dan Email<h4><hr/></td></tr>
                  <tr>
                          <th align="left">
                              <label class="control-label" for="minlengthfield">Situs</label>
                              <div class="control-group">
                        <div class="controls">:
                              <?php
                                echo form_input(array('id' => 'situs','name'=>'situs','value'=>$isi->situs,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'1','data-rule-number'=>'false'));
                              ?>
                                <?php //echo  <p id="message"></p> ?>
                        </div>
                              </div>
                      </th></tr>
                      <tr>
                              <th align="left">
                                  <label class="control-label" for="minlengthfield">Email</label>
                                  <div class="control-group">
                            <div class="controls">:
                                  <?php
                                    echo form_input(array('id' => 'email','name'=>'email','value'=>$isi->email,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'1','data-rule-number'=>'false'));
                                  ?>
                                    <?php //echo  <p id="message"></p> ?>
                            </div>
                                  </div>
                          </th></tr>
				    <tr>
				            <th align="left">
				            	<button class='btn btn-primary' onclick="return validate()">Simpan</button>
				            	<a href="javascript:void(window.open('<?php echo site_url("reff_identitas") ?>'))" class="btn btn-success">Kembali</a>
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
