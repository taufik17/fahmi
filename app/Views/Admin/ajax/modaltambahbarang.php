<div class="modal fade" tabindex="-1" role="dialog" id="modaltambahbarang" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Data Barang</h5> <button type="button" class="close" data-dismiss="modal"
                    aria-label="Close"> <span aria-hidden="true">×</span> </button>
            </div>
            <?= form_open('admin/barang/simpanbarang', ['class' => 'formbarang']) ?>
            <?= csrf_field(); ?>
            <div class="modal-body">
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">ID Barang</label>
                    <div class="col-sm-10">
                        <input type="text" name="id_barang" class="form-control" id="id_barang" placeholder="ID Barang">
                        <div class="invalid-feedback error_id_barang">

                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Kategori</label>
                    <div class="col-sm-10">
                        <input type="text" name="kategori" class="form-control" id="kategori" placeholder="Kategori Barang">
                        <div class="invalid-feedback error_kategori_barang">

                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Nama barang</label>
                    <div class="col-sm-10">
                        <input type="text" name="namabarang" class="form-control" id="namabarang" placeholder="Nama barang">
                        <div class="invalid-feedback error_nama_barang">

                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Harga</label>
                    <div class="col-sm-10">
                        <input type="text" name="harga" class="form-control" id="harga" placeholder="Harga">
                        <div class="invalid-feedback error_harga_barang">

                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Stok</label>
                    <div class="col-sm-10">
                        <input type="text" name="stok" class="form-control" id="stok" placeholder="Stok Barang">
                        <div class="invalid-feedback error_stok_barang">

                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Supplier</label>
                    <div class="col-sm-10">
                        <div class="input-group">
                            <select name="supplier" id="supplier" class="form-control select2">
                                <option selected value="">--Supplier--</option>
                                <?php $nomor = 0; foreach($supplier as $row): ?>
                                <option value="<?= $row['id_supplier'] ?>"><?= $row['nama'] ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback error_kategori">

                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer bg-whitesmoke">
                <button type="submit" class="btn btn-primary btnsimpanbarang">
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
        $('.formbarang').submit(function (e) {
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
                    $('.btnsimpanbarang').html('Simpan');
                },
                success: function (response) {
                    if (response.error) {
                        if (response.error.id_barang) {
                            $('#id_barang').addClass('is-invalid');
                            $('.error_id_barang').html(response.error.id_barang);
                        } else {
                            $('#id_barang').removeClass('is-invalid');
                            $('.error_id_barang').html('');
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
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.sukses,
                        })

                        $('#modaltambahbarang').modal('hide');
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