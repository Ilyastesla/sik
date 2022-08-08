<?php
Class hrm_event_sign_db extends CI_Model {
public function __construct() {
parent::__construct();
	$this->load->library('dbx');
}
    // Read data from database to show data in admin page
    public function data() {
				//WHERE created_by='".$this->session->userdata('idpegawai')."'
      	$sql="SELECT t.*,pr.perihal as perihaltext,r.nama as ruangtext,s.status as statustext
							,(tanggalkonfirmasi<=CURRENT_DATE()) as lewat
							,ep.idpegawai,ep.hadir
							,ep.tanggalhadir1
							,ep.konfirmasi
							,et.tema as tematext
							,ep.pretest,ep.posttest, ep.wajib 
							FROM hrm_event t
							LEFT JOIN hrm_event_theme et ON et.replid=t.idhrm_event_theme
							LEFT JOIN reff_perihal pr ON pr.replid=t.idperihal
							LEFT JOIN inventory_ruang r ON r.replid=t.idruang
							LEFT JOIN hrm_status s ON t.status=s.node
							INNER JOIN hrm_event_peserta ep ON ep.idhrm_event=t.replid
							WHERE t.status IN (4,5,'PR','PO','EV') AND ep.idpegawai='".$this->session->userdata('idpegawai')."'
      			ORDER BY modified_date";
      	return $this->dbx->data($sql);
    }

		public function view_db($id,$tipe,$data) {
			$data= $this->hrm_event_db->view_db($id,$data);
			if ($data["view2"]=="nilaievent"){
				$sqlevp="SELECT ee.*,eep.idhrm_event,eep.idhrm_event_evaluation,eeps.deskripsinilai,eeps.skor
																																FROM hrm_event_evaluation_pelaksana eep
																																INNER JOIN hrm_event_evaluation ee ON ee.replid=eep.idhrm_event_evaluation
																																LEFT JOIN hrm_event_evaluation_peserta eeps ON eeps.idhrm_event=eep.idhrm_event AND eeps.idhrm_event_evaluation=eep.idhrm_event_evaluation
																																					AND eeps.idpegawai='".$this->session->userdata('idpegawai')."'
																																WHERE eep.idhrm_event='".$id."' AND ee.type='".$tipe."' ORDER BY ee.no_urut";
				//echo $sqlevp;die;
				$data['hrm_event_evaluation_peserta'] = $this->dbx->data($sqlevp,'up');

			}else if (($data["view2"]=="pretest") or ($data["view2"]=="posttest")){
				$sqljawaban="SELECT t.*, j.*,t.idhrm_event_theme,t.replid as idhrm_event_test, j.replid as idhrm_event_test_jawaban,jp.pretest,jp.posttest
	 		 						FROM hrm_event_test t
	 								LEFT JOIN hrm_event_test_jawaban j ON t.replid=j.idhrm_event_test
									LEFT JOIN hrm_event_test_peserta jp ON jp.idhrm_event_test=t.replid AND jp.idhrm_event='".$id."' AND jp.idpegawai='".$this->session->userdata('idpegawai')."'
									WHERE t.idhrm_event_theme='".$data["isi"]->idhrm_event_theme."'";
			 //echo $sqljawaban;die;
				$data['hrm_event_jawaban_peserta'] = $this->dbx->data($sqljawaban,'up');

			}
			return $data;
		}

		public function ubahhadir_db($data,$idhrm_event,$idpegawai) {
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

		public function ubahkonfirmasi_db($data,$idhrm_event,$idpegawai) {
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

		public function simpanpretest_db($data) {
			 //echo print_r(array_values($data));die;
			 	 $this->db->trans_start();
				 $this->db->insert('hrm_event_test_peserta', $data);
				 //echo $this->db->last_query();die;
				 $insert_id = $this->db->insert_id();
				 //echo $this->db->last_query();die;
				 if ($this->db->affected_rows() > 0) {
								$this->db->trans_complete();
								return true;
				 } else {
					 $this->db->trans_complete();
						 return false;
				 }
			}

			public function ubahpretest_db($data,$idhrm_event,$idhrm_event_test) {
			 		//echo var_dump($data);die;
					$this->db->where('idpegawai',$this->session->userdata('idpegawai'));
					$this->db->where('idhrm_event',$idhrm_event);
					$this->db->where('idhrm_event_test',$idhrm_event_test);
			 		$this->db->update('hrm_event_test_peserta', $data);
					//echo $this->db->last_query();die;
			 		if ($this->db->_error_number() == 0) {
			 		  return true;
			 		} else {
			 		  return false;
			 		}
			 	}

			public function hapuspretest_db($idhrm_event,$idpegawai) {
				// Query to check whether username already exist or not
				$this->db->where('idhrm_event',$idhrm_event);
				$this->db->where('idpegawai',$idpegawai);
				$this->db->delete('hrm_event_test_peserta');
				if ($this->db->_error_number() == 0) {
					return true;
				} else {
						return false;
				}
			}

		public function updatetestpeserta_db($tipe,$id,$total){
			//if ($tipe=="pretest"){
				$sqltest="SELECT COUNT(tp.replid) as jml
									FROM hrm_event_test_peserta tp
									INNER JOIN hrm_event_test_jawaban tj ON tp.idhrm_event_test=tj.idhrm_event_test AND tp.".$tipe."=tj.replid
									WHERE tj.benar=1 AND tp.idhrm_event='".$id."' AND tp.idpegawai='".$this->session->userdata('idpegawai')."'";
			//}
			//echo $sqltest;
			$isi=$this->dbx->rows($sqltest);
			$nilai=($isi->jml/$total)*100;
			$sqlupdate="UPDATE hrm_event_peserta SET ".$tipe."='".$nilai."' WHERE idhrm_event='".$id."' AND idpegawai='".$this->session->userdata('idpegawai')."'";
			$this->db->query($sqlupdate);
			if ($this->db->_error_number() == 0) {
				return true;
			} else {
					return false;
			}
			//$query2=$this->db->query($sql2);
	  }

		public function simpanskorpeserta_db($data) {
			 //echo print_r(array_values($data));die;

			 $this->db->trans_start();
				 $this->db->insert('hrm_event_evaluation_peserta', $data);
				 $insert_id = $this->db->insert_id();
				 //echo $this->db->last_query();die;
				 if ($this->db->affected_rows() > 0) {
								$this->db->trans_complete();
								return true;
				 } else {
					 $this->db->trans_complete();
						 return false;
				 }
			}

			public function hapusskorpeserta_db($idhrm_event,$idpegawai,$tipe) {
		    // Query to check whether username already exist or not
				$this->db->where('tipe',$tipe);
				$this->db->where('idhrm_event',$idhrm_event);
				$this->db->where('idpegawai',$idpegawai);
		    $this->db->delete('hrm_event_evaluation_peserta');
		    if ($this->db->_error_number() == 0) {
		    	return true;
		    } else {
		        return false;
		    }
	    }
}
?>
