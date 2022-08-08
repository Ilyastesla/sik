<?php

Class reff_kota_db extends CI_Model {
	public function __construct() {
		parent::__construct();
		$this->load->library('dbx');
	}

    // Read data from database to show data in admin page
    public function data() {
		$cari="";

		if ($this->input->post('idnegara')<>""){
			$cari=$cari." AND p.id_negara='".$this->input->post('idnegara')."' ";
		}
		if ($this->input->post('idpropinsi')<>""){
			$cari=$cari." AND k.id_propinsi='".$this->input->post('idpropinsi')."' ";
		}
		if ($this->input->post('aktif')<>""){
			$cari=$cari." AND k.aktif='".$this->input->post('aktif')."' ";
		}
      	$sql="SELECT k.*,p.propinsi,n.negara,(SELECT COUNT(*) FROM kecamatan WHERE id_kota=k.replid) as pakai
				FROM kota k
				LEFT JOIN propinsi p ON p.replid=k.id_propinsi
				LEFT JOIN negara n ON n.replid=p.id_negara
				WHERE k.replid IS NOT NULL ".$cari."
				ORDER BY k.kota";
		
		$data["show_table"]=$this->dbx->data($sql);
		$data['idnegara_opt'] = $this->dbx->opt("SELECT replid,negara as nama FROM negara ORDER BY negara",'up');
		$data['idpropinsi_opt'] = $this->dbx->opt("SELECT replid,propinsi as nama FROM propinsi WHERE id_negara='".$this->input->post("idnegara")."' ORDER BY propinsi",'up');
		$data['aktif_opt'] = array(''=>'Pilih..','1'=>'Aktif','0'=>'Tidak');
		return $data;

    }

     //TAMBAH
    public function tambah_db($id='',$data) {
    		$data['id']=$id;
      	$sql="SELECT k.*,p.id_negara
      			FROM kota k
						LEFT JOIN propinsi p ON k.id_propinsi=p.replid
      			WHERE k.replid='".$id."'";
        $data['isi'] = $this->dbx->rows($sql);

        if ($data['isi']== NULL ) {
					unset($data['isi']);
	        $sql="SELECT ".$this->dbx->tablecolumn('kota').",1 as aktif,0 as id_negara";
	        $data['isi']=$this->dbx->rows($sql);
        }
				$data['idnegara_opt'] = $this->dbx->opt("SELECT replid,negara as nama FROM negara ORDER BY negara",'up');
				$data['idpropinsi_opt'] = $this->dbx->opt("SELECT replid,propinsi as nama FROM propinsi WHERE id_negara='".$data['isi']->id_negara."' ORDER BY propinsi",'up');
        return $data;
  }
}

?>
