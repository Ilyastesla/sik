<html>
<head>
	<!--META-->
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title><?php echo $this->config->item('app_name')?></title>
	<link rel="shortcut icon" href="<?php echo base_url(); ?>images/appicon.png" type="image/x-icon">

	<!--STYLESHEETS-->
	<link href="<?php echo base_url(); ?>/css/stylelogin.css" rel="stylesheet" type="text/css" />

	<!--SCRIPTS-->
	<script type="text/javascript" src="<?php echo base_url(); ?>/js/jquery.min.js"></script>
	<!--Slider-in icons-->
	<script type="text/javascript">
	$(document).ready(function() {
		$(".username").focus(function() {
			$(".user-icon").css("left","-48px");
		});
		$(".username").blur(function() {
			$(".user-icon").css("left","0px");
		});

		$(".password").focus(function() {
			$(".pass-icon").css("left","-48px");
		});
		$(".password").blur(function() {
			$(".pass-icon").css("left","0px");
		});
	});
	</script>
</head>
<body>
<!--WRAPPER-->
<div id="wrapper">

	<!--SLIDE-IN ICONS-->
    <div class="user-icon"></div>
    <div class="pass-icon"></div>
    <!--END SLIDE-IN ICONS-->

<!--LOGIN FORM-->
	<?php
		$attributes = array('class' => 'login-form', 'id' => 'login-form','name' => 'login-form');
		echo form_open('user_authentication/user_login_process',$attributes);
	?>

	<!--HEADER-->
    <div class="header">
    	<h1>Masuk</h1>
    <!--DESCRIPTION--><span><?php echo $this->config->item('app_name')?>
			 <!-- <br/> Ver. <?php echo $this->config->item('version')?> -->
    	<br/><?php echo $this->config->item('company')?></span>
    </div>
    <!--END HEADER-->

	<!--CONTENT-->

    <div class="content" align='center'>
		<input name="username" type="text" placeholder="Isi dengan NIK kamu" class="input username" value=""/>
		<input name="password" type="password" placeholder="Isi Kata Sandi" class="input password " value=""/>
    <?php
	/*
		$arridcompany='data-rule-required=true class="input password"';
		echo form_dropdown('idcompany',$idcompany_opt,'',$arridcompany);
    echo "<div class='error_msg'><br/>";
    echo $this->session->flashdata('error_message');
    echo validation_errors();
    echo "</div>";
	*/
    ?>



    </div>
    <!--END CONTENT-->

    <!--FOOTER-->
    <div class="footer">
    <!--LOGIN BUTTON--><input type="submit" name="submit" value="Login" class="button" /><!--END LOGIN BUTTON-->

    <!--REGISTER BUTTON <input type="submit" name="submit" value="Register" class="register" /> END REGISTER BUTTON-->
    </div>
    <!--END FOOTER-->

<?php echo form_close(); ?>
<!--END LOGIN FORM-->

</div>
<!--END WRAPPER-->

<!--GRADIENT--><div class="gradient"></div><!--END GRADIENT-->

</body>
</html>
