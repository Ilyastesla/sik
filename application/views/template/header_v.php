<?php
$CI =& get_instance();
if($this->config->item('maintenance')==1){
   redirect('/main/maintenance');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo $this->config->item('app_name')?> | <?php echo $this->config->item('version'); ?></title>
  <link rel="shortcut icon" href="<?php echo base_url(); ?>images/appicon.png" type="image/x-icon">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

  <!-- REQUIRED SCRIPTS -->

  <!-- jQuery -->
  <script src="<?php echo base_url(); ?>public/js/jquery.min.js"></script>
  <!-- AdminLTE -->
  <script src="<?php echo base_url(); ?>public/js/adminlte.js"></script>

  
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>fonts/font-awesome-4.7.0/css/font-awesome.min.css">
  <!-- IonIcons -->
  <link href="<?php echo base_url(); ?>css/ionicons.min.css" rel="stylesheet" type="text/css" />
  <!-- Theme style  -->
  <link href="<?php echo base_url(); ?>public/css/adminlte.min.css" rel="stylesheet" type="text/css" />
  
  <link href="<?php echo base_url(); ?>public/css/new.css" rel="stylesheet" type="text/css" />
</head>
<!--
`body` tag options:

  Apply one or more of the following classes to to the body tag
  to get the desired effect

  * sidebar-collapse
  * sidebar-mini
-->
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fa fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="index3.html" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    

    <!-- Sidebar -->
    <div class="sidebar">

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <?php echo $this->menu->build_menu_new()?>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">