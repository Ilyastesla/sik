<?php

Class ns_p5_projek_db extends CI_Model {
	public function __construct() {
		parent::__construct();
		$this->load->library('dbx');
	}

    // Read data from database to show data in admin page
    public function data() {
			$cari="";
			//if ($this->input->post('iddepartemen')<>""){
				$cari=$cari." AND t.departemen='".$this->input->post('iddepartemen')."' ";
        $cari=$cari." AND com.replid='".$this->input->post('idcompany')."' ";
			//}

			$sql="SELECT DISTINCT pv.*,pt.tematext,ptp.refftext as projektipetext, com.nama as companytext
      			FROM ns_p5_projek pv
      			INNER JOIN hrm_company com ON com.replid=pv.idcompany 
            LEFT JOIN ns_p5_tema pt ON pt.replid=pv.idtema
            LEFT JOIN ns_p5_reff ptp ON ptp.replid=pv.idprojektipe 
            LEFT JOIN tingkat t ON t.fase=pv.fase
				WHERE pv.replid>0 ".$cari."";
        //echo $sql;
      	$data['show_table']=$this->dbx->data($sql);

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
      	$sql="SELECT *
      			FROM ns_p5_projek
      			WHERE replid='".$id."'";
        $data['isi'] = $this->dbx->rows($sql);

        if ($data['isi']== NULL ) {
        	unset($data['isi']);
			    $sql="SELECT ".$this->dbx->tablecolumn('ns_p5_projek').",1 as aktif ";
        	$data['isi']=$this->dbx->rows($sql);
        }
        $data['idtema_opt'] = $this->dbx->opt("SELECT replid,tematext as nama FROM ns_p5_tema ORDER BY nourut",'up');
        $data['idfase_opt'] = $this->dbx->opt("SELECT DISTINCT fase as replid,fase as nama FROM tingkat WHERE fase<>'' ORDER BY fase",'up');
        $data['idprojektipe_opt'] = $this->dbx->opt("SELECT replid,refftext as nama FROM ns_p5_reff WHERE tipe='projektipe' ORDER BY nourut",'up');
        $companyrow=$this->session->userdata('idcompany');
        $sqlcompany="SELECT replid,nama as nama
                    FROM hrm_company
                    WHERE replid IN (".$companyrow.") AND aktif=1
                    ORDER BY nama";
        $data['idcompany_opt'] = $this->dbx->opt($sqlcompany,'up');
        
        return $data;
  }

  public function view_db($id,$data) {
    $sql="SELECT pv.*,pt.tematext,ptp.refftext as projektipetext
          FROM ns_p5_projek pv
          LEFT JOIN ns_p5_tema pt ON pt.replid=pv.idtema
          LEFT JOIN ns_p5_reff ptp ON ptp.replid=pv.idprojektipe 
        WHERE pv.replid='".$id."'";
    $data['isi']=$this->dbx->rows($sql);
    
    $capaiansql="SELECT *,esc.aktif as aktifesc
                  , (SELECT 1 FROM ns_p5_projek_capaian WHERE idprojek='".$id."' AND idcapaian=esc.replid) as pakai 
                FROM ns_p5_dimensi d 
                INNER JOIN ns_p5_elemen e ON e.iddimensi=d.replid
                INNER JOIN ns_p5_elemen_sub es ON es.idelemen=e.replid
                INNER JOIN ns_p5_elemen_sub_capaian esc ON esc.idelemen_sub=es.replid   
                WHERE esc.fase='".$data['isi']->fase."'
                ORDER BY d.nourut,e.nourut,es.nourut,esc.nourut DESC";
    $data['capaian']=$this->dbx->data($capaiansql);
    return $data;
}
}

?>
