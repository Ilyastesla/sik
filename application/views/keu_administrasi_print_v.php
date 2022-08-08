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
              <th width="50" >No</th>
              <th>NIS</th>
              <th>Nama</th>
              <th>Kelas</th>
              <th>Status Program</th>
              <th>Regional</th>
              <th>ABK</th>
              <th>Aktif</th>

              <!--
              <th>Keuangan</th>
              -->
              <?php
              echo "<th>Tipe Peringatan</th>";
               echo "<th>Administrasi<br/>Siswa</th>";
               echo "<th width='50'>Sisa Hari</th>";
               echo "<th>Tutor Visit</th>";
              ?>
          </tr>
        </thead>
        <tbody>
          <?php
          $CI =& get_instance();$no=1;
          foreach((array)$show_table as $row) {
              echo "<tr>";
              echo "<td align='center'>".$no++."</td>";
              echo "<td align='center'>";
              echo strtoupper($row->nis);
              echo "</td>";
              echo "<td align='center'>".strtoupper($row->nama);
              if ($row->jml_hari<=14){
                echo ' <b><font color="red">(baru)</font></b>';
              }
              //if (($row->jml_hari>=180) and ($row->konseling_desc==1)){
              //  echo ' <b><font color="red">(Harus Interview)</font></b>';
              //}
              echo "</td>";
              echo "<td align='center'>".strtoupper($row->kelas)."</td>";
              echo "<td align='center'>".strtoupper($row->kondisi_nm)."</td>";
              echo "<td align='center'>".strtoupper($row->region)."</td>";
              echo "<td align='center'>".($CI->p_c->cekaktifreport($row->abk))."</td>";
              echo "<td align='center'>".$CI->p_c->cekaktifreport($row->aktif)."</td>";
              echo "<td align='center'>".$CI->p_c->cekperingatan($row->peringatan)."</td>";
              echo "<td align='center'>";
                if($row->peringatan>"0"){
                  echo $CI->p_c->tgl_indo($row->tgl_kadaluarsa);
                }
              echo "</td>";
              //echo "<td align='center'>";
              //echo "</td>";
              echo "<td align='center'>";
              if (($row->sisahari<7) and ($row->peringatan>"0")){
                echo strtoupper($row->sisahari);
              }else {
                echo strtoupper($row->sisahari);
              }
              echo "</td>";
              echo "<td align='center'>";
              echo $CI->p_c->cekaktifreport($row->keu_tutorvisit);
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
