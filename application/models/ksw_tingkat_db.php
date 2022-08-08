<?php

Class ksw_tingkat_db extends CI_Model {
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
										,(SELECT COUNT(*) FROM kelas WHERE idtingkat=t.replid) as pakai
										FROM tingkat t ".$cari." ORDER BY t.departemen,t.urutan";
				$data['show_table']=$this->dbx->data($sql);
				$data['iddepartemen_opt'] = $this->dbx->opt("SELECT departemen as replid,departemen as nama FROM departemen WHERE aktif=1 AND replid IN (".$this->session->userdata('dept').") ORDER BY urutan",'up');
				return $data;
    }

     //TAMBAH
    public function tambah_db($id='',$data) {
    	$data['id']=$id;
      	$sql="SELECT d.*
      			FROM tingkat d
      			WHERE d.replid='".$id."'";
        $data['isi'] = $this->dbx->rows($sql);

        if ($data['isi']== NULL ) {
        	unset($data['isi']);
					$sql="SELECT ".$this->dbx->tablecolumn('tingkat').",1 as aktif ";
        	$data['isi']=$this->dbx->rows($sql);
        }
        $data['departemen_opt'] = $this->dbx->opt("SELECT departemen as replid, departemen as nama FROM departemen WHERE aktif=1 AND departemen IN (".$this->dbx->sessionjenjangtext().") ORDER BY urutan",'up');
				$data['idkesetaraan_opt'] =array('' => 'Pilih...',1=>1,2=>2,3=>3,4=>4,5=>5,6=>6);
				return $data;
  }


   public function tambah_pdb($data) {
    	//echo print_r(array_values($data));die;
    	$this->db->trans_start();
        $this->db->insert('tingkat', $data);
        $insert_id = $this->db->insert_id();
        if ($this->db->affected_rows() > 0) {
               $this->db->trans_complete();
               return $insert_id;
        } else {
        	$this->db->trans_complete();
            return false;
        }
     }

     public function ubah_pdb($data,$id) {
        $this->db->where('replid',$id);
        $this->db->update('tingkat', $data);
        if ($this->db->_error_number() == 0) {
            return true;
        } else {
            return false;
        }
    }

    public function hapus_pdb($id) {
        $this->db->where('replid',$id);
        $this->db->delete('tingkat');
        if ($this->db->_error_number() == 0) {
	        return true;
        } else {
            return false;
        }
    }
}

?>
