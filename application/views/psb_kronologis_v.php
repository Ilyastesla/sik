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
                        <li><a href="javascript:void(window.open('<?php echo site_url('psb_kronologis/tambah'); ?>'))" ><i class="fa fa-plus-square"></i> Tambah</a></li>

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
                              <tr>
                                <th align="left">
                                    <label class="control-label" for="minlengthfield">Periode</label>
                                    <div class="control-group">
                              <div class="controls">:
                                      <?php
                                      echo form_input(array('class' => '', 'id' => 'dp1','name'=>'periode1','value'=>$this->session->userdata('periode1'),'data-rule-required'=>'false' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'2' ,'placeholder'=>'DD-MM-YYYY','autocomplete'=>'off'));
                                      echo form_input(array('class' => '', 'id' => 'dp2','name'=>'periode2','value'=>$this->session->userdata('periode2'),'data-rule-required'=>'false' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'2' ,'placeholder'=>'DD-MM-YYYY','autocomplete'=>'off'));
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
                                                <th>Petugas</th>
                                                <th>Nama</th>
                                                <th>Jenjang</th>
                                                <th>Tgl. Datang</th>
                                                <th>Waiting List</th>
                                                <th>Status</th>
                                                <th width="80">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        	<?php
                                        	$CI =& get_instance();$no=1;
											foreach((array)$show_table as $row) {
											    echo "<tr>";
											    echo "<td align='center'>".$no++."</td>";
                          echo "<td align=''>".strtoupper($row->petugas)."</td>";
                          echo "<td align=''><a href=javascript:void(window.open('".site_url('psb_kronologis/view/'.$row->replid)."')) >".($row->nama)."</a></td>";
                          echo "<td align=''>".strtoupper($row->jenjang)."</td>";
                          echo "<td align='center'>".strtoupper($CI->p_c->tgl_indo($row->tgl_masuk))."</td>";
                          echo "<td align=''>".$CI->p_c->cekaktif($row->waiting_list)."</td>";
                          echo "<td align='center'>".$row->no_psb."</td>";
                          echo "<td align='center'>";
                          //if ($row->replidsiswa==""){
											    		echo "<a href=javascript:void(window.open('".site_url('psb_kronologis/tambah/'.$row->replid)."')) class='btn btn-xs btn-warning' >Ubah</a> ";
                              //echo "<a href=javascript:void(window.open('".site_url('psb_kronologis/hapus/'.$row->replid)."')) class='btn btn-xs btn-danger fa fa-minus-square' ></a> ";
                          //}else{
                          //   echo "Telah Menjadi Siswa";
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
<script type="text/javascript">
  $(function(){
    $.ajaxSetup({
      type:"POST",
      url: "<?php echo site_url('combobox/ambil_data') ?>",
      cache: false,
    });

    $("#idnegara").change(function(){
        var value=$(this).val();
        $.ajax({
          data:{modul:'idpropinsi',id:value},
          success: function(respond){
            $("#idpropinsi").html(respond);
          }
        });
        $.ajax({
          data:{modul:'idkota',id:0},
          success: function(respond){
            $("#idkota").html(respond);
          }
        });
        $.ajax({
          data:{modul:'idkecamatan',id:0},
          success: function(respond){
            $("#idkecamatan").html(respond);
          }
        });
    });
    $("#idpropinsi").change(function(){
        var value=$(this).val();
        $.ajax({
          data:{modul:'idkota',id:value},
          success: function(respond){
            $("#idkota").html(respond);
          }
        });
    });
    $("#idkota").change(function(){
        var value=$(this).val();
        $.ajax({
          data:{modul:'idkecamatan',id:value},
          success: function(respond){
            $("#idkecamatan").html(respond);
          }
        });
    });
    $("#jenjang_asal").change(function(){
      var value=$(this).val();
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

    $("#iddepartemen").change(function(){
      var value=$(this).val();
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
              <th align="left"><h4>Data Orang Tua/Wali</h4>
              </th></tr>
            <tr>
              <th align="left">
                  <label class="control-label" for="minlengthfield">Tgl. Datang</label>
                  <div class="control-group">
            <div class="controls">:
                    <?php
                      echo form_input(array('class' => '', 'id' => 'dp1','name'=>'tgl_masuk','value'=>$CI->p_c->tgl_form($isi->tgl_masuk),'data-rule-required'=>'true' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'2' ,'placeholder'=>'DD-MM-YYYY','autocomplete'=>'off'));
                    ?>
                    <?php //echo  <p id="message"></p> ?>
            </div>
                  </div>
              </th>
           </tr>
           <tr>
               <th align="left">
                     <label class="control-label" for="minlengthfield">Nama Orang Tua/Wali</label>
                     <div class="control-group">
               <div class="controls">:
                       <?php
                           $arrortu="id='ortu' data-rule-required='true' ";
                           echo form_dropdown('ortu',$ortu_opt,$isi->ortu,$arrortu)."&nbsp";
                           echo form_input(array('class' => '','style'=>'margin: 0px 0px 5px; width: 300px;', 'id' => 'namaortu','name'=>'namaortu','value'=>$isi->namaortu,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'500', 'data-rule-minlength'=>'1' ,'placeholder'=>'Masukkan 1-100 Karakter'));
                       ?>
                       <?php //echo  <p id="message"></p> ?>
               </div>
                     </div>
                 </th></tr>
             <tr>
                 <th align="left">
                       <label class="control-label" for="minlengthfield">Penerima Informasi</label>
                       <div class="control-group">
                 <div class="controls">:
                         <?php
                             echo form_input(array('class' => '','style'=>'margin: 0px 0px 5px; width: 300px;', 'id' => 'penerimainformasi','name'=>'penerimainformasi','value'=>$isi->penerimainformasi,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'500', 'data-rule-minlength'=>'1' ,'placeholder'=>'Masukkan 1-100 Karakter'));
                         ?>
                         <?php //echo  <p id="message"></p> ?>
                 </div>
                       </div>
                   </th></tr>
                   <tr>
                       <th align="left">
                           <label class="control-label" for="minlengthfield">Tahun Lahir Orang Tua/Wali</label>
                           <div class="control-group">
                     <div class="controls">:
                             <?php
                               echo form_input(array('id' => 'tahunlahirortu','name'=>'tahunlahirortu','value'=>$isi->tahunlahirortu,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'4', 'data-rule-minlength'=>'4','data-rule-number'=>'true','placeholder'=>'Masukkan 4 Angka'));
                             ?>
                             <?php //echo  <p id="message"></p> ?>
                     </div>
                           </div>
                   </th></tr>
              <tr>
              <th align="left">
                  <label class="control-label" for="minlengthfield">No. Telepon Orang Tua/Wali</label>
                  <div class="control-group">
            <div class="controls">:
                    <?php
                      echo form_input(array('class' => '', 'id' => 'teleponortu','name'=>'teleponortu','value'=>$isi->teleponortu,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'200', 'data-rule-minlength'=>'2' ,'placeholder'=>'Masukkan 2-200 Karakter'));
                    ?>
                    <?php //echo  <p id="message"></p> ?>
            </div>
                  </div>
              </th></tr>
              <tr>
              <th align="left">
                  <label class="control-label" for="minlengthfield">No. Handphone Orang Tua/Wali</label>
                  <div class="control-group">
            <div class="controls">:
                    <?php
                      echo form_input(array('class' => '', 'id' => 'handphoneortu','name'=>'handphoneortu','value'=>$isi->handphoneortu,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'200', 'data-rule-minlength'=>'2' ,'placeholder'=>'Masukkan 2-200 Karakter'));
                    ?>
                    <?php //echo  <p id="message"></p> ?>
            </div>
                  </div>
              </th></tr>
              <tr>
              <th align="left">
                  <label class="control-label" for="minlengthfield">No. Whatsapp Orang Tua/Wali</label>
                  <div class="control-group">
            <div class="controls">:
                    <?php
                      echo form_input(array('class' => '', 'id' => 'whatsapportu','name'=>'whatsapportu','value'=>$isi->whatsapportu,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'200', 'data-rule-minlength'=>'2' ,'placeholder'=>'Masukkan 2-200 Karakter'));
                    ?>
                    <?php //echo  <p id="message"></p> ?>
            </div>
                  </div>
              </th></tr>
             <tr>
             <th align="left">
                 <label class="control-label" for="minlengthfield">Email Orang Tua/Wali</label>
                 <div class="control-group">
           <div class="controls">:
                   <?php
                     echo form_input(array('class' => '', 'id' => 'emailortu','name'=>'emailortu','value'=>$isi->emailortu,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'200', 'data-rule-minlength'=>'2','data-rule-email'=>'true' ,'placeholder'=>'Masukkan 2-100 Karakter'));
                   ?>
                   <?php //echo  <p id="message"></p> ?>
           </div>
                 </div>
             </th></tr>
             <tr>
               <th align="left">
                  <hr/>
                    <h4>Data Calon Peserta Didik</h4>
               </th></tr>
             <tr>
                <tr>
    		            <th align="left">
    	                		<label class="control-label" for="minlengthfield">Nama Calon Peserta Didik</label>
    	                		<div class="control-group">
    								<div class="controls">:
    			                	<?php
    			                		 echo form_input(array('class' => '','style'=>'margin: 0px 0px 5px; width: 300px;', 'id' => 'nama','name'=>'nama','value'=>$isi->nama,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'500', 'data-rule-minlength'=>'1' ,'placeholder'=>'Masukkan 1-100 Karakter'));
    			                	?>
    			                	<?php //echo  <p id="message"></p> ?>
    								</div>
    	                		</div>
    			            </th></tr>
                <tr>
                <th align="left">
                    <label class="control-label" for="minlengthfield">Jenis Kelamin</label>
                    <div class="control-group">
                        <div class="controls">:
                                <?php
                                  $arrjenis_kelamin='data-rule-required=true';
                                  $jenis_kelamin_opt=array(''=>'pilih..','l'=>'Laki-Laki','p'=>'Perempuan');
                                  echo form_dropdown('jenis_kelamin',$jenis_kelamin_opt,$isi->jenis_kelamin,$arrjenis_kelamin);
                                ?>
                                <?php //echo  <p id="message"></p> ?>
                        </div>
                    </div>
                </th></tr>
                <tr>
    		            <th align="left">
    	                		<label class="control-label" for="minlengthfield">Tempat Lahir</label>
    	                		<div class="control-group">
    								<div class="controls">:
    			                	<?php
    			                		 echo form_input(array('class' => '','style'=>'margin: 0px 0px 5px; width: 300px;', 'id' => 'tmplahir','name'=>'tmplahir','value'=>$isi->tmplahir,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'500', 'data-rule-minlength'=>'1' ,'placeholder'=>'Masukkan 1-100 Karakter'));
    			                	?>
    			                	<?php //echo  <p id="message"></p> ?>
    								</div>
    	                		</div>
    			            </th>
                </tr>
                <tr>
                <th align="left">
                    <label class="control-label" for="minlengthfield">Tanggal Lahir</label>
                    <div class="control-group">
              <div class="controls">:
                      <?php
                        echo form_input(array('class' => '', 'id' => 'dp2','name'=>'tgllahir','value'=>$CI->p_c->tgl_form($isi->tgllahir),'data-rule-required'=>'true' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'2' ,'placeholder'=>'DD-MM-YYYY','autocomplete'=>'off'));
                      ?>
                      <?php //echo  <p id="message"></p> ?>
              </div>
                    </div>
                </th></tr>
                <tr>
                <th align="left">
                    <label class="control-label" for="minlengthfield">Negara</label>
                    <div class="control-group">
              <div class="controls">:
                      <?php
                        $arrnegara='data-rule-required=true id="idnegara"';
                        echo form_dropdown('negara',$type_negara_opt,$isi->negara,$arrnegara);
                      ?>
                      <?php //echo  <p id="message"></p> ?>
              </div>
                    </div>
                </th></tr>
                <tr>
                  <th align="left">
                      <label class="control-label" for="minlengthfield">Provinsi</label>
                      <div class="control-group">
                <div class="controls">:
                        <?php
                          $arrpropinsi='data-rule-required=true id="idpropinsi"';
                          echo form_dropdown('propinsi',$type_propinsi_opt,$isi->propinsi,$arrpropinsi);
                        ?>
                        <?php //echo  <p id="message"></p> ?>
                </div>
                      </div>
                  </th></tr>
                  <tr>
                  <th align="left">
                      <label class="control-label" for="minlengthfield">Kota</label>
                      <div class="control-group">
                <div class="controls">:
                        <?php
                        $arrkota='data-rule-required=true id="idkota"';
                        echo form_dropdown('kota',$type_kota_opt,$isi->kota,$arrkota);
                        ?>
                        <?php //echo  <p id="message"></p> ?>
                </div>
                      </div>
                  </th></tr>
                  <tr>
                  <th align="left">
                      <label class="control-label" for="minlengthfield">Kecamatan</label>
                      <div class="control-group">
                <div class="controls">:
                        <?php
                        $arrkecamatan='data-rule-required=true id="idkecamatan"';
                        echo form_dropdown('kecamatan',$type_kecamatan_opt,$isi->kecamatan,$arrkecamatan);
                        ?>
                        <?php //echo  <p id="message"></p> ?>
                </div>
                      </div>
                  </th></tr>
                  <tr>
                    <th align="left">
                      <hr/>
                      <h4>Pendidikan Terakhir</h4>
                    </th></tr>
                  <tr>
                    <th align="left">
                    <label class="control-label" for="minlengthfield">Asal Jenjang</label>
                    <div class="control-group">
                  <div class="controls">:
                    <?php
                      $arrjenjang_asal="id='jenjang_asal' data-rule-required='true' ";
                      echo form_dropdown('jenjang_asal',$jenjang_asal_opt,$isi->jenjang_asal,$arrjenjang_asal);
                    ?>
                          <?php //echo  <p id="message"></p> ?>
                  </div>
                    </div>
                    </th></tr>
                <tr>
    		            <th align="left">
    	                		<label class="control-label" for="minlengthfield">Asal Sekolah</label>
    	                		<div class="control-group">
    								<div class="controls">:
    			                	<?php
    			                		 echo form_input(array('class' => '','style'=>'margin: 0px 0px 5px; width: 300px;', 'id' => 'asalsekolah','name'=>'asalsekolah','value'=>$isi->asalsekolah,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'500', 'data-rule-minlength'=>'1' ,'placeholder'=>'Masukkan 1-100 Karakter'));
    			                	?>
    			                	<?php //echo  <p id="message"></p> ?>
    								</div>
    	                		</div>
    			            </th></tr>
                      <tr>
                          <th align="left">
                                <label class="control-label" for="minlengthfield">Asal Tingkat</label>
                                <div class="control-group">
                          <div class="controls">:
                              <?php
                                $arrtingkat_asal="id='tingkat_asal' data-rule-required=true";
                                echo form_dropdown('tingkat_asal',$tingkat_asal_opt,$isi->tingkat_asal,$arrtingkat_asal);
                              ?>
                                  <?php //echo  <p id="message"></p> ?>
                          </div>
                                </div>
                            </th></tr>
                <tr>
    		            <th align="left">
    	                		<label class="control-label" for="minlengthfield">Asal Jurusan</label>
    	                		<div class="control-group">
    								<div class="controls">:
                            <?php
                              $arrjurusan_asal="id='jurusan_asal' data-rule-required=false";
                              echo form_dropdown('jurusan_asal',$jurusan_asal_opt,$isi->jurusan_asal,$arrjurusan_asal);
                            ?>
    			                	<?php //echo  <p id="message"></p> ?>
    								</div>
    	                		</div>
    			            </th></tr>
                      <tr>
                        <th align="left">
                          <hr/>
                          <h4>Jenjang Yang Dituju</h4>
                        </th></tr>
                      <tr>
                      <tr>
                      <th align="left">
                      <label class="control-label" for="minlengthfield">Jenjang</label>
                      <div class="control-group">
                      <div class="controls">:
                      <?php
                      $arrjenjang="id='jenjang' data-rule-required='true' ";
                      echo form_dropdown('jenjang',$jenjang_opt,$isi->jenjang,$arrjenjang);
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
                                $arrjurusan="id='jurusan' data-rule-required=true";
                                echo form_dropdown('jurusan',$jurusan_opt,$isi->jurusan,$arrjurusan);
                              ?>
                              <?php //echo  <p id="message"></p> ?>
                      </div>
                            </div>
                        </th></tr>
            <tr>
              <th align="left">
                <hr/>
                <h4>Pendapat Terkait HSKS</h4>
              </th></tr>
              <tr>
  		            <td align="left">
  	                		<label>Apa yang membuat anda tertarik dengan <b><i>Homeschooling</i> Kak Seto</b>?</label>
  			           </td>
              </tr>
              <tr>
  		            <td align="left">
  	                		<label>Informasi <b><i>Homeschooling</i> Kak Seto</b> diperoleh dari?</label>
  			           </td>
              </tr>
              <tr>
  		            <th align="left">
                      <?php
                        $arridproses="id='idproses' data-rule-required=true";
                        $CI->p_c->checkbox_more('media',$media_opt,'',0);
                      ?>
  			               <?php //echo  <p id="message"></p> ?>
  			            </th></tr>
                <tr>
                  <th align="left">
                    <hr/>
                    <h4>Saran PSB</h4>
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
                <label class="control-label" for="minlengthfield">Tahun Pelajaran</label>
                <div class="control-group">
          <div class="controls">:
              <?php
                $arrtahunajaran="id='tahunajaran' data-rule-required=true";
                echo form_dropdown('tahunajaran',$tahunajaran_opt,$isi->tahunajaran,$arrtahunajaran);
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
                  <hr/>
                  <h4>Kronologis Calon Peserta Didik</h4>
                </th></tr>
            <tr>
                <td align="left">
                      <label>Masalah Akademik</label>
                 </td>
            </tr>
            <tr>
		            <td align="left">
	                		<label>Masalah Keluarga</label>
			           </td>
            </tr>
            <tr>
		            <td align="left">
	                		<label>Masalah Sekolah</label>
			           </td>
            </tr>
            <tr>
		            <td align="left">
	                		<label>Masalah Psikologis/Pribadi</label>
			           </td>
            </tr>
				    <tr>
				            <th align="left">
                      <input type="hidden" name="tahunmasuk" value="<?php echo $isi->tahunmasuk?>">
				            	<button class='btn btn-primary' onclick="return validate()">Simpan</button>
				            	<a href="javascript:void(window.open('<?php echo site_url("psb_kronologis") ?>'))" class="btn btn-success">Kembali</a>
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
                            <th>Departemen</th>
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
                        <a href="javascript:void(window.open('<?php echo site_url("psb_kronologis") ?>'))" class="btn btn-success">Kembali</a>
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
