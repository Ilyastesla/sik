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
                        <!--
                        <li><a href="javascript:void(window.open('<?php echo site_url('lyn_staff/tambah'); ?>'))" ><i class="fa fa-plus-square"></i> Tambah</a></li>
                        
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
                                                <th>NIK</th>
                                                <th>Nama</th>
                                                <th>Alamat</th>
                                                <th>Layanan</th>
                                                <th>Grup Jadwal</th>
                                                <th>Sektor</th>
                                                <th width="80">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        	<?php
                                        	$CI =& get_instance();$no=1;
											foreach((array)$show_table as $row) {
											    echo "<tr>";
											    echo "<td align='center'>".$no++."</td>";
                                                echo "<td align='center'>".$row->nip."</td>";

											    echo "<td align=''>".($row->nama)
											    		."<br/>(".strtoupper($row->panggilan).")</td>";
											    echo "<td align='center'>".strtoupper($row->alamat_tinggal)
											    	  ."<br/>Telp. ".strtoupper($row->telpon)
											    	  ."<br/>HP. ".strtoupper($row->handphone)
											    	   ."<br/>Email. ".$row->email
											    	   ."</td>";
                                                echo "<td align='center'>".$CI->dbx->layanan_show($row->replid)."</td>";
                                                echo "<td align='center'>".$CI->dbx->grupjadwal_show($row->replid)."</td>";
                                                echo "<td align='center'>".$CI->dbx->sektor_show($row->replid)."</td>";
											    echo "<td align='center'>";
											    echo "<a href=javascript:void(window.open('".site_url('lyn_staff/ubah/'.$row->replid)."')) class='btn btn-xs btn-warning fa fa-check-square' ></a>&nbsp;";
                          					    //echo "<a href=javascript:void(window.open('".site_url('lyn_staff/hapus/'.$row->replid)."')) class='btn btn-xs btn-danger fa fa-minus-square' ></a>";
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
	        		<label class="control-label" for="minlengthfield">Pegawai</label>
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
	        		<label class="control-label" for="minlengthfield">Layanan</label>
	        		<div class="control-group">
						<div class="controls">
			                <input type="checkbox" onClick="selectallx('idlayanan','selectalllayanan')" id="selectalllayanan" class="selectalllayanan"/> Pilih Semua <hr/>
                        <?php
                            $CI->p_c->checkbox_one('idlayanan',$idlayanan_opt);
		                ?>
						</div>
	        		</div>
							<hr/>
	            </th></tr>
                <tr>
	            <th align="left">
	        		<label class="control-label" for="minlengthfield">Grup Jadwal</label>
	        		<div class="control-group">
						<div class="controls">
			                <input type="checkbox" onClick="selectallx('idgrupjadwal','selectallgrupjadwal')" id="selectallgrupjadwal" class="selectallgrupjadwal"/> Pilih Semua <hr/>
                        <?php
                            $CI->p_c->checkbox_one('idgrupjadwal',$idgrupjadwal_opt);
		                ?>
						</div>
	        		</div>
							<hr/>
	            </th></tr>
                <tr>
	            <th align="left">
	        		<label class="control-label" for="minlengthfield">Sektor</label>
	        		<div class="control-group">
						<div class="controls">
			                <input type="checkbox" onClick="selectallx('idsektor','selectallsektor')" id="selectallsektor" class="selectallsektor"/> Pilih Semua <hr/>
                        <?php
                            $CI->p_c->checkbox_one('idsektor',$idsektor_opt);
		                ?>
						</div>
	        		</div>
							<hr/>
	            </th></tr>
				    <tr>
				            <th align="left">
				            	<button class='btn btn-primary' onclick="return validate()">Simpan</button>
				            	<a href="javascript:void(window.open('<?php echo site_url('lyn_staff') ?>'))" class="btn btn-success">Kembali</a>
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
