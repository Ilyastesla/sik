<?php

Class registrasi_db extends CI_Model {
	public function __construct() {
	parent::__construct();
		$this->load->library('dbx');
	}
    public function tambah_x($id='',$data) {
    		$sql="SELECT *
      			FROM pegawai_calon p
      			WHERE p.replid='".$id."'";
        $data['header'] = $this->dbx->rows($sql);
        if ($data['header']== NULL ) {
        	unset($data['header']);
					$sql="SELECT ".$this->dbx->tablecolumn('pegawai_calon');
					$data['header']=$this->dbx->rows($sql);
        }
        $data['type_negara_opt'] = $this->dbx->opt("select replid,negara as nama from negara",'up');
        return $data;
    }

		//---------------------------------------------------------------------------------------------------------
	//---------------------------------------------------------------------------------------------- PENDIDIKAN
	//---------------------------------------------------------------------------------------------------------
	public function pendidikan_db($id_pegawai,$data) {
    	$sql="SELECT k.*,tp.pendidikan as jenjang
    	    	FROM pegawai_pendidikan k
    			LEFT JOIN tingkatpendidikan tp ON tp.replid=k.jenjang
    			WHERE calonpegawai_id='".$id_pegawai."'
					ORDER BY k.tahun_keluar ASC";
    	$data['pendidikan']=$this->dbx->data($sql);
    	return $data;
    }

    public function tambah_pendidikan_db($pegawai_id,$id='',$data) {
    	$data['id']=$id;
    	$sql="SELECT *
      			FROM pegawai_pendidikan k
      			WHERE k.replid='".$id."' AND k.calonpegawai_id='".$pegawai_id."'";

        $data['isi'] = $this->dbx->rows($sql);
        $query=$this->db->query($sql);
        if ($data['isi']== NULL ) {
        	unset($data['isi']);
        	$sql="SELECT NULL as 'jenjang', NULL as  'institusi',NULL as  'fakultas',NULL as  'jurusan', NULL as  'tahun_masuk', NULL as  'tahun_keluar'";
        	$data['isi']=$this->dbx->rows($sql);
        }
        //echo is_array($data['isi'])."<br/>".$sql;die;

        $data['type_jenjang_opt'] = $this->dbx->opt("select replid,pendidikan as nama from tingkatpendidikan ORDER BY pendidikan",'up');
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
    			WHERE calonpegawai_id='".$id_pegawai."'";
    	$data['pendidikan_nf']=$this->dbx->data($sql);
    	return $data;
    }
    public function tambah_pendidikan_nf_db($pegawai_id,$id='',$data) {
    	$data['id']=$id;
    	$sql="SELECT *
      			FROM pegawai_pendidikan_nf k
      			WHERE k.replid='".$id."' AND k.calonpegawai_id='".$pegawai_id."'";

        $data['isi'] = $this->dbx->rows($sql);
        if ($data['isi']== NULL ) {
        	unset($data['isi']);
					$sql="SELECT ".$this->dbx->tablecolumn('pegawai_pendidikan_nf');
					$data['isi']=$this->dbx->rows($sql);
        }
        //echo is_array($data['isi'])."<br/>".$sql;die;

        $data['type_jenjang_opt'] = $this->dbx->opt("select replid,pendidikan as nama from tingkatpendidikan ORDER BY pendidikan",'up');
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
    			WHERE calonpegawai_id='".$id_pegawai."'";
    	$data['bahasa']=$this->dbx->data($sql);
    	return $data;
    }
    public function tambah_bahasa_db($pegawai_id,$id='',$data) {
    	$data['id']=$id;
    	$sql="SELECT *
      			FROM pegawai_bahasa k
      			WHERE k.replid='".$id."' AND k.calonpegawai_id='".$pegawai_id."'";

        $data['isi'] = $this->dbx->rows($sql);
        $query=$this->db->query($sql);
        if ($data['isi']== NULL ) {
        	unset($data['isi']);
        	$sql="SELECT NULL as  'bahasa', NULL as  'bicara', NULL as  'menulis',NULL as  'membaca',NULL as  'toefl'";
        	$data['isi']=$this->dbx->rows($sql);
        }
        //echo is_array($data['isi'])."<br/>".$sql;die;

        $data['type_bahasa_opt'] = $this->dbx->opt("select replid,reff as nama from pegawai_reff WHERE type=6 ORDER BY replid",'up');
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
    			WHERE calonpegawai_id='".$id_pegawai."'";
    	$data['komputer']=$this->dbx->data($sql);
    	return $data;
    }
    public function tambah_komputer_db($pegawai_id,$id='',$data) {
    	$data['id']=$id;
    	$sql="SELECT *
      			FROM pegawai_komputer k
      			WHERE k.replid='".$id."' AND k.calonpegawai_id='".$pegawai_id."'";

        $data['isi'] = $this->dbx->rows($sql);
        $query=$this->db->query($sql);
        if ($data['isi']== NULL ) {
        	unset($data['isi']);
        	$sql="SELECT NULL as  'komputer', NULL as  'bidang', NULL as  'tingkat', NULL as  'keterangan'";
        	$data['isi']=$this->dbx->rows($sql);
        }
        //echo is_array($data['isi'])."<br/>".$sql;die;

        $data['type_komputer_opt'] = $this->dbx->opt("select replid,reff as nama from pegawai_reff WHERE type=7 ORDER BY replid",'up');
        $data['type_tingkat_opt'] = $this->dbx->opt("select replid,reff as nama from pegawai_reff WHERE type=6 ORDER BY replid",'up');
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
    			WHERE calonpegawai_id='".$id_pegawai."'";
    	$data['skill']=$this->dbx->data($sql);
    	return $data;
    }
    public function tambah_skill_db($pegawai_id,$id='',$data) {
    	$data['id']=$id;
    	$sql="SELECT *
      			FROM pegawai_skill k
      			WHERE k.replid='".$id."' AND k.calonpegawai_id='".$pegawai_id."'";

        $data['isi'] = $this->dbx->rows($sql);
        $query=$this->db->query($sql);
        if ($data['isi']== NULL ) {
        	unset($data['isi']);
        	$sql="SELECT NULL as  'skill', NULL as  'tingkat'";
        	$data['isi']=$this->dbx->rows($sql);
        }
        //echo is_array($data['isi'])."<br/>".$sql;die;
        $data['type_tingkat_opt'] = $this->dbx->opt("select replid,reff as nama from pegawai_reff WHERE type=6 ORDER BY replid",'up');
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
    			WHERE calonpegawai_id='".$id_pegawai."' ORDER BY tahun ASC";
    	$data['prestasi']=$this->dbx->data($sql);
    	return $data;
    }
    public function tambah_prestasi_db($pegawai_id,$id='',$data) {
    	$data['id']=$id;
    	$sql="SELECT *
      			FROM pegawai_prestasi k
      			WHERE k.replid='".$id."' AND k.calonpegawai_id='".$pegawai_id."'";

        $data['isi'] = $this->dbx->rows($sql);
        $query=$this->db->query($sql);
        if ($data['isi']== NULL ) {
        	unset($data['isi']);
        	$sql="SELECT NULL as  'tahun',NULL as  'prestasi', NULL as  'tingkat', NULL as  'instansi'";
        	$data['isi']=$this->dbx->rows($sql);
        }
        //echo is_array($data['isi'])."<br/>".$sql;die;
        $data['type_tingkat_opt'] = $this->dbx->opt("select replid,reff as nama from pegawai_reff WHERE type=8 ORDER BY replid",'up');
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
    			WHERE calonpegawai_id='".$id_pegawai."'
					ORDER BY tgl_keluar ASC";
    	$data['organisasi']=$this->dbx->data($sql);
    	return $data;
    }
    public function tambah_organisasi_db($pegawai_id,$id='',$data) {
    	$data['id']=$id;
    	$sql="SELECT *
      			FROM pegawai_organisasi k
      			WHERE k.replid='".$id."' AND k.calonpegawai_id='".$pegawai_id."'";

        $data['isi'] = $this->dbx->rows($sql);
        $query=$this->db->query($sql);
        if ($data['isi']== NULL ) {
        	unset($data['isi']);
        	$sql="SELECT NULL as  'instansi'
        				,NULL as  'organisasi'
        				,NULL as  'jabatan'
        				,NULL as  'tanggung_jawab'
        				,NULL as  'tgl_masuk'
        				,NULL as  'tgl_keluar'";
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
    			WHERE calonpegawai_id='".$id_pegawai."'
					ORDER BY tahun_keluar ASC";
					// ORDER BY tgl_keluar ASC";
    	$data['kerja']=$this->dbx->data($sql);
    	return $data;
    }

    public function tambah_kerja_db($pegawai_id,$id='',$data) {
    	$data['id']=$id;
    	$sql="SELECT *
      			FROM pegawai_kerja k
      			WHERE k.replid='".$id."' AND k.calonpegawai_id='".$pegawai_id."'";

        $data['isi'] = $this->dbx->rows($sql);
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

}

?>
