<?php

session_start(); //we need to start session in order to access it through CI

Class inventory_material extends CI_Controller {

public function __construct() {
	parent::__construct();

		// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');


		// Load session library
		$this->load->library('session');

		// Load database
		$this->load->model('inventory_material_db');

   if( $this->session->userdata('logged_in')) {
       if($this->dbx->checkpage($this->session->userdata('role_id'),'inventory_material')==false){
          redirect('user_authentication');
       }
		}else{
			redirect('user_authentication');;
		}

	}

	public function index()
	{
			$data= $this->inventory_material_db->data();
			$data['form']='Material Barang';
			$data['view']='index';
			$this->load->view('inventory_material_v', $data);
	}

	// TAMBAH
	//-------------------------------------------------------------------------------------------
	public function tambah($idpermintaan_barang='',$id='',$from='') {
		$data['form']='Material Barang';
		$data['form_small']='Tambah Data';
		$data['view']='tambah';
		$data['action']='inventory_material/tambah_p';
		$data['idpermintaan_barang']=$idpermintaan_barang;
		if (isset($from)){
			$data['from']=$from;
		}else{
			$data['from']="";
		}
		$data= $this->inventory_material_db->tambah_x($id,$data);
		$this->load->view('inventory_material_v',$data);
	}

	public function tambah_p($id='') {
		$kom1=$this->input->post('idkelompok');
		$kom2=$this->input->post('idkelompok2');
		$idmerek=$this->input->post('idmerek');
		$kodematerial="";
		//$last_id=$this->session->userdata('last_id');

		$idpermintaan_barang=$this->input->post('idpermintaan_barang');
		$last_page=$this->input->post('page_');

		if ($this->input->post('idmerek')==""){
		$datamerek = array(
			'nama' => $this->input->post('nama_merek')
			,'aktif' => 1
			,'modified_date' =>$this->dbx->cts()
			,'modified_by' => $this->session->userdata('idpegawai')
			,'created_date' => $this->dbx->cts()
			,'created_by' => $this->session->userdata('idpegawai')
			);
		$idmerek = $this->dbx->tambahdata('inventory_merek',$datamerek);
		}
    //,'idfiskal' => $this->input->post('idfiskal')
    $data = array(
			'nama' => $this->input->post('nama')
			,'idkelompok' => $this->input->post('idkelompok')
			,'idkelompok_inventaris' => $this->input->post('idkelompok_inventaris')
			,'idmerek' => $idmerek
			,'spesifikasi' => $this->input->post('spesifikasi')
			,'inventaris' => $this->input->post('inventaris')
			,'aktif' => $this->input->post('aktif')
			,'stock_min' => $this->input->post('stock_min')
			,'modified_date' =>$this->dbx->cts()
			,'modified_by' => $this->session->userdata('idpegawai')
        );
		if ($id<>""){
			$result = $this->dbx->ubahdata('inventory_material',$data,'replid',$id);
		}else{
			$data = $this->p_c->arraymerge(array('created_date' => $this->dbx->cts()), $data);
			$data = $this->p_c->arraymerge(array('created_by' => $this->session->userdata('idpegawai')), $data);
      		$kodematerial=$this->dbx->kodematerial($this->input->post('idkelompok'));
			$data = $this->p_c->arraymerge(array('kode' => $kodematerial), $data);
			$id = $this->dbx->tambahdata('inventory_material',$data) ;
			if ($id<>""){$result=TRUE;}
		}

    	if ($result <> false) {
			if (($idpermintaan_barang=="") OR ($idpermintaan_barang=="0")){
				?><script>
					window.opener.location.reload();
					window.close();
				</script>
				<?php
			}else{
        	$data = array(
						"idpermintaan_barang"=>$idpermintaan_barang,
						"idmaterial"=> $result,
						"jumlah"=> 1,
						"idperuntukan"=>9,
						"idunit"=> 1
						);
				$result = $this->dbx->tambahdata('inventory_permintaan_barang_mat',$data);
				if ($result<>false){
						redirect($last_page."/".$result);
				}else{
						redirect($last_page);
				}
				die;
			}
		} else {
			$data['error']='Errorr...';
			$this->ubahmaterial($idpermintaanbarang,$id,$data);
		}
	}

	// UBAH
	//-------------------------------------------------------------------------------------------
	public function ubah($idpermintaan_barang='',$id='',$from='') {
		$data['form']='Material Barang';
		$data['form_small']='Ubah Data';
		$data['view']='tambah';
		$data['action']='inventory_material/tambah_p/'.$id;
    	$data['idpermintaan_barang']=$idpermintaan_barang;
		if (isset($from)){
			$data['from']=$from;
		}else{
			$data['from']="";
		}
		$data= $this->inventory_material_db->tambah_x($id,$data);
		$this->load->view('inventory_material_v',$data);
	}

	public function hapus($id) {
		$result = $this->dbx->hapusdata('inventory_material','replid',$id) ;
		if ($result == TRUE) {
			?><script>
					window.opener.location.reload();
					window.close();
				</script>
			<?php
		}
	}

	public function view($id='') {
		$data['form']='Material Barang';
		$data['view']='view';
		$data['action']='inventory_material/ubah/'.$id;
		$data= $this->inventory_material_db->view_db($id,$data);
		$this->load->view('inventory_material_v',$data);
	}

	public function ubahaktifmaterial($id,$aktif) {
			$data=array(
					'aktif' =>$aktif);
			$result = $this->dbx->ubahdata('inventory_material',$data,'replid',$id);
			if ($result == TRUE) {
				redirect('inventory_material');
			} else {
				$data['error']='Errorr...';
				$this->ubah($id,$data);
			}
	}

}//end of class
?>
