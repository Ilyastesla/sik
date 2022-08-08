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
                        <li><a href="javascript:void(window.open('<?php echo site_url('hrm_pegawai_daily/tambah'); ?>'))"><i class="fa fa-plus-square"></i> Tambah</a></li>

                    </ol>
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
                              echo form_input(array('class' => '', 'id' => 'dp1','name'=>'periode1','value'=>$this->session->userdata('periode1'),'data-rule-required'=>'false' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'2' ,'placeholder'=>'DD-MM-YYYY','autocomplete'=>'off'));
                              //echo form_input(array('class' => '', 'id' => 'dp2','name'=>'periode2','value'=>$this->session->userdata('periode2'),'data-rule-required'=>'false' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'2' ,'placeholder'=>'DD-MM-YYYY','autocomplete'=>'off'));
                              ?>
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
                                    <table class="table table-bordered table-striped">
                                      <thead>
                                          <tr>
                                              <?php
                                              echo "<th width='100'>Tanggal</th>";
                                              echo "<th width='100'>Periode</th>";
                                              echo "<th>Kegiatan</th>";
                                              //echo "<th>Deskripsi</th>";
                                              echo "<th>Projek</th>";
                                              echo "<th>Butuh Bantuan</th>";
                                              echo "<th>Selesai</th>";
                                              echo "<th width='80'>Aksi</th>";
                                              ?>
                                          </tr>
                                      </thead>
                                      <?php
                                      foreach((array)$show_table as $row) {
                											    echo "<tr>";
                                          echo "<td align='center'>".$CI->p_c->tgl_indo($row->tanggal)."</td>";
                                          echo "<td align='center'>".$row->jammulai." - ".$row->jamakhir."<br/>".$row->durasi."</td>";
                                          //if(($this->session->userdata('idpegawai')==$row->created_by) AND ($row->tanggal==$row->hariini)){
                                          //    echo "<td align='left' valign='top'><b>".$row->kegiatantipetext."</b><br/><a href=javascript:void(window.open('".site_url('hrm_pegawai_daily/ubah/'.$row->replid)."'))>".$row->kegiatan."</a></td>";
                                          //}else{
                                            echo "<td align='left' valign='top'><b>".$row->kegiatantipetext."</b><br/>".$row->kegiatan."<br/>".$row->deskripsi."</td>";
                                          //}
                                          echo "<td align='right'><b>".$row->projektext."</b><br/>".$row->projektasktext."</td>";
                                          echo "<td align='center'>".$CI->p_c->cekaktif($row->bantuan)."</td>";
                                          echo "<td align='center'>";
                                          //echo "<a href=javascript:void(window.open('".site_url('hrm_pegawai_daily/ubahaktif/'.$row->replid.'/'.!($row->aktif))."'))>".$CI->p_c->cekaktif($row->aktif)."</a>";
                                          echo $CI->p_c->cekaktif($row->selesai);
                                          echo "</td>";

                                          echo "<td align='center'>";
                                          if($this->session->userdata('idpegawai')==$row->created_by){
                                            if($row->salin=="1"){
                                                echo "<a href=javascript:void(window.open('".site_url('hrm_pegawai_daily/copydaily/'.$row->replid)."')) class='btn btn-xs btn-primary'>Kerjakan</a>&nbsp;&nbsp;";
                                            }else{
                                              //if($row->tanggal==$row->hariini){
                                                echo "<a href=javascript:void(window.open('".site_url('hrm_pegawai_daily/ubah/'.$row->replid)."')) class='btn btn-xs btn-warning fa fa-check-square'></a>&nbsp;&nbsp;";
                                                echo "<a href=javascript:void(window.open('".site_url('hrm_pegawai_daily/hapus/'.$row->replid)."')) class='btn btn-xs btn-danger fa fa-minus-square'></a>&nbsp;&nbsp;";
                                              //}
                                            }
                                          }
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
<?php } elseif($view=='tambah'){ ?>
  <script type="text/javascript">
  $(function(){
    $("#durasihour").change(function(){
      document.getElementById("jammulaihour").value='00';
      document.getElementById("jamakhirhour").value='00';
      document.getElementById("jammulaiminute").value='00';
      document.getElementById("jamakhirminute").value='00';
    });
    $("#durasiminute").change(function(){
      document.getElementById("jammulaihour").value='00';
      document.getElementById("jamakhirhour").value='00';
      document.getElementById("jammulaiminute").value='00';
      document.getElementById("jamakhirminute").value='00';
    });

    $("#jammulaihour").change(function(){
      document.getElementById("durasihour").value='00';
      document.getElementById("durasiminute").value='00';
    });
    $("#jammulaiminute").change(function(){
      document.getElementById("durasihour").value='00';
      document.getElementById("durasiminute").value='00';
    });


    $("#jamakhirhour").change(function(){
      document.getElementById("durasihour").value='00';
      document.getElementById("durasiminute").value='00';
    });
    $("#jamakhirminute").change(function(){
      document.getElementById("durasihour").value='00';
      document.getElementById("durasiminute").value='00';
    });

  });
  </script>
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
          $disabled="";
          if ($isi->idreff<>""){
      			$disabled=" disabled='disabled' ";
            ?>
              <input type='hidden' name='idkegiatantipe' value='<?php echo $isi->idkegiatantipe; ?>'>
              <input type='hidden' name='idprojektask' value='<?php echo $isi->idprojektask; ?>'>
              <input type='hidden' name='kegiatan' value='<?php echo $isi->kegiatan; ?>'>
            <?php
      		}
		    	?>
		    	<table width="100%" border="0">
            <tr>
               <th align="left">
                   <label class="control-label" for="minlengthfield">Tipe Kegiatan</label>
                   <div class="control-group">
             <div class="controls">:
                     <?php
                       $arridkegiatantipe='data-rule-required=true '.$disabled;
                       echo form_dropdown('idkegiatantipe',$idkegiatantipe_opt,$isi->idkegiatantipe,$arridkegiatantipe);			                	?>
                     <?php //echo  <p id="message"></p> ?>
             </div>
                   </div>
               </th>
            </tr>
            <tr>
               <th align="left">
                   <label class="control-label" for="minlengthfield">Projek Tugas</label>
                   <div class="control-group">
             <div class="controls">:
                     <?php
                       $arridprojektask='data-rule-required=false '.$disabled;
               echo form_dropdown('idprojektask',$idprojektask_opt,$isi->idprojektask,$arridprojektask);			                	?>
                     <?php //echo  <p id="message"></p> ?>
             </div>
                   </div>
               </th>
            </tr>
            <tr>
		            <th align="left">
	                		<label class="control-label" for="minlengthfield">Kegiatan</label>
	                		<div class="control-group">
								<div class="controls">:
                        <textarea name='kegiatan' <?php echo $disabled ?>><?php echo $isi->kegiatan; ?></textarea>
			                	<?php
			                		//echo form_input(array('class' => '', 'id' => 'kegiatan','name'=>'kegiatan','value'=>$isi->kegiatan,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'2' ,'placeholder'=>'Masukkan 2-100 Karakter'));
			                	  //echo "<input type='hidden' name='tanggal' value='".$CI->p_c->tgl_form($isi->tanggal)."'>";
                        ?>

			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th></tr>
		    		<tr>
		            <th align="left">
	                		<label class="control-label" for="minlengthfield">Tanggal</label>
	                		<div class="control-group">
								<div class="controls">:
                  <?php
                    echo form_input(array('class' => '', 'id' => 'dp1','name'=>'tanggal','value'=>$CI->p_c->tgl_form($isi->tanggal),'data-rule-required'=>'false' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'2' ,'placeholder'=>'DD-MM-YYYY','autocomplete'=>'off'));
                  ?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th></tr>
                  <tr>
                      <th align="left">
                        		<label class="control-label" for="minlengthfield">Jam Mulai (HH:MM)</label>
                        		<div class="control-group">
                							<div class="controls">:
                		                	<?php
                                      echo $CI->p_c->combotime("jammulai",substr($isi->jammulai,0,2),substr($isi->jammulai,3,2),false);
                                      //echo form_input(array('class' => '', 'id' => 'jammulai','name'=>'jammulai','value'=>$isi->jammulai,'style'=>'width:100px','data-rule-required'=>'true' ,'data-rule-maxlength'=>'5', 'data-rule-minlength'=>'5' ,'placeholder'=>'HH:MM'));
                		                	?>
                		                	<?php //echo  <p id="message"></p> ?>
                							</div>
                        		</div>
                    </tr>
                    <tr>
          	            <th align="left">
                          		<label class="control-label" for="minlengthfield">Jam Akhir (HH:MM)</label>
                          		<div class="control-group">
                  							<div class="controls">:
                  		                	<?php
                                        echo $CI->p_c->combotime("jamakhir",substr($isi->jamakhir,0,2),substr($isi->jamakhir,3,2),false);
                                        //echo form_input(array('class' => '', 'id' => 'jamakhir','name'=>'jamakhir','value'=>$isi->jamakhir,'style'=>'width:100px','data-rule-required'=>'true' ,'data-rule-maxlength'=>'5', 'data-rule-minlength'=>'5' ,'placeholder'=>'HH:MM'));
                  		                	?>
                  		                	<?php //echo  <p id="message"></p> ?>
                  							</div>
                          		</div>
                      </tr>
                      <tr>
                          <th align="left">
                            		<label class="control-label" for="minlengthfield">Durasi (HH:MM)</label>
                            		<div class="control-group">
                    							<div class="controls">:
                    		                	<?php
                                          echo $CI->p_c->combotime("durasi",substr($isi->durasi,0,2),substr($isi->durasi,3,2),false);
                                          //echo form_input(array('class' => '', 'id' => 'durasi','name'=>'durasi','value'=>$isi->durasi,'style'=>'width:100px','data-rule-required'=>'true' ,'data-rule-maxlength'=>'5', 'data-rule-minlength'=>'5' ,'placeholder'=>'HH:MM'));
                    		                	?>
                    		                	<?php //echo  <p id="message"></p> ?>
                    							</div>
                            		</div>
                        </tr>
                      <tr>
        	            <th align="left">
        	        		<label class="control-label" for="minlengthfield">Butuh Bantuan</label>
        	        		<div class="control-group">
        						<div class="controls">:
        	                	<?php
        	                		echo form_checkbox('bantuan', '1', $isi->bantuan);
        	                	?>
        	                	<?php //echo  <p id="message"></p> ?>
        						</div>
        	        		</div>
        	            </th></tr>
                      <tr>
        	            <th align="left">
        	        		<label class="control-label" for="minlengthfield">Selesai</label>
        	        		<div class="control-group">
        						<div class="controls">:
        	                	<?php
        	                		echo form_checkbox('selesai', '1', $isi->selesai);
        	                	?>
        	                	<?php //echo  <p id="message"></p> ?>
        						</div>
        	        		</div>
        	            </th></tr>
                <tr>
                    <th align="left">
                        <label class="control-label" for="minlengthfield">Deskripsi</label>
                        <div class="control-group">
                  <div class="controls">:
                          </div>
                    </th>
                </tr>
                <tr>
                  <th>
                              <div class='box-body pad'>
                                      <textarea id="editor1" name="deskripsi" rows="10" cols="80" data-rule-required="true">
                                          <?php echo $isi->deskripsi?>
                                      </textarea>
                                      <script type="text/javascript">CKEDITOR.replace('editor1');</script>
                              </div>
                              <?php //echo  <p id="message"></p> ?>
                    </th></tr>
			         <tr>
				            <th align="left">
				            	<button class='btn btn-primary' onclick="return validate()">Simpan</button>
				            	<a href="javascript:void(window.open('<?php echo site_url('hrm_pegawai_daily') ?>'))" class="btn btn-success">Batal</a>
				            </th>
				    </tr>
		            </table>
		        	<?php
		        	echo form_close();
		        	?>
	    </section>
<?php } ?>
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
    </body>
</html>
