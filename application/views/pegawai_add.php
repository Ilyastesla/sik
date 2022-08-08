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
                </section>

                <!-- Main content -->
                <section class="content">
                  <?php
                  if($id<>""){
                    echo "<ol class='breadcrumb'>";
                    echo "<li><a href='".site_url('pegawai/ubah/'.$id)."'>Data Diri</a></li>";
                    echo "<li><a href='".site_url('pegawai/ubahkontak/'.$id)."'>Informasi Kontak</a></li>";
                    echo "<li><a href='".site_url('pegawai/ubahperbankan/'.$id)."'>Perbankan</a></li>";
                    echo "<li><a href='".site_url('pegawai/ubahkontakdarurat/'.$id)."'>Kontak Darurat</a></li>";
                    echo "<li><a href='".site_url('pegawai/ubahkeluarga/'.$id)."'>Informasi Keluarga</a></li>";
                    echo "<li><a href='".site_url('pegawai/ubahkepribadian/'.$id)."'>Kepribadian</a></li>";
                    echo "<li><a href='".site_url('pegawai/ubahpendidikan/'.$id)."'>Pendidikan Formal</a></li>";
                    echo "<li><a href='".site_url('pegawai/ubahpendidikan_nf/'.$id)."'>Pendidikan Non Formal</a></li>";
                    echo "<li><a href='".site_url('pegawai/ubahbahasa/'.$id)."'>Kemampuan Bahasa</a></li>";
                    echo "<li><a href='".site_url('pegawai/ubahkomputer/'.$id)."'>Kemampuan Komputer</a></li>";
                    echo "<li><a href='".site_url('pegawai/ubahskill/'.$id)."'>Kemampuan Lainnya</a></li>";
                    echo "<li><a href='".site_url('pegawai/ubahprestasi/'.$id)."'>Prestasi</a></li>";
                    echo "<li><a href='".site_url('pegawai/ubahorganisasi/'.$id)."'>Keorganisasian</a></li>";
                    echo "<li><a href='".site_url('pegawai/ubahkerja/'.$id)."'>Pengalaman Kerja</a></li>";
                    echo "</ol>";
                  }
                  ?>
                    <?php $CI =& get_instance();?>

                    <?php if($view=='datadiri'){?>
	                <h4>Data Diri</h4><hr/>
	                <?php
		                $attributes = array('class' => 'form-horizontal form-validate', 'id' => 'form', 'method' => 'POST', 'novalidate'=>'novalidate');
	                	echo form_open($action,$attributes);
	                ?>
	                <table width="100%" border="0">
					<tr><th width="150">
	                			<label class="control-label" for="minlengthfield">Unit Bisnis</label>
	                			<div class="control-group">
									<div class="controls">:
				                	<?php
        			                		$arridcompany='data-rule-required=true';
        			                		echo form_dropdown('idcompany',$idcompany_opt,$header->idcompany,$arridcompany);
        			                	?>
									</div>
								</div>
	                		</th>
	                	</tr>
	                	<tr><th width="150">
	                			<label class="control-label" for="minlengthfield">NIK</label>
	                			<div class="control-group">
									<div class="controls">:
				                	<?php
				                		if ($header->nip<>NULL){echo $header->nip;}
				                		else{
					                		echo form_input(array('class' => '', 'id' => 'nip','name'=>'nip','value'=>$header->nip,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'12', 'data-rule-minlength'=>'12' ,'placeholder'=>'Masukkan 12 Karakter'));
				                		}

				                	?>
									</div>
								</div>
	                		</th>
	                	</tr>
	                	<tr>
	                	<th align="left">
	                		<label class="control-label" for="minlengthfield">NUPTK</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		echo form_input(array('class' => '', 'id' => 'nuptk','name'=>'nuptk','value'=>$header->nuptk,'data-rule-required'=>'false' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'2' ,'placeholder'=>'Masukkan 2-100 Karakter'));
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th></tr>
			            <tr>
			            <th align="left">
	                		<label class="control-label" for="minlengthfield">NRG</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		echo form_input(array('class' => '', 'id' => 'nrp','name'=>'nrp','value'=>$header->nrp,'data-rule-required'=>'false' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'2' ,'placeholder'=>'Masukkan 2-100 Karakter'));
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th></tr>
			            <tr>
			            <th align="left">
	                		<label class="control-label" for="minlengthfield">Nama</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		echo form_input(array('class' => '', 'id' => 'gelarawal','name'=>'gelarawal','value'=>$header->gelarawal,'data-rule-required'=>'false' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'1' ,'placeholder'=>'Gelar Awal'));
			                		echo form_input(array('class' => '', 'id' => 'nama','name'=>'nama','value'=>$header->nama,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'3' ,'placeholder'=>'Nama Lengkap'));
			                		echo form_input(array('class' => '', 'id' => 'gelarakhir','name'=>'gelarakhir','value'=>$header->gelarakhir,'data-rule-required'=>'false' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'1' ,'placeholder'=>'Gelar Akhir'));
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th></tr>
			            <th align="left">
	                		<label class="control-label" for="minlengthfield">Nama Panggilan</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		echo form_input(array('class' => '', 'id' => 'panggilan','name'=>'panggilan','value'=>$header->panggilan,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'2' ,'placeholder'=>'Masukkan 2-100 Karakter'));
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
	                		<label class="control-label" for="minlengthfield">Kewarganegaraan</label>
	                		<div class="control-group">
        								<div class="controls">:
        			                	<?php
        			                		$arrneg='data-rule-required=true';
        			                		echo form_dropdown('warganegara',$type_negara_opt,$header->warganegara,$arrneg);
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
			                		echo form_input(array('class' => '', 'id' => 'dp1','name'=>'tgllahir','value'=>$CI->p_c->tgl_form($header->tgllahir),'data-rule-required'=>'true' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'2' ,'placeholder'=>'DD-MM-YYYY','autocomplete'=>'off'));
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th></tr>
			            <tr>
			             <th align="left">
	                		<label class="control-label" for="minlengthfield">Golongan Darah</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		$arrdar='data-rule-required=false';
			                		$type_darah_opt=array(''=>'pilih..','A'=>'A','B'=>'B','AB'=>'AB','O'=>'O');
			                		echo form_dropdown('golongan_darah',$type_darah_opt,$header->golongan_darah,$arrdar);
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th></tr>
			            <tr>
			             <th align="left">
	                		<label class="control-label" for="minlengthfield">Agama</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		$arragama='data-rule-required=true';
			                		echo form_dropdown('agama',$type_agama_opt,$header->agama,$arragama);
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th></tr>
			            <tr><th>
			            <h4>Data Tambahan</h4>
			            <hr style="border-width:2px;"/></th></tr>
                  <tr>
			            <th align="left">
	                		<label class="control-label" for="minlengthfield">Nama Gadis Ibu</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		echo form_input(array('class' => '', 'id' => 'nama_gadis_ibu','name'=>'nama_gadis_ibu','value'=>$header->nama_gadis_ibu,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'2' ,'placeholder'=>'Masukkan 2-100 Karakter'));
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th></tr>
			            <tr>
			            <th align="left">
	                		<label class="control-label" for="minlengthfield">Pekerjaan Ibu</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		$arrpek_ibu='data-rule-required=true';
			                		echo form_dropdown('pekerjaan_ibu',$type_pekerjaan_opt,$header->pekerjaan_ibu,$arrpek_ibu);
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th></tr>

			            <th align="left">
	                		<label class="control-label" for="minlengthfield">Nama Ayah</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		echo form_input(array('class' => '', 'id' => 'nama_ayah','name'=>'nama_ayah','value'=>$header->nama_ayah,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'2' ,'placeholder'=>'Masukkan 2-100 Karakter'));
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th></tr>

			            <tr>
			            <th align="left">
	                		<label class="control-label" for="minlengthfield">Pekerjaan Ayah</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		$arrpek_ayah='data-rule-required=true';
			                		echo form_dropdown('pekerjaan_ayah',$type_pekerjaan_opt,$header->pekerjaan_ayah,$arrpek_ayah);
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th></tr>
                  <tr>
			            <th align="left">
	                		<label class="control-label" for="minlengthfield">Anak Ke</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		echo form_input(array('class' => '', 'id' => 'anak_ke','name'=>'anak_ke','value'=>$header->anak_ke,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'1' ,'placeholder'=>'Masukkan 1-100 Karakter','style'=>'width:50px;','data-rule-number'=>'true'));
			                	?>
                        Dari :
                        <?php
			                		echo form_input(array('class' => '', 'id' => 'jml_saudara','name'=>'jml_saudara','value'=>$header->jml_saudara,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'1' ,'placeholder'=>'Masukkan 1-100 Karakter','style'=>'width:50px;','data-rule-number'=>'true'));
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th></tr>
			            <tr>
			            <th align="left">
	                		<label class="control-label" for="minlengthfield">Status Pernikahan</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		$arrstatus_nikah='data-rule-required=true';
			                		echo form_dropdown('status_nikah',$status_nikah_opt,$header->status_nikah,$arrstatus_nikah);
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th></tr>

                  <!--
			            <tr>
			            <th align="left">
	                		<label class="control-label" for="minlengthfield">Tanggal Menikah</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		echo form_input(array('class' => '', 'id' => 'dp2','name'=>'tgl_nikah','value'=>$CI->p_c->tgl_form($header->tgl_nikah),'data-rule-required'=>'false' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'2' ,'placeholder'=>'DD-MM-YYYY','autocomplete'=>'off'));
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th></tr>
			            <tr>
			            <th align="left">
	                		<label class="control-label" for="minlengthfield">Jml. Saudara Kandung</label>
	                		<div class="control-group">
								<div class="controls">:
                        <?php
                          echo form_input(array('class' => '', 'id' => 'jml_saudara','name'=>'jml_saudara','value'=>$header->jml_saudara,'data-rule-required'=>'false' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'1' ,'placeholder'=>'Masukkan 1-100 Karakter','style'=>'width:50px;'));
                        ?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th></tr>
                -->
                <tr>
                <th align="left">
                    <label class="control-label" for="minlengthfield">Jumlah Anak</label>
                    <div class="control-group">
              <div class="controls">:
                      <?php
                        echo form_input(array('class' => '', 'id' => 'jml_anak','name'=>'jml_anak','value'=>$header->jml_anak,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'1' ,'placeholder'=>'Masukkan 1-100 Karakter','style'=>'width:50px;','data-rule-number'=>'true'));
                      ?>
                      <?php //echo  <p id="message"></p> ?>
              </div>
                    </div>
                </th></tr>
			            <tr>
			            <th align="left">
	                		<label class="control-label" for="minlengthfield">Kode Tanggungan Pajak</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		$arrkode_pajak='data-rule-required=true';
			                		echo form_dropdown('kode_pajak',$kode_pajak_opt,$header->kode_pajak,$arrkode_pajak);
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th></tr>

			            <tr><th>
			            <hr style="border-width:2px;"/></th></tr>
                  <!--
			            <tr>
			            <th align="left">
	                		<div class="control-group">
	                			<label class="control-label" for="minlengthfield">Keterangan</label>
								<div class="controls">:
			                	<?php
			                		echo form_textarea(array('class' => '', 'id' => 'keterangan','name'=>'keterangan','value'=>$header->keterangan,'data-rule-required'=>'false' ,'data-rule-maxlength'=>'500', 'data-rule-minlength'=>'2' ,'placeholder'=>'Masukkan 2-500 Karakter'));
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th></tr>
                -->
                </table>
                <table width="100%" border="0">
                  <tr>
                      <td align="left">
                        <button class='btn btn-primary'>Simpan</button>
                        <!--<a href="javascript:void(window.open('<?php echo site_url('pegawai') ?>'))" class="btn btn-success">Batal</a>-->
                        <a href="javascript:window.close();" class="btn btn-danger" >Batal</a>
                        <?php if ($id<>""){ ?>
                        <a href="<?php echo site_url('pegawai/ubahkontak/'.$id) ?>" class='btn btn-success'>Lanjut</a>
                        <?php } ?>
                      </td>
                  </tr>
	                </table>
                    <?php echo form_close();
	                } //datadiri
                  elseif($view=='kontak'){?>
                    <script type="text/javascript">
                    $(document).ready(function(){
                        $("#samadenganatas").click(function(){
                            $("#alamat_tinggal").val($("#alamat_tinggal2").val());
                            $("#kecamatan").val($("#kecamatan2").val());
                            $("#kota").val($("#kota2").val());
                            $("#provinsi").val($("#provinsi2").val());
                            $("#kode_pos").val($("#kode_pos2").val());
                            $("#negara").val($("#negara2").val());
                        });
                      });
                  </script>
	                <h4>Informasi Kontak // <?php echo strtolower($header->nama).' ['.$header->nip.']'?></h4><hr/>
	                <?php
		                $attributes = array('class' => 'form-horizontal form-validate', 'id' => 'form', 'method' => 'POST', 'novalidate'=>'novalidate');
	                	echo form_open($action,$attributes);
	                	?>
	                	<table width="100%" border="0">
	                	<tr>
			            <th align="left">
	                		<label class="control-label" for="minlengthfield">Alamat Identitas</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		echo form_textarea(array('class' => '', 'id' => 'alamat_tinggal2','name'=>'alamat_tinggal2','value'=>$header->alamat_tinggal2,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'500', 'data-rule-minlength'=>'2' ,'placeholder'=>'Masukkan 2-500 Karakter'));
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
			                		echo form_input(array('class' => '', 'id' => 'kecamatan2','name'=>'kecamatan2','value'=>$header->kecamatan2,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'200', 'data-rule-minlength'=>'2' ,'placeholder'=>'Masukkan 2-200 Karakter'));
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
			                		echo form_input(array('class' => '', 'id' => 'kota2','name'=>'kota2','value'=>$header->kota2,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'200', 'data-rule-minlength'=>'2' ,'placeholder'=>'Masukkan 2-200 Karakter'));
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
			                		echo form_input(array('class' => '', 'id' => 'provinsi2','name'=>'provinsi2','value'=>$header->provinsi2,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'200', 'data-rule-minlength'=>'2' ,'placeholder'=>'Masukkan 2-200 Karakter'));
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
			                		echo form_input(array('class' => '', 'id' => 'kode_pos2','name'=>'kode_pos2','value'=>$header->kode_pos2,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'200', 'data-rule-minlength'=>'2','data-rule-number'=>'true','placeholder'=>'Masukkan 2-200 Karakter'));
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
			                		$arrneg2='data-rule-required=true id="negara2"';
			                		echo form_dropdown('negara2',$type_negara_opt,$header->negara2,$arrneg2);
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th></tr>
                  <!--
			            <tr>
			            <th align="left">
	                		<label class="control-label" for="minlengthfield">Tinggal Sejak</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		echo form_input(array('class' => '', 'id' => 'dp1','name'=>'tinggal_sejak','value'=>$CI->p_c->tgl_form($header->tinggal_sejak),'data-rule-required'=>'false' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'2' ,'placeholder'=>'DD-MM-YYYY','autocomplete'=>'off'));
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th></tr>
                -->

			            <tr><th><hr style="border-width:2px;"/></th></tr>
                  <tr>
                <th align="left">
                    <label class="control-label" for="minlengthfield"><b>Sama Dengan Atas?</b></label>
                    <div class="control-group">
              <div class="controls">:
                <input type="checkbox" id="samadenganatas">
              </div>
                    </div>
                </th></tr>
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
			                		$arrneg='data-rule-required=true id="negara"';
			                		echo form_dropdown('negara',$type_negara_opt,$header->negara,$arrneg);
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th></tr>
                  <!--
			            <tr>
			            <th align="left">
	                		<label class="control-label" for="minlengthfield">Tinggal Sejak</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		echo form_input(array('class' => '', 'id' => 'dp2','name'=>'tinggal_sejak2','value'=>$CI->p_c->tgl_form($header->tinggal_sejak2),'data-rule-required'=>'false' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'2' ,'placeholder'=>'DD-MM-YYYY','autocomplete'=>'off'));
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th></tr>
                -->

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
	                		<label class="control-label" for="minlengthfield">No. Handphone/WA</label>
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
                  <!--
			            <tr>
			            <th align="left">
	                		<label class="control-label" for="minlengthfield">Pin BBM</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		echo form_input(array('class' => '', 'id' => 'bbm','name'=>'bbm','value'=>$header->bbm,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'200', 'data-rule-minlength'=>'2' ,'placeholder'=>'Masukkan 2-200 Karakter'));
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th></tr>
                -->
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
			                		echo form_input(array('class' => '', 'id' => 'instagram','name'=>'instagram','value'=>$header->instagram,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'200', 'data-rule-minlength'=>'2' ,'placeholder'=>'Masukkan 2-200 Karakter'));
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th></tr>
			            <tr>
			            <th align="left">
	                		<label class="control-label" for="minlengthfield">Facebook</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		echo form_input(array('class' => '', 'id' => 'facebook','name'=>'facebook','value'=>$header->facebook,'data-rule-required'=>'false' ,'data-rule-maxlength'=>'200', 'data-rule-minlength'=>'2' ,'placeholder'=>'Masukkan 2-200 Karakter'));
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th></tr>
			            <tr>
			            <th align="left">
	                		<label class="control-label" for="minlengthfield">Twitter</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		echo form_input(array('class' => '', 'id' => 'twitter','name'=>'twitter','value'=>$header->twitter,'data-rule-required'=>'false' ,'data-rule-maxlength'=>'200', 'data-rule-minlength'=>'2' ,'placeholder'=>'Masukkan 2-200 Karakter'));
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th></tr>
			            <tr>
			            <th align="left">
	                		<label class="control-label" for="minlengthfield">Website</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		echo form_input(array('class' => '', 'id' => 'website','name'=>'website','value'=>$header->website,'data-rule-required'=>'false' ,'data-rule-maxlength'=>'200', 'data-rule-minlength'=>'2','placeholder'=>'Masukkan 2-200 Karakter'));
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th></tr>

                  <table width="100%" border="0">
                    <tr>
                        <td align="left">
      	                	<button class='btn btn-primary'>Simpan</button>
      	                	<a href="<?php echo site_url('pegawai/ubah/'.$id) ?>" class='btn btn-warning'>Kembali</a>
                          <a href="<?php echo site_url('pegawai/ubahperbankan/'.$id) ?>" class='btn btn-success'>Lanjut</a>
                        </td>
                    </tr>
                  </table>
                    <?php
	                	echo form_close();
	                }elseif($view=='perbankan'){?>
	                <h4>Perbankan  // <?php echo strtolower($header->nama).' ['.$header->nip.']'?></h4><hr/>
	                <?php
		                $attributes = array('class' => 'form-horizontal form-validate', 'id' => 'form', 'method' => 'POST', 'novalidate'=>'novalidate');
	                	?>
	                	<section class="content-header" align="right">
		                    <ol class="breadcrumb">
		                        <li><a href="javascript:void(window.open('<?php echo site_url('pegawai/tambahperbankan/'.$id); ?>'))" ><i class="fa fa-plus-square"></i> Tambah</a></li>
		                    </ol>
		                </section>

	                	<table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Tipe</th>
                                    <th>Nomor</th>
                                    <!--
                                    <th>Tgl. Pembuatan</th>
                                    <th>Berlaku</th>
                                    -->
                                    <th>Keterangan</th>
                                    <th>Aksi</th>
                                </tr>

                            </thead>
                            <tbody>
                            	<?php
                              $noperbankan=1;
                            	$CI =& get_instance();
								foreach((array)$perbankan as $rowx) {
								    echo "<tr>";
                      echo "<td align='center'>".$noperbankan++."</td>";
								    	echo "<td align='center'>".$rowx->type."</td>";
								    	echo "<td align='center'>".$rowx->nomor."</td>";
								    	//echo "<td align='center'>".$CI->p_c->tgl_indo($rowx->tgl_pembuatan)."</td>";
								    	//echo "<td align='center'>".$CI->p_c->tgl_indo($rowx->berlaku)."</td>";
									    echo "<td align='center'>".$rowx->keterangan."</td>";
									    echo "<td align='center' width='150'>";
										  echo "<a href=javascript:void(window.open('".site_url('pegawai/tambahperbankan/'.$rowx->pegawai_id.'/'.$rowx->replid)."')) class='btn btn-warning' >Ubah</a>";
                      echo "&nbsp;&nbsp;<a href=javascript:void(window.open('".site_url('pegawai/hapusperbankan/'.$rowx->pegawai_id.'/'.$rowx->replid)."')) class='btn btn-danger' >Hapus</a>";
									    echo "</td>";
								    echo "</tr>";
								}
								?>
                            </tbody>
                            <tfoot>
                            </tfoot>
	                	</table>

	                	<a href="<?php echo site_url('pegawai/ubahkontak/'.$id) ?>" class='btn btn-warning'>Kembali</a>
	                	<a href="<?php echo site_url('pegawai/ubahkontakdarurat/'.$id) ?>" class="btn btn-success">Lanjut</a>
	                	<?php
	                }elseif($view=='tambah_perbankan'){?>
	                <h4>Identitas/ Perbankan // <?php echo strtolower($header->nama).' ['.$header->nip.']'?></h4><hr/>
	                <?php
		                $attributes = array('class' => 'form-horizontal form-validate', 'id' => 'form', 'method' => 'POST', 'novalidate'=>'novalidate');
	                	echo form_open($action,$attributes);
	                	?>
                    <table width="100%" border="0">
	                	<tr>
			            <th align="left">
	                		<label class="control-label" for="minlengthfield">Type</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		$arrtype='data-rule-required=true';
			                		echo form_dropdown('type',$type_type_opt,$isi->type,$arrtype);
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th></tr>
	                	<tr>
			            <th align="left">
	                		<label class="control-label" for="minlengthfield">Nomor</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		echo form_input(array('class' => '', 'id' => 'nomor','name'=>'nomor','value'=>$isi->nomor,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'500', 'data-rule-minlength'=>'2' ,'placeholder'=>'Masukkan 2-500 Karakter','size'=>'15'));
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th></tr>
                  <!--
			            <tr>
			            <th align="left">
	                		<label class="control-label" for="minlengthfield">Tgl. Pembuatan</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		echo form_input(array('class' => '', 'id' => 'dp1','name'=>'tgl_pembuatan','value'=>$CI->p_c->tgl_form($isi->tgl_pembuatan),'data-rule-required'=>'false' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'2' ,'placeholder'=>'DD-MM-YYYY','autocomplete'=>'off'));
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th></tr>
			            <tr>
			            <th align="left">
	                		<label class="control-label" for="minlengthfield">Berlaku s/d</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		echo form_input(array('class' => '', 'id' => 'dp2','name'=>'berlaku','value'=>$CI->p_c->tgl_form($isi->berlaku),'data-rule-required'=>'false' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'2' ,'placeholder'=>'DD-MM-YYYY','autocomplete'=>'off'));
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th></tr>
                -->
			            <tr>
			            <th align="left">
	                		<label class="control-label" for="minlengthfield">Keterangan</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		echo form_input(array('class' => '', 'id' => 'keterangan','name'=>'keterangan','value'=>$isi->keterangan,'data-rule-required'=>'false' ,'data-rule-maxlength'=>'500', 'data-rule-minlength'=>'1' ,'placeholder'=>'Masukkan 1-500 Karakter','size'=>'15'));
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th></tr>
                  <table width="100%" border="0">
                    <tr>
                        <td align="left">
        			            <button class='btn btn-primary'>Simpan</button>
        	                <!-- <a href="javascript:void(window.open('<?php echo site_url('pegawai/ubahperbankan/'.$id_pegawai) ?>'))" class="btn btn-success">Batal</a> -->
                          <a href="javascript:window.close();" class="btn btn-danger" >Batal</a>
                        </td>
                    </tr>
                  </table>
                    <?php
	                	echo form_close();
	                }
	                elseif($view=='kontak_darurat'){?>
	                <h4>Kontak Darurat  // <?php echo strtolower($header->nama).' ['.$header->nip.']'?></h4><hr/>
	                <?php
		                $attributes = array('class' => 'form-horizontal form-validate', 'id' => 'form', 'method' => 'POST', 'novalidate'=>'novalidate');
	                	?>
	                	<section class="content-header" align="right">
		                    <ol class="breadcrumb">
		                        <li><a href="javascript:void(window.open('<?php echo site_url('pegawai/tambahkontakdarurat/'.$id); ?>'))" ><i class="fa fa-plus-square"></i> Tambah</a></li>
		                    </ol>
		                </section>

	                	<table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                  <th>No.</th>
                                    <th>Nama</th>
                                    <th>Hubungan</th>
                                    <th>Alamat</th>
                                    <th>Telepon</th>
                                    <th>Handphone</th>
                                    <th>Email</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            	<?php
                            	$CI =& get_instance();
                              $nokontakdarurat=1;
								foreach((array)$kontakdarurat as $rowx) {
								    echo "<tr>";
                      echo "<td align='center'>".$nokontakdarurat++."</td>";
								    	echo "<td align='center'>".$rowx->nama."</td>";
								    	echo "<td align='center'>".$rowx->hubungan."</td>";
									    echo "<td align=''>".$rowx->alamat.' '.$rowx->kecamatan.' '.$rowx->kota.$rowx->provinsi.' '.$rowx->kode_pos.' '.$rowx->negara."</td>";
									    echo "<td align='center'>".$rowx->telepon."</td>";
									    echo "<td align='center'>".$rowx->handphone."</td>";
									    echo "<td align='center'>".$rowx->email."</td>";
									    echo "<td align='center' width='150'>";
                      echo "<a href=javascript:void(window.open('".site_url('pegawai/tambahkontakdarurat/'.$rowx->pegawai_id.'/'.$rowx->replid)."')) class='btn btn-warning'>Ubah</a>";
                      echo "&nbsp;&nbsp;<a href=javascript:void(window.open('".site_url('pegawai/hapuskontakdarurat/'.$rowx->pegawai_id.'/'.$rowx->replid)."')) class='btn btn-danger' >Hapus</a>";
									    echo "</td>";
								    echo "</tr>";
								}
								?>
                            </tbody>
                            <tfoot>
                            </tfoot>
	                	</table>

	                	<a href="<?php echo site_url('pegawai/ubahperbankan/'.$id) ?>" class='btn btn-warning'>Kembali</a>
	                	<a href="<?php echo site_url('pegawai/ubahkeluarga/'.$id) ?>" class="btn btn-success">Lanjut</a>
	                	<?php
	                }
	                elseif($view=='tambah_kontak_darurat'){?>
	                <h4>Kontak Darurat  // <?php echo strtolower($header->nama).' ['.$header->nip.']'?></h4><hr/>
	                <?php
		                $attributes = array('class' => 'form-horizontal form-validate', 'id' => 'form', 'method' => 'POST', 'novalidate'=>'novalidate');
	                	echo form_open($action,$attributes);
	                	?>
                    <table width="100%" border="0">
	                	<tr>
			            <th align="left">
	                		<label class="control-label" for="minlengthfield">Nama</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		echo form_input(array('class' => '', 'id' => 'nama','name'=>'nama','value'=>$isi->nama,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'500', 'data-rule-minlength'=>'2' ,'placeholder'=>'Masukkan 2-500 Karakter','size'=>'15'));
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th></tr>
			            <tr>
			            <th align="left">
	                		<label class="control-label" for="minlengthfield">Hubungan Keluarga</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		$arrhub='data-rule-required=true';
			                		echo form_dropdown('hubungan',$type_hubungan_opt,$isi->hubungan,$arrhub);
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th></tr>
	                	<tr>
			            <th align="left">
	                		<label class="control-label" for="minlengthfield">Alamat Tinggal</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		echo form_textarea(array('class' => '', 'id' => 'alamat','name'=>'alamat','value'=>$isi->alamat,'data-rule-required'=>'false' ,'data-rule-maxlength'=>'500', 'data-rule-minlength'=>'2' ,'placeholder'=>'Masukkan 2-500 Karakter','size'=>'15'));
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
			                		echo form_input(array('class' => '', 'id' => 'kecamatan','name'=>'kecamatan','value'=>$isi->kecamatan,'data-rule-required'=>'false' ,'data-rule-maxlength'=>'200', 'data-rule-minlength'=>'2' ,'placeholder'=>'Masukkan 2-200 Karakter'));
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
			                		echo form_input(array('class' => '', 'id' => 'kota','name'=>'kota','value'=>$isi->kota,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'200', 'data-rule-minlength'=>'2' ,'placeholder'=>'Masukkan 2-200 Karakter'));
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
			                		echo form_input(array('class' => '', 'id' => 'provinsi','name'=>'provinsi','value'=>$isi->provinsi,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'200', 'data-rule-minlength'=>'2' ,'placeholder'=>'Masukkan 2-200 Karakter'));
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
			                		echo form_input(array('class' => '', 'id' => 'kode_pos','name'=>'kode_pos','value'=>$isi->kode_pos,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'200', 'data-rule-minlength'=>'2','data-rule-number'=>'true' ,'placeholder'=>'Masukkan 2-200 Karakter'));
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
			                		echo form_dropdown('negara',$type_negara_opt,$isi->negara,$arrneg);
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
			                		echo form_input(array('class' => '', 'id' => 'telepon','name'=>'telepon','value'=>$isi->telepon,'data-rule-required'=>'false' ,'data-rule-maxlength'=>'200', 'data-rule-minlength'=>'2' ,'placeholder'=>'Masukkan 2-200 Karakter'));
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th></tr>
			            <tr>
			            <th align="left">
	                		<label class="control-label" for="minlengthfield">Handphone</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		echo form_input(array('class' => '', 'id' => 'handphone','name'=>'handphone','value'=>$isi->handphone,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'200', 'data-rule-minlength'=>'2' ,'placeholder'=>'Masukkan 2-200 Karakter'));
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th></tr>
			            <tr>
			            <th align="left">
	                		<label class="control-label" for="minlengthfield">Email</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		echo form_input(array('class' => '', 'id' => 'email','name'=>'email','value'=>$isi->email,'data-rule-required'=>'false' ,'data-rule-maxlength'=>'200', 'data-rule-minlength'=>'2','data-rule-email'=>'true' ,'placeholder'=>'Masukkan 2-100 Karakter'));
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th></tr>
                  <table width="100%" border="0">
                    <tr>
                        <td align="left">
      	                	<button class='btn btn-primary'>Simpan</button>
      	                	<!-- <a href="javascript:void(window.open('<?php echo site_url('pegawai/ubahkontakdarurat/'.$id_pegawai) ?>'))" class="btn btn-success">Batal</a> -->
                          <a href="javascript:window.close();" class="btn btn-danger" >Batal</a>
                        </td>
                    </tr>
                    </table>
                    <?php
	                	echo form_close();
	                }

	                elseif($view=='keluarga'){?>
	                <h4>Informasi Keluarga  // <?php echo strtolower($header->nama).' ['.$header->nip.']'?></h4><hr/>
	                <?php
		                $attributes = array('class' => 'form-horizontal form-validate', 'id' => 'form', 'method' => 'POST', 'novalidate'=>'novalidate');
	                	?>
	                	<section class="content-header" align="right">
		                    <ol class="breadcrumb">
		                        <li><a href="javascript:void(window.open('<?php echo site_url('pegawai/tambahkeluarga/'.$id); ?>'))" ><i class="fa fa-plus-square"></i> Tambah</a></li>
		                    </ol>
		                </section>

	                	<table id="example2" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama</th>
                                    <th>Hubungan</th>
                                    <th>Jenis Kelamin</th>
                                    <th>TTL</th>
                                    <th>Umur</th>
                                    <th>Pendidikan Terakhir</th>
                                    <th>Pekerjaan</th>
                                    <!--
                                    <th>Instansi</th>
                                    -->
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            	<?php
                              $nokeluarga=1;
                            	$CI =& get_instance();
								foreach((array)$keluarga as $rowx) {
								    echo "<tr>";
                    echo "<td align='center'>".$nokeluarga++."</td>";
								    	echo "<td align='center'>".$rowx->nama."</td>";
								    	echo "<td align='center'>".$rowx->hubungan."</td>";
									    echo "<td align=''>".$CI->p_c->jk($rowx->jenis_kelamin)."</td>";
									    echo "<td align='center'>".$rowx->tempat_lahir.', '.$CI->p_c->tgl_indo($rowx->tanggal_lahir)."</td>";
									    echo "<td align='center'>".$rowx->umur."</td>";
									    echo "<td align='center'>".$rowx->pendidikan_terakhir."</td>";
									    echo "<td align='center'>".$rowx->pekerjaan."</td>";
									    //echo "<td align='center'>".$rowx->instansi."</td>";
									    echo "<td align='center' width='150'>";
                      echo "<a href=javascript:void(window.open('".site_url('pegawai/tambahkeluarga/'.$rowx->pegawai_id.'/'.$rowx->replid)."')) class='btn btn-warning'>Ubah</a>";
                      echo "&nbsp;&nbsp;<a href=javascript:void(window.open('".site_url('pegawai/hapuskeluarga/'.$rowx->pegawai_id.'/'.$rowx->replid)."')) class='btn btn-danger' >Hapus</a>";
									    echo "</td>";
								    echo "</tr>";
								}
								?>
                            </tbody>
                            <tfoot>
                            </tfoot>
	                	</table>

	                	<a href="<?php echo site_url('pegawai/ubahkontakdarurat/'.$id) ?>" class='btn btn-warning'>Kembali</a>
	                	<a href="<?php echo site_url('pegawai/ubahkepribadian/'.$id) ?>" class="btn btn-success">Lanjut</a>
	                	<?php
	                }
	                elseif($view=='tambah_keluarga'){?>
	                <h4>Keluarga  // <?php echo strtolower($header->nama).' ['.$header->nip.']'?></h4><hr/>
	                <?php
		                $attributes = array('class' => 'form-horizontal form-validate', 'id' => 'form', 'method' => 'POST', 'novalidate'=>'novalidate');
	                	echo form_open($action,$attributes);
	                	?>
                    <table width="100%" border="0">
	                	<tr>
			            <th align="left">
	                		<label class="control-label" for="minlengthfield">Nama</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		echo form_input(array('class' => '', 'id' => 'nama','name'=>'nama','value'=>$isi->nama,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'500', 'data-rule-minlength'=>'2' ,'placeholder'=>'Masukkan 2-500 Karakter','size'=>'15'));
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th></tr>
			            <tr>
			            <th align="left">
	                		<label class="control-label" for="minlengthfield">Hubungan Keluarga</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		$arrhub='data-rule-required=true';
			                		echo form_dropdown('hubungan',$type_hubungan_opt,$isi->hubungan,$arrhub);
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
                          /*
			                		if (strtolower(trim($isi->jenis_kelamin))=='l'){$l=TRUE;$p=FALSE;}
			                		elseif (strtolower(trim($isi->jenis_kelamin))=='p'){$p=TRUE;$l=FALSE;}
			                		else {$l=FALSE;$p=FALSE;};

			                		echo form_radio(array('id' => 'jenis_kelamin','name'=>'jenis_kelamin','value'=>'L','style'=> 'margin:100px','checked'=> $l)).' Laki-Laki &nbsp;&nbsp;&nbsp;';
			                		echo form_radio(array('id' => 'jenis_kelamin','name'=>'jenis_kelamin','value'=>'P','style'=> 'margin-right:100px','checked'=> $p)).' Perempuan';
                          */
                        ?>
                        <?php
                          $arrkelamin='data-rule-required=true';
                          $kelamin_opt=array(''=>'pilih..','L'=>'Laki-Laki','P'=>'Perempuan');
                          echo form_dropdown('jenis_kelamin',$kelamin_opt,$isi->jenis_kelamin,$arrkelamin);
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
			                		echo form_input(array('class' => '', 'id' => 'tempat_lahir','name'=>'tempat_lahir','value'=>$isi->tempat_lahir,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'2' ,'placeholder'=>'Masukkan 2-100 Karakter'));
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
			                		echo form_input(array('class' => '', 'id' => 'dp1','name'=>'tanggal_lahir','value'=>$CI->p_c->tgl_form($isi->tanggal_lahir),'data-rule-required'=>'true' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'2' ,'placeholder'=>'DD-MM-YYYY','autocomplete'=>'off'));
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th></tr>
			            <tr>
			            <th align="left">
	                		<label class="control-label" for="minlengthfield">Pendidikan Terakhir</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		$arrpend='data-rule-required=false';
			                		echo form_dropdown('pendidikan_terakhir',$type_pendidikan_terakhir_opt,$isi->pendidikan_terakhir,$arrpend);
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th></tr>
			            <tr>
			            <th align="left">
	                		<label class="control-label" for="minlengthfield">Pekerjaan</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		$arrpek='data-rule-required=false';
			                		echo form_dropdown('pekerjaan',$type_pekerjaan_opt,$isi->pekerjaan,$arrpek);
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th></tr>
                  <!--
			            <tr>
			            <th align="left">
	                		<label class="control-label" for="minlengthfield">Instansi</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		$arrins='data-rule-required=false';
			                		echo form_dropdown('instansi',$type_instansi_opt,$isi->instansi,$arrins);
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th></tr>
                -->
              </table>
                  <table width="100%" border="0">
                    <tr>
                        <td align="left">
        			            <button class='btn btn-primary'>Simpan</button>
        	                	<!-- <a href="javascript:void(window.open('<?php echo site_url('pegawai/ubahkeluarga/'.$id_pegawai) ?>'))" class="btn btn-success">Batal</a> -->
                            <a href="javascript:window.close();" class="btn btn-danger" >Batal</a>
                          </td>
                      </tr>
                      </table>
	                	<?php
	                	echo form_close();
		            }
	                elseif($view=='kepribadian'){?>
	                <h4>Kepribadian  // <?php echo strtolower($header->nama).' ['.$header->nip.']'?></h4><hr/>
	                <?php
		                $attributes = array('class' => 'form-horizontal form-validate', 'id' => 'form', 'method' => 'POST', 'novalidate'=>'novalidate');
	                	echo form_open($action,$attributes);
	                	?>
	                	<table width="100%" border="0">
	                	<tr>
			            <th align="left">
	                		<label class="control-label" for="minlengthfield">Berat Badan</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		echo form_input(array('class' => '', 'id' => 'berat_badan','name'=>'berat_badan','value'=>$header->berat_badan,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'2','data-rule-number'=>'true','placeholder'=>'Masukkan 2-100 Karakter'));
			                	?> Kg
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th></tr>
			            <tr>
			            <th align="left">
	                		<label class="control-label" for="minlengthfield">Tinggi Badan</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		echo form_input(array('class' => '', 'id' => 'tinggi_badan','name'=>'tinggi_badan','value'=>$header->tinggi_badan,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'2','data-rule-number'=>'true','placeholder'=>'Masukkan 2-100 Karakter'));
			                	?>
			                	 Cm
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th></tr>

			            <tr>
			            <th align="left">
	                		<label class="control-label" for="minlengthfield">Hobi</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		echo form_textarea(array('class' => '', 'id' => 'hobi','name'=>'hobi','value'=>$header->hobi,'data-rule-required'=>'false' ,'data-rule-maxlength'=>'500', 'data-rule-minlength'=>'2' ,'placeholder'=>'Masukkan 2-500 Karakter'));
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th></tr>
                  <!--
			            <tr>
			            <th align="left">
	                		<label class="control-label" for="minlengthfield">Warna Kesukaan</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		echo form_textarea(array('class' => '', 'id' => 'warna','name'=>'warna','value'=>$header->warna,'data-rule-required'=>'false' ,'data-rule-maxlength'=>'500', 'data-rule-minlength'=>'2' ,'placeholder'=>'Masukkan 2-500 Karakter'));
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th></tr>
			            <tr>
			            <th align="left">
	                		<label class="control-label" for="minlengthfield">Barang Kesukaan</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		echo form_textarea(array('class' => '', 'id' => 'barang','name'=>'barang','value'=>$header->barang,'data-rule-required'=>'false' ,'data-rule-maxlength'=>'500', 'data-rule-minlength'=>'2' ,'placeholder'=>'Masukkan 2-500 Karakter'));
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th></tr>

			            <tr>
			            <th align="left">
	                		<label class="control-label" for="minlengthfield">Ukuran Celana</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		echo form_input(array('class' => '', 'id' => 'ukuran_celana','name'=>'ukuran_celana','value'=>$header->ukuran_celana,'data-rule-required'=>'false' ,'data-rule-maxlength'=>'2','data-rule-number'=>'true', 'data-rule-minlength'=>'1' ,'placeholder'=>'Masukkan 2 Karakter'));
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th></tr>
			            <tr>
			            <th align="left">
	                		<label class="control-label" for="minlengthfield">Ukuran Baju</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		$arrukuran_baju='data-rule-required=false';
			                		echo form_dropdown('ukuran_baju',$ukuran_baju_opt,$header->ukuran_baju,$arrukuran_baju);
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th></tr>
			            <tr>
			            <th align="left">
	                		<label class="control-label" for="minlengthfield">Ukuran Sepatu</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		echo form_input(array('class' => '', 'id' => 'ukuran_sepatu','name'=>'ukuran_sepatu','value'=>$header->ukuran_sepatu,'data-rule-required'=>'false' ,'data-rule-maxlength'=>'2', 'data-rule-minlength'=>'1','data-rule-number'=>'true','placeholder'=>'Masukkan 2 Karakter'));
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th></tr>

			            <tr>
			            <th align="left">
	                		<label class="control-label" for="minlengthfield">Motto Hidup</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		echo form_textarea(array('class' => '', 'id' => 'motto','name'=>'motto','value'=>$header->motto,'data-rule-required'=>'false' ,'data-rule-maxlength'=>'500', 'data-rule-minlength'=>'2' ,'placeholder'=>'Masukkan 2-500 Karakter'));
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th></tr>
			            <tr>
			            <th align="left">
	                		<label class="control-label" for="minlengthfield">Tokoh Inspiratif</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		echo form_textarea(array('class' => '', 'id' => 'tokoh','name'=>'tokoh','value'=>$header->tokoh,'data-rule-required'=>'false' ,'data-rule-maxlength'=>'500', 'data-rule-minlength'=>'2' ,'placeholder'=>'Masukkan 2-500 Karakter'));
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th></tr>
			            <tr>
			            <th align="left">
	                		<label class="control-label" for="minlengthfield">Target Yang Ingin Dicapai</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		echo form_textarea(array('class' => '', 'id' => 'target','name'=>'target','value'=>$header->target,'data-rule-required'=>'false' ,'data-rule-maxlength'=>'500', 'data-rule-minlength'=>'2' ,'placeholder'=>'Masukkan 2-500 Karakter'));
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th></tr>
                -->
			            <tr>
			            <th align="left">
	                		<label class="control-label" for="minlengthfield">Merokok</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		if (strtolower(trim($header->merokok))=='1'){$y=TRUE;$t=FALSE;}
			                		elseif (strtolower(trim($header->merokok))=='0'){$t=TRUE;$y=FALSE;}
			                		else {$y=FALSE;$t=FALSE;};
			                		echo form_radio(array('id' => 'merokok','name'=>'merokok','value'=>'1','checked'=> $y)).' Ya';
			                		echo form_radio(array('id' => 'merokok','name'=>'merokok','value'=>'0','checked'=> $t)).' Tidak';
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th></tr>
			            <tr>
			            <th align="left">
	                		<label class="control-label" for="minlengthfield">Sakit Ringan Yang Pernah Dialami</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		echo form_textarea(array('class' => '', 'id' => 'sakit_ringan','name'=>'sakit_ringan','value'=>$header->sakit_ringan,'data-rule-required'=>'false' ,'data-rule-maxlength'=>'500', 'data-rule-minlength'=>'2' ,'placeholder'=>'Masukkan 2-500 Karakter'));
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th></tr>
			            <tr>
			            <th align="left">
	                		<label class="control-label" for="minlengthfield">Sakit Berat Yang Pernah Dialami</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		echo form_textarea(array('class' => '', 'id' => 'sakit_berat','name'=>'sakit_berat','value'=>$header->sakit_berat,'data-rule-required'=>'false' ,'data-rule-maxlength'=>'500', 'data-rule-minlength'=>'2' ,'placeholder'=>'Masukkan 2-500 Karakter'));
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th></tr>
			            <tr>
			            <th align="left">
	                		<label class="control-label" for="minlengthfield">Kondisi Saat Ini</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		echo form_textarea(array('class' => '', 'id' => 'kondisi_sekarang','name'=>'kondisi_sekarang','value'=>$header->kondisi_sekarang,'data-rule-required'=>'false' ,'data-rule-maxlength'=>'500', 'data-rule-minlength'=>'2' ,'placeholder'=>'Masukkan 2-500 Karakter'));
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th></tr>

			            <tr>
			            <th align="left">
	                		<label class="control-label" for="minlengthfield">Sifat Positif Yang Dimiliki</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		echo form_textarea(array('class' => '', 'id' => 'sifat_positif','name'=>'sifat_positif','value'=>$header->sifat_positif,'data-rule-required'=>'false' ,'data-rule-maxlength'=>'500', 'data-rule-minlength'=>'2' ,'placeholder'=>'Masukkan 2-500 Karakter'));
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th></tr>
			            <tr>
			            <th align="left">
	                		<label class="control-label" for="minlengthfield">Sifat Negatif Yang Dimiliki</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		echo form_textarea(array('class' => '', 'id' => 'sifat_negatif','name'=>'sifat_negatif','value'=>$header->sifat_negatif,'data-rule-required'=>'false' ,'data-rule-maxlength'=>'500', 'data-rule-minlength'=>'2' ,'placeholder'=>'Masukkan 2-500 Karakter'));
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th></tr>
			            <tr>
			            <th align="left">
	                		<label class="control-label" for="minlengthfield">Minat</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		echo form_textarea(array('class' => '', 'id' => 'minat','name'=>'minat','value'=>$header->minat,'data-rule-required'=>'false' ,'data-rule-maxlength'=>'500', 'data-rule-minlength'=>'2' ,'placeholder'=>'Masukkan 2-500 Karakter'));
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th></tr>
			            <!--
			            <tr>
			            <th align="left" valign="top">
	                		<label class="control-label" for="minlengthfield">Perkembangan Pribadi</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		echo form_textarea(array('class' => '', 'id' => 'perkembangan_pribadi','name'=>'perkembangan_pribadi','value'=>$header->perkembangan_pribadi,'data-rule-required'=>'false' ,'data-rule-maxlength'=>'500', 'data-rule-minlength'=>'2' ,'placeholder'=>'Masukkan 2-500 Karakter'));
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th></tr>
			            <tr>
			            -->
			            <th align="left">
	                		<label class="control-label" for="minlengthfield">Daftar Buku</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		echo form_textarea(array('class' => '', 'id' => 'daftar_buku','name'=>'daftar_buku','value'=>$header->daftar_buku,'data-rule-required'=>'false' ,'data-rule-maxlength'=>'500', 'data-rule-minlength'=>'2' ,'placeholder'=>'Masukkan 2-500 Karakter'));
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th></tr>
			            <tr>
			            <th align="left">
	                		<label class="control-label" for="minlengthfield">Alasan Bekerja di Sekolah Kak Seto</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		echo form_textarea(array('class' => '', 'id' => 'alasan_bekerja','name'=>'alasan_bekerja','value'=>$header->alasan_bekerja,'data-rule-required'=>'false' ,'data-rule-maxlength'=>'500', 'data-rule-minlength'=>'2' ,'placeholder'=>'Masukkan 2-500 Karakter'));
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th></tr>

                  <table width="100%" border="0">
                    <tr>
                        <td align="left">
                            <button class='btn btn-primary'>Simpan</button>
	                	        <a href="<?php echo site_url('pegawai/ubahkeluarga/'.$id) ?>" class='btn btn-warning'>Kembali</a>
                            <a href="<?php echo site_url('pegawai/ubahpendidikan/'.$id) ?>" class="btn btn-success">Lanjut</a>
                          </td>
                      </tr>
                      </table>
                    <?php
	                	echo form_close();
	                }elseif($view=='pendidikan'){?>
	                <h4>Pendidikan Formal  // <?php echo strtolower($header->nama).' ['.$header->nip.']'?></h4><hr/>
	                <?php
		                $attributes = array('class' => 'form-horizontal form-validate', 'id' => 'form', 'method' => 'POST', 'novalidate'=>'novalidate');
	                	?>
	                	<section class="content-header" align="right">
		                    <ol class="breadcrumb">
		                        <li><a href="javascript:void(window.open('<?php echo site_url('pegawai/tambahpendidikan/'.$id); ?>'))" ><i class="fa fa-plus-square"></i> Tambah</a></li>
		                    </ol>
		                </section>

	                	<table id="example2" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Tahun Masuk</th>
                                    <th>Tahun Keluar</th>
                                    <th>Jenjang Pendidikan</th>
                                    <th>Institusi</th>
                                    <th>Fakultas</th>
                                    <th>Jurusan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            	<?php
                            	$CI =& get_instance();
                              $nopendidikan=1;
								foreach((array)$pendidikan as $rowx) {
								    echo "<tr>";
                    echo "<td align='center'>".$nopendidikan++."</td>";
                    echo "<td align='center'>".$rowx->tahun_masuk."</td>";
                    echo "<td align='center'>".$rowx->tahun_keluar."</td>";

								    	echo "<td align='center'>".$rowx->jenjang."</td>";
								    	echo "<td align='center'>".$rowx->institusi."</td>";
								    	echo "<td align='center'>".$rowx->fakultas."</td>";
								    	echo "<td align='center'>".$rowx->jurusan."</td>";
									    echo "<td align='center' width='150'>";
                      echo "<a href=javascript:void(window.open('".site_url('pegawai/tambahpendidikan/'.$rowx->pegawai_id.'/'.$rowx->replid)."')) class='btn btn-warning'>Ubah</a>";
                      echo "&nbsp;&nbsp;<a href=javascript:void(window.open('".site_url('pegawai/hapuspendidikan/'.$rowx->pegawai_id.'/'.$rowx->replid)."')) class='btn btn-danger' >Hapus</a>";
									    echo "</td>";
								    echo "</tr>";
								}
								?>
                            </tbody>
                            <tfoot>
                            </tfoot>
	                	</table>

	                	<a href="<?php echo site_url('pegawai/ubahkepribadian/'.$id) ?>" class='btn btn-warning'>Kembali</a>
	                	<a href="<?php echo site_url('pegawai/ubahpendidikan_nf/'.$id) ?>" class="btn btn-success">Lanjut</a>
	                	<?php
	                }
	                elseif($view=='tambah_pendidikan'){?>
	                <h4>Pendidikan Formal  // <?php echo strtolower($header->nama).' ['.$header->nip.']'?></h4><hr/>
	                <?php
		                $attributes = array('class' => 'form-horizontal form-validate', 'id' => 'form', 'method' => 'POST', 'novalidate'=>'novalidate');
	                	echo form_open($action,$attributes);
	                	?>
	                	<table width="100%" border="0">
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
                </table>
                  <table width="100%" border="0">
                    <tr>
                        <td align="left">
	                	        <button class='btn btn-primary'>Simpan</button>
	                	        <!-- <a href="javascript:void(window.open('<?php echo site_url('pegawai/ubahpendidikan/'.$id_pegawai) ?>'))" class="btn btn-success">Batal</a> -->
                            <a href="javascript:window.close();" class="btn btn-danger" >Batal</a>
                          </td>
                      </tr>
                      </table>
                    <?php echo form_close();
	                }
	                elseif($view=='pendidikan_nf'){?>
	                <h4>Pendidikan Non Formal  // <?php echo strtolower($header->nama).' ['.$header->nip.']'?></h4><hr/>
	                <?php
		                $attributes = array('class' => 'form-horizontal form-validate', 'id' => 'form', 'method' => 'POST', 'novalidate'=>'novalidate');
	                	?>
	                	<section class="content-header" align="right">
		                    <ol class="breadcrumb">
		                        <li><a href="javascript:void(window.open('<?php echo site_url('pegawai/tambahpendidikan_nf/'.$id); ?>'))" ><i class="fa fa-plus-square"></i> Tambah</a></li>
		                    </ol>
		                </section>

	                	<table id="example2" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Tahun Masuk</th>
                                    <th>Tahun Keluar</th>
                                    <th>Institusi</th>
                                    <!--
                                    <th>Tgl. Masuk</th>
                                    <th>Tgl. Keluar</th>
                                    -->
                                    <th>Jenis Kursus</th>
                                    <!--<th>Dibiayai Oleh</th>-->
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            	<?php
                            	$CI =& get_instance();
                              $nopendidikan_nf=1;
								foreach((array)$pendidikan_nf as $rowx) {
								    echo "<tr>";
                    echo "<td align='center'>".$nopendidikan_nf++."</td>";
                    echo "<td align='center'>".$rowx->tahun_masuk."</td>";
                    echo "<td align='center'>".$rowx->tahun_keluar."</td>";
								    	echo "<td align='center'>".$rowx->institusi."</td>";
								    	//echo "<td align='center'>".$CI->p_c->tgl_indo($rowx->tgl_masuk)."</td>";
								    	//echo "<td align='center'>".$CI->p_c->tgl_indo($rowx->tgl_keluar)."</td>";
                      echo "<td align='center'>".$rowx->keterangan."</td>";
								    	//echo "<td align='center'>".$rowx->dibiayai."</td>";

									    echo "<td align='center' width='150'>";
                      echo "<a href=javascript:void(window.open('".site_url('pegawai/tambahpendidikan_nf/'.$rowx->pegawai_id.'/'.$rowx->replid)."')) class='btn btn-warning'>Ubah</a>";
                      echo "&nbsp;&nbsp;<a href=javascript:void(window.open('".site_url('pegawai/hapuspendidikan_nf/'.$rowx->pegawai_id.'/'.$rowx->replid)."')) class='btn btn-danger' >Hapus</a>";
									    echo "</td>";
								    echo "</tr>";
								}
								?>
                            </tbody>
                            <tfoot>
                            </tfoot>
	                	</table>

	                	<a href="<?php echo site_url('pegawai/ubahpendidikan/'.$id) ?>" class='btn btn-warning'>Kembali</a>
	                	<a href="<?php echo site_url('pegawai/ubahbahasa/'.$id) ?>" class="btn btn-success">Lanjut</a>
	                	<?php
	                }
	                elseif($view=='tambah_pendidikan_nf'){?>
	                <h4>Pendidikan Non Formal  // <?php echo strtolower($header->nama).' ['.$header->nip.']'?></h4><hr/>
	                <?php
		                $attributes = array('class' => 'form-horizontal form-validate', 'id' => 'form', 'method' => 'POST', 'novalidate'=>'novalidate');
	                	echo form_open($action,$attributes);
	                	?>
	                	<table width="100%" border="0">
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
				                		echo form_input(array('class' => '', 'id' => 'dp1','name'=>'tgl_masuk','value'=>$CI->p_c->tgl_form($isi->tgl_masuk),'data-rule-required'=>'true' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'2' ,'placeholder'=>'DD-MM-YYYY','autocomplete'=>'off'));
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
				                		echo form_input(array('class' => '', 'id' => 'dp2','name'=>'tgl_keluar','value'=>$CI->p_c->tgl_form($isi->tgl_keluar),'data-rule-required'=>'true' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'2' ,'placeholder'=>'DD-MM-YYYY','autocomplete'=>'off'));
				                	?>
				                	<?php //echo  <p id="message"></p> ?>
									</div>
		                		</div>
				            </th>
				         </tr>
               -->
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
                <!--
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
                  -->
                </table>
                    <table width="100%" border="0">
                      <tr>
                          <td align="left">
				                        <button class='btn btn-primary'>Simpan</button>
	                	            <!-- <a href="javascript:void(window.open('<?php echo site_url('pegawai/ubahpendidikan_nf/'.$id_pegawai) ?>'))" class="btn btn-success">Batal</a> -->
                                <a href="javascript:window.close();" class="btn btn-danger" >Batal</a>
                              </td>
                          </tr>
                          </table>
                    <?php echo form_close();
	                }
	                elseif($view=='bahasa'){?>
	                <h4>Kemampuan Bahasa // <?php echo strtolower($header->nama).' ['.$header->nip.']'?></h4><hr/>
	                <?php
		                $attributes = array('class' => 'form-horizontal form-validate', 'id' => 'form', 'method' => 'POST', 'novalidate'=>'novalidate');
	                	?>
	                	<section class="content-header" align="right">
		                    <ol class="breadcrumb">
		                        <li><a href="javascript:void(window.open('<?php echo site_url('pegawai/tambahbahasa/'.$id); ?>'))" ><i class="fa fa-plus-square"></i> Tambah</a></li>
		                    </ol>
		                </section>

	                	<table id="example2" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Bahasa</th>
                                    <th>Bicara</th>
                                    <th>Menulis</th>
                                    <th>Membaca</th>
                                    <th>Skor</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            	<?php
                            	$CI =& get_instance();
                              $nobahasa=1;
								foreach((array)$bahasa as $rowx) {
								    echo "<tr>";
                    echo "<td align='center'>".$nobahasa++."</td>";
								    	echo "<td align='center'>".$rowx->bahasa."</td>";
								    	echo "<td align='center'>".$rowx->bicara."</td>";
										echo "<td align='center'>".$rowx->menulis."</td>";
										echo "<td align='center'>".$rowx->membaca."</td>";
										echo "<td align='center'>".$rowx->toefl."</td>";
									    echo "<td align='center' width='150'>";
                      echo "<a href=javascript:void(window.open('".site_url('pegawai/tambahbahasa/'.$rowx->pegawai_id.'/'.$rowx->replid)."')) class='btn btn-warning'>Ubah</a>";
									    echo "&nbsp;&nbsp;<a href=javascript:void(window.open('".site_url('pegawai/hapusbahasa/'.$rowx->pegawai_id.'/'.$rowx->replid)."')) class='btn btn-danger' >Hapus</a>";
									    echo "</td>";
								    echo "</tr>";
								}
								?>
                            </tbody>
                            <tfoot>
                            </tfoot>
	                	</table>

	                	<a href="<?php echo site_url('pegawai/ubahpendidikan_nf/'.$id) ?>" class='btn btn-warning'>Kembali</a>
	                	<a href="<?php echo site_url('pegawai/ubahkomputer/'.$id) ?>" class="btn btn-success">Lanjut</a>
	                	<?php
	                }
	                elseif($view=='tambah_bahasa'){?>
	                <h4>Kemampuan Bahasa // <?php echo strtolower($header->nama).' ['.$header->nip.']'?></h4><hr/>
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
	                		<label class="control-label" for="minlengthfield">Skor</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		echo form_input(array('class' => '', 'id' => 'toefl','name'=>'toefl','value'=>$isi->toefl,'data-rule-required'=>'false' ,'data-rule-maxlength'=>'4', 'data-rule-minlength'=>'1','data-rule-number'=>'true','placeholder'=>'Masukkan 1-4 Karakter','size'=>'15'));
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th></tr>
                  <table width="100%" border="0">
                    <tr>
                        <td align="left">
				                      <button class='btn btn-primary'>Simpan</button>
	                	          <!-- <a href="javascript:void(window.open('<?php echo site_url('pegawai/ubahbahasa/'.$id_pegawai) ?>'))" class="btn btn-success">Batal</a> -->
                              <a href="javascript:window.close();" class="btn btn-danger" >Batal</a>
                            </td>
                        </tr>
      	                </table>
                    <?php echo form_close();
	                }
	                elseif($view=='komputer'){?>
	                <h4>Kemampuan Komputer // <?php echo strtolower($header->nama).' ['.$header->nip.']'?></h4><hr/>
	                <?php
		                $attributes = array('class' => 'form-horizontal form-validate', 'id' => 'form', 'method' => 'POST', 'novalidate'=>'novalidate');
	                	?>
	                	<section class="content-header" align="right">
		                    <ol class="breadcrumb">
		                        <li><a href="javascript:void(window.open('<?php echo site_url('pegawai/tambahkomputer/'.$id); ?>'))" ><i class="fa fa-plus-square"></i> Tambah</a></li>
		                    </ol>
		                </section>

	                	<table id="example2" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Kemampuan Komputer</th>
                                    <th>Bidang</th>
                                    <th>Tingkatan</th>
                                    <!--<th>Keterangan</th>-->
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            	<?php
                            	$CI =& get_instance();
                              $nokomputer=1;
								foreach((array)$komputer as $rowx) {
								    echo "<tr>";
                      echo "<td align='center'>".$nokomputer++."</td>";
								    	echo "<td align='center'>".$rowx->komputer."</td>";
								    	echo "<td align='center'>".$rowx->bidang."</td>";
										echo "<td align='center'>".$rowx->tingkat."</td>";
										//echo "<td align='center'>".$rowx->keterangan."</td>";
									    echo "<td align='center' width='150'>";
                      echo "<a href=javascript:void(window.open('".site_url('pegawai/tambahkomputer/'.$rowx->pegawai_id.'/'.$rowx->replid)."')) class='btn btn-warning'>Ubah</a>";
                      echo "&nbsp;&nbsp;<a href=javascript:void(window.open('".site_url('pegawai/hapuskomputer/'.$rowx->pegawai_id.'/'.$rowx->replid)."')) class='btn btn-danger' >Hapus</a>";
									    echo "</td>";
								    echo "</tr>";
								}
								?>
                            </tbody>
                            <tfoot>
                            </tfoot>
	                	</table>

	                	<a href="<?php echo site_url('pegawai/ubahpendidikan_nf/'.$id) ?>" class='btn btn-warning'>Kembali</a>
	                	<a href="<?php echo site_url('pegawai/ubahskill/'.$id) ?>" class="btn btn-success">Lanjut</a>

	                	<?php
	                }
	                elseif($view=='tambah_komputer'){?>
	                <h4>Kemampuan Komputer // <?php echo strtolower($header->nama).' ['.$header->nip.']'?></h4><hr/>
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
                  <!--
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
                -->
                  </table>
                  <table width="100%" border="0">
                    <tr>
                        <td align="left">
				                      <button class='btn btn-primary'>Simpan</button>
	                	          <!-- <a href="javascript:void(window.open('<?php echo site_url('pegawai/ubahkomputer/'.$id_pegawai) ?>'))" class="btn btn-success">Batal</a> -->
                              <a href="javascript:window.close();" class="btn btn-danger" >Batal</a>
                            </td>
                        </tr>
                        </table>
                    <?php echo form_close();
	                }
	                elseif($view=='skill'){?>
	                <h4>Kemampuan Lainnya // <?php echo strtolower($header->nama).' ['.$header->nip.']'?></h4><hr/>
	                <?php
		                $attributes = array('class' => 'form-horizontal form-validate', 'id' => 'form', 'method' => 'POST', 'novalidate'=>'novalidate');
	                	?>
	                	<section class="content-header" align="right">
		                    <ol class="breadcrumb">
		                        <li><a href="javascript:void(window.open('<?php echo site_url('pegawai/tambahskill/'.$id); ?>'))" ><i class="fa fa-plus-square"></i> Tambah</a></li>
		                    </ol>
		                </section>

	                	<table id="example2" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Kemampuan</th>
                                    <th>Tingkatan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            	<?php
                            	$CI =& get_instance();
                              $noskill=1;
								foreach((array)$skill as $rowx) {
								    echo "<tr>";
                    echo "<td align='center'>".$noskill++."</td>";
								    	echo "<td align='center'>".$rowx->skill."</td>";
										echo "<td align='center'>".$rowx->tingkat."</td>";
									    echo "<td align='center' width='150'>";
                      echo "<a href=javascript:void(window.open('".site_url('pegawai/tambahskill/'.$rowx->pegawai_id.'/'.$rowx->replid)."')) class='btn btn-warning'>Ubah</a>";
                      echo "&nbsp;&nbsp;<a href=javascript:void(window.open('".site_url('pegawai/hapusskill/'.$rowx->pegawai_id.'/'.$rowx->replid)."')) class='btn btn-danger' >Hapus</a>";
									    echo "</td>";
								    echo "</tr>";
								}
								?>
                            </tbody>
                            <tfoot>
                            </tfoot>
	                	</table>

	                	<a href="<?php echo site_url('pegawai/ubahkomputer/'.$id) ?>" class='btn btn-warning'>Kembali</a>
	                	<a href="<?php echo site_url('pegawai/ubahprestasi/'.$id) ?>" class="btn btn-success">Lanjut</a>

	                	<?php
	                }
	                elseif($view=='tambah_skill'){?>
	                <h4>Kemampuan Lainnya // <?php echo strtolower($header->nama).' ['.$header->nip.']'?></h4><hr/>
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
                  <table width="100%" border="0">
                    <tr>
                        <td align="left">
				                      <button class='btn btn-primary'>Simpan</button>
	                	          <!-- <a href="javascript:void(window.open('<?php echo site_url('pegawai/ubahskill/'.$id_pegawai) ?>'))" class="btn btn-success">Batal</a> -->
                              <a href="javascript:window.close();" class="btn btn-danger" >Batal</a>
                            </td>
                        </tr>
      	                </table>
                    <?php echo form_close();
	                }
	                elseif($view=='prestasi'){?>
	                <h4>Prestasi // <?php echo strtolower($header->nama).' ['.$header->nip.']'?></h4><hr/>
	                <?php
		                $attributes = array('class' => 'form-horizontal form-validate', 'id' => 'form', 'method' => 'POST', 'novalidate'=>'novalidate');
	                	?>
	                	<section class="content-header" align="right">
		                    <ol class="breadcrumb">
		                        <li><a href="javascript:void(window.open('<?php echo site_url('pegawai/tambahprestasi/'.$id); ?>'))" ><i class="fa fa-plus-square"></i> Tambah</a></li>
		                    </ol>
		                </section>

	                	<table id="example2" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No.</th>
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
                              $noprestasi=1;
								foreach((array)$prestasi as $rowx) {
								    echo "<tr>";
                    echo "<td align='center'>".$noprestasi++."</td>";
								    	echo "<td align='center'>".$rowx->tahun."</td>";
								    	echo "<td align='center'>".$rowx->prestasi."</td>";
										echo "<td align='center'>".$rowx->tingkat."</td>";
										echo "<td align='center'>".$rowx->instansi."</td>";
									    echo "<td align='center' width='150'>";
                      echo "<a href=javascript:void(window.open('".site_url('pegawai/tambahprestasi/'.$rowx->pegawai_id.'/'.$rowx->replid)."')) class='btn btn-warning'>Ubah</a>";
                      echo "&nbsp;&nbsp;<a href=javascript:void(window.open('".site_url('pegawai/hapusprestasi/'.$rowx->pegawai_id.'/'.$rowx->replid)."')) class='btn btn-danger'>Hapus</a>";
									    echo "</td>";
								    echo "</tr>";
								}
								?>
                            </tbody>
                            <tfoot>
                            </tfoot>
	                	</table>

	                	<a href="<?php echo site_url('pegawai/ubahskill/'.$id) ?>" class='btn btn-warning'>Kembali</a>
	                	<a href="<?php echo site_url('pegawai/ubahorganisasi/'.$id) ?>" class="btn btn-success">Lanjut</a>

	                	<?php
	                }
	                elseif($view=='tambah_prestasi'){?>
	                <h4>Prestasi // <?php echo strtolower($header->nama).' ['.$header->nip.']'?></h4><hr/>
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
                  <table width="100%" border="0">
                    <tr>
                        <td align="left">
				                      <button class='btn btn-primary'>Simpan</button>
	                	          <!-- <a href="javascript:void(window.open('<?php echo site_url('pegawai/ubahprestasi/'.$id_pegawai) ?>'))" class="btn btn-success">Batal</a> -->
                              <a href="javascript:window.close();" class="btn btn-danger" >Batal</a>
                            </td>
                        </tr>
      	                </table>
                    <?php echo form_close();
	                }
	                elseif($view=='organisasi'){?>
	                <h4>Keorganisasian // <?php echo strtolower($header->nama).' ['.$header->nip.']'?></h4><hr/>
	                <?php
		                $attributes = array('class' => 'form-horizontal form-validate', 'id' => 'form', 'method' => 'POST', 'novalidate'=>'novalidate');
	                	?>
	                	<section class="content-header" align="right">
		                    <ol class="breadcrumb">
		                        <li><a href="javascript:void(window.open('<?php echo site_url('pegawai/tambahorganisasi/'.$id); ?>'))" ><i class="fa fa-plus-square"></i> Tambah</a></li>
		                    </ol>
		                </section>

	                	<table id="example2" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                  <th>No.</th>
                                  <th>Tahun Masuk</th>
                                  <th>Tahun Keluar</th>
                                  <th>Instansi/Institusi</th>
                                    <th>Organisasi</th>
                                    <th>Jabatan</th>
                                    <th>Tanggung Jawab</th>
                                    <!-- <th>Tahun</th> -->
                                    <th>Aksi</th>

                                </tr>
                            </thead>
                            <tbody>
                            	<?php
                            	$CI =& get_instance();
                              $noorganisasi=1;
								foreach((array)$organisasi as $rowx) {
								    echo "<tr>";
                    echo "<td align='center'>".$noorganisasi++."</td>";
                    echo "<td align='center'>".$rowx->tahun_masuk."</td>";
                    echo "<td align='center'>".$rowx->tahun_keluar."</td>";
								    	echo "<td align='center'>".$rowx->instansi."</td>";
								    	echo "<td align='center'>".$rowx->organisasi."</td>";
										echo "<td align='center'>".$rowx->jabatan."</td>";
										echo "<td align='center'>".$rowx->tanggung_jawab."</td>";
										//echo "<td align='center'>".$CI->p_c->tgl_indo($rowx->tgl_masuk).' - '.$CI->p_c->tgl_indo($rowx->tgl_keluar)."</td>";

									    echo "<td align='center' width='150'>";
                      echo "<a href=javascript:void(window.open('".site_url('pegawai/tambahorganisasi/'.$rowx->pegawai_id.'/'.$rowx->replid)."')) class='btn btn-warning'>Ubah</a>";
                      echo "&nbsp;&nbsp;<a href=javascript:void(window.open('".site_url('pegawai/hapusorganisasi/'.$rowx->pegawai_id.'/'.$rowx->replid)."')) class='btn btn-danger' >Hapus</a>";
									    echo "</td>";
								    echo "</tr>";
								}
								?>
                            </tbody>
                            <tfoot>
                            </tfoot>
	                	</table>

	                	<a href="<?php echo site_url('pegawai/ubahprestasi/'.$id) ?>" class='btn btn-warning'>Kembali</a>
	                	<a href="<?php echo site_url('pegawai/ubahkerja/'.$id) ?>" class="btn btn-success">Lanjut</a>

	                	<?php
	                }
	                elseif($view=='tambah_organisasi'){?>
	                <h4>Keorganisasian // <?php echo strtolower($header->nama).' ['.$header->nip.']'?></h4><hr/>
	                <?php
		                $attributes = array('class' => 'form-horizontal form-validate', 'id' => 'form', 'method' => 'POST', 'novalidate'=>'novalidate');
	                	echo form_open($action,$attributes);
	                	?>
	                	<table width="100%" border="0">
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
                  <tr>
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
                  <!--
			            <tr>
				            <th align="left">
		                		<label class="control-label" for="minlengthfield">Tgl. Masuk</label>
		                		<div class="control-group">
									<div class="controls">:
				                	<?php
				                		echo form_input(array('class' => '', 'id' => 'dp1','name'=>'tgl_masuk','value'=>$CI->p_c->tgl_form($isi->tgl_masuk),'data-rule-required'=>'true' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'2' ,'placeholder'=>'DD-MM-YYYY','autocomplete'=>'off'));
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
				                		echo form_input(array('class' => '', 'id' => 'dp2','name'=>'tgl_keluar','value'=>$CI->p_c->tgl_form($isi->tgl_keluar),'data-rule-required'=>'false' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'2' ,'placeholder'=>'DD-MM-YYYY','autocomplete'=>'off'));
				                	?>
				                	<?php //echo  <p id="message"></p> ?>
									</div>
		                		</div>
				            </th>
				         </tr>
               -->
           </table>
                 <table width="100%" border="0">
                   <tr>
                       <td align="left">
				                     <button class='btn btn-primary'>Simpan</button>
	                	         <!-- <a href="javascript:void(window.open('<?php echo site_url('pegawai/ubahorganisasi/'.$id_pegawai) ?>'))" class="btn btn-success">Batal</a>-->
                             <a href="javascript:window.close();" class="btn btn-danger" >Batal</a>
                           </td>
                       </tr>
     	                </table>
                    <?php echo form_close();
	                }
	                elseif($view=='kerja'){?>
	                <h4>Pengalaman Kerja // <?php echo strtolower($header->nama).' ['.$header->nip.']'?></h4><hr/>
	                <?php
		                $attributes = array('class' => 'form-horizontal form-validate', 'id' => 'form', 'method' => 'POST', 'novalidate'=>'novalidate');
	                	?>
	                	<section class="content-header" align="right">
		                    <ol class="breadcrumb">
		                        <li><a href="javascript:void(window.open('<?php echo site_url('pegawai/tambahkerja/'.$id); ?>'))" ><i class="fa fa-plus-square"></i> Tambah</a></li>
		                    </ol>
		                </section>

	                	<table id="example2" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <!--<th>Tgl. Masuk</th>
                                    <th>Tgl. Keluar</th>-->
                                    <th>Tahun Masuk</th>
                                    <th>Tahun Keluar</th>
                                    <th>Instansi</th>
                                    <th>Bidang Usaha</th>
                                    <th>Jabatan</th>
                                    <!--
                                    <th>Alamat</th>
                                    <!--<th>Keterangan</th>-->
                                    <th>Gaji</th>
                                    <th>Alasan Keluar</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            	<?php
                            	$CI =& get_instance();
                              $nokerja=1;
								foreach((array)$kerja as $rowx) {
								    echo "<tr>";
                    echo "<td align='center'>".$nokerja++."</td>";
								    	//echo "<td align='center'>".$CI->p_c->tgl_indo($rowx->tgl_masuk)."</td>";
								    	//echo "<td align='center'>".$CI->p_c->tgl_indo($rowx->tgl_keluar)."</td>";
                      echo "<td align='center'>".$rowx->tahun_masuk."</td>";
                      echo "<td align='center'>".$rowx->tahun_keluar."</td>";
                      echo "<td align='center'>".$rowx->instansi."</td>";
								    	echo "<td align='center'>".$rowx->bidang_usaha."</td>";
								    	echo "<td align='center'>".$rowx->jabatan."</td>";
										  //echo "<td align='center'>".$rowx->alamat."</td>";
										//echo "<td align='center'>".$rowx->keterangan."</td>";
                      echo "<td align='center'>".$CI->p_c->rupiah($rowx->gaji)."</td>";
                      echo "<td align='center'>".$rowx->alasankeluar."</td>";
									    echo "<td align='center' width='150'>";
                      echo "<a href=javascript:void(window.open('".site_url('pegawai/tambahkerja/'.$rowx->pegawai_id.'/'.$rowx->replid)."')) class='btn btn-warning'>Ubah</a>";
                      echo "&nbsp;&nbsp;<a href=javascript:void(window.open('".site_url('pegawai/hapuskerja/'.$rowx->pegawai_id.'/'.$rowx->replid)."')) class='btn btn-danger' >Hapus</a>";
									    echo "</td>";
								    echo "</tr>";
								}
								?>
                            </tbody>
                            <tfoot>
                            </tfoot>
	                	</table>

	                	<a href="<?php echo site_url('pegawai/ubahorganisasi/'.$id) ?>" class='btn btn-warning'>Kembali</a>
	                	<a href="javascript:void(window.open('<?php echo site_url('general/datapegawai/'.$id) ?>'))" class="btn btn-success">Selesai</a>
	                	<?php
	                }
	                elseif($view=='tambah_kerja'){?>
	                <h4>Pengalaman Kerja // <?php echo strtolower($header->nama).' ['.$header->nip.']'?></h4><hr/>
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
				                		echo form_input(array('class' => '', 'id' => 'dp1','name'=>'tgl_masuk','value'=>$CI->p_c->tgl_form($isi->tgl_masuk),'data-rule-required'=>'true' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'2' ,'placeholder'=>'DD-MM-YYYY','autocomplete'=>'off'));
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
				                		echo form_input(array('class' => '', 'id' => 'dp2','name'=>'tgl_keluar','value'=>$CI->p_c->tgl_form($isi->tgl_keluar),'data-rule-required'=>'false' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'2' ,'placeholder'=>'DD-MM-YYYY','autocomplete'=>'off'));
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
                  <!--
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
                -->
                <tr>
                <th align="left">
                    <label class="control-label" for="minlengthfield">Gaji</label>
                    <div class="control-group">
              <div class="controls">:
                      <?php
                        echo form_input(array('class' => '', 'id' => 'gaji','name'=>'gaji','value'=>$isi->gaji,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'10', 'data-rule-minlength'=>'5','data-rule-number'=>'true','placeholder'=>'Masukkan 5-10 Karakter'));
                      ?>
                      <?php //echo  <p id="message"></p> ?>
              </div>
                    </div>
                </th></tr>
                <tr>
                <th align="left">
                    <label class="control-label" for="minlengthfield">Alasan Keluar</label>
                    <div class="control-group">
              <div class="controls">:
                      <?php
                        echo form_textarea(array('class' => '', 'id' => 'alasankeluar','name'=>'alasankeluar','value'=>$isi->alasankeluar,'data-rule-required'=>'false' ,'data-rule-maxlength'=>'500', 'data-rule-minlength'=>'2' ,'placeholder'=>'Masukkan 2-500 Karakter'));
                      ?>
                      <?php //echo  <p id="message"></p> ?>
              </div>
                    </div>
                </th></tr>
              </table>
                  <table width="100%" border="0">
                    <tr>
                        <td align="left">
        				              <button class='btn btn-primary'>Simpan</button>
        	                	  <!-- <a href="javascript:void(window.open('<?php echo site_url('pegawai/ubahkerja/'.$id_pegawai) ?>'))" class="btn btn-success">Batal</a> -->
                              <a href="javascript:window.close();" class="btn btn-danger" >Batal</a>
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
