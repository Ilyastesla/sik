<?php

Class kontrak_db extends CI_Model {
public function __construct() {
parent::__construct();
	$this->load->library('dbx');
}
    // Read data from database to show data in admin page
    public function data() {
				$cari="";
				$cari .= " AND p.idcompany='".$this->input->post('idcompany')."' ";
				if (($this->input->post('awal_kontrak1')<>"") AND ($this->input->post('awal_kontrak2')=="")){
					$cari=$cari." AND kk.awal_kontrak >= '".$this->p_c->tgl_db($this->input->post('awal_kontrak1'))."' ";
				}
				if (($this->input->post('awal_kontrak1')=="") AND ($this->input->post('awal_kontrak2')<>"")){
					$cari=$cari." AND kk.awal_kontrak <= '".$this->p_c->tgl_db($this->input->post('awal_kontrak2'))."' ";
				}
				if (($this->input->post('awal_kontrak1')<>"") AND ($this->input->post('awal_kontrak2')<>"")){
					$cari=$cari." AND kk.awal_kontrak BETWEEN '".$this->p_c->tgl_db($this->input->post('awal_kontrak1'))."' AND '".$this->p_c->tgl_db($this->input->post('awal_kontrak2'))."' ";
				}

				if (($this->input->post('akhir_kontrak1')<>"") AND ($this->input->post('akhir_kontrak2')=="")){
					$cari=$cari." AND kk.akhir_kontrak >= '".$this->p_c->tgl_db($this->input->post('akhir_kontrak1'))."' ";
				}
				if (($this->input->post('akhir_kontrak1')=="") AND ($this->input->post('akhir_kontrak2')<>"")){
					$cari=$cari." AND kk.akhir_kontrak <= '".$this->p_c->tgl_db($this->input->post('akhir_kontrak2'))."' ";
				}
				if (($this->input->post('akhir_kontrak1')<>"") AND ($this->input->post('akhir_kontrak2')<>"")){
					$cari=$cari." AND kk.akhir_kontrak BETWEEN '".$this->p_c->tgl_db($this->input->post('akhir_kontrak1'))."' AND '".$this->p_c->tgl_db($this->input->post('akhir_kontrak2'))."' ";
				}

				if (($this->input->post('tanggal_pembuatan1')<>"") AND ($this->input->post('tanggal_pembuatan2')=="")){
					$cari=$cari." AND kk.tanggal_pembuatan >= '".$this->p_c->tgl_db($this->input->post('tanggal_pembuatan1'))."' ";
				}
				if (($this->input->post('tanggal_pembuatan1')=="") AND ($this->input->post('tanggal_pembuatan2')<>"")){
					$cari=$cari." AND kk.tanggal_pembuatan <= '".$this->p_c->tgl_db($this->input->post('tanggal_pembuatan2'))."' ";
				}
				if (($this->input->post('tanggal_pembuatan1')<>"") AND ($this->input->post('tanggal_pembuatan2')<>"")){
					$cari=$cari." AND kk.tanggal_pembuatan BETWEEN '".$this->p_c->tgl_db($this->input->post('tanggal_pembuatan1'))."' AND '".$this->p_c->tgl_db($this->input->post('tanggal_pembuatan2'))."' ";
				}

				if ($this->input->post('sisakontrak')<>""){
					$cari=$cari." AND sisakontrak='".$this->input->post('sisakontrak')."' ";
				}
      	$sql="SELECT kk.*,c.nama as idcompany,p.nama as idpegawai,d.departemen as iddepartemen,sp.nama as idpegawai_status
      			,tp.pegawai_tipe_pengangkatan as idpegawai_tipe_pengangkatan
      			,j.jabatan as idjabatan
						,DATEDIFF(kk.akhir_kontrak,CURRENT_DATE()) as sisakontrak
						,p.aktif
      			FROM hrm_pegawai_kontrak kk
				INNER JOIN pegawai p ON kk.idpegawai=p.replid
      			LEFT JOIN hrm_company c ON kk.idcompany=c.replid
      			LEFT JOIN hrm_pegawai_tipe_pengangkatan tp ON tp.replid=kk.idpegawai_tipe_pengangkatan
      			LEFT JOIN hrm_jabatan j ON j.replid=kk.idjabatan
      			LEFT JOIN hrm_departemen d ON j.iddepartemen=d.replid
      			LEFT JOIN hrm_reff sp ON sp.replid=kk.idpegawai_status
						WHERE kk.idpegawai=p.replid ".$cari."
      			ORDER BY kk.tanggal_pembuatan";
				//echo $sql;
      	$data['show_table']=$this->dbx->data($sql);
		  $companyrow=$this->session->userdata('idcompany');
				//$sqlcompany="SELECT kodecabang as replid,nama as nama FROM hrm_company WHERE replid IN (".$companyrow.") AND aktif=1 ORDER BY nama";
				$sqlcompany="SELECT replid,nama as nama FROM hrm_company WHERE replid IN (".$companyrow.") AND aktif=1 ORDER BY nama";
				$data['idcompany_opt'] = $this->dbx->opt($sqlcompany,'up');
				return $data;
    }


    //TAMBAH
    //-------------------------------------------------------------------------------------------
    public function tambah_x($id='',$data) {
    	$data['id']=$id;
      	$sql="SELECT kk.*,p.idcompany as idcompanyfilter
      			FROM hrm_pegawai_kontrak kk
				LEFT JOIN pegawai p ON p.replid=kk.idpegawai 
      			WHERE kk.replid='".$id."'";
        $data['isi'] = $this->dbx->rows($sql);

        if ($data['isi']== NULL ) {
        	unset($data['isi']);
        	$sql="SELECT
					NULL as idcompanyfilter,
					NULL as replid,
					NULL as no_sk,
					NULL as idpegawai,
					NULL as idcompany,
					NULL as idpegawai_tipe_pengangkatan,
					NULL as idjabatan,
					NULL as idpegawai_status,
					NULL as awal_kontrak,
					NULL as akhir_kontrak,
					NULL as jam_kerja,
					NULL as menimbang,
					NULL as mengingat,
					NULL as memperhatikan,
					NULL as memutuskan,
					NULL as keterangan,
					NULL as avg_kompetensi,
					CURRENT_DATE() as tanggal_pembuatan,
					'08:00:00' as jam_masuk,
					'16:30:00' as jam_keluar,
					NULL as created_date,
					NULL as created_by,
					NULL as modified_date,
					NULL as modified_by";
        	$data['isi']=$this->dbx->rows($sql);
        }

		$companyrow=$this->session->userdata('idcompany');
		//$sqlcompany="SELECT kodecabang as replid,nama as nama FROM hrm_company WHERE replid IN (".$companyrow.") AND aktif=1 ORDER BY nama";
				
        $data['idcompanyfilter_opt'] = $this->dbx->opt("SELECT replid,nama as nama FROM hrm_company WHERE aktif=1 AND replid IN (".$companyrow.") ORDER BY nama",'up');
		$data['idcompany_opt'] = $this->dbx->opt("SELECT replid,CONCAT(company_code,' ',nama) as nama FROM hrm_company WHERE aktif=1 ORDER BY nama",'up');
        $data['idpegawai_opt'] = $this->dbx->opt("SELECT replid,CONCAT(nama,' [',nip,']') as nama FROM pegawai WHERE aktif=1 AND idcompany='".$data['isi']->idcompanyfilter."' ORDER BY nama",'up');
        $data['idpegawai_tipe_pengangkatan_opt'] = $this->dbx->opt("select replid,pegawai_tipe_pengangkatan as nama from hrm_pegawai_tipe_pengangkatan WHERE aktif=1 ORDER BY pegawai_tipe_pengangkatan",'up');
        $data['idjabatan_opt'] = $this->dbx->opt("SELECT replid,jabatan as nama FROM hrm_jabatan WHERE aktif=1 ORDER BY jabatan",'up');
        $data['idpegawai_status_opt'] = $this->dbx->opt("SELECT replid,nama as nama FROM hrm_reff WHERE aktif=1 AND type='pegawai_status' ORDER BY nama",'up');
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


	    $sql2="SELECT LPAD(RIGHT(RIGHT(trim(kode_transaksi),11),4)+1,4,'0') as kode_transaksi2 FROM hrm_pegawai_kontrak WHERE idcompany='".$company."'
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

    public function tambah($data) {
    	//echo print_r(array_values($data));die;
    	$this->db->trans_start();
        $this->db->insert('hrm_pegawai_kontrak', $data);
        $insert_id = $this->db->insert_id();
        if ($this->db->affected_rows() > 0) {
               $this->db->trans_complete();
               return $insert_id;
        } else {
        	$this->db->trans_complete();
            return false;
        }
     }
	public function ubah($data,$id) {
		//echo var_dump($data);die;
		$this->db->where('replid',$id);
		$this->db->update('hrm_pegawai_kontrak', $data);
		if ($this->db->_error_number() == 0) {
		  return true;
		} else {
		  return false;
		}
	}
	public function hapus_db($id) {
	    // Query to check whether username already exist or not
	    $this->db->where('replid',$id);
	    $this->db->delete('hrm_pegawai_kontrak');
	    if ($this->db->_error_number() == 0) {
	    	return true;
	    } else {
	        return false;
	    }
    }

    public function tambahkompetensi($id,$jabatan) {
    	$sql2="DELETE FROM hrm_pegawai_kontrak_kompetensi WHERE idkontrak='".$id."' AND idkompetensi NOT IN (SELECT replid FROM hrm_jabatan_kompetensi WHERE idjabatan='".$jabatan."')";
	    $this->db->query($sql2);



    	$sql="	INSERT INTO hrm_pegawai_kontrak_kompetensi(idkontrak,idkompetensi,skor,created_date,created_by)
    			SELECT '".$id."',replid,NULL,CURRENT_DATE(),'".$this->session->userdata('idpegawai')."'
    			FROM hrm_jabatan_kompetensi
    			WHERE idkompetensi NOT IN (select idkompetensi FROM hrm_pegawai_kontrak_kompetensi where idkontrak='".$id."') AND idjabatan='".$jabatan."'";
	    $this->db->query($sql);

    	if ($this->db->_error_number() == 0) {
	    	return true;
	    } else {
	        return false;
	    }
    }

    public function ubahkompetensi_x($id='',$data) {
    	$data['id']=$id;
      	$sql="SELECT pk.*,k.kompetensi as idkompetensi,k.max_skor
        		FROM hrm_pegawai_kontrak_kompetensi pk
        		INNER JOIN hrm_kompetensi k ON k.replid=pk.idkompetensi
      			WHERE pk.replid='".$id."'";
        $data['isi'] = $this->dbx->rows($sql);

        $data['jt_opt'] = $this->dbx->opt("select replid,nama from hrm_datapengeluaran ORDER BY nama",'up');
        $data['kredit_opt'] = $this->dbx->opt("SELECT ra.replid,CONCAT(ra.kode,' ',ra.nama) as nama FROM rekakun ra where ra.kategori='HARTA' ORDER BY ra.nama",'up');
        $data['debit_opt'] = $this->dbx->opt("SELECT ra.replid,CONCAT(ra.kode,' ',ra.nama) as nama FROM rekakun ra where ra.kategori='BIAYA' ORDER BY ra.nama",'up');
    	return $data;
    }

	public function ubahkompetensi_db($data,$id) {
		//echo var_dump($data);die;
		$this->db->where('replid',$id);
		$this->db->update('hrm_pegawai_kontrak_kompetensi', $data);
		if ($this->db->_error_number() == 0) {
		  return true;
		} else {
		  return false;
		}
	}
	public function hapuskompetensi_db($id) {
	    // Query to check whether username already exist or not
	    $this->db->where('replid',$id);
	    $this->db->delete('hrm_pegawai_kontrak_kompetensi');
	    if ($this->db->_error_number() == 0) {
	    	return true;
	    } else {
	        return false;
	    }
    }


    public function view_db($id='',$data) {
    	$data['id']=$id;
      	$sql="SELECT kk.*,c.nama as idcompany,p.nama as idpegawaitext,d.departemen as iddepartemen,sp.nama as idpegawai_status
      			,tp.pegawai_tipe_pengangkatan as idpegawai_tipe_pengangkatan
      			,j.jabatan as idjabatan_text,p.nip,p.replid as replidkaryawan
      			FROM hrm_pegawai_kontrak kk
      			LEFT JOIN hrm_company c ON kk.idcompany=c.replid
      			LEFT JOIN pegawai p ON kk.idpegawai=p.replid
      			LEFT JOIN hrm_pegawai_tipe_pengangkatan tp ON tp.replid=kk.idpegawai_tipe_pengangkatan
      			LEFT JOIN hrm_jabatan j ON j.replid=kk.idjabatan
      			LEFT JOIN hrm_departemen d ON j.iddepartemen=d.replid
      			LEFT JOIN hrm_reff sp ON sp.replid=kk.idpegawai_status
      			WHERE kk.replid='".$id."'";
        $data['isi'] = $this->dbx->rows($sql);
        $sql2="	SELECT pk.*,k.kompetensi as idkompetensi,k.max_skor
        		FROM hrm_pegawai_kontrak_kompetensi pk
        		INNER JOIN hrm_kompetensi k ON k.replid=pk.idkompetensi
      			WHERE pk.idkontrak='".$id."'
      			";
        $data['kompetensi']=$this->dbx->data($sql2);
        return $data;
    }

    public function last_stat($id,$idpegawai,$idjabatan) {
    	//DELETE YANG LAMA

    	$sqldeljabatan="DELETE FROM hrm_pegawai_jabatan WHERE idkontrak='".$id."'";
    	$this->db->query($sqldeljabatan);
    	$sqldeljabatan2="DELETE FROM hrm_pegawai_jabatan WHERE idpegawai='".$idpegawai."' AND idjabatan='".$idjabatan."'";
    	$this->db->query($sqldeljabatan2);

    	$sqlinsjabatan="INSERT INTO hrm_pegawai_jabatan(idpegawai,idjabatan,idkontrak,avg_kompetensi,idpegawai_status,idcompany
									    				,awal_kontrak,akhir_kontrak,jam_masuk,jam_keluar,aktif
									    				,created_date,created_by,modified_date,modified_by)
    						SELECT idpegawai,idjabatan,replid,avg_kompetensi,idpegawai_status,idcompany
				    				,awal_kontrak,akhir_kontrak,jam_masuk,jam_keluar,1 as aktif
				    				,created_date,created_by,modified_date,modified_by
							FROM hrm_pegawai_kontrak WHERE replid='".$id."'";
    	$this->db->query($sqlinsjabatan);
    	/*


    	$sql="	UPDATE pegawai p
    			INNER JOIN (SELECT * FROM hrm_pegawai_kontrak WHERE idpegawai='".$idpegawai."' ORDER BY akhir_kontrak DESC LIMIT 1) pk
    						ON p.replid=pk.idpegawai
    			SET
    				p.no_sk=pk.no_sk,p.idjabatan=pk.idjabatan,p.idpegawai_status=pk.idpegawai_status
    				,p.idcompany=pk.idcompany,p.akhir_kontrak=pk.akhir_kontrak,p.jam_masuk=pk.jam_masuk
    				,p.jam_keluar=pk.jam_keluar,p.avg_kompetensi=pk.avg_kompetensi,p.modified_date=CURRENT_TIMESTAMP(),p.modified_by='".$this->session->userdata('idpegawai')."'
    				WHERE pk.idpegawai='".$idpegawai."'";
	    $this->db->query($sql);

	    $sql="	UPDATE pegawai p
    			INNER JOIN (SELECT * FROM hrm_pegawai_kontrak WHERE idpegawai='".$idpegawai."' ORDER BY awal_kontrak ASC LIMIT 1) pk
    						ON p.replid=pk.idpegawai
    			SET
    				p.mulaikerja=pk.awal_kontrak
    				WHERE pk.idpegawai='".$idpegawai."'";
	    $this->db->query($sql);
	    */

	    if ($this->db->_error_number() == 0) {
	    	return true;
	    } else {
	        return false;
	    }
    }
}
?>
