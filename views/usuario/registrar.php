</head>

<body class="animated fadeIn faster">
  <!-- ------------ Header ------------ -->
  <?php require_once 'views/layout/banner.php'; ?>
  <!-- ------------- Nav ------------- -->
  <?php require_once 'views/layout/menu.php'; ?>
  <?php require_once 'controllers/cargoController.php'; ?>
  <?php require_once 'controllers/restauranteController.php'; ?>

  <div class="container p-3">
    <?php if (isset($editar) && isset($user) && is_object($user)) : ?>
      <span class="titulo"><?= tittleRegisUsuario2; ?> = <?= $user->nombre; ?></span>
      <?php $url_action = baseUrl . 'usuario/registrar&id=' . $user->idusuarios; ?>
    <?php else : ?>
      <span class="titulo"><?= tittleRegisUsuario1; ?></span>
      <?php $url_action = baseUrl . 'usuario/registrar'; ?>
    <?php endif; ?>
    <!--  -->
    <?php if (isset($_SESSION['saveEdit']) && $_SESSION['saveEdit'] == 'Vacios') : ?>
      <?= Utils::alerta('danger', vacios) ?>
    <?php elseif (isset($_SESSION['saveEdit']) && $_SESSION['saveEdit'] == 'Existe') : ?>
      <div class="alert alert-secondary p-1 text-center animated zoomIn faster" role="alert">
        <?= existUser ?> <i class="fas fa-user-slash"></i> <a href="<?= baseUrl ?>usuario/consultarUsuarios" class="btn btn-outline-dark btn-sm"><?= consultUsuarios ?></a>
      </div>
    <?php else : ?>
      <hr>
    <?php endif; ?>
    <?php Utils::deleteSession('saveEdit') ?>
    <form action="<?= $url_action; ?>" method="POST" class="pb-3" id="miFormulario">
      <div class="row">
        <div class="col-6">
          <span class=""><?= selectCargo; ?> <i class="fas fa-user-tag"></i></span><br>
          <?php $c = CargoController::getAll(); ?>
          <select class="custom-select my-1 mr-sm-2" name="rol" id="rol">
            <option><?= elija ?></option>
            <?php while ($car = $c->fetch_object()) : ?>
              <option <?= isset($user) && is_object($user) && (int) $user->idcargo == (int) $car->idcargo ? 'selected' : ''; ?> value="<?= $car->idcargo; ?>"><?= $car->nombreCargo; ?></option>
            <?php endwhile; ?>
          </select>
        </div>
        <div class="col-6">
          <span class=""><?= selectRestaurante; ?> <i class="fas fa-utensils"></i></span><br>
          <?php $restaurants = RestauranteController::getAll(); ?>
          <select class="custom-select my-1 mr-sm-2" name="restaurante" id="restaurante">
            <option><?= elija ?></option>
            <?php while ($rest = $restaurants->fetch_object()) : ?>
              <option <?= isset($user) && is_object($user) && (int) $user->idrestaurante == (int) $rest->idrestaurante ? 'selected' : ''; ?> value="<?= $rest->idrestaurante; ?>"><?= $rest->nombreRestaurante; ?></option>
            <?php endwhile; ?>
          </select>
        </div>
        <div class="form-label-group col-6 py-2">
          <label for="nombres"><?= nombreUsuario; ?></label>
          <input type="text" id="nombres" name="nombres" class="form-control" value="<?= isset($user) && is_object($user) ? $user->nombre : ''; ?>">
        </div>
        <hr>
        <div class="form-label-group col-6 py-2">
          <label for="apellidos"><?= apellidoUsuario; ?></label>
          <input type="text" id="apellidos" name="apellidos" class="form-control" value="<?= isset($user) && is_object($user) ? $user->apellido : ''; ?>">
        </div>
        <div class="form-label-group col-6 py-2">
          <label for="email"><?= emailUsuario; ?></label>
          <input type="email" id="email" name="email" class="form-control" value="<?= isset($user) && is_object($user) ? $user->email : ''; ?>">
        </div>
        <div class="form-label-group col-6 py-2">
          <label for="pass"><?= passUsuario; ?></label>
          <input type="<?= isset($user) && is_object($user) ? 'text' : 'password'; ?>" id="pass" name="pass" class="form-control" value="<?= isset($user) && is_object($user) ? $user->contrasena : ''; ?>">
        </div>
        <div class="col-6 offset-3 py-2">
          <input type="submit" class="btn btn-outline-primary btn-block" id="enviar" value="<?= isset($user) && is_object($user) ? actualizar : registrar; ?>">
        </div>
      </div>
    </form>
  </div>
  <!-- ------------- Footer ------------- -->
  <?php require_once 'views/layout/footer2.php'; ?>
  <script src="<?= baseUrl; ?>assets/js/validacionUsuario.js"></script>
</body>
