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
                        <li><a href="javascript:void(window.open('<?php echo site_url('inventory_material/tambah'); ?>'))" ><i class="fa fa-plus-square"></i> Tambah</a></li>

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
                                            <?php
                                            echo "<th width='50'>No.</th>";
                                            echo "<th>Kode</th>";
                                            echo "<th>Nama</th>";
                                            echo "<th>Kelompok Barang</th>";
                                            //echo "<th>Kelompok Inventaris</th>";
                                            //echo "<th>Merek</th>";
                                             echo "<th>Kelompok Fiskal</th>";
                                            //echo "<th>Spesifikasi</th>";
                                            echo "<th>Inventaris</th>";
                                            echo "<th>Stok</th>";
                                            echo "<th>Aktif</th>";
                                            echo "<th>Aksi</th>";
                                            ?>
                                        </tr>

                                          </thead>
                                          <tbody>
                                            <?php
                                            $CI =& get_instance();$no=1;
                              foreach((array)$show_table as $rowx) {
                                echo "<tr>";
                                echo "<td align='center'>".strtoupper($no++)."</td>";
                                echo "<td align='center'>";
                                  echo '<a href='.site_url('inventory_material/view/'.$rowx->replid).' target="_blank">'.strtoupper($rowx->kode).'</a>';
                                echo "</td>";
                                echo "<td align='center'>".strtoupper($rowx->merek.' '.$rowx->nama)."</td>";
                                echo "<td align='center'>".strtoupper($rowx->kelompok)."</td>";
                                //echo "<td align='center'>".strtoupper($rowx->kelompok_inventaris)."</td>";
                                // echo "<td align='center'>".strtoupper($rowx->merek)."</td>";
                                echo "<td align='center'>".strtoupper($rowx->kodefiskaltext)."</td>";
                                //echo "<td align='center'>".strtoupper($rowx->spesifikasi)."</td>";
                                echo "<td align='center'>".($CI->p_c->cekaktif($rowx->inventaris))."</td>";
                                $bgcolor="";
                                if ($rowx->stock<=$rowx->stock_min){
                                    $bgcolor="style='background-color:red;'";
                                }
                                echo "<td align='center' ".$bgcolor.">".$rowx->stock."</td>";

                                echo "<td><a href=javascript:void(window.open('".site_url('inventory_material/ubahaktifmaterial/'.$rowx->replid.'/'.!($rowx->aktif))."'))>".($CI->p_c->cekaktif($rowx->aktif))."</a></td>";
                                echo "<td align='center' width='150'>";
                                // if (trim($this->session->userdata('idpegawai')) == (trim($rowx->created_by))){
                                if($rowx->pakai<1){
                                    echo "<a href=javascript:void(window.open('".site_url("inventory_material/ubah/0/".$rowx->replid)."')) class='btn btn-xs btn-warning fa fa-check-square' ></a>&nbsp;&nbsp;";
                                    echo "<a href=javascript:void(window.open('".site_url("inventory_material/hapus/".$rowx->replid)."'))  class='btn btn-xs btn-danger fa fa-minus-square' ></a>";
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
<?php } elseif($view=='tambah'){ ?>
  <section class="content-header table-responsive">
        <h1>
            <?php echo $form ?>
         </h1>
    </section>
    <section class="content">
    <?php
      $attributes = array('class' => 'form-horizontal form-validate', 'id' => 'form', 'method' => 'POST', 'novalidate'=>'novalidate');
  echo form_open($action,$attributes);
  ?>
  <table width="100%" border="0">
    <?php if ($isi->replid<>"") {?>
    <tr>
        <th align="left">
        <label class="control-label" for="minlengthfield">Kode</label>
        <div class="control-group">
      <div class="controls">:
              <?php
                echo $isi->kode;
              ?>
      </div>
        </div>
        </th></tr>
        <?php } ?>
        <tr>
            <th align="left">
                <label class="control-label" for="minlengthfield">Nama</label>
                <div class="control-group">
          <div class="controls">:
                  <?php
                    echo form_input(array('class' => '', 'id' => 'nama','name'=>'nama','value'=>$isi->nama,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'200', 'data-rule-minlength'=>'2' ,'placeholder'=>'Masukkan 2-200 Karakter','size'=>'15'));
                  ?>
                  <?php //echo  <p id="message"></p> ?>
          </div>
                </div>
            </th></tr>
            <tr>
            <th align="left">
                <label class="control-label" for="minlengthfield">Spesifikasi</label>
                <div class="control-group">
          <div class="controls">:
                  <?php
                    echo form_textarea(array('class' => '', 'id' => 'spesifikasi','name'=>'spesifikasi','value'=>$isi->spesifikasi,'data-rule-required'=>'false' ,'data-rule-maxlength'=>'500', 'data-rule-minlength'=>'2' ,'placeholder'=>'Masukkan 2-500 Karakter','size'=>'15'));
                  ?>
                  <?php //echo  <p id="message"></p> ?>
          </div>
                </div>
            </th></tr>
    <tr>

    <tr>
            <th align="left">
                <label class="control-label" for="minlengthfield">Kelompok Barang</label>
                <div class="control-group">
          <div class="controls">:
                  <?php
                    $arrkelompok='data-rule-required=true';
                    echo form_dropdown('idkelompok',$kelompok_opt,$isi->idkelompok,$arrkelompok);
                  ?>
                  <?php //echo  <p id="message"></p> ?>
          </div>
                </div>
            </th></tr>
    <!--
    <tr>
            <th align="left">
                <label class="control-label" for="minlengthfield">Kelompok Inventaris</label>
                <div class="control-group">
          <div class="controls">:
                  <?php
                    $arrkelompok_inventaris='data-rule-required=true';
                    echo form_dropdown('idkelompok_inventaris',$kelompok_inventaris_opt,$isi->idkelompok_inventaris,$arrkelompok_inventaris);
                  ?>
                  <?php //echo  <p id="message"></p> ?>
          </div>
                </div>
            </th></tr>
    -->
    <tr>
            <th align="left">
              <script type='text/javascript'>
              var site = "<?php echo site_url();?>";
              $(function(){
                $('.autocomplete').keyup(function(e) {

                  $('#idmerek').val('');
                });
                  $('.autocomplete').autocomplete({
                      // serviceUrl berisi URL ke controller/fungsi yang menangani request kita
                      serviceUrl: site+'/autocomplete/search/inventory_merek',
                      // fungsi ini akan dijalankan ketika user memilih salah satu hasil request
                      onSelect: function (suggestion) {
                          $('#idmerek').val(''+suggestion.replid); // membuat id 'v_nim' untuk ditampilkan
                      }
                  });
              });
          </script>
                <label class="control-label" for="minlengthfield">Merek</label>
                <div class="control-group">
          <div class="controls">:
                    <input type="search" class='autocomplete' id="autocomplete1" name="nama_merek" data-rule-required=true data-rule-maxlength=200 data-rule-minlength=2 placeholder="Masukkan 2-200 Karakter" value="<?php echo $isi->merektext ?>"/>
                    <input type="hidden" name="idmerek" id="idmerek" value="<?php echo $isi->idmerek ?>">
                  <?php
                    //$arrmerek='data-rule-required=true';
                    //echo form_dropdown('idmerek',$merek_opt,$isi->idmerek,$arrmerek);
                  ?>
                  <?php //echo  <p id="message"></p> ?>
          </div>
                </div>

            </th></tr>
    <!--
    <tr>
            <th align="left">
                <label class="control-label" for="minlengthfield">Kelompok Fiskal</label>
                <div class="control-group">
          <div class="controls">:
                  <?php
                    $arrfiskal='data-rule-required=false';
                    echo form_dropdown('idfiskal',$fiskal_opt,$isi->idfiskal,$arrfiskal);
                  ?>
                  <?php //echo  <p id="message"></p> ?>
          </div>
                </div>
            </th></tr>
        -->
        <?php 
        //if($isi->replid<>""){ 
          ?>
        <tr>
          <th align="left">
                  <label class="control-label" for="minlengthfield">Inventaris</label>
                  <div class="control-group">
                <div class="controls">:
                        <?php
                          echo form_checkbox('inventaris', '1', $isi->inventaris);
                        ?>
                        <?php //echo  <p id="message"></p> ?>
                </div>
                  </div>
          </th>
      </tr>
      <tr>
        <th align="left">
                <label class="control-label" for="minlengthfield">Stok Minimal</label>
                <div class="control-group">
              <div class="controls">:
                      <?php
                        echo form_input(array('id' => 'stock_min','name'=>'stock_min','value'=>$isi->stock_min,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'8', 'data-rule-minlength'=>'1','data-rule-number'=>'true','placeholder'=>'Masukkan 1-8 Karakter'));
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
                echo form_checkbox('aktif', '1', $isi->aktif);
              ?>
              <?php //echo  <p id="message"></p> ?>
      </div>
        </div>
        </th></tr>
      <?php 
      //} else{ 
      //  echo "<input type='hidden' name='aktif' value='1'>";
      //}
      //echo "<input type='hidden' name='idpermintaan_barang' value='".$idpermintaan_barang."'>";
      //echo "<input type='hidden' name='page_' value='".$_SERVER['HTTP_REFERER'] ."'>";
      ?>
        </table>
        <table width="100%" border="0">
          <tr><td align="left" >
            <input type="hidden" name="from" value="<?php echo $from ?>">
            <input type="hidden" name="idkelompok2" value="<?php echo $isi->idkelompok ?>">
            <button class='btn btn-primary'>Simpan</button>
            <!-- <a href="javascript:void(window.open('<?php echo site_url('inventory/material') ?>'))" class="btn btn-success">Kembali</a> -->
            <a href="<?php echo $_SERVER['HTTP_REFERER'] ?>" class="btn btn-success">Kembali</a>
          </td></tr>
        </table>
      <?php
      echo form_close();?>
</section><!-- /.content -->
<?php }elseif($view=='view'){?>
      <section class="content-header table-responsive">
            <h1>
                <?php echo $form ?>
             </h1>
             <ol class="breadcrumb">
                <li><a href="javascript:void(window.open('<?php echo site_url('inventory/ubahmaterial'); ?>'))" ><i class="fa fa-plus-square"></i> Tambah</a></li>
            </ol>
        </section>
        <section class="content">
        <?php
          $CI =& get_instance();
          $attributes = array('class' => 'form-horizontal form-validate', 'id' => 'form', 'method' => 'POST', 'novalidate'=>'novalidate');
      echo form_open($action,$attributes);
      ?>
      <table width="100%" border="0">
        <tr>
            <th align="left">
            <label class="control-label" for="minlengthfield">Kode</label>
            <div class="control-group">
          <div class="controls">:
                  <?php
                    echo strtoupper($isi->kode);
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
                      echo strtoupper($isi->nama);
                    ?>
                    <?php //echo  <p id="message"></p> ?>
            </div>
                  </div>
              </th></tr>
              <tr>
              <th align="left">
                  <label class="control-label" for="minlengthfield">Spesifikasi</label>
                  <div class="control-group">
            <div class="controls">:
                    <?php
                      echo strtoupper($isi->spesifikasi);
                    ?>
                    <?php //echo  <p id="message"></p> ?>
            </div>
                  </div>
              </th></tr>
        <tr>

        <tr>
              <th align="left">
                  <label class="control-label" for="minlengthfield">Kelompok Barang</label>
                  <div class="control-group">
            <div class="controls">:
                    <?php
                      echo strtoupper($isi->kelompok);
                    ?>
                    <?php //echo  <p id="message"></p> ?>
            </div>
                  </div>
              </th></tr>
        <tr>
              <th align="left">
                  <label class="control-label" for="minlengthfield">Merek</label>
                  <div class="control-group">
            <div class="controls">:
                      <?php
                        echo strtoupper($isi->merek);
                      ?>
            </div>
                  </div>

              </th></tr>
        <tr>
              <th align="left">
                  <label class="control-label" for="minlengthfield">Kelompok Fiskal</label>
                  <div class="control-group">
            <div class="controls">:
                    <?php
                      echo strtoupper($isi->kodefiskaltext);
                    ?>
                    <?php //echo  <p id="message"></p> ?>
            </div>
                  </div>
              </th></tr>
            <th align="left">
            <label class="control-label" for="minlengthfield">Inventaris</label>
            <div class="control-group">
          <div class="controls">:
                  <?php
                    echo ($CI->p_c->cekaktif($isi->inventaris));
                  ?>
                  <?php //echo  <p id="message"></p> ?>
          </div>
            </div>
            </th></tr>

            <th align="left">
            <label class="control-label" for="minlengthfield">Aktif</label>
            <div class="control-group">
          <div class="controls">:
                  <?php
                    echo ($CI->p_c->cekaktif($isi->aktif));
                  ?>
                  <?php //echo  <p id="message"></p> ?>
          </div>
            </div>
            </th></tr>
          </tr>
          <tr>
          <th align="left">
          <label class="control-label" for="minlengthfield">Stok Minimal</label>
          <div class="control-group">
        <div class="controls">:
                <?php
                  echo $isi->stock_min;
                ?>
                <?php //echo  <p id="message"></p> ?>
        </div>
          </div>
          </th></tr>
          <tr>
          <th align="left">
          <label class="control-label" for="minlengthfield">Stok</label>
          <div class="control-group">
        <div class="controls">:
                <?php
                  echo $isi->stock;
                ?>
                <?php //echo  <p id="message"></p> ?>
        </div>
          </div>
          </th></tr>
            </table>
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-body table-responsive" align="left">
                          <h3>Riwayat Pembelian</h3>
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No. Pembelian</th>
                                        <th>Jumlah</th>
                                        <th>Unit</th>
                                        <th>Tgl. Pembelian</th>
                                        <th>Keterangan</th>
                                        <th>Status</th>

                                    </tr>
                                </thead>
                                <tbody>
                                  <?php
                                  $CI =& get_instance();
              foreach((array)$datapembelian as $rowbeli) {
                  echo "<tr>";
                  echo "<td align='center'>";
                  echo "<a href=javascript:void(window.open('".site_url('inventory_pembelian/view/'.$rowbeli->replid)."')) >".$rowbeli->kode_transaksi."</a>";
                  echo "</td>";
                  echo "<td align=''>".($rowbeli->jumlah)."</td>";
                  echo "<td align='center'>".$rowbeli->unittext."</td>";
                  echo "<td align='center'>".$CI->p_c->tgl_indo($rowbeli->tanggalpembelian)."</td>";
                  echo "<td align='center'>".$rowbeli->vendortext."</td>";
                  echo "<td align='center'><b>".strtoupper($rowbeli->statustext)."</b></td>";
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

            <br/><table width="100%" border="0">
              <tr><td align="left" >
                <?php
                if ($isi->pakai<=0){
                  echo "<a href=javascript:void(window.open('".site_url("inventory_material/ubah/0/".$isi->replid)."')) class='btn btn-warning'>Ubah</a>&nbsp;&nbsp;";
                  echo "<a href=javascript:void(window.open('".site_url("inventory_material/hapus/".$isi->replid)."')) class='btn btn-xs btn-danger'>Hapus</a>&nbsp;&nbsp;";
                }
                echo "<a href=javascript:void(window.open('".site_url("inventory_material")."')) class='btn btn-success'>Kembali</a>&nbsp;&nbsp;";
                ?>
              </td></tr>
            </table>

          <?php
          echo form_close();
          ?>
    </section><!-- /.content -->
<?php } ?>
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
    </body>
</html>
