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
                <section class="content-header table-responsive">
                    <h1>
                        <?php echo $form ?>
                        <small>List Data</small>
                    </h1>

                    <ol class="breadcrumb">
                      <!--
                        <li><a href="javascript:void(window.open('<?php echo site_url('psb_assessment/tambah'); ?>'))" ><i class="fa fa-plus-square"></i> Tambah</a></li>
                        <li><a href="#"><i class="fa fa-file-text"></i>Cetak</a></li>
                        <li><a href="#"><i class="fa fa-file-excel-o"></i>Excel</a></li>
                        -->
                    </ol>
                </section>

                <section class="content-header table-responsive">
                <?php
  			             $attributes = array('class' => 'form-horizontal form-validate', 'id' => 'form', 'method' => 'POST', 'novalidate'=>'novalidate','onsubmit'=>'return validate()');
  		    	echo form_open($action,$attributes);
  		    		?>
                    	<table width="100%" border="0">
                      <tr>
                              <th align="left">
                                 <label class="control-label" for="minlengthfield">Unit Bisnis</label>
                                 <div class="control-group">
                                   <div class="controls">:
                                       <?php
                                       $arridcompany="data-rule-required=true id=idcompany onchange='javascript:this.form.submit();'";
                                       echo form_dropdown('idcompany',$idcompany_opt,$this->input->post('idcompany'),$arridcompany);
                                       ?>
                                       <?php //echo  <p id="message"></p> ?>
                                   </div>
                                 </div>
                                </th>
    			                  </tr>
                              <tr>
                                <th align="left">
                                    <label class="control-label" for="minlengthfield">Tanggal</label>
                                    <div class="control-group">
                                        <div class="controls">:
                                                <?php
                                                echo form_input(array('class' => '', 'id' => 'dp1','name'=>'periode1','value'=>$this->session->userdata('periode1'),'data-rule-required'=>'false' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'2' ,'placeholder'=>'DD-MM-YYYY','autocomplete'=>'off'));
                                                echo "&nbsp;".form_input(array('class' => '', 'id' => 'dp2','name'=>'periode2','value'=>$this->session->userdata('periode2'),'data-rule-required'=>'false' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'2' ,'placeholder'=>'DD-MM-YYYY','autocomplete'=>'off'));
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
                                                echo "<th>No Daftar</th>";
                                                echo "<th>Nama</th>";
                                                echo "<th>Tingkat</th>";
                                                echo "<th>Calon Kelas</th>";
                                                //echo "<th>Status Program</th>";
                                                echo "<th>ABK</th>";
                                                echo "<th>Tgl. Daftar</th>";
                                                echo "<th>Jadwal</th>";
                                                echo "<th>Aktif</th>";
                                                //echo "<th>Hasil Pemeriksaan</th>";
                                                echo "<th>Alat Test</th>";
                                                echo "<th>Evaluasi Psikologis</th>";
                                                //echo "<th>Resume Siswa</th>";
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
                          echo "<a href=javascript:void(window.open('".site_url('general/datacalonsiswa/'.$row->replid)."')) >".$row->nopendaftaran."</a>";
                          echo "</td>";
                          echo "<td align=''>".($row->nama)."</td>";
                          echo "<td align=''>".($row->tingkattext)."</td>";
                          echo "<td align=''>".($row->kelastext )."</td>";
                          //echo "<td align=''>".($row->kondisitext)."</td>";
                          echo "<td align=''>".$CI->p_c->cekaktif($row->abk)."</td>";
                          echo "<td align='center'>".($CI->dbx->tanggalbatas($row->tanggal_daftar,$row->lamaproses,0))."</td>";
                          echo "<td align='center'>".$CI->p_c->tgl_indo($row->tgl_mulai)."</td>";
                          echo "<td align=''>".$CI->p_c->cekaktif($row->kegaktif)."</td>";
                          echo "<td align='center'>"; //triall class
                          //if($row->kegaktif){
                            if(($row->idpegawai==$this->session->userdata('idpegawai')) AND ($report<>"1")){
                                echo "<a href=javascript:void(window.open('".site_url('psb_assessment/tambah/2/'.$row->replid.'/'.$row->replidkeg)."')) class='btn btn-xs btn-warning fa fa-check-square' ></a>&nbsp;&nbsp;";
                            }
                          //}else{
                            echo "<a href=javascript:void(window.open('".site_url($action.'/view/2/'.$row->replid.'/'.$row->replidkeg)."')) class='btn btn-xs btn-info fa fa-circle-o' ></a>&nbsp;&nbsp;";
                          //}
                          echo "</td>";
                          echo "<td align='center'>";
                          if($row->observasijml>0){
                            if(($row->idpegawai==$this->session->userdata('idpegawai')) AND ($report<>"1")){
                              echo "<a href=javascript:void(window.open('".site_url('psb_assessment/tambah/4/'.$row->replid.'/'.$row->replidkeg)."')) class='btn btn-xs btn-warning fa fa-check-square' ></a>&nbsp;&nbsp;";
                            }
                            echo "<a href=javascript:void(window.open('".site_url($action.'/view/4/'.$row->replid.'/'.$row->replidkeg)."')) class='btn btn-xs btn-info fa fa-circle-o' ></a>&nbsp;&nbsp;";
                          }else{
                            echo "Alat Test Belum Dipilih";
                          }
                          echo "</td>";
                          /*
                          echo "<td align='center'>";
                          if($row->kegaktif){
                            echo "<a href=javascript:void(window.open('".site_url('psb_assessment/tambah/3/'.$row->replid.'/'.$row->replidkeg)."')) class='btn btn-xs btn-warning fa fa-check-square' ></a>&nbsp;&nbsp;";
                          }else{
                            echo "<a href=javascript:void(window.open('".site_url('psb_assessment/view/3/'.$row->replid.'/'.$row->replidkeg)."')) class='btn btn-xs btn-info fa fa-circle-o' ></a>&nbsp;&nbsp;";
                          }
                          */
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
          echo $CI->dbx->getcalonsiswa($idcalon);
		    	?>
          </table>
          <table width="100%" border="0">
          <?php
            $no=1;
            foreach((array)$observasi as $rowobs) {
              $ns=$rowobs->replid;
              if($rowobs->tipe_form<>1){
                echo "<tr>";
                echo "<td align='left'>";
                echo "<label class='control-label' for='minlengthfield'><b>".$no++.". ".$rowobs->observasi."</b></label>";
                echo "<div class='control-group'>";
                echo "<div class='control'>: ";
              }else{
                echo "<tr>";
                echo "<th align='left'>";
                echo "<label><h4>".$no++.". ".$rowobs->observasi."</h4>";
                if (trim($rowobs->keterangan)<>""){echo "<br/>( ".$rowobs->keterangan." )";}
                echo "</b></label>";

                echo "</th></tr>";
                echo "<tr>";
                echo "<td align='left'>";
                echo "<div class='control-group'>";
                echo "<div class='control'>";
              }

              if (($rowobs->tipe_form == 2)||($rowobs->tipe_form == 5)){
                $arrcomboobservasi=' id="comboobservasi" data-rule-required=true';
                $sql_comboobservasi="SELECT replid,data as nama FROM observasi_data WHERE data_combo='".$rowobs->data_combo."' AND aktif=1 ORDER BY replid";
                $comboobservasi_opt = $CI->dbx->opt($sql_comboobservasi);
                echo form_dropdown("description".$ns,$comboobservasi_opt,$rowobs->description,$arrcomboobservasi);
              }elseif ($rowobs->tipe_form == 3){
                echo form_input(array('class' => '', 'id' => 'description'.$ns,'name'=>'description'.$ns,'value'=>$rowobs->description,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'2' ,'placeholder'=>'Masukkan 2-100 Karakter'));
                if (trim($rowobs->keterangan)<>""){echo "<br/>( <b>".$rowobs->keterangan."<b/> )";}
              }else{
                echo form_textarea(array("rows"=>'7','style' => 'width:400px;', 'id' => 'editor'.$ns,'name'=>'description'.$ns,'value'=>str_replace("<br />", "", $rowobs->description),'data-rule-required'=>'true', 'data-rule-minlength'=>'2' ,'placeholder'=>'Masukkan 2-500 Karakter'));
                //echo "<textarea width='200' rows='3' id='description".$ns."' name='description".$ns."'>".$rowobs->description."</textarea>";
                echo "<script type='text/javascript'>CKEDITOR.replace('editor".$ns."');</script>";
              }

              echo "</div></div></th></tr>";
            }
          ?>
        </table>
        <br/>

            <table width="100%" border="0">
				    <tr>
				            <th align="left">
                      <input type='hidden' name="referencedata" value="<?php echo $rowobs->referencedata;?>">
				            	<button class='btn btn-primary' onclick="return validate()">Simpan</button>
				            	<a href="javascript:void(window.open('<?php echo site_url("psb_assessment") ?>'))" class="btn btn-success">Kembali</a>
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
<script language="javascript">
  function cetakprint() {
    newWindow('<?php echo site_url("psb_assessment/printthis/".$printvar) ?>', 'psb_assessment_print','900','800','resizable=1,scrollbars=1,status=0,toolbar=0')
  }
</script>
            <section class="content-header table-responsive">
	            <h1>
	                <?php echo $form ?>
	                <small><?php echo $form_small ?></small>
	            </h1>
              <ol class="breadcrumb">
                <!--
                  <li><a href="javascript:void(window.open('<?php echo site_url('psb_assessment/tambah'); ?>'))" ><i class="fa fa-plus-square"></i> Tambah</a></li>
                  <li><a href="#"><i class="fa fa-file-excel-o"></i>Excel</a></li>
                -->
                <?php
                if($report<>1){
                  echo "<li><a href='JavaScript:cetakprint()'><i class='fa fa-file-text'></i>&nbsp;Cetak</a></li>";
                }
                ?>
              </ol>
            </section>
            <section class="content">
		        <?php
			        $attributes = array('class' => 'form-horizontal form-validate', 'id' => 'form', 'method' => 'POST', 'novalidate'=>'novalidate','onsubmit'=>'return validate()');
		    	echo form_open($action,$attributes);
          echo $CI->dbx->getcalonsiswa($idcalon);
		    	?>
          <table width="100%" border="0">
          <?php
            $no=1;
            if($tipedata==4){
              if(isset($observasidata5)){
              echo "<tr>";
              echo "<td align='left'>";
                echo "<table class='table table-bordered table-striped'>";
        				echo "<tr>";
        				echo "<th rowspan='2'>NO.</th>";
        				echo "<th rowspan='2'>ASPEK PSIKOLOGIS</th>";
        				echo "<th colspan='".COUNT($observasidata5)."'>KLASIFIKASI</th>";
        				echo "</tr>";
                echo "<tr>";
        				foreach((array)$observasidata5 as $obsdata) {
        					echo "<th align='center'>".$obsdata->data."</th>";
        				}
        				echo "</tr>";
                foreach((array)$observasi5 as $rows5) {
                  echo "<tr>";
        					echo "<td>".$no++."</td>";
        					echo "<td>".$rows5->observasi."</td>";
                  foreach((array)$observasidata5 as $obsdata) {
                    echo "<th align='center'>";
                    if ($obsdata->replid==$rows5->description){
                      echo "X";
                    }
                    //echo $obsdata->replid."-".$rows5->description;
                    echo "</th>";
          				}
                  //echo "<td align='center'>X</td>";
                  echo "<tr>";
                }

                echo "</table>";
              echo "</td></tr>";
              }
            }
            //$no=1;
            $no5=0;
            foreach((array)$observasi as $rowobs) {
              $ns=$rowobs->replid;
              if($rowobs->tipe_form<>"5"){
                if($rowobs->tipe_form<>1){
                  echo "<tr>";
                  echo "<td align='left'>";
                  echo "<label class='control-label' for='minlengthfield'><b>".$no++.". ".$rowobs->observasi."</b></label>";
                  echo "<div class='control-group'>";
                  echo "<div class='control'>: ";
                  //echo $rowobs->tipe_form;
                }else{
                  echo "<tr>";
                  echo "<th align='left'>";
                  echo "<label><b>".$no++.". ".$rowobs->observasi;
                  if (trim($rowobs->keterangan)<>""){echo "<br/>( ".$rowobs->keterangan." )";}
                  echo "</b></label>";

                  echo "</th></tr>";
                  echo "<tr>";
                  echo "<td align='left'>";
                  echo "<div class='control-group'>";
                  echo "<div class='control'>";
                }

                if ($rowobs->tipe_form == 2){
                  $sql_comboobservasi="SELECT replid,data as nama FROM observasi_data WHERE data_combo='".$rowobs->data_combo."' ORDER BY replid";
                  $comboobservasi_opt = $CI->dbx->opt($sql_comboobservasi);
                  if($rowobs->description<>""){
                    echo $comboobservasi_opt[$rowobs->description];
                  }
                }elseif ($rowobs->tipe_form == 3){
                  echo $rowobs->description;
                }else{
                  echo "<p align='justify'>";
                  echo $rowobs->description;
                  echo "</p>";
                }
                echo "</div></div></td></tr>";
              }
            } //tipe_dorm 5
          ?>
        </table>
            <table width="100%" border="0">
				    <tr>
				            <th align="left">
				            	<a href="JavaScript:window.close();" class="btn btn-success">Kembali</a>
				            </th>
				    </tr>
		            </table>
		        	<?php
		        	echo form_close();
		        	?>
	    </section>
<!-------------------------------------------------------------------------------------------------------------------------------------->
<?php } ?>
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
    </body>
</html>
