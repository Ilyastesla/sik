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
                        <li><a href="javascript:void(window.open('<?php echo site_url('psb_calonsiswarevisi/tambah'); ?>'))" ><i class="fa fa-plus-square"></i> Tambah</a></li>
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
                          <!--
    	                    <tr>
            						       <th align="left">
      				                		<label class="control-label" for="minlengthfield">Jenjang</label>
      				                		<div class="control-group">
              											<div class="controls">:
          						                	<?php
          						                		$arriddepartemen='data-rule-required=false  onchange=javascript:this.form.submit();';
          						                		echo form_dropdown('iddepartemen',$iddepartemen_opt,$this->input->post('iddepartemen'),$arriddepartemen);
          						                	?>
          						                	<?php //echo  <p id="message"></p> ?>
              											</div>
            				              </div>
            						         </th>
                                 <th align="left">
        				                		<label class="control-label" for="minlengthfield">Tahun</label>
        				                		<div class="control-group">
                											<div class="controls">:
            						                	<?php
            						                		$arrtahunmasuk='data-rule-required=false  onchange=javascript:this.form.submit();';
            						                		echo form_dropdown('tahunmasuk',$tahunmasuk_opt,$this->input->post('tahunmasuk'),$arrtahunmasuk);
            						                	?>
            						                	<?php //echo  <p id="message"></p> ?>
                											</div>
              				              </div>
              						         </th>
    			                  </tr>
                            <tr>
              						       <th align="left">
        				                		<label class="control-label" for="minlengthfield">Proses</label>
        				                		<div class="control-group">
                											<div class="controls">:
            						                	<?php
            						                		$arridproses='data-rule-required=false  onchange=javascript:this.form.submit();';
            						                		echo form_dropdown('idproses',$idproses_opt,$this->input->post('idproses'),$arridproses);
            						                	?>
            						                	<?php //echo  <p id="message"></p> ?>
                											</div>
              				              </div>
              						         </th>
                                   <th align="left">
          				                		<label class="control-label" for="minlengthfield">Program</label>
          				                		<div class="control-group">
                  											<div class="controls">:
              						                	<?php
              						                		$arridkelompok='data-rule-required=false  onchange=javascript:this.form.submit();';
              						                		echo form_dropdown('idkelompok',$idkelompok_opt,$this->input->post('idkelompok'),$arridkelompok);
              						                	?>
              						                	<?php //echo  <p id="message"></p> ?>
                  											</div>
                				              </div>
                						         </th>
      			                  </tr>
                            -->
                            <tr>
              						       <th align="left">
        				                		<label class="control-label" for="minlengthfield">Nama</label>
        				                		<div class="control-group">
                											<div class="controls">:
            						                	<?php
                                            $arrjeniscari='data-rule-required=false';
                                            echo form_dropdown('jeniscari',$jeniscari_opt,$this->input->post('jeniscari'),$arrjeniscari);
                                            echo "&nbsp;&nbsp;";
            						                		echo form_input(array('class' => '','style'=>'margin: 0px 0px 5px; width: 300px;', 'id' => 'nama','name'=>'nama','value'=>$this->input->post('nama'),'data-rule-required'=>'true' ,'data-rule-maxlength'=>'500', 'data-rule-minlength'=>'3' ,'placeholder'=>'Masukkan 1-100 Karakter'));
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
                                                <th>No Daftar</th>
                                                <th>NIS Sementara</th>
                                                <th>Nama</th>
                                                <th>Tingkat</th>
                                                <th>Jurusan</th>
                                                <th>Regional</th>
                                                <th>Status Program</th>
                                                <th>ABK</th>
                                                <th>Calon Kelas</th>
                                                <th>Tgl. Daftar</th>
                                                <th>Aktif</th>
                                                <th width="80">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        	<?php
                                        	$CI =& get_instance();$no=1;
											foreach((array)$show_table as $row) {
											    echo "<tr>";
											    echo "<td align='center'>".$no++."</td>";
                          echo "<td align=''><a href=javascript:void(window.open('".site_url('general/datacalonsiswa/'.$row->replid)."')) >".($row->nopendaftaran)."</a></td>";
                          echo "<td align=''>".($row->nissementara)."</td>";
                          echo "<td align=''>".($row->nama)."</td>";
                          echo "<td align=''>".($row->tingkattext)."</td>";
                          echo "<td align=''>".($row->jurusantext )."</td>";
                          echo "<td align=''>".($row->regiontext)."</td>";
                          echo "<td align=''>".($row->kondisitext)."</td>";
                          echo "<td align=''>".($CI->p_c->cekaktif($row->abk))."</td>";
                          echo "<td align=''>".($row->kelastext )."</td>";
                          echo "<td align=''>";
                          if (($row->lama>$row->lamaproses) and ($row->replidsiswa=="") and ($row->aktif=="1")){
                            echo $CI->p_c->bgcolortext($CI->p_c->tgl_indo($row->tanggal_daftar),'red');
                          }else{
                            echo $CI->p_c->tgl_indo($row->tanggal_daftar);
                          }
                          echo "</td>";
                          echo "<td align='center'>";
                          echo "<a href=javascript:void(window.open('".site_url('psb_calonsiswarevisi/ubahaktif/'.$row->replid)."')) >".$CI->p_c->cekaktif($row->aktif)."</a>";
                          echo "</td>";
											    echo "<td align='center'>";
                          if ($row->replidsiswa<>""){
											    		echo "Telah Menjadi Siswa";
                          }else{
                            echo "<a href=javascript:void(window.open('".site_url('psb_calonsiswarevisi/ubah/'.$row->replid)."')) class='btn btn-xs btn-warning fa fa-check-square' ></a> ";
                            if ($row->jmlproses<1){
                              echo "<a href=javascript:void(window.open('".site_url('psb_calonsiswarevisi/hapus/'.$row->replid)."')) class='btn btn-xs btn-danger  fa fa-minus-square' ></a> ";
                            }
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
        data:{modul:'idtahunajarancompany',id:value,idcompany:$("#idcompany").val()},
        success: function(respond){
          $("#idtahunajaran").html(respond);
        }
      });
        $.ajax({
          data:{modul:'idproses',id:value},
          success: function(respond){
            $("#idproses").html(respond);
          }
        });
        $.ajax({
          data:{modul:'idtingkat',id:value},
          success: function(respond){
            $("#tingkat").html(respond);
          }
        });
        $.ajax({
          data:{modul:'idkelompok',id:''},
          success: function(respond){
            $("#idkelompok").html(respond);
          }
        });
        $.ajax({
          data:{modul:'idjurusan',id:value},
          success: function(respond){
            $("#idjurusan").html(respond);
          }
        });
    });

    $("#idproses").change(function(){
      var value=$(this).val();
        $.ajax({
          data:{modul:'idkelompok',id:value},
          success: function(respond){
            $("#idkelompok").html(respond);
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
              <label class="control-label" for="minlengthfield">No. Pendaftaran</label>
              <div class="control-group">
            <div class="controls">:
              <?php
                  echo "<a href=javascript:void(window.open('".site_url('general/datacalonsiswa/'.$isi->replid)."')) >".($isi->nopendaftaran)."</a>";
              ?>
                    <?php //echo  <p id="message"></p> ?>
            </div>
              </div>
              </th></tr>
              <tr>
                <th align="left">
                <label class="control-label" for="minlengthfield">Nama</label>
                <div class="control-group">
              <div class="controls">:
                <?php
                    echo strtoupper($isi->nama);
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
                    $arriddepartemen="id='iddepartemen' data-rule-required='true' ";
                    echo form_dropdown('iddepartemen',$iddepartemen_opt,$isi->departemen,$arriddepartemen);
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
                      $arridtahunajaran="id='idtahunajaran' data-rule-required=true";
                      echo form_dropdown('idtahunajaran',$idtahunajaran_opt,$isi->idtahunajaran,$arridtahunajaran);
                    ?>
                        <?php //echo  <p id="message"></p> ?>
                </div>
                      </div>
                  </th></tr>
		    		<tr>
		            <th align="left">
	                		<label class="control-label" for="minlengthfield">Proses</label>
	                		<div class="control-group">
								<div class="controls">:
                    <?php
                      $arridproses="id='idproses' data-rule-required=true";
                      echo form_dropdown('idproses',$idproses_opt,$isi->idproses,$arridproses);
                    ?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th></tr>
          <tr>
              <th align="left">
                    <label class="control-label" for="minlengthfield">Program</label>
                    <div class="control-group">
              <div class="controls">:
                  <?php
                    $arridkelompok="id='idkelompok' data-rule-required=true";
                    echo form_dropdown('idkelompok',$idkelompok_opt,$isi->idkelompok,$arridkelompok);
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
                          $arrtingkat="id='tingkat' data-rule-required=true";
                          echo form_dropdown('tingkat',$tingkat_opt,$isi->tingkat,$arrtingkat);
                        ?>
                            <?php //echo  <p id="message"></p> ?>
                    </div>
                          </div>
                      </th></tr>
                <tr>
                <th align="left">
                      <label class="control-label" for="minlengthfield">Jurusan</label>
                      <div class="control-group">
                          <div class="controls">:
                                  <?php
                                    $arridjurusan="id='idjurusan' data-rule-required=false";
                                    echo form_dropdown('idjurusan',$idjurusan_opt,$isi->jurusan,$arridjurusan);
                                    echo "<br/>&nbsp;&nbsp; Hanya untuk tingkat 10-12";
                                  ?>

                          </div>
                      </div>
                  </th>
              </tr>
              <tr>
                  <th align="left">
                        <label class="control-label" for="minlengthfield">Regional</label>
                        <div class="control-group">
                  <div class="controls">:
                      <?php
                        $arrregion="id='region' data-rule-required=true";
                        echo form_dropdown('region',$region_opt,$isi->region,$arrregion);
                      ?>
                          <?php //echo  <p id="message"></p> ?>
                  </div>
                        </div>
                    </th></tr>
          <tr>
              <th align="left">
                    <label class="control-label" for="minlengthfield">Status Program</label>
                    <div class="control-group">
              <div class="controls">:
                  <?php
                    $arrkondisi="id='kondisi' data-rule-required=true";
                    echo form_dropdown('kondisi',$kondisi_opt,$isi->kondisi,$arrkondisi);
                  ?>
                      <?php //echo  <p id="message"></p> ?>
              </div>
                    </div>
                </th></tr>
                <tr>
                    <th align="left">
                    <label class="control-label" for="minlengthfield">Anak Berkebutuhan Khusus</label>
                    <div class="control-group">
                  <div class="controls">:
                          <?php
                            echo form_checkbox('abk', '1', $isi->abk);
                          ?>
                          <?php //echo  <p id="message"></p> ?>
                  </div>
                    </div>
                    </th></tr>
                    <tr>
                    <th align="left">
                        <label class="control-label" for="minlengthfield">Tanggal Daftar</label>
                        <div class="control-group">
                  <div class="controls">:
                          <?php
                            if($isi->tanggal_daftar<>""){$settgl=$isi->tanggal_daftar;}else{$settgl=$isi->hariini;}
                            echo form_input(array('class' => '', 'id' => 'dp2','name'=>'tanggal_daftar','value'=>$CI->p_c->tgl_form($settgl),'data-rule-required'=>'true' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'2' ,'placeholder'=>'DD-MM-YYYY','autocomplete'=>'off'));
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
                    <input type="hidden" name="idcompany" id="idcompany" value="<?php echo $isi->idcompany?>">
                      <input type="hidden" name="tahunmasuk" value="<?php echo $isi->tahunmasuk?>">
				            	<button class='btn btn-primary' onclick="return validate()">Simpan</button>
				            	<a href="javascript:void(window.open('<?php echo site_url("psb_calonsiswarevisi") ?>'))" class="btn btn-success">Kembali</a>
				            </th>
				    </tr>
		            </table>
		        	<?php
		        	echo form_close();
		        	?>
	    </section>
<!-------------------------------------------------------------------------------------------------------------------------------------->
<?php } elseif($view=='ubahaktif'){ ?>
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
              <label class="control-label" for="minlengthfield">No. Pendaftaran</label>
              <div class="control-group">
            <div class="controls">:
              <?php
                  echo $isi->nopendaftaran;
              ?>
                    <?php //echo  <p id="message"></p> ?>
            </div>
              </div>
              </th></tr>
              <tr>
                <th align="left">
                <label class="control-label" for="minlengthfield">Nama</label>
                <div class="control-group">
              <div class="controls">:
                <?php
                    echo strtoupper($isi->nama);
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
                            echo form_checkbox('aktif', '1', !$isi->aktif);
                          ?>
                          <?php //echo  <p id="message"></p> ?>
                  </div>
                    </div>
                    </th></tr>
            <tr>
              <th align="left">
              <label class="control-label" for="minlengthfield">Alasan</label>
              <div class="control-group">
            <div class="controls">:
              <?php
                $arridalasan="id='idalasan' data-rule-required='true' ";
                echo form_dropdown('idalasan',$idalasan_opt,'',$arridalasan);
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
				                		echo form_textarea(array('class' => '', 'id' => 'keterangan','name'=>'keterangan','value'=>'','data-rule-required'=>'true' ,'data-rule-maxlength'=>'500', 'data-rule-minlength'=>'20' ,'placeholder'=>'Masukkan 20-500 Karakter'));
				                	?>
				                	<?php //echo  <p id="message"></p> ?>
									</div>
		                		</div>
				            </th></tr>

				    <tr>
				            <th align="left">
                      <input type="hidden" name="tahunmasuk" value="<?php echo $isi->tahunmasuk?>">
				            	<button class='btn btn-primary' onclick="return validate()">Simpan</button>
				            	<a href="javascript:void(window.open('<?php echo site_url("psb_calonsiswarevisi") ?>'))" class="btn btn-success">Kembali</a>
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
            <section class="content">
		        <?php
			        $attributes = array('class' => 'form-horizontal form-validate', 'id' => 'form', 'method' => 'POST', 'novalidate'=>'novalidate','onsubmit'=>'return validate()');
		    	echo form_open($action,$attributes);
		    	?>
		    	<table width="100%" border="0">
            <tr>
              <th align="left">
              <label class="control-label" for="minlengthfield">No. Pendaftaran</label>
              <div class="control-group">
            <div class="controls">:
              <?php
                  echo $isi->nopendaftaran;
              ?>
                    <?php //echo  <p id="message"></p> ?>
            </div>
              </div>
              </th></tr>
              <tr>
                <th align="left">
                <label class="control-label" for="minlengthfield">Nama</label>
                <div class="control-group">
              <div class="controls">:
                <?php
                    echo strtoupper($isi->nama);
                ?>
                      <?php //echo  <p id="message"></p> ?>
              </div>
                </div>
                </th></tr>
		            </table>
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th width='50'>No.</th>
                            <th>Jenjang</th>
                            <th>Proses</th>
                            <th>Program</th>
                            <th>Tingkat</th>
                            <th>Regional</th>
                            <th>Status Program</th>
                            <th>Keterangan</th>
                            <th>Tgl. Ubah</th>
                        </tr>
                    </thead>
                    <tbody>
                      <?php
                      $CI =& get_instance();$no=1;
                      foreach((array)$calonhistory as $row) {
                          echo "<tr align='center'>";
                          echo "<td >".$no++."</td>";
                          echo "<td align=''>".($row->departementext)."</td>";
                          echo "<td align=''>".($row->prosestext)."</td>";
                          echo "<td align=''>".($row->kelompokcalontext)."</td>";
                          echo "<td align=''>".($row->tingkattext)."</td>";
                          echo "<td align=''>".($row->regiontext)."</td>";
                          echo "<td align=''>".($row->kondisitext)."</td>";
                          echo "<td align=''>".($row->keterangan)."</td>";
                          echo "<td align=''>".$CI->p_c->tgl_indo($row->modified_date)."</td>";
                          echo "</tr>";
                      }
                      ?>

                  </tbody>
                  <tfoot>
                  </tfoot>
              </table>
              <table border="0">
              <tr>
  				            <th align="left">
                        <a href="javascript:void(window.open('<?php echo site_url("psb_calonsiswarevisi") ?>'))" class="btn btn-success">Kembali</a>
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
