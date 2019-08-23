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
</head>

<body>
  <h2>Usuarios</h2>
  <table>
    <thead>
      <tr>
        <th>Nombre</th>
        <th>Apellido</th>
        <th>Email</th>
        <th>Cargo</th>
        <th>Restaurante</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($user = $r->fetch_object()) : ?>
      <tr>
        <td><?= $user->nombre; ?></td>
        <td><?= $user->apellido; ?></td>
        <td><?= $user->email; ?></td>
        <td><?= $user->nombreCargo; ?></td>
        <td><?= $user->nombreRestaurante; ?></td>
        
      </tr>
      <?php endwhile; ?>
    </tbody>
  </table>
</body>

</html>