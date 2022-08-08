<!DOCTYPE html>
<html>
    <?php $this->load->view('header') ?>
    <script type="text/javascript">

      $(function(){
        $("#captchaword").change(function(){
          var value=$(this).val();
          if(value!='<?php echo $this->session->userdata('captchalogin');?>'){
            $(this).val('');
            alert("Ketik Captcha Sesuai Dengan Gambar Yang Tersedia");
          }
        });
      });
    </script>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas">
            <?php $this->load->view('menu_v') ?>
            </aside>
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
									<h1>
											<?php echo $form ?>
											<small><?php echo $form_small ?></small>
									</h1>
                    <!--
                    <ol class="breadcrumb">
                        <li><a href="main"><i class="fa fa-dashboard"></i> Home</h4><hr/>
                        <li><a href="#">Tables</h4><hr/>
                        <li class="active">Data tables</li>
                    </ol>
                    -->
                </section>

                <!-- Main content -->
                <section class="content">
									<?php if ($this->session->flashdata('errorlogin')<>"") { ?>
						      <div class="alert alert-danger alert-dismissable" align="left">
						              <i class="fa fa-ban"></i>
						              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
						              <b>Alert!</b> <?php echo $this->session->flashdata('errorlogin') ?>..
						          </div>
						      <?php } ?>
                    <?php $CI =& get_instance();?>
	                <?php
		                $attributes = array('class' => 'form-horizontal form-validate', 'id' => 'form', 'method' => 'POST', 'novalidate'=>'novalidate');
	                	echo form_open($action,$attributes);
	                ?>
	                <table width="100%" border="0">
									<tr>
			            <th align="left">
	                		<label class="control-label" for="minlengthfield">No. KTP</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		echo form_input(array('class' => '', 'id' => 'username','name'=>'username','value'=>"",'data-rule-required'=>'true' ,'data-rule-maxlength'=>'16', 'data-rule-minlength'=>'16' ,'placeholder'=>'Masukkan 16 Karakter'));
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th></tr>
									<tr>
			            <th align="left">

	                		<label class="control-label" for="minlengthfield">Captcha</label>
	                		<div class="control-group">
								<div class="controls">:
                        <?php
                              //echo $this->session->userdata('captchalogin');
                              echo $captcha;
                        ?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th></tr>
									<tr>
			            <th align="left">
	                		<label class="control-label" for="minlengthfield">Teks Captcha</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		echo form_input(array('class' => '', 'id' => 'captchaword','name'=>'captchaword','value'=>"",'data-rule-required'=>'false' ,'data-rule-maxlength'=>'8', 'data-rule-minlength'=>'8' ,'placeholder'=>'Masukkan 16 Karakter'));
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th></tr>
	                </table>
                  <br/>
                  <table>
                    <tr>
                        <td align="left">
                          <button class='btn btn-primary'>Masuk</button>
                        </td>
                    </tr>
                  </table>
                    <?php echo form_close(); ?>
									</section><!-- /.content -->
						</aside><!-- /.right-side -->
					</div><!-- ./wrapper -->
</body>
</html>
