<!DOCTYPE html>
    <head>
        <meta charset="UTF-8">
        <title><?php echo $this->config->item('app_name')?> | <?php echo $this->config->item('version'); ?></title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <link rel="shortcut icon" href="<?php echo base_url(); ?>images/appicon.png" type="image/x-icon">
        <link href="<?php echo base_url(); ?>css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="<?php echo base_url(); ?>css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- DATA TABLES -->
        <link href="<?php echo base_url(); ?>css/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="<?php echo base_url(); ?>css/AdminLTE.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->

        <script src="<?php echo base_url(); ?>js/jquery2.min.js"></script>
        <script src="<?php echo base_url(); ?>js/bootstrap.min.js" type="text/javascript"></script>

        <!-- AUTOCOMPLETE -->
        <link href="<?php echo base_url(); ?>css/jquery.autocomplete.css" rel="stylesheet" type="text/css" />
        <script src="<?php echo base_url(); ?>js/jquery.autocomplete.js"></script>

        <!-- DATA TABES SCRIPT -->
        <script src="<?php echo base_url(); ?>js/jquery.dataTables.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>js/dataTables.bootstrap.js" type="text/javascript"></script>

        <!-- AdminLTE App -->
        <script src="<?php echo base_url(); ?>js/app.js" type="text/javascript"></script>


        <!--FORM-->
        <script src="<?php echo base_url(); ?>js/form/jquery.validate.min.js"></script>
        <script src="<?php echo base_url(); ?>js/form/additional-methods.min.js"></script>
        <script src="<?php echo base_url(); ?>js/form/eakroko.min.js"></script>


        <!--CKEDITOR-->
        <script src="<?php echo base_url(); ?>js/ckeditor/ckeditor.js"></script>

        <!--DATE-->
        <link href="<?php echo base_url(); ?>css/datepicker.css" rel="stylesheet" type="text/css" />
        <script src="<?php echo base_url(); ?>js/bootstrap-datepicker.js"></script>

        <!-- date-range-picker -->
        <link href="<?php echo base_url(); ?>css/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
        <script src="<?php echo base_url(); ?>js/daterangepicker.js" type="text/javascript"></script>


        <!--TIME
        <link href="<?php echo base_url(); ?>css/timepicker/bootstrap-timepicker.min.css" rel="stylesheet"/>
        -->

        <script type="text/javascript">
            $(function() {
                $("#example1").dataTable({
                	"bPaginate": true,
                    "bLengthChange": true,
                    "bFilter": true,
                    "bSort": true,
                    "bInfo": true,
                    "bAutoWidth": false
                	});

                 $("#example2").dataTable({
                	"bPaginate": true,
                    "bLengthChange": true,
                    "bFilter": true,
                    "bSort": true,
                    "bInfo": true,
                    "bAutoWidth": false
                	});

                 $("#example3").dataTable({
                	"bPaginate": true,
                    "bLengthChange": true,
                    "bFilter": true,
                    "bSort": true,
                    "bInfo": true,
                    "bAutoWidth": false
                	});
                 $("#example4").dataTable({
                	"bPaginate": true,
                    "bLengthChange": true,
                    "bFilter": true,
                    "bSort": true,
                    "bInfo": true,
                    "bAutoWidth": false
                	});
                 $("#example5").dataTable({
                	"bPaginate": true,
                    "bLengthChange": true,
                    "bFilter": true,
                    "bSort": true,
                    "bInfo": true,
                    "bAutoWidth": false
                	});


                $("#example6").dataTable({
                	"bPaginate": true,
                    "bLengthChange": true,
                    "bFilter": true,
                    "bSort": true,
                    "bInfo": true,
                    "bAutoWidth": false
                	});

                 $("#example7").dataTable({
                	"bPaginate": true,
                    "bLengthChange": true,
                    "bFilter": true,
                    "bSort": true,
                    "bInfo": true,
                    "bAutoWidth": false
                	});

                 $("#example8").dataTable({
                	"bPaginate": true,
                    "bLengthChange": true,
                    "bFilter": true,
                    "bSort": true,
                    "bInfo": true,
                    "bAutoWidth": false
                	});
                 $("#example9").dataTable({
                	"bPaginate": true,
                    "bLengthChange": true,
                    "bFilter": true,
                    "bSort": true,
                    "bInfo": true,
                    "bAutoWidth": false
                	});
                 $("#example10").dataTable({
                	"bPaginate": true,
                    "bLengthChange": true,
                    "bFilter": true,
                    "bSort": true,
                    "bInfo": true,
                    "bAutoWidth": false
                	});
                $("#example11").dataTable({
                	"bPaginate": true,
                    "bLengthChange": true,
                    "bFilter": true,
                    "bSort": true,
                    "bInfo": true,
                    "bAutoWidth": false
                	});
                $("#example12").dataTable({
                	"bPaginate": true,
                    "bLengthChange": true,
                    "bFilter": true,
                    "bSort": true,
                    "bInfo": true,
                    "bAutoWidth": false
                	});


                $('#examplea').dataTable({
                    "bPaginate": true,
                    "bLengthChange": false,
                    "bFilter": false,
                    "bSort": true,
                    "bInfo": true,
                    "bAutoWidth": false
                });
            });



            if (top.location != location) {
				top.location.href = document.location.href ;
			}
			$(function(){
				window.prettyPrint && prettyPrint();
				$('#dp1').datepicker({
					format: 'dd-mm-yyyy'
					});
				$('#dp2').datepicker({
					format: 'dd-mm-yyyy'
					});
				$('#dp3').datepicker({
					format: 'dd-mm-yyyy'
					});
				$('#dp4').datepicker({
					format: 'dd-mm-yyyy'
					});
				$('#dp5').datepicker({
					format: 'dd-mm-yyyy'
					});
				$('#reservationtime').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A'});

			});

			function newWindow(mypage,myname,w,h,features)
			{
				  var winl = (screen.width-w)/2;
				  var wint = (screen.height-h)/2;
				  if (winl < 0) winl = 0;
				  if (wint < 0) wint = 0;
				  var settings = 'height=' + h + ',';
				  settings += 'width=' + w + ',';
				  settings += 'top=' + wint + ',';
				  settings += 'left=' + winl + ',';
				  settings += features;
				  win = window.open(mypage,myname,settings);
				  win.window.focus();
			}

			function selectallx(source,sourceall){
			  var allCheckboxes = document.getElementsByTagName('input');
			  var selectall=document.getElementById(sourceall);
			  for (var i = 0; i < allCheckboxes.length; i++){
			    var curCheckbox = allCheckboxes[i];
			    if (curCheckbox.id == source){
			      curCheckbox.checked = selectall.checked;
			    }
			  }
			}

      function inputall(sourceid,sourceallid){
			  var alltextbox = document.getElementsByTagName('input');
			  var sourcevalue=document.getElementById(sourceid).value;
        var sourceall=document.getElementById(sourceallid);
        
        if (sourcevalue<101){
          for (var i = 0; i < alltextbox.length; i++){
            var curinput = alltextbox[i];
            if (curinput.id == sourceid){
              curinput.value = sourcevalue;
            }
          }
        }else{
          alert('Nilai tidak boleh lebih dari 100');
          document.getElementById(sourceid).value=0;
          document.getElementById(sourceid).focus();
        }
			}

      function maxvalue(sourcename){
			  var sourcevalue=document.getElementsByName(sourcename)[0].value;
        if (sourcevalue>100){
          alert('Nilai tidak boleh lebih dari 100');
          document.getElementsByName(sourcename)[0].value=0;
          document.getElementsByName(sourcename)[0].focus();
        }
			}

        </script>

        <!--chat-->
        <link type="text/css" rel="stylesheet" media="all" href="<?php echo base_url(); ?>css/chat/chat.css" />
        <link type="text/css" rel="stylesheet" media="all" href="<?php echo base_url(); ?>css/chat/screen.css" />
        <script type="text/javascript" src="<?php echo base_url(); ?>js/chat/chat.js"></script>

    </head>


    <body class="skin-blue">
        <header class="header">
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <?php if($this->session->userdata('idpegawai')<>""){?>
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <a href="<?php echo base_url(); ?>" class="logo">
                    <!-- Add the class icon to your logo image or logo icon to add the margining -->
                    <?php
                      //echo $this->config->item('app_name2')." ".$this->config->item('version');
                      echo $this->config->item('app_name2')." ".$this->config->item('company');
                      //echo $this->session->userdata('companytext')

                      ?>
                </a>
                <div class="navbar-right">
                    <ul class="nav navbar-nav">
                        <!-- User Account: style can be found in dropdown.less -->
                        <?php
                        $CI =& get_instance();
                        if($CI->dbx->checkpage($this->session->userdata('role_id'),'online_kronologis')==true){
                        ?>
                        <script>
                          $( document ).ready(function() {
                            $.ajax({
                              type:"POST",
                              cache: false,
                              url: "<?php echo site_url('combobox/ambil_data') ?>",
                              data:{modul:'notifkronologiscount'},
                              success: function(respond){
                                $("#countnotif").text(respond);
                              }
                            });

                            var refreshId = setInterval(function() {
                              $.ajax({
                                type:"POST",
                                cache: false,
                                url: "<?php echo site_url('combobox/ambil_data') ?>",
                                data:{modul:'notifkronologiscount'},
                                success: function(respond){
                                  $("#countnotif").text(respond);
                                }
                              });
                            }, 7000);
                            $.ajaxSetup({ cache: false });
                          });
                          $(function(){
                            $('#notifclick').on('click', function () {
                              $.ajax({
                                type:"POST",
                                cache: false,
                                url: "<?php echo site_url('combobox/ambil_data') ?>",
                                data:{modul:'notifkronologis'},
                                success: function(respond){
                                  $("#notifall").append(respond);
                                }
                              });
                            });
                          });
                          </script>
                        <li class="dropdown notifications-menu">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false" id="notifclick">
                                <i class='glyphicon glyphicon-bell'></i>
                                <span class="badge bg-yellow" id="countnotif"></span>
                              </a>
                              <ul class="dropdown-menu">
                                <li>
                                  <!-- inner menu: contains the actual data -->
                                  <ul class="menu" id="notifall">
                                  </ul>
                                </li>
                                <li class="footer"><a href="<?php echo site_url('online_kronologis') ?>">Lihat Semua</a></li>
                              </ul>
                        </li>
                      <?php } ?>

                      <li class="dropdown user user-menu">
	                       	<a href="<?php echo site_url("hrm_codeofconduct") ?>">
	                            <i class='glyphicon glyphicon-book'></i>Kebijakan
	                        </a>
	                      </li>
                        <li class="dropdown user user-menu">
	                       	<a href="<?php echo site_url("manualbook") ?>">
	                            <i class='glyphicon glyphicon-film'></i> Manual Book
	                        </a>
	                      </li>
                        <!--
                        <li class="dropdown user user-menu">
	                       	<a href="<?php echo site_url("main/menu/main/1") ?>">
	                            <i class='glyphicon glyphicon-home'></i>
	                        </a>
	                      </li>-->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <!--<i class="glyphicon glyphicon-user"></i>-->
                                <?php
                                if ($this->session->userdata('fotodisplay')<>""){
                                ?>
                                  <img src="<?php echo base_url(); ?>uploads/fotodisplay/<?php echo $this->session->userdata('fotodisplay') ?>" class="user-image" alt="User Image">
                                <?php }else{?>
                                  <img src="<?php echo base_url(); ?>images/blankfotodisplay.png" class="user-image" alt="User Image" />
                                <?php } ?>

                                <span><?php echo $this->session->userdata('nama')." [".$this->session->userdata('nip')."]";?> <i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header bg-light-blue">
                                  	<?php
  	                                if ($this->session->userdata('fotodisplay')<>""){
                                  	?>
                                    	<img src="<?php echo base_url(); ?>uploads/fotodisplay/<?php echo $this->session->userdata('fotodisplay') ?>" class="img-circle" alt="User Image"  />
                                    <?php }else{?>
                                    	<img src="<?php echo base_url(); ?>images/blankfotodisplay.png" class="img-circle" alt="User Image" />
                                    <?php } ?>
                                    <p>
                                        <?php echo $this->session->userdata('nama')."<br/>".$this->session->userdata('nip')."";?><br/>
                                        <?php //echo $this->session->userdata('role');?>
                                        <!-- <small>Member since Nov. 2012</small> -->
                                    </p>
                                </li>
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="javascript:void(window.open('<?php echo site_url('general/datapegawai/'.$this->session->userdata('idpegawai'));?>'))" class="btn btn-default btn-flat">Profil</a>
                                    </div>
                                    <div class="pull-right">
                                        <a class="btn btn-default btn-flat" href="<?php echo site_url('user_authentication/logout')?>">Keluar</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <?php } ?>
            </nav>

        </header>
