<?php

Class hrm_pegawai_report_db extends CI_Model {
public function __construct() {
parent::__construct();
	$this->load->library('dbx');
}
    // Read data from database to show data in admin page
    public function data() {
			$cari="";
			if (($this->input->post('periode1')<>"") AND ($this->input->post('periode2')=="")){
				$cari=" AND pd.tanggal >= '".$this->p_c->tgl_db($this->input->post('periode1'))."' ";
			}
			if (($this->input->post('periode1')=="") AND ($this->input->post('periode2')<>"")){
				$cari=" AND pd.tanggal <= '".$this->p_c->tgl_db($this->input->post('periode2'))."' ";
			}
			if (($this->input->post('periode1')<>"") AND ($this->input->post('periode2')<>"")){
				$cari=" AND pd.tanggal BETWEEN '".$this->p_c->tgl_db($this->input->post('periode1'))."' AND '".$this->p_c->tgl_db($this->input->post('periode2'))."' ";
			}
      if (($this->input->post('periode1')=="") AND ($this->input->post('periode2')=="")){
        $cari=" AND pd.tanggal = DATE_FORMAT(CURRENT_DATE(),'%Y-%m-%d')";
      }
      $groupby=" tanggal, idpegawai ";
      if($this->input->post('groupby')<>""){
        $groupby=$this->input->post('groupby');
      }
    	$sql="SELECT pd.idpegawai,pd.tanggal
                ,SEC_TO_TIME( SUM( TIME_TO_SEC(pd.durasi) ) ) AS timesum
                ,TIMEDIFF('07:30:00',SEC_TO_TIME( SUM( TIME_TO_SEC(pd.durasi) ) )) as lenggang
                ,SUM(bantuan) as jmlbantuan
                ,SUM(selesai) as jmlselesai
                ,COUNT(DISTINCT(tanggal)) as jmlhari
								,DATE_FORMAT(tanggal,'%Y-%m-%d') as tanggal
            FROM hrm_pegawai_daily pd
						INNER JOIN login l ON pd.idpegawai=l.idpegawai
						WHERE l.idcompany='".$this->session->userdata('idcompany')."'
            ".$cari."
            GROUP BY ".$groupby."
            ORDER BY tanggal";
      //echo $sql;die;
			$data['show_table']=$this->dbx->data($sql);
			return $data;
    }

		public function showdailypegawai_db($idpegawai,$tanggal) {
			$sql="SELECT pd.*,ppt.projektask as projektasktext,pp.projek as projektext
										,TIME_FORMAT(jammulai,'%H:%i') as jammulai
										,TIME_FORMAT(jamakhir,'%H:%i') as jamakhir
										,TIME_FORMAT(durasi,'%H:%i') as durasi
										,r.nama as kegiatantipetext
										,DATE_FORMAT(CURRENT_DATE(),'%Y-%m-%d') as hariini
										,DATE_FORMAT(tanggal,'%Y-%m-%d') as tanggal
						FROM hrm_pegawai_daily pd
						LEFT JOIN hrm_pegawai_projek_task ppt ON ppt.replid=pd.idprojektask
						LEFT JOIN hrm_pegawai_projek pp ON pp.replid=ppt.idprojek
						LEFT JOIN hrm_reff r ON r.replid=pd.idkegiatantipe
						WHERE pd.idpegawai='".$idpegawai."' AND pd.tanggal='".$tanggal."'
						ORDER BY tanggal,jammulai";
			$data['show_table']=$this->dbx->data($sql);
			return $data;
    }
}
?>
