<?php

Class loa_db extends CI_Model {
public function __construct() {
parent::__construct();
	$this->load->library('dbx');
}
    // Read data from database to show data in admin page
    public function data() {
      	$sql="SELECT l.*,g.jabatan_grup as idjabatan_grup,s.status as next_node,s2.status as node
      				,d.departemen as iddepartemen,j.jabatan as jabatantext
      			FROM hrm_loa l
      			LEFT JOIN hrm_jabatan_grup g ON l.idjabatan_grup=g.replid
						LEFT JOIN hrm_jabatan j ON l.idjabatan=j.replid
      			LEFT JOIN hrm_status s ON l.next_node=s.node
      			LEFT JOIN hrm_departemen d ON l.iddepartemen=d.replid
      			LEFT JOIN hrm_status s2 ON l.node=s2.node
      			ORDER BY replid";
      	return $this->dbx->data($sql);
    }


    //TAMBAH
    //-------------------------------------------------------------------------------------------
    public function tambah_x($id='',$data) {
    	$data['id']=$id;
      	$sql="SELECT *
      			FROM hrm_loa kk
      			WHERE kk.replid='".$id."'";
        $data['isi'] = $this->dbx->rows($sql);

        if ($data['isi']== NULL ) {
					unset($data['isi']);
	        $sql="SELECT ".$this->dbx->tablecolumn('hrm_loa').",1 as aktif";
	        $data['isi']=$this->dbx->rows($sql);
        }
        $data['modul_opt'] = $this->dbx->opt("select pages as replid,nama from hrm_menu where aktif=1 ORDER BY nama","up");
        $data['jabatan_grup_opt'] = $this->dbx->opt("select replid,jabatan_grup as nama from hrm_jabatan_grup where aktif=1 ORDER BY nama",'up');
				$data['jabatan_opt'] = $this->dbx->opt("select replid,jabatan as nama from hrm_jabatan where aktif=1 ORDER BY nama",'up');
        $data['departemen_opt'] = $this->dbx->opt("SELECT replid,departemen as nama FROM hrm_departemen WHERE aktif=1 ORDER BY departemen","up");
        $data['next_node_opt'] = $this->dbx->opt("SELECT node as replid,status as nama FROM hrm_status ORDER BY nama",'up');
        $data['node_opt'] = $this->dbx->opt("SELECT node as replid,status as nama FROM hrm_status ORDER BY nama",'up');
        return $data;
    }
}
?>
