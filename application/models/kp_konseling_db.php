<?php

Class kp_konseling_db extends CI_Model {
	public function __construct() {
		parent::__construct();
		$this->load->library('dbx');
	}

    // Read data from database to show data in admin page
    public function data($var) {
		$cari="";$cari2="";$order="";$cari3="";

		if ($this->input->post('nama')<>""){
			$cari2=$cari2." AND s.nama like '%".$this->input->post('nama')."%' ";
			$order=" ORDER BY r.tanggallaporan DESC ";
		}

                if (($this->input->post('periode1')<>"") AND ($this->input->post('periode2')=="")){
                        $cari3=" AND r.tanggallaporan >= '".$this->p_c->tgl_db($this->input->post('periode1'))."' ";
                        $order=" ORDER BY r.tanggallaporan ASC ";
                }

                if (($this->input->post('periode1')=="") AND ($this->input->post('periode2')<>"")){
                        $cari3=" AND r.tanggallaporan <= '".$this->p_c->tgl_db($this->input->post('periode2'))."' ";
                        $order=" ORDER BY r.tanggallaporan ASC ";
                }

                if (($this->input->post('periode1')<>"") AND ($this->input->post('periode2')<>"")){
                        $cari3=" AND r.tanggallaporan BETWEEN '".$this->p_c->tgl_db($this->input->post('periode1'))."' AND '".$this->p_c->tgl_db($this->input->post('periode2'))."' ";
                        $order=" ORDER BY r.tanggallaporan ASC ";
                }

                if (($this->input->post('periode1')=="") AND ($this->input->post('periode2')=="")){
                        //$cari=$cari." AND keg.aktif=1 ";
                        $order=" ORDER BY r.tanggallaporan ASC ";
                }

                $cari=$cari." AND ta.idcompany='".$this->input->post('idcompany')."' ";
		$cari=$cari." AND ta.departemen='".$this->input->post('iddepartemen')."' ";
		
                if ($this->input->post('idtahunajaran')<>""){
                        $cari=$cari." AND k.idtahunajaran='".$this->input->post('idtahunajaran')."' ";
                }

                if ($this->input->post('idkelas')<>""){
                        $cari=$cari." AND r.idkelas='".$this->input->post('idkelas')."' ";
                }
                
                
                
                $sql = "SELECT r.*,s.nis,s.nama as namasiswatext,s.abk,s.aktif as aktifsiswa
                                ,ta.tahunajaran as tahunajarantext,ta.departemen as departementext,c.nama as companytext
                                ,k.kelas as kelastext, CONCAT(p.nip,' ',p.nama ) as namawalitext
                                , CONCAT(p2.nip,' ',p2.nama ) as createdbytext
                                ,jl.nama as jenislaporantext,t.nama as tempattext,rp.prioritas as prioritastext
                                ,st.status as statustext
                                ,(SELECT 1 FROM kp_konselingreport WHERE idkonseling=r.replid AND fase=1 LIMIT 1) as onproses
                        FROM kp_konseling r
                        LEFT JOIN siswa s ON s.replid=r.idsiswa
                        LEFT JOIN kelas k ON k.replid=r.idkelas
                        LEFT JOIN pegawai p ON p.replid=k.idwali 
                        LEFT JOIN tahunajaran ta ON ta.replid=k.idtahunajaran
                        LEFT JOIN hrm_company c ON c.replid=ta.idcompany
                        LEFT JOIN pegawai p2 ON p2.replid=r.created_by  
                        LEFT JOIN reff_konseling jl ON jl.replid=r.idjenislaporan  
                        LEFT JOIN reff_konseling t ON t.replid=r.idtempat
                        LEFT JOIN reff_prioritas rp ON rp.replid=r.idprioritas  
                        LEFT JOIN hrm_status st ON st.node=r.status 
                        WHERE r.replid IS NOT NULL ".$cari." ".$cari2." ".$cari3." ".$order;
                //echo $sql;die;
                $data['show_table']=$this->dbx->data($sql);

		$data['iddepartemen_opt'] = $this->dbx->opt("SELECT departemen as replid,departemen as nama FROM departemen WHERE aktif=1 AND replid IN (".$this->session->userdata('dept').") ORDER BY urutan",'up');
		$data['idtahunajaran_opt'] = $this->dbx->opt("SELECT replid,CONCAT('[',departemen,'] ',tahunajaran) as nama FROM tahunajaran WHERE idcompany='".$this->input->post('idcompany')."' AND departemen='".$this->input->post('iddepartemen')."' ORDER BY aktif DESC ,nama DESC ",'up');

		$data['idtingkat_opt'] = $this->dbx->opt("SELECT replid,tingkat as nama FROM tingkat
																							WHERE aktif=1 AND departemen='".$this->input->post('iddepartemen')."' ORDER BY CAST(tingkat AS SIGNED) ASC",'up');

		$data['idkelas_opt'] = $this->dbx->opt("SELECT k.replid,k.kelas as nama FROM kelas k
																								INNER JOIN tingkat t ON k.idtingkat=t.replid
																								WHERE k.aktif=1 AND t.departemen IN (SELECT departemen FROM departemen  WHERE replid IN (".$this->session->userdata('dept')."))
																									AND k.idtahunajaran='".$this->input->post('idtahunajaran')."'
																									AND k.idtingkat='".$this->input->post('idtingkat')."'
																								ORDER BY nama",'up');
		$companyrow=$this->session->userdata('idcompany');
		$sqlcompany="SELECT replid,nama as nama
								FROM hrm_company
								WHERE replid IN (".$companyrow.") AND aktif=1
								ORDER BY nama";
		$data['idcompany_opt'] = $this->dbx->opt($sqlcompany,'up');
		return $data;
    }

    //TAMBAH
    public function tambah_db($data,$id='') {
        $sql="SELECT r.*,ta.departemen as iddepartemen,ta.idcompany,k.idtahunajaran
                FROM kp_konseling r
                LEFT JOIN kelas k ON k.replid=r.idkelas
                LEFT JOIN tahunajaran ta ON ta.replid=k.idtahunajaran
                 WHERE r.replid='".$id."'";
       $data['isi'] = $this->dbx->rows($sql);

       if ($data['isi']== NULL ) {
            unset($data['isi']);
            $sql="SELECT ".$this->dbx->tablecolumn('kp_konseling').",current_date() as tanggallaporan, current_date() as tanggalkonseling,0 as idtahunajaran,0 as iddepartemen,0 as idcompany ";
            $data['isi']=$this->dbx->rows($sql);
       }

       $companyrow=$this->session->userdata('idcompany');
       $sqlcompany="SELECT replid,nama as nama
                               FROM hrm_company
                               WHERE replid IN (".$companyrow.") AND aktif=1
                               ORDER BY nama";
       $data['idcompany_opt'] = $this->dbx->opt($sqlcompany,'up');

       $data['iddepartemen_opt'] = $this->dbx->opt("SELECT departemen as replid,departemen as nama FROM departemen WHERE aktif=1 AND replid IN (".$this->session->userdata('dept').") ORDER BY urutan",'up');
       /*
       $sqlta="SELECT replid,CONCAT('[',departemen,'] ',tahunajaran) as nama 
               FROM tahunajaran WHERE idcompany='".$data['isi']->idcompany."' AND (aktif=1 OR replid='".$data['isi']->idtahunajaran."') AND departemen='".$data['isi']->iddepartemen."' ORDER BY aktif DESC ,nama DESC ";		
       $data['idtahunajaran_opt'] = $this->dbx->opt($sqlta,'up');
       $data['idkelas_opt'] = $this->dbx->opt("SELECT replid,kelas as nama FROM kelas
                                                       WHERE ((aktif=1 AND idtahunajaran='".$data['isi']->idtahunajaran."' AND replid IN (".$this->session->userdata('kelas')."))
                                                               OR replid='".$data['isi']->idkelas."')
                                                       ORDER BY idtingkat",'up');

        */
        $sqlsiswa="SELECT s.replid,CONCAT(s.nama,' [ ',nis,' ]') as nama FROM siswa s
                        INNER JOIN kelas k ON k.replid=s.idkelas
                        INNER JOIN tahunajaran ta ON ta.replid=k.idtahunajaran
                        WHERE ta.idcompany='".$data["isi"]->idcompany."' AND ta.departemen='".$data["isi"]->iddepartemen."' 
                                AND (s.replid='".$data["isi"]->idsiswa."' OR s.aktif=1)    
                        ORDER BY s.nama";
        //echo $sqlsiswa;
        $data['idsiswa_opt'] = $this->dbx->opt($sqlsiswa,'up');
        

        $data['idprioritas_opt'] = $this->dbx->opt("SELECT replid, prioritas as nama FROM reff_prioritas WHERE aktif=1 ORDER BY no_urut",'none');
        $data['idjenislaporan_opt'] = $this->dbx->opt("SELECT replid, nama FROM reff_konseling WHERE aktif=1 AND type='jenislaporan' ORDER BY nama",'none');
        $data['idtempat_opt'] = $this->dbx->opt("SELECT replid, nama FROM reff_konseling WHERE aktif=1 AND type='tempat' ORDER BY nama",'none');
        $data['idtempat_opt'] = $this->dbx->opt("SELECT replid, nama FROM reff_konseling WHERE aktif=1 AND type='tempat' ORDER BY nama",'none');
        $data['idjenispelapor_opt'] = $this->dbx->opt("SELECT replid, nama FROM reff_konseling WHERE aktif=1 AND type='jenispelapor' ORDER BY nama",'none');
        $data['idpelapor_opt'] = $this->dbx->opt("SELECT p.replid,CONCAT(p.nama,' (',p.nip,')') as nama FROM pegawai p WHERE aktif=1 ORDER BY p.nama",'up');
        return $data;
     }

     public function view_db($data,$id,$idx="") {
        $sql = "SELECT r.*,s.nis,s.nama as namasiswatext,s.abk,s.aktif as aktifsiswa
                        ,ta.tahunajaran as tahunajarantext,ta.departemen as departementext,c.nama as companytext
                        ,k.kelas as kelastext, CONCAT(p.nip,' ',p.nama ) as namawalitext
                        , CONCAT(p2.nip,' ',p2.nama ) as createdbytext
                        ,jl.nama as jenislaporantext,t.nama as tempattext,rp.prioritas as prioritastext,jp.nama as jenispelaportext
                        ,st.status as statustext
                        ,(SELECT 1 FROM kp_konselingreport WHERE idkonseling=r.replid AND fase=1 LIMIT 1) as onproses
                FROM kp_konseling r
                LEFT JOIN siswa s ON s.replid=r.idsiswa
                LEFT JOIN kelas k ON k.replid=r.idkelas
                LEFT JOIN pegawai p ON p.replid=k.idwali 
                LEFT JOIN tahunajaran ta ON ta.replid=k.idtahunajaran
                LEFT JOIN hrm_company c ON c.replid=ta.idcompany
                LEFT JOIN pegawai p2 ON p2.replid=r.created_by  
                LEFT JOIN reff_konseling jl ON jl.replid=r.idjenislaporan  
                LEFT JOIN reff_konseling t ON t.replid=r.idtempat
                LEFT JOIN reff_konseling jp ON jp.replid=r.idjenispelapor
                LEFT JOIN reff_prioritas rp ON rp.replid=r.idprioritas 
                LEFT JOIN hrm_status st ON st.node=r.status 
                WHERE r.replid='".$id."'";
                //echo $sql;die;
        $data['isi']=$this->dbx->rows($sql);

        $filterisidata="";
        if($idx<>""){
                $filterisidata=" AND kr.replid='".$idx."'";
        }
        $sql="SELECT kr.*,rk.nama as kategorievaluasitext,DATEDIFF(kr.tanggalakhirtindakan,CURRENT_DATE()) as sisahari,rk2.nama as masalahtext,rk3.nama as intensitastext
                FROM kp_konselingreport kr
                LEFT JOIN reff_konseling rk ON rk.replid=kr.idkategorievaluasi
                LEFT JOIN reff_konseling rk2 ON rk2.replid=kr.idmasalah 
                LEFT JOIN reff_konseling rk3 ON rk3.replid=kr.idintensitas 
                WHERE kr.idkonseling='".$id."' ".$filterisidata." ORDER BY kr.tanggalkonseling DESC,kr.created_date DESC";
        if($idx<>""){
                $data['isidata']=$this->dbx->rows($sql);
        }else{
                $data['isidata']=$this->dbx->data($sql);
        }
        

        $sql="SELECT * FROM kp_konselingreport WHERE replid='".$idx."' ORDER BY created_date LIMIT 1";
        $data['isi2']=$this->dbx->rows($sql);

        $data['idkategorievaluasi_opt'] = $this->dbx->opt("SELECT replid, nama FROM reff_konseling WHERE aktif=1 AND type='kategorievaluasi' ORDER BY nama",'none');
        $data['idmasalah_opt'] = $this->dbx->opt("SELECT replid, nama FROM reff_konseling WHERE aktif=1 AND type='masalah' ORDER BY nama",'none');
        $data['idintensitas_opt'] = $this->dbx->opt("SELECT replid, nama FROM reff_konseling WHERE aktif=1 AND type='intensitas' ORDER BY nama",'none');

        if ($data['isi2']== NULL ) {
                unset($data['isi2']);
                $sql="SELECT ".$this->dbx->tablecolumn('kp_konselingreport').",current_date() as tanggalkonseling ";
                $data['isi2']=$this->dbx->rows($sql);
        }
	return $data;
	
     }
}

?>
