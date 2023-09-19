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
                                
    			                  </tr>
                        <tr>
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
                                              echo "<th>No Daftar</th>";
                                              //echo "<th>NIS Sementara</th>";
                                              echo "<th>Nama</th>";
                                              //echo "<th>Proses</th>";
                                              echo "<th>Program</th>";
                                              echo "<th>Status Program</th>";
                                              echo "<th>Tingkat</th>";
                                              echo "<th>Regional</th>";
                                              echo "<th>Tgl.Daftar</th>";
                                              echo "<th>ABK</th>";
                                              //echo "<th>Token</th>";
                                              echo "<th>Aktif</th>";
                                              echo "<th width='50'>Form</th>";
                                              echo "<th width='50'>Assessment</th>";
                                              echo "<th width='50'>UP</th>";
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
                          echo "<a href=javascript:void(window.open('".site_url('general/datacalonsiswa/'.$row->replid)."')) >".$row->nopendaftaran."</a>";
                          echo "</td>";
                          //echo "<td align='center'>".strtoupper($row->nissementara)."</td>";
                          echo "<td align='center'>".strtoupper($row->nama)."</td>";
                          //echo "<td align='center'>".strtoupper($row->proses)."</td>";
                          echo "<td align='center'>".strtoupper($row->kelompok)."</td>";
                          echo "<td align='center'>".strtoupper($row->kondisi_nm)."</td>";
                          echo "<td align='center'>".strtoupper($row->tingkat)."</td>";
                          echo "<td align='center'>".strtoupper($row->region)."</td>";
                          echo "<td align='center'>".$CI->p_c->tgl_indo($row->tanggal_daftar)."</td>";
                          echo "<td align='center'>".($CI->p_c->cekaktif($row->abk))."</td>";
                          //echo "<td align='center'>".strtoupper($row->tokenonline)."</td>";
                          echo "<td align='center'>".$CI->p_c->cekaktif($row->aktif)."</td>";
                          echo "<td align='center'>";
                          if($row->keu_form==1){
                              echo "<a href=javascript:void(window.open('".site_url('keu_administrasi_calon_rev/set_keucalon/1/'.$row->replid)."')) class='btn btn-xs btn-danger' >Reset</a> ";
                          }else{
                            echo $CI->p_c->cekaktif($row->keu_form);
                          }

                          echo "</td>";
                          echo "<td align='center'>";
                          if($row->keu_assessment==1){
                            echo "<a href=javascript:void(window.open('".site_url('keu_administrasi_calon_rev/set_keucalon/2/'.$row->replid)."')) class='btn btn-xs btn-danger' >Reset</a> ";
                          }else{
                            echo $CI->p_c->cekaktif($row->keu_assessment);
                          }
                          echo "</td>";
                          echo "<td align='center'>";
                          if($row->keu_up==1){
                            echo "<a href=javascript:void(window.open('".site_url('keu_administrasi_calon_rev/set_keucalon/3/'.$row->replid)."')) class='btn btn-xs btn-danger' >Reset</a> ";
                          }else{
                            echo $CI->p_c->cekaktif($row->keu_up);
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
