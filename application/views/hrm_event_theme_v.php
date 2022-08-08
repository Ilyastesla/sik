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
                        <li><a href="javascript:void(window.open('<?php echo site_url('hrm_event_theme/tambah'); ?>'))"><i class="fa fa-plus-square"></i> Tambah</a></li>

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
                                                <th>Tema</th>
                                                <th>KKM</th>
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
                          echo "<td align='left'>
                               <a href=javascript:void(window.open('".site_url('hrm_event_theme/view/0/'.$row->replid)."'>".$row->tema."</a>
                             </td>";
                          echo "<td align='center'>".$row->kkm."</td>";
                          echo "<td align='center'>".$CI->p_c->cekaktif($row->aktif)."</td>";
											    echo "<td align='center'>";
                          echo "<a href=javascript:void(window.open('".site_url('hrm_event_theme/ubah/'.$row->replid)."')) class='btn btn-xs btn-warning fa fa-check-square'></a>&nbsp;&nbsp;";
                          echo "<a href=javascript:void(window.open('".site_url('hrm_event_theme/hapus/'.$row->replid)."')) class='btn btn-xs btn-danger fa fa-minus-square'></a>";
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
		    	<table width="100%" border="0">
            <tr>
		            <th align="left">
	                		<label class="control-label" for="minlengthfield">Tema</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		echo form_input(array('class' => '', 'id' => 'tema','name'=>'tema','value'=>$isi->tema,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'2' ,'placeholder'=>'Masukkan 2-100 Karakter'));
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th></tr>
          <tr>
                <th align="left">
                    <label class="control-label" for="minlengthfield">KKM</label>
                    <div class="control-group">
              <div class="controls">:
                      <?php
                        echo form_input(array('id' => 'kkm','name'=>'kkm','value'=>$isi->kkm,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'3', 'data-rule-minlength'=>'1','data-rule-number'=>'true','placeholder'=>'Masukkan 1-3 Karakter'));
                      ?>
                      <?php //echo  <p id="message"></p> ?>
              </div>
                    </div>
            </th></tr>
				    <tr>
		            <th align="left">
		        		<label class="control-label" for="minlengthfield">Aktif</label>
		        		<div class="control-group">
							<div class="controls">:
		                	<?php
		                		echo form_checkbox('aktif', '1', $isi->aktif);
		                	?>
		                	<?php //echo  <p id="message"></p> ?>
							</div>
		        		</div>
		            </th></tr>
			         <tr>
				            <th align="left">
				            	<button class='btn btn-primary' onclick="return validate()">Simpan</button>
				            	<a href="javascript:void(window.open('<?php echo site_url('hrm_event_theme') ?>'))" class="btn btn-success">Batal</a>
				            </th>
				    </tr>
		            </table>
		        	<?php
		        	echo form_close();
		        	?>
	    </section>
<?php } elseif($view=='view'){ ?>
  <section class="content-header table-responsive">
          <h1>
              <?php echo $form ?>
              <small><?php echo $form_small ?></small>
          </h1>
        </section>
        <section class="content">
    <table width="100%" border="0" class="form-horizontal form-validate">
      <tr>
          <th align="left">
          <label class="control-label" for="minlengthfield">Tema</label>
          <div class="control-group">
        <div class="controls">:
                <?php
                  echo $isi->tema;
                ?>
        </div>
          </div>
          </th>
      </tr>
      <tr>
          <th align="left">
          <label class="control-label" for="minlengthfield">KKM</label>
          <div class="control-group">
        <div class="controls">:
                <?php
                  echo $isi->kkm;
                ?>
        </div>
          </div>
          </th>
      </tr>
    </table>
<!--------------------------------------------------------------------------------------------------------------------------->
       <hr><h4 align="left">Quiz Pelatihan:</h4>
       <?php if($ubah=="1"){
 		    $attributes = array('class' => 'form-horizontal form-validate', 'id' => 'form', 'method' => 'POST', 'novalidate'=>'novalidate');
 	    	echo form_open($action_1,$attributes);
 	     ?>
       <table>
         <tr>
             <th align="left">
                   <label class="control-label" for="minlengthfield">Test</label>
                   <div class="control-group">
             <div class="controls">:
                     <?php
                       echo form_textarea(array('class' => '', 'id' => 'test','name'=>'test','value'=>"",'data-rule-required'=>'true' ,'data-rule-maxlength'=>'1000', 'data-rule-minlength'=>'2' ,'placeholder'=>'Masukkan 2-1000 Karakter'));
                       echo "<br/>";
                       //echo form_input(array('class' => '', 'id' => 'test','name'=>'test','value'=>"",'data-rule-required'=>'true' ,'data-rule-maxlength'=>'1000', 'data-rule-minlength'=>'2' ,'placeholder'=>'Masukkan 2-1000 Karakter'))."&nbsp;&nbsp;";
                       echo form_input(array('id' => 'no_urut','name'=>'no_urut','value'=>(COUNT($hrm_event_test)+1),'data-rule-required'=>'true' ,'data-rule-maxlength'=>'3', 'data-rule-minlength'=>'1','data-rule-number'=>'true','placeholder'=>'Masukkan 1-3 Karakter'))."&nbsp;&nbsp;";
                       echo "Pilihan Ganda: ".form_checkbox('pg', '1', '1');
                     ?>
                     <?php //echo  <p id="message"></p> ?>
                     <button class='btn btn-primary'>Simpan</button>&nbsp;&nbsp;
             </div>
                   </div>

               </th></tr>

     </table>
     <?php echo form_close(); } ?>
         <table class="table table-bordered table-striped">
         <thead>
             <tr>
                 <th width="50">No.</th>
                 <th>Pertanyaan</th>
                 <th>Jawaban</th>
                 <th width="60">Benar</th>
                 <?php if($ubah=="1"){?>
                 <th width="80">Aksi</th>
               <?php } ?>
             </tr>
         </thead>
         <tbody>
           <?php
                   $CI =& get_instance();
                   $no=1;$idhrm_event_test="";
                   foreach((array)$hrm_event_test as $rowtest) {
                       if ($idhrm_event_test<>$rowtest->idhrm_event_test){
                         //echo "<td align='center'>".$no++."</td>";
                         echo "<tr>";
                         echo "<td align='center'>".$rowtest->no_urut."</td>";
                         if($ubah=="1"){
                           echo "<td align='left'><a href=javascript:void(window.open('".site_url('hrm_event_theme/tambahtest/1/'.$rowtest->idhrm_event_theme.'/'.$rowtest->idhrm_event_test)."'))>".$rowtest->test."</a></td>";
                         }else{
                           echo "<td align='left'>".$rowtest->test."</td>";
                         }
                          //echo "<a href=javascript:void(window.open('".site_url('hrm_event_theme/tambahjawaban/1/'.$rowtest->idhrm_event_theme.'/'.$rowtest->idhrm_event_test)."')) class='btn btn-xs btn-primary'>Tambah Jawaban</a>&nbsp;&nbsp;";
                         echo "<td align='left'>";
                         if ($rowtest->idhrm_event_test_jawaban<>""){
                           if($ubah=="1"){
                              echo $rowtest->jawaban.". <a href=javascript:void(window.open('".site_url('hrm_event_theme/tambahjawaban/1/'.$rowtest->idhrm_event_theme.'/'.$rowtest->idhrm_event_test.'/'.$rowtest->idhrm_event_test_jawaban)."'))>".$rowtest->keterangan."</a>
                              <a href=javascript:void(window.open('".site_url('hrm_event_theme/hapusjawaban_p/'.$rowtest->idhrm_event_theme.'/'.$rowtest->idhrm_event_test_jawaban)."')) class='btn fa fa-times-circle'></a>";
                            }else{
                              echo $rowtest->jawaban.". ".$rowtest->keterangan;
                            }
                         }
                         echo "</td>";
                         echo "<td align='left'>".$CI->p_c->cekaktif($rowtest->benar)."</td>";
                          if($ubah=="1"){
                             echo "<td align='center'>";
                             if($rowtest->pg=="1"){
                                echo "<a href=javascript:void(window.open('".site_url('hrm_event_theme/tambahjawaban/1/'.$rowtest->idhrm_event_theme.'/'.$rowtest->idhrm_event_test)."')) class='btn btn-xs btn-primary'>Tambah Jawaban</a>&nbsp;&nbsp;";
                             }
                             echo "<a href=javascript:void(window.open('".site_url('hrm_event_theme/hapustest_p/'.$rowtest->idhrm_event_theme.'/'.$rowtest->idhrm_event_test)."')) class='btn btn-xs btn-danger fa fa-minus-square'></a>";
                           }
                           echo "</td>";
                           echo "</tr>";
                       }else{
                         echo "<tr>";
                         echo "<td colspan='2'>&nbsp;</td>";
                         echo "<td align='left'>";
                         if($ubah=="1"){
                            echo $rowtest->jawaban.". <a href=javascript:void(window.open('".site_url('hrm_event_theme/tambahjawaban/1/'.$rowtest->idhrm_event_theme.'/'.$rowtest->idhrm_event_test.'/'.$rowtest->idhrm_event_test_jawaban)."'))>".$rowtest->keterangan."</a>
                            <a href=javascript:void(window.open('".site_url('hrm_event_theme/hapusjawaban_p/'.$rowtest->idhrm_event_theme.'/'.$rowtest->idhrm_event_test_jawaban)."')) class='btn fa fa-times-circle'></a>";
                          }else{
                            echo $rowtest->jawaban.". ".$rowtest->keterangan;
                          }
                         echo "</td>";
                         echo "<td align='left'>".$CI->p_c->cekaktif($rowtest->benar)."</td>";
                         if($ubah=="1"){
                           echo "<td>&nbsp;</td>";
                         }
                         echo "</tr>";
                       }
                       $idhrm_event_test=$rowtest->idhrm_event_test;
                   }
               ?>

                   </tbody>
               </table>
 <!--------------------------------------------------------------------------------------------------------------------------->
    <table border="0">
        <tr align="left">
          <td>
            <?php
              if($ubah<>1){
                  echo "<a href=javascript:void(window.open('".site_url('hrm_event_theme/ubah/'.$isi->replid)."')) class='btn btn-warning'>Ubah</a>&nbsp;&nbsp;";
              }
              echo "<a href=javascript:void(window.open('".site_url('hrm_event_theme')."')) class='btn btn-success'>Kembali</a>&nbsp;&nbsp;";
            ?>
          </td>
        </tr>
    </table>
  </section>
<?php } elseif($view=='tambahtest'){ ?>
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

    <table width="100%" border="0" class="form-horizontal form-validate">
      <tr>
          <th align="left">
          <label class="control-label" for="minlengthfield">Tema</label>
          <div class="control-group">
        <div class="controls">:
                <?php
                  echo $isi->tema;
                ?>
        </div>
          </div>
          </th>
      </tr>
      <tr>
          <th align="left">
                <label class="control-label" for="minlengthfield">Pertanyaan</label>
                <div class="control-group">
          <div class="controls">:
                  <?php
                    echo form_textarea(array('class' => '', 'id' => 'test','name'=>'test','value'=>$isi->test,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'1000', 'data-rule-minlength'=>'2' ,'placeholder'=>'Masukkan 2-1000 Karakter'));
                  ?>
                  <?php //echo  <p id="message"></p> ?>
          </div>
                </div>
            </th></tr>
            <tr>
                <th align="left">
                      <label class="control-label" for="minlengthfield">No Urut</label>
                      <div class="control-group">
                <div class="controls">:
                        <?php
                          echo form_input(array('id' => 'no_urut','name'=>'no_urut','value'=>$isi->no_urut,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'3', 'data-rule-minlength'=>'1','data-rule-number'=>'true','placeholder'=>'Masukkan 1-3 Karakter'))."&nbsp;&nbsp;";
                        ?>
                        <?php //echo  <p id="message"></p> ?>
                </div>
                      </div>
                  </th></tr>
      <tr>
          <th align="left">
          <label class="control-label" for="minlengthfield">PG</label>
          <div class="control-group">
        <div class="controls">:
                <?php
                  echo form_checkbox('pg', '1', $isi->pg);
                ?>
                <?php //echo  <p id="message"></p> ?>
        </div>
          </div>
          </th></tr>
          <tr>
               <th align="left">
                 <button class='btn btn-primary' onclick="return validate()">Simpan</button>
                 <a href="javascript:void(window.open('<?php echo site_url('hrm_event_theme/view/1/'.$isi->idhrm_event_theme) ?>'))" class="btn btn-success">Batal</a>
               </th>
       </tr>

    </table>

  </section>
  <?php
  echo form_close();
} elseif($view=='tambahjawaban'){ ?>
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

    <table width="100%" border="0" class="form-horizontal form-validate">
      <tr>
          <th align="left">
          <label class="control-label" for="minlengthfield">Tema</label>
          <div class="control-group">
        <div class="controls">:
                <?php
                  echo $isi->tema;
                ?>
        </div>
          </div>
          </th>
      <tr>
          <th align="left">
          <label class="control-label" for="minlengthfield">Pertanyaan</label>
          <div class="control-group">
        <div class="controls">:
                <?php
                  echo $isi->test;
                ?>
        </div>
          </div>
          </th>
      <tr>
          <th align="left">
                <label class="control-label" for="minlengthfield">Jawaban</label>
                <div class="control-group">
          <div class="controls">:
                  <?php
                    echo form_input(array('class' => '', 'id' => 'jawaban','name'=>'jawaban','value'=>$isi->jawaban,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'1' ,'placeholder'=>'Masukkan 1-100 Karakter'));
                  ?>
                  <?php //echo  <p id="message"></p> ?>
          </div>
                </div>
            </th></tr>
            <tr>
                <th align="left">
                      <label class="control-label" for="minlengthfield">Caption</label>
                      <div class="control-group">
                <div class="controls">:
                        <?php
                          echo form_input(array('class' => '', 'id' => 'keterangan','name'=>'keterangan','value'=>$isi->keterangan,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'2' ,'placeholder'=>'Masukkan 2-100 Karakter'));
                        ?>
                        <?php //echo  <p id="message"></p> ?>
                </div>
                      </div>
                  </th></tr>
      <tr>
          <th align="left">
          <label class="control-label" for="minlengthfield">Benar</label>
          <div class="control-group">
        <div class="controls">:
                <?php
                  echo form_checkbox('benar', '1', $isi->benar);
                ?>
                <?php //echo  <p id="message"></p> ?>
        </div>
          </div>
          </th></tr>
          <tr>
               <th align="left">
                 <button class='btn btn-primary' onclick="return validate()">Simpan</button>
                 <a href="javascript:void(window.open('<?php echo site_url('hrm_event_theme/view/1/'.$isi->idhrm_event_theme) ?>'))" class="btn btn-success">Batal</a>
               </th>
       </tr>
    </table>

  </section>
  <?php
  echo form_close();
} ?>
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
    </body>
</html>
