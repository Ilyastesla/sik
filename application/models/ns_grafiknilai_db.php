<?php

Class ns_grafiknilai_db extends CI_Model {
	public function __construct() {
		parent::__construct();
		$this->load->library('dbx');
	}

    // Read data from database to show data in admin page
    public function index_table() {
    	$cari="";$gb="";
			if ($this->input->post('filter')<>1){
    		//$cari=$cari." AND pv.idtahunajaran IN (SELECT distinct ta.replid FROM tahunajaran ta, departemen d WHERE ta.departemen=d.departemen AND ta.aktif=1 AND d.replid IN (".$this->session->userdata('dept').")) AND pv.created_by='".$this->session->userdata('idpegawai')."' ";
    	}else{
				if ($this->input->post('idtahunajaran')<>""){
					$cari=$cari." AND pv.idtahunajaran IN (".$this->input->post('idtahunajaran').") ";
        }
				if ($this->input->post('idkelas')<>""){
					$cari=$cari." AND pv.idkelas='".$this->input->post('idkelas')."' ";
				}

				if ($this->input->post('idperiode')<>""){
					$cari=$cari." AND pv.idperiode='".$this->input->post('idperiode')."' ";
          $gb=" ,p.replid ";
				}


				if ($this->input->post('idprosestipe')<>""){
					$cari=$cari." AND pv.idprosestipe='".$this->input->post('idprosestipe')."' ";
				}

        if ($this->input->post('idpengembangandirivariabel')<>""){
					$cari=$cari." AND pd.replid='".$this->input->post('idpengembangandirivariabel')."' ";
				}

				if ($this->input->post('idmatpel')<>""){
					$cari=$cari." AND pv.idmatpel='".$this->input->post('idmatpel')."' ";
				}

				if ($this->input->post('created_by')<>""){
					$cari=$cari." AND pv.created_by='".$this->input->post('created_by')."' ";
				}
			}

        //,CONCAT('[',ps.iddepartemen,'] ',ps.prosestipe) as prosestipe
        //INNER JOIN ns_prosestipe ps ON ps.replid=pv.idprosestipe
      	$sql="SELECT pv.idtahunajaran,pv.idmatpel,mp.matpel,mp.iddepartemen,ta.tahunajaran,p.periode
      				 ,ta.aktif as aktiftahunajaran
               ,pd.pengembangandirivariabel
               ,ROUND(AVG(pdn.nilai)) as nilai
						FROM ns_pembelajaranjadwal pv
            LEFT JOIN ns_pengembangandirinilai pdn ON pdn.idpembelajaranjadwal=pv.replid
            LEFT JOIN ns_pengembangandirivariabel pd ON pd.replid=pdn.idpengembangandirivariabel
      			LEFT JOIN ns_matpel mp ON mp.replid=pv.idmatpel
      			LEFT JOIN tahunajaran ta ON ta.replid=pv.idtahunajaran
      			LEFT JOIN ns_periode p ON p.replid=pv.idperiode
      			WHERE pdn.terdaftar='1' ".$cari.
      			"GROUP BY mp.replid,ta.replid,pd.replid ".$gb."
            ORDER BY mp.matpel,ta.tahunajaran ";

				//echo $sql;die;
        if ($this->input->post('filter')<>1){
          $data['show_table']=NULL;
        }else{
          $data['show_table']=$this->dbx->data($sql);
        }

        $data['iddepartemen_opt'] = $this->dbx->opt("SELECT departemen as replid,departemen as nama FROM departemen WHERE aktif=1 AND replid IN (".$this->session->userdata('dept').") ORDER BY urutan",'up');
				//Tahun Ajaran
        //---------------------------------------------------------------------------------------------
        $data['idtahunajaran_opt'] = $this->dbx->opt("SELECT replid,CONCAT('[',departemen,'] ',tahunajaran) as nama FROM tahunajaran WHERE idcompany='".$this->session->userdata('idcompany')."' AND departemen='".$this->input->post("iddepartemen")."' ORDER BY aktif DESC ,nama DESC ",'up');

        //KELAS
        //-----------------------------------------------------------------------------------------------
				//AND replid IN (".$this->session->userdata('kelas').")
				$data['idkelas_opt'] = $this->dbx->opt("SELECT k.replid,CONCAT(t.tingkat,' - ',k.kelas) as nama FROM kelas k INNER JOIN tingkat t ON k.idtingkat=t.replid
        												WHERE k.aktif=1 AND k.idtahunajaran='".$this->input->post("idtahunajaran")."'
        												ORDER BY t.tingkat,k.kelas",'up');


        //Matpel
        //-----------------------------------------------------------------------------------------------
      	$data['idmatpel_opt'] = $this->dbx->opt("SELECT replid,CONCAT('[',iddepartemen,'] ',matpel, ' (',IF(aktif=1,'A','T'),')') as nama
        										FROM ns_matpel WHERE iddepartemen='".$this->input->post("iddepartemen")."'
        										ORDER BY aktif DESC, iddepartemen ASC, matpel ASC",'up');


        $data['idperiode_opt'] = $this->dbx->opt("SELECT replid,periode as nama
        											FROM ns_periode ORDER BY nama");

        $data['idprosestipe_opt'] = $this->dbx->opt("SELECT replid,CONCAT('[',iddepartemen,'] ',prosestipe, ' (',IF(aktif=1,'A','T'),')') as nama,iddepartemen FROM ns_prosestipe WHERE iddepartemen='".$this->input->post("iddepartemen")."' ORDER BY aktif DESC,nama ASC ",'up');

        $data['idpengembangandirivariabel_opt'] = $this->dbx->opt("SELECT pdv.replid,CONCAT(pdv.pengembangandirivariabel, ' (',IF(pdv.aktif=1,'A','T'),')') as nama
											FROM ns_pengembangandirivariabel pdv
                      INNER JOIN ns_prosessubvariabel psv ON psv.replid=pdv.idprosessubvariabel
                      INNER JOIN ns_prosesvariabel pv ON pv.replid=psv.idprosesvariabel
                      WHERE pv.idprosestipe='".$this->input->post("idprosestipe")."' ORDER BY pdv.no_urut",'up');

				//echo var_dump($data['created_by_opt']);
        return $data;
    }
  }

  ?>
