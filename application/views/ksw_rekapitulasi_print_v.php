<?php 
$this->load->view('headerprint_v');

$CI =& get_instance();
if ($excel==1){
	header('Content-Type: application/vnd.ms-excel'); //IE and Opera
	header('Content-Type: application/x-msexcel'); // Other browsers
	header('Content-Disposition: attachment; filename=rekapitulasipesdik'.$this->input->post('siswa_backup').'.xls');
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
    <?php $CI->dbx->getkopsuratcompany($this->input->post('idcompany'),$excel); ?>
    <center>
    <?php 
        if($this->input->post('siswa_backup')<>""){
            echo "<b><h3></h3>Cadangan: ".$this->input->post('siswa_backup')."<br/><br/></b>";
        }
    ?>
    
    <table class="tablecontent tablecontent_">
            <thead>
                <tr>
                <?php
                    echo "<th width='50' >No</th>";
                    echo "<th>Tahun Ajaran</th>";
                    echo "<th>Jenjang</th>";
                    echo "<th>Tingkat</th>";
                    echo "<th>Jurusan</th>";
                    echo "<th>Regional</th>";
                    echo "<th>Kelompok Siswa</th>";
                    echo "<th>Kapasitas</th>";
                    echo "<th>Jml PD</th>";
                    echo "<th>Jml PD ABK</th>";
                    echo "<th>Kuota</th>";
                    ?>
                </tr>
            </thead>
            <tbody>
            <?php
                                        	$CI =& get_instance();$no=1;
                                          $kapasitastotal=0;$kuotatotal=0;$jmlsiswatotal=0;$jmlsiswaabktotal=0;

											foreach((array)$show_table as $row) {
                          $kuota=$row->totkapasitas-$row->jmlsiswa;
                          $kuotatotal+=$kuota;
                          $kapasitastotal+=$row->totkapasitas;
                          $jmlsiswatotal+=$row->jmlsiswa;
                          $jmlsiswaabktotal+=$row->jmlsiswaabk;
											    echo "<tr>";
											    echo "<td align='center'>".$no++."</td>";
                          echo "<td align='center'>".strtoupper($row->tahunajaran)."</td>";
                          echo "<td align='center'>".strtoupper($row->departemen)."</td>";
                          echo "<td align='center'>".($row->tingkattext)."</td>";
                          echo "<td align='center'>".($row->jurusantext)."</td>";
                          echo "<td align='center'>".($row->regionaltext)."</td>";
                          echo "<td align='center'>".($row->kelompok_siswatext)."</td>";
                          echo "<td align='center'>".($row->totkapasitas)."</td>";
                          echo "<td align='center'>".($row->jmlsiswa)."</td>";
                          echo "<td align='center'>".($row->jmlsiswaabk)."</td>";
                          echo "<td align='center'>".$kuota."</td>";
                          echo "</tr>";
											}
                      echo "<tr>";
                      echo "<td colspan=7>&nbsp;</td>";
                      echo "<td align='center'>".$kapasitastotal."</td>";
                      echo "<td align='center'>".$jmlsiswatotal."</td>";
                      echo "<td align='center'>".$jmlsiswaabktotal."</td>";
                      echo "<td align='center'>".$kuotatotal."</td>";
                      echo "</tr>";
											?>
            </tbody>
            <tfoot>
            </tfoot>
        </table>
    </center>
</body>
</html>
