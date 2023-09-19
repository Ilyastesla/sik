<?php
Class sandbox_db extends CI_Model {
    public function __construct() {
        parent::__construct();
            $this->load->library('dbx');	
        }

    public function loaddata($variabel){
    
        $sql="SELECT d.*,d.departemen as nama,d.kodedepartemen as companytext FROM hrm_departemen d 
                WHERE replid='".$variabel."'
                LIMIT 2";
        //echo $sql;

        
        $data["show_table"]=$this->dbx->data($sql);
        echo var_dump($data["show_table"]);
        $data["idcompany_opt"]=$this->dbx->opt($sql);
        return $data;

    }
}
