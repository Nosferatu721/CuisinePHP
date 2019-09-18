<link rel="stylesheet" type="text/css" href="<?= baseUrl; ?>assets/datatables/datatables.min.css" />
</head>

<body class="animated fadeIn faster">
  <!-- ------------ Header ------------ -->
  <?php require_once 'views/layout/banner.php'; ?>
  <!-- ------------- Nav ------------- -->
  <?php require_once 'views/layout/menu.php'; ?>

  <div class="container">
    <p class="titulo"><?= tittleUser ?></p>
    <?php if (isset($_SESSION['saveEdit']) && $_SESSION['saveEdit'] == 'Registrado') : ?>
      <div class="alert alert-secondary text-success p-1 text-center animated zoomIn faster" role="alert">
        <b><?= userRegistrado ?> <i class="fas fa-check-double"></i></b>
      </div>
    <?php elseif (isset($_SESSION['saveEdit']) && $_SESSION['saveEdit'] == 'Editado') : ?>
      <div class="alert alert-secondary text-primary p-1 text-center animated zoomIn faster" role="alert">
        <b><?= userEditado ?> <i class="fas fa-check-double"></i></b>
      </div>
    <?php elseif (isset($_SESSION['estado']) && $_SESSION['estado'] == 'Cambiado') : ?>
      <div class="alert alert-secondary text-success p-1 text-center animated zoomIn faster" role="alert">
        <b><?= userCambiado ?> <i class="fas fa-check-double"></i></b>
      </div>
    <?php else : ?>
      <hr>
    <?php endif; ?>
    <?php Utils::deleteSession('saveEdit') ?>
    <?php Utils::deleteSession('estado') ?>
    <a href="<?= baseUrl; ?>usuario/registro" class="btn btn-outline-success"><i class="fas fa-user-plus"></i> <?= regisNuevoUsuario; ?></a>
    <div class="mt-3 p-2">
      <table class="table table-bordered table-responsive table-hover" id="tabla">
        <caption class="text-center py-1"><?= tittleTableUsuarios; ?> <a href="<?= baseUrl; ?>usuario/pdf" target="blank" class="btn btn-danger"><?= generarPDF; ?> <i class="fas fa-file-pdf"></i></a></caption>
        <thead class="table-dark">
          <tr class="font-italic">
            <th scope="col">ID</th>
            <th scope="col"><?= nombre ?></th>
            <th scope="col"><?= apellido ?></th>
            <th scope="col"><?= email ?></th>
            <th scope="col"><?= contraseña ?></th>
            <th scope="col"><?= cargo ?></th>
            <th scope="col"><?= restaurante ?></th>
            <th scope="col" style="width: 100%"><?= acciones ?></th>
          </tr>
        </thead>
        <tbody>
          <?php while ($user = $users->fetch_object()) : ?>
            <tr class="table-<?= $user->estado == 'Inactivo' ? 'secondary' : ''; ?>">
              <th scope="row"><?= $user->idusuarios; ?></th>
              <td><?= $user->nombre; ?></td>
              <td><?= $user->apellido; ?></td>
              <td><?= $user->email; ?></td>
              <td><?= $user->contrasena; ?></td>
              <td><?= $user->nombreCargo; ?></td>
              <td><?= $user->nombreRestaurante; ?></td>
              <td class="d-flex justify-content-around d-flex">
                <!-- Boton Editar -->
                <a href="<?= baseUrl; ?>usuario/editar&id=<?= $user->idusuarios; ?>" class="btn btn-warning btn-sm"><?= editar ?> <i class="fas fa-pencil-alt"></i></a>
                <!-- Boton Eliminar -->
                <button class="btn btn-outline-<?= $user->estado == 'Activo' ? 'danger' : ($user->estado == 'Inactivo' ? 'success' : ''); ?> btn-sm" data-toggle="modal" data-target=".modal<?= $user->idusuarios ?>"><?= $user->estado == 'Activo' ? 'Inactivar' : ($user->estado == 'Inactivo' ? 'Activar' : ''); ?> <i class="fas fa-exchange-alt"></i></button>
                <!-- Modal Eliminar -->
                <div class="modal fade modal<?= $user->idusuarios ?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle"><?= confirmar ?></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <?= $user->estado == 'Activo' ? inactivar : ($user->estado == 'Inactivo' ? activar : ''); ?> <?= pregunta ?>
                      </div>
                      <div class="modal-footer p-2">
                        <button type="button" class="btn btn-dark btn-sm" data-dismiss="modal"><?= cancelar ?></button>
                        <a href="<?= baseUrl; ?>usuario/eliminar&id=<?= $user->idusuarios; ?>" class="btn btn-outline-<?= $user->estado == 'Activo' ? 'danger' : ($user->estado == 'Inactivo' ? 'success' : ''); ?> btn-sm"><?= $user->estado == 'Activo' ? inactivar : ($user->estado == 'Inactivo' ? activar : ''); ?> <i class="fas fa-exchange-alt"></i></a>
                      </div>
                    </div>
                  </div>
                </div>
              </td>
            </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    </div>
    <hr>
    <div class="row">
      <div class="col-12 col-md-6">
        <span class="titulo">Porcentaje de usuarios en el Sistema</span>
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
      <div class="col-12 col-md-6">
        <div id="container" style="height: 250px" class="my-3"></div>
      </div>
    </div>
  </div>


  <script type="text/javascript">
    $(function() {
      $('#container').highcharts({
        chart: {
          plotBackgroundColor: null,
          plotBorderWidth: null,
          plotShadow: false
        },
        title: {
          text: 'Users'
        },
        colors: ['#27ae60', '#e74c3c'],
        tooltip: {
          pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
          pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
              enabled: true,
              style: {
                color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
              }
            }
          }
        },
        series: [{
          type: 'pie',
          name: 'Porcentaje',
          data: [
            <?php
            $ob = mysqli_fetch_object($userActivos);
            foreach ($ob as $i => $value) {
              ?>['<?= $i; ?>', <?= $value; ?>],
            <?php
            }
            ?>
          ]
        }]
      });
    });
  </script>

  <!-- ------------- Footer ------------- -->
  <?php require_once 'views/layout/footer2.php'; ?>

  <script src="<?= baseUrl ?>assets/Highcharts-4.1.5/js/highcharts.js"></script>
  <script src="<?= baseUrl ?>assets/Highcharts-4.1.5/js/highcharts-3d.js"></script>
  <script src="<?= baseUrl ?>assets/Highcharts-4.1.5/js/modules/exporting.js"></script>

  <script type="text/javascript" src="<?= baseUrl; ?>assets/js/tablas.js"></script>

</body>

</html>