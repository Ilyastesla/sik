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
                    <!--
                    <ol class="breadcrumb">
                        <li><a href="javascript:void(window.open('<?php echo site_url('ksw_siswa_cari/tambah'); ?>'))" ><i class="fa fa-plus-square"></i> Tambah</a></li>
                        <li><a href="#"><i class="fa fa-file-text"></i>Cetak</a></li>
                        <li><a href="#"><i class="fa fa-file-excel-o"></i>Excel</a></li>
                    </ol>
                    -->
                </section>
                <section class="content-header table-responsive">
                <?php
  			             $attributes = array('class' => 'form-horizontal form-validate', 'id' => 'form', 'method' => 'POST', 'novalidate'=>'novalidate','onsubmit'=>'return validate()');
  		    	echo form_open($action,$attributes);
  		    		?>
                    	<table width="100%" border="0">
                        <tr>
                            <th align="left">
                                <label class="control-label" for="minlengthfield">Sekolah Tujuan</label>
                                <div class="control-group">
                                    <div class="controls">:
                                        <?php
                                        $arridcompany="data-rule-required=true id=idcompany onchange='javascript:this.form.submit();'";
                                        echo form_dropdown('idcompany',$idcompany_opt,$this->input->post('idcompany'),$arridcompany);
                                        ?>
                                        <?php //echo  <p id="message"></p> ?>
                                    </div>
                                </div>
                                </th>
                            </tr>
                            <tr>
            						       <th align="left">
      				                		<label class="control-label" for="minlengthfield">Jenjang</label>
      				                		<div class="control-group">
              											<div class="controls">:
          						                	<?php
          						                		$arriddepartemen='data-rule-required=false onchange=javascript:this.form.submit();';
          						                		echo form_dropdown('iddepartemen',$iddepartemen_opt,$this->input->post('iddepartemen'),$arriddepartemen);
          						                	?>
          						                	<?php //echo  <p id="message"></p> ?>
              											</div>
            				              </div>
            						         </th>
    			                  </tr>
                            <!--
                            <tr>
                            <th align="left">
          				                		<label class="control-label" for="minlengthfield">Tahun Pelajaran</label>
          				                		<div class="control-group">
                  											<div class="controls">:
                                          <?php
                                            $arridtahunajaran='data-rule-required=false onchange=javascript:this.form.submit();';
                                            echo form_dropdown('idtahunajaran',$idtahunajaran_opt,$this->input->post('idtahunajaran'),$arridtahunajaran);
                                          ?>
            						                	<?php //echo  <p id="message"></p> ?>
                  											</div>
          				                		</div>
          						            </th>
      			                  </tr>
-->
    	                    <tr>
            						       <th align="left">
      				                		<label class="control-label" for="minlengthfield">Cari</label>
      				                		<div class="control-group">
              											<div class="controls">:
          						                	<?php
                                          $arrjeniscari='data-rule-required=false';
                                          echo form_dropdown('jeniscari',$jeniscari_opt,$this->input->post('jeniscari'),$arrjeniscari);
                                          echo "&nbsp;&nbsp;";
          						                		echo form_input(array('class' => '','style'=>'margin: 0px 0px 5px; width: 300px;', 'id' => 'nama','name'=>'nama','value'=>$this->input->post('nama'),'data-rule-required'=>'true' ,'data-rule-maxlength'=>'500', 'data-rule-minlength'=>'3' ,'placeholder'=>'Masukkan 1-100 Karakter'));
          						                	?>
          						                	<?php //echo  <p id="message"></p> ?>
              											</div>
            				              </div>
            						         </th>
    			                  </tr>
          			            <tr>
          				            <th align="left" colspan="4">
          				            	<button class='btn btn-primary' name='filter' value="1">Filter</button>
                                <?php echo "<a href='".site_url($action)."' ) class='btn btn-danger'>Bersihkan</a>&nbsp;&nbsp;";?>
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
                                              <th width="50" >No</th>
                                              <th>NIS Lama</th>
                                              <th>Nama</th>
                                              <th>Sekolah Sebelumnya</th>
                                              <th>Jenjang</th>
                                              <th>Tahun Pelajaran</th>
                                              <th>Kelas</th>
                                              <th>ABK</th>
                                              <?php
                                              //echo "<th>Keuangan</th>";
                                              //echo "<th>Administrasi<br/>Siswa</th>";
                                              echo "<th>Aktif</th>";
                                              echo "<th>Peringatan</th>";
                                               echo "<th width='80'>Aksi</th>";
                                              ?>
                                          </tr>
                                        </thead>
                                        <tbody>
                                        	<?php
                                        	$CI =& get_instance();$no=1;
											foreach((array)$show_table as $row) {
											    echo "<tr>";
											    echo "<td align='center'>".$no++."</td>";
                          echo "<td align='center'>";
                          //echo "<a href=javascript:void(window.open('".site_url('general/datasiswa/'.$row->replid)."')) >".$row->nis."</a>";
                          echo $row->nis;
                          echo "</td>";
                          echo "<td align='center'>".strtoupper($row->nama);
                          if ($row->jml_hari<=14){
                            echo ' <b><font color="red">(baru)</font></b>';
                          }
                          echo "</td>";
                          echo "<td align='center'>".strtoupper($row->companytext)."</td>";
                          echo "<td align='center'>".strtoupper($row->departemen)."</td>";
                          echo "<td align='center'>".strtoupper($row->tahunajaran)."</td>";
                          echo "<td align='center'>".strtoupper($row->kelas)."</td>";

                          //if (($row->jml_hari>=180) and ($row->konseling_desc==1)){
                          //  echo ' <b><font color="red">(Harus Interview)</font></b>';
                          //}
                          echo "<td align='center'>".($CI->p_c->cekaktif($row->abk))."</td>";
                          echo "<td align='center'>".$CI->p_c->cekaktif($row->aktif)."</td>";
                          echo "<td align='center'>";
                          echo $CI->p_c->cekperingatan($row->peringatan);
                          echo "</td>";
                          
                          echo "<td align='center'>";
                          if(($row->peringatan<1) and ($row->aktif<>1) and ($row->replidmutasi<1)){
                            echo "<a href=javascript:void(window.open('".site_url('ksw_penempatan_mutasi/proses/'.$row->replid)."')) class='btn btn-warning' >Proses</a>&nbsp;&nbsp;";
                          }else{
                            echo "<b>NIS Baru: </b><a href=javascript:void(window.open('".site_url('general/datasiswa/'.$row->replidmutasi)."')) >".$row->nisbaru."</a>";
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
<?php }else if($view=='proses'){ ?>

<script type="text/javascript">
$(function(){
    $.ajaxSetup({
        type:"POST",
        url: "<?php echo site_url('combobox/ambil_data') ?>",
        cache: false,
    });
    $("#idtahunajaran").change(function(){
        var value=$(this).val();
       $.ajax({
            data:{modul:'idkelastingkat',id:value,idtingkat:<?php echo $isi->idtingkat;?>},
            success: function(respond){
            $("#idkelas").html(respond);
            }
        });
    });
});
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
    //echo $CI->dbx->getcalonsiswa($isi->replid);
    ?>
    <table width="100%" border="0">
    <tr>
      <th align="left">
        DATA SEBELUMNYA  
    </th></tr>
    <tr>
      <th align="left">
      <label class="control-label" for="minlengthfield">NIS</label>
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
      <label class="control-label" for="minlengthfield">Nama</label>
      <div class="control-group">
    <div class="controls">:
            <?php
              echo $isi->nama;
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
              echo $isi->kelassebelemnyatext;
            ?>
    </div>
      </div>
      </th></tr>
      <tr>
      <th align="left">
      <label class="control-label" for="minlengthfield">Tgl. Mutasi</label>
      <div class="control-group">
    <div class="controls">:
            <?php
              echo $CI->p_c->tgl_indo($isi->tglmutasi);
            ?>
    </div>
      </div>
      </th></tr>
      <tr>
      <th align="left">
        <hr/> 
    </th></tr>
      <tr>
              <th align="left">
                <label class="control-label" for="minlengthfield">Tahun Pelajaran</label>
                <div class="control-group">
                    <div class="controls">:
                      <?php
                        $arridtahunajaran="id='idtahunajaran' data-rule-required='true' ";
                        echo form_dropdown('idtahunajaran',$idtahunajaran_opt,$isi->idtahunajaran,$arridtahunajaran);
                      ?>
                            <?php //echo  <p id="message"></p> ?>
                    </div>
                </div>
              </th>
            </tr>
            <tr>
            <th align="left">
            <label class="control-label" for="minlengthfield">Kelas</label>
            <div class="control-group">
          <div class="controls">:
                  <?php
                    $arridkelas='data-rule-required=true id=idkelas ';
                    echo form_dropdown('idkelas',$idkelas_opt,$isi->calon_kelas,$arridkelas);
                  ?>
          </div>
            </div>
            </th></tr>
      <tr>
          <th align="left">
                <label class="control-label" for="minlengthfield">Tanggal Masuk</label>
                <div class="control-group">
          <div class="controls">:
            <?php
              echo form_input(array('class' => '', 'id' => 'dp1','name'=>'tanggal_masuk','value'=>$CI->p_c->tgl_form($isi->tanggal_masuk),'data-rule-required'=>'true' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'2' ,'placeholder'=>'DD-MM-YYYY','autocomplete'=>'off'));
            ?>
                  <?php //echo  <p id="message"></p> ?>
          </div>
                </div>
            </th></tr>
      </table>
      <table width="100%" border="0">
          <tr>
                  <th align="left">
                    <input type='hidden' name='kodecabang' value='<?php echo $isi->kodecabang ?>'>
                    <input type='hidden' name='tingkattext' value='<?php echo $isi->tingkattext ?>'>
                    <button class='btn btn-primary' onclick="return validate()">Simpan</button>
                    <a href="javascript:void(window.open('<?php echo site_url("psb_penjadwalan") ?>'))" class="btn btn-success">Kembali</a>
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
