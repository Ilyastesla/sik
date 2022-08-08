<?php

Class reff_kecamatan_db extends CI_Model {
	public function __construct() {
		parent::__construct();
		$this->load->library('dbx');
	}

    // Read data from database to show data in admin page
    public function data() {
      	$sql="SELECT kec.*,k.kota,p.propinsi,n.negara,(SELECT COUNT(*) FROM kecamatan WHERE id_kota=k.replid) as pakai
							FROM kecamatan kec
							LEFT JOIN kota k ON k.replid=kec.id_kota
							LEFT JOIN propinsi p ON p.replid=k.id_propinsi
							LEFT JOIN negara n ON n.replid=p.id_negara
							ORDER BY k.kota";
				return $this->dbx->data($sql);

    }

     //TAMBAH
    public function tambah_db($id='',$data) {
    		$data['id']=$id;
      	$sql="SELECT kec.*,k.id_propinsi,p.id_negara
      			FROM kecamatan kec
						LEFT JOIN kota k ON k.replid=kec.id_kota
						LEFT JOIN propinsi p ON k.id_propinsi=p.replid
      			WHERE kec.replid='".$id."'";
        $data['isi'] = $this->dbx->rows($sql);

        if ($data['isi']== NULL ) {
					unset($data['isi']);
	        $sql="SELECT ".$this->dbx->tablecolumn('kecamatan').",0 as id_negara,0 as id_propinsi";
	        $data['isi']=$this->dbx->rows($sql);
        }
				$data['idnegara_opt'] = $this->dbx->opt("SELECT replid,negara as nama FROM negara ORDER BY negara",'up');
				$data['idpropinsi_opt'] = $this->dbx->opt("SELECT replid,propinsi as nama FROM propinsi WHERE id_negara='".$data["isi"]->id_negara."' ORDER BY propinsi",'up');
				$data['idkota_opt'] = $this->dbx->opt("SELECT replid,kota as nama FROM kota WHERE id_propinsi='".$data["isi"]->id_propinsi."' ORDER BY kota",'up');
				return $data;
  }
}

?>
