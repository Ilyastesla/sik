<?php

session_start(); //we need to start session in order to access it through CI

Class hrm_event extends CI_Controller {

public function __construct() {
	parent::__construct();

		// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');


		// Load session library
		$this->load->library('session');

		// Load database
		$this->load->model('hrm_event_db');

		if( $this->session->userdata('logged_in')) {
			if($this->dbx->checkpage($this->session->userdata('role_id'),'hrm_event')==false){
					redirect('user_authentication');
			}
		}else{
			redirect('user_authentication');;
		}

	}

	public function index()
	{
			$data['form']='Pelatihan';
			$data['view']='index';
			$data['action']='hrm_event';
			$data['ubah']=0;
			$data = $this->hrm_event_db->data($data);
			$this->load->view('hrm_event_v', $data);
	}

	// TAMBAH
	//-------------------------------------------------------------------------------------------
	public function tambah($id='') {
		$data['form']='Pelatihan';
		$data['form_small']='Tambah Data';
		$data['view']='tambah';
		$data['action']='hrm_event/tambah_p';
		$data= $this->hrm_event_db->tambah_x($id,$data);
		$this->load->view('hrm_event_v',$data);
	}

	public function tambah_p($id='') {
		$idperihal=$this->input->post("idperihal");
		if(($idperihal=="0") and ($this->input->post("perihallain"))){
			$idperihal=$this->tambah_perihal_p($this->input->post("perihallain"),'event');
		}
		//"tanggalkonfirmasi"=> $this->p_c->tgl_db($this->input->post('tanggalkonfirmasi')),
		$data = array(
				"idhrm_event_theme"=> $this->input->post("idhrm_event_theme"),
				"idperihal"=> $idperihal,
				"subjek"=> $this->input->post("subjek"),
				"idpenanggungjawab"=> $this->input->post("idpenanggungjawab"),
				"deskripsi"=> $this->input->post("deskripsi"),
				"idruang"=> $this->input->post("idruang"),
				"sesi"=> $this->input->post("sesi"),
				"sesiaktif"=> 1,
				"target_peserta"=> $this->input->post("target_peserta"),
				"aktif"=> $this->input->post("aktif"),
				"tanggalpelaksanaan"=> $this->p_c->tgl_db($this->input->post('tanggalpelaksanaan')),
				"jammulai"=> $this->input->post("jammulai").':00',
				"jamakhir"=> $this->input->post("jamakhir").':00',
				"tanggalkonfirmasi"=> date('Y-m-d', strtotime($this->p_c->tgl_db($this->input->post('tanggalpelaksanaan')). ' -3 days')) ,
				"status"=> "1",
				'idrole' => $this->p_c->arrdump($this->input->post('idrole')),
				'idrole2' => $this->p_c->arrdump($this->input->post('idrole2')),
				"biaya"=> $this->input->post("biaya"),
				"modified_date"=> $this->dbx->cts(),
				"modified_by"=> $this->session->userdata('idpegawai')
			);
		if ($id<>""){
			$result = $this->hrm_event_db->ubah($data,$id) ;
		}else{
			if ($this->input->post("kode_transaksi")<>""){
					$kode_transaksi=$this->input->post("kode_transaksi");
			}else{
				$kode_transaksi= $this->hrm_event_db->kode_transaksi($this->p_c->tgl_db($this->input->post('tanggalpelaksanaan')));
			}

			$data = $this->p_c->arraymerge(array('kode_transaksi' => $kode_transaksi), $data);
			$data = $this->p_c->arraymerge(array('kodeabsen' => substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUPWXYZ", 8)), 0, 8)), $data);
			$data = $this->p_c->arraymerge(array('created_date' => $this->dbx->cts()), $data);
			$data = $this->p_c->arraymerge(array('created_by' => $this->session->userdata('idpegawai')), $data);
			$id = $this->hrm_event_db->tambah($data);
			//echo $this->db->last_query();
			//die;
			if ($id<>""){$result=TRUE;}
			$result=$this->import_peserta_p($id,str_replace(",","TRX",$this->p_c->arrdump($this->input->post('idrole'))),str_replace(",","TRX",$this->p_c->arrdump($this->input->post('idrole2'))));
			$result=$this->importeventevaluationpelaksana($id);
		}

		if ($result == TRUE) {
				//$this->dbx->qrcodegenerate('uploads/hrm_event/','qrevent'.$id,base_url()."index.php/hrm_event/hadirqr_p/".$id);
				for ($i = 1; $i <= $this->input->post("sesi"); $i++) {
						$this->dbx->qrcodegenerate('uploads/hrm_event/','qreventhadir_'.$i.'_'.$id,site_url()."/hrm_event/hadirqr_p/".$i."/".$id);
				}
				/*
				?>
				<img src="<?php echo base_url(); ?>uploads\hrm_event\qreventhadir_<?php echo $this->input->post("sesi"); ?>_<?php echo $id; ?>.png" width="100%"> <br/>
				<?
				*/
				//$this->dbx->qrcodegenerate('uploads/hrm_event/','qreventpulang_'.$id,"http://192.168.33.243/sihsks/index.php/hrm_event/pulangqr_p/".$id);
				$this->dbx->qrcodegenerate('uploads/hrm_event/','qreventpemateri_'.$id,site_url()."/hrm_event_sign_pemateri/nilaievent_p/1/pemateri/".$id);
			 	redirect('hrm_event/view/1/'.$id);
			//redirect('hrm_event');
		} else {
			$data['error']='Errorr...';
			$this->ubah($id,$data);
		}
	}


	public function tambah_perihal_p($var,$type) {
		$data = array(
				"perihal"=> $var,
				"aktif"=> 1,
				"type"=>$type,
				"created_date"=> $this->dbx->cts(),
				"created_by"=> $this->session->userdata('idpegawai'),
				"modified_date"=> $this->dbx->cts(),
				"modified_by"=> $this->session->userdata('idpegawai')
		);
		return $this->hrm_event_db->tambahperihal($data);
	}

	// UBAH
	//-------------------------------------------------------------------------------------------
	public function ubah($id,$stat='') {
		$data['form']='Pelatihan';
		$data['form_small']='Ubah Data';
		$data['view']='tambah';
		$data['action']='hrm_event/tambah_p/'.$id;
		$data= $this->hrm_event_db->tambah_x($id,$data);
		$this->load->view('hrm_event_v',$data);
	}

	// VIEW
	//-------------------------------------------------------------------------------------------
	public function view($ubah,$id) {
		$data['form']='Pelatihan';
		$data['form_small']='View';
		$data['view']='view';
		$data['ubah']=$ubah;
		$data['action']='hrm_event/finish/'.$id;
		$data['actionpemateri']='hrm_event/tambahpemateri_p/'.$id;
		$data['actionpegawai']='hrm_event/tambahpeserta_p/'.$id;
		$data['actionattachment']='hrm_event/tambahattachment_p/'.$id;

		$data= $this->hrm_event_db->view_db($id,$data);
		$this->load->view('hrm_event_v',$data);
	}

	public function printevent($excel,$id) {
		$data['form']='Pelatihan';
		$data['form_small']='View';
		$data['excel']=$excel;
		$data['ubah']=0;
		$data= $this->hrm_event_db->view_db($id,$data);
		$this->load->view('hrm_event_print_v',$data);
	}

	public function eventevaluation_p($type,$idhrm_event,$id="") {
		$data['form']='Pelatihan';
		$data['form_small']='View';
		$data['view']='detailpegawai';
		$data= $this->hrm_event_db->viewevaluasi_db($data,$type,$idhrm_event,$id);
		$this->load->view('hrm_event_print_evaluation_v',$data);
	}

	public function eventevaluationdetail_p($idhrm_event,$idevaluasi) {
		$data['form']='Pelatihan';
		$data['form_small']='View';
		$data['view']='detailevaluation';
		$data= $this->hrm_event_db->viewevaluasidetail_db($data,$idhrm_event,$idevaluasi);
		$this->load->view('hrm_event_print_evaluation_v',$data);
	}

	public function tambahrundown($id,$idx="") {
		$data['form']='Rundown Pelatihan';
		$data['form_small']='View';
		$data['view']='tambahrundown';
		$data['id']=$id;
		$data['action']='hrm_event/tambahrundown_p/'.$id.'/'.$idx;
		$data= $this->hrm_event_db->tambahrundown_db($data,$id,$idx);
		$this->load->view('hrm_event_v',$data);
	}

	public function tambahpemateri_p($id) {
		$idpemateri=$this->input->post("idpemateri");
		if(($idpemateri=="0") and ($this->input->post("pematerilain"))){
			$idpemateri=$this->tambah_perihal_p($this->input->post("pematerilain"),'eventpemateri');
		}

		$no_register= $this->hrm_event_db->no_registerpemateri($id);
		$data = array(
				"no_register" => $no_register,
				"idhrm_event"=> $id,
				"idpemateri"=> $idpemateri,
				"modified_date"=> $this->dbx->cts(),
				"modified_by"=> $this->session->userdata('idpegawai')
		);

		$data = $this->p_c->arraymerge(array('created_date' => $this->dbx->cts()), $data);
		$data = $this->p_c->arraymerge(array('created_by' => $this->session->userdata('idpegawai')), $data);
		$idx = $this->hrm_event_db->tambahpemateri($data);
		//echo $this->db->last_query();
		//die;
		if ($idx<>""){$result=TRUE;}

		if ($result == TRUE) {
			//echo "http://192.168.33.243/sihsks/index.php/hrm_event/hadirqr_p/".$idx."/".$id;
			//$this->dbx->qrcodegenerate('uploads/hrm_event/','qreventhadir_'.$idx.'_'.$id,"http://192.168.33.243/sihsks/index.php/hrm_event/hadirqr_p/".$idx."/".$id);
			redirect('hrm_event/view/1/'.$id);
			//redirect('hrm_event');
		} else {
			$data['error']='Errorr...';
			redirect('hrm_event/view/1/'.$id);
		}
	}

	public function tambahpeserta_p($id) {
		$data = array(
				"idhrm_event"=> $id,
				"idpegawai"=> $this->input->post("idpegawai"),
				"wajib"=> $this->input->post("wajib"),
				"modified_date"=> $this->dbx->cts(),
				"modified_by"=> $this->session->userdata('idpegawai')
		);

		$data = $this->p_c->arraymerge(array('created_date' => $this->dbx->cts()), $data);
		$data = $this->p_c->arraymerge(array('created_by' => $this->session->userdata('idpegawai')), $data);
		$idx = $this->hrm_event_db->tambahpeserta($data);
		if ($idx<>""){$result=TRUE;}
		if ($result == TRUE) {
			redirect('hrm_event/view/1/'.$id);
		} else {
			$data['error']='Errorr...';
			redirect('hrm_event/view/1/'.$id);
		}
	}

	public function hapuspemateri($id,$idx) {
		$result = $this->hrm_event_db->hapuspemateri_db($id,$idx) ;
		if ($result == TRUE) {
			redirect('hrm_event/view/1/'.$id);
		}
	}

	public function tambahrundown_p($id,$idx="") {
		$data = array(
				"idhrm_event"=> $id,
				"hrm_event_rundown"=> $this->input->post("hrm_event_rundown"),
				"dari"=> $this->input->post("dari").':00',
				"sampai"=> $this->input->post("sampai").':00',
				"modified_date"=> $this->dbx->cts(),
				"modified_by"=> $this->session->userdata('idpegawai')
		);
		if ($idx<>""){
			$result = $this->hrm_event_db->ubahrundown_db($data,$idx) ;
		}else{
			$data = $this->p_c->arraymerge(array('created_date' => $this->dbx->cts()), $data);
			$data = $this->p_c->arraymerge(array('created_by' => $this->session->userdata('idpegawai')), $data);
			$idx = $this->hrm_event_db->tambahrundown($data);
			//echo $this->db->last_query();
			//die;
			if ($idx<>""){$result=TRUE;}
		}
		if ($result == TRUE) {
			redirect('hrm_event/view/1/'.$id);
			//redirect('hrm_event');
		} else {
			$data['error']='Errorr...';
			redirect('hrm_event/view/1/'.$id);
		}
	}

	public function hapusrundown($id,$idx) {
		$result = $this->hrm_event_db->hapusrundown_db($idx) ;
		if ($result == TRUE) {
			redirect('hrm_event/view/1/'.$id);
		}
	}

	public function importeventevaluationpelaksana($id) {
		$result = $this->hrm_event_db->importeventevaluationpelaksana_db($id) ;
		if ($result == TRUE) {
			redirect('hrm_event/view/1/'.$id);
		}else{
			redirect('hrm_event/view/1/'.$id);
		}
	}
	public function hrmeventevaluationpelaksanahapus($id,$idx) {
		$result = $this->hrm_event_db->hrmeventevaluationpelaksanahapus_db($id,$idx) ;
		if ($result == TRUE) {
			redirect('hrm_event/view/1/'.$id);
		}
	}

	public function import_peserta_p($id,$idrole,$idrole2) {

		//$idpeserta=$this->p_c->arrdump($this->input->post('idrole'));
		$idrolestr=str_replace("TRX",",",$idrole);
		$idrolestr2=str_replace("TRX",",",$idrole2);
		$result = $this->hrm_event_db->importpeserta_db($id,$idrolestr,$idrolestr2);
		if ($result == TRUE) {
			redirect('hrm_event/view/1/'.$id);
		}else{
			redirect('hrm_event/view/1/'.$id);
		}
	}

	public function hrmeventpesertahapus($id,$idx) {
		$result = $this->hrm_event_db->hrmeventpesertahapus_db($id,$idx) ;
		if ($result == TRUE) {
			redirect('hrm_event/view/1/'.$id);
		}
	}

	public function hapus($id) {
		$result = $this->hrm_event_db->hapus_tujuan_p_db($id) ;
		$result = $this->hrm_event_db->hapus_db($id) ;
		if ($result == TRUE) {
			redirect('hrm_event');
		}
	}

	public function finish($id){ //sepertinya tak terpakai
		if($this->input->post("submit")=="rilis"){
			$this->rilis_p($id);
			die;
		}else{
				redirect('hrm_event/view/0/'.$id);
		}
	}

	public function rilis_p($id) {
	 $data = array(
				"tanggalrilis"=> $this->dbx->cts(),
				"status"=> "5",
				"modified_date"=> $this->dbx->cts(),
				"modified_by"=> $this->session->userdata('idpegawai'));

		$result = $this->hrm_event_db->ubah($data,$id) ;
		if ($result == TRUE) {
			redirect('hrm_event/view/0/'.$id);
			//redirect('hrm_event');
		} else {
			$data['error']='Errorr...';
			redirect('hrm_event/view/0/'.$id);
		}
	}

	public function hadirqr_p($sesi,$idhrm_event,$idpegawai="") {
		if ($idpegawai==""){
			$idpegawaidb=$this->session->userdata('idpegawai');
			$link='hrm_event/view/2/'.$idhrm_event;
		}else{
			$idpegawaidb=$idpegawai;
			$link='hrm_event/view/0/'.$idhrm_event;
		}
		//echo "SELECT e.* FROM hrm_event e INNER JOIN hrm_event_peserta p ON e.replid=p.idhrm_event WHERE e.replid='".$idhrm_event."' AND p.idpegawai='".$idpegawaidb."'";
		$ceksql=$this->dbx->rows("SELECT e.* FROM hrm_event e INNER JOIN hrm_event_peserta p ON e.replid=p.idhrm_event WHERE e.replid='".$idhrm_event."' AND p.idpegawai='".$idpegawaidb."'");
		if (COUNT($ceksql)=="0"){
			redirect('hrm_event/gagalabsen/2');
			die;
		}else{
			if ( !in_array($ceksql->status, array("5","PR")) ) {
			//if (($ceksql->status<>"5") or ($ceksql->status<>"PR")){
				redirect('hrm_event/gagalabsen/1');
				die;
			}
		}

	 $data = array(
				"hadir"=> 1,
				"konfirmasi"=> 1,
				"tanggalhadir".$sesi=> $this->dbx->cts(),
				"modified_date"=> $this->dbx->cts(),
				"modified_by"=> $this->session->userdata('idpegawai'));
		$result = $this->hrm_event_db->ubahhadirqr_db($data,$idhrm_event,$idpegawaidb) ;
		if ($result == TRUE) {
			redirect($link);
			//redirect('hrm_event');
		} else {
			$data['error']='Errorr...';
			redirect($link);
		}
	}

	function tambahattachment_p($id) {
		$this->load->helper('form');
		$config['upload_path'] = 'uploads/hrm_event';
		$config['allowed_types'] = 'gif|jpg|png|docs|pdf|doc|xls|xl';
		$config['encrypt_name'] = TRUE;

		$this->load->library('upload', $config);
		$this->upload->initialize($config);
		$this->upload->set_allowed_types('*');
		$data['upload_data'] = '';

		if (!$this->upload->do_upload()) {
			$data = array('msg' => $this->upload->display_errors());
			echo $this->upload->display_errors();
			die;
		} else { //else, set the success message
			$data = array('msg' => "Upload success!");
			$data['upload_data'] = $this->upload->data();
			$file=$this->upload->data();
			$data2= array(
						"idhrm_event"=>$id,
						"fileidentitas"=>$_FILES['userfile']['name'],
						"newfile"=>$file['file_name'],
						'created_date' => $this->dbx->cts(),
						'created_by' => $this->session->userdata('idpegawai')
					);
			$result = $this->hrm_event_db->tambahattachment_db($data2) ;
		}
		redirect('hrm_event/view/1/'.$id);
	}

	public function hapusattachment_p($id,$idx,$file) {
		$path="uploads/hrm_event/".$file;

		$this->load->helper("file");
		delete_files($path);
		unlink($path);

		$result = $this->hrm_event_db->hapusattachment_db($idx);

		redirect('hrm_event/view/1/'.$id);
	}

	public function ubahstat_p($stat,$id,$nilaievent="") {
	//die;
	 $data = array(
				"status"=> $stat,
				"nilaievent"=> $nilaievent,
				"modified_date"=> $this->dbx->cts(),
				"modified_by"=> $this->session->userdata('idpegawai'));
		$result = $this->hrm_event_db->ubah($data,$id) ;
		if ($result == TRUE) {
			redirect('hrm_event/view/0/'.$id);
			//redirect('hrm_event');
		} else {
			$data['error']='Errorr...';
			redirect('hrm_event/view/0/'.$id);
		}
	}

	public function gagalabsen($tipe)
	{
			$data['form']='Pelatihan';
			$data['view']='gagalabsen';
			$data['tipe']=$tipe;
			$this->load->view('hrm_event_v', $data);
	}
}//end of class
?>
