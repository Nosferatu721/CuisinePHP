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
    <p class="titulo">Usuarios Registrados</p>
    <?php if (isset($_SESSION['saveEdit']) && $_SESSION['saveEdit'] == 'Registrado') : ?>
    <div class="alert alert-dark text-success p-1 text-center animated zoomIn faster" role="alert">
      <b>Usuario Registrado Exitosamente <i class="fas fa-check-double"></i></b>
    </div>
    <?php elseif (isset($_SESSION['saveEdit']) && $_SESSION['saveEdit'] == 'Editado') : ?>
    <div class="alert alert-dark text-info p-1 text-center animated zoomIn faster" role="alert">
      <b>Usuario Editado Exitosamente <i class="fas fa-check-double"></i></b>
    </div>
    <?php elseif (isset($_SESSION['delete']) && $_SESSION['delete'] == 'Eliminado') : ?>
    <div class="alert alert-dark text-danger p-1 text-center animated zoomIn faster" role="alert">
      <b>Usuario Eliminado Exitosamente <i class="fas fa-check-double"></i></b>
    </div>
    <?php else : ?>
    <hr>
    <?php endif; ?>
    <?php Utils::deleteSession('saveEdit') ?>
    <?php Utils::deleteSession('delete') ?>
    <a href="<?= baseUrl; ?>usuario/registro" class="btn btn-outline-success"><i class="fas fa-user-plus"></i> Registrar Nuevo Usuario</a>
    <div class="mt-3 p-2">
      <table class="table table-bordered table-responsive-xl table-hover" id="tablaUsuarios">
        <caption class="text-center">Lista de Usuarios <a href="<?= baseUrl; ?>librerias/pdf/usuarios/pdfUsuarios" target="blank" class="btn btn-info">Generar PDF</a></caption>
        <thead class="table-info">
          <tr class="font-italic">
            <th scope="col">ID</th>
            <th scope="col">Nombres</th>
            <th scope="col">Apellidos</th>
            <th scope="col">Email</th>
            <th scope="col">Contraseña</th>
            <th scope="col">Cargo</th>
            <th scope="col">Restaurante</th>
            <th scope="col">Acciones</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($user = $users->fetch_object()) : ?>
          <tr>
            <th scope="row"><?= $user->idusuarios; ?></th>
            <td><?= $user->nombre; ?></td>
            <td><?= $user->apellido; ?></td>
            <td><?= $user->email; ?></td>
            <td><?= $user->contrasena; ?></td>
            <td><?= $user->nombreCargo; ?></td>
            <td><?= $user->nombreRestaurante; ?></td>
            <td class="d-flex justify-content-around border border-light">
              <a href="<?= baseUrl; ?>usuario/editar&id=<?= $user->idusuarios; ?>" class="btn btn-outline-warning btn-sm"><i class="fas fa-pen-nib pr-1"></i>Editar</a>
              <a href="<?= baseUrl; ?>usuario/eliminar&id=<?= $user->idusuarios; ?>" class="btn btn-outline-danger btn-sm"><i class="far fa-trash-alt pr-1"></i>Eliminar</a>
            </td>
          </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    </div>
    <hr>
    <span class="titulo">Porcentadje de usuarios en el Sistema</span>
    <hr>
    <h6>Administradores - <?= $porcentaje[0][0] ?>%</h6>
    <div class="progress mb-4">
      <div class="progress-bar bg-danger progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width:<?= $porcentaje[0][0]; ?>%"></div>
    </div>
    <h6>Jefes de Cocina - <?= $porcentaje[1][0] ?>%</h6>
    <div class="progress mb-4">
      <div class="progress-bar bg-info progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width:<?= $porcentaje[1][0]; ?>%"></div>
    </div>
    <h6>Jefes de Zona - <?= $porcentaje[2][0] ?>%</h6>
    <div class="progress mb-4">
      <div class="progress-bar bg-success progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width:<?= $porcentaje[2][0]; ?>%"></div>
    </div>
  </div>

  <!-- ------------- Footer ------------- -->
  <?php require_once 'views/layout/footer2.php'; ?>

  <script type="text/javascript" src="<?= baseUrl; ?>assets/js/tablas.js"></script>

</body>

</html>