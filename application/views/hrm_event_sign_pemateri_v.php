<!DOCTYPE html>
<html>
    <?php $this->load->view('header') ?>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
<?php $CI =& get_instance();?>
<?php if($view=='nilaievent'){ ?>

			<section class="content-header table-responsive">
	            <h1>
	                <?php echo $form ?>
	                <small><?php echo $form_small ?></small>
	            </h1>
            </section>
            <section class="content">
              <?php
              $attributes = array('class' => 'form-horizontal form-validate', 'id' => 'form', 'method' => 'POST', 'novalidate'=>'novalidate');
              echo form_open($action,$attributes);
              ?>
	    	<table width="100%" border="0" class="form-horizontal form-validate">
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
            <tr>
                  <th align="left">
                      <label class="control-label" for="minlengthfield">No. Register</label>
                      <div class="control-group">
                <div class="controls">:
                        <?php
                          echo form_input(array('id' => 'no_register','name'=>'no_register','value'=>'','data-rule-required'=>'true' ,'data-rule-maxlength'=>'15', 'data-rule-minlength'=>'15','data-rule-number'=>'true','placeholder'=>'Masukkan 15 Karakter'));
                        ?>
                        <?php //echo  <p id="message"></p> ?>
                </div>
                      </div>
              </th></tr>
         </table>
<!--------------------------------------------------------------------------------------------------------------------------->
        <hr><h4 align="left">Evaluasi Pelatihan :</h4>
        <div class="table-responsive">
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
              </div>
	            <table border="0">
  		            <tr align="left">
  			            <td><br/>
                      <input type="hidden" name="idhrm_event_evaluation" value="<?php echo $idhrm_event_evaluation; ?>">
                      <button class='btn btn-primary' value="simpan" name="submit">Simpan</button>&nbsp;&nbsp;
                      <a href="javascript:void(window.open('<?php echo site_url('hrm_event_sign') ?>'))" class="btn btn-success">Kembali</a>&nbsp;&nbsp;
                    </td>
  		            </tr>
	            </table>
            <?php echo form_close(); ?>
            </section>
<?php } elseif($view=='finish'){
    echo "<center>";
    if($stat){
      echo '<h1 align="left">Data Berhasil Di Simpan</h1>';
    }else{
      echo '<h1 align="left">Data Gagal di Simpan</h1>';
    }

} ?>
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
    </body>
</html>
