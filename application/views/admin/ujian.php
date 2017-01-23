<div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Data Ujian</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">Data Ujian</div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table id="table_id1" class="table table-striped table-bordered table-hover">
                                        <thead>
                                          <tr>
                                            <th>NO</th>
                                            <th>NAMA UJIAN</th>
                                            <th>NAMA GURU</th>
                                            <th>MATA PELAJARAN</th>
                                            <th>JURUSAN</th>
                                            <th>JUMLAH SOAL</th>
                                            <th>WAKTU</th>
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
                                            <td><?php echo $key['nama_guru']; ?></td>
                                            <td><?php echo $key['mapel']; ?></td>
                                            <td><?php echo $key['jurusan']; ?></td>
                                            <td><?php echo $key['jumlah_soal']; ?></td>
                                            <td><?php echo $key['waktu']; ?></td>
                                            <td>
                                            <?php $id = $key['id'];?>
                                            <?php $link_address = 'http://localhost/ujianonline/ujian/hasil/'.$id; ?>
                                              <div class='hidden-sm hidden-xs btn-group'>
                                                <a href='<?php echo $link_address;?>' class='btn btn-info btn-xs' ><i class='glyphicon glyphicon-eye-open'></i> Lihat Hasil</a>
                                              </div>
                                            </td>
                                                <?php endforeach; ?>
                                          </tr>
                                        </tbody>
                                      </table>

                                      <div id="modal_form" class="modal fade" role="dialog">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                                                <h4 class="modal-title">Tambah Siswa</h4>
                                            </div>
                                            <form action="#" id="form" class="form-horizontal">
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label class="col-lg-2 col-sm-2 control-label">Ujian</label>
                                                        <div class="col-lg-10">
                                                            <input name="nama_ujian" type="text" class="form-control" placeholder="Tuliskan Nim">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-lg-2 col-sm-2 control-label">Mapel</label>
                                                        <div class="col-lg-10">
                                                            <select class="form-control" name="nama_mapel">
                                                                <option>Pilih Jurusan</option>
                                                                <?php foreach($mapel as $jur) : ?>
                                                                <option value="<?php echo $jur['mengajar']; ?>"><?php echo $jur['mengajar']; ?></option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-lg-2 col-sm-2 control-label">Jurusan</label>
                                                        <div class="col-lg-10">
                                                            <select class="form-control" name="jurusan_ujian">
                                                                <option>Pilih Jurusan</option>
                                                                <?php foreach($jurusan as $jur) : ?>
                                                                <option value="<?php echo $jur['nama_jurusan']; ?>"><?php echo $jur['nama_jurusan']; ?></option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-lg-2 col-sm-2 control-label">soal</label>
                                                        <div class="col-lg-10">
                                                            <input name="jumlah_soal" type="text" class="form-control" placeholder="Tuliskan Nim">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-lg-2 col-sm-2 control-label">Waktu</label>
                                                        <div class="col-lg-10">
                                                            <input name="waktu_ujian" type="text" class="form-control" placeholder="Tuliskan Nim">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-sm btn-success" id="btnSave" onclick="save()"><i class="ace-icon fa fa-check"></i> Simpan&nbsp;</button>
                                                    <button type="button" class="btn btn-sm btn-warning" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
                                                </div>
                                            </form>
                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div><!-- /.modal tambah-->
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <script>
            $(document).ready(function() {
              $('#table_id').DataTable({
                responsive: true
              });
            });
            var save_method; //for save method string
            var table;

            function ujian_add(id) {
              save_method = 'add';
              $('#form')[0].reset(); // reset form on modals
              $('#modal_form').modal('show'); // show bootstrap modal
              $('.modal-title').text('Add Ujian'); // Set Title to Bootstrap modal title
            }

            function edit_ujian(id) {
              save_method = 'update';
              $('#form')[0].reset(); // reset form on modals
              //Ajax Load data from ajax
              $.ajax({
                url : "<?php echo site_url('/ujian/ajax_edit/')?>/" + id,
                type: "GET",
                dataType: "JSON",
                success: function(data) {
                  $('[name="nama_ujian"]').val(data.nama_ujian);
                  $('[name="nama_mapel"]').val(data.id_mapel);
                  $('[name="jurusan_ujian"]').val(data.id_jurusan);
                  $('[name="jumlah_soal"]').val(data.jumlah_soal);
                  $('[name="waktu_ujian"]').val(data.waktu);
                  $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
                  $('.modal-title').text('Edit Siswa'); // Set title to Bootstrap modal title
                },
                  error: function (jqXHR, textStatus, errorThrown) {
                    alert('Error get data from ajax');
                  }
              });
            }

            function active(id) {
               save_method = 'active';
              $('#form')[0].reset(); // reset form on modals
              //Ajax Load data from ajax
              $.ajax({
                url : "<?php echo site_url('/siswa/ajax_edit/')?>/" + id,
                type: "GET",
                dataType: "JSON",
                success: function(data) {
                  $('[name="nis_siswa"]').val(data.nim);
                  $('[name="nama_siswa"]').val(data.nama);
                  $('#modal_active').modal('show'); // show bootstrap modal when complete loaded
                  $('.modal-title').text('Actifkan Siswa'); // Set title to Bootstrap modal title
                },
                  error: function (jqXHR, textStatus, errorThrown) {
                    alert('Error get data from ajax');
                  }
              });
            }

            function delete_ujian(id) {
              if(confirm('Are you sure delete this data?')) {
                // ajax delete data from database
                $.ajax({
                  url : "<?php echo site_url('/siswa/siswa_delete')?>/"+id,
                  type: "POST",
                  dataType: "JSON",
                  success: function(data) {
                    location.reload();
                  },
                    error: function (jqXHR, textStatus, errorThrown) {
                        alert('Error deleting data');
                    }
                });
              }
            }

            function save() {
              var url;
              if(save_method == 'add') {
                url = "<?php echo site_url('/ujian/ujian_add')?>";
              } else {
                url = "<?php echo site_url('/ujian/ujian_update')?>";
              } 
              // ajax adding data to database
                $.ajax({
                  url : url,
                  type: "POST",
                  data: $('#form').serialize(),
                  dataType: "JSON",
                  success: function(data) {
                //if success close modal and reload ajax table
                    $('#modal_form').modal('hide');
                    location.reload();// for reload a page
                  },
                    error: function (jqXHR, textStatus, errorThrown) {
                      alert('Error adding / update data');
                    }
                });
            }
            </script>