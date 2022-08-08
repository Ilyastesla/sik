<!DOCTYPE html>
<html>
    <?php $this->load->view('header') ?>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas">
            <?php $this->load->view('menu') ?>
            </aside>
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
<?php $CI =& get_instance();?>
<?php if($view=='index'){ ?>
                <section class="content-header table-responsive">
                    <h1>
                        <?php echo $form ?>
                        <small>List Data</small>
                    </h1>
                    <!--
                        <li><a href="#"><i class="fa fa-file-text"></i>Cetak</a></li>
                        <li><a href="#"><i class="fa fa-file-excel-o"></i>Excel</a></li>
                        -->
                    <ol class="breadcrumb">
                        <li><a href="javascript:void(window.open('<?php echo site_url('hrm_tiket/tambah'); ?>'))" ><i class="fa fa-plus-square"></i> Tambah</a></li>

                    </ol>
                </section>
                <section class="content-header table-responsive">
                    <?php
			        $attributes = array('class' => 'form-horizontal form-validate', 'id' => 'form', 'method' => 'POST', 'novalidate'=>'novalidate','onsubmit'=>'return validate()','autocomplete'=>'off');
		    	echo form_open($action,$attributes);
		    		?>
                	<table width="100%" border="0">
	                    <tr>
                        <th align="left">
                            <label class="control-label" for="minlengthfield">Tanggal</label>
                            <div class="control-group">
                              <div class="controls">:
                                      <?php
                                      echo form_input(array('class' => '', 'id' => 'dp1','name'=>'periode1','value'=>$this->input->post('periode1'),'data-rule-required'=>'false' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'2' ,'placeholder'=>'DD-MM-YYYY','autocomplete'=>'off'));
                                      echo form_input(array('class' => '', 'id' => 'dp2','name'=>'periode2','value'=>$this->input->post('periode2'),'data-rule-required'=>'false' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'2' ,'placeholder'=>'DD-MM-YYYY','autocomplete'=>'off'));
                                      ?>
                                      <?php //echo  <p id="message"></p> ?>
                              </div>
                            </div>
                        </th>
                  </tr>
			            <tr>
				            <th align="left" colspan="4">
				            	<button class='btn btn-primary' name='filter' value="1">Filter</button>
				            	<?php echo "<a href='".site_url($action)."' class='btn btn-danger'>Bersihkan</a>&nbsp;&nbsp;";?>
				            </th>
				         </tr>
		            </table>
		            <?php
			            echo form_close();
		            ?>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-body table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <?php
                                                echo "<th width='50'>No.</th>";
                                                echo "<th width='80'>Kode Tiket</th>";
                                                echo "<th>Pelapor</th>";
                                                echo "<th>Subjek</th>";
                                                //echo "<th>Deskripsi</th>";
                                                //echo "<th>Perihal</th>";
                                                echo "<th>Ruang</th>";
                                                echo "<th>Prioritas</th>";
                                                echo "<th>Tgl. Pengajuan</th>";
                                                echo "<th>Tgl. Batas</th>";
                                                echo "<th>Tujuan</th>";
                                                //echo "<th>Aktif</th>";
                                                echo "<th>Status</th>";
                                                echo "<th width='80'>Aksi</th>";
                                                ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        	<?php
                                        	$CI =& get_instance();
                                        	$no=1;
											foreach((array)$show_table as $row) {
											    echo "<tr>";
											    echo "<td align='center'>".$no++."</td>";
                          echo "<td align='center'>
                               <a href=javascript:void(window.open('".site_url('hrm_tiket/view/'.$row->replid)."'))>".$row->kode_transaksi."</a>
                             </td>";
											    echo "<td align='left'>".$row->perihaltext." - ".$row->subjek."</td>";
                          echo "<td align='center'>".$CI->dbx->getpegawai($row->created_by)."</td>";
											    //echo "<td align='left'>".$row->deskripsi."</td>";
                          //echo "<td align='left'>".$row->perihaltext."</td>";
                          echo "<td align='left'>".$row->ruangtext."</td>";
                          echo "<td align='center'>".$CI->p_c->bgcolortext($row->prioritastext,$row->color)."</td>";
											    echo "<td align='center'>".strtoupper($CI->p_c->tgl_indo($row->tanggal))."</td>";
                          echo "<td align='center'>".strtoupper($CI->dbx->tanggalbatas($row->tanggal,$row->periode,$row->idstatus))."</td>";
                          echo "<td align='center'>".$CI->dbx->getpegawai($row->idtujuan)."</td>";
											    //echo "<td align='center'>".$CI->p_c->cekaktif($row->aktif)."</td>";
                          echo "<td align='center'><b>".strtoupper($row->statustext)."</b></td>";
											    echo "<td align='center'>";
                          if($row->created_by==$this->session->userdata('idpegawai')){
                            if($row->idstatus=='1'){
                              echo "<a href=javascript:void(window.open('".site_url('hrm_tiket/ubah/'.$row->replid)."')) class='btn btn-xs btn-warning fa fa-check-square' ></a>&nbsp;&nbsp;";
                              echo "<a href=javascript:void(window.open('".site_url('hrm_tiket/hapus/'.$row->replid)."')) class='btn btn-xs btn-danger fa fa-minus-square' ></a>&nbsp;&nbsp;";
                            }else{
                              if($row->idstatus<>'4'){
                                echo "<a href=javascript:void(window.open('".site_url('hrm_tiket/jawab/'.$row->replid)."')) class='btn btn-xs btn-primary fa  fa-reply' ></a>&nbsp;&nbsp;";
                              }
                            }
                          }else if($row->idtujuan==$this->session->userdata('idpegawai')){
                              if($row->idstatus<>'4'){
                                echo "<a href=javascript:void(window.open('".site_url('hrm_tiket/jawab/'.$row->replid)."')) class='btn btn-xs btn-primary fa fa-reply' ></a>&nbsp;&nbsp;";
                              }
                          }

                          echo "</td>";
											    echo "</tr>";
											}
											?>

                                        </tbody>
                                        <tfoot>
                                        </tfoot>
                                    </table>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>
              </section><!-- /.content -->
<?php } elseif($view=='tambah'){ ?>
  <script type="text/javascript">
  function perihallainfunction(){
  	var valuex=document.getElementById("idperihal").value;
    if (valuex=="0"){
  		document.getElementById("perihallain").style.visibility ='visible';
  	}else{
  		document.getElementById("perihallain").style.visibility ='hidden';
  	}
  }
  </script>
		    <section class="content-header table-responsive">
	            <h1>
	                <?php echo $form ?>
	                <small><?php echo $form_small ?></small>
	            </h1>
            </section>
            <section class="content">
		        <?php
			        $attributes = array('class' => 'form-horizontal form-validate', 'id' => 'form', 'method' => 'POST');
		    	echo form_open($action,$attributes);
		    	?>
		    	<table width="100%" border="0">
		    		<tr>
		            <th align="left">
	                		<label class="control-label" for="minlengthfield">Subjek</label>
	                		<div class="control-group">
      								<div class="controls">:
      			                	<?php
      			                		echo form_input(array('class' => '', 'id' => 'subjek','name'=>'subjek','value'=>$isi->subjek,'data-rule-required'=>'true' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'2' ,'placeholder'=>'Masukkan 2-100 Karakter'));
      			                	?>
      			                	<?php //echo  <p id="message"></p> ?>
      								</div>
	                		</div>
			            </th></tr>
              <tr>
                  <th align="left">
                  <label class="control-label" for="minlengthfield">Perihal</label>
                  <div class="control-group">
                <div class="controls">:
                        <?php
                          $arridperihal=' id="idperihal" data-rule-required=true onchange="perihallainfunction();"';
                          echo form_dropdown('idperihal',$idperihal_opt,$isi->idperihal,$arridperihal);
                        ?>
                        <input type="textbox" name="perihallain" id="perihallain" style="visibility:hidden">
                </div>
                  </div>
                  </th></tr>
              <tr>
              <th align="left">
              <label class="control-label" for="minlengthfield">Prioritas</label>
              <div class="control-group">
            <div class="controls">:
                    <?php
                      $arridprioritas='data-rule-required=true';
                      echo form_dropdown('idprioritas',$idprioritas_opt,$isi->idprioritas,$arridprioritas);
                    ?>
            </div>
              </div>
              </th></tr>
              <tr>
                 <th align="left">
                     <label class="control-label" for="minlengthfield">Tempat</label>
                     <div class="control-group">
               <div class="controls">:
                       <?php
                         $arridruang='data-rule-required=false';
                 echo form_dropdown('idruang',$idruang_opt,$isi->idruang,$arridruang);			                	?>
                       <?php //echo  <p id="message"></p> ?>
               </div>
                     </div>
                 </th>
              </tr>
              <!--
              <tr>
                <th align="left">
                    <label class="control-label" for="minlengthfield">Tgl. Pengajuan</label>
                    <div class="control-group">
              <div class="controls">:
                      <?php
                        echo form_input(array('class' => '', 'id' => 'dp1','name'=>'tanggal','value'=>$CI->p_c->tgl_form($isi->tanggal),'data-rule-required'=>'false' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'2' ,'placeholder'=>'DD-MM-YYYY','autocomplete'=>'off'));
                      ?>
                      <?php //echo  <p id="message"></p> ?>
              </div>
                    </div>
                </th>
             </tr>
           -->
             <tr>
 		            <th align="left">
 	                		<label class="control-label" for="minlengthfield">Tujuan</label>
 	                		<div class="control-group">
       								<div class="controls">:
 			                	<?php
                          $arridtujuan='data-rule-required=true';
                          echo form_dropdown('idtujuan',$idtujuan_opt,$isi->idtujuan,$arridtujuan);
                        ?>
 			                	<?php //echo  <p id="message"></p> ?>
       								</div>
 	                		</div>
 			            </th></tr>
               <tr>
			        <tr>
			            <th align="left">
	                		<label class="control-label" for="minlengthfield">Deskripsi</label>
	                		<div class="control-group">
								<div class="controls">:
			                	</div>
			            </th>
			        </tr>
			        <tr>
			        	<th>
                            <div class='box-body pad'>
                                    <textarea id="editor1" name="deskripsi" rows="10" cols="80" data-rule-required="true">
                                        <?php echo $isi->deskripsi?>
                                    </textarea>
                                    <script type="text/javascript">CKEDITOR.replace('editor1');</script>
                            </div>
                            <?php //echo  <p id="message"></p> ?>
			            </th></tr>
              <!--
			        <tr>
		            <th align="left">
		        		<label class="control-label" for="minlengthfield">Aktif</label>
		        		<div class="control-group">
							<div class="controls">:
		                	<?php
		                		echo form_checkbox('aktif', '1', $isi->aktif);
		                	?>
		                	<?php //echo  <p id="message"></p> ?>
							</div>
		        		</div>
		            </th></tr>
            </table>

            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <td>cek</td>
                  <td align="left" >Orang yang terlibat:</td>
                </tr>
              </thead>
              <tbody>
                <?php
                foreach((array)$idpegawai_opt as $row) {
                    echo "<tr>";
                    echo "<td width='20'>".form_checkbox('idpegawai[]', $row->replid, $row->cek)."</td>";
                    echo "<td align='left'>".$row->nama."</td>";
                    echo "</tr>";
                }
                ?>
              </tbody>
              <tfoot>
              </tfoot>
              -->
            </table>

            <table width="100%" border="0">
			         <tr>
				            <th align="left">
				            	<button class="btn btn-primary">Simpan</button>
				            	<a href="javascript:void(window.open('<?php echo site_url('hrm_tiket') ?>'))" class="btn btn-success">Batal</a>
				            </th>
				    </tr>
		        </table>
		        	<?php
		        	echo form_close();
		        	?>
	    </section>
<?php } elseif($view=='tujuan'){ ?>
			<section class="content-header table-responsive">
	            <h1>
	                <?php echo $form ?>
	                <small><?php echo $form_small ?></small>
	            </h1>
            </section>
            <section class="content">
			<?php
		        $attributes = array('class' => 'form-horizontal form-validate', 'id' => 'form', 'method' => 'POST', 'novalidate'=>'novalidate');
	    	echo form_open($action,$attributes);
	    	?>
	    	<table width="100%" border="0">
	    		<tr>
	            <th align="left">
	        		<label class="control-label" for="minlengthfield">Subjek hrm_tiket</label>
	        		<div class="control-group">
						<div class="controls">:
	                	<?php
	                		echo $isi->subjek;
	                	?>
						</div>
	        		</div>
	            </th></tr>
	            <tr>
	            <th align="left">
	        		<label class="control-label" for="minlengthfield">Aktif</label>
	        		<div class="control-group">
						<div class="controls">:
	                	<?php
	                		echo $CI->p_c->cekaktif($isi->aktif);
	                	?>
						</div>
	        		</div>
	        		<hr />
	            </th></tr>
<!--------------------------------------------------------------------------------------------------------------------------->
	    		<tr>
	            <th align="left">
	        		<label class="control-label" for="minlengthfield">Peran</label>
	        		<div class="control-group">
						<div class="controls">
						<input type="checkbox" onClick="selectallx('idrole','selectall')" id="selectall" class="selectall"/> Pilih Semua <hr/>

	                	<?php
	                		$CI->p_c->checkbox_one('idrole',$idrole_opt)
	                	?>
	                	<?php //echo  <p id="message"></p> ?>
						</div>
	        		</div>
	            </th></tr>
	            </table>
	            <table border="0">
		            <tr align="left">
			            <td><button class='btn btn-primary'>Simpan</button></td>
		            </tr>
	            </table>
            </section>
	        	<?php
	        	echo form_close();
} elseif($view=='view'){ ?>
			<section class="content-header table-responsive">
	            <h1>
	                <?php echo $form ?>
	                <small><?php echo $form_small ?></small>
	            </h1>
            </section>
            <section class="content">
			<?php
		        $attributes = array('class' => 'form-horizontal form-validate', 'id' => 'form', 'method' => 'POST', 'novalidate'=>'novalidate');
	    	echo form_open($action,$attributes);
	    	?>
	    	<table width="100%" border="0">
          <tr>
	            <th align="left">
	        		<label class="control-label" for="minlengthfield">Kode Tiket</label>
	        		<div class="control-group">
						<div class="controls">:
	                	<?php
	                		echo $isi->kode_transaksi;
	                	?>
						</div>
	        		</div>
	            </th></tr>
	    		<tr>
	            <th align="left">
	        		<label class="control-label" for="minlengthfield">Subjek</label>
	        		<div class="control-group">
						<div class="controls">:
	                	<?php
	                		echo $isi->subjek;
	                	?>
						</div>
	        		</div>
	            </th></tr>
        <tr>
            <th align="left">
        		<label class="control-label" for="minlengthfield">Pelapor</label>
        		<div class="control-group">
        	<div class="controls">:
                	<?php
                		echo $CI->dbx->getpegawai($isi->created_by,0,1);
                	?>
        	</div>
        		</div>
            </th></tr>
        <tr>
            <th align="left">
        		<label class="control-label" for="minlengthfield">Perihal</label>
        		<div class="control-group">
        	<div class="controls">:
                	<?php
                		echo $isi->perihaltext;
                	?>
        	</div>
        		</div>
            </th></tr>
        <tr>
            <th align="left">
        		<label class="control-label" for="minlengthfield">Prioritas</label>
        		<div class="control-group">
        	<div class="controls">:
                	<?php
                		echo $CI->p_c->bgcolortext($isi->prioritastext,$isi->color);
                	?>
        	</div>
        		</div>
            </th></tr>
    <tr>
        <th align="left">
        <label class="control-label" for="minlengthfield">Tgl. Pengajuan</label>
        <div class="control-group">
      <div class="controls">:
              <?php
                echo $CI->p_c->tgl_indo($isi->tanggal);
              ?>
      </div>
        </div>
        </th></tr>
      <tr>
          <th align="left">
      		<label class="control-label" for="minlengthfield">Tgl. Batas</label>
      		<div class="control-group">
      	<div class="controls">:
              	<?php
              		echo $CI->dbx->tanggalbatas($isi->tanggal,$isi->periode,$isi->idstatus);
              	?>
      	</div>
      		</div>
          </th></tr>
        <tr>
            <th align="left">
        		<label class="control-label" for="minlengthfield">Tempat</label>
        		<div class="control-group">
        	<div class="controls">:
                	<?php
                		echo $isi->ruangtext;
                	?>
        	</div>
        		</div>
            </th></tr>
        <tr>
            <th align="left">
        		<label class="control-label" for="minlengthfield">Tujuan</label>
        		<div class="control-group">
        	<div class="controls">:
                	<?php
                		echo $CI->dbx->getpegawai($isi->idtujuan,0,1);
                	?>
        	</div>
        		</div>
            </th></tr>
        <tr>
            <th align="left">
            <label class="control-label" for="minlengthfield">Status</label>
            <div class="control-group">
          <div class="controls">:
                  <?php
                    echo $isi->statustext;
                  ?>
          </div>
            </div>
            </th></tr>
        <tr>
            <th align="left">
        		<label class="control-label" for="minlengthfield">Deskripsi</label>
            </th></tr>
      <tr>
          <th align="left">
                <?php
                  echo $isi->deskripsi;
                ?>
          </th></tr>
          <tr><th align="left"><hr/></th></tr>
          <tr>
            <td>

                <?php
                  echo "<div class='box box-primary'>";
                  echo "<div class='box-header with-border'><h4 class='box-title'>Diskusi Tiket</h4></div>";
                  echo "<div class='box-footer box-comments'>";
                  foreach((array)$isithread as $thread) {
                    echo "<div class='box-comment'>";
                    //echo "<img class='img-circle img-sm' src='../dist/img/user3-128x128.jpg' alt='User Image'>";
                    echo "<div class='comment-text' align='left'>";
                    echo "<span class='username'>".$CI->dbx->getpegawai($thread->created_by,0,1);
                    echo " | Status Tiket: ".$thread->statustext;
                    echo "<span class='text-muted pull-right'>".$thread->created_date."</span>";
                    echo "</span>";
                    echo $thread->jawaban."<br/>";
                    if($thread->idserahtugas<>""){
                      echo "<u>Tiket dipindahtugaskan kepada: ".$CI->dbx->getpegawai($thread->idserahtugas,0,1)."</u><br/>";
                    }
                    //echo "<div class='box-header with-border'><h4 class='box-title'>".$CI->dbx->getpegawai($thread->created_by)."</h4></div>";
                    //echo "<div class='comment-text' align='left'>".$thread->jawaban."</div>";
                    echo "</div>";
                    echo "</div>";
                  }
                  echo "</div>";
                  echo "</div>";
                ?>
              </div>
            </td>
          </tr>
          <tr><th align="left"><hr/></th></tr>
<!--------------------------------------------------------------------------------------------------------------------------->
          <!--
          <tr>
	            <th align="left">
	        		<label class="control-label" for="minlengthfield">Peran</label>
	        		<div class="control-group">
						<div class="controls">
	                	<?php
	                		$CI->p_c->checkbox_one('idrole',$idrole_opt,'disabled')
	                	?>
	                	<?php //echo  <p id="message"></p> ?>
						</div>
	        		</div>
	            </th></tr>
            -->
            <?php if(($isi->idstatus<>"4") AND ($jawab==1) AND ($isi->created_by==$this->session->userdata('idpegawai') OR $isi->idtujuan==$this->session->userdata('idpegawai'))){ ?>
            <?php if($isi->created_by<> $this->session->userdata('idpegawai')){ ?>
            <tr>
               <th align="left">
                     <label class="control-label" for="minlengthfield">Penyerahan Tugas</label>
                     <div class="control-group">
                     <div class="controls">:
                       <?php
                         $arridserahtugas='data-rule-required=false';
                         echo form_dropdown('idserahtugas',$idserahtugas_opt,'',$arridserahtugas);
                       ?>
                       <?php //echo  <p id="message"></p> ?>
                     </div>
                     </div>
                 </th></tr>
            <?php } // $isi->created_by<> $this->session->userdata('idpegawai')
            ?>
            <tr>
               <th align="left">
                     <label class="control-label" for="minlengthfield">Status</label>
                     <div class="control-group">
                     <div class="controls">:
                       <?php
                         $arridstatus='data-rule-required=false';
                         echo form_dropdown('idstatus',$idstatus_opt,$isi->idstatus,$arridstatus);
                       ?>
                       <?php //echo  <p id="message"></p> ?>
                     </div>
                     </div>
                 </th></tr>
            <tr>
                <th align="left">
                    <label class="control-label" for="minlengthfield">Jawaban</label>
                    <div class="control-group">
              <div class="controls">:
                      </div>
                </th>
            </tr>
            <tr>
              <th>
                          <div class='box-body pad'>
                                  <textarea id="editor1" name="jawaban" rows="10" cols="80" data-rule-required="true">
                                      <?php echo $isijawab->jawaban?>
                                  </textarea>
                                  <script type="text/javascript">CKEDITOR.replace('editor1');</script>
                          </div>
                          <?php //echo  <p id="message"></p> ?>
                </th></tr>
          <?php } //(($jawab==1) AND ($isi->created_by==$this->session->userdata('idpegawai') OR $isi->idtujuan==$this->session->userdata('idpegawai')))

          ?>
          </table><br/>
          <table>
	            <tr>
		            <td align="left">
              <?php
                  if(($isi->idstatus<>"4") AND ($jawab==1) AND ($isi->created_by==$this->session->userdata('idpegawai') OR $isi->idtujuan==$this->session->userdata('idpegawai'))){
                    echo "<input type='hidden' name='statuson' value='".$isi->idstatus."'>";
                    echo "<button class='btn btn-primary'>Simpan</button>&nbsp;&nbsp;";
                    echo "<a href=javascript:void(window.open('".site_url("hrm_tiket/view/".$isi->replid)."')) class='btn btn-success'>Kembali</a>&nbsp;&nbsp;";
                  }else{
                      if($isi->created_by==$this->session->userdata('idpegawai')){
                      if($isi->idstatus=='1'){
                        echo "<a href=javascript:void(window.open('".site_url('hrm_tiket/ubah/'.$isi->replid)."')) class='btn btn-warning'>Ubah</a>&nbsp;&nbsp;";
                        echo "<a href=javascript:void(window.open('".site_url('hrm_tiket/hapus/'.$isi->replid)."')) class='btn btn-xs btn-danger'>Hapus</a>&nbsp;&nbsp;";
                      }else{
                        if($isi->idstatus<>'4'){
                          echo "<a href=javascript:void(window.open('".site_url('hrm_tiket/jawab/'.$isi->replid)."')) class='btn btn-xs btn-primary'>Jawab</a>&nbsp;&nbsp;";
                        }

                      }
                    }else if($isi->idtujuan==$this->session->userdata('idpegawai')){
                      if($isi->idstatus<>'4'){
                        echo "<a href=javascript:void(window.open('".site_url('hrm_tiket/jawab/'.$isi->replid)."')) class='btn btn-xs btn-primary' >Jawab</a>&nbsp;&nbsp;";
                      }
                    }
                    echo "<a href=javascript:void(window.open('".site_url("hrm_tiket")."')) class='btn btn-success'>Kembali</a>&nbsp;&nbsp;";
                  }
                ?>

		            </td>
	            </tr>
	            </table>
            </section>
	        	<?php
	        	echo form_close();
 } ?>
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
    </body>
</html>
