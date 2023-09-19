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
<script language="javascript">
function cetakprint() {
	newWindow('<?php echo site_url("ns_rapot/printrapot/".$isi->replid."/0")?>', 'cetakrapot','900','800','resizable=1,scrollbars=1,status=0,toolbar=0')
}
function cetakexcel() {
	newWindow('<?php echo site_url("ns_rapot/printrapot/".$isi->replid."/1")?>', 'cetakrapot','900','800','resizable=1,scrollbars=1,status=0,toolbar=0')
}
</script>
	<section class="content">
    <!--
		<ol class="breadcrumb" align="right">
            <li><a href="JavaScript:cetakprint()"><i class="fa fa-file-text"></i>&nbsp;Cetak</a></li>
            <li><a href="JavaScript:cetakexcel()"><i class="fa fa-print"></i>&nbsp;Excel</a></li>
        </ol>
    -->
		<table width="100%" border="0" class="form-horizontal form-validate">
			<tr>
            <th align="left">
        		<label class="control-label" for="minlengthfield">Nama Siswa</label>
        		<div class="control-group">
					<div class="controls">:
                	<?php
                		echo ucwords(strtolower($isi->siswa));
                	?>
					</div>
        		</div>
            </th></tr>
            <tr>
            <th align="left">
        		<label class="control-label" for="minlengthfield">NISN</label>
        		<div class="control-group">
					<div class="controls">:
                	<?php
                		echo $isi->nisn;
                	?>
					</div>
        		</div>
            </th></tr>
            <tr>
            <th align="left">
        		<label class="control-label" for="minlengthfield">Nomor Induk</label>
        		<div class="control-group">
					<div class="controls">:
                	<?php
                		echo $isi->nis;
                	?>
					</div>
        		</div>
            </th></tr>
            <tr>
            <th align="left">
        		<label class="control-label" for="minlengthfield">Kelas</label>
        		<div class="control-group">
					<div class="controls">:
                	<?php
                		echo strtoupper($isi->kelas);
                	?>
					</div>
        		</div>
            </th></tr>
            <tr>
            <th align="left">
        		<label class="control-label" for="minlengthfield">Program</label>
        		<div class="control-group">
					<div class="controls">:
                	<?php
                		echo $isi->kelompoksiswa;
                	?>
					</div>
        		</div>
            </th></tr>

            <tr>
            <th align="left">
        		<label class="control-label" for="minlengthfield">Tahun Pelajaran</label>
        		<div class="control-group">
					<div class="controls">:
                	<?php
                		echo $isi->tahunajaran;
                	?>
					</div>
        		</div>
            </th></tr>
            <th align="left">
        		<label class="control-label" for="minlengthfield">Semester</label>
        		<div class="control-group">
					<div class="controls">:
                	<?php
                		echo ucwords(strtolower($isi->periode));
                	?>
                	<?php //echo  <p id="message"></p> ?>
					</div>
				</div>
			</th></tr>
            <tr>
            <th align="left">
        		<label class="control-label" for="minlengthfield">Regional</label>
        		<div class="control-group">
					<div class="controls">:
                	<?php
                		echo ucwords(strtolower($isi->region));
                	?>
					</div>
        		</div>
            </th></tr>
            <tr>
            <th align="left">
        		<label class="control-label" for="minlengthfield">Tipe Rapor</label>
        		<div class="control-group">
					<div class="controls">:
                	<?php
                		echo ucwords(strtolower($isi->rapottipe));
                	?>
					</div>
        		</div>
            </th></tr>
    		<tr>
		            <th align="left">
                		<label class="control-label" for="minlengthfield">Komentar</label>
                		<div class="control-group">
							<div class="controls" valign="top">:
		                	<?php
		                		echo $isi->keterangan;
		                	?>

							</div>
                		</div>
		            </th></tr>
		    <tr>
	            <th align="left">
            		<label class="control-label" for="minlengthfield">Tgl. Rapor</label>
            		<div class="control-group">
						<div class="controls">:
	                	<?php
	                		echo strtoupper($CI->p_c->tgl_indo($isi->tanggalkegiatan));
	                	?>
						</div>
            		</div>
	            </th>
	         </tr>
		</table>
<?php
	// RAPOR UTAMA
	// ----------------------------------------------------------------------------------------------------------------------------------
	// ----------------------------------------------------------------------------------------------------------------------------------
				$pembelajaranjadwal="";$jml_kel=0;
        foreach((array)$kelompok as $rowkelompok) {
                $jml_kel++;
				    $alert="";
				    if (($rowkelompok->regiontext<>$isi->region) or ($rowkelompok->kelastext<>$isi->kelas)){
					    $alert=" color='red'";
				    }

            		if ($pembelajaranjadwal<>$rowkelompok->replid){
	            		$no=1;
				        echo "<table class='table table-bordered'>";
				        echo "<tr>";
	            		echo "<td align='' colspan=5><b><a href='".site_url('ns_pembelajaranjadwal/penilaian')."/".$rowkelompok->replid."/0')' target='_blank'>".strtoupper($rowkelompok->prosestipe.' '.$rowkelompok->keteranganprosestext).'</a> [ '.$CI->p_c->tgl_indo($rowkelompok->tanggalkegiatan).' ]'.", Dibuat Oleh : ".$rowkelompok->walikelas ."</b>
	            		<br/>
	            		<font ".$alert."><b>Kelas : ".$rowkelompok->kelastext." (".$rowkelompok->regiontext.")</b></font><br/>
                  <font ".$alert."><b>Modul : ".$rowkelompok->idmodultipe."</b></font>
	            		</td>";
	            		echo "</tr>";
						echo "<tr>";
	                    echo "<th width='70'>No.</th>";
	                    echo "<th>Mata Pelajaran</th>";
                      echo "<th>Proses Sub Variabel</th>";
	                    echo "<th>Variabel Penilaian</th>";
						echo "<th>Jenis Tabel</th>";
	                    echo "<th width='100'>Nilai</th>";
	                    echo "</tr>";
            		}
            		echo "<tr>";
				    echo "<td align='center'>".$no++."</td>";
				    echo "<td align='left'>".ucwords(strtolower($rowkelompok->matpel))."</td>";
            echo "<td align='left'>".ucwords(strtolower($rowkelompok->prosessubvariabel))." (".$rowkelompok->persentasemurnisv."%)"."</td>";
				    echo "<td align='center'>".ucwords(strtolower($rowkelompok->pengembangandirivariabel))." [".$rowkelompok->idpengembangandirivariabel."] (".$rowkelompok->persentasemurni."%)"."</td>";
				    echo "<td align='center'>".$rowkelompok->tabelhitung."</td>";
					echo "<td align='center'>".$rowkelompok->nilai."</td>";
				    echo "</tr>";
            		$pembelajaranjadwal=$rowkelompok->replid;
            	}
				?>

            </tbody>
            <tfoot>
            </tfoot>
        </table>
        <table>
	        <tr>
		            <th align="left">
		            	<a href="javascript:void(window.open('<?php echo site_url("ns_rapot/rapot/".$id) ?>'))" class="btn btn-success">Kembali</a>
		            </th>
		    </tr>
        </table>
     </section>
    </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
    </body>
</html>
