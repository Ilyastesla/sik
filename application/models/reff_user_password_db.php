<?php

Class reff_user_password_db extends CI_Model {
	public function __construct() {
	parent::__construct();
		$this->load->library('dbx');
	}

    public function ganti_password_db($data) {
    	$sql="select * FROM pegawai
      			WHERE replid='".$this->session->userdata('idpegawai')."'";
    	$data['isi']=$this->dbx->rows($sql);
    	return $data;
    }

    public function read_user_information() {
      	$sql = "select 1
      			FROM login l
            INNER JOIN pegawai p ON l.login=p.nip
            WHERE p.replid = '".$this->session->userdata('idpegawai')."'
            AND l.login='".$this->input->post('nip')."'
            AND l.password='".md5($this->input->post('passwordlama'))."'";
		//echo $sql;die;
		$query=$this->db->query($sql);

        if ($query->num_rows() == 1) {
            //return $query->result();
            return true;
        } else {
            return false;
        }
    }

    public function ubahpassword_p_db($data) {
		$this->db->where('idpegawai',$this->session->userdata('idpegawai'));
		$this->db->update('login', $data);
		if ($this->db->_error_number() == 0) {
			return true;
		} else {
			return false;
		}
	 }
}

?>
