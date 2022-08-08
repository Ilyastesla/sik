<!DOCTYPE html>
<html>
<!-- newWindow('index', 'cetakexceldo','900','800','resizable=1,scrollbars=1,status=0,toolbar=0') -->
<script language="javascript">
function cetakprint(id) {
	document.getElementById("printvalue").value = "1";
	form.setAttribute("target", "_blank");
	document.getElementById("form").submit();
	form.setAttribute("target", "");
	document.getElementById("printvalue").value = "";
}
function cetakexcel(id) {
	document.getElementById("printvalue").value = "1";
	document.getElementById("excel").value = "1";
	form.setAttribute("target", "_blank");
	document.getElementById("form").submit();
	form.setAttribute("target", "");
	document.getElementById("excel").value = "";
	document.getElementById("printvalue").value = "";
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
                </section>


                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-body table-responsive">
                                	<?php
								        $attributes = array('class' => 'form-horizontal form-validate', 'id' => 'form', 'method' => 'POST', 'novalidate'=>'novalidate','onsubmit'=>'return validate()');
							    	echo form_open($action,$attributes);
							    	?>
                                	<table width="100%">
                                	<tr>
                                		<td width="50%">
                                	<table width="100%" border="0">
		    		<tr>
		            <th align="left">
		        		<label class="control-label" for="minlengthfield">No. Transaksi</label>
		        		<div class="control-group">
							<div class="controls">:
		                		<?php
							                		echo form_input(array('class' => '', 'id' => 'kode_transaksi','name'=>'kode_transaksi','value'=>$filterx->kode_transaksi,'data-rule-required'=>'false' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'1'));
							                	?>
							                	<?php //echo  <p id="message"></p> ?>
							</div>
		        		</div>
		            </th></tr>
		            <tr>
		            <th align="left">
		        		<label class="control-label" for="minlengthfield">Perusahaan</label>
		        		<div class="control-group">
							<div class="controls">:
		                	<?php
		                		$arrcompany='data-rule-required=false';
		                		echo form_dropdown('idcompany',$company_opt,$filterx->idcompany,$arrcompany);
		                	?>
							</div>
		        		</div>
		            </th></tr>
		            <tr>
		            <th align="left">
		        		<label class="control-label" for="minlengthfield">Pemohon</label>
		        		<div class="control-group">
							<div class="controls">:
		                	<?php
		                		$arrpemohon='data-rule-required=false';
		                		echo form_dropdown('pemohon',$pemohon_opt,$filterx->pemohon,$arrpemohon);
		                	?>
							</div>
		        		</div>
		            </th></tr>
		            <tr>
		            <th align="left">
		        		<label class="control-label" for="minlengthfield">Departemen</label>
		        		<div class="control-group">
							<div class="controls">:
		                	<?php
		                		$arrdepartemen='data-rule-required=false';
		                		echo form_dropdown('iddepartemen',$departemen_opt,$filterx->iddepartemen,$arrdepartemen);
		                	?>
		                	<?php //echo  <p id="message"></p> ?>
							</div>
		        		</div>
		            </th></tr>
		            <tr>
			            <th align="left">
	                		<label class="control-label" for="minlengthfield">Tgl. Pengajuan Dari</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		echo form_input(array('class' => '', 'id' => 'dp1','name'=>'tanggalpengajuan','value'=>$filterx->tanggalpengajuan,'data-rule-required'=>'false' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'2' ,'placeholder'=>'DD-MM-YYYY','autocomplete'=>'off'));
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th>
			         </tr>
			         <tr>
			            <th align="left">
	                		<label class="control-label" for="minlengthfield">Tgl. Pengajuan S/D</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		echo form_input(array('class' => '', 'id' => 'dp2','name'=>'tanggalpengajuan2','value'=>$filterx->tanggalpengajuan2,'data-rule-required'=>'false' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'2' ,'placeholder'=>'DD-MM-YYYY','autocomplete'=>'off'));
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th>
			         </tr>
			         <!--
			         <tr>
			            <th align="left">
			        		<label class="control-label" for="minlengthfield">Tampilan</label>
			        		<div class="control-group">
								<div class="controls">:
			                	<select name="detail" data-rule-required="false">
									<option value="0">Simpel</option>
									<option value="1">Detail</option>
								</select>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
			        		</div>
			            </th></tr>
			           -->
		            </table>
		            </td>
		            <td width="50%" valign="top">
			            <table width="100%" border="0">
			    	 <tr>
			            <th align="left">
			        		<label class="control-label" for="minlengthfield">Kategori Pengeluaran</label>
			        		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		$arrjt='data-rule-required=false';
			                		echo form_dropdown('idpengeluaran',$jt_opt,$filterx->idpengeluaran,$arrjt);
			                	?>
								</div>
			        		</div>
			            </th></tr>
			            <tr>
			            <th align="left">
			        		<label class="control-label" for="minlengthfield">Sumber Dana</label>
			        		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		$arrkredit='data-rule-required=false';
			                		echo form_dropdown('idkredit',$kredit_opt,$filterx->idkredit,$arrkredit);
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
			        		</div>
			            </th></tr>
			            <tr>
			            <th align="left">
			        		<label class="control-label" for="minlengthfield">COA</label>
			        		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		$arrdebit='data-rule-required=false';
			                		echo form_dropdown('iddebit',$debit_opt,$filterx->iddebit,$arrdebit);
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
			        		</div>
			            </th></tr>
			            <tr>
			            <th align="left">
			        		<label class="control-label" for="minlengthfield">Status</label>
			        		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		$arrstatus='data-rule-required=false';
			                		echo form_dropdown('status',$status_opt,$filterx->status,$arrstatus);
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
			        		</div>
			            </th></tr>
			            <tr>
			            <th align="left">
			        		<label class="control-label" for="minlengthfield">Urut Berdasarkan</label>
			        		<div class="control-group">
								<div class="controls">:
			                	<select name="berdasarkan" data-rule-required="false">
									<option value="kk.kode_transaksi">No. Transaksi</option>
									<option value="p.nama">Pemohon</option>
									<option value="kk.tanggalpengajuan">Tanggal Pengajuan</option>
									<option value="kk.jumlah">Nilai</option>
									<option value="dp.nama">Kategori Pengeluaran</option>
									<option value="idkredit">Sumber Dana</option>
									<option value="iddebit">COA</option>
									<option value="statustext">Status</option>
								</select>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
			        		</div>
			            </th></tr>
			            <tr>
			            <th align="left">
			        		<label class="control-label" for="minlengthfield">Urutan</label>
			        		<div class="control-group">
								<div class="controls">:
			                	<select name="urutan" data-rule-required="false">
									<option value="ASC">Menurun</option>
									<option value="DESC">Menanjak</option>
								</select>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
			        		</div>
			            </th></tr>
			            <!--
			            <tr>
			            <th align="left">
			        		<label class="control-label" for="minlengthfield">Grup Berdasarkan</label>
			        		<div class="control-group">
								<div class="controls">:
			                	<select name="grup" data-rule-required="false">
									<option value="0">Simpel</option>
									<option value="1">Detail</option>
								</select>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
			        		</div>
			            </th></tr>
			            -->
			            </table>
		            </td>
		            </tr>
		            <tr>
			            <td colspan="2" align="left">
			            	<input type="hidden" name="printvalue" id="printvalue" value="">
			            	<input type="hidden" name="excel" id="excel" value="">
				            <button class='btn btn-primary' name="filter" value="filter">Filter</button>
				            <a href="javascript:void(window.open('<?php echo site_url('kaskecil_report') ?>'))" class="btn btn-success">Kembali</a>
			            </td>
		            </tr>
                    </table>

	                            	<?php
						        	echo form_close();
						        	?>
                            		<hr/>
                            		<?php if ($show_table<>"") {?>

                            		<ol class="breadcrumb" align="right">
				                        <li><a href="JavaScript:cetakprint('')"><i class="fa fa-file-text"></i>&nbsp;Cetak</a></li>
				                        <li><a href="JavaScript:cetakexcel('')"><i class="fa fa-print"></i>&nbsp;Excel</a></li>
				                    </ol>
                                    <table class="table table-bordered table-striped" style="width:100% !important;font-size:11px !important;">
                                        <thead>
                                            <tr>
                                                <th width='50'>No.</th>
                                                <th>No. Transaksi</th>
                                                <th>Perusahaan</th>
                                                <th>Departemen</th>
                                                <th>Pemohon</th>
                                                <th>Di Setujui Oleh</th>
                                                <th>Penerima</th>
                                                <th width="200">Kategori Pengeluaran</th>
		                                        <th>Sumber Dana</th>
		                                        <th>Keperluan</th>
		                                        <th width="150">Nilai</th>
		                                        <th width="*">Tgl. Realisasi</th>
		                                        <th width="150">LPJ</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        	<?php
                                        	$CI =& get_instance();$no=1;$jmltot=0;$jmlreal=0;$replidkk='';$replidkk2='';
											foreach((array)$show_table as $row) {
												$replidkk=$row->replid;
												$reals=0;

												if ($row->tanggalrealisasi<>""){
													$reals=$row->realisasi;
												}
											    echo "<tr>";
											    if ($replidkk<>$replidkk2){
												    echo "<td align=''>".strtoupper($no++)."</td>";
												    echo "<td align='center'>
												    			<a href=javascript:void(window.open('".site_url('kaskecil/view/'.$row->replid)."')) >".$row->kode_transaksi."</a>"."<br/> <b>No.PPKB : </b>".strtoupper($row->noppkb)."<br/> <b>Status :</b> ".strtoupper($row->statustext)."</td>";
												    echo "<td align=''>".strtoupper($row->company)."</td>";
												    echo "<td align=''>".strtoupper($row->departemen)."</td>";
												    echo "<td align='center'>".strtoupper($row->pemohontext)."<br/>".strtoupper($CI->p_c->tgl_indo($row->tanggalpengajuan))."</td>";
												    echo "<td align='center'>".strtoupper($row->approvebytext)."<br/>".strtoupper($CI->p_c->tgl_indo($row->approve_date))."</td>";
												    echo "<td align='center'>".strtoupper($row->penerimatext)."<br/>".strtoupper($CI->p_c->tgl_indo($row->tanggalpenerima))."</td>";
												}else{
												   echo "<td align='' colspan='7'>&nbsp;</td>";
											    }
											    echo "<td>".strtoupper($row->idpengeluaran)."<br/><b>COA : </b>".strtoupper($row->iddebit)."</td>";
											    echo "<td>".strtoupper($row->idkredit)."</td>";
											    echo "<td>".strtoupper($row->keperluan)."</td>";
											    echo "<td align='right'>".$CI->p_c->rupiah($row->jumlahmat)."</td>";
											    echo "<td align='center'>".strtoupper($CI->p_c->tgl_indo($row->tanggalrealisasi))."</td>";
											    echo "<td align='right'>".$CI->p_c->rupiah($reals)."</td>";
											    echo "</tr>";
											    $jmltot=$jmltot+$row->jumlahmat;
												$jmlreal=$jmlreal+$row->realisasi;
											    $replidkk2=$row->replid;
											}
											echo "<tr>";
											echo "<th style='text-align:right;' colspan='10'>NILAI TOTAL :</th>";
											echo "<th style='text-align:right;'>".strtoupper($CI->p_c->rupiah($jmltot))."</th>";
											echo "<th style='text-align:right;'>&nbsp;</th>";
											echo "<th style='text-align:right;'>".strtoupper($CI->p_c->rupiah($jmlreal))."</th>";
											echo "</tr>";
											echo "<tr>";
											echo "<th style='text-align:right;' colspan='10'>BELUM REALISASI :</th>";
											echo "<th style='text-align:right;' colspan=3>".strtoupper($CI->p_c->rupiah($jmltot-$jmlreal))."</th>";
											echo "</tr>";

											?>

                                        </tbody>
                                    </table>
                                    <?php } ?>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>
              </section><!-- /.content -->
<!---------------------------------------------------------------------------------------------------------------------------------->
<?php } ?>
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
    </body>
</html>
