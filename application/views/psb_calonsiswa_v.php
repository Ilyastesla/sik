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
  <script>
    function submitform(excel){
      const form_x = document.getElementById("form"); 
      form_x.action="<?php echo site_url('psb_calonsiswa/printthis/');?>/"+excel;
      form_x.target="_blank";
      form_x.submit();
    }
  </script>

                <!-- Content Header (Page header) -->
                <section class="content-header table-responsive">
                    <h1>
                        <?php echo $form ?>
                        <small>List Data</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#" onclick="submitform(0)"><i class="fa fa-print"></i>Cetak</a></li>
                        <li><a href="#" onclick="submitform(1)"><i class="fa fa-file-excel-o"></i>Excel</a></li>
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
                                 <label class="control-label" for="minlengthfield">Unit Bisnis</label>
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
                            <?php
                              echo form_checkbox('abk', '1', $this->input->post('abk'))." ABK &nbsp;&nbsp;";
                              echo form_checkbox('keu_up', '1', $this->input->post('keu_up'))." UP &nbsp;&nbsp;";
                              echo form_checkbox('aktif', '1', $this->input->post('aktif'))." Aktif &nbsp;&nbsp;";
                              echo form_checkbox('lulus', '1', $this->input->post('lulus'))." Lulus &nbsp;&nbsp;";
                              echo form_checkbox('dalamproses', '1', $this->input->post('dalamproses'))." Proses &nbsp;&nbsp;";
                              echo form_checkbox('selesai', '1', $this->input->post('selesai'))." Selesai &nbsp;&nbsp;";
                            ?>
                          </th>
                        </tr>
    	                    <tr>
            						       <th align="left">
      				                		<label class="control-label" for="minlengthfield">Jenjang</label>
      				                		<div class="control-group">
              											<div class="controls">:
          						                	<?php
          						                		$arriddepartemen='data-rule-required=false  onchange=javascript:this.form.submit();';
          						                		echo form_dropdown('iddepartemen',$iddepartemen_opt,$this->input->post('iddepartemen'),$arriddepartemen);
          						                	?>
          						                	<?php //echo  <p id="message"></p> ?>
              											</div>
            				              </div>
            						         </th>
                                 <th align="left">
                                    <label class="control-label" for="minlengthfield">Program</label>
                                    <div class="control-group">
                                      <div class="controls">:
                                          <?php
                                            $arridkelompok='data-rule-required=false  onchange=javascript:this.form.submit();';
                                            echo form_dropdown('idkelompok',$idkelompok_opt,$this->input->post('idkelompok'),$arridkelompok);
                                          ?>
                                          <?php //echo  <p id="message"></p> ?>
                                      </div>
                                    </div>
                                   </th>

    			                  </tr>
                            <tr>
              						       <th align="left">
        				                		<label class="control-label" for="minlengthfield">Proses</label>
        				                		<div class="control-group">
                											<div class="controls">:
            						                	<?php
            						                		$arridproses='data-rule-required=false  onchange=javascript:this.form.submit();';
            						                		echo form_dropdown('idproses',$idproses_opt,$this->input->post('idproses'),$arridproses);
            						                	?>
            						                	<?php //echo  <p id="message"></p> ?>
                											</div>
              				              </div>
              						         </th>
                                   <th align="left">
          				                		<label class="control-label" for="minlengthfield">Jurusan</label>
          				                		<div class="control-group">
                  											<div class="controls">:
              						                	<?php
              						                		$arridjurusan='data-rule-required=false  onchange=javascript:this.form.submit();';
              						                		echo form_dropdown('idjurusan',$idjurusan_opt,$this->input->post('idjurusan'),$arridjurusan);
              						                	?>
              						                	<?php //echo  <p id="message"></p> ?>
                  											</div>
                				              </div>
                						         </th>

      			                  </tr>
                              <tr>
                                <th align="left">
                                  <label class="control-label" for="minlengthfield">Tahun Pelajaran</label>
                                  <div class="control-group">
                                    <div class="controls">:
                                        <?php
                                          $arridtahunajaran='data-rule-required=false  onchange=javascript:this.form.submit();';
                                          echo form_dropdown('idtahunajaran',$idtahunajaran_opt,$this->input->post('idtahunajaran'),$arridtahunajaran);
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
                <section class="content-header table-responsive">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-body table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <?php
                                                echo "<th width='50'>No.</th>";
                                                echo "<th>Nama</th>";
                                                //echo "<th width='120'>Tgl. Posting</th>";
                                                echo "<th>No Daftar</th>";
                                                //echo "<th>NIS Sementara</th>";
                                                echo "<th width='100'>Tingkat</th>";
                                                //echo "<th>Jurusan</th>";
                                                echo "<th>Tahun Pelajaran</th>";
                                                //echo "<th>Status Program</th>";
                                                //echo "<th>Calon Kelas</th>";
                                                echo "<th>Tgl. Daftar</th>";
                                                echo "<th>Biaya Form</th>";
                                                //echo "<th>Biaya Assessment</th>";
                                                echo "<th>UP</th>";
                                                echo "<th>Aktif</th>";
                                                echo "<th width='150'>SKL</th>";
                                                echo "<th>Verifikasi</th>";
                                                //echo "<th width='80'>Aksi</th>";
                                                echo "<th>NIS</th>";
                                                ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        	<?php
                                        	$CI =& get_instance();$no=1;
											foreach((array)$show_table as $row) {
											    echo "<tr>";
											    echo "<td align='center'>".$no++."</td>";
                          echo "<td align=''>".$row->nama."</td>";
                          //echo "<td align=''>".$CI->p_c->tgl_indo($row->tanggal_daftar)."</td>";
                          echo "<td align='center'>";
                          echo "<a href=javascript:void(window.open('".site_url('general/datacalonsiswa/'.$row->replid)."')) >".$row->nopendaftaran."</a>";
                          echo "</td>";
                          //echo "<td align=''>".($row->nissementara)."</td>";
                          echo "<td align='center'>".($row->tingkattext." ".$row->jurusantext."<br/>(".$row->kondisitext).")</td>";
                          //echo "<td align=''>".($row->jurusantext)."</td>";
                          echo "<td align=''>".$row->tahunajarantext."</td>";
                          //echo "<td align=''>".($row->kondisitext)."</td>";
                          //echo "<td align=''>".($row->kelastext )."</td>";
                          echo "<td align=''>";
                          if (($row->lama>$row->lamaproses) and ($row->replidsiswa=="") and ($row->aktif=="1")){
                            echo $CI->p_c->bgcolortext($CI->p_c->tgl_indo($row->tanggal_daftar),'red');
                          }else{
                            echo $CI->p_c->tgl_indo($row->tanggal_daftar);
                          }
                          echo "</td>";
                          echo "<td align=''>Reguler: ".$CI->p_c->cekaktif($row->keu_form)."<br/>Asesmen:".$CI->p_c->cekaktif($row->keu_assessment)."</td>";
                          //echo "<td align=''>".$CI->p_c->cekaktif($row->keu_assessment)."</td>";
                          echo "<td align=''>".$CI->p_c->cekaktif($row->keu_up)."</td>";
                          echo "<td align=''>".$CI->p_c->cekaktif($row->aktif)."</td>";
                          echo "<td align=''>Lulus: ".$CI->p_c->cekaktif($row->lulus)."<br/>Kelas: ".$row->calonkelastext."<br/>Tgl:".$CI->p_c->tgl_indo($row->tanggal_masuk)."</td>";
                          echo "<td align=''>".$CI->p_c->cekaktif($row->verifikasi)."</td>";
                          /*
                          echo "<td align='center'>";
                          echo "<a href=javascript:void(window.open('".site_url('psb_calonsiswa/ubahaktif/'.$row->replid.'/'.!($row->aktif))."')) >".$CI->p_c->cekaktif($row->aktif)."</a>";
                          echo "</td>";
                          */
                          /*
											    echo "<td align='center'>";
                          if ($row->replidsiswa==""){
											    		echo "<a href=javascript:void(window.open('".site_url('psb_calonsiswa/ubah/'.$row->replid)."')) class='btn btn-xs btn-warning fa fa-check-square' ></a>&nbsp;&nbsp;";
                              //echo "<a href=javascript:void(window.open('".site_url('psb_calonsiswa/hapus/'.$row->replid)."')) class='btn btn-xs btn-danger fa fa-minus-square' ></a> ";
                          }
											    echo "</td>";
                          */
                          echo "<td align='center'>";
                          if($row->replidsiswa<>""){
                            echo "<a href=javascript:void(window.open('".site_url('general/datasiswa/'.$row->replidsiswa)."')) >".$row->nis."</a>";
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
<?php } ?>
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
    </body>
</html>
