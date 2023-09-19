<?php

Class ksw_siswa_cari_db extends CI_Model {
	public function __construct() {
		parent::__construct();
		$this->load->library('dbx');
	}

    // Read data from database to show data in admin page
    public function data() {
			$cari="";
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
				$sql = "SELECT s.*,DAY(s.tgllahir),MONTH(s.tgllahir)
								,YEAR(s.tgllahir),ks.kondisi as kondisi_nm
								,cs.replid as replidcalon
								,(DATEDIFF (current_date(),s.tgl_masuk)) as jml_hari
								,akt.angkatan,r.region,s.remedialperilaku,k.kelas,ta.tahunajaran
								,ta.departemen
								FROM siswa s
								LEFT JOIN kondisisiswa ks ON ks.replid=s.kondisi
								LEFT JOIN kelas k ON s.idkelas = k.replid
								LEFT JOIN tahunajaran ta ON ta.replid = k.idtahunajaran
								LEFT JOIN angkatan akt ON akt.replid=s.idangkatan
								LEFT JOIN regional r ON r.replid=s.region
								LEFT JOIN calonsiswa cs ON cs.replid=s.replidcalon
								WHERE ta.idcompany='".$this->input->post('idcompany')."' ".$cari."
								ORDER BY s.nama ";
			  //echo $sql;die;
				$data['show_table']=$this->dbx->data($sql);
			}
			$data['jeniscari_opt'] = array("s.nama"=>"Nama Siswa","s.nis"=>"NIS","s.namaayah"=>"Nama Ayah Siswa","s.namaibu"=>"Nama Ibu Siswa","s.wali"=>"Nama Wali Siswa");
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
