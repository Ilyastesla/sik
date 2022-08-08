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
                <section class="content-header table-responsive">
                    <h1>
                        <?php echo $form ?>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-file-text"></i>Cetak</a></li>
                        <li><a href="#"><i class="fa fa-file-excel-o"></i>Excel</a></li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <?php $CI =& get_instance();?>
                     <table width="100%" border="0">
	                	<tr><th width="180">No.KTP</th><th width="10">:</th><td><?php echo $header->noktp;?></td>
                        <th rowspan="10" width="200" valign="middle" align="right">
                          <a href="javascript:void(window.open('<?php echo site_url("pegawai/fotodisplay/".$header->nip) ?>'))">
                          <?php
                            if ($header->fotodisplay<>""){
                        	?>
                            	<img src="<?php echo base_url(); ?>uploads/fotodisplay/<?php echo $header->fotodisplay ?>" style="width:200;"/>
                          <?php }else{?>
                            	<img src="<?php echo base_url(); ?>images/blankfotodisplay.png" style="width:200;" />
                          <?php } ?>
                          </a>
                        </th>
                    </tr>
	                	<tr><th>Nama</th><th>:</th><td><?php
	                			if (trim($header->gelarawal)<>""){echo $header->gelarawal.'. ';}
	                			echo ($header->nama);
	                			if (trim($header->gelarakhir)<>""){echo ', '.$header->gelarakhir;}

	                	?></td></tr>
	                	<tr><th>Nama Panggilan</th><th>:</th><td><?php echo ucfirst(strtolower($header->panggilan));?></td></tr>
	                	<tr><th>Jenis Kelamin</th><th>:</th><td><?php echo $CI->p_c->jk($header->kelamin);?></td></tr>
                    <tr><th>TTL</th><th>:</th><td><?php echo ucfirst(strtolower($header->tmplahir)).', '.$CI->p_c->tgl_indo($header->tgllahir);?> <?php echo "( ".$header->umur." Tahun)" ?> </td></tr>
                    <tr><th>Agama</th><th>:</th><td><?php echo $header->agama;?></td></tr>
                    <tr><th>No. Telepon</th><th width="10">:</th><td><?php echo $header->telepon;?></td></tr>
                    <tr><th>No. Handphone</th><th>:</th><td><?php echo $header->handphone;?></td></tr>
                    <tr><th>Email</th><th width="10">:</th><td><?php echo $header->email;?></td></tr>
	                	<tr><th>Aktif</th><th>:</th><td><?php echo $CI->p_c->cekaktif($header->aktif);?></td></tr>
                    <tr><td colspan="3"><hr/></td></tr>
                    <tr><td colspan="3"><h4>Informasi Akun</h4></td></tr>
                    <tr><td colspan="3"><hr/></td></tr>
                    <tr><th>Login</th><th>:</th><td><?php echo $CI->p_c->cekaktif($header->aktiflogin);?></td></tr>
                    <tr><th>Peran</th><th>:</th><td><?php echo $CI->dbx->role_show($header->role_id,0);?></td></tr>
                    <tr><th>Departemen</th><th>:</th><td><?php echo $CI->dbx->departemen_show($header->role_id,0);?></td></tr>
	                </table>
                  <hr/>
                  <h4>Detail Data Karyawan</h4>
	                <hr/>
                	<div class="nav-tabs-custom">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a href="#tab_1" data-toggle="tab">Data Diri</a></li>
                                    <li><a href="#tab_2" data-toggle="tab">Informasi Kontak</a></li>
                                    <li><a href="#tab_3" data-toggle="tab">Identitas/ Perbankan</a></li>
                                    <li><a href="#tab_4" data-toggle="tab">Kontak Darurat</a></li>
                                    <li><a href="#tab_5" data-toggle="tab">Informasi Keluarga</a></li>
                                    <li><a href="#tab_6" data-toggle="tab">Kepribadian</a></li>
                                    <li><a href="#tab_7" data-toggle="tab">Pendidikan</a></li>
                  									<li><a href="#tab_8" data-toggle="tab">Kemampuan</a></li>
                  									<li><a href="#tab_9" data-toggle="tab">Prestasi</a></li>
                  									<li><a href="#tab_10" data-toggle="tab">Deskripsi Diri</a></li>
                  									<li><a href="#tab_11" data-toggle="tab">Organisasi</a></li>
                  									<li><a href="#tab_12" data-toggle="tab">Pengalaman Kerja</a></li>
                  									<li><a href="#tab_13" data-toggle="tab">Kontrak</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab_1">
                                        <table width="100%">
						                	<tr><th width="180">NIK</th><th width="10">:</th><td><?php echo $header->nip;?></td></tr>
						                	<tr><th>NUPTK</th><th>:</th><td><?php echo $header->nuptk;?></td></tr>
						                	<tr><th>NRG</th><th>:</th><td><?php echo $header->nrp;?></td></tr>
						                	<tr><th>Kewarganegaraan</th><th>:</th><td><?php echo $header->warganegara;?></td></tr>
						                	<tr><th>Golongan Darah</th><th>:</th><td><?php echo $header->golongan_darah;?></td></tr>
                              <tr><th>Aktif</th><th>:</th><td><?php echo $CI->p_c->cekaktif($header->aktif);?></td></tr>
						                </table>
                                    </div><!-- tab 1 -->
                                    <div class="tab-pane" id="tab_2">
                                       <table width="100%">
						                	<tr><th width="180">Alamat Identitas</th><th width="10">:</th><td><?php echo $header->alamat_tinggal2;?></td></tr>
						                	<tr><th>Kecamatan</th><th>:</th><td><?php echo $header->kecamatan2;?></td></tr>
						                	<tr><th>Kota</th><th>:</th><td><?php echo $header->kota2;?></td></tr>
						                	<tr><th>Provinsi</th><th>:</th><td><?php echo $header->provinsi2;?></td></tr>
						                	<tr><th>Kode Pos</th><th>:</th><td><?php echo $header->kode_pos2;?></td></tr>
						                	<tr><th>Negara</th><th>:</th><td><?php echo $header->negara2;?></td></tr>
						                	<tr><th>Tinggal Sejak</th><th>:</th><td><?php echo $CI->p_c->tgl_indo($header->tinggal_sejak2);?></td></tr>

						                	<tr><th colspan="3"><hr/></th></tr>


						                	<tr><th>Alamat Tinggal</th><th width="10">:</th><td><?php echo $header->alamat_tinggal;?></td></tr>
						                	<tr><th>Kecamatan</th><th>:</th><td><?php echo $header->kecamatan;?></td></tr>
						                	<tr><th>Kota</th><th>:</th><td><?php echo $header->kota;?></td></tr>
						                	<tr><th>Provinsi</th><th>:</th><td><?php echo $header->provinsi;?></td></tr>
						                	<tr><th>Kode Pos</th><th>:</th><td><?php echo $header->kode_pos;?></td></tr>
						                	<tr><th>Negara</th><th>:</th><td><?php echo $header->negara;?></td></tr>
						                	<tr><th>Tinggal Sejak</th><th>:</th><td><?php echo $CI->p_c->tgl_indo($header->tinggal_sejak);?></td></tr>
						                	<tr><th colspan="3"><hr/></th></tr>
						                	<tr><th>No. Telepon</th><th width="10">:</th><td><?php echo $header->telepon;?></td></tr>
						                	<tr><th>No. Handphone</th><th>:</th><td><?php echo $header->handphone;?></td></tr>
						                	<tr><th>No. Handphone 2</th><th>:</th><td><?php echo $header->handphone2;?></td></tr>

						                	<tr><th colspan="3"><hr/></th></tr>

						                	<tr><th>Email</th><th width="10">:</th><td><?php echo $header->email;?></td></tr>
						                	<tr><th>Pin BBM</th><th>:</th><td><?php echo $header->bbm;?></td></tr>
						                	<tr><th>Linked In</th><th>:</th><td><?php echo $header->linkedin;?></td></tr>
						                	<tr><th>Facebook</th><th width="10">:</th><td><?php echo $header->facebook;?></td></tr>
						                	<tr><th>Twitter</th><th width="10">:</th><td><?php echo $header->twitter;?></td></tr>
						                	<tr><th>Website</th><th width="10">:</th><td><?php echo $header->website;?></td></tr>
						                </table>
                                    </div><!-- kontak -->

                                    <div class="tab-pane" id="tab_3">
                                    	<div class="box-body table-responsive">
	                                    	<table id="example1" class="table table-bordered table-hover">
					                            <thead>
					                                <tr>
					                                    <th>Tipe</th>
					                                    <th>Nomor</th>
					                                    <th>Tgl. Pembuatan</th>
					                                    <th>Berlaku</th>
					                                    <th>Keterangan</th>
					                                </tr>
					                            </thead>
					                            <tbody>
					                            	<?php
					                            	$CI =& get_instance();
													foreach((array)$perbankan as $rowx) {
													    echo "<tr>";
														    echo "<td align='center'>".$rowx->type."</td>";
								    	echo "<td align='center'>".$rowx->nomor."</td>";
								    	echo "<td align='center'>".$CI->p_c->tgl_indo($rowx->tgl_pembuatan)."</td>";
								    	echo "<td align='center'>".$CI->p_c->tgl_indo($rowx->berlaku)."</td>";
									    echo "<td align='center'>".$rowx->keterangan."</td>";													    echo "</tr>";
													}
													?>
					                            </tbody>
					                            <tfoot>
					                            </tfoot>
					                       </table>
                                    	</div>

                                    </div><!-- perbankan -->

                                    <div class="tab-pane" id="tab_4">
                                    	<div class="box-body table-responsive">
	                                    	<table id="example2" class="table table-bordered table-hover">
					                            <thead>
					                                <tr>
					                                    <th>Nama</th>
					                                    <th>Hubungan</th>
					                                    <th>Alamat</th>
					                                    <th>Telepon</th>
					                                    <th>Handphone</th>
					                                    <th>Email</th>
					                                </tr>
					                            </thead>
					                            <tbody>
					                            	<?php
					                            	$CI =& get_instance();
													foreach((array)$kontakdarurat as $rowx) {
													    echo "<tr>";
														    echo "<td align='center'>".$rowx->nama."</td>";
													    	echo "<td align='center'>".$rowx->hubungan."</td>";
														    echo "<td align=''>".$rowx->alamat.' '.$rowx->kecamatan.' '.$rowx->kota.$rowx->provinsi.' '.$rowx->kode_pos.' '.$rowx->negara."</td>";
														    echo "<td align='center'>".$rowx->telepon."</td>";
														    echo "<td align='center'>".$rowx->handphone."</td>";
														    echo "<td align='center'>".$rowx->email."</td>";
													    echo "</tr>";
													}
													?>
					                            </tbody>
					                            <tfoot>
					                            </tfoot>
					                       </table>
                                    	</div>
                                    </div><!-- kontak Darurat -->





                                    <div class="tab-pane" id="tab_5">
                                       <table width="100%" border="0">
						                	<tr><th width="180">Anak Ke</th><th width="10">:</th><td><?php echo $header->anak_ke;?></td></tr>
						                	<tr><th>Dari</th><th>:</th><td><?php echo $header->jml_saudara;?> Bersaudara</td></tr>
						                	<tr><th>Status Pernikahan</th><th>:</th><td><?php echo $header->status_nikah;?></td></tr>
						                	<tr><th>Nama Gadis Ibu Kandung</th><th>:</th><td><?php echo $header->nama_gadis_ibu;?></td></tr>
						                	<tr><th>Pekerjaan Ibu</th><th>:</th><td><?php echo $header->pekerjaan_ibu;?></td></tr>
						                	<tr><th>Nama Ayah</th><th>:</th><td><?php echo $header->nama_ayah;?></td></tr>
						                	<tr><th>Pekerjaan Ayah</th><th>:</th><td><?php echo $header->pekerjaan_ayah;?></td></tr>
						                	<tr><th>Kode Tanggungan Pajak</th><th>:</th><td><?php echo $header->kode_pajak;?></td></tr>
						                </table>
						                <br/><br/>
						                <div class="box-body table-responsive">
							                <table id="example3" class="table table-bordered table-striped">
					                            <thead>
					                                <tr>
					                                    <th>Nama</th>
					                                    <th>Hubungan</th>
					                                    <th>Jenis Kelamin</th>
					                                    <th>TTL</th>
					                                    <th>Umur</th>
					                                    <th>Pendidikan Terakhir</th>
					                                    <th>Pekerjaan</th>
					                                    <th>Instansi</th>
					                                </tr>
					                            </thead>
					                            <tbody>
					                            	<?php
					                            	$CI =& get_instance();
													foreach((array)$keluarga as $rowx) {
													    echo "<tr>";
													    echo "<td align='center'>".$rowx->nama."</td>";
												    	echo "<td align='center'>".$rowx->hubungan."</td>";
													    echo "<td align=''>".$CI->p_c->jk($rowx->jenis_kelamin)."</td>";
													    echo "<td align='center'>".$rowx->tempat_lahir.', '.$CI->p_c->tgl_indo($rowx->tanggal_lahir)."</td>";
													    echo "<td align='center'>".$rowx->umur."</td>";
													    echo "<td align='center'>".$rowx->pendidikan_terakhir."</td>";
													    echo "<td align='center'>".$rowx->pekerjaan."</td>";
													    echo "<td align='center'>".$rowx->instansi."</td>";
													    echo "</tr>";
													}
													?>
					                            </tbody>
					                            <tfoot>
					                            </tfoot>
						                	</table>
						                </div>

                                    </div><!-- Status Pernikahan -->
                                    <div class="tab-pane" id="tab_6">
                                       <table width="100%">
						                	<tr><th width="200">Berat Badan</th><th width="10">:</th><td><?php echo $header->berat_badan;?> Kg</td></tr>
						                	<tr><th>Tinggi Badan</th><th>:</th><td><?php echo $header->tinggi_badan;?> Cm</td></tr>
						                	<tr><th>Hobi</th><th>:</th><td><?php echo $header->hobi;?></td></tr>
						                	<tr><th>Warna Kesukaan</th><th>:</th><td><?php echo $header->warna;?></td></tr>
						                	<tr><th>Barang Kesukaan</th><th>:</th><td><?php echo $header->barang;?></td></tr>
						                	<tr><th>Ukuran Celana</th><th>:</th><td><?php echo $header->ukuran_celana;?></td></tr>
						                	<tr><th>Ukuran Baju</th><th>:</th><td><?php echo $header->ukuran_baju;?></td></tr>
						                	<tr><th>Ukuran Sepatu</th><th>:</th><td><?php echo $header->ukuran_sepatu;?></td></tr>
						                	<tr><th>Motto Hidup</th><th>:</th><td><?php echo $header->motto;?></td></tr>
						                	<tr><th>Tokoh Inspiratif</th><th>:</th><td><?php echo $header->tokoh;?></td></tr>
						                	<tr><th>Target Yang Ingin Dicapai</th><th>:</th><td><?php echo $header->target;?></td></tr>
						               </table>
                                    </div><!-- Status Pernikahan -->

                                    <div class="tab-pane" id="tab_7">
	                                    <h4>Pendidikan Formal</h4>
	                                    <hr style="border-width:2px;"/></th></tr>
	                                    <table id="example4" class="table table-bordered table-striped">
				                            <thead>
				                                <tr>
				                                    <th>Jenjang Pendidikan</th>
				                                    <th>Institusi</th>
				                                    <th>Fakultas</th>
				                                    <th>Jurusan</th>
				                                    <th>Tahun Masuk</th>
				                                    <th>Tahun Keluar</th>
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
												    echo "</tr>";
												}
												?>
				                            </tbody>
				                            <tfoot>
				                            </tfoot>
					                	</table>
	                                    <br/><br/><br/>
	                                    <h4>Pendidikan Non Formal</h4>
	                                    <hr style="border-width:2px;"/></th></tr>
	                                    <table id="example5" class="table table-bordered table-striped">
				                            <thead>
				                                <tr>
				                                    <th>Institusi</th>
				                                    <th>Tgl. Masuk</th>
				                                    <th>Tgl. Keluar</th>
				                                    <th>Jenis Kursus</th>
				                                    <th>Dibiayai Oleh</th>
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
												    echo "</tr>";
												}
												?>
				                            </tbody>
				                            <tfoot>
				                            </tfoot>
					                	</table>
				                	</div> <!-- pendidikan -->
                                    <div class="tab-pane" id="tab_8">
                                    	<h4>Kemampuan Bahasa</h4>
	                                    <hr style="border-width:2px;"/></th></tr>

	                                    <table id="example6" class="table table-bordered table-striped">
				                            <thead>
				                                <tr>
				                                    <th>Bahasa</th>
				                                    <th>Bicara</th>
				                                    <th>Menulis</th>
				                                    <th>Membaca</th>
				                                    <th>TOEFL</th>
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
												    echo "</tr>";
												}
												?>
				                            </tbody>
				                            <tfoot>
				                            </tfoot>
					                	</table>
					                	<br/><br/><br/>
					                	<h4>Kemampuan Komputer</h4>
	                                    <hr style="border-width:2px;"/></th></tr>
					                	<table id="example7" class="table table-bordered table-striped">
				                            <thead>
				                                <tr>
				                                    <th>Kemampuan Komputer</th>
				                                    <th>Bidang</th>
				                                    <th>Tingkatan</th>
				                                    <th>Keterangan</th>
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
												    echo "</tr>";
												}
												?>
				                            </tbody>
				                            <tfoot>
				                            </tfoot>
					                	</table>
					                	<br/><br/><br/>
					                	<h4>Kemampuan Lainnya</h4>
	                                    <hr style="border-width:2px;"/></th></tr>
	                                    <table id="example8" class="table table-bordered table-striped">
			                            <thead>
			                                <tr>
			                                    <th>Kemampuan</th>
			                                    <th>Tingkatan</th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            	<?php
			                            	$CI =& get_instance();
											foreach((array)$skill as $rowx) {
											    echo "<tr>";
											    	echo "<td align='center'>".$rowx->skill."</td>";
													echo "<td align='center'>".$rowx->tingkat."</td>";
											    echo "</tr>";
											}
											?>
			                            </tbody>
			                            <tfoot>
			                            </tfoot>
				                	</table>

                                    </div><!-- SKILL -->

                                    <div class="tab-pane" id="tab_9">
                                    <table id="example9" class="table table-bordered table-striped">
			                            <thead>
			                                <tr>
			                                    <th>Tahun</th>
			                                    <th>Prestasi</th>
			                                    <th>Tingkat</th>
			                                    <th>Instansi</th>
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
													echo "<td align='center'>".$rowx->instansi."</td>";		    												    echo "</tr>";
											}
											?>
			                            </tbody>
			                            <tfoot>
			                            </tfoot>
				                	</table>
                                    </div><!-- PRESTASI -->

                                    <div class="tab-pane" id="tab_10">
                                    	<table width="100%">
                                    		<tr><th width="200">Merokok</th><th width="10">:</th><td><?php
						                		if (strtolower(trim($header->merokok))=='1'){echo "Ya";}
						                		elseif (strtolower(trim($header->merokok))=='0'){echo "Tidak";}
						                	?>&nbsp;</td></tr>
						                	<tr><th>Sakit Ringan Yang Pernah Dialami</th><th>:</th><td><?php echo $header->sakit_ringan;?>&nbsp;</td></tr>
						                	<tr><th>Sakit Berat Yang Pernah Dialami</th><th>:</th><td><?php echo $header->sakit_berat;?>&nbsp;</td></tr>
						                	<tr><th>Kondisi Saat Ini</th><th>:</th><td><?php echo $header->kondisi_sekarang;?>&nbsp;</td></tr>
						                	<tr><th>Sifat Positif Yang Dimiliki</th><th>:</th><td><?php echo $header->sifat_positif;?>&nbsp;</td></tr>
						                	<tr><th>Sifat Negatif Yang Dimiliki</th><th>:</th><td><?php echo $header->sifat_negatif;?>&nbsp;</td></tr>
						                	<tr><th>Minat</th><th>:</th><td><?php echo $header->minat;?>&nbsp;</td></tr>
						                	<!--
						                	<tr><th>Perkembangan Pribadi</th><th>:</th><td><?php echo $header->perkembangan_pribadi;?>&nbsp;</td></tr>
						                	-->
						                	<tr><th>Daftar Buku</th><th>:</th><td><?php echo $header->daftar_buku;?>&nbsp;</td></tr>
						                	<tr><th>Alasan Bekerja di HSKS</th><th>:</th><td><?php echo $header->alasan_bekerja;?>&nbsp;</td></tr>
                                    	</table>
                                    </div><!-- DESKRIPSI DIRI -->
                                    <div class="tab-pane" id="tab_11">
                                    <table id="example10" class="table table-bordered table-striped">
			                            <thead>
			                                <tr>
			                                    <th>Instansi/Institusi</th>
			                                    <th>Organisasi</th>
			                                    <th>Jabatan</th>
			                                    <th>Tanggung Jawab</th>
			                                    <th>Tahun</th>
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
											    echo "</tr>";
											}
											?>
			                            </tbody>
			                            <tfoot>
			                            </tfoot>
				                	</table>
                                    </div><!-- ORGANISASI -->

                                    <div class="tab-pane" id="tab_12">
                                    <table id="example11" class="table table-bordered table-striped">
			                            <thead>
			                                <tr>
			                                    <th>Tgl. Masuk</th>
			                                    <th>Tgl. Keluar</th>
			                                    <th>Instansi</th>
			                                    <th>Bidang Usaha</th>
			                                    <th>Jabatan</th>
			                                    <th>Alamat</th>
			                                    <th>Keterangan</th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            	<?php
			                            	$CI =& get_instance();
											foreach((array)$kerja as $rowx) {
											    echo "<tr>";
											    	echo "<td align='center'>".$CI->p_c->tgl_indo($rowx->tgl_masuk)."</td>";
											    	echo "<td align='center'>".$CI->p_c->tgl_indo($rowx->tgl_keluar)."</td>";
											    	echo "<td align='center'>".$rowx->instansi."</td>";
											    	echo "<td align='center'>".$rowx->bidang_usaha."</td>";
											    	echo "<td align='center'>".$rowx->jabatan."</td>";
													echo "<td align='center'>".$rowx->alamat."</td>";
													echo "<td align='center'>".$rowx->keterangan."</td>";
											    echo "</tr>";
											}
											?>
			                            </tbody>
			                            <tfoot>
			                            </tfoot>
				                	</table>
                                    </div><!-- PENGALAMAN KERJA -->
                                    <div class="tab-pane" id="tab_13">
                                    	<h4>Jabatan</h4>
                                    <hr style="border-width:2px;"/></th></tr>
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                            	<th width='50'>No.</th>
                                                <th>Perusahaan</th>
                                                <th>Jabatan</th>
                                                <th>Status Pegawai</th>
                                                <th>Awal Kontrak</th>
                                                <th>Akhir Kontrak</th>
                                                <th>AVG Kompetensi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        	<?php
                                        	$CI =& get_instance();$no=1;
											foreach((array)$jabatan as $rowj) {
											    echo "<tr>";
											    echo "<td align='center'>".$no++."</td>";
											    echo "<td align=''>".strtoupper($rowj->idcompany)."</td>";
											    echo "<td align='center'>".strtoupper($rowj->idjabatan)."<br>(".strtoupper($rowj->iddepartemen).")</td>";
											    echo "<td align='center'>".strtoupper($rowj->idpegawai_status)."</td>";
											    echo "<td align='center'>".strtoupper($CI->p_c->tgl_indo($rowj->awal_kontrak))."</td>";
											    echo "<td align='center'>".strtoupper($CI->p_c->tgl_indo($rowj->akhir_kontrak))."</td>";
											    echo "<td align='center'>".$rowj->avg_kompetensi."</td>";
											    echo "</tr>";
											}
											?>

                                        </tbody>
                                        <tfoot>
                                        </tfoot>
                                    </table>
                                    <hr style="border-width:2px;"/></th></tr>
                                    	<h4>Kronologi Kontrak</h4>
                                    <hr style="border-width:2px;"/></th></tr>
                                    <table id="example12" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th width='50'>No.</th>
                                                <th>No. SK</th>
                                                <th>Perusahaan</th>
                                                <th>Tipe Pengangkatan</th>
                                                <th>Jabatan</th>
                                                <th>Status Pegawai</th>
                                                <th>Awal Kontrak</th>
                                                <th>Akhir Kontrak</th>
                                                <th>AVG Kompetensi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        	<?php
                                        	$CI =& get_instance();$no=1;
											foreach((array)$kontrak as $row) {
											    echo "<tr>";
											    echo "<td align='center'>".$no++."</td>";
											    echo "<td align='center'>";
                          echo $row->no_sk;
                          // echo "<a href=javascript:void(window.open('".site_url('kontrak/view/'.$row->replid)."'))>".$row->no_sk."</a>
                          echo "</td>";
											    echo "<td align=''>".strtoupper($row->idcompany)."</td>";
											    echo "<td align='center'>".strtoupper($row->idpegawai_tipe_pengangkatan)."</td>";
											    echo "<td align='center'>".strtoupper($row->idjabatan)."<br>(".strtoupper($row->iddepartemen).")</td>";
											    echo "<td align='center'>".strtoupper($row->idpegawai_status)."</td>";
											    echo "<td align='center'>".strtoupper($CI->p_c->tgl_indo($row->awal_kontrak))."</td>";
											    echo "<td align='center'>".strtoupper($CI->p_c->tgl_indo($row->akhir_kontrak))."</td>";
											    echo "<td align='center'>".$row->avg_kompetensi."</td>";
											    echo "</tr>";
											}
											?>

                                        </tbody>
                                        <tfoot>
                                        </tfoot>
                                    </table>
                                    </div><!-- PENGALAMAN KERJA -->
                                </div><!-- /.tab-content -->
                            </div><!-- nav-tabs-custom -->
                            <!--
                            <a href="javascript:void(window.open('<?php echo site_url('pegawai/ubah/'.$id) ?>'))" class='btn btn-xs btn-warning fa fa-check-square' ></a>&nbsp;&nbsp;";
                            <button class='btn btn-xs btn-danger'>Hapus</button>
                            -->
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
    </body>
</html>
