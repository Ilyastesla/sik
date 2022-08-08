
                <section class="sidebar">
                    <ul class="sidebar-menu">
                        <?php  echo $this->menu->build_menu('erec',$this->session->userdata('logged_in'))
                        ?>
                    </ul>
                    <?php // echo $this->menu->build_pegawai()
                    ?>
                </section>
                <!-- /.sidebar -->
