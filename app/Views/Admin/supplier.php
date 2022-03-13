<?= $this->extend('template/template'); ?>
<?= $this->section('content'); ?>
<!-- Main Content -->
<div class="main-content">
	<section class="section">
		<div class="section-header">
			<h1>Manajemen Supplier</h1>
		</div>

		<div class="section-body">
			<div class="row">
				<div class="col-12">
					<div class="card">
						<!-- <div class="card-header">
							<h4>Barang Temuan</h4>
						</div> -->
						<div class="card-body">

							<div class="card-title">
								<button type="button" class="btn btn-primary btn-sm tomboltambahsupplier"
									style="margin-bottom: 20px">
									<i class="fas fa-plus-circle"></i> Tambah Data
								</button>

							</div>

							<div class="table-responsive viewdata">
							<p class="loaddata"></p>

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>

<div class="viewmodaltambahsupplier" style="display: none"></div>
<script>
	function datasupplier() {
		$.ajax({
			url: "<?= site_url('admin/supplier/ambildatasupplier') ?>",
			dataType: "json",
            beforeSend: function () {
                $('.loaddata').html('Load Data <i class="fas fa-spin fa-spinner"></i>');
            },
			success: function (response) {
				$('.viewdata').html(response.data);
			},
			error: function (xhr, ajaxOptions, thrownError) {
				alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
			}
		});
	}

	$(document).ready(function () {
		datasupplier();
		$('.tomboltambahsupplier').click(function (e) {
			e.preventDefault();
			$.ajax({
				url: "<?= site_url('admin/supplier/formtambah') ?>",
				dataType: "json",
				beforeSend: function () {
					$('.tomboltambahsupplier').attr('disable', 'disabled');
					$('.tomboltambahsupplier').html(
						'<i class="fas fa-spin fa-spinner"></i> Tambah Data');
				},
				complete: function () {
					$('.tomboltambahsupplier').removeAttr('disable');
					$('.tomboltambahsupplier').html(
						'<i class="fas fa-plus-circle"></i> Tambah Data');
				},
				success: function (response) {
					$('.viewmodaltambahsupplier').html(response.data).show();
					$('#modaltambahsupplier').modal('show');
				},
				error: function (xhr, ajaxOptions, thrownError) {
					alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
				}
			});
		})
	});
</script>

<?= $this->endSection(); ?>
