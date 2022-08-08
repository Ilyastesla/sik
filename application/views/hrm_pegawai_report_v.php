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
                        <li><a href="javascript:void(window.open('<?php echo site_url('hrm_pegawai_report/tambah'); ?>'))" ><i class="fa fa-plus-square"></i> Tambah</a></li>

                    </ol>
                    -->
                </section>

                <section class="content-header table-responsive">
                    <?php
			        $attributes = array('class' => 'form-horizontal form-validate', 'id' => 'form', 'method' => 'POST', 'novalidate'=>'novalidate','onsubmit'=>'return validate()','autocomplete'=>'off');
		    	echo form_open($action,$attributes);
		    		?>
                	<table width="100%" border="0">
	                    <tr>
                        <th align="left">
                            <label class="control-label" for="minlengthfield">Tanggal</label>
                            <div class="control-group">
                              <div class="controls">:
                                      <?php
                                      echo form_input(array('class' => '', 'id' => 'dp1','name'=>'periode1','value'=>$this->input->post('periode1'),'data-rule-required'=>'false' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'2' ,'placeholder'=>'DD-MM-YYYY','autocomplete'=>'off'));
                                      echo form_input(array('class' => '', 'id' => 'dp2','name'=>'periode2','value'=>$this->input->post('periode2'),'data-rule-required'=>'false' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'2' ,'placeholder'=>'DD-MM-YYYY','autocomplete'=>'off'));
                                      ?>
                                      <?php //echo  <p id="message"></p> ?>
                              </div>
                            </div>
                            <label class="control-label" for="minlengthfield">Grup Dengan</label>
                            <div class="control-group">
                              <div class="controls">:
                                <?php
                                  $arrgroupby='data-rule-required=false ';
                                  $groupby_opt=array("idpegawai"=>"Hanya Pegawai","idpegawai,tanggal"=>"Pegawai dan Tanggal");
                                  echo form_dropdown('groupby',$groupby_opt,$this->input->post("groupby"),$arrgroupby);			                	?>
                                <?php //echo  <p id="message"></p> ?>
                              </div>
                            </div>
                        </th>
                  </tr>
			            <tr>
				            <th align="left" colspan="4">
				            	<button class='btn btn-primary' name='filter' value="1">Filter</button>
				            	<?php echo "<a href='".site_url($action)."' class='btn btn-danger'>Bersihkan</a>&nbsp;&nbsp;";?>
				            </th>
				         </tr>
		            </table>
		            <?php
			            echo form_close();
		            ?>
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
                                              <?php
                                              echo "<th width='50'>No.</th>";
                                              if($this->input->post("groupby")<>"idpegawai"){
                                                  echo "<th width='100'>Tanggal</th>";
                                              }
                                              echo "<th width='100'>Nama</th>";
                                              echo "<th>Jam Kerja</th>";
                                              echo "<th>Jam Lenggang</th>";
                                              echo "<th>Selesai</th>";
                                              echo "<th>Butuh Bantuan</th>";
                                              echo "<th>Jumlah Hari</th>";

                                              ?>
                                          </tr>
                                      </thead>
                                      <?php
                                      $no=1;
                                      foreach((array)$show_table as $row) {
                											    echo "<tr>";
                                          echo "<td>".$no++."</td>";
                                          if(($this->input->post("groupby")<>"idpegawai")){
                                              echo "<td align='center'>";
                                              echo "<a href=javascript:void(window.open('".site_url('hrm_pegawai_report/showdailypegawai/'.$row->idpegawai.'/'.$row->tanggal)."'))>".$CI->p_c->tgl_indo($row->tanggal)."</a>";
                                              echo "</td>";
                                          }
                                          echo "<td align='center'>".$CI->dbx->getpegawai($row->idpegawai,0,1)."</td>";
                                          echo "<td align='center'>".$row->timesum."</td>";
                                          echo "<td align='center'>".$row->lenggang."</td>";
                                          echo "<td align='center'>".$CI->p_c->bgcolortext($row->jmlselesai,'blue')."</td>";
                                          echo "<td align='center'>".$CI->p_c->bgcolortext($row->jmlbantuan,'yellow')."</td>";
                                          echo "<td align='center'>".$CI->p_c->bgcolortext($row->jmlhari,'green')."</td>";
                                          echo "</tr>";
                											}
                                    ?>
                                    </table>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>
              </section><!-- /.content -->
<?php } elseif($view=='showdailypegawai'){ ?>
  <section class="content-header table-responsive">
      <h1>
          <?php echo $form ?>
          <small>List Data</small>
      </h1>
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
                                <?php
                                echo "<th width='100'>Tanggal</th>";
                                echo "<th width='100'>Periode</th>";
                                echo "<th>Kegiatan</th>";
                                echo "<th>Projek</th>";
                                echo "<th>Butuh Bantuan</th>";
                                echo "<th>Selesai</th>";
                                ?>
                            </tr>
                        </thead>
                        <?php
                        $no=1;
                        foreach((array)$show_table as $row) {
                          echo "<tr>";
                          echo "<td align='center'>".$CI->p_c->tgl_indo($row->tanggal)."</td>";
                          echo "<td align='center'>".$row->jammulai." - ".$row->jamakhir."<br/>".$row->durasi."</td>";
                          echo "<td align='left' valign='top'><b>".$row->kegiatantipetext."</b><br/>".$row->kegiatan."<br/>".$row->deskripsi."</td>";
                          echo "<td align='right'><b>".$row->projektext."</b><br/>".$row->projektasktext."</td>";
                          echo "<td align='center'>".$CI->p_c->cekaktif($row->bantuan)."</td>";
                          echo "<td align='center'>";
                          echo $CI->p_c->cekaktif($row->selesai);
                          echo "</td>";
                          echo "</tr>";
                        }
                      ?>
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
