<?php

Class psb_rekapitulasi_db extends CI_Model {
	public function __construct() {
		parent::__construct();
		$this->load->library('dbx');
	}

    // Read data from database to show data in admin page
    public function data() {
			$cari="";
				$cari=$cari." AND ok.idunitbisnis='".$this->input->post('idunitbisnis')."' ";
			$sql="SELECT d.departemen,COUNT(ok.replid) as jml,YEAR (CURRENT_DATE()) as tahun
            FROM departemen d
            LEFT JOIN online_kronologis ok ON ok.jenjang=d.departemen
            AND YEAR (ok.created_date) = YEAR (CURRENT_DATE())
            AND ok.idcalon IS NULL
						AND ok.status<>'CC'
						".$cari."
            GROUP BY d.departemen
            ORDER BY d.urutan
            ";
			$data['tamublmproses']=$this->dbx->data($sql);

      $sql="SELECT d.departemen,COUNT(cs.replid) as jml,YEAR (CURRENT_DATE()) as tahun
            FROM departemen d
            LEFT JOIN online_kronologis ok ON ok.jenjang=d.departemen
            AND YEAR (ok.created_date) = YEAR (CURRENT_DATE())
            ".$cari."
            LEFT JOIN calonsiswa cs ON cs.replid=ok.idcalon AND cs.keu_up is null AND cs.aktif=1
            AND cs.replidsiswa is null
						AND ok.status<>'CC'
            GROUP BY d.departemen
            ORDER BY d.urutan
            ";
      $data['cpdblmdp']=$this->dbx->data($sql);

      $sql="SELECT d.departemen,COUNT(cs.replid) as jml,YEAR (CURRENT_DATE()) as tahun
            FROM departemen d
            LEFT JOIN online_kronologis ok ON ok.jenjang=d.departemen
            AND YEAR (ok.created_date) = YEAR (CURRENT_DATE())
            ".$cari."
            LEFT JOIN calonsiswa cs ON cs.replid=ok.idcalon AND cs.keu_up=1 AND cs.aktif=1
            AND cs.replidsiswa is null
            GROUP BY d.departemen
            ORDER BY d.urutan
            ";
      $data['cpddp']=$this->dbx->data($sql);

      $sql="SELECT d.departemen,COUNT(cs.replid) as jml,YEAR (CURRENT_DATE()) as tahun
            FROM departemen d
            LEFT JOIN online_kronologis ok ON ok.jenjang=d.departemen
            AND YEAR (ok.created_date) = YEAR (CURRENT_DATE())
            ".$cari."
            LEFT JOIN calonsiswa cs ON cs.replid=ok.idcalon AND cs.keu_up=1 AND cs.aktif=1
            AND cs.replidsiswa is not null
            GROUP BY d.departemen
            ORDER BY d.urutan
            ";
      $data['cpdsiswa']=$this->dbx->data($sql);

			$companyrow=$this->session->userdata('idcompany');
			$sqlcompany="SELECT replid,nama as nama
									FROM hrm_company
									WHERE replid IN (".$companyrow.") AND aktif=1
									ORDER BY nama";
			$data['idunitbisnis_opt'] = $this->dbx->opt($sqlcompany,'up');
      return $data;
		}
}

?>
