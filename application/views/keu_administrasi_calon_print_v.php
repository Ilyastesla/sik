<!DOCTYPE html>
<?php
$CI =& get_instance();
if ($excel==1){
	header('Content-Type: application/vnd.ms-excel'); //IE and Opera
	header('Content-Type: application/x-msexcel'); // Other browsers
	header('Content-Disposition: attachment; filename=rapot.xls');
	header('Expires: 0');
	header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
}
?>
<html>
<title>Laporan <?php echo $form ?></title>
<link href="<?php echo base_url(); ?>css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<script src="<?php echo base_url(); ?>js/jquery2.min.js"></script>
<script src="<?php echo base_url(); ?>js/bootstrap.min.js" type="text/javascript"></script>

<link href="<?php echo base_url(); ?>css/bootstrap.min.css" rel="stylesheet" type="text/css" />
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
    <img src="<?php echo base_url(); ?>images/logo_all.png" width="190" />
    <h4>LAPORAN <?php echo strtoupper($form) ?></h4>
    <h5>Tanggal <?php echo $CI->p_c->tgl_indo($hariini); ?></h5>
  	<br/>
    <table style="border-collapse:collapse;border-color:black;" border="1"  cellpadding="5">
        <thead>
          <tr>
          <?php
              echo "<th width='50' >No</th>";
              echo "<th>No Daftar</th>";
              echo "<th>NIS Sementara</th>";
              echo "<th>Nama</th>";
              echo "<th>Proses</th>";
              echo "<th>Program</th>";
              echo "<th>Status Program</th>";
              echo "<th>Tingkat</th>";
              echo "<th>Regional</th>";
              echo "<th>Tgl.Daftar</th>";
              echo "<th>ABK</th>";
              echo "<th>Aktif</th>";
              echo "<th width='50'>Form</th>";
              echo "<th width='50'>Assessment</th>";
              echo "<th width='50'>UP</th>";
              ?>
          </tr>
        </thead>
        <tbody>
          <?php
          $CI =& get_instance();$no=1;
          foreach((array)$show_table as $row) {
            echo "<tr>";
            echo "<td align='center'>".$no++."</td>";
            echo "<td align='center'>".strtoupper($row->nopendaftaran)."</td>";
            echo "<td align='center'>".strtoupper($row->nissementara)."</td>";
            echo "<td align='center'>".strtoupper($row->nama)."</td>";
            echo "<td align='center'>".strtoupper($row->proses)."</td>";
            echo "<td align='center'>".strtoupper($row->kelompok)."</td>";
            echo "<td align='center'>".strtoupper($row->kondisi_nm)."</td>";
            echo "<td align='center'>".strtoupper($row->tingkat)."</td>";
            echo "<td align='center'>".strtoupper($row->region)."</td>";
            echo "<td align='center'>".$CI->p_c->tgl_indo($row->tanggal_daftar)."</td>";
            echo "<td align='center'>".($CI->p_c->cekaktifreport($row->abk))."</td>";
            echo "<td align='center'>".$CI->p_c->cekaktifreport($row->aktif)."</td>";
            echo "<td align='center'>";
            echo $CI->p_c->cekaktifreport($row->keu_form);
            echo "</td>";
            echo "<td align='center'>";
            echo $CI->p_c->cekaktifreport($row->keu_assessment);
            echo "</td>";
            echo "<td align='center'>";
            echo $CI->p_c->cekaktifreport($row->keu_up);
            echo "</td>";
            echo "</tr>";
          }
?>

        </tbody>
        <tfoot>
        </tfoot>
    </table>
  </center>
</body>
<?php if($excel<>1) { ?>
	<script language="javascript">
		window.print();
	</script>
<?php } ?>
</html>
