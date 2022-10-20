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
                        <li><a href="javascript:void(window.open('<?php echo site_url('ns_rapottipe/tambah'); ?>'))" ><i class="fa fa-plus-square"></i> Tambah</a></li>
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
	                    	<td align="left" width="150">Departemen</td>
				            <td align="left">
                      <div class="control-group">
				            	<?php
			                		$arriddepartemen="data-rule-required=false id=iddepartemen  onchange='javascript:this.form.submit();' ";
			                		echo form_dropdown('iddepartemen',$iddepartemen_opt,$this->input->post('iddepartemen'),$arriddepartemen);
			                	?>
                      </div>
				            </td>
                    <td align="left" width="150">Tipe Rapor</td>
				            <td align="left">
                      <div class="control-group">
				            	<?php
		                		$arridrapottipe="data-rule-required=false id=idrapottipe onchange='javascript:this.form.submit();'";
		                		echo form_dropdown('idrapottipe',$idrapottipe_opt,$this->input->post('idrapottipe'),$arridrapottipe);
		                	?>
                    </div>
				            </td>
                  </tr>
                  <tr>
                  <td align="left" width="150">K13</td>
                  <td align="left">
                    <div class="control-group">
                    <?php
                      $arrk13="data-rule-required=false id=k13 onchange='javascript:this.form.submit();'";
                      echo form_dropdown('k13',array("1"=>"Ya",""=>"Semua"),$this->input->post('k13'),$arrk13);
                    ?>
                  </div>
                  </td>
                  <td align="left" width="150">Lokasi Sekolah</td>
                  <td align="left">
                    <div class="control-group">
                    <?php
                      $arridcompany="data-rule-required=false id=idcompany onchange='javascript:this.form.submit();'";
                      echo form_dropdown('idcompany',$idcompany_opt,$this->input->post('idcompany'),$arridcompany);
                    ?>
                  </div>
                  </td>
                </tr>
                <tr>
                <td align="left" width="150">Kata Kunci</td>
									  <td align="left">
      				                		<div class="control-group">
          						                	<?php
                                               		echo form_input(array('class' => '','style'=>'margin: 0px 0px 5px; width: 300px;', 'id' => 'katakunci','name'=>'katakunci','value'=>$this->input->post('katakunci'),'data-rule-required'=>'false' ,'data-rule-maxlength'=>'500', 'data-rule-minlength'=>'3' ,'placeholder'=>'Masukkan 1-100 Karakter'));
          						                	?>
          						                	<?php //echo  <p id="message"></p> ?>
              											</div>
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
                                                <?php
                                                echo "<th width='50'>No.</th>";
                                                echo "<th>Nama Rapor</th>";
                                                echo "<th>Jenjang</th>";
                                                echo "<th>Tipe</th>";
                                                //echo "<th>LPD</th>";
                                                //echo "<th>Grafik</th>";
                                                //echo "<th>Memanjang</th>";
                                                /*
                                                echo "<th>Absensi</th>";
                                                //echo "<th>Nilai Murni</th>";
                                                //echo "<th>Grup</th>"; //Oleh Pengembangan Diri
                                                echo "<th>KKM</th>";
                                                echo "<th>Predikat</th>";
                                                echo "<th>Huruf</th>";
                                                echo "<th>Kop Surat</th>";
                                                echo "<th>Nama Jenjang</th>";
                                                echo "<th>Psikolog</th>";
                                                */
                                                echo "<th>Formula</th>";
                                                echo "<th>Tampilan</th>";
                                                //echo "<th>Tipe Predikat</th>";
                                                echo "<th>Keterangan</th>";
                                                echo "<th>K13</th>";
                                                echo "<th>Lokasi Sekolah</th>";
                                                echo "<th>aktif</th>";
                                                echo "<th width='80'>Aksi</th>";
                                                ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        	<?php
                                        	$CI =& get_instance();$no=1;
											foreach((array)$show_table as $row) {
											    echo "<tr>";
											    echo "<td align='center'>".$no++."</td>";
											    echo "<td align=''>".strtoupper($row->rapottipe)."</td>";
                          echo "<td align=''>".strtoupper($row->iddepartemen)."</td>";
                          echo "<td align=''>".strtoupper($row->tipe)."</td>";
                          //echo "<td align='center'>".($CI->p_c->cekaktif($row->lpd))."</td>";
                          //echo "<td align='center'>".($CI->p_c->cekaktif($row->grafik))."</td>";
                          //echo "<td align='center'>".($CI->p_c->cekaktif($row->portraitview))."</td>";
                          /*
											    echo "<td align='center'>".($CI->p_c->cekaktif($row->absensi))."</td>";

                          //echo "<td align='center'>".($CI->p_c->cekaktif($row->nilaimurni))."</td>";
											    //echo "<td align='center'>".($CI->p_c->cekaktif($row->gruppengembangandiri))."</td>";
											    echo "<td align='center'>".($CI->p_c->cekaktif($row->kkm))."</td>";
                          echo "<td align='center'>".($CI->p_c->cekaktif($row->predikat))."</td>";
                          echo "<td align='center'>".($CI->p_c->cekaktif($row->kalimatrapor))."</td>";
                          echo "<td align='center'>".($CI->p_c->cekaktif($row->kopsurat))."</td>";
                          echo "<td align='center'>".($CI->p_c->cekaktif($row->namajenjang))."</td>";
                          echo "<td align='center'>".($CI->p_c->cekaktif($row->psikologon))."</td>";
                          */
                          echo "<td align='left'>";
                            echo "Absensi: ".($CI->p_c->cekaktif($row->absensi))."<br/>";
                            echo "Batas Nilai: ".$row->batasnilai."<br/>";
                            //echo "Nilai Murni: "."<br/>";
                            //echo "Grup: "."<br/>"; //Oleh Pengembangan Diri
                            echo "Hitung Rata-Rata: ".($CI->p_c->cekaktif($row->avg))."<br/>";
                          echo "</td>";
                          echo "<td align='left'>";
                            echo "Paket Kompetensi: ".($CI->p_c->cekaktif($row->paketkompetensi))."<br/>";
                            echo "SKK: ".($CI->p_c->cekaktif($row->skk))."<br/>";
                            echo "KKM: ".($CI->p_c->cekaktif($row->kkm))."<br/>";
                            echo "Besar Font: ".$row->besarfont."<br/>";
                            echo "Jumlah Data: ".$row->jumlahdata."<br/>";
                            echo "Predikat: ".($CI->p_c->cekaktif($row->predikat))."<br/>";
                            echo "Huruf: ".($CI->p_c->cekaktif($row->kalimatrapor))."<br/>";
                            echo "Kop Surat: ".($CI->p_c->cekaktif($row->kopsurat))."<br/>";
                            echo "Nama Jenjang: ".($CI->p_c->cekaktif($row->namajenjang))."<br/>";
                            echo "Psikolog: ".($CI->p_c->cekaktif($row->psikologon))."<br/>";
                            echo "Konselor: ".($CI->p_c->cekaktif($row->konseloron))."<br/>";
                            //echo "Modular :<a href=javascript:void(window.open('".site_url('ns_rapottipe/ubahmodular/'.$row->replid.'/'.!($row->modular))."')) >".$CI->p_c->cekaktif($row->modular)."</a><br/>";
                          echo "</td>";
                          //echo "<td align='center'>".$row->predikattipe."</td>";
                          echo "<td align='center'>".strtoupper($row->keterangan)."</td>";
                          echo "<td align='center'>".$CI->p_c->cekaktif($row->k13)."</td>";
                          echo "<td align='center'>".$CI->dbx->variabel_company('ns_rapottipe',$row->replid)."</td>";
											    echo "<td align='center'>";
                          echo "<a href=javascript:void(window.open('".site_url('ns_rapottipe/ubahaktif/'.$row->replid.'/'.!($row->aktif))."')) >".$CI->p_c->cekaktif($row->aktif)."</a>";
                          echo "</td>";
											    echo "<td align='center'>";
                          //if ($row->pakai<1){
                            echo "<a href=javascript:void(window.open('".site_url('ns_rapottipe/ubah/'.$row->replid)."')) class='btn btn-xs btn-warning' >Ubah</a>";
                          //}
                          //if ($row->pakai<1){
											                 echo "<a href=javascript:void(window.open('".site_url('ns_rapottipe/hapus/'.$row->replid)."')) class='btn btn-xs btn-danger' >Hapus</a>";
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
	                		<label class="control-label" for="minlengthfield">Nama Rapor</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		echo form_input(array('class' => '','style'=>'margin: 0px 0px 5px; width: 687px;', 'id' => 'rapottipe','name'=>'rapottipe','value'=>$isi->rapottipe,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'500', 'data-rule-minlength'=>'2' ,'placeholder'=>'Masukkan 5-100 Karakter'));
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
                            $arriddepartemen='data-rule-required=true';
                            echo form_dropdown('iddepartemen',$iddepartemen_opt,$isi->iddepartemen,$arriddepartemen);
                          ?>
                          <?php //echo  <p id="message"></p> ?>
                  </div>
                    </div>
                    </th></tr>
                    <tr>
                      <th align="left">
                      <label class="control-label" for="minlengthfield">Tipe Rapor</label>
                      <div class="control-group">
                    <div class="controls">:
                            <?php
                              $arrtipe='data-rule-required=true';
                              echo form_dropdown('tipe',$tipe_opt,$isi->tipe,$arrtipe);
                            ?>
                            <?php //echo  <p id="message"></p> ?>
                    </div>
                      </div>
                      </th></tr>
                      <!--
      		            <tr>
      		            <th align="left">
      		        		<label class="control-label" for="minlengthfield">Grafik</label>
      		        		<div class="control-group">
      							<div class="controls">:
      		                	<?php
      		                		echo form_checkbox('grafik', '1', $isi->grafik);
      		                	?>
      		                	<?php //echo  <p id="message"></p> ?>
      							</div>
      		        		</div>
      		            </th></tr>
                      <tr>
          				    <th align="left">
          		        		<label class="control-label" for="minlengthfield">LPD</label>
          		        		<div class="control-group">
          							<div class="controls">:
          		                	<?php
          		                		echo form_checkbox('lpd', '1', $isi->lpd);
          		                	?>
          		                	<?php //echo  <p id="message"></p> ?>
          							</div>
          		        		</div>
          		            </th></tr>
                          <tr>
              				    <th align="left">
              		        		<label class="control-label" for="minlengthfield">Memanjang</label>
              		        		<div class="control-group">
              							<div class="controls">:
              		                	<?php
              		                		echo form_checkbox('portraitview', '1', $isi->portraitview);
              		                	?>
              		                	<?php //echo  <p id="message"></p> ?>
              							</div>
              		        		</div>
              		            </th></tr>
                    -->
				    <tr>
				    <th align="left">
		        		<label class="control-label" for="minlengthfield">Absensi</label>
		        		<div class="control-group">
							<div class="controls">:
		                	<?php
		                		echo form_checkbox('absensi', '1', $isi->absensi);
		                	?>
		                	<?php //echo  <p id="message"></p> ?>
							</div>
		        		</div>
		            </th></tr>
				    <tr>
		            <th align="left">
		        		<label class="control-label" for="minlengthfield">Nilai Murni</label>
		        		<div class="control-group">
							<div class="controls">:
		                	<?php
		                		echo form_checkbox('nilaimurni', '1', $isi->nilaimurni);
		                	?>
		                	<?php //echo  <p id="message"></p> ?>
							</div>
		        		</div>
		            </th></tr>
                <!--
		            <tr>
		            <th align="left">
		        		<label class="control-label" for="minlengthfield">Grup Oleh Pengembangan Diri</label>
		        		<div class="control-group">
							<div class="controls">:
		                	<?php
		                		echo form_checkbox('gruppengembangandiri', '1', $isi->gruppengembangandiri);
		                	?>
		                	<?php //echo  <p id="message"></p> ?>
							</div>
		        		</div>
		            </th></tr>
                -->
                <tr>
                <th align="left">
                <label class="control-label" for="minlengthfield">Paket Kompetensi</label>
                <div class="control-group">
              <div class="controls">:
                      <?php
                        echo form_checkbox('paketkompetensi', '1', $isi->paketkompetensi);
                      ?>
                      <?php //echo  <p id="message"></p> ?>
              </div>
                </div>
                </th></tr>
                <tr>
                <th align="left">
                <label class="control-label" for="minlengthfield">SKK</label>
                <div class="control-group">
              <div class="controls">:
                      <?php
                        echo form_checkbox('skk', '1', $isi->skk);
                      ?>
                      <?php //echo  <p id="message"></p> ?>
              </div>
                </div>
                </th></tr>
                <tr>
                <th align="left">
                <label class="control-label" for="minlengthfield">KKM</label>
                <div class="control-group">
              <div class="controls">:
                      <?php
                        echo form_checkbox('kkm', '1', $isi->kkm);
                      ?>
                      <?php //echo  <p id="message"></p> ?>
              </div>
                </div>
                </th></tr>
                <tr>
                <th align="left">
                <label class="control-label" for="minlengthfield">Hitung Rata-Rata</label>
                <div class="control-group">
              <div class="controls">:
                      <?php
                        echo form_checkbox('avg', '1', $isi->avg);
                      ?>
                      <?php //echo  <p id="message"></p> ?>
              </div>
                </div>
                </th></tr>

                <tr>
                <th align="left">
                <label class="control-label" for="minlengthfield">Predikat</label>
                <div class="control-group">
              <div class="controls">:
                      <?php
                        echo form_checkbox('predikat', '1', $isi->predikat);
                      ?>
                      <?php //echo  <p id="message"></p> ?>
              </div>
                </div>
                </th></tr>

                <tr>
                <th align="left">
                <label class="control-label" for="minlengthfield">Huruf</label>
                <div class="control-group">
              <div class="controls">:
                      <?php
                        echo form_checkbox('kalimatrapor', '1', $isi->kalimatrapor);
                      ?>
                      <?php //echo  <p id="message"></p> ?>
              </div>
                </div>
                </th></tr>

                <tr>
                <th align="left">
                <label class="control-label" for="minlengthfield">Kop Surat</label>
                <div class="control-group">
              <div class="controls">:
                      <?php
                        echo form_checkbox('kopsurat', '1', $isi->kopsurat);
                      ?>
                      <?php //echo  <p id="message"></p> ?>
              </div>
                </div>
                </th></tr>
                <tr>
                <th align="left">
                <label class="control-label" for="minlengthfield">Nama Jenjang</label>
                <div class="control-group">
              <div class="controls">:
                      <?php
                        echo form_checkbox('kopsurat', '1', $isi->namajenjang);
                      ?>
                      <?php //echo  <p id="message"></p> ?>
              </div>
                </div>
                </th></tr>
              <tr>
  				    <th align="left">
  		        		<label class="control-label" for="minlengthfield">Psikolog</label>
  		        		<div class="control-group">
  							<div class="controls">:
  		                	<?php
  		                		echo form_checkbox('psikologon', '1', $isi->psikologon);
  		                	?>
  		                	<?php //echo  <p id="message"></p> ?>
  							</div>
  		        		</div>
  		            </th></tr>
                  <tr>
  				    <th align="left">
  		        		<label class="control-label" for="minlengthfield">Konselor</label>
  		        		<div class="control-group">
  							<div class="controls">:
  		                	<?php
  		                		echo form_checkbox('konseloron', '1', $isi->konseloron);
  		                	?>
  		                	<?php //echo  <p id="message"></p> ?>
  							</div>
  		        		</div>
  		            </th></tr>
                <tr>
    		            <th align="left">
    	                		<label class="control-label" for="minlengthfield">Besar Font (Point)</label>
    	                		<div class="control-group">
    								<div class="controls">:
    			                	<?php
    			                		echo form_input(array('class' => '','style'=>'margin: 0px 0px 5px;', 'id' => 'besarfont','name'=>'besarfont','value'=>$isi->besarfont,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'4', 'data-rule-minlength'=>'1' ,'placeholder'=>'Masukkan 1-4 Karakter'));
    			                	?>
    			                	<?php //echo  <p id="message"></p> ?>
    								</div>
    	                		</div>
    			            </th></tr>
                      <tr>
                          <th align="left">
                                <label class="control-label" for="minlengthfield">Jumlah Data</label>
                                <div class="control-group">
                          <div class="controls">:
                                  <?php
                                    echo form_input(array('class' => '','style'=>'margin: 0px 0px 5px;', 'id' => 'jumlahdata','name'=>'jumlahdata','value'=>$isi->jumlahdata,'data-rule-required'=>'false' ,'data-rule-maxlength'=>'4', 'data-rule-minlength'=>'1' ,'placeholder'=>'Masukkan 1-4 Karakter'));
                                  ?>
                                  <?php //echo  <p id="message"></p> ?>
                          </div>
                                </div>
                            </th></tr>
            <!--
            <tr>
                <th align="left">
                      <label class="control-label" for="minlengthfield">Tipe Predikat</label>
                      <div class="control-group">
                <div class="controls">:
                        <?php
                          echo form_input(array('class' => '','style'=>'margin: 0px 0px 5px;', 'id' => 'predikattipe','name'=>'predikattipe','value'=>$isi->predikattipe,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'4', 'data-rule-minlength'=>'1' ,'placeholder'=>'Masukkan 1-4 Karakter'));
                        ?>
                        <?php //echo  <p id="message"></p> ?>
                </div>
                      </div>
                  </th></tr>
-->
          <tr>
              <th align="left">
                    <label class="control-label" for="minlengthfield">Batas Nilai</label>
                    <div class="control-group">
              <div class="controls">:
                      <?php
                        echo form_input(array('class' => '','style'=>'margin: 0px 0px 5px;', 'id' => 'batasnilai','name'=>'batasnilai','value'=>$isi->batasnilai,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'4', 'data-rule-minlength'=>'1' ,'placeholder'=>'Masukkan 1-4 Karakter'));
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
		        		<label class="control-label" for="minlengthfield">K13</label>
		        		<div class="control-group">
							<div class="controls">:
		                	<?php
		                		echo form_checkbox('k13', '1', $isi->k13);
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
  										<hr/>
  									<label class="control-label" for="minlengthfield">Lokasi Sekolah</label>
  									<div class="control-group">
  								<div class="controls">
  												<?php
  												$CI->p_c->checkbox_more('idcompany',$idcompany_opt,$idreff_company_opt,0);
  												?>
  								</div>
  									</div>
  									<hr/>
  									</th>
  						</tr>
				    <tr>
				            <th align="left">
				            	<button class='btn btn-primary' onclick="return validate()">Simpan</button>
				            	<a href="javascript:void(window.open('<?php echo site_url('ns_rapottipe') ?>'))" class="btn btn-success">Kembali</a>
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
