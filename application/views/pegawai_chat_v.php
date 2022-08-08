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
                        <li><a href="javascript:void(window.open('<?php echo site_url('pegawai_chat/tambah'); ?>'))" ><i class="fa fa-plus-square"></i> Tambah</a></li>

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
                                                <th>Antara</th>
                                                <th>Dengan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        	<?php
                                        	$CI =& get_instance();$no=1;
											foreach((array)$show_table as $row) {
											    echo "<tr>";
											    echo "<td align='center'>".$no++."</td>";
											    echo "<td align='center'>
											    			<a href=javascript:void(window.open('".site_url('pegawai_chat/view/'.$row->from.'/'.$row->to)."'))>".$row->fromtext."</a>
											    	  </td>";
											    echo "<td align='center'>".$row->totext."</td>";
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
<!------------------------------------------------------------------------------------------------------------------------------------->
<?php } elseif($view=='view'){ ?>
		    <section class="content-header table-responsive">
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
          <table id="example2" class="table table-bordered table-striped" border=0>
              <thead>
                  <tr>
                      <th width="200">Waktu Kirim</th>
                      <th width="200">Antara</th>
                      <th width="200">Dengan</th>
                      <th>Percakapan</th>
                  </tr>
              </thead>
              <tbody>
                <?php
                $CI =& get_instance();$no=1;
                foreach((array)$isi as $row) {
                echo "<tr>";
                echo "<td align='center'>".$row->sent."</td>";
                echo "<td align='center'>".$row->fromtext."</td>";
                echo "<td align='center'>".$row->totext."</td>";
                echo "<td align='center'>".$row->message."</td>";
                echo "</tr>";
                }
                ?>
				    </table>
            <table>
              <tr>
                      <th align="left" >
                            <a href="javascript:void(window.open('<?php echo site_url("pegawai_chat") ?>'))" class='btn btn-success'>Kembali</a>
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
