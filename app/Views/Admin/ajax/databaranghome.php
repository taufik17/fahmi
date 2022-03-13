<table class="table table-striped" id="table-manajemen-jabatan">
    <thead>
        <tr>
            <th class="text-center">No</th>
            <th>ID Barang</th>
            <th>Kategori</th>
            <th>Nama Barang</th>
            <th>Harga</th>
            <th>Stok</th>
            <th>Suplier</th>
        </tr>
    </thead>
    <tbody>
    <?php 
        $nomor = 0; 
        foreach($semua_barang as $row): 							
            $nomor++;
            ?>
        <tr>
            <td class="text-center"><?= $nomor; ?></td>
            <td><?= $row['id_barang'] ?></td>
            <td><?= $row['kategori'] ?></td>
            <td><?= $row['nama_barang'] ?></td>
            <td><?= $row['harga'] ?></td>
            <td><?= $row['stok'] ?></td>
            <td><?= $row['supplier'] ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<script src="<?= base_url() ?>/assets_admin/js/page/modules-datatables.js"></script>
<script>
    function edit(id_barang) {
        $.ajax({
            type: "post",
            url: "<?= site_url('admin/barang/editbarang') ?>",
            data: {
                id_barang: id_barang
            },
            dataType: "json",
            beforeSend: function () {
                $('.btnedit' + id_barang).attr('disable', 'disabled');
                $('.btnedit' + id_barang).html('<i class="fas fa-spin fa-spinner"></i>');
            },
            complete: function () {
                $('.btnedit' + id_barang).removeAttr('disable');
                $('.btnedit' + id_barang).html(' <i class="fas fa-edit"></i>');
            },
            success: function (response) {
                if (response.sukses) {
                    $('.viewmodaltambahbarang').html(response.sukses).show();
                    $('#modaleditbarang').modal('show');
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    }

    function hapus(id_barang, nama_barang) {
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success m-1',
                cancelButton: 'btn btn-danger m-1'
            },
            buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
            title: 'Hapus',
            text: `Yakin Menghapus data "${nama_barang}" ?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya',
            cancelButtonText: 'Batal',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "post",
                    url: "<?= site_url('admin/barang/hapusbarang') ?>",
                    data: {
                        id_barang: id_barang,
                        nama_barang: nama_barang
                    },
                    dataType: "json",
                    success: function (response) {
                        if (response.sukses) {
                            swalWithBootstrapButtons.fire(
                                'Dihapus',
                                response.sukses,
                                'success'
                            );
                            databarang();
                        }
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                    }
                });

            } else if (
                /* Read more about handling dismissals below */
                result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire(
                    'Dibatalkan',
                    `"${nama_barang}" batal dihapus`,
                    'error'
                )
            }
        })
    }

</script>