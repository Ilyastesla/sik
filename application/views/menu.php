                <!-- sidebar: style can be found in sidebar.less -->
<!--
<script>
 $(document).ready(function() {
 	 $("#penggunaonline").load("<?php echo base_url().'index.php/chat/pegawaionline'; ?>");
   var refreshId = setInterval(function() {
      $("#penggunaonline").load("<?php echo base_url().'index.php/chat/pegawaionline'; ?>");
   }, 7000);
   $.ajaxSetup({ cache: false });
});
</script>
-->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left image">
                            <?php
                            if ($this->session->userdata('fotodisplay')<>""){
                        	?>
                            	<img src="<?php echo base_url(); ?>uploads/fotodisplay/<?php echo $this->session->userdata('fotodisplay') ?>" class="img-circle" alt="User Image"  />
                            <?php }else{?>
                            	<img src="<?php echo base_url(); ?>images/blankfotodisplay.png" class="img-circle" alt="User Image" />
                            <?php } ?>
                        </div>
                        <div class="pull-left info">
                            <p>Hello, <?php echo $this->session->userdata('panggilan');?></p>

                            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                        </div>
                    </div>
                    <!-- search form -->
                    <!--
                    <form action="#" method="get" class="sidebar-form">
                        <div class="input-group">
                            <input type="text" name="q" class="form-control" placeholder="Search..."/>
                            <span class="input-group-btn">
                                <button type='submit' name='seach' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                            </span>
                        </div>
                    </form>
                    -->
                    <!-- /.search form -->
                    <!-- sidebar menu: : style can be found in sidebar.less -->

                    <ul class="sidebar-menu">
                        <?php echo $this->menu->build_menu()?>
                        <!--
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-users"></i>
                                <span>SDM</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="javascript:void(window.open('<?php echo site_url('pegawai'); ?>'))"><i class="fa fa-angle-double-right"></i> List Pegawai</a></li>
                                <li><a href="javascript:void(window.open('<?php echo site_url('jabatan'); ?>'))"><i class="fa fa-angle-double-right"></i> Struktur Organisasi</a></li>
                            </ul>
                        </li>

                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-book"></i>
                                <span>Pengeluaran</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="javascript:void(window.open('<?php echo site_url('ppkb'); ?>'))"><i class="fa fa-angle-double-right"></i> PPKB</a></li>
                                <li><a href="javascript:void(window.open('<?php echo site_url('ppkb'); ?>'))"><i class="fa fa-angle-double-right"></i> UUDP</a></li>
                                <li><a href="javascript:void(window.open('<?php echo site_url('jenis_pengeluaran'); ?>'))"><i class="fa fa-angle-double-right"></i> Jenis Pengeluaran</a></li>
                            </ul>
                        </li>
                        <li class="treeview" >
                            <a href="#">
                                <i class="fa fa-book"></i>
                                <span>Pinjaman</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href=""><i class="fa fa-angle-double-right"></i> Pengajuan Modal</a></li>
                            </ul>
                        </li>

                        <li class="treeview" >
                            <a href="#">
                                <i class="fa fa-book"></i>
                                <span>Referensi Keuangan</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="javascript:void(window.open('<?php echo site_url('coa'); ?>'))"><i class="fa fa-angle-double-right"></i> Kode Rekening Akuntansi</a></li>
                                <li><a href="javascript:void(window.open('<?php echo site_url('tahunbuku'); ?>'))"><i class="fa fa-angle-double-right"></i> Tahun Buku</a></li>
                            </ul>
                        </li>

                        <!--
                        <li>
                            <a href="../widgets.html">
                                <i class="fa fa-th"></i> <span>Widgets</span> <small class="badge pull-right bg-green">new</small>
                            </a>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-bar-chart-o"></i>
                                <span>Charts</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="../charts/morris.html"><i class="fa fa-angle-double-right"></i> Morris</a></li>
                                <li><a href="../charts/flot.html"><i class="fa fa-angle-double-right"></i> Flot</a></li>
                                <li><a href="../charts/inline.html"><i class="fa fa-angle-double-right"></i> Inline charts</a></li>
                            </ul>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-laptop"></i>
                                <span>UI Elements</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="../UI/general.html"><i class="fa fa-angle-double-right"></i> General</a></li>
                                <li><a href="../UI/icons.html"><i class="fa fa-angle-double-right"></i> Icons</a></li>
                                <li><a href="../UI/buttons.html"><i class="fa fa-angle-double-right"></i> Buttons</a></li>
                                <li><a href="../UI/sliders.html"><i class="fa fa-angle-double-right"></i> Sliders</a></li>
                                <li><a href="../UI/timeline.html"><i class="fa fa-angle-double-right"></i> Timeline</a></li>
                            </ul>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-edit"></i> <span>Forms</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="../forms/general.html"><i class="fa fa-angle-double-right"></i> General Elements</a></li>
                                <li><a href="../forms/advanced.html"><i class="fa fa-angle-double-right"></i> Advanced Elements</a></li>
                                <li><a href="../forms/editors.html"><i class="fa fa-angle-double-right"></i> Editors</a></li>
                            </ul>
                        </li>
                        <li class="treeview active">
                            <a href="#">
                                <i class="fa fa-table"></i> <span>Tables</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="simple.html"><i class="fa fa-angle-double-right"></i> Simple tables</a></li>
                                <li class="active"><a href="data.html"><i class="fa fa-angle-double-right"></i> Data tables</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="../calendar.html">
                                <i class="fa fa-calendar"></i> <span>Calendar</span>
                                <small class="badge pull-right bg-red">3</small>
                            </a>
                        </li>
                        <li>
                            <a href="../mailbox.html">
                                <i class="fa fa-envelope"></i> <span>Mailbox</span>
                                <small class="badge pull-right bg-yellow">12</small>
                            </a>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-folder"></i> <span>Examples</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="../examples/invoice.html"><i class="fa fa-angle-double-right"></i> Invoice</a></li>
                                <li><a href="../examples/login.html"><i class="fa fa-angle-double-right"></i> Login</a></li>
                                <li><a href="../examples/register.html"><i class="fa fa-angle-double-right"></i> Register</a></li>
                                <li><a href="../examples/lockscreen.html"><i class="fa fa-angle-double-right"></i> Lockscreen</a></li>
                                <li><a href="../examples/404.html"><i class="fa fa-angle-double-right"></i> 404 Error</a></li>
                                <li><a href="../examples/500.html"><i class="fa fa-angle-double-right"></i> 500 Error</a></li>
                                <li><a href="../examples/blank.html"><i class="fa fa-angle-double-right"></i> Blank Page</a></li>
                            </ul>
                        </li>
                        -->
                    </ul>
                    <?php
                    //echo $this->menu->build_pegawai();
                    ?>
                </section>
                <!-- /.sidebar -->
