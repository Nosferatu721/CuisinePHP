</head>

<body class="animated fadeIn faster">
  <!-- ------------ Header ------------ -->
  <?php require_once 'views/layout/banner.php'; ?>
  <!-- ------------- Nav ------------- -->
  <?php require_once 'views/layout/menu.php'; ?>

  <div class="container">
    <p class="titulo">Control de Tipos de Merma</p>
    <?php if (isset($_SESSION['saveEdit']) && $_SESSION['saveEdit'] == 'Registrado') : ?>
      <div class="alert alert-secondary text-success p-1 text-center animated zoomIn faster" role="alert">
        <b>Tipo de Merma Registrado Exitosamente <i class="fas fa-check-double"></i></b>
      </div>
    <?php elseif (isset($_SESSION['saveEdit']) && $_SESSION['saveEdit'] == 'Editado') : ?>
      <div class="alert alert-secondary text-info p-1 text-center animated zoomIn faster" role="alert">
        <b>Tipo de Merma Editado Exitosamente <i class="fas fa-check-double"></i></b>
      </div>
    <?php elseif (isset($_SESSION['delete']) && $_SESSION['delete'] == 'Eliminado') : ?>
      <div class="alert alert-secondary text-danger p-1 text-center animated zoomIn faster" role="alert">
        <b>Tipo de Merma Eliminado Exitosamente <i class="fas fa-check-double"></i></b>
      </div>
    <?php elseif (isset($_SESSION['delete']) && $_SESSION['delete'] == 'NoQuery') : ?>
      <div class="alert alert-secondary text-danger p-1 text-center animated zoomIn faster" role="alert">
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
          <div class="card-header font-italic text-center bg-secondary text-danger">
            <?php if (isset($editar) && isset($tipoEdit) && is_object($tipoEdit)) : ?>
              <span class="titulo text-warning animated flash slower">Editar Tipo = <?= $tipoEdit->tipoMerma; ?></span>
              <?php $url_action = baseUrl . 'tipoMerma/registrar&id=' . $tipoEdit->idtipoMerma; ?>
            <?php else : ?>
              <span class="titulo text-success">Nuevo Tipo de Merma</span>
              <?php $url_action = baseUrl . 'tipoMerma/registrar'; ?>
            <?php endif; ?>
          </div>
          <form action="<?= $url_action; ?>" method="POST">
            <div class="form-label-group p-2">
              <label for="nombre">Nombre Tipo</label>
              <input type="text" id="nombre" name="nombre" class="form-control" placeholder="<?= isset($tipoEdit) && is_object($tipoEdit) ? $tipoEdit->tipoMerma : 'Nombre'; ?>">
            </div>
            <div class="p-2 border-top">
              <input type="submit" class="btn btn-outline-success btn-block" id="enviar" value="<?= isset($tipoEdit) && is_object($tipoEdit) ? 'Actualizar' : 'Registrar'; ?>">
            </div>
          </form>
        </div>
      </div>
      <div class="col-md-8">
        <table class="table table-bordered table-responsive-sm table-hover" id="tablaUsuarios">
          <caption class="text-center">Lista de Tipos</caption>
          <thead class="table-dark">
            <tr class="font-italic">
              <th scope="col">ID</th>
              <th scope="col">Nombre</th>
              <th scope="col">Acciones</th>
            </tr>
          </thead>
          <tbody>
            <?php $tipos = TipoMermaController::getAll(); ?>
            <?php while ($tpo = $tipos->fetch_object()) : ?>
              <tr>
                <th scope="row"><?= $tpo->idtipoMerma; ?></th>
                <td><?= $tpo->tipoMerma; ?></td>
                <td class="d-flex justify-content-around border border-light">
                  <a href="<?= baseUrl; ?>tipoMerma/editar&id=<?= $tpo->idtipoMerma; ?>" class="btn btn-outline-warning btn-sm"><i class="fas fa-pen-nib"></i> Editar</a>
                  <a href="<?= baseUrl; ?>tipoMerma/eliminar&id=<?= $tpo->idtipoMerma; ?>" class="btn btn-outline-danger btn-sm"><i class="far fa-trash-alt"></i> Eliminar</a>
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

  <script src="<?= baseUrl; ?>assets/js/validacionRestaurante.js"></script>

</body>

</html>