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
                    <?php
                    if($ubah=="0"){
                      echo '<ol class="breadcrumb">';
                      echo '<li><a href="'.site_url('hrm_event/tambah').'"><i class="fa fa-plus-square"></i> Tambah</a></li>';
                      echo '</ol>';
                    }
                    ?>
                </section>
                <section class="content-header table-responsive">
                    <?php
			        $attributes = array('class' => 'form-horizontal form-validate', 'id' => 'form', 'method' => 'POST', 'novalidate'=>'novalidate','onsubmit'=>'return validate()');
		    	echo form_open($action,$attributes);
		    		?>
                	<table width="100%" border="0">
	                   <tr>
                       <th align="left">
                           <label class="control-label" for="minlengthfield">Tgl. Pelaksanaan</label>
                           <div class="control-group">
                             <div class="controls">:
                                     <?php
                                     echo form_input(array('class' => '', 'id' => 'dp1','name'=>'tanggal1','value'=>$this->input->post('tanggal1'),'data-rule-required'=>'false' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'2' ,'placeholder'=>'DD-MM-YYYY','autocomplete'=>'off'));
                                     echo form_input(array('class' => '', 'id' => 'dp2','name'=>'tanggal2','value'=>$this->input->post('tanggal2'),'data-rule-required'=>'false' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'2' ,'placeholder'=>'DD-MM-YYYY','autocomplete'=>'off'));
                                     ?>
                                     <?php //echo  <p id="message"></p> ?>
                             </div>
                           </div>
                       </th>

                       <th align="left">
                          <?php if ($ubah<>3){?>
                           <label class="control-label" for="minlengthfield">Status</label>
                           <div class="control-group">
                             <div class="controls">:
                               <?php
                                 $arrstatus='data-rule-required=false onchange=javascript:this.form.submit();';
                                 echo form_dropdown('status',$status_opt,$this->input->post('status'),$arrstatus);
                               ?>
                               <?php //echo  <p id="message"></p> ?>
                             </div>
                           </div>
                         <?php } ?>
                       </th>
                  </tr>
			            <tr>
				            <th align="left" colspan="4">
				            	<button class='btn btn-primary' name='filter' value="1">Filter</button>
                      <?php echo "<a href='".site_url($action)."' ) class='btn btn-danger'>Bersihkan</a>&nbsp;&nbsp;";?>
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
                                                echo "<th width='100'>Kode Pelatihan</th>";
                                                echo "<th>Perihal</th>";
                                                echo "<th>Tema</th>";
                                                echo "<th>Penanggung Jawab</th>";
                                                //echo "<th>Deskripsi</th>";
                                                echo "<th>Ruang</th>";
                                                echo "<th>Tgl. Pelaksanaan</th>";
                                                //echo "<th>Jam Mulai</th>";
                                                //echo "<th>Jam Akhir</th>";
                                                //echo "<th>Tgl. Rilis</th>";
                                                //echo "<th>Tgl. Konfirmasi</th>";
                                                echo "<th>Status</th>";
                                                echo "<th>Nilai Event</th>";
                                                echo "<th>Aktif</th>";

                                                if($ubah=="0"){
                                                    echo '<th width="80">Aksi</th>";';
                                                }
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
                               <a href=javascript:void(window.open('".site_url('hrm_event/view/'.$ubah.'/'.$row->replid)."'))>".$row->kode_transaksi."</a>
                             </td>";
                          echo "<td align='left'>".$row->perihaltext."</td>";
											    echo "<td align='center'>".$row->tematext."</td>";
                          echo "<td align='center'>".$CI->dbx->getpegawai($row->idpenanggungjawab)."</td>";
											    //echo "<td align='left'>".$row->deskripsi."</td>";
                          echo "<td align='left'>".$row->ruangtext."</td>";
											    echo "<td align='center'>".$CI->p_c->tgl_indo($row->tanggalpelaksanaan)."<br/>".$row->jammulai." - ".$row->jamakhir."</td>";
                          //echo "<td align='center'>".$row->jammulai."</td>";
                          //echo "<td align='center'>".$row->jamakhir."</td>";
                          //echo "<td align='center'>".strtoupper($CI->p_c->tgl_indo($row->tanggalrilis))."</td>";
                          //echo "<td align='center'>".strtoupper($CI->p_c->tgl_indo($row->tanggalkonfirmasi))."</td>";
											    echo "<td align='center'><b>".strtoupper($row->statustext)."</b></td>";
                          echo "<td align='center'>".$row->nilaievent."</td>";
                          echo "<td align='center'>".$CI->p_c->cekaktif($row->aktif)."</td>";
                          if($ubah=="0"){
    											    echo "<td align='center'>";
                              if($row->status=="1"){
    											        echo "<a href=javascript:void(window.open('".site_url('hrm_event/ubah/'.$row->replid)."')) class='btn btn-xs btn-warning fa fa-check-square'></a>&nbsp;&nbsp;";
                                  echo "<a href=javascript:void(window.open('".site_url('hrm_event/ubahstat_p/CC/'.$row->replid)."')) class='btn btn-xs btn-danger'>Batal</a>&nbsp;&nbsp;";
                                  // echo "<a href=javascript:void(window.open('".site_url('hrm_event/hapus/'.$row->replid)."') class='btn btn-xs btn-danger fa fa-minus-square'></a>";
                              }
                              if($row->status==5){
                                echo "<a href=javascript:void(window.open('".site_url('hrm_event/ubahstat_p/PR/'.$row->replid)."')) class='btn btn-xs btn-default'>Pre Test</a>&nbsp;&nbsp;";
                                echo "<a href=javascript:void(window.open('".site_url('hrm_event/ubahstat_p/CC/'.$row->replid)."')) class='btn btn-xs btn-danger'>Batal</a>&nbsp;&nbsp;";

                              }
                              if($row->status=="PR"){
                                echo "<a href=javascript:void(window.open('".site_url('hrm_event/ubahstat_p/PO/'.$row->replid)."')) class='btn btn-xs btn-default'>Post Test</a>&nbsp;&nbsp;";
                              }
                              if($row->status=="PO"){
                                echo "<a href=javascript:void(window.open('".site_url('hrm_event/ubahstat_p/EV/'.$row->replid)."')) class='btn btn-xs btn-default'>Evaluasi</a>&nbsp;&nbsp;";
                              }
                              if($row->status=="EV"){
                                echo "<a href=javascript:void(window.open('".site_url('hrm_event/ubahstat_p/4/'.$row->replid)."')) class='btn btn-xs btn-default'>Selesai</a>&nbsp;&nbsp;";
                              }
                              echo "</td>";
                          }
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
  <script type="text/javascript">
  function perihallainfunction(){
  	var valuex=document.getElementById("idperihal").value;
    if (valuex=="0"){
  		document.getElementById("perihallain").style.visibility ='visible';
  	}else{
  		document.getElementById("perihallain").style.visibility ='hidden';
  	}
  }
  </script>
		    <section class="content-header table-responsive">
	            <h1>
	                <?php echo $form ?>
	                <small><?php echo $form_small ?></small>
	            </h1>
            </section>
            <section class="content">
		        <?php
			        $attributes = array('class' => 'form-horizontal form-validate', 'id' => 'form', 'method' => 'POST');
		    	echo form_open($action,$attributes);
		    	?>
		    	<table width="100%" border="0">
            <!--
		    		<tr>
		            <th align="left">
	                		<label class="control-label" for="minlengthfield">Subjek</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		echo form_input(array('class' => '', 'id' => 'subjek','name'=>'subjek','value'=>$isi->subjek,'style'=>'width:500px','data-rule-required'=>'true' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'2' ,'placeholder'=>'Masukkan 2-100 Karakter'));
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th></tr>
                -->
                <tr>
                <th align="left">
                <label class="control-label" for="minlengthfield">Perihal</label>
                <div class="control-group">
              <div class="controls">:
                      <?php
                        $arridhrm_event_theme=' id="idhrm_event_theme" data-rule-required=true"';
                        echo form_dropdown('idhrm_event_theme',$idhrm_event_theme_opt,$isi->idhrm_event_theme,$arridhrm_event_theme);
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
                          $arridperihal=' id="idperihal" data-rule-required=true onchange="perihallainfunction();"';
                          echo form_dropdown('idperihal',$idperihal_opt,$isi->idperihal,$arridperihal);
                        ?>
                        <input type="textbox" name="perihallain" id="perihallain" style="visibility:hidden">
                </div>
                  </div>
                  </th></tr>
                  <tr>
                  <th align="left">
                  <label class="control-label" for="minlengthfield">Jumlah Sesi</label>
                  <div class="control-group">
                <div class="controls">:
                        <?php
                        $sesi_opt="";
                        for ($i = 1; $i <= 5; $i++) {
                            $sesi_opt[$i]=$i;
                        }
                        $arrsesi="style='width:80px;'";
                        echo form_dropdown('sesi',$sesi_opt,$isi->sesi,$arrsesi);
                        ?>
                </div>
                  </div>
                  </th></tr>
              <tr>
                <tr>
                <th align="left">
                <label class="control-label" for="minlengthfield">Penanggung Jawab</label>
                <div class="control-group">
              <div class="controls">:
                      <?php
                        $arridpenanggungjawab='data-rule-required=true';
                        echo form_dropdown('idpenanggungjawab',$idpenanggungjawab_opt,$isi->idpenanggungjawab,$arridpenanggungjawab);
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
                         $arridruang='data-rule-required=true';
                 echo form_dropdown('idruang',$idruang_opt,$isi->idruang,$arridruang);			                	?>
                       <?php //echo  <p id="message"></p> ?>
               </div>
                     </div>
                 </th>
              </tr>
              <tr>
                <th align="left">
                    <label class="control-label" for="minlengthfield">Tgl. Pelaksanaan</label>
                    <div class="control-group">
              <div class="controls">:
                      <?php
                        echo form_input(array('class' => '', 'id' => 'dp1','name'=>'tanggalpelaksanaan','value'=>$CI->p_c->tgl_form($isi->tanggalpelaksanaan),'data-rule-required'=>'false' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'2' ,'placeholder'=>'DD-MM-YYYY','autocomplete'=>'off'));
                      ?>
                      <?php //echo  <p id="message"></p> ?>
              </div>
                    </div>
                </th>
             </tr>
             <tr>
                 <th align="left">
                       <label class="control-label" for="minlengthfield">Jam Mulai (HH:MM)</label>
                       <div class="control-group">
                         <div class="controls">:
                                 <?php
                                   echo form_input(array('class' => '', 'id' => 'jammulai','name'=>'jammulai','value'=>$isi->jammulai,'style'=>'width:100px','data-rule-required'=>'true' ,'data-rule-maxlength'=>'5', 'data-rule-minlength'=>'5' ,'placeholder'=>'Format HH:MM'));
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
                                     echo form_input(array('class' => '', 'id' => 'jamakhir','name'=>'jamakhir','value'=>$isi->jamakhir,'style'=>'width:100px','data-rule-required'=>'true' ,'data-rule-maxlength'=>'5', 'data-rule-minlength'=>'5' ,'placeholder'=>'Format HH:MM'));
                                   ?>
                                   <?php //echo  <p id="message"></p> ?>
                           </div>
                         </div>
                 </tr>
             <!--
             <tr>
               <th align="left">
                   <label class="control-label" for="minlengthfield">Tgl. Konfirmasi</label>
                   <div class="control-group">
             <div class="controls">:
                     <?php
                       echo form_input(array('class' => '', 'id' => 'dp2','name'=>'tanggalkonfirmasi','value'=>$CI->p_c->tgl_form($isi->tanggalkonfirmasi),'data-rule-required'=>'false' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'2' ,'placeholder'=>'DD-MM-YYYY','autocomplete'=>'off'));
                     ?>
                     <?php //echo  <p id="message"></p> ?>
             </div>
                   </div>
               </th>
            </tr>
          -->
            <tr>
                  <th align="left">
                      <label class="control-label" for="minlengthfield">Target Peserta</label>
                      <div class="control-group">
                <div class="controls">:
                        <?php
                          echo form_input(array('id' => 'target_peserta','name'=>'target_peserta','value'=>$isi->target_peserta,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'3', 'data-rule-minlength'=>'1','data-rule-number'=>'true','placeholder'=>'Masukkan 1-3 Karakter'));
                        ?>
                        <?php //echo  <p id="message"></p> ?>
                </div>
                      </div>
              </th></tr>
			        <tr>
			            <th align="left">
	                		<label class="control-label" for="minlengthfield">Tujuan</label>
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
	        		<label class="control-label" for="minlengthfield">Peran Peserta Wajib</label>
	        		<div class="control-group">
						<div class="controls">
						<input type="checkbox" onClick="selectallx('idrole','selectall')" id="selectall" class="selectall"/> Pilih Semua <hr/>

	                	<?php
	                		$CI->p_c->checkbox_more('idrole',$idrole_opt,$isi->idrole);
	                	?>
	                	<?php //echo  <p id="message"></p> ?>
						</div>
	        		</div>
	            </th></tr>
              <tr>
                  <th align="left">
                  <label class="control-label" for="minlengthfield">Peran Peserta Tidak Wajib</label>
                  <div class="control-group">
                <div class="controls">
                <input type="checkbox" onClick="selectallx('idrole2','selectall')" id="selectall" class="selectall"/> Pilih Semua <hr/>

                        <?php
                          $CI->p_c->checkbox_more('idrole2',$idrole_opt,$isi->idrole2);
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
                          <label class="control-label" for="minlengthfield">Total Biaya</label>
                          <div class="control-group">
                    <div class="controls">:
                            <?php
                              echo form_input(array('id' => 'biaya','name'=>'biaya','value'=>$isi->biaya,'data-rule-required'=>'false' ,'data-rule-maxlength'=>'11', 'data-rule-minlength'=>'1','data-rule-number'=>'true','placeholder'=>'Masukkan 1-11 Karakter'));
                            ?>
                            <?php //echo  <p id="message"></p> ?>
                    </div>
                          </div>
                  </th></tr>
			         <tr>
				            <th align="left">
				            	<button class="btn btn-primary">Simpan</button>
				            	<a href="javascript:void(window.open('<?php echo site_url('hrm_event') ?>'))" class="btn btn-success">Batal</a>
				            </th>
				       </tr>
		        </table>
<!--------------------------------------------------------------------------------------------------------------------------->
		        	<?php
		        	echo form_close();
		        	?>
	    </section>
<?php } elseif($view=='view'){ ?>
  <script type="text/javascript">
  var site = "<?php echo site_url();?>";
  function pematerilainfunction(){
  	var valuex=document.getElementById("idpemateri").value;
    if (valuex=="0"){
  		document.getElementById("pematerilain").style.visibility ='visible';
  	}else{
  		document.getElementById("pematerilain").style.visibility ='hidden';
  	}
  }

  function cetakprint() {
    newWindow('<?php echo site_url("hrm_event/printevent/0/".$isi->replid)?>', 'printlistinventaris','900','800','resizable=1,scrollbars=1,status=0,toolbar=0')
  }
  function cetakexcel() {
    newWindow('<?php echo site_url("hrm_event/printevent/1/".$isi->replid)?>', 'printlistinventaris','900','800','resizable=1,scrollbars=1,status=0,toolbar=0')
  }

  function eventevaluationpemateri_p(id) {
    newWindow('<?php echo site_url("hrm_event/eventevaluation_p/pemateri/".$isi->replid)."/"?>'+id, 'eventevaluationpemateri_p','900','800','resizable=1,scrollbars=1,status=0,toolbar=0')
  }
  function eventevaluationpeserta_p(id) {
    newWindow('<?php echo site_url("hrm_event/eventevaluation_p/peserta/".$isi->replid)."/"?>'+id, 'eventevaluationpeserta_p','900','800','resizable=1,scrollbars=1,status=0,toolbar=0')
  }

  function eventevaluationdetail_p(id) {
    newWindow('<?php echo site_url("hrm_event/eventevaluationdetail_p/".$isi->replid)."/"?>'+id, 'eventevaluationdetail_p','900','800','resizable=1,scrollbars=1,status=0,toolbar=0')
  }


  </script>
			<section class="content-header table-responsive">
	            <h1>
	                <?php echo $form ?>
	                <small><?php echo $form_small ?></small>
	            </h1>
              <?php if($ubah<>2){?>
              <ol class="breadcrumb">
                <li><a href="JavaScript:cetakprint()"><i class="fa fa-file-text"></i>&nbsp;Cetak</a></li>
                <!-- <li><a href="JavaScript:cetakexcel()"><i class="fa fa-print"></i>&nbsp;Excel</a></li> -->
              </ol>
              <?php } ?>
            </section>
            <section class="content">
	    	<table width="100%" border="0" class="form-horizontal form-validate">
	    		<tr>
	            <th align="left">
	        		<label class="control-label" for="minlengthfield">Kode Pelatihan</label>
	        		<div class="control-group">
						<div class="controls">:
	                	<?php
	                		echo $isi->kode_transaksi;
	                	?>
						</div>
	        		</div>
	            </th>
              <?php if((($isi->status=="5") or ($isi->status=="PR")) and ($ubah<>"2")){ ?>
              <td rowspan="11" width="300" align="center">
                  <img src="<?php echo base_url(); ?>uploads\hrm_event\qreventhadir_<?php echo $isi->sesiaktif; ?>_<?php echo $isi->replid; ?>.png" width="100%"> <br/>
                  <h2><?php echo $isi->kodeabsen ?></h2>
              </td>
            <?php } ?>
            <?php if($isi->status=="EV"){ ?>
            <th rowspan="11" width="300">
                <img src="<?php echo base_url(); ?>uploads\hrm_event\qreventpemateri_<?php echo $isi->replid; ?>.png" width="100%">
            </th>
          <?php } ?>
            </tr>
              <tr>
    	            <th align="left">
    	        		<label class="control-label" for="minlengthfield">Tema</label>
    	        		<div class="control-group">
    						<div class="controls">:
    	                	<?php
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
                    <label class="control-label" for="minlengthfield">Jumlah Sesi</label>
                    <div class="control-group">
                  <div class="controls">:
                          <?php
                            echo $isi->sesi;
                          ?>
                  </div>
                    </div>
                  </th></tr>
                <tr>
                  <tr>
                  <th align="left">
                  <label class="control-label" for="minlengthfield">Penanggung Jawab</label>
                  <div class="control-group">
                <div class="controls">:
                        <?php

                          echo $CI->dbx->getpegawai($isi->idpenanggungjawab,0,1);
                        ?>
                </div>
                  </div>
                  </th></tr>
                  <tr>
                    <tr>
                    <th align="left">
                    <label class="control-label" for="minlengthfield">Tujuan</label>
                    <div class="control-group">
                  <div class="controls">:
                          <?php

                            echo $isi->deskripsi;
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
                      echo strtoupper($CI->p_c->tgl_indo($isi->tanggalpelaksanaan))." (".$isi->jammulai." s/d ".$isi->jamakhir.")";
                    ?>
            </div>
              </div>
              </th></tr>
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
            <label class="control-label" for="minlengthfield">Peran Peserta Wajib</label>
            <div class="control-group">
          <div class="controls">:
                  <?php
                    echo $CI->dbx->role_show($isi->idrole,0);
                  ?>
                  <?php //echo  <p id="message"></p> ?>
          </div>
            </div>
            </th></tr>
            <tr>
                <th align="left">
                <label class="control-label" for="minlengthfield">Peran Peserta Tidak Wajib</label>
                <div class="control-group">
              <div class="controls">:
                      <?php
                        echo $CI->dbx->role_show($isi->idrole2,0);
                      ?>
                      <?php //echo  <p id="message"></p> ?>
              </div>
                </div>
                </th></tr>
                <?php if($ubah<>"2"){?>
                <tr>
                    <th align="left">
                    <label class="control-label" for="minlengthfield">Total Biaya</label>
                    <div class="control-group">
                  <div class="controls">:
                          <?php
                            echo strtoupper($CI->p_c->rupiah($isi->biaya));
                          ?>
                  </div>
                    </div>
                    </th></tr>
              <?php
            } //$ubah<>"2" ?>
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
         </table>
<!--------------------------------------------------------------------------------------------------------------------------->
       <hr><h4 align="left">Pengisi Materi :</h4>
       <?php if($ubah=="1"){
 		    $attributes = array('class' => 'form-horizontal form-validate', 'id' => 'form', 'method' => 'POST', 'novalidate'=>'novalidate');
 	    	echo form_open($actionpemateri,$attributes);
 	     ?>
       <table>
       <tr>
       <th align="left">
       <label class="control-label" for="minlengthfield">Pengisi Materi</label>
       <div class="control-group">
     <div class="controls">:
             <?php
               $arridpemateri=' id="idpemateri" data-rule-required=true onchange="pematerilainfunction();" style="width:350px"';
               echo form_dropdown('idpemateri',$idpemateri_opt,' ',$arridpemateri);
             ?>
             <input type="textbox" name="pematerilain" id="pematerilain" style="visibility:hidden"><br/>
             <button class='btn btn-primary'>Simpan</button>&nbsp;&nbsp;
     </div>
       </div>
       </th></tr>
     </table>
     <?php echo form_close(); } ?>
         <div class="box-body table-responsive">
         <table class="table table-bordered table-striped">
         <thead>
             <tr>
                 <th width="50">No.</th>
                 <th width="150">No. Register</th>
                 <th>Nama</th>
                 <?php if($ubah=="1"){?>
                 <th width="80">Aksi</th>
               <?php } ?>
             </tr>
         </thead>
         <tbody>
           <?php
                   $CI =& get_instance();
                   $no=1;
                   foreach((array)$hrm_event_pemateri as $rowpem) {
                   echo "<tr>";
                   echo "<td align='center'>".$no++."</td>";
                   if ($ubah==3){
                      echo "<td align='center'><a href='JavaScript:eventevaluationpemateri_p(".$rowpem->idpemateri.")'>".$rowpem->no_register."</a></td>";
                   }else{
                     echo "<td align='center'>".$rowpem->no_register."</td>";
                   }
                   echo "<td align='left'>".$rowpem->namapemateri."</td>";
                  if($ubah=="1"){
                     echo "<td align='center'>";
                     echo "<a href=javascript:void(window.open('".site_url('hrm_event/hapuspemateri/'.$rowpem->idhrm_event.'/'.$rowpem->idpemateri)."')) class='btn btn-xs btn-danger fa fa-minus-square'></a>";
                   }
                   echo "</td>";
                   echo "</tr>";
                   }
               ?>

                   </tbody>
               </table>
             </div>
 <!--------------------------------------------------------------------------------------------------------------------------->
         <hr><h4 align="left">Rundown Pelatihan :</h4>
         <?php if($ubah=="1"){?>
               <ol class="breadcrumb">
                   <li><a href="javascript:void(window.open('<?php echo site_url('hrm_event/tambahrundown/'.$isi->replid); ?>'))"><i class="fa fa-plus-square"></i> Tambah</a></li>
               </ol>
           <?php } ?>
           <div class="box-body table-responsive">
           <table class="table table-bordered table-striped">
           <thead>
               <tr>
                   <th width="50">No.</th>
                   <th>Rundown</th>
                   <th>Dari</th>
                   <th>Sampai</th>
                   <th>Lama</th>
                   <?php if($ubah=="1"){?>
                   <th width="80">Aksi</th>
                 <?php } ?>
               </tr>
           </thead>
           <tbody>
             <?php
                     $CI =& get_instance();
                     $no=1;
                     foreach((array)$hrm_event_rundown as $rowrun) {
                     echo "<tr>";
                     echo "<td align='center'>".$no++."</td>";
                     echo "<td align='left'>".$rowrun->hrm_event_rundown."</td>";
                     echo "<td align='center'>".$rowrun->dari."</td>";
                     echo "<td align='center'>".$rowrun->sampai."</td>";
                     echo "<td align='center'>".$rowrun->lama."</td>";
                     if($ubah=="1"){
                       echo "<td align='center'>";
                       echo "<a href=javascript:void(window.open('".site_url('hrm_event/tambahrundown/'.$rowrun->idhrm_event.'/'.$rowrun->replid)."')) class='btn btn-xs btn-warning fa fa-check-square'></a>&nbsp;&nbsp;";
                       echo "<a href=javascript:void(window.open('".site_url('hrm_event/hapusrundown/'.$rowrun->idhrm_event.'/'.$rowrun->replid)."')) class='btn btn-xs btn-danger fa fa-minus-square'></a>";
                     }
                     echo "</td>";
                     echo "</tr>";
                     }
                 ?>

                     </tbody>
                 </table>
               </div>
<!--------------------------------------------------------------------------------------------------------------------------->

        <hr/><h4 align="left">Evaluasi Pelatihan</h4><hr/>
        <?php if($ubah=="1"){?>
              <ol class="breadcrumb">
                  <li><a href="javascript:void(window.open('<?php echo site_url('hrm_event/importeventevaluationpelaksana/'.$isi->replid); ?>'))"><i class="fa fa-plus-square"></i> Import Default</a></li>
                  <!-- <li><a href="javascript:void(window.open('<?php echo site_url('hrm_event/tambahmaterial/'.$isi->replid); ?>'))"><i class="fa fa-plus-square"></i> Tambah</a></li> -->
              </ol>
          <?php } ?>
          <?php if($ubah<>"2"){?>
          <h4 align="left">Pemateri :</h4>
          <div class="box-body table-responsive">
          <table class="table table-bordered table-striped">
          <thead>
              <tr>
                  <th width="50">No.</th>
                  <!-- <th>Peruntukan</th> -->
                  <th>Head</th>
                  <th>Evaluasi Pelatihan</th>
                  <th>Skor Target</th>
                  <th>Pemateri</th>
                  <?php if($ubah=="1"){?>
                  <th width="80">Aksi</th>
                <?php } ?>
              </tr>
          </thead>
          <tbody>
            <?php
                    $CI =& get_instance();
                    $no=1;$avgevalpemateri=0;$nohit=0;$avgevalpemateritarget=0;
                    foreach((array)$hrm_event_evaluation_pelaksana_pemateri as $roweep) {
                        $avgevalpemateritarget=$avgevalpemateritarget+$roweep->target_skor;
                        echo "<tr>";
                        echo "<td align='center'>".$no++."</td>";
                        //echo "<td align='left'>".$roweep->type."</td>";
                        echo "<td align='left'>".$roweep->head."</td>";
                        echo "<td align='left'>".$roweep->hrm_event_evaluation."</td>";
                        echo "<td align='center'>".$roweep->target_skor."</td>";
                        echo "<td align='center'>".$roweep->avgpeserta."</td>";
                        if($ubah=="1"){
                          echo "<td align='center'>";
                          echo "<a href=javascript:void(window.open('".site_url('hrm_event/hrmeventevaluationpelaksanahapus/'.$roweep->idhrm_event.'/'.$roweep->idhrm_event_evaluation)."')) class='btn btn-xs btn-danger fa fa-minus-square'></a>";
                          echo "</td>";
                        }
                        if($roweep->target_skor>=1){
													$nohit++;
													$avgevalpemateri=$avgevalpemateri+$roweep->avgpeserta;
												}
                        echo "</tr>";
                    }
                    if($avgevalpemateritarget<>0){
                        $avgevalpemateritarget=round($avgevalpemateritarget/($no-1));
                    }
                    if($avgevalpemateri<>0){
                        $avgevalpemateri=round($avgevalpemateri/$nohit);
                    }
                ?>

                    </tbody>
                </table>
              </div>
        <?php } //  cek dari event sign $ubah=="2"
        ?>
        <h4 align="left">Peserta :</h4>
        <div class="box-body table-responsive">
        <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th width="50">No.</th>
                <!-- <th>Peruntukan</th> -->
                <th>Head</th>
                <th>Evaluasi Pelatihan</th>
                <th>Skor Target</th>
                <th>Peserta</th>
                <?php if($ubah=="1"){?>
                <th width="80">Aksi</th>
              <?php } ?>
            </tr>
        </thead>
        <tbody>
          <?php
                  $CI =& get_instance();
                  $no=1;$avgevalpeserta=0;$nohit=0;$avgevalpesertatarget=0;
                  foreach((array)$hrm_event_evaluation_pelaksana_peserta as $roweep) {
                      $avgevalpesertatarget=$avgevalpesertatarget+$roweep->target_skor;
                      echo "<tr>";
                      echo "<td align='center'>".$no++."</td>";
                      //echo "<td align='left'>".$roweep->type."</td>";
                      echo "<td align='left'>".$roweep->head."</td>";
                      echo "<td align='left'>".$roweep->hrm_event_evaluation."</td>";
                      echo "<td align='center'>".$roweep->target_skor."</td>";
                      if ($ubah==3){
                         echo "<td align='center'><a href='JavaScript:eventevaluationdetail_p(".$roweep->idhrm_event_evaluation.")'>".$roweep->avgpeserta."</a></td>";
                      }else{
                        echo "<td align='center'>".$roweep->avgpeserta."</td>";
                      }

                      if($ubah=="1"){
                        echo "<td align='center'>";
                        echo "<a href=javascript:void(window.open('".site_url('hrm_event/hrmeventevaluationpelaksanahapus/'.$roweep->idhrm_event.'/'.$roweep->idhrm_event_evaluation)."')) class='btn btn-xs btn-danger fa fa-minus-square'></a>";
                        echo "</td>";
                      }
                      echo "</tr>";

                      if($roweep->target_skor>=1){
                        $nohit++;
                        $avgevalpeserta=$avgevalpeserta+$roweep->avgpeserta;
                      }
                  }
                  if($avgevalpesertatarget<>0){
                    $avgevalpesertatarget=round($avgevalpesertatarget/($no-1));
                  }
                  if($avgevalpeserta<>0){
                    $avgevalpeserta=round($avgevalpeserta/$nohit);
                  }
              ?>

                  </tbody>
              </table>
            </div>
              <?php if(($ubah<>"2") and isset($hrm_event_evaluation_deskripsi)){
              ?>
              <h4 align="left">Kritik dan Saran :</h4>
              <div class="box-body table-responsive">
              <table class="table table-bordered table-striped">
              <thead>
                  <tr>
                      <th width="50">No.</th>
                      <th>Oleh</th>
                      <th>Head</th>
                      <th>Evaluasi Pelatihan</th>
                      <th>Kritik dan Saran</th>
                  </tr>
              </thead>
              <tbody>
                <?php
                        $CI =& get_instance();
                        $no=1;
                        foreach((array)$hrm_event_evaluation_deskripsi as $rowdep) {
                        echo "<tr>";
                        echo "<td align='center'>".$no++."</td>";
                        echo "<td align='left'>".$rowdep->type."</td>";
                        echo "<td align='left'>".$rowdep->head."</td>";
                        echo "<td align='left'>".$rowdep->hrm_event_evaluation."</td>";
                        echo "<td align='left'>".$rowdep->deskripsinilai."</td>";
                        echo "</tr>";
                        }
                    ?>

                        </tbody>
                    </table>
                  </div>
            <?php } //  cek dari event sign $ubah=="2"
            ?>
<!--------------------------------------------------------------------------------------------------------------------------->
        <?php if($ubah<>"2"){?>
        <hr><h4 align="left">Peserta [Target <?php echo $isi->target_peserta; ?> Orang] :</h4>
      <?php } else {
        echo "<hr><h4 align='left'>Peserta :</h4>";
      }?>
        <?php if($ubah=="1"){
              $idroletext="";
              $idroletext2="";
              if($isi->idrole<>""){
                  $idroletext=str_replace(",","TRX",$isi->idrole);
              }
              if($isi->idrole2<>""){
                  $idroletext2=str_replace(",","TRX",$isi->idrole2);
              }
              ?>
              <ol class="breadcrumb">
                  <li><a href="javascript:void(window.open('<?php echo site_url('hrm_event/import_peserta_p/'.$isi->replid.'/'.$idroletext.'/'.$idroletext2); ?>'))"><i class="fa fa-plus-square"></i> Import Default</a></li>
              </ol>
          <?php } ?>
          <?php if($ubah=="1"){
      		    $attributes = array('class' => 'form-horizontal form-validate', 'id' => 'form', 'method' => 'POST', 'novalidate'=>'novalidate');
      	    	echo form_open($actionpegawai,$attributes);
      	     ?>
              <table>
              <tr>
                <th align="left">
                <label class="control-label" for="minlengthfield">Tambah Peserta</label>
                  <div class="control-group">
                      <div class="controls">:
                              <?php
                                $arridpegawai=' id="idpegawai" data-rule-required=true style="width:350px"';
                                echo form_dropdown('idpegawai',$idpegawai_opt,' ',$arridpegawai);
                              ?>
                              &nbsp;<input type="checkbox" value="1" name="wajib">&nbsp;Wajib&nbsp;&nbsp;
                              <button class='btn btn-primary'>Simpan</button>&nbsp;&nbsp;
                      </div>
                  </div>
                </th>
            </tr>
            </table>
          <?php echo form_close(); } ?>
          <div class="box-body table-responsive">
          <table id="example1" class="table table-bordered table-striped">
          <thead>
              <tr>
                  <th width="50" rowspan=2>No.</th>
                  <th rowspan=2>Nama</th>
                  <th rowspan=2>Akun</th>
                  <th rowspan=2>Wajib</th>
                  <th rowspan=2>KKM</th>
                  <th rowspan=2>Pretest</th>
                  <th rowspan=2>Posttest</th>
                  <th rowspan=2>Selisih</th>
                  <th rowspan=2>Hadir</th>
                  <th colspan=<?php echo $isi->sesi; ?>>Absen</th>
                  <?php
                  if($ubah=="1"){
                      echo '<th width="150" rowspan=2>Aksi</th>';
                  }
                  ?>

              </tr>
              <tr>
                <?php
                //if(($isi->harievent=="1") and (!$ubah=="1")){
                  for ($i = 1; $i <= $isi->sesi; $i++) {
                    echo "<th align='center'>".$CI->p_c->romawi($i)."</th>";
                  }
                //}
                ?>
              </tr>
          </thead>
          <tbody>
            <?php
                    $CI =& get_instance();
                    $no=1;$nohadir=0;$tot_pretest=0;$tot_posttest=0;$hadirnilaiakhir=0;$avgposttest=0;$jmlkkm=0;
                    foreach((array)$hrm_event_peserta as $rowepes) {
                        if($rowepes->pretest<>""){
                            $tot_pretest+=$rowepes->pretest;$tot_posttest+=$rowepes->posttest;
                            $nohadir++;
                        }
                        if($isi->kkm<=$rowepes->posttest){
                          $jmlkkm++;
                        }
                        echo "<tr>";
                        echo "<td align='center'>".$no++."</td>";
                        echo "<td align='left'>".$CI->dbx->getpegawai($rowepes->idpeserta,0,1)."</td>";
                        echo "<td align='center'>".$CI->p_c->cekaktif($rowepes->aktiflogin)."</td>";
                        echo "<td align='center'>".$CI->p_c->cekaktif($rowepes->wajib)."</td>";
                        echo "<td align='center'>".$isi->kkm."</td>";
                        echo "<td align='center'>".$rowepes->pretest."</td>";
                        echo "<td align='center'>".$rowepes->posttest."</td>";
                        echo "<td align='center'>".($rowepes->posttest-$rowepes->pretest)."</td>";
                        echo "<td align='center'>";
                        if ($ubah==3){
                            echo "<a href='JavaScript:eventevaluationpeserta_p(".$rowepes->idpegawai.")'>".$CI->p_c->cekaktif($rowepes->hadir)."</a>";
                        }else{
                            echo $CI->p_c->cekaktif($rowepes->hadir);
                        }
                        echo "</td>";

                        for ($i = 1; $i <= $isi->sesi; $i++) {
                          $th="tanggalhadir".$i;
                          echo "<td align='center'>";
                          if ($rowepes->hadir){
                            echo $rowepes->$th;
                          }else{
                            if((($isi->status=="5") or ($isi->status=="PR")) and ($ubah<>"2")){
                              echo "<a href=javascript:void(window.open('".site_url('hrm_event/hadirqr_p/'.$i."/".$rowepes->idhrm_event.'/'.$rowepes->idpegawai)."')) 'class='btn btn-xs btn-primary'>Hadir</a>&nbsp;&nbsp;";
                            }else{
                              echo $rowepes->$th;
                            }
                          }
                          echo "</td>";
                        }
                        /* ini harusnya absen by panitia
                        if(($isi->harievent=="1") and (!$ubah=="1")){
                          echo "<td align='center'>";
                          if($rowepes->tanggalhadir1==""){
                            echo "<a href=javascript:void(window.open('".site_url('hrm_event/hadir_p/'.$rowepes->idhrm_event.'/'.$rowepes->idpegawai)."')) class='btn btn-xs btn-primary'>Hadir</a>&nbsp;&nbsp;";
                          }
                          echo "</td>";
                        }
                        */
                        if($ubah=="1"){
                          echo "<td align='center'>";
                          echo "<a href=javascript:void(window.open('".site_url('hrm_event/hrmeventpesertahapus/'.$rowepes->idhrm_event.'/'.$rowepes->idpeserta)."')) class='btn btn-xs btn-danger fa fa-minus-square'></a>";
                          echo "</td>";
                        }

                        //total hadir penilaian Akhir
                        if(($rowepes->wajib) and ($rowepes->hadir)){
                          $hadirnilaiakhir=$hadirnilaiakhir+1;
                        }
                        echo "</tr>";
                    }
                    if($tot_posttest<>0){
                        $avgposttest=$tot_posttest/$nohadir;
                    }
                ?>
                    </tbody>
                </table>
              </div>

<!--------------------------------------------------------------------------------------------------------------------------->
                <hr><h4>Attachment :</h4>
                  <?php
                  if($ubah=="1"){
                   $attributes = array('class' => 'form-horizontal form-validate', 'id' => 'form', 'method' => 'POST', 'novalidate'=>'novalidate');
                   echo form_open_multipart($actionattachment,$attributes);
                  ?>
                  <div align="left">
                  <input type="file" name="userfile" size="20" /><br/>
                  <input type="submit" value="upload" class='btn btn-xs btn-primary'/>
                  </div>
                  <hr/><br/>
                  <?php echo form_close();
                  }?>
                  <div class="box-body table-responsive">
                  <table class="table table-bordered table-striped">
                          <thead>
                              <tr>
                                  <th width="30px">No.</th>
                                  <th>Nama File</th>
                                  <?php if($ubah=="1"){ ?>
                                  <th width="80">Aksi</th>
                                <?php } ?>
                              </tr>
                          </thead>
                          <tbody>
                            <?php
                            $CI =& get_instance();$no=1;
                  foreach((array)$attachment as $rowattachment) {
                      echo "<tr>";
                      echo "<td>".$no++."</td>";
                      echo "<td align='left'><a href='".base_url()."uploads/hrm_event/".$rowattachment->newfile."'>".$rowattachment->file."</td>";
                      if($ubah=="1"){
                        echo "<td>";
                        echo "<a href=javascript:void(window.open('".site_url('hrm_event/hapusattachment_p/'.$rowattachment->idhrm_event.'/'.$rowattachment->replid.'/'.$rowattachment->newfile)."')) class='btn btn-danger' id='btnOpenDialog'>Hapus</a>";
                        echo "</td>";
                      }
                      echo "</tr>";
                  }
                  ?>
              </tbody>
              <tfoot>
              </tfoot>
            </table>
          </div>
              <?php
              if($ubah<>"2"){
                    $attributes = array('class' => 'form-horizontal form-validate', 'id' => 'form', 'method' => 'POST', 'novalidate'=>'novalidate');
                    echo form_open($action,$attributes);

                    /*
                    Kehadiran peserta: 25% dr interval target peserta
                    Hasil evaluasi: 30% dr avg skortarget<avg peserta
                    Rata2 postest: 20%
                    Jml peserta di atas kkm : 25%
                    */
                    $nilaiakhirevent=0;
                    if(($isi->status=="EV") or ($isi->status=="4")){?>
                    <div class="box-body table-responsive">
                    <table class="table table-bordered table-striped">
                      <tr><?php
                        echo "<th width='50'>No.</th>";
                        echo "<th>Indeks</th>";
                        echo "<th>Persentase</th>";
                        echo "<th>Nilai Indeks</th>";
                        echo "<th>Nilai Asli</th>";
                        echo "<th>Nilai Akhir</th>";
                        ?>
                      </tr>
                        <?php
                          $nonilaiakhir=1;
                          $persennilaiakhir=25;
                          $nilaiakhir1=0;
                          if($hadirnilaiakhir<>0){
                              $nilaiakhir1=round(($hadirnilaiakhir/$isi->target_peserta)*100,2);
                          }
                          if($nilaiakhir1>100){
                            $nilaiakhir1=100;
                          }
                          $nilaiakhir1a=(($nilaiakhir1/100)*$persennilaiakhir);
                          $nilaiakhirevent=$nilaiakhirevent+$nilaiakhir1a;
                          echo "<tr>";
                          echo "<td>".$nonilaiakhir++."</td>";
                          echo "<td align='left'>Kehadiran Peserta</td>";
                          echo "<td>".$persennilaiakhir."%</td>";
                          echo "<td>".$isi->target_peserta."</td>";
                          echo "<td>".$hadirnilaiakhir."(".$nilaiakhir1.")"."</td>";
                          echo "<td>".($nilaiakhir1a)."</td>";
                          echo "</tr>";
                          $nilaiakhir1=0;
                          $persennilaiakhir=30;
                          $nilaiakhir1=round((($avgevalpemateri+$avgevalpeserta)/2)*20,2);
                          $nilaiakhir1a=(($nilaiakhir1/100)*$persennilaiakhir);
                          $nilaiakhirevent=$nilaiakhirevent+$nilaiakhir1a;
                          echo "<tr>";
                          echo "<td>".$nonilaiakhir++."</td>";
                          echo "<td align='left'>Hasil Evaluasi</td>";
                          echo "<td>".$persennilaiakhir."%</td>";
                          echo "<td>".(($avgevalpemateritarget+$avgevalpesertatarget)/2)."</td>";
                          echo "<td>".(($avgevalpemateri+$avgevalpeserta)/2)."(".$nilaiakhir1.")"."</td>";
                          echo "<td>".($nilaiakhir1a)."</td>";
                          echo "</tr>";
                          $nilaiakhir1=0;
                          $persennilaiakhir=20;
                          $nilaiakhir1=round($avgposttest,2);
                          $nilaiakhir1a=(($nilaiakhir1/100)*$persennilaiakhir);
                          $nilaiakhirevent=$nilaiakhirevent+$nilaiakhir1a;
                          echo "<tr>";
                          echo "<td>".$nonilaiakhir++."</td>";
                          echo "<td align='left'>Rata-Rata Postest</td>";
                          echo "<td>".$persennilaiakhir."%</td>";
                          echo "<td>".$nilaiakhir1."</td>";
                          echo "<td>".$nilaiakhir1."</td>";
                          echo "<td>".($nilaiakhir1a)."</td>";
                          echo "</tr>";
                          $nilaiakhir1=0;
                          $persennilaiakhir=25;
                          if($jmlkkm<>0){
                            $nilaiakhir1=round(($jmlkkm/$nohadir)*100,2);
                          }
                          $nilaiakhir1a=(($nilaiakhir1/100)*$persennilaiakhir);
                          $nilaiakhirevent=$nilaiakhirevent+$nilaiakhir1a;
                          echo "<tr>";
                          echo "<td>".$nonilaiakhir++."</td>";
                          echo "<td align='left'>Jumlah Peserta Diatas KKM</td>";
                          echo "<td>".$persennilaiakhir."%</td>";
                          echo "<td>".$nohadir."</td>";
                          echo "<td>".$jmlkkm."(".$nilaiakhir1.")"."</td>";
                          echo "<td>".($nilaiakhir1a)."</td>";
                          echo "</tr>";
                          ?>
                      </tr>
                      <tr>
                        <td colspan="5"><b>Total Nilai:</b></td>
                        <td><?php echo $nilaiakhirevent."<b> (".round($nilaiakhirevent).")</b>" ?></td>
                      </tr>
                    </table>
                  </div>
            <?php }
          } //if ubah<>2
            ?>
	            <table border="0">
  		            <tr align="left">
  			            <td>
                      <?php if($ubah=="1"){
                        echo "<button class='btn btn-primary' value='simpan' name='submit'>Simpan</button>&nbsp;&nbsp;";
                      ?>
                      <!-- <button class='btn btn-xs btn-default' value="rilis" name="submit">Rilis</button>&nbsp;&nbsp; -->
                      <a href="javascript:void(window.open('<?php echo site_url('hrm_event/hapus/'.$isi->replid) ?>'))" class="btn btn-danger">Hapus</a>&nbsp;&nbsp;
                    <?php
                    } else{
                      if($isi->status=="1"){?>
                        <a href="javascript:void(window.open('<?php echo site_url('hrm_event/ubah/'.$isi->replid) ?>'))" class="btn btn-warning">Ubah</a>&nbsp;&nbsp;

                    <?php
                        echo "<a href=javascript:void(window.open('".site_url('hrm_event/ubahstat_p/CC/'.$isi->replid)."')) class='btn btn-danger'>Batal</a>&nbsp;&nbsp;";
                      }else{
                      //echo "<a href=javascript:void(window.open('".site_url('hrm_event_sign/nilaievent_p/1/pelaksana/'.$isi->replid)."')) class='btn btn-xs btn-primary'>Nilai Event</a>&nbsp;&nbsp;";
                    }
                    }?>
                      <?php if($ubah<>"2"){
                          //$isi->sisahari  //11102018
                          if(($isi->sisahari>0) and (count($hrm_event_peserta)<>0) and (count($hrm_event_evaluation_pelaksana_peserta)<>0) and (count($hrm_event_evaluation_pelaksana_pemateri)<>0) and ($isi->status=="1")){
                              echo "<a href=javascript:void(window.open('".site_url('hrm_event/rilis_p/'.$isi->replid)."')) class='btn btn-default'>Rilis</a>&nbsp;&nbsp;";
                          }
                          if($isi->status==5){
                            echo "<a href=javascript:void(window.open('".site_url('hrm_event/ubahstat_p/PR/'.$isi->replid)."')) class='btn btn-default'>Pre Test</a>&nbsp;&nbsp;";
                            echo "<a href=javascript:void(window.open('".site_url('hrm_event/ubahstat_p/CC/'.$isi->replid)."')) class='btn btn-danger'>Batal</a>&nbsp;&nbsp;";
                          }
                          if($isi->status=="PR"){
                            echo "<a href=javascript:void(window.open('".site_url('hrm_event/ubahstat_p/PO/'.$isi->replid)."')) class='btn btn-default'>Post Test</a>&nbsp;&nbsp;";
                          }
                          if($isi->status=="PO"){
                            echo "<a href=javascript:void(window.open('".site_url('hrm_event/ubahstat_p/EV/'.$isi->replid)."')) class='btn btn-default'>Evaluasi</a>&nbsp;&nbsp;";
                          }
                          if($isi->status=="EV"){
                            echo "<a href=javascript:void(window.open('".site_url('hrm_event/ubahstat_p/4/'.$isi->replid.'/'.round($nilaiakhirevent))."')) class='btn btn-default'>Selesai</a>&nbsp;&nbsp;";
                          }
                          echo "<a href=javascript:void(window.open('".site_url('hrm_event')."')) class='btn btn-success'>Kembali</a>&nbsp;&nbsp;";
                        }else{
                          echo "<a href=javascript:void(window.open('".site_url('hrm_event_sign')."')) class='btn btn-success'>Kembali</a>&nbsp;&nbsp;";
                        }
                        ?>
                    </td>
  		            </tr>
	            </table>
            </section>
	        	<?php
	        	echo form_close();
} elseif($view=='tambahrundown'){ ?>
	    <section class="content-header table-responsive">
            <h1>
                <?php echo $form ?>
                <small><?php echo $form_small ?></small>
            </h1>
          </section>
          <section class="content">
	        <?php
		        $attributes = array('class' => 'form-horizontal form-validate', 'id' => 'form', 'method' => 'POST');
	    	echo form_open($action,$attributes);
	    	?>
	    	<table width="100%" border="0">
	    		<tr>
	            <th align="left">
                		<label class="control-label" for="minlengthfield">Rundown</label>
                		<div class="control-group">
							<div class="controls">:
		                	<?php
		                		echo form_input(array('class' => '', 'id' => 'hrm_event_rundown','name'=>'hrm_event_rundown','value'=>$isi->hrm_event_rundown,'style'=>'width:500px','data-rule-required'=>'true' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'2' ,'placeholder'=>'Masukkan 2-100 Karakter'));
		                	?>
		                	<?php //echo  <p id="message"></p> ?>
							</div>
                		</div>
		            </th></tr>
        <tr>
            <th align="left">
              		<label class="control-label" for="minlengthfield">Dari (HH:MM)</label>
              		<div class="control-group">
      							<div class="controls">:
      		                	<?php
      		                		echo form_input(array('class' => '', 'id' => 'dari','name'=>'dari','value'=>$isi->dari,'style'=>'width:100px','data-rule-required'=>'true' ,'data-rule-maxlength'=>'5', 'data-rule-minlength'=>'5' ,'placeholder'=>'Format HH:MM'));
      		                	?>
      		                	<?php //echo  <p id="message"></p> ?>
      							</div>
              		</div>
          </tr>
          <tr>
	            <th align="left">
                		<label class="control-label" for="minlengthfield">Sampai (HH:MM)</label>
                		<div class="control-group">
        							<div class="controls">:
        		                	<?php
        		                		echo form_input(array('class' => '', 'id' => 'sampai','name'=>'sampai','value'=>$isi->sampai,'style'=>'width:100px','data-rule-required'=>'true' ,'data-rule-maxlength'=>'5', 'data-rule-minlength'=>'5' ,'placeholder'=>'Format HH:MM'));
        		                	?>
        		                	<?php //echo  <p id="message"></p> ?>
        							</div>
                		</div>
            </tr>
		         <tr>
			            <th align="left">
			            	<button class="btn btn-primary">Simpan</button>
			            	<a href="javascript:void(window.open('<?php echo site_url('hrm_event/view/1/'.$id) ?>'))" class="btn btn-success">Batal</a>
			            </th>
			       </tr>
	        </table>
<!--------------------------------------------------------------------------------------------------------------------------->
</section>
<?php } elseif($view=='gagalabsen'){ ?>
<section class="content-header table-responsive">
  <h3><font style="color:red">Absensi Gagal</font></h3>
  <?php
    switch ($tipe){
      case "1":echo "<h5>Event Telah Kadaluarsa</h5>";break;
      case "2":echo "<h5>Anda Tidak Terdaftar Dalam Event</h5>";break;
      default:"";
    }
    echo "<h5>Scan Kembali QR Code atau Hubungi Panitia Acara</h5>"
  ?>

</section>
<?}
?>
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
    </body>
</html>
