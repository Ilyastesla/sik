<?php 
$this->load->view('headerprint_v');

$CI =& get_instance();
if ($excel==1){
	header('Content-Type: application/vnd.ms-excel'); //IE and Opera
	header('Content-Type: application/x-msexcel'); // Other browsers
	header('Content-Disposition: attachment; filename=beritaacara.xls');
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
<style>
    h3,h4 {
        line-height: 0px !important;
    }
</style>
<body>
    <?php $CI->dbx->getkopsuratcompany($isi->idcompany); ?>
    <center>
    <b><h3><u><?php echo $form ?></u></h3>Nomor: <?php echo $isi->kode_transaksi ?><br/><br/></b>
    <p align="justify"><?php echo "Pada hari ini ".$CI->p_c->hari_indo($isi->namahari)." tanggal ".$CI->p_c->tgl_indo($isi->tanggaltransaksi)." dilaporkan oleh Staff Pengadaan dan Gudang, bahwa terdapat barang-barang yang mengalami perubahan diantaranya pergantian departemen, pergantian penanggung jawab, pergantian ruangan dan pergantian kondisi. <br/>Rincian tertera pada tabel di bawah ini:" ?></p>
    <table class="tablecontent tablecontent_">
            <thead>
                <tr>
                    <th width='50'>No.</th>
                    <th>Kode Inventaris</th>
                    <th>Material</th>
                    <th>Kelompok Barang</th>
                    <th>Departemen</th>
                    <th>Penanggung Jawab</th>
                    <th>Ruangan</th>
                    <th>Kondisi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $jml_c=0;$no=1;$stock=0;
                if (!empty($material)){
                    foreach($material as $row) {
                        echo "<tr>";
                        echo "<td align='center'>".$no++."</td>";
                        echo "<td align='center'>".$row->kode_inventaris."</td>";
                        echo "<td align=''>".$row->materialtext."</td>";
                        echo "<td align=''>".$row->kelompokmaterialtext."</td>";
                        echo "<td align='left'>Dari: ".$row->departementext_lama."<br/>Menjadi: ".$row->departementext."</td>";
                        echo "<td align='left'>Dari: ".$row->pegawaitext_lama."<br/>Menjadi: ".$row->pegawaitext."</td>";
                        echo "<td align='left'>Dari: ".$row->ruangtext_lama."<br/>Menjadi: ".$row->ruangtext."</td>";
                        echo "<td align='left'>Dari: ".$row->kondisitext_lama."<br/>Menjadi: ".$row->kondisitext."</td>";
                        echo "</tr>";
                    }
                }
                ?>
            </tbody>
            <tfoot>
            </tfoot>
        </table><br/>
        <p align="left"><?php 
        if($isi->keterangan<>""){
            echo "<b>Catatan:</b> ".$isi->keterangan."<br/><br/>";
        }
        echo "Setelah dilakukan pemeriksaan oleh Bagian Gudang Pengadaan Barang dan Jasa ternyata barang-barang tersebut berada dalam kondisi sesuai dengan tabel diatas.<br/>";
        echo "Demikian berita acara ini dibuat untuk diketahui pihak terkait. " ?></p><br/>
        <table class="tablecontent">
            <tr><td align='right' colspan=2><?php echo $isi->citycompanytext.', '.$CI->p_c->tgl_indo($isi->hariini) ?></td></tr>
            <tr align='center'><td width="50%">Yang Menyatakan</td><td>Manajer Umum</td></tr>
            <tr><td  height='80px'></td><td></td></tr>
            <tr align='center'><td><b><?php echo $CI->dbx->getpegawai($isi->idstaffgudang)?></b><hr/>Staff Pengadaan dan Gudang</td><td><b><?php echo $CI->dbx->getpegawai($isi->idmanajerumum)?></b><hr/>Manajer Umum</td></tr>
        </table>
    </center>
</body>
</html>
