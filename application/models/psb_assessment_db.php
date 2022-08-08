<?php

Class psb_assessment_db extends CI_Model {
	public function __construct() {
		parent::__construct();
		$this->load->library('dbx');
	}

    // Read data from database to show data in admin page
    public function data($report="") {
		$cari="";
			
			
		if($report<>1){
			$cari=" AND c.aktif=1 AND keg.idpegawai='".$this->session->userdata('idpegawai')."' ";
		}

		if ($this->input->post('nama')<>""){
        	$cari=$cari." AND c.nama LIKE '%".$this->input->post('nama')."%'";
      	}

      	if (($this->input->post('periode1')<>"") AND ($this->input->post('periode2')=="")){
			$cari=" AND keg.tgl_mulai >= '".$this->p_c->tgl_db($this->input->post('periode1'))."' ";
		}
		if (($this->input->post('periode1')=="") AND ($this->input->post('periode2')<>"")){
			$cari=" AND keg.tgl_mulai <= '".$this->p_c->tgl_db($this->input->post('periode2'))."' ";
		}
		if (($this->input->post('periode1')<>"") AND ($this->input->post('periode2')<>"")){
			$cari=" AND keg.tgl_mulai BETWEEN '".$this->p_c->tgl_db($this->input->post('periode1'))."' AND '".$this->p_c->tgl_db($this->input->post('periode2'))."' ";
		}

		if (($this->input->post('periode1')=="") AND ($this->input->post('periode2')=="")){
			if ($this->input->post('nama')==""){
				$cari=$cari." AND ta.aktifdaftar=1 ";
			}
		}

		$cari=$cari." AND ok.idunitbisnis='".$this->input->post('idcompany')."'";

			$sql = "SELECT c.*,kcs.kelompok as kelompokcalontext,pps.proses as prosestext,pps.departemen
                          ,t.tingkat as tingkattext, kls.kelas as kelastext,ks.kondisi as kondisitext
                          ,kcs.lamaproses,DATEDIFF(CURRENT_DATE(),c.tanggal_daftar) as lama
													,keg.replid as replidkeg,keg.tgl_mulai, keg.aktif as kegaktif
													,(SELECT COUNT(so.repid) FROM siswa_observasi so WHERE so.replidkeg=keg.replid) as observasijml
													,keg.idpegawai
                      FROM calonsiswa c
											INNER JOIN online_kronologis ok ON ok.idcalon=c.replid
											INNER JOIN tahunajaran ta ON c.idtahunajaran = ta.replid
                			LEFT JOIN  prosespenerimaansiswa pps ON c.idproses = pps.replid
                			LEFT JOIN  kelompokcalonsiswa kcs ON kcs.idproses = pps.replid AND c.idkelompok = kcs.replid
                			LEFT JOIN  tingkat t ON c.tingkat=t.replid
                			LEFT JOIN  kondisisiswa ks ON ks.replid=c.kondisi
                			LEFT JOIN  kelas kls ON c.calon_kelas = kls.replid
                      INNER JOIN kegiatan keg ON keg.siswa_id=c.replid
                      WHERE keg.keg_id='10'
									".$cari."
									ORDER BY keg.aktif DESC,keg.tgl_mulai ASC, c.nama ASC";
				//echo $sql;die;
				$data['show_table']=$this->dbx->data($sql);
        //die;
		$companyrow=$this->session->userdata('idcompany');
		$sqlcompany="SELECT replid,nama as nama
								FROM hrm_company
								WHERE replid IN (".$companyrow.") AND aktif=1
								ORDER BY nama";
		$data['idcompany_opt'] = $this->dbx->opt($sqlcompany,'up');
				return $data;
		}

     //TAMBAH
    public function tambah_db($tipedata,$data,$idcalon,$replidkeg) {
				$sql="SELECT * FROM kegiatan WHERE replid='".$replidkeg."'";
				$data["rowkegiatan"]=$this->dbx->rows($sql);

        $sqlform ="SELECT of.judul,reference_form,so.description
        		FROM observasi_form of
        		LEFT JOIN  siswa_observasi so ON so.observasi_id=of.reference_form
        		WHERE
								of.replid='".$tipedata."'
								AND so.siswa_id='".$idcalon."' AND so.replidkeg='".$replidkeg."'
						";
				//echo $sqlform;die;
				$data["rowform"]=$this->dbx->rows($sqlform);

        //$form=$data["rowform"]->judul;
				//echo var_dump($data["rowform"]);
        $rd=" AND k.referencedata IS NULL ";
				if($data["rowform"]<>NULL){
					if ($data["rowform"]->description<>""){
						$rd=" AND k.referencedata='".$data["rowform"]->description."' ";
					}
				}
				//echo $rd;die;

        $sql="SELECT *
									,(select description from siswa_observasi where k.replid=observasi_id and replidkeg='".$replidkeg."' ORDER BY created_date DESC limit 1) as description
							FROM observasi k WHERE k.aktif=1
										AND k.tipe_data='".$tipedata."' ".$rd." ORDER BY k.urutan";
				//echo $sql;die;
        $data['observasi'] = $this->dbx->data($sql);
				$tipeform5=0;
				foreach((array)$data['observasi'] as $rowkons) {
					if($rowkons->tipe_form==5){$tipeform5=1;}
				}

				if($data['view']=="view"){
						$data['observasi5']=NULL;
						$data['observasidata5']=NULL;
						if($tipeform5){
							$sql5="SELECT *
												,(select description from siswa_observasi where k.replid=observasi_id and replidkeg='".$replidkeg."' ORDER BY created_date DESC limit 1) as description
										FROM observasi k WHERE k.aktif=1
												AND k.tipe_data='".$tipedata."' AND tipe_form='5' ".$rd." ORDER BY k.urutan";
							//echo $sql5;die;
							$data['observasi5'] = $this->dbx->data($sql5);

							if($data['observasi5'][0]->data_combo<>""){
									$sqlobsdata="SELECT * FROM observasi_data WHERE data_combo='".$data['observasi5'][0]->data_combo."' AND aktif=1 ORDER BY data";
									$data['observasidata5'] = $this->dbx->data($sqlobsdata);
							}
						}
				}

				return $data;
  }
}

?>
