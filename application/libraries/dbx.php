<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
Class dbx extends CI_Model {

	public function checkpage($role,$page) { // for singlerow with many column
			if ($role<>""){
					$sql="SELECT * FROM hrm_role_map rm
								INNER JOIN hrm_menu m ON m.replid=rm.submenu_id
								WHERE rm.role_id IN (".$role.") AND m.pages='".$page."' ";
					//echo $sql;die;
					$query=$this->db->query($sql);
					if ($query->num_rows() > 0) {
							return true;
						 //echo $query->row();
					} else {
							return false;
					}
		 }else{
			 return false;
		 }
	}

	public function tablecolumn($table){
		$column="";
		$sql="SELECT CONCAT ('NULL as ',COLUMN_NAME) as columnname FROM information_schema.columns
									WHERE table_schema='".$this->db->database."'
									AND table_name='".$table."'";
		$query=$this->db->query($sql);
		if ($query->num_rows() > 0) {
				foreach($query->result() as $row ){
					if($column<>""){
						$column=$column.','.$row->columnname;
					}else {
						$column=$column.$row->columnname;
					}
				}
		}
		return $column;
	}

	public function rowscsv($sql){
		$column=NULL;
		$query=$this->db->query($sql);
		if ($query->num_rows() > 0) {
				foreach($query->result() as $row ){
					if($column<>""){
						$column=$column.','.$row->var;
					}else {
						$column=$column.$row->var;
					}
				}
		}
		return $column;
	}

	public function data($sql) {
      	$query=$this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }
    }

    public function rows($sql) { // for singlerow with many column
      	$query=$this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->row();
           //echo $query->row();
        } else {
            return null;
        }
    }

		public function singlerow($sql) { // for single data only
      	$query=$this->db->query($sql);
        if ($query->num_rows() > 0) {
						$rows=$query->row();
						return $rows->isi;
        } else {
            return null;
        }
    }

    public function opt($sql,$ucase='',$pillih="") {
    	$opt=NULL;
      	$query=$this->db->query($sql);
        if ($query->num_rows() > 0) {
            foreach($query->result() as $row ){
	            if ($ucase=='up'){
		            $opt[$row->replid] = strtoupper($row->nama);
	            }else if ($ucase=='lower'){
	            	$opt[$row->replid] = strtolower($row->nama);
	            }else if ($ucase=='none'){
	            	$opt[$row->replid] = $row->nama;
	            }

	            else{
	            	$opt[$row->replid] = ucfirst(strtolower($row->nama));
	            }
	        }
					if ($pillih<>1){
	        	$opt = $this->p_c->arraymerge(array('' => 'Pilih...'), $opt);
					}
	        return $opt;
        } else { //numrows
            $opt = $this->p_c->arraymerge(array('' => 'Pilih...'), $opt);
            return $opt;
        }
				//echo var_dump($opt);die;
    }

		public function cekjadwal($idkeg,$idsiswa) {
				$CI =& get_instance();
				$sql="SELECT k.*,DATE_FORMAT(k.tgl_mulai,'%H:%i') as jam_mulai,DATE_FORMAT(k.tgl_mulai,'%H:%i') as jam_akhir
										,kls.kelas as kelastext,kls.nipwali,kls.idwali
							FROM kegiatan k
							LEFT JOIN kelas kls ON kls.replid=k.kelas_id
							WHERE k.keg_id='".$idkeg."' AND k.siswa_id='".$idsiswa."' ORDER BY k.tgl_mulai,k.created_date DESC LIMIT 1";
				//echo $sql;die;
				$query=$this->db->query($sql);
				if ($query->num_rows() > 0) {
					$rows=$query->row();
					$jadwal=$rows->aktif.$CI->p_c->tgl_indo($rows->tgl_mulai)." s/d ".$CI->p_c->tgl_indo($rows->tgl_akhir);
					if($rows->kelastext<>""){
						$jadwal=$jadwal."<br/>Dikelas ".$rows->kelastext;
						$jadwal=$jadwal."<br/>Petugas ".$this->getpegawai($rows->idwali,0,1);
					}else{
						$jadwal=$jadwal."<br/>Petugas ".$this->getpegawai($rows->idpegawai,0,1);
					}
					return $jadwal;
				} else {
						return null;
				}
  	}

		public function tambahdata($table,$data) {
	 			$this->db->trans_start();
	 			$this->db->insert($table, $data);
	 			$insert_id = $this->db->insert_id();
				//echo $this->db->last_query();die;
	 			if ($this->db->affected_rows() > 0) {
	 						 $this->db->trans_complete();
	 						 return $insert_id;
	 			} else {
	 				$this->db->trans_complete();
	 					return false;
	 			}
	 	 }

		 public function ubahdata($table,$data,$row,$id) {
	 		//echo var_dump($data);die;
	 		$this->db->where($row,$id);
	 		$this->db->update($table, $data);
			//echo $this->db->last_query();die;
	 		if ($this->db->_error_number() == 0) {
	 		  return true;
	 		} else {
	 		  return false;
	 		}
	 	}

		 public function hapusdata($table,$row,$id) {
	 	    $this->db->where($row,$id);
	 	    $this->db->delete($table);
				//echo $this->db->last_query();die;
	 	    if ($this->db->_error_number() == 0) {
	 	    	return true;
	 	    } else {
	 	        return false;
	 	    }
     }

		 public function ubahstatus($table,$row,$id,$rowstatus,$status) {
			 $data = array(
				 $rowstatus=> $status,
				 "modified_date"=> $this->cts(),
				 "modified_by"=> $this->session->userdata('idpegawai')
			 	);
				//echo var_dump($data);die;
				 $this->db->where($row,$id);
				 $this->db->update($table, $data);
				 //echo $this->db->last_query();die;
				 if ($this->db->_error_number() == 0) {
					 return true;
				 } else {
					 return false;
				 }
     }

    public function departemen_show($var){
		$dept="";
		if($var<>""){
			$sql = "select * from departemen where replid IN (".$var.")";
			$query = $this->db->query($sql);

	        foreach($query->result() as $row)
	        {
	        	if ($dept<>""){$dept=$dept.",";}
	        	$dept=$dept.$row->departemen;
	        }
	        return $dept;
	     }else{return NULL;}

	}

	public function role_show($var,$link="",$up="1"){
		$role="";
		if($var<>""){
			$sql = "select * from role where replid IN (".$var.")";
			$query = $this->db->query($sql);

	        foreach($query->result() as $row)
	        {
	        	if ($role<>""){$role=$role.", ";}
						if ($up<>1){$roletext=$row->role;}else{$roletext=strtoupper($row->role);}

						if ($link){
		        	$role=$role."<a href=".site_url('hrm_role/view/'.$row->replid).">".$roletext."</a>";
	        	}else{
		        	$role=$role.$row->role;
	        	}

	        }
	        return $role;
	     }else{return NULL;}

	}

	public function company_show($var,$link="",$up="1"){
		$company="";
		if($var<>""){
			$sql = "select * from hrm_company where replid IN (".$var.")";
			$query = $this->db->query($sql);

	        foreach($query->result() as $row)
	        {
	        	if ($company<>""){$company=$company.", ";}
						if ($up<>1){$companytext=$row->nama;}else{$companytext=strtoupper($row->nama);}

						if ($link){
		        	$company=$company.$companytext;
	        	}else{
		        	$company=$company.$row->nama;
	        	}

	        }
	        return $company;
	     }else{return NULL;}

	}

	public function kodematerial($var){
		/*
		$sql = "select kode from inventory_kelompok where replid IN (".$var.")";
		$query = $this->db->query($sql);
		$rows=$query->row();
		*/

		//WHERE LEFT(kode,5) = '".$rows->kode."'
		$sql2="	SELECT LPAD(RIGHT(max(RIGHT(kode,5)),5)+1,5,'0') as nourut
				FROM inventory_material";
		$query2 = $this->db->query($sql2);
		$rows2=$query2->row();
		//$rows->kode.
		if ($rows2->nourut<>NULL) {
			$kodematerial=$rows2->nourut;
		}else{
			$kodematerial='0001';
		}
		return $kodematerial;
	}

	public function kodekelompok(){
		$sql2="	SELECT CONCAT('1',LPAD(RIGHT(max(RIGHT(kode,3)),3)+1,3,'0')) as nourut FROM inventory_kelompok";
		$query2 = $this->db->query($sql2);
		$rows2=$query2->row();

		//if ($rows2->nourut<>""){
		if ($rows2->nourut<>NULL) {
			$kodekelompok=$rows2->nourut;
		}else{
			$kodekelompok='1001';
		}
		return $kodekelompok;
	}

	public function date_string($var){
		$sql = "select STR_TO_DATE('".$var."','%m/%d/%Y %h:%i %p') as tgl";
		$query = $this->db->query($sql);
		$rows=$query->row();
		return $rows->tgl;

	}
	public function cts(){
		$sql = "select NOW() as tgl";
		$query = $this->db->query($sql);
		$rows=$query->row();
		return $rows->tgl;

	}

	public function tanggalbatas($tanggal,$periode,$status){
		$CI =& get_instance();
		$sql = "SELECT DATE_ADD('".$tanggal."',INTERVAL '".$periode."' DAY) as batas,DATEDIFF(DATE_ADD('".$tanggal."',INTERVAL '".$periode."' DAY),NOW()) as sisahari ";
		$query = $this->db->query($sql);
		$rows=$query->row();
		if(($rows->sisahari<1) AND ($status<>"4")){
				return '<small class="badge bg-red">'.$CI->p_c->tgl_indo($rows->batas).'</small>';
		}else{
				return $CI->p_c->tgl_indo($rows->batas);
		}
	}

	public function next_node($id,$modul){
		if($id<>""){
			$sql = "SELECT next_node FROM hrm_loa WHERE node='".$id."' AND idmodul='".$modul."'";
			$query = $this->db->query($sql);
			$rows=$query->row();
	        return $rows->next_node;
	     }else{return NULL;}

	}

	public function release_node($approver,$modul){
		if($approver<>""){
			$sql = "SELECT node as next_node
					FROM hrm_loa
					WHERE idmodul='".$modul."'
						AND idjabatan_grup=(SELECT j.idjabatan_grup FROM hrm_pegawai_kontrak pk
												INNER JOIN hrm_jabatan j ON pk.idjabatan=j.replid
												WHERE pk.replid='".$approver."')
						AND default_node=1 LIMIT 1";
			$query = $this->db->query($sql);
			$rows=$query->row();
			//echo $sql;die;
			return $rows->next_node;
	     }else{return NULL;}

	}

	public function randomchar($var,$alphabet=""){
		if ($alphabet<>1){
			$str="0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUPWXYZ!@#$%^&*()_+{}:|\=-,.<>/?";
		}else{
			$str="0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUPWXYZ@#$%&*+?";
		}
		$randomchar=substr(str_shuffle(str_repeat($str, $var)), 0, $var);
		return $randomchar;

	}

	public function ns_predikat($jenjang,$var,$predikattipe){
			$sql = "SELECT predikat FROM ns_predikat WHERE iddepartemen='".$jenjang."' AND dari<='".$var."' AND sampai>='".$var."' AND predikattipe='".$predikattipe."'";
			//echo $sql;die;
			$query = $this->db->query($sql);
			$rows=$query->row();
			if ($query->num_rows() > 0) {
				return $rows->predikat;
			}else{
				return "-";
			}

	}

	public function ns_predikat_text_lpd($jenjang,$var,$predikattipe){
			$sql = "SELECT deskripsi FROM ns_predikat WHERE iddepartemen='".$jenjang."' AND dari<='".$var."' AND sampai>='".$var."' AND predikattipe='".$predikattipe."'";
			$query = $this->db->query($sql);
			$rows=$query->row();
			if ($query->num_rows() > 0) {
				return $rows->deskripsi;
			}else{
				return "-";
			}

	}

	public function ns_predikat_graph($var,$idpengembangandiri){

			/*
			$sql = "SELECT np.predikatgraph FROM ns_predikatgraph np
					INNER JOIN ns_pengembangandirivariabel npv ON np.idpengembangandiri=npv.replid
					WHERE npv.pengembangandirivariabel='".$idpengembangandiri."' AND (np.dari<='".$var."' AND np.sampai>='".$var."')";
			*/
			$sql = "SELECT np.predikatgraph FROM ns_predikatgraph np
							WHERE np.pengembangandiritext='".$idpengembangandiri."' AND (np.dari<='".$var."' AND np.sampai>='".$var."')";

			//echo $sql;
			$query = $this->db->query($sql);
			$rows=$query->row();
			if ($query->num_rows() > 0) {
				return $rows->predikatgraph;
			}else{
				return "-";
			}

	}

	public function ns_predikat_text_graph($var,$idpengembangandiri){
			//$sql = "SELECT deskripsigraph FROM ns_predikat WHERE dari<='".$var."' AND sampai>='".$var."'";
			$sql = "SELECT np.deskripsi FROM ns_predikatgraph np
					INNER JOIN ns_pengembangandirivariabel npv ON np.idpengembangandiri=npv.replid
					WHERE npv.pengembangandirivariabel='".$idpengembangandiri."' AND (np.dari<='".$var."' AND np.sampai>='".$var."')";

			$query = $this->db->query($sql);
			$rows=$query->row();
			if ($query->num_rows() > 0) {
				return $rows->deskripsi;
			}else{
				return "-";
			}

	}

	function getHeader($dep)
	{
		$head="";
		$sql = "SELECT * FROM identitas WHERE departemen='".$dep."'";
		$query = $this->db->query($sql);

		if ($query->num_rows() > 0) {
			$rows=$query->row();
			//$replid = $rows->replid;
			$nama = $rows->nama;
			$alamat1 = $rows->alamat1;
			$alamat2 = $rows->alamat2;
			$telp1 = $rows->telp1;
			$telp2 = $rows->telp2;
			$telp3 = $rows->telp3;
			$telp4 = $rows->telp4;
			$fax1 = $rows->fax1;
			$fax2 = $rows->fax2;
			$situs = $rows->situs;
			$email = $rows->email;
			$head =	"<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">";
			$head .="	<tr>";
			$head .="		<td width=\"20%\" align=\"center\">";
			$head .="				<font size=\"2\"><strong>".$nama."</strong></font><br />"."				";

			//$head .="		<img src=\"".$full_url."lib/header.php?replid=".$replid."&table=identitas\" />";
			$head .="		<img src=".base_url()."images/logo_all.png \" height='60'><br/>";
			//$head .="Belajar Lebih Cerdas Kreatif Dan Ceria<br />";
			//if ($alamat2 <> "" && $alamat1 <> ""){$head .="				Lokasi 1: ";}
			if ($alamat1 != ""){$head .=				$alamat1." ".$alamat2;}

			if ($telp1 != "" || $telp2 != ""){$head .="				<br>Telp. ";}
			if ($telp1 != "" ){$head .=				$telp1;}
			if ($telp1 != "" && $telp2 != ""){$head .="				, ";}
			if ($telp2 != "" ){$head .=				$telp2;}
			if ($fax1 != "" ){$head .="				&nbsp;&nbsp;Fax. ".$fax1."&nbsp;&nbsp;";}

			/*
			if ($alamat2 <> "" && $alamat1 <> "") {
				$head .="				<br>";
				$head .="				Lokasi 2: ";
				$head .=				$alamat2;
			}
			*/

			if ($telp3 != "" || $telp4 != ""){$head .="				<br>Telp. ";}
			if ($telp3 != "" ){$head .=				$telp3;}
			if ($telp3 != "" && $telp4 != ""){$head .="				, ";}
			if ($telp4 != "" ){$head .=				$telp4;}
			if ($fax2 != "" ){$head .="				&nbsp;&nbsp;Fax. ".$fax2;}
			if ($situs != "" || $email != ""){$head .="				<br>";}
			if ($situs != "" ){$head .="				Website: ".$situs."&nbsp;&nbsp;";}
			if ($email != "" ){$head .="				Email: ".$email;}

			$head .="			</strong>";
			$head .="			</td>";
			$head .="		</tr>";
			$head .="		<tr>";
			$head .="			<td colspan=\"2\"><hr width=\"100%\" /></td>";
			$head .="		</tr>";
			$head .="		</table>";
			//$head .="	<br />";
	  } //if numrows

		echo $head;
	}

	public function blobimage($table,$replid){
		if(($table<>"") and ($replid<>"") ){
			$sql = "SELECT foto FROM ".$table." WHERE departemen = '".$replid."'";
			$query = $this->db->query($sql);

			if ($query->num_rows() > 0) {
				$rows=$query->row();
				//header("Content-type: image/jpeg");
	 			//print($rows->foto);
			}else{
				echo "-";
			}
		}else{
			echo "-";
		}
	}

	public function sessionjenjangtext(){
		if ($this->session->userdata('dept')<>""){
			$sql = "SELECT departemen FROM departemen WHERE replid IN (".$this->session->userdata('dept').")";
			$query = $this->db->query($sql);
			$deptext="";
			foreach($query->result() as $row)
			{
					if ($deptext<>""){$deptext=$deptext.",";}
					$deptext=$deptext."'".$row->departemen."'";
			}
			return $deptext;
		}else{
			return null;
		}
		/*
		if($var<>""){
			$sql = "select * from role where replid IN (".$var.")";
			$query = $this->db->query($sql);

	        foreach($query->result() as $row)
	        {
	        	if ($role<>""){$role=$role.", ";}
	        	if ($link){
		        	$role=$role."<a href=".site_url('hrm_role/view/'.$row->replid).">".strtoupper($row->role)."</a>";
	        	}else{
		        	$role=$role.$row->role;
	        	}

	        }
	        return $role;
	     }else{return NULL;}
			 */
	}

public function updatestock($id,$jumlah,$unit,$plus) {
	if ($plus==1){
		$sql_update="UPDATE inventory_material SET stock=(stock+".$jumlah.") WHERE replid='".$id."'";
	}else{
		$sql_update="UPDATE inventory_material SET stock=(stock-".$jumlah.") WHERE replid='".$id."'";
	}
	return $this->db->query($sql_update);
}

function getpegawai($replid,$nip=0,$shownip=0)
{
	if ($nip<>1){
		$sql = "SELECT * FROM pegawai
						WHERE replid='".$replid."'";
	}else{
		$sql = "SELECT * FROM pegawai
						WHERE nip='".$replid."'";
	}

	$query = $this->db->query($sql);
	$pegawaitext="";
	if ($query->num_rows() > 0) {
			$rows=$query->row();
			//$replid = $rows->replid;
			if ($rows->nama<>""){
				$pegawaitext=ucwords(strtolower($rows->nama));
				if ($rows->gelarawal<>""){
					$pegawaitext=$rows->gelarawal.'. '.$pegawaitext;
				}
				if ($rows->gelarakhir<>""){
					$pegawaitext=$pegawaitext.', '.$rows->gelarakhir;
				}
				if($shownip==1){
					$pegawaitext="[".$rows->nip."] ".$pegawaitext;
				}
			}else{
				$pegawaitext="";
			}


	}
	return $pegawaitext;
}

 function getpegawaittd($replid,$nip=0,$shownip=0)
 {
	 if ($nip<>1){
		 $sql = "SELECT * FROM pegawai
						 WHERE replid='".$replid."'";
	 }else{
		 $sql = "SELECT * FROM pegawai
						 WHERE nip='".$replid."'";
	 }

	 $query = $this->db->query($sql);
	 $pegawaitext="";
	 if ($query->num_rows() > 0) {
			 $rows=$query->row();
			 $pegawaitext=$rows->ttd;
	 }
	 return $pegawaitext;
}

	function getheadercompany($idcompany)
	{
		$head="";
		$sql = "SELECT * FROM hrm_company WHERE replid='".$idcompany."'";
		//echo $sql;die;
		$query = $this->db->query($sql);

		if ($query->num_rows() > 0) {
			$rows=$query->row();
			/*
			if ($rows->company_code<>""){
				$head = $head."<b>".$rows->company_code."</b>"."<br/>";
			}
			*/
			if ($rows->nama<>""){
				$head = $head.$rows->nama."<br/>";
			}else {
					$head = $head."<br/>";
			}

			if ($rows->street<>""){
				$head = $head.$rows->street;
			}
			if ($rows->street<>""){
				$head = $head." ".$rows->zip."<br/>";
			}else {
					$head = $head."<br/>";
			}

			if (($rows->city<>"0") and ($rows->city<>"")){
				$head = $head.$rows->city."";
			}
			if (($rows->country<>"0") and ($rows->country<>"")){
					$head = $head." ".$rows->country."<br/>";
			}

			if ($rows->phone<>""){
					$head = $head."Telp: ".$rows->phone;
			}
			if ($rows->fax<>""){
				$head = $head." Fax: ".$rows->fax."<br/>";
			}else {
					$head = $head."<br/>";
			}
			if ($rows->website<>""){
				$head = $head."Website: ".$rows->website;
			}
			if ($rows->email<>""){
				$head = $head." Email: ".$rows->email;
			}
		} //if numrows

		echo $head;
	}

	function getkopsuratcompany($idcompany)
	{
		$head="<center>";
		$sql = "SELECT * FROM hrm_company WHERE replid='".$idcompany."'";
		//echo $sql;die;
		$query = $this->db->query($sql);

		if ($query->num_rows() > 0) {
			$rows=$query->row();
			/*
			if ($rows->company_code<>""){
				$head = $head."<b>".$rows->company_code."</b>"."<br/>";
			}
			*/
			$head = $head."<h4>".$rows->nama."</h4>";
			if ($rows->logo<>""){
				$head = $head."<img src='".base_url()."images/".$rows->logo."' height='50px'>";
			}
			$head = $head."<br/>";
			if ($rows->street<>""){
				$head = $head."Alamat: ".$rows->street;
			}
			if ($rows->street<>""){
				$head = $head." ".$rows->zip;
			}
			if (($rows->city<>"0") and ($rows->city<>"")){
				$head = $head.$rows->city."";
			}
			if (($rows->country<>"0") and ($rows->country<>"")){
					$head = $head." ".$rows->country;
			}

			$head = $head."<br/>";

			if ($rows->phone<>""){
					$head = $head."Telp: ".$rows->phone.",";
			}
			if ($rows->fax<>""){
				$head = $head." Fax: ".$rows->fax.",";
			}
			
			if ($rows->website<>""){
				$head = $head." Website: ".$rows->website.",";
			}

			if ($rows->email<>""){
				$head = $head." Email: ".$rows->email;
			}
		} //if numrows
		$head.="<hr style='width:100% !important;' /><br/></center>";
		echo $head;
	}

	function uploadfile($idcompany){
		//load the helper
		$this->load->helper('form');

		//Configure
		//set the path where the files uploaded will be copied. NOTE if using linux, set the folder to permission 777
		$config['upload_path'] = 'uploads/ppkb';
		// set the filter image types
		$config['allowed_types'] = 'gif|jpg|png|docs|pdf|doc|xls|xl';
		$config['encrypt_name'] = TRUE;

		//load the upload library
		$this->load->library('upload', $config);
		$this->upload->initialize($config);

		$this->upload->set_allowed_types('*');

		$data['upload_data'] = '';
		if (!$this->upload->do_upload()) {
			echo $this->upload->display_errors();
			return false;
			die;
		}else{
			return true;

		}
	}

	function qrcodegenerate($imagedir,$name,$link){
		$this->load->library('cqrcode'); //pemanggilan library QR CODE

		$config['cacheable']    = true; //boolean, the default is true
		$config['cachedir']     = $imagedir; //string, the default is application/cache/
		$config['errorlog']     = $imagedir; //string, the default is application/logs/
		$config['imagedir']     = $imagedir; //direktori penyimpanan qr code
		$config['quality']      = true; //boolean, the default is true
		$config['size']         = '1024'; //interger, the default is 1024
		$config['black']        = array(224,255,255); // array, default is array(255,255,255)
		$config['white']        = array(70,130,180); // array, default is array(0,0,0)
		$this->cqrcode->initialize($config);

		$image_name=$name.'.png'; //buat name dari qr code sesuai dengan nim

		//$params['data'] = site_url()."/hrm_event/view/0/3"; //data yang akan di jadikan QR CODE
		$params['data'] = $link;
		$params['level'] = 'H'; //H=High
		$params['size'] = 10;
		$params['savename'] = FCPATH.$config['imagedir'].$image_name; //simpan image QR CODE ke folder assets/images/
		$this->cqrcode->generate($params); // fungsi untuk generate QR CODE
	}

	function getcalonsiswa($replid,$type=""){
		$sql = "SELECT c.*,kcs.kelompok as kelompokcalontext,pps.proses as prosestext,pps.departemen
											,t.tingkat as tingkattext,j.jurusan as jurusantext, kls.kelas as kelastext,ks.kondisi as kondisitext
											,kcs.lamaproses,DATEDIFF(CURRENT_DATE(),c.tanggal_daftar) as lama
											,(TIMESTAMPDIFF(YEAR, c.tgllahir, CURDATE())) as umur
											,CURRENT_DATE() as hariini,ta.tahunajaran,CONCAT(com.kodecabang,d.urutan) as kodecabang,lpad(right(t.tingkat,4),2,'0') as tingkatnis
									FROM calonsiswa c
									INNER JOIN  tahunajaran ta ON c.idtahunajaran = ta.replid
									INNER JOIN departemen d ON d.departemen=ta.departemen
									INNER JOIN hrm_company com ON com.replid=ta.idcompany
									LEFT JOIN  prosespenerimaansiswa pps ON c.idproses = pps.replid
									LEFT JOIN  kelompokcalonsiswa kcs ON kcs.idproses = pps.replid AND c.idkelompok = kcs.replid
									LEFT JOIN  tingkat t ON c.tingkat=t.replid
									LEFT JOIN jurusan j ON j.replid=c.jurusan
									LEFT JOIN  kondisisiswa ks ON ks.replid=c.kondisi
									LEFT JOIN  kelas kls ON c.calon_kelas = kls.replid
							WHERE c.replid='".$replid."'";
		//echo $sql;die;
		$query = $this->db->query($sql);
		$calonsiswatext="";
		if ($query->num_rows() > 0) {
				$rowsiswa=$query->row();
				$datasiswa="<table width='100%' border='0'>";
				$datasiswa=$datasiswa."<tr>
						<th align='left'>
									<label class='control-label' for='minlengthfield'>No. Pendaftaran</label>
									<div class='control-group'>
										<div class='controls'>: "."<a href='".site_url('general/datacalonsiswa/'.$rowsiswa->replid)."' target='_blank'>".$rowsiswa->nopendaftaran."</a>"."</div>
									</div>
							</th></tr>";
				$datasiswa=$datasiswa."<tr>
						<th align='left'>
									<label class='control-label' for='minlengthfield'>Nama Lengkap</label>
									<div class='control-group'>
										<div class='controls'>: ".$rowsiswa->nama."</div>
									</div>
							</th></tr>";
				$datasiswa=$datasiswa."<tr>
						<th align='left'>
									<label class='control-label' for='minlengthfield'>Jenis Kelamin</label>
									<div class='control-group'>
										<div class='controls'>: ".$this->p_c->jk($rowsiswa->kelamin)."</div>
									</div>
							</th></tr>";
				$datasiswa=$datasiswa."<tr>
						<th align='left'>
									<label class='control-label' for='minlengthfield'>Umur</label>
									<div class='control-group'>
										<div class='controls'>: ".$rowsiswa->umur." Tahun </div>
									</div>
							</th></tr>";
				$datasiswa=$datasiswa."<tr>
						<th align='left'>
									<label class='control-label' for='minlengthfield'>Jenjang</label>
									<div class='control-group'>
										<div class='controls'>: ".$rowsiswa->departemen."</div>
									</div>
							</th></tr>";
				$datasiswa=$datasiswa."<tr>
						<th align='left'>
									<label class='control-label' for='minlengthfield'>Tahun Pelajaran</label>
									<div class='control-group'>
										<div class='controls'>: ".$rowsiswa->tahunajaran."</div>
									</div>
							</th></tr>";
				$datasiswa=$datasiswa."<tr>
						<th align='left'>
									<label class='control-label' for='minlengthfield'>Tingkat</label>
									<div class='control-group'>
										<div class='controls'>: ".$rowsiswa->tingkattext."</div>
									</div>
							</th></tr>";
				$datasiswa=$datasiswa."<tr>
						<th align='left'>
									<label class='control-label' for='minlengthfield'>Jurusan</label>
									<div class='control-group'>
										<div class='controls'>: ".$rowsiswa->jurusantext."</div>
									</div>
							</th></tr>";
				$datasiswa=$datasiswa."<tr>
						<th align='left'>
									<label class='control-label' for='minlengthfield'>Program</label>
									<div class='control-group'>
										<div class='controls'>: ".$rowsiswa->kelompokcalontext."</div>
									</div>
							</th></tr>";
				$datasiswa=$datasiswa."<tr>
						<th align='left'>
									<label class='control-label' for='minlengthfield'>Anak Berkebutuhan Khusus</label>
									<div class='control-group'>
										<div class='controls'>: ".$this->p_c->cekaktif($rowsiswa->abk)."</div>
									</div>
							</th></tr>";
				$datasiswa=$datasiswa."</table>";
				if($type<>""){
					return $query->row();
				}else{
					return $datasiswa;
				}
		}else{
			return NULL;
		}
 }

 public function interviewdescription($idcalon) {
	 $sql="SELECT description as isi FROM siswa_konseling WHERE konseling_id=11 AND replidkeg=(SELECT replid FROM kegiatan WHERE siswa_id='".$idcalon."' AND keg_id='9' ORDER BY tgl_mulai DESC LIMIT 1)";
	 return $this->singlerow($sql);
 }

	public function asesmendescription($idcalon) {
		$sql="SELECT description as isi FROM siswa_observasi WHERE description<>'' AND replidkeg=(SELECT replid FROM kegiatan WHERE siswa_id='".$idcalon."' AND keg_id='10' ORDER BY tgl_mulai DESC LIMIT 1)";
		return $this->singlerow($sql);
	}

	public function variabel_company($tipe,$id) {
		$sql="SELECT c.nama as var
						FROM ns_reff_company rc
						INNER JOIN hrm_company c ON c.replid=rc.idcompany
						WHERE rc.tipe='".$tipe."' AND rc.idvariabel='".$id."'";
		$result = $this->dbx->rowscsv($sql);
		return $result;
	}

	public function layanan_show($id){
		$sql="SELECT l.layanan as nama 
			FROM lyn_layanan l 
			INNER JOIN lyn_pegawai_layanan lpl ON l.replid=lpl.idlayanan
			WHERE lpl.idpegawai='".$id."' ORDER BY layanan ";
		$data=$this->data($sql);
		$datatext="";
		foreach((array)$data as $row)
		{
			if ($datatext<>""){ $datatext=$datatext.", "; }
			$datatext=$datatext.$row->nama;
		}
		return $datatext;
	}

	public function grupjadwal_show($id){
		$sql="SELECT l.grupjadwal as nama 
			FROM lyn_grupjadwal l 
			INNER JOIN lyn_pegawai_grupjadwal lpl ON l.replid=lpl.idgrupjadwal
			WHERE lpl.idpegawai='".$id."' ORDER BY grupjadwal ";
		$data=$this->data($sql);
		$datatext="";
		foreach((array)$data as $row)
		{
			if ($datatext<>""){ $datatext=$datatext.", "; }
			$datatext=$datatext.$row->nama;
		}
		return $datatext;
	}

	public function sektor_show($id){
		$sql="SELECT l.sektor as nama 
			FROM lyn_sektor l 
			INNER JOIN lyn_pegawai_sektor lpl ON l.replid=lpl.idsektor
			WHERE lpl.idpegawai='".$id."' ORDER BY sektor ";
		$data=$this->data($sql);
		$datatext="";
		foreach((array)$data as $row)
		{
			if ($datatext<>""){ $datatext=$datatext.", "; }
			$datatext=$datatext.$row->nama;
		}
		return $datatext;
	}

}
?>
