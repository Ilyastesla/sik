<?php

Class ns_rapot_kompetensi_db extends CI_Model {
	public function __construct() {
		parent::__construct();
		$this->load->library('dbx');
	}

    // Read data from database to show data in admin page
    public function data($data) {
			$cari="";

			//if ($this->input->post('iddepartemen')<>""){
				$cari=$cari." AND t.departemen='".$this->input->post('iddepartemen')."' ";
			//}
			//if ($this->input->post('idtahunajaran')<>""){
				$cari=$cari." AND t.replid='".$this->input->post('idtahunajaran')."' ";
			//}
			/*
			else{
				$cari=$cari." AND t.aktif=1 ";
			}*/

			if ($this->input->post('idtingkat')<>""){
				$cari=$cari." AND tkt.replid='".$this->input->post('idtingkat')."' ";
			}

			if ($this->input->post('kelompok_siswa')<>""){
				$cari=$cari." AND k.kelompok_siswa='".$this->input->post('kelompok_siswa')."' ";
			}
			if ($this->input->post('idperiode')<>""){
				$cari=$cari." AND nrk.idperiode='".$this->input->post('idperiode')."' ";
			}
			if ($this->input->post('kurikulumkode')<>""){
				$cari=$cari." AND k.kurikulumkode='".$this->input->post('kurikulumkode')."' ";
			}
			//if ($this->input->post('idmatpel')<>""){
				$cari=$cari." AND nrk.idmatpel='".$this->input->post('idmatpel')."' ";
			//}
			//AND nrk.created_by='".$this->session->userdata('idpegawai')."'
				$sql = "SELECT nrk.*,t.tahunajaran,t.departemen,tkt.tingkat as tingkattext,CONCAT(mp.matpel,' ',mp.keterangan) as matpeltext,p.periode as periodetext
											
								FROM ns_rapot_kompetensi nrk
                                LEFT JOIN tahunajaran t ON t.replid=nrk.idtahunajaran
								LEFT JOIN hrm_company com ON com.replid=t.idcompany
                                LEFT JOIN departemen d ON d.replid=t.departemen
								LEFT JOIN tingkat tkt ON tkt.replid=nrk.idtingkat
                                LEFT JOIN ns_matpel mp ON mp.replid=nrk.idmatpel
								LEFT JOIN ns_periode p ON p.replid=nrk.idperiode
								WHERE nrk.replid>0 ".$cari." 
								ORDER BY matpeltext ASC";
				//echo $sql;die;
				$data['show_table']=$this->dbx->data($sql);

			//die;
			$companyrow=$this->session->userdata('idcompany');
			$sqlcompany="SELECT replid,nama as nama
									FROM hrm_company
									WHERE replid IN (".$companyrow.") AND aktif=1
									ORDER BY nama";
			$data['idcompany_opt'] = $this->dbx->opt($sqlcompany,'up');
			$data['iddepartemen_opt'] = $this->dbx->opt("SELECT departemen as replid,departemen as nama FROM departemen WHERE aktif=1 AND replid IN (".$this->session->userdata('dept').") ORDER BY urutan",'up');

			if($data['action']<>'ns_rapot_kompetensi_kurasi'){
					$data['idtahunajaran_opt'] = $this->dbx->opt("SELECT DISTINCT ta.replid,CONCAT('[',ta.departemen,'] ',ta.tahunajaran,' - ',com.nama) as nama 
																FROM tahunajaran ta 
																INNER JOIN ns_pembelajaranjadwal pj ON pj.idtahunajaran=ta.replid
																INNER JOIN hrm_company com ON com.replid=ta.idcompany
																WHERE pj.created_by='".$this->session->userdata('idpegawai')."' AND com.replid='".$this->input->post('idcompany')."'  AND ta.departemen='".$this->input->post('iddepartemen')."'
																ORDER BY YEAR(ta.tglmulai) DESC ",'up');
					$data['idtingkat_opt'] = $this->dbx->opt("SELECT DISTINCT t.replid,CONCAT('[',t.departemen,'] ',t.tingkat)  as nama 
																FROM tingkat t
																INNER JOIN kelas k ON k.idtingkat=t.replid
																INNER JOIN ns_pembelajaranjadwal pj ON pj.idkelas=k.replid
																WHERE pj.idtahunajaran='".$this->input->post('idtahunajaran')."' AND pj.created_by='".$this->session->userdata('idpegawai')."' 
																ORDER BY CAST(t.tingkat AS SIGNED) ASC",'up');
					$data['idmatpel_opt'] = $this->dbx->opt("SELECT DISTINCT mp.replid,CONCAT(mp.matpel,' ',mp.keterangan) as nama
																FROM ns_pembelajaranjadwal pj
																INNER JOIN ns_matpel mp ON mp.replid=pj.idmatpel
																INNER JOIN kelas k ON k.replid=pj.idkelas 
																INNER JOIN tingkat t ON t.replid=k.idtingkat
																WHERE pj.created_by='".$this->session->userdata('idpegawai')."' AND pj.idtahunajaran='".$this->input->post('idtahunajaran')."' AND t.replid='".$this->input->post('idtingkat')."'
																ORDER BY mp.iddepartemen, mp.matpel");

			}else{
				$data['idtahunajaran_opt'] = $this->dbx->opt("SELECT DISTINCT ta.replid,CONCAT('[',ta.departemen,'] ',ta.tahunajaran,' - ',com.nama) as nama 
															FROM tahunajaran ta 
															INNER JOIN hrm_company com ON com.replid=ta.idcompany
															INNER JOIN ns_rapot_kompetensi rk ON rk.idtahunajaran=ta.replid
															WHERE com.replid='".$this->input->post('idcompany')."' AND ta.departemen='".$this->input->post('iddepartemen')."'
															ORDER BY YEAR(ta.tglmulai) DESC ",'up');
				$data['idtingkat_opt'] = $this->dbx->opt("SELECT DISTINCT t.replid,CONCAT('[',t.departemen,'] ',t.tingkat)  as nama 
															FROM tingkat t
															INNER JOIN ns_rapot_kompetensi rk ON rk.idtingkat=t.replid
															WHERE rk.idtahunajaran='".$this->input->post('idtahunajaran')."' 
															ORDER BY CAST(t.tingkat AS SIGNED) ASC",'up');
				$data['idmatpel_opt'] = $this->dbx->opt("SELECT DISTINCT mp.replid,CONCAT(mp.matpel,' ',mp.keterangan) as nama
															FROM ns_rapot_kompetensi rk
															INNER JOIN ns_matpel mp ON mp.replid=rk.idmatpel
															WHERE rk.idtahunajaran='".$this->input->post('idtahunajaran')."' AND rk.idtingkat='".$this->input->post('idtingkat')."'
															ORDER BY mp.iddepartemen, mp.matpel");
			}
			
			$data['idperiode_opt'] = $this->dbx->opt("SELECT replid,periode as nama FROM ns_periode ORDER BY nama");
			return $data;
    }

     //TAMBAH
    public function tambah_db($id='',$data) {
      	$sql="SELECT k.*,t.departemen as iddepartemen
      			FROM ns_rapot_kompetensi k
				LEFT JOIN tahunajaran t ON t.replid=k.idtahunajaran
      			WHERE k.replid='".$id."'";
		//echo $sql;
        $data['isi'] = $this->dbx->rows($sql);
        if ($data['isi']== NULL ) {
					unset($data['isi']);
					$sql="SELECT ".$this->dbx->tablecolumn('ns_rapot_kompetensi').",null as iddepartemen";
        	$data['isi']=$this->dbx->rows($sql);
        }
		/*
        $companyrow=$this->session->userdata('idcompany');
		$sqlcompany="SELECT replid,nama as nama
								FROM hrm_company
								WHERE replid IN (".$companyrow.") AND aktif=1
								ORDER BY nama";
		$data['idcompany_opt'] = $this->dbx->opt($sqlcompany,'up');
		$data['iddepartemen_opt'] = $this->dbx->opt("SELECT departemen as replid,departemen as nama FROM departemen WHERE aktif=1 AND replid IN (".$this->session->userdata('dept').") ORDER BY urutan",'up');
		*/
		$filterdropdown="";
		if($data['link']=='ns_rapot_kompetensi'){
			$filterdropdown=" AND pj.created_by='".$this->session->userdata('idpegawai')."' ";
		}

		$data['idtahunajaran_opt'] = $this->dbx->opt("SELECT DISTINCT ta.replid,CONCAT('[',ta.departemen,'] ',ta.tahunajaran,' - ',com.nama) as nama 
														FROM tahunajaran ta 
														INNER JOIN ns_pembelajaranjadwal pj ON pj.idtahunajaran=ta.replid
														INNER JOIN hrm_company com ON com.replid=ta.idcompany
														WHERE ta.replid>0 
														 ".$filterdropdown."												
														ORDER BY YEAR(ta.tglmulai) DESC  ",'up');

		$data['idtingkat_opt'] = $this->dbx->opt("SELECT DISTINCT t.replid,CONCAT('[',t.departemen,'] ',t.tingkat)  as nama 
													FROM tingkat t
													INNER JOIN kelas k ON k.idtingkat=t.replid
													INNER JOIN ns_pembelajaranjadwal pj ON pj.idkelas=k.replid
													WHERE pj.idtahunajaran='".$data['isi']->idtahunajaran."'  ".$filterdropdown."	 
													ORDER BY CAST(t.tingkat AS SIGNED) ASC",'up');
        $data['idmatpel_opt'] = $this->dbx->opt("SELECT DISTINCT mp.replid,CONCAT(mp.matpel,' ',mp.keterangan) as nama
												FROM ns_pembelajaranjadwal pj
												INNER JOIN ns_matpel mp ON mp.replid=pj.idmatpel
												INNER JOIN kelas k ON k.replid=pj.idkelas 
												INNER JOIN tingkat t ON t.replid=k.idtingkat
												WHERE pj.idtahunajaran='".$data['isi']->idtahunajaran."' AND t.replid='".$data['isi']->idtingkat."'  ".$filterdropdown."	
												ORDER BY mp.iddepartemen, mp.matpel",'up');
		$data['idperiode_opt'] = $this->dbx->opt("SELECT replid,periode as nama FROM ns_periode ORDER BY nama");
		
        return $data;
  }

}

?>
