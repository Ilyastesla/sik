<?php

Class pegawai_db extends CI_Model {
	public function __construct() {
	parent::__construct();
		$this->load->library('dbx');
	}

    // Read data from database to show data in admin page
    public function data() {
	    //,DATE_FORMAT(FROM_DAYS(DATEDIFF(CURRENT_DATE,mulaikerja)),'%y thn %c bln %e hr') AS lama
				$cari="";
				/*
				if($this->input->post('idcompany')=="11"){
						$cari .= " AND LEFT(p.nip,2) IN (11,22,77)";
				}else if($this->input->post('idcompany')=="12"){
						$cari .= " AND LEFT(p.nip,2) IN (12,23)";
				}else{
					$cari .= " AND LEFT(p.nip,2)='".$this->input->post('idcompany')."' ";
				}
				*/
				$cari .= " AND p.idcompany='".$this->input->post('idcompany')."' ";
				switch ($this->input->post('aktif')) {
					case '1':
						$cari .= " AND p.aktif='1' ";
						break;
					case '2':
						$cari .= " AND p.aktif='0' ";
						break;
					default:
					$cari .= " ";
						break;
				}
				
      	$sql = "SELECT DISTINCT p.*
      			,(TIMESTAMPDIFF(YEAR, p.tgllahir, CURDATE())) as umur
      			,DATEDIFF(kk.akhir_kontrak,CURRENT_DATE()) AS sisakontrak
      			,kk.awal_kontrak,kk.akhir_kontrak
      			,c.nama as companytext,d.departemen as iddepartemen,sp.nama as idpegawai_status
      			,j.jabatan as idjabatan,kk.aktif,jg.jabatan_grup
      			,log.aktif as loginaktif,log.replid as replidlogin
      			FROM pegawai p
      			LEFT JOIN hrm_pegawai_jabatan kk ON kk.idpegawai=p.replid AND kk.aktif=1
      			LEFT JOIN hrm_company c ON kk.idcompany=c.replid
      			LEFT JOIN hrm_jabatan j ON j.replid=kk.idjabatan
      			LEFT JOIN hrm_jabatan_grup jg ON j.idjabatan_grup=jg.replid
      			LEFT JOIN hrm_departemen d ON j.iddepartemen=d.replid
      			LEFT JOIN hrm_reff sp ON sp.replid=kk.idpegawai_status
      			LEFT JOIN login log ON log.login=p.nip
      			WHERE nip<>'sa' ".$cari."
      			ORDER BY nama
      			";

			$sql="SELECT p.*
      			,(TIMESTAMPDIFF(YEAR, p.tgllahir, CURDATE())) as umur
						,(SELECT MAX(akhir_kontrak) FROM hrm_pegawai_jabatan kk WHERE kk.idpegawai=p.replid AND kk.aktif=1) as akhir_kontrak
						,(SELECT MAX(DATEDIFF(akhir_kontrak,CURRENT_DATE())) FROM hrm_pegawai_jabatan kk WHERE kk.idpegawai=p.replid AND kk.aktif=1) as sisakontrak
      			,log.aktif as loginaktif,log.replid as replidlogin,c.nama as companytext
      			FROM pegawai p
      			LEFT JOIN login log ON log.login=p.nip
				LEFT JOIN hrm_company c ON p.idcompany=c.replid
      			WHERE nip<>'sa' ".$cari."
      			ORDER BY nama";
			  //echo $sql;
				$data['show_table']=$this->dbx->data($sql);

				$companyrow=$this->session->userdata('idcompany');
				//$sqlcompany="SELECT kodecabang as replid,nama as nama FROM hrm_company WHERE replid IN (".$companyrow.") AND aktif=1 ORDER BY nama";
				$sqlcompany="SELECT replid,nama as nama FROM hrm_company WHERE replid IN (".$companyrow.") AND aktif=1 ORDER BY nama";
				$data['idcompany_opt'] = $this->dbx->opt($sqlcompany,'up');
				$data['aktif_opt'] =array('1'=>'Aktif','2'=>'Tidak Aktif','3'=>'Semuanya');
				return $data;
    }

    public function view($id,$data) {
    	$data['stat']="Data";
    	$data['form']='Pegawai';
    	$data['id']=$id;
      	$sql="SELECT p.*,(TIMESTAMPDIFF(YEAR, tgllahir, CURDATE())) as umur,a.agama,n.negara as warganegara
      			,n2.negara as negara,n3.negara as negara2
      			,pr.reff as status_nikah
      			,jp.pekerjaan as pekerjaan_ibu,jp2.pekerjaan as pekerjaan_ayah
      			,pr2.reff as kode_pajak
      			,pr3.reff as ukuran_baju
						,l.aktif as aktiflogin,l.role_id
      			FROM pegawai p
      			LEFT JOIN agama a ON p.agama=a.replid
      			LEFT JOIN negara n ON p.warganegara=n.replid
      			LEFT JOIN negara n2 ON p.negara=n2.replid
      			LEFT JOIN negara n3 ON p.negara2=n3.replid
      			LEFT JOIN pegawai_reff pr ON pr.replid=p.status_nikah AND pr.type=3
      			LEFT JOIN jenispekerjaan jp ON jp.replid=p.pekerjaan_ibu
      			LEFT JOIN jenispekerjaan jp2 ON jp2.replid=p.pekerjaan_ayah
      			LEFT JOIN pegawai_reff pr2 ON pr2.replid=p.kode_pajak AND pr2.type=4
      			LEFT JOIN pegawai_reff pr3 ON pr3.replid=p.ukuran_baju AND pr3.type=5
						LEFT JOIN login l ON l.login=p.nip
      			WHERE p.replid='".$id."'";
        $data['header'] = $this->dbx->rows($sql);
       // $data['type_negara_opt'] = $this->dbx->opt("select replid,negara as nama from negara");
        //$data['type_agama_opt'] = $this->dbx->opt("select replid,agama as nama from agama");
        return $data;
    }

    public function tambah_x($id='',$data) {
    	$data['stat']="Data";
    	$data['form']='Pegawai';
    	$data['id']=$id;
      	$sql="SELECT *
      			FROM pegawai p
      			WHERE p.replid='".$id."'";
        $data['header'] = $this->dbx->rows($sql);
        if ($data['header']== NULL ) {
        	unset($data['header']);
					$sql="SELECT ".$this->dbx->tablecolumn('pegawai');
        	$data['header']=$this->dbx->rows($sql);
        }
        $data['type_negara_opt'] = $this->dbx->opt("select replid,negara as nama from negara  ORDER BY negara",'up');
        $data['type_agama_opt'] = $this->dbx->opt("select replid,agama as nama from agama WHERE aktif=1 ORDER BY agama",'up');
        $data['status_nikah_opt'] = $this->dbx->opt("select replid,reff as nama from pegawai_reff where type=3 AND aktif=1 ORDER BY reff",'up');
        $data['type_pekerjaan_opt'] = $this->dbx->opt("select replid,pekerjaan as nama from jenispekerjaan ORDER BY pekerjaan",'up');
        $data['kode_pajak_opt'] = $this->dbx->opt("select replid,reff as nama from pegawai_reff where type=4 AND aktif=1 ORDER BY reff",'up');
        $data['ukuran_baju_opt'] = $this->dbx->opt("select replid,reff as nama from pegawai_reff where type=5 AND aktif=1 ORDER BY reff",'up');
        $data['informasi_lamaran_opt'] =  $this->dbx->data("select replid,reff as nama from pegawai_reff where type=6  AND aktif=1 ORDER BY reff",'up');
        $data['ingin_posisi_opt']=$this->dbx->opt("select replid,jabatan as nama from hrm_jabatan WHERE aktif=1 ORDER BY jabatan",'up');
		
		$companyrow=$this->session->userdata('idcompany');
		$sqlcompany="SELECT replid,nama as nama FROM hrm_company WHERE replid IN (".$companyrow.") AND aktif=1 ORDER BY nama";
		$data['idcompany_opt'] = $this->dbx->opt($sqlcompany,'up');
        return $data;
    }
    public function tambah($data) {
    	$this->db->trans_start();
        $this->db->insert('pegawai', $data);
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
	  $this->db->where('replid',$id);
	  $this->db->update('pegawai', $data);
	  if ($this->db->_error_number() == 0) {
		  return true;
	  } else {
		  return false;
      }
    }
    public function diactivelogin($data,$nip) {
	  $this->db->where('login',$nip);
	  $this->db->update('login', $data);
	  if ($this->db->_error_number() == 0) {
		  return true;
	  } else {
		  return false;
      }
    }

  //---------------------------------------------------------------------------------------------------------
	//------------------------------------------------------------------------------------------ PERBANKAN
	//---------------------------------------------------------------------------------------------------------
	public function perbankan_db($id_pegawai,$data) {
    	$sql="SELECT pp.*,pr.reff as type FROM pegawai_perbankan pp
    			LEFT JOIN pegawai_reff pr ON pr.replid=pp.type AND pr.type=2
    			WHERE pegawai_id='".$id_pegawai."'";
    	$data['perbankan']=$this->dbx->data($sql);
    	return $data;
    }
    public function tambah_perbankan($pegawai_id,$id='',$data) {
    	$data['stat']="Data";
    	$data['form']='Pegawai';
    	$data['id']=$id;
    	$sql="SELECT *
      			FROM pegawai_perbankan p
      			WHERE p.replid='".$id."' AND p.pegawai_id='".$pegawai_id."'";
        $data['isi'] = $this->dbx->rows($sql);
        $query=$this->db->query($sql);

        if ($data['isi']== NULL ) {
        	unset($data['isi']);
					$sql="SELECT ".$this->dbx->tablecolumn('pegawai_perbankan');
        	$data['isi']=$this->dbx->rows($sql);
        }
        //echo is_array($data['isi'])."<br/>".$sql;die;

        $data['type_type_opt'] = $this->dbx->opt("select replid,reff as nama from pegawai_reff where type=2 AND aktif=1 ORDER BY reff",'up');
        return $data;
    }
    public function tambah_perbankan_db($data) {
    	$this->db->trans_start();
        $this->db->insert('pegawai_perbankan', $data);
        if ($this->db->affected_rows() > 0) {
               $this->db->trans_complete();
               return true;

        } else {
        	$this->db->trans_complete();
            return false;
        }
     }

     public function ubah_perbankan_db($data,$idx) {
		$this->db->where('replid',$idx);
		$this->db->update('pegawai_perbankan', $data);
		if ($this->db->_error_number() == 0) {
			return true;
		} else {
			return false;
		}
	 }
	 public function hapusperbankan_db($pegawai_id,$idx) {
        // Query to check whether username already exist or not
        $this->db->where('replid',$idx);
        $this->db->delete('pegawai_perbankan');
        if ($this->db->_error_number() == 0) {
        	return true;
        } else {
            return false;
        }
      }

    //---------------------------------------------------------------------------------------------------------
	//------------------------------------------------------------------------------------------ KONTAK DARURAT
	//---------------------------------------------------------------------------------------------------------

	public function kontakdarurat_db($id_pegawai,$data) {
    	$sql="SELECT pkd.*,pr.reff as hubungan,n.negara as negara FROM pegawai_kontak_darurat  pkd
    			LEFT JOIN pegawai_reff pr ON pkd.hubungan=pr.replid
    			LEFT JOIN negara n ON pkd.negara=n.replid
    			WHERE pegawai_id='".$id_pegawai."' AND pr.type=1";
    	$data['kontakdarurat']=$this->dbx->data($sql);
    	return $data;
    }

    public function tambah_kontak_darurat($pegawai_id,$id='',$data) {
    	$data['stat']="Data";
    	$data['form']='Pegawai';
    	$data['id']=$id;
    	$sql="SELECT *
      			FROM pegawai_kontak_darurat p
      			WHERE p.replid='".$id."' AND p.pegawai_id='".$pegawai_id."'";
        $data['isi'] = $this->dbx->rows($sql);
        $query=$this->db->query($sql);

        if ($data['isi']== NULL ) {
        	unset($data['isi']);
					$sql="SELECT ".$this->dbx->tablecolumn('pegawai_kontak_darurat');
        	$data['isi']=$this->dbx->rows($sql);
        }
        //echo is_array($data['isi'])."<br/>".$sql;die;

        $data['type_hubungan_opt'] = $this->dbx->opt("select replid,reff as nama from pegawai_reff where type=1",'up');
        return $data;
    }


    public function tambah_kontak_darurat_db($data) {
    	$this->db->trans_start();
        $this->db->insert('pegawai_kontak_darurat', $data);
        if ($this->db->affected_rows() > 0) {
               $this->db->trans_complete();
               return true;

        } else {
        	$this->db->trans_complete();
            return false;
        }
     }

     public function ubah_kontak_darurat_db($data,$idx) {
		$this->db->where('replid',$idx);
		$this->db->update('pegawai_kontak_darurat', $data);
		if ($this->db->_error_number() == 0) {
			return true;
		} else {
			return false;
		}
	 }

     public function hapuskontakdarurat_db($pegawai_id,$idx) {
        // Query to check whether username already exist or not
        $this->db->where('replid',$idx);
        $this->db->delete('pegawai_kontak_darurat');
        if ($this->db->_error_number() == 0) {
        	return true;
        } else {
            return false;
        }
    }

  //---------------------------------------------------------------------------------------------------------
	//------------------------------------------------------------------------------------------ UBAH KELUARGA
	//---------------------------------------------------------------------------------------------------------
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

    public function tambah_keluarga_db($pegawai_id,$id='',$data) {
    	$data['stat']="Data";
    	$data['form']='Pegawai';
    	$data['id']=$id;
    	$sql="SELECT *
      			FROM pegawai_keluarga k
      			WHERE k.replid='".$id."' AND k.pegawai_id='".$pegawai_id."'";

        $data['isi'] = $this->dbx->rows($sql);
        $query=$this->db->query($sql);

        if ($data['isi']== NULL ) {
        	unset($data['isi']);
					$sql="SELECT ".$this->dbx->tablecolumn('pegawai_keluarga');
        	$data['isi']=$this->dbx->rows($sql);
        }
        //echo is_array($data['isi'])."<br/>".$sql;die;

        $data['type_hubungan_opt'] = $this->dbx->opt("select replid,reff as nama from pegawai_reff where type=1 AND aktif=1 ORDER BY reff",'up');
        $data['type_pendidikan_terakhir_opt'] = $this->dbx->opt("select replid,pendidikan as nama from tingkatpendidikan WHERE aktif=1 ORDER BY pendidikan",'up');
        $data['type_pekerjaan_opt'] = $this->dbx->opt("select replid,pekerjaan as nama from jenispekerjaan WHERE aktif=1 ORDER BY pekerjaan",'up');
        $data['type_instansi_opt'] = $this->dbx->opt("select replid,instansi as nama from instansi ORDER BY instansi",'up');
        return $data;
    }

    public function tambah_keluarga_p_db($data) {
    	$this->db->trans_start();
        $this->db->insert('pegawai_keluarga', $data);
        if ($this->db->affected_rows() > 0) {
               $this->db->trans_complete();
               return true;

        } else {
        	$this->db->trans_complete();
            return false;
        }
     }

     public function ubah_keluarga_p_db($data,$idx) {
		$this->db->where('replid',$idx);
		$this->db->update('pegawai_keluarga', $data);
		if ($this->db->_error_number() == 0) {
			return true;
		} else {
			return false;
		}
	 }
	public function hapuskeluarga_p_db($pegawai_id,$idx) {
        // Query to check whether username already exist or not
        $this->db->where('replid',$idx);
        $this->db->delete('pegawai_keluarga');
        if ($this->db->_error_number() == 0) {
        	return true;
        } else {
            return false;
        }
    }

  //---------------------------------------------------------------------------------------------------------
	//---------------------------------------------------------------------------------------------- PENDIDIKAN
	//---------------------------------------------------------------------------------------------------------
	public function pendidikan_db($id_pegawai,$data) {
    	$sql="SELECT k.*,tp.pendidikan as jenjang
    	    	FROM pegawai_pendidikan k
    			LEFT JOIN tingkatpendidikan tp ON tp.replid=k.jenjang
    			WHERE pegawai_id='".$id_pegawai."' ORDER BY k.tahun_keluar ASC";
    	$data['pendidikan']=$this->dbx->data($sql);
    	return $data;
    }
    public function tambah_pendidikan_db($pegawai_id,$id='',$data) {
    	$data['stat']="Data";
    	$data['form']='Pegawai';
    	$data['id']=$id;
    	$sql="SELECT *
      			FROM pegawai_pendidikan k
      			WHERE k.replid='".$id."' AND k.pegawai_id='".$pegawai_id."'";

        $data['isi'] = $this->dbx->rows($sql);
        $query=$this->db->query($sql);
        if ($data['isi']== NULL ) {
					unset($data['isi']);
        	$sql="SELECT ".$this->dbx->tablecolumn('pegawai_pendidikan');
        	$data['isi']=$this->dbx->rows($sql);
        }
        //echo is_array($data['isi'])."<br/>".$sql;die;

        $data['type_jenjang_opt'] = $this->dbx->opt("select replid,pendidikan as nama from tingkatpendidikan  WHERE aktif=1 ORDER BY pendidikan",'up');
        return $data;
    }
    public function tambah_pendidikan_p_db($data) {
    	$this->db->trans_start();
        $this->db->insert('pegawai_pendidikan', $data);
        if ($this->db->affected_rows() > 0) {
               $this->db->trans_complete();
               return true;

        } else {
        	$this->db->trans_complete();
            return false;
        }
     }

    public function ubah_pendidikan_p_db($data,$idx) {
		$this->db->where('replid',$idx);
		$this->db->update('pegawai_pendidikan', $data);
		if ($this->db->_error_number() == 0) {
			return true;
		} else {
			return false;
		}
	}
	public function hapuspendidikan_p_db($pegawai_id,$idx) {
        // Query to check whether username already exist or not
        $this->db->where('replid',$idx);
        $this->db->delete('pegawai_pendidikan');
        if ($this->db->_error_number() == 0) {
        	return true;
        } else {
            return false;
        }
    }
    //---------------------------------------------------------------------------------------------------------
	//------------------------------------------------------------------------------------ PENDIDIKAN NON FORMAL
	//---------------------------------------------------------------------------------------------------------
	public function pendidikan_nf_db($id_pegawai,$data) {
    	$sql="SELECT k.*
    	    	FROM pegawai_pendidikan_nf k
    			WHERE pegawai_id='".$id_pegawai."'";
    	$data['pendidikan_nf']=$this->dbx->data($sql);
    	return $data;
    }
    public function tambah_pendidikan_nf_db($pegawai_id,$id='',$data) {
    	$data['stat']="Data";
    	$data['form']='Pegawai';
    	$data['id']=$id;
    	$sql="SELECT *
      			FROM pegawai_pendidikan_nf k
      			WHERE k.replid='".$id."' AND k.pegawai_id='".$pegawai_id."'";

        $data['isi'] = $this->dbx->rows($sql);
        $query=$this->db->query($sql);
        if ($data['isi']== NULL ) {
					unset($data['isi']);
        	$sql="SELECT ".$this->dbx->tablecolumn('pegawai_pendidikan_nf');
        	$data['isi']=$this->dbx->rows($sql);
        }
        //echo is_array($data['isi'])."<br/>".$sql;die;

        $data['type_jenjang_opt'] = $this->dbx->opt("select replid,pendidikan as nama from tingkatpendidikan  WHERE aktif=1 ORDER BY pendidikan",'up');
        return $data;
    }

    public function tambah_pendidikan_nf_p_db($data) {
    	$this->db->trans_start();
        $this->db->insert('pegawai_pendidikan_nf', $data);
        if ($this->db->affected_rows() > 0) {
               $this->db->trans_complete();
               return true;

        } else {
        	$this->db->trans_complete();
            return false;
        }
     }

    public function ubah_pendidikan_nf_p_db($data,$idx) {
		$this->db->where('replid',$idx);
		$this->db->update('pegawai_pendidikan_nf', $data);
		if ($this->db->_error_number() == 0) {
			return true;
		} else {
			return false;
		}
	}
	public function hapuspendidikan_nf_p_db($pegawai_id,$idx) {
        // Query to check whether username already exist or not
        $this->db->where('replid',$idx);
        $this->db->delete('pegawai_pendidikan_nf');
        if ($this->db->_error_number() == 0) {
        	return true;
        } else {
            return false;
        }
    }
    //---------------------------------------------------------------------------------------------------------
	//-------------------------------------------------------------------------------------------------- BAHASA
	//---------------------------------------------------------------------------------------------------------
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
    public function tambah_bahasa_db($pegawai_id,$id='',$data) {
    	$data['stat']="Data";
    	$data['form']='Pegawai';
    	$data['id']=$id;
    	$sql="SELECT *
      			FROM pegawai_bahasa k
      			WHERE k.replid='".$id."' AND k.pegawai_id='".$pegawai_id."'";

        $data['isi'] = $this->dbx->rows($sql);
        $query=$this->db->query($sql);
        if ($data['isi']== NULL ) {
        	unset($data['isi']);
					$sql="SELECT ".$this->dbx->tablecolumn('pegawai_bahasa');
        	$data['isi']=$this->dbx->rows($sql);
        }
        //echo is_array($data['isi'])."<br/>".$sql;die;

        $data['type_bahasa_opt'] = $this->dbx->opt("select replid,reff as nama from pegawai_reff WHERE type=6 AND aktif=1 ORDER BY reff",'up');
        return $data;
    }

    public function tambah_bahasa_p_db($data) {
    	$this->db->trans_start();
        $this->db->insert('pegawai_bahasa', $data);
        if ($this->db->affected_rows() > 0) {
               $this->db->trans_complete();
               return true;

        } else {
        	$this->db->trans_complete();
            return false;
        }
     }

    public function ubah_bahasa_p_db($data,$idx) {
		$this->db->where('replid',$idx);
		$this->db->update('pegawai_bahasa', $data);
		if ($this->db->_error_number() == 0) {
			return true;
		} else {
			return false;
		}
	}
	public function hapusbahasa_p_db($pegawai_id,$idx) {
        // Query to check whether username already exist or not
        $this->db->where('replid',$idx);
        $this->db->delete('pegawai_bahasa');
        if ($this->db->_error_number() == 0) {
        	return true;
        } else {
            return false;
        }
    }

    //---------------------------------------------------------------------------------------------------------
	//------------------------------------------------------------------------------------------------ KOMPUTER
	//---------------------------------------------------------------------------------------------------------
	public function komputer_db($id_pegawai,$data) {
    	$sql="SELECT k.*,pr1.reff as bidang,pr2.reff as tingkat
    	    	FROM pegawai_komputer k
    	    	LEFT JOIN pegawai_reff pr1 ON k.bidang=pr1.replid AND pr1.type=7
    	    	LEFT JOIN pegawai_reff pr2 ON k.tingkat=pr2.replid AND pr2.type=6
    			WHERE pegawai_id='".$id_pegawai."'";
    	$data['komputer']=$this->dbx->data($sql);
    	return $data;
    }
    public function tambah_komputer_db($pegawai_id,$id='',$data) {
    	$data['stat']="Data";
    	$data['form']='Pegawai';
    	$data['id']=$id;
    	$sql="SELECT *
      			FROM pegawai_komputer k
      			WHERE k.replid='".$id."' AND k.pegawai_id='".$pegawai_id."'";

        $data['isi'] = $this->dbx->rows($sql);
        $query=$this->db->query($sql);
        if ($data['isi']== NULL ) {
        	unset($data['isi']);
					$sql="SELECT ".$this->dbx->tablecolumn('pegawai_komputer');
        	$data['isi']=$this->dbx->rows($sql);
        }
        //echo is_array($data['isi'])."<br/>".$sql;die;

        $data['type_komputer_opt'] = $this->dbx->opt("select replid,reff as nama from pegawai_reff WHERE type=7 AND aktif=1 ORDER BY reff",'up');
        $data['type_tingkat_opt'] = $this->dbx->opt("select replid,reff as nama from pegawai_reff WHERE type=6 AND aktif=1 ORDER BY reff",'up');
        return $data;
    }

    public function tambah_komputer_p_db($data) {
    	$this->db->trans_start();
        $this->db->insert('pegawai_komputer', $data);
        if ($this->db->affected_rows() > 0) {
               $this->db->trans_complete();
               return true;

        } else {
        	$this->db->trans_complete();
            return false;
        }
     }

    public function ubah_komputer_p_db($data,$idx) {
		$this->db->where('replid',$idx);
		$this->db->update('pegawai_komputer', $data);
		if ($this->db->_error_number() == 0) {
			return true;
		} else {
			return false;
		}
	}
	public function hapuskomputer_p_db($pegawai_id,$idx) {
        // Query to check whether username already exist or not
        $this->db->where('replid',$idx);
        $this->db->delete('pegawai_komputer');
        if ($this->db->_error_number() == 0) {
        	return true;
        } else {
            return false;
        }
    }
  //---------------------------------------------------------------------------------------------------------
	//---------------------------------------------------------------------------------------- KEAHLIAN LAINNYA
	//---------------------------------------------------------------------------------------------------------
	public function skill_db($id_pegawai,$data) {
    	$sql="SELECT k.*,pr2.reff as tingkat
    	    	FROM pegawai_skill k
    	    	LEFT JOIN pegawai_reff pr2 ON k.tingkat=pr2.replid AND pr2.type=6
    			WHERE pegawai_id='".$id_pegawai."'";
    	$data['skill']=$this->dbx->data($sql);
    	return $data;
    }
    public function tambah_skill_db($pegawai_id,$id='',$data) {
    	$data['stat']="Data";
    	$data['form']='Pegawai';
    	$data['id']=$id;
    	$sql="SELECT *
      			FROM pegawai_skill k
      			WHERE k.replid='".$id."' AND k.pegawai_id='".$pegawai_id."'";

        $data['isi'] = $this->dbx->rows($sql);
        $query=$this->db->query($sql);
        if ($data['isi']== NULL ) {
        	unset($data['isi']);
					$sql="SELECT ".$this->dbx->tablecolumn('pegawai_skill');
        	$data['isi']=$this->dbx->rows($sql);
        }
        //echo is_array($data['isi'])."<br/>".$sql;die;
        $data['type_tingkat_opt'] = $this->dbx->opt("select replid,reff as nama from pegawai_reff WHERE type=6 AND aktif=1 ORDER BY reff",'up');
        return $data;
    }

    public function tambah_skill_p_db($data) {
    	$this->db->trans_start();
        $this->db->insert('pegawai_skill', $data);
        if ($this->db->affected_rows() > 0) {
               $this->db->trans_complete();
               return true;

        } else {
        	$this->db->trans_complete();
            return false;
        }
     }

    public function ubah_skill_p_db($data,$idx) {
		$this->db->where('replid',$idx);
		$this->db->update('pegawai_skill', $data);
		if ($this->db->_error_number() == 0) {
			return true;
		} else {
			return false;
		}
	}
	public function hapusskill_p_db($pegawai_id,$idx) {
        // Query to check whether username already exist or not
        $this->db->where('replid',$idx);
        $this->db->delete('pegawai_skill');
        if ($this->db->_error_number() == 0) {
        	return true;
        } else {
            return false;
        }
    }
    //---------------------------------------------------------------------------------------------------------
	//------------------------------------------------------------------------------------------------ PRESTASI
	//---------------------------------------------------------------------------------------------------------
	public function prestasi_db($id_pegawai,$data) {
    	$sql="SELECT k.*,pr2.reff as tingkat
    	    	FROM pegawai_prestasi k
    	    	LEFT JOIN pegawai_reff pr2 ON k.tingkat=pr2.replid AND pr2.type=8
    			WHERE pegawai_id='".$id_pegawai."' ORDER BY tahun ASC";
    	$data['prestasi']=$this->dbx->data($sql);
    	return $data;
    }
    public function tambah_prestasi_db($pegawai_id,$id='',$data) {
    	$data['stat']="Data";
    	$data['form']='Pegawai';
    	$data['id']=$id;
    	$sql="SELECT *
      			FROM pegawai_prestasi k
      			WHERE k.replid='".$id."' AND k.pegawai_id='".$pegawai_id."'";

        $data['isi'] = $this->dbx->rows($sql);
        $query=$this->db->query($sql);
        if ($data['isi']== NULL ) {
        	unset($data['isi']);
					$sql="SELECT ".$this->dbx->tablecolumn('pegawai_prestasi');
        	$data['isi']=$this->dbx->rows($sql);
        }
        //echo is_array($data['isi'])."<br/>".$sql;die;
        $data['type_tingkat_opt'] = $this->dbx->opt("select replid,reff as nama from pegawai_reff WHERE type=8 AND aktif=1 ORDER BY reff",'up');
        return $data;
    }

    public function tambah_prestasi_p_db($data) {
    	$this->db->trans_start();
        $this->db->insert('pegawai_prestasi', $data);
        if ($this->db->affected_rows() > 0) {
               $this->db->trans_complete();
               return true;

        } else {
        	$this->db->trans_complete();
            return false;
        }
     }

    public function ubah_prestasi_p_db($data,$idx) {
		$this->db->where('replid',$idx);
		$this->db->update('pegawai_prestasi', $data);
		if ($this->db->_error_number() == 0) {
			return true;
		} else {
			return false;
		}
	}
	public function hapusprestasi_p_db($pegawai_id,$idx) {
        // Query to check whether username already exist or not
        $this->db->where('replid',$idx);
        $this->db->delete('pegawai_prestasi');
        if ($this->db->_error_number() == 0) {
        	return true;
        } else {
            return false;
        }
    }

    //---------------------------------------------------------------------------------------------------------
	//---------------------------------------------------------------------------------------------- ORGANISASI
	//---------------------------------------------------------------------------------------------------------
	public function organisasi_db($id_pegawai,$data) {
    	$sql="SELECT k.*
    	    	FROM pegawai_organisasi k
    			WHERE pegawai_id='".$id_pegawai."' ORDER BY tgl_keluar ASC";
    	$data['organisasi']=$this->dbx->data($sql);
    	return $data;
    }
	
    public function tambah_organisasi_db($pegawai_id,$id='',$data) {
    	$data['stat']="Data";
    	$data['form']='Pegawai';
    	$data['id']=$id;
    	$sql="SELECT *
      			FROM pegawai_organisasi k
      			WHERE k.replid='".$id."' AND k.pegawai_id='".$pegawai_id."'";

        $data['isi'] = $this->dbx->rows($sql);
        $query=$this->db->query($sql);
        if ($data['isi']== NULL ) {
        	unset($data['isi']);
					$sql="SELECT ".$this->dbx->tablecolumn('pegawai_organisasi');
        	$data['isi']=$this->dbx->rows($sql);
        }
        return $data;
    }

    public function tambah_organisasi_p_db($data) {
    	$this->db->trans_start();
        $this->db->insert('pegawai_organisasi', $data);
        if ($this->db->affected_rows() > 0) {
               $this->db->trans_complete();
               return true;

        } else {
        	$this->db->trans_complete();
            return false;
        }
     }

    public function ubah_organisasi_p_db($data,$idx) {
		$this->db->where('replid',$idx);
		$this->db->update('pegawai_organisasi', $data);
		if ($this->db->_error_number() == 0) {
			return true;
		} else {
			return false;
		}
	}
	public function hapusorganisasi_p_db($pegawai_id,$idx) {
        // Query to check whether username already exist or not
        $this->db->where('replid',$idx);
        $this->db->delete('pegawai_organisasi');
        if ($this->db->_error_number() == 0) {
        	return true;
        } else {
            return false;
        }
    }
    //---------------------------------------------------------------------------------------------------------
	//---------------------------------------------------------------------------------------- PENGALAMAN KERJA
	//---------------------------------------------------------------------------------------------------------
	public function kerja_db($id_pegawai,$data) {
    	$sql="SELECT k.*
    	    	FROM pegawai_kerja k
    			WHERE pegawai_id='".$id_pegawai."' ORDER BY tgl_keluar ASC";
    	$data['kerja']=$this->dbx->data($sql);
    	return $data;
    }

    public function tambah_kerja_db($pegawai_id,$id='',$data) {
    	$data['stat']="Data";
    	$data['form']='Pegawai';
    	$data['id']=$id;
    	$sql="SELECT *
      			FROM pegawai_kerja k
      			WHERE k.replid='".$id."' AND k.pegawai_id='".$pegawai_id."'";

        $data['isi'] = $this->dbx->rows($sql);
        $query=$this->db->query($sql);
        if ($data['isi']== NULL ) {
        	unset($data['isi']);
					$sql="SELECT ".$this->dbx->tablecolumn('pegawai_kerja');
        	$data['isi']=$this->dbx->rows($sql);
        }
        return $data;
    }

    public function tambah_kerja_p_db($data) {
    	$this->db->trans_start();
        $this->db->insert('pegawai_kerja', $data);
        if ($this->db->affected_rows() > 0) {
               $this->db->trans_complete();
               return true;

        } else {
        	$this->db->trans_complete();
            return false;
        }
     }

    public function ubah_kerja_p_db($data,$idx) {
		$this->db->where('replid',$idx);
		$this->db->update('pegawai_kerja', $data);
		if ($this->db->_error_number() == 0) {
			return true;
		} else {
			return false;
		}
	}
	public function hapuskerja_p_db($pegawai_id,$idx) {
        // Query to check whether username already exist or not
        $this->db->where('replid',$idx);
        $this->db->delete('pegawai_kerja');
        if ($this->db->_error_number() == 0) {
        	return true;
        } else {
            return false;
        }
    }

    public function kontrak_db($id_pegawai,$data) {
      	$sql="SELECT kk.*,c.nama as idcompany,p.nama as idpegawai,d.departemen as iddepartemen,sp.nama as idpegawai_status
      			,tp.pegawai_tipe_pengangkatan as idpegawai_tipe_pengangkatan
      			,j.jabatan as idjabatan
      			FROM hrm_pegawai_kontrak kk
      			LEFT JOIN hrm_company c ON kk.idcompany=c.replid
      			LEFT JOIN pegawai p ON kk.idpegawai=p.replid
      			LEFT JOIN hrm_pegawai_tipe_pengangkatan tp ON tp.replid=kk.idpegawai_tipe_pengangkatan
      			LEFT JOIN hrm_jabatan j ON j.replid=kk.idjabatan
      			LEFT JOIN hrm_departemen d ON j.iddepartemen=d.replid
      			LEFT JOIN hrm_reff sp ON sp.replid=kk.idpegawai_status
      			WHERE kk.idpegawai='".$id_pegawai."'
      			ORDER BY kk.tanggal_pembuatan";
      	$data['kontrak']=$this->dbx->data($sql);

      	$sql="SELECT kk.*,c.nama as idcompany,p.nama as idpegawai,d.departemen as iddepartemen,sp.nama as idpegawai_status
      			,j.jabatan as idjabatan
      			FROM hrm_pegawai_jabatan kk
      			LEFT JOIN hrm_company c ON kk.idcompany=c.replid
      			LEFT JOIN pegawai p ON kk.idpegawai=p.replid
      			LEFT JOIN hrm_jabatan j ON j.replid=kk.idjabatan
      			LEFT JOIN hrm_departemen d ON j.iddepartemen=d.replid
      			LEFT JOIN hrm_reff sp ON sp.replid=kk.idpegawai_status
      			WHERE kk.idpegawai='".$id_pegawai."'
      			ORDER BY kk.akhir_kontrak ASC";
      	$data['jabatan']=$this->dbx->data($sql);

      	return $data;
    }

		public function event_db($id_pegawai,$data) {
      	$sql="SELECT ep.*,e.kode_transaksi,e.tanggalpelaksanaan,pr.perihal as perihaltext,s.status as statustext
								,(e.tanggalpelaksanaan=CURRENT_DATE()) as harievent
								,DATEDIFF(e.tanggalpelaksanaan,CURRENT_DATE()) as sisahari
								,et.tema as tematext,et.kkm
								,DATE_FORMAT(e.jammulai,'%H:%i') as jammulai
								,DATE_FORMAT(e.jamakhir,'%H:%i') as jamakhir

      			FROM hrm_event_peserta ep
						INNER JOIN hrm_event e ON e.replid=ep.idhrm_event
						LEFT JOIN hrm_event_theme et ON et.replid=e.idhrm_event_theme
						LEFT JOIN reff_perihal pr ON pr.replid=e.idperihal
						LEFT JOIN hrm_status s ON e.status=s.node
      			WHERE ep.idpegawai='".$id_pegawai."'
      			ORDER BY e.tanggalpelaksanaan";
      	$data['event']=$this->dbx->data($sql);
      	return $data;
    }
}

?>
