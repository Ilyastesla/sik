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
                        <li><a href="javascript:void(window.open('<?php echo site_url('psb_skl/tambah'); ?>'))" ><i class="fa fa-plus-square"></i> Tambah</a></li>
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
                             <th align="left">
                                <label class="control-label" for="minlengthfield">Nama</label>
                                <div class="control-group">
                                  <div class="controls">:
                                      <?php
                                        $arrjeniscari='data-rule-required=false';
                                        echo form_dropdown('jeniscari',$jeniscari_opt,$this->input->post('jeniscari'),$arrjeniscari);
                                        echo "<br/>&nbsp;&nbsp;";
                                        echo form_input(array('class' => '', 'id' => 'nama','name'=>'nama','value'=>$this->input->post('nama'),'data-rule-required'=>'false' ,'data-rule-maxlength'=>'500', 'data-rule-minlength'=>'3' ,'placeholder'=>'Masukkan 1-100 Karakter'));
                                      ?>
                                      <?php //echo  <p id="message"></p> ?>
                                  </div>
                                </div>
                               </th>
                          </tr>
                          <tr>
                            <th colspan='2'><hr/></th>
                          </tr>
    	                    <tr>
            						       
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
                                 <th align="left">
        				                		<label class="control-label" for="minlengthfield">Tahun Pelajaran</label>
        				                		<div class="control-group">
                											<div class="controls">:
            						                	<?php
            						                		$arridtahunajaran='data-rule-required=false  onchange=javascript:this.form.submit();';
            						                		echo form_dropdown('idtahunajaran',$idtahunajaran_opt,$this->input->post('idtahunajaran'),$arridtahunajaran);
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
                                                echo "<th width='*'>No.</th>";
                                                echo "<th>No Pendaftaran</th>";
                                                echo "<th>Nama</th>";
                                                echo "<th>Tingkat</th>";
                                                echo "<th>Status Program</th>";
                                                echo "<th>Tgl. Daftar</th>";
                                                echo "<th>ABK</th>";
                                                //echo "<th>Asesmen</th>";
                                                echo "<th>Aktif</th>";
                                                //echo "<th>Verifikasi</th>";
                                                //echo "<th>UP</th>";
                                                //echo "<th>lulus</th>";
                                                echo "<th>Peringatan</th>";
                                                echo "<th>Calon Kelas</th>";
                                                echo "<th>Tgl. Masuk</th>";
                                                echo "<th width='140'>Aksi</th>";
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
                          echo "<a href=javascript:void(window.open('".site_url('general/datacalonsiswa/'.$row->replid)."')) >".$row->nopendaftaran."</a>";
                          echo "</td>";
                          echo "<td align=''>".($row->nama)."</td>";
                          echo "<td align=''>".($row->tingkattext)."</td>";
                          echo "<td align=''>".($row->kondisitext)."</td>";
                          echo "<td align=''>";
                            if (($row->lama>$row->lamaproses) and ($row->replidsiswa=="") and ($row->aktif=="1")){
                              echo $CI->p_c->bgcolortext($CI->p_c->tgl_indo($row->tanggal_daftar),'red');
                            }else{
                              echo $CI->p_c->tgl_indo($row->tanggal_daftar);
                            }
                          echo "</td>";
                          echo "<td align='center'>".$CI->p_c->cekaktif($row->abk)."</td>";
                          echo "<td align='center'>".$CI->p_c->cekaktif($row->aktif)."</td>";
                          //echo "<td align='center'>".$CI->p_c->cekaktif($row->verifikasi)."</td>";
                          //echo "<td align=''>".$CI->p_c->cekaktif($row->keu_up)."</td>";
                          /*
                          echo "<td align='center'>";
                          if($row->lulus<>NULL){
                            echo $CI->p_c->cekaktif($row->lulus);
                          }else{ echo "Belum Diputuskan";}
                          echo "</td>";
                          */
                          echo "<td align='center'>";
                          $hasilinterview="";$hasilasesmen="";
                          if($row->lulus<>NULL){
                            if($row->lulus<>1){
                              echo "Tidak Lulus";
                            }
                          }else{
                            if($row->keu_up<>'1'){
                              echo $CI->p_c->bgcolortext("Belum Membayar Uang Pangkal","red")."<br/>";
                            }

                            $hasilinterview=$CI->dbx->interviewdescription($row->replid);
                            if ($hasilinterview<>NULL){
                              if($hasilinterview<>$row->idkelompoksiswa){
                                  echo $CI->p_c->bgcolortext("CPD Disarankan Pindah Program","blue")."<br/>";
                              }
                            }

                            if($row->keu_assessment=='1'){
                              //if(($row->abk=='1') and ($row->syarat_asesmen==1)){
                                $hasilasesmen=$CI->dbx->asesmendescription($row->replid);
                                if ($hasilasesmen<>NULL){
                                  //if($hasilasesmen<>$row->idkelompoksiswa){
                                  //    echo $CI->p_c->bgcolortext("CPD Disarankan Pindah Program","blue")."<br/>";
                                  //}
                                }else{
                                  echo $CI->p_c->bgcolortext("Belum Asesmen","purple")."<br/>";
                                }
                              //}
                            }else{ //$row->keu_assessment=='1'
                              if($row->abk<>1){
                                if(($hasilinterview==NULL) and ($row->syarat_interview=='1')){
                                  echo $CI->p_c->bgcolortext("Belum Interview","yellow")."<br/>";
                                }
                              }else{
                                echo $CI->p_c->bgcolortext("Belum Asesmen","purple")."<br/>";
                              }
                            } // $row->keu_assessment=='1'

                            
                          }
                          echo "</td>";
                          echo "<td align=''>".($row->kelastext)."</td>";
                          echo "<td align=''>".$CI->p_c->tgl_indo($row->tanggal_masuk)."</td>";
											    echo "<td align='center'>";
                          if(($row->replidsiswa==NULL) and ($row->aktif=="1")){
                              if($row->lulus<>NULL){
                                if(($row->lulus==1) and ($row->replidsiswa<1)){
                                  if($row->calon_kelas==""){
                                      echo "<a href=javascript:void(window.open('".site_url('psb_skl/tambah/'.$row->replid)."')) class='btn btn-primary' >Set Kelas</a>&nbsp;&nbsp;";
                                  }else{
									echo "<a href=javascript:void(window.open('".site_url('psb_skl/tambah/'.$row->replid)."')) class='btn btn-primary' >Revisi Kelas</a>&nbsp;&nbsp;";
									//echo "Menunggu Penempatan";
                                  }
                                }
                              }else{
                                $buttonaksi="";
                                $buttonaksi.="<a href=javascript:void(window.open('".site_url('psb_skl/ubahlulus/1/'.$row->replid)."')) class='btn btn-warning' >Lulus</a>&nbsp;&nbsp;";
                                $buttonaksi.="<a href=javascript:void(window.open('".site_url('psb_skl/ubahlulus/0/'.$row->replid)."')) class='btn btn-danger' >Tidak</a> ";

                                if($row->keu_up==1){
                                    if($row->keu_assessment=='1'){
                                      //if($row->syarat_asesmen=='1'){
                                        if (($hasilasesmen<>NULL)){
                                          echo $buttonaksi;
                                        }
                                      //}
                                    } else { //$row->keu_assessment=='1'
                                      if($row->abk<>1){
                                        if(($hasilinterview==NULL) and ($row->syarat_interview=='1')){
                                          //echo $CI->p_c->bgcolortext("Belum Interview","yellow")."<br/>";
                                          echo "&nbsp";
                                        }else{
                                          echo $buttonaksi;
                                        }
                                      }else{
                                        echo "&nbsp";
                                        //echo $CI->p_c->bgcolortext("Belum Asesmen","purple")."<br/>";
                                      }
                                    }
                                } //$row->keu_up==1
                            }
                          }else{
                            if(($row->aktif=="1")){echo "Selesai";}
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
<?php }else if($view=='tambah'){ ?>
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
    echo $CI->dbx->getcalonsiswa($isi->replid);
    ?>
    <table width="100%" border="0">
      <tr>
      <th align="left">
      <label class="control-label" for="minlengthfield">Tgl. Daftar</label>
      <div class="control-group">
    <div class="controls">:
            <?php
              echo $CI->p_c->tgl_indo($isi->tanggal_daftar);
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
                    $arridkelas='data-rule-required=true';
                    echo form_dropdown('idkelas',$idkelas_opt,$isi->calon_kelas,$arridkelas);
                  ?>
          </div>
            </div>
            </th></tr>
      <tr>
          <th align="left">
                <label class="control-label" for="minlengthfield">Tanggal Masuk</label>
                <div class="control-group">
          <div class="controls">:
            <?php
              echo form_input(array('class' => '', 'id' => 'dp1','name'=>'tanggal_masuk','value'=>$CI->p_c->tgl_form($isi->tanggal_masuk),'data-rule-required'=>'true' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'2' ,'placeholder'=>'DD-MM-YYYY','autocomplete'=>'off'));
            ?>
                  <?php //echo  <p id="message"></p> ?>
          </div>
                </div>
            </th></tr>
      </table>
      <table width="100%" border="0">
          <tr>
                  <th align="left">
                    <button class='btn btn-primary' onclick="return validate()">Simpan</button>
                    <a href="javascript:void(window.open('<?php echo site_url("psb_penjadwalan") ?>'))" class="btn btn-success">Kembali</a>
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
