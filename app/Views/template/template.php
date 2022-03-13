<?= $this->include('template/assethead'); ?>

<body>
  <div id="app">
    <div class="main-wrapper">
      <div class="navbar-bg"></div>
      <?= $this->include('template/header'); ?>
			<?= $this->include('template/menu'); ?>
			<?= $this->renderSection('content'); ?>
			<?= $this->include('template/footer'); ?>
    </div>
  </div>
<?= $this->include('template/assetfoot'); ?>
