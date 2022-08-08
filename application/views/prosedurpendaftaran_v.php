<!DOCTYPE html>
<html>
    <?php $this->load->view('header');
    $CI =& get_instance();
    ?>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas">
            <?php  $this->load->view('menu_ppdbo_v')
            ?>
            </aside>
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Main content -->
                <section class="content">
                  <?php echo "<img src='".site_url("../uploads/material/prosedurpendaftaran.jpeg")."' width='95%'>"  ?>
                  <?php
                  $CI =& get_instance();
                  $no=1;$icon="";
                  foreach((array)$show_table as $row) {
                    ?>
                        <div class="timeline-item">
                            <h3 class="timeline-header"><?php echo $row->subjek; ?></h3>
                            <div class="timeline-body">
                                <?php echo $row->isi_berita; ?>
                            </div>
                        </div>
                    <?php
                    }
                    echo "<br/><h3><a href='".site_url("../uploads/material/Prosedur_Pendaftaran_kss.pdf")."' target='_blank'> Unduh Prosedur Pendaftaran Disini</a></h3>";
                  ?>
                </section>

   </body>
</html>
