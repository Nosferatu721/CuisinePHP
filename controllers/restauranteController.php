<?php
require_once 'models/restaurante.php';

class RestauranteController
{
  public function gestion()
  {
    Utils::isAdmin();
    $r = new Restaurante();
    $restaurants = $r->findRestaurant();
    require_once 'views/restaurante/crud.php';
  }
  public static function getAll()
  {
    $r = new Restaurante();
    $restaurants = $r->findRestaurant();
    return $restaurants;
  }
  // Registrar
  public function registrar()
  {
    Utils::isAdmin();
    // Verificamos si se Manda Algo por POST
    if (isset($_POST) && !empty($_POST['nombre']) && !empty($_POST['direccion'])) {
      // Almacenamos los Datos en variables
      $nombre = $_POST['nombre'];
      $direccion = $_POST['direccion'];
      // Creamos un Objeto Restaurante
      $restaurante = new Restaurante();
      // Almacenamos los Datos
      $restaurante->setNombre($nombre);
      $restaurante->setDireccion($direccion);
      // Realizamos el INSERT O UPDATE
      if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $restaurante->setId($id);
        $save = $restaurante->update();
      } else {
        $save = $restaurante->save();
      }
      // Verificamos si fue Exitoso :v
      if ($save) {
        if (isset($_GET['id'])) {
          $_SESSION['saveEdit'] = 'Editado';
        } else {
          $_SESSION['saveEdit'] = 'Registrado';
        }
      } else {
        $_SESSION['error'] = 'ErrorRegistro';
      }
    } else {
      $_SESSION['notData'] = 'ErrorDatos';
    }
    header('Location: ' . baseUrl . 'restaurante/gestion');
  }

  // Editar
  public function editar()
  {
    Utils::isAdmin();
    if (isset($_GET['id']) && !empty($_GET['id'])) {
      $editar = true;
      //
      $id = $_GET['id'];
      $restaurante = new Restaurante();
      //
      $restaurante->setId($id);
      $restEdit = $restaurante->findRestaurantID();
      require_once 'views/restaurante/crud.php';
    } else {
      header('Location: ' . baseUrl . 'error/index');
    }
  }

  // Eliminar
  public function eliminar()
  {
    Utils::isAdmin();
    if (isset($_GET['id'])) {
      $id = $_GET['id'];
      $r = new Restaurante();
      $r->setId($id);
      $delete = $r->delete();
      if ($delete) {
        $_SESSION['delete'] = 'Eliminado';
      } else {
        $_SESSION['delete'] = 'NoQuery';
      }
    }
    header('Location: ' . baseUrl . 'restaurante/gestion');
  }
}
