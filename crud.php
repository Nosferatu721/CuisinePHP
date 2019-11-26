<link rel="stylesheet" type="text/css" href="<?= baseUrl; ?>assets/datatables/datatables.min.css" />
<link rel="stylesheet" href="<?= baseUrl; ?>assets/css/styleAll.css">
<title>CusineSoft - Pedido</title>
</head>

<body class="animated fadeIn faster">
  <!-- ------------ Header ------------ -->
  <?php require_once 'views/layout/banner.php'; ?>
  <!-- ------------- Nav ------------- -->
  <?php require_once 'views/layout/menu.php'; ?>

  <div class="container">
    <p class="titulo">Control de Pedido</p>
    <?php if (isset($_SESSION['save']) && $_SESSION['save'] == 'Registrado') : ?>
      <?= Utils::alerta('success', 'Almuerzo Registrado Exitosamente', 'fas fa-check-double') ?>
    <?php else : ?>
      <hr>
    <?php endif; ?>
    <?php Utils::deleteSession('save') ?>
    <div class="row my-2">
      <div class="col-md-4 d-flex justify-content-center">
        <div class="card mb-3 border-0">
          <div class="card-header font-italic text-center bg-secondary text-danger">
            <span class="titulo text-success">Nuevo Almuerzo</span>
          </div>
          <form action="<?= baseUrl ?>almuerzo/registrar" method="POST">
            <div class="p-2 border-top">
              <div class="form-label-group p-2">
                <label for="cantidad">Cantidad Personas</label>
                <input type="text" id="cantidad" name="cantidad" class="form-control">
              </div>
              <input type="submit" class="btn btn-outline-success btn-block" id="enviar" value="Crear Almuerzo">
            </div>
          </form>
        </div>
      </div>
      <div class="col-md-8">
        <table class="table table-bordered table-hover" id="tabla">
          <caption class="text-center">Lista de Almuerzos</caption>
          <thead class="table-dark">
            <tr class="font-italic">
              <th scope="col">ID</th>
              <th scope="col">Fecha Almuerzo</th>
              <th scope="col">Cantidad Personas</th>
              <th scope="col">Acciones</th>
            </tr>
          </thead>
          <tbody>
            <?php $alvs = AlmuerzoController::getAll(); ?>
            <?php while ($al = $alvs->fetch_object()) : ?>
              <tr>
                <th scope="row"><?= $al->idalmuerzoPersonal; ?></th>
                <td><?= $al->fechaAlmuerzo; ?></td>
                <td><?= $al->cantidadPersonas; ?></td>
                <td class="d-flex justify-content-around border border-light">
                  <a href="<?= baseUrl; ?>almuerzoHP/ver&id=<?= $al->idalmuerzoPersonal; ?>" class="btn btn-outline-danger btn-sm"><i class="fas fa-search"></i> Ver</a>
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

</body>
</html>
