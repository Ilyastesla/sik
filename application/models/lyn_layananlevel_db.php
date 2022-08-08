<?php

Class lyn_layananlevel_db extends CI_Model {
	public function __construct() {
		parent::__construct();
		$this->load->library('dbx');
	}

    // Read data from database to show data in admin page
    public function data() {
      	$sql="SELECT x.*,y.layanan as layanantext,z.jenislayanan as jenislayanantext 
							FROM lyn_layananlevel x
							LEFT JOIN lyn_layanan y ON y.replid=x.idlayanan
                            LEFT JOIN lyn_jenislayanan z ON z.replid=y.idjenislayanan
							ORDER BY x.layananlevel";
      	return $this->dbx->data($sql);
    }

     //TAMBAH
    public function tambah_db($id='',$data) {
    	$data['id']=$id;
      	$sql="SELECT x.*,y.idjenislayanan 
      			FROM lyn_layananlevel x
				LEFT JOIN lyn_layanan y ON y.replid=x.idlayanan
      			WHERE x.replid='".$id."'";
        $data['isi'] = $this->dbx->rows($sql);

        if ($data['isi']== NULL ) {
					unset($data['isi']);
	        $sql="SELECT ".$this->dbx->tablecolumn('lyn_layananlevel').",'' as idjenislayanan";
	        $data['isi']=$this->dbx->rows($sql);
        }
				$data['idjenislayanan_opt'] = $this->dbx->opt("SELECT replid,jenislayanan as nama FROM lyn_jenislayanan ORDER BY jenislayanan",'up');
                $data['idlayanan_opt'] = $this->dbx->opt("SELECT replid,layanan as nama FROM lyn_layanan WHERE idjenislayanan='".$data['isi']->idjenislayanan."' AND aktif=1 ORDER BY layanan",'up');
        return $data;
  }
}

?>
