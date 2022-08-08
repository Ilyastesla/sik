<!DOCTYPE html>
<html>
    <?php $this->load->view('header') ?>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas">
            <?php $this->load->view('menu_v') ?>
            </aside>
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        <?php echo $form ?>
                     </h1>
                    <!--
                    <ol class="breadcrumb">
                        <li><a href="main"><i class="fa fa-dashboard"></i> Home</h4><hr/>
                        <li><a href="#">Tables</h4><hr/>
                        <li class="active">Data tables</li>
                    </ol>
                    -->
                </section>

                <!-- Main content -->
                <section class="content">
                    <?php $CI =& get_instance();?>

                    <?php if($view=='datadiri'){?>
	                <h4>Data Diri</h4><hr/>
	                <?php
		                $attributes = array('class' => 'form-horizontal form-validate', 'id' => 'form', 'method' => 'POST', 'novalidate'=>'novalidate');
	                	echo form_open($action,$attributes);
	                ?>
	                <table width="100%" border="0">
	                	<tr><th width="150">
	                			<label class="control-label" for="minlengthfield">No. KTP</label>
	                			<div class="control-group">
									<div class="controls">:
                    <?php
                      if($this->session->userdata('idregistrasi')<>""){
                          echo $header->noktp;
                          echo "<input type='hidden' name='noktp' value='".$header->noktp."'>";
                      }else{
                          echo form_input(array('class' => '', 'id' => 'noktp','name'=>'noktp','value'=>$header->noktp,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'16', 'data-rule-minlength'=>'16' ,'placeholder'=>'Masukkan 16 Karakter'));
                      }
                    ?>
									</div>
								</div>
	                		</th>
	                	</tr>
			            <tr>
			            <th align="left">
	                		<label class="control-label" for="minlengthfield">Nama</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		echo form_input(array('class' => '', 'id' => 'gelarawal','name'=>'gelarawal','value'=>$header->gelarawal,'data-rule-required'=>'false' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'1' ,'placeholder'=>'Gelar Awal'));
			                		echo "&nbsp;".form_input(array('class' => '', 'id' => 'nama','name'=>'nama','value'=>$header->nama,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'3' ,'placeholder'=>'Nama Lengkap'));
			                		echo "&nbsp;".form_input(array('class' => '', 'id' => 'gelarakhir','name'=>'gelarakhir','value'=>$header->gelarakhir,'data-rule-required'=>'false' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'1' ,'placeholder'=>'Gelar Akhir'));

			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th></tr>
			            <tr>
			            <th align="left">
	                		<label class="control-label" for="minlengthfield">Jenis Kelamin</label>
	                		<div class="control-group">
          								<div class="controls">:
                                  <?php
                                    $arrkelamin='data-rule-required=true';
                                    $kelamin_opt=array(''=>'pilih..','L'=>'Laki-Laki','P'=>'Perempuan');
                                    echo form_dropdown('kelamin',$kelamin_opt,$header->kelamin,$arrkelamin);
                                  ?>
          			                	<?php //echo  <p id="message"></p> ?>
          								</div>
	                		</div>
			            </th></tr>
			            <tr>
			            <th align="left">
	                		<label class="control-label" for="minlengthfield">Tempat Lahir</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		echo form_input(array('class' => '', 'id' => 'tmplahir','name'=>'tmplahir','value'=>$header->tmplahir,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'2' ,'placeholder'=>'Masukkan 2-100 Karakter'));
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th></tr>
			            <tr>
			            <th align="left">
	                		<label class="control-label" for="minlengthfield">Tanggal Lahir</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		echo form_input(array('class' => '', 'id' => 'dp1','name'=>'tgllahir','value'=>$CI->p_c->tgl_form($header->tgllahir),'data-rule-required'=>'true' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'2' ,'placeholder'=>'DD-MM-YYYY'));
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th></tr>
                    <tr><th><h4>Informasi Kontak (Domisili Saat Ini)</h4><hr/></th></tr>
	                	<tr>
			            <th align="left">
	                		<label class="control-label" for="minlengthfield">Alamat Tinggal</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		echo form_textarea(array('class' => '', 'id' => 'alamat_tinggal','name'=>'alamat_tinggal','value'=>$header->alamat_tinggal,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'500', 'data-rule-minlength'=>'2' ,'placeholder'=>'Masukkan 2-500 Karakter','size'=>'15'));
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th></tr>
			            <tr>
			            <th align="left">
	                		<label class="control-label" for="minlengthfield">Kecamatan</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		echo form_input(array('class' => '', 'id' => 'kecamatan','name'=>'kecamatan','value'=>$header->kecamatan,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'200', 'data-rule-minlength'=>'2' ,'placeholder'=>'Masukkan 2-200 Karakter'));
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th></tr>
			            <tr>
			            <th align="left">
	                		<label class="control-label" for="minlengthfield">Kota</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		echo form_input(array('class' => '', 'id' => 'kota','name'=>'kota','value'=>$header->kota,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'200', 'data-rule-minlength'=>'2' ,'placeholder'=>'Masukkan 2-200 Karakter'));
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th></tr>
			            <th align="left">
	                		<label class="control-label" for="minlengthfield">Provinsi</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		echo form_input(array('class' => '', 'id' => 'provinsi','name'=>'provinsi','value'=>$header->provinsi,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'200', 'data-rule-minlength'=>'2' ,'placeholder'=>'Masukkan 2-200 Karakter'));
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th></tr>
			            <tr>
			            <th align="left">
	                		<label class="control-label" for="minlengthfield">Kode Pos</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		echo form_input(array('class' => '', 'id' => 'kode_pos','name'=>'kode_pos','value'=>$header->kode_pos,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'200', 'data-rule-minlength'=>'2','data-rule-number'=>'true' ,'placeholder'=>'Masukkan 2-200 Karakter'));
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th></tr>
			            <tr>
			            <th align="left">
	                		<label class="control-label" for="minlengthfield">Negara</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		$arrneg='data-rule-required=true';
			                		echo form_dropdown('negara',$type_negara_opt,$header->negara,$arrneg);
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th></tr>
			            <tr>
			            <th align="left">
	                		<label class="control-label" for="minlengthfield">Tinggal Sejak</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		echo form_input(array('class' => '', 'id' => 'dp2','name'=>'tinggal_sejak','value'=>$CI->p_c->tgl_form($header->tinggal_sejak),'data-rule-required'=>'true' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'2' ,'placeholder'=>'DD-MM-YYYY'));
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th></tr>


			            <tr><th><hr style="border-width:2px;"/></th></tr>
			            <tr>
			            <th align="left">
	                		<label class="control-label" for="minlengthfield">No. Telepon</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		echo form_input(array('class' => '', 'id' => 'telepon','name'=>'telepon','value'=>$header->telepon,'data-rule-required'=>'false' ,'data-rule-maxlength'=>'200', 'data-rule-minlength'=>'2' ,'placeholder'=>'Masukkan 2-200 Karakter'));
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th></tr>
			            <tr>
			            <th align="left">
	                		<label class="control-label" for="minlengthfield">No. Handphone</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		echo form_input(array('class' => '', 'id' => 'handphone','name'=>'handphone','value'=>$header->handphone,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'200', 'data-rule-minlength'=>'2' ,'placeholder'=>'Masukkan 2-200 Karakter'));
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th></tr>
			            <tr>
			            <th align="left">
	                		<label class="control-label" for="minlengthfield">No. Handphone 2</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		echo form_input(array('class' => '', 'id' => 'handphone2','name'=>'handphone2','value'=>$header->handphone2,'data-rule-required'=>'false' ,'data-rule-maxlength'=>'200', 'data-rule-minlength'=>'2' ,'placeholder'=>'Masukkan 2-200 Karakter'));
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th></tr>
			             <tr><th><hr style="border-width:2px;"/></th></tr>
			            <tr>
			            <th align="left">
	                		<label class="control-label" for="minlengthfield">Email</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		echo form_input(array('class' => '', 'id' => 'email','name'=>'email','value'=>$header->email,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'200', 'data-rule-minlength'=>'2','data-rule-email'=>'true' ,'placeholder'=>'Masukkan 2-100 Karakter'));
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th></tr>
                  <tr>
			            <th align="left">
	                		<label class="control-label" for="minlengthfield">Linked In</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		echo form_input(array('class' => '', 'id' => 'linkedin','name'=>'linkedin','value'=>$header->linkedin,'data-rule-required'=>'false' ,'data-rule-maxlength'=>'200', 'data-rule-minlength'=>'2' ,'placeholder'=>'Masukkan 2-200 Karakter'));
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th></tr>
                  <tr>
			            <th align="left">
	                		<label class="control-label" for="minlengthfield">Instagram</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		echo form_input(array('class' => '', 'id' => 'instagram','name'=>'instagram','value'=>$header->instagram,'data-rule-required'=>'false' ,'data-rule-maxlength'=>'200', 'data-rule-minlength'=>'2' ,'placeholder'=>'Masukkan 2-200 Karakter'));
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th></tr>
                  </table>
                  <table width="100%">
                  <tr><th>
                  <hr style="border-width:2px;"/></th></tr>
                  <tr>
                    <td align='left'>
	                	<button class='btn btn-primary'>Simpan</button>
	                	<a href="<?php echo site_url('registrasi/ubah/') ?>" class='btn btn-warning'>Kembali</a>
	                	<a href="<?php echo site_url('registrasi') ?>" class="btn btn-success">Batal</a>
                  </td>
                </tr>
              </table>
	                	<?php
	                echo form_close();
	                }elseif($view=='pendidikan'){?>
	                <h4>Pendidikan Formal</h4><hr/>
	                <?php
		                $attributes = array('class' => 'form-horizontal form-validate', 'id' => 'form', 'method' => 'POST', 'novalidate'=>'novalidate');
	                	?>
	                	<section class="content-header" align="right">
		                    <ol class="breadcrumb">
		                        <li><a href="<?php echo site_url('registrasi/tambahpendidikan/'); ?>"><i class="fa fa-plus-square"></i> Tambah</a></li>
		                    </ol>
		                </section>

	                	<table id="example2" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Jenjang Pendidikan</th>
                                    <th>Institusi</th>
                                    <th>Fakultas</th>
                                    <th>Jurusan</th>
                                    <th>Tahun Masuk</th>
                                    <th>Tahun Keluar</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            	<?php
                            	$CI =& get_instance();
								foreach((array)$pendidikan as $rowx) {
								    echo "<tr>";
								    	echo "<td align='center'>".$rowx->jenjang."</td>";
								    	echo "<td align='center'>".$rowx->institusi."</td>";
								    	echo "<td align='center'>".$rowx->fakultas."</td>";
								    	echo "<td align='center'>".$rowx->jurusan."</td>";
									    echo "<td align='center'>".$rowx->tahun_masuk."</td>";
									    echo "<td align='center'>".$rowx->tahun_keluar."</td>";
									    echo "<td align='center' width='150'>";
										echo '<a href='.site_url('registrasi/tambahpendidikan/'.$rowx->replid).' class="btn btn-warning">Ubah</a>';
									    echo '&nbsp;&nbsp;<a href='.site_url('registrasi/hapuspendidikan/'.$rowx->replid).'  class="btn btn-danger">Hapus</a>';
									    echo "</td>";
								    echo "</tr>";
								}
								?>
                            </tbody>
                            <tfoot>
                            </tfoot>
	                	</table>

	                	<a href="<?php echo site_url('registrasi') ?>" class='btn btn-warning'>Kembali</a>
	                	<a href="<?php echo site_url('registrasi/ubahpendidikan_nf/') ?>" class="btn btn-primary">Lanjut</a>
	                	<a href="<?php echo site_url('registrasi') ?>" class="btn btn-success">Batal</a>
	                	<?php
	                }
	                elseif($view=='tambah_pendidikan'){?>
	                <h4>Pendidikan Formal</h4><hr/>
	                <?php
		                $attributes = array('class' => 'form-horizontal form-validate', 'id' => 'form', 'method' => 'POST', 'novalidate'=>'novalidate');
	                	echo form_open($action,$attributes);
	                	?>
	                	<table width="100%" border="0">
	                	<tr>
			            <th align="left">
	                		<label class="control-label" for="minlengthfield">Jenjang</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		$arrjenjang='data-rule-required=false';
			                		echo form_dropdown('jenjang',$type_jenjang_opt,$isi->jenjang,$arrjenjang);
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th></tr>
	                	<tr>
			            <th align="left">
	                		<label class="control-label" for="minlengthfield">Institusi</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		echo form_input(array('class' => '', 'id' => 'institusi','name'=>'institusi','value'=>$isi->institusi,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'500', 'data-rule-minlength'=>'2' ,'placeholder'=>'Masukkan 2-500 Karakter','size'=>'15'));
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th></tr>
			            <tr>
			            <th align="left">
	                		<label class="control-label" for="minlengthfield">Fakultas</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		echo form_input(array('class' => '', 'id' => 'fakultas','name'=>'fakultas','value'=>$isi->fakultas,'data-rule-required'=>'false' ,'data-rule-maxlength'=>'500', 'data-rule-minlength'=>'2' ,'placeholder'=>'Masukkan 2-500 Karakter','size'=>'15'));
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th></tr>
			            <tr>
			            <th align="left">
	                		<label class="control-label" for="minlengthfield">Jurusan</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		echo form_input(array('class' => '', 'id' => 'jurusan','name'=>'jurusan','value'=>$isi->jurusan,'data-rule-required'=>'false' ,'data-rule-maxlength'=>'500', 'data-rule-minlength'=>'2' ,'placeholder'=>'Masukkan 2-500 Karakter','size'=>'15'));
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th></tr>
	                	<tr>
			            <th align="left">
	                		<label class="control-label" for="minlengthfield">Tahun Masuk</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		echo form_input(array('class' => '', 'id' => 'tahun_masuk','name'=>'tahun_masuk','value'=>$isi->tahun_masuk,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'4', 'data-rule-minlength'=>'4','data-rule-number'=>'true','placeholder'=>'Masukkan 4 Karakter','size'=>'15'));
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th></tr>
			            <tr>
			            <th align="left">
	                		<label class="control-label" for="minlengthfield">Tahun Keluar</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		echo form_input(array('class' => '', 'id' => 'tahun_keluar','name'=>'tahun_keluar','value'=>$isi->tahun_keluar,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'4', 'data-rule-minlength'=>'4','data-rule-number'=>'true','placeholder'=>'Masukkan 4 Karakter','size'=>'15'));
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th></tr>
                </table>
                  <table width="100%">
                    <tr><th>
                    <hr style="border-width:2px;"/></th></tr>
                    <tr>
                      <td align='left'>
                        <button class='btn btn-primary'>Simpan</button>
    	                	<a href="<?php echo site_url('registrasi/ubahpendidikan/') ?>" class="btn btn-success">Batal</a>
                    </td>
                  </tr>
                </table>

                    <?php echo form_close();
	                }
	                elseif($view=='pendidikan_nf'){?>
	                <h4>Pendidikan Non Formal</h4><hr/>
	                <?php
		                $attributes = array('class' => 'form-horizontal form-validate', 'id' => 'form', 'method' => 'POST', 'novalidate'=>'novalidate');
	                	?>
	                	<section class="content-header" align="right">
		                    <ol class="breadcrumb">
		                        <li><a href="<?php echo site_url('registrasi/tambahpendidikan_nf/'); ?>"><i class="fa fa-plus-square"></i> Tambah</a></li>
		                    </ol>
		                </section>

	                	<table id="example2" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Institusi</th>
                                    <!--
                                    <th>Tgl. Masuk</th>
                                    <th>Tgl. Keluar</th>
                                  -->
                                  <th>Tahun Masuk</th>
                                  <th>Tahun Keluar</th>
                                    <th>Jenis Kursus</th>
                                    <th>Dibiayai Oleh</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            	<?php
                            	$CI =& get_instance();
								foreach((array)$pendidikan_nf as $rowx) {
								    echo "<tr>";
								    	echo "<td align='center'>".$rowx->institusi."</td>";
								    	//echo "<td align='center'>".$CI->p_c->tgl_indo($rowx->tgl_masuk)."</td>";
								    	//echo "<td align='center'>".$CI->p_c->tgl_indo($rowx->tgl_keluar)."</td>";
                      echo "<td align='center'>".$rowx->tahun_masuk."</td>";
                      echo "<td align='center'>".$rowx->tahun_keluar."</td>";
                      echo "<td align='center'>".$rowx->keterangan."</td>";
								    	echo "<td align='center'>".$rowx->dibiayai."</td>";

									    echo "<td align='center' width='150'>";
										echo '<a href='.site_url('registrasi/tambahpendidikan_nf/'.$rowx->replid).' class="btn btn-warning">Ubah</a>';
									    echo '&nbsp;&nbsp;<a href='.site_url('registrasi/hapuspendidikan_nf/'.$rowx->replid).'  class="btn btn-danger">Hapus</a>';
									    echo "</td>";
								    echo "</tr>";
								}
								?>
                            </tbody>
                            <tfoot>
                            </tfoot>
	                	</table>

	                	<a href="<?php echo site_url('registrasi/ubahpendidikan/') ?>" class='btn btn-warning'>Kembali</a>
	                	<a href="<?php echo site_url('registrasi/ubahbahasa/') ?>" class="btn btn-primary">Lanjut</a>
	                	<a href="<?php echo site_url('registrasi') ?>" class="btn btn-success">Batal</a>
	                	<?php
	                }
	                elseif($view=='tambah_pendidikan_nf'){?>
	                <h4>Pendidikan Non Formal</h4><hr/>
	                <?php
		                $attributes = array('class' => 'form-horizontal form-validate', 'id' => 'form', 'method' => 'POST', 'novalidate'=>'novalidate');
	                	echo form_open($action,$attributes);
	                	?>
	                	<table width="100%" border="0">
			            <tr>
			            <th align="left">
	                		<label class="control-label" for="minlengthfield">Institusi</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		echo form_input(array('class' => '', 'id' => 'institusi','name'=>'institusi','value'=>$isi->institusi,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'500', 'data-rule-minlength'=>'2' ,'placeholder'=>'Masukkan 2-500 Karakter','size'=>'15'));
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th></tr>
                  <!--
			            <tr>
				            <th align="left">
		                		<label class="control-label" for="minlengthfield">Tgl. Masuk</label>
		                		<div class="control-group">
									<div class="controls">:
				                	<?php
				                		echo form_input(array('class' => '', 'id' => 'dp1','name'=>'tgl_masuk','value'=>$CI->p_c->tgl_form($isi->tgl_masuk),'data-rule-required'=>'true' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'2' ,'placeholder'=>'DD-MM-YYYY'));
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
				                		echo form_input(array('class' => '', 'id' => 'dp2','name'=>'tgl_keluar','value'=>$CI->p_c->tgl_form($isi->tgl_keluar),'data-rule-required'=>'true' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'2' ,'placeholder'=>'DD-MM-YYYY'));
				                	?>
				                	<?php //echo  <p id="message"></p> ?>
									</div>
		                		</div>
				            </th>
				         </tr>
               -->
               <tr>
             <th align="left">
                 <label class="control-label" for="minlengthfield">Tahun Masuk</label>
                 <div class="control-group">
           <div class="controls">:
                   <?php
                     echo form_input(array('class' => '', 'id' => 'tahun_masuk','name'=>'tahun_masuk','value'=>$isi->tahun_masuk,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'4', 'data-rule-minlength'=>'4','data-rule-number'=>'true','placeholder'=>'Masukkan 4 Karakter','size'=>'15'));
                   ?>
                   <?php //echo  <p id="message"></p> ?>
           </div>
                 </div>
             </th></tr>
             <tr>
             <th align="left">
                 <label class="control-label" for="minlengthfield">Tahun Keluar</label>
                 <div class="control-group">
           <div class="controls">:
                   <?php
                     echo form_input(array('class' => '', 'id' => 'tahun_keluar','name'=>'tahun_keluar','value'=>$isi->tahun_keluar,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'4', 'data-rule-minlength'=>'4','data-rule-number'=>'true','placeholder'=>'Masukkan 4 Karakter','size'=>'15'));
                   ?>
                   <?php //echo  <p id="message"></p> ?>
           </div>
                 </div>
             </th></tr>
				         <tr>
				            <th align="left">
		                		<label class="control-label" for="minlengthfield">Jenis Kursus</label>
		                		<div class="control-group">
									<div class="controls">:
				                	<?php
				                		echo form_input(array('class' => '', 'id' => 'keterangan','name'=>'keterangan','value'=>$isi->keterangan,'data-rule-required'=>'false' ,'data-rule-maxlength'=>'500', 'data-rule-minlength'=>'2' ,'placeholder'=>'Masukkan 2-500 Karakter','size'=>'15'));
				                	?>
				                	<?php //echo  <p id="message"></p> ?>
									</div>
		                		</div>
				            </th></tr>
				         <tr>
				            <th align="left">
		                		<label class="control-label" for="minlengthfield">Dibiayai Oleh</label>
		                		<div class="control-group">
									<div class="controls">:
				                	<?php
				                		echo form_input(array('class' => '', 'id' => 'dibiayai','name'=>'dibiayai','value'=>$isi->dibiayai,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'500', 'data-rule-minlength'=>'2' ,'placeholder'=>'Masukkan 2-500 Karakter','size'=>'15'));
				                	?>
				                	<?php //echo  <p id="message"></p> ?>
									</div>
		                		</div>
				            </th></tr>
                  </table>
                    <table width="100%">
                      <tr><th>
                      <hr style="border-width:2px;"/></th></tr>
                      <tr>
                        <td align='left'>
                          <button class='btn btn-primary'>Simpan</button>
         	                	<a href="<?php echo site_url('registrasi/ubahpendidikan_nf/') ?>" class="btn btn-success">Batal</a>
                      </td>
                    </tr>
                  </table>

                    <?php echo form_close();
	                }
	                elseif($view=='bahasa'){?>
	                <h4>Kemampuan Bahasa</h4><hr/>
	                <?php
		                $attributes = array('class' => 'form-horizontal form-validate', 'id' => 'form', 'method' => 'POST', 'novalidate'=>'novalidate');
	                	?>
	                	<section class="content-header" align="right">
		                    <ol class="breadcrumb">
		                        <li><a href="<?php echo site_url('registrasi/tambahbahasa/'); ?>"><i class="fa fa-plus-square"></i> Tambah</a></li>
		                    </ol>
		                </section>

	                	<table id="example2" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Bahasa</th>
                                    <th>Bicara</th>
                                    <th>Menulis</th>
                                    <th>Membaca</th>
                                    <th>TOEFL</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            	<?php
                            	$CI =& get_instance();
								foreach((array)$bahasa as $rowx) {
								    echo "<tr>";
								    	echo "<td align='center'>".$rowx->bahasa."</td>";
								    	echo "<td align='center'>".$rowx->bicara."</td>";
										echo "<td align='center'>".$rowx->menulis."</td>";
										echo "<td align='center'>".$rowx->membaca."</td>";
										echo "<td align='center'>".$rowx->toefl."</td>";
									    echo "<td align='center' width='150'>";
										echo '<a href='.site_url('registrasi/tambahbahasa/'.$rowx->replid).' class="btn btn-warning">Ubah</a>';
									    echo '&nbsp;&nbsp;<a href='.site_url('registrasi/hapusbahasa/'.$rowx->replid).'  class="btn btn-danger">Hapus</a>';
									    echo "</td>";
								    echo "</tr>";
								}
								?>
                            </tbody>
                            <tfoot>
                            </tfoot>
	                	</table>

	                	<a href="<?php echo site_url('registrasi/ubahpendidikan_nf/') ?>" class='btn btn-warning'>Kembali</a>
	                	<a href="<?php echo site_url('registrasi/ubahkomputer/') ?>" class="btn btn-primary">Lanjut</a>
	                	<a href="<?php echo site_url('registrasi') ?>" class="btn btn-success">Batal</a>
	                	<?php
	                }
	                elseif($view=='tambah_bahasa'){?>
	                <h4>Kemampuan Bahasa</h4><hr/>
	                <?php
		                $attributes = array('class' => 'form-horizontal form-validate', 'id' => 'form', 'method' => 'POST', 'novalidate'=>'novalidate');
	                	echo form_open($action,$attributes);
	                	?>
	                	<table width="100%" border="0">
			            <tr>
			            <th align="left">
	                		<label class="control-label" for="minlengthfield">Bahasa</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		echo form_input(array('class' => '', 'id' => 'bahasa','name'=>'bahasa','value'=>$isi->bahasa,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'500', 'data-rule-minlength'=>'2' ,'placeholder'=>'Masukkan 2-500 Karakter','size'=>'15'));
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th></tr>
			            <tr>
			            <th align="left">
	                		<label class="control-label" for="minlengthfield">Bicara</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		$arrbahasa='data-rule-required=true';
			                		echo form_dropdown('bicara',$type_bahasa_opt,$isi->bicara,$arrbahasa);
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th></tr>
			            <tr>
			            <th align="left">
	                		<label class="control-label" for="minlengthfield">Menulis</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		$arrbahasa='data-rule-required=true';
			                		echo form_dropdown('menulis',$type_bahasa_opt,$isi->menulis,$arrbahasa);
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th></tr>
			            <tr>
			            <th align="left">
	                		<label class="control-label" for="minlengthfield">Membaca</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		$arrbahasa='data-rule-required=true';
			                		echo form_dropdown('membaca',$type_bahasa_opt,$isi->membaca,$arrbahasa);
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th></tr>
			            <tr>
			            <th align="left">
	                		<label class="control-label" for="minlengthfield">TOEFL</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		echo form_input(array('class' => '', 'id' => 'toefl','name'=>'toefl','value'=>$isi->toefl,'data-rule-required'=>'false' ,'data-rule-maxlength'=>'4', 'data-rule-minlength'=>'1','data-rule-number'=>'true','placeholder'=>'Masukkan 1-4 Karakter','size'=>'15'));
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th></tr>
                </table>
                  <table width="100%">
                    <tr><th>
                    <hr style="border-width:2px;"/></th></tr>
                    <tr>
                      <td align='left'>
                        <button class='btn btn-primary'>Simpan</button>
       	                	<a href="<?php echo site_url('registrasi/ubahbahasa/') ?>" class="btn btn-success">Batal</a>
                    </td>
                  </tr>
                </table>

                    <?php echo form_close();
	                }
	                elseif($view=='komputer'){?>
	                <h4>Kemampuan Komputer</h4><hr/>
	                <?php
		                $attributes = array('class' => 'form-horizontal form-validate', 'id' => 'form', 'method' => 'POST', 'novalidate'=>'novalidate');
	                	?>
	                	<section class="content-header" align="right">
		                    <ol class="breadcrumb">
		                        <li><a href="<?php echo site_url('registrasi/tambahkomputer/'); ?>"><i class="fa fa-plus-square"></i> Tambah</a></li>
		                    </ol>
		                </section>

	                	<table id="example2" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Kemampuan Komputer</th>
                                    <th>Bidang</th>
                                    <th>Tingkatan</th>
                                    <th>Keterangan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            	<?php
                            	$CI =& get_instance();
								foreach((array)$komputer as $rowx) {
								    echo "<tr>";
								    	echo "<td align='center'>".$rowx->komputer."</td>";
								    	echo "<td align='center'>".$rowx->bidang."</td>";
										echo "<td align='center'>".$rowx->tingkat."</td>";
										echo "<td align='center'>".$rowx->keterangan."</td>";
									    echo "<td align='center' width='150'>";
										echo '<a href='.site_url('registrasi/tambahkomputer/'.$rowx->replid).' class="btn btn-warning">Ubah</a>';
									    echo '&nbsp;&nbsp;<a href='.site_url('registrasi/hapuskomputer/'.$rowx->replid).'  class="btn btn-danger">Hapus</a>';
									    echo "</td>";
								    echo "</tr>";
								}
								?>
                            </tbody>
                            <tfoot>
                            </tfoot>
	                	</table>

	                	<a href="<?php echo site_url('registrasi/ubahpendidikan_nf/') ?>" class='btn btn-warning'>Kembali</a>
	                	<a href="<?php echo site_url('registrasi/ubahkerja/') ?>" class="btn btn-primary">Lanjut</a>
	                	<a href="<?php echo site_url('registrasi') ?>" class="btn btn-success">Batal</a>
	                	<?php
	                }
	                elseif($view=='tambah_komputer'){?>
	                <h4>Kemampuan Komputer</h4><hr/>
	                <?php
		                $attributes = array('class' => 'form-horizontal form-validate', 'id' => 'form', 'method' => 'POST', 'novalidate'=>'novalidate');
	                	echo form_open($action,$attributes);
	                	?>
	                	<table width="100%" border="0">
			            <tr>
			            <th align="left">
	                		<label class="control-label" for="minlengthfield">Kemampuan Komputer</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		echo form_input(array('class' => '', 'id' => 'komputer','name'=>'komputer','value'=>$isi->komputer,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'500', 'data-rule-minlength'=>'2' ,'placeholder'=>'Masukkan 2-500 Karakter','size'=>'15'));
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th></tr>
			            <tr>
			            <th align="left">
	                		<label class="control-label" for="minlengthfield">Bidang</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		$arrbidang='data-rule-required=true';
			                		echo form_dropdown('bidang',$type_komputer_opt,$isi->bidang,$arrbidang);
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th></tr>
			            <tr>
			            <th align="left">
	                		<label class="control-label" for="minlengthfield">Tingkat</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		$arrtingkat='data-rule-required=true';
			                		echo form_dropdown('tingkat',$type_tingkat_opt,$isi->tingkat,$arrtingkat);
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th></tr>
			            <tr>
			            <th align="left">
	                		<div class="control-group">
	                			<label class="control-label" for="minlengthfield">Keterangan</label>
								<div class="controls">:
			                	<?php
			                		echo form_textarea(array('class' => '', 'id' => 'keterangan','name'=>'keterangan','value'=>$isi->keterangan,'data-rule-required'=>'false' ,'data-rule-maxlength'=>'500', 'data-rule-minlength'=>'2' ,'placeholder'=>'Masukkan 2-500 Karakter'));
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th></tr>
                </table>
                  <table width="100%">
                    <tr><th>
                    <hr style="border-width:2px;"/></th></tr>
                    <tr>
                      <td align='left'>
                        <button class='btn btn-primary'>Simpan</button>
       	                	<a href="<?php echo site_url('registrasi/ubahkomputer/') ?>" class="btn btn-success">Batal</a>

                    </td>
                  </tr>
                </table>
				         <?php echo form_close();
	                }
	                elseif($view=='skill'){?>
	                <h4>Kemampuan Lainnya</h4><hr/>
	                <?php
		                $attributes = array('class' => 'form-horizontal form-validate', 'id' => 'form', 'method' => 'POST', 'novalidate'=>'novalidate');
	                	?>
	                	<section class="content-header" align="right">
		                    <ol class="breadcrumb">
		                        <li><a href="<?php echo site_url('registrasi/tambahskill/'); ?>"><i class="fa fa-plus-square"></i> Tambah</a></li>
		                    </ol>
		                </section>

	                	<table id="example2" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Kemampuan</th>
                                    <th>Tingkatan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            	<?php
                            	$CI =& get_instance();
								foreach((array)$skill as $rowx) {
								    echo "<tr>";
								    	echo "<td align='center'>".$rowx->skill."</td>";
										echo "<td align='center'>".$rowx->tingkat."</td>";
									    echo "<td align='center' width='150'>";
										echo '<a href='.site_url('registrasi/tambahskill/'.$rowx->replid).' class="btn btn-warning">Ubah</a>';
									    echo '&nbsp;&nbsp;<a href='.site_url('registrasi/hapusskill/'.$rowx->replid).'  class="btn btn-danger">Hapus</a>';
									    echo "</td>";
								    echo "</tr>";
								}
								?>
                            </tbody>
                            <tfoot>
                            </tfoot>
	                	</table>

	                	<a href="<?php echo site_url('registrasi/ubahkomputer/') ?>" class='btn btn-warning'>Kembali</a>
	                	<a href="<?php echo site_url('registrasi/ubahprestasi/') ?>" class="btn btn-primary">Lanjut</a>
	                	<a href="<?php echo site_url('registrasi') ?>" class="btn btn-success">Batal</a>
	                	<?php
	                }
	                elseif($view=='tambah_skill'){?>
	                <h4>Kemampuan Lainnya</h4><hr/>
	                <?php
		                $attributes = array('class' => 'form-horizontal form-validate', 'id' => 'form', 'method' => 'POST', 'novalidate'=>'novalidate');
	                	echo form_open($action,$attributes);
	                	?>
	                	<table width="100%" border="0">
			            <tr>
			            <th align="left">
	                		<label class="control-label" for="minlengthfield">Kemampuan</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		echo form_textarea(array('class' => '', 'id' => 'skill','name'=>'skill','value'=>$isi->skill,'data-rule-required'=>'false' ,'data-rule-maxlength'=>'500', 'data-rule-minlength'=>'2' ,'placeholder'=>'Masukkan 2-500 Karakter'));
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th></tr>
			            <tr>
			            <th align="left">
	                		<label class="control-label" for="minlengthfield">Tingkat</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		$arrtingkat='data-rule-required=true';
			                		echo form_dropdown('tingkat',$type_tingkat_opt,$isi->tingkat,$arrtingkat);
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th></tr>
                </table>
                  <table width="100%">
                    <tr><th>
                    <hr style="border-width:2px;"/></th></tr>
                    <tr>
                      <td align='left'>
                        <button class='btn btn-primary'>Simpan</button>
       	                	<a href="<?php echo site_url('registrasi/ubahskill/') ?>" class="btn btn-success">Batal</a>

                    </td>
                  </tr>
                </table>

                    <?php echo form_close();
	                }
	                elseif($view=='prestasi'){?>
	                <h4>Prestasi</h4><hr/>
	                <?php
		                $attributes = array('class' => 'form-horizontal form-validate', 'id' => 'form', 'method' => 'POST', 'novalidate'=>'novalidate');
	                	?>
	                	<section class="content-header" align="right">
		                    <ol class="breadcrumb">
		                        <li><a href="<?php echo site_url('registrasi/tambahprestasi/'); ?>"><i class="fa fa-plus-square"></i> Tambah</a></li>
		                    </ol>
		                </section>

	                	<table id="example2" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Tahun</th>
                                    <th>Prestasi</th>
                                    <th>Tingkat</th>
                                    <th>Instansi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            	<?php
                            	$CI =& get_instance();
								foreach((array)$prestasi as $rowx) {
								    echo "<tr>";
								    	echo "<td align='center'>".$rowx->tahun."</td>";
								    	echo "<td align='center'>".$rowx->prestasi."</td>";
										echo "<td align='center'>".$rowx->tingkat."</td>";
										echo "<td align='center'>".$rowx->instansi."</td>";
									    echo "<td align='center' width='150'>";
										echo '<a href='.site_url('registrasi/tambahprestasi/'.$rowx->replid).' class="btn btn-warning">Ubah</a>';
									    echo '&nbsp;&nbsp;<a href='.site_url('registrasi/hapusprestasi/'.$rowx->replid).'  class="btn btn-danger">Hapus</a>';
									    echo "</td>";
								    echo "</tr>";
								}
								?>
                            </tbody>
                            <tfoot>
                            </tfoot>
	                	</table>

	                	<a href="<?php echo site_url('registrasi/ubahskill/') ?>" class='btn btn-warning'>Kembali</a>
	                	<a href="<?php echo site_url('registrasi/ubahorganisasi/') ?>" class="btn btn-primary">Lanjut</a>
	                	<a href="<?php echo site_url('registrasi') ?>" class="btn btn-success">Batal</a>
	                	<?php
	                }
	                elseif($view=='tambah_prestasi'){?>
	                <h4>Prestasi</h4><hr/>
	                <?php
		                $attributes = array('class' => 'form-horizontal form-validate', 'id' => 'form', 'method' => 'POST', 'novalidate'=>'novalidate');
	                	echo form_open($action,$attributes);
	                	?>
	                	<table width="100%" border="0">
			            <tr>
			            <th align="left">
	                		<label class="control-label" for="minlengthfield">Tahun</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		echo form_input(array('class' => '', 'id' => 'tahun','name'=>'tahun','value'=>$isi->tahun,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'4', 'data-rule-minlength'=>'4','data-rule-number'=>'true','placeholder'=>'Masukkan 4 Karakter','size'=>'15'));
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th></tr>
			            <tr>
			            <th align="left">
	                		<label class="control-label" for="minlengthfield">Prestasi</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		echo form_textarea(array('class' => '', 'id' => 'prestasi','name'=>'prestasi','value'=>$isi->prestasi,'data-rule-required'=>'false' ,'data-rule-maxlength'=>'500', 'data-rule-minlength'=>'2' ,'placeholder'=>'Masukkan 2-500 Karakter'));
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th></tr>
			            <tr>
			            <th align="left">
	                		<label class="control-label" for="minlengthfield">Tingkat</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		$arrtingkat='data-rule-required=true';
			                		echo form_dropdown('tingkat',$type_tingkat_opt,$isi->tingkat,$arrtingkat);
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th></tr>
			            <tr>
			            <th align="left">
	                		<label class="control-label" for="minlengthfield">Instansi</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		echo form_input(array('class' => '', 'id' => 'instansi','name'=>'instansi','value'=>$isi->instansi,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'500', 'data-rule-minlength'=>'2' ,'placeholder'=>'Masukkan 2-500 Karakter','size'=>'15'));
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th></tr>
                </table>
                  <table width="100%">
                    <tr><th>
                    <hr style="border-width:2px;"/></th></tr>
                    <tr>
                      <td align='left'>
                        <button class='btn btn-primary'>Simpan</button>
       	                	<a href="<?php echo site_url('registrasi/ubahprestasi/') ?>" class="btn btn-success">Batal</a>
                      </td>
                  </tr>
                </table>
				         <?php echo form_close();
	                }
	                elseif($view=='organisasi'){?>
	                <h4>Keorganisasian</h4><hr/>
	                <?php
		                $attributes = array('class' => 'form-horizontal form-validate', 'id' => 'form', 'method' => 'POST', 'novalidate'=>'novalidate');
	                	?>
	                	<section class="content-header" align="right">
		                    <ol class="breadcrumb">
		                        <li><a href="<?php echo site_url('registrasi/tambahorganisasi/'); ?>"><i class="fa fa-plus-square"></i> Tambah</a></li>
		                    </ol>
		                </section>

	                	<table id="example2" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Instansi/Institusi</th>
                                    <th>Organisasi</th>
                                    <th>Jabatan</th>
                                    <th>Tanggung Jawab</th>
                                    <th>Tahun</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            	<?php
                            	$CI =& get_instance();
								foreach((array)$organisasi as $rowx) {
								    echo "<tr>";
								    	echo "<td align='center'>".$rowx->instansi."</td>";
								    	echo "<td align='center'>".$rowx->organisasi."</td>";
										echo "<td align='center'>".$rowx->jabatan."</td>";
										echo "<td align='center'>".$rowx->tanggung_jawab."</td>";
										echo "<td align='center'>".$CI->p_c->tgl_indo($rowx->tgl_masuk).' - '.$CI->p_c->tgl_indo($rowx->tgl_keluar)."</td>";
									    echo "<td align='center' width='150'>";
										echo '<a href='.site_url('registrasi/tambahorganisasi/'.$rowx->replid).' class="btn btn-warning">Ubah</a>';
									    echo '&nbsp;&nbsp;<a href='.site_url('registrasi/hapusorganisasi/'.$rowx->replid).'  class="btn btn-danger">Hapus</a>';
									    echo "</td>";
								    echo "</tr>";
								}
								?>
                            </tbody>
                            <tfoot>
                            </tfoot>
	                	</table>

	                	<a href="<?php echo site_url('registrasi/ubahprestasi/') ?>" class='btn btn-warning'>Kembali</a>
	                	<a href="<?php echo site_url('registrasi/ubahkerja/') ?>" class="btn btn-primary">Lanjut</a>
	                	<a href="<?php echo site_url('registrasi') ?>" class="btn btn-success">Batal</a>
	                	<?php
	                }
	                elseif($view=='tambah_organisasi'){?>
	                <h4>Keorganisasian</h4><hr/>
	                <?php
		                $attributes = array('class' => 'form-horizontal form-validate', 'id' => 'form', 'method' => 'POST', 'novalidate'=>'novalidate');
	                	echo form_open($action,$attributes);
	                	?>
	                	<table width="100%" border="0">
			            <th align="left">
	                		<label class="control-label" for="minlengthfield">Instansi</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		echo form_input(array('class' => '', 'id' => 'instansi','name'=>'instansi','value'=>$isi->instansi,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'500', 'data-rule-minlength'=>'2' ,'placeholder'=>'Masukkan 2-500 Karakter','size'=>'15'));
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th></tr>
			            <th align="left">
	                		<label class="control-label" for="minlengthfield">Organisasi</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		echo form_input(array('class' => '', 'id' => 'organisasi','name'=>'organisasi','value'=>$isi->organisasi,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'500', 'data-rule-minlength'=>'2' ,'placeholder'=>'Masukkan 2-500 Karakter','size'=>'15'));
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th></tr>
			            <th align="left">
	                		<label class="control-label" for="minlengthfield">Jabatan</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		echo form_input(array('class' => '', 'id' => 'jabatan','name'=>'jabatan','value'=>$isi->jabatan,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'500', 'data-rule-minlength'=>'2' ,'placeholder'=>'Masukkan 2-500 Karakter','size'=>'15'));
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th></tr>
			            <tr>
			            <th align="left">
	                		<label class="control-label" for="minlengthfield">Tanggung Jawab</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		echo form_textarea(array('class' => '', 'id' => 'tanggung_jawab','name'=>'tanggung_jawab','value'=>$isi->tanggung_jawab,'data-rule-required'=>'false' ,'data-rule-maxlength'=>'500', 'data-rule-minlength'=>'2' ,'placeholder'=>'Masukkan 2-500 Karakter'));
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th></tr>
			            <tr>
				            <th align="left">
		                		<label class="control-label" for="minlengthfield">Tgl. Masuk</label>
		                		<div class="control-group">
									<div class="controls">:
				                	<?php
				                		echo form_input(array('class' => '', 'id' => 'dp1','name'=>'tgl_masuk','value'=>$CI->p_c->tgl_form($isi->tgl_masuk),'data-rule-required'=>'true' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'2' ,'placeholder'=>'DD-MM-YYYY'));
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
				                		echo form_input(array('class' => '', 'id' => 'dp2','name'=>'tgl_keluar','value'=>$CI->p_c->tgl_form($isi->tgl_keluar),'data-rule-required'=>'false' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'2' ,'placeholder'=>'DD-MM-YYYY'));
				                	?>
				                	<?php //echo  <p id="message"></p> ?>
									</div>
		                		</div>
				            </th>
				         </tr>
               </table>
                 <table width="100%">
                   <tr><th>
                   <hr style="border-width:2px;"/></th></tr>
                   <tr>
                     <td align='left'>
                       <button class='btn btn-primary'>Simpan</button>
      	                	<a href="<?php echo site_url('registrasi/ubahorganisasi/') ?>" class="btn btn-success">Batal</a>
                     </td>
                 </tr>
               </table>

                    <?php echo form_close();
	                }
	                elseif($view=='kerja'){?>
	                <h4>Pengalaman Kerja </h4><hr/>
	                <?php
		                $attributes = array('class' => 'form-horizontal form-validate', 'id' => 'form', 'method' => 'POST', 'novalidate'=>'novalidate');
	                	?>
	                	<section class="content-header" align="right">
		                    <ol class="breadcrumb">
		                        <li><a href="<?php echo site_url('registrasi/tambahkerja/'); ?>"><i class="fa fa-plus-square"></i> Tambah</a></li>
		                    </ol>
		                </section>

	                	<table id="example2" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <!--
                                    <th>Tgl. Masuk</th>
                                    <th>Tgl. Keluar</th>
                                  -->
                                    <th>Tahun Masuk</th>
                                    <th>Tahun Keluar</th>
                                    <th>Instansi</th>
                                    <th>Bidang Usaha</th>
                                    <th>Jabatan</th>
                                    <th>Alamat</th>
                                    <th>Keterangan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            	<?php
                            	$CI =& get_instance();
								foreach((array)$kerja as $rowx) {
								    echo "<tr>";
								    	//echo "<td align='center'>".$CI->p_c->tgl_indo($rowx->tgl_masuk)."</td>";
								    	//echo "<td align='center'>".$CI->p_c->tgl_indo($rowx->tgl_keluar)."</td>";
                      echo "<td align='center'>".$rowx->tahun_masuk."</td>";
                      echo "<td align='center'>".$rowx->tahun_keluar."</td>";
								    	echo "<td align='center'>".$rowx->instansi."</td>";
								    	echo "<td align='center'>".$rowx->bidang_usaha."</td>";
								    	echo "<td align='center'>".$rowx->jabatan."</td>";
										echo "<td align='center'>".$rowx->alamat."</td>";
										echo "<td align='center'>".$rowx->keterangan."</td>";
									    echo "<td align='center' width='150'>";
										echo '<a href='.site_url('registrasi/tambahkerja/'.$rowx->replid).' class="btn btn-warning">Ubah</a>';
									    echo '&nbsp;&nbsp;<a href='.site_url('registrasi/hapuskerja/'.$rowx->replid).'  class="btn btn-danger">Hapus</a>';
									    echo "</td>";
								    echo "</tr>";
								}
								?>
                            </tbody>
                            <tfoot>
                            </tfoot>
	                	</table>

	                	<a href="<?php echo site_url('registrasi/ubahkomputer/') ?>" class='btn btn-warning'>Kembali</a>
	                	<!-- <a href="<?php echo site_url('main') ?>" class="btn btn-success">Selesai</a>-->
                    <a href="<?php echo site_url('hrm_pegawai_attachment') ?>" class="btn btn-success">Selesai</a>

	                	<?php
	                }
	                elseif($view=='tambah_kerja'){?>
	                <h4>Pengalaman Kerja </h4><hr/>
	                <?php
		                $attributes = array('class' => 'form-horizontal form-validate', 'id' => 'form', 'method' => 'POST', 'novalidate'=>'novalidate');
	                	echo form_open($action,$attributes);
	                	?>
	                	<table width="100%" border="0">

                    <!--
	                	<tr>
				            <th align="left">
		                		<label class="control-label" for="minlengthfield">Tgl. Masuk</label>
		                		<div class="control-group">
									<div class="controls">:
				                	<?php
				                		echo form_input(array('class' => '', 'id' => 'dp1','name'=>'tgl_masuk','value'=>$CI->p_c->tgl_form($isi->tgl_masuk),'data-rule-required'=>'true' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'2' ,'placeholder'=>'DD-MM-YYYY'));
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
				                		echo form_input(array('class' => '', 'id' => 'dp2','name'=>'tgl_keluar','value'=>$CI->p_c->tgl_form($isi->tgl_keluar),'data-rule-required'=>'false' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'2' ,'placeholder'=>'DD-MM-YYYY'));
				                	?>
				                	<?php //echo  <p id="message"></p> ?>
									</div>
		                		</div>
				            </th>
				         </tr>
               -->
               <tr>
               <th align="left">
                 <label class="control-label" for="minlengthfield">Tahun Masuk</label>
                 <div class="control-group">
               <div class="controls">:
                   <?php
                     echo form_input(array('class' => '', 'id' => 'tahun_masuk','name'=>'tahun_masuk','value'=>$isi->tahun_masuk,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'4', 'data-rule-minlength'=>'4','data-rule-number'=>'true','placeholder'=>'Masukkan 4 Karakter','size'=>'15'));
                   ?>
                   <?php //echo  <p id="message"></p> ?>
               </div>
                 </div>
               </th></tr>
               <tr>
               <th align="left">
                 <label class="control-label" for="minlengthfield">Tahun Keluar</label>
                 <div class="control-group">
               <div class="controls">:
                   <?php
                     echo form_input(array('class' => '', 'id' => 'tahun_keluar','name'=>'tahun_keluar','value'=>$isi->tahun_keluar,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'4', 'data-rule-minlength'=>'4','data-rule-number'=>'true','placeholder'=>'Masukkan 4 Karakter','size'=>'15'));
                   ?>
                   <?php //echo  <p id="message"></p> ?>
               </div>
                 </div>
               </th></tr>
                 <tr>
			            <th align="left">
	                		<label class="control-label" for="minlengthfield">Instansi</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		echo form_input(array('class' => '', 'id' => 'instansi','name'=>'instansi','value'=>$isi->instansi,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'500', 'data-rule-minlength'=>'2' ,'placeholder'=>'Masukkan 2-500 Karakter','size'=>'15'));
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th></tr>
			            <th align="left">
	                		<label class="control-label" for="minlengthfield">Bidang Usaha</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		echo form_input(array('class' => '', 'id' => 'bidang_usaha','name'=>'bidang_usaha','value'=>$isi->bidang_usaha,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'500', 'data-rule-minlength'=>'2' ,'placeholder'=>'Masukkan 2-500 Karakter','size'=>'15'));
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th></tr>

			            <th align="left">
	                		<label class="control-label" for="minlengthfield">Jabatan</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		echo form_input(array('class' => '', 'id' => 'jabatan','name'=>'jabatan','value'=>$isi->jabatan,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'500', 'data-rule-minlength'=>'2' ,'placeholder'=>'Masukkan 2-500 Karakter','size'=>'15'));
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th></tr>
			            <tr>
			            <th align="left">
	                		<label class="control-label" for="minlengthfield">Alamat</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		echo form_textarea(array('class' => '', 'id' => 'alamat','name'=>'alamat','value'=>$isi->alamat,'data-rule-required'=>'false' ,'data-rule-maxlength'=>'500', 'data-rule-minlength'=>'2' ,'placeholder'=>'Masukkan 2-500 Karakter'));
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
			                		echo form_textarea(array('class' => '', 'id' => 'keterangan','name'=>'keterangan','value'=>$isi->keterangan,'data-rule-required'=>'false' ,'data-rule-maxlength'=>'500', 'data-rule-minlength'=>'2' ,'placeholder'=>'Masukkan 2-500 Karakter'));
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th></tr>
                </table>
                  <table width="100%">
                    <tr><th>
                    <hr style="border-width:2px;"/></th></tr>
                    <tr>
                      <td align='left'>
                        <button class='btn btn-primary'>Simpan</button>
       	                	<a href="<?php echo site_url('registrasi/ubahkerja/') ?>" class="btn btn-success">Batal</a>
                      </td>
                  </tr>
                </table>
                    <?php echo form_close();
	                }elseif($view=='pendidikan_nf'){?>
	                <h4>Pendidikan Non Formal</h4><hr/>
	                <?php
		                $attributes = array('class' => 'form-horizontal form-validate', 'id' => 'form', 'method' => 'POST', 'novalidate'=>'novalidate');
	                	?>
	                	<section class="content-header" align="right">
		                    <ol class="breadcrumb">
		                        <li><a href="<?php echo site_url('registrasi/tambahpendidikan_nf/'.$id); ?>" target="_blank"><i class="fa fa-plus-square"></i> Tambah</a></li>
		                    </ol>
		                </section>

	                	<table id="example2" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Institusi</th>
                                    <th>Tgl. Masuk</th>
                                    <th>Tgl. Keluar</th>
                                    <th>Keterangan</th>
                                    <th>Dibiayai Oleh</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            	<?php
                            	$CI =& get_instance();
								foreach((array)$pendidikan_nf as $rowx) {
								    echo "<tr>";
								    	echo "<td align='center'>".$rowx->institusi."</td>";
								    	echo "<td align='center'>".$CI->p_c->tgl_indo($rowx->tgl_masuk)."</td>";
								    	echo "<td align='center'>".$CI->p_c->tgl_indo($rowx->tgl_keluar)."</td>";
								    	echo "<td align='center'>".$rowx->keterangan."</td>";
								    	echo "<td align='center'>".$rowx->dibiayai."</td>";

									    echo "<td align='center' width='150'>";
										echo '<a href='.site_url('registrasi/tambahpendidikan_nf/'.$rowx->replid).' class="btn btn-warning">Ubah</a>';
									    echo '&nbsp;&nbsp;<a href='.site_url('registrasi/hapuspendidikan_nf/'.$rowx->replid).'  class="btn btn-danger">Hapus</a>';
									    echo "</td>";
								    echo "</tr>";
								}
								?>
                            </tbody>
                            <tfoot>
                            </tfoot>
	                	</table>

	                	<a href="<?php echo site_url('registrasi/ubahpendidikan/'.$id) ?>" class='btn btn-xs btn-warning'>Kembali</a>
	                	<a href="<?php echo site_url('registrasi/ubahbahasa/'.$id) ?>" class="btn btn-primary">Lanjut</a>
	                	<a href="<?php echo site_url('registrasi/view/'.$id) ?>" class="btn btn-success">Batal</a>
	                	<?php
	                }
	                elseif($view=='tambah_pendidikan_nf'){?>
	                <h4>Pendidikan Non Formal</h4><hr/>
	                <?php
		                $attributes = array('class' => 'form-horizontal form-validate', 'id' => 'form', 'method' => 'POST', 'novalidate'=>'novalidate');
	                	echo form_open($action,$attributes);
	                	?>
	                	<table width="100%" border="0">
			            <tr>
			            <th align="left">
	                		<label class="control-label" for="minlengthfield">Institusi</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		echo form_input(array('class' => '', 'id' => 'institusi','name'=>'institusi','value'=>$isi->institusi,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'500', 'data-rule-minlength'=>'2' ,'placeholder'=>'Masukkan 2-500 Karakter','size'=>'15'));
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th></tr>

			            <tr>
				            <th align="left">
		                		<label class="control-label" for="minlengthfield">Tgl. Masuk</label>
		                		<div class="control-group">
									<div class="controls">:
				                	<?php
				                		echo form_input(array('class' => '', 'id' => 'dp1','name'=>'tgl_masuk','value'=>$CI->p_c->tgl_form($isi->tgl_masuk),'data-rule-required'=>'true' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'2' ,'placeholder'=>'DD-MM-YYYY'));
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
				                		echo form_input(array('class' => '', 'id' => 'dp2','name'=>'tgl_keluar','value'=>$CI->p_c->tgl_form($isi->tgl_keluar),'data-rule-required'=>'true' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'2' ,'placeholder'=>'DD-MM-YYYY'));
				                	?>
				                	<?php //echo  <p id="message"></p> ?>
									</div>
		                		</div>
				            </th>
				         </tr>
				         <tr>
				            <th align="left">
		                		<label class="control-label" for="minlengthfield">Keterangan</label>
		                		<div class="control-group">
									<div class="controls">:
				                	<?php
				                		echo form_input(array('class' => '', 'id' => 'keterangan','name'=>'keterangan','value'=>$isi->keterangan,'data-rule-required'=>'false' ,'data-rule-maxlength'=>'500', 'data-rule-minlength'=>'2' ,'placeholder'=>'Masukkan 2-500 Karakter','size'=>'15'));
				                	?>
				                	<?php //echo  <p id="message"></p> ?>
									</div>
		                		</div>
				            </th></tr>
				         <tr>
				            <th align="left">
		                		<label class="control-label" for="minlengthfield">Dibiayai Oleh</label>
		                		<div class="control-group">
									<div class="controls">:
				                	<?php
				                		echo form_input(array('class' => '', 'id' => 'dibiayai','name'=>'dibiayai','value'=>$isi->dibiayai,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'500', 'data-rule-minlength'=>'2' ,'placeholder'=>'Masukkan 2-500 Karakter','size'=>'15'));
				                	?>
				                	<?php //echo  <p id="message"></p> ?>
									</div>
		                		</div>
				            </th></tr>
                    <table width="100%" border="0">
                      <tr>
                          <td align="left">
				                        <button class='btn btn-primary'>Simpan</button>
	                	            <a href="<?php echo site_url('registrasi/ubahpendidikan_nf') ?>" class="btn btn-success">Batal</a>
                              </td>
                          </tr>
                          </table>
                    <?php echo form_close();
	                }
	                ?>
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
    </body>
</html>
