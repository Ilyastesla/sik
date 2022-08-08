<?php

Class ns_rekapnilai_db extends CI_Model {
	public function __construct() {
		parent::__construct();
		$this->load->library('dbx');
	}

    // Read data from database to show data in admin page
    public function index_table() {
    	$cari="";
			if ($this->input->post('filter')<>1){
    		//$cari=$cari." AND pv.idtahunajaran IN (SELECT distinct ta.replid FROM tahunajaran ta, departemen d WHERE ta.departemen=d.departemen AND ta.aktif=1 AND d.replid IN (".$this->session->userdata('dept').")) AND pv.created_by='".$this->session->userdata('idpegawai')."' ";
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
				/*
				if ($this->input->post('terdaftar')<>"0"){
					$cari=$cari." AND pdn.terdaftar='".intval($this->input->post('terdaftar'))."' ";
				}
				*/
			}
		
		$cari=$cari." AND ta.idcompany='".$this->input->post('idcompany')."' ";
      	//,(SELECT COUNT(DISTINCT(idsiswa)) FROM ns_pengembangandirinilai WHERE idpembelajaranjadwal=pv.replid) jmlsiswa
      	$sql="SELECT pv.*,CONCAT('[',ps.iddepartemen,'] ',ps.prosestipe) as prosestipe
                ,mp.matpel,mp.iddepartemen,ta.tahunajaran,k.kelas,p.periode
      				 ,ta.aktif as aktiftahunajaran,ps.nilaiwali
               ,CONCAT ('[',s.nis,'] ',s.nama) as namasiswa,pdn.*,pd.pengembangandirivariabel
						FROM ns_pembelajaranjadwal pv
            INNER JOIN ns_pengembangandirinilai pdn ON pdn.idpembelajaranjadwal=pv.replid
            INNER JOIN ns_pengembangandirivariabel pd ON pd.replid=pdn.idpengembangandirivariabel
            INNER JOIN siswa s ON s.replid=pdn.idsiswa
      			INNER JOIN ns_prosestipe ps ON ps.replid=pv.idprosestipe
      			INNER JOIN ns_matpel mp ON mp.replid=pv.idmatpel
      			INNER JOIN tahunajaran ta ON ta.replid=pv.idtahunajaran
      			INNER JOIN kelas k ON k.replid=pv.idkelas
      			INNER JOIN ns_periode p ON p.replid=pv.idperiode
      			WHERE ps.replid=pv.idprosestipe AND pdn.terdaftar='1' ".$cari.
      			"ORDER BY pv.tanggalkegiatan,s.nama ";

				//echo $sql;die;
        if ($this->input->post('filter')<>1){
          $data['show_table']=NULL;
        }else{
          $data['show_table']=$this->dbx->data($sql);
        }
		$companyrow=$this->session->userdata('idcompany');
		$sqlcompany="SELECT replid,nama as nama
								FROM hrm_company
								WHERE replid IN (".$companyrow.") AND aktif=1
								ORDER BY nama";
		$data['idcompany_opt'] = $this->dbx->opt($sqlcompany,'up');
		$data['iddepartemen_opt'] = $this->dbx->opt("SELECT departemen as replid,departemen as nama FROM departemen WHERE aktif=1 AND replid IN (".$this->session->userdata('dept').") ORDER BY urutan",'up');
		
				//Tahun Ajaran
        //---------------------------------------------------------------------------------------------
        $data['idtahunajaran_opt'] = $this->dbx->opt("SELECT replid,CONCAT('[',departemen,'] ',tahunajaran) as nama FROM tahunajaran WHERE idcompany='".$this->input->post('idcompany')."' AND departemen='".$this->input->post('iddepartemen')."' ORDER BY aktif DESC ,nama DESC ",'up');

      	$data['idprosestipe_opt'] = $this->dbx->opt("SELECT replid,CONCAT('[',iddepartemen,'] ',prosestipe, ' (',IF(aktif=1,'A','T'),')') as nama,iddepartemen FROM ns_prosestipe WHERE iddepartemen='".$this->input->post('iddepartemen')."' ORDER BY aktif DESC,nama ASC ",'up');


        //KELAS
        //-----------------------------------------------------------------------------------------------
				//AND replid IN (".$this->session->userdata('kelas').")
				$data['idkelas_opt'] = $this->dbx->opt("SELECT k.replid,CONCAT(t.tingkat,' - ',k.kelas) as nama 
														FROM kelas k 
														INNER JOIN tingkat t ON k.idtingkat=t.replid
        												WHERE k.aktif=1 AND k.idtahunajaran='".$this->input->post("idtahunajaran")."'
        												ORDER BY t.tingkat,k.kelas",'up');

        //Region
        //-----------------------------------------------------------------------------------------------
        //$data['idregion_opt'] = $this->dbx->opt("SELECT replid,region as nama FROM regional
        //									ORDER BY nama",'up');



        //Matpel
        //-----------------------------------------------------------------------------------------------
		$sqlmatpel="SELECT replid,CONCAT('[',iddepartemen,'] ',REPLACE(REPLACE(matpel,'</i>',''),'<i>',''), ' (',IF(aktif=1,'A','T'),')') as nama
        										FROM ns_matpel
														WHERE replid IN (SELECT DISTINCT(idmatpel) FROM ns_pembelajaranjadwal WHERE idtahunajaran='".$this->input->post('idtahunajaran')."')
        										ORDER BY aktif DESC, iddepartemen ASC, matpel ASC";
      	$data['idmatpel_opt'] = $this->dbx->opt($sqlmatpel,'up');


        $data['idperiode_opt'] = $this->dbx->opt("SELECT replid,periode as nama
        											FROM ns_periode ORDER BY nama");
        $data['created_by_opt'] = $this->dbx->opt("SELECT replid,nama as nama
        											FROM pegawai ORDER BY nama",'up');

				//echo var_dump($data['created_by_opt']);
        return $data;
    }
  }

  ?>
