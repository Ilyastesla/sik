<!DOCTYPE html>
<html>
    <?php $this->load->view('header') ?>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas">
            <?php $this->load->view('menu_v') ?>
            </aside>
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
<?php $CI =& get_instance();?>
<?php if($view=='index'){ ?>
                <section class="content-header">
                    <h1>
                        <?php echo $form ?>
                        <small>List Data</small>
                    </h1>
                    <!--
                        <li><a href="#"><i class="fa fa-file-text"></i>Cetak</a></li>
                        <li><a href="#"><i class="fa fa-file-excel-o"></i>Excel</a></li>

                    <ol class="breadcrumb">
                        <li><a href="<?php echo site_url('online_recruitement_progress/tambah'); ?>"><i class="fa fa-plus-square"></i> Tambah</a></li>

                    </ol>
                    -->
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
                                                <th width="50">No.</th>
                                                <th width="200">Jabatan</th>
                                                <th width="*">Tipe Pekerjaan</th>
                                                <th>Deskripsi Lowongan</th>
                                                <th>Tanggal Melamar</th>
                                                <th>Harapan Gaji</th>
                                                <th>Tanggal Gabung</th>
                                                <th>Status</th>
                                                <th width="150">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        	<?php
                                        	$CI =& get_instance();
                                        	$no=1;
											foreach((array)$show_table as $row) {
											    echo "<tr>";
											    echo "<td align='center'>".$no++."</td>";
											    echo "<td align='center'><b>".$row->jabatantext."</b></td>";
                          echo "<td align='center'>".$row->tipepekerjaantext."</td>";
											    echo "<td align='left'>".$row->isi."</td>";
											    echo "<td align='center'>".strtoupper($CI->p_c->tgl_indo($row->created_date))."</td>";
                          echo "<td align='center'>".$CI->p_c->rupiah($row->harapangaji)."</td>";
                          echo "<td align='center'>".strtoupper($CI->p_c->tgl_indo($row->tglgabung))."</td>";
											    echo "<td align='center'>".$row->statustext."</td>";
											    echo "<td align='center'>";
                          if($row->status==1){
                              echo "<a href='".site_url('online_recruitement_progress/hapus/'.$row->replid)."' class='btn btn-danger'>Hapus</a>";
                          }
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
  <section class="content-header">
          <h1>
              <?php echo $form ?>
              <small><?php echo $form_small ?></small>
          </h1>
  </section>
  <section class="content">
  <?php
    $attributes = array('class' => 'form-horizontal form-validate', 'id' => 'form', 'method' => 'POST', 'novalidate'=>'novalidate');
    echo form_open($action,$attributes);
  ?>

  <table width="100%" border="0">
    <tr>
    <th align="left">
        <label class="control-label" for="minlengthfield">Jabatan</label>
        <div class="control-group">
  <div class="controls">:
          <?php
            echo $header->jabatantext;
          ?>
          <?php //echo  <p id="message"></p> ?>
  </div>
        </div>
    </th></tr>
    <tr>
    <th align="left">
        <label class="control-label" for="minlengthfield">Deskripsi</label>
        <div class="control-group">
  <div class="controls">:
          <?php
            echo $header->keterangan;
          ?>
          <?php //echo  <p id="message"></p> ?>
  </div>
        </div>
    </th></tr>
    <tr>
    <th align="left">
        <label class="control-label" for="minlengthfield">Kualifikasi :</label>
    </th></tr>
    <tr>
    <th align="left">
        <?php echo $header->isi; ?>
    </th></tr>

    <tr>
    <th align="left">
        <label class="control-label" for="minlengthfield">Harapan Gaji</label>
        <div class="control-group">
  <div class="controls">:
          <?php
            echo form_input(array('class' => '', 'id' => 'harapangaji','name'=>'harapangaji','value'=>$isi->harapangaji,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'200', 'data-rule-minlength'=>'2','data-rule-number'=>'true' ,'placeholder'=>'Masukkan 2-200 Karakter'));
          ?>
          <?php //echo  <p id="message"></p> ?>
  </div>
        </div>
    </th></tr>
    <tr>
    <th align="left">
        <label class="control-label" for="minlengthfield">Tgl. Bergabung</label>
        <div class="control-group">
  <div class="controls">:
          <?php
            echo form_input(array('class' => '', 'id' => 'dp1','name'=>'tglgabung','value'=>$CI->p_c->tgl_form($isi->tglgabung),'data-rule-required'=>'true' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'2' ,'placeholder'=>'DD-MM-YYYY'));
          ?>
          <?php //echo  <p id="message"></p> ?>
  </div>
        </div>
    </th></tr>
  </table>
  <br/>
  <table>
    <tr>
      <td align='left'>
      <button class='btn btn-primary'>Simpan</button>
      <a href="<?php echo site_url('online_recruitement_progress') ?>" class="btn btn-warning">Progres Lamaran</a>
      <a href="<?php echo site_url('main') ?>" class="btn bg-navy">Lowongan Pekerjaan</a>
    </td>
  </tr>
  </table>
</section>
<?php } elseif($view=='view'){ ?>
			<section class="content-header">
	            <h1>
	                <?php echo $form ?>
	                <small><?php echo $form_small ?></small>
	            </h1>
            </section>
            <section class="content">
			<?php
		        $attributes = array('class' => 'form-horizontal form-validate', 'id' => 'form', 'method' => 'POST', 'novalidate'=>'novalidate');
	    	echo form_open($action,$attributes);
	    	?>
	    	<table width="100%" border="0">
	    		<tr>
	            <th align="left">
	        		<label class="control-label" for="minlengthfield">Lowongan Pekerjaan</label>
	        		<div class="control-group">
						<div class="controls">:
	                	<?php
	                		echo $isi->subjek;
	                	?>
						</div>
	        		</div>
	            </th></tr>
	            <tr>
	            <th align="left">
	        		<label class="control-label" for="minlengthfield">Aktif</label>
	        		<div class="control-group">
						<div class="controls">:
	                	<?php
	                		echo $CI->p_c->cekaktif($isi->aktif);
	                	?>
						</div>
	        		</div>
            </th></tr>
            <tr>
  	            <th align="left">
  	        		<label class="control-label" for="minlengthfield">Deskripsi Lowongan</label>
  	        		<div class="control-group">
  						<div class="controls">:
  						</div>
  	        		</div><hr />
  	            </th></tr>
                <tr>
      	            <td align="left">
      	        		      	<?php
      	                		echo $isi->isi;
      	                	?>
      						  </td></tr>
	            <tr>
		            <td align="left">
		            	<a href="<?php echo site_url("online_recruitement_progress") ?>" class="btn btn-success">Kembali</a>
		            	<a href="<?php echo site_url('online_recruitement_progress/hapus/'.$isi->aktif) ?>" class="btn btn-danger">Hapus</a>
		            </td>
	            </tr>
	            </table>
            </section>
	        	<?php
	        	echo form_close();
 } ?>
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
    </body>
</html>
