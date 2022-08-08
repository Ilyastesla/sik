<?php

Class psb_kronologis_db extends CI_Model {
	public function __construct() {
		parent::__construct();
		$this->load->library('dbx');
	}

    // Read data from database to show data in admin page
    public function data() {
			$cari="";
			//	echo $this->session->flashdata('idproses');die;
      if (($this->session->userdata('periode1')<>"") AND ($this->session->userdata('periode2')=="")){
        $cari=$cari." AND sk.tgl_masuk >= '".$this->p_c->tgl_db($this->session->userdata('periode1'))."' ";
      }
      if (($this->session->userdata('periode1')=="") AND ($this->session->userdata('periode2')<>"")){
        $cari=$cari." AND sk.tgl_masuk <= '".$this->p_c->tgl_db($this->session->userdata('periode2'))."' ";
      }
      if (($this->session->userdata('periode1')<>"") AND ($this->session->userdata('periode2')<>"")){
        $cari=$cari." AND sk.tgl_masuk BETWEEN '".$this->p_c->tgl_db($this->session->userdata('periode1'))."' AND '".$this->p_c->tgl_db($this->session->userdata('periode2'))."' ";
      }
      if($cari==""){
        $cari=$cari." AND YEAR(sk.tgl_masuk)=YEAR(CURRENT_DATE())";
      }

      if ($this->input->post('iddepartemen')<>""){
        $cari=$cari." AND pps.departemen='".$this->input->post('iddepartemen')."' ";
      }

      if ($this->input->post('idproses')<>""){
        $cari=$cari." AND ks.idproses='".$this->input->post('idproses')."' ";
      }

      if ($this->input->post('idkelompok')<>""){
        $cari=$cari." AND ks.idkelompok='".$this->input->post('idkelompok')."' ";
      }

      	$sql = "SELECT sk.*,p.nama as petugas
      					FROM siswa_kronologis sk
      					LEFT JOIN calonsiswa cs ON cs.nopendaftaran=sk.no_psb
      					LEFT JOIN pegawai p ON sk.add_by=p.nip
      					WHERE sk.add_by=p.nip
									".$cari."
								ORDER BY sk.nama ";
				//echo $sql;die;
				$data['show_table']=$this->dbx->data($sql);
				$data['iddepartemen_opt'] = $this->dbx->opt("SELECT departemen as replid,departemen as nama FROM departemen WHERE aktif=1 AND replid IN (".$this->session->userdata('dept').") ORDER BY urutan",'up');
        $data['tahunmasuk_opt'] = $this->dbx->opt("SELECT DISTINCT tahunmasuk as replid, tahunmasuk as nama FROM calonsiswa ORDER BY tahunmasuk DESC",'up');
				$data['idproses_opt'] = $this->dbx->opt("SELECT replid,proses as nama FROM prosespenerimaansiswa WHERE departemen='".$this->input->post('iddepartemen')."' ORDER BY proses",'up');
        $data['idkelompok_opt'] = $this->dbx->opt("SELECT replid,kelompok as nama FROM kelompokcalonsiswa WHERE aktif=1 AND idproses='".$this->input->post('idproses')."' ORDER BY kelompok",'up');

				return $data;
		}

     //TAMBAH
    public function tambah_db($id='',$data) {
    	$data['id']=$id;
      	$sql="SELECT sk.*,sk.jenjang as departemen
					,YEAR(tgl_masuk) as tahunmasuk
      			FROM siswa_kronologis sk
      			WHERE sk.replid='".$id."'";
        $data['isi'] = $this->dbx->rows($sql);

        if ($data['isi']== NULL ) {
        	unset($data['isi']);
        	$sql="SELECT ".$this->dbx->tablecolumn('siswa_kronologis').",CURRENT_DATE as tgl_masuk,NULL as departemen,1 as aktif,YEAR(CURRENT_DATE()) as tahunmasuk";
        	$data['isi']=$this->dbx->rows($sql);
        }
				//echo $data['isi']->departemen;die;
		$data['ortu_opt'] = array(""=>"Pilih...","2"=>"Ibu","1"=>"Ayah","3"=>"Wali");
        $data['jenjang_opt'] = $this->dbx->opt("SELECT departemen as replid, departemen as nama FROM departemen WHERE aktif=1 AND replid IN (".$this->session->userdata('dept').") ORDER BY urutan",'up');
		$data['idproses_opt'] = $this->dbx->opt("SELECT replid,CONCAT('[',departemen,'] ',proses)  as nama FROM prosespenerimaansiswa WHERE departemen='".$data['isi']->jenjang."' ORDER BY info1",'up');
		$data['idkelompok_opt'] = $this->dbx->opt("SELECT replid,kelompok as nama FROM kelompokcalonsiswa WHERE aktif=1 AND idproses='".$data['isi']->idproses."' ORDER BY kelompok",'up');
		$data['tingkat_opt'] = $this->dbx->opt("SELECT replid,tingkat as nama  FROM tingkat WHERE aktif=1 AND departemen='".$data['isi']->departemen."' ORDER BY CAST(tingkat AS SIGNED)",'up');
		$data['region_opt'] = $this->dbx->opt("SELECT replid,region as nama FROM regional ORDER BY region",'up');
		$data['kondisi_opt'] = $this->dbx->opt("SELECT replid,kondisi as nama FROM kondisisiswa ORDER BY kondisi",'up');
		$data['jenjang_asal_opt'] = array(""=>"Pilih...","TK"=>"TK","SD"=>"SD","SMP"=>"SMP","SMA"=>"SMA");
		$data['jurusan_asal_opt'] = $this->dbx->opt("SELECT replid,jurusan as nama FROM jurusan_asal ORDER BY jurusan",'up');
		$data['tingkat_asal_opt'] = $this->dbx->opt("SELECT replid,tingkat as nama  FROM tingkat WHERE aktif=1 AND departemen='".$data['isi']->jenjang_asal."' ORDER BY CAST(tingkat AS SIGNED)",'up');

		$data['jurusan_opt'] = $this->dbx->opt("SELECT replid,jurusan as nama FROM jurusan ORDER BY jurusan",'up');
		$data['tahunajaran_opt'] = $this->dbx->opt("SELECT replid,tahunajaran as nama FROM tahunajaran WHERE idcompany='".$this->session->userdata('idcompany')."' AND departemen='".$data['isi']->departemen."' ORDER BY tahunajaran",'up');


		$data['type_negara_opt'] = $this->dbx->opt("SELECT replid,negara as nama FROM negara",'up');
		$data['type_propinsi_opt'] = $this->dbx->opt("SELECT replid,propinsi as nama FROM propinsi",'up');
		$data['type_kota_opt'] = $this->dbx->opt("SELECT replid,kota as nama FROM kota WHERE  aktif=1 ORDER BY kota",'up');
		$data['type_kecamatan_opt'] = $this->dbx->opt("SELECT replid,kecamatan as nama FROM kecamatan",'up');

		$data['media_opt']=$this->dbx->data("SELECT replid,reff_kronologis_sub as nama FROM calonsiswa_kronologis_reff WHERE head='Media'ORDER BY reff_kronologis,no_urut");
        return $data;
  }

	public function view_db($replid,$data) {
		$sql = "SELECT c.*
										FROM calonsiswa c
								WHERE c.replid='".$replid."'
								ORDER BY c.nama ";
			$data['isi'] = $this->dbx->rows($sql);

			$sql="SELECT csr.*,kcs.kelompok as kelompokcalontext,pps.proses as prosestext,pps.departemen as departementext
												,t.tingkat as tingkattext,ks.kondisi as kondisitext
												,r.region as regiontext
					FROM calonsiswariwayat csr
					LEFT JOIN prosespenerimaansiswa pps ON csr.idproses = pps.replid
					LEFT JOIN siswa_kronologis kcs ON kcs.idproses = pps.replid AND csr.idkelompok = kcs.replid
					LEFT JOIN tingkat t ON csr.tingkat=t.replid
					LEFT JOIN kondisisiswa ks ON ks.replid=csr.kondisi
					LEFT JOIN regional r ON r.replid=csr.region
					WHERE csr.idcalonsiswa='".$replid."'
					ORDER BY csr.modified_date DESC
					";
			//echo $sql;die;
			$data['calonhistory'] = $this->dbx->data($sql);

			return $data;
	}
}

?>
