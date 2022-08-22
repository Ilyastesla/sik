<?php

session_start(); //we need to start session in order to access it through CI

Class ns_rapottipe extends CI_Controller {

public function __construct() {
parent::__construct();

		// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');


		// Load session library
		$this->load->library('session');

		// Load database
		$this->load->model('ns_rapottipe_db');

   if( $this->session->userdata('logged_in')) {
       if($this->dbx->checkpage($this->session->userdata('role_id'),'ns_rapottipe')==false){
          redirect('user_authentication');
       }
		}else{
			redirect('user_authentication');;
		}

	}

	public function index()
	{
			$data= $this->ns_rapottipe_db->data();
			$data['form']='Tipe Rapot';
			$data['view']='index';
			$data['action']='ns_rapottipe';
			$this->load->view('ns_rapottipe_v', $data);
	}

	// TAMBAH
	//-------------------------------------------------------------------------------------------
	public function tambah($id='') {
		$data['form']='Tipe Rapot';
		$data['form_small']='Tambah Data';
		$data['view']='tambah';
		$data['action']='ns_rapottipe/tambah_p';
		$data= $this->ns_rapottipe_db->tambah_db($id,$data);
		$this->load->view('ns_rapottipe_v',$data);
	}

	public function tambah_p($id='') {
		//'lpd' => $this->input->post('lpd'),
		//'grafik' => $this->input->post('grafik'),
		//'portraitview' => $this->input->post('portraitview'),
		//'gruppengembangandiri' => $this->input->post('gruppengembangandiri'),
		//'nilaimurni' => $this->input->post('nilaimurni'),
		//'predikat' => $this->input->post('predikat'),
		$data = array(
				'rapottipe' => $this->input->post('rapottipe'),
				'iddepartemen' => $this->input->post('iddepartemen'),
				'keterangan' => $this->input->post('keterangan'),
				'psikologon' => $this->input->post('psikologon'),
				'absensi' => $this->input->post('absensi'),
				'paketkompetensi' => $this->input->post('paketkompetensi'),
				'skk' => $this->input->post('skk'),
				'avg' => $this->input->post('avg'),
				'kkm' => $this->input->post('kkm'),
				'predikat' => $this->input->post('predikat'),
				'kalimatrapor' => $this->input->post('kalimatrapor'),
				'kopsurat' => $this->input->post('kopsurat'),
				'namajenjang' => $this->input->post('namajenjang'),
				'besarfont' => $this->input->post('besarfont'),
				'jumlahdata' => $this->input->post('jumlahdata'),
				'k13' => $this->input->post('k13'),
				'aktif' => $this->input->post('aktif'),
				'predikattipe' => $this->input->post('predikattipe'),
				'tipe' => $this->input->post('tipe'),
				'batasnilai' => $this->input->post('batasnilai'),
				"modified_date"=> $this->dbx->cts(),
				"modified_by"=> $this->session->userdata('idpegawai'));

		if ($id<>""){
			$result = $this->dbx->ubahdata('ns_rapottipe',$data,'replid',$id) ;
		}else{
			$data = $this->p_c->arraymerge(array('created_date' => $this->dbx->cts()), $data);
			$data = $this->p_c->arraymerge(array('created_by' => $this->session->userdata('idpegawai')), $data);
			$id = $this->dbx->tambahdata('ns_rapottipe',$data) ;
			if ($id<>""){$result=TRUE;}
		}

		if($id<>""){
			$result = $this->db->query("DELETE FROM ns_reff_company WHERE tipe='ns_rapottipe' AND idvariabel='".$id."'");
			foreach((array)$this->input->post('idcompany') as $rowcompany) {
					$datacompany = array(
						'tipe'=>'ns_rapottipe',
						'idvariabel'=>$id,
						'idcompany' => $rowcompany,
						'created_date' => $this->dbx->cts(),
						'created_by' => $this->session->userdata('idpegawai'),
						"modified_date"=> $this->dbx->cts(),
						"modified_by"=> $this->session->userdata('idpegawai')
					);
					$this->dbx->tambahdata('ns_reff_company',$datacompany) ;
			}
		}
		if ($result == TRUE) {
			?><script>
					window.opener.location.reload();
					window.close();
				</script>
			<?php
		} else {
			$data['error']='Errorr...';
			$this->ubah($id,$data);
		}
	}

	// UBAH
	//-------------------------------------------------------------------------------------------
	public function ubah($id,$stat='') {
		$data['form']='Tipe Rapot';
		$data['form_small']='Ubah Data';
		$data['view']='tambah';
		$data['action']='ns_rapottipe/tambah_p/'.$id;
		$data= $this->ns_rapottipe_db->tambah_db($id,$data);
		$this->load->view('ns_rapottipe_v',$data);
	}

	//Hapus
	public function hapus($id) {
		$result = $this->dbx->hapusdata('ns_rapottipe','replid',$id)  ;
		if ($result == TRUE) {
			?><script>
					window.opener.location.reload();
					window.close();
				</script>
			<?php
		}
	}

	public function ubahaktif($id,$aktif) {
		$data=array(
				'aktif' =>$aktif
				,"modified_date"=> $this->dbx->cts()
				,"modified_by"=> $this->session->userdata('idpegawai'));
		$result = $this->dbx->ubahdata('ns_rapottipe',$data,'replid',$id) ;
		if ($result == TRUE) {
			?><script>
					window.opener.location.reload();
					window.close();
				</script>
			<?php
		} else {
			$data['error']='Errorr...';
			$this->ubah($id,$data);
		}
	}

	public function ubahmodular($id,$modular) {
		$data=array(
				'modular' =>$modular
				,"modified_date"=> $this->dbx->cts()
				,"modified_by"=> $this->session->userdata('idpegawai'));
		$result = $this->dbx->ubahdata('ns_rapottipe',$data,'replid',$id) ;
		if ($result == TRUE) {
			?><script>
					window.opener.location.reload();
					window.close();
				</script>
			<?php
		} else {
			$data['error']='Errorr...';
			$this->ubah($id,$data);
		}
	}

	public function rapottipe_company($id) {
		$result = $this->dbx->rowscsv("SELECT * FROM ns_reff_company WHERE tipe='ns_rapottipe' AND idvariabel='".$id."'");
		return $result;
	}
}//end of class
?>
