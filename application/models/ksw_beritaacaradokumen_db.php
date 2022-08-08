<?php

Class ksw_beritaacaradokumen_db extends CI_Model {
	public function __construct() {
		parent::__construct();
		$this->load->library('dbx');
	}

    // Read data from database to show data in admin page
    public function data() {
			$cari="";
			if ($this->input->post('nama')<>""){
					$cari=$cari." AND s.nama like '%".$this->input->post('nama')."%' ";
			}
			if ($this->input->post('iddepartemen')<>""){
				$cari=$cari." AND ta.departemen='".$this->input->post('iddepartemen')."' ";
			}
			if ($this->input->post('idtahunajaran')<>""){
				$cari=$cari." AND ta.replid='".$this->input->post('idtahunajaran')."' ";
			}
      if ($this->input->post('idjenisdokumen')<>""){
				$cari=$cari." AND sr.replid='".$this->input->post('idjenisdokumen')."' ";
			}

      if ($this->input->post('idtipe')<>""){
				$cari=$cari." AND sr2.replid='".$this->input->post('idtipe')."' ";
			}

			if (($this->input->post('periode1')<>"") AND ($this->input->post('periode2')=="")){
        $cari=$cari." AND bapd.tanggal >= '".$this->p_c->tgl_db($this->input->post('periode1'))."' ";
      }
      if (($this->input->post('periode1')=="") AND ($this->input->post('periode2')<>"")){
        $cari=$cari." AND bapd.tanggal <= '".$this->p_c->tgl_db($this->input->post('periode2'))."' ";
      }
      if (($this->input->post('periode1')<>"") AND ($this->input->post('periode2')<>"")){
        $cari=$cari." AND bapd.tanggal BETWEEN '".$this->p_c->tgl_db($this->input->post('periode1'))."' AND '".$this->p_c->tgl_db($this->input->post('periode2'))."' ";
      }
			if ($cari==""){
				$cari=$cari." AND s.replid IS NULL ";
			}

      $sql="SELECT bapd.*, s.nis,s.nama,sr.nama as jenisdokumentext,sr2.nama as tipetext,k.kelas as kelastext,ta.tahunajaran as tahunajarantext 
            FROM ksw_beritaacaradokumen bapd
            INNER JOIN siswa s ON s.replid=bapd.idsiswa
						INNER JOIN kelas k ON k.replid=s.idkelas
						INNER JOIN tahunajaran ta ON k.idtahunajaran=ta.replid
            INNER JOIN siswa_reff sr ON sr.replid=bapd.idjenisdokumen
            INNER JOIN siswa_reff sr2 ON sr2.replid=bapd.idtipe
            WHERE ta.departemen IN (".$this->dbx->sessionjenjangtext().")
            ".$cari."
          ORDER BY bapd.tanggal";
			//echo $sql;
      $data['show_table']=$this->dbx->data($sql);
			$data['iddepartemen_opt'] = $this->dbx->opt("SELECT departemen as replid,departemen as nama FROM departemen WHERE aktif=1 AND replid IN (".$this->session->userdata('dept').") ORDER BY urutan",'up');
			$data['idtahunajaran_opt'] = $this->dbx->opt("SELECT replid,CONCAT('[',departemen,'] ',tahunajaran) as nama FROM tahunajaran WHERE idcompany='".$this->session->userdata('idcompany')."' AND departemen='".$this->input->post('iddepartemen')."' ORDER BY aktif DESC ,nama DESC ",'up');
			$data['idjenisdokumen_opt'] = $this->dbx->opt("SELECT replid, nama FROM siswa_reff WHERE aktif=1 AND type='jenisdokumen' ORDER BY nama",'up');
      $data['idtipe_opt'] = $this->dbx->opt("SELECT replid, nama FROM siswa_reff WHERE aktif=1 AND type='tipeterimabap' ORDER BY nama",'up');
			return $data;
		}
}

?>
