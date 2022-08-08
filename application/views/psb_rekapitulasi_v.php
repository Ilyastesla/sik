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
  <style>
  .hrbox{
    margin-top: 5px !important;
    margin-bottom: 5px !important;
  }
  </style>
                <!-- Content Header (Page header) -->
                <section class="content-header table-responsive">
                    <h1>
                        <?php echo $form ?>
                        <small>List Data</small>
                    </h1>

                    <ol class="breadcrumb">
                      <!--
                        <li><a href="javascript:void(window.open('<?php echo site_url('psb_rekapitulasi/tambah'); ?>'))" ><i class="fa fa-plus-square"></i> Tambah</a></li>

                        <li><a href="#"><i class="fa fa-file-text"></i>Cetak</a></li>
                        <li><a href="#"><i class="fa fa-file-excel-o"></i>Excel</a></li>
                        -->
                    </ol>
                </section>
                <!-- Main content -->
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
          						                		$arridunitbisnis='data-rule-required=true  onchange=javascript:this.form.submit();';
          						                		echo form_dropdown('idunitbisnis',$idunitbisnis_opt,$this->input->post('idunitbisnis'),$arridunitbisnis);
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
                <section class="content">
                  <h4>Tamu Belum Proses</h4>
                  <div class="row">
                    <?php
                    foreach((array)$tamublmproses as $rowjtbp) {
                      ?>
                      <div class="col-lg-3 col-xs-6 col-xs-12">
                            <div class="info-box">
                              <span class="info-box-icon bg-aqua">
                                <span class="info-box-text"><b><?php echo $rowjtbp->tahun?><b></span>
                              </span>

                              <div class="info-box-content">
                                <span class="info-box-text"><?php echo $rowjtbp->departemen?></span><hr class='hrbox' />
                                <span class="info-box-number"><?php echo $rowjtbp->jml?></span>
                              </div>
                            </div>
                      </div>
                      <?php
                    }
                    ?>
                  </div><br/>
                  <h4>CPD Belum Membayar Uang Pangkal</h4>
                  <div class="row">
                    <?php
                    foreach((array)$cpdblmdp as $rowjtbdp) {
                      ?>
                      <div class="col-lg-3 col-xs-6 col-xs-12">
                            <div class="info-box">
                              <span class="info-box-icon bg-red">
                                <span class="info-box-text"><b><?php echo $rowjtbdp->tahun?><b></span>
                              </span>

                              <div class="info-box-content">
                                <span class="info-box-text"><?php echo $rowjtbdp->departemen?></span><hr class='hrbox' />
                                <span class="info-box-number"><?php echo $rowjtbdp->jml?></span>
                              </div>
                            </div>
                      </div>
                      <?php
                    }
                    ?>
                  </div><br/>
                  <h4>CPD Sudah Membayar Uang Pangkal</h4>
                  <div class="row">
                    <?php
                    foreach((array)$cpddp as $rowjtdp) {
                      ?>
                      <div class="col-lg-3 col-xs-6 col-xs-12">
                            <div class="info-box">
                              <span class="info-box-icon bg-green">
                                <span class="info-box-text"><b><?php echo $rowjtdp->tahun?><b></span>
                              </span>

                              <div class="info-box-content">
                                <span class="info-box-text"><?php echo $rowjtdp->departemen?></span><hr class='hrbox' />
                                <span class="info-box-number"><?php echo $rowjtdp->jml?></span>
                              </div>
                            </div>
                      </div>
                      <?php
                    }
                    ?>
                  </div><br/>
                  <h4>CPD Sudah Menjadi Peserta Didik</h4>
                  <div class="row">
                    <?php
                    foreach((array)$cpdsiswa as $rowcpdiv) {
                      ?>
                      <div class="col-lg-3 col-xs-6 col-xs-12">
                            <div class="info-box">
                              <span class="info-box-icon bg-yellow">
                                <span class="info-box-text"><b><?php echo $rowcpdiv->tahun?><b></span>
                              </span>

                              <div class="info-box-content">
                                <span class="info-box-text"><?php echo $rowcpdiv->departemen?></span><hr class='hrbox' />
                                <span class="info-box-number"><?php echo $rowcpdiv->jml?></span>
                              </div>
                            </div>
                      </div>
                      <?php
                    }
                    ?>
                  </div><br/>
              </section><!-- /.content -->
<!-------------------------------------------------------------------------------------------------------------------------------------->
<?php } ?>
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
    </body>
</html>
