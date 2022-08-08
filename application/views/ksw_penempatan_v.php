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
                        <li><a href="javascript:void(window.open('<?php echo site_url('ksw_penempatan/tambah'); ?>'))" ><i class="fa fa-plus-square"></i> Tambah</a></li>
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
                                                echo "<th width='50'>No.</th>";
                                                echo "<th>No Daftar</th>";
                                                echo "<th>Nama</th>";
                                                echo "<th>Tingkat</th>";
                                                echo "<th>Status Program</th>";
                                                //echo "<th>Tahun Pelajaran</th>";
                                                //echo "<th>Calon Kelas</th>";
                                                echo "<th>Tgl. Daftar</th>";
                                                //echo "<th>Asesmen</th>";
                                                echo "<th>Aktif</th>";
                                                echo "<th>Verifikasi</th>";
                                                echo "<th>lulus</th>";
                                                echo "<th width='140px'>Aksi</th>";
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
                          //echo "<td align=''>".($row->tahunajarantext)."</td>";
                          //echo "<td align=''>".($row->kelastext )."</td>";
                          echo "<td align=''>";
                          if (($row->lama>$row->lamaproses) and ($row->replidsiswa=="") and ($row->aktif=="1")){
                            echo $CI->p_c->bgcolortext($CI->p_c->tgl_indo($row->tanggal_daftar),'red');
                          }else{
                            echo $CI->p_c->tgl_indo($row->tanggal_daftar);
                          }
                          echo "</td>";
                          echo "<td align='center'>".$CI->p_c->cekaktif($row->aktif)."</td>";
                          echo "<td align='center'>".$CI->p_c->cekaktif($row->verifikasi)."</td>";
                          echo "<td align='center'>";
                          if($row->lulus<>NULL){
                            echo $CI->p_c->cekaktif($row->lulus);
                          }else{ echo "Belum Diputuskan";}
                          echo "</td>";
											    echo "<td align='center'>";
                          echo "Kelas : <b>".$row->kelastext."</b><br/>";
                          echo "TP : <b>".$row->tahunajarantext."</b><br/>";
                          if($row->verifikasi=='1'){
                              if($row->replidsiswa<>""){
                                echo "NIS : <b><a href=javascript:void(window.open('".site_url('general/datasiswa/'.$row->replidsiswa)."')) >".$row->nis."</a></b>";
                                echo "<a href=javascript:void(window.open('".site_url('ksw_penempatan/hapussiswa/'.$row->replid)."')) class='btn btn-xs btn-danger' >Hapus</a>&nbsp;&nbsp;";
                              }else{
                                if($row->tanggal_masuk<>"0000-00-00"){
                                  echo "<a href=javascript:void(window.open('".site_url('ksw_penempatan/import/'.$row->replid)."')) class='btn btn-xs btn-warning' >Impor</a>&nbsp;&nbsp;";
                                }else{
									echo $CI->p_c->bgcolortext("Belum ada tanggal masuk di SKL","red");
								}
                              }
                          }else{
                            echo $CI->p_c->bgcolortext("Belum terverifikasi","red");
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
