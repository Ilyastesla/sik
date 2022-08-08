<?php

Class psb_caricalonsiswa_db extends CI_Model {
	public function __construct() {
		parent::__construct();
		$this->load->library('dbx');
	}

    // Read data from database to show data in admin page
    public function data() {
			$cari="";
			$cari=$cari." AND ta.idcompany='".$this->input->post('idcompany')."'";
			//if ($this->session->userdata('nama')<>""){
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
				//,(select replid from calonsiswa where replidsiswa=s.replid) replidcalon
				$sql = "SELECT c.*,
              	p.departemen,
              	k.kelompok,
              	p.proses,
              	t.tingkat as tingkattext
                ,r.region as regiontext
              FROM
              	calonsiswa c
				INNER JOIN online_kronologis ok ON ok.idcalon=c.replid
				INNER JOIN tahunajaran ta ON ta.replid=c.idtahunajaran 
              	LEFT JOIN kelompokcalonsiswa k ON c.idkelompok = k.replid
              	LEFT JOIN prosespenerimaansiswa p ON p.replid = k.idproses
              	LEFT JOIN tingkat t ON t.replid = c.tingkat
                LEFT JOIN regional r ON r.replid=c.region
              WHERE c.replid is not null 
              	".$cari."
              ORDER BY c.nama ASC ";
			  //echo $sql;die;
				$data['show_table']=$this->dbx->data($sql);
			}
			$data['jeniscari_opt'] = array("c.nama"=>"Nama CPD","c.nopendaftaran"=>"Nomor Pendaftaran","c.namaayah"=>"Nama Ayah CPD","c.namaibu"=>"Nama Ibu CPD","c.wali"=>"Nama Wali CPD");
			$companyrow=$this->session->userdata('idcompany');
			$sqlcompany="SELECT replid,nama as nama
									FROM hrm_company
									WHERE replid IN (".$companyrow.") AND aktif=1
									ORDER BY nama";
			$data['idcompany_opt'] = $this->dbx->opt($sqlcompany,'up');
			return $data;
    }
}

?>
