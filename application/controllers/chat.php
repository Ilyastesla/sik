<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class chat extends CI_Controller {

	function __construct(){
        parent::__construct();

       @session_start();

    }
	public function index()
	{
				$this->load->library('ci_chat');
				$this->load->library('menu');
	}

	function pegawaionline(){
				echo $this->menu->build_pegawai();
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
