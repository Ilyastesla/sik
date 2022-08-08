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
                        <li><a href="javascript:void(window.open('<?php echo site_url('hrm_pegawai_projek/tambah'); ?>'))" ><i class="fa fa-plus-square"></i> Tambah</a></li>

                    </ol>
                </section>
                <section class="content-header table-responsive">
                    <?php
			        $attributes = array('class' => 'form-horizontal form-validate', 'id' => 'form', 'method' => 'POST', 'novalidate'=>'novalidate','onsubmit'=>'return validate()');
		    	echo form_open($action,$attributes);
		    		?>
                	<table width="100%" border="0">
                    <tr>
                      <td align="left" width="150">Unit Bisnis</td>
                      <td align="left">
                        <div class="control-group">
                        <?php
                            $arridcompany="data-rule-required=true id=idcompany  onchange='javascript:this.form.submit();' ";
                            echo form_dropdown('idcompany',$idcompany_opt,$this->input->post('idcompany'),$arridcompany);
                          ?>
                        </div>
                      </td>
                  </tr>
                  <tr>
                    <td align="left" width="150">Departemen</td>
                    <td align="left">
                      <div class="control-group">
                      <?php
                          $arriddepartemen="data-rule-required=true id=iddepartemen  onchange='javascript:this.form.submit();' ";
                          echo form_dropdown('iddepartemen',$iddepartemen_opt,$this->input->post('iddepartemen'),$arriddepartemen);
                        ?>
                      </div>
                    </td>
                </tr>
			            <tr>
				            <th align="left" colspan="4">
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
                                                <th width="50">No.</th>
                                                <th>Unit Bisnis</th>
                                                <th>Departemen</th>
                                                <th>Projek</th>
                                                <th>Aktif</th>
                                                <th width="100px">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        	<?php
                                        	$CI =& get_instance();
                                        	$no=1;
											foreach((array)$show_table as $row) {
											    echo "<tr>";
											    echo "<td align='center'>".$no++."</td>";
                          echo "<td align='center'>".$row->companytext."</td>";
                          echo "<td align='center'>".$row->departementext."</td>";
                          echo "<td align='left'>".$row->projek."</td>";
                          echo "<td align='center'>";
                          //if($row->jumlahkegiatan<1){
                            echo "<a href=javascript:void(window.open('".site_url('hrm_pegawai_projek/ubahaktif/'.$row->replid.'/'.!($row->aktif))."'))>".$CI->p_c->cekaktif($row->aktif)."</a>";
                          //}else{
                          //  echo $CI->p_c->cekaktif($row->aktif);
                          //}
                          echo "</td>";
                          echo "<td align='center'>";
                            echo "<a href=javascript:void(window.open('".site_url('hrm_pegawai_projek/view/'.$row->replid)."')) class='btn btn-xs btn-info fa fa-circle-o' ></a>&nbsp;&nbsp;";
                          //if($row->jumlahkegiatan<1){
                            echo "<a href=javascript:void(window.open('".site_url('hrm_pegawai_projek/ubah/'.$row->replid)."')) class='btn btn-xs btn-warning fa fa-check-square' ></a>&nbsp;&nbsp;";
                            echo "<a href=javascript:void(window.open('".site_url('hrm_pegawai_projek/hapus/'.$row->replid)."')) class='btn btn-xs btn-danger fa fa-minus-square' ></a>";
                          //}
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
    <script type="text/javascript">
      $(function(){
        $.ajaxSetup({
          type:"POST",
          url: "<?php echo site_url('combobox/ambil_data') ?>",
          cache: false,
        });

        $("#idcompany").change(function(){
            var value=$(this).val();
            $.ajax({
              data:{modul:'iddepartemen',id:value},
              success: function(respond){
                $("#iddepartemen").html(respond);
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
		    	?>
		    	<table width="100%" border="0">
            <tr>
		            <th align="left">
	                		<label class="control-label" for="minlengthfield">Unit Bisnis</label>
	                		<div class="control-group">
								<div class="controls">:
                  <?php
                    $arridcompany='data-rule-required=true id="idcompany"';
                    echo form_dropdown('idcompany',$idcompany_opt,$isi->idcompany,$arridcompany);
                  ?>
								</div>
	                		</div>
			            </th></tr>
          <tr>
	            <th align="left">
                		<label class="control-label" for="minlengthfield">Departemen</label>
                		<div class="control-group">
							<div class="controls">:
                <?php
                  $arriddepartemen='data-rule-required=true id="iddepartemen"';
                  echo form_dropdown('iddepartemen',$iddepartemen_opt,$isi->iddepartemen,$arriddepartemen);
                ?>
							</div>
                		</div>
		            </th></tr>
            <tr>
		            <th align="left">
	                		<label class="control-label" for="minlengthfield">Projek</label>
	                		<div class="control-group">
								<div class="controls">:
                        <textarea name="projek" rows="2" data-rule-required="true" style='width:220px;'><?php echo trim($isi->projek)?></textarea>
			                	<?php
			                		//echo form_input(array('class' => '', 'id' => 'projek','name'=>'projek','value'=>$isi->projek,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'2' ,'placeholder'=>'Masukkan 2-100 Karakter','style'=>'width:400px;'));
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th></tr>
			         <tr>
				            <th align="left">
				            	<button class='btn btn-primary' onclick="return validate()">Simpan</button>
				            	<a href="javascript:void(window.open('<?php echo site_url('hrm_pegawai_projek') ?>'))" class="btn btn-success">Batal</a>
				            </th>
				    </tr>
		            </table>
	    </section>
<?php } else if($view=='view'){ ?>
      <section class="content-header table-responsive">
            <h1>
                <?php echo $form ?>
                <small><?php echo $form_small ?></small>
            </h1>
          </section>
          <section class="content">
        <table width="100%" border="0" class="form-horizontal form-validate">
          <tr>
          <th align="left">
          <label class="control-label" for="minlengthfield">Unit Bisnis</label>
          <div class="control-group">
            <div class="controls">:
                    <?php echo $isi->companytext; ?>
            </div>
          </div>
          </th></tr>
          <tr>
          <th align="left">
          <label class="control-label" for="minlengthfield">Departemen</label>
          <div class="control-group">
            <div class="controls">:
                    <?php echo $isi->departementext; ?>
            </div>
          </div>
          </th></tr>
          <tr>
          <th align="left">
          <label class="control-label" for="minlengthfield">Projek</label>
          <div class="control-group">
            <div class="controls">:
                    <?php echo $isi->projek; ?>
            </div>
          </div>
          </th></tr>
          <tr>
            <th align="left">
              <label class="control-label" for="minlengthfield">Aktif</label>
              <div class="control-group">
                <div class="controls">:
                        <?php echo $CI->p_c->cekaktif($isi->aktif);?>
                </div>
              </div>
            </th>
          </tr>
        </table>
        <table>
                  <tr>
  		            <td align="left">
  		            	<?php
                        echo "<a href='#' onclick='window.close();' class='btn btn-success'>Tutup</a> ";
                        echo "<a href=javascript:void(window.open('".site_url('hrm_pegawai_projek/ubah/'.$isi->replid)."')) class='btn btn-warning' >Ubah</a> ";
                        echo "<a href=javascript:void(window.open('".site_url('hrm_pegawai_projek/hapus/'.$isi->replid)."')) class='btn btn-danger' >Hapus</a> ";
                    ?>
  		            </td>
  			    </tr>
              </table>
    <!--------------------------------------------------------------------------------------------------------------------------->
<?php
 }
echo form_close();
 ?>
</section>
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
    </body>
</html>
