<?php
Class hrm_tiket_jawab_db extends CI_Model {
public function __construct() {
parent::__construct();
	$this->load->library('dbx');
}
    // Read data from database to show data in admin page
    public function data() {
				//INNER JOIN hrm_tiket_tujuan tt ON t.replid=tt.idtiket
      	$sql="SELECT t.*,pr.perihal as perihaltext,p.prioritas as prioritastext,r.nama as ruangtext,s.status as statustext
							FROM hrm_tiket t
							LEFT JOIN reff_perihal pr ON pr.replid=t.idperihal
							LEFT JOIN reff_prioritas p ON p.replid=t.idprioritas
							LEFT JOIN inventory_ruang r ON r.replid=t.idruang
							LEFT JOIN hrm_status s ON t.status=s.node
							WHERE t.idtujuan='".$this->session->userdata('idpegawai')."'
      			ORDER BY modified_date";
				//echo $sql;die;
      	return $this->dbx->data($sql);
    }


    //TAMBAH
    //-------------------------------------------------------------------------------------------
    public function tambah_x($id='',$data) {
    	$data['id']=$id;
      	$sql="SELECT *
      			FROM hrm_tiket kk
      			WHERE kk.replid='".$id."'";
        $data['isi'] = $this->dbx->rows($sql);

        if ($data['isi']== NULL ) {
        	unset($data['isi']);
        	$sql="SELECT
					NULL as subjek,
					NULL as deskripsi,
					NULL as idprioritas,
					NULL as idperihal,
					NULL as idruang,
					1 as aktif,
					CURRENT_DATE() as tanggalpengajuan,
					NULL as created_date,
					NULL as created_by,
					NULL as modified_date,
					NULL as modified_by";
        	$data['isi']=$this->dbx->rows($sql);
        }
				$data['idprioritas_opt'] = $this->dbx->opt("select replid,prioritas as nama from reff_prioritas WHERE aktif=1 ORDER BY no_urut",'up');
				$data['idperihal_opt'] = $this->dbx->opt("select replid,perihal as nama from reff_perihal WHERE aktif=1 AND type='tiket' ORDER BY perihal",'up');
				$data['idperihal_opt'] = $this->p_c->arraymerge($data['idperihal_opt'],array('0' => 'Lain-Lain'));
				$data['idruang_opt'] = $this->dbx->opt("SELECT replid, nama FROM inventory_ruang ORDER BY nama",'up');
				return $data;
    }

    public function tambah($data) {
    	//echo print_r(array_values($data));die;
    	$this->db->trans_start();
        $this->db->insert('hrm_tiket', $data);
        $insert_id = $this->db->insert_id();
        if ($this->db->affected_rows() > 0) {
               $this->db->trans_complete();
               return $insert_id;
        } else {
        	$this->db->trans_complete();
            return false;
        }
     }

 public function tambahperihal($data) {
		//echo print_r(array_values($data));die;
		$this->db->trans_start();
			$this->db->insert('reff_perihal', $data);
			$insert_id = $this->db->insert_id();
			if ($this->db->affected_rows() > 0) {
						 $this->db->trans_complete();
						 return $insert_id;
			} else {
				$this->db->trans_complete();
					return false;
			}
	 }

	 public function kode_transaksi($tanggalpengajuan){
		$kode_transaksi="";
	  $sql2="SELECT DATE_FORMAT(tanggalpengajuan,'%Y%m%d') kodetanggal,LPAD(LEFT(TRIM(kode_transaksi),4)+1,4,'0') as no_urut FROM hrm_tiket_jawab
	 					WHERE tanggalpengajuan='".$tanggalpengajuan."' ORDER BY no_urut LIMIT 1";
	  $query2=$this->db->query($sql2);
	 	$isi2=$query2->row();
	 	if ($query2->num_rows() > 0) {
	 		$kode_transaksi=$isi2->kodetanggal.$isi2->no_urut;
	 	}else{
	 		$kode_transaksi=str_replace('-','',$tanggalpengajuan)."0001";
	 	}
	 	return $kode_transaksi;
	 }

	public function ubah($data,$id) {
		//echo var_dump($data);die;
		$this->db->where('replid',$id);
		$this->db->update('hrm_tiket_jawab', $data);
		if ($this->db->_error_number() == 0) {
		  return true;
		} else {
		  return false;
		}
	}

    //hrm_tiket_jawab MAP
    //-------------------------------------------------------------------------------------------
    public function tambah_tujuan($id='',$data) {
    	$data['id']=$id;
      	$sql="SELECT *
      			FROM hrm_tiket_jawab kk
      			WHERE kk.replid='".$id."'";

        $data['isi'] = $this->dbx->rows($sql);
        $data['idrole_opt'] = $this->dbx->data("SELECT j.replid,j.role as nama
        											,(SELECT '1' FROM hrm_tiket_jawab WHERE hrm_tiket_jawab_id='".$id."' AND idrole=j.replid) as checked
        											FROM role j
													WHERE j.aktif=1
													ORDER BY j.role");
        return $data;
    }


    public function hapus_tujuan_p_db($id) {
	    $this->db->where('hrm_tiket_jawab_id',$id);
	    $this->db->delete('hrm_tiket_jawab');
	    if ($this->db->_error_number() == 0) {
	    	return true;
	    } else {
	        return false;
	    }
    }

    public function tambah_tujuan_p_db($data) {
    	//echo print_r(array_values($data));die;
    	$this->db->trans_start();
        $this->db->insert('hrm_tiket_jawab', $data);
        $insert_id = $this->db->insert_id();
        if ($this->db->affected_rows() > 0) {
               $this->db->trans_complete();
               return true;
        } else {
        	$this->db->trans_complete();
            return false;
        }
     }

    public function hapus_db($id) {
	    // Query to check whether username already exist or not
	    $this->db->where('replid',$id);
	    $this->db->delete('hrm_tiket_jawab');
	    if ($this->db->_error_number() == 0) {
	    	return true;
	    } else {
	        return false;
	    }
    }

		public function view_db($id,$data) {
			//,IF(penerima<>'',CONCAT(px.nama,' (',px.nip,')'),p.nama)  as penerimatext
				$sql="SELECT t.*,pr.perihal as perihaltext,p.prioritas as prioritastext,r.nama as ruangtext,s.status as statustext
							FROM hrm_tiket_jawab t
							LEFT JOIN reff_perihal pr ON pr.replid=t.idperihal
							LEFT JOIN reff_prioritas p ON p.replid=t.idprioritas
							LEFT JOIN inventory_ruang r ON r.replid=t.idruang
							LEFT JOIN hrm_status s ON t.status=s.node
						WHERE t.replid='".$id."'";
				$data['isi'] = $this->dbx->rows($sql);
				return $data;
		}

}
?>
