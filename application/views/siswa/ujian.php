<div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Data Ujian</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">Data Ujian
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table id="" class="table table-striped table-bordered table-hover">
                                        <thead>
                                          <tr>
                                            <th>NO</th>
                                            <th>JENIS UJIAN</th>
                                            <th>MATA PELAJARAN</th>
                                            <th>JUMLAH SOAL</th>
                                            <th>WAKTU</th>
                                            <th>NILAI</th>
                                            <th></th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $no = 0;
                                        foreach($data as $key) :
                                        $no++ ?>
                                          <tr>
                                            <td><?php echo $no ?></td>
                                            <td><?php echo $key['nama_ujian']; ?></td>
                                            <td><?php echo $key['mapel']; ?></td>
                                            <td><?php echo $key['jumlah_soal']; ?></td>
                                            <td><?php echo $key['waktu']; ?></td>
                                            <td><?php echo $key['nilai']; ?></td>
                                            <?php $id = $key['id']?>
                                            <?php $id1 = $this->session->userdata('user_id')?>
                                            <?php if ($key['sudah_ikut']== "0") {
                                            $link_address = 'http://localhost/ujianonline/ujian/ikut/'.$id;
                                            echo "<td>
                                                <div class='hidden-sm hidden-xs btn-group'>
                                                <a href='".$link_address."' class='btn btn-success btn-xs' ><i class='glyphicon glyphicon-check'></i> Ikut Ujian</a>
                                              </div>
                                             
                                            </td>";
                                            } else{
                                                
                                                $link_address = 'http://localhost/ujianonline/ujian/dnilai2/'.$id1;
                                                 echo "<td>
                                                <div class='hidden-sm hidden-xs btn-group'>
                                                <a href='".$link_address."' class='btn btn-danger btn-xs'><i class='glyphicon glyphicon-check'></i> Sudah Ikut</a>
                                              </div>
                                             
                                            </td>";
                                                }?>
                                            </td> 
                                          </tr>
                                          <?php endforeach; ?>
                                        </tbody>
                                      </table>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
           