<?php

Class ns_rapot_db extends CI_Model {
	public function __construct() {
		parent::__construct();
		$this->load->library('dbx');
	}

    // Read data from database to show data in admin page
    public function data() {
    	$cari="";
			if ($this->input->post('filter')<>1){
    		$cari=$cari." AND pv.idtahunajaran IN (SELECT distinct ta.replid FROM tahunajaran ta, departemen d WHERE ta.departemen=d.departemen AND ta.aktif=1 AND d.replid IN (".$this->session->userdata('dept').")) AND pv.created_by='".$this->session->userdata('idpegawai')."' ";
    	}else{
				//if ($this->input->post('idtahunajaran')<>""){
		    	$cari=$cari." AND pv.idtahunajaran='".$this->input->post('idtahunajaran')."' ";
	    	//}
				//if ($this->input->post('idperiode')<>""){
		    	$cari=$cari." AND pv.idperiode='".$this->input->post('idperiode')."' ";
	    	//}


	    	if ($this->input->post('idkelas')<>""){
		    	$cari=$cari." AND pv.idkelas='".$this->input->post('idkelas')."' ";
	    	}

				if ($this->input->post('idrapottipe')<>""){
		    	$cari=$cari." AND pv.idrapottipe='".$this->input->post('idrapottipe')."' ";
	    	}

	    	if ($this->input->post('idregion')<>""){
		    	$cari=$cari." AND pv.idregion='".$this->input->post('idregion')."' ";
	    	}

				if ($this->input->post('created_by')<>""){
		    	$cari=$cari." AND pv.created_by='".$this->input->post('created_by')."' ";
	    	}
			}

    	$sql="SELECT pv.*,ta.tahunajaran,k.kelas,r.region,s.nama as namasiswa,CONCAT(rt.rapottipe,' ',rt.keterangan) as rapottipe,ta.departemen,p.periode,ta.aktif as aktiftahunajaran ,CONCAT ('[',px.nip,'] ',px.nama) as created_bytext
    			FROM ns_rapot pv
    			LEFT JOIN tahunajaran ta ON ta.replid=pv.idtahunajaran
    			LEFT JOIN kelas k ON k.replid=pv.idkelas
    			LEFT JOIN regional r ON r.replid=pv.idregion
    			LEFT JOIN siswa s ON s.replid=pv.idsiswa
    			LEFT JOIN ns_rapottipe rt ON rt.replid=pv.idrapottipe
    			LEFT JOIN ns_periode p ON p.replid=pv.idperiode
					LEFT JOIN pegawai px ON px.replid=pv.created_by
    			WHERE ta.idcompany='".$this->session->userdata('idcompany')."' AND rt.k13<>1 ".$cari."
    			ORDER BY pv.tanggalkegiatan";
        //WHERE mp.replid IN (".$this->session->userdata('matpel').")
      	$data['show_table']=$this->dbx->data($sql);

				$departemencari="";
				if ($this->input->post('idtahunajaran')<>""){
						$dc=$this->dbx->rows("SELECT departemen FROM tahunajaran WHERE replid='".$this->input->post('idtahunajaran')."'");
						$idtahunajaranfil=$this->input->post('idtahunajaran');
				}else{
					$dc=$this->dbx->rows("SELECT replid,departemen FROM tahunajaran WHERE departemen IN (SELECT departemen FROM departemen  WHERE replid IN (".$this->session->userdata('dept').")) ORDER BY aktif DESC ,CONCAT('[',departemen,'] ',tahunajaran) DESC LIMIT 1");
					$idtahunajaranfil=$dc->replid;
				}
				$departemencari=" AND iddepartemen='".$dc->departemen."'";

        //Tahun Ajaran
        //-----------------------------------------------------------------------------------------------
        $data['idtahunajaran_opt'] = $this->dbx->opt("SELECT replid,CONCAT(' [',departemen,'] ',tahunajaran) as nama FROM tahunajaran WHERE  idcompany='".$this->input->post('idcompany')."' AND departemen IN (SELECT departemen FROM departemen WHERE replid IN (".$this->session->userdata('dept').")) ORDER BY aktif DESC ,nama DESC  ",'up',1);


        //KELAS
        //-----------------------------------------------------------------------------------------------
				$data['idkelas_opt'] = $this->dbx->opt("SELECT k.replid,CONCAT(t.tingkat,' - ',k.kelas) as nama FROM kelas k INNER JOIN tingkat t ON k.idtingkat=t.replid
        												WHERE k.aktif=1 AND k.idtahunajaran='".$idtahunajaranfil."'
        												ORDER BY t.tingkat,k.kelas",'up');


        //Region
        //-----------------------------------------------------------------------------------------------
        $data['idregion_opt'] = $this->dbx->opt("SELECT replid,region as nama FROM regional
        										ORDER BY nama",'up');


        //Tipe Rapor
        //-----------------------------------------------------------------------------------------------

		$data['idrapottipe_opt'] = $this->dbx->opt("SELECT replid,CONCAT('[',iddepartemen,'] ',rapottipe,' ',keterangan, ' (',IF(aktif=1,'A','T'),')') as nama FROM ns_rapottipe WHERE k13<>1 AND iddepartemen IN (SELECT departemen FROM departemen WHERE replid IN (".$this->session->userdata('dept').")) ".$departemencari." ORDER BY aktif DESC, nama ASC",'up');


        $data['idperiode_opt'] = $this->dbx->opt("SELECT replid,periode as nama
        											FROM ns_periode ORDER BY nama");
        $data['created_by_opt'] = $this->dbx->opt("SELECT replid,nama as nama
        											FROM pegawai ORDER BY nama",'up');
		$companyrow=$this->session->userdata('idcompany');
		$sqlcompany="SELECT replid,nama as nama
								FROM hrm_company
								WHERE replid IN (".$companyrow.") AND aktif=1
								ORDER BY nama";
		$data['idcompany_opt'] = $this->dbx->opt($sqlcompany,'up');
        return $data;
    }

     //TAMBAH
    public function tambah_db($id='',$data) {
    	$data['id']=$id;
			if($data['idkelas2']<>""){
				$sql="SELECT k.*,p.nama as namawalikelas
	      			FROM kelas k INNER JOIN pegawai p ON p.nip=k.idwali
	      			WHERE k.replid='".$data['idkelas2']."'";
	        $data['datawalikelas'] = $this->dbx->rows($sql);
			}
			$sql="SELECT *
      			FROM ns_rapot
      			WHERE replid='".$id."'";
        $data['isi'] = $this->dbx->rows($sql);

        if ($data['isi']== NULL ) {
        	unset($data['isi']);
        	$sql="SELECT
        			NULL as replid,
					current_date() as tanggalkegiatan,
					NULL as idtahunajaran,
					NULL as idperiode,
					NULL as idkelas,
					NULL as idregion,
					0 as nonreguler,
					NULL as idsiswa,
					NULL as idrapottipe,
					NULL as keterangan,
					NULL as created_date,
					NULL as created_by,
					NULL as modified_date,
					NULL as modified_by
					,1 as tampilna
					,NULL as idtahunajaranrapot
					,NULL as external
					,NULL as nomordokumen
					";
        	$data['isi']=$this->dbx->rows($sql);
        }

        $data['idtahunajaran_opt'] = $this->dbx->opt("SELECT replid,CONCAT('[',departemen,'] ',tahunajaran) as nama FROM tahunajaran WHERE  idcompany='".$this->input->post('idcompany')."' AND idcompany='".$this->session->userdata('idcompany')."' AND (aktif=1 OR replid='".$data['isi']->idtahunajaran."') and departemen IN (SELECT departemen FROM departemen WHERE replid IN (".$this->session->userdata('dept').")) ORDER BY aktif DESC ,nama DESC ",'up');

        $data['idkelas_opt'] = $this->dbx->opt("SELECT replid,kelas as nama FROM kelas
        												WHERE ((aktif=1 AND idtahunajaran='".$data['isi']->idtahunajaran."' AND replid IN (".$this->session->userdata('kelas').")) OR replid='".$data['isi']->idkelas."')
        												ORDER BY idtingkat",'up');

        $data['idregion_opt'] = $this->dbx->opt("SELECT replid,region as nama FROM regional
        												ORDER BY nama",'up');

        //$kelasfilquery=" AND ((idkelas='".$idkelas2."' AND region='".$idregion2."') OR (kelasstatus='".$idkelas2."' ) AND regionalstatus='".$idregion2."') ";
				$sqlsiswa="SELECT replid,CONCAT(nama,' [ ',nis,' ]') as nama FROM siswa
        												WHERE ( aktif=1 AND idkelas='".$data["isi"]->idkelas."') OR (kelasstatus='".$data["isi"]->idkelas."' )  OR replid='".$data["isi"]->idsiswa."'
        												ORDER BY nama";

        $data['idsiswa_opt'] = $this->dbx->opt($sqlsiswa,'up');
				if ((count($data['idsiswa_opt'])<=1) and ($data['isi']->idsiswa<>"")){
						$data['idsiswa_opt'] = $this->dbx->opt("SELECT replid,CONCAT(nama,' [ ',nis,' ]') as nama FROM siswa WHERE replid='".$data['isi']->idsiswa."'",'up');
				}

        $data['idrapottipe_opt'] = $this->dbx->opt("SELECT replid,CONCAT('[',iddepartemen,'] ',rapottipe,' ','sss', ' (',IF(aktif=1,'A','T'),')') as nama FROM ns_rapottipe WHERE k13<>1 AND aktif=1 AND iddepartemen IN (SELECT departemen FROM tahunajaran  WHERE replid='".$data['isi']->idtahunajaran."') ORDER BY nama ",'up');

        $data['idperiode_opt'] = $this->dbx->opt("SELECT replid,periode as nama FROM ns_periode ORDER BY nama");
				$data['idtahunajaranrapot_opt'] = $this->dbx->opt("SELECT replid,CONCAT('[',departemen,'] ',tahunajaran) as nama FROM tahunajaran WHERE idcompany='".$this->session->userdata('idcompany')."' AND departemen IN (SELECT departemen FROM tahunajaran  WHERE replid='".$data['isi']->idtahunajaran."') ORDER BY aktif DESC ,nama DESC" ,'up');
        return $data;
  }


   public function tambah_pdb($data) {
    	//echo print_r(array_values($data));die;
    	$this->db->trans_start();
        $this->db->insert('ns_rapot', $data);
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
        $this->db->update('ns_rapot', $data);
        if ($this->db->_error_number() == 0) {
            return true;
        } else {
            return false;
        }
    }


    // RAPOT
	//-------------------------------------------------------------------------------------------
	public function view_db($id,$data) {
      	$sql="SELECT pv.*,YEAR(pv.tanggalkegiatan) as tahunkegiatan,ta.tahunajaran,tar.tahunajaran as tahunajaranrapot
							,k.kelas, jr.jurusan
						 ,r.region,s.nama as namasiswa,rt.rapottipe,ta.departemen
      			,s.nama as siswa, s.nis, s.nisn,p.periode,rt.nilaimurni,rt.absensi,rt.grafik,rt.gruppengembangandiri,rt.lpd
      			,ks.kelompok as kelompoksiswa
      			,s.replid as replidsiswa,s.tmplahir,s.tgllahir,s.nomorpeserta
						 ,rt.kkm as kkmon,rt.predikat as predikaton,rt.kalimatrapor as kalimatraporon,rt.kopsurat
						 ,rt.besarfont
						 ,ta.aktif as aktiftahunajaran
						 ,rt.portraitview,rt.jumlahdata,rt.namajenjang,rt.predikattipe,rt.psikologon,rt.tipe
						 ,d.keterangan as departemenpanjang
						 ,k.idwali
						 ,ta.idkepsek,ta.idpsikolog,ta.idkonselor
						 ,rt.batasnilai,com.nama as companytext,com.city as citytext,com.logo as logotext 
      			FROM ns_rapot pv
      			LEFT JOIN tahunajaran ta ON ta.replid=pv.idtahunajaran
						LEFT JOIN tahunajaran tar ON tar.replid=pv.idtahunajaranrapot
      			LEFT JOIN kelas k ON k.replid=pv.idkelas
						LEFT JOIN jurusan jr ON jr.replid=k.jurusan
      			LEFT JOIN kelompoksiswa ks ON ks.replid=k.kelompok_siswa
      			LEFT JOIN regional r ON r.replid=pv.idregion
      			LEFT JOIN siswa s ON s.replid=pv.idsiswa
      			LEFT JOIN ns_rapottipe rt ON rt.replid=pv.idrapottipe
      			LEFT JOIN ns_periode p ON p.replid=pv.idperiode
      			LEFT JOIN departemen d ON ta.departemen=d.departemen
						LEFT JOIN hrm_company com ON com.replid=ta.idcompany
      			WHERE pv.replid='".$id."'";
				//echo $sql;die;

      	$data['isi'] = $this->dbx->rows($sql);
				$this->db->query("DROP TABLE IF EXISTS temp_pdn_".$data["isi"]->replidsiswa.";");
				$sqltemp="	CREATE TEMPORARY TABLE temp_pdn_".$data["isi"]->replidsiswa."
										SELECT * FROM ns_pengembangandirinilai pdn
										WHERE pdn.terdaftar = 1
										AND pdn.idregion = '".$data["isi"]->idregion."'
										AND pdn.idsiswa = '".$data["isi"]->replidsiswa."';";
				//echo $sqltemp;die;
				$this->db->query($sqltemp);
				/*
				$sqlpdn="SELECT DISTINCT idpembelajaranjadwal as isi
								  FROM ns_pengembangandirinilai pdn
									WHERE pdn.idsiswa = '".$data["isi"]->replidsiswa."' AND pdn.idregion = '".$data["isi"]->idregion."'
									AND pdn.terdaftar = 1";
				$pdn=$this->dbx->data($sqlpdn);
				*/
				//echo $this->p_c->arraybreak($pdn,',');die;

				if (($data['isi']->tipe<>'Grafik') and ($data['isi']->tipe<>'LPD')){
						//,mpk2.persentase
						//echo $data["isi"]->idrapottipe;die;
						if (($data['isi']->tipe=='Reguler') OR ($data['isi']->tipe=='Evaluasi')){
							/*
							$sqlkel="SELECT DISTINCT mpk.matpelkelompok,pj.idtahunajaran,mpk.detail
		      							,mp.replid,mp.matpel,mp.kkm,mp.idmatpelkelompokpersentase
		      							,rm.persentase,mp.idmatpelkelompok
												,mp.external as matpelexternal
												,pj.idmatpel
		      					FROM ns_pembelajaranjadwal pj
										INNER JOIN ns_pengembangandirinilai pdn ON pdn.idpembelajaranjadwal=pj.replid
								INNER JOIN ns_matpel mp ON mp.replid=pj.idmatpel
								INNER JOIN ns_matpelkelompok mpk ON mpk.replid=mp.idmatpelkelompokraport
								INNER JOIN ns_pembelajaranjadwalrapottipe pjrt ON pjrt.idpembelajaranjadwal=pj.replid
								LEFT JOIN ns_rapotmapping rm ON rm.idrapottipe=pjrt.idrapottipe AND rm.nonreguler=pj.nonreguler AND rm.idmatpelkelompok=mp.idmatpelkelompok AND rm.idregion=pdn.idregion
								WHERE
														pdn.idsiswa='".$data["isi"]->replidsiswa."'
														AND pdn.idregion='".$data["isi"]->idregion."'
														AND pdn.terdaftar=1
														AND pj.idtahunajaran='".$data["isi"]->idtahunajaran."'
														AND pj.idperiode='".$data["isi"]->idperiode."'
														AND pj.idkelas='".$data["isi"]->idkelas."'
														AND pjrt.idrapottipe='".$data["isi"]->idrapottipe."'
														AND mp.hitungnilai=1
								ORDER BY mpk.no_urut,mp.no_urut
								";
								*/

								$sqlkel="SELECT DISTINCT mpk.matpelkelompok,pj.idtahunajaran,mpk.detail
			      							,mp.replid,mp.matpel,mp.kkm,mp.idmatpelkelompokpersentase
			      							,rm.persentase,mp.idmatpelkelompok
													,mp.external as matpelexternal
													,pj.idmatpel
			      					FROM ns_pembelajaranjadwal pj
									INNER JOIN ns_matpel mp ON mp.replid=pj.idmatpel
									INNER JOIN ns_matpelkelompok mpk ON mpk.replid=mp.idmatpelkelompokraport
									INNER JOIN ns_pembelajaranjadwalrapottipe pjrt ON pjrt.idpembelajaranjadwal=pj.replid
									LEFT JOIN ns_rapotmapping rm ON rm.idrapottipe=pjrt.idrapottipe AND rm.nonreguler=pj.nonreguler AND rm.idmatpelkelompok=mp.idmatpelkelompok
									AND rm.idregion='".$data["isi"]->idregion."'
									WHERE
															pj.idtahunajaran='".$data["isi"]->idtahunajaran."'
															AND pj.idperiode='".$data["isi"]->idperiode."'
															AND pj.idkelas='".$data["isi"]->idkelas."'
															AND pjrt.idrapottipe='".$data["isi"]->idrapottipe."'
															AND mp.hitungnilai=1
															AND pj.replid IN (
																SELECT DISTINCT idpembelajaranjadwal FROM temp_pdn_".$data['isi']->replidsiswa."
															)
									ORDER BY mpk.no_urut,mp.no_urut
									";
						}else{
							//TRIM((pdv.persentasemurni/100)*pdn.nilai)+0
							$sqlkel="SELECT mpk.matpelkelompok,pj.idtahunajaran,mpk.detail
		      							,mp.replid as idmatpel,mp.matpel,mp.kkm,mp.idmatpelkelompokpersentase
		      							,mp.idmatpelkelompok
												,mp.external as matpelexternal
												,pdv.pengembangandirivariabel
												,pdn.nilai as nilaiasli,((pdv.persentasemurni/100)*pdn.nilai) as nilai
												,psv.prosessubvariabel,psv.persentasemurnisv
		      					FROM ns_pembelajaranjadwal pj
										INNER JOIN ns_pembelajaranjadwalrapottipe pjrt ON pjrt.idpembelajaranjadwal=pj.replid
										INNER JOIN ns_matpel mp ON mp.replid=pj.idmatpel
										INNER JOIN ns_matpelkelompok mpk ON mpk.replid=mp.idmatpelkelompokraport
										INNER JOIN ns_pengembangandirinilai pdn ON pdn.idpembelajaranjadwal=pj.replid
										INNER JOIN ns_pengembangandirivariabel pdv ON pdv.replid=pdn.idpengembangandirivariabel
										INNER JOIN ns_prosessubvariabel psv ON psv.replid=pdv.idprosessubvariabel
								WHERE
														pdn.idsiswa='".$data["isi"]->replidsiswa."'
														AND pdn.idregion='".$data["isi"]->idregion."'
														AND pdn.terdaftar=1
														AND pj.idtahunajaran='".$data["isi"]->idtahunajaran."'
														AND pj.idperiode='".$data["isi"]->idperiode."'
														AND pj.idkelas='".$data["isi"]->idkelas."'
														AND pjrt.idrapottipe='".$data["isi"]->idrapottipe."'
														AND mp.hitungnilai=1
								ORDER BY mpk.no_urut,mp.no_urut,psv.no_urut,pdv.no_urut
								";
						}


					//echo $sqlkel;die;
					$data['kelompok']=$this->dbx->data($sqlkel);


					$sqlpredikat = "SELECT predikat FROM ns_predikat WHERE iddepartemen='".$data["isi"]->departemen."' AND predikattipe='".$data["isi"]->predikattipe."' ORDER BY dari";
					$data['predikat']=$this->dbx->data($sqlpredikat);
			}
			// GROUP BY idsiswa
			if ($data['isi']->absensi==1){
				$sqlhadir=" SELECT idsiswa,SUM(sakit) as sakit,SUM(izin) as izin,SUM(alpha) as alpha,SUM(tugas) as tugas
													FROM
														(SELECT DISTINCT pdn.idsiswa,pdn.idpembelajaranjadwal,pdn.sakit,pdn.izin,pdn.alpha,pdn.tugas
															FROM ns_pembelajaranjadwal pj
															INNER JOIN ns_matpel mp ON mp.replid=pj.idmatpel
															INNER JOIN ns_pembelajaranjadwalrapottipe pjrt ON pj.replid=pjrt.idpembelajaranjadwal
															INNER JOIN ns_pengembangandirinilai pdn ON pdn.idpembelajaranjadwal=pj.replid
															WHERE pj.idtahunajaran='".$data["isi"]->idtahunajaran."'
																					AND pj.idperiode='".$data["isi"]->idperiode."'
																					AND pdn.terdaftar=1
																					AND pj.idkelas='".$data["isi"]->idkelas."'
																					AND pjrt.idrapottipe='".$data["isi"]->idrapottipe."'
																					AND pdn.idsiswa='".$data["isi"]->replidsiswa."'
																					AND mp.absensi=1
														) jmlall";
				//echo $sqlhadir;die;
				$data['hadirdata']=$this->dbx->rows($sqlhadir);
			}
      	return $data;
    }

    public function hitnilai_db($idkelas,$idsiswa,$idmatpel,$idtahunajaran,$iddepartemen,$idregion,$idrapottipe,$nilaimurni,$periode,$idmatpelkelompok) {
		    	if ($nilaimurni<>1){
			    		//$sql="SELECT COUNT(pj.replid) as jml,SUM(pdn.nilai) as nilaitot,rmpd.nilai as rmpdnilai,rmv.nilai as rmvnilai ,rm.persentase
							$sql="SELECT AVG(pdn.nilai) as nilaitot,rmpd.nilai as rmpdnilai,rmv.nilai as rmvnilai ,rm.persentase
										FROM ns_pembelajaranjadwal pj
										INNER JOIN ns_pembelajaranjadwalrapottipe pjrt ON pj.replid=pjrt.idpembelajaranjadwal
										INNER JOIN temp_pdn_".$idsiswa." pdn ON pdn.idpembelajaranjadwal=pj.replid
										INNER JOIN ns_pengembangandirivariabel pdv ON pdv.replid=pdn.idpengembangandirivariabel
										LEFT JOIN ns_rapotmapping rm ON rm.idrapottipe=pjrt.idrapottipe AND rm.nonreguler=pj.nonreguler
																										AND rm.idmatpelkelompok='".$idmatpelkelompok."' AND rm.idregion=pdn.idregion
										LEFT JOIN ns_rapotmappingvariabel rmv ON rm.replid=rmv.idrapotmapping AND pdv.idprosessubvariabel=rmv.idprosessubvariabel AND rmv.nilai<>0
										LEFT JOIN ns_rapotmappingpengembangandiri rmpd ON rm.replid=rmpd.idrapotmapping
																																	AND rmpd.idpengembangandirivariabel=pdn.idpengembangandirivariabel  AND rmpd.nilai<>0
										WHERE
												pj.idtahunajaran='".$idtahunajaran."'
												AND pj.idmatpel='".$idmatpel."'
												AND pj.idperiode='".$periode."'
												AND pj.idkelas='".$idkelas."'
												AND pjrt.idrapottipe='".$idrapottipe."'
												AND pdn.idsiswa='".$idsiswa."'
												AND pdn.terdaftar=1
												AND pdn.idregion='".$idregion."'
										GROUP BY pdv.replid,pj.idprosestipe ";
										//echo $sql."<br/>";
		    	}else{
						// NILAI MURNI
							    $sql="SELECT pdv.replid,pdn.nilai as nilaitot,0 as rmpdnilai,0 as rmvnilai,pdv.pengembangandirivariabel,psv.prosessubvariabel,0 as persentase
														FROM ns_pembelajaranjadwal pj
														INNER JOIN ns_pembelajaranjadwalrapottipe pjrt ON pj.replid=pjrt.idpembelajaranjadwal
														INNER JOIN ns_prosestipe pt ON pt.replid=pj.idprosestipe
														INNER JOIN ns_pengembangandirinilai pdn ON  pdn.idpembelajaranjadwal=pj.replid
														INNER JOIN ns_pengembangandirivariabel pdv ON pdn.idpengembangandirivariabel=pdv.replid
														INNER JOIN ns_prosessubvariabel psv ON psv.replid=pdv.idprosessubvariabel
														INNER JOIN ns_prosesvariabel pv ON pv.replid=psv.idprosesvariabel
															WHERE
																	pdn.idsiswa='".$idsiswa."'
																	AND pj.idtahunajaran='".$idtahunajaran."'
																	AND pj.idmatpel='".$idmatpel."'
																	AND pj.idperiode='".$periode."'
																	AND pjrt.idrapottipe='".$idrapottipe."'
																	AND pdn.terdaftar=1
																	AND pdn.idregion='".$idregion."'
																	AND pj.idkelas='".$idkelas."'
															ORDER BY pt.no_urut,pdv.no_urut,pj.tanggalkegiatan ";
		    	}
				//echo $sql."<br/><br/><br/><br/>";die;

				$rowpdv=$this->dbx->data($sql);
				if ($nilaimurni<>1){
					$nilai=0;
					foreach((array)$rowpdv as $row) {
						//$nilai=$nilai+(((($row->nilaitot/$row->jml)/100)*$row->rmpdnilai)/100)*$row->rmvnilai;
						$nilai=$nilai+((($row->nilaitot/100)*$row->rmpdnilai)/100)*$row->rmvnilai;
						if ($idmatpel==34){
							//echo $nilai.'<br/>';
						}
					}
						return $nilai;
				}else{
					return $rowpdv;
				}

    }

    public function lpdnilai_db($idkelas,$idsiswa,$idtahunajaran,$idregion,$idrapottipe,$nilaimurni,$periode) {
    	$sql="
	    		SELECT
					pj.replid as pjreplid,pj.idprosestipe,pj.keterangan,pt.prosestipe,pdv.replid,pdv.pengembangandirivariabel
					,pdn.nilai,pj.tanggalkegiatan,mp.matpel,mpk.matpelkelompok
				FROM ns_pembelajaranjadwal pj
				INNER JOIN ns_matpel mp ON mp.replid=pj.idmatpel
				INNER JOIN ns_matpelkelompok mpk ON mpk.replid=mp.idmatpelkelompokraport
				INNER JOIN ns_pembelajaranjadwalrapottipe pjrt ON pj.replid=pjrt.idpembelajaranjadwal
				INNER JOIN ns_prosestipe pt ON pt.replid=pj.idprosestipe
				INNER JOIN ns_prosesvariabel pv ON pv.idprosestipe=pt.replid
				INNER JOIN ns_prosessubvariabel psv ON psv.idprosesvariabel=pv.replid
				INNER JOIN ns_pengembangandirivariabel pdv ON pdv.idprosessubvariabel=psv.replid
				INNER JOIN ns_pengembangandirinilai pdn ON pdn.idpengembangandirivariabel=pdv.replid AND pdn.idpembelajaranjadwal=pj.replid
				WHERE pj.idtahunajaran='".$idtahunajaran."'
						AND pdn.idsiswa='".$idsiswa."'
						AND pdn.idregion='".$idregion."'
						AND pjrt.idrapottipe='".$idrapottipe."'
						AND pdn.terdaftar=1
						AND pj.idperiode='".$periode."'
						AND pj.idkelas='".$idkelas."'
				ORDER BY mpk.matpelkelompok,mp.no_urut,pt.prosestipe,pj.tanggalkegiatan,pdv.no_urut";
		//		".$gb;
		//echo $sql;die;
		$rowpdv=$this->dbx->data($sql);
		return $rowpdv;
    }

    public function grafiknilai_db($idkelas,$idsiswa,$idtahunajaran,$idregion,$idrapottipe,$nilaimurni,$periode) {
			$predikatgraphx="";
			$predikatgraph=$this->dbx->data("SELECT DISTINCT(idpengembangandiri) FROM ns_predikatgraph");
			foreach ($predikatgraph as $key => $row) {
				if ($predikatgraphx<>""){
					$predikatgraphx=$predikatgraphx.',';
				}
				$predikatgraphx=$predikatgraphx.$row->idpengembangandiri;
			}
			$sql="
	    		SELECT
					pdv.replid,pdv.pengembangandirivariabel,AVG(pdn.nilai) as nilai,pj.tanggalkegiatan
				FROM ns_pembelajaranjadwal pj
				INNER JOIN ns_pembelajaranjadwalrapottipe pjrt ON pj.replid=pjrt.idpembelajaranjadwal
				INNER JOIN ns_prosesvariabel pv ON pv.idprosestipe=pj.idprosestipe
				INNER JOIN ns_prosessubvariabel psv ON psv.idprosesvariabel=pv.replid
				INNER JOIN ns_pengembangandirivariabel pdv ON pdv.idprosessubvariabel=psv.replid
				INNER JOIN ns_pengembangandirinilai pdn ON pdn.idpengembangandirivariabel=pdv.replid AND pdn.idpembelajaranjadwal=pj.replid
				WHERE pj.idtahunajaran='".$idtahunajaran."'
						AND pdn.idsiswa='".$idsiswa."'
						AND pjrt.idrapottipe='".$idrapottipe."'
						AND pdn.idregion='".$idregion."'
						AND pjrt.idrapottipe='".$idrapottipe."'
						AND pdn.terdaftar=1
						AND pj.idperiode='".$periode."'
						AND pj.idkelas='".$idkelas."'
						AND pdv.replid IN (".$predikatgraphx.")
						AND pdn.nilai<>0
				GROUP BY pj.tanggalkegiatan,pdv.replid
				ORDER BY pdv.pengembangandirivariabel,pj.tanggalkegiatan";
		//		".$gb;
		//echo $sql;die;
		$rowpdv=$this->dbx->data($sql);
		return $rowpdv;
    }

    // RAPOT DETAIL PER MATA PELAJARAN
	//-------------------------------------------------------------------------------------------
	public function view_detailmatpel_db($id,$idmatpel,$data) {
      	$sql="SELECT pv.*,ta.tahunajaran,k.kelas,r.region,s.nama as namasiswa,rt.rapottipe,ta.departemen
      			,s.nama as siswa, s.nis, s.nisn,p.periode,rt.nilaimurni,rt.absensi,rt.grafik,rt.gruppengembangandiri,rt.lpd
      			,ks.kelompok as kelompoksiswa
      			,s.replid as replidsiswa,rt.tipe
      			FROM ns_rapot pv
      			LEFT JOIN tahunajaran ta ON ta.replid=pv.idtahunajaran
      			LEFT JOIN kelas k ON k.replid=pv.idkelas
      			LEFT JOIN kelompoksiswa ks ON ks.replid=k.kelompok_siswa
      			LEFT JOIN regional r ON r.replid=pv.idregion
      			LEFT JOIN siswa s ON s.replid=pv.idsiswa
      			LEFT JOIN ns_rapottipe rt ON rt.replid=pv.idrapottipe
      			LEFT JOIN ns_periode p ON p.replid=pv.idperiode
      			LEFT JOIN departemen d ON ta.departemen=d.departemen
      			WHERE pv.replid='".$id."' ";
      	$data['isi'] = $this->dbx->rows($sql);

      	if ($data['isi']->tipe<>'Grafik'){
      		// AND pj.idregion='".$data["isi"]->idregion."'
      		$sqlkel="SELECT pj.replid,pj.tanggalkegiatan,pt.prosestipe,mp.matpel,pdv.pengembangandirivariabel,pdn.nilai
      							,CONCAT(p.nama,' [',p.nip,']') as walikelas
      							,pj.idregion, r.region as regiontext ,k.kelas as kelastext
										,pdv.persentasemurni
										,pj.idmodultipe
										,psv.prosessubvariabel,psv.persentasemurnisv
						FROM ns_pembelajaranjadwal pj
						INNER JOIN ns_matpel mp ON mp.replid=pj.idmatpel
						INNER JOIN ns_pembelajaranjadwalrapottipe pjrt ON pjrt.idpembelajaranjadwal=pj.replid
						INNER JOIN ns_pengembangandirinilai pdn ON pdn.idpembelajaranjadwal=pj.replid
						INNER JOIN ns_pengembangandirivariabel pdv ON pdv.replid=pdn.idpengembangandirivariabel
						INNER JOIN ns_prosessubvariabel psv ON pdv.idprosessubvariabel=psv.replid
						INNER JOIN ns_prosestipe pt ON pt.replid=pj.idprosestipe
						LEFT JOIN regional r ON r.replid=pdn.idregion
						LEFT JOIN pegawai p ON p.replid=pj.created_by
						LEFT JOIN kelas k ON k.replid=pj.idkelas
						WHERE
								pj.idperiode='".$data["isi"]->idperiode."' AND pj.idtahunajaran='".$data["isi"]->idtahunajaran."'
								AND pjrt.idrapottipe='".$data["isi"]->idrapottipe."'
								AND pdn.idsiswa='".$data["isi"]->replidsiswa."' AND pdn.terdaftar=1
								AND mp.replid='".$idmatpel."'
								AND pj.idkelas='".$data['isi']->idkelas."'
						ORDER BY pj.tanggalkegiatan,pj.replid,pdv.no_urut,pj.replid ASC ";
			//echo $sqlkel;die;
			$data['kelompok']=$this->dbx->data($sqlkel);
		}
      	return $data;
    }

    // HAPUS ALL
    //-------------------------------------------------------------------------------------------
    public function hapus_rapot($id) {
        // Query to check whether username already exist or not
        $this->db->where('replid',$id);
        $this->db->delete('ns_rapot');
        if ($this->db->_error_number() == 0) {
	        return true;
        } else {
            return false;
        }
    }
}

?>
