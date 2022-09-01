<!DOCTYPE html>
<style>
  p{
    word-wrap: break-word !important;
  }
</style>
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
<?php if(($view=='tambah2') or ($view=='view') or ($view=='tambaheva')){ ?>
  
  <section class="content-header table-responsive">
      <h1>
          <?php echo $form ?>
          <small><?php echo $form_small ?></small>
      </h1>
      <!--
      <ol class="breadcrumb">
        <li><a href="JavaScript:cetakprint()"><i class="fa fa-file-text"></i>&nbsp;Cetak</a></li>
      </ol>
    -->
</section>
<section class="content">
    <div class="box">
            <div class="box-header with-border">
            <h3 class="box-title">Detail Laporan Kejadian</h3>
            <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
            <i class="fa fa-minus"></i></button>
            </div>
            </div>
            <div class="box-body">
            <table width="100%" border="0" class="form-horizontal form-validate">
            <tr>
              <th align="left">
              <label class="control-label" for="minlengthfield">Status</label>
              <div class="control-group">
            <div class="controls">:
                    <?php
                      echo $isi->statustext;
                    ?>
            </div>
              </div>
            </th></tr>
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
                      echo $isi->departementext;
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
            </th></tr>
            <tr>
              <th align="left">
              <label class="control-label" for="minlengthfield">Kelas</label>
              <div class="control-group">
            <div class="controls">:
                    <?php
                      echo $isi->kelastext;
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
                      echo $isi->nis." ".$isi->namasiswatext;
                    ?>
            </div>
              </div>
            </th></tr>
            <tr>
              <th align="left">
              <label class="control-label" for="minlengthfield">Tgl. Laporan</label>
              <div class="control-group">
            <div class="controls">:
                    <?php
                      echo $CI->p_c->tgl_indo($isi->tanggallaporan);
                    ?>
            </div>
              </div>
            </th></tr>
            <tr>
              <th align="left">
              <label class="control-label" for="minlengthfield">Jenis Laporan</label>
              <div class="control-group">
            <div class="controls">:
                    <?php
                      echo $isi->jenislaporantext;
                    ?>
            </div>
              </div>
            </th></tr>
            <tr>
              <th align="left">
              <label class="control-label" for="minlengthfield">Tempat Kejadian</label>
              <div class="control-group">
            <div class="controls">:
                    <?php
                      echo $isi->tempattext;
                    ?>
            </div>
              </div>
            </th></tr>
            <!--
            <tr>
              <th align="left">
              <label class="control-label" for="minlengthfield">Kategori Masalah</label>
              <div class="control-group">
            <div class="controls">:
                    <?php
                      echo $isi->masalahtext;
                    ?>
            </div>
              </div>
            </th></tr>
-->
            <tr>
              <th align="left">
              <label class="control-label" for="minlengthfield">Skala Prioritas</label>
              <div class="control-group">
            <div class="controls">:
                    <?php
                      echo $isi->prioritastext;
                    ?>
            </div>
              </div>
            </th></tr>
            <tr>
			            <td align="left">
	                		<h4>Latar Belakang:</h4>
                  <p align='justify'><?php echo htmlspecialchars_decode($isi->latarbelakang) ?></p>
                    </td></tr>
            <?php if(($view=='tambaheva')){?>
              <tr>
              <th align="left">
              <label class="control-label" for="minlengthfield">Tgl. Konseling</label>
              <div class="control-group">
            <div class="controls">:
                    <?php
                      echo $CI->p_c->tgl_indo($isidata->tanggalkonseling);
                    ?>
            </div>
              </div>
            </th></tr>
            <tr>
              <th align="left">
              <label class="control-label" for="minlengthfield">Kategori Masalah</label>
              <div class="control-group">
            <div class="controls">:
                    <?php
                      echo $isidata->masalahtext;
                    ?>
            </div>
              </div>
            </th></tr>
            <tr>
              <th align="left">
              <label class="control-label" for="minlengthfield">Intensitas</label>
              <div class="control-group">
            <div class="controls">:
                    <?php
                      echo $isidata->intensitastext;
                    ?>
            </div>
              </div>
            </th></tr>
              <tr>
			            <td align="left">
	                		<h4>Hasil Konseling:</h4>
                  <p align='justify'><?php echo htmlspecialchars_decode($isidata->hasilkonseling) ?></p>
                    </td></tr>
                    <tr>
			            <td align="left">
	                		<h4>Rencana Tindak Lanjut:</h4>
                  <p align='justify'><?php echo htmlspecialchars_decode($isidata->rencanatindaklanjut) ?></p>
                    </td></tr>
            <?php } ?>
                    
         </table>
            </div>
          </div>
    
         <?php if(($view=='view')){?>
         <table class="table table-bordered table-striped">
                    <thead>
                          <?php
                            if(($action=="kp_konseling") and ($isi->status<>"4")){ 
                              if(!$isi->onproses){
                                echo "<tr><td colspan=9 align='right'><a href=javascript:void(window.open('".site_url('kp_konseling/tambah2/'.$isi->replid)."'))><i class='fa fa-plus-square'></i> Tambah</a></td></tr>";
                            
                              }
                            }
                            echo "<tr><th width='50px'>No</th>";
                            echo "<th>Tanggal Konseling</th>";
                            echo "<th>Kategori Masalah</th>";
                            echo "<th>Intensitas</th>";
                            echo "<th width='150px'>Hasil Konseling</th>";
                            echo "<th>Rencana Tindak Lanjut</th>";
                            echo "<th>Tgl. Akhir Tindakan</th>";
                            echo "<th>Evaluasi Tindakan</th>";
                            echo "<th>Kategori Evaluasi</th>";
                            echo "<th>Tutup Laporan</th>";
                            if(($action=="kp_konseling")){ 
                              echo "<th width='200'>Aksi</th></tr>";
                            }
                          ?>
                      
                    </thead>
                    <tbody>
                      <?php
                      $CI =& get_instance();$no=1;
											foreach((array)$isidata as $rowisi2) {
											    echo "<tr>";
											    echo "<td align='center'>".$no++."</td>";
                          echo "<td align='center'>".$CI->p_c->tgl_indo($rowisi2->tanggalkonseling)."</td>";
                          echo "<td align='center'>".($rowisi2->masalahtext)."</td>";
                          echo "<td align='center'>".($rowisi2->intensitastext)."</td>";
                          echo "<td align='center'>".htmlspecialchars_decode($rowisi2->hasilkonseling)."</td>";
                          echo "<td align='center'>".htmlspecialchars_decode($rowisi2->rencanatindaklanjut)."</td>";
                          echo "<td align='center'>".$CI->p_c->tgl_indo($rowisi2->tanggalakhirtindakan)."</td>";
                          echo "<td align='center'>".htmlspecialchars_decode($rowisi2->evaluasitindakan)."</td>";
                          echo "<td align='center'>".($rowisi2->kategorievaluasitext)."</td>";
                          echo "<td align='center'>".$CI->p_c->cekaktif($rowisi2->tutup)."</td>";
                          if(($action=="kp_konseling")){
                            echo "<td align='center'>";
                            if(($isi->status<>"4")){ 
                              if(($rowisi2->fase<2)){
                                echo "<a href=javascript:void(window.open('".site_url('kp_konseling/tambah2/'.$rowisi2->idkonseling.'/'.$rowisi2->replid)."')) class='btn btn-xs btn-warning fa fa-minus-square' ></a>&nbsp;&nbsp;";
                              }
                              if(($no==2) and ($rowisi2->sisahari<1)){
                                echo "<a href=javascript:void(window.open('".site_url('kp_konseling/tambaheva/'.$rowisi2->idkonseling.'/'.$rowisi2->replid)."')) class='btn btn-xs btn-danger fa fa-plus-square' ></a>&nbsp;&nbsp;";
                              }
                            }
                            echo "</td>";
                          }
                          echo "</tr>";
											}
                      echo "<tr><td colspan='9'>&nbsp;</td></tr>";
											?>

                                        </tbody>
                                        <tfoot>
                                        </tfoot>
                                    </table>
<?php 
         }
} ?>
<?php if($view=='index'){ ?>
  <script language="javascript">
  function submitform() {
    document.getElementById("form").setAttribute("action", "<?php echo $action; ?>");
    document.getElementById("form").setAttribute("target", "");
    
  }

  function cetakprint() {
    document.getElementById("form").setAttribute("action", "<?php echo $action."/index/1" ?>");
    document.getElementById("form").setAttribute("target", "_blank");
    document.getElementById("form").submit();
  }
  function cetakexcel() {

    document.getElementById("form").setAttribute("action", "<?php echo $action."/index/1/1" ?>");
    document.getElementById("form").setAttribute("target", "_blank");
    document.getElementById("form").submit();
  }
  </script>
                <!-- Content Header (Page header) -->
                <section class="content-header table-responsive">
                    <h1>
                        <?php echo $form ?>
                        <small>List Data</small>
                    </h1>

                    <ol class="breadcrumb">
                            <?php if($action=="kp_kejadian"){ ?>
                            <li><a href="javascript:void(window.open('<?php echo site_url('kp_kejadian/tambah'); ?>'))" ><i class="fa fa-plus-square"></i> Tambah</a></li>
                            <?php } ?>
                            <!--
                            <li><a href="JavaScript:cetakprint()"><i class="fa fa-file-text"></i>&nbsp;Cetak</a></li>
                            <li><a href="JavaScript:cetakexcel()"><i class="fa fa-print"></i>&nbsp;Excel</a></li>
                            -->
                    </ol>
                </section>
                <section class="content-header table-responsive">
                <?php
  			             $attributes = array('class' => 'form-horizontal form-validate', 'id' => 'form', 'method' => 'POST', 'novalidate'=>'novalidate','onsubmit'=>'JavaScript:submitform()');
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
      				                		<label class="control-label" for="minlengthfield">Jenjang</label>
      				                		<div class="control-group">
              											<div class="controls">:
          						                	<?php
          						                		$arriddepartemen='data-rule-required=true onchange=javascript:this.form.submit();';
          						                		echo form_dropdown('iddepartemen',$iddepartemen_opt,$this->input->post('iddepartemen'),$arriddepartemen);
          						                	?>
          						                	<?php //echo  <p id="message"></p> ?>
              											</div>
            				              </div>
            						         </th>
            </tr>
            <!--
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
                            -->
                              <tr>
                                  <th align="left" colspan="2">
                                     <label class="control-label" for="minlengthfield">Nama</label>
                                     <div class="control-group">
                                       <div class="controls">:
                                           <?php
                                             echo form_input(array('class' => '','style'=>'margin: 0px 0px 5px; width: 687px;', 'id' => 'nama','name'=>'nama','value'=>$this->input->post('nama'),'data-rule-required'=>'false' ,'data-rule-maxlength'=>'500', 'data-rule-minlength'=>'3' ,'placeholder'=>'Masukkan 1-100 Karakter'));
                                           ?>
                                           <?php //echo  <p id="message"></p> ?>
                                       </div>
                                     </div>
                                    </th>
                               </tr>
          			            <tr>
          				            <th align="left" colspan="4">
                                <!-- <button class='btn btn-primary' name='filter' value="1">Filter</button> -->
                                <button class='btn btn-primary' name='filter' value="1" >Filter</button>
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
                                                echo "<th width='50'>No</th>";
                                                echo "<th>Nama</th>";
                                                echo "<th>Tahun Ajaran</th>";
                                                echo "<th>Kelas</th>";
                                                echo "<th>ABK</th>";
                                                //echo "<th>Aktif</th>";
                                                echo "<th>Pembuat Laporan</th>";
                                                echo "<th>Tgl. Laporan</th>";
                                                echo "<th>Prioritas</th>";
                                                echo "<th>Status</th>";
                                                echo "<th width='200'>Aksi</th>";
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
                                                //echo "<a href=javascript:void(window.open('".site_url('kp_konseling/view/0/'.$row->replid)."'))>".strtoupper($row->nis)."</a> ";
                                                echo "<a href=javascript:void(window.open('".site_url('general/datasiswa/'.$row->replid)."')) >".strtoupper($row->nis)."</a> ".strtoupper($row->namasiswatext);
                                                echo "</td>";
                                                echo "<td align='center'>".strtoupper($row->tahunajarantext);
                                                echo "<td align='center'>".strtoupper($row->kelastext)."<br/>[".$row->namawalitext."]</td>";
                                                echo "<td align='center'>".($CI->p_c->cekaktif($row->abk))."</td>";
                                                //echo "<td align='center'>".$CI->p_c->cekaktif($row->aktifsiswa)."</td>";
                                                echo "<td align='center'>".($row->createdbytext)."</td>";
                                                echo "<td align='center'>".$CI->p_c->tgl_indo($row->tanggallaporan)."</td>";
                                                echo "<td align='center'>".($row->prioritastext)."</td>";
                                                echo "<td align='center'>".($row->statustext)."</td>";
                                                echo "<td align='center'>";
                                                if($action=="kp_kejadian"){ 
                                                  if($row->status=="1"){ 
                                                    echo "<a href=javascript:void(window.open('".site_url('kp_kejadian/tambah/'.$row->replid)."')) class='btn btn-xs btn-warning fa fa-check-square' ></a>&nbsp;&nbsp;";
                                                  }
                                                  echo "<a href=javascript:void(window.open('".site_url('kp_kejadian/view/'.$row->replid)."')) class='btn btn-xs btn-info fa fa-circle-o' ></a>&nbsp;";
                                                }
                                                if($action=="kp_konseling"){ 
                                                  if(($row->status<>"4")){
                                                    if(!$row->onproses){
                                                      echo "<a href=javascript:void(window.open('".site_url('kp_konseling/tambah2/'.$row->replid)."')) class='btn btn-xs btn-danger fa fa-plus-square' ></a>&nbsp;&nbsp;";
                                                    }
                                                  }
                                                  echo "<a href=javascript:void(window.open('".site_url('kp_konseling/view/'.$row->replid)."')) class='btn btn-xs btn-info fa fa-circle-o' ></a>&nbsp;";
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
          data:{modul:'idsiswacompany',id:value,iddepartemen:$("#iddepartemen").val()},
          success: function(respond){
            $("#idsiswa").html(respond);
          }
        });
			
	    });

      $("#iddepartemen").change(function(){
	      var value=$(this).val();
        $.ajax({
          data:{modul:'idsiswacompany',id:$("#idcompany").val(),iddepartemen:value},
          success: function(respond){
            $("#idsiswa").html(respond);
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
              <!--
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
  -->
		            <tr>
		            <th align="left">
		        		<label class="control-label" for="minlengthfield">Nama Siswa</label>
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
                              <label class="control-label" for="minlengthfield">Tgl. Laporan</label>
                              <div class="control-group">
                        <div class="controls">:
                                <?php
                                  echo form_input(array('class' => '', 'id' => 'dp1','name'=>'tanggallaporan','value'=>$CI->p_c->tgl_form($isi->tanggallaporan),'data-rule-required'=>'false' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'2' ,'placeholder'=>'DD-MM-YYYY','autocomplete'=>'off'));
                                ?>
                                <?php //echo  <p id="message"></p> ?>
                        </div>
                              </div>
                          </th>
                       </tr>
                       <tr>
		            <th align="left">
		        		<label class="control-label" for="minlengthfield">Jenis Laporan</label>
		        		<div class="control-group">
							<div class="controls">:
		                	<?php
		                		$arridjenislaporan="data-rule-required=true id=idjenislaporan";
		                		echo form_dropdown('idjenislaporan',$idjenislaporan_opt,$isi->idjenislaporan,$arridjenislaporan);
		                	?>
		                	<?php //echo  <p id="message"></p> ?>
							</div>
		        		</div>
		            </th></tr>
                    <tr>
		            <th align="left">
		        		<label class="control-label" for="minlengthfield">Tempat Kejadian</label>
		        		<div class="control-group">
							<div class="controls">:
		                	<?php
		                		$arridtempat="data-rule-required=true id=idtempat";
		                		echo form_dropdown('idtempat',$idtempat_opt,$isi->idtempat,$arridtempat);
		                	?>
		                	<?php //echo  <p id="message"></p> ?>
							</div>
		        		</div>
		            </th></tr>
                <!--
                    <tr>
		            <th align="left">
		        		<label class="control-label" for="minlengthfield">Kategori Masalah</label>
		        		<div class="control-group">
							<div class="controls">:
		                	<?php
		                		$arridmasalah="data-rule-required=true id=idmasalah";
		                		echo form_dropdown('idmasalah',$idmasalah_opt,$isi->idmasalah,$arridmasalah);
		                	?>
		                	<?php //echo  <p id="message"></p> ?>
							</div>
		        		</div>
		            </th></tr>
  -->
                       <tr>
		            <th align="left">
		        		<label class="control-label" for="minlengthfield">Skala Prioritas</label>
		        		<div class="control-group">
							<div class="controls">:
		                	<?php
		                		$arridprioritas="data-rule-required=true id=idprioritas";
		                		echo form_dropdown('idprioritas',$idprioritas_opt,$isi->idprioritas,$arridprioritas);
		                	?>
		                	<?php //echo  <p id="message"></p> ?>
							</div>
		        		</div>
		            </th></tr>
                <tr>
                    <td align="left">
		        		<h4>Latar Belakang</h4>
                    </td>
                    </tr>
                    <tr>
			        	<th>
                            <div class='box-body pad'>
                                    <textarea id="editor1" name="latarbelakang" rows="10" cols="80" data-rule-required="true">
                                        <?php echo $isi->latarbelakang; ?>
                                    </textarea>
                                    <script type="text/javascript">CKEDITOR.replace('editor1');</script>
                            </div>
                            <?php //echo  <p id="message"></p> ?>
			            </th>
                    </tr>
                  </table>
                  
                  <table>
      				    <tr>
      				            <th align="left">
      				            	<button class='btn btn-primary'>Simpan</button>
                            <a href='javascript:window.close()' class='btn btn-success'>Kembali</a>
                          </th>
      				    </tr>

      		        </table>
            <?php 
		        echo form_close();
		    ?>
	    </section>
<!-------------------------------------------------------------------------------------------------------------------------------------->
<?php } elseif($view=='tambah2'){ ?>
  <?php 
            $attributes = array('class' => 'form-horizontal form-validate', 'id' => 'form', 'method' => 'POST', 'novalidate'=>'novalidate');
            echo form_open($action,$attributes);
           
          ?>
          
  
  <table width="100%" border="0" style="text-align:left;">
  <tr>
                          <th align="left">
                              <label class="control-label" for="minlengthfield">Tgl. Konseling</label>
                              <div class="control-group">
                        <div class="controls">:
                                <?php
                                  echo form_input(array('class' => '', 'id' => 'dp1','name'=>'tanggalkonseling','value'=>$CI->p_c->tgl_form($isi2->tanggalkonseling),'data-rule-required'=>'false' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'2' ,'placeholder'=>'DD-MM-YYYY','autocomplete'=>'off'));
                                ?>
                                <?php //echo  <p id="message"></p> ?>
                        </div>
                              </div>
                          </th>
                       </tr>
                <tr>
        <th align="left">
        <label class="control-label" for="minlengthfield">Kategori Masalah</label>
        <div class="control-group">
      <div class="controls">:
              <?php
                $arridmasalah="data-rule-required=true id=idmasalah";
                echo form_dropdown('idmasalah',$idmasalah_opt,$isi2->idmasalah,$arridmasalah);
              ?>
              <?php //echo  <p id="message"></p> ?>
      </div>
        </div>
        </th></tr>
        <tr>
        <th align="left">
        <label class="control-label" for="minlengthfield">Intensitas</label>
        <div class="control-group">
      <div class="controls">:
              <?php
                $arridintensitas="data-rule-required=true id=idintensitas";
                echo form_dropdown('idintensitas',$idintensitas_opt,$isi2->idintensitas,$arridintensitas);
              ?>
              <?php //echo  <p id="message"></p> ?>
      </div>
        </div>
        </th></tr>
    <tr>
    <tr>
    <td align="left">
        <h4>Hasil</h4>
    </td>
    </tr>
    <tr>
        <th>
            <div class='box-body pad'>
                    <textarea id="editor3" name="hasilkonseling" rows="10" cols="80" data-rule-required="true">
                        <?php echo $isi2->hasilkonseling; ?>
                    </textarea>
                    <script type="text/javascript">CKEDITOR.replace('editor3');</script>
            </div>
            <?php //echo  <p id="message"></p> ?>
        </th>
    </tr>
    <td align="left">
        <h4>Rencana Tindak Lanjut</h4>
    </td>
    </tr>
    <tr>
        <th>
            <div class='box-body pad'>
                    <textarea id="editor2" name="rencanatindaklanjut" rows="10" cols="80" data-rule-required="true">
                        <?php echo $isi2->rencanatindaklanjut; ?>
                    </textarea>
                    <script type="text/javascript">CKEDITOR.replace('editor2');</script>
            </div>
            <?php //echo  <p id="message"></p> ?>
        </th>
    </tr>
    <tr>
        <th align="left">
            <label class="control-label" for="minlengthfield">Tgl. Akhir Tindakan</label>
            <div class="control-group">
      <div class="controls">:
              <?php
                echo form_input(array('class' => '', 'id' => 'dp2','name'=>'tanggalakhirtindakan','value'=>$CI->p_c->tgl_form($isi2->tanggalakhirtindakan),'data-rule-required'=>'false' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'2' ,'placeholder'=>'DD-MM-YYYY','autocomplete'=>'off'));
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
                            <a href='javascript:window.close()' class='btn btn-success'>Kembali</a>
                          </th>
      				    </tr>

      		        </table>
            <?php 
		        echo form_close();
		    ?>
<!-------------------------------------------------------------------------------------------------------------------------------------->
<?php } elseif($view=='tambaheva'){ ?>
  <?php 
    $attributes = array('class' => 'form-horizontal form-validate', 'id' => 'form', 'method' => 'POST', 'novalidate'=>'novalidate');
    echo form_open($action,$attributes);       
  ?>
  <table width="100%" border="0" style="text-align:left;">
    <tr>
    <td align="left">
        <h4>Evaluasi Tindakan yang sudah Diberikan</h4>
    </td>
    </tr>
    
    <tr>
        <th>
            <div class='box-body pad'>
                    <textarea id="editor4" name="evaluasitindakan" rows="10" cols="80" data-rule-required="true">
                        <?php echo $isi2->evaluasitindakan; ?>
                    </textarea>
                    <script type="text/javascript">CKEDITOR.replace('editor4');</script>
            </div>
            <?php //echo  <p id="message"></p> ?>
        </td>
    </tr>
    <tr>
		            <th align="left">
		        		<label class="control-label" for="minlengthfield">Kategori Evaluasi</label>
		        		<div class="control-group">
							<div class="controls">:
		                	<?php
		                		$arridkategorievaluasi="data-rule-required=true id=idkategorievaluasi";
		                		echo form_dropdown('idkategorievaluasi',$idkategorievaluasi_opt,$isi2->idkategorievaluasi,$arridkategorievaluasi);
		                	?>
		                	<?php //echo  <p id="message"></p> ?>
							</div>
		        		</div>
		            </th></tr>
      <tr>
          <th align="left">
          <label class="control-label" for="minlengthfield">Tutup Laporan</label>
          <div class="control-group">
        <div class="controls">:
                <?php
                  echo form_checkbox('tutup', '1', $isi2->tutup);
                ?>
                <?php //echo  <p id="message"></p> ?>
        </div>
          </div>
      </th></tr>
  </table>
  <table>
      <tr>
              <th align="left">
                <button class='btn btn-primary'>Simpan</button>
                <a href='javascript:window.close()' class='btn btn-success'>Kembali</a>
              </th>
      </tr>
  </table>
<?php 
echo form_close();
?>
<!-------------------------------------------------------------------------------------------------------------------------------------->
<?php } elseif($view=='view'){ ?>

         <table border="0">
             <tr align="left">
               <td>
                 <?php
                 if($action=="kp_kejadian"){ 
                    echo "<a href='".site_url('kp_kejadian/tambah/'.$isi->replid)."') class='btn btn-warning'>Ubah</a>&nbsp;&nbsp;";
                 }
                 echo "<a href='javascript:window.close()' class='btn btn-success'>Kembali</a>&nbsp;&nbsp;";

                 ?>
               </td>
             </tr>
         </table>
  </div>
	</section>
<!-------------------------------------------------------------------------------------------------------------------------------------->
<?php } ?>
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
    </body>
</html>
