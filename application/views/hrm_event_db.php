<?php
Class hrm_event_db extends CI_Model {
public function __construct() {
parent::__construct();
	$this->load->library('dbx');
}
    // Read data from database to show data in admin page
    public function data($data) {
				//WHERE created_by='".$this->session->userdata('idpegawai')."'
				$cari="";
				if (($this->input->post('tanggal1')<>"") AND ($this->input->post('tanggal2')=="")){
					$cari=$cari." AND t.tanggalpelaksanaan >= '".$this->p_c->tgl_db($this->input->post('tanggal1'))."' ";
				}
				if (($this->input->post('tanggal1')=="") AND ($this->input->post('tanggal2')<>"")){
					$cari=$cari." AND t.tanggalpelaksanaan <= '".$this->p_c->tgl_db($this->input->post('tanggal2'))."' ";
				}
				if (($this->input->post('tanggal1')<>"") AND ($this->input->post('tanggal2')<>"")){
					$cari=$cari." AND t.tanggalpelaksanaan BETWEEN '".$this->p_c->tgl_db($this->input->post('tanggal1'))."' AND '".$this->p_c->tgl_db($this->input->post('tanggal2'))."' ";
				}

				if ($this->input->post('status')<>""){
					$cari=$cari." AND t.status='".$this->input->post('status')."' ";
				}else{
					if($data["ubah"]==3){
						$cari=$cari." AND t.status='4' ";
					}else{
						if($cari==""){
								$cari=$cari." AND t.status<>'4' ";
						}
					}
				}
      	$sql="SELECT t.*,pr.perihal as perihaltext,r.nama as ruangtext,s.status as statustext
								,et.tema as tematext
								,DATEDIFF(t.tanggalpelaksanaan,CURRENT_DATE()) as sisahari
								,DATE_FORMAT(jammulai,'%H:%i') as jammulai
								,DATE_FORMAT(jamakhir,'%H:%i') as jamakhir
							FROM hrm_event t
							LEFT JOIN hrm_event_theme et ON et.replid=t.idhrm_event_theme
							LEFT JOIN reff_perihal pr ON pr.replid=t.idperihal
							LEFT JOIN inventory_ruang r ON r.replid=t.idruang
							LEFT JOIN hrm_status s ON t.status=s.node
							LEFT JOIN pegawai p ON p.replid=t.idpenanggungjawab
							WHERE t.status=s.node ".$cari."
      			ORDER BY t.tanggalpelaksanaan DESC";
			$data['show_table']=$this->dbx->data($sql);
			$data['status_opt'] = $this->dbx->opt("select node as replid,status as nama FROM hrm_status ORDER BY status",'up');

			return $data;
    }


    //TAMBAH
    //-------------------------------------------------------------------------------------------
    public function tambah_x($id='',$data) {
    	$data['id']=$id;
      	$sql="SELECT kk.*,DATE_FORMAT(jammulai,'%H:%i') as jammulai
 			 								,DATE_FORMAT(jamakhir,'%H:%i') as jamakhir
      			FROM hrm_event kk
      			WHERE kk.replid='".$id."'";
				//echo $sql;die;
        $data['isi'] = $this->dbx->rows($sql);

        if ($data['isi']== NULL ) {
        	unset($data['isi']);
        	$sql="SELECT
					NULL as subjek,
					NULL as deskripsi,
					NULL as idhrm_event_theme,
					NULL as idperihal,
					NULL as idpenanggungjawab,
					NULL as idruang,
					1 as sesi,
					NULL as target_peserta,
					1 as aktif,
					CURRENT_DATE() as tanggalpelaksanaan,
					CURRENT_DATE() as tanggalkonfirmasi,
					DATE_FORMAT(NOW(),'%H:%i') as jammulai,
 				 	DATE_FORMAT(NOW(),'%H:%i') as jamakhir,
					NULL as idrole,
					NULL as idrole2,
					0 as biaya,
					NULL as created_date,
					NULL as created_by,
					NULL as modified_date,
					NULL as modified_by";
        	$data['isi']=$this->dbx->rows($sql);
        }

				$data['idhrm_event_theme_opt'] = $this->dbx->opt("select replid,tema as nama FROM hrm_event_theme WHERE aktif=1 ORDER BY tema",'up');
				$data['idperihal_opt'] = $this->dbx->opt("select replid,perihal as nama from reff_perihal WHERE aktif=1 AND type='event' ORDER BY perihal",'up');
				$data['idperihal_opt'] = $this->p_c->arraymerge($data['idperihal_opt'],array('0' => 'Lain-Lain'));
				$data['idruang_opt'] = $this->dbx->opt("SELECT replid, nama FROM inventory_ruang ORDER BY nama",'up');
				$data['idpenanggungjawab_opt'] = $this->dbx->opt("select replid,CONCAT(nama,' [',nip,']') as nama from pegawai where aktif=1 ORDER BY nama","up");

				$sql="SELECT j.replid,j.role as nama
															FROM role j
													WHERE j.aktif=1
													ORDER BY j.role";
				$data['idrole_opt'] = $this->dbx->data($sql);

				return $data;
    }

    public function tambah($data) {
    	//echo print_r(array_values($data));die;
    	$this->db->trans_start();
        $this->db->insert('hrm_event', $data);
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

	 public function tambahrundown_db($data,$id,$idx="") {
			 $sql="SELECT er.*,DATE_FORMAT(dari,'%H:%i') as dari
			 ,DATE_FORMAT(sampai,'%H:%i') as sampai
					 FROM hrm_event_rundown er
					 WHERE replid='".$idx."'";
			 $data['isi'] = $this->dbx->rows($sql);

			 if ($data['isi']== NULL ) {
				 unset($data['isi']);
				 $sql="SELECT
				 NULL as hrm_event_rundown,
				 DATE_FORMAT(NOW(),'%H:%i') as dari,
				 DATE_FORMAT(NOW(),'%H:%i') as sampai,
				 NULL as created_date,
				 NULL as created_by,
				 NULL as modified_date,
				 NULL as modified_by";
				 $data['isi']=$this->dbx->rows($sql);
			 }
			 return $data;
	 }

	 public function tambahrundown($data) {
			//echo print_r(array_values($data));die;
			$this->db->trans_start();
				$this->db->insert('hrm_event_rundown', $data);
				$insert_id = $this->db->insert_id();
				if ($this->db->affected_rows() > 0) {
							 $this->db->trans_complete();
							 return $insert_id;
				} else {
					$this->db->trans_complete();
						return false;
				}
		 }

	public function ubahrundown_db($data,$id) {
	 		//echo var_dump($data);die;
	 		$this->db->where('replid',$id);
	 		$this->db->update('hrm_event_rundown', $data);
			//echo $this->db->last_query();die;
	 		if ($this->db->_error_number() == 0) {
	 		  return true;
	 		} else {
	 		  return false;
	 		}
	 	}

		public function hapusrundown_db($id) {
 		 // Query to check whether username already exist or not
 		 $this->db->where('replid',$id);
 		 $this->db->delete('hrm_event_rundown');
 		 if ($this->db->_error_number() == 0) {
 			 return true;
 		 } else {
 				 return false;
 		 }
 	 }

	 public function tambahpemateri($data) {
			//echo print_r(array_values($data));die;
			$this->db->trans_start();
				$this->db->insert('hrm_event_pemateri', $data);
				$insert_id = $this->db->insert_id();
				if ($this->db->affected_rows() > 0) {
							 $this->db->trans_complete();
							 return $insert_id;
				} else {
					$this->db->trans_complete();
						return false;
				}
		 }

		 public function tambahpeserta($data) {
				//echo print_r(array_values($data));die;
				$this->db->trans_start();
					$this->db->insert('hrm_event_peserta', $data);
					$insert_id = $this->db->insert_id();
					if ($this->db->affected_rows() > 0) {
								 $this->db->trans_complete();
								 return $insert_id;
					} else {
						$this->db->trans_complete();
							return false;
					}
			 }

		public function hapuspemateri_db($id,$idx) {
 		 // Query to check whether username already exist or not
 		 $this->db->where('idhrm_event',$id);
		 $this->db->where('idpemateri',$idx);
 		 $this->db->delete('hrm_event_pemateri');
 		 if ($this->db->_error_number() == 0) {
 			 return true;
 		 } else {
 				 return false;
 		 }
 	 }

	 public function kode_transaksi($tanggalpelaksanaan){

		$kode_transaksi="";
		//tanggalpelaksanaan='".$tanggalpelaksanaan."'
	  $sql2="SELECT DATE_FORMAT('".$tanggalpelaksanaan."','%Y%m%d') kodetanggal,LPAD(RIGHT(TRIM(kode_transaksi),4)+1,4,'0') as no_urut FROM hrm_event
	 					WHERE year(tanggalpelaksanaan)=year('".$tanggalpelaksanaan."') ORDER BY no_urut DESC LIMIT 1";
		//echo $sql2;die;
		$query2=$this->db->query($sql2);
	 	$isi2=$query2->row();
	 	if ($query2->num_rows() > 0) {
	 		$kode_transaksi=$isi2->kodetanggal.$isi2->no_urut;
	 	}else{
	 		$kode_transaksi=str_replace('-','',$tanggalpelaksanaan)."0001";
	 	}
	 	return $kode_transaksi;
	 }

	 public function no_registerpemateri($id){
		$no_register="";
		$sql="SELECT kode_transaksi FROM hrm_event WHERE replid='".$id."'";
	  $query=$this->db->query($sql);
	 	$isi=$query->row();

	  $sql2="SELECT
								LPAD(RIGHT(TRIM(no_register),3)+1,3,'0') as no_urut
						FROM hrm_event_pemateri
	 					WHERE idhrm_event='".$id."' ORDER BY no_urut LIMIT 1";
	  $query2=$this->db->query($sql2);
	 	$isi2=$query2->row();

	 	if ($query2->num_rows() > 0) {
	 		$no_register=$isi->kode_transaksi.$isi2->no_urut;
	 	}else{
	 		$no_register=$isi->kode_transaksi."001";
	 	}
		return $no_register;
	 }

	public function ubah($data,$id) {
		//echo var_dump($data);die;
		$this->db->where('replid',$id);
		$this->db->update('hrm_event', $data);
		//echo $this->db->last_query();die;
		if ($this->db->_error_number() == 0) {
		  return true;
		} else {
		  return false;
		}
	}

    //hrm_event MAP
    //-------------------------------------------------------------------------------------------
    public function hapus_tujuan_p_db($id) {
	    $this->db->where('hrm_event_id',$id);
	    $this->db->delete('hrm_event');
	    if ($this->db->_error_number() == 0) {
	    	return true;
	    } else {
	        return false;
	    }
    }

    public function tambah_tujuan_p_db($data) {
    	//echo print_r(array_values($data));die;
    	$this->db->trans_start();
        $this->db->insert('hrm_event', $data);
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
	    $this->db->delete('hrm_event');
	    if ($this->db->_error_number() == 0) {
	    	return true;
	    } else {
	        return false;
	    }
    }

		public function importeventevaluationpelaksana_db($id) {
			$sql="INSERT INTO hrm_event_evaluation_pelaksana(idhrm_event,idhrm_event_evaluation)
						(SELECT '".$id."',replid FROM hrm_event_evaluation WHERE replid NOT IN (SELECT idhrm_event_evaluation FROM hrm_event_evaluation_pelaksana WHERE idhrm_event='".$id."'))";
			return $this->db->query($sql);
		}

		public function importpeserta_db($id,$idrole,$idrole2) {
			$sqldelete="DELETE FROM hrm_event_peserta WHERE idhrm_event='".$id."'";
			$this->db->query($sqldelete);

			$idrolex=explode(',',$idrole);
			$filterrole="";
			foreach($idrolex as $idroleexplode){
				if ($filterrole<>""){
						$filterrole= $filterrole." OR find_in_set(".$idroleexplode.",l.role_id) ";
				}else{
						$filterrole=" find_in_set(".$idroleexplode.",l.role_id) ";
				}
			}
			if ($filterrole<>""){
					$filterrole=" AND (".$filterrole.") ";
			}

			/*
			$data['hrm_event_peserta2'] = $this->dbx->data("SELECT p.replid,CONCAT(p.nama,' [',p.nip,']') as nama,0 as checked
																											FROM pegawai p
																											INNER JOIN login l ON p.replid=l.idpegawai
																											WHERE p.aktif=1 ".$filterrole." ORDER BY p.nama");
      */

			$sql="INSERT INTO hrm_event_peserta(idhrm_event,idpegawai,wajib,konfirmasi)
						(SELECT '".$id."',p.replid,1,1 FROM pegawai p
							INNER JOIN login l ON p.replid=l.idpegawai
							WHERE p.aktif=1 AND p.replid NOT IN (SELECT idpegawai FROM hrm_event_peserta WHERE idhrm_event='".$id."' ) ".$filterrole." )";
			//echo $sql;die;
			$this->db->query($sql);

			$idrolex2=explode(',',$idrole2);
			$filterrole2="";
			foreach($idrolex2 as $idroleexplode2){
				if ($filterrole2<>""){
						$filterrole2= $filterrole2." OR find_in_set(".$idroleexplode2.",l.role_id) ";
				}else{
						$filterrole2=" find_in_set(".$idroleexplode2.",l.role_id) ";
				}
			}
			if ($filterrole2<>""){
					$filterrole2=" AND (".$filterrole2.") ";
			}

			$sql="INSERT INTO hrm_event_peserta(idhrm_event,idpegawai,wajib,konfirmasi)
						(SELECT '".$id."',p.replid,0,0 FROM pegawai p
							INNER JOIN login l ON p.replid=l.idpegawai
							WHERE p.aktif=1 AND p.replid NOT IN (SELECT idpegawai FROM hrm_event_peserta WHERE idhrm_event='".$id."' ) ".$filterrole2." )";
			//echo $sql;die;
			$this->db->query($sql);

			//return $result;

		}


		public function view_db($id,$data) {
				$where="";
			//,IF(penerima<>'',CONCAT(px.nama,' (',px.nip,')'),p.nama)  as penerimatext
				$sql="SELECT t.*,pr.perihal as perihaltext,r.nama as ruangtext,s.status as statustext
								,(tanggalpelaksanaan=CURRENT_DATE()) as harievent
								,DATEDIFF(t.tanggalpelaksanaan,CURRENT_DATE()) as sisahari
								,et.tema as tematext,et.kkm
								,DATE_FORMAT(jammulai,'%H:%i') as jammulai
								,DATE_FORMAT(jamakhir,'%H:%i') as jamakhir
								,md5(kodeabsen) as kodeabsen_dec
							FROM hrm_event t
							LEFT JOIN hrm_event_theme et ON et.replid=t.idhrm_event_theme
							LEFT JOIN reff_perihal pr ON pr.replid=t.idperihal
							LEFT JOIN inventory_ruang r ON r.replid=t.idruang
							LEFT JOIN hrm_status s ON t.status=s.node
						WHERE t.replid='".$id."'";
				$data['isi'] = $this->dbx->rows($sql);

				$data['idpemateri_opt'] = $this->dbx->opt("select replid,perihal as nama from reff_perihal WHERE aktif=1 AND type='eventpemateri' ORDER BY perihal",'up');
				$data['idpemateri_opt'] = $this->p_c->arraymerge($data['idpemateri_opt'],array('0' => 'Lain-Lain'));
				if ($data["ubah"]==2){
					$where=" AND ep.idpegawai='".$this->session->userdata('idpegawai')."' ";
				}
				$sqlpeg="SELECT replid,nama
								FROM pegawai
								WHERE aktif=1
								AND replid NOT IN (SELECT idpegawai FROM hrm_event_peserta WHERE idhrm_event='".$id."')
								ORDER BY nama ASC ";
				$data['idpegawai_opt'] = $this->dbx->opt($sqlpeg,'up');


				$data['hrm_event_pemateri'] = $this->dbx->data("SELECT pm.*,pr.perihal as namapemateri FROM hrm_event_pemateri pm
																												LEFT JOIN reff_perihal pr ON pr.replid=pm.idpemateri
																												WHERE idhrm_event='".$id."'
																												ORDER BY perihal");

				$data['hrm_event_rundown'] = $this->dbx->data("SELECT *,DATE_FORMAT(dari,'%H:%i') as dari,DATE_FORMAT(sampai,'%H:%i') as sampai, DATE_FORMAT(TIMEDIFF(sampai,dari),'%H:%i') as lama
																												FROM hrm_event_rundown WHERE idhrm_event='".$id."' ");


				$data['hrm_event_evaluation_pelaksana_peserta'] = $this->dbx->data("SELECT ee.*,eep.idhrm_event,eep.idhrm_event_evaluation
																																		,(SELECT CEIL(AVG(skor)) FROM hrm_event_evaluation_peserta ep
																																				WHERE ep.idhrm_event=eep.idhrm_event AND ep.idhrm_event_evaluation=ee.replid ".$where.") as avgpeserta
																																FROM hrm_event_evaluation_pelaksana eep
																																INNER JOIN hrm_event_evaluation ee ON ee.replid=eep.idhrm_event_evaluation
																																WHERE ee.type='peserta' AND eep.idhrm_event='".$id."' ORDER BY ee.type,ee.no_urut",'up');

				$data['hrm_event_evaluation_pelaksana_pemateri'] = $this->dbx->data("SELECT ee.*,eep.idhrm_event,eep.idhrm_event_evaluation
 																																	 ,(SELECT CEIL(AVG(skor)) FROM hrm_event_evaluation_peserta eps
 																																			 WHERE eps.idhrm_event=eep.idhrm_event AND eps.idhrm_event_evaluation=ee.replid ) as avgpeserta
 																															 FROM hrm_event_evaluation_pelaksana eep
 																															 INNER JOIN hrm_event_evaluation ee ON ee.replid=eep.idhrm_event_evaluation
 																															 WHERE ee.type='pemateri' AND eep.idhrm_event='".$id."' ORDER BY ee.type,ee.no_urut",'up');

				$sqlpeserta="SELECT ep.*,p.replid as idpeserta, l.aktif as aktiflogin
																												FROM hrm_event_peserta ep
																												INNER JOIN pegawai p ON p.replid=ep.idpegawai
																												LEFT JOIN login l ON l.login=p.nip
																												WHERE ep.idhrm_event='".$id."' ".$where." ORDER BY ep.wajib DESC,p.nama ASC";

				$data['hrm_event_peserta'] = $this->dbx->data($sqlpeserta);

				$sqlattachment="SELECT * FROM hrm_event_attachment WHERE idhrm_event='".$id."'";
        $data['attachment'] = $this->dbx->data($sqlattachment);

				if ($data["isi"]->status==4){
					$data['hrm_event_evaluation_deskripsi']=$this->dbx->data("SELECT eep.*,ee.type,ee.head,ee.hrm_event_evaluation FROM hrm_event_evaluation_peserta eep
																										INNER JOIN hrm_event_evaluation ee ON ee.replid=eep.idhrm_event_evaluation
																										where eep.deskripsinilai<>'' AND eep.idhrm_event='".$id."' ORDER BY ee.type, ee.no_urut ");

				}

				return $data;
		}

		public function viewevaluasi_db($data,$type,$idhrm_event,$id) {
			//if ($type=="pemateri"){
				$sql="SELECT ee.*,eep.idhrm_event,eep.idhrm_event_evaluation,eps.skor,eps.deskripsinilai
																															 FROM hrm_event_evaluation_pelaksana eep
																															 INNER JOIN hrm_event_evaluation ee ON ee.replid=eep.idhrm_event_evaluation
																															 LEFT JOIN hrm_event_evaluation_peserta eps ON eps.idhrm_event=eep.idhrm_event AND eps.idhrm_event_evaluation=ee.replid
																															 					AND eps.idpegawai='".$id."'
																															 WHERE ee.type='".$type."' AND eep.idhrm_event='".$idhrm_event."'
																															 ORDER BY ee.type,ee.no_urut";
				//echo $sql;die;
				$data['hrm_event_evaluation'] = $this->dbx->data($sql,'up');

			//}
			return $data;

		}

		public function viewevaluasidetail_db($data,$idhrm_event,$idevaluasi) {
			//if ($type=="pemateri"){
				$sql="SELECT eps.*, ee.hrm_event_evaluation,ee.target_skor
																															 FROM hrm_event_evaluation ee
																															 LEFT JOIN hrm_event_evaluation_peserta eps ON eps.idhrm_event_evaluation=ee.replid
																															 WHERE ee.replid='".$idevaluasi."' AND eps.idhrm_event='".$idhrm_event."'
																															 ORDER BY ee.no_urut";
				//echo $sql;die;
				$data['hrm_event_evaluation'] = $this->dbx->data($sql,'up');

			//}
			return $data;

		}


		public function hrmeventevaluationpelaksanahapus_db($id) {
	    // Query to check whether username already exist or not
			$this->db->where('idhrm_event',$id);
			$this->db->where('idhrm_event_evaluation',$idx);
	    $this->db->delete('hrm_event_evaluation_pelaksana');
	    if ($this->db->_error_number() == 0) {
	    	return true;
	    } else {
	        return false;
	    }
    }

		public function hrmeventpesertahapus_db($id,$idx) {
	    // Query to check whether username already exist or not
			$this->db->where('idhrm_event',$id);
			$this->db->where('idpegawai',$idx);
	    $this->db->delete('hrm_event_peserta');
	    if ($this->db->_error_number() == 0) {
				return true;
	    } else {
	        return false;
	    }
    }

	 public function ubahhadirqr_db($data,$idhrm_event,$idpegawai) {
		//echo var_dump($data);die;
		$this->db->where('idhrm_event',$idhrm_event);
		$this->db->where('idpegawai',$idpegawai);
		$this->db->update('hrm_event_peserta', $data);
		if ($this->db->_error_number() == 0) {
			return true;
		} else {
			return false;
		}
	}

	 public function tambahattachment_db($data) {
		//echo print_r(array_values($data));die;
		$this->db->trans_start();
			$this->db->insert('hrm_event_attachment', $data);
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
		$this->db->delete('hrm_event_attachment');
		if ($this->db->_error_number() == 0) {
			return true;
		} else {
				return false;
		}
	}
}
?>
