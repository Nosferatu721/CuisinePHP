<link rel="stylesheet" type="text/css" href="<?= baseUrl; ?>assets/datatables/datatables.min.css" />
<link rel="stylesheet" href="<?= baseUrl; ?>assets/css/styleAll.css">
<title>CusineSoft - Usuarios</title>
</head>

<body class="animated fadeIn faster">
  <!-- ------------ Header ------------ -->
  <?php require_once 'views/layout/banner.php'; ?>
  <!-- ------------- Nav ------------- -->
  <?php require_once 'views/layout/menu.php'; ?>

  <div class="container">
    <p class="titulo">Detalle Productos</p>
    <?php if (isset($_SESSION['saveEdit']) && $_SESSION['saveEdit'] == 'Registrado') : ?>
      <div class="alert alert-secondary text-success p-1 text-center animated zoomIn faster" role="alert">
        <b>Productos Registrado Exitosamente <i class="fas fa-check-double"></i></b>
      </div>
    <?php elseif (isset($_SESSION['saveEdit']) && $_SESSION['saveEdit'] == 'Editado') : ?>
      <div class="alert alert-secondary text-primary p-1 text-center animated zoomIn faster" role="alert">
        <b>Productos Editado Exitosamente <i class="fas fa-check-double"></i></b>
      </div>
    <?php elseif (isset($_SESSION['delete']) && $_SESSION['delete'] == 'Eliminado') : ?>
      <div class="alert alert-secondary text-success p-1 text-center animated zoomIn faster" role="alert">
        <b>Productos Cambiado Exitosamente <i class="fas fa-check-double"></i></b>
      </div>
    <?php else : ?>
      <hr>
    <?php endif; ?>
    <?php Utils::deleteSession('saveEdit') ?>
    <?php Utils::deleteSession('delete') ?>
    <a href="<?= baseUrl; ?>stock/registro" class="btn btn-outline-success"><i class="fas fa-user-plus"></i> Registrar Nevo Stock Al Restaurante</a>
    <div class="mt-3 p-2">
      <table class="table table-bordered table-responsive-md table-hover" id="tablaUsuarios">
        <caption class="text-center py-1">Lista de Productos Detallada <a href="<?= baseUrl; ?>librerias/pdf/usuarios/pdfUsuarios" target="blank" class="btn btn-danger">Generar PDF <i class="fas fa-file-pdf"></i></a></caption>
        <thead class="table-dark">
          <tr class="font-italic">
            <th scope="col">Producto</th>
            <th scope="col">Cantidad</th>
            <th scope="col">Fecha Vencimiento</th>
            <th scope="col">Lote</th>
            <th scope="col">Acciones</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($s = $sto->fetch_object()) : ?>
            <tr>
              <td><?= $s->nombreProducto; ?></td>
              <td><?= $s->cantidadProducto; ?></td>
              <td><?= $s->fechaVencimiento; ?></td>
              <td><?= $s->lote; ?></td>
              <td class="d-flex justify-content-around d-flex">
                <a href="<?= baseUrl; ?>stock/editar&id=<?= $s->idproducto; ?>" class="btn btn-warning btn-sm">Editar</a>
                <a href="<?= baseUrl; ?>stock/eliminar&id=<?= $s->idproducto; ?>" class="btn btn-outline-danger btn-sm">Eliminar</a>
              </td>
            </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    </div>
  </div>

  <!-- ------------- Footer ------------- -->
  <?php require_once 'views/layout/footer2.php'; ?>

  <script type="text/javascript" src="<?= baseUrl; ?>assets/js/tablas.js"></script>

</body>

</html>