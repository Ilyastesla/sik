<?php

Class pegawai_exit_db extends CI_Model {
public function __construct() {
parent::__construct();
	$this->load->library('dbx');
}
    // Read data from database to show data in admin page
    public function data($data) {
				$cari="";
				$cari .= " AND p.idcompany='".$this->input->post('idcompany')."' ";
				if (($this->input->post('tanggal_keluar1')<>"") AND ($this->input->post('tanggal_keluar2')=="")){
					$cari=$cari." AND kk.tanggal_keluar >= '".$this->p_c->tgl_db($this->input->post('tanggal_keluar1'))."' ";
				}
				if (($this->input->post('tanggal_keluar1')=="") AND ($this->input->post('tanggal_keluar2')<>"")){
					$cari=$cari." AND kk.tanggal_keluar <= '".$this->p_c->tgl_db($this->input->post('tanggal_keluar2'))."' ";
				}
				if (($this->input->post('tanggal_keluar1')<>"") AND ($this->input->post('tanggal_keluar2')<>"")){
					$cari=$cari." AND kk.tanggal_keluar BETWEEN '".$this->p_c->tgl_db($this->input->post('tanggal_keluar1'))."' AND '".$this->p_c->tgl_db($this->input->post('tanggal_keluar2'))."' ";
				}
				if($data['view']=="pegawai_exit_letter"){
					$cari=$cari." AND kk.status NOT IN (1,'CC') ";
				}else if($data['view']=="pegawai_exit_report"){
					$cari=$cari." AND kk.status=4 ";
				}else{
					$cari=$cari." AND kk.status<>4 ";
				}
      	$sql="SELECT kk.*,p.nip,p.nama as pegawaitext
								, sp.nama as alasantext,s.status as statustext,j.jabatan as jabatantext
      			FROM hrm_pegawai_exit kk
						INNER JOIN pegawai p ON kk.idpegawai=p.replid
      			LEFT JOIN hrm_reff sp ON sp.replid=kk.idalasan
						LEFT JOIN hrm_status s ON s.node=kk.status
						LEFT JOIN hrm_jabatan j ON j.replid=kk.idjabatan
						WHERE kk.idpegawai=p.replid ".$cari."
      			ORDER BY kk.created_date";
				//echo $sql;die;
      	$data['show_table']=$this->dbx->data($sql);
		$companyrow=$this->session->userdata('idcompany');
		//$sqlcompany="SELECT kodecabang as replid,nama as nama FROM hrm_company WHERE replid IN (".$companyrow.") AND aktif=1 ORDER BY nama";
		$sqlcompany="SELECT replid,nama as nama FROM hrm_company WHERE replid IN (".$companyrow.") AND aktif=1 ORDER BY nama";
		$data['idcompany_opt'] = $this->dbx->opt($sqlcompany,'up');	  
		return $data;
    }


    //TAMBAH
    //-------------------------------------------------------------------------------------------
    public function tambah_db($id='',$data) {
      	$sql="SELECT kk.*,CONCAT(p.nama,' [',p.nip,']') as pegawaitext,p.idcompany as idcompanyfilter 
      			FROM hrm_pegawai_exit kk
				LEFT JOIN pegawai p ON p.replid=kk.idpegawai
      			WHERE kk.replid='".$id."'";
        $data['isi'] = $this->dbx->rows($sql);

		if ($data['isi']== NULL ) {
        	unset($data['isi']);
        	$sql="SELECT ".$this->dbx->tablecolumn('hrm_pegawai_exit').",NULL as idcompanyfilter";
        	$data['isi']=$this->dbx->rows($sql);
        }

				$filpeg=" aktif=1 ";
				if ($data['isi']->idpegawai<>""){
					$filpeg=" AND (aktif=1 OR replid='".$data['isi']->idpegawai."')";
				}else{
					$filpeg=" AND aktif=1 ";
				}

        
		$companyrow=$this->session->userdata('idcompany');
		//$sqlcompany="SELECT kodecabang as replid,nama as nama FROM hrm_company WHERE replid IN (".$companyrow.") AND aktif=1 ORDER BY nama";				
		$data['idcompanyfilter_opt'] = $this->dbx->opt("SELECT replid,nama as nama FROM hrm_company WHERE aktif=1 AND replid IN (".$companyrow.") ORDER BY nama",'up');
		
		$data['idpegawai_opt'] = $this->dbx->opt("SELECT replid,CONCAT(nama,' [',nip,']') as nama FROM pegawai WHERE nip<>'sa' AND idcompany='".$data['isi']->idcompanyfilter."' ".$filpeg." ORDER BY nama",'up');
		$data['idjabatan_opt'] = $this->dbx->opt("SELECT replid,jabatan as nama FROM hrm_jabatan WHERE aktif=1 ORDER BY jabatan",'up');
		$data['idalasan_opt'] = $this->dbx->opt("SELECT replid,nama FROM hrm_reff WHERE aktif=1 AND type='pegawai_exit' ORDER BY nama",'up');
        return $data;
    }


    /*
    public function kode_transaksi($company,$tanggalpengajuan){
	    $kode_transaksi="";

	    $sql="SELECT CONCAT(company_code,'/KK/',(SELECT DATE_FORMAT('".$tanggalpengajuan."','%Y%m')),'/') as kode_transaksi
	    		FROM hrm_company WHERE replid='".$company."'";
	    $query=$this->db->query($sql);
	    $isi=$query->row();
	    if ($query->num_rows() > 0) {
	    	$kode_transaksi=$isi->kode_transaksi;
	    }


	    $sql2="SELECT LPAD(RIGHT(RIGHT(trim(kode_transaksi),11),4)+1,4,'0') as kode_transaksi2 FROM hrm_pegawai_exit WHERE idcompany='".$company."'
 and LEFT(RIGHT(trim(kode_transaksi),11),6)=DATE_FORMAT('".$tanggalpengajuan."','%Y%m') ORDER BY kode_transaksi2 DESC LIMIT 1";
	   $query2=$this->db->query($sql2);
	    $isi2=$query2->row();
	    if ($query2->num_rows() > 0) {
	    	$kode_transaksi=$kode_transaksi.$isi2->kode_transaksi2;
	    }elseif ($kode_transaksi<>""){
		    $kode_transaksi=$kode_transaksi."0001";
	    }
	    return $kode_transaksi;

    }
    */

	public function hapus_db($id) {
	    // Query to check whether username already exist or not
	    $this->db->where('replid',$id);
	    $this->db->delete('hrm_pegawai_exit');
	    if ($this->db->_error_number() == 0) {
	    	return true;
	    } else {
	        return false;
	    }
    }

    public function view_db($id='',$data) {
    	$data['id']=$id;
      	$sql="SELECT kk.*,p.nip,p.nama as pegawaitext
								, sp.nama as alasantext,s.status as statustext,j.jabatan as jabatantext
      			FROM hrm_pegawai_exit kk
						INNER JOIN pegawai p ON kk.idpegawai=p.replid
      			LEFT JOIN hrm_reff sp ON sp.replid=kk.idalasan
						LEFT JOIN hrm_status s ON s.node=kk.status
						LEFT JOIN hrm_jabatan j ON j.replid=kk.idjabatan
						WHERE kk.replid='".$id."'";
        $data['isi'] = $this->dbx->rows($sql);
        return $data;
    }
}
?>
