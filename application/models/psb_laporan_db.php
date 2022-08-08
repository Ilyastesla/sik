<?php

Class psb_laporan_db extends CI_Model {
	public function __construct() {
		parent::__construct();
		$this->load->library('dbx');
	}

    // Read data from database to show data in admin page
    public function data() {
	$cari="";

		
	
		
	if (($this->input->post('periode1')<>"") AND ($this->input->post('periode2')=="")){
		$cari=$cari." AND ok.created_date >= '".$this->p_c->tgl_db($this->input->post('periode1'))."' ";
	}
	if (($this->input->post('periode1')=="") AND ($this->input->post('periode2')<>"")){
	$cari=$cari." AND ok.created_date <= '".$this->p_c->tgl_db($this->input->post('periode2'))."' ";
	}
	if (($this->input->post('periode1')<>"") AND ($this->input->post('periode2')<>"")){
	$cari=$cari." AND ok.created_date BETWEEN '".$this->p_c->tgl_db($this->input->post('periode1'))."' AND '".$this->p_c->tgl_db($this->input->post('periode2'))."' ";
	}
	if ($cari==""){
		$cari=$cari." AND YEAR(ok.created_date)=YEAR(CURRENT_DATE()) ";
	}
	
	//if ($this->input->post('idcompany')<>""){
		$cari=$cari." AND ok.idunitbisnis='".$this->input->post('idcompany')."'";
	//}

		$groupby=" GROUP BY year(ok.created_date),month(ok.created_date)
							ORDER BY year(ok.created_date),month(ok.created_date)";
		if ($this->input->post('groupby')=='daily'){
			$sql = "SELECT DISTINCT(DATE_FORMAT(ok.created_date,'%Y-%m-%d')) as tanggal
						FROM online_kronologis ok
						WHERE ok.replid is not null
						".$cari."
						ORDER BY tanggal ASC";
			//echo $sql;die;
			$data['ok_year']=$this->dbx->data($sql);

			$groupby=" GROUP BY DATE_FORMAT(ok.created_date,'%Y-%m-%d')
								ORDER BY DATE_FORMAT(ok.created_date,'%Y-%m-%d')";
		}else{
			$sql = "SELECT DISTINCT(year(created_date)) as tahun
						FROM online_kronologis ok
						WHERE ok.replid is not null
						".$cari."
						ORDER BY tahun ASC";
			$data['ok_year']=$this->dbx->data($sql);
		}

		$sqltotalpengunjung="SELECT year(ok.created_date) as tahun,month(ok.created_date) as bulan,COUNT(ok.replid) as jumlah
																,DATE_FORMAT(ok.created_date,'%Y-%m-%d') as tanggal
													FROM online_kronologis ok
													INNER JOIN tahunajaran ta ON ta.replid=ok.idtahunajaran
													WHERE ok.replid is not null
													".$cari.$groupby;
		//echo $sqltotalpengunjung;die;
		$data['totalpengunjung']=$this->dbx->data($sqltotalpengunjung);

		$sqltotalformulir="SELECT year(ok.created_date) as tahun,month(ok.created_date) as bulan,COUNT(ok.replid) as jumlah
														,DATE_FORMAT(ok.created_date,'%Y-%m-%d') as tanggal
													FROM online_kronologis ok
													INNER JOIN tahunajaran ta ON ta.replid=ok.idtahunajaran
													INNER JOIN calonsiswa cs ON cs.replid=ok.idcalon
													WHERE cs.keu_form=1
													".$cari.$groupby;
		$data['totalformulir']=$this->dbx->data($sqltotalformulir);

		$sqltotalformulir="SELECT year(ok.created_date) as tahun,month(ok.created_date) as bulan,COUNT(ok.replid) as jumlah
														,DATE_FORMAT(ok.created_date,'%Y-%m-%d') as tanggal
													FROM online_kronologis ok
													INNER JOIN tahunajaran ta ON ta.replid=ok.idtahunajaran
													INNER JOIN calonsiswa cs ON cs.replid=ok.idcalon
													WHERE cs.replidsiswa<>''
													".$cari.$groupby;
		$data['totalsiswabaru']=$this->dbx->data($sqltotalformulir);
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
