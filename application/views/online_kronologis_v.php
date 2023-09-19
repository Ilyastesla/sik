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
                        <li><a href="javascript:void(window.open('<?php echo site_url('online_kronologis/tambah'); ?>'))" ><i class="fa fa-plus-square"></i> Tambah</a></li>

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
                                <label class="control-label" for="minlengthfield">Nama</label>
                                <div class="control-group">
                                  <div class="controls">:
                                      <?php
                                        $arrjeniscari='data-rule-required=false';
                                        echo form_dropdown('jeniscari',$jeniscari_opt,$this->input->post('jeniscari'),$arrjeniscari);
                                        echo "&nbsp;&nbsp;";
                                        echo form_input(array('class' => '','style'=>'margin: 0px 0px 5px; width: 300px;', 'id' => 'nama','name'=>'nama','value'=>$this->input->post('nama'),'data-rule-required'=>'false' ,'data-rule-maxlength'=>'500', 'data-rule-minlength'=>'3' ,'placeholder'=>'Masukkan 1-100 Karakter'));
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
          						                		$arriddepartemen='data-rule-required=false  onchange=javascript:this.form.submit();';
          						                		echo form_dropdown('iddepartemen',$iddepartemen_opt,$this->input->post('iddepartemen'),$arriddepartemen);
          						                	?>
          						                	<?php //echo  <p id="message"></p> ?>
              											</div>
            				              </div>
            						         </th>
                                 <!--
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
                                 -->
    			                  </tr>
                            <tr>
                                <th align="left">
                                  <label class="control-label" for="minlengthfield">Tahun Pelajaran</label>
                                  <div class="control-group">
                                      <div class="controls">:
                                        <?php
                                          $arridtahunajaran="id='idtahunajaran' data-rule-required='false' onchange=javascript:this.form.submit();";
                                          echo form_dropdown('idtahunajaran',$idtahunajaran_opt,$this->input->post("idtahunajaran"),$arridtahunajaran);
                                        ?>
                                              <?php //echo  <p id="message"></p> ?>
                                      </div>
                                  </div>
                                </th>
                              </tr>
                            <!--
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
                                    <label class="control-label" for="minlengthfield">Periode</label>
                                    <div class="control-group">
                              <div class="controls">:
                                      <?php
                                      echo form_input(array('class' => '', 'id' => 'dp1','name'=>'periode1','value'=>$this->input->post('periode1'),'data-rule-required'=>'false' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'2' ,'placeholder'=>'DD-MM-YYYY','autocomplete'=>'off'));
                                      echo form_input(array('class' => '', 'id' => 'dp2','name'=>'periode2','value'=>$this->input->post('periode2'),'data-rule-required'=>'false' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'2' ,'placeholder'=>'DD-MM-YYYY','autocomplete'=>'off'));
                                      ?>
                                      <?php //echo  <p id="message"></p> ?>
                              </div>
                                    </div>
                                </th>
                              </tr>
                              <tr>
                                   <th align="left">
                                      <label class="control-label" for="minlengthfield">Status</label>
                                      <div class="control-group">
                                        <div class="controls">:
                                            <?php
                                              $arrstatus='data-rule-required=false';
                                              echo form_dropdown('status',$status_opt,$this->input->post('status'),$arrstatus);
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
                                                echo "<th width='50'>No.</th>";
                                                //echo "<th width='120'>Lokasi Sekolah</th>";
                                                echo "<th>Jenjang</th>";
                                                //echo "<th width='120'>No. Identitas</th>";
                                                echo "<th>Nama Orangtua</th>";
                                                echo "<th>Nama Calon</th>";
                                                //echo "<th>Tgl. Lahir</th>";
                                                //echo "<th>Umur</th>";
                                                echo "<th>Tahun Pelajaran</th>";
                                                echo "<th width='120'>Tgl. Posting</th>";
                                                echo "<th width='120'>Diproses Oleh</th>";
                                                echo "<th>Status</th>";
                                                echo "<th width='*'>Aksi</th>";
                                                ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        	<?php
                                        	$CI =& get_instance();$no=1;
											foreach((array)$show_table as $row) {
											    echo "<tr>";
											    echo "<td align='center'>".$no++."</td>";
                          //echo "<td align='center'>".$row->companytext."</td>";
                          echo "<td align='center'>".strtoupper($row->jenjang)."</td>";
                          /*
                          echo "<td align='center'>";
                          echo "<a href=javascript:void(window.open('".site_url('online_kronologis/viewkronologis/'.$row->replid)."')) >$row->noidentitas</a><br/>";
                          echo "</td>";
                          */
                          //<a href=javascript:void(window.open('".site_url('online_kronologis/view/'.$row->replid)."')) >".($row->namaortu." (".$row->ortu.")")."</a>
                          echo "<td align=''>";
                          echo "<b>".$row->namaortu."</b> (".$row->ortu.") <a href=javascript:void(window.open('".site_url('online_kronologis/viewkronologis/'.$row->replid)."')) class='btn btn-xs btn-info fa fa-circle-o' ></a><br/>";
                          echo "Email: <a href = 'mailto: ".$row->emailortu."'>".$row->emailortu."</a><br/>";
                          echo "Token: ".$row->tokenonline."<br/>";
                          $wa="+62".substr($row->whatsapportu,1);
                          echo "WA: <a href='https://api.whatsapp.com/send?phone=".$wa."' >".$row->whatsapportu."</a>";
                          echo "</td>";
                          echo "<td align=''><b>".$row->namacalon."</b></td>";
                          //echo "<td align=''>".($CI->p_c->tgl_indo($row->tanggallahir))."</td>";
                          //echo "<td align=''>".$row->umur."</td>";
                          echo "<td align=''>".$row->tahunajarantext."</td>";
                          echo "<td align='center'>".($CI->p_c->tgl_indo($row->created_date))."</td>";
                          echo "<td align=''>".$CI->dbx->getpegawai($row->proses_by,0,1)."</td>";
                          echo "<td align=''>".$row->statustext."</td>";
                          echo "<td align='left'>";
                          if ($row->idcalon<>""){
                            echo "No. Pendaftaran: ";
                            echo "<a href=javascript:void(window.open('".site_url('general/datacalonsiswa/'.$row->idcalon)."')) >".$row->nopendaftaran."</a>";
                            echo "<br/>Tgl. Daftar: <b>".$CI->p_c->tgl_indo($row->tanggal_daftar)."</b>";
                            if($row->verifikasi>0){
                              echo "<br/><label class='badge bg-green'>Terverifikasi</label>";
                            }else{
                              echo "<br/><label class='badge bg-red'>Belum Verifikasi</label>";
                            }
                            // echo "<br/>Token: <b>".$row->tokenonline."</token>";
                          }else if ($row->status<>"CC"){
                            echo "<a href=javascript:void(window.open('".site_url('online_kronologis/viewkronologis/'.$row->replid)."')) class='btn btn-primary' >Proses</a> ";
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
              </th>
            </tr>
            <tr>
                <th align="left">
                      <label class="control-label" for="minlengthfield">Nama Orang Tua/Wali</label>
                      <div class="control-group">
                          <div class="controls">:
                        <?php
                            echo $isi->namaortu." (".$isi->ortu.")";
                        ?>
                        </div>
                      </div>
                  </tr>
                <!--
                 <tr>
                    <th align="left">
                        <label class="control-label" for="minlengthfield">No. KTP</label>
                        <div class="control-group">
                            <div class="controls">:
                                    <?php
                                      echo "<a href=javascript:void(window.open('".site_url('../../formalonline/uploads/onlinekronologis/'.$isi->fileencrypt)."')) >$isi->noidentitas</a>";
                                    ?>
                                    <?php //echo  <p id="message"></p> ?>
                            </div>
                        </div>
                </th></tr>
                 </th></tr>
                   <tr>
                       <th align="left">
                           <label class="control-label" for="minlengthfield">Tahun Lahir Orang Tua/Wali</label>
                           <div class="control-group">
                     <div class="controls">:
                             <?php
                               echo $isi->tahunlahirortu;
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
                      echo $isi->teleponortu;
                    ?>
                    <?php //echo  <p id="message"></p> ?>
            </div>
                  </div>
              </th></tr>
            -->
              <tr>
              <th align="left">
                  <label class="control-label" for="minlengthfield">No. Handphone</label>
                  <div class="control-group">
            <div class="controls">:
                    <?php
                      echo $isi->handphoneortu;
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
                      echo $isi->whatsapportu;
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
                     echo $isi->emailortu;
                   ?>
                   <?php //echo  <p id="message"></p> ?>
           </div>
                 </div>
             </th></tr>
             <tr>
             <th align="left">
                 <label class="control-label" for="minlengthfield">Token</label>
                 <div class="control-group">
           <div class="controls">:
                   <?php
                     echo $isi->tokenonline;
                   ?>
                   <?php //echo  <p id="message"></p> ?>
           </div>
                 </div>
             </th></tr>
            <tr>
               <th align="left">
                    <h4>Data Peserta Didik</h4>
               </th></tr>
             <tr>
                <tr>
    		            <th align="left">
    	                		<label class="control-label" for="minlengthfield">Nama Peserta Didik</label>
    	                		<div class="control-group">
    								<div class="controls">:
    			                	<?php
    			                		 echo $isi->namacalon;
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
                                  echo $CI->p_c->jk($isi->jeniskelamin)
                                ?>
                                <?php //echo  <p id="message"></p> ?>
                        </div>
                    </div>
                </th></tr>
                <!--
                <tr>
    		            <th align="left">
    	                		<label class="control-label" for="minlengthfield">Tempat Lahir</label>
    	                		<div class="control-group">
    								<div class="controls">:
    			                	<?php
    			                		 echo $isi->tempatlahir;
    			                	?>
    			                	<?php //echo  <p id="message"></p> ?>
    								</div>
    	                		</div>
    			            </th>
                </tr>
              -->
                <tr>
    		            <th align="left">
    	                		<label class="control-label" for="minlengthfield">Tanggal Lahir</label>
    	                		<div class="control-group">
    								<div class="controls">:
    			                	<?php
    			                		 echo $CI->p_c->tgl_indo($isi->tanggallahir);
    			                	?>
    			                	<?php //echo  <p id="message"></p> ?>
    								</div>
    	                		</div>
    			            </th>
                </tr>
                <tr>
    		            <th align="left">
    	                		<label class="control-label" for="minlengthfield">Umur</label>
    	                		<div class="control-group">
    								<div class="controls">:
    			                	<?php
    			                		 echo $isi->umur;
    			                	?>
    			                	<?php //echo  <p id="message"></p> ?>
    								</div>
    	                		</div>
    			            </th>
                </tr>
                <tr>
                <td align="left" >
                    <label class="control-label" style='width:100% !important;'>
                    Apakah calon peserta didik terindikasi "Anak Berkebutuhan Khusus"?
                    <?php
		                		echo $CI->p_c->cekaktif($isi->abk);
		                	?>
                    </label>
                </td></tr>
                <tr>
                <td align="left" >
                    <label class="control-label" style='width:100% !important;'>
                    Apakah calon peserta didik pernah melakukan pemeriksaan psikologis dari psikolog atau psikiater?
                    <?php
		                		echo $CI->p_c->cekaktif($isi->pemeriksaan_psikolog);
		                	?>
                    </label>
                </td></tr>
                      <tr>
                        <th align="left">
                          <hr/>
                          <h4>Jenjang Yang Dituju</h4>
                        </th></tr>
                        <tr>
                            <th align="left">
                            <label class="control-label" for="minlengthfield">Jenjang</label>
                            <div class="control-group">
                            <div class="controls">:
                            <?php
                            echo $isi->unitbisnistext;
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
                          echo $isi->jenjang;
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
                                echo $isi->tingkattext;
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
                                echo $isi->jurusantext;
                              ?>
                              <?php //echo  <p id="message"></p> ?>
                      </div>
                            </div>
                        </th></tr>
                <tr>
                    <th align="left">
                          <label class="control-label" for="minlengthfield">Program Yang Dipilih</label>
                          <div class="control-group">
                    <div class="controls">:
                        <?php
                          echo $isi->kelompokcalontext;
                        ?>
                            <?php //echo  <p id="message"></p> ?>
                    </div>
                          </div>
                      </th></tr>
                      <tr>
                          <td align="left">
                                <hr/><label>1. Bagaimana Pengalaman Bapak/Ibu dalam pengisian registrasi Online <b>Homeschooling Kak Seto</b>?</b>?</label>
                                 <b>(<?php echo $isi->votingtext ?>)</b>
                           </td>
                      </tr>
                      <tr>
                          <td align="left">
                                <label>2. Apa yang membuat anda tertarik dengan <b>Homeschooling Kak Seto</b>?</b>?</label>
                                <b>(<?php echo $alasan_opt ?>)</b>
                           </td>
                      </tr>
                    <tr>
                        <td align="left">
                              <label>3. Informasi <b>Homeschooling Kak Seto</b> diperoleh dari?</label>
                              <b>(<?php echo $media_opt ?>)</b>
                         </td>
                    </tr>
                    <tr>
                        <th align="left">
                              <label class="control-label" for="minlengthfield">Tanggal Posting</label>
                              <div class="control-group">
                        <div class="controls">:
                            <?php
                              echo $CI->p_c->tgl_indo($isi->created_date);
                            ?>
                                <?php //echo  <p id="message"></p> ?>
                        </div>
                              </div>
                          </th></tr>
                  <?php if(($isi->status>1) OR ($edit==1)){ ?>
                  <tr>
                  <th align="left">
                    <hr/>
                    <h4>Saran PSB</h4>
                  </th></tr>
                  <tr>
                    <th align="left">
                          <label class="control-label" for="minlengthfield">Tahun Pelajaran</label>
                          <div class="control-group">
                    <div class="controls">:
                        <?php
                          if($edit==1){
                            $arridtahunajaran="id='idtahunajaran' data-rule-required=true";
                            echo form_dropdown('idtahunajaran',$idtahunajaran_opt,$isi->idtahunajaran,$arridtahunajaran);
                          }else{
                            echo $isi->tahunajarantext;
                          }
                        ?>
                    </div>
                          </div>
                      </th></tr>
		    		<tr>
		            <th align="left">
	                		<label class="control-label" for="minlengthfield">Proses</label>
	                		<div class="control-group">
								<div class="controls">:
                    <?php
                      if($edit==1){
                        $arridproses="id='idproses' data-rule-required=true";
                        echo form_dropdown('idproses',$idproses_opt,$isi->idproses,$arridproses);
                      }else{
                        echo $isi->prosestext;
                      }
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
                  if($edit==1){
                    $arridkelompok="id='idkelompok' data-rule-required=true";
                    echo form_dropdown('idkelompok',$idkelompok_opt,$isi->idkelompok,$arridkelompok);
                  }else{
                    echo $isi->kelompoktext;
                  }

                  ?>
              </div>
                    </div>
                </th></tr>
          <tr>
              <th align="left">
                    <label class="control-label" for="minlengthfield">Status Program</label>
                    <div class="control-group">
              <div class="controls">:

                  <?php
                  if($edit==1){
                    $arridkondisi="id='idkondisi' data-rule-required=true";
                    echo form_dropdown('idkondisi',$idkondisi_opt,$isi->idkondisi,$arridkondisi);
                  }else{
                    echo $isi->kondisisiswatext;
                  }
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
                if($edit==1){
                  $arridregion="id='idregion' data-rule-required=true";
                  echo form_dropdown('idregion',$idregion_opt,$isi->idregion,$arridregion);
                }else{
                  echo $isi->regiontext;
                }

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
                      if($edit==1){
                          echo form_checkbox('abk', '1', $isi->abk);
                      }else{
                        echo $CI->p_c->cekaktif($isi->abk);
                      }

                    ?>
            </div>
              </div>
              </th></tr>
              <tr>
              <th align="left">
              <label class="control-label" for="minlengthfield">Remedial Perilaku</label>
              <div class="control-group">
            <div class="controls">:
                    <?php
                      if($edit==1){
                          echo form_checkbox('abk', '1', $isi->remedialperilaku);
                      }else{
                        echo $CI->p_c->cekaktif($isi->remedialperilaku);
                      }

                    ?>
            </div>
              </div>
              </th></tr>
              <tr>
              <th align="left">
                  <label class="control-label" for="minlengthfield">Tanggal Daftar</label>
                  <div class="control-group">
            <div class="controls">:
              <?php
                if($edit==1){
                  if($isi->tanggaldaftar<>""){$settgl=$isi->tanggaldaftar;}else{$settgl=$isi->hariini;}
                  echo form_input(array('class' => '', 'id' => 'dp2','name'=>'tanggaldaftar','value'=>$CI->p_c->tgl_form($settgl),'data-rule-required'=>'true' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'2' ,'placeholder'=>'DD-MM-YYYY','autocomplete'=>'off'));
                }else{
                  echo $CI->p_c->tgl_indo($isi->tanggaldaftar);
                }
                ?>
            </div>
                  </div>
              </th></tr>
              <!--
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
          -->
                  <tr>
                      <td align="left">
                            <hr/><label>Dokumen Pendukung yang harus dilampirkan?</label>
                       </td>
                  </tr>
                  <tr>
                    <td align="left">
                        <?php
                          $CI->p_c->checkbox_more('iddokumentipe',$iddokumentipe_opt,$CI->p_c->arraybreak($iddokumenttipe,','),!$edit);
                        ?>
                         <br/>
                      </td></tr>
                  <tr>
				            <th align="left">
		                		<label class="control-label" for="minlengthfield">Keterangan</label>
		                		<div class="control-group">
                          <div class="controls" valign="top">:&nbsp;&nbsp;
                            
                                  <?php
                                  if($edit==1){
                                    echo form_textarea(array('class' => '', 'id' => 'keterangan','name'=>'keterangan','value'=>$isi->keterangan,'data-rule-required'=>'false' ,'data-rule-maxlength'=>'500', 'data-rule-minlength'=>'2' ,'placeholder'=>'Masukkan 2-500 Karakter'));
                                  }else{
                                    echo $isi->keterangan;
                                  }
                                    
                                  ?>
                                  <?php //echo  <p id="message"></p> ?>
                          </div>
		                		</div>
				            </th></tr>
                  <?php
                  if ($isi->idcalon<>""){
                    echo "<tr><th align='left'><label class='control-label' for='minlengthfield'>No. Pendaftaran</label>";
                    echo "<div class='control-group'><div class='controls'>: ";
                    echo "<a href=javascript:void(window.open('".site_url('general/datacalonsiswa/'.$isi->idcalon)."')) >".$isi->nopendaftaran."</a>";
                    echo "</div></div></th></tr>";
                    // echo "<br/>Token: <b>".$row->tokenonline."</token>";
                  }

                } //status
                  ?>
                  <tr>
                    <th align="left"><hr/>
                          <label class="control-label" for="minlengthfield">Diproses Oleh</label>
                          <div class="control-group">
                    <div class="controls">:
                        <?php echo $CI->dbx->getpegawai($isi->proses_by,0,1) ?>
                    </div>
                          </div>
                </th></tr>
                <tr>
                  <th align="left">
                        <label class="control-label" for="minlengthfield">Status</label>
                        <div class="control-group">
                  <div class="controls">:
                      <?php echo $isi->statustext ?>
                  </div>
                        </div>
              </th></tr>
		            </table>
                <table>
                  <?php
                  echo "<tr><th align='left'><hr/>";
                  if($edit==1){
                    echo "<button class='btn btn-primary' onclick='return validate()'>Simpan</button> ";
                    echo "<a href=javascript:void(window.open('".site_url("online_kronologis")."')) class='btn btn-success'>Kembali</a>";
                 }else{
                   if (($isi->status=="1") AND ($isi->idcalon=="")){
                     echo "<a href='".site_url('online_kronologis/saranpsb/'.$isi->replid)."' class='btn btn-warning' >Diterima</a> ";
                     echo "<a href=javascript:void(window.open('".site_url('online_kronologis/ubahstatus/CC/'.$isi->replid)."')) class='btn btn-danger' >Dibatalkan</a> ";
                   }
                   if(($isi->idcalon>0) and ($isi->verifikasi<1)){
                     echo "<a href=javascript:void(window.open('".site_url('online_kronologis/verifikasicpd/'.$isi->idcalon)."')) class='btn btn-success' >Verifikasi Data CPD</a> ";
                   }else{
                     if($isi->verifikasi==1){
                        echo "<label class='badge bg-green'>Calon Peserta Didik Telah Terverifikasi</label>";
                     }
                   }
                 }
                 echo "</th></tr>";
                 ?>
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
