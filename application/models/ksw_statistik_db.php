<?php

Class ksw_statistik_db extends CI_Model {
	public function __construct() {
		parent::__construct();
		$this->load->library('dbx');
	}

    // Read data from database to show data in admin page
    public function data() {
			$cari="";
			$join="";$groupby="";$orderby="";$select="";
		
			//----------------------------------------------------------------------------------------------
		if($this->input->post('idfiltercari')=="s.kota"){
			$select="kt.kota as filtercari,kt.replid as idfilter";
			$join= " LEFT JOIN kota kt ON kt.replid=s.kota ";
			$groupby.= "GROUP BY s.kota ";
			$orderby="ORDER BY kt.kota";
				}else if($this->input->post('idfiltercari')=="s.propinsi"){
				$select="pv.propinsi as filtercari,pv.replid as idfilter";
				$join= " LEFT JOIN propinsi pv ON pv.replid=s.provinsi ";
				$groupby.= "GROUP BY s.provinsi ";
				$orderby="ORDER BY pv.propinsi";
				}else if($this->input->post('idfiltercari')=="s.agama"){
			$select="ag.agama as filtercari,ag.replid as idfilter";
			$join= " LEFT JOIN agama ag ON ag.replid=s.agama ";
			$groupby.= "GROUP BY s.agama ";
			$orderby="ORDER BY ag.agama";
      	}else if($this->input->post('idfiltercari')=="s.kelamin"){
          $select=" CASE WHEN s.kelamin='l' THEN 'Laki-Laki' WHEN s.kelamin='p' THEN 'Perempuan' END as filtercari,s.kelamin as idfilter";
          $join= " ";
          $groupby.= "GROUP BY s.kelamin ";
          $orderby="ORDER BY s.kelamin";
		}else if($this->input->post('idfiltercari')=="s.pekerjaanayah"){
				$select="jp.pekerjaan as filtercari,jp.replid as idfilter";
				$join= " LEFT JOIN jenispekerjaan jp ON jp.replid=s.pekerjaanayah ";
				$groupby.= "GROUP BY s.pekerjaanayah ";
				$orderby="ORDER BY jp.pekerjaan";
		}else if($this->input->post('idfiltercari')=="s.pekerjaanibu"){
				$select="jp.pekerjaan as filtercari,jp.replid as idfilter";
				$join= " LEFT JOIN jenispekerjaan jp ON jp.replid=s.pekerjaanibu ";
				$groupby.= "GROUP BY s.pekerjaanibu ";
				$orderby="ORDER BY jp.pekerjaan";
		}else if($this->input->post('idfiltercari')=="s.pekerjaanwali"){
				$select="jp.pekerjaan as filtercari,jp.replid as idfilter";
				$join= " LEFT JOIN jenispekerjaan jp ON jp.replid=s.pekerjaanwali ";
				$groupby.= "GROUP BY s.pekerjaanwali ";
				$orderby="ORDER BY jp.pekerjaan";
		}else if($this->input->post('idfiltercari')=="s.penghasilanayah"){
				$select="jp.penghasilan as filtercari,jp.replid as idfilter";
				$join= " LEFT JOIN penghasilan jp ON jp.replid=s.penghasilanayah ";
				$groupby.= "GROUP BY s.penghasilanayah ";
				$orderby="ORDER BY jp.penghasilan";
		}else if($this->input->post('idfiltercari')=="s.penghasilanibu"){
				$select="jp.penghasilan as filtercari,jp.replid as idfilter";
				$join= " LEFT JOIN penghasilan jp ON jp.replid=s.penghasilanibu ";
				$groupby.= "GROUP BY s.penghasilanibu ";
				$orderby="ORDER BY jp.penghasilan";
		}else if($this->input->post('idfiltercari')=="s.penghasilanwali"){
				$select="jp.penghasilan as filtercari,jp.replid as idfilter";
				$join= " LEFT JOIN penghasilan jp ON jp.replid=s.penghasilanwali ";
				$groupby.= "GROUP BY s.penghasilanwali ";
				$orderby="ORDER BY jp.penghasilan";
		}else if($this->input->post('idfiltercari')=="s.asalsekolah"){
			$select="s.asalsekolah as filtercari,s.asalsekolah as idfilter";
			$groupby.= "GROUP BY s.asalsekolah ";
			$orderby="ORDER BY s.asalsekolah";
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
				$orderby.=",k.kelompok_siswa";
			}

			switch ($this->input->post('statussiswa')) {
				case '2':
						$cari=$cari." AND s.aktif='0' ";
					break;
				case '3':
					$cari=$cari;
				break;
				default:
						$cari=$cari." AND s.aktif='1' ";
					break;
			}

				//,j.jurusan AS jurusantext
				$sql = "SELECT
                  ".$select."
                	,COUNT(s.replid) as jumlah
              FROM siswa s
              INNER JOIN kelas k ON k.replid=s.idkelas
              INNER JOIN tahunajaran t ON k.idtahunajaran = t.replid
              INNER JOIN tingkat tkt ON tkt.replid = k.idtingkat
              INNER JOIN kelompoksiswa ks ON ks.replid = k.kelompok_siswa
              LEFT JOIN jurusan j ON j.replid = k.jurusan
              ".$join."
              WHERE
              	s.replid IS NOT NULL
                ".$cari.$groupby.$orderby;
				//echo $sql;die;
				if($this->input->post('idfiltercari')<>""){
					$data['show_table']=$this->dbx->data($sql);
				}else{
					$data['show_table']=NULL;
				}

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
			$data['statussiswa_opt'] =array('1'=>'Aktif','2'=>'Tidak Aktif','3'=>'Semuanya');
			$data['idfiltercari_opt'] =array(''=>'Pilih..','s.kota'=>'Kota Peserta Didik','s.propinsi'=>'Propinsi Peserta Didik','s.agama'=>'Agama','s.kelamin'=>'Jenis Kelamin','s.pekerjaanayah'=>'Pekerjaan Ayah','s.pekerjaanibu'=>'Pekerjaan Ibu','s.pekerjaanwali'=>'Pekerjaan Wali','s.penghasilanayah'=>'Penghasilan Ayah','s.penghasilanibu'=>'Penghasilan Ibu','s.penghasilanwali'=>'Penghasilan Wali','s.asalsekolah'=>'Asal Sekolah');
      return $data;
    }

	public function view($idcompany,$iddepartemen,$idtahunajaran,$idtingkat,$kelompok_siswa,$statussiswa,$idfiltercari,$idfilter) {
		$cari="";
		$join="";$groupby="";$orderby="";$select="s.*";$data['filtertext']="";
		$idfilter="='".$idfilter."'";
		if ($idfilter<>"000"){
			$idfilter=" IS NULL ";
		}

			//----------------------------------------------------------------------------------------------
		if($idfiltercari=="s.kota"){
			$select.=",kt.kota as filtercari,kt.replid as idfilter";
			$join= " LEFT JOIN kota kt ON kt.replid=s.kota ";
			$groupby.= "GROUP BY s.kota ";
			$orderby="ORDER BY kt.kota";
		 	$data['filtertext']="Kota";
			$cari=$cari." AND kt.replid".$idfilter;
		}else if($idfiltercari=="s.propinsi"){
			$select.=",pv.propinsi as filtercari,pv.replid as idfilter";
			$join= " LEFT JOIN propinsi pv ON pv.replid=s.provinsi ";
			$groupby.= "GROUP BY s.provinsi ";
			$orderby="ORDER BY pv.propinsi";
			$data['filtertext']="Provinsi";
			$cari=$cari." AND pv.replid".$idfilter;
		}else if($idfiltercari=="s.agama"){
          	$select.=",ag.agama as filtercari,ag.replid as idfilter";
          	$join= " LEFT JOIN agama ag ON ag.replid=s.agama ";
          	$orderby="ORDER BY ag.agama";
			$data['filtertext']="Agama";
			$cari=$cari." AND ag.replid".$idfilter;
      	}else if($idfiltercari=="s.kelamin"){
          	$select.=", CASE WHEN s.kelamin='l' THEN 'Laki-Laki' WHEN s.kelamin='p' THEN 'Perempuan' END as filtercari,s.kelamin as idfilter";
          	$join= " ";
          	$orderby="ORDER BY s.kelamin";
			$data['filtertext']="Jenis Kelamin";
			$cari=$cari." AND s.kelamin".$idfilter;
		}else if($idfiltercari=="s.pekerjaanayah"){
					$select.=",jp.pekerjaan as filtercari,jp.replid as idfilter";
					$join= " LEFT JOIN jenispekerjaan jp ON jp.replid=s.pekerjaanayah ";
					$orderby="ORDER BY jp.pekerjaan";
					$data['filtertext']="Pekerjaan Ayah";
					$cari=$cari." AND jp.replid".$idfilter;
		}else if($idfiltercari=="s.pekerjaanibu"){
					$select.=",jp.pekerjaan as filtercari,jp.replid as idfilter";
					$join= " LEFT JOIN jenispekerjaan jp ON jp.replid=s.pekerjaanibu ";
					$orderby="ORDER BY jp.pekerjaan";
					$data['filtertext']="Pekerjaan Ibu";
					$cari=$cari." AND jp.replid".$idfilter;
		}else if($idfiltercari=="s.pekerjaanwali"){
					$select.=",jp.pekerjaan as filtercari,jp.replid as idfilter";
					$join= " LEFT JOIN jenispekerjaan jp ON jp.replid=s.pekerjaanwali ";
					$orderby="ORDER BY jp.pekerjaan";
					$data['filtertext']="Pekerjaan Wali";
					$cari=$cari." AND jp.replid".$idfilter;
		}else if($idfiltercari=="s.penghasilanayah"){
				$select.=",jp.penghasilan as filtercari,jp.replid as idfilter";
				$join= " LEFT JOIN penghasilan jp ON jp.replid=s.penghasilanayah ";
				$orderby="ORDER BY jp.penghasilan";
				$data['filtertext']="Penghasilan Ayah";
				$cari=$cari." AND jp.replid".$idfilter;
		}else if($idfiltercari=="s.penghasilanibu"){
				$select.=",jp.penghasilan as filtercari,jp.replid as idfilter";
				$join= " LEFT JOIN penghasilan jp ON jp.replid=s.penghasilanibu ";
				$orderby="ORDER BY jp.penghasilan";
				$data['filtertext']="Penghasilan Ibu";
				$cari=$cari." AND jp.replid".$idfilter;
		}else if($idfiltercari=="s.penghasilanwali"){
				$select.=",jp.penghasilan as filtercari,jp.replid as idfilter";
				$join= " LEFT JOIN penghasilan jp ON jp.replid=s.penghasilanwali ";
				$orderby="ORDER BY jp.penghasilan";
				$data['filtertext']="Penghasilan Wali";
				$cari=$cari." AND jp.replid".$idfilter;
		}else if($this->input->post('idfiltercari')=="s.asalsekolah"){
			$select="s.asalsekolah as filtercari,s.asalsekolah as idfilter";
			$orderby="ORDER BY s.asalsekolah";
			$data['filtertext']="Asal Sekolah";
			$cari=$cari." AND s.asalsekolah".$idfilter;
      }else{
        $cari=" AND s.nama='f4ad65f4sda6f4a'";
      }
			//----------------------------------------------------------------------------------------------

			if ($idcompany<>"000"){
				$cari=$cari." AND t.idcompany='".$idcompany."' ";
			}

			if ($iddepartemen<>"000"){
				$select.=",t.departemen";
				$cari=$cari." AND t.departemen='".$iddepartemen."' ";
				$orderby.=",t.departemen ASC ";
			}

			if ($idtahunajaran<>"000"){
				$select.=",t.tahunajaran";
				$cari=$cari." AND t.replid='".$idtahunajaran."' ";
				$orderby.=",t.tahunajaran DESC";
			}

			if ($idtingkat<>"000"){
				$select.=",tkt.tingkat as tingkattext";
				$cari=$cari." AND tkt.replid='".$idtingkat."' ";
				$orderby.=",CAST(tkt.tingkat AS SIGNED) ASC";
			}

			if ($kelompok_siswa<>"000"){
				$select.=",ks.kelompok AS kelompok_siswatext";
				$cari=$cari." AND k.kelompok_siswa='".$kelompok_siswa."' ";
				$orderby.=",k.kelompok_siswa";
			}

			switch ($this->input->post('statussiswa')) {
				case '2':
						$cari=$cari." AND s.aktif='0' ";
					break;
				case '3':
					$cari=$cari;
				break;
				default:
						$cari=$cari." AND s.aktif='1' ";
					break;
			}
				//,j.jurusan AS jurusantext
				$sql = "SELECT
                  ".$select."

              FROM siswa s
              INNER JOIN kelas k ON k.replid=s.idkelas
              INNER JOIN tahunajaran t ON k.idtahunajaran = t.replid
              INNER JOIN tingkat tkt ON tkt.replid = k.idtingkat
              INNER JOIN kelompoksiswa ks ON ks.replid = k.kelompok_siswa
              LEFT JOIN jurusan j ON j.replid = k.jurusan
              ".$join."
              WHERE
              	s.replid IS NOT NULL
                ".$cari.$groupby.$orderby;
				//echo $sql;die;
				if($idfiltercari<>""){
					$data['datasiswa']=$this->dbx->data($sql);
				}else{
					$data['datasiswa']=NULL;
				}

			return $data;
    }
}

?>
