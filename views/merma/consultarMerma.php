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
    <p class="titulo"><?= tittleMerma ?></p>
    <?php if (isset($_SESSION['saveEdit']) && $_SESSION['saveEdit'] == 'Registrado') : ?>
      <?= Utils::alerta('success', mermaRegistrado, 'fas fa-check-double') ?>
    <?php elseif (isset($_SESSION['saveEdit']) && $_SESSION['saveEdit'] == 'Editado') : ?>
      <?= Utils::alerta('primary', mermaEditado, 'fas fa-check-double') ?>
    <?php elseif (isset($_SESSION['delete']) && $_SESSION['delete'] == 'Eliminado') : ?>
      <?= Utils::alerta('danger', mermaEliminado, 'fas fa-check-double') ?>
    <?php else : ?>
      <hr>
    <?php endif; ?>
    <?php Utils::deleteSession('saveEdit') ?>
    <?php Utils::deleteSession('delete') ?>
    <a href="<?= baseUrl; ?>merma/registro" class="btn btn-outline-success"><i class="fas fa-plus"></i> <?= regisNuevaMerma ?></a>
    <div class="mt-3 p-2">
      <table class="table table-bordered table-responsive-lg table-hover" id="tabla">
        <caption class="text-center py-1"><?= tittleTableMerma ?> <a href="<?= baseUrl; ?>merma/pdf" target="blank" class="btn btn-danger"><?= generarPDF ?> <i class="fas fa-file-pdf"></i></a></caption>
        <thead class="table-dark">
          <tr class="font-italic">
            <th scope="col">ID</th>
            <th scope="col"><?= producto ?></th>
            <th scope="col"><?= tipoMerma ?></th>
            <th scope="col"><?= cantidad ?></th>
            <th scope="col"><?= perdida ?></th>
            <th scope="col"><?= motivo ?></th>
            <th scope="col"><?= fechaMerma ?></th>
            <th scope="col"><?= acciones ?></th>
          </tr>
        </thead>
        <tbody>
          <?php while ($mer = $merma->fetch_object()) : ?>
            <tr>
              <td><?= $mer->idmerma; ?></td>
              <td><?= $mer->nombreProducto; ?></td>
              <td><?= $mer->tipoMerma; ?></td>
              <td><?= $mer->cantidadMerma; ?></td>
              <td>$ <?= $mer->perdida; ?></td>
              <td><?= $mer->motivoMerma; ?></td>
              <td><?= $mer->fechaMerma; ?></td>
              <td class="d-flex justify-content-around d-flex">
                <a href="<?= baseUrl; ?>merma/editar&id=<?= $mer->idmerma; ?>" class="btn btn-warning btn-sm"><?= editar ?> <i class="fas fa-pencil-alt"></i></a>
                <!-- Boton Eliminar -->
                <button class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target=".modal<?= $mer->idmerma ?>"> <?= eliminar ?> <i class="far fa-trash-alt"></i></button>
                <!-- Modal Eliminar -->
                <div class="modal fade modal<?= $mer->idmerma ?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle"><?= confirmar ?></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        Desea eliminar la merma?
                      </div>
                      <div class="modal-footer p-2">
                        <button type="button" class="btn btn-dark btn-sm" data-dismiss="modal"><?= cancelar ?></button>
                        <a href="<?= baseUrl; ?>merma/eliminar&id=<?= $mer->idmerma; ?>" class="btn btn-outline-danger btn-sm"> <?= eliminar ?> <i class="far fa-trash-alt"></i></a>
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
    <?php if (isset($_SESSION['pdfFechas']) && $_SESSION['pdfFechas'] == 'FechasVacias') : ?>
      <?= Utils::alerta('warning', vacios) ?>
    <?php else : ?>
      <hr>
    <?php endif; ?>
    <?php Utils::deleteSession('pdfFechas') ?>

    <form action="<?= baseUrl; ?>merma/PDFFecha" method="POST" class="row justify-content-around">
      <div class="form-label-group col-3">
        <label for="fechaInicial">Fech Inicial </label>
        <input type="date" id="fechaInicial" name="fechaInicial" class="form-control">
      </div>
      <div class="form-label-group col-3">
        <label for="fechaFinal">Fecha Final </label>
        <input type="date" id="fechaFinal" name="fechaFinal" class="form-control">
      </div>
      <div class="d-flex align-items-center">
        <button type="submit" id="generarPDF" class="btn btn-outline-danger"><?= generarPDF ?> <i class="fas fa-file-pdf"></i></button>
      </div>
    </form>

    <hr>
    <div id="container" style="height: 400px" class="my-3"></div>
  </div>

  <!-- GRAFICA -->
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
          text: 'Merma Registrada'
        },
        plotOptions: {
          column: {
            depth: 20,
          },
        },
        xAxis: {
          categories: [
            <?php
            foreach ($merma as $m) {
              ?>

              ['<?php echo $m['nombreProducto']; ?>'],


            <?php
            }
            ?>
          ]
        },
        yAxis: {
          title: {
            text: 'Cantidad'
          }
        },
        series: [{
          name: 'Productos',
          data: [
            <?php
            foreach ($merma as $m) {
              ?>

              [<?= $m['cantidadMerma'] ?>],

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

  <script src="<?= baseUrl ?>assets/js/validarFechasPDF.js"></script>

  <script src="<?= baseUrl ?>assets/Highcharts-4.1.5/js/highcharts.js"></script>
  <script src="<?= baseUrl ?>assets/Highcharts-4.1.5/js/highcharts-3d.js"></script>
  <script src="<?= baseUrl ?>assets/Highcharts-4.1.5/js/modules/exporting.js"></script>

  <script type="text/javascript" src="<?= baseUrl; ?>assets/js/tablas.js"></script>

</body>

</html>