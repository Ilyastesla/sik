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
                        <li><a href="javascript:void(window.open('<?php echo site_url('ksw_statistik/tambah'); ?>'))" ><i class="fa fa-plus-square"></i> Tambah</a></li>

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
                                 <label class="control-label" for="minlengthfield">Lokasi Sekolah</label>
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
    			                  </tr>
                            <tr>
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
      			                  </tr>
                              <tr>
                                <th align="left">
                                  <label class="control-label" for="minlengthfield">Kelompok Siswa</label>
                                  <div class="control-group">
                                    <div class="controls">:
                                        <?php
                                          $arrkelompok_siswa='data-rule-required=false onchange=javascript:this.form.submit();';
                                          echo form_dropdown('kelompok_siswa',$kelompok_siswa_opt,$this->input->post('kelompok_siswa'),$arrkelompok_siswa);
                                        ?>
                                        <?php //echo  <p id="message"></p> ?>
                                    </div>
                                  </div>
                                 </th>
                                <th align="left">
                                    <label class="control-label" for="minlengthfield">Berdasarkan</label>
                                    <div class="control-group">
                                      <div class="controls">:
                                        <?php
                                          $arridfiltercari='data-rule-required=false onchange=javascript:this.form.submit();';
                                          echo form_dropdown('idfiltercari',$idfiltercari_opt,$this->input->post('idfiltercari'),$arridfiltercari);
                                        ?>
                                        <?php //echo  <p id="message"></p> ?>
                                      </div>
                                    </div>
                                </th>
        			                  </tr>
                                <tr>
                                  <th align="left">
                                    <label class="control-label" for="minlengthfield">Status Siswa</label>
                                    <div class="control-group">
                                      <div class="controls">:
                                          <?php
                                            $arrstatussiswa='data-rule-required=false onchange=javascript:this.form.submit();';
                                            echo form_dropdown('statussiswa',$statussiswa_opt,$this->input->post('statussiswa'),$arrstatussiswa);
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
                                              //FILTER
                                              $filter="";
                                              if ($this->input->post('idcompany')<>""){
                                        				$filter=$filter.'/'.$this->input->post('idcompany');
                                        			}else{
                                                $filter=$filter.'/000';
                                              }
                                              if ($this->input->post('iddepartemen')<>""){
                                        				$filter=$filter.'/'.$this->input->post('iddepartemen');
                                        			}else{
                                                $filter=$filter.'/000';
                                              }

                                              if ($this->input->post('idtahunajaran')<>""){
                                        				$filter=$filter.'/'.$this->input->post('idtahunajaran');
                                        			}else{
                                                $filter=$filter.'/000';
                                              }

                                              if ($this->input->post('idtingkat')<>""){
                                        				$filter=$filter.'/'.$this->input->post('idtingkat');
                                        			}else{
                                                $filter=$filter.'/000';
                                              }

                                              if ($this->input->post('kelompok_siswa')<>""){
                                        				$filter=$filter.'/'.$this->input->post('kelompok_siswa');
                                        			}else{
                                                $filter=$filter.'/000';
                                              }

                                              if ($this->input->post('statussiswa')<>""){
                                        				$filter=$filter.'/'.$this->input->post('statussiswa');
                                        			}else{
                                                $filter=$filter.'/000';
                                              }

                                              if ($this->input->post('idfiltercari')<>""){
                                        				$filter=$filter.'/'.$this->input->post('idfiltercari');
                                        			}else{
                                                $filter=$filter.'/000';
                                              }

                                              //----------------------------------------------------------------------------------------
                                              echo "<th width='50' >No</th>";
                                              if ($this->input->post('iddepartemen')<>""){
                                                echo "<th>Jenjang</th>";
                                              }
                                              if ($this->input->post('idtahunajaran')<>""){
                                                echo "<th>Tahun Ajaran</th>";
                                              }
                                              if ($this->input->post('idtingkat')<>""){
                                                echo "<th>Tingkat</th>";
                                              }
                                              /*
                                              if ($this->input->post('iddepartemen')<>""){
                                                echo "<th>Jurusan</th>";
                                              }
                                              */
                                              if ($this->input->post('kelompok_siswa')<>""){
                                                echo "<th>Kelompok Siswa</th>";
                                              }
                                              echo "<th>Variabel</th>";
                                              echo "<th>Jumlah</th>";
                                              ?>
                                          </tr>
                                        </thead>
                                        <tbody>
                                        	<?php
                                        	$CI =& get_instance();$no=1;
                                          $kapasitastotal=0;$kuotatotal=0;$jmlsiswatotal=0;$jmlsiswaabktotal=0;

											foreach((array)$show_table as $row) {
											    echo "<tr>";
											    echo "<td align='center'>".$no++."</td>";
                          if ($this->input->post('iddepartemen')<>""){
                            echo "<td align='center'>".strtoupper($row->departemen)."</td>";
                          }
                          if ($this->input->post('idtahunajaran')<>""){
                            echo "<td align='center'>".strtoupper($row->tahunajaran)."</td>";
                          }
                          if ($this->input->post('idtingkat')<>""){
                            echo "<td align='center'>".($row->tingkattext)."</td>";
                          }
                          /*
                          if ($this->input->post('iddepartemen')<>""){
                            echo "<td align='center'>".($row->jurusantext)."</td>";
                          }
                          */
                          if ($this->input->post('kelompok_siswa')<>""){
                            echo "<td align='center'>".($row->kelompok_siswatext)."</td>";
                          }
                          echo "";
                          echo "<td align='center'>".($row->filtercari)."</td>";
                          $idfilter='000';
                          if($row->idfilter<>NULL){
                            $idfilter=$row->idfilter;
                          }
                          echo "<td align='center'><a href=javascript:void(window.open('".site_url('ksw_statistik/view'.$filter.'/'.$idfilter)."')) >".strtoupper($row->jumlah)."</a></td>";
                          
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

  <!-- Content Header (Page header) -->
  <section class="content-header table-responsive">
      <h1>
          <?php echo $form ?>
          <small>List Data</small>
      </h1>

      <ol class="breadcrumb">
          <!--
          <li><a href="javascript:void(window.open('<?php echo site_url('ksw_statistik/tambah'); ?>'))" ><i class="fa fa-plus-square"></i> Tambah</a></li>

          <li><a href="#"><i class="fa fa-file-text"></i>Cetak</a></li>
          <li><a href="#"><i class="fa fa-file-excel-o"></i>Excel</a></li>
          -->
      </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <table id="example1" class="table table-bordered table-striped">
          <tr>
            <th width='50px'>No.</th>
            <th width='100px'>NIS</th>
            <th>Nama</th>
            <th width='50px'>Aktif</th>
            <th><?php echo $filtertext ?></th>
          </tr>
          <?php
          $no=1;
          foreach((array)$datasiswa as $rowsiswa) {
              echo "<tr>";
              echo "<td align='center'>".$no++."</td>";
              echo "<td align='center'>";
              echo "<a href=javascript:void(window.open('".site_url('general/datasiswa/'.$rowsiswa->replid)."')) >".$rowsiswa->nis."</a>";
              echo "</td>";
              echo "<td align='left'>".$rowsiswa->nama."</td>";
              echo "<td align='center'>".$CI->p_c->cekaktif($rowsiswa->aktif)."</td>";
              echo "<td align='left'>".$rowsiswa->filtercari."</td>";
              echo "</tr>";
          }
          ?>
    </table>
    <table>
      <tr>
        <td>
          <?php
          echo "<a href='javascript:window.close()' class='btn btn-success'>Kembali</a>&nbsp;&nbsp;";
          ?>
        </td>
      </tr>
    </table>
</section><!-- /.content -->
<!-------------------------------------------------------------------------------------------------------------------------------------->
<?php } ?>
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
    </body>
</html>
