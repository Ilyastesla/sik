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
                <section class="content-header table-responsive">
                    <h1>
                        <?php echo $form ?>
                        <small>List Data</small>
                    </h1>
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
                                                <th>No.KTP</th>
                                                <th>Nama</th>
                                                <th>Alamat</th>
                                                <th>Umur</th>
                                                <th width='130px'>Tgl. Pembuatan</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        	<?php
                                        	$CI =& get_instance();
											foreach((array)$show_table as $row) {
												echo "<tr>";
											     echo "<td align='center'>
											    			<a href=javascript:void(window.open('".site_url('hrm_recruitement_data/view/'.$row->replid)."')) >".$row->noktp."</a>
											    		</td>";

											    echo "<td align=''>".($row->nama)."</td>";
											    echo "<td align='center'>".strtoupper($row->alamat_tinggal)
											    	  ."<br/>Telp. ".strtoupper($row->telpon)
											    	  ."<br/>HP. ".strtoupper($row->handphone)
											    	   ."<br/>Email. ".$row->email
											    	   ."</td>";
											    echo "<td align='center'>".strtoupper($row->umur)."</td>";
                          echo "<td align='center'>".$CI->p_c->tgl_indo($row->created_date)."</td>";
												  echo "<td align='center'>";
                          if($row->idpegawai<>""){
                            echo "Telah Di Import";
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
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
    </body>
</html>
