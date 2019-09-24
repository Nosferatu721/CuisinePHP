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
    <?php elseif (isset($_SESSION['saveEdit']) && $_SESSION['saveEdit'] == 'Editado') : ?>
      <div class="alert alert-secondary text-primary p-1 text-center animated zoomIn faster" role="alert">
        <b>Pedido Editado Exitosamente <i class="fas fa-check-double"></i></b>
      </div>
    <?php elseif (isset($_SESSION['delete']) && $_SESSION['delete'] == 'Eliminado') : ?>
      <div class="alert alert-secondary text-danger p-1 text-center animated zoomIn faster" role="alert">
        <b>Pedido Eliminado Exitosamente <i class="fas fa-check-double"></i></b>
      </div>
    <?php elseif (isset($_SESSION['delete']) && $_SESSION['delete'] == 'NoQuery') : ?>
      <div class="alert alert-secondary text-danger p-1 text-center animated zoomIn faster" role="alert">
        <b>No Se Puede Eliminar <i class="fas fa-exclamation-triangle"></i></b>
      </div>
    <?php elseif (isset($_SESSION['notData']) && $_SESSION['notData'] == 'ErrorDatos') : ?>
      <div class="alert alert-danger p-1 text-center animated zoomIn faster" role="alert">
        Existen Campos Vacios
      </div>
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

            <span class="titulo text-success">Nuevo Producto en pedido <?= $_GET['id'] ?></span>
          </div>
          <form action="<?= baseUrl ?>pedidoHP/registrar&id=<?= $_GET['id']; ?>" method="POST">
            <div class=" py-2 mt-1">
              <span><?= selectProducto ?> <i class="fas fa-carrot"></i></span><br>
              <?php $ptos = ProductoController::getAll(); ?>
              <select class="custom-select mr-sm-2 mt-1" name="producto" id="producto">
                <option><?= elija ?></option>
                <?php while ($p = $ptos->fetch_object()) : ?>
                  <option value="<?= $p->idproducto; ?>"><?= $p->nombreProducto; ?></option>
                <?php endwhile; ?>
              </select>
            </div>
            <div class="form-label-group p-2">
              <label for="cantidad">Cantidad Pedida</label>
              <input type="text" id="cantidad" name="cantidad" class="form-control">
            </div>
            <div class="p-2 border-top">
              <input type="submit" class="btn btn-outline-success btn-block" id="enviar" value="Agregar a pedido">
            </div>
          </form>
        </div>
      </div>
      <div class="col-md-8">
        <table class="table table-bordered table-hover" id="tabla">
          <caption class="text-center">Lista de Productos</caption>
          <thead class="table-dark">
            <tr class="font-italic">
              <th scope="col">Producto</th>
              <th scope="col">Cantidad</th>
              <th scope="col">Acciones</th>
            </tr>
          </thead>
          <tbody>

            <?php $p = PedidoHPController::getAll($_GET['id']) ?>
            <?php while ($pedHP = $p->fetch_object()) : ?>
              <tr>
                <td><?= $pedHP->nombreProducto; ?></td>
                <td><?= $pedHP->cantidadProdPed; ?></td>
                <td class="d-flex justify-content-around border border-light">
                  <a href="<?= baseUrl; ?>pedidoHP/eliminar&id=<?= $pedHP->producto_idproducto; ?>&idp=<?= $_GET['id'] ?>" class="btn btn-outline-danger btn-sm"><i class="far fa-trash-alt"></i> Eliminar</a>
                </td>
              </tr>
            <?php endwhile; ?>
          </tbody>
        </table>
      </div>
    </div>
    <div id="container" style="height: 400px" class="my-3"></div>
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
          text: 'Productos En El Pedido'
        },
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
          name: 'Cantidad',
          data: [
            <?php
            foreach ($p as $ped) {
              ?>['<?= $ped['nombreProducto'] ?> - <?= $ped['cantidadProdPed'] ?>', <?= $ped['cantidadProdPed'] ?>],
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

  <script type="text/javascript" src="<?= baseUrl; ?>assets/js/tablas.js"></script>
  <script src="<?= baseUrl ?>assets/Highcharts-4.1.5/js/highcharts.js"></script>
  <script src="<?= baseUrl ?>assets/Highcharts-4.1.5/js/highcharts-3d.js"></script>
  <script src="<?= baseUrl ?>assets/Highcharts-4.1.5/js/modules/exporting.js"></script>

</body>

</html>