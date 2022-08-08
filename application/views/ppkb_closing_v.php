<!DOCTYPE html>
<html>
<script language="javascript">

function validate() {
	var jumlah=parseInt(document.getElementById("jumlah").value);
	var limitkk=parseInt(document.getElementById("limitkk").value);
	if (jumlah>=limitkk){
		alert ("Nilai tidak boleh lebih dari Rp."+limitkk);
		return false;
	}
}
function cetakterima(id) {
	newWindow('../printppkb_closing/'+id, 'cetakppkb_closing','900','800','resizable=1,scrollbars=1,status=0,toolbar=0')
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
                        <li><a href="javascript:void(window.open('<?php echo site_url('ppkb_closing/tambah'); ?>'))" ><i class="fa fa-plus-square"></i> Tambah</a></li>
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
                                                <th>No. Transaksi</th>
                                                <th>Perusahaan</th>
                                                <th>Pemohon</th>
                                                <th>Departemen</th>
                                                <th>Tgl. Pengajuan</th>
                                                <th>Nilai</th>
                                                <th>Total Kas Kecil</th>
                                                <th>LPJ Kas Kecil</th>
                                                <th>Tutup Buku</th>
                                                <th width="80">Aksi</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                        	<?php
                                        	$CI =& get_instance();
											foreach((array)$show_table as $row) {
											    echo "<tr>";
											    echo "<td align='center'>";
											    //if ($row->app==0){
												    echo "<a href=javascript:void(window.open('".site_url('ppkb_closing/view/'.$row->replid)."'))>".$row->kode_transaksi."</a>";
											    //}else{
												//    echo $row->kode_transaksi;
											    //}

											    echo "</td>";
											    echo "<td align=''>".strtoupper($row->company)."</td>";
											    echo "<td align='center'>".strtoupper($row->pemohon)."</td>";
											    echo "<td align='center'>".strtoupper($row->departemen)."</td>";
											    echo "<td align='center'>".strtoupper($CI->p_c->tgl_indo($row->tanggalpengajuan))."</td>";
											    echo "<td align='center'>".strtoupper($CI->p_c->rupiah($row->jumlah))."</td>";
											    echo "<td align='center'>".strtoupper($CI->p_c->rupiah($row->jml_kk))."</td>";
											    echo "<td align='center'>".strtoupper($CI->p_c->rupiah($row->real_kk))."</td>";
											    echo "<td align='center'>".($CI->p_c->cekaktif($row->closed))."</td>";
											    echo "<td align='center'>";

											    if (($row->closed<>1)){
											    echo "
											    		<a href=javascript:void(window.open('".site_url('ppkb_closing/view/'.$row->replid)."'))>
											    			<button class='btn btn-xs btn-warning'>Tutup Buku</button>
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
		        		<label class="control-label" for="minlengthfield">No. Transaksi</label>
		        		<div class="control-group">
							<div class="controls">:
		                	<?php echo strtoupper($isi->kode_transaksi);?>
							</div>
		        		</div>
		            </th></tr>
		            <tr>
		            <th align="left">
		        		<label class="control-label" for="minlengthfield">Perusahaan</label>
		        		<div class="control-group">
							<div class="controls">:
							<?php echo strtoupper($isi->company);?>
							</div>
		        		</div>
		            </th></tr>
		            <tr>
		            <th align="left">
		        		<label class="control-label" for="minlengthfield">Pemohon</label>
		        		<div class="control-group">
							<div class="controls">:
							<?php echo strtoupper($isi->pemohontext);?>
							</div>
		        		</div>
		            </th></tr>
		            <tr>
		            <th align="left">
		        		<label class="control-label" for="minlengthfield">Departemen</label>
		        		<div class="control-group">
							<div class="controls">:
							<?php echo strtoupper($isi->departemen);?>
		                	<?php //echo  <p id="message"></p> ?>
							</div>
		        		</div>
		            </th></tr>
		            <tr>
			            <th align="left">
	                		<label class="control-label" for="minlengthfield">Tgl. Pengajuan</label>
	                		<div class="control-group">
								<div class="controls">:
								<?php echo $CI->p_c->tgl_indo($isi->tanggalpengajuan);?>
								<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th>
			         </tr>
			         <tr>
			            <th align="left">
	                		<label class="control-label" for="minlengthfield">Nilai</label>
	                		<div class="control-group">
								<div class="controls">:
								<?php echo $CI->p_c->rupiah($isi->nilai);?>
								<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th>
			         </tr>
				    <tr>
				            <th align="left">
		                		<label class="control-label" for="minlengthfield">Keterangan</label>
		                		<div class="control-group">
									<div class="controls" valign="top">:
				                	<?php echo $isi->keterangan;?>
				                	<?php //echo  <p id="message"></p> ?>
									</div>
		                		</div>
				            </th></tr>
				     <tr>
				     <tr>
				            <th align="left">
		                		<label class="control-label" for="minlengthfield">Tutup Buku</label>
		                		<div class="control-group">
									<div class="controls" valign="top">:
				                	<?php echo ($CI->p_c->cekaktif($isi->closed));?>
				                	<?php //echo  <p id="message"></p> ?>
									</div>
		                		</div>
				            </th></tr>
				     </tr>
					     <th>
						     <hr/>
					     </th>
				     </tr>
				     <tr>
				     	<th align="left">DATA KAS KECIL :
				     	</th>
				     </tr>
				     <tr>
				     	<td>
				     		<br/>
					     	<table class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>No. Transaksi</th>
                                                <th>Perusahaan</th>
                                                <th>Pemohon</th>
                                                <th>Departemen</th>
                                                <th>Tgl. Pengajuan</th>
                                                <th>Status</th>
                                                <th>Nilai</th>
                                                <th>LPJ</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        	<?php
                                        	$CI =& get_instance();$jumlah=0;$jumlah_realisasi=0;$lpj_pending=0;$uudp_pending=0;
											foreach((array)$datakaskecil as $row) {
											    echo "<tr>";
											    echo "<td align='center'>";
												echo "<a href=javascript:void(window.open('".site_url('kaskecil/view/'.$row->replid)."')) >".$row->kode_transaksi."</a>";
											    echo "</td>";
											    echo "<td align='center'>".strtoupper($row->company)."</td>";
											    echo "<td align='center'>".strtoupper($row->pemohon)."</td>";
											    echo "<td align='center'>".strtoupper($row->departemen)."</td>";
											    echo "<td align='center'>".strtoupper($CI->p_c->tgl_indo($row->tanggalpengajuan))."</td>";
											    echo "<td align='center'><b>".strtoupper($row->statustext)."</b></td>";
											    echo "<td align='center'>".$CI->p_c->rupiah($row->jumlah)."</td>";
											    echo "<td align='center'>".$CI->p_c->rupiah($row->jumlah_realisasi)."</td>";
											    echo "</tr>";
											    $jumlah=$jumlah+$row->jumlah;
											    $jumlah_realisasi=$jumlah_realisasi+$row->jumlah_realisasi;
											    if($row->status==11){
													$lpj_pending=$lpj_pending+$row->jumlah;
											    }
											    if(($row->status<>11) and ($row->status<>4)){
													$uudp_pending=$uudp_pending+$row->jumlah;
											    }


											}
											?>
                                        </tbody>
                                        <tfoot>
                                        	<tr>
	                                        	<td colspan="6"><b>TOTAL :</b></td>
	                                        	<td><b><?php echo $CI->p_c->rupiah($jumlah); ?></b></td>
	                                        	<td><b><?php echo $CI->p_c->rupiah($jumlah_realisasi); ?></b></td>
                                        	</tr>
                                        	<tr>
	                                        	<td colspan="6"><b>LPJ PENDING :</b></td>
	                                        	<td colspan="2"><b><?php echo $CI->p_c->rupiah($lpj_pending); ?></b></td>
                                        	</tr>

                                        	<tr>
	                                        	<td colspan="6"><b>SISA LPJ :</b></td>
	                                        	<td colspan="2"><b><?php echo $CI->p_c->rupiah($jumlah-$jumlah_realisasi); ?></b></td>
                                        	</tr>
                                        	<tr>
	                                        	<td colspan="6"><b>UUDP PENDING :</b></td>
	                                        	<td colspan="2"><b><?php echo $CI->p_c->rupiah($uudp_pending); ?></b></td>
                                        	</tr>
                                        	<tr>
	                                        	<td colspan="6"><b>SISA DANA :</b></td>
	                                        	<td colspan="2"><b><?php echo $CI->p_c->rupiah($isi->nilai-$jumlah_realisasi-$lpj_pending); ?></b></td>
                                        	</tr>
                                        </tfoot>
                                    </table>
				     	</td>
				     </tr>
					     <th>
						     <hr/>
					     </th>
				     </tr>
<!----------------------------------------------------------------------------------------------------------------------------------->
					<tr>
						<th>
							<input type="hidden" name="jumlah" value="<?php echo $jumlah;?>">
							<input type="hidden" name="jumlah_realisasi" value="<?php echo $jumlah_realisasi; ?>">
					    	<?php
					    		if(($isi->closed<>1) and (($jumlah-$jumlah_realisasi)==0)){
					    			echo "<font color='red'>Catatan: Jumlah yang akan di hitung saat tutup buku adalah yang telah di LPJ kan</font><br/>";
						    		echo "<button class='btn btn-xs btn-warning' name='submit'>Tutup Buku</button>";
					    		}else{
						    		echo "<font color='red'>Catatan: Mohon LPJ kan dahulu semua transaksi untuk Tutup Buku</font><br/>";
					    		}
				            	echo "<a href=javascript:void(window.open('".site_url('ppkb_closing')."')) class='btn btn-success'>Kembali</a>";
			            	?>
			            </th>
				    </tr>

				    </table>
		        	<?php
		        	echo form_close();
		        	?>
	    </section>
<?php } ?>
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
    </body>
</html>
