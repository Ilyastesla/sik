<?php

Class reff_propinsi_db extends CI_Model {
	public function __construct() {
		parent::__construct();
		$this->load->library('dbx');
	}

    // Read data from database to show data in admin page
    public function data() {
      	$sql="SELECT p.*,n.negara,(SELECT COUNT(*) FROM kota WHERE id_propinsi=p.replid) as pakai
							FROM propinsi p
							LEFT JOIN negara n ON n.replid=p.id_negara
							ORDER BY p.propinsi";
      	return $this->dbx->data($sql);
    }

     //TAMBAH
    public function tambah_db($id='',$data) {
    	$data['id']=$id;
      	$sql="SELECT *
      			FROM propinsi
      			WHERE replid='".$id."'";
        $data['isi'] = $this->dbx->rows($sql);

        if ($data['isi']== NULL ) {
					unset($data['isi']);
	        $sql="SELECT ".$this->dbx->tablecolumn('propinsi');
	        $data['isi']=$this->dbx->rows($sql);
        }
				$data['id_negara_opt'] = $this->dbx->opt("SELECT replid,negara as nama FROM negara ORDER BY nama",'up');
        return $data;
  }
}

?>
