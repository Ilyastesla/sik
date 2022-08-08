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
                <section class="content-header table-responsive">
                    <h1>
                        <?php echo $form ?> 
                        <small><?php echo $stat ?></small>
                    </h1>
                </section>


                <!-- Main content -->
                <section class="content">
                	<?php
	                	if (isset($error)){
                	?>
                	<div class="alert alert-danger alert-dismissable">
                                        <i class="fa fa-ban"></i>
                                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                        <b>Peringatan!</b> <?php echo $error; ?>.
                    </div>
	                <?php
	                }
	                	$attributes = array('class' => 'form-horizontal form-validate', 'id' => 'form', 'method' => 'POST', 'novalidate'=>'novalidate');
	                	echo form_open($action,$attributes);
		                foreach((array)$input as $row) {
		                	?>
		                	<label class="control-label" for="minlengthfield"><?php echo $row[0];?></label>
		                	<div class="control-group" align="left">
								<div class="controls">
									<?php echo $row[1]($row[2]);?>
									<?php //echo  <p id="message"></p> ?> 
								</div>				 
							</div>
		                	<?php
						}
						form_close()
	                ?>	
				</section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
    </body>
</html>
