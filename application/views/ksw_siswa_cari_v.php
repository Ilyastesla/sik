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
                                              <th>NIS</th>
                                              <th>Nama</th>
                                              <th>Jenjang</th>
                                              <th>Tahun Pelajaran</th>
                                              <th>Kelas</th>
                                              <th>Status Program</th>
                                              <th>Regional</th>
                                              <th>Whatsapp</th>
                                              <th>ABK</th>
                                              <th>Remedial<br/>Perilaku</th>
                                              <?php
                                              //echo "<th>Keuangan</th>";
                                              //echo "<th>Administrasi<br/>Siswa</th>";
                                              echo "<th>Aktif</th>";
                                              echo "<th>Peringatan</th>";
                                               //echo "<th width='80'>Aksi</th>";
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
                          echo "<td align='center'>".strtoupper($row->nama);
                          if ($row->jml_hari<=14){
                            echo ' <b><font color="red">(baru)</font></b>';
                          }
                          echo "</td>";
                          echo "<td align='center'>".strtoupper($row->departemen)."</td>";
                          echo "<td align='center'>".strtoupper($row->tahunajaran)."</td>";
                          echo "<td align='center'>".strtoupper($row->kelas)."</td>";

                          //if (($row->jml_hari>=180) and ($row->konseling_desc==1)){
                          //  echo ' <b><font color="red">(Harus Interview)</font></b>';
                          //}
                          echo "<td align='center'>".strtoupper($row->kondisi_nm)."</td>";
                          echo "<td align='center'>".strtoupper($row->region)."</td>";
                          echo "<td align='center'>".strtoupper($row->pinbbm)."</td>";
                          echo "<td align='center'>".($CI->p_c->cekaktif($row->abk))."</td>";
                          echo "<td align='center'>".($CI->p_c->cekaktif($row->remedialperilaku))."</td>";
                          echo "<td align='center'>".$CI->p_c->cekaktif($row->aktif)."</td>";
                          echo "<td align='center'>";
                          echo $CI->p_c->cekperingatan($row->peringatan);
                          echo "</td>";
											    //echo "<td align='center'>";
                          //echo "</td>";
                          //echo "<td align='center'>";
                          //echo "</td>";

                          //echo "<td align='center'>";
											    //echo "<a href=javascript:void(window.open('".site_url('ksw_siswa_cari/ubah/'.$row->replid)."')) class='btn btn-xs btn-warning fa fa-check-square' ></a>&nbsp;&nbsp;";
											    //echo "</td>";
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
