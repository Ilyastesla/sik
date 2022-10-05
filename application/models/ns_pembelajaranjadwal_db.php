<?php

Class ns_pembelajaranjadwal_db extends CI_Model {
	public function __construct() {
		parent::__construct();
		$this->load->library('dbx');
	}

    // Read data from database to show data in admin page
    public function index_table() {
    	$cari="";$data['show_table']=NULL;
		if ($this->input->post('filter')<>1){
    		$cari=$cari." AND pv.idtahunajaran IN (SELECT distinct ta.replid FROM tahunajaran ta, departemen d WHERE ta.departemen=d.departemen AND ta.aktif=1 AND d.replid IN (".$this->session->userdata('dept').")) AND pv.created_by='".$this->session->userdata('idpegawai')."' ";
    	}else{
				//if ($this->input->post('idtahunajaran')<>""){
					$cari=$cari." AND pv.idtahunajaran IN (".$this->input->post('idtahunajaran').") ";
				//}
				if ($this->input->post('idkelas')<>""){
					$cari=$cari." AND pv.idkelas='".$this->input->post('idkelas')."' ";
				}

				//if ($this->input->post('idperiode')<>""){
					$cari=$cari." AND pv.idperiode='".$this->input->post('idperiode')."' ";
				//}


				if ($this->input->post('idprosestipe')<>""){
					$cari=$cari." AND pv.idprosestipe='".$this->input->post('idprosestipe')."' ";
				}


				/*
				if ($this->input->post('idregion')<>""){
					$cari=$cari." AND pv.idregion='".$this->input->post('idregion')."' ";
				}
			*/
				if ($this->input->post('idmatpel')<>""){
					$cari=$cari." AND pv.idmatpel='".$this->input->post('idmatpel')."' ";
				}

				if ($this->input->post('created_by')<>""){
					$cari=$cari." AND pv.created_by='".$this->input->post('created_by')."' ";
				}

				if (($this->input->post('periode1')<>"") AND ($this->input->post('periode2')=="")){
					$cari=$cari." AND pv.tanggalkegiatan >= '".$this->p_c->tgl_db($this->input->post('periode1'))."' ";
				}
				if (($this->input->post('periode1')=="") AND ($this->input->post('periode2')<>"")){
					$cari=$cari." AND pv.tanggalkegiatan <= '".$this->p_c->tgl_db($this->input->post('periode2'))."' ";
				}
				if (($this->input->post('periode1')<>"") AND ($this->input->post('periode2')<>"")){
					$cari=$cari." AND pv.tanggalkegiatan BETWEEN '".$this->p_c->tgl_db($this->input->post('periode1'))."' AND '".$this->p_c->tgl_db($this->input->post('periode2'))."' ";
				}
		}
		$cari=$cari." AND ta.idcompany='".$this->input->post('idcompany')."' ";

				//,(SELECT COUNT(DISTINCT(idsiswa)) FROM ns_pengembangandirinilai WHERE idpembelajaranjadwal=pv.replid) jmlsiswa
      	$sql="SELECT pv.*,CONCAT('[',ps.iddepartemen,'] ',ps.prosestipe) as prosestipe,mp.matpel,mp.iddepartemen,ta.tahunajaran,k.kelas,p.periode
      				 ,ta.aktif as aktiftahunajaran,ps.nilaiwali,k.idwali
							 ,(SELECT COUNT(replid) FROM siswa WHERE idkelas=k.replid AND aktif=1) as jmlsiswa
							 ,(SELECT COUNT(idsiswa) FROM view_siswapembelajaranjadwal WHERE idpembelajaranjadwal=pv.replid) as jmlsiswajadwal
      			FROM ns_pembelajaranjadwal pv
      			LEFT JOIN ns_prosestipe ps ON ps.replid=pv.idprosestipe
      			LEFT JOIN ns_matpel mp ON mp.replid=pv.idmatpel
      			LEFT JOIN tahunajaran ta ON ta.replid=pv.idtahunajaran
      			LEFT JOIN kelas k ON k.replid=pv.idkelas
      			LEFT JOIN ns_periode p ON p.replid=pv.idperiode
      			WHERE pv.replid IS NOT NULL ".$cari.
      			"ORDER BY pv.tanggalkegiatan";
			  //echo $sql;die;
		//echo $this->input->post('filter');
		if ($this->input->post('filter')==1){
      		$data['show_table']=$this->dbx->data($sql);
		}

				//Tahun Ajaran
        //---------------------------------------------------------------------------------------------
        $data['idtahunajaran_opt'] = $this->dbx->opt("SELECT replid,CONCAT('[',departemen,'] ',tahunajaran) as nama FROM tahunajaran WHERE idcompany='".$this->input->post('idcompany')."' AND departemen='".$this->input->post('iddepartemen')."' ORDER BY aktif DESC ,nama DESC ",'up');

				//iddepartemen=(SELECT departemen FROM tahunajaran WHERE replid='".$this->input->post("idtahunajaran")."')
		$sqlproses="SELECT pt.replid,CONCAT('[',pt.iddepartemen,'] ',pt.prosestipe,' ',pt.keterangan, ' (',IF(pt.aktif=1,'A','T'),')') as nama,pt.iddepartemen
								FROM ns_prosestipe pt
								INNER JOIN ns_pembelajaranjadwal pj ON pj.idprosestipe=pt.replid
								WHERE pj.idtahunajaran='".$this->input->post('idtahunajaran')."' 
								ORDER BY pt.aktif DESC,nama ASC ";
      	$data['idprosestipe_opt'] = $this->dbx->opt($sqlproses,'up');

		
        //KELAS
        //-----------------------------------------------------------------------------------------------
				//AND replid IN (".$this->session->userdata('kelas').")
				$data['idkelas_opt'] = $this->dbx->opt("SELECT k.replid,CONCAT(t.tingkat,' - ',k.kelas) as nama 
														FROM kelas k 
														INNER JOIN tingkat t ON k.idtingkat=t.replid
														INNER JOIN ns_pembelajaranjadwal pj ON pj.idkelas=k.replid
														WHERE pj.idtahunajaran='".$this->input->post('idtahunajaran')."' 
        												AND k.aktif=1 AND k.idtahunajaran='".$this->input->post("idtahunajaran")."'
        												ORDER BY t.tingkat,k.kelas",'up');

        //Region
        //-----------------------------------------------------------------------------------------------
        //$data['idregion_opt'] = $this->dbx->opt("SELECT replid,region as nama FROM regional
        //									ORDER BY nama",'up');



        //Matpel
        //-----------------------------------------------------------------------------------------------
		//iddepartemen=(SELECT departemen FROM tahunajaran WHERE replid='".$this->input->post("idtahunajaran")."')
		$sqlmatpel="SELECT DISTINCT mp.replid,CONCAT('[',mp.iddepartemen,'] ',REPLACE(REPLACE(mp.matpel,'</i>',''),'<i>',''),' ',mp.keterangan, ' (',IF(mp.aktif=1,'A','T'),') ') as nama
        										FROM ns_matpel mp
												INNER JOIN ns_pembelajaranjadwal pj ON pj.idmatpel=mp.replid
												WHERE pj.idtahunajaran='".$this->input->post('idtahunajaran')."'
        										ORDER BY mp.aktif DESC, mp.iddepartemen ASC, mp.matpel ASC";
      	$data['idmatpel_opt'] = $this->dbx->opt($sqlmatpel,'up');


        $data['idperiode_opt'] = $this->dbx->opt("SELECT replid,periode as nama
        											FROM ns_periode ORDER BY nama");

        $data['created_by_opt'] = $this->dbx->opt("SELECT p.replid,p.nama as nama
        											FROM pegawai p 
													INNER JOIN ns_pembelajaranjadwal pj ON pj.created_by=p.replid
													WHERE pj.idtahunajaran='".$this->input->post('idtahunajaran')."'
													ORDER BY p.nama",'up');

				//echo var_dump($data['created_by_opt']);
		$companyrow=$this->session->userdata('idcompany');
		$sqlcompany="SELECT replid,nama as nama
								FROM hrm_company
								WHERE replid IN (".$companyrow.") AND aktif=1
								ORDER BY nama";
		$data['idcompany_opt'] = $this->dbx->opt($sqlcompany,'up');
		$data['iddepartemen_opt'] = $this->dbx->opt("SELECT departemen as replid,departemen as nama FROM departemen WHERE aktif=1 AND replid IN (".$this->session->userdata('dept').") ORDER BY urutan",'up');
		return $data;
    }

     //TAMBAH
    public function tambah_db($id='',$data) {
    	$data['id']=$id;
      	$sql="SELECT pj.*,ta.departemen as iddepartemen,ta.idcompany 
      			FROM ns_pembelajaranjadwal pj
				LEFT JOIN tahunajaran ta ON ta.replid=pj.idtahunajaran
      			WHERE pj.replid='".$id."'";
        $data['isi'] = $this->dbx->rows($sql);

        if ($data['isi']== NULL ) {
					unset($data['isi']);
					$sql="SELECT ".$this->dbx->tablecolumn('ns_pembelajaranjadwal').",1 as aktif, 0 as idcompany,0 as iddepartemen ";
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
		$data['idmodultipe_opt']=array(''=>'Pilih..','1'=>'1','2'=>'2','3'=>'3','4'=>'4','5'=>'5','6'=>'6','7'=>'7','8'=>'8','9'=>'9','10'=>'10','11'=>'11','12'=>'12','13'=>'13','14'=>'14','15'=>'15','16'=>'16','17'=>'17','18'=>'18');
		$departemencari="";
		if ($data["isi"]->idtahunajaran<>""){
				$dc=$this->dbx->rows("SELECT departemen FROM tahunajaran WHERE replid='".$data["isi"]->idtahunajaran."'");
				$departemencari=" AND iddepartemen='".$dc->departemen."'";
		}



				//KELAS
        //-----------------------------------------------------------------------------------------------
				$data['idkelas_opt'] = $this->dbx->opt("SELECT replid,kelas as nama FROM kelas
        												WHERE aktif=1 AND
        												idtahunajaran='".$data["isi"]->idtahunajaran."'
        												ORDER BY idtingkat",'up');
				//AND replid IN (".$this->session->userdata('kelas').")

				//proses Tipe
				//-----------------------------------------------------------------------------------------------
				$sqlproses="SELECT pt.replid,CONCAT('[',pt.iddepartemen,'] ',pt.prosestipe,' ',pt.keterangan, ' (',IF(pt.aktif=1,'A','T'),')') as nama
											FROM ns_prosestipe pt
											INNER JOIN ns_reff_company rc ON rc.idvariabel=pt.replid
											WHERE rc.tipe='ns_prosestipe' AND rc.idcompany='".$data["isi"]->idcompany."' AND pt.aktif=1 AND pt.iddepartemen='".$data["isi"]->iddepartemen."'
											ORDER BY pt.aktif DESC,nama ASC ";
				//echo $sqlproses;die;
				$data['idprosestipe_opt'] = $this->dbx->opt($sqlproses,"up");


        //Region
        //-----------------------------------------------------------------------------------------------
				/*
        $data['idregion_opt'] = $this->dbx->opt("SELECT replid,region as nama FROM regional
        												WHERE replid IN (SELECT DISTINCT region FROM siswa where idkelas='".$idkelas2."'  AND aktif=1 )
        												ORDER BY nama",'up');
				*/
        //Matpel
        //-----------------------------------------------------------------------------------------------
				//AND iddepartemen IN (SELECT departemen FROM departemen WHERE replid IN (".$this->session->userdata('dept')."))
				//$data['idmatpel_opt'] = $this->dbx->opt("SELECT replid,CONCAT('[',iddepartemen,'] ',matpel,' ',keterangan) as nama
				$data['idmatpel_opt'] = $this->dbx->opt("SELECT mp.replid,CONCAT(REPLACE(REPLACE(matpel,'</i>',''),'<i>',''),' ',mp.keterangan,' [',mpk.matpelkelompok,' ',mpk.keterangan,']') as nama
        										FROM ns_matpel mp
														INNER JOIN ns_reff_company rc ON rc.idvariabel=mp.replid
														LEFT JOIN ns_matpelkelompok mpk ON mpk.replid=mp.idmatpelkelompokraport13
        										WHERE rc.tipe='ns_matpel' AND rc.idcompany='".$data["isi"]->idcompany."' AND mp.aktif=1 AND ((mp.replid IN (
        											SELECT idmatpel FROM ns_matpeltingkat mt
        											INNER JOIN kelas k ON mt.idtingkat=k.idtingkat AND k.jurusan=mt.idjurusan
        											WHERE k.replid='".$data["isi"]->idkelas."' AND k.aktif=1
        										)) OR mp.replid='".$data["isi"]->idmatpel."')
        										ORDER BY mp.iddepartemen, nama",'up');
				//AND replid IN (".$this->session->userdata('matpel').")

				$data['idperiode_opt'] = $this->dbx->opt("SELECT replid,periode as nama
        											FROM ns_periode ORDER BY nama");

				$sqlrapot="SELECT rt.replid,CONCAT('[',rt.iddepartemen,'] ',rt.rapottipe,' ',rt.keterangan, ' (',IF(rt.aktif=1,'A','T'),')') as nama,(SELECT 1 FROM ns_pembelajaranjadwalrapottipe WHERE idpembelajaranjadwal='".$data["isi"]->replid."' AND idrapottipe=rt.replid) as checked
							FROM ns_rapottipe rt
							INNER JOIN ns_reff_company rc ON rc.idvariabel=rt.replid
							WHERE rc.tipe='ns_rapottipe' AND rc.idcompany='".$data["isi"]->idcompany."' AND rt.aktif=1 AND rt.iddepartemen='".$data["isi"]->iddepartemen."' ORDER BY rt.iddepartemen,rt.rapottipe";
        $data['idrapottipe_opt'] = $this->dbx->data($sqlrapot);
        return $data;
  }


   public function tambah_pdb($data) {
    	//echo print_r(array_values($data));die;
    	$this->db->trans_start();
        $this->db->insert('ns_pembelajaranjadwal', $data);
        $insert_id = $this->db->insert_id();
        if ($this->db->affected_rows() > 0) {
               $this->db->trans_complete();
               return $insert_id;
        } else {
        	$this->db->trans_complete();
            return false;
        }
     }

     public function ubah_pdb($data,$id) {
        $this->db->where('replid',$id);
        $this->db->update('ns_pembelajaranjadwal', $data);
        if ($this->db->_error_number() == 0) {
            return true;
        } else {
            return false;
        }
    }


    // RAPOT TIPE
    //-------------------------------------------------------------------------------------------
    public function tambahrapottipe_db($data) {
    	//echo print_r(array_values($data));die;
    	$this->db->trans_start();
        $this->db->insert('ns_pembelajaranjadwalrapottipe', $data);
        $insert_id = $this->db->insert_id();
        if ($this->db->affected_rows() > 0) {
               $this->db->trans_complete();
               return true;
        } else {
        	$this->db->trans_complete();
            return false;
        }
     }

    public function hapusrapottipe_db($id) {
        // Query to check whether username already exist or not
        $this->db->where('idpembelajaranjadwal',$id);
        $this->db->delete('ns_pembelajaranjadwalrapottipe');
        if ($this->db->_error_number() == 0) {
	        return true;
        } else {
            return false;
        }
    }


    // PENILAIAN
	//-------------------------------------------------------------------------------------------
	public function view_db($id,$data) {
				//,r.region
				// LEFT JOIN regional r ON r.replid=pv.idregion
      	$sql="SELECT pv.*,CONCAT('[',ps.iddepartemen,'] ',ps.prosestipe,' ',ps.keterangan) as prosestipe,mp.matpel
										,mp.iddepartemen,ta.tahunajaran,k.kelas,p.periode,ta.aktif as aktiftahunajaran, mp.kkm,ta.aktif as aktiftahunajaran
										,ps.nilaiwali,ps.iddepartemen,k.idwali
									,(SELECT COUNT(*) FROM ns_pengembangandirinilai WHERE idpembelajaranjadwal=pv.replid) as jmlsiswakelas
      			FROM ns_pembelajaranjadwal pv
      			LEFT JOIN ns_prosestipe ps ON ps.replid=pv.idprosestipe
      			LEFT JOIN ns_matpel mp ON mp.replid=pv.idmatpel
      			LEFT JOIN tahunajaran ta ON ta.replid=pv.idtahunajaran
      			LEFT JOIN kelas k ON k.replid=pv.idkelas
      			LEFT JOIN ns_periode p ON p.replid=pv.idperiode
      			WHERE pv.replid='".$id."'";
      	$data['isi'] = $this->dbx->rows($sql);


				if ($data["isi"]->nonreguler<>1){
					$kelasreg=" s.region ";
					$kelasfil=" AND s.idkelas='".$data['isi']->idkelas."' ";
				}else{
					$kelasreg="  s.regionalstatus ";
					$kelasfil=" AND s.kelasstatus='".$data['isi']->idkelas."' AND s.kondisi<>39";
				}

				if($data["edit"]=="1"){
									//AND s.region='".$data['isi']->idregion."'
									$idrapottipe_sql="SELECT rt.replid,CONCAT('[',rt.iddepartemen,'] ',rt.rapottipe,' ',rt.keterangan, ' (',IF(rt.aktif=1,'A','T'),')') as nama
					        											,(SELECT 1 FROM ns_pembelajaranjadwalrapottipe WHERE idpembelajaranjadwal='".$id."' AND idrapottipe=rt.replid) as 'checked'
					        											FROM ns_rapottipe rt
																				WHERE aktif=1 AND iddepartemen IN (SELECT departemen FROM departemen WHERE replid IN (".$this->session->userdata('dept').")) AND iddepartemen='".$data["isi"]->iddepartemen."' ORDER BY rt.rapottipe";

									/*
									$siswa_sql="SELECT s.*,(s.tgl_masuk<='".$data['isi']->tanggalkegiatan."') as dftr
																		 ,(select terdaftar from ns_pengembangandirinilai where idsiswa=s.replid and idpembelajaranjadwal='".$id."'  limit 1) as terdaftar
																		 ,(select sakit from ns_pengembangandirinilai where idsiswa=s.replid and idpembelajaranjadwal='".$id."'  limit 1) as sakit
																		 ,(select izin from ns_pengembangandirinilai where idsiswa=s.replid and idpembelajaranjadwal='".$id."'  limit 1) as izin
																		 ,(select alpha from ns_pengembangandirinilai where idsiswa=s.replid and idpembelajaranjadwal='".$id."'  limit 1) as alpha
																		 ,(select tugas from ns_pengembangandirinilai where idsiswa=s.replid and idpembelajaranjadwal='".$id."'  limit 1) as tugas
																		 FROM siswa s
																		 WHERE s.aktif=1 AND s.idkelas='".$data['isi']->idkelas."'
																		 ORDER by s.nama";
									*/
									//echo $data['isi']->jmlsiswakelas;die;
									if ($data['isi']->jmlsiswakelas>0){
												/*
												if($data['isi']->aktiftahunajaran=="1"){
													$sqlinsertsiswa="SELECT * FROM siswa s WHERE s.idkelas='".$data['isi']->idkelas."' ";
													echo $sqlinsertsiswa;
													die;
												}
												*/
												//s.aktif=1  AND
												$siswa_sql="SELECT DISTINCT s.replid,s.nama,s.nis,s.region as siswaregion,pdn.idregion as region,s.regionalstatus,s.tgl_masuk,(s.tgl_masuk<='".$data['isi']->tanggalkegiatan."') as dftr,terdaftar,sakit,izin,alpha,tugas, r.region as regiontext
				 											 				FROM siswa s
				 															LEFT JOIN ns_pengembangandirinilai pdn ON s.replid=pdn.idsiswa
				 															LEFT JOIN regional r ON pdn.idregion=r.replid
				 															WHERE idpembelajaranjadwal='".$id."'
				 											 				 GROUP BY s.replid ORDER by s.nama";
									}else{
										//LEFT JOIN ns_pengembangandirinilai pdn ON s.replid=pdn.idsiswa AND idpembelajaranjadwal='".$id."'
										//LEFT JOIN regional r ON pdn.idregion=r.replid

												$siswa_sql="SELECT DISTINCT s.replid,s.nama,s.nis,s.region as siswaregion,'' as region,s.regionalstatus,s.tgl_masuk,(s.tgl_masuk<='".$data['isi']->tanggalkegiatan."') as dftr
																			,2 as terdaftar,0 as sakit,0 as izin,0 as alpha,0 as tugas, r.region as regiontext
				 											 				FROM siswa s
																			LEFT JOIN regional r ON ".$kelasreg."=r.replid
				 															WHERE s.aktif=1  ".$kelasfil."
				 											 				 GROUP BY s.replid ORDER by s.nama";
									}
									//INNER JOIN ns_prosestipe pt ON pt.replid=pv.idprosestipe
									//AND pt.replid='".$data['isi']->idprosestipe."'  AND pt.aktif=1
									$pengembangandirivariabel_sql="SELECT pdv.* FROM ns_pengembangandirivariabel pdv
																INNER JOIN ns_prosessubvariabel psv ON psv.replid=pdv.idprosessubvariabel
																INNER JOIN ns_prosesvariabel pv ON pv.replid=psv.idprosesvariabel
																WHERE pdv.aktif=1 AND psv.aktif=1 AND pv.aktif=1
																AND pv.idprosestipe='".$data['isi']->idprosestipe."' ORDER BY pdv.no_urut";
				}else{
								// untuk view doank
								$idrapottipe_sql="SELECT rt.replid,CONCAT('[',rt.iddepartemen,'] ',rt.rapottipe,' ',rt.keterangan, ' (',IF(rt.aktif=1,'A','T'),')') as nama,1 as 'checked'
																						FROM ns_pembelajaranjadwalrapottipe jrt
																						INNER JOIN ns_rapottipe rt ON jrt.idrapottipe=rt.replid
																						WHERE jrt.idpembelajaranjadwal='".$id."'";

								$siswa_sql="SELECT DISTINCT s.replid,s.nama,s.nis,s.region as siswaregion,pdn.idregion as region,s.regionalstatus,pdn.terdaftar,pdn.sakit,pdn.izin,pdn.alpha,s.tgl_masuk,pdn.tugas, r.region as regiontext
																	FROM ns_pengembangandirinilai pdn
																	INNER JOIN siswa s ON s.replid=pdn.idsiswa
																	LEFT JOIN regional r ON pdn.idregion=r.replid
																	WHERE idpembelajaranjadwal='".$id."'
																	GROUP BY s.replid ORDER BY s.nama";

								$pengembangandirivariabel_sql="SELECT DISTINCT pdv.*
														FROM ns_pengembangandirivariabel pdv
														INNER JOIN ns_pengembangandirinilai pdn ON pdv.replid=pdn.idpengembangandirivariabel
														WHERE pdn.idpembelajaranjadwal='".$id."' ORDER BY pdv.no_urut";
				}
				//echo $pengembangandirivariabel_sql;die;
				//echo $siswa_sql;die;
				$data['idrapottipe_opt'] = $this->dbx->data($idrapottipe_sql);
      			$data['siswa']=$this->dbx->data($siswa_sql);
				//echo $pengembangandirivariabel_sql;die;
				$data['pengembangandirivariabel']=$this->dbx->data($pengembangandirivariabel_sql);
				//AND idsiswa='".$rowsiswa->replid."' AND idpengembangandirivariabel='".$rowpdv2->replid."'
				$pengembangandirinilai_sql="SELECT CONCAT(idsiswa,'/',idpengembangandirivariabel) as idnilai,nilai FROM ns_pengembangandirinilai WHERE idpembelajaranjadwal='".$id."' ORDER BY idsiswa";
				//echo $pengembangandirinilai_sql;die;
				$data['pengembangandirinilai']=$this->dbx->data($pengembangandirinilai_sql);
      	return $data;
    }


    public function tambahnilai_pdb($data) {
    		//echo print_r(array_values($data));die;
    		$this->db->trans_start();
        $this->db->insert('ns_pengembangandirinilai', $data);
        $insert_id = $this->db->insert_id();
        if ($this->db->affected_rows() > 0) {
               $this->db->trans_complete();
               return true;
        } else {
        	$this->db->trans_complete();
            return false;
        }
     }

    public function hapusnilai_pdb($id) {
        // Query to check whether username already exist or not
        $this->db->where('idpembelajaranjadwal',$id);
        $this->db->delete('ns_pengembangandirinilai');
        if ($this->db->_error_number() == 0) {
	        return true;
        } else {
            return false;
        }
    }

    // HAPUS ALL
    //-------------------------------------------------------------------------------------------
    public function hapus_pdb($id) {
        // Query to check whether username already exist or not
        $this->db->where('replid',$id);
        $this->db->delete('ns_pembelajaranjadwal');
        if ($this->db->_error_number() == 0) {
	        return true;
        } else {
            return false;
        }
    }

		public function absensi_db($id,$data) {
					//,r.region
					// LEFT JOIN regional r ON r.replid=pv.idregion
	      	$sql="SELECT pv.*,CONCAT('[',ps.iddepartemen,'] ',ps.prosestipe) as prosestipe,mp.matpel,mp.iddepartemen,ta.tahunajaran,k.kelas,p.periode,ta.aktif as aktiftahunajaran, mp.kkm,ta.aktif as aktiftahunajaran,ps.nilaiwali,ps.iddepartemen
										,(SELECT COUNT(*) FROM ns_pengembangandirinilai WHERE idpembelajaranjadwal=pv.replid) as jmlsiswakelas
	      			FROM ns_pembelajaranjadwal pv
	      			LEFT JOIN ns_prosestipe ps ON ps.replid=pv.idprosestipe
	      			LEFT JOIN ns_matpel mp ON mp.replid=pv.idmatpel
	      			LEFT JOIN tahunajaran ta ON ta.replid=pv.idtahunajaran
	      			LEFT JOIN kelas k ON k.replid=pv.idkelas
	      			LEFT JOIN ns_periode p ON p.replid=pv.idperiode
	      			WHERE pv.replid='".$id."'";
	      	$data['isi'] = $this->dbx->rows($sql);

					$siswa_sql="SELECT DISTINCT s.replid,s.nama,s.nis,s.region as siswaregion,pdn.idregion as region,s.regionalstatus,s.tgl_masuk,(s.tgl_masuk<='".$data['isi']->tanggalkegiatan."') as dftr,terdaftar,sakit,izin,alpha,tugas, r.region as regiontext
								 				FROM siswa s
												LEFT JOIN ns_pengembangandirinilai pdn ON s.replid=pdn.idsiswa
												LEFT JOIN regional r ON pdn.idregion=r.replid
												WHERE idpembelajaranjadwal='".$id."'
								 				 GROUP BY s.replid ORDER by s.nama";

	      	$data['siswa']=$this->dbx->data($siswa_sql);

					$pengembangandirivariabel_sql="SELECT pdv.* FROM ns_pengembangandirivariabel pdv
												INNER JOIN ns_prosessubvariabel psv ON psv.replid=pdv.idprosessubvariabel
												INNER JOIN ns_prosesvariabel pv ON pv.replid=psv.idprosesvariabel
												WHERE pdv.aktif=1 AND psv.aktif=1 AND pv.aktif=1
												AND pv.idprosestipe='".$data['isi']->idprosestipe."' ORDER BY pdv.no_urut";
	      	$data['pengembangandirivariabel']=$this->dbx->data($pengembangandirivariabel_sql);
					//AND idsiswa='".$rowsiswa->replid."' AND idpengembangandirivariabel='".$rowpdv2->replid."'
					return $data;
	    }

			public function refreshsiswa_pdb($id,$idkelas) {
				$idpengembangandirivariabel="";
				$sql="DELETE from ns_pengembangandirinilai WHERE idpembelajaranjadwal='".$id."' AND idsiswa NOT IN (SELECT replid FROM siswa WHERE aktif=1 AND idkelas='".$idkelas."') ";
				//$result=$this->db->query($sql);


				$sql="SELECT DISTINCT(n.idpengembangandirivariabel ),j.tanggalkegiatan FROM ns_pengembangandirinilai n
							INNER JOIN ns_pembelajaranjadwal j ON n.idpembelajaranjadwal=j.replid
							WHERE n.idpembelajaranjadwal='".$id."'";
				$idpengembangandirivariabel=$this->dbx->data($sql);

				foreach((array)$idpengembangandirivariabel as $rowpdv){
					$sql="INSERT INTO ns_pengembangandirinilai(idpembelajaranjadwal,idsiswa,idpengembangandirivariabel,terdaftar,idregion)
								(SELECT '".$id."',replid,'".$rowpdv->idpengembangandirivariabel."',(tgl_masuk<='".$rowpdv->tanggalkegiatan."') as dftr,region
								FROM siswa WHERE aktif=1 AND idkelas='".$idkelas."' AND replid NOT IN (SELECT idsiswa FROM ns_pengembangandirinilai WHERE idpembelajaranjadwal='".$id."'))";
					//echo $sql."<br/>";
					$result=$this->db->query($sql);
				}
				//die;

				return $result;
			}
}

?>
