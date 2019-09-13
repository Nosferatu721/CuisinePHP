<?php

require 'librerias/vendor/autoload.php';

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

    td {
      width: 110px;
      padding: 5px;
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
    <img src="assets/img/LogoCui.jpg" alt="">
    <h1>Reporte</h1>
    <hr>
    <div class="Head">
      <h3>Creado Por:</h3>
      <p>Nombre: <?= $_SESSION['identity']->nombre ?></p>
      <p>Apellido: <?= $_SESSION['identity']->apellido ?></p>
      <p>Email: <?= $_SESSION['identity']->email ?></p>
      <p>Cargo: <?= $_SESSION['identity']->nombreCargo ?></p>
      <p>Restaurante: <?= $_SESSION['identity']->nombreRestaurante ?> - <?= $_SESSION['identity']->direccionRestaurante ?></p>
    </div>
    <div class="Body">
      <hr>
      <h4>Tabla de Usuarios</h4>
      <hr>
      <table>
        <thead>
          <tr>
            <th>Nombre</th>
            <th>Email</th>
            <th>Cargo</th>
            <th>Restaurante</th>
            <th>Estado</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($u = $dataUsers->fetch_object()) : ?>
            <tr>
              <td><?= $u->nombre; ?> <?= $u->apellido; ?></td>
              <td class="email"><?= $u->email; ?></td>
              <td><?= $u->nombreCargo; ?></td>
              <td><?= $u->nombreRestaurante; ?></td>
              <td><?= $u->estado; ?></td>
            </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
      <hr>
      <div class="grafico">
        <?php foreach ($porcent as $uP) : ?>
          <div class="barra" style="width: <?= $uP[0]; ?>%">
            <?= $uP[0]; ?>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
    <div class="Footer">
      <h5>Generado <?= date('d-m-Y'); ?></h5>
    </div>
  </div>
</body>

</html>

<?php
$content = ob_get_clean();

$html2pdf->setDefaultFont('Arial');
$html2pdf->writeHTML($content);
$html2pdf->output("PDFUsuarios.pdf");
