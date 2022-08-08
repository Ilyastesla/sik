<?php
Class fotodisplay_db extends CI_Model {
public function __construct() {
parent::__construct();
	$this->load->library('dbx');
}
   public function index($data) {
		 		if(isset($data['nip'])){
					$nip=$data['nip'];
				}else{
					$nip=$this->session->userdata('nip');
					$data['nip']=$this->session->userdata('nip');
				}
				$sql="SELECT fotodisplay,replid as idpegawai FROM pegawai
      			WHERE nip='".$nip."'
      			ORDER BY modified_date";
        $data['isi'] = $this->dbx->rows($sql);
        return $data;
    }

	public function ubah($data,$id) {
		//echo var_dump($data);die;
		$this->db->where('nip',$id);
		$this->db->update('pegawai', $data);
		if ($this->db->_error_number() == 0) {
		  return true;
		} else {
		  return false;
		}
	}
}
?>
