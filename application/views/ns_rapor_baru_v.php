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
                        <li><a href="javascript:void(window.open('<?php echo site_url('ns_rapor_baru/tambah'); ?>'))" ><i class="fa fa-plus-square"></i> Tambah</a></li>
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
                    <td align="left" width="150">Unit Bisnis</td>
                                <td align="left"><div class="control-group">
                      <?php
                                    $arridcompany="data-rule-required=true id=idcompany onchange='javascript:this.form.submit();'";
                                    echo form_dropdown('idcompany',$idcompany_opt,$this->input->post('idcompany'),$arridcompany);
                                    ?>
                                        <?php //echo  <p id="message"></p> ?>
                                  
                  </div>    </td>
                    <td align="left" width="150">Jenjang</td>
                                <td align="left"><div class="control-group">
                      <?php
                                                      $arriddepartemen='data-rule-required=true onchange=javascript:this.form.submit();';
                                                      echo form_dropdown('iddepartemen',$iddepartemen_opt,$this->input->post('iddepartemen'),$arriddepartemen);
                                                    ?>
                                        <?php //echo  <p id="message"></p> ?>
</div></td>
                        </tr>
	                    <tr>
	                    	<td align="left" width="150">Tahun Pelajaran</td>
				            <td align="left">
                      <div class="control-group">
				            	<?php
			                		$arridtahunajaran="data-rule-required=true id=idtahunajaran  onchange='javascript:this.form.submit();' ";
			                		echo form_dropdown('idtahunajaran',$idtahunajaran_opt,$this->input->post('idtahunajaran'),$arridtahunajaran);
			                	?>
                      </div>
				            </td>
                    <td align="left" width="150">Semester</td>
				            <td align="left">
                      <div class="control-group">
				            	<?php
			                		$arridperiode="data-rule-required=true id=idperiode";
			                		echo form_dropdown('idperiode',$idperiode_opt,$this->input->post('idperiode'),$arridperiode);
			                	?>
                      </div>
				            </td>
			            </tr>
			            <tr>
                    <td align="left" width="150">Kelas</td>
				            <td align="left">
                      <div class="control-group">
				            	<?php
				                		$arridkelas="data-rule-required=false id=idkelas";
				                		echo form_dropdown('idkelas',$idkelas_opt,$this->input->post('idkelas') ,$arridkelas);
				                ?>
                      </div>
				            </td>
                    <td align="left" width="150">Tipe Rapor</td>
				            <td align="left">
                      <div class="control-group">
				            	<?php
		                		$arridrapottipe="data-rule-required=true id=idrapottipe";
		                		echo form_dropdown('idrapottipe',$idrapottipe_opt,$this->input->post('idrapottipe'),$arridrapottipe);
		                	?>
                    </div>
				            </td>
			            </tr>
                  <!--
			            <tr>
                    <td align="left" width="150">Region</td>
				            <td align="left">
				            	<?php
			                		$arridregion="data-rule-required=false id=idregion";
			                		echo form_dropdown('idregion',$idregion_opt,$this->input->post('idregion'),$arridregion);
			                	?>
				            </td>
                    <td align="left" width="150">Petugas</td>
                    <td align="left">
                      <?php
                        $arrcreated_by="data-rule-required=false id=created_by";
                        echo form_dropdown('created_by',$created_by_opt,$this->input->post('created_by'),$arrcreated_by);
                      ?>
                    </td>
			            </tr>
                -->
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
                                                <th>Tahun Pelajaran</th>
                                                <th>Semester</th>
                                                <th>Jenjang</th>
                                                <th>Kelas</th>
                                                <!--<th>Regional</th>
                                                 <th>Non Reguler</th>-->
                                                <th>Nama Pesdik</th>
                                                <th>Tipe Rapor</th>
                                                <th>Tgl. Rapor</th>
                                                <th>Petugas</th>
                                                <th width="130">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        	<?php
                                        	$no=1;
											foreach((array)$show_table as $row) {
                          $urlx="ns_rapor_baru";
                          if($row->k13<>1){
                            $urlx="ns_rapot";
                          }
											    echo "<tr>";
											    echo "<td align='center'>".$no++."</td>";
											    echo "<td align=''>".strtoupper($row->tahunajaran)."</td>";
											    echo "<td align='center'>".strtoupper($row->periode)."</td>";
											    echo "<td align=''>".strtoupper($row->departemen)."</td>";
											    echo "<td align='center'>".strtoupper($row->kelas)."</td>";
											    //echo "<td align='center'>".strtoupper($row->region)."</td>";
                          // echo "<td align='center'>".($CI->p_c->cekaktif($row->nonreguler))."</td>";
											    echo "<td align='center'>".strtoupper($row->namasiswa)."</td>";
											    echo "<td align='center'>".strtoupper($row->rapottipe)."</td>";
											    echo "<td align='center'>".strtoupper($CI->p_c->tgl_indo($row->tanggalkegiatan))."</td>";
                          echo "<td align='center'>".strtoupper(trim($row->created_bytext))."</td>";
											    echo "<td align='center' width='250px'>";
                          if ($row->deletethis<>1){
                            //if ($row->aktiftahunajaran==1){
                              //if (trim($row->created_by)==$this->session->userdata('idpegawai')){
                                if (trim($row->idwali)==$this->session->userdata('idpegawai')){

                                //echo "<a href=javascript:void(window.open('".site_url('ns_rapor_baru/penilaian/'.$row->replid)."/0'))>
                                //			<button class='btn btn-xs btn-info'>Penilaian</button>
                                //		</a>";
                                //if ($row->nilaipd<=0){
                                  echo "<a href=javascript:void(window.open('".site_url($urlx.'/tambah/'.$row->replid)."')) class='btn btn-warning' >Ubah</a>&nbsp;";
                                  echo "<a href=javascript:void(window.open('".site_url($urlx.'/hapus/'.$row->replid)."')) class='btn btn-danger' id='btnOpenDialog' >Hapus</a>&nbsp;<br/>";
                                //}
                              }
                            //}
                            echo "<a href='".site_url($urlx.'/rapot/'.$row->replid)."' target='blank_'><i class='fa fa-file-text'></i>&nbsp;Lihat</a></li> | ";
                            //echo "<a href='".site_url($urlx.'/digitalrapot/'.$row->replid)."' target='blank_'class='btn btn-success' >Digital</a>&nbsp;&nbsp;";
                            //echo "<a href='".site_url($urlx.'/printrapot/'.$row->replid.'/0')."' target='blank_'class='btn btn-primary' >Cetak</a>&nbsp;";
                            //echo "<a href='".site_url($urlx.'/printrapot/'.$row->replid.'/1')."' target='blank_'class='btn btn-primary' >Excel</a>&nbsp;";
                            echo "<a href='".site_url($urlx.'/printrapot/'.$row->replid.'/0')."' target='blank_'><i class='fa fa-print'></i>&nbsp;Cetak</a></li> | ";
                            echo "<a href='".site_url($urlx.'/digitalrapot/'.$row->replid)."' target='blank_'><i class='fa fa-file-pdf-o'></i>&nbsp;Digital</a></li> | ";
                            echo "<a href='".site_url($urlx.'/printrapot/'.$row->replid.'/1')."' target='blank_'><i class='fa fa-file-excel-o'></i>&nbsp;Excel</a></li><br/> ";
                            if($row->k13==1){
                              echo "<a href='".site_url($urlx.'/printrapotavg/'.$row->replid.'/0')."' target='blank_'><i class='fa fa-print'></i>&nbsp;Cetak AVG</a></li> | ";
                              echo "<a href='".site_url($urlx.'/digitalrapotavg/'.$row->replid)."' target='blank_'><i class='fa fa-file-pdf-o'></i>&nbsp;Digital AVG</a></li> | ";
                              echo "<a href='".site_url($urlx.'/printrapotavg/'.$row->replid.'/1')."' target='blank_'><i class='fa fa-file-excel-o'></i>&nbsp;Excel AVG</a></li> ";
                            }
                          }else{
														echo "<div style='background-color:red;text-align:center;'><b>Data Telah Dihapus</b></div>";
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
          data:{modul:'idpredikatsosial',id:$("#iddepartemen").val()},
          success: function(respond){
            $("#idpredikatsosial").html(respond);
          }
        });

        $.ajax({
          data:{modul:'idrapottipe13',id:0,idcompany:0},
          success: function(respond){
            $("#idrapottipe").html(respond);
          }
        }); 

        $.ajax({
          data:{modul:'idkelas',id:-1},
          success: function(respond){
            $("#idkelas").html(respond);
          }
        });
        
        
        $.ajax({
          data:{modul:'idsiswa',id:-1},
          success: function(respond){
            $("#idsiswa").html(respond);
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
          data:{modul:'idpredikatspiritual',id:value},
          success: function(respond){
            $("#idpredikatspiritual").html(respond);
          }
        });

        $.ajax({
          data:{modul:'idpredikatsosial',id:value},
          success: function(respond){
            $("#idpredikatsosial").html(respond);
          }
        });

        $.ajax({
          data:{modul:'idrapottipe13',id:0,idcompany:0},
          success: function(respond){
            $("#idrapottipe").html(respond);
          }
        }); 

        $.ajax({
          data:{modul:'idkelas',id:-1},
          success: function(respond){
            $("#idkelas").html(respond);
          }
        });
        $.ajax({
          data:{modul:'idsiswa',id:-1},
          success: function(respond){
            $("#idsiswa").html(respond);
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
          data:{modul:'idsiswa',id:-1},
          success: function(respond){
            $("#idsiswa").html(respond);
          }
        }); 
        $.ajax({
          data:{modul:'idrapottipe13',id:0,idcompany:0},
          success: function(respond){
            $("#idrapottipe").html(respond);
          }
        }); 
    });

    $("#idkelas").change(function(){
        var value=$(this).val();
        $.ajax({
          data:{modul:'idsiswa',id:value},
          success: function(respond){
            $("#idsiswa").html(respond);
          }
        });
        $.ajax({
          data:{modul:'idrapottipe13',id:value,idcompany:$("#idcompany").val()},
          success: function(respond){
            $("#idrapottipe").html(respond);
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
          <?php if($indeks=="1"){
            $attributes = array('class' => 'form-horizontal form-validate', 'id' => 'form', 'method' => 'POST', 'novalidate'=>'novalidate');
            echo form_open($action,$attributes);
          ?>
            <table width="100%" border="0">
            <tr>
              <th align="left">
                  <label class="control-label" for="minlengthfield">Unit Bisnis</label>
                  <div class="control-group">
                    <div class="controls">:
                        <?php
                        $arridcompany="data-rule-required=true id=idcompany";
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
		        		<label class="control-label" for="minlengthfield">Semester</label>
		        		<div class="control-group">
							<div class="controls">:
		                	<?php
		                		$arridperiode="data-rule-required=true id=idperiode";
		                		echo form_dropdown('idperiode',$idperiode_opt,$isi->idperiode,$arridperiode);
		                	?>
		                	<?php //echo  <p id="message"></p> ?>
							</div>
		        		</div>
		            </th></tr>
                <!--
                <tr>
		            <th align="left">
		        		<label class="control-label" for="minlengthfield">Modul/Tema</label>
		        		<div class="control-group">
							<div class="controls">:
		                	<?php
		                		$arridmodultipe="data-rule-required=false id=idmodultipe";
		                		echo form_dropdown('idmodultipe',$idmodultipe_opt,$isi->idmodultipe,$arridmodultipe);
		                	?>
		                	<?php //echo  <p id="message"></p> ?>
							</div>
		        		</div>
		            </th></tr>
              -->
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
                <!--
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
                              <label class="control-label" for="minlengthfield">Tgl. Rapor</label>
                              <div class="control-group">
                        <div class="controls">:
                                <?php
                                  echo form_input(array('class' => '', 'id' => 'dp1','name'=>'tanggalkegiatan','value'=>$CI->p_c->tgl_form($isi->tanggalkegiatan),'data-rule-required'=>'false' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'2' ,'placeholder'=>'DD-MM-YYYY','autocomplete'=>'off'));
                                ?>
                                <?php //echo  <p id="message"></p> ?>
                        </div>
                              </div>
                          </th>
                       </tr>
                  </table>
                  <table>
      				    <tr>
      				            <th align="left">
      				            	<button class='btn btn-primary'>Simpan</button>
      				            	<a href="javascript:void(window.open('<?php echo site_url("ns_rapor_baru") ?>'))" class="btn btn-success">Kembali</a>
      				            </th>
      				    </tr>

      		        </table>
                  <?php
                  echo form_close();
                  } else if ($indeks=="2"){
                    echo '<h4 align="left">Pengaturan Opsional</h4>';
                    if ($rapotsetting->prestasi=="1"){
                      $attributes = array('class' => 'form-horizontal form-validate', 'id' => 'form', 'method' => 'POST', 'novalidate'=>'novalidate');
                      echo form_open($actionprestasi,$attributes);
                      ?>
                      <section class="content-header table-responsive">
                        <h4 align="left">Prestasi</h4>
                        <table>
                        <tr>
                          <th align="left">
                                        <?php
                                          echo form_input(array('id' => 'jeniskegiatan','name'=>'jeniskegiatan','value'=>'','data-rule-required'=>'false' ,'data-rule-maxlength'=>'1000', 'data-rule-minlength'=>'1','placeholder'=>'Jenis Kegiatan'));
                                          echo "&nbsp;".form_input(array('id' => 'prestasi','name'=>'prestasi','value'=>'','data-rule-required'=>'false' ,'data-rule-maxlength'=>'1000', 'data-rule-minlength'=>'1','placeholder'=>'Prestasi','style'=>'width:400px'));
                                        ?>
                                        <button class='btn btn-primary'>Simpan</button>&nbsp;&nbsp;
                          </th>
                      </tr>
                      </table>
                      </section>
                    <?php echo form_close(); ?>
                          <table class="table table-bordered table-striped">
                            <tr>
                                <?php
                                echo "<th width='50'>No.</th>";
                                echo "<th width='30%'>Jenis Kegiatan</th>";
                                echo "<th>Prestasi</th>";
                                echo "<th width='20px'>Hapus</th>";
                                ?>
                            </tr>
                            <?php
                            $noprestasi=1;
                            foreach((array)$prestasirapot as $rowprestasi) {
                              echo "<tr>";
                              echo "<td>".$noprestasi++."</td>";
                              echo "<td>".$rowprestasi->jeniskegiatan."</td>";
                              echo "<td>".$rowprestasi->prestasi."</td>";
                              echo "<td>";
                              echo "<a href=javascript:void(window.open('".site_url('ns_rapor_baru/hapusprestasi/'.$rowprestasi->replid)."')) class='btn btn-danger btn-xs fa fa-minus' ></a>&nbsp";
                              echo "</td>";
                              echo "</tr>";
                            }
                            echo "<tr>";
                            echo "<td>&nbsp;</td>";
                            echo "<td>&nbsp;</td>";
                            echo "<td>&nbsp;</td>";
                            echo "<td>&nbsp;</td>";
                            echo "</tr>";
                            ?>
                          </table>

                      <hr style="border-top:1px solid black !important;" />
                <?php }if ($rapotsetting->nonakademik<>"1"){
                      $attributes = array('class' => 'form-horizontal form-validate', 'id' => 'form', 'method' => 'POST', 'novalidate'=>'novalidate');
                      echo form_open($actionekstrakurikuler,$attributes);
                      ?>
                      <section class="content-header table-responsive">
                        <h4 align="left">Ekstrakurikuler</h4>
                        <table>
                        <tr>
                          <th align="left">
                                        <?php
                                          echo form_input(array('id' => 'kegiatanekstrakurikuler','name'=>'kegiatanekstrakurikuler','value'=>'','data-rule-required'=>'false' ,'data-rule-maxlength'=>'1000', 'data-rule-minlength'=>'1','placeholder'=>'Kegiatan Ekstrakurikuler'));
                                          echo form_dropdown('predikatekstrakurikuler',$predikat_eksul_opt,'','');
                                          echo "&nbsp;".form_input(array('id' => 'deskripsiekstrakurikuler','name'=>'deskripsiekstrakurikuler','value'=>'','data-rule-required'=>'false' ,'data-rule-maxlength'=>'1000', 'data-rule-minlength'=>'1','placeholder'=>'Deskripsi','style'=>'width:400px'));
                                        ?>
                                        <button class='btn btn-primary'>Simpan</button>&nbsp;&nbsp;
                          </th>
                      </tr>
                      </table>
                      </section>
                    <?php echo form_close(); ?>
                          <table class="table table-bordered table-striped">
                            <tr>
                                <?php
                                echo "<th width='50'>No.</th>";
                                echo "<th width='30%'>Kegiatan Ekstrakurikuler</th>";
                                echo "<th>Predikat</th>";
                                echo "<th>Deskripsi</th>";
                                echo "<th width='20px'>Hapus</th>";
                                ?>
                            </tr>
                            <?php
                            $noekstrakurikuler=1;
                            foreach((array)$ekstrakurikulerrapot as $rowekstrakurikuler) {
                              echo "<tr>";
                              echo "<td>".$noekstrakurikuler++."</td>";
                              echo "<td>".$rowekstrakurikuler->kegiatanekstrakurikuler."</td>";
                              echo "<td>".$rowekstrakurikuler->predikatekstrakurikuler."</td>";
                              echo "<td>".$rowekstrakurikuler->deskripsiekstrakurikuler."</td>";
                              echo "<td>";
                              echo "<a href=javascript:void(window.open('".site_url('ns_rapor_baru/hapusekstrakurikuler/'.$rowekstrakurikuler->replid)."')) class='btn btn-danger btn-xs fa fa-minus' ></a>&nbsp";
                              echo "</td>";
                              echo "</tr>";
                            }
                            echo "<tr>";
                            echo "<td>&nbsp;</td>";
                            echo "<td>&nbsp;</td>";
                            echo "<td>&nbsp;</td>";
                            echo "<td>&nbsp;</td>";
                            echo "</tr>";
                            ?>
                          </table>

                      <hr style="border-top:1px solid black !important;" />
                <?php }

                  $attributes = array('class' => 'form-horizontal form-validate', 'id' => 'form', 'method' => 'POST', 'novalidate'=>'novalidate');
    		    	    echo form_open($action,$attributes);
                  echo "<table width='100%' border='0'>";
                  ?>
                     <tr>
    		            <th align="left">
    	                		<label class="control-label" for="minlengthfield">Kegiatan External Siswa</label>
    	                		<div class="control-group">
    								<div class="controls">:
    			                	<?php
    			                		echo form_input(array('class' => '', 'id' => 'external','name'=>'external','value'=>$isi->external,'style'=>'width:500px','data-rule-required'=>'false' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'2' ,'placeholder'=>'Masukkan 2-100 Karakter'));
    			                	?>
    			                	<?php //echo  <p id="message"></p> ?>
    								</div>
    	                		</div>
    			     </th></tr>
               <!--
               <tr>
                 <th align="left">
               <label class="control-label" for="minlengthfield">Tampilkan Nilai Akhir</label>
               <div class="control-group">
             <div class="controls">:
                     <?php
                       $fcdata=array('name'=>'tampilna','id'=>'tampilna','value'=>'1','checked'=>$isi->tampilna);
                       echo form_checkbox($fcdata);
                     ?>
                     <?php //echo  <p id="message"></p> ?>
             </div>
               </div>
               </th></tr>
                    -->
                    
                       <tr>
                       <th align="left">
                       <label class="control-label" for="minlengthfield">Tahun Pelajaran Non Reguler</label>
                       <div class="control-group">
                     <div class="controls">:
                             <?php
                               $arridtahunajaranrapot="id=idtahunajaranrapot";
                               echo form_dropdown('idtahunajaranrapot',$idtahunajaranrapot_opt,$isi->idtahunajaranrapot,$arridtahunajaranrapot);
                             ?>
                             <?php //echo  <p id="message"></p> ?>
                     </div>
                       </div>
                       </th></tr>
                       <tr>
                       <th align="left">
                       <label class="control-label" for="minlengthfield">Kenaikan Kelas</label>
                       <div class="control-group">
                     <div class="controls">:
                             <?php
                               $arridnaikkelas="id=idnaikkelas";
                               echo form_dropdown('idnaikkelas',$idnaikkelas_opt,$isi->idnaikkelas,$arridnaikkelas);
                             ?>
                             <?php //echo  <p id="message"></p> ?>
                     </div>
                       </div>
                       </th></tr>
                       <tr>
                       <th align="left">
                       <label class="control-label" for="minlengthfield">Naik/Tetap di Tingkat</label>
                       <div class="control-group">
                     <div class="controls">:
                             <?php
                               $arridnaiktingkat="id=idnaiktingkat";
                               echo form_dropdown('idnaiktingkat',$idnaiktingkat_opt,$isi->idnaiktingkat,$arridnaiktingkat);
                             ?>
                             <?php //echo  <p id="message"></p> ?>
                     </div>
                       </div>
                       </th></tr>
                       <tr>
        		            <th align="left">
        	                		<label class="control-label" for="minlengthfield">Nomor Dokumen</label>
        	                		<div class="control-group">
        								<div class="controls">:
        			                	<?php
        			                		echo form_input(array('class' => '', 'id' => 'nomordokumen','name'=>'nomordokumen','value'=>$isi->nomordokumen,'style'=>'width:500px','data-rule-required'=>'false' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'2' ,'placeholder'=>'Masukkan 2-100 Karakter'));
        			                	?>
        			                	<?php //echo  <p id="message"></p> ?>
        								</div>
        	                		</div>
        			            </th></tr>
                    <?php
                  if ($rapotsetting->sikap=="1"){ ?>
                    <tr>
                        <th align="left">
                          <label class="control-label" for="minlengthfield">Sikap Spiritual</label>
                          <div class="control-group">
                          <div class="controls">:
                                <?php
                                  $arridpredikatspiritual="data-rule-required=true id=idpredikatspiritual";
                                  echo form_dropdown('idpredikatspiritual',$idpredikatspiritual_opt,$isi->idpredikatspiritual,$arridpredikatspiritual);
                                ?>
                                <?php //echo  <p id="message"></p> ?>
                          </div>
                          </div>
                        </th>
                    </tr>
                    <tr>
            		            <th align="left">
                            		<label class="control-label" for="minlengthfield">Komentar Spiritual</label>
                            		<div class="control-group">
            							<div class="controls" valign="top">:
                            <?php
                              echo form_textarea(array('class' => '', 'id' => 'spiritualtext','name'=>'spiritualtext','value'=>$isi->spiritualtext,'data-rule-required'=>'false' ,'data-rule-maxlength'=>'500', 'data-rule-minlength'=>'2' ,'placeholder'=>'Masukkan 2-500 Karakter'));
                            ?>

            							</div>
                            		</div>
            		            </th></tr>
                    <tr>
                      <th align="left">
                        <label class="control-label" for="minlengthfield">Sikap Sosial</label>
                        <div class="control-group">
                            <div class="controls">:
                                    <?php
                                      $arridpredikatsosial="data-rule-required=true id=idpredikatsosial";
                                      echo form_dropdown('idpredikatsosial',$idpredikatsosial_opt,$isi->idpredikatsosial,$arridpredikatsosial);
                                    ?>
                                    <?php //echo  <p id="message"></p> ?>
                            </div>
                        </div>
                      </th>
                    </tr>
                    <tr>
            		            <th align="left">
                            		<label class="control-label" for="minlengthfield">Komentar Sosial</label>
                            		<div class="control-group">
            							<div class="controls" valign="top">:
                            <?php
                              echo form_textarea(array('class' => '', 'id' => 'sosialtext','name'=>'sosialtext','value'=>$isi->sosialtext,'data-rule-required'=>'false' ,'data-rule-maxlength'=>'500', 'data-rule-minlength'=>'2' ,'placeholder'=>'Masukkan 2-500 Karakter'));
                            ?>
            							</div>
                            		</div>
            		            </th></tr>
                  <?php } ?>
                  <?php if ($rapotsetting->catatan_wk=="1"){ ?>
                 <tr>
     				            <th align="left">
     		                		<label class="control-label" for="minlengthfield">Catatan Wali Kelas</label>
     		                		<div class="control-group">
     									<div class="controls" valign="top">&nbsp;&nbsp;
     				                	<?php
     				                		echo form_textarea(array('class' => '', 'id' => 'keterangan','name'=>'keterangan','value'=>$isi->keterangan,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'500', 'data-rule-minlength'=>'2' ,'placeholder'=>'Masukkan 2-500 Karakter'));
     				                	?>
     				                	<?php //echo  <p id="message"></p> ?>
     									</div>
     		                		</div>
     				            </th></tr>
                    <?php } ?>
                    <?php if ($rapotsetting->fisik=="1"){ ?>
                      <tr>
      		              <th align="left">
      		                      <label class="control-label" for="minlengthfield">Tinggi Badan</label>
      		                      <div class="control-group">
      		                    <div class="controls">:
      		                            <?php
      		                              echo form_input(array('id' => 'tinggi','name'=>'tinggi','value'=>$isi->tinggi,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'5', 'data-rule-minlength'=>'1','data-rule-number'=>'true','placeholder'=>'Masukkan 1-5 Karakter'));
      		                            ?>
      		                    </div>
      		                      </div>
      		              </th>
      		            </tr>
                      <tr>
      		              <th align="left">
      		                      <label class="control-label" for="minlengthfield">Berat Badan</label>
      		                      <div class="control-group">
      		                    <div class="controls">:
      		                            <?php
      		                              echo form_input(array('id' => 'berat','name'=>'berat','value'=>$isi->berat,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'3', 'data-rule-minlength'=>'1','data-rule-number'=>'true','placeholder'=>'Masukkan 1-3 Karakter'));
      		                            ?>
      		                    </div>
      		                      </div>
      		              </th>
      		            </tr>
                    <?php } ?>
                    <?php if ($rapotsetting->kesehatan=="1"){ ?>
                      <tr>
      		              <th align="left">
      		                      <label class="control-label" for="minlengthfield">Pendengaran</label>
      		                      <div class="control-group">
      		                    <div class="controls">:
      		                            <?php
      		                              echo form_input(array('id' => 'pendengaran','name'=>'pendengaran','value'=>$isi->pendengaran,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'1','placeholder'=>'Masukkan 1-100 Karakter'));
      		                            ?>
      		                    </div>
      		                      </div>
      		              </th>
      		            </tr>
                      <tr>
      		              <th align="left">
      		                      <label class="control-label" for="minlengthfield">Penglihatan</label>
      		                      <div class="control-group">
      		                    <div class="controls">:
      		                            <?php
      		                              echo form_input(array('id' => 'penglihatan','name'=>'penglihatan','value'=>$isi->penglihatan,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'1','placeholder'=>'Masukkan 1-100 Karakter'));
      		                            ?>
      		                    </div>
      		                      </div>
      		              </th>
      		            </tr>
                      <tr>
      		              <th align="left">
      		                      <label class="control-label" for="minlengthfield">Gigi</label>
      		                      <div class="control-group">
      		                    <div class="controls">:
      		                            <?php
      		                              echo form_input(array('id' => 'gigi','name'=>'gigi','value'=>$isi->gigi,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'1','placeholder'=>'Masukkan 1-100 Karakter'));
      		                            ?>
      		                    </div>
      		                      </div>
      		              </th>
      		            </tr>
                  <?php } ?>
                  </table>
                  <?php if ($rapotsetting->matpeldeskripsi=="1"){ ?>
                    <hr style="border-top:1px solid black !important;" />
                    <table class="table table-bordered table-striped">
                      <tr>
                          <?php
                          //echo "<th colspan='3'>Hanya akan ditampilkan apabila tabel penilaian di gabung</th>";
                          echo "<th colspan='3'>Deskripsi tambahan dari tutor:</th>";
                          ?>
                      </tr>
                      <tr>
                          <?php
                          echo "<th width='50'>No.</th>";
                          echo "<th width='30%'>Mata Pelajaran</th>";
                          echo "<th>Deskripsi</th>";
                          ?>
                      </tr>
                      <?php
                      $noprestasi=1;
                      foreach((array)$datamatpeldesc as $rowmatpeldesc) {
                        echo "<tr>";
                        echo "<td>".$noprestasi++."</td>";
                        echo "<td align='left'>".$rowmatpeldesc->matpel."</td>";
                        echo "<td align='left'>";
                          echo form_textarea(array('class' => '', 'id' => 'matpeldesc['.$rowmatpeldesc->replid.']','name'=>'matpeldesc['.$rowmatpeldesc->replid.']','value'=>$rowmatpeldesc->matpeldeskripsi,'data-rule-required'=>'false' ,'data-rule-maxlength'=>'500', 'data-rule-minlength'=>'2' ,'placeholder'=>'Masukkan 2-500 Karakter'));
                        echo "</td>";
                        echo "</tr>";
                      }
                      ?>
                    </table>
                  <?php } ?>
                    <table>
                    <tr>
                            <th align="left">
                              <button class='btn btn-primary'>Simpan</button>
                              <a href="javascript:void(window.open('<?php echo site_url("ns_rapor_baru") ?>'))" class="btn btn-success">Kembali</a>
                            </th>
                    </tr>
                        </table>
            <?php }
		        	echo form_close();
		        	?>
	    </section>
<!-------------------------------------------------------------------------------------------------------------------------------------->
<?php } elseif($view=='rapot'){ ?>
  <script language="javascript">
  function cetakprint() {
  	newWindow('<?php echo site_url("ns_rapor_baru/printrapot/".$isi->replid."/0")?>', 'cetakrapot','900','800','resizable=1,scrollbars=1,status=0,toolbar=0')
  }
  function cetakdigital() {
  	newWindow('<?php echo site_url("ns_rapor_baru/digitalrapot/".$isi->replid)?>', 'cetakrapot','900','800','resizable=1,scrollbars=1,status=0,toolbar=0')
  }

  function cetakprintavg() {
  	newWindow('<?php echo site_url("ns_rapor_baru/printrapotavg/".$isi->replid)?>', 'cetakrapot','900','800','resizable=1,scrollbars=1,status=0,toolbar=0')
  }
  function cetakdigitalavg() {
  	newWindow('<?php echo site_url("ns_rapor_baru/digitalrapotavg/".$isi->replid)?>', 'cetakrapot','900','800','resizable=1,scrollbars=1,status=0,toolbar=0')
  }
  
  
  function cetakexcel() {
  	newWindow('<?php echo site_url("ns_rapor_baru/printrapot/".$isi->replid."/1")?>', 'cetakrapot','900','800','resizable=1,scrollbars=1,status=0,toolbar=0')
  }
  function cetakexcelavg() {
  	newWindow('<?php echo site_url("ns_rapor_baru/printrapotavg/".$isi->replid."/1")?>', 'cetakrapot','900','800','resizable=1,scrollbars=1,status=0,toolbar=0')
  }

  </script>
    <section class="content-header table-responsive">
      <h1>
          <?php echo $form ?>
          <small><?php echo $form_small ?></small>
      </h1>
  		<ol class="breadcrumb">
        <?php if($isi->deletethis<>1){ ?>
              <li><a href="JavaScript:cetakprint()"><i class="fa fa-print"></i>&nbsp;Cetak</a></li>
              <li><a href="JavaScript:cetakdigital()"><i class="fa fa-file-pdf-o"></i>&nbsp;Digital</a></li>
              <li><a href="JavaScript:cetakexcel()"><i class="fa fa-file-excel-o"></i>&nbsp;Excel</a></li>
              <li><a href="JavaScript:cetakprintavg()"><i class="fa fa-print"></i>&nbsp;Cetak AVG</a></li>
              <li><a href="JavaScript:cetakdigitalavg()"><i class="fa fa-file-pdf-o"></i>&nbsp;Digital AVG</a></li><br/>
              <li><a href="JavaScript:cetakexcelavg()"><i class="fa fa-file-excel-o"></i>&nbsp;Excel AVG</a></li>
              <li><a href="javascript:void(window.open('<?php echo site_url("ns_rapor_baru/ns_rapor_baru_detailmatpel/".$isi->replid."/d95d318e0bd6b9bea8da986a104fce7c") ?>'))"><i class="fa fa-calendar"></i>&nbsp;Rekap Nilai</a></li>
        <?php } ?>
              <li><a href="javascript:void(window.open('<?php echo site_url("ns_rapor_baru/tambah") ?>'))"><i class="fa fa-plus"></i>&nbsp;Tambah</a></li>
      </ol>
      
    </section>
    <section class="content">
    <?php if($isi->deletethis==1){ ?>
      <div style="background-color:red;text-align:center;"><h2>Data Telah Dihapus</h2></div>
      <?php } ?>
  		<table width="100%" border="0" class="form-horizontal form-validate">
      <tr>
              <th align="left">
          		<label class="control-label" for="minlengthfield">Unit Bisnis</label>
          		<div class="control-group">
  					<div class="controls">:
                  	<?php
                  		echo $isi->companytext." (".$isi->departemen.")";
                  	?>
  					</div>
          		</div>
              </th></tr>
  			<tr>
              <th align="left">
          		<label class="control-label" for="minlengthfield">Nama Siswa</label>
          		<div class="control-group">
  					<div class="controls">:
                  	<?php
                  		echo ucwords(strtolower($isi->siswa));
                  	?>
  					</div>
          		</div>
              </th></tr>
              <tr>
              <th align="left">
          		<label class="control-label" for="minlengthfield">NISN</label>
          		<div class="control-group">
  					<div class="controls">:
                  	<?php
                  		if($isi->nisn<>""){echo $isi->nisn;}else{echo "-";}
                  	?>
  					</div>
          		</div>
              </th></tr>
              <tr>
              <th align="left">
          		<label class="control-label" for="minlengthfield">Nomor Induk</label>
          		<div class="control-group">
  					<div class="controls">:
                  	<?php
                  		echo "<a href='".site_url('general/datasiswa/'.$isi->replidsiswa)."' target='_blank'>".$isi->nis."</a>";
                  	?>
  					</div>
          		</div>
              </th></tr>
              <tr>
              <th align="left">
          		<label class="control-label" for="minlengthfield">Kelas</label>
          		<div class="control-group">
  					<div class="controls">:
                  	<?php
                  		echo strtoupper($isi->kelastext);
                  	?>
  					</div>
          		</div>
              </th></tr>
              <tr>
              <th align="left">
          		<label class="control-label" for="minlengthfield">Program</label>
          		<div class="control-group">
  					<div class="controls">:
                  	<?php
                  		echo $isi->kelompoksiswa;
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
                  		echo $isi->tahunajaran;
                  	?>
  					</div>
          		</div>
              </th></tr>
              <th align="left">
          		<label class="control-label" for="minlengthfield">Semester</label>
          		<div class="control-group">
  					<div class="controls">:
                  	<?php
                  		echo ucwords(strtolower($isi->periode));
                  	?>
                  	<?php //echo  <p id="message"></p> ?>
  					</div>
  				</div>
  			</th></tr>
        <!--
        <tr>
                  <th align="left">
                      <label class="control-label" for="minlengthfield">Modul/Tema</label>
                      <div class="control-group">
                <div class="controls">:
                        <?php
                          echo $isi->idmodultipe;
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
                  		echo ucwords(strtolower($isi->region));
                  	?>
  					</div>
          		</div>
              </th></tr>
              <tr>
          <th align="left">
              <label class="control-label" for="minlengthfield">Non Reguler</label>
              <div class="control-group">
            <div class="controls">:
                    <?php
                      echo $CI->p_c->cekaktif($isi->nonreguler)
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
                  		echo $isi->rapottipe." (".$isi->keteranganrapor.")";
                  	?>
  					</div>
          		</div>
              </th></tr>
      		      <tr>
  		            <th align="left">
                  		<label class="control-label" for="minlengthfield">Catatan Wali Kelas</label>
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
              		<label class="control-label" for="minlengthfield">Tgl. Rapor</label>
              		<div class="control-group">
  						<div class="controls">:
  	                	<?php
  	                		echo strtoupper($CI->p_c->tgl_indo($isi->tanggalkegiatan));
  	                	?>
  						</div>
              		</div>
  	            </th>
  	         </tr>
             <tr>
             <th align="left">
             <label class="control-label" for="minlengthfield">Tahun Pelajaran Non Reguler</label>
             <div class="control-group">
           <div class="controls">:
                   <?php
                     echo $isi->tahunajaranrapot;
                   ?>
           </div>
             </div>
             </th></tr>
             <tr>
         <th align="left">
             <label class="control-label" for="minlengthfield">Tampil Nilai Akhir</label>
             <div class="control-group">
           <div class="controls">:
                   <?php
                     echo $CI->p_c->cekaktif($isi->tampilna)
                   ?>
                   <?php //echo  <p id="message"></p> ?>
           </div>
             </div>
             </th></tr>
             <tr>
     		            <th align="left">
                     		<label class="control-label" for="minlengthfield">Petugas</label>
                     		<div class="control-group">
     							<div class="controls" valign="top">:
     		                	<?php
     		                		echo trim($CI->dbx->getpegawai($isi->created_by,0,1));
     		                	?>

     							</div>
                     		</div>
     		            </th></tr>
  		</table>
  <?php if($isi->tipe=='P5'){
    foreach((array)$projek as $projekrow) {
      echo " <table class='table table-bordered' width='100%'>";
      echo "<tr>";
      echo "<td align='left'><h4>".$projekrow->projektext." | Tema: ".$projekrow->tematext."</h4>Tipe Projek: ".$projekrow->projektipetext."</td>";
      echo "</tr>";
      echo "<tr>";
      echo "<td align='left'><p align='justify'>".$projekrow->keterangan."</p></td>";
      echo "</tr>";
      echo "<tr>";
      echo "<td align='left'><h4>Catatan Proses: </h4><p align='justify'>".$projekrow->catatanproses."</p></td>";
      echo "</tr>";
      echo "</table>";
    }
    echo "<table class='table table-bordered table-striped'>";
    echo "<thead><tr>";
      echo "<th width='50'>No.</th>";
      echo "<th>Elemen</th>";
      echo "<th>Sub Elemen</th>";
      echo "<th>Capaian</th>";
      echo "<th>Fase</th>";
      echo "<th>aktif</th>";

			foreach((array)$idprojekpredikat_opt as $rowprojekpredikat) {
          echo "<th>".$rowprojekpredikat->nama."</th>";
      }
      echo "</tr></thead>";
      
      echo "<tbody>";
      $dimensitext="";$idprojek="";
      $CI =& get_instance();$no=1;
      foreach((array)$capaian as $row) {
        if ($idprojek<>$row->idprojek){
          echo "<tr >";
          echo "<td align='center' colspan='".(7+COUNT($idprojekpredikat_opt))."' style='background:orange !important;'><b>Projek: ".($row->projektext)."</b></td>";
          echo "</tr>";
        }
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
          foreach((array)$idprojekpredikat_opt as $rowprojekpredikat) {
            if($rowprojekpredikat->replid==$row->idprojekpredikat){
              echo "<td align='center'><b>&check;</b></td>";
            }else{
              echo "<td align='center'>&nbsp;</td>";
            }
            
            
          }  
         echo "</tr>";
         $idprojek=$row->idprojek;
        $dimensitext=$row->dimensitext;
      }
			echo "</tbody></table>";
    
  // ----------------------------------------------------------------------------------------------------------------------------------
  // ----------------------------------------------------------------------------------------------------------------------------------
  ?>
  <?php } else if($isi->tipe=='Grafik'){
    // ----------------------------------------------------------------------------------------------------------------------------------
  	// ----------------------------------------------------------------------------------------------------------------------------------

  		echo "<table border=1 width='100%'>";
  		echo "<tr>";
      $judul="";$judultext="";$x=0;
  		foreach((array)$kelompok as $rn) {
  			if (isset($tglkeg[$rn->pengembangandirivariabel])){
  				$tglkeg[$rn->pengembangandirivariabel]=$tglkeg[$rn->pengembangandirivariabel].",'".$CI->p_c->getBulan($rn->bulankegiatan)."'";
  			}else{
  				$tglkeg[$rn->pengembangandirivariabel]="'','".$CI->p_c->getBulan($rn->bulankegiatan)."'";
  			}

  			if (isset($nilaikeg[$rn->pengembangandirivariabel])){
  				$nilaikeg[$rn->pengembangandirivariabel]=$nilaikeg[$rn->pengembangandirivariabel].",".$rn->nilaigrafik;
  			}else{
  				$nilaikeg[$rn->pengembangandirivariabel]=$rn->nilaigrafik;
  			}

  			if ($judul<>$rn->pengembangandirivariabel){
  				if ($judultext<>""){
  					$judultext=$judultext.'||'.$rn->pengembangandirivariabel;
  				}else{
  					$judultext=$rn->pengembangandirivariabel;
  				}
  		  }
  	    $judul=$rn->pengembangandirivariabel;
      }

      if ($judultext<>""){
          $judultextgraph=explode("||",$judultext);
      		foreach((array)$judultextgraph as $graph) {
      			echo "<td align='center'>";
      			    	echo "<table style='border:0 !important;width:100%;border-collapse:initial !important; '>";
      				    	echo "<tr>";
      				    	echo "<td align='center' height='300px' width='50%'>";
      				    	//echo $tglkeg[$graph];
      						?>
      						<script src="https://code.highcharts.com/highcharts.js"></script>
      						<script src="https://code.highcharts.com/modules/exporting.js"></script>

      						<script type="text/javascript">
      							$(function () {
      							    Highcharts.chart('container<?php echo $graph; ?>', {
      							        chart: {
      							            type: 'line'
      							        },
      							        credits: {
      							            enabled: false
      							        },
      							        title: {
      							            text: '<?php echo $graph; ?>'
      							        },
      							        xAxis: {
      							        	showLastLabel: true,
      							        	labels: {
      										            rotation: 0,
      										            step:1,
      										            style: {
      										                color: '#525151',
      										                font: '8px Helvetica'
      										            },
      										            formatter: function () {
      										                return this.value;
      										            }
      										        },
      							        	type: "linear",
      							            categories: [<?php echo $tglkeg[$graph]; ?>],
      							            min: 0
      							        },
      							        yAxis: {
      							        	min: 0,
      							            max: 100,
      							            tickInterval: 20,
      							            title: {
      							                text: 'Nilai'
      							            }
      							        },
      							        plotOptions: {
      							            line: {
      							                dataLabels: {
      							                    enabled: false
      							                },
      							                enableMouseTracking: false
      							            }
      							        },
      							        series: [{
      							            name: 'Nilai Peserta Didik/Bulan',
      							            data: [<?php echo $nilaikeg[$graph]; ?>],
      							            pointStart: 1
      							        }]
      							    });
      							});
      						</script>
      						<div id="container<?php echo $graph; ?>" style="width:500px; height:250px; margin: 0 auto;font-size:-3;"></div>
      						<?php
      				    	echo "</td>";
      				    	echo "</tr>";
      			    	echo "</table>";
      		    	echo "</td>";

      		    	if (($x%2)==1){
      		    		echo "</tr>";
      		    		echo "<tr>";
      		    	}
      		    	$x++;
      		}

          echo "</table>";
      		echo "<br/>Deskripsi:<br/>";
      		echo "<table class='table table-bordered table-striped'>";
      		echo "<tr>";
      		echo "<th width='50'>No.</th>";
      		echo "<th>Aspek yang harus dinilai</th>";
      		echo "<th>Nilai</th>";
      		echo "<th>Predikat</th>";
      		echo "<th>Deskripsi</th>";
      		echo "</tr>";
          //echo var_dump($judultextgraph);
      		$noas=1;
      		foreach((array)$judultextgraph as $graph) {
      			$nilaix=0;$nilaiy=0;$xn=0;
      			if (isset($nilaikeg[$graph])){
      				$nilaix=explode(",",$nilaikeg[$graph]);
      				foreach((array)$nilaix as $ngraph) {
      					$nilaiy=$nilaiy+$ngraph;
      					$xn++;
      				}

      			}

      			echo "<tr>";
      			echo "<td width='20'>".$noas++."</td>";
      			echo "<td width='150'>".$graph."</td>";
            if (($nilaiy<>0) or ($xn<>0)){
                echo "<td width='20'>".ceil($nilaiy/$xn)."</td>";
                echo "<td width='20'>".strtoupper($CI->dbx->ns_predikat_graph(ceil($nilaiy/$xn),$graph))."</td>";
                echo "<td>".$CI->dbx->ns_predikat_text_graph(ceil($nilaiy/$xn),$graph)."</td>";
            }else{
              echo "<td width='20'>0</td>";
              echo "<td width='20'>0</td>";
              echo "<td width='20'>0</td>";
            }
      			echo "</tr>";
      		}
          echo "</table>";
      } //judultextgraph
}else if(($isi->tipe=='Murni') OR ($isi->tipe=='Tryout') OR ($isi->tipe=='SKL') OR ($isi->tipe=='SKL23')){
      	// Murni
      	// ----------------------------------------------------------------------------------------------------------------------------------
      	// ----------------------------------------------------------------------------------------------------------------------------------
      		  $matkel="";$matpel="";$pengembangandirivariabel="";$jml_kel=0;
            $csx=3+$isi->kkmon+$isi->predikaton+$isi->kalimatraporon;
            $cspdv=1+$isi->predikaton;
            $arraympk=array(); //$arraypdv=array();
            $cskel=array();
            foreach((array)$kelompok as $rowkelompok) {
              if ($matkel<>$rowkelompok->matpelkelompok){
                $arraypsv[$rowkelompok->matpelkelompok]=array();
                $arraypdv[$rowkelompok->matpelkelompok][$rowkelompok->prosessubvariabel]=array();
                array_push($arraympk,$rowkelompok->matpelkelompok);
                $cskel[$rowkelompok->matpelkelompok]=0;
              }

              if (!in_array($rowkelompok->prosessubvariabel,$arraypsv[$rowkelompok->matpelkelompok])){
                array_push($arraypsv[$rowkelompok->matpelkelompok],$rowkelompok->prosessubvariabel);
                $arraypdv[$rowkelompok->matpelkelompok][$rowkelompok->prosessubvariabel]=array();
              }
              if (!in_array($rowkelompok->pengembangandirivariabel,$arraypdv[$rowkelompok->matpelkelompok][$rowkelompok->prosessubvariabel])){
                array_push($arraypdv[$rowkelompok->matpelkelompok][$rowkelompok->prosessubvariabel],$rowkelompok->pengembangandirivariabel);
                $cskel[$rowkelompok->matpelkelompok]++;
              }

              $matkel=$rowkelompok->matpelkelompok;
            }
            //echo var_dump($arraympk);die;
            $matkel="";
            foreach((array)$arraympk as $rowmpk) {
          		$nilaimp=0;
              if ($matkel<>$rowmpk){
                    $no=1;
                    $matkelcs=($cskel[$rowmpk]*(2+$isi->predikaton))+1+$isi->kkmon+$isi->kalimatraporon;
        		        echo " <table class='table table-bordered' width='100%'>";
        		        echo "<tr>";
                		echo "<td align='' colspan='".$matkelcs."'><b>".($rowmpk)."</b></td>";
                		echo "</tr>";
        						echo "<tr>";
        						echo "<th width='50' rowspan='2'>No.</th>";
                    echo "<th width='*' rowspan='2'>Mata Pelajaran</th>";
                    if($isi->skkon==1){
                      echo "<th width='65' rowspan='2'>SKK</th>";
                    }
                    //if($isi->kkmon==1){
                        echo "<th width='65' rowspan='2'>KKM</th>";
                    //}
                    foreach((array)$arraypsv[$rowmpk] as $rowpsv) {
                      //foreach((array)$arraypdv[$rowmpk][$rowpsv] as $rowpdv) {
                        echo "<th width='".(80*(((1+$isi->predikaton+$isi->kalimatraporon)*COUNT($arraypdv[$rowmpk][$rowpsv]))))."' colspan='".((1+$isi->predikaton+$isi->kalimatraporon)*COUNT($arraypdv[$rowmpk][$rowpsv]))."'>".$rowpsv."</th>";
                      //}
                    }
                    echo "</tr>";
                    echo "<tr>";
                    foreach((array)$arraypsv[$rowmpk] as $rowpsv) {
                      foreach((array)$arraypdv[$rowmpk][$rowpsv] as $rowpdv) {
                        echo "<th width='80'>".$rowpdv."</th>";
                        if($isi->kalimatraporon==1){echo "<th width='160'>Huruf</th>";}
                        if($isi->predikaton){
                            echo "<th width='80'>Predikat</th>";
                        }
                      }
                    }
                    echo "</tr>";

                    foreach((array)$kelompok as $rowkelompok) {
                      if($rowmpk==$rowkelompok->matpelkelompok){
                        if($no<2){
                          echo "</tr>";
                        }
                        if ($matpel<>$rowkelompok->matpel){
                          echo "<tr>";
                          echo "<td>".$no++."</td>";
                          echo "<td align='left'><a href='".site_url('ns_rapor_baru/ns_rapor_baru_detailmatpel/')."/".$id."/".$rowkelompok->idmatpel."' target='_blank' >".$rowkelompok->matpel.' '.$rowkelompok->matpelketerangan;
                          if($rowkelompok->matpelexternal){
                            echo "&nbsp;".$isi->external;
                          }
                          if($isi->skkon==1){
                            echo "<td align='center'>".$rowkelompok->jumlahskk."</td>";
                          }
                          //if($isi->kkmon==1){
                            echo "<td align='center'>".$rowkelompok->kkm."</td>";
                          //}
                          echo "<td align='center'>".CEIL($rowkelompok->nilaiasli)."</td>";
                          if($isi->kalimatraporon==1){
      											echo "<td align='left'>".ucwords(strtolower($CI->p_c->kalimatrapor(CEIL($rowkelompok->nilaiasli),0))) ."</td>";
      										}
                          if($isi->predikaton==1){
                              echo "<td align='center'>".strtoupper($CI->dbx->ns_predikat($isi->departemen,CEIL($rowkelompok->nilaiasli),$rowkelompok->idpredikattipe))."</td>";
                          }
                        }else{
                          echo "<td align='center'>".CEIL($rowkelompok->nilaiasli)."</td>";
                          if($isi->predikaton==1){
                              echo "<td align='center'>".strtoupper($CI->dbx->ns_predikat($isi->departemen,CEIL($rowkelompok->nilaiasli),$rowkelompok->idpredikattipe))."</td>";
                          }
                        }
                      }
                      $matpel=$rowkelompok->matpel;
                    }
                }
                $matkel=$rowmpk;
            } //foreach((array)$kelompok as $rowkelompok) {
      				?>

                  </tbody>
                  <tfoot>
                  </tfoot>
              </table>
              <br/>
              <?php if ($rapotsetting->sikap=="1"){ ?>
              <h4>Sikap Spiritual</h4>
               <table class='table table-bordered' width='100%'>
                <tr>
                  <td valign="center" align="center" width="100"><h3><?php echo $isi->predikatspiritualtext?></h3></td>
                  <td valign="top">
                      <?php
                          if($isi->descspiritualtext<>""){
                            echo $isi->descspiritualtext."<br/><br/>";
                          }
                          echo $isi->spiritualtext;
                      ?>
                  </td>
                </tr>
                </table>
                <h4>Sikap Sosial</h4>
                 <table class='table table-bordered' width='100%'>
                <tr>
                  <td valign="center" align="center" width="100"><h3><?php echo $isi->predikatsosialtext?></h3></td>
                  <td valign="top">
                      <?php
                          if($isi->descsosialtext<>""){
                            echo $isi->descspiritualtext."<br/><br/>";
                          }
                          echo $isi->sosialtext
                      ?>
                  </td>
                </tr>
              </table>
              <?php } ?>
  <?php } else if($isi->tipe=='LPD'){ ?>
    <table border=0 width="100%">
    <tr>
        <td><b><?php echo $isi->tabeljudul_1 ?></b></td>
    </tr>
    <tr>
        <td style="padding-left:30px">
              <?php
              $matkel="";$jml_kel=0;
              $idmatpel="";
              $nilaimp13=array();
              $nilaimp13group=array();
              $matpelgroup=array();

              //HITUNG

              foreach((array)$kelompok as $pengetahuan) {
                  if (isset($nilaimp13[$pengetahuan->idmatpel][$pengetahuan->idmodultipe])){
                    $nilaimp13[$pengetahuan->idmatpel][$pengetahuan->idmodultipe]=$nilaimp13[$pengetahuan->idmatpel][$pengetahuan->idmodultipe]+$pengetahuan->nilai;
                  }else{
                    $nilaimp13[$pengetahuan->idmatpel][$pengetahuan->idmodultipe]=$pengetahuan->nilai;
                  }

                  if (isset($nilaimp13group[$pengetahuan->idgroup][$pengetahuan->idmodultipe])){
                    $nilaimp13group[$pengetahuan->idgroup][$pengetahuan->idmodultipe]=$nilaimp13group[$pengetahuan->idgroup][$pengetahuan->idmodultipe]+$pengetahuan->nilai;
                  }else{
                    $nilaimp13group[$pengetahuan->idgroup][$pengetahuan->idmodultipe]=$pengetahuan->nilai;
                  }

                  $matpelgroup[$pengetahuan->idgroup][$pengetahuan->idmatpel]=$pengetahuan->matpel;
              }

              //TAMPIL
              $idmodultipe="";$no=1;$grouptext="";
              $csx=4+$isi->kkmon+$isi->predikaton;
              foreach((array)$kelompok as $pengetahuan) {
                $nilaimp=0;$jml_kel++;
                //$nilaimp=$CI->ns_rapor_baru_db->hitnilai_db($isi->idkelas,$isi->idsiswa,$pengetahuan->idmatpel,$isi->idtahunajaran,$isi->departemen,$isi->idregion,$isi->idrapottipe,$isi->nilaimurni,$isi->idperiode,$pengetahuan->idmatpelkelompok);
                //echo var_dump($nilaimp);die;
                if ($matkel<>$pengetahuan->matpelkelompok){
                   //$no=1;
                    if ($jml_kel<=1){
                      ?>
                      <table class="table table-bordered"  width="100%">
                            <thead>
                              <?php
                                echo "<tr>";
                                echo "<th width='60'>No.</th>";
                                echo "<th>Group</th>";
                                echo "<th>Mata Pelajaran</th>";
                                //if($isi->kkmon==1){
                                    echo "<th width='60' rowspan='2'>KKM</th>";
                                //}
                                echo "<th>Nilai</th>";
                                if($isi->predikaton==1){
                                  echo "<th>Predikat</th>";
                                }
                                echo "</tr>";
                                echo "<tr>";
                                echo "<td align='' colspan='".$csx."'><b>".ucfirst(strtolower($pengetahuan->matpelkelompok))."</b></td>";
                                echo "</tr>";
                              ?>
                            </thead>
                            <tbody>
                      <?php
                      } else {
                        echo "<tr>";
                              echo "<td align='' colspan='".$csx."'><b>".ucfirst(strtolower($pengetahuan->matpelkelompok))."</b></td>";
                              echo "</tr>";

                      }//if $jml_kel
                  }


                if($idmatpel<>$pengetahuan->idmatpel){
                      echo "<tr>";
                      echo "<td align='center'>".$no++."</td>";
                      echo "<td align='left'>";
													if($pengetahuan->grouptext<>""){
														echo ucwords(strtolower($pengetahuan->grouptext));
													}else{
														echo ucwords(strtolower($pengetahuan->groupmatpeltext));
													}
													echo "</td>";
                      echo "<td align='left'><a href='".site_url('ns_rapor_baru/ns_rapor_baru_detailmatpel/')."/".$id."/".$pengetahuan->idmatpel."' target='_blank'>".$pengetahuan->matpel;
                      if($pengetahuan->matpelexternal){
                        echo "&nbsp;".$isi->external;
                      }
                      echo "</a>";
                      echo "</td>";
                      //if($isi->kkmon==1){
                        echo "<td align='center'>".strtoupper($pengetahuan->kkm)."</td>";
                      //}
                      $nilaimp13_tot = array_filter($nilaimp13[$pengetahuan->idmatpel]);
                      if(array_sum($nilaimp13_tot)<1){
                        $average=0;
                      }else{
                        $average = array_sum($nilaimp13_tot)/count($nilaimp13_tot);
                      }
                      echo "<th colspan=".COUNT($arrmodultipe).">".CEIL($average)."</th>";
                      if($isi->predikaton==1){
                        echo "<th colspan=".COUNT($arrmodultipe).">".strtoupper($CI->dbx->ns_predikat($isi->departemen,CEIL($average),$pengetahuan->idpredikattipe))."</th>";
                      }
                  }
                  $matkel=$pengetahuan->matpelkelompok;
                  $idmatpel=$pengetahuan->idmatpel;
                  $idmodultipe=$pengetahuan->idmodultipe;
                  $grouptext=$pengetahuan->grouptext;
              } //foreach((array)$kelompok as $pengetahuan) {
                ?>

                  </tbody>
              </table>
            </td>
        </tr>
        <tr>
            <td><b><?php echo $isi->tabeljudul_2 ?></b></td>
        </tr>
        <tr>
            <td style="padding-left:30px">
              <?php
              $matkel="";$jml_kel=0;
              $csx=4+$isi->kkmon+$isi->predikaton;
              $idmatpel="";
              $nilaimp13=array();
              $nilaimp13group=array();
              $matpelgroup=array();

              //HITUNG

              foreach((array)$kelompok2 as $keterampilan) {
                  if (isset($nilaimp13[$keterampilan->idmatpel][$keterampilan->idmodultipe])){
                    $nilaimp13[$keterampilan->idmatpel][$keterampilan->idmodultipe]=$nilaimp13[$keterampilan->idmatpel][$keterampilan->idmodultipe]+$keterampilan->nilai;
                  }else{
                    $nilaimp13[$keterampilan->idmatpel][$keterampilan->idmodultipe]=$keterampilan->nilai;
                  }

                  if (isset($nilaimp13group[$keterampilan->idgroup][$keterampilan->idmodultipe])){
                    $nilaimp13group[$keterampilan->idgroup][$keterampilan->idmodultipe]=$nilaimp13group[$keterampilan->idgroup][$keterampilan->idmodultipe]+$keterampilan->nilai;
                  }else{
                    $nilaimp13group[$keterampilan->idgroup][$keterampilan->idmodultipe]=$keterampilan->nilai;
                  }

                  $matpelgroup[$keterampilan->idgroup][$keterampilan->idmatpel]=$keterampilan->matpel;
              }

              //TAMPIL
              $idmodultipe="";$no=1;$grouptext="";
              foreach((array)$kelompok2 as $keterampilan) {
                $nilaimp=0;$jml_kel++;
                //$nilaimp=$CI->ns_rapor_baru_db->hitnilai_db($isi->idkelas,$isi->idsiswa,$keterampilan->idmatpel,$isi->idtahunajaran,$isi->departemen,$isi->idregion,$isi->idrapottipe,$isi->nilaimurni,$isi->idperiode,$keterampilan->idmatpelkelompok);
                //echo var_dump($nilaimp);die;
                if ($matkel<>$keterampilan->matpelkelompok){
                   //$no=1;
                    if ($jml_kel<=1){
                      ?>
                      <table class="table table-bordered" width="100%">
                            <thead>
                              <?php
                                echo "<tr>";
                                echo "<th width='60'>No.</th>";
                                echo "<th>Group</th>";
                                echo "<th>Mata Pelajaran</th>";
                                //if($isi->kkmon==1){
                                    echo "<th width='60' rowspan='2'>KKM</th>";
                                //}
                                echo "<th>Nilai</th>";
                                if($isi->predikaton==1){
                                  echo "<th>Predikat</th>";
                                }
                                echo "</tr>";
                                echo "<tr>";
                                echo "<td align='' colspan='".$csx."'><b>".ucfirst(strtolower($pengetahuan->matpelkelompok))."</b></td>";
                                echo "</tr>";
                              ?>
                            </thead>
                            <tbody>
                      <?php
                      } else {
                        echo "<tr>";
                              echo "<td align='' colspan='".$csx."'><b>".ucfirst(strtolower($keterampilan->matpelkelompok))."</b></td>";
                              echo "</tr>";

                      }//if $jml_kel
                  }


                  if($idmatpel<>$keterampilan->idmatpel){
                    echo "<tr>";
                    echo "<td align='center'>".$no++."</td>";
                    echo "<td align='center'>".($keterampilan->grouptext)."</td>";
                    echo "<td align='left'><a href='".site_url('ns_rapor_baru/ns_rapor_baru_detailmatpel/')."/".$id."/".$keterampilan->idmatpel."' target='_blank'>".$keterampilan->matpel;
                    if($keterampilan->matpelexternal){
                      echo "&nbsp;".$isi->external;
                    }
                    echo "</a>";
                    echo "</td>";
                    //if($isi->kkmon==1){
                      echo "<td align='center'>".strtoupper($keterampilan->kkm)."</td>";
                    //}

                    $nilaimp13_tot = array_filter($nilaimp13[$keterampilan->idmatpel]);
                    if(array_sum($nilaimp13_tot)<1){
                        $average=0;
                    }else{
                        $average = array_sum($nilaimp13_tot)/count($nilaimp13_tot);
                    }
                    echo "<th colspan=".COUNT($arrmodultipe).">".CEIL($average)."</th>";
                    if($isi->predikaton==1){
                      echo "<th colspan=".COUNT($arrmodultipe).">".strtoupper($CI->dbx->ns_predikat($isi->departemen,CEIL($average),$isi->predikattipe))."</th>";
                    }
                  } //$idmatpel<>$keterampilan->idmatpel


                  $matkel=$keterampilan->matpelkelompok;
                  $idmatpel=$keterampilan->idmatpel;
                  $idmodultipe=$keterampilan->idmodultipe;
                  $grouptext=$keterampilan->grouptext;
              } //foreach((array)$kelompok as $keterampilan) {
                ?>

                      </tbody>
                  </table>
                </td>
            </tr>
          </table>
<?php
}else if($isi->tipe=='Reguler'){ //lpd //RAPORT REGULER
          	// RAPOR UTAMA
          	// ----------------------------------------------------------------------------------------------------------------------------------
          	// ----------------------------------------------------------------------------------------------------------------------------------
                $header_count="A";
                ?>
                
                <table border=0 width="100%">
                <?php if ($isi->sikap=="1"){ ?>
                  <tr>
                      <td><b><?php echo $header_count++ ?>. Sikap</b></td>
                  </tr>
                  <tr>
                      <td style="padding-left:30px">
                        1. Sikap Spiritual
                         <table class='table table-bordered' width='100%'>
                          <tr>
                            <td valign="center" align="center" width="100"><h3><?php echo $isi->predikatspiritualtext?></h3></td>
                            <td valign="top">
                                <?php
                                    if($isi->descspiritualtext<>""){
                                      echo $isi->descspiritualtext."<br/><br/>";
                                    }
                                    echo $isi->spiritualtext;
                                ?>
                            </td>
                          </tr>
                          </table>
                          2. Sikap Sosial
                           <table class='table table-bordered' width='100%'>
                          <tr>
                            <td valign="center" align="center" width="100"><h3><?php echo $isi->predikatsosialtext?></h3></td>
                            <td valign="top">
                                <?php
                                    if($isi->descsosialtext<>""){
                                      echo $isi->descspiritualtext."<br/><br/>";
                                    }
                                    echo $isi->sosialtext
                                ?>
                            </td>
                          </tr>
                        </table>
                      </td>
                  </tr>
                  <?php }?>            
                  <?php
                  $csx=3+$isi->kkmon+$isi->kalimatraporon+COUNT($arrmodultipe);
                  if($isi->predikaton==1){
                    $csx=$csx+COUNT($arrmodultipe);
                  }

                  //HITUNG PENGETAHUAN
                  $nilaimp13=array();
                  $nilaimp13group=array();
                  $matpelgroup=array();

                  foreach((array)$kelompok as $pengetahuan) {
                      if (isset($nilaimp13[$pengetahuan->idmatpel][$pengetahuan->idmodultipe])){
                        $nilaimp13[$pengetahuan->idmatpel][$pengetahuan->idmodultipe]=$nilaimp13[$pengetahuan->idmatpel][$pengetahuan->idmodultipe]+$pengetahuan->nilai;
                      }else{
                        $nilaimp13[$pengetahuan->idmatpel][$pengetahuan->idmodultipe]=$pengetahuan->nilai;
                      }

                      if (isset($nilaimp13group[$pengetahuan->idgroup][$pengetahuan->idmodultipe])){
                        $nilaimp13group[$pengetahuan->idgroup][$pengetahuan->idmodultipe]=$nilaimp13group[$pengetahuan->idgroup][$pengetahuan->idmodultipe]+$pengetahuan->nilai;
                      }else{
                        $nilaimp13group[$pengetahuan->idgroup][$pengetahuan->idmodultipe]=$pengetahuan->nilai;
                      }

                      $matpelgroup[$pengetahuan->idgroup][$pengetahuan->idmatpel]=$pengetahuan->matpel;
                  }

                  //HITUNG KETERAMPILAN
                  $keterampilanmp13=array();
                  $keterampilanmp13group=array();
                  $matpelgroup=array();
                  foreach((array)$kelompok2 as $keterampilan) {
                      if (isset($keterampilanmp13[$keterampilan->idmatpel][$keterampilan->idmodultipe])){
                        $keterampilanmp13[$keterampilan->idmatpel][$keterampilan->idmodultipe]=$keterampilanmp13[$keterampilan->idmatpel][$keterampilan->idmodultipe]+$keterampilan->nilai;
                      }else{
                        $keterampilanmp13[$keterampilan->idmatpel][$keterampilan->idmodultipe]=$keterampilan->nilai;
                      }

                      if (isset($keterampilanmp13group[$keterampilan->idgroup][$keterampilan->idmodultipe])){
                        $keterampilanmp13group[$keterampilan->idgroup][$keterampilan->idmodultipe]=$keterampilanmp13group[$keterampilan->idgroup][$keterampilan->idmodultipe]+$keterampilan->nilai;
                      }else{
                        $keterampilanmp13group[$keterampilan->idgroup][$keterampilan->idmodultipe]=$keterampilan->nilai;
                      }

                      $matpelgroup[$keterampilan->idgroup][$keterampilan->idmatpel]=$keterampilan->matpel;
                  }

                  //HITUNG NON AKADEMIK
    							$nonakademikmp13=array();
    							$nonakademikmp13group=array();
    							$matpelgroup=array();
    							foreach((array)$nonakademikdata as $nonakademik) {
    									if (isset($nonakademikmp13[$nonakademik->idmatpel][$nonakademik->idmodultipe])){
    										$nonakademikmp13[$nonakademik->idmatpel][$nonakademik->idmodultipe]=$nonakademikmp13[$nonakademik->idmatpel][$nonakademik->idmodultipe]+$nonakademik->nilai;
    									}else{
    										$nonakademikmp13[$nonakademik->idmatpel][$nonakademik->idmodultipe]=$nonakademik->nilai;
    									}

    									if (isset($nonakademikmp13group[$nonakademik->idgroup][$nonakademik->idmodultipe])){
    										$nonakademikmp13group[$nonakademik->idgroup][$nonakademik->idmodultipe]=$nonakademikmp13group[$nonakademik->idgroup][$nonakademik->idmodultipe]+$nonakademik->nilai;
    									}else{
    										$nonakademikmp13group[$nonakademik->idgroup][$nonakademik->idmodultipe]=$nonakademik->nilai;
    									}

    									$matpelgroup[$nonakademik->idgroup][$nonakademik->idmatpel]=$nonakademik->matpel;
    							}
                  ?>
                  <tr>
                      <td><b><?php echo $header_count++ ?>. <?php echo $isi->tabeljudul_1 ?></b></td>
                  </tr>
                  <tr>
                      <td style="padding-left:30px">
                            <?php
                            //TAMPIL
                            $matkel="";$idmodultipe="";$no=1;$grouptext="";$jml_kel=0;$idmatpel="";
                          	foreach((array)$kelompok as $pengetahuan) {
                          		$nilaimp=0;$jml_kel++;
                              //$nilaimp=$CI->ns_rapor_baru_db->hitnilai_db($isi->idkelas,$isi->idsiswa,$pengetahuan->idmatpel,$isi->idtahunajaran,$isi->departemen,$isi->idregion,$isi->idrapottipe,$isi->nilaimurni,$isi->idperiode,$pengetahuan->idmatpelkelompok);
                              //echo var_dump($nilaimp);die;
                              if ($matkel<>$pengetahuan->matpelkelompok){
                      	         //$no=1;
                                 	if ($jml_kel<=1){
                      							?>
                      							<table class="table table-bordered">
                      				            <thead>
                      				            	<?php
                                              echo "<tr>";
                                              echo "<th width='60' rowspan='2'>No.</th>";
                                              echo "<th rowspan='2'>Mata Pelajaran</th>";
                                              echo "<th rowspan='2'>Grup</th>";
                                              if($isi->skkon==1){
                                                echo "<th width='65' rowspan='2'>SKK</th>";
                                              }
                                              //if($isi->kkmon==1){
                                                  echo "<th width='60' rowspan='2'>KKM</th>";
                                              //}
                                              echo "<th colspan=".COUNT($arrmodultipe).">Nilai</th>";
                                              if($isi->predikaton==1){
                                                echo "<th colspan=".COUNT($arrmodultipe).">Predikat</th>";
                                              }
                                              echo "</tr>";
                                              echo "<tr>";
                                              foreach((array)$arrmodultipe as $rowmodultipe) {
                                                echo "<th width='*'>Modul ".$rowmodultipe->idmodultipe."</th>";
                                              }
                                              if($isi->predikaton==1){
                                                foreach((array)$arrmodultipe as $rowmodultipe) {
                                                  echo "<th width='*'>Modul ".$rowmodultipe->idmodultipe."</th>";
                                                }
                                              }
                                              echo "</tr>";
                                              echo "<tr>";
                      				            		echo "<td align='' colspan='".$csx."'><b>".ucfirst(strtolower($pengetahuan->matpelkelompok))."</b></td>";
                      				            		echo "</tr>";
                      				            	?>
                      				            </thead>
                      				            <tbody>
                      							<?php
                      							} else {
                      								echo "<tr>";
                      				        echo "<td align='' colspan='".$csx."'><b>".ucfirst(strtolower($pengetahuan->matpelkelompok))."</b></td>";
                      				        echo "</tr>";

                      							}//if $jml_kel
                      					}


                                //if($pengetahuan->groupon<>"1"){
                                    if($idmatpel<>$pengetahuan->idmatpel){
                                      echo "<tr>";
                                      echo "<td align='center'>".$no++."</td>";
                                      echo "<td align='left'><a href='".site_url('ns_rapor_baru/ns_rapor_baru_detailmatpel/')."/".$id."/".$pengetahuan->idmatpel."' target='_blank'>".$pengetahuan->matpel.' '.$pengetahuan->matpelketerangan;
                                      if($pengetahuan->matpelexternal){
                                        echo "&nbsp;".$isi->external;
                                      }
                                      echo "</a>";
                                      if($isi->matpeldeskripsion){
                                        $kompetensitextrapor=$CI->dbx->ns_rapotkompetensi($isi->replid,$pengetahuan->idmatpel,$isi->idsiswa);
                                        if ($kompetensitextrapor<>""){
                                          echo "<br/>";
                                          echo $kompetensitextrapor;
                                        }
																					if($pengetahuan->matpeldeskripsitext<>""){
																						if ($kompetensitextrapor<>""){
																							echo "<hr/>";
																						}
																						echo $pengetahuan->matpeldeskripsitext;
																					}
                                        
                                      }
                                      echo "</td>";
                                      echo "<td align='center'>".$pengetahuan->grouptext."</td>";
                                      if($isi->skkon==1){
                                        echo "<td align='center'>".strtoupper($pengetahuan->jumlahskk)."</td>";
                                      }
                                      //if($isi->kkmon==1){
                                        echo "<td align='center'>".strtoupper($pengetahuan->kkm)."</td>";
                                      //}
                                      /*
                                      if($pengetahuan->detail<>1){
                                        $nilaimp13_tot = array_filter($nilaimp13[$pengetahuan->idmatpel]);
                                        if(array_sum($nilaimp13_tot)<1){
                                          $average=0;
                                        }else{
                                          $average = array_sum($nilaimp13_tot)/count($nilaimp13_tot);
                                        }
                                        echo "<th colspan=".COUNT($arrmodultipe).">".CEIL($average)."</th>";
                                      }else{
                                      */
                                        foreach((array)$arrmodultipe as $rowmodultipe) {
                                          if (isset($nilaimp13[$pengetahuan->idmatpel][$rowmodultipe->idmodultipe])){
                                              echo "<th width='*'>".CEIL($nilaimp13[$pengetahuan->idmatpel][$rowmodultipe->idmodultipe])."</th>";
                                          }else{
                                            echo "<th width='*'>-</th>";
                                          }
                                        }
                                      //}
                                      /*
                                      if($pengetahuan->detail<>1){
                                          echo "<th colspan=".COUNT($arrmodultipe).">".strtoupper($CI->dbx->ns_predikat($isi->departemen,CEIL($average),$isi->predikattipe))."</th>";
                                      }else{
                                      */
                                        foreach((array)$arrmodultipe as $rowmodultipe) {
                                          if (isset($nilaimp13[$pengetahuan->idmatpel][$rowmodultipe->idmodultipe])){
                                              echo "<th width='*'>".strtoupper($CI->dbx->ns_predikat($isi->departemen,CEIL($nilaimp13[$pengetahuan->idmatpel][$rowmodultipe->idmodultipe]),$pengetahuan->idpredikattipe))."</th>";
                                          }else{
                                            echo "<th width='*'>-</th>";
                                          }
                                        }
                                      //}
                                    } //$idmatpel<>$pengetahuan->idmatpel
                                /* }else{ //$pengetahuan->group<>"1"

                                  if($grouptext<>$pengetahuan->grouptext){
                                    echo "<tr>";
                                    echo "<td align='center'>".$no++."</td>";
                                    echo "<td align='left'>".$pengetahuan->grouptext;
                                    echo "</td>";
                                    echo "<td align='center'>".strtoupper($pengetahuan->jumlahskk)."</td>";
                                    if($isi->kkmon==1){echo "<td align='center'>".strtoupper($pengetahuan->kkm)."</td>";}

                                    if($pengetahuan->detail<>1){
                                      $nilaimp13_tot = array_filter($nilaimp13group[$pengetahuan->idgroup]);
                                      if(array_sum($nilaimp13_tot)<1){
                                          $average=0;
                                      }else{
                                        $average = array_sum($nilaimp13_tot)/(COUNT($nilaimp13_tot)*COUNT($matpelgroup[$pengetahuan->idgroup]));
                                      }

                                      echo "<th colspan=".COUNT($arrmodultipe).">".CEIL($average)."</th>";
                                    }else{
                                      foreach((array)$arrmodultipe as $rowmodultipe) {
                                        if (isset($nilaimp13group[$pengetahuan->idgroup][$rowmodultipe->idmodultipe])){
                                            echo "<th width='*'>".CEIL($nilaimp13group[$pengetahuan->idgroup][$rowmodultipe->idmodultipe])."</th>";
                                        }else{
                                          echo "<th width='*'>-</th>";
                                        }
                                      }
                                    }

                                    if($pengetahuan->detail<>1){
                                        echo "<th colspan=".COUNT($arrmodultipe).">".strtoupper($CI->dbx->ns_predikat($isi->departemen,$average,$pengetahuan->idpredikattipe))."</th>";
                                    }else{
                                      foreach((array)$arrmodultipe as $rowmodultipe) {
                                        if (isset($nilaimp13group[$pengetahuan->idgroup][$rowmodultipe->idmodultipe])){
                                            echo "<th width='*'>".strtoupper($CI->dbx->ns_predikat($isi->departemen,$nilaimp13group[$pengetahuan->idgroup][$rowmodultipe->idmodultipe],$pengetahuan->idpredikattipe))."</th>";
                                        }else{
                                          echo "<th width='*'>-</th>";
                                        }
                                      }
                                    }
                                  }

                                } //$pengetahuan->group<>"1"
                                */
                                $matkel=$pengetahuan->matpelkelompok;
                                $idmatpel=$pengetahuan->idmatpel;
                                $idmodultipe=$pengetahuan->idmodultipe;
                                $grouptext=$pengetahuan->grouptext;
                            } //foreach((array)$kelompok as $pengetahuan) {

                              if ($kelompok<>""){
                                echo "</tbody></table>";
                              }
                              ?>
                          </td>
                      </tr>
                      <tr>
                          <td><b><?php echo $header_count++ ?>. <?php echo $isi->tabeljudul_2 ?></b></td>
                      </tr>
                      <tr>
                          <td style="padding-left:30px">
                            <?php
                            //TAMPIL
                            $matkel="";$idmodultipe="";$no=1;$grouptext="";$jml_kel=0;$idmatpel="";
                            foreach((array)$kelompok2 as $keterampilan) {
                              $nilaimp=0;$jml_kel++;
                              //$nilaimp=$CI->ns_rapor_baru_db->hitnilai_db($isi->idkelas,$isi->idsiswa,$keterampilan->idmatpel,$isi->idtahunajaran,$isi->departemen,$isi->idregion,$isi->idrapottipe,$isi->nilaimurni,$isi->idperiode,$keterampilan->idmatpelkelompok);
                              //echo var_dump($nilaimp);die;
                              if ($matkel<>$keterampilan->matpelkelompok){
                                 //$no=1;
                                  if ($jml_kel<=1){
                                    ?>
                                    <table class="table table-bordered">
                                          <thead>
                                            <?php
                                              echo "<tr>";
                                              echo "<th width='60' rowspan='2'>No.</th>";
                                              echo "<th rowspan='2'>Mata Pelajaran</th>";
                                              echo "<th rowspan='2'>Grup</th>";
                                              if($isi->skkon==1){
                                                echo "<th width='65' rowspan='2'>SKK</th>";
                                              }
                                              //if($isi->kkmon==1){
                                                  echo "<th width='60' rowspan='2'>KKM</th>";
                                              //}
                                              echo "<th colspan=".COUNT($arrmodultipe).">Nilai</th>";
                                              if($isi->predikaton==1){
                                                echo "<th colspan=".COUNT($arrmodultipe).">Predikat</th>";
                                              }
                                              echo "</tr>";
                                              echo "<tr>";
                                              foreach((array)$arrmodultipe as $rowmodultipe) {
                                                echo "<th width='*'> Modul ".$rowmodultipe->idmodultipe."</th>";
                                              }
                                              if($isi->predikaton==1){
                                                foreach((array)$arrmodultipe as $rowmodultipe) {
                                                  echo "<th width='*'> Modul ".$rowmodultipe->idmodultipe."</th>";
                                                }
                                              }
                                              echo "</tr>";
                                              echo "<tr>";
                                              echo "<td align='' colspan='".$csx."'><b>".ucfirst(strtolower($keterampilan->matpelkelompok))."</b></td>";
                                              echo "</tr>";
                                            ?>
                                          </thead>
                                          <tbody>
                                    <?php
                                    } else {
                                      echo "<tr>";
                                            echo "<td align='' colspan='".$csx."'><b>".ucfirst(strtolower($keterampilan->matpelkelompok))."</b></td>";
                                            echo "</tr>";

                                    }//if $jml_kel
                                }


                                //if($keterampilan->groupon<>"1"){
                                    if($idmatpel<>$keterampilan->idmatpel){
                                      echo "<tr>";
                                      echo "<td align='center'>".$no++."</td>";
                                      echo "<td align='left'><a href='".site_url('ns_rapor_baru/ns_rapor_baru_detailmatpel/')."/".$id."/".$keterampilan->idmatpel."' target='_blank'>".$keterampilan->matpel.' '.$keterampilan->matpelketerangan;
                                      if($keterampilan->matpelexternal){
                                        echo "&nbsp;".$isi->external;
                                      }
                                      echo "</a>";
                                      if($isi->matpeldeskripsion){
                                        $kompetensitextrapor=$CI->dbx->ns_rapotkompetensi($isi->replid,$keterampilan->idmatpel,$isi->idsiswa);
                                        if ($kompetensitextrapor<>""){
                                          echo "<br/>";
                                          echo $kompetensitextrapor;
                                        }
																					if($keterampilan->matpeldeskripsitext<>""){
																						if ($kompetensitextrapor<>""){
																							echo "<hr/>";
																						}
																						echo $keterampilan->matpeldeskripsitext;
																					}
                                        
                                      }
                                      echo "</td>";
                                      echo "<td align='center'>".$keterampilan->grouptext."</td>";
                                      if($isi->skkon==1){
                                        echo "<td align='center'>".strtoupper($keterampilan->jumlahskk)."</td>";
                                      }
                                      //if($isi->kkmon==1){
                                        echo "<td align='center'>".strtoupper($keterampilan->kkm)."</td>";
                                      //}
                                      /*
                                      if($keterampilan->detail<>1){
                                        $keterampilanmp13_tot = array_filter($keterampilanmp13[$keterampilan->idmatpel]);
                                        if(array_sum($keterampilanmp13_tot)<1){
                                            $average=0;
                                        }else{
                                            $average = array_sum($keterampilanmp13_tot)/count($keterampilanmp13_tot);
                                        }
                                        echo "<th colspan=".COUNT($arrmodultipe).">".CEIL($average)."</th>";
                                      }else{
                                      */
                                        foreach((array)$arrmodultipe as $rowmodultipe) {
                                          if (isset($keterampilanmp13[$keterampilan->idmatpel][$rowmodultipe->idmodultipe])){
                                              echo "<th width='*'>".CEIL($keterampilanmp13[$keterampilan->idmatpel][$rowmodultipe->idmodultipe])."</th>";
                                          }else{
                                            echo "<th width='*'>-</th>";
                                          }
                                        }
                                      /*}

                                      if($keterampilan->detail<>1){
                                          echo "<th colspan=".COUNT($arrmodultipe).">".strtoupper($CI->dbx->ns_predikat($isi->departemen,CEIL($average),$keterampilan->idpredikattipe))."</th>";
                                      }else{
                                      */
                                        foreach((array)$arrmodultipe as $rowmodultipe) {
                                          if (isset($keterampilanmp13[$keterampilan->idmatpel][$rowmodultipe->idmodultipe])){
                                              echo "<th width='*'>".strtoupper($CI->dbx->ns_predikat($isi->departemen,CEIL($keterampilanmp13[$keterampilan->idmatpel][$rowmodultipe->idmodultipe]),$keterampilan->idpredikattipe))."</th>";
                                          }else{
                                            echo "<th width='*'>-</th>";
                                          }
                                        }
                                      //}
                                    } //$idmatpel<>$keterampilan->idmatpel
                                /*
                                }else{ //$keterampilan->group<>"1"
                                  if($grouptext<>$keterampilan->grouptext){
                                    echo "<tr>";
                                    echo "<td align='center'>".$no++."</td>";
                                    echo "<td align='left'>".$keterampilan->grouptext;
                                    echo "</td>";
                                    echo "<td align='center'>".strtoupper($keterampilan->jumlahskk)."</td>";
                                    if($isi->kkmon==1){echo "<td align='center'>".strtoupper($keterampilan->kkm)."</td>";}

                                    if($keterampilan->detail<>1){
                                      $keterampilanmp13_tot = array_filter($keterampilanmp13group[$keterampilan->idgroup]);
                                      $average = array_sum($keterampilanmp13_tot)/(COUNT($keterampilanmp13_tot)*COUNT($matpelgroup[$keterampilan->idgroup]));
                                      echo "<th colspan=".COUNT($arrmodultipe).">".CEIL($average)."</th>";
                                    }else{
                                      foreach((array)$arrmodultipe as $rowmodultipe) {
                                        if (isset($keterampilanmp13group[$keterampilan->idgroup][$rowmodultipe->idmodultipe])){
                                            echo "<th width='*'>".CEIL($keterampilanmp13group[$keterampilan->idgroup][$rowmodultipe->idmodultipe])."</th>";
                                        }else{
                                          echo "<th width='*'>-</th>";
                                        }
                                      }
                                    }

                                    if($keterampilan->detail<>1){
                                        echo "<th colspan=".COUNT($arrmodultipe).">".strtoupper($CI->dbx->ns_predikat($isi->departemen,$average,$keterampilan->idpredikattipe))."</th>";
                                    }else{
                                      foreach((array)$arrmodultipe as $rowmodultipe) {
                                        if (isset($keterampilanmp13group[$keterampilan->idgroup][$rowmodultipe->idmodultipe])){
                                            echo "<th width='*'>".strtoupper($CI->dbx->ns_predikat($isi->departemen,$keterampilanmp13group[$keterampilan->idgroup][$rowmodultipe->idmodultipe],$keterampilan->idpredikattipe))."</th>";
                                        }else{
                                          echo "<th width='*'>-</th>";
                                        }
                                      }
                                    }
                                  }
                                } //$keterampilan->group<>"1"
                                */
                                $matkel=$keterampilan->matpelkelompok;
                                $idmatpel=$keterampilan->idmatpel;
                                $idmodultipe=$keterampilan->idmodultipe;
                                $grouptext=$keterampilan->grouptext;
                            } //foreach((array)$kelompok as $keterampilan) {

                              if ($kelompok2<>""){
                                echo "</tbody></table>";
                              }
                              ?>
                              </td>
                          </tr>
                          <tr>
                              <td><b><?php echo $header_count++ ?>. <?php echo $isi->tabeljudul_3 ?></b></td>
                          </tr>
                          <tr>
                              <td style="padding-left:30px">
                                <?php
                                //TAMPIL
                                $matkel="";$idmodultipe="";$no=1;$grouptext="";$jml_kel=0;$idmatpel="";
                                //echo var_dump($nonakademikdata)."asfdasdfasdfasd";
                                echo "<table class='table table-bordered'><thead>";
                                  echo "<tr>";
                                  echo "<th width='60' rowspan='2'>No.</th>";
                                  echo "<th rowspan='2'>Mata Pelajaran</th>";
                                  echo "<th rowspan='2'>Grup</th>";
                                  if($isi->skkon==1){
                                    echo "<th width='65' rowspan='2'>SKK</th>";
                                  }
                                  //if($isi->kkmon==1){
                                      echo "<th width='60' rowspan='2'>KKM</th>";
                                  //}
                                  echo "<th colspan=".COUNT($arrmodultipe).">Nilai</th>";
                                  if($isi->predikaton==1){
                                    echo "<th colspan=".COUNT($arrmodultipe).">Predikat</th>";
                                  }
                                  echo "</tr>";
                                  echo "<tr>";
                                  foreach((array)$arrmodultipe as $rowmodultipe) {
                                    echo "<th width='*'>Modul ".$rowmodultipe->idmodultipe."</th>";
                                  }
                                  if($isi->predikaton==1){
                                    foreach((array)$arrmodultipe as $rowmodultipe) {
                                      echo "<th width='*'>Modul ".$rowmodultipe->idmodultipe."</th>";
                                    }
                                  }
                                  echo "</tr></thead>";
                                if($nonakademikdata==""){
                                  echo "<tr><td colspan='6'>&nbsp;</td></tr>";
                                  echo "</table>";
                                }

                                foreach((array)$nonakademikdata as $nonakademik) {
                                  $nilaimp=0;$jml_kel++;
                                  //$nilaimp=$CI->ns_rapor_baru_db->hitnilai_db($isi->idkelas,$isi->idsiswa,$nonakademik->idmatpel,$isi->idtahunajaran,$isi->departemen,$isi->idregion,$isi->idrapottipe,$isi->nilaimurni,$isi->idperiode,$nonakademik->idmatpelkelompok);
                                  //echo var_dump($nilaimp);die;
                                  if ($matkel<>$nonakademik->matpelkelompok){
                                     //$no=1;
                                      if ($jml_kel<=1){
                                        
                                                  echo "<tr>";
                                                  echo "<td align='' colspan='".$csx."'><b>".ucfirst(strtolower($nonakademik->matpelkelompok))."</b></td>";
                                                  echo "</tr>";
                                                ?>
                                              </thead>
                                              <tbody>
                                        <?php
                                        } else {
                                          echo "<tr>";
                                                echo "<td align='' colspan='".$csx."'><b>".ucfirst(strtolower($nonakademik->matpelkelompok))."</b></td>";
                                                echo "</tr>";

                                        }//if $jml_kel
                                    }


                                    //if($nonakademik->groupon<>"1"){
                                        if($idmatpel<>$nonakademik->idmatpel){
                                          echo "<tr>";
                                          echo "<td align='center'>".$no++."</td>";
                                          echo "<td align='left'><a href='".site_url('ns_rapor_baru/ns_rapor_baru_detailmatpel/')."/".$id."/".$nonakademik->idmatpel."' target='_blank'>".$nonakademik->matpel.' '.$nonakademik->matpelketerangan;
                                          if($nonakademik->matpelexternal){
                                            echo "&nbsp;".$isi->external;
                                          }
                                          echo "</a>";
                                          if($isi->matpeldeskripsion){
                                            $kompetensitextrapor=$CI->dbx->ns_rapotkompetensi($isi->replid,$nonakademik->idmatpel,$isi->idsiswa);
                                            if ($kompetensitextrapor<>""){
                                              echo "<br/>";
                                              echo $kompetensitextrapor;
                                            }
                                              if($nonakademik->matpeldeskripsitext<>""){
                                                if ($kompetensitextrapor<>""){
                                                  echo "<hr/>";
                                                }
                                                echo $nonakademik->matpeldeskripsitext;
                                              }
                                            
                                          }
                                          echo "</td>";
                                          echo "<td align='center'>".$nonakademik->grouptext."</td>";
                                          if($isi->skkon==1){
                                            echo "<td align='center'>".strtoupper($nonakademik->jumlahskk)."</td>";
                                          }
                                          //if($isi->kkmon==1){
                                            echo "<td align='center'>".strtoupper($nonakademik->kkm)."</td>";
                                          //}
                                          /*
                                          if($nonakademik->detail<>1){
                                            $nonakademikmp13_tot = array_filter($nonakademikmp13[$nonakademik->idmatpel]);
                                            if(array_sum($nonakademikmp13_tot)<1){
                                                $average=0;
                                            }else{
                                                $average = array_sum($nonakademikmp13_tot)/count($nonakademikmp13_tot);
                                            }
                                            echo "<th colspan=".COUNT($arrmodultipe).">".CEIL($average)."</th>";
                                          }else{
                                          */
                                            foreach((array)$arrmodultipe as $rowmodultipe) {
                                              if (isset($nonakademikmp13[$nonakademik->idmatpel][$rowmodultipe->idmodultipe])){
                                                  echo "<th width='*'>".CEIL($nonakademikmp13[$nonakademik->idmatpel][$rowmodultipe->idmodultipe])."</th>";
                                              }else{
                                                echo "<th width='*'>-</th>";
                                              }
                                            }
                                          /*}

                                          if($nonakademik->detail<>1){
                                              echo "<th colspan=".COUNT($arrmodultipe).">".strtoupper($CI->dbx->ns_predikat($isi->departemen,CEIL($average),$nonakademik->idpredikattipe))."</th>";
                                          }else{
                                          */
                                            foreach((array)$arrmodultipe as $rowmodultipe) {
                                              if (isset($nonakademikmp13[$nonakademik->idmatpel][$rowmodultipe->idmodultipe])){
                                                  echo "<th width='*'>".strtoupper($CI->dbx->ns_predikat($isi->departemen,CEIL($nonakademikmp13[$nonakademik->idmatpel][$rowmodultipe->idmodultipe]),$nonakademik->idpredikattipe))."</th>";
                                              }else{
                                                echo "<th width='*'>-</th>";
                                              }
                                            }
                                          //}
                                        } //$idmatpel<>$nonakademik->idmatpel
                                    /*
                                    }else{ //$nonakademik->group<>"1"
                                      if($grouptext<>$nonakademik->grouptext){
                                        echo "<tr>";
                                        echo "<td align='center'>".$no++."</td>";
                                        echo "<td align='left'>".$nonakademik->grouptext;
                                        echo "</td>";
                                        echo "<td align='center'>".strtoupper($nonakademik->jumlahskk)."</td>";
                                        if($isi->kkmon==1){echo "<td align='center'>".strtoupper($nonakademik->kkm)."</td>";}

                                        if($nonakademik->detail<>1){
                                          $nonakademikmp13_tot = array_filter($nonakademikmp13group[$nonakademik->idgroup]);
                                          $average = array_sum($nonakademikmp13_tot)/(COUNT($nonakademikmp13_tot)*COUNT($matpelgroup[$nonakademik->idgroup]));
                                          echo "<th colspan=".COUNT($arrmodultipe).">".CEIL($average)."</th>";
                                        }else{
                                          foreach((array)$arrmodultipe as $rowmodultipe) {
                                            if (isset($nonakademikmp13group[$nonakademik->idgroup][$rowmodultipe->idmodultipe])){
                                                echo "<th width='*'>".CEIL($nonakademikmp13group[$nonakademik->idgroup][$rowmodultipe->idmodultipe])."</th>";
                                            }else{
                                              echo "<th width='*'>-</th>";
                                            }
                                          }
                                        }

                                        if($nonakademik->detail<>1){
                                            echo "<th colspan=".COUNT($arrmodultipe).">".strtoupper($CI->dbx->ns_predikat($isi->departemen,$average,$nonakademik->idpredikattipe))."</th>";
                                        }else{
                                          foreach((array)$arrmodultipe as $rowmodultipe) {
                                            if (isset($nonakademikmp13group[$nonakademik->idgroup][$rowmodultipe->idmodultipe])){
                                                echo "<th width='*'>".strtoupper($CI->dbx->ns_predikat($isi->departemen,$nonakademikmp13group[$nonakademik->idgroup][$rowmodultipe->idmodultipe],$nonakademik->idpredikattipe))."</th>";
                                            }else{
                                              echo "<th width='*'>-</th>";
                                            }
                                          }
                                        }
                                      }
                                    } //$nonakademik->group<>"1"
                                    */
                                    $matkel=$nonakademik->matpelkelompok;
                                    $idmatpel=$nonakademik->idmatpel;
                                    $idmodultipe=$nonakademik->idmodultipe;
                                    $grouptext=$nonakademik->grouptext;
                                } //foreach((array)$kelompok as $nonakademik) {

                                  if ($nonakademikdata<>""){
                                    echo "</tbody></table>";
                                  }
                                  ?>
                                  </td>
                              </tr>
                          <tr>
                              <td><b><?php echo $header_count++ ?>. <?php echo $isi->tabeljudul_4 ?></b></td>
                          </tr>
                          <tr>
                              <td style="padding-left:30px">
                                <?php
                                    $no=1;
                                    echo " <table class='table table-bordered' width='100%'>";
                                    echo "<tr>";
                                    echo "<th width='50px'>No.</th>";
                                    echo "<th>Kegiatan Ekstrakurikuler</th>";
                                    echo "<th>Predikat</th>";
                                    echo "<th>Deskripsi</th>";
                                    echo "</tr>";
                                    $noekstrakurikuler=1;
                                    foreach((array)$ekstrakurikulerrapot as $rowekstrakurikuler) {
                                      echo "<tr>";
                                      echo "<td>".$noekstrakurikuler++."</td>";
                                      echo "<td>".$rowekstrakurikuler->kegiatanekstrakurikuler."</td>";
                                      echo "<td>".$rowekstrakurikuler->predikatekstrakurikuler."</td>";
                                      echo "<td>".$rowekstrakurikuler->deskripsiekstrakurikuler."</td>";
                                      echo "</tr>";
                                    }
                                    echo "</table>";
                                ?>
                              </td>
                          </tr>
                          <?php if ($isi->prestasi=="1"){ ?>
                          <tr>
                              <td><b><?php echo $header_count++ ?>. Kegiatan</b></td>
                          </tr>
                          <tr>
                              <td style="padding-left:30px">
                                <table class="table table-bordered table-striped">
                                  <tr>
                                      <?php
                                      echo "<th width='50'>No.</th>";
                                      echo "<th width='30%'>Jenis Kegiatan</th>";
                                      echo "<th>Prestasi</th>";
                                      ?>
                                  </tr>
                                  <?php
                                  $noprestasi=1;
                                  foreach((array)$prestasirapot as $rowprestasi) {
                                    echo "<tr>";
                                    echo "<td>".$noprestasi++."</td>";
                                    echo "<td>".$rowprestasi->jeniskegiatan."</td>";
                                    echo "<td>".$rowprestasi->prestasi."</td>";
                                    echo "</tr>";
                                  }
                                  ?>
                                </table>
                              </td>
                          </tr>
                          <?php } ?>
                          <?php if ($isi->catatan_wk=="1"){ ?>
                          <tr>
                              <td><b><?php echo $header_count++ ?>. Catatan Wali Kelas</b></td>
                          </tr>
                          <tr>
                              <td style="padding-left:30px">
                                 <table class='table table-bordered' width='100%'>
                                <tr>
                                  <td valign="top" height="70px">
                                      <?php
                                          echo $isi->keterangan;
                                      ?>
                                  </td>
                                </tr>
                              </table>
                              </td>
                          </tr>
                          <?php } ?>
                          <tr>
                              <td><b><?php echo $header_count++ ?>. Tanggapan Orang Tua/Wali</b></td>
                          </tr>
                          <tr>
                              <td style="padding-left:30px">
                                 <table class='table table-bordered' width='100%'>
                                <tr>
                                  <td valign="top" height="70px"> &nbsp;
                                  </td>
                                </tr>
                              </table>
                              </td>
                          </tr>
                          <?php if ($isi->fisik=="1"){ ?>
                          <tr>
                              <td><b><?php echo $header_count++ ?>. Tinggi dan Berat Badan</b></td>
                          </tr>
                          <tr>
                              <td style="padding-left:30px">
                                <table class='table table-bordered' width='100%'>
                                 <tr>
                                     <?php
                                     echo "<th>Aspek Fisik</th>";
                                     echo "<th width='20%'>Keterangan</th>";
                                     ?>
                                 </tr>
                                 <?php
                                   echo "<tr>";
                                   echo "<td>Tinggi Badan</td>";
                                   echo "<td>".$isi->tinggi." Cm</td>";
                                   echo "</tr>";
                                   echo "<tr>";
                                   echo "<td>Berat Badan</td>";
                                   echo "<td>".$isi->berat." Kg</td>";
                                   echo "</tr>";
                                 ?>
                               </table>
                              </td>
                          </tr>
                          <?php } ?>
                          <?php if ($isi->kesehatan=="1"){ ?>
                          <tr>
                              <td><b><?php echo $header_count++ ?>. Kondisi Kesehatan</b></td>
                          </tr>
                          <tr>
                              <td style="padding-left:30px">
                                <table class='table table-bordered' width='100%'>
                                 <tr>
                                     <?php
                                     echo "<th>Aspek Fisik</th>";
                                     echo "<th width='20%'>Keterangan</th>";
                                     ?>
                                 </tr>
                                 <?php
                                   echo "<tr>";
                                   echo "<td>Pendengaran</td>";
                                   echo "<td>".$isi->pendengaran."</td>";
                                   echo "</tr>";
                                   echo "<tr>";
                                   echo "<td>Penglihatan</td>";
                                   echo "<td>".$isi->penglihatan."</td>";
                                   echo "</tr>";
                                   echo "<tr>";
                                   echo "<td>Gigi</td>";
                                   echo "<td>".$isi->gigi."</td>";
                                   echo "</tr>";

                                 ?>
                               </table>
                              </td>
                          </tr>
                          <?php } ?>
                          <?php if ($isi->absensi=="1"){ ?>
                          <tr>
                              <td><b><?php echo $header_count++ ?>. Ketidakhadiran</b></td>
                          </tr>
                          <tr>
                              <td style="padding-left:30px">
                                <table class='table table-bordered' width='100%'>
                                 <tr>
                                     <?php
                                     echo "<th>Ketidakhadiran</th>";
                                     echo "<th width='20%'>Jumlah</th>";
                                     ?>
                                 </tr>
                                 <?php
                                   echo "<tr>";
                                   echo "<td>Sakit</td>";
                                   echo "<td>".$hadirdata->sakit." Hari</td>";
                                   echo "</tr>";
                                   echo "<tr>";
                                   echo "<td>Izin</td>";
                                   echo "<td>".$hadirdata->izin." Hari</td>";
                                   echo "</tr>";
                                   echo "<tr>";
                                   echo "<td>Tanpa Keterangan</td>";
                                   echo "<td>".$hadirdata->alpha." Hari</td>";
                                   echo "</tr>";
                                 ?>
                               </table>
                              </td>
                          </tr>
                          <?php } ?>
                          <tr>
                              <td><b><?php echo $header_count++ ?>. Keputusan</b></td>
                          </tr>
                          <tr>
                              <td style="padding-left:30px">
                                 <table class='table table-bordered' width='100%'>
                                <tr>
                                  <td valign="top" align="left" height="70px">
                                    Berdasarkan hasil yang dicapai pada semester 1 dan 2 maka peserta didik ditetapkan :<br/>

                                    <?php 
                                      switch ($isi->idnaikkelas) {
                                        case '1':
                                            echo "Naik Ke Kelas: ".$CI->p_c->romawi($isi->idnaiktingkattext)."<br/>";
                                            echo "<strike>Tidak Naik Kelas</strike>";
                                          break;
                                        case '2':
											                      echo "<strike>Naik Ke Kelas</strike><br/>";
                                            echo "Tidak Naik Dikelas: ".$CI->p_c->romawi($isi->idnaiktingkattext)."";
                                          break;
                                        default:
                                          echo "&nbsp;";
                                          break;
                                      }
                                    ?>
                                  </td>
                                </tr>
                              </table>
                              </td>
                          </tr>
                    </table>
  <?php
  }

  if (($isi->catatan_wk==1) AND ($isi->tipe<>'Reguler')){?>
    <table class="table table-bordered">
        <tr><th>Catatan Wali Kelas</th></tr>
        <tr><th><?php echo $isi->keterangan ?></th></tr>
    </table>

  <?php }
  if (($isi->absensi==1) AND ($isi->tipe<>'Reguler')){?>
  <table class="table table-bordered">
      <tr><th colspan="3">Absensi</th></tr>
      <tr><th width="100">Sakit</th><th width="30">:</th><td><?php echo $hadirdata->sakit ?> Hari</td></tr>
      <tr><th>Izin</th><th>:</th><td><?php echo $hadirdata->izin ?> Hari</td></tr>
      <tr><th>Tanpa Keterangan</th><th>:</th><td><?php echo $hadirdata->alpha ?> Hari</td></tr>
  </table>
  <?php } ?>
  <?php
  if (($isi->aktiftahunajaran==1) and ($isi->deletethis<>1)){
    if (trim($isi->created_by)==$this->session->userdata('idpegawai')){

      //echo "<a href=javascript:void(window.open('".site_url('ns_rapor_baru/penilaian/'.$row->replid)."/0'))>
      //			<button class='btn btn-xs btn-info'>Penilaian</button>
      //		</a>";
      //if ($row->nilaipd<=0){
        echo "<a href=javascript:void(window.open('".site_url('ns_rapor_baru/duplikasi/'.$isi->replid)."')) class='btn btn-info'>Duplikasi</a>&nbsp;"; 
        echo "<a href=javascript:void(window.open('".site_url('ns_rapor_baru/tambah/'.$isi->replid)."')) class='btn btn-warning'>Ubah</a>&nbsp;";
        echo "<a href=javascript:void(window.open('".site_url('ns_rapor_baru/hapus/'.$isi->replid)."')) class='btn btn-danger' id='btnOpenDialog'>Hapus</a>&nbsp";
      //}
    }
  }
  echo "<a href=javascript:void(window.open('".site_url('ns_rapor_baru')."')) class='btn btn-success'>Kembali</a>&nbsp";
}
?>
  </section>
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
    </body>
</html>
