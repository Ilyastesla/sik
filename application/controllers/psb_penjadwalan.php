<?php

session_start(); //we need to start session in order to access it through CI

Class psb_penjadwalan extends CI_Controller {

public function __construct() {
parent::__construct();

		// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');


		// Load library
		$this->load->library('session');

		// Load database
		$this->load->model('psb_penjadwalan_db');

   if( $this->session->userdata('logged_in')) {
       if($this->dbx->checkpage($this->session->userdata('role_id'),'psb_penjadwalan')==false){
          redirect('user_authentication');
       }
		}else{
			redirect('user_authentication');;
		}

	}

	public function index()
	{
			$data = $this->psb_penjadwalan_db->data();
			$data['form']='Penjadwalan Proses PPDB';
			$data['view']='index';
			$data['action']='psb_penjadwalan';
			$this->load->view('psb_penjadwalan_v', $data);
	}

	// TAMBAH
	//-------------------------------------------------------------------------------------------
  public function tambah($idkeg,$idcalon,$replid='') {
		$data['form']='Penjadwalan Proses PPDB';
		$data['form_small']='Ubah Data';
		$data['view']='tambah';
		$data['action']='psb_penjadwalan/tambah_p/'.$replid;
		$data['keg_id']=$idkeg;
		$data['siswa_id']=$idcalon;
		$data= $this->psb_penjadwalan_db->tambah_db($data,$idcalon,$replid);
		$this->load->view('psb_penjadwalan_v',$data);
	}

	public function tambah_p($id='') {
		$data = array(
										"keg_id"=>$this->input->post("keg_id")
										,"siswa_id"=>$this->input->post("siswa_id")
                    ,"kelas_id"=>$this->input->post("kelas_id")
                    ,"user"=>$this->input->post("user")
										,"idpegawai"=>$this->input->post("idpegawai")
										,"tgl_mulai"=>$this->p_c->tgl_db($this->input->post('tgl_mulai'))." ".$this->input->post('jammulaihour').":".$this->input->post('jammulaiminute').":00"
										,"tgl_akhir"=>$this->p_c->tgl_db($this->input->post('tgl_mulai'))." 00:00:00"
										,"ulang"=>4
                    ,"prioritas"=>2
                    ,"aktif"=>1
										,"modified_date"=> $this->dbx->cts()
										,"modified_by"=> $this->session->userdata('idpegawai')
								);

		if ($id<>""){
			$result = $this->dbx->ubahdata('kegiatan',$data,'replid',$id);
		}else{
			$data = $this->p_c->arraymerge(array('created_date' => $this->dbx->cts()), $data);
			$data = $this->p_c->arraymerge(array('created_by' => $this->session->userdata('idpegawai')), $data);
			$id = $this->dbx->tambahdata('kegiatan',$data) ;
			if ($id<>""){$result=TRUE;}
		}
    //echo $this->db->last_query();die;

		if ($result == TRUE) {
      ?><script>
					window.opener.location.reload();
					window.close();
				</script>
			<?php
		} else {
			$data['error']="Errorr...";
			$this->ubah($id,$data);
		}
	}
	// HAPUS
	//-------------------------------------------------------------------------------------------
	public function hapus($idkeg,$idcalon) {
    $sql="DELETE FROM kegiatan WHERE aktif=1 AND keg_id='".$idkeg."' AND siswa_id='".$idcalon."' ";
    //echo $sql;die;
    $result = $this->db->query($sql);
		if ($result == TRUE) {
      ?><script>
					window.opener.location.reload();
					window.close();
				</script>
			<?php
		}
	}

	public function ubahaktif($id,$aktif=0) {
		$data=array(
				'aktif' =>$aktif
				,"modified_date"=> $this->dbx->cts()
				,"modified_by"=> $this->session->userdata('idpegawai'));
		$result = $this->psb_penjadwalan_db->ubah_pdb($data,$id);
		if ($result == TRUE) {
			redirect('psb_penjadwalan');
		} else {
			$data['error']='Errorr...';
			$this->ubah($id,$data);
		}
	}
}//end of class
?>
