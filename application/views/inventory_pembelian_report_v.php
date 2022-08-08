<!DOCTYPE html>
<html>
<script language="javascript">
function cetakterima(id) {
	newWindow('../printinventory_pembelian_report/'+id, 'cetakinventory_pembelian_report','900','800','resizable=1,scrollbars=1,status=0,toolbar=0')
}
</script>

    <?php $this->load->view('header') ?>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas collapse-left">
            <?php $this->load->view('menu') ?>
            </aside>
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side strech">
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
                        <li><a href="javascript:void(window.open('<?php echo site_url('inventory_pembelian_report/tambah'); ?>'))" ><i class="fa fa-plus-square"></i> Tambah</a></li>

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
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
																								<th width='50'>No.</th>
																								<th>No. Permintaan</th>
                                                <th>Perusahaan</th>
																								<th>Vendor</th>
                                                <th>Tgl. Pembelian</th>
                                                <!-- <th>Keterangan</th> -->
																								<th>Material</th>
																								<th>Jumlah</th>
																								<th>Unit</th>
																								<th>Harga<br>(+pajak)</th>
																								<th>Harga Tambahan</th>
																								<th>Harga Total</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        	<?php
                                        	$CI =& get_instance();
																					$no=1;$totalall=0;
											foreach((array)$show_table as $row) {
													$totalall=$totalall+$row->hargatotal+$row->hargatambahan;
											    echo "<tr>";
													echo "<td align='center'>".$no++."</td>";
											    echo "<td align='center'>";
												  echo "<a href=javascript:void(window.open('".site_url('inventory_pembelian_report/view/'.$row->replid)."')) >".$row->kode_transaksi."</a>";
											    echo "</td>";
											    echo "<td align=''>".strtoupper($row->company)."</td>";
													echo "<td align='center'>".strtoupper($row->vendortext)."</td>";
											    echo "<td align='center'>".strtoupper($CI->p_c->tgl_indo($row->tanggalpembelian))."</td>";
													//echo "<td align='center'>".$row->keterangan."</td>";
													echo "<td align=''>".$row->materialtext."</td>";
													echo "<td align='center'>".$row->jumlah."</td>";
													echo "<td align='center'>".$row->unittext."</td>";
													echo "<td align='center'>".$CI->p_c->rupiah($row->harga)."</td>";
													echo "<td align='center'>".$CI->p_c->rupiah($row->hargatambahan)."</td>";
													echo "<td align='center'>".$CI->p_c->rupiah(($row->hargatotal+$row->hargatambahan))."</td>";
											    echo "<td align='center'><b>".strtoupper($row->statustext)."</b></td>";
											    echo "</tr>";
											}
											echo "<tr>";
											echo "<td align='right' colspan='10'><h4>TOTAL : </h4></td>";
											echo "<td align='right'><h4>".$CI->p_c->rupiah($totalall)."</h4></td>";
											echo "<th align='right'>&nbsp;</th>";
											echo "<tr>";
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
<?php } ?>
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
    </body>
</html>
