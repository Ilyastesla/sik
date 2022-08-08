<!DOCTYPE html>
<html>
    <?php $this->load->view('header');
    $CI =& get_instance();
    ?>
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
                        <?php
                        echo $form;
                        echo "<br/>";
                        //echo "<small>".$form_small."</small>";
                        echo "<small>".$this->config->item('app_name')."</small>";
                        echo "<small> ".$this->config->item('company')."</small>";
                        echo "<small> Ver. ".$this->config->item('version')."</small>";
                        echo "<br/>";
                        //echo "<small>".$this->config->item('company')."</small>";
                        //echo "<br/><small>".$this->session->userdata('companytext')."</small>";
                        ?>
                    </h1>
                    <!--
                    <ol class="breadcrumb">
                        <li><a href="JavaScript:cetakpegawai()"><i class="fa fa-file-text"></i>Cetak</a></li>
                        <li><a href="JavaScript:cetakpegawaiexcel()"><i class="fa fa-file-excel-o"></i>Excel</a></li>
                        <li><a href="javascript:void(window.open('<?php echo site_url('pegawai/tambah'); ?>'))" ><i class="fa fa-plus-square"></i> Tambah</a></li>
                    </ol>
                    -->
                </section>
                <!-- Main content -->
                <section class="content">
                  <!--
                	<h3>SELAMAT DATANG, <?php echo $this->session->userdata('nama')."<br/> (".$CI->dbx->role_show($this->session->userdata('role_id'),0).")";?>
                  -->
                	</h3>
                	<!-- row -->
                  <div class="row">
                    <div class="col-md-3">
                      <div class="box box-primary">
                        <div class="box-body box-profile">
                        <h3 class="profile-username text-center"><?php echo $this->session->userdata('nama')?></h3>
                        <p class="text-muted text-center"><?php echo $this->session->userdata('nip') ?></p>
                        </div>
                      </div>


                      <div class="box box-primary">
                        <div class="box-header with-border">
                          <h3 class="box-title">Peran di SIK</h3>
                        </div>
                        <div class="box-body">
                          <strong><i class="fa fa-map-marker margin-r-5"></i> Unit Bisnis</strong>
                          <p class="text-muted">
                          <?php echo str_replace(',','<br/>',$CI->dbx->company_show($this->session->userdata('idcompany'),0,0)) ?>
                          </p>
                          <hr>
                          <strong><i class="fa fa-book margin-r-5"></i> Peran</strong>
                          <p class="text-muted">
                          <?php echo str_replace(',','<br/>',$CI->dbx->role_show($this->session->userdata('role_id'),0,0)) ?>
                          </p>
                          <hr>
                          <strong><i class="fa fa-pencil margin-r-5"></i> Jenjang</strong>
                          <p>
                          <?php 
                          if($this->session->userdata('dept')<>""){
                            $arraydept=explode(",",$CI->dbx->departemen_show($this->session->userdata('dept')));
                            $color = array("success", "success", "info", "warning", "danger");
                            foreach((array)$arraydept as $rowdept){
                              echo "<span class='label label-".$color[array_rand($color)]."'>".$rowdept."</span>&nbsp;";
                            }
                          }
                          
                          ?>
                          </p>
                          <hr>
                          <strong><i class="fa fa-file-text-o margin-r-5"></i> Kontrak Kerja</strong>
                          <?php 
                          $no=1;$icon="";
                          foreach((array)$jabatan as $rowkontrak) {
                            ?>
                            <li>
                                         <?php echo $rowkontrak->jabatantext.' berakhir pada '. $CI->p_c->tgl_indo($rowkontrak->akhir_kontrak)?>
                                         <br/><span class="time"><i class="fa fa-clock-o"></i> Sisa <?php echo $rowkontrak->sisahari; ?> Hari</span>

                            </li>
                            <?php
                            }
                            ?>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-9">
                      <div class="row">
                       <!--
                                <div class="col-lg-3 col-xs-6">
                                  <div class="small-box bg-blue">
                                    <div class="inner">
                                      <h3><?php echo $jumlahtamu?></h3>

                                      <p>Jumlah Tamu</p>
                                    </div>
                                    <div class="icon">
                                      <i class="fa fa-book"></i>
                                    </div>
                                    <a href="#" class="small-box-footer">Per Tahun Berjalan</a>
                                  </div>
                                </div>
                              
                                <div class="col-lg-3 col-xs-6">
                                  <div class="small-box bg-green">
                                    <div class="inner">
                                      <h3><?php echo $jumlahcs?></h3>

                                      <p>Jumlah CPD</p>
                                    </div>
                                    <div class="icon">
                                      <i class="fa fa-filter"></i>
                                    </div>
                                    <a href="#" class="small-box-footer">Per Tahun Berjalan</a>
                                  </div>
                                </div>
                                -->
                                <div class="col-md-6">
                                    <div class="small-box bg-blue">
                                      <div class="inner">
                                        <h3><?php echo $jumlahsiswabaru ?></h3>

                                        <p>Jumlah Siswa Baru</p>
                                      </div>
                                      <div class="icon">
                                        <i class="fa fa-book"></i>
                                      </div>
                                      <a href="#" class="small-box-footer">Per Tahun Pelajaran Aktif</a>
                                    </div>
                                  </div>
                                <!-- ./col -->
                                <div class="col-md-6">
                                  <!-- small box -->
                                  <div class="small-box bg-yellow">
                                    <div class="inner">
                                      <h3><?php echo $jumlahsiswa?></h3>
                                      <p>Jumlah Siswa</p>
                                    </div>
                                    <div class="icon">
                                      <i class="fa fa-graduation-cap"></i>
                                    </div>
                                    <a href="#" class="small-box-footer">Per Tahun Pelajaran Aktif</a>
                                  </div>
                                </div>
                                <!-- 
                                <div class="col-lg-3 col-xs-6">
                                  <div class="small-box bg-red">
                                    <div class="inner">
                                      <h3><?php echo $jumlahpegawai?></h3>

                                      <p>Jumlah Pegawai</p>
                                    </div>
                                    <div class="icon">
                                      <i class="fa fa-heart"></i>
                                    </div>
                                    <a href="#" class="small-box-footer">Jumlah Keseluruhan</a>
                                  </div>
                                </div>
                              </div>
                              --> 
                      </div>
                      <div class="row">
                        <div class="box box-primary">
                              <div class="box-body">
                              <ul class="timeline">
                              <?php
                                  echo "<li class='time-label'>
                                      <span class='bg-red'>
                                         Hari Ini ".strtoupper($CI->p_c->tgl_indo(date("Y-m-d")))."
                                      </span>
                                      </li>";
                                    	$no=1;
    			                            $icon="fa fa-calendar bg-green";
                                      if($pegawaiultah<>""){
    		                              ?>
    		                                <li>
    		                                    <i class="<?php echo $icon ?>"></i>
    		                                    <div class="timeline-item">
                                              <span class="time"><i class="fa fa-birthday-cake"></i></span>
                                                <h3 class="timeline-header"><?php echo "Selamat Ulang Tahun Di Bulan ".substr($CI->p_c->tgl_indo(date("Y-m-d")),3,-4); ?></h3>
    		                                        <div class="timeline-body">
    		                                           	<?php
                                                    foreach((array)$pegawaiultah as $rowbd) {
                                                    echo "<b>".strtoupper($rowbd->panggilan).' "'.strtoupper($rowbd->nama." [".$rowbd->nip."]").' "'."</b> Pada tanggal ".substr($CI->p_c->tgl_indo($rowbd->tgllahir),0,-4)."<br/>" ;
                                                    }
                                                    ?>
                                                    <p align="right"></p>
    		                                        </div>
    		                                    </div>
    		                                </li>
                            	<?php
                                    } //pegawaiultah

                                    $no=1;
                                    $icon="fa fa-puzzle-piece bg-blue";
                                    if($pegawaibaru<>""){
                                    ?>
                                      <li>
                                          <i class="<?php echo $icon ?>"></i>
                                          <div class="timeline-item">
                                            <span class="time"><i class="fa fa-birthday-cake"></i></span>
                                              <h3 class="timeline-header"><?php echo "Selamat Bergabung (".substr($CI->p_c->tgl_indo(date("Y-m-d")),3).")"; ?></h3>
                                              <div class="timeline-body">
                                                   <?php
                                                  foreach((array)$pegawaibaru as $rowpb) {
                                                  echo "<b>".strtoupper($rowpb->panggilan).' "'.strtoupper($rowpb->nama." [".$rowpb->nip."]").' "'."</b> Unit Bisnis ".$rowpb->companytext."<br/>" ;
                                                  }
                                                  ?>
                                                  <p align="right"></p>
                                              </div>
                                          </div>
                                      </li>
                            <?php
                                  }
                                	$no=1;$icon="";
                                	foreach((array)$show_table as $row) {
                                    /*
                                    echo "<li class='time-label'>
		                                    <span class='bg-red'>
		                                       ".strtoupper($CI->p_c->tgl_indo($row->modified_date))."
		                                    </span>
		                                </li>";
                                    */
		                                if ($row->tipetimeline=='berita'){
			                                $icon="fa fa-comments bg-yellow";
		                                }
		                                ?>
		                                <li>
		                                    <i class="<?php echo $icon ?>"></i>
		                                    <div class="timeline-item">
		                                        <span class="time"><i class="fa fa-clock-o"></i> <?php echo $CI->p_c->tgl_indo($row->modified_date).' '.$row->timex; ?></span>
		                                        <h3 class="timeline-header"><?php echo $row->subjek; ?></h3>
		                                        <div class="timeline-body">
		                                           	<?php echo $row->isi_berita; ?>
		                                           	<p align="right"><?php echo " Oleh ".strtoupper($row->nama)." "."[".$row->nip."]  "?></p>
		                                        </div>

		                                    </div>
		                                </li>
		                                <?php
                  									}
                  								?>
									                 <li>
	                                    <i class="fa fa-clock-o"></i>
	                                </li>
                                </ul>
                              </div>
                        </div>
                      </div>
                        
                            
                  
                  </div><!-- /.row -->
        </section>
   </body>
</html>
