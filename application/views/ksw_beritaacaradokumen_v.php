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
                      <!--
                        <li><a href="javascript:void(window.open('<?php echo site_url('ksw_beritaacaradokumen/tambah'); ?>'))" ><i class="fa fa-plus-square"></i> Tambah</a></li>
                        <li><a href="#"><i class="fa fa-file-text"></i>Cetak</a></li>
                        <li><a href="#"><i class="fa fa-file-excel-o"></i>Excel</a></li>
                        -->
                    </ol>
                </section>

                <section class="content-header table-responsive">
                <?php
  			             $attributes = array('class' => 'form-horizontal form-validate', 'id' => 'form', 'method' => 'POST', 'novalidate'=>'novalidate','onsubmit'=>'return validate()');
  		    	echo form_open($action,$attributes);
  		    		?>
                    	<table width="100%" border="0">
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
                        <tr>
                          <th align="left">
                            <label class="control-label" for="minlengthfield">Jenis Dokumen</label>
                            <div class="control-group">
                              <div class="controls">:
                                  <?php
                                    $arridjenisdokumen='data-rule-required=false  onchange=javascript:this.form.submit();';
                                    echo form_dropdown('idjenisdokumen',$idjenisdokumen_opt,$this->input->post('idjenisdokumen'),$arridjenisdokumen);
                                  ?>
                                  <?php //echo  <p id="message"></p> ?>
                              </div>
                            </div>
                           </th>
                          <th align="left">
                            <label class="control-label" for="minlengthfield">Tipe</label>
                            <div class="control-group">
                              <div class="controls">:
                                  <?php
                                    $arridtipe='data-rule-required=false  onchange=javascript:this.form.submit();';
                                    echo form_dropdown('idtipe',$idtipe_opt,$this->input->post('idtipe'),$arridtipe);
                                  ?>
                                  <?php //echo  <p id="message"></p> ?>
                              </div>
                            </div>
                           </th>
                        </tr>
                        <tr>
                                <th align="left">
                                    <label class="control-label" for="minlengthfield">Periode</label>
                                    <div class="control-group">
                                        <div class="controls">:
                                                <?php
                                                echo form_input(array('class' => '', 'id' => 'dp1','name'=>'periode1','value'=>$this->input->post('periode1'),'data-rule-required'=>'false' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'2' ,'placeholder'=>'DD-MM-YYYY','autocomplete'=>'off','style'=>'width:110px;'));
                                                echo "&nbsp;".form_input(array('class' => '', 'id' => 'dp2','name'=>'periode2','value'=>$this->input->post('periode2'),'data-rule-required'=>'false' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'2' ,'placeholder'=>'DD-MM-YYYY','autocomplete'=>'off','style'=>'width:110px;'));
                                                ?>
                                                <?php //echo  <p id="message"></p> ?>
                                        </div>
                                    </div>
                                </th>
                                <th align="left">
                                   <label class="control-label" for="minlengthfield">Nama</label>
                                   <div class="control-group">
                                     <div class="controls">:
                                         <?php
                                           echo form_input(array('class' => '','style'=>'margin: 0px 0px 5px;', 'id' => 'nama','name'=>'nama','value'=>$this->input->post('nama'),'data-rule-required'=>'false' ,'data-rule-maxlength'=>'500', 'data-rule-minlength'=>'3' ,'placeholder'=>'Masukkan 1-100 Karakter'));
                                         ?>
                                         <?php //echo  <p id="message"></p> ?>
                                     </div>
                                  </div>
                                   </th>

      			              </tr>
          			            <tr>
          				            <th align="left" colspan="4">
          				            	<button class='btn btn-primary' name='filter' value="1">Filter</button>
          				            	<?php echo "<a href='".site_url($action)."' class='btn btn-danger'>Bersihkan</a>&nbsp;&nbsp;";?>
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
                                            <?php
                                            echo "<th width='50' >No</th>";
                                            echo "<th>NIS</th>";
                                            echo "<th>Nama</th>";
                                            echo "<th>Kelas</th>";
                                            echo "<th>Tahun Pelajaran</th>";
                                            echo "<th>Jenis Dokumen</th>";
                                            echo "<th>Tipe</th>";
                                            echo "<th>Tanggal</th>";
                                            echo "<th>Jumlah</th>";
                                            //if(ISSET($editdata) AND ($editdata==1)){
                                                echo "<th width='80'>Aksi</th>";
                                            //}

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
                        echo "<a href=javascript:void(window.open('".site_url('general/datasiswa/'.$row->replid)."')) >".$row->nis."</a>";
                        echo "</td>";
                        echo "<td align='left'>".strtoupper($row->nama)."</td>";
                        echo "<td align='center'>".strtoupper($row->kelastext)."</td>";
                        echo "<td align='center'>".strtoupper($row->tahunajarantext)."</td>";
                        echo "<td align='center'>".strtoupper($row->jenisdokumentext)."</td>";
                        echo "<td align='center'>".strtoupper($row->tipetext)."</td>";
                        echo "<td align='center'>".($CI->p_c->tgl_indo($row->tanggal))."</td>";
                        echo "<td align='center'>".($row->jumlah)."</td>";
                        echo "<td align='center'>";
                        //if($row->aktif<>1){
                          //echo "<a href=javascript:void(window.open('".site_url('ksw_mutasi/batalmutasi_p/'.$row->replid)."')) class='btn btn-danger' >Hapus</a>&nbsp;&nbsp;";
                      //  }
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
<?php } ?>
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
    </body>
</html>
