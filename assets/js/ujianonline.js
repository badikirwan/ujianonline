$(document).ready( function () {
    $('#table_id').DataTable();
} );
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
        	url : "<?php echo site_url('/siswa/ajax_edit/')?>/" + id,
        	type: "GET",
        	dataType: "JSON",
        	success: function(data) {
        		$('[name="nis_siswa"]').val(data.nim);
        		$('[name="nama_siswa"]').val(data.nama);
        		$('[name="jurusan_siswa"]').val(data.jurusan);
        		$('#modal_form').modal('show'); // show bootstrap modal when complete loaded
        		$('.modal-title').text('Edit Siswa'); // Set title to Bootstrap modal title
        	},
            	error: function (jqXHR, textStatus, errorThrown) {
                alert('Error get data from ajax');
            }
        });
    }

    function siswa_delete(id) {
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
            url = "<?php echo site_url('/siswa/siswa_add')?>";
        } else {
            url = "<?php echo site_url('/siswa/siswa_update')?>";
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

    
