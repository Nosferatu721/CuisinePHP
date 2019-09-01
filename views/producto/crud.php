<link rel="stylesheet" type="text/css" href="<?= baseUrl; ?>assets/datatables/datatables.min.css" />
<link rel="stylesheet" href="<?= baseUrl; ?>assets/css/styleAll.css">
<title>CusineSoft - Producto</title>
</head>

<body class="animated fadeIn faster">
  <!-- ------------ Header ------------ -->
  <?php require_once 'views/layout/banner.php'; ?>
  <!-- ------------- Nav ------------- -->
  <?php require_once 'views/layout/menu.php'; ?>

  <div class="container">
    <p class="titulo">Control de Productos</p>
    <?php if (isset($_SESSION['saveEdit']) && $_SESSION['saveEdit'] == 'Registrado') : ?>
      <div class="alert alert-secondary text-success p-1 text-center animated zoomIn faster" role="alert">
        <b>Producto Registrado Exitosamente <i class="fas fa-check-double"></i></b>
      </div>
    <?php elseif (isset($_SESSION['saveEdit']) && $_SESSION['saveEdit'] == 'Editado') : ?>
      <div class="alert alert-secondary text-primary p-1 text-center animated zoomIn faster" role="alert">
        <b>Producto Editado Exitosamente <i class="fas fa-check-double"></i></b>
      </div>
    <?php elseif (isset($_SESSION['delete']) && $_SESSION['delete'] == 'Eliminado') : ?>
      <div class="alert alert-secondary text-danger p-1 text-center animated zoomIn faster" role="alert">
        <b>Producto Eliminado Exitosamente <i class="fas fa-check-double"></i></b>
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
            <?php if (isset($editar) && isset($proEdit) && is_object($proEdit)) : ?>
              <span class="titulo text-warning animated flash slower">Editar Producto = <?= $proEdit->nombreProducto; ?></span>
              <?php $url_action = baseUrl . 'producto/registrar&id=' . $proEdit->idproducto; ?>
            <?php else : ?>
              <span class="titulo text-success">Nuevo Producto</span>
              <?php $url_action = baseUrl . 'producto/registrar'; ?>
            <?php endif; ?>
          </div>
          <form action="<?= $url_action; ?>" method="POST">
            <div class="form-label-group p-2">
              <label for="nombre">Nombre</label>
              <input type="text" id="nombre" name="nombre" class="form-control" value="<?= isset($proEdit) && is_object($proEdit) ? $proEdit->nombreProducto : ''; ?>" placeholder="Nombre">
            </div>
            <div class="p-2 border-top">
              <input type="submit" class="btn btn-outline-success btn-block" id="enviar" value="<?= isset($proEdit) && is_object($proEdit) ? 'Actualizar' : 'Registrar'; ?>">
            </div>
          </form>
        </div>
      </div>
      <div class="col-md-8">
        <table class="table table-bordered table-hover" id="tablaUsuarios">
          <caption class="text-center">Lista de Productos</caption>
          <thead class="table-dark">
            <tr class="font-italic">
              <th scope="col">ID</th>
              <th scope="col">Nombre</th>
              <th scope="col">Acciones</th>
            </tr>
          </thead>
          <tbody>
            <?php $p = ProductoController::getAll(); ?>
            <?php while ($pro = $p->fetch_object()) : ?>
              <tr>
                <th scope="row"><?= $pro->idproducto; ?></th>
                <td><?= $pro->nombreProducto; ?></td>
                <td class="d-flex justify-content-around border border-light">
                  <a href="<?= baseUrl; ?>producto/editar&id=<?= $pro->idproducto; ?>" class="btn btn-outline-warning btn-sm"><i class="fas fa-pen-nib"></i> Editar</a>
                  <a href="<?= baseUrl; ?>producto/eliminar&id=<?= $pro->idproducto; ?>" class="btn btn-outline-danger btn-sm"><i class="far fa-trash-alt"></i> Eliminar</a>
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