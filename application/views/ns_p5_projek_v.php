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
                        <li><a href="javascript:void(window.open('<?php echo site_url('ns_p5_projek/tambah'); ?>'))" ><i class="fa fa-plus-square"></i> Tambah</a></li>
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
                                                <th>Unit Bisnis</th>
												<th>Tema</th>
                                                <th>Fase</th>
                                                <th width='300px'>Nama Projek</th>
												<th width='300px'>Tipe Projek</th>
                                                <!--<th>Deskripsi Projek</th>-->
												<th>No. Urut</th>
                                                <th>aktif</th>
												<th>Petugas</th>
                                                <th width="80">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        	<?php
                                        	$CI =& get_instance();$no=1;
											foreach((array)$show_table as $row) {
											    echo "<tr>";
											    echo "<td align='center'>".$no++."</td>";
											    echo "<td align=''>".strtoupper($row->companytext)."</td>";
												echo "<td align=''>".strtoupper($row->tematext)."</td>";
											    echo "<td align=''>".strtoupper($row->fase)."</td>";
                                                echo "<td align=''>".strtoupper($row->projektext)."</td>";
												echo "<td align=''>".strtoupper($row->projektipetext)."</td>";
											    //echo "<td align='center'>".($row->keterangan)."</td>";
												echo "<td align='center'>".($row->nourut)."</td>";
												echo "<td align='center'>";
                          echo "<a href=javascript:void(window.open('".site_url('ns_p5_projek/ubahaktif/'.$row->replid.'/'.!($row->aktif))."'))>".$CI->p_c->cekaktif($row->aktif)."</a>";
                          //$CI->p_c->cekaktif($row->aktif).
                          echo "</td>";echo "<td align='center'>".$CI->dbx->getpegawai($row->created_by,0,1)."</td>";
											    echo "<td align='center'>";
												echo "<a href=javascript:void(window.open('".site_url('ns_p5_projek/view/'.$row->replid)."')) class='btn btn-xs btn-info fa fa-circle-o' ></a>&nbsp;";												
                            //if ($row->pakai<1){
								if($row->created_by == $this->session->userdata('idpegawai')){
  											    		echo "<a href=javascript:void(window.open('".site_url('ns_p5_projek/ubah/'.$row->replid)."')) class='btn btn-xs btn-warning fa fa-check-square' ></a>&nbsp;";
  											    		echo "<a href=javascript:void(window.open('".site_url('ns_p5_projek/hapus/'.$row->replid)."')) class='btn btn-xs btn-danger fa fa-minus-square' ></a>";
								}
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
		    	?>
		    	<table width="100%" border="0">
				<tr>
		            <th align="left">
		        		<label class="control-label" for="minlengthfield">Unit Bisnis</label>
		        		<div class="control-group">
							<div class="controls">:
		                	<?php
		                		$arridcompany='data-rule-required=true';
		                		echo form_dropdown('idcompany',$idcompany_opt,$this->input->post('idcompany'),$arridcompany);
		                	?>
		                	<?php //echo  <p id="message"></p> ?>
							</div>
		        		</div>
		            </th></tr>
                <tr>
		            <th align="left">
		        		<label class="control-label" for="minlengthfield">Tema</label>
		        		<div class="control-group">
							<div class="controls">:
		                	<?php
		                		$arridtema='data-rule-required=true';
		                		echo form_dropdown('idtema',$idtema_opt,$isi->idtema,$arridtema);
		                	?>
		                	<?php //echo  <p id="message"></p> ?>
							</div>
		        		</div>
		            </th></tr>
                    <tr>
		            <th align="left">
		        		<label class="control-label" for="minlengthfield">Fase</label>
		        		<div class="control-group">
							<div class="controls">:
		                	<?php
		                		$arridfase='data-rule-required=true';
		                		echo form_dropdown('fase',$idfase_opt,$isi->fase,$arridfase);
		                	?>
		                	<?php //echo  <p id="message"></p> ?>
							</div>
		        		</div>
		            </th></tr>
		    		<tr>
		            <th align="left">
	                		<label class="control-label" for="minlengthfield">Nama Projek</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		echo form_input(array('class' => '','style'=>'margin: 0px 0px 5px; width: 687px;', 'id' => 'projektext','name'=>'projektext','value'=>$isi->projektext,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'500', 'data-rule-minlength'=>'2' ,'placeholder'=>'Masukkan 5-100 Karakter'));
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th></tr>
						<tr>
		            <th align="left">
		        		<label class="control-label" for="minlengthfield">Tipe Projek</label>
		        		<div class="control-group">
							<div class="controls">:
		                	<?php
		                		$arridprojektipe='data-rule-required=true';
		                		echo form_dropdown('idprojektipe',$idprojektipe_opt,$isi->idprojektipe,$arridprojektipe);
		                	?>
		                	<?php //echo  <p id="message"></p> ?>
							</div>
		        		</div>
		            </th></tr>
		    		<tr>
				            <th align="left">
		                		<label class="control-label" for="minlengthfield">Deskripsi Projek</label>
		                		<div class="control-group">
									<div class="controls" valign="top">&nbsp;&nbsp;
				                	<?php
				                		echo form_textarea(array('class' => '', 'id' => 'keterangan','name'=>'keterangan','value'=>$isi->keterangan,'data-rule-required'=>'false' ,'data-rule-maxlength'=>'500', 'data-rule-minlength'=>'2' ,'placeholder'=>'Masukkan 2-500 Karakter'));
				                	?>
				                	<?php //echo  <p id="message"></p> ?>
									</div>
		                		</div>
				            </th></tr>
					<tr>
					<th align="left">
						<label class="control-label" for="minlengthfield">No. Urut</label>
						<div class="control-group">
							<div class="controls">:
							<?php
								echo form_input(array('id' => 'nourut','name'=>'nourut','value'=>$isi->nourut,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'3', 'data-rule-minlength'=>'1','data-rule-number'=>'true','placeholder'=>'Masukkan 1-3 Karakter'));
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
				            	<a href="javascript:void(window.open('<?php echo site_url("ns_p5_projek") ?>'))" class="btn btn-success">Kembali</a>
				            </th>
				    </tr>
		            </table>
		        	<?php
		        	echo form_close();
		        	?>
	    </section>
<!-------------------------------------------------------------------------------------------------------------------------------------->

<?php } elseif($view=='capaian'){ ?>
    <section class="content-header table-responsive">
	            <h1>
	                <?php echo $form ?>
	                <small><?php echo $form_small ?></small>
	            </h1>
            </section>
            <section class="content form-horizontal form-validate">
		    	<table width="100%" border="0">
                <tr>
		            <th align="left">
		        		<label class="control-label" for="minlengthfield">Tema</label>
		        		<div class="control-group">
							<div class="controls">:
		                	<?php
		                		echo $isi->tematext;
		                	?>
		                	<?php //echo  <p id="message"></p> ?>
							</div>
		        		</div>
		            </th></tr>
                    <tr>
		            <th align="left">
		        		<label class="control-label" for="minlengthfield">Fase</label>
		        		<div class="control-group">
							<div class="controls">:
                            <?php
		                		echo $isi->fase;
		                	?>
		                	
		                	<?php //echo  <p id="message"></p> ?>
							</div>
		        		</div>
		            </th></tr>
		    		<tr>
		            <th align="left">
	                		<label class="control-label" for="minlengthfield">Nama Projek</label>
	                		<div class="control-group">
								<div class="controls">:
                                <?php
                                    echo $isi->projektext;
                                ?>
			                	
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th></tr>
						<tr>
		            <th align="left">
		        		<label class="control-label" for="minlengthfield">Tipe Projek</label>
		        		<div class="control-group">
							<div class="controls">:
                            <?php
		                		echo $isi->projektipetext;
		                	?>
		                	
		                	<?php //echo  <p id="message"></p> ?>
							</div>
		        		</div>
		            </th></tr>
					
		    		<tr>
				            <th align="left">
		                		<label class="control-label" for="minlengthfield">Deskripsi Projek</label>
		                		<div class="control-group">
									<div class="controls" valign="top">:
                    <?php
                      echo $isi->keterangan;
                    ?>
									</div>
		                		</div>
				            </th></tr>
							<tr>
		            <th align="left">
		        		<label class="control-label" for="minlengthfield">No. Urut</label>
		        		<div class="control-group">
							<div class="controls">:
                            <?php
		                		echo $isi->nourut;
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
		                	<?php //echo  <p id="message"></p> ?>
							</div>
		        		</div>
		            </th></tr>
                    </table>
                    <?php
                        $attributes = array('class' => 'form-horizontal form-validate', 'id' => 'form', 'method' => 'POST', 'novalidate'=>'novalidate','onsubmit'=>'return validate()');
                        echo form_open($actionsave,$attributes);
                    ?>
                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th width='50'>No.</th>
                                                <!-- <th>Dimensi</th> -->
                                                <th>Elemen</th>
                                                <th>Sub Elemen</th>
                                                <th>Capaian</th>
                                                <th>Fase</th>
                                                <th>aktif</th>
												<?php if ($stat=='ubah'){ 
												?>
												<td width="50" align='center'><input type="checkbox" onClick="selectallx('idcapaian','selectall')" id="selectall" class="selectall"/></td>
												<?php } ?>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                        	<?php
											$dimensitext="";
                                        	$CI =& get_instance();$no=1;
											foreach((array)$capaian as $row) {
												if ($dimensitext<>$row->dimensitext){
													echo "<tr >";
													echo "<td align='center' colspan='7' style='background:orange !important;'><b>Dimensi: ".($row->dimensitext)."</b></td>";
													echo "</tr>";
												}
											    echo "<tr>";
											    echo "<td align='center'>".$no++."</td>";
											    echo "<td align='left'>".($row->elementext)."</td>";
                                                echo "<td align='left'>".($row->elemen_subtext)."</td>";
											    echo "<td align='left'>".($row->elemen_sub_capaiantext)."</td>";
                                                echo "<td align='center'>".($row->fase)."</td>";
                                                echo "<td align='left'>".$CI->p_c->cekaktif($row->aktifesc)."</td>";
												if ($stat=='ubah'){
													echo "<td align='center'>";
													$datacb = array(
																'name'        => 'idcapaian[]',
																'id'          => 'idcapaian',
																'value'       => $row->replid,
																'checked'     => $row->pakai 
															);
													echo form_checkbox($datacb);
													echo "</td>";
												}else{
													echo "<td align='left'>".$CI->p_c->cekaktif($row->pakai)."</td>";
												}
											    echo "</tr>";

												$dimensitext=$row->dimensitext;
											}
											?>

                                        </tbody>
                                        <tfoot>
                                        </tfoot>
                                    </table>
                                    <table>
				    <tr>
				            <th align="left">
								<?php 
									if ($stat=='ubah'){
										echo "<button class='btn btn-primary' onclick='return validate()'>Simpan</button>";
									}
								?>
				            	<a href="javascript:window.close()" class="btn btn-success">Kembali</a>
				            </th>
				    </tr>
		            </table>
                    <?php
                        echo form_close();
                    ?>
            <section class="content">
            </section>   
<!-------------------------------------------------------------------------------------------------------------------------------------->
<?php } ?>
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
    </body>
</html>
