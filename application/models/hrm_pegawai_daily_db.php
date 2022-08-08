<?php

Class hrm_pegawai_daily_db extends CI_Model {
public function __construct() {
parent::__construct();
	$this->load->library('dbx');
}
    // Read data from database to show data in admin page
    public function data() {
			$cari="";
			/*
			if (($this->input->post('periode1')<>"") AND ($this->input->post('periode2')=="")){
				$cari=$cari." AND pd.tanggal >= '".$this->p_c->tgl_db($this->input->post('periode1'))."' ";
			}
			if (($this->input->post('periode1')=="") AND ($this->input->post('periode2')<>"")){
				$cari=$cari." AND pd.tanggal <= '".$this->p_c->tgl_db($this->input->post('periode2'))."' ";
			}
			if (($this->input->post('periode1')<>"") AND ($this->input->post('periode2')<>"")){
				$cari=$cari." AND pd.tanggal BETWEEN '".$this->p_c->tgl_db($this->input->post('periode1'))."' AND '".$this->p_c->tgl_db($this->input->post('periode2'))."' ";
			}
			*/
			$sqldailyset="SELECT DISTINCT(idreff) as isi FROM hrm_pegawai_daily WHERE idpegawai='". $this->session->userdata('idpegawai')."' AND tanggal = CURRENT_DATE() AND idreff<>'' ";
			$dailyset=$this->p_c->arraybreak($this->dbx->data($sqldailyset),',');
			$dailysetfilter="";
			if($dailyset<>""){
				$dailysetfilter=" AND replid NOT IN (".$dailyset.") ";
			}
			if (($this->input->post('periode1')<>"")){
				$cari=$cari." AND pdx.tanggal = '".$this->p_c->tgl_db($this->input->post('periode1'))."' ";
				$table="SELECT pdx.*,0 salin FROM hrm_pegawai_daily pdx WHERE pdx.idpegawai='". $this->session->userdata('idpegawai')."' ".$cari."";
			}else{
				$cari=$cari." AND pdx.tanggal = CURRENT_DATE() ";
				$table="
								SELECT pdx.*,0 salin FROM hrm_pegawai_daily pdx WHERE pdx.idpegawai='". $this->session->userdata('idpegawai')."' ".$cari."
								UNION
								SELECT pds.*,1 salin FROM hrm_pegawai_daily_set pds WHERE pds.aktif=1 AND pds.idpegawai='". $this->session->userdata('idpegawai')."' ".$dailysetfilter."
								";
			}
      /*
			if ($this->input->post('filter')<>1){
					$cari=$cari." AND (pd.aktif=0 OR pd.tanggal=CURRENT_DATE()) ";
			}
			*/

    	$sql="SELECT pd.*,ppt.projektask as projektasktext,pp.projek as projektext
										,TIME_FORMAT(jammulai,'%H:%i') as jammulai
										,TIME_FORMAT(jamakhir,'%H:%i') as jamakhir
										,TIME_FORMAT(durasi,'%H:%i') as durasi
										,r.nama as kegiatantipetext
										,DATE_FORMAT(CURRENT_DATE(),'%Y-%m-%d') as hariini
										,DATE_FORMAT(tanggal,'%Y-%m-%d') as tanggal
						FROM (
							".$table."
						) pd
						LEFT JOIN hrm_pegawai_projek_task ppt ON ppt.replid=pd.idprojektask
						LEFT JOIN hrm_pegawai_projek pp ON pp.replid=ppt.idprojek
						LEFT JOIN hrm_reff r ON r.replid=pd.idkegiatantipe
						ORDER BY tanggal,jammulai";

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
												,DATE_FORMAT(durasi,'%H:%i') as durasi
      			FROM hrm_pegawai_daily kk
      			WHERE kk.replid='".$id."'";
        $data['isi'] = $this->dbx->rows($sql);

				if ($data['isi']== NULL ) {
	        unset($data['isi']);
	        $sql="SELECT ".$this->dbx->tablecolumn('hrm_pegawai_daily').",DATE_FORMAT(CURRENT_TIME(),'%H:%i') as jammulai
		      			 					,'00:00' as jamakhir
													,'00:00' as durasi,1 as aktif";
	        $data['isi']=$this->dbx->rows($sql);
	      }
				$data['idprojektask_opt'] = $this->dbx->opt("SELECT ppt.replid,CONCAT('[',pp.projek,'] ',ppt.projektask) as nama
																											FROM hrm_pegawai_projek_task ppt
																											LEFT JOIN hrm_pegawai_projek pp ON pp.replid=ppt.idprojek
																									WHERE pp.aktif=1
																									AND (ppt.replid IN (SELECT DISTINCT idhrm_pegawai_projek_task FROM hrm_pegawai_projek_task_peserta WHERE idpegawai='". $this->session->userdata('idpegawai')."') OR ppt.replid=1)
																									ORDER BY projektask",'none');

				$data['idkegiatantipe_opt'] = $this->dbx->opt("SELECT replid,nama as nama FROM hrm_reff WHERE type='hrm_pegawai_daily' ORDER BY nama",'none');
        return $data;
    }

	 public function copydaily_db($id) {
		 $sql="UPDATE hrm_pegawai_daily SET idreff='".$id."' WHERE idreff='' ";
		 $this->db->query($sql);

		 $sql="	INSERT INTO hrm_pegawai_daily(kegiatan,tanggal,deskripsi,jammulai,jamakhir,durasi,idprojektask,idpegawai,idkegiatantipe,aktif,idreff,selesai
			 									,created_date,created_by,modified_date,modified_by)
				 SELECT kegiatan,DATE_FORMAT(CURRENT_DATE(),'%Y-%m-%d'),deskripsi,jammulai,jamakhir,durasi,idprojektask,'".$this->session->userdata('idpegawai')."',idkegiatantipe,0,'".$id."',1
				 ,CURRENT_DATE(),'".$this->session->userdata('idpegawai')."',CURRENT_DATE(),'".$this->session->userdata('idpegawai')."'
				 FROM hrm_pegawai_daily_set
				 WHERE replid='".$id."'";
		 $this->db->query($sql);
		 $insert_id = $this->db->insert_id();
		 if ($this->db->_error_number() == 0) {
			 return $insert_id;
		 } else {
				 return false;
		 }
	 }
}
?>
