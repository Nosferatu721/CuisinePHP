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
      width: 110px;
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
      <h4><?= tittleTableMerma ?> - <?= $_SESSION['identity']->nombreRestaurante ?></h4>
      <hr>
      <table>
        <thead>
          <tr>
            <th><?= producto ?></th>
            <th><?= tipoMerma ?></th>
            <th><?= cantidad ?></th>
            <th><?= perdida ?></th>
            <th><?= motivo ?></th>
            <th><?= fecha ?></th>
          </tr>
        </thead>
        <tbody>
          <?php while ($m = $merma->fetch_object()) : ?>
            <tr>
              <td><?= $m->nombreProducto; ?></td>
              <td><?= $m->tipoMerma; ?></td>
              <td><?= $m->cantidadMerma; ?></td>
              <td>$<?= $m->perdida; ?></td>
              <td><?= $m->motivoMerma; ?></td>
              <td><?= $m->fechaMerma; ?></td>
            </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
      <hr>
      <p>Podemos observar los datos del producto el cual tuvo una merma, el tipo de esta merma 
        si pudo hacerse un reproceso o se tuvo que desperdiciar, si es el segundo caso este causo
        una perdida reflejada en la columna Perdida, el motivo de la merma para entender e; porque y tomar 
        medidas preventivas con el producto.
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
$html2pdf->output("PDFStock.pdf");
