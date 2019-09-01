<?php
require_once 'models/producto.php';

class ProductoController
{
  public function gestion()
  {
    Utils::isCocina();
    $p = new Producto();
    $ptos = $p->findPtos();
    require_once 'views/producto/crud.php';
  }
  public static function getAll()
  {
    $p = new Producto();
    $ptos = $p->findPtos();
    return $ptos;
  }
  // Registrar
  public function registrar()
  {
    Utils::isCocina();
    // Verificamos si se Manda Algo por POST
    if (isset($_POST) && !empty($_POST['nombre'])) {
      // Almacenamos los Datos en variables
      $nombre = $_POST['nombre'];
      // Creamos un Objeto Restaurante
      $pro = new Producto();
      // Almacenamos los Datos
      $pro->setNombre($nombre);
      // Realizamos el INSERT O UPDATE
      if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $pro->setId($id);
        $save = $pro->update();
      } else {
        $save = $pro->save();
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
    header('Location: ' . baseUrl . 'producto/gestion');
  }

  // Editar
  public function editar()
  {
    Utils::isCocina();
    if (isset($_GET['id'])) {
      $editar = true;
      //
      $id = $_GET['id'];
      $pro = new Producto();
      //
      $pro->setId($id);
      $proEdit = $pro->findProductoID();
      require_once 'views/producto/crud.php';
    } else {
      header('Location: ' . baseUrl . 'error/index');
    }
  }

  // Eliminar
  public function eliminar()
  {
    Utils::isCocina();
    if (isset($_GET['id'])) {
      $id = $_GET['id'];
      $p = new Producto();
      $p->setId($id);
      $delete = $p->delete();
      if ($delete) {
        $_SESSION['delete'] = 'Eliminado';
      } else {
        $_SESSION['delete'] = 'NoQuery';
      }
    }
    header('Location: ' . baseUrl . 'producto/gestion');
  }
}
