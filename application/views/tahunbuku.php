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
                <section class="content-header table-responsive">
                    <h1>
                        <?php echo $form ?>
                        <small>List Data</small>
                    </h1>
                    <!--
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="#">Tables</a></li>
                        <li class="active">Data tables</li>
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
                                                <th>Tahun Buku</th>
                                                <th>Tanggal Mulai</th>
                                                <th>Awalan Kuitansi</th>
                                                <th>Departemen</th>
                                                <th>Keterangan</th>
                                                <th>Aktif</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        	<?php
											foreach((array)$show_table as $row) {
											    echo "<tr>";
											    echo "<td align='center'>".strtoupper($row->tahunbuku)."</td>";
											    echo "<td align=''>".strtoupper($row->tanggalmulai)."</td>";
											    echo "<td align='center'>".strtoupper($row->awalan)."</td>";
											     echo "<td align='center'>".strtoupper($row->departemen)."</td>";
											    echo "<td align='center'>".strtoupper($row->keterangan)."</td>";
											    echo "<td align='center'>".strtoupper($row->aktif)."</td>";
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
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
    </body>
</html>
