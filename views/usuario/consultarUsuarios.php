<link rel="stylesheet" type="text/css" href="<?= baseUrl; ?>assets/datatables/datatables.min.css" />
<!-- <link rel="stylesheet" type="text/css" href="<?= baseUrl; ?>assets/datatables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css" /> -->


<link rel="stylesheet" href="<?= baseUrl; ?>assets/css/styleAll.css">
<title>CusineSoft - Usuarios</title>
</head>

<body class="animated fadeIn faster">
  <div class="" id="cuerpo">
    <!-- ------------ Header ------------ -->
    <?php require_once 'views/layout/banner.php'; ?>
    <!-- ------------- Nav ------------- -->
    <?php require_once 'views/layout/menu.php'; ?>

    <div class="container">
      <h2>Usuarios Registrados</h2>
      <?php if (isset($_SESSION['saveUser']) && $_SESSION['saveUser'] == 'Registrado') : ?>
        <div class="alert alert-dark text-success p-1 text-center animated zoomIn faster" role="alert">
          <b>Usuario Registrado Exitosamente <i class="fas fa-check-double"></i></b>
        </div>
      <?php elseif (isset($_SESSION['saveUser']) && $_SESSION['saveUser'] == 'Editado') : ?>
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
      <?php Utils::deleteSession('saveUser') ?>
      <?php Utils::deleteSession('delete') ?>
      <a href="<?= baseUrl; ?>usuario/registro" class="btn btn-outline-success"><i class="fas fa-user-plus"></i> Registrar Nuevo Usuario</a>
      <div class="table-responsive mt-3 p-2">
        <table class="table table-bordered table-hover" id="tablaUsuarios">
          <caption>Lista de Usuarios</caption>
          <thead class="table-warning">
            <tr>
              <th>ID</th>
              <th>Nombres</th>
              <th>Apellidos</th>
              <th>Contraseña</th>
              <th>Cargo</th>
              <th>Restaurante</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            <?php while ($user = $users->fetch_object()) : ?>
              <tr>
                <th scope="row"><?= $user->idusuarios; ?></th>
                <td><?= $user->nombre; ?></td>
                <td><?= $user->apellido; ?></td>
                <td><?= $user->contrasena; ?></td>
                <td><?= $user->nombreCargo; ?></td>
                <td><?= $user->nombreRestaurante; ?></td>
                <td class="d-flex justify-content-around border border-light">
                  <a href="<?= baseUrl; ?>usuario/editar&id=<?= $user->idusuarios; ?>" class="btn btn-outline-warning btn-sm"><i class="fas fa-pen-nib pr-1"></i>Editar</a>
                  <a href="<?= baseUrl; ?>usuario/eliminar&id=<?= $user->idusuarios; ?>" class="btn btn-outline-danger btn-sm"><i class="far fa-trash-alt pr-1"></i>Eliminar</a>
                </td>
              <?php endwhile; ?>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

  </div>

  <!-- ------------- Footer ------------- -->
  <?php require_once 'views/layout/footer2.php'; ?>

  <script type="text/javascript" src="<?= baseUrl; ?>assets/js/main.js"></script>

</body>

</html>