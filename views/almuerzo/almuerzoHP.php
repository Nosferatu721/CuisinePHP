<link rel="stylesheet" type="text/css" href="<?= baseUrl; ?>assets/datatables/datatables.min.css" />
<link rel="stylesheet" href="<?= baseUrl; ?>assets/css/styleAll.css">
<title>CusineSoft - <?= almuerzoPersonal ?></title>
</head>

<body class="animated fadeIn faster">
  <!-- ------------ Header ------------ -->
  <?php require_once 'views/layout/banner.php'; ?>
  <?php require_once 'controllers/almuerzoHPController.php'; ?>
  <?php require_once 'controllers/productoController.php'; ?>
  <!-- ------------- Nav ------------- -->
  <?php require_once 'views/layout/menu.php'; ?>

  <div class="container">
    <p class="titulo"><?= almuerzoPersonal ?></p>
    <?php if (isset($_SESSION['save']) && $_SESSION['save'] == 'Registrado') : ?>
      <?= Utils::alerta('success', 'Producto Registrado', 'fas fa-check-double') ?>
    <?php elseif (isset($_SESSION['delete']) && $_SESSION['delete'] == 'Eliminado') : ?>
      <?= Utils::alerta('danger', 'Producto Eliminado', 'fas fa-check-double') ?>
    <?php elseif (isset($_SESSION['save']) && $_SESSION['save'] == 'Vacios') : ?>
      <?= Utils::alerta('danger', vacios) ?>
    <?php else : ?>
      <hr>
    <?php endif; ?>
    <?php Utils::deleteSession('save') ?>
    <?php Utils::deleteSession('delete') ?>
    <div class="row my-2">
      <div class="col-md-4 d-flex justify-content-center">
        <div class="card mb-3 border-0">
          <div class="card-header font-italic text-center bg-secondary text-danger">
            <span class="titulo text-success"><?= almuerzoId ?> = <b><?= $_GET['id'] ?></b></span>
          </div>
          <div class="card-body">
            <form action="<?= baseUrl ?>almuerzoHP/registrar&id=<?= $_GET['id']; ?>" method="POST">
              <div class="p-2">
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
                <label for="cantidad"><?= cantidad ?></label>
                <input type="number" id="cantidad" name="cantidad" class="form-control">
              </div>
              <div class="p-2 border-top">
                <input type="submit" class="btn btn-outline-success btn-block" id="enviar" value="<?= addLunch ?>">
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="col-md-8">
        <table class="table table-responsive-sm table-bordered table-hover" id="tabla">
          <caption class="text-center py-1"><?= tittleTableProducto ?> <a href="<?= baseUrl; ?>almuerzoHP/pdf&id=<?= $_GET['id'] ?>" target="blank" class="btn btn-danger"><?= generarPDF ?> <i class="fas fa-file-pdf"></i></a></caption>
          <thead class="table-dark">
            <tr class="font-italic">
              <th scope="col"><?= prod ?></th>
              <th scope="col"><?= cantidad ?></th>
              <th scope="col"><?= cantidadIndividual ?></th>
              <th scope="col"><?= precioTotal ?></th>
              <th scope="col"><?= saleAction ?></th>
            </tr>
          </thead>
          <tbody>
            <?php $v = AlmuerzoHPController::getAll($_GET['id']); ?>
            <?php while ($venHP = $v->fetch_object()) : ?>
              <tr>
                <td><?= $venHP->nombreProducto; ?></td>
                <td><?= $venHP->cantidadProducto; ?></td>
                <td><?= $venHP->cantidadIndividual; ?></td>
                <td>$<?= $venHP->precioTotal; ?></td>
                <td class="d-flex justify-content-around border border-light">
                  <a href="<?= baseUrl; ?>almuerzoHP/eliminar&id=<?= $venHP->producto_idproducto; ?>&ida=<?= $_GET['id'] ?>" class="btn btn-outline-danger btn-sm"><i class="far fa-trash-alt"></i> <?= eliminar ?></a>
                </td>
              </tr>
            <?php endwhile; ?>
          </tbody>
        </table>
      </div>
    </div>
    <hr>
    <div id="container" style="height: 400px" class="my-3"></div>
  </div>

  <script type="text/javascript">
    $(function() {
      $('#container').highcharts({
        chart: {
          type: 'column',
          margin: 75,
          options3d: {
            enabled: true,
            alpha: 10,
            beta: 25,
            depth: 70
          }
        },
        title: {
          text: '<?= almuerzoPersonal ?>'
        },
        plotOptions: {
          column: {
            depth: 20,
          },
        },
        xAxis: {
          categories: [
            <?php
            foreach ($v as $vHP) {
              ?>

              ['<?php echo $vHP['nombreProducto']; ?>'],


            <?php
            }
            ?>
          ]
        },
        yAxis: {
          title: {
            text: '<?= cantidad ?>'
          }
        },
        series: [{
          name: '<?= productos ?>',
          data: [
            <?php
            foreach ($v as $vHP) {
              ?>[<?= $vHP['cantidadProducto'] ?>],
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

  <script type="text/javascript" src="<?= baseUrl; ?>assets/js/validarVentaHP.js"></script>

</body>

</html>
