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
                        <li><a href="javascript:void(window.open('<?php echo site_url('kontrak/tambah'); ?>'))" ><i class="fa fa-plus-square"></i> Tambah</a></li>

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
                           <label class="control-label" for="minlengthfield">Awal Kontrak</label>
                           <div class="control-group">
                     <div class="controls">:
                             <?php
                             echo form_input(array('class' => '', 'id' => 'dp1','name'=>'awal_kontrak1','value'=>$this->input->post('awal_kontrak1'),'data-rule-required'=>'false' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'2' ,'placeholder'=>'DD-MM-YYYY','autocomplete'=>'off'));
                             echo form_input(array('class' => '', 'id' => 'dp2','name'=>'awal_kontrak2','value'=>$this->input->post('awal_kontrak2'),'data-rule-required'=>'false' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'2' ,'placeholder'=>'DD-MM-YYYY','autocomplete'=>'off'));
                             ?>
                             <?php //echo  <p id="message"></p> ?>
                     </div>
                           </div>
                       </th>
                        <th align="left">
                            <label class="control-label" for="minlengthfield">Akhir Kontrak</label>
                            <div class="control-group">
                      <div class="controls">:
                              <?php
                              echo form_input(array('class' => '', 'id' => 'dp3','name'=>'akhir_kontrak1','value'=>$this->input->post('akhir_kontrak1'),'data-rule-required'=>'false' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'2' ,'placeholder'=>'DD-MM-YYYY','autocomplete'=>'off'));
                              echo form_input(array('class' => '', 'id' => 'dp4','name'=>'akhir_kontrak2','value'=>$this->input->post('akhir_kontrak2'),'data-rule-required'=>'false' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'2' ,'placeholder'=>'DD-MM-YYYY','autocomplete'=>'off'));
                              ?>
                              <?php //echo  <p id="message"></p> ?>
                      </div>
                            </div>
                        </th>
                  </tr>
                  <tr>
                    <th align="left">
                        <label class="control-label" for="minlengthfield">Tgl. Pembuatan</label>
                        <div class="control-group">
                  <div class="controls">:
                          <?php
                          echo form_input(array('class' => '', 'id' => 'dp5','name'=>'tanggal_pembuatan1','value'=>$this->input->post('tanggal_pembuatan1'),'data-rule-required'=>'false' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'2' ,'placeholder'=>'DD-MM-YYYY','autocomplete'=>'off'));
                          echo form_input(array('class' => '', 'id' => 'dp5','name'=>'tanggal_pembuatan2','value'=>$this->input->post('tanggal_pembuatan2'),'data-rule-required'=>'false' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'2' ,'placeholder'=>'DD-MM-YYYY','autocomplete'=>'off'));
                          ?>
                          <?php //echo  <p id="message"></p> ?>
                  </div>
                        </div>
                    </th>
                     <th align="left">
                         <label class="control-label" for="minlengthfield">Sisa Kontrak</label>
                         <div class="control-group">
                   <div class="controls">:
                           <?php
                           echo form_input(array('class' => '', 'id' => 'sisakontrak','name'=>'sisakontrak','value'=>$this->input->post('sisakontrak'),'data-rule-required'=>'false' ,'data-rule-maxlength'=>'10', 'data-rule-minlength'=>'1','data-rule-number'=>'true','placeholder'=>'Masukkan 1-10 Karakter'));
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
                                                <th width='50'>No.</th>
                                                <th>No. SK</th>
                                                <th>Pegawai</th>
                                                <th>Tipe Pengangkatan</th>
                                                <th>Jabatan</th>
                                                <th>Awal Kontrak</th>
                                                <th>Akhir Kontrak</th>
                                                <th>Sisa Kontrak (Hari)</th>
                                                <th>AVG Kompetensi</th>
                                                <th>Tgl. Pembuatan</th>
                                                <th>Aktif</th>
                                                <th width="80">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        	<?php
                                        	$CI =& get_instance();$no=1;
											foreach((array)$show_table as $row) {
                        if ($row->aktif){
                          if ($row->sisakontrak<=31){
                            $bg="style='background-color:red;'";
                          }else if($row->sisakontrak<=60){
                            $bg="style='background-color:blue;'";
                          }else{
                            $bg="";
                          }
                        }else{
                          $bg="";
                        }
											    echo "<tr>";
											    echo "<td align='center'>".$no++."</td>";
											    echo "<td align='center'>
											    			<a href=javascript:void(window.open('".site_url('kontrak/view/'.$row->replid)."'))>".$row->no_sk."</a>
											    	  </td>";
											    echo "<td align='center'>".strtoupper($row->idpegawai)."</td>";
											    echo "<td align='center'>".strtoupper($row->idpegawai_tipe_pengangkatan)
											    			."<hr>(".strtoupper($row->idcompany).")"
											    			."</td>";
											     echo "<td align='center'>".strtoupper($row->idjabatan)
											    			."<hr>(".strtoupper($row->iddepartemen).")"
											    			."<hr>(".strtoupper($row->idpegawai_status).")"
											    			."</td>";
											    echo "<td align='center'>".strtoupper($CI->p_c->tgl_indo($row->awal_kontrak))."</td>";
											    echo "<td align='center'>".strtoupper($CI->p_c->tgl_indo($row->akhir_kontrak))."</td>";
                          echo "<td align='center' ".$bg.">".strtoupper($row->sisakontrak)."</td>";
											    echo "<td align='center'>".$row->avg_kompetensi."</td>";
											    echo "<td align='center'>".strtoupper($CI->p_c->tgl_indo($row->tanggal_pembuatan))."</td>";
                          echo "<td align='center'>".$CI->p_c->cekaktif($row->aktif)."</td>";
                          echo "<td align='center'>";
											    echo "<a href=javascript:void(window.open('".site_url('kontrak/ubah/'.$row->replid)."')) class='btn btn-xs btn-warning fa fa-check-square' ></a>&nbsp;&nbsp;";
													echo "<a href=javascript:void(window.open('".site_url('kontrak/hapus/'.$row->replid)."')) class='btn btn-xs btn-danger fa fa-minus-square' ></a>";
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

      $("#idcompanyfilter").change(function(){
          var value=$(this).val();
          $.ajax({
            data:{modul:'idpegawai',id:value},
            success: function(respond){
              $("#idpegawai").html(respond);
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
		    		<!--
		    		<tr>
		            <th align="left">
		        		<label class="control-label" for="minlengthfield">No. SK</label>
		        		<div class="control-group">
							<div class="controls">:
		                	<?php
		                		echo $isi->no_sk;
		                	?>
							</div>
		        		</div>
		            </th></tr>
		            -->
					<tr>
		            <th align="left">
		        		<label class="control-label" for="minlengthfield">Filter Perusahaan</label>
		        		<div class="control-group">
							<div class="controls">:
		                	<?php
		                		$arridcompanyfilter='data-rule-required=true id="idcompanyfilter"';
		                		echo form_dropdown('idcompanyfilter',$idcompanyfilter_opt,$isi->idcompanyfilter,$arridcompanyfilter);
		                	?>
							</div>
		        		</div>
		            </th></tr>
					<tr>
		            <th align="left">
		        		<label class="control-label" for="minlengthfield">Pegawai</label>
		        		<div class="control-group">
							<div class="controls">:
		                	<?php
		                		$arridpegawai='data-rule-required=true  id="idpegawai"';
		                		echo form_dropdown('idpegawai',$idpegawai_opt,$isi->idpegawai,$arridpegawai);
		                	?>
							</div>
		        		</div>
		            </th></tr>
					<tr>
		            <th align="left">
		        		<hr/>
		            </th></tr>

		            <tr>
		            <th align="left">
	                		<label class="control-label" for="minlengthfield">No. SK</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		echo form_input(array('class' => '','style'=>'margin: 0px 0px 5px; width: 687px;', 'id' => 'no_sk','name'=>'no_sk','value'=>$isi->no_sk,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'2' ,'placeholder'=>'Masukkan 2-100 Karakter'));
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th></tr>
		            <tr>
		            <th align="left">
		        		<label class="control-label" for="minlengthfield">Unit Bisnis Kontrak</label>
		        		<div class="control-group">
							<div class="controls">:
		                	<?php
		                		$arrcompany='data-rule-required=true';
		                		echo form_dropdown('idcompany',$idcompany_opt,$isi->idcompany,$arrcompany);
		                	?>
							</div>
		        		</div>
		            </th></tr>
		            
		            <tr>
		            <th align="left">
		        		<label class="control-label" for="minlengthfield">Tipe Pengangkatan</label>
		        		<div class="control-group">
							<div class="controls">:
		                	<?php
		                		$arridpegawai_tipe_pengangkatan='data-rule-required=true';
		                		echo form_dropdown('idpegawai_tipe_pengangkatan',$idpegawai_tipe_pengangkatan_opt,$isi->idpegawai_tipe_pengangkatan,$arridpegawai_tipe_pengangkatan);
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
		                		$arridjabatan='data-rule-required=true';
		                		echo form_dropdown('idjabatan',$idjabatan_opt,$isi->idjabatan,$arridjabatan);
		                	?>
							</div>
		        		</div>
		            </th></tr>
		            <tr>
		            <th align="left">
		        		<label class="control-label" for="minlengthfield">Status Pegawai</label>
		        		<div class="control-group">
							<div class="controls">:
		                	<?php
		                		$arridpegawai_status='data-rule-required=true';
		                		echo form_dropdown('idpegawai_status',$idpegawai_status_opt,$isi->idpegawai_status,$arridpegawai_status);
		                	?>
							</div>
		        		</div>
		            </th></tr>
			         <tr>
			            <th align="left">
	                		<label class="control-label" for="minlengthfield">Awal Kontrak</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		echo form_input(array('class' => '', 'id' => 'dp1','name'=>'awal_kontrak','value'=>$CI->p_c->tgl_form($isi->awal_kontrak),'data-rule-required'=>'true' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'2' ,'placeholder'=>'DD-MM-YYYY','autocomplete'=>'off'));
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th>
			         </tr>
				    <tr>
				            <th align="left">
		                		<label class="control-label" for="minlengthfield">Akhir Kontrak</label>
		                		<div class="control-group">
									<div class="controls" valign="top">:
				                	<?php
			                		echo form_input(array('class' => '', 'id' => 'dp2','name'=>'akhir_kontrak','value'=>$CI->p_c->tgl_form($isi->akhir_kontrak),'data-rule-required'=>'false' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'2' ,'placeholder'=>'DD-MM-YYYY','autocomplete'=>'off'));
			                	?>
				                	<?php //echo  <p id="message"></p> ?>
									</div>
		                		</div>
				            </th></tr>
				    <tr>
			            <th align="left">
	                		<label class="control-label" for="minlengthfield">Jam Masuk</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		echo form_input(array('class' => '', 'id' => 'jam_masuk','name'=>'jam_masuk','value'=>$isi->jam_masuk,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'8', 'data-rule-minlength'=>'8' ,'placeholder'=>'HH:MM'));
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th>
			         </tr>
			         <tr>
			            <th align="left">
	                		<label class="control-label" for="minlengthfield">Jam Keluar</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		echo form_input(array('class' => '', 'id' => 'jam_keluar','name'=>'jam_keluar','value'=>$isi->jam_keluar,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'8', 'data-rule-minlength'=>'8' ,'placeholder'=>'HH:MM'));
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th>
			         </tr>
				    <tr>
			            <th align="left">
	                		<label class="control-label" for="minlengthfield">Tgl. Pembuatan</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		echo form_input(array('class' => '', 'id' => 'dp3','name'=>'tanggal_pembuatan','value'=>$CI->p_c->tgl_form($isi->tanggal_pembuatan),'data-rule-required'=>'true' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'2' ,'placeholder'=>'DD-MM-YYYY','autocomplete'=>'off'));
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th>
			         </tr>
			         <tr>
				            <th align="left">
		                		<label class="control-label" for="minlengthfield">Menimbang</label>
		                		<div class="control-group">
									<div class="controls" valign="top">&nbsp;&nbsp;
				                	<?php
				                		echo form_textarea(array('class' => '','style'=>'margin: 0px 0px 5px; width: 687px; height: 221px', 'id' => 'menimbang','name'=>'menimbang','value'=>$isi->menimbang,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'500', 'data-rule-minlength'=>'2' ,'placeholder'=>'Masukkan 2-500 Karakter'));
				                	?>
				                	<?php //echo  <p id="message"></p> ?>
									</div>
		                		</div>
				            </th></tr>
				     <tr>
				            <th align="left">
		                		<label class="control-label" for="minlengthfield">Mengingat</label>
		                		<div class="control-group">
									<div class="controls" valign="top">&nbsp;&nbsp;
				                	<?php
				                		echo form_textarea(array('class' => '','style'=>'margin: 0px 0px 5px; width: 687px; height: 221px', 'id' => 'mengingat','name'=>'mengingat','value'=>$isi->mengingat,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'500', 'data-rule-minlength'=>'2' ,'placeholder'=>'Masukkan 2-500 Karakter'));
				                	?>
				                	<?php //echo  <p id="message"></p> ?>
									</div>
		                		</div>
				            </th></tr>
				     <tr>
				            <th align="left">
		                		<label class="control-label" for="minlengthfield">Memperhatikan</label>
		                		<div class="control-group">
									<div class="controls" valign="top">&nbsp;&nbsp;
				                	<?php
				                		echo form_textarea(array('class' => '','style'=>'margin: 0px 0px 5px; width: 687px; height: 221px', 'id' => 'memperhatikan','name'=>'memperhatikan','value'=>$isi->memperhatikan,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'500', 'data-rule-minlength'=>'2' ,'placeholder'=>'Masukkan 2-500 Karakter'));
				                	?>
				                	<?php //echo  <p id="message"></p> ?>
									</div>
		                		</div>
				            </th></tr>
				     <!--
				     <tr>
				            <th align="left">
		                		<label class="control-label" for="minlengthfield">Memutuskan</label>
		                		<div class="control-group">
									<div class="controls" valign="top">&nbsp;&nbsp;
				                	<?php
				                		echo form_textarea(array('class' => '','style'=>'margin: 0px 0px 5px; width: 687px; height: 221px', 'id' => 'memutuskan','name'=>'memutuskan','value'=>$isi->memutuskan,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'500', 'data-rule-minlength'=>'2' ,'placeholder'=>'Masukkan 2-500 Karakter'));
				                	?>
				                	<?php //echo  <p id="message"></p> ?>
									</div>
		                		</div>
				            </th></tr>
				    -->
				    <tr>
				            <th align="left">
		                		<label class="control-label" for="minlengthfield">Keterangan</label>
		                		<div class="control-group">
									<div class="controls" valign="top">&nbsp;&nbsp;
				                	<?php
				                		echo form_textarea(array('class' => '','style'=>'margin: 0px 0px 5px; width: 687px; height: 221px', 'id' => 'keterangan','name'=>'keterangan','value'=>$isi->keterangan,'data-rule-required'=>'false' ,'data-rule-maxlength'=>'500', 'data-rule-minlength'=>'2' ,'placeholder'=>'Masukkan 2-500 Karakter'));
				                	?>
				                	<?php //echo  <p id="message"></p> ?>
									</div>
		                		</div>
				            </th></tr>
				    <tr>
				            <th align="left">
				            	<button class='btn btn-primary' onclick="return validate()">Simpan</button>
				            	<a href="javascript:void(window.open('<?php echo site_url('kontrak') ?>'))" class="btn btn-success">Batal</a>
				            </th>
				    </tr>
		            </table>
		        	<?php
		        	echo form_close();
		        	?>
	    </section>
<!------------------------------------------------------------------------------------------------------------------------------------->
<?php } elseif($view=='view'){ ?>
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
	                		<label class="control-label" for="minlengthfield">No. SK</label>
	                		<div class="control-group">
								<div class="controls">:
								<?php echo strtoupper($isi->no_sk);?>
								</div>
	                		</div>
			            </th></tr>
			        <tr>
		            <tr>
		            <th align="left">
		        		<label class="control-label" for="minlengthfield">Unit Bisnis Kontrak</label>
		        		<div class="control-group">
							<div class="controls">:
							<?php echo strtoupper($isi->idcompany);?>
							</div>
		        		</div>
		            </th></tr>

		            <tr>
		            <th align="left">
		        		<label class="control-label" for="minlengthfield">NIK</label>
		        		<div class="control-group">
							<div class="controls">:
							<a href="javascript:void(window.open('<?php echo site_url('general/datapegawai/'.$isi->replidkaryawan) ?> '))"><?php echo strtoupper($isi->nip);?></a>
							</div>
		        		</div>
		            </th></tr>

		            <tr>
		            <th align="left">
		        		<label class="control-label" for="minlengthfield">Pegawai</label>
		        		<div class="control-group">
							<div class="controls">:
							<a href="javascript:void(window.open('<?php echo site_url('general/datapegawai/'.$isi->replidkaryawan) ?> '))"><?php echo strtoupper($isi->idpegawaitext);?></a>
							</div>
		        		</div>
		            </th></tr>
		            <tr>
		            <th align="left">
		        		<label class="control-label" for="minlengthfield">Tipe Pengangkatan</label>
		        		<div class="control-group">
							<div class="controls">:
							<?php echo strtoupper($isi->idpegawai_tipe_pengangkatan);?>
							</div>
		        		</div>
		            </th></tr>
		            <tr>
		            <th align="left">
		        		<label class="control-label" for="minlengthfield">Jabatan</label>
		        		<div class="control-group">
							<div class="controls">:
							<?php echo strtoupper($isi->idjabatan_text);?>
							</div>
		        		</div>
		            </th></tr>
		            <tr>
		            <th align="left">
		        		<label class="control-label" for="minlengthfield">Status Pegawai</label>
		        		<div class="control-group">
							<div class="controls">:
							<?php echo strtoupper($isi->idpegawai_status);?>
							</div>
		        		</div>
		            </th></tr>
			         <tr>
			            <th align="left">
	                		<label class="control-label" for="minlengthfield">Awal Kontrak</label>
	                		<div class="control-group">
								<div class="controls">:
								<?php echo strtoupper($CI->p_c->tgl_indo($isi->awal_kontrak));?>
								</div>
	                		</div>
			            </th>
			         </tr>
				    <tr>
				            <th align="left">
		                		<label class="control-label" for="minlengthfield">Akhir Kontrak</label>
		                		<div class="control-group">
									<div class="controls" valign="top">:
									<?php echo strtoupper($CI->p_c->tgl_indo($isi->akhir_kontrak));?>
									</div>
		                		</div>
				            </th></tr>
				    <tr>
			            <th align="left">
	                		<label class="control-label" for="minlengthfield">Jam Masuk</label>
	                		<div class="control-group">
								<div class="controls">:
								<?php echo strtoupper($isi->jam_masuk);?>
								</div>
	                		</div>
			            </th>
			         </tr>
			         <tr>
			            <th align="left">
	                		<label class="control-label" for="minlengthfield">Jam Keluar</label>
	                		<div class="control-group">
								<div class="controls">:
								<?php echo strtoupper($isi->jam_keluar);?>
								</div>
	                		</div>
			            </th>
			         </tr>
				    <tr>
			            <th align="left">
	                		<label class="control-label" for="minlengthfield">Tgl. Pembuatan</label>
	                		<div class="control-group">
								<div class="controls">:
								<?php echo strtoupper($CI->p_c->tgl_indo($isi->tanggal_pembuatan));?>
								</div>
	                		</div>
			            </th>
			         </tr>
			         <tr>
				            <th align="left">
		                		<label class="control-label" for="minlengthfield">Menimbang</label>
		                		<div class="control-group">
									<div class="controls" valign="top">&nbsp;&nbsp;
									<?php echo strtoupper($isi->menimbang);?>
									</div>
		                		</div>
				            </th></tr>
				     <tr>
				            <th align="left">
		                		<label class="control-label" for="minlengthfield">Mengingat</label>
		                		<div class="control-group">
									<div class="controls" valign="top">&nbsp;&nbsp;
									<?php echo strtoupper($isi->mengingat);?>
									</div>
		                		</div>
				            </th></tr>
				     <tr>
				            <th align="left">
		                		<label class="control-label" for="minlengthfield">Memperhatikan</label>
		                		<div class="control-group">
									<div class="controls" valign="top">&nbsp;&nbsp;
									<?php echo strtoupper($isi->memperhatikan);?>
									</div>
		                		</div>
				            </th></tr>
				     <!--
				     <tr>
				            <th align="left">
		                		<label class="control-label" for="minlengthfield">Memutuskan</label>
		                		<div class="control-group">
									<div class="controls" valign="top">&nbsp;&nbsp;
									<?php echo strtoupper($isi->memutuskan);?>
									</div>
		                		</div>
				            </th></tr>
				    -->
				    <tr>
				            <th align="left">
		                		<label class="control-label" for="minlengthfield">Keterangan</label>
		                		<div class="control-group">
									<div class="controls" valign="top">&nbsp;&nbsp;
									<?php echo strtoupper($isi->keterangan);?>
									</div>
		                		</div>
				            </th></tr>
					     <th>
						     <hr/>
					     </th>
				     </tr>
				     <tr>
				     	<th align="left">Kompetensi :
				     	</th>
				     </tr>
				     <tr>
				     	<td>
					     	<table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th width="50">No.</th>
                                        <th>Kompetensi</th>
                                        <th width="100">Max. Skor</th>
                                        <th width="100">Skor</th>
                                        <?php if ($view2<>1){ ?>
                                        <th width="80">Aksi</th>
                                        <?php } ?>
                                    </tr>
                                </thead>
                                <tbody>
                                	<?php
                                	$CI =& get_instance();$skor=0;$avg=0;
                                	$no=1;
									foreach((array)$kompetensi as $row) {
										$skor=$skor+$row->skor;
									    echo "<tr align='left'>";
									    echo "<td align='center'>".$no++."</td>";
									    echo "<td>".strtoupper($row->idkompetensi)."</td>";
									    echo "<td align='center'>".$row->max_skor."</td>";
									    echo "<td align='center'><b>".$row->skor."</b></td>";
									    if ($view2<>1){
									    echo "<td align='center'>";
									    echo "
									    		<a href=javascript:void(window.open('".site_url('kontrak/tambahkompetensi/'.$isi->replid.'/'.$row->replid)."')) class='btn btn-xs btn-warning'>
									    			Ubah
									    		</a>";
									    echo "</td>";
									    }
									    echo "</tr>";
									}
									if ($skor<>0){$avg=$skor/($no-1);}
									?>
									<tr>
										<td colspan="3">&nbsp;</td>
										<td align="center"><b><?php echo round($avg,2); ?></b></td>
										<?php if ($view2<>1){ ?>
										<td>&nbsp;</td>
										<?php } ?>
									</tr>
                                </tbody>
                                <tfoot>
                                </tfoot>
                            </table>
				     	</td>
				     <tr>
					     <th>
						     <hr/>
					     </th>
				     </tr>
				    <tr>
				            <th align="left">
				            	<input type="hidden" name="idjabatan" value="<?php echo $isi->idjabatan ?>">
				            	<input type="hidden" name="avg_kompetensi" value="<?php echo $avg ?>">
				            	<input type="hidden" name="idpegawai" value="<?php echo $isi->idpegawai ?>">
				            	<?php
				            	if ($view2<>1){
					            	echo "<button class='btn btn-primary'>Simpan</button>&nbsp;&nbsp;";
					            }else{
						         	echo "<a href=javascript:void(window.open('".site_url('kontrak/ubah/'.$isi->replid)."')) class='btn btn-xs btn-warning'>&nbsp;&nbsp;Ubah&nbsp;&nbsp;</a> ";
					            }
				            	echo "<a href=javascript:void(window.open('".site_url('kontrak')."')) class='btn btn-success'>Kembali</a>";
				            	?>
				            </th>
				    </tr>
				    </table>
		        	<?php
		        	echo form_close();
		        	?>
	    </section>
<!-------------------------------------------------------------------------------------------------------------------------------------->
<?php } elseif($view=='tambahkompetensi'){ ?>
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
	                		<label class="control-label" for="minlengthfield">Kompetensi</label>
	                		<div class="control-group">
								<div class="controls">:
								<?php echo strtoupper($isi->idkompetensi);?>
								</div>
	                		</div>
			            </th></tr>
		            <tr>
		            <tr>
		            <th align="left">
	                		<label class="control-label" for="minlengthfield">Max. Skor</label>
	                		<div class="control-group">
								<div class="controls">:
								<?php echo strtoupper($isi->max_skor);?>
								</div>
	                		</div>
			            </th></tr>
		            <th align="left">
	                		<label class="control-label" for="minlengthfield">Skor</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		echo form_input(array('class' => '', 'id' => 'skor','name'=>'skor','value'=>$isi->skor,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'10', 'data-rule-minlength'=>'1','data-rule-number'=>'true','placeholder'=>'Masukkan 1-10 Karakter'));
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th></tr>
			            <tr>
				            <th align="left">
				            	<button class='btn btn-primary' onclick="return validate()">Simpan</button>
				            	<a href="javascript:void(window.open('<?php echo site_url('kontrak') ?>'))" class="btn btn-success">Batal</a>
				            </th>
				    </tr>
		            </table>
		        	<?php
		        	echo form_close();
		        	?>
	    </section>
<!------------------------------------------------------------------------------------------------------------------------------------->
<?php } ?>
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
    </body>
</html>
