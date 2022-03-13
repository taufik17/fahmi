<div class="main-sidebar">
	<aside id="sidebar-wrapper">
		<div class="sidebar-brand">
			<a href="<?= base_url() ?>">
				UJIKOM
			</a>
		</div>
		<div class="sidebar-brand sidebar-brand-sm">
			<a href="<?= base_url() ?>/admin/barang">
				UJIKOM
			</a>
		</div>
		<ul class="sidebar-menu">
				<li class="menu-header">Dashboard</li>
				<li <?= $segment == 'home' ? 'class="active"' : ''?>><a class="nav-link" href="<?= base_url() ?>/admin/home"><i class="fas fa-home"></i> <span>Home</span></a></li>
				<li <?= $segment == 'barang' ? 'class="active"' : ''?>><a class="nav-link" href="<?= base_url() ?>/admin/barang"><i class="fas fa-box-open"></i> <span>Barang</span></a></li>
				<li <?= $segment == 'supplier' ? 'class="active"' : ''?>><a class="nav-link" href="<?= base_url() ?>/admin/supplier"><i class="fas fa-truck"></i> <span>Supplier</span></a></li>

			</ul>
	</aside>
</div>
