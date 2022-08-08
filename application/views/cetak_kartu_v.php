<?php $CI =& get_instance();?>
<html>
<head>
<title><?php echo $form.' ['.$form_small. ']' ?></title>
<link href="<?php echo base_url(); ?>css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<script src="<?php echo base_url(); ?>js/jquery2.min.js"></script>
<script src="<?php echo base_url(); ?>js/bootstrap.min.js" type="text/javascript"></script>

<link href="<?php echo base_url(); ?>css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<script src="<?php echo base_url(); ?>js/morris/morris.min.js" type="text/javascript"></script>
<link href="<?php echo base_url(); ?>js/morris/morris.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>css/AdminLTE.css" rel="stylesheet" type="text/css" />

<style>
    table{
        font-size: 7.5pt;
        font-family: verdana;
    }
    #tablesub{width: 100%;border: 1;border-collapse:collapse;cellpadding:0;table-layout: fixed;}
    #tablesub th{width: 50% !important;text-align:center !important;}
    hr{
      margin-top: 5px !important;
      margin-bottom: 5px !important;
      border-top: 1px solid black !important
    }
    #bgtd {
            background-image:url('<?php echo base_url() ?>images/cappkbm.png');
            background-repeat: no-repeat;
            background-size: 90px;
            background-position:left top;
          }
    @media print {
      body {-webkit-print-color-adjust: exact;}
          #tablesub tr{page-break-inside: avoid;page-break-after: auto;}
          #bgtd {
            background-image:url('<?php echo base_url() ?>images/cappkbm.png');
            background-repeat: no-repeat;
            background-size: 90px;
            background-position:left top;
            
          }
      }
    @page {
        size: A4;
      }
</style>

<script language="javascript" src="../script/tables.js"></script>
<script language="javascript" src="../script/tools.js"></script>
</head>

<body>
<center>
  <table border="0" cellpadding="10" cellspacing="5" width="100%" align="left">
  <tr>
  	<td align="center" valign="top">
  				<?php
          $tablewidth="";
  				if(COUNT($show_table)==1){
  					$tablewidth=" style='width:50% !important;'";
  				}
  				echo "<table border=1; id='tablesub' ".$tablewidth.">";
          $no=0;
  				foreach((array)$show_table as $row) {
  						//if(($no % 8)==0){

  						//}
  						if(($no % 2)==0){
  							//echo $no."---".($no % 2)."<br/>";
  							echo "<tr>";
  						}
  						echo "<th><center>";
  						echo "<table width='95%' height='95%' border='0' >";
  						echo "<tr>";
  						echo "<td align='center' colspan='3' valign='middle'>";
  						echo "<table width='95%' height='40px' border='0' id='headertable'>";
              echo "<tr>";
              if ($settingtryout->logodepdikbud==1){
                echo "<td align='center' width='20%'>";
  							echo "<img src='".base_url()."images/logokemendikbud.jpeg' height='25' />";
                echo "</td>";
  						}
  						echo "<td align='center' colspan=2><font style='font-size:5pt !important;'><b>KARTU PESERTA ".strtoupper($settingtryout->tryout).' '.strtoupper($row->depttext)." <br/> ".strtoupper($row->semester)." <br/> TAHUN AJARAN ".$row->tahunajarantext."</b></font></td>";
              echo "<td align='center' width='20%'><img src='".base_url()."images/".$row->logotext."' height='25' /></td>";
              echo "</tr>";
  						echo "</table></td></tr>";
  						echo "<tr><td colspan=3><hr/></td></tr>";
              echo "<tr><td width='48%'>&nbsp;</td><td width='4%'>&nbsp;</td><td width='48%'>&nbsp;</td></tr>";
              if ($settingtryout->nomorpeserta==1){
  							echo "<tr><td align='left' width='50px'><b>Nomor Peserta</b></td><td><b>:</b></td><td align='left'>".strtoupper($row->nomorpeserta)."</td></tr>";
  						}
              if ($settingtryout->nisn==1){
  						        echo "<tr><td align='left'><b>NISN</b></td><td><b>:</b></td><td align='left'>".strtoupper($row->nisn)."</td></tr>";
              }
              if ($settingtryout->nissistem==1){
  						        echo "<tr><td align='left'><b>NIS</b></td><td><b>:</b></td><td align='left'>".strtoupper($row->nis)."</td></tr>";
              }
              //if ($settingtryout->nama==1){
  						        echo "<tr><td align='left'><b>Nama</b></td><td>:</td><td align='left'>".strtoupper($row->nama)."</td></tr>";
              //}
              if ($settingtryout->ttlsistem==1){
  						        echo "<tr><td align='left'><b>TTL</b></td><td><b>:</b></td><td align='left'>".strtoupper($row->ttl)."</td></tr>";
              }
              if ($settingtryout->kelassistem==1){
  						        echo "<tr><td align='left'><b>Kelas</b></td><td>:</td><td align='left'>".strtoupper($row->kelastext)."</td></tr>";
              }
              if ($settingtryout->programsistem==1){
  						        echo "<tr><td align='left'><b>Program</b></td><td>:</td><td align='left'>".strtoupper($row->kelompoksiswatext)."</td></tr>";
              }
              echo "<tr><td rowspan=3 align='center'>";
              if ($settingtryout->fotosistem==1){
  							echo "<table width='100px' height='90%' border=1 style='border-collapse:collapse'><tr>";
                if($row->fotosiswa<>""){
                    echo "<td><img src=".base_url()."uploads/fotosiswa/".$row->fotosiswa." width='100px'/></td>";
                }else{
                  echo "<td>&nbsp;</td>";
                }

  							echo "</tr></table>";
  						}
              echo "</td></tr>";
  						echo "<tr><td align='center' colspan='2' valign='bottom'>";
              echo "<div style='position:fixed;z-index: 10;padding-left: 20px;'><img src='".base_url()."images/cappkbm.png' width='80px'/></div>";
              echo "<img src='".base_url()."uploads/ttd/".$CI->dbx->getpegawaittd($row->idkepsek,0,0)."' width='90px'/>";
              echo "<br/>".$CI->dbx->getpegawai($row->idkepsek,0,0)."<hr/>NIK : ".strtoupper($row->nip)."<br/><br/><br/></td></tr>";
  						echo "</table>";
  						echo "</center></th>";
  						if(($no % 2)==1){
  							echo "</tr>";
  						}
  						$no++;
  				}
  				echo "</table>";
  				?>
  		</td>
  </tr>
  </table>
</center>
<script language="javascript">
	window.print();
</script>
</body>
</html>
