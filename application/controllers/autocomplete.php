<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Autocomplete extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function search($table)
	{
		$fil="";$var="";$filtext="";
		if ($this->uri->total_segments()>4){
				$fil=urldecode($this->uri->segment(4));
				$var=urldecode($this->uri->segment(5));
				$filtext=" AND ".$fil."=".$var;
				// tangkap variabel keyword dari URL
				$keyword = urldecode($this->uri->segment(6));
		}else{
			// tangkap variabel keyword dari URL
			$keyword = urldecode($this->uri->segment(4));
		}
		$sql="SELECT * FROM ".$table." WHERE nama like '%".$keyword."%' ".$filtext;
		$data = $this->db->query($sql);
		//echo $sql;

		// format keluaran di dalam array
		if ($data->num_rows() > 0) {
			foreach((array)$data->result() as $row)
			//foreach($data->result() as $row)
			{
				$arr['query'] = $keyword;
				$arr['suggestions'][] = array(
					'value'	=>$row->nama,
					'replid'	=>$row->replid
				);
			}
		}else{
			$arr=null;
		}
		echo json_encode($arr);
	}


	public function searchinventory()
	{
		$keyword=urldecode($this->uri->segment(3));
		//echo $keyword;
		$sql="SELECT pb.*,CONCAT(pb.kode_inventaris,' ',m.nama) as namamaterial,pbx.iddepartemen,pbx.pemohon 
					FROM inventory_penyerahan_barang_mat pb
					INNER JOIN inventory_material m ON m.replid=pb.idmaterial
					INNER JOIN inventory_permintaan_barang pbx ON pbx.replid=pb.idpermintaanbarang  
					WHERE pb.kode_inventaris<>'' AND (m.nama like '%".$keyword."%' OR TRIM(pb.kode_inventaris) LIKE '%".$keyword."%') ";
		$data = $this->db->query($sql);
		//echo $sql;

		// format keluaran di dalam array
		if ($data->num_rows() > 0) {
			foreach((array)$data->result() as $row)
			//foreach($data->result() as $row)
			{
				$arr['query'] = $keyword;
				$arr['suggestions'][] = array(
					'value'	=>$row->namamaterial,
					'replid'	=>$row->replid,
					'iddepartemen'	=>$row->iddepartemen,
					'idpj'	=>$row->idpj,
					'idpemohon'	=>$row->pemohon,
					'idruang'	=>$row->idruang,
					'idkondisi'	=>$row->idkondisi
				);
			}
		}else{
			$arr=null;
		}
		echo json_encode($arr);
	}
}
?>
