<?php

session_start(); //we need to start session in order to access it through CI

Class hrm_recruitement_process extends CI_Controller {

	public function __construct() {
	parent::__construct();

		// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');


		// Load session library
		$this->load->library('session');

		// Load database
		$this->load->model('hrm_recruitement_process_db');
		$this->load->model('fotodisplay_db');

   if( $this->session->userdata('logged_in')) {
       if($this->dbx->checkpage($this->session->userdata('role_id'),'hrm_recruitement_process')==false){
          redirect('user_authentication');
       }
		}else{
			redirect('user_authentication');;
		}

	}

	public function index($aktif="1")
	{
		$data= $this->hrm_recruitement_process_db->data();
		$data['form']='Proses Pelamar';
    $data['view']='index';
		$this->load->view('hrm_recruitement_process_v', $data);
	}

  public function proses($id) {
		$data['form']='Proses Pelamar';
		$data['form_small']='Proses';
		$data['view']='proses';
		$data['action']='hrm_recruitement_process/proses_p';
		//$data= $this->hrm_recruitement_process_db->data($id,$data);
		$this->load->view('hrm_recruitement_process_v',$data);
	}

  public function prosespelamar($id) {
    $data= $this->hrm_recruitement_process_db->data($id);
		$data['form']='Proses Pelamar';
		$data['form_small']='Proses';
		$data['view']='proses';
		$data['action']='hrm_recruitement_process/proses_p/7/'.$id;
		$data= $this->hrm_recruitement_process_db->tambah_db($id,$data);
		$this->load->view('hrm_recruitement_process_v',$data);
	}

  public function batal($id) {
    $data= $this->hrm_recruitement_process_db->data($id);
		$data['form']='Pembatalan Proses';
		$data['form_small']='Proses';
		$data['view']='batal';
		$data['action']='hrm_recruitement_process/proses_p/8/'.$id;
		$data= $this->hrm_recruitement_process_db->tambah_db($id,$data);
		$this->load->view('hrm_recruitement_process_v',$data);
	}

  public function proses_p($status,$id) {
	   $data = array(
        "status"=>$status,
				"modified_date"=> $this->dbx->cts(),
				"modified_by"=> $this->session->userdata('idpegawai'));
    if($status=="7"){
      $data = $this->p_c->arraymerge(array('tglbekerja' => $this->p_c->tgl_db($this->input->post('tglbekerja'))), $data);
    }else if($status=="8"){
      $data = $this->p_c->arraymerge(array("idtipealasan"=> $this->input->post("idtipealasan"), "alasantext"=> $this->input->post("alasantext")), $data);
    }
    $result = $this->dbx->ubahdata('hrm_recruitement_progress',$data,'replid',$id) ;

    // UPDATE NIP
    if($status=="7"){
      if($this->input->post('niksementara')<>""){
        $nik=$this->input->post('niksementara');
      }else{
        $nik=$this->hrm_recruitement_process_db->niksementara($id);
      }
      $result = $this->dbx->ubahdata('hrm_recruitement_progress',array("niksementara"=>$nik),'replid',$id) ;
    } else if($status=="9"){
        $result = $this->hrm_recruitement_process_db->imporpegawai($id);
    }
    //echo $this->db->last_query();die;
		if ($result == TRUE) {
				$data = array(
					"idhrm_recruitement_progress"=> $id,
					"status"=>$status,
							"created_date"=> $this->dbx->cts(),
							"created_by"=> $this->session->userdata('idpegawai'));
				$this->dbx->tambahdata('hrm_recruitement_history',$data) ;
				
				if($status=="9"){
					$sqlidrec="SELECT idhrm_recruitement as isi FROM hrm_recruitement_progress WHERE replid='".$id."'";
					$idhrm_recruitement=$this->dbx->singlerow($sqlidrec);
					$data = array(
						"aktif"=>0,
								"modified_date"=> $this->dbx->cts(),
								"modified_by"=> $this->session->userdata('idpegawai'));
					$this->dbx->ubahdata('hrm_recruitement',$data,'replid',$idhrm_recruitement) ;
				}
				//echo $this->db->last_query();die;
			?><script>
					window.opener.location.reload();
					window.close();
				</script>
			<?php
		} else {
			?><script>
					window.opener.location.reload();
					window.close();
				</script>
			<?php
		}
	}
} //end of class
?>
