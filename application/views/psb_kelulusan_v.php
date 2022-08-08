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
<?php $CI =& get_instance();?>

<?php if($view=='index'){ ?>
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        <?php echo $form ?>
                        <small>List Data</small>
                    </h1>

                    <ol class="breadcrumb">
                      <!--
                        <li><a href="<?php echo site_url('psb_kelulusan/tambah'); ?>" target="_blank"><i class="fa fa-plus-square"></i> Tambah</a></li>
                        <li><a href="#"><i class="fa fa-file-text"></i>Cetak</a></li>
                        <li><a href="#"><i class="fa fa-file-excel-o"></i>Excel</a></li>
                        -->
                    </ol>
                </section>

                <section class="content-header">
                <?php
  			             $attributes = array('class' => 'form-horizontal form-validate', 'id' => 'form', 'method' => 'POST', 'novalidate'=>'novalidate','onsubmit'=>'return validate()');
  		    	echo form_open($action,$attributes);
  		    		?>
                    	<table width="100%" border="0">
                              <tr>
                                <th align="left">
                                    <label class="control-label" for="minlengthfield">Tanggal</label>
                                    <div class="control-group">
                                        <div class="controls">:
                                                <?php
                                                echo form_input(array('class' => '', 'id' => 'dp1','name'=>'periode1','value'=>$this->session->userdata('periode1'),'data-rule-required'=>'false' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'2' ,'placeholder'=>'DD-MM-YYYY'));
                                                echo "&nbsp;".form_input(array('class' => '', 'id' => 'dp2','name'=>'periode2','value'=>$this->session->userdata('periode2'),'data-rule-required'=>'false' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'2' ,'placeholder'=>'DD-MM-YYYY'));
                                                ?>
                                                <?php //echo  <p id="message"></p> ?>
                                        </div>
                                    </div>
                                </th>
                						       <th align="left">
          				                		<label class="control-label" for="minlengthfield">Nama</label>
          				                		<div class="control-group">
                  											<div class="controls">:
              						                	<?php
                                            echo form_input(array('class' => '','style'=>'margin: 0px 0px 5px; width: 300px;', 'id' => 'nama','name'=>'nama','value'=>$this->input->post('nama'),'data-rule-required'=>'false' ,'data-rule-maxlength'=>'500', 'data-rule-minlength'=>'3' ,'placeholder'=>'Masukkan 1-100 Karakter'));
              						                	?>
              						                	<?php //echo  <p id="message"></p> ?>
                  											</div>
                				              </div>
                						         </th>
        			                  </tr>
          			            <tr>
          				            <th align="left" colspan="4">
          				            	<button class='btn btn-primary' name='filter' value="1">Filter</button>
          				            	<?php echo "<a href='".site_url($action)."'class='btn btn-danger'>Bersihkan</a>&nbsp;&nbsp;";?>
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
                                                <?
                                                echo "<th width='50'>No.</th>";
                                                echo "<th>No Daftar</th>";
                                                echo "<th>Nama</th>";
                                                echo "<th>Tingkat</th>";
                                                echo "<th>Calon Kelas</th>";
                                                echo "<th>Status Program</th>";
                                                echo "<th>ABK</th>";
                                                echo "<th>Tgl. Daftar</th>";
                                                echo "<th>Aksi</th>";
                                                ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        	<?php
                                        	$CI =& get_instance();$no=1;
											foreach((array)$show_table as $row) {
											    echo "<tr>";
											    echo "<td align='center'>".$no++."</td>";
                          echo "<td align='center'>";
                          echo "<a href='".site_url('general/datacalonsiswa/'.$row->replid)."' target='_blank'>".$row->nopendaftaran."</a>";
                          echo "</td>";
                          echo "<td align=''>".($row->nama)."</td>";
                          echo "<td align=''>".($row->tingkattext)."</td>";
                          echo "<td align=''>".($row->kelastext )."</td>";
                          echo "<td align=''>".($row->kondisitext)."</td>";
                          echo "<td align=''>".$CI->p_c->cekaktif($row->abk)."</td>";
                          echo "<td align='center'>".($CI->dbx->tanggalbatas($row->tanggal_daftar,$row->lamaproses,0))."</td>";
                          echo "<td align='center'>"; //triall class
                          echo "<a href='".site_url('psb_kelulusan/tambah/'.$row->replid)."' class='btn btn-xs btn-warning fa fa-check-square' target='_blank'></a>&nbsp;&nbsp;";
                          echo "<a href='".site_url('psb_kelulusan/view/'.$row->replid)."' class='btn btn-xs btn-info fa fa-circle-o' target='_blank'></a>&nbsp;&nbsp;";
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
<!-------------------------------------------------------------------------------------------------------------------------------------->
<?php } elseif($view=='tambah'){ ?>
<section class="content-header">
	            <h1>
	                <?php echo $form ?>
	                <small><?php echo $form_small ?></small>
	            </h1>
            </section>
            <section class="content">
		        <?php
			        $attributes = array('class' => 'form-horizontal form-validate', 'id' => 'form', 'method' => 'POST', 'novalidate'=>'novalidate','onsubmit'=>'return validate()');
		    	echo form_open($action,$attributes);
          echo $CI->dbx->getcalonsiswa($idcalon);
		    	?>
          <table width="100%" border="0">
          <tr>
              <th align="left">
                <label class="control-label" for="minlengthfield">Kelas</label>
                <div class="control-group">
                  <div class="controls">:
                    <?php
                      $arrkelas_id='data-rule-required=true';
                      if($isi->kelas_id<>""){
                        $kelas_id=$isi->kelas_id;
                      }else{
                        $kelas_id=$rowsiswa->calon_kelas;
                      }
                      echo form_dropdown('kelas_id',$kelas_id_opt,$kelas_id,$arrkelas_id);
                    ?>
                  </div>
                </div>
              </th>
            </tr>
            <tr>
	            <th align="left">
            		<label class="control-label" for="minlengthfield">Tanggal Mulai</label>
            		<div class="control-group">
  								<div class="controls">:
                    <?php
                      echo form_input(array('class' => '', 'id' => 'dp1','name'=>'tgl_mulai','value'=>$CI->p_c->tgl_form($isi->tgl_mulai),'data-rule-required'=>'true' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'2' ,'placeholder'=>'DD-MM-YYYY'));
                    ?>
  			                	<?php //echo  <p id="message"></p> ?>
  								</div>
            		</div>
		            </th>
            </tr>
            <tr>
	            <th align="left">
            		<label class="control-label" for="minlengthfield">Tanggal Surat</label>
            		<div class="control-group">
  								<div class="controls">:
                    <?php
                      echo form_input(array('class' => '', 'id' => 'dp1','name'=>'tgl_mulai','value'=>$CI->p_c->tgl_form($isi->tgl_mulai),'data-rule-required'=>'true' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'2' ,'placeholder'=>'DD-MM-YYYY'));
                    ?>
  			                	<?php //echo  <p id="message"></p> ?>
  								</div>
            		</div>
		            </th>
            </tr>
          </table>
            <table width="100%" border="0">
				    <tr>
				            <th align="left">
				            	<button class='btn btn-primary' onclick="return validate()">Simpan</button>
				            	<a href="<?php echo site_url("psb_kelulusan") ?>" class="btn btn-success">Kembali</a>
				            </th>
				    </tr>
		            </table>
		        	<?php
		        	echo form_close();
		        	?>
	    </section>
<!-------------------------------------------------------------------------------------------------------------------------------------->
<!-------------------------------------------------------------------------------------------------------------------------------------->
<?php } elseif($view=='view'){ ?>
<?php } ?>
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
    </body>
</html>
