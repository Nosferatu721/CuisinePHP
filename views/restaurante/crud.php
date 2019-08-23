<link rel="stylesheet" type="text/css" href="<?= baseUrl; ?>assets/datatables/datatables.min.css" />
<link rel="stylesheet" href="<?= baseUrl; ?>assets/css/styleAll.css">
<title>CusineSoft - Restaurante</title>
</head>

<body class="animated fadeIn faster">
  <!-- ------------ Header ------------ -->
  <?php require_once 'views/layout/banner.php'; ?>
  <!-- ------------- Nav ------------- -->
  <?php require_once 'views/layout/menu.php'; ?>

  <div class="container">
    <p class="titulo">Control de Restaurantes</p>
    <?php if (isset($_SESSION['saveEdit']) && $_SESSION['saveEdit'] == 'Registrado') : ?>
    <div class="alert alert-dark text-success p-1 text-center animated zoomIn faster" role="alert">
      <b>Restaurante Registrado Exitosamente <i class="fas fa-check-double"></i></b>
    </div>
    <?php elseif (isset($_SESSION['saveEdit']) && $_SESSION['saveEdit'] == 'Editado') : ?>
    <div class="alert alert-dark text-info p-1 text-center animated zoomIn faster" role="alert">
      <b>Restaurante Editado Exitosamente <i class="fas fa-check-double"></i></b>
    </div>
    <?php elseif (isset($_SESSION['delete']) && $_SESSION['delete'] == 'Eliminado') : ?>
    <div class="alert alert-dark text-danger p-1 text-center animated zoomIn faster" role="alert">
      <b>Restaurante Eliminado Exitosamente <i class="fas fa-check-double"></i></b>
    </div>
    <?php elseif (isset($_SESSION['delete']) && $_SESSION['delete'] == 'NoQuery') : ?>
    <div class="alert alert-dark text-danger p-1 text-center animated zoomIn faster" role="alert">
      <b>No Se Puede Eliminar <i class="fas fa-exclamation-triangle"></i></b>
    </div>
    <?php elseif (isset($_SESSION['notData']) && $_SESSION['notData'] == 'ErrorDatos') : ?>
    <div class="alert alert-danger p-1 text-center animated zoomIn faster" role="alert">
      Existen Campos Vacios
    </div>
    <?php else : ?>
    <hr>
    <?php endif; ?>
    <?php Utils::deleteSession('saveEdit') ?>
    <?php Utils::deleteSession('delete') ?>
    <?php Utils::deleteSession('notData') ?>
    <div class="row my-2">
      <div class="col-md-4 d-flex justify-content-center">
        <div class="card mb-3 border-0">
          <div class="card-header font-italic text-center bg-dark text-danger">
            <?php if (isset($editar) && isset($restEdit) && is_object($restEdit)) : ?>
            <span class="titulo text-warning animated flash slower">Editar Restaurante = <?= $restEdit->nombreRestaurante; ?></span>
            <?php $url_action = baseUrl . 'restaurante/registrar&id=' . $restEdit->idrestaurante; ?>
            <?php else : ?>
            <span class="titulo text-success">Nuevo Restaurante</span>
            <?php $url_action = baseUrl . 'restaurante/registrar'; ?>
            <?php endif; ?>
          </div>
          <form action="<?= $url_action; ?>" method="POST">
            <div class="form-label-group p-2">
              <label for="nombre">Nombre</label>
              <input type="text" id="nombre" name="nombre" class="form-control" value="<?= isset($restEdit) && is_object($restEdit) ? $restEdit->nombreRestaurante : ''; ?>" placeholder="Nombre">
            </div>
            <div class="form-label-group p-2">
              <label for="direccion">Direccion</label>
              <input type="text" id="direccion" name="direccion" class="form-control" value="<?= isset($restEdit) && is_object($restEdit) ? $restEdit->direccionRestaurante : ''; ?>" placeholder="Direccion">
            </div>
            <div class="p-2 border-top">
              <input type="submit" class="btn btn-outline-success btn-block" id="enviar" value="<?= isset($restEdit) && is_object($restEdit) ? 'Actualizar' : 'Registrar'; ?>">
            </div>
          </form>
        </div>
      </div>
      <div class="col-md-8">
        <table class="table table-bordered table-responsive-xl table-hover" id="tablaUsuarios">
          <caption class="text-center">Lista de Restaurantes</caption>
          <thead class="table-danger">
            <tr class="font-italic">
              <th scope="col">ID</th>
              <th scope="col">Nombre</th>
              <th scope="col">Dirección</th>
              <th scope="col">Acciones</th>
            </tr>
          </thead>
          <tbody>
            <?php $restaurants = RestauranteController::getAll(); ?>
            <?php while ($rest = $restaurants->fetch_object()) : ?>
            <tr>
              <th scope="row"><?= $rest->idrestaurante; ?></th>
              <td><?= $rest->nombreRestaurante; ?></td>
              <td><?= $rest->direccionRestaurante; ?></td>
              <td class="d-flex justify-content-around border border-light">
                <a href="<?= baseUrl; ?>restaurante/editar&id=<?= $rest->idrestaurante; ?>" class="btn btn-outline-warning btn-sm"><i class="fas fa-pen-nib"></i> Editar</a>
                <a href="<?= baseUrl; ?>restaurante/eliminar&id=<?= $rest->idrestaurante; ?>" class="btn btn-outline-danger btn-sm"><i class="far fa-trash-alt"></i> Eliminar</a>
              </td>
            </tr>
            <?php endwhile; ?>
          </tbody>
        </table>
      </div>
    </div>

  </div>

  <!-- ------------- Footer ------------- -->
  <?php require_once 'views/layout/footer2.php'; ?>

  <script type="text/javascript" src="<?= baseUrl; ?>assets/js/tablas.js"></script>
  <script src="<?= baseUrl; ?>assets/js/validacionRestaurante.js"></script>

</body>

</html>