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
                        <li><a href="javascript:void(window.open('<?php echo site_url('pegawai_exit/tambah'); ?>'))" ><i class="fa fa-plus-square"></i> Tambah</a></li>

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
                           <label class="control-label" for="minlengthfield">Tgl. Keluar</label>
                           <div class="control-group">
                     <div class="controls">:
                             <?php
                             echo form_input(array('class' => '', 'id' => 'dp1','name'=>'tanggal_keluar1','value'=>$this->input->post('tanggal_keluar1'),'data-rule-required'=>'false' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'2' ,'placeholder'=>'DD-MM-YYYY','autocomplete'=>'off'));
                             echo form_input(array('class' => '', 'id' => 'dp2','name'=>'tanggal_keluar2','value'=>$this->input->post('tanggal_keluar2'),'data-rule-required'=>'false' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'2' ,'placeholder'=>'DD-MM-YYYY','autocomplete'=>'off'));
                             ?>
                             <?php //echo  <p id="message"></p> ?>
                     </div>
                           </div>
                       </th>
                        <th align="left">

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
                                              echo "<th>NIK</th>";
                                              echo "<th>Pegawai</th>";
                                              echo "<th>Jabatan Terakhir</th>";
                                              //echo "<th>No. SK</th>";
                                              echo "<th>Alasan Resign</th>";
                                              echo "<th>Keterangan</th>";
                                              echo "<th>Tgl. Keluar</th>";
                                              //echo "<th>Tgl. Surat</th>";
                                              //echo "<th>Surat Keterangan</th>";
                                              echo "<th>Status</th>";
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
                              echo "<td align='center'>
   											    			<a href=javascript:void(window.open('".site_url('general/datapegawai/'.$row->idpegawai)."'))>".$row->nip."</a>
   											    		</td>";
											    echo "<td align='center'>".$CI->dbx->getpegawai($row->idpegawai)."</td>";
                          echo "<td align='center'>".strtoupper($row->jabatantext)."</td>";
                          //echo "<td align='center'><b>".$row->no_sk."</b></td>";
                          echo "<td align='center'>".strtoupper($row->alasantext)."</td>";
                          echo "<td align='center'>".$row->keterangan."</td>";
                          echo "<td align='center'>".strtoupper($CI->p_c->tgl_indo($row->tanggal_keluar))."</td>";
                          //echo "<td align='center'>".strtoupper($CI->p_c->tgl_indo($row->tanggal_surat))."</td>";
                          //echo "<td align='center'>".($CI->p_c->cekaktif($row->suratketerangan))."</td>";
                          echo "<td align='center'><b>".strtoupper($row->statustext)."</b></td>";
                          echo "<td align='center'>";
                          echo "<a href=javascript:void(window.open('".site_url('pegawai_exit/view/'.$row->replid)."')) class='btn btn-xs btn-info fa fa-circle-o' ></a>&nbsp;&nbsp;";
                          if($row->status=="1"){
                            echo "<a href=javascript:void(window.open('".site_url('pegawai_exit/tambah/'.$row->replid)."')) class='btn btn-xs btn-warning fa fa-check-square' ></a>&nbsp;&nbsp;";
  											    echo "<a href=javascript:void(window.open('".site_url('pegawai_exit/hapus/'.$row->replid)."')) class='btn btn-xs btn-danger fa fa-minus-square' ></a>";
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
<?php } elseif($view=='pegawai_exit_letter'){ ?>
          <section class="content-header table-responsive">
              <h1>
                  <?php echo $form ?>
                  <small>List Data</small>
              </h1>
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
                     <label class="control-label" for="minlengthfield">Tgl. Keluar</label>
                     <div class="control-group">
               <div class="controls">:
                       <?php
                       echo form_input(array('class' => '', 'id' => 'dp1','name'=>'tanggal_keluar1','value'=>$this->input->post('tanggal_keluar1'),'data-rule-required'=>'false' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'2' ,'placeholder'=>'DD-MM-YYYY','autocomplete'=>'off'));
                       echo form_input(array('class' => '', 'id' => 'dp2','name'=>'tanggal_keluar2','value'=>$this->input->post('tanggal_keluar2'),'data-rule-required'=>'false' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'2' ,'placeholder'=>'DD-MM-YYYY','autocomplete'=>'off'));
                       ?>
                       <?php //echo  <p id="message"></p> ?>
               </div>
                     </div>
                 </th>
                  <th align="left">

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
                                        echo "<th>NIK</th>";
                                        echo "<th>Pegawai</th>";
                                        echo "<th>Jabatan Terakhir</th>";
                                        //echo "<th>No. SK</th>";
                                        echo "<th>Alasan Resign</th>";
                                        echo "<th>Keterangan</th>";
                                        echo "<th>Tgl. Keluar</th>";
                                        //echo "<th>Tgl. Surat</th>";
                                        //echo "<th>Surat Keterangan</th>";
                                        echo "<th>Status</th>";
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
                        echo "<td align='center'>
										    			<a href=javascript:void(window.open('".site_url('general/datapegawai/'.$row->idpegawai)."'))>".$row->nip."</a>
										    		</td>";
								    echo "<td align='center'>".$CI->dbx->getpegawai($row->idpegawai)."</td>";
                    echo "<td align='center'>".strtoupper($row->jabatantext)."</td>";
                    //echo "<td align='center'><b>".$row->no_sk."</b></td>";
                    echo "<td align='center'>".strtoupper($row->alasantext)."</td>";
                    echo "<td align='center'>".$row->keterangan."</td>";
                    echo "<td align='center'>".strtoupper($CI->p_c->tgl_indo($row->tanggal_keluar))."</td>";
                    //echo "<td align='center'>".strtoupper($CI->p_c->tgl_indo($row->tanggal_surat))."</td>";
                    //echo "<td align='center'>".($CI->p_c->cekaktif($row->suratketerangan))."</td>";
                    echo "<td align='center'><b>".strtoupper($row->statustext)."</b></td>";
                    echo "<td align='center'>";
                    echo "<a href=javascript:void(window.open('".site_url('pegawai_exit_letter/view/'.$row->replid)."')) class='btn btn-xs btn-info fa fa-circle-o' ></a>&nbsp;&nbsp;";
                    if($row->status<>"4"){
                      echo "<a href=javascript:void(window.open('".site_url('pegawai_exit_letter/tambahletter/'.$row->replid)."')) class='btn btn-xs btn-warning fa fa-check-square' ></a>&nbsp;&nbsp;";
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
<?php } elseif($view=='pegawai_exit_report'){ ?>
          <section class="content-header table-responsive">
              <h1>
                  <?php echo $form ?>
                  <small>List Data</small>
              </h1>
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
                     <label class="control-label" for="minlengthfield">Tgl. Keluar</label>
                     <div class="control-group">
               <div class="controls">:
                       <?php
                       echo form_input(array('class' => '', 'id' => 'dp1','name'=>'tanggal_keluar1','value'=>$this->input->post('tanggal_keluar1'),'data-rule-required'=>'false' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'2' ,'placeholder'=>'DD-MM-YYYY','autocomplete'=>'off'));
                       echo form_input(array('class' => '', 'id' => 'dp2','name'=>'tanggal_keluar2','value'=>$this->input->post('tanggal_keluar2'),'data-rule-required'=>'false' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'2' ,'placeholder'=>'DD-MM-YYYY','autocomplete'=>'off'));
                       ?>
                       <?php //echo  <p id="message"></p> ?>
               </div>
                     </div>
                 </th>
                  <th align="left">

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
                                        echo "<th>NIK</th>";
                                        echo "<th>Pegawai</th>";
                                        echo "<th>Jabatan Terakhir</th>";
                                        echo "<th>No. SK</th>";
                                        echo "<th>Alasan Resign</th>";
                                        echo "<th>Keterangan</th>";
                                        echo "<th>Tgl. Mulai Bekerja</th>";
                                        echo "<th>Tgl. Keluar</th>";
                                        echo "<th>Tgl. Surat</th>";
                                        //echo "<th>Surat Keterangan</th>";
                                        echo "<th>Status</th>";
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
                    //echo "<a href=javascript:void(window.open('".site_url('general/datapegawai/'.$row->idpegawai)."'))>".$row->nip."</a>";
                    echo $row->nip;
                    echo "</td>";
								    echo "<td align='center'>".$CI->dbx->getpegawai($row->idpegawai)."</td>";
                    echo "<td align='center'>".strtoupper($row->jabatantext)."</td>";
                    echo "<td align='center'><b>".$row->no_sk."</b></td>";
                    echo "<td align='center'>".strtoupper($row->alasantext)."</td>";
                    echo "<td align='center'>".$row->keterangan."</td>";
                    echo "<td align='center'>".strtoupper($CI->p_c->tgl_indo($row->tanggal_bekerja))."</td>";
                    echo "<td align='center'>".strtoupper($CI->p_c->tgl_indo($row->tanggal_keluar))."</td>";
                    echo "<td align='center'>".strtoupper($CI->p_c->tgl_indo($row->tanggal_surat))."</td>";
                    //echo "<td align='center'>".($CI->p_c->cekaktif($row->suratketerangan))."</td>";
                    echo "<td align='center'><b>".strtoupper($row->statustext)."</b></td>";
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
<script type="text/javascript">
  $(function(){
    $("#idalasan").change(function(){
        var value=$(this).val();
        if (value=='lain'){
      		document.getElementById("idalasan_lainnya").style.visibility ='visible';
          document.getElementById("idalasan_lainnya").setAttribute('data-rule-required','true');
          document.getElementById("idalasan_lainnya").setAttribute('data-rule-minlength','2');
      	}else{
      		document.getElementById("idalasan_lainnya").style.visibility ='hidden';
          document.getElementById("idalasan_lainnya").setAttribute('data-rule-required','false');
          document.getElementById("idalasan_lainnya").setAttribute('data-rule-minlength','0');
      	}
    });
  });

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
          <?php
                      if($isi->replid<>""){ ?>
              
		            <tr>
		            <th align="left">
		        		<label class="control-label" for="minlengthfield">Pegawai</label>
		        		<div class="control-group">
							<div class="controls">:
		                	<?php
                      echo $isi->pegawaitext;
		                	?>
							</div>
		        		</div>
		            </th></tr>
                <?php }else{ ?>
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
                        $arridpegawai='data-rule-required=true style="width:300px;" id="idpegawai"';
		                		echo form_dropdown('idpegawai',$idpegawai_opt,$isi->idpegawai,$arridpegawai);
		                	?>
							</div>
		        		</div>
		            </th></tr>
                <?php } ?>
                <tr>
    		            <th align="left">
        		        		<label class="control-label" for="minlengthfield">Jabatan Terakhir</label>
        		        		<div class="control-group">
        							<div class="controls">:
        		                	<?php
        		                		$arridjabatan='data-rule-required=true style="width:300px;"';
        		                		echo form_dropdown('idjabatan',$idjabatan_opt,$isi->idjabatan,$arridjabatan);
        		                	?>
        							</div>
        		        		</div>
		               </th>
                </tr>
                <tr>
		            <th align="left">
		        		<label class="control-label" for="minlengthfield">Alasan Resign</label>
		        		<div class="control-group">
							<div class="controls">:
		                	<?php
		                		$arridalasan='data-rule-required=true id="idalasan" ';
                        $idalasan_opt = $this->p_c->arraymerge($idalasan_opt,array('lain' => 'Lainnya'));
		                		echo form_dropdown('idalasan',$idalasan_opt,$isi->idalasan,$arridalasan);
                        echo "&nbsp;&nbsp;&nbsp;<input type='text' name='idalasan_lainnya' id='idalasan_lainnya' style='visibility: hidden;' placeholder='Masukkan 2-500 Karakter' data-rule-maxlength='500'>";
		                	?>
							</div>
		        		</div>
		            </th></tr>
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
   	                		<label class="control-label" for="minlengthfield">Tgl. Keluar</label>
   	                		<div class="control-group">
   								<div class="controls">:
   			                	<?php
   			                		echo form_input(array('class' => '', 'id' => 'dp1','name'=>'tanggal_keluar','value'=>$CI->p_c->tgl_form($isi->tanggal_keluar),'data-rule-required'=>'true' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'2' ,'placeholder'=>'DD-MM-YYYY','autocomplete'=>'off'));
   			                	?>
   			                	<?php //echo  <p id="message"></p> ?>
   								</div>
   	                		</div>
   			            </th>
            </tr>
            <tr>
              <th align="left">
              <label class="control-label" for="minlengthfield">Selesai</label>
              <div class="control-group">
            <div class="controls">:
                    <?php
                      echo form_checkbox('selesai', '1', 0);
                    ?>
                    <?php //echo  <p id="message"></p> ?>
            </div>
              </div>
              </th></tr>
              <tr>
                <th align="left">
                <label class="control-label" for="minlengthfield">Batal</label>
                <div class="control-group">
              <div class="controls">:
                      <?php
                        echo form_checkbox('batal', '1', 0);
                      ?>
                      <?php //echo  <p id="message"></p> ?>
              </div>
                </div>
                </th></tr>
				    <tr>
				            <th align="left">
				            	<button class='btn btn-primary' onclick="return validate()">Simpan</button>
				            	<a href="javascript:void(window.open('<?php echo site_url('pegawai_exit') ?>'))" class="btn btn-success">Kembali</a>
				            </th>
				    </tr>
		            </table>
		        	<?php
		        	echo form_close();
		        	?>
	    </section>
<?php } elseif($view=='tambahletter'){ ?>
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
              <label class="control-label" for="minlengthfield">Pegawai</label>
              <div class="control-group">
            <div class="controls">:
                    <?php
                      echo $isi->pegawaitext;
                    ?>
                    <input type="hidden" name="idpegawai" value="<?php echo $isi->idpegawai; ?>">
            </div>
              </div>
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
                     <label class="control-label" for="minlengthfield">Tgl. Mulai Bekerja</label>
                     <div class="control-group">
               <div class="controls">:
                       <?php
                         echo form_input(array('class' => '', 'id' => 'dp2','name'=>'tanggal_bekerja','value'=>$CI->p_c->tgl_form($isi->tanggal_bekerja),'data-rule-required'=>'true' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'2' ,'placeholder'=>'DD-MM-YYYY','autocomplete'=>'off'));
                       ?>
                       <?php //echo  <p id="message"></p> ?>
               </div>
                     </div>
                 </th>
         </tr>
            <tr>
                 <th align="left">
                     <label class="control-label" for="minlengthfield">Tgl. Surat</label>
                     <div class="control-group">
               <div class="controls">:
                       <?php
                         echo form_input(array('class' => '', 'id' => 'dp3','name'=>'tanggal_surat','value'=>$CI->p_c->tgl_form($isi->tanggal_surat),'data-rule-required'=>'true' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'2' ,'placeholder'=>'DD-MM-YYYY','autocomplete'=>'off'));
                       ?>
                       <?php //echo  <p id="message"></p> ?>
               </div>
                     </div>
                 </th>
         </tr>
         <!--
         <tr>
           <th align="left">
           <label class="control-label" for="minlengthfield">Surat Keterangan</label>
           <div class="control-group">
         <div class="controls">:
                 <?php
                   echo form_checkbox('suratketerangan', '1', $isi->suratketerangan);
                 ?>
                 <?php //echo  <p id="message"></p> ?>
         </div>
           </div>
           </th></tr>
         -->
           <tr>
             <th align="left">
             <label class="control-label" for="minlengthfield">Selesai</label>
             <div class="control-group">
           <div class="controls">:
                   <?php
                     echo form_checkbox('selesai', '1', 0);
                   ?>
                   <?php //echo  <p id="message"></p> ?>
           </div>
             </div>
             </th></tr>
				    <tr>
				            <th align="left">
				            	<button class='btn btn-primary' onclick="return validate()">Simpan</button>
				            	<a href="javascript:void(window.open('<?php echo site_url('pegawai_exit') ?>'))" class="btn btn-success">Kembali</a>
				            </th>
				    </tr>
		            </table>
		        	<?php
		        	echo form_close();
		        	?>
	    </section>
<!------------------------------------------------------------------------------------------------------------------------------------->
<?php } elseif($view=='view'){ ?>
  <script language="javascript">
  function cetakprint() {
    newWindow('<?php echo site_url("pegawai_exit_letter/printpegawai_exit/".$isi->replid."/0")?>', 'cetakrapot','900','800','resizable=1,scrollbars=1,status=0,toolbar=0')
  }
  function cetakword() {
    newWindow('<?php echo site_url("pegawai_exit_letter/printpegawai_exit/".$isi->replid."/1")?>', 'cetakrapot','900','800','resizable=1,scrollbars=1,status=0,toolbar=0')
  }
  function closeme(){
    void(window.opener = self);
    window.close();
  }
  </script>
		    <section class="content-header table-responsive">
	            <h1>
	                <?php echo $form ?>
	                <small><?php echo $form_small ?></small>
	            </h1>
              <?php if($isi->status=="4"){ ?>
              <ol class="breadcrumb">
                      <li><a href="JavaScript:cetakprint()"><i class="fa fa-file-text"></i>&nbsp;Cetak</a></li>
                      <li><a href="JavaScript:cetakword()"><i class="fa fa-print"></i>&nbsp;Word</a></li>
              </ol>
            <?php } ?>
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
								<?php echo $isi->no_sk;?>
								</div>
	                		</div>
			            </th></tr>
			        <tr>
		            <tr>
		            <th align="left">
		        		<label class="control-label" for="minlengthfield">NIK</label>
		        		<div class="control-group">
							<div class="controls">:
							<a href="javascript:void(window.open('<?php echo site_url('general/datapegawai/'.$isi->idpegawai) ?> '))"><?php echo strtoupper($isi->nip);?></a>
							</div>
		        		</div>
		            </th></tr>

		            <tr>
		            <th align="left">
		        		<label class="control-label" for="minlengthfield">Pegawai</label>
		        		<div class="control-group">
							<div class="controls">:
							<a href="javascript:void(window.open('<?php echo site_url('general/datapegawai/'.$isi->idpegawai) ?> '))"><?php echo $CI->dbx->getpegawai($isi->idpegawai);?></a>
							</div>
		        		</div>
		            </th></tr>
                <tr>
		            <th align="left">
		        		<label class="control-label" for="minlengthfield">Jabatan Terakhir</label>
		        		<div class="control-group">
							<div class="controls">:
							<?php echo strtoupper($isi->jabatantext);?>
							</div>
		        		</div>
		            </th></tr>
		            <tr>
		            <th align="left">
		        		<label class="control-label" for="minlengthfield">Alasan Resign</label>
		        		<div class="control-group">
							<div class="controls">:
							<?php echo strtoupper($isi->alasantext);?>
							</div>
		        		</div>
		            </th></tr>
                <tr>
 			            <th align="left">
 	                		<label class="control-label" for="minlengthfield">Tgl. Mulai Bekerja</label>
 	                		<div class="control-group">
 								<div class="controls">:
 								<?php echo strtoupper($CI->p_c->tgl_indo($isi->tanggal_bekerja));?>
 								</div>
 	                		</div>
 			            </th>
 			         </tr>
			         <tr>
			            <th align="left">
	                		<label class="control-label" for="minlengthfield">Tgl. Keluar</label>
	                		<div class="control-group">
								<div class="controls">:
								<?php echo strtoupper($CI->p_c->tgl_indo($isi->tanggal_keluar));?>
								</div>
	                		</div>
			            </th>
			         </tr>

				    <tr>
				            <th align="left">
		                		<label class="control-label" for="minlengthfield">Tgl. Surat</label>
		                		<div class="control-group">
									<div class="controls" valign="top">:
									<?php echo strtoupper($CI->p_c->tgl_indo($isi->tanggal_surat));?>
									</div>
		                		</div>
				            </th></tr>
                    <!--
                    <tr>
        				            <th align="left">
        		                		<label class="control-label" for="minlengthfield">Surat Keterangan</label>
        		                		<div class="control-group">
        									<div class="controls" valign="top">&nbsp;&nbsp;
        									<?php echo ($CI->p_c->cekaktif($isi->suratketerangan));?>
        									</div>
        		                		</div>
        				            </th></tr>
                    -->
            <tr>
                    <th align="left">
                        <label class="control-label" for="minlengthfield">Keterangan</label>
                        <div class="control-group">
                  <div class="controls" valign="top">:&nbsp;&nbsp;
                  <?php echo strtoupper($isi->keterangan);?>
                  </div>
                        </div>
                    </th></tr>
          <tr>
                  <th align="left">
                      <label class="control-label" for="minlengthfield">Status</label>
                      <div class="control-group">
                <div class="controls" valign="top">:&nbsp;&nbsp;
                <?php echo strtoupper($isi->statustext);?>
                </div>
                      </div>
                  </th></tr>
				    <tr>
				            <th align="left">
				            	<?php
                      /*
				            	if ($view2<>1){
					            	echo "<button class='btn btn-primary'>Simpan</button>&nbsp;&nbsp;";
					            }else{
						         	  echo "<a href=javascript:void(window.open('".site_url('pegawai_exit/tambah/'.$isi->replid)."')) class='btn btn-xs btn-warning'>&nbsp;&nbsp;Ubah&nbsp;&nbsp;</a> ";
                        echo "<a href=javascript:void(window.open('".site_url('pegawai_exit/hapus/'.$isi->replid.'/'.$isi->idpegawai)."')) class='btn btn-xs btn-danger'>Hapus</a> ";
					            }
                      */
				            	echo "<a href='JavaScript:closeme()' class='btn btn-success'>Kembali</a>";
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
				            	<a href="javascript:void(window.open('<?php echo site_url('pegawai_exit') ?>'))" class="btn btn-success">Kembali</a>
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
