<?php

session_start(); //we need to start session in order to access it through CI

Class ns_p5_projek_penilaian extends CI_Controller {

public function __construct() {
parent::__construct();

		// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');


		// Load library
		$this->load->library('session');

		// Load database
		$this->load->model('ns_p5_projek_penilaian_db');

		if( $this->session->userdata('logged_in')) {
			if($this->dbx->checkpage($this->session->userdata('role_id'),'ns_p5_projek_penilaian')==false){
					redirect('user_authentication');
			}
		}else{
			redirect('user_authentication');;
		}

	}

	public function index()
	{
			$data['action']='ns_p5_projek_penilaian';
			$data= $this->ns_p5_projek_penilaian_db->data($data);
			$data['form']='Penilaian Projek P5';
			$data['view']='index';
			$this->load->view('ns_p5_projek_penilaian_v', $data);
	}

	// TAMBAH
	//-------------------------------------------------------------------------------------------
	public function tambah($id='') {
		$data['form']='Penilaian Projek P5';
		$data['form_small']='Tambah Data';
		$data['view']='tambah';
		$data['action']='ns_p5_projek_penilaian/tambah_p/'.$id;
		$data= $this->ns_p5_projek_penilaian_db->tambah_db($id,$data);
		$this->load->view('ns_p5_projek_penilaian_v',$data);
	}

	public function tambah_p($id='') {
		$data = array(
			"idtahunajaran" => $this->input->post("idtahunajaran"),
			"idtingkat" => $this->input->post("idtingkat"),
			"idkelas" => $this->input->post("idkelas"),
			"idsiswa" => $this->input->post("idsiswa"),
			"idprojek" => $this->input->post("idprojek"),
			"catatanproses" => $this->input->post("catatanproses"),
			"modified_date" => $this->dbx->cts(),
			"modified_by" => $this->session->userdata('idpegawai')
			);
		if ($id<>""){
			$result = $this->dbx->ubahdata('ns_p5_projek_penilaian',$data,'replid',$id) ;
		}else{
			$data = $this->p_c->arraymerge(array('created_date' => $this->dbx->cts()), $data);
			$data = $this->p_c->arraymerge(array('created_by' => $this->session->userdata('idpegawai')), $data);
			$id = $this->dbx->tambahdata('ns_p5_projek_penilaian',$data) ;
			if ($id<>""){$result=TRUE;}
		}
//echo $this->db->last_query();die;
		if ($result == TRUE) {
			redirect('/ns_p5_projek_penilaian/penilaian/'.$id);
		} else {
			$data['error']="Errorr...";
			redirect('/ns_p5_projek_penilaian/tambah/'.$id);
		}
	}

	public function duplikasi($replid) {
		$sqlduplikasi="SELECT * FROM ns_p5_projek_penilaian WHERE replid='".$replid."'";
		$dataduplikasi=$this->dbx->rows($sqlduplikasi);
		//'idmatpel' => $datajadwal->idmatpel,
		$data = array(
				'idtahunajaran' => $dataduplikasi->idtahunajaran,
				'idtingkat' => $dataduplikasi->idtingkat,
				'idkelas' => $dataduplikasi->idkelas,
				'idsiswa' => 0,
				'idprojek' => $dataduplikasi->idprojek,
				"modified_date"=> $this->dbx->cts(),
				"modified_by"=> $this->session->userdata('idpegawai'),
				"created_date"=> $this->dbx->cts(),
				"created_by"=> $this->session->userdata('idpegawai')
		);
		$replidnew = $this->dbx->tambahdata('ns_p5_projek_penilaian',$data) ;
		if ($replidnew<>""){$result=TRUE;}

		if ($result == TRUE) {
			redirect('ns_p5_projek_penilaian/tambah/'.$replidnew);
		}
	}

	public function penilaian($id)
	{
			$data['actionsave']='ns_p5_projek_penilaian/ns_p5_projek_penilaian_nilai_p/'.$id;
			$data= $this->ns_p5_projek_penilaian_db->view_db($id,$data);
			$data['form']='Penilaian Projek P5';
			$data['form_small']='Penilaian';
			$data['view']='view';
			$data['stat']='ubah';
			$this->load->view('ns_p5_projek_penilaian_v', $data);
	}

	public function ns_p5_projek_penilaian_nilai_p($id) {
		//echo $this->input->post("idsiswa");
		$result = $this->dbx->hapusdata('ns_p5_projek_penilaian_nilai','idprojekpenilaian',$id) ;
		$idcapaian=$this->input->post("idcapaian");
		//echo var_dump($this->input->post("idcapaian"))."<br/>";
		
		foreach((array)$idcapaian as $rowcapaian => $idprojekpredikat) {
			unset($data);
			$data = array(
				"idprojekpenilaian" => $id,
				"idcapaian" => $rowcapaian,
				"idprojekpredikat" => $idprojekpredikat,
				"created_date" => $this->dbx->cts(),
				"created_by" => $this->session->userdata("idpegawai"),
				"modified_date" => $this->dbx->cts(),
				"modified_by" => $this->session->userdata("idpegawai")
				);
			//echo var_dump($data);
			$replidprojekpredikat = $this->dbx->tambahdata('ns_p5_projek_penilaian_nilai',$data) ;
			
		} 
		//echo $this->db->last_query();die;
		if ($replidprojekpredikat<>""){$result=TRUE;}
		
		if ($result == TRUE) {
			redirect('/ns_p5_projek_penilaian/view/'.$id);
		} else {
			$data['error']="Errorr...";
			redirect('/ns_p5_projek_penilaian/penilaian/'.$id);
		}
	}


	public function view($id)
	{
		$data['actionsave']='ns_p5_projek_penilaian/ns_p5_projek_penilaian_nilai_p/'.$id;
		$data= $this->ns_p5_projek_penilaian_db->view_db($id,$data);
			$data['form']='Penilaian Projek P5';
			$data['form_small']='Penilaian';
			$data['view']='view';
			$data['stat']='view';
			$this->load->view('ns_p5_projek_penilaian_v', $data);
	}

	// HAPUS
	//-------------------------------------------------------------------------------------------
	public function hapus($id) {
		$result = $this->dbx->hapusdata('ns_p5_projek_penilaian','replid',$id) ;
		if ($result == TRUE) {
			$result = $this->dbx->hapusdata('ns_p5_projek_penilaian_nilai','idprojekpenilaian',$id) ;
			?><script>
					window.opener.location.reload();
					window.close();
				</script>
			<?php
		}
	}
}//end of class
?>
