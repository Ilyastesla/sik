<?php

Class budget_pendapatan_db extends CI_Model {
public function __construct() {
parent::__construct();
	$this->load->library('dbx');
}
    // Read data from database to show data in admin page
    public function data() {
      	$sql="SELECT distinct tahun
              FROM budget_pendapatan
              ORDER BY tahun";
      	return $this->dbx->data($sql);
    }


    //TAMBAH
    //-------------------------------------------------------------------------------------------
    public function tambah_x($id='',$data) {
    	$data['id']=$id;
      	$sql="SELECT *
      			FROM budget_pendapatan kk
      			WHERE kk.replid='".$id."'";
        $data['isi'] = $this->dbx->rows($sql);

        if ($data['isi']== NULL ) {
        	unset($data['isi']);
					$sql="SELECT ".$this->dbx->tablecolumn('budget_pendapatan')." ,1 as aktif";
        	$data['isi']=$this->dbx->rows($sql);
        }
				$type_arr= array(""=>"Pilih...","jenis_pendapatan"=>"jenis_pendapatan","jenis_biaya"=>"jenis_biaya");
        $data['idjenis_pendapatan_opt'] = $this->dbx->data("SELECT replid,budget_reff FROM budget_reff WHERE aktif=1 AND type='jenis_pendapatan' ORDER BY urutan");

        $sqltingkat="SELECT ks.replid as idkelompok,t.replid as idtingkat ,REPLACE(REPLACE(ks.kelompok, '<i>',''),'</i>','') as kelompoktext,CONCAT(t.departemen,' Tingkat ',t.tingkat) as tingkat
                        ,(
                          SELECT COUNT(s.replid) as isi
                              FROM siswa s
                              INNER JOIN kelas k ON k.replid=s.idkelas
                              INNER JOIN tahunajaran ta ON ta.replid=k.idtahunajaran
                              INNER JOIN tingkat tx ON tx.replid=k.idtingkat
                              INNER JOIN kelompoksiswa ksx ON ksx.replid=k.kelompok_siswa
                              WHERE ta.aktif=1 AND tx.replid=t.replid AND ksx.replid=ks.replid
                        ) as jmlsiswasistem
                      FROM tingkat t
                      INNER JOIN kelompoksiswa ks ON t.departemen=ks.departemen
                      WHERE t.aktif=1 AND ks.aktif=1
                      ORDER BY ks.kelompok,t.urutan";
        $data['idtingkat_opt'] = $this->dbx->data($sqltingkat);
				$data['type_opt'] = $type_arr;
        return $data;
    }

    public function jenis_biaya($var){
      $sql="SELECT *
          FROM budget_reff
          WHERE type='jenis_biaya' AND idhead='".$var."' ORDER BY urutan";
      return $this->dbx->data($sql);
    }

}
?>
