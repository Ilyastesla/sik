<html>
<head>
	<!--META-->
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<title><?php echo $this->config->item('app_name')?></title>
	<link rel="shortcut icon" href="<?php echo base_url(); ?>images/appicon.png" type="image/x-icon">

	<!--STYLESHEETS-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<link href="<?php echo base_url(); ?>/css/stylelogin.css" rel="stylesheet" type="text/css" />
	<!-- Ionicons -->
	<link href="<?php echo base_url(); ?>css/ionicons.min.css" rel="stylesheet" type="text/css" />
	<!--SCRIPTS-->
	<script type="text/javascript" src="<?php echo base_url(); ?>/js/jquery.min.js"></script>
	<!--Slider-in icons-->

</head>
<body id="page-top">
<div class="limiter">
				<div class="container-login100">
					<div class="login100-more">
						<div class="signup-img-content" >
							<img src="<?php echo site_url("../images/logopt.png") ?>" >
                            <h4><?php echo $this->config->item('app_name')?></h4>
                            <!--
                            <p>Pendaftaran masih dibuka!</p>-->
                        </div>
					</div>

					<div class="wrap-login100 p-l-50 p-r-50 p-t-72 p-b-50">
						<?php
							$attributes = array('class' => 'login100-form form-validate', 'id' => 'form', 'method' => 'POST');
							echo form_open($action,$attributes);
						?>
							<span class="login100-form-title p-b-59">
								<?php
								echo strtoupper($form)." ".strtoupper($this->config->item('app_name2'))."<br/>".strtoupper($this->config->item('company'));
								echo "<br/><h4><a href='".site_url('')."' class=''>".$this->config->item('app_name')."</a></h4>";
								?>
							</span>
							<?php if ($this->session->flashdata('error_message')<>"") { ?>
							<span class="label-input100 labelerror">Perhatian!</b> <?php echo $this->session->flashdata('error_message') ?>..</span>
							<?php } ?>
							<div class="wrap-input100 borderbottom validate-input" data-validate="Name is required">
								<span class="label-input100">NIK</span>
									<div class="controls">
                                        <?php
                                            echo form_input(array('class' => 'input100', 'id' => 'username','name'=>'username','value'=>"",'data-rule-required'=>'true' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'5' ,'placeholder'=>'Isi dengan NIK kamu','autocomplete'=>'off'));
                                        ?><span class="focus-input100"></span>
							        </div>
                            </div>
                            <div class="wrap-input100 borderbottom validate-input" data-validate="Name is required">
								<span class="label-input100">Kata Sandi</span>
									<div class="controls">
                                        <?php
                                            echo form_input(array('type'=>"password",'class' => 'input100', 'id' => 'password','name'=>'password','value'=>"",'data-rule-required'=>'true' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'5' ,'placeholder'=>'Isi Kata Sandi','autocomplete'=>'off'));
                                        ?><span class="focus-input100"></span>
							        </div>
                            </div>

							<div class="container-login100-form-btn ">
								<div class="wrap-login100-form-btn">
									<button class="form-btn btn-default">
										Masuk
									</button>
								</div>

							</div>
						</form>
					</div>
				</div>
			</div>

</body>
</html>
