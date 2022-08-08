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
                        <li><a href="javascript:void(window.open('<?php echo site_url('hrm_recruitement/tambah'); ?>'))" ><i class="fa fa-plus-square"></i> Tambah</a></li>

                    </ol>
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
                                                echo "<th width='150'>Perusahaan</th>";
                                                echo "<th width='150'>Jabatan</th>";
                                                echo "<th width='*'>Tipe Pekerjaan</th>";
                                                echo "<th width='*'>Level</th>";
                                                //echo "<th width='200'>Keterangan</th>";
                                                echo "<th width='300'>Kualifikasi</th>";
                                                echo "<th>Tanggal Dibuat</th>";
                                                //echo "<th>Tanggal Diubah</th>";
                                                echo "<th>Jumlah Pelamar</th>";
                                                echo "<th>Aktif</th>";
                                                echo "<th>Rilis</th>";
                                                echo "<th width='80'>Aksi</th>";
                                                ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        	<?php
                                        	$CI =& get_instance();
                                        	$no=1;
											foreach((array)$show_table as $row) {
											    echo "<tr>";
                          echo "<td align='center'>".$no++."</td>";
                          echo "<td align='left'>".$row->companytext."</td>";
                          echo "<td align='left'>".$row->jabatantext."</td>";
                          echo "<td align='left'>".$row->tipepekerjaantext."</td>";
                          echo "<td align='center'>".$row->leveltext."</td>";
                          //echo "<td align='center'>".$row->keterangan."</td>";
											    echo "<td align='left'>".$row->isi."</td>";
											    echo "<td align='center'>".strtoupper($CI->p_c->tgl_indo($row->created_date))."</td>";
											    //echo "<td align='center'>".strtoupper($CI->p_c->tgl_indo($row->modified_date))."</td>";
                          echo "<td align='center'>".$row->pakai."</td>";
											    echo "<td align='center'>".$CI->p_c->cekaktif($row->aktif)."</td>";
                          echo "<td align='center'>".$CI->p_c->cekaktif($row->publish)."</td>";
											    echo "<td align='center'>";
                          echo "<a href=javascript:void(window.open('".site_url('hrm_recruitement/view/'.$row->replid)."')) class='btn btn-xs btn-info fa fa-circle-o' ></a>&nbsp;&nbsp;";
                          if($row->publish<>1){
                            echo "<a href=javascript:void(window.open('".site_url('hrm_recruitement/ubah/'.$row->replid)."')) class='btn btn-xs btn-warning fa fa-check-square' ></a>&nbsp;&nbsp;";
                            echo "<a href=javascript:void(window.open('".site_url('hrm_recruitement/hapus/'.$row->replid)."')) class='btn btn-xs btn-danger fa fa-minus-square' ></a>";
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
<?php } elseif($view=='tambah'){ ?>
		    <section class="content-header table-responsive">
	            <h1>
	                <?php echo $form ?>
	                <small><?php echo $form_small ?></small>
	            </h1>
            </section>
            <section class="content">
		        <?php
			        $attributes = array('class' => 'form-horizontal form-validate', 'id' => 'form', 'method' => 'POST');
		    	echo form_open($action,$attributes);
		    	?>
		    	<table width="100%" border="0">
            <tr>
              <th align="left">
                <label class="control-label" for="minlengthfield">Perusahaan</label>
                <div class="control-group">
                    <div class="controls">:
                      <?php
                        $arridcompany="id='idcompany' data-rule-required='true' ";
                        echo form_dropdown('idcompany',$idcompany_opt,$isi->idcompany,$arridcompany);
                      ?>
                            <?php //echo  <p id="message"></p> ?>
                    </div>
                </div>
              </th>
            </tr>
            <tr>
              <th align="left">
                <label class="control-label" for="minlengthfield">Jabatan</label>
                <div class="control-group">
                    <div class="controls">:
                      <?php
                        $arridjabatan="id='idjabatan' data-rule-required='true' ";
                        echo form_dropdown('idjabatan',$idjabatan_opt,$isi->idjabatan,$arridjabatan);
                      ?>
                            <?php //echo  <p id="message"></p> ?>
                    </div>
                </div>
              </th>
            </tr>
            <tr>
              <th align="left">
                <label class="control-label" for="minlengthfield">Tipe Pekerjaan</label>
                <div class="control-group">
                    <div class="controls">:
                      <?php
                        $arridtipepekerjaan="id='idtipepekerjaan' data-rule-required='true' ";
                        echo form_dropdown('idtipepekerjaan',$idtipepekerjaan_opt,$isi->idtipepekerjaan,$arridtipepekerjaan);
                      ?>
                            <?php //echo  <p id="message"></p> ?>
                    </div>
                </div>
              </th>
            </tr>
            <tr>
              <th align="left">
                <label class="control-label" for="minlengthfield">Level</label>
                <div class="control-group">
                    <div class="controls">:
                      <?php
                        $arridlevel="id='idlevel' data-rule-required='true' ";
                        echo form_dropdown('idlevel',$idlevel_opt,$isi->idlevel,$arridlevel);
                      ?>
                            <?php //echo  <p id="message"></p> ?>
                    </div>
                </div>
              </th>
            </tr>
            <!--
		    		<tr>
		            <th align="left">
	                		<label class="control-label" for="minlengthfield">Keterangan</label>
	                		<div class="control-group">
        								<div class="controls">:
                                  <textarea id="keterangan" name="keterangan" rows="3" style="width:300px"; data-rule-required="false" data-rule-maxlength="300"><?php echo $isi->keterangan?></textarea>
        			                	<?php //echo  <p id="message"></p> ?>
        								</div>
	                		</div>
			            </th></tr>
			        -->
			        <tr>
			            <th align="left">
	                		<label class="control-label" for="minlengthfield">Kualifikasi</label>
	                		<div class="control-group">
								<div class="controls">:
			                	</div>
			            </th>
			        </tr>
			        <tr>
			        	<th>
                            <div class='box-body pad'>
                                    <textarea id="editor1" name="isi" rows="10" cols="80" data-rule-required="true">
                                        <?php echo $isi->isi?>
                                    </textarea>
                                    <script type="text/javascript">CKEDITOR.replace('editor1');</script>
                            </div>
                            <?php //echo  <p id="message"></p> ?>
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
				            	<button class="btn btn-primary">Simpan</button>
				            	<a href="javascript:void(window.open('<?php echo site_url('hrm_recruitement') ?>'))" class="btn btn-success">Batal</a>
				            </th>
				    </tr>
		            </table>
		        	<?php
		        	echo form_close();
		        	?>
	    </section>
<?php } elseif($view=='view'){ ?>
			<section class="content-header table-responsive">
	            <h1>
	                <?php echo $form ?>
	                <small><?php echo $form_small ?></small>
	            </h1>
            </section>
            <section class="content">
			  <div class='form-horizontal form-validate'>
	    	<table width="100%" border="0">
          <tr>
	            <th align="left">
	        		<label class="control-label" for="minlengthfield">Perusahaan</label>
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
	        		<label class="control-label" for="minlengthfield">Jabatan</label>
	        		<div class="control-group">
						<div class="controls">:
	                	<?php
	                		echo $isi->jabatantext;
	                	?>
						</div>
	        		</div>
	            </th></tr>
          <tr>
	            <th align="left">
	        		<label class="control-label" for="minlengthfield">Tipe Pekerjaan</label>
	        		<div class="control-group">
						<div class="controls">:
	                	<?php
	                		echo $isi->tipepekerjaantext;
	                	?>
						</div>
	        		</div>
	            </th></tr>
              <tr>
    	            <th align="left">
    	        		<label class="control-label" for="minlengthfield">Level</label>
    	        		<div class="control-group">
    						<div class="controls">:
    	                	<?php
    	                		echo $isi->leveltext;
    	                	?>
    						</div>
    	        		</div>
    	            </th></tr>
          <!--
	    		<tr>
	            <th align="left">
	        		<label class="control-label" for="minlengthfield">Keterangan</label>
	        		<div class="control-group">
						<div class="controls">:
	                	<?php
	                		echo $isi->keterangan;
	                	?>
						</div>
	        		</div>
	            </th></tr>
            -->
            <tr>
  	            <th align="left">
  	        		<label class="control-label" for="minlengthfield">Kualifikasi</label>
  	        		<div class="control-group">
  						<div class="controls">:
  						</div>
  	        		</div>
  	            </th></tr>
                <tr>
      	            <td align="left">
      	        		      	<?php
      	                		echo $isi->isi;
      	                	?>
      						  </td></tr>

                  <tr>
      	            <th align="left">
        	        		<label class="control-label" for="minlengthfield">Aktif</label>
        	        		<div class="control-group">
              						<div class="controls">:
              	                	<?php
              	                		echo $CI->p_c->cekaktif($isi->aktif);
              	                	?>
              						</div>
        	        		</div>
                  </th>
                </tr>
                <tr>
                  <th align="left">
                    <label class="control-label" for="minlengthfield">Rilis</label>
                    <div class="control-group">
                        <div class="controls">:
                                <?php
                                  echo $CI->p_c->cekaktif($isi->publish);
                                ?>
                        </div>
                    </div>
                </th>
              </tr>
              </table>
              <?php
              if ($isi->publish){
              ?>
              <hr />
              <div class="box-body table-responsive">
                  <table id="example1" class="table table-bordered table-striped">
                      <thead>
                          <tr>
                              <th width="50">No.</th>
                              <th>No.KTP</th>
                              <th>Nama</th>
                              <th>Jenis Kelamin</th>
                              <th>Umur</th>
                              <th>Domisili</th>
                              <th>Harapan Gaji</th>
                              <th>Siap Bergabung</th>
                              <th>Status</th>
                              <?php 
                                if($isi->aktif>0){
                                  echo "<th width='130'>Aksi</th>";
                                }
                                 
                              ?>
                              
                          </tr>
                      </thead>
                      <tbody>
                        <?php
                        $CI =& get_instance();
                        $no=1;
                        //echo var_dump($calonpegawai);die;
                        foreach((array)$calonpegawai as $rowcp) {
                            echo "<tr>";
                            echo "<td align='center'>".$no++."</td>";
                            echo "<td align='center'>
                                  <a href=javascript:void(window.open('".site_url('hrm_recruitement_data/view/'.$rowcp->idpegawai)."'))>".$rowcp->noktp."</a>
                                </td>";
                            echo "<td align='center'>".strtoupper($rowcp->nama)."</td>";
                            echo "<td align='center'>".$CI->p_c->cekaktif($rowcp->kelamin)."</td>";
                            echo "<td align='center'>".($rowcp->umur)."</td>";
                            echo "<td align='left'>".($rowcp->alamat_tinggal.' '.$rowcp->kecamatan.'<br/>'.$rowcp->kota.' - '.$rowcp->provinsi.' '.$rowcp->kode_pos.' ')."</td>";
                            echo "<td align='center'>".$CI->p_c->rupiah($rowcp->harapangaji)."</td>";
                            echo "<td align='center'>".strtoupper($CI->p_c->tgl_indo($rowcp->tglgabung))."</td>";
                            echo "<td align='center'>".($rowcp->statustext)."</td>";
                            if($isi->aktif>0){
                            echo "<td align='center'>";
                            if(($rowcp->status<>'0')){
                              if($rowcp->status<'7'){
                                echo "<a href=javascript:void(window.open('".site_url('hrm_recruitement/ubahstatuspeserta/'.($rowcp->status+1).'/'.$rowcp->replid)."')) class='btn btn-success' >Lanjut</a>&nbsp;&nbsp;";
                                echo "<a href=javascript:void(window.open('".site_url('hrm_recruitement/ubahstatuspeserta/0/'.$rowcp->replid)."')) class='btn btn-danger'  >Tolak</a>";
                              }
                            }
                            echo "</td>";
                            }
                            echo "</tr>";
                        }
                        ?>

                      </tbody>
                      <tfoot>
                      </tfoot>
                  </table>
                <?php } ?>
              </div><!-- /.box-body -->
              <table>
	            <tr>
		            <td align="left">
                  <?php
                  if(!$isi->publish){
                      echo "<a href=javascript:void(window.open('".site_url('hrm_recruitement/publish/'.$isi->replid)."')) class='btn btn-primary'>Rilis</a>&nbsp;";
                      echo "<a href=javascript:void(window.open('".site_url('hrm_recruitement/ubah/'.$isi->replid)."')) class='btn btn-warning'>Ubah</a>&nbsp;";
    		            	echo "<a href=javascript:void(window.open('".site_url('hrm_recruitement/hapus/'.$isi->aktif)."')) class='btn btn-danger'>Hapus</a>&nbsp;";
                  }
                  ?>
                <a href="javascript:void(window.open('<?php echo site_url("hrm_recruitement") ?>'))" class="btn btn-success">Kembali</a>
                </td>
	            </tr>
	            </table>
            </section>
	        	<?php
 } ?>
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
    </body>
</html>
