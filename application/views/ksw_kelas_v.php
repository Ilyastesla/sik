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
                        <li><a href="javascript:void(window.open('<?php echo site_url('ksw_kelas/tambah'); ?>'))" ><i class="fa fa-plus-square"></i> Tambah</a></li>
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
                <th align="left">
        				                		<label class="control-label" for="minlengthfield">Tingkat</label>
        				                		<div class="control-group">
                											<div class="controls">:
            						                	<?php
            						                		$arridtingkat='data-rule-required=false onchange=javascript:this.form.submit();';
            						                		echo form_dropdown('idtingkat',$idtingkat_opt,$this->input->post('idtingkat'),$arridtingkat);
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
                                 <th align="left">
                                     <label class="control-label" for="minlengthfield">Kelompok Siswa</label>
                                     <div class="control-group">
                                       <div class="controls">:
                                           <?php
                                             $arrkelompok_siswa='data-rule-required=false onchange=javascript:this.form.submit();';
                                             echo form_dropdown('kelompok_siswa',$kelompok_siswa_opt,$this->input->post('kelompok_siswa'),$arrkelompok_siswa);
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
              						       
                                   <th align="left">
                                     <label class="control-label" for="minlengthfield">Kurikulum</label>
                                     <div class="control-group">
                                       <div class="controls">:
                                       <?php
                                          $arrkurikulumkode="id='kurikulumkode' data-rule-required=false onchange=javascript:this.form.submit();";
                                          echo form_dropdown('kurikulumkode',$kurikulumkode_opt,$this->input->post('kurikulumkode'),$arrkurikulumkode);
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
                                              echo "<th>Jenjang</th>";
                                              echo "<th>Tahun Pelajaran</th>";
                                              echo "<th>Kelas</th>";
                                              echo "<th>Jurusan</th>";
                                              echo "<th>Wali Kelas</th>";
                                              echo "<th>Keterangan</th>";
                                              echo "<th>Kapasitas</th>";
                                              echo "<th>Jml PD</th>";
                                              echo "<th>Jml PD ABK</th>";
                                              //echo "<th>Keterangan</th>";
                                              echo "<th>Kelompok Siswa</th>";
                                              echo "<th>Kurikulum</th>";
                                              echo "<th>Aktif</th>";
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
                          echo "<td align='center'>".strtoupper($row->departemen)."</td>";
                          echo "<td align='center'>".strtoupper($row->tahunajaran)."</td>";
                          echo "<td align='center'>".($row->kelas)."</td>";
                          echo "<td align='center'>".($row->jurusantext)."</td>";
                          echo "<td align='center'>".$CI->dbx->getpegawai($row->idwali,0,1)."</td>";
											    echo "<td align='center'>".$row->keterangan."</td>";
                          echo "<td align='center'>".strtoupper($row->kapasitas)."</td>";
                          echo "<td align='center'>".strtoupper($row->jmlsiswa )."</td>";
                          echo "<td align='center'>".strtoupper($row->jmlsiswaabk )."</td>";
                          //echo "<td align='center'>".strtoupper($row->keterangan)."</td>";
                          echo "<td align='center'>".strtoupper($row->kelompok_siswatext)."</td>";
                          echo "<td align='center'>".strtoupper($row->kurikulumtext)."</td>";
                          echo "<td align='center'>";
                          echo "<a href=javascript:void(window.open('".site_url('ksw_kelas/ubahaktif/'.$row->replid.'/'.!($row->aktif))."'))>".$CI->p_c->cekaktif($row->aktif)."</a>";
                          //$CI->p_c->cekaktif($row->aktif).
                          echo "</td>";
											    echo "<td align='center'>";
                          echo "<a href=javascript:void(window.open('".site_url('ksw_kelas/view/'.$row->replid)."')) class='btn btn-xs btn-info fa fa-circle-o' ></a>&nbsp;";
                          echo "<a href=javascript:void(window.open('".site_url('ksw_kelas/ubah/'.$row->replid)."')) class='btn btn-xs btn-warning fa fa-check-square' ></a>&nbsp;";
                          if ($row->jmlsiswa<1){
											    		echo "<a href=javascript:void(window.open('".site_url('ksw_kelas/hapus/'.$row->replid)."')) class='btn btn-xs btn-danger fa fa-minus-square' ></a> ";
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
          data:{modul:'idtingkat',id:$("#iddepartemen").val()},
          success: function(respond){
            $("#idtingkat").html(respond);
          }
        });
        $.ajax({
          data:{modul:'kelompok_siswa',id:$("#iddepartemen").val()},
          success: function(respond){
            $("#kelompok_siswa").html(respond);
          }
        });
        $.ajax({
          data:{modul:'idjurusan',id:$("#iddepartemen").val()},
          success: function(respond){
            $("#jurusan").html(respond);
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
          data:{modul:'idtingkat',id:value},
          success: function(respond){
            $("#idtingkat").html(respond);
          }
        });
        $.ajax({
          data:{modul:'kelompok_siswa',id:value},
          success: function(respond){
            $("#kelompok_siswa").html(respond);
          }
        });
        $.ajax({
          data:{modul:'idjurusan',id:value},
          success: function(respond){
            $("#jurusan").html(respond);
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
                        $arridcompany="data-rule-required=true id=idcompany ";
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
                        $arridtahunajaran="id='idtahunajaran' data-rule-required='true' ";
                        echo form_dropdown('idtahunajaran',$idtahunajaran_opt,$isi->idtahunajaran,$arridtahunajaran);
                      ?>
                            <?php //echo  <p id="message"></p> ?>
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
                        $arridtingkat="id='idtingkat' data-rule-required='true' ";
                        echo form_dropdown('idtingkat',$idtingkat_opt,$isi->idtingkat,$arridtingkat);
                      ?>
                            <?php //echo  <p id="message"></p> ?>
                    </div>
                </div>
              </th>
            </tr>
            <tr>
                    <th align="left">
                      <label class="control-label" for="minlengthfield">Kelompok Siswa</label>
                      <div class="control-group">
                          <div class="controls">:
                            <?php
                              $arrkelompok_siswa="data-rule-required=true id='kelompok_siswa'";
                              echo form_dropdown('kelompok_siswa',$kelompok_siswa_opt,$isi->kelompok_siswa,$arrkelompok_siswa);
                            ?>
                                  <?php //echo  <p id="message"></p> ?>
                          </div>
                      </div>
                    </th>
                  </tr>
                  <tr>
                    <th align="left">
                      <label class="control-label" for="minlengthfield">Jurusan</label>
                      <div class="control-group">
                          <div class="controls">:
                            <?php
                              $arrjurusan="id='jurusan' data-rule-required=false";
                              echo form_dropdown('jurusan',$jurusan_opt,$isi->jurusan,$arrjurusan);
                            ?>
                                  <?php //echo  <p id="message"></p> ?>
                          </div>
                      </div>
                    </th>
                  </tr>
		    		<tr>
		            <th align="left">
	                		<label class="control-label" for="minlengthfield">Nama Kelas</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
                          echo "Format Penamaan: [Romawi Tingkat]-[Kelompok Pesdik]-[Jurusan]-[Program], Contoh:XII-A-IPA-KOM";
			                		 echo form_input(array('class' => '','style'=>'margin: 0px 0px 5px; width: 687px;', 'id' => 'kelas','name'=>'kelas','value'=>$isi->kelas,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'500', 'data-rule-minlength'=>'1' ,'placeholder'=>'Format Penamaan: [Romawi Tingkat]-[Kelompok Pesdik]-[Jurusan]-[Program]'));
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th></tr>
                  <tr>
                    <th align="left">
                      <label class="control-label" for="minlengthfield">Wali Kelas</label>
                      <div class="control-group">
                          <div class="controls">:
                            <?php
                              $arridwali='data-rule-required=true';
                              echo form_dropdown('idwali',$idwali_opt,$isi->idwali,$arridwali);
                            ?>
                                  <?php //echo  <p id="message"></p> ?>
                          </div>
                      </div>
                    </th>
                  </tr>
                  
                  <tr>
                    <th align="left">
                      <label class="control-label" for="minlengthfield">Kurikulum</label>
                      <div class="control-group">
                          <div class="controls">:
                            <?php
                              $arrkurikulumkode="id='kurikulumkode' data-rule-required=true";
                              echo form_dropdown('kurikulumkode',$kurikulumkode_opt,$isi->kurikulumkode,$arrkurikulumkode);
                            ?>
                                  <?php //echo  <p id="message"></p> ?>
                          </div>
                      </div>
                    </th>
                  </tr>
                  <tr>
      				            <th align="left">
      		                		<label class="control-label" for="minlengthfield">Kapasitas</label>
      		                		<div class="control-group">
      									<div class="controls">:
      				                	<?php
      				                		echo form_input(array('id' => 'kapasitas','name'=>'kapasitas','value'=>$isi->kapasitas,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'3', 'data-rule-minlength'=>'1','data-rule-number'=>'true','placeholder'=>'Masukkan 1-3 Karakter'));
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
				            	<a href="javascript:void(window.open('<?php echo site_url("ksw_kelas") ?>'))" class="btn btn-success">Kembali</a>
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
              <label class="control-label" for="minlengthfield">Departemen</label>
              <div class="control-group">
            <div class="controls">:
              <?php
                echo $isi->departemen;
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
                        echo $isi->tingkattext;
                      ?>
                    </div>
                </div>
              </th>
            </tr>
		    		<tr>
		            <th align="left">
	                		<label class="control-label" for="minlengthfield">Nama Kelas</label>
	                		<div class="control-group">
								<div class="controls">:
                  <?php
                    echo $isi->kelas;
                  ?>
								</div>
	                		</div>
			            </th></tr>
                  <tr>
                    <th align="left">
                      <label class="control-label" for="minlengthfield">Wali Kelas</label>
                      <div class="control-group">
                          <div class="controls">:
                            <?php
                              echo $CI->dbx->getpegawai($isi->idwali,0,1);
                            ?>
                          </div>
                      </div>
                    </th>
                  </tr>
                  <tr>
                    <th align="left">
                      <label class="control-label" for="minlengthfield">Kelompok Siswa</label>
                      <div class="control-group">
                          <div class="controls">:
                            <?php
                              echo $isi->kelompok_siswatext;
                            ?>
                          </div>
                      </div>
                    </th>
                  </tr>
                  <tr>
                    <th align="left">
                      <label class="control-label" for="minlengthfield">Jurusan</label>
                      <div class="control-group">
                          <div class="controls">:
                            <?php
                              echo $isi->jurusantext;
                            ?>
                          </div>
                      </div>
                    </th>
                  </tr>
                  <tr>
      				            <th align="left">
      		                		<label class="control-label" for="minlengthfield">Kapasitas</label>
      		                		<div class="control-group">
      									<div class="controls">:
                          <?php
                            echo $isi->kapasitas;
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
		            </table>
                <table id="example1" class="table table-bordered table-striped">
                      <tr>
                        <th width='50px'>No.</th>
                        <th width='100px'>NIS</th>
                        <th width='100px'>NISN</th>
                        <th>Nama</th>
                        <th width='50px'>Aktif</th>
                      </tr>
                      <?php
                      $no=1;
                      foreach((array)$datasiswa as $rowsiswa) {
											    echo "<tr>";
											    echo "<td align='center'>".$no++."</td>";
                          echo "<td align='center'>";
                          echo "<a href=javascript:void(window.open('".site_url('general/datasiswa/'.$rowsiswa->replid)."')) >".$rowsiswa->nis."</a>";
                          echo "</td>";
                          echo "<td align='center'>".$rowsiswa->nisn."</td>";
                          echo "<td align='left'>".$rowsiswa->nama."</td>";
                          echo "<td align='center'>".$CI->p_c->cekaktif($rowsiswa->aktif)."</td>";
                          echo "</tr>";
                      }
                      ?>
                </table>
                <table>
                  <tr>
                    <td>
                      <?php
                      echo "<a href='javascript:window.close()' class='btn btn-success'>Kembali</a>&nbsp;&nbsp;";
                      echo "<a href=javascript:void(window.open('".site_url('ksw_kelas/ubah/'.$isi->replid)."')) class='btn btn-warning'>Ubah</a>&nbsp;&nbsp;";
                      if ($isi->jmlsiswa<1){
                          echo "<a href=javascript:void(window.open('".site_url('ksw_kelas/hapus/'.$isi->replid)."')) class='btn btn-danger'>Hapus</a>&nbsp;&nbsp;";
                      }
                      ?>
                    </td>
                  </tr>
                </table>
	    </section>
<!-------------------------------------------------------------------------------------------------------------------------------------->
<?php } ?>
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
    </body>
</html>
