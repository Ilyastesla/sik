<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
Class p_c {

 	public function cekaktif($data){
		if($data<>NULL){
			if ($data != false) {
				return '<small class="badge bg-green">Ya</small>';
			} else {
				return '<small class="badge bg-red">Tidak</small>';
			}
		}else{
			return "-";
		}
	}
  public function cekaktifreport($data){
		if ($data != false) {
			return 'Ya';
		} else {
			return 'Tidak';
		}
	}

  public function bgcolortext($data,$color){
    return '<small class="badge bg-'.$color.'">'.$data.'</small>';
	}

  public function cektrue($data,$var){
    if ($data != false) {
			return '<small class="badge bg-green">'.$var.'</small>';
		} else {
			return '<small class="badge bg-red">'.$var.'</small>';
		}
	}

  public function cekperingatan($var){
		switch ($var) {
      case '1':
        return "<small class='badge bg-yellow'>Peringatan</small>";
        break;
    case '2':
      return "<small class='badge bg-red'>Pindah Program</small>";
      break;
    case '3':
      return "<small class='badge bg-red'>Dicutikan</small>";
      break;
    case '4':
      return "<small class='badge bg-red'>Dikeluarkan</small>";
      break;
    default:
        return "-";
        break;
    }
	}

	public function arraymerge() {
      $arg_list = func_get_args();
      foreach((array)$arg_list as $arg){
          foreach((array)$arg as $K => $V){
              $Zoo[$K]=$V;
          }
      }
    return $Zoo;
    }

  public function arraybreak($array,$separator) {
      $arraytext="";
      foreach((array)$array as $row){
        if ($arraytext<>""){
          $arraytext=$arraytext.$separator.$row->isi;
        }else{
            $arraytext=$arraytext.$row->isi;
        }

      }
    return $arraytext;
  }

  public function rupiah($var){
		$rupiah=number_format ( $var , 2 , "," , "." );
		$rupiah="Rp.".$rupiah.",-";
		return $rupiah;
	}

	public function tgl_indo($tgl){
		if (($tgl<>"") and ($tgl<>"0000-00-00")){
			$tanggal = substr($tgl,8,2);
			$bulan = $this->getBulan(substr($tgl,5,2));
			$tahun = substr($tgl,0,4);
			return $tanggal.' '.$bulan.' '.$tahun;

		} else{ return "-";}
	}

	public function tgl_jam($tgl){
		$arrtgl=explode(" ", $tgl);
		if (($arrtgl[0]<>"") and ($arrtgl[0]<>"0000-00-00")){
			$tanggal = substr($tgl,8,2);
			$bulan = $this->getBulan(substr($tgl,5,2));
			$tahun = substr($tgl,0,4);
			return $tanggal.' '.$bulan.' '.$tahun.' '.$arrtgl[1];

		} else{ return "-";}
	}

	public function tgl_db($tgl){
		if (($tgl<>"") and ($tgl<>"0000-00-00")){
			$tanggal = substr($tgl,0,2);
			$bulan = substr($tgl,3,2);
			$tahun = substr($tgl,6,4);
			return $tahun.'-'.$bulan.'-'.$tanggal;
		}else{
			return NULL;
		}
	}
	public function tgl_form($tgl){
		if (($tgl<>"") and ($tgl<>"0000-00-00")){
			$tanggal = substr($tgl,8,2);
			$bulan = substr($tgl,5,2);
			$tahun = substr($tgl,0,4);
			return $tanggal.'-'.$bulan.'-'.$tahun;
		}else{
			return NULL;
		}
	}
  public function arraybulan(){
    return array("01"=>"Januari","02"=>"Februari","03"=>"Maret","04"=>"April","05"=>"Mei","06"=>"Juni","07"=>"Juli","08"=>"Agustus","09"=>"September","10"=>"Oktober","11"=>"November","12"=>"Desember");
  }
  public function getBulan($bln){
		switch ($bln){
			case "01":
				return "Januari";
				break;
			case "02":
				return "Februari";
				break;
			case "03":
				return "Maret";
				break;
			case "04":
				return "April";
				break;
			case "05":
				return "Mei";
				break;
			case "06":
				return "Juni";
				break;
			case "07":
				return "Juli";
				break;
			case "08":
				return "Agustus";
				break;
			case "09":
				return "September";
				break;
			case "10":
				return "Oktober";
				break;
			case "11":
				return "November";
				break;
			case "12":
				return "Desember";
				break;
		}
	}

	public function jk($var){
		if(trim(strtolower($var))=='l'){
			return 'Laki-Laki';
		}elseif (trim(strtolower($var))=='p'){
			return 'Perempuan';
		}else {return '-';}
	}

	public function arrdump($var){
		$var_x="";
		foreach((array)$var as $row){
			if ($var_x<>""){$var_x=$var_x.',';}
			$var_x=$var_x.$row;
		}
		return $var_x;
	}

	public function kataangka($num) {
		switch($num) {
			case 0:	return "";			break;
			case 1:	return "Satu";		break;
			case 2:	return "Dua";		break;
			case 3:	return "Tiga";		break;
			case 4:	return "Empat";		break;
			case 5:	return "Lima";		break;
			case 6:	return "Enam";		break;
			case 7:	return "Tujuh";		break;
			case 8:	return "Delapan";	break;
			case 9:	return "Sembilan";	break;
		}
	}

	public function kalimatuang($uang,$rp="1") {
		if ($uang == 0)
			return "Nol";
		$sUang = (string)$uang;
		$nAngka = strlen($sUang);

		for($i = 0; $i < $nAngka; $i++) {
			$d = substr($sUang, $i, 1);
			$digit[$i] = $d;
		}

		$kalimat = "";
		$i = 0;
		$nAwalanNol = 0;
		while ($i < $nAngka) {
			$d = (int)$digit[$i];
			$nSisaDigit = $nAngka - $i - 1;

			$kata = "";
			if ($d == 1) {
				switch($nSisaDigit) {
					case 0:
						$kata = "Satu"; break;
					case 1:
					case 4:
					case 7:
					case 10:
						$i++;
						$d = (int)$digit[$i];
						$nSisaDigit--;
						if ($d == 0) {
							$kata = "Sepuluh ";
						} else if ($d == 1) {
							$kata = "Sebelas ";
						} else {
							$kata = $this->kataangka($d) . " Belas ";
						}
						switch($nSisaDigit) {
							case 3:
								$kata = $kata . " Ribu ";
								break;
							case 6:
								$kata = $kata . " Juta ";
								break;
							case 9:
								$kata = $kata . " Milyar ";
								break;
						}
						break;
					case 2:
					case 5:
					case 8:
						$kata = "Seratus "; break;
					case 3:
						$kata = "Seribu "; break;
					case 6:
						$kata = "Satu Juta "; break;
					case 9:
						$kata = "Satu Milyar "; break;
				}
			} else if ($d != 0) {
				switch($nSisaDigit) {
					case 0:
						$kata = $this->kataangka($d); break;
					case 1:
					case 4:
					case 7:
					case 10:
					case 13:

						$kata = $this->kataangka($d) . " Puluh ";
						if ($digit[$i + 1] == 0) {
							if ($nSisaDigit - 1 == 3)
								$kata = $kata . " Ribu ";
							else if ($nSisaDigit - 1 == 6)
								$kata = $kata . " Juta ";

							$i++;
						}
						break;
					case 2:
					case 5:
					case 8:
					case 11:
					case 14:
						$kata = $this->kataangka($d) . " Ratus ";
						break;
					case 3:
						$kata = $this->kataangka($d) . " Ribu ";
						break;
					case 6:
						$kata = $this->kataangka($d) . " Juta ";
						break;
					case 9:
						$kata = $this->kataangka($d) . " Milyar ";
						break;
					case 12:
						$kata = $this->kataangka($d) . " Trilyun ";
						break;
				}
			} else {
				$nAwalanNol++;
				switch($nSisaDigit) {
					case 3:
						if ($nAwalanNol < 3) {
							$kata = "Ribu ";
							$nAwalanNol = 0;
						}
						break;
					case 6:
						if ($nAwalanNol < 3) {
							$kata = "Juta ";
							$nAwalanNol = 0;
						}
						break;
					case 9:
						if ($nAwalanNol < 3) {
							$kata = "Milyar ";
							$nAwalanNol = 0;
						}
						break;
				}
			}

			$kalimat = $kalimat . $kata;
			$i++;
		}
		if ($rp==1){return $kalimat . " Rupiah";
		}else{return $kalimat;}

	}

	public function kalimatrapor($uang) {
		if ($uang == 0)
			return "Nol";
		$sUang = (string)$uang;
		$nAngka = strlen($sUang);

		for($i = 0; $i < $nAngka; $i++) {
			$d = substr($sUang, $i, 1);
			$digit[$i] = $d;
		}

		$kalimat = "";
		$i = 0;
		$nAwalanNol = 0;
		while ($i < $nAngka) {
			$d = (int)$digit[$i];
			$nSisaDigit = $nAngka - $i - 1;

			$kata = "";
			if ($d == 1) {
				switch($nSisaDigit) {
					case 0:
						$kata = "Satu"; break;
					case 1:
					case 4:
					case 7:
					case 10:
						$i++;
						$d = (int)$digit[$i];
						$nSisaDigit--;
						if ($d == 0) {
							$kata = "Sepuluh ";
						} else if ($d == 1) {
							$kata = "Sebelas ";
						} else {
							$kata = $this->kataangka($d) . " Belas ";
						}
						switch($nSisaDigit) {
							case 3:
								$kata = $kata . " Ribu ";
								break;
							case 6:
								$kata = $kata . " Juta ";
								break;
							case 9:
								$kata = $kata . " Milyar ";
								break;
						}
						break;
					case 2:
					case 5:
					case 8:
						$kata = "Seratus "; break;
					case 3:
						$kata = "Seribu "; break;
					case 6:
						$kata = "Satu Juta "; break;
					case 9:
						$kata = "Satu Milyar "; break;
				}
			} else if ($d != 0) {
				switch($nSisaDigit) {
					case 0:
						$kata = $this->kataangka($d); break;
					case 1:
					case 4:
					case 7:
					case 10:
					case 13:

						$kata = $this->kataangka($d) . " Puluh ";
						if ($digit[$i + 1] == 0) {
							if ($nSisaDigit - 1 == 3)
								$kata = $kata . " Ribu ";
							else if ($nSisaDigit - 1 == 6)
								$kata = $kata . " Juta ";

							$i++;
						}
						break;
					case 2:
					case 5:
					case 8:
					case 11:
					case 14:
						$kata = $this->kataangka($d) . " Ratus ";
						break;
					case 3:
						$kata = $this->kataangka($d) . " Ribu ";
						break;
					case 6:
						$kata = $this->kataangka($d) . " Juta ";
						break;
					case 9:
						$kata = $this->kataangka($d) . " Milyar ";
						break;
					case 12:
						$kata = $this->kataangka($d) . " Trilyun ";
						break;
				}
			} else {
				$nAwalanNol++;
				switch($nSisaDigit) {
					case 3:
						if ($nAwalanNol < 3) {
							$kata = "Ribu ";
							$nAwalanNol = 0;
						}
						break;
					case 6:
						if ($nAwalanNol < 3) {
							$kata = "Juta ";
							$nAwalanNol = 0;
						}
						break;
					case 9:
						if ($nAwalanNol < 3) {
							$kata = "Milyar ";
							$nAwalanNol = 0;
						}
						break;
				}
			}

			$kalimat = $kalimat . $kata;
			$i++;
		}
		return $kalimat;

	}

	public function romawi($num) {
		switch($num) {
			case 0:	return "";			break;
			case 1:	return "I";		break;
			case 2:	return "II";		break;
			case 3:	return "III";		break;
			case 4:	return "IV";		break;
			case 5:	return "V";		break;
			case 6:	return "VI";		break;
			case 7:	return "VII";		break;
			case 8:	return "VIII";	break;
			case 9:	return "IX";	break;
			case 10:	return "X";	break;
      case 11:	return "XI";	break;
      case 12:	return "XII";	break;
		}
	}
  public function toalfabet($var){
      $alphabet = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
      return $alphabet[$var];
  }


  public function checkbox_more($nama,$opt,$var,$ro=""){
		//$checked
    $vararr=NULL;
		if ((trim($var)<>"") or (trim($var)<>0)) {
			$vararr = explode(",", $var);
		}
		$cb=0;$checked=false;
    //echo var_dump($opt);die;
		foreach((array)$opt as $rowxx) {
			if ((trim($var)<>"") or (trim($var)<>0)) {
				if (in_array($rowxx->replid,$vararr)) {
						$checked=true;
				}else{$checked=false;}
			}else{$checked=false;}
			//if ($cb>0){echo "&nbsp;&nbsp;";}

			$datacb = array(
						    'name'        => $nama.'[]',
						    'id'          => $nama,
						    'value'       => $rowxx->replid,
						    'checked'     => $checked
					    );
		    if ($ro<>""){
			    $datacb = $this->arraymerge(array('disabled' => $ro), $datacb);
		    }
			echo form_checkbox($datacb)."&nbsp;&nbsp;".$rowxx->nama."<br/>";
			$cb++;
		}
	}

	public function checkbox_one($nama,$opt,$dis=""){
		$cb=0;$checked=false;$ro="";
		foreach((array)$opt as $rowxx) {
			/*
			if ((trim($var)<>"") or (trim($var)<>0)) {
				if (in_array($rowxx->replid,$vararr)) {
						$checked=true;
				}else{$checked=false;}
			}else{$checked=false;}
			if ($cb>0){echo "&nbsp;&nbsp;";}
			*/
			$datacb = array(
						    'name'        => $nama.'[]',
						    'id'          => $nama,
						    'value'       => $rowxx->replid,
						    'checked'     => $rowxx->checked
					    );
	        if ($dis<>""){
			    $datacb = $this->arraymerge(array('disabled' => $dis), $datacb);
		    }
			echo form_checkbox($datacb)."&nbsp;&nbsp;".strtoupper($rowxx->nama)."<br/>";
			$cb++;
		}
	}

  public function radio_custom($nama,$opt,$var,$ro=""){
		$cb=0;$checked=false;
		foreach((array)$opt as $rowxx) {
      $datarb = array(
						    'name'        => $nama,
						    'id'          => $nama,
						    'value'       => $rowxx->replid,
                'style'       =>'margin:4px !important;',
						    'checked'     => ($rowxx->replid==$var)
					    );
		    if ($ro<>""){
			    $datarb = $this->arraymerge(array('disabled' => $ro), $datarb);
		    }
      echo form_radio($datarb)."&nbsp;&nbsp;".$rowxx->nama."<br/>";
			$cb++;
		}
	}

  public function combotime($name,$hour,$minute,$datarulerequired){
    $combotime="<select name='".$name."hour' id='".$name."hour' data-rule-required='".$datarulerequired."' style='width:70px' >";
    $i=0;
    for ($i;$i<=24;$i++){
      if($hour==$i){
        $select="selected='selected'";
      }else{
        $select="";
      }
      $combotime=$combotime."<option value='".sprintf("%02d", $i)."' ".$select.">".sprintf("%02d", $i)."</option>";
    }
    $combotime=$combotime."</select>&nbsp;";


    $combotime=$combotime."<select name='".$name."minute' id='".$name."minute' data-rule-required='".$datarulerequired."' style='width:70px' >";
    $i=0;
    for ($i;$i<=59;$i++){
      if($minute==$i){
        $select="selected='selected'";
      }else{
        $select="";
      }
      $combotime=$combotime."<option value='".sprintf("%02d", $i)."' ".$select.">".sprintf("%02d", $i)."</option>";
    }
    $combotime=$combotime."</select>&nbsp;";

    return $combotime;
  }
}
?>
