<?php

Class reff_user_nilai_db extends CI_Model {
	public function __construct() {
	parent::__construct();
		$this->load->library('dbx');
	}

    // Read data from database to show data in admin page
    public function data() {
				//$pieces = explode(" ", $pizza);
				$iddept=explode(',',$this->session->userdata('dept'));
				$filterdept="";
				foreach($iddept as $iddeptexplode){
					if ($filterdept<>""){
							$filterdept= $filterdept." OR find_in_set(".$iddeptexplode.",l.departemen) ";
					}else{
							$filterdept=" find_in_set(".$iddeptexplode.",l.departemen) ";
					}
				}
				if ($filterdept<>""){
						$filterdept=" AND (".$filterdept.") ";
				}
      	$sql = "select p.nama,p.nip,p.aktif as status_pegawai,l.*
      			FROM login l
      			INNER JOIN pegawai p ON l.login=p.nip
						WHERE l.aktif=1 ".$filterdept."
      			";
				//echo $sql;die;
				$data['show_table']=$this->dbx->data($sql);
				return $data;
    }

  //---------------------------------------------------------------------------------------------------------
	//------------------------------------------------------------------------------------------ INDEX
	//---------------------------------------------------------------------------------------------------------
	public function ubahuser_db($id_user,$data) {
    	$sql="select l.*,p.nama,p.nip FROM login l
      			INNER JOIN pegawai p ON l.login=p.nip
      			WHERE l.replid='".$id_user."'";
			//echo $sql;die;
			$data['isi']=$this->dbx->rows($sql);
			/*
    	if ($data['isi']== NULL ) {
        	unset($data['isi']);
        	$sql="SELECT NULL as 'nama',NULL as 'nip', NULL as 'role_id',NULL as 'departemen'
									,NULL as 'kelas','1' as 'aktif',NULL as 'keterangan',NULL as matpel";
        	$data['isi']=$this->dbx->rows($sql);
        }
				*/

			//$sqlpeg="SELECT * FROM pegawai WHERE replid='".$this->session->userdata('idpegawai')."'";
			//$data['isipeg']=$this->dbx->rows($sqlpeg);


			//AND iddepartemen IN (SELECT departemen FROM departemen WHERE replid IN (".$this->session->userdata('dept')."))
			$data['matpel_opt'] = $this->dbx->data("SELECT replid,UPPER(CONCAT('[',iddepartemen,'] ',matpel)) as nama FROM ns_matpel
																WHERE aktif=1 ORDER BY iddepartemen,matpel",'up');
			//AND ta.departemen IN (SELECT departemen FROM departemen WHERE replid IN (".$this->session->userdata('dept')."))
    	$data['kelas_opt'] = $this->dbx->data("SELECT k.replid,UPPER(CONCAT('[',ta.departemen,'] ',t.tingkat,' - ',k.kelas)) as nama FROM kelas k
																																INNER JOIN tahunajaran ta ON k.idtahunajaran=ta.replid
																																INNER JOIN tingkat t ON k.idtingkat=t.replid
																																WHERE ta.aktif=1 AND ta.idcompany='".$this->session->userdata('idcompany')."'
																																ORDER BY CONVERT(SUBSTRING_INDEX(t.tingkat,'-',-1),UNSIGNED INTEGER),k.kelas",'up');
    	return $data;
    }

    public function ubahuser_p_db($data,$idx) {
		$this->db->where('replid',$idx);
		$this->db->update('login', $data);
		if ($this->db->_error_number() == 0) {
			return true;
		} else {
			return false;
		}
	 }
}

?>
