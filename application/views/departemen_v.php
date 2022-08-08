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
                        <li><a href="javascript:void(window.open('<?php echo site_url('departemen/tambah'); ?>'))"><i class="fa fa-plus-square"></i> Tambah</a></li>

                    </ol>
                </section>
                <section class="content-header table-responsive">
                    <?php
			        $attributes = array('class' => 'form-horizontal form-validate', 'id' => 'form', 'method' => 'POST', 'novalidate'=>'novalidate','onsubmit'=>'return validate()');
		    	echo form_open($action,$attributes);
		    		?>
                	<table width="100%" border="0">
	                    <tr>
	                    	<td align="left" width="150">Unit Bisnis</td>
				            <td align="left">
                      <div class="control-group">
				            	<?php
			                		$arridcompany="data-rule-required=true id=idcompany  onchange='javascript:this.form.submit();' ";
			                		echo form_dropdown('idcompany',$idcompany_opt,$this->input->post('idcompany'),$arridcompany);
			                	?>
                      </div>
				            </td>
			            </tr>
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
                                                <?php
                                                echo "<th width='50'>No.</th>";
                                                echo "<th>Perusahaan</th>";
                                                echo "<th>Departemen</th>";
                                                //echo "<th>Kode Departemen<th>";
                                                echo "<th>Aktif</th>";
                                                echo "<th width='80'>Aksi</th>";
                                                ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        	<?php
                                        	$CI =& get_instance();
                                        	$no=1;
											foreach((array)$show_table as $row) {
											    echo "<tr>";
											    echo "<td align='center'>".$no++."</td>";
                          echo "<td align='center'>".strtoupper($row->companytext)."</td>";
											    echo "<td align='center'>".strtoupper($row->departemen)."</td>";
											    //echo "<td align='center'>".strtoupper($row->kodedepartemen)."</td>";
											    echo "<td align='center'>".$CI->p_c->cekaktif(strtoupper($row->aktif))."</td>";
											    echo "<td align='center'>";
                          echo "<a href=javascript:void(window.open('".site_url('departemen/ubah/'.$row->replid)."')) class='btn btn-xs btn-warning fa fa-check-square'></a>&nbsp;";
                          echo "<a href=javascript:void(window.open('".site_url('departemen/hapus/'.$row->replid)."')) class='btn btn-xs btn-danger fa fa-minus-square'></a>";
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
                	if (isset($error)){
            	?>
            	<div class="alert alert-danger alert-dismissable">
                        <i class="fa fa-ban"></i>
                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                        <b>Peringatan!</b> <?php echo $error; ?>.
                </div>
                <?php
                }

			        $attributes = array('class' => 'form-horizontal form-validate', 'id' => 'form', 'method' => 'POST', 'novalidate'=>'novalidate','onsubmit'=>'return validate()');
		    	echo form_open($action,$attributes);
		    	?>
		    	<table width="100%" border="0">
            <tr>
            <th align="left">
            <label class="control-label" for="minlengthfield">Unit Bisnis</label>
            <div class="control-group">
                <div class="controls">:
                        <?php
                          $arridcompany='data-rule-required=true';
                          echo form_dropdown('idcompany',$idcompany_opt,$isi->idcompany,$arridcompany);
                        ?>
                </div>
                  </div>
            </th></tr>
		    		<tr>
		            <th align="left">
	                		<label class="control-label" for="minlengthfield">Departemen</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		echo form_input(array('class' => '', 'id' => 'departemen','name'=>'departemen','value'=>$isi->departemen,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'2' ,'placeholder'=>'Masukkan 2-100 Karakter'));
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th></tr>
              <!--
			        <tr>
		            <th align="left">
	                		<label class="control-label" for="minlengthfield">Kode Departemen</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		echo form_input(array('class' => '', 'id' => 'kodedepartemen','name'=>'kodedepartemen','value'=>$isi->kodedepartemen,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'2', 'data-rule-minlength'=>'2' ,'placeholder'=>'Masukkan 2-100 Karakter'));
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
				            	<a href="javascript:void(window.open('<?php echo site_url('departemen') ?>'))" class="btn btn-success">Batal</a>
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
