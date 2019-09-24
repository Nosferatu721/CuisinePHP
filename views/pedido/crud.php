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
    <?php if (isset($_SESSION['saveEdit']) && $_SESSION['saveEdit'] == 'Registrado') : ?>
      <div class="alert alert-secondary text-success p-1 text-center animated zoomIn faster" role="alert">
        <b>Pedido Registrado Exitosamente <i class="fas fa-check-double"></i></b>
      </div>
    <?php else : ?>
      <hr>
    <?php endif; ?>
    <?php Utils::deleteSession('saveEdit') ?>
    <div class="row my-2">
      <div class="col-md-4 d-flex justify-content-center">
        <div class="card mb-3 border-0">
          <div class="card-header font-italic text-center bg-secondary text-danger">
            
              <span class="titulo text-success">Nuevo Pedido</span>
          </div>
          <form action="<?=baseUrl?>pedido/registrar" method="POST">
            
            <div class="p-2 border-top">
              <input type="submit" class="btn btn-outline-success btn-block" id="enviar" value="Crear Pedido">
            </div>
          </form>
        </div>
      </div>
      <div class="col-md-8">
        <table class="table table-bordered table-hover" id="tabla">
          <caption class="text-center">Lista de Pedidos</caption>
          <thead class="table-dark">
            <tr class="font-italic">
              <th scope="col">ID</th>
              <th scope="col">Fecha Pedido</th>
              <th scope="col">Acciones</th>
            </tr>
          </thead>
          <tbody>
            <?php $ped = PedidoController::getAll(); ?>
            <?php while ($p = $ped->fetch_object()) : ?>
              <tr>
                <th scope="row"><?= $p->idpedido; ?></th>
                <td><?= $p->fechaPedido; ?></td>
                <td class="d-flex justify-content-around border border-light">
                  <a href="<?= baseUrl; ?>pedidoHP/ver&id=<?= $p->idpedido; ?>" class="btn btn-outline-danger btn-sm"><i class="far fa-trash-alt"></i> Ver</a>
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