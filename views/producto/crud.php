<link rel="stylesheet" type="text/css" href="<?= baseUrl; ?>assets/datatables/datatables.min.css" />
</head>

<body class="animated fadeIn faster">
  <!-- ------------ Header ------------ -->
  <?php require_once 'views/layout/banner.php'; ?>
  <!-- ------------- Nav ------------- -->
  <?php require_once 'views/layout/menu.php'; ?>
  <?php require_once 'controllers/productoController.php'; ?>

  <div class="container">
    <p class="titulo"><?= tittleProducto ?></p>
    <?php if (isset($_SESSION['saveEdit']) && $_SESSION['saveEdit'] == 'Registrado') : ?>
      <?= Utils::alerta('success', productoRegistrado, 'fas fa-check-double') ?>
    <?php elseif (isset($_SESSION['saveEdit']) && $_SESSION['saveEdit'] == 'Editado') : ?>
      <?= Utils::alerta('primary', productoEditado, 'fas fa-check-double') ?>
    <?php elseif (isset($_SESSION['delete']) && $_SESSION['delete'] == 'Eliminado') : ?>
      <?= Utils::alerta('success', productoEliminado, 'fas fa-check-double') ?>
    <?php elseif (isset($_SESSION['delete']) && $_SESSION['delete'] == 'NoQuery') : ?>
      <?= Utils::alerta('danger', imposibleEliminar, 'fas fa-exclamation-triangle') ?>
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
          <div class="card-header font-italic text-center bg-transparent text-danger">
            <?php if (isset($editar) && isset($proEdit) && is_object($proEdit)) : ?>
              <span class="titulo text-warning animated flash slower"><?= formTittleProducto2 ?> = <?= $proEdit->nombreProducto; ?></span>
              <?php $url_action = baseUrl . 'producto/registrar&id=' . $proEdit->idproducto; ?>
            <?php else : ?>
              <span class="titulo text-success"><?= formTittleProducto1 ?></span>
              <?php $url_action = baseUrl . 'producto/registrar'; ?>
            <?php endif; ?>
          </div>
          <div class="card-body">
            <form action="<?= $url_action; ?>" method="POST">
              <div class="form-label-group p-2">
                <label for="nombre"><?= nombreProducto ?></label>
                <input type="text" id="nombre" name="nombre" class="form-control" value="<?= isset($proEdit) && is_object($proEdit) ? $proEdit->nombreProducto : ''; ?>">
              </div>
              <div class="form-label-group p-2">
                <label for="precio"><?= precioProducto ?></label>
                <input type="number" id="precio" name="precio" class="form-control" value="<?= isset($proEdit) && is_object($proEdit) ? $proEdit->precioProducto : ''; ?>">
              </div>
              <div class="p-2 border-top">
                <input type="submit" class="btn btn-outline-success btn-block" id="enviar" value="<?= isset($proEdit) && is_object($proEdit) ? actualizar : registrar; ?>">
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="col-md-8">
        <table class="table table-bordered table-hover" id="tabla">
          <caption class="text-center"><?= tittleTableProducto ?></caption>
          <thead class="table-dark">
            <tr class="font-italic">
              <th scope="col">ID</th>
              <th scope="col"><?= nombre ?></th>
              <th scope="col"><?= precio ?></th>
              <th scope="col"><?= acciones ?></th>
            </tr>
          </thead>
          <tbody>
            <?php $p = ProductoController::getAll(); ?>
            <?php while ($pro = $p->fetch_object()) : ?>
              <tr>
                <th scope="row"><?= $pro->idproducto; ?></th>
                <td><?= $pro->nombreProducto; ?></td>
                <td><?= $pro->precioProducto; ?></td>
                <td class="d-flex justify-content-around border border-light">
                  <a href="<?= baseUrl; ?>producto/editar&id=<?= $pro->idproducto; ?>" class="btn btn-outline-warning btn-sm"><i class="fas fa-pen-nib"></i> <?= editar ?></a>
                  <!-- Boton Eliminar -->
                  <button class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target=".modal<?= $pro->idproducto ?>"> <?= eliminar ?> <i class="far fa-trash-alt"></i></button>
                  <!-- Modal Eliminar -->
                  <div class="modal fade modal<?= $pro->idproducto ?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalCenterTitle"><?= confirmar ?></h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          Desea eliminar el producto?
                        </div>
                        <div class="modal-footer p-2">
                          <button type="button" class="btn btn-dark btn-sm" data-dismiss="modal"><?= cancelar ?></button>
                          <a href="<?= baseUrl; ?>producto/eliminar&id=<?= $pro->idproducto; ?>" class="btn btn-outline-danger btn-sm"> <?= eliminar ?> <i class="far fa-trash-alt"></i></a>
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
    <hr>

    <div id="container2" style="height: 400px" class="my-3"></div>


  </div>

  <!-- ------------- Footer ------------- -->
  <?php require_once 'views/layout/footer2.php'; ?>

  <script src="<?= baseUrl ?>assets/Highcharts-4.1.5/js/highcharts.js"></script>
  <script src="<?= baseUrl ?>assets/Highcharts-4.1.5/js/highcharts-3d.js"></script>
  <script src="<?= baseUrl ?>assets/Highcharts-4.1.5/js/modules/exporting.js"></script>

  <script type="text/javascript" src="<?= baseUrl; ?>assets/js/tablas.js"></script>
  <script src="<?= baseUrl; ?>assets/js/validarProducto.js"></script>

</body>

</html>
