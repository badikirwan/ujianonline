<div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Data Jurusan</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading"> Data Jurusan
                            <div class="nav pull-right tombol-kanan">
                                <a class="btn btn-info btn-sm" onclick="jurusan_add()"><i class="glyphicon glyphicon-plus"></i> &nbsp;&nbsp;Tambah</a>
                            </div>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table id="table_id" class="table table-bordered">
                              <thead>
                                <tr>
                                  <th width="7%">NO</th>
                                  <th>NAMA</th>
                                  <th width="20%"></th>
                                </tr>
                              </thead>
                              <tbody>
                              <?php 
                              $no = 0;
                              foreach($jurusan as $key) :
                              $no++ ?>
                              <tr>
                                <td><?php echo $no ?></td>
                                <td><?php echo $key['nama_jurusan']; ?></td>
                                <td>
                                  <div class="hidden-sm hidden-xs btn-group">
                                    <button class="btn btn-warning btn-xs" onclick="jurusan_edit(<?php echo $key['id'];?>)"><i class="glyphicon glyphicon-pencil"></i> Edit
                                    </button>
                                    <button class="btn btn-danger btn-xs" onclick="jurusan_delete(<?php echo $key['id'];?>)"><i class="glyphicon glyphicon-trash"></i> Hapus
                                    </button>      
                                  </div>
                                </td>
                              </tr>
                              <?php endforeach; ?>
                              </tbody>
                            </table>

                                <!-- Bootstrap modal -->
                                <div id="modal_form" class="modal fade" role="dialog">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                                                <h4 class="modal-title">Tambah Siswa</h4>
                                            </div>
                                            <form action="#" id="form" class="form-horizontal">
                                                <div class="modal-body">
                                                  <input type="hidden" value="" name="id"/>
                                                    <div class="form-group">
                                                        <label class="col-lg-2 col-sm-2 control-label">Nama</label>
                                                        <div class="col-lg-10">
                                                            <input name="jurusan" type="text" class="form-control" placeholder="Tuliskan Nama">
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
                                <!-- End Bootstrap modal -->
                                 <!-- Bootstrap modal -->
                        </div>
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

            function jurusan_add() {
              save_method = 'add';
              $('#form')[0].reset(); // reset form on modals
              $('#modal_form').modal('show'); // show bootstrap modal
              $('.modal-title').text('Add Mapel'); // Set Title to Bootstrap modal title
            }

            function jurusan_edit(id) {
              save_method = 'update';
              $('#form')[0].reset(); // reset form on modals
              //Ajax Load data from ajax
              $.ajax({
                url : "<?php echo site_url('/jurusan/ajax_edit/')?>/" + id,
                type: "GET",
                dataType: "JSON",
                success: function(data) {
                  $('[name="id"]').val(data.id);
                  $('[name="jurusan"]').val(data.nama_jurusan);
                  $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
                  $('.modal-title').text('Edit Mapel'); // Set title to Bootstrap modal title
                },
                  error: function (jqXHR, textStatus, errorThrown) {
                    alert('Error get data from ajax');
                  }
              });
            }
            
            function jurusan_delete(id) {
              if(confirm('Are you sure delete this data?')) {
                // ajax delete data from database
                $.ajax({
                  url : "<?php echo site_url('/jurusan/jurusan_delete')?>/"+id,
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
                url = "<?php echo site_url('/jurusan/jurusan_add')?>";
              } else {
                url = "<?php echo site_url('/jurusan/jurusan_update')?>";
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