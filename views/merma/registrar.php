</head>

<body class="animated fadeIn faster">
  <!-- ------------ Header ------------ -->
  <?php require_once 'views/layout/banner.php'; ?>
  <!-- ------------- Nav ------------- -->
  <?php require_once 'views/layout/menu.php'; ?>
  <?php require_once 'controllers/productoController.php'; ?>
  <?php require_once 'controllers/tipoMermaController.php'; ?>

  <div class="container p-3">
    <?php if (isset($editar) && isset($mr) && is_object($mr)) : ?>
      <span class="titulo"><?= tittleRegisMerma2 ?> = <?= $mr->nombreProducto; ?></span>
      <?php $url_action = baseUrl . 'merma/registrar&id=' . $mr->idmerma; ?>
    <?php else : ?>
      <span class="titulo"><?= tittleRegisMerma1 ?></span>
      <?php $url_action = baseUrl . 'merma/registrar'; ?>
    <?php endif; ?>
    <!-- Alertas -->
    <?php if (isset($_SESSION['saveEdit']) && $_SESSION['saveEdit'] == 'Vacios') : ?>
      <?= Utils::alerta('danger', vacios) ?>
    <?php elseif (isset($_SESSION['saveEdit']) && $_SESSION['saveEdit'] == 'Yuca') : ?>
      <?= Utils::alerta('danger', mensajeCantidad) ?>
    <?php else : ?>
      <hr>
    <?php endif; ?>
    <?php Utils::deleteSession('saveEdit') ?>
    <form action="<?= $url_action; ?>" method="POST" class="pb-3" id="miFormulario">
      <div class="row">
        <?php if (isset($mr) && is_object($mr)) : ?>
          <div class="col-12">
            <?= cantidadActualMerma ?> <b class="text-danger"> <?= $mr->cantidadMerma ?> </b>
          </div>
        <?php else : ?>
          <div class="col-6 py-2 mt-1">
            <span><?= selectProducto ?> <i class="fas fa-carrot"></i></span><br>
            <select class="custom-select mr-sm-2 mt-1" name="producto" id="producto">
              <?php $ptos = ProductoController::getAll(); ?>
              <option><?= elija ?></option>
              <?php while ($p = $ptos->fetch_object()) : ?>
                <option value="<?= $p->idproducto; ?>"><?= $p->nombreProducto; ?></option>
              <?php endwhile; ?>
            </select>
          </div>
        <?php endif; ?>
        <div class="form-label-group col-6 py-2">
          <label for="cantidad"><?= isset($mr) && is_object($mr) ? addMerma : cantidad; ?></label>
          <input type="number" id="cantidad" name="cantidad" class="form-control">
        </div>
        <div class="col-6 py-2 mt-1">
          <span><?= tipoMerma ?> <i class="fas fa-carrot"></i></span><br>
          <select class="custom-select mr-sm-2 mt-1" name="tipoMerma" id="tipoMerma">
            <?php $tp = TipoMermaController::getAll(); ?>
            <option><?= elija ?></option>
            <?php while ($t = $tp->fetch_object()) : ?>
              <option <?= isset($mr) && is_object($mr) && (int) $mr->tipoMerma_idtipoMerma == (int) $t->idtipoMerma ? 'selected' : ''; ?> value="<?= $t->idtipoMerma; ?>"><?= $t->tipoMerma; ?></option>
            <?php endwhile; ?>
          </select>
        </div>
        <div class="form-label-group col-6 py-2">
          <label for="motivo"><?= motivo ?> <span class="maxN"></span></label>
          <textarea class="form-control" id="motivo" name="motivo"><?= isset($mr) && is_object($mr) ? $mr->motivoMerma : ''; ?></textarea>
        </div>
        <div class="col-6 offset-3 py-2">
          <input type="submit" class="btn btn-outline-primary btn-block" id="enviar" value="<?= isset($mr) && is_object($mr) ? actualizar : registrar; ?>">
        </div>
      </div>
    </form>
  </div>
  <!-- ------------- Footer ------------- -->
  <?php require_once 'views/layout/footer2.php'; ?>
  <?php if (isset($mr)) : ?>
    <script src="<?= baseUrl; ?>assets/js/validarMermaEdit.js"></script>
  <?php else : ?>
    <script src="<?= baseUrl; ?>assets/js/validarMerma.js"></script>
  <?php endif; ?>
</body>
