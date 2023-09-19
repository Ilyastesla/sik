<?php

session_start(); //we need to start session in order to access it through CI

Class ns_rapot_observasi extends CI_Controller {

public function __construct() {
parent::__construct();

		// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');


		// Load library
		$this->load->library('session');

		// Load database
		$this->load->model('ns_rapot_observasi_db');

		if( $this->session->userdata('logged_in')) {
			if($this->dbx->checkpage($this->session->userdata('role_id'),'ns_rapot_observasi')==false){
					redirect('user_authentication');
			}
		}else{
			redirect('user_authentication');;
		}

	}

	public function index()
	{
			$data= $this->ns_rapot_observasi_db->data();
			$data['action']='ns_rapot_observasi';
			$data['form']='Observasi Peserta Didik';
			$data['view']='index';
			$data['actionsave']='ns_rapot_observasi/tambah_p/';
			$this->load->view('ns_rapot_observasi_v', $data);
	}

	// TAMBAH
	//-------------------------------------------------------------------------------------------
	public function tambah_p() {
		$idsiswaarray=$this->input->post("idsiswa");
		$kompetensidump=$this->input->post("kompetensidump");
		foreach((array)$idsiswaarray as $rowidsiswa) {
			if($rowidsiswa<>""){
				if($kompetensidump<>""){
					$result = $this->db->query("DELETE FROM ns_rapot_kompetensi_pesdik WHERE idsiswa='".$rowidsiswa."' AND idkompetensi IN (".$kompetensidump.")") ;
				}
				$idkompetensiarray=$this->input->post("idkompetensi_".$rowidsiswa);
				foreach((array)$idkompetensiarray as $rowidkompetensi) {
					if($rowidkompetensi<>""){
						unset($data);
						$data = array(
							"idsiswa" => $rowidsiswa,
							"idkompetensi" => $rowidkompetensi,
							"modified_date" => $this->dbx->cts(),
							"modified_by" => $this->session->userdata('idpegawai'),
							"created_date" => $this->dbx->cts(),
							"created_by" => $this->session->userdata('idpegawai')
						);
						$id_insert = $this->dbx->tambahdata('ns_rapot_kompetensi_pesdik',$data) ;
						if ($id_insert<>""){$result=TRUE;}
					}
				}
				
			}
		}
		
			?>
			
			<script>
				window.close();
				
			</script>
			<?php

	}
}//end of class
?>
