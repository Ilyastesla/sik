<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class menu {

    private $ci;
    private $id_menu        = 'id="menu"';
    private $class_menu     = 'class="menu"';
    private $class_parent   = 'class="parent"';
    private $class_last     = 'class="last"';


    function __construct()
    {
        //parent::__construct();
        $this->ci =& get_instance();    // get a reference to CodeIgniter.
    }

    function build_menu()
    {
        if ($this->ci->uri->total_segments()>4){
            //urldecode($this->uri->segment(4));
        }

        $html_out="";
        //echo $this->ci->session->userdata('role_id');
        //die;

        /*
        $html_out .= "<li><a href='".site_url("main/menu/main/1")."'>
                            <i class='fa fa-dashboard'></i> <span>BERANDA</span>
                        </a></li>";
        */

        if ($this->ci->session->userdata('role_id')<>""){$xrole=$this->ci->session->userdata('role_id');}else{$xrole='NULL';}

        $sql="SELECT DISTINCT md.replid,md.pages,md.icon,md.nama from hrm_modul md
        		INNER JOIN hrm_menu mn ON mn.modul_id=md.replid
        		INNER JOIN hrm_role_map rm ON rm.submenu_id=mn.replid
        		WHERE rm.role_id IN (".$xrole.") AND mn.aktif=1 AND md.aktif=1 ORDER BY md.no_urut";
        $query = $this->ci->db->query($sql);

        foreach($query->result() as $row)
        {
        	$tv="";
        	$sql2="SELECT DISTINCT mn.replid,mn.pages,mn.nama
        			FROM hrm_menu mn
	        		INNER JOIN hrm_role_map rm ON rm.submenu_id=mn.replid
	        		WHERE rm.role_id IN (".$xrole.") AND mn.modul_id=".$row->replid." AND mn.aktif=1
	        		ORDER BY mn.no_urut,mn.nama";
        	$query2 = $this->ci->db->query($sql2);
        	if ($query2->num_rows() > 0){
        		if (trim($row->replid==$this->ci->session->userdata('head_menu'))){
	        		$tv="class='treeview active'";
	        	}else {$tv="class='treeview'";}
	        	$t="<i class='fa fa-angle-left pull-right'></i>";
        	}else {$tv="";$t="";}

            //$html_out .= "<li ".$tv."><a href='".site_url("main/menu/".$row->pages."/".$row->replid)."'>
            $html_out .= "<li ".$tv."><a href='".site_url($row->pages)."'>
                            <i class='".$row->icon."'></i> <span>".strtoupper($row->nama)."</span>
                            ".$t."
                        </a>";

             if ($query2->num_rows() > 0) {
	             $html_out .= "<ul class='treeview-menu'>";
	             foreach($query2->result() as $row2)
	             {

		           //$html_out .= "<li><a href='".site_url("main/menu/".$row2->pages."/".$row->replid)."'>
               $html_out .= "<li><a href='".site_url($row2->pages)."'>
                            <i class='fa fa-angle-double-right'></i> <span>".$row2->nama."</span>
                        </a>";
	             }
	             $html_out .= "</ul>";
             }
            $html_out .= "</li>";
         }

                  //$html_out .= $this->get_childs($id);
        return $html_out;
    }

    function build_pegawai(){
      $sqltotcon="show status where `variable_name` = 'Threads_connected';";
      $querytotcon = $this->ci->db->query($sqltotcon);
      $totcon = $querytotcon->row();
      //echo var_dump($totcon);
      $html_out="";
      $sql="SELECT *
                    , (SELECT COUNT(id) FROM chat
      								WHERE (`from` = p.nip  AND  `to` = '".$this->ci->session->userdata('nip')."' ) AND is_read=0) as totread
                  FROM pegawai p
                  INNER JOIN login l ON p.nip=l.login
                  WHERE p.aktif=1 AND l.aktif=1 AND l.online=1 AND l.login<>'".$this->ci->session->userdata('nip')."'
                  ORDER BY totread DESC,p.nama ASC";
      $query = $this->ci->db->query($sql);
      //$html_out="<br/>&nbsp;&nbsp;<b><font size='+1'>:: Pengguna Daring</font></b>";
      $html_out="<div id='penggunaonline'><b><font class='sidebar-menu'><h4>&nbsp;:: Pengguna Aktif <small class='badge pull-right bg-yellow'>".COUNT($query->result())."</small><small class='badge pull-right bg-red'>".$totcon->Value."</small></font></b></h5>";
      $html_out =$html_out."<div style='overflow:scroll; max-height:70vh;'><ul class='sidebar-menu'>";
      foreach($query->result() as $rowpeg){
          $nama="'".strtoupper($rowpeg->nama)."'";
          $nip="'".$rowpeg->nip."'";
          $imgstat='';
          if ($rowpeg->totread>0){
            $imgstat="<font color='red'><b>[".$rowpeg->totread."]</b></font>";
            ?>
            <script>
                chatWith('<?php echo $rowpeg->nip ?>','<?php echo $rowpeg->nama ?>',0);
            </script>
            <?php
          }
          $html_out .='<li onclick="javascript:chatWith('.$nip.','.$nama.',1)" ><span>&nbsp;&nbsp;&nbsp;<img src="'.base_url().'/images/online.png"  width="10px">'.strtoupper($rowpeg->nama).' &nbsp; '.$imgstat.'<span></li>';
      }
      $html_out .="</ul></div></div>";
      return $html_out;
    }
}
 ?>
