<?php

session_start(); //we need to start session in order to access it through CI

Class ppkb_cek extends CI_Controller {

public function __construct() {
	parent::__construct();

		// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');


		// Load session library
		$this->load->library('session');

		// Load database
		$this->load->model('ppkb_cek_db');

   if( $this->session->userdata('logged_in')) {
       if($this->dbx->checkpage($this->session->userdata('role_id'),'ppkb_cek')==false){
          redirect('user_authentication');
       }
		}else{
			redirect('user_authentication');;
		}
	}

	public function index()
	{
		$data['show_table'] = $this->ppkb_cek_db->data();
		$data['form']='Penerbitan Cek';
		$data['view']='index';
		$this->load->view('ppkb_cek_v', $data);
	}

	// TAMBAH
	//-------------------------------------------------------------------------------------------
	public function tambah($id='') {
		$data['form']='Penerbitan Cek';
		$data['form_small']='Tambah Data';
		$data['view']='tambah';
		$data['action']='ppkb_cek/tambah_p';
		$data= $this->ppkb_cek_db->tambah_x($id,$data);
		$this->load->view('ppkb_cek_v',$data);

		//$data= $this->ppkb_cek_db->input_add($data);
		//$this->load->view('ppkb_cek_v',$data);
	}

	public function tambah_p($id='') {
		$data = array(
				"idcompany"=> $this->input->post("idcompany"),
				"pemohon"=> $this->input->post("pemohon"),
				"iddepartemen"=> $this->input->post("iddepartemen"),
				"tanggalpengajuan"=> $this->p_c->tgl_db($this->input->post('tanggalpengajuan')),
				"keterangan"=> $this->input->post("keterangan"),
				"status"=> "1",
				"modified_date"=> $this->dbx->cts(),
				"modified_by"=> $this->session->userdata('idpegawai'));
		if ($id<>""){
			$result = $this->ppkb_cek_db->ubah($data,$id) ;
		}else{
			$kode_transaksi= $this->ppkb_cek_db->kode_transaksi($this->input->post("idcompany"),$this->p_c->tgl_db($this->input->post('tanggalpengajuan')));
			$data = $this->p_c->arraymerge(array('kode_transaksi' => $kode_transaksi), $data);
			$data = $this->p_c->arraymerge(array('created_date' => $this->dbx->cts()), $data);
			$data = $this->p_c->arraymerge(array('created_by' => $this->session->userdata('idpegawai')), $data);
			$id = $this->ppkb_cek_db->tambah($data);

			if ($id<>""){$result=true;}else{$result=false;}
		}

		if ($result == true) {
			redirect('ppkb_cek/material/'.$id);
		} else {
			$data['error']='Errorr...';
			$this->ubah($id,$data);
		}
	}

	public function ubah($id,$stat='') {
		$data['form']='Penerbitan Cek';
		$data['form_small']='Ubah Data';
		$data['view']='tambah';
		$data['action']='ppkb_cek/tambah_p/'.$id;
		$data= $this->ppkb_cek_db->tambah_x($id,$data);
		$this->load->view('ppkb_cek_v',$data);
	}


	//MATERIAL VIEW
	//-------------------------------------------------------------------------------------------
	public function material($id,$stat='') {
		$data['form']='Penerbitan Cek';
		$data['form_small']='Material';
		$data['view']='material';
		$data['action']='ppkb_cek/ubahstatus_p/'.$id;
		$data['id']=$id;
		$data= $this->ppkb_cek_db->view_db($id,$data);
		$this->load->view('ppkb_cek_v',$data);
	}

	//LAIN
	//-------------------------------------------------------------------------------------------
	public function tambahlain($id,$idx="",$data="",$stat="") {
		$data['form']='Penerbitan Cek';
		$data['form_small']='lain';
		$data['view']='tambahlain';
		$data['action']='ppkb_cek/tambahlain_p/'.$id.'/'.$idx;
		$data['idx']=$id;
		$data= $this->ppkb_cek_db->ubahlain_x($idx,$data);
		$this->load->view('ppkb_cek_v',$data);
	}

	public function tambahlain_p($id,$idx='') {

		$data = array(
				"idppkb_cek"=>$id,
				"keterangan"=> $this->input->post("keterangan"),
				"jumlah"=> $this->input->post("jumlah"),
				"idunit"=> $this->input->post("idunit"),
				"nilai"=> $this->input->post("nilai"),
				"sub_total"=> (floatval($this->input->post("jumlah"))*floatval( $this->input->post("nilai")))
				);
		if ($idx<>""){
			$result = $this->ppkb_cek_db->ubahlain_db($data,$idx) ;
		}else{
			$idx = $this->ppkb_cek_db->tambahlain_db($data);
			if ($idx<>""){$result=true;}else{$result=false;}
		}
		if ($result == TRUE) {
			redirect('ppkb_cek/material/'.$id);
		} else {
			$data['error']='Errorr...';
			$this->ubahlain($id,$idx,$data);
		}
	}

	public function hapuslain($id,$idx="") {
		$result = $this->ppkb_cek_db->hapuslain_db($idx) ;
		if ($result == TRUE) {
			redirect('ppkb_cek/material/'.$id);
		}
	}




	//TERMIN
	//-------------------------------------------------------------------------------------------
	public function tambahtermin($id,$idx="",$data="",$stat="") {
		$data['form']='Penerbitan Cek';
		$data['form_small']='Termin';
		$data['view']='tambahtermin';
		$data['action']='ppkb_cek/tambahtermin_p/'.$id.'/'.$idx;
		$data['idx']=$id;
		$data= $this->ppkb_cek_db->ubahtermin_x($idx,$data);
		$this->load->view('ppkb_cek_v',$data);
	}

	public function tambahtermin_p($id,$idx='') {
		$data = array(
				'idppkb_cek' => $id
				,'due_date' => date("Y-m-d", strtotime($this->input->post('due_date')))
				,'nilai' => $this->input->post('nilai')
				);
		if ($idx<>""){
			$result = $this->ppkb_cek_db->ubahtermin_db($data,$idx) ;
		}else{
			$idx = $this->ppkb_cek_db->tambahtermin_db($data);
			if ($idx<>""){$result=TRUE;}
		}
		if ($result == TRUE) {
			redirect('ppkb_cek/material/'.$id);
		} else {
			$data['error']='Errorr...';
			$this->ubahtermin($id,$idx,$data);
		}
	}

	public function hapustermin($id,$idx="") {
		$result = $this->ppkb_cek_db->hapustermin_db($idx) ;
		if ($result == TRUE) {
			redirect('ppkb_cek/material/'.$id);
		}
	}


	//TERMIN
	//-------------------------------------------------------------------------------------------
	public function ubahstatus_p($id='') {
	  	$data = array(
				"jumlah"=> $this->input->post("total_keperluan"),
				"status"=> "2",
				"modified_date"=> $this->dbx->cts(),
				"modified_by"=> $this->session->userdata('idpegawai'));

		$result = $this->ppkb_cek_db->ubah($data,$id) ;
		if ($result == TRUE) {
			redirect('ppkb_cek/view/'.$id);
		} else {
			$data['error']='Errorr...';
			redirect('/ppkb_cek/view/'.$id);
		}
	}

	//VIEW
	//-------------------------------------------------------------------------------------------

	public function view($id,$batal="") {
		$data['form']='Penerbitan Cek';
		$data['form_small']='View';
		$data['view']='view';
		$data['action']='ppkb_cek/approve_p/'.$id;
		$data['idx']=$id;
		$data= $this->ppkb_cek_db->view_db($id,$data);
		if ($batal==""){
			$batal="ppkb_cek";
		}
		$data['batal']=$batal;
		$this->load->view('ppkb_cek_v',$data);
	}

	//RElEASE
	//-------------------------------------------------------------------------------------------
	public function approve_p($id='') {
		$user_arr=explode(',',$this->input->post("approver"));
		$next_node=$this->dbx->release_node($user_arr[0],"ppkb_cek");
		$data2 = array(
				"idapprover"=> $user_arr[1],
				"idsumber"=> $id,
				"idmodul"=> "ppkb_cek",
				"node"=> $this->input->post("status"),
				"next_node"=> $next_node,
				"modified_date"=> $this->dbx->cts(),
				"modified_by"=> $this->session->userdata('idpegawai'));
		$result = $this->ppkb_cek_db->loa_history($data2) ;

	  	$data = array(
				"approver"=> $this->session->userdata('idpegawai'),
				"next_approver"=> $user_arr[1],
				"status"=> $next_node,
				"modified_date"=> $this->dbx->cts(),
				"modified_by"=> $this->session->userdata('idpegawai'));

		$result = $this->ppkb_cek_db->ubah($data,$id) ;
		if ($result == TRUE) {
			redirect('ppkb_cek/view/'.$id);
		} else {
			$data['error']='Errorr...';
			$this->ubah($id,$data);
		}
	}


	//HAPUS
	//-------------------------------------------------------------------------------------------
	public function hapus($id) {
		$result = $this->ppkb_cek_db->hapus($id) ;
		if ($result == TRUE) {
			redirect('/ppkb_cek');
		}
	}


	//ATTACHMENT
	function upload_it($id,$bayar='') {
		//load the helper
		$this->load->helper('form');

		//Configure
		//set the path where the files uploaded will be copied. NOTE if using linux, set the folder to permission 777
		$config['upload_path'] = 'uploads/ppkb_cek';
		// set the filter image types
		$config['allowed_types'] = 'gif|jpg|png';
		$config['encrypt_name'] = TRUE;

		//load the upload library
		$this->load->library('upload', $config);
		$this->upload->initialize($config);

		$this->upload->set_allowed_types('*');

		$data['upload_data'] = '';

		//if not successful, set the error message
		if (!$this->upload->do_upload()) {
			$data = array('msg' => $this->upload->display_errors());
			echo $this->upload->display_errors();
			die;


		} else { //else, set the success message
			$data = array('msg' => "Upload success!");
			$data['upload_data'] = $this->upload->data();
			$file=$this->upload->data();
			$data2= array(
						"idppkb_cek"=>$id,
						"file"=>$_FILES['userfile']['name'],
						"newfile"=>$file['file_name'],
						'created_date' => $this->dbx->cts(),
						'created_by' => $this->session->userdata('idpegawai')
					);
			$result = $this->ppkb_cek_db->tambah_attachment($data2) ;
		}

		if ($bayar<>1){
			redirect('ppkb_cek/material/'.$id);
		}else{
			redirect('realisasi_ppkb_cek/bayar/'.$id);
		}

	}
	public function hapus_attachment($id,$file,$idx,$bayar='') {
		$path="uploads/ppkb_cek/".$file;

		$this->load->helper("file");
		delete_files($path);
		unlink($path);

		$result = $this->ppkb_cek_db->hapus_attachment_db($id);
		if ($result == TRUE) {
			if ($bayar<>1){
				redirect('ppkb_cek/material/'.$idx);
			}else{
				redirect('realisasi_ppkb_cek/bayar/'.$idx);
			}
		}
	}


}//end of class
?>
