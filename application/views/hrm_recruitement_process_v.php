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
                                            echo "<th width='*'>No.KTP</th>";
                                            echo "<th width='*'>Nama</th>";
                                            echo "<th width='*'>Alamat</th>";
                                            //echo "<th width='*'>Umur</th>";
                                            echo "<th width='*'>Perusahaan</th>";
                                            echo "<th width='200'>Jabatan</th>";
                                            //echo "<th width='*'>Tipe Pekerjaan</th>";
                                            echo "<th width='*'>Tgl. Bergabung</th>";
                                            echo "<th width='*'>Harapan Gaji</th>";
                                            echo "<th width='*'>Status</th>";
                                            echo "<th width='*'>Aksi</th>";
                                            ?>

                                            </tr>
                                        </thead>
                                        <tbody>
                                        	<?php
                                        	$CI =& get_instance();
											foreach((array)$show_table as $row) {
												echo "<tr>";
											     echo "<td align='center'>
											    			<a href=javascript:void(window.open('".site_url('hrm_recruitement_process/view/'.$row->replid)."')) >".$row->noktp."</a>
											    		</td>";

											    echo "<td align=''>".($row->nama.' ['.$row->kelamin.']')."</td>";
											    echo "<td align='center'>".strtoupper($row->alamat_tinggal)
											    	  ."<br/>Telp. ".strtoupper($row->telpon)
											    	  ."<br/>HP. ".strtoupper($row->handphone)
											    	   ."<br/>Email. ".$row->email
											    	   ."</td>";
											    //echo "<td align='center'>".strtoupper($row->umur)."</td>";
                          //echo "<td align='center'>".$CI->p_c->tgl_indo($row->created_date)."</td>";
                          echo "<td align='left'>".$row->companytext."</td>";
                          echo "<td align='left'>".$row->jabatantext.' ['.$row->tipepekerjaantext.']'."</td>";
                          echo "<td align='center'>".$CI->p_c->tgl_indo($row->tglgabung)."</td>";
                          echo "<td align='left'>".$CI->p_c->rupiah($row->harapangaji)."</td>";
                          echo "<td align='left' width='130px'>".$row->statustext;
                          if($row->niksementara<>""){
                            echo "<b><br/>NIK: ".$row->niksementara."</b>";
                          }
                          echo "</td>";
												  echo "<td align='center' width='130px'>";
                          if($row->status=="6"){
                          //  echo "Telah Di Import";
                          //}else{
                            echo "<a href=javascript:void(window.open('".site_url('hrm_recruitement_process/prosespelamar/'.$row->idproses)."')) class='btn btn-primary'>Proses</a>&nbsp;&nbsp;";
                            echo "<a href=javascript:void(window.open('".site_url('hrm_recruitement_process/batal/'.$row->idproses)."')) class='btn btn-danger'>Batal</a>&nbsp;&nbsp;";
                          }else if($row->status==7){
                              echo "<a href=javascript:void(window.open('".site_url('hrm_recruitement_process/proses_p/9/'.$row->idproses)."')) class='btn btn-warning'>Impor</a>&nbsp;&nbsp;";
                              echo "<a href=javascript:void(window.open('".site_url('hrm_recruitement_process/batal/'.$row->idproses)."')) class='btn btn-danger'>Batal</a>&nbsp;&nbsp;";
                          }
                          if($row->idpegawai>0){
                            echo "<a href=javascript:void(window.open('".site_url('general/datapegawai/'.$row->idpegawai)."')) >".$row->niksementara."</a>";
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
<?php } elseif($view=='proses'){ ?>
        <section class="content-header table-responsive">
            <h1>
                <?php echo $form ?>
                <small>List Data</small>
            </h1>
        </section>
        <section class="content">
        <?php
          $attributes = array('class' => 'form-horizontal form-validate', 'id' => 'form', 'method' => 'POST');
      echo form_open($action,$attributes);
      ?>
      <table width="100%" border="0">
        <tr>
              <th align="left">
                  <label class="control-label" for="minlengthfield">NIK <br/><b>[Kosongkan Untuk NIK otomatis]</b></label>
                  <div class="control-group">
            <div class="controls">:
                    <?php
                      echo form_input(array('id' => 'niksementara','name'=>'niksementara','value'=>$isi->niksementara,'data-rule-required'=>'false' ,'data-rule-maxlength'=>'12', 'data-rule-minlength'=>'12','data-rule-number'=>'true','placeholder'=>'Masukkan 12 Angka'));
                    ?>
                    <?php //echo  <p id="message"></p> ?>
            </div>
                  </div>
          </th></tr>
        <tr>
              <th align="left">
                  <label class="control-label" for="minlengthfield">Tgl. Mulai Bekerja</label>
                  <div class="control-group">
            <div class="controls">:
                    <?php
                      echo form_input(array('class' => '', 'id' => 'dp1','name'=>'tglbekerja','value'=>$CI->p_c->tgl_form($isi->tglbekerja),'data-rule-required'=>'false' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'2' ,'placeholder'=>'DD-MM-YYYY','autocomplete'=>'off'));
                    ?>
                    <?php //echo  <p id="message"></p> ?>
            </div>
                  </div>
              </th>
           </tr>
        </table>
        <table width="100%" border="0">
        <tr>
             <th align="left">
               <button class="btn btn-primary">Simpan</button>
               <a href="javascript:void(window.open('<?php echo site_url('hrm_event') ?>'))" class="btn btn-success">Batal</a>
             </th>
        </tr>
     </table>
      <!--------------------------------------------------------------------------------------------------------------------------->
          <?php
          echo form_close();
          ?>
      </section>
<?php } elseif($view=='batal'){ ?>
  <section class="content-header table-responsive">
      <h1>
          <?php echo $form ?>
          <small>List Data</small>
      </h1>
  </section>
  <section class="content">
  <?php
    $attributes = array('class' => 'form-horizontal form-validate', 'id' => 'form', 'method' => 'POST');
echo form_open($action,$attributes);
?>
<table width="100%" border="0">
      <tr>
      <th align="left">
      <label class="control-label" for="minlengthfield">Tipe Alasan</label>
      <div class="control-group">
    <div class="controls">:
            <?php
              $arridtipealasan=' id="idtipealasan" data-rule-required=true"';
              echo form_dropdown('idtipealasan',$idtipealasan_opt,$isi->idtipealasan,$arridtipealasan);
            ?>
    </div>
      </div>
      </th></tr>
    <tr>
        <th align="left">
            <label class="control-label" for="minlengthfield">Alasan</label>
            <div class="control-group">
      <div class="controls">:
              </div>
        </th>
    </tr>
    <tr>
      <th>
                  <div class='box-body pad'>
                          <textarea id="editor1" name="alasantext" rows="10" cols="80" data-rule-required="true">
                              <?php echo $isi->alasantext?>
                          </textarea>
                          <script type="text/javascript">CKEDITOR.replace('editor1');</script>
                  </div>
                  <?php //echo  <p id="message"></p> ?>
        </th></tr>
     <tr>
          <th align="left">
            <button class="btn btn-primary">Simpan</button>
            <a href="javascript:void(window.open('<?php echo site_url('hrm_event') ?>'))" class="btn btn-success">Batal</a>
          </th>
     </tr>
  </table>
<!--------------------------------------------------------------------------------------------------------------------------->
    <?php
    echo form_close();
    ?>
</section>
<?php } ?>
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
    </body>
</html>
