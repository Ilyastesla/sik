<?php
Class hrm_tiket_db extends CI_Model {
public function __construct() {
parent::__construct();
	$this->load->library('dbx');
}
    // Read data from database to show data in admin page
    public function data() {
				$cari="";
				if (($this->input->post('periode1')<>"") AND ($this->input->post('periode2')=="")){
					$cari=" AND t.tanggal >= '".$this->p_c->tgl_db($this->input->post('periode1'))."' ";
				}
				if (($this->input->post('periode1')=="") AND ($this->input->post('periode2')<>"")){
					$cari=" AND t.tanggal <= '".$this->p_c->tgl_db($this->input->post('periode2'))."' ";
				}
				if (($this->input->post('periode1')<>"") AND ($this->input->post('periode2')<>"")){
					$cari=" AND t.tanggal BETWEEN '".$this->p_c->tgl_db($this->input->post('periode1'))."' AND '".$this->p_c->tgl_db($this->input->post('periode2'))."' ";
				}
				if (($this->input->post('periode1')=="") AND ($this->input->post('periode2')=="")){
					//$cari=" AND t.tanggal = DATE_FORMAT(CURRENT_DATE(),'%Y-%m-%d')";
					//$cari=" AND t.idstatus<>'4' ";
				}

				//WHERE created_by='".$this->session->userdata('idpegawai')."'
      	$sql="SELECT t.*,pr.perihal as perihaltext,p.prioritas as prioritastext,r.nama as ruangtext,s.status as statustext,p.color,p.periode
							FROM hrm_tiket t
							LEFT JOIN reff_perihal pr ON pr.replid=t.idperihal
							LEFT JOIN reff_prioritas p ON p.replid=t.idprioritas
							LEFT JOIN inventory_ruang r ON r.replid=t.idruang
							LEFT JOIN hrm_status s ON t.idstatus=s.node
							WHERE (t.created_by='".$this->session->userdata('idpegawai')."'
											OR t.idtujuan='".$this->session->userdata('idpegawai')."'
											OR '".$this->session->userdata('idpegawai')."' IN (SELECT DISTINCT created_by FROM hrm_tiket_jawab WHERE idtiket=t.replid)
										)
							".$cari."
							ORDER BY t.modified_date";
				//echo $sql;die;
      	$data['show_table']=$this->dbx->data($sql);
				return $data;
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
	        $sql="SELECT ".$this->dbx->tablecolumn('hrm_tiket').",1 as aktif,CURRENT_DATE() as tanggal";
					//echo $sql;die;
        	$data['isi']=$this->dbx->rows($sql);
        }
				$data['idprioritas_opt'] = $this->dbx->opt("select replid,prioritas as nama from reff_prioritas WHERE aktif=1 ORDER BY no_urut",'up');
				$data['idperihal_opt'] = $this->dbx->opt("select replid,perihal as nama from reff_perihal WHERE aktif=1 AND type='tiket' ORDER BY perihal",'up');
				$data['idperihal_opt'] = $this->p_c->arraymerge($data['idperihal_opt'],array('0' => 'Lain-Lain'));
				$data['idruang_opt'] = $this->dbx->opt("SELECT replid, nama FROM inventory_ruang ORDER BY nama",'up');
				$data['idtujuan_opt'] = $this->dbx->opt("SELECT replid, CONCAT(nama,' [',nip,']') as nama FROM pegawai WHERE aktif=1 ORDER BY nama",'up');
				/*
				$data['idpegawai_opt'] = $this->dbx->data("SELECT p.replid, p.nama, (SELECT 1 FROM hrm_tiket_tujuan WHERE idpegawai=p.replid AND idtiket='".$data['isi']->replid."') cek
																										FROM pegawai p
																										LEFT JOIN hrm_tiket_tujuan t ON p.replid=t.idpegawai
																										WHERE p.aktif=1 ORDER BY nama",'none');
        */
				return $data;
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

	 public function kode_transaksi($tanggal=""){
		$kode_transaksi="";
		  //$sql2="SELECT DATE_FORMAT(tanggal,'%Y%m%d') kodetanggal,LPAD(LEFT(TRIM(kode_transaksi),4)+1,4,'0') as no_urut FROM hrm_tiket WHERE tanggal='".$tanggal."' ORDER BY no_urut LIMIT 1";
		$sql2="SELECT LPAD(LEFT(TRIM(kode_transaksi),4)+1,4,'0') as no_urut FROM hrm_tiket WHERE tanggal=CURRENT_DATE() ORDER BY no_urut LIMIT 1";
	  $query2=$this->db->query($sql2);
	 	$isi2=$query2->row();
	 	if ($query2->num_rows() > 0) {
	 		$kode_transaksi=str_replace('-','',substr($this->dbx->cts(),0,10)).$isi2->no_urut;
	 	}else{
	 		$kode_transaksi=str_replace('-','',substr($this->dbx->cts(),0,10))."0001";
	 	}
		//echo $kode_transaksi;die;
	 	return $kode_transaksi;
	 }

    //hrm_tiket MAP
    //-------------------------------------------------------------------------------------------
    public function tambah_tujuan($id='',$data) {
    	$data['id']=$id;
      	$sql="SELECT *
      			FROM hrm_tiket kk
      			WHERE kk.replid='".$id."'";

        $data['isi'] = $this->dbx->rows($sql);
        $data['idrole_opt'] = $this->dbx->data("SELECT j.replid,j.role as nama
        											,(SELECT '1' FROM hrm_tiket WHERE hrm_tiket_id='".$id."' AND idrole=j.replid) as checked
        											FROM role j
													WHERE j.aktif=1
													ORDER BY j.role");
        return $data;
    }


    public function hapus_tujuan_p_db($id) {
	    $this->db->where('hrm_tiket_id',$id);
	    $this->db->delete('hrm_tiket');
	    if ($this->db->_error_number() == 0) {
	    	return true;
	    } else {
	        return false;
	    }
    }

    public function tambah_tujuan_p_db($data) {
    	//echo print_r(array_values($data));die;
    	$this->db->trans_start();
        $this->db->insert('hrm_tiket', $data);
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
	    $this->db->delete('hrm_tiket');
	    if ($this->db->_error_number() == 0) {
	    	return true;
	    } else {
	        return false;
	    }
    }

		public function view_db($id,$data) {
				$sql="SELECT t.*
								,pr.perihal as perihaltext,p.prioritas as prioritastext,r.nama as ruangtext,s.status as statustext,p.color,p.periode
							FROM hrm_tiket t
							LEFT JOIN reff_perihal pr ON pr.replid=t.idperihal
							LEFT JOIN reff_prioritas p ON p.replid=t.idprioritas
							LEFT JOIN inventory_ruang r ON r.replid=t.idruang
							LEFT JOIN hrm_status s ON t.idstatus=s.node
						WHERE t.replid='".$id."'";
				//echo $sql;die;
				$data['isi'] = $this->dbx->rows($sql);

				$data['idserahtugas_opt'] = $this->dbx->opt("SELECT replid, CONCAT(nama,' [',nip,']') as nama FROM pegawai WHERE aktif=1 AND replid<>'".$data["isi"]->idtujuan."'ORDER BY nama",'up');

				if($data['isi']->created_by==$this->session->userdata('idpegawai')){
						$jenisstatus="18,4";
				}else{
					$jenisstatus="3,14";
				}

				$sql="SELECT node as replid,status as nama FROM hrm_status WHERE replid IN (".$jenisstatus.") ORDER BY status ";
			  $data['idstatus_opt']=$this->dbx->opt($sql);

				$sql="SELECT tj.*,s.status as statustext FROM hrm_tiket_jawab tj
							LEFT JOIN hrm_status s ON s.node=tj.idstatus
							WHERE tj.idtiket='".$id."' ORDER BY tj.created_date ASC";
			  $data['isithread']=$this->dbx->data($sql);

				if($data['jawab']==1){
			        $sql="SELECT ".$this->dbx->tablecolumn('hrm_tiket_jawab');
			        $data['isijawab']=$this->dbx->rows($sql);
				}

				return $data;
		}

}
?>
