<?php

session_start(); //we need to start session in order to access it through CI

Class psb_skl extends CI_Controller {

public function __construct() {
parent::__construct();

		// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');


		// Load library
		$this->load->library('session');

		// Load database
		$this->load->model('psb_skl_db');

   if( $this->session->userdata('logged_in')) {
       if($this->dbx->checkpage($this->session->userdata('role_id'),'psb_skl')==false){
          redirect('user_authentication');
       }
		}else{
			redirect('user_authentication');;
		}

	}

	public function index()
	{
			$data = $this->psb_skl_db->data();
			$data['form']='Surat Keterangan Lulus PPDB';
			$data['view']='index';
			$data['action']='psb_skl';
			$this->load->view('psb_skl_v', $data);
	}

	// TAMBAH
	//-------------------------------------------------------------------------------------------
	public function tambah($id) {
		$data['form']='Surat Keterangan Lulus PPDB';
		$data['form_small']='Tambah Data';
		$data['view']='tambah';
		$data['action']='psb_skl/tambah_p/'.$id;
		$data= $this->psb_skl_db->tambah_db($id,$data);
		$this->load->view('psb_skl_v',$data);
	}

	public function tambah_p($id) {
		$data = array(
										"calon_kelas"=>$this->input->post("idkelas")
										,"tanggal_masuk"=>$this->p_c->tgl_db($this->input->post("tanggal_masuk"))
										,"modified_date"=> $this->dbx->cts()
										,"modified_by"=> $this->session->userdata('idpegawai')
								);
		$result = $this->dbx->ubahdata('calonsiswa',$data,'replid',$id);
		if ($result == TRUE) {
			?><script>
					window.opener.location.reload();
					window.close();
				</script>
			<?php
		} else {
			echo "ERROR!!!!";
		}
	}

	public function ubahlulus($lulus=0,$idcalon) {
		$data=array(
				'lulus' =>$lulus
				,'aktif' =>$lulus
				,"modified_date"=> $this->dbx->cts()
				,"modified_by"=> $this->session->userdata('idpegawai'));
		$result = $this->dbx->ubahdata('calonsiswa',$data,'replid',$idcalon);
		if ($result == TRUE) {
				if($lulus<>1){
						?><script>
								window.opener.location.reload();
								window.close();
							</script>
						<?php
				}else{
					redirect('psb_skl/tambah/'.$idcalon);
				}
		} else {
			echo "ERROR!!!!";
		}
	}


}//end of class
?>
