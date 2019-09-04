<link rel="stylesheet" href="<?= baseUrl; ?>assets/css/styleAll.css">
<title>CusineSoft - Stock</title>
</head>

<body class="animated fadeIn faster">
  <!-- ------------ Header ------------ -->
  <?php require_once 'views/layout/banner.php'; ?>
  <!-- ------------- Nav ------------- -->
  <?php require_once 'views/layout/menu.php'; ?>

  <div class="container p-3">
    <?php if (isset($editar) && isset($stock) && is_object($stock)) : ?>
      <span class="titulo">Editar Stock = <?= $stock->nombreProducto; ?></span>
      <?php $url_action = baseUrl . 'stock/registrar&id=' . $stock->idproducto; ?>
    <?php else : ?>
      <span class="titulo">Registro de Stock</span>
      <?php $url_action = baseUrl . 'stock/registrar'; ?>
    <?php endif; ?>
    <?php if (isset($_SESSION['saveEdit']) && $_SESSION['saveEdit'] == 'Vacios') : ?>
      <div class="alert alert-danger p-1 text-center animated zoomIn faster" role="alert">
        Existen Campos Vacios
      </div>
    <?php elseif (isset($_SESSION['saveEdit']) && $_SESSION['saveEdit'] == 'Yuca') : ?>
      <div class="alert alert-secondary p-1 text-center text-danger animated zoomIn faster" role="alert">
        La cantidad es menor que 0
      </div>
    <?php else : ?>
      <hr>
    <?php endif; ?>
    <?php Utils::deleteSession('saveEdit') ?>
    <form action="<?= $url_action; ?>" method="POST" class="pb-3" id="miFormulario">
      <div class="row">
        <?php if (isset($stock) && is_object($stock)) : ?>
          <div class="col-12">
            Cantidad Actual de Stock = <b class="text-danger"> <?= $stock->cantidadProducto ?> </b>
          </div>
        <?php else : ?>
          <div class="col-6 py-2 mt-1">
            <span>Seleccionar Producto <i class="fas fa-carrot"></i></span><br>
            <?php $ptos = ProductoController::getAll(); ?>
            <select class="custom-select mr-sm-2 mt-1" name="producto" id="producto">
              <option>Eliga...</option>
              <?php while ($p = $ptos->fetch_object()) : ?>
                <option value="<?= $p->idproducto; ?>"><?= $p->nombreProducto; ?></option>
              <?php endwhile; ?>
            </select>
          </div>

        <?php endif; ?>
        <div class="form-label-group col-6 py-2">
          <label for="cantidad"><?= isset($stock) && is_object($stock) ? 'Agregar / Disminuir Stock' : 'Cantidad'; ?></label>
          <input type="number" id="cantidad" name="cantidad" class="form-control" value="" placeholder="Cantidad">
        </div>
        <hr>
        <div class="form-label-group col-6 py-2">
          <label for="fecha">Fecha Vencimiento (Aprox) </label>
          <input type="date" id="fecha" name="fecha" class="form-control" value="<?= isset($stock) && is_object($stock) ? $stock->fechaVencimiento : ''; ?>">
        </div>
        <div class="form-label-group col-6 py-2">
          <label for="lote">Lote</label>
          <input type="number" id="lote" name="lote" class="form-control" value="<?= isset($stock) && is_object($stock) ? $stock->lote : ''; ?>" placeholder="Lote">
        </div>
        <div class="col-6 offset-3 py-2">
          <input type="submit" class="btn btn-outline-primary btn-block" id="enviar" value="<?= isset($stock) && is_object($stock) ? 'Actualizar' : 'Registrar'; ?>">
        </div>
      </div>
    </form>
  </div>
  <!-- ------------- Footer ------------- -->
  <?php require_once 'views/layout/footer2.php'; ?>
  <script src="<?= baseUrl; ?>assets/js/validarStock.js"></script>
</body>