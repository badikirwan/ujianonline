<div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Soal Ujian</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="pull-right tableTools-container">
                                <div class="dt-buttons btn-overlap btn-group">
                                  <a class="btn btn-primary" onclick="soal_add()"><i class="glyphicon glyphicon-plus"></i> &nbsp;Tambah</a>
                                </div>
                              </div>
                              <br></br>
                                <!-- PAGE CONTENT BEGINS -->
                                <div class="row">
                                    <div class="col-xs-12">
                                    
                                        <div id="accordion" class="panel-group">
                                        <?php
                                            $no = 0;
                                            foreach ($data as $key) :
                                            $no++ ?>

                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <h4 class="panel-title">
                                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $no; ?>" aria-expanded="false">
                                                            <i class="bigger-110 ace-icon fa fa-angle-right" data-icon-hide="ace-icon fa fa-angle-down" data-icon-show="ace-icon fa fa-angle-right"></i>
                                                            &nbsp;<?php echo $no; ?>. <?php echo $key['soal'] ?>
                                                        </a>
                                                        <div class="btn-group nav pull-right">
                                                          <button class="btn btn-warning btn-xs" onclick="edit_soal(<?php echo $key['id_soal'];?>)"><i class="glyphicon glyphicon-pencil"></i> Edit
                                                          </button>
                                                          <button class="btn btn-danger btn-xs" onclick="delete_soal(<?php echo $key['id_soal'];?>)"><i class="glyphicon glyphicon-trash"></i> Hapus
                                                          </button>
                                                        </div>
                                                    </h4>
                                                </div>

                                                <div class="panel-collapse collapse" id="collapse<?php echo $no;?>" aria-expanded="false" style="height: 0px;">
                                                    <div class="panel-body">
                                                        <?php
                                                            $jwb = array("A","B","C","D");
                                                            for($i=0; $i<sizeof($jwb);$i++) {
                                                                $pil = "opsi_".$jwb[$i];
                                                                if ($key['jawaban'] == strtoupper($jwb[$i])) {
                                                            echo "<p style='color: green; font-size: 12px'>".$jwb[$i].". ".$key[$pil]."</p>";
                                                            } else {
                                                                echo "<p style='font-size: 12px;'>".$jwb[$i].". ".$key[$pil]."</p>";
                                                                }
                                                            } ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div><!-- /.col -->
                                </div><!-- /.row -->
                                <!--modal tambah-->
                                <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="modal_form" class="modal fade">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                                                <h4 class="modal-title">Tambah Soal</h4>
                                            </div>
                                            <form action="#" id="form" class="form-horizontal">
                                              <div class="modal-body">
                                              <input type="hidden" value="" name="id"/>
                                                <div class="form-group">
                                                  <label class="col-lg-2 col-sm-2 control-label">Guru</label>
                                                  <div class="col-lg-10">
                                                    <select class="form-control" name="guru">
                                                      <option>Pilih Guru</option>
                                                      <?php foreach($guru as $gu) : ?>
                                                        <option value="<?php echo $gu['id']; ?>"><?php echo $gu['nama']; ?></option>
                                                      <?php endforeach; ?>
                                                    </select>
                                                  </div>
                                                </div>
                                                <div class="form-group">
                                                  <label class="col-lg-2 col-sm-2 control-label">Mapel</label>
                                                  <div class="col-lg-10">
                                                    <select class="form-control" name="mapel">
                                                      <option>Pilih Mapel</option>
                                                      <?php foreach($mapel as $mp) : ?>
                                                        <option value="<?php echo $mp['id']; ?>"><?php echo $mp['nama']; ?></option>
                                                      <?php endforeach; ?>
                                                    </select>
                                                  </div>
                                                </div>
                                                <div class="form-group">
                                                  <label class="col-lg-2 col-sm-2 control-label">Bobot Soal</label>
                                                  <div class="col-lg-10">
                                                    <input type="text" class="form-control" name="bobot" placeholder="Tuliskan Bobot Soal">
                                                  </div>
                                                </div>
                                                <div class="form-group">
                                                  <label class="col-lg-2 col-sm-2 control-label">Soal</label>
                                                  <div class="col-lg-10">
                                                    <textarea class="form-control" name="soal" rows="3" placeholder="Tuliskan Soal"></textarea>
                                                  </div>
                                                </div>
                                                <div class="form-group">
                                                  <label class="col-lg-2 col-sm-2 control-label">Opsi A</label>
                                                  <div class="col-lg-10">
                                                    <input type="text" class="form-control" name="opsi_a" placeholder="Tuliskan Opsi A">
                                                  </div>
                                                </div>
                                                <div class="form-group">
                                                  <label class="col-lg-2 col-sm-2 control-label">Opsi B</label>
                                                  <div class="col-lg-10">
                                                    <input type="text" class="form-control" name="opsi_b" placeholder="Tuliskan Opsi B">
                                                  </div>
                                                </div>
                                                <div class="form-group">
                                                  <label class="col-lg-2 col-sm-2 control-label">Opsi C</label>
                                                  <div class="col-lg-10">
                                                    <input type="text" class="form-control" name="opsi_c" placeholder="Tuliskan Opsi C">
                                                  </div>
                                                </div>
                                                <div class="form-group">
                                                  <label class="col-lg-2 col-sm-2 control-label">Opsi D</label>
                                                  <div class="col-lg-10">
                                                    <input type="text" class="form-control" name="opsi_d" placeholder="Tuliskan Opsi D">
                                                  </div>
                                                </div>
                                                <div class="form-group">
                                                  <label class="col-lg-2 col-sm-2 control-label">Jawaban</label>
                                                  <div class="col-lg-10">
                                                    <select class="form-control" name="jawaban">
                                                      <option>Pilih Jawaban</option>
                                                      <option value="A">Opsi A</option>
                                                      <option value="B">Opsi B</option>
                                                      <option value="C">Opsi C</option>
                                                      <option value="D">Opsi D</option>
                                                    </select>
                                                  </div>
                                                </div>
                                              </div>
                                              <div class="modal-footer">
                                                <button class="btn btn-sm btn-success" type="submit" onclick="save()"><i class="ace-icon fa fa-check"></i> Simpan&nbsp;</button>
                                                <button type="button" class="btn btn-sm btn-warning" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
                                              </div>
                                            </form>
                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div><!-- /.modal tambah-->

                                
                                <!--modal tambah-->
                                <script>
$(document).ready(function() {
    $('#table_id').DataTable({
        responsive: true
    });
});
var save_method; //for save method string
var table;

function soal_add() {
    save_method = 'add';
    $('#form')[0].reset(); // reset form on modals
    $('#modal_form').modal('show'); // show bootstrap modal
    $('.modal-title').text('Add Siswa'); // Set Title to Bootstrap modal title
}

function edit_soal(id) {
    save_method = 'update';
    $('#form')[0].reset(); // reset form on modals
    //Ajax Load data from ajax
    $.ajax({
        url: "<?php echo site_url('/soal/ajax_edit/')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data) {
            $('[name="id"]').val(data.id_soal);
            $('[name="guru"]').val(data.id_guru);
            $('[name="mapel"]').val(data.id_mapel);
            $('[name="bobot"]').val(data.bobot);
            $('[name="soal"]').val(data.soal);
            $('[name="opsi_a"]').val(data.opsi_A);
            $('[name="opsi_b"]').val(data.opsi_B);
            $('[name="opsi_c"]').val(data.opsi_C);
            $('[name="opsi_d"]').val(data.opsi_D);
            $('[name="jawaban"]').val(data.jawaban);
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Siswa'); // Set title to Bootstrap modal title
        },
        error: function(jqXHR, textStatus, errorThrown) {
            alert('Error get data from ajax');
        }
    });
}

function delete_soal(id) {
    if (confirm('Are you sure delete this data?')) {
        // ajax delete data from database
        $.ajax({
            url: "<?php echo site_url('/soal/soal_delete')?>/" + id,
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
        url = "<?php echo site_url('/soal/soal_add')?>";
    } else {
        url = "<?php echo site_url('/soal/soal_update')?>";
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
            
            <!-- /.container-fluid -->