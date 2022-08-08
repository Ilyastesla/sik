<?php

Class hrm_pegawai_daily_set_db extends CI_Model {
public function __construct() {
parent::__construct();
	$this->load->library('dbx');
}
    // Read data from database to show data in admin page
    public function data() {
			$cari="";
			/*
			if (($this->input->post('periode1')<>"")){
				$cari=$cari." AND pd.tanggal = '".$this->p_c->tgl_db($this->input->post('periode1'))."' ";
			}else{
				$cari=$cari." AND pd.tanggal = CURRENT_DATE() ";
			}
      */

    	$sql="SELECT pd.*,ppt.projektask as projektasktext,pp.projek as projektext
										,TIME_FORMAT(jammulai,'%H:%i') as jammulai
										,TIME_FORMAT(jamakhir,'%H:%i') as jamakhir
										,TIME_FORMAT(durasi,'%H:%i') as durasi
										,TIME_FORMAT(TIMEDIFF(jamakhir,jammulai),'%H:%i') as lama
										,r.nama as kegiatantipetext
										,(SELECT COUNT(replid) FROM hrm_pegawai_daily WHERE idreff=pd.replid) as pakai
						FROM hrm_pegawai_daily_set pd
						LEFT JOIN hrm_pegawai_projek_task ppt ON ppt.replid=pd.idprojektask
						LEFT JOIN hrm_pegawai_projek pp ON pp.replid=ppt.idprojek
						LEFT JOIN hrm_reff r ON r.replid=pd.idkegiatantipe
						WHERE pd.idpegawai='". $this->session->userdata('idpegawai')."' AND pd.aktif=1 
						".$cari."
						ORDER BY jammulai";

			//echo $sql;die;
    	$data['show_table']=$this->dbx->data($sql);
			return $data;
    }


    //TAMBAH
    //-------------------------------------------------------------------------------------------
    public function tambah_x($id='',$data) {
    	$data['id']=$id;
    	$sql="SELECT kk.*,DATE_FORMAT(jammulai,'%H:%i') as jammulai
      			 					,DATE_FORMAT(jamakhir,'%H:%i') as jamakhir
											,TIME_FORMAT(durasi,'%H:%i') as durasi
          			FROM hrm_pegawai_daily_set kk
          			WHERE kk.replid='".$id."'";
      $data['isi'] = $this->dbx->rows($sql);

      if ($data['isi']== NULL ) {
        unset($data['isi']);
        $sql="SELECT ".$this->dbx->tablecolumn('hrm_pegawai_daily_set').",TIME_FORMAT(CURRENT_TIME(),'%H:%i') as jammulai
	      			 					,'00:00' as jamakhir
												,'00:00' as durasi,1 as aktif";
        $data['isi']=$this->dbx->rows($sql);
      }
			$data['idprojektask_opt'] = $this->dbx->opt("SELECT ppt.replid,CONCAT('[',pp.projek,'] ',ppt.projektask) as nama
																											FROM hrm_pegawai_projek_task ppt
																											LEFT JOIN hrm_pegawai_projek pp ON pp.replid=ppt.idprojek
																									WHERE pp.aktif=1
																									AND (ppt.replid IN (SELECT DISTINCT idhrm_pegawai_projek_task FROM hrm_pegawai_projek_task_peserta WHERE idpegawai='". $this->session->userdata('idpegawai')."') OR forall=1)
																									ORDER BY projektask",'none');

				$data['idkegiatantipe_opt'] = $this->dbx->opt("SELECT replid,nama as nama FROM hrm_reff WHERE type='hrm_pegawai_daily' ORDER BY nama",'none');
        return $data;
    }
}
?>
