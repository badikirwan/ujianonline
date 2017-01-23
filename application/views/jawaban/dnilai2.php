<div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Data Ujian</h1>
                </div>
                <!-- /.col-lg-12 -->
                </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                            <div class="panel-heading">Selesai ujian</div>
                                <div class="panel-body">
                                <?php 
                                $total=0; 
                                $no=0; 
                                $tgl = date('l, d-m-Y, h:i:s a'); 
                                foreach($nilai as $kon) { 
                                    $total += $kon['nilai'];
                                    } ?>
                                <div class='alert alert-danger'>Anda telah selesai mengikuti ujian ini pada : <strong style='font-size: 16px'><?php echo $tgl;?></strong>, dan mendapatkan nilai : <strong style='font-size: 16px'><?php echo "$total" ?></strong></div>
                                <a href="<?php echo base_url('ujian')?>">Kembali</a>
                                </div>
                            </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>