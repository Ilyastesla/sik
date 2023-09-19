<?php

session_start(); //we need to start session in order to access it through CI

Class ns_prosestipe extends CI_Controller {

public function __construct() {
parent::__construct();

		// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');


		// Load session library
		$this->load->library('session');

		// Load database
		$this->load->model('ns_prosestipe_db');

		if( $this->session->userdata('logged_in')) {
			if($this->dbx->checkpage($this->session->userdata('role_id'),'ns_prosestipe')==false){
					redirect('user_authentication');
			}
		}else{
			redirect('user_authentication');;
		}

	}

	public function index()
	{
			$data= $this->ns_prosestipe_db->data();
			$data['action']='ns_prosestipe';
			$data['form']='Tipe Proses';
			$data['view']='index';
			$this->load->view('ns_prosestipe_v', $data);
	}

	// TAMBAH
	//-------------------------------------------------------------------------------------------
	public function tambah($id='') {
		$data['form']='Tipe Proses';
		$data['form_small']='Tambah Data';
		$data['view']='tambah';
		$data['action']='ns_prosestipe/tambah_p';
		$data= $this->ns_prosestipe_db->tambah_db($id,$data);
		$this->load->view('ns_prosestipe_v',$data);
	}

	public function tambah_p($id='') {
		$data = array(
				'prosestipe' => $this->input->post('prosestipe'),
				'iddepartemen' => $this->input->post('iddepartemen'),
				'keterangan' => $this->input->post('keterangan'),
				'nilaiwali' => $this->input->post('nilaiwali'),
				"kurikulumkode" => $this->input->post("kurikulumkode"),
				'aktif' => $this->input->post('aktif'),
				'no_urut' => $this->input->post('no_urut'),
				"modified_date"=> $this->dbx->cts(),
				"modified_by"=> $this->session->userdata('idpegawai'));

		if ($id<>""){
			$result = $this->ns_prosestipe_db->ubah_pdb($data,$id) ;
		}else{
			$data = $this->p_c->arraymerge(array('created_date' => $this->dbx->cts()), $data);
			$data = $this->p_c->arraymerge(array('created_by' => $this->session->userdata('idpegawai')), $data);
			$id = $this->ns_prosestipe_db->tambah_pdb($data) ;
			if ($id<>""){$result=TRUE;}
		}

		if($id<>""){
			$result = $this->db->query("DELETE FROM ns_reff_company WHERE tipe='ns_prosestipe' AND idvariabel='".$id."'");
			foreach((array)$this->input->post('idcompany') as $rowcompany) {
					$datacompany = array(
						'tipe'=>'ns_prosestipe',
						'idvariabel'=>$id,
						'idcompany' => $rowcompany,
						'created_date' => $this->dbx->cts(),
						'created_by' => $this->session->userdata('idpegawai'),
						"modified_date"=> $this->dbx->cts(),
						"modified_by"=> $this->session->userdata('idpegawai')
					);
					$this->dbx->tambahdata('ns_reff_company',$datacompany) ;
			}

			$result = $this->db->query("DELETE FROM ns_prosestiperapottipe WHERE idprosestipe='".$id."'");
			foreach((array)$this->input->post('idrapottipe') as $rowidrapottipe) {
					$datacompany = array(
						'idprosestipe'=>$id,
						'idrapottipe' => $rowidrapottipe,
					);
					$this->dbx->tambahdata('ns_prosestiperapottipe',$datacompany) ;
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
		$data['form']='Tipe Proses';
		$data['form_small']='Ubah Data';
		$data['view']='tambah';
		$data['action']='ns_prosestipe/tambah_p/'.$id;
		$data= $this->ns_prosestipe_db->tambah_db($id,$data);
		$this->load->view('ns_prosestipe_v',$data);
	}

	//Hapus
	public function hapus($id) {
		$result = $this->ns_prosestipe_db->hapus_pdb($id) ;
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
					'aktif' =>$aktif);
			$result = $this->ns_prosestipe_db->ubah_pdb($data,$id);
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

	public function ubahnilaiwali($id,$nilaiwali) {
			$data=array(
					'nilaiwali' =>$nilaiwali);
			$result = $this->ns_prosestipe_db->ubah_pdb($data,$id);
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

}//end of class
?>
