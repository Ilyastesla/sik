<!DOCTYPE html>
<html>
<script language="javascript">
function cetakterima(id) {
	newWindow('../printinventory_terima/'+id, 'cetakinventory_terima','900','800','resizable=1,scrollbars=1,status=0,toolbar=0')
}
</script>

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
                        <li><a href="javascript:void(window.open('<?php echo site_url('inventory_terima/tambah'); ?>'))" ><i class="fa fa-plus-square"></i> Tambah</a></li>

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
                            <label class="control-label" for="minlengthfield">Status</label>
                            <div class="control-group">
                      <div class="controls">:
                              <?php
                                $arridstatus='data-rule-required=false';
                                echo form_dropdown('idstatus',$idstatus_opt,$this->session->userdata('idstatus'),$arridstatus);
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
                                                <th>No. Permintaan</th>
																								<th>Tgl. Pengajuan</th>
																								<th>Material</th>
																								<th>Jumlah Serah</th>
																								<th>Unit</th>
																								<th>HPP</th>
                                                <th>Status</th>
                                                <?php if(ISSET($history)){ ?>
                                                <th width="*">Persetujuan Selanjutnya</th>
                                                <?php } ?>
                                                <th width="80">Aksi</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                        	<?php
                                        	$CI =& get_instance();
																					$sisaserah=0;$total_serah=0;
											foreach((array)$show_table as $row) {
											    echo "<tr>";
											    echo "<td align='center'>";
											    if ($row->app==0){
												    echo "<a href=javascript:void(window.open('".site_url('permintaan_barang/view/'.$row->idinventory_permintaan)."')) >".$row->kode_transaksi."</a>";
											    }else{
												    echo $row->kode_transaksi;
											    }
											    echo "</td>";
											    echo "<td align='center'>".strtoupper($CI->p_c->tgl_indo($row->tanggalpengajuan))."</td>";
													echo "<td align=''><a href=javascript:void(window.open('".site_url('inventory/viewmaterial/'.$row->idmaterial)."')) >".$row->materialtext."</a></td>";
													echo "<td align='center'>".$row->jml_serah."</td>";
													echo "<td align='center'>".$row->idunit."</td>";
													echo "<td align='center'>".$CI->p_c->rupiah($row->hpp)."</td>";
											    echo "<td align='center'><b>".strtoupper($row->statustext)."</b></td>";
											    if(ISSET($history)){
												    echo "<td align='center'>".strtoupper($row->approvertext)."</td>";
											    }
											    echo "<td align='center'>";

											    if (($row->status<=2) and ($row->app<>100)){
											    echo "<a href=javascript:void(window.open('".site_url('permintaan_barang/ubah/'.$row->replid)."')) class='btn btn-xs btn-warning fa fa-check-square' ></a>&nbsp;&nbsp;";
													echo "<a href=javascript:void(window.open('".site_url('permintaan_barang/hapus/'.$row->replid)."')) class='btn btn-xs btn-danger fa fa-minus-square' ></a>";
											    }
											    if ($row->app==1){
											    	echo "
											    		<a href=javascript:void(window.open('".site_url('permintaan_barang/approve_v/'.$row->replid)."'))>
											    			<button class='btn btn-xs btn-warning'>Persetujuan</button>
											    		</a>";
											    }
											    if ($row->app==4){
											    	echo "
											    		<a href=javascript:void(window.open('".site_url('permintaan_barang/revisi_v/'.$row->replid)."'))>
											    			<button class='btn btn-xs btn-warning'>Revisi</button>
											    		</a>";
											    }
											    if ($row->app==100){
											    	echo "
											    		<a href=javascript:void(window.open('".site_url('permintaan_barang/history_v/'.$row->replid)."'))>
											    			<button class='btn btn-primary'>Lihat</button>
											    		</a>";
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
<?php } ?>
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
    </body>
</html>
