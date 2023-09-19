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
                        <li><a href="javascript:void(window.open('<?php echo site_url('ksw_tahunajaran/tambah'); ?>'))" ><i class="fa fa-plus-square"></i> Tambah</a></li>
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
    			                  </tr>
                            <!--
          			            <tr>
          				            <th align="left" colspan="4">
          				            	<button class='btn btn-primary' name='filter' value="1">Filter</button>
          				            	<?php echo "<a href='".site_url($action)."' class='btn btn-danger'>Bersihkan</a>&nbsp;&nbsp;";?>
          				            </th>
          				         </tr>
                         -->
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
                                                <th>Unit Bisnis</th>
                                                <th>Departemen</th>
                                                <th>Tahun Pelajaran</th>
                                                <th>Kepala Sekolah</th>
                                                <th>Tgl. Mulai</th>
                                                <th>Tgl. Akhir</th>
                                                <!--<th>Keterangan</th>-->
                                                <th>Jml. Kelas</th>
                                                <th>Jml. CPD</th>
                                                <th>Jml. PD</th>
                                                <th>Jml. Belajar</th>
                                                <th>PPDB</th>
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
                          echo "<td align=''>".strtoupper($row->companytext)."</td>";
                          echo "<td align=''>".strtoupper($row->departemen)."</td>";
                          echo "<td align=''>".strtoupper($row->tahunajaran)."</td>";
                          echo "<td align='left' width='200px'>";
                          echo "<b>Kepala Sekolah:</b> ".strtoupper($CI->dbx->getpegawai($row->idkepsek,0,1));
                          echo "<br/><b>Konselor:</b> ".strtoupper($CI->dbx->getpegawai($row->idkonselor,0,1));
                          echo "<br/><b>Psikolog:</b> ".strtoupper($CI->dbx->getpegawai($row->idpsikolog,0,1));
                          echo "</td>";
                         echo "<td align=''>".($CI->p_c->tgl_indo($row->tglmulai))."</td>";
                          echo "<td align=''>".($CI->p_c->tgl_indo($row->tglakhir))."</td>";
											    //echo "<td align=''>".($row->keterangan)."</td>";
                          echo "<td align='center'>".($row->jmlkelas)."</td>";
                          echo "<td align='center'>".($row->jmlcpd)."</td>";
                          echo "<td align='center'>".($row->jmlpd)."</td>";
                          echo "<td align='center'>".($row->jmljadwalbelajar)."</td>";
                          echo "<td align='center'>";
                          echo "<a href=javascript:void(window.open('".site_url('ksw_tahunajaran/ubahaktifdaftar/'.$row->replid.'/'.!($row->aktifdaftar))."')) >".$CI->p_c->cekaktif($row->aktifdaftar)."</a>";
                          //$CI->p_c->cekaktif($row->aktif).
                          echo "</td>";
											    echo "<td align='center'>";
                          echo "<a href=javascript:void(window.open('".site_url('ksw_tahunajaran/ubahaktif/'.$row->replid.'/'.$row->departemen.'/'.!($row->aktif))."')) >".$CI->p_c->cekaktif($row->aktif)."</a>";
                          //$CI->p_c->cekaktif($row->aktif).
                          echo "</td>";
											    echo "<td align='center'>";
                          echo "<a href=javascript:void(window.open('".site_url('ksw_tahunajaran/tambah/'.$row->replid)."')) class='btn btn-xs btn-warning fa fa-check-square' ></a>&nbsp;&nbsp;";
                          if($row->jmlkelas<1){
											      echo "<a href=javascript:void(window.open('".site_url('ksw_tahunajaran/hapus/'.$row->replid)."')) class='btn btn-xs btn-danger fa fa-minus-square' ></a> ";
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
                <label class="control-label" for="minlengthfield">Unit Bisnis</label>
                <div class="control-group">
                    <div class="controls">:
                        <?php
                        $arridcompany="data-rule-required=true id=idcompany ";
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
                $arrdepartemen='data-rule-required=true';
                echo form_dropdown('departemen',$departemen_opt,$isi->departemen,$arrdepartemen);
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
			                		 echo form_input(array('class' => '','style'=>'margin: 0px 0px 5px; width: 687px;', 'id' => 'tahunajaran','name'=>'tahunajaran','value'=>$isi->tahunajaran,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'500', 'data-rule-minlength'=>'1' ,'placeholder'=>'Masukkan 1-100 Karakter'));
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th></tr>
                  <tr>
                    <th align="left">
                    <label class="control-label" for="minlengthfield">Kepala Sekolah</label>
                    <div class="control-group">
                  <div class="controls">:
                    <?php
                      $arridkepsek='data-rule-required=true';
                      echo form_dropdown('idkepsek',$pegawai_opt,$isi->idkepsek,$arridkepsek);
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
                        $arridkonselor='data-rule-required=false';
                        echo form_dropdown('idkonselor',$pegawai_opt,$isi->idkonselor,$arridkonselor);
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
                          $arridpsikolog='data-rule-required=false';
                          echo form_dropdown('idpsikolog',$pegawai_opt,$isi->idpsikolog,$arridpsikolog);
                        ?>
                              <?php //echo  <p id="message"></p> ?>
                      </div>
                        </div>
                        </th></tr>
                  <tr>
      			            <th align="left">
      	                		<label class="control-label" for="minlengthfield">Tgl. Mulai</label>
      	                		<div class="control-group">
      								<div class="controls">:
      			                	<?php
      			                		echo form_input(array('class' => '', 'id' => 'dp1','name'=>'tglmulai','value'=>$CI->p_c->tgl_form($isi->tglmulai),'data-rule-required'=>'false' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'2' ,'placeholder'=>'DD-MM-YYYY','autocomplete'=>'off'));
      			                	?>
      			                	<?php //echo  <p id="message"></p> ?>
      								</div>
      	                		</div>
      			            </th>
      			         </tr>
                     <tr>
         			            <th align="left">
         	                		<label class="control-label" for="minlengthfield">Tgl. Akhir</label>
         	                		<div class="control-group">
         								<div class="controls">:
         			                	<?php
         			                		echo form_input(array('class' => '', 'id' => 'dp2','name'=>'tglakhir','value'=>$CI->p_c->tgl_form($isi->tglakhir),'data-rule-required'=>'false' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'2' ,'placeholder'=>'DD-MM-YYYY','autocomplete'=>'off'));
         			                	?>
         			                	<?php //echo  <p id="message"></p> ?>
         								</div>
         	                		</div>
         			            </th>
         			         </tr>
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
        		        		<label class="control-label" for="minlengthfield">Pendaftaran</label>
        		        		<div class="control-group">
        							<div class="controls">:
        		                	<?php
        		                		echo form_checkbox('aktifdaftar', '1', $isi->aktifdaftar);
        		                	?>
        		                	<?php //echo  <p id="message"></p> ?>
        							</div>
        		        		</div>
        		            </th></tr>
            <!--
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
            -->
				    <tr>
				            <th align="left">
				            	<button class='btn btn-primary' onclick="return validate()">Simpan</button>
				            	<a href="JavaScript:window.close();" class="btn btn-success">Kembali</a>
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
