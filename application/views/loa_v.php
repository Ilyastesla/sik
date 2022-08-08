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
                        <li><a href="javascript:void(window.open('<?php echo site_url('loa/tambah'); ?>'))" ><i class="fa fa-plus-square"></i> Tambah</a></li>

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
                                                <th>Modul</th>
                                                <th>Grup Jabatan</th>
                                                <th>Jabatan</th>
                                                <th>Departemen</th>
                                                <th>Node</th>
                                                <th>Next Node</th>
                                                <th>Default Node</th>
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
											    echo "<td align='center'>".strtoupper($row->idmodul)."</td>";
											    echo "<td align='center'>".strtoupper($row->idjabatan_grup)."</td>";
                          echo "<td align='center'>".strtoupper($row->jabatantext)."</td>";
											    echo "<td align='center'>".strtoupper($row->iddepartemen)."</td>";
											    echo "<td align='center'>".strtoupper($row->node)."</td>";
											    echo "<td align='center'>".strtoupper($row->next_node)."</td>";
											    echo "<td align='center'>".($CI->p_c->cekaktif($row->default_node))."</td>";
											    echo "<td align='center'>".$CI->p_c->cekaktif($row->aktif)."</td>";
											    echo "<td align='center'>";
													echo "<a href=javascript:void(window.open('".site_url('loa/ubah/'.$row->replid)."')) class='btn btn-xs btn-warning fa fa-check-square' ></a>&nbsp;&nbsp;";
													echo "<a href=javascript:void(window.open('".site_url('loa/hapus/'.$row->replid)."')) class='btn btn-xs btn-danger fa fa-minus-square' ></a>";
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
		        		<label class="control-label" for="minlengthfield">Modul</label>
		        		<div class="control-group">
							<div class="controls">:
		                	<?php
		                		$arrmodul='data-rule-required=true';
		                		echo form_dropdown('idmodul',$modul_opt,$isi->idmodul,$arrmodul);
		                	?>
		                	<?php //echo  <p id="message"></p> ?>
							</div>
		        		</div>
		            </th></tr>
		            <tr>
		            <th align="left">
		        		<label class="control-label" for="minlengthfield">Grup Jabatan</label>
		        		<div class="control-group">
							<div class="controls">:
		                	<?php
		                		$arrjabatan_grup='data-rule-required=false';
		                		echo form_dropdown('idjabatan_grup',$jabatan_grup_opt,$isi->idjabatan_grup,$arrjabatan_grup);
		                	?>
		                	<?php //echo  <p id="message"></p> ?>
							</div>
		        		</div>
		            </th></tr>
                <tr>
		            <th align="left">
		        		<label class="control-label" for="minlengthfield">Jabatan</label>
		        		<div class="control-group">
							<div class="controls">:
		                	<?php
		                		$arrjabatan='data-rule-required=false';
		                		echo form_dropdown('idjabatan',$jabatan_opt,$isi->idjabatan,$arrjabatan);
		                	?>
		                	<?php //echo  <p id="message"></p> ?>
							</div>
		        		</div>
		            </th></tr>
		            <tr>
		            <th align="left">
		        		<label class="control-label" for="minlengthfield">Departemen</label>
		        		<div class="control-group">
							<div class="controls">:
		                	<?php
		                		$arrdepartemen='data-rule-required=false';
		                		echo form_dropdown('iddepartemen',$departemen_opt,$isi->iddepartemen,$arrdepartemen);
		                	?>
		                	<?php //echo  <p id="message"></p> ?>
							</div>
		        		</div>
		            </th></tr>
		            <tr>
		            <th align="left">
		        		<label class="control-label" for="minlengthfield">Node</label>
		        		<div class="control-group">
							<div class="controls">:
		                	<?php
		                		$arrnode='data-rule-required=true';
		                		echo form_dropdown('node',$node_opt,$isi->node,$arrnode);
		                	?>
		                	<?php //echo  <p id="message"></p> ?>
							</div>
		        		</div>
		            </th></tr>

		            <tr>
		            <th align="left">
		        		<label class="control-label" for="minlengthfield">Next Node</label>
		        		<div class="control-group">
							<div class="controls">:
		                	<?php
		                		$arrnext_node='data-rule-required=true';
		                		echo form_dropdown('next_node',$next_node_opt,$isi->next_node,$arrnext_node);
		                	?>
		                	<?php //echo  <p id="message"></p> ?>
							</div>
		        		</div>
		            </th></tr>
		            <tr>
		            	<th align="left">
		        		<label class="control-label" for="minlengthfield">Default Node</label>
		        		<div class="control-group">
							<div class="controls">:
		                	<?php
		                		echo form_checkbox('default_node', '1', $isi->default_node);
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
				            	<a href="javascript:void(window.open('<?php echo site_url('loa') ?>'))" class="btn btn-success">Batal</a>
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
