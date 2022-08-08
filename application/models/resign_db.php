<?php

Class resign_db extends CI_Model {
public function __construct() {
parent::__construct();
	$this->load->library('dbx');
}
    // Read data from database to show data in admin page
    public function data() {
      	$sql="SELECT kk.*
										,p.nama as idpegawai
      			FROM hrm_pegawai_resign kk
						LEFT JOIN pegawai p ON kk.idpegawai=p.replid
      			ORDER BY kk.tgl_resign";
      	return $this->dbx->data($sql);
    }


    //TAMBAH
    //-------------------------------------------------------------------------------------------
    public function tambah_x($id='',$data) {
    	$data['id']=$id;
      	$sql="SELECT *
      			FROM hrm_pegawai_resign kk
      			WHERE kk.replid='".$id."'";
        $data['isi'] = $this->dbx->rows($sql);

        if ($data['isi']== NULL ) {
        	unset($data['isi']);
        	$sql="SELECT
        			NULL as replid,
					NULL as no_sk,
					NULL as idpegawai,
					NULL as idcompany,
					NULL as idtype_resign,
					NULL as idjabatan,
					NULL as idpegawai_status,
					NULL as keterangan,
					CURRENT_DATE as tgl_resign,
					NULL as created_date,
					NULL as created_by,
					NULL as modified_date,
					NULL as modified_by";
        	$data['isi']=$this->dbx->rows($sql);
        }

        $data['idcompany_opt'] = $this->dbx->opt("select replid,CONCAT(company_code,' ',nama) as nama from hrm_company WHERE aktif=1 ORDER BY nama",'up');
        $data['idpegawai_opt'] = $this->dbx->opt("select replid,nama from pegawai where aktif=1 ORDER BY nama",'up');
        $data['idtype_resign_opt'] = $this->dbx->opt("select replid,pegawai_tipe_pengangkatan as nama from hrm_pegawai_tipe_pengangkatan WHERE aktif=1 ORDER BY pegawai_tipe_pengangkatan",'up');
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


	    $sql2="SELECT LPAD(RIGHT(RIGHT(trim(kode_transaksi),11),4)+1,4,'0') as kode_transaksi2 FROM hrm_pegawai_resign WHERE idcompany='".$company."'
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
        $this->db->insert('hrm_pegawai_resign', $data);
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
		$this->db->update('hrm_pegawai_resign', $data);
		if ($this->db->_error_number() == 0) {
		  return true;
		} else {
		  return false;
		}
	}
	public function hapus_db($id) {
	    // Query to check whether username already exist or not
	    $this->db->where('replid',$id);
	    $this->db->delete('hrm_pegawai_resign');
	    if ($this->db->_error_number() == 0) {
	    	return true;
	    } else {
	        return false;
	    }
    }

    public function tambahkompetensi($id,$jabatan) {
    	$sql2="DELETE FROM hrm_pegawai_resign_kompetensi WHERE idresign='".$id."' AND idkompetensi NOT IN (SELECT replid FROM hrm_jabatan_kompetensi WHERE idjabatan='".$jabatan."')";
	    $this->db->query($sql2);



    	$sql="	INSERT INTO hrm_pegawai_resign_kompetensi(idresign,idkompetensi,skor,created_date,created_by)
    			SELECT '".$id."',replid,NULL,CURRENT_DATE(),'".$this->session->userdata('nip')."'
    			FROM hrm_jabatan_kompetensi
    			WHERE idkompetensi NOT IN (select idkompetensi FROM hrm_pegawai_resign_kompetensi where idresign='".$id."') AND idjabatan='".$jabatan."'";
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
        		FROM hrm_pegawai_resign_kompetensi pk
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
		$this->db->update('hrm_pegawai_resign_kompetensi', $data);
		if ($this->db->_error_number() == 0) {
		  return true;
		} else {
		  return false;
		}
	}
	public function hapuskompetensi_db($id) {
	    // Query to check whether username already exist or not
	    $this->db->where('replid',$id);
	    $this->db->delete('hrm_pegawai_resign_kompetensi');
	    if ($this->db->_error_number() == 0) {
	    	return true;
	    } else {
	        return false;
	    }
    }


    public function view_db($id='',$data) {
    	$data['id']=$id;
      	$sql="SELECT kk.*,c.nama as idcompany,p.nama as idpegawaitext,d.departemen as iddepartemen,sp.pegawai_status as idpegawai_status
      			,tp.pegawai_tipe_pengangkatan as idtype_resign
      			,j.jabatan as idjabatan_text,p.nip,p.replid as replidkaryawan
      			FROM hrm_pegawai_resign kk
      			LEFT JOIN hrm_company c ON kk.idcompany=c.replid
      			LEFT JOIN pegawai p ON kk.idpegawai=p.replid
      			LEFT JOIN hrm_pegawai_tipe_pengangkatan tp ON tp.replid=kk.idtype_resign
      			LEFT JOIN hrm_jabatan j ON j.replid=kk.idjabatan
      			LEFT JOIN hrm_departemen d ON j.iddepartemen=d.replid
      			LEFT JOIN hrm_pegawai_status sp ON sp.replid=kk.idpegawai_status
      			WHERE kk.replid='".$id."'";
        $data['isi'] = $this->dbx->rows($sql);
        $sql2="	SELECT pk.*,k.kompetensi as idkompetensi,k.max_skor
        		FROM hrm_pegawai_resign_kompetensi pk
        		INNER JOIN hrm_kompetensi k ON k.replid=pk.idkompetensi
      			WHERE pk.idresign='".$id."'
      			";
        $data['kompetensi']=$this->dbx->data($sql2);
        return $data;
    }

    public function last_stat($id,$idpegawai,$idjabatan) {
    	//DELETE YANG LAMA

    	$sqldeljabatan="DELETE FROM hrm_pegawai_jabatan WHERE idresign='".$id."'";
    	$this->db->query($sqldeljabatan);
    	$sqldeljabatan2="DELETE FROM hrm_pegawai_jabatan WHERE idpegawai='".$idpegawai."' AND idjabatan='".$idjabatan."'";
    	$this->db->query($sqldeljabatan2);

    	$sqlinsjabatan="INSERT INTO hrm_pegawai_jabatan(idpegawai,idjabatan,idresign,avg_kompetensi,idpegawai_status,idcompany
									    				,awal_resign,akhir_resign,jam_masuk,jam_keluar,aktif
									    				,created_date,created_by,modified_date,modified_by)
    						SELECT idpegawai,idjabatan,replid,avg_kompetensi,idpegawai_status,idcompany
				    				,awal_resign,akhir_resign,jam_masuk,jam_keluar,1 as aktif
				    				,created_date,created_by,modified_date,modified_by
							FROM hrm_pegawai_resign WHERE replid='".$id."'";
    	$this->db->query($sqlinsjabatan);
    	/*


    	$sql="	UPDATE pegawai p
    			INNER JOIN (SELECT * FROM hrm_pegawai_resign WHERE idpegawai='".$idpegawai."' ORDER BY akhir_resign DESC LIMIT 1) pk
    						ON p.replid=pk.idpegawai
    			SET
    				p.no_sk=pk.no_sk,p.idjabatan=pk.idjabatan,p.idpegawai_status=pk.idpegawai_status
    				,p.idcompany=pk.idcompany,p.akhir_resign=pk.akhir_resign,p.jam_masuk=pk.jam_masuk
    				,p.jam_keluar=pk.jam_keluar,p.avg_kompetensi=pk.avg_kompetensi,p.modified_date=CURRENT_TIMESTAMP(),p.modified_by='".$this->session->userdata('nip')."'
    				WHERE pk.idpegawai='".$idpegawai."'";
	    $this->db->query($sql);

	    $sql="	UPDATE pegawai p
    			INNER JOIN (SELECT * FROM hrm_pegawai_resign WHERE idpegawai='".$idpegawai."' ORDER BY awal_resign ASC LIMIT 1) pk
    						ON p.replid=pk.idpegawai
    			SET
    				p.mulaikerja=pk.awal_resign
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
