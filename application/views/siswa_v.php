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
                <section class="content-header">
                    <h1>
                        <?php echo $form ?>
                        <small>List Data</small>
                    </h1>

                    <ol class="breadcrumb">
                        <li><a href="<?php echo site_url('ns_pembelajaranjadwal/tambah'); ?>" target="_blank"><i class="fa fa-plus-square"></i> Tambah</a></li>
                        <!--
                        <li><a href="#"><i class="fa fa-file-text"></i>Cetak</a></li>
                        <li><a href="#"><i class="fa fa-file-excel-o"></i>Excel</a></li>
                        -->
                    </ol>
                </section>
                <section class="content-header">
                	<?php
			        $attributes = array('class' => 'form-horizontal form-validate', 'id' => 'form', 'method' => 'POST', 'novalidate'=>'novalidate','onsubmit'=>'return validate()');
		    	echo form_open($action,$attributes);
		    		?>
                	<table width="100%" border="0">
			            <tr>
                     <td align="left" width="150">Tahun Pelajaran</td>
                    <td align="left">
                      <?php
                          $arridtahunajaran="data-rule-required=false id=idtahunajaran onchange='javascript:this.form.submit();' ";
                          echo form_dropdown('idtahunajaran',$idtahunajaran_opt,$this->input->post('idtahunajaran'),$arridtahunajaran);
                        ?>
                    </td>
			            </tr>
			            <tr>
                    <td align="left" width="150">Kelas</td>
                   <td align="left">
                     <?php
                           $arridkelas="data-rule-required=false id=idkelas onchange='javascript:this.form.submit();' ";
                           echo form_dropdown('idkelas',$idkelas_opt,$this->input->post('idkelas') ,$arridkelas);
                       ?>
                   </td>
			            </tr>
			            <tr>
				            <th align="left" colspan="4">
				            	<button class='btn btn-primary' name='filter' value="1">Filter</button>
				            	<?php echo "<a href='".site_url($action)."'class='btn btn-danger'>Bersihkan</a>&nbsp;&nbsp;";?>
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
                                                <th>NIS</th>
                                                <th>Nama</th>
                                                <th>Status Program</th>
                                                <th>Regional</th>
                                                <th>ABK</th>
                                                <!-- <th>Regional</th> -->
                                                <th>Remedial Perilaku</th>
                                                <th>Keuangan</th>
                                                <th>Administrasi Siswa</th>
                                                <th>Aktif</th>
                                                <th width="80">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        	<?php
                                        	$no=1;
											foreach((array)$show_table as $row) {
                        //echo "<td align='center'>".strtoupper($CI->p_c->tgl_indo($row->tanggalkegiatan))."</td>";
											    echo "<tr>";
											    echo "<td align='center'>".$no++."</td>";
											    echo "<td align=''><a href='".site_url('ns_pembelajaranjadwal/penilaian/'.$row->replid)."/0' target='_blank'>".strtoupper($row->nis)."</a></td>";
											    echo "<td align=''>".strtoupper(trim($row->nama))."</td>";
                          echo "<td align=''>".strtoupper($row->kondisi_nm)."</td>";
											    echo "<td align=''>".strtoupper($row->region)."</td>";
                          echo "<td align='center'>".($CI->p_c->cekaktif($row->abk))."</td>";
											    echo "<td align='center'>".($CI->p_c->cekaktif($row->remedialperilaku))."</td>";
                          echo "<td align='center'></td>";
                          echo "<td align='center'></td>";
                          echo "<td align='center'>".$CI->p_c->cekaktif($row->aktif)."</td>";
											    echo "<td align='center'>";
                          //echo "<a href='".site_url('ns_pembelajaranjadwal/ubah/'.$row->replid)."' class='btn btn-xs btn-warning fa fa-check-square' target='_blank'></a>&nbsp;&nbsp;";
                          //echo "<a href='".site_url('ns_pembelajaranjadwal/hapus/'.$row->replid)."' class='btn btn-danger' id='btnOpenDialog'>Hapus</a></td>";
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
		var idregion = document.getElementById('idregion').value;
		var tanggalkegiatan = document.getElementById('dp1').value;
		if (idprosestipe==""){idprosestipe=0}
		if (idmatpel==""){idmatpel=0}
		if (idtahunajaran==""){idtahunajaran=0}
		if (idkelas==""){idkelas=0}
		if (idregion==""){idregion=0}


		if (ubah==1){
			document.location.href = "<?php echo site_url('ns_pembelajaranjadwal/ubah/'.$isi->replid) ?>/"+idprosestipe+"/"+idmatpel+"/"+idtahunajaran+"/"+idkelas+"/"+tanggalkegiatan+"/"+idregion;
		}else{
			document.location.href = "<?php echo site_url('ns_pembelajaranjadwal/tambah') ?>/"+idprosestipe+"/"+idmatpel+"/"+idtahunajaran+"/"+idkelas+"/"+tanggalkegiatan+"/"+idregion;
		}

	}
</script>
<section class="content-header">
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
		                		$arridkelas="data-rule-required=true onchange=refresh(".$edit.") id=idkelas";
		                		echo form_dropdown('idkelas',$idkelas_opt,$idkelas,$arridkelas);
		                	?>
		                	<?php //echo  <p id="message"></p> ?>
							</div>
		        		</div>
		            </th></tr>
                <tr>
		            <th align="left">
		        		<label class="control-label" for="minlengthfield">Semester</label>
		        		<div class="control-group">
							<div class="controls">:
		                	<?php
		                		$arridperiode="data-rule-required=true id=idperiode";
		                		echo form_dropdown('idperiode',$idperiode_opt,$isi->idperiode,$arridperiode);
		                	?>
		                	<?php //echo  <p id="message"></p> ?>
							</div>
		        		</div>
		            </th></tr>
                <!--
		            <tr>
		            <th align="left">
		        		<label class="control-label" for="minlengthfield">Regional</label>
		        		<div class="control-group">
							<div class="controls">:
		                	<?php
		                		if($idregion2==""){$idregion=$isi->idregion;}else{$idregion=$idregion2;}
		                		$arridregion="data-rule-required=true id=idregion";
		                		echo form_dropdown('idregion',$idregion_opt,$idregion,$arridregion);
		                	?>
		                	<?php //echo  <p id="message"></p> ?>
							</div>
		        		</div>
		            </th></tr>
              -->
                <tr>
                  <th align="left">
                  <label class="control-label" for="minlengthfield">Tipe Proses</label>
                  <div class="control-group">
                <div class="controls">:
                        <?php
                          if($idprosestipe2==""){$idprosestipe=$isi->idprosestipe;}else{$idprosestipe=$idprosestipe2;}
                          $arridprosestipe="data-rule-required=true id=idprosestipe";
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
                    <input type="hidden" value="" name="idregion" id="idregion">
  							<div class="controls">:
  		                	<?php
                        //onchange=refresh(".$edit.")
  		                		if($idmatpel2==""){$idmatpel=$isi->idmatpel;}else{$idmatpel=$idmatpel2;}
  		                		$arridmatpel="data-rule-required=true id=idmatpel";
  		                		echo form_dropdown('idmatpel',$idmatpel_opt,$idmatpel,$arridmatpel);
  		                	?>
  		                	<?php //echo  <p id="message"></p> ?>
  							</div>
  		        		</div>
  		            </th></tr>
		    		<tr>
				            <th align="left">
		                		<label class="control-label" for="minlengthfield">Tema</label>
		                		<div class="control-group">
									<div class="controls" valign="top">&nbsp;&nbsp;
				                	<?php
				                		//if($keterangan2==""){$keterangan=$isi->keterangan;}else{$keterangan=$keterangan2;}
				                		echo form_textarea(array('class' => '', 'id' => 'keterangan','name'=>'keterangan','value'=>$isi->keterangan,'data-rule-required'=>'false' ,'data-rule-maxlength'=>'500', 'data-rule-minlength'=>'2' ,'placeholder'=>'Masukkan 2-500 Karakter'));
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
			                		echo form_input(array('class' => '', 'id' => 'dp1','name'=>'tanggalkegiatan','value'=>$CI->p_c->tgl_form($tanggalkegiatan),'data-rule-required'=>'false' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'2' ,'placeholder'=>'DD-MM-YYYY'));
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th>
			         </tr>
		            <tr>
		            <th align="left">
		        		<label class="control-label" for="minlengthfield">Rapor Tipe</label>
		        		<div class="control-group">
		        			<div class="controls">
			                	<input type="checkbox" onClick="selectallx('idrapottipe','selectall')" id="selectall" class="selectall"/> Pilih Semua <hr/>
		                	<?php
		                		$CI->p_c->checkbox_one('idrapottipe',$idrapottipe_opt);
		                	?>
		                	<?php //echo  <p id="message"></p> ?>
							</div>
		        		</div>
		            </th></tr>
                <tr>
		            	<th align="left">
		        		<label class="control-label" for="minlengthfield">Non Reguler</label>
		        		<div class="control-group">
							<div class="controls">:
		                	<?php
		                		$fcdata=array('name'=>'nonreguler','id'=>'nonreguler','value'=>'1','checked'=>$isi->nonreguler);
		                		echo form_checkbox($fcdata);
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
				            	<a href="<?php echo site_url("ns_pembelajaranjadwal") ?>" class="btn btn-success">Kembali</a>
				            </th>
				    </tr>
		            </table>
		        	<?php
		        	echo form_close();
		        	?>
	    </section>
<!-------------------------------------------------------------------------------------------------------------------------------------->
<?php } elseif($view=='penilaian'){ ?>
<section class="content-header">
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
                <!--
                <tr>
		            <th align="left">
		        		<label class="control-label" for="minlengthfield">Region</label>
		        		<div class="control-group">
							<div class="controls">:
		                	<?php
		                		echo $isi->region;
		                	?>
		                	<?php //echo  <p id="message"></p> ?>
							</div>
		        		</div>
		            </th></tr>
              -->
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
		        		<label class="control-label" for="minlengthfield">KKM</label>
		        		<div class="control-group">
							<div class="controls">:
		                	<?php
		                		echo $isi->kkm;
		                	?>
							</div>
		        		</div>
		            </th></tr>
		    		<tr>
				            <th align="left">
		                		<label class="control-label" for="minlengthfield">Tema</label>
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
		                		<label class="control-label" for="minlengthfield">Semester</label>
		                		<div class="control-group">
									<div class="controls">:
				                	<?php
				                		echo $isi->periode;
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
		            <tr>
		            <th align="left">
		        		<label class="control-label" for="minlengthfield">Rapor Tipe</label>
		        		<div class="control-group">
		        			<div class="controls">
		                	<?php
		                		$CI->p_c->checkbox_one('idrapottipe',$idrapottipe_opt,"disabled");
		                	?>
		                	<?php //echo  <p id="message"></p> ?>
							</div>
		        		</div>
		            </th></tr>
                <tr>
				    <th align="left">
		        		<label class="control-label" for="minlengthfield">Non Reguler</label>
		        		<div class="control-group">
							<div class="controls">:
		                	<?php
		                		echo $CI->p_c->cekaktif($isi->nonreguler)
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
		                		echo $CI->p_c->cekaktif($isi->aktif)
		                	?>
		                	<?php //echo  <p id="message"></p> ?>
							</div>
		        		</div>
		            </th></tr>
                <tr>
    			            <th align="left">
    	                		<label class="control-label" for="minlengthfield">Petugas</label>
    	                		<div class="control-group">
    								<div class="control-group">
    									<div class="controls">:
    				                	<?php
    				                		echo $CI->p_c->tgl_indo($isi->created_date);
                                echo " Oleh [".$isi->modified_by."] ".$CI->dbx->namapegawai($isi->created_by);
    				                	?>
    				                	<?php //echo  <p id="message"></p> ?>
    									</div>
    								</div>
    	                		</div>
    			            </th>
    			         </tr>
                <tr>
    			            <th align="left">
    	                		<label class="control-label" for="minlengthfield">Tgl. Revisi</label>
    	                		<div class="control-group">
    								<div class="control-group">
    									<div class="controls">:
    				                	<?php
    				                		echo $CI->p_c->tgl_indo($isi->modified_date);
                                echo " Oleh [".$isi->modified_by."] ".$CI->dbx->namapegawai($isi->modified_by);
    				                	?>
    				                	<?php //echo  <p id="message"></p> ?>
    									</div>
    								</div>
    	                		</div>
    			            </th>
    			         </tr>
		            </table>
		            <hr/>
                <p align="left"><b>Legend : D=Terdaftar, A= Alpha, S=Sakit, I= Izin, TP=Tugas Pengganti</b></p>
                <hr/>
		            <table class="table table-bordered table-striped">
				    	<tr>
				            <th width="30">No.</th>
				            <th width="80">NIS</th>
				            <th>Nama</th>
				            <th width="30">D</th>
                    <th width="30">A</th>
                    <th width="30">S</th>
                    <th width="30">I</th>
                    <th width="30">TP</th>
				            <?php
				            	$pdv="";
					            foreach((array)$pengembangandirivariabel as $rowpdv) {
					            	if($pdv<>""){$pdv=$pdv.',';}
					            	echo "<th>".ucwords(strtolower($rowpdv->pengembangandirivariabel))."</th>";
					            	$pdv=$pdv.$rowpdv->replid;
					            }
				            ?>
				         </tr>
				         <?php
				         	 $rs="";$no=1;
					         foreach((array)$siswa as $rowsiswa) {
                     if($isi->nonreguler<>1){
                       $idregionsiswa=$rowsiswa->siswaregion;
                     }else{
                       $idregionsiswa=$rowsiswa->regionalstatus;
                     }

                     if ($rowsiswa->region<>""){
                        $idregionpdn=$rowsiswa->region;
                     }else{
                        $idregionpdn=$idregionsiswa;
                     }

					         	if($rs<>""){$rs=$rs.',';}
					         	echo "<tr align='center'>";
					         	echo "<td>".$no++."</td>";
					         	echo "<td>".$rowsiswa->nis
                                      ."<input type='hidden' name='idregion".$rowsiswa->replid."' id='idregion".$rowsiswa->replid."' value='".$idregionpdn."'>"
                                      ."<input type='hidden' name='idregionsiswa".$rowsiswa->replid."' id='idregionsiswa".$rowsiswa->replid."' value='".$idregionsiswa."'>
                             </td>";
					         	echo "<td><b>".$rowsiswa->nama."</b><br/>Regional: ".$rowsiswa->regiontext." <br/> Tgl. Msk : ".$CI->p_c->tgl_indo($rowsiswa->tgl_masuk)."</td>";
                    /*
                    if ($edit==1){
						        	$fcdata=array('name'=>'ubahregion'.$rowsiswa->replid,'id'=>'ubahregion','value'=>'1','checked'=>$value);
					         	}
                    */
					         	echo "<td>";

					         	$value=0;$readonly="";
					         	if ($rowsiswa->terdaftar==""){
						         	if ($edit==1){
							        	$value=$rowsiswa->dftr;
						         	}
						        }else{
						         	$value=$rowsiswa->terdaftar;
					         	}

					         	if ($edit==1){
						        	$fcdata=array('name'=>'terdaftar'.$rowsiswa->replid,'id'=>'terdaftar','value'=>'1','checked'=>$value);
					         	}else{
						         	$fcdata=array('name'=>'terdaftar'.$rowsiswa->replid,'id'=>'terdaftar','value'=>'1','checked'=>$value,'disabled'=>'disabled');
					         	}
		                		echo form_checkbox($fcdata);
					         	echo "</td>";
                    echo "<td>"; // alpha
					         	$valuealpha=0;$readonlyalpha="";
					         	if ($rowsiswa->alpha==""){
						         	if ($edit==1){
							        	$valuealpha=$rowsiswa->alpha;
						         	}
						        }else{
						         	$valuealpha=$rowsiswa->alpha;
					         	}

					         	if ($edit==1){
						        	$fcdata=array('name'=>'alpha'.$rowsiswa->replid,'id'=>'alpha','value'=>'1','checked'=>$valuealpha);
					         	}else{
						         	$fcdata=array('name'=>'alpha'.$rowsiswa->replid,'id'=>'alpha','value'=>'1','checked'=>$valuealpha,'disabled'=>'disabled');
					         	}
		                echo form_checkbox($fcdata);
					         	echo "</td>";
                    echo "<td>"; // sakit
					         	$valuesakit=0;$readonlysakit="";
					         	if ($rowsiswa->sakit==""){
						         	if ($edit==1){
							        	$valuesakit=$rowsiswa->sakit;
						         	}
						        }else{
						         	$valuesakit=$rowsiswa->sakit;
					         	}

					         	if ($edit==1){
						        	$fcdata=array('name'=>'sakit'.$rowsiswa->replid,'id'=>'sakit','value'=>'1','checked'=>$valuesakit);
					         	}else{
						         	$fcdata=array('name'=>'sakit'.$rowsiswa->replid,'id'=>'sakit','value'=>'1','checked'=>$valuesakit,'disabled'=>'disabled');
					         	}
		                echo form_checkbox($fcdata);
					         	echo "</td>";
                    echo "<td>"; // izin
					         	$valueizin=0;$readonlyizin="";
					         	if ($rowsiswa->izin==""){
						         	if ($edit==1){
							        	$valueizin=$rowsiswa->izin;
						         	}
						        }else{
						         	$valueizin=$rowsiswa->izin;
					         	}

					         	if ($edit==1){
						        	$fcdata=array('name'=>'izin'.$rowsiswa->replid,'id'=>'izin','value'=>'1','checked'=>$valueizin);
					         	}else{
						         	$fcdata=array('name'=>'izin'.$rowsiswa->replid,'id'=>'izin','value'=>'1','checked'=>$valueizin,'disabled'=>'disabled');
					         	}
		                echo form_checkbox($fcdata);
					         	echo "</td>";
                    echo "<td>"; // Tugas Pengganti
					         	$valuetugas=0;$readonlytugas="";
					         	if ($rowsiswa->tugas==""){
						         	if ($edit==1){
							        	$valuetugas=$rowsiswa->tugas;
						         	}
						        }else{
						         	$valuetugas=$rowsiswa->tugas;
					         	}

					         	if ($edit==1){
						        	$fcdata=array('name'=>'tugas'.$rowsiswa->replid,'id'=>'tugas','value'=>'1','checked'=>$valuetugas);
					         	}else{
						         	$fcdata=array('name'=>'tugas'.$rowsiswa->replid,'id'=>'tugas','value'=>'1','checked'=>$valuetugas,'disabled'=>'disabled');
					         	}
		                echo form_checkbox($fcdata);
					         	echo "</td>";

					         	foreach((array)$pengembangandirivariabel as $rowpdv2) {
					         		$sqln="SELECT nilai FROM ns_pengembangandirinilai WHERE idpembelajaranjadwal='".$isi->replid."' AND idsiswa='".$rowsiswa->replid."' AND idpengembangandirivariabel='".$rowpdv2->replid."'";
					         		$n=$CI->dbx->rows($sqln);
					         		if (isset($n)){
						         		$nilaipdv=$n->nilai;
					         		}else{
						         		$nilaipdv=0;
					         		}
					         		if ($edit==1){
					            		echo "<td><input type='text' name='jml".$rowpdv2->replid.'/'.$rowsiswa->replid."' value='".$nilaipdv."' style='width:50px;'></td>";
					            	}else{
					            		$bg="";
					            		if ($nilaipdv>100){$bg=" style='background-color:red !important;' ";}
						            	echo "<td ".$bg."><b>".$nilaipdv."</b></td>";

					            	}
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
				            	<?php if ($edit==1){ ?>
				            		<button class='btn btn-primary'>Simpan</button>
				            	<?php }
                        //else if (isset($n)){
                          else if ($isi->aktiftahunajaran==1){
                            if ((trim($isi->created_by)==$this->session->userdata('idpegawai')) or (($isi->nipwali==$this->session->userdata('idpegawai')) AND ($isi->nilaiwali==1))){
  						            	//	echo "<a href='".site_url('ns_pembelajaranjadwal/hapusnilai/'.$isi->replid)."' class='btn btn-xs btn-danger'>Hapus Penilaian</a> ";
  						            	//}
                          //}
					            	//}else{
                              echo "<a href='".site_url('ns_pembelajaranjadwal/penilaian/'.$isi->replid)."/1' class='btn btn-xs btn-info'>
                                    Penilaian
                                  </a> ";

                            if (trim($isi->created_by)==$this->session->userdata('idpegawai')){
						            		          echo "<a href='".site_url('ns_pembelajaranjadwal/ubah/'.$isi->replid)."' class='btn btn-xs btn-warning fa fa-check-square' target='_blank'></a>&nbsp;&nbsp;";
						            		          echo "<a href='".site_url('ns_pembelajaranjadwal/hapus/'.$isi->replid)."' class='btn btn-xs btn-danger fa fa-minus-square' target='_blank'></a>";
                            }
						            	}
					            	}
				            	?>
				            	<a href="<?php echo site_url("ns_pembelajaranjadwal") ?>" class="btn btn-success">Kembali</a>
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
