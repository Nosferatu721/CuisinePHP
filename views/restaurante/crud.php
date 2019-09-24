<link rel="stylesheet" type="text/css" href="<?= baseUrl; ?>assets/datatables/datatables.min.css" />
</head>

<body class="animated fadeIn faster">
  <!-- ------------ Header ------------ -->
  <?php require_once 'views/layout/banner.php'; ?>
  <!-- ------------- Nav ------------- -->
  <?php require_once 'views/layout/menu.php'; ?>

  <div class="container">
    <p class="titulo"><?= tittleRest; ?></p>
    <?php if (isset($_SESSION['saveEdit']) && $_SESSION['saveEdit'] == 'Registrado') : ?>
      <?= Utils::alerta('success', restRegistrado, 'fas fa-check-double') ?>
    <?php elseif (isset($_SESSION['saveEdit']) && $_SESSION['saveEdit'] == 'Editado') : ?>
      <?= Utils::alerta('primary', restEditado, 'fas fa-check-double') ?>
    <?php elseif (isset($_SESSION['delete']) && $_SESSION['delete'] == 'Eliminado') : ?>
      <?= Utils::alerta('danger', restEliminado, 'fas fa-check-double') ?>
    <?php elseif (isset($_SESSION['delete']) && $_SESSION['delete'] == 'NoQuery') : ?>
      <?= Utils::alerta('danger', imposibleEliminar, 'fas fa-exclamation-triangle') ?>
    <?php elseif (isset($_SESSION['notData']) && $_SESSION['notData'] == 'ErrorDatos') : ?>
      <?= Utils::alerta('danger', vacios, 'fas fa-exclamation-triangle') ?>
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
            <?php if (isset($editar) && isset($restEdit) && is_object($restEdit)) : ?>
              <span class="titulo text-warning animated flash slower"><?= formTittleRest2; ?> = <?= $restEdit->nombreRestaurante; ?></span>
              <?php $url_action = baseUrl . 'restaurante/registrar&id=' . $restEdit->idrestaurante; ?>
            <?php else : ?>
              <span class="titulo text-success"><?= formTittleRest1; ?></span>
              <?php $url_action = baseUrl . 'restaurante/registrar'; ?>
            <?php endif; ?>
          </div>
          <div class="card-body">
            <form action="<?= $url_action; ?>" method="POST">
              <div class="form-label-group p-2">
                <label for="nombre"><?= nombreRestaurante; ?></label>
                <input type="text" id="nombre" name="nombre" class="form-control" value="<?= isset($restEdit) && is_object($restEdit) ? $restEdit->nombreRestaurante : ''; ?>">
              </div>
              <div class="form-label-group p-2">
                <label for="direccion"><?= direccionRestaurante; ?></label>
                <input type="text" id="direccion" name="direccion" class="form-control" value="<?= isset($restEdit) && is_object($restEdit) ? $restEdit->direccionRestaurante : ''; ?>">
              </div>
              <div class="p-2 border-top">
                <input type="submit" class="btn btn-outline-success btn-block" id="enviar" value="<?= isset($restEdit) && is_object($restEdit) ? actualizar : registrar; ?>">
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="col-md-8">
        <table class="table table-bordered table-responsive-sm table-hover" id="">
          <caption class="text-center"><?= tittleTableRestaurante; ?></caption>
          <thead class="table-dark">
            <tr class="font-italic">
              <th scope="col">ID</th>
              <th scope="col"><?= nombre; ?></th>
              <th scope="col"><?= direccion; ?></th>
              <th scope="col"><?= acciones; ?></th>
            </tr>
          </thead>
          <tbody>
            <?php $rets = RestauranteController::getAll(); ?>
            <?php while ($rest = $rets->fetch_object()) : ?>
              <tr>
                <th scope="row"><?= $rest->idrestaurante; ?></th>
                <td><?= $rest->nombreRestaurante; ?></td>
                <td><?= $rest->direccionRestaurante; ?></td>
                <td class="d-flex justify-content-around">
                  <a href="<?= baseUrl; ?>restaurante/editar&id=<?= $rest->idrestaurante; ?>" class="btn btn-outline-warning btn-sm"><i class="fas fa-pen-nib"></i> <?= editar; ?></a>
                  <!-- Boton Eliminar -->
                  <button class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target=".modal<?= $rest->idrestaurante ?>"> <?= eliminar ?> <i class="far fa-trash-alt"></i></button>
                  <!-- Modal Eliminar -->
                  <div class="modal fade modal<?= $rest->idrestaurante ?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalCenterTitle"><?= confirmar ?></h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          Desea eliminar el restaurante?
                        </div>
                        <div class="modal-footer p-2">
                          <button type="button" class="btn btn-dark btn-sm" data-dismiss="modal"><?= cancelar ?></button>
                          <a href="<?= baseUrl; ?>restaurante/eliminar&id=<?= $rest->idrestaurante; ?>" class="btn btn-outline-danger btn-sm"> <?= eliminar ?> <i class="far fa-trash-alt"></i></a>
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

  <script type="text/javascript" src="<?= baseUrl; ?>assets/js/tablas.js"></script>
  <script src="<?= baseUrl; ?>assets/js/validacionRestaurante.js"></script>

</body>

</html>