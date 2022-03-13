<table class="table table-striped" id="table-manajemen-supplier">
    <thead>
        <tr>
            <th class="text-center">No</th>
            <th>ID Supplier</th>
            <th>Nama</th>
            <th>Alamat</th>
            <th>Kota</th>
            <th>Telepon</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
    <?php 
        $nomor = 0; 
        foreach($semua_supplier as $row): 							
            $nomor++;
            ?>
        <tr>
            <td class="text-center"><?= $nomor; ?></td>
            <td><?= $row['id_supplier'] ?></td>
            <td><?= $row['nama'] ?></td>
            <td><?= $row['alamat'] ?></td>
            <td><?= $row['kota'] ?></td>
            <td><?= $row['telepon'] ?></td>
            <td>
                <button type="button" class="btn btn-warning btn-sm btnedit<?= $row['id_supplier'] ?>"
                    onclick="edit('<?= $row['id_supplier'] ?>')">
                    <i class="fas fa-edit"></i>
                </button>
                <button type="button" class="btn btn-danger btn-sm"
                    onclick="hapus('<?= $row['id_supplier'] ?>', '<?= $row['nama']; ?>')">
                    <i class="fas fa-trash"></i>
                </button>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<script src="<?= base_url() ?>/assets_admin/js/page/modules-datatables.js"></script>
<script>
    function edit(id_supplier) {
        $.ajax({
            type: "post",
            url: "<?= site_url('admin/supplier/editsupplier') ?>",
            data: {
                id_supplier: id_supplier
            },
            dataType: "json",
            beforeSend: function () {
                $('.btnedit' + id_supplier).attr('disable', 'disabled');
                $('.btnedit' + id_supplier).html('<i class="fas fa-spin fa-spinner"></i>');
            },
            complete: function () {
                $('.btnedit' + id_supplier).removeAttr('disable');
                $('.btnedit' + id_supplier).html(' <i class="fas fa-edit"></i>');
            },
            success: function (response) {
                if (response.sukses) {
                    $('.viewmodaltambahsupplier').html(response.sukses).show();
                    $('#modaleditsupplier').modal('show');
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    }

    function hapus(id_supplier, nama) {
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success m-1',
                cancelButton: 'btn btn-danger m-1'
            },
            buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
            title: 'Hapus',
            text: `Yakin Menghapus data "${nama}" ?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya',
            cancelButtonText: 'Batal',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "post",
                    url: "<?= site_url('admin/supplier/hapussupplier') ?>",
                    data: {
                        id_supplier: id_supplier,
                        nama: nama
                    },
                    dataType: "json",
                    success: function (response) {
                        if (response.sukses) {
                            swalWithBootstrapButtons.fire(
                                'Dihapus',
                                response.sukses,
                                'success'
                            );
                            datasupplier();
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
                    `"${nama}" batal dihapus`,
                    'error'
                )
            }
        })
    }

</script>