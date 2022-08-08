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
                    <ol class="breadcrumb">
                        <li><a href="javascript:void(window.open('<?php echo site_url('hrm_company/tambah'); ?>'))"><i class="fa fa-plus-square"></i> Tambah</a></li>

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
                                                <th width="80">No.</th>
                                                <th>Kode Unit Bisnis</th>
                                                <th>Kode Cabang</th>
                                                <th>Tipe Organisasi</th>
                                                <th>Nama</th>
                                                <th>Aktif</th>
                                                <th>PPDB</th>
                                                <!--
                                                <th width="80">Aksi</th>
                                                -->
                                            </tr>
                                        </thead>
                                        <tbody>
                                        	<?php
                                        	$CI =& get_instance();
                                        	$no=1;
											foreach((array)$show_table as $row) {
											    echo "<tr>";
											    echo "<td align='center'>".$no++."</td>";
											    echo "<td align='center'>".strtoupper($row->company_code)."</td>";
											    echo "<td align='center'>".strtoupper($row->kodecabang)."</td>";
											    echo "<td align='center'>".strtoupper($row->organizationcode)."</td>";
											    echo "<td align='center'>".strtoupper($row->nama)."</td>";
											    echo "<td align='center'>".$CI->p_c->cekaktif($row->aktif)."</td>";
                          echo "<td align='center'>".$CI->p_c->cekaktif($row->ppdb)."</td>";
											    /*
											    echo "<td align='center'>";
                          echo "<a href=javascript:void(window.open('".site_url('hrm_company/ubah/'.$row->replid)."')) class='btn btn-xs btn-warning fa fa-check-square'></a>&nbsp;&nbsp;";
                          echo "<a href=javascript:void(window.open('".site_url('hrm_company/hapus/'.$row->replid)."')) class='btn btn-xs btn-danger fa fa-minus-square'></a>";
                          echo "</td>";
											    */
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
<?php } ?>
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
    </body>
</html>
