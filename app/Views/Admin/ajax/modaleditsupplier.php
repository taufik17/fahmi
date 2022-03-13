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
                            value="<?= $nama ?>">
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
                        if (response.error.id_supplier) {
                            $('#id_supplier').addClass('is-invalid');
                            $('.error_id_supplier').html(response.error.id_supplier);
                        } else {
                            $('#id_supplier').removeClass('is-invalid');
                            $('.error_id_supplier').html('');
                        }

                        if (response.error.kategori) {
                            $('#kategori').addClass('is-invalid');
                            $('.error_kategori_barang').html(response.error.kategori);
                        } else {
                            $('#kategori').removeClass('is-invalid');
                            $('.error_kategori_barang').html('');
                        }

                        if (response.error.namabarang) {
                            $('#namabarang').addClass('is-invalid');
                            $('.error_nama_barang').html(response.error.namabarang);
                        } else {
                            $('#namabarang').removeClass('is-invalid');
                            $('.error_nama_barang').html('');
                        }

                        if (response.error.harga) {
                            $('#harga').addClass('is-invalid');
                            $('.error_harga_barang').html(response.error.harga);
                        } else {
                            $('#harga').removeClass('is-invalid');
                            $('.error_harga_barang').html('');
                        }
                        if (response.error.stok) {
                            $('#stok').addClass('is-invalid');
                            $('.error_stok_barang').html(response.error.stok);
                        } else {
                            $('#stok').removeClass('is-invalid');
                            $('.error_stok_barang').html('');
                        }
                        if (response.error.supplier) {
                            $('#supplier').addClass('is-invalid');
                            $('.error_supplier_barang').html(response.error.supplier);
                        } else {
                            $('#supplier').removeClass('is-invalid');
                            $('.error_supplier_barang').html('');
                        }

                    } else {
                        alert("Hello! I am an alert box!!");
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.sukses,
                        })

                        $('#modaleditbarang').modal('hide');
                        databarang();
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