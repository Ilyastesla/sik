<!DOCTYPE html>
<?php
$CI =& get_instance();
?>
<html>
<title><?php echo $form ?></title>
<link href="<?php echo base_url(); ?>css/bootstrap.min.css" rel="stylesheet" type="text/css" />
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
	table {
		width: 85% !important;
	}
  td,th{
    padding:20 !important;
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

  <table width="100%" border="0">
    <tr>
      <td align="left" width="50%" valign="bottom"><?php $CI->dbx->getheadercompany($isi->idcompany)?></td>
      <td align="right" width="50%" valign="bottom"><h3>Purchase Order</h3><h4><b><u>Surat Pesanan</u></b></h4></td>
    </tr>
    <tr>
        <td colspan=2><hr/></td>
    </tr>
  </table>

    <table style="border-collapse:collapse" border="0" cellpadding="2">
      <tr>
          <th align="left" width="20%">No. Pembelian</th><th align="left" width="30%">: <?php echo strtoupper($isi->kode_transaksi); ?></th>
          <th align="left" width="20%">Tgl. Pembelian</th><th align="left" width="30%">: <?php echo $CI->p_c->tgl_indo($isi->tanggalpembelian); ?></th>
      </tr>
      <tr>
          <th align="left">Vendor</th><th align="left" colspan="3">: <?php echo strtoupper($isi->vendortext); ?></th>
      </tr>
    </table>
    <table style="border-collapse:collapse;" border="1">
      <thead>
          <tr>
            	<td align='center' widtd='50'>No.</b></td>
              <td align='center'><b>Material</b></td>
              <td align='center'><b>Jumlah</b></td>
              <td align='center'><b>Unit</b></td>
          </tr>
      </thead>
      <tbody>
        <?php
        $jml_c=0;$no=1;$stock=0;$totalall=0;
        if (!empty($material)){
            foreach($material as $row) {
                  $totalall=$totalall+$row->hargatotal;
                  echo "<tr >";
                  echo "<td align='center'>".$no++."</td>";
                  echo "<td align='left'>&nbsp;&nbsp;".$row->materialtext."</td>";
                  echo "<td align='center'>".$row->jumlah."</td>";
                  echo "<td align='center'>".$row->unittext."</td>";
                  echo "</tr>";
            }
        }
        echo "<tr>";
        echo "<th align='left' colspan='4' valign='top' height='50px'>&nbsp;&nbsp;Keterangan : <br><p align='justify'>".$isi->keterangan."</p></th>";
        echo "</tr>";
        ?>
      </tbody>
    </table>
    <br/>
    <table style="border-collapse:collapse" border="0" cellpadding="2">
      <tr>
          <td colspan="5" align="right"><font><b>Tangerang Selatan, <?php echo $CI->p_c->tgl_indo($isi->tglprint); ?>&nbsp;&nbsp;&nbsp;</b></font></td>
      </tr>
      <tr>
          <td align="center"><b>Penyedia</b></td>
          <td colspan="2" align="center"><b>Pemohon</b></td>
        </tr>
      <tr>
          <td align="center" width="20%"><b>Vendor</b></td>
          <td align="center" width="20%"><b>Petugas</b></td>
          <td align="center" width="20%"><b>Manajer Umum</b></td>
        </tr>
        <tr>
          <td align="center" height="80px"></td>
          <td align="center"></td>
          <td align="center"></td>

        </tr>
        <tr>
          <td align="center"><b>(<?php echo strtoupper($isi->vendortext); ?>)</b></td>
          <td align="center"><b>(<?php echo $CI->dbx->getpegawai($isi->created_by,0,0); ?>)</b></td>
          <td align="center"><b>(.............................................)</b></td>
        </tr>
    </table>
   </center>
</body>
<? die; ?>
<?php if($excel<>1) { ?>
	<script language="javascript">
		window.print();
	</script>
<?php } ?>
</html>
