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
                        <li><a href="javascript:void(window.open('<?php echo site_url('psb_penjadwalan/tambah'); ?>'))" ><i class="fa fa-plus-square"></i> Tambah</a></li>
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
                                  <!--
                                   <th align="left">
                                      <label class="control-label" for="minlengthfield">Kegiatan</label>
                                      <div class="control-group">
                                        <div class="controls">:
                                            <?php
                                              $arrkeg_id='data-rule-required=true  onchange=javascript:this.form.submit();';
                                              echo form_dropdown('keg_id',$keg_id_opt,$this->input->post('keg_id'),$arrkeg_id);
                                            ?>
                                            <?php //echo  <p id="message"></p> ?>
                                        </div>
                                      </div>
                                     </th>
                                   -->
      			                  </tr>
                              <tr>
                						       <th align="left">
          				                		<label class="control-label" for="minlengthfield">Nama</label>
          				                		<div class="control-group">
                  											<div class="controls">:
              						                	<?php
                                            echo form_input(array('class' => '','style'=>'margin: 0px 0px 5px; width: 300px;', 'id' => 'nama','name'=>'nama','value'=>$this->input->post('nama'),'data-rule-required'=>'false' ,'data-rule-maxlength'=>'500', 'data-rule-minlength'=>'3' ,'placeholder'=>'Masukkan 1-100 Karakter'));
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
                                                echo "<th>Calon Kelas</th>";
                                                //echo "<th>Status Program</th>";
                                                echo "<th>ABK</th>";
                                                echo "<th>Tgl. Daftar</th>";
                                                echo "<th>Biaya Assessment</th>";
                                                //echo "<th>Biaya Form HSKS</th>";
                                                echo "<th>UP</th>";
                                                //echo "<th>Aktif</th>";
                                                //echo "<th width='80'>Aksi</th>";
                                                echo "<th>Assessment</th>";
                                                echo "<th>Interview</th>";
                                                //echo "<th>Trial Class</th>";
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
                          echo "<td align=''>".($row->kelastext )."</td>";
                          //echo "<td align=''>".($row->kondisitext)."</td>";
                          echo "<td align=''>".$CI->p_c->cekaktif($row->abk)."</td>";
                          echo "<td align='center'>".($CI->dbx->tanggalbatas($row->tanggal_daftar,$row->lamaproses,0))."</td>";
                          echo "<td align=''>".$CI->p_c->cekaktif($row->keu_assessment)."</td>";
                          //echo "<td align=''>".$CI->p_c->cekaktif($row->keu_form)."</td>";
                          echo "<td align=''>".$CI->p_c->cekaktif($row->keu_up)."</td>";
                          //echo "<td align=''>".$CI->p_c->cekaktif($row->aktif)."</td>";
											    echo "<td align='center'>"; //Assessment
                            $jadwal10=$CI->dbx->cekjadwal("10",$row->replid);
                            echo substr($jadwal10, 1);
                            //if(($row->abk==1) and ($row->keu_assessment==1)){
                            if($row->keu_assessment==1){
                              if (!substr($jadwal10, 0,1)){
                                  echo "&nbsp;&nbsp;<a href=javascript:void(window.open('".site_url('psb_penjadwalan/tambah/10/'.$row->replid)."')) class='btn btn-xs btn-info fa fa-plus-square' ></a>&nbsp;&nbsp;";
                              }else{
                                echo "&nbsp;&nbsp;<a href=javascript:void(window.open('".site_url('psb_penjadwalan/hapus/10/'.$row->replid)."')) class='fa fa-times-circle' ></a>";
                              }
                            }
											    echo "</td>";
                          echo "<td align='center'>"; //Interview
                            $jadwal9=$CI->dbx->cekjadwal("9",$row->replid);
                            echo substr($jadwal9, 1);
                            if (!substr($jadwal9, 0,1)){
                                echo "&nbsp;&nbsp;<a href=javascript:void(window.open('".site_url('psb_penjadwalan/tambah/9/'.$row->replid)."')) class='btn btn-xs btn-info fa fa-plus-square' ></a>&nbsp;&nbsp;";
                            }else{
                              echo "&nbsp;&nbsp;<a href=javascript:void(window.open('".site_url('psb_penjadwalan/hapus/9/'.$row->replid)."')) class='fa fa-times-circle' ></a>";
                            }
											    echo "</td>";
                          /*
                          echo "<td align='center'>"; //triall class
                            $jadwal11=$CI->dbx->cekjadwal("11",$row->replid);
                            echo substr($jadwal11, 1);
                            if($row->keu_up){
                              if (!substr($jadwal11, 0,1)){
                                  echo "&nbsp;&nbsp;<a href=javascript:void(window.open('".site_url('psb_penjadwalan/tambah/11/'.$row->replid)."')) class='btn btn-xs btn-info fa fa-plus-square' ></a>&nbsp;&nbsp;";
                              }else{
                                echo "&nbsp;&nbsp;<a href=javascript:void(window.open('".site_url('psb_penjadwalan/hapus/11/'.$row->replid)."')) class='fa fa-times-circle' ></a>";
                              }
                            }
                            */
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
          echo $CI->dbx->getcalonsiswa($siswa_id);
		    	?>
		    	<table width="100%" border="0">
            <?php
              $rowsiswa=$CI->dbx->getcalonsiswa($siswa_id);
            ?>
                  <?php if($keg_id<>11){ ?>
                  <tr>
                  <th align="left">
                  <label class="control-label" for="minlengthfield">Petugas</label>
                  <div class="control-group">
                    <div class="controls">:
                            <?php
                              $arridpegawai='data-rule-required=true';
                              echo form_dropdown('idpegawai',$idpegawai_opt,$isi->idpegawai,$arridpegawai);
                            ?>
                    </div>
                  </div>
                  </th></tr>
                <?php }else{ ?>
                  <tr>
                  <th align="left">
                  <label class="control-label" for="minlengthfield">Kelas</label>
                  <div class="control-group">
                <div class="controls">:
                        <input type="hidden" name="calon_kelas" value="<?php echo $rowsiswa->calon_kelas ?>">
                        <?php
                          $arrkelas_id='data-rule-required=true';
                          if($isi->kelas_id<>""){
                            $kelas_id=$isi->kelas_id;
                          }else{
                            $kelas_id=$rowsiswa->calon_kelas;
                          }
                          echo form_dropdown('kelas_id',$kelas_id_opt,$kelas_id,$arrkelas_id);
                        ?>
                </div>
                  </div>
                  </th></tr>
                  <?php } ?>
            <tr>
		            <th align="left">
	                		<label class="control-label" for="minlengthfield">Tanggal Mulai</label>
	                		<div class="control-group">
								<div class="controls">:
                  <?php
                    echo form_input(array('class' => '', 'id' => 'dp1','name'=>'tgl_mulai','value'=>$CI->p_c->tgl_form($isi->tgl_mulai),'data-rule-required'=>'true' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'2' ,'placeholder'=>'DD-MM-YYYY','autocomplete'=>'off'));
                  ?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th></tr>
                  <?php if($keg_id==11){ ?>
                  <tr>
      		            <th align="left">
      	                		<label class="control-label" for="minlengthfield">Tanggal Akhir</label>
      	                		<div class="control-group">
      								<div class="controls">:
                        <?php
                          echo form_input(array('class' => '', 'id' => 'dp2','name'=>'tgl_akhir','value'=>$CI->p_c->tgl_form($isi->tgl_akhir),'data-rule-required'=>'true' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'2' ,'placeholder'=>'DD-MM-YYYY','autocomplete'=>'off'));
                        ?>
      			                	<?php //echo  <p id="message"></p> ?>
      								</div>
      	                		</div>
      			            </th></tr>
                  <?php } ?>
                  <tr>
                      <th align="left">
                        		<label class="control-label" for="minlengthfield">Jam Mulai (HH:MM)</label>
                        		<div class="control-group">
                							<div class="controls">:
                		                	<?php
                                        echo $CI->p_c->combotime("jammulai",substr($isi->jammulai,0,2),substr($isi->jammulai,3,2),false);
                		                		//echo form_input(array('class' => '', 'id' => 'jammulai','name'=>'jammulai','value'=>$isi->jammulai,'style'=>'width:100px','data-rule-required'=>'true' ,'data-rule-maxlength'=>'5', 'data-rule-minlength'=>'5' ,'placeholder'=>'HH:MM'));
                		                	?>
                		                	<?php //echo  <p id="message"></p> ?>
                							</div>
                        		</div>
                    </tr>
                    <tr>
          	            <th align="left">
                          		<label class="control-label" for="minlengthfield">Jam Akhir (HH:MM)</label>
                          		<div class="control-group">
                  							<div class="controls">:
                  		                	<?php
                                          echo $CI->p_c->combotime("jamakhir",substr($isi->jamakhir,0,2),substr($isi->jamakhir,3,2),false);
                                          //echo form_input(array('class' => '', 'id' => 'jamakhir','name'=>'jamakhir','value'=>$isi->jamakhir,'style'=>'width:100px','data-rule-required'=>'true' ,'data-rule-maxlength'=>'5', 'data-rule-minlength'=>'5' ,'placeholder'=>'HH:MM'));
                  		                	?>
                  		                	<?php //echo  <p id="message"></p> ?>
                  							</div>
                          		</div>
                      </tr>
            </table>
            <table width="100%" border="0">
				    <tr>
				            <th align="left">
                      <input type="hidden" name="keg_id" value="<?php echo $keg_id ?>">
                      <input type="hidden" name="siswa_id" value="<?php echo $siswa_id ?>">
				            	<button class='btn btn-primary' onclick="return validate()">Simpan</button>
				            	<a href="javascript:void(window.open('<?php echo site_url("psb_penjadwalan") ?>'))" class="btn btn-success">Kembali</a>
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
