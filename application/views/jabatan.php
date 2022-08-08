<!DOCTYPE html>
<html>
    <?php $this->load->view('header') ?>
    <!--
    <link href="<?php echo base_url(); ?>css/organization.css" rel="stylesheet" type="text/css" />
     -->
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

                    <ol class="breadcrumb">
                        <li><a href="javascript:void(window.open('<?php echo site_url('ppkb/tambah'); ?>'))" ><i class="fa fa-plus-square"></i> Tambah</a></li>
                        <li><a href="#"><i class="fa fa-file-text"></i>Cetak</a></li>
                        <li><a href="#"><i class="fa fa-file-excel-o"></i>Excel</a></li>
                    </ol>
                </section>


                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="tree">
	                            <ul>
	                            <?php
		                            $ntree = 0;
		                            $rootid=0;$rootid2=0;
									foreach((array)$show_table as $row) {
										$idjab = $row->replid;
										$sing  = $row->singkatan;
										$jab   = $row->jabatan;
										$rootid = $row->rootid;
										if ($rootid<>$rootid2){
											//if ($rootid2<>0){echo "</ul>--";}
											echo "<ul>";
											$x=1;
										}
										echo "<li><a href='#'>".$sing."</a></i>";
										$rootid2 = $row->rootid;
									}
									?>
									</ul>

                            </div>
                        </div>
                    </div>
              </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
    </body>
</html>
