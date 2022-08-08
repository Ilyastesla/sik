<?php $CI =& get_instance();

$CI =& get_instance();
if ($excel==1){
	header('Content-Type: application/vnd.ms-excel'); //IE and Opera
	header('Content-Type: application/x-msexcel'); // Other browsers
	header('Content-Disposition: attachment; filename=daftarpesertadidik.xls');
	header('Expires: 0');
	header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
}else{
    ?>
	<script language="javascript">
		window.print();
	</script>
    <?php
}
?>
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
		font-size: 9pt !important;
	}
	th,td {
		padding:3px !important;
	}
</style>

<script language="javascript" src="../script/tables.js"></script>
<script language="javascript" src="../script/tools.js"></script>
</head>
<body>
<center>
    <?php 
        echo "<table style='border-collapse:collapse;border-color:black;' border='1' width='85%'>";
        echo "<thead>";
        echo "<th width='50' >No</th>";
        echo "<th>Nama</th>";
        echo "<th>NIS</th>";
        echo "<th>NISN</th>";
        echo "<th>Tahun Pelajaran</th>";
        echo "<th>Kelas</th>";
        echo "<th>Jenis Kelamin</th>";
        echo "<th>TTL</th>";
        echo "<th>Agama</th>";
        echo "<th>Nama Ayah</th>";
        echo "<th>Nama Ibu</th>";
        echo "<th>Alamat Tinggal</th>";
        echo "</thead>";
        echo "<tbody>";
        $CI =& get_instance();$no=1;
		foreach((array)$show_table as $row) {
            echo "<tr>";
            echo "<th>".$no++."</th>";
            echo "<th>".$row->nama."</th>";
            echo "<th>".$row->nis."</th>";
            echo "<th>".$row->nisn."</th>";
            echo "<th>".$row->tahunajarantext."</th>";
            echo "<th>".$row->kelastext."</th>";
            echo "<th>".$CI->p_c->jk($row->kelamin)."</th>";
            echo "<th>".$row->tmplahir.",".$CI->p_c->tgl_indo($row->tgllahir )."</th>";
            echo "<th>".$row->agamatext."</th>";
            echo "<th>".$row->namaayah."</th>";
            echo "<th>".$row->namaibu."</th>";
            echo "<th>".$row->alamatsiswa ."&nbsp; ".$row->kecamatantext."<br/>&nbsp;".$row->kotatext ." ".$row->kodepossiswa ." <br />&nbsp;".$row->propinsitext ."<br />&nbsp;".$row->negaratext."</th>";
            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";
    ?>
</center>
</body>
