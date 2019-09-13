<?php
require_once 'models/cargo.php';

class CargoController
{
  public function gestion()
  {
    Utils::isAdmin();
    $c = new Cargo();
    $cargos = $c->findCargo();
    require_once 'views/cargo/crud.php';
  }
  public static function getAll()
  {
    $c = new Cargo();
    $cargos = $c->findCargo();
    return $cargos;
  }
  // Registrar
  public function registrar()
  {
    Utils::isAdmin();
    // Verificamos si se Manda Algo por POST
    if (isset($_POST) && !empty($_POST['nombre'])) {
      // Almacenamos los Datos en variables
      $nombre = $_POST['nombre'];
      // Creamos un Objeto Restaurante
      $cargo = new Cargo();
      // Almacenamos los Datos
      $cargo->setNombre($nombre);
      // Realizamos el INSERT O UPDATE
      if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $cargo->setId($id);
        $save = $cargo->update();
      } else {
        $save = $cargo->save();
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
    header('Location: ' . baseUrl . 'cargo/gestion');
  }

  // Editar
  public function editar()
  {
    Utils::isAdmin();
    if (isset($_GET['id']) && $_GET['id'] != '') {
      $editar = true;
      //
      $id = $_GET['id'];
      $cargo = new Cargo();
      //
      $cargo->setId($id);
      $carEdit = $cargo->findCargoID();
      require_once 'views/cargo/crud.php';
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
      $c = new Cargo();
      $c->setId($id);
      $delete = $c->delete();
      if ($delete) {
        $_SESSION['delete'] = 'Eliminado';
      } else {
        $_SESSION['delete'] = 'NoQuery';
      }
    }
    header('Location: ' . baseUrl . 'cargo/gestion');
  }
}
