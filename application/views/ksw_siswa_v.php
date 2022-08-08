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
                    <script>
                      function submitform(excel){
                        const form_x = document.getElementById("form"); 
                        form_x.action="<?php echo site_url('ksw_siswa/printthis/');?>/"+excel;
                        form_x.target="_blank";
                        form_x.submit();
                      }
                    </script>
                    <ol class="breadcrumb">
                    <?php if($this->input->post('idkelas')<>""){?>
                        <!--
                        <li><a href="javascript:void(window.open('<?php echo site_url('ksw_siswa/tambah'); ?>'))" ><i class="fa fa-plus-square"></i> Tambah</a></li>
                        <li><a href="javascript:void(window.open('<?php echo site_url('ksw_siswa/printthis/'.$this->input->post('idtahunajaran').'/'.$this->input->post('idtingkat').'/'.$this->input->post('idkelas')); ?>'))" ><i class="fa fa-file-excel-o"></i>Excel</a></li>
                        -->
                        <li><a href="#" onclick="submitform(0)"><i class="fa fa-print"></i>Cetak</a></li>
                        <li><a href="#" onclick="submitform(1)"><i class="fa fa-file-excel-o"></i>Excel</a></li>
                        
                        <li><a href="javascript:void(window.open('<?php echo site_url('ksw_siswa/cetakkartu/'.$this->input->post('idkelas')); ?>'))" ><i class="fa fa-print"></i>Cetak Kartu</a></li>
                        <?php } else{
                          echo "Pilih Kelas Terlebih Dahulu!";
                        }
                        
                        ?>
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
                                    <th align="left">
                                      <label class="control-label" for="minlengthfield">Kelas</label>
          				                		<div class="control-group">
                  											<div class="controls">:
              						                	<?php
              						                		$arridkelas='data-rule-required=false onchange=javascript:this.form.submit();';
              						                		echo form_dropdown('idkelas',$idkelas_opt,$this->input->post('idkelas'),$arridkelas);
              						                	?>
              						                	<?php //echo  <p id="message"></p> ?>
                  											</div>
                				              </div>
            						            </th>
      			                  </tr>
          			            <tr>
          				            <th align="left" colspan="4">
          				            	<button class='btn btn-primary' name='filter' value="1">Filter</button>
          				            	<?php echo "<a href='".site_url($action)."'  class='btn btn-danger'>Bersihkan</a>&nbsp;&nbsp;";?>
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
                                              echo "<th>NIS</th>";
                                              echo "<th>Nama</th>";
                                              echo "<th>Status Program/<br/>Regional</th>";
                                              echo "<th>Tahun Pelajaran/<br/>Kelas</th>";
                                              echo "<th>ABK</th>";
                                              echo "<th>RP</th>";
                                              echo "<th>TV</th>";
                                              //echo "<th>Keuangan</th>";
                                              //echo "<th>Administrasi<br/>Siswa</th>";
                                              echo "<th>Aktif</th>";
                                              echo "<th>Wali Kelas</th>";
                                              echo "<th>Tipe Peringatan</th>";
                                              if(ISSET($editdata) AND ($editdata==1)){
                                                  echo "<th width='80'>Aksi</th>";
                                              }

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
                          echo "<a href=javascript:void(window.open('".site_url('general/datasiswa/'.$row->replid)."')) >".$row->nis."</a>";
                          echo "</td>";
                          echo "<td align='left'>".($row->nama);
                          if ($row->jml_hari<=14){
                            echo ' <b><font color="red">(baru)</font></b>';
                          }
                          //if (($row->jml_hari>=180) and ($row->konseling_desc==1)){
                          //  echo ' <b><font color="red">(Harus Interview)</font></b>';
                          //}
                          echo "</td>";
                          echo "<td align='center'>".($row->kondisi_nm)."<br/>".$row->region."</td>";
                          echo "<td align='center'>".$row->tahunajarantext."<br/>".$row->kelastext."</td>";
                          echo "<td align='center'>".($CI->p_c->cekaktif($row->abk))."</td>";
                          echo "<td align='center'>".($CI->p_c->cekaktif($row->remedialperilaku))."</td>";
                          echo "<td align='center'>".($CI->p_c->cekaktif($row->keu_tutorvisit))."</td>";
                          echo "<td align='center'>".$CI->p_c->cekaktif($row->aktif)."</td>";
                          echo "<td align='center'>".$CI->dbx->getpegawai($row->idwali,0,1)."</td>";
                          echo "<td align='center'>";
                          echo $CI->p_c->cekperingatan($row->peringatan);
                          echo "</td>";
                          /*
											    echo "<td align='center'>";
                          echo "</td>";
                          echo "<td align='center'>";
                          echo "</td>";
                          */
                          if(ISSET($editdata) AND ($editdata==1)){
                            echo "<td align='center'>";
  											    echo "<a href=javascript:void(window.open('".site_url('ksw_siswa/tambah/'.$row->replid)."')) class='btn btn-xs btn-warning fa fa-check-square' ></a>&nbsp;&nbsp;";
  											    echo "</td>";
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
  <!--
  $("#idkota").change(function(){
      var value=$(this).val();
      $.ajax({
        data:{modul:'idkecamatan',id:value},
        success: function(respond){
          $("#idkecamatan").html(respond);
        }
      });
  });

  $.ajax({
    data:{modul:'idkecamatan',id:0},
    success: function(respond){
      $("#idkecamatan").html(respond);
    }
  });
  -->

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
              $("#idprovinsi").html(respond);
            }
          });
          $.ajax({
            data:{modul:'idkota',idnegara:value,id:0},
            success: function(respond){
              $("#idkota").html(respond);
            }
          });

      });
      $("#idprovinsi").change(function(){
          var value=$(this).val();
          $.ajax({
            data:{modul:'idkota',idnegara:$("#idnegara").val(),id:value},
            success: function(respond){
              $("#idkota").html(respond);
            }
          });
      });


      $("#jenjangasal").change(function(){
        var value=$(this).val();
          $.ajax({
            data:{modul:'idtingkat',id:value},
            success: function(respond){
              $("#tingkat_asal").html(respond);
            }
          });
      });

      $("#jenjang").change(function(){
        var value=$(this).val();
          $.ajax({
            data:{modul:'idtingkat',id:value},
            success: function(respond){
              $("#idtingkat").html(respond);
            }
          });
          $.ajax({
            data:{modul:'idkelompoksiswa',id:value},
            success: function(respond){
              $("#idkelompokcalon").html(respond);
            }
          });
      });

      $("#idtingkat").change(function(){
        var value=$(this).val();
          $.ajax({
            data:{modul:'idjurusan',id:value},
            success: function(respond){
              $("#idjurusan").html(respond);
            }
          });
      });

      $("#negara_ayah").change(function(){
          var value=$(this).val();
          $.ajax({
            data:{modul:'idpropinsi',id:value},
            success: function(respond){
              $("#provinsi_ayah").html(respond);
            }
          });
          $.ajax({
            data:{modul:'idkota',idnegara:value,id:0},
            success: function(respond){
              $("#kota_ayah").html(respond);
            }
          });
      });
      $("#provinsi_ayah").change(function(){
          var value=$(this).val();
          $.ajax({
            data:{modul:'idkota',idnegara:$("#negara_ayah").val(),id:value},
            success: function(respond){
              $("#kota_ayah").html(respond);
            }
          });
      });
      $("#negara_ibu").change(function(){
          var value=$(this).val();
          $.ajax({
            data:{modul:'idpropinsi',id:value},
            success: function(respond){
              $("#provinsi_ibu").html(respond);
            }
          });
          $.ajax({
            data:{modul:'idkota',idnegara:value,id:0},
            success: function(respond){
              $("#kota_ibu").html(respond);
            }
          });
      });
      $("#provinsi_ibu").change(function(){
          var value=$(this).val();
          $.ajax({
            data:{modul:'idkota',idnegara:$("#negara_ibu").val(),id:value},
            success: function(respond){
              $("#kota_ibu").html(respond);
            }
          });
      });

      $("#negara_wali").change(function(){
          var value=$(this).val();
          $.ajax({
            data:{modul:'idpropinsi',id:value},
            success: function(respond){
              $("#provinsi_wali").html(respond);
            }
          });
          $.ajax({
            data:{modul:'idkota',idnegara:value,id:0},
            success: function(respond){
              $("#kota_wali").html(respond);
            }
          });
      });
      $("#provinsi_wali").change(function(){
          var value=$(this).val();
          $.ajax({
            data:{modul:'idkota',idnegara:$("#negara_wali").val(),id:value},
            success: function(respond){
              $("#kota_wali").html(respond);
            }
          });
      });

      $("#idkota").change(function(){
          var value=$(this).val();
          
          if( value=='lainlain'){
            $("#kotatext").show();
          }else{
            $("#kotatext").hide();
          }
          
      });

      $("#kota_ayah").change(function(){
          var value=$(this).val();
          
          if( value=='lainlain'){
            $("#kota_ayahtext").show();
          }else{
            $("#kota_ayahtext").hide();
          }
          
      });

      $("#kota_ibu").change(function(){
          var value=$(this).val();
          
          if( value=='lainlain'){
            $("#kota_ibutext").show();
          }else{
            $("#kota_ibutext").hide();
          }
          
      });

      $("#kota_wali").change(function(){
          var value=$(this).val();
          
          if( value=='lainlain'){
            $("#kota_walitext").show();
          }else{
            $("#kota_walitext").hide();
          }
          
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
    $attributes = array('class' => 'form-horizontal form-validate', 'id' => 'form', 'method' => 'POST');
    echo form_open_multipart($action,$attributes);
?>
<div style="overflow-x:auto;">
  <?php if ($this->session->flashdata('errorlogin')<>"") { ?>
  <div class="alert alert-danger alert-dismissable" align="left">
          <i class="fa fa-ban"></i>
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          <b>Alert!</b> <?php echo $this->session->flashdata('errorlogin') ?>..
      </div>
  <?php } ?>
<?php if($indeks=='1'){ ?>
<table width="100%" border="0">
  <tr><td width="50%" valign="top">  <!-- kolom 1-->
    <table border="0">
       <tr>
         <th align="left">
              <h4>Data Peserta Didik</h4>
         </th></tr>
         <tr>
            <th align="left">
                <label class="control-label" for="minlengthfield">NIK</label>
                <div class="control-group">
                    <div class="controls">:
                            <?php
                              echo form_input(array('id' => 'nik_siswa','name'=>'nik_siswa','value'=>$isi->nik_siswa,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'16', 'data-rule-minlength'=>'16','data-rule-number'=>'true','placeholder'=>'Masukkan 16 Karakter'));
                            ?>
                            <?php //echo  <p id="message"></p> ?>
                    </div>
                </div>
        </th></tr>
        <tr>
           <th align="left">
               <label class="control-label" for="minlengthfield">NISN</label>
               <div class="control-group">
                   <div class="controls">:
                           <?php
                             echo form_input(array('id' => 'nisn','name'=>'nisn','value'=>$isi->nisn,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'10', 'data-rule-minlength'=>'10','data-rule-number'=>'true','placeholder'=>'Masukkan 10 Karakter'));
                           ?>
                           <?php //echo  <p id="message"></p> ?>
                   </div>
               </div>
       </th></tr>
       <tr>
          <th align="left">
              <label class="control-label" for="minlengthfield">Nomor Peserta</label>
              <div class="control-group">
                  <div class="controls">:
                          <?php
                            echo form_input(array('id' => 'nomorpeserta','name'=>'nomorpeserta','value'=>$isi->nomorpeserta,'data-rule-required'=>'false' ,'data-rule-maxlength'=>'20', 'data-rule-minlength'=>'1','data-rule-number'=>'false','placeholder'=>'Masukkan 20 Karakter'));
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
                         echo form_input(array('class' => '','style'=>'margin: 0px 0px 5px;', 'id' => 'nama','name'=>'nama','value'=>$isi->nama,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'500', 'data-rule-minlength'=>'1' ,'placeholder'=>'Masukkan 1-100 Karakter'));
                      ?>
                      <?php //echo  <p id="message"></p> ?>
              </div>
                    </div>
                </th></tr>
        <tr>
            <th align="left">
                  <label class="control-label" for="minlengthfield">Nama Panggilan</label>
                  <div class="control-group">
            <div class="controls">:
                    <?php
                       echo form_input(array('class' => '','style'=>'margin: 0px 0px 5px;', 'id' => 'panggilan','name'=>'panggilan','value'=>$isi->panggilan,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'500', 'data-rule-minlength'=>'1' ,'placeholder'=>'Masukkan 1-100 Karakter'));
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
                            $arrkelamin='data-rule-required=true';
                            $kelamin_opt=array(''=>'Pilih..','l'=>'Laki-Laki','p'=>'Perempuan');
                            echo form_dropdown('kelamin',$kelamin_opt,$isi->kelamin,$arrkelamin);
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
                         echo form_input(array('class' => '','style'=>'margin: 0px 0px 5px;', 'id' => 'tmplahir','name'=>'tmplahir','value'=>$isi->tmplahir,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'500', 'data-rule-minlength'=>'1' ,'placeholder'=>'Masukkan 1-100 Karakter'));
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
              <label class="control-label" for="minlengthfield">Agama</label>
              <div class="control-group">
                  <div class="controls">:
                          <?php
                            $arragama='data-rule-required=false';
                            echo form_dropdown('agama',$agama_opt,$isi->agama,$arragama);
                          ?>
                          <?php //echo  <p id="message"></p> ?>
                  </div>
              </div>
          </th></tr>
          <tr>
          <th align="left">
              <label class="control-label" for="minlengthfield">Kewarganegaraan</label>
              <div class="control-group">
                  <div class="controls">:
                          <?php
                            $arrwarga='data-rule-required=true';
                            $warga_opt=array(''=>'Pilih..','WNI'=>'WNI','WNA'=>'WNA');
                            echo form_dropdown('warga',$warga_opt,$isi->warga,$arrwarga);
                          ?>
                          <?php //echo  <p id="message"></p> ?>
                  </div>
              </div>
          </th></tr>
          <tr>
            <th align="left">
                <label class="control-label" for="minlengthfield">Anak ke</label>
                <div class="control-group">
                    <div class="controls">:
                            <?php
                              echo form_input(array('id' => 'anakke','name'=>'anakke','value'=>$isi->anakke,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'2', 'data-rule-minlength'=>'1','data-rule-number'=>'true','placeholder'=>'Masukkan 1-2 Karakter','style'=>'width:50px !important;'));
                              echo " Dari ".form_input(array('id' => 'jsaudara','name'=>'jsaudara','value'=>$isi->jsaudara,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'2', 'data-rule-minlength'=>'1','data-rule-number'=>'true','placeholder'=>'Masukkan 1-2 Karakter','style'=>'width:50px !important;'));
                            ?>
                            <?php //echo  <p id="message"></p> ?>
                    </div>
                </div>
        </th></tr>
        <tr>
        <th align="left">
            <label class="control-label" for="minlengthfield">Status Anak</label>
            <div class="control-group">
                <div class="controls">:
                        <?php
                          $arrstatanak='data-rule-required=true';
                          $statanak_opt=array(''=>'Pilih..','Anak Kandung'=>'Anak Kandung','Anak Asuh'=>'Anak Asuh','Anak Tiri'=>'Anak Tiri');
                          echo form_dropdown('statanak',$statanak_opt,$isi->statanak,$arrstatanak);
                        ?>
                        <?php //echo  <p id="message"></p> ?>
                </div>
            </div>
        </th></tr>
        <tr>
            <th align="left">
                  <label class="control-label" for="minlengthfield">Bahasa Sehari-hari</label>
                  <div class="control-group">
            <div class="controls">:
                    <?php
                       echo form_input(array('class' => '','style'=>'margin: 0px 0px 5px;', 'id' => 'bahasa','name'=>'bahasa','value'=>$isi->bahasa,'data-rule-required'=>'false' ,'data-rule-maxlength'=>'500', 'data-rule-minlength'=>'1' ,'placeholder'=>'Masukkan 1-100 Karakter'));
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
                    $arrprovinsi='data-rule-required=true id="idprovinsi"';
                    echo form_dropdown('provinsi',$type_provinsi_opt,$isi->provinsi,$arrprovinsi);
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
                  echo form_input(array('class' => '','style'=>'margin: 0px 0px 5px;display:none','name'=>'kotatext','id'=>'kotatext','value'=>'','data-rule-required'=>'true' ,'data-rule-maxlength'=>'500', 'data-rule-minlength'=>'1' ,'placeholder'=>'Masukkan 1-100 Karakter','autocomplete'=>'off'));
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
                  //$arrkecamatan='data-rule-required=true id="idkecamatan"';
                  //echo form_dropdown('kecamatan',$type_kecamatan_opt,$isi->kecamatan,$arrkecamatan);
                  echo form_input(array('class' => '','style'=>'margin: 0px 0px 5px;', 'id' => 'kecamatantext','name'=>'kecamatantext','value'=>$isi->kecamatantext,'data-rule-required'=>'false' ,'data-rule-maxlength'=>'500', 'data-rule-minlength'=>'1' ,'placeholder'=>'Masukkan 1-100 Karakter'));
                  ?>
                  <?php //echo  <p id="message"></p> ?>
          </div>
                </div>
            </th></tr>
            <tr>
          <th align="left" valign="top">
              <label class="control-label" for="minlengthfield">Alamat</label>
              <div class="control-group">
        <div class="controls">:
                <?php
                  echo form_textarea(array('class' => '', 'id' => 'alamatsiswa','name'=>'alamatsiswa','value'=>$isi->alamatsiswa,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'500', 'data-rule-minlength'=>'2' ,'placeholder'=>'Masukkan 2-500 Karakter'));
                ?>
                <?php //echo  <p id="message"></p> ?>
        </div>
              </div>
          </th></tr>
          <tr>
            <th align="left">
                <label class="control-label" for="minlengthfield">Kode Pos</label>
                <div class="control-group">
                    <div class="controls">:
                            <?php
                              echo form_input(array('id' => 'kodepossiswa','name'=>'kodepossiswa','value'=>$isi->kodepossiswa,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'8', 'data-rule-minlength'=>'1','data-rule-number'=>'true','placeholder'=>'Masukkan 1-8 Karakter'));
                            ?>
                            <?php //echo  <p id="message"></p> ?>
                    </div>
                </div>
        </th></tr>
        <tr>
        <th align="left">
            <label class="control-label" for="minlengthfield">No. Telepon</label>
            <div class="control-group">
      <div class="controls">:
              <?php
                echo form_input(array('class' => '', 'id' => 'telponsiswa','name'=>'telponsiswa','value'=>$isi->telponsiswa,'data-rule-required'=>'false' ,'data-rule-maxlength'=>'200', 'data-rule-minlength'=>'2' ,'placeholder'=>'Masukkan 2-200 Karakter','data-rule-number'=>'true'));
              ?>
              <?php //echo  <p id="message"></p> ?>
      </div>
            </div>
        </th></tr>
        <tr>
        <th align="left">
            <label class="control-label" for="minlengthfield">No. Handphone</label>
            <div class="control-group">
      <div class="controls">:
              <?php
                echo form_input(array('class' => '', 'id' => 'hpsiswa','name'=>'hpsiswa','value'=>$isi->hpsiswa,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'200', 'data-rule-minlength'=>'2' ,'placeholder'=>'Masukkan 2-200 Karakter','data-rule-number'=>'true'));
              ?>
              <?php //echo  <p id="message"></p> ?>
      </div>
            </div>
        </th></tr>
        <tr>
        <th align="left">
            <label class="control-label" for="minlengthfield">No. Whatsapp</label>
            <div class="control-group">
      <div class="controls">:
              <?php
                echo form_input(array('class' => '', 'id' => 'pinbbm','name'=>'pinbbm','value'=>$isi->pinbbm,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'200', 'data-rule-minlength'=>'2' ,'placeholder'=>'Masukkan 2-200 Karakter','data-rule-number'=>'true'));
              ?>
              <?php //echo  <p id="message"></p> ?>
      </div>
            </div>
        </th></tr>
        <tr>
        <th align="left">
            <label class="control-label" for="minlengthfield">Email</label>
            <div class="control-group">
      <div class="controls">:
              <?php
                echo form_input(array('class' => '', 'id' => 'emailsiswa','name'=>'emailsiswa','value'=>$isi->emailsiswa,'data-rule-required'=>'false' ,'data-rule-maxlength'=>'200', 'data-rule-minlength'=>'2','data-rule-email'=>'true' ,'placeholder'=>'Masukkan 2-100 Karakter'));
              ?>
              <?php //echo  <p id="message"></p> ?>
      </div>
            </div>
        </th></tr>
        <tr>
           <th align="left">
             <label class="control-label" for="minlengthfield">Foto<br/><b>(Maksimal 5 MB)</b></label>
               <div class="control-group">
                   <div class="controls">
                       <?php
                         echo form_upload(array('id' => 'fileidentitas','name'=>'fileidentitas','data-rule-required'=>'false'));
                       ?>
                       <?php //echo  <p id="message"></p> ?>
                 </div>
               </div>
       </th></tr>
          </table>
  </td>
</tr><tr>
  <td valign="top"> <!-- kolom 2-->
    <table border="0">
       <tr>
         <th align="left">
              <h4>Riwayat Kesehatan</h4>
         </th></tr>
       <tr>
       <th align="left">
           <label class="control-label" for="minlengthfield">Gol. Darah</label>
           <div class="control-group">
               <div class="controls">:
                       <?php
                         $arrdarah='data-rule-required=false';
                         $darah_opt=array(''=>'Pilih..','A'=>'A','AB'=>'AB','B'=>'B','O'=>'O');
                         echo form_dropdown('darah',$darah_opt,$isi->darah,$arrdarah);
                       ?>
                       <?php //echo  <p id="message"></p> ?>
               </div>
           </div>
       </th></tr>
       <tr>
         <th align="left">
             <label class="control-label" for="minlengthfield">Tinggi</label>
             <div class="control-group">
                 <div class="controls">:
                         <?php
                           echo form_input(array('id' => 'tinggi','name'=>'tinggi','value'=>$isi->tinggi,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'6', 'data-rule-minlength'=>'1','data-rule-number'=>'true','placeholder'=>'Masukkan 1-4 Karakter','style'=>'width:50px !important;'));
                         ?> Cm
                         <?php //echo  <p id="message"></p> ?>
                 </div>
             </div>
     </th></tr>
       <tr>
         <th align="left">
             <label class="control-label" for="minlengthfield">Berat</label>
             <div class="control-group">
                 <div class="controls">:
                         <?php
                           echo form_input(array('id' => 'berat','name'=>'berat','value'=>$isi->berat,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'5', 'data-rule-minlength'=>'1','data-rule-number'=>'true','placeholder'=>'Masukkan 1-3 Karakter','style'=>'width:50px !important;'));
                         ?> Kg
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
         $arrjenjangasal="id='jenjangasal' data-rule-required='false' ";
         echo form_dropdown('jenjangasal',$jenjangasal_opt,$isi->jenjangasal,$arrjenjangasal);
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
                  echo form_input(array('class' => '','style'=>'margin: 0px 0px 5px;', 'id' => 'asalsekolah','name'=>'asalsekolah','value'=>$isi->asalsekolah,'data-rule-required'=>'false' ,'data-rule-maxlength'=>'500', 'data-rule-minlength'=>'1' ,'placeholder'=>'Masukkan 1-100 Karakter'));
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
                   $arrtingkat_asal="id='tingkat_asal' data-rule-required=false";
                   echo form_dropdown('tingkat_asal',$tingkat_asal_opt,$isi->tingkat_asal,$arrtingkat_asal);
                 ?>
                     <?php //echo  <p id="message"></p> ?>
             </div>
                   </div>
               </th></tr>
   <!--
   <tr>
       <th align="left">
             <label class="control-label" for="minlengthfield">Asal Jurusan</label>
             <div class="control-group">
       <div class="controls">:
               <?php
                 $arridjurusanasal="id='idjurusanasal' data-rule-required=false";
                 echo form_dropdown('idjurusanasal',$idjurusanasal_opt,$isi->idjurusanasal,$arridjurusanasal);
               ?>
               <?php //echo  <p id="message"></p> ?>
       </div>
             </div>
         </th></tr>
       -->
   <tr>
     <th align="left">
          <h4>Jenjang Terakhir</h4>
     </th></tr>
     <tr>
         <th align="left">
               <label class="control-label" for="minlengthfield">Jenjang Sebelumnya</label>
               <div class="control-group">
         <div class="controls">
                 <?php
                   $arrjenjangakhir="id='jenjangakhir' data-rule-required='true' ";
                   echo form_dropdown('jenjangakhir',$jenjangasal_opt,$isi->jenjangakhir,$arrjenjangakhir);
                   echo "<br/>  ".form_input(array('class' => '','style'=>'margin: 0px 0px 5px;', 'id' => 'sekolahjenjang','name'=>'sekolahjenjang','value'=>$isi->sekolahjenjang,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'500', 'data-rule-minlength'=>'1' ,'placeholder'=>'Masukkan 1-100 Karakter'));
                 ?> *Hanya Nama Sekolah
                 <?php //echo  <p id="message"></p> ?>
         </div>
               </div>
           </th></tr>
           <tr>
             <th align="left">
                 <label class="control-label" for="minlengthfield">Ijazah</label>
                 <div class="control-group">
                     <div class="controls">
                             <?php
                               echo " Thn: ".form_input(array('id' => 't_ijazah','name'=>'t_ijazah','value'=>$isi->t_ijazah,'data-rule-required'=>'false' ,'data-rule-maxlength'=>'4 ', 'data-rule-minlength'=>'4','data-rule-number'=>'true','placeholder'=>'Masukkan 4 Karakter','style'=>'width:100px !important;'));
                               echo " No.: ".form_input(array('class' => '','style'=>'margin: 0px 0px 5px;', 'id' => 'ijazah','name'=>'ijazah','value'=>$isi->ijazah,'data-rule-required'=>'false' ,'data-rule-maxlength'=>'500', 'data-rule-minlength'=>'1' ,'placeholder'=>'Masukkan 1-100 Karakter'));
                             ?>
                             <?php //echo  <p id="message"></p> ?>
                     </div>
                 </div>
         </th></tr>
         <tr>
           <th align="left">
               <label class="control-label" for="minlengthfield">Surat Keterangan Hasil UN</label>
               <div class="control-group">
                   <div class="controls">
                           <?php
                             echo "Thn: ".form_input(array('id' => 't_skh','name'=>'t_skh','value'=>$isi->t_skh,'data-rule-required'=>'false' ,'data-rule-maxlength'=>'4 ', 'data-rule-minlength'=>'4','data-rule-number'=>'true','placeholder'=>'Masukkan 4 Karakter','style'=>'width:100px !important;'));
                             echo " No.: ".form_input(array('class' => '','style'=>'margin: 0px 0px 5px;', 'id' => 'skh','name'=>'skh','value'=>$isi->skh,'data-rule-required'=>'false' ,'data-rule-maxlength'=>'500', 'data-rule-minlength'=>'1' ,'placeholder'=>'Masukkan 1-100 Karakter'));
                           ?>
                           <?php //echo  <p id="message"></p> ?>
                   </div>
               </div>
       </th></tr>
       <tr>
         <th align="left">
             <label class="control-label" for="minlengthfield">Thn. Laporan Hasil Belajar</label>
             <div class="control-group">
                 <div class="controls">:
                         <?php
                           echo form_input(array('id' => 't_lhb','name'=>'t_lhb','value'=>$isi->t_lhb,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'4 ', 'data-rule-minlength'=>'4','data-rule-number'=>'true','placeholder'=>'Masukkan 4 Karakter','style'=>'width:100px !important;'));
                         ?>
                         <?php //echo  <p id="message"></p> ?>
                 </div>
             </div>
     </th></tr>

     <tr>
       <th align="left">
            <h4>Data Lainnya</h4>
       </th></tr>
     <tr>
       <th align="left">
           <label class="control-label" for="minlengthfield">Jarak Tempuh Ke Sekolah</label>
           <div class="control-group">
               <div class="controls">:
                       <?php
                         echo form_input(array('id' => 'jaraktempuh','name'=>'jaraktempuh','value'=>$isi->jaraktempuh,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'3', 'data-rule-minlength'=>'1','data-rule-number'=>'true','placeholder'=>'Masukkan 1-3 Karakter','style'=>'width:50px !important;'));
                       ?> KM
                       <?php //echo  <p id="message"></p> ?>
               </div>
           </div>
   </th></tr>
   <tr>
     <th align="left">
         <label class="control-label" for="minlengthfield">Waktu Tempuh Ke Sekolah</label>
         <div class="control-group">
             <div class="controls">:
                     <?php
                       echo form_input(array('id' => 'waktutempuhjam','name'=>'waktutempuhjam','value'=>$isi->waktutempuhjam,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'2', 'data-rule-minlength'=>'2','data-rule-number'=>'true','placeholder'=>'Jam','style'=>'width:50px !important;'));
                       echo "&nbsp;".form_input(array('id' => 'waktutempuhmenit','name'=>'waktutempuhmenit','value'=>$isi->waktutempuhmenit,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'2', 'data-rule-minlength'=>'2','data-rule-number'=>'true','placeholder'=>'Menit','style'=>'width:50px !important;'));
                     ?>
                     <?php //echo  <p id="message"></p> ?>
             </div>
         </div>
 </th></tr>
 <tr>
      <th align="left">
      <label class="control-label" for="minlengthfield">Penerima KPS<br/>(Kartu Perlindungan Sosial)</label>
      <div class="control-group">
    <div class="controls">:
            <?php
              echo form_checkbox('kps', '1', $isi->kps);
              echo " ".form_input(array('class' => '','style'=>'margin: 0px 0px 5px;', 'id' => 'no_kps','name'=>'no_kps','value'=>$isi->no_kps,'data-rule-required'=>'false' ,'data-rule-maxlength'=>'500', 'data-rule-minlength'=>'1' ,'placeholder'=>'Masukkan No. KPS'));
            ?>
            <?php //echo  <p id="message"></p> ?>
    </div>
      </div>
      </th></tr>
      <tr>
      <th align="left">
      <label class="control-label" for="minlengthfield">Layak PIP<br/>(Program Indonesia Pintar)</label>
      <div class="control-group">
    <div class="controls">:
            <?php
              echo form_checkbox('piplayak', '1', $isi->piplayak);
            ?>
            <?php //echo  <p id="message"></p> ?>
    </div>
      </div>
      </th></tr>
      <tr>
      <th align="left">
      <label class="control-label" for="minlengthfield">Penerima KIP<br/>(Kartu Indonesia Pintar)</label>
      <div class="control-group">
    <div class="controls">:
            <?php
              echo form_checkbox('kip', '1', $isi->kip);
              echo " ".form_input(array('class' => '','style'=>'margin: 0px 0px 5px;', 'id' => 'no_kip','name'=>'no_kip','value'=>$isi->no_kip,'data-rule-required'=>'false' ,'data-rule-maxlength'=>'500', 'data-rule-minlength'=>'1' ,'placeholder'=>'Masukkan No. KIP'));
            ?>
            <?php //echo  <p id="message"></p> ?>
    </div>
      </div>
      </th></tr>
      <tr>
        <th align="left" width=""><label class="control-label" for="minlengthfield">Almarhum Ayah</label>
        <div class="control-group">
 <div class="controls">:
                      <?php
                         echo form_checkbox('almayah', '1', $isi->almayah);
                      ?>
                      <?php //echo  <p id="message"></p> ?>
              </div>
          </div>
          </th>
      </tr>
      <tr>
        <th align="left" width=""><label class="control-label" for="minlengthfield">Almarhum Ibu</label>
        <div class="control-group">
 <div class="controls">:
                      <?php
                         echo form_checkbox('almibu', '1', $isi->almibu);
                      ?>
                      <?php //echo  <p id="message"></p> ?>
              </div>
          </div>
          </th>
      </tr>
      <tr>
        <th align="left" width=""><label class="control-label" for="minlengthfield">Apakah Peserta Didik memiliki wali?</label>
        <div class="control-group">
 <div class="controls">:
                      <?php
                         echo form_checkbox('wali_opt', '1', $isi->wali_opt);
                      ?>
                      <?php //echo  <p id="message"></p> ?>
              </div>
          </div>
          </th>
      </tr>
          </table>
  </td></tr>
</table>
<?php }else if($indeks=='2'){  ?>
      <table border="0" width="*"> <!-- kolom ortu 1-->
        <td>
          <table width="100%" border="0">
         <tr>
           <th align="left" colspan="3">
                <h4>Data Ayah Peserta Didik</h4>
           </th>
         </tr>
         <tr>
           <th align="left" width=""><label class="control-label" for="minlengthfield">Nama Sesuai NIK</label>
           <div class="control-group">
    <div class="controls">:
                         <?php
                            echo form_input(array('class' => '','style'=>'margin: 0px 0px 5px;', 'id' => 'namaayah','name'=>'namaayah','value'=>$isi->namaayah,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'500', 'data-rule-minlength'=>'1' ,'placeholder'=>'Masukkan 1-100 Karakter'));
                         ?>
                         <?php //echo  <p id="message"></p> ?>
                 </div>
             </div>
             </th>
         </tr>
         <tr>
           <th align="left"><label class="control-label" for="minlengthfield">NIK</label>
             <div class="control-group">
                     <div class="controls">:
                         <?php
                         echo form_input(array('id' => 'nik_ayah','name'=>'nik_ayah','value'=>$isi->nik_ayah,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'16', 'data-rule-minlength'=>'16','data-rule-number'=>'true','placeholder'=>'Masukkan 16 Karakter'));
                         ?>
                         <?php //echo  <p id="message"></p> ?>
                 </div>
             </div>
             </th>
         </tr>
         <tr>
           <th align="left"><label class="control-label" for="minlengthfield">Tahun Lahir</label>
             <div class="control-group">
          <div class="controls">:
                         <?php
                         echo form_input(array('id' => 'tahunlahirayah','name'=>'tahunlahirayah','value'=>$isi->tahunlahirayah,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'4 ', 'data-rule-minlength'=>'4','data-rule-number'=>'true','placeholder'=>'Masukkan 4 Karakter','style'=>'width:100px !important;'));
                         ?>
                         <?php //echo  <p id="message"></p> ?>
                 </div>
             </div>
             </th>
         </tr>
         <tr>
           <th align="left"><label class="control-label" for="minlengthfield">Agama</label>
             <div class="control-group">
          <div class="controls">:
                         <?php
                         $arragama_ayah='data-rule-required=false';
                         echo form_dropdown('agama_ayah',$agama_opt,$isi->agama_ayah,$arragama_ayah);
                         ?>
                         <?php //echo  <p id="message"></p> ?>
                 </div>
             </div>
           </th>
         </tr>
         <tr>
           <th align="left"><label class="control-label" for="minlengthfield">Pendidikan</label>
             <div class="control-group">
                     <div class="controls">:
                         <?php
                         $arrpendidikanayah='data-rule-required=false';
                         echo form_dropdown('pendidikanayah',$pendidikan_opt,$isi->pendidikanayah,$arrpendidikanayah);
                         ?>
                         <?php //echo  <p id="message"></p> ?>
                 </div>
             </div>
           </th>
         </tr>
         <tr>
           <th align="left"><label class="control-label" for="minlengthfield">Pekerjaan</label>
             <div class="control-group">
                     <div class="controls">:
                         <?php
                         $arrpekerjaanayah='data-rule-required=false';
                         echo form_dropdown('pekerjaanayah',$pekerjaan_opt,$isi->pekerjaanayah,$arrpekerjaanayah);
                         ?>
                         <?php //echo  <p id="message"></p> ?>
                 </div>
             </div>
           </th>
         </tr>
         <tr>
           <th align="left"><label class="control-label" for="minlengthfield">Nama Instansi</label>
             <div class="control-group">
                     <div class="controls">:
                         <?php
                         //$arrinstansiayah='data-rule-required=false';
                         //echo form_dropdown('instansiayah',$instansi_opt,$isi->instansiayah,$arrinstansiayah);
                         echo form_input(array('class' => '','style'=>'margin: 0px 0px 5px;', 'id' => 'instansiayahtext','name'=>'instansiayahtext','value'=>$isi->instansiayahtext,'data-rule-required'=>'false' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'1' ,'placeholder'=>'Masukkan 1-100 Karakter'));
                         ?>
                         <?php //echo  <p id="message"></p> ?>
                 </div>
             </div>
           </th>
         </tr>
         <tr>
           <th align="left"><label class="control-label" for="minlengthfield">Penghasilan</label>
             <div class="control-group">
                     <div class="controls">:
                         <?php
                         $arrpenghasilanayah='data-rule-required=false';
                         echo form_dropdown('penghasilanayah',$penghasilan_opt,$isi->penghasilanayah,$arrpenghasilanayah);
                         ?>
                         <?php //echo  <p id="message"></p> ?>
                 </div>
             </div>
           </th>
         </tr>
         <tr>
           <th align="left"><label class="control-label" for="minlengthfield">Negara</label>
             <div class="control-group">
                     <div class="controls">:
                         <?php
                         $arrnegara_ayah='data-rule-required=true id="negara_ayah"';
                         echo form_dropdown('negara_ayah',$type_negara_ayah_opt,$isi->negara_ayah,$arrnegara_ayah);
                         ?>
                         <?php //echo  <p id="message"></p> ?>
                 </div>
             </div>
           </th>
         </tr>
         <tr>
           <th align="left"><label class="control-label" for="minlengthfield">Provinsi</label>
             <div class="control-group">
                     <div class="controls">:
                         <?php
                         $arrprovinsi_ayah='data-rule-required=true id="provinsi_ayah"';
                         echo form_dropdown('provinsi_ayah',$type_provinsi_ayah_opt,$isi->provinsi_ayah,$arrprovinsi_ayah);
                         ?>
                         <?php //echo  <p id="message"></p> ?>
                 </div>
             </div>
           </th>
         </tr>
         <tr>
           <th align="left"><label class="control-label" for="minlengthfield">Kota</label>
             <div class="control-group">
                     <div class="controls">:
                         <?php
                         $arrkota_ayah='data-rule-required=true id="kota_ayah"';
                         echo form_dropdown('kota_ayah',$type_kota_ayah_opt,$isi->kota_ayah,$arrkota_ayah);
                         echo form_input(array('class' => '','style'=>'margin: 0px 0px 5px;display:none','name'=>'kota_ayahtext','id'=>'kota_ayahtext','value'=>'','data-rule-required'=>'true' ,'data-rule-maxlength'=>'500', 'data-rule-minlength'=>'1' ,'placeholder'=>'Masukkan 1-100 Karakter','autocomplete'=>'off'));
                         ?>
                         <?php //echo  <p id="message"></p> ?>
                 </div>
             </div>
           </th>
         </tr>
         <tr>
           <th align="left"><label class="control-label" for="minlengthfield">Alamat</label>
             <div class="control-group">
                     <div class="controls">:
                         <?php
                         echo form_textarea(array('class' => '', 'id' => 'alamat_ayah','name'=>'alamat_ayah','value'=>$isi->alamat_ayah,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'500', 'data-rule-minlength'=>'2' ,'placeholder'=>'Masukkan 2-500 Karakter'));
                         ?>
                         <?php //echo  <p id="message"></p> ?>
                 </div>
             </div>
           </th>
         </tr>
         <tr>
           <th align="left"><label class="control-label" for="minlengthfield">Kode Pos</label>
             <div class="control-group">
                     <div class="controls">:
                         <?php
                         echo form_input(array('id' => 'kodepos_ayah','name'=>'kodepos_ayah','value'=>$isi->kodepos_ayah,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'8', 'data-rule-minlength'=>'1','data-rule-number'=>'true','placeholder'=>'Masukkan 1-8 Karakter','data-rule-number'=>'true'));
                         ?>
                         <?php //echo  <p id="message"></p> ?>
                 </div>
             </div>
           </th>
         </tr>
         <tr>
           <th align="left"><label class="control-label" for="minlengthfield">Telepon</label>
             <div class="control-group">
                     <div class="controls">:
                         <?php
                         echo form_input(array('class' => '', 'id' => 'tel_ayah','name'=>'tel_ayah','value'=>$isi->tel_ayah,'data-rule-required'=>'false' ,'data-rule-maxlength'=>'200', 'data-rule-minlength'=>'2' ,'placeholder'=>'Masukkan 2-200 Karakter','data-rule-number'=>'true'));
                         ?>
                         <?php //echo  <p id="message"></p> ?>
                 </div>
             </div>
           </th>
         </tr>
         <tr>
           <th align="left"><label class="control-label" for="minlengthfield">Handphone</label>
             <div class="control-group">
                     <div class="controls">:
                         <?php
                         echo form_input(array('class' => '', 'id' => 'hp_ayah','name'=>'hp_ayah','value'=>$isi->hp_ayah,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'200', 'data-rule-minlength'=>'2' ,'placeholder'=>'Masukkan 2-200 Karakter','data-rule-number'=>'true'));
                         ?>
                         <?php //echo  <p id="message"></p> ?>
                 </div>
             </div>
           </th>
         </tr>
         <tr>
           <th align="left"><label class="control-label" for="minlengthfield">Whatsapp</label>
             <div class="control-group">
                     <div class="controls">:
                         <?php
                         echo form_input(array('class' => '', 'id' => 'bbm_ayah','name'=>'bbm_ayah','value'=>$isi->bbm_ayah,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'200', 'data-rule-minlength'=>'2' ,'placeholder'=>'Masukkan 2-200 Karakter','data-rule-number'=>'true'));
                         ?>
                         <?php //echo  <p id="message"></p> ?>
                 </div>
             </div>
           </th>
         </tr>
         <tr>
           <th align="left"><label class="control-label" for="minlengthfield">Email</label>
             <div class="control-group">
                     <div class="controls">:
                         <?php
                         echo form_input(array('class' => '', 'id' => 'emailayah','name'=>'emailayah','value'=>$isi->emailayah,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'200', 'data-rule-minlength'=>'2','data-rule-email'=>'true' ,'placeholder'=>'Masukkan 2-100 Karakter'));
                         ?>
                         <?php //echo  <p id="message"></p> ?>
                 </div>
             </div>
           </th>
         </tr>
       </table>
      </td>
       </tr><tr>
        <td>
            <table width="100%" border="0">
           <tr>
             <th align="left" colspan="3">
                  <h4>Data Ibu Peserta Didik</h4>
             </th>
           </tr>
          <tr>
            <th align="left" width=""><label class="control-label" for="minlengthfield">Nama Sesuai NIK</label>
              <div class="control-group">
                       <div class="controls">:
                          <?php
                             echo form_input(array('class' => '','style'=>'margin: 0px 0px 5px;', 'id' => 'namaibu','name'=>'namaibu','value'=>$isi->namaibu,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'500', 'data-rule-minlength'=>'1' ,'placeholder'=>'Masukkan 1-100 Karakter'));
                          ?>
                          <?php //echo  <p id="message"></p> ?>
                  </div>
              </div>
            </th>
          </tr>
          <tr>
            <th align="left"><label class="control-label" for="minlengthfield">NIK</label>
              <div class="control-group">
                       <div class="controls">:
                          <?php
                          echo form_input(array('id' => 'nik_ibu','name'=>'nik_ibu','value'=>$isi->nik_ibu,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'16', 'data-rule-minlength'=>'16','data-rule-number'=>'true','placeholder'=>'Masukkan 16 Karakter'));
                          ?>
                          <?php //echo  <p id="message"></p> ?>
                  </div>
              </div>
            </th>
          </tr>
          <tr>
            <th align="left"><label class="control-label" for="minlengthfield">Tahun Lahir</label>
              <div class="control-group">
                       <div class="controls">:
                          <?php
                          echo form_input(array('id' => 'tahunlahiribu','name'=>'tahunlahiribu','value'=>$isi->tahunlahiribu,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'4 ', 'data-rule-minlength'=>'4','data-rule-number'=>'true','placeholder'=>'Masukkan 4 Karakter','style'=>'width:100px !important;'));
                          ?>
                          <?php //echo  <p id="message"></p> ?>
                  </div>
              </div>
            </th>
          </tr>
          <tr>
            <th align="left"><label class="control-label" for="minlengthfield">Agama</label>
              <div class="control-group">
                       <div class="controls">:
                          <?php
                          $arragama_ibu='data-rule-required=false';
                          echo form_dropdown('agama_ibu',$agama_opt,$isi->agama_ibu,$arragama_ibu);
                          ?>
                          <?php //echo  <p id="message"></p> ?>
                  </div>
              </div>
            </th>
          </tr>
          <tr>
            <th align="left"><label class="control-label" for="minlengthfield">Pendidikan</label>
              <div class="control-group">
                       <div class="controls">:
                          <?php
                          $arrpendidikanibu='data-rule-required=false';
                          echo form_dropdown('pendidikanibu',$pendidikan_opt,$isi->pendidikanibu,$arrpendidikanibu);
                          ?>
                          <?php //echo  <p id="message"></p> ?>
                  </div>
              </div>
            </th>
          </tr>
          <tr>
            <th align="left"><label class="control-label" for="minlengthfield">Pekerjaan</label>
              <div class="control-group">
                       <div class="controls">:
                          <?php
                          $arrpekerjaanibu='data-rule-required=false';
                          echo form_dropdown('pekerjaanibu',$pekerjaan_opt,$isi->pekerjaanibu,$arrpekerjaanibu);
                          ?>
                          <?php //echo  <p id="message"></p> ?>
                  </div>
              </div>
            </th>
          </tr>
          <tr>
            <th align="left"><label class="control-label" for="minlengthfield">Nama Instansi</label>
              <div class="control-group">
                       <div class="controls">:
                          <?php
                          //$arrinstansiibu='data-rule-required=false';
                          //echo form_dropdown('instansiibu',$instansi_opt,$isi->instansiibu,$arrinstansiibu);
                          echo form_input(array('class' => '','style'=>'margin: 0px 0px 5px;', 'id' => 'instansiibutext','name'=>'instansiibutext','value'=>$isi->instansiibutext,'data-rule-required'=>'false' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'1' ,'placeholder'=>'Masukkan 1-100 Karakter'));
                          ?>
                          <?php //echo  <p id="message"></p> ?>
                  </div>
              </div>
            </th>
          </tr>
          <tr>
            <th align="left"><label class="control-label" for="minlengthfield">Penghasilan</label>
              <div class="control-group">
                       <div class="controls">:
                          <?php
                          $arrpenghasilanibu='data-rule-required=false';
                          echo form_dropdown('penghasilanibu',$penghasilan_opt,$isi->penghasilanibu,$arrpenghasilanibu);
                          ?>
                          <?php //echo  <p id="message"></p> ?>
                  </div>
              </div>
            </th>
          </tr>
          <tr>
            <th align="left"><label class="control-label" for="minlengthfield">Negara</label>
              <div class="control-group">
                       <div class="controls">:
                          <?php
                          $arrnegara_ibu='data-rule-required=true id="negara_ibu"';
                          echo form_dropdown('negara_ibu',$type_negara_ibu_opt,$isi->negara_ibu,$arrnegara_ibu);
                          ?>
                          <?php //echo  <p id="message"></p> ?>
                  </div>
              </div>
            </th>
          </tr>
          <tr>
            <th align="left"><label class="control-label" for="minlengthfield">Provinsi</label>
              <div class="control-group">
                       <div class="controls">:
                          <?php
                          $arrprovinsi_ibu='data-rule-required=true id="provinsi_ibu"';
                          echo form_dropdown('provinsi_ibu',$type_provinsi_ibu_opt,$isi->provinsi_ibu,$arrprovinsi_ibu);
                          ?>
                          <?php //echo  <p id="message"></p> ?>
                  </div>
              </div>
            </th>
          </tr>
          <tr>
            <th align="left"><label class="control-label" for="minlengthfield">Kota</label>
              <div class="control-group">
                       <div class="controls">:
                          <?php
                          $arrkota_ibu='data-rule-required=true id="kota_ibu"';
                          echo form_dropdown('kota_ibu',$type_kota_ibu_opt,$isi->kota_ibu,$arrkota_ibu);
                          echo form_input(array('class' => '','style'=>'margin: 0px 0px 5px;display:none','name'=>'kota_ibutext','id'=>'kota_ibutext','value'=>'','data-rule-required'=>'true' ,'data-rule-maxlength'=>'500', 'data-rule-minlength'=>'1' ,'placeholder'=>'Masukkan 1-100 Karakter','autocomplete'=>'off'));
                          ?>
                          <?php //echo  <p id="message"></p> ?>
                  </div>
              </div>
            </th>
          </tr>
          <tr>
            <th align="left"><label class="control-label" for="minlengthfield">Alamat</label>
              <div class="control-group">
                       <div class="controls">:
                          <?php
                          echo form_textarea(array('class' => '', 'id' => 'alamat_ibu','name'=>'alamat_ibu','value'=>$isi->alamat_ibu,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'500', 'data-rule-minlength'=>'2' ,'placeholder'=>'Masukkan 2-500 Karakter'));
                          ?>
                          <?php //echo  <p id="message"></p> ?>
                  </div>
              </div>
            </th>
          </tr>
          <tr>
            <th align="left"><label class="control-label" for="minlengthfield">Kode Pos</label>
              <div class="control-group">
                       <div class="controls">:
                          <?php
                          echo form_input(array('id' => 'kodepos_ibu','name'=>'kodepos_ibu','value'=>$isi->kodepos_ibu,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'8', 'data-rule-minlength'=>'1','data-rule-number'=>'true','placeholder'=>'Masukkan 1-8 Karakter','data-rule-number'=>'true'));
                          ?>
                          <?php //echo  <p id="message"></p> ?>
                  </div>
              </div>
            </th>
          </tr>
          <tr>
            <th align="left"><label class="control-label" for="minlengthfield">Telepon</label>
              <div class="control-group">
                       <div class="controls">:
                          <?php
                          echo form_input(array('class' => '', 'id' => 'tel_ibu','name'=>'tel_ibu','value'=>$isi->tel_ibu,'data-rule-required'=>'false' ,'data-rule-maxlength'=>'200', 'data-rule-minlength'=>'2' ,'placeholder'=>'Masukkan 2-200 Karakter','data-rule-number'=>'true'));
                          ?>
                          <?php //echo  <p id="message"></p> ?>
                  </div>
              </div>
            </th>
          </tr>
          <tr>
            <th align="left"><label class="control-label" for="minlengthfield">Handphone</label>
              <div class="control-group">
                       <div class="controls">:
                          <?php
                          echo form_input(array('class' => '', 'id' => 'hp_ibu','name'=>'hp_ibu','value'=>$isi->hp_ibu,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'200', 'data-rule-minlength'=>'2' ,'placeholder'=>'Masukkan 2-200 Karakter','data-rule-number'=>'true'));
                          ?>
                          <?php //echo  <p id="message"></p> ?>
                  </div>
              </div>
            </th>
          </tr>
          <tr>
            <th align="left"><label class="control-label" for="minlengthfield">Whatsapp</label>
              <div class="control-group">
                       <div class="controls">:
                          <?php
                          echo form_input(array('class' => '', 'id' => 'bbm_ibu','name'=>'bbm_ibu','value'=>$isi->bbm_ibu,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'200', 'data-rule-minlength'=>'2' ,'placeholder'=>'Masukkan 2-200 Karakter','data-rule-number'=>'true'));
                          ?>
                          <?php //echo  <p id="message"></p> ?>
                  </div>
              </div>
            </th>
          </tr>
          <tr>
            <th align="left"><label class="control-label" for="minlengthfield">Email</label>
              <div class="control-group">
                       <div class="controls">:
                          <?php
                          echo form_input(array('class' => '', 'id' => 'emailibu','name'=>'emailibu','value'=>$isi->emailibu,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'200', 'data-rule-minlength'=>'2','data-rule-email'=>'true' ,'placeholder'=>'Masukkan 2-100 Karakter'));
                          ?>
                          <?php //echo  <p id="message"></p> ?>
                  </div>
              </div>
            </th>
          </tr>
        </td>
      </table>
      <?php if($isi->wali_opt==1) { ?>
      <table width="100%" border="0">
        <tr><td width="50%" valign="top">  <!-- kolom wali 1-->
      <table border="0" width="*"> <!-- kolom wali 1-->
         <tr>
           <th align="left" colspan="3">
                <h4>Data Wali Peserta Didik</h4>
           </th>
         </tr>
         <tr>
           <th align="left" width="200px"><label class="control-label" for="minlengthfield">Nama Sesuai NIK</label>
             <div class="control-group">
                     <div class="controls">:
                         <?php
                            echo form_input(array('class' => '','style'=>'margin: 0px 0px 5px;', 'id' => 'wali','name'=>'wali','value'=>$isi->wali,'data-rule-required'=>'false' ,'data-rule-maxlength'=>'500', 'data-rule-minlength'=>'1' ,'placeholder'=>'Masukkan 1-100 Karakter'));
                         ?>
                         <?php //echo  <p id="message"></p> ?>
                 </div>
             </div>
           </th>
         </tr>
         <tr>
           <th align="left"><label class="control-label" for="minlengthfield">NIK</label>
             <div class="control-group">
                     <div class="controls">:
                         <?php
                         echo form_input(array('id' => 'nik_wali','name'=>'nik_wali','value'=>$isi->nik_wali,'data-rule-required'=>'false' ,'data-rule-maxlength'=>'16', 'data-rule-minlength'=>'16','data-rule-number'=>'true','placeholder'=>'Masukkan 16 Karakter'));
                         ?>
                         <?php //echo  <p id="message"></p> ?>
                 </div>
             </div>
           </th>
         </tr>
         <tr>
           <th align="left"><label class="control-label" for="minlengthfield">Tahun Lahir</label>
             <div class="control-group">
                     <div class="controls">:
                         <?php
                         echo form_input(array('id' => 'tahunlahirwali','name'=>'tahunlahirwali','value'=>$isi->tahunlahirwali,'data-rule-required'=>'false' ,'data-rule-maxlength'=>'4 ', 'data-rule-minlength'=>'4','data-rule-number'=>'true','placeholder'=>'Masukkan 4 Karakter','style'=>'width:100px !important;'));
                         ?>
                         <?php //echo  <p id="message"></p> ?>
                 </div>
             </div>
           </th>
         </tr>
         <tr>
           <th align="left"><label class="control-label" for="minlengthfield">Agama</label>
             <div class="control-group">
                     <div class="controls">:
                         <?php
                         $arragama_wali='data-rule-required=false';
                         echo form_dropdown('agama_wali',$agama_opt,$isi->agama_wali,$arragama_wali);
                         ?>
                         <?php //echo  <p id="message"></p> ?>
                 </div>
             </div>
           </th>
         </tr>
         <tr>
           <th align="left"><label class="control-label" for="minlengthfield">Pendidikan</label>
             <div class="control-group">
                     <div class="controls">:
                         <?php
                         $arrpendidikanwali='data-rule-required=false';
                         echo form_dropdown('pendidikanwali',$pendidikan_opt,$isi->pendidikanwali,$arrpendidikanwali);
                         ?>
                         <?php //echo  <p id="message"></p> ?>
                 </div>
             </div>
           </th>
         </tr>
         <tr>
           <th align="left"><label class="control-label" for="minlengthfield">Pekerjaan</label>
             <div class="control-group">
                     <div class="controls">:
                         <?php
                         $arrpekerjaanwali='data-rule-required=false';
                         echo form_dropdown('pekerjaanwali',$pekerjaan_opt,$isi->pekerjaanwali,$arrpekerjaanwali);
                         ?>
                         <?php //echo  <p id="message"></p> ?>
                 </div>
             </div>
           </th>
         </tr>
         <tr>
           <th align="left"><label class="control-label" for="minlengthfield">Nama Instansi</label>
             <div class="control-group">
                     <div class="controls">:
                         <?php
                         //$arrinstansiwali='data-rule-required=false';
                         //echo form_dropdown('instansiwali',$instansi_opt,$isi->instansiwali,$arrinstansiwali);
                         echo form_input(array('class' => '','style'=>'margin: 0px 0px 5px;', 'id' => 'instansiwalitext','name'=>'instansiwalitext','value'=>$isi->instansiwalitext,'data-rule-required'=>'false' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'1' ,'placeholder'=>'Masukkan 1-100 Karakter'));
                         ?>
                         <?php //echo  <p id="message"></p> ?>
                 </div>
             </div>
           </th>
         </tr>
         <tr>
           <th align="left"><label class="control-label" for="minlengthfield">Penghasilan</label>
             <div class="control-group">
                     <div class="controls">:
                         <?php
                         $arrpenghasilanwali='data-rule-required=false';
                         echo form_dropdown('penghasilanwali',$penghasilan_opt,$isi->penghasilanwali,$arrpenghasilanwali);
                         ?>
                         <?php //echo  <p id="message"></p> ?>
                 </div>
             </div>
           </th>
         </tr>
         <tr>
           <th align="left"><label class="control-label" for="minlengthfield">Negara</label>
             <div class="control-group">
                     <div class="controls">:
                         <?php
                         $arrnegara_wali='data-rule-required=false id="negara_wali"';
                         echo form_dropdown('negara_wali',$type_negara_wali_opt,$isi->negara_wali,$arrnegara_wali);
                         ?>
                         <?php //echo  <p id="message"></p> ?>
                 </div>
             </div>
           </th>
         </tr>
         <tr>
           <th align="left"><label class="control-label" for="minlengthfield">Provinsi</label>
             <div class="control-group">
                     <div class="controls">:
                         <?php
                         $arrprovinsi_wali='data-rule-required=false id="provinsi_wali"';
                         echo form_dropdown('provinsi_wali',$type_provinsi_wali_opt,$isi->provinsi_wali,$arrprovinsi_wali);
                         ?>
                         <?php //echo  <p id="message"></p> ?>
                 </div>
             </div>
           </th>
         </tr>
         <tr>
           <th align="left"><label class="control-label" for="minlengthfield">Kota</label>
             <div class="control-group">
                     <div class="controls">:
                         <?php
                         $arrkota_wali='data-rule-required=false id="kota_wali"';
                         echo form_dropdown('kota_wali',$type_kota_wali_opt,$isi->kota_wali,$arrkota_wali);
                         echo form_input(array('class' => '','style'=>'margin: 0px 0px 5px;display:none','name'=>'kota_walitext','id'=>'kota_walitext','value'=>'','data-rule-required'=>'true' ,'data-rule-maxlength'=>'500', 'data-rule-minlength'=>'1' ,'placeholder'=>'Masukkan 1-100 Karakter','autocomplete'=>'off'));
                         ?>
                         <?php //echo  <p id="message"></p> ?>
                 </div>
             </div>
           </th>
         </tr>
         <tr>
           <th align="left"><label class="control-label" for="minlengthfield">Alamat</label>
             <div class="control-group">
                     <div class="controls">:
                         <?php
                         echo form_textarea(array('class' => '', 'id' => 'alamat_wali','name'=>'alamat_wali','value'=>$isi->alamat_wali,'data-rule-required'=>'false' ,'data-rule-maxlength'=>'500', 'data-rule-minlength'=>'2' ,'placeholder'=>'Masukkan 2-500 Karakter'));
                         ?>
                         <?php //echo  <p id="message"></p> ?>
                 </div>
             </div>
           </th>
         </tr>
         <tr>
           <th align="left"><label class="control-label" for="minlengthfield">Kode Pos</label>
             <div class="control-group">
                     <div class="controls">:
                         <?php
                         echo form_input(array('id' => 'kodepos_wali','name'=>'kodepos_wali','value'=>$isi->kodepos_wali,'data-rule-required'=>'false' ,'data-rule-maxlength'=>'8', 'data-rule-minlength'=>'1','data-rule-number'=>'true','placeholder'=>'Masukkan 1-8 Karakter'));
                         ?>
                         <?php //echo  <p id="message"></p> ?>
                 </div>
             </div>
           </th>
         </tr>
         <tr>
           <th align="left"><label class="control-label" for="minlengthfield">Telepon</label>
             <div class="control-group">
                     <div class="controls">:
                         <?php
                         echo form_input(array('class' => '', 'id' => 'tel_wali','name'=>'tel_wali','value'=>$isi->tel_wali,'data-rule-required'=>'false' ,'data-rule-maxlength'=>'200', 'data-rule-minlength'=>'2' ,'placeholder'=>'Masukkan 2-200 Karakter','data-rule-number'=>'true'));
                         ?>
                         <?php //echo  <p id="message"></p> ?>
                 </div>
             </div>
           </th>
         </tr>
         <tr>
           <th align="left"><label class="control-label" for="minlengthfield">Handphone</label>
             <div class="control-group">
                     <div class="controls">:
                         <?php
                         echo form_input(array('class' => '', 'id' => 'hp_wali','name'=>'hp_wali','value'=>$isi->hp_wali,'data-rule-required'=>'false' ,'data-rule-maxlength'=>'200', 'data-rule-minlength'=>'2' ,'placeholder'=>'Masukkan 2-200 Karakter','data-rule-number'=>'true'));
                         ?>
                         <?php //echo  <p id="message"></p> ?>
                 </div>
             </div>
           </th>
         </tr>
         <tr>
           <th align="left"><label class="control-label" for="minlengthfield">Whatsapp</label>
             <div class="control-group">
                     <div class="controls">:
                         <?php
                         echo form_input(array('class' => '', 'id' => 'bbm_wali','name'=>'bbm_wali','value'=>$isi->bbm_wali,'data-rule-required'=>'false' ,'data-rule-maxlength'=>'200', 'data-rule-minlength'=>'2' ,'placeholder'=>'Masukkan 2-200 Karakter','data-rule-number'=>'true'));
                         ?>
                         <?php //echo  <p id="message"></p> ?>
                 </div>
             </div>
           </th>
         </tr>
         <tr>
           <th align="left"><label class="control-label" for="minlengthfield">Email</label>
             <div class="control-group">
                     <div class="controls">:
                         <?php
                         echo form_input(array('class' => '', 'id' => 'emailwali','name'=>'emailwali','value'=>$isi->emailwali,'data-rule-required'=>'false' ,'data-rule-maxlength'=>'200', 'data-rule-minlength'=>'2','data-rule-email'=>'true' ,'placeholder'=>'Masukkan 2-100 Karakter'));
                         ?>
                         <?php //echo  <p id="message"></p> ?>
                 </div>
             </div>
           </th>
         </tr>
      </table>
    <?php } ?>
    </td>
    </tr>

    <tr>
      <td width="50%" valign="top">  <!-- kolom wali 2 -->
        <table border="0" width="*"> <!-- kolom wali 1-->
           <tr>
             <th align="left" colspan="3">
                  <h4>Data Administrasi Peserta Didik</h4>
             </th>
           </tr>
           <tr>
             <th align="left"><label class="control-label" for="minlengthfield">Alamat Surat</label>
               <div class="control-group">
                       <div class="controls">:
                           <?php
                           $arralamatsurat='data-rule-required=true id="alamatsurat"';
                           echo form_dropdown('alamatsurat',$alamatsurat_opt,$isi->alamatsurat,$arralamatsurat);
                           ?>
                           <?php //echo  <p id="message"></p> ?>
                   </div>
               </div>
             </th>
           </tr>
           <tr>
             <th align="left" valign="top"><label class="control-label" for="minlengthfield">Info Administrasi dan Akademik</label>
               <div class="control-group">
                       <div class="controls">
                           <?php
                           $CI->p_c->checkbox_more('info_media',$info_media_opt,$isi->info_media,0);
                           ?>
                           <?php //echo  <p id="message"></p> ?>
                   </div>
               </div>
             </th>
           </tr>
           <tr>
             <th align="left"><label class="control-label" for="minlengthfield">Penanggung Jawab Akademik</label>
               <div class="control-group">
                       <div class="controls">:
                           <?php
                           $arrpj='data-rule-required=true id="pj"';
                           echo form_dropdown('pj',$penanggung_jawab_opt,$isi->pj,$arrpj);
                           ?>
                           <?php //echo  <p id="message"></p> ?>
                   </div>
               </div>
             </th>
           </tr>
           <tr>
             <th align="left"><label class="control-label" for="minlengthfield">Penanggung Jawab Administrasi</label>
               <div class="control-group">
                       <div class="controls">:
                           <?php
                           $arrpja='data-rule-required=true id="pja"';
                           echo form_dropdown('pja',$penanggung_jawab_opt,$isi->pja,$arrpja);
                           ?>
                           <?php //echo  <p id="message"></p> ?>
                   </div>
               </div>
             </th>
           </tr>

        </table>
      </td></tr>
    </table>
<?php } ?>
</div>
      <br/>
    <table>
      <tr>
              <th align="left">
                <input type="hidden" name="indeks" value="<?php echo $indeks?>">
                <button class='btn btn-primary' onclick="return validate()">Simpan</button>
                <?php
                if((($indeks-1))>=1){
                  echo "<a href=javascript:void(window.open('".site_url("psb_calonsiswa/index/".($indeks-1))."')) class='btn btn-success'>Kembali</a>";
                }
                ?>
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
