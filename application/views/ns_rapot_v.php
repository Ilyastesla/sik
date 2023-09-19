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
<?php $CI =& get_instance();?>
<?php if($view=='index'){ ?>
                <!-- Content Header (Page header) -->
                <section class="content-header table-responsive">
                    <h1>
                        <?php echo $form ?>
                        <small>List Data</small>
                    </h1>

                    <ol class="breadcrumb">
						<!--
                        <li><a href="javascript:void(window.open('<?php echo site_url('ns_rapot/tambah'); ?>'))" ><i class="fa fa-plus-square"></i> Tambah</a></li>
                        
                        <li><a href="#"><i class="fa fa-file-text"></i>Cetak</a></li>
                        <li><a href="#"><i class="fa fa-file-excel-o"></i>Excel</a></li>
                        -->
                    </ol>
                </section>
                <section class="content-header table-responsive">
                    <?php
			        $attributes = array('class' => 'form-horizontal form-validate', 'id' => 'form', 'method' => 'POST', 'novalidate'=>'novalidate','onsubmit'=>'return validate()');
		    	echo form_open($action,$attributes);
		    		?>
                	<table width="100%" border="0">
	                    <tr>
						<td align="left" width="150">Unit Bisnis</td>
                                <td align="left"><div class="control-group">
                      <?php
                                    $arridcompany="data-rule-required=true id=idcompany onchange='javascript:this.form.submit();'";
                                    echo form_dropdown('idcompany',$idcompany_opt,$this->input->post('idcompany'),$arridcompany);
                                    ?>
                                        <?php //echo  <p id="message"></p> ?>
                                  
                  </div>    </td>
	                    	<td align="left" width="150">Tahun Pelajaran</td>
				            <td align="left">
                      <div class="control-group">
				            	<?php
			                		$arridtahunajaran="data-rule-required=true id=idtahunajaran  onchange='javascript:this.form.submit();' ";
			                		echo form_dropdown('idtahunajaran',$idtahunajaran_opt,$this->input->post('idtahunajaran'),$arridtahunajaran);
			                	?>
                      </div>
				            </td>
                    
			            </tr>
					<tr>
					<td align="left" width="150">Semester</td>
				            <td align="left">
                      <div class="control-group">
				            	<?php
			                		$arridperiode="data-rule-required=true id=idperiode";
			                		echo form_dropdown('idperiode',$idperiode_opt,$this->input->post('idperiode'),$arridperiode);
			                	?>
                      </div>
				            </td>
							<td align="left" width="150">Tipe Rapor</td>
				            <td align="left">
                      <div class="control-group">
				            	<?php
		                		$arridrapottipe="data-rule-required=true id=idrapottipe";
		                		echo form_dropdown('idrapottipe',$idrapottipe_opt,$this->input->post('idrapottipe'),$arridrapottipe);
		                	?>
                    </div>
				            </td>
					</tr>
			            <tr>
                    <td align="left" width="150">Kelas</td>
				            <td align="left">
                      <div class="control-group">
				            	<?php
				                		$arridkelas="data-rule-required=false id=idkelas";
				                		echo form_dropdown('idkelas',$idkelas_opt,$this->input->post('idkelas') ,$arridkelas);
				                ?>
                      </div>
				            </td>
                    <td align="left" width="150">Petugas</td>
				            <td align="left">
				            	<?php
		                		$arrcreated_by="data-rule-required=false id=created_by";
		                		echo form_dropdown('created_by',$created_by_opt,$this->input->post('created_by'),$arrcreated_by);
		                	?>
				            </td>

			            </tr>
			            <tr>
                    <td align="left" width="150">Region</td>
				            <td align="left">
				            	<?php
			                		$arridregion="data-rule-required=false id=idregion";
			                		echo form_dropdown('idregion',$idregion_opt,$this->input->post('idregion'),$arridregion);
			                	?>
				            </td>
				            
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
                                                <th width='50'>No.</th>
                                                <th>Tahun Pelajaran</th>
                                                <th>Semester</th>
                                                <th>Jenjang</th>
                                                <th>Kelas</th>
                                                <th>Regional</th>
                                                <!-- <th>Non Reguler</th>-->
                                                <th>Nama Siswa</th>
                                                <th>Tipe Rapor</th>
                                                <th>Tgl. Rapor</th>
                                                <th>Petugas</th>
                                                <th width="150px">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        	<?php
                                        	$no=1;
											foreach((array)$show_table as $row) {
											    echo "<tr>";
											    echo "<td align='center'>".$no++."</td>";
											    echo "<td align=''><a href=javascript:void(window.open('".site_url('ns_rapot/rapot/'.$row->replid)."/1')) >".strtoupper($row->tahunajaran)."</a></td>";
											    echo "<td align='center'>".strtoupper($row->periode)."</td>";
											    echo "<td align=''>".strtoupper($row->departemen)."</td>";
											    echo "<td align='center'>".strtoupper($row->kelas)."</td>";
											    echo "<td align='center'>".strtoupper($row->region)."</td>";
                          // echo "<td align='center'>".($CI->p_c->cekaktif($row->nonreguler))."</td>";
											    echo "<td align='center'>".strtoupper($row->namasiswa)."</td>";
											    echo "<td align='center'>".strtoupper($row->rapottipe)."</td>";
											    echo "<td align='center'>".strtoupper($CI->p_c->tgl_indo($row->tanggalkegiatan))."</td>";
                          echo "<td align='center'>".strtoupper(trim($row->created_bytext))."</td>";
											    echo "<td align='center'>";
                          //if ($row->aktiftahunajaran==1){
                            if (trim($row->created_by)==$this->session->userdata('idpegawai')){

  												    //echo "<a href=javascript:void(window.open('".site_url('ns_rapot/penilaian/'.$row->replid)."/0'))>
  												    //			<button class='btn btn-xs btn-info'>Penilaian</button>
  												    //		</a>";
  												    //if ($row->nilaipd<=0){
  													    echo "<a href=javascript:void(window.open('".site_url('ns_rapot/ubah/'.$row->replid)."')) class='btn btn-xs btn-warning' >Ubah</a>&nbsp;";
  													    echo "<a href=javascript:void(window.open('".site_url('ns_rapot/hapus/'.$row->replid)."')) class='btn btn-xs btn-danger' id='btnOpenDialog' >Hapus</a>&nbsp;";
  												    //}
  											    }
                          //}
                          echo "<a href=javascript:void(window.open('".site_url('ns_rapot/digitalrapot/'.$row->replid)."')) class='btn btn-success' >Digital</a>&nbsp;&nbsp;";
                          echo "<a href=javascript:void(window.open('".site_url('ns_rapot/printrapot/'.$row->replid.'/0')."')) class='btn btn-info' >Cetak</a>&nbsp;";
                          echo "<a href=javascript:void(window.open('".site_url('ns_rapot/printrapot/'.$row->replid.'/1')."')) class='btn btn-info' >Excel</a>&nbsp;";
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
<!-------------------------------------------------------------------------------------------------------------------------------------->
<?php } elseif($view=='tambah'){ ?>
  <script type="text/javascript">
    $(function(){
      $.ajaxSetup({
        type:"POST",
        url: "<?php echo site_url('combobox/ambil_data') ?>",
        cache: false,
      });

      $("#idtahunajaran").change(function(){
        var value=$(this).val();
          $.ajax({
            data:{modul:'idkelas',id:value},
            success: function(respond){
              $("#idkelas").html(respond);
            }
          });
          $.ajax({
            data:{modul:'idrapottipe',id:value},
            success: function(respond){
              $("#idrapottipe").html(respond);
            }
          });

          $.ajax({
            data:{modul:'idtahunajaranall',id:value},
            success: function(respond){
              $("#idtahunajaranrapot").html(respond);
            }
          });
          $.ajax({
            data:{modul:'idsiswa',id:0},
            success: function(respond){
              $("#idsiswa").html(respond);
            }
          });

      });
      $("#idkelas").change(function(){
          var value=$(this).val();
          $.ajax({
            data:{modul:'idsiswa',id:value},
            success: function(respond){
              $("#idsiswa").html(respond);
            }
          });
      });
    });
  </script>
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
		        		<label class="control-label" for="minlengthfield">Tahun Pelajaran</label>
		        		<div class="control-group">
							<div class="controls">:
		                	<?php
		                		$arridtahunajaran="data-rule-required=true id=idtahunajaran";
		                		echo form_dropdown('idtahunajaran',$idtahunajaran_opt,$isi->idtahunajaran,$arridtahunajaran);
		                	?>
		                	<?php //echo  <p id="message"></p> ?>
							</div>
		        		</div>
		            </th></tr>
		            <tr>
		            <th align="left">
		        		<label class="control-label" for="minlengthfield">Semester</label>
		        		<div class="control-group">
							<div class="controls">:
		                	<?php
		                		$arridperiode="data-rule-required=true id=idperiode";
		                		echo form_dropdown('idperiode',$idperiode_opt,$isi->idperiode,$arridperiode);
		                	?>
		                	<?php //echo  <p id="message"></p> ?>
							</div>
		        		</div>
		            </th></tr>
		            <tr>
		            <th align="left">
		        		<label class="control-label" for="minlengthfield">Kelas</label>
		        		<div class="control-group">
							<div class="controls">:
		                	<?php
		                		$arridkelas="data-rule-required=true id=idkelas";
		                		echo form_dropdown('idkelas',$idkelas_opt,$isi->idkelas,$arridkelas);
		                	?>
		                	<?php //echo  <p id="message"></p> ?>
							</div>
		        		</div>
		            </th></tr>
                <tr>
		            <th align="left">
		        		<label class="control-label" for="minlengthfield">Wali Kelas</label>
		        		<div class="control-group">
							<div class="controls">:
		                	<?php
                      if (ISSET($datawalikelas)) {
		                		  echo $datawalikelas->namawalikelas;
                      }
		                	?>
		                	<?php //echo  <p id="message"></p> ?>
							</div>
		        		</div>
		            </th></tr>
		            <tr>
		            <th align="left">
		        		<label class="control-label" for="minlengthfield">Regional</label>
		        		<div class="control-group">
							<div class="controls">:
		                	<?php
		                		$arridregion="data-rule-required=true id=idregion";
		                		echo form_dropdown('idregion',$idregion_opt,$isi->idregion,$arridregion);
		                	?>
		                	<?php //echo  <p id="message"></p> ?>
							</div>
		        		</div>
		            </th></tr>
                <!--
                <tr>
		            	<th align="left">
		        		<label class="control-label" for="minlengthfield">Non Reguler</label>
		        		<div class="control-group">
							<div class="controls">:
		                	<?php
		                		$fcdata=array('name'=>'nonreguler','id'=>'nonreguler','value'=>'1','checked'=>$isi->nonreguler);
		                		echo form_checkbox($fcdata);
		                	?>
		                	<?php //echo  <p id="message"></p> ?>
							</div>
		        		</div>
		            </th></tr>
              -->
		            <tr>
		            <th align="left">
		        		<label class="control-label" for="minlengthfield">Nama Siswa</label>
		        		<div class="control-group">
							<div class="controls">:
		                	<?php
		                		$arridsiswa="data-rule-required=true id=idsiswa";
		                		echo form_dropdown('idsiswa',$idsiswa_opt,$isi->idsiswa,$arridsiswa);
		                	?>
		                	<?php //echo  <p id="message"></p> ?>
							</div>
		        		</div>
		            </th></tr>
		            <tr>
		            <th align="left">
		        		<label class="control-label" for="minlengthfield">Tipe Rapor</label>
		        		<div class="control-group">
							<div class="controls">:
		                	<?php
		                		$arridrapottipe="data-rule-required=true id=idrapottipe";
		                		echo form_dropdown('idrapottipe',$idrapottipe_opt,$isi->idrapottipe,$arridrapottipe);
		                	?>
		                	<?php //echo  <p id="message"></p> ?>
							</div>
		        		</div>
		            </th></tr>
		    		<tr>
				            <th align="left">
		                		<label class="control-label" for="minlengthfield">Komentar</label>
		                		<div class="control-group">
									<div class="controls" valign="top">&nbsp;&nbsp;
				                	<?php
				                		echo form_textarea(array('class' => '', 'id' => 'keterangan','name'=>'keterangan','value'=>$isi->keterangan,'data-rule-required'=>'false' ,'data-rule-maxlength'=>'500', 'data-rule-minlength'=>'2' ,'placeholder'=>'Masukkan 2-500 Karakter'));
				                	?>
				                	<?php //echo  <p id="message"></p> ?>
									</div>
		                		</div>
				            </th></tr>
				    <tr>
			            <th align="left">
	                		<label class="control-label" for="minlengthfield">Tgl. Rapor</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		echo form_input(array('class' => '', 'id' => 'dp1','name'=>'tanggalkegiatan','value'=>$CI->p_c->tgl_form($isi->tanggalkegiatan),'data-rule-required'=>'false' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'2' ,'placeholder'=>'DD-MM-YYYY','autocomplete'=>'off'));
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th>
			         </tr>
               <tr>
               <th align="left">
               <label class="control-label" for="minlengthfield">Tahun Pelajaran Non Reguler</label>
               <div class="control-group">
             <div class="controls">:
                     <?php
                       $arridtahunajaranrapot="id=idtahunajaranrapot";
                       echo form_dropdown('idtahunajaranrapot',$idtahunajaranrapot_opt,$isi->idtahunajaranrapot,$arridtahunajaranrapot);
                     ?>
                     <?php //echo  <p id="message"></p> ?>
             </div>
               </div>
               </th></tr>
               <tr>
                 <th align="left">
               <label class="control-label" for="minlengthfield">Tampilkan Nilai Akhir</label>
               <div class="control-group">
             <div class="controls">:
                     <?php
                       $fcdata=array('name'=>'tampilna','id'=>'tampilna','value'=>'1','checked'=>$isi->tampilna);
                       echo form_checkbox($fcdata);
                     ?>
                     <?php //echo  <p id="message"></p> ?>
             </div>
               </div>
               </th></tr>
               <tr>
   		            <th align="left">
   	                		<label class="control-label" for="minlengthfield">Kegiatan External Siswa</label>
   	                		<div class="control-group">
   								<div class="controls">:
   			                	<?php
   			                		echo form_input(array('class' => '', 'id' => 'external','name'=>'external','value'=>$isi->external,'style'=>'width:500px','data-rule-required'=>'false' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'2' ,'placeholder'=>'Masukkan 2-100 Karakter'));
   			                	?>
   			                	<?php //echo  <p id="message"></p> ?>
   								</div>
   	                		</div>
   			            </th></tr>
                    <tr>
        		            <th align="left">
        	                		<label class="control-label" for="minlengthfield">Nomor Dokumen</label>
        	                		<div class="control-group">
        								<div class="controls">:
        			                	<?php
        			                		echo form_input(array('class' => '', 'id' => 'nomordokumen','name'=>'nomordokumen','value'=>$isi->nomordokumen,'style'=>'width:500px','data-rule-required'=>'false' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'2' ,'placeholder'=>'Masukkan 2-100 Karakter'));
        			                	?>
        			                	<?php //echo  <p id="message"></p> ?>
        								</div>
        	                		</div>
        			            </th></tr>
				    <tr>
				            <th align="left">
				            	<button class='btn btn-primary'>Simpan</button>
				            	<a href="javascript:void(window.open('<?php echo site_url("ns_rapot") ?>'))" class="btn btn-success">Kembali</a>
				            </th>
				    </tr>
		            </table>
		        	<?php
		        	echo form_close();
		        	?>
	    </section>
<!-------------------------------------------------------------------------------------------------------------------------------------->
<?php } elseif($view=='rapot'){ ?>
  <script language="javascript">
  function cetakprint() {
  	newWindow('<?php echo site_url("ns_rapot/printrapot/".$isi->replid."/0")?>', 'cetakrapot','900','800','resizable=1,scrollbars=1,status=0,toolbar=0')
  }
  function cetakexcel() {
  	newWindow('<?php echo site_url("ns_rapot/printrapot/".$isi->replid."/1")?>', 'cetakrapot','900','800','resizable=1,scrollbars=1,status=0,toolbar=0')
  }
  function cetakdigital() {
  	newWindow('<?php echo site_url("ns_rapot/digitalrapot/".$isi->replid)?>', 'cetakrapot','900','800','resizable=1,scrollbars=1,status=0,toolbar=0')
  }
  </script>
    <section class="content-header table-responsive">
      <h1>
          <?php echo $form ?>
          <small><?php echo $form_small ?></small>
      </h1>
  		<ol class="breadcrumb">
              <li><a href="JavaScript:cetakprint()"><i class="fa fa-file-text"></i>&nbsp;Cetak</a></li>
              <li><a href="JavaScript:cetakexcel()"><i class="fa fa-file-text"></i>&nbsp;Excel</a></li>
              <li><a href="JavaScript:cetakdigital()"><i class="fa fa-print"></i>&nbsp;Digital</a></li>
              <li><a href="javascript:void(window.open('<?php echo site_url("ns_rapor_baru/ns_rapor_baru_detailmatpel/".$isi->replid."/d95d318e0bd6b9bea8da986a104fce7c") ?>'))"><i class="fa fa-calendar"></i>&nbsp;Rekap Nilai</a></li>
      </ol>
    </section>
    <section class="content">
  		<table width="100%" border="0" class="form-horizontal form-validate">
  			<tr>
              <th align="left">
          		<label class="control-label" for="minlengthfield">Nama Siswa</label>
          		<div class="control-group">
  					<div class="controls">:
                  	<?php
                  		echo ucwords(strtolower($isi->siswa));
                  	?>
  					</div>
          		</div>
              </th></tr>
              <tr>
              <th align="left">
          		<label class="control-label" for="minlengthfield">NISN</label>
          		<div class="control-group">
  					<div class="controls">:
                  	<?php
                  		if($isi->nisn<>""){echo $isi->nisn;}else{echo "-";}
                  	?>
  					</div>
          		</div>
              </th></tr>
              <tr>
              <th align="left">
          		<label class="control-label" for="minlengthfield">Nomor Induk</label>
          		<div class="control-group">
  					<div class="controls">:
                  	<?php
                  		echo $isi->nis;
                  	?>
  					</div>
          		</div>
              </th></tr>
              <tr>
              <th align="left">
          		<label class="control-label" for="minlengthfield">Kelas</label>
          		<div class="control-group">
  					<div class="controls">:
                  	<?php
                  		echo strtoupper($isi->kelas);
                  	?>
  					</div>
          		</div>
              </th></tr>
              <tr>
              <th align="left">
          		<label class="control-label" for="minlengthfield">Program</label>
          		<div class="control-group">
  					<div class="controls">:
                  	<?php
                  		echo $isi->kelompoksiswa;
                  	?>
  					</div>
          		</div>
              </th></tr>

              <tr>
              <th align="left">
          		<label class="control-label" for="minlengthfield">Tahun Pelajaran</label>
          		<div class="control-group">
  					<div class="controls">:
                  	<?php
                  		echo $isi->tahunajaran;
                  	?>
  					</div>
          		</div>
              </th></tr>
              <th align="left">
          		<label class="control-label" for="minlengthfield">Semester</label>
          		<div class="control-group">
  					<div class="controls">:
                  	<?php
                  		echo ucwords(strtolower($isi->periode));
                  	?>
                  	<?php //echo  <p id="message"></p> ?>
  					</div>
  				</div>
  			</th></tr>
              <tr>
              <th align="left">
          		<label class="control-label" for="minlengthfield">Regional</label>
          		<div class="control-group">
  					<div class="controls">:
                  	<?php
                  		echo ucwords(strtolower($isi->region));
                  	?>
  					</div>
          		</div>
              </th></tr>
              <!--
              <tr>
          <th align="left">
              <label class="control-label" for="minlengthfield">Non Reguler</label>
              <div class="control-group">
            <div class="controls">:
                    <?php
                      echo $CI->p_c->cekaktif($isi->nonreguler)
                    ?>
                    <?php //echo  <p id="message"></p> ?>
            </div>
              </div>
              </th></tr>
            -->
              <tr>
              <th align="left">
          		<label class="control-label" for="minlengthfield">Tipe Rapor</label>
          		<div class="control-group">
  					<div class="controls">:
                  	<?php
                  		echo ucwords(strtolower($isi->rapottipe));
                  	?>
  					</div>
          		</div>
              </th></tr>
      		<tr>
  		            <th align="left">
                  		<label class="control-label" for="minlengthfield">Komentar</label>
                  		<div class="control-group">
  							<div class="controls" valign="top">:
  		                	<?php
  		                		echo $isi->keterangan;
  		                	?>

  							</div>
                  		</div>
  		            </th></tr>
  		    <tr>
  	            <th align="left">
              		<label class="control-label" for="minlengthfield">Tgl. Rapor</label>
              		<div class="control-group">
  						<div class="controls">:
  	                	<?php
  	                		echo strtoupper($CI->p_c->tgl_indo($isi->tanggalkegiatan));
  	                	?>
  						</div>
              		</div>
  	            </th>
  	         </tr>
             <tr>
             <th align="left">
             <label class="control-label" for="minlengthfield">Tahun Pelajaran Non Reguler</label>
             <div class="control-group">
           <div class="controls">:
                   <?php
                     echo $isi->tahunajaranrapot;
                   ?>
           </div>
             </div>
             </th></tr>
             <tr>
         <th align="left">
             <label class="control-label" for="minlengthfield">Tampil Nilai Akhir</label>
             <div class="control-group">
           <div class="controls">:
                   <?php
                     echo $CI->p_c->cekaktif($isi->tampilna)
                   ?>
                   <?php //echo  <p id="message"></p> ?>
           </div>
             </div>
             </th></tr>
             <tr>
     		            <th align="left">
                     		<label class="control-label" for="minlengthfield">Petugas</label>
                     		<div class="control-group">
     							<div class="controls" valign="top">:
     		                	<?php
     		                		echo trim($CI->dbx->getpegawai($isi->created_by,0,1));
     		                	?>

     							</div>
                     		</div>
     		            </th></tr>
  		</table>
  <?php
  if($isi->tipe=='Evaluasi'){
    // ----------------------------------------------------------------------------------------------------------------------------------
    $matkel="";$jml_kel=0;
    $csx=7-$isi->kkmon-$isi->predikaton;
    ?>
    <table class='table table-bordered'>
      <tr>
        <th rowspan="2">No.</th>
        <th rowspan="2">Aspek/Materi</th>
        <th colspan="<?php echo count($predikat); ?>">Penilaian</th>
      </tr>
      <tr>
          <?php
            foreach((array)$predikat as $rowpredikat) {
              echo "<th>".$rowpredikat->predikat."</th>";
            }
          ?>
      </tr>
    <?php
    foreach((array)$kelompok as $rowkelompok) {
      $nilaimp=0;$jml_kel++;
      $nilaimp=$CI->ns_rapot_db->hitnilai_db($isi->idkelas,$isi->idsiswa,$rowkelompok->idmatpel,$isi->idtahunajaran,$isi->departemen,$isi->idregion,$isi->idrapottipe,$isi->nilaimurni,$isi->idperiode,$rowkelompok->idmatpelkelompok);
      if ($matkel<>$rowkelompok->matpelkelompok){
        $no=1;

        echo "<tr>";
        //".(count($nilaimp)+5)."
        echo "<td align='' colspan='6'><b><a href='".site_url('ns_rapot/ns_rapot_detailmatpel/')."/".$id."/".$rowkelompok->idmatpel."' target='_blank'>".strtoupper($rowkelompok->matpelkelompok)."</a></b></td>";
        echo "</tr>";
      } //if ($matkel<>$rowkelompok->matpelkelompok){
      echo "<tr>";
      //echo "<td align='left'><a href=javascript:void(window.open('".site_url('ns_rapot/ns_rapot_detailmatpel/')."/".$id."/".$rowkelompok->replid."'))>".ucwords(strtolower($rowkelompok->matpel))."</a></td>";
      echo "<td align='' colspan='6'><b>".strtoupper($rowkelompok->matpel)."</b></td>";
      echo "</tr>";
      $no_pd=1;
      foreach((array)$nilaimp as $rn) {
        $predikattext=$CI->dbx->ns_predikat($isi->departemen,$rn->nilaitot,$isi->predikattipe);
        echo "<tr>";
        echo "<td>".$no_pd++."</td>";
        echo "<td>".$rn->pengembangandirivariabel."</td>";
        foreach((array)$predikat as $rowpredikat) {
            if($rn->nilaitot=="0"){
              echo "<td>-</td>";
            }else if (trim($rowpredikat->predikat)==trim($predikattext)){
                echo "<td><b>&#10004;</b></td>";
            }else {
              echo "<td>-</td>";
            }

        }
        echo "</tr>";
      }

        //ISINYA BRAY
      $matkel=$rowkelompok->matpelkelompok;
    } //foreach((array)$kelompok as $rowkelompok) {
    echo "</table>";
      ?>

          </tbody>
          <tfoot>
          </tfoot>
      </table>
    <?php
  } else if($isi->tipe=='Grafik'){
  	// ----------------------------------------------------------------------------------------------------------------------------------
  	// ----------------------------------------------------------------------------------------------------------------------------------

  		$nilaimp=$CI->ns_rapot_db->grafiknilai_db($isi->idkelas,$isi->idsiswa,$isi->idtahunajaran,$isi->idregion,$isi->idrapottipe,$isi->nilaimurni,$isi->idperiode);
  		$judultext="";$tglkeg="";$nilaikeg="";$judultextgraph="";
  		$judul="";$x=0;

  		echo "<table border=1 width='100%'>";
  		echo "<tr>";
  		foreach((array)$nilaimp as $rn) {
  			if (isset($tglkeg[$rn->pengembangandirivariabel])){
  				$tglkeg[$rn->pengembangandirivariabel]=$tglkeg[$rn->pengembangandirivariabel].",'".$rn->tanggalkegiatan."'";
  			}else{
  				$tglkeg[$rn->pengembangandirivariabel]="'','".$rn->tanggalkegiatan."'";
  			}

  			if (isset($nilaikeg[$rn->pengembangandirivariabel])){
  				$nilaikeg[$rn->pengembangandirivariabel]=$nilaikeg[$rn->pengembangandirivariabel].",".$rn->nilai;
  			}else{
  				$nilaikeg[$rn->pengembangandirivariabel]=$rn->nilai;
  			}

  			if ($judul<>$rn->replid){
  				if ($judultext<>""){
  					$judultext=$judultext.'||'.$rn->pengembangandirivariabel;
  				}else{
  					$judultext=$rn->pengembangandirivariabel;
  				}
  		  }
  	    $judul=$rn->replid;
      }
      if ($judultext<>""){
          $judultextgraph=explode("||",$judultext);
      		foreach((array)$judultextgraph as $graph) {
      			echo "<td align='center'>";
      			    	echo "<table style='border:0 !important;width:100%;border-collapse:initial !important; '>";
      				    	echo "<tr>";
      				    	echo "<td align='center' height='300px' width='50%'>";
      				    	//echo $tglkeg[$graph];
      						?>
      						<script src="https://code.highcharts.com/highcharts.js"></script>
      						<script src="https://code.highcharts.com/modules/exporting.js"></script>

      						<script type="text/javascript">
      							$(function () {
      							    Highcharts.chart('container<?php echo $graph; ?>', {
      							        chart: {
      							            type: 'line'
      							        },
      							        credits: {
      							            enabled: false
      							        },
      							        title: {
      							            text: '<?php echo $graph; ?>'
      							        },
      							        xAxis: {
      							        	showLastLabel: true,
      							        	labels: {
      										            rotation: -90,
      										            step:1,
      										            style: {
      										                color: '#525151',
      										                font: '8px Helvetica'
      										            },
      										            formatter: function () {
      										                return this.value;
      										            }
      										        },
      							        	type: "linear",
      							            categories: [<?php echo $tglkeg[$graph]; ?>],
      							            min: 0
      							        },
      							        yAxis: {
      							        	min: 0,
      							            max: 100,
      							            tickInterval: 20,
      							            title: {
      							                text: 'Nilai'
      							            }
      							        },
      							        plotOptions: {
      							            line: {
      							                dataLabels: {
      							                    enabled: false
      							                },
      							                enableMouseTracking: false
      							            }
      							        },
      							        series: [{
      							            name: 'Nilai Siswa/ Tanggal',
      							            data: [<?php echo $nilaikeg[$graph]; ?>],
      							            pointStart: 1
      							        }]
      							    });
      							});
      						</script>
      						<div id="container<?php echo $graph; ?>" style="width:500px; height:250px; margin: 0 auto;font-size:-3;"></div>
      						<?php
      				    	echo "</td>";
      				    	echo "</tr>";
      			    	echo "</table>";
      		    	echo "</td>";

      		    	if (($x%2)==1){
      		    		echo "</tr>";
      		    		echo "<tr>";
      		    	}
      		    	$x++;
      		}

          echo "</table>";
      		echo "<br/>Deskripsi:<br/>";
      		echo "<table class='table table-bordered table-striped'>";
      		echo "<tr>";
      		echo "<th width='50'>No.</th>";
      		echo "<th>Aspek yang harus dinilai</th>";
      		echo "<th>Nilai</th>";
      		echo "<th>Predikat</th>";
      		echo "<th>Deskripsi</th>";
      		echo "</tr>";
          //echo var_dump($judultextgraph);
      		$noas=1;
      		foreach((array)$judultextgraph as $graph) {
      			$nilaix=0;$nilaiy=0;$xn=0;
      			if (isset($nilaikeg[$graph])){
      				$nilaix=explode(",",$nilaikeg[$graph]);
      				foreach((array)$nilaix as $ngraph) {
      					$nilaiy=$nilaiy+$ngraph;
      					$xn++;
      				}

      			}

      			echo "<tr>";
      			echo "<td width='20'>".$noas++."</td>";
      			echo "<td width='150'>".$graph."</td>";
            if (($nilaiy<>0) or ($xn<>0)){
                echo "<td width='20'>".ceil($nilaiy/$xn)."</td>";
                echo "<td width='20'>".strtoupper($CI->dbx->ns_predikat_graph(ceil($nilaiy/$xn),$graph))."</td>";
                echo "<td>".$CI->dbx->ns_predikat_text_graph(ceil($nilaiy/$xn),$graph)."</td>";
            }else{
              echo "<td width='20'>0</td>";
              echo "<td width='20'>0</td>";
              echo "<td width='20'>0</td>";
            }
      			echo "</tr>";
      		}
          echo "</table>";
      } //judultextgraph
  	}else if ($isi->tipe=='LPD'){ //grafik
  	// ----------------------------------------------------------------------------------------------------------------------------------
  	// ----------------------------------------------------------------------------------------------------------------------------------
  		    $nilaimp=$CI->ns_rapot_db->lpdnilai_db($isi->idkelas,$isi->idsiswa,$isi->idtahunajaran,$isi->idregion,$isi->idrapottipe,$isi->nilaimurni,$isi->idperiode);
          $nprosestipe="";$npjreplid="";$nrlpd="";$pjreplid="";
  				foreach((array)$nilaimp as $lpdx) {
  					if (isset($nprosestipe[$lpdx->idprosestipe.$lpdx->matpelkelompok])){
  						$nprosestipe[$lpdx->idprosestipe.$lpdx->matpelkelompok]=$nprosestipe[$lpdx->idprosestipe.$lpdx->matpelkelompok]+1;
  					}else{
  						$nprosestipe[$lpdx->idprosestipe.$lpdx->matpelkelompok]=1;
  					}

  					if (isset($npjreplid[$lpdx->pjreplid])){
  						$npjreplid[$lpdx->pjreplid]=$npjreplid[$lpdx->pjreplid]+1;
  					}else{
  						$npjreplid[$lpdx->pjreplid]=1;
  					}

  					if($lpdx->pjreplid<>$pjreplid){
  						$nrlpd[$lpdx->pjreplid]=$lpdx->nilai;
  					}else{
  						$nrlpd[$lpdx->pjreplid]=$nrlpd[$lpdx->pjreplid]+$lpdx->nilai;
  					}

  					$pjreplid=$lpdx->pjreplid;
  				}

  				$nolpd=1;$idprosestipelpdx="";$pjreplid="";
          $matkel="";
  				foreach((array)$nilaimp as $lpdrow) {
            if ($matkel<>$lpdrow->matpelkelompok){
              ?>
              <table class="table table-bordered table-striped">
                <?php
                  echo "<tr>";
                  echo "<td align='' colspan='7'><b>".strtoupper($lpdrow->matpelkelompok)."</b></td>";
                  echo "</tr>";
                ?>
                <tr>
                  <th width='50'>No.</th>
                  <th>Jenis Kegiatan</th>
                  <th>Tema</th>
                  <th>Indikator</th>
                  <th>Nilai</th>
                  <th>Nilai Rata Rata</th>
                  <th>Predikat</th>
                  <!-- <th>Deskripsi</th> -->
                </tr>
              <?php
            }//if $jml_kel
            if(($lpdrow->idprosestipe<>$idprosestipelpdx) ){
  							$rs=$nprosestipe[$lpdrow->idprosestipe.$lpdrow->matpelkelompok];
  					}else{
  							if(($lpdrow->idprosestipe<>$idprosestipelpdx) OR ($matkel<>$lpdrow->matpelkelompok)){
  								$rs=$nprosestipe[$lpdrow->idprosestipe.$lpdrow->matpelkelompok];
  							}else{
  								//$rs=$nprosestipe[$lpdrow->idprosestipe.$lpdrow->matpelkelompok]-$nolpd3+1;
  							}
  					}

            //echo var_dump($nilaimp);

  					if(($lpdrow->idprosestipe<>$idprosestipelpdx) OR ($matkel<>$lpdrow->matpelkelompok)){
  						echo "<tr>";
  						echo "<td valign='middle' width='20' rowspan='".($rs+1)."'>".$nolpd++."</td>";
  						echo "<td align='center' valign='middle' rowspan='".($rs+1)."' width='90px'>".$lpdrow->prosestipe."</td>";
  						echo "</tr>";
  					}
  					echo "<tr>";

  					if($lpdrow->pjreplid<>$pjreplid){
              if($lpdrow->keterangan<>""){
                $keterangantext=$lpdrow->matpel.'<br> Tema : '.$lpdrow->keterangan;
              }else{
                $keterangantext=$lpdrow->matpel;
              }
  						echo "<td valign='middle' rowspan='".($npjreplid[$lpdrow->pjreplid])."'><a href=javascript:void(window.open('".site_url('ns_pembelajaranjadwal/penilaian/'.$lpdrow->pjreplid)."/0')) >".$keterangantext."&nbsp;</a></td>";
  					}

  					echo "<td>".ucwords(strtolower($lpdrow->pengembangandirivariabel))."</td>";
  					echo "<td>".$lpdrow->nilai."</td>";

  					if($lpdrow->pjreplid<>$pjreplid){
  						$nrlpdx=ceil($nrlpd[$lpdrow->pjreplid]/$npjreplid[$lpdrow->pjreplid]);
  						echo "<td valign='middle' rowspan='".($npjreplid[$lpdrow->pjreplid])."'>".$nrlpdx."</td>";
  						echo "<td valign='middle' rowspan='".($npjreplid[$lpdrow->pjreplid])."'>".strtoupper($CI->dbx->ns_predikat($isi->departemen,$nrlpdx,$isi->predikattipe))."</td>";
  						// echo "<td valign='middle' rowspan='".($npjreplid[$lpdrow->pjreplid])."'>".$CI->dbx->ns_predikat_text_lpd($lpdrow->nilai)."</td>";
  					}
  					echo "</tr>";
  					$idprosestipelpdx=$lpdrow->idprosestipe;
  					$pjreplid=$lpdrow->pjreplid;
            $matkel=$lpdrow->matpelkelompok;
  				}

  			?>
  		</table>
  		<?php

  	}else if($isi->tipe=='SKL'){
  	// SKL
  	// ----------------------------------------------------------------------------------------------------------------------------------
  	// ----------------------------------------------------------------------------------------------------------------------------------
  		  $matkel="";$matpel="";$pengembangandirivariabel="";$jml_kel=0;
        $csx=3+$isi->kkmon+$isi->predikaton+$isi->kalimatraporon;
        $cspdv=1+$isi->predikaton;
        $arraympk=array(); //$arraypdv=array();
        $cskel=array();
        foreach((array)$kelompok as $rowkelompok) {
          if ($matkel<>$rowkelompok->matpelkelompok){
            $arraypsv[$rowkelompok->matpelkelompok]=array();
            $arraypdv[$rowkelompok->matpelkelompok][$rowkelompok->prosessubvariabel]=array();
            array_push($arraympk,$rowkelompok->matpelkelompok);
            $cskel[$rowkelompok->matpelkelompok]=0;
          }

          if (!in_array($rowkelompok->prosessubvariabel,$arraypsv[$rowkelompok->matpelkelompok])){
            array_push($arraypsv[$rowkelompok->matpelkelompok],$rowkelompok->prosessubvariabel);
            $arraypdv[$rowkelompok->matpelkelompok][$rowkelompok->prosessubvariabel]=array();
          }
          if (!in_array($rowkelompok->pengembangandirivariabel,$arraypdv[$rowkelompok->matpelkelompok][$rowkelompok->prosessubvariabel])){
            array_push($arraypdv[$rowkelompok->matpelkelompok][$rowkelompok->prosessubvariabel],$rowkelompok->pengembangandirivariabel);
            $cskel[$rowkelompok->matpelkelompok]++;
          }

          $matkel=$rowkelompok->matpelkelompok;
        }
        //echo var_dump($arraympk);die;
        $matkel="";
        foreach((array)$arraympk as $rowmpk) {
      		$nilaimp=0;
          if ($matkel<>$rowmpk){
  	            $no=1;
                $matkelcs=$cskel[$rowmpk]+2+$isi->kkmon;
    		        echo "<table class='table table-bordered'>";
    		        echo "<tr>";
            		echo "<td align='' colspan='".$matkelcs."'><b>".strtoupper($rowmpk)."</b></td>";
            		echo "</tr>";
    						echo "<tr>";
    						echo "<th width='50' rowspan='2'>No.</th>";
                echo "<th width='*' rowspan='2'>Mata Pelajaran</th>";
                if($isi->kkmon==1){
                    echo "<th width='65' rowspan='2'>KKM</th>";
                }
                foreach((array)$arraypsv[$rowmpk] as $rowpsv) {
                  echo "<th width='".(55*(((1+$isi->predikaton)*COUNT($arraypdv[$rowmpk][$rowpsv]))))."' colspan='".COUNT($arraypdv[$rowmpk][$rowpsv])."'>".$rowpsv."</th>";
                }
                echo "</tr>";
                echo "<tr>";
                foreach((array)$arraypsv[$rowmpk] as $rowpsv) {
                  foreach((array)$arraypdv[$rowmpk][$rowpsv] as $rowpdv) {
                    echo "<th width='55'>".$rowpdv."</th>";
                  }
                }
                echo "</tr>";

                foreach((array)$kelompok as $rowkelompok) {
                  if($rowmpk==$rowkelompok->matpelkelompok){
                    if($no<2){
                      echo "</tr>";
                    }
                    if ($matpel<>$rowkelompok->matpel){
                      echo "<tr>";
                      echo "<td>".$no++."</td>";
                      echo "<td align='left'><a href='".site_url('ns_rapot/ns_rapot_detailmatpel/')."/".$id."/".$rowkelompok->idmatpel."' >".ucwords(strtolower($rowkelompok->matpel));
                      if($rowkelompok->matpelexternal){
                        echo "&nbsp;".$isi->external;
                      }
                      if($isi->kkmon==1){echo "<td align='center'>".strtoupper($rowkelompok->kkm)."</td>";}
                      echo "<td>".$rowkelompok->nilaiasli."</td>";
                    }else{
                      echo "<td>".$rowkelompok->nilaiasli."</td>";
                    }
                  }
                  $matpel=$rowkelompok->matpel;
                }
            }
            $matkel=$rowmpk;
        } //foreach((array)$kelompok as $rowkelompok) {
  				?>

              </tbody>
              <tfoot>
              </tfoot>
          </table>
        <?php }else if($isi->tipe=='Murni'){
      	// Murni
      	// ----------------------------------------------------------------------------------------------------------------------------------
      	// ----------------------------------------------------------------------------------------------------------------------------------
      		  $matkel="";$matpel="";$pengembangandirivariabel="";$jml_kel=0;
            $csx=3+$isi->kkmon+$isi->predikaton+$isi->kalimatraporon;
            $cspdv=1+$isi->predikaton;
            $arraympk=array(); //$arraypdv=array();
            $cskel=array();
            foreach((array)$kelompok as $rowkelompok) {
              if ($matkel<>$rowkelompok->matpelkelompok){
                $arraypsv[$rowkelompok->matpelkelompok]=array();
                $arraypdv[$rowkelompok->matpelkelompok][$rowkelompok->prosessubvariabel]=array();
                array_push($arraympk,$rowkelompok->matpelkelompok);
                $cskel[$rowkelompok->matpelkelompok]=0;
              }

              if (!in_array($rowkelompok->prosessubvariabel,$arraypsv[$rowkelompok->matpelkelompok])){
                array_push($arraypsv[$rowkelompok->matpelkelompok],$rowkelompok->prosessubvariabel);
                $arraypdv[$rowkelompok->matpelkelompok][$rowkelompok->prosessubvariabel]=array();
              }
              if (!in_array($rowkelompok->pengembangandirivariabel,$arraypdv[$rowkelompok->matpelkelompok][$rowkelompok->prosessubvariabel])){
                array_push($arraypdv[$rowkelompok->matpelkelompok][$rowkelompok->prosessubvariabel],$rowkelompok->pengembangandirivariabel);
                $cskel[$rowkelompok->matpelkelompok]++;
              }

              $matkel=$rowkelompok->matpelkelompok;
            }
            //echo var_dump($arraympk);die;
            $matkel="";
            foreach((array)$arraympk as $rowmpk) {
          		$nilaimp=0;
              if ($matkel<>$rowmpk){
                    $no=1;
                    $matkelcs=($cskel[$rowmpk]*(1+$isi->predikaton))+2+$isi->kkmon+$isi->kalimatraporon;
        		        echo "<table class='table table-bordered'>";
        		        echo "<tr>";
                		echo "<td align='' colspan='".$matkelcs."'><b>".strtoupper($rowmpk)."</b></td>";
                		echo "</tr>";
        						echo "<tr>";
        						echo "<th width='50' rowspan='2'>No.</th>";
                    echo "<th width='270' rowspan='2'>Mata Pelajaran</th>";
                    if($isi->kkmon==1){
                        echo "<th width='65' rowspan='2'>KKM</th>";
                    }
                    foreach((array)$arraypsv[$rowmpk] as $rowpsv) {
                      foreach((array)$arraypdv[$rowmpk][$rowpsv] as $rowpdv) {
                        echo "<th width='270' colspan='".(1+$isi->predikaton+$isi->kalimatraporon)."'>".$rowpdv."</th>";
                      }
                    }
                    echo "</tr>";
                    echo "<tr>";
                    foreach((array)$arraypsv[$rowmpk] as $rowpsv) {
                      foreach((array)$arraypdv[$rowmpk][$rowpsv] as $rowpdv) {
                        echo "<th width='270'>Angka</th>";
                        if($isi->kalimatraporon==1){echo "<th width='160'>Huruf</th>";}
                        if($isi->predikaton){
                            echo "<th width='270'>Predikat</th>";
                        }
                      }
                    }
                    echo "</tr>";

                    foreach((array)$kelompok as $rowkelompok) {
                      if($rowmpk==$rowkelompok->matpelkelompok){
                        if($no<2){
                          echo "</tr>";
                        }
                        if ($matpel<>$rowkelompok->matpel){
                          echo "<tr>";
                          echo "<td>".$no++."</td>";
                          echo "<td align='left'><a href='".site_url('ns_rapot/ns_rapot_detailmatpel/')."/".$id."/".$rowkelompok->idmatpel."' >".ucwords(strtolower($rowkelompok->matpel));
                          if($rowkelompok->matpelexternal){
                            echo "&nbsp;".$isi->external;
                          }
                          if($isi->kkmon==1){echo "<td align='center'>".strtoupper($rowkelompok->kkm)."</td>";}
                          echo "<td align='center'>".$rowkelompok->nilaiasli."</td>";
                          if($isi->kalimatraporon==1){
      											echo "<td align='left'>".ucwords(strtolower($CI->p_c->kalimatrapor(ROUND($rowkelompok->nilaiasli),0))) ."</td>";
      										}
                          if($isi->predikaton==1){
                              echo "<td align='center'>".strtoupper($CI->dbx->ns_predikat($isi->departemen,$rowkelompok->nilaiasli,$isi->predikattipe))."</td>";
                          }
                        }else{
                          echo "<td align='center'>".$rowkelompok->nilaiasli."</td>";
                          if($isi->predikaton==1){
                              echo "<td align='center'>".strtoupper($CI->dbx->ns_predikat($isi->departemen,$rowkelompok->nilaiasli,$isi->predikattipe))."</td>";
                          }
                        }
                      }
                      $matpel=$rowkelompok->matpel;
                    }
                }
                $matkel=$rowmpk;
            } //foreach((array)$kelompok as $rowkelompok) {
      				?>

                  </tbody>
                  <tfoot>
                  </tfoot>
              </table>
          <?php
          }else{ //lpd //RAPORT REGULER
          	// RAPOR UTAMA
          	// ----------------------------------------------------------------------------------------------------------------------------------
          	// ----------------------------------------------------------------------------------------------------------------------------------
          		  $matkel="";$jml_kel=0;
                $csx=3+$isi->kkmon+$isi->predikaton+$isi->kalimatraporon;
              	foreach((array)$kelompok as $rowkelompok) {
              		$nilaimp=0;$jml_kel++;
                  $nilaimp=$CI->ns_rapot_db->hitnilai_db($isi->idkelas,$isi->idsiswa,$rowkelompok->idmatpel,$isi->idtahunajaran,$isi->departemen,$isi->idregion,$isi->idrapottipe,$isi->nilaimurni,$isi->idperiode,$rowkelompok->idmatpelkelompok);
                  //echo var_dump($nilaimp);die;
                  if ($matkel<>$rowkelompok->matpelkelompok){
          	         $no=1;
                     if(($isi->nilaimurni<>1)){
          							if ($jml_kel<=1){
          							?>
          							<table class="table table-bordered">
          				            <thead>
          				            	<?php
          					            	echo "<tr>";
          				            		echo "<td align='' colspan='".$csx."'><b>".strtoupper($rowkelompok->matpelkelompok)."</b></td>";
          				            		echo "</tr>";
          				            	?>
          				                <tr>
          				                    <th width="60">No.</th>
          				                    <th>Mata Pelajaran</th>
          				                     <?php if($isi->kkmon==1){
                                          echo "<th width='60'>KKM</th>";
                                       }?>
          				                    <th width="60">Angka</th>
          					                <th width="160">Huruf</th>
                                    <?php if($isi->predikaton==1){
                                       echo "<th width='60'>Predikat</th>";
                                    }?>
          				                </tr>
          				            </thead>
          				            <tbody>
          							<?php
          							} else {
          								echo "<tr>";
          				            	echo "<td align='' colspan='".$csx."'><b>".strtoupper($rowkelompok->matpelkelompok)."</b></td>";
          				            	echo "</tr>";

          							}//if $jml_kel
          						}else{
                        //RAPOR NILAI MURNI
            		        echo "<table class='table table-bordered'>";
            		        echo "<tr>";
                    		echo "<td align='' colspan='".(count($nilaimp)+5)."'><b>".strtoupper($rowkelompok->matpelkelompok)."</b></td>";
                    		echo "</tr>";
            						echo "<tr>";
            						echo "<th rowspan=2 width='50'>No.</th>";
                        echo "<th rowspan=2 width='270'>Mata Pelajaran</th>";
                        if($isi->kkmon==1){
                            echo "<th rowspan=2 width='65'>KKM</th>";
                        }
          		          /*
          					    //NILAI AKHIR DAN PREDIKAT $isi->nilaimurni==1
          					    echo "<th colspan='".count($nilaimp)."'>Tugas</th>";
          		          */

                        $cs=count($nilaimp);
                        $cspdv=1+$isi->predikaton;
                        //$cs=count(array_keys($nilaimp, "blue"));
                        if ($rowkelompok->detail==1){
                        	foreach((array)$nilaimp as $rn) {
                        		echo "<th colspan='".($cspdv)."'>".$rn->pengembangandirivariabel."</th>";
                        	}
                          echo "</tr>";
                          echo "<tr>";
                        	for ($i = 1; $i <= $cs; $i++) {
                        		// width='".(260/($cs*2))."'
                        		echo "<th>Angka</th>";
                            if($isi->predikaton==1){
                                echo "<th>Predikat</th>";
                            }
                        	}
                        	echo "</tr>";
                        }else{
                        	//for ($i = 1; $i <= $cs; $i++) {
                        		echo "<th colspan='".($cspdv)."'>Tugas</th>";
                        	//}
                          echo "<th rowspan=2 width='65'>Nilai Akhir</th>";
          			          echo "<th rowspan=2 width='65'>Predikat</th>";
                          echo "</tr>";
                          echo "<tr>";
                          for ($i = 1; $i <= $cs; $i++) {
                          	//width='".(195/$cs)."'
          				          echo "<th align='center'>".$CI->p_c->romawi($i)."</th>";
          			          }
                          echo "</tr>";
                        } //  if (($isi->nilaimurni==1) and ($rowkelompok->detail==1)){
                      } //nilaimurni
                    } //if ($matkel<>$rowkelompok->matpelkelompok){
                    echo "<tr>";
          			    echo "<td align='center'>".$no++."</td>";
          			    echo "<td align='left'><a href='".site_url('ns_rapot/ns_rapot_detailmatpel/')."/".$id."/".$rowkelompok->idmatpel."'>".ucwords(strtolower($rowkelompok->matpel));
                    if($rowkelompok->matpelexternal){
                      echo "&nbsp;".$isi->external;
                    }
                    echo "</a>";
                    echo "</td>";
          			    if($isi->kkmon==1){echo "<td align='center'>".strtoupper($rowkelompok->kkm)."</td>";}
          			    if($isi->nilaimurni<>1){
          			    	$na=ceil($nilaimp);
                      		echo "<td align='center'>".$na."</td>";
          				    echo "<td align='left'>".ucwords(strtolower($CI->p_c->kalimatrapor($na,0))) ."</td>";
          				    echo "<td align='left'>".strtoupper($CI->dbx->ns_predikat($isi->departemen,$na,$isi->predikattipe))."</td>";
          			    }else{
          			    	$nilaiall=0;$avgall=0;
          			    	if(count($nilaimp)==0){
          				    	echo "<td align='center'>0</td>";
          			    	}
          			    	foreach((array)$nilaimp as $rn) {
          			    		$na=ceil($rn->nilaitot);
          			    		if($rowkelompok->detail==1){
          				    		//$na=number_format($na, 2, ',', '');
          				    		echo "<td align='center'>".$na."</td>";
                          if($isi->predikaton==1){
                              echo "<td align='center'>".strtoupper($CI->dbx->ns_predikat($isi->departemen,$na,$isi->predikattipe))."</td>";
                          }
          				    	}else{
          					    	echo "<td align='center'>".$na."</td>";
          				    	}
          				    	$avgall=$avgall+$na;
          			    	}
                      if($avgall<>0){
                          $avgall=ceil($avgall/$cs);
                      }
          			    	if ($rowkelompok->detail<>1){
          			    		echo "<td align='center'>".$avgall."</td>";
          			    		echo "<td align='center'>".strtoupper($CI->dbx->ns_predikat($isi->departemen,$avgall,$isi->predikattipe))."</td>";
          				    }
          			    }
          			    echo "</tr>";
                    $matkel=$rowkelompok->matpelkelompok;
                } //foreach((array)$kelompok as $rowkelompok) {
          				?>

                      </tbody>
                      <tfoot>
                      </tfoot>
                  </table>
  <?php
  }

  if ($isi->absensi==1){ ?>
  <table class="table table-bordered">
      <tr><th colspan="3">Absensi</th></tr>
      <tr><th width="100">Sakit</th><th width="30">:</th><td><?php echo $hadirdata->sakit ?> Hari</td></tr>
      <tr><th>Izin</th><th>:</th><td><?php echo $hadirdata->izin ?> Hari</td></tr>
      <tr><th>Alpha</th><th>:</th><td><?php echo $hadirdata->alpha ?> Hari</td></tr>
  </table>
  <?php } ?>
  <?php
  //if ($isi->aktiftahunajaran==1){
    if (trim($isi->created_by)==$this->session->userdata('idpegawai')){

      //echo "<a href=javascript:void(window.open('".site_url('ns_rapot/penilaian/'.$row->replid)."/0'))>
      //			<button class='btn btn-xs btn-info'>Penilaian</button>
      //		</a>";
      //if ($row->nilaipd<=0){
        echo "<a href=javascript:void(window.open('".site_url('ns_rapot/ubah/'.$isi->replid)."')) class='btn btn-warning'>Ubah</a>&nbsp;";
        echo "<a href=javascript:void(window.open('".site_url('ns_rapot/hapus/'.$isi->replid)."')) class='btn btn-danger' id='btnOpenDialog'>Hapus</a>&nbsp";
      //}
    }
  //}
  echo "<a href=javascript:void(window.open('".site_url('ns_rapot')."')) class='btn btn-success'>Kembali</a>&nbsp";
}
?>
  </section>
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
    </body>
</html>
