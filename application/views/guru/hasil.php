<div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Hasil Ujian</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading"> Hasil Ujian
                            <div class="nav pull-right tombol-kanan">
                                <?php $id = 1; ?>
                                <a href='<?php echo base_url('cetak/pdf/'.$id); ?>' class='btn btn-info btn-sm' target='_blank'><i class='glyphicon glyphicon-print'></i> Cetak</a>
                            </div>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table id="table_id" class="table table-bordered">
                              <thead>
                                <tr>
                                  <th width="10%">No</th>
                                  <th>Nama</th>
                                  <th width="15%">Jumlah Benar</th>
                                  <th width="15%">Jumlah Salah</th>
                                  <th width="10%">Nilai</th>
                                </tr>
                              </thead>
                              <tbody>
                              <?php 
                              $no = 0;
                              foreach($data as $key) :
                              $no++ ?>
                              <tr>
                                <td><?php echo $no ?></td>
                                <td><?php echo $key['nama']; ?></td>
                                <td><?php echo $key['benar']; ?></td>
                                <td><?php echo $key['salah']; ?></td>
                                <td><?php echo $key['total_nilai']; ?></td>
                              </tr>
                              <?php endforeach; ?>
                              </tbody>
                            </table>

                               