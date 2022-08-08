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
<?php $CI =& get_instance();?>
<?php if($view=='index'){ ?>
                <section class="content-header">
                    <h1>
                        <?php echo $form ?>
                        <small>List Data</small>
                    </h1>
                    <!--
                        <li><a href="#"><i class="fa fa-file-text"></i>Cetak</a></li>
                        <li><a href="#"><i class="fa fa-file-excel-o"></i>Excel</a></li>
                        -->
                    <ol class="breadcrumb">
                        <li><a href="<?php echo site_url('hrm_pegawai_attachment/tambah'); ?>"><i class="fa fa-plus-square"></i> Tambah</a></li>

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
                            <tr>
                                <th width="30px">No.</th>
                                <th width="150px">Dokumen Tipe</th>
                                <th>Nama File</th>
                                <th width="150">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                          <?php
                          $CI =& get_instance();$no=1;
                foreach((array)$show_table as $rowattachment) {
                    echo "<tr>";
                    echo "<td>".$no++."</td>";
                    echo "<td>".$rowattachment->dokumentipetext."</td>";
                    echo "<td align='left'><a href='".base_url()."uploads/pegawai/".$rowattachment->newfile."' target='blank_'>".$rowattachment->file."</td>";
                    echo "<td>";
                    if($rowattachment->replid<>""){
                      echo "<a href='".site_url('hrm_pegawai_attachment/hapusattachment_p/'.$rowattachment->replid.'/'.$rowattachment->newfile)."' class='btn btn-danger' id='btnOpenDialog'>Hapus</a>";
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
		    <section class="content-header">
	            <h1>
	                <?php echo $form ?>
	                <small><?php echo $form_small ?></small>
	            </h1>
            </section>
            <section class="content">
		        <?php
            $attributes = array('class' => 'form-horizontal form-validate', 'id' => 'form', 'method' => 'POST', 'novalidate'=>'novalidate');
                 echo form_open_multipart($action,$attributes);
                ?>
                <table width="100%" border="0">
                    <tr>
                    <th align="left">
                              <label class="control-label" for="minlengthfield">Jenis Dokumen</label>
                              <div class="control-group">
                                <div class="controls">:
                                    <?php
                                      $arriddokumentipe='data-rule-required=true';
                                      echo form_dropdown('iddokumentipe',$iddokumentipe_opt,$this->input->post('iddokumentipe'),$arriddokumentipe);
                                    ?>
                                    <?php //echo  <p id="message"></p> ?>
                                </div>
                              </div>
                             </th>
                        </tr>
                        <tr>
                             <th align="left">
                               <label class="control-label" for="minlengthfield">Pilih Dokumen</label>
       				                		<div class="control-group">
               											<div class="controls">:
                                      <input type="file" name="userfile" size="20" data-rule-required=true /><br/>
                                    </div>
            				              </div>
            						         </th>
                          </tr>
                </table>
                <table width="100%" border="0">
                  <tr>
                     <th align="left" colspan="4">
                       <button class='btn btn-primary'>Simpan</button>
                       <a href="<?php echo site_url('hrm_pegawai_attachment') ?>" class="btn btn-success">Batal</a>
                     </th>
                  </tr>
                </table>
                <?php echo form_close();
 } ?>
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
    </body>
</html>
