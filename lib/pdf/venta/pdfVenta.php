<?php

require 'lib/vendor/autoload.php';

use Spipu\Html2Pdf\Html2Pdf;

$html2pdf = new Html2Pdf();

ob_start();
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>PDF</title>
  <style>
    * {
      padding: 0px;
      margin: 0px;
      box-sizing: border-box
    }

    h1 {
      text-align: center;
    }

    img {
      width: 200px
    }

    .Head {
      padding: 15px;
      background: #ecf0f1
    }

    hr {
      border: 0.3px;
      color: orange
    }

    .Head p {
      margin: 2px
    }

    .Body h4 {
      margin: 2px;
      text-align: center
    }

    th {
      padding: 10px 0px;
    }

    td {
      width: 150px;
      padding: 5px 0px;
      border-bottom: .5px dotted gray
    }

    .email {
      width: 200px
    }

    .Footer {
      padding: 15px;
      background: #ecf0f1
    }

    h5 {
      text-align: center
    }

    /* Grafico */

    .grafico {
      margin: 10px 0px;
      border-left: 1px solid gray;
      border-bottom: 1px solid gray;
      width: 600px;
      height: 200px;
    }

    .barra {
      height: 50px;
      border: 1px solid gray;
      background: orangered;
      text-align: center;
      margin-top: 10px;
      margin-bottom: 10px;
    }
  </style>
</head>

<body>
  <div class="Box">
    <img src="assets/img/LogoCui.png" alt="">
    <h1><?= reporte ?></h1>
    <hr>
    <div class="Head">
      <h3><?= creadoPor ?>:</h3>
      <p><?= nombre ?>: <?= $_SESSION['identity']->nombre ?></p>
      <p><?= apellido ?>: <?= $_SESSION['identity']->apellido ?></p>
      <p><?= email ?>: <?= $_SESSION['identity']->email ?></p>
      <p><?= cargo ?>: <?= $_SESSION['identity']->nombreCargo ?></p>
      <p><?= restaurante ?>: <?= $_SESSION['identity']->nombreRestaurante ?> - <?= $_SESSION['identity']->direccionRestaurante ?></p>
    </div>
    <div class="Body">
      <hr>
      <h4><?= saleList ?> - <?= $_SESSION['identity']->nombreRestaurante ?></h4>
      <hr>
      <table>
        <thead>
          <tr>
            <th><?= producto ?></th>
            <th><?= canSale ?></th>
            <th><?= proyAmount ?></th>
          </tr>
        </thead>
        <tbody>
          <?php while ($v = $ven->fetch_object()) : ?>
            <tr>
              <td><?= $v->nombreProducto; ?></td>
              <td><?= $v->Total; ?></td>
              <td><?= $v->Totalproy; ?></td>
            </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
      <hr>
      <p>En este reporte podemos observar la cantidad total de venta entre las fechas ingresadas.
        De igual forma vemos la proyeccion de dichas fechas pero a la semana siguiente ya que
        se proyecta la venta a la semana siguente. Esto se hace para el restaurante al que el
        usuario pertenece.
      </p>
    </div>
    <div class="Footer">
      <h5><?= generado ?> <?= date('d-m-Y'); ?></h5>
    </div>
  </div>
</body>

</html>

<?php
$content = ob_get_clean();

$html2pdf->setDefaultFont('Arial');
$html2pdf->writeHTML($content);
$html2pdf->output("PDFVentas.pdf");
