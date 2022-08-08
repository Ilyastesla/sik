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
                        <li><a href="javascript:void(window.open('<?php echo site_url('ns_predikatgraph/tambah'); ?>'))" ><i class="fa fa-plus-square"></i> Tambah</a></li>
                        <!--
                        <li><a href="#"><i class="fa fa-file-text"></i>Cetak</a></li>
                        <li><a href="#"><i class="fa fa-file-excel-o"></i>Excel</a></li>
                        -->
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
                                                <th width='50'>No.</th>
                                                <th>Jenjang</th>
                                                <th>Proses Tipe</th>
                                                <th>Pengembangan Diri</th>
                                                <th>Predikat</th>
                                                <th width="80">Dari</th>
                                                <th width="80">Sampai</th>
                                                <th>Deskripsi</th>
                                                <th>aktif</th>
                                                <th width="80">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        	<?php
                                        	$CI =& get_instance();$no=1;
											foreach((array)$show_table as $row) {
											    echo "<tr>";
											    echo "<td align='center'>".$no++."</td>";
                          echo "<td align=''>".strtoupper($row->iddepartemen)."</td>";
                          echo "<td align=''>".strtoupper($row->prosestipe)."</td>";
                          echo "<td align=''>".strtoupper($row->pengembangandirivariabel)."</td>";
                          echo "<td align=''>".strtoupper($row->predikatgraph)."</td>";
											    echo "<td align='center'>".$row->dari."</td>";
											    echo "<td align='center'>".$row->sampai."</td>";
											    echo "<td align='center'>".$row->deskripsi."</td>";
											    echo "<td align='center'>".$CI->p_c->cekaktif($row->aktif)."</td>";
											    echo "<td align='center'>";
													echo "<a href=javascript:void(window.open('".site_url('ns_predikatgraph/ubah/'.$row->replid)."')) class='btn btn-xs btn-warning fa fa-check-square' ></a>&nbsp;&nbsp;";
													echo "<a href=javascript:void(window.open('".site_url('ns_predikatgraph/hapus/'.$row->replid)."')) class='btn btn-xs btn-danger fa fa-minus-square' ></a>";
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
<script language="javascript">
  function refresh(ubah) {
    var idprosestipe = document.getElementById('idprosestipe').value;
    var idprosesvariabel = document.getElementById('idprosesvariabel').value;
    var idprosessubvariabel = document.getElementById('idprosessubvariabel').value;
    var idpengembangandiri = document.getElementById('idpengembangandiri').value;
    if (idprosestipe==""){idprosestipe=0}
    if (idprosesvariabel==""){idprosesvariabel=0}

    if (ubah==1){
      document.location.href = "<?php echo site_url('ns_predikatgraph/ubah/'.$isi->replid) ?>/"+idprosestipe+"/"+idprosesvariabel+"/"+idprosessubvariabel+"/"+idpengembangandiri;
    }else{
      document.location.href = "<?php echo site_url('ns_predikatgraph/tambah/0') ?>/"+idprosestipe+"/"+idprosesvariabel+"/"+idprosessubvariabel+"/"+idpengembangandiri;
    }

  }
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
            <tr>
              <th align="left">
              <label class="control-label" for="minlengthfield">Tipe Proses</label>
              <div class="control-group">
                    <div class="controls">:
                    <?php
                      if(urldecode($this->uri->segment(4))==""){$idprosestipe=$isi->idprosestipe;}else{$idprosestipe=urldecode($this->uri->segment(4));}
                      $arridprosestipe="data-rule-required=true id=idprosestipe onchange=refresh(".$edit.")";
                      echo form_dropdown('idprosestipe',$idprosestipe_opt,$idprosestipe,$arridprosestipe);
                    ?>
                    <?php //echo  <p id="message"></p> ?>
                  </div>
              </div>
              </th></tr>
              <tr>
                <th align="left">
                <label class="control-label" for="minlengthfield">Variabel Proses</label>
                <div class="control-group">
                      <div class="controls">:
                      <?php
                        if(urldecode($this->uri->segment(5))==""){$idprosesvariabel=$isi->idprosesvariabel;}else{$idprosesvariabel=urldecode($this->uri->segment(5));}
                        $arridprosesvariabel="data-rule-required=true id=idprosesvariabel onchange=refresh(".$edit.")";
                        echo form_dropdown('idprosesvariabel',$idprosesvariabel_opt,$idprosesvariabel,$arridprosesvariabel);
                      ?>
                      <?php //echo  <p id="message"></p> ?>
                    </div>
                </div>
                </th></tr>
                <tr>
                  <th align="left">
                  <label class="control-label" for="minlengthfield">Sub Variabel Proses</label>
                  <div class="control-group">
                        <div class="controls">:
                        <?php
                          if(urldecode($this->uri->segment(6))==""){$idprosessubvariabel=$isi->idprosessubvariabel;}else{$idprosessubvariabel=urldecode($this->uri->segment(6));}
                          $arridprosessubvariabel="data-rule-required=true id=idprosessubvariabel onchange=refresh(".$edit.")";
                          echo form_dropdown('idprosessubvariabel',$idprosessubvariabel_opt,$idprosessubvariabel,$arridprosessubvariabel);
                        ?>
                        <?php //echo  <p id="message"></p> ?>
                      </div>
                  </div>
                  </th></tr>
                  <tr>
                    <th align="left">
                    <label class="control-label" for="minlengthfield">Pengembangan Diri</label>
                    <div class="control-group">
                          <div class="controls">:
                          <?php
                            if(urldecode($this->uri->segment(7))==""){$idpengembangandiri=$isi->idpengembangandiri;}else{$idpengembangandiri=urldecode($this->uri->segment(7));}
                            $arridpengembangandiri="data-rule-required=true id=idpengembangandiri ";
                            echo form_dropdown('idpengembangandiri',$idpengembangandiri_opt,$idpengembangandiri,$arridpengembangandiri);
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
			                		echo form_input(array('class' => '','style'=>'margin: 0px 0px 5px; width: 687px;', 'id' => 'predikat','name'=>'predikat','value'=>$isi->predikatgraph,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'500', 'data-rule-minlength'=>'1' ,'placeholder'=>'Masukkan 1-100 Karakter'));
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th></tr>
				    <tr>
				            <th align="left">
		                		<label class="control-label" for="minlengthfield">Dari</label>
		                		<div class="control-group">
									<div class="controls">:
				                	<?php
				                		echo form_input(array('id' => 'dari','name'=>'dari','value'=>$isi->dari,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'3', 'data-rule-minlength'=>'1','data-rule-number'=>'true','placeholder'=>'Masukkan 1-3 Karakter'));
				                	?>
				                	<?php //echo  <p id="message"></p> ?>
									</div>
		                		</div>
				        </th></tr>
				    <tr>
				            <th align="left">
		                		<label class="control-label" for="minlengthfield">Sampai</label>
		                		<div class="control-group">
									<div class="controls">:
				                	<?php
				                		echo form_input(array('id' => 'sampai','name'=>'sampai','value'=>$isi->sampai,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'3', 'data-rule-minlength'=>'1','data-rule-number'=>'true','placeholder'=>'Masukkan 1-3 Karakter'));
				                	?>
				                	<?php //echo  <p id="message"></p> ?>
									</div>
		                		</div>
				        </th></tr>
				    <tr>
				            <th align="left">
		                		<label class="control-label" for="minlengthfield">Deskripsi</label>
		                		<div class="control-group">
									<div class="controls" valign="top">&nbsp;&nbsp;
				                	<?php
				                		//if($deskripsi2==""){$deskripsi=$isi->deskripsi;}else{$deskripsi=$deskripsi2;}
				                		echo form_textarea(array('class' => '', 'id' => 'deskripsi','name'=>'deskripsi','value'=>$isi->deskripsi,'data-rule-required'=>'false' ,'data-rule-maxlength'=>'500', 'data-rule-minlength'=>'2' ,'placeholder'=>'Masukkan 2-500 Karakter'));
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
				            	<button class='btn btn-primary' onclick="return validate()">Simpan</button>
				            	<a href="javascript:void(window.open('<?php echo site_url('ns_predikatgraph') ?>'))" class="btn btn-success">Kembali</a>
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
