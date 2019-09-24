<link rel="stylesheet" type="text/css" href="<?= baseUrl; ?>assets/datatables/datatables.min.css" />
</head>

<body class="animated fadeIn faster">
  <!-- ------------ Header ------------ -->
  <?php require_once 'views/layout/banner.php'; ?>
  <!-- ------------- Nav ------------- -->
  <?php require_once 'views/layout/menu.php'; ?>

  <div class="container">
    <p class="titulo"><?= tittleCargo ?></p>
    <?php if (isset($_SESSION['saveEdit']) && $_SESSION['saveEdit'] == 'Registrado') : ?>
      <?= Utils::alerta('success', cargoRegistrado, 'fas fa-check-double') ?>
    <?php elseif (isset($_SESSION['saveEdit']) && $_SESSION['saveEdit'] == 'Editado') : ?>
      <?= Utils::alerta('primary', cargoEditado, 'fas fa-check-double') ?>
    <?php elseif (isset($_SESSION['delete']) && $_SESSION['delete'] == 'Eliminado') : ?>
      <?= Utils::alerta('danger', cargoEliminado, 'fas fa-check-double') ?>
    <?php elseif (isset($_SESSION['delete']) && $_SESSION['delete'] == 'NoQuery') : ?>
      <?= Utils::alerta('danger', imposibleEliminar) ?>
      <?php elseif (isset($_SESSION['notData']) && $_SESSION['notData'] == 'ErrorDatos') : ?>
      <?= Utils::alerta('danger', vacios) ?>
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
            <?php if (isset($editar) && isset($carEdit) && is_object($carEdit)) : ?>
              <span class="titulo text-warning animated flash slower"><?= formTittleCargo2 ?> = <?= $carEdit->nombreCargo; ?></span>
              <?php $url_action = baseUrl . 'cargo/registrar&id=' . $carEdit->idcargo; ?>
            <?php else : ?>
              <span class="titulo text-success"><?= formTittleCargo1 ?></span>
              <?php $url_action = baseUrl . 'cargo/registrar'; ?>
            <?php endif; ?>
          </div>
          <div class="card-body">
            <form action="<?= $url_action; ?>" method="POST">
              <div class="form-label-group p-2">
                <label for="nombre"><?= nombreCargo ?></label>
                <input type="text" id="nombre" name="nombre" class="form-control" value="<?= isset($carEdit) && is_object($carEdit) ? $carEdit->nombreCargo : ''; ?>">
              </div>
              <div class="p-2 border-top">
                <input type="submit" class="btn btn-outline-success btn-block" id="enviar" value="<?= isset($carEdit) && is_object($carEdit) ? actualizar : registrar; ?>">
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="col-md-8">
        <table class="table table-bordered table-hover" id="tablaUsuarios">
          <caption class="text-center"><?= tittleTableCargos ?></caption>
          <thead class="table-dark">
            <tr class="font-italic">
              <th scope="col">ID</th>
              <th scope="col"><?= nombre ?></th>
              <th scope="col"><?= acciones ?></th>
            </tr>
          </thead>
          <tbody>
            <?php $c = CargoController::getAll(); ?>
            <?php while ($car = $c->fetch_object()) : ?>
              <tr>
                <th scope="row"><?= $car->idcargo; ?></th>
                <td><?= $car->nombreCargo; ?></td>
                <td class="d-flex justify-content-around border border-light">
                  <a href="<?= baseUrl; ?>cargo/editar&id=<?= $car->idcargo; ?>" class="btn btn-outline-warning btn-sm"><i class="fas fa-pen-nib"></i> <?= editar ?></a>
                  <!-- Boton Eliminar -->
                  <button class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target=".modal<?= $car->idcargo ?>"> <?= eliminar ?> <i class="far fa-trash-alt"></i></button>
                  <!-- Modal Eliminar -->
                  <div class="modal fade modal<?= $car->idcargo ?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalCenterTitle"><?= confirmar ?></h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          Desea eliminar el cargo?
                        </div>
                        <div class="modal-footer p-2">
                          <button type="button" class="btn btn-dark btn-sm" data-dismiss="modal"><?= cancelar ?></button>
                          <a href="<?= baseUrl; ?>cargo/eliminar&id=<?= $car->idcargo; ?>" class="btn btn-outline-danger btn-sm"> <?= eliminar ?> <i class="far fa-trash-alt"></i></a>
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
    </div>

  </div>

  <!-- ------------- Footer ------------- -->
  <?php require_once 'views/layout/footer2.php'; ?>

  <script src="<?= baseUrl; ?>assets/js/validacionRestaurante.js"></script>

</body>

</html>