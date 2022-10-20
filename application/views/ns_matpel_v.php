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
                        <li><a href="javascript:void(window.open('<?php echo site_url('ns_matpel/tambah'); ?>'))" ><i class="fa fa-plus-square"></i> Tambah</a></li>
                        <!--
                        <li><a href="#"><i class="fa fa-file-text"></i>Cetak</a></li>
                        <li><a href="#"><i class="fa fa-file-excel-o"></i>Excel</a></li>
                        -->
                    </ol>
                </section>


                <!-- Main content -->
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
        				                		<label class="control-label" for="minlengthfield">Lokasi Sekolah</label>
                                   <div class="control-group">
                                     <div class="controls">:
                                   <?php
                                     $arridcompany="data-rule-required=true id=idcompany onchange='javascript:this.form.submit();'";
                                     echo form_dropdown('idcompany',$idcompany_opt,$this->input->post('idcompany'),$arridcompany);
                                   ?>
                                   </div>
                                 </div>
                               </th>
    			                  </tr>
                            <tr>
              						       <th align="left">
        				                		<label class="control-label" for="minlengthfield">Tampilan</label>
        				                		<div class="control-group">
                											<div class="controls">:
            						                	<?php
            						                		$arridmatpelkelompok='data-rule-required=false onchange=javascript:this.form.submit();';
            						                		echo form_dropdown('idmatpelkelompok',$idmatpelkelompok_opt,$this->input->post('idmatpelkelompok'),$arridmatpelkelompok);
            						                	?>
            						                	<?php //echo  <p id="message"></p> ?>
                											</div>
              				              </div>
              						         </th>
                                   <th align="left">
          				                		<label class="control-label" for="minlengthfield">Tampilan K13</label>
          				                		<div class="control-group">
                  											<div class="controls">:
              						                	<?php
              						                		$arridmatpelkelompokraport13='data-rule-required=false onchange=javascript:this.form.submit();';
              						                		echo form_dropdown('idmatpelkelompokraport13',$idmatpelkelompok_opt,$this->input->post('idmatpelkelompokraport13'),$arridmatpelkelompokraport13);
              						                	?>
              						                	<?php //echo  <p id="message"></p> ?>
                  											</div>
                				              </div>
                						         </th>
      			                  </tr>
									<tr>
											
							<th align="left">
                                    <label class="control-label" for="minlengthfield">Tipe Predikat</label>
                                    <div class="control-group">
                                      <div class="controls">:
									  <?php
		                		$arridpredikattipe='data-rule-required=false id="idpredikattipe" onchange=javascript:this.form.submit();';
		                		echo form_dropdown('idpredikattipe',$idpredikattipe_opt,$this->input->post('idpredikattipe'),$arridpredikattipe);
		                	?>
                                          <?php //echo  <p id="message"></p> ?>
                                      </div>
                                    </div>
                                   </th>
                                  <th align="left">
                                    <label class="control-label" for="minlengthfield">Status</label>
                                    <div class="control-group">
                                      <div class="controls">:
                                          <?php
                                            $arraktif='data-rule-required=false onchange=javascript:this.form.submit();';
                                            echo form_dropdown('aktif',$aktif_opt,$this->input->post('aktif'),$arraktif);
                                          ?>
                                          <?php //echo  <p id="message"></p> ?>
                                      </div>
                                    </div>
                                   </th>

          			                  </tr>
									  <tr>
									  <th align="left">
      				                		<label class="control-label" for="minlengthfield">Kata Kunci</label>
      				                		<div class="control-group">
              											<div class="controls">:
          						                	<?php
                                               		echo form_input(array('class' => '','style'=>'margin: 0px 0px 5px; width: 300px;', 'id' => 'katakunci','name'=>'katakunci','value'=>$this->input->post('katakunci'),'data-rule-required'=>'false' ,'data-rule-maxlength'=>'500', 'data-rule-minlength'=>'3' ,'placeholder'=>'Masukkan 1-100 Karakter'));
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
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-body table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <?php
                                                echo "<th  width='25'>No.</th>";
                                                echo "<th width='*'>Jenjang</th>";
                                                echo "<th width='100px'>Mata Pelajaran</th>";
                                                echo "<th>KTSP</th>";
                                                echo "<th>K13</th>";
                                                echo "<th>KKM</th>";
												echo "<th>Tipe Predikat</th>";
                                                echo "<th>Keterangan</th>";
                                                echo "<th>No. Urut</th>";
                                                echo "<th>Tampilan</th>";
                                                echo "<th>Lokasi Sekolah</th>";
                                                echo "<th width='*'>aktif</th>";
                                                echo "<th width='80'>Aksi</th>";
                                                ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        	<?php
                                        	$CI =& get_instance();$no=1;
											foreach((array)$show_table as $row) {
											    echo "<tr>";
											    echo "<td align='center'>".$no++."</td>";
											    echo "<td align=''>".strtoupper($row->iddepartemen)."</td>";
                          echo "<td align=''><a href=javascript:void(window.open('".site_url('ns_matpel/tingkat/'.$row->replid)."/0')) >".$row->matpel."</a></td>";
                          echo "<td align=''>";
                              echo "Formula: ".$row->matpelkelompok."<br/>";
                              echo "Tampilan: ".$row->matpelkelompok2."<br/>";
                              echo "Persentase: ".$row->matpelkelompokpersentase."<br/>";
                          echo "</td>";
                          echo "<td align=''>";
                              echo "Tampilan: ".$row->matpelkelompok13."<br/>";
                              echo "Group: ".$row->grouptext."<br/>";
                          echo "</td>";
											    echo "<td align='center'>".strtoupper($row->kkm)."</td>";
												echo "<td align='center'>".strtoupper($row->idpredikattipe)."</td>";
											    echo "<td align='center'>".strtoupper($row->keterangan)."</td>";
											    echo "<td align='center'>".strtoupper($row->no_urut)."</td>";
                          echo "<th>";
                          echo "Absensi :".$CI->p_c->cekaktif($row->absensi);
                          echo "<br/>Hitung Nilai :".$CI->p_c->cekaktif($row->hitungnilai);
                          echo "<br/>Eksternal :".$CI->p_c->cekaktif($row->external);
                          echo "</th>";
                          echo "<td align='center'>".$CI->dbx->variabel_company('ns_matpel',$row->replid)."</td>";
                          echo "<td align='center'>";
											    echo "<a href=javascript:void(window.open('".site_url('ns_matpel/ubahaktif/'.$row->replid.'/'.!($row->aktif))."'))>".$CI->p_c->cekaktif($row->aktif)."</a>";
                          echo "</td>";
											    echo "<td align='center'>";
                          if ($row->pakai<1){
											    		echo "<a href=javascript:void(window.open('".site_url('ns_matpel/ubah/'.$row->replid)."')) class='btn btn-xs btn-warning fa fa-check-square' ></a>&nbsp;&nbsp;";
                          }else{
                            echo "<a href=javascript:void(window.open('".site_url('ns_matpel/tingkat/'.$row->replid."/1")."')) class='btn btn-xs btn-warning fa fa-check-square' ></a>&nbsp;&nbsp;";
                          }
                          if ($row->pakai<1){
											    		echo "<a href=javascript:void(window.open('".site_url('ns_matpel/hapus/'.$row->replid)."')) class='btn btn-xs btn-danger fa fa-minus-square' ></a>";
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
<!-------------------------------------------------------------------------------------------------------------------------------------->
<?php } elseif($view=='tambah'){ ?>
<script type="text/javascript">
  $(function(){
    $.ajaxSetup({
      type:"POST",
      url: "<?php echo site_url('combobox/ambil_data') ?>",
      cache: false,
    });
    $("#iddepartemen").change(function(){
      var value=$(this).val();
      $.ajax({
        data:{modul:'idmatpelkelompok',id:value},
        success: function(respond){
          $("#idmatpelkelompok").html(respond);
        }
      });
      $.ajax({
        data:{modul:'idmatpelkelompok',id:value},
        success: function(respond){
          $("#idmatpelkelompokraport").html(respond);
        }
      });
      $.ajax({
        data:{modul:'idmatpelkelompok',id:value},
        success: function(respond){
          $("#idmatpelkelompokraport13").html(respond);
        }
      });
      $.ajax({
        data:{modul:'idmatpelkelompok',id:value},
        success: function(respond){
          $("#idmatpelkelompokpersentase").html(respond);
        }
      });
      $.ajax({
        data:{modul:'idmatpelkelompok',id:value},
        success: function(respond){
          $("#idgroup").html(respond);
        }
      });
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
		    	?>
		    	<table width="100%" border="0">
		    		<tr>
		            <th align="left">
	                		<label class="control-label" for="minlengthfield">Mata Pelajaran</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		echo form_input(array('class' => '','style'=>'margin: 0px 0px 5px; width: 687px;', 'id' => 'matpel','name'=>'matpel','value'=>$isi->matpel,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'500', 'data-rule-minlength'=>'2' ,'placeholder'=>'Masukkan 5-100 Karakter'));
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th></tr>
			        <tr>
		            <th align="left">
		        		<label class="control-label" for="minlengthfield">Jenjang</label>
		        		<div class="control-group">
							<div class="controls">:
		                	<?php
		                		$arriddepartemen='data-rule-required=true id="iddepartemen"';
		                		echo form_dropdown('iddepartemen',$iddepartemen_opt,$isi->iddepartemen,$arriddepartemen);
		                	?>
		                	<?php //echo  <p id="message"></p> ?>
							</div>
		        		</div>
		            </th></tr>
					<!--
			        <tr>
		            <th align="left">
		        		<label class="control-label" for="minlengthfield">Formula</label>
		        		<div class="control-group">
							<div class="controls">:
		                	<?php
		                		$arridmatpelkelompok='data-rule-required=true id="idmatpelkelompok"';
		                		echo form_dropdown('idmatpelkelompok',$idmatpelkelompok_opt,$isi->idmatpelkelompok,$arridmatpelkelompok);
		                	?>
		                	<?php //echo  <p id="message"></p> ?>
							</div>
		        		</div>
		            </th></tr>
		            <tr>
		            <th align="left">
		        		<label class="control-label" for="minlengthfield">Tampilan</label>
		        		<div class="control-group">
							<div class="controls">:
		                	<?php
		                		$arridmatpelkelompokraport='data-rule-required=true id="idmatpelkelompokraport"';
		                		echo form_dropdown('idmatpelkelompokraport',$idmatpelkelompokraport_opt,$isi->idmatpelkelompokraport,$arridmatpelkelompokraport);
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
		                		$arridmatpelkelompokpersentase='data-rule-required=true id="idmatpelkelompokpersentase"';
		                		echo form_dropdown('idmatpelkelompokpersentase',$idmatpelkelompokpersentase_opt,$isi->idmatpelkelompokpersentase,$arridmatpelkelompokpersentase);
		                	?>
		                	<?php //echo  <p id="message"></p> ?>
							</div>
		        		</div>
		            </th></tr>
					-->
                <tr>
		            <th align="left">
		        		<label class="control-label" for="minlengthfield">Tampilan K13</label>
		        		<div class="control-group">
							<div class="controls">:
								<input type='hidden' name='idmatpelkelompok' id='idmatpelkelompok' value='<?php echo $isi->idmatpelkelompok ?>'>
								<input type='hidden' name='idmatpelkelompokraport' id='idmatpelkelompokraport' value='<?php echo $isi->idmatpelkelompokraport ?>'>
								<input type='hidden' name='idmatpelkelompokpersentase' id='idmatpelkelompokpersentase' value='<?php echo $isi->idmatpelkelompokpersentase ?>'>
		                	<?php
		                		$arridmatpelkelompokraport13='data-rule-required=true id="idmatpelkelompokraport13"';
		                		echo form_dropdown('idmatpelkelompokraport13',$idmatpelkelompokraport_opt,$isi->idmatpelkelompokraport13,$arridmatpelkelompokraport13);
		                	?>
		                	<?php //echo  <p id="message"></p> ?>
							</div>
		        		</div>
		            </th></tr>
		            
                <tr>
		            <th align="left">
		        		<label class="control-label" for="minlengthfield">Group</label>
		        		<div class="control-group">
							<div class="controls">:
		                	<?php
  		                		$arridgroup='data-rule-required=false id="idgroup"';
		                		echo form_dropdown('idgroup',$idmatpelkelompokraport_opt,$isi->idgroup,$arridgroup);
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
								<label class="control-label" for="minlengthfield">Tipe Predikat</label>
								<div class="control-group">
							<div class="controls">:
							<?php
		                		$arridpredikattipe='data-rule-required=true id="idpredikattipe"';
		                		echo form_dropdown('idpredikattipe',$idpredikattipe_opt,$isi->idpredikattipe,$arridpredikattipe);
		                	?>
									<?php //echo  <p id="message"></p> ?>
							</div>
								</div>
                  </th></tr>
		    		<tr>
				            <th align="left">
		                		<label class="control-label" for="minlengthfield">Keterangan</label>
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
				    <tr>
				            <th align="left">
		                		<label class="control-label" for="minlengthfield">No. Urut</label>
		                		<div class="control-group">
									<div class="controls">:
				                	<?php
				                		echo form_input(array('id' => 'no_urut','name'=>'no_urut','value'=>$isi->no_urut,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'3', 'data-rule-minlength'=>'1','data-rule-number'=>'true','placeholder'=>'Masukkan 1-3 Karakter'));
				                	?>
				                	<?php //echo  <p id="message"></p> ?>
									</div>
		                		</div>
				        </th></tr>
                <tr>
    		            <th align="left">
    		        		<label class="control-label" for="minlengthfield">Absensi</label>
    		        		<div class="control-group">
    							<div class="controls">:
    		                	<?php
    		                		echo form_checkbox('absensi', '1', $isi->absensi);
    		                	?>
    		                	<?php //echo  <p id="message"></p> ?>
    							</div>
    		        		</div>
    		            </th></tr>
            <tr>
		            <th align="left">
		        		<label class="control-label" for="minlengthfield">Hitung Nilai</label>
		        		<div class="control-group">
							<div class="controls">:
		                	<?php
		                		echo form_checkbox('hitungnilai', '1', $isi->hitungnilai);
		                	?>
		                	<?php //echo  <p id="message"></p> ?>
							</div>
		        		</div>
		            </th></tr>
          <tr>
              <th align="left">
              <label class="control-label" for="minlengthfield">Eksternal</label>
              <div class="control-group">
            <div class="controls">:
                    <?php
                      echo form_checkbox('external', '1', $isi->external);
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
				            	<a href="javascript:void(window.open('<?php echo site_url("ns_matpel") ?>'))" class="btn btn-success">Kembali</a>
				            </th>
				    </tr>
		            </table>
		        	<?php
		        	echo form_close();
		        	?>
	    </section>
<!-------------------------------------------------------------------------------------------------------------------------------------->
<!-------------------------------------------------------------------------------------------------------------------------------------->
<?php } elseif($view=='tingkat'){ ?>
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
	                		<label class="control-label" for="minlengthfield">Mata Pelajaran</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		echo strtoupper($isi->matpel);
			                	?>
								</div>
	                		</div>
			            </th></tr>
			        <tr>
		            <th align="left">
		        		<label class="control-label" for="minlengthfield">Jenjang</label>
		        		<div class="control-group">
							<div class="controls">:
		                	<?php
		                		echo strtoupper($isi->iddepartemen);
		                	?>

							</div>
		        		</div>
		            </th></tr>
			        <tr>
		            <th align="left">
		        		<label class="control-label" for="minlengthfield">Formula</label>
		        		<div class="control-group">
							<div class="controls">:
		                	<?php
		                		echo strtoupper($isi->matpelkelompok);
		                	?>

							</div>
		        		</div>
		            </th></tr>
		            <tr>
		            <th align="left">
		        		<label class="control-label" for="minlengthfield">Tampilan</label>
		        		<div class="control-group">
							<div class="controls">:
		                	<?php
		                		echo strtoupper($isi->matpelkelompok2);
		                	?>

							</div>
		        		</div>
		            </th></tr>
                <tr>
		            <th align="left">
		        		<label class="control-label" for="minlengthfield">Tampilan K13</label>
		        		<div class="control-group">
							<div class="controls">:
		                	<?php
		                		echo strtoupper($isi->matpelkelompok13);
		                	?>

							</div>
		        		</div>
		            </th></tr>
		            <tr>
		            <th align="left">
		        		<label class="control-label" for="minlengthfield">Persentase</label>
		        		<div class="control-group">
							<div class="controls">:
		                	<?php
		                		echo strtoupper($isi->matpelkelompokpersentase);
		                	?>

							</div>
		        		</div>
		            </th></tr>
                <tr>
		            <th align="left">
		        		<label class="control-label" for="minlengthfield">Grup</label>
		        		<div class="control-group">
							<div class="controls">:
		                	<?php
		                		echo strtoupper($isi->grouptext);
		                	?>

							</div>
		        		</div>
		            </th></tr>
		            <tr>
				            <th align="left">
		                		<label class="control-label" for="minlengthfield">KKM</label>
		                		<div class="control-group">
									<div class="controls">:
				                	<?php
				                		echo strtoupper($isi->kkm);
				                	?>

									</div>
		                		</div>
				        </th></tr>
		    		<tr>
				            <th align="left">
		                		<label class="control-label" for="minlengthfield">Keterangan</label>
		                		<div class="control-group">
									<div class="controls" valign="top">&nbsp;&nbsp;
				                	<?php
				                		echo $isi->keterangan;
				                	?>

									</div>
		                		</div>
				            </th></tr>
				    <tr>
				    <tr>
				            <th align="left">
		                		<label class="control-label" for="minlengthfield">No. Urut</label>
		                		<div class="control-group">
									<div class="controls">:
				                	<?php
				                		echo strtoupper($isi->no_urut);
				                	?>

									</div>
		                		</div>
				        </th></tr>
                <tr>
    		            <th align="left">
    		        		<label class="control-label" for="minlengthfield">Absensi</label>
    		        		<div class="control-group">
    							<div class="controls">:
    		                	<?php
    		                		echo ($CI->p_c->cekaktif($isi->absensi));
    		                	?>

    							</div>
    		        		</div>
    		            </th></tr>
                    <tr>
        		            <th align="left">
        		        		<label class="control-label" for="minlengthfield">Hitung Nilai</label>
        		        		<div class="control-group">
        							<div class="controls">:
        		                	<?php
        		                		echo ($CI->p_c->cekaktif($isi->hitungnilai));
        		                	?>

        							</div>
        		        		</div>
        		            </th></tr>
            <tr>
		            <th align="left">
		        		<label class="control-label" for="minlengthfield">Aktif</label>
		        		<div class="control-group">
							<div class="controls">:
		                	<?php
		                		echo ($CI->p_c->cekaktif($isi->aktif));
		                	?>

							</div>
		        		</div>
		            </th></tr>
		            <tr>
		            <th align="left">
		        		<label class="control-label" for="minlengthfield">Tingkat</label>
		        		<div class="control-group">
		        			<div class="controls">
		        			<?php if ($edit==1){ ?>
			                	<input type="checkbox" onClick="selectallx('idtingkat','selectall')" id="selectall" class="selectall"/> Pilih Semua <hr/>
                      <?php
		                		$CI->p_c->checkbox_one('idtingkat',$idtingkat_opt);
		                		}else{
			                		$CI->p_c->checkbox_one('idtingkat',$idtingkat_opt,'disabled');
		                		}
		                	?>
		                	<?php //echo  <p id="message"></p> ?>
							</div>
		        		</div>
		            </th></tr>
                <tr>
                    <th align="left">
                      <hr/>
                    <label class="control-label" for="minlengthfield">Lokasi Sekolah</label>
                    <div class="control-group">
                  <div class="controls">
                          <?php
                          $CI->p_c->checkbox_more('idcompany',$idcompany_opt,$idreff_company_opt,!$edit);
                          ?>
                  </div>
                    </div>
                    <hr/>
                    </th>
              </tr>
				    <tr>
				            <th align="left">
				            	<?php if ($edit==1){ ?>
					            	<button class='btn btn-primary' onclick="return validate()">Simpan</button>
				            	<?php }else{
                        if ($isi->pakai<1){
				            		echo "<a href=javascript:void(window.open('".site_url('ns_matpel/ubah/'.$isi->replid)."')) class='btn btn-warning' >Ubah</a>&nbsp;&nbsp;";
                        echo "<a href=javascript:void(window.open('".site_url('ns_matpel/hapus/'.$isi->replid)."')) class='btn btn-danger' >Hapus</a>";
                        }
				            	} ?>
				            	<a href="javascript:void(window.open('<?php echo site_url("ns_matpel") ?>'))" class="btn btn-success">Kembali</a>
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
