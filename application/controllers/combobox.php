<?php

Class combobox extends CI_Controller
{
function __construct(){
	parent::__construct();
		$this->load->database();
		$this->load->helper(array('url'));
		$this->load->model('combobox_db');
	}

	function ambil_data(){
		$modul=$this->input->post('modul');
		$id=$this->input->post('id');

		if($modul=="idpropinsi"){
			echo $this->combobox_db->idpropinsi($id);
		}
		if($modul=="idkota"){
			echo $this->combobox_db->idkota($this->input->post('idnegara'),$id);
		}
		if($modul=="idkecamatan"){
			echo $this->combobox_db->idkecamatan($id);
		}
		if($modul=="idproses"){
			echo $this->combobox_db->idproses($id);
		}
		if($modul=="idkelompok"){
			echo $this->combobox_db->idkelompok($id);
		}
		if($modul=="kelompok_siswa"){
			echo $this->combobox_db->kelompok_siswa($id);
		}
		if($modul=="idtahunajaran"){
			echo $this->combobox_db->idtahunajaran($id);
		}
		if($modul=="idtahunajaranaktif"){
			echo $this->combobox_db->idtahunajaranaktif($id);
		}
		if($modul=="idtahunajarancompany"){
			echo $this->combobox_db->idtahunajarancompany($id,$this->input->post('idcompany'));
		}
		if($modul=="idtahunajaranall"){
			echo $this->combobox_db->idtahunajaranall($id,$this->input->post('idcompany'));
		}
		if($modul=="idtingkat"){
			echo $this->combobox_db->idtingkat($id);
		}
		if($modul=="idjurusan"){
			echo $this->combobox_db->idjurusan($id);
		}
		if($modul=="idkelas"){
			echo $this->combobox_db->idkelas($id);
		}
		if($modul=="idprosestipe"){
			echo $this->combobox_db->idprosestipe($id,$this->input->post('idcompany'));
		}
		if($modul=="idmatpel"){
			echo $this->combobox_db->idmatpel($id,$this->input->post('idcompany'));
		}
		if($modul=="idrapottipediv"){
			echo $this->combobox_db->idrapottipediv($id,$this->input->post('idcompany'));
		}
		if($modul=="idrapottipe"){
			echo $this->combobox_db->idrapottipe($id);
		}
		if($modul=="idrapottipe13"){
			echo $this->combobox_db->idrapottipe13($id,$this->input->post('idcompany'));
		}
		if($modul=="idsiswa"){
			echo $this->combobox_db->idsiswa($id);
		}

		if($modul=="iddepartemen"){
			echo $this->combobox_db->iddepartemen($id);
		}

		if($modul=="idpredikatspiritual"){
			echo $this->combobox_db->idpredikatspiritual($id);
		}

		if($modul=="idpredikatsosial"){
			echo $this->combobox_db->idpredikatsosial($id);
		}

		if($modul=="notifkronologis"){
			echo $this->combobox_db->notifkronologisdb();
		}

		if($modul=="notifkronologiscount"){
			echo $this->combobox_db->notifkronologiscountdb();
		}

		if($modul=="idmatpelkelompok"){
			echo $this->combobox_db->idmatpelkelompok($id);
		}

		if($modul=="iddepartemenmutasi"){
			echo $this->combobox_db->iddepartemenmutasi($id);
		}

		if($modul=="idtahunajaranmutasi"){
			echo $this->combobox_db->idtahunajaranmutasi($id,$this->input->post('idunitbisnis'));
		}

		if($modul=="idtingkatmutasi"){
			echo $this->combobox_db->idtingkatmutasi($id);
		}
		if($modul=="idjurusanmutasi"){
			echo $this->combobox_db->idjurusanmutasi($id,$this->input->post('idtahunajaran'));
		}
		if($modul=="idkelompokmutasi"){
			echo $this->combobox_db->idkelompokmutasi($id,$this->input->post('idproses'),$this->input->post('idtahunajaran'));
		}

		if($modul=="idlayanan"){
			echo $this->combobox_db->idlayanan($id);
		}

		if($modul=="idpegawai"){
			echo $this->combobox_db->idpegawai($id);
		}
		if($modul=="idpegawaiuser"){
			echo $this->combobox_db->idpegawaiuser($id);
		}

		if($modul=="idpermintaan_barang"){
			echo $this->combobox_db->idpermintaan_barang($id,$this->input->post('idpermintaan_barang'));
		}
	}

}
