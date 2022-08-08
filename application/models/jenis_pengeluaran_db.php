<?php

Class jenis_pengeluaran_db extends CI_Model {
  public function __construct() {
    parent::__construct();
    $this->load->library('dbx');
  }
    // Read data from database to show data in admin page
    public function data() {

      	$sql="SELECT * FROM hrm_datapengeluaran ORDER BY nama";
      	return $this->dbx->data($sql);
    }

     //TAMBAH
    public function input_add($data=''){
    	if ($data<>""){
	    	$nama=$data['nama'];
	    	$keterangan=$data['keterangan'];
	    	$aktif=$data['aktif'];
    	}else{
	    	$nama='';
	    	$keterangan='';
	    	$aktif='';
    	}

    	$data['stat']="Tambah";
    	$data['form']='Jenis Pengeluaran';
    	$data['action']='jenis_pengeluaran/tambah_p';
		$data['input']=array(
							array('Nama','form_input'
								,array('class' => '', 'id' => 'nama','name'=>'nama','value'=>$nama,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'2' ,'placeholder'=>'Masukkan 2-100 Karakter'))
							,array('Keterangan','form_textarea'
								,array('class' => '', 'id' => 'keterangan','name'=>'keterangan','value'=>$keterangan,'data-rule-required'=>'false' ,'data-rule-maxlength'=>'255', 'data-rule-minlength'=>'2' ,'placeholder'=>'Maksimal 255 Karakter'))
							,array('Aktif','form_checkbox'
								,array('class' => '', 'id' => 'aktif','name'=>'aktif','value' => '1','data-rule-required'=>'false','checked'=>$aktif))
							,array('','form_submit'
								,array('class' => 'btn btn-primary', 'id' => 'save','name'=>'save','value'=>'Save'))
						);
	return $data;
  }


  public function insert($data) {
        // Query to check whether username already exist or not
        /*
        $condition = "kode =" . "'" . $data['kode'] . "'";
        $this->db->select('*');
        $this->db->from('hrm_datapengeluaran');
        $this->db->where($condition);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() == 0) {
        } else {
            return false;
        }
        */

            // Query to insert data in database
        $this->db->insert('hrm_datapengeluaran', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    //UBAH
    public function input_edit($id){
    	$data['stat']="Ubah";
    	$data['form']='Jenis Pengeluaran';
    	$data['action']='jenis_pengeluaran/ubah_p/'.$id;
    	$sql="SELECT * FROM hrm_datapengeluaran WHERE replid='".$id."'";
      	$query=$this->db->query($sql);
        $row = $query->row();
		$data['input']=array(
							array('Nama','form_input'
								,array('class' => '', 'id' => 'nama','name'=>'nama','value'=>$row->nama,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'2' ,'placeholder'=>'Masukkan 2-100 Karakter'))
							,array('Keterangan','form_textarea'
								,array('class' => '', 'id' => 'keterangan','name'=>'keterangan','value'=>$row->keterangan,'data-rule-required'=>'false' ,'data-rule-maxlength'=>'255', 'data-rule-minlength'=>'2' ,'placeholder'=>'Maksimal 255 Karakter'))
							,array('Aktif','form_checkbox'
								,array('class' => '', 'id' => 'aktif','name'=>'aktif','value' => '1','data-rule-required'=>'false','checked'=>$row->aktif))
							,array('','form_submit'
								,array('class' => 'btn btn-primary', 'id' => 'save','name'=>'save','value'=>'Save'))
						);
	return $data;
  }

  public function ubah($data,$id) {
        // Query to check whether username already exist or not
        /*
        $condition = "kode =" . "'" . $data['kode'] . "' AND replid<>'".$id."'";
        $this->db->select('*');
        $this->db->from('hrm_datapengeluaran');
        $this->db->where($condition);
        $this->db->limit(1);

        $query = $this->db->get();
        if ($query->num_rows() == 0) {
        } else {
            return false;
        }
        */
        $this->db->where('replid',$id);
        $this->db->update('hrm_datapengeluaran', $data);
        if ($this->db->_error_number() == 0) {
            return true;
        } else {
            return false;
        }
    }

    public function hapus($id) {
        // Query to check whether username already exist or not
        $this->db->where('replid',$id);
        $this->db->delete('hrm_datapengeluaran');
        if ($this->db->_error_number() == 0) {
	        return true;
        } else {
            return false;
        }
    }
}

?>
