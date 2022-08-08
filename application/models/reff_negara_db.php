<?php
Class reff_negara_db extends CI_Model {
	public function __construct() {
		parent::__construct();
		$this->load->library('dbx');
	}

    // Read data from database to show data in admin page
    public function data() {
      	$sql="SELECT *,(SELECT COUNT(*) FROM propinsi WHERE id_negara=n.replid) as pakai FROM negara n ORDER BY negara";
				return $this->dbx->data($sql);
    }

     //TAMBAH
    public function tambah_db($id='',$data) {
    	$data['id']=$id;
      	$sql="SELECT *
      			FROM negara
      			WHERE replid='".$id."'";
        $data['isi'] = $this->dbx->rows($sql);

        if ($data['isi']== NULL ) {
					unset($data['isi']);
	        $sql="SELECT ".$this->dbx->tablecolumn('negara');
	        $data['isi']=$this->dbx->rows($sql);
        }
				return $data;
  }
}

?>
