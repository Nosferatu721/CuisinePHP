<h4 class="nameUser"><?= $_SESSION['identity']->nombre ?> <?= $_SESSION['identity']->apellido ?> - <?= $_SESSION['identity']->nombreCargo ?></h4>
<header class="main-header">
  <div class="containersito container--flex">
    <div class="logo-container column--50">
      <h1 class="logo">CuisineSoft</h1>
    </div>
    <div class="main-header__contactInfo column column--50">
      <p class="main-header__contactInfo__phone">
        <i class="fas fa-phone"></i> 2307045
      </p>
      <p class="main-header__contactInfo__address">
        <i class="fas fa-map-marked-alt"></i> <?= $_SESSION['identity']->nombreRestaurante ?> - <?= $_SESSION['identity']->direccionRestaurante ?>
      </p>
    </div>
  </div>
</header>
<!-------------Banner------------->
<section class="banner">
  <img src="<?= baseUrl; ?>assets/img/Pantheon.jpg" alt="" class="banner__img">
  <div class="banner__content">El sistema encargado de tu restaurante</div>
</section>