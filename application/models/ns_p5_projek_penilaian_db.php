<?php

Class ns_p5_projek_penilaian_db extends CI_Model {
	public function __construct() {
		parent::__construct();
		$this->load->library('dbx');
	}

    // Read data from database to show data in admin page
    public function data($data) {
			$cari="";
			$cari="";
			//if ($this->input->post('iddepartemen')<>""){
				$cari=$cari." AND ta.replid='".$this->input->post('idtahunajaran')."' ";
			//}

				$cari=$cari." AND p.idcompany='".$this->input->post('idcompany')."'  ";
			

			if ($this->input->post('idprojek')<>""){
				$cari=$cari." AND p.replid='".$this->input->post('idprojek')."' ";
			}

				$sql = "SELECT pp.*,ta.departemen as iddepartemen,ta.tahunajaran as tahunajarantext, ta.idcompany,t.fase,k.kelas as kelastext,com.nama as companytext
							,CONCAT ('[',s.nis,'] ',s.nama) as siswatext,p.projektext,t.tingkat as tingkattext
						FROM ns_p5_projek_penilaian pp
						LEFT JOIN tahunajaran ta ON ta.replid=pp.idtahunajaran
						LEFT JOIN hrm_company com ON com.replid=ta.idcompany 
						LEFT JOIN siswa s ON s.replid=pp.idsiswa 
						LEFT JOIN kelas k ON k.replid=s.idkelas
						LEFT JOIN tingkat t ON t.replid=pp.idtingkat
						LEFT JOIN ns_p5_projek p ON p.replid=pp.idprojek 
						WHERE pp.replid>0 ".$cari." 
								";
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
			$data['idtahunajaran_opt'] = $this->dbx->opt("SELECT replid,CONCAT('[',departemen,'] ',tahunajaran) as nama FROM tahunajaran WHERE idcompany='".$this->input->post('idcompany')."' AND departemen='".$this->input->post('iddepartemen')."' ORDER BY aktif DESC ,nama DESC ",'up');
			$sqlprojek="SELECT p.replid,CONCAT(p.projektext) as nama 
						FROM ns_p5_projek p
						INNER JOIN tingkat t ON t.fase=p.fase 
						WHERE t.departemen='".$this->input->post('iddepartemen')."' AND p.idcompany='".$this->input->post('idcompany')."' ORDER BY p.aktif DESC ,p.nourut ASC ";
			$data['idprojek_opt'] = $this->dbx->opt($sqlprojek,'up');
			
			
			$data['idperiode_opt'] = $this->dbx->opt("SELECT replid,periode as nama FROM ns_periode ORDER BY nama");
			return $data;
    }

     //TAMBAH
    public function tambah_db($id='',$data) {
      	$sql="SELECT pp.*,ta.departemen as iddepartemen,ta.idcompany,t.fase 
      			FROM ns_p5_projek_penilaian pp
				LEFT JOIN tahunajaran ta ON ta.replid=pp.idtahunajaran
				LEFT JOIN kelas k ON k.replid=pp.idkelas
				LEFT JOIN tingkat t ON t.replid=k.idtingkat
      			WHERE pp.replid='".$id."'";
		//echo $sql;
        $data['isi'] = $this->dbx->rows($sql);
        if ($data['isi']== NULL ) {
					unset($data['isi']);
					$sql="SELECT ".$this->dbx->tablecolumn('ns_p5_projek_penilaian').", 0 as idcompany, 0 as idkelas,null as iddepartemen";
        	$data['isi']=$this->dbx->rows($sql);
        }

		$companyrow=$this->session->userdata('idcompany');
		$sqlcompany="SELECT replid,nama as nama
								FROM hrm_company
								WHERE replid IN (".$companyrow.") AND aktif=1
								ORDER BY nama";
		$data['idcompany_opt'] = $this->dbx->opt($sqlcompany,'up');

		$data['iddepartemen_opt'] = $this->dbx->opt("SELECT departemen as replid,departemen as nama FROM departemen WHERE aktif=1 AND replid IN (".$this->session->userdata('dept').") ORDER BY urutan",'up');
		//Tahun Ajaran
        //-----------------------------------------------------------------------------------------------
		$data['idtahunajaran_opt'] = $this->dbx->opt("SELECT replid,CONCAT('[',departemen,'] ',tahunajaran) as nama
																									FROM tahunajaran WHERE aktif=1 AND idcompany='".$data["isi"]->idcompany."' 
																									AND departemen='".$data["isi"]->iddepartemen."'
																									ORDER BY aktif DESC ,nama DESC  ",'up');
		$data['idkelas_opt'] = $this->dbx->opt("SELECT replid,kelas as nama FROM kelas
												WHERE ((aktif=1 AND idtahunajaran='".$data['isi']->idtahunajaran."' AND replid IN (".$this->session->userdata('kelas')."))
														OR replid='".$data['isi']->idkelas."')
												ORDER BY idtingkat",'up');
		/*											
		$sqlsiswa="SELECT replid,CONCAT(nama,' [ ',nis,' ]') as nama FROM siswa
											WHERE ( aktif=1 AND (idkelas='".$data["isi"]->idkelas."'OR kelasstatus='".$data["isi"]->idkelas."') )
																OR replid='".$data["isi"]->idsiswa."'
											ORDER BY nama";	
		
		*/									
		$sqlsiswa="SELECT s.replid,CONCAT(s.nama,' [ ',s.nis,' ] - ',k.kelas) as nama FROM siswa s
					INNER JOIN kelas k ON k.replid=s.idkelas
					WHERE s.aktif=1 AND k.idtahunajaran='".$data['isi']->idtahunajaran."' AND k.idtingkat='".$data["isi"]->idtingkat."'
					ORDER BY s.nama";	
		$data['idsiswa_opt'] = $this->dbx->opt($sqlsiswa,'up');								
		
		$data['idtingkat_opt'] = $this->dbx->opt("SELECT replid,tingkat as nama FROM tingkat WHERE aktif=1 AND departemen='".$data["isi"]->iddepartemen."' ORDER BY CAST(tingkat AS SIGNED) ASC",'up');
		
		$sqlprojek="SELECT p.replid,p.projektext as nama FROM ns_p5_projek p INNER JOIN tingkat t ON t.fase=p.fase WHERE t.replid='".$data["isi"]->idtingkat."'";
		$data['idprojek_opt'] = $this->dbx->opt($sqlprojek,'up');	
        return $data;
  }

  public function view_db($id,$data) {
	$sql="SELECT pp.*,ta.departemen as iddepartemen,ta.tahunajaran as tahunajarantext, ta.idcompany,t.fase,k.kelas as kelastext,com.nama as companytext
	,CONCAT ('[',s.nis,'] ',s.nama) as siswatext,p.projektext,t.keterangan as tingkattext,t.fase
			FROM ns_p5_projek_penilaian pp
			LEFT JOIN tahunajaran ta ON ta.replid=pp.idtahunajaran
			LEFT JOIN hrm_company com ON com.replid=ta.idcompany 
			LEFT JOIN kelas k ON k.replid=pp.idkelas
			LEFT JOIN tingkat t ON t.replid=pp.idtingkat
			LEFT JOIN siswa s ON s.replid=pp.idsiswa 
			LEFT JOIN ns_p5_projek p ON p.replid=pp.idprojek 
			WHERE pp.replid='".$id."'";
	//echo $sql;die;
  	$data['isi'] = $this->dbx->rows($sql);
	$capaiansql="SELECT *,esc.aktif as aktifesc,pc.idcapaian as idcapaian,ppn.idprojekpredikat 
				FROM ns_p5_dimensi d 
				INNER JOIN ns_p5_elemen e ON e.iddimensi=d.replid
				INNER JOIN ns_p5_elemen_sub es ON es.idelemen=e.replid
				INNER JOIN ns_p5_elemen_sub_capaian esc ON esc.idelemen_sub=es.replid
				INNER JOIN ns_p5_projek_capaian pc ON pc.idcapaian=esc.replid
				LEFT JOIN ns_p5_projek_penilaian_nilai ppn ON pc.idcapaian=ppn.idcapaian AND ppn.idprojekpenilaian='".$id."'
				WHERE pc.idprojek='".$data["isi"]->idprojek."'
				ORDER BY d.nourut ASC,e.nourut ASC,es.nourut ASC,esc.nourut ASC";
	//echo $capaiansql;die;
	$data['capaian']=$this->dbx->data($capaiansql);
	$data['idprojekpredikat_opt'] = $this->dbx->data("SELECT replid,refftext as nama FROM ns_p5_reff WHERE tipe='projekpredikat' ORDER BY nourut",'up');
	//$data['idsiswa'] = $this->dbx->data("SELECT replid,nama FROM siswa WHERE aktif=1 ORDER BY nama",'up');
	return $data;
  }
}

?>
