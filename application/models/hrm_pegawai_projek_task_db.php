<?php

Class hrm_pegawai_projek_task_db extends CI_Model {
public function __construct() {
parent::__construct();
	$this->load->library('dbx');
}
    // Read data from database to show data in admin page
		public function data() {
				$cari="";
				if (($this->input->post('periode1')<>"") AND ($this->input->post('periode2')=="")){
					$cari=$cari." AND pp.tanggalmulai >= '".$this->p_c->tgl_db($this->input->post('periode1'))."' ";
				}
				if (($this->input->post('periode1')=="") AND ($this->input->post('periode2')<>"")){
					$cari=$cari." AND pp.tanggalmulai <= '".$this->p_c->tgl_db($this->input->post('periode2'))."' ";
				}
				if (($this->input->post('periode1')<>"") AND ($this->input->post('periode2')<>"")){
					$cari=$cari." AND pp.tanggalmulai BETWEEN '".$this->p_c->tgl_db($this->input->post('periode1'))."' AND '".$this->p_c->tgl_db($this->input->post('periode2'))."' ";
				}

				if ($this->input->post('filter')<>1){
						//$cari=$cari." AND pp.tanggalakhir>=CURRENT_DATE() ";
						$cari=$cari." AND pp.aktif=1 AND ppt.aktif=1 ";
				}
					// WHERE pp.aktif=1 AND (pp.created_by='". $this->session->userdata('idpegawai')."' OR pp.created_by='". $this->session->userdata('idpegawai')."') ".$cari."
	      	$sql="SELECT ppt.*
												,DATEDIFF(ppt.tanggalakhir,ppt.tanggalmulai) as lama
												,(SELECT COUNT(replid) FROM hrm_pegawai_daily WHERE idprojektask=ppt.replid) as jumlahkegiatan
												,pp.projek as projektext
								FROM hrm_pegawai_projek_task ppt
								LEFT JOIN hrm_pegawai_projek pp ON pp.replid=ppt.idprojek
								WHERE pp.replid<>1
								ORDER BY tanggalmulai,pp.projek ";
								$data['show_table']=$this->dbx->data($sql);
								return $data;
		}

    //TAMBAH
    //-------------------------------------------------------------------------------------------
    public function tambah_x($id='',$data) {
    		$sql="SELECT *
      			FROM hrm_pegawai_projek_task ppt
      			WHERE ppt.replid='".$id."'";
        $data['isi'] = $this->dbx->rows($sql);

				if ($data['isi']== NULL ) {
	        unset($data['isi']);
	        $sql="SELECT ".$this->dbx->tablecolumn('hrm_pegawai_projek_task').",YEAR(CURRENT_DATE()) as tahun,CURRENT_DATE() as tanggalmulai,
								CURRENT_DATE() as tanggalakhir,1 as aktif,1 as frekuensi";
	        $data['isi']=$this->dbx->rows($sql);
	      }
				$data['idprojek_opt'] = $this->dbx->opt("SELECT replid,projek as nama FROM hrm_pegawai_projek WHERE replid<>1 AND aktif=1 ORDER BY nama","up");
				$data['idbulan_opt'] = $this->p_c->arraybulan();
				$data['idpegawai_opt'] = $this->dbx->opt("SELECT replid, nama FROM pegawai WHERE (aktif=1 OR replid='".$data['isi']->idpj."' OR replid='".$data['isi']->idmonev."')  ORDER BY nama","up");

				$sql="SELECT j.replid,j.jabatan as nama
															FROM hrm_jabatan j
													WHERE j.aktif=1
													ORDER BY j.jabatan";
				//$data['idrole_opt'] = $this->dbx->data($sql);
				$sql="SELECT replid,nama
															FROM pegawai p
													WHERE p.aktif=1
													ORDER BY p.nama";
				$data['idpegawai_opt'] = $this->dbx->data($sql);
				$data['idpegawairows']=$this->dbx->rowscsv("SELECT replid as var FROM hrm_pegawai_projek_task_peserta WHERE idhrm_pegawai_projek_task='".$id."'");
				return $data;
    }



	public function hapus_db($id) {
	    // Query to check whether username already exist or not
	    $this->db->where('replid',$id);
	    $this->db->delete('hrm_pegawai_projek_task');

	    $this->db->where('idhrm_pegawai_projek_task',$id);
	    $this->db->delete('hrm_jabatan_hrm_pegawai_projek_task');


	    if ($this->db->_error_number() == 0) {
	    	return true;
	    } else {
	        return false;
	    }
    }

	 public function importpeserta_db($id,$idrole) {
 		$idrolex=explode(',',$idrole);
 		$filterrole="";
 		foreach($idrolex as $idroleexplode){
 			if ($filterrole<>""){
 					$filterrole= $filterrole." OR find_in_set(".$idroleexplode.",l.role_id) ";
 			}else{
 					$filterrole=" find_in_set(".$idroleexplode.",l.role_id) ";
 			}
 		}
 		if ($filterrole<>""){
 				$filterrole=" AND (".$filterrole.") ";
 		}

 		/*
 		$data['hrm_pegawai_projek_task_peserta2'] = $this->dbx->data("SELECT p.replid,CONCAT(p.nama,' [',p.nip,']') as nama,0 as checked
 																										FROM pegawai p
 																										INNER JOIN login l ON p.replid=l.idpegawai
 																										WHERE p.aktif=1 ".$filterrole." ORDER BY p.nama");
 		*/
 		$sqldelete="DELETE FROM hrm_pegawai_projek_task_peserta WHERE idhrm_pegawai_projek_task='".$id."'";
 		$this->db->query($sqldelete);
 		$sql="INSERT INTO hrm_pegawai_projek_task_peserta(idhrm_pegawai_projek_task,idpegawai,wajib)
 					(SELECT '".$id."',p.replid,1 FROM pegawai p
 						INNER JOIN login l ON p.replid=l.idpegawai
 						WHERE p.aktif=1 AND l.aktif=1 AND p.replid NOT IN (SELECT idpegawai FROM hrm_pegawai_projek_task_peserta WHERE idhrm_pegawai_projek_task='".$id."' ) ".$filterrole." )";
 		//echo $sql;die;
 		return $this->db->query($sql);
 	}

	public function ubahwajib_db($data,$id,$idx) {
		//echo var_dump($data);die;
		$this->db->where('idhrm_pegawai_projek_task',$id);
		$this->db->where('idpegawai',$idx);
		$this->db->update('hrm_pegawai_projek_task_peserta', $data);
		if ($this->db->_error_number() == 0) {
		  return true;
		} else {
		  return false;
		}
	}

	public function hrmeventpesertahapus_db($id,$idx) {
		// Query to check whether username already exist or not
		$this->db->where('idhrm_pegawai_projek_task',$id);
		$this->db->where('idpegawai',$idx);
		$this->db->delete('hrm_pegawai_projek_task_peserta');
		if ($this->db->_error_number() == 0) {
			return true;
		} else {
				return false;
		}
	}

	 public function view_db($id,$data) {
			 $sql="SELECT ppt.*
										 ,DATEDIFF(ppt.tanggalakhir,ppt.tanggalmulai) as lama
										 ,(SELECT COUNT(replid) FROM hrm_pegawai_daily WHERE idprojektask=ppt.replid) as jumlahkegiatan
										 ,pp.projek as projektext
						 FROM hrm_pegawai_projek_task ppt
						 INNER JOIN hrm_pegawai_projek pp ON pp.replid=ppt.idprojek
						 WHERE ppt.replid=".$id."
						 ORDER BY tanggalmulai";
				//echo $sql;die;
				$data['isi']=$this->dbx->rows($sql);
				$data['minggu']=$this->dbx->data("SELECT * FROM hrm_pegawai_projek_task_jadwal WHERE idprojek_task='".$id."'");
				$data['minggurow']=$this->dbx->data("SELECT CONCAT(bulan,'.',minggu) as isi FROM hrm_pegawai_projek_task_jadwal WHERE idprojek_task='".$id."'");
				$data['hrm_pegawai_projek_task_peserta'] = $this->dbx->data("SELECT ep.*,p.replid as idpeserta
																												FROM hrm_pegawai_projek_task_peserta ep
																												INNER JOIN pegawai p ON p.replid=ep.idpegawai
																												WHERE ep.idhrm_pegawai_projek_task='".$id."' ORDER BY p.nama");
			  return $data;
	 }
}
?>
