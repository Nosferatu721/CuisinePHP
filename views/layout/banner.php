<div class="nameUser">
  <div class="dropdown">
    <button class="btn btn-outline-light btn-sm dropdown-toggle" type="button" id="dropDownBtns" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <?= $_SESSION['identity']->nombre ?> <?= $_SESSION['identity']->apellido ?> - <?= $_SESSION['identity']->nombreCargo == 'Administrador' ? admin : ($_SESSION['identity']->nombreCargo == 'Jefe de Cocina' ? jefeCocina : ($_SESSION['identity']->nombreCargo == 'Jefe de Zona' ? jefeZona : '')); ?>
    </button>
    <div class="dropdown-menu" aria-labelledby="dropDownBtns">
      <!-- Boton Llama Modal -->
      <button class="dropdown-item animated fadeInRight faster py-0 my-0" type="button" data-toggle="modal" data-target="#modalsito">Cambiar Contraseña</button>
      <div class="dropdown-divider bg-dark" style="border-bottom: 0.5px dotted orange"></div>
      <a class="dropdown-item animated fadeInUp faster py-0 my-0" role="button" href="<?= baseUrl; ?>usuario/logout"><i class="fas fa-door-open"></i> <?= salir ?></a>
    </div>
  </div>
</div>

<!-- -/- -->

<!-- Modal -->
<div class="modal fade" id="modalsito" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header py-2">
        <h5 class="modal-title py-0" id="ModalLabel">Cambiar Contraseña</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body py-2">
        <form action="<?= baseUrl ?>usuario/updatePass" method="POST">
          <div class="form-label-group">
            <label for="newPass" class="my-1">Contraseña Nueva</label>
            <input type="text" id="newPass" name="newPass" class="form-control">
          </div>
          <div class="form-label-group">
            <label for="newPassC" class="my-1">Confirmar Contraseña Nueva</label>
            <input type="text" id="newPassC" name="newPassC" class="form-control">
          </div>
          <hr>
          <button type="submit" class="btn btn-outline-success btn-block" id="cambiarPass">Cambiar <i class="fas fa-pen-nib"></i></button>
        </form>
      </div>
      <div class="modal-footer py-2">
        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal"><?= cancelar ?></button>
      </div>
    </div>
  </div>
</div>
<!-- Fin Modal -->

<!-- -/- -->

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