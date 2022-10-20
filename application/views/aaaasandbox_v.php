<?php $this->load->view('template/header_v') ?>


    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><?php echo $form ?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="javascript:void(window.open('<?php echo site_url('departemen/tambah'); ?>'))"><i class="fa fa-plus-square"></i> Tambah</a></li>
                        <li class="breadcrumb-item"><a href="#"><i class="fa fa-file-text"></i>Cetak</a></li>
                        <li class="breadcrumb-item"><a href="#"><i class="fa fa-file-excel-o"></i>Excel</a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
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
                        <li><a href="javascript:void(window.open('<?php echo site_url('departemen/tambah'); ?>'))"><i class="fa fa-plus-square"></i> Tambah</a></li>

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
                                                echo "<th width='50'>No.</th>";
                                                echo "<th>Perusahaan</th>";
                                                echo "<th>Departemen</th>";
                                                echo "<th>Kode Departemen</th>";
                                                echo "<th>Aktif</th>";
                                                echo "<th width='80'>Aksi</th>";
                                                ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        	<?php
                                        	$CI =& get_instance();
                                        	$no=1;
											foreach((array)$show_table as $row) {
											    echo "<tr>";
											    echo "<td align='center'>".$no++."</td>";
                          echo "<td align='center'>".strtoupper($row->companytext)."</td>";
											    echo "<td align='center'>".strtoupper($row->departemen)."</td>";
											    echo "<td align='center'>".strtoupper($row->kodedepartemen)."</td>";
											    echo "<td align='center'>".$CI->p_c->cekaktif(strtoupper($row->aktif))."</td>";
											    echo "<td align='center'>";
                          echo "<a href=javascript:void(window.open('".site_url('departemen/ubah/'.$row->replid)."')) class='btn btn-xs btn-warning fa fa-check-square'></a>&nbsp;";
                          echo "<a href=javascript:void(window.open('".site_url('departemen/hapus/'.$row->replid)."')) class='btn btn-xs btn-danger fa fa-minus-square'></a>";
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
<?php } ?>
    <?php $this->load->view('template/footer_v') ?>




