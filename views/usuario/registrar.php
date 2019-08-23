<link rel="stylesheet" href="<?= baseUrl; ?>assets/css/styleAll.css">
<title>CusineSoft - Usuarios</title>
</head>

<body class="animated fadeIn faster">
  <!-- ------------ Header ------------ -->
  <?php require_once 'views/layout/banner.php'; ?>
  <!-- ------------- Nav ------------- -->
  <?php require_once 'views/layout/menu.php'; ?>
  
  <div class="container p-3">
    <?php if (isset($editar) && isset($user) && is_object($user)) : ?>
    <span class="titulo">Editar Usuario = <?= $user->nombre; ?></span>
    <?php $url_action = baseUrl . 'usuario/registrar&id=' . $user->idusuarios; ?>
    <?php else : ?>
    <span class="titulo">Registro de Usuarios</span>
    <?php $url_action = baseUrl . 'usuario/registrar'; ?>
    <?php endif; ?>
    <?php if (isset($_SESSION['notData']) && $_SESSION['notData'] == 'ErrorDatos') : ?>
    <div class="alert alert-danger p-1 text-center animated zoomIn faster" role="alert">
      Existen Campos Vacios
    </div>
    <?php else : ?>
    <hr>
    <?php endif; ?>
    <?php Utils::deleteSession('notData') ?>
    <form action="<?= $url_action; ?>" method="POST" class="pb-3" id="miFormulario">
      <div class="row">
        <div class="col-6">
          <span>Seleccionar Cargo</span><br>
          <div class="btn-group btn-group-toggle py-1" data-toggle="buttons">
            <label class="btn btn-outline-secondary">
              <input type="radio" name="rol" value="1"> Administrador
            </label>
            <label class="btn btn-outline-secondary">
              <input type="radio" name="rol" value="2"> Jefe de Cocina
            </label>
            <label class="btn btn-outline-secondary">
              <input type="radio" name="rol" value="3"> Jefe de Zona
            </label>
          </div>
        </div>
        <div class="col-6">
          <span class="">Seleccionar Restaurante <i class="fas fa-utensils"></i></span><br>
          <?php $restaurants = RestauranteController::getAll(); ?>
          <select class="custom-select my-1 mr-sm-2" name="restaurante" id="restaurante">
            <option>Eliga...</option>
            <?php while ($rest = $restaurants->fetch_object()) : ?>
            <option <?= isset($user) && is_object($user) && (int) $user->restaurante_idrestaurante == (int) $rest->idrestaurante ? 'selected' : ''; ?> value="<?= $rest->idrestaurante; ?>"><?= $rest->nombreRestaurante; ?></option>
            <?php endwhile; ?>
          </select>
        </div>
        <div class="form-label-group col-6 py-2">
          <label for="nombres">Nombres</label>
          <input type="text" id="nombres" name="nombres" class="form-control" value="<?= isset($user) && is_object($user) ? $user->nombre : ''; ?>" placeholder="Nombres">
        </div>
        <hr>
        <div class="form-label-group col-6 py-2">
          <label for="apellidos">Apellidos</label>
          <input type="text" id="apellidos" name="apellidos" class="form-control" value="<?= isset($user) && is_object($user) ? $user->apellido : ''; ?>" placeholder="Apellidos">
        </div>
        <div class="form-label-group col-6 py-2">
          <label for="email">Email</label>
          <input type="email" id="email" name="email" class="form-control" value="<?= isset($user) && is_object($user) ? $user->email : ''; ?>" placeholder="example@ex.com">
        </div>
        <div class="form-label-group col-6 py-2">
          <label for="pass">Contraseña</label>
          <input type="<?= isset($user) && is_object($user) ? 'text' : 'password'; ?>" id="pass" name="pass" class="form-control" value="<?= isset($user) && is_object($user) ? $user->contrasena : ''; ?>" placeholder="Contraseña">
        </div>
        <div class="col-12 py-2">
          <input type="submit" class="btn btn-outline-primary btn-block" id="enviar" value="<?= isset($user) && is_object($user) ? 'Actualizar' : 'Registrar'; ?>">
        </div>
      </div>
    </form>
  </div>
  <!-- ------------- Footer ------------- -->
  <?php require_once 'views/layout/footer2.php'; ?>
  <script src="<?= baseUrl; ?>assets/js/validacionUsuario.js"></script>
</body>