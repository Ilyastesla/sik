<!DOCTYPE html>
<html>
<script language="javascript">
function cetakabsensi(id) {
	newWindow('../../printabsensi/'+id, 'cetakabsensi','900','800','resizable=1,scrollbars=1,status=0,toolbar=0')
}
</script>
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
                        <li><a href="javascript:void(window.open('<?php echo site_url('ns_pembelajaranjadwal/tambah'); ?>'))" ><i class="fa fa-plus-square"></i> Tambah</a></li>
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
                    <td align="left">
					<?php
                        $arridcompany="data-rule-required=true id=idcompany onchange='javascript:this.form.submit();'";
                        echo form_dropdown('idcompany',$idcompany_opt,$this->input->post('idcompany'),$arridcompany);
                        ?>
                            <?php //echo  <p id="message"></p> ?>
                      </td>
				<td align="left" width="150">Jenjang</td>
                    <td align="left">
					<?php
          						                		$arriddepartemen='data-rule-required=false onchange=javascript:this.form.submit();';
          						                		echo form_dropdown('iddepartemen',$iddepartemen_opt,$this->input->post('iddepartemen'),$arriddepartemen);
          						                	?>
                            <?php //echo  <p id="message"></p> ?>
                      </td>
            </tr>
			            <tr>
                     <td align="left" width="150">Tahun Pelajaran</td>
                    <td align="left">
											<div class="control-group">
                      <?php
                          $arridtahunajaran="data-rule-required=true id=idtahunajaran onchange='javascript:this.form.submit();' ";
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
                   <td align="left" width="150">Tipe Proses</td>
                   <td align="left">
                     <?php
                           $arridprosestipe="data-rule-required=false id='idprosestipe'";
                           echo form_dropdown('idprosestipe',$idprosestipe_opt,$this->input->post('idprosestipe') ,$arridprosestipe);
                       ?>
                   </td>

			            </tr>
                  <tr>
                    <td align="left" width="150">Mata Pelajaran</td>
                    <td align="left">
                      <?php
                        $arridmatpel="data-rule-required=false id=idmatpel";
                        echo form_dropdown('idmatpel',$idmatpel_opt,$this->input->post('idmatpel'),$arridmatpel);
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
			            <tr>
                    <!--
                    <td align="left" width="150">Region</td>
                    <td align="left">
                      <?php
                          $arridregion="data-rule-required=false id=idregion";
                          echo form_dropdown('idregion',$idregion_opt,$this->input->post('idregion'),$arridregion);
                        ?>
                    </td>
                  -->
			            </tr>
						<tr>
				<td align="left" width="150">Periode</td>
                    <td align="left" colspan="3">
                          <?php
                            echo form_input(array('class' => '', 'id' => 'dp1','name'=>'periode1','value'=>$this->input->post('periode1'),'data-rule-required'=>'false' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'2' ,'placeholder'=>'DD-MM-YYYY','autocomplete'=>'off'));
                            echo "&nbsp;".form_input(array('class' => '', 'id' => 'dp2','name'=>'periode2','value'=>$this->input->post('periode2'),'data-rule-required'=>'false' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'2' ,'placeholder'=>'DD-MM-YYYY','autocomplete'=>'off'));
                            ?>
                            <?php //echo  <p id="message"></p> ?>
                      </td>
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
                                                <th>Tipe Proses</th>
																								<th>Modul</th>
                                                <th>Petugas</th>
                                                <th>Mata Pelajaran</th>
                                                <th>Tema</th>
                                                <!-- <th>Departemen</th> -->
                                                <th>Kelas</th>
                                                <!-- <th>Regional</th> -->
                                                <th>Tahun Pelajaran</th>
                                                <th>Semester</th>
                                                <th>Tgl. Kegiatan</th>
                                                <th>Non Reguler</th>
																								<th>Jumlah Siswa</th>
																								<th>Siswa Jadwal</th>
                                                <th>aktif</th>
                                                <th width="80">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        	<?php
                                        	$no=1;
											foreach((array)$show_table as $row) {
											    echo "<tr>";
											    echo "<td align='center'>".$no++."</td>";
											    echo "<td align=''><a href='".site_url('ns_pembelajaranjadwal/penilaian/'.$row->replid)."/0' target='_blank' >".strtoupper($row->prosestipe)."</a></td>";
													echo "<td align=''>".$row->idmodultipe."</td>";
											    echo "<td align=''>".strtoupper($CI->dbx->getpegawai($row->created_by,0,1))."</td>";
											    echo "<td align=''>".strtoupper($row->matpel)."</td>";
											    echo "<td align=''>".strtoupper($row->keterangan)."</td>";
											    // echo "<td align=''>".strtoupper($row->iddepartemen)."</td>";
											    echo "<td align='center'>".strtoupper($row->kelas)."</td>";
											    //echo "<td align='center'>".strtoupper($row->region)."</td>";
											    echo "<td align='center'>".strtoupper($row->tahunajaran)."</td>";
											    echo "<td align='center'>".strtoupper($row->periode)."</td>";
											    echo "<td align='center'>".strtoupper($CI->p_c->tgl_indo($row->tanggalkegiatan))."</td>";
                          echo "<td align='center'>".($CI->p_c->cekaktif($row->nonreguler))."</td>";
													echo "<td align='center'>".$row->jmlsiswa."</td>";
													echo "<td align='center'>".$CI->p_c->cektrue(($row->jmlsiswa==$row->jumlahpd),$row->jumlahpd)."</td>";
													echo "<td align='center'>".$CI->p_c->cekaktif($row->aktif)."</td>";
											    echo "<td align='center'>";
													if ($row->deletethis<>1){
													// if ($row->aktiftahunajaran==1){
														if ((trim($row->created_by)==$this->session->userdata('idpegawai')) or (($row->idwali==$this->session->userdata('idpegawai')) AND ($row->nilaiwali==1))){

															echo "<a href=javascript:void(window.open('".site_url('ns_pembelajaranjadwal/penilaian/'.$row->replid)."/1')) class='btn btn-xs btn-info'>Penilaian</a> ";
															//if ($row->status<=0){
															if (trim($row->created_by)==$this->session->userdata('idpegawai')){
															echo "<a href=javascript:void(window.open('".site_url('ns_pembelajaranjadwal/ubah/'.$row->replid)."')) class='btn btn-xs btn-warning' >Ubah</a>";
															//echo "<a href=javascript:void(window.open('".site_url('ns_pembelajaranjadwal/hapus/'.$row->replid)."')) class='btn btn-xs btn-danger' id='btnOpenDialog' >Hapus</a>";
															echo "</td>";
															}
															//}
														}
													//}
													}else{
														echo "<div style='background-color:red;text-align:center;'><b>Data Telah Dihapus</b></div>";
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
	          data:{modul:'idkelas',id:0},
	          success: function(respond){
	            $("#idkelas").html(respond);
	          }
	        });
			$.ajax({
	          data:{modul:'idprosestipe',id:0,idcompany:0},
	          success: function(respond){
	            $("#idprosestipe").html(respond);
	          }
	        });

			$.ajax({
				data:{modul:'idrapottipediv',id:0,idcompany:0},
				success: function(respond){
					$("#divrapottipe").html(respond);
				}
			});
			
	        $.ajax({
	          data:{modul:'idmatpel',id:0,idcompany:$("#idcompany").val()},
	          success: function(respond){
	            $("#idmatpel").html(respond);
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
	          data:{modul:'idkelas',id:0},
	          success: function(respond){
	            $("#idkelas").html(respond);
	          }
	        });
			$.ajax({
	          data:{modul:'idprosestipe',id:0,idcompany:0},
	          success: function(respond){
	            $("#idprosestipe").html(respond);
	          }
	        });

			$.ajax({
				data:{modul:'idrapottipediv',id:0,idcompany:0},
				success: function(respond){
					$("#divrapottipe").html(respond);
				}
			});
	        $.ajax({
	          data:{modul:'idmatpel',id:0,idcompany:$("#idcompany").val()},
	          success: function(respond){
	            $("#idmatpel").html(respond);
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
	          data:{modul:'idprosestipe',id:0,idcompany:0},
	          success: function(respond){
	            $("#idprosestipe").html(respond);
	          }
	        });

			$.ajax({
				data:{modul:'idrapottipediv',id:0,idcompany:0},
				success: function(respond){
					$("#divrapottipe").html(respond);
				}
			});
	        $.ajax({
	          data:{modul:'idmatpel',id:0,idcompany:$("#idcompany").val()},
	          success: function(respond){
	            $("#idmatpel").html(respond);
	          }
	        });

	    });
		$("#idkelas").change(function(){
	      	var value=$(this).val();
	        $.ajax({
	          data:{modul:'idmatpel',id:value,idcompany:$("#idcompany").val()},
	          success: function(respond){
	            $("#idmatpel").html(respond);
	          }
	        });
			$.ajax({
	          data:{modul:'idprosestipe',id:value,idcompany:$("#idcompany").val()},
	          success: function(respond){
	            $("#idprosestipe").html(respond);
	          }
	        });
			$.ajax({
				data:{modul:'idrapottipediv',id:value,idcompany:$("#idcompany").val()},
				success: function(respond){
					$("#divrapottipe").html(respond);
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
                <!--
		            <tr>
		            <th align="left">
		        		<label class="control-label" for="minlengthfield">Regional</label>
		        		<div class="control-group">
							<div class="controls">:
		                	<?php
		                		$arridregion="data-rule-required=true id=idregion";
		                		echo form_dropdown('idregion',$idregion_opt,$idregion,$arridregion);
		                	?>
		                	<?php //echo  <p id="message"></p> ?>
							</div>
		        		</div>
		            </th></tr>
              -->
			  <tr>
  		            <th align="left">
  		        		<label class="control-label" for="minlengthfield">Mata Pelajaran</label>
  		        		<div class="control-group">
                    <input type="hidden" value="" name="idregion" id="idregion">
  							<div class="controls">:
  		                	<?php
                        //onchange=refresh(".$edit.")
  		                		$arridmatpel="data-rule-required=true id=idmatpel";
  		                		echo form_dropdown('idmatpel',$idmatpel_opt,$isi->idmatpel,$arridmatpel);
  		                	?>
  		                	<?php //echo  <p id="message"></p> ?>
  							</div>
  		        		</div>
  		            </th></tr>
                <tr>
                  <th align="left">
                  <label class="control-label" for="minlengthfield">Tipe Proses</label>
                  <div class="control-group">
                <div class="controls">:
                        <?php
                          $arridprosestipe="data-rule-required=true id=idprosestipe";
                          echo form_dropdown('idprosestipe',$idprosestipe_opt,$isi->idprosestipe,$arridprosestipe);
                        ?>
                        <?php //echo  <p id="message"></p> ?>
						Perubahan tipe proses dapat menghilangkan nilai yang sudah diisi!.
                </div>
                  </div>
                  </th></tr>
		    		<tr>
				            <th align="left">
		                		<label class="control-label" for="minlengthfield">Tema</label>
		                		<div class="control-group">
									<div class="controls" valign="top">&nbsp;&nbsp;
				                	<?php
				                		//if($keterangan2==""){$keterangan=$isi->keterangan;}else{$keterangan=$keterangan2;}
				                		echo form_textarea(array('class' => '', 'id' => 'keterangan','name'=>'keterangan','value'=>$isi->keterangan,'data-rule-required'=>'false' ,'data-rule-maxlength'=>'500', 'data-rule-minlength'=>'2' ,'placeholder'=>'Masukkan 2-500 Karakter'));
				                	?>
				                	<?php //echo  <p id="message"></p> ?>
									</div>
		                		</div>
				            </th></tr>
				    <tr>
			            <th align="left">
	                		<label class="control-label" for="minlengthfield">Tgl. Kegiatan</label>
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
					 <!--
		            <tr>
		            <th align="left">
		        		<label class="control-label" for="minlengthfield">Rapor Tipe</label>
		        		<div class="control-group">
		        			<div class="controls">
											<input type="checkbox" onClick="selectallx('idrapottipe','selectall')" id="selectall" class="selectall"/> Pilih Semua <hr/>
											<div id='divrapottipe'>
											<?php
		                		$CI->p_c->checkbox_one('idrapottipe',$idrapottipe_opt);
		                	?>
		                	<?php //echo  <p id="message"></p> ?>
											</div>
							</div>
		        		</div>
		            </th></tr>
					-->
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
		        		<label class="control-label" for="minlengthfield">Rapor Tengah Semester</label>
		        		<div class="control-group">
							<div class="controls">:
		                	<?php
		                		$fcdata=array('name'=>'raports','id'=>'raports','value'=>'1','checked'=>$isi->raports);
		                		echo form_checkbox($fcdata);
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
		                		$fcdata=array('name'=>'aktif','id'=>'aktif','value'=>'1','checked'=>$isi->aktif);
		                		echo form_checkbox($fcdata);
		                	?>
		                	<?php //echo  <p id="message"></p> ?>
							</div>
		        		</div>
		            </th></tr>
				    <tr>
				            <th align="left">
				            	<button class='btn btn-primary'>Simpan</button>
				            	<a href="javascript:void(window.open('<?php echo site_url("ns_pembelajaranjadwal") ?>'))" class="btn btn-success">Kembali</a>
				            </th>
				    </tr>
		            </table>
		        	<?php
		        	echo form_close();
		        	?>
	    </section>
<!-------------------------------------------------------------------------------------------------------------------------------------->
<?php } elseif($view=='penilaian'){ ?>
<section class="content-header table-responsive">
	            <h1>
	                <?php echo $form ?>
	                <small><?php echo $form_small ?></small>
	            </h1>
              <ol class="breadcrumb">
			  <?php if($isi->deletethis<>1){ ?>
                    <li><a href="JavaScript:cetakabsensi('<?=$isi->replid?>')"><i class="fa fa-file-text"></i>&nbsp;&nbsp;Cetak</a></li>
					<?php } ?>
					<li><a href="<?php echo site_url("ns_pembelajaranjadwal/tambah") ?>" target="_blank"><i class="fa fa-plus"></i>&nbsp;Tambah</a></li>
                  </ol>
				
              </th>
            </section>
            <section class="content">
			<?php if($isi->deletethis==1){ ?>
      <div style="background-color:red;text-align:center;"><h2>Data Telah Dihapus</h2></div>
      <?php } ?>
		        <?php
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
                  		echo $isi->companytext." (".$isi->iddepartemen.")";
                  	?>
  					</div>
          		</div>
              </th></tr>
			        <tr>
		            <th align="left">
		        		<label class="control-label" for="minlengthfield">Tipe Proses</label>
		        		<div class="control-group">
							<div class="controls">:
		                	<?php
		                		echo $isi->prosestipe;
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
		                	<?php //echo  <p id="message"></p> ?>
							</div>
		        		</div>
		            </th></tr>
		            <tr>
		            <th align="left">
		        		<label class="control-label" for="minlengthfield">Kelas</label>
		        		<div class="control-group">
							<div class="controls">:
		                	<?php
		                		echo $isi->kelas;
		                	?>
		                	<?php //echo  <p id="message"></p> ?>
							</div>
		        		</div>
		            </th></tr>
                <!--
                <tr>
		            <th align="left">
		        		<label class="control-label" for="minlengthfield">Region</label>
		        		<div class="control-group">
							<div class="controls">:
		                	<?php
		                		echo $isi->region;
		                	?>
		                	<?php //echo  <p id="message"></p> ?>
							</div>
		        		</div>
		            </th></tr>
              -->
		            <tr>
		            <th align="left">
		        		<label class="control-label" for="minlengthfield">Mata Pelajaran</label>
		        		<div class="control-group">
							<div class="controls">:
		                	<?php
		                		echo $isi->matpel;
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
		                		echo $isi->kkm;
		                	?>
							</div>
		        		</div>
		            </th></tr>
		    		<tr>
				            <th align="left">
		                		<label class="control-label" for="minlengthfield">Tema</label>
		                		<div class="control-group">
									<div class="controls">:
				                	<?php
				                		echo $isi->keterangan;
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
				                		echo $isi->periode;
				                	?>
				                	<?php //echo  <p id="message"></p> ?>
									</div>
								</div>
							</th></tr>
							<tr>
						            <th align="left">
				                		<label class="control-label" for="minlengthfield">Modul</label>
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
	                		<label class="control-label" for="minlengthfield">Tgl. Kegiatan</label>
	                		<div class="control-group">
								<div class="control-group">
									<div class="controls">:
				                	<?php
				                		echo $CI->p_c->tgl_indo($isi->tanggalkegiatan);
				                	?>
				                	<?php //echo  <p id="message"></p> ?>
									</div>
								</div>
	                		</div>
			            </th>
			         </tr>
					 <!--
		            <tr>
		            <th align="left">
		        		<label class="control-label" for="minlengthfield">Rapor Tipe</label>
		        		<div class="control-group">
		        			<div class="controls">
		                	<?php
		                		$CI->p_c->checkbox_one('idrapottipe',$idrapottipe_opt,"disabled");
		                	?>
		                	<?php //echo  <p id="message"></p> ?>
							</div>
		        		</div>
		            </th></tr>
-->
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
		            <tr>
				    <th align="left">
		        		<label class="control-label" for="minlengthfield">Aktif</label>
		        		<div class="control-group">
							<div class="controls">:
		                	<?php
		                		echo $CI->p_c->cekaktif($isi->aktif)
		                	?>
		                	<?php //echo  <p id="message"></p> ?>
							</div>
		        		</div>
		            </th></tr>
                <tr>
    			            <th align="left">
    	                		<label class="control-label" for="minlengthfield">Petugas</label>
    	                		<div class="control-group">
    								<div class="control-group">
    									<div class="controls">:
    				                	<?php
    				                		echo $CI->p_c->tgl_indo($isi->created_date);
                                echo " Oleh ".$CI->dbx->getpegawai($isi->created_by,0,1);
    				                	?>
    				                	<?php //echo  <p id="message"></p> ?>
    									</div>
    								</div>
    	                		</div>
    			            </th>
    			         </tr>
                <tr>
    			            <th align="left">
    	                		<label class="control-label" for="minlengthfield">Tgl. Revisi</label>
    	                		<div class="control-group">
    								<div class="control-group">
    									<div class="controls">:
    				                	<?php
    				                		echo $CI->p_c->tgl_indo($isi->modified_date);
                                echo " Oleh ".$CI->dbx->getpegawai($isi->modified_by,0,1);
    				                	?>
    				                	<?php //echo  <p id="message"></p> ?>
    									</div>
    								</div>
    	                		</div>
    			            </th>
    			         </tr>
		            </table>
		            <hr/>
								<div class="box-body table-responsive">
                <p align="left"><b>Legend : D=Terdaftar, A= Alpha, S=Sakit, I= Izin, TP=Tugas Pengganti</b></p>
                <hr/>
		            <table class="table table-bordered table-striped">
						<?php 
							if ($edit==1){
						?>
							<tr>
								<td colspan=3 align="right">Isi Bersamaan :</td>
								<td><input type="checkbox" onClick="selectallx('terdaftar','selectall')" id="selectall" class="selectall"/></td>
								<td colspan=4></td>
								<?php
											$pdv="";
											foreach((array)$pengembangandirivariabel as $rowpdv) {
												?>
												<td align='center'><input type='text' id='jml<?php echo $rowpdv->replid?>' value='' onchange="inputall('jml<?php echo $rowpdv->replid?>','selectall')" style='width:50px;'></td>
												<?php
											}
										?>
								
							</tr>
							<?php 
							}
							?>
				    	    <tr>
								<th width="30">No.</th>
								<th width="80">NIS</th>
								<th>Nama</th>
								<th width="30">D</th>
								<th width="30">A</th>
								<th width="30">S</th>
								<th width="30">I</th>
								<th width="30">TP</th>
										<?php
											$pdv="";
											foreach((array)$pengembangandirivariabel as $rowpdv) {
												if($pdv<>""){$pdv=$pdv.',';}
												echo "<th>".$rowpdv->pengembangandirivariabel." ".$rowpdv->keterangan."</th>";
												$pdv=$pdv.$rowpdv->replid;
											}
										?>
							</tr>
				         <?php
				         	 $rs="";$no=1;
					         foreach((array)$siswa as $rowsiswa) {
                     if($isi->nonreguler<>1){
                       $idregionsiswa=$rowsiswa->siswaregion;
                     }else{
                       $idregionsiswa=$rowsiswa->regionalstatus;
                     }

                     if ($rowsiswa->region<>""){
                        $idregionpdn=$rowsiswa->region;
                     }else{
                        $idregionpdn=$idregionsiswa;
                     }

					         	if($rs<>""){$rs=$rs.',';}
					         	echo "<tr align='center'>";
					         	echo "<td>".$no++."</td>";
					         	echo "<td>".$rowsiswa->nis
                                      ."<input type='hidden' name='idregion".$rowsiswa->replid."' id='idregion".$rowsiswa->replid."' value='".$idregionpdn."'>"
                                      ."<input type='hidden' name='idregionsiswa".$rowsiswa->replid."' id='idregionsiswa".$rowsiswa->replid."' value='".$idregionsiswa."'>
                             </td>";
					         	echo "<td><b>".$rowsiswa->nama."</b><br/>Regional: ".$rowsiswa->regiontext." <br/> Tgl. Msk : ".$CI->p_c->tgl_indo($rowsiswa->tgl_masuk);
                    if ($edit==1){
						        	$fcdata=array('name'=>'ubahregion'.$rowsiswa->replid,'id'=>'ubahregion','value'=>'1');
                      echo "&nbsp;".form_checkbox($fcdata);
					         	}
                    echo "</td>";
                    echo "<td>";

					         	$value=0;$readonly="";
					         	if ($rowsiswa->terdaftar==""){
						         	if ($edit==1){
							        	$value=$rowsiswa->dftr;
						         	}
						        }else{
						         	$value=$rowsiswa->terdaftar;
					         	}

					         	if ($edit==1){
						        	$fcdata=array('name'=>'terdaftar'.$rowsiswa->replid,'id'=>'terdaftar','value'=>'1','checked'=>$value);
					         	}else{
						         	$fcdata=array('name'=>'terdaftar'.$rowsiswa->replid,'id'=>'terdaftar','value'=>'1','checked'=>$value,'disabled'=>'disabled');
					         	}
		                echo form_checkbox($fcdata);
					         	echo "</td>";
                    echo "<td>"; // alpha
					         	$valuealpha=0;$readonlyalpha="";
					         	if ($rowsiswa->alpha==""){
						         	if ($edit==1){
							        	$valuealpha=$rowsiswa->alpha;
						         	}
						        }else{
						         	$valuealpha=$rowsiswa->alpha;
					         	}

					         	if ($edit==1){
						        	$fcdata=array('name'=>'alpha'.$rowsiswa->replid,'id'=>'alpha','value'=>'1','checked'=>$valuealpha);
					         	}else{
						         	$fcdata=array('name'=>'alpha'.$rowsiswa->replid,'id'=>'alpha','value'=>'1','checked'=>$valuealpha,'disabled'=>'disabled');
					         	}
		                echo form_checkbox($fcdata);
					         	echo "</td>";
                    echo "<td>"; // sakit
					         	$valuesakit=0;$readonlysakit="";
					         	if ($rowsiswa->sakit==""){
						         	if ($edit==1){
							        	$valuesakit=$rowsiswa->sakit;
						         	}
						        }else{
						         	$valuesakit=$rowsiswa->sakit;
					         	}

					         	if ($edit==1){
						        	$fcdata=array('name'=>'sakit'.$rowsiswa->replid,'id'=>'sakit','value'=>'1','checked'=>$valuesakit);
					         	}else{
						         	$fcdata=array('name'=>'sakit'.$rowsiswa->replid,'id'=>'sakit','value'=>'1','checked'=>$valuesakit,'disabled'=>'disabled');
					         	}
		                echo form_checkbox($fcdata);
					         	echo "</td>";
                    echo "<td>"; // izin
					         	$valueizin=0;$readonlyizin="";
					         	if ($rowsiswa->izin==""){
						         	if ($edit==1){
							        	$valueizin=$rowsiswa->izin;
						         	}
						        }else{
						         	$valueizin=$rowsiswa->izin;
					         	}

					         	if ($edit==1){
						        	$fcdata=array('name'=>'izin'.$rowsiswa->replid,'id'=>'izin','value'=>'1','checked'=>$valueizin);
					         	}else{
						         	$fcdata=array('name'=>'izin'.$rowsiswa->replid,'id'=>'izin','value'=>'1','checked'=>$valueizin,'disabled'=>'disabled');
					         	}
		                echo form_checkbox($fcdata);
					         	echo "</td>";
                    echo "<td>"; // Tugas Pengganti
					         	$valuetugas=0;$readonlytugas="";
					         	if ($rowsiswa->tugas==""){
						         	if ($edit==1){
							        	$valuetugas=$rowsiswa->tugas;
						         	}
						        }else{
						         	$valuetugas=$rowsiswa->tugas;
					         	}

					         	if ($edit==1){
						        	$fcdata=array('name'=>'tugas'.$rowsiswa->replid,'id'=>'tugas','value'=>'1','checked'=>$valuetugas);
					         	}else{
						         	$fcdata=array('name'=>'tugas'.$rowsiswa->replid,'id'=>'tugas','value'=>'1','checked'=>$valuetugas,'disabled'=>'disabled');
					         	}
		                echo form_checkbox($fcdata);
					         	echo "</td>";
					         	foreach((array)$pengembangandirivariabel as $rowpdv2) {
									$idnilai=$rowsiswa->replid.'/'.$rowpdv2->replid;
									$nilaipdv=0;
									foreach ((array)$pengembangandirinilai as $key) {
										if ($key->idnilai == $idnilai) {
											$nilaipdv=$key->nilai;
										}
									}
                      /*
                      $sqln="SELECT nilai FROM ns_pengembangandirinilai WHERE idpembelajaranjadwal='".$isi->replid."' AND idsiswa='".$rowsiswa->replid."' AND idpengembangandirivariabel='".$rowpdv2->replid."'";
					         		$n=$CI->dbx->rows($sqln);
					         		if (isset($n)){
						         		$nilaipdv=$n->nilai;
					         		}else{
						         		$nilaipdv=0;
					         		}
                      */
                      //$nilaipdv=0;
					         		if ($edit==1){
										?>
										<td><input type='text' name='jml<?php echo $rowpdv2->replid.'/'.$rowsiswa->replid?>' onchange="maxvalue('jml<?php echo $rowpdv2->replid.'/'.$rowsiswa->replid ?>')" id='jml<?php echo $rowpdv2->replid ?>' value='<?php echo $nilaipdv ?>' style='width:50px;'></td>
										<?php
					            	}else{
					            		$bg="";
					            		if ($nilaipdv>100){$bg=" style='background-color:red !important;' ";}
						            	echo "<td ".$bg."><b>".$nilaipdv."</b></td>";

					            	}

					            }
					         	echo "</tr>";
					         	$rs=$rs.$rowsiswa->replid;
					         }

				         ?>
		            </table>
							</div>
		            <table border=0 width="100%">
						<tr>
							<?php if ($edit==1){ ?>
							<td align="left">
								<a href="javascript:void(window.open('<?php echo site_url('ns_pembelajaranjadwal/refreshsiswa/'.$isi->replid.'/'.$isi->idkelas) ?>'))" class="btn btn-default">Refresh Data Siswa</a>
								<b>Hati-hati proses ini dapat menghapus data penilaian apabila siswa tidak terdapat dalam data di kelas saat ini. </b><br/><br/>
							</td>
						<?php } ?>
						</tr>
				    <tr>
				            <th align="left">
				            	<input type="hidden" name="rs" value="<?php echo $rs ?>">
				            	<input type="hidden" name="pdv" value="<?php echo $pdv ?>">
				            	<?php if ($edit==1){ ?>
				            		<button class='btn btn-primary'>Simpan</button>
				            	<?php }
                        //else if (isset($n)){
												//if ($isi->aktiftahunajaran==1)
                          else {
							if($isi->deletethis<>1){
									if ((trim($isi->created_by)==$this->session->userdata('idpegawai')) or (($isi->idwali==$this->session->userdata('idpegawai')) AND ($isi->nilaiwali==1))){
												//	echo "<a href=javascript:void(window.open('".site_url('ns_pembelajaranjadwal/hapusnilai/'.$isi->replid)."')) class='btn btn-xs btn-danger'>Hapus Penilaian</a> ";
												//}
								//}
											//}else{
									echo "<a href=javascript:void(window.open('".site_url('ns_pembelajaranjadwal/penilaian/'.$isi->replid)."/1')) class='btn btn-info'>Penilaian</a> ";
																	echo "<a href=javascript:void(window.open('".site_url('ns_pembelajaranjadwal/duplikasi/'.$isi->replid)."/1')) class='btn btn-info'>Duplikasi</a> ";
									if (trim($isi->created_by)==$this->session->userdata('idpegawai')){
															echo "<a href=javascript:void(window.open('".site_url('ns_pembelajaranjadwal/ubah/'.$isi->replid)."')) class='btn btn-warning'>Ubah</a>&nbsp;&nbsp;";
															echo "<a href=javascript:void(window.open('".site_url('ns_pembelajaranjadwal/hapus/'.$isi->replid)."')) class='btn btn-danger'>Hapus</a>";
									}
												}
											}
							}
				            	?>
				            	<a href="javascript:void(window.open('<?php echo site_url("ns_pembelajaranjadwal") ?>'))" class="btn btn-success">Kembali</a>
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
