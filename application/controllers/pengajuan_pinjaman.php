<?php

session_start(); //we need to start session in order to access it through CI

Class pengajuan_pinjaman extends CI_Controller {

public function __construct() {
	parent::__construct();

		// Load form helper library
		$this->load->helper(array('form', 'url'));

		// Load form validation library
		$this->load->library('form_validation');


		// Load session library
		$this->load->library('session');

		// Load database
		$this->load->model('pengajuan_pinjaman_db');

   if( $this->session->userdata('logged_in')) {
       if($this->dbx->checkpage($this->session->userdata('role_id'),'pengajuan_pinjaman')==false){
          redirect('user_authentication');
       }
		}else{
			redirect('user_authentication');;
		}

	}

	public function index()
	{
			$data['show_table'] = $this->pengajuan_pinjaman_db->data();
			$data['form']='Pengajuan Pinjaman';
			$data['view']='index';
			$this->load->view('pengajuan_pinjaman_v', $data);
	}


	// TAMBAH
	//-------------------------------------------------------------------------------------------
	public function tambah($id='') {
		$data['form']='Pengajuan Pinjaman';
		$data['form_small']='Tambah Data';
		$data['view']='tambah';
		$data['action']='pengajuan_pinjaman/tambah_p';
		$data= $this->pengajuan_pinjaman_db->tambah_x($id,$data);
		$this->load->view('pengajuan_pinjaman_v',$data);
	}
	public function tambah_p($id='') {
		/*
		"idgroup"=> $this->input->post("idgroup"),
		"iddepartemen"=> $this->input->post("iddepartemen"),
		"idjabatan"=> $this->input->post("idjabatan"),
		*/
		$pegawai = $this->pengajuan_pinjaman_db->pegawai($this->input->post("pemohon"),$this->input->post("idjenis_pinjaman"));
		$limit_pinjaman=(intval($pegawai->limit_pinjaman)+intval($this->input->post("jumlah_lama")))-(intval($pegawai->total_pinjaman)+intval($this->input->post("jumlah")));
		$data = array(
				"idcompany"=> $pegawai->idcompany,
				"iddepartemen"=> $pegawai->iddepartemen,
				"idjabatan"=> $pegawai->idjabatan,
				"keperluan"=> $this->input->post("keperluan"),
				"pemohon"=> $this->input->post("pemohon"),
				"idjenis_pinjaman"=> $this->input->post("idjenis_pinjaman"),
				"tanggalpengajuan"=> $this->p_c->tgl_db($this->input->post('tanggalpengajuan')),
				"idjenis_jaminan"=> $this->input->post("idjenis_jaminan"),
				"keterangan_jaminan"=> $this->input->post("keterangan_jaminan"),
				"keterangan"=> $this->input->post("keterangan"),
				"alasan"=> $this->input->post("alasan"),
				"status"=> "1",
				"modified_date"=> $this->dbx->cts(),
				"modified_by"=> $this->session->userdata('idpegawai'));
		if ($id<>""){
			$result = $this->pengajuan_pinjaman_db->ubah($data,$id) ;
		}else{
			$kode_transaksi= $this->pengajuan_pinjaman_db->kode_transaksi($this->input->post("idcompany"),$this->p_c->tgl_db($this->input->post('tanggalpengajuan')));
			$data = $this->p_c->arraymerge(array('kode_transaksi' => $kode_transaksi), $data);
			$data = $this->p_c->arraymerge(array('created_date' => $this->dbx->cts()), $data);
			$data = $this->p_c->arraymerge(array('created_by' => $this->session->userdata('idpegawai')), $data);
			$id = $this->pengajuan_pinjaman_db->tambah($data);
			if ($id<>""){$result=TRUE;}
		}

		//cek limit pinjaman
		if ($limit_pinjaman>=$this->input->post("jumlah")){ //pinjaman lebih dari limit
			$data=array(
					"jumlah"=> $this->input->post("jumlah")
					,"cicilan"=> $this->input->post("cicilan")
					,"tglcicilan"=> $this->p_c->tgl_db($this->input->post('tglcicilan'))
			);
			$result = $this->pengajuan_pinjaman_db->ubah($data,$id) ;
			$data['error']='Errorr...';
		}else{
			$data['error']='Pinjaman Melebihi Limit...';
			$result=false;
		}

		if ($result == TRUE) {
			redirect('pengajuan_pinjaman/view/'.$id);
		} else {
			//$data['error']='Errorr...';
			$this->ubah($id,$data);
		}
	}

	// UBAH
	//-------------------------------------------------------------------------------------------
	public function ubah($id,$stat='') {
		$data['form']='Pengajuan Pinjaman';
		$data['form_small']='Ubah Data';
		$data['view']='tambah';
		$data['action']='pengajuan_pinjaman/tambah_p/'.$id;
		$data= $this->pengajuan_pinjaman_db->tambah_x($id,$data);
		$this->load->view('pengajuan_pinjaman_v',$data);
	}

	public function hapus($id) {
		$result = $this->pengajuan_pinjaman_db->hapus_db($id) ;
		if ($result == TRUE) {
			redirect('pengajuan_pinjaman');
		}
	}

	public function view($id,$stat='') {
		$data['form']='Pengajuan Pinjaman';
		$data['form_small']='Lihat';
		$data['view']='view';
		$data['action']='pengajuan_pinjaman/approve_p/'.$id;
		$data= $this->pengajuan_pinjaman_db->view_db($id,$data);
		$this->load->view('pengajuan_pinjaman_v',$data);
	}

	function upload_it($id) {
		//load the helper
		$this->load->helper('form');

		//Configure
		//set the path where the files uploaded will be copied. NOTE if using linux, set the folder to permission 777
		$config['upload_path'] = 'uploads/pinjaman';
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
						"idpengajuan_pinjaman"=>$id,
						"file"=>$_FILES['userfile']['name'],
						"newfile"=>$file['file_name'],
						'created_date' => $this->dbx->cts(),
						'created_by' => $this->session->userdata('idpegawai')
					);
			$result = $this->pengajuan_pinjaman_db->tambah_attachment($data2) ;
		}

		redirect('pengajuan_pinjaman/view/'.$id);
	}
	public function hapus_attachment($id,$file,$idx) {
		$path="uploads/pinjaman/".$file;

		$this->load->helper("file");
		delete_files($path);
		unlink($path);

		$result = $this->pengajuan_pinjaman_db->hapus_attachment_db($id);
		if ($result == TRUE) {
			redirect('pengajuan_pinjaman/view/'.$idx);
		}
	}

	//RElEASE
	//-------------------------------------------------------------------------------------------
	public function approve_p($id='') {
		$next_node=$this->dbx->next_node($this->input->post("status"),"pengajuan_pinjaman");

		$data2 = array(
				"idapprover"=> $this->input->post("approver"),
				"idsumber"=> $id,
				"idmodul"=> "pengajuan_pinjaman",
				"node"=> $this->input->post("status"),
				"next_node"=> $next_node,
				"modified_date"=> $this->dbx->cts(),
				"modified_by"=> $this->session->userdata('idpegawai'));
		$result = $this->pengajuan_pinjaman_db->loa_history($data2) ;

	  	$data = array(
				"approver"=> $this->session->userdata('idpegawai'),
				"next_approver"=> $this->input->post("approver"),
				"status"=> $next_node,
				"modified_date"=> $this->dbx->cts(),
				"modified_by"=> $this->session->userdata('idpegawai'));

		$result = $this->pengajuan_pinjaman_db->ubah($data,$id) ;
		if ($result == TRUE) {
			redirect('pengajuan_pinjaman/view/'.$id);
		} else {
			$data['error']='Errorr...';
			$this->ubah($id,$data);
		}
	}

}//end of class
?>
