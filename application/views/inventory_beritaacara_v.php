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
                        <li><a href="javascript:void(window.open('<?php echo site_url('inventory_beritaacara/tambah'); ?>'))" ><i class="fa fa-plus-square"></i> Tambah</a></li>

                    </ol>
                </section>
				<section class="content-header table-responsive">
                    <?php
			        $attributes = array('class' => 'form-horizontal form-validate', 'id' => 'form', 'method' => 'POST', 'novalidate'=>'novalidate','onsubmit'=>'return validate()');
		    	echo form_open($action,$attributes);
		    		?>
                	<table width="100%" border="0">
					<tr>
                      <th align="left">
                                <label class="control-label" for="minlengthfield">Unit Bisnis</label>
                                <div class="control-group">
                                    <div class="controls">:
                                        <?php
                                        $arridcompany="data-rule-required=true id=idcompany onchange='javascript:this.form.submit();'";
                                        echo form_dropdown('idcompany',$idcompany_opt,$this->input->post('idcompany'),$arridcompany);
                                        ?>
                                        <?php //echo  <p id="message"></p> ?>
                                    </div>
                                </div>
                                </th>
            </tr>
	                    <tr>
                        <th align="left">
                            <label class="control-label" for="minlengthfield">Periode</label>
                            <div class="control-group">
                      <div class="controls">:
                              <?php
                              echo form_input(array('class' => '', 'id' => 'dp1','name'=>'periode1','value'=>$this->input->post('periode1'),'data-rule-required'=>'false' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'2' ,'placeholder'=>'DD-MM-YYYY','autocomplete'=>'off'))."&nbsp;";
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
                                                <th>No. Transaksi</th>
                                                <th>Perusahaan</th>
                                                <th>Tgl. Transaksi</th>
                                                <th>Keterangan</th>
												<th>Status</th>
                                                <th width="80">Aksi</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                        	<?php
                                        	$CI =& get_instance();
											foreach((array)$show_table as $row) {
											    echo "<tr>";
											    echo "<td align='center'>";
												  echo "<a href=javascript:void(window.open('".site_url('inventory_beritaacara/view/'.$row->replid)."'))  >".$row->kode_transaksi."</a>";
											    echo "</td>";
											    echo "<td align=''>".strtoupper($row->company)."</td>";
											    echo "<td align='center'>".strtoupper($CI->p_c->tgl_indo($row->tanggaltransaksi))."</td>";
											    echo "<td align='center'>".$row->keterangan."</td>";
												echo "<td align='center'>".$row->statustext."</td>";
											    echo "<td align='center'>";
													if($row->status<>'4'){
														echo "<a href=javascript:void(window.open('".site_url('inventory_beritaacara/ubah/'.$row->replid)."')) class='btn btn-xs btn-warning fa fa-check-square' ></a>&nbsp;&nbsp;";
                            echo "<a href=javascript:void(window.open('".site_url('inventory_beritaacara/hapus/'.$row->replid)."')) class='btn btn-xs btn-danger fa fa-minus-square' ></a>";
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
<!-------------------------------------------------------------------------------------------------------------------------------------->
<?php } elseif($view=='tambah'){ ?>
		    <section class="content-header table-responsive">
	            <h1>
	                <?php echo $form ?>
	                <small><?php echo $form_small ?></small>
	            </h1>
            </section>
            <section class="content">
		        <?php
			        $attributes = array('class' => 'form-horizontal form-validate', 'id' => 'form', 'method' => 'POST', 'novalidate'=>'novalidate','onsubmit'=>'return validate()');
		    	echo form_open($action,$attributes);
		    	?>
		    	<table width="100%" border="0">
		    		<tr>
		            <th align="left">
		        		<label class="control-label" for="minlengthfield">No. Transaksi</label>
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
		        		<label class="control-label" for="minlengthfield">Perusahaan</label>
		        		<div class="control-group">
							<div class="controls">:
		                	<?php
		                		$arrcompany='data-rule-required=true';
		                		echo form_dropdown('idcompany',$company_opt,$isi->idcompany,$arrcompany);
		                	?>
							</div>
		        		</div>
		            </th></tr>
		            <tr>
			            <th align="left">
	                		<label class="control-label" for="minlengthfield">Tgl. Transaksi</label>
	                		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		echo form_input(array('class' => '', 'id' => 'dp1','name'=>'tanggaltransaksi','value'=>$CI->p_c->tgl_form($isi->tanggaltransaksi),'data-rule-required'=>'false' ,'data-rule-maxlength'=>'100', 'data-rule-minlength'=>'2' ,'placeholder'=>'DD-MM-YYYY','autocomplete'=>'off'));
			                	?>
			                	<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th>
			         </tr>
				    <tr>
				            <th align="left">
		                		<label class="control-label" for="minlengthfield">Keterangan</label>
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
				            	<button class='btn btn-primary' onclick="return validate()">Simpan</button>
				            	<a href="javascript:void(window.open('<?php echo site_url('inventory_beritaacara') ?>'))" class="btn btn-success">Kembali</a>
				            </th>
				    </tr>
		            </table>
		        	<?php
		        	echo form_close();
		        	?>
	    </section>
<!------------------------------------------------------------------------------------------------------------------------------------>
<?php } elseif($view=='material'){ ?>
		<section class="content-header table-responsive">
	            <h1>
	                <?php echo $form ?>
	                <small><?php echo $form_small ?></small>
	            </h1>
              <ol class="breadcrumb">
                  <li><a href="javascript:void(window.open('<?php echo site_url('inventory_beritaacara/tambah'); ?>'))" ><i class="fa fa-plus-square"></i> Tambah</a></li>
              </ol>
            </section>
            <section class="content">
		    	<table width="100%" border="0" class='form-horizontal form-validate'>
		    		<tr>
		            <th align="left">
		        		<label class="control-label" for="minlengthfield">No. Transaksi</label>
		        		<div class="control-group">
							<div class="controls">:
		                	<?php echo strtoupper($isi->kode_transaksi);?>
							</div>
		        		</div>
		            </th></tr>
		            <tr>
		            <th align="left">
		        		<label class="control-label" for="minlengthfield">Perusahaan</label>
		        		<div class="control-group">
							<div class="controls">:
							<?php echo strtoupper($isi->company);?>
							</div>
		        		</div>
		            </th></tr>
		            <tr>
			            <th align="left">
	                		<label class="control-label" for="minlengthfield">Tgl. Transaksi</label>
	                		<div class="control-group">
								<div class="controls">:
								<?php echo $CI->p_c->tgl_indo($isi->tanggaltransaksi);?>
								<?php //echo  <p id="message"></p> ?>
								</div>
	                		</div>
			            </th>
			         </tr>
				    <tr>
				            <th align="left">
		                		<label class="control-label" for="minlengthfield">Keterangan</label>
		                		<div class="control-group">
									<div class="controls" valign="top">:
				                	<?php echo $isi->keterangan;?>
				                	<?php //echo  <p id="message"></p> ?>
									</div>
		                		</div>
				            </th></tr>
					<tr>
					<th align="left">
						<label class="control-label" for="minlengthfield">Status</label>
						<div class="control-group">
							<div class="controls" valign="top">:
							<?php echo $isi->statustext;?>
							<?php //echo  <p id="message"></p> ?>
							</div>
						</div>
					</th></tr>
				     <tr>
				     	<td align="left">
				     		<hr><h4>Material :</h4>
				     		<?php if(!isset($viewview)){?>
				     		<section class="content-header table-responsive">
			                    <ol class="breadcrumb">
			                        <li><a href="javascript:void(window.open('<?php echo site_url('inventory_beritaacara/tambahmaterial/'.$id); ?>'))" ><i class="fa fa-plus-square"></i> Tambah</a></li>
			                    </ol>
			                </section>
			                <?php } ?>
                      <script>
                      function openwindowx(){
                        void(window.open("https://www.w3schools.com"));
                      }
                      </script>
			                <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                    	<th width='50'>No.</th>
                                        <th>Kode Inventaris</th>
                                        <th>Material</th>
                                        <th>Departemen</th>
										<th>Penanggung Jawab</th>
                                        <th>Ruangan</th>
                                        <th>Kondisi</th>
                                        <?php if(!isset($viewview)){?>
                                        <th width="80">Aksi</th>
                                        <?php } ?>
                                    </tr>
                                </thead>
                                <tbody>
                                	<?php
                                	$jml_c=0;$no=1;$stock=0;
                                	if (!empty($material)){
										foreach($material as $row) {
										    echo "<tr>";
										    echo "<td align='center'>".$no++."</td>";
                        echo "<td align='center'>".$row->kode_inventaris."</td>";
										    echo "<td align=''><a href=javascript:void(window.open('".site_url('inventory_material/view/'.$row->idmaterial)."')) >".$row->materialtext."</a></td>";
												echo "<td align='center'>".$row->departementext."</td>";
                        echo "<td align='center'>".$row->pegawaitext."</td>";
                        echo "<td align='center'>".$row->kondisitext."</td>";
                        echo "<td align='center'>".$row->ruangtext."</td>";
										    if(!isset($viewview)){
										    echo "<td align='center'>";
										    echo "<a href=javascript:void(window.open('".site_url('inventory_beritaacara/tambahmaterial/'.$isi->replid.'/'.$row->replid)."')) class='btn btn-xs btn-warning'>Ubah</a>";
                        echo "<a href=javascript:void(window.open('".site_url('inventory_beritaacara/hapusmaterial/'.$row->replid)."')) class='btn btn-xs btn-danger'  >Hapus</a>";
										    echo "</td>";
										    }
										    echo "</tr>";
										}
									}
									?>
                                </tbody>
                                <tfoot>
                                </tfoot>
                            </table>
                  </td>
               </tr>
			</table>
      <?php
      $attributes = array('class' => 'form-horizontal form-validate', 'id' => 'form', 'method' => 'POST', 'novalidate'=>'novalidate','onsubmit'=>'return validate()');
      echo form_open($action,$attributes);
      ?>
			<table width="100%" border=0>
                <tr>
		            <td style="text-align:left;">
		            	<?php
			                if (!isset($viewview)){
									        	if (!empty($material)){
                                echo "Setelah Disimpan Data Tidak Bisa Diubah Kembali.<br/>";
                              ?>
									            	<button class='btn btn-primary'>Simpan</button>
									            <?php
									            } else {
										            echo "<font color=red>Tambahkan Material Terlebih Dahulu</font>&nbsp;&nbsp;";
									            }
	                      }else{
                          if($isi->status<>"4")
								    				echo "
															    		<a href=javascript:void(window.open('".site_url('inventory_beritaacara/ubah/'.$isi->replid)."')) class='btn btn-warning'>Ubah</a>&nbsp;&nbsp;
															    		<a href=javascript:void(window.open('".site_url('inventory_beritaacara/hapus/'.$isi->replid)."')) class='btn btn-danger' id='btnOpenDialog'>Hapus</a>";

	                        }
	                    ?>
		                <a href="javascript:void(window.open('<?php echo site_url('inventory_beritaacara/') ?>'))" class="btn btn-success">Kembali</a>
		            </td>
			    </tr>
            </table>
            <?php echo form_close(); ?>
		</section><!-- /.content -->
<!------------------------------------------------------------------------------------------------------------------------------------->
<?php } elseif($view=='tambahmaterial'){ ?>
		<section class="content-header table-responsive">
	            <h1>
	                <?php echo $form ?>
	                <small><?php echo $form_small ?></small>
	            </h1>
            </section>
            <section class="content">
		        <?php
			        $attributes = array('class' => 'form-horizontal form-validate', 'id' => 'form', 'method' => 'POST', 'novalidate'=>'novalidate','onsubmit'=>'return validate()');
		    	echo form_open($action,$attributes);
		    	?>
		    	<table width="100%" border="0">
			    	 <tr>
			            <th align="left">
			            	<script type='text/javascript'>
						        var site = "<?php echo site_url();?>";
						        $(function(){
						        	$('.autocomplete').keyup(function(e) {
						        		$('#idinventory_penyerahan_barang').val('0');
						        	});
						            $('.autocomplete').autocomplete({
						                serviceUrl: site+'/autocomplete/searchinventory/',
						                onSelect: function (suggestion) {
						                    $('#idinventory_penyerahan_barang').val(''+suggestion.replid);
											$('#iddepartemen').val(''+suggestion.iddepartemen);
											$('#idpj').val(''+suggestion.idpj);
											$('#idruang').val(''+suggestion.idruang);
											$('#idkondisi').val(''+suggestion.idkondisi);
											$('#iddepartemen_lama').val(''+suggestion.iddepartemen);
											$('#idpj_lama').val(''+suggestion.idpj);
											$('#idruang_lama').val(''+suggestion.idruang);
											$('#idkondisi_lama').val(''+suggestion.idkondisi);
						                }
						            });
						        });
						        function validate() {
    									var idinventory_penyerahan_barang=parseInt(document.getElementById("idinventory_penyerahan_barang").value);
    									if (idinventory_penyerahan_barang==0){
    										alert ("Pilih Material Terlebih Dahulu");
    										return false;
    									}
								    }
						    </script>
			        		<label class="control-label" for="minlengthfield">Material</label>
			        		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		//$arrmat='data-rule-required=true';
			                		//echo form_dropdown('idmaterial',$mat_opt,$isi->idmaterial,$arrmat);
                          if($isi->materialtext<>""){
                            echo $isi->materialtext;
                          } else{
			                	?>
			                	<input type="search" style="width:400px" class='autocomplete' id="autocomplete1" name="nama_material" data-rule-required=true data-rule-maxlength=200 data-rule-minlength=2 placeholder="Masukkan 2-200 Karakter" value="<?php echo $isi->materialtext ?>"/>
                      <?php } ?>
			                	<input type="hidden" name="idinventory_penyerahan_barang" id="idinventory_penyerahan_barang" data-rule-required=true data-rule-minlength=2 value="<?php echo $isi->idinventory_penyerahan_barang ?>" >
                        <input type="hidden" name="iddepartemen_lama" id="iddepartemen_lama" data-rule-required=true data-rule-minlength=1 value="<?php echo $isi->iddepartemen_lama ?>" >
                        <input type="hidden" name="idpj_lama" id="idpj_lama" data-rule-required=true data-rule-minlength=1 value="<?php echo $isi->idpj_lama ?>" >
                        <input type="hidden" name="idruang_lama" id="idruang_lama" data-rule-required=true data-rule-minlength=1 value="<?php echo $isi->idruang_lama ?>" >
                        <input type="hidden" name="idkondisi_lama" id="idkondisi_lama" data-rule-required=true data-rule-minlength=1 value="<?php echo $isi->idkondisi_lama ?>" >
								</div>
			        		</div>
			            </th></tr>
                  <tr>
  			            <th align="left">
  			        		<label class="control-label" for="minlengthfield">Departemen Baru</label>
  			        		<div class="control-group">
  								<div class="controls">:
  			                	<?php
  			                		$arriddepartemen='data-rule-required=true';
  			                		echo form_dropdown('iddepartemen',$iddepartemen_opt,$isi->iddepartemen,$arriddepartemen);
  			                	?>
  								</div>
  			        		</div>
  			            </th></tr>
                  <tr>
  			            <th align="left">
  			        		<label class="control-label" for="minlengthfield">Penanggung Jawab Baru</label>
  			        		<div class="control-group">
  								<div class="controls">:
  			                	<?php
  			                		$arridpj='data-rule-required=true id="idpj"';
  			                		echo form_dropdown('idpj',$idpj_opt,$isi->idpj,$arridpj);
  			                	?>
  								</div>
  			        		</div>
  			            </th></tr>
				        <tr>
			            <th align="left">
			        		<label class="control-label" for="minlengthfield">Ruangan Baru</label>
			        		<div class="control-group">
								<div class="controls">:
			                	<?php
			                		$arridruang='data-rule-required=true id="idruang"';
			                		echo form_dropdown('idruang',$idruang_opt,$isi->idruang,$arridruang);
			                	?>
								</div>
			        		</div>
			            </th></tr>
                  <tr>
  			            <th align="left">
  			        		<label class="control-label" for="minlengthfield">Kondisi</label>
  			        		<div class="control-group">
  								<div class="controls">:
  			                	<?php
  			                		$arridkondisi='data-rule-required=true  id="idkondisi"';
  			                		echo form_dropdown('idkondisi',$idkondisi_opt,$isi->idkondisi,$arridkondisi);
  			                	?>
  								</div>
  			        		</div>
  			            </th></tr>

				        <tr>
				            <th align="left">
				            	<button class='btn btn-primary' onclick="return validate()">Simpan</button>
				            	<a href="javascript:void(window.open('<?php echo site_url('inventory_beritaacara/material/'.$idberita_acara) ?>'))" class="btn btn-success">Batal</a>
				            </th>
				    </tr>
	            </table>
	        	<?php
	        	echo form_close();
	        	?>
	    </section>
<!------------------------------------------------------------------------------------------------------------------------------------->

<?php } ?>
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
    </body>
</html>
