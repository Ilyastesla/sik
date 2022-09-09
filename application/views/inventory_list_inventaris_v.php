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
<script language="javascript">
    function submitform() {
        document.getElementById("form").setAttribute("action", "<?php echo $action; ?>");
        document.getElementById("form").setAttribute("target", "");
        
    }

    function cetakprint() {
        document.getElementById("form").setAttribute("action", "<?php echo $action."/printlistinventaris" ?>");
        document.getElementById("form").setAttribute("target", "_blank");
        document.getElementById("form").submit();
    }
    function cetakexcel() {

        document.getElementById("form").setAttribute("action", "<?php echo $action."/printlistinventaris/1" ?>");
        document.getElementById("form").setAttribute("target", "_blank");
        document.getElementById("form").submit();
    }
  </script>
                <section class="content-header table-responsive">
                    <h1>
                        <?php echo $form ?>
                        <small>List Data</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="JavaScript:cetakprint()"><i class="fa fa-file-text"></i>&nbsp;Cetak</a></li>
                        <li><a href="JavaScript:cetakexcel()"><i class="fa fa-print"></i>&nbsp;Excel</a></li>
                    </ol>
                </section>
                <section class="content-header table-responsive">
                    <?php
			        $attributes = array('class' => 'form-horizontal form-validate', 'id' => 'form', 'method' => 'POST', 'novalidate'=>'novalidate','onsubmit'=>'submitform()');
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
                                <label class="control-label" for="minlengthfield">Departemen</label>
                                <div class="control-group">
                                    <div class="controls">:
                                        <?php
                                        $arriddepartemen="data-rule-required=true id=iddepartemen onchange='javascript:this.form.submit();'";
                                        echo form_dropdown('iddepartemen',$iddepartemen_opt,$this->input->post('iddepartemen'),$arriddepartemen);
                                        ?>
                                        <?php //echo  <p id="message"></p> ?>
                                    </div>
                                </div>
                                </th>
                        </tr>
	                    <tr>
        						            <th align="left">
        				                		<label class="control-label" for="minlengthfield">Kelompok Barang</label>
        				                		<div class="control-group">
        											<div class="controls">:
        						                	<?php
        						                		$arrkelompok='data-rule-required=false';
        						                		echo form_dropdown('idkelompok',$kelompok_opt,$this->input->post('idkelompok'),$arrkelompok);
        						                	?>
        						                	<?php //echo  <p id="message"></p> ?>
        											</div>
        				                		</div>
        						            </th>
                                <th align="left">
        				                		<label class="control-label" for="minlengthfield">Kelompok Fiskal</label>
        				                		<div class="control-group">
        											<div class="controls">:
        						                	<?php
        						                		$arrfiskal='data-rule-required=false';
        						                		echo form_dropdown('idfiskal',$fiskal_opt,$this->input->post('idfiskal'),$arrfiskal);
        						                	?>
        						                	<?php //echo  <p id="message"></p> ?>
        											</div>
        				                		</div>
        						            </th>
			            </tr>
                  <tr>
                            <th align="left">
                                <label class="control-label" for="minlengthfield">Kelompok Inventaris</label>
                                <div class="control-group">
                          <div class="controls">:
                                  <?php
                                    $arridkelompok_inventaris='data-rule-required=false';
                                    echo form_dropdown('idkelompok_inventaris',$idkelompok_inventaris_opt,$this->input->post('idkelompok_inventaris'),$arridkelompok_inventaris);
                                  ?>
                                  <?php //echo  <p id="message"></p> ?>
                          </div>
                                </div>
                            </th>
                            <th align="left">
                                <label class="control-label" for="minlengthfield">Kondisi</label>
                                <div class="control-group">
                          <div class="controls">:
                                  <?php
                                  $arridkondisi='data-rule-required=false';
                                  echo form_dropdown('idkondisi',$idkondisi_opt,$this->input->post('idkondisi'),$arridkondisi);
                                  ?>
                                  <?php //echo  <p id="message"></p> ?>
                          </div>
                                </div>
                            </th>
              </tr><tr>
                        <th align="left">
                            <label class="control-label" for="minlengthfield">Ruangan</label>
                            <div class="control-group">
                      <div class="controls">:
                              <?php
                                $arridruang='data-rule-required=false';
                                echo form_dropdown('idruang',$idruang_opt,$this->input->post('idruang'),$arridruang);
                              ?>
                              <?php //echo  <p id="message"></p> ?>
                      </div>
                            </div>
                        </th>
                        <th align="left">
                            <label class="control-label" for="minlengthfield">Periode</label>
                            <div class="control-group">
                      <div class="controls">:
                              <?php
                              echo form_input(array('class' => '', 'id' => 'dp1','name'=>'periode1','value'=>$this->input->post('periode1'),'data-rule-required'=>'false' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'2' ,'placeholder'=>'DD-MM-YYYY','autocomplete'=>'off'));
                              echo form_input(array('class' => '', 'id' => 'dp2','name'=>'periode2','value'=>$this->input->post('periode2'),'data-rule-required'=>'false' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'2' ,'placeholder'=>'DD-MM-YYYY','autocomplete'=>'off'));
                              ?>
                              <?php //echo  <p id="message"></p> ?>
                      </div>
                            </div>
                        </th>
          </tr>
			            <tr>
				            <th align="left" colspan="4">
                            <button class='btn btn-primary' name='filter' value="1" >Filter</button>
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
                                                    <?php
				                                    echo "<tr>";
				                                    	echo "<th width='50'>No.</th>";
                                                        echo "<th>No. Inventaris</th>";
				                                    	echo "<th>Nama Material</th>";
                                                        echo "<th>No. Permintaan</th>";
                                                        echo "<th>Unit Bisnis</th>";
                                                        echo "<th>Departemen</th>";
				                                    	echo "<th>Kelompok Fiskal</th>";
                                                        echo "<th>Ruangan</th>";
				                                        echo "<th>Kelompok Inventaris</th>";
                                                        echo "<th>Kondisi</th>";
                                                        echo "<th>Hargabeli</th>";
                                                    echo "</tr>";
                                                    ?>
				                                </thead>
				                                <tbody>

											    <?php
											    $no2=1;
											    foreach((array)$show_table as $row) {
												    echo "<tr>";
												    echo "<td>".$no2++."</td>";
												    
                                                    echo "<td><a href=javascript:void(window.open('".site_url('inventory_penyerahan/material_stiker_print/'.$row->replid)."')) >".$row->kode_inventaris."</a>";
                                                    echo "<br/>Tgl. Serah: ".$CI->p_c->tgl_indo($row->tanggalserah);
                                                    echo "<br/>Pemohon: ".$CI->dbx->getpegawai($row->idpemohon,0,1);
                                                    echo "</td>";
                                                    echo "<td>";
                                                    echo "<a href=javascript:void(window.open('".site_url('inventory_material/view/'.$row->idmaterial)."')) >".strtoupper("[".$row->merek."] ".$row->nama)."</a>";
                                                    echo "<br/>Kel. Barang: ".$row->kelompokbarang;
                                                    echo "</td>";
                                                    echo "<td>";
												    echo "<a href=javascript:void(window.open('".site_url('inventory_penyerahan/view/'.$row->idpermintaanbarang.'/0/'.$row->idinventory_penyerahan)."')) >".$row->kode_transaksi."</a>";
												    echo "</td>";
                                                    echo "<td>".$row->companytext."</td>";
                                                    echo "<td>".$row->departementext."</td>";
                                                    //echo "<td>".$row->kode_inventaris."</td>";
												    
                                                    echo "<td>".strtoupper($row->fiskaltext)."</td>";
                                                    echo "<td>".strtoupper($row->ruangan)."</td>";
											    	echo "<td>".$row->kelompok_inventaris."</td>";
                                                    echo "<td>".$row->kondisi."</td>";
                                                    echo "<td>".$CI->p_c->rupiah($row->hpp)."</td>";
												    echo "</tr>";
												}
											    echo "</table>";
											    ?>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>
              </section><!-- /.content -->
<?php } ?>
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
    </body>
</html>
