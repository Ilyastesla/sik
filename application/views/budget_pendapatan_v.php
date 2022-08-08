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
                        <li><a href="javascript:void(window.open('<?php echo site_url('budget_pendapatan/tambah'); ?>'))"><i class="fa fa-plus-square"></i> Tambah</a></li>

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
                                                <th>Nama</th>
                                                <th>Tipe</th>
                                                <th>Head</th>
                                                <th>No. Urut</th>
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
											    echo "<td align='center'>".($row->budget_pendapatan)."</td>";
                          echo "<td align='center'>".($row->type)."</td>";
                          echo "<td align='center'>".($row->headtext)."</td>";
                          echo "<td align='center'>".($row->urutan)."</td>";
											    echo "<td align='center'>".$CI->p_c->cekaktif($row->aktif)."</td>";
											    echo "<td align='center'><a href=javascript:void(window.open('".site_url('budget_pendapatan/ubah/'.$row->replid)."')) class='btn btn-xs btn-warning fa fa-check-square'></a>&nbsp;&nbsp;";
													echo "<a href=javascript:void(window.open('".site_url('budget_pendapatan/hapus/'.$row->replid)."')) class='btn btn-xs btn-danger fa fa-minus-square'></a>";
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
          <table width="100%" border="1">
            <?php
            echo "<tr>";
            echo "<th>NO</th>";
            echo "<th colspan='3'>KETERANGAN</th>";
            echo "<th>JML SISWA SISTEM</th>";
            echo "<th>JML SISWA</th>";
            echo "<th>BIAYA</th>";
            echo "<th>FREKUENSI</th>";
            echo "</tr>";


            foreach((array)$idjenis_pendapatan_opt as $rowjp) {
                echo "<tr>";
                echo "<th align='left' colspan='9'>".strtoupper($rowjp->budget_reff)."</th>";
                echo "</tr>";
                echo "<tr>";
                $nojb=1;
                $jenis_biaya=$CI->budget_pendapatan_db->jenis_biaya($rowjp->replid);
                foreach((array)$jenis_biaya as $rowjb) {
                      echo "<td align='center'><b>".$nojb++."</b></td>";
                      echo "<th align='left' colspan='8'>".strtoupper($rowjb->budget_reff)."</th>";
                      echo "</tr>";

                      $kelompok="";$notingkat='A';
                      foreach((array)$idtingkat_opt as $rowtingkat) {
                          echo "<tr>";
                          echo "<th>&nbsp;</th>";
                          if($kelompok<>$rowtingkat->kelompoktext){
                              echo "<td align='center'><b>".$notingkat++."</b></td>";
                              echo "<th align='left'>".$rowtingkat->kelompoktext."</th>";
                          }else{
                             echo "<th>&nbsp;</th>";
                              echo "<th align='left'>&nbsp;</th>";
                          }
                          echo "<th align='left'>".$rowtingkat->tingkat."</th>";
                          echo "<td align='center'><b>".$rowtingkat->jmlsiswasistem."</b></td>";
                          echo "<td align='center'><input type='text' name='jmlsiswa' value='' style='width:50px;'></td>";
                          echo "<td align='center'><input type='text' name='biaya' value='' style='width:150px;'></td>";
                          echo "<td align='center'><input type='text' name='frekuensi' value='' style='width:50px;'></td>";
                          echo "</tr>";
                          $kelompok=$rowtingkat->kelompoktext;
                      }
                }
            }
            ?>
          </table><br/>

		    	<table width="100%" border="0">
			         <tr>
				            <th align="left">
				            	<button class='btn btn-primary' onclick="return validate()">Simpan</button>
				            	<a href="javascript:void(window.open('<?php echo site_url('budget_pendapatan') ?>'))" class="btn btn-success">Batal</a>
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
