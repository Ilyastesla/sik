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
      <td align="right" width="50%" valign="bottom"><h3>FPPB</h3><h4><b><u>Form Permohonan Permintaan Barang</u></b></h4></td>
    </tr>
    <tr>
        <td colspan=2><hr/></td>
    </tr>
  </table>

    <table style="border-collapse:collapse" border="0" cellpadding="2">
      <tr>
          <th align="left" width="20%">No. Permintaan</th><th align="left" width="30%">: <?php echo strtoupper($isi->kode_transaksi); ?></th>
          <th align="left" width="20%">Tgl. Permintaan</th><th align="left" width="30%">: <?php echo $CI->p_c->tgl_indo($isi->created_date); ?></th>
      </tr>
      <tr>
          <th align="left">Pemohon</th><th align="left">: <?php echo strtoupper($isi->pemohontext); ?></th>
          <th align="left">Tgl. Kebutuhan</th><th align="left">: <?php echo $CI->p_c->tgl_indo($isi->tanggalpengajuan); ?></th>
      </tr>
      <tr>
          <th align="left">Departemen</th><th align="left">: <?php echo strtoupper($isi->departemen); ?></th>
          <th align="left">Prioritas</th><th align="left">: <?php echo strtoupper($isi->prioritastext); ?></th>
      </tr>
    </table>
    <table style="border-collapse:collapse;" border="1" cellpadding="2">
      <thead>
          <tr>
            	<td align='center' widtd='50'>No.</b></td>
              <td align='center'><b>Peruntukan</b></td>
              <td align='center'><b>Material</b></td>
              <td align='center'><b>Jumlah</b></td>
              <td align='center'><b>Harga Perkiraan<br>(+pajak)</b></td>
              <td align='center'><b>Harga Total</b></td>
              <td align='center'><b>Vendor</b></td>
              <td align='center'><b>Keterangan</b></td>
          </tr>
      </thead>
      <tbody>
        <?php
        $jml_c=0;$no=1;$stock=0;$totalall=0;
        if (!empty($material)){
            foreach($material as $row) {
                  $totalall=$totalall+$row->hargatotal;
                  echo "<tr>";
                  echo "<td align='center'>".$no++."</td>";
                  echo "<td align='center'>".$row->peruntukantext."</td>";
                  echo "<td align='left'>".$row->materialtext."</td>";
                  echo "<td align='center'>".$row->jumlah.' '.$row->idunit."</td>";
                  echo "<td align='right'>".$CI->p_c->rupiah($row->harga)."</td>";
                  echo "<td align='right'>".$CI->p_c->rupiah($row->hargatotal)."</td>";
                  echo "<td align='center'>".strtoupper($row->vendor)."</td>";
                  echo "<td align='center'>".$row->peruntukan."</td>";
                  echo "</tr>";
            }
            echo "<tr>";
            echo "<td align='right' colspan='5'>Total Pengajuan :&nbsp;&nbsp;</td>";
            echo "<td align='right'>".$CI->p_c->rupiah($totalall)."</td>";
            echo "<td align='right' colspan='2'>&nbsp;</td>";
            echo "</tr>";
        }
        echo "<tr>";
        echo "<th align='left' colspan='8' valign='top' height='50px'>Keterangan : <br><p align='justify'>".$isi->keterangan."</p></th>";
        echo "</tr>";
        ?>
      </tbody>
    </table>
    <br/>
    <table style="border-collapse:collapse" border="1" cellpadding="2">
      <tr>
          <td colspan="5" align="right"><font><b>Tangerang Selatan, <?php echo $CI->p_c->tgl_indo($isi->tglprint); ?>&nbsp;&nbsp;&nbsp;</b></font></td>
        </tr>
      <tr>
          <td colspan="3" align="center"><b>Pemohon</b></td>
          <td colspan="2" align="center"><b>Disetujui Oleh</b></td>
        </tr>
      <tr>
          <td align="center" width="20%"><b>Pemohon</b></td>
          <td align="center" width="20%"><b>Pengguna</b></td>
          <td align="center" width="20%"><b>Atasan Langsung</b></td>
          <td align="center" width="20%"><b>Manajer Umum</b></td>
          <td align="center" width="20%"><b>Manajer Keuangan</b></td>
        </tr>
        <tr>
          <td align="center" height="80px"></td>
          <td align="center"></td>
          <td align="center"></td>
          <td align="center"></td>
          <td align="center"></td>
        </tr>
        <tr>
          <td align="center"><b><?php echo $CI->dbx->getpegawai($isi->pemohon,0,0); ?></b></td>
          <td align="center"><b>(....................................)</b></td>
          <td align="center"><b>(....................................)</b></td>
          <td align="center"><b>(....................................)</b></td>
          <td align="center"><b>(....................................)</b></td>
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
