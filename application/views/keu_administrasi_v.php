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
  <script language="javascript">
  function submitform() {
    document.getElementById("form").setAttribute("action", "<?php echo $action; ?>");
    document.getElementById("form").setAttribute("target", "");
    
  }

  function cetakprint() {
    document.getElementById("form").setAttribute("action", "<?php echo $action."/index/1" ?>");
    document.getElementById("form").setAttribute("target", "_blank");
    document.getElementById("form").submit();
  }
  function cetakexcel() {

    document.getElementById("form").setAttribute("action", "<?php echo $action."/index/1/1" ?>");
    document.getElementById("form").setAttribute("target", "_blank");
    document.getElementById("form").submit();
  }
  </script>
                <!-- Content Header (Page header) -->
                <section class="content-header table-responsive">
                    <h1>
                        <?php echo $form ?>
                        <small>List Data</small>
                    </h1>

                    <ol class="breadcrumb">
                            <!-- <li><a href="javascript:void(window.open('<?php echo site_url('keu_administrasi/tambah'); ?>'))" ><i class="fa fa-plus-square"></i> Tambah</a></li> -->
                            <li><a href="JavaScript:cetakprint()"><i class="fa fa-file-text"></i>&nbsp;Cetak</a></li>
                            <li><a href="JavaScript:cetakexcel()"><i class="fa fa-print"></i>&nbsp;Excel</a></li>
                    </ol>
                </section>
                <section class="content-header table-responsive">
                <?php
  			             $attributes = array('class' => 'form-horizontal form-validate', 'id' => 'form', 'method' => 'POST', 'novalidate'=>'novalidate','onsubmit'=>'JavaScript:submitform()');
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
      				                		<label class="control-label" for="minlengthfield">Jenjang</label>
      				                		<div class="control-group">
              											<div class="controls">:
          						                	<?php
          						                		$arriddepartemen='data-rule-required=true onchange=javascript:this.form.submit();';
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
        				                		<label class="control-label" for="minlengthfield">Tingkat</label>
        				                		<div class="control-group">
                											<div class="controls">:
            						                	<?php
            						                		$arridtingkat='data-rule-required=false onchange=javascript:this.form.submit();';
            						                		echo form_dropdown('idtingkat',$idtingkat_opt,$this->input->post('idtingkat'),$arridtingkat);
            						                	?>
            						                	<?php //echo  <p id="message"></p> ?>
                											</div>
              				              </div>
              						         </th>
                                    <th align="left">
                                      <label class="control-label" for="minlengthfield">Kelas</label>
          				                		<div class="control-group">
                  											<div class="controls">:
              						                	<?php
              						                		$arridkelas='data-rule-required=false onchange=javascript:this.form.submit();';
              						                		echo form_dropdown('idkelas',$idkelas_opt,$this->input->post('idkelas'),$arridkelas);
              						                	?>
              						                	<?php //echo  <p id="message"></p> ?>
                  											</div>
                				              </div>
            						            </th>
      			                  </tr>
                              <tr>
                                  <th align="left" colspan="2">
                                     <label class="control-label" for="minlengthfield">Nama</label>
                                     <div class="control-group">
                                       <div class="controls">:
                                           <?php
                                             echo form_input(array('class' => '','style'=>'margin: 0px 0px 5px; width: 687px;', 'id' => 'nama','name'=>'nama','value'=>$this->input->post('nama'),'data-rule-required'=>'false' ,'data-rule-maxlength'=>'500', 'data-rule-minlength'=>'3' ,'placeholder'=>'Masukkan 1-100 Karakter'));
                                           ?>
                                           <?php //echo  <p id="message"></p> ?>
                                       </div>
                                     </div>
                                    </th>
                               </tr>
          			            <tr>
          				            <th align="left" colspan="4">
                                <!-- <button class='btn btn-primary' name='filter' value="1">Filter</button> -->
                                <button class='btn btn-primary' name='filter' value="1" >Filter</button>
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
                                              <th width="50" >No</th>
                                              <th>NIS</th>
                                              <th>Nama</th>
                                              <th>Kelas</th>
                                              <!-- <th>Status Program</th> -->
                                              <th>Regional</th>
                                              <th>ABK</th>
                                              <th>Aktif</th>

                                              <!--
                                              <th>Keuangan</th>
                                              -->
                                              <?php
                                              echo "<th>Tipe Peringatan</th>";
                                               echo "<th>Administrasi<br/>Siswa</th>";
                                               echo "<th width='50'>Sisa Hari</th>";
                                               echo "<th>RP</th>";
                                               echo "<th>TV</th>";
                                               echo "<th width='200'>Aksi</th>";
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
                          //echo "<a href=javascript:void(window.open('".site_url('keu_administrasi/view/0/'.$row->replid)."'))>".strtoupper($row->nis)."</a> ";
                          echo "<a href=javascript:void(window.open('".site_url('general/datasiswa/'.$row->replid)."')) >".strtoupper($row->nis)."</a> ";
                          echo "</td>";
                          echo "<td align='center'>".strtoupper($row->nama);
                          if ($row->jml_hari<=14){
                            echo ' <b><font color="red">(baru)</font></b>';
                          }
                          //if (($row->jml_hari>=180) and ($row->konseling_desc==1)){
                          //  echo ' <b><font color="red">(Harus Interview)</font></b>';
                          //}
                          echo "</td>";
                          echo "<td align='center'>".strtoupper($row->kelas)."<br/>[".$row->namawalitext."]</td>";
                          echo "<td align='center'>".strtoupper($row->kondisi_nm)."</td>";
                          //echo "<td align='center'>".strtoupper($row->region)."</td>";
                          echo "<td align='center'>".($CI->p_c->cekaktif($row->abk))."</td>";
                          echo "<td align='center'>".$CI->p_c->cekaktif($row->aktif)."</td>";
                          echo "<td align='center'>".$CI->p_c->cekperingatan($row->peringatan)."</td>";
                          echo "<td align='center'>";
                          if($row->peringatan>"0"){
                            echo $CI->p_c->tgl_indo($row->tgl_kadaluarsa);
                          }
                          echo "</td>";
                          //echo "<td align='center'>";
                          //echo "</td>";
                          echo "<td align='center'>";
                          if (($row->sisahari<7) and ($row->peringatan>"0")){
                            echo "<small class='badge bg-red'>".strtoupper($row->sisahari)."<small>";
                          }else {
                            echo strtoupper($row->sisahari);
                          }
                          echo "</td>";
                          echo "<td align='center'>";
                          echo "<a href=javascript:void(window.open('".site_url('keu_administrasi/set_rp/'.$row->replid.'/'.!($row->remedialperilaku))."'))>".$CI->p_c->cekaktif($row->remedialperilaku)."</a> ";
                          echo "</td>";
                          echo "<td align='center'>";
                          echo "<a href=javascript:void(window.open('".site_url('keu_administrasi/set_tutorvisit/'.$row->replid.'/'.!($row->keu_tutorvisit))."'))>".$CI->p_c->cekaktif($row->keu_tutorvisit)."</a> ";
                          echo "</td>";
                          echo "<td align='center'>";
                          if(($row->peringatan<"1") or ($row->peringatan=="1")){
                              echo "<a href=javascript:void(window.open('".site_url('keu_administrasi/set_peringatan/1/'.$row->replid)."')) class='btn btn-xs btn-warning fa fa-warning'></a> ";
                          }
                          if(($row->peringatan>"0") and ($row->peringatan<"4")){
                            echo "<a href=javascript:void(window.open('".site_url('keu_administrasi/set_peringatan/'.($row->peringatan+1).'/'.$row->replid)."')) class='btn btn-xs btn-danger fa fa-sign-out'></a> ";
                          }

                          if($row->peringatan>"0"){
                              echo "<a href=javascript:void(window.open('".site_url('keu_administrasi/set_peringatan/0/'.$row->replid)."')) class='btn btn-xs btn-success fa fa-refresh' ></a> ";
                          }

                          echo "<a href=javascript:void(window.open('".site_url('keu_administrasi/view/1/'.$row->replid)."')) class='btn btn-xs btn-info fa fa-folder'></a> ";
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
<?php } elseif($view=='view'){ ?>
<section class="content-header table-responsive">
      <h1>
          <?php echo $form ?>
          <small><?php echo $form_small ?></small>
      </h1>
      <!--
      <ol class="breadcrumb">
        <li><a href="JavaScript:cetakprint()"><i class="fa fa-file-text"></i>&nbsp;Cetak</a></li>
      </ol>
    -->
</section>
<section class="content">
    <table width="100%" border="0" class="form-horizontal form-validate">
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
                        echo $isi->kelas;
                      ?>
              </div>
                </div>
              </th></tr>
            <tr>
              <tr>
              <th align="left">
              <label class="control-label" for="minlengthfield">Status Program</label>
              <div class="control-group">
            <div class="controls">:
              <?php
                echo $isi->kondisi_nm;
              ?>
            </div>
              </div>
              </th></tr>
              <tr>
                <tr>
                <th align="left">
                <label class="control-label" for="minlengthfield">Regional</label>
                <div class="control-group">
              <div class="controls">:
                <?php
                  echo $isi->region;
                ?>
              </div>
                </div>
                </th></tr>
        <tr>
            <th align="left">
            <label class="control-label" for="minlengthfield">ABK</label>
            <div class="control-group">
          <div class="controls">:
                  <?php
                    echo $CI->p_c->cekaktif($isi->abk);
                  ?>
          </div>
            </div>
            </th></tr>
      <tr>
          <th align="left">
          <label class="control-label" for="minlengthfield">Aktif</label>
          <div class="control-group">
        <div class="controls">:
                <?php
                  echo $CI->p_c->cekaktif($isi->aktif);
                ?>
        </div>
          </div>
          </th></tr>
    <tr>
      <tr>
      <th align="left">
      <label class="control-label" for="minlengthfield">Tipe Peringatan</label>
      <div class="control-group">
    <div class="controls">:
      <?php
        echo $CI->p_c->cekperingatan($isi->peringatan);
      ?>
    </div>
      </div>
      </th></tr>
  <tr>
      <th align="left">
      <label class="control-label" for="minlengthfield">Sisa Hari</label>
      <div class="control-group">
    <div class="controls">:
            <?php
              echo strtoupper($CI->p_c->tgl_indo($isi->tgl_kadaluarsa))." (".$isi->sisahari.")";
            ?>
    </div>
      </div>
      </th></tr>
      <?php
      if($ubah=="1"){
          echo "<tr>
              <th align='left'>";
          if(($isi->peringatan<"1") or ($isi->peringatan=="1")){
              echo "<a href=javascript:void(window.open('".site_url('keu_administrasi/set_peringatan/1/'.$isi->replid)."')) class='btn btn-xs btn-warning fa fa-warning'></a> ";
          }
          if(($isi->peringatan>"0") and ($isi->peringatan<"4")){
            echo "<a href=javascript:void(window.open('".site_url('keu_administrasi/set_peringatan/'.($isi->peringatan+1).'/'.$isi->replid)."')) class='btn btn-xs btn-danger fa fa-sign-out'></a> ";
          }

          if($isi->peringatan>"0"){
              echo "<a href=javascript:void(window.open('".site_url('keu_administrasi/set_peringatan/0/'.$isi->replid)."')) class='btn btn-xs btn-success fa fa-refresh'></a> ";
          }
      }
      echo "</th></tr>";

      ?>
     </table>
     <?php
     if($ubah<>"1"){?>
     <hr><h4>Arsip :</h4>
       <div class="box-body table-responsive">
           <table class="table table-bordered table-striped">
                   <thead>
                       <tr>
                           <th width="30px">No.</th>
                           <th>Tipe Proses</th>
                           <th>Tgl. Aktivasi</th>
                           <th>Tgl. Kadaluarsa</th>
                       </tr>
                   </thead>
                   <tbody>
                     <?php
                     $CI =& get_instance();$no=1;
           foreach((array)$peringatan as $rowaperingatan) {
               echo "<tr>";
               echo "<td>".$no++."</td>";
               echo "<td>".$CI->p_c->cekperingatan($rowaperingatan->peringatantype)."</td>";
               echo "<td>".$CI->p_c->tgl_indo($rowaperingatan->tgl_aktivasi)."</td>";
               echo "<td>".$CI->p_c->tgl_indo($rowaperingatan->tgl_kadaluarsa)."</td>";
               echo "</tr>";
           }
           ?>
           </tbody>
           <tfoot>
           </tfoot>
         </table>
      <?php } ?>
     <hr><h4>Attachment :</h4>
       <?php
       if($ubah=="1"){
        $attributes = array('class' => 'form-horizontal form-validate', 'id' => 'form', 'method' => 'POST', 'novalidate'=>'novalidate');
        echo form_open_multipart($actionattachment,$attributes);
       ?>
       <div align="left">
       <input type="file" name="userfile" size="20" /><br/>
       <input type="submit" value="upload" class='btn btn-xs btn-primary'/>
       </div>
       <hr/><br/>
       <?php echo form_close();
       }?>
       <div class="box-body table-responsive">
           <table class="table table-bordered table-striped">
                   <thead>
                       <tr>
                           <th width="30px">No.</th>
                           <th>Nama File</th>
                           <th>Tgl.Pembuatan</th>
                           <?php if($ubah=="1"){ ?>
                           <th width="80">Aksi</th>
                         <?php } ?>
                       </tr>
                   </thead>
                   <tbody>
                     <?php
                     $CI =& get_instance();$no=1;
           foreach((array)$attachment as $rowattachment) {
               echo "<tr>";
               echo "<td>".$no++."</td>";
               echo "<td align='left'><a href='".base_url()."uploads/keu_administrasi/".$rowattachment->newfile."'>".$rowattachment->file."</td>";
               echo "<td align='center'>".$CI->p_c->tgl_indo($rowattachment->created_date)."</td>";
               if($ubah=="1"){
                 echo "<td>";
                 echo "<a href=javascript:void(window.open('".site_url('keu_administrasi/hapusattachment_p/'.$rowattachment->idsiswa.'/'.$rowattachment->replid.'/'.$rowattachment->newfile)."')) class='btn btn-xs btn-danger' id='btnOpenDialog'>Hapus</a>";
                 echo "</td>";
               }
               echo "</tr>";
           }
           ?>
           </tbody>
           <tfoot>
           </tfoot>
         </table>
         <table border="0">
             <tr align="left">
               <td>
                 <?php
                 if($ubah==1){
                    echo "<a href=javascript:void(window.open('".site_url('keu_administrasi/view/0/'.$isi->replid)."')) class='btn btn-success'>Selesai</a>&nbsp;&nbsp;";
                 }else{
                   echo "<a href=javascript:void(window.open('".site_url('keu_administrasi')."')) class='btn btn-success'>Kembali</a>&nbsp;&nbsp;";
                 }

                 ?>
               </td>
             </tr>
         </table>
  </div>
	</section>
<!-------------------------------------------------------------------------------------------------------------------------------------->
<?php } ?>
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
    </body>
</html>
