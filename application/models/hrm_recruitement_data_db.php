<?php

Class hrm_recruitement_data_db extends CI_Model {
	public function __construct() {
	parent::__construct();
		$this->load->library('dbx');
	}

    public function data($aktif) {

				$sql="SELECT p.*
              ,(TIMESTAMPDIFF(YEAR, p.tgllahir, CURDATE())) as umur
      			FROM pegawai_calon p
      			ORDER BY created_date DESC";
						return $this->dbx->data($sql);
    }
    public function view($id,$data) {
    	$sql="SELECT p.*
            ,(TIMESTAMPDIFF(YEAR, p.tgllahir, CURDATE())) as umur
          FROM pegawai_calon p
      			WHERE p.replid='".$id."'";
        $data['header'] = $this->dbx->rows($sql);
       return $data;
    }
    public function kontakdarurat_db($id_pegawai,$data) {
      	$sql="SELECT pkd.*,pr.reff as hubungan,n.negara as negara FROM pegawai_kontak_darurat  pkd
      			LEFT JOIN pegawai_reff pr ON pkd.hubungan=pr.replid
      			LEFT JOIN negara n ON pkd.negara=n.replid
      			WHERE pegawai_id='".$id_pegawai."' AND pr.type=1";
      	$data['kontakdarurat']=$this->dbx->data($sql);
      	return $data;
   }

   public function keluarga_db($id_pegawai,$data) {
     	$sql="SELECT k.*,pr.reff as hubungan,tp.pendidikan as pendidikan_terakhir,jp.pekerjaan,i.instansi
     			,(TIMESTAMPDIFF(YEAR, k.tanggal_lahir, CURDATE())) as umur
     			FROM pegawai_keluarga k
     			LEFT JOIN pegawai_reff pr ON k.hubungan=pr.replid AND pr.type=1
     			LEFT JOIN tingkatpendidikan tp ON tp.replid=k.pendidikan_terakhir
     			LEFT JOIN jenispekerjaan jp ON jp.replid=k.pekerjaan
     			LEFT JOIN instansi i ON i.replid=k.instansi
     			WHERE pegawai_id='".$id_pegawai."' ORDER BY k.tanggal_lahir ASC";
     	$data['keluarga']=$this->dbx->data($sql);
     	return $data;
     }
   public function perbankan_db($id_pegawai,$data) {
     	$sql="SELECT pp.*,pr.reff as type FROM pegawai_perbankan pp
     			LEFT JOIN pegawai_reff pr ON pr.replid=pp.type AND pr.type=2
     			WHERE pegawai_id='".$id_pegawai."'";
     	$data['perbankan']=$this->dbx->data($sql);
     	return $data;
     }
   public function pendidikan_db($id_pegawai,$data) {
       $sql="SELECT k.*,tp.pendidikan as jenjang
             FROM pegawai_pendidikan k
           LEFT JOIN tingkatpendidikan tp ON tp.replid=k.jenjang
           WHERE pegawai_id='".$id_pegawai."' ORDER BY k.tahun_keluar ASC";
       $data['pendidikan']=$this->dbx->data($sql);
       return $data;
     }
 public function pendidikan_nf_db($id_pegawai,$data) {
   	$sql="SELECT k.*
   	    	FROM pegawai_pendidikan_nf k
   			WHERE pegawai_id='".$id_pegawai."'";
   	$data['pendidikan_nf']=$this->dbx->data($sql);
   	return $data;
   }
 public function bahasa_db($id_pegawai,$data) {
   	$sql="SELECT k.*,pr1.reff as bicara,pr2.reff as menulis,pr3.reff as membaca
   	    	FROM pegawai_bahasa k
   	    	LEFT JOIN pegawai_reff pr1 ON k.bicara=pr1.replid AND pr1.type=6
   	    	LEFT JOIN pegawai_reff pr2 ON k.menulis=pr2.replid AND pr2.type=6
   	    	LEFT JOIN pegawai_reff pr3 ON k.membaca=pr3.replid AND pr3.type=6
   			WHERE pegawai_id='".$id_pegawai."'";
   	$data['bahasa']=$this->dbx->data($sql);
   	return $data;
   }
  public function komputer_db($id_pegawai,$data) {
   	$sql="SELECT k.*,pr1.reff as bidang,pr2.reff as tingkat
   	    	FROM pegawai_komputer k
   	    	LEFT JOIN pegawai_reff pr1 ON k.bidang=pr1.replid AND pr1.type=7
   	    	LEFT JOIN pegawai_reff pr2 ON k.tingkat=pr2.replid AND pr2.type=6
   			WHERE pegawai_id='".$id_pegawai."'";
   	$data['komputer']=$this->dbx->data($sql);
   	return $data;
   }
 public function skill_db($id_pegawai,$data) {
   	$sql="SELECT k.*,pr2.reff as tingkat
   	    	FROM pegawai_skill k
   	    	LEFT JOIN pegawai_reff pr2 ON k.tingkat=pr2.replid AND pr2.type=6
   			WHERE pegawai_id='".$id_pegawai."'";
   	$data['skill']=$this->dbx->data($sql);
   	return $data;
   }
 public function prestasi_db($id_pegawai,$data) {
   	$sql="SELECT k.*,pr2.reff as tingkat
   	    	FROM pegawai_prestasi k
   	    	LEFT JOIN pegawai_reff pr2 ON k.tingkat=pr2.replid AND pr2.type=8
   			WHERE pegawai_id='".$id_pegawai."' ORDER BY tahun ASC";
   	$data['prestasi']=$this->dbx->data($sql);
   	return $data;
   }
 public function organisasi_db($id_pegawai,$data) {
   	$sql="SELECT k.*
   	    	FROM pegawai_organisasi k
   			WHERE pegawai_id='".$id_pegawai."' ORDER BY tgl_keluar ASC";
   	$data['organisasi']=$this->dbx->data($sql);
   	return $data;
   }
   public function kerja_db($id_pegawai,$data) {
     	$sql="SELECT k.*
     	    	FROM pegawai_kerja k
     			WHERE pegawai_id='".$id_pegawai."' ORDER BY tgl_keluar ASC";
     	$data['kerja']=$this->dbx->data($sql);
     	return $data;
     }
}

?>
