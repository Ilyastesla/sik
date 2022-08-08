<!DOCTYPE html>
<html>
<script language="javascript">
function cetakpegawai() {
	newWindow('pegawai/printpegawai/0', 'cetakpegawai','900','800','resizable=1,scrollbars=1,status=0,toolbar=0')
}
function cetakpegawaiexcel() {
	newWindow('pegawai/printpegawai/1', 'cetakpegawai','900','800','resizable=1,scrollbars=1,status=0,toolbar=0')
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
                <!-- Content Header (Page header) -->
                <section class="content-header table-responsive">
                <script>
                      function submitform(excel){
                        const form_x = document.getElementById("form"); 
                        form_x.action="<?php echo site_url('pegawai/printpegawai/');?>/"+excel;
                        form_x.target="_blank";
                        form_x.submit();
                      }
                    </script>
                    <h1>
                        <?php echo $form ?>
                        <small>List Data</small>
                    </h1>
                    <ol class="breadcrumb">
                      <?php if($show_table<>NULL){ ?>
                        <li><a href="JavaScript:submitform(0)"><i class="fa fa-file-text"></i>Cetak</a></li>
                        <li><a href="JavaScript:submitform(1)"><i class="fa fa-file-excel-o"></i>Excel</a></li>
                        <?php } ?>
                        <li><a href="javascript:void(window.open('<?php echo site_url('pegawai/tambah'); ?>'))" ><i class="fa fa-plus-square"></i> Tambah</a></li>
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
                                    <label class="control-label" for="minlengthfield">Status</label>
                                    <div class="control-group">
                                      <div class="controls">:
                                          <?php
                                            $arraktif='data-rule-required=false onchange=javascript:this.form.submit();';
                                            echo form_dropdown('aktif',$aktif_opt,$this->input->post('aktif'),$arraktif);
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
                                                <th>No.</th>
                                                <th>Perusahaan</th>
                                                <th>NIK</th>
                                                <th>Nama</th>
                                                <th>Alamat</th>
                                                <th>Umur</th>
                                                
																								<!--
                                                <th>Jabatan</th>
                                                
                                                <th>Awal Kontrak</th>
																								-->
																								<th>Akhir Kontrak</th>
																								<th>Sisa Kontrak (Hari)</th>
																								<!--
                                                <th>AVG Kompetensi</th>
                                                -->
                                                <th>Aktif</th>
                                                <th>Aktif System</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        	<?php
                                        	$CI =& get_instance();$no=1;
											foreach((array)$show_table as $row) {
												if ($row->sisakontrak<=31){
													$bg="style='background-color:red;'";
												}else if($row->sisakontrak<=60){
													$bg="style='background-color:blue;'";
												}else{
													$bg="";
												} 
											    echo "<tr>";
                          echo "<td align='center'>".$no++."</td>";
                          echo "<td align='center'>".strtoupper($row->companytext)."</td>";
											     echo "<td align='center'>".$row->nip."</td>";

											    echo "<td align=''>".($row->nama)
											    		."<br/>(".strtoupper($row->panggilan).")</td>";
											    echo "<td align='center'>".strtoupper($row->alamat_tinggal)
											    	  ."<br/>Telp. ".strtoupper($row->telpon)
											    	  ."<br/>HP. ".strtoupper($row->handphone)
											    	   ."<br/>Email. ".$row->email
											    	   ."</td>";
											    echo "<td align='center'>".strtoupper($row->umur)."</td>";
                          
													/*
											    echo "<td align='center'>".strtoupper($row->idjabatan)
											    			."<hr>(".strtoupper($row->iddepartemen).")"
											    			."<hr>(".strtoupper($row->idpegawai_status).")"
											    			."</td>";
											    
											    echo "<td align='center'>".strtoupper($CI->p_c->tgl_indo($row->awal_kontrak))."</td>";
													*/
													echo "<td align='center'>".strtoupper($CI->p_c->tgl_indo($row->akhir_kontrak))."</td>";
													echo "<td align='center' ".$bg.">".strtoupper($row->sisakontrak)."</td>";
													//echo "<td align='center'>".$row->avg_kompetensi."</td>";
											    echo "<td align='center'>".$CI->p_c->cekaktif($row->aktif)."</td>";
											    if ($row->replidlogin<>""){
											    	echo "<td align='center'>";
												    echo "<a href=javascript:void(window.open('".site_url('reff_user/viewuser/'.$row->replidlogin)."'))>".($CI->p_c->cekaktif($row->loginaktif))."</a>";
												    echo "</td>";
											    }else{
											    	echo "<td align='center' style='background-color:red;'>";
												    echo "TIDAK ADA";
												    echo "</td>";
											    }


											    //echo "<td align='center'>"."<a href=".site_url('pegawai/ubahaktif_p/'.$row->replid)."/".$row->aktif."/".$row->nip."><button class='btn btn-xs btn-info'>".$CI->p_c->cekaktif($row->aktif)."</button></a>&nbsp;</td>";
											    echo "<td align='center' width='150'>";
                          echo "<a href=javascript:void(window.open('".site_url('general/datapegawai/'.$row->replid)."')) class='btn btn-xs btn-info fa fa-circle-o' ></a>&nbsp;";
											    echo "<a href=javascript:void(window.open('".site_url('pegawai/ubah/'.$row->replid)."')) class='btn btn-xs btn-warning fa fa-check-square' ></a>&nbsp;";
											    //echo "<a href=".site_url('pegawai/hapus/'.$row->replid)." class='btn btn-xs btn-danger fa fa-minus-square' ></a>";
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
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
    </body>
</html>
