<div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Data Siswa</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading"> Data Siswa
                            <div class="nav pull-right tombol-kanan">
                                <a class="btn btn-info btn-sm" onclick="siswa_add()"><i class="glyphicon glyphicon-plus"></i> &nbsp;&nbsp;Tambah</a>
                            </div>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table id="table_id" class="table table-striped table-bordered table-hover">
                                  <thead>
                                    <tr>
                                      <th>NO</th>
                                      <th>NIS</th>
                                      <th>NAMA</th>
                                      <th>JURUSAN</th>
                                      <th>STATUS</th>
                                      <th width="20%"></th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                  <?php
                                  $no = 0;
                                  foreach($data as $key) :
                                  $no++ ?>
                                    <tr>
                                      <td><?php echo $no;?></td>
                                      <td><?php echo $key['nim']; ?></td>
                                      <td><?php echo $key['nama']; ?></td>
                                      <td><?php echo $key['jurusan']; ?></td>
                                      <?php if($key['ada']== 1) {
                                          echo"<td><span class='label label-sm label-success'>Aktif</span></td>";
                                        } else {
                                          echo"<td><span class='label label-sm label-warning'>Tidak aktif</span></td>";
                                          }
                                          ?>
                                      <td>
                                        <div class="hidden-sm hidden-xs btn-group">
                                          <button class="btn btn-warning btn-xs" onclick="edit_siswa(<?php echo $key['id'];?>)"><i class="glyphicon glyphicon-pencil"></i> Edit
                                          </button>
                                          <button class="btn btn-danger btn-xs" onclick="siswa_delete(<?php echo $key['id'];?>)"><i class="glyphicon glyphicon-trash"></i> Hapus
                                          </button>
                                          <?php if($key['ada']==0) {
                                          echo "<button class='btn btn-success btn-xs' onclick='active($key[id])'><i class='ace-icon fa fa-check bigger-120'></i> Aktifkan
                                          </button>";
                                        } ?>
                                        </div>
                                      </td>
                                          <?php endforeach; ?>
                                    </tr>
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
                                                        <label class="col-lg-2 col-sm-2 control-label">Nis</label>
                                                        <div class="col-lg-10">
                                                            <input name="nis_siswa" type="text" class="form-control" placeholder="Tuliskan Nim">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-lg-2 col-sm-2 control-label">Nama</label>
                                                        <div class="col-lg-10">
                                                            <input name="nama_siswa" type="text" class="form-control" placeholder="Tuliskan Nama">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-lg-2 col-sm-2 control-label">Jurusan</label>
                                                        <div class="col-lg-10">
                                                            <select class="form-control" name="jurusan_siswa">
                                                                <option>Pilih Jurusan</option>
                                                                <?php foreach($jurusan as $jur) : ?>
                                                                <option value="<?php echo $jur['nama_jurusan']; ?>"><?php echo $jur['nama_jurusan']; ?></option>
                                                                <?php endforeach; ?>
                                                            </select>
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
                                <div id="modal_active" class="modal fade" role="dialog">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                                                <h4 class="modal-title">Tambah Siswa</h4>
                                            </div>
                                            <form action="#" id="form" class="form-horizontal">
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label class="col-lg-2 col-sm-2 control-label">User ID</label>
                                                        <div class="col-lg-10">
                                                            <input name="nis_siswa" type="text" class="form-control" placeholder="User ID" disabled>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-lg-2 col-sm-2 control-label">Nama</label>
                                                        <div class="col-lg-10">
                                                            <input name="nama_siswa" type="text" class="form-control" placeholder="Nama" disabled>
                                                        </div>
                                                    </div>
                                                   <div class="form-group">
                                                        <label class="col-lg-2 col-sm-2 control-label">Username</label>
                                                        <div class="col-lg-10">
                                                            <input name="nis_siswa" type="text" class="form-control" placeholder="Username" disabled>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-lg-2 col-sm-2 control-label">Password</label>
                                                        <div class="col-lg-10">
                                                            <input name="nis_siswa" type="text" class="form-control" placeholder="Password" disabled>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-sm btn-success" id="btnSave" onclick="save()"><i class="ace-icon fa fa-check"></i> Aktifkan&nbsp;</button>
                                                    <button type="button" class="btn btn-sm btn-warning" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
                                                </div>
                                            </form>
                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div><!-- /.modal tambah-->
                                <!-- End Bootstrap modal -->
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

function siswa_add() {
    save_method = 'add';
    $('#form')[0].reset(); // reset form on modals
    $('#modal_form').modal('show'); // show bootstrap modal
    $('.modal-title').text('Add Siswa'); // Set Title to Bootstrap modal title
}

function edit_siswa(id) {
    save_method = 'update';
    $('#form')[0].reset(); // reset form on modals
    //Ajax Load data from ajax
    $.ajax({
        url: "<?php echo site_url('/siswa/ajax_edit/')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data) {
            $('[name="id"]').val(data.id);
            $('[name="nis_siswa"]').val(data.nim);
            $('[name="nama_siswa"]').val(data.nama);
            $('[name="jurusan_siswa"]').val(data.jurusan);
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Siswa'); // Set title to Bootstrap modal title
        },
        error: function(jqXHR, textStatus, errorThrown) {
            alert('Error get data from ajax');
        }
    });
}

function active(id) {
    save_method = 'active';
    $('#form')[0].reset(); // reset form on modals
    //Ajax Load data from ajax
    $.ajax({
        url: "<?php echo site_url('/siswa/ajax_edit/')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data) {
            $('[name="nis_siswa"]').val(data.nim);
            $('[name="nama_siswa"]').val(data.nama);
            $('#modal_active').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Actifkan Siswa'); // Set title to Bootstrap modal title
        },
        error: function(jqXHR, textStatus, errorThrown) {
            alert('Error get data from ajax');
        }
    });
}

function siswa_delete(id) {
    if (confirm('Are you sure delete this data?')) {
        // ajax delete data from database
        $.ajax({
            url: "<?php echo site_url('/siswa/siswa_delete')?>/" + id,
            type: "POST",
            dataType: "JSON",
            success: function(data) {
                location.reload();
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error deleting data');
            }
        });
    }
}

function save() {
    var url;
    if (save_method == 'add') {
        url = "<?php echo site_url('/siswa/siswa_add')?>";
    }
    if (save_method == 'update') {
        url = "<?php echo site_url('/siswa/siswa_update')?>";
    }
    if (save_method == 'active') {
        url = "<?php echo site_url('/siswa/active_user')?>";
    }
    // ajax adding data to database
    $.ajax({
        url: url,
        type: "POST",
        data: $('#form').serialize(),
        dataType: "JSON",
        success: function(data) {
            //if success close modal and reload ajax table
            $('#modal_form').modal('hide');
            location.reload(); // for reload a page
        },
        error: function(jqXHR, textStatus, errorThrown) {
            alert('Error adding / update data');
        }
    });
}
</script>