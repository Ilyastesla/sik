<?php

Class ksw_statistik_calon_db extends CI_Model {
	public function __construct() {
		parent::__construct();
		$this->load->library('dbx');
	}

    // Read data from database to show data in admin page
    public function data() {
			$cari="";
			$join="";$groupby="";$orderby="";$select="*";

			//----------------------------------------------------------------------------------------------
      if($this->input->post('idfiltercari')=="voting"){
          $select="rks.reff_kronologis_sub as filtercari";
          $join= " LEFT JOIN online_kronologis_reff rks ON rks.replid=ok.voting ";
          $groupby.= "GROUP BY ok.voting ";
          $orderby="ORDER BY filtercari";
      }else if($this->input->post('idfiltercari')=="alasan"){
          $select="rks.reff_kronologis_sub as filtercari";
          $join= "  INNER JOIN online_kronologis_alasan oka ON oka.idkronologis=ok.replid
                    LEFT JOIN online_kronologis_reff rks ON rks.replid=oka.idalasan ";
          $groupby.= "GROUP BY rks.replid ";
          $orderby="ORDER BY filtercari";
      }else if($this->input->post('idfiltercari')=="media"){
        $select="rks.reff_kronologis_sub as filtercari";
        $join= "  INNER JOIN online_kronologis_media okm ON okm.idkronologis=ok.replid
                  LEFT JOIN online_kronologis_reff rks ON rks.replid=okm.idmedia ";
        $groupby.= "GROUP BY rks.replid ";
        $orderby="ORDER BY filtercari";
      }else{
        $cari=" AND s.nama='f4ad65f4sda6f4a'";
      }
			//----------------------------------------------------------------------------------------------

			if ($this->input->post('idcompany')<>""){
				$cari=$cari." AND t.idcompany='".$this->input->post('idcompany')."' ";
			}

			if ($this->input->post('iddepartemen')<>""){
				$select.=",t.departemen";
				$cari=$cari." AND t.departemen='".$this->input->post('iddepartemen')."' ";
				$groupby.= " ,t.departemen ";
				$orderby.=",t.departemen ASC ";
			}

			if ($this->input->post('idtahunajaran')<>""){
				$select.=",t.tahunajaran";
				$cari=$cari." AND t.replid='".$this->input->post('idtahunajaran')."' ";
				$groupby.= " ,t.replid ";
				$orderby.=",t.tahunajaran DESC";
			}

			if ($this->input->post('idtingkat')<>""){
				$select.=",tkt.tingkat as tingkattext";
				$cari=$cari." AND tkt.replid='".$this->input->post('idtingkat')."' ";
				$groupby.= " ,tkt.replid ";
				$orderby.=",CAST(tkt.tingkat AS SIGNED) ASC";
			}

			if ($this->input->post('kelompok_siswa')<>""){
				$select.=",ks.kelompok AS kelompok_siswatext";
				$cari=$cari." AND k.kelompok_siswa='".$this->input->post('kelompok_siswa')."' ";
				$groupby.= " ,k.kelompok_siswa ";
				$orderby.=",";
			}
				//,j.jurusan AS jurusantext
				$sql = "SELECT
                  ".$select."
                	,COUNT(ok.replid) as jumlah
              FROM online_kronologis ok
              INNER JOIN tahunajaran t ON t.replid=ok.idtahunajaran
              INNER JOIN tingkat tkt ON tkt.replid = ok.idtingkat
              INNER JOIN kelompoksiswa ks ON ks.replid = ok.idkelompok
              ".$join."
              WHERE
              	ok.replid IS NOT NULL
                ".$cari.$groupby.$orderby;
				//echo $sql;die;
				if($this->input->post('idfiltercari')<>""){
					$data['show_table']=$this->dbx->data($sql);
				}else{
					$data['show_table']=NULL;
				}

			//die;
			$companyrow=$this->session->userdata('idcompany');
			$sqlcompany="SELECT replid,nama as nama
									FROM hrm_company
									WHERE replid IN (".$companyrow.") AND aktif=1
									ORDER BY nama";
			$data['idcompany_opt'] = $this->dbx->opt($sqlcompany,'up');
			$data['iddepartemen_opt'] = $this->dbx->opt("SELECT departemen as replid,departemen as nama FROM departemen WHERE aktif=1 AND replid IN (".$this->session->userdata('dept').") ORDER BY urutan",'up');
			$data['idtahunajaran_opt'] = $this->dbx->opt("SELECT replid,CONCAT('[',departemen,'] ',tahunajaran) as nama FROM tahunajaran WHERE idcompany='".$this->input->post('idcompany')."' AND departemen='".$this->input->post('iddepartemen')."' ORDER BY aktif DESC ,nama DESC ",'up');
			$data['idtingkat_opt'] = $this->dbx->opt("SELECT replid,tingkat as nama FROM tingkat
																								WHERE aktif=1 AND departemen='".$this->input->post('iddepartemen')."' ORDER BY CAST(tingkat AS SIGNED) ASC",'up');
			$data['kelompok_siswa_opt'] = $this->dbx->opt("SELECT replid,CONCAT('[',departemen,'] ',kelompok) as nama FROM kelompoksiswa ks WHERE ks.departemen='".$this->input->post('iddepartemen')."' AND ks.aktif=1 ORDER BY ks.departemen,ks.kelompok",'up');
      $data['idfiltercari_opt'] =array(''=>'Pilih..','voting'=>'Kualitas PPDB','alasan'=>'Alasan','media'=>'Media');
      return $data;
    }
}

?>
