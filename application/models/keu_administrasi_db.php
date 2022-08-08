<?php

Class keu_administrasi_db extends CI_Model {
	public function __construct() {
		parent::__construct();
		$this->load->library('dbx');
	}

    // Read data from database to show data in admin page
    public function data() {
		$cari="";$cari2="";$order="";

		if ($this->input->post('nama')<>""){
			$cari2=$cari2." AND s.nama like '%".$this->input->post('nama')."%' ";
			$order=" ORDER BY s.nama ";
		}
		
		if($cari2==""){
			if ($this->input->post('idtahunajaran')<>""){
				$cari=$cari." AND k.idtahunajaran='".$this->input->post('idtahunajaran')."' ";
			}

			if ($this->input->post('idkelas')<>""){
				$cari=$cari." AND s.idkelas='".$this->input->post('idkelas')."' ";
			}
		}else{
			$order=" ORDER BY s.tgl_kadaluarsa ASC ";
		}
		
		if($cari==""){
			$cari=$cari." AND ta.idcompany='".$this->input->post('idcompany')."' ";
			$cari=$cari." AND ta.departemen='".$this->input->post('iddepartemen')."' ";
			$cari=$cari." AND ta.aktif='1' ";
		}
		

		//if ($this->input->post('filter')<>1){
		//	$data['show_table']=NULL;
		//}else{
			//,(SELECT 1 FROM besarjtt WHERE nis=s.nis AND DATEDIFF(tgl_batas,CURRENT_DATE())<=30 AND lunas<>1 LIMIT 1) as keuangan
			//,(SELECT 1 FROM besarjttcalon WHERE idcalon=cs.replid AND DATEDIFF(tgl_batas,CURRENT_DATE())<=30 AND lunas<>1 LIMIT 1) as keuangan2
			//, DATE_FORMAT(s.tgl_berlaku, '%d %M %Y') as tgl_berlaku
			//, DATE_FORMAT(s.tgl_berlaku2, '%d %M %Y') as tgl_berlaku2
			//,(IF (CURRENT_DATE() BETWEEN tgl_berlaku AND tgl_berlaku2, 1,0)) as periode_as
			//,administrasisiswa
			
			$sql = "SELECT s.*,DAY(s.tgllahir),MONTH(s.tgllahir)
							,YEAR(s.tgllahir),ks.kondisi as kondisi_nm
							,cs.replid as replidcalon
							,(DATEDIFF (current_date(),s.tgl_masuk)) as jml_hari
							,akt.angkatan,r.region,s.remedialperilaku
							,k.kelas
							,DATEDIFF(tgl_kadaluarsa,CURRENT_DATE()) as sisahari
							,CURRENT_DATE() as hariini, CONCAT(p.nip,' ',p.nama ) as namawalitext
							FROM siswa s
							LEFT JOIN kondisisiswa ks ON ks.replid=s.kondisi
							LEFT JOIN kelas k ON s.idkelas = k.replid
							LEFT JOIN tahunajaran ta ON ta.replid = k.idtahunajaran
							LEFT JOIN pegawai p ON p.replid=k.idwali 
							LEFT JOIN angkatan akt ON akt.replid=s.idangkatan
							LEFT JOIN regional r ON r.replid=s.region
							LEFT JOIN calonsiswa cs ON cs.replidsiswa=s.replid
							WHERE s.replid IS NOT NULL ".$cari." ".$cari2." ".$order;
			//echo $sql;die;
			$data['show_table']=$this->dbx->data($sql);
		//}

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

   public function set_peringatan_history($data) {
    	//echo print_r(array_values($data));die;
    	$this->db->trans_start();
        $this->db->insert('keu_siswa_administrasi', $data);
        $insert_id = $this->db->insert_id();
        if ($this->db->affected_rows() > 0) {
               $this->db->trans_complete();
               return $insert_id;
        } else {
        	$this->db->trans_complete();
            return false;
        }
     }

		 public function set_peringatan($data,$id) {
        $this->db->where('replid',$id);
        $this->db->update('siswa', $data);
        if ($this->db->_error_number() == 0) {
            return true;
        } else {
            return false;
        }
    }

		public function view_db($id,$data){
			$sql="SELECT s.*,DAY(s.tgllahir),MONTH(s.tgllahir)
							,YEAR(s.tgllahir),ks.kondisi as kondisi_nm
							,cs.replid as replidcalon
							,(DATEDIFF (current_date(),s.tgl_masuk)) as jml_hari
							,akt.angkatan,r.region,s.remedialperilaku
							,k.kelas
							,DATEDIFF(tgl_kadaluarsa,CURRENT_DATE()) as sisahari
							FROM siswa s
							LEFT JOIN kondisisiswa ks ON ks.replid=s.kondisi
							LEFT JOIN kelas k ON s.idkelas = k.replid
							LEFT JOIN tahunajaran t ON t.replid = k.idtahunajaran
							LEFT JOIN angkatan akt ON akt.replid=s.idangkatan
							LEFT JOIN regional r ON r.replid=s.region
							LEFT JOIN calonsiswa cs ON cs.replidsiswa=s.replid
							WHERE s.replid='".$id."'";
			$data['isi'] = $this->dbx->rows($sql);

			$sqlperingatan="SELECT * FROM keu_siswa_administrasi WHERE idsiswa='".$id."' ORDER BY tgl_aktivasi";
			$data['peringatan'] = $this->dbx->data($sqlperingatan);

			$sqlattachment="SELECT * FROM keu_siswa_administrasi_attachment WHERE idsiswa='".$id."'";
			$data['attachment'] = $this->dbx->data($sqlattachment);

			return $data;
		}

		public function tambahattachment_db($data) {
		 //echo print_r(array_values($data));die;
		 $this->db->trans_start();
			 $this->db->insert('keu_siswa_administrasi_attachment', $data);
			 $insert_id = $this->db->insert_id();
			 if ($this->db->affected_rows() > 0) {
							$this->db->trans_complete();
							return $insert_id;
			 } else {
				 $this->db->trans_complete();
					 return false;
			 }
		}

		public function hapusattachment_db($id) {
		 // Query to check whether username already exist or not
		 $this->db->where('replid',$id);
		 $this->db->delete('keu_siswa_administrasi_attachment');
		 if ($this->db->_error_number() == 0) {
			 return true;
		 } else {
				 return false;
		 }
	 }
}

?>
