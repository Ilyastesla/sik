<?php
Class hrm_menu_db extends CI_Model {
public function __construct() {
parent::__construct();
	$this->load->library('dbx');
}
    // Read data from database to show data in admin page
    public function data() {
				$cari="";
				if ($this->input->post('modul_id')<>""){
					$cari=$cari." WHERE mn.modul_id='".$this->input->post('modul_id')."' ";
				}
      	$sql="SELECT mn.*,m.nama as modul_id
						FROM hrm_menu mn
      			LEFT JOIN hrm_modul m ON mn.modul_id=m.replid
						".$cari."
      			ORDER BY m.nama,no_urut";
				//echo $sql;
      	$data['show_table']=$this->dbx->data($sql);

				$data['modul_id_opt'] = $this->dbx->opt("SELECT replid, nama FROM hrm_modul ORDER BY nama","up");
				return $data;
    }


    //TAMBAH
    //-------------------------------------------------------------------------------------------
    public function tambah_x($id='',$data) {
    	$data['id']=$id;
      	$sql="SELECT *
      			FROM hrm_menu kk
      			WHERE kk.replid='".$id."'";
        $data['isi'] = $this->dbx->rows($sql);

        if ($data['isi']== NULL ) {
					unset($data['isi']);
	        $sql="SELECT ".$this->dbx->tablecolumn('hrm_menu').",1 as aktif";
	        $data['isi']=$this->dbx->rows($sql);
        }
        $data['modul_id_opt']=$this->dbx->opt("select replid, nama from hrm_modul ORDER BY nama",'up');
        return $data;
    }
}
?>
