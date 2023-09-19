<?php

Class ns_rapot_observasi_db extends CI_Model {
	public function __construct() {
		parent::__construct();
		$this->load->library('dbx');
	}

    // Read data from database to show data in admin page
    public function data() {
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

			//if ($this->input->post('idtingkat')<>""){
				$cari=$cari." AND tkt.replid='".$this->input->post('idtingkat')."' ";
			//}

			//if ($this->input->post('idperiode')<>""){
				$cari=$cari." AND pj.idperiode='".$this->input->post('idperiode')."' ";
			//}
			//if ($this->input->post('idmatpel')<>""){
				$cari=$cari." AND pj.idmatpel='".$this->input->post('idmatpel')."' ";
			//}

				$sql = "SELECT DISTINCT t.tahunajaran,t.departemen,tkt.tingkat as tingkattext,CONCAT(mp.matpel,' ',mp.keterangan) as matpeltext,p.periode as periodetext
									,s.nama as siswatext, s.replid as idsiswa,k.kelas as kelastext		
								FROM ns_pembelajaranjadwal pj
								INNER JOIN ns_pengembangandirinilai pdn ON pj.replid=pdn.idpembelajaranjadwal 
								INNER JOIN siswa s ON s.replid=pdn.idsiswa
								INNER JOIN kelas k ON k.replid=s.idkelas
								LEFT JOIN tahunajaran t ON t.replid=pj.idtahunajaran
								LEFT JOIN hrm_company com ON com.replid=t.idcompany                                
                                LEFT JOIN departemen d ON d.replid=t.departemen
								LEFT JOIN tingkat tkt ON tkt.replid=k.idtingkat
                                LEFT JOIN ns_matpel mp ON mp.replid=pj.idmatpel
								LEFT JOIN ns_periode p ON p.replid=pj.idperiode
								WHERE pdn.terdaftar=1 AND pj.created_by='".$this->session->userdata('idpegawai')."' ".$cari."
								GROUP BY pdn.idsiswa 
								ORDER BY k.kelas,s.nama ASC";
				//echo $sql;die;
				$data['show_table']=$this->dbx->data($sql);
				$sqlkompetensi="SELECT replid,kompetensitext as nama FROM ns_rapot_kompetensi 
								WHERE idtahunajaran='".$this->input->post('idtahunajaran')."' 
								AND idtingkat='".$this->input->post('idtingkat')."' 
								AND idperiode='".$this->input->post('idperiode')."' 
								AND idmatpel='".$this->input->post('idmatpel')."'";
				//echo $sqlkompetensi;die;
				$data['kompetensi']=$this->dbx->data($sqlkompetensi);
			//die;
			$companyrow=$this->session->userdata('idcompany');
			$sqlcompany="SELECT replid,nama as nama
									FROM hrm_company
									WHERE replid IN (".$companyrow.") AND aktif=1
									ORDER BY nama";
			$data['idcompany_opt'] = $this->dbx->opt($sqlcompany,'up');
			$data['iddepartemen_opt'] = $this->dbx->opt("SELECT departemen as replid,departemen as nama FROM departemen WHERE aktif=1 AND replid IN (".$this->session->userdata('dept').") ORDER BY urutan",'up');
			$data['idtahunajaran_opt'] = $this->dbx->opt("SELECT DISTINCT ta.replid,CONCAT('[',ta.departemen,'] ',ta.tahunajaran,' - ',com.nama) as nama 
															FROM tahunajaran ta 
															INNER JOIN ns_pembelajaranjadwal pj ON pj.idtahunajaran=ta.replid
															INNER JOIN hrm_company com ON com.replid=ta.idcompany
															WHERE pj.created_by='".$this->session->userdata('idpegawai')."' AND com.replid='".$this->input->post('idcompany')."'
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
		$data['idtahunajaran_opt'] = $this->dbx->opt("SELECT DISTINCT ta.replid,CONCAT('[',ta.departemen,'] ',ta.tahunajaran,' - ',com.nama) as nama 
														FROM tahunajaran ta 
														INNER JOIN ns_pembelajaranjadwal pj ON pj.idtahunajaran=ta.replid
														INNER JOIN hrm_company com ON com.replid=ta.idcompany
														WHERE pj.created_by='".$this->session->userdata('idpegawai')."' 
														ORDER BY YEAR(ta.tglmulai) DESC  ",'up');
		$data['idtingkat_opt'] = $this->dbx->opt("SELECT DISTINCT t.replid,CONCAT('[',t.departemen,'] ',t.tingkat)  as nama 
													FROM tingkat t
													INNER JOIN kelas k ON k.idtingkat=t.replid
													INNER JOIN ns_pembelajaranjadwal pj ON pj.idkelas=k.replid
													WHERE pj.idtahunajaran='".$data['isi']->idtahunajaran."' AND pj.created_by='".$this->session->userdata('idpegawai')."' 
													ORDER BY CAST(t.tingkat AS SIGNED) ASC",'up');
        $data['idmatpel_opt'] = $this->dbx->opt("SELECT DISTINCT mp.replid,CONCAT(mp.matpel,' ',mp.keterangan) as nama
												FROM ns_pembelajaranjadwal pj
												INNER JOIN ns_matpel mp ON mp.replid=pj.idmatpel
												INNER JOIN kelas k ON k.replid=pj.idkelas 
												INNER JOIN tingkat t ON t.replid=k.idtingkat
												WHERE pj.created_by='".$this->session->userdata('idpegawai')."' AND pj.idtahunajaran='".$data['isi']->idtahunajaran."' AND t.replid='".$data['isi']->idtingkat."'
												ORDER BY mp.iddepartemen, mp.matpel",'up');
		$data['idperiode_opt'] = $this->dbx->opt("SELECT replid,periode as nama FROM ns_periode ORDER BY nama");
		
        return $data;
  }

}

?>
