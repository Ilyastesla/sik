<?php

Class inventory_beritaacara_db extends CI_Model {
public function __construct() {
	parent::__construct();
	$this->load->library('dbx');
}
    // Read data from database to show data in admin page
    public function data() {
		$cari="";
		$cari=$cari." AND kk.idcompany='".$this->input->post('idcompany')."' ";
		

		if (($this->input->post('periode1')<>"") AND ($this->input->post('periode2')=="")){
			$cari=$cari." AND kk.tanggaltransaksi >= '".$this->p_c->tgl_db($this->input->post('periode1'))."' ";
		}
		if (($this->input->post('periode1')=="") AND ($this->input->post('periode2')<>"")){
			$cari=$cari." AND kk.tanggaltransaksi <= '".$this->p_c->tgl_db($this->input->post('periode2'))."' ";
		}
		if (($this->input->post('periode1')<>"") AND ($this->input->post('periode2')<>"")){
			$cari=$cari." AND kk.tanggaltransaksi BETWEEN '".$this->p_c->tgl_db($this->input->post('periode1'))."' AND '".$this->p_c->tgl_db($this->input->post('periode2'))."' ";
		}
		
      	$sql="SELECT kk.*
				,c.nama as company,s.status as statustext
				FROM inventory_beritaacara kk
				LEFT JOIN hrm_company c ON kk.idcompany=c.replid
				LEFT JOIN hrm_status s ON s.node=kk.status
				WHERE kk.replid IS NOT NULL ".$cari."
			ORDER BY kk.tanggaltransaksi";
		$data['show_table']=$this->dbx->data($sql);
		$companyrow=$this->session->userdata('idcompany');
		$sqlcompany="SELECT replid,nama as nama
								FROM hrm_company
								WHERE replid IN (".$companyrow.") AND aktif=1
								ORDER BY nama";
		$data['idcompany_opt'] = $this->dbx->opt($sqlcompany,'up');
		$companyrow=$this->session->userdata('idcompany');
		$sqlcompany="SELECT replid,nama as nama
								FROM hrm_company
								WHERE replid IN (".$companyrow.") AND aktif=1
								ORDER BY nama";
		$data['idcompany_opt'] = $this->dbx->opt($sqlcompany,'up');
      	return $data;
    }


    //TAMBAH
    //-------------------------------------------------------------------------------------------
    public function tambah_x($id='',$data) {
    	$data['id']=$id;
      	$sql="SELECT *
      			FROM inventory_beritaacara kk
      			WHERE kk.replid='".$id."'";
        $data['isi'] = $this->dbx->rows($sql);

        if ($data['isi']== NULL ) {
        	unset($data['isi']);
					$sql="SELECT ".$this->dbx->tablecolumn('inventory_beritaacara').",1 as aktif ";
        	$data['isi']=$this->dbx->rows($sql);
        }

      	$data['company_opt'] = $this->dbx->opt("select replid,CONCAT(company_code,' ',nama) as nama from hrm_company WHERE aktif=1 ORDER BY nama",'up');
        return $data;
    }

    public function kode_transaksi($company,$tanggaltransaksi){
	    $kode_transaksi="";

	    $sql="SELECT CONCAT(company_code,'/UMM/SO/',(SELECT DATE_FORMAT('".$tanggaltransaksi."','%Y%m')),'/') as kode_transaksi
	    		FROM hrm_company WHERE replid='".$company."'";
	    $query=$this->db->query($sql);
	    $isi=$query->row();
	    if ($query->num_rows() > 0) {
	    	$kode_transaksi=$isi->kode_transaksi;
	    }


	    $sql2="SELECT LPAD(RIGHT(RIGHT(trim(kode_transaksi),11),4)+1,4,'0') as kode_transaksi2 FROM inventory_beritaacara WHERE idcompany='".$company."'
 and LEFT(RIGHT(trim(kode_transaksi),11),6)=DATE_FORMAT('".$tanggaltransaksi."','%Y%m') ORDER BY kode_transaksi2 DESC LIMIT 1";
	   $query2=$this->db->query($sql2);
	    $isi2=$query2->row();
	    if ($query2->num_rows() > 0) {
	    	$kode_transaksi=$kode_transaksi.$isi2->kode_transaksi2;
	    }elseif ($kode_transaksi<>""){
		    $kode_transaksi=$kode_transaksi."0001";
	    }
	    return $kode_transaksi;

    }


    //MATERIAL
    //-------------------------------------------------------------------------------------------
    public function ubahmaterial_x($data,$idberita_acara,$id="") {
      $sql="SELECT *
          FROM inventory_beritaacara kk
          WHERE kk.replid='".$idberita_acara."'";
      $data['dataindex'] = $this->dbx->rows($sql);

      	$sql="SELECT km.*,im.nama as materialtext,ba.idcompany,CONCAT(pb.kode_inventaris,' ',im.nama) as materialtext
      			FROM inventory_beritaacara_mat km
            INNER JOIN inventory_beritaacara ba ON ba.replid=km.idinventory_beritaacara
      			LEFT JOIN inventory_penyerahan_barang_mat pb ON pb.replid=km.idinventory_penyerahan_barang
            LEFT JOIN inventory_material im ON pb.idmaterial=im.replid
      			WHERE km.replid='".$id."'";
        $data['isi'] = $this->dbx->rows($sql);

        if ($data['isi']== NULL ) {
        	unset($data['isi']);
					$sql="SELECT ".$this->dbx->tablecolumn('inventory_beritaacara_mat').",'' as materialtext,'' as idcompany ";
        	$data['isi']=$this->dbx->rows($sql);
        }
        $data['iddepartemen_opt'] = $this->dbx->opt("select replid,departemen as nama FROM hrm_departemen WHERE aktif=1 AND idcompany='".$data['dataindex']->idcompany."' ORDER BY departemen",'up');
        $data['idpj_opt'] = $this->dbx->opt("select replid,CONCAT(nama,' [',nip,']') as nama from pegawai where aktif=1 ORDER BY nama","up");
        $data['idkondisi_opt'] = $this->dbx->opt("SELECT replid,reff_nama as nama FROM inventory_reff WHERE grup='kondisibarang' ORDER BY reff_nama",'up');
				$data['idruang_opt'] = $this->dbx->opt("SELECT replid, nama FROM inventory_ruang ORDER BY nama",'up');
    	return $data;
    }

    //VIEW
    //-------------------------------------------------------------------------------------------

    public function view_db($id='',$data) {
    	$data['id']=$id;
    	//,IF(penerima<>'',CONCAT(px.nama,' (',px.nip,')'),p.nama)  as penerimatext
      	$sql="SELECT kk.*,c.nama as company
      				,c.phone,c.fax,c.website,c.email,c.street,c.zip,s.status as statustext
      			FROM inventory_beritaacara kk
      			LEFT JOIN hrm_company c ON kk.idcompany=c.replid
				LEFT JOIN hrm_status s ON s.node=kk.status
      			WHERE kk.replid='".$id."'
      			ORDER BY kk.tanggaltransaksi";
        $data['isi'] = $this->dbx->rows($sql);

        $sql="SELECT pm.*,CONCAT('[',im.kode,'] ',' ',im.nama) as materialtext
                      ,pb.kode_inventaris,pb.idmaterial
                      ,d.departemen as departementext
                      ,CONCAT(p.nama,' [',p.nip,']') as pegawaitext
                      ,k.reff_nama as kondisitext
                      ,r.nama as ruangtext
        		FROM inventory_beritaacara_mat pm
        		LEFT JOIN inventory_penyerahan_barang_mat pb ON pb.replid=pm.idinventory_penyerahan_barang
				LEFT JOIN inventory_material im ON im.replid=pb.idmaterial
				LEFT JOIN hrm_departemen d ON d.replid=pm.iddepartemen
				LEFT JOIN pegawai p ON p.replid=pm.idpj
				LEFT JOIN inventory_reff k ON k.replid=pm.idkondisi
				LEFT JOIN inventory_ruang r ON r.replid=pm.idruang
        		WHERE idinventory_beritaacara='".$id."'";
        $data['material'] = $this->dbx->data($sql);
        return $data;
    }

    public function ubahinventaris($id) {
		$sql="UPDATE inventory_penyerahan_barang_mat pm
			  	INNER JOIN inventory_beritaacara_mat pb ON pb.idinventory_penyerahan_barang=pm.replid
				SET pm.idkondisi=pb.idkondisi,pm.idruang=pb.idruang,pm.idpj=pb.idpj,pm.iddepartemen=pb.iddepartemen
				WHERE pb.idinventory_beritaacara='".$id."'";
		$result=$this->db->query($sql);
		//echo $sql;die;
		if($result==TRUE){
			$sql="UPDATE inventory_beritaacara SET status='4'
							WHERE replid='".$id."'";
			$result=$this->db->query($sql);
		}
		return $result;
	}
}
?>
