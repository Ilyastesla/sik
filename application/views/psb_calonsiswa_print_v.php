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
        echo "<th width='50'>No.</th>";
        echo "<th>Nama</th>";
        //echo "<th width='120'>Tgl. Posting</th>";
        echo "<th>No Daftar</th>";
        //echo "<th>NIS Sementara</th>";
        echo "<th width='100'>Tingkat</th>";
        //echo "<th>Jurusan</th>";
        echo "<th>Tahun Pelajaran</th>";
        //echo "<th>Status Program</th>";
        //echo "<th>Calon Kelas</th>";
        echo "<th>Tgl. Daftar</th>";
        echo "<th>Biaya Form</th>";
        //echo "<th>Biaya Assessment</th>";
        echo "<th>UP</th>";
        echo "<th>Aktif</th>";
        echo "<th width='150'>SKL</th>";
        echo "<th>Verifikasi</th>";
        //echo "<th width='80'>Aksi</th>";
        echo "<th>NIS</th>";
        echo "</thead>";
        echo "<tbody>";
        $CI =& get_instance();$no=1;
		foreach((array)$show_table as $row) {
            echo "<tr>";
											    echo "<td align='center'>".$no++."</td>";
                          echo "<td align=''>".$row->nama."</td>";
                          //echo "<td align=''>".$CI->p_c->tgl_indo($row->tanggal_daftar)."</td>";
                          echo "<td align='center'>";
                          echo "<a href=javascript:void(window.open('".site_url('general/datacalonsiswa/'.$row->replid)."')) >".$row->nopendaftaran."</a>";
                          echo "</td>";
                          //echo "<td align=''>".($row->nissementara)."</td>";
                          echo "<td align='center'>".($row->tingkattext." ".$row->jurusantext."<br/>(".$row->kondisitext).")</td>";
                          //echo "<td align=''>".($row->jurusantext)."</td>";
                          echo "<td align=''>".$row->tahunajarantext."</td>";
                          //echo "<td align=''>".($row->kondisitext)."</td>";
                          //echo "<td align=''>".($row->kelastext )."</td>";
                          echo "<td align=''>";
                          if (($row->lama>$row->lamaproses) and ($row->replidsiswa=="") and ($row->aktif=="1")){
                            echo $CI->p_c->bgcolortext($CI->p_c->tgl_indo($row->tanggal_daftar),'red');
                          }else{
                            echo $CI->p_c->tgl_indo($row->tanggal_daftar);
                          }
                          echo "</td>";
                          echo "<td align=''>Reguler: ".$CI->p_c->cekaktif($row->keu_form)."<br/>Asesmen:".$CI->p_c->cekaktif($row->keu_assessment)."</td>";
                          //echo "<td align=''>".$CI->p_c->cekaktif($row->keu_assessment)."</td>";
                          echo "<td align=''>".$CI->p_c->cekaktif($row->keu_up)."</td>";
                          echo "<td align=''>".$CI->p_c->cekaktif($row->aktif)."</td>";
                          echo "<td align=''>Lulus: ".$CI->p_c->cekaktif($row->lulus)."<br/>Kelas: ".$row->calonkelastext."<br/>Tgl:".$CI->p_c->tgl_indo($row->tanggal_masuk)."</td>";
                          echo "<td align=''>".$CI->p_c->cekaktif($row->verifikasi)."</td>";
                          /*
                          echo "<td align='center'>";
                          echo "<a href=javascript:void(window.open('".site_url('psb_calonsiswa/ubahaktif/'.$row->replid.'/'.!($row->aktif))."')) >".$CI->p_c->cekaktif($row->aktif)."</a>";
                          echo "</td>";
                          */
                          /*
											    echo "<td align='center'>";
                          if ($row->replidsiswa==""){
											    		echo "<a href=javascript:void(window.open('".site_url('psb_calonsiswa/ubah/'.$row->replid)."')) class='btn btn-xs btn-warning fa fa-check-square' ></a>&nbsp;&nbsp;";
                              //echo "<a href=javascript:void(window.open('".site_url('psb_calonsiswa/hapus/'.$row->replid)."')) class='btn btn-xs btn-danger fa fa-minus-square' ></a> ";
                          }
											    echo "</td>";
                          */
                          echo "<td align='center'>";
                          if($row->replidsiswa<>""){
                            echo "<a href=javascript:void(window.open('".site_url('general/datasiswa/'.$row->replidsiswa)."')) >".$row->nis."</a>";
                          }
											    echo "</td>";
											    echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";
    ?>
</center>
</body>
