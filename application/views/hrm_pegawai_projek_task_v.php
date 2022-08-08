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
                <!-- Content Header (Page header) -->
<?php $CI =& get_instance();?>
<?php if($view=='index'){ ?>
                <section class="content-header table-responsive">
                    <h1>
                        <?php echo $form ?>
                        <small>List Data</small>
                    </h1>
                    <!--
                        <li><a href="#"><i class="fa fa-file-text"></i>Cetak</a></li>
                        <li><a href="#"><i class="fa fa-file-excel-o"></i>Excel</a></li>
                        -->
                    <ol class="breadcrumb">
                        <li><a href="javascript:void(window.open('<?php echo site_url('hrm_pegawai_projek_task/tambah'); ?>'))" ><i class="fa fa-plus-square"></i> Tambah</a></li>

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
                                    <?php
                                      echo "<table id='example1' class='table table-bordered table-striped'>";
                                      echo "<thead>";
                                      echo "<tr>";
                                      echo "<th width='50'>No.</th>";
                                      echo "<th>Projek</th>";
                                      echo "<th>Projek Tugas</th>";
                                      //echo "<th>Deskripsi</th>";
                                      echo "<th>Peran</th>";
                                      echo "<th>Tanggal Mulai</th>";
                                      echo "<th>Tanggal Akhir</th>";
                                      echo "<th>Durasi</th>";
                                      echo "<th>Jml. Kegiatan</th>";
                                      echo "<th>Aktif</th>";
                                      echo "<th width='80'>Aksi</th>";
                                      echo "</tr>";
                                      echo "</thead>";
                                        	$CI =& get_instance();
                                        	$no=1;
                                      echo "<tbody>";
											foreach((array)$show_table as $row) {
											    echo "<tr>";
											    echo "<td align='center'>".$no++."</td>";
                          echo "<td align='center'>".$row->projektext."</td>";
                          echo "<td align='center'>
                               <a href=javascript:void(window.open('".site_url('hrm_pegawai_projek_task/view/0/'.$row->replid)."')) >".$row->projektask."</a>
                             </td>";
                          //echo "<td align='center'>".$row->deskripsi."</td>";
                          echo "<td align='center'>".$CI->dbx->role_show($row->idrole,0)."</td>";
                          echo "<td align='center'>".$CI->p_c->tgl_indo($row->tanggalmulai)."</td>";
                          echo "<td align='center'>".$CI->p_c->tgl_indo($row->tanggalakhir)."</td>";
                          echo "<td align='center'>".$row->lama." Hari</td>";
                          echo "<td align='center'>".$row->jumlahkegiatan."</td>";
                          echo "<td align='center'>";
                          //if($row->jumlahkegiatan<1){
                            echo "<a href=javascript:void(window.open('".site_url('hrm_pegawai_projek_task/ubahaktif/'.$row->replid.'/'.!($row->aktif))."'))>".$CI->p_c->cekaktif($row->aktif)."</a>";
                          //}else{
                          //  echo $CI->p_c->cekaktif($row->aktif);
                          //}
                          echo "</td>";
                          echo "<td align='center'>";
                          if($row->jumlahkegiatan<1){
                            echo "<a href=javascript:void(window.open('".site_url('hrm_pegawai_projek_task/ubah/'.$row->replid)."')) class='btn btn-xs btn-warning fa fa-check-square' ></a>&nbsp;&nbsp;";
                            echo "<a href=javascript:void(window.open('".site_url('hrm_pegawai_projek_task/hapus/'.$row->replid)."')) class='btn btn-xs btn-danger fa fa-minus-square' ></a>";
                          }
                          echo "</td>";
											    echo "</tr>";
											}
                      echo "</tbody>";
											?>

                                        <tfoot>
                                        </tfoot>
                                    </table>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>
              </section><!-- /.content -->
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
              <th align="left"><label class="control-label" for="minlengthfield">Tahun</label>
                <div class="control-group">
             <div class="controls">:
                            <?php
                            echo form_input(array('id' => 'tahun','name'=>'tahun','value'=>$isi->tahun,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'4 ', 'data-rule-minlength'=>'4','data-rule-number'=>'true','placeholder'=>'Masukkan 4 Karakter','style'=>'width:100px !important;'));
                            ?>
                            <?php //echo  <p id="message"></p> ?>
                    </div>
                </div>
                </th>
            </tr>
            <tr>
            <th align="left">
            <label class="control-label" for="minlengthfield">Bulan/Minggu</label>
            <div class="control-group">
              <div class="controls">
                      <?php
                        for ($m=1;$m<=12;$m++){
                          echo $CI->p_c->getBulan($m)."<br/>";
                          for ($w=1;$w<=4;$w++){
                            echo form_checkbox('idminggu[]', ($m.'.'.$w), '').' '.$CI->p_c->romawi($w)."&nbsp;&nbsp;";
                          }
                          echo "<br/>";
                        }
                        //$arridbulan='data-rule-required=true';
                        //echo form_dropdown('idbulan',$idbulan_opt,$isi->idbulan,$arridbulan);
                      ?>
              </div>
            </div>
            </th></tr>
            <!--
            <tr>
            <th align="left">
            <label class="control-label" for="minlengthfield">Minggu</label>
            <div class="control-group">
              <div class="controls">:
                      <?php
                        for ($i=1;$i<=4;$i++){
                          echo form_checkbox('idminggu', $i, '').' '.$CI->p_c->romawi($i)."&nbsp;&nbsp;";
                        }
                      ?>
              </div>
            </div>
            </th></tr>
          -->
            <tr>
                <th align="left">
                  <label class="control-label" for="minlengthfield">Projek</label>
                  <div class="control-group">
                    <div class="controls">:
                            <?php
                              $arridprojek='data-rule-required=true';
                              echo form_dropdown('idprojek',$idprojek_opt,$isi->idprojek,$arridprojek);
                            ?>
                    </div>
                  </div>
                </th>
            </tr>
            <tr>
		            <th align="left">
	                		<label class="control-label" for="minlengthfield">Program Kerja</label>
	                		<div class="control-group">
            								<div class="controls">:
                              <textarea id="editor1" name="projektask" rows="2" data-rule-required="true" style='width:220px;'><?php echo trim($isi->projektask)?></textarea>
            			                	<?php //echo  <p id="message"></p> ?>
            								</div>
	                		</div>
			            </th>
            </tr>
            <tr>
		            <th align="left">
	                		<label class="control-label" for="minlengthfield">Tujuan Program Kerja</label>
	                		<div class="control-group">
            								<div class="controls">:
                              <textarea id="editor1" name="tujuan" rows="2" data-rule-required="true" style='width:220px;'><?php echo trim($isi->tujuan)?></textarea>
            			                	<?php //echo  <p id="message"></p> ?>
            								</div>
	                		</div>
			            </th>
            </tr>
            <tr>
		            <th align="left">
	                		<label class="control-label" for="minlengthfield">Indikator KPI</label>
	                		<div class="control-group">
            								<div class="controls">:
                              <textarea id="editor1" name="indikatorkpi" rows="2" data-rule-required="true" style='width:220px;'><?php echo trim($isi->indikatorkpi)?></textarea>
            			                	<?php //echo  <p id="message"></p> ?>
            								</div>
	                		</div>
			            </th>
            </tr>
            <!--
		    		<tr>
		            <th align="left">
	                		<label class="control-label" for="minlengthfield">Tanggal Mulai</label>
	                		<div class="control-group">
								<div class="controls">:
                  <?php
                    echo form_input(array('class' => '', 'id' => 'dp1','name'=>'tanggalmulai','value'=>$CI->p_c->tgl_form($isi->tanggalmulai),'data-rule-required'=>'false' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'2' ,'placeholder'=>'DD-MM-YYYY','autocomplete'=>'off'));
                  ?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th></tr>
			        <tr>
			        <tr>
				            <th align="left">
		                		<label class="control-label" for="minlengthfield">Tanggal Akhir</label>
		                		<div class="control-group">
									<div class="controls">:
                    <?php
                      echo form_input(array('class' => '', 'id' => 'dp2','name'=>'tanggalakhir','value'=>$CI->p_c->tgl_form($isi->tanggalakhir),'data-rule-required'=>'false' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'2' ,'placeholder'=>'DD-MM-YYYY','autocomplete'=>'off'));
                    ?>
				                	<?php //echo  <p id="message"></p> ?>
									</div>
		                		</div>
				        </th></tr>
              -->
                <!--
                <tr>
                    <th align="left">
                        <label class="control-label" for="minlengthfield">Deskripsi</label>
                        <div class="control-group">
                  <div class="controls">:
                          </div>
                    </th>
                </tr>
                <tr>
                  <th>
                              <div class='box-body pad'>
                                      <textarea id="editor1" name="deskripsi" rows="10" cols="80" data-rule-required="true">
                                          <?php echo $isi->deskripsi?>
                                      </textarea>
                                      <script type="text/javascript">CKEDITOR.replace('editor1');</script>
                              </div>
                              <?php //echo  <p id="message"></p> ?>
                    </th></tr>
                  -->
                  <tr>
                    <th align="left"><label class="control-label" for="minlengthfield">Frekuensi</label>
                      <div class="control-group">
                   <div class="controls">:
                                  <?php
                                  echo form_input(array('id' => 'frekuensi','name'=>'frekuensi','value'=>$isi->frekuensi,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'4 ', 'data-rule-minlength'=>'1','data-rule-number'=>'true','placeholder'=>'Masukkan 1-4 Karakter','style'=>'width:100px !important;'));
                                  ?>
                                  <?php //echo  <p id="message"></p> ?>
                          </div>
                      </div>
                      </th>
                  </tr>
                  <tr>
  		              <th align="left">
  		                      <label class="control-label" for="minlengthfield">Biaya Satuan</label>
  		                      <div class="control-group">
  		                    <div class="controls">:
  		                            <?php
  		                              echo form_input(array('id' => 'biaya','name'=>'biaya','value'=>$isi->biaya,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'15', 'data-rule-minlength'=>'1','data-rule-number'=>'true','placeholder'=>'Masukkan 1-15 Karakter'));
  		                            ?>
  		                            <?php //echo  <p id="message"></p> ?>
  		                    </div>
  		                      </div>
  		              </th>
  		          </tr>
                <tr>
                  <th align="left">
                          <label class="control-label" for="minlengthfield">Mitra</label>
                          <div class="control-group">
                        <div class="controls">:
                                <?php
                                  echo form_input(array('id' => 'mitra','name'=>'mitra','value'=>$isi->mitra,'data-rule-required'=>'false' ,'data-rule-maxlength'=>'200', 'data-rule-minlength'=>'1','placeholder'=>'Masukkan 1-200 Karakter'));
                                ?>
                                <?php //echo  <p id="message"></p> ?>
                        </div>
                          </div>
                  </th>
              </tr>
              <tr>
                  <th align="left">
                    <label class="control-label" for="minlengthfield">Penanggung Jawab</label>
                    <div class="control-group">
                      <div class="controls">:
                              <?php
                                $arridpj='data-rule-required=true';
                                echo form_dropdown('idpj',$idpegawai_opt,$isi->idpj,$arridpj);
                                echo form_input(array('id' => 'persenpj','name'=>'persenpj','value'=>$isi->persenpj,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'3 ', 'data-rule-minlength'=>'1','data-rule-number'=>'true','placeholder'=>'Masukkan 0-100%','style'=>'width:100px !important;'))." %";
                              ?>
                      </div>
                    </div>
                  </th>
              </tr>
              <tr>
                  <th align="left">
                    <label class="control-label" for="minlengthfield">Monev</label>
                    <div class="control-group">
                      <div class="controls">:
                              <?php
                                $arridmonev='data-rule-required=true';
                                echo form_dropdown('idmonev',$idpegawai_opt,$isi->idmonev,$arridmonev);
                                echo form_input(array('id' => 'persenmonev','name'=>'persenmonev','value'=>$isi->persenmonev,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'3 ', 'data-rule-minlength'=>'1','data-rule-number'=>'true','placeholder'=>'Masukkan 0-100%','style'=>'width:100px !important;'))." %";
                              ?>
                      </div>
                    </div>
                  </th>
              </tr>
              <tr>
              <th align="left">
              <label class="control-label" for="minlengthfield">Pelaksana </label>
              <div class="control-group">
            <div class="controls">:
                    <?php
                      echo form_input(array('id' => 'persenpelaksana','name'=>'persenpelaksana','value'=>$isi->persenpelaksana,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'3 ', 'data-rule-minlength'=>'1','data-rule-number'=>'true','placeholder'=>'Masukkan 0-100%','style'=>'width:100px !important;'))." %";
                    ?>
                    <?php //echo  <p id="message"></p> ?>
            </div>
              </div>
              </th></tr>
                  <tr>
                  <th align="left">
                  <label class="control-label" for="minlengthfield">Pelaksana External</label>
                  <div class="control-group">
                <div class="controls">:
                        <?php
                          echo form_checkbox('external', '1', $isi->external);
                        ?>
                        <?php //echo  <p id="message"></p> ?>
                </div>
                  </div>
                  </th></tr>
                  <!--
                  <tr>
        	            <th align="left">
        	        		<label class="control-label" for="minlengthfield">Peran Peserta</label>
        	        		<div class="control-group">
        						<div class="controls">
        						<input type="checkbox" onClick="selectallx('idrole','selectall')" id="selectall" class="selectall"/> Pilih Semua <hr/>

        	                	<?php
        	                		$CI->p_c->checkbox_more('idrole',$idrole_opt,$isi->idrole);
        	                	?>
        	                	<?php //echo  <p id="message"></p> ?>
        						</div>
        	        		</div>
        	            </th></tr>
                -->
			         <tr>
				            <th align="left">
				            	<button class='btn btn-primary' onclick="return validate()">Simpan</button>
				            	<a href="javascript:void(window.open('<?php echo site_url('hrm_pegawai_projek_task') ?>'))" class="btn btn-success">Batal</a>
				            </th>
				    </tr>
		            </table>
		        	<?php
		        	echo form_close();
		        	?>
	    </section>
<?php } else if($view=='peserta'){ ?>
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
            <label class="control-label" for="minlengthfield">Peserta</label>
            <div class="control-group">
          <div class="controls">
          <input type="checkbox" onClick="selectallx('idpegawai','selectall')" id="selectall" class="selectall"/> Pilih Semua <hr/>

                  <?php
                    $CI->p_c->checkbox_more('idpegawai',$idpegawai_opt,$idpegawairows);
                  ?>
                  <?php //echo  <p id="message"></p> ?>
          </div>
            </div>
            </th></tr>
      </table>
      <table>
          <tr>
               <th align="left">
                 <button class='btn btn-primary' onclick="return validate()">Simpan</button>
                 <a href="javascript:void(window.open('<?php echo site_url('hrm_pegawai_projek_task') ?>'))" class="btn btn-success">Batal</a>
               </th>
       </tr>
       </table>
      </section>
<?php } else if($view=='view'){ ?>
  <section class="content-header table-responsive">
        <h1>
            <?php echo $form ?>
            <small><?php echo $form_small ?></small>
        </h1>
      </section>
      <section class="content">
    <table width="100%" border="0" class="form-horizontal form-validate">
      <tr>
        <th align="left">
          <label class="control-label" for="minlengthfield">Tahun</label>
          <div class="control-group">
            <div class="controls">:
                    <?php echo $isi->tahun; ?>
            </div>
          </div>
        </th>
      </tr>
      <tr>
        <th align="left">
          <label class="control-label" for="minlengthfield">Jumlah Minggu</label>
          <div class="control-group">
            <div class="controls">:
                    <?php echo COUNT($minggu); ?>
            </div>
          </div>
        </th>
      </tr>
      <tr>
      <th align="left">
      <label class="control-label" for="minlengthfield">Projek</label>
      <div class="control-group">
        <div class="controls">:
                <?php echo $isi->projektext; ?>
        </div>
      </div>
      </th></tr>
      <tr>
          <th align="left">
                <label class="control-label" for="minlengthfield">Program Kerja</label>
                <div class="control-group">
          <div class="controls">:
                  <?php echo $isi->projektask; ?>
                  <?php //echo  <p id="message"></p> ?>
          </div>
                </div>
            </th></tr>
      <tr>
        <th align="left">
          <label class="control-label" for="minlengthfield">Tujuan Program Kerja</label>
          <div class="control-group">
            <div class="controls">:
                    <?php echo $isi->tujuan; ?>
            </div>
          </div>
        </th>
      </tr>
      <tr>
        <th align="left">
          <label class="control-label" for="minlengthfield">Indikator KPI</label>
          <div class="control-group">
            <div class="controls">:
                    <?php echo $isi->indikatorkpi; ?>
            </div>
          </div>
        </th>
      </tr>
      <tr>
        <th align="left">
          <label class="control-label" for="minlengthfield">Frekuensi</label>
          <div class="control-group">
            <div class="controls">:
                    <?php echo $isi->frekuensi; ?>
            </div>
          </div>
        </th>
      </tr>
      <tr>
        <th align="left">
          <label class="control-label" for="minlengthfield">Biaya Satuan</label>
          <div class="control-group">
            <div class="controls">:
                    <?php echo $CI->p_c->rupiah($isi->biaya); ?>
            </div>
          </div>
        </th>
      </tr>
      <tr>
        <th align="left">
          <label class="control-label" for="minlengthfield">Total Biaya</label>
          <div class="control-group">
            <div class="controls">:
                    <?php echo $CI->p_c->rupiah((COUNT($minggu)*$isi->frekuensi)*$isi->biaya); ?>
            </div>
          </div>
        </th>
      </tr>
      <tr>
        <th align="left">
          <label class="control-label" for="minlengthfield">Mitra</label>
          <div class="control-group">
            <div class="controls">:
                    <?php echo $isi->mitra; ?>
            </div>
          </div>
        </th>
      </tr>
      <tr>
        <th align="left">
          <label class="control-label" for="minlengthfield">Penanggung Jawab</label>
          <div class="control-group">
            <div class="controls">:
                    <?php echo $CI->dbx->getpegawai($isi->idpj,0,1)." (".$isi->frekuensi."%)";?>
            </div>
          </div>
        </th>
      </tr>
      <tr>
        <th align="left">
          <label class="control-label" for="minlengthfield">Monev</label>
          <div class="control-group">
            <div class="controls">:
                    <?php echo $CI->dbx->getpegawai($isi->idmonev,0,1)." (".$isi->persenmonev."%)";?>
            </div>
          </div>
        </th>
      </tr>
      <tr>
        <th align="left">
          <label class="control-label" for="minlengthfield">Pelaksana</label>
          <div class="control-group">
            <div class="controls">:
                    <?php echo $isi->persenpelaksana."%"; ?>
            </div>
          </div>
        </th>
      </tr>
      <tr>
        <th align="left">
          <label class="control-label" for="minlengthfield">Aktif</label>
          <div class="control-group">
            <div class="controls">:
                    <?php echo $CI->p_c->cekaktif($isi->aktif);?>
            </div>
          </div>
        </th>
      </tr>
      <!--
      <tr>
          <th align="left">
                <label class="control-label" for="minlengthfield">Tanggal Mulai</label>
                <div class="control-group">
          <div class="controls">:
            <?php echo $CI->p_c->tgl_indo($isi->tanggalmulai); ?>
                  <?php //echo  <p id="message"></p> ?>
          </div>
                </div>
            </th></tr>
        <tr>
        <tr>
              <th align="left">
                  <label class="control-label" for="minlengthfield">Tanggal Akhir</label>
                  <div class="control-group">
            <div class="controls">:
              <?php echo $CI->p_c->tgl_indo($isi->tanggalakhir); ?>
                    <?php //echo  <p id="message"></p> ?>
            </div>
                  </div>
          </th></tr>
          <tr>
                <th align="left">
                    <label class="control-label" for="minlengthfield">Lama Kegiatan</label>
                    <div class="control-group">
              <div class="controls">:
                <?php echo $isi->lama; ?> Hari
                      <?php //echo  <p id="message"></p> ?>
              </div>
                    </div>
            </th></tr>

          <tr>
                <th align="left">
                    <label class="control-label" for="minlengthfield">Peran Peserta</label>
                    <div class="control-group">
              <div class="controls">:
                <?php echo $CI->dbx->role_show($isi->idrole,0); ?>
                      <?php //echo  <p id="message"></p> ?>
              </div>
                    </div>
            </th></tr>
          -->
        </table>
<!--------------------------------------------------------------------------------------------------------------------------->
        <?php
          $mingguarray=array(0=>0);
          foreach((array)$minggu as $rowminggu) {
            array_push($mingguarray,($rowminggu->bulan.'.'.$rowminggu->minggu));
          }
          echo "<hr><h4 align='left'>Minggu :</h4>";
          echo "<table style='border-collapse:collapse' border='1' cellpadding='2' width='100%'>";
          echo "<tr>";
          for ($m=1;$m<=12;$m++){
            echo "<td bgcolor='3c8dbc' colspan='4' align='center' width='".(100/12)."%'><b>".$CI->p_c->getBulan($m)."</b></td>";
          }
          echo "</tr>";
          echo "<tr>";
          for ($m=1;$m<=12;$m++){
            for ($w=1;$w<=4;$w++){
              $bg="";
              if(array_search($m.'.'.$w, $mingguarray)<>0){$bg="bgcolor='#f39c12'";}
              echo "<td ".$bg.">&nbsp;</td>";
            }
          }
          echo "</tr>";
          echo "</table>";

          //$arridbulan='data-rule-required=true';
          //echo form_dropdown('idbulan',$idbulan_opt,$isi->idbulan,$arridbulan);
        ?>
        <hr><h4 align="left">Peserta :</h4>
        <?php
          echo "<table id='example1' class='table table-bordered table-striped'>";
          echo "<thead>";
          echo "<tr>";
          echo "<th width='50'>No.</th>";
          echo "<th>Nama</th>";
          echo "<th>Wajib</th>";
          if($ubah){
            echo "<th>Aksi</th>";
          }
          echo "</thead>";
          echo "</tr>";
          echo "<tbody>";
          $CI =& get_instance();
          $no=1;
          foreach((array)$hrm_pegawai_projek_task_peserta as $rowepes) {
              echo "<tr>";
              echo "<td align='center'>".$no++."</td>";
              echo "<td align='left'>".$CI->dbx->getpegawai($rowepes->idpeserta,0,1)."</td>";
              if($ubah){
                echo "<td align='center'>";
                echo "<a href=javascript:void(window.open('".site_url('hrm_pegawai_projek_task/ubahwajib_p/'.$rowepes->idhrm_pegawai_projek_task.'/'.$rowepes->idpeserta.'/'.!$rowepes->wajib)."')) >".$CI->p_c->cekaktif($rowepes->wajib)."</a>";
                echo "</td>";
                echo "<td align='center'>";
                echo "<a href=javascript:void(window.open('".site_url('hrm_pegawai_projek_task/hrmeventpesertahapus/'.$rowepes->idhrm_pegawai_projek_task.'/'.$rowepes->idpeserta)."')) class='btn btn-xs btn-danger fa fa-minus-square' ></a>";
                echo "</td>";
              }else{
                echo "<td align='center'>";
                echo $CI->p_c->cekaktif($rowepes->wajib);
                echo "</td>";
              }
              echo "</tr>";
          }
          echo "</tbody>";
          echo "<tfoot>";echo "</tfoot>";
          echo "</table>";
        $attributes = array('class' => 'form-horizontal form-validate', 'id' => 'form', 'method' => 'POST', 'novalidate'=>'novalidate');
        echo form_open($action,$attributes);
        echo "<table border='0'>";
        echo "<tr>";
        echo "<td align='left'>";
        //if(!$ubah){
          echo "<a href=javascript:void(window.open('".site_url('hrm_pegawai_projek_task/ubah/'.$isi->replid)."')) class='btn btn-warning'>Ubah</a>&nbsp;&nbsp;";
          echo "<a href=javascript:void(window.open('".site_url('hrm_pegawai_projek_task/hapus/'.$isi->replid)."')) class='btn btn-danger'>Hapus</a>&nbsp;&nbsp;";
        //}
        echo "<a href=javascript:void(window.open('".site_url('hrm_pegawai_projek_task')."')) class='btn btn-success'>Kembali</a>&nbsp;&nbsp;";
        echo "</td>";
        echo "</tr>";
        echo "</table>";
        ?>
      </section>
      <?php
      echo form_close();
} ?>
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
    </body>
</html>
