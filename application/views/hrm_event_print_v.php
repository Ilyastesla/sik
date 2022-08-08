<?php
$CI =& get_instance();
?>
<html>
<title><?php echo $form.' ['.$form_small.']'?></title>
<link href="<?php echo base_url(); ?>css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<script src="<?php echo base_url(); ?>js/jquery2.min.js"></script>
<script src="<?php echo base_url(); ?>js/bootstrap.min.js" type="text/javascript"></script>

<link href="<?php echo base_url(); ?>css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<script src="<?php echo base_url(); ?>js/morris/morris.min.js" type="text/javascript"></script>
<link href="<?php echo base_url(); ?>js/morris/morris.css" rel="stylesheet" type="text/css" />
<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>

<style>
	table,h4 {
		width: 85% !important;
	}
  th{
    text-align: center;
  }
</style>
<body>
<center >
  <section class="content">
  <img src="<?php echo base_url(); ?>images/logo_all.png" width="190" />
  <br/><br/>
	    	<table border="0">
	    		<tr>
	           <td align="left">
	        		Kode Pelatihan
	        		</td><td width="50" align="center">:</td>
						<td align="left">
	                	<?php
	                		echo $isi->kode_transaksi;
	                	?>
	          </td>
            </tr>
            <tr>
             <td align="left">Tema</td><td width="50" align="center">:</td>
  					<td align="left">
                  	<?php
                  		echo $isi->tematext;
                  	?>
           </td>
					</tr>
          <tr>
	           <td align="left">Perihal</td><td width="50" align="center">:</td>
						<td align="left">
	                	<?php
	                		echo $isi->perihaltext;
	                	?>
            </td></tr>
          <tr>
             <td align="left">Jumlah Sesi</td><td width="50" align="center">:</td>
           <td align="left">
                    <?php
                      echo $isi->sesi;
                    ?>
            </td></tr>
          <tr>
            <tr>
           <td align="left">Penanggung Jawab</td><td width="50" align="center">:</td>
         <td align="left">
                  <?php
                    echo $CI->dbx->getpegawai($isi->idpenanggungjawab,0,1);
                  ?>
            </td></tr>
            <tr>
              <tr>
             <td align="left">
              Tujuan
              </td><td width="50" align="center">:</td>
           <td align="left">
                    <?php

                      echo $isi->deskripsi;
                    ?>
            </td></tr>
      <tr>
         <td align="left">
      		Ruang
      		</td><td width="50" align="center">:</td>
				<td align="left">
              	<?php
              		echo $isi->ruangtext;
              	?>
				</td></tr>
    <tr>
       <td align="left">
        Tgl. Pelaksanaan
        </td><td width="50" align="center">:</td>
     <td align="left">
              <?php
                echo strtoupper($CI->p_c->tgl_indo($isi->tanggalpelaksanaan))." (".$isi->jammulai." s/d ".$isi->jamakhir.")";
              ?>
    </td></tr>
      <tr>
         <td align="left">
          Tgl. Rilis
          </td><td width="50" align="center">:</td>
         <td align="left">
                <?php
                  echo strtoupper($CI->p_c->tgl_indo($isi->tanggalrilis));
                ?>
       <td align="left">
         <td align="left">
          </td></tr>
        <tr>
           <td align="left">
            Tgl. Konfirmasi
            </td><td width="50" align="center">:</td>
         <td align="left">
                  <?php
                    echo strtoupper($CI->p_c->tgl_indo($isi->tanggalkonfirmasi));
                  ?>
        </td></tr>
        <tr>
           <td align="left">
            Peran Peserta Wajib
            </td><td width="50" align="center">:</td>
         <td align="left">
                  <?php
                    echo $CI->dbx->role_show($isi->idrole,0);
                  ?>
                  <?php //echo  <p id="message"></p> ?>
            </td></tr>
            <tr>
               <td align="left">
                Peran Peserta Tidak Wajib
                </td><td width="50" align="center">:</td>
             <td align="left">
                      <?php
                        echo $CI->dbx->role_show($isi->idrole2,0);
                      ?>
                      <?php //echo  <p id="message"></p> ?>
              </td></tr>
	            <tr>
	           <td align="left">
	        		Aktif
	        		</td><td width="50" align="center">:</td>
						<td align="left">
	                	<?php
	                		echo $CI->p_c->cekaktif($isi->aktif);
	                	?>
	            </td></tr>
              <tr>
             <td align="left">
              Status
              </td><td width="50" align="center">:</td>
           <td align="left">
                    <?php
                      echo $isi->statustext;
                    ?>
              </td></tr>
         </table><br/><br/>
<!--------------------------------------------------------------------------------------------------------------------------->
         <h4 align="left">Pengisi Materi :</h4>
         <table style="border-collapse:collapse" border="1" cellpadding="2">
         <thead>
             <tr>
                 <th width="50">No.</th>
                 <th>Nama</th>
            </tr>
         </thead>
         <tbody>
           <?php
                   $CI =& get_instance();
                   $no=1;
                   foreach((array)$hrm_event_pemateri as $rowpem) {
                   echo "<tr>";
                   echo "<td align='center'>".$no++."</td>";
                   echo "<td align='left'>".$rowpem->namapemateri."</td>";
                   echo "</tr>";
                   }
               ?>

                   </tbody>
               </table><br/><br/>
 <!--------------------------------------------------------------------------------------------------------------------------->
         <h4 align="left">Rundown Pelatihan :</h4>
            <table style="border-collapse:collapse" border="1" cellpadding="2">
           <thead>
               <tr>
                   <th width="50">No.</th>
                   <th>Rundown</th>
                   <th>Dari</th>
                   <th>Sampai</th>
                   <th>Lama</th>
               </tr>
           </thead>
           <tbody>
             <?php
                     $CI =& get_instance();
                     $no=1;
                     foreach((array)$hrm_event_rundown as $rowrun) {
                     echo "<tr>";
                     echo "<td align='center'>".$no++."</td>";
                     echo "<td align='left'>".$rowrun->hrm_event_rundown."</td>";
                     echo "<td align='center'>".$rowrun->dari."</td>";
                     echo "<td align='center'>".$rowrun->sampai."</td>";
                     echo "<td align='center'>".$rowrun->lama."</td>";
                     echo "</tr>";
                     }
                 ?>

                     </tbody>
                 </table><br/><br/>
<!--------------------------------------------------------------------------------------------------------------------------->
        <h4 align="left">Evaluasi Pelatihan</h4>
				<h4 align="left">Pemateri :</h4>
          <table style="border-collapse:collapse" border="1" cellpadding="2">
          <thead>
              <tr>
                  <th width="50" >No.</th>
                  <!-- <th>Peruntukan</th> -->
                  <th>Head</th>
                  <th>Evaluasi Pelatihan</th>
                  <th>Skor Target</th>
                  <th>AVG Peserta</th>
              </tr>
          </thead>
          <tbody>
            <?php
                    $CI =& get_instance();
                    $no=1;
										$graph_pemateri="";$avgevalpemateri=0;$nohit=0;
                    foreach((array)$hrm_event_evaluation_pelaksana_pemateri as $roweep) {
		                    echo "<tr>";
		                    echo "<td align='center'>".$no++."</td>";
		                    //echo "<td align='left'>".$roweep->type."</td>";
		                    echo "<td align='left'>".$roweep->head."</td>";
		                    echo "<td align='left'>".$roweep->hrm_event_evaluation."</td>";
		                    echo "<td align='center'>".$roweep->target_skor."</td>";
		                    echo "<td align='center'>".$roweep->avgpeserta."</td>";
		                    echo "</tr>";
												if($roweep->target_skor>=1){
													$nohit++;
													$avgevalpemateri=$avgevalpemateri+$roweep->avgpeserta;
												//grafik
													$graph_pemateri=$graph_pemateri."{y: '".$roweep->hrm_event_evaluation."', a: ".$roweep->target_skor.", b: ".$roweep->avgpeserta."},";
												}
                    }
										$avgevalpemateri=round($avgevalpemateri/$nohit);
										echo "<tr>";
										echo "<td align='right' colspan='4'><b>Rata-Rata:</b>&nbsp;&nbsp;</td>";
										echo "<td align='center'>".$avgevalpemateri."</td>";
										echo "</tr>";
                ?>

              </tbody>
                </table>
                <br/><br/>
								<br/><br/>
							<table style="border-collapse:collapse" border="1" cellpadding="2">
								<tr>
										<td>
											<div>
													<div class="chart" align="center" id="pemateri" style="height: 300px;"></div>
											</div><!-- /.box-body -->

										</td>
								</tr>
							</table><br/><br/>

							<script type="text/javascript">
								$(function() {
										"use strict";

										// AREA CHART
										var bar = new Morris.Bar({
												element: 'pemateri',
												resize: true,
												data: [
														<?php echo $graph_pemateri; ?>
												],
												barColors: ['#00a65a', '#f56954'],
												xkey: 'y',
												ykeys: ['a', 'b'],
												labels: ['Target', 'AVG'],
												hideHover: 'auto'
										});
								});
						</script>

					<h4 align="left">Peserta :</h4>
	          <table style="border-collapse:collapse" border="1" cellpadding="2">
	          <thead>
	              <tr>
	                  <th width="50" >No.</th>
	                  <!-- <th>Peruntukan</th> -->
	                  <th>Head</th>
	                  <th>Evaluasi Pelatihan</th>
	                  <th>Skor Target</th>
	                  <th>AVG Peserta</th>
	              </tr>
	          </thead>
	          <tbody>
	            <?php
	                    $CI =& get_instance();
	                    $no=1;$graph_peserta="";$avgevalpeserta=0;$nohit=0;
	                    foreach((array)$hrm_event_evaluation_pelaksana_peserta as $roweep) {
			                    echo "<tr>";
			                    echo "<td align='center'>".$no++."</td>";
			                    //echo "<td align='left'>".$roweep->type."</td>";
			                    echo "<td align='left'>".$roweep->head."</td>";
			                    echo "<td align='left'>".$roweep->hrm_event_evaluation."</td>";
			                    echo "<td align='center'>".$roweep->target_skor."</td>";
			                    echo "<td align='center'>".$roweep->avgpeserta."</td>";
			                    echo "</tr>";
													//grafik
													if($roweep->target_skor>=1){
														$nohit++;
														$avgevalpeserta=$avgevalpeserta+$roweep->avgpeserta;
														$graph_peserta=$graph_peserta."{y: '".$no."', a: ".$roweep->target_skor.", b: ".$roweep->avgpeserta."},";
													}
	                    }
											$avgevalpeserta=round($avgevalpeserta/$nohit);
											echo "<tr>";
											echo "<td align='right' colspan='4'><b>Rata-Rata:</b>&nbsp;&nbsp;</td>";
											echo "<td align='center'>".$avgevalpeserta."</td>";
											echo "</tr>";
	                ?>

	              </tbody>
          </table>
					<br/><br/>
        <table style="border-collapse:collapse" border="1" cellpadding="2">
          <tr>
              <td>
                <div>
                    <div class="chart" align="center" id="peserta" style="height: 300px;"></div>
                </div><!-- /.box-body -->

              </td>
          </tr>
        </table><br/><br/>

        <script type="text/javascript">
          $(function() {
              "use strict";

              // AREA CHART
              var bar = new Morris.Bar({
                  element: 'peserta',
                  resize: true,
                  data: [
                      <?php echo $graph_peserta; ?>
                  ],
                  barColors: ['#00a65a', '#f56954'],
                  xkey: 'y',
                  ykeys: ['a', 'b'],
                  labels: ['Target', 'AVG'],
                  hideHover: 'auto'
              });
          });
      </script>
			<h4 align="left">Kritik dan Saran :</h4>
			<table style="border-collapse:collapse" border="1" cellpadding="2">
			<thead>
					<tr>
							<th width="50">No.</th>
							<th>Oleh</th>
							<th>Head</th>
							<th>Evaluasi Pelatihan</th>
							<th>Kritik dan Saran</th>
					</tr>
			</thead>
			<tbody>
				<?php
								$CI =& get_instance();
								$no=1;
								foreach((array)$hrm_event_evaluation_deskripsi as $rowdep) {
								echo "<tr>";
								echo "<td align='center'>".$no++."</td>";
								echo "<td align='left'>".$rowdep->type."</td>";
								echo "<td align='left'>".$rowdep->head."</td>";
								echo "<td align='left'>".$rowdep->hrm_event_evaluation."</td>";
								echo "<td align='left'>".$rowdep->deskripsinilai."</td>";
								echo "</tr>";
								}
						?>

								</tbody>
						</table><br/><br/>
<!--------------------------------------------------------------------------------------------------------------------------->
        <h4 align="left">Peserta [Target <?php echo $isi->target_peserta; ?> Orang] :</h4>
          <table style="border-collapse:collapse" border="1" cellpadding="2">
          <thead>
              <tr>
                  <th width="50" rowspan=2 align="center">No.</th>
                  <th rowspan=2 align="left">Nama</th>
                  <th rowspan=2 align="center" width="60">Wajib</th>
                  <th colspan="<?php echo $isi->sesi ?>">Absen</th>
                  <th rowspan=2 width="100" align="center">Pretest</th>
                  <th rowspan=2 width="100" align="center">Posttest</th>
                  <th rowspan=2 width="100" align="center">Selisih</th>
              </tr>
              <tr>
                <?php
                for ($i = 1; $i <= $isi->sesi; $i++) {
                  echo "<th align='center'>".$CI->p_c->romawi($i)."</th>";
                }
                ?>
              </tr>
          </thead>
          <tbody>
            <?php
                    $CI =& get_instance();
                    $no=1;
                    $tot_pretest=0;$tot_posttest=0;$nohadir=0;
                    foreach((array)$hrm_event_peserta as $rowepes) {
												if($rowepes->pretest<>""){
														$tot_pretest+=$rowepes->pretest;$tot_posttest+=$rowepes->posttest;
														$nohadir++;
												}
                        echo "<tr>";
                        echo "<td align='center'>".$no++."</td>";
                        echo "<td align='left'>".$CI->dbx->getpegawai($rowepes->idpeserta,0,1)."</td>";
                        echo "<td align='center'>".$CI->p_c->cekaktif($rowepes->wajib)."</td>";
                        for ($i = 1; $i <= $isi->sesi; $i++) {
                          $th="tanggalhadir".$i;
                          echo "<td align='center'>".$rowepes->$th."</td>";
                        }
                        echo "<td align='center'>".$rowepes->pretest."</td>";
                        echo "<td align='center'>".$rowepes->posttest."</td>";
                        echo "<td align='center'>".($rowepes->posttest-$rowepes->pretest)."</td>";
                        echo "</tr>";
                    }
                    //echo "<tr><td colspan='4' align='right'>Total :</td><td align='center'>".$tot_pretest."</td><td align='center'>".$tot_posttest."</td><td align='center'>".$tot_posttest."</td></tr>";
                    echo "<tr><td colspan='4' align='right'>Rata-Rata :</td><td align='center'>".($tot_pretest/$nohadir)."</td><td align='center'>".($tot_posttest/$nohadir)."</td><td align='center'>".(($tot_posttest-$tot_pretest)/$nohadir)."</td></tr>";
                ?>
                    </tbody>
                </table><br/><br/>
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
    </body>
</center>

<?php if($excel<>1) { ?>
	<script language="javascript">
		window.print();
	</script>
<?php } ?>

</html>
