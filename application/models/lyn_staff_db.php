<?php

Class lyn_staff_db extends CI_Model {
	public function __construct() {
		parent::__construct();
		$this->load->library('dbx');
	}

    // Read data from database to show data in admin page
    public function data() {
      	$sql="SELECT p.*
			    FROM pegawai p 
                INNER JOIN login l ON l.idpegawai=p.replid 
				WHERE p.aktif=1 AND l.aktif=1 AND 67 IN (l.role_id)
			    ORDER BY p.nama";
      	return $this->dbx->data($sql);
    }

     //TAMBAH
    public function tambah_db($id='',$data) {
    	$data['id']=$id;
      	$sql="SELECT *
      			FROM pegawai
      			WHERE replid='".$id."'";
        $data['isi'] = $this->dbx->rows($sql);
		
		$sql="SELECT l.replid,UPPER(l.layanan) as nama,(SELECT 1 FROM lyn_pegawai_layanan WHERE idlayanan=l.replid) as 'checked' FROM lyn_layanan l WHERE l.aktif=1 ORDER BY layanan ";
		$data['idlayanan_opt'] = $this->dbx->data($sql,'none');

		$sql="SELECT l.replid,UPPER(l.grupjadwal) as nama,(SELECT 1 FROM lyn_pegawai_grupjadwal WHERE idgrupjadwal=l.replid) as 'checked' FROM lyn_grupjadwal l WHERE l.aktif=1 ORDER BY grupjadwal ";
		$data['idgrupjadwal_opt'] = $this->dbx->data($sql,'none');

		$sql="SELECT l.replid,UPPER(l.sektor) as nama,(SELECT 1 FROM lyn_pegawai_sektor WHERE idsektor=l.replid) as 'checked' FROM lyn_sektor l WHERE l.aktif=1 ORDER BY sektor ";
		$data['idsektor_opt'] = $this->dbx->data($sql,'none');

        return $data;
  }
}

?>
