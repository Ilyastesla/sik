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
                        <li><a href="javascript:void(window.open('<?php echo site_url('ns_p5_projek_penilaian/tambah'); ?>'))" ><i class="fa fa-plus-square"></i> Tambah</a></li>
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
                            <tr>
                                
                <th align="left">
          				                		<label class="control-label" for="minlengthfield">Tahun Pelajaran</label>
          				                		<div class="control-group">
                  											<div class="controls">:
                                          <?php
                                            $arridtahunajaran='data-rule-required=false onchange=javascript:this.form.submit();';
                                            echo form_dropdown('idtahunajaran',$idtahunajaran_opt,$this->input->post('idtahunajaran'),$arridtahunajaran);
                                          ?>
            						                	<?php //echo  <p id="message"></p> ?>
                  											</div>
          				                		</div>
          						            </th>
                                
                              </tr>
                              <tr>
                                
                <th align="left">
          				                		<label class="control-label" for="minlengthfield">Projek</label>
          				                		<div class="control-group">
                  											<div class="controls">:
                                          <?php
                                            $arridprojek='data-rule-required=false onchange=javascript:this.form.submit();';
                                            echo form_dropdown('idprojek',$idprojek_opt,$this->input->post('idprojek'),$arridprojek);
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
                                              echo "<th width='50' >No</th>";
                                              echo "<th>Unit Bisnis</th>";
                                              echo "<th>Departemen</th>";
                                              echo "<th>Tahun Pelajaran</th>";
                                              echo "<th>Tingkat</th>";
                                              echo "<th>Kelas</th>";
                                              echo "<th>Nama Pesdik</th>";
                                              echo "<th>Projek</th>";
                                              echo "<th>Fase</th>";
                                              echo "<th>Petugas</th>";
                                              echo "<th width='100'>Aksi</th>";
                                              ?>
                                          </tr>
                                        </thead>
                                        <tbody>
                                        	<?php
                                        	$CI =& get_instance();$no=1;
											foreach((array)$show_table as $row) {
											    echo "<tr>";
											    echo "<td align='center'>".$no++."</td>";
                          echo "<td align='center'>".strtoupper($row->companytext)."</td>";
                          echo "<td align='center'>".strtoupper($row->iddepartemen)."</td>";
                          echo "<td align='center'>".strtoupper($row->tahunajarantext)."</td>";
                          echo "<td align='center'>".strtoupper($row->tingkattext)."</td>";
                          echo "<td align='center'>".strtoupper($row->kelastext)."</td>";
                          echo "<td align='center'>".strtoupper($row->siswatext)."</td>";
                          echo "<td align='center'>".strtoupper($row->projektext)."</td>";
                          echo "<td align='center'>".strtoupper($row->fase)."</td>";
                          echo "<td align='center'>".$CI->dbx->getpegawai($row->created_by,0,1)."</td>";
											    echo "<td align='center'>";
                          
                          echo "<a href=javascript:void(window.open('".site_url('ns_p5_projek_penilaian/view/'.$row->replid)."')) class='btn btn-xs btn-info fa fa-circle-o' ></a>&nbsp;";
                          if($row->created_by == $this->session->userdata('idpegawai')){
                          echo "<a href=javascript:void(window.open('".site_url('ns_p5_projek_penilaian/tambah/'.$row->replid)."')) class='btn btn-xs btn-warning fa fa-check-square' ></a>&nbsp;";
                          echo "<a href=javascript:void(window.open('".site_url('ns_p5_projek_penilaian/hapus/'.$row->replid)."')) class='btn btn-xs btn-danger fa fa-minus-square' ></a> ";
											    
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

      $("#idcompany").change(function(){
	      var value=$(this).val();
		  	$.ajax({
          data:{modul:'idtahunajarancompany',id:$("#iddepartemen").val(),idcompany:value},
          success: function(respond){
            $("#idtahunajaran").html(respond);
				}
			  });
        $.ajax({
          data:{modul:'idtahunajaranall',id:$("#iddepartemen").val(),idcompany:value},
          success: function(respond){
            $("#idtahunajaranrapot").html(respond);
				}
			  });

        $.ajax({
          data:{modul:'idpredikatspiritual',id:$("#iddepartemen").val()},
          success: function(respond){
            $("#idpredikatspiritual").html(respond);
          }
        });
        
        $.ajax({
          data:{modul:'idtingkat',id:$("#iddepartemen").val()},
          success: function(respond){
            $("#idtingkat").html(respond);
          }
        });

        $.ajax({
          data:{modul:'idkelas',id:-1},
          success: function(respond){
            $("#idkelas").html(respond);
          }
        });
        
        
        $.ajax({
          data:{modul:'idsiswatingkat',id:-1,idtingkat:-1},
          success: function(respond){
            $("#idsiswa").html(respond);
          }
        });

        $.ajax({
          data:{modul:'idprojek',id:-1,idcompany:$("#idcompany").val()},
          success: function(respond){
            $("#idprojek").html(respond);
          }
        });
			
	    });

      $("#iddepartemen").change(function(){
        var value=$(this).val();
        $.ajax({
            data:{modul:'idtahunajarancompany',id:value,idcompany:$("#idcompany").val()},
            success: function(respond){
              $("#idtahunajaran").html(respond);
          }
        });

        $.ajax({
            data:{modul:'idtahunajaranall',id:value,idcompany:$("#idcompany").val()},
            success: function(respond){
              $("#idtahunajaranrapot").html(respond);
          }
        });
        $.ajax({
          data:{modul:'idtingkat',id:$("#iddepartemen").val()},
          success: function(respond){
            $("#idtingkat").html(respond);
          }
        });
        $.ajax({
          data:{modul:'idkelas',id:-1},
          success: function(respond){
            $("#idkelas").html(respond);
          }
        });
        $.ajax({
          data:{modul:'idsiswatingkat',id:-1,idtingkat:-1},
          success: function(respond){
            $("#idsiswa").html(respond);
          }
        });
        $.ajax({
          data:{modul:'idprojek',id:-1,idcompany:$("#idcompany").val()},
          success: function(respond){
            $("#idprojek").html(respond);
          }
        });
    });

    $("#idtahunajaran").change(function(){
      var value=$(this).val();
        $.ajax({
          data:{modul:'idkelas',id:value},
          success: function(respond){
            $("#idkelas").html(respond);
          }
        });
        $.ajax({
          data:{modul:'idsiswatingkat',id:value,idtingkat:$("#idtingkat").val()},
          success: function(respond){
            $("#idsiswa").html(respond);
          }
        });  
    });
    $("#idtingkat").change(function(){
        var value=$(this).val();
        
        $.ajax({
          data:{modul:'idsiswatingkat',id:$("#idtahunajaran").val(),idtingkat:value},
          success: function(respond){
            $("#idsiswa").html(respond);
          }
        });

        $.ajax({
          data:{modul:'idprojek',id:value,idcompany:$("#idcompany").val()},
          success: function(respond){
            $("#idprojek").html(respond);
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
                  <label class="control-label" for="minlengthfield">Unit Bisnis</label>
                  <div class="control-group">
                    <div class="controls">:
                        <?php
                        $arridcompany="data-rule-required='true' id='idcompany' style='width:300px'";
                        echo form_dropdown('idcompany',$idcompany_opt,$isi->idcompany,$arridcompany);
                        ?>
                        <?php //echo  <p id="message"></p> ?>
                    </div>
                  </div>
                </th>
            </tr>
			<tr>
              <th align="left">
              <label class="control-label" for="minlengthfield">Departemen</label>
              <div class="control-group">
            <div class="controls">:
              <?php
                $arriddepartemen="id='iddepartemen' data-rule-required='true' ";
                echo form_dropdown('iddepartemen',$iddepartemen_opt,$isi->iddepartemen,$arriddepartemen);
              ?>
                    <?php //echo  <p id="message"></p> ?>
            </div>
              </div>
              </th></tr>
		            <tr>
		            <th align="left">
		        		<label class="control-label" for="minlengthfield">Tahun Pelajaran</label>
		        		<div class="control-group">
							<div class="controls">:
		                	<?php
		                		$arridtahunajaran="data-rule-required=true id=idtahunajaran";
		                		echo form_dropdown('idtahunajaran',$idtahunajaran_opt,$isi->idtahunajaran,$arridtahunajaran);
		                	?>
		                	<?php //echo  <p id="message"></p> ?>
							</div>
		        		</div>
		            </th></tr>
                <tr>
              <th align="left">
                <label class="control-label" for="minlengthfield">Tingkat</label>
                <div class="control-group">
                    <div class="controls">:
                      <?php
                        $arridtingkat="id='idtingkat' data-rule-required='true' ";
                        echo form_dropdown('idtingkat',$idtingkat_opt,$isi->idtingkat,$arridtingkat);
                      ?>
                            <?php //echo  <p id="message"></p> ?>
                    </div>
                </div>
              </th>
            </tr>
                <!--
                <tr>
		            <th align="left">
		        		<label class="control-label" for="minlengthfield">Kelas</label>
		        		<div class="control-group">
							<div class="controls">:
		                	<?php
		                		$arridkelas="data-rule-required=true id=idkelas";
		                		echo form_dropdown('idkelas',$idkelas_opt,$isi->idkelas,$arridkelas);
		                	?>
		                	<?php //echo  <p id="message"></p> ?>
							</div>
		        		</div>
		            </th></tr>
  -->
                <tr>
		            <th align="left">
		        		<label class="control-label" for="minlengthfield">Nama Pesdik</label>
		        		<div class="control-group">
							<div class="controls">:
		                	<?php
		                		$arridsiswa="data-rule-required=true id=idsiswa";
		                		echo form_dropdown('idsiswa',$idsiswa_opt,$isi->idsiswa,$arridsiswa);
		                	?>
		                	<?php //echo  <p id="message"></p> ?>
							</div>
		        		</div>
		            </th></tr>

                <tr>
		            <th align="left">
		        		<label class="control-label" for="minlengthfield">Projek</label>
		        		<div class="control-group">
							<div class="controls">:
		                	<?php
		                		$arridprojek="data-rule-required=true id=idprojek";
		                		echo form_dropdown('idprojek',$idprojek_opt,$isi->idprojek,$arridprojek);
		                	?>
		                	<?php //echo  <p id="message"></p> ?>
							</div>
		        		</div>
		            </th></tr>
                <tr>
                    <td align="left">
		        		<h4>Catatan Proses</h4>
                    </td>
                    </tr>
                    <tr>
			        	<th>
                            <div class='box-body pad'>
                                    <textarea id="editor1" name="catatanproses" rows="10" cols="80" data-rule-required="true">
                                        <?php echo $isi->catatanproses; ?>
                                    </textarea>
                                    <script type="text/javascript">CKEDITOR.replace('editor1');</script>
                            </div>
                            <?php //echo  <p id="message"></p> ?>
			            </th>
                    </tr>
		    		
				    <tr>
				            <th align="left">
				            	<button class='btn btn-primary' onclick="return validate()">Simpan</button>
				            	<a href="javascript:void(window.open('<?php echo site_url("ns_p5_projek_penilaian") ?>'))" class="btn btn-success">Kembali</a>
				            </th>
				    </tr>
		            </table>
		        	<?php
		        	echo form_close();
		        	?>
	    </section>
<!-------------------------------------------------------------------------------------------------------------------------------------->
<?php } elseif($view=='view'){ ?>
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
              <label class="control-label" for="minlengthfield">Unit Bisnis</label>
              <div class="control-group">
            <div class="controls">:
              <?php
                echo $isi->companytext;
              ?>
            </div>
              </div>
              </th></tr>
            <tr>
              <th align="left">
              <label class="control-label" for="minlengthfield">Departemen</label>
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
                <label class="control-label" for="minlengthfield">Tahun Pelajaran</label>
                <div class="control-group">
                    <div class="controls">:
                      <?php
                        echo $isi->tahunajarantext;
                      ?>
                    </div>
                </div>
              </th>
            </tr>
            <tr>
		            <th align="left">
	                		<label class="control-label" for="minlengthfield">Tingkat</label>
	                		<div class="control-group">
								<div class="controls">:
                  <?php
                    echo $isi->tingkattext." (Fase: ".$isi->fase.")";
                  ?>
								</div>
	                		</div>
			            </th></tr>
            <!--
              <tr>
		            <th align="left">
	                		<label class="control-label" for="minlengthfield">Nama Kelas</label>
	                		<div class="control-group">
								<div class="controls">:
                  <?php
                    echo $isi->kelastext;
                  ?>
								</div>
	                		</div>
			            </th></tr>
-->
                  <tr>
		            <th align="left">
	                		<label class="control-label" for="minlengthfield">Nama Pesdik</label>
	                		<div class="control-group">
								<div class="controls">:
                  <?php
                    echo $isi->siswatext;
                  ?>
								</div>
	                		</div>
			            </th></tr>
                  <tr>
		            <th align="left">
	                		<label class="control-label" for="minlengthfield">Projek</label>
	                		<div class="control-group">
								<div class="controls">:
                  <?php
                    echo $isi->projektext;
                  ?>
								</div>
	                		</div>
			            </th></tr>
                  <tr>
                    <td align="left">
		        		<h4>Catatan Proses</h4>
                    </td>
                    </tr>
                    <tr>
			        	<td align='left'>
                            <div class='box-body pad'>
                                    <?php echo htmlspecialchars_decode($isi->catatanproses); ?>
                            </div>
                            <?php //echo  <p id="message"></p> ?>
			            </td>
                    </tr>
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
												<?php 
                        //if ($stat=='ubah'){ 
                          foreach((array)$idprojekpredikat_opt as $rowprojekpredikat) {
                            echo "<th>".$rowprojekpredikat->nama."</th>";
                          }
                        
                        //} 
                        ?>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                        	<?php
											$dimensitext="";
                                        	$CI =& get_instance();$no=1;
											foreach((array)$capaian as $row) {
												if ($dimensitext<>$row->dimensitext){
													echo "<tr >";
													echo "<td align='center' colspan='".(7+COUNT($idprojekpredikat_opt))."' style='background:orange !important;'><b>Dimensi: ".($row->dimensitext)."</b></td>";
													echo "</tr>";
												}
											    echo "<tr>";
											    echo "<td align='center'>".$no++."</td>";
											    echo "<td align='left'>".($row->elementext)."</td>";
                          echo "<td align='left'>".($row->elemen_subtext)."</td>";
											    echo "<td align='left'>".($row->elemen_sub_capaiantext)."</td>";
                          echo "<td align='center'>".($row->fase)."</td>";
                          echo "<td align='left'>".$CI->p_c->cekaktif($row->aktifesc)."</td>";
												//if ($stat=='ubah'){
													foreach((array)$idprojekpredikat_opt as $rowprojekpredikat) {
                            $datacb = array(
                              'name'        => 'idcapaian['.$row->idcapaian.']',
                              'id'          => 'idcapaian',
                              'value'       => $rowprojekpredikat->replid
                            );
                            if($rowprojekpredikat->replid==$row->idprojekpredikat){
                              $datacb=$CI->p_c->arraymerge(array('checked' => 'yes'), $datacb);
                            }
                            if($stat=='view'){
                              $datacb=$CI->p_c->arraymerge(array('disabled' => 'yes'), $datacb);
                            }
                            echo "<td align='center'>".form_radio($datacb)."</td>";
                          }
													
												//}else{
												//	echo "<td align='left'>".$CI->p_c->cekaktif($row->pakai)."</td>";
												//}
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
                    echo "<input type='hidden' name='idsiswa' value='".$isi->idsiswa."'>";
										echo "<button class='btn btn-primary' onclick='return validate()'>Simpan</button>";
									}else{
                    echo "<a href='".site_url('ns_p5_projek_penilaian/duplikasi/'.$isi->replid)."' class='btn btn-info'>Duplikasi</a>";
                  }
								?>
				            	<a href="javascript:window.close()" class="btn btn-success">Kembali</a>
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
