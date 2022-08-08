<!DOCTYPE html>
<html>
<script language="javascript">
function cetakabsensi(id) {
	newWindow('../../printabsensi/'+id, 'cetakabsensi','900','800','resizable=1,scrollbars=1,status=0,toolbar=0')
}
</script>
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
                        <li><a href="#"><i class="fa fa-file-text"></i>Cetak</a></li>
                        <li><a href="#"><i class="fa fa-file-excel-o"></i>Excel</a></li>
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
                                <td align="left"><div class="control-group">
                      <?php
                                    $arridcompany="data-rule-required=true id=idcompany onchange='javascript:this.form.submit();'";
                                    echo form_dropdown('idcompany',$idcompany_opt,$this->input->post('idcompany'),$arridcompany);
                                    ?>
                                        <?php //echo  <p id="message"></p> ?>
                                  
                  </div>    </td>
                    <td align="left" width="150">Jenjang</td>
                                <td align="left"><div class="control-group">
                      <?php
                                                      $arriddepartemen='data-rule-required=true onchange=javascript:this.form.submit();';
                                                      echo form_dropdown('iddepartemen',$iddepartemen_opt,$this->input->post('iddepartemen'),$arriddepartemen);
                                                    ?>
                                        <?php //echo  <p id="message"></p> ?>
</div></td>
                        </tr>
			            <tr>
                     <td align="left" width="150">Tahun Pelajaran</td>
                    <td align="left">
											<div class="control-group">
                      <?php
                          $arridtahunajaran="data-rule-required=true id=idtahunajaran onchange='javascript:this.form.submit();' ";
                          echo form_dropdown('idtahunajaran',$idtahunajaran_opt,$this->input->post('idtahunajaran'),$arridtahunajaran);
                        ?>
											</div>
                    </td>
                    <td align="left" width="150">Semester</td>
                    <td align="left">
											<div class="control-group">
                      <?php
                          $arridperiode="data-rule-required=true id=idperiode";
                          echo form_dropdown('idperiode',$idperiode_opt,$this->input->post('idperiode'),$arridperiode);
                        ?>
											</div>
                    </td>
			            </tr>
			            <tr>
                    <td align="left" width="150">Kelas</td>
                   <td align="left">
										 <div class="control-group">
                     <?php
                           $arridkelas="data-rule-required=false id=idkelas";
                           echo form_dropdown('idkelas',$idkelas_opt,$this->input->post('idkelas') ,$arridkelas);
                       ?>
										 </div>
                   </td>
                   <td align="left" width="150">Tipe Proses</td>
                   <td align="left">
                     <div class="control-group">
                     <?php
                           $arridprosestipe="data-rule-required=true id='idprosestipe'";
                           echo form_dropdown('idprosestipe',$idprosestipe_opt,$this->input->post('idprosestipe') ,$arridprosestipe);
                       ?>
                     </div>
                   </td>

			            </tr>
                  <tr>
                    <td align="left" width="150">Mata Pelajaran</td>
                    <td align="left">
											<div class="control-group">
                      <?php
                        $arridmatpel="data-rule-required=false id=idmatpel";
                        echo form_dropdown('idmatpel',$idmatpel_opt,$this->input->post('idmatpel'),$arridmatpel);
                      ?>
										</div>
                    </td>
                    <td align="left" width="150">Petugas</td>
				            <td align="left">
				            	<?php
		                		$arrcreated_by="data-rule-required=false id=created_by";
		                		echo form_dropdown('created_by',$created_by_opt,$this->input->post('created_by'),$arrcreated_by);
		                	?>
				            </td>
              </tr>
			            <tr>
                    <!--
                    <td align="left" width="150">Region</td>
                    <td align="left">
                      <?php
                          $arridregion="data-rule-required=false id=idregion";
                          echo form_dropdown('idregion',$idregion_opt,$this->input->post('idregion'),$arridregion);
                        ?>
                    </td>
                  -->
			            </tr>
                  <tr>
                    <td align="left" width="150">Periode</td>
                    <td align="left">
                          <?php
                            echo form_input(array('class' => '', 'id' => 'dp1','name'=>'periode1','value'=>$this->input->post('periode1'),'data-rule-required'=>'false' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'2' ,'placeholder'=>'DD-MM-YYYY','autocomplete'=>'off'));
                            echo "&nbsp;".form_input(array('class' => '', 'id' => 'dp2','name'=>'periode2','value'=>$this->input->post('periode2'),'data-rule-required'=>'false' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'2' ,'placeholder'=>'DD-MM-YYYY','autocomplete'=>'off'));
                            ?>
                            <?php //echo  <p id="message"></p> ?>
                      </td>
											<!--
                      <td align="left" width="150">Terdaftar</td>
                      <td align="left">
                          <input type="checkbox" value="1" name='terdaftar'>
                      </td>
										-->
                  </tr>
			            <tr>
				            <th align="left" colspan="4">
				            	<button class='btn btn-primary' name='filter' value="1">Filter</button>
				            	<?php echo "<a href='".site_url($action)."' class='btn btn-danger'>Bersihkan</a>&nbsp;&nbsp;";?>
				            </th>";
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
                                                echo "<th>Tipe Proses</th>";
                                                //echo "<th>Petugas</th>";
                                                echo "<th>Mata Pelajaran</th>";
                                                echo "<th>Tema</th>";
                                                // echo "<th>Departemen</th>";
                                                echo "<th>Kelas</th>";
                                                echo "<th>Tahun Pelajaran</th>";
                                                echo "<th>Semester</th>";
                                                echo "<th>Tgl. Kegiatan</th>";
                                                echo "<th>Nama Siswa</th>";
                                                echo "<th width='30'>D</th>";
                                                echo "<th width='30'>A</th>";
                                                echo "<th width='30'>S</th>";
                                                echo "<th width='30'>I</th>";
                                                echo "<th width='30'>TP</th>";
                                                echo "<th>Pengembangan Diri</th>";
                                                echo "<th>Nilai</th>";
                                                ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        	<?php
                                        	$no=1;
											foreach((array)$show_table as $row) {
											    echo "<tr>";
											    echo "<td align='center'>".$no++."</td>";
											    echo "<td align=''><a href=javascript:void(window.open('".site_url('ns_pembelajaranjadwal/penilaian/'.$row->idpembelajaranjadwal)."/0')) >".strtoupper($row->prosestipe)."</a></td>";
											    // echo "<td align=''>".strtoupper($CI->dbx->getpegawai($row->created_by,0,1))."</td>";
											    echo "<td align=''>".strtoupper($row->matpel)."</td>";
											    echo "<td align=''>".strtoupper($row->keterangan)."</td>";
											    // echo "<td align=''>".strtoupper($row->iddepartemen)."</td>";
											    echo "<td align='center'>".strtoupper($row->kelas)."</td>";
											    //echo "<td align='center'>".strtoupper($row->region)."</td>";
											    echo "<td align='center'>".strtoupper($row->tahunajaran)."</td>";
											    echo "<td align='center'>".strtoupper($row->periode)."</td>";
											    echo "<td align='center'>".strtoupper($CI->p_c->tgl_indo($row->tanggalkegiatan))."</td>";
                          echo "<td align='center'>".strtoupper($row->namasiswa)."</td>";
                          echo "<td align='center'>".$CI->p_c->cekaktif($row->terdaftar)."</td>";
                          echo "<td align='center'>".$CI->p_c->cekaktif($row->sakit)."</td>";
                          echo "<td align='center'>".$CI->p_c->cekaktif($row->izin)."</td>";
                          echo "<td align='center'>".$CI->p_c->cekaktif($row->alpha)."</td>";
                          echo "<td align='center'>".$CI->p_c->cekaktif($row->tugas)."</td>";
                          echo "<td align='center'>".strtoupper($row->pengembangandirivariabel)."</td>";
                          echo "<td align='center'>".$row->nilai."</td>";
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
<?php } elseif($view=='tambah'){ ?>

<?php } ?>
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
    </body>
</html>
