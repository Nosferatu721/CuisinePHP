<?php if (isset($_SESSION['identity'])) : ?>
<?php if (isset($_SESSION['Admin'])) : ?>
<h4 class="nameUser"><?= $_SESSION['identity']->nombre ?> <?= $_SESSION['identity']->apellido ?> - Administrador</h4>
<?php elseif (isset($_SESSION['JefeCocina'])) : ?>
<h4 class="nameUser"><?= $_SESSION['identity']->nombre ?> <?= $_SESSION['identity']->apellido ?> - Jefe de Cocina</h4>
<?php elseif (isset($_SESSION['JefeZona'])) : ?>
<h4 class="nameUser"><?= $_SESSION['identity']->nombre ?> <?= $_SESSION['identity']->apellido ?> - Jefe de Zona</h4>
<?php endif; ?>
<?php else : ?>
<?php header('Location: ' . baseUrl); ?>
<?php endif; ?>
<header class="main-header">
  <div class="containersito container--flex">
    <div class="logo-container column--50">
      <h1 class="logo">CuisineSoft</h1>
    </div>
    <div class="main-header__contactInfo column column--50">
      <p class="main-header__contactInfo__phone">
        <span class="icon-phone">333-333-333</span>
      </p>
      <p class="main-header__contactInfo__address">
        <span class="icon-location">Calle 82 No 12-21 Zona Rosa</span>
      </p>
    </div>
  </div>
</header>
<!-------------Banner------------->
<section class="banner">
  <img src="<?= baseUrl; ?>assets/img/JaxDivino.jpg" alt="" class="banner__img">
  <div class="banner__content">El sistema encargado de tu restaurante</div>
</section>