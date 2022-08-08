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
                        <li><a href="javascript:void(window.open('<?php echo site_url('ns_rapotmapping/tambah'); ?>'))" ><i class="fa fa-plus-square"></i> Tambah</a></li>
                        <!--
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
                         <label class="control-label" for="minlengthfield">Jenjang</label>
                         <div class="control-group">
                           <div class="controls">:
                               <?php
                                 $arriddepartemen='data-rule-required=false onchange=javascript:this.form.submit();';
                                 echo form_dropdown('iddepartemen',$iddepartemen_opt,$this->input->post('iddepartemen'),$arriddepartemen);
                               ?>
                               <?php //echo  <p id="message"></p> ?>
                           </div>
                         </div>
                        </th>
                        <th align="left">
                           <label class="control-label" for="minlengthfield">Kelompok Matpel</label>
                           <div class="control-group">
                             <div class="controls">:
                               <?php
                                 $arridmatpelkelompok="data-rule-required=false id=idmatpelkelompok onchange=javascript:this.form.submit();";
                                 echo form_dropdown('idmatpelkelompok',$idmatpelkelompok_opt,$this->session->userdata('idmatpelkelompok'),$arridmatpelkelompok);
                               ?>
                                 <?php //echo  <p id="message"></p> ?>
                             </div>
                           </div>
                          </th>
                    </tr>
                    <tr>
                      <th align="left">
                         <label class="control-label" for="minlengthfield">Tipe Rapor</label>
                         <div class="control-group">
                           <div class="controls">:
                             <?php
                               $arridrapottipe="data-rule-required=false id=idrapottipe onchange=javascript:this.form.submit();";
                               echo form_dropdown('idrapottipe',$idrapottipe_opt,$this->session->userdata('idrapottipe'),$arridrapottipe);
                             ?>
                               <?php //echo  <p id="message"></p> ?>
                           </div>
                         </div>
                        </th>
                        <th align="left">
                           <label class="control-label" for="minlengthfield">Regional</label>
                           <div class="control-group">
                             <div class="controls">:
                               <?php
                                 $arridregion="data-rule-required=false id=idregion onchange=javascript:this.form.submit();";
                                 echo form_dropdown('idregion',$idregion_opt,$this->session->userdata('idregion'),$arridregion);
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
                                                <th width='50'>No.</th>
                                                <th>Jenjang</th>
                                                <th>Tipe Rapor</th>
                                                <th>Kelompok Matpel</th>
                                                <th>Regional</th>
                                                <th width="80">Persentase (%)</th>
                                                <th>Non Reguler</th>
                                                <th>Aktif</th>
                                                <th width="80">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        	<?php
                                        	$no=1;
											foreach((array)$show_table as $row) {
											    echo "<tr>";
											    echo "<td align='center'>".$no++."</td>";
											    echo "<td align=''><a href=javascript:void(window.open('".site_url('ns_rapotmapping/view/'.$row->replid)."/1')) >".strtoupper($row->iddepartemen)."</a></td>";
                          echo "<td align='center'>".strtoupper($row->rapottipe)."</td>";
                          echo "<td align='center'>".strtoupper($row->matpelkelompok)."</td>";
											    echo "<td align='center'>".strtoupper($row->region)."</td>";
                          echo "<td align='center'>".$row->persentase."</td>";
                          echo "<td align='center'>".($CI->p_c->cekaktif($row->nonreguler))."</td>";
                          echo "<td align='center'>".$CI->p_c->cekaktif($row->aktif)."</td>";
											    echo "<td align='center'>";
											    if (trim($row->created_by)==$this->session->userdata('idpegawai')){
                            if ($row->pakai<1){
  												    //echo "<a href=javascript:void(window.open('".site_url('ns_rapotmapping/penilaian/'.$row->replid)."/0'))>
  												    //			<button class='btn btn-xs btn-info'>Penilaian</button>
  												    //		</a>";
  												    //if ($row->nilaipd<=0){
  													    echo "<a href=javascript:void(window.open('".site_url('ns_rapotmapping/ubah/'.$row->replid)."')) class='btn btn-xs btn-warning fa fa-check-square' ></a>&nbsp;&nbsp;";
  													    echo "<a href=javascript:void(window.open('".site_url('ns_rapotmapping/hapus/'.$row->replid)."')) class='btn btn-danger' id='btnOpenDialog'>Hapus</a>
  													    		</td>";
  												    //}
                            }
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
			        $attributes = array('class' => 'form-horizontal form-validate', 'id' => 'form', 'method' => 'POST', 'novalidate'=>'novalidate');
		    	echo form_open($action,$attributes);
		    	?>
		    	<table width="100%" border="0">
              <!--
                <tr>
		            <th align="left">
		        		<label class="control-label" for="minlengthfield">Departemen</label>
		        		<div class="control-group">
							<div class="controls">:
		                	<?php
		                		$arriddepartemen="data-rule-required=true id=iddepartemen";
		                		echo form_dropdown('iddepartemen',$iddepartemen_opt,$isi->iddepartemen,$arriddepartemen);
		                	?>
		                	<?php //echo  <p id="message"></p> ?>
							</div>
		        		</div>
		            </th></tr>
              -->
              <tr>
              <th align="left">
              <label class="control-label" for="minlengthfield">Tipe Rapor</label>
              <div class="control-group">
            <div class="controls">:
                    <?php
                      $arridrapottipe="data-rule-required=true id=idrapottipe";
                      echo form_dropdown('idrapottipe',$idrapottipe_opt,$isi->idrapottipe,$arridrapottipe);
                    ?>
                    <?php //echo  <p id="message"></p> ?>
            </div>
              </div>
              </th></tr>
              <tr>
              <th align="left">
              <label class="control-label" for="minlengthfield">Kelopok Matpel</label>
              <div class="control-group">
            <div class="controls">:
                    <?php
                      $arridmatpelkelompok="data-rule-required=true id=idmatpelkelompok";
                      echo form_dropdown('idmatpelkelompok',$idmatpelkelompok_opt,$isi->idmatpelkelompok,$arridmatpelkelompok);
                    ?>
                    <?php //echo  <p id="message"></p> ?>
            </div>
              </div>
              </th></tr>
		            <tr>
		            <th align="left">
		        		<label class="control-label" for="minlengthfield">Regional</label>
		        		<div class="control-group">
							<div class="controls">:
		                	<?php
		                		$arridregion="data-rule-required=true id=idregion";
		                		echo form_dropdown('idregion',$idregion_opt,$isi->idregion,$arridregion);
		                	?>
		                	<?php //echo  <p id="message"></p> ?>
							</div>
		        		</div>
		            </th></tr>
                <tr>
    				            <th align="left">
    		                		<label class="control-label" for="minlengthfield">Persentase</label>
    		                		<div class="control-group">
    									<div class="controls">:
    				                	<?php
    				                		echo form_input(array('id' => 'persentase','name'=>'persentase','value'=>$isi->persentase,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'3', 'data-rule-minlength'=>'1','data-rule-number'=>'true','placeholder'=>'Masukkan 1-3 Karakter'));
    				                	?>
    				                	<?php //echo  <p id="message"></p> ?>
    									</div>
    		                		</div>
    				        </th></tr>
                    <tr>
                            <th align="left">
                                <label class="control-label" for="minlengthfield">Non Reguler</label>
                                <div class="control-group">
                                  <div class="controls">:
                    		                	<?php
                    		                		$fcdata=array('name'=>'nonreguler','id'=>'nonreguler','value'=>'1','checked'=>$isi->nonreguler);
                    		                		echo form_checkbox($fcdata);
                    		                	?>
                    		                	<?php //echo  <p id="message"></p> ?>
                    							</div>
                                </div>
                        </th></tr>
				    <tr>
				            <th align="left">
				            	<button class='btn btn-primary'>Simpan</button>
				            	<a href="javascript:void(window.open('<?php echo site_url("ns_rapotmapping") ?>'))" class="btn btn-success">Kembali</a>
				            </th>
				    </tr>
		            </table>
		        	<?php
		        	echo form_close();
		        	?>
	    </section>
<!-------------------------------------------------------------------------------------------------------------------------------------->
<?php } elseif($view=='rapotmapping'){ ?>
	<section class="content">
		<table width="100%" border="0" class="form-horizontal form-validate">
			<tr>
            <th align="left">
        		<label class="control-label" for="minlengthfield">Jenjang</label>
        		<div class="control-group">
					<div class="controls">:
                	<?php
                		echo $isi->iddepartemen;
                	?>
					</div>
        		</div>
            </th></tr>
            <tr>
            <th align="left">
        		<label class="control-label" for="minlengthfield">Regional</label>
        		<div class="control-group">
					<div class="controls">:
                	<?php
                		echo $isi->region;
                	?>
					</div>
        		</div>
            </th></tr>
            <tr>
            <th align="left">
        		<label class="control-label" for="minlengthfield">Kelompok Matpel</label>
        		<div class="control-group">
					<div class="controls">:
                	<?php
                		echo $isi->matpelkelompok;
                	?>
					</div>
        		</div>
            </th></tr>
            <tr>
            <th align="left">
        		<label class="control-label" for="minlengthfield">Persentase (%)</label>
        		<div class="control-group">
					<div class="controls">:
                	<?php
                		echo $isi->persentase;
                	?>
					</div>
        		</div>
            </th></tr>
            <tr>
            <th align="left">
        		<label class="control-label" for="minlengthfield">Tipe Rapormapping</label>
        		<div class="control-group">
					<div class="controls">:
                	<?php
                		echo $isi->rapottipe;
                	?>
					</div>
        		</div>
            </th></tr>
		</table>
		<?php
			        $attributes = array('class' => 'form-horizontal form-validate', 'id' => 'form', 'method' => 'POST', 'novalidate'=>'novalidate');
		    	echo form_open($action,$attributes);
		    	?>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th width='50'>No.</th>
                    <th>Tipe Proses</th>
                    <th>Variabel Proses</th>
                    <th>Sub Variabel Proses</th>
                    <th>%</th>
                </tr>
            </thead>
            <tbody>

            	<?php
            	$no=1;$rsv="";$prosestipe="";
            	foreach((array)$subvariabelproses as $row) {
            		if($rsv<>""){$rsv=$rsv.',';}
            		if(($prosestipe<>$row->prosestipe) and ($prosestipe<>"")){
					    echo "<tr bgcolor='f4f4f4'><td align='center' colspan='5'>&nbsp;</td></tr>";
				    }
            		echo "<tr>";
				    echo "<td align='center'>".$no++."</td>";
				    echo "<td align='left'>".strtoupper($row->prosestipe)."</td>";
				    echo "<td align='left'>".strtoupper($row->prosesvariabel)."</td>";
				    echo "<td align='left'>".strtoupper($row->prosessubvariabel)."</td>";
				    if ($row->nilai<>""){
		         		$nilaisub=$row->nilai;
	         		}else{
		         		$nilaisub=0;
	         		}
				    echo "<td width='100' align='center'><input type='text' name='rsv".$row->replid."' value='".$nilaisub."' style='width:50px;'></td>";
				    echo "</tr>";
				    $prosestipe=$row->prosestipe;
				    $rsv=$rsv.$row->replid;
            	}
				?>

            </tbody>
            <tfoot>
            </tfoot>
        </table>
        <table>
		    <tr>
	            <th align="left">
	            	<input type="hidden" name="rsv" value="<?php echo $rsv ?>">
	            	<?php if ($edit==1){ ?>
	            		<button class='btn btn-primary'>Simpan</button>
	            	<?php } else if (isset($n)){
		            	echo "<a href=javascript:void(window.open('".site_url('ns_rapotmapping/hapusnilai/'.$isi->replid)."')) class='btn btn-xs btn-danger'>Hapus Penilaian</a>";
	            	}else{
		            	 echo "<a href=javascript:void(window.open('".site_url('ns_rapotmapping/ubah/'.$isi->replid)."/1')) class='btn btn-xs btn-warning fa fa-check-square' ></a>&nbsp;&nbsp;";
		            	echo "<a href=javascript:void(window.open('".site_url('ns_rapotmapping/hapus/'.$isi->replid)."')) class='btn btn-xs btn-danger fa fa-minus-square' ></a>";
	            	}
	            	?>
	            	<a href="javascript:void(window.open('<?php echo site_url("ns_rapotmapping") ?>'))" class="btn btn-success">Kembali</a>
	            </th>
		    </tr>
            </table>
        	<?php
        	echo form_close();
        	?>
     </section>
<!-------------------------------------------------------------------------------------------------------------------------------------->
<?php } elseif($view=='rapotpengembangandiri'){ ?>
	<section class="content">
		<table width="100%" border="0" class="form-horizontal form-validate">
			<tr>
            <th align="left">
        		<label class="control-label" for="minlengthfield">Jenjang</label>
        		<div class="control-group">
					<div class="controls">:
                	<?php
                		echo $isi->iddepartemen;
                	?>
					</div>
        		</div>
            </th></tr>
            <tr>
            <th align="left">
        		<label class="control-label" for="minlengthfield">Regional</label>
        		<div class="control-group">
					<div class="controls">:
                	<?php
                		echo $isi->region;
                	?>
					</div>
        		</div>
            </th></tr>
            <tr>
            <th align="left">
        		<label class="control-label" for="minlengthfield">Kelompok Matpel</label>
        		<div class="control-group">
					<div class="controls">:
                	<?php
                		echo $isi->matpelkelompok;
                	?>
					</div>
        		</div>
            </th></tr>
            <tr>
            <th align="left">
        		<label class="control-label" for="minlengthfield">Persentase (%)</label>
        		<div class="control-group">
					<div class="controls">:
                	<?php
                		echo $isi->persentase;
                	?>
					</div>
        		</div>
            </th></tr>
            <tr>
            <th align="left">
        		<label class="control-label" for="minlengthfield">Tipe Rapormapping</label>
        		<div class="control-group">
					<div class="controls">:
                	<?php
                		echo $isi->rapottipe;
                	?>
					</div>
        		</div>
            </th></tr>
		</table>
		<?php
			        $attributes = array('class' => 'form-horizontal form-validate', 'id' => 'form', 'method' => 'POST', 'novalidate'=>'novalidate');
		    	echo form_open($action,$attributes);
		    	?>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th width='50'>No.</th>
                     <th>Tipe Proses</th>
                    <th>Variabel Proses</th>
                    <th>Sub Variabel Proses</th>
                    <th>Pengembangan Diri</th>
                    <th>%</th>
                </tr>
            </thead>
            <tbody>

            	<?php
            	$no=1;$rpd="";$prosessubvariabel="";
            	foreach((array)$pengembangandiri as $row) {
            		if($rpd<>""){$rpd=$rpd.',';}
            		if(($prosessubvariabel<>$row->prosessubvariabel) and ($prosessubvariabel<>"")){
					    echo "<tr bgcolor='f4f4f4'><td align='center' colspan='6'>&nbsp;</td></tr>";
				    }
            		echo "<tr>";
				    echo "<td align='center'>".$no++."</td>";
				    echo "<td align='left'>".strtoupper($row->prosestipe)."</td>";
				    echo "<td align='left'>".strtoupper($row->prosesvariabel)."</td>";
				    echo "<td align='left'>".strtoupper($row->prosessubvariabel)."</td>";
				    echo "<td align='left'>".strtoupper($row->pengembangandirivariabel)."</td>";
				    if ($row->nilai<>""){
		         		$nilaisub=$row->nilai;
	         		}else{
		         		$nilaisub=0;
	         		}
				    echo "<td width='100' align='center'><input type='text' name='rpd".$row->replid."' value='".$nilaisub."' style='width:50px;'></td>";
				    echo "</tr>";
				    $rpd=$rpd.$row->replid;
				    $prosessubvariabel=$row->prosessubvariabel;
            	}
				?>

            </tbody>
            <tfoot>
            </tfoot>
        </table>
        <table>
		    <tr>
	            <th align="left">
	            	<input type="hidden" name="rpd" value="<?php echo $rpd ?>">
	            	<?php if ($edit==1){ ?>
	            		<button class='btn btn-primary'>Simpan</button>
	            	<?php } else if (isset($n)){
		            	echo "<a href=javascript:void(window.open('".site_url('ns_rapotmapping/hapusnilai/'.$isi->replid)."')) class='btn btn-xs btn-danger'>Hapus Penilaian</a>";
	            	}else{
		            	 echo "<a href=javascript:void(window.open('".site_url('ns_rapotmapping/ubah/'.$isi->replid)."/1')) class='btn btn-xs btn-warning fa fa-check-square' ></a>&nbsp;&nbsp;";
		            	echo "<a href=javascript:void(window.open('".site_url('ns_rapotmapping/hapus/'.$isi->replid)."')) class='btn btn-xs btn-danger fa fa-minus-square' ></a>";
	            	}
	            	?>
	            	<a href="javascript:void(window.open('<?php echo site_url("ns_rapotmapping") ?>'))" class="btn btn-success">Kembali</a>
	            </th>
		    </tr>
            </table>
        	<?php
        	echo form_close();
        	?>
     </section>
<!-------------------------------------------------------------------------------------------------------------------------------------->
<?php } elseif($view=='view'){ ?>
	<section class="content">
		<table width="100%" border="0" class="form-horizontal form-validate">
			<tr>
            <th align="left">
        		<label class="control-label" for="minlengthfield">Jenjang</label>
        		<div class="control-group">
					<div class="controls">:
                	<?php
                		echo $isi->iddepartemen;
                	?>
					</div>
        		</div>
            </th></tr>
            <tr>
            <th align="left">
        		<label class="control-label" for="minlengthfield">Regional</label>
        		<div class="control-group">
					<div class="controls">:
                	<?php
                		echo $isi->region;
                	?>
					</div>
        		</div>
            </th></tr>
            <tr>
            <th align="left">
        		<label class="control-label" for="minlengthfield">Kelompok Matpel</label>
        		<div class="control-group">
					<div class="controls">:
                	<?php
                		echo $isi->matpelkelompok;
                	?>
					</div>
        		</div>
            </th></tr>
            <tr>
            <th align="left">
        		<label class="control-label" for="minlengthfield">Persentase (%)</label>
        		<div class="control-group">
					<div class="controls">:
                	<?php
                		echo $isi->persentase;
                	?>
					</div>
        		</div>
            </th></tr>
            <tr>
            <th align="left">
        		<label class="control-label" for="minlengthfield">Tipe Rapormapping</label>
        		<div class="control-group">
					<div class="controls">:
                	<?php
                		echo $isi->rapottipe;
                	?>
					</div>
        		</div>
            </th></tr>
		</table>
		<table class="table table-bordered">
            <thead>
                <tr>
                    <th width='50'>No.</th>
                    <th>Tipe Proses</th>
                    <th>Variabel Proses</th>
                    <th>Sub Variabel Proses</th>
                    <th>Nilai</th>
                </tr>
            </thead>
            <tbody>

            	<?php
            	$no=1;$rsv="";$totrsv=0;
            	foreach((array)$subvariabelproses as $row) {
            		if($rsv<>""){$rsv=$rsv.',';}
            		echo "<tr bgcolor='f4f4f4'>";
				    echo "<td align='center'>".$no++."</td>";
				    echo "<td align='left'>".strtoupper($row->prosestipe)."</td>";
				    echo "<td align='left'>".strtoupper($row->prosesvariabel)."</td>";
				    echo "<td align='left'>".strtoupper($row->prosessubvariabel)."</td>";
				    if ($row->nilai<>""){
		         		$nilaisub=$row->nilai;
	         		}else{
		         		$nilaisub=0;
	         		}
				    echo "<td width='100' align='center'><b>";
				    if ($nilaisub<>0){
	            		echo "<font color='blue' size='+1'>".$nilaisub;
            		}else{
	            		echo "<font color='green' size='+1'>".$nilaisub;
            		}
				    echo "%</b></td>";
				    echo "</tr>";
				    $rsv=$rsv.$row->replid;
				    $totrsv=$totrsv+$nilaisub;


				    echo "<tr>";
				    echo "<td align='center'>&nbsp;</td>";
				    echo "<td align='center' colspan=4>";
				    echo "
						    <table class='table table-bordered'>
					            <thead>
					                <tr>
					                    <th width='50'>No.</th>
					                    <th>Pengembangan Diri</th>
					                    <th>Nilai</th>
					                </tr>
					            </thead>
					            <tbody>
			        ";
			        		$pengembangandiri=$CI->ns_rapotmapping_db->pengembangandirivariabelshow_db($row->replid,$isi->replid);

			            	$nox=1;$rpd="";$totrpd=0;
			            	foreach((array)$pengembangandiri as $rowpd) {
			            		    if($rpd<>""){$rpd=$rpd.',';}
			            		    echo "<tr>";
        							    echo "<td align='center'>".$nox++."</td>";
        							    echo "<td align='left'>".strtoupper($rowpd->pengembangandirivariabel)."</td>";
        							    if ($rowpd->nilai<>""){
        					         		$nilaisub2=$rowpd->nilai;
        				         		}else{
        					         		$nilaisub2=0;
        				         		}
        				         		echo "<td width='100' align='center'><b>";
        								    if ($nilaisub2<>0){
        					            		echo "<font color='blue'>".$nilaisub2;
        				            		}else{
        					            		echo "<font color='green'>".$nilaisub2;
        				            		}
        							    echo "%</b></td>";
        							    echo "</tr>";
							            $rpd=$rpd.$rowpd->replid;
							            $totrpd=$totrpd+$nilaisub2;
			            	}

					echo "</tbody>";
					echo "
					    	<tr>
				            	<td align='right' colspan='2'><b><font>Total Persentase Pengembangan Diri:</font></b>
				            	</td>";
				    if ($totrpd<>100){
		        		echo "<td align='center' bgcolor='red'><b>";
		    		}else{
		        		echo "<td align='center' bgcolor='green'><b>";
		    		}
			        echo $totrpd."%";
			        echo "
			            		</b>
			            	</td>
			        	</tr>
					    ";
					echo "
				           </table>
				          </td>
	            	</tr>
				          ";

		    }
			?>

            </tbody>
            <tfoot>
            	<tr>
	            	<td align="right" colspan="4"><b><font size='+1'>Total :</font></b>
	            	</td>
	            	<?php
		            	if ($totrsv<>100){
			        		echo "<td align='center' bgcolor='red'><b><font size='+1'>";
			    		}else{
			        		echo "<td align='center' bgcolor='green'><b><font size='+1'>";
			    		}

		            echo $totrsv."%";
			        echo "
			            		</font>
			            		</b>
			            	</td>
			        	</tr>
					    ";
					?>
        </table>
        <table>
		    <tr>
	            <th align="left">
	            	<?php
                  if ($isi->pakai<1){
		            	echo "<a href=javascript:void(window.open('".site_url('ns_rapotmapping/ubah/'.$isi->replid)."/1')) class='btn btn-xs btn-warning fa fa-check-square' ></a>&nbsp;&nbsp;";
		            	echo "<a href=javascript:void(window.open('".site_url('ns_rapotmapping/hapus/'.$isi->replid)."')) class='btn btn-xs btn-danger fa fa-minus-square' ></a>";
                  }
	            	?>
	            	<a href="javascript:void(window.open('<?php echo site_url("ns_rapotmapping") ?>'))" class="btn btn-success">Kembali</a>
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
