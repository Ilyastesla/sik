<?php

Class ksw_jurusan_db extends CI_Model {
	public function __construct() {
		parent::__construct();
		$this->load->library('dbx');
	}

    // Read data from database to show data in admin page
    public function data() {
			$cari="";

			//if ($this->input->post('iddepartemen')<>""){
				$cari=$cari." WHERE t.departemen='".$this->input->post('iddepartemen')."' ";
			//}else{
			//	$cari=$cari." WHERE t.departemen IN (".$this->dbx->sessionjenjangtext().") ";
			//}
      	$sql = "SELECT t.*
										FROM jurusan t ".$cari." ORDER BY t.departemen,t.urutan";
				$data['show_table']=$this->dbx->data($sql);
				$data['iddepartemen_opt'] = $this->dbx->opt("SELECT departemen as replid,departemen as nama FROM departemen WHERE aktif=1 AND replid IN (".$this->session->userdata('dept').") ORDER BY urutan",'up');
				return $data;
    }

     //TAMBAH
    public function tambah_db($data,$id='') {
      	$sql="SELECT d.*
      			FROM jurusan d
      			WHERE d.replid='".$id."'";
        $data['isi'] = $this->dbx->rows($sql);

        if ($data['isi']== NULL ) {
        	unset($data['isi']);
					$sql="SELECT ".$this->dbx->tablecolumn('jurusan').",1 as aktif ";
        	$data['isi']=$this->dbx->rows($sql);
        }
        $data['departemen_opt'] = $this->dbx->opt("SELECT departemen as replid, departemen as nama FROM departemen WHERE aktif=1 AND departemen IN (".$this->dbx->sessionjenjangtext().") ORDER BY urutan",'up');
				return $data;
  }

}

?>
