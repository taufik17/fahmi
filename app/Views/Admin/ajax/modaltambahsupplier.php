<div class="modal fade" tabindex="-1" role="dialog" id="modaltambahsupplier" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Data Supplier</h5> <button type="button" class="close" data-dismiss="modal"
                    aria-label="Close"> <span aria-hidden="true">×</span> </button>
            </div>
            <?= form_open('admin/supplier/simpansupplier', ['class' => 'formsupplier']) ?>
            <?= csrf_field(); ?>
            <div class="modal-body">
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">ID Supplier</label>
                    <div class="col-sm-10">
                        <input type="text" name="id_supplier" class="form-control" id="id_supplier" placeholder="ID Supplier">
                        <div class="invalid-feedback error_id_supplier">

                        </div>
                    </div>
                </div>


                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Nama supplier</label>
                    <div class="col-sm-10">
                        <input type="text" name="nama" class="form-control" id="nama" placeholder="Nama Supplier">
                        <div class="invalid-feedback error_nama">

                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Alamat</label>
                    <div class="col-sm-10">
                        <input type="text" name="alamat" class="form-control" id="alamat" placeholder="alamat">
                        <div class="invalid-feedback error_alamat">

                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Kota</label>
                    <div class="col-sm-10">
                        <input type="text" name="kota" class="form-control" id="kota" placeholder="Kota">
                        <div class="invalid-feedback error_kota">

                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Telepon</label>
                    <div class="col-sm-10">
                        <input type="text" name="telp" class="form-control" id="telp" placeholder="Telepon">
                        <div class="invalid-feedback error_telp">

                        </div>
                    </div>
                </div>

            
            </div>
            <div class="modal-footer bg-whitesmoke">
                <button type="submit" class="btn btn-primary btnsimpansupplier">
                    <i class="fas fa-save"></i>
                    Simpan</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
            </div>
            <?= form_close() ?>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('.formsupplier').submit(function (e) {
            e.preventDefault();
            $.ajax({
                type: "post",
                url: $(this).attr('action'),
                data: $(this).serialize(),
                dataType: "json",
                beforeSend: function () {
                    $('.btnsimpansupplier').attr('disable', 'disabled');
                    $('.btnsimpansupplier').html('<i class="fas fa-spin fa-spinner"></i>');
                },
                complete: function () {
                    $('.btnsimpansupplier').removeAttr('disable');
                    $('.btnsimpansupplier').html('Simpan');
                },
                success: function (response) {
                    if (response.error) {
                        if (response.error.id_supplier) {
                            $('#id_supplier').addClass('is-invalid');
                            $('.error_id_supplier').html(response.error.id_supplier);
                        } else {
                            $('#id_supplier').removeClass('is-invalid');
                            $('.error_id_supplier').html('');
                        }

                        if (response.error.nama) {
                            $('#nama').addClass('is-invalid');
                            $('.error_nama').html(response.error.nama);
                        } else {
                            $('#nama').removeClass('is-invalid');
                            $('.error_nama').html('');
                        }

                        if (response.error.alamat) {
                            $('#alamat').addClass('is-invalid');
                            $('.error_alamat').html(response.error.alamat);
                        } else {
                            $('#alamat').removeClass('is-invalid');
                            $('.error_alamat').html('');
                        }

                        if (response.error.kota) {
                            $('#kota').addClass('is-invalid');
                            $('.error_kota').html(response.error.kota);
                        } else {
                            $('#kota').removeClass('is-invalid');
                            $('.error_kota').html('');
                        }
                        if (response.error.telp) {
                            $('#telp').addClass('is-invalid');
                            $('.error_telp').html(response.error.telp);
                        } else {
                            $('#telp').removeClass('is-invalid');
                            $('.error_telp').html('');
                        }

                    } else {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.sukses,
                        })

                        $('#modaltambahsupplier').modal('hide');
                        datasupplier();
                    }

                },
                error: function (xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
            return false;
        });
    });
</script>