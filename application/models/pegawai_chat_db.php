<?php

Class pegawai_chat_db extends CI_Model {
public function __construct() {
parent::__construct();
	$this->load->library('dbx');
}
    // Read data from database to show data in admin page
    public function data() {
      	$sql="SELECT DISTINCT CONCAT('[',p.nip,'] ',p.nama) as `fromtext`,CONCAT('[',p2.nip,'] ',p2.nama) as `totext`,c.`from`,c.`to`
				FROM chat c
				LEFT JOIN pegawai p ON p.nip=c.`from`
				LEFT JOIN pegawai p2 ON p2.nip=c.`to`
				WHERE (c.`from`='".$this->session->userdata('nip')."' OR c.`to`='".$this->session->userdata('nip')."')
				ORDER BY c.sent DESC ";
				//echo $sql;die;
      	return $this->dbx->data($sql);
    }
    public function view_db($from,$to,$data) {
      	$sql="SELECT CONCAT('[',p.nip,'] ',p.nama) as `fromtext`,CONCAT('[',p2.nip,'] ',p2.nama) as `totext`,c.*
				FROM chat c
				LEFT JOIN pegawai p ON p.nip=c.`from`
				LEFT JOIN pegawai p2 ON p2.nip=c.`to`
					WHERE (c.`from` = '".$from."'  AND  c.`to` = '".$to."' ) OR (c.`to` = '".$from."'  AND  c.`from` = '".$to."' )
				ORDER BY c.id DESC";
				$data['isi']=$this->dbx->data($sql);
				return $data;
    }
}
?>
