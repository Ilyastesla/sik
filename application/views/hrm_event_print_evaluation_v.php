<?php
$CI =& get_instance();
?>
<html>
<title><?php echo $form.' ['.$form_small.']'?></title>
<script src="<?php echo base_url(); ?>js/jquery2.min.js"></script>
<script src="<?php echo base_url(); ?>js/bootstrap.min.js" type="text/javascript"></script>

<link href="<?php echo base_url(); ?>css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<script src="<?php echo base_url(); ?>js/morris/morris.min.js" type="text/javascript"></script>
<link href="<?php echo base_url(); ?>js/morris/morris.css" rel="stylesheet" type="text/css" />
<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>

<style>
	@page {
		  size: A4;
		  width:210mm;
		  height:297mm;
		  margin-left: 0;
			margin-right: 0;
			margin-top: default;
			margin-bottom: 100px;
		}
	table,h4 {
		width: 85% !important;
	}
  th{
    text-align: center;
  }
	font{
		font-family:'Source Sans Pro', sans-serif;
		font-size:<?php echo $isi->besarfont?>pt;
	}
	@media print {
        .breaktable {
        	page-break-inside:avoid !important;
		    	page-break-after: auto;
		  	}
				.lpd thead {display: table-header-group;}
				.lpd {
					page-break-inside:avoid !important;
					page-break-after: auto;
				}
     }
</style>
<body>
<center >
  <section class="content">
  <img src="<?php echo base_url(); ?>images/logo_all.png" width="190" />
  <br/><br/>
<!--------------------------------------------------------------------------------------------------------------------------->
<?php if($view=='detailpegawai'){ ?>
        <h4 align="left">Evaluasi Pelatihan</h4>
          <table style="border-collapse:collapse" border="1" cellpadding="10" cellspacing="20">
          <thead>
              <tr>
                  <th width="50" >No.</th>
                  <!-- <th>Peruntukan</th> -->
                  <th width="170">Head</th>
                  <th>Evaluasi Pelatihan</th>
                  <th width="100">Skor Target</th>
                  <th width="170">Skor</th>
              </tr>
          </thead>
          <tbody>
            <?php
                    $CI =& get_instance();
                    $no=1;
										$graph_pemateri="";$avgevalpemateri=0;$nohit=0;
                    foreach((array)$hrm_event_evaluation as $roweep) {
		                    echo "<tr>";
		                    echo "<td align='center' valign='top'>".$no++."</td>";
		                    //echo "<td align='left'>".$roweep->type."</td>";
		                    echo "<td align='left' valign='top'>".$roweep->head."</td>";
		                    echo "<td align='left' valign='top'>".$roweep->hrm_event_evaluation."</td>";
		                    echo "<td align='center' valign='top'>".$roweep->target_skor."</td>";
												if($roweep->skor<>0){
														echo "<td align='center' valign='top'>".$roweep->skor."</td>";
												}else{
														echo "<td align='left' valign='top'>".$roweep->deskripsinilai."</td>";
												}

		                    echo "</tr>";
                    }
                ?>

              </tbody>
                </table>
<?php } elseif($view=='detailevaluation'){ ?>
	<h4 align="left">Evaluasi Pelatihan</h4>
		<table style="border-collapse:collapse" border="1" cellpadding="10" cellspacing="20">
		<thead>
				<tr>
						<th width="50" >No.</th>
						<!-- <th>Peruntukan</th> -->
						<th width="170">Evaluasi</th>
						<th>Peserta</th>
						<th width="100">Skor Target</th>
						<th width="170">Skor</th>
				</tr>
		</thead>
		<tbody>
			<?php
							$CI =& get_instance();
							$no=1;
							$graph_pemateri="";$avgevalpemateri=0;$nohit=0;
							foreach((array)$hrm_event_evaluation as $roweep) {
									echo "<tr>";
									echo "<td align='center' valign='top'>".$no++."</td>";
									//echo "<td align='left'>".$roweep->type."</td>";
									echo "<td align='left' valign='top'>".$roweep->hrm_event_evaluation."</td>";
									echo "<td align='left' valign='top'>".$CI->dbx->getpegawai($roweep->idpegawai)."</td>";
									echo "<td align='center' valign='top'>".$roweep->target_skor."</td>";
									if($roweep->skor<>0){
											echo "<td align='center' valign='top'>".$roweep->skor."</td>";
									}else{
											echo "<td align='left' valign='top'>".$roweep->deskripsinilai."</td>";
									}

									echo "</tr>";
							}
					?>

				</tbody>
					</table>
<?php } ?>
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
    </body>
</center>
</html>
