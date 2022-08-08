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
                                                echo "<th width='100'>Kode Pelatihan</th>";
                                                echo "<th>Subjek</th>";
                                                //echo "<th>Penanggung Jawab</th>";
                                                // echo "<th>Deskripsi</th>";
                                                echo "<th>Perihal</th>";
                                                echo "<th>Ruang</th>";
                                                echo "<th>Tgl. Pelaksanaan</th>";
                                                //echo "<th>Tgl. Rilis</th>";
                                                echo "<th>Tgl. Konfirmasi</th>";
                                                //echo "<th>Aktif</th>";
                                                echo "<th>Status</th>";
                                                echo "<th>Konfirmasi</th>";
                                                echo "<th>Hadir</th>";
                                                echo "<th width='80'>Aksi</th>";
                                                ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        	<?php
                                        	$CI =& get_instance();
                                        	$no=1;
											foreach((array)$show_table as $row) {
											    echo "<tr>";
											    echo "<td align='center'>".$no++."</td>";
                          echo "<td align='center'>
                               <a href=javascript:void(window.open('".site_url('hrm_event/view/2/'.$row->replid)."'))>".$row->kode_transaksi."</a>
                             </td>";
											    //echo "<td align='center'>".$row->subjek."</td>";
                          echo "<td align='center'>".$row->tematext."</td>";
                          //echo "<td align='center'>".$CI->dbx->getpegawai($row->idpenanggungjawab)."</td>";
											    //echo "<td align='left'>".$row->deskripsi."</td>";
                          echo "<td align='left'>".$row->perihaltext."</td>";
                          echo "<td align='left'>".$row->ruangtext."</td>";
											    echo "<td align='center'>".strtoupper($CI->p_c->tgl_indo($row->tanggalpelaksanaan))."</td>";
                          //echo "<td align='center'>".strtoupper($CI->p_c->tgl_indo($row->tanggalrilis))."</td>";
                          echo "<td align='center'>".strtoupper($CI->p_c->tgl_indo($row->tanggalkonfirmasi))."</td>";
											    //echo "<td align='center'>".$CI->p_c->cekaktif($row->aktif)."</td>";
                          echo "<td align='center'><b>".strtoupper($row->statustext)."</b></td>";
                          echo "<td align='center'>".$CI->p_c->cekaktif($row->konfirmasi)."</td>";
                          echo "<td align='center'>".$CI->p_c->cekaktif($row->hadir)."</td>";
											    echo "<td align='center'>";
                          if(($row->status=="5") or ($row->status=="PR")){
                            if(($row->status=="5") and ($row->konfirmasi<>"1") and ($row->wajib<>"1") and ($row->lewat<>"1")){
                                    echo "<a href=javascript:void(window.open('".site_url('hrm_event_sign/konfirmasi_p/'.$row->replid.'/'.$row->idpegawai.'/'.(!$row->konfirmasi))."')) class='btn btn-xs btn-primary'>Konfirmasi</a>&nbsp;&nbsp;";
                            }
                            if($row->hadir<>"1"){
                              if(($row->konfirmasi=="1") and ($row->wajib<>"1")){
                                echo "<a href=javascript:void(window.open('".site_url('hrm_event_sign/hadir_v/'.$row->replid)."')) class='btn btn-xs btn-primary'>Hadir</a>&nbsp;&nbsp;";
                              }
                              if($row->wajib=="1"){
                                echo "<a href=javascript:void(window.open('".site_url('hrm_event_sign/hadir_v/'.$row->replid)."')) class='btn btn-xs btn-primary'>Hadir</a>&nbsp;&nbsp;";
                              }
                            }
                          }

                          if($row->tanggalhadir1<>""){

                          }
                          if (($row->tanggalhadir1<>"") and ($row->status=="PR")){
                            if(($row->pretest<1)){
                                echo "<a href=javascript:void(window.open('".site_url('hrm_event_sign/testpeserta_p/1/pretest/'.$row->replid)."')) class='btn btn-xs btn-primary'>Pre Test</a>&nbsp;&nbsp;";
                            }else{
                                echo "Nilai Pretest: ".$row->pretest;
                            }
                          }
                          if (($row->tanggalhadir1<>"") and ($row->status=="PO")){
                            if(($row->posttest<1)){
                                echo "<a href=javascript:void(window.open('".site_url('hrm_event_sign/testpeserta_p/1/posttest/'.$row->replid)."')) class='btn btn-xs btn-primary'>Post Test</a>&nbsp;&nbsp;";
                            }else{
                                echo "Nilai Posttest: ".$row->posttest;
                            }
                          }
                          if (($row->tanggalhadir1<>"") and ($row->status=="EV")){
                            echo "<a href=javascript:void(window.open('".site_url('hrm_event_sign/nilaievent_p/1/peserta/'.$row->replid)."')) class='btn btn-xs btn-primary'>Nilai Pelatihan</a>&nbsp;&nbsp;";
                          }
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
<?php } elseif($view=='absensi'){ ?>
  <section class="content-header table-responsive">
      <h1>
          <?php echo $form ?>
          <small><?php echo $form_small ?></small>
      </h1>
    </section>
    <?php
      $attributes = array('class' => 'form-horizontal form-validate', 'id' => 'form', 'method' => 'POST');
  echo form_open($action,$attributes);
  ?>
    <section class="content">
      <?php if ($this->session->flashdata('errortoken')<>"") { ?>
      <div class="alert alert-danger alert-dismissable" align="left">
              <i class="fa fa-ban"></i>
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
              <b>Alert!</b> <?php echo $this->session->flashdata('errortoken') ?>..
          </div>
      <?php } ?>
    <table width="100%" border="0" class="form-horizontal form-validate">
      <tr>
          <th align="left">
          <label class="control-label" for="minlengthfield">Kode Pelatihan</label>
          <div class="control-group">
        <div class="controls">:
                <?php
                  //echo $isi->subjek;
                  echo "<a href=javascript:void(window.open('".site_url('hrm_event/view/2/'.$isi->replid)."'))>".$isi->kode_transaksi."</a>";
                ?>
        </div>
          </div>
          </th></tr>
      <tr>
          <th align="left">
          <label class="control-label" for="minlengthfield">Subjek</label>
          <div class="control-group">
        <div class="controls">:
                <?php
                  //echo $isi->subjek;
                  echo $isi->tematext;
                ?>
        </div>
          </div>
          </th></tr>
          <tr>
              <th align="left">
              <label class="control-label" for="minlengthfield">Perihal</label>
              <div class="control-group">
            <div class="controls">:
                    <?php
                      echo $isi->perihaltext;
                    ?>
            </div>
              </div>
              </th></tr>

        <tr>
            <th align="left">
            <label class="control-label" for="minlengthfield">Ruang</label>
            <div class="control-group">
          <div class="controls">:
                  <?php
                    echo $isi->ruangtext;
                  ?>
          </div>
            </div>
            </th></tr>
      <tr>
          <th align="left">
          <label class="control-label" for="minlengthfield">Tgl. Pelaksanaan</label>
          <div class="control-group">
        <div class="controls">:
                <?php
                  echo strtoupper($CI->p_c->tgl_indo($isi->tanggalpelaksanaan));
                ?>
        </div>
          </div>
          </th></tr>
          <tr>
              <th align="left">
              <label class="control-label" for="minlengthfield">Sesi Aktif</label>
              <div class="control-group">
            <div class="controls">:
                    <?php
                      echo $isi->sesiaktif;
                    ?>
            </div>
              </div>
              </th></tr>
          <!--
          <tr>
          <th align="left">
          <label class="control-label" for="minlengthfield">Aktif</label>
          <div class="control-group">
        <div class="controls">:
                <?php
                  echo $CI->p_c->cekaktif($isi->aktif);
                ?>
        </div>
          </div>
          </th></tr>
        -->
          <tr>
          <th align="left">
          <label class="control-label" for="minlengthfield">Status</label>
          <div class="control-group">
        <div class="controls">:
                <?php
                  echo $isi->statustext;
                ?>
        </div>
          </div>
          </th></tr>
          <tr>
                <th align="left">
                    <label class="control-label" for="minlengthfield">Kode Token</label>
                    <div class="control-group">
              <div class="controls">:
                      <?php
                        echo form_input(array('id' => 'kodeabsen','name'=>'kodeabsen','value'=>'','data-rule-required'=>'true' ,'data-rule-maxlength'=>'8', 'data-rule-minlength'=>'8','data-rule-number'=>'false','placeholder'=>'Masukkan 8 Karakter'));
                      ?>
                      <?php //echo  <p id="message"></p> ?>
              </div>
                    </div>
            </th></tr>
            <tr>
                 <th align="left">
                   <input type="hidden" name="sesiaktif" value="<?php echo $isi->sesiaktif ?>">
                  <input type="hidden" name="crypt" value="<?php echo $isi->kodeabsen_dec ?>">
                   <button class="btn btn-primary">Simpan</button>
                   <a href="javascript:void(window.open('<?php echo site_url('hrm_event') ?>'))" class="btn btn-success">Batal</a>
                 </th>
            </tr>
     </table>
     <?php
     echo form_close();
     ?>
   </section>
<?php } elseif($view=='nilaievent'){ ?>
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
              <label class="control-label" for="minlengthfield">Kode Pelatihan</label>
              <div class="control-group">
            <div class="controls">:
                    <?php
                      //echo $isi->subjek;
                      echo $isi->kode_transaksi;
                    ?>
            </div>
              </div>
              </th></tr>
	    		<tr>
	            <th align="left">
	        		<label class="control-label" for="minlengthfield">Subjek</label>
	        		<div class="control-group">
						<div class="controls">:
	                	<?php
	                		//echo $isi->subjek;
                      echo $isi->tematext;
	                	?>
						</div>
	        		</div>
	            </th></tr>
              <tr>
    	            <th align="left">
    	        		<label class="control-label" for="minlengthfield">Perihal</label>
    	        		<div class="control-group">
    						<div class="controls">:
    	                	<?php
    	                		echo $isi->perihaltext;
    	                	?>
    						</div>
    	        		</div>
    	            </th></tr>
            <!--
            <tr>
  	            <th align="left">
  	        		<label class="control-label" for="minlengthfield">Ruang</label>
  	        		<div class="control-group">
  						<div class="controls">:
  	                	<?php
  	                		echo $isi->ruangtext;
  	                	?>
  						</div>
  	        		</div>
  	            </th></tr>
          -->
          <tr>
              <th align="left">
              <label class="control-label" for="minlengthfield">Tgl. Pelaksanaan</label>
              <div class="control-group">
            <div class="controls">:
                    <?php
                      echo strtoupper($CI->p_c->tgl_indo($isi->tanggalpelaksanaan));
                    ?>
            </div>
              </div>
              </th></tr>
      <!--
      <tr>
          <th align="left">
          <label class="control-label" for="minlengthfield">Tgl. Rilis</label>
          <div class="control-group">
        <div class="controls">:
                <?php
                  echo strtoupper($CI->p_c->tgl_indo($isi->tanggalrilis));
                ?>
        </div>
          </div>
          </th></tr>
        <tr>
            <th align="left">
            <label class="control-label" for="minlengthfield">Tgl. Konfirmasi</label>
            <div class="control-group">
          <div class="controls">:
                  <?php
                    echo strtoupper($CI->p_c->tgl_indo($isi->tanggalkonfirmasi));
                  ?>
          </div>
            </div>
            </th></tr>
        <tr>
            <th align="left">
            <label class="control-label" for="minlengthfield">Peserta</label>
            <div class="control-group">
          <div class="controls">
                  <?php
                    echo ": ".$CI->dbx->role_show($isi->idrole,0);
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
	                		echo $CI->p_c->cekaktif($isi->aktif);
	                	?>
						</div>
	        		</div>
	            </th></tr>
              <tr>
              <th align="left">
              <label class="control-label" for="minlengthfield">Status</label>
              <div class="control-group">
            <div class="controls">:
                    <?php
                      echo $isi->statustext;
                    ?>
            </div>
              </div>
              </th></tr>
            -->
         </table>
<!--------------------------------------------------------------------------------------------------------------------------->
<?php if($view2=='nilaievent'){ ?>
        <hr><h4 align="left">Evaluasi Pelatihan :</h4>
        <?php
        $attributes = array('class' => 'form-horizontal form-validate', 'id' => 'form', 'method' => 'POST', 'novalidate'=>'novalidate');
        echo form_open($action,$attributes);
        ?>
          <table class="table table-bordered table-striped">
          <thead>
              <tr>
                  <th width="50">No.</th>
                  <th>Head</th>
                  <th>Evaluasi Pelatihan</th>
                  <?php if($ubah){?>
                  <!--
                  <th width="150">Skor</th>
                  <th width="150">Keterangan</th>
                -->
                <th width="150" colspan="2">Penilaian</th>
                <?php } ?>
              </tr>
          </thead>
          <tbody>
            <?php
                    $CI =& get_instance();
                    $no=1;$idhrm_event_evaluation="";
                    foreach((array)$hrm_event_evaluation_peserta as $roweep) {
                        echo "<tr>";
                        echo "<td align='center'>".$no++."</td>";
                        echo "<td align='left'>".$roweep->head."</td>";
                        echo "<td align='left'>".$roweep->hrm_event_evaluation."</td>";
                        if($ubah){
                          if($roweep->max_skor<>0){
                            echo "<td align='center'>";
                            $skor_opt="";
                            for ($i = 1; $i <= $roweep->max_skor; $i++) {
                              /*if($skor_opt<>""){
                                $skor_opt=$skor_opt.",";
                              }
                              $skor_opt=$skor_opt.$i;*/
                              $skor_opt[$i]=$i;
                            }
                            //$skor_opt=preg_split("/[\s,]+/", $this->input->post("idhrm_event_evaluation"));array($skor_opt);
                            $arrskor="style='width:80px;'";
                            echo form_dropdown('skor'.$roweep->idhrm_event_evaluation,$skor_opt,$roweep->skor,$arrskor);


                            //echo "<a href=javascript:void(window.open('".site_url('hrm_event/hrmeventevaluationpelaksanahapus/'.$roweep->idhrm_event.'/'.$roweep->ideventpelaksana)."')) class='btn btn-xs btn-danger fa fa-minus-square'></a>";
                            echo "</td>";
                            echo "<td align='center'>";
                          }else{
                            echo "<td align='center' colspan='2'>";
                            echo "<input type='hidden' name='skor".$roweep->idhrm_event_evaluation."' value='0'>";
                          }
                          echo "<textarea id='editor1' name='deskripsinilai".$roweep->idhrm_event_evaluation."' rows='5' cols='80'>".$roweep->deskripsinilai."</textarea>";
                          echo "</td>";
                        }
                        echo "</tr>";
                        if($idhrm_event_evaluation<>""){$idhrm_event_evaluation=$idhrm_event_evaluation.',';}
					            	$idhrm_event_evaluation=$idhrm_event_evaluation.$roweep->idhrm_event_evaluation;
                    }
                ?>

                    </tbody>
                </table>
                <input type="hidden" name="idhrm_event_evaluation" value="<?php echo $idhrm_event_evaluation; ?>">
<?php } elseif(($view2=='pretest') or ($view2=='posttest')){
          $attributes = array('class' => 'form-horizontal form-validate', 'id' => 'form', 'method' => 'POST', 'novalidate'=>'novalidate');
          echo form_open($action,$attributes);
          echo "<table border='0' width='100%'>";
          echo "<tr><th colspan='2' align='left'>Jawablah Pertanyaan Berikut</th></tr>";
          $idhrm_event_test="";
          $idhrm_event_test_array="";
          foreach((array)$hrm_event_jawaban_peserta as $rowtest) {
            echo "<tr>";
            if ($idhrm_event_test<>$rowtest->idhrm_event_test){
              if($idhrm_event_test_array<>""){$idhrm_event_test_array=$idhrm_event_test_array.',';}
              $idhrm_event_test_array=$idhrm_event_test_array.$rowtest->idhrm_event_test;
              echo "<td width='30' align='center'>".$rowtest->no_urut."</td><td align='left'>".$rowtest->test."</td></tr><tr>";
            }
            $checked="";
            if ($view2=="pretest"){
              if ($rowtest->pretest==$rowtest->idhrm_event_test_jawaban){
                  $checked=" checked='checked'";
              }
            }else if ($view2=="posttest"){
              if ($rowtest->posttest==$rowtest->idhrm_event_test_jawaban){
                  $checked=" checked='checked'";
              }
            }

            echo "<td></td><td align='left'><input type='radio' name='radio".$rowtest->idhrm_event_test."' value='".$rowtest->idhrm_event_test_jawaban."' ".$checked.">&nbsp".$rowtest->jawaban.". ".$rowtest->keterangan."</td>";
            echo "</tr>";
            $idhrm_event_test=$rowtest->idhrm_event_test;
          }
          echo "</table>";
          echo "<input type='hidden' name='idhrm_event_test' value='".$idhrm_event_test_array."'>";
} ?>
	            <table border="0">
  		            <tr align="left">
  			            <td><br/>
                      <button class='btn btn-primary' value="simpan" name="submit">Simpan</button>&nbsp;&nbsp;
                      <a href="javascript:void(window.open('<?php echo site_url('hrm_event_sign') ?>'))" class="btn btn-success">Kembali</a>&nbsp;&nbsp;
                    </td>
  		            </tr>
	            </table>
            <?php echo form_close(); ?>
            </section>
	        	<?php
} ?>
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
    </body>
</html>
