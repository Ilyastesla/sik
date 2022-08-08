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
                        <li><a href="javascript:void(window.open('<?php echo site_url('psb_interviewcalon/tambah'); ?>'))" ><i class="fa fa-plus-square"></i> Tambah</a></li>
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
                                                echo form_input(array('class' => '', 'id' => 'dp1','name'=>'periode1','value'=>$this->input->post('periode1'),'data-rule-required'=>'false' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'2' ,'placeholder'=>'DD-MM-YYYY','autocomplete'=>'off'));
                                                echo "&nbsp;".form_input(array('class' => '', 'id' => 'dp2','name'=>'periode2','value'=>$this->input->post('periode2'),'data-rule-required'=>'false' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'2' ,'placeholder'=>'DD-MM-YYYY','autocomplete'=>'off'));
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
                          echo "<td align='center'>";
                          //if($row->kegaktif){
                            echo "<a href=javascript:void(window.open('".site_url('psb_interviewcalon/tambah/'.$row->replid.'/'.$row->replidkeg)."')) class='btn btn-xs btn-warning fa fa-check-square' ></a>&nbsp;&nbsp;";
                          //}else{
                            echo "<a href=javascript:void(window.open('".site_url('psb_interviewcalon/view/'.$row->replid.'/'.$row->replidkeg)."')) class='btn btn-xs btn-info fa fa-circle-o' ></a>&nbsp;&nbsp;";
                          //}
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
          <table width="100%" border="0">
          <?php
            $no=1;
            foreach((array)$konseling as $rowkons) {
              $ns=$rowkons->replid;$required="false";
              if($rowkons->required=="1"){$required="true";}

              if ($rowkons->urutan == 255){
                echo "<tr>";
                echo "<th align='left'>";
                echo "<label class='control-label' for='minlengthfield'>".$no++.". ".$rowkons->konseling."</label>";
                echo "<div class='control-group'>";
                echo "<div class='control'>:";
                $arrkelompoksiswa=' id="kelompoksiswa" data-rule-required="'.$required.'"';
                echo form_dropdown("description".$ns,$kelompoksiswa_opt,$rowkons->description,$arrkelompoksiswa);
                echo "</div></div>";
                echo "</th></tr>";
              }elseif ($rowkons->urutan == 254){
                echo "<tr>";
                echo "<th align='left'>";
                echo "<label class='control-label' for='minlengthfield'>".$no++.". ".$rowkons->konseling."</label>";
                echo "<div class='control-group'>";
                echo "<div class='control'>:";
                $arrpeserta=' id="peserta" data-rule-required="'.$required.'"';
                $peserta_opt=array(""=>"Pilih","1"=>"Anak","0"=>"Orangtua dan Anak","2"=>"Placement Test");
                echo form_dropdown("description".$ns,$peserta_opt,$rowkons->description,$arrpeserta);
                echo "</div></div>";
                echo "</th></tr>";
              }elseif (($rowkons->urutan == 253) or ($rowkons->urutan == 252) or ($rowkons->urutan == 251) or ($rowkons->urutan == 250)){
                echo "<tr>";
                echo "<th align='left'>";
                echo "<label class='control-label' for='minlengthfield'>".$no++.". ".$rowkons->konseling."</label>";
                echo "<div class='control-group'>";
                echo "<div class='control'>:";
                echo form_input(array('class' => '', 'id' => 'description'.$ns,'name'=>'description'.$ns,'value'=>$rowkons->description,'data-rule-required'=>$required ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'1' ,'placeholder'=>'Masukkan 2-100 Karakter'));
                echo "</div></div>";
                echo "</th></tr>";
              }else{
                echo "<tr>";
                echo "<th align='left'>";
                echo "<label>".$no++.". ".$rowkons->konseling."</label>";
                if (trim($rowkons->keterangan)<>""){echo "( ".$rowkons->keterangan." )";}
                echo "</th></tr>";
                echo "<tr>";
                echo "<th align='left'>";
                echo "<div class='control-group'>";
                echo "<div class='control'>";
                echo form_textarea(array("rows"=>'7','style' => 'width:400px;', 'id' => 'description'.$ns,'name'=>'description'.$ns,'value'=>str_replace("<br />", "", $rowkons->description),'data-rule-required'=>$required ,'data-rule-maxlength'=>'2000', 'data-rule-minlength'=>'2' ,'placeholder'=>'Masukkan 2-2000 Karakter'));
                //echo "<textarea width='200' rows='3' id='description".$ns."' name='description".$ns."'>".$rowkons->description."</textarea>";
                echo "</div></div>";
                echo "</th></tr>";
              }
            }
          ?>
        </table>
            <table width="100%" border="0">
				    <tr>
				            <th align="left">
				            	<button class='btn btn-primary' onclick="return validate()">Simpan</button>
				            	<a href="javascript:void(window.open('<?php echo site_url("psb_interviewcalon") ?>'))" class="btn btn-success">Kembali</a>
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
    newWindow('<?php echo site_url("psb_interviewcalon/printthis/".$printvar) ?>', 'psb_interviewcalon_print','900','800','resizable=1,scrollbars=1,status=0,toolbar=0')
  }
</script>
<section class="content-header table-responsive">
	            <h1>
	                <?php echo $form ?>
	                <small><?php echo $form_small ?></small>
	            </h1>
              <ol class="breadcrumb">
                <!--
                  <li><a href="javascript:void(window.open('<?php echo site_url('psb_interviewcalon/tambah'); ?>'))" ><i class="fa fa-plus-square"></i> Tambah</a></li>
                  <li><a href="#"><i class="fa fa-file-excel-o"></i>Excel</a></li>
                -->
                <li><a href="JavaScript:cetakprint()"><i class="fa fa-file-text"></i>&nbsp;Cetak</a></li>
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
            foreach((array)$konseling as $rowkons) {
              $ns=$rowkons->replid;
              if ($rowkons->urutan == 255){
                echo "<tr>";
                echo "<th align='left'>";
                echo "<label class='control-label' for='minlengthfield'>".$no++.". ".$rowkons->konseling."</label>";
                echo "<div class='control-group'>";
                echo "<div class='control'>: ";
                if($rowkons->description<>""){
                  echo $kelompoksiswa_opt[$rowkons->description];
                }
                echo "</div></div>";
                echo "</th></tr>";
              }elseif ($rowkons->urutan == 254){
                echo "<tr>";
                echo "<th align='left'>";
                echo "<label class='control-label' for='minlengthfield'>".$no++.". ".$rowkons->konseling."</label>";
                echo "<div class='control-group'>";
                echo "<div class='control'>:";
                if($rowkons->description==1){
                  echo " Anak";
                }else if($rowkons->description==2){
                  echo " Placement Test";
                }else if($rowkons->description==0){
                  echo " Orangtua dan Anak";
                }
                echo "</div></div>";
                echo "</th></tr>";
              }elseif (($rowkons->urutan == 253) or ($rowkons->urutan == 252) or ($rowkons->urutan == 251) or ($rowkons->urutan == 250)){
                echo "<tr>";
                echo "<th align='left'>";
                echo "<label class='control-label' for='minlengthfield'>".$no++.". ".$rowkons->konseling."</label>";
                echo "<div class='control-group'>";
                echo "<div class='control'>: ";
                echo $rowkons->description;
                echo "</div></div>";
                echo "</th></tr>";
              }else{
                echo "<tr>";
                echo "<th align='left'>";
                echo "<label>".$no++.". ".$rowkons->konseling;
                if (trim($rowkons->keterangan)<>""){echo "<br/>( ".$rowkons->keterangan." )";}
                echo "</label>";

                echo "</th></tr>";
                echo "<tr>";
                echo "<th align='left'>";
                echo "<div class='control-group'>";
                echo "<div class='control'><p>";
                echo $rowkons->description;
                echo "</p></div></div>";
                echo "</th></tr>";
              }
            }
          ?>
        </table>
            <table width="100%" border="0">
				    <tr>
				            <th align="left">
				            	<a href="javascript:void(window.open('<?php echo site_url("psb_interviewcalon") ?>'))" class="btn btn-success">Kembali</a>
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
