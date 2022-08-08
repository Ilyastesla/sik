<?php

session_start(); //we need to start session in order to access it through CI

Class keu_administrasi extends CI_Controller {

public function __construct() {
parent::__construct();

		// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');


		// Load library
		$this->load->library('session');

		// Load database
		$this->load->model('keu_administrasi_db');

		if( $this->session->userdata('logged_in')) {
			if($this->dbx->checkpage($this->session->userdata('role_id'),'keu_administrasi')==false){
					redirect('user_authentication');
			}
		}else{
			redirect('user_authentication');;
		}

	}

	public function index($print="",$excel="")
	{
			$data= $this->keu_administrasi_db->data();
			$data['form']='Administrasi Keuangan';
			$data['view']='index';
			$data['action']='keu_administrasi';
			$data['excel']=$excel;
			$data['hariini']=$this->dbx->singlerow("SELECT CURRENT_DATE() as isi");
			if($print<>"1"){
				$this->load->view('keu_administrasi_v', $data);
			}else{
				$this->load->view('keu_administrasi_print_v', $data);
			}

	}

	public function set_peringatan($peringatantype,$idsiswa) {
		if($peringatantype<>0){
				$thisday=$this->dbx->cts();
				$kadaluarsa=$this->dbx->singlerow("SELECT DATE_ADD(CURRENT_DATE(),INTERVAL 14 DAY) as isi");
		}else{
			$thisday='NULL';
			$kadaluarsa='NULL';

		}

		$data=array(
				"idsiswa"=> $idsiswa
				,"peringatantype"=>$peringatantype
				,"tgl_aktivasi"=> $thisday
				,"tgl_kadaluarsa"=>$kadaluarsa
				,"modified_date"=> $this->dbx->cts()
				,"modified_by"=> $this->session->userdata('idpegawai')
				,"created_date"=> $this->dbx->cts()
				,"created_by"=> $this->session->userdata('idpegawai')
			);
		$result = $this->keu_administrasi_db->set_peringatan_history($data);

		$data=array(
				"peringatan"=> $peringatantype
				,"tgl_kadaluarsa"=> $kadaluarsa
				,"update_date"=> $this->dbx->cts()
				,"update_by"=> $this->session->userdata('idpegawai')
			);
		$result = $this->keu_administrasi_db->set_peringatan($data,$idsiswa);


		if ($result == TRUE) {
			//redirect('keu_administrasi');
			?><script>
					window.opener.location.reload();
					window.close();
				</script>
			<?php
		} else {
			$data['error']='Errorr...';
			redirect('keu_administrasi');
		}
	}

	public function view($ubah,$id) {
		$data['form']='Administrasi Keuangan';
		$data['form_small']='View';
		$data['view']='view';
		$data['ubah']=$ubah;
		$data['actionattachment']='keu_administrasi/tambahattachment_p/'.$id;
		$data= $this->keu_administrasi_db->view_db($id,$data);
		$this->load->view('keu_administrasi_v',$data);
	}

	function tambahattachment_p($id) {
		$this->load->helper('form');

		$config['upload_path'] = 'uploads/keu_administrasi';
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
						"idsiswa"=>$id,
						"file"=>$_FILES['userfile']['name'],
						"newfile"=>$file['file_name'],
						'created_date' => $this->dbx->cts(),
						'created_by' => $this->session->userdata('idpegawai')
					);
			$result = $this->keu_administrasi_db->tambahattachment_db($data2) ;
			//echo $this->db->last_query();die;
		}
		redirect('keu_administrasi/view/1/'.$id);
	}

	public function hapusattachment_p($id,$idx,$file) {
		$path="uploads/keu_administrasi/".$file;

		$this->load->helper("file");
		delete_files($path);
		unlink($path);

		$result = $this->keu_administrasi_db->hapusattachment_db($idx);

		redirect('keu_administrasi/view/1/'.$id);
	}

	public function set_rp($id,$var) {
		$data=array(
				'remedialperilaku' =>$var
				,"modified_date"=> $this->dbx->cts()
				,"modified_by"=> $this->session->userdata('idpegawai'));
		$result = $this->dbx->ubahdata('siswa',$data,'replid',$id);
		//echo $this->db->last_query();die;
		if ($result == TRUE) {
			?><script>
					window.opener.location.reload();
					window.close();
				</script>
			<?php
		} else {
			$data['error']='Errorr...';
			redirect('keu_administrasi');
		}
	}

	public function set_tutorvisit($id,$var) {
		$data=array(
				'keu_tutorvisit' =>$var
				,"modified_date"=> $this->dbx->cts()
				,"modified_by"=> $this->session->userdata('idpegawai'));
		$result = $this->dbx->ubahdata('siswa',$data,'replid',$id);
		//echo $this->db->last_query();die;
		if ($result == TRUE) {
			?><script>
					window.opener.location.reload();
					window.close();
				</script>
			<?php
		} else {
			$data['error']='Errorr...';
			redirect('keu_administrasi');
		}
	}

}//end of class
?>
