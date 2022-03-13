<div class="modal fade" tabindex="-1" role="dialog" id="modaleditsupplier" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Supplier : <?= $id_supplier ?></h5> <button type="button" class="close" data-dismiss="modal"
                    aria-label="Close"> <span aria-hidden="true">×</span> </button>
            </div>
            <?= form_open('admin/supplier/updatedatasupplier', ['class' => 'formsupplier']) ?>
            <?= csrf_field(); ?>
            <div class="modal-body">
                <input type="text" name="id_supplier" value="<?= $id_supplier ?>" hidden>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-10">
                        <input type="text" name="nama" class="form-control" id="nama" placeholder="Nama"
                            value="<?= $nama ?>" autofocus>
                        <div class="invalid-feedback error_nama">

                        </div>
                    </div>
                </div>
                
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Alamat</label>
                    <div class="col-sm-10">
                        <input type="text" name="alamat" class="form-control" id="alamat" placeholder="Alamat"
                            value="<?= $alamat ?>">
                        <div class="invalid-feedback error_alamat">

                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Kota</label>
                    <div class="col-sm-10">
                        <input type="text" name="kota" class="form-control" id="kota" placeholder="kota"
                            value="<?= $kota ?>">
                        <div class="invalid-feedback error_kota">

                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Telepon</label>
                    <div class="col-sm-10">
                        <input type="text" name="telepon" class="form-control" id="telepon" placeholder="telepon"
                            value="<?= $telepon ?>">
                        <div class="invalid-feedback error_telepon">

                        </div>
                    </div>
                </div>
                
            </div>
            <div class="modal-footer bg-whitesmoke">
                <button type="submit" class="btn btn-primary btnsimpanbarang">
                    <i class="fas fa-edit"></i>
                    Update</button>
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
                    $('.btnsimpanbarang').attr('disable', 'disabled');
                    $('.btnsimpanbarang').html('<i class="fas fa-spin fa-spinner"></i>');
                },
                complete: function () {
                    $('.btnsimpanbarang').removeAttr('disable');
                    $('.btnsimpanbarang').html('Update');
                },
                success: function (response) {
                    if (response.error) {

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
                        if (response.error.telepon) {
                            $('#telepon').addClass('is-invalid');
                            $('.error_telepon').html(response.error.telepon);
                        } else {
                            $('#telepon').removeClass('is-invalid');
                            $('.error_telepon').html('');
                        }
                    } 
                    if (response.error == undefined) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.sukses,
                        })

                        $('#modaleditsupplier').modal('hide');
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