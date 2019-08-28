<?php
require_once '../../../config/db.php';
$db = new DataBase();
$conec = $db->conectar();
$r = mysqli_query($conec, "CALL findUsuarios()");
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
  <style>
    img {
      width: 20%;
    }

    table {
      background: aquamarine;
      margin: 15px;
      padding: 15px;
      border: #b2b2b2 1px solid;
    }

    td {
      padding: 5px 10px;
      border-bottom: gray 1px dashed;
    }
  </style>
</head>

<body>
  <h2>Andres Carne de Res
    <img src="../../../assets/img/logo-AR.png" alt="">
  </h2>

  <hr>
  <p>Usuarios registrados en el sistema</p>
  <div class="div">
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
        <?php while ($user = $r->fetch_object()) : ?>
        <tr>
          <td><?= $user->nombre; ?> <?= $user->apellido; ?></td>
          <td><?= $user->email; ?></td>
          <td><?= $user->nombreCargo; ?></td>
          <td><?= $user->nombreRestaurante; ?></td>
          <td><?= $user->estado; ?></td>
        </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </div>

</body>

</html>