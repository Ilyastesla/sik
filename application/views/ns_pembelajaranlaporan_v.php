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
                        <li><a href="javascript:void(window.open('<?php echo site_url('ns_pembelajaranlaporan/tambah'); ?>'))" ><i class="fa fa-plus-square"></i> Tambah</a></li>
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
                                                <th>Tipe Proses</th>
                                                <th>Mata Pelajaran</th>
                                                <th>Departemen</th>
                                                <th>Kelas</th>
                                                <th>Tahun Pelajaran</th>
                                                <th>Tgl. Kegiatan</th>
                                                <th>Keterangan</th>
                                                <th>aktif</th>
                                                <th width="80">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        	<?php
                                        	$no=1;
											foreach((array)$show_table as $row) {
											    echo "<tr>";
											    echo "<td align='center'>".$no++."</td>";
											    echo "<td align=''><a href=javascript:void(window.open('".site_url('ns_pembelajaranlaporan/penilaian/'.$row->replid)."/1'))>".strtoupper($row->prosestipe)."</a></td>";
											    echo "<td align=''>".strtoupper($row->matpel)."</td>";
											    echo "<td align=''>".strtoupper($row->iddepartemen)."</td>";
											    echo "<td align='center'>".strtoupper($row->kelas)."</td>";
											    echo "<td align='center'>".strtoupper($row->tahunajaran)."</td>";
											    echo "<td align='center'>".strtoupper($CI->p_c->tgl_indo($row->tanggalkegiatan))."</td>";
											    echo "<td align='center'>".strtoupper($row->keterangan)."</td>";
											    echo "<td align='center'>".$CI->p_c->cekaktif($row->aktif)."</td>";
											    echo "<td align='center'>";
											    if (trim($row->created_by)==$this->session->userdata('idpegawai')){

												    echo "<a href=javascript:void(window.open('".site_url('ns_pembelajaranlaporan/penilaian/'.$row->replid)."/0'))>
												    			<button class='btn btn-xs btn-info'>Penilaian</button>
												    		</a>";
												    if ($row->nilaipd<=0){
													    echo "<a href=javascript:void(window.open('".site_url('ns_pembelajaranlaporan/ubah/'.$row->replid)."')) class='btn btn-xs btn-warning fa fa-check-square' ></a>&nbsp;&nbsp;";
													    echo "<a href=javascript:void(window.open('".site_url('ns_pembelajaranlaporan/hapus/'.$row->replid)."')) class='btn btn-danger' id='btnOpenDialog'>Hapus</a>
													    		</td>";
												    }
											    }
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
		var idmatpel = document.getElementById('idmatpel').value;
		var idtahunajaran = document.getElementById('idtahunajaran').value;
		var idkelas = document.getElementById('idkelas').value;
		var keterangan = document.getElementById('idkelas').value;
		var tanggalkegiatan = document.getElementById('dp1').value;
		if (ubah==1){
			document.location.href = "<?php echo site_url('ns_pembelajaranlaporan/ubah/'.$isi->replid) ?>/"+idprosestipe+"/"+idmatpel+"/"+idtahunajaran+"/"+idkelas+"/"+keterangan+"/"+tanggalkegiatan;
		}else{
			document.location.href = "<?php echo site_url('ns_pembelajaranlaporan/tambah') ?>/"+idprosestipe+"/"+idmatpel+"/"+idtahunajaran+"/"+idkelas+"/"+keterangan+"/"+tanggalkegiatan;
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
		                		if($idprosestipe2==""){$idprosestipe=$isi->idprosestipe;}else{$idprosestipe=$idprosestipe2;}
		                		$arridprosestipe="data-rule-required=true onchange=refresh(".$edit.") id=idprosestipe";
		                		echo form_dropdown('idprosestipe',$idprosestipe_opt,$idprosestipe,$arridprosestipe);
		                	?>
		                	<?php //echo  <p id="message"></p> ?>
							</div>
		        		</div>
		            </th></tr>
		            <tr>
		            <th align="left">
		        		<label class="control-label" for="minlengthfield">Mata Pelajaran</label>
		        		<div class="control-group">
							<div class="controls">:
		                	<?php
		                		if($idmatpel2==""){$idmatpel=$isi->idmatpel;}else{$idmatpel=$idmatpel2;}
		                		$arridmatpel="data-rule-required=true onchange=refresh(".$edit.") id=idmatpel";
		                		echo form_dropdown('idmatpel',$idmatpel_opt,$idmatpel,$arridmatpel);
		                	?>
		                	<?php //echo  <p id="message"></p> ?>
							</div>
		        		</div>
		            </th></tr>
		            <tr>
		            <th align="left">
		        		<label class="control-label" for="minlengthfield">Tahun Pelajaran</label>
		        		<div class="control-group">
							<div class="controls">:
		                	<?php
		                		if($idtahunajaran2==""){$idtahunajaran=$isi->idtahunajaran;}else{$idtahunajaran=$idtahunajaran2;}
		                		$arridtahunajaran="data-rule-required=true onchange=refresh(".$edit.") id=idtahunajaran";
		                		echo form_dropdown('idtahunajaran',$idtahunajaran_opt,$idtahunajaran,$arridtahunajaran);
		                	?>
		                	<?php //echo  <p id="message"></p> ?>
							</div>
		        		</div>
		            </th></tr>
		            <tr>
		            <th align="left">
		        		<label class="control-label" for="minlengthfield">Kelas</label>
		        		<div class="control-group">
							<div class="controls">:
		                	<?php
		                		if($idkelas2==""){$idkelas=$isi->idkelas;}else{$idkelas=$idkelas2;}
		                		$arridkelas="data-rule-required=true id=idkelas";
		                		echo form_dropdown('idkelas',$idkelas_opt,$idkelas,$arridkelas);
		                	?>
		                	<?php //echo  <p id="message"></p> ?>
							</div>
		        		</div>
		            </th></tr>
		    		<tr>
				            <th align="left">
		                		<label class="control-label" for="minlengthfield">Keterangan</label>
		                		<div class="control-group">
									<div class="controls" valign="top">&nbsp;&nbsp;
				                	<?php
				                		if($keterangan2==""){$keterangan=$isi->keterangan;}else{$keterangan=$keterangan2;}
				                		echo form_textarea(array('class' => '', 'id' => 'keterangan','name'=>'keterangan','value'=>$keterangan,'data-rule-required'=>'false' ,'data-rule-maxlength'=>'500', 'data-rule-minlength'=>'2' ,'placeholder'=>'Masukkan 2-500 Karakter'));
				                	?>
				                	<?php //echo  <p id="message"></p> ?>
									</div>
		                		</div>
				            </th></tr>
				    <tr>
			            <th align="left">
	                		<label class="control-label" for="minlengthfield">Tgl. Kegiatan</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		if($tanggalkegiatan2==""){$tanggalkegiatan=$isi->tanggalkegiatan;}else{$tanggalkegiatan=$tanggalkegiatan2;}
			                		echo form_input(array('class' => '', 'id' => 'dp1','name'=>'tanggalkegiatan','value'=>$CI->p_c->tgl_form($tanggalkegiatan),'data-rule-required'=>'false' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'2' ,'placeholder'=>'DD-MM-YYYY','autocomplete'=>'off'));
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th>
			         </tr>
				    <th align="left">
		        		<label class="control-label" for="minlengthfield">Aktif</label>
		        		<div class="control-group">
							<div class="controls">:
		                	<?php
		                		$fcdata=array('name'=>'aktif','id'=>'aktif','value'=>'1','checked'=>$isi->aktif);
		                		echo form_checkbox($fcdata);
		                	?>
		                	<?php //echo  <p id="message"></p> ?>
							</div>
		        		</div>
		            </th></tr>
				    <tr>
				            <th align="left">
				            	<button class='btn btn-primary'>Simpan</button>
				            	<a href="javascript:void(window.open('<?php echo site_url("ns_pembelajaranlaporan") ?>'))" class="btn btn-success">Kembali</a>
				            </th>
				    </tr>
		            </table>
		        	<?php
		        	echo form_close();
		        	?>
	    </section>
<!-------------------------------------------------------------------------------------------------------------------------------------->
<!-------------------------------------------------------------------------------------------------------------------------------------->
<?php } elseif($view=='penilaian'){ ?>
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
		        		<label class="control-label" for="minlengthfield">Tipe Proses</label>
		        		<div class="control-group">
							<div class="controls">:
		                	<?php
		                		echo $isi->prosestipe;
		                	?>
							</div>
		        		</div>
		            </th></tr>
		            <tr>
		            <th align="left">
		        		<label class="control-label" for="minlengthfield">Mata Pelajaran</label>
		        		<div class="control-group">
							<div class="controls">:
		                	<?php
		                		echo $isi->matpel;
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
		                	<?php //echo  <p id="message"></p> ?>
							</div>
		        		</div>
		            </th></tr>
		            <tr>
		            <th align="left">
		        		<label class="control-label" for="minlengthfield">Kelas</label>
		        		<div class="control-group">
							<div class="controls">:
		                	<?php
		                		echo $isi->kelas;
		                	?>
		                	<?php //echo  <p id="message"></p> ?>
							</div>
		        		</div>
		            </th></tr>
		    		<tr>
				            <th align="left">
		                		<label class="control-label" for="minlengthfield">Keterangan</label>
		                		<div class="control-group">
									<div class="controls">:
				                	<?php
				                		echo $isi->keterangan;
				                	?>
				                	<?php //echo  <p id="message"></p> ?>
									</div>
								</div>
							</th></tr>
				    <tr>
			            <th align="left">
	                		<label class="control-label" for="minlengthfield">Tgl. Kegiatan</label>
	                		<div class="control-group">
								<div class="control-group">
									<div class="controls">:
				                	<?php
				                		echo $CI->p_c->tgl_indo($isi->tanggalkegiatan);
				                	?>
				                	<?php //echo  <p id="message"></p> ?>
									</div>
								</div>
	                		</div>
			            </th>
			         </tr>
				    <th align="left">
		        		<label class="control-label" for="minlengthfield">Aktif</label>
		        		<div class="control-group">
							<div class="controls">:
		                	<?php
		                		echo $CI->p_c->cekaktif($isi->aktif)
		                	?>
		                	<?php //echo  <p id="message"></p> ?>
							</div>
		        		</div>
		            </th></tr>
		            </table
		            <hr/>
		            <table class="table table-bordered table-striped">
				    	<tr>
				            <th width="100">NIS</th>
				            <th>Nama</th>
				            <?php
				            	$pdv="";
					            foreach((array)$pengembangandirivariabel as $rowpdv) {
					            	if($pdv<>""){$pdv=$pdv.',';}
					            	echo "<th>".$rowpdv->pengembangandirivariabel."</th>";
					            	$pdv=$pdv.$rowpdv->replid;
					            }
				            ?>
				         </tr>
				         <?php
				         	 $rs="";
					         foreach((array)$siswa as $rowsiswa) {
					         	if($rs<>""){$rs=$rs.',';}
					         	echo "<tr align='center'>";
					         	echo "<td>".$rowsiswa->nis."</td>";
					         	echo "<td>".$rowsiswa->nama."</td>";
					         	foreach((array)$pengembangandirivariabel as $rowpdv2) {
					         		$sqln="SELECT nilai FROM ns_pengembangandirinilai WHERE idpembelajaranlaporan='".$isi->replid."' AND idsiswa='".$rowsiswa->replid."' AND idpengembangandirivariabel='".$rowpdv2->replid."'";
					         		$n=$CI->dbx->rows($sqln);
					         		if (isset($n)){
						         		$nilaipdv=$n->nilai;
					         		}else{
						         		$nilaipdv=0;
					         		}
					            	echo "<td><input type='text' name='".$rowpdv2->replid.'/'.$rowsiswa->replid."' value='".$nilaipdv."' style='width:50px;'></td>";
					            }
					         	echo "</tr>";
					         	$rs=$rs.$rowsiswa->replid;
					         }

				         ?>
		            </table>

		            <table>
				    <tr>
				            <th align="left">
				            	<input type="hidden" name="rs" value="<?php echo $rs ?>">
				            	<input type="hidden" name="pdv" value="<?php echo $pdv ?>">
				            	<?php if ($edit==0){ ?>
				            		<button class='btn btn-primary'>Simpan</button>
				            	<?php } else if (isset($n)){
					            	echo "<a href=javascript:void(window.open('".site_url('ns_pembelajaranlaporan/hapusnilai/'.$isi->replid)."')) class='btn btn-xs btn-danger'>Hapus Penilaian</a>";
				            	}else{
					            	echo "<a href=javascript:void(window.open('".site_url('ns_pembelajaranlaporan/hapus/'.$isi->replid)."')) class='btn btn-xs btn-danger fa fa-minus-square' ></a>";
				            	}
				            	?>
				            	<a href="javascript:void(window.open('<?php echo site_url("ns_pembelajaranlaporan") ?>'))" class="btn btn-success">Kembali</a>
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
