<?php

Class pegawai_cari_db extends CI_Model {
	public function __construct() {
		parent::__construct();
		$this->load->library('dbx');
	}

    // Read data from database to show data in admin page
    public function data() {
			$cari="";
			//if ($this->session->userdata('nama')<>""){
			$cari .= " AND p.idcompany='".$this->input->post('idcompany')."' ";
			if ($this->input->post('nama')<>""){
				//$cari=$cari." s.nama like '%".$this->session->userdata('nama')."%' ";
				$cari=$cari." AND ".$this->input->post('jeniscari')." like '%".$this->input->post('nama')."%' ";

			}
				//AND t.replid='$tahunajaran'
				//AND tkt.replid='$tingkat'
				//AND t.departemen='$departemen'

			if ($this->input->post('filter')<>1){
				$data['show_table']=NULL;
			}else{
				$sql = "SELECT DISTINCT p.*
                ,(TIMESTAMPDIFF(YEAR, p.tgllahir, CURDATE())) as umur
                ,log.aktif as loginaktif,log.replid as replidlogin
      			FROM pegawai p
      			LEFT JOIN login log ON log.login=p.nip
      			WHERE nip<>'sa' ".$cari."
      			ORDER BY nama
      			";
			  //echo $sql;die;
				$data['show_table']=$this->dbx->data($sql);
			}
			$data['jeniscari_opt'] = array("p.nama"=>"Nama Pegawai","p.nip"=>"NIP");
			$companyrow=$this->session->userdata('idcompany');
			$sqlcompany="SELECT replid,nama as nama FROM hrm_company WHERE replid IN (".$companyrow.") AND aktif=1 ORDER BY nama";
			$data['idcompany_opt'] = $this->dbx->opt($sqlcompany,'up');
			return $data;
    }
}

?>
