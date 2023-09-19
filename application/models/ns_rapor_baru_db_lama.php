<?php

Class ns_rapor_baru_db extends CI_Model {
	public function __construct() {
		parent::__construct();
		$this->load->library('dbx');
	}

    // Read data from database to show data in admin page
    public function data() {
    	$cari="";

		if ($this->input->post('idtahunajaran')<1){
    		$cari=$cari." AND ta.aktif=1 AND ta.departemen IN (SELECT departemen FROM departemen WHERE replid IN (".$this->session->userdata('dept').")) AND pv.created_by='".$this->session->userdata('idpegawai')."' ";
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

				/*
	    	if ($this->input->post('idregion')<>""){
		    	$cari=$cari." AND pv.idregion='".$this->input->post('idregion')."' ";
	    	}


				if ($this->input->post('created_by')<>""){
		    	$cari=$cari." AND pv.created_by='".$this->input->post('created_by')."' ";
	    	}
				*/
			}
		$cari=$cari." AND ta.idcompany='".$this->input->post('idcompany')."' ";
		//rt.k13=1 AND 
    	$sql="SELECT pv.*,ta.tahunajaran,k.kelas,r.region,s.nama as namasiswa,CONCAT(rt.rapottipe,' ',rt.keterangan) as rapottipe,ta.departemen,p.periode,ta.aktif as aktiftahunajaran ,CONCAT ('[',px.nip,'] ',px.nama) as created_bytext
					,k.idwali,rt.k13 
    			FROM ns_rapot pv
    			LEFT JOIN tahunajaran ta ON ta.replid=pv.idtahunajaran
    			LEFT JOIN kelas k ON k.replid=pv.idkelas
    			LEFT JOIN siswa s ON s.replid=pv.idsiswa
				LEFT JOIN regional r ON r.replid=s.region
    			LEFT JOIN ns_rapottipe rt ON rt.replid=pv.idrapottipe
    			LEFT JOIN ns_periode p ON p.replid=pv.idperiode
				LEFT JOIN pegawai px ON px.replid=pv.created_by
    			WHERE pv.deletethis<>1 ".$cari."
    			ORDER BY pv.tanggalkegiatan";
        //WHERE mp.replid IN (".$this->session->userdata('matpel').")
				//echo $sql;
      	$data['show_table']=$this->dbx->data($sql);

		$companyrow=$this->session->userdata('idcompany');
		$sqlcompany="SELECT replid,nama as nama
								FROM hrm_company
								WHERE replid IN (".$companyrow.") AND aktif=1
								ORDER BY nama";
		$data['idcompany_opt'] = $this->dbx->opt($sqlcompany,'up');


		$data['iddepartemen_opt'] = $this->dbx->opt("SELECT departemen as replid,departemen as nama FROM departemen WHERE aktif=1 AND replid IN (".$this->session->userdata('dept').") ORDER BY urutan",'up');
		
        //Tahun Ajaran
        //-----------------------------------------------------------------------------------------------
		$sqlta="SELECT ta.replid,CONCAT(' [',ta.departemen,'] ',ta.tahunajaran) as nama
								FROM tahunajaran ta
								INNER JOIN ns_rapot pv ON pv.idtahunajaran=ta.replid 
								WHERE idcompany='".$this->input->post('idcompany')."'
											AND departemen='".$this->input->post('iddepartemen')."'
								ORDER BY aktif DESC ,nama DESC  ";
        $data['idtahunajaran_opt'] = $this->dbx->opt($sqlta,'up');


        //KELAS
        //-----------------------------------------------------------------------------------------------
		$data['idkelas_opt'] = $this->dbx->opt("SELECT k.replid,CONCAT(t.tingkat,' - ',k.kelas) as nama 
												FROM kelas k 
												INNER JOIN tingkat t ON k.idtingkat=t.replid
												INNER JOIN ns_rapot r ON r.idkelas=k.replid 
        										WHERE k.aktif=1 AND k.idtahunajaran='".$this->input->post('idtahunajaran')."'
        										ORDER BY t.tingkat,k.kelas",'up');


        //Region
        //-----------------------------------------------------------------------------------------------
        $data['idregion_opt'] = $this->dbx->opt("SELECT replid,region as nama FROM regional ORDER BY nama",'up');


        //Tipe Rapor
        //-----------------------------------------------------------------------------------------------
		/*
		$sql_rt="SELECT replid,CONCAT('[',iddepartemen,'] ',rapottipe,' ',keterangan, ' (',IF(aktif=1,'A','T'),')') as nama
							FROM ns_rapottipe
							WHERE k13=1
							AND iddepartemen IN (SELECT departemen FROM tahunajaran WHERE replid='".$this->input->post('idtahunajaran')."')
							AND replid IN (SELECT idvariabel FROM ns_reff_company WHERE idcompany='".$this->input->post('idcompany')."' AND tipe='ns_rapottipe' )
							ORDER BY aktif DESC, nama ASC";
		*/
		$carirapottipe="";
		if ($this->input->post('idkelas')<>""){
			$carirapottipe=$carirapottipe." AND r.idkelas='".$this->input->post('idkelas')."' ";
		}
		$sql_rt="SELECT rt.replid,CONCAT('[',rt.iddepartemen,'] ',rt.rapottipe,' ',rt.keterangan, ' (',IF(rt.aktif=1,'A','T'),')') as nama
				FROM ns_rapottipe rt
				INNER JOIN ns_rapot r ON r.idrapottipe=rt.replid
				WHERE r.idtahunajaran='".$this->input->post('idtahunajaran')."' ".$carirapottipe." ORDER BY nama";
		$data['idrapottipe_opt'] = $this->dbx->opt($sql_rt,'up');

        $data['idperiode_opt'] = $this->dbx->opt("SELECT replid,periode as nama FROM ns_periode ORDER BY nama");
        $data['created_by_opt'] = $this->dbx->opt("SELECT replid,nama as nama FROM pegawai ORDER BY nama",'up');

        return $data;
    }

    //TAMBAH
    public function tambah_db($data,$id='') {
    	 $sql="SELECT r.*,ta.departemen as iddepartemen,ta.idcompany
      			FROM ns_rapot r
				LEFT JOIN tahunajaran ta ON ta.replid=r.idtahunajaran
      			WHERE r.replid='".$id."'";
        $data['isi'] = $this->dbx->rows($sql);

        if ($data['isi']== NULL ) {
					unset($data['isi']);
					$sql="SELECT ".$this->dbx->tablecolumn('ns_rapot').",1 as tampilna,current_date() as tanggalkegiatan,1 as aktif,-1 as idkelas,0 as iddepartemen,0 as idcompany ";
        	$data['isi']=$this->dbx->rows($sql);
        }else{
				$data['rapotsetting']=$this->dbx->rows("SELECT * FROM ns_rapottipe WHERE replid='".$data['isi']->idrapottipe."'");
				if($data['rapotsetting']->matpeldeskripsi){
						$sqlmatpeldesc="SELECT DISTINCT mp.*,rmpd.matpeldeskripsi FROM ns_matpel mp
															INNER JOIN ns_pembelajaranjadwal pj ON pj.idmatpel=mp.replid
															LEFT JOIN ns_rapotmatpeldeskripsi rmpd ON rmpd.idmatpel=mp.replid AND rmpd.idrapot='".$id."'
															WHERE pj.idtahunajaran='".$data['isi']->idtahunajaran."' AND pj.idkelas='".$data['isi']->idkelas."' AND pj.idperiode='".$data['isi']->idperiode."'
															ORDER BY mp.matpel
															";
						$data['datamatpeldesc']=$this->dbx->data($sqlmatpeldesc);
				}
		}

		$companyrow=$this->session->userdata('idcompany');
		$sqlcompany="SELECT replid,nama as nama
								FROM hrm_company
								WHERE replid IN (".$companyrow.") AND aktif=1
								ORDER BY nama";
		$data['idcompany_opt'] = $this->dbx->opt($sqlcompany,'up');
		$data['iddepartemen_opt'] = $this->dbx->opt("SELECT departemen as replid,departemen as nama FROM departemen WHERE aktif=1 AND replid IN (".$this->session->userdata('dept').") ORDER BY urutan",'up');
		$sqlta="SELECT replid,CONCAT('[',departemen,'] ',tahunajaran) as nama 
				FROM tahunajaran WHERE idcompany='".$data['isi']->idcompany."' AND (aktif=1 OR replid='".$data['isi']->idtahunajaran."') AND departemen='".$data['isi']->iddepartemen."' ORDER BY aktif DESC ,nama DESC ";		
		$data['idtahunajaran_opt'] = $this->dbx->opt($sqlta,'up');
		$data['idperiode_opt'] = $this->dbx->opt("SELECT replid,periode as nama FROM ns_periode ORDER BY nama");
		$data['idkelas_opt'] = $this->dbx->opt("SELECT replid,kelas as nama FROM kelas
        												WHERE ((aktif=1 AND idtahunajaran='".$data['isi']->idtahunajaran."' AND replid IN (".$this->session->userdata('kelas')."))
																OR replid='".$data['isi']->idkelas."')
        												ORDER BY idtingkat",'up');

		$data['idmodultipe_opt']=array(''=>'Semua Modul','1'=>'1','2'=>'2','3'=>'3','4'=>'4','5'=>'5','6'=>'6','7'=>'7','8'=>'8','9'=>'9','10'=>'10','11'=>'11','12'=>'12','13'=>'13','14'=>'14','15'=>'15','16'=>'16','17'=>'17','18'=>'18');
        $data['idnaikkelas_opt']=array('99'=>'Tidak Ditampilkan','1'=>'Naik Kelas','2'=>'Tidak Naik Kelas');
		$data['idnaiktingkat_opt'] = $this->dbx->opt("SELECT replid,tingkat as nama FROM tingkat  WHERE departemen='".$data['isi']->iddepartemen."' ORDER BY tingkat DESC ,nama DESC ",'up');
		
		

        

        $data['idregion_opt'] = $this->dbx->opt("SELECT replid,region as nama FROM regional
        												ORDER BY nama",'up');

        //$kelasfilquery=" AND ((idkelas='".$idkelas2."' AND region='".$idregion2."') OR (kelasstatus='".$idkelas2."' ) AND regionalstatus='".$idregion2."') ";
				$sqlsiswa="SELECT replid,CONCAT(nama,' [ ',nis,' ]') as nama FROM siswa
        												WHERE ( aktif=1 AND (idkelas='".$data["isi"]->idkelas."'OR kelasstatus='".$data["isi"]->idkelas."') )
																			OR replid='".$data["isi"]->idsiswa."'
        												ORDER BY nama";
				//echo $sqlsiswa;
        $data['idsiswa_opt'] = $this->dbx->opt($sqlsiswa,'up');
				if ((count($data['idsiswa_opt'])<=1) and ($data['isi']->idsiswa<>"")){
						$data['idsiswa_opt'] = $this->dbx->opt("SELECT replid,CONCAT(nama,' [ ',nis,' ]') as nama FROM siswa WHERE replid='".$data['isi']->idsiswa."'",'up');
				}
				$sql_rt="SELECT replid,CONCAT('[',iddepartemen,'] ',rapottipe,' ',keterangan, ' (',IF(aktif=1,'A','T'),')') as nama
									FROM ns_rapottipe
									WHERE k13=1 AND aktif=1 AND iddepartemen IN (SELECT departemen FROM tahunajaran  WHERE replid='".$data['isi']->idtahunajaran."')
												AND replid IN (SELECT idvariabel FROM ns_reff_company WHERE idcompany='".$data['isi']->idcompany."' AND tipe='ns_rapottipe' )
									ORDER BY nama ";
				//echo $sql_rt;die;
        $data['idrapottipe_opt'] = $this->dbx->opt($sql_rt,'up');

        
		$data['idtahunajaranrapot_opt'] = $this->dbx->opt("SELECT replid,CONCAT('[',departemen,'] ',tahunajaran) as nama FROM tahunajaran WHERE idcompany='".$data['isi']->idcompany."' AND departemen IN (SELECT departemen FROM tahunajaran  WHERE replid='".$data['isi']->idtahunajaran."') ORDER BY aktif DESC ,nama DESC" ,'up');
		$data['idpredikatspiritual_opt'] = $this->dbx->opt("SELECT replid,predikat as nama FROM ns_predikat WHERE predikattipe='4' AND iddepartemen IN (SELECT departemen FROM tahunajaran  WHERE replid='".$data['isi']->idtahunajaran."') ORDER BY nama");
		$data['idpredikatsosial_opt'] = $this->dbx->opt("SELECT replid,predikat as nama FROM ns_predikat WHERE predikattipe='5' AND iddepartemen IN (SELECT departemen FROM tahunajaran  WHERE replid='".$data['isi']->idtahunajaran."') ORDER BY nama");
		$data['prestasirapot']=$this->dbx->data("SELECT * FROM ns_rapotprestasi WHERE idrapot='".$id."' ORDER BY created_date");
		$data['ekstrakurikulerrapot']=$this->dbx->data("SELECT * FROM ns_rapotekstrakurikuler WHERE idrapot='".$id."' ORDER BY created_date");
		$data['predikat_eksul_opt']=array('A'=>'A','B'=>'B','C'=>'C','D'=>'D','E'=>'E');
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

    // RAPOT
	//-------------------------------------------------------------------------------------------
	public function view_db($id,$data) {
      	$sql="SELECT pv.*,YEAR(pv.tanggalkegiatan) as tahunkegiatan,ta.tahunajaran,tar.tahunajaran as tahunajaranrapot
				,k.kelas as kelastext ,k.idwali, jr.jurusan as jurusantext,rt.jurusan as jurusanon
				,r.region,s.nama as namasiswa,ta.departemen
      			,s.nama as siswa, s.nis, s.nisn,p.periode
				,rt.nilaimurni,rt.absensi,rt.grafik,rt.gruppengembangandiri,rt.lpd,rt.rapottipe
				,rt.skk as skkon,rt.avg as avgon,rt.paketkompetensi as paketkompetension,rt.kkm as kkmon,rt.predikat as predikaton,rt.kalimatrapor as kalimatraporon,rt.kopsurat
				,rt.besarfont,rt.portraitview,rt.jumlahdata,rt.namajenjang,rt.predikattipe,rt.psikologon,rt.tipe,rt.batasnilai,rt.konseloron
				,rt.sikap,rt.catatan_wk,rt.prestasi,rt.fisik,rt.kesehatan,rt.program as programon,rt.tingkatshowtype,com.formal,rt.modular,rt.satutabel,rt.matpeldeskripsi as matpeldeskripsion, rt.jenjangkode
				,rt.nonakademik as nonakademikon,rt.tabeljudul_1,rt.tabeljudul_2,rt.tabeljudul_3,rt.tabeljudul_4,rt.keterangan as keteranganrapor 
      			,ks.kelompok as kelompoksiswa
      			,s.replid as replidsiswa,s.tmplahir,s.tgllahir,s.nomorpeserta
				,ta.aktif as aktiftahunajaran
				,d.keterangan as departemenpanjang
				,ta.idkepsek,ta.idpsikolog,ta.idkonselor
				,pspi.predikat as predikatspiritualtext,pspi.deskripsi as descspiritualtext
				,psos.predikat as predikatsosialtext,psos.deskripsi as descsosialtext
				,pk.paketkompetensitext,t.replid as idtingkat, t.tingkat as tingkattext, t.idkesetaraan as kesetaraantext
				,com.nama as companytext,com.raporcompanytext,com.city as citytext,com.logo as logotext,com.cap as captext,com.alamatrapor
				, tkt.tingkat as idnaiktingkattext, t.fase as fasetext
      			FROM ns_rapot pv
      			LEFT JOIN tahunajaran ta ON ta.replid=pv.idtahunajaran
				LEFT JOIN tahunajaran tar ON tar.replid=pv.idtahunajaranrapot
				LEFT JOIN hrm_company com ON com.replid=ta.idcompany
      			LEFT JOIN kelas k ON k.replid=pv.idkelas
				LEFT JOIN tingkat t ON t.replid=k.idtingkat
				LEFT JOIN jurusan jr ON jr.replid=k.jurusan
      			LEFT JOIN kelompoksiswa ks ON ks.replid=k.kelompok_siswa
      			LEFT JOIN siswa s ON s.replid=pv.idsiswa
				LEFT JOIN regional r ON r.replid=s.region
      			LEFT JOIN ns_rapottipe rt ON rt.replid=pv.idrapottipe
      			LEFT JOIN ns_periode p ON p.replid=pv.idperiode
      			LEFT JOIN departemen d ON ta.departemen=d.departemen
				LEFT JOIN ns_predikat pspi ON pspi.replid=pv.idpredikatspiritual
				LEFT JOIN ns_predikat psos ON psos.replid=pv.idpredikatsosial
				LEFT JOIN ns_paketkompetensi pk ON pk.idtingkat=k.idtingkat AND pk.idperiode=pv.idperiode
				LEFT JOIN tingkat tkt ON tkt.replid=pv.idnaiktingkat
      			WHERE pv.deletethis<>1 AND pv.replid='".$id."'";
				//echo $sql;die;
      	$data['isi'] = $this->dbx->rows($sql);
		$data['rapotsetting']=$this->dbx->rows("SELECT * FROM ns_rapottipe WHERE replid='".$data['isi']->idrapottipe."'");
		$filtermodul="";
		if(($data['isi']->idmodultipe<>"") AND ($data['isi']->idmodultipe<>"0")){
			$filtermodul=" AND pj.idmodultipe='".$data['isi']->idmodultipe."' ";
		}

		if (($data['isi']->tipe=='P5')){
			$sqlprojek="SELECT pv.*,pt.tematext,ptp.refftext as projektipetext,pp.catatanproses 
						FROM ns_p5_projek pv
						LEFT JOIN ns_p5_tema pt ON pt.replid=pv.idtema
						LEFT JOIN ns_p5_reff ptp ON ptp.replid=pv.idprojektipe 
						INNER JOIN ns_p5_projek_penilaian pp ON pp.idprojek=pv.replid
						WHERE pp.idtahunajaran='".$data['isi']->idtahunajaran."' AND pp.idsiswa='".$data['isi']->idsiswa."' 
						ORDER BY pv.nourut 
						";
			$data['projek']=$this->dbx->data($sqlprojek);
			$capaiansql="SELECT *,esc.aktif as aktifesc,pc.idcapaian as idcapaian,ppn.idprojekpredikat, pp.idprojek, p.projektext 
				FROM ns_p5_dimensi d 
				INNER JOIN ns_p5_elemen e ON e.iddimensi = d.replid
				INNER JOIN ns_p5_elemen_sub es ON es.idelemen = e.replid
				INNER JOIN ns_p5_elemen_sub_capaian esc ON esc.idelemen_sub = es.replid
				INNER JOIN ns_p5_projek_capaian pc ON pc.idcapaian = esc.replid
				INNER JOIN ns_p5_projek p ON p.replid = pc.idprojek
				INNER JOIN ns_p5_projek_penilaian pp ON pp.idprojek = p.replid
				INNER JOIN ns_p5_projek_penilaian_nilai ppn ON pc.idcapaian = ppn.idcapaian AND ppn.idprojekpenilaian = pp.replid
				WHERE pp.idtahunajaran='".$data['isi']->idtahunajaran."' AND pp.idsiswa='".$data['isi']->idsiswa."' AND pp.idtingkat='".$data['isi']->idtingkat."' 
				ORDER BY p.nourut ASC,pp.created_date DESC, d.nourut ASC,e.nourut ASC,es.nourut ASC,esc.nourut ASC";
			//echo $capaiansql;die;
			$data['capaian']=$this->dbx->data($capaiansql);
			$data['idprojekpredikat_opt'] = $this->dbx->data("SELECT replid,refftext as nama FROM ns_p5_reff WHERE tipe='projekpredikat' ORDER BY nourut",'up');
	
		}
      	if (($data['isi']->tipe=='Grafik')){
			$sqlkel="SELECT
									pdv.pengembangandirivariabel
									,YEAR(pj.tanggalkegiatan) as tahunkegiatan,MONTH(pj.tanggalkegiatan) as bulankegiatan
									,AVG(pdn.nilai) as nilaigrafik
							FROM ns_pembelajaranjadwal pj
							INNER JOIN kelas k ON k.replid=pj.idkelas
							INNER JOIN ns_pengembangandirinilai pdn ON pdn.idpembelajaranjadwal=pj.replid
							INNER JOIN ns_pengembangandirivariabel pdv ON pdv.replid=pdn.idpengembangandirivariabel
							INNER JOIN ns_pembelajaranjadwalrapottipe pjrt ON pjrt.idpembelajaranjadwal=pj.replid
					WHERE
							pj.deletethis<>1 
							AND pjrt.idrapottipe='".$data["isi"]->idrapottipe."'
							AND pdn.idsiswa='".$data["isi"]->replidsiswa."'
							AND pdn.terdaftar=1
							AND pj.idtahunajaran='".$data["isi"]->idtahunajaran."'
							AND pj.idperiode='".$data["isi"]->idperiode."'
							AND pj.idkelas='".$data["isi"]->idkelas."'
							AND k.idtingkat='".$data['isi']->idtingkat."'
							AND pdv.grafikon=1
					GROUP BY pdv.pengembangandirivariabel,tahunkegiatan,bulankegiatan
					ORDER BY pdv.pengembangandirivariabel,tahunkegiatan,bulankegiatan
					";
					//echo $sqlkel;die;
					$data['kelompok']=$this->dbx->data($sqlkel);

		}else{ // untuk rapor grafik

						if (($data['isi']->tipe=='Reguler') OR ($data['isi']->tipe=='Evaluasi') OR ($data['isi']->tipe=='LPD') ){
							$tabmp='mp2';
							if(($data['isi']->tipe=='LPD') OR ($data['printrapot']<>'1')){
								$tabmp='mp';
							}
							// AND pdn.idregion='".$data["isi"]->idregion."'
							$sqlkel="SELECT
															mpk.groupon,
															mpk.detail,
															".$tabmp.".replid as idmatpel,
															".$tabmp.".idgroup,
															".$tabmp.".matpel,
															".$tabmp.".kkm,
															".$tabmp.".idmatpelkelompokpersentase,
															".$tabmp.".idmatpelkelompok,
															".$tabmp.".external AS matpelexternal,
															".$tabmp.".idpredikattipe,
															".$tabmp.".keterangan as matpelketerangan,
															mp2.matpel as groupmatpeltext,
															mpk.matpelkelompok,
															mpk2.matpelkelompok as grouptext,
															kk.jumlahskk
															,pj.idmodultipe
															,pdn.idpengembangandirivariabel,ROUND((AVG((pdn.nilai*pdv.persentasemurni)/100)),0) as nilai
															,pt.prosestipe
															,rmpd.matpeldeskripsi as matpeldeskripsitext
		      					FROM ns_pembelajaranjadwal pj
								  INNER JOIN kelas k ON k.replid=pj.idkelas
										INNER JOIN ns_prosestipe pt ON pt.replid=pj.idprosestipe
										INNER JOIN ns_pengembangandirinilai pdn ON pdn.idpembelajaranjadwal = pj.replid
										INNER JOIN ns_pengembangandirivariabel pdv ON pdv.replid=pdn.idpengembangandirivariabel
										INNER JOIN ns_matpel mp ON mp.replid=pj.idmatpel
										INNER JOIN ns_matpel mp2 ON mp2.replid= mp.matpelgroup
										INNER JOIN ns_matpelkelompok mpk ON mpk.replid=mp.idmatpelkelompokraport13
										LEFT JOIN ns_matpelkelompok mpk2 ON mpk2.replid=mp.idgroup
										INNER JOIN ns_pembelajaranjadwalrapottipe pjrt ON pjrt.idpembelajaranjadwal=pj.replid
										LEFT JOIN ns_kreditkompetensi kk ON kk.idmatpel=mp.replid AND kk.idtingkat='".$data["isi"]->idtingkat."' AND kk.idperiode='".$data["isi"]->idperiode."'
										LEFT JOIN ns_rapotmatpeldeskripsi rmpd ON rmpd.idmatpel=mp.replid AND rmpd.idrapot='".$id."'
										WHERE
												pj.deletethis<>1 
												AND pj.idtahunajaran='".$data["isi"]->idtahunajaran."'
																AND pj.idperiode='".$data["isi"]->idperiode."'
																AND k.idtingkat='".$data['isi']->idtingkat."'
																AND pjrt.idrapottipe='".$data["isi"]->idrapottipe."'
																AND mp.hitungnilai=1
																AND pdv.tabelhitung=1
																AND pdn.idsiswa='".$data["isi"]->replidsiswa."'
																AND pdn.terdaftar=1 
																".$filtermodul."
										GROUP BY ".$tabmp.".replid,".$tabmp.".idmatpelkelompokraport13,pdn.idpengembangandirivariabel,pj.idmodultipe
										ORDER BY mpk.no_urut,mpk2.no_urut,".$tabmp.".no_urut,pj.idmodultipe
										";
										//AND pj.idkelas='".$data["isi"]->idkelas."'

										$sqlkel2="SELECT
																		mpk.groupon,
															mpk.detail,
															".$tabmp.".replid as idmatpel,
															".$tabmp.".idgroup,
															".$tabmp.".matpel,
															".$tabmp.".kkm,
															".$tabmp.".idmatpelkelompokpersentase,
															".$tabmp.".idmatpelkelompok,
															".$tabmp.".external AS matpelexternal,
															".$tabmp.".idpredikattipe,
															".$tabmp.".keterangan as matpelketerangan,
															mp2.matpel as groupmatpeltext,
															mpk.matpelkelompok,
															mpk2.matpelkelompok as grouptext,
															kk.jumlahskk
															,pj.idmodultipe
															,pdn.idpengembangandirivariabel,ROUND((AVG((pdn.nilai*pdv.persentasemurni)/100)),0) as nilai
															,pt.prosestipe
															,rmpd.matpeldeskripsi as matpeldeskripsitext
					      					FROM ns_pembelajaranjadwal pj
											  INNER JOIN kelas k ON k.replid=pj.idkelas
													INNER JOIN ns_prosestipe pt ON pt.replid=pj.idprosestipe
													INNER JOIN ns_pengembangandirinilai pdn ON pdn.idpembelajaranjadwal = pj.replid
													INNER JOIN ns_pengembangandirivariabel pdv ON pdv.replid=pdn.idpengembangandirivariabel
													INNER JOIN ns_matpel mp ON mp.replid=pj.idmatpel
													INNER JOIN ns_matpel mp2 ON mp2.replid= mp.matpelgroup
													INNER JOIN ns_matpelkelompok mpk ON mpk.replid=mp.idmatpelkelompokraport13
													LEFT JOIN ns_matpelkelompok mpk2 ON mpk2.replid=mp.idgroup
													INNER JOIN ns_pembelajaranjadwalrapottipe pjrt ON pjrt.idpembelajaranjadwal=pj.replid
													LEFT JOIN ns_kreditkompetensi kk ON kk.idmatpel=mp.replid AND kk.idtingkat='".$data["isi"]->idtingkat."' AND kk.idperiode='".$data["isi"]->idperiode."'
													LEFT JOIN ns_rapotmatpeldeskripsi rmpd ON rmpd.idmatpel=mp.replid AND rmpd.idrapot='".$id."'
													WHERE
														pj.deletethis<>1 
														AND pj.idtahunajaran='".$data["isi"]->idtahunajaran."'
																			AND pj.idperiode='".$data["isi"]->idperiode."'
																			AND k.idtingkat='".$data['isi']->idtingkat."'
																			AND pjrt.idrapottipe='".$data["isi"]->idrapottipe."'
																			AND mp.hitungnilai=1
																			AND pdv.tabelhitung=2
																			AND pdn.idsiswa='".$data["isi"]->replidsiswa."'
																			AND pdn.terdaftar=1
																			".$filtermodul."
																			GROUP BY ".$tabmp.".replid,".$tabmp.".idmatpelkelompokraport13,pdn.idpengembangandirivariabel,pj.idmodultipe
																			ORDER BY mpk.no_urut,mpk2.no_urut,".$tabmp.".no_urut,pj.idmodultipe
													";
													//AND pj.idkelas='".$data["isi"]->idkelas."'
							//echo $sqlkel;die;
							$data['kelompok']=$this->dbx->data($sqlkel);
							$data['kelompok2']=$this->dbx->data($sqlkel2);

							$sqlnonakademik="SELECT
															pj.idmatpel,
															mpk.matpelkelompok,
															mpk2.matpelkelompok as grouptext,mpk2.sembunyinilai,
															mp.idgroup,
															mpk.groupon,
															mpk.detail,
															mp.matpel,
															mp.kkm,
															mp.idmatpelkelompokpersentase,
															mp.idmatpelkelompok,
															mp.external AS matpelexternal,
															mp.idpredikattipe,
															mp.keterangan as matpelketerangan,
															pj.idmodultipe,
															pdn.idpengembangandirivariabel,
															ROUND((AVG((pdn.nilai*pdv.persentasemurni)/100)),0) as nilai,
															pt.prosestipe,
															rmpd.matpeldeskripsi as matpeldeskripsitext,
															kk.jumlahskk
										FROM ns_pembelajaranjadwal pj
										INNER JOIN kelas k ON k.replid=pj.idkelas
										INNER JOIN ns_prosestipe pt ON pt.replid=pj.idprosestipe
										INNER JOIN ns_pengembangandirinilai pdn ON pdn.idpembelajaranjadwal = pj.replid
										INNER JOIN ns_pengembangandirivariabel pdv ON pdv.replid=pdn.idpengembangandirivariabel
										INNER JOIN ns_matpel mp ON mp.replid=pj.idmatpel
										INNER JOIN ns_matpelkelompok mpk ON mpk.replid=mp.idmatpelkelompokraport13
										LEFT JOIN ns_matpelkelompok mpk2 ON mpk2.replid=mp.idgroup
										INNER JOIN ns_pembelajaranjadwalrapottipe pjrt ON pjrt.idpembelajaranjadwal=pj.replid
										LEFT JOIN ns_kreditkompetensi kk ON kk.idmatpel=mp.replid AND kk.idtingkat='".$data["isi"]->idtingkat."' AND kk.idperiode='".$data["isi"]->idperiode."'
										LEFT JOIN ns_rapotmatpeldeskripsi rmpd ON rmpd.idmatpel=mp.replid AND rmpd.idrapot='".$id."'
										WHERE
											pj.deletethis<>1 
											AND pj.idtahunajaran='".$data["isi"]->idtahunajaran."'
																AND pj.idperiode='".$data["isi"]->idperiode."'
																AND k.idtingkat='".$data['isi']->idtingkat."'
																AND pjrt.idrapottipe='".$data["isi"]->idrapottipe."'
																AND mp.hitungnilai=1
																AND pdv.tabelhitung=3
																AND pdn.idsiswa='".$data["isi"]->replidsiswa."'
																AND pdn.terdaftar=1
																".$filtermodul."
										GROUP BY mp.replid,mp.idmatpelkelompokraport13,pdn.idpengembangandirivariabel,pj.idmodultipe
										ORDER BY mpk.no_urut,mpk2.no_urut,mp.matpel,pj.idmodultipe
										";
										//,mp.no_urut
										//AND pj.idkelas='".$data["isi"]->idkelas."'
										
								//echo $sqlnonakademik;die;
								$data['nonakademikdata']=$this->dbx->data($sqlnonakademik);

						}else{ //rapot murni
							//,((pdv.persentasemurni/100)*pdn.nilai) as nilai
							if($data['isi']->avgon=="1"){
								$querynilai=",AVG(pdn.nilai) as nilaiasli";
								$groupnilai=" GROUP BY pdn.idpengembangandirivariabel,mp.replid ";
							}else{
								$querynilai=",pdn.nilai as nilaiasli";
								$groupnilai="";
							}
							$sqlkel="SELECT mpk.matpelkelompok,pj.idtahunajaran,mpk.detail
		      							,mp.replid as idmatpel,mp.matpel,mp.kkm,mp.idmatpelkelompokpersentase
		      							,mp.idmatpelkelompok
												,mp.external as matpelexternal
												,mp.idpredikattipe
												,mp.keterangan as matpelketerangan
												,pdv.pengembangandirivariabel
												,psv.prosessubvariabel,psv.persentasemurnisv, kk.jumlahskk
												".$querynilai."
		      					FROM ns_pembelajaranjadwal pj
								  INNER JOIN kelas k ON k.replid=pj.idkelas
										INNER JOIN ns_prosestipe pt ON pt.replid=pj.idprosestipe
										INNER JOIN ns_pembelajaranjadwalrapottipe pjrt ON pjrt.idpembelajaranjadwal=pj.replid
										INNER JOIN ns_matpel mp ON mp.replid=pj.idmatpel
										INNER JOIN ns_matpelkelompok mpk ON mpk.replid=mp.idmatpelkelompokraport13
										INNER JOIN ns_pengembangandirinilai pdn ON pdn.idpembelajaranjadwal=pj.replid
										INNER JOIN ns_pengembangandirivariabel pdv ON pdv.replid=pdn.idpengembangandirivariabel
										INNER JOIN ns_prosessubvariabel psv ON psv.replid=pdv.idprosessubvariabel
										LEFT JOIN ns_kreditkompetensi kk ON kk.idmatpel=mp.replid AND kk.idtingkat='".$data["isi"]->idtingkat."' AND kk.idperiode='".$data["isi"]->idperiode."'
								WHERE
									pj.deletethis<>1 
									AND pdn.idsiswa='".$data["isi"]->replidsiswa."'
														AND pdn.terdaftar=1
														AND pj.idtahunajaran='".$data["isi"]->idtahunajaran."'
														AND pj.idperiode='".$data["isi"]->idperiode."'
														AND k.idtingkat='".$data['isi']->idtingkat."'
														AND pjrt.idrapottipe='".$data["isi"]->idrapottipe."'
														AND mp.hitungnilai=1
														".$filtermodul
														.$groupnilai
								."ORDER BY mpk.no_urut,mp.no_urut,pdv.no_urut";
								//AND pj.idkelas='".$data["isi"]->idkelas."'
								//echo $sqlkel; die;
								$data['kelompok']=$this->dbx->data($sqlkel);
					}


					//echo $sqlkel;die;


					//$sqlpredikat = "SELECT predikat FROM ns_predikat WHERE iddepartemen='".$data["isi"]->departemen."' AND predikattipe='".$data["isi"]->predikattipe."' ORDER BY dari";
					//$data['predikat']=$this->dbx->data($sqlpredikat);

					$sqlarrmodul="SELECT DISTINCT(idmodultipe) FROM ns_pembelajaranjadwal pj
												INNER JOIN ns_pembelajaranjadwalrapottipe pjrt ON pj.replid=pjrt.idpembelajaranjadwal
												WHERE pj.deletethis<>1 AND  pjrt.idrapottipe='".$data["isi"]->idrapottipe."' AND pj.idperiode='".$data["isi"]->idperiode."' AND pj.idkelas='".$data["isi"]->idkelas."'
												ORDER BY idmodultipe ASC
												";
					//echo $sqlarrmodul;die;
					$data['arrmodultipe']=$this->dbx->data($sqlarrmodul);
			}
			// GROUP BY idsiswa
			if ($data['isi']->absensi==1){
				$sqlhadir=" SELECT idsiswa,SUM(sakit) as sakit,SUM(izin) as izin,SUM(alpha) as alpha,SUM(tugas) as tugas
													FROM
														(SELECT DISTINCT pdn.idsiswa,pdn.idpembelajaranjadwal,pdn.sakit,pdn.izin,pdn.alpha,pdn.tugas
															FROM ns_pembelajaranjadwal pj
															INNER JOIN kelas k ON k.replid=pj.idkelas
															INNER JOIN ns_matpel mp ON mp.replid=pj.idmatpel
															INNER JOIN ns_pembelajaranjadwalrapottipe pjrt ON pj.replid=pjrt.idpembelajaranjadwal
															INNER JOIN ns_pengembangandirinilai pdn ON pdn.idpembelajaranjadwal=pj.replid
															WHERE pj.deletethis<>1  AND pj.idtahunajaran='".$data["isi"]->idtahunajaran."'
																					AND pj.idperiode='".$data["isi"]->idperiode."'
																					AND pdn.terdaftar=1
																					AND pj.idkelas='".$data["isi"]->idkelas."'
																					AND k.idtingkat='".$data['isi']->idtingkat."'
																					AND pjrt.idrapottipe='".$data["isi"]->idrapottipe."'
																					AND pdn.idsiswa='".$data["isi"]->replidsiswa."'
																					AND mp.absensi=1
														) jmlall";
				//echo $sqlhadir;die;
				$data['hadirdata']=$this->dbx->rows($sqlhadir);
			}

			$data['prestasirapot']=$this->dbx->data("SELECT * FROM ns_rapotprestasi WHERE idrapot='".$id."' ORDER BY created_date");
			$data['ekstrakurikulerrapot']=$this->dbx->data("SELECT * FROM ns_rapotekstrakurikuler WHERE idrapot='".$id."' ORDER BY created_date");
			return $data;
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
				INNER JOIN kelas k ON k.replid=pj.idkelas
				INNER JOIN ns_pembelajaranjadwalrapottipe pjrt ON pj.replid=pjrt.idpembelajaranjadwal
				INNER JOIN ns_prosesvariabel pv ON pv.idprosestipe=pj.idprosestipe
				INNER JOIN ns_prosessubvariabel psv ON psv.idprosesvariabel=pv.replid
				INNER JOIN ns_pengembangandirivariabel pdv ON pdv.idprosessubvariabel=psv.replid
				INNER JOIN ns_pengembangandirinilai pdn ON pdn.idpengembangandirivariabel=pdv.replid AND pdn.idpembelajaranjadwal=pj.replid
				WHERE pj.deletethis<>1 
						AND pj.idtahunajaran='".$idtahunajaran."'
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
      			,s.replid as replidsiswa,rt.tipe,k.idtingkat 
      			FROM ns_rapot pv
      			LEFT JOIN tahunajaran ta ON ta.replid=pv.idtahunajaran
      			LEFT JOIN kelas k ON k.replid=pv.idkelas
      			LEFT JOIN kelompoksiswa ks ON ks.replid=k.kelompok_siswa
						LEFT JOIN siswa s ON s.replid=pv.idsiswa
      			LEFT JOIN regional r ON r.replid=s.region
      			LEFT JOIN ns_rapottipe rt ON rt.replid=pv.idrapottipe
      			LEFT JOIN ns_periode p ON p.replid=pv.idperiode
      			LEFT JOIN departemen d ON ta.departemen=d.departemen
      			WHERE pv.replid='".$id."' ";
      	$data['isi'] = $this->dbx->rows($sql);

      	//if ($data['isi']->tipe<>'Grafik'){
      		// AND pj.idregion='".$data["isi"]->idregion."'
					//LEFT JOIN regional r ON r.replid=s.region
					//, r.region as regiontext
					$idmatpel_filter="";
					if($idmatpel<>"d95d318e0bd6b9bea8da986a104fce7c"){
						$idmatpel_filter=" AND mp.replid='".$idmatpel."' ";
					}
      		$sqlkel="SELECT pj.replid,pj.tanggalkegiatan,pt.prosestipe,mp.matpel,pdv.pengembangandirivariabel,pdn.nilai,pdn.idpengembangandirivariabel
      							,CONCAT(p.nama,' [',p.nip,']') as walikelas
      							,pj.idregion ,k.kelas as kelastext
										,pdv.persentasemurni
										,pj.idmodultipe
										,psv.prosessubvariabel,psv.persentasemurnisv
										,'".$data['isi']->region."' as regiontext
										,pt.keterangan as keteranganprosestext,pdv.tabelhitung
						FROM ns_pembelajaranjadwal pj
						INNER JOIN kelas k ON k.replid=pj.idkelas
						INNER JOIN ns_matpel mp ON mp.replid=pj.idmatpel
						INNER JOIN ns_pembelajaranjadwalrapottipe pjrt ON pjrt.idpembelajaranjadwal=pj.replid
						INNER JOIN ns_pengembangandirinilai pdn ON pdn.idpembelajaranjadwal=pj.replid
						INNER JOIN ns_pengembangandirivariabel pdv ON pdv.replid=pdn.idpengembangandirivariabel
						INNER JOIN ns_prosessubvariabel psv ON pdv.idprosessubvariabel=psv.replid
						INNER JOIN ns_prosestipe pt ON pt.replid=pj.idprosestipe
						LEFT JOIN pegawai p ON p.replid=pj.created_by
						WHERE
								pj.deletethis<>1 
								AND pj.idperiode='".$data["isi"]->idperiode."'
								AND pj.idtahunajaran='".$data["isi"]->idtahunajaran."'
								AND pjrt.idrapottipe='".$data["isi"]->idrapottipe."'
								AND pdn.idsiswa='".$data["isi"]->replidsiswa."' AND pdn.terdaftar=1
								".$idmatpel_filter."
								AND k.idtingkat='".$data['isi']->idtingkat."'		
						ORDER BY pj.idmodultipe,pt.prosestipe, pj.tanggalkegiatan,mp.matpel ,pdv.no_urut";
						//AND pj.idkelas='".$data['isi']->idkelas."'
			//echo $sqlkel;die;
			$data['kelompok']=$this->dbx->data($sqlkel);
		//}
      	return $data;
  }


}

?>
