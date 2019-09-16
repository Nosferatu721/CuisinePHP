<link rel="stylesheet" type="text/css" href="<?= baseUrl; ?>assets/datatables/datatables.min.css" />
<style type="text/css">
  #container {
    height: 400px;
    min-width: 310px;
    max-width: 800px;
    margin: 0 auto;
  }
</style>
</head>

<body class="animated fadeIn faster">
  <!-- ------------ Header ------------ -->
  <?php require_once 'views/layout/banner.php'; ?>
  <!-- ------------- Nav ------------- -->
  <?php require_once 'views/layout/menu.php'; ?>

  <div class="container">
    <p class="titulo"><?= tittleStock ?></p>
    <?php if (isset($_SESSION['saveEdit']) && $_SESSION['saveEdit'] == 'Registrado') : ?>
      <div class="alert alert-secondary text-success p-1 text-center animated zoomIn faster" role="alert">
        <b><?= stockRegistrado ?> <i class="fas fa-check-double"></i></b>
      </div>
    <?php elseif (isset($_SESSION['saveEdit']) && $_SESSION['saveEdit'] == 'Editado') : ?>
      <div class="alert alert-secondary text-primary p-1 text-center animated zoomIn faster" role="alert">
        <b><?= stockEditado ?> <i class="fas fa-check-double"></i></b>
      </div>
    <?php elseif (isset($_SESSION['delete']) && $_SESSION['delete'] == 'Eliminado') : ?>
      <div class="alert alert-secondary text-danger p-1 text-center animated zoomIn faster" role="alert">
        <b><?= stockEliminado ?> <i class="fas fa-check-double"></i></b>
      </div>
    <?php else : ?>
      <hr>
    <?php endif; ?>
    <?php Utils::deleteSession('saveEdit') ?>
    <?php Utils::deleteSession('delete') ?>
    <a href="<?= baseUrl; ?>stock/registro" class="btn btn-outline-success"><i class="fas fa-plus"></i> <?= regisNuevoStock ?></a>
    <div class="mt-3 p-2">
      <table class="table table-bordered table-responsive-md table-hover" id="tabla">
        <caption class="text-center py-1"><?= tittleTableStock ?> <a href="<?= baseUrl; ?>stock/pdf" target="blank" class="btn btn-danger"><?= generarPDF ?> <i class="fas fa-file-pdf"></i></a></caption>
        <thead class="table-dark">
          <tr class="font-italic">
            <th scope="col"><?= producto ?></th>
            <th scope="col"><?= cantidad ?></th>
            <th scope="col"><?= fechaVenciProducto ?></th>
            <th scope="col"><?= loteStock ?></th>
            <th scope="col"><?= acciones ?></th>
          </tr>
        </thead>
        <tbody>
          <?php while ($s = $sto->fetch_object()) : ?>
            <tr>
              <td><?= $s->nombreProducto; ?></td>
              <td><?= $s->cantidadProducto; ?></td>
              <td><?= $s->fechaVencimiento; ?></td>
              <td><?= $s->lote; ?></td>
              <td class="d-flex justify-content-around d-flex">
                <a href="<?= baseUrl; ?>stock/editar&id=<?= $s->idproducto; ?>" class="btn btn-warning btn-sm"><?= editar ?> <i class="fas fa-pencil-alt"></i></a>
                <a href="<?= baseUrl; ?>stock/eliminar&id=<?= $s->idproducto; ?>" class="btn btn-outline-danger btn-sm"><?= eliminar ?> <i class="far fa-trash-alt"></i></a>
              </td>
            </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    </div>
    <hr>

    <div id="container" style="height: 400px" class="my-3"></div>
    <div id="container2" style="height: 400px" class="my-3"></div>
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
          text: 'Productos en el Restaurante'
        },
        plotOptions: {
          column: {
            depth: 20,
          },
        },
        xAxis: {
          categories: [
            <?php
            foreach ($sto as $p) {
              ?>

              ['<?php echo $p['nombreProducto']; ?>'],


            <?php
            }
            ?>
          ]
        },
        yAxis: {
          title: {
            text: null
          }
        },
        series: [{
          name: 'Productos',
          data: [
            <?php
            foreach ($sto as $p) {
              ?>

              [<?= $p['cantidadProducto'] ?>],


            <?php
            }
            ?>
          ]
        }]
      });
    });
  </script>
  <script type="text/javascript">
    $(function() {
      $('#container2').highcharts({
        chart: {
          plotBackgroundColor: null,
          plotBorderWidth: null,
          plotShadow: false
        },
        title: {
          text: 'Stock del Restaurante'
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
            foreach ($sto as $p) {
              ?>
              ['<?= $p['nombreProducto'] ?> - <?= $p['cantidadProducto'] ?>', <?= $p['cantidadProducto'] ?>],
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