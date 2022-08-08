<?php

Class reff_user_db extends CI_Model {
	public function __construct() {
	parent::__construct();
		$this->load->library('dbx');
	}

    // Read data from database to show data in admin page
    public function data() {
				$cari="";
				/*
				if($this->input->post('idcompany')=="11"){
						$cari .= " AND LEFT(p.nip,2) IN (11,22,77)";
				}else if($this->input->post('idcompany')=="12"){
						$cari .= " AND LEFT(p.nip,2) IN (12,23)";
				}else{
					$cari .= " AND LEFT(p.nip,2)='".$this->input->post('idcompany')."' ";
				}
				*/
				$cari .= " AND p.idcompany='".$this->input->post('idcompany')."' ";
				
				if ($this->input->post('aktif')<>""){
					$cari=$cari." AND l.aktif='".$this->input->post('aktif')."' ";
				}else{
					$cari=$cari." AND l.aktif='1' ";
				}

      			$sql = "select p.nama,p.nip,p.aktif as status_pegawai,c.nama as companytext, l.*
						FROM login l
						LEFT JOIN pegawai p ON l.idpegawai=p.replid
								LEFT JOIN hrm_company c ON c.replid=l.idcompany
								WHERE login<>'sa' ".$cari."
						";
				$data['show_table']=$this->dbx->data($sql);
				$companyrow=$this->session->userdata('idcompany');
				//$sqlcompany="SELECT kodecabang as replid,nama as nama FROM hrm_company WHERE replid IN (".$companyrow.") AND aktif=1 ORDER BY nama";
				$sqlcompany="SELECT replid,nama as nama FROM hrm_company WHERE replid IN (".$companyrow.") AND aktif=1 ORDER BY nama";
				$data['idcompany_opt'] = $this->dbx->opt($sqlcompany,'up');
				$data['aktif_opt'] = array(''=>'Pilih..','1'=>'Aktif','0'=>'Tidak');
				return $data;
    }

  //---------------------------------------------------------------------------------------------------------
	//------------------------------------------------------------------------------------------ INDEX
	//---------------------------------------------------------------------------------------------------------
	public function ubahuser_db($id_user,$data) {
    	$sql="select l.*,p.nama,p.nip,CONCAT(p.replid,'|',p.nip) as idnip,p.replid as iduser
						FROM login l
      			INNER JOIN pegawai p ON l.login=p.nip
      			WHERE l.replid='".$id_user."'";
			//echo $sql;die;
			$data['isi']=$this->dbx->rows($sql);
			if ($data['isi']== NULL ) {
				unset($data['isi']);
				$sql="SELECT ".$this->dbx->tablecolumn('login').",null as nip ,1 as aktif ";
				$data['isi']=$this->dbx->rows($sql);
			}

			$companypegawairow=$this->dbx->singlerow("SELECT idcompany as isi FROM login WHERE idpegawai='".$this->session->userdata('idpegawai')."'");
			
			//$sqlcompany="SELECT kodecabang as replid,nama as nama FROM hrm_company WHERE replid IN (".$companyrow.") AND aktif=1 ORDER BY nama";
			$sqlcompanypegawai="SELECT replid,nama as nama FROM hrm_company WHERE replid IN (".$companypegawairow.") AND aktif=1 ORDER BY nama";
				
			$data['idcompanypegawai_opt'] = $this->dbx->opt($sqlcompanypegawai,'up');

			$data['idcompany_opt'] = $this->dbx->data("SELECT replid,nama as nama FROM hrm_company ORDER BY nama",'up');

			$sqlpeg="SELECT * FROM pegawai WHERE replid='".$this->session->userdata('idpegawai')."'";
			$data['isipeg']=$this->dbx->rows($sqlpeg);

    	$data['nip_opt'] = $this->dbx->opt("SELECT CONCAT(replid,'|',nip) as replid,CONCAT(nama,' [',nip,']') as nama FROM pegawai
    										WHERE aktif=1
    										AND replid NOT IN (SELECT idpegawai FROM login)
    										ORDER BY nama",'up');

    	$data['role_opt'] = $this->dbx->data("SELECT replid,UPPER(role) as nama FROM role WHERE aktif=1 ORDER BY role ",'up');
    	$data['departemen_opt'] = $this->dbx->data("SELECT replid,departemen as nama FROM departemen WHERE aktif=1 ORDER BY urutan",'up');
    	//$data['matpel_opt'] = $this->dbx->data("SELECT replid,UPPER(CONCAT('[',iddepartemen,'] ',matpel)) as nama FROM ns_matpel WHERE aktif=1 ORDER BY iddepartemen,matpel",'up');
    	//$data['kelas_opt'] = $this->dbx->data("SELECT k.replid,UPPER(CONCAT(t.tingkat,' - ',k.kelas)) as nama FROM kelas k
			//																													INNER JOIN tahunajaran ta ON k.idtahunajaran=ta.replid
			//																													INNER JOIN tingkat t ON k.idtingkat=t.replid
			//																													WHERE ta.aktif=1 ORDER BY CONVERT(SUBSTRING_INDEX(t.tingkat,'-',-1),UNSIGNED INTEGER),k.kelas",'up');
    	return $data;
    }

}

?>
