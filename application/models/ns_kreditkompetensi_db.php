<?php

Class ns_kreditkompetensi_db extends CI_Model {
	public function __construct() {
		parent::__construct();
		$this->load->library('dbx');
	}

    // Read data from database to show data in admin page
    public function data() {
			$cari="";

				if ($this->input->post('idtingkat')<>""){
					$cari=$cari." AND kk.idtingkat='".$this->input->post('idtingkat')."' ";
				}
				if ($this->input->post('idperiode')<>""){
					$cari=$cari." AND kk.idperiode='".$this->input->post('idperiode')."' ";
				}

      	$sql = "SELECT kk.*,mp.iddepartemen,mp.matpel as matpeltext,t.tingkat as tingkattext, p. periode as periodetext
										FROM ns_kreditkompetensi kk
								LEFT JOIN ns_matpel mp ON mp.replid=kk.idmatpel
                LEFT JOIN tingkat t ON t.replid=kk.idtingkat
                LEFT JOIN ns_periode p ON p.replid=kk.idperiode
                WHERE mp.replid=kk.idmatpel ".$cari."
								ORDER BY t.tingkat, p. periode ";
        //echo $sql;die;
				$data['show_table']=$this->dbx->data($sql);
        $sql="SELECT replid,matpel as nama FROM ns_matpel WHERE aktif=1 AND iddepartemen IN (".$this->dbx->sessionjenjangtext($this->session->userdata('dept')).") ORDER BY matpel";
        $data['idmatpel_opt'] = $this->dbx->opt($sql);
        $sql="SELECT replid,tingkat as nama FROM tingkat WHERE aktif=1 AND departemen IN (".$this->dbx->sessionjenjangtext($this->session->userdata('dept')).") ORDER BY tingkat";
        $data['idtingkat_opt'] = $this->dbx->opt($sql);
        $data['idperiode_opt'] = $this->dbx->opt("SELECT replid,periode as nama FROM ns_periode ORDER BY periode");
				return $data;
    }

     //TAMBAH
    public function tambah_db($data,$id='') {
      	$sql="SELECT d.*
      			FROM ns_kreditkompetensi d
      			WHERE d.replid='".$id."'";
        $data['isi'] = $this->dbx->rows($sql);

        if ($data['isi']== NULL ) {
        	unset($data['isi']);
					$sql="SELECT ".$this->dbx->tablecolumn('ns_kreditkompetensi').",1 as aktif ";
        	$data['isi']=$this->dbx->rows($sql);
        }
        $sql="SELECT replid,CONCAT('[',iddepartemen,'] ',matpel) as nama FROM ns_matpel WHERE aktif=1 AND iddepartemen IN (".$this->dbx->sessionjenjangtext($this->session->userdata('dept')).") ORDER BY iddepartemen,matpel";
        $data['idmatpel_opt'] = $this->dbx->opt($sql,'none');
        $sql="SELECT replid,tingkat as nama FROM tingkat WHERE aktif=1 AND departemen IN (".$this->dbx->sessionjenjangtext($this->session->userdata('dept')).") ORDER BY tingkat";
        $data['idtingkat_opt'] = $this->dbx->opt($sql,'none');
        $data['idperiode_opt'] = $this->dbx->opt("SELECT replid,periode as nama FROM ns_periode ORDER BY periode");
				return $data;
  }

}

?>
